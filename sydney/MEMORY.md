# Issue #388 — Back to top: customizer swatch shows hardcoded red instead of connected accent

## Decided
Fixed customizer control swatch and front-end CSS to resolve connected global color slots instead of showing stale literal values. Three-part fix: (1) PHP render context in `Sydney_Alpha_Color::render_content()` computes display color from global slot; (2) JS on-load reconciliation syncs swatches without dirtying changeset; (3) `inc/styles.php` helpers prioritize connected global over mismatched literal.

## Why
Connected globals are a core design pattern in Sydney — controls show/generate CSS from their connected slot unless explicitly disconnected (blank slot). The bug violated this contract: swatch showed red literal, button rendered red CSS, even though `global_scrolltop_bg_color` pointed to green `global_color_1`. Fix ensures front-end and customizer UI stay in sync.

## Rejected
- "Check `colors_match()` before using global" — dropping this guard because a connected global is authoritative by definition; match check only mattered when we couldn't guarantee resolution.
- "Dirty changeset on-load to reconcile" — using display-only JS updates to avoid prompting publish on plain customizer load.
# Project Memory

## 2026-06-10 — sydney-dev autonomous issue developer

**Decided:** Built `/sydney-dev <issue>` (`.claude/skills/sydney-dev/`): a trigger skill + background Workflow that runs plan → branch → TDD implement (worktree at `wp-content/.sydney-dev-worktrees/`) → 5-angle review with bounded fix loops → WP Playground QA → draft PR (never merges) → reflect. Spec: `docs/superpowers/specs/2026-06-10-sydney-dev-autonomous-developer-design.md`.

**Why:** Local adaptation of the wpforms Autonomous Issue Developer; one orchestrating Workflow script gives deterministic caps, live progress (`/workflows`), and cached resume — vs. GitHub Actions machinery we don't need locally.

**Rejected:** Per-phase orchestration from the main loop (occupies the session for hours); single mega-prompt agent (caps/fan-out become model discretion); `sydney.local` as QA fallback (Playground-only keeps runs ephemeral and isolated).

**Verified in build (gotchas):** `css/styles.css` is the hand-edited CSS source and the theme enqueues `styles.min.css` — CLAUDE.md's `css/modules/src/` SCSS story is stale; `npm run styles` maps to a nonexistent gulp task (real: `mainStyles`/`stylesMin`/`wooStyles`/`wooStylesMin`). Playground health checks must accept HTTP 302 (auto-login). Workflow args may arrive JSON-stringified — workflow.js parses defensively.

**First run:** issue #388 → draft PR #413, all gates green, end-to-end ~33 min.

## 2026-06-10 — sydney-dev run, issue #238

**Decided:** Rename default-state Button header component text-color control label from "Button Color" to "Text Color" (one-line PHP string edit in `inc/modules/hf-builder/components/header/button/customize-options.php`, line 234). Sticky-state control already labeled "Text Color", so fix makes both consistent.

**Why:** UX wording consistency (labels now match, both already control button text color per code comment); single file, single string, zero logic change.

**Rejected:** Attempts at unit-testing the label string (no mockable PHP logic for a Customizer label); regenerating `languages/sydney.pot` (string "Text Color" already exists elsewhere, POT regenerates on release branches only).

**Result:** implement iterations=1, all tests pass, PHPCS pass, no review issues found, QA pass (Customizer Style tab shows both controls labeled "Text Color").
## 2026-06-10 — issue #387 sydney-dev run

**Decided:** Rewrote dashboard CSS with `--sydney-dashboard-*` token block (primary mapped to `var(--wp-admin-theme-color, #3858e9)`); replaced 30+ hardcoded legacy blues/greens/grays with tokens across `sydney-dashboard.{css,min.css}`, `html-patcher.php`, and 5 SVG files; bumped asset version to bust caches. Testability: computed styles on rendered wp-admin pages; QA passed all 7 visual criteria (Modern blue is now primary across dashboard home, tabs, settings, notifications, etc.).

**Why:** WP 7.0 changed default admin scheme to `#3858e9`; Sydney's dashboard was hardcoded to legacy `#2271b1`/`#135e96`, creating visual inconsistency. Tokens allow fallback to `var(--wp-admin-theme-color)` so user-selected schemes (Sunrise, etc.) auto-retint the dashboard.

