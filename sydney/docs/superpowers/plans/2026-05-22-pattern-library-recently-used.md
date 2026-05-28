# Pattern Library "Recently used" Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Add a per-user "Recently used" filter to the Pattern Library modal that surfaces the last 12 patterns the current user inserted, ordered most-recent-first, as a sibling affordance to the existing Favorites feature.

**Architecture:** Full architectural parallel to Phase 1A.a favorites. Separate user meta key, separate REST route, separate sanitizer, separate test file. Client maintains the LRU list in Redux; server endpoint persists what the client sends (after sanitization). Insertion is tracked client-side by wrapping the modal's `onInsert` callback. A new toggle button sits in the modal header bar to the LEFT of the existing Favorites toggle. No card-level chrome; no timestamps.

**Tech Stack:**
- **PHP 7.2+** — `Sydney_Pattern_Library` class (`inc/modules/pattern-library/class-sydney-pattern-library.php`)
- **PHPUnit + WP_Mock** — `tests/unit/PatternLibraryRecentlyUsedTest.php` extending `Sydney\Tests\BaseThemeTest`
- **WordPress REST API** — new `sydney/v1/pattern-recently-used` GET + POST routes
- **React + `@wordpress/data` (Redux)** — `src/store/index.js`, `src/components/PatternLibraryModal.js`, `src/components/PatternGrid.js`
- **`@wordpress/scripts`** — build chain (`npm run build` inside `inc/modules/pattern-library/`)

**Spec:** `docs/superpowers/specs/2026-05-22-pattern-library-recently-used-design.md`

**Issue:** #399 — branch `feature/399-phase-1a-b-pattern-library-recently-used`

---

## File Structure

**New files:**
- `tests/unit/PatternLibraryRecentlyUsedTest.php` — PHPUnit tests parallel to `PatternLibraryFavoritesTest.php`.

**Modified files:**
- `inc/modules/pattern-library/class-sydney-pattern-library.php` — add two constants, one getter, one sanitizer, three REST handler methods, two `register_rest_route` calls, and one new key in the `wp_localize_script` payload.
- `inc/modules/pattern-library/src/constants.js` — export `RECENTLY_USED_MAX = 12`.
- `inc/modules/pattern-library/src/store/index.js` — `recentlyUsed` state slice, `INITIAL_RECENTLY_USED`, `trackPatternInsert` action, second debounced subscribe block for the recently-used endpoint.
- `inc/modules/pattern-library/src/components/PatternLibraryModal.js` — render Recently-used toggle to the left of Favorites; wrap `onInsert` to dispatch `trackPatternInsert`.
- `inc/modules/pattern-library/src/components/PatternGrid.js` — branch for `selectedType === "recent"`, preserve the recently-used array's order in the grid.
- `inc/modules/pattern-library/src/index.css` — `.sydney-pattern-library-recently-used-filter` styles immediately above the existing `.sydney-pattern-library-favorites-filter` block.

**Build artifacts (regenerated):**
- `inc/modules/pattern-library/build/index.js`
- `inc/modules/pattern-library/build/index.css`
- `inc/modules/pattern-library/build/index.asset.php`

Build artifacts are committed only on release branches per repo convention — do **not** commit them in this feature branch. (Phase 1A.a followed the same rule.)

---

## Task 1: Backend — add constants

**Files:**
- Modify: `inc/modules/pattern-library/class-sydney-pattern-library.php:55` (right after existing `FAVORITES_MAX` const)

- [ ] **Step 1: Add the two new class constants**

Open `inc/modules/pattern-library/class-sydney-pattern-library.php` and locate the existing favorites constants (lines 46–55):

```php
	/**
	 * User meta key storing the per-user favorited pattern names.
	 */
	const USER_META_KEY = 'sydney_pattern_library_favorites';

	/**
	 * Hard cap on the number of favorites stored per user. Defensive — prevents
	 * unbounded growth from a misbehaving client or hand-crafted POST.
	 */
	const FAVORITES_MAX = 500;
```

**Immediately after** the `FAVORITES_MAX` const (after line 55, before the `Instance` PHPDoc block), add:

```php
	/**
	 * User meta key storing the per-user list of recently-inserted pattern names,
	 * ordered most-recent-first.
	 */
	const RECENTLY_USED_META_KEY = 'sydney_pattern_library_recently_used';

	/**
	 * Server-side cap on the number of recently-used entries persisted per user.
	 * Higher than the client-side cap (12) so a future bump to client N doesn't
	 * need a migration. The sanitizer truncates anything longer than this.
	 */
	const RECENTLY_USED_SERVER_CAP = 50;
```

- [ ] **Step 2: Verify the file still parses**

Run: `php -l inc/modules/pattern-library/class-sydney-pattern-library.php`
Expected: `No syntax errors detected in inc/modules/pattern-library/class-sydney-pattern-library.php`

- [ ] **Step 3: Commit**

```bash
git add inc/modules/pattern-library/class-sydney-pattern-library.php
git commit -m "feat(#399): add recently-used constants to pattern library class"
```

---

## Task 2: Backend — sanitizer (TDD)

**Files:**
- Create: `tests/unit/PatternLibraryRecentlyUsedTest.php`
- Modify: `inc/modules/pattern-library/class-sydney-pattern-library.php` (add `sanitize_recently_used_input()` after `sanitize_favorites_input()`)

- [ ] **Step 1: Create the failing test file with sanitizer tests**

Create `tests/unit/PatternLibraryRecentlyUsedTest.php`:

