<?php
/**
 * Header/footer builder ability group: registers and executes the HF layout
 * abilities (get-hf-layout, list/get/add/remove/move components) and the
 * per-component settings abilities, driven by the declarative HF definition
 * map and the Sydney_HF_Layout helper.
 *
 * @package Sydney
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Sydney_Abilities_HF' ) ) :

	/**
	 * Sydney_Abilities_HF class.
	 */
	class Sydney_Abilities_HF {

		/**
		 * Cached HF per-component settings map.
		 *
		 * @var array|null
		 */
		protected $hf_components_map = null;

		/**
		 * Component ids whose only setting is raw markup — never writable.
		 *
		 * @var array
		 */
		protected $hf_blocked_components = array( 'html', 'html2' );

		/**
		 * Lazily load the HF layout helper file.
		 *
		 * @return void
		 */
		protected function ensure_hf_helper() {
			if ( ! class_exists( 'Sydney_HF_Layout' ) ) {
				require_once get_template_directory() . '/inc/abilities/customizer/class-sydney-hf-layout.php';
			}
		}

		/**
		 * Shared input-schema fragment for the layout write abilities: the
		 * area/row/device target properties (identical in add/remove/move).
		 *
		 * @return array
		 */
		protected function hf_target_properties() {
			return array(
				'area'   => array(
					'type' => 'string',
					'enum' => array( 'header', 'footer' ),
				),
				'row'    => array(
					'type'        => 'string',
					'enum'        => array( 'above_header_row', 'main_header_row', 'below_header_row', 'mobile_offcanvas', 'above_footer_row', 'main_footer_row', 'below_footer_row' ),
					'description' => 'Builder row. Header: above_header_row, main_header_row, below_header_row, mobile_offcanvas. Footer: above_footer_row, main_footer_row, below_footer_row.',
				),
				'device' => array(
					'type'        => 'string',
					'enum'        => array( 'desktop', 'mobile', 'mobile_offcanvas' ),
					'description' => 'Device this row renders on. Footer rows support only "desktop".',
				),
			);
		}

		/**
		 * Shared column input-schema fragment (zone name or 0-based index).
		 *
		 * @param string $description Property description.
		 * @return array
		 */
		protected function hf_column_property( $description = 'left | center | right, or a 0-based column index.' ) {
			return array(
				'type'        => array( 'string', 'integer' ),
				'description' => $description,
			);
		}

		/**
		 * Shared component-id input-schema fragment (canonical id or alias).
		 *
		 * @return array
		 */
		protected function hf_component_property() {
			return array(
				'type'        => 'string',
				'description' => 'Component id, canonical or a friendly alias. For valid ids see sydney/list-hf-components (available) or sydney/get-hf-layout (currently placed). Common ids: logo, menu, search, button, social, woo_icons, mobile_hamburger, copyright, widget1. Aliases: hamburger (mobile_hamburger), cart or woo (woo_icons), nav (menu), site_logo (logo), contact (contact_info).',
			);
		}

		/**
		 * Register the header/footer builder abilities.
		 *
		 * Read/list abilities always register; the five write abilities register
		 * only when writes are enabled. This method registers BOTH the layout
		 * abilities and the per-component settings abilities (the latter added in a
		 * later step), so register_abilities() calls it exactly once.
		 */
		public function register() {

			Sydney_Ability::register(
				'sydney/get-hf-layout',
				array(
					'label'            => __( 'Get header/footer layout', 'sydney' ),
					'description'      => __( 'Read the full header and footer builder layout: every row, device, and column with its ordered component ids. These rows and columns are what add/remove/move-hf-component operate on.', 'sydney' ),
					'input_schema'     => array(
						'type'       => 'object',
						'properties' => new stdClass(),
					),
					'output_schema'    => Sydney_Ability::envelope_schema(
						array(
									'header' => array( 'type' => 'object' ),
									'footer' => array( 'type' => 'object' ),
						)
					),
					'execute_callback' => array( $this, 'execute_get_hf_layout' ),
					'meta'             => array(
						'annotations' => Sydney_Ability::READ_ANNOTATIONS,
					),
				)
			);

			Sydney_Ability::register(
				'sydney/list-hf-components',
				array(
					'label'            => __( 'List header/footer components', 'sydney' ),
					'description'      => __( 'List the components available for each area and device (respects WooCommerce availability). Call before sydney/add-hf-component to get valid component ids per area and device.', 'sydney' ),
					'input_schema'     => array(
						'type'       => 'object',
						'properties' => new stdClass(),
					),
					'output_schema'    => Sydney_Ability::envelope_schema(
						array(
									'header' => array( 'type' => 'object' ),
									'footer' => array( 'type' => 'object' ),
						)
					),
					'execute_callback' => array( $this, 'execute_list_hf_components' ),
					'meta'             => array(
						'annotations' => Sydney_Ability::READ_ANNOTATIONS,
					),
				)
			);

			Sydney_Ability::register(
				'sydney/get-hf-component-settings',
				array(
					'label'            => __( 'Get header/footer component settings', 'sydney' ),
					'description'      => __( 'Read the content and functional settings of one header or footer builder component (e.g. a button\'s text and link). Use before sydney/update-hf-component-settings to see the writable setting keys. Component settings such as button, contact info and WooCommerce icons take effect only when that component is placed in a header or footer builder row.', 'sydney' ),
					'input_schema'     => array(
						'type'       => 'object',
						'required'   => array( 'area', 'component_id' ),
						'properties' => array(
							'area'         => array(
								'type'        => 'string',
								'enum'        => array( 'header', 'footer' ),
								'description' => 'Which builder area the component belongs to.',
							),
							'component_id' => array(
								'type'        => 'string',
								'description' => 'Component id, e.g. logo, menu, button, copyright, widget1.',
							),
						),
					),
					'output_schema'    => Sydney_Ability::envelope_schema(
						array(
									'area'         => array( 'type' => 'string' ),
									'component_id' => array( 'type' => 'string' ),
									'settings'     => array( 'type' => 'object' ),
						)
					),
					'execute_callback' => array( $this, 'execute_get_hf_component_settings' ),
					'meta'             => array(
						'annotations' => Sydney_Ability::READ_ANNOTATIONS,
					),
				)
			);

			Sydney_Ability::register(
				'sydney/add-hf-component',
				array(
					'write' => true,
					'label'            => __( 'Add header/footer component', 'sydney' ),
					'description'      => __( 'Add a component to a builder row column at a position. Column accepts left/center/right or a 0-based index. Call sydney/list-hf-components first for the valid component ids in the target area and device.', 'sydney' ),
					'input_schema'     => array(
						'type'                 => 'object',
						'additionalProperties' => false,
						'required'             => array( 'area', 'row', 'device', 'column', 'component' ),
						'properties'           => array_merge(
							$this->hf_target_properties(),
							array(
								'column'    => $this->hf_column_property(),
								'component' => $this->hf_component_property(),
								'position'  => array(
									'type'        => 'integer',
									'description' => 'Insert position within the column (clamped; omit to append).',
								),
							)
						),
					),
					'output_schema'    => Sydney_Ability::envelope_schema(
						array(
									'component' => array( 'type' => 'string' ),
						)
					),
					'execute_callback' => array( $this, 'execute_add_hf_component' ),
					'meta'             => array(
						'annotations' => array_merge( Sydney_Ability::WRITE_ANNOTATIONS, array( 'idempotent' => false ) ),
					),
				)
			);

			Sydney_Ability::register(
				'sydney/remove-hf-component',
				array(
					'write' => true,
					'label'            => __( 'Remove header/footer component', 'sydney' ),
					'description'      => __( 'Remove a component from a builder row column.', 'sydney' ),
					'input_schema'     => array(
						'type'                 => 'object',
						'additionalProperties' => false,
						'required'             => array( 'area', 'row', 'device', 'column', 'component' ),
						'properties'           => array_merge(
							$this->hf_target_properties(),
							array(
								'column'    => $this->hf_column_property(),
								'component' => $this->hf_component_property(),
							)
						),
					),
					'output_schema'    => Sydney_Ability::envelope_schema(
						array(
									'component' => array( 'type' => 'string' ),
						)
					),
					'execute_callback' => array( $this, 'execute_remove_hf_component' ),
					'meta'             => array(
						// Reversible (re-addable via add-hf-component) and idempotent,
						// so not flagged destructive — this also keeps the REST/MCP
						// runner on POST instead of mapping destructive => DELETE.
						'annotations' => Sydney_Ability::WRITE_ANNOTATIONS,
					),
				)
			);

			Sydney_Ability::register(
				'sydney/move-hf-component',
				array(
					'write' => true,
					'label'            => __( 'Move header/footer component', 'sydney' ),
					'description'      => __( 'Reorder a component within a column or move it across columns of the SAME row/device. Cross-row moves are not supported in this phase — to relocate a component to a different row, remove it from the source row and add it to the destination row.', 'sydney' ),
					'input_schema'     => array(
						'type'                 => 'object',
						'additionalProperties' => false,
						'required'             => array( 'area', 'row', 'device', 'from_column', 'from_index', 'to_column' ),
						'properties'           => array_merge(
							$this->hf_target_properties(),
							array(
								'from_column' => $this->hf_column_property( 'Source column: left | center | right, or a 0-based index.' ),
								'from_index'  => array( 'type' => 'integer' ),
								'to_column'   => $this->hf_column_property( 'Destination column: left | center | right, or a 0-based index.' ),
								'to_position' => array(
									'type'        => 'integer',
									'description' => 'Destination position within the column (clamped; omit to append).',
								),
							)
						),
					),
					'output_schema'    => Sydney_Ability::envelope_schema(),
					'execute_callback' => array( $this, 'execute_move_hf_component' ),
					'meta'             => array(
						'annotations' => array_merge( Sydney_Ability::WRITE_ANNOTATIONS, array( 'idempotent' => false ) ),
					),
				)
			);

			Sydney_Ability::register(
				'sydney/update-hf-component-settings',
				array(
					'write' => true,
					'label'            => __( 'Update header/footer component settings', 'sydney' ),
					'description'      => __( 'Set the content and functional settings of one header or footer builder component. Only curated settings are writable; the raw HTML component is not. Component settings such as button, contact info and WooCommerce icons take effect only when that component is placed in a header or footer builder row.', 'sydney' ),
					'input_schema'     => array(
						'type'                 => 'object',
						// Top-level only: reject any property other than the three below.
						// The inner `settings` object is intentionally LEFT OPEN-ENDED
						// (its keys are agent-supplied setting ids) — it is guarded by the
						// callback's allow-list + the ignored[] contract, not the schema.
						'additionalProperties' => false,
						'required'             => array( 'area', 'component_id', 'settings' ),
						'properties'           => array(
							'area'         => array(
								'type'        => 'string',
								'enum'        => array( 'header', 'footer' ),
								'description' => 'Which builder area the component belongs to.',
							),
							'component_id' => array(
								'type'        => 'string',
								'description' => 'Component id. Components with editable settings — header: logo, menu, secondary_menu, social, search, button, contact_info, woo_icons; footer: copyright, social, button, widget1-widget4. Call sydney/get-hf-component-settings first to see the exact setting keys and current values. The raw HTML component is not editable.',
							),
							'settings'     => array(
								'type'        => 'object',
								'description' => 'Map of curated setting name to value. Responsive settings (visibility, text_alignment, size, space_between_icons) take a {desktop, tablet, mobile} object; any breakpoint may be omitted. Unknown keys and known keys with invalid values are not written and are returned in the ignored[] list.',
							),
						),
					),
					'output_schema'    => Sydney_Ability::envelope_schema(
						array(
									'updated' => array(
										'type'  => 'array',
										'items' => array( 'type' => 'string' ),
									),
									'ignored' => array(
										'type'        => 'array',
										'description' => 'Supplied setting keys that were NOT written, each with a reason ("unknown key" or "invalid value").',
										'items'       => array(
											'type'       => 'object',
											'properties' => array(
												'key'    => array( 'type' => 'string' ),
												'reason' => array(
													'type' => 'string',
													'enum' => array( 'unknown key', 'invalid value' ),
												),
											),
										),
									),
						)
					),
					'execute_callback' => array( $this, 'execute_update_hf_component_settings' ),
					'meta'             => array(
						'annotations' => Sydney_Ability::WRITE_ANNOTATIONS,
					),
				)
			);
		}

		/**
		 * Execute: read the full header + footer layout.
		 *
		 * @param array $args Ability args (unused).
		 * @return array Response envelope.
		 */
		public function execute_get_hf_layout( $args ) {
			$this->ensure_hf_helper();

			$out  = array();
			$rows = Sydney_HF_Layout::rows_for_area();

			foreach ( $rows as $area => $area_rows ) {
				$out[ $area ] = array();
				foreach ( $area_rows as $row ) {
					$out[ $area ][ $row ] = Sydney_HF_Layout::load( $area, $row );
				}
			}

			return Sydney_Abilities_Response::success(
				__( 'Header/footer layout retrieved.', 'sydney' ),
				$out
			);
		}

		/**
		 * Execute: list available components per area + device.
		 *
		 * @param array $args Ability args (unused).
		 * @return array Response envelope.
		 */
		public function execute_list_hf_components( $args ) {
			$this->ensure_hf_helper();

			// Build the registry once and reuse it for all four sets.
			$registry = Sydney_HF_Layout::registry();

			$data = array(
				'header' => array(
					'desktop'          => Sydney_HF_Layout::available_components( 'header', 'desktop', $registry ),
					'mobile'           => Sydney_HF_Layout::available_components( 'header', 'mobile', $registry ),
					'mobile_offcanvas' => Sydney_HF_Layout::available_components( 'header', 'mobile_offcanvas', $registry ),
				),
				'footer' => array(
					'desktop' => Sydney_HF_Layout::available_components( 'footer', 'desktop', $registry ),
				),
			);

			return Sydney_Abilities_Response::success(
				__( 'Available header/footer components listed.', 'sydney' ),
				$data
			);
		}

		/**
		 * Resolve + validate the common area/row/device/column args for layout ops.
		 *
		 * @param array $args         Ability args.
		 * @param bool  $needs_column Whether a 'column' arg is required/resolved.
		 * @return array { area, row, device, column? } on success, or
		 *               array( 'error' => message ) on failure.
		 */
		protected function resolve_hf_target( $args, $needs_column = true ) {
			$area   = isset( $args['area'] ) ? (string) $args['area'] : '';
			$row    = isset( $args['row'] ) ? (string) $args['row'] : '';
			$device = isset( $args['device'] ) ? (string) $args['device'] : '';

			if ( ! Sydney_HF_Layout::is_valid_row( $area, $row ) ) {
				/* translators: 1: row id, 2: area. */
				return array( 'error' => sprintf( __( 'Invalid row "%1$s" for area "%2$s".', 'sydney' ), $row, $area ) );
			}

			if ( ! in_array( $device, Sydney_HF_Layout::DEVICES, true ) ) {
				/* translators: 1: device. */
				return array( 'error' => sprintf( __( 'Invalid device "%s".', 'sydney' ), $device ) );
			}

			// The row must actually render on the requested device — otherwise
			// the write would persist layout JSON the builder never reads.
			if ( ! Sydney_HF_Layout::is_valid_device_for_row( $area, $row, $device ) ) {
				return array(
					'error' => sprintf(
						/* translators: 1: device, 2: row id, 3: comma-separated valid devices. */
						__( 'Device "%1$s" is not rendered by row "%2$s". Valid devices for this row: %3$s.', 'sydney' ),
						$device,
						$row,
						implode( ', ', Sydney_HF_Layout::devices_for_row( $area, $row ) )
					),
				);
			}

			$resolved = array(
				'area'   => $area,
				'row'    => $row,
				'device' => $device,
			);

			if ( $needs_column ) {
				$column = isset( $args['column'] ) ? $args['column'] : 0;
				$index  = Sydney_HF_Layout::resolve_column( $column );
				if ( null === $index ) {
					/* translators: 1: column value. */
					return array( 'error' => sprintf( __( 'Invalid column "%s". Use left/center/right or an index.', 'sydney' ), (string) $column ) );
				}
				$resolved['column'] = $index;
			}

			return $resolved;
		}

		/**
		 * Execute: add a component to a row column.
		 *
		 * @param array $args Ability args.
		 * @return array Response envelope.
		 */
		public function execute_add_hf_component( $args ) {
			$this->ensure_hf_helper();

			$target = $this->resolve_hf_target( $args, true );
			if ( isset( $target['error'] ) ) {
				return Sydney_Abilities_Response::error( $target['error'] );
			}

			$component = Sydney_HF_Layout::normalize_component_id( isset( $args['component'] ) ? $args['component'] : '' );
			$position  = isset( $args['position'] ) ? (int) $args['position'] : PHP_INT_MAX;

			$data   = Sydney_HF_Layout::load( $target['area'], $target['row'] );
			$result = Sydney_HF_Layout::add( $data, $target['area'], $target['device'], $target['column'], $component, $position );

			if ( isset( $result['error'] ) ) {
				return Sydney_Abilities_Response::error( $result['error'] );
			}

			Sydney_HF_Layout::save( $target['area'], $target['row'], $result );

			return Sydney_Abilities_Response::success(
				/* translators: 1: component id. */
				sprintf( __( 'Added "%s".', 'sydney' ), $component ),
				array( 'component' => $component )
			);
		}

		/**
		 * Execute: remove a component from a row column.
		 *
		 * @param array $args Ability args.
		 * @return array Response envelope.
		 */
		public function execute_remove_hf_component( $args ) {
			$this->ensure_hf_helper();

			$target = $this->resolve_hf_target( $args, true );
			if ( isset( $target['error'] ) ) {
				return Sydney_Abilities_Response::error( $target['error'] );
			}

			$component = Sydney_HF_Layout::normalize_component_id( isset( $args['component'] ) ? $args['component'] : '' );

			$data   = Sydney_HF_Layout::load( $target['area'], $target['row'] );
			$result = Sydney_HF_Layout::remove( $data, $target['device'], $target['column'], $component );

			if ( isset( $result['error'] ) ) {
				return Sydney_Abilities_Response::error( $result['error'] );
			}

			Sydney_HF_Layout::save( $target['area'], $target['row'], $result );

			return Sydney_Abilities_Response::success(
				/* translators: 1: component id. */
				sprintf( __( 'Removed "%s".', 'sydney' ), $component ),
				array( 'component' => $component )
			);
		}

		/**
		 * Execute: move a component within / across columns.
		 *
		 * @param array $args Ability args.
		 * @return array Response envelope.
		 */
		public function execute_move_hf_component( $args ) {
			$this->ensure_hf_helper();

			$target = $this->resolve_hf_target( $args, false );
			if ( isset( $target['error'] ) ) {
				return Sydney_Abilities_Response::error( $target['error'] );
			}

			$from_column = Sydney_HF_Layout::resolve_column( isset( $args['from_column'] ) ? $args['from_column'] : 0 );
			$to_column   = Sydney_HF_Layout::resolve_column( isset( $args['to_column'] ) ? $args['to_column'] : 0 );

			if ( null === $from_column || null === $to_column ) {
				return Sydney_Abilities_Response::error(
					__( 'Invalid from_column/to_column. Use left/center/right or an index.', 'sydney' )
				);
			}

			$from_index  = isset( $args['from_index'] ) ? (int) $args['from_index'] : 0;
			$to_position = isset( $args['to_position'] ) ? (int) $args['to_position'] : PHP_INT_MAX;

			$data   = Sydney_HF_Layout::load( $target['area'], $target['row'] );
			$result = Sydney_HF_Layout::move( $data, $target['device'], $from_column, $from_index, $to_column, $to_position );

			if ( isset( $result['error'] ) ) {
				return Sydney_Abilities_Response::error( $result['error'] );
			}

			Sydney_HF_Layout::save( $target['area'], $target['row'], $result );

			return Sydney_Abilities_Response::success(
				__( 'Component moved.', 'sydney' )
			);
		}

		/**
		 * Load and cache the declarative HF per-component settings map.
		 *
		 * @return array
		 */
		protected function get_hf_components_map() {
			if ( null === $this->hf_components_map ) {
				$this->hf_components_map = apply_filters( 'sydney_abilities_hf_components_map', require get_template_directory() . '/inc/abilities/customizer/definitions-hf-components.php' );
			}
			return $this->hf_components_map;
		}

		/**
		 * Resolve one component's settings definition, or null if invalid.
		 *
		 * Rejects unknown areas, unknown component ids, and the raw-markup HTML
		 * component (absent from the map by design).
		 *
		 * @param string $area         'header' or 'footer'.
		 * @param string $component_id Component id, e.g. 'button'.
		 * @return array|null The component's settings array, or null.
		 */
		protected function get_hf_component_settings_def( $area, $component_id ) {
			$map = $this->get_hf_components_map();

			if ( ! isset( $map[ $area ][ $component_id ]['settings'] ) ) {
				return null;
			}

			return $map[ $area ][ $component_id ]['settings'];
		}

		/**
		 * Resolve a setting's default for one breakpoint.
		 *
		 * enum-responsive entries carry a single scalar `default` shared across
		 * breakpoints; int-responsive entries carry a per-breakpoint `defaults` map.
		 *
		 * @param array  $entry      Setting definition.
		 * @param string $breakpoint 'desktop' | 'tablet' | 'mobile'.
		 * @return mixed
		 */
		protected function hf_setting_default( $entry, $breakpoint ) {
			if ( isset( $entry['defaults'][ $breakpoint ] ) ) {
				return $entry['defaults'][ $breakpoint ];
			}
			return isset( $entry['default'] ) ? $entry['default'] : '';
		}

		/**
		 * Execute: read one HF component's content/functional settings.
		 *
		 * @param array $args Ability args. Expects 'area' and 'component_id'.
		 * @return array Response envelope.
		 */
		public function execute_get_hf_component_settings( $args ) {
			$area         = isset( $args['area'] ) ? (string) $args['area'] : '';
			$component_id = isset( $args['component_id'] ) ? (string) $args['component_id'] : '';

			$def = $this->get_hf_component_settings_def( $area, $component_id );

			if ( null === $def ) {
				return Sydney_Abilities_Response::error(
					/* translators: 1: component id, 2: area. */
					sprintf( __( 'Unknown component "%1$s" for the %2$s area.', 'sydney' ), $component_id, $area )
				);
			}

			$settings = array();

			foreach ( $def as $name => $entry ) {
				if ( 'enum-responsive' === $entry['type'] || 'int-responsive' === $entry['type'] ) {
					$bucket = array();
					foreach ( $entry['keys'] as $breakpoint => $theme_mod ) {
						$default               = $this->hf_setting_default( $entry, $breakpoint );
						$bucket[ $breakpoint ] = get_theme_mod( $theme_mod, $default );
					}
					$settings[ $name ] = $bucket;
				} else {
					$settings[ $name ] = get_theme_mod( $entry['theme_mod'], $entry['default'] );
				}
			}

			return Sydney_Abilities_Response::success(
				__( 'Component settings retrieved.', 'sydney' ),
				array(
					'area'         => $area,
					'component_id' => $component_id,
					'settings'     => $settings,
				)
			);
		}

		/**
		 * Execute: update one HF component's content/functional settings.
		 *
		 * Validates area + component against the map (rejecting unknowns and the
		 * raw-markup HTML component). Then applies the uniform ignored[] contract
		 * (spec §13, ADR-0002): every supplied setting key is preflight-validated;
		 * only fully-valid keys are written; unknown keys and known-keys-with-invalid
		 * -values are collected into $ignored ({ key, reason }) and never written.
		 * The call hard-errors ONLY when nothing is valid; otherwise it succeeds and
		 * names the ignored keys in the message. Both updated + ignored are returned.
		 *
		 * @param array $args Ability args. Expects 'area', 'component_id', 'settings'.
		 * @return array Response envelope.
		 */
		public function execute_update_hf_component_settings( $args ) {
			$area         = isset( $args['area'] ) ? (string) $args['area'] : '';
			$component_id = isset( $args['component_id'] ) ? (string) $args['component_id'] : '';
			$input        = isset( $args['settings'] ) && is_array( $args['settings'] ) ? $args['settings'] : array();

			// Defensive: raw-markup components are never writable.
			if ( in_array( $component_id, $this->hf_blocked_components, true ) ) {
				return Sydney_Abilities_Response::error(
					/* translators: %s: component id. */
					sprintf( __( 'The "%s" component cannot be edited through this ability.', 'sydney' ), $component_id )
				);
			}

			$def = $this->get_hf_component_settings_def( $area, $component_id );

			if ( null === $def ) {
				return Sydney_Abilities_Response::error(
					/* translators: 1: component id, 2: area. */
					sprintf( __( 'Unknown component "%1$s" for the %2$s area.', 'sydney' ), $component_id, $area )
				);
			}

			$updated = array();
			$ignored = array();
			$pending = array(); // theme_mod => value, flushed as one write.

			foreach ( $input as $name => $value ) {
				if ( ! isset( $def[ $name ] ) ) {
					// No raw key access — record, never write.
					$ignored[] = array(
						'key'    => (string) $name,
						'reason' => 'unknown key',
					);
					continue;
				}

				// write_hf_setting appends to $updated/$ignored/$pending by reference.
				$this->write_hf_setting( $name, $def[ $name ], $value, $updated, $ignored, $pending );
			}

			// Hard-error only when nothing at all was valid.
			if ( empty( $updated ) ) {
				return Sydney_Abilities_Response::error(
					__( 'No valid component settings were provided.', 'sydney' )
				);
			}

			// All valid settings in ONE database write.
			Sydney_Ability::set_theme_mods( $pending );

			$message = __( 'Component settings updated.', 'sydney' );
			if ( ! empty( $ignored ) ) {
				$ignored_keys = wp_list_pluck( $ignored, 'key' );
				$message      = sprintf(
					/* translators: %s: comma-separated list of ignored setting keys. */
					__( 'Component settings updated. Ignored (not written): %s.', 'sydney' ),
					implode( ', ', $ignored_keys )
				);
			}

			return Sydney_Abilities_Response::success(
				$message,
				array(
					'area'         => $area,
					'component_id' => $component_id,
					'updated'      => $updated,
					'ignored'      => $ignored,
				)
			);
		}

		/**
		 * Sanitize and stage a single HF component setting.
		 *
		 * Appends every accepted theme_mod write to $pending (the caller flushes
		 * the whole batch through Sydney_Ability::set_theme_mods() as one
		 * database write), the caller-facing key to $updated, and every rejected
		 * (invalid-value) key to $ignored ({ key, reason => 'invalid value' }) — all
		 * by reference. For responsive settings, validation is per breakpoint: a bad
		 * breakpoint is recorded in $ignored while the valid breakpoints are still
		 * staged. Returns nothing; the caller decides success from $updated/$ignored.
		 *
		 * @param string $name    Curated setting name (for ignored[] reporting).
		 * @param array  $entry   Setting definition from the map.
		 * @param mixed  $value   Agent-supplied value (scalar or per-device object).
		 * @param array  $updated Reference; staged caller-facing setting keys are appended.
		 * @param array  $ignored Reference; rejected keys are appended as { key, reason }.
		 * @param array  $pending Reference; accepted writes are staged as theme_mod => value.
		 * @return void
		 */
		protected function write_hf_setting( $name, $entry, $value, &$updated, &$ignored, &$pending ) {
			switch ( $entry['type'] ) {

				case 'enum-responsive':
					if ( ! is_array( $value ) ) {
						$ignored[] = array(
							'key'    => $name,
							'reason' => 'invalid value',
						);
						return;
					}
					foreach ( $entry['keys'] as $breakpoint => $theme_mod ) {
						if ( ! array_key_exists( $breakpoint, $value ) ) {
							continue; // Omitted breakpoint left unchanged.
						}
						if ( ! in_array( $value[ $breakpoint ], $entry['enum'], true ) ) {
							// One bad breakpoint is recorded; the others still write.
							$ignored[] = array(
								'key'    => $name . '.' . $breakpoint,
								'reason' => 'invalid value',
							);
							continue;
						}
						$pending[ $theme_mod ] = $value[ $breakpoint ];
						$updated[] = $name . '.' . $breakpoint; // Caller-facing key.
					}
					return;

				case 'int-responsive':
					if ( ! is_array( $value ) ) {
						$ignored[] = array(
							'key'    => $name,
							'reason' => 'invalid value',
						);
						return;
					}
					foreach ( $entry['keys'] as $breakpoint => $theme_mod ) {
						if ( ! array_key_exists( $breakpoint, $value ) ) {
							continue;
						}
						// Non-numeric or negative breakpoints are ignored, never
						// absint()'d to 0.
						if ( ! is_numeric( $value[ $breakpoint ] ) || $value[ $breakpoint ] < 0 ) {
							$ignored[] = array(
								'key'    => $name . '.' . $breakpoint,
								'reason' => 'invalid value',
							);
							continue;
						}
						$pending[ $theme_mod ] = absint( $value[ $breakpoint ] );
						$updated[] = $name . '.' . $breakpoint; // Caller-facing key.
					}
					return;

				case 'enum':
					if ( ! in_array( $value, $entry['enum'], true ) ) {
						$ignored[] = array(
							'key'    => $name,
							'reason' => 'invalid value',
						);
						return;
					}
					$pending[ $entry['theme_mod'] ] = $value;
					$updated[] = $name; // Caller-facing key.
					return;

				case 'int':
					if ( ! is_numeric( $value ) || $value < 0 ) {
						$ignored[] = array(
							'key'    => $name,
							'reason' => 'invalid value',
						);
						return;
					}
					$pending[ $entry['theme_mod'] ] = absint( $value );
					$updated[] = $name; // Caller-facing key.
					return;

				case 'checkbox':
					$pending[ $entry['theme_mod'] ] = sydney_sanitize_checkbox( $value );
					$updated[] = $name; // Caller-facing key.
					return;

				default:
					// text / url / class — run the entry's declared sanitizer.
					$sanitizer = $entry['sanitize'];
					$pending[ $entry['theme_mod'] ] = call_user_func( $sanitizer, $value );
					$updated[] = $name; // Caller-facing key.
					return;
			}
		}
	}

endif;
