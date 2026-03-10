# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

**Sydney** is a WordPress theme by aThemes, built with PHP 7.2+ and modern frontend tooling. The theme supports Elementor, WooCommerce, Gutenberg block templates, and includes a custom header/footer builder.

## Development Commands

### Build & Watch
```bash
npm start                 # Start Gulp with BrowserSync (watches SCSS, JS, PHP)
npm run styles           # Compile module SCSS files
npm run js-custom        # Compile custom JavaScript
npm run js-vendors       # Compile vendor JavaScript
npm run images           # Optimize images
npm run styles-rtl       # Generate RTL stylesheets
npm run translate        # Generate translation POT file
npm run cache-clear      # Clear Gulp cache
```

### Testing
```bash
# PHP Unit Tests (WP_Mock)
composer test                           # Run all PHPUnit tests
composer run test:unit                  # Run unit test suite only
./vendor/bin/phpunit --filter TestName  # Run single test

# E2E Tests (Playwright)
npm test              # Run Playwright tests
npm run report        # View test report
npx playwright test   # Run tests directly

# Code Quality
composer phpcs        # Check PHP coding standards
composer phpcs:fix    # Auto-fix PHPCS violations
```

### Package for Release
```bash
npm run zip  # Creates sydney.zip (runs composer test:unit first)
```

## Architecture

### Directory Structure

```
functions.php          # Theme setup and feature registration
inc/
├── classes/           # Core OOP classes (header, modules, metaboxes, SVG)
├── modules/           # Feature modules (hf-builder, block-templates)
├── customizer/        # Customizer controls, options, callbacks
├── dashboard/         # Admin dashboard settings
├── integrations/      # Third-party integrations
├── performance/       # Performance optimizations
├── onboarding/        # Theme onboarding flow
├── usage-tracking/    # Anonymous usage tracking
└── vendor/            # Kirki framework (customizer controls)
css/modules/src/       # SCSS source files (compiled to css/modules/)
js/                    # Custom JavaScript
assets/js/vendor/      # Third-party JS libraries
tests/
├── bootstrap.php      # PHPUnit bootstrap
└── unit/              # Unit tests (namespace: Sydney\Tests\)
playwright/            # Playwright E2E tests
```

### Key Classes

- `Sydney_Modules` - Feature module system (activates/deactivates modules)
- `Sydney_Header` - Header/footer builder integration
- `Sydney_Page_Metabox` - Page-specific meta options
- `Sydney_Posts_Archive` - Custom post archive layouts
- `Sydney_SVG_Icons` - SVG icon system

### Module System

Modules are self-contained features in `inc/modules/`. Check if module is active:
```php
if ( class_exists( 'Sydney_Modules' ) && Sydney_Modules::is_module_active( 'hf-builder' ) ) {
    // Module-specific code
}
```

Active modules: `hf-builder` (header/footer builder), `block-templates` (Gutenberg templates)

## Code Style

### PHP Standards
- **Prefix**: All functions/constants must use `sydney_` prefix (enforced by PHPCS)
- **Text domain**: Always `'sydney'` for translations
- **Indentation**: Tabs (not spaces)
- **Minimum PHP**: 7.2
- **Minimum WordPress**: 5.0
- **Namespaces**: `Sydney\Classes\*` for class-based code
- **File naming**: Classes in `class-*.php`, functions in descriptive names

### WordPress Conventions
- Escape all output: `esc_html()`, `esc_attr()`, `esc_url()`
- Sanitize all input: `sanitize_text_field()`, `intval()`, etc.
- Use nonces for forms: `wp_verify_nonce()`, `wp_create_nonce()`
- Check capabilities: `current_user_can()`
- Hooks naming: `sydney_action_name` (actions), `sydney_filter_name` (filters)
- Translation functions: `__()`, `_e()`, `_n()`, `esc_html__()`, `esc_html_e()`