```php
<?php
/**
 * Unit tests for the Pattern Library recently-used feature.
 *
 * Covers the sanitization helper, the user-meta read path, and the REST
 * permission gate. The REST handler bodies themselves are thin wrappers
 * over these helpers plus core WP functions; testing the helpers + the
 * gate is sufficient unit coverage.
 *
 * @package Sydney
 * @subpackage Tests
 */

namespace Sydney\Tests;

use WP_Mock as M;

class PatternLibraryRecentlyUsedTest extends BaseThemeTest {

	public function setUp(): void {
		parent::setUp();

		// Sydney_Modules + module-active mock so the class file's early-return
		// guard lets the class definition through.
		if ( ! class_exists( 'Sydney_Modules' ) ) {
			require_once dirname( __DIR__, 2 ) . '/inc/modules/class-sydney-modules.php';
		}
		M::userFunction( 'get_option', array(
			'return' => function ( $option_name, $default = null ) {
				if ( $option_name === 'sydney-modules' ) {
					return array( 'pattern-library' => true );
				}
				return $default;
			},
		) );

		M::userFunction( 'is_admin', array( 'return' => false ) );
		M::userFunction( 'wp_doing_ajax', array( 'return' => false ) );
		M::userFunction( 'wp_doing_cron', array( 'return' => false ) );

		if ( ! class_exists( 'Sydney_Pattern_Library' ) ) {
			require_once dirname( __DIR__, 2 ) . '/inc/modules/pattern-library/class-sydney-pattern-library.php';
		}
	}

	// -----------------------------------------------------------------
	// sanitize_recently_used_input
	// -----------------------------------------------------------------

	public function test_sanitize_non_array_input_returns_empty_array() {
		$this->assertSame( array(), \Sydney_Pattern_Library::sanitize_recently_used_input( null ) );
		$this->assertSame( array(), \Sydney_Pattern_Library::sanitize_recently_used_input( 'not-an-array' ) );
		$this->assertSame( array(), \Sydney_Pattern_Library::sanitize_recently_used_input( 42 ) );
		$this->assertSame( array(), \Sydney_Pattern_Library::sanitize_recently_used_input( (object) array( 'foo' => 'bar' ) ) );
	}

	public function test_sanitize_keeps_valid_pattern_names_preserving_order() {
		$input  = array( 'sydney/hero-1', 'sydney/about-3', 'sydney-pro/team_2' );
		$output = \Sydney_Pattern_Library::sanitize_recently_used_input( $input );
		$this->assertSame( $input, $output );
	}

	public function test_sanitize_strips_invalid_strings() {
		$input  = array(
			'sydney/hero-1',
			'../evil',
			'<script>alert(1)</script>',
			'not-namespaced',
			'random/pattern',
			'sydney/about-3',
			'sydney/has spaces',
			'sydney/Hero-1',
		);
		$output = \Sydney_Pattern_Library::sanitize_recently_used_input( $input );
		// Mixed-case is REJECTED, not normalized (parallel to favorites behavior).
		$this->assertSame( array( 'sydney/hero-1', 'sydney/about-3' ), $output );
	}

	public function test_sanitize_strips_non_string_values() {
		$input  = array( 'sydney/hero-1', 123, true, null, array( 'nested' ), 'sydney/about-1' );
		$output = \Sydney_Pattern_Library::sanitize_recently_used_input( $input );
		$this->assertSame( array( 'sydney/hero-1', 'sydney/about-1' ), $output );
	}

	public function test_sanitize_deduplicates_preserving_first_occurrence_order() {
		$input  = array( 'sydney/hero-1', 'sydney/about-1', 'sydney/hero-1', 'sydney/about-1', 'sydney/cta-1' );
		$output = \Sydney_Pattern_Library::sanitize_recently_used_input( $input );
		$this->assertSame( array( 'sydney/hero-1', 'sydney/about-1', 'sydney/cta-1' ), $output );
	}

	public function test_sanitize_enforces_server_cap() {
		$input = array();
		for ( $i = 0; $i < 80; $i++ ) {
			$input[] = "sydney/pattern-{$i}";
		}
		$output = \Sydney_Pattern_Library::sanitize_recently_used_input( $input );
		$this->assertSame( \Sydney_Pattern_Library::RECENTLY_USED_SERVER_CAP, count( $output ) );
		$this->assertSame( 'sydney/pattern-0', $output[0] );
		$this->assertSame( 'sydney/pattern-' . ( \Sydney_Pattern_Library::RECENTLY_USED_SERVER_CAP - 1 ), end( $output ) );
	}

	public function test_sanitize_accepts_sydney_pro_namespace() {
		$input  = array( 'sydney-pro/hero-1', 'sydneyPRO/x', 'sydney_pro/x' );
		$output = \Sydney_Pattern_Library::sanitize_recently_used_input( $input );
		// Only the first one matches the strict /^sydney(-pro)?\/.../ form.
		$this->assertSame( array( 'sydney-pro/hero-1' ), $output );
	}
}
```

- [ ] **Step 2: Run the test file to verify it fails**

Run: `./vendor/bin/phpunit tests/unit/PatternLibraryRecentlyUsedTest.php`
Expected: All 6 `sanitize_*` tests fail with `Error: Call to undefined method Sydney_Pattern_Library::sanitize_recently_used_input()` (or PHP fatal — both are correct "this doesn't exist yet" signals).

- [ ] **Step 3: Implement `sanitize_recently_used_input()` on the class**

In `inc/modules/pattern-library/class-sydney-pattern-library.php`, locate the end of `sanitize_favorites_input()` (the `}` on line 375). **Immediately after** that closing brace and before the closing `}` of the class (line 376), add:

```php
		/**
		 * Sanitize a recently-used input array.
		 *
		 * Filters the input down to:
		 *   - strings only,
		 *   - matching the pattern-name format `sydney/...` or `sydney-pro/...`
		 *     with lowercase alphanumerics, hyphens, and underscores only
		 *     (case-sensitive — registered pattern names are always lowercase,
		 *     and mixed-case entries would never match the client-side filter),
		 *   - de-duplicated (first occurrence wins to preserve client-side
		 *     LRU ordering — the most-recent entry sits at index 0),
		 *   - capped at RECENTLY_USED_SERVER_CAP entries.
		 *
		 * @param mixed $raw Untrusted input. Anything not an array becomes [].
		 * @return array<int, string>
		 */
		public static function sanitize_recently_used_input( $raw ) {
			if ( ! is_array( $raw ) ) {
				return array();
			}

			$out  = array();
			$seen = array();
			foreach ( $raw as $value ) {
				if ( ! is_string( $value ) ) {
					continue;
				}
				if ( ! preg_match( '#^sydney(-pro)?/[a-z0-9_-]+$#', $value ) ) {
					continue;
				}
				if ( isset( $seen[ $value ] ) ) {
					continue;
				}
				$seen[ $value ] = true;
				$out[]          = $value;
				if ( count( $out ) >= self::RECENTLY_USED_SERVER_CAP ) {
					break;
				}
			}

			return $out;
		}
```

- [ ] **Step 4: Run tests to verify they pass**

Run: `./vendor/bin/phpunit tests/unit/PatternLibraryRecentlyUsedTest.php`
Expected: 6 tests pass (test_sanitize_*).

- [ ] **Step 5: Run PHPCS on the modified file**

Run: `composer phpcs -- inc/modules/pattern-library/class-sydney-pattern-library.php tests/unit/PatternLibraryRecentlyUsedTest.php`
Expected: 0 errors. (If formatting violations appear, run `composer phpcs:fix` to auto-fix, then re-run `composer phpcs` to verify clean.)

- [ ] **Step 6: Commit**

```bash
git add tests/unit/PatternLibraryRecentlyUsedTest.php inc/modules/pattern-library/class-sydney-pattern-library.php
git commit -m "feat(#399): add recently-used sanitizer with unit tests"
```

