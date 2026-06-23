# /sydney-dev — Local Autonomous Issue Developer

**Date:** 2026-06-10
**Status:** Approved design
**Inspiration:** wpforms-plugin Autonomous Issue Developer (`.github/ai-dev/`, `ai-developer.yml`, `ai-qa.yml`) — adapted for local, manually-triggered, single-issue runs.

## 1. Summary

`/sydney-dev <issue>` takes a GitHub issue number from `awesomemotive/Sydney` and autonomously runs the full development cycle — plan → branch → TDD implement → multi-angle review → browser QA in an ephemeral WP Playground → draft PR — with **no pauses** and **no merge**. The human starts it, walks away, and comes back to a draft PR to review and merge themselves.

Key differences from the wpforms cloud pipeline it mirrors:

- Runs locally in a Claude Code session (skill + background Workflow), not GitHub Actions.
- Triggered manually by issue number — no cron, no `ready-for-ai` label.
- QA runs in an ephemeral WP Playground instance (no fallback environment; network-dependent scenarios like Elementor Pro / cloud templates are out of scope).
- No bot identity, no headless-state machinery beyond per-phase status files.

## 2. Decisions locked during brainstorming

| Decision | Choice |
|---|---|
| Terminal phase failure | Always end with pushed branch + draft PR, failures flagged honestly in PR body (pre-branch failures abort silently) |
| Zenhub | Full pipeline moves: In Progress at branch, Review/QA at PR |
| QA depth | Full scenario pipeline (qa-plan → qa-execute → qa-execute-review → qa-report), wpforms-style |
| Review panel | 5 angles mirroring the cloud: performance, code smells, DX/readability, security, Sydney conventions |
| Reflect | Final phase appends to MEMORY.md and ERRORS.md, committed on the feature branch |
| TDD scope | Unit (WP_Mock) when testable; otherwise the plan's reproduction/success criteria in Playground is the failing→passing check. No artificial tests |
| Location | Project `.claude/`, committed to the repo |
| Architecture | Approach A: one Workflow script, phases as `agent()` calls (chosen over per-phase orchestration from the main loop, and over a single mega-prompt agent) |
| Models | Phases inherit the session model; review/QA agents Sonnet; PR + reflect Haiku |
| Checkpoints | None. Fully autonomous after launch; watchable via `/workflows`, killable via TaskStop |

## 3. File layout

```
.claude/skills/sydney-dev/
├── SKILL.md                     # the /sydney-dev trigger skill
├── workflow.js                  # the Workflow script (all phases)
├── blueprint-template.json      # base WP Playground Blueprint for Sydney
├── scan-secrets.sh              # pre-push secret guard (ported from wpforms)
└── prompts/                     # per-phase agent prompt templates (committed = reviewable)
    ├── plan.md
    ├── implement.md
    ├── fix.md
    ├── review-performance.md
    ├── review-smells.md
    ├── review-dx.md
    ├── review-security.md
    ├── review-conventions.md
    ├── qa-plan.md
    ├── qa-execute.md
    └── qa-report.md

.sydney-dev-tmp/<issue>/         # per-issue run state, git-ignored
├── issue-context.json           # issue body, labels, comments (written by the skill)
├── plan.md                      # plan + classification + reproduction/success criteria
├── blueprint.json               # per-issue Playground Blueprint
├── qa-plan.md / qa-results.md / qa-report.md
├── review-*.md
├── review-severity.json
├── evidence/                    # QA screenshots, console logs
└── *-status.json                # one per phase — the inter-phase contract

../../.sydney-dev-worktrees/issue-<n>/   # implement worktree (sibling dir, outside the repo)
```

`.gitignore` gains `.sydney-dev-tmp/`.

## 4. Control flow

1. User types `/sydney-dev 123` (optional flags: `--scenarios=N` smoke-cap, `--dry-run` stop after Plan).
2. The **skill** runs in the main loop (~1 min, fail-fast, the only interactive moment):
   - Issue exists, is open; `gh` auth works; deps present (`node_modules/`, `vendor/`).
   - Re-run guard: existing open PR for the issue → abort and link it. Existing branch without PR (killed run) → offer resume (`resumeFromRunId`) or restart. Stale-worktree sweep: remove worktrees whose commits are pushed; report (never delete) those with unpushed work.
   - Writes `issue-context.json`, then launches **one background Workflow** and tells the user where to watch (`/workflows`) and how to kill.
3. The **Workflow** runs all phases. Phase agents are isolated contexts; they communicate **only through `.sydney-dev-tmp/<issue>/` files**. Each phase validates its predecessor's `*-status.json` on entry — a derailed phase cannot silently poison the next.
4. Run ends with a notification: PR URL + one-line gate summary (e.g. `tests=pass review=2-advisory qa=5/5 → PR #410`).

## 5. Phases

Caps are ported from the wpforms pipeline (tuned there by real failure case studies). Two load-bearing rules apply everywhere:

