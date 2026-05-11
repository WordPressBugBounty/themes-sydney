# Sydney Studio — Custom Pattern Library Design

**Date:** 2026-02-18
**Feature:** Sydney Studio — Custom Pattern Library for WordPress Block Editor

---

## Overview

A "Sydney Studio" button in the WordPress block editor top bar opens a modal pattern library. Users browse patterns organized by type (hero, cta, team, etc.) and collection (Local Services, Digital, Corporate), preview them via WP's native `BlockPatternsList` component, and insert them into the editor. Pro patterns are visible with a badge and clicking opens an upsell link.

---

## File Structure

```
inc/modules/pattern-library/
├── class-sydney-pattern-library.php     # Main module class, hooks, asset registration
├── patterns-config.php                  # Collection definitions + pattern-to-collection map
├── patterns/                            # Individual pattern registration files
│   ├── hero-1.php
│   ├── cta-1.php
│   └── ...
└── src/
    ├── index.js                         # Entry point: registers plugin, toolbar button
    ├── components/
    │   ├── StudioModal.js               # Main modal (WP Modal component)
    │   ├── PatternGrid.js               # Wraps BlockPatternsList
    │   ├── CollectionFilter.js          # Top bar collection pills
    │   ├── TypeFilter.js                # Sidebar type filter pills
    │   └── SmartSuggestions.js          # Toast notification (self-contained, easy to remove)
    └── store/
        └── index.js                     # wp.data store for filter state
```

Compiled output goes to `inc/modules/pattern-library/build/`. The `build/` folder is committed. `node_modules/` is gitignored.

---

## PHP Layer

### `class-sydney-pattern-library.php`

- Checks `Sydney_Modules::is_module_active('pattern-library')` before loading — module toggle replaces any need for a separate filter
- On `init`: includes each file in `patterns/` to register patterns with WP core via `register_block_pattern()`
- On `enqueue_block_editor_assets`: enqueues `build/index.js` using `build/index.asset.php` for dependency management
- Calls `wp_localize_script()` to pass to JS as `sydneyStudio`:
  - `collections` — collection slug → label map
  - `patternCollections` — pattern name → array of collection slugs
  - `upgradeUrl` — Pro upsell link
  - `isPro` — bool, `defined('SYDNEY_PRO_VERSION')`

### `patterns-config.php`

```php
$sydney_studio_collections = [
    'local-services' => __('Local Services', 'sydney'),
    'digital'        => __('Digital', 'sydney'),
    'corporate'      => __('Corporate', 'sydney'),
];

$sydney_studio_pattern_collections = [
    'sydney/hero-1' => ['local-services', 'corporate'],
    'sydney/cta-1'  => ['digital'],
    // ...
];
```

### Individual pattern files (`patterns/hero-1.php`)

Call `register_block_pattern()` with `name`, `title`, `content`, `categories` (type: hero, cta, team, testimonials, features). Pro patterns include a custom `sydney_pro => true` metadata key.

---

## React / JS Layer

**Principle:** Use WP core components from `@wordpress/components` as much as possible — `Modal`, `Button`, `TabPanel`, `Flex`, `FlexItem`, `Snackbar`, etc. Avoid building custom React components or writing new CSS where a core component covers the need. Custom components only where WP core has no equivalent.

### `index.js`
- Uses `registerPlugin` from `@wordpress/plugins` to mount the toolbar button
- Renders a button in the appropriate WP slot/fill for top-bar placement next to the inserter (exact slot TBD during implementation)
- Imports and mounts `SmartSuggestions`

### `StudioModal.js`
- WP `Modal` component
- Layout: top bar with `CollectionFilter`, sidebar with `TypeFilter`, main area with `BlockPatternsList`
- Filters pattern array by selected collection + type before passing to `BlockPatternsList`
- Pro patterns: "Pro" badge overlay; click opens `sydneyStudio.upgradeUrl` in new tab

### `CollectionFilter.js`
- Pills from `sydneyStudio.collections` + "All" pill
- Updates store on select

### `TypeFilter.js`
- Pills derived from pattern `categories` field + "All" pill
- Updates store on select

### `PatternGrid.js`
- Wraps WP's `BlockPatternsList` component
- Receives filtered patterns array as prop

### `store/index.js`
- Minimal `wp.data` store
- State: `{ selectedCollection, selectedType }`
- Actions: `setCollection`, `setType`

### `SmartSuggestions.js`
- After pattern insertion: checks active collection, finds uninserted patterns from same collection (session state, resets on reload)
- Shows WP `Snackbar` with message and link to reopen modal with collection pre-selected
- Dismissing sets session flag — won't reappear for same collection in same session
- **Fully self-contained** — removing the import in `index.js` removes the feature entirely

---

## Build Setup

A `package.json` inside `inc/modules/pattern-library/`:

```json
{
  "scripts": {
    "build": "wp-scripts build src/index.js --output-path=build",
    "start": "wp-scripts start src/index.js --output-path=build"
  }
}
```

- Uses `.js` file extensions (not `.jsx`)
- `build/index.asset.php` auto-generated by `@wordpress/scripts` for WP dependency management
- `build/` committed to repo; `node_modules/` gitignored

---

## Initial Patterns

3 patterns per collection as placeholders:

| Pattern | Types | Collections |
|---------|-------|-------------|
| hero-1 | hero | local-services, corporate |
| hero-2 | hero | digital |
| hero-3 | hero | local-services |
| cta-1 | cta | digital, corporate |
| cta-2 | cta | local-services |
| cta-3 | cta | corporate |
| team-1 | team | corporate |
| testimonials-1 | testimonials | local-services, digital |
| features-1 | features | digital |

---

## Pro Patterns

- Same registration system, `sydney_pro => true` metadata
- Badge displayed in modal grid
- Click opens `sydneyStudio.upgradeUrl` in new tab
- When `SYDNEY_PRO_VERSION` is defined, patterns insert normally
