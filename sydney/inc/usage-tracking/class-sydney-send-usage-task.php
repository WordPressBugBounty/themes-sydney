<?php
/**
 * Send Usage Task class.
 *
 * @package Sydney
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Sydney_Send_Usage_Task class.
 */
class Sydney_Send_Usage_Task {

	/**
	 * Action name for this task.
	 */
	const ACTION = 'sydney_send_usage_data';

	/**
	 * Server URL to send requests to.
	 */
	const TRACK_URL = 'https://athemesusage.com/sydney/v1/track';

	/**
	 * Option name to store the timestamp of the last run.
	 */
	const LAST_RUN = 'sydney_send_usage_last_run';

	/**
	 * Initialize the task.
	 */
	public function init() {

		$this->hooks();
	}

	/**
	 * Attach hooks to the WordPress API.
	 */
	public function hooks() {
		
		// Register the action handler.
		add_action( self::ACTION, array( $this, 'process' ) );
	}

	/**
	 * Send the actual data in a POST request.
	 */
	public function process() {

		$last_run = get_option( self::LAST_RUN );

		// Make sure we do not run it more than once a day.
		if (
			$last_run !== false &&
			( time() - $last_run ) < DAY_IN_SECONDS
		) {
			return;
		}

		// Send data to the usage tracking API.
		$ut = new Sydney_Usage_Tracking();

		$response = wp_remote_post(
			self::TRACK_URL,
			array(
				'timeout'     => 5,
				'redirection' => 5,
				'httpversion' => '1.1',
				'blocking'    => true,
				'body'        => $ut->get_data(),
				'user-agent'  => $ut->get_user_agent(),
			)
		);

		// Update the last run option to the current timestamp.
		update_option( self::LAST_RUN, time(), false );

		/**
		 * Action fired after usage data is sent.
		 *
		 * @param array|WP_Error $response The response from the API.
		 */
		do_action( 'sydney_usage_tracking_sent', $response );
	}
}

