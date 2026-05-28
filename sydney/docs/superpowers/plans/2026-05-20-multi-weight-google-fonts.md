# Multi-Weight Google Fonts Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Let users load extra Google Font weights per typography slot (body, headings, menu) so individual Gutenberg blocks can use any loaded weight via their built-in weight picker, while the existing "primary weight" (applied as the default to `body`, `h1..h6`, `#mainnav`) keeps working unchanged.

**Architecture:** Today each typography theme_mod stores `{ font, regularweight, category }`. Keep `regularweight` exactly as today (the primary weight applied via PHP CSS rules). Add a new additive key `extraweights: []` storing additional weights to LOAD but not apply. The Customizer typography control gains a new Select2 multi-select control labeled "Additional weights to load" beneath the existing single-select weight dropdown. `sydney_google_fonts_url()` is refactored to emit `wght@a;b;c` per slot using the combined (primary + extras) set. When no extras are configured, the generated URL is byte-identical to today's — the load-bearing backward-compatibility constraint.

**Why we are NOT stripping `font-weight: …` from PHP:** Block-level weight pickers in Gutenberg write inline `style="font-weight: …"` on rendered HTML, and inline styles always beat external CSS rules in specificity. The existing `body { font-weight: 400 }` written by `inc/styles.php` does not block per-block weight picking. (To be confirmed during manual verification — see Task 7 Step 4.)

**Tech Stack:** PHP 7.2+, WordPress Customizer API, Select2 (already bundled at `inc/customizer/controls/typography/select2.full.min.js`), WP_Mock + PHPUnit.

**Files touched:**

- Modified: `inc/extras.php` (add helper + rewrite `sydney_google_fonts_url()`)
- Modified: `inc/customizer/sanitize.php` (`sydney_google_fonts_sanitize()` accepts and validates `extraweights` array)
- Modified: `inc/customizer/controls/typography/class_sydney_typography.php` (render new `<select multiple>` for extras beneath the existing weight dropdown)
- Modified: `inc/customizer/controls/typography/script.js` (Select2 multi-init on extras control, write `extraweights` to JSON, fix `botigafontslist` → `sydneyfontslist` typo, strip dead italic/bold branches, family-change preserves both primary and extras)
- Modified: `inc/customizer/controls/typography/styles.css` (multi-select layout)
- New: `tests/unit/TypographyLoadedWeightsTest.php` (helper tests)
- New: `tests/unit/GoogleFontsSanitizeTest.php` (sanitizer tests)
- New: `tests/unit/GoogleFontsUrlTest.php` (URL-builder golden tests, incl. legacy byte-identical case)

**Intentionally NOT touched:**

- `inc/styles.php` — keep writing `font-weight: <regularweight>` on `body`, `h1..h6,.site-title`, `#mainnav > div > ul > li > a`. Primary weight remains the visible default; block-level inline styles still override via specificity.
- `inc/editor.php` — keep writing `font-weight` in editor inline CSS for the same reason.
- `inc/customizer/style-book/class-sydney-style-book.php` — keep writing `font-weight` and keep `typography_config()` passing the scalar `regularweight` to the sample API.
- `inc/fonts.php` — the `sydney_enqueue_google_fonts()` it defines is dead code (no callers); leave alone, surgical changes.
- `inc/vendor/wptt-webfont-loader/*` — the loader downloads whatever `.woff2` files the upstream Google Fonts URL references, so multi-weight URLs Just Work.
- `inc/theme-update.php` — no migration needed; legacy single-weight sites with no `extraweights` key produce a byte-identical URL.

---

## Task 1: Add `sydney_typography_loaded_weights()` helper (TDD)

Helper that, given a decoded typography theme_mod, returns the deduplicated, numerically sorted `string[]` of all weights to LOAD — that is, the combined set of `regularweight` (the primary, normalised: `"regular"` → `"400"`) and `extraweights` (array of additional weights).

**Files:**
- Create: `tests/unit/TypographyLoadedWeightsTest.php`
- Modify: `inc/extras.php` (add helper just above `sydney_google_fonts_url()` at line ~652)

- [ ] **Step 1: Write the failing tests**

Create `tests/unit/TypographyLoadedWeightsTest.php`:

```php
<?php
/**
 * Unit tests for sydney_typography_loaded_weights() helper.
 *
 * @package Sydney
 * @subpackage Tests
 */

namespace Sydney\Tests;

class TypographyLoadedWeightsTest extends BaseThemeTest {

	public function setUp(): void {
		parent::setUp();
		if ( ! function_exists( 'sydney_typography_loaded_weights' ) ) {
			require_once dirname( __DIR__, 2 ) . '/inc/extras.php';
		}
	}

	public function test_primary_only_numeric_returns_single_element_array() {
		$font = array( 'font' => 'Roboto', 'regularweight' => '400', 'category' => 'sans-serif' );
		$this->assertSame( array( '400' ), \sydney_typography_loaded_weights( $font ) );
	}

	public function test_primary_only_regular_keyword_normalises_to_400() {
		$font = array( 'font' => 'Roboto', 'regularweight' => 'regular', 'category' => 'sans-serif' );
		$this->assertSame( array( '400' ), \sydney_typography_loaded_weights( $font ) );
	}

	public function test_primary_plus_extras_are_combined_deduped_and_sorted() {
		$font = array(
			'font'          => 'Roboto',
			'regularweight' => '300',
			'extraweights'  => array( '600', '400', '500' ),
			'category'      => 'sans-serif',
		);
		$this->assertSame( array( '300', '400', '500', '600' ), \sydney_typography_loaded_weights( $font ) );
	}

	public function test_extras_duplicating_primary_are_deduped() {
		$font = array(
			'font'          => 'Roboto',
			'regularweight' => '400',
			'extraweights'  => array( '400', '600' ),
			'category'      => 'sans-serif',
		);
		$this->assertSame( array( '400', '600' ), \sydney_typography_loaded_weights( $font ) );
	}

	public function test_extras_with_regular_keyword_normalises_and_dedupes_against_primary() {
		$font = array(
			'font'          => 'Roboto',
			'regularweight' => '400',
			'extraweights'  => array( 'regular', '700' ),
			'category'      => 'sans-serif',
		);
		$this->assertSame( array( '400', '700' ), \sydney_typography_loaded_weights( $font ) );
	}

	public function test_non_numeric_garbage_in_extras_is_filtered_out() {
		$font = array(
			'font'          => 'Roboto',
			'regularweight' => '400',
			'extraweights'  => array( 'banana', '600', '', '400italic' ),
			'category'      => 'sans-serif',
		);
		$this->assertSame( array( '400', '600' ), \sydney_typography_loaded_weights( $font ) );
	}

	public function test_missing_primary_falls_back_to_400() {
		$font = array(
			'font'         => 'Roboto',
			'extraweights' => array( '700' ),
			'category'     => 'sans-serif',
		);
		$this->assertSame( array( '400', '700' ), \sydney_typography_loaded_weights( $font ) );
	}

	public function test_missing_extras_returns_just_primary() {
		$font = array( 'font' => 'Roboto', 'regularweight' => '600', 'category' => 'sans-serif' );
		$this->assertSame( array( '600' ), \sydney_typography_loaded_weights( $font ) );
	}

	public function test_extras_as_non_array_is_ignored() {
		// Sanitizer should prevent this, but be defensive.
		$font = array(
			'font'          => 'Roboto',
			'regularweight' => '400',
			'extraweights'  => 'oops_a_string',
			'category'      => 'sans-serif',
		);
		$this->assertSame( array( '400' ), \sydney_typography_loaded_weights( $font ) );
	}
}
```

