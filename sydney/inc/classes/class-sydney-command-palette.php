<?php
/**
 * Command palette shortcuts.
 *
 * Adds "Go to: Sydney > ..." navigation commands to WordPress's command
 * palette (Cmd/Ctrl+K): the Customizer panels and sections the site has, and
 * the dashboard Settings tab. Core already lists the Sydney admin menu items there.
 *
 * @package Sydney
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Registers Sydney's command palette shortcuts.
 */
class Sydney_Command_Palette {

	/**
	 * Constructor.
	 */
	public function __construct() {
		// After core's wp_enqueue_command_palette_assets() at the default priority.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ), 20 );
	}

	/**
	 * Load the script that registers the commands.
	 *
	 * Only on screens where core already loaded the palette: every admin
	 * screen from WordPress 6.9, the editors before that. Loading wp-commands
	 * here would add its React bundle to screens with no palette to open.
	 *
	 * @return void
	 */
	public function enqueue_scripts() {
		if ( ! wp_script_is( 'wp-commands', 'enqueued' ) ) {
			return;
		}

		$commands = $this->get_commands();

		if ( empty( $commands ) ) {
			return;
		}

		wp_enqueue_script( 'sydney-command-palette', get_template_directory_uri() . '/js/command-palette.js', array( 'wp-commands', 'wp-data' ), '20261019', true );
		wp_localize_script( 'sydney-command-palette', 'sydneyCommandPalette', array( 'commands' => $commands ) );
	}