---

## Task 3: Backend — `get_user_recently_used()` (TDD)

**Files:**
- Modify: `tests/unit/PatternLibraryRecentlyUsedTest.php` (append getter tests)
- Modify: `inc/modules/pattern-library/class-sydney-pattern-library.php` (add `get_user_recently_used()` method)

- [ ] **Step 1: Append getter tests to the test file**

Open `tests/unit/PatternLibraryRecentlyUsedTest.php` and add the following block **immediately before** the closing `}` of the class:

```php
	// -----------------------------------------------------------------
	// get_user_recently_used
	// -----------------------------------------------------------------

	public function test_get_user_recently_used_returns_empty_for_zero_user_id() {
		$this->assertSame( array(), \Sydney_Pattern_Library::get_user_recently_used( 0 ) );
	}

	public function test_get_user_recently_used_returns_empty_when_meta_missing() {
		M::userFunction( 'get_user_meta', array(
			'args'   => array( 42, \Sydney_Pattern_Library::RECENTLY_USED_META_KEY, true ),
			'return' => '',
		) );
		$this->assertSame( array(), \Sydney_Pattern_Library::get_user_recently_used( 42 ) );
	}

	public function test_get_user_recently_used_returns_empty_when_meta_is_malformed_json() {
		M::userFunction( 'get_user_meta', array(
			'args'   => array( 42, \Sydney_Pattern_Library::RECENTLY_USED_META_KEY, true ),
			'return' => '{not valid json',
		) );
		$this->assertSame( array(), \Sydney_Pattern_Library::get_user_recently_used( 42 ) );
	}

	public function test_get_user_recently_used_returns_empty_when_meta_is_non_array_json() {
		M::userFunction( 'get_user_meta', array(
			'args'   => array( 42, \Sydney_Pattern_Library::RECENTLY_USED_META_KEY, true ),
			'return' => '"sydney/hero-1"',
		) );
		$this->assertSame( array(), \Sydney_Pattern_Library::get_user_recently_used( 42 ) );
	}

	public function test_get_user_recently_used_returns_sanitized_array_from_meta() {
		M::userFunction( 'get_user_meta', array(
			'args'   => array( 42, \Sydney_Pattern_Library::RECENTLY_USED_META_KEY, true ),
			'return' => '["sydney/hero-1","../evil","sydney/about-3"]',
		) );
		$this->assertSame(
			array( 'sydney/hero-1', 'sydney/about-3' ),
			\Sydney_Pattern_Library::get_user_recently_used( 42 )
		);
	}
```

- [ ] **Step 2: Run the new tests to verify they fail**

Run: `./vendor/bin/phpunit tests/unit/PatternLibraryRecentlyUsedTest.php --filter test_get_user_recently_used`
Expected: 5 tests fail with `Error: Call to undefined method Sydney_Pattern_Library::get_user_recently_used()` (or PHP fatal).

- [ ] **Step 3: Implement `get_user_recently_used()` on the class**

In `inc/modules/pattern-library/class-sydney-pattern-library.php`, locate the end of `get_user_favorites()` (the method ends around line 333). **Immediately after** that method's closing `}` and before the PHPDoc block for `sanitize_favorites_input()`, add:

```php
		/**
		 * Read and validate a user's recently-used pattern array from user meta.
		 *
		 * Returns an empty array on any failure (missing meta, malformed JSON,
		 * non-array payload) — callers can treat the result as authoritative
		 * without their own validation.
		 *
		 * @param int $user_id User ID.
		 * @return array<int, string>
		 */
		public static function get_user_recently_used( $user_id ) {
			if ( empty( $user_id ) ) {
				return array();
			}

			$raw = get_user_meta( $user_id, self::RECENTLY_USED_META_KEY, true );
			if ( empty( $raw ) || ! is_string( $raw ) ) {
				return array();
			}

			$decoded = json_decode( $raw, true );
			if ( ! is_array( $decoded ) ) {
				return array();
			}

			return self::sanitize_recently_used_input( $decoded );
		}
```

- [ ] **Step 4: Run getter tests to verify they pass**

Run: `./vendor/bin/phpunit tests/unit/PatternLibraryRecentlyUsedTest.php --filter test_get_user_recently_used`
Expected: 5 tests pass.

- [ ] **Step 5: Run full test file to confirm no regressions**

Run: `./vendor/bin/phpunit tests/unit/PatternLibraryRecentlyUsedTest.php`
Expected: 11 tests pass (6 sanitizer + 5 getter).

- [ ] **Step 6: Commit**

```bash
git add tests/unit/PatternLibraryRecentlyUsedTest.php inc/modules/pattern-library/class-sydney-pattern-library.php
git commit -m "feat(#399): add get_user_recently_used helper with unit tests"
```

---

## Task 4: Backend — REST routes + permission gate (TDD)

**Files:**
- Modify: `tests/unit/PatternLibraryRecentlyUsedTest.php` (append permission-gate tests)
- Modify: `inc/modules/pattern-library/class-sydney-pattern-library.php` (add three handler methods + two `register_rest_route` calls in `register_rest_routes()`)

- [ ] **Step 1: Append permission-gate tests to the test file**

In `tests/unit/PatternLibraryRecentlyUsedTest.php`, immediately before the class's closing `}`, add:

```php
	// -----------------------------------------------------------------
	// rest_recently_used_permissions_check
	// -----------------------------------------------------------------

	public function test_recently_used_permissions_check_blocks_anonymous_users() {
		M::userFunction( 'is_user_logged_in', array( 'return' => false ) );
		M::userFunction( 'current_user_can', array( 'return' => false ) );

		$instance = \Sydney_Pattern_Library::get_instance();
		$this->assertFalse( $instance->rest_recently_used_permissions_check() );
	}

	public function test_recently_used_permissions_check_blocks_logged_in_users_without_edit_posts() {
		M::userFunction( 'is_user_logged_in', array( 'return' => true ) );
		M::userFunction( 'current_user_can', array(
			'args'   => array( 'edit_posts' ),
			'return' => false,
		) );

		$instance = \Sydney_Pattern_Library::get_instance();
		$this->assertFalse( $instance->rest_recently_used_permissions_check() );
	}

	public function test_recently_used_permissions_check_allows_logged_in_users_with_edit_posts() {
		M::userFunction( 'is_user_logged_in', array( 'return' => true ) );
		M::userFunction( 'current_user_can', array(
			'args'   => array( 'edit_posts' ),
			'return' => true,
		) );

		$instance = \Sydney_Pattern_Library::get_instance();
		$this->assertTrue( $instance->rest_recently_used_permissions_check() );
	}
```

