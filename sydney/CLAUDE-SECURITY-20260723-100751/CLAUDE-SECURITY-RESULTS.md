# Claude Security results

On 2026-07-23, Claude Security scanned the Sydney WordPress theme at revision `2359ec1` — specifically the `inc/` PHP logic layer (317 tracked files), with the bundled Kirki vendor framework excluded at your request. The run used **medium** effort with a production-code (attack-surface) focus and a dedicated secrets pass. **No findings survived verification.** The panel raised 13 candidate vulnerabilities during research; every one was eliminated under adversarial scrutiny, so there is nothing to act on from this scan.

## Coverage

This was a scoped scan of `inc/` (excluding `inc/vendor/`, the Kirki framework). The inventory partitioned the scope into 12 components, and a researcher examined each across the applicable vulnerability categories:

- **abilities-api** — `inc/abilities`
- **dashboard-admin** — `inc/dashboard`, `inc/theme-dashboard-settings.php`
- **customizer** — `inc/customizer`
- **modules-hf-builder-patterns** — `inc/modules`
- **core-classes** — `inc/classes`
- **theme-frontend-core** — `inc/block-styles.php`, `inc/custom-header.php`, `inc/display-conditions.php`, `inc/editor.php`, `inc/extras.php`, `inc/fonts.php`, `inc/jetpack.php`, `inc/page-builder.php`, `inc/schema.php`, `inc/slider.php`, `inc/so-page-builder.php`, `inc/styles.php`, `inc/template-tags.php`, `inc/theme-update.php`, `inc/woocommerce.php`
- **third-party-integrations** — `inc/integrations`
- **onboarding** — `inc/onboarding`
- **usage-tracking** — `inc/usage-tracking`
- **notices** — `inc/notices`
- **starter-content** — `inc/starter-content`
- **performance** — `inc/performance`

**Deliberately not examined** (background context only, not audited as targets):

- **pattern-library-vendored-deps** — `inc/modules/pattern-library/node_modules`, `inc/modules/pattern-library/build`. Vendored npm dependency tree and compiled build output bundled inside the pattern-library module; not first-party code.
- **customizer-vendored-js-libs** — `inc/customizer/controls/typography/select2.js`, `select2.full.min.js`, `select2.css`, `select2.min.css`, and `google-fonts-alphabetical.json`. Third-party Select2 library and a static font-name data file bundled with the typography control; not first-party logic.
- **Kirki framework** (`inc/vendor/`) — excluded from the scope at your request.

The memory-safety vulnerability category was pruned across all components as not applicable to PHP. No cap truncated coverage: every one of the 13 candidates was fully panel-reviewed, and nothing was dropped for size or budget. Because this is a scoped scan, the whole-repository completeness check does not apply — this report speaks to `inc/` (minus Kirki), not to the theme's root files, templates, JavaScript, SCSS, WooCommerce template overrides, or block-template markup outside `inc/`.

## Findings

None. All 13 candidate findings were rejected by the verification panel.

## What was verified

Research dispatched 38 researcher passes across the 12 components and their applicable categories, surfacing 13 candidate vulnerabilities. Each candidate was put to an independent three-lens verification panel (39 panel votes total). None reached the 2-of-3 confirmation bar: three candidates drew a single confirming vote (F1, F3, F12) and the remaining ten were rejected unanimously. No candidate survived, so the report is empty. Nothing in this scan executed the theme's code — no tests were run and no exploit was fired; every judgement is derived from reading the source. The renderer stamps the verification status from the vote record itself.