- **Fix sub-agents verify with only the specific failing check, never the full suite** (full-suite re-runs were the cloud's #1 timeout cause).
- **No phase ever fabricates a pass.** A check that could not run is recorded `not-executed`, never `passed`.

### 5.1 Plan — inherits session model

Reads `issue-context.json`. Uses `superpowers:writing-plans` discipline. Outputs `plan.md` with:

- Function-level implementation steps.
- **Classification:** bug vs enhancement (drives QA framing: reproduction vs acceptance).
- **Testability call:** unit-testable (WP_Mock) vs QA-as-test.
- **Reproduction / Success criteria:** concrete and runnable.
- **`blueprint.json`:** the base template plus the steps/options/content needed to exhibit this issue in Playground.

`--dry-run` stops here, leaving `plan.md` + `blueprint.json` for inspection. Nothing is created.

### 5.2 Branch — script step + small agent

- Branch via `gh issue develop` off `develop`; naming per existing create-branch conventions (`bugfix/`/`feature/` prefix, ≤60 chars).
- Worktree at `../../.sydney-dev-worktrees/issue-<n>/`, then symlink deps from the main checkout:
  ```bash
  ln -s <main>/node_modules <worktree>/node_modules
  ln -s <main>/vendor       <worktree>/vendor
  ```
  Deps are read-only by contract (Gulp writes to `css/`/`assets/` inside the worktree, PHPUnit/PHPCS only read `vendor/`). Guard: if a fix changes `package-lock.json` or `composer.lock`, the implement agent replaces the symlink with a real install — never mutates shared deps through the symlink.
- Zenhub: move issue to **In Progress**.

### 5.3 Implement — inherits session model, runs in the worktree

- `superpowers:test-driven-development` for unit-testable changes (red → green → refactor, WP_Mock, `tests/unit/`).
- QA-as-test changes implement against the plan's success criteria.
- Gates before declaring done: `composer test` + `composer phpcs`.
- **Fix-loop cap: 3 iterations** (fix sub-agents via `superpowers:subagent-driven-development` + `superpowers:systematic-debugging`), then proceed with honest red status.
- One commit; later phases amend it.

### 5.4 Review — 5 parallel agents (Sonnet), read-only, diff-bounded

Panel (each via its committed prompt template):

| Angle | Notes |
|---|---|
| Performance | |
| Code smells | |
| DX / readability | |
| Security | uses the `wp-plugin-security-review` skill |
| Sydney conventions | `sydney_` prefix, escaping, text domain `sydney`, tabs, SCSS-source-not-compiled-CSS, hook naming |

Each reviewer: hard budget (~10 tool calls, diff + immediate file context only, no codebase-wide hunts), emits a machine-readable severity footer (`critical|high|medium|low|info`). Aggregated into `review-severity.json`.

**Remediation loop — until clean, cap 5 iterations (revised 2026-06-10):** critical/high/medium/low findings → one fix sub-agent in the worktree (must address EVERY finding, marking already-resolved ones) → amend commit → re-run *only the reviewers that flagged*, with the fix summary injected so they re-verify against current code instead of carrying findings forward. Loop exits when no actionable findings remain, on a non-convergence stall (actionable count not shrinking after round 2), or at the cap. Only info-level stays advisory. Any actionable finding that survives the loop turns the review gate RED and lands in "⚠ Failed gates" at the top of the PR body. *(Supersedes the original "surfaced, not blocking" asymmetry — user decision 2026-06-10: leaving known issues in PRs is not acceptable.)*

### 5.5 QA — full sub-pipeline (Sonnet) against ephemeral WP Playground

1. **Boot:** `npx @wp-playground/cli server` mounting the worktree as the active theme and applying `blueprint.json`. No build step — compiled CSS is committed; the implement phase regenerates `styles.min.css` when it touches `css/styles.css` (verified: the theme enqueues the min file; `css/styles.css` is the hand-edited source, gulp only autoprefixes/minifies). Random high port + health-check poll (HTTP 200 or 302 = healthy; 302 is Playground's auto-login); one restart attempt; if it still will not boot, record `qa: not-executed` and continue.
2. **qa-plan:** scenario list derived from the issue + diff surfaces. `--scenarios=N` caps it (smoke mode).
3. **qa-execute:** drives the browser via the `playwright-cli` skill. Bug issues verify the reproduction is fixed; all scenarios capture console errors, PHP notices/fatals, and screenshots into `evidence/`.
4. **qa-execute-review → qa-report:** review evidence, write `qa-report.md`. Failed scenarios → **one** fix sub-agent attempt → re-run only the failed scenarios → final honest report.
5. Tear down Playground.

### 5.5b VRT — visual regression gate (Sonnet, added 2026-06-10)

Runs the repo's `tests/am-visual-regression-testing/` suite (the create-branch/create-pr skills' baseline/compare steps, adapted for unattended worktree runs). The committed config targets `sydney.local` (the user's live main checkout) which a worktree run must never touch — instead both runs hit ephemeral Playgrounds on `qaPort+100`: **baseline** mounts a throwaway detached checkout of `origin/develop`, **compare** mounts the implemented worktree, same blueprint, so the only variable is the theme code. Worktree-local `config.json`/`.env`/snapshots are all gitignored. Tolerance pinned at `maxDiffPixelRatio: 0.0005` (looser ratios silently pass real regressions on full-page shots). One flake re-run on compare failure. Visual failures are NEVER auto-fixed (a diff may be the intended change — human judgment); a failed compare turns the `vrt` gate RED in the PR body. Adaptation of create-pr's "STOP on VRT failure": consistent with the always-draft-PR failure matrix, the PR is still opened with the red gate prominent.

### 5.6 PR — Haiku

- `scan-secrets.sh` against the diff (hard gate on push).
- Push branch; `gh pr create --draft` against **develop** (never master).
- PR body: summary, plan link, review findings (post-remediation state only), QA report, VRT result, Testing Links (hub build download + encoded WP Playground blueprint link with optional landingPage, per the create-pr skill, plus the IP-whitelist note), evidence screenshots; failure flags prominent if anything is red.
- Label `needs-human-review`; Zenhub → **Review/QA**.
- On push/gh error: retry once; if still failing (the one stranded state), preserve the worktree and return branch name + exact manual commands.

### 5.7 Reflect — Haiku/Sonnet

- Append run decisions to `MEMORY.md`; log any >2-attempt struggle to `ERRORS.md` (existing CLAUDE.md conventions).
- Commit on the feature branch, push.
- Remove worktree (`git worktree remove --force` + `prune`).
- Workflow returns PR URL + gate summary.

## 6. Error handling

**Failure matrix** — once a branch exists, every outcome ends in a pushed branch + draft PR; only pre-branch failures abort silently:

| Terminal failure in | Behavior |
|---|---|
| Preflight / Plan | Abort, nothing created, report why |
| Branch | Abort, clean up any half-created worktree; nothing remote yet |
| Implement (red after cap) | Continue — review + QA still run (triage info); PR flags `tests: FAIL` |
| Review (remediation incomplete) | Continue — unresolved findings listed in PR body |
| QA | Continue — `qa: not-executed` or `qa: N failed` in PR body |
| PR push/create | Retry once; then preserve worktree + return manual commands |

- An `agent()` returning null (API death, user kill of a sub-agent) = that phase failing terminally per the matrix. The script checks every return.
- Killed workflows resume via `resumeFromRunId` — completed phases replay from journal cache; only the interrupted phase re-runs.
- **Concurrency:** safe by construction — per-issue worktrees, per-issue temp dirs, random Playground ports. Shared mutable surface is only the symlinked deps, read-only by contract.
- **Runaway protection:** every loop has a hard cap (3 implement / 2 review-remediation / 1 QA-fix / 1 PR-retry); no unbounded loops; QA scenario count cappable per run.

## 7. Skill interface

```
/sydney-dev 123                  # full autonomous run
/sydney-dev 123 --scenarios=2    # QA smoke-cap
/sydney-dev 123 --dry-run        # stop after Plan; emits plan.md + blueprint.json only
```

Skill's handoff message: issue title, classification guess, watch/kill instructions. During the run, `log()` lines narrate phase transitions. Completion notification: PR URL + gate summary.

## 8. Superpowers skills used inside the run

- `writing-plans` (Plan)
- `using-git-worktrees` (Branch — mechanics; lifecycle is managed by the workflow)
- `test-driven-development` (Implement)
- `subagent-driven-development` + `systematic-debugging` (all fix loops)
- `verification-before-completion` (pre-PR sanity)
- `wp-plugin-security-review`, `playwright-cli` (Review / QA)

Deliberately excluded: `brainstorming` and `executing-plans` (human-dialogue / checkpoint skills — incompatible with a no-pause run).

## 9. Testing the system itself

1. **Script-level:** `--dry-run` and `--scenarios=1` smoke runs to validate wiring.
2. **Component probes** for the two real unknowns, in isolation: (a) Playground boots with the Sydney worktree mounted + Blueprint applied, and `playwright-cli` can drive it; (b) the worktree + symlink setup survives `composer test` and `npm run styles`.
3. **Acceptance:** one end-to-end run on a sacrificial real issue; inspect the draft PR; delete it.
4. **Tuning loop:** prompts are committed files and the workflow is resumable — edit a phase prompt, resume from cache, only that phase re-runs.

## 10. Out of scope (addable later without redesign)

- Merging (always human).
- Any use of `sydney.local` or other persistent environments.
- Elementor Pro / cloud-template / network-dependent QA scenarios (Playground sandboxes outbound traffic).
- Scheduled or cron triggering (the cron case is "call the same skill from `/loop`").
- Multi-issue batch mode.