- [ ] **Step 2: Run the new tests to verify they fail**

Run: `./vendor/bin/phpunit tests/unit/PatternLibraryRecentlyUsedTest.php --filter recently_used_permissions_check`
Expected: 3 tests fail with `Error: Call to undefined method Sydney_Pattern_Library::rest_recently_used_permissions_check()`.

- [ ] **Step 3: Add the three REST handler methods**

In `inc/modules/pattern-library/class-sydney-pattern-library.php`, locate the end of `rest_update_favorites()` (around line 305). **Immediately after** that method's closing `}` and before the PHPDoc block for `get_user_favorites()`, add:

```php
		/**
		 * REST permission gate for recently-used routes: logged-in editors only.
		 *
		 * Mirrors rest_favorites_permissions_check(). Explicit
		 * `is_user_logged_in()` check produces a clean 401 for anonymous callers;
		 * the capability check produces a 403 for authenticated-but-under-
		 * privileged callers.
		 *
		 * @return bool
		 */
		public function rest_recently_used_permissions_check() {
			return is_user_logged_in() && current_user_can( 'edit_posts' );
		}

		/**
		 * GET handler — return the current user's recently-used patterns.
		 *
		 * @return \WP_REST_Response
		 */
		public function rest_get_recently_used() {
			return rest_ensure_response(
				array( 'recently_used' => self::get_user_recently_used( get_current_user_id() ) )
			);
		}

		/**
		 * POST handler — sanitize and persist the user's recently-used array.
		 *
		 * @param \WP_REST_Request $request REST request.
		 * @return \WP_REST_Response
		 */
		public function rest_update_recently_used( $request ) {
			$sanitized = self::sanitize_recently_used_input( $request->get_param( 'recently_used' ) );

			update_user_meta(
				get_current_user_id(),
				self::RECENTLY_USED_META_KEY,
				wp_json_encode( $sanitized )
			);

			return rest_ensure_response( array( 'recently_used' => $sanitized ) );
		}
```

- [ ] **Step 4: Register the two new REST routes**

In `register_rest_routes()` (starts around line 232), locate the end of the existing `register_rest_route` for `pattern-favorites` POST (closes around line 262). **Immediately after** that closing `);` and before the closing `}` of `register_rest_routes()`, add:

```php
			register_rest_route(
				'sydney/v1',
				'/pattern-recently-used',
				array(
					'methods'             => 'GET',
					'callback'            => array( $this, 'rest_get_recently_used' ),
					'permission_callback' => array( $this, 'rest_recently_used_permissions_check' ),
					'show_in_index'       => false,
				)
			);

			register_rest_route(
				'sydney/v1',
				'/pattern-recently-used',
				array(
					'methods'             => 'POST',
					'callback'            => array( $this, 'rest_update_recently_used' ),
					'permission_callback' => array( $this, 'rest_recently_used_permissions_check' ),
					'show_in_index'       => false,
					'args'                => array(
						'recently_used' => array(
							'required' => true,
							'type'     => 'array',
							'items'    => array(
								'type' => 'string',
							),
						),
					),
				)
			);
```

- [ ] **Step 5: Run permission-gate tests to verify they pass**

Run: `./vendor/bin/phpunit tests/unit/PatternLibraryRecentlyUsedTest.php --filter recently_used_permissions_check`
Expected: 3 tests pass.

- [ ] **Step 6: Run the full test file to confirm no regressions**

Run: `./vendor/bin/phpunit tests/unit/PatternLibraryRecentlyUsedTest.php`
Expected: 14 tests pass (6 sanitizer + 5 getter + 3 permissions).

- [ ] **Step 7: Run the entire PHP test suite to confirm nothing else broke**

Run: `composer test`
Expected: All pre-existing tests still pass alongside the new 14.

- [ ] **Step 8: Run PHPCS on modified files**

Run: `composer phpcs -- inc/modules/pattern-library/class-sydney-pattern-library.php tests/unit/PatternLibraryRecentlyUsedTest.php`
Expected: 0 errors. (Auto-fix with `composer phpcs:fix` if needed, then re-verify.)

- [ ] **Step 9: Commit**

```bash
git add tests/unit/PatternLibraryRecentlyUsedTest.php inc/modules/pattern-library/class-sydney-pattern-library.php
git commit -m "feat(#399): add recently-used REST routes and permission gate"
```

---

## Task 5: Backend — extend `wp_localize_script` payload

**Files:**
- Modify: `inc/modules/pattern-library/class-sydney-pattern-library.php:212-221` (the `wp_localize_script` call)

- [ ] **Step 1: Add `recently_used` to the localized payload**

In `inc/modules/pattern-library/class-sydney-pattern-library.php`, locate the existing `wp_localize_script` call:

```php
		wp_localize_script(
			'sydney-pattern-library',
			'sydneyPatternLibrary',
			array(
				'isPro'      => defined( 'SYDNEY_PRO_VERSION' ),
				'upgradeUrl' => 'https://athemes.com/sydney-upgrade/',
				'favorites'  => self::get_user_favorites( get_current_user_id() ),
				'typeOrder'  => array_keys( $this->get_categories() ),
			)
		);
```

Replace it with the version that also exposes `recentlyUsed`:

```php
		wp_localize_script(
			'sydney-pattern-library',
			'sydneyPatternLibrary',
			array(
				'isPro'        => defined( 'SYDNEY_PRO_VERSION' ),
				'upgradeUrl'   => 'https://athemes.com/sydney-upgrade/',
				'favorites'    => self::get_user_favorites( get_current_user_id() ),
				'recentlyUsed' => self::get_user_recently_used( get_current_user_id() ),
				'typeOrder'    => array_keys( $this->get_categories() ),
			)
		);
```

(Note: the JS-side property is `recentlyUsed`, not `recently_used`. The REST payload key uses snake_case; the localized JS payload uses camelCase to match JS conventions — same way `typeOrder` is camelCase.)

- [ ] **Step 2: Verify syntax**

Run: `php -l inc/modules/pattern-library/class-sydney-pattern-library.php`
Expected: `No syntax errors detected`.

- [ ] **Step 3: Verify PHPCS still passes**

Run: `composer phpcs -- inc/modules/pattern-library/class-sydney-pattern-library.php`
Expected: 0 errors.

- [ ] **Step 4: Commit**

```bash
git add inc/modules/pattern-library/class-sydney-pattern-library.php
git commit -m "feat(#399): expose recently-used patterns in the localized script payload"
```

---

## Task 6: Frontend — constants

**Files:**
- Modify: `inc/modules/pattern-library/src/constants.js`

