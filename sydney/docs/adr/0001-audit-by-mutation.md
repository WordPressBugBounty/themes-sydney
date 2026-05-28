# ADR-0001 — Audit Sydney's customizer by mutation, judged by Claude, on a dedicated site

Date: 2026-05-21
Status: Accepted (revised — original adapter-framework approach rejected after slice run)
Scope: `.claude/skills/test-customizer/`

## Context

Sydney exposes ~862 customizer settings across 14 option files. We want a repeatable way to answer "does this setting actually do anything on the frontend?" — currently the only evidence is hand-testing in the Customizer UI, which doesn't scale and produces no artifact.

The skill needs to:

1. Enumerate every setting.
2. Mutate each one and check whether the change surfaces in the rendered HTML.
3. Log only the cases that look broken or ambiguous (the user explicitly does not want functional settings logged).
4. Be re-runnable without manual cleanup.

The build went through two designs. The first failed in a way that motivated the second.

## Decision

We audit by **mutation**, not by introspection — values are written via `wp theme mod set`, the page is reloaded in a browser, and the result is judged. We do not parse PHP for `get_theme_mod()` call sites to predict effect.

Three sub-decisions:

1. **Claude operates the audit per setting, not a script.** For each setting, Claude reads the registry metadata, forms a hypothesis about what should change, picks a test page and test value, mutates via wp-cli, queries the page via playwright-cli, and emits a verdict (Functional / Unsure / Issue / Skipped / Error).

2. **Absolute test values, no theme_mods restoration.** Color → `#ff00ff`. Slider → setting's max. Radio → first non-current choice. The test site (`customizeraudit.local`) is dedicated to this skill and is allowed to drift.

3. **No on-disk evidence directory.** The observation lives in the Obsidian row. Screenshots, before/after DOM snapshots, etc. are not persisted between runs.

## Rejected: original adapter-framework approach

The first cut had a Node runner + per-control-class adapter modules. Each adapter implemented `matches/testValue/observe/classify`. The runner walked the registry, picked an adapter, set a value, snapshotted with Playwright, and the adapter classified.

We ran it once against the `colors` section. **It produced 16 false-positive "Issue" verdicts in a single run.** Every Issue was on `/` and the same setting was Functional on `/sydney-audit-post-1/`. The default WP front page has no `<h1>`–`<h6>`, no `<a>` with a color rule, no `<input>`, no `<aside class="sidebar">` — the surfaces those settings target. The palette adapter's rule ("after = magenta on some element, else Issue") had no concept of "the surface this setting affects doesn't exist on this page." It conflated "broken setting" with "wrong page."

Two options were on the table to fix it:

- **(a) Add a "surface check" to each adapter.** Before mutating, count surface elements; if zero, emit Unsure (no testable surface). Workable but pushes more per-setting knowledge into the adapter — heading colors need to know to look for `h1..h6`, link colors need to know about `a[href]`, etc. The adapter library was going to grow a long tail of special-cases.
- **(b) Stop pretending a rule engine can decide this and let Claude judge.** The cases the adapter mishandled all involve reading the page and forming a hypothesis, which is what an LLM does well. Token cost is real but per-section runs are tractable.

We chose (b). The skill is now a long prompt for Claude with concrete guidance for each control-class family, not a runner with rule-based classifiers.

## Other rejected alternatives

### Audit by introspection (parse PHP for `get_theme_mod` usage)

For each setting, grep templates for `get_theme_mod('setting_id')`, return Functional if any call site exists, Issue if none.

**Rejected** because a call site existing is necessary but not sufficient — it could be inside a never-executed branch. Many Sydney settings flow through dynamic CSS generation and filtered output that doesn't show up as direct `get_theme_mod` references. No signal on whether the value reaches a visible pixel.

### Relative test values + theme_mods restoration

Snapshot `theme_mods_<theme>` at run start, mutate relative to current ("slider × 4"), restore at end.

**Rejected** because relative strategies are non-deterministic across partial runs, and on a dedicated test site the cost of skipping restoration is zero.

### Image-diff (pixelmatch, etc.) as primary signal

Numerically compare before/after screenshots; flag anything below noise threshold as Issue.

**Rejected** because it requires a new dependency in `package.json` for a skill-only feature, and a pixel diff finds *any* change — including layout reflow caused by other settings, animations, and rendering noise. DOM/computed-style observation is precise about *what* changed and produces a description that maps to an investigation prompt.

## Consequences

### Positive

- **Verdicts are right by construction.** Claude looks at the page, sees no `<h3>`, writes Unsure with the right investigation prompt. Cannot mis-classify "no surface" as "broken setting."
- **No long-tail adapter maintenance.** New custom control classes don't require a new adapter — Claude reasons about them in-flight.
- **Cheap to extend.** New verdict heuristics, new control families, new fixtures: all SKILL.md edits, no code.
- **Re-running on the same site after a crash, partial run, or Ctrl-C is safe.** Obsidian table is the durable state; rows are idempotent on (setting, page).

### Negative

- **Token cost.** Per-section runs (~20–40 controls) are 20–60 minutes of Claude time and a real token bill. A full sweep across 862 settings is impractical in one session — the skill explicitly defaults to per-section.
- **Less reproducible.** Two runs of the same section may produce slightly different observations or investigation prompts. Verdicts should be stable on settings with clear surfaces; ambiguity in Unsure rows is by design.
- **The test site is intentionally trashed.** It cannot be used for any other purpose. `setup.sh` must remain idempotent for re-provisioning.
- **Sanitize side effects bypass the audit.** Settings that regenerate CSS or transients on `customize_save_*` hooks may behave differently under `wp theme mod set` than under the UI. SKILL.md instructs Claude to mention this in investigation prompts when relevant.
- **The audit site's theme is a separate copy from the dev tree.** Findings reflect installed Sydney version, not the working branch. SKILL.md flags this; future pass could symlink.

## References

- `.claude/skills/test-customizer/SKILL.md` — the skill prompt that implements this ADR.
- `.claude/skills/test-customizer/scripts/discover-registry.{sh,php}` — runtime customizer registry dump.
- `.claude/skills/test-customizer/scripts/append-obsidian-row.js` — durable state.
- `.claude/skills/test-customizer/scripts/setup.sh` — fixture provisioning.