	/**
	 * The commands the current user gets.
	 *
	 * None under the aThemes white label, which removes the Sydney menu and
	 * brand, and none in the network or user admin, where these links would
	 * point at a single site.
	 *
	 * @return array List of commands, each with name, label, url and keywords.
	 */
	public function get_commands() {
		if ( ! current_user_can( 'edit_theme_options' ) || sydney_is_white_labelled() || is_network_admin() || is_user_admin() ) {
			return array();
		}

		$commands = array();

		// The builder's Header and Footer panels list its hidden sections, so
		// the Customizer opens the builder in their place, and so do these commands.
		$hf_builder = $this->is_hf_builder_active();

		// The Header panel is registered only once the modern header is on.
		if ( get_option( 'sydney-update-header' ) ) {
			$commands[] = $this->customize_command(
				'header',
				__( 'Go to: Sydney > Customize > Header', 'sydney' ),
				$hf_builder ? 'sydney_section_hb_wrapper' : 'sydney_panel_header',
				array(
					_x( 'menu', 'command palette search keyword', 'sydney' ),
					_x( 'navigation', 'command palette search keyword', 'sydney' ),
					_x( 'mobile header', 'command palette search keyword', 'sydney' ),
					_x( 'header builder', 'command palette search keyword', 'sydney' ),
				),
				$hf_builder ? 'section' : 'panel'
			);

			if ( $hf_builder ) {
				$commands[] = $this->customize_command(
					'header-menu',
					__( 'Go to: Sydney > Customize > Header > Primary Menu', 'sydney' ),
					'sydney_section_hb_component__menu',
					array(
						_x( 'menu', 'command palette search keyword', 'sydney' ),
						_x( 'navigation', 'command palette search keyword', 'sydney' ),
					),
					'section'
				);

				$commands[] = $this->customize_command(
					'header-mobile-offcanvas',
					__( 'Go to: Sydney > Customize > Header > Mobile Offcanvas', 'sydney' ),
					'sydney_section_hb_mobile_offcanvas',
					array(
						_x( 'mobile menu', 'command palette search keyword', 'sydney' ),
						_x( 'hamburger', 'command palette search keyword', 'sydney' ),
					),
					'section'
				);
			}
		}

		// The logo control sits in Site Identity, or in the builder's Logo section.
		$commands[] = $this->customize_command(
			'header-logo',
			__( 'Go to: Sydney > Customize > Header > Logo', 'sydney' ),
			'site_logo',
			array(
				_x( 'site identity', 'command palette search keyword', 'sydney' ),
				_x( 'site title', 'command palette search keyword', 'sydney' ),
				_x( 'tagline', 'command palette search keyword', 'sydney' ),
			),
			'control'
		);

		$commands[] = $this->customize_command(
			'footer',
			__( 'Go to: Sydney > Customize > Footer', 'sydney' ),
			$hf_builder ? 'sydney_section_fb_wrapper' : 'sydney_panel_footer',
			array(
				_x( 'footer widgets', 'command palette search keyword', 'sydney' ),
				_x( 'footer builder', 'command palette search keyword', 'sydney' ),
			),
			$hf_builder ? 'section' : 'panel'
		);

		$commands[] = $this->customize_command(
			'footer-copyright',
			__( 'Go to: Sydney > Customize > Footer > Copyright', 'sydney' ),
			$hf_builder ? 'sydney_section_fb_component__copyright' : 'sydney_section_footer_credits',
			array(
				_x( 'credits', 'command palette search keyword', 'sydney' ),
				_x( 'footer text', 'command palette search keyword', 'sydney' ),
			),
			'section'
		);

		// The Global Styles panel's sections, each opened directly.
		$commands[] = $this->customize_command(
			'colors',
			__( 'Go to: Sydney > Customize > Colors', 'sydney' ),
			'colors',
			array(
				_x( 'palette', 'command palette search keyword', 'sydney' ),
				_x( 'global styles', 'command palette search keyword', 'sydney' ),
			),
			'section'
		);

		$commands[] = $this->customize_command(
			'typography-headings',
			__( 'Go to: Sydney > Customize > Typography > Headings', 'sydney' ),
			'sydney_section_typography_headings',
			array(
				_x( 'fonts', 'command palette search keyword', 'sydney' ),
				_x( 'titles', 'command palette search keyword', 'sydney' ),
				_x( 'global styles', 'command palette search keyword', 'sydney' ),
			),
			'section'
		);

		$commands[] = $this->customize_command(
			'typography-body',
			__( 'Go to: Sydney > Customize > Typography > Body', 'sydney' ),
			'sydney_section_typography_body',
			array(
				_x( 'fonts', 'command palette search keyword', 'sydney' ),
				_x( 'text', 'command palette search keyword', 'sydney' ),
				_x( 'global styles', 'command palette search keyword', 'sydney' ),
			),
			'section'
		);

		$commands[] = $this->customize_command(
			'buttons',
			__( 'Go to: Sydney > Customize > Buttons', 'sydney' ),
			'sydney_section_buttons',
			array(
				_x( 'global styles', 'command palette search keyword', 'sydney' ),
			),
			'section'
		);

		$commands[] = $this->customize_command(
			'blog',
			__( 'Go to: Sydney > Customize > Blog', 'sydney' ),
			'sydney_panel_blog',
			array(
				_x( 'archive', 'command palette search keyword', 'sydney' ),
				_x( 'single post', 'command palette search keyword', 'sydney' ),
				_x( 'posts', 'command palette search keyword', 'sydney' ),
			)
		);

		$commands[] = $this->customize_command(
			'general',
			__( 'Go to: Sydney > Customize > General', 'sydney' ),
			'sydney_panel_general',
			array(
				_x( 'layout', 'command palette search keyword', 'sydney' ),
				_x( 'images', 'command palette search keyword', 'sydney' ),
				_x( 'performance', 'command palette search keyword', 'sydney' ),
				_x( 'scroll to top', 'command palette search keyword', 'sydney' ),
			)
		);

		// Sydney's WooCommerce options load only with WooCommerce, into its own panel.
		if ( $this->is_woocommerce_active() ) {
			$commands[] = $this->customize_command(
				'woocommerce',
				__( 'Go to: Sydney > Customize > WooCommerce', 'sydney' ),
				'woocommerce',
				array(
					_x( 'shop', 'command palette search keyword', 'sydney' ),
					_x( 'product', 'command palette search keyword', 'sydney' ),
					_x( 'cart', 'command palette search keyword', 'sydney' ),
					_x( 'checkout', 'command palette search keyword', 'sydney' ),
				)
			);
		}

		// The Sydney dashboard requires manage_options.
		if ( current_user_can( 'manage_options' ) ) {
			$commands[] = array(
				'name'     => 'sydney/settings',
				'label'    => __( 'Go to: Sydney > Settings', 'sydney' ),
				'url'      => admin_url( 'admin.php?page=sydney-dashboard&tab=settings' ),
				'keywords' => array(
					_x( 'license', 'command palette search keyword', 'sydney' ),
					_x( 'abilities', 'command palette search keyword', 'sydney' ),
				),
			);
		}

		return $commands;
	}

	/**
	 * A command that opens the Customizer on one panel or section.
	 *
	 * @param string $slug     Command name suffix.
	 * @param string $label    Command label.
	 * @param string $target   Customizer panel, section or control id.
	 * @param array  $keywords Search keywords.
	 * @param string $type     'panel', 'section' or 'control'.
	 * @return array
	 */
	protected function customize_command( $slug, $label, $target, $keywords, $type = 'panel' ) {
		return array(
			'name'     => 'sydney/customize-' . $slug,
			'label'    => $label,
			'url'      => admin_url( 'customize.php?autofocus[' . $type . ']=' . $target ),
			'keywords' => $keywords,
		);
	}

	/**
	 * Whether WooCommerce is active.
	 *
	 * @return bool
	 */
	protected function is_woocommerce_active() {
		return class_exists( 'WooCommerce' );
	}

	/**
	 * Whether the header/footer builder module is active.
	 *
	 * @return bool
	 */
	protected function is_hf_builder_active() {
		return class_exists( 'Sydney_Modules' ) && Sydney_Modules::is_module_active( 'hf-builder' );
	}
}

new Sydney_Command_Palette();