- [ ] **Step 1: Add `RECENTLY_USED_MAX`**

Open `inc/modules/pattern-library/src/constants.js` (currently 4 lines). Replace the entire contents with:

```js
// Category display order — populated by wp_localize_script() from the PHP
// get_categories() method in class-sydney-pattern-library.php.
export const TYPE_ORDER = window.sydneyPatternLibrary?.typeOrder || [];

// Maximum number of recently-used patterns kept in the client-side LRU.
// One screen of pattern cards in the grid. Server-side cap is higher
// (RECENTLY_USED_SERVER_CAP = 50 in PHP) so future bumps don't need a
// migration.
export const RECENTLY_USED_MAX = 12;
```

- [ ] **Step 2: Commit**

```bash
git add inc/modules/pattern-library/src/constants.js
git commit -m "feat(#399): add RECENTLY_USED_MAX frontend constant"
```

---

## Task 7: Frontend — store state slice + `trackPatternInsert` action

**Files:**
- Modify: `inc/modules/pattern-library/src/store/index.js`

- [ ] **Step 1: Add the recently-used state slice and action**

Open `inc/modules/pattern-library/src/store/index.js`. We're going to make four edits within this file: imports, INITIAL constants, DEFAULT_STATE, actions, reducer, and selectors.

**Edit A — imports.** Locate the existing import block at the top (lines 1–2):

```js
import { createReduxStore, register, subscribe, select } from "@wordpress/data";
import apiFetch from "@wordpress/api-fetch";
```

Add a third import directly below it:

```js
import { RECENTLY_USED_MAX } from "../constants.js";
```

**Edit B — INITIAL_RECENTLY_USED.** Locate the existing `INITIAL_FAVORITES` block (lines 6–8):

```js
const INITIAL_FAVORITES = Array.isArray( window.sydneyPatternLibrary?.favorites )
  ? window.sydneyPatternLibrary.favorites
  : [];
```

Add immediately below it:

```js
const INITIAL_RECENTLY_USED = Array.isArray( window.sydneyPatternLibrary?.recentlyUsed )
  ? window.sydneyPatternLibrary.recentlyUsed
  : [];
```

**Edit C — DEFAULT_STATE.** Locate `DEFAULT_STATE` (lines 10–15):

```js
const DEFAULT_STATE = {
  selectedType: "all",
  isModalOpen: false,
  searchQuery: "",
  favorites: INITIAL_FAVORITES,
};
```

Replace with:

```js
const DEFAULT_STATE = {
  selectedType: "all",
  isModalOpen: false,
  searchQuery: "",
  favorites: INITIAL_FAVORITES,
  recentlyUsed: INITIAL_RECENTLY_USED,
};
```

**Edit D — actions.** Locate the existing `actions` object (lines 17–36). After `setFavorites`, add the new action. Replace the closing `};` of the actions object with these new entries followed by the closing brace:

```js
  setFavorites(names) {
    return { type: "SET_FAVORITES", names };
  },
  trackPatternInsert(patternName) {
    return { type: "TRACK_PATTERN_INSERT", patternName };
  },
};
```

**Edit E — reducer.** Locate the `reducer` function (lines 38–65). Inside the `switch`, after the existing `case "SET_FAVORITES":` block and **before** the final `return state;`, add a new case:

```js
    case "TRACK_PATTERN_INSERT": {
      const name = action.patternName;
      if ( typeof name !== "string" || ! name ) {
        return state;
      }
      // Move-to-front: drop any existing instance, prepend, truncate to cap.
      const next = [ name, ...state.recentlyUsed.filter( ( n ) => n !== name ) ].slice( 0, RECENTLY_USED_MAX );
      return { ...state, recentlyUsed: next };
    }
```

**Edit F — selectors.** Locate the `selectors` object (lines 67–83). After `isFavorite`, before the closing `};`, add:

```js
  getRecentlyUsed(state) {
    return state.recentlyUsed;
  },
```

After these six edits, the top of the file (through the reducer) should read:

```js
import { createReduxStore, register, subscribe, select } from "@wordpress/data";
import apiFetch from "@wordpress/api-fetch";
import { RECENTLY_USED_MAX } from "../constants.js";

const STORE_NAME = "sydney/pattern-library";

const INITIAL_FAVORITES = Array.isArray( window.sydneyPatternLibrary?.favorites )
  ? window.sydneyPatternLibrary.favorites
  : [];

const INITIAL_RECENTLY_USED = Array.isArray( window.sydneyPatternLibrary?.recentlyUsed )
  ? window.sydneyPatternLibrary.recentlyUsed
  : [];

const DEFAULT_STATE = {
  selectedType: "all",
  isModalOpen: false,
  searchQuery: "",
  favorites: INITIAL_FAVORITES,
  recentlyUsed: INITIAL_RECENTLY_USED,
};
```

(Other sections of the file are unchanged from the original layout; only the additive edits above are required.)

- [ ] **Step 2: Build assets to confirm the file compiles**

Run: `cd inc/modules/pattern-library && npm run build && cd -`
Expected: Webpack build succeeds with no errors. (Build artifacts are not committed; this is a verification-only step.)

- [ ] **Step 3: Commit (source only — do NOT commit build/)**

```bash
git add inc/modules/pattern-library/src/store/index.js
git commit -m "feat(#399): add recentlyUsed state slice and trackPatternInsert action"
```

---

## Task 8: Frontend — debounced persistence for recently-used

**Files:**
- Modify: `inc/modules/pattern-library/src/store/index.js` (extend the existing debounced subscribe block)

- [ ] **Step 1: Add a second debounce timer + subscribe block**

Open `inc/modules/pattern-library/src/store/index.js` and locate the existing favorites persistence block (lines 88–117):

```js
// Debounced persistence: coalesce rapid toggles into a single POST.
const PERSIST_DEBOUNCE_MS = 400;
let lastPersisted = JSON.stringify(INITIAL_FAVORITES);
let persistTimer = null;

subscribe(() => {
  const current = select(STORE_NAME).getFavorites();
  const serialized = JSON.stringify(current);
  if (serialized === lastPersisted) {
    return;
  }
  lastPersisted = serialized;

  if (persistTimer) {
    clearTimeout(persistTimer);
  }
  persistTimer = setTimeout(() => {
    persistTimer = null;
    apiFetch({
      path: "/sydney/v1/pattern-favorites",
      method: "POST",
      data: { favorites: current },
    }).catch((error) => {
      // Quiet failure — favorites are a personal preference, not load-bearing.
      // Next successful write will resync the array.
      // eslint-disable-next-line no-console
      console.error("Sydney pattern library: failed to persist favorites", error);
    });
  }, PERSIST_DEBOUNCE_MS);
});
```