**Rejected:** Gulp pipeline extension to dashboard CSS (too disruptive; hand-sync the minified file is acceptable for a rare update); touching RTL files (only `#e4e4e4` present, unrelated to Modern palette).

**Review iterations: 2** (critical: unused color token import in patcher; medium: incomplete token fallback coverage, admin-wide token leak semantics) — required remediation.
## 2026-06-10 — sydney-dev run, issue #374

**Decided:** Fix latent bug in `sydney_enqueue_google_fonts()` (inc/fonts.php): variable `$fonts_url` returned without initialization if `$fonts` is falsy. Added guard in `sydney_enqueue_google_fonts()` to early-return `''`, wrapped helper with `function_exists()` guard for test mockability, removed now-redundant `if ( $fonts )` wrapper. Three unit tests: falsy fonts → empty string, default fonts → URL, distinct body/headings → both in URL. All gates passed (tests + phpcs). No render impact (already returns correctly on live path).

**Why:** Latent bug (current helper always returns array, but function must be defensive); PHP 8+ would emit warning if helper falsy; separate-process test allows stub helper returning empty array to reach otherwise-unreachable code path.

**Rejected:** Not fixing `$fonts['body']`/`$fonts['headings']` deref smell upstream in plan — fix was correct; early return + guard addresses all dereference sites. QA took path `/` (no warnings) + Customizer (clean preview) + Google Fonts link verified in `<head>`. Iteration count: 1 (implement) + 0 (review remediations) = no ERRORS.md entry needed.
## 2026-06-10 — review remediation: fix everything actionable, red gate on leftovers

**Decided:** The review remediation loop now treats critical/high/medium/low as fixable (only info stays advisory), loops until clean (cap 5, stall guard after round 2), and any surviving actionable finding turns the review gate RED in the PR body. Fix agents must address every finding (marking already-resolved ones); re-run reviewers get the fix summary and must re-verify against current code. PR body's Code Review Summary is built exclusively from the final in-memory findings, never from the per-angle review-*.md files. implement.md gained a behavior-preservation rule for value→token refactors (distinct originals get distinct tokens).

