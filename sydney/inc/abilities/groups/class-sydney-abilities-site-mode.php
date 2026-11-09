<?php
/**
 * Site mode ability group: read and set the Coming Soon module's Site mode.
 *
 * Storage reality: the sydney_coming_soon option, owned by Sydney_Coming_Soon.
 * The write goes through Sydney_Coming_Soon::save_settings(), so it follows the
 * same rule as the dashboard: no Coming Soon or Maintenance mode without a
 * Placeholder page. Like the dashboard, the ability never picks an existing
 * page: a design creates the page, or overwrites it with replace, through
 * Sydney_Coming_Soon::create_page(), as Create page and Change design do.
 *
 * @package Sydney
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Sydney_Abilities_Site_Mode' ) ) :

	/**
	 * Sydney_Abilities_Site_Mode class.
	 */
	class Sydney_Abilities_Site_Mode {

		/**
		 * Register the Site mode abilities (read always, write when allowed).
		 */
		public function register() {
			$this->register_get_site_mode();
			$this->register_set_site_mode();
		}

		/**
		 * Output schema shared by both abilities.
		 *
		 * @return array
		 */
		protected function output_schema() {
			return Sydney_Ability::envelope_schema(
				array(
					'module_active' => array( 'type' => 'boolean' ),
					'mode'          => array(
						'type' => 'string',
						'enum' => Sydney_Coming_Soon::MODES,
					),
					'enabled_at'    => array( 'type' => 'integer' ),
					'page'          => array( 'type' => array( 'object', 'null' ) ),
					'page_missing'  => array( 'type' => 'boolean' ),
					'designs'       => array(
						'type'  => 'array',
						'items' => array(
							'type'       => 'object',
							'properties' => array(
								'slug'         => array( 'type' => 'string' ),
								'name'         => array( 'type' => 'string' ),
								'requires_pro' => array( 'type' => 'boolean' ),
							),
						),
					),
					'builders'      => array(
						'type'  => 'array',
						'items' => array(
							'type' => 'string',
							'enum' => Sydney_Coming_Soon::BUILDERS,
						),
					),
					'conflicts'     => array(
						'type'  => 'array',
						'items' => array( 'type' => 'string' ),
					),
				)
			);
		}

		/**
		 * Register sydney/get-site-mode (read).
		 */
		protected function register_get_site_mode() {
			Sydney_Ability::register(
				'sydney/get-site-mode',
				array(
					'label'            => __( 'Get Site mode', 'sydney' ),
					'description'      => __( 'Read the Coming Soon module state: whether the module is active, the Site mode (off, coming-soon or maintenance), when it was turned on, the Placeholder page visitors see while a mode is on, the designs and builders set-site-mode can create that page with, and other active plugins that run their own coming soon or maintenance mode.', 'sydney' ),
					'input_schema'     => array( 'type' => 'object' ),
					'output_schema'    => $this->output_schema(),
					'execute_callback' => array( $this, 'execute_get_site_mode' ),
					'meta'             => array(
						'annotations' => Sydney_Ability::READ_ANNOTATIONS,
					),
				)
			);
		}

		/**
		 * Register sydney/set-site-mode (write).
		 */
		protected function register_set_site_mode() {
			Sydney_Ability::register(
				'sydney/set-site-mode',
				array(
					'write'               => true, // ADR-0002: not registered while writes are off.
					'label'               => __( 'Set Site mode', 'sydney' ),
					'description'         => __( 'Turn Coming Soon mode or Maintenance mode on or off, and create or redesign the Placeholder page, as the Sydney dashboard does. While a mode is on, visitors see the Placeholder page on every URL and users who can edit pages see the real site. A mode needs a Placeholder page: when there is none, pass design to create one as a private page, built in the block editor or, with builder elementor, in Elementor. When there is one, pass a design with replace true to overwrite it. Pass mode off with a design to create the page without turning a mode on. get-site-mode lists the designs and builders. Coming Soon is for a site that has not launched or is closed for more than two days; Maintenance is for a short break of up to two days.', 'sydney' ),
					'input_schema'        => array(
						'type'                 => 'object',
						'required'             => array( 'mode' ),
						'additionalProperties' => false,
						'properties'           => array(
							'mode'    => array(
								'type'        => 'string',
								'enum'        => Sydney_Coming_Soon::MODES,
								'description' => 'The Site mode to set.',
							),
							'design'  => array(
								'type'        => 'string',
								'enum'        => array_keys( Sydney_Coming_Soon::get_designs() ),
								'description' => 'Optional. Design to create the Placeholder page from. Designs marked requires_pro in get-site-mode need Sydney Pro.',
							),
							'builder' => array(
								'type'        => 'string',
								'enum'        => Sydney_Coming_Soon::BUILDERS,
								'description' => 'Optional, with design. editor builds the page in the block editor (the default), elementor in Elementor, which needs the Elementor plugin.',
							),
							'replace' => array(
								'type'        => 'boolean',
								'description' => 'Optional, with design. Overwrite the current Placeholder page with the design, keeping its ID and title. Needed when a Placeholder page exists.',
							),
						),
					),
					'output_schema'       => $this->output_schema(),
					'permission_callback' => array( $this, 'can_set_site_mode' ),
					'execute_callback'    => array( $this, 'execute_set_site_mode' ),
					'meta'                => array(
						// A design creates a page.
						'annotations' => array_merge( Sydney_Ability::WRITE_ANNOTATIONS, array( 'idempotent' => false ) ),
					),
				)
			);
		}

		/**
		 * Setting the mode takes the whole site down for visitors, so it needs
		 * the same capability as the dashboard setting.
		 *
		 * @return bool
		 */
		public function can_set_site_mode() {
			return current_user_can( 'manage_options' );
		}

		/**
		 * The state as both abilities report it.
		 *
		 * @return array
		 */
		protected function state() {
			$state = Sydney_Coming_Soon::state();

			unset( $state['label'] );

			if ( is_array( $state['page'] ) ) {
				unset( $state['page']['status_label'] );
			}

			$state['designs']   = $this->designs();
			$state['builders']  = $this->builders();
			$state['conflicts'] = Sydney_Coming_Soon::get_conflicts();

			return $state;
		}

		/**
		 * The designs a Placeholder page can be created from. requires_pro
		 * follows the rule Sydney_Coming_Soon::create_page() applies.
		 *
		 * @return array[] { slug, name, requires_pro }
		 */
		protected function designs() {
			$designs = array();

			foreach ( Sydney_Coming_Soon::get_designs() as $slug => $design ) {
				$designs[] = array(
					'slug'         => (string) $slug,
					'name'         => isset( $design['name'] ) ? (string) $design['name'] : (string) $slug,
					'requires_pro' => ( ! isset( $design['type'] ) || 'free' !== $design['type'] ) && ! defined( 'SYDNEY_PRO_VERSION' ),
				);
			}

			return $designs;
		}

		/**
		 * The builders available on this site: Elementor only while it is active.
		 *
		 * @return string[]
		 */
		protected function builders() {
			$builders = array();

			foreach ( Sydney_Coming_Soon::BUILDERS as $builder ) {
				if ( 'elementor' !== $builder || class_exists( '\Elementor\Plugin' ) ) {
					$builders[] = $builder;
				}
			}

			return $builders;
		}

		/**
		 * Execute: report the Site mode.
		 *
		 * @param array $args Ability args (unused).
		 * @return array Response envelope.
		 */
		public function execute_get_site_mode( $args ) {
			if ( ! class_exists( 'Sydney_Coming_Soon' ) ) {
				return Sydney_Abilities_Response::error( __( 'The Coming Soon module is not available.', 'sydney' ) );
			}

			return Sydney_Abilities_Response::success(
				__( 'Site mode retrieved.', 'sydney' ),
				$this->state()
			);
		}

		/**
		 * Execute: set the Site mode and, optionally, create or redesign the
		 * Placeholder page from a design.
		 *
		 * @param array $args Ability args. Expects $args['mode'], optional $args['design'] (with $args['builder'], $args['replace']).
		 * @return array Response envelope.
		 */
		public function execute_set_site_mode( $args ) {
			if ( ! class_exists( 'Sydney_Coming_Soon' ) ) {
				return Sydney_Abilities_Response::error( __( 'The Coming Soon module is not available.', 'sydney' ) );
			}

			$mode = isset( $args['mode'] ) && is_string( $args['mode'] ) ? $args['mode'] : '';

			if ( ! in_array( $mode, Sydney_Coming_Soon::MODES, true ) ) {
				return Sydney_Abilities_Response::error( __( 'mode must be off, coming-soon or maintenance.', 'sydney' ) );
			}

			$design = isset( $args['design'] ) && is_string( $args['design'] ) ? $args['design'] : '';

			if ( '' === $design && ( isset( $args['builder'] ) || ! empty( $args['replace'] ) ) ) {
				return Sydney_Abilities_Response::error( __( 'builder and replace apply to a design: pass design as well.', 'sydney' ) );
			}

			if ( ( 'off' !== $mode || '' !== $design ) && ! Sydney_Coming_Soon::is_module_active() ) {
				return Sydney_Abilities_Response::error( __( 'The Coming Soon module is not active. Activate it on the Sydney dashboard Home tab first.', 'sydney' ) );
			}

			$has_page = Sydney_Coming_Soon::page_is_valid( Sydney_Coming_Soon::get_page_id() );

			// As on the dashboard, Create page is only offered while there is no page.
			if ( '' !== $design && $has_page && empty( $args['replace'] ) ) {
				return Sydney_Abilities_Response::error( __( 'A Placeholder page already exists. Pass replace true to overwrite it with the design, or leave design out to keep it.', 'sydney' ) );
			}

			if ( '' === $design && 'off' !== $mode && ! $has_page ) {
				return Sydney_Abilities_Response::error( __( 'There is no Placeholder page yet. Pass design to create one.', 'sydney' ) );
			}

			if ( '' !== $design ) {
				$builder = isset( $args['builder'] ) && is_string( $args['builder'] ) ? $args['builder'] : 'editor';
				$page    = Sydney_Coming_Soon::create_page( $builder, $design, ! empty( $args['replace'] ) );

				if ( is_wp_error( $page ) ) {
					return Sydney_Abilities_Response::error( $page->get_error_message() );
				}
			}

			$result = Sydney_Coming_Soon::save_settings( array( 'mode' => $mode ) );

			if ( is_wp_error( $result ) ) {
				return Sydney_Abilities_Response::error( $result->get_error_message() );
			}

			if ( '' !== $design ) {
				$message = 'off' === $mode ? __( 'Design applied to the Placeholder page. Site mode is off.', 'sydney' ) : __( 'Design applied to the Placeholder page and Site mode updated.', 'sydney' );
			} else {
				$message = 'off' === $mode ? __( 'Site mode turned off.', 'sydney' ) : __( 'Site mode updated.', 'sydney' );
			}

			return Sydney_Abilities_Response::success( $message, $this->state() );
		}
	}

endif;
