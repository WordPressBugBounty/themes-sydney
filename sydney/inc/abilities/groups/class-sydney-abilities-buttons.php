<?php
/**
 * Button styles ability group: registers and executes sydney/get-button-styles
 * and sydney/update-button-styles (colors / responsive paddings + font size /
 * corner radius) from the declarative buttons definition map.
 *
 * @package Sydney
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Sydney_Abilities_Buttons' ) ) :

	/**
	 * Sydney_Abilities_Buttons class.
	 */
	class Sydney_Abilities_Buttons {

		/**
		 * Cached buttons definition map.
		 *
		 * @var array|null
		 */
		protected $buttons_map = null;

		/**
		 * Load and cache the declarative buttons map.
		 *
		 * @return array
		 */
		protected function get_buttons_map() {
			if ( null === $this->buttons_map ) {
				$this->buttons_map = apply_filters( 'sydney_abilities_buttons_map', require get_template_directory() . '/inc/abilities/customizer/definitions-buttons.php' );
			}
			return $this->buttons_map;
		}

		/**
		 * Register the button styles abilities (read always, write when allowed).
		 */
		public function register() {

			Sydney_Ability::register(
				'sydney/get-button-styles',
				array(
					'label'            => __( 'Get button styles', 'sydney' ),
					'description'      => __( 'Read button colors (default + hover background/text/border), responsive paddings and font size, and corner radius. Each color reports whether it is linked to a global palette slot, which overrides the literal value. Use before sydney/update-button-styles.', 'sydney' ),
					'input_schema'     => array(
						'type'       => 'object',
						'properties' => new stdClass(),
					),
					'output_schema'    => Sydney_Ability::envelope_schema(
						array(
									'colors' => array( 'type' => 'object' ),
									'sizes'  => array( 'type' => 'object' ),
									'radius' => array( 'type' => 'integer' ),
						)
					),
					'execute_callback' => array( $this, 'execute_get_button_styles' ),
					'meta'             => array(
						'annotations' => Sydney_Ability::READ_ANNOTATIONS,
					),
				)
			);

			Sydney_Ability::register(
				'sydney/update-button-styles',
				array(
					'write' => true,
					'label'            => __( 'Update button styles', 'sydney' ),
					'description'      => __( 'Set button colors (default + hover background/text/border), responsive paddings and font size, and corner radius. Setting a color also unlinks it from any global palette slot so the literal value renders. Any field may be omitted to leave it unchanged. Call sydney/get-button-styles first to see current values. Unknown keys or invalid values are skipped and returned in data.ignored — they do not fail the call.', 'sydney' ),
					'input_schema'     => array(
						'type'                 => 'object',
						'additionalProperties' => false, // Top-level only: reject anything other than colors/sizes/radius. The colors map stays open-ended (callback allow-list + ignored[] contract); sizes is agent-supplied groups/breakpoints.
						'properties'           => array(
							'colors' => array(
								'type'        => 'object',
								'description' => 'Literal button colors. Setting any of these clears that color\'s link to a global palette slot so the literal value always renders. Each value is a hex (#rrggbb) or rgba() color string; an empty string is invalid input (it neither resets the color nor clears the global link). Any key may be omitted.',
								'properties'  => array(
									'background'       => array(
										'type'        => 'string',
										'description' => 'Default-state background color.',
									),
									'text'             => array(
										'type'        => 'string',
										'description' => 'Default-state text color.',
									),
									'border'           => array(
										'type'        => 'string',
										'description' => 'Default-state border color.',
									),
									'background_hover' => array(
										'type'        => 'string',
										'description' => 'Hover-state background color.',
									),
									'text_hover'       => array(
										'type'        => 'string',
										'description' => 'Hover-state text color.',
									),
									'border_hover'     => array(
										'type'        => 'string',
										'description' => 'Hover-state border color.',
									),
								),
							),
							'sizes'  => array(
								'type'        => 'object',
								'description' => 'Responsive size groups, each a {desktop, tablet, mobile} object of integer px values. Groups: top_bottom_padding (0-50), left_right_padding (0-50), font_size (0-50). Any group or breakpoint may be omitted.',
							),
							'radius' => array(
								'type'        => 'integer',
								'description' => 'Button corner radius in px (0-100). Applies to all breakpoints (not responsive).',
							),
						),
					),
					'output_schema'    => Sydney_Ability::envelope_schema( Sydney_Ability::updated_ignored_properties() ),
					'execute_callback' => array( $this, 'execute_update_button_styles' ),
					'meta'             => array(
						'annotations' => Sydney_Ability::WRITE_ANNOTATIONS,
					),
				)
			);
		}

		/**
		 * Execute: read all button style settings.
		 *
		 * @param array $args Ability args (unused).
		 * @return array Response envelope.
		 */
		public function execute_get_button_styles( $args ) {
			$map = $this->get_buttons_map();

			// Colors: report the literal value plus whether a global palette slot is
			// connected. A connected slot is authoritative at render
			// (Sydney_Custom_CSS::resolve_global_color_mod()), so the literal is
			// dormant until the link is cleared.
			$colors = array();
			foreach ( $map['colors'] as $key => $entry ) {
				$global    = get_theme_mod( $entry['global_mod'], '' );
				$connected = ( is_string( $global ) && 0 === strpos( $global, 'global_color_' ) ) ? $global : '';

				$colors[ $key ] = array(
					'value'     => get_theme_mod( $entry['theme_mod'], $entry['default'] ),
					'connected' => $connected,
					'role'      => $entry['role'],
				);
			}

			// Sizes: each responsive group returned as {desktop,tablet,mobile}.
			$sizes = array();
			foreach ( $map['sizes'] as $group => $entry ) {
				$bucket = array();
				foreach ( $entry['keys'] as $breakpoint => $theme_mod ) {
					$bucket[ $breakpoint ] = get_theme_mod( $theme_mod, $entry['defaults'][ $breakpoint ] );
				}
				$sizes[ $group ] = $bucket;
			}

			$radius = get_theme_mod( $map['radius']['theme_mod'], $map['radius']['default'] );

			return Sydney_Abilities_Response::success(
				__( 'Button styles retrieved.', 'sydney' ),
				array(
					'colors' => $colors,
					'sizes'  => $sizes,
					'radius' => $radius,
				)
			);
		}

		/**
		 * Execute: update button style settings (colors / sizes / radius).
		 *
		 * Any section may be omitted; within a section any field may be omitted to
		 * leave it unchanged. Preflight-validates every supplied key and writes only
		 * the valid ones; unknown keys (reason "unknown key") and colors that fail
		 * sanitization (reason "invalid value") are collected into $ignored and never
		 * written (no raw key access). A written color also clears its global_*
		 * companion so the literal value renders. The call hard-errors only when
		 * nothing is valid. Size breakpoints are validated per-breakpoint: an unknown
		 * breakpoint ignores only that flat key while the rest of the group is written.
		 *
		 * @param array $args Ability args.
		 * @return array Response envelope.
		 */
		public function execute_update_button_styles( $args ) {
			$map     = $this->get_buttons_map();
			$updated = array();
			$ignored = array();
			$pending = array(); // theme_mod => value, flushed as one write.

			// --- Colors: sanitize each supplied color; on success write the literal
			// and clear its global link so the literal value renders.
			if ( isset( $args['colors'] ) && is_array( $args['colors'] ) ) {
				foreach ( $args['colors'] as $key => $value ) {
					if ( ! isset( $map['colors'][ $key ] ) ) {
						$ignored[] = array(
							'key'    => $key,
							'reason' => 'unknown key',
						);
						continue; // No raw key access.
					}

					// Shape-check before the sanitizer: its sscanf branch would turn
					// "rgb…" garbage into rgb(0,0,0) and report it as updated.
					if ( ! Sydney_Ability::is_valid_color_shape( $value ) ) {
						$ignored[] = array(
							'key'    => $key,
							'reason' => 'invalid value',
						);
						continue;
					}

					$entry            = $map['colors'][ $key ];
					$setting          = new stdClass();
					$setting->default = $entry['default'];

					$clean = sydney_sanitize_hex_rgba( $value, $setting );

					// A malformed color sanitizes to null; reject it into ignored[]
					// rather than writing a corrupting null (mirrors the global colors
					// write path).
					if ( null === $clean ) {
						$ignored[] = array(
							'key'    => $key,
							'reason' => 'invalid value',
						);
						continue;
					}

					$pending[ $entry['theme_mod'] ]  = $clean;
					$pending[ $entry['global_mod'] ] = ''; // disconnect from any global slot.

					$updated[] = $key;
				}
			}

			// --- Sizes: fan {desktop,tablet,mobile} out to three flat mods (absint).
			if ( isset( $args['sizes'] ) && is_array( $args['sizes'] ) ) {
				foreach ( $args['sizes'] as $group => $breakpoints ) {
					if ( ! isset( $map['sizes'][ $group ] ) || ! is_array( $breakpoints ) ) {
						$ignored[] = array(
							'key'    => $group,
							'reason' => 'unknown key',
						);
						continue; // No raw key access.
					}
					$keys = $map['sizes'][ $group ]['keys'];
					foreach ( $breakpoints as $breakpoint => $value ) {
						if ( ! isset( $keys[ $breakpoint ] ) ) {
							$ignored[] = array(
								'key'    => $group . '.' . $breakpoint,
								'reason' => 'unknown key',
							);
							continue; // Unknown breakpoint name.
						}
						// Schema promise: integer px, 0-50. Non-numeric or
						// out-of-range values are ignored, never absint()'d to 0.
						if ( ! is_numeric( $value ) || $value < 0 || $value > 50 ) {
							$ignored[] = array(
								'key'    => $group . '.' . $breakpoint,
								'reason' => 'invalid value',
							);
							continue;
						}
						$pending[ $keys[ $breakpoint ] ] = absint( $value );

						$updated[] = $group . '.' . $breakpoint;
					}
				}
			}

			// --- Radius: single (non-responsive) scalar. Schema promise: 0-100.
			if ( isset( $args['radius'] ) ) {
				if ( ! is_numeric( $args['radius'] ) || $args['radius'] < 0 || $args['radius'] > 100 ) {
					$ignored[] = array(
						'key'    => 'radius',
						'reason' => 'invalid value',
					);
				} else {
					$pending[ $map['radius']['theme_mod'] ] = absint( $args['radius'] );

					$updated[] = 'radius';
				}
			}

			if ( empty( $updated ) ) {
				return Sydney_Abilities_Response::error(
					__( 'No valid button style fields were provided.', 'sydney' )
				);
			}

			// All valid fields in ONE database write.
			Sydney_Ability::set_theme_mods( $pending );

			$message = __( 'Button styles updated.', 'sydney' );

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
	}

endif;
