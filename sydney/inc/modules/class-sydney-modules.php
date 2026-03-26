<?php
/**
 * Premium modules
 *
 * @package Sydney
 */

if ( ! class_exists( 'Sydney_Modules' ) ) {
	/**
	 * Get a svg icon
	 */
	class Sydney_Modules {

		/**
		 * Constructor
		 */
		public function __construct() {
			add_action( 'admin_init', array( $this, 'activate_modules' ) );
		}       

		/**
		 * All modules registered in Sydney
		 */
		public static function get_modules( $category = false ) {

			$modules = array();

			$modules['general'] = array(
				array(
					'slug'          => 'block-templates',
					'name'          => esc_html__( 'Block Templates', 'sydney' ),
					'type'          => 'pro',
					'link'          => admin_url( 'site-editor.php?path=%2Fwp_template_part%2Fall' ),
					'link_label'    => esc_html__( 'Build templates', 'sydney' ),
					'activate_uri'  => '&amp;activate_module_block-templates', //param is added in dashboard class
					'text'          => __( 'Build headers, footers etc. with the site editor.', 'sydney' ) . '<div><a target="_blank" href="#">' . __( 'Documentation article', 'sydney' ) . '</a></div>',
					'keywords'      => array( 'header', 'footer', 'template', 'templates', 'builder' ),
				),
			);

			if ( $category ) {
				return $modules[$category];
			}
		
			//build array with all modules if no category is specified
			$all_modules = array();
			foreach ( $modules as $module ) {
				$all_modules = array_merge( $all_modules, $module );
			}

			return $all_modules;
		}

		/**
		 * Check if a specific module is activated
		 */
		public static function is_module_active( $module ) {

			$all_modules = get_option( 'sydney-modules' );
			$all_modules = ( is_array( $all_modules ) ) ? $all_modules : (array) $all_modules;

			if ( array_key_exists( $module, $all_modules ) && true === $all_modules[$module] ) {
				return true;
			}
		
			return false;
		}

		/**
		 * Activate modules on click
		 */
		public function activate_modules() {
			if ( ! is_admin() || ! current_user_can( 'manage_options' ) ) {
				return;
			}

			// Verify nonce for security
			if ( ! isset( $_GET['_wpnonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_GET['_wpnonce'] ) ), 'sydney_modules_nonce' ) ) {
				return;
			}

			$modules = $this->get_modules();

			$all_modules = get_option( 'sydney-modules' );
			$all_modules = ( is_array( $all_modules ) ) ? $all_modules : (array) $all_modules;

			foreach ( $modules as $module ) {
				$param = 'activate_module_' . $module['slug'];

				if ( ! isset( $_GET[ $param ] ) ) { //phpcs:ignore WordPress.Security.NonceVerification.Recommended
					continue;
				}

				// Sanitize the parameter name and value
				$sanitized_param = sanitize_key( $param );
				$value = (int) wp_unslash( sanitize_text_field( $_GET[ $param ] ) );
				
				if ( 1 === $value ) {
					update_option( 'sydney-modules', array_merge( $all_modules, array( $module['slug'] => true ) ) );
				} elseif ( 0 === $value ) {
					update_option( 'sydney-modules', array_merge( $all_modules, array( $module['slug'] => false ) ) );
				}
			}
		}

		/**
		 * Check if a feature has unmet dependencies
		 *
		 * @param array $feature Feature configuration array
		 * @return bool True if dependencies are not met, false if all dependencies are met
		 */
		public static function has_unmet_dependencies( $feature ) {
			// If no dependency is set, all dependencies are met
			if ( ! isset( $feature['dependency'] ) || ! is_array( $feature['dependency'] ) ) {
				return false;
			}

			// Check if callback exists and is callable
			if ( ! isset( $feature['dependency']['callback'] ) || ! is_callable( $feature['dependency']['callback'] ) ) {
				return false;
			}

			// Call the dependency callback - if it returns false, dependencies are not met
			$dependency_met = call_user_func( $feature['dependency']['callback'] );

			// Return true if dependency is NOT met (inverse logic for has_unmet)
			return ! $dependency_met;
		}

		/**
		 * Get the dependency message for a feature
		 *
		 * @param array $feature Feature configuration array
		 * @return string The dependency message or empty string
		 */
		public static function get_dependency_message( $feature ) {
			if ( ! isset( $feature['dependency']['message'] ) ) {
				return '';
			}

			return $feature['dependency']['message'];
		}
	}   
}

new Sydney_Modules();