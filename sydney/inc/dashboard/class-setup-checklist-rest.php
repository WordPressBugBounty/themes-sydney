<?php
/**
 * REST API for the Setup Checklist.
 *
 * @package Sydney
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sydney_Setup_Checklist_REST {

	const NAMESPACE_BASE = 'sydney/v1';
	const ROUTE_BASE     = 'setup-checklist';

	public function __construct() {
		add_action( 'rest_api_init', array( $this, 'register_routes' ) );
	}

	public function register_routes() {
		register_rest_route(
			self::NAMESPACE_BASE,
			'/' . self::ROUTE_BASE,
			array(
				'methods'             => WP_REST_Server::READABLE,
				'callback'            => array( $this, 'get_state' ),
				'permission_callback' => array( $this, 'permissions_check' ),
			)
		);

		register_rest_route(
			self::NAMESPACE_BASE,
			'/' . self::ROUTE_BASE . '/item/(?P<slug>[a-z0-9_]+)',
			array(
				'methods'             => WP_REST_Server::CREATABLE,
				'callback'            => array( $this, 'toggle_item' ),
				'permission_callback' => array( $this, 'permissions_check' ),
				'args'                => array(
					'slug' => array(
						'sanitize_callback' => 'sanitize_key',
					),
					'complete' => array(
						'type'              => 'boolean',
						'required'          => true,
						'sanitize_callback' => 'rest_sanitize_boolean',
					),
				),
			)
		);

		register_rest_route(
			self::NAMESPACE_BASE,
			'/' . self::ROUTE_BASE . '/homepage',
			array(
				'methods'             => WP_REST_Server::CREATABLE,
				'callback'            => array( $this, 'setup_homepage' ),
				'permission_callback' => array( $this, 'permissions_check' ),
			)
		);
	}

	public function permissions_check() {
		return current_user_can( 'manage_options' );
	}

	public function get_state( $request ) {
		return rest_ensure_response( Sydney_Setup_Checklist::instance()->get_state() );
	}

	public function toggle_item( $request ) {
		$slug      = (string) $request->get_param( 'slug' );
		$complete  = (bool) $request->get_param( 'complete' );
		$checklist = Sydney_Setup_Checklist::instance();

		if ( ! isset( $checklist->get_state()['categories'] ) ) {
			return new WP_Error( 'sydney_setup_invalid', __( 'Checklist unavailable.', 'sydney' ), array( 'status' => 500 ) );
		}

		if ( ! $checklist->has_item( $slug ) ) {
			return new WP_Error( 'sydney_setup_unknown_item', __( 'Unknown checklist item.', 'sydney' ), array( 'status' => 404 ) );
		}

		$checklist->set_manual_state( $slug, $complete );

		if ( $complete ) {
			Sydney_Setup_Checklist::mark_used();
		}

		return rest_ensure_response( array(
			'slug'     => $slug,
			'is_done'  => $checklist->is_done( $slug ),
			'all_done' => $checklist->all_done(),
		) );
	}

	public function setup_homepage( $request ) {
		$result = Sydney_Setup_Checklist::instance()->setup_homepage();

		if ( empty( $result['ok'] ) ) {
			$message = isset( $result['error'] ) ? $result['error'] : __( 'Homepage setup failed.', 'sydney' );
			return new WP_Error( 'sydney_setup_homepage_failed', $message, array( 'status' => 500 ) );
		}

		Sydney_Setup_Checklist::mark_used();

		unset( $result['ok'] );
		return rest_ensure_response( $result );
	}
}

new Sydney_Setup_Checklist_REST();
