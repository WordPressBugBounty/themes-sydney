<?php
/**
 * Coming Soon module: the admin-bar badge and the admin notices.
 *
 * @package Sydney
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Sydney_Coming_Soon_Admin' ) ) :

	/**
	 * Sydney_Coming_Soon_Admin class.
	 */
	class Sydney_Coming_Soon_Admin {

		/**
		 * Admin-bar node ID.
		 */
		const NODE = 'sydney-site-mode';

		/**
		 * How long Maintenance mode can stay on before the notice suggests
		 * Coming Soon: two days, in seconds.
		 */
		const MAINTENANCE_LIMIT = 172800;

		/**
		 * Hook the badge and the notices.
		 */
		public static function init() {
			add_action( 'admin_bar_menu', array( __CLASS__, 'admin_bar_node' ), 100 );
			add_action( 'wp_head', array( __CLASS__, 'print_badge_styles' ) );
			add_action( 'admin_head', array( __CLASS__, 'print_badge_styles' ) );
			add_action( 'admin_notices', array( __CLASS__, 'maintenance_notice' ) );
			add_action( 'admin_notices', array( __CLASS__, 'theme_switch_notice' ) );
		}

		/**
		 * Whether the current admin screen is the Sydney dashboard.
		 *
		 * @return bool
		 */
		protected static function is_dashboard_page() {
			global $pagenow;

			return is_admin() && 'admin.php' === $pagenow && isset( $_GET['page'] ) && 'sydney-dashboard' === $_GET['page']; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		}

		/**
		 * Red badge naming the mode, for users who see the real site. On the
		 * dashboard it is always there, hidden while off, so the settings can
		 * show it in place when a mode is turned on.
		 *
		 * @param WP_Admin_Bar $wp_admin_bar Admin bar.
		 */
		public static function admin_bar_node( $wp_admin_bar ) {
			if ( ! current_user_can( 'edit_pages' ) ) {
				return;
			}

			$label = Sydney_Coming_Soon::mode_label( Sydney_Coming_Soon::get_mode() );

			if ( '' === $label && ! self::is_dashboard_page() ) {
				return;
			}

			$wp_admin_bar->add_node(
				array(
					'id'    => self::NODE,
					'title' => esc_html( $label ),
					'href'  => Sydney_Coming_Soon::settings_url(),
					'meta'  => array(
						'class' => '' === $label ? 'hidden' : '',
					),
				)
			);
		}

		/**
		 * Badge colors.
		 */
		public static function print_badge_styles() {
			if ( ! is_admin_bar_showing() ) {
				return;
			}

			echo '<style id="sydney-site-mode-badge">#wpadminbar #wp-admin-bar-' . esc_attr( self::NODE ) . ' > .ab-item{background:#d63638;color:#fff}#wpadminbar #wp-admin-bar-' . esc_attr( self::NODE ) . ' > .ab-item:hover,#wpadminbar #wp-admin-bar-' . esc_attr( self::NODE ) . ' > .ab-item:focus{background:#b32d2e;color:#fff}#wpadminbar #wp-admin-bar-' . esc_attr( self::NODE ) . '.hidden{display:none}</style>' . "\n";
		}

		/**
		 * Maintenance mode is meant for hours, not days: past two days, suggest
		 * Coming Soon, which search engines read as a normal page.
		 */
		public static function maintenance_notice() {
			if ( ! current_user_can( 'manage_options' ) || 'maintenance' !== Sydney_Coming_Soon::get_mode() ) {
				return;
			}

			$settings = Sydney_Coming_Soon::get_settings();

			if ( ! $settings['enabled_at'] || time() - $settings['enabled_at'] <= self::MAINTENANCE_LIMIT ) {
				return;
			}

			printf(
				'<div class="notice notice-warning"><p>%1$s <a href="%2$s">%3$s</a></p></div>',
				esc_html__( 'Maintenance mode has been on for more than two days. For a longer closure, switch to Coming Soon mode: search engines treat a long run of maintenance responses as a site that is down.', 'sydney' ),
				esc_url( Sydney_Coming_Soon::settings_url() ),
				esc_html__( 'Change Site mode', 'sydney' )
			);
		}

		/**
		 * The placeholder only lives in Sydney: switching themes takes it down.
		 */
		public static function theme_switch_notice() {
			global $pagenow;

			if ( 'themes.php' !== $pagenow || ! current_user_can( 'switch_themes' ) || 'off' === Sydney_Coming_Soon::get_mode() ) {
				return;
			}

			printf(
				'<div class="notice notice-warning"><p>%s</p></div>',
				esc_html(
					sprintf(
						/* translators: %s: Site mode name, such as "Coming Soon mode". */
						__( '%s is on. Switching to a theme other than Sydney turns the placeholder page off, and visitors will see your site.', 'sydney' ),
						Sydney_Coming_Soon::mode_label( Sydney_Coming_Soon::get_mode() )
					)
				)
			);
		}
	}

endif;
