# /sydney-dev Autonomous Issue Developer Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Build `/sydney-dev <issue>` — a skill + Workflow script that autonomously develops a Sydney GitHub issue from plan to draft PR with no pauses and no merge.

**Architecture:** A thin main-loop skill (`SKILL.md`) does fail-fast preflight, writes `issue-context.json`, and launches one background Workflow (`workflow.js`) whose phases run as isolated `agent()` calls communicating through per-issue state files in `.sydney-dev-tmp/<issue>/`. Implementation happens in a git worktree at `../../.sydney-dev-worktrees/issue-<n>/` with deps symlinked from the main checkout. QA boots an ephemeral WP Playground mounting the worktree.

**Tech Stack:** Claude Code skill + Workflow script (plain JS), bash (`gh`, `git worktree`), `npx @wp-playground/cli`, `playwright-cli` skill, Zenhub MCP, existing superpowers skills.

**Spec:** `docs/superpowers/specs/2026-06-10-sydney-dev-autonomous-developer-design.md`

---

## File structure

```
.claude/skills/sydney-dev/
├── SKILL.md                     # trigger skill: preflight + launch (Task 10)
├── workflow.js                  # all phases, caps, schemas (Task 9)
├── blueprint-template.json      # base Playground Blueprint (Task 3)
├── scan-secrets.sh              # pre-push secret guard (Task 2)
├── scan-secrets.test.sh         # its test (Task 2)
└── prompts/
    ├── plan.md                  # Task 5
    ├── implement.md             # Task 6
    ├── fix.md                   # Task 6
    ├── review-performance.md    # Task 7
    ├── review-smells.md         # Task 7
    ├── review-dx.md             # Task 7
    ├── review-security.md       # Task 7
    ├── review-conventions.md    # Task 7
    ├── qa-plan.md               # Task 8
    ├── qa-execute.md            # Task 8
    └── qa-report.md             # Task 8
.gitignore                       # + .sydney-dev-tmp/ (Task 1)
```

Branch/PR/Reflect phase prompts are short and mechanical — they live inline in `workflow.js` (per spec §5.2/5.6/5.7 "script step + small agent").

---

### Task 1: Branch + scaffold

**Files:**
- Modify: `.gitignore`
- Create: `.claude/skills/sydney-dev/prompts/` (directory)

- [ ] **Step 1: Create the feature branch from develop**

```bash
git fetch origin develop
git checkout -b feature/sydney-dev-skill origin/develop
```

- [ ] **Step 2: Add temp dir to .gitignore**

Append to `.gitignore` (after the existing ignore entries):

```
.sydney-dev-tmp/
```

- [ ] **Step 3: Create the skill directory skeleton**

```bash
mkdir -p .claude/skills/sydney-dev/prompts
```

- [ ] **Step 4: Verify and commit**