**Why:** First 3-issue batch (PRs #415-417) exposed it: #417 shipped with a real hover-feedback regression graded `low` (so never fixed), reviewers carried already-fixed findings forward across rounds (stale review-*.md), and the PR body listed fixed items as unresolved. User decision: leaving known issues in PRs is not acceptable.

**Rejected:** Blocking/aborting the PR on unresolved findings (strands unattended work — draft PR with a loud red gate stays the handoff artifact); making info-level actionable (comment-clarity nits would churn the loop); unbounded remediation loop (severity grading drifts between fresh reviewers — needs a stall guard, not faith in convergence).

## 2026-06-10 — VRT gate + Testing Links added to sydney-dev

**Decided:** New VRT phase between QA and PR runs `tests/am-visual-regression-testing/` with baseline = ephemeral Playground serving a throwaway `origin/develop` checkout and compare = Playground serving the worktree (port `qaPort+100`, same blueprint). Tolerance pinned to `maxDiffPixelRatio: 0.0005`. Visual failures are never auto-fixed — red `vrt` gate + evidence instead. PR bodies gain the create-pr skill's Testing Links section (hub build zip + encoded Playground blueprint link, built programmatically, IP-whitelist note).

**Why:** The workflow reimplemented create-branch/create-pr conventions but skipped their VRT baseline/compare steps and Testing Links. The suite's config targets `sydney.local` (the live main checkout) — unusable from a worktree, hence the dual-Playground design.

**Rejected:** Running VRT against `sydney.local` (wrong code + mutates nothing but measures the wrong checkout); auto-fixing visual diffs (a diff may be the intended change); blocking the PR on VRT failure (always-draft-PR failure matrix stands — red gate instead).

## 2026-06-10 — sydney-dev run, issue #373: Move YITH Compare button icon setup off after_setup_theme

**Decided:** Implement issue #373 as specified: remove per-request `update_option` from `sydney_setup()`, add one-time flag-gated `sydney_set_yith_compare_button_icon()` on `init`, add migration `sydney_yith_compare_icon_migration()` in theme-update.php at priority 5, add unit tests in YithCompareIconTest.php. Implementation first-try successful; DX review found 3 docblock/test-ordering items, all fixed in single remediation round. VRT flag (`admin-options-php`) expected — the change adds new option rows, baseline does not. All gates green except vrt=red (intentional per gate design).

**Why:** Prevents YITH Compare icon clobbering on user customization, reduces per-request CPU burn, decouples one-time theme setup from request cycle.

**Rejected:** Auto-fix VRT diff (expected behavior change); block PR on VRT failure (spec: draft PR + red gate + evidence).

## 2026-06-10 — sydney-dev run, issue #382

**Decided:** Pure CSS deduplication: deleted redundant `@media (max-width: 1024px)` block 1 from `css/styles.css` (lines 989–1008), trimmed legacy `-webkit-box-pack`/`-ms-flex-pack` prefixes from block 2 inside `.mobile-header .align-right`, regenerated `css/styles.min.css` via `npx gulp mainStyles stylesMin`. Mobile header renders identically on Playground at <1024px (off-canvas menu toggle works, header hides/shows per breakpoint). All gates pass: tests, phpcs, review, VRT.

**Why:** Issue summary: two near-identical `@media (max-width: 1024px)` blocks in styles.css broke maintainability; the dead block and retired browser prefixes bloat CSS payload with zero user benefit. One-pass fix; no PHP/markup touch.

**Rejected:** No alternatives examined — spec was complete and straightforward; no design or implementation tradeoffs.

## 2026-06-10 — sydney-dev run, issue #372: Remove dead sydney_get_google_fonts()

**Decided:** Removed dead `sydney_get_google_fonts()` function from `inc/fonts.php` (lines 8-13); added unit test `FontsDeadCodeRemovalTest.php` asserting function is gone and live helpers remain. Implementation 1 iteration, review 0 remediations, all gates pass (tests/phpcs/review/vrt), QA pass (3/3 scenarios).

**Why:** The function has zero call sites anywhere in the theme; `Sydney_Typography::get_google_fonts()` is the active path. Dead-code removal improves maintainability.

**Rejected:** Keeping the function (increases surface area); wrapping with `function_exists()` (child theme override was never possible since there's no guard in the original).


## 2026-06-11 — sydney-dev speed pass: overlap VRT baseline + qa-plan, pin Playground CLI, split Zenhub

**Decided:** (1) VRT split into `vrt-baseline.md` (snapshots origin/develop, runs concurrently with QA execution on port qaPort+100, writes the shared VRT config) and `vrt.md` (compare + report; always runs, sweeps orphans if baseline died). Safe because VRT's .gitignore covers config.json/.env/visual/*-snapshots/, and workflow.js has no early returns between the unawaited launches and their awaits. (2) qa-plan launches before the Review phase (its prompt snapshots changed-files.txt → qa-input-files.txt first thing; review fixes rewrite the original but never expand diff scope). (3) Playground CLI pinned to @3.1.38 — measured npx @latest resolution at 1.5s warm, so this is a determinism fix (same binary across all boots in a run), not a speed fix. (4) Gate failures captured to TMP/gate-failures.txt by implement/recheck; fix agents read it instead of re-running suites. (5) Zenhub move/connect split out of the PR agent into a parallel agent alongside Reflect; PR_SCHEMA dropped zenhubMoved.

**Why:** Pipeline was fully serial; the only real wall-clock wins were overlapping the VRT baseline leg (boot + snapshot suite) with QA and qa-plan with Review, plus killing the redundant full-suite run in each gates-fix iteration.

**Rejected:** Merging fix+recheck agents (recheck is a deliberate honesty boundary — fixers must not self-grade); default QA scenario cap (past-run data: 2-12 scenarios, only 1/7 runs ballooned — coverage cost outweighs the outlier savings, --scenarios flag covers it); starting Branch during Plan via label-derived prefix (wrong prefix on mislabeled issues); running VRT baseline during Implement/Review (would break the qa-plan→pages contract and orphan Playgrounds on Implement aborts — during-QA placement has neither problem).

## 2026-06-11 — preflight sweep hardened + post-QA-fix re-review

**Decided:** (1) The stale-worktree sweep (SKILL.md preflight step 4) now requires a clean `status --porcelain` AND a *succeeding* `rev-parse @{u}` before trusting an empty `log @{u}..` — empty output from a failed command (no upstream, detached HEAD, pruned remote-tracking ref) must never justify `worktree remove --force`; anything ambiguous is reported, not deleted. (2) When the QA fix runs (code amended after the review phase), workflow.js re-runs all 5 review angles on the current diff; if actionable findings surface: one remediation pass, flagged-angle re-check, then one FULL QA re-run (ONLY=all — remediation lands after full QA, so partial re-runs could miss newly broken scenarios). Findings tally (allFindings/unresolved/advisory) moved from end-of-Review to the PR phase so the gate summary reflects the post-QA state.

**Why:** Audit findings: the @{u} error path silently conflated "no upstream" with "everything pushed" (unpushed work force-deleted); and fix:qa code shipped in PRs with zero review coverage, contradicting the 2026-06-10 "no known issues in PRs" decision.

**Rejected:** Reordering phases QA-before-Review (review remediation would then escape *behavioral* validation — worse); find-only disclosure after the QA fix (contradicts the no-known-issues decision); partial QA re-run of only previously-failed scenarios (post-review remediation can break previously-passing scenarios); unbounded post-QA review loop (one remediation pass, then honest red gate).

## 2026-06-11 — model tiers per phase: fable plans, opus 4.8 implements

**Decided:** plan agent pinned `model: 'fable'` (was inherited) — the plan is the only artifact with no automated quality gate downstream, so it gets the top model regardless of which session invokes the skill. implement + fix:gates agents pinned `model: 'opus'` (verified at runtime to resolve to `claude-opus-4-8[1m]`, not 4.7) — they execute the plan's function-level spec under four safety nets (TDD, gates+fix loop, 5-angle review, QA) and are the most token-heavy phase, so the $5/$25 tier vs fable's $10/$50 halves the biggest cost. Branch + gates-recheck on sonnet (mechanical command-running).

**Why:** Inherit-everything meant fable ran `git fetch` and `composer test`; explicit tiers put intelligence where nothing else catches mistakes.

**Rejected:** opus for plan (a subtly wrong plan passes every gate — tests, phpcs, QA all validate against the plan itself); fable for implement (implementation slips get caught by four nets; blown 3-iteration cap aborts loudly rather than shipping garbage).

## 2026-06-11 — sydney-dev run, issue #424 (large-thumb/medium-thumb not registered)

**Decided:** Plan → implement (1 iteration) → 5-angle review (0 remediations) → QA (pass) → gates green (tests, phpcs, review) → VRT red (1 snapshot diff). Draft PR auto-created with red `vrt` gate; unresolved visual diff requires human decision before merge. Run time ~28 min.

**Why:** The plan spec'd 4 template call sites (`large-thumb` → `sydney-large-thumb`) + test updates; implement hit each in 1 pass; review found no actionable findings; QA validated the fix on Playground (all reproduction steps passed). VRT baseline showed a single snapshot regression on blog archive layouts (class names changed, CSS applies fine but pixel-level diff crosses tolerance).

**Rejected:** Auto-fixing the VRT diff (snapshots are baselines, not judgments; a pixel diff may be the feature or a regression — user chooses); aborting the PR on visual diff (red gate with evidence lets the user decide merge readiness without blocking draft artifacts).
## 2026-06-11 — sydney-dev run, issue #375: back-to-top click listener rebinds on scroll

**Worked:** Moved `icon.addEventListener('click', …)` from `sydney.backToTop.setup()` (called on every scroll) to `init()` (runs once at DOM ready); left only show/hide class toggle in `setup()`. Regenerated `js/functions.min.js` via uglifyjs; bumped version `'20240822'` → `'20260611'` in `functions.php`. Tests + PHPCS green, 5-angle review returned `pass + 1 info` (cosmetic suggestion, no fix needed), QA passed (listener count = 1 before/after), VRT passed, draft PR ready.

**Why:** Plan correctly identified the unbounded listener leak (conditional `addEventListener` inside scroll path), specified the surgical fix, and gave concrete QA repro steps with the `__goTopClicks` counter. Implement executed the plan, tests validated the refactored behavior immediately, and QA confirmed the leaf behavior (show/hide/click) unchanged.

**Rejected:** The optional `requestAnimationFrame` throttle (issue body said "Optionally" and CLAUDE.md says "No features beyond what was asked"); any diff noise fears were overblown (uglifyjs output is deterministic for the same config).
## 2026-06-11 — sydney-dev run, issue #397 — WooCommerce product card: Border size/color controls

**Decided:** Re-added four missing customizer controls (`shop_product_card_style`, `shop_product_card_radius`, `shop_product_card_border_size`, `shop_product_card_border_color`) to `inc/customizer/options/woocommerce.php` mirroring Sydney Pro; ungated dynamic CSS output in `inc/styles.php` so border/radius values render on frontend at all card styles (not just layout2/3), with guard: border only emits if style is boxed OR user explicitly saved a border mod (preserves default zero-border rendering). Implement 1 pass, review 2 rounds (sanitizer signature + esc_attr consistency), all gates green.

**Why:** Controls were deleted in 2021 but JS/CSS/tab-map references remained, creating orphaned code and blocking feature access. Ungating with explicit-save detection unblocks feature without changing default site appearance.

**Rejected:** Auto-emitting 1px border at layout1 default (breaks existing sites); leaving CSS gated to layout2/3 (keeps the controls non-functional); skipping the explicit-save guard (would need db audit to avoid breaking imported mods).
## 2026-06-11 — sydney-dev run, issue #274: refactor Sydney_Modules duplicate class

**Decided:** Remove dead `inc/classes/class-sydney-modules.php` (never executed due to `class_exists` guard) and its require from `functions.php:736`; add test `tests/unit/ModulesSingleDefinitionTest.php` asserting single definition and correct defaults. No module behavior changes — free class at `inc/modules/` already the effective definition.

**Why:** Plan's assumption audit found nothing loaded `inc/classes/` copy; both `class_exists` guards wrapped the file and the free class loads first in `functions.php:682`, so the second require was dead code (only duplicated an `admin_init` hook). Implementation, review remediations (2), QA, and all gates (tests, phpcs, review, vrt) passed cleanly in 1 iteration.

**Rejected:** Keeping the dead file (repo principle: no dead code); merging pro module lists (Sydney Pro is separate codebase, ported via `port-sydney-change` skill — no lists to preserve here).
## 2026-06-15 — sydney-dev run, issue #294: header button individual color options

**Decided:** Replaced six Sydney_Color_Group controls (header button background/text/border, default+sticky) with twelve Sydney_Alpha_Color controls (one per state: normal, hover) to expose global-color connectors. Added six companion `global_*` settings and updated Design tab JSON to include new _hover control ids. No CSS changes — existing `inc/styles.php` and `css.php` already honour the `global_*` settings. Implementation: 1 iteration. Code review surface: 1 low unresolved finding (marked as misdiagnosis by reviewer after re-review); all tests/phpcs/QA pass. Deployed draft PR without code changes post-findings, red gate held. Ready for handoff.

**Why:** Enhancement scope (not bugfix) with high test coverage (customizer control + CSS output); plan precise and implementation clean. Review remediation framework caught a stale finding after QA-fix re-review; one remaining low-severity comment about a documented design constraint was correctly marked unresolved to surface the trade-off decision.

**Rejected:** Auto-fix of the low finding (already-resolved by reviewer's own re-check, noise-reduction win by holding the gate red instead).
## 2026-06-17 — sydney-dev run, issue #434: Add starter content for theme directory

**Decided:** Implemented starter-content registration for wp.org theme preview via new `Sydney_Starter_Content` class in `inc/classes/class-sydney-starter-content.php`. Class registers `add_theme_support('starter-content', ...)` with placeholder home page (Gutenberg blocks: heading, paragraph, columns, button), `show_on_front=page`, `page_on_front={{home}}`, primary menu with home item, and placeholder global-color mods (`global_color_1`, `global_color_2`). Plan required gating to fresh_site/Customizer contexts only (WordPress core's own guard prevents DB writes on live sites). Implementation: 3 iterations. Review: 1 remediation. QA: pass. VRT: 1 snapshot diff (red gate, expected).

**Why:** Registers theme support that feeds wp.org Customizer preview, so fresh installs show a designed homepage instead of bare defaults. Scope: registration + wiring only; no real homepage content extraction (throwaway placeholder per user override). Changes are preview-only; WordPress core ensures DB purity on live sites.

**Rejected:** (1) Extracting real homepage from main-free content.xml (user override: placeholder only this run, sourcing acceptance criterion dropped). (2) Adding gating inside register() (WP core's own fresh_site && customize.php guard is sufficient; class never runs except in safe contexts). (3) Bundling images / remote assets (user override: placeholders only).