- [ ] **Step 2: Run test to verify it fails**

Run: `./vendor/bin/phpunit tests/unit/TypographyLoadedWeightsTest.php`
Expected: FAIL with `Error: Call to undefined function sydney_typography_loaded_weights()`.

- [ ] **Step 3: Implement the helper**

Edit `inc/extras.php`. Find the `/**\n * Google Fonts URL\n */` block at line 650 and insert immediately ABOVE it:

```php
/**
 * Normalise a typography theme_mod into the sorted, deduplicated `string[]` of
 * numeric Google Fonts weights to LOAD.
 *
 * Combines `regularweight` (the primary, applied via PHP CSS) with the optional
 * `extraweights` array (additional weights loaded but not applied). The keyword
 * `regular` is normalised to `400`. Non-numeric entries (e.g. `400italic`) are
 * dropped — italic variants are out of scope here, see the GitHub issue.
 *
 * @param array $font Decoded typography theme_mod.
 * @return string[]   Sorted, deduped numeric weight strings (always at least one).
 */
function sydney_typography_loaded_weights( $font ) {
	$weights = array();

	$primary = isset( $font['regularweight'] ) ? $font['regularweight'] : '400';
	if ( 'regular' === $primary ) {
		$primary = '400';
	}
	$primary = (string) $primary;
	if ( '' !== $primary && ctype_digit( $primary ) ) {
		$weights[] = $primary;
	}

	$extras = isset( $font['extraweights'] ) ? $font['extraweights'] : array();
	if ( is_array( $extras ) ) {
		foreach ( $extras as $extra ) {
			if ( 'regular' === $extra ) {
				$extra = '400';
			}
			$extra = (string) $extra;
			if ( '' === $extra || ! ctype_digit( $extra ) ) {
				continue;
			}
			$weights[] = $extra;
		}
	}

	$weights = array_values( array_unique( $weights ) );

	if ( empty( $weights ) ) {
		return array( '400' );
	}

	sort( $weights, SORT_NUMERIC );
	return $weights;
}
```

- [ ] **Step 4: Run test to verify it passes**

Run: `./vendor/bin/phpunit tests/unit/TypographyLoadedWeightsTest.php`
Expected: PASS (9 tests).

- [ ] **Step 5: Commit**

```bash
git add tests/unit/TypographyLoadedWeightsTest.php inc/extras.php
git commit -m "feat(#392): add sydney_typography_loaded_weights() helper"
```

---

## Task 2: Sanitizer accepts and validates `extraweights` array

Today `sydney_google_fonts_sanitize()` runs `sanitize_text_field()` on every value in the decoded JSON. An array value (the new `extraweights`) would be coerced to the string `"Array"`, destroying it. Teach the sanitizer to handle the array case: coerce each entry to a string via `sanitize_text_field()`, dedupe, drop empties.

**Files:**
- Create: `tests/unit/GoogleFontsSanitizeTest.php`
- Modify: `inc/customizer/sanitize.php:165-177`

- [ ] **Step 1: Write the failing tests**

Create `tests/unit/GoogleFontsSanitizeTest.php`:

