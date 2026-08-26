<?php
/**
 * WooCommerce shop ability group: read and update the product catalog's
 * layout, sidebar, and product-card structure.
 *
 * Conditional group: register() is a no-op unless WooCommerce is active — the
 * backing theme mods only render inside the WooCommerce templates, so exposing
 * writes without the plugin would be silent no-ops.
 *
 * Storage reality (all on the woocommerce_product_catalog Customizer section):
 * shop_archive_layout (product-grid/product-list), shop_archive_sidebar
 * (no-sidebar/sidebar-left/sidebar-right), shop_product_card_style
 * (layout1..3), shop_card_elements (ordered subset of loop hook names —
 * exposed here under friendly keys), swc_loop_product_alignment
 * (left/center/right), shop_product_add_to_cart_layout (layout1/2). Card
 * colors, radii and spacing are styling knobs and intentionally not exposed.
 *
 * @package Sydney
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Sydney_Abilities_Shop' ) ) :

	/**
	 * Sydney_Abilities_Shop class.
	 */
	class Sydney_Abilities_Shop {

		/**
		 * Caller-facing layout => stored shop_archive_layout value.
		 */
		const LAYOUTS = array(
			'grid' => 'product-grid',
			'list' => 'product-list',
		);

		/**
		 * Caller-facing sidebar => stored shop_archive_sidebar value.
		 */
		const SIDEBARS = array(
			'none'  => 'no-sidebar',
			'left'  => 'sidebar-left',
			'right' => 'sidebar-right',
		);

		/**
		 * Valid shop_product_card_style values.
		 */
		const CARD_STYLES = array( 'layout1', 'layout2', 'layout3' );

		/**
		 * Valid shop_product_add_to_cart_layout values.
		 */
		const CART_LAYOUTS = array( 'layout1', 'layout2' );

		/**
		 * Valid swc_loop_product_alignment values.
		 */
		const ALIGNMENTS = array( 'left', 'center', 'right' );

		/**
		 * Caller-facing card element => stored loop hook name.
		 */
		const ELEMENTS = array(
			'title'       => 'woocommerce_template_loop_product_title',
			'reviews'     => 'woocommerce_template_loop_rating',
			'price'       => 'woocommerce_template_loop_price',
			'category'    => 'sydney_loop_product_category',
			'description' => 'sydney_loop_product_description',
		);

		/**
		 * Cached shop definition map.
		 *
		 * @var array|null
		 */
		protected $shop_map = null;

		/**
		 * Load and cache the declarative shop map.
		 *
		 * @return array
		 */
		protected function get_shop_map() {
			if ( null === $this->shop_map ) {
				$this->shop_map = apply_filters( 'sydney_abilities_shop_map', require get_template_directory() . '/inc/abilities/customizer/definitions-shop.php' );
			}
			return $this->shop_map;
		}

		/**
		 * Register shop abilities (read always, write when allowed) — only when
		 * WooCommerce is active.
		 */
		public function register() {
			if ( ! $this->is_woocommerce_active() ) {
				return;
			}

			$this->register_get_shop();
			$this->register_update_shop();
		}

		/**
		 * Whether WooCommerce is active. Overridable for tests.
		 *
		 * @return bool
		 */
		protected function is_woocommerce_active() {
			return class_exists( 'WooCommerce' );
		}

		/**
		 * Register sydney/get-shop (read).
		 */
		protected function register_get_shop() {
			Sydney_Ability::register(
				'sydney/get-shop',
				array(
					'label'            => __( 'Get shop settings', 'sydney' ),
					'description'      => __( 'Read the WooCommerce product catalog settings: layout (grid or list), sidebar position, product-card style, which card elements show and in what order, card text alignment, and the add-to-cart button layout. Call before sydney/update-shop.', 'sydney' ),
					'input_schema'     => array( 'type' => 'object' ),
					'output_schema'    => Sydney_Ability::envelope_schema(
						array(
							'layout'             => array( 'type' => 'string' ),
							'sidebar'            => array( 'type' => 'string' ),
							'card_style'         => array( 'type' => 'string' ),
							'card_elements'      => array(
								'type'  => 'array',
								'items' => array( 'type' => 'string' ),
							),
							'card_alignment'     => array( 'type' => 'string' ),
							'add_to_cart_layout' => array( 'type' => 'string' ),
							'available'          => array(
								'type'        => 'object',
								'description' => 'Allowed values for every field.',
							),
						)
					),
					'execute_callback' => array( $this, 'execute_get_shop' ),
					'meta'             => array(
						'annotations' => Sydney_Ability::READ_ANNOTATIONS,
					),
				)
			);
		}

		/**
		 * Register sydney/update-shop (write).
		 */
		protected function register_update_shop() {
			Sydney_Ability::register(
				'sydney/update-shop',
				array(
					'write'            => true, // ADR-0002: not registered while writes are off.
					'label'            => __( 'Update shop settings', 'sydney' ),
					'description'      => __( 'Update the WooCommerce product catalog. Provide any subset of fields; omitted fields are left unchanged. layout: grid or list. sidebar: none, left or right. card_style: layout1-3. card_elements is a full-replacement ordered list (title, reviews, price, category, description). add_to_cart_layout: layout1 or layout2.', 'sydney' ),
					'input_schema'     => array(
						'type'                 => 'object',
						'additionalProperties' => false,
						'properties'           => array(
							'layout'             => array(
								'type' => 'string',
								'enum' => array_keys( self::LAYOUTS ),
							),
							'sidebar'            => array(
								'type' => 'string',
								'enum' => array_keys( self::SIDEBARS ),
							),
							'card_style'         => array(
								'type' => 'string',
								'enum' => self::CARD_STYLES,
							),
							'card_elements'      => array(
								'type'  => 'array',
								'items' => array(
									'type' => 'string',
									'enum' => array_keys( self::ELEMENTS ),
								),
							),
							'card_alignment'     => array(
								'type' => 'string',
								'enum' => self::ALIGNMENTS,
							),
							'add_to_cart_layout' => array(
								'type' => 'string',
								'enum' => self::CART_LAYOUTS,
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
					'execute_callback' => array( $this, 'execute_update_shop' ),
					'meta'             => array(
						'annotations' => Sydney_Ability::WRITE_ANNOTATIONS,
					),
				)
			);
		}

		/**
		 * Execute: report the current shop settings.
		 *
		 * @param array $args Ability args (unused).
		 * @return array Response envelope.
		 */
		public function execute_get_shop( $args ) {
			$map     = $this->get_shop_map();
			$layout  = (string) get_theme_mod( $map['layout']['theme_mod'], $map['layout']['default'] );
			$sidebar = (string) get_theme_mod( $map['sidebar']['theme_mod'], $map['sidebar']['default'] );

			$stored_elements = (array) get_theme_mod(
				$map['card_elements']['theme_mod'],
				$map['card_elements']['default']
			);

			$hooks_to_keys = array_flip( self::ELEMENTS );
			$elements      = array();
			foreach ( $stored_elements as $hook ) {
				// Map known hooks to friendly keys; pass unknown values through
				// so the read stays faithful to storage.
				$elements[] = isset( $hooks_to_keys[ $hook ] ) ? $hooks_to_keys[ $hook ] : (string) $hook;
			}

			$layout_key  = array_search( $layout, self::LAYOUTS, true );
			$sidebar_key = array_search( $sidebar, self::SIDEBARS, true );

			return Sydney_Abilities_Response::success(
				__( 'Shop settings retrieved.', 'sydney' ),
				array(
					'layout'             => false !== $layout_key ? $layout_key : $layout,
					'sidebar'            => false !== $sidebar_key ? $sidebar_key : $sidebar,
					'card_style'         => (string) get_theme_mod( $map['card_style']['theme_mod'], $map['card_style']['default'] ),
					'card_elements'      => $elements,
					'card_alignment'     => (string) get_theme_mod( $map['card_alignment']['theme_mod'], $map['card_alignment']['default'] ),
					'add_to_cart_layout' => (string) get_theme_mod( $map['add_to_cart_layout']['theme_mod'], $map['add_to_cart_layout']['default'] ),
					'available'          => array(
						'layout'             => array_keys( self::LAYOUTS ),
						'sidebar'            => array_keys( self::SIDEBARS ),
						'card_style'         => self::CARD_STYLES,
						'card_elements'      => array_keys( self::ELEMENTS ),
						'card_alignment'     => self::ALIGNMENTS,
						'add_to_cart_layout' => self::CART_LAYOUTS,
					),
				)
			);
		}

		/**
		 * Execute: validate and apply shop settings.
		 *
		 * Fail-fast on any invalid field (closed schema, no ignored[]); all valid
		 * provided fields are written in one theme_mods update.
		 *
		 * @param array $args Ability args.
		 * @return array Response envelope.
		 */
		public function execute_update_shop( $args ) {
			$map     = $this->get_shop_map();
			$mods    = array();
			$updated = array();

			if ( array_key_exists( 'layout', $args ) ) {
				if ( ! isset( self::LAYOUTS[ $args['layout'] ] ) ) {
					return Sydney_Abilities_Response::error(
						__( 'layout must be "grid" or "list".', 'sydney' )
					);
				}
				$mods[ $map['layout']['theme_mod'] ] = self::LAYOUTS[ $args['layout'] ];
				$updated[]                           = 'layout';
			}

			if ( array_key_exists( 'sidebar', $args ) ) {
				if ( ! isset( self::SIDEBARS[ $args['sidebar'] ] ) ) {
					return Sydney_Abilities_Response::error(
						__( 'sidebar must be "none", "left" or "right".', 'sydney' )
					);
				}
				$mods[ $map['sidebar']['theme_mod'] ] = self::SIDEBARS[ $args['sidebar'] ];
				$updated[]                            = 'sidebar';
			}

			if ( array_key_exists( 'card_style', $args ) ) {
				if ( ! in_array( $args['card_style'], self::CARD_STYLES, true ) ) {
					return Sydney_Abilities_Response::error(
						__( 'card_style must be one of layout1, layout2, layout3.', 'sydney' )
					);
				}
				$mods[ $map['card_style']['theme_mod'] ] = $args['card_style'];
				$updated[]                               = 'card_style';
			}

			if ( array_key_exists( 'card_elements', $args ) ) {
				if ( ! is_array( $args['card_elements'] ) ) {
					return Sydney_Abilities_Response::error(
						__( 'card_elements must be an array.', 'sydney' )
					);
				}

				$hooks = array();
				foreach ( $args['card_elements'] as $element ) {
					if ( ! is_string( $element ) || ! isset( self::ELEMENTS[ $element ] ) ) {
						return Sydney_Abilities_Response::error(
							/* translators: %s: the invalid card element value. */
							sprintf( __( 'card_elements contains an unsupported value: %s. Valid: title, reviews, price, category, description.', 'sydney' ), is_string( $element ) ? $element : gettype( $element ) )
						);
					}
					$hooks[] = self::ELEMENTS[ $element ];
				}

				$mods[ $map['card_elements']['theme_mod'] ] = $hooks;
				$updated[]                                  = 'card_elements';
			}

			if ( array_key_exists( 'card_alignment', $args ) ) {
				if ( ! in_array( $args['card_alignment'], self::ALIGNMENTS, true ) ) {
					return Sydney_Abilities_Response::error(
						__( 'card_alignment must be "left", "center" or "right".', 'sydney' )
					);
				}
				$mods[ $map['card_alignment']['theme_mod'] ] = $args['card_alignment'];
				$updated[]                                   = 'card_alignment';
			}

			if ( array_key_exists( 'add_to_cart_layout', $args ) ) {
				if ( ! in_array( $args['add_to_cart_layout'], self::CART_LAYOUTS, true ) ) {
					return Sydney_Abilities_Response::error(
						__( 'add_to_cart_layout must be "layout1" or "layout2".', 'sydney' )
					);
				}
				$mods[ $map['add_to_cart_layout']['theme_mod'] ] = $args['add_to_cart_layout'];
				$updated[]                                       = 'add_to_cart_layout';
			}

			if ( empty( $updated ) ) {
				return Sydney_Abilities_Response::error(
					__( 'Provide at least one field to update (layout, sidebar, card_style, card_elements, card_alignment, add_to_cart_layout).', 'sydney' )
				);
			}

			Sydney_Ability::set_theme_mods( $mods );

			return Sydney_Abilities_Response::success(
				__( 'Shop settings updated.', 'sydney' ),
				array( 'updated' => $updated )
			);
		}
	}

endif;
