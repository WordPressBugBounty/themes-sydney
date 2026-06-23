<?php
/**
 * Starter content for the theme directory / Customizer preview.
 *
 * Registers WordPress starter content so a fresh install (or the wp.org
 * Customizer preview) shows a designed homepage out of the box. WordPress
 * core only injects this on a fresh site within the Customizer, so it never
 * touches an established site's database unless the user saves.
 *
 * @package Sydney
 */

class Sydney_Starter_Content {

	/**
	 * Register the starter content theme support.
	 *
	 * Hooked on after_setup_theme at the default priority so it runs before
	 * core's priority-100 import_theme_starter_content().
	 */
	public function register() {

		add_theme_support( 'starter-content', $this->get_content() );
	}

	/**
	 * Build the starter content array.
	 *
	 * @return array
	 */
	private function get_content() {

		return array(
			'posts'      => array(
				'home' => array(
					'post_type'    => 'page',
					'post_title'   => __( 'Home', 'sydney' ),
					'post_content' => $this->get_home_blocks(),
				),
			),
			'options'    => array(
				'show_on_front'  => 'page',
				'page_on_front'  => '{{home}}',
			),
			'nav_menus'  => array(
				'primary' => array(
					'name'  => __( 'Primary Menu', 'sydney' ),
					'items' => array(
						'page_home',
					),
				),
			),
			'theme_mods' => array(
				'global_color_1' => '#1b72e8',
				'global_color_2' => '#0b3a78',
			),
		);
	}

	/**
	 * Placeholder Gutenberg block markup for the home page.
	 *
	 * @return string
	 */
	private function get_home_blocks() {

		$blocks  = '<!-- wp:heading {"level":1} --><h1>' . esc_html__( 'Welcome to Sydney', 'sydney' ) . '</h1><!-- /wp:heading -->';
		$blocks .= '<!-- wp:paragraph --><p>' . esc_html__( 'A flexible WordPress theme for building beautiful websites. Replace this placeholder content with your own.', 'sydney' ) . '</p><!-- /wp:paragraph -->';
		$blocks .= '<!-- wp:columns --><div class="wp-block-columns">';
		$blocks .= '<!-- wp:column --><div class="wp-block-column">';
		$blocks .= '<!-- wp:heading {"level":3} --><h3>' . esc_html__( 'Design', 'sydney' ) . '</h3><!-- /wp:heading -->';
		$blocks .= '<!-- wp:paragraph --><p>' . esc_html__( 'Customize colors, typography and layout to match your brand.', 'sydney' ) . '</p><!-- /wp:paragraph -->';
		$blocks .= '</div><!-- /wp:column -->';
		$blocks .= '<!-- wp:column --><div class="wp-block-column">';
		$blocks .= '<!-- wp:heading {"level":3} --><h3>' . esc_html__( 'Build', 'sydney' ) . '</h3><!-- /wp:heading -->';
		$blocks .= '<!-- wp:paragraph --><p>' . esc_html__( 'Use the block editor or your favorite page builder to create pages.', 'sydney' ) . '</p><!-- /wp:paragraph -->';
		$blocks .= '</div><!-- /wp:column -->';
		$blocks .= '</div><!-- /wp:columns -->';
		$blocks .= '<!-- wp:buttons --><div class="wp-block-buttons">';
		$blocks .= '<!-- wp:button {"url":"#"} --><div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">' . esc_html__( 'Get Started', 'sydney' ) . '</a></div><!-- /wp:button -->';
		$blocks .= '</div><!-- /wp:buttons -->';

		return $blocks;
	}
}

/**
 * Instantiate Sydney_Starter_Content and hook register().
 */
function sydney_starter_content_init() {
	$starter_content = new Sydney_Starter_Content();
	$starter_content->register();
}
add_action( 'after_setup_theme', 'sydney_starter_content_init' );