```php
<?php
/**
 * Unit tests for sydney_google_fonts_sanitize().
 *
 * @package Sydney
 * @subpackage Tests
 */

namespace Sydney\Tests;

use WP_Mock as M;

class GoogleFontsSanitizeTest extends BaseThemeTest {

	public function setUp(): void {
		parent::setUp();
		M::userFunction( 'sanitize_text_field', array( 'return_arg' => 0 ) );
		M::userFunction( 'wp_json_encode', array(
			'return' => function ( $data ) { return json_encode( $data ); },
		) );

		if ( ! function_exists( 'sydney_google_fonts_sanitize' ) ) {
			require_once dirname( __DIR__, 2 ) . '/inc/customizer/sanitize.php';
		}
	}

	public function test_legacy_scalar_regularweight_is_preserved() {
		$input  = '{"font":"Roboto","regularweight":"400","category":"sans-serif"}';
		$output = \sydney_google_fonts_sanitize( $input );
		$this->assertSame(
			array( 'font' => 'Roboto', 'regularweight' => '400', 'category' => 'sans-serif' ),
			json_decode( $output, true )
		);
	}

	public function test_extraweights_array_is_preserved_as_array() {
		$input  = '{"font":"Roboto","regularweight":"400","extraweights":["500","700"],"category":"sans-serif"}';
		$output = \sydney_google_fonts_sanitize( $input );
		$decoded = json_decode( $output, true );
		$this->assertSame( array( '500', '700' ), $decoded['extraweights'] );
	}

	public function test_extraweights_entries_are_coerced_to_strings() {
		$input  = '{"font":"Roboto","regularweight":"400","extraweights":[500,700],"category":"sans-serif"}';
		$output = \sydney_google_fonts_sanitize( $input );
		$decoded = json_decode( $output, true );
		$this->assertSame( array( '500', '700' ), $decoded['extraweights'] );
	}

	public function test_extraweights_empty_strings_are_dropped() {
		$input  = '{"font":"Roboto","regularweight":"400","extraweights":["","500"],"category":"sans-serif"}';
		$output = \sydney_google_fonts_sanitize( $input );
		$decoded = json_decode( $output, true );
		$this->assertSame( array( '500' ), $decoded['extraweights'] );
	}

	public function test_extraweights_duplicates_are_removed() {
		$input  = '{"font":"Roboto","regularweight":"400","extraweights":["500","500","700"],"category":"sans-serif"}';
		$output = \sydney_google_fonts_sanitize( $input );
		$decoded = json_decode( $output, true );
		$this->assertSame( array( '500', '700' ), $decoded['extraweights'] );
	}

	public function test_other_scalar_fields_still_pass_through_sanitize_text_field() {
		$input  = '{"font":"Open Sans","regularweight":"400","category":"sans-serif"}';
		$output = \sydney_google_fonts_sanitize( $input );
		$decoded = json_decode( $output, true );
		$this->assertSame( 'Open Sans',  $decoded['font'] );
		$this->assertSame( 'sans-serif', $decoded['category'] );
	}
}
```

- [ ] **Step 2: Run test to verify it fails**

Run: `./vendor/bin/phpunit tests/unit/GoogleFontsSanitizeTest.php`
Expected: FAIL — `test_extraweights_array_is_preserved_as_array` and the related tests fail because today's sanitizer turns the array into `"Array"`.

- [ ] **Step 3: Update the sanitizer**

Edit `inc/customizer/sanitize.php`. Replace the body of `sydney_google_fonts_sanitize()` (lines 165-177):

```php
/**
 * Sanitize fonts
 */
function sydney_google_fonts_sanitize( $input ) {
    $val =  json_decode( $input, true );
    if( is_array( $val ) ) {
        foreach ( $val as $key => $value ) {
            $val[$key] = sanitize_text_field( $value );
        }
        $input = wp_json_encode( $val );
    }
    else {
        $input = wp_json_encode( sanitize_text_field( $val ) );
    }
    return $input;
}
```

…with:

```php
/**
 * Sanitize a typography theme_mod (font, regularweight, optional extraweights, category).
 *
 * Scalar fields are passed through sanitize_text_field(). The optional
 * `extraweights` field is treated as an array of weight strings: each entry is
 * coerced to a string, sanitised, dropped if empty, and the final array is
 * deduplicated. Numerically reindexed so `wp_json_encode()` always emits a JSON
 * array (not an object).
 */
function sydney_google_fonts_sanitize( $input ) {
    $val = json_decode( $input, true );
    if ( is_array( $val ) ) {
        foreach ( $val as $key => $value ) {
            if ( is_array( $value ) ) {
                $sanitised = array();
                foreach ( $value as $item ) {
                    $item = sanitize_text_field( (string) $item );
                    if ( '' === $item ) {
                        continue;
                    }
                    $sanitised[] = $item;
                }
                $val[ $key ] = array_values( array_unique( $sanitised ) );
            } else {
                $val[ $key ] = sanitize_text_field( $value );
            }
        }
        $input = wp_json_encode( $val );
    } else {
        $input = wp_json_encode( sanitize_text_field( $val ) );
    }
    return $input;
}
```

- [ ] **Step 4: Run test to verify it passes**

Run: `./vendor/bin/phpunit tests/unit/GoogleFontsSanitizeTest.php`
Expected: PASS (6 tests).

- [ ] **Step 5: Commit**

```bash
git add tests/unit/GoogleFontsSanitizeTest.php inc/customizer/sanitize.php
git commit -m "feat(#392): sanitizer accepts extraweights array"
```

---

## Task 3: Refactor `sydney_google_fonts_url()` to emit multi-weight URLs

Today the function builds `Roboto:wght@400` per slot. After this task, it builds `Roboto:wght@400;600;700` per slot when extras are present, and stays byte-identical to today's output when no extras are configured. Also delete the obsolete `headings_font_weights` legacy override (extras.php:699-703) — the new helper handles all the normalisation.

**Files:**
- Create: `tests/unit/GoogleFontsUrlTest.php`
- Modify: `inc/extras.php:653-726`

- [ ] **Step 1: Write the failing tests**

Create `tests/unit/GoogleFontsUrlTest.php`:

