# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

# MEMORY.md
Maintain a file called MEMORY.md in this project. After any significant decision, add an entry: What was decided / Why / What was rejected and why. Read MEMORY.md at the start of every session. Never contradict a logged decision without flagging it first.

When I say "session end", "wrapping up", or "let's stop here" or similar: write a session summary to MEMORY.md. Include: Worked on / Completed / In progress / Decisions made / Next session priorities.

# ERRORS.md
Maintain a file called ERRORS.md. When an approach takes more than 2 attempts to work, log it: What didn't work / What worked instead / Note for next time. Check ERRORS.md before suggesting approaches to similar tasks.

## Working Principles

Behavioral guidelines to reduce common LLM coding mistakes.

**Tradeoff:** These guidelines bias toward caution over speed. For trivial tasks, use judgment.

### 1. Think Before Coding

**Don't assume. Don't hide confusion. Surface tradeoffs.**

Before implementing:

- State your assumptions explicitly. If uncertain, ask.
- If multiple interpretations exist, present them - don't pick silently.
- If a simpler approach exists, say so. Push back when warranted.
- If something is unclear, stop. Name what's confusing. Ask.

### 2. Simplicity First

**Minimum code that solves the problem. Nothing speculative.**

- No features beyond what was asked.
- No abstractions for single-use code.
- No "flexibility" or "configurability" that wasn't requested.
- No error handling for impossible scenarios.
- If you write 200 lines and it could be 50, rewrite it.

Ask yourself: "Would a senior engineer say this is overcomplicated?" If yes, simplify.

### 3. Surgical Changes

**Touch only what you must. Clean up only your own mess.**

When editing existing code:

- Don't "improve" adjacent code, comments, or formatting.
- Don't refactor things that aren't broken.
- Match existing style, even if you'd do it differently.
- If you notice unrelated dead code, mention it - don't delete it.

When your changes create orphans:

- Remove imports/variables/functions that YOUR changes made unused.
- Don't remove pre-existing dead code unless asked.

The test: Every changed line should trace directly to the user's request.

### 4. Goal-Driven Execution

**Define success criteria. Loop until verified.**

Transform tasks into verifiable goals:

- "Add validation" → "Write tests for invalid inputs, then make them pass"
- "Fix the bug" → "Write a test that reproduces it, then make it pass"
- "Refactor X" → "Ensure tests pass before and after"

For multi-step tasks, state a brief plan:

1. [Step] → verify: [check]
2. [Step] → verify: [check]
3. [Step] → verify: [check]

Strong success criteria let you loop independently. Weak criteria ("make it work") require constant clarification.

---

**These guidelines are working if:** fewer unnecessary changes in diffs, fewer rewrites due to overcomplication, and clarifying questions come before implementation rather than after mistakes.

## General rules
- Match response length to task complexity. Simple questions get direct, short answers. Complex tasks get full, detailed responses. Never pad responses with restatements of the question or closing sentences that repeat what you just said.
- Never open responses with filler phrases like "Great question!", "Of course!", "Certainly!", or similar warmups. Start every response with the actual answer. No preamble, no acknowledgment of the question.

## Project Overview

**Sydney** is a WordPress theme by aThemes, built with PHP 7.2+ and modern frontend tooling. The theme supports Elementor, WooCommerce, Gutenberg block templates, and includes a custom header/footer builder.

## Tech Stack

Tech stack for this project. Always use these. Never suggest alternatives unless I ask:

- **Language:** PHP 7.2+ (theme code), JavaScript (ES6, no TypeScript)
- **Framework:** WordPress 5.0+ theme (functions.php + hooks, classic theme with block template support)
- **Package manager:** npm (frontend assets), Composer (PHP dependencies)
- **Database:** MySQL via WordPress APIs (`$wpdb`, `WP_Query`, options/meta/transient APIs) — never raw SQL outside of `$wpdb->prepare()`
- **Testing:** PHPUnit + WP_Mock for unit tests (`tests/unit/`), Playwright for E2E (`tests/*.spec.js`)
- **Styling:** SCSS compiled via WPGulp (Gulp 4) — edit `css/modules/src/*.scss`, never the compiled CSS
- **Build:** WPGulp (`npm start` for watch, `npm run zip` for release)
- **Customizer controls:** Pure WordPress Customizer API (`WP_Customize_Control`, `WP_Customize_Setting`). Kirki is bundled in `inc/vendor/kirki-framework/` for legacy controls only — do not add new Kirki controls.

If something seems like the wrong tool, flag it. But use the defined stack unless I explicitly say otherwise.

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
├── modules/           # Feature modules (hf-builder, block-templates, pattern-library)
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

Active modules: `hf-builder` (header/footer builder), `block-templates` (Gutenberg templates), `pattern-library` (block pattern catalog)

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
- Hook naming: `sydney_action_name` (actions), `sydney_filter_name` (filters)
- Standard WPCS rules apply — `composer phpcs` is authoritative for escaping, sanitization, nonces, capabilities, and i18n.

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

### Working with assets
- Never edit compiled CSS — edit SCSS in `css/modules/src/` and let Gulp recompile.
- Compiled CSS/JS is built on demand; only release branches commit the compiled output.

### Local Development URL
Default: `http://sydney.local/` (configure in `wpgulp.config.js`)

## Testing Strategy

Run `composer test` and `composer phpcs` before opening a PR.

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

## WordPress Version Compatibility

**Breaking change in WordPress 5.5**: `get_template_part()` now supports passing args directly. Sydney previously had `sydney_get_template_part()` wrapper but now uses native function when possible.

## Integration Points

### Elementor
Theme supports Elementor page builder with custom header/footer templates.

### WooCommerce
Custom WooCommerce integration in `inc/woocommerce.php` and `woocommerce/` directory.

### Kirki Framework
Used for advanced Customizer controls (sortable, generic, base controls). Bundled in `inc/vendor/kirki-framework/`.

## Documentation

- Theme documentation: https://athemes.com/documentation/sydney/
- Support: https://athemes.com/contact/
