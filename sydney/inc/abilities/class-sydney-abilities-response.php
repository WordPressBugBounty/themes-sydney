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
	}
}
