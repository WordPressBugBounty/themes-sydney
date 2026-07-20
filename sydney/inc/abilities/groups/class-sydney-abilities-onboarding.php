<?php
/**
 * Onboarding ability group: site title, usage-tracking opt-in, and an
 * orientation status read. set-site-title writes the core blogname option and
 * therefore overrides Sydney_Ability::register()'s default edit_theme_options
 * floor with manage_options via its permission_callback.
 *
 * @package Sydney
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Sydney_Abilities_Onboarding' ) ) :

	/**
	 * Sydney_Abilities_Onboarding class.
	 */
	class Sydney_Abilities_Onboarding {

		/**
		 * Register onboarding abilities (read always, writes when allowed).
		 */
		public function register() {

			$this->register_get_onboarding_status();

			$this->register_set_site_title();
			$this->register_set_usage_tracking();
		}

		/**
		 * Register sydney/get-onboarding-status (read).
		 */
		protected function register_get_onboarding_status() {
			Sydney_Ability::register(
				'sydney/get-onboarding-status',
				array(
					'label'            => __( 'Get onboarding status', 'sydney' ),
					'description'      => __( 'Orient before guiding setup: whether write abilities are enabled, whether the aThemes Starter Sites plugin is active, and the current site title.', 'sydney' ),
					'input_schema'     => array(
						'type'       => 'object',
						'properties' => new stdClass(),
					),
					'output_schema'    => Sydney_Ability::envelope_schema(
						array(
									'writes_enabled'        => array( 'type' => 'boolean' ),
									'starter_plugin_active' => array( 'type' => 'boolean' ),
									'site_title'            => array( 'type' => 'string' ),
						)
					),
					'execute_callback' => array( $this, 'execute_get_onboarding_status' ),
					'meta'             => array(
						'annotations' => Sydney_Ability::READ_ANNOTATIONS,
					),
				)
			);
		}

		/**
		 * Execute: report orientation status for the onboarding flow.
		 *
		 * @param array $args Ability args (unused).
		 * @return array Response envelope.
		 */
		public function execute_get_onboarding_status( $args ) {
			$active_plugins        = (array) get_option( 'active_plugins', array() );
			$starter_plugin_active = in_array( 'athemes-starter-sites/athemes-starter-sites.php', $active_plugins, true );

			return Sydney_Abilities_Response::success(
				__( 'Onboarding status retrieved.', 'sydney' ),
				array(
					'writes_enabled'        => Sydney_Abilities::writes_enabled(),
					'starter_plugin_active' => $starter_plugin_active,
					'site_title'            => (string) get_option( 'blogname', '' ),
				)
			);
		}

		/**
		 * Register sydney/set-site-title (write, manage_options).
		 */
		protected function register_set_site_title() {
			Sydney_Ability::register(
				'sydney/set-site-title',
				array(
					'write' => true,
					'label'               => __( 'Set site title', 'sydney' ),
					'description'         => __( 'Set the website title (the WordPress Site Title / blogname). This is a core option and is not affected by a starter-site import, so it can be set at any time.', 'sydney' ),
					'input_schema'        => array(
						'type'                 => 'object',
						'required'             => array( 'site_title' ),
						'additionalProperties' => false,
						'properties'           => array(
							'site_title' => array(
								'type'        => 'string',
								'description' => 'The new site title.',
							),
						),
					),
					'output_schema'       => Sydney_Ability::envelope_schema(
						array(
									'site_title' => array( 'type' => 'string' ),
						)
					),
					'execute_callback'    => array( $this, 'execute_set_site_title' ),
					// blogname is a core option: manage_options, not the default
					// edit_theme_options floor.
					'permission_callback' => array( $this, 'check_manage_options' ),
					'meta'                => array(
						'annotations' => Sydney_Ability::WRITE_ANNOTATIONS,
					),
				)
			);
		}

		/**
		 * Permission check for general-settings writes (blogname).
		 *
		 * @return bool
		 */
		public function check_manage_options() {
			return current_user_can( 'manage_options' );
		}

		/**
		 * Register sydney/set-usage-tracking (write).
		 */
		protected function register_set_usage_tracking() {
			Sydney_Ability::register(
				'sydney/set-usage-tracking',
				array(
					'write' => true,
					'label'            => __( 'Set anonymous usage tracking', 'sydney' ),
					'description'      => __( 'Enable or disable Sydney\'s anonymous usage tracking opt-in.', 'sydney' ),
					'input_schema'     => array(
						'type'                 => 'object',
						'required'             => array( 'enabled' ),
						'additionalProperties' => false,
						'properties'           => array(
							'enabled' => array(
								'type'        => 'boolean',
								'description' => 'true to opt in, false to opt out.',
							),
						),
					),
					'output_schema'    => Sydney_Ability::envelope_schema(
						array(
									'enabled' => array( 'type' => 'boolean' ),
						)
					),
					'execute_callback' => array( $this, 'execute_set_usage_tracking' ),
					'meta'             => array(
						'annotations' => Sydney_Ability::WRITE_ANNOTATIONS,
					),
				)
			);
		}

		/**
		 * Execute: set the usage-tracking opt-in option.
		 *
		 * @param array $args Ability args. Expects $args['enabled'].
		 * @return array Response envelope.
		 */
		public function execute_set_usage_tracking( $args ) {
			$enabled = ! empty( $args['enabled'] );

			update_option( 'sydney-usage-tracking-enabled', $enabled ? 1 : 0 );

			return Sydney_Abilities_Response::success(
				$enabled
					? __( 'Anonymous usage tracking enabled.', 'sydney' )
					: __( 'Anonymous usage tracking disabled.', 'sydney' ),
				array( 'enabled' => $enabled )
			);
		}

		/**
		 * Execute: set the site title (blogname).
		 *
		 * @param array $args Ability args. Expects $args['site_title'].
		 * @return array Response envelope.
		 */
		public function execute_set_site_title( $args ) {
			$title = isset( $args['site_title'] ) ? sanitize_text_field( (string) $args['site_title'] ) : '';

			if ( '' === $title ) {
				return Sydney_Abilities_Response::error(
					__( 'A non-empty site_title is required.', 'sydney' )
				);
			}

			update_option( 'blogname', $title );

			return Sydney_Abilities_Response::success(
				/* translators: %s: the new site title. */
				sprintf( __( 'Site title set to "%s".', 'sydney' ), $title ),
				array( 'site_title' => $title )
			);
		}
	}

endif;
