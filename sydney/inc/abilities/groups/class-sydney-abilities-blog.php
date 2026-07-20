<?php
/**
 * Blog / archive layout ability group: read and update how post listings render.
 *
 * Storage reality: all fixed theme_mods on the blog-archives Customizer section
 * — blog_layout (layout1..6), archives_grid_columns (2/3/4), show_excerpt
 * (checkbox), exc_lenght (int), read_more_link (checkbox), and
 * archive_meta_elements (ordered subset). Closed schema: every accepted field
 * is known and validated up front, so a bad value fails the whole call rather
 * than silently dropping (only archive_meta_elements is a list, sanitized via
 * the theme's own sydney_sanitize_blog_meta_elements).
 *
 * @package Sydney
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Sydney_Abilities_Blog' ) ) :

	/**
	 * Sydney_Abilities_Blog class.
	 */
	class Sydney_Abilities_Blog {

		/**
		 * Valid blog_layout values.
		 */
		const LAYOUTS = array( 'layout1', 'layout2', 'layout3', 'layout4', 'layout5', 'layout6' );

		/**
		 * Valid archives_grid_columns values.
		 */
		const COLUMNS = array( 2, 3, 4 );

		/**
		 * Valid archive_meta_elements values (also enforced by the theme sanitizer).
		 */
		const META_ELEMENTS = array( 'post_date', 'post_author', 'post_categories', 'post_comments', 'post_tags' );

		/**
		 * Register blog-layout abilities (read always, write when allowed).
		 */
		public function register() {
			$this->register_get_blog_layout();
			$this->register_update_blog_layout();
		}

		/**
		 * Register sydney/get-blog-layout (read).
		 */
		protected function register_get_blog_layout() {
			Sydney_Ability::register(
				'sydney/get-blog-layout',
				array(
					'label'            => __( 'Get blog layout', 'sydney' ),
					'description'      => __( 'Read the blog/archive listing layout: layout style, number of grid columns, whether post content shows, excerpt length, the read-more link, and which post-meta elements appear. Call before sydney/update-blog-layout.', 'sydney' ),
					'input_schema'     => array( 'type' => 'object' ),
					'output_schema'    => Sydney_Ability::envelope_schema(
						array(
							'layout'         => array( 'type' => 'string' ),
							'columns'        => array( 'type' => 'integer' ),
							'show_content'   => array( 'type' => 'boolean' ),
							'excerpt_length' => array( 'type' => 'integer' ),
							'read_more_link' => array( 'type' => 'boolean' ),
							'meta_elements'  => array(
								'type'  => 'array',
								'items' => array( 'type' => 'string' ),
							),
							'available'      => array(
								'type'        => 'object',
								'description' => 'Allowed values for layout, columns and meta_elements.',
							),
						)
					),
					'execute_callback' => array( $this, 'execute_get_blog_layout' ),
					'meta'             => array(
						'annotations' => Sydney_Ability::READ_ANNOTATIONS,
					),
				)
			);
		}

		/**
		 * Register sydney/update-blog-layout (write).
		 */
		protected function register_update_blog_layout() {
			Sydney_Ability::register(
				'sydney/update-blog-layout',
				array(
					'write'            => true, // ADR-0002: not registered while writes are off.
					'label'            => __( 'Update blog layout', 'sydney' ),
					'description'      => __( 'Update the blog/archive listing layout. Provide any subset of fields; omitted fields are left unchanged. layout: layout1 (Classic), layout2 (Classic 2), layout3 (Grid), layout4 (List), layout5 (Masonry), layout6 (List zig-zag). columns: 2, 3 or 4. meta_elements is a full-replacement ordered list.', 'sydney' ),
					'input_schema'     => array(
						'type'                 => 'object',
						'additionalProperties' => false,
						'properties'           => array(
							'layout'         => array(
								'type' => 'string',
								'enum' => self::LAYOUTS,
							),
							'columns'        => array(
								'type' => 'integer',
								'enum' => self::COLUMNS,
							),
							'show_content'   => array(
								'type'        => 'boolean',
								'description' => 'Whether each post shows its excerpt/content in the listing.',
							),
							'excerpt_length' => array(
								'type'    => 'integer',
								'minimum' => 0,
								'maximum' => 120,
							),
							'read_more_link' => array( 'type' => 'boolean' ),
							'meta_elements'  => array(
								'type'  => 'array',
								'items' => array(
									'type' => 'string',
									'enum' => self::META_ELEMENTS,
								),
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
					'execute_callback' => array( $this, 'execute_update_blog_layout' ),
					'meta'             => array(
						'annotations' => Sydney_Ability::WRITE_ANNOTATIONS,
					),
				)
			);
		}

		/**
		 * Execute: report the current blog-layout settings.
		 *
		 * @param array $args Ability args (unused).
		 * @return array Response envelope.
		 */
		public function execute_get_blog_layout( $args ) {
			$meta = get_theme_mod( 'archive_meta_elements', array( 'post_date', 'post_categories' ) );

			return Sydney_Abilities_Response::success(
				__( 'Blog layout retrieved.', 'sydney' ),
				array(
					'layout'         => (string) get_theme_mod( 'blog_layout', 'layout2' ),
					'columns'        => (int) get_theme_mod( 'archives_grid_columns', 3 ),
					'show_content'   => (bool) get_theme_mod( 'show_excerpt', 1 ),
					'excerpt_length' => (int) get_theme_mod( 'exc_lenght', 22 ),
					'read_more_link' => (bool) get_theme_mod( 'read_more_link', 0 ),
					'meta_elements'  => array_values( (array) $meta ),
					'available'      => array(
						'layout'        => self::LAYOUTS,
						'columns'       => self::COLUMNS,
						'meta_elements' => self::META_ELEMENTS,
					),
				)
			);
		}

		/**
		 * Execute: validate and apply blog-layout settings.
		 *
		 * Fail-fast on any invalid field (closed schema, no ignored[]); all valid
		 * provided fields are written in one theme_mods update. Checkboxes store
		 * 1/'' to mirror sydney_sanitize_checkbox.
		 *
		 * @param array $args Ability args.
		 * @return array Response envelope.
		 */
		public function execute_update_blog_layout( $args ) {
			$mods    = array();
			$updated = array();

			if ( array_key_exists( 'layout', $args ) ) {
				if ( ! in_array( $args['layout'], self::LAYOUTS, true ) ) {
					return Sydney_Abilities_Response::error(
						__( 'layout must be one of layout1..layout6.', 'sydney' )
					);
				}
				$mods['blog_layout'] = $args['layout'];
				$updated[]           = 'layout';
			}

			if ( array_key_exists( 'columns', $args ) ) {
				if ( ! in_array( $args['columns'], self::COLUMNS, true ) ) {
					return Sydney_Abilities_Response::error(
						__( 'columns must be 2, 3 or 4.', 'sydney' )
					);
				}
				// archives_grid_columns stores as a string radio value.
				$mods['archives_grid_columns'] = (string) $args['columns'];
				$updated[]                      = 'columns';
			}

			if ( array_key_exists( 'show_content', $args ) ) {
				if ( ! is_bool( $args['show_content'] ) ) {
					return Sydney_Abilities_Response::error(
						__( 'show_content must be a boolean.', 'sydney' )
					);
				}
				$mods['show_excerpt'] = $args['show_content'] ? 1 : '';
				$updated[]            = 'show_content';
			}

			if ( array_key_exists( 'excerpt_length', $args ) ) {
				if ( ! is_int( $args['excerpt_length'] ) || $args['excerpt_length'] < 0 || $args['excerpt_length'] > 120 ) {
					return Sydney_Abilities_Response::error(
						__( 'excerpt_length must be an integer between 0 and 120.', 'sydney' )
					);
				}
				$mods['exc_lenght'] = $args['excerpt_length'];
				$updated[]          = 'excerpt_length';
			}

			if ( array_key_exists( 'read_more_link', $args ) ) {
				if ( ! is_bool( $args['read_more_link'] ) ) {
					return Sydney_Abilities_Response::error(
						__( 'read_more_link must be a boolean.', 'sydney' )
					);
				}
				$mods['read_more_link'] = $args['read_more_link'] ? 1 : '';
				$updated[]              = 'read_more_link';
			}

			if ( array_key_exists( 'meta_elements', $args ) ) {
				if ( ! is_array( $args['meta_elements'] ) ) {
					return Sydney_Abilities_Response::error(
						__( 'meta_elements must be an array.', 'sydney' )
					);
				}
				foreach ( $args['meta_elements'] as $element ) {
					if ( ! in_array( $element, self::META_ELEMENTS, true ) ) {
						return Sydney_Abilities_Response::error(
							/* translators: %s: the invalid meta element value. */
							sprintf( __( 'meta_elements contains an unsupported value: %s.', 'sydney' ), is_string( $element ) ? $element : gettype( $element ) )
						);
					}
				}
				// Theme sanitizer re-validates and preserves order.
				$mods['archive_meta_elements'] = sydney_sanitize_blog_meta_elements( $args['meta_elements'] );
				$updated[]                     = 'meta_elements';
			}

			if ( empty( $updated ) ) {
				return Sydney_Abilities_Response::error(
					__( 'Provide at least one field to update (layout, columns, show_content, excerpt_length, read_more_link, meta_elements).', 'sydney' )
				);
			}

			Sydney_Ability::set_theme_mods( $mods );

			return Sydney_Abilities_Response::success(
				__( 'Blog layout updated.', 'sydney' ),
				array( 'updated' => $updated )
			);
		}
	}

endif;