### Testing Conventions
- Unit tests extend `Sydney\Tests\BaseThemeTest` (provides WP_Mock setup)
- Test files: `tests/unit/Test*.php` or `tests/unit/*Test.php`
- E2E tests: `tests/**/*.spec.js` (not in `tests/unit/` or `tests/bootstrap.php`)
- Use WP_Mock for WordPress function mocking
- Namespace: `Sydney\Tests\`

## Build System (WPGulp)

**Config**: `wpgulp.config.js`

### Key Build Tasks
- **SCSS compilation**: `css/modules/src/*.scss` → `css/modules/*.css`
- **JS bundling**: `assets/js/src/*.js` → `assets/js/*.js`
- **Image optimization**: `assets/img/raw/**/*` → `assets/img/`
- **Translation**: Generates `languages/sydney.pot`
- **ZIP packaging**: Excludes node_modules, vendor, tests, config files

### Local Development URL
Default: `http://sydney.local/` (configure in `wpgulp.config.js`)

## Testing Strategy

### PHP Unit Tests
- Located in `tests/unit/`
- Bootstrap: `tests/bootstrap.php` (loads WP_Mock)
- Use `WP_Mock::userFunction()` for WordPress function mocks
- Run via `composer test` or `./vendor/bin/phpunit`
- Single test: `./vendor/bin/phpunit tests/unit/YourTest.php`

### Playwright E2E Tests
- Configuration: `playwright.config.js`
- Test directory: `tests/` (ignores `php/` folder)
- Runs on Chromium only (can enable Firefox/WebKit)
- Default timeout: 30s per test
- Workers: 2 parallel (1 on CI)

## Code Quality Standards

**PHPCS Configuration**: `phpcs.xml`
- Base: WordPress Coding Standards
- PHP Compatibility: 7.3+
- WordPress compatibility: 5.0+
- Text domain enforcement: `sydney`
- Prefix enforcement: `sydney_`
- Parallel execution: 50 processes
- Excludes: tests/, vendor/, node_modules/, playwright-report/

**Common Exclusions**:
- Yoda conditions (intentionally disabled)
- Short array syntax (allowed)
- File naming conventions (relaxed for templates)

## Git Workflow

**Main branch**: `master`
**Always create PRs against**: `develop`, never against `master`
**Branch naming**: `feature/`, `bugfix/`, `enhancement/`

When working on features:
1. Create branch from `develop`
2. Run tests before committing
3. Verify PHPCS compliance
4. Update version numbers only on release branches
5. All PRs should be against the `develop` branch

## Common Pitfalls

- **Never modify compiled CSS** - Always edit SCSS in `css/modules/src/`
- **Don't commit compiled files** - Gulp compiles on-demand (except for releases)
- **Always run tests** - `composer test` before PRs
- **Prefix everything** - PHPCS will fail without `sydney_` prefix on globals
- **Text domain is mandatory** - All translation functions need `'sydney'`
- **Use get_template_part()** - For WordPress 5.5+, use native function (no sydney_ wrapper needed)

## WordPress Version Compatibility

**Breaking change in WordPress 5.5**: `get_template_part()` now supports passing args directly. Sydney previously had `sydney_get_template_part()` wrapper but now uses native function when possible.

## Integration Points

### Elementor
Theme supports Elementor page builder with custom header/footer templates.

### WooCommerce
Custom WooCommerce integration in `inc/woocommerce.php` and `woocommerce/` directory.

### Kirki Framework
Used for advanced Customizer controls (sortable, generic, base controls). Bundled in `inc/vendor/kirki-framework/`.

## Quick Reference

| Task | Command |
|------|---------|
| Start dev server | `npm start` |
| Run all tests | `composer test && npm test` |
| Check code style | `composer phpcs` |
| Fix code style | `composer phpcs:fix` |
| Build for production | `npm run zip` |
| View test report | `npm run report` |

## Documentation

- Theme documentation: https://athemes.com/documentation/sydney/
- Support: https://athemes.com/contact/
