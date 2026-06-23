# Context — Sydney Abilities API

Glossary of the language we use when talking about exposing Sydney's
capabilities to AI agents through the WordPress Abilities API. Terms only —
no implementation details.

## Ability
A single Sydney capability registered via `wp_register_ability()` that an MCP
client (we recommend WP Vibe) can call. Has a name, schema, and callbacks.

## Read ability
An ability that returns state and never mutates it (e.g. `get-global-colors`,
`list-patterns`). Always available when the Master switch is on.

## Write ability
An ability that mutates theme state — theme_mods, posts, plugin state (e.g.
`update-global-colors`, `add-hf-component`, `create-page-from-patterns`).

## Master switch
The site-wide on/off for the whole feature (`sydney-abilities-enabled`,
default off). Off ⇒ no ability of any kind is registered.

## Write gate
The separate on/off for mutation (`sydney-abilities-allow-writes`, default
off). Off ⇒ Write abilities are **not registered at all** — they do not exist
in REST or MCP. Read abilities are unaffected. ("Writes-off" = this gate off.)
