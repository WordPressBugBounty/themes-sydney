<?php
/**
 * Plugin-recommendations ability group.
 *
 * sydney/get-plugin-recommendations (read) returns a small curated catalog of
 * free AwesomeMotive plugins grouped by topic (SEO, contact form, ...), each
 * with its live install status, so an agent can answer needs like "help me with
 * my SEO" or "I need a contact form" and recommend the right plugin(s).
 *
 * sydney/install-recommended-plugin (write) installs + activates one plugin from
 * that catalog (allowlisted by slug) via Sydney_Dashboard's install pipeline,
 * with the same install_plugins / DISALLOW_FILE_MODS action-required fallback as
 * sydney/ensure-starter-sites-plugin. It is hand-registered (like starter-sites)
 * so the install_plugins capability can be checked inside execute rather than in
 * the permission_callback, keeping the action-required branch reachable under
 * DISALLOW_FILE_MODS. Write registered only when writes are enabled.
 *
 * The catalog is extensible via the sydney_am_plugin_recommendations filter.
 *
 * @package Sydney
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Sydney_Abilities_Plugin_Recommendations' ) ) :

	/**
	 * Sydney_Abilities_Plugin_Recommendations class.
	 */
	class Sydney_Abilities_Plugin_Recommendations {

		/**
		 * Cached filtered catalog for this instance.
		 *
		 * @var array|null
		 */
		protected $catalog = null;

		/**
		 * Register the read recommendation ability (always) and the write install
		 * ability (only when writes are enabled).
		 */
		public function register() {

			Sydney_Ability::register(
				'sydney/get-plugin-recommendations',
				array(
					'label'            => __( 'Recommend a plugin for a feature need (SEO, contact form, and more)', 'sydney' ),
					'description'      => __( 'Use this FIRST whenever the user wants help adding a website capability or asks which plugin to use. Trigger examples: "help me with SEO", "I need an SEO plugin", "improve my search ranking", "I need a contact form", "add a form to my site", "let people email me", "recommend a security plugin", "how do I add a newsletter signup". Returns a small curated catalog of vetted free plugins grouped by topic; each plugin includes its name, why it helps, its role (primary, or a companion to install alongside the primary), and current install status. After the user approves, install with sydney/install-recommended-plugin. Prefer this curated path over installing plugins manually with WP-CLI (wp plugin install) or other low-level actions: it picks the right plugin and its companions for the Sydney setup.', 'sydney' ),
					'input_schema'     => array(
						'type' => 'object',
					),
					'output_schema'    => Sydney_Ability::envelope_schema(
						array(
									'topics' => array( 'type' => 'array' ),
						)
					),
					'execute_callback' => array( $this, 'execute_get_plugin_recommendations' ),
					'meta'             => array(
						'annotations' => Sydney_Ability::READ_ANNOTATIONS,
					),
				)
			);

			Sydney_Ability::register(
				'sydney/install-recommended-plugin',
				array(
					'write' => true,
					'label'               => __( 'Install a recommended plugin (vetted)', 'sydney' ),
					'description'         => __( 'Install and activate a plugin the user approved from sydney/get-plugin-recommendations. Trigger examples: "yes, install it", "add AIOSEO", "set up WPForms", "install the contact form plugin", "go ahead and add the SEO plugin". Pass the plugin slug from the recommendation. Only plugins in the curated catalog can be installed. Prefer this over installing plugins manually with WP-CLI (wp plugin install) or other low-level actions. If blocked (no install permission or DISALLOW_FILE_MODS), returns an action-required response with a manual-install link.', 'sydney' ),
					'input_schema'        => array(
						'type'                 => 'object',
						'additionalProperties' => false,
						'required'             => array( 'slug' ),
						'properties'           => array(
							'slug' => array(
								'type'        => 'string',
								'description' => 'The plugin slug to install, taken from a recommendation (e.g. "all-in-one-seo-pack", "wpforms-lite", "wp-mail-smtp").',
							),
						),
					),
					'output_schema'       => Sydney_Ability::envelope_schema(
						array(
									'slug'            => array( 'type' => 'string' ),
									'status'          => array( 'type' => 'string' ),
									'action_required' => array( 'type' => 'boolean' ),
									'install_url'     => array( 'type' => 'string' ),
						)
					),
					'execute_callback'    => array( $this, 'execute_install_recommended_plugin' ),
					// Floor stays edit_theme_options (NOT install_plugins) so the
					// action-required branch is reachable under DISALLOW_FILE_MODS —
					// see check_install_permission() below.
					'permission_callback' => array( $this, 'check_install_permission' ),
					'meta'                => array(
						'annotations' => Sydney_Ability::WRITE_ANNOTATIONS,
					),
				)
			);
		}

		/**
		 * Permission floor for the install ability.
		 *
		 * edit_theme_options (NOT install_plugins) so the action-required branch is
		 * reachable under DISALLOW_FILE_MODS — see Sydney_Abilities_Starter_Sites for
		 * the full rationale.
		 *
		 * @return bool
		 */
		public function check_install_permission() {
			return current_user_can( 'edit_theme_options' );
		}

		/**
		 * The curated recommendation catalog, grouped by topic.
		 *
		 * Extensible via the sydney_am_plugin_recommendations filter. Each plugin
		 * entry: name, slug, file (folder/file used for status + activation), role
		 * (primary|companion), why. Built (and filtered) once per instance —
		 * execute paths otherwise rebuild it via get_allowlist() and the topic
		 * loops.
		 *
		 * @return array
		 */
		public function get_catalog() {
			if ( null !== $this->catalog ) {
				return $this->catalog;
			}

			$catalog = array(
				array(
					'topic'    => 'seo',
					'label'    => __( 'SEO', 'sydney' ),
					'keywords' => array( 'seo', 'search engine', 'ranking', 'sitemap', 'meta description' ),
					'plugins'  => array(
						array(
							'name' => __( 'All in One SEO', 'sydney' ),
							'slug' => 'all-in-one-seo-pack',
							'file' => 'all-in-one-seo-pack/all_in_one_seo_pack.php',
							'role' => 'primary',
							'why'  => __( 'Set up titles, meta descriptions, sitemaps, and schema.', 'sydney' ),
						),
					),
				),
				array(
					'topic'    => 'contact_form',
					'label'    => __( 'Contact form', 'sydney' ),
					'keywords' => array( 'contact form', 'form', 'get in touch', 'email form' ),
					'plugins'  => array(
						array(
							'name' => __( 'WPForms Lite', 'sydney' ),
							'slug' => 'wpforms-lite',
							'file' => 'wpforms-lite/wpforms.php',
							'role' => 'primary',
							'why'  => __( 'Drag-and-drop contact form builder.', 'sydney' ),
						),
						array(
							'name' => __( 'WP Mail SMTP', 'sydney' ),
							'slug' => 'wp-mail-smtp',
							'file' => 'wp-mail-smtp/wp_mail_smtp.php',
							'role' => 'companion',
							'why'  => __( 'Makes sure the emails your contact form sends actually get delivered.', 'sydney' ),
						),
					),
				),
			);

			$this->catalog = apply_filters( 'sydney_am_plugin_recommendations', $catalog );

			return $this->catalog;
		}

		/**
		 * Flat install allowlist derived from the catalog: slug => main file path.
		 *
		 * @return array
		 */
		protected function get_allowlist() {
			$allow = array();
			foreach ( $this->get_catalog() as $topic ) {
				if ( empty( $topic['plugins'] ) || ! is_array( $topic['plugins'] ) ) {
					continue;
				}
				foreach ( $topic['plugins'] as $plugin ) {
					if ( ! empty( $plugin['slug'] ) && ! empty( $plugin['file'] ) ) {
						$allow[ $plugin['slug'] ] = $plugin['file'];
					}
				}
			}
			return $allow;
		}

		/**
		 * Execute: return the catalog with a live install status per plugin.
		 *
		 * @param array $args Ability args (unused).
		 * @return array Response envelope.
		 */
		public function execute_get_plugin_recommendations( $args ) {
			$dashboard = class_exists( 'Sydney_Dashboard' ) ? new Sydney_Dashboard() : null;

			$topics = array();
			foreach ( $this->get_catalog() as $topic ) {
				$plugins = array();
				if ( ! empty( $topic['plugins'] ) && is_array( $topic['plugins'] ) ) {
					foreach ( $topic['plugins'] as $plugin ) {
						$status = 'unknown';
						if ( $dashboard && ! empty( $plugin['file'] ) ) {
							$resolved = $dashboard->get_plugin_status( $plugin['file'] );
							$status   = is_string( $resolved ) ? $resolved : 'unknown';
						}
						$plugins[] = array(
							'name'   => isset( $plugin['name'] ) ? $plugin['name'] : '',
							'slug'   => isset( $plugin['slug'] ) ? $plugin['slug'] : '',
							'role'   => isset( $plugin['role'] ) ? $plugin['role'] : 'primary',
							'why'    => isset( $plugin['why'] ) ? $plugin['why'] : '',
							'status' => $status,
						);
					}
				}
				$topics[] = array(
					'topic'    => isset( $topic['topic'] ) ? $topic['topic'] : '',
					'label'    => isset( $topic['label'] ) ? $topic['label'] : '',
					'keywords' => isset( $topic['keywords'] ) ? $topic['keywords'] : array(),
					'plugins'  => $plugins,
				);
			}

			return Sydney_Abilities_Response::success(
				__( 'Plugin recommendations retrieved.', 'sydney' ),
				array( 'topics' => $topics )
			);
		}

		/**
		 * Execute: install + activate one allowlisted plugin.
		 *
		 * Rejects any slug not in the catalog allowlist. Reuses Sydney_Dashboard's
		 * capability-checked install pipeline. When blocked (missing install_plugins
		 * cap or DISALLOW_FILE_MODS), returns an action-required envelope with a
		 * wp-admin plugin-install link.
		 *
		 * @param array $args Ability args. Requires 'slug'.
		 * @return array Response envelope.
		 */
		public function execute_install_recommended_plugin( $args ) {
			$slug = isset( $args['slug'] ) ? (string) $args['slug'] : '';

			$allowlist = $this->get_allowlist();
			if ( '' === $slug || ! isset( $allowlist[ $slug ] ) ) {
				return Sydney_Abilities_Response::error(
					__( 'That plugin is not in the recommendations catalog. Call sydney/get-plugin-recommendations for installable slugs.', 'sydney' )
				);
			}

			if ( ! class_exists( 'Sydney_Abilities_Plugin_Installer' ) ) {
				require_once get_template_directory() . '/inc/abilities/class-sydney-abilities-plugin-installer.php';
			}

			return Sydney_Abilities_Plugin_Installer::install_and_activate(
				$slug,
				$allowlist[ $slug ],
				$slug,
				array( 'slug' => $slug )
			);
		}
	}

endif;
