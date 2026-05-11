<?php
/**
 * Elementor admin UI tweaks for Sydney.
 *
 * @package Sydney
 */

if ( ! class_exists( 'Sydney_Elementor_Admin_Tweaks' ) ) :

	class Sydney_Elementor_Admin_Tweaks {

		/**
		 * Instance
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
			if ( ! class_exists( 'Elementor\Plugin' ) ) {
				return;
			}

			add_action( 'admin_head', array( $this, 'hide_hello_elementor_upsell' ) );
		}

		/**
		 * Hide Elementor's "Get Hello Elementor" prompt on Elementor admin pages.
		 *
		 * Elementor renders this button next to the active theme name, steering users
		 * toward a competing theme. No official filter disables it, so we hide it via
		 * CSS targeting Elementor's stable data-test attribute.
		 */
		public function hide_hello_elementor_upsell() {
			$page = isset( $_GET['page'] ) ? sanitize_key( wp_unslash( $_GET['page'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			if ( strpos( $page, 'elementor' ) !== 0 ) {
				return;
			}
			?>
			<style id="sydney-elementor-admin-tweaks">
				button[data-test="one-home-get-hello-elementor-button"]{display:none!important;}
			</style>
			<?php
		}
	}

	/**
	 * Initialize class
	 */
	Sydney_Elementor_Admin_Tweaks::get_instance();

endif;
