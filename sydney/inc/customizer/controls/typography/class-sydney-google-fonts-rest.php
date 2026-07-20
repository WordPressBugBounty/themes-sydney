<?php
/**
 * REST route serving the Google Fonts catalog on demand.
 *
 * The catalog is fetched once per customizer session by
 * js/customize-controls.js instead of being embedded in customize.php.
 *
 * @package Sydney
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sydney_Google_Fonts_REST {

	const NAMESPACE_BASE = 'sydney/v1';
	const ROUTE_BASE     = 'google-fonts';
	const TRANSIENT_KEY  = 'sydney_google_fonts_list';

	/**
	 * In-memory cache for the current request.
	 */
	private static $cached_fonts = null;

	public function __construct() {
		add_action( 'rest_api_init', array( $this, 'register_routes' ) );
	}

	public function register_routes() {
		register_rest_route(
			self::NAMESPACE_BASE,
			'/' . self::ROUTE_BASE,
			array(
				'methods'             => WP_REST_Server::READABLE,
				'callback'            => array( $this, 'get_fonts' ),
				'permission_callback' => array( $this, 'permissions_check' ),
			)
		);
	}

	public function permissions_check() {
		return current_user_can( 'customize' );
	}

	public function get_fonts() {
		$response = rest_ensure_response( self::get_catalog() );
		// Let repeat customizer sessions hit the browser cache — this replaces
		// the nocache Cache-Control WordPress sends for authenticated REST calls.
		$response->header( 'Cache-Control', 'private, max-age=' . DAY_IN_SECONDS );

		return $response;
	}

	/**
	 * The Google Fonts catalog: memory -> transient -> bundled JSON file.
	 *
	 * Shared source for this route and Sydney_Typography_Control.
	 *
	 * @return array List of font objects (family, variants, category).
	 */
	public static function get_catalog() {
		if ( null !== self::$cached_fonts ) {
			return self::$cached_fonts;
		}

		$cached_fonts = get_transient( self::TRANSIENT_KEY );
		if ( false !== $cached_fonts ) {
			self::$cached_fonts = $cached_fonts;
			return $cached_fonts;
		}

		require_once ABSPATH . 'wp-admin/includes/class-wp-filesystem-base.php';
		require_once ABSPATH . 'wp-admin/includes/class-wp-filesystem-direct.php';

		$font_file = get_parent_theme_file_path( '/inc/customizer/controls/typography/google-fonts-alphabetical.json' );

		$file_system = new WP_Filesystem_Direct( false );
		$content     = json_decode( $file_system->get_contents( $font_file ) );

		$fonts = $content->items;

		set_transient( self::TRANSIENT_KEY, $fonts, DAY_IN_SECONDS );

		self::$cached_fonts = $fonts;

		return $fonts;
	}
}
new Sydney_Google_Fonts_REST();
