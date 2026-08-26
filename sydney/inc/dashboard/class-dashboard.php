<?php
/**
 *
 * Dashboard
 * @package Dashboard
 *
 * PARITY: inc/dashboard/ is kept identical between Sydney (free) and Sydney Pro
 * so the folder can be copied either way. Gate version-specific behaviour at
 * runtime — defined( 'SYDNEY_PRO_VERSION' ) or $settings['has_pro'] — instead of
 * forking a file. Anything added here must be added to the other codebase too.
 *
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Required from here rather than functions.php so the folder stays self-contained.
require_once __DIR__ . '/dashboard-icons.php';

/**
 * Dashboard class.
 */
class Sydney_Dashboard
{

    /**
     * The settings of page.
     *
     * @var array $settings The settings.
     */
    public $settings = array();

    /**
     * Constructor.
     */
    public function __construct()
    {

        if (defined('SYDNEY_AWL_ACTIVE')) {
            return;
        }

        if( ! is_admin() ) {
            return;
        }

        if( $this->is_hero_notice_visible() || $this->is_sydney_dashboard_page() ) {
            add_action('init', array( $this, 'set_settings' ));
            add_action('admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ));
        }

        if( $this->is_sydney_dashboard_page() ) {
            add_filter( 'admin_footer_text', array( $this, 'admin_footer_text' ) );

            if( defined( 'SYDNEY_PRO_VERSION' ) ) {
                add_action( 'admin_footer', 'sydney_templates_display_conditions_script_template' );
            }
        }

        if( $this->is_patcher_page() ) {
            add_action('admin_enqueue_scripts', array( $this, 'enqueue_patcher_scripts' ));
        }

        add_filter('woocommerce_enable_setup_wizard', '__return_false');

        add_action('admin_menu', array( $this, 'add_menu_page' ));
        add_action('admin_head', array( $this, 'admin_menu_icon_style' ));
        add_action('load-toplevel_page_sydney-dashboard', array( $this, 'redirect_to_canonical_page' ));
        add_action('admin_footer', array( $this, 'add_admin_footer_internal_scripts' ));
        add_action('admin_notices', array( $this, 'html_notice' ));
        
        add_action('wp_ajax_sydney_notifications_read', array( $this, 'ajax_notifications_read' ));

        add_action('wp_ajax_sydney_plugin', array( $this, 'ajax_plugin' ));
        add_action('wp_ajax_sydney_dismissed_handler', array( $this, 'ajax_dismissed_handler' ));

        add_action( 'wp_ajax_sydney_option_switcher_handler', array( $this, 'ajax_option_switcher_handler' ) );

        add_action( 'wp_ajax_sydney_abilities_mode', array( $this, 'ajax_abilities_mode' ) );

        add_action( 'wp_ajax_sydney_module_activation_handler', array( $this, 'ajax_module_activation_handler' ) );
        add_action( 'wp_ajax_sydney_module_activation_all_handler', array( $this, 'ajax_module_activation_all_handler' ) );
        add_action( 'wp_ajax_sydney_setup_checklist_toggle',    array( $this, 'ajax_setup_checklist_toggle' ) );
        add_action( 'wp_ajax_sydney_setup_homepage',            array( $this, 'ajax_setup_homepage' ) );
        add_action( 'wp_ajax_sydney_setup_checklist_mark_used', array( $this, 'ajax_setup_checklist_mark_used' ) );
        add_action( 'wp_ajax_sydney_template_builder_data', array( $this, 'ajax_template_builder_data' ) );
        add_action( 'wp_ajax_insert_template_part_callback', array( $this, 'insert_template_part_callback' ) );
        add_action( 'wp_ajax_edit_template_part_callback', array( $this, 'edit_template_part_callback' ) );

        add_action('switch_theme', array( $this, 'reset_notices' ));
        add_action('after_switch_theme', array( $this, 'reset_notices' ));

        add_action( 'admin_head', array( $this, 'template_part_canvas_styles' ) );
    }

    /**
     * Strip the admin chrome off a template part opened in the builder's iframe.
     *
     * The block editor has no standalone screen like Elementor's, so the part is
     * loaded from post.php and the chrome is hidden here. Core already sets
     * body.is-fullscreen-mode in edit-form-blocks.php, but the editor removes it
     * again for users whose fullscreen preference is off, and its own rules only
     * apply above 782px - measured against the iframe, not the window. These
     * rules key off neither, so the preference and the iframe width cannot
     * bring the chrome back.
     */
    public function template_part_canvas_styles() {

        if ( ! isset( $_GET['sydney-canvas'] ) || '1' !== $_GET['sydney-canvas'] ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
            return;
        }

        if ( 'athemes_hf' !== get_post_type() ) {
            return;
        }

        echo '<style id="sydney-template-part-canvas">
            #adminmenumain, #wpadminbar, #wpfooter { display: none !important; }
            #wpcontent, #wpbody-content { margin-left: 0 !important; padding-left: 0 !important; }
            html.wp-toolbar { padding-top: 0 !important; }
            /* Would navigate the iframe to the post list, with no way back. */
            .edit-post-fullscreen-mode-close, .editor-document-tools__back { display: none !important; }
        </style>';
    }

    /**
     * The admin URL that opens a template part for editing.
     *
     * @param int    $post_id Template part id.
     * @param string $action  post.php action: elementor or edit.
     * @return string
     */
    public function template_part_edit_url( $post_id, $action ) {

        $url = get_admin_url() . 'post.php?post=' . absint( $post_id ) . '&action=' . $action;

        //Elementor's editor is already chrome-free; the block editor is not.
        if ( 'elementor' !== $action ) {
            $url = add_query_arg( 'sydney-canvas', '1', $url );
        }

        return $url;
    }

    /**
     * Check if is the themes.php page
     * 
     */
    public function is_themes_page() {
        global $pagenow;
        return $pagenow === 'themes.php';
    }

    /**
     * Check if the themes.php hero notice can still be rendered.
     *
     * Conservative pre-check for html_notice(), which is the authority: this
     * runs from the constructor, before get_current_screen() is available, so
     * it approximates the themes list screen with the absence of ?page=.
     * A false return guarantees no notice, so it is safe to skip the assets.
     * Excludes Appearance sub-pages and sites where the notice was dismissed.
     */
    public function is_hero_notice_visible() {
        // phpcs:ignore WordPress.Security.NonceVerification.Recommended
        if ( ! $this->is_themes_page() || isset( $_GET['page'] ) ) {
            return false;
        }

        return ! get_transient( sprintf( '%s_hero_notice', get_template() ) );
    }

    /**
     * Check if is the theme dashboard page
     * 
     */
    public function is_sydney_dashboard_page() {
        global $pagenow;
        // phpcs:ignore WordPress.Security.NonceVerification.Recommended
        return $pagenow === 'admin.php' && ( isset( $_GET[ 'page' ] ) && $_GET[ 'page' ] === 'sydney-dashboard' );
    }

    /**
     * Send the dashboard back to admin.php when it is reached from another admin file.
     *
     * add_menu_page() registers the page under admin.php, but core dispatches a
     * top-level plugin page from whichever admin file carries ?page= (see the
     * get_plugin_page_hook( $plugin_page, $plugin_page ) fallback in
     * wp-admin/admin.php), so themes.php?page=sydney-dashboard renders it too -
     * with no settings, no assets and no admin page title. Everything that
     * decides whether to boot the dashboard keys off admin.php, so bounce those
     * requests instead of teaching each check about the other entry points.
     * This hook runs before admin-header.php, so the redirect is still safe.
     */
    public function redirect_to_canonical_page() {
        global $pagenow;

        if ( $pagenow === 'admin.php' ) {
            return;
        }

        // phpcs:ignore WordPress.Security.NonceVerification.Recommended
        $query_args = ! empty( $_GET ) ? map_deep( wp_unslash( $_GET ), 'sanitize_text_field' ) : array( 'page' => 'sydney-dashboard' );

        wp_safe_redirect( admin_url( 'admin.php?' . http_build_query( $query_args ) ) );
        exit;
    }

    /**
     * Is aThemes Patcher page.
     * 
     */
    public function is_patcher_page() {
        global $pagenow;
        // phpcs:ignore WordPress.Security.NonceVerification.Recommended
        return $pagenow === 'admin.php' && ( isset( $_GET[ 'page' ] ) && $_GET[ 'page' ] === 'athemes-patcher-preview-sp' );
    }

    /**
     * Settings
     *
     * @param array $settings The settings.
     */
    public function set_settings()
    {
        $this->settings = apply_filters('sydney_dashboard_settings', array());
    }

    /**
     * Add menu page
     */
    public function add_menu_page()
    {
        // Add main 'Sydney' page
        add_menu_page( // phpcs:ignore WPThemeReview.PluginTerritory.NoAddAdminPages.add_menu_pages_add_menu_page
            esc_html__('Sydney', 'sydney'), 
            esc_html__('Sydney', 'sydney'), 
            'manage_options', 
            isset( $this->settings['menu_slug'] ) ? $this->settings['menu_slug'] : 'sydney-dashboard', 
            array( $this, 'html_dashboard' ),
            'none',
            58.9
        );

        // Add 'Theme Dashboard' page
        add_submenu_page( // phpcs:ignore WPThemeReview.PluginTerritory.NoAddAdminPages.add_menu_pages_add_submenu_page
            'sydney-dashboard',
            esc_html__('Theme Dashboard', 'sydney'),
            esc_html__('Theme Dashboard', 'sydney'),
            'manage_options',
            get_admin_url() . 'admin.php?page=sydney-dashboard',
            '',
            0
        );

        // Add 'Customize' link
        $customize_url = add_query_arg( 'return', rawurlencode( remove_query_arg( wp_removable_query_args(), isset( $_SERVER['REQUEST_URI'] ) ? esc_url_raw( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '' ) ), 'customize.php' );
        add_submenu_page( // phpcs:ignore WPThemeReview.PluginTerritory.NoAddAdminPages.add_menu_pages_add_submenu_page
            'sydney-dashboard',
            esc_html__('Customize', 'sydney'),
            esc_html__('Customize', 'sydney'),
            'manage_options',
            esc_url( $customize_url ),
            '',
            1
        );

        // Add 'Starter Sites' link
        add_submenu_page( // phpcs:ignore WPThemeReview.PluginTerritory.NoAddAdminPages.add_menu_pages_add_submenu_page
            'sydney-dashboard',
            esc_html__('Starter Sites', 'sydney'),
            esc_html__('Starter Sites', 'sydney'),
            'manage_options',
            get_admin_url() . 'admin.php?page=sydney-dashboard&tab=starter-sites',
            '',
            2
        );

        // Add 'Template Builder' link, only when the dashboard renders that tab.
        // $this->settings is empty away from the dashboard page, so ask directly
        if ( sydney_dashboard_has_builder_tab() ) {
            add_submenu_page( // phpcs:ignore WPThemeReview.PluginTerritory.NoAddAdminPages.add_menu_pages_add_submenu_page
                'sydney-dashboard',
                esc_html__('Template Builder', 'sydney'),
                esc_html__('Template Builder', 'sydney'),
                'manage_options',
                get_admin_url() . 'admin.php?page=sydney-dashboard&tab=builder',
                '',
                3
            );
        }

        // Add 'aThemes Patcher' link. Position 5 clears the athemes_hf submenu the
        // CPT appends, so 'Template Parts' stays next to 'Template Builder'
        if ( !defined( 'ATHEMES_PATCHER_VERSION' ) ) {
            add_submenu_page( // phpcs:ignore WPThemeReview.PluginTerritory.NoAddAdminPages.add_menu_pages_add_submenu_page
                'sydney-dashboard',
                esc_html__('Patcher', 'sydney'),
                esc_html__('Patcher', 'sydney'),
                'manage_options',
                'athemes-patcher-preview-sp',
                array( $this, 'html_patcher' ),
                5
            );
        }

        // Add 'Upgrade' link
        if( !defined( 'SYDNEY_PRO_VERSION' ) ) {
            add_submenu_page( // phpcs:ignore WPThemeReview.PluginTerritory.NoAddAdminPages.add_menu_pages_add_submenu_page
                'sydney-dashboard',
                esc_html__('Upgrade to Pro', 'sydney'),
                esc_html__('Upgrade to Pro', 'sydney'),
                'manage_options',
                'https://athemes.com/sydney-upgrade?utm_source=theme_submenu_page&utm_medium=button&utm_campaign=Sydney',
                '',
                6
            );
        }
    }

	/**
	 * Paint the top-level menu logo on div.wp-menu-image.
	 *
	 * add_menu_page() above passes 'none' as the icon URL, which is core's
	 * documented opt-out (see wp-admin/menu-header.php): it renders
	 * div.wp-menu-image with no <img> inside, expressly so an icon can be
	 * attached with CSS. That matters because core dims any <img> in there to
	 * opacity .6 and pins it with padding-top 9px, which is what made the
	 * Sydney logo render grey, 16px wide and low against the 20px dashicon
	 * grid of its neighbours.
	 *
	 * The icon is painted as a mask over background-color: currentColor on the
	 * ::before pseudo-element, because every admin color scheme styles its
	 * menu icons through the `color` of `#adminmenu div.wp-menu-image:before`
	 * (idle, hover and current states alike, see wp-admin/css/admin-menu.css
	 * and the per-scheme wp-admin/css/colors/<scheme>/colors.css). Inheriting
	 * that color gives the logo exact dashicon parity in all schemes,
	 * including the Light scheme where a hardcoded white glyph would be
	 * invisible. The ::before box also comes from core for free: 'none' leaves
	 * the dashicons-before class on the div, so the pseudo-element is already
	 * a centered 20px box on the dashicon grid (narrowed to 15px wide here to
	 * match the logo's native proportions).
	 *
	 * The SVG is inlined as a percent-encoded data URI rather than a file URL
	 * (saves a request and survives odd static-serving setups) and rather than
	 * base64 (base64_encode() and base64 payloads trip wordpress.org's
	 * automated theme checks). Fully percent-encoded, the literal contains no
	 * quotes or angle brackets, so esc_attr() passes it through untouched.
	 * Keep it in sync with inc/dashboard/assets/images/logo.svg if the logo
	 * ever changes; the fill color inside the SVG is irrelevant (masks only
	 * use the alpha channel).
	 *
	 * Printed on admin_head for every admin screen, because the menu is global
	 * and the dashboard stylesheet is only enqueued on themes.php and the
	 * Sydney dashboard page.
	 *
	 * @return void
	 */
	public function admin_menu_icon_style() {
		$menu_slug = isset( $this->settings['menu_slug'] ) ? $this->settings['menu_slug'] : 'sydney-dashboard';

		// Percent-encoded copy of inc/dashboard/assets/images/logo.svg.
		$icon = 'data:image/svg+xml,%3Csvg%20width=%2216%22%20height=%2217%22%20viewBox=%220%200%2016%2017%22%20fill=%22none%22%20xmlns=%22http://www.w3.org/2000/svg%22%3E%20%3Cg%20clip-path=%22url%28%23clip0_1310_2%29%22%3E%20%3Cpath%20d=%22M8.26333%200H16V8.5562L8.26333%200ZM0.0752351%205.02131H0C0%203.3059%200.468129%202.04016%201.40439%201.2241C2.34065%200.408033%203.78265%200%205.73043%200L16%2012.4159C16%2014.0647%2015.5528%2015.243%2014.6583%2015.9508C13.7889%2016.6419%2012.3678%2016.9875%2010.395%2016.9875L0.0752351%205.02131ZM0.0376175%208.39383L7.48588%2017H0.0376175V8.39383Z%22%20fill=%22white%22/%3E%20%3C/g%3E%20%3Cdefs%3E%20%3CclipPath%20id=%22clip0_1310_2%22%3E%20%3Crect%20width=%2216%22%20height=%2217%22%20fill=%22white%22/%3E%20%3C/clipPath%3E%20%3C/defs%3E%20%3C/svg%3E';
		?>
		<style id="sydney-admin-menu-icon">
			#adminmenu .toplevel_page_<?php echo esc_attr( $menu_slug ); ?> div.wp-menu-image::before {
				content: "";
				width: 15px;
				background-color: currentColor;
				-webkit-mask-image: url("<?php echo esc_attr( $icon ); ?>");
				mask-image: url("<?php echo esc_attr( $icon ); ?>");
				-webkit-mask-repeat: no-repeat;
				mask-repeat: no-repeat;
				-webkit-mask-position: center;
				mask-position: center;
				-webkit-mask-size: contain;
				mask-size: contain;
			}
			@media (forced-colors: active) {
				#adminmenu .toplevel_page_<?php echo esc_attr( $menu_slug ); ?> div.wp-menu-image::before {
					background-color: CanvasText;
				}
			}
		</style>
		<?php
	}