```php
<?php
/**
 * Golden tests for sydney_google_fonts_url().
 *
 * @package Sydney
 * @subpackage Tests
 */

namespace Sydney\Tests;

use WP_Mock as M;

class GoogleFontsUrlTest extends BaseThemeTest {

	public function setUp(): void {
		parent::setUp();
		M::userFunction( 'wp_json_encode', array(
			'return' => function ( $data ) { return json_encode( $data ); },
		) );
		// Naive add_query_arg mock — concatenates args without URL-encoding so
		// the tests assert on the readable URL shape, not on WP's encoding quirks.
		M::userFunction( 'add_query_arg', array(
			'return' => function ( $args, $url ) {
				$parts = array();
				foreach ( $args as $k => $v ) {
					$parts[] = $k . '=' . $v;
				}
				return $url . '?' . implode( '&', $parts );
			},
		) );
		M::userFunction( 'esc_url_raw', array( 'return_arg' => 0 ) );

		if ( ! function_exists( 'sydney_google_fonts_url' ) ) {
			require_once dirname( __DIR__, 2 ) . '/inc/extras.php';
		}
	}

	private function mockSlots( $body, $headings, $menu, $local = 0 ) {
		M::userFunction( 'get_theme_mod', array(
			'return' => function ( $name, $default = null ) use ( $body, $headings, $menu, $local ) {
				switch ( $name ) {
					case 'sydney_body_font':         return $body;
					case 'sydney_headings_font':     return $headings;
					case 'sydney_menu_font':         return $menu;
					case 'perf_google_fonts_local':  return $local;
				}
				return $default;
			},
		) );
	}

	public function test_all_system_default_returns_null() {
		$default = '{"font":"System default","regularweight":"400","category":"sans-serif"}';
		$this->mockSlots( $default, $default, $default );
		$this->assertNull( \sydney_google_fonts_url() );
	}

	public function test_legacy_no_extras_produces_today_shape() {
		// Body Roboto:400 only — exactly today's single-weight URL.
		$this->mockSlots(
			'{"font":"Roboto","regularweight":"400","category":"sans-serif"}',
			'{"font":"System default","regularweight":"400","category":"sans-serif"}',
			'{"font":"System default","regularweight":"400","category":"sans-serif"}'
		);
		$this->assertSame(
			'https://fonts.googleapis.com/css2?family=Roboto:wght@400&display=swap',
			\sydney_google_fonts_url()
		);
	}

	public function test_empty_extras_array_still_produces_today_shape() {
		$this->mockSlots(
			'{"font":"Roboto","regularweight":"400","extraweights":[],"category":"sans-serif"}',
			'{"font":"System default","regularweight":"400","category":"sans-serif"}',
			'{"font":"System default","regularweight":"400","category":"sans-serif"}'
		);
		$this->assertSame(
			'https://fonts.googleapis.com/css2?family=Roboto:wght@400&display=swap',
			\sydney_google_fonts_url()
		);
	}

	public function test_primary_plus_extras_emit_semicolon_separated_wght() {
		$this->mockSlots(
			'{"font":"Roboto","regularweight":"400","extraweights":["600","700"],"category":"sans-serif"}',
			'{"font":"System default","regularweight":"400","category":"sans-serif"}',
			'{"font":"System default","regularweight":"400","category":"sans-serif"}'
		);
		$this->assertSame(
			'https://fonts.googleapis.com/css2?family=Roboto:wght@400;600;700&display=swap',
			\sydney_google_fonts_url()
		);
	}

	public function test_primary_300_with_extras_above_keeps_300_at_front() {
		// Regression guard: helper sorts numerically, so primary 300 stays first.
		$this->mockSlots(
			'{"font":"Roboto","regularweight":"300","extraweights":["400","500"],"category":"sans-serif"}',
			'{"font":"System default","regularweight":"400","category":"sans-serif"}',
			'{"font":"System default","regularweight":"400","category":"sans-serif"}'
		);
		$this->assertSame(
			'https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap',
			\sydney_google_fonts_url()
		);
	}

	public function test_multi_slot_with_mixed_extras() {
		$this->mockSlots(
			'{"font":"Roboto","regularweight":"regular","category":"sans-serif"}',
			'{"font":"Inter","regularweight":"600","extraweights":["400","900"],"category":"sans-serif"}',
			'{"font":"System default","regularweight":"400","category":"sans-serif"}'
		);
		// Order: body, menu, headings (matches the foreach in sydney_google_fonts_url()).
		$this->assertSame(
			'https://fonts.googleapis.com/css2?family=Roboto:wght@400&family=Inter:wght@400;600;900&display=swap',
			\sydney_google_fonts_url()
		);
	}

	public function test_local_fonts_toggle_routes_through_wptt_loader() {
		M::userFunction( 'get_parent_theme_file_path', array( 'return_arg' => 0 ) );
		M::userFunction( 'get_theme_file_path',        array( 'return_arg' => 0 ) );
		M::userFunction( 'wptt_get_webfont_url',       array( 'return' => 'LOCAL_URL_SENTINEL' ) );

		$this->mockSlots(
			'{"font":"Roboto","regularweight":"400","extraweights":["600","700"],"category":"sans-serif"}',
			'{"font":"System default","regularweight":"400","category":"sans-serif"}',
			'{"font":"System default","regularweight":"400","category":"sans-serif"}',
			1
		);
		$this->assertSame( 'LOCAL_URL_SENTINEL', \sydney_google_fonts_url() );
	}
}
```

- [ ] **Step 2: Run test to verify it fails**

Run: `./vendor/bin/phpunit tests/unit/GoogleFontsUrlTest.php`
Expected: FAIL — `test_primary_plus_extras_emit_semicolon_separated_wght`, `test_primary_300_with_extras_above_keeps_300_at_front`, and `test_multi_slot_with_mixed_extras` fail because today's function ignores `extraweights`.

- [ ] **Step 3: Rewrite `sydney_google_fonts_url()`**

Edit `inc/extras.php`. Replace the entire function (lines 653-726):

