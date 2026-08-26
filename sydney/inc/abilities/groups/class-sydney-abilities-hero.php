<?php
/**
 * Front-page hero ability group: read the hero configuration and change the
 * hero TYPE (front page and other pages).
 *
 * Storage reality: front_header_type and site_header_type are radio theme_mods
 * (slider / image / core-video / nothing), sanitized by sydney_sanitize_layout.
 * By design this group only *writes* the type — slide images/text, header
 * height, and the overlay are not exposed as writes; header_height and
 * hide_overlay are surfaced read-only for context.
 *
 * @package Sydney
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Sydney_Abilities_Hero' ) ) :

	/**
	 * Sydney_Abilities_Hero class.
	 */
	class Sydney_Abilities_Hero {

		/**
		 * Valid hero type values (mirrors sydney_sanitize_layout()'s allow-list).
		 */
		const TYPES = array( 'slider', 'image', 'core-video', 'nothing' );

		/**
		 * Cached hero definition map.
		 *
		 * @var array|null
		 */
		protected $hero_map = null;

		/**
		 * Load and cache the declarative hero map.
		 *
		 * @return array
		 */
		protected function get_hero_map() {
			if ( null === $this->hero_map ) {
				$this->hero_map = apply_filters( 'sydney_abilities_hero_map', require get_template_directory() . '/inc/abilities/customizer/definitions-hero.php' );
			}
			return $this->hero_map;
		}

		/**
		 * Register hero abilities (read always, write when allowed).
		 */
		public function register() {
			$this->register_get_hero();
			$this->register_update_hero();
		}

		/**
		 * Register sydney/get-hero (read).
		 */
		protected function register_get_hero() {
			Sydney_Ability::register(
				'sydney/get-hero',
				array(
					'label'            => __( 'Get hero settings', 'sydney' ),
					'description'      => __( 'Read the hero (front-page banner, separate from the nav header): the hero type for the front page and for other pages, the configured header height, and whether the overlay is hidden. Call before sydney/update-hero.', 'sydney' ),
					'input_schema'     => array( 'type' => 'object' ),
					'output_schema'    => Sydney_Ability::envelope_schema(
						array(
							'front_page_type' => array(
								'type' => 'string',
								'enum' => self::TYPES,
							),
							'site_type'       => array(
								'type' => 'string',
								'enum' => self::TYPES,
							),
							'header_height'   => array( 'type' => 'integer' ),
							'overlay_hidden'  => array( 'type' => 'boolean' ),
							'available_types' => array(
								'type'  => 'array',
								'items' => array( 'type' => 'string' ),
							),
						)
					),
					'execute_callback' => array( $this, 'execute_get_hero' ),
					'meta'             => array(
						'annotations' => Sydney_Ability::READ_ANNOTATIONS,
					),
				)
			);
		}

		/**
		 * Register sydney/update-hero (write). Type-only by design.
		 */
		protected function register_update_hero() {
			Sydney_Ability::register(
				'sydney/update-hero',
				array(
					'write'            => true, // ADR-0002: not registered while writes are off.
					'label'            => __( 'Update hero type', 'sydney' ),
					'description'      => __( 'Set the hero type for the front page and/or all other pages. Values: "slider" (full-screen slider), "image" (header image), "core-video" (video), "nothing" (menu only). Omitted fields are left unchanged. Only the hero type can be changed here — slide content, height and overlay are not affected.', 'sydney' ),
					'input_schema'     => array(
						'type'                 => 'object',
						'additionalProperties' => false,
						'properties'           => array(
							'front_page_type' => array(
								'type' => 'string',
								'enum' => self::TYPES,
							),
							'site_type'       => array(
								'type' => 'string',
								'enum' => self::TYPES,
							),
						),
					),
					'output_schema'    => Sydney_Ability::envelope_schema(
						array(
							'updated' => array(
								'type'  => 'array',
								'items' => array( 'type' => 'string' ),
							),
						)
					),
					'execute_callback' => array( $this, 'execute_update_hero' ),
					'meta'             => array(
						'annotations' => Sydney_Ability::WRITE_ANNOTATIONS,
					),
				)
			);
		}

		/**
		 * Execute: report the hero configuration.
		 *
		 * @param array $args Ability args (unused).
		 * @return array Response envelope.
		 */
		public function execute_get_hero( $args ) {
			$map = $this->get_hero_map();

			return Sydney_Abilities_Response::success(
				__( 'Hero settings retrieved.', 'sydney' ),
				array(
					'front_page_type' => (string) get_theme_mod( $map['front_page_type']['theme_mod'], $map['front_page_type']['default'] ),
					'site_type'       => (string) get_theme_mod( $map['site_type']['theme_mod'], $map['site_type']['default'] ),
					'header_height'   => (int) get_theme_mod( $map['header_height']['theme_mod'], $map['header_height']['default'] ),
					'overlay_hidden'  => (bool) get_theme_mod( $map['overlay_hidden']['theme_mod'], $map['overlay_hidden']['default'] ),
					'available_types' => self::TYPES,
				)
			);
		}

		/**
		 * Execute: set the front-page and/or site hero type.
		 *
		 * @param array $args Ability args. Optional front_page_type / site_type.
		 * @return array Response envelope.
		 */
		public function execute_update_hero( $args ) {
			$map = $this->get_hero_map();

			$fields = array( 'front_page_type', 'site_type' );

			$mods    = array();
			$updated = array();

			foreach ( $fields as $field ) {
				if ( ! array_key_exists( $field, $args ) ) {
					continue;
				}

				if ( ! in_array( $args[ $field ], self::TYPES, true ) ) {
					return Sydney_Abilities_Response::error(
						/* translators: %s: the field name (front_page_type or site_type). */
						sprintf( __( '%s must be one of: slider, image, core-video, nothing.', 'sydney' ), $field )
					);
				}

				$mods[ $map[ $field ]['theme_mod'] ] = $args[ $field ];
				$updated[]                           = $field;
			}

			if ( empty( $updated ) ) {
				return Sydney_Abilities_Response::error(
					__( 'Provide "front_page_type" and/or "site_type".', 'sydney' )
				);
			}

			Sydney_Ability::set_theme_mods( $mods );

			return Sydney_Abilities_Response::success(
				__( 'Hero type updated.', 'sydney' ),
				array( 'updated' => $updated )
			);
		}
	}

endif;
