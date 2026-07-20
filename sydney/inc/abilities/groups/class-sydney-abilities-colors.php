<?php
/**
 * Global colors ability group: registers and executes sydney/get-global-colors
 * and sydney/update-global-colors from the declarative colors definition map.
 *
 * @package Sydney
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

require_once get_template_directory() . '/inc/abilities/customizer/class-sydney-color-references.php';

if ( ! class_exists( 'Sydney_Abilities_Colors' ) ) :

	/**
	 * Sydney_Abilities_Colors class.
	 */
	class Sydney_Abilities_Colors {

		/**
		 * Cached colors definition map.
		 *
		 * @var array|null
		 */
		protected $colors_map = null;

		/**
		 * Load and cache the declarative global colors map.
		 *
		 * @return array
		 */
		protected function get_colors_map() {
			if ( null === $this->colors_map ) {
				$this->colors_map = apply_filters( 'sydney_abilities_colors_map', require get_template_directory() . '/inc/abilities/customizer/definitions-colors.php' );
			}
			return $this->colors_map;
		}

		/**
		 * Cached color palette catalog.
		 *
		 * @var array|null
		 */
		protected $palettes_map = null;

		/**
		 * Load and cache the named color-palette catalog.
		 *
		 * @return array
		 */
		protected function get_palettes_map() {
			if ( null === $this->palettes_map ) {
				$this->palettes_map = apply_filters( 'sydney_abilities_color_palettes', require get_template_directory() . '/inc/abilities/customizer/definitions-color-palettes.php' );
			}
			return $this->palettes_map;
		}

		/**
		 * Register the global colors abilities (read always, write when allowed).
		 */
		public function register() {

			Sydney_Ability::register(
				'sydney/get-global-colors',
				array(
					'label'            => __( 'Get global colors', 'sydney' ),
					'description'      => __( 'Read every global color palette slot and its semantic role. Use before sydney/update-global-colors to choose the right slot.', 'sydney' ),
					'input_schema'     => array(
						'type'       => 'object',
						'properties' => new stdClass(),
					),
					'output_schema'    => Sydney_Ability::envelope_schema(
						array(
									'colors' => array( 'type' => 'object' ),
						)
					),
					'execute_callback' => array( $this, 'execute_get_global_colors' ),
					'meta'             => array(
						'annotations' => Sydney_Ability::READ_ANNOTATIONS,
					),
				)
			);

			Sydney_Ability::register(
				'sydney/list-color-palettes',
				array(
					'label'            => __( 'List color palettes', 'sydney' ),
					'description'      => __( 'List Sydney\'s named global-color palettes (id, name, and per-slot hex values). Use to offer the user a palette by name, then apply it with sydney/apply-color-palette.', 'sydney' ),
					'input_schema'     => array(
						'type'       => 'object',
						'properties' => new stdClass(),
					),
					'output_schema'    => Sydney_Ability::envelope_schema(
						array(
									'palettes' => array( 'type' => 'array' ),
						)
					),
					'execute_callback' => array( $this, 'execute_list_color_palettes' ),
					'meta'             => array(
						'annotations' => Sydney_Ability::READ_ANNOTATIONS,
					),
				)
			);

			Sydney_Ability::register(
				'sydney/update-global-colors',
				array(
					'write' => true,
					'label'            => __( 'Update global colors', 'sydney' ),
					'description'      => __( 'Change one or more of Sydney\'s 11 site-wide palette colors (accent, headings, body text, backgrounds, borders). Provide a "colors" map of slot id to a hex/rgba color. Call sydney/get-global-colors first to see current values and each slot\'s role. Slots you omit are left unchanged.', 'sydney' ),
					'input_schema'     => array(
						'type'                 => 'object',
						'required'             => array( 'colors' ),
						'additionalProperties' => false, // Top-level only: reject any property other than `colors`. The inner `colors` map stays open-ended (agent-supplied slot ids), guarded by the callback allow-list + ignored[] contract.
						'properties'           => array(
							'colors' => array(
								'type'        => 'object',
								'description' => 'Map of palette slot id to a hex (#rrggbb) or rgba() color string. Roles: global_color_1 = primary/accent, global_color_2 = primary-hover/accent-dark, global_color_3 = secondary, global_color_4 = headings/dark, global_color_5 = body text, global_color_6 = body-text-strong, global_color_7 = light background, global_color_8 = borders/dividers, global_color_9 = base/white background, extra_global_color_1 and extra_global_color_2 = optional custom (render only if set). Unknown slots or values failing hex/rgba validation are skipped and returned in data.ignored — they do not fail the call. An empty string is invalid input, NOT a reset-to-default.',
							),
						),
					),
					'output_schema'    => Sydney_Ability::envelope_schema( Sydney_Ability::updated_ignored_properties() ),
					'execute_callback' => array( $this, 'execute_update_global_colors' ),
					'meta'             => array(
						'annotations' => Sydney_Ability::WRITE_ANNOTATIONS,
					),
				)
			);

			Sydney_Ability::register(
				'sydney/apply-color-palette',
				array(
					'write' => true,
					'label'            => __( 'Apply color palette', 'sydney' ),
					'description'      => __( 'Apply one of Sydney\'s named color palettes (see sydney/list-color-palettes) to the whole site. Sets all global color slots and propagates them to linked elements. If importing a starter site, run the import FIRST — the import overwrites theme colors.', 'sydney' ),
					'input_schema'     => array(
						'type'                 => 'object',
						'required'             => array( 'palette_id' ),
						'additionalProperties' => false,
						'properties'           => array(
							'palette_id' => array(
								'type'        => 'string',
								'description' => 'A palette id from sydney/list-color-palettes, e.g. "vibrant-blue".',
							),
						),
					),
					'output_schema'    => Sydney_Ability::envelope_schema(
						array(
									'palette_id' => array( 'type' => 'string' ),
									'updated'    => array(
										'type'  => 'array',
										'items' => array( 'type' => 'string' ),
									),
						)
					),
					'execute_callback' => array( $this, 'execute_apply_color_palette' ),
					'meta'             => array(
						'annotations' => Sydney_Ability::WRITE_ANNOTATIONS,
					),
				)
			);
		}

		/**
		 * Execute: read all global color slots.
		 *
		 * @param array $args Ability args (unused).
		 * @return array Response envelope.
		 */
		public function execute_get_global_colors( $args ) {
			$map    = $this->get_colors_map();
			$colors = array();

			foreach ( $map as $slot => $entry ) {
				$colors[ $slot ] = array(
					'value' => get_theme_mod( $entry['theme_mod'], $entry['default'] ),
					'role'  => $entry['role'],
				);
			}

			return Sydney_Abilities_Response::success(
				__( 'Global colors retrieved.', 'sydney' ),
				array( 'colors' => $colors )
			);
		}

		/**
		 * Execute: list the named color palettes.
		 *
		 * @param array $args Ability args (unused).
		 * @return array Response envelope.
		 */
		public function execute_list_color_palettes( $args ) {
			$map      = $this->get_palettes_map();
			$palettes = array();

			foreach ( $map as $id => $palette ) {
				$palettes[] = array(
					'id'     => (string) $id,
					'name'   => $palette['name'],
					'colors' => $palette['colors'],
				);
			}

			return Sydney_Abilities_Response::success(
				/* translators: %d: number of palettes. */
				sprintf( _n( '%d color palette available.', '%d color palettes available.', count( $palettes ), 'sydney' ), count( $palettes ) ),
				array( 'palettes' => $palettes )
			);
		}

		/**
		 * Sanitize + write the supplied global color slots, then propagate the new
		 * hexes to every linked literal mod. Shared by execute_update_global_colors()
		 * and execute_apply_color_palette() so propagation can never be skipped.
		 *
		 * @param array $colors Map of slot id => hex/rgba string.
		 * @return array { @type string[] $updated, @type array $ignored }
		 */
		public function apply_global_colors( $colors ) {
			$map       = $this->get_colors_map();
			$updated   = array();
			$ignored   = array();
			$propagate = array();

			foreach ( (array) $colors as $slot => $value ) {
				if ( ! isset( $map[ $slot ] ) ) {
					$ignored[] = array(
						'key'    => $slot,
						'reason' => 'unknown key',
					);
					continue; // No raw key access.
				}

				// Shape-check before the sanitizer: its sscanf branch would turn
				// "rgb…" garbage into rgb(0,0,0) and report it as updated.
				if ( ! Sydney_Ability::is_valid_color_shape( $value ) ) {
					$ignored[] = array(
						'key'    => $slot,
						'reason' => 'invalid value',
					);
					continue;
				}

				$setting          = new stdClass();
				$setting->default = $map[ $slot ]['default'];

				$clean = sydney_sanitize_hex_rgba( $value, $setting );

				if ( null === $clean ) {
					$ignored[] = array(
						'key'    => $slot,
						'reason' => 'invalid value',
					);
					continue;
				}

				$updated[]                               = $slot;
				$propagate[ $map[ $slot ]['theme_mod'] ] = $clean;
			}

			if ( ! empty( $propagate ) ) {
				// Slots + their linked literals in ONE database write.
				Sydney_Ability::set_theme_mods(
					array_merge( $propagate, Sydney_Color_References::resolve( $propagate ) )
				);
			}

			return array(
				'updated' => $updated,
				'ignored' => $ignored,
			);
		}

		/**
		 * Execute: update one or more global color slots.
		 *
		 * Delegates to apply_global_colors() for sanitize + write + propagate.
		 * Hard-errors only when no supplied slot is valid.
		 *
		 * @param array $args Ability args. Expects $args['colors'] => map.
		 * @return array Response envelope.
		 */
		public function execute_update_global_colors( $args ) {
			$input  = isset( $args['colors'] ) && is_array( $args['colors'] ) ? $args['colors'] : array();
			$result = $this->apply_global_colors( $input );

			$updated = $result['updated'];
			$ignored = $result['ignored'];

			if ( empty( $updated ) ) {
				return Sydney_Abilities_Response::error(
					__( 'No valid color slots were provided.', 'sydney' )
				);
			}

			/* translators: %d: number of color slots updated. */
			$message = sprintf( _n( '%d global color updated.', '%d global colors updated.', count( $updated ), 'sydney' ), count( $updated ) );

			if ( ! empty( $ignored ) ) {
				$ignored_keys = wp_list_pluck( $ignored, 'key' );
				$message     .= ' ' . sprintf(
					/* translators: %s: comma-separated list of ignored keys. */
					__( 'Ignored (not applied): %s.', 'sydney' ),
					implode( ', ', $ignored_keys )
				);
			}

			return Sydney_Abilities_Response::success(
				$message,
				array(
					'updated' => $updated,
					'ignored' => $ignored,
				)
			);
		}

		/**
		 * Execute: apply a named palette by id.
		 *
		 * @param array $args Ability args. Expects $args['palette_id'].
		 * @return array Response envelope.
		 */
		public function execute_apply_color_palette( $args ) {
			$palettes = $this->get_palettes_map();
			$id       = isset( $args['palette_id'] ) ? sanitize_text_field( (string) $args['palette_id'] ) : '';

			if ( '' === $id || ! isset( $palettes[ $id ] ) ) {
				return Sydney_Abilities_Response::error(
					__( 'Unknown palette_id. Call sydney/list-color-palettes for valid ids.', 'sydney' )
				);
			}

			$result = $this->apply_global_colors( $palettes[ $id ]['colors'] );

			if ( empty( $result['updated'] ) ) {
				return Sydney_Abilities_Response::error(
					__( 'The palette could not be applied.', 'sydney' )
				);
			}

			return Sydney_Abilities_Response::success(
				/* translators: %s: palette name. */
				sprintf( __( 'Applied the "%s" color palette.', 'sydney' ), $palettes[ $id ]['name'] ),
				array(
					'palette_id' => $id,
					'updated'    => $result['updated'],
				)
			);
		}
	}

endif;
