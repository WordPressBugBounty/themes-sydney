<?php
/**
 * Starter-sites ability group: registers and executes
 * sydney/ensure-starter-sites-plugin, which installs/activates the aThemes
 * Starter Sites plugin on demand so an agent can reach the plugin-owned
 * list/import abilities. Write-only.
 *
 * @package Sydney
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Sydney_Abilities_Starter_Sites' ) ) :

	/**
	 * Sydney_Abilities_Starter_Sites class.
	 */
	class Sydney_Abilities_Starter_Sites {

		/**
		 * Register the starter-sites bootstrap ability (write only).
		 *
		 * This is the single theme-side starter-sites ability: it installs and
		 * activates the athemes-starter-sites plugin on demand, so an agent can
		 * reach the plugin-owned list/import abilities (which only exist once the
		 * plugin is active). Registered only when writes are enabled.
		 *
		 * The permission_callback is the edit_theme_options floor (NOT
		 * install_plugins). The stricter install_plugins cap is verified inside the
		 * execute body, alongside a DISALLOW_FILE_MODS check, so that the spec's
		 * action-required response (manual-install link) is reachable. If the
		 * permission_callback were install_plugins, the REST/MCP boundary would 403
		 * under DISALLOW_FILE_MODS (WordPress core maps install_plugins to
		 * do_not_allow when file mods are disallowed), making the action-required
		 * branch dead code.
		 */
		public function register() {

			Sydney_Ability::register(
				'sydney/ensure-starter-sites-plugin',
				array(
					'write' => true,
					'label'               => __( 'Install starter sites (demo content)', 'sydney' ),
					'description'         => __( 'Set up the aThemes Starter Sites plugin so you can import a ready-made demo or starter website (pre-built pages, content, and settings). Installs and activates it if needed; once active, the plugin\'s own starter-site list/import abilities become available. If blocked (no install permission or DISALLOW_FILE_MODS), returns an action-required response with a manual-install link.', 'sydney' ),
					'output_schema'       => Sydney_Ability::envelope_schema(
						array(
									'status'          => array( 'type' => 'string' ),
									'action_required' => array( 'type' => 'boolean' ),
									'install_url'     => array( 'type' => 'string' ),
						)
					),
					'execute_callback'    => array( $this, 'execute_ensure_starter_sites_plugin' ),
					// Floor stays edit_theme_options (NOT install_plugins) so the
					// action-required branch is reachable under DISALLOW_FILE_MODS —
					// see check_install_bootstrap_permission() below.
					'permission_callback' => array( $this, 'check_install_bootstrap_permission' ),
					'meta'                => array(
						'annotations' => Sydney_Ability::WRITE_ANNOTATIONS,
					),
				)
			);
		}

		/**
		 * Permission floor for the starter-sites install ability.
		 *
		 * Matches the edit_theme_options floor used by every theme ability. The
		 * actual install_plugins requirement (and DISALLOW_FILE_MODS) is checked
		 * inside execute_ensure_starter_sites_plugin() so the action-required
		 * response can be returned rather than 403'd at the boundary.
		 *
		 * @return bool
		 */
		public function check_install_bootstrap_permission() {
			return current_user_can( 'edit_theme_options' );
		}

		/**
		 * Plugin slug for the aThemes Starter Sites plugin.
		 */
		const STARTER_SITES_SLUG = 'athemes-starter-sites';

		/**
		 * Main plugin file path (folder/file) for the aThemes Starter Sites plugin.
		 */
		const STARTER_SITES_PATH = 'athemes-starter-sites/athemes-starter-sites.php';

		/**
		 * Execute: install and activate the aThemes Starter Sites plugin on demand.
		 *
		 * Reuses Sydney_Dashboard's capability-checked install pipeline
		 * (get_plugin_status / install_plugin / activate_plugin). Returns the
		 * resulting plugin status on success. When installation is blocked (missing
		 * install_plugins cap or DISALLOW_FILE_MODS), returns a structured
		 * action-required envelope carrying a wp-admin plugin-install link so the
		 * agent can hand the user a manual path.
		 *
		 * @param array $args Ability args (unused).
		 * @return array Response envelope.
		 */
		public function execute_ensure_starter_sites_plugin( $args ) {
			if ( ! class_exists( 'Sydney_Abilities_Plugin_Installer' ) ) {
				require_once get_template_directory() . '/inc/abilities/class-sydney-abilities-plugin-installer.php';
			}

			return Sydney_Abilities_Plugin_Installer::install_and_activate(
				self::STARTER_SITES_SLUG,
				self::STARTER_SITES_PATH,
				__( 'aThemes Starter Sites', 'sydney' )
			);
		}
	}

endif;