Rename the favorites-only variables (`lastPersisted` → `lastPersistedFavorites`, `persistTimer` → `favoritesPersistTimer`) so the names disambiguate from the new recently-used pair we're adding. Then append a second, independent subscribe block. Replace the entire block above with:

```js
// Debounced persistence: coalesce rapid changes into a single POST per slice.
// Favorites and recently-used use independent timers so a failure on one
// doesn't stall the other.
const PERSIST_DEBOUNCE_MS = 400;

let lastPersistedFavorites = JSON.stringify(INITIAL_FAVORITES);
let favoritesPersistTimer = null;

subscribe(() => {
  const current = select(STORE_NAME).getFavorites();
  const serialized = JSON.stringify(current);
  if (serialized === lastPersistedFavorites) {
    return;
  }
  lastPersistedFavorites = serialized;

  if (favoritesPersistTimer) {
    clearTimeout(favoritesPersistTimer);
  }
  favoritesPersistTimer = setTimeout(() => {
    favoritesPersistTimer = null;
    apiFetch({
      path: "/sydney/v1/pattern-favorites",
      method: "POST",
      data: { favorites: current },
    }).catch((error) => {
      // Quiet failure — favorites are a personal preference, not load-bearing.
      // Next successful write will resync the array.
      // eslint-disable-next-line no-console
      console.error("Sydney pattern library: failed to persist favorites", error);
    });
  }, PERSIST_DEBOUNCE_MS);
});

let lastPersistedRecentlyUsed = JSON.stringify(INITIAL_RECENTLY_USED);
let recentlyUsedPersistTimer = null;

subscribe(() => {
  const current = select(STORE_NAME).getRecentlyUsed();
  const serialized = JSON.stringify(current);
  if (serialized === lastPersistedRecentlyUsed) {
    return;
  }
  lastPersistedRecentlyUsed = serialized;

  if (recentlyUsedPersistTimer) {
    clearTimeout(recentlyUsedPersistTimer);
  }
  recentlyUsedPersistTimer = setTimeout(() => {
    recentlyUsedPersistTimer = null;
    apiFetch({
      path: "/sydney/v1/pattern-recently-used",
      method: "POST",
      data: { recently_used: current },
    }).catch((error) => {
      // Quiet failure — recently-used is convenience surface, not load-bearing.
      // Next successful write will resync the array.
      // eslint-disable-next-line no-console
      console.error("Sydney pattern library: failed to persist recently used", error);
    });
  }, PERSIST_DEBOUNCE_MS);
});
```

- [ ] **Step 2: Build assets to confirm**

Run: `cd inc/modules/pattern-library && npm run build && cd -`
Expected: Webpack succeeds, no errors, no warnings about undefined `RECENTLY_USED_MAX` or `getRecentlyUsed`.

- [ ] **Step 3: Commit**

```bash
git add inc/modules/pattern-library/src/store/index.js
git commit -m "feat(#399): persist recently-used patterns via debounced POST"
```

---

## Task 9: Frontend — `PatternGrid` filter branch

**Files:**
- Modify: `inc/modules/pattern-library/src/components/PatternGrid.js`

- [ ] **Step 1: Add the recently-used selector and filter branch**

Open `inc/modules/pattern-library/src/components/PatternGrid.js`. Two edits.

**Edit A — pull `recentlyUsed` from the store.** Locate lines 17–22:

```js
	const selectedType = useSelect( ( select ) => select( STORE_NAME ).getSelectedType() );
	const searchQuery = useSelect( ( select ) => select( STORE_NAME ).getSearchQuery() );
	const favorites = useSelect( ( select ) => select( STORE_NAME ).getFavorites() );
	const favoriteSet = useMemo( () => new Set( favorites ), [ favorites ] );
	const isPro = window.sydneyPatternLibrary?.isPro || false;
	const upgradeUrl = window.sydneyPatternLibrary?.upgradeUrl || '';
```

Insert two new lines after the `favoriteSet` memo (after line 20), before the `isPro` line:

```js
	const recentlyUsed = useSelect( ( select ) => select( STORE_NAME ).getRecentlyUsed() );
	const recentlyUsedSet = useMemo( () => new Set( recentlyUsed ), [ recentlyUsed ] );
	const recentlyUsedOrder = useMemo( () => {
		const order = new Map();
		recentlyUsed.forEach( ( name, index ) => order.set( name, index ) );
		return order;
	}, [ recentlyUsed ] );
```

The block now reads:

```js
	const selectedType = useSelect( ( select ) => select( STORE_NAME ).getSelectedType() );
	const searchQuery = useSelect( ( select ) => select( STORE_NAME ).getSearchQuery() );
	const favorites = useSelect( ( select ) => select( STORE_NAME ).getFavorites() );
	const favoriteSet = useMemo( () => new Set( favorites ), [ favorites ] );
	const recentlyUsed = useSelect( ( select ) => select( STORE_NAME ).getRecentlyUsed() );
	const recentlyUsedSet = useMemo( () => new Set( recentlyUsed ), [ recentlyUsed ] );
	const recentlyUsedOrder = useMemo( () => {
		const order = new Map();
		recentlyUsed.forEach( ( name, index ) => order.set( name, index ) );
		return order;
	}, [ recentlyUsed ] );
	const isPro = window.sydneyPatternLibrary?.isPro || false;
	const upgradeUrl = window.sydneyPatternLibrary?.upgradeUrl || '';
```

**Edit B — add the `"recent"` filter branch and order it correctly.** Locate the filter expression (lines 38–46):

```js
	const filtered = patterns.filter( ( pattern ) => {
		let matchesType;
		if ( selectedType === 'all' ) {
			matchesType = true;
		} else if ( selectedType === 'favorites' ) {
			matchesType = favoriteSet.has( pattern.name );
		} else {
			matchesType = ( pattern.categories || [] ).includes( selectedType );
		}
```

Add a `recent` branch between favorites and the category default. Replace lines 38–46 with:

```js
	const filtered = patterns.filter( ( pattern ) => {
		let matchesType;
		if ( selectedType === 'all' ) {
			matchesType = true;
		} else if ( selectedType === 'favorites' ) {
			matchesType = favoriteSet.has( pattern.name );
		} else if ( selectedType === 'recent' ) {
			matchesType = recentlyUsedSet.has( pattern.name );
		} else {
			matchesType = ( pattern.categories || [] ).includes( selectedType );
		}
```

**Edit C — order the recent view by recency.** Locate line 54:

```js
	const sorted = [ ...filtered ].sort( ( a, b ) => getTypeIndex( a ) - getTypeIndex( b ) );
```