```php
function sydney_google_fonts_url() {
	$fonts_url  = '';
	$subsets    = 'latin';

	$defaults = wp_json_encode(
		array(
			'font'          => 'System default',
			'regularweight' => '400',
			'category'      => 'sans-serif',
		)
	);

	//Get and decode options
	$body_font      = get_theme_mod( 'sydney_body_font', $defaults );
	$headings_font  = get_theme_mod( 'sydney_headings_font', $defaults );
	$menu_font      = get_theme_mod( 'sydney_menu_font', $defaults );

	$body_font      = json_decode( $body_font, true );
	$headings_font  = json_decode( $headings_font, true );
	$menu_font      = json_decode( $menu_font, true );

	if ( 'System default' === $body_font['font'] && 'System default' === $headings_font['font'] && 'System default' === $menu_font['font'] ) {
		return; //return early if defaults are active
	}

	$font_families = array();

	if ( 'System default' !== $body_font['font'] ) {
		if ( 'regular' === $body_font['regularweight'] ) {
			$body_font['regularweight'] = '400';
		}

		$font_families[] = $body_font['font'] . ':wght@' . $body_font['regularweight'];
	}

	if ( 'System default' !== $menu_font['font'] ) {

		if ( 'regular' === $menu_font['regularweight'] ) {
			$menu_font['regularweight'] = '400';
		}
				
		$font_families[] = $menu_font['font'] . ':wght@' . $menu_font['regularweight'];
	}   

	if ( 'System default' !== $headings_font['font'] ) {

		$old_weights = get_theme_mod( 'headings_font_weights' );
		
		if ( is_array( $old_weights ) && in_array( '400', $old_weights, true ) ) {
			$headings_font['regularweight'] = '400';
		}

		if ( 'regular' === $headings_font['regularweight'] ) {
			$headings_font['regularweight'] = '400';
		}       

		$font_families[] = $headings_font['font'] . ':wght@' . $headings_font['regularweight'];
	}
	
	$fonts_url = add_query_arg( array(
		'family' => implode( '&family=', $font_families ),
		'display' => 'swap',
	), 'https://fonts.googleapis.com/css2' );

	// Load google fonts locally
	$load_locally = get_theme_mod( 'perf_google_fonts_local', 0 );
	if( $load_locally ) {
		require_once get_theme_file_path( 'inc/vendor/wptt-webfont-loader/wptt-webfont-loader.php' ); // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

		return wptt_get_webfont_url( $fonts_url );
	}

	return esc_url_raw( $fonts_url );
}
```

…with:

```php
function sydney_google_fonts_url() {
	$defaults = wp_json_encode(
		array(
			'font'          => 'System default',
			'regularweight' => '400',
			'category'      => 'sans-serif',
		)
	);

	$body_font     = json_decode( get_theme_mod( 'sydney_body_font',     $defaults ), true );
	$headings_font = json_decode( get_theme_mod( 'sydney_headings_font', $defaults ), true );
	$menu_font     = json_decode( get_theme_mod( 'sydney_menu_font',     $defaults ), true );

	if (
		'System default' === $body_font['font']
		&& 'System default' === $headings_font['font']
		&& 'System default' === $menu_font['font']
	) {
		return; // All slots default; emit no URL.
	}

	$font_families = array();
	foreach ( array( $body_font, $menu_font, $headings_font ) as $slot ) {
		if ( 'System default' === $slot['font'] ) {
			continue;
		}
		$weights         = sydney_typography_loaded_weights( $slot );
		$font_families[] = $slot['font'] . ':wght@' . implode( ';', $weights );
	}

	$fonts_url = add_query_arg(
		array(
			'family'  => implode( '&family=', $font_families ),
			'display' => 'swap',
		),
		'https://fonts.googleapis.com/css2'
	);

	// Local fonts (WPTT WebFont Loader) — pass the full upstream URL through unchanged.
	if ( get_theme_mod( 'perf_google_fonts_local', 0 ) ) {
		require_once get_theme_file_path( 'inc/vendor/wptt-webfont-loader/wptt-webfont-loader.php' ); // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
		return wptt_get_webfont_url( $fonts_url );
	}

	return esc_url_raw( $fonts_url );
}
```

- [ ] **Step 4: Run all three test files to confirm pass**

Run: `./vendor/bin/phpunit tests/unit/TypographyLoadedWeightsTest.php tests/unit/GoogleFontsSanitizeTest.php tests/unit/GoogleFontsUrlTest.php`
Expected: PASS (22 tests total).

- [ ] **Step 5: Commit**

```bash
git add tests/unit/GoogleFontsUrlTest.php inc/extras.php
git commit -m "feat(#392): emit multi-weight Google Fonts URLs"
```

---

## Task 4: Render the new "Additional weights" multi-select beneath the existing weight dropdown

Add a second `<select multiple>` directly after the existing single-select. Mark every weight present in `$this->fontValues->extraweights` as `selected`. The existing single-select for `regularweight` stays exactly as today — no changes to its markup, label, or behaviour.

**Files:**
- Modify: `inc/customizer/controls/typography/class_sydney_typography.php:109-120`

- [ ] **Step 1: Confirm the current render block**

The existing snippet to be EXTENDED (not replaced) is:

```php
<div class="range-slider-wrapper cols2-control">
<div class="font-control-title w50"><strong><?php esc_html_e( 'Font weight', 'sydney' ) ?></strong></div>
<?php if ( $this->input_attrs['disableRegular'] === false ) : ?>
	<select class="google-fonts-regularweight-style w50">
		<?php
			foreach( $this->fontList[$this->fontListIndex]->variants as $key => $value ) {
				echo '<option value="' . esc_attr( $value ) . '" ' . selected( $this->fontValues->regularweight, $value, false ) . '>' . esc_html( $value ) . '</option>';
			}
		?>
	</select>
<?php endif; ?>
</div>
```

- [ ] **Step 2: Append the extras multi-select control**

After the closing `</div>` of the existing block, insert a NEW wrapper:

```php
<?php if ( $this->input_attrs['disableRegular'] === false ) : ?>
	<?php
		$current_extras = isset( $this->fontValues->extraweights ) ? $this->fontValues->extraweights : array();
		if ( ! is_array( $current_extras ) ) {
			$current_extras = array();
		}
		$current_extras = array_map(
			static function ( $w ) { return 'regular' === $w ? '400' : (string) $w; },
			$current_extras
		);
	?>
	<div class="google-fonts-extras-wrapper">
		<div class="font-control-title"><strong><?php esc_html_e( 'Additional weights to load', 'sydney' ); ?></strong></div>
		<div class="font-control-description"><?php esc_html_e( 'Extra weights to load so individual blocks can use them. The primary weight above stays the default applied to body, headings, and menu.', 'sydney' ); ?></div>
		<select class="google-fonts-extraweights-style" multiple="multiple">
			<?php
				foreach ( $this->fontList[ $this->fontListIndex ]->variants as $key => $value ) {
					$variant_normalised = 'regular' === $value ? '400' : $value;
					// Skip the primary in the extras dropdown — it's already loaded.
					if ( $variant_normalised === ( 'regular' === $this->fontValues->regularweight ? '400' : $this->fontValues->regularweight ) ) {
						continue;
					}
					// Skip italic variants — out of scope (helper drops them anyway).
					if ( false !== strpos( $value, 'italic' ) ) {
						continue;
					}
					$is_selected = in_array( $variant_normalised, $current_extras, true ) ? ' selected="selected"' : '';
					echo '<option value="' . esc_attr( $value ) . '"' . $is_selected . '>' . esc_html( $value ) . '</option>';
				}
			?>
		</select>
	</div>
<?php endif; ?>
```

