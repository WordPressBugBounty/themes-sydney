<?php
/**
 * Sidebar-layout ability group: read and toggle the theme's sidebar per context.
 *
 * Storage reality: the blog/archive listing uses one checkbox theme_mod
 * (sidebar_archives) plus a position mod (sidebar_archives_position). Every
 * public single-view post type gets its own pair, sidebar_single_{post_type}
 * and sidebar_single_{post_type}_position, registered dynamically in
 * inc/customizer/options/layouts.php over the same post-type set used here.
 * Positions store as 'sidebar-left'/'sidebar-right'; this ability exposes the
 * friendlier 'left'/'right' and maps both ways. The WooCommerce shop sidebar
 * (shop_archive_sidebar) is intentionally NOT exposed here — it belongs to the
 * conditional shop ability group.
 *
 * The context set is data-driven (open keyed map), so writes validate every key
 * against the live context list and report rejects via the ignored[] contract.
 *
 * @package Sydney
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Sydney_Abilities_Sidebars' ) ) :

	/**
	 * Sydney_Abilities_Sidebars class.
	 */
	class Sydney_Abilities_Sidebars {

		/**
		 * Post types layouts.php excludes from single-view sidebar controls.
		 */
		const EXCLUDED_POST_TYPES = array(
			'product',
			'attachment',
			'e-landing-page',
			'elementor_library',
			'athemes_hf',
		);

		/**
		 * Cached sidebars definition map.
		 *
		 * @var array|null
		 */
		protected $sidebars_map = null;

		/**
		 * Load and cache the declarative sidebars map.
		 *
		 * @return array
		 */
		protected function get_sidebars_map() {
			if ( null === $this->sidebars_map ) {
				$this->sidebars_map = apply_filters( 'sydney_abilities_sidebars_map', require get_template_directory() . '/inc/abilities/customizer/definitions-sidebars.php' );
			}
			return $this->sidebars_map;
		}

		/**
		 * Register sidebar abilities (read always, write when allowed).
		 */
		public function register() {
			$this->register_get_sidebars();
			$this->register_update_sidebars();
		}

		/**
		 * Register sydney/get-sidebars (read).
		 */
		protected function register_get_sidebars() {
			Sydney_Ability::register(
				'sydney/get-sidebars',
				array(
					'label'            => __( 'Get sidebar layout', 'sydney' ),
					'description'      => __( 'Read whether the sidebar is enabled and which side it sits on for each context: "archive" (blog and archive listings) and every public single-view post type (e.g. "post", "page"). Call before sydney/update-sidebars to learn the valid context keys.', 'sydney' ),
					'input_schema'     => array( 'type' => 'object' ),
					'output_schema'    => Sydney_Ability::envelope_schema(
						array(
							'contexts' => array(
								'type'                 => 'object',
								'additionalProperties' => array(
									'type'       => 'object',
									'properties' => array(
										'label'    => array( 'type' => 'string' ),
										'enabled'  => array( 'type' => 'boolean' ),
										'position' => array(
											'type'        => 'string',
											'enum'        => array( 'left', 'right' ),
											'description' => 'Position only takes effect while that context\'s sidebar is enabled.',
										),
									),
								),
							),
						)
					),
					'execute_callback' => array( $this, 'execute_get_sidebars' ),
					'meta'             => array(
						'annotations' => Sydney_Ability::READ_ANNOTATIONS,
					),
				)
			);
		}

		/**
		 * Register sydney/update-sidebars (write).
		 */
		protected function register_update_sidebars() {
			Sydney_Ability::register(
				'sydney/update-sidebars',
				array(
					'write'            => true, // ADR-0002: not registered while writes are off.
					'label'            => __( 'Update sidebar layout', 'sydney' ),
					'description'      => __( 'Enable/disable the sidebar and set its side per context. Send a "contexts" map keyed by context ("archive" or a public post-type slug); each value is an object with optional "enabled" (boolean) and "position" ("left" or "right"). Omitted contexts and omitted fields are left unchanged. Unknown keys or invalid values are reported in ignored[].', 'sydney' ),
					'input_schema'     => array(
						'type'                 => 'object',
						'additionalProperties' => false,
						'properties'           => array(
							'contexts' => array(
								'type'        => 'object',
								'description' => 'Map of context key => { enabled?: boolean, position?: "left"|"right" }. Position only takes effect while that context\'s sidebar is enabled.',
							),
						),
					),
					'output_schema'    => Sydney_Ability::envelope_schema( Sydney_Ability::updated_ignored_properties() ),
					'execute_callback' => array( $this, 'execute_update_sidebars' ),
					'meta'             => array(
						'annotations' => Sydney_Ability::WRITE_ANNOTATIONS,
					),
				)
			);
		}

		/**
		 * Build the caller-facing context => theme_mod map.
		 *
		 * Mirrors inc/customizer/options/layouts.php: "archive" plus every public
		 * post type minus the excluded set. Kept data-driven so a site's custom
		 * post types are exposed exactly as the Customizer exposes them.
		 *
		 * @return array Map of context key => { label, enabled_mod, position_mod }.
		 */
		protected function context_map() {
			$sidebars_map = $this->get_sidebars_map();

			$map = array(
				'archive' => array(
					'label'        => __( 'Blog / archive listings', 'sydney' ),
					'enabled_mod'  => $sidebars_map['archive']['enabled_mod'],
					'position_mod' => $sidebars_map['archive']['position_mod'],
				),
			);

			$post_types = get_post_types( array( 'public' => true ), 'objects' );

			foreach ( $post_types as $post_type ) {
				if ( in_array( $post_type->name, self::EXCLUDED_POST_TYPES, true ) ) {
					continue;
				}

				$map[ $post_type->name ] = array(
					'label'        => isset( $post_type->label ) ? $post_type->label : $post_type->name,
					'enabled_mod'  => 'sidebar_single_' . $post_type->name,
					'position_mod' => 'sidebar_single_' . $post_type->name . '_position',
				);
			}

			return $map;
		}

		/**
		 * Execute: report enabled state and side for every context.
		 *
		 * @param array $args Ability args (unused).
		 * @return array Response envelope.
		 */
		public function execute_get_sidebars( $args ) {
			$map      = $this->get_sidebars_map();
			$defaults = $map['defaults'];
			$contexts = array();

			foreach ( $this->context_map() as $key => $ctx ) {
				$position_raw = (string) get_theme_mod( $ctx['position_mod'], $defaults['position'] );

				$contexts[ $key ] = array(
					'label'    => $ctx['label'],
					'enabled'  => (bool) get_theme_mod( $ctx['enabled_mod'], $defaults['enabled'] ),
					'position' => 'sidebar-left' === $position_raw ? 'left' : 'right',
				);
			}

			return Sydney_Abilities_Response::success(
				__( 'Sidebar layout retrieved.', 'sydney' ),
				array( 'contexts' => $contexts )
			);
		}

		/**
		 * Execute: apply per-context sidebar toggles/positions.
		 *
		 * Each context is applied atomically: if any provided field for a context
		 * is invalid, the whole context is rejected into ignored[] and nothing for
		 * it is written. Checkboxes store 1/'' to mirror sydney_sanitize_checkbox;
		 * positions store 'sidebar-left'/'sidebar-right'.
		 *
		 * @param array $args Ability args. Expects $args['contexts'] map.
		 * @return array Response envelope.
		 */
		public function execute_update_sidebars( $args ) {
			$input = ( isset( $args['contexts'] ) && is_array( $args['contexts'] ) ) ? $args['contexts'] : array();

			if ( empty( $input ) ) {
				return Sydney_Abilities_Response::error(
					__( 'Provide a "contexts" map keyed by context (e.g. "archive", "post", "page").', 'sydney' )
				);
			}

			$map     = $this->context_map();
			$updated = array();
			$ignored = array();
			$mods    = array();

			foreach ( $input as $key => $value ) {
				if ( ! array_key_exists( $key, $map ) ) {
					$ignored[] = array(
						'key'    => (string) $key,
						'reason' => 'unknown key',
					);
					continue;
				}

				if ( ! is_array( $value ) ) {
					$ignored[] = array(
						'key'    => (string) $key,
						'reason' => 'invalid value',
					);
					continue;
				}

				$ctx      = $map[ $key ];
				$ctx_mods = array();
				$invalid  = false;

				if ( array_key_exists( 'enabled', $value ) ) {
					if ( is_bool( $value['enabled'] ) ) {
						$ctx_mods[ $ctx['enabled_mod'] ] = $value['enabled'] ? 1 : '';
					} else {
						$invalid = true;
					}
				}

				if ( array_key_exists( 'position', $value ) ) {
					if ( in_array( $value['position'], array( 'left', 'right' ), true ) ) {
						$ctx_mods[ $ctx['position_mod'] ] = 'sidebar-' . $value['position'];
					} else {
						$invalid = true;
					}
				}

				// Atomic per context: any bad field, or no recognized field at all,
				// rejects the whole context — never a partial write.
				if ( $invalid || empty( $ctx_mods ) ) {
					$ignored[] = array(
						'key'    => (string) $key,
						'reason' => 'invalid value',
					);
					continue;
				}

				$mods      = array_merge( $mods, $ctx_mods );
				$updated[] = (string) $key;
			}

			if ( empty( $updated ) ) {
				return Sydney_Abilities_Response::error(
					__( 'No valid sidebar contexts were provided; nothing was changed.', 'sydney' ),
					empty( $ignored ) ? array() : array( 'ignored' => $ignored )
				);
			}

			Sydney_Ability::set_theme_mods( $mods );

			return Sydney_Abilities_Response::success(
				__( 'Sidebar layout updated.', 'sydney' ),
				array(
					'updated' => $updated,
					'ignored' => $ignored,
				)
			);
		}
	}

endif;
