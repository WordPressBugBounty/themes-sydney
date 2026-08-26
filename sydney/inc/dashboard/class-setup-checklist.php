<?php
/**
 * Setup Checklist — item registry, detection, and state.
 *
 * @package Sydney
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sydney_Setup_Checklist {

	const USER_META_KEY = 'sydney_setup_checklist_state';
	const USED_OPTION   = 'sydney_setup_checklist_used';

	/**
	 * Singleton instance.
	 *
	 * @var Sydney_Setup_Checklist|null
	 */
	private static $instance = null;

	/**
	 * Cached items array (built once per request).
	 *
	 * @var array|null
	 */
	private $items_cache = null;

	/**
	 * Per-request detection cache.
	 *
	 * @var array<string,bool>
	 */
	private $detection_cache = array();

	/**
	 * Map of item slug => private detector method.
	 *
	 * @var array<string,string>
	 */
	private $detectors = array(
		'logo_site_title'   => 'detect_logo_site_title',
		'global_colors'     => 'detect_global_colors',
		'typography'        => 'detect_typography',
		'header_layout'     => 'detect_header_layout',
		'nav_menu'          => 'detect_nav_menu',
		'mobile_layout'     => 'detect_mobile_layout',
		'footer_layout'     => 'detect_footer_layout',
		'footer_credits'    => 'detect_footer_credits',
		'static_front_page' => 'detect_static_front_page',
		'blog_layout'       => 'detect_blog_layout',
		'single_posts'      => 'detect_single_posts',
		'shop_layout'       => 'detect_shop_layout',
		'product_layout'    => 'detect_product_layout',
		'install_merchant'  => 'detect_install_merchant',
	);

	public static function instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Build a Customizer deep-link URL.
	 *
	 * @param string $target  Section/panel/control slug.
	 * @param string $type    One of: section, panel, control.
	 * @return string
	 */
	public function customizer_link( $target, $type = 'section' ) {
		$type = in_array( $type, array( 'section', 'panel', 'control' ), true ) ? $type : 'section';
		return add_query_arg( 'autofocus[' . $type . ']', $target, admin_url( 'customize.php' ) );
	}

	/**
	 * Return the full checklist as a categories => items map.
	 *
	 * @return array
	 */
	public function items() {
		if ( null !== $this->items_cache ) {
			return $this->items_cache;
		}

		// Each help icon opens a screenshot for its item; files live alongside
		// the dashboard images and are named after the item slug.
		$theme_uri = get_template_directory_uri();
		$help_image = function ( $slug ) use ( $theme_uri ) {
			return $theme_uri . '/images/admin/checklist-help-' . $slug . '.jpg';
		};

		$categories = array(
			'branding' => array(
				'label' => esc_html__( 'Branding', 'sydney' ),
				'items' => array(
					'logo_site_title' => array(
						'title'        => esc_html__( 'Logo & Site Title', 'sydney' ),
						'description'  => esc_html__( 'Upload your logo and set your site title.', 'sydney' ),
						'action_url'   => $this->logo_site_title_url(),
						'action_label' => esc_html__( 'Customize', 'sydney' ),
						'help_image'   => $help_image( 'logo_site_title' ),
					),
					'global_colors' => array(
						'title'        => esc_html__( 'Global Colors', 'sydney' ),
						'description'  => esc_html__( 'Pick the colors that define your brand.', 'sydney' ),
						'action_url'   => $this->customizer_link( 'colors', 'section' ),
						'action_label' => esc_html__( 'Customize', 'sydney' ),
						'help_image'   => $help_image( 'global_colors' ),
					),
					'typography' => array(
						'title'        => esc_html__( 'Typography', 'sydney' ),
						'description'  => esc_html__( 'Choose fonts and sizes for your site.', 'sydney' ),
						'action_url'   => $this->customizer_link( 'sydney_panel_global_styles', 'panel' ),
						'action_label' => esc_html__( 'Customize', 'sydney' ),
						'help_image'   => $help_image( 'typography' ),
					),
				),
			),
			'header' => array(
				'label' => esc_html__( 'Header', 'sydney' ),
				'items' => array(
					'header_layout' => array(
						'title'        => esc_html__( 'Header Layout', 'sydney' ),
						'description'  => esc_html__( 'Pick how your site header looks.', 'sydney' ),
						'action_url'   => $this->header_layout_url(),
						'action_label' => esc_html__( 'Customize', 'sydney' ),
						'help_image'   => $help_image( 'header_layout' ),
					),
					'nav_menu' => array(
						'title'        => esc_html__( 'Navigation Menu', 'sydney' ),
						'description'  => esc_html__( 'Assign a menu to the primary navigation location.', 'sydney' ),
						'action_url'   => admin_url( 'nav-menus.php' ),
						'action_label' => esc_html__( 'Manage', 'sydney' ),
						'help_image'   => $help_image( 'nav_menu' ),
					),
					'mobile_layout' => array(
						'title'        => esc_html__( 'Mobile Header', 'sydney' ),
						'description'  => esc_html__( 'Configure how the header looks on mobile.', 'sydney' ),
						'action_url'   => $this->mobile_layout_url(),
						'action_label' => esc_html__( 'Customize', 'sydney' ),
						'help_image'   => $help_image( 'mobile_layout' ),
					),
				),
			),
			'footer' => array(
				'label' => esc_html__( 'Footer', 'sydney' ),
				'items' => array(
					'footer_layout' => array(
						'title'        => esc_html__( 'Footer Layout', 'sydney' ),
						'description'  => esc_html__( 'Pick how your footer is organized.', 'sydney' ),
						'action_url'   => $this->footer_layout_url(),
						'action_label' => esc_html__( 'Customize', 'sydney' ),
						'help_image'   => $help_image( 'footer_layout' ),
					),
					'footer_credits' => array(
						'title'        => esc_html__( 'Footer Credits', 'sydney' ),
						'description'  => esc_html__( 'Personalize the copyright line at the bottom.', 'sydney' ),
						'action_url'   => $this->footer_credits_url(),
						'action_label' => esc_html__( 'Customize', 'sydney' ),
						'help_image'   => $help_image( 'footer_credits' ),
					),
				),
			),
			'homepage' => array(
				'label' => esc_html__( 'Homepage', 'sydney' ),
				'items' => array(
					'static_front_page' => array(
						'title'        => esc_html__( 'Set up a Homepage', 'sydney' ),
						'description'  => esc_html__( 'Create a Home and Blog page, set them as your front page, and assign the Sydney Canvas template.', 'sydney' ),
						'action_url'   => '#',
						'action_label' => esc_html__( '1-click setup', 'sydney' ),
						'action_type'  => 'homepage_setup',
					),
				),
			),
			'blog' => array(
				'label' => esc_html__( 'Blog', 'sydney' ),
				'items' => array(
					'blog_layout' => array(
						'title'        => esc_html__( 'Blog Layout', 'sydney' ),
						'description'  => esc_html__( 'Customize how the blog archive looks.', 'sydney' ),
						'action_url'   => $this->customizer_link( 'sydney_section_blog_archives', 'section' ),
						'action_label' => esc_html__( 'Customize', 'sydney' ),
						'help_image'   => $help_image( 'blog_layout' ),
					),
					'single_posts' => array(
						'title'        => esc_html__( 'Single Posts', 'sydney' ),
						'description'  => esc_html__( 'Customize how single posts look.', 'sydney' ),
						'action_url'   => $this->customizer_link( 'sydney_section_blog_singles', 'section' ),
						'action_label' => esc_html__( 'Customize', 'sydney' ),
						'help_image'   => $help_image( 'single_posts' ),
					),
				),
			),
		);

		if ( $this->is_woocommerce_active() ) {
			$categories['shop'] = array(
				'label' => esc_html__( 'Shop', 'sydney' ),
				'items' => array(
					'shop_layout' => array(
						'title'        => esc_html__( 'Shop Layout', 'sydney' ),
						'description'  => esc_html__( 'Configure the WooCommerce shop archive.', 'sydney' ),
						'action_url'   => $this->customizer_link( 'woocommerce_product_catalog', 'section' ),
						'action_label' => esc_html__( 'Customize', 'sydney' ),
					),
					'product_layout' => array(
						'title'        => esc_html__( 'Product Layout', 'sydney' ),
						'description'  => esc_html__( 'Configure the single product page.', 'sydney' ),
						'action_url'   => $this->customizer_link( 'sydney_section_single_product', 'section' ),
						'action_label' => esc_html__( 'Customize', 'sydney' ),
					),
					'install_merchant' => array(
						'title'        => esc_html__( 'Install Merchant', 'sydney' ),
						'description'  => esc_html__( 'Install the Merchant plugin to unlock advanced WooCommerce features.', 'sydney' ),
						'action_url'   => '#',
						'action_label' => esc_html__( 'Install', 'sydney' ),
						'action_type'  => 'install_plugin',
						'manage_url'   => admin_url( 'admin.php?page=merchant' ),
						'manage_label' => esc_html__( 'Manage', 'sydney' ),
						'plugin_slug'  => 'merchant',
						'plugin_path'  => 'merchant/merchant.php',
					),
				),
			);
		}

		$this->items_cache = $categories;
		return $this->items_cache;
	}

	/**
	 * Detect whether an item has been completed based on auto signals.
	 *
	 * @param string $slug Item slug.
	 * @return bool
	 */
	public function is_complete( $slug ) {
		if ( isset( $this->detection_cache[ $slug ] ) ) {
			return $this->detection_cache[ $slug ];
		}
		if ( ! isset( $this->detectors[ $slug ] ) ) {
			return false;
		}
		$method                          = $this->detectors[ $slug ];
		$this->detection_cache[ $slug ]  = (bool) $this->{$method}();
		return $this->detection_cache[ $slug ];
	}

	private function detect_logo_site_title() {
		return has_custom_logo() && 'Sydney' !== get_bloginfo( 'name' ) && '' !== get_bloginfo( 'name' );
	}

	private function detect_global_colors() {
		// Primary swatch (global_color_1) is the canonical "did the user
		// touch their palette" signal. A saved theme mod replaces the
		// sentinel, regardless of the default hex registered in the
		// Customizer.
		return get_theme_mod( 'global_color_1', '__sydney_default__' ) !== '__sydney_default__';
	}

	private function detect_typography() {
		$candidates = array( 'body_font_family', 'headings_font_family', 'body_font_size' );
		foreach ( $candidates as $mod ) {
			if ( get_theme_mod( $mod, '__sydney_default__' ) !== '__sydney_default__' ) {
				return true;
			}
		}
		return false;
	}

	private function detect_header_layout() {
		// HF builder splits header config across per-row theme mods
		// (sydney_header_row__*). Any saved row means the user touched the
		// layout — WP only persists a theme mod when it differs from the
		// registered row default, so the sentinel comparison is enough.
		if ( $this->hf_builder_active() ) {
			return $this->any_row_customized( 'header' );
		}
		return get_theme_mod( 'header_layout_desktop', '__sydney_default__' ) !== '__sydney_default__';
	}

	private function detect_nav_menu() {
		return has_nav_menu( 'primary' );
	}

	private function detect_mobile_layout() {
		return get_theme_mod( 'mobile_header_layout', '__sydney_default__' ) !== '__sydney_default__';
	}

	private function detect_footer_layout() {
		// Mirror detect_header_layout: HF builder spreads footer config across
		// per-row theme mods (sydney_footer_row__*); the legacy footer falls
		// back to the single widget-areas signal.
		if ( $this->hf_builder_active() ) {
			return $this->any_row_customized( 'footer' );
		}
		return get_theme_mod( 'footer_widget_areas', '__sydney_default__' ) !== '__sydney_default__';
	}

	/**
	 * True when any HF builder row in the given area has a saved theme mod
	 * (i.e. the user moved at least one component out of the default layout).
	 *
	 * @param string $area 'header' or 'footer'.
	 * @return bool
	 */
	private function any_row_customized( $area ) {
		$rows = array( 'above_' . $area . '_row', 'main_' . $area . '_row', 'below_' . $area . '_row' );
		$key  = 'sydney_' . $area . '_row__';
		foreach ( $rows as $row ) {
			if ( get_theme_mod( $key . $row, '__sydney_default__' ) !== '__sydney_default__' ) {
				return true;
			}
		}
		return false;
	}

	private function detect_footer_credits() {
		// Sentinel comparison (vs. !empty) so we also catch users who
		// intentionally clear the credits to an empty string — that's a real
		// interaction with the setting.
		return get_theme_mod( 'footer_credits', '__sydney_default__' ) !== '__sydney_default__';
	}

	private function detect_static_front_page() {
		return 'page' === get_option( 'show_on_front' ) && (int) get_option( 'page_on_front' ) > 0;
	}

	private function detect_blog_layout() {
		return get_theme_mod( 'blog_layout', '__sydney_default__' ) !== '__sydney_default__';
	}

	private function detect_single_posts() {
		return get_theme_mod( 'single_post_layout', '__sydney_default__' ) !== '__sydney_default__';
	}

	private function detect_shop_layout() {
		return get_theme_mod( 'swc_archive_layout', '__sydney_default__' ) !== '__sydney_default__';
	}

	private function detect_product_layout() {
		return get_theme_mod( 'swc_single_layout', '__sydney_default__' ) !== '__sydney_default__';
	}

	private function detect_install_merchant() {
		return $this->is_plugin_active( 'merchant/merchant.php' );
	}

	/**
	 * Whether a plugin is active on this site or network-active on multisite.
	 *
	 * Reads the options directly rather than pulling in
	 * wp-admin/includes/plugin.php (which complicates unit testing).
	 * `active_sitewide_plugins` is keyed by plugin path with the activation
	 * timestamp as the value, so we check key presence — not membership.
	 *
	 * @param string $plugin_path e.g. 'merchant/merchant.php'.
	 * @return bool
	 */
	private function is_plugin_active( $plugin_path ) {
		$active = get_option( 'active_plugins', array() );
		if ( is_array( $active ) && in_array( $plugin_path, $active, true ) ) {
			return true;
		}
		if ( function_exists( 'is_multisite' ) && is_multisite() ) {
			$sitewide = get_site_option( 'active_sitewide_plugins', array() );
			if ( is_array( $sitewide ) && isset( $sitewide[ $plugin_path ] ) ) {
				return true;
			}
		}
		return false;
	}

	/**
	 * Testable seam: is the WooCommerce plugin loaded?
	 *
	 * Overridden in unit tests via partial mock.
	 */
	protected function is_woocommerce_active() {
		return class_exists( 'WooCommerce' );
	}

	/**
	 * True when the HF builder module is active.
	 */
	private function hf_builder_active() {
		return class_exists( 'Sydney_Modules' ) && Sydney_Modules::is_module_active( 'hf-builder' );
	}

	/**
	 * Logo & Site Title deep-link. HF builder relocates the site identity
	 * controls (site_logo, blogname, blogdescription, site_icon, etc.) into
	 * `sydney_section_hb_component__logo`, leaving the WP-core `title_tagline`
	 * section effectively empty.
	 */
	private function logo_site_title_url() {
		if ( $this->hf_builder_active() ) {
			return $this->customizer_link( 'sydney_section_hb_component__logo', 'section' );
		}
		return $this->customizer_link( 'title_tagline', 'section' );
	}

	/**
	 * Mobile header deep-link. HF builder removes the legacy
	 * `sydney_section_mobile_header` and replaces it with the offcanvas
	 * drawer section.
	 */
	private function mobile_layout_url() {
		if ( $this->hf_builder_active() ) {
			return $this->customizer_link( 'sydney_section_hb_mobile_offcanvas', 'section' );
		}
		return $this->customizer_link( 'sydney_section_mobile_header', 'section' );
	}

	/**
	 * Header layout deep-link target depends on whether the HF builder module is on.
	 */
	private function header_layout_url() {
		if ( $this->hf_builder_active() ) {
			return $this->customizer_link( 'sydney_section_hb_wrapper', 'section' );
		}
		return $this->customizer_link( 'sydney_section_main_header', 'section' );
	}

	/**
	 * Footer layout deep-link target depends on whether the HF builder module is on.
	 */
	private function footer_layout_url() {
		if ( $this->hf_builder_active() ) {
			return $this->customizer_link( 'sydney_section_fb_wrapper', 'section' );
		}
		return $this->customizer_link( 'sydney_section_footer_widgets', 'section' );
	}

	/**
	 * Footer credits deep-link. HF builder removes the legacy
	 * `sydney_section_footer_credits` section and moves the `footer_credits`
	 * control into its own copyright component.
	 */
	private function footer_credits_url() {
		if ( $this->hf_builder_active() ) {
			return $this->customizer_link( 'sydney_section_fb_component__copyright', 'section' );
		}
		return $this->customizer_link( 'sydney_section_footer_credits', 'section' );
	}

	/**
	 * Whether a slug exists in the current item registry.
	 *
	 * @param string $slug Item slug.
	 * @return bool
	 */
	public function has_item( $slug ) {
		foreach ( $this->items() as $category ) {
			if ( isset( $category['items'][ $slug ] ) ) {
				return true;
			}
		}
		return false;
	}

	/**
	 * Get the manual state map for the current admin user.
	 *
	 * @return array<string,bool>
	 */
	public function get_manual_states() {
		$user_id = get_current_user_id();
		if ( ! $user_id ) {
			return array();
		}
		$state = get_user_meta( $user_id, self::USER_META_KEY, true );
		return is_array( $state ) ? $state : array();
	}

	/**
	 * Get the manual completion state for a single item slug.
	 *
	 * @param string $slug Item slug.
	 * @return bool
	 */
	public function get_manual_state( $slug ) {
		$state = $this->get_manual_states();
		return ! empty( $state[ $slug ] );
	}

	/**
	 * Set the manual completion state for a single item slug.
	 *
	 * @param string $slug     Item slug.
	 * @param bool   $complete Whether to mark the item complete.
	 * @return void
	 */
	public function set_manual_state( $slug, $complete ) {
		// Gate writes on admin capability — non-admins shouldn't reach the dashboard,
		// but this is a defense-in-depth check at the storage boundary.
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}
		// Reject slugs outside the item registry — endpoints validate too, but
		// this is a defense-in-depth check at the storage boundary.
		if ( ! $this->has_item( $slug ) ) {
			return;
		}
		$user_id = get_current_user_id();
		if ( ! $user_id ) {
			return;
		}
		$state = $this->get_manual_states();
		if ( $complete ) {
			$state[ $slug ] = true;
		} else {
			unset( $state[ $slug ] );
		}
		update_user_meta( $user_id, self::USER_META_KEY, $state );
	}

	/**
	 * Unified completion check — auto-detected OR manually marked.
	 *
	 * @param string $slug Item slug.
	 * @return bool
	 */
	public function is_done( $slug ) {
		return $this->is_complete( $slug ) || $this->get_manual_state( $slug );
	}

	/**
	 * Are all currently-applicable items done?
	 *
	 * @return bool
	 */
	public function all_done() {
		foreach ( $this->items() as $category ) {
			foreach ( $category['items'] as $slug => $_item ) {
				if ( ! $this->is_done( $slug ) ) {
					return false;
				}
			}
		}
		return true;
	}

	/**
	 * Whether the Setup tab should be shown to the user.
	 *
	 * Free-only feature: Sydney Pro has its own dashboard onboarding, so the
	 * tab never shows there. Checked first so this file stays identical
	 * between the free and Pro codebases.
	 *
	 * Otherwise gated by the `sydney_setup_checklist_eligible` option, which is
	 * set once via `after_switch_theme` for sites newly activating Sydney from a
	 * non-Sydney theme. Existing sites that update into this feature never
	 * become eligible. The `sydney_dashboard_show_setup_tab` filter overrides
	 * that resolved value either way — pass true to force-show, false to hide.
	 * The Pro check above takes precedence over the filter.
	 *
	 * @return bool
	 */
	public function should_show_tab() {
		if ( defined( 'SYDNEY_PRO_VERSION' ) ) {
			return false;
		}

		if ( ! get_option( 'sydney_setup_checklist_eligible' ) ) {
			return (bool) apply_filters( 'sydney_dashboard_show_setup_tab', false );
		}
		$default = ! $this->all_done();
		return (bool) apply_filters( 'sydney_dashboard_show_setup_tab', $default );
	}

	/**
	 * 1-click homepage setup: ensure a Home + Blog page, wire them to the
	 * static-front-page options, and assign the Sydney Canvas template to
	 * Home. Idempotent.
	 *
	 * @return array{
	 *     ok: bool,
	 *     home_edit_url?: string,
	 *     blog_edit_url?: string,
	 *     is_done?: bool,
	 *     all_done?: bool,
	 *     error?: string
	 * }
	 */
	public function setup_homepage() {
		// Defense-in-depth: callers (REST + AJAX) already gate on
		// `manage_options`, but this method writes posts and site-wide options
		// so it self-checks at the storage boundary too — mirrors
		// `set_manual_state()`.
		if ( ! current_user_can( 'manage_options' ) ) {
			return array(
				'ok'    => false,
				'error' => esc_html__( 'Insufficient permissions.', 'sydney' ),
			);
		}

		$home_id = $this->get_or_create_page( 'home', __( 'Home', 'sydney' ), 'page-templates/page_front-page.php' );
		$blog_id = $this->get_or_create_page( 'blog', __( 'Blog', 'sydney' ), '' );

		if ( ! $home_id || ! $blog_id ) {
			return array(
				'ok'    => false,
				'error' => esc_html__( 'Could not create the homepage / blog pages.', 'sydney' ),
			);
		}

		update_option( 'show_on_front',  'page' );
		update_option( 'page_on_front',  $home_id );
		update_option( 'page_for_posts', $blog_id );

		return array(
			'ok'            => true,
			'home_edit_url' => get_edit_post_link( $home_id, 'raw' ),
			'blog_edit_url' => get_edit_post_link( $blog_id, 'raw' ),
			'is_done'       => $this->is_done( 'static_front_page' ),
			'all_done'      => $this->all_done(),
		);
	}

	/**
	 * Get an existing published page by slug, or create one.
	 *
	 * @param string $slug     Page slug.
	 * @param string $title    Page title (used only when creating).
	 * @param string $template Page template path. Empty for none.
	 * @return int Page ID, or 0 on failure.
	 */
	private function get_or_create_page( $slug, $title, $template ) {
		// `get_page_by_path()` matches on slug regardless of status — a trashed
		// page with the same slug would otherwise get wired into
		// `page_on_front` and 404 for visitors. Only reuse published pages;
		// fall through to create a new one in any other case.
		$existing = get_page_by_path( $slug );
		if ( $existing && 'publish' === $existing->post_status ) {
			if ( '' !== $template ) {
				update_post_meta( $existing->ID, '_wp_page_template', $template );
			}
			return (int) $existing->ID;
		}

		$page_id = wp_insert_post( array(
			'post_title'   => $title,
			'post_name'    => $slug,
			'post_type'    => 'page',
			'post_status'  => 'publish',
			'post_content' => '',
		) );

		if ( is_wp_error( $page_id ) || ! $page_id ) {
			return 0;
		}

		if ( '' !== $template ) {
			update_post_meta( $page_id, '_wp_page_template', $template );
		}
		return (int) $page_id;
	}

	/**
	 * Current status of a plugin by path.
	 *
	 * @param string $plugin_path e.g. 'merchant/merchant.php'.
	 * @return string One of 'not_installed', 'inactive', 'active'.
	 */
	public function get_plugin_status( $plugin_path ) {
		if ( ! defined( 'WP_PLUGIN_DIR' ) || ! file_exists( WP_PLUGIN_DIR . '/' . $plugin_path ) ) {
			return 'not_installed';
		}
		return $this->is_plugin_active( $plugin_path ) ? 'active' : 'inactive';
	}

	/**
	 * Full hydrated state — registry definitions merged with per-item
	 * detection + manual-completion status. Single source of truth for the
	 * template and REST consumers.
	 *
	 * @return array{
	 *     should_show: bool,
	 *     all_done: bool,
	 *     categories: array<string, array{slug: string, label: string, items: array<string, array>}>
	 * }
	 */
	public function get_state() {
		$hydrated_categories = array();

		foreach ( $this->items() as $cat_slug => $category ) {
			$hydrated_items = array();
			$done_count     = 0;
			$total_count    = count( $category['items'] );
			foreach ( $category['items'] as $item_slug => $item ) {
				$hydrated = array_merge(
					array( 'action_type' => 'link' ),
					$item,
					array(
						'slug'    => $item_slug,
						'is_auto' => $this->is_complete( $item_slug ),
						'is_done' => $this->is_done( $item_slug ),
					)
				);
				if ( 'install_plugin' === $hydrated['action_type'] && ! empty( $hydrated['plugin_path'] ) ) {
					$hydrated['plugin_status'] = $this->get_plugin_status( $hydrated['plugin_path'] );
				}
				if ( $hydrated['is_done'] ) {
					$done_count++;
				}
				$hydrated_items[ $item_slug ] = $hydrated;
			}
			$hydrated_categories[ $cat_slug ] = array(
				'slug'        => $cat_slug,
				'label'       => $category['label'],
				'all_done'    => $total_count > 0 && $done_count === $total_count,
				'done_count'  => $done_count,
				'total_count' => $total_count,
				'items'       => $hydrated_items,
			);
		}

		return array(
			'should_show' => $this->should_show_tab(),
			'all_done'    => $this->all_done(),
			'categories'  => $hydrated_categories,
		);
	}

	/**
	 * Flip the "the user actually interacted with the checklist" flag.
	 * Idempotent: only writes the first time.
	 */
	public static function mark_used() {
		if ( ! get_option( self::USED_OPTION ) ) {
			update_option( self::USED_OPTION, 1, false );
		}
	}

	/**
	 * Add checklist engagement signals to the weekly usage snapshot.
	 *
	 * @param array $data Existing snapshot payload.
	 * @return array
	 */
	public static function add_usage_tracking_data( $data ) {
		$data['athemes_sydney_checklist_eligible'] = (int) (bool) get_option( 'sydney_setup_checklist_eligible' );
		$data['athemes_sydney_checklist_used']     = (int) (bool) get_option( self::USED_OPTION );
		return $data;
	}
}

add_filter( 'sydney_usage_tracking_data', array( 'Sydney_Setup_Checklist', 'add_usage_tracking_data' ) );
