<?php
/**
 * Pattern Library usage tracking.
 *
 * Records which patterns get inserted, bucketed per calendar month (UTC),
 * and surfaces the buckets in the weekly usage-tracking snapshot. Buckets
 * hold per-site insert counts (how many times pattern X was inserted in
 * month M). Reported as associative slug => count maps because the usage
 * API explodes associative arrays into one settings row per key, which is
 * what makes per-pattern-per-month rows queryable in Metabase. See issue
 * #440 and docs/superpowers/specs/2026-07-08-pattern-library-usage-tracking-design.md.
 *
 * This file is required from class-sydney-pattern-library.php after its
 * module-active guard, so it is inert when the pattern-library module is off.
 *
 * @package Sydney
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Sydney_Pattern_Library_Tracking' ) ) {

	/**
	 * Sydney Pattern Library usage tracking.
	 */
	class Sydney_Pattern_Library_Tracking {

		/**
		 * Site option holding the month-keyed used-pattern buckets.
		 *
		 * Shape: array( 'Y_m' => array( 'sydney/hero-1' => 3, ... ), ... ),
		 * insert counts per pattern, newest month first.
		 */
		const OPTION_KEY = 'sydney_pattern_library_monthly_usage';

		/**
		 * Rolling window: number of newest month buckets kept and reported.
		 * Months older than this drop out of the option (and therefore out
		 * of the snapshot and, on the next weekly report, out of the
		 * usage-tracking database).
		 */
		const MONTHS_KEPT = 12;

		/**
		 * Record a pattern insert into a month bucket.
		 *
		 * Every insert increments the pattern's counter for the month.
		 *
		 * @param string $pattern Validated pattern name (sydney/... or sydney-pro/...).
		 * @param string $month   Optional 'Y_m' month key; defaults to the current UTC month.
		 */
		public static function record_insert( $pattern, $month = null ) {
			$usage = self::get_monthly_usage();
			$month = is_string( $month ) && '' !== $month ? $month : gmdate( 'Y_m' );

			if ( ! isset( $usage[ $month ] ) ) {
				$usage[ $month ] = array();
			}

			$usage[ $month ][ $pattern ] = isset( $usage[ $month ][ $pattern ] ) ? $usage[ $month ][ $pattern ] + 1 : 1;

			// Keep only the newest MONTHS_KEPT buckets. 'Y_m' keys are
			// fixed-width, so reverse key sort is reverse chronological.
			krsort( $usage );
			$usage = array_slice( $usage, 0, self::MONTHS_KEPT, true );

			update_option( self::OPTION_KEY, $usage, false );
		}

		/**
		 * Read and validate the monthly usage option.
		 *
		 * Filters out malformed month keys, non-array buckets, invalid
		 * pattern names, and non-positive counts so callers can treat the
		 * result as authoritative (same defensive-read contract as
		 * Sydney_Pattern_Library's user meta readers).
		 *
		 * @return array<string, array<string, int>> Month ('Y_m') => pattern name => insert count.
		 */
		public static function get_monthly_usage() {
			$raw = get_option( self::OPTION_KEY, array() );

			if ( ! is_array( $raw ) ) {
				return array();
			}

			$usage = array();

			foreach ( $raw as $month => $patterns ) {
				if ( ! is_string( $month ) || ! preg_match( '#^\d{4}_(0[1-9]|1[0-2])$#', $month ) || ! is_array( $patterns ) ) {
					continue;
				}

				$valid = array();
				foreach ( $patterns as $pattern => $count ) {
					if ( ! is_string( $pattern ) || ! preg_match( '#^sydney(-pro)?/[a-z0-9_-]+$#', $pattern ) ) {
						continue;
					}
					if ( ! is_numeric( $count ) || (int) $count < 1 ) {
						continue;
					}
					$valid[ $pattern ] = (int) $count;
				}

				if ( empty( $valid ) ) {
					continue;
				}

				$usage[ $month ] = $valid;
			}

			return $usage;
		}

		/**
		 * Add month-keyed used-pattern fields to the weekly usage snapshot.
		 *
		 * One field per stored month, e.g.:
		 *   'athemes_sydney_patterns_2026_06' => array( 'sydney/hero-1' => 3 )
		 *
		 * Runs only inside the consent-gated snapshot build, so no separate
		 * consent handling is needed here.
		 *
		 * @param array $data Existing snapshot payload.
		 * @return array
		 */
		public static function add_usage_tracking_data( $data ) {
			foreach ( self::get_monthly_usage() as $month => $patterns ) {
				$data[ 'athemes_sydney_patterns_' . $month ] = $patterns;
			}

			return $data;
		}
	}

	add_filter( 'sydney_usage_tracking_data', array( 'Sydney_Pattern_Library_Tracking', 'add_usage_tracking_data' ) );
}
