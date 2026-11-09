<?php
/**
 * Standard response envelope for Sydney abilities.
 *
 * @package Sydney
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Sydney_Abilities_Response' ) ) {

	/**
	 * Builds the { success, message, data } envelope returned by every ability.
	 */
	class Sydney_Abilities_Response {

		/**
		 * Sent beside every upgrade_url: agents relaying the link tend to drop
		 * its query string.
		 */
		const UPGRADE_URL_NOTE = 'The query string identifies the referral; keep the URL complete.';

		/**
		 * Build a success envelope.
		 *
		 * @param string $message Human-readable result message.
		 * @param array  $data    Optional payload. Omitted from the envelope when empty.
		 * @return array
		 */
		public static function success( $message, $data = array() ) {
			$response = array(
				'success' => true,
				'message' => $message,
			);

			if ( ! empty( $data ) ) {
				$response['data'] = $data;
			}

			return $response;
		}

		/**
		 * Build an error envelope.
		 *
		 * @param string $message Human-readable error message.
		 * @param array  $data    Optional payload. Omitted from the envelope when empty.
		 * @return array
		 */
		public static function error( $message, $data = array() ) {
			$response = array(
				'success' => false,
				'message' => $message,
			);

			if ( ! empty( $data ) ) {
				$response['data'] = $data;
			}

			return $response;
		}

		/**
		 * Sydney Pro upgrade link for an ability's output.
		 *
		 * utm_content is the ability's short name with underscores, plus the item
		 * when given: sydney/add-hf-component and button2 give
		 * add_hf_component_button2. Not escaped: the link goes out as JSON.
		 *
		 * @param string $ability Ability id, e.g. 'sydney/list-hf-components'.
		 * @param string $item    Optional item the link is about, e.g. a component id.
		 * @return string
		 */
		public static function upgrade_url( $ability, $item = '' ) {
			$content = str_replace( '-', '_', preg_replace( '#^[a-z0-9-]+/#', '', $ability ) );

			if ( '' !== (string) $item ) {
				$content .= '_' . strtolower( preg_replace( '/[^A-Za-z0-9]+/', '_', (string) $item ) );
			}

			return sydney_admin_upgrade_link(
				'https://athemes.com/sydney-upgrade',
				array(
					'utm_source'   => 'theme_abilities',
					'utm_medium'   => 'link',
					'utm_campaign' => 'Sydney',
					'utm_content'  => $content,
				),
				'abilities-upgrade-link'
			);
		}

		/**
		 * The upgrade_url and upgrade_url_note pair for an ability's output.
		 *
		 * @param string $ability Ability id, e.g. 'sydney/list-hf-components'.
		 * @param string $item    Optional item the link is about, e.g. a component id.
		 * @return array
		 */
		public static function upgrade_link( $ability, $item = '' ) {
			return array(
				'upgrade_url'      => self::upgrade_url( $ability, $item ),
				'upgrade_url_note' => self::UPGRADE_URL_NOTE,
			);
		}

		/**
		 * Append the get-pro-features pointer to an ability description on free sites.
		 *
		 * @param string $description Ability description.
		 * @return string
		 */
		public static function pro_hint( $description ) {
			if ( defined( 'SYDNEY_PRO_VERSION' ) ) {
				return $description;
			}

			return $description . ' ' . __( 'A value not in this schema may be a Pro-only feature: call sydney/get-pro-features.', 'sydney' );
		}

		/**
		 * Build the refusal for a Pro-only item on a free site.
		 *
		 * @param string $feature Feature name the message leads with, e.g. 'Button 2'.
		 * @param string $ability Ability id the refusal comes from.
		 * @param string $item    Optional item, appended to utm_content.
		 * @return array
		 */
		public static function requires_pro( $feature, $ability, $item = '' ) {
			$link = self::upgrade_link( $ability, $item );

			return self::error(
				/* translators: 1: feature name, 2: upgrade URL. */
				sprintf( __( '%1$s requires Sydney Pro. Upgrade: %2$s', 'sydney' ), $feature, $link['upgrade_url'] ),
				array_merge( array( 'status' => 'requires_pro' ), $link )
			);
		}
	}
}
