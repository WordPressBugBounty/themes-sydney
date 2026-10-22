<?php
/**
 * Upgrade from Sydney to Sydney Pro with a license key.
 *
 * The Settings tab's "Get Sydney Pro" card takes a license key and runs three
 * admin-ajax steps in order: activate the key, install the Sydney Pro theme,
 * switch to it. Ships in the free edition only (.github/pro-exclude.txt).
 *
 * @package Sydney
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * One-click upgrade to Sydney Pro.
 */
class Sydney_Pro_Upgrade {

	/**
	 * Sydney Pro's theme folder, also its product slug on the licensing API.
	 */
	const THEME_SLUG = 'sydney-pro-ii';

	/**
	 * aThemes license-api base URL (tgm-updater protocol).
	 */
	const API_URL = 'https://athemes.com/license-api';

	/*
	 * The license options the aThemes licensing client in Sydney Pro reads
	 * and writes (its LicenseStorage). Writing the same four rows on
	 * activation is what makes Pro boot already licensed after the switch.
	 */
	const KEY_OPTION        = 'sydney-pro-ii_license_key';
	const STATUS_OPTION     = 'sydney_pro_license_status';
	const TYPE_OPTION       = 'sydney_pro_license_type';
	const NEXT_CHECK_OPTION = 'sydney-pro-ii_license_next_check';

	/**
	 * When the site last switched from Sydney to Sydney Pro, and from where:
	 * `dashboard` for this card, `manual` for anything else. The shared usage
	 * tracking reads both by name on Pro, where this class does not exist.
	 */
	const UPGRADE_DATE_OPTION   = 'sydney_pro_upgrade_date';
	const UPGRADE_SOURCE_OPTION = 'sydney_pro_upgrade_source';

	/**
	 * Set once the upgrader is about to write Sydney Pro's files and cleared
	 * once it finished. A server that dies part-way through a copy can leave
	 * a folder that passes pro_installed() but misses files, so this flag,
	 * not the folder, says whether the last install completed. A failure
	 * before any file is written leaves it unset, so a Pro uploaded by hand
	 * afterwards can still be switched to.
	 */
	const INSTALLING_OPTION = 'sydney_pro_upgrade_installing';

	/**
	 * The first Sydney Pro on the license-api client, which reads the license
	 * options this class writes and updates itself through the license-api.
	 */
	const MIN_PRO_VERSION = '4.3.1';

	/**
	 * Output buffer level when an AJAX step started.
	 *
	 * @var int
	 */
	private $buffer_level = 0;

	/**
	 * Where the switch in progress came from, read by record_switch().
	 *
	 * @var string
	 */
	private static $switch_source = '';

