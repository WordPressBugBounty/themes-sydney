<?php
/**
 * Usage tracking for Sydney abilities.
 *
 * Counts every sydney/* ability run per UTC month, ability, channel (mcp,
 * rest, other) and client bucket into one non-autoloaded option, and reports
 * the stored months in the weekly usage-tracking snapshot. Only counts leave
 * the site: never a raw User-Agent, an application password name, or ability
 * input or output.
 *
 * The counters are registered from bootstrap.php's init callback, only when
 * abilities and usage tracking are both on. The reporting filter is registered
 * whatever the abilities toggle, so stored months stay in the payload.
 *
 * @package Sydney
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Sydney_Abilities_Tracking' ) ) :

	/**
	 * Sydney_Abilities_Tracking class.
	 */
	class Sydney_Abilities_Tracking {

		/**
		 * Site option holding the month-keyed counts.
		 *
		 * Shape: array( 'Y_m' => array(
		 *     'total'     => started runs,
		 *     'abilities' => array( 'sydney/x' => array( channel => array( 'invoked' => n, 'started' => n, 'ok' => n ) ) ),
		 *     'clients'   => array( bucket => started runs ),
		 * ) ), newest month first.
		 */
		const OPTION_KEY = 'sydney_abilities_monthly_usage';

		/**
		 * Number of newest month buckets kept and reported.
		 */
		const MONTHS_KEPT = 12;

		/**
		 * Most POST fields the snapshot may carry once ours are added. The
		 * snapshot is form-encoded and the receiving server drops every field
		 * past max_input_vars (PHP default 1000). Only the per-ability
		 * breakdown is trimmed to meet it: 'total' and 'clients' are always
		 * sent, and the distinct 'ua:' client buckets are capped by
		 * MAX_UA_CLIENTS.
		 */
		const FIELD_BUDGET = 900;

		/**
		 * Most distinct 'ua:<token>' client buckets kept per month. Further
		 * ones count under 'other'.
		 */
		const MAX_UA_CLIENTS = 20;

		/**
		 * Snapshot key prefix, followed by the 'Y_m' month.
		 */
		const FIELD_PREFIX = 'athemes_sydney_abilities_usage_';

		/**
		 * The MCP Adapter meta-ability that runs another ability as a tool.
		 */
		const EXECUTE_ABILITY = 'mcp-adapter/execute-ability';

		/**
		 * Channels a run is counted under.
		 */
		const CHANNELS = array( 'mcp', 'rest', 'other' );

		/**
		 * Prefix of a client bucket named after a User-Agent product token.
		 */
		const UA_PREFIX = 'ua:';

		/**
		 * Per-ability counters.
		 */
		const COUNTERS = array( 'invoked', 'started', 'ok' );

		/**
		 * Application password app_id => client bucket.
		 */
		const APP_IDS = array(
			'01965f3a-7b2d-7000-8000-000000000001' => 'wpvibe',
		);

		/**
		 * Lowercase User-Agent keyword => client bucket, first match wins.
		 */
		const UA_KEYWORDS = array(
			'claude'             => 'claude',
			'openai'             => 'openai',
			'cursor'             => 'cursor',
			'gemini'             => 'gemini',
			'visual studio code' => 'vscode',
			'wpvibe'             => 'wpvibe',
		);

		/**
		 * Every named client bucket. Anything else is 'ua:<product token>'.
		 * Keep it a superset of the UA_KEYWORDS and APP_IDS buckets: a bucket
		 * missing here is stored by record() and dropped by get_monthly_usage().
		 */
		const FIXED_CLIENTS = array( 'claude', 'openai', 'cursor', 'gemini', 'vscode', 'wpvibe', 'browser', 'cli', 'other' );

		/**
		 * Depth of the MCP tool-call windows currently open.
		 *
		 * @var int
		 */
		protected static $mcp_depth = 0;

		/**
		 * One entry per REST request being dispatched: 'mcp', 'rest' or ''.
		 *
		 * @var string[]
		 */
		protected static $rest_channels = array();

		/**
		 * MCP depth saved when each REST request opened, restored when it closes.
		 *
		 * @var int[]
		 */
		protected static $rest_saved_depths = array();

		/**
		 * Register the counting hooks when usage tracking is on.
		 *
		 * Hooked to init at priority 0: Sydney_Usage_Tracking loads after
		 * bootstrap.php, and no ability can run before init.
		 */
		public static function maybe_register_counters() {
			/** This filter is documented in inc/usage-tracking/class-sydney-usage-tracking.php */
			if ( apply_filters( 'sydney_usage_tracking_is_allowed', true ) && Sydney_Usage_Tracking::is_enabled() ) {
				self::register_counters();
			}
		}

		/**
		 * Add the counting and window hooks.
		 */
		public static function register_counters() {
			add_action( 'wp_ability_invoked', array( __CLASS__, 'on_invoked' ), 10, 1 );
			add_action( 'wp_before_execute_ability', array( __CLASS__, 'on_before_execute' ), 10, 2 );
			add_action( 'wp_after_execute_ability', array( __CLASS__, 'on_after_execute' ), 10, 3 );
			add_filter( 'mcp_adapter_pre_tool_call', array( __CLASS__, 'open_mcp_tool_window' ), 1000, 1 );
			add_filter( 'mcp_adapter_tool_call_result', array( __CLASS__, 'close_mcp_tool_window' ), 1000, 1 );
			add_filter( 'rest_request_before_callbacks', array( __CLASS__, 'open_rest_window' ), 10, 3 );
			add_filter( 'rest_request_after_callbacks', array( __CLASS__, 'close_rest_window' ), 10, 3 );
		}

		/**
		 * Whether an ability name is in the sydney/ namespace.
		 *
		 * @param mixed $name Ability name.
		 * @return bool
		 */
		protected static function is_sydney_ability( $name ) {
			return is_string( $name ) && 0 === strpos( $name, 'sydney/' );
		}

		/**
		 * Count a call, before any processing (core 7.1+).
		 *
		 * Also counts calls a server denies inside execute() because it skipped the
		 * permission check first (ZIP AI's /zip-ai/v1/mcp), so those land in the derived 'rejected'.
		 *
		 * @param string $name Ability name.
		 */
		public static function on_invoked( $name ) {
			if ( self::is_sydney_ability( $name ) ) {
				self::record( $name, 'invoked' );
			}
		}

		/**
		 * Count a run that passed input validation and the permission check,
		 * or open the MCP window around an execute-ability tool call.
		 *
		 * @param string $name  Ability name.
		 * @param mixed  $input Ability input.
		 */
		public static function on_before_execute( $name, $input = null ) {
			if ( self::EXECUTE_ABILITY === $name ) {
				++self::$mcp_depth;
				return;
			}

			if ( self::is_sydney_ability( $name ) ) {
				self::record( $name, 'started', self::resolve_client() );
			}
		}

		/**
		 * Count a run that finished without an error, or close the MCP window
		 * around an execute-ability tool call.
		 *
		 * @param string $name   Ability name.
		 * @param mixed  $input  Ability input.
		 * @param mixed  $result Ability result.
		 */
		public static function on_after_execute( $name, $input = null, $result = null ) {
			if ( self::EXECUTE_ABILITY === $name ) {
				self::$mcp_depth = max( 0, self::$mcp_depth - 1 );
				return;
			}

			if ( ! self::is_sydney_ability( $name ) ) {
				return;
			}

			// A { success: false } envelope passes output validation, so core
			// fires this hook for it: it is a failure, not an ok.
			if ( is_array( $result ) && array_key_exists( 'success', $result ) && false === $result['success'] ) {
				return;
			}

			self::record( $name, 'ok' );
		}

		/**
		 * Open the MCP window for a tool call (adapter 0.5.0+).
		 *
		 * @param mixed $args Tool arguments, or a WP_Error from another filter.
		 * @return mixed
		 */
		public static function open_mcp_tool_window( $args ) {
			if ( ! is_wp_error( $args ) ) {
				++self::$mcp_depth;
			}

			return $args;
		}

		/**
		 * Close the MCP window after a tool call (adapter 0.5.0+).
		 *
		 * @param mixed $result Tool result.
		 * @return mixed
		 */
		public static function close_mcp_tool_window( $result ) {
			self::$mcp_depth = max( 0, self::$mcp_depth - 1 );

			return $result;
		}

		/**
		 * Open a window for the REST route being dispatched.
		 *
		 * @param mixed                $response Response so far.
		 * @param array                $handler  Route handler.
		 * @param WP_REST_Request|null $request  Request being dispatched.
		 * @return mixed
		 */
		public static function open_rest_window( $response, $handler = null, $request = null ) {
			self::$rest_channels[]     = self::classify_route( $request );
			self::$rest_saved_depths[] = self::$mcp_depth;

			return $response;
		}

		/**
		 * Close the window of the REST route just dispatched.
		 *
		 * @param mixed                $response Response.
		 * @param array                $handler  Route handler.
		 * @param WP_REST_Request|null $request  Request dispatched.
		 * @return mixed
		 */
		public static function close_rest_window( $response, $handler = null, $request = null ) {
			array_pop( self::$rest_channels );

			// A tool that throws skips mcp_adapter_tool_call_result, so the
			// MCP window cannot outlive the REST request that opened it. Restoring
			// the depth saved at open keeps an enclosing STDIO window intact.
			if ( ! empty( self::$rest_saved_depths ) ) {
				self::$mcp_depth = array_pop( self::$rest_saved_depths );
			}

			return $response;
		}

		/**
		 * Channel of a REST route: 'mcp', 'rest' or ''.
		 *
		 * @param mixed $request Request being dispatched.
		 * @return string
		 */
		protected static function classify_route( $request ) {
			if ( ! $request instanceof WP_REST_Request ) {
				return '';
			}

			$route = (string) $request->get_route();

			if ( preg_match( '#/mcp(?:/|$)#', $route ) ) {
				return 'mcp';
			}

			if ( 0 === strpos( $route, '/wp-abilities/v1/' ) ) {
				return 'rest';
			}

			return '';
		}

		/**
		 * Channel of the run happening now.
		 *
		 * @return string
		 */
		protected static function current_channel() {
			if ( self::$mcp_depth > 0 || in_array( 'mcp', self::$rest_channels, true ) ) {
				return 'mcp';
			}

			if ( in_array( 'rest', self::$rest_channels, true ) ) {
				return 'rest';
			}

			return 'other';
		}

		/**
		 * Client bucket of the request running the ability.
		 *
		 * @return string
		 */
		protected static function resolve_client() {
			$is_app_password = false;

			// 1. A known integration's application password, by app_id only:
			// the password name is user-typed and never read.
			if ( function_exists( 'rest_get_authenticated_app_password' ) ) {
				$uuid = rest_get_authenticated_app_password();

				if ( is_string( $uuid ) && '' !== $uuid ) {
					$is_app_password = true;
					$item            = WP_Application_Passwords::get_user_application_password( get_current_user_id(), $uuid );

					if ( is_array( $item ) && isset( $item['app_id'] ) && is_string( $item['app_id'] ) && array_key_exists( $item['app_id'], self::APP_IDS ) ) {
						return self::APP_IDS[ $item['app_id'] ];
					}
				}
			}

			// 2. A logged-in browser session.
			if ( ! $is_app_password && defined( 'LOGGED_IN_COOKIE' ) && ! empty( $_COOKIE[ LOGGED_IN_COOKIE ] ) && is_user_logged_in() ) {
				return 'browser';
			}

			$ua = isset( $_SERVER['HTTP_USER_AGENT'] ) ? strtolower( sanitize_text_field( wp_unslash( $_SERVER['HTTP_USER_AGENT'] ) ) ) : '';

			if ( '' !== $ua ) {
				// 3. A keyword of a known client.
				foreach ( self::UA_KEYWORDS as $keyword => $bucket ) {
					if ( false !== strpos( $ua, $keyword ) ) {
						return $bucket;
					}
				}

				// 4. The User-Agent's product token, cut to a safe bucket name.
				$parts = preg_split( '#[\s/(;]#', $ua, 2 );
				$token = substr( preg_replace( '#[^a-z0-9._-]#', '', (string) $parts[0] ), 0, 32 );

				if ( '' !== $token ) {
					return self::UA_PREFIX . $token;
				}
			}

			// 5. No signal: STDIO MCP, WP-CLI (including system cron through WP-CLI).
			return ( defined( 'WP_CLI' ) && WP_CLI ) ? 'cli' : 'other';
		}

		/**
		 * Increment a counter for the current month and write it at once.
		 *
		 * @param string      $name    Ability name.
		 * @param string      $counter One of COUNTERS.
		 * @param string|null $client  Client bucket, for 'started' only.
		 */
		protected static function record( $name, $counter, $client = null ) {
			$usage   = self::get_monthly_usage();
			$month   = gmdate( 'Y_m' );
			$channel = self::current_channel();

			if ( ! isset( $usage[ $month ] ) ) {
				$usage[ $month ] = array(
					'total'     => 0,
					'abilities' => array(),
					'clients'   => array(),
				);
			}

			$count = isset( $usage[ $month ]['abilities'][ $name ][ $channel ][ $counter ] ) ? $usage[ $month ]['abilities'][ $name ][ $channel ][ $counter ] : 0;

			$usage[ $month ]['abilities'][ $name ][ $channel ][ $counter ] = $count + 1;

			if ( 'started' === $counter ) {
				$client = self::bucket_client( is_string( $client ) ? $client : 'other', $usage[ $month ]['clients'] );

				++$usage[ $month ]['total'];
				$usage[ $month ]['clients'][ $client ] = isset( $usage[ $month ]['clients'][ $client ] ) ? $usage[ $month ]['clients'][ $client ] + 1 : 1;
			}

			// 'Y_m' keys are fixed-width, so reverse key sort is newest first.
			krsort( $usage );
			$usage = array_slice( $usage, 0, self::MONTHS_KEPT, true );

			update_option( self::OPTION_KEY, $usage, false );
		}

		/**
		 * Fold a new 'ua:' bucket into 'other' once the month holds MAX_UA_CLIENTS of them.
		 *
		 * @param string $client  Client bucket.
		 * @param array  $clients The month's client bucket => count map.
		 * @return string
		 */
		protected static function bucket_client( $client, $clients ) {
			if ( 0 !== strpos( $client, self::UA_PREFIX ) || isset( $clients[ $client ] ) ) {
				return $client;
			}

			return self::count_ua_clients( $clients ) >= self::MAX_UA_CLIENTS ? 'other' : $client;
		}

		/**
		 * Number of 'ua:' buckets in a month's client map.
		 *
		 * @param array $clients Client bucket => count.
		 * @return int
		 */
		protected static function count_ua_clients( $clients ) {
			$count = 0;

			foreach ( array_keys( $clients ) as $client ) {
				if ( 0 === strpos( (string) $client, self::UA_PREFIX ) ) {
					++$count;
				}
			}

			return $count;
		}

		/**
		 * Read and validate the monthly usage option.
		 *
		 * Drops malformed months, ability names, channels, counters, client
		 * buckets and non-positive counts, so callers can trust the result.
		 *
		 * @return array<string, array> Month ('Y_m') => array( 'total', 'abilities', 'clients' ), newest first.
		 */
		public static function get_monthly_usage() {
			$raw = get_option( self::OPTION_KEY, array() );

			if ( ! is_array( $raw ) ) {
				return array();
			}

			$usage = array();

			foreach ( $raw as $month => $bucket ) {
				if ( ! is_string( $month ) || ! preg_match( '#^\d{4}_(0[1-9]|1[0-2])$#', $month ) || ! is_array( $bucket ) ) {
					continue;
				}

				$total     = ( isset( $bucket['total'] ) && is_numeric( $bucket['total'] ) ) ? max( 0, (int) $bucket['total'] ) : 0;
				$abilities = isset( $bucket['abilities'] ) ? self::sanitize_abilities( $bucket['abilities'] ) : array();
				$clients   = array();

				if ( isset( $bucket['clients'] ) && is_array( $bucket['clients'] ) ) {
					foreach ( $bucket['clients'] as $client => $count ) {
						if ( self::is_client_bucket( $client ) && self::is_positive_count( $count ) ) {
							$clients[ $client ] = (int) $count;
						}
					}
				}

				if ( 0 === $total && empty( $abilities ) && empty( $clients ) ) {
					continue;
				}

				$usage[ $month ] = array(
					'total'     => $total,
					'abilities' => $abilities,
					'clients'   => $clients,
				);
			}

			krsort( $usage );

			return $usage;
		}

		/**
		 * Drop malformed ability names, channels, counters and counts.
		 *
		 * @param mixed $stored Stored 'abilities' map.
		 * @return array
		 */
		protected static function sanitize_abilities( $stored ) {
			$abilities = array();

			if ( ! is_array( $stored ) ) {
				return $abilities;
			}

			foreach ( $stored as $name => $channels ) {
				if ( ! is_string( $name ) || ! preg_match( '#^sydney/[a-z0-9_-]+$#', $name ) || ! is_array( $channels ) ) {
					continue;
				}

				foreach ( $channels as $channel => $counters ) {
					if ( ! in_array( $channel, self::CHANNELS, true ) || ! is_array( $counters ) ) {
						continue;
					}

					foreach ( $counters as $counter => $count ) {
						if ( in_array( $counter, self::COUNTERS, true ) && self::is_positive_count( $count ) ) {
							$abilities[ $name ][ $channel ][ $counter ] = (int) $count;
						}
					}
				}
			}

			return $abilities;
		}

		/**
		 * Whether a stored count is a positive integer.
		 *
		 * @param mixed $count Stored count.
		 * @return bool
		 */
		protected static function is_positive_count( $count ) {
			return is_numeric( $count ) && (int) $count >= 1;
		}

		/**
		 * Whether a key is a valid client bucket.
		 *
		 * @param mixed $client Stored client key.
		 * @return bool
		 */
		protected static function is_client_bucket( $client ) {
			if ( ! is_string( $client ) ) {
				return false;
			}

			return in_array( $client, self::FIXED_CLIENTS, true ) || (bool) preg_match( '#^' . preg_quote( self::UA_PREFIX, '#' ) . '[a-z0-9._-]{1,32}$#', $client );
		}

		/**
		 * The 'Y_m' month before $month (default: the current UTC month).
		 *
		 * @param string|null $month 'Y_m' month.
		 * @return string
		 */
		public static function previous_month( $month = null ) {
			$month = is_string( $month ) ? $month : gmdate( 'Y_m' );
			$year  = (int) substr( $month, 0, 4 );
			$num   = (int) substr( $month, 5, 2 ) - 1;

			if ( $num < 1 ) {
				$num = 12;
				--$year;
			}

			return sprintf( '%04d_%02d', $year, $num );
		}

		/**
		 * Number of POST fields a value becomes once form-encoded.
		 *
		 * @param mixed $value Payload value.
		 * @return int
		 */
		public static function count_fields( $value ) {
			if ( is_array( $value ) ) {
				$count = 0;

				foreach ( $value as $child ) {
					$count += self::count_fields( $child );
				}

				return $count;
			}

			return null === $value ? 0 : 1;
		}

		/**
		 * Add one field per stored month to the weekly usage snapshot.
		 *
		 * Every month carries 'total' and 'clients'. 'abilities' is sent for
		 * the current and previous month only, and dropped oldest month first
		 * while the payload would exceed FIELD_BUDGET. Runs at priority 100 so
		 * it counts the fields every other callback added.
		 *
		 * @param array $data Snapshot payload.
		 * @return array
		 */
		public static function add_usage_tracking_data( $data ) {
			$previous = self::previous_month();
			$fields   = array();

			foreach ( self::get_monthly_usage() as $month => $bucket ) {
				$field = array( 'total' => $bucket['total'] );

				if ( $month >= $previous && ! empty( $bucket['abilities'] ) ) {
					$field['abilities'] = $bucket['abilities'];
				}

				$field['clients'] = $bucket['clients'];

				$fields[ $month ] = $field;
			}

			$base = self::count_fields( $data );

			foreach ( array_reverse( array_keys( $fields ) ) as $month ) {
				if ( $base + self::count_fields( $fields ) <= self::FIELD_BUDGET ) {
					break;
				}

				unset( $fields[ $month ]['abilities'] );
			}

			foreach ( $fields as $month => $field ) {
				$data[ self::FIELD_PREFIX . $month ] = $field;
			}

			return $data;
		}
	}

endif;
