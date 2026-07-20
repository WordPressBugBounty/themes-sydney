<?php
/**
 * Gating helper for Sydney abilities.
 *
 * Mirrors Sydney_Usage_Tracking: an option-backed master switch plus a
 * separate write switch, both filterable.
 *
 * @package Sydney
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Sydney_Abilities' ) ) :

	/**
	 * Reads the two dashboard gating options for the Abilities API.
	 */
	class Sydney_Abilities {

		/**
		 * Option slug for the master switch.
		 */
		const ENABLED_SLUG = 'sydney-abilities-enabled';

		/**
		 * Option slug for the write switch.
		 */
		const WRITES_SLUG = 'sydney-abilities-allow-writes';

		/**
		 * Whether the abilities system is enabled.
		 *
		 * @return bool
		 */
		public static function is_enabled() {

			/**
			 * Filter whether the Sydney abilities system is enabled.
			 *
			 * @param bool $enabled Whether abilities are enabled.
			 */
			return (bool) apply_filters(
				'sydney_abilities_is_enabled',
				get_option( self::ENABLED_SLUG, 0 )
			);
		}

		/**
		 * Whether write-type abilities are allowed to register.
		 *
		 * @return bool
		 */
		public static function writes_enabled() {

			/**
			 * Filter whether Sydney write abilities are allowed.
			 *
			 * @param bool $enabled Whether write abilities are allowed.
			 */
			return (bool) apply_filters(
				'sydney_abilities_writes_enabled',
				get_option( self::WRITES_SLUG, 0 )
			);
		}
	}

endif;
