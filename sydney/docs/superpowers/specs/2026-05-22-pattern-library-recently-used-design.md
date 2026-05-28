# Phase 1A.b — Pattern Library "Recently used" design

**Issue:** [#399](https://github.com/awesomemotive/Sydney/issues/399)
**Branch:** `feature/399-phase-1a-b-pattern-library-recently-used`
**Builds on:** Phase 1A.a — Pattern Library favorites (issue #398, PR #400, merged on `develop`)
**Date:** 2026-05-22

## Summary

Add a "Recently used" filter to the Pattern Library modal that surfaces the patterns the current user most recently inserted, ordered most-recent-first, capped at 12 entries, stored in user meta. Architecturally parallel to the favorites feature in every way: same storage shape, same REST surface, same client state model, same UI affordance pattern.

## Problem

The Pattern Library modal currently has no per-user breadcrumb. Every visit starts blank. The favorites feature (Phase 1A.a) covers patterns a user deliberately marks, but does nothing for the much more common case of *"I just inserted that hero two minutes ago and now I want it on the next page."* Recently-used fills that gap with zero user effort.

## Resolved design questions

| Question | Decision |
|---|---|
| Persistence scope | **Per-user**, user meta — parallel to favorites |
| Retention model | **Last N, fixed count** (N = 12); no timestamps |
| Ordering | **Most-recent-first** (LRU) — dedupe + move-to-front on insert |
| Interaction with favorites | **Fully orthogonal** — a pattern can be in both lists, heart toggle works in either view, no manual remove from recently-used |
| UI placement | **Modal header toggle button**, to the left of the existing Favorites toggle. No card-level chrome. |

## Architecture

Approach A: full parallel to favorites. Separate user meta key, separate REST route, separate sanitizer, separate test file. No shared abstraction — the surface is small enough that duplication beats a premature DRY.

### Pattern identity

Same as favorites: namespaced slug strings matching `#^sydney(-pro)?/[a-z0-9_-]+$#`. Examples: `sydney/hero-1`, `sydney-pro/team_2`. `pattern.name` from the core block-patterns registry.

## Backend

### Storage

- **User meta key:** `sydney_pattern_library_recently_used`
- **Shape:** JSON-encoded array of namespaced pattern slugs, ordered most-recent-first
- **Client list size:** 12 entries (`RECENTLY_USED_MAX = 12` on `Sydney_Pattern_Library`)
- **Server defensive cap:** 50 entries (`RECENTLY_USED_SERVER_CAP = 50`). Server truncates anything longer so a future bump to client N doesn't need a migration.
- **Example value:** `["sydney/hero-3", "sydney/about-1", "sydney/cta-2"]`

### Sanitization rules

Identical philosophy to `Sydney_Pattern_Library::sanitize_favorites_input()`:

1. Must be an array; non-arrays → empty list.
2. Each entry must be a string matching `#^sydney(-pro)?/[a-z0-9_-]+$#` — case-sensitive. Registered pattern names are always lowercase, so mixed-case entries (which would never match the client-side filter anyway) are dropped, not normalized.
3. Non-string entries dropped.
4. Deduplicated, **first-occurrence wins** (preserves client-side LRU ordering).
5. Iteration breaks once `RECENTLY_USED_SERVER_CAP` (50) entries have been accumulated — anything beyond is discarded.

### Class methods to add on `Sydney_Pattern_Library`

- `get_user_recently_used( int $user_id ): array` — reads meta, decodes JSON, defaults to `[]` on missing or malformed data.
- `sanitize_recently_used_input( mixed $value ): array` — applies the 5 rules above.
- `rest_get_recently_used( WP_REST_Request $request ): WP_REST_Response`
- `rest_update_recently_used( WP_REST_Request $request ): WP_REST_Response`
- `rest_recently_used_permissions_check( WP_REST_Request $request ): bool|WP_Error`

### REST API

Mounted on the existing `sydney/v1` namespace alongside the favorites routes.

| Method | Route | Body | Response |
|---|---|---|---|
| `GET` | `/sydney/v1/pattern-recently-used` | — | `{ "recently_used": ["sydney/hero-1", ...] }` |
| `POST` | `/sydney/v1/pattern-recently-used` | `{ "recently_used": ["sydney/hero-1", ...] }` | `{ "recently_used": [...sanitized...] }` |

- **Capability:** `edit_posts` (same as favorites). Anonymous → 401, under-privileged → 403.
- **Nonce:** cookie auth via the WP REST API; no nonce in body.
- **Write model:** client sends the whole array on each change (matches favorites). Server does not append-and-trim — it stores what the client sends, after sanitization.

## Frontend

### Hydration

Extend the existing `wp_localize_script` payload (currently exposes `favorites`) to also expose `recently_used`:

```php
'recently_used' => self::get_user_recently_used( get_current_user_id() ),
```

Hydrated synchronously into `window.sydneyPatternLibrary.recentlyUsed` before the modal mounts. No async fetch on modal open.

### Redux store (`src/store/index.js`)

State additions, parallel to `favorites`:

- **State slice:** `recentlyUsed: string[]` (initialized from `window.sydneyPatternLibrary.recentlyUsed || []`).
- **Selectors:** `getRecentlyUsed()`. `getSelectedType()` already exists and gains `"recent"` as a valid value alongside `"all"` / `"favorites"` / category slugs.
- **Actions:**
  - `trackPatternInsert(patternName)` — prepends `patternName` to `recentlyUsed`, dedupes (move-to-front semantics if already present), truncates to `RECENTLY_USED_MAX` (12).
- **Persistence:** the existing 400ms debounced subscribe block already coalesces favorites writes. Extend it to also POST `recently_used` when that slice of state changes. Use **two independent debounce timers** (one per endpoint) to keep failures isolated.
- **Soft failure:** same as favorites — log via `console.error` and continue; don't revert client state.

### Insert tracking

`PatternLibraryModal.js` already passes an `onInsert` callback into `PatternGrid`. Wrap it at the modal level: before delegating to the parent `onInsert(pattern)`, dispatch `trackPatternInsert(pattern.name)`. `PatternGrid` stays oblivious to recency tracking — single point of change.

### UI — modal header toggle

Current header-left renders the favorites toggle conditionally:

```
[♥ Favorites (3)]                    [×]
```

After this change:

```
[⏱ Recently used (5)] [♥ Favorites (3)]                    [×]
```

- **New CSS class:** `sydney-pattern-library-recently-used-filter`. Mirrors the favorites filter styling exactly except for the icon. **Icon:** counterclockwise-arrow ("history") SVG, sized 14×14 to match the heart icon. Convention from GitHub / browser history affordances — unambiguous "recently visited" signifier.
- **DOM order:** Recently used **first** (left), Favorites **second** (right).
- **Visibility rule:** `recentlyUsed.length > 0` (parallel to `showFavoritesFilter = favorites.length > 0`). Conditionally rendered, not CSS-hidden.
- **Click handler:** `setType(isRecentActive ? "all" : "recent")`. Mutually exclusive with favorites — clicking Recent while Favorites is active just switches to Recent (and vice versa). Same setType-based one-of behavior the favorites button already has.
- **No card-level chrome.** No timestamp, no "recent" badge in the All view. The header toggle plus card ordering within the Recent view is the entire affordance.

### Grid filtering (`PatternGrid.js`)

Where the current code does `if (selectedType === "favorites") filter by favoriteSet`, add a parallel branch:

```js
if (selectedType === "recent") {
  // filter by recentSet, preserving the recently-used array's order
}
```

The Recent view renders patterns in **the order of the `recentlyUsed` array** (most-recent-first), not the default alphabetical / category sort. The Favorites view's existing ordering behavior is untouched.

## Edge cases

| Scenario | Behavior |
|---|---|
| Insert a pattern already in recent | Moves to position 0. Array length unchanged. |
| 13th unique insert | Oldest evicted client-side **before** the POST; server only ever sees ≤ 12 from this client. |
| Recent list goes empty mid-session | Should not happen at runtime (only-add, never-remove). If state becomes empty via direct meta manipulation, mirror favorites' auto-reset: `selectedType === "recent" && recentlyUsed.length === 0 → setType("all")`. |
| Slug in recent list but pattern no longer registered (e.g. starter-site swap removed it) | `recentSet.has(p.name)` filter naturally drops it from the grid. No special handling. The stale slug stays in user meta until naturally evicted by future inserts — acceptable. |
| User clears favorites while Recent is the active filter | Favorites button hides (existing behavior). Recent stays active and unaffected. |
| POST fails for recently_used | `console.error`, don't revert; the next successful write resyncs (matches favorites' soft-failure handling). |
| Anonymous user opens the editor | `wp_localize_script` payload still ships `recently_used: []`. REST routes return 401 if called, but they're not called for anonymous users (insertion requires `edit_posts`). |

## Testing

### PHPUnit

Add `tests/unit/PatternLibraryRecentlyUsedTest.php`, parallel to `PatternLibraryFavoritesTest.php`. Tests extend `Sydney\Tests\BaseThemeTest` (WP_Mock-backed). Cover:

**`sanitize_recently_used_input()`:**
- Returns `[]` for non-array input (string, null, int, object).
- Drops entries that don't match the slug regex.
- Accepts both `sydney/...` and `sydney-pro/...` slugs.
- Rejects mixed-case entries (e.g. `sydney/Hero-1`) — does not normalize.
- Deduplicates while preserving first-occurrence order.
- Truncates input arrays longer than `RECENTLY_USED_SERVER_CAP` to exactly that length (cap-and-break behavior, matching favorites).

**`get_user_recently_used()`:**
- Missing meta returns `[]`.
- Malformed JSON in meta returns `[]`.
- Valid JSON array returns the array.

**`rest_recently_used_permissions_check()`:**
- Anonymous → 401.
- Logged-in user without `edit_posts` (e.g. subscriber) → 403.
- Logged-in user with `edit_posts` → permitted.

### Playwright

No new Playwright coverage. Favorites doesn't have any either; staying consistent with the existing pattern-library scope. Manual smoke test in the dev environment before merging.

### Code quality

`composer test` and `composer phpcs` must both pass before opening a PR.

## SCSS

Add `.sydney-pattern-library-recently-used-filter` rules in `inc/modules/pattern-library/src/index.css` immediately above the existing `.sydney-pattern-library-favorites-filter` block. Duplicate the base styles; do not introduce a shared mixin at this scope.

## Out of scope (carried from issue #399)

- User-defined collections / multiple "boards" (Phase 1B).
- Cross-device sync beyond what user meta gives us natively.
- Surfacing recently-used patterns outside the Pattern Library modal.
- Timestamps on pattern cards.
- Manual "remove from recently used" affordance.
- Most-frequent-first ordering.
- Time-windowed retention (e.g. "last 30 days").

## Files touched

**New files:**
- `tests/unit/PatternLibraryRecentlyUsedTest.php`

**Modified files:**
- `inc/modules/pattern-library/class-sydney-pattern-library.php` — constants, getter, sanitizer, three REST handlers, route registration, extend `wp_localize_script` payload.
- `inc/modules/pattern-library/src/store/index.js` — `recentlyUsed` slice, `trackPatternInsert` action, extend debounced subscribe to POST recently-used.
- `inc/modules/pattern-library/src/components/PatternLibraryModal.js` — render Recently-used toggle to the left of Favorites; wrap `onInsert` to dispatch `trackPatternInsert`.
- `inc/modules/pattern-library/src/components/PatternGrid.js` — branch for `selectedType === "recent"`, preserving array order.
- `inc/modules/pattern-library/src/index.css` — `.sydney-pattern-library-recently-used-filter` styles.

**Build artifacts** (regenerated, committed on release branches only):
- `inc/modules/pattern-library/build/*`
