# Issue #388 — Review Remediation Iterations

## What didn't work (Attempt 1)
Initial implementation did not guard against Pickr's `on('change')` event firing on first picker open with a normalized seed color, which could write the resolved global hex back as the literal mod. Also, the global slot resolution did not have guards for distinguishing "never connected" (missing mod) from "connected to default".

## What worked instead
Added two remediation passes:
1. **Pickr interaction guard** — Track first user slider interaction with `pickrUserInteracted` flag before allowing `on('change')` to call `.set()`.
2. **JS reconciliation refinement** — The on-load reconciliation now explicitly handles the case where `get_theme_mod()` returns default via fallback (e.g. `global_color_1`), matching the customizer control render behavior from PHP step 1.

## Note for next time
Pickr's dual-purpose initialization (normalize + user interaction) and WordPress theme_mod fallback semantics interact in non-obvious ways. When working with color pickers and global slots, simulate Pickr's first-open behavior in browser QA and verify that `get_theme_mod( 'global_*', $default )` resolution does not re-introduce stale-literal bugs on later save cycles.
# Errors Log

## 2026-06-10 — issue #387 review remediations

**What didn't work:** First review pass flagged critical (unused `--sydney-dashboard-primary` fallback color in inline patcher style block when fallback is not actually used) and 2 medium findings (incomplete token application in some selectors; semantic concern about admin-wide token leak). Single remediation iteration only addressed the critical path.

**What worked instead:** Accepted critical-only fixup in iteration 1; moved medium findings to "unresolved but accepted" status (team acknowledged as non-blocking for enhancement scope). This allowed the run to complete rather than loop indefinitely on style semantics.

**Note for next time:** Review remediations at 2-iteration cap should escalate optional findings to follow-up issues rather than block the PR; dashboard color work is inherently iterative (WP 7.0 just shipped, Sunrise retinting is a new feature, token model is new to Sydney codebase).
# ERRORS.md

Log of approaches that took more than 2 attempts, per CLAUDE.md.

## sydney-dev QA mounted the main checkout into WP Playground (2026-06-10)

- **What didn't work:** During the issue #238 run, the qa-execute agent's Playground boot with the worktree mount failed 3 times. It improvised: mounted the MAIN repo checkout (`themes/sydney`) instead and used a blueprint that wrote the patched file into the mounted path. Playground `--mount` is read-write, so the write went through to the real working tree — a stray uncommitted copy of the fix appeared on the user's `feature/sydney-dev-skill` branch.
- **What worked instead:** Discarded the stray change (`git checkout -- <file>`; identical change was already in PR #415). Hardened `prompts/qa-execute.md`: only WORKTREE may ever be mounted, blueprints must never write into mounted paths, and a failed boot after one retry means `not-executed` — no improvised mounts/servers.
- **Note for next time:** WP Playground CLI mounts are read-write. Never mount a checkout you aren't allowed to mutate, and treat "agent improvised a fallback" as a prompt gap — autonomous prompts must state what NOT to do when the happy path fails.

## WP Playground mounts don't follow symlinks; theme needs vendor/ at runtime (2026-06-10)

- **What didn't work:** Mounting a sydney-dev worktree as the theme: every page 500s because `functions.php:691` requires `vendor/woocommerce/action-scheduler/` and the worktree's `vendor` symlink is not followed inside the Playground mount. Worse, the boot still answers HTTP 302 (auto-login redirect), so a status-code health check reports "healthy" while the site serves only critical-error pages. Each autonomous QA agent burned many iterations rediscovering this; one nearly mounted the main checkout to get a working vendor.
- **What worked instead:** A second `--mount=<worktree>/vendor:/wordpress/wp-content/themes/sydney/vendor` — a mount whose SOURCE is the symlink path resolves on the host (probe-verified in the issue #387 run). For checkouts with no vendor at all (VRT develop-baseline), copy `vendor/woocommerce/action-scheduler` in (764K, the theme's only runtime composer dep). Health checks now also require the front page body to be free of "critical error".
- **Note for next time:** With WP Playground, verify the page BODY renders, not just the status code; and assume symlinks inside a mounted tree are broken — mount them explicitly or copy the target.

## Pretty permalinks in Playground: $wp_rewrite trap + CLI version routing bug (2026-06-11)

- **What didn't work:** Seeding pretty permalinks from a blueprint `runPHP` step with `update_option( 'permalink_structure', '/%postname%/' ); flush_rewrite_rules();` — links GENERATE pretty but nothing ROUTES (every path renders the homepage). `flush_rewrite_rules()` regenerates rules from the `$wp_rewrite` OBJECT, which was initialized with the old (plain) structure at wp-load time, so it writes empty rules. Fixing that wasn't enough either: on `@wp-playground/cli` **3.1.36** pretty paths still all render the homepage — the CLI's request handling doesn't route arbitrary paths to WP correctly; `permalink_structure` and `rewrite_rules` were verifiably correct in the DB.
- **What worked instead:** `global $wp_rewrite; $wp_rewrite->set_permalink_structure( '/%postname%/' );` (+ flush at the end), AND Playground CLI **3.1.38** — the version the sydney-dev prompts already pin — which routes pretty permalinks fine. Verified: 15/15 snapshots identical across two independent boots.
- **Note for next time:** (1) In one-shot PHP contexts (blueprints, WP-CLI eval), set permalinks via `$wp_rewrite->set_permalink_structure()`, never bare `update_option`. (2) The user-level npm `before` config (pinned ~2026-06-04) blocks installing `@wp-playground/cli@3.1.38` (published 06-09); it only works because it's already in the `~/.npm/_npx` cache — if that cache is cleared, every sydney-dev Playground boot fails with ETARGET. (3) When curl-testing Playground, use a cookie jar AND expect intermittent auto-login interstitials; verify content on a SAVED response body, not repeated live greps.

## issue #434 implementation iterations (2026-06-17)

- **What didn't work:** Iterations 1–2 of implement attempted to apply WordPress starter-content registration inside `sydney_setup()` (after_setup_theme callback). Hook ordering assumptions collided with TDD test isolation: `sydney_setup()` runs at priority 10 (before priority-100 import_theme_starter_content), but tests mocking `current_theme_supports()` at priority-default (unspecified 10) were running in test bootstrap before any TDD hook registration, causing false assertions. Also, initial Gutenberg block markup concatenation was not properly escaped in all branches.
- **What worked instead:** (1) Isolated registration in a separate `sydney_starter_content_init()` function hooked at priority-default after_setup_theme (cleaner than inline in sydney_setup and simpler to test). (2) Moved all block string assembly to private `get_home_blocks()` returning a single pre-built string with all `esc_html__()` calls inline, eliminating mid-concatenation escaping logic. (3) TDD test passed mocks directly to the class under test rather than relying on global hook state.
- **Note for next time:** With `add_theme_support()` calls that fire on after_setup_theme, isolate each one in its own function/class if tests must mock theme-supports state; the priority-default assumption in test code can mask hook ordering bugs. For Gutenberg block strings, assemble once with escaping at the string level, never mid-concatenation.
