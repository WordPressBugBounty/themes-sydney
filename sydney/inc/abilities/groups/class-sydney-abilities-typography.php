<?php
/**
 * Typography ability group: registers and executes sydney/get-typography and
 * sydney/update-typography (fonts / extras / sizes) from the declarative
 * typography definition map.
 *
 * @package Sydney
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Sydney_Abilities_Typography' ) ) :

	/**
	 * Sydney_Abilities_Typography class.
	 */
	class Sydney_Abilities_Typography {

		/**
		 * Cached typography definition map.
		 *
		 * @var array|null
		 */
		protected $typography_map = null;

		/**
		 * Load and cache the declarative typography map.
		 *
		 * @return array
		 */
		protected function get_typography_map() {
			if ( null === $this->typography_map ) {
				$this->typography_map = apply_filters( 'sydney_abilities_typography_map', require get_template_directory() . '/inc/abilities/customizer/definitions-typography.php' );
			}
			return $this->typography_map;
		}

		/**
		 * Cached typography pair catalog.
		 *
		 * @var array|null
		 */
		protected $pairs_map = null;

		/**
		 * Load and cache the named typography-pair catalog.
		 *
		 * @return array
		 */
		protected function get_pairs_map() {
			if ( null === $this->pairs_map ) {
				$this->pairs_map = apply_filters( 'sydney_abilities_typography_pairs', require get_template_directory() . '/inc/abilities/customizer/definitions-typography-pairs.php' );
			}
			return $this->pairs_map;
		}

		/**
		 * Register the typography abilities (read always, write when allowed).
		 */
		public function register() {

			Sydney_Ability::register(
				'sydney/get-typography',
				array(
					'label'            => __( 'Get typography', 'sydney' ),
					'description'      => __( 'Read body and headings fonts, style extras, and responsive font sizes. Use before sydney/update-typography.', 'sydney' ),
					'input_schema'     => array(
						'type'       => 'object',
						'properties' => new stdClass(),
					),
					'output_schema'    => Sydney_Ability::envelope_schema(
						array(
									'fonts'  => array( 'type' => 'object' ),
									'extras' => array( 'type' => 'object' ),
									'sizes'  => array( 'type' => 'object' ),
						)
					),
					'execute_callback' => array( $this, 'execute_get_typography' ),
					'meta'             => array(
						'annotations' => Sydney_Ability::READ_ANNOTATIONS,
					),
				)
			);

			Sydney_Ability::register(
				'sydney/list-typography-pairs',
				array(
					'label'            => __( 'List typography pairs', 'sydney' ),
					'description'      => __( 'List Sydney\'s named heading+body font pairs (id, name, label, families, weights). Offer one by name, then apply it with sydney/apply-typography-pair.', 'sydney' ),
					'input_schema'     => array(
						'type'       => 'object',
						'properties' => new stdClass(),
					),
					'output_schema'    => Sydney_Ability::envelope_schema(
						array(
									'pairs' => array( 'type' => 'array' ),
						)
					),
					'execute_callback' => array( $this, 'execute_list_typography_pairs' ),
					'meta'             => array(
						'annotations' => Sydney_Ability::READ_ANNOTATIONS,
					),
				)
			);

			Sydney_Ability::register(
				'sydney/apply-typography-pair',
				array(
					'write' => true,
					'label'            => __( 'Apply typography pair', 'sydney' ),
					'description'      => __( 'Apply one of Sydney\'s named heading+body font pairs (see sydney/list-typography-pairs). If importing a starter site, run the import FIRST — the import overwrites fonts.', 'sydney' ),
					'input_schema'     => array(
						'type'                 => 'object',
						'required'             => array( 'pair_id' ),
						'additionalProperties' => false,
						'properties'           => array(
							'pair_id' => array(
								'type'        => 'string',
								'description' => 'A pair id from sydney/list-typography-pairs, e.g. "editorial".',
							),
						),
					),
					'output_schema'    => Sydney_Ability::envelope_schema(
						array(
									'pair_id' => array( 'type' => 'string' ),
									'updated' => array(
										'type'  => 'array',
										'items' => array( 'type' => 'string' ),
									),
						)
					),
					'execute_callback' => array( $this, 'execute_apply_typography_pair' ),
					'meta'             => array(
						'annotations' => Sydney_Ability::WRITE_ANNOTATIONS,
					),
				)
			);

			Sydney_Ability::register(
				'sydney/update-typography',
				array(
					'write' => true,
					'label'            => __( 'Update typography', 'sydney' ),
					'description'      => __( 'Set body/headings fonts, style extras, and responsive font sizes. Any field may be omitted to leave it unchanged. Call sydney/get-typography first to see current values. Unknown keys or invalid values are skipped and returned in data.ignored — they do not fail the call.', 'sydney' ),
					'input_schema'     => array(
						'type'                 => 'object',
						'additionalProperties' => false, // Top-level only: reject any property other than fonts/extras/sizes. The inner section maps stay open-ended (agent-supplied setting/group ids), guarded by the callback allow-list + ignored[] contract.
						'properties'           => array(
							'fonts'  => array(
								'type'        => 'object',
								'description' => 'Font FAMILY settings only. Styling such as letter spacing, line height, font style, and text transform/decoration does NOT belong here — put those in "extras". Provide "body" and/or "headings".',
								'properties'  => array(
									'body'     => array(
										'type'        => 'object',
										'description' => 'Body font family. Family fields only; no styling keys.',
										'properties'  => array(
											'font'          => array(
												'type'        => 'string',
												'description' => 'Font family name, e.g. "Roboto" or "System default".',
											),
											'regularweight' => array(
												'type'        => 'string',
												'description' => 'Regular weight, e.g. "regular" or "400".',
											),
											'category'      => array(
												'type'        => 'string',
												'description' => 'Font category, e.g. "sans-serif".',
											),
											'extraweights'  => array(
												'type'        => 'array',
												'description' => 'Optional extra weights to load.',
												'items'       => array( 'type' => 'string' ),
											),
										),
									),
									'headings' => array(
										'type'        => 'object',
										'description' => 'Headings font family (same shape as body). Family fields only; no styling keys.',
										'properties'  => array(
											'font'          => array( 'type' => 'string' ),
											'regularweight' => array( 'type' => 'string' ),
											'category'      => array( 'type' => 'string' ),
											'extraweights'  => array(
												'type'  => 'array',
												'items' => array( 'type' => 'string' ),
											),
										),
									),
								),
							),
							'extras' => array(
								'type'        => 'object',
								'description' => 'Style extras. This is where letter spacing, line height, font style, and text transform/decoration live (NOT in "fonts"). Use these exact keys; line-height and letter-spacing are unitless numbers, the rest are enums. Any key may be omitted.',
								'properties'  => array(
									'body_font_style'          => array(
										'type' => 'string',
										'enum' => array( 'normal', 'italic', 'oblique' ),
									),
									'body_line_height'         => array(
										'type'        => 'number',
										'description' => 'Unitless line height, e.g. 1.7.',
									),
									'body_letter_spacing'      => array(
										'type'        => 'number',
										'description' => 'Letter spacing in px as a number (no unit), e.g. 2.',
									),
									'body_text_transform'      => array(
										'type' => 'string',
										'enum' => array( 'none', 'capitalize', 'lowercase', 'uppercase' ),
									),
									'body_text_decoration'     => array(
										'type' => 'string',
										'enum' => array( 'none', 'underline', 'line-through' ),
									),
									'headings_font_style'      => array(
										'type' => 'string',
										'enum' => array( 'normal', 'italic', 'oblique' ),
									),
									'headings_line_height'     => array(
										'type'        => 'number',
										'description' => 'Unitless line height, e.g. 1.2.',
									),
									'headings_letter_spacing'  => array(
										'type'        => 'number',
										'description' => 'Letter spacing in px as a number (no unit), e.g. 2.',
									),
									'headings_text_transform'  => array(
										'type' => 'string',
										'enum' => array( 'none', 'capitalize', 'lowercase', 'uppercase' ),
									),
									'headings_text_decoration' => array(
										'type' => 'string',
										'enum' => array( 'none', 'underline', 'line-through' ),
									),
								),
							),
							'sizes'  => array(
								'type'        => 'object',
								'description' => 'Optional responsive size groups (body, h1..h6), each a {desktop, tablet, mobile} object of integers.',
							),
						),
					),
					'output_schema'    => Sydney_Ability::envelope_schema( Sydney_Ability::updated_ignored_properties() ),
					'execute_callback' => array( $this, 'execute_update_typography' ),
					'meta'             => array(
						'annotations' => Sydney_Ability::WRITE_ANNOTATIONS,
					),
				)
			);
		}

		/**
		 * Execute: read all typography settings.
		 *
		 * @param array $args Ability args (unused).
		 * @return array Response envelope.
		 */
		public function execute_get_typography( $args ) {
			$map = $this->get_typography_map();

			// Fonts: decode JSON theme_mods into objects.
			$fonts = array();
			foreach ( $map['fonts'] as $name => $entry ) {
				$raw            = get_theme_mod( $entry['theme_mod'], $entry['default'] );
				$decoded        = json_decode( $raw, true );
				$fonts[ $name ] = is_array( $decoded ) ? $decoded : json_decode( $entry['default'], true );
			}

			// Extras: scalar theme_mods.
			$extras = array();
			foreach ( $map['extras'] as $name => $entry ) {
				$extras[ $name ] = get_theme_mod( $entry['theme_mod'], $entry['default'] );
			}

			// Sizes: each group returned as {desktop,tablet,mobile}.
			$sizes = array();
			foreach ( $map['sizes'] as $group => $entry ) {
				$bucket = array();
				foreach ( $entry['keys'] as $breakpoint => $theme_mod ) {
					$bucket[ $breakpoint ] = get_theme_mod( $theme_mod, $entry['defaults'][ $breakpoint ] );
				}
				$sizes[ $group ] = $bucket;
			}

			return Sydney_Abilities_Response::success(
				__( 'Typography retrieved.', 'sydney' ),
				array(
					'fonts'  => $fonts,
					'extras' => $extras,
					'sizes'  => $sizes,
				)
			);
		}

		/**
		 * Execute: list the named typography pairs.
		 *
		 * @param array $args Ability args (unused).
		 * @return array Response envelope.
		 */
		public function execute_list_typography_pairs( $args ) {
			$map   = $this->get_pairs_map();
			$pairs = array();

			foreach ( $map as $id => $pair ) {
				$pairs[] = array_merge( array( 'id' => (string) $id ), $pair );
			}

			return Sydney_Abilities_Response::success(
				/* translators: %d: number of pairs. */
				sprintf( _n( '%d typography pair available.', '%d typography pairs available.', count( $pairs ), 'sydney' ), count( $pairs ) ),
				array( 'pairs' => $pairs )
			);
		}

		/**
		 * Execute: apply a named typography pair by id.
		 *
		 * Writes the heading and body font theme_mods as the
		 * {font,regularweight,category} JSON Sydney expects. The category is
		 * per-pair from the definitions (serif pairs carry 'serif' — styles.php
		 * uses it as the CSS fallback family).
		 *
		 * @param array $args Ability args. Expects $args['pair_id'].
		 * @return array Response envelope.
		 */
		public function execute_apply_typography_pair( $args ) {
			$pairs = $this->get_pairs_map();
			$id    = isset( $args['pair_id'] ) ? sanitize_text_field( (string) $args['pair_id'] ) : '';

			if ( '' === $id || ! isset( $pairs[ $id ] ) ) {
				return Sydney_Abilities_Response::error(
					__( 'Unknown pair_id. Call sydney/list-typography-pairs for valid ids.', 'sydney' )
				);
			}

			$pair = $pairs[ $id ];

			$heading_json = wp_json_encode(
				array(
					'font'          => $pair['heading_font'],
					'regularweight' => $pair['heading_weight'],
					'category'      => isset( $pair['heading_category'] ) ? $pair['heading_category'] : 'sans-serif',
				)
			);
			$body_json    = wp_json_encode(
				array(
					'font'          => $pair['body_font'],
					'regularweight' => $pair['body_weight'],
					'category'      => isset( $pair['body_category'] ) ? $pair['body_category'] : 'sans-serif',
				)
			);

			Sydney_Ability::set_theme_mods(
				array(
					'sydney_headings_font' => sydney_google_fonts_sanitize( $heading_json ),
					'sydney_body_font'     => sydney_google_fonts_sanitize( $body_json ),
				)
			);

			return Sydney_Abilities_Response::success(
				/* translators: %s: typography pair label. */
				sprintf( __( 'Applied the "%s" typography pair.', 'sydney' ), $pair['label'] ),
				array(
					'pair_id' => $id,
					'updated' => array( 'headings', 'body' ),
				)
			);
		}

		/**
		 * Execute: update typography settings (fonts / extras / sizes).
		 *
		 * Any top-level section may be omitted. Within a section any field may be
		 * omitted to leave it unchanged. Preflight-validates every supplied key and
		 * writes only the fully-valid ones; unknown keys (reason "unknown key") and
		 * known enum keys with a bad value (reason "invalid value") are collected
		 * into $ignored and never written (no raw key access). The call hard-errors
		 * only when nothing is valid. Size breakpoints are validated per-breakpoint:
		 * an invalid breakpoint ignores only that flat *_font_size_* key while the
		 * other breakpoints in the group are still written.
		 *
		 * @param array $args Ability args.
		 * @return array Response envelope.
		 */
		public function execute_update_typography( $args ) {
			$map     = $this->get_typography_map();
			$updated = array();
			$ignored = array();
			$pending = array(); // theme_mod => value, flushed as one write.

			// --- Fonts: re-encode each supplied font object via the google fonts sanitizer.
			$font_keys = array( 'font', 'regularweight', 'category', 'extraweights' );
			if ( isset( $args['fonts'] ) && is_array( $args['fonts'] ) ) {
				foreach ( $args['fonts'] as $name => $value ) {
					if ( ! isset( $map['fonts'][ $name ] ) ) {
						$ignored[] = array(
							'key'    => $name,
							'reason' => 'unknown key',
						);
						continue; // No raw key access.
					}
					if ( ! is_array( $value ) ) {
						$ignored[] = array(
							'key'    => $name,
							'reason' => 'invalid value',
						);
						continue;
					}
					// A font object must carry at least one recognized family key
					// (font/regularweight/category/extraweights). An object with none
					// of these is malformed — e.g. a style property like letter_spacing
					// misplaced here — and must NOT overwrite the font with junk; reject
					// it into ignored[] instead. Partial updates (any one key) still pass.
					if ( ! array_intersect( $font_keys, array_keys( $value ) ) ) {
						$ignored[] = array(
							'key'    => $name,
							'reason' => 'invalid value',
						);
						continue;
					}
					// Merge the partial object over the stored JSON (or the map
					// default when unset/corrupt) so omitted keys — regularweight,
					// category — survive a partial update.
					$entry   = $map['fonts'][ $name ];
					$current = json_decode( (string) get_theme_mod( $entry['theme_mod'], $entry['default'] ), true );
					if ( ! is_array( $current ) ) {
						$current = json_decode( $entry['default'], true );
					}
					$json  = wp_json_encode( array_merge( $current, $value ) );
					$clean = sydney_google_fonts_sanitize( $json );

					$pending[ $entry['theme_mod'] ] = $clean;

					$updated[] = $name; // Caller-facing key, matching ignored[].
				}
			}

			// --- Extras: enum fields validated against their allow-list; numbers stored as sanitized strings.
			if ( isset( $args['extras'] ) && is_array( $args['extras'] ) ) {
				foreach ( $args['extras'] as $name => $value ) {
					if ( ! isset( $map['extras'][ $name ] ) ) {
						$ignored[] = array(
							'key'    => $name,
							'reason' => 'unknown key',
						);
						continue; // No raw key access.
					}
					$entry = $map['extras'][ $name ];

					if ( 'enum' === $entry['type'] ) {
						if ( ! in_array( $value, $entry['enum'], true ) ) {
							$ignored[] = array(
								'key'    => $name,
								'reason' => 'invalid value',
							);
							continue; // Bad enum value — ignored, not a hard error.
						}
						$clean = $value;
					} else {
						// number: line_height / letter_spacing — stored as strings via the
						// Customizer's own sanitizer so a read after write round-trips.
						$clean = sydney_sanitize_text( (string) $value );
					}

					$pending[ $entry['theme_mod'] ] = $clean;

					$updated[] = $name; // Caller-facing key, matching ignored[].
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
						// Non-numeric or negative values are ignored, never
						// absint()'d to 0.
						if ( ! is_numeric( $value ) || $value < 0 ) {
							$ignored[] = array(
								'key'    => $group . '.' . $breakpoint,
								'reason' => 'invalid value',
							);
							continue;
						}
						$pending[ $keys[ $breakpoint ] ] = absint( $value );

						$updated[] = $group . '.' . $breakpoint; // Caller-facing key.
					}
				}
			}

			if ( empty( $updated ) ) {
				return Sydney_Abilities_Response::error(
					__( 'No valid typography fields were provided.', 'sydney' )
				);
			}

			// All valid fields in ONE database write.
			Sydney_Ability::set_theme_mods( $pending );

			$message = __( 'Typography updated.', 'sydney' );

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
