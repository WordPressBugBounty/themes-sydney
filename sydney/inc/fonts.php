<?php
/**
 * Google fonts related functionality
 *
 * @package Sydney
 */

/**
 * Get font family options
 */
if ( ! function_exists( 'sydney_get_font_families_options' ) ) :
	function sydney_get_font_families_options() {
		$fonts['body']      = get_theme_mod( 'body_font', 'Raleway');
		$fonts['headings']  = get_theme_mod( 'headings_font', 'Raleway' );

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
		$headings_weights   = get_theme_mod( 'headings_font_weights', array( '600' ) );
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