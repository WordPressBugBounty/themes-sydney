<?php
/**
 * Pattern Library module
 *
 * @package Sydney
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Sydney_Modules' ) || ! Sydney_Modules::is_module_active( 'pattern-library' ) ) {
	return;
}

// Usage tracking (issue #440): monthly used-pattern buckets + snapshot filter.
require_once __DIR__ . '/class-sydney-pattern-library-tracking.php';

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
		 *
		 * Suffix bumped to invalidate caches written by older releases that stored
		 * absolute server paths (broke after site migration — see issue #393).
		 */
		const PATTERN_FILES_CACHE_KEY = 'sydney_pattern_files_v2';

		/**
		 * User meta key storing the per-user favorited pattern names.
		 */
		const USER_META_KEY = 'sydney_pattern_library_favorites';

		/**
		 * Hard cap on the number of favorites stored per user. Defensive — prevents
		 * unbounded growth from a misbehaving client or hand-crafted POST.
		 */
		const FAVORITES_MAX = 500;

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
			if ( $this->should_register_on_init() ) {
				add_action( 'init', array( $this, 'register_patterns' ) );
			}
			if ( $this->is_org_pattern_preview() ) {
				add_action( 'wp', array( $this, 'force_org_preview_layout' ) );
			}
			add_action( 'rest_api_init', array( $this, 'register_patterns' ) );
			add_action( 'rest_api_init', array( $this, 'register_rest_routes' ) );
			add_action( 'enqueue_block_editor_assets', array( $this, 'enqueue_assets' ) );
		}

		/**
		 * Whether this request is a wordpress.org (wp-themes.com) pattern preview.
		 *
		 * wp-themes.com renders each directory pattern preview as a plain
		 * front-end request carrying a `pattern_name` query var (issue #412).
		 * Existence check only; the value is never read, so there is nothing to
		 * sanitize.
		 *
		 * @return bool
		 */
		public function is_org_pattern_preview() {
			return isset( $_GET['pattern_name'] ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		}

		/**
		 * Drop the sidebar and force a full-width content column in .org pattern
		 * previews (issue #480).
		 *
		 * wp-themes.com serves the preview from a fresh install, so the request
		 * falls through to the blog index (home.php). That template renders the
		 * primary column at col-md-9 via sydney_page_content_classes()
		 * (inc/extras.php), leaving an empty col-md-3 gutter even though the
		 * widget-less sidebar prints nothing (sidebar.php early-returns). The gap
		 * makes full-width patterns look cramped in every directory screenshot.
		 *
		 * Gated on the same signal as pattern registration, so nothing here can
		 * reach a real visitor's site. Priority 999 because
		 * sydney_page_content_classes() discards the filtered value and returns
		 * its own, so the last callback to run wins.
		 */
		public function force_org_preview_layout() {
			if ( ! $this->is_org_pattern_preview() ) {
				return;
			}

			add_filter( 'sydney_show_sidebar', '__return_false' );
			add_filter( 'sydney_content_area_class', array( $this, 'fullwidth_content_class' ), 999 );
		}

		/**
		 * Content-area class for .org pattern previews.
		 *
		 * Named method rather than a closure so it is assertable in unit tests.
		 *
		 * @return string
		 */
		public function fullwidth_content_class() {
			return 'fullwidth';
		}

		/**
		 * Whether this request needs patterns registered on `init`.
		 *
		 * Patterns are only ever read in three request types:
		 * 1. wordpress.org pattern previews (issue #412): wp-themes.com renders
		 *    each preview via a plain front-end request carrying a `pattern_name`
		 *    query var. Without registering here, the .org "Patterns" section
		 *    shows empty boxes.
		 * 2. Block-editor admin screens, where WP builds the editor settings
		 *    from the pattern registry during page render (pre-6.0 WP relies
		 *    on this; newer WP preloads via REST).
		 * 3. REST requests, including the editor's preloaded
		 *    /wp/v2/block-patterns call. Covered by the separate
		 *    rest_api_init hook in the constructor, not by this check.
		 *
		 * Everything else (plain front-end views, unrelated admin screens such
		 * as plugins.php) skips registration so the pattern files are not
		 * loaded on requests where nothing reads them.
		 *
		 * @return bool
		 */
		public function should_register_on_init() {
			if ( $this->is_org_pattern_preview() ) {
				return true;
			}

			if ( ! is_admin() || wp_doing_ajax() || wp_doing_cron() ) {
				return false;
			}

			global $pagenow;

			$editor_screens = array( 'post.php', 'post-new.php', 'site-editor.php', 'widgets.php', 'customize.php' );

			return in_array( $pagenow, $editor_screens, true );
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
		 *
		 * Only basenames are stored in the cache; the absolute path is rebuilt from
		 * the current template directory on read so the cache survives site migration
		 * (issue #393).
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
				return array_map(
					static function ( $basename ) use ( $patterns_dir ) {
						return $patterns_dir . $basename;
					},
					$cached['files']
				);
			}

			$files = glob( $patterns_dir . '*.php' );
			if ( ! is_array( $files ) ) {
				$files = array();
			}

			set_transient(
				self::PATTERN_FILES_CACHE_KEY,
				array(
					'version' => $theme_version,
					'files'   => array_map( 'basename', $files ),
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
					'isPro'        => defined( 'SYDNEY_PRO_VERSION' ),
					'upgradeUrl'   => 'https://athemes.com/sydney-upgrade/',
					'favorites'    => self::get_user_favorites( get_current_user_id() ),
					'recentlyUsed' => self::get_user_recently_used( get_current_user_id() ),
					'typeOrder'    => array_keys( $this->get_categories() ),
				)
			);
		}

		/**
		 * Register the favorites REST routes.
		 *
		 * Backend-only: both routes are hidden from the API discovery index
		 * (`show_in_index => false`) and gated to logged-in users with the
		 * edit_posts capability — the same audience that can open the pattern
		 * library in the block editor.
		 */
		public function register_rest_routes() {
			register_rest_route(
				'sydney/v1',
				'/pattern-favorites',
				array(
					'methods'             => 'GET',
					'callback'            => array( $this, 'rest_get_favorites' ),
					'permission_callback' => array( $this, 'rest_favorites_permissions_check' ),
					'show_in_index'       => false,
				)
			);

			register_rest_route(
				'sydney/v1',
				'/pattern-favorites',
				array(
					'methods'             => 'POST',
					'callback'            => array( $this, 'rest_update_favorites' ),
					'permission_callback' => array( $this, 'rest_favorites_permissions_check' ),
					'show_in_index'       => false,
					'args'                => array(
						'favorites' => array(
							'required' => true,
							'type'     => 'array',
							'items'    => array(
								'type' => 'string',
							),
						),
					),
				)
			);

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

			register_rest_route(
				'sydney/v1',
				'/pattern-insert',
				array(
					'methods'             => 'POST',
					'callback'            => array( $this, 'rest_track_pattern_insert' ),
					'permission_callback' => array( $this, 'rest_pattern_insert_permissions_check' ),
					'show_in_index'       => false,
					'args'                => array(
						'pattern' => array(
							'required' => true,
							'type'     => 'string',
						),
					),
				)
			);
		}

		/**
		 * REST permission gate: logged-in editors only.
		 *
		 * Explicit `is_user_logged_in()` check produces a clean 401 for
		 * anonymous callers; the capability check produces a 403 for
		 * authenticated-but-under-privileged callers.
		 *
		 * @return bool
		 */
		public function rest_favorites_permissions_check() {
			return is_user_logged_in() && current_user_can( 'edit_posts' );
		}

		/**
		 * GET handler — return the current user's favorites.
		 *
		 * @return \WP_REST_Response
		 */
		public function rest_get_favorites() {
			return rest_ensure_response(
				array( 'favorites' => self::get_user_favorites( get_current_user_id() ) )
			);
		}

		/**
		 * POST handler — sanitize and persist the user's favorites array.
		 *
		 * @param \WP_REST_Request $request REST request.
		 * @return \WP_REST_Response
		 */
		public function rest_update_favorites( $request ) {
			$sanitized = self::sanitize_favorites_input( $request->get_param( 'favorites' ) );

			update_user_meta(
				get_current_user_id(),
				self::USER_META_KEY,
				wp_json_encode( $sanitized )
			);

			return rest_ensure_response( array( 'favorites' => $sanitized ) );
		}

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

		/**
		 * REST permission gate for the pattern-insert tracking route:
		 * logged-in editors only. Mirrors rest_favorites_permissions_check().
		 *
		 * @return bool
		 */
		public function rest_pattern_insert_permissions_check() {
			return is_user_logged_in() && current_user_can( 'edit_posts' );
		}

		/**
		 * POST handler — record a pattern insert in the monthly usage buckets.
		 *
		 * Same pattern-name format rule as the favorites/recently-used
		 * sanitizers; anything else is rejected outright rather than
		 * silently dropped, so the client ping surfaces mistakes.
		 *
		 * @param \WP_REST_Request $request REST request.
		 * @return \WP_REST_Response|\WP_Error
		 */
		public function rest_track_pattern_insert( $request ) {
			$pattern = $request->get_param( 'pattern' );

			if ( ! is_string( $pattern ) || ! preg_match( '#^sydney(-pro)?/[a-z0-9_-]+$#', $pattern ) ) {
				return new WP_Error(
					'sydney_pattern_library_invalid_pattern',
					__( 'Invalid pattern name.', 'sydney' ),
					array( 'status' => 400 )
				);
			}

			Sydney_Pattern_Library_Tracking::record_insert( $pattern );

			return rest_ensure_response( array( 'tracked' => true ) );
		}

		/**
		 * Read and validate a user's favorites array from user meta.
		 *
		 * Returns an empty array on any failure (missing meta, malformed JSON,
		 * non-array payload) — callers can treat the result as authoritative
		 * without their own validation.
		 *
		 * @param int $user_id User ID.
		 * @return array<int, string>
		 */
		public static function get_user_favorites( $user_id ) {
			if ( empty( $user_id ) ) {
				return array();
			}

			$raw = get_user_meta( $user_id, self::USER_META_KEY, true );
			if ( empty( $raw ) || ! is_string( $raw ) ) {
				return array();
			}

			$decoded = json_decode( $raw, true );
			if ( ! is_array( $decoded ) ) {
				return array();
			}

			return self::sanitize_favorites_input( $decoded );
		}

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

		/**
		 * Sanitize a favorites input array.
		 *
		 * Filters the input down to:
		 *   - strings only,
		 *   - matching the pattern-name format `sydney/...` or `sydney-pro/...`
		 *     with lowercase alphanumerics, hyphens, and underscores only
		 *     (case-sensitive — registered pattern names are always lowercase,
		 *     and mixed-case entries would never match the client-side filter),
		 *   - de-duplicated (first occurrence wins to preserve user ordering),
		 *   - capped at FAVORITES_MAX entries.
		 *
		 * @param mixed $raw Untrusted input. Anything not an array becomes [].
		 * @return array<int, string>
		 */
		public static function sanitize_favorites_input( $raw ) {
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
				if ( count( $out ) >= self::FAVORITES_MAX ) {
					break;
				}
			}

			return $out;
		}

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
	}

	Sydney_Pattern_Library::get_instance();
}