Result is the full block now reads (existing block + new wrapper):

```php
<div class="range-slider-wrapper cols2-control">
<div class="font-control-title w50"><strong><?php esc_html_e( 'Font weight', 'sydney' ) ?></strong></div>
<?php if ( $this->input_attrs['disableRegular'] === false ) : ?>
	<select class="google-fonts-regularweight-style w50">
		<?php
			foreach( $this->fontList[$this->fontListIndex]->variants as $key => $value ) {
				echo '<option value="' . esc_attr( $value ) . '" ' . selected( $this->fontValues->regularweight, $value, false ) . '>' . esc_html( $value ) . '</option>';
			}
		?>
	</select>
<?php endif; ?>
</div>

<?php if ( $this->input_attrs['disableRegular'] === false ) : ?>
	<?php /* …extras wrapper as above… */ ?>
<?php endif; ?>
```

- [ ] **Step 3: PHPCS check**

Run: `composer phpcs -- inc/customizer/controls/typography/class_sydney_typography.php`
Expected: 0 errors. Fix any reported style issues.

- [ ] **Step 4: Commit**

```bash
git add inc/customizer/controls/typography/class_sydney_typography.php
git commit -m "feat(#392): add 'Additional weights' multi-select to typography control"
```

---

## Task 5: Wire the typography control JS for Select2 multi-select + bug fixes

Three behavioural changes plus two collateral fixes:

1. Initialise the new extras `<select multiple>` with Select2 (`{ multiple: true }`).
2. On weight (primary) change, ensure the primary is removed from the extras dropdown's available options if it appears there.
3. On family change, rebuild BOTH the primary dropdown AND the extras dropdown's options; preserve any previously-picked extras that the new family still exposes (drop the rest).
4. **Fix** the `botigafontslist` → `sydneyfontslist` typo (the property is set as `sydneyfontslist` in `to_json()`; the change handler has been silently broken).
5. **Strip** the dead italic/bold dropdown branches — `class_sydney_typography.php` never renders `.google-fonts-italicweight-style` or `.google-fonts-boldweight-style`, so the JS code paths operate on empty jQuery sets and are confirmed dead.

The hidden JSON input that holds the saved theme_mod value gains a new key `extraweights: array`.

**Files:**
- Modify: `inc/customizer/controls/typography/script.js` (full rewrite)

- [ ] **Step 1: Replace the file contents**

Overwrite `inc/customizer/controls/typography/script.js` with:

