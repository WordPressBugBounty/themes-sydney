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
		 * Whether this site runs Sydney Pro, which owns Dark mode.
		 *
		 * @return bool
		 */
		protected function dark_mode_available() {
			return defined( 'SYDNEY_PRO_VERSION' ) && class_exists( 'Sydney_Pro_Color_Scheme' );
		}

		/**
		 * The Requires-Pro result for Dark mode input on a free site.
		 *
		 * @return array Response envelope.
		 */
		protected function dark_mode_requires_pro() {
			return Sydney_Abilities_Response::error(
				__( 'Dark mode requires Sydney Pro.', 'sydney' ),
				array( 'status' => 'requires_pro' )
			);
		}

		/**
		 * Theme mod holding a slot's Dark palette value.
		 *
		 * @param string $slot Caller-facing slot id, e.g. global_color_3.
		 * @return string e.g. dark_color_3, or '' for a slot with no dark value.
		 */
		protected function dark_slot_mod( $slot ) {
			if ( preg_match( '/^global_color_(\d+)$/', $slot, $match ) ) {
				return 'dark_color_' . $match[1];
			}

			if ( preg_match( '/^extra_global_color_(\d+)$/', $slot, $match ) ) {
				return 'dark_extra_color_' . $match[1];
			}

			return '';
		}

		/**
		 * The Dark mode settings in an update request.
		 *
		 * @param array $args Ability args.
		 * @return array { @type array $mods, @type string[] $updated, @type array $ignored }
		 */
		protected function dark_mode_settings( $args ) {
			$mods    = array();
			$updated = array();
			$ignored = array();

			if ( array_key_exists( 'dark_mode', $args ) ) {
				$mods['dark_mode_enable'] = filter_var( $args['dark_mode'], FILTER_VALIDATE_BOOLEAN ) ? 1 : '';
				$updated[]                = 'dark_mode';
			}

			if ( array_key_exists( 'default_scheme', $args ) ) {
				if ( in_array( $args['default_scheme'], array( 'light', 'system' ), true ) ) {
					$mods['dark_mode_follow_system'] = 'system' === $args['default_scheme'] ? 1 : '';
					$updated[]                       = 'default_scheme';
				} else {
					$ignored[] = array(
						'key'    => 'default_scheme',
						'reason' => 'invalid value',
					);
				}
			}

			return array(
				'mods'    => $mods,
				'updated' => $updated,
				'ignored' => $ignored,
			);
		}

		/**
		 * Register the global colors abilities (read always, write when allowed).
		 */
		public function register() {

			Sydney_Ability::register(
				'sydney/get-global-colors',
				array(
					'label'            => __( 'Get global colors', 'sydney' ),
					'description'      => __( 'Read every global color palette slot and its semantic role. Use before sydney/update-global-colors to choose the right slot. On Sydney Pro it also returns the Dark palette and the Dark mode settings.', 'sydney' ),
					'input_schema'     => array(
						'type'       => 'object',
						'properties' => new stdClass(),
					),
					'output_schema'    => Sydney_Ability::envelope_schema(
						array(
									'colors'         => array( 'type' => 'object' ),
									'dark_colors'    => array( 'type' => 'object' ),
									'dark_mode'      => array( 'type' => array( 'boolean', 'object' ) ),
									'default_scheme' => array( 'type' => 'string' ),
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
					'description'      => __( 'List Sydney\'s named global-color palettes (id, name, per-slot hex values and, on Sydney Pro, the matching Dark palette). Use to offer the user a palette by name, then apply it with sydney/apply-color-palette.', 'sydney' ),
					'input_schema'     => array(
						'type'       => 'object',
						'properties' => new stdClass(),
					),
					'output_schema'    => Sydney_Ability::envelope_schema(
						array(
									'palettes' => array( 'type' => 'array' ),
									'dark_mode' => array( 'type' => 'object' ),
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
					'description'      => __( 'Change one or more of Sydney\'s 11 site-wide palette colors (accent, headings, body text, backgrounds, borders). Provide a "colors" map of slot id to a hex/rgba color (add scheme "dark" to set the Dark palette instead). Call sydney/get-global-colors first to see current values and each slot\'s role. Slots you omit are left unchanged. It can also turn Dark mode on and set its default scheme.', 'sydney' ),
					'input_schema'     => array(
						'type'                 => 'object',
						'additionalProperties' => false, // Top-level only: reject any property not listed. The inner `colors` map stays open-ended (agent-supplied slot ids), guarded by the callback allow-list + ignored[] contract.
						'properties'           => array(
							'colors' => array(
								'type'        => 'object',
								'description' => 'Map of palette slot id to a hex (#rrggbb) or rgba() color string. Roles: global_color_1 = primary/accent, global_color_2 = primary-hover/accent-dark, global_color_3 = secondary, global_color_4 = headings/dark, global_color_5 = body text, global_color_6 = body-text-strong, global_color_7 = light background, global_color_8 = borders/dividers, global_color_9 = base/white background, extra_global_color_1 and extra_global_color_2 = optional custom (render only if set). Unknown slots or values failing hex/rgba validation are skipped and returned in data.ignored — they do not fail the call. An empty string is invalid input, NOT a reset-to-default.',
							),
							'scheme'         => array(
								'type'        => 'string',
								'enum'        => array( 'light', 'dark' ),
								'default'     => 'light',
								'description' => 'Which palette "colors" writes: "light" (the default) or "dark", the Dark palette visitors see in the dark color scheme. Same slot ids for both. Dark needs Sydney Pro.',
							),
							'dark_mode'      => array(
								'type'        => 'boolean',
								'description' => 'Turn Dark mode on or off. Needs Sydney Pro.',
							),
							'default_scheme' => array(
								'type'        => 'string',
								'enum'        => array( 'light', 'system' ),
								'description' => 'What a visitor sees before picking a scheme: "light", or "system" to follow the visitor\'s operating system. Needs Sydney Pro.',
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
					'description'      => __( 'Apply one of Sydney\'s named color palettes (see sydney/list-color-palettes) to the whole site. Sets all global color slots (and, on Sydney Pro, the matching Dark palette) and propagates them to linked elements. If importing a starter site, run the import FIRST — the import overwrites theme colors.', 'sydney' ),
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
									'updated'      => array(
										'type'  => 'array',
										'items' => array( 'type' => 'string' ),
									),
									'dark_updated' => array(
										'type'  => 'array',
										'items' => array( 'type' => 'string' ),
									),
									'dark_mode'    => array( 'type' => 'object' ),
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

			$data = array( 'colors' => $colors );

			if ( $this->dark_mode_available() ) {
				$dark_defaults = Sydney_Pro_Color_Scheme::get_color_defaults();
				$dark          = array();

				foreach ( $map as $slot => $entry ) {
					$mod = $this->dark_slot_mod( $slot );

					if ( '' === $mod ) {
						continue;
					}

					$dark[ $slot ] = array(
						'value' => get_theme_mod( $mod, isset( $dark_defaults[ $mod ] ) ? $dark_defaults[ $mod ] : '' ),
						'role'  => $entry['role'],
					);
				}

				$data['dark_colors']    = $dark;
				$data['dark_mode']      = Sydney_Pro_Color_Scheme::is_enabled();
				$data['default_scheme'] = Sydney_Pro_Color_Scheme::get_default_scheme();
			} else {
				$data['dark_mode'] = array( 'requires_pro' => true );
			}

			return Sydney_Abilities_Response::success(
				__( 'Global colors retrieved.', 'sydney' ),
				$data
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
			$dark     = $this->dark_mode_available();
			$palettes = array();

			foreach ( $map as $id => $palette ) {
				$row = array(
					'id'     => (string) $id,
					'name'   => $palette['name'],
					'colors' => $palette['colors'],
				);

				if ( $dark && isset( $palette['dark_colors'] ) ) {
					$row['dark_colors'] = $palette['dark_colors'];
				}

				$palettes[] = $row;
			}

			$data = array( 'palettes' => $palettes );

			if ( ! $dark ) {
				$data['dark_mode'] = array( 'requires_pro' => true );
			}

			return Sydney_Abilities_Response::success(
				/* translators: %d: number of palettes. */
				sprintf( _n( '%d color palette available.', '%d color palettes available.', count( $palettes ), 'sydney' ), count( $palettes ) ),
				$data
			);
		}

		/**
		 * Shape-check and sanitize supplied slots.
		 *
		 * @param array $colors Map of slot id => hex/rgba string.
		 * @return array { @type array $clean slot => sanitized, @type array $ignored }
		 */
		protected function validate_colors( $colors ) {
			$map     = $this->get_colors_map();
			$clean   = array();
			$ignored = array();

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

				$sanitized = sydney_sanitize_hex_rgba( $value, $setting );

				if ( null === $sanitized ) {
					$ignored[] = array(
						'key'    => $slot,
						'reason' => 'invalid value',
					);
					continue;
				}

				$clean[ $slot ] = $sanitized;
			}

			return array(
				'clean'   => $clean,
				'ignored' => $ignored,
			);
		}

		/**
		 * Sanitize + write the supplied global color slots, then propagate the new
		 * hexes to every linked literal mod. Shared by execute_update_global_colors()
		 * and execute_apply_color_palette() so propagation can never be skipped.
		 *
		 * @param array $colors     Map of slot id => hex/rgba string.
		 * @param array $extra_mods Theme mods written in the same database write.
		 * @return array { @type string[] $updated, @type array $ignored }
		 */
		public function apply_global_colors( $colors, $extra_mods = array() ) {
			$map       = $this->get_colors_map();
			$validated = $this->validate_colors( $colors );
			$propagate = array();

			foreach ( $validated['clean'] as $slot => $clean ) {
				$propagate[ $map[ $slot ]['theme_mod'] ] = $clean;
			}

			$mods = empty( $propagate ) ? array() : array_merge( $propagate, Sydney_Color_References::resolve( $propagate ) );
			$mods = array_merge( $mods, $extra_mods );

			if ( ! empty( $mods ) ) {
				// Slots, their linked literals and any extra mods in ONE database write.
				Sydney_Ability::set_theme_mods( $mods );
			}

			return array(
				'updated' => array_keys( $validated['clean'] ),
				'ignored' => $validated['ignored'],
			);
		}

		/**
		 * Sanitize + write Dark palette slots. No propagation: nothing links to a
		 * dark slot, the scheme CSS reads them directly.
		 *
		 * @param array $colors     Map of slot id => hex/rgba string.
		 * @param array $extra_mods Theme mods written in the same database write.
		 * @return array { @type string[] $updated, @type array $ignored }
		 */
		public function apply_dark_colors( $colors, $extra_mods = array() ) {
			$validated = $this->validate_colors( $colors );
			$mods      = array();
			$updated   = array();
			$ignored   = $validated['ignored'];

			foreach ( $validated['clean'] as $slot => $clean ) {
				$mod = $this->dark_slot_mod( $slot );

				if ( '' === $mod ) {
					$ignored[] = array(
						'key'    => $slot,
						'reason' => 'unknown key',
					);
					continue;
				}

				$mods[ $mod ] = $clean;
				$updated[]    = $slot;
			}

			$mods = array_merge( $mods, $extra_mods );

			if ( ! empty( $mods ) ) {
				Sydney_Ability::set_theme_mods( $mods );
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
		 * @param array $args Ability args. Expects $args['colors'] => map, optional scheme, dark_mode and default_scheme.
		 * @return array Response envelope.
		 */
		public function execute_update_global_colors( $args ) {
			$args  = is_array( $args ) ? $args : array();
			$input = isset( $args['colors'] ) && is_array( $args['colors'] ) ? $args['colors'] : array();
			$dark  = isset( $args['scheme'] ) && 'dark' === $args['scheme'];

			if ( ( $dark || array_key_exists( 'dark_mode', $args ) || array_key_exists( 'default_scheme', $args ) ) && ! $this->dark_mode_available() ) {
				return $this->dark_mode_requires_pro();
			}

			$settings = $this->dark_mode_settings( $args );
			$result   = $dark
				? $this->apply_dark_colors( $input, $settings['mods'] )
				: $this->apply_global_colors( $input, $settings['mods'] );

			$updated = array_merge( $result['updated'], $settings['updated'] );
			$ignored = array_merge( $result['ignored'], $settings['ignored'] );

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

			// The catalog passes the sydney_abilities_color_palettes filter, so its
			// dark values are validated like any caller input.
			$dark_mods    = array();
			$dark_updated = array();

			if ( $this->dark_mode_available() && isset( $palettes[ $id ]['dark_colors'] ) ) {
				$dark = $this->validate_colors( $palettes[ $id ]['dark_colors'] );

				foreach ( $dark['clean'] as $slot => $clean ) {
					$mod = $this->dark_slot_mod( $slot );

					if ( '' === $mod ) {
						continue;
					}

					$dark_mods[ $mod ] = $clean;
					$dark_updated[]    = $slot;
				}
			}

			$result = $this->apply_global_colors( $palettes[ $id ]['colors'], $dark_mods );

			if ( empty( $result['updated'] ) ) {
				return Sydney_Abilities_Response::error(
					__( 'The palette could not be applied.', 'sydney' )
				);
			}

			$data = array(
				'palette_id' => $id,
				'updated'    => $result['updated'],
			);

			if ( ! empty( $dark_mods ) ) {
				$data['dark_updated'] = $dark_updated;
			} elseif ( ! $this->dark_mode_available() ) {
				$data['dark_mode'] = array( 'requires_pro' => true );
			}

			return Sydney_Abilities_Response::success(
				/* translators: %s: palette name. */
				sprintf( __( 'Applied the "%s" color palette.', 'sydney' ), $palettes[ $id ]['name'] ),
				$data
			);
		}
	}

endif;
