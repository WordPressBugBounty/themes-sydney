<?php
/**
 * Thin static registrar that wraps wp_register_ability() for Sydney abilities.
 *
 * register() assembles the wp_register_ability() $args from a caller-supplied
 * partial: it injects the shared "sydney" category, the edit_theme_options
 * capability floor (overridable via 'permission_callback'), and a try/catch
 * wrapper around the execute callback that surfaces contained Throwables as
 * WP_Error (core's failure contract) while callbacks keep returning
 * Sydney_Abilities_Response envelopes. The write/read split is enforced here:
 * an ability flagged 'write' => true does not register while the allow-writes
 * gate is off (ADR-0002 — gate at registration, never by hiding a registered
 * tool).
 *
 * @package Sydney
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Sydney_Ability' ) ) :

	/**
	 * Sydney_Ability class.
	 */
	class Sydney_Ability {

		/**
		 * Ability category slug. All Sydney abilities share one category.
		 */
		const CATEGORY = 'sydney';

		/**
		 * Capability floor for every Sydney ability.
		 */
		const CAPABILITY = 'edit_theme_options';

		/**
		 * Canonical annotations for read abilities.
		 */
		const READ_ANNOTATIONS = array(
			'readonly'    => true,
			'destructive' => false,
			'idempotent'  => true,
		);

		/**
		 * Canonical annotations for (idempotent) write abilities. Non-idempotent
		 * writes (add/move/create) merge array( 'idempotent' => false ) over this.
		 */
		const WRITE_ANNOTATIONS = array(
			'readonly'    => false,
			'destructive' => false,
			'idempotent'  => true,
		);

		/**
		 * Build the canonical {success, message, data} output-schema envelope.
		 *
		 * @param array $data_properties Optional JSON-schema property map for the
		 *                               data object; empty for a bare data object.
		 * @return array
		 */
		public static function envelope_schema( array $data_properties = array() ) {
			$data = array( 'type' => 'object' );
			if ( ! empty( $data_properties ) ) {
				$data['properties'] = $data_properties;
			}

			return array(
				'type'       => 'object',
				'required'   => array( 'success', 'message' ),
				'properties' => array(
					'success' => array( 'type' => 'boolean' ),
					'message' => array( 'type' => 'string' ),
					'data'    => $data,
				),
			);
		}

		/**
		 * Whether a value has a plausible color shape: #rgb/#rrggbb hex or a
		 * well-formed rgb()/rgba() string.
		 *
		 * sydney_sanitize_hex_rgba()'s sscanf branch turns arbitrary "rgb…"
		 * garbage into rgb(0,0,0), so color-writing abilities must shape-check
		 * before calling the sanitizer.
		 *
		 * @param mixed $value Candidate color string.
		 * @return bool
		 */
		public static function is_valid_color_shape( $value ) {
			if ( ! is_string( $value ) ) {
				return false;
			}

			$value = trim( $value );

			if ( preg_match( '/^#([0-9a-f]{3}|[0-9a-f]{6})$/i', $value ) ) {
				return true;
			}

			return (bool) preg_match( '/^rgba?\(\s*\d{1,3}\s*,\s*\d{1,3}\s*,\s*\d{1,3}\s*(,\s*(0|1(\.0+)?|0?\.\d+)\s*)?\)$/i', $value );
		}

		/**
		 * Canonical updated[]/ignored[] data-property fragments for write
		 * abilities that report per-key results (open input maps).
		 *
		 * @return array
		 */
		public static function updated_ignored_properties() {
			return array(
				'updated' => array(
					'type'  => 'array',
					'items' => array( 'type' => 'string' ),
				),
				'ignored' => array(
					'type'  => 'array',
					'items' => array(
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
			);
		}

		/**
		 * Write several theme mods with a single database write.
		 *
		 * Core's set_theme_mod() issues one full serialized
		 * theme_mods_{stylesheet} UPDATE per call, and ability writes routinely
		 * touch 10-30 keys (palettes, typography pairs, HF settings). Mirrors
		 * core semantics: the per-key pre_set_theme_mod_{$name} filter still
		 * runs, then the option is updated once.
		 *
		 * @param array $mods Map of theme_mod name => new value.
		 */
		public static function set_theme_mods( array $mods ) {
			if ( empty( $mods ) ) {
				return;
			}

			$current = get_theme_mods();

			if ( ! is_array( $current ) ) {
				$current = array();
			}

			foreach ( $mods as $name => $value ) {
				$old_value = isset( $current[ $name ] ) ? $current[ $name ] : false;

				/** This filter is documented in wp-includes/theme.php */
				$current[ $name ] = apply_filters( "pre_set_theme_mod_{$name}", $value, $old_value );
			}

			update_option( 'theme_mods_' . get_option( 'stylesheet' ), $current );
		}

		/**
		 * Register one ability with the Abilities API.
		 *
		 * @param string $id   Ability id, e.g. 'sydney/get-global-colors'.
		 * @param array  $args {
		 *     Partial ability definition.
		 *
		 *     @type string   $label               Human label.
		 *     @type string   $description         Human description.
		 *     @type array    $input_schema        JSON schema (object) for input.
		 *     @type array    $output_schema       Optional JSON schema for output.
		 *     @type callable $execute_callback    The raw execute callback receiving $args.
		 *     @type callable $permission_callback Optional. Overrides the default
		 *                                         edit_theme_options floor for abilities
		 *                                         needing a different one (manage_options,
		 *                                         install-permission checks).
		 *     @type array    $meta                Partial meta (annotations etc.).
		 *     @type bool     $write               Optional. True for write abilities:
		 *                                         the ability is not registered while
		 *                                         the allow-writes gate is off (ADR-0002).
		 * }
		 * @return bool True when registered, false when skipped by the write gate.
		 */
		public static function register( $id, array $args ) {

			if ( ! empty( $args['write'] ) && ! Sydney_Abilities::writes_enabled() ) {
				return false;
			}

			$execute = isset( $args['execute_callback'] ) ? $args['execute_callback'] : null;

			$final = array(
				'label'               => isset( $args['label'] ) ? $args['label'] : '',
				'description'         => isset( $args['description'] ) ? $args['description'] : '',
				'category'            => self::CATEGORY,
				'input_schema'        => self::normalize_input_schema( isset( $args['input_schema'] ) ? $args['input_schema'] : array() ),
				'execute_callback'    => self::wrap_execute( $execute ),
				'permission_callback' => isset( $args['permission_callback'] ) ? $args['permission_callback'] : array( __CLASS__, 'check_permission' ),
				'meta'                => self::build_meta( isset( $args['meta'] ) ? $args['meta'] : array() ),
			);

			if ( ! empty( $args['output_schema'] ) ) {
				$final['output_schema'] = $args['output_schema'];
			}

			wp_register_ability( $id, $final );

			return true;
		}

		/**
		 * Capability floor check shared by all Sydney abilities.
		 *
		 * @return bool
		 */
		public static function check_permission() {
			return current_user_can( self::CAPABILITY );
		}

		/**
		 * Normalize an input schema so an empty properties map serializes as an object.
		 *
		 * @param array $schema Input schema.
		 * @return array
		 */
		protected static function normalize_input_schema( $schema ) {
			if ( ! is_array( $schema ) ) {
				$schema = array();
			}

			if ( ! isset( $schema['type'] ) ) {
				$schema['type'] = 'object';
			}

			// Properties must be a non-empty array of definitions, or absent entirely.
			// WordPress core's input validator (rest_validate_object_value_from_schema)
			// does array access on `properties`; a stdClass there fatals with
			// "Cannot use object of type stdClass as array" the moment a non-empty
			// input object is validated (HTTP 500). An empty array would serialize as
			// "[]" and misrepresent an object schema, so when there are no properties
			// we drop the key: a bare { "type": "object" } is valid JSON Schema and
			// validates cleanly.
			if ( isset( $schema['properties'] )
				&& ( $schema['properties'] instanceof stdClass
					|| ( is_array( $schema['properties'] ) && empty( $schema['properties'] ) ) )
			) {
				unset( $schema['properties'] );
			}

			// Core's WP_Ability::normalize_input() substitutes this schema-level
			// default when the caller sends no input. Without it, null is validated
			// against the object schema and rejected (ability_invalid_input), so
			// zero-input runs would always fail.
			if ( ! array_key_exists( 'default', $schema ) ) {
				$schema['default'] = array();
			}

			return $schema;
		}

		/**
		 * Merge caller meta over Sydney's defaults.
		 *
		 * @param array $meta Caller-supplied partial meta.
		 * @return array
		 */
		protected static function build_meta( $meta ) {
			$defaults = array(
				'show_in_rest' => true,
				'annotations'  => array(
					'readonly'    => true,
					'destructive' => false,
					'idempotent'  => true,
				),
				'mcp'          => array(
					'public' => true,
					'type'   => 'tool',
				),
			);

			return array_replace_recursive( $defaults, (array) $meta );
		}

		/**
		 * Wrap an execute callback so thrown Exceptions/Errors are contained and
		 * surfaced as WP_Error — the core contract for hard failures. A
		 * success-shaped envelope here would validate as successful output and
		 * fire wp_after_execute_ability on what is actually a crash. Graceful
		 * ability errors (validation, unknown ids) keep returning
		 * Sydney_Abilities_Response::error() envelopes from the callbacks.
		 *
		 * @param callable|null $execute Raw execute callback.
		 * @return callable
		 */
		protected static function wrap_execute( $execute ) {
			return function ( $args = array() ) use ( $execute ) {
				try {
					return call_user_func( $execute, $args );
				} catch ( Exception $e ) {
					self::log_ability_error( $e );
					// Never echo getMessage() to the client: DB errors embed
					// queries, hosts and filesystem paths. Detail goes to the
					// error log only (log_ability_error above).
					return new WP_Error( 'sydney_ability_error', __( 'An unexpected error occurred while running this ability. Check the site error log for details.', 'sydney' ) );
				} catch ( Error $e ) {
					self::log_ability_error( $e );
					return new WP_Error( 'sydney_ability_system_error', __( 'A system error occurred while running this ability. Check the site error log for details.', 'sydney' ) );
				}
			};
		}

		/**
		 * Log a Throwable caught during ability execution, with its full trace,
		 * when debugging is enabled. The wrapper otherwise swallows the error into
		 * a graceful envelope, which hides the root cause; this surfaces it in the
		 * PHP error log without changing the response contract.
		 *
		 * @param Exception|Error $e The caught throwable.
		 */
		protected static function log_ability_error( $e ) {
			if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
				error_log( 'Sydney ability execution error: ' . $e ); // phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_error_log
			}
		}
	}

endif;
