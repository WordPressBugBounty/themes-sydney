<?php
/**
 * Propagates Sydney global-color changes to the linked literal-hex theme_mods.
 *
 * Sydney stores colors in a dual system: a `global_<mod>` (or `global_sydney_<mod>`)
 * theme_mod holds a REFERENCE string such as "global_color_6", and the sibling
 * `<mod>` theme_mod holds the LITERAL hex that actually renders. The Customizer
 * keeps these in sync via its own machinery; abilities run on REST/MCP where that
 * never fires, so we replicate the propagation here. Ported from the starter-sites
 * plugin's ATSS_Onboarding_Customization_Handler::update_sydney_global_color_references().
 *
 * @package Sydney
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Sydney_Color_References' ) ) :

	/**
	 * Sydney_Color_References class.
	 */
	class Sydney_Color_References {

		/**
		 * Compute the linked-literal rewrites for a set of updated slots.
		 *
		 * Pure computation — the caller merges the result into its batched
		 * Sydney_Ability::set_theme_mods() write, so a palette apply stays a
		 * single database UPDATE instead of one per propagated literal.
		 *
		 * @param array $global_color_values Map of global slot name (e.g. 'global_color_6') => new hex.
		 * @return array Map of literal theme_mod name => new hex.
		 */
		public static function resolve( $global_color_values ) {
			if ( empty( $global_color_values ) || ! is_array( $global_color_values ) ) {
				return array();
			}

			$theme_mods = get_theme_mods();

			if ( empty( $theme_mods ) || ! is_array( $theme_mods ) ) {
				return array();
			}

			$pending = array();

			foreach ( $theme_mods as $mod_key => $mod_value ) {
				// Only reference mods, which are prefixed global_ / global_sydney_.
				if ( 0 !== strpos( $mod_key, 'global_sydney_' ) && 0 !== strpos( $mod_key, 'global_' ) ) {
					continue;
				}

				// The value must be a reference string for a slot we are updating.
				// (global_color_N / extra_global_color_N entries hold hexes, not
				// references, so they never match a key in $global_color_values.)
				if ( is_string( $mod_value ) && isset( $global_color_values[ $mod_value ] ) ) {
					$actual_mod_key             = preg_replace( '/^global_/', '', $mod_key );
					$pending[ $actual_mod_key ] = $global_color_values[ $mod_value ];
				}
			}

			return $pending;
		}
	}

endif;
