<?php
/**
 * Pattern Library module
 *
 * @package Sydney
 */

if ( ! class_exists( 'Sydney_Modules' ) || ! Sydney_Modules::is_module_active( 'pattern-library' ) ) {
	return;
}

if ( ! function_exists( 'sydney_remove_core_patterns' ) ) {
	/**
	 * Remove WordPress core block patterns so only Sydney's curated library shows.
	 *
	 * Must run before init@10, which is when core registers its patterns via
	 * _register_core_block_patterns_and_categories(). after_setup_theme is the
	 * canonical hook for theme-support adjustments.
	 *
	 * Module-gated: the early-return guard at the top of this file means this
	 * add_action only registers when the pattern-library module is active.
	 * Disabling the module restores core patterns automatically.
	 */
	function sydney_remove_core_patterns() {
		remove_theme_support( 'core-block-patterns' );
	}
}
add_action( 'after_setup_theme', 'sydney_remove_core_patterns' );

if ( ! class_exists( 'Sydney_Pattern_Library' ) ) {

	/**
	 * Sydney Pattern Library
	 */
	class Sydney_Pattern_Library {

		/**
		 * Transient key for the cached pattern file list.
		 */
		const PATTERN_FILES_CACHE_KEY = 'sydney_pattern_files';

		/**
		 * Instance
		 *
		 * @var Sydney_Pattern_Library
		 */
		private static $instance;

		/**
		 * Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() {
			if ( is_admin() && ! wp_doing_ajax() && ! wp_doing_cron() ) {
				add_action( 'init', array( $this, 'register_patterns' ) );
			}
			add_action( 'rest_api_init', array( $this, 'register_patterns' ) );
			add_action( 'enqueue_block_editor_assets', array( $this, 'enqueue_assets' ) );
		}

		/**
		 * Pattern category slugs in display order.
		 *
		 * Single source of truth — consumed by register_patterns() for category
		 * registration and by enqueue_assets() for the JS sort order.
		 *
		 * @return array<string, string> slug => translated label
		 */
		public function get_categories() {
			$categories = array(
				'sydney-hero'         => __( 'Hero', 'sydney' ),
				'sydney-about'        => __( 'About', 'sydney' ),
				'sydney-services'     => __( 'Services', 'sydney' ),
				'sydney-features'     => __( 'Features', 'sydney' ),
				'sydney-cta'          => __( 'CTA', 'sydney' ),
				'sydney-testimonials' => __( 'Testimonials', 'sydney' ),
				'sydney-team'         => __( 'Team', 'sydney' ),
				'sydney-pricing'      => __( 'Pricing', 'sydney' ),
				'sydney-gallery'      => __( 'Gallery', 'sydney' ),
				'sydney-blog'         => __( 'Blog', 'sydney' ),
				'sydney-stats'        => __( 'Stats', 'sydney' ),
				'sydney-contact'      => __( 'Contact', 'sydney' ),
			);

			if ( class_exists( 'WooCommerce' ) ) {
				$categories['sydney-shop'] = __( 'Shop', 'sydney' );
			}

			return $categories;
		}

		/**
		 * Register block patterns
		 */
		public function register_patterns() {
			require_once get_template_directory() . '/inc/modules/pattern-library/library-helpers.php';

			$categories = $this->get_categories();

			foreach ( $categories as $slug => $label ) {
				if ( ! WP_Block_Pattern_Categories_Registry::get_instance()->is_registered( $slug ) ) {
					register_block_pattern_category( $slug, array( 'label' => $label ) );
				}
			}

			foreach ( $this->get_pattern_files() as $pattern_file ) {
				require $pattern_file;
			}
		}

		/**
		 * Resolve the list of pattern files, using a version-keyed transient cache.
		 *
		 * The pattern directory only changes with theme updates, so the cache is
		 * invalidated by comparing the stored theme version against the current one.
		 */
		private function get_pattern_files() {
			$patterns_dir = get_template_directory() . '/inc/modules/pattern-library/patterns/';

			if ( ! is_dir( $patterns_dir ) ) {
				return array();
			}

			$theme_version = wp_get_theme()->get( 'Version' );
			$cached        = get_transient( self::PATTERN_FILES_CACHE_KEY );

			if (
				is_array( $cached )
				&& isset( $cached['version'], $cached['files'] )
				&& $cached['version'] === $theme_version
				&& is_array( $cached['files'] )
			) {
				return $cached['files'];
			}

			$files = glob( $patterns_dir . '*.php' );
			if ( ! is_array( $files ) ) {
				$files = array();
			}

			set_transient(
				self::PATTERN_FILES_CACHE_KEY,
				array(
					'version' => $theme_version,
					'files'   => $files,
				),
				WEEK_IN_SECONDS
			);

			return $files;
		}

		/**
		 * Enqueue block editor assets
		 */
		public function enqueue_assets() {
			$asset_file = get_template_directory() . '/inc/modules/pattern-library/build/index.asset.php';

			if ( ! file_exists( $asset_file ) ) {
				return;
			}

			$asset = require $asset_file;

			if ( ! is_array( $asset ) ) {
				return;
			}

			wp_enqueue_script(
				'sydney-pattern-library',
				get_template_directory_uri() . '/inc/modules/pattern-library/build/index.js',
				$asset['dependencies'],
				$asset['version'],
				true
			);

		$style_file = get_template_directory() . '/inc/modules/pattern-library/build/index.css';
		if ( file_exists( $style_file ) ) {
			wp_enqueue_style(
				'sydney-pattern-library',
				get_template_directory_uri() . '/inc/modules/pattern-library/build/index.css',
				array(),
				filemtime( $style_file )
			);
		}

			wp_localize_script(
				'sydney-pattern-library',
				'sydneyPatternLibrary',
				array(
					'isPro'      => defined( 'SYDNEY_PRO_VERSION' ),
					'upgradeUrl' => 'https://athemes.com/sydney-upgrade/',
					'typeOrder'  => array_keys( $this->get_categories() ),
				)
			);
		}
	}

	Sydney_Pattern_Library::get_instance();
}
