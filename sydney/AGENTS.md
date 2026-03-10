# AGENTS.md - Sydney Theme Development Guide

This document provides agentic coding agents with essential information for working in the Sydney WordPress theme codebase.

## Project Overview

**Sydney** is a modern, clean, and responsive WordPress theme built with:
- **PHP 7.2+** (WordPress theme)
- **Node.js/npm** (build tooling with Gulp)
- **Composer** (PHP package management and testing)
- **Playwright** (end-to-end testing)
- **SCSS** (CSS preprocessing)

---

## Build & Development Commands

### Start Development Server
```bash
npm start
```
Runs Gulp watch task for SCSS, JS, and image compilation with live reload via BrowserSync.

### Build Tasks
- **Compile styles**: `npm run styles`
- **Compile scripts**: `npm run js-custom` (custom JS), `npm run js-vendors` (vendor JS)
- **Optimize images**: `npm run images`
- **Generate translations**: `npm run translate`
- **RTL styles**: `npm run styles-rtl`
- **Clear cache**: `npm run cache-clear`

### Package & Deploy
```bash
npm run zip
```
Creates theme ZIP file. Runs `composer run test:unit` as prezip hook.

---

## Testing

### Unit Tests (PHP)
```bash
composer test
```
Run all PHPUnit tests using WP_Mock.

**Run single test:**
```bash
composer test -- --filter TestClassName::testMethodName
```
Or with file path:
```bash
./vendor/bin/phpunit tests/unit/BaseThemeTest.php
```

**Run specific test suite:**
```bash
composer run test:unit
```

**Test bootstrap:** `tests/bootstrap.php`  
**Test directory:** `tests/unit/` (PSR-4 namespace: `Sydney\Tests\`)

### E2E Tests (Playwright)
```bash
npm test
npx playwright test
```

**View test report:**
```bash
npm run report
```

### Code Quality

**PHP Code Sniffer:**
```bash
composer phpcs
```
Checks coding standards (WordPress Coding Standards + WPCS).

**Auto-fix issues:**
```bash
composer phpcs:fix
```

**Configuration:** `phpcs.xml` (text domain: "sydney", prefix: "sydney")

---

## Code Style Guidelines

### General

- **Language:** PHP 7.2+ with some ES6+ JavaScript (transpiled via Babel)
- **Tabs:** Use tabs (not spaces) for indentation
- **Line length:** No strict limit, but keep readable
- **Naming:** `snake_case` for functions/variables, `PascalCase` for classes

### PHP

**Functions & Constants:**
- Prefix all global functions and constants with `sydney_` (enforced by PHPCS)
- Example: `sydney_setup()`, `SYDNEY_VERSION`

**Classes:**
- Use namespaces: `Sydney\*` (e.g., `Sydney\Classes\MyClass`)
- File: `inc/classes/class-myclass.php`
- Autoloaded via Composer PSR-4

**Imports:**
- Use `use` statements at file top after `<?php` and docblock
- Example:
  ```php
  <?php
  /**
   * File docblock
   */
  use Sydney\Classes\MyClass;
  ```

**Documentation:**
- PHPDoc comments required for functions, classes, and public methods
- Include `@package Sydney`, `@since VERSION`, and parameter/return types
- Example:
  ```php
  /**
   * Get theme option safely.
   *
   * @since 1.0.0
   * @param string $option Option name.
   * @return mixed Option value or false.
   */
  function sydney_get_option( $option ) {
    // ...
  }
  ```

**Error Handling:**
- Use `wp_die()` for fatal errors in WordPress context
- Validate and sanitize all user input: `sanitize_text_field()`, `intval()`, etc.
- Escape all output: `esc_html()`, `esc_attr()`, `esc_url()`
- Use nonces for forms: `wp_verify_nonce()`, `wp_create_nonce()`
- Check capabilities: `current_user_can()`

**WordPress Hooks:**
- Naming: `sydney_filter_name` (filters), `sydney_action_name` (actions)
- Apply filters: `apply_filters( 'sydney_get_theme_mod', $value, $key )`
- Do actions: `do_action( 'sydney_after_setup_theme' )`

### JavaScript/CSS

**File Structure:**
- Custom JS: `js/` (transpiled via Babel)
- Styles: `css/` (SCSS preprocessed)
- Vendor files: `assets/js/vendor/`, `css/vendor/`

**Naming:**
- Files: `lowercase-with-hyphens.js`
- Variables/functions: `camelCase`
- Classes: `PascalCase`
- Constants: `UPPER_SNAKE_CASE`

**Style (SCSS):**
- Variables: `$variable-name` (kebab-case)
- Mixins: `@mixin mixin-name` (kebab-case)
- Nesting: Keep shallow (max 3 levels)
- BEM for class names: `.block__element--modifier`

**Translations:**
- Use `__()` for static strings
- Use `_e()` for echoed strings
- Text domain: `'sydney'` (always)
- Examples:
  ```php
  __( 'Hello', 'sydney' )
  _e( 'Save Changes', 'sydney' )
  ```

---

## Directory Structure

```
.
├── inc/               # Theme functionality
│   ├── classes/       # PHP classes (PSR-4)
│   ├── modules/       # Feature modules
│   ├── customizer/    # Customizer settings
│   ├── templates-builder/
│   └── integrations/
├── css/               # Compiled CSS + source SCSS
├── js/                # JavaScript files
├── tests/
│   ├── bootstrap.php
│   └── unit/          # PHPUnit tests (namespace: Sydney\Tests\)
├── functions.php      # Main theme setup
├── composer.json      # PHP dependencies
├── package.json       # Node dependencies
├── phpcs.xml          # Code standards config
├── phpunit.xml.dist   # Test config
└── wpgulp.config.js   # Build config
```

---

## Composer Commands Reference

| Command | Purpose |
|---------|---------|
| `composer phpcs` | Check PHP coding standards |
| `composer phpcs:fix` | Auto-fix PHPCS violations |
| `composer test` | Run all unit tests |
| `composer run test:unit` | Run unit test suite |

---

## Git Workflow & Cursor Rules

**Cursor rules directory:** `.cursor/commands/`
- `create-pr.md` - Pull request creation guidelines
- `fix-github-issue.md` - Issue fixing workflow
- `investigate-create-issue.md` - Issue investigation steps

**Coding Standards:**
- Follow WordPress Coding Standards (via PHPCS)
- Text domain is always `'sydney'`
- All globals prefixed with `sydney_`
- Minimum PHP version: 7.2
- Minimum WordPress: 5.0

---

## Key Conventions Summary

| Area | Convention |
|------|-----------|
| **PHP Functions** | `sydney_function_name()` |
| **PHP Classes** | `Sydney\Namespace\ClassName` in `inc/classes/class-classname.php` |
| **Constants** | `SYDNEY_CONSTANT_NAME` |
| **Translation** | Text domain: `'sydney'` |
| **Indentation** | Tabs |
| **CSS Classes** | BEM: `.block__element--modifier` |
| **JavaScript** | `camelCase` variables, ES6+ with Babel transpilation |
| **Documentation** | PHPDoc for PHP, comments for JavaScript |

---

## Quick Tips for Agents

1. **Run tests before committing**: `composer test && npm test`
2. **Check code style**: `composer phpcs` before pushing
3. **Use WP_Mock in tests**: Extend `Sydney\Tests\BaseThemeTest` for unit tests
4. **Always sanitize input** and **escape output** in WordPress
5. **Follow existing patterns** in `inc/classes/` for new functionality
6. **Update SCSS** in source files, never modify compiled CSS directly
7. **Use Composer autoloader** for class-based code