Run: `git status --short`
Expected: `M .gitignore` only (empty dirs aren't tracked).

```bash
git add .gitignore
git commit -m "chore(sydney-dev): scaffold skill directory, ignore run state"
```

---

### Task 2: scan-secrets.sh (test-first)

**Files:**
- Create: `.claude/skills/sydney-dev/scan-secrets.test.sh`
- Create: `.claude/skills/sydney-dev/scan-secrets.sh`

- [ ] **Step 1: Write the failing test**

Create `.claude/skills/sydney-dev/scan-secrets.test.sh`:

```bash
#!/usr/bin/env bash
# Tests for scan-secrets.sh. Builds a throwaway git repo, commits a clean base,
# then checks that secret-bearing diffs fail and clean diffs pass.
set -euo pipefail

SCRIPT="$(cd "$(dirname "$0")" && pwd)/scan-secrets.sh"
TMPDIR_T=$(mktemp -d)
trap 'rm -rf "$TMPDIR_T"' EXIT

fail() { echo "FAIL: $1" >&2; exit 1; }

cd "$TMPDIR_T"
git init -q -b develop
git config user.email t@t.t && git config user.name t
echo "hello" > clean.txt
git add . && git commit -qm base
git checkout -qb feature/x

# Case 1: clean diff passes
echo "more clean content" >> clean.txt
git commit -qam clean
bash "$SCRIPT" develop || fail "clean diff should pass"

# Case 2: AWS key fails
echo 'aws_key = "AKIAIOSFODNN7EXAMPLE"' > leak.txt
git add . && git commit -qm leak
bash "$SCRIPT" develop && fail "AWS key should be caught" || true

# Case 3: private key block fails
git checkout -qb feature/y develop
printf -- '-----BEGIN RSA PRIVATE KEY-----\nabc\n' > key.pem
git add . && git commit -qm key
bash "$SCRIPT" develop && fail "private key should be caught" || true

# Case 4: GitHub token fails
git checkout -qb feature/z develop
echo "token: ghp_0123456789012345678901234567890abcde" > tok.txt
git add . && git commit -qm tok
bash "$SCRIPT" develop && fail "ghp_ token should be caught" || true

echo "OK: all scan-secrets tests passed"
```

- [ ] **Step 2: Run test to verify it fails**

Run: `bash .claude/skills/sydney-dev/scan-secrets.test.sh`
Expected: FAIL — `scan-secrets.sh: No such file or directory`

- [ ] **Step 3: Write the implementation**

Create `.claude/skills/sydney-dev/scan-secrets.sh`:

```bash
#!/usr/bin/env bash
# Pre-push secret guard for sydney-dev. Scans ADDED lines in the diff
# <base>...HEAD for common credential patterns. Exit 1 on any hit.
# Usage: scan-secrets.sh [base-ref]   (default: origin/develop)
set -euo pipefail

BASE="${1:-origin/develop}"

PATTERNS='-----BEGIN [A-Z ]*PRIVATE KEY-----|AKIA[0-9A-Z]{16}|ghp_[A-Za-z0-9]{36}|github_pat_[A-Za-z0-9_]{22,}|sk-[A-Za-z0-9]{20,}|xox[bporas]-[A-Za-z0-9-]{10,}|AIza[0-9A-Za-z_-]{35}'

ADDED=$(git diff "$BASE"...HEAD | grep '^+' | grep -v '^+++' || true)

if printf '%s\n' "$ADDED" | grep -qE "$PATTERNS"; then
	echo "✗ Potential secret detected in diff vs $BASE:" >&2
	printf '%s\n' "$ADDED" | grep -nE "$PATTERNS" >&2
	exit 1
fi

echo "✓ No secrets detected in diff vs $BASE"
```

```bash
chmod +x .claude/skills/sydney-dev/scan-secrets.sh .claude/skills/sydney-dev/scan-secrets.test.sh
```

- [ ] **Step 4: Run test to verify it passes**

Run: `bash .claude/skills/sydney-dev/scan-secrets.test.sh`
Expected: `OK: all scan-secrets tests passed`

- [ ] **Step 5: Commit**

```bash
git add .claude/skills/sydney-dev/scan-secrets.sh .claude/skills/sydney-dev/scan-secrets.test.sh
git commit -m "feat(sydney-dev): pre-push secret scan guard with tests"
```

---

### Task 3: Blueprint template + Playground boot probe

This task verifies the riskiest external dependency (Playground CLI flags change between versions) and locks the working invocation into the blueprint + a comment.

**Files:**
- Create: `.claude/skills/sydney-dev/blueprint-template.json`

- [ ] **Step 1: Write the base blueprint**

Create `.claude/skills/sydney-dev/blueprint-template.json`:

```json
{
	"$schema": "https://playground.wordpress.net/blueprint-schema.json",
	"preferredVersions": { "php": "8.2", "wp": "latest" },
	"features": { "networking": true },
	"login": true,
	"steps": [
		{ "step": "activateTheme", "themeFolderName": "sydney" },
		{
			"step": "setSiteOptions",
			"options": { "blogname": "Sydney Dev QA", "blogdescription": "Ephemeral QA instance" }
		}
	]
}
```

The Plan phase copies this to `.sydney-dev-tmp/<issue>/blueprint.json` and appends issue-specific steps (options, content, plugins).

- [ ] **Step 2: Probe — boot Playground with the theme mounted**

The main checkout stands in for a worktree here (identical layout). Compiled CSS must exist first:

```bash
npm run styles
npx @wp-playground/cli@latest server \
  --port=9410 \
  --mount=.:/wordpress/wp-content/themes/sydney \
  --blueprint=.claude/skills/sydney-dev/blueprint-template.json &
PG_PID=$!
for i in $(seq 1 30); do curl -sf http://127.0.0.1:9410/ > /dev/null && break; sleep 1; done
curl -s http://127.0.0.1:9410/ | grep -io "sydney" | head -1
kill $PG_PID
```

Expected: `sydney` (the front page renders with the mounted theme active).

**If the flags differ in the current CLI version** (check `npx @wp-playground/cli@latest server --help`): adjust the invocation until the probe passes, then record the working flags in a comment at the top of `blueprint-template.json` — `workflow.js` Task 9 and `qa-execute.md` Task 8 use this exact invocation. JSON has no comments, so put it in a sibling note: append the working command as a `"_bootCommand"` string property in the template root (Playground ignores unknown root keys; if it errors on them, put the command in `prompts/qa-execute.md` instead during Task 8).

- [ ] **Step 3: Commit**

```bash
git add .claude/skills/sydney-dev/blueprint-template.json
git commit -m "feat(sydney-dev): base Playground blueprint, boot probe verified"
```

---

### Task 4: Worktree + symlink probe (throwaway, no files committed)

Verifies spec §5.2's symlink strategy survives the real toolchain before we encode it in prompts.

**Files:** none committed — pure verification.

- [ ] **Step 1: Create a probe worktree with symlinked deps**

```bash
MAIN=$(pwd)
git fetch origin develop
git worktree add ../../.sydney-dev-worktrees/probe origin/develop
ln -s "$MAIN/node_modules" ../../.sydney-dev-worktrees/probe/node_modules
ln -s "$MAIN/vendor" ../../.sydney-dev-worktrees/probe/vendor
```

- [ ] **Step 2: Run the test + build toolchain inside the worktree**

```bash
cd ../../.sydney-dev-worktrees/probe
composer test 2>&1 | tail -5
npm run styles 2>&1 | tail -5
ls css/modules/*.css | head -3
cd "$MAIN"
```

Expected: PHPUnit summary line (`OK` or test counts), Gulp styles task completes, compiled CSS files exist **inside the worktree** (not the main checkout — confirms Gulp writes locally while reading deps through the symlink).

**If either fails:** diagnose before proceeding — this invalidates the symlink contract in the spec. Likely culprits: a tool resolving `realpath` and escaping the worktree, or a hardcoded path in `wpgulp.config.js`. Fix the approach (fall back to `cp -Rc` APFS clone of the dep dirs) and update spec §5.2 + the Task 6 implement prompt accordingly.

- [ ] **Step 3: Clean up the probe**

```bash
git worktree remove --force ../../.sydney-dev-worktrees/probe
git worktree prune
```

Expected: `git worktree list` shows only the main checkout.

---

### Task 5: Plan phase prompt

**Files:**
- Create: `.claude/skills/sydney-dev/prompts/plan.md`

- [ ] **Step 1: Write the prompt**

Create `.claude/skills/sydney-dev/prompts/plan.md`:

````markdown
# Phase: Plan

You are the planning phase of the sydney-dev autonomous pipeline. Non-interactive: never ask questions; make the best call and record it. Your caller passed you: ISSUE, REPO, TMP, SKILL_DIR.

## Inputs
- `TMP/issue-context.json` — issue title, body, labels, comments.
- The Sydney theme codebase at REPO (read-only for you).
- `SKILL_DIR/blueprint-template.json` — base Playground blueprint.

## Steps

1. Read `TMP/issue-context.json`. Read the codebase areas it implicates (use Grep/Glob; follow `CLAUDE.md` architecture notes).
2. Classify the issue:
   - Labels `bug` → `bug`; labels `enhancement`/`feature`/`feature request` → `enhancement`; otherwise judge from the body (broken existing behavior = bug).
3. Decide testability:
   - `unit` if the change is PHP logic mockable with WP_Mock (filters, sanitization, class methods).
   - `qa-as-test` if it's SCSS, templates, Customizer output, or anything needing a rendered page.
4. Write `TMP/plan.md` with EXACTLY these sections:
   - `## Summary` — 2-3 sentences.
   - `## Classification` — `bug` or `enhancement`, one line of justification.
   - `## Testability` — `unit` or `qa-as-test`, one line of justification.
   - `## Implementation steps` — numbered, function-level: exact files, functions/hooks to touch, what changes. CSS pipeline (verified): main styles are hand-edited in `css/styles.css` (the SOURCE — gulp only autoprefixes/minifies it); the theme enqueues `css/styles.min.css`, so a style change must include `npx gulp mainStyles stylesMin` output, both files committed. WooCommerce styles: edit `woocommerce/css/src/*.scss`, then `npx gulp wooStyles wooStylesMin`. Never hand-edit any `*.min.css`.
   - `## Reproduction / Success criteria` — concrete and runnable. For a bug: numbered steps that exhibit the broken behavior on a rendered page (URL path, element selector, expected vs actual). For an enhancement: numbered acceptance checks. These become QA scenarios verbatim — write them so a browser-driving agent can follow them without reading anything else.
   - `## Risk areas` — adjacent surfaces the change could break (the QA planner reads this).
5. Write `TMP/blueprint.json`: copy `SKILL_DIR/blueprint-template.json`, then append the Blueprint steps needed to exhibit this issue (e.g. `setSiteOptions` for required theme_mods via `wp-cli` step or options, `importWxr`/`runPHP` for demo content, additional plugins via `installPlugin`). Keep it minimal — only what the success criteria need. Remember Playground sandboxes outbound network: never depend on fetching remote resources at QA time except via Blueprint-supported resource URLs.
6. Write `TMP/plan-status.json`: `{ "status": "planned" }`.

## Return (structured output)
- `classification`: "bug" | "enhancement"
- `testable`: "unit" | "qa-as-test"
- `planPath`, `blueprintPath`: the files you wrote
- `summary`: one sentence
````

- [ ] **Step 2: Verify and commit**

Run: `test -s .claude/skills/sydney-dev/prompts/plan.md && echo ok`
Expected: `ok`

```bash
git add .claude/skills/sydney-dev/prompts/plan.md
git commit -m "feat(sydney-dev): plan phase prompt"
```

---

### Task 6: Implement + fix prompts

**Files:**
- Create: `.claude/skills/sydney-dev/prompts/implement.md`
- Create: `.claude/skills/sydney-dev/prompts/fix.md`

- [ ] **Step 1: Write the implement prompt**

Create `.claude/skills/sydney-dev/prompts/implement.md`:

````markdown
# Phase: Implement

You implement the plan inside a git worktree. Non-interactive. Caller passed: ISSUE, TMP, WORKTREE, REPO.

## Hard rules
1. Work ONLY in WORKTREE. Never touch REPO's files.
2. `node_modules` and `vendor` in the worktree are SYMLINKS to the main checkout — read-only by contract. If your change requires modifying `package-lock.json` or `composer.lock`: first remove the affected symlink and do a real install in the worktree (`rm node_modules && npm ci`, or `rm vendor && composer install`). Never write through the symlink.
3. Follow the repo's `CLAUDE.md` for tabs, `sydney_` prefix, text domain `'sydney'`, surgical changes only. CSS pipeline (CLAUDE.md is STALE here — this is the verified reality): main styles are hand-edited in `css/styles.css`; the theme enqueues `css/styles.min.css`. If you change `css/styles.css`, you MUST run `npx gulp mainStyles stylesMin` and commit both files, or your change is invisible at runtime. WooCommerce styles: edit `woocommerce/css/src/*.scss` then `npx gulp wooStyles wooStylesMin`. Never hand-edit `*.min.css`.
4. ONE commit at the end (later phases amend it). No `Co-Authored-By` trailer.

## Steps
1. Verify `TMP/plan-status.json` has `status: "planned"`; else return `status: "blocked"` with the reason.
2. Read `TMP/plan.md`. Use the **superpowers:test-driven-development** skill:
   - Testability `unit`: write the failing WP_Mock test in `tests/unit/` first (extend `Sydney\Tests\BaseThemeTest`), see it fail, implement minimally, see it pass.
   - Testability `qa-as-test`: no artificial unit test. Implement against the Success criteria; the QA phase is your failing→passing check.
3. Gates (run from WORKTREE):
   - `composer test` — all unit tests.
   - `composer phpcs` — coding standards (`composer phpcs:fix` first for auto-fixables).
4. Commit: `git add -A && git commit -m "<type>(#ISSUE): <summary>"` where type is fix/feat per classification.
5. Generate review artifacts for the next phase:
   - `git diff origin/develop...HEAD > TMP/review-diff.patch`
   - `git diff --name-only origin/develop...HEAD > TMP/changed-files.txt`
6. Write `TMP/implement-status.json`: `{ "status": "implemented", "branch": "<branch>", "commit": "<sha>", "testsPass": <bool>, "phpcsPass": <bool> }`. Report gate results HONESTLY — a red gate with `status: "implemented"` is valid; the caller runs a bounded fix loop.

## Return (structured output)
- `status`: "implemented" | "blocked"
- `testsPass`, `phpcsPass`: booleans (honest)
- `commit`: sha
- `notes`: one line on anything unusual (lockfile install, skipped test rationale), else null
````

- [ ] **Step 2: Write the fix prompt**

Create `.claude/skills/sydney-dev/prompts/fix.md`:

````markdown
# Sub-agent: Fix

You fix ONE specific set of failures in the worktree. Non-interactive. Caller passed: TMP, WORKTREE, and a FAILURES block (verbatim error output, failing check name, or review findings JSON).

## Hard rules
1. Work ONLY in WORKTREE. Deps are symlinks — read-only (see implement.md rule 2 if a lockfile change is unavoidable).
2. Stay within the files already in the diff (`TMP/changed-files.txt`) plus test files. Do not expand scope.
3. Verify with ONLY the specific failing check — the single test method, the one PHPCS sniff on the one file, the one review finding. NEVER run the full suite; the caller re-runs full gates itself.
4. Use the **superpowers:systematic-debugging** skill for test failures: read the error, form a hypothesis, confirm, fix the root cause — not the symptom.
5. Amend, don't add: `git add -A && git commit --amend --no-edit`.
6. Refresh the diff artifacts after amending:
   - `git diff origin/develop...HEAD > TMP/review-diff.patch`
   - `git diff --name-only origin/develop...HEAD > TMP/changed-files.txt`

## Return (structured output)
- `fixed`: boolean (did your targeted check pass?)
- `whatChanged`: one line
````

- [ ] **Step 3: Verify and commit**

Run: `test -s .claude/skills/sydney-dev/prompts/implement.md && test -s .claude/skills/sydney-dev/prompts/fix.md && echo ok`
Expected: `ok`

```bash
git add .claude/skills/sydney-dev/prompts/implement.md .claude/skills/sydney-dev/prompts/fix.md
git commit -m "feat(sydney-dev): implement and fix phase prompts"
```

---

### Task 7: Five review prompts

**Files:**
- Create: `.claude/skills/sydney-dev/prompts/review-performance.md`
- Create: `.claude/skills/sydney-dev/prompts/review-smells.md`
- Create: `.claude/skills/sydney-dev/prompts/review-dx.md`
- Create: `.claude/skills/sydney-dev/prompts/review-security.md`
- Create: `.claude/skills/sydney-dev/prompts/review-conventions.md`

All five share the same contract (budget, scope, output); each has a distinct focus section. The shared boilerplate is repeated in full in each file so a reviewer agent needs exactly one file.

- [ ] **Step 1: Write review-performance.md**

````markdown
# Reviewer: Performance

Read-only reviewer. Caller passed: TMP, WORKTREE. Review ONLY the changed lines in `TMP/review-diff.patch` and their immediate file context (files listed in `TMP/changed-files.txt`, open in WORKTREE).

## Budget (hard limit)
At most ~10 tool calls total. Do NOT grep the wider codebase, do NOT chase hypotheticals beyond the diff. If you can't confirm something in budget, record it as severity `info` titled "unverified — needs human check". You MUST finish within budget.

## Focus
- Queries inside loops; `WP_Query` without `no_found_rows`/field limits where applicable; unbounded `get_posts`.
- Uncached repeated `get_option`/`get_theme_mod` calls in template loops.
- Assets enqueued on every page that are needed on one; missing `wp_enqueue_*` conditionals.
- SCSS that compiles to pathologically broad selectors; layout thrash in JS (reads after writes in loops).
- Transient/object-cache opportunities ONLY if the diff adds expensive repeated work.

## Output
Write `TMP/review-perf.md`: a `### Findings` section (or "No findings"), one `####` per finding with file:line, why it matters, suggested fix. If `TMP/last-error.log` exists, do not re-flag anything already in it.

## Return (structured output)
- `findings`: array of `{ "severity": "critical|high|medium|low|info", "title": "...", "file": "...", "line": <int|null>, "detail": "one-line" }`. Empty array if none.
Calibrate: critical/high = merge-blocking defect; medium = real but non-blocking; low/info = style/nice-to-have. NEVER inflate a nit above low.
````

- [ ] **Step 2: Write review-smells.md**

````markdown
# Reviewer: Code Smells

Read-only reviewer. Caller passed: TMP, WORKTREE. Review ONLY the changed lines in `TMP/review-diff.patch` and their immediate file context (files listed in `TMP/changed-files.txt`, open in WORKTREE).

## Budget (hard limit)
At most ~10 tool calls total. Do NOT grep the wider codebase, do NOT chase hypotheticals beyond the diff. If you can't confirm something in budget, record it as severity `info` titled "unverified — needs human check". You MUST finish within budget.

## Focus
- Logic bugs: inverted conditions, off-by-one, wrong hook priority/argument count, missing `isset`/null guards on array access.
- Duplication introduced by the diff (copy-paste of an existing helper instead of calling it — check only files in the diff's vicinity).
- Dead code, unused variables/imports the change introduced.
- State leaks: missing `wp_reset_postdata`, filters added but never removed where pairing is expected.
- Behavior changes wider than the issue's scope (the diff touches things the plan didn't call for).

## Output
Write `TMP/review-smells.md`: a `### Findings` section (or "No findings"), one `####` per finding with file:line, why it matters, suggested fix. If `TMP/last-error.log` exists, do not re-flag anything already in it.

## Return (structured output)
- `findings`: array of `{ "severity": "critical|high|medium|low|info", "title": "...", "file": "...", "line": <int|null>, "detail": "one-line" }`. Empty array if none.
Calibrate: critical/high = merge-blocking defect; medium = real but non-blocking; low/info = style/nice-to-have. NEVER inflate a nit above low.
````

- [ ] **Step 3: Write review-dx.md**

````markdown
# Reviewer: DX / Readability

Read-only reviewer. Caller passed: TMP, WORKTREE. Review ONLY the changed lines in `TMP/review-diff.patch` and their immediate file context (files listed in `TMP/changed-files.txt`, open in WORKTREE).

## Budget (hard limit)
At most ~10 tool calls total. Do NOT grep the wider codebase, do NOT chase hypotheticals beyond the diff. If you can't confirm something in budget, record it as severity `info` titled "unverified — needs human check". You MUST finish within budget.

## Focus
- Misleading names (a function/variable whose name contradicts what the diff makes it do).
- Comments that restate code or have drifted from the change; missing PHPDoc on NEW public functions only.
- Deep nesting introduced where an early return reads better.
- Magic numbers/strings the diff adds that deserve a named constant ONLY if the codebase already uses constants nearby.
- Does the diff read like the surrounding Sydney code (match, don't impose preferences)?

## Output
Write `TMP/review-dx.md`: a `### Findings` section (or "No findings"), one `####` per finding with file:line, why it matters, suggested fix. If `TMP/last-error.log` exists, do not re-flag anything already in it.

## Return (structured output)
- `findings`: array of `{ "severity": "critical|high|medium|low|info", "title": "...", "file": "...", "line": <int|null>, "detail": "one-line" }`. Empty array if none.
Calibrate: critical/high = merge-blocking defect; medium = real but non-blocking; low/info = style/nice-to-have. Readability findings are almost always low/info — NEVER inflate a nit above low.
````

- [ ] **Step 4: Write review-security.md**

````markdown
# Reviewer: Security

Read-only reviewer. Use the **wp-plugin-security-review** skill's methodology applied to a theme diff. Caller passed: TMP, WORKTREE. Review ONLY the changed lines in `TMP/review-diff.patch` and their immediate file context (files listed in `TMP/changed-files.txt`, open in WORKTREE).

## Budget (hard limit)
At most ~10 tool calls total. Do NOT grep the wider codebase, do NOT chase hypotheticals beyond the diff. If you can't confirm something in budget, record it as severity `info` titled "unverified — needs human check". You MUST finish within budget.

## Focus
- Output escaping: every echoed variable the diff adds/moves (`esc_html`, `esc_attr`, `esc_url`, `wp_kses_post` — correct one for context).
- Input handling: `$_GET`/`$_POST`/`$_REQUEST` without sanitization; missing nonce/capability checks on any new admin/AJAX action.
- SQL: anything not through `$wpdb->prepare()` or WP APIs.
- File ops: path traversal, unvalidated includes.
- Customizer: `sanitize_callback` present on any new setting.

## Output
Write `TMP/review-security.md`: a `### Findings` section (or "No findings"), one `####` per finding with file:line, why it matters, suggested fix. If `TMP/last-error.log` exists, do not re-flag anything already in it.

## Return (structured output)
- `findings`: array of `{ "severity": "critical|high|medium|low|info", "title": "...", "file": "...", "line": <int|null>, "detail": "one-line" }`. Empty array if none.
Calibrate: critical/high = exploitable or missing-escape-on-user-data; medium = defense-in-depth gap; low/info = hardening suggestion. NEVER inflate.
````

- [ ] **Step 5: Write review-conventions.md**

````markdown
# Reviewer: Sydney Conventions

Read-only reviewer. Caller passed: TMP, WORKTREE. Review ONLY the changed lines in `TMP/review-diff.patch` and their immediate file context (files listed in `TMP/changed-files.txt`, open in WORKTREE).

## Budget (hard limit)
At most ~10 tool calls total. Do NOT grep the wider codebase, do NOT chase hypotheticals beyond the diff. If you can't confirm something in budget, record it as severity `info` titled "unverified — needs human check". You MUST finish within budget.

## Focus
- Prefix: all new functions/constants/hooks use `sydney_` (hooks: `sydney_action_name` / `sydney_filter_name`).
- i18n: text domain is exactly `'sydney'` on every new translatable string; no variable text domains; translators comments on placeholders.
- Indentation: tabs, not spaces, in PHP.
- Minified pairing (the CSS pipeline: `css/styles.css` is the hand-edited source, gulp generates the enqueued `styles.min.css`): a `*.min.css` hunk with NO corresponding source hunk (`css/styles.css` or `woocommerce/css/src/*.scss`) = HIGH (hand-edited min file). A `css/styles.css` hunk with NO regenerated `styles.min.css` = HIGH (change invisible at runtime — theme enqueues the min file).
- Customizer: pure WP Customizer API only — flag any new Kirki control usage as HIGH (Kirki is legacy-only in this repo).
- Module guards: features inside `inc/modules/` check `Sydney_Modules::is_module_active()`.
- PHP 7.2 compatibility: no syntax/functions requiring PHP 7.3+.

## Output
Write `TMP/review-conventions.md`: a `### Findings` section (or "No findings"), one `####` per finding with file:line, why it matters, suggested fix. If `TMP/last-error.log` exists, do not re-flag anything already in it.

## Return (structured output)
- `findings`: array of `{ "severity": "critical|high|medium|low|info", "title": "...", "file": "...", "line": <int|null>, "detail": "one-line" }`. Empty array if none.
Calibrate: critical/high = breaks release/build/compat (compiled-file edits, Kirki additions, PHP-compat); medium = prefix/i18n misses; low/info = style. NEVER inflate.
````

- [ ] **Step 6: Verify and commit**

Run: `ls .claude/skills/sydney-dev/prompts/review-*.md | wc -l`
Expected: `5`

```bash
git add .claude/skills/sydney-dev/prompts/review-*.md
git commit -m "feat(sydney-dev): five review-angle prompts"
```

---

### Task 8: QA prompts

**Files:**
- Create: `.claude/skills/sydney-dev/prompts/qa-plan.md`
- Create: `.claude/skills/sydney-dev/prompts/qa-execute.md`
- Create: `.claude/skills/sydney-dev/prompts/qa-report.md`

- [ ] **Step 1: Write qa-plan.md**

````markdown
# Phase: QA Plan

You design browser test scenarios. Non-interactive. Caller passed: ISSUE, TMP, SCENARIO_CAP (integer or "none").

## Steps
1. Read `TMP/plan.md` (Reproduction / Success criteria + Risk areas) and `TMP/changed-files.txt`.
2. Write `TMP/qa-plan.md` as a numbered scenario list. Scenario 1 is ALWAYS the issue's own reproduction/acceptance check, copied from the plan's Success criteria. Then add scenarios for each risk area and each distinct surface the diff touches (map changed templates/SCSS/JS to the pages that render them — e.g. header SCSS → front page + a single post; archive template → blog page).
3. Each scenario: a name, the URL path to load, numbered browser steps, and an unambiguous pass condition (element exists/style applies/no console error). A browser-driving agent must be able to execute it without reading anything else.
4. Every scenario implicitly includes: zero browser console errors, zero PHP notices/warnings/fatals in the page HTML.
5. If SCENARIO_CAP is a number, keep Scenario 1 plus the (CAP-1) highest-risk others; list the dropped ones under `## Dropped (capped)` so the report can disclose them.
6. Write `TMP/qa-plan-status.json`: `{ "status": "qa-planned", "count": <n> }`.

## Return (structured output)
- `scenarioCount`: integer (post-cap)
- `dropped`: integer (0 if uncapped)
````

- [ ] **Step 2: Write qa-execute.md**

````markdown
# Phase: QA Execute

You run browser scenarios against an ephemeral WP Playground. Non-interactive. Caller passed: ISSUE, TMP, WORKTREE, PORT, ONLY (either "all" or a comma-separated scenario-number list for re-runs).

## Boot (you own the server lifecycle)
1. No build step needed: compiled/minified CSS is committed, and the implement phase regenerates min files when it touches styles. (Sanity check only: if `git -C WORKTREE diff origin/develop...HEAD --name-only` shows `css/styles.css` but NOT `css/styles.min.css`, the implement phase broke the pairing rule — note it in qa-results and continue; the theme enqueues the min file so the change may be invisible.)
2. Boot Playground in the background (this exact invocation is probe-verified):
   `npx @wp-playground/cli@latest server --port=PORT --mount=WORKTREE:/wordpress/wp-content/themes/sydney --blueprint=TMP/blueprint.json`
3. Health-check: poll `curl -s -o /dev/null -w "%{http_code}" http://127.0.0.1:PORT/` up to 30×1s; **200 or 302 both mean healthy** (Playground auto-login responds 302 + Set-Cookie; bare curl without a cookie jar loops on it, but playwright-cli holds cookies so browsing works normally). If it never answers: kill, retry the boot ONCE. If still dead, write `TMP/qa-exec-status.json` `{ "status": "not-executed", "reason": "playground-boot-failed" }` and return honestly — do NOT fabricate results.

## Execute
4. Read `TMP/qa-plan.md`. For each scenario in ONLY (or all): use the **playwright-cli** skill to drive `http://127.0.0.1:PORT`. Follow the scenario steps exactly. Capture per scenario into `TMP/evidence/`:
   - `scenario-<n>.png` screenshot at the pass-condition moment,
   - `scenario-<n>-console.txt` browser console errors (empty file = clean),
   - any PHP notice/warning/fatal text found in the page HTML.
5. A scenario passes only if its pass condition holds AND console + PHP are clean. Record per-scenario verdicts in `TMP/qa-results.md` (scenario name, pass/fail, evidence file names, one-line failure reason).

## Teardown
6. Kill the Playground process. Always — even on failure.
7. Write `TMP/qa-exec-status.json`: `{ "status": "executed", "passed": <n>, "failed": <n>, "failedScenarios": [<numbers>] }`.

## Return (structured output)
- `status`: "executed" | "not-executed"
- `passed`, `failed`: integers
- `failedScenarios`: array of scenario numbers (empty if none)
````

- [ ] **Step 3: Write qa-report.md**

````markdown
# Phase: QA Report

You review the QA evidence and write the final QA report. Non-interactive. Caller passed: ISSUE, TMP.

## Steps
1. Read `TMP/qa-plan.md`, `TMP/qa-results.md`, `TMP/qa-exec-status.json`, and spot-check evidence files in `TMP/evidence/` (open at least the screenshots of Scenario 1 and every failed scenario — verify the recorded verdict matches what the screenshot actually shows; flag any mismatch as a finding).
2. Write `TMP/qa-report.md`:
   - `## Verdict` — one line: `N/M scenarios passed` (or `not-executed: <reason>`).
   - `## Scenario results` — table: #, name, pass/fail, evidence file.
   - `## Issue resolution` — does Scenario 1 (the issue's own check) demonstrably pass? Bug: "reproduction no longer occurs" or honest failure. Enhancement: acceptance met or not.
   - `## Dropped scenarios` — from qa-plan's capped list, if any.
   - `## Observations` — anything the evidence shows that scenarios didn't formalize (visual glitches, slow loads).
3. Write `TMP/qa-status.json`: `{ "status": "qa-done", "verdict": "<pass|partial|fail|not-executed>" }`.

## Return (structured output)
- `verdict`: "pass" | "partial" | "fail" | "not-executed"
- `summary`: one line for the PR body
````

- [ ] **Step 4: Verify and commit**

Run: `ls .claude/skills/sydney-dev/prompts/qa-*.md | wc -l`
Expected: `3`

```bash
git add .claude/skills/sydney-dev/prompts/qa-*.md
git commit -m "feat(sydney-dev): QA plan/execute/report prompts"
```

---

### Task 9: workflow.js

**Files:**
- Create: `.claude/skills/sydney-dev/workflow.js`

- [ ] **Step 1: Write the workflow script**

Create `.claude/skills/sydney-dev/workflow.js`:

```js
export const meta = {
	name: 'sydney-dev',
	description: 'Autonomous Sydney issue developer: plan → branch → TDD implement → 5-angle review → Playground QA → draft PR → reflect',
	phases: [
		{ title: 'Plan' },
		{ title: 'Branch' },
		{ title: 'Implement' },
		{ title: 'Review', model: 'sonnet' },
		{ title: 'QA', model: 'sonnet' },
		{ title: 'PR', model: 'haiku' },
		{ title: 'Reflect', model: 'haiku' },
	],
}

// args (all paths absolute, provided by SKILL.md preflight):
// { issue, scenarios|null, dryRun, repo, tmp, worktree, skillDir, qaPort }
const { issue, scenarios = null, dryRun = false, repo, tmp, worktree, skillDir, qaPort = 9410 } = args
const P = `${skillDir}/prompts`
const CTX = `ISSUE=${issue}\nREPO=${repo}\nTMP=${tmp}\nWORKTREE=${worktree}\nSKILL_DIR=${skillDir}`

// ---------- schemas ----------
const PLAN_SCHEMA = {
	type: 'object',
	required: ['classification', 'testable', 'planPath', 'blueprintPath', 'summary'],
	properties: {
		classification: { enum: ['bug', 'enhancement'] },
		testable: { enum: ['unit', 'qa-as-test'] },
		planPath: { type: 'string' },
		blueprintPath: { type: 'string' },
		summary: { type: 'string' },
	},
}
const BRANCH_SCHEMA = {
	type: 'object',
	required: ['ok', 'branch'],
	properties: { ok: { type: 'boolean' }, branch: { type: 'string' }, error: { type: ['string', 'null'] } },
}
const IMPL_SCHEMA = {
	type: 'object',
	required: ['status', 'testsPass', 'phpcsPass', 'commit'],
	properties: {
		status: { enum: ['implemented', 'blocked'] },
		testsPass: { type: 'boolean' },
		phpcsPass: { type: 'boolean' },
		commit: { type: 'string' },
		notes: { type: ['string', 'null'] },
	},
}
const FIX_SCHEMA = {
	type: 'object',
	required: ['fixed'],
	properties: { fixed: { type: 'boolean' }, whatChanged: { type: 'string' } },
}
const REVIEW_SCHEMA = {
	type: 'object',
	required: ['findings'],
	properties: {
		findings: {
			type: 'array',
			items: {
				type: 'object',
				required: ['severity', 'title', 'file'],
				properties: {
					severity: { enum: ['critical', 'high', 'medium', 'low', 'info'] },
					title: { type: 'string' },
					file: { type: 'string' },
					line: { type: ['integer', 'null'] },
					detail: { type: 'string' },
				},
			},
		},
	},
}
const QAPLAN_SCHEMA = {
	type: 'object',
	required: ['scenarioCount', 'dropped'],
	properties: { scenarioCount: { type: 'integer' }, dropped: { type: 'integer' } },
}
const QAEXEC_SCHEMA = {
	type: 'object',
	required: ['status', 'passed', 'failed', 'failedScenarios'],
	properties: {
		status: { enum: ['executed', 'not-executed'] },
		passed: { type: 'integer' },
		failed: { type: 'integer' },
		failedScenarios: { type: 'array', items: { type: 'integer' } },
	},
}
const QAREPORT_SCHEMA = {
	type: 'object',
	required: ['verdict', 'summary'],
	properties: { verdict: { enum: ['pass', 'partial', 'fail', 'not-executed'] }, summary: { type: 'string' } },
}
const PR_SCHEMA = {
	type: 'object',
	required: ['ok', 'branchPushed'],
	properties: {
		ok: { type: 'boolean' },
		prUrl: { type: ['string', 'null'] },
		branchPushed: { type: 'boolean' },
		error: { type: ['string', 'null'] },
	},
}
const REFLECT_SCHEMA = { type: 'object', required: ['ok'], properties: { ok: { type: 'boolean' } } }

const ANGLES = [
	{ key: 'performance', out: 'review-perf.md' },
	{ key: 'smells', out: 'review-smells.md' },
	{ key: 'dx', out: 'review-dx.md' },
	{ key: 'security', out: 'review-security.md' },
	{ key: 'conventions', out: 'review-conventions.md' },
]
const ACTIONABLE = ['critical', 'high', 'medium']

// ---------- Phase 1: Plan ----------
phase('Plan')
const plan = await agent(
	`Read ${P}/plan.md and follow it exactly.\n${CTX}`,
	{ label: 'plan', schema: PLAN_SCHEMA }
)
if (!plan) return { aborted: 'Plan', reason: 'plan agent died — nothing was created' }
log(`Plan: ${plan.classification}, tests=${plan.testable} — ${plan.summary}`)
if (dryRun) return { dryRun: true, plan: plan.planPath, blueprint: plan.blueprintPath, summary: plan.summary }

// ---------- Phase 2: Branch ----------
phase('Branch')
const branchPrompt = [
	`You set up the working branch + worktree for Sydney issue #${issue}. Non-interactive.`,
	CTX,
	`1. cd REPO. Run: git fetch origin develop`,
	`2. Create the branch via: gh issue develop ${issue} --base develop --name "<prefix>/${issue}-<slug>" --checkout=false`,
	`   where <prefix> is "bugfix" for classification=${plan.classification === 'bug' ? 'bug' : 'enhancement'} → ${plan.classification === 'bug' ? 'bugfix' : 'feature'}, and the full name is ≤60 chars, kebab-case from the issue title.`,
	`3. git fetch origin "<branch>" && git worktree add "${worktree}" "<branch>"`,
	`4. Symlink deps into the worktree: ln -s "${repo}/node_modules" "${worktree}/node_modules" && ln -s "${repo}/vendor" "${worktree}/vendor"`,
	`5. Zenhub: load the zenhub MCP tools via ToolSearch, find issue #${issue} in this repo, move it to the "In Progress" pipeline. If Zenhub is unreachable, note it and continue — never block on it.`,
	`6. Write ${tmp}/branch-status.json: { "status": "branched", "branch": "<branch>" }`,
	`Return structured output: ok (boolean), branch (string), error (string|null, e.g. if the branch already existed).`,
].join('\n')
const br = await agent(branchPrompt, { label: 'branch', schema: BRANCH_SCHEMA })
if (!br || !br.ok) {
	return { aborted: 'Branch', reason: (br && br.error) || 'branch agent died', cleanup: 'check `git worktree list` for a half-created worktree' }
}
log(`Branch: ${br.branch}`)

// ---------- Phase 3: Implement (cap: 1 implement + up to 2 fixes = 3 iterations) ----------
phase('Implement')
let impl = await agent(
	`Read ${P}/implement.md and follow it exactly.\n${CTX}\nCLASSIFICATION=${plan.classification}\nTESTABLE=${plan.testable}`,
	{ label: 'implement', schema: IMPL_SCHEMA }
)
if (!impl || impl.status === 'blocked') {
	return { aborted: 'Implement', reason: (impl && impl.notes) || 'implement agent died', branch: br.branch, cleanup: `worktree preserved at ${worktree}` }
}
let implIters = 1
while ((!impl.testsPass || !impl.phpcsPass) && implIters < 3) {
	implIters++
	log(`Implement gates red (tests=${impl.testsPass} phpcs=${impl.phpcsPass}) — fix iteration ${implIters}/3`)
	const failing = !impl.testsPass ? 'composer test failures (read the last test output in the worktree)' : 'composer phpcs violations'
	const fix = await agent(
		`Read ${P}/fix.md and follow it exactly.\n${CTX}\nFAILURES:\n${failing}\nRe-run the failing gate yourself after fixing, then report honestly.`,
		{ label: `fix:gates-${implIters}`, schema: FIX_SCHEMA }
	)
	// Re-check gates via a minimal verifier agent (fix agents only run targeted checks)
	const recheck = await agent(
		`cd ${worktree}. Run "composer test" then "composer phpcs". Then run: git rev-parse HEAD. Report results honestly. Return structured output: status="implemented", testsPass, phpcsPass, commit=<current HEAD sha>, notes=null.`,
		{ label: `gates-recheck-${implIters}`, schema: IMPL_SCHEMA }
	)
	if (recheck) impl = recheck
	if (!fix) log('fix agent died; recheck recorded current state')
}
log(`Implement: tests=${impl.testsPass ? 'pass' : 'FAIL'} phpcs=${impl.phpcsPass ? 'pass' : 'FAIL'} after ${implIters} iteration(s)`)

// ---------- Phase 4: Review (5 angles parallel, remediation cap 2) ----------
phase('Review')
const runAngle = (a) =>
	agent(`Read ${P}/review-${a.key}.md and follow it exactly.\n${CTX}`, { label: `review:${a.key}`, phase: 'Review', schema: REVIEW_SCHEMA, model: 'sonnet' })

let reviewResults = await parallel(ANGLES.map((a) => () => runAngle(a)))
let findingsByAngle = ANGLES.map((a, i) => ({
	angle: a.key,
	findings: (reviewResults[i] && reviewResults[i].findings) || [],
}))

let remIters = 0
while (remIters < 2) {
	const actionable = findingsByAngle.flatMap((r) => r.findings.filter((f) => ACTIONABLE.includes(f.severity)).map((f) => ({ ...f, angle: r.angle })))
	if (actionable.length === 0) break
	remIters++
	log(`Review remediation ${remIters}/2: ${actionable.length} actionable finding(s)`)
	await agent(
		`Read ${P}/fix.md and follow it exactly.\n${CTX}\nFAILURES (review findings JSON):\n${JSON.stringify(actionable, null, 2)}\nResolve these without expanding scope beyond files already in the diff.`,
		{ label: `fix:review-${remIters}`, phase: 'Review', schema: FIX_SCHEMA, model: 'sonnet' }
	)
	const flaggedAngles = ANGLES.filter((a) => findingsByAngle.find((r) => r.angle === a.key).findings.some((f) => ACTIONABLE.includes(f.severity)))
	const rerun = await parallel(flaggedAngles.map((a) => () => runAngle(a)))
	flaggedAngles.forEach((a, i) => {
		const slot = findingsByAngle.find((r) => r.angle === a.key)
		slot.findings = (rerun[i] && rerun[i].findings) || []
	})
}
const unresolvedHigh = findingsByAngle.flatMap((r) => r.findings).filter((f) => ['critical', 'high'].includes(f.severity)).length
const advisory = findingsByAngle.flatMap((r) => r.findings).filter((f) => ['low', 'info'].includes(f.severity)).length
log(`Review: ${unresolvedHigh} unresolved critical/high, ${advisory} advisory`)

// ---------- Phase 5: QA ----------
phase('QA')
const qaPlan = await agent(
	`Read ${P}/qa-plan.md and follow it exactly.\n${CTX}\nSCENARIO_CAP=${scenarios === null ? 'none' : scenarios}`,
	{ label: 'qa-plan', schema: QAPLAN_SCHEMA, model: 'sonnet' }
)
let qaExec = null
if (qaPlan) {
	qaExec = await agent(
		`Read ${P}/qa-execute.md and follow it exactly.\n${CTX}\nPORT=${qaPort}\nONLY=all`,
		{ label: 'qa-execute', schema: QAEXEC_SCHEMA, model: 'sonnet' }
	)
	if (qaExec && qaExec.status === 'executed' && qaExec.failed > 0) {
		log(`QA: ${qaExec.failed} scenario(s) failed — one fix attempt`)
		await agent(
			`Read ${P}/fix.md and follow it exactly.\n${CTX}\nFAILURES:\nQA scenarios ${qaExec.failedScenarios.join(', ')} failed. Read ${tmp}/qa-results.md and the evidence files for those scenarios, fix the cause in the worktree.`,
			{ label: 'fix:qa', schema: FIX_SCHEMA, model: 'sonnet' }
		)
		const rerun = await agent(
			`Read ${P}/qa-execute.md and follow it exactly.\n${CTX}\nPORT=${qaPort}\nONLY=${qaExec.failedScenarios.join(',')}`,
			{ label: 'qa-execute:rerun', schema: QAEXEC_SCHEMA, model: 'sonnet' }
		)
		if (rerun && rerun.status === 'executed') {
			qaExec = {
				status: 'executed',
				passed: qaExec.passed + rerun.passed,
				failed: rerun.failed,
				failedScenarios: rerun.failedScenarios,
			}
		}
	}
}
const qaReport = await agent(
	`Read ${P}/qa-report.md and follow it exactly.\n${CTX}`,
	{ label: 'qa-report', schema: QAREPORT_SCHEMA, model: 'sonnet' }
)
const qaVerdict = qaReport ? qaReport.verdict : 'not-executed'
log(`QA: ${qaVerdict}${qaReport ? ' — ' + qaReport.summary : ''}`)

// ---------- Phase 6: PR (retry once) ----------
phase('PR')
const gateSummary = `tests=${impl.testsPass ? 'pass' : 'FAIL'} phpcs=${impl.phpcsPass ? 'pass' : 'FAIL'} review=${unresolvedHigh} critical/high unresolved, ${advisory} advisory; qa=${qaVerdict}`
const prPrompt = [
	`You open the draft PR for Sydney issue #${issue}. Non-interactive.`,
	CTX,
	`BRANCH=${br.branch}`,
	`GATES: ${gateSummary}`,
	`1. cd ${worktree}. Run the secret guard: bash ${skillDir}/scan-secrets.sh origin/develop — if it exits non-zero, DO NOT PUSH; return ok=false, branchPushed=false, error="secret-scan failed: <detail>".`,
	`2. git push -u origin "${br.branch}"`,
	`3. Build the PR body from: ${tmp}/plan.md (summary section), the review files (${ANGLES.map((a) => tmp + '/' + a.out).join(', ')}) listing unresolved critical/high first then advisory low/info, and ${tmp}/qa-report.md in full. Evidence screenshots live in ${tmp}/evidence/ — reference their filenames (they are local-only). If ANY gate is red, put a prominent "## ⚠ Failed gates" section at the TOP with honest detail. End the body with the line: 🤖 Autonomous sydney-dev run — review before merging.`,
	`4. gh pr create --draft --base develop --title "<type>(#${issue}): <issue title, shortened>" --body-file <body you write to ${tmp}/pr-body.md>`,
	`5. Add label: gh pr edit <num> --add-label needs-human-review (create the label first with gh label create if missing).`,
	`6. Zenhub: load zenhub MCP tools via ToolSearch, move issue #${issue} to "Review/QA". If unreachable, note and continue.`,
	`7. Write ${tmp}/pr-status.json: { "status": "pr-open", "url": "<url>" }`,
	`Return structured output: ok, prUrl, branchPushed, error.`,
].join('\n')
let pr = await agent(prPrompt, { label: 'pr', schema: PR_SCHEMA, model: 'haiku' })
if (!pr || !pr.ok) {
	log('PR attempt 1 failed — retrying once')
	pr = await agent(prPrompt + `\nThis is the RETRY. Previous error: ${(pr && pr.error) || 'agent died'}. Diagnose before repeating the same failure.`, { label: 'pr:retry', schema: PR_SCHEMA, model: 'haiku' })
}
if (!pr || !pr.ok) {
	// The one stranded state: preserve worktree, hand back manual commands.
	return {
		stranded: 'PR',
		reason: (pr && pr.error) || 'pr agent died twice',
		branch: br.branch,
		worktreePreserved: worktree,
		manualCommands: [
			`cd ${worktree}`,
			`bash ${skillDir}/scan-secrets.sh origin/develop`,
			`git push -u origin ${br.branch}`,
			`gh pr create --draft --base develop --fill`,
		],
		gates: gateSummary,
	}
}
log(`PR: ${pr.prUrl}`)

// ---------- Phase 7: Reflect + cleanup ----------
phase('Reflect')
const reflect = await agent(
	[
		`You are the reflect phase. Non-interactive.`,
		CTX,
		`BRANCH=${br.branch}`,
		`RUN FACTS: implement iterations=${implIters}, review remediations=${remIters}, qa=${qaVerdict}, gates: ${gateSummary}`,
		`1. cd ${worktree}. Append to MEMORY.md (create section if missing) an entry: "sydney-dev run, issue #${issue}" with What was decided / Why / What was rejected, drawn from ${tmp}/plan.md and the run facts. Keep it under 15 lines.`,
		`2. If any phase needed >2 attempts (implement iterations ≥3, or review remediation hit its cap, or QA fix ran): append an ERRORS.md entry — What didn't work / What worked instead / Note for next time. Otherwise skip ERRORS.md.`,
		`3. git add MEMORY.md ERRORS.md 2>/dev/null; git commit -m "docs(#${issue}): sydney-dev run reflection"; git push`,
		`4. Clean up: cd ${repo} && git worktree remove --force "${worktree}" && git worktree prune`,
		`Return structured output: ok (boolean).`,
	].join('\n'),
	{ label: 'reflect', schema: REFLECT_SCHEMA, model: 'haiku' }
)
if (!reflect || !reflect.ok) log('Reflect failed (non-fatal) — worktree may need manual removal: git worktree prune')

return {
	pr: pr.prUrl,
	branch: br.branch,
	gates: gateSummary,
	implementIterations: implIters,
	reviewRemediations: remIters,
	qa: qaVerdict,
}
```

- [ ] **Step 2: Verify it parses as valid JavaScript**

The Workflow runtime injects `args`/`agent`/`phase`/`log`/`parallel` and allows top-level await, so `node --check` can't validate it directly — wrap for a syntax check:

```bash
{ echo '(async function(args, agent, phase, log, parallel) {'; sed '1,/^}$/d' .claude/skills/sydney-dev/workflow.js; echo '})'; } > /tmp/wf-check.js
node --check /tmp/wf-check.js && echo "syntax ok"
```

(The `sed` strips the `export const meta = {...}` block — first line through the first lone `}`.)
Expected: `syntax ok`

- [ ] **Step 3: Sanity-check the meta block separately**

```bash
node -e "
const src = require('fs').readFileSync('.claude/skills/sydney-dev/workflow.js','utf8');
const metaSrc = src.slice(src.indexOf('{'), src.indexOf('\n}\n')+2);
const meta = eval('(' + metaSrc + ')');
console.assert(meta.name === 'sydney-dev', 'name');
console.assert(meta.phases.length === 7, 'phases');
console.log('meta ok:', meta.phases.map(p=>p.title).join(' → '));
"
```

Expected: `meta ok: Plan → Branch → Implement → Review → QA → PR → Reflect`

- [ ] **Step 4: Commit**

```bash
git add .claude/skills/sydney-dev/workflow.js
git commit -m "feat(sydney-dev): workflow script — 7 phases, caps, schemas"
```

---

### Task 10: SKILL.md (the /sydney-dev trigger)

**Files:**
- Create: `.claude/skills/sydney-dev/SKILL.md`

- [ ] **Step 1: Write the skill**

Create `.claude/skills/sydney-dev/SKILL.md`:

````markdown
---
name: sydney-dev
description: Use when asked to autonomously develop a Sydney GitHub issue end-to-end ("/sydney-dev 123", "run sydney-dev on issue N", "autonomously fix issue N"). Runs plan → branch → TDD implement → 5-angle review → WP Playground QA → draft PR with no pauses and no merge. Flags: --scenarios=N (QA smoke cap), --dry-run (stop after planning, create nothing).
---

# sydney-dev — Autonomous Issue Developer

You are the PREFLIGHT for an autonomous run. You run in the main loop — this is the only interactive moment. Fail fast and clearly; once the Workflow launches, nobody is watching.

Spec: `docs/superpowers/specs/2026-06-10-sydney-dev-autonomous-developer-design.md`.

## 1. Parse arguments

From the user's invocation: ISSUE (required, integer), `--scenarios=N` (optional integer), `--dry-run` (optional flag). Missing/malformed issue number → ask once, then stop if unanswered.

## 2. Preflight checks (abort with a clear reason on any failure)

Run these now; each is one or two commands:

1. **Issue:** `gh issue view <N> --json state,title,labels,body,comments,url`. Must exist and be `OPEN`. Closed → abort and say so.
2. **Existing PR guard:** `gh pr list --state open --search "<N> in:title" --json number,url,headRefName` plus `gh pr list --state open --head "$(git ls-remote --heads origin "*<N>-*" | awk -F/ '{print $NF}' | head -1)"`. Any open PR that references the issue → abort and link it ("already in flight").
3. **Stale branch guard:** `git ls-remote --heads origin | grep -E "/(bugfix|feature)/<N>-"`. If a branch exists with no open PR, use AskUserQuestion: resume that run (relaunch Workflow with `resumeFromRunId` if this session has one / continue on the existing branch) or delete-and-restart or abort.
4. **Stale worktree sweep:** for each dir in `../../.sydney-dev-worktrees/`: if `git -C <dir> log @{u}.. --oneline 2>/dev/null` is empty (all pushed) or the dir's branch has no commits past develop, `git worktree remove --force <dir>`; otherwise REPORT it to the user (never delete unpushed work) and continue.
5. **Deps:** `test -d node_modules && test -d vendor`. Missing → tell the user to run `npm install` / `composer install` and stop.
6. **Base:** `git fetch origin develop` (the worktree branches from it).

## 3. Stage run state

```bash
TMP="$(pwd)/.sydney-dev-tmp/issue-<N>"
mkdir -p "$TMP"
gh issue view <N> --json state,title,labels,body,comments,url > "$TMP/issue-context.json"
```

## 4. Launch the Workflow

Call the Workflow tool with:

- `scriptPath`: `<repo>/.claude/skills/sydney-dev/workflow.js`
- `args` (object, all paths ABSOLUTE):
  - `issue`: <N>
  - `scenarios`: N from `--scenarios` or null
  - `dryRun`: true/false
  - `repo`: absolute path of this checkout
  - `tmp`: the $TMP above
  - `worktree`: `<wp-content dir, two levels up>/.sydney-dev-worktrees/issue-<N>`
  - `skillDir`: `<repo>/.claude/skills/sydney-dev`
  - `qaPort`: a random port 9400-9499 (pick one; concurrent runs must not collide)

## 5. Handoff message (then end your turn)

Tell the user: issue number + title, classification will come from the plan phase, watch with `/workflows`, kill via the workflow's task. For `--dry-run`: outputs land in `.sydney-dev-tmp/issue-<N>/plan.md` + `blueprint.json`.

When the workflow completes you'll be re-invoked with its result: relay the PR URL and gate summary verbatim, including any ⚠ failed gates. If the result is `stranded: "PR"`, show the manual commands it returned. If `aborted`, say which phase and why.
````

- [ ] **Step 2: Verify frontmatter parses**

Run: `head -5 .claude/skills/sydney-dev/SKILL.md | grep -c "name: sydney-dev"`
Expected: `1`

- [ ] **Step 3: Commit**

```bash
git add .claude/skills/sydney-dev/SKILL.md
git commit -m "feat(sydney-dev): trigger skill with preflight + launch"
```

---

### Task 11: Dry-run validation (first live test, creates nothing)

**Files:** none — validation only.

- [ ] **Step 1: Pick a real open issue**

```bash
gh issue list --state open --limit 10
```

Pick a small, well-described one (call it N below).

- [ ] **Step 2: Run the dry-run**

In a fresh Claude Code session in this repo (so the new skill is loaded): `/sydney-dev N --dry-run`

Expected: preflight passes, Workflow launches, Plan phase runs, workflow returns `{ dryRun: true, ... }`. No branch, no worktree, no Zenhub move.

- [ ] **Step 3: Inspect the outputs**

```bash
cat .sydney-dev-tmp/issue-N/plan.md
cat .sydney-dev-tmp/issue-N/blueprint.json | python3 -m json.tool
```

Check: plan has all six sections; Success criteria are concrete enough that you could execute them in a browser yourself; blueprint is valid JSON extending the template. If the plan is weak, tune `prompts/plan.md` and re-run (same dry-run, no state to clean).

- [ ] **Step 4: Clean up**

```bash
rm -rf .sydney-dev-tmp/issue-N
```

---

### Task 12: Smoke run end-to-end (acceptance)

**Files:** none — validation only. Produces a real draft PR you then delete.

- [ ] **Step 1: Pick or create a sacrificial issue**

Ideally file a trivial real issue (e.g. a one-line SCSS bug you plant on a scratch branch of develop, or an existing trivially-small open issue). Note its number N.

- [ ] **Step 2: Full smoke run**

`/sydney-dev N --scenarios=1`

Watch via `/workflows`. Expected phase progression: Plan → Branch → Implement → Review (5 parallel) → QA (plan, execute with 1 scenario, report) → PR → Reflect.

- [ ] **Step 3: Verify the artifacts**

- Draft PR exists against `develop`, labeled `needs-human-review`, body contains plan summary + review findings + QA report; any red gate is flagged at top.
- Zenhub card is in Review/QA.
- `git worktree list` shows NO leftover worktree.
- `.sydney-dev-tmp/issue-N/evidence/` has Scenario-1 screenshot; eyeball it — does it actually show the pass condition?
- MEMORY.md on the branch has the run entry.

- [ ] **Step 4: Iterate on weak spots**

Any phase that misbehaved: edit its prompt file, then resume cheaply — `Workflow({scriptPath, resumeFromRunId: <id>})` re-runs only from the edited phase onward. Repeat until the run is clean.

- [ ] **Step 5: Tear down the smoke artifacts**

```bash
gh pr close <num> --delete-branch
rm -rf .sydney-dev-tmp/issue-N
```

(Move the Zenhub card back manually. If you filed a sacrificial issue, close it.)

- [ ] **Step 6: Final commit + wrap up**

```bash
composer test
git status --short   # nothing unexpected
git log --oneline origin/develop..HEAD
```

Expected: the Task 1-10 commits, clean tree, tests green. The branch is ready for `/create-pr` against develop (per repo workflow), including this plan + the spec doc:

```bash
git add docs/superpowers/specs/2026-06-10-sydney-dev-autonomous-developer-design.md docs/superpowers/plans/2026-06-10-sydney-dev-autonomous-developer.md
git commit -m "docs(sydney-dev): design spec + implementation plan"
```
