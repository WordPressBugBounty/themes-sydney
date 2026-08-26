<?php
/**
 * Social-links ability group: read and replace the profile-URL lists rendered
 * by the header/footer builder social component.
 *
 * Storage reality: each location is ONE comma-separated URL string theme_mod
 * (social_profiles_header / social_profiles_footer) that
 * sydney_social_profile() explodes at render time. The legacy topbar mod
 * (social_profiles_topbar) is intentionally NOT exposed. A URL matching no
 * network in sydney_get_social_networks() is stored but silently renders no
 * icon, so writes validate network recognition per URL up front.
 *
 * @package Sydney
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

require_once get_template_directory() . '/inc/abilities/customizer/class-sydney-hf-layout.php';

if ( ! class_exists( 'Sydney_Abilities_Social' ) ) :

	/**
	 * Sydney_Abilities_Social class.
	 */
	class Sydney_Abilities_Social {

		/**
		 * Cached social definition map.
		 *
		 * @var array|null
		 */
		protected $social_map = null;

		/**
		 * Load and cache the declarative social map.
		 *
		 * @return array
		 */
		protected function get_social_map() {
			if ( null === $this->social_map ) {
				$this->social_map = apply_filters( 'sydney_abilities_social_map', require get_template_directory() . '/inc/abilities/customizer/definitions-social.php' );
			}
			return $this->social_map;
		}

		/**
		 * Register social-links abilities (read always, write when allowed).
		 */
		public function register() {
			$this->register_get_social_links();
			$this->register_update_social_links();
		}

		/**
		 * Register sydney/get-social-links (read).
		 */
		protected function register_get_social_links() {
			$location_schema = array(
				'type'       => 'object',
				'properties' => array(
					'links'            => array(
						'type'  => 'array',
						'items' => array(
							'type'       => 'object',
							'properties' => array(
								'url'     => array( 'type' => 'string' ),
								'network' => array(
									'type'        => 'string',
									'description' => 'Detected network id; empty string when the URL matches no supported network (no icon renders).',
								),
							),
						),
					),
					'component_placed' => array(
						'type'        => 'boolean',
						'description' => 'Whether the social component is placed in this area of the header/footer builder layout. Links are invisible until it is placed (sydney/add-hf-component).',
					),
				),
			);

			Sydney_Ability::register(
				'sydney/get-social-links',
				array(
					'label'            => __( 'Get social links', 'sydney' ),
					'description'      => __( 'Read the social profile URLs rendered by the header and footer builder social component, whether that component is currently placed in each area, and the list of supported networks. Call before sydney/update-social-links.', 'sydney' ),
					'input_schema'     => array( 'type' => 'object' ),
					'output_schema'    => Sydney_Ability::envelope_schema(
						array(
							'header'             => $location_schema,
							'footer'             => $location_schema,
							'supported_networks' => array(
								'type'  => 'array',
								'items' => array( 'type' => 'string' ),
							),
						)
					),
					'execute_callback' => array( $this, 'execute_get_social_links' ),
					'meta'             => array(
						'annotations' => Sydney_Ability::READ_ANNOTATIONS,
					),
				)
			);
		}

		/**
		 * Register sydney/update-social-links (write).
		 */
		protected function register_update_social_links() {
			$urls_schema = array(
				'type'        => 'array',
				'items'       => array( 'type' => 'string' ),
				'description' => 'Full replacement list of profile URLs for this location. Pass [] to remove all links; omit the location to leave it unchanged.',
			);

			Sydney_Ability::register(
				'sydney/update-social-links',
				array(
					'write'            => true, // ADR-0002: not registered while writes are off.
					'label'            => __( 'Update social links', 'sydney' ),
					'description'      => __( 'Replace the social profile URLs shown by the header/footer builder social component. Full-replace per location: call sydney/get-social-links first and send the complete new list. Every URL must belong to a supported network or it is ignored (it would render no icon). Icons render only where the Social component is placed in a header or footer builder row.', 'sydney' ),
					'input_schema'     => array(
						'type'                 => 'object',
						'additionalProperties' => false,
						'properties'           => array(
							'header' => $urls_schema,
							'footer' => $urls_schema,
						),
					),
					'output_schema'    => Sydney_Ability::envelope_schema(
						array(
							'updated' => array(
								'type'  => 'array',
								'items' => array( 'type' => 'string' ),
							),
							'ignored' => array(
								'type'  => 'array',
								'items' => array(
									'type'       => 'object',
									'properties' => array(
										'location' => array( 'type' => 'string' ),
										'url'      => array( 'type' => 'string' ),
										'reason'   => array(
											'type' => 'string',
											'enum' => array( 'invalid url', 'unrecognized network' ),
										),
									),
								),
							),
						)
					),
					'execute_callback' => array( $this, 'execute_update_social_links' ),
					'meta'             => array(
						'annotations' => Sydney_Ability::WRITE_ANNOTATIONS,
					),
				)
			);
		}

		/**
		 * Execute: read both locations' links, placement, and supported networks.
		 *
		 * @param array $args Ability args (unused).
		 * @return array Response envelope.
		 */
		public function execute_get_social_links( $args ) {
			$map  = $this->get_social_map();
			$data = array();

			foreach ( $map as $location => $entry ) {
				$raw   = (string) get_theme_mod( $entry['theme_mod'], $entry['default'] );
				$links = array();

				foreach ( array_filter( array_map( 'trim', explode( ',', $raw ) ) ) as $url ) {
					$network = sydney_get_social_network( $url );
					$links[] = array(
						'url'     => $url,
						'network' => $network ? $network : '',
					);
				}

				$data[ $location ] = array(
					'links'            => $links,
					'component_placed' => $this->is_social_component_placed( $location ),
				);
			}

			$data['supported_networks'] = sydney_get_social_networks();

			return Sydney_Abilities_Response::success(
				__( 'Social links retrieved.', 'sydney' ),
				$data
			);
		}

		/**
		 * Execute: full-replace the URL list per provided location.
		 *
		 * Valid URLs are applied; invalid/unrecognized ones are reported in
		 * ignored[]. A location whose provided list is non-empty but yields no
		 * valid URL is skipped entirely — never cleared by accident; only an
		 * explicit [] clears.
		 *
		 * @param array $args Ability args. Optional 'header' and/or 'footer' URL arrays.
		 * @return array Response envelope.
		 */
		public function execute_update_social_links( $args ) {
			$map     = $this->get_social_map();
			$updated = array();
			$ignored = array();
			$mods    = array();

			foreach ( $map as $location => $entry ) {
				if ( ! is_array( $args ) || ! array_key_exists( $location, $args ) ) {
					continue;
				}

				$urls = $args[ $location ];

				if ( ! is_array( $urls ) ) {
					return Sydney_Abilities_Response::error(
						/* translators: %s: location key (header or footer). */
						sprintf( __( '"%s" must be an array of profile URLs.', 'sydney' ), $location )
					);
				}

				$valid = array();

				foreach ( $urls as $url ) {
					$raw   = is_string( $url ) ? trim( $url ) : '';
					$clean = '' !== $raw ? esc_url_raw( $raw ) : '';

					// A comma would corrupt the comma-separated storage string.
					if ( '' === $clean || false !== strpos( $clean, ',' ) ) {
						$ignored[] = array(
							'location' => $location,
							'url'      => is_string( $url ) ? $url : '',
							'reason'   => 'invalid url',
						);
						continue;
					}

					if ( ! sydney_get_social_network( $clean ) ) {
						$ignored[] = array(
							'location' => $location,
							'url'      => $url,
							'reason'   => 'unrecognized network',
						);
						continue;
					}

					$valid[] = $clean;
				}

				if ( empty( $valid ) && ! empty( $urls ) ) {
					continue; // Nothing valid for this location — leave existing links untouched.
				}

				$mods[ $entry['theme_mod'] ] = sydney_sanitize_urls( implode( ',', $valid ) );
				$updated[]                   = $location;
			}

			if ( empty( $updated ) && empty( $ignored ) ) {
				return Sydney_Abilities_Response::error(
					__( 'Provide "header" and/or "footer" with an array of profile URLs.', 'sydney' )
				);
			}

			if ( empty( $updated ) ) {
				return Sydney_Abilities_Response::error(
					__( 'No valid social profile URLs were provided; nothing was changed.', 'sydney' ),
					array( 'ignored' => $ignored )
				);
			}

			Sydney_Ability::set_theme_mods( $mods );

			return Sydney_Abilities_Response::success(
				__( 'Social links updated.', 'sydney' ),
				array(
					'updated' => $updated,
					'ignored' => $ignored,
				)
			);
		}

		/**
		 * Whether the social component is placed anywhere in an area's layout.
		 *
		 * @param string $area 'header' or 'footer'.
		 * @return bool
		 */
		protected function is_social_component_placed( $area ) {
			$rows = Sydney_HF_Layout::rows_for_area();

			if ( empty( $rows[ $area ] ) ) {
				return false;
			}

			foreach ( $rows[ $area ] as $row ) {
				$layout = Sydney_HF_Layout::load( $area, $row );

				foreach ( $layout as $columns ) {
					foreach ( $columns as $column ) {
						if ( in_array( 'social', $column, true ) ) {
							return true;
						}
					}
				}
			}

			return false;
		}
	}

endif;
