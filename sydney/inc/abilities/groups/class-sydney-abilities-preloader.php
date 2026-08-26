<?php
/**
 * Preloader ability group: read and toggle the page preloader on/off.
 *
 * Storage reality: one checkbox theme_mod (enable_preloader, default on),
 * sanitized by sydney_sanitize_checkbox. On/off only. Stored as 1/'' to mirror
 * the theme sanitizer.
 *
 * @package Sydney
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Sydney_Abilities_Preloader' ) ) :

	/**
	 * Sydney_Abilities_Preloader class.
	 */
	class Sydney_Abilities_Preloader {

		/**
		 * Cached preloader definition map.
		 *
		 * @var array|null
		 */
		protected $preloader_map = null;

		/**
		 * Load and cache the declarative preloader map.
		 *
		 * @return array
		 */
		protected function get_preloader_map() {
			if ( null === $this->preloader_map ) {
				$this->preloader_map = apply_filters( 'sydney_abilities_preloader_map', require get_template_directory() . '/inc/abilities/customizer/definitions-preloader.php' );
			}
			return $this->preloader_map;
		}

		/**
		 * Register preloader abilities (read always, write when allowed).
		 */
		public function register() {
			$this->register_get_preloader();
			$this->register_update_preloader();
		}

		/**
		 * Register sydney/get-preloader (read).
		 */
		protected function register_get_preloader() {
			Sydney_Ability::register(
				'sydney/get-preloader',
				array(
					'label'            => __( 'Get preloader state', 'sydney' ),
					'description'      => __( 'Read whether the page preloader (loading animation shown until the page is ready) is enabled.', 'sydney' ),
					'input_schema'     => array( 'type' => 'object' ),
					'output_schema'    => Sydney_Ability::envelope_schema(
						array(
							'enabled' => array( 'type' => 'boolean' ),
						)
					),
					'execute_callback' => array( $this, 'execute_get_preloader' ),
					'meta'             => array(
						'annotations' => Sydney_Ability::READ_ANNOTATIONS,
					),
				)
			);
		}

		/**
		 * Register sydney/update-preloader (write).
		 */
		protected function register_update_preloader() {
			Sydney_Ability::register(
				'sydney/update-preloader',
				array(
					'write'            => true, // ADR-0002: not registered while writes are off.
					'label'            => __( 'Toggle preloader', 'sydney' ),
					'description'      => __( 'Enable or disable the page preloader (the loading animation shown until the page is ready).', 'sydney' ),
					'input_schema'     => array(
						'type'                 => 'object',
						'required'             => array( 'enabled' ),
						'additionalProperties' => false,
						'properties'           => array(
							'enabled' => array(
								'type'        => 'boolean',
								'description' => 'true to show the preloader, false to hide it.',
							),
						),
					),
					'output_schema'    => Sydney_Ability::envelope_schema(
						array(
							'enabled' => array( 'type' => 'boolean' ),
						)
					),
					'execute_callback' => array( $this, 'execute_update_preloader' ),
					'meta'             => array(
						'annotations' => Sydney_Ability::WRITE_ANNOTATIONS,
					),
				)
			);
		}

		/**
		 * Execute: report whether the preloader is enabled.
		 *
		 * @param array $args Ability args (unused).
		 * @return array Response envelope.
		 */
		public function execute_get_preloader( $args ) {
			$map = $this->get_preloader_map();

			return Sydney_Abilities_Response::success(
				__( 'Preloader state retrieved.', 'sydney' ),
				array( 'enabled' => (bool) get_theme_mod( $map['enabled']['theme_mod'], $map['enabled']['default'] ) )
			);
		}

		/**
		 * Execute: toggle the page preloader.
		 *
		 * @param array $args Ability args. Expects $args['enabled'].
		 * @return array Response envelope.
		 */
		public function execute_update_preloader( $args ) {
			if ( ! array_key_exists( 'enabled', $args ) || ! is_bool( $args['enabled'] ) ) {
				return Sydney_Abilities_Response::error(
					__( 'A boolean "enabled" is required.', 'sydney' )
				);
			}

			$map     = $this->get_preloader_map();
			$enabled = $args['enabled'];

			// Mirror sydney_sanitize_checkbox storage: 1 / ''.
			set_theme_mod( $map['enabled']['theme_mod'], $enabled ? 1 : '' );

			return Sydney_Abilities_Response::success(
				$enabled
					? __( 'Preloader enabled.', 'sydney' )
					: __( 'Preloader disabled.', 'sydney' ),
				array( 'enabled' => $enabled )
			);
		}
	}

endif;
