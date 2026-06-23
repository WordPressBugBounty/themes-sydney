# ADR-0003 — Gate the starter-sites plugin's abilities through a default-off theme filter

Date: 2026-06-17
Status: Accepted
Scope: `athemes-starter-sites` plugin (v2) + `inc/abilities/` (Sydney) — cross-repo

## Context

Phase 4 of the Sydney Abilities API exposes starter sites to AI agents. Two of
the three abilities are registered by the **`athemes-starter-sites` plugin**,
not the theme, because the plugin is multi-theme (it ships demo registries for
Sydney, Sydney Pro, Botiga, …) and owns the import orchestration:

- `athemes-starter-sites/list-sites` (read)
- `athemes-starter-sites/import-site` (write — installs plugins, overwrites
  content, customizer, and widgets; a high-blast-radius, destructive operation)

As originally planned (§8.2), these registered whenever the plugin was active
and the Abilities API was present, gated only by the `edit_theme_options`
capability — with **no master/write opt-in**. That contradicts the rest of the
design, where every Sydney ability is double-gated and default-off (Master
switch + Write gate, see ADR-0002). It meant installing the plugin on an
Abilities-enabled site silently published a destructive demo-import tool to any
administrator.

We want the plugin's abilities governed by the **same gate** as Sydney's own
abilities — without the plugin hard-depending on Sydney (it must keep working
on Botiga and other aThemes themes that have their own, or no, gate).

## Decision

The plugin gates its ability registration on **two default-off filters** it
queries at registration time, rather than on any theme-specific option:

- `apply_filters( 'atss_abilities_enabled', false )` — gates `list-sites`
  (read) and is a precondition for `import-site`.
- `apply_filters( 'atss_abilities_allow_writes', false )` — additionally gates
  `import-site` (write). Registration is **register-only** (ADR-0002): when this
  is false, `import-site` is not registered at all.

Each aThemes theme satisfies the contract by hooking the filters to its own
gate. Sydney does so in its abilities bootstrap:

```php
add_filter( 'atss_abilities_enabled',      array( 'Sydney_Abilities', 'is_enabled' ) );
add_filter( 'atss_abilities_allow_writes', array( 'Sydney_Abilities', 'writes_enabled' ) );
```

The filters default to `false`, so with no theme opting in (or a non-aThemes
theme active), the plugin's abilities do not register. This mirrors the
plugin's existing `atss_register_demos_list` pattern, where the theme — not the
plugin — supplies theme-specific data.

Timing: Sydney's bootstrap runs at theme load (`functions.php`), before
`abilities_api_init` / `wp_abilities_api_init` fire, so the filter is in place
when the plugin checks it.

The filter **names are the published cross-repo interface** between the theme
and the plugin.

`import-site` keeps `annotations.destructive => true` regardless — it overwrites
site content, unlike Sydney's additive theme-setting writes.

## Rejected alternatives

### Plugin reads Sydney's option directly (`get_option('sydney-abilities-enabled')`)

**Rejected** — breaks the multi-theme contract. The `sydney-abilities-*` options
do not exist under Botiga or other aThemes themes, so the abilities would never
register there, and the plugin would carry knowledge of one theme's internals.

### Plugin owns an independent opt-in toggle

A separate `atss-abilities-enabled` option with its own dashboard UI in the
plugin.

**Rejected for v1** — it splits the opt-in across two places (theme toggle +
plugin toggle), which is worse UX than "the theme's toggle governs everything,"
and it is plugin-side scope creep. The filter contract gives the same safety
with the theme as the single control surface. Revisit only if a theme-agnostic
standalone use case appears.

### Leave the abilities ungated (original §8.2)

**Rejected** — inconsistent with ADR-0002's default-off posture and exposes a
destructive import tool with no explicit opt-in.

## Consequences

### Positive

- **One control surface.** Flipping Sydney's dashboard toggles governs the
  plugin's abilities too; admins reason about one opt-in, not two.
- **Multi-theme clean.** The plugin depends on a filter contract, not on any
  theme's options; each theme wires its own gate; default-off is safe.
- **Consistent posture.** `import-site` is register-only behind the write gate,
  exactly like the theme's write abilities.

### Negative

- **Cross-repo coupling via filter names.** `atss_abilities_enabled` /
  `atss_abilities_allow_writes` are now a published interface; renaming either
  is a breaking change coordinated across both repos.
- **Silent-off failure mode.** If a theme forgets to hook the filters, the
  plugin's abilities simply never appear, with no error — a support-diagnosis
  trap. Mitigated by documenting the contract in both repos.
- **Two-repo release coupling.** Shipping this requires a coordinated change to
  the `athemes-starter-sites` plugin and the Sydney theme.

## References

- `Abilities API.md` §8.2 / §8.3 — starter-sites ownership and the theme-side
  bootstrap ability.
- `docs/adr/0002-register-only-write-gating.md` — the register-only model this
  extends to the plugin side.
- `CONTEXT.md` — Master switch / Write gate definitions.