```javascript
/* Typography */
jQuery( document ).ready( function( $ ) {
	"use strict";

	// Initialise Select2 on the font-family dropdown (single-select).
	$( '.google-fonts-list' ).each( function() {
		if ( ! $( this ).hasClass( 'select2-hidden-accessible' ) ) {
			$( this ).select2();
		}
	} );

	// Initialise Select2 on the additional-weights dropdown (multi-select).
	$( '.google-fonts-extraweights-style' ).each( function() {
		if ( ! $( this ).hasClass( 'select2-hidden-accessible' ) ) {
			$( this ).select2( { multiple: true, placeholder: '' } );
		}
	} );

	$( '.google-fonts-list' ).on( 'change', function() {
		var $container         = $( this ).parent().parent();
		var $primary           = $container.find( '.google-fonts-regularweight-style' );
		var $extras            = $container.find( '.google-fonts-extraweights-style' );
		var selectedFont       = $( this ).val();
		var customizerControlName = $( this ).attr( 'control-name' );
		var control            = _wpCustomizeSettings.controls[ customizerControlName ];

		// Property exposed by to_json() is `sydneyfontslist`. Keep the old
		// `botigafontslist` name as a fallback in case any third-party code
		// wrote to it.
		var fontList = control.sydneyfontslist || control.botigafontslist || [];
		var index    = -1;
		$.each( fontList, function( i, item ) {
			if ( item.family === selectedFont ) { index = i; return false; }
		} );
		if ( index === -1 ) { return; }

		var variants = fontList[ index ].variants || [];

		// Remember what the user previously picked.
		var previousPrimary = $primary.val();
		var previousExtras  = $extras.val() || [];
		previousExtras      = previousExtras.map( function( v ) { return v === 'regular' ? '400' : v; } );

		// --- Rebuild the primary <select> ---
		$primary.empty();
		$.each( variants, function( _, variant ) {
			$primary.append( $( '<option></option>' ).val( variant ).html( variant ) );
		} );

		// Default-pick logic for the primary, unchanged from the legacy script.
		if ( $primary.find( 'option[value="' + previousPrimary + '"]' ).length ) {
			$primary.val( previousPrimary );
		} else if ( $primary.find( 'option[value="regular"]' ).length ) {
			$primary.val( 'regular' );
		} else if ( $primary.find( 'option[value="400"]' ).length ) {
			$primary.val( '400' );
		} else if ( $primary.find( 'option[value="300"]' ).length ) {
			$primary.val( '300' );
		}

		// --- Rebuild the extras <select multiple> ---
		// The primary weight is hidden from the extras options (already loaded).
		var currentPrimary = $primary.val();
		var primaryNormalised = currentPrimary === 'regular' ? '400' : currentPrimary;

		$extras.empty();
		$.each( variants, function( _, variant ) {
			if ( variant.indexOf( 'italic' ) !== -1 ) { return; }
			var variantNormalised = variant === 'regular' ? '400' : variant;
			if ( variantNormalised === primaryNormalised ) { return; }
			$extras.append( $( '<option></option>' ).val( variant ).html( variant ) );
		} );

		// Re-select any previously-picked extras that still exist in this family.
		var preserved = previousExtras.filter( function( w ) {
			return $extras.find( 'option[value="' + w + '"]' ).length > 0;
		} );
		$extras.val( preserved ).trigger( 'change.select2' );

		// Update the font category hidden field.
		$container.find( '.google-fonts-category' ).val( fontList[ index ].category );

		sydneyTypographySyncHidden( $container.parent().parent() );
	} );

	// When the primary changes, ensure it disappears from the extras options.
	$( '.google-fonts-regularweight-style' ).on( 'change', function() {
		var $container = $( this ).parent().parent();
		var $extras    = $container.find( '.google-fonts-extraweights-style' );
		if ( ! $extras.length ) {
			return;
		}

		var currentPrimary  = $( this ).val();
		var primaryNorm     = currentPrimary === 'regular' ? '400' : currentPrimary;
		var previousExtras  = ( $extras.val() || [] ).filter( function( v ) {
			var vNorm = v === 'regular' ? '400' : v;
			return vNorm !== primaryNorm;
		} );

		// Rebuild the extras option list to hide the new primary.
		var allVariants = [];
		$extras.find( 'option' ).each( function() { allVariants.push( $( this ).val() ); } );
		// Re-include the option corresponding to the OLD primary if it was hidden.
		// Simpler: walk the full font variants list again.
		var customizerControlName = $container.find( '.google-fonts-list' ).attr( 'control-name' );
		var control = _wpCustomizeSettings.controls[ customizerControlName ];
		var fontList = control.sydneyfontslist || control.botigafontslist || [];
		var selectedFont = $container.find( '.google-fonts-list' ).val();
		var idx = -1;
		$.each( fontList, function( i, item ) {
			if ( item.family === selectedFont ) { idx = i; return false; }
		} );
		var variants = idx === -1 ? [] : ( fontList[ idx ].variants || [] );

		$extras.empty();
		$.each( variants, function( _, variant ) {
			if ( variant.indexOf( 'italic' ) !== -1 ) { return; }
			var variantNorm = variant === 'regular' ? '400' : variant;
			if ( variantNorm === primaryNorm ) { return; }
			$extras.append( $( '<option></option>' ).val( variant ).html( variant ) );
		} );
		$extras.val( previousExtras ).trigger( 'change.select2' );

		sydneyTypographySyncHidden( $container.parent().parent() );
	} );

	// Any other change inside the control container syncs the hidden JSON input.
	$( '.google_fonts_select_control select' ).on( 'change', function() {
		sydneyTypographySyncHidden( $( this ).parent().parent().parent().parent() );
	} );

	function sydneyTypographySyncHidden( $container ) {
		var extras = $container.find( '.google-fonts-extraweights-style' ).val() || [];
		if ( ! Array.isArray( extras ) ) { extras = extras ? [ extras ] : []; }

		var payload = {
			font:          $container.find( '.google-fonts-list' ).val(),
			regularweight: $container.find( '.google-fonts-regularweight-style' ).val(),
			extraweights:  extras,
			category:      $container.find( '.google-fonts-category' ).val()
		};

		$container.find( '.customize-control-google-font-selection' )
			.val( JSON.stringify( payload ) )
			.trigger( 'change' );
	}
} );
```

Reviewer notes:
- The italic/bold dropdown logic from the old script is gone. If anyone reintroduces those controls in PHP, the JS for them needs to be re-added — confirmed dead today.
- The primary-change handler hides the new primary from the extras options AND re-includes any previously-hidden weight, so swapping the primary cleanly "moves" weights between the two dropdowns.
- `sydneyTypographySyncHidden()` always writes `extraweights` to the saved JSON, even when empty — that's what the sanitizer expects.

- [ ] **Step 2: Hand-verify no JS syntax errors**

Run: `node --check inc/customizer/controls/typography/script.js`
Expected: no output (success).

- [ ] **Step 3: Commit**

```bash
git add inc/customizer/controls/typography/script.js
git commit -m "feat(#392): wire 'Additional weights' Select2 multi-select"
```

---

## Task 6: CSS for the new extras multi-select

Select2 multi-selects render taller than single-selects and fight `w50` 50%-width columns. The new extras control sits on its own row beneath the existing primary control, so it can use the full width.

**Files:**
- Modify: `inc/customizer/controls/typography/styles.css`

- [ ] **Step 1: Replace the file contents**

Overwrite `inc/customizer/controls/typography/styles.css` with:

```css
.select2-container {
    z-index: 999999 !important;
    width: 100%;
    max-width: 100%;
}
.select2-drop-mask,
.select2-drop-active {
    z-index: 500000 !important;
}

.google_fonts_select_control .google-fonts,
.google_fonts_select_control .weight-style {
    margin-bottom: 10px;
}

/* Additional-weights multi-select sits on its own row at 100% width. */
.google_fonts_select_control .google-fonts-extras-wrapper {
    margin-top: 12px;
    margin-bottom: 10px;
}
.google_fonts_select_control .google-fonts-extras-wrapper .font-control-title {
    margin-bottom: 4px;
}
.google_fonts_select_control .google-fonts-extras-wrapper .font-control-description {
    color: #757575;
    font-size: 11px;
    margin-bottom: 6px;
    line-height: 1.4;
}
.google_fonts_select_control .google-fonts-extras-wrapper select.google-fonts-extraweights-style {
    width: 100% !important;
    max-width: 100%;
}
.google_fonts_select_control .select2-selection--multiple {
    min-height: 32px;
}
```

- [ ] **Step 2: Commit**

```bash
git add inc/customizer/controls/typography/styles.css
git commit -m "style(#392): style additional-weights multi-select"
```

---

## Task 7: Full test + lint suite + manual verification

