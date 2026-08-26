<?php
/**
 * Shared install-and-activate pipeline for the abilities that set up plugins
 * (sydney/ensure-starter-sites-plugin, sydney/install-recommended-plugin).
 *
 * Wraps Sydney_Dashboard's capability-checked installer in the abilities
 * response contract: a blocked environment (missing install_plugins or
 * DISALLOW_FILE_MODS) returns an action-required envelope with a manual
 * install link instead of a boundary 403.
 *
 * @package Sydney
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Sydney_Abilities_Plugin_Installer' ) ) :

	/**
	 * Sydney_Abilities_Plugin_Installer class.
	 */
	class Sydney_Abilities_Plugin_Installer {

		/**
		 * Install and activate one plugin, returning a response envelope.
		 *
		 * @param string $slug       wp.org plugin slug (install source and search term).
		 * @param string $path       Main plugin file (folder/file.php).
		 * @param string $label      Human plugin name used in messages.
		 * @param array  $extra_data Data merged into every envelope (e.g. array( 'slug' => $slug )).
		 * @return array Response envelope.
		 */
		public static function install_and_activate( $slug, $path, $label, array $extra_data = array() ) {

			// Blocked path: missing capability or file modifications disabled.
			$can_install     = current_user_can( 'install_plugins' );
			$file_mods_block = defined( 'DISALLOW_FILE_MODS' ) && DISALLOW_FILE_MODS;

			if ( ! $can_install || $file_mods_block ) {
				$install_url = admin_url( 'plugin-install.php?tab=search&type=term&s=' . $slug );

				$reason = $file_mods_block
					? __( 'File modifications are disabled on this site (DISALLOW_FILE_MODS), so the plugin cannot be installed automatically.', 'sydney' )
					: __( 'You do not have permission to install plugins on this site.', 'sydney' );

				return array(
					'success' => false,
					/* translators: %s: plugin name. */
					'message' => $reason . ' ' . sprintf( __( 'Install the %s plugin manually, then retry.', 'sydney' ), $label ),
					'data'    => array_merge(
						$extra_data,
						array(
							'status'          => 'blocked',
							'action_required' => true,
							'install_url'     => $install_url,
						)
					),
				);
			}

			if ( ! class_exists( 'Sydney_Dashboard' ) ) {
				return Sydney_Abilities_Response::error(
					__( 'The Sydney dashboard installer is unavailable.', 'sydney' )
				);
			}

			$dashboard = new Sydney_Dashboard();
			$status    = $dashboard->get_plugin_status( $path );

			// Already active — nothing to do.
			if ( 'active' === $status ) {
				return Sydney_Abilities_Response::success(
					/* translators: %s: plugin name. */
					sprintf( __( 'The %s plugin is already installed and active.', 'sydney' ), $label ),
					array_merge(
						$extra_data,
						array(
							'status'          => 'active',
							'action_required' => false,
						)
					)
				);
			}

			// Not installed — install first.
			if ( 'not_installed' === $status ) {
				$installed = $dashboard->install_plugin( $slug );
				if ( ! $installed ) {
					return Sydney_Abilities_Response::error(
						/* translators: %s: plugin name. */
						sprintf( __( 'The %s plugin could not be installed.', 'sydney' ), $label )
					);
				}
			} elseif ( 'inactive' !== $status ) {
				// Unrecognized status (e.g. null from a cap-stripped get_plugin_status):
				// do not fall through and misreport an activation failure.
				return Sydney_Abilities_Response::error(
					/* translators: %s: plugin name. */
					sprintf( __( 'Could not determine the %s plugin status.', 'sydney' ), $label )
				);
			}

			// activate_plugin() validates against a plugin list that can be stale on a
			// warm worker or immediately after an install. Force a fresh read.
			if ( ! function_exists( 'wp_clean_plugins_cache' ) ) {
				require_once ABSPATH . 'wp-admin/includes/plugin.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
			}

			clearstatcache();
			wp_clean_plugins_cache( false );

			$activate = $dashboard->activate_plugin( $path );

			if ( is_wp_error( $activate ) ) {
				return Sydney_Abilities_Response::error(
					/* translators: 1: plugin name, 2: activation error message. */
					sprintf( __( 'The %1$s plugin could not be activated: %2$s', 'sydney' ), $label, $activate->get_error_message() )
				);
			}

			$final = $dashboard->get_plugin_status( $path );

			if ( 'active' !== $final ) {
				return Sydney_Abilities_Response::error(
					/* translators: %s: plugin name. */
					sprintf( __( 'The %s plugin was installed but could not be activated.', 'sydney' ), $label )
				);
			}

			return Sydney_Abilities_Response::success(
				/* translators: %s: plugin name. */
				sprintf( __( 'The %s plugin is now installed and active.', 'sydney' ), $label ),
				array_merge(
					$extra_data,
					array(
						'status'          => 'active',
						'action_required' => false,
					)
				)
			);
		}
	}

endif;