Replace with:

```js
	const sorted = [ ...filtered ].sort( ( a, b ) => {
		if ( selectedType === 'recent' ) {
			// Preserve LRU ordering from the recentlyUsed array.
			return ( recentlyUsedOrder.get( a.name ) ?? Infinity ) - ( recentlyUsedOrder.get( b.name ) ?? Infinity );
		}
		return getTypeIndex( a ) - getTypeIndex( b );
	} );
```

- [ ] **Step 2: Build to confirm**

Run: `cd inc/modules/pattern-library && npm run build && cd -`
Expected: Webpack succeeds with no errors.

- [ ] **Step 3: Commit**

```bash
git add inc/modules/pattern-library/src/components/PatternGrid.js
git commit -m "feat(#399): filter and order pattern grid for recent view"
```

---

## Task 10: Frontend — modal header toggle + wrap `onInsert`

**Files:**
- Modify: `inc/modules/pattern-library/src/components/PatternLibraryModal.js`

- [ ] **Step 1: Pull `recentlyUsed` from the store and wrap `onInsert`**

Open `inc/modules/pattern-library/src/components/PatternLibraryModal.js`.

**Edit A — selectors and dispatch.** Locate lines 25–28:

```js
  const searchQuery = useSelect((select) => select(STORE_NAME).getSearchQuery());
  const selectedType = useSelect((select) => select(STORE_NAME).getSelectedType());
  const favorites = useSelect((select) => select(STORE_NAME).getFavorites());
  const { setSearch, setType } = useDispatch(STORE_NAME);
```

Replace with:

```js
  const searchQuery = useSelect((select) => select(STORE_NAME).getSearchQuery());
  const selectedType = useSelect((select) => select(STORE_NAME).getSelectedType());
  const favorites = useSelect((select) => select(STORE_NAME).getFavorites());
  const recentlyUsed = useSelect((select) => select(STORE_NAME).getRecentlyUsed());
  const { setSearch, setType, trackPatternInsert } = useDispatch(STORE_NAME);
```

**Edit B — visibility flags.** Locate lines 32–33:

```js
  const isFavoritesActive = selectedType === "favorites";
  const showFavoritesFilter = favorites.length > 0;
```

Replace with:

```js
  const isFavoritesActive = selectedType === "favorites";
  const showFavoritesFilter = favorites.length > 0;
  const isRecentActive = selectedType === "recent";
  const showRecentFilter = recentlyUsed.length > 0;

  function handleInsert(pattern, blocks) {
    trackPatternInsert(pattern.name);
    onInsert(pattern, blocks);
  }
```

**Edit C — render the Recent toggle to the LEFT of Favorites.** Locate the existing `header-left` block (lines 85–116):

```jsx
            <div className="sydney-pattern-library-modal-header-left">
              {showFavoritesFilter && (
                <button
                  type="button"
                  className={`sydney-pattern-library-favorites-filter${
                    isFavoritesActive ? " is-active" : ""
                  }`}
                  aria-pressed={isFavoritesActive}
                  onClick={() => setType(isFavoritesActive ? "all" : "favorites")}
                >
                  <svg
                    width="14"
                    height="14"
                    viewBox="0 0 24 24"
                    fill={isFavoritesActive ? "currentColor" : "none"}
                    stroke="currentColor"
                    strokeWidth="2"
                    strokeLinecap="round"
                    strokeLinejoin="round"
                    aria-hidden="true"
                    focusable="false"
                  >
                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                  </svg>
                  {sprintf(
                    /* translators: %d: number of favorited patterns */
                    __("Favorites (%d)", "sydney"),
                    favorites.length
                  )}
                </button>
              )}
            </div>
```

Replace with — Recent toggle inserted **before** the favorites toggle. The Recent SVG is the standard counterclockwise-arrow / history glyph (Feather Icons `rotate-ccw`); 14×14 to match the Favorites heart:

```jsx
            <div className="sydney-pattern-library-modal-header-left">
              {showRecentFilter && (
                <button
                  type="button"
                  className={`sydney-pattern-library-recently-used-filter${
                    isRecentActive ? " is-active" : ""
                  }`}
                  aria-pressed={isRecentActive}
                  onClick={() => setType(isRecentActive ? "all" : "recent")}
                >
                  <svg
                    width="14"
                    height="14"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    strokeWidth="2"
                    strokeLinecap="round"
                    strokeLinejoin="round"
                    aria-hidden="true"
                    focusable="false"
                  >
                    <polyline points="1 4 1 10 7 10" />
                    <path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10" />
                  </svg>
                  {sprintf(
                    /* translators: %d: number of recently-used patterns */
                    __("Recently used (%d)", "sydney"),
                    recentlyUsed.length
                  )}
                </button>
              )}
              {showFavoritesFilter && (
                <button
                  type="button"
                  className={`sydney-pattern-library-favorites-filter${
                    isFavoritesActive ? " is-active" : ""
                  }`}
                  aria-pressed={isFavoritesActive}
                  onClick={() => setType(isFavoritesActive ? "all" : "favorites")}
                >
                  <svg
                    width="14"
                    height="14"
                    viewBox="0 0 24 24"
                    fill={isFavoritesActive ? "currentColor" : "none"}
                    stroke="currentColor"
                    strokeWidth="2"
                    strokeLinecap="round"
                    strokeLinejoin="round"
                    aria-hidden="true"
                    focusable="false"
                  >
                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
                  </svg>
                  {sprintf(
                    /* translators: %d: number of favorited patterns */
                    __("Favorites (%d)", "sydney"),
                    favorites.length
                  )}
                </button>
              )}
            </div>
```

**Edit D — pass `handleInsert` to `PatternGrid`.** Locate lines 123–129:

```jsx
          <div className="sydney-pattern-library-modal-grid-container">
            <PatternGrid
              patterns={sydneyPatterns}
              isLoading={isLoading}
              onInsert={onInsert}
            />
          </div>
```

Replace the `onInsert` prop value:

```jsx
          <div className="sydney-pattern-library-modal-grid-container">
            <PatternGrid
              patterns={sydneyPatterns}
              isLoading={isLoading}
              onInsert={handleInsert}
            />
          </div>
```

- [ ] **Step 2: Build to confirm**

Run: `cd inc/modules/pattern-library && npm run build && cd -`
Expected: Webpack succeeds.

- [ ] **Step 3: Commit**

```bash
git add inc/modules/pattern-library/src/components/PatternLibraryModal.js
git commit -m "feat(#399): render recently-used toggle and track inserts in modal"
```

---

## Task 11: Frontend — CSS for the new toggle