    /**
     * Admin footer style.
     * 
     * @return void
     */
    public function add_admin_footer_internal_scripts() {
        ?>
        <style>
            #adminmenu .toplevel_page_sydney-dashboard .wp-submenu a[href="admin.php?page=sydney-dashboard"] {
                display: none;
            }
            #adminmenu .toplevel_page_sydney-dashboard .wp-submenu a[href="https://athemes.com/sydney-upgrade?utm_source=theme_submenu_page&utm_medium=button&utm_campaign=Sydney"] {
                color: #05d105;
            }
        </style>
        <script type="text/javascript">
            document.addEventListener("DOMContentLoaded", function() {
                const sydneyUpsellMenuItem = document.querySelector( '#adminmenu .toplevel_page_sydney-dashboard .wp-submenu a[href="https://athemes.com/sydney-upgrade?utm_source=theme_submenu_page&utm_medium=button&utm_campaign=Sydney"]' );

                if ( ! sydneyUpsellMenuItem ) {
                    return;
                }

                sydneyUpsellMenuItem.addEventListener( 'click', function( e ){
                    e.preventDefault();

                    const href = this.getAttribute( 'href' );
                    window.open( href, '_blank' );
                } );
            });
        </script>
        <?php
    }

    /**
     * This function will register scripts and styles for admin dashboard.
     *
     * @param string $page Current page.
     */
    public function admin_enqueue_scripts($hook)
    {

        wp_enqueue_style('sydney-dashboard', get_template_directory_uri() . '/inc/dashboard/assets/css/sydney-dashboard.min.css', array(), '20260828.13');

        if (is_rtl()) {
            wp_enqueue_style('sydney-dashboard-rtl', get_template_directory_uri() . '/inc/dashboard/assets/css/sydney-dashboard-rtl.min.css', array(), '20260610');
        }

        wp_enqueue_script('sydney-dashboard', get_template_directory_uri() . '/inc/dashboard/assets/js/sydney-dashboard.min.js', array( 'jquery', 'wp-util', 'jquery-ui-sortable' ), '20260828.6', true);

        // Only the display conditions modal uses select2, and that lives in the
        // template builder - no need to ship it alongside the themes.php notice.
        if ( $this->is_sydney_dashboard_page() ) {
            wp_enqueue_script( 'sydney-select2-js', get_template_directory_uri() . '/inc/customizer/controls/typography/select2.full.min.js', array( 'jquery' ), '4.0.13', true );
            wp_enqueue_style( 'sydney-select2-css', get_template_directory_uri() . '/inc/customizer/controls/typography/select2.min.css', array(), '4.0.13', 'all' );
        }

        wp_localize_script('sydney-dashboard', 'sydney_dashboard', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce( 'nonce-bt-dashboard' ),
            'i18n' => array(
                'activate' => esc_html__('Activate', 'sydney'),
                'deactivate' => esc_html__('Deactivate', 'sydney'),
                'installing' => esc_html__('Installing...', 'sydney'),
                'activating' => esc_html__('Activating...', 'sydney'),
                'deactivating' => esc_html__('Deactivating...', 'sydney'),
                'loading' => esc_html__('Loading...', 'sydney'),
                'saving' => esc_html__('Saving...', 'sydney'),
                'saved' => esc_html__('Changes Saved!', 'sydney'),
                'unsaved_changes' => esc_html__('You have unsaved changes.', 'sydney'),
                'unsaved_editor_changes' => esc_html__('You have unsaved changes. Close the editor anyway?', 'sydney'),
                'save' => esc_html__('Save Changes', 'sydney'),
                'redirecting' => esc_html__('Redirecting...', 'sydney'),
                'activated' => esc_html__('Activated', 'sydney'),
                'deactivated' => esc_html__('Deactivated', 'sydney'),
                'failed_message' => esc_html__('Something went wrong, contact support.', 'sydney'),
                'error' => esc_html__('Error', 'sydney'),
                'mark_complete' => esc_html__('Mark complete', 'sydney'),
                'mark_incomplete' => esc_html__('Mark incomplete', 'sydney'),
                'edit_homepage' => esc_html__('Edit homepage', 'sydney'),
                'applies_label' => esc_html__('Applies to:', 'sydney'),
                /* translators: shown without the "Applies to:" label, so it reads as a sentence on its own. */
                'applies_global' => esc_html__('All pages, unless another template matches.', 'sydney'),
                'applies_none' => esc_html__('no conditions set', 'sydney'),
                /* translators: %s: comma separated list of excluded conditions. */
                'applies_except' => esc_html__('except %s', 'sydney'),
                'confirm_discard_title' => esc_html__('Discard unsaved changes?', 'sydney'),
                'confirm_discard_message' => esc_html__('All unsaved changes across every template will be lost and the builder will reload with your last saved setup.', 'sydney'),
                'confirm_discard_button' => esc_html__('Discard changes', 'sydney'),
                'confirm_delete_title' => esc_html__('Delete this template?', 'sydney'),
                'confirm_delete_message' => esc_html__('This template and all of its part assignments will be removed from the builder. The change becomes permanent when you save.', 'sydney'),
                'confirm_delete_button' => esc_html__('Delete template', 'sydney'),
            ),
        ));
    }

    /**
     * Enqueue aThemes Patcher preview scripts and styles.
     * 
     */
    public function enqueue_patcher_scripts() {
        wp_enqueue_style( 'wp-components' );

        // The patcher page reuses the dashboard's link and tooltip components, so
        // it loads the dashboard sheet rather than inlining copies of those rules.
        wp_enqueue_style('sydney-dashboard', get_template_directory_uri() . '/inc/dashboard/assets/css/sydney-dashboard.min.css', array(), '20260828.13');
    }

    /**
     * Get plugin status.
     *
     * @param string $plugin_path Plugin path.
     */
    public function get_plugin_status($plugin_path)
    {

        if (!current_user_can('install_plugins')) {
            return;
        }

        if (!function_exists('is_plugin_active_for_network')) {
            require_once ABSPATH . 'wp-admin/includes/plugin.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
        }

        if (!file_exists(WP_PLUGIN_DIR . '/' . $plugin_path)) {
            return 'not_installed';
        } elseif (in_array($plugin_path, (array) get_option('active_plugins', array()), true) || is_plugin_active_for_network($plugin_path)) {
            return 'active';
        } else {
            return 'inactive';
        }
    }

    /**
     * Get plugin data.
     *
     * @param string $plugin_path Plugin path.
     */
    public function get_plugin_data($plugin_path)
    {

        if (!current_user_can('install_plugins')) {
            return;
        }

        if (!function_exists('get_plugin_data')) {
            require_once ABSPATH . 'wp-admin/includes/plugin.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
        }

        return get_plugin_data(WP_PLUGIN_DIR . '/' . $plugin_path);
    }

    /**
     * Install a plugin.
     *
     * @param string $plugin_slug Plugin slug.
     */
    public function install_plugin($plugin_slug)
    {

        if (!current_user_can('install_plugins')) {
            return;
        }

        if (!function_exists('plugins_api')) {
            require_once ABSPATH . 'wp-admin/includes/plugin-install.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
        }
        if (!class_exists('WP_Upgrader')) {
            require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
        }

        if (false === filter_var($plugin_slug, FILTER_VALIDATE_URL)) {
            $api = plugins_api(
                'plugin_information',
                array(
                    'slug' => $plugin_slug,
                    'fields' => array(
                        'short_description' => false,
                        'sections' => false,
                        'requires' => false,
                        'rating' => false,
                        'ratings' => false,
                        'downloaded' => false,
                        'last_updated' => false,
                        'added' => false,
                        'tags' => false,
                        'compatibility' => false,
                        'homepage' => false,
                        'donate_link' => false,
                    ),
                )
            );

            $download_link = $api->download_link;
        } else {
            $download_link = $plugin_slug;
        }

        // Use AJAX upgrader skin instead of plugin installer skin.
        // ref: function wp_ajax_install_plugin().
        $upgrader = new Plugin_Upgrader(new WP_Ajax_Upgrader_Skin());

        $install = $upgrader->install($download_link);

        if (false === $install) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Refresh the in-memory plugin caches before activating a plugin.
     *
     * activate_plugin() -> validate_plugin() -> get_plugins() can read a stale
     * plugin list on warm PHP workers (or one primed earlier in the same
     * request) and fail with a bogus "no_plugin_header" WP_Error for a plugin
     * that was just written to disk. Clearing the filesystem stat cache and the
     * cached plugin list forces a fresh read.
     */
    private function refresh_plugins_cache()
    {

        clearstatcache();

        if (!function_exists('wp_clean_plugins_cache')) {
            require_once ABSPATH . 'wp-admin/includes/plugin.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
        }

        wp_clean_plugins_cache(false);
    }

    /**
     * Activate a plugin.
     *
     * @param string $plugin_path Plugin path.
     * @return true|WP_Error True on success, the WP_Error from core on failure.
     */
    public function activate_plugin($plugin_path)
    {

        if (!current_user_can('install_plugins')) {
            return false;
        }

        if (!function_exists('activate_plugin')) {
            require_once ABSPATH . 'wp-admin/includes/plugin.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
        }

        $activate = activate_plugin($plugin_path, '', false, true);

        if (is_wp_error($activate)) {
            return $activate;
        } else {
            return true;
        }
    }

    /**
     * Deactivate a plugin.
     *
     * @param string $plugin_path Plugin path.
     */
    public function deactivate_plugin($plugin_path)
    {

        if (!current_user_can('install_plugins')) {
            return false;
        }

        if (!function_exists('deactivate_plugins')) {
            require_once ABSPATH . 'wp-admin/includes/plugin.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
        }

        $deactivate = deactivate_plugins($plugin_path);

        if (is_wp_error($deactivate)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Ajax notifications.
     */
    public function ajax_notifications_read() {
        check_ajax_referer( 'nonce-bt-dashboard', 'nonce' );

        $latest_notification_date = ( isset( $_POST[ 'latest_notification_date' ] ) ) ? sanitize_text_field( wp_unslash( $_POST[ 'latest_notification_date' ] ) ) : false;
        update_user_meta( get_current_user_id(), 'sydney_dashboard_notifications_latest_read', $latest_notification_date );

        wp_send_json_success();
    }

    /**
     * Admin Footer Text
     */
    public function admin_footer_text() {
        $text = sprintf(
			/* translators: %s: https://wordpress.org/ */
			__( 'Thank you for creating your website with <a href="%s" class="sydney-dashboard-footer-link" target="_blank">Sydney</a>.', 'sydney' ),
			'https://athemes.com/theme/sydney/'
		);

        return $text;
    }

    /**
     * Check if the latest notification is read
     */
    public function latest_notification_is_read() {
        if( ! isset( $this->settings[ 'notifications' ] ) || empty( $this->settings[ 'notifications' ] ) ) {
            return false;
        }
        
        $user_id                     = get_current_user_id();
        $user_read_meta              = get_user_meta( $user_id, 'sydney_dashboard_notifications_latest_read', true );

        $last_notification_date      = strtotime( is_string( $this->settings[ 'notifications' ][0]->post_date ) ? $this->settings[ 'notifications' ][0]->post_date : '' );
        $last_notification_date_ondb = $user_read_meta ? strtotime( $user_read_meta ) : false;

        if( ! $last_notification_date_ondb ) {
            return false;
        }

        if( $last_notification_date > $last_notification_date_ondb ) {
            return false;
        }

        return true;
    }

    /**
     * Ajax plugin.
     */
    public function ajax_plugin() {
        check_ajax_referer( 'nonce-bt-dashboard', 'nonce' );

        $plugin_type = (isset($_POST['type'])) ? sanitize_text_field(wp_unslash($_POST['type'])) : '';
        $plugin_slug = (isset($_POST['slug'])) ? sanitize_text_field(wp_unslash($_POST['slug'])) : '';
        $plugin_path = (isset($_POST['path'])) ? sanitize_text_field(wp_unslash($_POST['path'])) : '';

        if ( ! current_user_can('install_plugins') || empty($plugin_slug) || empty($plugin_type) ) {
            wp_send_json_error( esc_html__( 'Insufficient permissions to install the plugin.', 'sydney' ) );
        }

        if ($plugin_type === 'install' || $plugin_type === 'activate') {

            $activate = null;

            if ('not_installed' === $this->get_plugin_status($plugin_path)) {

                $this->install_plugin($plugin_slug);
                $this->refresh_plugins_cache();
                $activate = $this->activate_plugin($plugin_path);

            } elseif ('inactive' === $this->get_plugin_status($plugin_path)) {

                $this->refresh_plugins_cache();
                $activate = $this->activate_plugin($plugin_path);

            }

            if (is_wp_error($activate)) {
                wp_send_json_error(
                    sprintf(
                        /* translators: %s: plugin activation error message. */
                        esc_html__('Plugin activation failed: %s', 'sydney'),
                        esc_html($activate->get_error_message())
                    )
                );
            }

            if ('active' === $this->get_plugin_status($plugin_path)) {
                wp_send_json_success();
            }

        } elseif ($plugin_type === 'deactivate') {

            $this->deactivate_plugin($plugin_path);

            if ('inactive' === $this->get_plugin_status($plugin_path)) {
                wp_send_json_success();
            }

        }

        wp_send_json_error(esc_html__('Failed to initialize or activate importer plugin.', 'sydney'));
    }

    /**
     * Dismissed handler
     */
    public function ajax_dismissed_handler() {
        check_ajax_referer( 'nonce-bt-dashboard', 'nonce' );

        if (isset($_POST['notice'])) {
            set_transient(sanitize_text_field(wp_unslash($_POST['notice'])), true, 0);
            wp_send_json_success();
        }

        wp_send_json_error();
    }

    /**
     * Ajax option switcher handler.
     * Handles the usage tracking toggle and other option switches.
     */
    public function ajax_option_switcher_handler() {
        check_ajax_referer( 'nonce-bt-dashboard', 'nonce' );

        if ( ! current_user_can( 'manage_options' ) ) {
            wp_send_json_error();
        }

        $option_id = ( isset( $_POST['optionId'] ) ) ? sanitize_text_field( wp_unslash( $_POST['optionId'] ) ) : '';
        $activate  = ( isset( $_POST['activate'] ) ) ? sanitize_text_field( wp_unslash( $_POST['activate'] ) ) : '';

        // Convert string to integer (1 or 0).
        $activate = ( $activate === 'true' ) ? 1 : 0;

        // Only options this endpoint is meant to toggle; a generic
        // update_option( $option_id, ... ) would let any nonce-holding admin
        // session flip arbitrary boolean options (e.g. the abilities write
        // gate) outside their dedicated handlers.
        $allowed_options = array(
            'sydney-usage-tracking-enabled',
        );

        if ( ! in_array( $option_id, $allowed_options, true ) ) {
            wp_send_json_error();
        }

        update_option( $option_id, $activate );

        wp_send_json_success();
    }

    /**
     * Set the AI Abilities mode from the Settings radio.
     *
     * Maps a single 3-way choice to the two gating options so the radio stays a
     * single atomic control:
     *   off   -> enabled 0, allow-writes 0
     *   read  -> enabled 1, allow-writes 0
     *   write -> enabled 1, allow-writes 1
     */
    public function ajax_abilities_mode() {
        check_ajax_referer( 'nonce-bt-dashboard', 'nonce' );

        if ( ! current_user_can( 'manage_options' ) ) {
            wp_send_json_error();
        }

        $mode = ( isset( $_POST['mode'] ) ) ? sanitize_text_field( wp_unslash( $_POST['mode'] ) ) : '';

        if ( ! in_array( $mode, array( 'off', 'read', 'write' ), true ) ) {
            wp_send_json_error();
        }

        update_option( 'sydney-abilities-enabled', ( 'off' === $mode ) ? 0 : 1 );
        update_option( 'sydney-abilities-allow-writes', ( 'write' === $mode ) ? 1 : 0 );

        wp_send_json_success();
    }

    /**
     * Purified from the database information about notification.
     */
    public function reset_notices() {
        delete_transient(sprintf('%s_hero_notice', get_template()));
    }

    /**
     * Activate/Deactivate Module Ajax
     */
    public function ajax_module_activation_handler() {
        check_ajax_referer( 'nonce-bt-dashboard', 'nonce' );

        if( ! current_user_can( 'manage_options' ) ) {
            wp_send_json_error();
        }

        $module   = ( isset( $_POST[ 'module' ] ) ) ? sanitize_text_field( wp_unslash( $_POST['module'] ) ) : '';
        $activate = ( isset( $_POST[ 'activate' ] ) ) ? sanitize_text_field( wp_unslash( $_POST['activate'] ) ) : '';

        // Convert string to boolean
        $activate = ( $activate === 'true' ) ? true : false;

        if ( empty( $module ) ) {
            wp_send_json_error();
        }

        $modules = get_option( 'sydney-modules', array() );
        $modules[ $module ] = $activate;

        update_option( 'sydney-modules', $modules );

        wp_send_json_success();
    }

    /**
     * Activate/Deactivate All Modules Ajax
     */
    public function ajax_module_activation_all_handler() {
        check_ajax_referer( 'nonce-bt-dashboard', 'nonce' );

        if( ! current_user_can( 'manage_options' ) ) {
            wp_send_json_error();
        }

        $activate = ( isset( $_POST[ 'activate' ] ) ) ? sanitize_text_field( wp_unslash( $_POST['activate'] ) ) : '';

        // Convert string to boolean
        $activate = ( $activate === 'true' ) ? true : false;

        // Get a list with all modules id's
        $all_modules_ids = sydney_get_modules_ids();

        // Get current modules active/disabled list
        $current_modules = get_option( 'sydney-modules', array() );

        $modules = array();
        foreach( $all_modules_ids as $module_id ) {

            // Skip some modules
            if( in_array( $module_id, array( 'hf-builder', 'schema-markup', 'adobe-typekit' ), true ) ) {
                $modules[ $module_id ] = $current_modules[ $module_id ];
            } else {
                $modules[ $module_id ] = $activate;
            }

        }

        // Update modules option
        update_option( 'sydney-modules', $modules );

        wp_send_json_success();
    }

    /**
     * Manually mark a checklist item complete / incomplete.
     */
    public function ajax_setup_checklist_toggle() {
        check_ajax_referer( 'nonce-bt-dashboard', 'nonce' );

        if ( ! current_user_can( 'manage_options' ) ) {
            wp_send_json_error();
        }

        $slug     = isset( $_POST['slug'] )     ? sanitize_key( wp_unslash( $_POST['slug'] ) )     : '';
        $complete = isset( $_POST['complete'] ) ? sanitize_text_field( wp_unslash( $_POST['complete'] ) ) : '';
        $complete = ( 'true' === $complete );

        $checklist = Sydney_Setup_Checklist::instance();

        if ( ! $checklist->has_item( $slug ) ) {
            wp_send_json_error();
        }

        $checklist->set_manual_state( $slug, $complete );

        // Only count "mark complete" as engagement — clearing a checkbox doesn't
        // signal the user is using the checklist for its intended purpose.
        if ( $complete ) {
            Sydney_Setup_Checklist::mark_used();
        }

        wp_send_json_success( array(
            'slug'     => $slug,
            'is_done'  => $checklist->is_done( $slug ),
            'all_done' => $checklist->all_done(),
        ) );
    }

    /**
     * 1-click homepage setup. Delegates to Sydney_Setup_Checklist::setup_homepage().
     */
    public function ajax_setup_homepage() {
        check_ajax_referer( 'nonce-bt-dashboard', 'nonce' );

        if ( ! current_user_can( 'manage_options' ) ) {
            wp_send_json_error();
        }

        $result = Sydney_Setup_Checklist::instance()->setup_homepage();

        if ( empty( $result['ok'] ) ) {
            wp_send_json_error( isset( $result['error'] ) ? $result['error'] : '' );
        }

        Sydney_Setup_Checklist::mark_used();

        unset( $result['ok'] );
        wp_send_json_success( $result );
    }

    /**
     * Lightweight ping endpoint for JS-only checklist engagement events
     * (help-video open, action-button click, Merchant install via the
     * checklist row). Server-side flows call `mark_used()` directly.
     */
    public function ajax_setup_checklist_mark_used() {
        check_ajax_referer( 'nonce-bt-dashboard', 'nonce' );

        if ( ! current_user_can( 'manage_options' ) ) {
            wp_send_json_error();
        }

        Sydney_Setup_Checklist::mark_used();
        wp_send_json_success();
    }

    /**
     * Templates builder
     */
    function ajax_template_builder_data() {
        check_ajax_referer('nonce-bt-dashboard', 'nonce');

        if( ! current_user_can( 'manage_options' ) ) {
            wp_send_json_error();
        }
    
        $data = isset( $_POST['data'] ) ? $_POST['data'] : array(); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized

        $data = stripslashes_deep( $data );

        //Header options live on the part, not in the option below, so they are
        //written from the same request but kept out of the stored rows.
        $this->save_header_options( $data );

        $data = $this->sanitize_template_builder_data( $data );

        update_option('sydney_template_builder_data', $data);

        wp_send_json_success($data);
    }

    /**
     * Persist the Header Options each posted row carries for its header part.
     *
     * Rows with no header assigned have nothing to write to. Two rows pointing
     * at the same part write the same keys, so the later row wins - the builder
     * keeps every card holding that part in step, so they agree by the time
     * they are posted.
     *
     * @param mixed $data Raw rows from the request.
     * @return void
     */
    private function save_header_options( $data ) {

        if ( ! is_array( $data ) ) {
            return;
        }

        foreach ( $data as $row ) {

            if ( ! is_array( $row ) ) {
                continue;
            }

            $part_id = $this->sanitize_template_part_id( isset( $row['header'] ) ? $row['header'] : '' );

            if ( ! $part_id ) {
                continue;
            }

            sydney_set_header_options(
                $part_id,
                array(
                    'sticky'      => isset( $row['header_sticky'] ) ? $row['header_sticky'] : 0,
                    'transparent' => isset( $row['header_transparent'] ) ? $row['header_transparent'] : 0,
                )
            );
        }
    }

    /**
     * Sanitize the rows posted by the template builder before they hit the option.
     *
     * Everything not explicitly allowed is dropped: unknown row keys, unknown page
     * builders, and part IDs that do not resolve to a published `athemes_hf` post.
     *
     * @param mixed $data Raw rows from the request.
     * @return array Sanitized rows, re-indexed.
     */
    private function sanitize_template_builder_data( $data ) {

        if ( ! is_array( $data ) ) {
            return array();
        }

        $parts    = array( 'header', 'page_title', 'content', 'footer' );
        $builders = array( 'elementor', 'editor', '' );
        $clean    = array();

        foreach ( $data as $row ) {

            if ( ! is_array( $row ) ) {
                continue;
            }

            $row_id = isset( $row['id'] ) ? $row['id'] : '';

            $item = array(
                // 'global' is the reserved id the renderer matches on, so it is kept verbatim.
                'id'            => ( 'global' === $row_id ) ? 'global' : sanitize_key( $row_id ),
                'template_name' => isset( $row['template_name'] ) ? sanitize_text_field( $row['template_name'] ) : '',
                'conditions'    => $this->sanitize_template_builder_conditions( isset( $row['conditions'] ) ? $row['conditions'] : '' ),
            );

            foreach ( $parts as $part ) {
                $builder = isset( $row[ $part . '_builder' ] ) ? $row[ $part . '_builder' ] : '';

                $item[ $part ]              = $this->sanitize_template_part_id( isset( $row[ $part ] ) ? $row[ $part ] : '' );
                $item[ $part . '_builder' ] = in_array( $builder, $builders, true ) ? $builder : '';
            }

            $clean[] = $item;
        }

        return $clean;
    }

    /**
     * Reduce a template part reference to a published `athemes_hf` post ID.
     *
     * Blanks out anything else - deleted posts, drafts, private posts, and IDs
     * pointing at unrelated post types - so a saved row can never render content
     * the builder did not create.
     *
     * @param mixed $part_id Raw part ID.
     * @return int|string Published post ID, or '' when there is nothing to render.
     */
    private function sanitize_template_part_id( $part_id ) {

        if ( '' === $part_id || null === $part_id ) {
            return '';
        }

        $part_id = absint( $part_id );

        if ( ! $part_id ) {
            return '';
        }

        $post = get_post( $part_id );

        if ( ! $post || 'athemes_hf' !== $post->post_type || 'publish' !== $post->post_status ) {
            return '';
        }

        return $part_id;
    }

    /**
     * Sanitize the display conditions JSON attached to a template row.
     *
     * @param mixed $conditions Raw conditions JSON.
     * @return string Re-encoded JSON, or '' when nothing valid is left.
     */
    private function sanitize_template_builder_conditions( $conditions ) {

        if ( '' === $conditions || null === $conditions ) {
            return '';
        }

        $rules = is_string( $conditions ) ? json_decode( $conditions, true ) : $conditions;

        if ( ! is_array( $rules ) ) {
            return '';
        }

        $clean = array();

        foreach ( $rules as $rule ) {

            if ( ! is_array( $rule ) ) {
                continue;
            }

            $type = isset( $rule['type'] ) ? $rule['type'] : '';

            if ( ! in_array( $type, array( 'include', 'exclude' ), true ) ) {
                continue;
            }

            $condition = isset( $rule['condition'] ) ? strtolower( trim( (string) $rule['condition'] ) ) : '';

            // Shape check on purpose, not a list of known condition names: new
            // conditions ship regularly and a hardcoded list here would silently
            // drop them.
            if ( ! preg_match( '/^[a-z0-9_-]+$/', $condition ) ) {
                continue;
            }

            $item = array(
                'type'      => $type,
                'condition' => $condition,
            );

            if ( in_array( $condition, array( 'cpt-taxonomy-id', 'post-type-archive', 'singular-post-type' ), true ) ) {

                // These conditions store a taxonomy or post type slug, not an ID:
                // absint() would destroy it and the rule would then match any
                // taxonomy or post type archive. sanitize_key() is not used either -
                // it would rewrite a key that does not match what is registered
                // (register_taxonomy() keeps the case it is given) and the rule would
                // then silently never fire. The raw value is validated against the
                // registered keys instead, so an unknown slug is dropped.
                $object_slug = ( isset( $rule['id'] ) && is_scalar( $rule['id'] ) ) ? trim( (string) $rule['id'] ) : '';

                if ( '' !== $object_slug ) {

                    $slug_exists = ( 'cpt-taxonomy-id' === $condition ) ? taxonomy_exists( $object_slug ) : post_type_exists( $object_slug );

                    if ( $slug_exists ) {
                        $item['id'] = $object_slug;
                    }
                }
            } elseif ( in_array( $condition, array( 'user-can', 'language' ), true ) ) {

                // A capability and a language code are both keys, so sanitize_key()
                // is the whole check: there is no registry to validate them against -
                // capabilities are added at runtime and the language list belongs to
                // whichever plugin is active.
                $object_key = ( isset( $rule['id'] ) && is_scalar( $rule['id'] ) ) ? sanitize_key( (string) $rule['id'] ) : '';

                if ( '' !== $object_key ) {
                    $item['id'] = $object_key;
                }
            } elseif ( 'schedule' === $condition ) {

                // The one condition with no id: it carries a start and an end
                // datetime-local string instead. Either bound may be left empty,
                // which is stored as a missing key, so only a well shaped value is
                // kept - the engine cannot compare anything else.
                foreach ( array( 'start', 'end' ) as $bound ) {

                    $bound_value = ( isset( $rule[ $bound ] ) && is_scalar( $rule[ $bound ] ) ) ? trim( (string) $rule[ $bound ] ) : '';

                    if ( preg_match( '/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}$/', $bound_value ) ) {
                        $item[ $bound ] = $bound_value;
                    }
                }

                // Neither bound kept means a row that can never match, so it is not
                // stored at all rather than persisted as dead configuration.
                if ( ! isset( $item['start'] ) && ! isset( $item['end'] ) ) {
                    continue;
                }
            } elseif ( 'page-template' === $condition ) {

                // This condition stores a template file such as
                // `templates/full-width.php`, so sanitize_key() would strip the
                // slash and the dot out of it. get_page_templates() is keyed by
                // template file, so an unknown file is dropped instead of stored.
                $object_template = ( isset( $rule['id'] ) && is_scalar( $rule['id'] ) ) ? sanitize_text_field( (string) $rule['id'] ) : '';

                if ( '' !== $object_template ) {

                    $page_templates = (array) wp_get_theme()->get_page_templates();

                    if ( isset( $page_templates[ $object_template ] ) ) {
                        $item['id'] = $object_template;
                    }
                }
            } else {

                $object_id = isset( $rule['id'] ) ? absint( $rule['id'] ) : 0;

                if ( $object_id ) {
                    $item['id'] = $object_id;
                }
            }

            $clean[] = $item;
        }

        return ! empty( $clean ) ? wp_json_encode( $clean ) : '';
    }

	/**
	 * Get option text
	 *
	 * Thin wrapper: the switch lives in inc/display-conditions-admin.php so the
	 * customizer control and the template builder resolve labels the same way.
	 */
	function get_option_text( $value ) {
		return sydney_display_conditions_option_text( $value );
	}


    /**
     * Insert a new template
     */
    function insert_template_part_callback() {

        check_ajax_referer('nonce-bt-dashboard', 'nonce');

        if ( ! current_user_can( 'manage_options' ) ) {
            wp_send_json_error();
        }

		if ( ! isset( $_POST['key'] ) ) {
			wp_send_json_error();
		}

		$key            = sanitize_text_field( wp_unslash( $_POST['key'] ) );
		$part_type      = isset( $_POST['part_type'] ) ? sanitize_key( wp_unslash( $_POST['part_type'] ) ) : '';
		$post_name      = $key . '-' . $part_type;
        $page_builder   = isset( $_POST['page_builder'] ) ? sanitize_text_field( wp_unslash( $_POST['page_builder'] ) ) : '';

		/*
		 * What the card currently points at, sent live so a part created but not
		 * yet saved counts as assigned. An empty slot means Create New, even when
		 * an orphaned part from an earlier attempt still holds the slug - adopting
		 * that one silently reopened someone else's content.
		 */
		$assigned_id = isset( $_POST['part_id'] ) ? absint( wp_unslash( $_POST['part_id'] ) ) : 0;

		if ( $assigned_id && 'athemes_hf' !== get_post_type( $assigned_id ) ) {
			$assigned_id = 0;
		}

		$post_title = '';

		if ( ! $assigned_id ) {

			//Set once, never regenerated - the part is renameable in the CPT editor.
			$part_labels = $this->get_template_part_labels();
			$part_label  = isset( $part_labels[ $part_type ] ) ? $part_labels[ $part_type ] : $part_type;

			if ( 'global' === $key ) {
				$card_label = __( 'Global', 'sydney' );
			} else {
				$card_label = isset( $_POST['template_name'] ) ? sanitize_text_field( wp_unslash( $_POST['template_name'] ) ) : '';
				$card_label = '' !== trim( $card_label ) ? trim( $card_label ) : __( 'Untitled', 'sydney' );
			}

			$post_title = $this->unique_template_part_title(
				sprintf(
					/* translators: 1: template name, e.g. "Global" or "Blog". 2: part name, e.g. "Content". */
					_x( '%1$s — %2$s', 'template part title', 'sydney' ),
					$card_label,
					$part_label
				)
			);

			$params = array(
				'post_content' => '',
				'post_type'    => 'athemes_hf',
				'post_title'   => $post_title,
				'post_name'    => $post_name,
				'post_status'  => 'publish',
			);

            //The presets ship with the templates builder, which the free theme does not have.
            $has_presets = class_exists( 'Sydney_Template_Presets' );

            if( $page_builder === 'elementor' ) {
                $params['meta_input'] = array(
                    '_elementor_edit_mode' => 'builder',
                    '_wp_page_template'    => 'elementor_canvas',
                );

                $preset = $has_presets ? Sydney_Template_Presets::get_elementor_data( $part_type ) : '';

                if ( '' !== $preset ) {
                    $params['meta_input']['_elementor_data'] = $preset;

                    //Without a version Elementor replays every upgrade routine over the preset.
                    if ( defined( 'ELEMENTOR_VERSION' ) ) {
                        $params['meta_input']['_elementor_version'] = ELEMENTOR_VERSION;
                    }
                }
            } elseif ( $has_presets ) {
                $params['post_content'] = Sydney_Template_Presets::get_block_content( $part_type );
            }

			$post_id = wp_insert_post( $params );

		} else { // edit the part the card already points at.
			$post_id    = $assigned_id;
			$post_title = get_the_title( $assigned_id );
		}

        $action = $page_builder === 'elementor' ? 'elementor' : 'edit';

		$edit_url = $this->template_part_edit_url( $post_id, $action );

		$result = array(
			'url'   => $edit_url,
			'id'    => $post_id,
			'title' => $post_title,
		);

		wp_send_json_success( $result );
	}    

    /**
     * Edit template
     */
    function edit_template_part_callback() {

        check_ajax_referer('nonce-bt-dashboard', 'nonce');

        if ( ! current_user_can( 'manage_options' ) ) {
            wp_send_json_error();
        }

        if ( ! isset( $_POST['key'] ) ) {
            wp_send_json_error();
        }

        $post_id = absint( wp_unslash( $_POST['key'] ) );

        $post = get_post( $post_id );

        // Only published template parts are editable from here: anything else is
        // a stale row pointing at a deleted, draft, or unrelated post.
        if ( empty( $post ) || 'athemes_hf' !== $post->post_type || 'publish' !== $post->post_status ) {
            wp_send_json_error();
        }

        $action = 'edit';

        if ( class_exists( 'Elementor\Plugin' ) ) {
            $document = Elementor\Plugin::$instance->documents->get( $post_id );

            if ( $document && $document->is_built_with_elementor() ) {
                $action = 'elementor';
            }
        }

        $edit_url = $this->template_part_edit_url( $post_id, $action );

        $result = array(
            'url'   => $edit_url,
            'id'    => $post_id,
            'title' => $post->post_title,
        );

        wp_send_json_success( $result );
    }

    /**
     * The four slots a template is built from, keyed by the part type stored in
     * sydney_template_builder_data. Shared by the builder markup and by the
     * naming of newly created parts, so the labels stay in one place.
     */
    public function get_template_part_labels() {
        return array(
            'header'     => __( 'Header', 'sydney' ),
            'page_title' => __( 'Page Title', 'sydney' ),
            'content'    => __( 'Content', 'sydney' ),
            'footer'     => __( 'Footer', 'sydney' ),
        );
    }

    /**
     * A part title no existing part is already using.
     *
     * Titles are set once at creation and name the part everywhere it is
     * offered afterwards, so two cards sharing a name would otherwise leave the
     * picker with two rows reading the same thing.
     *
     * @param string $title Title the part would be created with.
     * @return string The same title, suffixed when it is taken.
     */
    private function unique_template_part_title( $title ) {

        $taken  = $this->get_template_parts();
        $unique = $title;
        $index  = 2;

        while ( in_array( $unique, $taken, true ) ) {
            $unique = $title . ' (' . $index . ')';
            $index++;
        }

        return $unique;
    }

    /**
     * Get athemes templates CPT
     */
    function get_template_parts() {
        $args = array(
            'numberposts'   => -1,
            'post_type'     => 'athemes_hf',
        );  

        $posts = get_posts( $args );

        $parts = array();

        if ( ! empty( $posts ) ) {
            foreach ( $posts as $post ) {
                $parts[ $post->ID ] = $post->post_title;
            }
        }

        return $parts;
    }

    /**
     * Template parts the free preview names its filled slots after.
     *
     * The free theme renders this tab as a locked upsell: nothing is stored and
     * nothing reaches the front end, so without these the cards would preview as
     * four empty slots. The ids are strings, so they can never collide with a
     * real athemes_hf post id, and the lookups they pass through - Elementor's
     * document store and get_post_meta() - absint them and come back empty.
     *
     * @return array Part id => part title.
     */
    function get_sample_template_parts() {

        return array(
            'sample-header'         => __( 'Sample Header', 'sydney' ),
            'sample-content'        => __( 'Sample Content', 'sydney' ),
            'sample-archive-header' => __( 'Sample Archive Header', 'sydney' ),
            'sample-archive-footer' => __( 'Sample Archive Footer', 'sydney' ),
        );
    }

    /**
     * The cards the free preview draws in place of stored templates.
     *
     * Two of them, so the tab shows both what the Global card looks like once
     * parts are assigned and what a second template targeting its own pages
     * looks like beside it.
     *
     * `condition_labels` is what the applies-to line reads the sample condition
     * back out of: the labels are normally resolved through
     * sydney_display_conditions_option_text(), which is Pro only.
     *
     * @return array Template id => template, in the shape sydney_template_builder_data holds.
     */
    function get_sample_templates() {

        return array(
            'global' => array(
                'id'            => 'global',
                'template_name' => 'Global',
                'conditions'    => '',
                'upsell_copy'   => __( 'Override any part of your site\'s layout, then override it per page. Set a header, page title, content area and footer here, and every page uses them unless a template targets it.', 'sydney' ),
                'header'        => 'sample-header',
                'page_title'    => '',
                'content'       => 'sample-content',
                'footer'        => '',
            ),
            'sample-archives' => array(
                'id'            => 'sample-archives',
                'template_name' => __( 'Sample Template', 'sydney' ),
                //Carries an id purely so the label below resolves; the Archives
                //condition takes no object of its own.
                'conditions'       => wp_json_encode( array( array( 'type' => 'include', 'condition' => 'archive', 'id' => 'archive' ) ) ),
                'condition_labels' => array( 'archive' => __( 'Archives', 'sydney' ) ),
                'upsell_copy'      => __( 'Give any page, post or archive a layout of its own. A different header on landing pages, a custom layout for blog posts, a distraction-free checkout, etc.', 'sydney' ),
                'header'        => 'sample-archive-header',
                'page_title'    => '',
                'content'       => '',
                'footer'        => 'sample-archive-footer',
            ),
        );
    }

    /**
     * The Watch tutorial link.
     *
     * Sits beside the description in Pro and inside the upsell notice in free,
     * which are the only two rows it appears in.
     *
     * @return string
     */
    function template_builder_tutorial_link() {

        return '<a class="template-builder-tutorial" target="_blank" href="https://quicksnip.com/embed/N1AknaTpH4xyuSO" data-video-embed="https://quicksnip.com/embed/N1AknaTpH4xyuSO">'
            . sydney_dashboard_icon( 'play', 20 )
            . esc_html__( 'Watch tutorial', 'sydney' )
            . '</a>';
    }

    /**
     * The upsell veil the free preview lays over a builder card.
     *
     * Shared by the template cards and by Add Template, which are the same
     * offer seen from two places, so the lock and the link stay in one copy.
     *
     * @param string $copy One line on what the card underneath would do in Pro.
     * @return string
     */
    function upgrade_overlay( $copy = '' ) {

        $html = '<div class="tb-upgrade-overlay"><div>';

        $html .= sydney_dashboard_icon( 'lock', 48 );

        if ( '' !== $copy ) {
            $html .= '<p>' . esc_html( $copy ) . '</p>';
        }

        $html .= '<a class="button button-primary button-medium" href="' . esc_url( $this->settings['upgrade_pro_builder'] ) . '">' . esc_html__( 'Upgrade to Sydney Pro', 'sydney' ) . '</a>';

        return $html . '</div></div>';
    }

    /**
     * The row that takes a part menu panel back to the top level.
     */
    function part_menu_back() {

        return '<span class="part-menu-item part-menu-back">' . sydney_dashboard_icon( 'chevron-left', 18 ) . '<span class="part-menu-label">' . esc_html__( 'Back', 'sydney' ) . '</span></span><div class="part-menu-divider"></div>';
    }

    /**
     * Existing parts list: the part menu panel the "Select Existing" row drills into.
     */
    function existing_parts_select( $parts = array() ) {

        $html = '<div class="existing-parts-wrapper part-menu-panel">';

        $html .= $this->part_menu_back();

        if ( empty( $parts ) ) {
            $html .= '<div class="part-menu-empty">' . esc_html__( 'No templates found.', 'sydney' ) . '</div>';
        } else {
            $html .= '<div class="existing-parts-list">';

            foreach ( $parts as $id => $title ) {

                $page_builder = 'editor';

                if ( class_exists( 'Elementor\Plugin' ) ) {
                    $document = Elementor\Plugin::$instance->documents->get( $id );

                    if ( $document && $document->is_built_with_elementor() ) {
                        $page_builder = 'elementor';
                    }
                }

                //Carried on the row so picking a header seeds the Header Options
                //inputs from the part being picked, without a round trip.
                $header_options = sydney_get_header_options( $id );

                $html .= '<span class="part-menu-item existing-parts-item" data-page-builder="' . esc_attr( $page_builder ) . '" data-id="' . esc_attr( $id ) . '" data-header-sticky="' . esc_attr( $header_options['sticky'] ) . '" data-header-transparent="' . esc_attr( $header_options['transparent'] ) . '">' . esc_html( $title ) . '</span>';
            }

            $html .= '</div>';
        }

        $html .= '</div>';

        return $html;
    }

    /**
     * HTML Dashboard
     */
    public function html_dashboard() {
        $user_id             = get_current_user_id();
        $current_user        = wp_get_current_user();
        $notification_read   = $this->latest_notification_is_read();
        $notifications_count = 1;

        $theme_slug     = get_template();
        $theme_version  = wp_get_theme()->get( 'Version' );

		?>
      	<div class="sydney-dashboard sydney-dashboard-wrap">
			<div class="sydney-dashboard-top-bar">
				<a href="<?php echo esc_url($this->settings['upgrade_pro']); ?>" class="sydney-dashboard-top-bar-logo" target="_blank">
					<svg width="96" height="24" viewBox="0 0 96 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M23.4693 1.32313L8.45381 14.3107L0.67962 4.82163L23.4693 1.32313Z" fill="#335EEA"/>
						<path fill-rule="evenodd" clip-rule="evenodd" d="M23.2942 1.17329L8.23868 14.112L16.0129 23.601L23.2942 1.17329Z" fill="#BECCF9"/>
						<path fill-rule="evenodd" clip-rule="evenodd" d="M54.4276 12.8764C54.4276 10.7582 52.94 9.55047 51.2709 9.55047C49.6019 9.55047 48.8399 10.8325 48.8399 10.8325V4.53369H46.6629V18.5807H48.8399V12.7835C48.8399 12.7835 49.4205 11.6315 50.5453 11.6315C51.4886 11.6315 52.2506 12.1703 52.2506 13.4338V18.5807H54.4276V12.8764ZM39.9463 18.5807V7.6924H36.4449V5.57421H45.6247V7.6924H42.1233V18.5807H39.9463ZM36.604 12.8392C36.604 10.8325 35.1527 9.55047 32.6854 9.55047C30.8894 9.55047 29.2929 10.3494 29.2929 10.3494L30.0004 12.1889C30.0004 12.1889 31.3248 11.5386 32.5766 11.5386C33.3385 11.5386 34.427 11.9102 34.427 13.0622V13.5639C34.427 13.5639 33.6107 12.9321 32.0323 12.9321C30.1637 12.9321 28.658 14.1585 28.658 15.8493C28.658 17.7259 30.1456 18.8036 31.7602 18.8036C33.7014 18.8036 34.5903 17.4658 34.5903 17.4658V18.5807H36.604V12.8392ZM34.427 15.9236C34.427 15.9236 33.7376 16.9456 32.4314 16.9456C31.7602 16.9456 30.8713 16.7412 30.8713 15.8121C30.8713 14.8645 31.7965 14.5672 32.4677 14.5672C33.6469 14.5672 34.427 15.0132 34.427 15.0132V15.9236ZM59.7836 9.55047C62.142 9.55047 64.1195 11.4271 64.1195 14.1399C64.1195 14.3071 64.1195 14.6416 64.1013 14.976H57.6791C57.8424 15.7564 58.7314 16.7598 60.092 16.7598C61.5978 16.7598 62.4504 15.8679 62.4504 15.8679L63.5389 17.5401C63.5389 17.5401 62.1783 18.8036 60.092 18.8036C57.4796 18.8036 55.4659 16.7598 55.4659 14.177C55.4659 11.5943 57.2982 9.55047 59.7836 9.55047ZM61.9425 13.3595H57.6792C57.7517 12.5791 58.3867 11.5758 59.7836 11.5758C61.2168 11.5758 61.9062 12.5977 61.9425 13.3595ZM72.3963 11.0926C72.3987 11.0875 73.1253 9.55047 75.1357 9.55047C76.8773 9.55047 78.1472 10.7954 78.1472 12.9136V18.5807H75.9702V13.4896C75.9702 12.2818 75.5167 11.6315 74.4282 11.6315C73.2852 11.6315 72.741 12.7649 72.741 12.7649V18.5807H70.564V13.4896C70.564 12.2818 70.1104 11.6315 69.0219 11.6315C67.879 11.6315 67.3347 12.7649 67.3347 12.7649V18.5807H65.1577V9.77343H67.1896V11.0555C67.1896 11.0555 67.9697 9.55047 69.7294 9.55047C71.7947 9.55047 72.3946 11.0884 72.3963 11.0926ZM87.8391 14.1399C87.8391 11.4271 85.8616 9.55047 83.5032 9.55047C81.0178 9.55047 79.1855 11.5943 79.1855 14.177C79.1855 16.7598 81.1992 18.8036 83.8116 18.8036C85.8979 18.8036 87.2585 17.5401 87.2585 17.5401L86.17 15.8679C86.17 15.8679 85.3174 16.7598 83.8116 16.7598C82.451 16.7598 81.562 15.7564 81.3988 14.976H87.8209C87.8391 14.6416 87.8391 14.3071 87.8391 14.1399ZM81.3988 13.3595H85.6621C85.6258 12.5977 84.9364 11.5758 83.5032 11.5758C82.1063 11.5758 81.4713 12.5791 81.3988 13.3595ZM89.5486 15.5892L88.3331 17.2057C88.3331 17.2057 89.6937 18.8036 92.2154 18.8036C94.4106 18.8036 95.9708 17.5959 95.9708 16.0909C95.9708 14.2699 94.7553 13.6939 93.0499 13.3223C91.5986 13.0065 91.0181 12.8764 91.0181 12.3376C91.0181 11.7987 91.7619 11.5014 92.5783 11.5014C93.7393 11.5014 94.719 12.2632 94.719 12.2632L95.8075 10.6281C95.8075 10.6281 94.5194 9.55047 92.5783 9.55047C90.2198 9.55047 88.8773 10.9254 88.8773 12.3004C88.8773 13.9727 90.365 14.7159 92.0703 15.0875C93.3765 15.3662 93.7756 15.4777 93.7756 16.0537C93.7756 16.5925 93.0318 16.8527 92.1429 16.8527C90.6915 16.8527 89.5486 15.5892 89.5486 15.5892Z" fill="#101517"/>
					</svg>
				</a>
				<div class="sydney-dashboard-top-bar-infos bt-flex-center">
					<div class="sydney-dashboard-top-bar-info-item">
						<div class="sydney-dashboard-theme-version">
							<strong><?php echo esc_html( $theme_version ); ?></strong>
						</div>
					</div>
                    <div class="sydney-dashboard-top-bar-info-item">
						<a href="#" class="sydney-dashboard-theme-notifications<?php echo ( $notification_read ) ? ' read' : ''; ?>" title="<?php echo esc_attr__( 'Theme News', 'sydney' ); ?>">
                            <span class="sydney-dashboard-notifications-count"><?php echo absint( $notifications_count ); ?></span>
                            <?php echo sydney_dashboard_icon( 'bell', 20 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</a>
					</div>
					<div class="sydney-dashboard-top-bar-info-item">
                        <?php $link = $this->settings[ 'has_pro' ] ? $this->settings['website_link'] : $this->settings['upgrade_pro']; ?>

						<a href="<?php echo esc_url( $link ); ?>" class="sydney-dashboard-theme-website" target="_blank">
							<?php echo esc_html__( 'Website', 'sydney' ); ?>
							<?php echo sydney_dashboard_icon( 'external', 20, 'sydney-svg-accent' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</a>
					</div>
				</div>
			</div>

            <?php require get_template_directory() . '/inc/dashboard/html-notifications-sidebar.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound ?>
        
			<div class="sydney-dashboard-container" data-theme="<?php echo esc_attr( $theme_slug ); ?>">
                <?php require get_template_directory() . '/inc/dashboard/html-hero.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound ?>

				<div class="sydney-dashboard-row bt-p-relative bt-zindex-2">
					<div class="sydney-dashboard-column">
						<?php require get_template_directory() . '/inc/dashboard/html-tabs-nav-items.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound ?>
					</div>
				</div>
				<div class="sydney-dashboard-row">
					<div class="sydney-dashboard-column">
						<?php 
						$section = ( isset( $_GET['tab'] ) ) ? sanitize_text_field( wp_unslash( $_GET['tab'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended

						// A tab can stop being registered between page loads, so fall back to the default.
						if ( $section && ! isset( $this->settings[ 'tabs' ][ $section ] ) ) {
							$section = '';
						}

						foreach( $this->settings[ 'tabs' ] as $tab_id => $tab_title ) : 
							$tab_active = (($section && $section === $tab_id) || (!$section && $tab_id === 'home')) ? ' active' : '';

							?>	
                            <div class="sydney-dashboard-tab-content-wrapper" data-tab-wrapper-id="main">					
                                <div class="sydney-dashboard-tab-content<?php echo esc_attr( $tab_active ); ?>" data-tab-content-id="<?php echo esc_attr( $tab_id ); ?>">
                                    <?php require get_template_directory() . '/inc/dashboard/html-'. $tab_id .'.php'; ?>
                                </div>
                            </div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
      	</div>
    <?php
	}

    /**
     * HTML Notice
     */
    public function html_notice()
    {

        global $pagenow;

        $screen = get_current_screen();

        if ('themes.php' === $pagenow && 'themes' === $screen->base) {

            $transient = sprintf('%s_hero_notice', get_template());

            if (!get_transient($transient)) {
                ?>
            <div class="sydney-dashboard sydney-dashboard-notice">
            <?php require get_template_directory() . '/inc/dashboard/html-hero.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound ?>
            </div>
        <?php
}

        }
    }

    /**
     * HTML aThemes Patcher.
     */
    public function html_patcher() {
        require get_template_directory() . '/inc/dashboard/html-patcher.php';
    }
}

new Sydney_Dashboard();

/**
 * Meta key each header option is stored under, keyed by option name.
 *
 * @return array
 */
function sydney_header_option_meta_keys() {
    return array(
        'sticky'      => '_sydney_header_sticky',
        'transparent' => '_sydney_header_transparent',
    );
}

/**
 * Options set on a header template part.
 *
 * These live on the part rather than on the builder row pointing at it, so a
 * header carries them into every template that uses it - including the rows
 * that inherit their header from Global.
 *
 * @param int|string $part_id Header template part id.
 * @return array Option name => 1 when set, 0 otherwise.
 */
function sydney_get_header_options( $part_id ) {

    $options = array();

    foreach ( sydney_header_option_meta_keys() as $option => $meta_key ) {
        $options[ $option ] = get_post_meta( $part_id, $meta_key, true ) ? 1 : 0;
    }

    return $options;
}

/**
 * Store the options for a header template part.
 *
 * @param int   $part_id Header template part id.
 * @param array $options Option name => raw value.
 * @return void
 */
function sydney_set_header_options( $part_id, $options ) {

    foreach ( sydney_header_option_meta_keys() as $option => $meta_key ) {

        $value = isset( $options[ $option ] ) ? $options[ $option ] : 0;

        update_post_meta( $part_id, $meta_key, '1' === (string) $value ? 1 : 0 );
    }
}
