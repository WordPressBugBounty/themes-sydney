<?php
/**
 * Google fonts related functionality
 *
 * @package Sydney
 */

/**
 * Default font families and heading weights, before any saved theme mod.
 *
 * The three values below are the whole of what used to separate this file's
 * two editions: free ships Raleway for both families and a single 600 heading
 * weight, Pro ships Poppins, Ubuntu and 500,600. Pro now returns its three
 * from sydney_pro_font_family_defaults() in inc/pro/functions.php instead of
 * carrying a second copy of the file.
 *
 * One filter carrying all three rather than three filters, so that #569 has one
 * place to read them from when it converges inc/theme-update.php: that file's
 * typography migration compares a saved body_font against the same default and
 * still hardcodes it at :172 and :188. Nothing outside this file reads these
 * values yet.
 *
 * @since 2.71
 *
 * @return array Keys: body, headings, headings_weights.
 */
if ( ! function_exists( 'sydney_get_font_family_defaults' ) ) :
	function sydney_get_font_family_defaults() {
		return apply_filters(
			'sydney_font_family_defaults',
			array(
				'body'             => 'Raleway',
				'headings'         => 'Raleway',
				'headings_weights' => array( '600' ),
			)
		);
	}
endif;

/**
 * Get font family options
 */
if ( ! function_exists( 'sydney_get_font_families_options' ) ) :
	function sydney_get_font_families_options() {
		$defaults = sydney_get_font_family_defaults();

		$fonts['body']      = get_theme_mod( 'body_font', $defaults['body'] );
		$fonts['headings']  = get_theme_mod( 'headings_font', $defaults['headings'] );

		return $fonts;
	}
endif;

/**
 * Build and return Google Fonts URL
 */
if ( !function_exists('sydney_enqueue_google_fonts') ) :
	function sydney_enqueue_google_fonts() {

		//Get user choices for font families
		$fonts              = sydney_get_font_families_options();

		if ( ! $fonts || ! is_array( $fonts ) ) {
			return '';
		}

		//Body fonts
		$body_weights       = get_theme_mod( 'body_font_weights', array( '400', '600' ) );
		$body_font          = $fonts['body'] . ':' . implode( ',', $body_weights );

		//Headings fonts
		$defaults           = sydney_get_font_family_defaults();
		$headings_weights   = get_theme_mod( 'headings_font_weights', $defaults['headings_weights'] );
		$headings_font      = $fonts['headings'] . ':' . implode( ',', $headings_weights );

		//Subsets
		$subsets            = implode( ',', get_theme_mod( 'font_subsets', array( 'latin' ) ) );

		//Build the font families array
		$fonts_array        = array();
		$fonts_array[]      = $body_font;
		if ( $fonts['body'] !== $fonts['headings'] ) { //Don't load the same font twice
			$fonts_array[]  = $headings_font;
		}
		
		//Build the fonts URL
		$fonts_url = add_query_arg( array(
			'family'    => urlencode( implode( '|', $fonts_array ) ), // phpcs:ignore WordPress.PHP.DiscouragedPHPFunctions.urlencode_urlencode
			'subset'    => urlencode( $subsets ), // phpcs:ignore WordPress.PHP.DiscouragedPHPFunctions.urlencode_urlencode
			'display'   => 'swap',
		), 'https://fonts.googleapis.com/css' );

		return $fonts_url;
	}
endif;


/**
 * Migrate old font family options
 */
function sydney_migrate_fonts() {

	$is_migrated    = get_theme_mod( 'fonts_migrated_flag' );

	//Return if we already migrated the fonts to the new theme_mods
	if ( $is_migrated ) {
		return;
	}

	//Get old font options
	$body_font      = get_theme_mod( 'body_font_family' );
	$headings_font  = get_theme_mod( 'headings_font_family' );

	//Process body font
	if ( $body_font ) {
		$old_body_font      = trim( str_replace( array( ',', 'sans-serif', 'serif', 'cursive', '\'' ), ' ', get_theme_mod( 'body_font_family' ) ) );
		set_theme_mod( 'body_font', $old_body_font );
		set_theme_mod( 'fonts_migrated_flag', true );
	}

	//Process headings font
	if ( $headings_font ) {
		$old_headings_font  = trim( str_replace( array( ',', 'sans-serif', 'serif', 'cursive', '\'' ), ' ', get_theme_mod( 'headings_font_family' ) ) );
		set_theme_mod( 'headings_font', $old_headings_font );
		set_theme_mod( 'fonts_migrated_flag', true );
	}
}
add_action( 'after_setup_theme', 'sydney_migrate_fonts' );