	/**
	 * Register the three AJAX steps.
	 */
	public function register() {
		add_action( 'wp_ajax_sydney_pro_upgrade_activate', array( $this, 'ajax_activate' ) );
		add_action( 'wp_ajax_sydney_pro_upgrade_install', array( $this, 'ajax_install' ) );
		add_action( 'wp_ajax_sydney_pro_upgrade_switch', array( $this, 'ajax_switch' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'switch_theme', array( $this, 'record_switch' ), 10, 3 );
	}

	/**
	 * Record a switch from Sydney to Sydney Pro: the card, Appearance > Themes
	 * or WP-CLI. Runs in the switching request, while Sydney's code is still
	 * the one loaded. Not reached from the Customizer's Activate & Publish,
	 * whose save request runs Sydney Pro's code, and not recorded for Sydney
	 * installed under another folder name than sydney.
	 *
	 * @param string   $new_name  New theme name.
	 * @param WP_Theme $new_theme New theme.
	 * @param WP_Theme $old_theme Previous theme.
	 */
	public function record_switch( $new_name, $new_theme, $old_theme ) {
		if ( 'sydney' !== $old_theme->get_template() || self::THEME_SLUG !== $new_theme->get_template() ) {
			return;
		}

		update_option( self::UPGRADE_DATE_OPTION, time(), false );
		update_option( self::UPGRADE_SOURCE_OPTION, self::$switch_source ? self::$switch_source : 'manual', false );
	}

	/**
	 * Load Sydney Pro's license styles on the dashboard, so a failed key
	 * check looks like Pro's own license form: the button spinner and the
	 * error popup.
	 *
	 * @param string $hook Admin page hook suffix.
	 */
	public function enqueue_styles( $hook ) {
		if ( 'toplevel_page_sydney-dashboard' !== $hook || ! self::can_upgrade() ) {
			return;
		}

		wp_enqueue_style( 'sydney-pro-upgrade-license', get_template_directory_uri() . '/inc/dashboard/assets/css/license.css', array(), '20261015' );
	}

	/**
	 * Whether the current user can finish the upgrade on this site.
	 *
	 * Never on Pro, and never on multisite, where installing and enabling a
	 * theme is a network decision. Only when the active theme is the sydney
	 * folder itself: Pro imports Customizer settings from that folder alone,
	 * so Sydney installed under another folder name would lose them, and a
	 * child theme would also stop loading. Only for a user with
	 * manage_options and switch_themes: the steps write the license options,
	 * which Sydney Pro's own license form and the dashboard page both keep to
	 * manage_options. Downloading Pro needs install_themes, which
	 * DISALLOW_FILE_MODS revokes, but a usable Pro theme already on disk only
	 * needs the switch, so it stays available then.
	 *
	 * @return bool
	 */
	public static function can_upgrade() {
		if ( defined( 'SYDNEY_PRO_VERSION' ) || is_multisite() || 'sydney' !== get_stylesheet() || ! current_user_can( 'manage_options' ) || ! current_user_can( 'switch_themes' ) ) {
			return false;
		}

		if ( self::pro_installed() ) {
			return true;
		}

		return current_user_can( 'install_themes' ) && wp_is_file_mod_allowed( 'sydney_pro_upgrade' );
	}

	/**
	 * Whether a usable Sydney Pro theme is on disk. A folder whose style.css
	 * is missing or broken does not count. Neither does a Pro older than
	 * MIN_PRO_VERSION: it reads other license options or updates through a
	 * retired service.
	 *
	 * @return bool
	 */
	public static function pro_installed() {
		$theme = wp_get_theme( self::THEME_SLUG );

		return $theme->exists()
			&& ! $theme->errors()
			&& version_compare( (string) $theme->get( 'Version' ), self::MIN_PRO_VERSION, '>=' );
	}

	/**
	 * Activate a license key for this site.
	 *
	 * @param string $key License key.
	 * @return true|WP_Error
	 */
	public function verify_key( $key ) {
		$key = trim( (string) $key );

		if ( '' === $key ) {
			return new WP_Error( 'sydney_pro_upgrade_empty_key', esc_html__( 'Please enter your license key.', 'sydney' ) );
		}

		// A second submit after a failed install sends the key again. It is
		// already active on this site, so the server is not asked again.
		if ( trim( (string) get_option( self::KEY_OPTION, '' ) ) === $key && 'valid' === get_option( self::STATUS_OPTION, '' ) ) {
			return true;
		}

		$data = $this->request( 'verify-key', $key );

		if ( is_wp_error( $data ) ) {
			return $data;
		}

		$problem = $this->license_problem( $data );

		if ( $problem ) {
			return $problem;
		}

		update_option( self::KEY_OPTION, $key, false );
		update_option( self::STATUS_OPTION, 'valid', false );
		update_option( self::TYPE_OPTION, sanitize_text_field( isset( $data['type'] ) ? (string) $data['type'] : '' ), false );
		update_option( self::NEXT_CHECK_OPTION, time() + DAY_IN_SECONDS, false );

		return true;
	}

	/**
	 * Fetch the signed Sydney Pro download URL for the stored key.
	 *
	 * The URL expires and is bound to this site, so it is fetched right
	 * before the download and never cached.
	 *
	 * @return string|WP_Error
	 */
	public function get_package_url() {
		$key = trim( (string) get_option( self::KEY_OPTION, '' ) );

		if ( '' === $key ) {
			return new WP_Error(
				'sydney_pro_upgrade_no_key',
				esc_html__( 'No license key found. Please activate your license first, or install Sydney Pro manually from your aThemes account.', 'sydney' )
			);
		}

		$data = $this->request( 'get-plugin-update', $key );

		if ( is_wp_error( $data ) ) {
			return $data;
		}

		$problem = $this->license_problem( $data );

		if ( $problem ) {
			// The stored key no longer works. Record that the way the licensing
			// client's daily check would, so the next submit asks the server
			// again instead of trusting the stale 'valid'.
			$problem_data = $problem->get_error_data();
			update_option( self::STATUS_OPTION, $problem_data['status'], false );

			return $problem;
		}

		if ( empty( $data['package'] ) || ! is_string( $data['package'] ) ) {
			return new WP_Error(
				'sydney_pro_upgrade_no_package',
				esc_html__( 'Could not retrieve the Sydney Pro download. Please check your license in your aThemes account, or install Sydney Pro manually from there.', 'sydney' )
			);
		}

		return $data['package'];
	}

	/**
	 * Download and install the Sydney Pro theme, unless a usable copy is
	 * already on disk and no earlier install of it was cut short.
	 *
	 * @return true|WP_Error
	 */
	public function install_theme() {
		if ( self::pro_installed() && ! get_option( self::INSTALLING_OPTION ) ) {
			return true;
		}

		// can_upgrade() skips this check when a usable Pro is on disk, but a
		// cut-short install of that Pro still downloads and writes files.
		if ( ! current_user_can( 'install_themes' ) || ! wp_is_file_mod_allowed( 'sydney_pro_upgrade' ) ) {
			return new WP_Error(
				'sydney_pro_upgrade_file_mods',
				esc_html__( 'Sydney Pro could not be installed. Please install it manually from your aThemes account.', 'sydney' )
			);
		}

		$package = $this->get_package_url();

		if ( is_wp_error( $package ) ) {
			return $package;
		}

		$result = $this->run_upgrader( $package );

		if ( is_wp_error( $result ) ) {
			return $result;
		}

		delete_option( self::INSTALLING_OPTION );

		if ( ! self::pro_installed() ) {
			return new WP_Error(
				'sydney_pro_upgrade_install',
				esc_html__( 'Sydney Pro could not be installed. Please install it manually from your aThemes account.', 'sydney' )
			);
		}

		return true;
	}

	/**
	 * Switch the active theme to Sydney Pro.
	 *
	 * @return true|WP_Error
	 */
	public function switch_to_pro() {
		// A folder an interrupted install left behind can look usable while
		// missing files, and activating it would break the whole site.
		if ( ! self::pro_installed() || get_option( self::INSTALLING_OPTION ) ) {
			return new WP_Error(
				'sydney_pro_upgrade_switch',
				esc_html__( 'Sydney Pro is not installed correctly, so the theme was not switched. Please check Appearance > Themes, or install Sydney Pro manually from your aThemes account.', 'sydney' )
			);
		}

		// A copy already on disk skipped the upgrader's own PHP and WordPress
		// version check (WordPress 5.5+), so check before switching to it.
		if ( function_exists( 'validate_theme_requirements' ) ) {
			$requirements = validate_theme_requirements( self::THEME_SLUG );

			if ( is_wp_error( $requirements ) ) {
				return $requirements;
			}
		}

		self::$switch_source = 'dashboard';
		switch_theme( self::THEME_SLUG );
		self::$switch_source = '';

		return true;
	}

	/**
	 * Unpack a theme package into the themes folder with WordPress's
	 * upgrader. Kept apart from install_theme() so the decisions there are
	 * testable without the upgrader.
	 *
	 * @param string $package Package URL.
	 * @return true|WP_Error
	 */
	protected function run_upgrader( $package ) {
		$filesystem = $this->check_filesystem();

		if ( is_wp_error( $filesystem ) ) {
			return $filesystem;
		}

		require_once ABSPATH . 'wp-admin/includes/misc.php';
		require_once ABSPATH . 'wp-admin/includes/theme.php';
		require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';

		// The language pack updater would print into the JSON response.
		remove_action( 'upgrader_process_complete', array( 'Language_Pack_Upgrader', 'async_upgrade' ), 20 );

		$skin     = new WP_Ajax_Upgrader_Skin();
		$upgrader = new Theme_Upgrader( $skin );

		// install_theme() only gets here when no usable Pro is on disk or the
		// last install was cut short, so a folder already there is a leftover
		// or a Pro older than MIN_PRO_VERSION, and gets replaced.
		add_filter( 'upgrader_source_selection', array( $this, 'guard_package_source' ), 20 );
		$result = $upgrader->install( $package, array( 'overwrite_package' => true ) );
		remove_filter( 'upgrader_source_selection', array( $this, 'guard_package_source' ), 20 );

		// Every error the upgrader meets also reaches the skin, and
		// get_error_messages() adds each error's data to its message: a failed
		// download reads "Download failed. Forbidden" and a rejected package
		// names the PHP or WordPress version it needs, as on WordPress's own
		// theme installer. The same errors on their own carry only the
		// generic message, so they are the fallback.
		if ( $skin->get_errors()->get_error_code() ) {
			return new WP_Error( $skin->get_errors()->get_error_code(), $skin->get_error_messages() );
		}

		if ( is_wp_error( $result ) ) {
			return $result;
		}

		if ( is_wp_error( $skin->result ) ) {
			return $skin->result;
		}

		if ( ! $result ) {
			return new WP_Error(
				'sydney_pro_upgrade_install',
				esc_html__( 'Sydney Pro could not be installed. Please install it manually from your aThemes account.', 'sydney' )
			);
		}

		return true;
	}

	/**
	 * Check the unpacked package right before the upgrader clears its
	 * destination and copies the files, and mark the install in progress.
	 *
	 * Runs on upgrader_source_selection after Theme_Upgrader::check_package(),
	 * so a package WordPress refused arrives as a WP_Error and is passed on.
	 * The upgrader names the destination after the package's root folder and
	 * clears it, so a package rooted anywhere but sydney-pro-ii could delete
	 * another theme, the active free theme included.
	 *
	 * @param string|WP_Error $source Unpacked package folder, or an earlier error.
	 * @return string|WP_Error
	 */
	public function guard_package_source( $source ) {
		if ( is_wp_error( $source ) ) {
			return $source;
		}

		// The same expression the upgrader uses to name the destination.
		if ( self::THEME_SLUG !== basename( $source ) ) {
			return new WP_Error(
				'sydney_pro_upgrade_package',
				esc_html__( 'The Sydney Pro download is not packaged as expected, so nothing was installed. Please install Sydney Pro manually from your aThemes account.', 'sydney' )
			);
		}

		update_option( self::INSTALLING_OPTION, time(), false );

		return $source;
	}

	/**
	 * Whether WordPress can write to the themes folder without asking for
	 * credentials.
	 *
	 * @return true|WP_Error
	 */
	protected function check_filesystem() {
		if ( ! function_exists( 'request_filesystem_credentials' ) ) {
			require_once ABSPATH . 'wp-admin/includes/file.php';
		}

		// Without direct access WordPress prints an FTP credentials form,
		// which an AJAX response cannot show.
		ob_start();
		$creds = request_filesystem_credentials( admin_url( 'admin.php?page=sydney-dashboard&tab=settings' ) );
		ob_end_clean();

		if ( false === $creds || ! WP_Filesystem( $creds ) ) {
			return new WP_Error(
				'sydney_pro_upgrade_filesystem',
				esc_html__( 'Could not access the file system. Please check file permissions and try again, or install Sydney Pro manually from your aThemes account.', 'sydney' )
			);
		}

		return true;
	}

	/**
	 * AJAX step 1: activate the license key.
	 */
	public function ajax_activate() {
		$this->guard();

		$key = isset( $_POST['license_key'] ) ? sanitize_text_field( wp_unslash( $_POST['license_key'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Missing -- verified in guard().

		$this->respond( $this->verify_key( $key ) );
	}

	/**
	 * AJAX step 2: download and install Sydney Pro.
	 */
	public function ajax_install() {
		$this->guard();

		$this->respond( $this->install_theme() );
	}

	/**
	 * AJAX step 3: switch to Sydney Pro and hand back its dashboard URL.
	 */
	public function ajax_switch() {
		$this->guard();

		$result = $this->switch_to_pro();

		if ( is_wp_error( $result ) ) {
			$this->respond( $result );
		}

		$this->discard_output();

		wp_send_json_success(
			array(
				'redirect' => esc_url_raw( admin_url( 'admin.php?page=sydney-dashboard' ) ),
			)
		);
	}

	/**
	 * Stop the request unless the nonce is valid and the user can upgrade,
	 * then start catching output. An expired nonce ends the request with
	 * HTTP 403, which the browser reports as an expired session.
	 */
	private function guard() {
		check_ajax_referer( 'nonce-bt-dashboard', 'nonce' );

		if ( ! self::can_upgrade() ) {
			wp_send_json_error( array( 'message' => esc_html__( 'You are not allowed to upgrade to Sydney Pro on this site.', 'sydney' ) ) );
		}

		// A notice or warning that any code prints during the step would
		// corrupt the JSON response, so it is caught and dropped.
		$this->buffer_level = ob_get_level();
		ob_start();
	}

	/**
	 * Drop whatever the step printed, leaving buffers opened by others alone.
	 */
	private function discard_output() {
		while ( ob_get_level() > $this->buffer_level ) {
			ob_end_clean();
		}
	}

	/**
	 * Send a step's outcome. Messages may carry a link (the license server's
	 * renew link), so links survive and every other tag is stripped.
	 *
	 * @param true|WP_Error $result Step result.
	 */
	private function respond( $result ) {
		$this->discard_output();

		if ( is_wp_error( $result ) ) {
			wp_send_json_error(
				array(
					'message' => wp_kses(
						$result->get_error_message(),
						array(
							'a' => array(
								'href'   => array(),
								'target' => array(),
								'rel'    => array(),
								'title'  => array(),
							),
						)
					),
				)
			);
		}

		wp_send_json_success();
	}

	/**
	 * Call the license-api, shaped like the aThemes licensing client's
	 * ApiClient::get(): GET {api}/{action} with the tgm-updater parameters.
	 *
	 * @param string $action verify-key or get-plugin-update.
	 * @param string $key    License key.
	 * @return array|WP_Error The JSON object the server answered, as an array.
	 */
	protected function request( $action, $key ) {
		$api_url = $this->api_url();

		$response = wp_remote_get(
			add_query_arg(
				array(
					'tgm-updater-action'      => $action,
					'tgm-updater-key'         => $key,
					'tgm-updater-plugin'      => self::THEME_SLUG,
					'tgm-updater-wp-version'  => get_bloginfo( 'version' ),
					'tgm-updater-php-version' => PHP_VERSION,
					'tgm-updater-referer'     => site_url(),
				),
				$api_url . '/' . $action
			),
			array(
				'timeout'   => 30,
				'sslverify' => ! $this->is_local_host( $api_url ),
			)
		);

		if ( is_wp_error( $response ) || 200 !== (int) wp_remote_retrieve_response_code( $response ) ) {
			return new WP_Error(
				'sydney_pro_upgrade_http',
				esc_html__( 'Could not reach the aThemes licensing service. Please check your connection and try again, or install Sydney Pro manually from your aThemes account.', 'sydney' )
			);
		}

		$body = wp_remote_retrieve_body( $response );

		// Only a JSON object counts as an answer, as in the licensing client.
		// A list such as [] would otherwise read as a license with no problem.
		if ( ! is_object( json_decode( $body ) ) ) {
			return new WP_Error(
				'sydney_pro_upgrade_response',
				esc_html__( 'Unexpected response from the aThemes licensing service. Please try again later, or install Sydney Pro manually from your aThemes account.', 'sydney' )
			);
		}

		return json_decode( $body, true );
	}

	/**
	 * License-api base URL, honoring the same wp-config overrides as the
	 * licensing client, so QA can point both at a staging store.
	 *
	 * @return string
	 */
	protected function api_url() {
		if ( defined( 'ATHEMES_LICENSING_API_URL' ) ) {
			return untrailingslashit( (string) ATHEMES_LICENSING_API_URL );
		}

		if ( defined( 'ATHEMES_UPDATER_API' ) ) {
			return untrailingslashit( (string) ATHEMES_UPDATER_API );
		}

		return self::API_URL;
	}

	/**
	 * Whether the API runs on a local/dev host with a self-signed certificate.
	 *
	 * @param string $url URL to inspect.
	 * @return bool
	 */
	protected function is_local_host( $url ) {
		$host = wp_parse_url( $url, PHP_URL_HOST );

		if ( ! $host ) {
			return false;
		}

		if ( 'localhost' === $host || '127.0.0.1' === $host ) {
			return true;
		}

		return (bool) preg_match( '/\.(test|local|localhost)$/', $host );
	}

	/**
	 * The license problem a license-api answer reports, read like the
	 * licensing client's validate(): an expired or disabled flag, or an error
	 * field. Any other answer counts as accepted, as in the client's
	 * activate(). The server's own text wins (it can carry a renew link);
	 * get-plugin-update sends only {"error":true}, which gets a readable
	 * fallback instead of "1".
	 *
	 * @param array $data Decoded response.
	 * @return WP_Error|null Error data carries the status to store.
	 */
	protected function license_problem( $data ) {
		if ( ! empty( $data['expired'] ) ) {
			$status   = 'expired';
			$fallback = esc_html__( 'Your Sydney Pro license has expired. Please renew it in your aThemes account, then try again.', 'sydney' );
		} elseif ( ! empty( $data['disabled'] ) ) {
			$status   = 'disabled';
			$fallback = esc_html__( 'This Sydney Pro license has been disabled. Please contact aThemes support.', 'sydney' );
		} elseif ( ! empty( $data['error'] ) ) {
			$status   = 'invalid';
			$fallback = esc_html__( 'Your license could not be verified. Please check it in your aThemes account, or install Sydney Pro manually from there.', 'sydney' );
		} else {
			return null;
		}

		$error   = isset( $data['error'] ) ? $data['error'] : '';
		$message = is_string( $error ) && '' !== trim( $error ) ? $error : $fallback;

		return new WP_Error( 'sydney_pro_upgrade_license', $message, array( 'status' => $status ) );
	}
}

$sydney_pro_upgrade = new Sydney_Pro_Upgrade();
$sydney_pro_upgrade->register();