**Files:**
- Modify: `inc/modules/pattern-library/src/index.css:285` (insert above the existing favorites-filter block)

- [ ] **Step 1: Add the new toggle styles**

Open `inc/modules/pattern-library/src/index.css` and locate the existing favorites-filter block (lines 285–308):

```css
.sydney-pattern-library-favorites-filter {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  background: transparent;
  border: 0;
  padding: 4px 6px;
  margin: 0;
  font: inherit;
  color: var(--color-heading);
  cursor: pointer;
  border-radius: 2px;
}
.sydney-pattern-library-favorites-filter svg {
  flex-shrink: 0;
}
.sydney-pattern-library-favorites-filter:hover,
.sydney-pattern-library-favorites-filter.is-active {
  color: var(--wp-admin-theme-color, #3858e9);
}
.sydney-pattern-library-favorites-filter:focus-visible {
  outline: none;
  box-shadow: 0 0 0 2px var(--wp-admin-theme-color, #3858e9);
}
```

**Immediately before** the `.sydney-pattern-library-favorites-filter {` line, insert the parallel ruleset for recently-used (duplicating the styles per the spec — no shared mixin at this scope):

```css
.sydney-pattern-library-recently-used-filter {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  background: transparent;
  border: 0;
  padding: 4px 6px;
  margin: 0;
  font: inherit;
  color: var(--color-heading);
  cursor: pointer;
  border-radius: 2px;
}
.sydney-pattern-library-recently-used-filter svg {
  flex-shrink: 0;
}
.sydney-pattern-library-recently-used-filter:hover,
.sydney-pattern-library-recently-used-filter.is-active {
  color: var(--wp-admin-theme-color, #3858e9);
}
.sydney-pattern-library-recently-used-filter:focus-visible {
  outline: none;
  box-shadow: 0 0 0 2px var(--wp-admin-theme-color, #3858e9);
}
```

- [ ] **Step 2: Build to confirm CSS compiles**

Run: `cd inc/modules/pattern-library && npm run build && cd -`
Expected: Webpack succeeds. (CSS is bundled by `@wordpress/scripts` via `import './index.css'` in `src/index.js`.)

- [ ] **Step 3: Commit**

```bash
git add inc/modules/pattern-library/src/index.css
git commit -m "feat(#399): add CSS for recently-used filter toggle"
```

---

## Task 12: Manual smoke test in WordPress

**Files:** None — pure verification.

This is the only end-to-end check before opening the PR. Pattern Library has no Playwright coverage today, and we're keeping that scope.

- [ ] **Step 1: Build assets one final time**

Run: `cd inc/modules/pattern-library && npm run build && cd -`
Expected: Webpack succeeds. Note: build outputs in `inc/modules/pattern-library/build/` are NOT committed in this branch (per repo convention — release branches only).

- [ ] **Step 2: Open WordPress block editor in the dev environment**

Visit `http://sydney.local/wp-admin/` (the default URL from `wpgulp.config.js`), log in as admin, and create or edit a page/post.

- [ ] **Step 3: Verify the modal opens cleanly**

Click the "Pattern Library" button in the editor toolbar (added by `LibraryButton`). The modal should open without console errors.

In the browser devtools console, confirm:

```js
console.log(window.sydneyPatternLibrary.recentlyUsed);
```

Expected: an array (initially `[]` for a fresh user, or the persisted list for a returning user).

- [ ] **Step 4: Verify Recently-used toggle is hidden on first visit**

For a fresh user with `recentlyUsed = []`, the "Recently used" button in the modal header should be **absent**. Only the Favorites toggle (if any favorites exist) should be visible. This matches the "hide until first insert" requirement.

- [ ] **Step 5: Insert a pattern**

Click any pattern in the grid to insert it. The modal closes, the pattern lands in the editor.

- [ ] **Step 6: Verify the toggle appears**

Reopen the Pattern Library modal. The "Recently used (1)" button should now appear to the LEFT of the Favorites toggle in the header bar.

- [ ] **Step 7: Verify the filter works**

Click "Recently used (1)". The grid should filter down to exactly the one pattern just inserted. The button should show its active state (`is-active` class — colored).

- [ ] **Step 8: Verify ordering**

Close the modal, insert 3 more different patterns one at a time (each round-trip: open modal, click pattern, modal closes). Reopen the modal, click "Recently used (4)". The grid should show patterns in MOST-RECENT-FIRST order — the last one inserted should be first.

- [ ] **Step 9: Verify dedup + move-to-front**

Insert one of the existing patterns again (e.g. the second-to-most-recent). Reopen the modal. The count should still be `(4)` — no duplicate. That pattern should now be in position 1 (top-left).

- [ ] **Step 10: Verify mutual exclusion with Favorites**

With Recently-used view active, click the Favorites toggle. The view should switch to Favorites (recently-used loses its active state). Click Recently-used again — switches back.

- [ ] **Step 11: Verify persistence across reload**

Reload the editor (`Cmd+R`). Reopen the modal. The Recently-used button should still show the same count and patterns.

- [ ] **Step 12: Verify network call**

In devtools → Network tab, filter by `pattern-recently-used`. Each insert should produce **at most one** POST to `/wp-json/sydney/v1/pattern-recently-used` (debounced at 400ms). Response status: 200. Response body: `{ "recently_used": [...] }` matching the array sent.

- [ ] **Step 13: Verify the cap (optional spot check)**

Insert 13 different patterns. Reopen the modal. The Recently-used count should cap at `(12)`. The 13th insertion should evict the oldest entry.

- [ ] **Step 14: Verify no console errors**

Throughout all the above, the browser console should remain clean. The only acceptable `console.error` would be from a network failure (which you should not encounter in a healthy dev environment).

- [ ] **Step 15: Final test + PHPCS sweep**

Run:
```bash
composer test
composer phpcs
```
Expected: Both pass cleanly.

- [ ] **Step 16: Final commit if anything was tweaked during smoke testing**

If everything passed without changes, no commit is needed for this task. If smoke testing revealed a fix-needed issue, address it as a follow-up commit before opening the PR:

```bash
git add <files>
git commit -m "fix(#399): <what was wrong>"
```

---

## Done — opening the PR

Once Task 12 passes cleanly:

1. Push the branch: `git push -u origin feature/399-phase-1a-b-pattern-library-recently-used`
2. Open PR against `develop` (never `master`) using the `/create-pr` skill or `gh pr create`.
3. Link the PR to issue #399. The Zenhub state should auto-move to "Review/QA" via the `/create-pr` skill (or manually if using raw `gh`).
4. Build artifacts (`inc/modules/pattern-library/build/*`) stay uncommitted in this branch — they will be regenerated on the release branch per existing convention.
