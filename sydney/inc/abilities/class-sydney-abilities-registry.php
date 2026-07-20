<?php
/**
 * Builds Sydney's abilities from declarative definition maps and registers the
 * single "sydney" category.
 *
 * @package Sydney
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Sydney_Abilities_Registry' ) ) :

	/**
	 * Sydney_Abilities_Registry class.
	 */
	class Sydney_Abilities_Registry {

		/**
		 * Category slug.
		 */
		const CATEGORY = 'sydney';

		/**
		 * Whether register_categories() already ran this request.
		 *
		 * @var bool
		 */
		protected static $did_register_categories = false;

		/**
		 * Whether register_abilities() already ran this request.
		 *
		 * @var bool
		 */
		protected static $did_register_abilities = false;

		/**
		 * Register the single Sydney ability category.
		 *
		 * Hooked to both abilities_api_categories_init and
		 * wp_abilities_api_categories_init — with a pre-6.9 polyfill active on
		 * core 6.9 both fire, so the second run is a no-op.
		 */
		public static function register_categories() {
			if ( self::$did_register_categories ) {
				return;
			}
			self::$did_register_categories = true;

			wp_register_ability_category(
				self::CATEGORY,
				array(
					'label'       => __( 'Sydney Theme', 'sydney' ),
					'description' => __( 'Customize the active Sydney theme: the global color palette, typography (fonts, sizes, styling), button styling (colors, padding, font size, corner radius), the drag-and-drop header/footer builder (layout and per-component content), Sydney block patterns, and assembling full pages from those patterns.', 'sydney' ),
				)
			);
		}

		/**
		 * Load the per-domain ability group classes the dispatcher instantiates,
		 * plus the Sydney_Ability / Sydney_Abilities_Response core classes every
		 * group depends on.
		 *
		 * Idempotent (require_once). This is the single loader for the abilities
		 * system: bootstrap.php requires only the gate class and this registry, so
		 * group files are not paid for until the Abilities API actually
		 * initializes. Also keeps register_abilities() self-sufficient for callers
		 * that load only the registry (e.g. registration tests).
		 */
		protected static function load_groups() {
			// The colors/fonts/text sanitizers live in inc/customizer/sanitize.php,
			// which is only required from within sydney_customize_register() (hooked
			// to customize_register). Abilities execute on REST/admin-ajax/MCP
			// requests where that hook never fires, so load the sanitizers here —
			// not in bootstrap, which runs on every front-end request. Guarded
			// against the double-define on an actual Customizer request.
			if ( ! function_exists( 'sydney_sanitize_hex_rgba' ) || ! function_exists( 'sydney_google_fonts_sanitize' ) || ! function_exists( 'sydney_sanitize_text' ) ) {
				require_once get_template_directory() . '/inc/customizer/sanitize.php';
			}

			require_once get_template_directory() . '/inc/abilities/class-sydney-abilities-response.php';
			require_once get_template_directory() . '/inc/abilities/class-sydney-ability.php';
			require_once get_template_directory() . '/inc/abilities/groups/class-sydney-abilities-colors.php';
			require_once get_template_directory() . '/inc/abilities/groups/class-sydney-abilities-typography.php';
			require_once get_template_directory() . '/inc/abilities/groups/class-sydney-abilities-buttons.php';
			require_once get_template_directory() . '/inc/abilities/groups/class-sydney-abilities-hf.php';
			require_once get_template_directory() . '/inc/abilities/patterns/class-sydney-abilities-patterns.php';
			require_once get_template_directory() . '/inc/abilities/groups/class-sydney-abilities-starter-sites.php';
			require_once get_template_directory() . '/inc/abilities/groups/class-sydney-abilities-onboarding.php';
			require_once get_template_directory() . '/inc/abilities/groups/class-sydney-abilities-plugin-recommendations.php';
			require_once get_template_directory() . '/inc/abilities/groups/class-sydney-abilities-social.php';
			require_once get_template_directory() . '/inc/abilities/groups/class-sydney-abilities-sidebars.php';
			require_once get_template_directory() . '/inc/abilities/groups/class-sydney-abilities-blog.php';
			require_once get_template_directory() . '/inc/abilities/groups/class-sydney-abilities-hero.php';
			require_once get_template_directory() . '/inc/abilities/groups/class-sydney-abilities-scrolltop.php';
			require_once get_template_directory() . '/inc/abilities/groups/class-sydney-abilities-preloader.php';
			require_once get_template_directory() . '/inc/abilities/groups/class-sydney-abilities-custom-css.php';
			require_once get_template_directory() . '/inc/abilities/groups/class-sydney-abilities-shop.php';
			require_once get_template_directory() . '/inc/abilities/groups/class-sydney-abilities-page-structure.php';
		}

		/**
		 * Register all Sydney abilities.
		 *
		 * Hooked to both abilities_api_init and wp_abilities_api_init — with a
		 * pre-6.9 polyfill active on core 6.9 both fire, so the second run is a
		 * no-op instead of a duplicate build into _doing_it_wrong notices.
		 * Registers nothing when the master toggle is off. Write abilities are
		 * skipped when the allow-writes toggle is off.
		 */
		public static function register_abilities() {

			if ( self::$did_register_abilities ) {
				return;
			}

			if ( ! Sydney_Abilities::is_enabled() ) {
				return;
			}

			self::$did_register_abilities = true;

			self::load_groups();

			/**
			 * Filters the ability group classes the registry instantiates.
			 *
			 * Lets Sydney Pro / child themes add their own groups without
			 * re-implementing category registration, gating, or bootstrap
			 * ordering. Each class must be loaded by the extender and expose a
			 * public register() method; unknown classes are skipped.
			 *
			 * @param string[] $groups Group class names.
			 */
			$groups = apply_filters(
				'sydney_abilities_groups',
				array(
					'Sydney_Abilities_Colors',
					'Sydney_Abilities_Typography',
					'Sydney_Abilities_Buttons',
					'Sydney_Abilities_HF',
					'Sydney_Abilities_Patterns',
					'Sydney_Abilities_Starter_Sites',
					'Sydney_Abilities_Onboarding',
					'Sydney_Abilities_Plugin_Recommendations',
					'Sydney_Abilities_Social',
					'Sydney_Abilities_Sidebars',
					'Sydney_Abilities_Blog',
					'Sydney_Abilities_Hero',
					'Sydney_Abilities_Scrolltop',
					'Sydney_Abilities_Preloader',
					'Sydney_Abilities_Custom_Css',
					'Sydney_Abilities_Shop',
					'Sydney_Abilities_Page_Structure',
				)
			);

			foreach ( $groups as $group ) {
				if ( is_string( $group ) && class_exists( $group ) && method_exists( $group, 'register' ) ) {
					( new $group() )->register();
				}
			}
		}
	}

endif;
