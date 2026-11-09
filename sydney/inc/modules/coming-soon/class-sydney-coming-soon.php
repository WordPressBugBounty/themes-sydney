<?php
/**
 * Coming Soon module: the Site mode setting and the Placeholder page.
 *
 * While a Site mode is on, visitors get one Placeholder page on every front-end
 * URL and users who can edit pages see the real site. This class owns the stored
 * state and the page; the request gate and the admin side are their own classes.
 *
 * Loaded on every request, with no module gate at file scope: deactivating the
 * module has to switch the mode off, and usage tracking and the abilities read
 * the mode while the module is off too. Only the gate and the admin side wait
 * for the module.
 *
 * @package Sydney
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Sydney_Coming_Soon' ) ) :

	/**
	 * Sydney_Coming_Soon class.
	 */
	class Sydney_Coming_Soon {

		/**
		 * Module slug in the sydney-modules option.
		 */
		const MODULE = 'coming-soon';

		/**
		 * Option holding mode, page_id, enabled_at and conditions. An option
		 * rather than a theme_mod, so it survives a switch to a child theme.
		 */
		const OPTION = 'sydney_coming_soon';

		/**
		 * When a Site mode was first turned on, for usage tracking.
		 */
		const FIRST_ENABLED_OPTION = 'sydney_coming_soon_first_enabled';

		/**
		 * Stored Site mode values.
		 */
		const MODES = array( 'off', 'coming-soon', 'maintenance' );

		/**
		 * Page statuses a Placeholder page may have.
		 */
		const PAGE_STATUSES = array( 'publish', 'draft', 'private' );

		/**
		 * Builders a new Placeholder page can be created with.
		 */
		const BUILDERS = array( 'editor', 'elementor' );

		/**
		 * Lifetime of a bypass token, in seconds.
		 */
		const BYPASS_TTL = 60;

		/**
		 * Query arg that previews the Placeholder page as visitors get it.
		 */
		const PREVIEW_ARG = 'sydney-coming-soon-preview';

		/**
		 * Query arg carrying a bypass token, see create_bypass_token().
		 */
		const TOKEN_ARG = 'sydney-cs-token';

		/**
		 * Hook everything that has to run whether or not the module is active,
		 * then the gate and the admin side when it is.
		 */
		public static function init() {
			add_action( 'update_option_sydney-modules', array( __CLASS__, 'on_modules_updated' ), 10, 2 );
			add_filter( 'sydney_usage_tracking_data', array( __CLASS__, 'add_usage_tracking_data' ) );

			if ( ! self::is_module_active() ) {
				return;
			}

			// Every save path goes through here: the block editor's REST save,
			// Elementor's ajax save, Quick Edit.
			add_filter( 'wp_insert_post_data', array( __CLASS__, 'keep_page_private' ), 10, 2 );

			require_once __DIR__ . '/class-sydney-coming-soon-gate.php';
			require_once __DIR__ . '/class-sydney-coming-soon-admin.php';

			Sydney_Coming_Soon_Gate::init();
			Sydney_Coming_Soon_Admin::init();
		}

		/**
		 * Save a publish or schedule of the Placeholder page as private, so the
		 * page never becomes a public page of its own: not at its URL once the
		 * mode is off, not in sitemaps, search or the REST API.
		 *
		 * @param array $data    Slashed post data about to be saved.
		 * @param array $postarr Raw post data, ID included for an update.
		 * @return array
		 */
		public static function keep_page_private( $data, $postarr ) {
			$page_id = self::get_page_id();

			if ( $page_id && ! empty( $postarr['ID'] ) && (int) $postarr['ID'] === $page_id && in_array( $data['post_status'], array( 'publish', 'future' ), true ) ) {
				$data['post_status'] = 'private';
			}

			return $data;
		}

		/**
		 * Whether the coming-soon module is active.
		 *
		 * @return bool
		 */
		public static function is_module_active() {
			return class_exists( 'Sydney_Modules' ) && Sydney_Modules::is_module_active( self::MODULE );
		}

		/**
		 * The stored settings, merged over the defaults with every field cast.
		 *
		 * @return array { mode: string, page_id: int, enabled_at: int, conditions: array }
		 */
		public static function get_settings() {
			$raw = get_option( self::OPTION, array() );
			$raw = is_array( $raw ) ? $raw : array();

			$mode = isset( $raw['mode'] ) && in_array( $raw['mode'], self::MODES, true ) ? $raw['mode'] : 'off';

			return array(
				'mode'       => $mode,
				'page_id'    => isset( $raw['page_id'] ) ? absint( $raw['page_id'] ) : 0,
				'enabled_at' => isset( $raw['enabled_at'] ) ? (int) $raw['enabled_at'] : 0,
				'conditions' => isset( $raw['conditions'] ) && is_array( $raw['conditions'] ) ? $raw['conditions'] : array(),
			);
		}

		/**
		 * The stored Site mode.
		 *
		 * @return string One of self::MODES.
		 */
		public static function get_mode() {
			$settings = self::get_settings();

			return $settings['mode'];
		}

		/**
		 * Whether a Site mode is on: the module is active and the mode is not off.
		 *
		 * @return bool
		 */
		public static function is_on() {
			return self::is_module_active() && 'off' !== self::get_mode();
		}

		/**
		 * The stored Placeholder page ID.
		 *
		 * @return int
		 */
		public static function get_page_id() {
			$settings = self::get_settings();

			return $settings['page_id'];
		}

		/**
		 * The Placeholder page ID to render: the translation for the current
		 * language when WPML or Polylang provide one, the stored page otherwise.
		 *
		 * @return int
		 */
		public static function get_render_page_id() {
			$page_id = self::get_page_id();

			if ( ! $page_id ) {
				return 0;
			}

			$translated = (int) apply_filters( 'wpml_object_id', $page_id, 'page', true );

			return $translated ? $translated : $page_id;
		}

		/**
		 * Whether a post can serve as the Placeholder page: a page that is
		 * published, a draft or private.
		 *
		 * @param int $page_id Post ID.
		 * @return bool
		 */
		public static function page_is_valid( $page_id ) {
			$page_id = absint( $page_id );

			if ( ! $page_id ) {
				return false;
			}

			$post = get_post( $page_id );

			return $post && 'page' === $post->post_type && in_array( $post->post_status, self::PAGE_STATUSES, true );
		}

		/**
		 * Update the mode, the page and/or the conditions.
		 *
		 * A mode other than off needs a valid page, so a mode is never on
		 * without one. A mode change stamps enabled_at, records the first time
		 * a mode was turned on, and purges the page caches.
		 *
		 * @param array $input Any of mode (string), page_id (int), conditions (array of rules, already sanitized).
		 * @return array|WP_Error The settings after the save.
		 */
		public static function save_settings( array $input ) {
			$settings     = self::get_settings();
			$mode_changed = false;
			$page_changed = false;

			if ( array_key_exists( 'page_id', $input ) ) {
				$page_id = absint( $input['page_id'] );

				if ( $page_id && ! self::page_is_valid( $page_id ) ) {
					return new WP_Error( 'sydney_coming_soon_invalid_page', __( 'Pick a published, draft or private page.', 'sydney' ) );
				}

				$page_changed        = $page_id !== $settings['page_id'];
				$settings['page_id'] = $page_id;
			}

			if ( array_key_exists( 'mode', $input ) ) {
				$mode = is_string( $input['mode'] ) ? $input['mode'] : '';

				if ( ! in_array( $mode, self::MODES, true ) ) {
					return new WP_Error( 'sydney_coming_soon_invalid_mode', __( 'Unknown Site mode.', 'sydney' ) );
				}

				if ( $mode !== $settings['mode'] ) {
					$settings['mode']       = $mode;
					$settings['enabled_at'] = ( 'off' === $mode ) ? 0 : time();
					$mode_changed           = true;
				}
			}

			if ( array_key_exists( 'conditions', $input ) ) {
				$settings['conditions'] = is_array( $input['conditions'] ) ? array_values( $input['conditions'] ) : array();
			}

			if ( 'off' !== $settings['mode'] && ! self::page_is_valid( $settings['page_id'] ) ) {
				return new WP_Error( 'sydney_coming_soon_no_page', __( 'Create or pick a placeholder page first.', 'sydney' ) );
			}

			update_option( self::OPTION, $settings );

			if ( $mode_changed && 'off' !== $settings['mode'] && ! get_option( self::FIRST_ENABLED_OPTION ) ) {
				update_option( self::FIRST_ENABLED_OPTION, time(), false );
			}

			// What visitors are served changed, so cached copies of it are stale.
			if ( $mode_changed || ( $page_changed && 'off' !== $settings['mode'] ) || array_key_exists( 'conditions', $input ) ) {
				self::purge_caches();
			}

			return self::get_settings();
		}

		/**
		 * Switch the mode off when the module is deactivated.
		 *
		 * Hooked on update_option_sydney-modules, which covers every path that
		 * writes the module list: the Home tab card, the activate-all handler
		 * and the activation URL.
		 *
		 * @param mixed $old_value Previous module list.
		 * @param mixed $new_value New module list.
		 */
		public static function on_modules_updated( $old_value, $new_value ) {
			$was_active = is_array( $old_value ) && ! empty( $old_value[ self::MODULE ] );
			$is_active  = is_array( $new_value ) && ! empty( $new_value[ self::MODULE ] );

			if ( ! $was_active || $is_active ) {
				return;
			}

			if ( 'off' !== self::get_mode() ) {
				self::save_settings( array( 'mode' => 'off' ) );
			}
		}

		/**
		 * Purge the page caches of the common cache plugins.
		 */
		public static function purge_caches() {
			if ( function_exists( 'rocket_clean_domain' ) ) {
				rocket_clean_domain();
			}

			if ( function_exists( 'w3tc_flush_all' ) ) {
				w3tc_flush_all();
			}

			if ( function_exists( 'wp_cache_clear_cache' ) ) {
				wp_cache_clear_cache();
			}

			if ( function_exists( 'wpfc_clear_all_cache' ) ) {
				wpfc_clear_all_cache( true );
			}

			if ( function_exists( 'sg_cachepress_purge_cache' ) ) {
				sg_cachepress_purge_cache();
			}

			// These plugins purge through their own actions.
			do_action( 'litespeed_purge_all' ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound -- LiteSpeed Cache's hook.
			do_action( 'breeze_clear_all_cache' ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound -- Breeze's hook.
			do_action( 'cache_enabler_clear_complete_cache' ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound -- Cache Enabler's hook.
			do_action( 'wphb_clear_page_cache' ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound -- Hummingbird's hook.

			/**
			 * Fires after Sydney purged the cache plugins it knows, so hosts and
			 * other cache layers can purge as well.
			 */
			do_action( 'sydney_coming_soon_purge_caches' );
		}

		/**
		 * A signed token that lets one request read the real site, for the
		 * theme's own loopback fetches (the page-structure ability).
		 *
		 * @param string $path Request path the token opens, relative to the site root, see token_path().
		 * @return string "<expires>.<signature>"
		 */
		public static function create_bypass_token( $path = '' ) {
			$expires = time() + self::BYPASS_TTL;

			return $expires . '.' . self::bypass_signature( $expires, $path );
		}

		/**
		 * Whether a bypass token is genuine, still valid and issued for this path.
		 *
		 * @param mixed  $token Token from the request.
		 * @param string $path  Request path, relative to the site root.
		 * @return bool
		 */
		public static function verify_bypass_token( $token, $path = '' ) {
			if ( ! is_string( $token ) || ! preg_match( '/^(\d+)\.([a-f0-9]{64})$/', $token, $matches ) ) {
				return false;
			}

			$expires = (int) $matches[1];
			$now     = time();

			// Expired, or dated further ahead than a token this site issues.
			if ( $expires < $now || $expires > $now + ( 2 * self::BYPASS_TTL ) ) {
				return false;
			}

			return hash_equals( self::bypass_signature( $expires, $path ), $matches[2] );
		}

		/**
		 * HMAC of a bypass token's expiry and path.
		 *
		 * @param int    $expires Expiry timestamp.
		 * @param string $path    Request path the token opens.
		 * @return string
		 */
		protected static function bypass_signature( $expires, $path ) {
			return hash_hmac( 'sha256', 'sydney-coming-soon-bypass|' . $expires . '|' . trim( (string) $path, '/' ), wp_salt( 'auth' ) );
		}

		/**
		 * The path of a URL relative to the site root, no slashes at the ends,
		 * decoded: what the gate sees as the request path when the URL is
		 * fetched, whether the URL comes percent-encoded or not.
		 *
		 * @param string $url Absolute URL on this site.
		 * @return string
		 */
		public static function token_path( $url ) {
			// parse_url() mangles raw UTF-8, so encode it first, as a browser would.
			$url = preg_replace_callback(
				'/[\x80-\xff]+/',
				function ( $matches ) {
					return rawurlencode( $matches[0] );
				},
				$url
			);

			$parts = (array) wp_parse_url( $url );
			$home  = (array) wp_parse_url( home_url( '/' ) );
			$path  = isset( $parts['path'] ) ? $parts['path'] : '';
			$base  = isset( $home['path'] ) ? $home['path'] : '';

			if ( '' !== $base && 0 === strpos( $path, $base ) ) {
				$path = substr( $path, strlen( $base ) );
			}

			return rawurldecode( trim( $path, '/' ) );
		}

		/**
		 * Link to the settings section.
		 *
		 * @return string
		 */
		public static function settings_url() {
			return admin_url( 'admin.php?page=sydney-dashboard&tab=settings#sydney-coming-soon' );
		}

		/**
		 * The design library: free designs ship with the theme, Pro designs are
		 * listed here by name and thumbnail so free can show them locked.
		 *
		 * @return array Slug => { name, type ('free'|'pro'), thumbnail }.
		 */
		public static function get_designs() {
			$designs = require __DIR__ . '/designs.php';

			/**
			 * Filters the Placeholder page designs.
			 *
			 * @param array $designs Slug => { name, type, thumbnail }.
			 */
			$designs = apply_filters( 'sydney_coming_soon_designs', $designs );

			return is_array( $designs ) ? $designs : array();
		}

		/**
		 * The content of a design for a builder: block markup for the editor,
		 * Elementor JSON for Elementor. Free designs are read from this module's
		 * folder; Pro supplies its own through the filter.
		 *
		 * @param string $slug    Design slug.
		 * @param string $builder 'editor' or 'elementor'.
		 * @return string
		 */
		public static function get_design_content( $slug, $builder ) {
			$designs = self::get_designs();
			$content = '';

			if ( ! isset( $designs[ $slug ] ) ) {
				return '';
			}

			$type = isset( $designs[ $slug ]['type'] ) ? $designs[ $slug ]['type'] : 'pro';

			// The slug names a folder, so only a plain key is read from disk.
			if ( 'free' === $type && sanitize_key( $slug ) === $slug ) {
				$file = __DIR__ . '/designs/' . $slug . '/' . ( 'elementor' === $builder ? 'elementor.json' : 'blocks.html' );

				if ( is_readable( $file ) ) {
					$content = (string) file_get_contents( $file ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents -- Local file shipped with the theme.
				}
			}

			/**
			 * Filters a design's content.
			 *
			 * @param string $content Block markup or Elementor JSON, '' when unknown.
			 * @param string $slug    Design slug.
			 * @param string $builder 'editor' or 'elementor'.
			 */
			$content = (string) apply_filters( 'sydney_coming_soon_design_content', $content, $slug, $builder );

			// Design images ship in the theme: {{images}} becomes their folder's URL.
			return str_replace( '{{images}}', get_template_directory_uri() . '/images/coming-soon', $content );
		}

		/**
		 * Create a private Placeholder page from a design and make it the page.
		 * Private rather than draft, so the editor offers Update, not Publish.
		 *
		 * With $replace, the design overwrites the current Placeholder page in
		 * place, keeping its ID and title. A lost page gets a new one instead.
		 *
		 * @param string $builder 'editor' or 'elementor'.
		 * @param string $design  Design slug.
		 * @param bool   $replace Whether to overwrite the current page.
		 * @return array|WP_Error Page data, see self::page_data().
		 */
		public static function create_page( $builder, $design, $replace = false ) {
			if ( ! in_array( $builder, self::BUILDERS, true ) || ( 'elementor' === $builder && ! class_exists( '\Elementor\Plugin' ) ) ) {
				return new WP_Error( 'sydney_coming_soon_builder', __( 'This builder is not available.', 'sydney' ) );
			}

			$designs = self::get_designs();

			if ( ! isset( $designs[ $design ] ) ) {
				return new WP_Error( 'sydney_coming_soon_design', __( 'Unknown design.', 'sydney' ) );
			}

			if ( ( ! isset( $designs[ $design ]['type'] ) || 'free' !== $designs[ $design ]['type'] ) && ! defined( 'SYDNEY_PRO_VERSION' ) ) {
				return new WP_Error( 'sydney_coming_soon_pro_design', __( 'This design is only available on Sydney Pro.', 'sydney' ) );
			}

			$content = self::get_design_content( $design, $builder );

			if ( '' === trim( $content ) ) {
				return new WP_Error( 'sydney_coming_soon_empty_design', __( 'This design has no content for this builder.', 'sydney' ) );
			}

			$elements = array();

			if ( 'elementor' === $builder ) {
				$elements = json_decode( $content, true );

				// An exported template wraps its elements in "content".
				if ( is_array( $elements ) && isset( $elements['content'] ) && is_array( $elements['content'] ) ) {
					$elements = $elements['content'];
				}

				if ( ! is_array( $elements ) || empty( $elements ) ) {
					return new WP_Error( 'sydney_coming_soon_empty_design', __( 'This design has no content for this builder.', 'sydney' ) );
				}
			}

			$page_id = $replace ? self::get_page_id() : 0;

			if ( $page_id && self::page_is_valid( $page_id ) ) {
				// The previous layout and Elementor's caches of it, so neither the
				// old design nor its stale CSS outlives the new one.
				foreach ( array( '_elementor_edit_mode', '_elementor_data', '_elementor_css', '_elementor_element_cache', '_elementor_page_assets' ) as $meta_key ) {
					delete_post_meta( $page_id, $meta_key );
				}

				if ( 'elementor_canvas' === get_post_meta( $page_id, '_wp_page_template', true ) ) {
					delete_post_meta( $page_id, '_wp_page_template' );
				}

				$page_id = wp_update_post(
					array(
						'ID'           => $page_id,
						'post_content' => 'editor' === $builder ? wp_slash( $content ) : '',
					),
					true
				);
			} else {
				$page_id = wp_insert_post(
					array(
						'post_type'    => 'page',
						'post_status'  => 'private',
						'post_title'   => __( 'Coming Soon', 'sydney' ),
						'post_content' => 'editor' === $builder ? wp_slash( $content ) : '',
					),
					true
				);
			}

			if ( is_wp_error( $page_id ) ) {
				return $page_id;
			}

			if ( 'elementor' === $builder ) {
				update_post_meta( $page_id, '_elementor_edit_mode', 'builder' );
				update_post_meta( $page_id, '_elementor_template_type', 'wp-page' );
				update_post_meta( $page_id, '_elementor_version', defined( 'ELEMENTOR_VERSION' ) ? ELEMENTOR_VERSION : '' );
				update_post_meta( $page_id, '_elementor_data', wp_slash( wp_json_encode( $elements ) ) );
				update_post_meta( $page_id, '_wp_page_template', 'elementor_canvas' );
			}

			$saved = self::save_settings( array( 'page_id' => $page_id ) );

			if ( is_wp_error( $saved ) ) {
				return $saved;
			}

			return self::page_data( $page_id );
		}

		/**
		 * Whether a page was built with Elementor, by its post meta. Works while
		 * Elementor is inactive, which Gate::is_built_with_elementor() does not.
		 *
		 * @param int $page_id Page ID.
		 * @return bool
		 */
		public static function is_elementor_page( $page_id ) {
			return 'builder' === get_post_meta( $page_id, '_elementor_edit_mode', true );
		}

		/**
		 * The dashboard's editor link for the page: Elementor's editor for an
		 * Elementor page while Elementor is active, the block editor without its
		 * admin chrome otherwise.
		 *
		 * @param int $page_id Page ID.
		 * @return string
		 */
		public static function edit_url( $page_id ) {
			if ( class_exists( '\Elementor\Plugin' ) && self::is_elementor_page( $page_id ) ) {
				return admin_url( 'post.php?post=' . absint( $page_id ) . '&action=elementor' );
			}

			return admin_url( 'post.php?post=' . absint( $page_id ) . '&action=edit&sydney-canvas=1' );
		}

		/**
		 * Link that shows the Placeholder page the way visitors get it.
		 *
		 * @return string
		 */
		public static function preview_url() {
			return add_query_arg( self::PREVIEW_ARG, '1', home_url( '/' ) );
		}

		/**
		 * The page as the dashboard and the abilities describe it.
		 *
		 * @param int $page_id Page ID.
		 * @return array|null { id, title, status, status_label, edit_url, preview_url }, null for an invalid page.
		 */
		public static function page_data( $page_id ) {
			if ( ! self::page_is_valid( $page_id ) ) {
				return null;
			}

			$status       = get_post_status( $page_id );
			$status_label = '';

			if ( 'draft' === $status ) {
				$status_label = __( 'Draft', 'sydney' );
			} elseif ( 'private' === $status ) {
				$status_label = __( 'Private', 'sydney' );
			}

			$title = get_the_title( $page_id );

			return array(
				'id'           => (int) $page_id,
				'title'        => '' !== $title ? $title : __( '(no title)', 'sydney' ),
				'status'       => $status,
				'status_label' => $status_label,
				'edit_url'     => self::edit_url( $page_id ),
				'preview_url'  => self::preview_url(),
			);
		}

		/**
		 * Admin-bar label for a mode, '' for off.
		 *
		 * @param string $mode Site mode.
		 * @return string
		 */
		public static function mode_label( $mode ) {
			if ( 'coming-soon' === $mode ) {
				return __( 'Coming Soon mode', 'sydney' );
			}

			if ( 'maintenance' === $mode ) {
				return __( 'Maintenance mode', 'sydney' );
			}

			return '';
		}

		/**
		 * The current state, as the settings save response and the read
		 * ability report it.
		 *
		 * @return array { module_active, mode, label, enabled_at, page, page_missing }
		 */
		public static function state() {
			$settings = self::get_settings();
			$active   = self::is_module_active();
			$mode     = $active ? $settings['mode'] : 'off';
			$page     = self::page_data( $settings['page_id'] );

			return array(
				'module_active' => $active,
				'mode'          => $mode,
				'label'         => self::mode_label( $mode ),
				'enabled_at'    => 'off' === $mode ? 0 : $settings['enabled_at'],
				'page'          => $page,
				'page_missing'  => 'off' !== $mode && null === $page,
			);
		}

		/**
		 * Names of active plugins or settings that run a coming soon or
		 * maintenance mode of their own.
		 *
		 * @return string[]
		 */
		public static function get_conflicts() {
			if ( ! function_exists( 'is_plugin_active' ) ) {
				require_once ABSPATH . 'wp-admin/includes/plugin.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
			}

			/**
			 * Filters the coming soon and maintenance plugins checked for conflicts.
			 *
			 * @param array $plugins Plugin file => display name.
			 */
			$plugins = apply_filters(
				'sydney_coming_soon_conflict_plugins',
				array(
					'coming-soon/coming-soon.php'                     => 'SeedProd Coming Soon',
					'seedprod-coming-soon-pro-5/seedprod-coming-soon-pro-5.php' => 'SeedProd Pro',
					'wp-maintenance-mode/wp-maintenance-mode.php'     => 'LightStart (WP Maintenance Mode)',
					'maintenance/maintenance.php'                     => 'Maintenance',
					'under-construction-page/under-construction.php' => 'Under Construction',
					'cmp-coming-soon-maintenance/niteo-cmp.php'       => 'CMP Coming Soon & Maintenance',
					'minimal-coming-soon-maintenance-mode/minimal-coming-soon-maintenance-mode.php' => 'Minimal Coming Soon',
				)
			);

			$conflicts = array();

			foreach ( (array) $plugins as $file => $name ) {
				if ( is_plugin_active( $file ) ) {
					$conflicts[] = $name;
				}
			}

			if ( get_option( 'elementor_maintenance_mode_mode' ) ) {
				$conflicts[] = __( 'Elementor maintenance mode', 'sydney' );
			}

			if ( 'yes' === get_option( 'woocommerce_coming_soon' ) ) {
				$conflicts[] = __( 'WooCommerce coming soon mode', 'sydney' );
			}

			/**
			 * Filters the detected coming soon conflicts.
			 *
			 * @param string[] $conflicts Display names.
			 */
			return (array) apply_filters( 'sydney_coming_soon_conflicts', $conflicts );
		}

		/**
		 * Add the Site mode and the first-enabled date to the usage snapshot.
		 *
		 * Runs inside the consent-gated snapshot build only.
		 *
		 * @param array $data Snapshot payload.
		 * @return array
		 */
		public static function add_usage_tracking_data( $data ) {
			$data['athemes_sydney_site_mode']               = self::is_module_active() ? self::get_mode() : 'off';
			$data['athemes_sydney_site_mode_first_enabled'] = (int) get_option( self::FIRST_ENABLED_OPTION, 0 );

			return $data;
		}
	}

	Sydney_Coming_Soon::init();

endif;
