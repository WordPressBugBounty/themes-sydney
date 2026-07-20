<?php
/**
 * Header/Footer builder layout helper for Sydney abilities.
 *
 * Pure load / decode / mutate / encode / save logic over the builder's row
 * theme_mods. Mutations are array transforms with index clamping and validation
 * against the live component registry (Sydney_Header_Footer_Builder). Zone names
 * (left/center/right) alias to column indices 0/1/2, and loose component ids are
 * resolved via a normalization map so an agent can pass legible values.
 *
 * The row theme_mod keys mirror Sydney_Header_Footer_Builder's own construction
 * ('sydney_header_row__' . $row / 'sydney_footer_row__' . $row) so reads/writes
 * hit the exact option the builder renders from.
 *
 * @package Sydney
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Sydney_HF_Layout' ) ) :

	/**
	 * Sydney_HF_Layout class.
	 */
	class Sydney_HF_Layout {

		/**
		 * Devices a row can contain. Mirrors the builder's row JSON keys.
		 */
		const DEVICES = array( 'desktop', 'mobile', 'mobile_offcanvas' );

		/**
		 * Optional injected registry source (test seam).
		 *
		 * When set (via set_registry_override()), builder_registry() returns this
		 * instead of touching the live Sydney_Header_Footer_Builder. Tests inject a
		 * fixture object here so they NEVER occupy the real builder class name —
		 * PHPUnit shares one process and BaseThemeTest::loadThemeDependencies guards
		 * on `! class_exists`, so a stub under the real name would permanently
		 * starve the real HFBuilderTest. The fixture exposes the same shape the
		 * builder populates in set_components_data():
		 * { header_desktop, header_mobile, footer } arrays of {id,label}.
		 *
		 * @var array|object|null
		 */
		protected static $registry_override = null;

		/**
		 * Valid rows per area.
		 *
		 * Delegates to Sydney_Header_Footer_Builder::get_rows() (the canon) when
		 * the builder is loaded; the local fallback exists only so ability unit
		 * tests can run without the builder file. Fallback drift is pinned by
		 * AbilitiesHFBuilderCanonTest.
		 *
		 * @return array
		 */
		public static function rows_for_area() {
			if ( class_exists( 'Sydney_Header_Footer_Builder' ) && method_exists( 'Sydney_Header_Footer_Builder', 'get_rows' ) ) {
				return array(
					'header' => Sydney_Header_Footer_Builder::get_rows( 'header' ),
					'footer' => Sydney_Header_Footer_Builder::get_rows( 'footer' ),
				);
			}

			return array(
				'header' => array(
					'above_header_row',
					'main_header_row',
					'below_header_row',
					'mobile_offcanvas',
				),
				'footer' => array(
					'above_footer_row',
					'main_footer_row',
					'below_footer_row',
				),
			);
		}

		/**
		 * Zone-name to column-index alias map.
		 *
		 * @return array
		 */
		public static function zone_map() {
			return array(
				'left'   => 0,
				'center' => 1,
				'right'  => 2,
			);
		}

		/**
		 * Loose component-id normalization map (alias => canonical registry id).
		 *
		 * Only aliases are listed here. Canonical ids pass through untouched.
		 *
		 * @return array
		 */
		public static function id_alias_map() {
			/**
			 * Filters the component-id alias map so Sydney Pro / child themes
			 * can add aliases for their own components.
			 *
			 * @param array $aliases alias => canonical component id.
			 */
			return apply_filters(
				'sydney_abilities_hf_component_aliases',
				array(
					'hamburger'      => 'mobile_hamburger',
					'menu_toggle'    => 'mobile_hamburger',
					'offcanvas_menu' => 'mobile_offcanvas_menu',
					'primary_menu'   => 'menu',
					'nav'            => 'menu',
					'site_identity'  => 'logo',
					'site_logo'      => 'logo',
					'woocommerce'    => 'woo_icons',
					'woo'            => 'woo_icons',
					'cart'           => 'woo_icons',
					'contact'        => 'contact_info',
				)
			);
		}

		/**
		 * Build the row theme_mod key for an area + row.
		 *
		 * Delegates to the builder's canonical key builder when loaded; local
		 * fallback for builder-less unit tests (drift pinned by
		 * AbilitiesHFBuilderCanonTest).
		 *
		 * @param string $area 'header' or 'footer'.
		 * @param string $row  Row id.
		 * @return string
		 */
		public static function theme_mod_for_row( $area, $row ) {
			if ( class_exists( 'Sydney_Header_Footer_Builder' ) && method_exists( 'Sydney_Header_Footer_Builder', 'get_row_theme_mod_key' ) ) {
				return Sydney_Header_Footer_Builder::get_row_theme_mod_key( $row, $area );
			}

			$prefix = ( 'footer' === $area ) ? 'sydney_footer_row__' : 'sydney_header_row__';
			return $prefix . $row;
		}

		/**
		 * Whether a row id is valid for the given area.
		 *
		 * @param string $area Area.
		 * @param string $row  Row id.
		 * @return bool
		 */
		public static function is_valid_row( $area, $row ) {
			$rows = self::rows_for_area();
			return isset( $rows[ $area ] ) && in_array( $row, $rows[ $area ], true );
		}

		/**
		 * Devices a row actually renders on. Header rows render desktop +
		 * mobile, the offcanvas row only mobile_offcanvas, footer rows only
		 * desktop — writing any other device persists layout JSON the builder
		 * never reads.
		 *
		 * @param string $area Area.
		 * @param string $row  Row id.
		 * @return string[] Valid device ids (empty for an unknown row).
		 */
		public static function devices_for_row( $area, $row ) {
			if ( ! self::is_valid_row( $area, $row ) ) {
				return array();
			}

			if ( 'footer' === $area ) {
				return array( 'desktop' );
			}

			if ( 'mobile_offcanvas' === $row ) {
				return array( 'mobile_offcanvas' );
			}

			return array( 'desktop', 'mobile' );
		}

		/**
		 * Whether a device is valid for the given area + row.
		 *
		 * @param string $area   Area.
		 * @param string $row    Row id.
		 * @param string $device Device id.
		 * @return bool
		 */
		public static function is_valid_device_for_row( $area, $row, $device ) {
			return in_array( $device, self::devices_for_row( $area, $row ), true );
		}

		/**
		 * Resolve a column argument (zone name or integer) to a column index.
		 *
		 * @param string|int $column 'left'|'center'|'right' or 0..N.
		 * @return int|null Column index, or null if unresolvable.
		 */
		public static function resolve_column( $column ) {
			if ( is_string( $column ) ) {
				$zones = self::zone_map();
				$key   = strtolower( trim( $column ) );
				if ( isset( $zones[ $key ] ) ) {
					return $zones[ $key ];
				}
				if ( ctype_digit( $key ) ) {
					return (int) $key;
				}
				return null;
			}

			if ( is_int( $column ) && $column >= 0 ) {
				return $column;
			}

			return null;
		}

		/**
		 * Normalize a loose component id to its canonical registry id.
		 *
		 * Lowercases/trims, then applies the alias map. Unknown ids are returned
		 * lowercased-but-otherwise-untouched — the caller validates against the
		 * live registry (never invents a component).
		 *
		 * @param string $id Raw component id.
		 * @return string
		 */
		public static function normalize_component_id( $id ) {
			$key   = strtolower( trim( (string) $id ) );
			$alias = self::id_alias_map();
			return isset( $alias[ $key ] ) ? $alias[ $key ] : $key;
		}

		/**
		 * Inject a registry fixture for tests, or pass null to clear it.
		 *
		 * @param array|object|null $fixture A {header_desktop,header_mobile,footer}
		 *                                   array, or an object exposing
		 *                                   desktop_components / mobile_components /
		 *                                   footer_components, or null to reset.
		 * @return void
		 */
		public static function set_registry_override( $fixture ) {
			self::$registry_override = $fixture;
		}

		/**
		 * Pull the raw component registry from the live builder, keyed by set.
		 *
		 * Returns header_desktop / header_mobile / footer lists exactly as the
		 * builder populated them in set_components_data() (so the conditional
		 * woo_icons entry is present iff WooCommerce is active).
		 *
		 * If a test override has been injected via set_registry_override(), it is
		 * used in place of the live builder.
		 *
		 * set_components_data() is hooked to `init` priority -1 — NOT the
		 * constructor — so on REST/MCP requests the builder's component arrays can
		 * still be empty when an ability runs. We therefore call
		 * set_components_data() ourselves whenever the arrays are empty; otherwise
		 * add-hf-component validation would fail against an empty registry.
		 *
		 * @return array
		 */
		protected static function builder_registry() {
			// Test seam: an injected fixture short-circuits the live builder.
			if ( null !== self::$registry_override ) {
				$override = self::$registry_override;
				if ( is_array( $override ) ) {
					return array(
						'header_desktop' => isset( $override['header_desktop'] ) ? $override['header_desktop'] : array(),
						'header_mobile'  => isset( $override['header_mobile'] ) ? $override['header_mobile'] : array(),
						'footer'         => isset( $override['footer'] ) ? $override['footer'] : array(),
					);
				}
				return array(
					'header_desktop' => isset( $override->desktop_components ) ? $override->desktop_components : array(),
					'header_mobile'  => isset( $override->mobile_components ) ? $override->mobile_components : array(),
					'footer'         => isset( $override->footer_components ) ? $override->footer_components : array(),
				);
			}

			$registry = array(
				'header_desktop' => array(),
				'header_mobile'  => array(),
				'footer'         => array(),
			);

			if ( ! class_exists( 'Sydney_Header_Footer_Builder' ) ) {
				return $registry;
			}

			$shfb = Sydney_Header_Footer_Builder::get_instance();

			if ( method_exists( $shfb, 'get_components_registry' ) ) {
				// The builder's accessor self-populates outside the init hook
				// (REST/MCP request path).
				$data = $shfb->get_components_registry();

				return array(
					'header_desktop' => $data['desktop'],
					'header_mobile'  => $data['mobile'],
					'footer'         => $data['footer'],
				);
			}

			// Pre-accessor builder: populate the arrays ourselves if still empty.
			$empty = empty( $shfb->desktop_components ) && empty( $shfb->mobile_components ) && empty( $shfb->footer_components );
			if ( $empty && method_exists( $shfb, 'set_components_data' ) ) {
				$shfb->set_components_data();
			}

			if ( isset( $shfb->desktop_components ) && is_array( $shfb->desktop_components ) ) {
				$registry['header_desktop'] = $shfb->desktop_components;
			}
			if ( isset( $shfb->mobile_components ) && is_array( $shfb->mobile_components ) ) {
				$registry['header_mobile'] = $shfb->mobile_components;
			}
			if ( isset( $shfb->footer_components ) && is_array( $shfb->footer_components ) ) {
				$registry['footer'] = $shfb->footer_components;
			}

			return $registry;
		}

		/**
		 * Public accessor for the component registry (header_desktop /
		 * header_mobile / footer sets). Callers listing several area/device
		 * sets should fetch this once and pass it to available_components()'
		 * $registry param instead of re-entering the builder per set.
		 *
		 * @return array
		 */
		public static function registry() {
			return self::builder_registry();
		}

		/**
		 * Available components for an area + device, as a list of {id, label}.
		 *
		 * @param string     $area     'header' or 'footer'.
		 * @param string     $device   'desktop' | 'mobile' | 'mobile_offcanvas'.
		 * @param array|null $registry Optional injected registry (testing); pulled
		 *                             from the live builder when null.
		 * @return array
		 */
		public static function available_components( $area, $device, $registry = null ) {
			if ( null === $registry ) {
				$registry = self::builder_registry();
			}

			if ( 'footer' === $area ) {
				return isset( $registry['footer'] ) ? $registry['footer'] : array();
			}

			// Header: mobile_offcanvas is a mobile device, so it uses the mobile set.
			$set = ( 'desktop' === $device ) ? 'header_desktop' : 'header_mobile';

			return isset( $registry[ $set ] ) ? $registry[ $set ] : array();
		}

		/**
		 * Whether a (canonical) component id is allowed for an area + device.
		 *
		 * @param string     $component_id Canonical component id.
		 * @param string     $area         Area.
		 * @param string     $device       Device.
		 * @param array|null $registry     Optional injected registry (testing).
		 * @return bool
		 */
		public static function is_component_allowed( $component_id, $area, $device, $registry = null ) {
			$available = self::available_components( $area, $device, $registry );

			foreach ( $available as $entry ) {
				$id = is_array( $entry ) ? $entry['id'] : $entry;
				if ( $id === $component_id ) {
					return true;
				}
			}

			return false;
		}

		/**
		 * Default row JSON.
		 *
		 * Delegates to Sydney_Header_Footer_Builder::get_row_default_value() (the
		 * canon) when the builder is loaded; the fallback mirrors it only for
		 * builder-less unit tests (drift pinned by AbilitiesHFBuilderCanonTest).
		 *
		 * @param string $row Row id.
		 * @return string
		 */
		public static function default_row_json( $row ) {
			if ( class_exists( 'Sydney_Header_Footer_Builder' ) && method_exists( 'Sydney_Header_Footer_Builder', 'get_row_default_value' ) ) {
				return Sydney_Header_Footer_Builder::get_row_default_value( $row );
			}

			switch ( $row ) {
				case 'main_header_row':
					if ( class_exists( 'Woocommerce' ) ) {
						return '{ "desktop": [["logo"], ["menu", "search", "woo_icons"]], "mobile": [["logo"], ["search", "woo_icons", "mobile_hamburger"]] }';
					}
					return '{ "desktop": [["logo"], ["menu", "search"]], "mobile": [["logo"], ["search", "mobile_hamburger"]] }';

				case 'mobile_offcanvas':
					return '{ "desktop": [], "mobile": [], "mobile_offcanvas": [["mobile_offcanvas_menu"]] }';

				case 'main_footer_row':
					return '{ "desktop": [[], [], []], "mobile": [[], [], []] }';

				case 'below_footer_row':
					return '{ "desktop": [["copyright"]], "mobile": [[], [], []] }';

				default:
					return '{ "desktop": [[], [], []], "mobile": [[], [], []], "mobile_offcanvas": [[]] }';
			}
		}

		/**
		 * Decode a row theme_mod value to associative arrays.
		 *
		 * Falls back to the row default on malformed JSON. Every present device key
		 * is normalized to a list-of-lists.
		 *
		 * @param string $raw Raw JSON string (a row theme_mod value).
		 * @param string $row Row id (selects the fallback default).
		 * @return array
		 */
		public static function decode_row( $raw, $row ) {
			$decoded = is_string( $raw ) ? json_decode( $raw, true ) : null;

			if ( ! is_array( $decoded ) ) {
				$decoded = json_decode( self::default_row_json( $row ), true );
			}

			$out = array();
			foreach ( self::DEVICES as $device ) {
				if ( isset( $decoded[ $device ] ) && is_array( $decoded[ $device ] ) ) {
					$out[ $device ] = array_values(
						array_map(
							function ( $col ) {
								return is_array( $col ) ? array_values( $col ) : array();
							},
							$decoded[ $device ]
						)
					);
				}
			}

			return $out;
		}

		/**
		 * Pad a device's column list so $index exists (clamping substrate).
		 *
		 * @param array $device_cols List of columns.
		 * @param int   $index       Target column index that must exist.
		 * @return array
		 */
		public static function ensure_columns( $device_cols, $index ) {
			$device_cols = array_values( $device_cols );
			for ( $i = count( $device_cols ); $i <= $index; $i++ ) {
				$device_cols[ $i ] = array();
			}
			return $device_cols;
		}

		/**
		 * Encode a decoded row back to its JSON theme_mod value.
		 *
		 * @param array $data Decoded row (device => list of columns).
		 * @return string
		 */
		public static function encode_row( $data ) {
			return wp_json_encode( $data );
		}

		/**
		 * Add a component into a column at a position.
		 *
		 * Validates the component is allowed for the area/device, clamps the
		 * column (padding) and the insert position, and rejects a duplicate of the
		 * same component already present in that column. Returns the mutated row,
		 * or array( 'error' => message ) on a validation failure.
		 *
		 * @param array      $data         Decoded row.
		 * @param string     $area         Area.
		 * @param string     $device       Device.
		 * @param int        $column       Resolved column index.
		 * @param string     $component_id Canonical component id.
		 * @param int        $position     Insert position within the column.
		 * @param array|null $registry     Optional injected registry (testing).
		 * @return array
		 */
		public static function add( $data, $area, $device, $column, $component_id, $position, $registry = null ) {
			if ( ! self::is_component_allowed( $component_id, $area, $device, $registry ) ) {
				/* translators: 1: component id, 2: area, 3: device. */
				return array( 'error' => sprintf( __( 'Component "%1$s" is not available for %2$s / %3$s.', 'sydney' ), $component_id, $area, $device ) );
			}

			if ( ! isset( $data[ $device ] ) || ! is_array( $data[ $device ] ) ) {
				$data[ $device ] = array();
			}

			$column          = max( 0, (int) $column );
			$data[ $device ] = self::ensure_columns( $data[ $device ], $column );

			if ( in_array( $component_id, $data[ $device ][ $column ], true ) ) {
				/* translators: 1: component id. */
				return array( 'error' => sprintf( __( 'Component "%s" is already in that column.', 'sydney' ), $component_id ) );
			}

			$col      = $data[ $device ][ $column ];
			$position = max( 0, min( (int) $position, count( $col ) ) );
			array_splice( $col, $position, 0, array( $component_id ) );

			$data[ $device ][ $column ] = array_values( $col );

			return $data;
		}

		/**
		 * Remove the first occurrence of a component from a column.
		 *
		 * @param array  $data         Decoded row.
		 * @param string $device       Device.
		 * @param int    $column       Column index.
		 * @param string $component_id Canonical component id.
		 * @return array Mutated row, or array( 'error' => message ).
		 */
		public static function remove( $data, $device, $column, $component_id ) {
			$column = (int) $column;

			if ( ! isset( $data[ $device ][ $column ] ) || ! is_array( $data[ $device ][ $column ] ) ) {
				/* translators: 1: device, 2: column index. */
				return array( 'error' => sprintf( __( 'No column %2$d in device "%1$s".', 'sydney' ), $device, $column ) );
			}

			$index = array_search( $component_id, $data[ $device ][ $column ], true );
			if ( false === $index ) {
				/* translators: 1: component id. */
				return array( 'error' => sprintf( __( 'Component "%s" is not in that column.', 'sydney' ), $component_id ) );
			}

			array_splice( $data[ $device ][ $column ], $index, 1 );
			$data[ $device ][ $column ] = array_values( $data[ $device ][ $column ] );

			return $data;
		}

		/**
		 * Move a component within / across columns of the SAME row + device.
		 *
		 * SCOPE: single-row only. Cross-row moves are explicitly DEFERRED for this
		 * phase — this method operates on one decoded row, so source and destination
		 * always share that row (and device). To relocate a component to a different
		 * row, the caller should remove-then-add. (Spec §6.3 mentions moving across
		 * "rows"; that capability is intentionally out of scope here.)
		 *
		 * @param array  $data        Decoded row.
		 * @param string $device      Device.
		 * @param int    $from_column Source column index.
		 * @param int    $from_index  Source position within the column.
		 * @param int    $to_column   Destination column index.
		 * @param int    $to_position Destination position within the column.
		 * @return array Mutated row, or array( 'error' => message ).
		 */
		public static function move( $data, $device, $from_column, $from_index, $to_column, $to_position ) {
			$from_column = (int) $from_column;
			$from_index  = (int) $from_index;
			$to_column   = max( 0, (int) $to_column );

			if ( ! isset( $data[ $device ] ) || ! is_array( $data[ $device ] ) ) {
				/* translators: 1: device. */
				return array( 'error' => sprintf( __( 'Unknown device "%s".', 'sydney' ), $device ) );
			}

			if ( ! isset( $data[ $device ][ $from_column ][ $from_index ] ) ) {
				/* translators: 1: column index, 2: position. */
				return array( 'error' => sprintf( __( 'No component at column %1$d position %2$d.', 'sydney' ), $from_column, $from_index ) );
			}

			$component_id = $data[ $device ][ $from_column ][ $from_index ];

			// Detach from the source.
			array_splice( $data[ $device ][ $from_column ], $from_index, 1 );
			$data[ $device ][ $from_column ] = array_values( $data[ $device ][ $from_column ] );

			// Ensure the destination column exists.
			$data[ $device ] = self::ensure_columns( $data[ $device ], $to_column );

			$dest        = $data[ $device ][ $to_column ];
			$to_position = max( 0, min( (int) $to_position, count( $dest ) ) );
			array_splice( $dest, $to_position, 0, array( $component_id ) );

			$data[ $device ][ $to_column ] = array_values( $dest );

			return $data;
		}

		/**
		 * Load and decode a row's current layout from its theme_mod.
		 *
		 * @param string $area Area.
		 * @param string $row  Row id.
		 * @return array Decoded row.
		 */
		public static function load( $area, $row ) {
			$key = self::theme_mod_for_row( $area, $row );
			$raw = get_theme_mod( $key, self::default_row_json( $row ) );
			return self::decode_row( $raw, $row );
		}

		/**
		 * Encode and persist a decoded row to its theme_mod.
		 *
		 * @param string $area Area.
		 * @param string $row  Row id.
		 * @param array  $data Decoded row.
		 * @return void
		 */
		public static function save( $area, $row, $data ) {
			$key = self::theme_mod_for_row( $area, $row );
			set_theme_mod( $key, self::encode_row( $data ) );
		}
	}

endif;
