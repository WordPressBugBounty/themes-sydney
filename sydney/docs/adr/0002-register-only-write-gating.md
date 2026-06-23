# ADR-0002 — Gate Abilities API writes by registration, not by MCP visibility

Date: 2026-06-17
Status: Accepted
Scope: `inc/abilities/` (planned) — the Sydney Abilities API feature

## Context

Sydney is adding WordPress Abilities API support so AI agents (via an MCP
client such as WP Vibe) can read and change theme settings. The feature is
guarded by two dashboard toggles, both off by default:

- **Master switch** (`sydney-abilities-enabled`) — off ⇒ nothing registers.
- **Write gate** (`sydney-abilities-allow-writes`) — off ⇒ mutation is disabled
  while reads stay available.

The question this ADR settles: **when the Write gate is off, what happens to
the write abilities** (`update-global-colors`, `update-typography`,
`add-hf-component`, `create-page-from-patterns`, …)?

The feature plan contains a reference review of how WPForms secures its write
abilities (master plan §13). One of its recommendations — §13 #1 — states:

> Gate MCP visibility on the write toggle, not just registration. Add
> `'mcp' => [ 'public' => Sydney_Abilities::writes_enabled() ]` to every write
> ability's meta … Keep `show_in_rest => true` (still cap-gated). **This
> supersedes §4's register-only approach.**

That recommendation defines an alternative architecture, not an additive tweak,
so the two cannot both stand. We had to pick one.

## Decision

When the Write gate is off, write abilities are **not registered at all**. The
registry skips them (`if ( ! Sydney_Abilities::writes_enabled() ) return;`).
A writes-off site has no write ability anywhere — not in the REST catalog, not
in the MCP tool list, not reachable for execution.

We therefore **decline §13 #1**. The master plan's §13 will be edited to remove
the "supersedes §4's register-only approach" claim and record that register-only
gating is the chosen model.

The other §13 recommendations are unaffected and remain v1 requirements:
`additionalProperties => false` on write schemas, an `ignored[]` list in
responses, orphan rollback in multi-step writers, and per-object capability
escalation (`edit_pages`/`publish_pages`) for `create-page-from-patterns`.

## Rejected: always-register + visibility-gate (§13 #1)

Always register write abilities; keep `show_in_rest => true`; set
`meta.mcp.public => writes_enabled()` so a writes-off site hides them from
agents while leaving them in the cap-gated REST catalog.

**Rejected** for two reasons:

1. **It is a softer guarantee.** Under §13 #1 the ability still *exists* and is
   reachable over REST when writes are off — `mcp.public => false` hides it from
   discovery but does not block execution. To stay safe it would also need a
   write-gate check inside every write ability's `permission_callback`
   (`writes_enabled() && current_user_can( … )`, the WPForms `check_write_gate()`
   pattern). §13 #1 omits that, so as literally written it is a regression: an
   `edit_theme_options` holder calling REST directly could still write with the
   gate off. Register-only needs no such callback correctness — absent means
   unexecutable, full stop.
2. **Simplicity.** Register-only is one `return` in the registry. The alternative
   spreads the gate across registration, `permission_callback`, and `meta.mcp`,
   and pushes a subtle "registered but inert" state onto every write ability.

## Consequences

### Positive

- **Strongest possible guarantee.** Writes off ⇒ the ability does not exist ⇒
  it cannot be executed by any client through any transport. No reliance on a
  `permission_callback` getting the gate check right.
- **Simpler registry.** A single early `return` per write ability; no
  writes-aware `permission_callback`, no per-ability `mcp.public` plumbing.
- **§5's "enforced twice" stays literally true** at registration time + cap
  check, exactly as the plan already describes it.

### Negative

- **The MCP tool catalog changes shape when the gate flips.** Agents see write
  tools appear/disappear as an admin toggles `allow-writes`. MCP clients that
  cache the tool list may need to refresh. (WPForms avoids this by keeping a
  stable catalog and hiding via `mcp.public` — the trade we are declining.)
- **No writes-off discoverability.** An integration enumerating the REST catalog
  on a writes-off site cannot see that a write surface exists-but-is-disabled;
  it simply sees fewer abilities.
- **§13 reads as authoritative but is partly declined.** Mitigated by editing
  §13 to drop the "supersedes" claim and pointing to this ADR.

## References

- `Abilities API.md` §4 (gating), §5 (permission model), §13 (WPForms reference
  + recommendations) — in the Sydney vault.
- `CONTEXT.md` — Master switch / Write gate / Write ability definitions.
- `Abilities API - Phase 1 Implementation Plan.md` — registry gating
  (`register_color_abilities` / `register_typography_abilities`).
