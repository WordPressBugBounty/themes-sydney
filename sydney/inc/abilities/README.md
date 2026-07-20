# Sydney Abilities API

Sydney exposes AI-callable tools ("abilities") through the [WordPress Abilities API](https://make.wordpress.org/core/2025/07/17/abilities-api/) so that AI agents (via REST or MCP) can read and customize the theme — colors, typography, the header/footer builder, layouts, patterns, and more — using the same validated, sanitized paths the Customizer uses.

Every ability lives under the single `sydney` category and is named `sydney/{verb}-{noun}`.

## Enabling

Nothing registers by default. Two dashboard options gate the system (both filterable, see `class-sydney-abilities.php`):

| Option | Purpose |
| --- | --- |
| `sydney-abilities-enabled` | Master switch. Off → the bootstrap returns before hooking anything. |
| `sydney-abilities-allow-writes` | Write switch. Off → only read abilities register. |

The Abilities API itself must be available: WordPress 6.9+ or a polyfill. On older setups the bootstrap silently no-ops.

**Write gating happens at registration, never by hiding a registered tool.** An ability flagged `'write' => true` is simply *not registered* while the write switch is off — agents can't see it, call it, or probe it.

## How a model picks the right ability

There is **no keyword index or matching algorithm** anywhere in the stack. The client (MCP or agent framework) places every registered ability's name, description, and input schema into the model's context, and the LLM chooses by semantically reading those strings against the user's request. The words we write *are* the discovery mechanism.

That dictates how Sydney abilities are named and described:

- **Names are `verb-noun` and literal** — `sydney/update-hero`, `sydney/get-social-links` — the name is the first thing a model matches on.
- **Descriptions front-load synonyms** a user might actually say: "back-to-top button" (scroll-to-top), "front-page banner (separate from the nav header)" (hero — catches "banner" *and* steers away from the header-builder tools), "loading animation" (preloader).
- **Descriptions encode the usage protocol**: "call `sydney/get-social-links` first", "full replacement list", "omitted fields are left unchanged". Models follow these when sequencing calls.
- **Schemas teach the vocabulary**: `enum` allowlists show the valid values before the call, and reads return an `available` map so the follow-up write already knows every legal value.

When editing an ability, treat the description as retrieval surface: if a user phrase wouldn't lexically or semantically land on it, add the phrasing.

## Architecture

```
inc/abilities/
├── bootstrap.php                        # Loaded from functions.php; gates + hooks the registry
├── class-sydney-abilities.php           # The two gating options (master / allow-writes)
├── class-sydney-abilities-registry.php  # Single loader; registers the category and every group
├── class-sydney-ability.php             # Static registrar wrapping wp_register_ability()
├── class-sydney-abilities-response.php  # The { success, message, data } envelope
├── groups/                              # One class per subject (colors, hero, shop, …)
├── patterns/                            # Pattern catalog + page composition abilities
└── customizer/                          # Shared definition maps / layout helpers
```

Key rules the wrapper (`Sydney_Ability::register()`) enforces so groups don't have to:

- injects the `sydney` category, the default `edit_theme_options` permission floor, and REST/MCP meta;
- normalizes input schemas (adds the `default => array()` that makes zero-input reads valid; strips empty `properties` that would fatal core's validator);
- wraps every execute callback in try/catch — contained Throwables surface as `WP_Error` (core's failure contract) and are logged when `WP_DEBUG` is on, never echoed to the client;
- skips registration of `'write' => true` abilities while the write switch is off.

Never call `wp_register_ability()` directly — you would silently lose all of the above.

## Ability catalog

All abilities require `edit_theme_options` unless noted. Reads always register; writes only when the write switch is on.

| Group | Read | Write | Notes |
| --- | --- | --- | --- |
| Global colors | `get-global-colors`, `list-color-palettes` | `update-global-colors`, `apply-color-palette` | |
| Typography | `get-typography`, `list-typography-pairs` | `update-typography`, `apply-typography-pair` | |
| Buttons | `get-button-styles` | `update-button-styles` | |
| Header/Footer builder | `get-hf-layout`, `list-hf-components`, `get-hf-component-settings` | `add-hf-component`, `move-hf-component`, `remove-hf-component`, `update-hf-component-settings` | `add`/`move` are non-idempotent |
| Patterns | `list-patterns` | `create-page-from-patterns` | Content cap (`publish_pages`/`edit_pages`) checked in execute, based on the requested post status |
| Starter sites / plugins | `get-plugin-recommendations` | `ensure-starter-sites-plugin`, `install-recommended-plugin` | `install_plugins` + `DISALLOW_FILE_MODS` verified inside execute |
| Onboarding | `get-onboarding-status` | `set-site-title`, `set-usage-tracking` | `set-site-title` requires `manage_options` (core option) |
| Social links | `get-social-links` | `update-social-links` | Full-replace per location; URLs validated against supported networks |
| Sidebars | `get-sidebars` | `update-sidebars` | Per context: `archive` + every public post type; applied atomically per context |
| Blog layout | `get-blog-layout` | `update-blog-layout` | Layout style, columns, excerpts, read-more, meta elements |
| Hero | `get-hero` | `update-hero` | Write is hero **type only** (front page + site); slides/height/overlay are read-only context |
| Scroll-to-top | `get-scrolltop` | `update-scrolltop` | On/off only |
| Preloader | `get-preloader` | `update-preloader` | On/off only |
| Additional CSS | `get-custom-css` | `update-custom-css` | Write requires `edit_css` (→ `unfiltered_html`); writes the same core `custom_css` post as the Customizer and replicates its `</style` breakout validation |
| Shop | `get-shop` | `update-shop` | Registers only when WooCommerce is active; layout, sidebar, and product-card structure |
| Page structure | `get-theme-selectors`, `find-elements`, `get-page-structure` | — | Read-only. Helps an agent write CSS for `update-custom-css`: `get-theme-selectors` is a static, no-fetch cheat sheet; `find-elements`/`get-page-structure` fetch rendered HTML over a **same-site** loopback (see below) |

All ability ids take the `sydney/` prefix, e.g. `sydney/get-global-colors`.

### Page structure (CSS authoring aids)

These three reads exist so an agent can target real selectors before calling `sydney/update-custom-css`, spending as few tokens as possible. Preferred order (cheapest first), which the descriptions themselves encode:

1. **`get-theme-selectors`** — a static, versioned cheat sheet of Sydney's stable selectors (classic **and** HF-Builder markup) and CSS custom properties (`--sydney-global-color-1..9`, `--sydney-text-color`, …). Zero fetch. "Call this FIRST."
2. **`find-elements`** — a scoped live query (`text` / `selector` / `area`, at least one required) that returns only the matching nodes with their ancestor path, children, and siblings, or nearest-text suggestions on a miss. The default path for a single element.
3. **`get-page-structure`** — the full distilled element tree, for page-wide restyling only.

Two things that make them safe and cheap:

- **Same-site only (SSRF guard).** The live abilities fetch via an unauthenticated `wp_remote_get` loopback and reject any URL whose host isn't `home_url()`'s host, or whose scheme isn't http(s) — so they only ever see public page output on this site, never arbitrary or internal hosts.
- **Server-rendered HTML only.** No headless browser: JS-modified DOM (an open off-canvas menu, sticky-scroll classes) is not visible, and the descriptions say so, so clients hedge. Distillation (drop non-visual tags, collapse single-child wrapper chains, dedupe repeated siblings, cap depth/size, output indented plain text — not JSON) lives in the pure, unit-tested `Sydney_Abilities_DOM_Distiller`. Fetched HTML is cached in a 5-minute transient keyed by URL, so an iterate-look-iterate loop costs one fetch.

## What a write actually does

Every write is a thin, validated wrapper over the same storage the Customizer uses — theme mods for almost everything; the two exceptions are the site title (core `blogname` option) and Additional CSS (the core `custom_css` post). Consequences worth knowing:

- **Changes are live immediately** and show up in the Customizer, where they can be inspected, tweaked, or undone with the normal controls. Nothing an ability does is invisible to the UI.
- **Input is never trusted**: values are validated against fixed allowlists (or run through the theme's own sanitizers) *before* anything is stored — a write either applies valid values or tells you why not.
- **Partial updates**: omitted fields are always left unchanged (detected with `array_key_exists`, so an explicit `false`/`""` counts as an intentional write). List-valued fields (social links, card elements, meta elements) are full replacements — and a list whose values are all invalid is skipped, never used to clear existing data by accident.
- **One DB write per call**: multi-mod writes batch through `Sydney_Ability::set_theme_mods()` — a single `theme_mods_{stylesheet}` update instead of one per key (per-key `pre_set_theme_mod_*` filters still run).
- **No custom storage, no history**: abilities add no tables or bespoke options, and there's no undo beyond what core provides (Additional CSS keeps post revisions; theme mods don't version).

## Response contract

Every execute callback returns the `Sydney_Abilities_Response` envelope:

```json
{ "success": true, "message": "…", "data": { } }
```

- Graceful failures (validation, unknown keys) return `success: false` envelopes; only crashes become `WP_Error`.
- Closed-schema writes (fixed named fields) fail fast on any invalid value and report `data.updated[]`.
- Open keyed maps (colors, HF component settings, sidebar contexts) validate per key, apply what's valid, and report rejects in `data.ignored[]` as `{ key, reason }` — hard-erroring only when nothing valid was applied.
- `updated[]`/`ignored[]` always use the caller-facing names the agent sent, never internal `theme_mod` names.

## Adding a group

Every ability registers through `Sydney_Ability::register( $id, $args )` — never `wp_register_ability()` directly. One registration with every parameter, annotated:

```php
Sydney_Ability::register(
	'sydney/update-example',                    // id: sydney/{verb}-{noun}. Reads use get-/list-,
	                                            // writes use update-/apply-/set-/add-/remove-/move-.
	array(
		// The registration gate (see "Enabling"): with 'write' => true the
		// ability is NOT registered while the write switch is off. Omit for reads.
		'write'               => true,

		'label'               => __( 'Update example', 'sydney' ),

		// The model's retrieval surface (see "How a model picks the right
		// ability"): front-load synonyms, state the protocol ("call
		// sydney/get-example first", "omitted fields are left unchanged").
		'description'         => __( '…', 'sydney' ),

		// JSON Schema for the input. The wrapper normalizes it: adds the
		// default => array() that makes zero-input calls valid, and strips
		// empty `properties` that would fatal core's validator. Use
		// additionalProperties => false + enum allowlists for writes;
		// a bare array( 'type' => 'object' ) is enough for no-input reads.
		'input_schema'        => array(
			'type'                 => 'object',
			'additionalProperties' => false,
			'properties'           => array( /* … */ ),
		),

		// JSON Schema for the response. Build it with
		// Sydney_Ability::envelope_schema( $data_properties ) so it always
		// describes the { success, message, data } envelope.
		'output_schema'       => Sydney_Ability::envelope_schema( array( /* … */ ) ),

		// Receives the schema-validated input array; must return a
		// Sydney_Abilities_Response envelope. The wrapper adds a try/catch
		// that turns uncaught Throwables into WP_Error (logged, not echoed).
		'execute_callback'    => array( $this, 'execute_update_example' ),

		// Only when the floor differs from the default edit_theme_options
		// (e.g. manage_options for core options, edit_css for Additional CSS).
		'permission_callback' => array( $this, 'check_manage_options' ),

		// READ_ANNOTATIONS or WRITE_ANNOTATIONS. Keep destructive => false
		// even for reversible removes (true flips the REST verb to DELETE);
		// merge idempotent => false only for add/move/create-style writes.
		'meta'                => array( 'annotations' => Sydney_Ability::WRITE_ANNOTATIONS ),
	)
);
```

The full parameter contract lives in the `register()` docblock in `class-sydney-ability.php` — that file is the source of truth.

The three wiring points for a new group:

1. Create `groups/class-sydney-abilities-{group}.php` with a `register()` method that calls `Sydney_Ability::register()` per ability.
2. Add the `require_once` in `Sydney_Abilities_Registry::load_groups()` **and** the class name to the default array behind the `sydney_abilities_groups` filter.
3. Add the new ability ids to `tests/unit/AbilitiesRegistrationTest.php` (the master list — `composer test` fails otherwise) and write the group's own registration + execute tests.

Sydney Pro and child themes extend the system without touching the registry: hook the `sydney_abilities_groups` filter and append group class names (each must be loaded by the extender and expose a public `register()` method).
