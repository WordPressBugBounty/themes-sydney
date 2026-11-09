<?php
/**
 * Pro starter sites in the aThemes Starter Sites plugin's abilities, on free
 * sites only.
 *
 * The plugin is shared by several themes and stays unchanged: its two
 * abilities are wrapped through core's ability execution hooks (WordPress
 * 7.1+). list-sites gains a pro_only block, and import-site is refused for a
 * Pro demo before the import runs.
 *
 * @package Sydney
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Sydney_Abilities_Starter_Sites_Pro' ) ) :

	/**
	 * Sydney_Abilities_Starter_Sites_Pro class.
	 */
	class Sydney_Abilities_Starter_Sites_Pro {

		/**
		 * The plugin's list ability.
		 */
		const LIST_ABILITY = 'athemes-starter-sites/list-sites';

		/**
		 * The plugin's import ability.
		 */
		const IMPORT_ABILITY = 'athemes-starter-sites/import-site';

		/**
		 * Pro demos the plugin registers, as id => name.
		 *
		 * @return array
		 */
		public static function pro_demos() {
			$demos = apply_filters( 'atss_register_demos_list', array() ); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound
			$pro   = array();

			if ( ! is_array( $demos ) ) {
				return $pro;
			}

			foreach ( $demos as $demo_id => $demo ) {
				if ( is_array( $demo ) && isset( $demo['type'] ) && 'pro' === $demo['type'] ) {
					$pro[ (string) $demo_id ] = isset( $demo['name'] ) ? html_entity_decode( (string) $demo['name'], ENT_QUOTES, 'UTF-8' ) : (string) $demo_id;
				}
			}

			return $pro;
		}

		/**
		 * Add the Pro demo ids to a successful list-sites result.
		 *
		 * Hooked to wp_ability_execute_result.
		 *
		 * @param mixed  $result       The ability's result.
		 * @param string $ability_name The ability's name.
		 * @return mixed
		 */
		public static function add_pro_sites( $result, $ability_name ) {
			if ( self::LIST_ABILITY !== $ability_name || defined( 'SYDNEY_PRO_VERSION' ) || ! is_array( $result ) || empty( $result['success'] ) ) {
				return $result;
			}

			$pro = self::pro_demos();

			if ( empty( $pro ) ) {
				return $result;
			}

			self::load_response();

			$result['data']['pro_only'] = array_merge(
				array( 'sites' => array_keys( $pro ) ),
				Sydney_Abilities_Response::upgrade_link( self::LIST_ABILITY )
			);

			return $result;
		}

		/**
		 * Refuse to import a Pro demo, before the import runs.
		 *
		 * Hooked to wp_pre_execute_ability, which fires before core normalizes
		 * and validates the input and checks permissions, so this checks the
		 * plugin's capability floor and the raw demo_id itself.
		 *
		 * @param mixed  $pre          The short-circuit value. Returned unchanged to let the import run.
		 * @param string $ability_name The ability's name.
		 * @param mixed  $input        The raw ability input.
		 * @return mixed
		 */
		public static function refuse_pro_import( $pre, $ability_name, $input ) {
			if ( self::IMPORT_ABILITY !== $ability_name || defined( 'SYDNEY_PRO_VERSION' ) ) {
				return $pre;
			}

			if ( ! current_user_can( 'edit_theme_options' ) || ! current_user_can( 'install_plugins' ) ) {
				return $pre;
			}

			if ( ! is_array( $input ) || ! isset( $input['demo_id'] ) || ! is_string( $input['demo_id'] ) ) {
				return $pre;
			}

			$demo_id = sanitize_text_field( $input['demo_id'] );
			$pro     = self::pro_demos();

			if ( ! isset( $pro[ $demo_id ] ) ) {
				return $pre;
			}

			self::load_response();

			return Sydney_Abilities_Response::requires_pro(
				/* translators: %s: starter site name. */
				sprintf( __( 'The %s starter site', 'sydney' ), $pro[ $demo_id ] ),
				self::IMPORT_ABILITY,
				$demo_id
			);
		}

		/**
		 * Load the response envelope class, which the registry otherwise loads
		 * only when Sydney's own abilities register.
		 */
		protected static function load_response() {
			if ( ! class_exists( 'Sydney_Abilities_Response' ) ) {
				require_once get_template_directory() . '/inc/abilities/class-sydney-abilities-response.php';
			}
		}
	}

endif;
