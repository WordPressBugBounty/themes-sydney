<?php
/**
 * Scroll-to-top ability group: read and toggle the back-to-top button on/off.
 *
 * Storage reality: one checkbox theme_mod (enable_scrolltop, default on),
 * sanitized by sydney_sanitize_checkbox. Scope is deliberately on/off only —
 * the button's style, colors and position (scrolltop_type/color/bg_color/
 * position/radius) are not exposed here. Stored as 1/'' to mirror the theme
 * sanitizer.
 *
 * @package Sydney
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Sydney_Abilities_Scrolltop' ) ) :

	/**
	 * Sydney_Abilities_Scrolltop class.
	 */
	class Sydney_Abilities_Scrolltop {

		/**
		 * Cached scrolltop definition map.
		 *
		 * @var array|null
		 */
		protected $scrolltop_map = null;

		/**
		 * Load and cache the declarative scrolltop map.
		 *
		 * @return array
		 */
		protected function get_scrolltop_map() {
			if ( null === $this->scrolltop_map ) {
				$this->scrolltop_map = apply_filters( 'sydney_abilities_scrolltop_map', require get_template_directory() . '/inc/abilities/customizer/definitions-scrolltop.php' );
			}
			return $this->scrolltop_map;
		}

		/**
		 * Register scroll-to-top abilities (read always, write when allowed).
		 */
		public function register() {
			$this->register_get_scrolltop();
			$this->register_update_scrolltop();
		}

		/**
		 * Register sydney/get-scrolltop (read).
		 */
		protected function register_get_scrolltop() {
			Sydney_Ability::register(
				'sydney/get-scrolltop',
				array(
					'label'            => __( 'Get scroll-to-top state', 'sydney' ),
					'description'      => __( 'Read whether the scroll-to-top (back-to-top) button is enabled.', 'sydney' ),
					'input_schema'     => array( 'type' => 'object' ),
					'output_schema'    => Sydney_Ability::envelope_schema(
						array(
							'enabled' => array( 'type' => 'boolean' ),
						)
					),
					'execute_callback' => array( $this, 'execute_get_scrolltop' ),
					'meta'             => array(
						'annotations' => Sydney_Ability::READ_ANNOTATIONS,
					),
				)
			);
		}

		/**
		 * Register sydney/update-scrolltop (write).
		 */
		protected function register_update_scrolltop() {
			Sydney_Ability::register(
				'sydney/update-scrolltop',
				array(
					'write'            => true, // ADR-0002: not registered while writes are off.
					'label'            => __( 'Toggle scroll-to-top', 'sydney' ),
					'description'      => __( 'Enable or disable the scroll-to-top (back-to-top) button. This toggles the button on or off only; its style, colors and position are not affected.', 'sydney' ),
					'input_schema'     => array(
						'type'                 => 'object',
						'required'             => array( 'enabled' ),
						'additionalProperties' => false,
						'properties'           => array(
							'enabled' => array(
								'type'        => 'boolean',
								'description' => 'true to show the button, false to hide it.',
							),
						),
					),
					'output_schema'    => Sydney_Ability::envelope_schema(
						array(
							'enabled' => array( 'type' => 'boolean' ),
						)
					),
					'execute_callback' => array( $this, 'execute_update_scrolltop' ),
					'meta'             => array(
						'annotations' => Sydney_Ability::WRITE_ANNOTATIONS,
					),
				)
			);
		}

		/**
		 * Execute: report whether the scroll-to-top button is enabled.
		 *
		 * @param array $args Ability args (unused).
		 * @return array Response envelope.
		 */
		public function execute_get_scrolltop( $args ) {
			$map = $this->get_scrolltop_map();

			return Sydney_Abilities_Response::success(
				__( 'Scroll-to-top state retrieved.', 'sydney' ),
				array( 'enabled' => (bool) get_theme_mod( $map['enabled']['theme_mod'], $map['enabled']['default'] ) )
			);
		}

		/**
		 * Execute: toggle the scroll-to-top button.
		 *
		 * @param array $args Ability args. Expects $args['enabled'].
		 * @return array Response envelope.
		 */
		public function execute_update_scrolltop( $args ) {
			if ( ! array_key_exists( 'enabled', $args ) || ! is_bool( $args['enabled'] ) ) {
				return Sydney_Abilities_Response::error(
					__( 'A boolean "enabled" is required.', 'sydney' )
				);
			}

			$map     = $this->get_scrolltop_map();
			$enabled = $args['enabled'];

			// Mirror sydney_sanitize_checkbox storage: 1 / ''.
			set_theme_mod( $map['enabled']['theme_mod'], $enabled ? 1 : '' );

			return Sydney_Abilities_Response::success(
				$enabled
					? __( 'Scroll-to-top button enabled.', 'sydney' )
					: __( 'Scroll-to-top button disabled.', 'sydney' ),
				array( 'enabled' => $enabled )
			);
		}
	}

endif;