- [ ] **Step 1: Run the entire PHPUnit suite**

Run: `composer test`
Expected: all tests pass (existing + 22 new from Tasks 1-3).

- [ ] **Step 2: Run PHPCS**

Run: `composer phpcs`
Expected: 0 errors. If anything reports, run `composer phpcs:fix` for auto-fixable issues; hand-fix the rest.

- [ ] **Step 3: Commit any test/lint fixups (skip if nothing changed)**

```bash
git add -p
git commit -m "fix(#392): test/lint follow-ups"
```

- [ ] **Step 4: Confirm block-level weight overrides today's PHP-written `font-weight` (load-bearing assumption)**

This step VERIFIES the architecture decision documented at the top of this plan: that block-level inline weight picks beat the PHP-written `body { font-weight: … }` rule via specificity. If they don't, we'll need to revisit and strip the PHP rules.

1. Run `npm start` to boot the dev environment.
2. In the Customizer, set the body typography primary weight to `300`.
3. In the block editor, add a Paragraph block, open the Typography panel → Appearance → set the weight to `700`.
4. Save, view on the frontend, inspect the paragraph in DevTools.
5. **Expected:** the paragraph renders at weight 700. The rendered HTML carries `style="font-weight:700"` (inline style); the cascade shows it overriding `body { font-weight: 300 }`.

If that's not what happens, STOP — revisit the "Why we are NOT stripping `font-weight: …` from PHP" decision before proceeding.

- [ ] **Step 5: Verify byte-identical legacy URL (no extras configured)**

1. Customize → Typography → Headings → pick e.g. Inter, weight 600. Leave the new "Additional weights to load" empty.
2. Save. View the frontend `<head>`.
3. **Expected:** `<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@600&display=swap">` — identical to what master emits today for the same configuration.

- [ ] **Step 6: Verify multi-weight URL**

1. In the same control, add `300` and `900` to "Additional weights to load".
2. Save. Refresh frontend.
3. **Expected:** the `<link>` href is `…/css2?family=Inter:wght@300;600;900&display=swap`. (Order is numerically sorted by the helper.)
4. DevTools → Network → Fonts: confirm `.woff2` files for 300, 600, 900 all download.

- [ ] **Step 7: Family swap preserves picks**

1. With multi-weight Inter configured, swap the family to Roboto (which also has 300, 600, 900).
2. **Expected:** the primary updates to a Roboto-available equivalent (the previous primary if Roboto has it, else `regular`/`400` fallback). Extras 300 and 900 stay selected.
3. Swap to a single-weight font (e.g. "Lobster" — only `400`/`regular`).
4. **Expected:** extras dropdown empties (no available weights other than primary); primary lands on `regular`.

- [ ] **Step 8: Swap primary "moves" weights between dropdowns**

1. With Inter and primary 600, extras 300 + 900, change the primary to 300.
2. **Expected:** the extras dropdown now shows 300 disappear from options and 600 reappear; the saved JSON's `regularweight` becomes 300 and `extraweights` becomes `[600?, 900]` depending on whether 600 was preserved.

- [ ] **Step 9: Local fonts (WPTT loader)**

1. Customize → Performance → enable "Load Google Fonts locally". Save.
2. Frontend `<head>`: the `<link>` should point to `/wp-content/uploads/sydney-webfonts/…`.
3. Filesystem: `wp-content/uploads/sydney-webfonts/` contains `.woff2` files for each requested weight.

- [ ] **Step 10: Block editor — per-block weight picker works for extras**

1. Open a page in the block editor.
2. Add a Heading block.
3. Block sidebar → Typography → Appearance → set weight to one of the EXTRA weights you loaded (e.g. 900 when headings primary is 600).
4. **Expected:** the heading renders at 900 in the editor and on the published page (no fake-bolding — DevTools shows the actual loaded weight is in use).
5. Try a weight that is NOT in the loaded set (e.g. 100 when set is 300/600/900). **Expected:** browser-faked light weight (same as today's behaviour for unloaded weights).

- [ ] **Step 11: Style book preview still works**

1. Customizer → open the Style Book panel.
2. **Expected:** headings and body render in the chosen font at the primary weight (because `inc/customizer/style-book/class-sydney-style-book.php` continues to write `font-weight: <regularweight>` — unchanged by this PR).

- [ ] **Step 12: Final PR-ready package check**

Run: `npm run zip`
Expected: clean build of `sydney.zip` (this also runs `composer test:unit`).

---

## Notes for the engineer

- **DO NOT** add a migration in `inc/theme-update.php`. Legacy sites with no `extraweights` key produce a byte-identical URL — the load-bearing backward-compatibility constraint.
- **DO NOT** strip `font-weight` from `inc/styles.php`, `inc/editor.php`, or the style-book. Per-block weight picks beat the PHP rule via inline-style specificity (Task 7 Step 4 verifies this).
- **DO NOT** touch `inc/fonts.php`. The `sydney_enqueue_google_fonts()` it defines is dead code (no callers); removing it is a separate cleanup PR.
- **DO NOT** touch `inc/vendor/wptt-webfont-loader/*`. The loader downloads whatever `.woff2` files the upstream URL references; multi-weight URLs Just Work.
- **The `botigafontslist` → `sydneyfontslist` JS rename** is a load-bearing typo fix (the property is set as `sydneyfontslist` in `class_sydney_typography.php::to_json()`, so the family-change handler has been silently broken). We keep `botigafontslist` as a JS fallback for safety.
- **Italic / bold dropdowns** (`.google-fonts-italicweight-style`, `.google-fonts-boldweight-style`) are referenced nowhere in the PHP renderer; the JS branches that manipulated them are removed entirely.
- **Italic-axis variants** (e.g. `400italic`) are intentionally NOT supported. The helper filters with `ctype_digit()` so italic entries are dropped from both URL building and the extras dropdown; the existing single-select still lets the user pick `400italic` as the primary if they want (today's behaviour, untouched). Supporting `ital,wght@…` axis form is out of scope.
