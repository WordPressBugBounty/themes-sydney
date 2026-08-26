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
					'template'     => 'page-templates/page_front-page.php',
				),
			),
			'options'    => array(
				'show_on_front'   => 'page',
				'page_on_front'   => '{{home}}',
				'blogdescription' => '',
				'custom_css[' . get_stylesheet() . ']' => $this->get_home_css(),
			),
			'nav_menus'  => array(
				'primary' => array(
					'name'  => __( 'Primary Menu', 'sydney' ),
					'items' => array(
						'page_home',
						array(
							'type'  => 'custom',
							'title' => __( 'About', 'sydney' ),
							'url'   => '#',
						),
						array(
							'type'  => 'custom',
							'title' => __( 'Services', 'sydney' ),
							'url'   => '#',
						),
					),
				),
			),
			'widgets'    => $this->get_footer_widgets(),
			'theme_mods' => array(
				// Colors: global palette + core brand colors.
				'global_color_1'                 => '#ffd00a',
				'global_color_2'                 => '#fbdc56',
				'global_color_3'                 => '#142e2c',
				'global_color_4'                 => '#00102e',
				'global_color_5'                 => '#6d7685',
				'global_color_6'                 => '#00102e',
				'global_color_7'                 => '#f4f5f7',
				'global_color_8'                 => '#dbdbdb',
				'primary_color'                  => '#ffd00a',
				'body_text_color'                => '#142e2c',
				// Buttons: dark text on the yellow background (matches the hero button).
				'button_color'                   => '#00102e',
				'button_color_hover'             => '#00102e',
				// Scroll-to-top: dark icon on the yellow background.
				'scrolltop_color'                => '#00102e',
				'scrolltop_color_hover'          => '#00102e',
				// Typography: fonts + sizes.
				'sydney_headings_font'           => wp_json_encode(
					array(
						'font'          => 'Manrope',
						'regularweight' => '700',
						'category'      => 'sans-serif',
					)
				),
				'sydney_body_font'               => wp_json_encode(
					array(
						'font'          => 'Inter',
						'regularweight' => 'regular',
						'category'      => 'sans-serif',
					)
				),
				'h1_font_size_desktop'           => 64,
				'h2_font_size_desktop'           => 48,
				'h3_font_size_desktop'           => 32,
				'h4_font_size_desktop'           => 24,
				'h5_font_size_desktop'           => 20,
				'h6_font_size_desktop'           => 18,
				'body_font_size_desktop'         => 16,
				'single_post_title_size_desktop' => 48,
				'site_title_font_size_desktop'   => 32,
				'site_desc_font_size_desktop'    => 16,
				// Header: layout without the WooCommerce icons (logo + menu + search).
				'sydney_header_row__main_header_row'                         => '{"desktop":[["logo"],["menu","search"]],"mobile":[["logo"],["search","mobile_hamburger"]]}',
				// Header: transparent on the homepage only (front-page display condition).
				'transparent_header'                                        => '[{"type":"include","condition":"front-page","id":null}]',
				// Header: transparent builder wrapper background (default is white).
				'sydney_section_hb_wrapper__header_builder_background_color' => 'rgba(255,255,255,0)',
				// Header: main row + sticky background (connected to global_color_6).
				'sydney_header_row__main_header_row_background_color'        => '#00102e',
				'global_sydney_header_row__main_header_row_background_color' => 'global_color_6',
				'sydney_header_row__main_header_row_sticky_background_color' => '#00102e',
				'sydney_header_row__main_header_row_sticky_border_bottom_color' => '#00102e',
				// Header content: white menu/title/icons on the dark header, yellow hover.
				'shfb_main_header_color'                                     => '#ffffff',
				'shfb_main_header_color_hover'                               => 'rgba(255,255,255,0.75)',
				'menu_items_hover'                                           => '#ffd00a',
				'site_title_color'                                           => '#ffffff',
				'site_desc_color'                                            => '#ffffff',
				'site_title_sticky_color'                                    => '#ffffff',
				'site_description_sticky_color'                              => '#ffffff',
				'shfb_search_icon_color'                                     => '#ffffff',
				'shfb_search_icon_color_hover'                               => 'rgba(255,255,255,0.75)',
				'shfb_search_icon_sticky_color'                              => '#ffffff',
				'shfb_mobile_hamburger_icon_color'                           => '#ffffff',
				// Footer main row: 4 widget columns (big-left), navy background.
				'sydney_footer_row__main_footer_row'                         => '{"desktop":[["widget1"],["widget2"],["widget3"],["widget4"]],"mobile":[[],[],[]]}',
				'sydney_footer_row__main_footer_row_columns_desktop'         => 4,
				'sydney_footer_row__main_footer_row_columns_layout_desktop'  => '4col-bigleft',
				'sydney_footer_row__main_footer_row_background_color'        => '#00102e',
				'global_sydney_footer_row__main_footer_row_background_color' => 'global_color_6',
				// Footer widgets: white brand + titles, grey links.
				'sydney_section_fb_component__widget1_text_color'            => '#ffffff',
				'sydney_section_fb_component__widget1_links_color'           => '#ffffff',
				'sydney_section_fb_component__widget2_title_color'           => '#ffffff',
				'sydney_section_fb_component__widget2_links_color'           => 'rgba(255,255,255,0.51)',
				'sydney_section_fb_component__widget2_links_color_hover'     => '#ffffff',
				'sydney_section_fb_component__widget3_title_color'           => '#ffffff',
				'sydney_section_fb_component__widget3_links_color'           => 'rgba(255,255,255,0.51)',
				'sydney_section_fb_component__widget3_links_color_hover'     => '#ffffff',
				'sydney_section_fb_component__widget4_title_color'           => '#ffffff',
				'sydney_section_fb_component__widget4_links_color'           => 'rgba(255,255,255,0.51)',
				'sydney_section_fb_component__widget4_links_color_hover'     => '#ffffff',
				// Footer bottom row: copyright + social, navy background, white content.
				'sydney_footer_row__below_footer_row'                        => '{"desktop":[["copyright"],["social"]],"mobile":[[],[],[]]}',
				'sydney_footer_row__below_footer_row_columns_desktop'        => 2,
				'sydney_footer_row__below_footer_row_column2_horizontal_alignment_desktop' => 'end',
				'sydney_footer_row__below_footer_row_background_color'        => '#00102e',
				'global_sydney_footer_row__below_footer_row_background_color' => 'global_color_6',
				'social_profiles_footer'                                     => 'https://facebook.com,https://twitter.com,https://instagram.com',
				'shfb_footer_social_color'                                   => '#ffffff',
				'sydney_section_fb_component__copyright_text_color'          => '#ffffff',
				'sydney_section_fb_component__copyright_links_color'         => '#ffffff',
				'sydney_section_fb_component__copyright_links_color_hover'   => 'rgba(255,255,255,0.75)',
			),
		);
	}

	/**
	 * Footer widgets: brand in column 1, link lists in columns 2-4.
	 *
	 * Block-based widgets so no nav menus need to be created. The h3 titles and
	 * <a> links pick up the footer widget colors set in theme_mods.
	 *
	 * @return array
	 */
	private function get_footer_widgets() {

		return array(
			'footer-1' => array(
				array( 'block', array( 'content' => '<!-- wp:site-title {"level":0,"style":{"typography":{"fontSize":"32px","fontStyle":"normal","fontWeight":"700"}}} /-->' ) ),
			),
			'footer-2' => array(
				array( 'block', array( 'content' => $this->footer_links_block( __( 'About', 'sydney' ), array( 'Services', 'Portfolio', 'About', 'Careers' ) ) ) ),
			),
			'footer-3' => array(
				array( 'block', array( 'content' => $this->footer_links_block( __( 'Locations', 'sydney' ), array( 'Amsterdam', 'London', 'Paris', 'New York' ) ) ) ),
			),
			'footer-4' => array(
				array( 'block', array( 'content' => $this->footer_links_block( __( 'Policy', 'sydney' ), array( 'Privacy', 'Cookie policy', 'Terms & conditions', 'About us' ) ) ) ),
			),
		);
	}

	/**
	 * Build one footer column: an uppercase h3 title + a list of placeholder links.
	 *
	 * @param string $title Column heading.
	 * @param array  $links Link labels.
	 * @return string Block markup.
	 */
	private function footer_links_block( $title, $links ) {

		$items = '';
		foreach ( $links as $link ) {
			$items .= '<!-- wp:list-item --><li><a href="#">' . esc_html( $link ) . '</a></li><!-- /wp:list-item -->';
		}

		return '<!-- wp:heading {"level":3,"style":{"typography":{"textTransform":"uppercase","letterSpacing":"1px","fontSize":"16px"}}} -->'
			. '<h3 class="wp-block-heading" style="font-size:16px;letter-spacing:1px;text-transform:uppercase">' . esc_html( $title ) . '</h3>'
			. '<!-- /wp:heading -->'
			. '<!-- wp:list {"style":{"spacing":{"margin":{"top":"16px"}}}} -->'
			. '<ul class="wp-block-list" style="margin-top:16px">' . $items . '</ul>'
			. '<!-- /wp:list -->';
	}

	/**
	 * Additional CSS for the home layout (helper classes the blocks rely on).
	 *
	 * Imported through the `custom_css` setting so it previews in the Customizer
	 * and lands in Additional CSS on publish.
	 *
	 * @return string
	 */
	private function get_home_css() {

		return <<<'SYDNEY_STARTER_CSS'
:root {
	--wp--preset--font-size--small: 12px;
}
.home .shfb-main_header_row {
	background-color: transparent;
}
.sticky-header-active .has-sticky-header .shfb-main_header_row {
	background-color: var(--sydney-global-color-6);
}
.shfb .header-search-form {
	background-color: var(--sydney-global-color-6);
}
.zindex10 {
	overflow: visible;
}
button,
.wp-block-button__link {
	letter-spacing: 2px;
}
.is-style-outline a {
	background-color: transparent;
}
.wp-block-button.is-style-outline a:hover {
	background-color: #fff;
	color: #00102E !important;
}
@media (min-width: 1199px) {
	.stretch-right .wp-block-image {
		margin-right: calc((100vw - 1140px) / -2) !important;
		width: calc(100% + calc((100vw - 1140px) / 2));
	}
	.stretch-left .wp-block-image {
		margin-left: calc((100vw - 1140px) / -2);
		width: calc(100% + calc((100vw - 1140px) / 2));
	}
}
@media (max-width: 991px) {
	.main-page-title {
		font-size: 42px !important;
	}
}
@media (max-width: 780px) {
	.center-mobile {
		text-align: center;
		justify-content: center !important;
	}
}
.shfb-footer .widget ul {
	list-style: none;
	margin: 0;
	padding-left: 0;
}
.shfb-footer .widget li {
	margin-bottom: 10px;
}
SYDNEY_STARTER_CSS;
	}

	/**
	 * Placeholder Gutenberg block markup for the home page.
	 *
	 * @return string
	 */
	private function get_home_blocks() {

		$blocks = <<<'SYDNEY_STARTER_HOME'
<!-- wp:cover {"url":"%%ASSETS%%/hero.jpg","dimRatio":90,"overlayColor":"global_color_6","isUserOverlayColor":true,"align":"full","className":"zindex10","style":{"background":{"position":"50% 50%"},"spacing":{"padding":{"top":"24vh","right":"var:preset|spacing|30","left":"var:preset|spacing|30"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover alignfull zindex10" style="margin-top:0;margin-bottom:0;padding-top:24vh;padding-right:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30)"><img class="wp-block-cover__image-background" alt="" src="%%ASSETS%%/hero.jpg" data-object-fit="cover"/><span aria-hidden="true" class="wp-block-cover__background has-global-color-6-background-color has-background-dim-90 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide"><!-- wp:column {"width":"20%"} -->
<div class="wp-block-column" style="flex-basis:20%"></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"textAlign":"center","level":1,"className":"is-style-sydney-no-margin main-page-title","style":{"color":{"text":"#FFFFFF"},"spacing":{"margin":{"bottom":"20px"}}}} -->
<h1 class="wp-block-heading has-text-align-center is-style-sydney-no-margin main-page-title has-text-color" style="color:#FFFFFF;margin-bottom:20px">We design and build digital products that perform</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"color":{"text":"#FFFFFF"},"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"var:preset|spacing|40"}}}} -->
<p class="has-text-align-center has-text-color" style="color:#FFFFFF;margin-top:var(--wp--preset--spacing--40);font-size:18px">A digital agency partnering with ambitious teams on brand identity,<br>design, and development — from first concept to launch.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--40)"><!-- wp:button {"textAlign":"right","backgroundColor":"global_color_1","className":"is-style-default","style":{"color":{"text":"var(--sydney-global-color-4)"},"border":{"width":"1px"},"elements":{"link":{"color":{"text":"var(--sydney-global-color-4)"}}}},"borderColor":"global_color_1"} -->
<div class="wp-block-button is-style-default"><a class="wp-block-button__link has-global-color-1-background-color has-text-color has-background has-link-color has-border-color has-global-color-1-border-color has-text-align-right wp-element-button" style="border-width:1px;color:var(--sydney-global-color-4)">
          LEARN MORE
        </a></div>
<!-- /wp:button -->

<!-- wp:button {"textAlign":"left","className":"is-style-outline","style":{"color":{"text":"#FFFFFF"},"border":{"width":"1px"},"elements":{"link":{"color":{"text":"#00102E"}}}},"borderColor":"global_color_1"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link has-text-color has-link-color has-border-color has-global-color-1-border-color has-text-align-left wp-element-button" style="border-width:1px;color:#FFFFFF">
          PROJECTS
        </a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->

<!-- wp:group {"align":"full","style":{"spacing":{"margin":{"top":"20px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="margin-top:20px"><!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide"><!-- wp:column {"width":"50%","style":{"spacing":{"padding":{"top":"0","right":"15px","bottom":"0","left":"0"}}}} -->
<div class="wp-block-column" style="padding-top:0;padding-right:15px;padding-bottom:0;padding-left:0;flex-basis:50%"></div>
<!-- /wp:column -->

<!-- wp:column {"width":"50%","style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"15px"}}}} -->
<div class="wp-block-column" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:15px;flex-basis:50%"></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"20%"} -->
<div class="wp-block-column" style="flex-basis:20%"></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:group {"align":"full","style":{"spacing":{"margin":{"top":"120px","bottom":"-65px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="margin-top:120px;margin-bottom:-65px"><!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|20"}}}} -->
<div class="wp-block-columns alignwide"><!-- wp:column {"width":"33.33%","style":{"spacing":{"padding":{"top":"0px","right":"15px","bottom":"0px","left":"15px"}}}} -->
<div class="wp-block-column" style="padding-top:0px;padding-right:15px;padding-bottom:0px;padding-left:15px;flex-basis:33.33%"><!-- wp:group {"style":{"spacing":{"padding":{"top":"30px","right":"30px","bottom":"30px","left":"30px"}},"border":{"radius":"0px"}},"backgroundColor":"white"} -->
<div class="wp-block-group has-white-background-color has-background" style="border-radius:0px;padding-top:30px;padding-right:30px;padding-bottom:30px;padding-left:30px"><!-- wp:image {"width":"50px","sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full is-resized"><img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI1MCIgaGVpZ2h0PSI1MCIgdmlld0JveD0iMCAwIDUwIDUwIj48Y2lyY2xlIGN4PSIyNSIgY3k9IjI1IiByPSIyNSIgZmlsbD0iI2ZmZDAwYSIvPjxnIGZpbGw9Im5vbmUiIHN0cm9rZT0iIzAwMTAyZSIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiPjxyZWN0IHg9IjE2IiB5PSIxNyIgd2lkdGg9IjE4IiBoZWlnaHQ9IjE2IiByeD0iMiIvPjxwYXRoIGQ9Ik0xNiAyOWw1LTQgNCAzIDQtNSA1IDYiLz48L2c+PGNpcmNsZSBjeD0iMjEiIGN5PSIyMiIgcj0iMS42IiBmaWxsPSIjMDAxMDJlIi8+PC9zdmc+" alt="" style="width:50px"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":6,"style":{"typography":{"fontSize":"12px","letterSpacing":"1px","textTransform":"uppercase"}},"textColor":"dark-gray"} -->
<h6 class="wp-block-heading has-dark-gray-color has-text-color" style="font-size:12px;letter-spacing:1px;text-transform:uppercase">Brand identity</h6>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"color":{"text":"var(--sydney-global-color-4)"}}} -->
<p class="has-text-color" style="color:var(--sydney-global-color-4)">We craft distinctive identities — logo, color and voice — that make your brand instantly recognizable.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"33.33%","style":{"spacing":{"padding":{"top":"0px","right":"15px","bottom":"0px","left":"15px"}}}} -->
<div class="wp-block-column" style="padding-top:0px;padding-right:15px;padding-bottom:0px;padding-left:15px;flex-basis:33.33%"><!-- wp:group {"style":{"spacing":{"padding":{"top":"30px","right":"30px","bottom":"30px","left":"30px"}},"border":{"radius":"0px"}},"backgroundColor":"white"} -->
<div class="wp-block-group has-white-background-color has-background" style="border-radius:0px;padding-top:30px;padding-right:30px;padding-bottom:30px;padding-left:30px"><!-- wp:image {"width":"50px","sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full is-resized"><img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI1MCIgaGVpZ2h0PSI1MCIgdmlld0JveD0iMCAwIDUwIDUwIj48Y2lyY2xlIGN4PSIyNSIgY3k9IjI1IiByPSIyNSIgZmlsbD0iI2ZmZDAwYSIvPjxnIGZpbGw9Im5vbmUiIHN0cm9rZT0iIzAwMTAyZSIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiPjxwYXRoIGQ9Ik0zMCAxNWw1IDUtMTMgMTMtNiAxIDEtNnoiLz48cGF0aCBkPSJNMjcgMThsNSA1Ii8+PC9nPjwvc3ZnPg==" alt="" style="width:50px"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":6,"style":{"typography":{"fontSize":"12px","letterSpacing":"1px","textTransform":"uppercase"}},"textColor":"dark-gray"} -->
<h6 class="wp-block-heading has-dark-gray-color has-text-color" style="font-size:12px;letter-spacing:1px;text-transform:uppercase">UI/UX</h6>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"color":{"text":"var(--sydney-global-color-4)"}}} -->
<p class="has-text-color" style="color:var(--sydney-global-color-4)">User-centered design and prototyping that turn complex flows into clear, conversion-ready interfaces.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"33.33%","style":{"spacing":{"padding":{"top":"0px","right":"15px","bottom":"0px","left":"15px"}}}} -->
<div class="wp-block-column" style="padding-top:0px;padding-right:15px;padding-bottom:0px;padding-left:15px;flex-basis:33.33%"><!-- wp:group {"style":{"spacing":{"padding":{"top":"30px","right":"30px","bottom":"30px","left":"30px"}},"border":{"radius":"0px"}},"backgroundColor":"white"} -->
<div class="wp-block-group has-white-background-color has-background" style="border-radius:0px;padding-top:30px;padding-right:30px;padding-bottom:30px;padding-left:30px"><!-- wp:image {"width":"50px","sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full is-resized"><img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI1MCIgaGVpZ2h0PSI1MCIgdmlld0JveD0iMCAwIDUwIDUwIj48Y2lyY2xlIGN4PSIyNSIgY3k9IjI1IiByPSIyNSIgZmlsbD0iI2ZmZDAwYSIvPjxnIGZpbGw9Im5vbmUiIHN0cm9rZT0iIzAwMTAyZSIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiPjxwYXRoIGQ9Ik0yMSAxOWwtNyA2IDcgNiIvPjxwYXRoIGQ9Ik0yOSAxOWw3IDYtNyA2Ii8+PC9nPjwvc3ZnPg==" alt="" style="width:50px"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":6,"style":{"typography":{"fontSize":"12px","letterSpacing":"1px","textTransform":"uppercase"}},"textColor":"dark-gray"} -->
<h6 class="wp-block-heading has-dark-gray-color has-text-color" style="font-size:12px;letter-spacing:1px;text-transform:uppercase">Development</h6>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"color":{"text":"var(--sydney-global-color-4)"}}} -->
<p class="has-text-color" style="color:var(--sydney-global-color-4)">Fast, accessible and scalable websites and apps, built with clean, maintainable code.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover -->

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"bottom":"var:preset|spacing|60","top":"15vh","left":"var:preset|spacing|30","right":"var:preset|spacing|30"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_7","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-global-color-7-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:15vh;padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--60);padding-left:var(--wp--preset--spacing--30)"><!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|60"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"62%","className":"center-mobile","style":{"spacing":{"padding":{"top":"0","right":"var:preset|spacing|60","bottom":"0","left":"var:preset|spacing|30"},"blockGap":"var:preset|spacing|30"}}} -->
<div class="wp-block-column is-vertically-aligned-center center-mobile" style="padding-top:0;padding-right:var(--wp--preset--spacing--60);padding-bottom:0;padding-left:var(--wp--preset--spacing--30);flex-basis:62%"><!-- wp:heading {"level":6,"className":"is-style-sydney-no-margin","style":{"color":{"text":"#737C8C"},"typography":{"textTransform":"uppercase","letterSpacing":"1px"}},"fontSize":"small"} -->
<h6 class="wp-block-heading is-style-sydney-no-margin has-text-color has-small-font-size" style="color:#737C8C;letter-spacing:1px;text-transform:uppercase">Strategy &amp; Branding</h6>
<!-- /wp:heading -->

<!-- wp:heading {"className":"is-style-default"} -->
<h2 class="wp-block-heading is-style-default">Brand strategy that sets you apart</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"color":{"text":"#233452"}}} -->
<p class="has-text-color" style="color:#233452">We dig into your market, audience and goals to shape a brand foundation of positioning, identity and messaging that scales as you grow.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"className":"center-mobile","style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}}} -->
<div class="wp-block-buttons center-mobile" style="margin-top:var(--wp--preset--spacing--50)"><!-- wp:button {"textAlign":"left","backgroundColor":"global_color_1","className":"is-style-default","style":{"border":{"width":"1px"}},"borderColor":"global_color_1"} -->
<div class="wp-block-button is-style-default"><a class="wp-block-button__link has-global-color-1-background-color has-background has-border-color has-global-color-1-border-color has-text-align-left wp-element-button" style="border-width:1px">
          LEARN MORE
        </a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"50%","className":"stretch-right","style":{"spacing":{"padding":{"top":"0","right":"10px","bottom":"0","left":"10px"}}}} -->
<div class="wp-block-column is-vertically-aligned-center stretch-right" style="padding-top:0;padding-right:10px;padding-bottom:0;padding-left:10px;flex-basis:50%"><!-- wp:image {"sizeSlug":"large","align":"center"} -->
<figure class="wp-block-image aligncenter size-large"><img src="%%ASSETS%%/identity-1.jpg" alt="" class=""/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"bottom":"var(--wp--preset--spacing--60)"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_7","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-global-color-7-background-color has-background" style="margin-top:0;margin-bottom:0;padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|60"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"42%","className":"stretch-left","style":{"spacing":{"padding":{"right":"10px","left":"10px"}}}} -->
<div class="wp-block-column is-vertically-aligned-center stretch-left" style="padding-right:10px;padding-left:10px;flex-basis:42%"><!-- wp:image {"sizeSlug":"large","linkDestination":"none"} -->
<figure class="wp-block-image size-large"><img src="%%ASSETS%%/identity-2.jpg" alt="" class=""/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"62%","className":"center-mobile","style":{"spacing":{"padding":{"left":"0","right":"0"}}}} -->
<div class="wp-block-column is-vertically-aligned-center center-mobile" style="padding-right:0;padding-left:0;flex-basis:62%"><!-- wp:heading {"level":6,"className":"is-style-sydney-no-margin","style":{"color":{"text":"#737C8C"},"typography":{"textTransform":"uppercase","letterSpacing":"1px"}},"fontSize":"small"} -->
<h6 class="wp-block-heading is-style-sydney-no-margin has-text-color has-small-font-size" style="color:#737C8C;letter-spacing:1px;text-transform:uppercase">Design &amp; Development</h6>
<!-- /wp:heading -->

<!-- wp:heading {"className":"is-style-default"} -->
<h2 class="wp-block-heading is-style-default">Websites built to perform</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"color":{"text":"#233452"}}} -->
<p class="has-text-color" style="color:#233452">From wireframes to launch, we design and build responsive, high-performance sites that look sharp and turn visitors into customers.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"className":"center-mobile","style":{"spacing":{"margin":{"top":"var(--wp--preset--spacing--50)"}}}} -->
<div class="wp-block-buttons center-mobile" style="margin-top:var(--wp--preset--spacing--50)"><!-- wp:button {"textAlign":"left","backgroundColor":"global_color_1","className":"is-style-default","style":{"border":{"width":"1px"}},"borderColor":"global_color_1"} -->
<div class="wp-block-button is-style-default"><a class="wp-block-button__link has-global-color-1-background-color has-background has-border-color has-global-color-1-border-color has-text-align-left wp-element-button" style="border-width:1px">LEARN MORE</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"40px","right":"var:preset|spacing|20","left":"var:preset|spacing|20"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-right:var(--wp--preset--spacing--20);padding-bottom:40px;padding-left:var(--wp--preset--spacing--20)"><!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide"><!-- wp:column {"width":"50%"} -->
<div class="wp-block-column" style="flex-basis:50%"><!-- wp:heading {"className":"center-mobile"} -->
<h2 class="wp-block-heading center-mobile">Our portfolio</h2>
<!-- /wp:heading --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"50%"} -->
<div class="wp-block-column" style="flex-basis:50%"><!-- wp:buttons {"className":"center-mobile","layout":{"type":"flex","justifyContent":"right"}} -->
<div class="wp-block-buttons center-mobile"><!-- wp:button {"textAlign":"right","backgroundColor":"global_color_1","className":"is-style-default","style":{"border":{"width":"1px"}},"borderColor":"global_color_1"} -->
<div class="wp-block-button is-style-default"><a class="wp-block-button__link has-global-color-1-background-color has-background has-border-color has-global-color-1-border-color has-text-align-right wp-element-button" style="border-width:1px">View portfolio</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"bottom":"130px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-bottom:130px"><!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"left":"0"}}}} -->
<div class="wp-block-columns alignwide"><!-- wp:column {"width":"50%","style":{"spacing":{"padding":{"right":"15px","left":"10px"}}}} -->
<div class="wp-block-column" style="padding-right:15px;padding-left:10px;flex-basis:50%"><!-- wp:image {"sizeSlug":"large","linkDestination":"file"} -->
<figure class="wp-block-image size-large"><a href="%%ASSETS%%/portfolio-1.jpg"><img src="%%ASSETS%%/portfolio-1.jpg" alt="" class=""/></a></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"large","linkDestination":"file"} -->
<figure class="wp-block-image size-large"><a href="%%ASSETS%%/portfolio-2.jpg"><img src="%%ASSETS%%/portfolio-2.jpg" alt="" class=""/></a></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"50%","style":{"spacing":{"padding":{"right":"10px","left":"15px"}}}} -->
<div class="wp-block-column" style="padding-right:10px;padding-left:15px;flex-basis:50%"><!-- wp:image {"sizeSlug":"large","linkDestination":"file"} -->
<figure class="wp-block-image size-large"><a href="%%ASSETS%%/portfolio-3.jpg"><img src="%%ASSETS%%/portfolio-3.jpg" alt="" class=""/></a></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"bottom":"var:preset|spacing|70","right":"var:preset|spacing|30","left":"var:preset|spacing|30","top":"var:preset|spacing|70"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_7","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-global-color-7-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--70);padding-left:var(--wp--preset--spacing--30)"><!-- wp:heading {"align":"wide","className":"is-style-default","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|40","top":"0"}}}} -->
<h2 class="wp-block-heading alignwide is-style-default" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--40)">Testimonials</h2>
<!-- /wp:heading -->

<!-- wp:columns {"align":"wide","style":{"spacing":{"padding":{"top":"0","right":"0","left":"0"}}}} -->
<div class="wp-block-columns alignwide" style="padding-top:0;padding-right:0;padding-left:0"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"top":"32px","right":"32px","bottom":"32px","left":"32px"}},"border":{"radius":"10px","color":"var(--sydney-global-color-8)","width":"1px"}},"backgroundColor":"white"} -->
<div class="wp-block-group has-border-color has-white-background-color has-background" style="border-color:var(--sydney-global-color-8);border-width:1px;border-radius:10px;padding-top:32px;padding-right:32px;padding-bottom:32px;padding-left:32px"><!-- wp:heading {"level":4,"style":{"typography":{"fontSize":"18px"}}} -->
<h4 class="wp-block-heading" style="font-size:18px">A true creative partner</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"bottom":"var(--wp--preset--spacing--30)"}}}} -->
<p style="margin-bottom:var(--wp--preset--spacing--30)">They turned our vision into a brand and site that finally feels like us. The whole process was collaborative and the results speak for themselves.</p>
<!-- /wp:paragraph -->

<!-- wp:media-text {"mediaLink":"","mediaType":"image","mediaWidth":18,"verticalAlignment":"center","imageFill":false} -->
<div class="wp-block-media-text is-stacked-on-mobile is-vertically-aligned-center" style="grid-template-columns:18% auto"><figure class="wp-block-media-text__media"><img src="%%ASSETS%%/avatar-1.jpg" alt="" class="size-full"/></figure><div class="wp-block-media-text__content"><!-- wp:heading {"level":6,"style":{"typography":{"fontSize":"16px"},"spacing":{"margin":{"bottom":"5px"}}}} -->
<h6 class="wp-block-heading" style="margin-bottom:5px;font-size:16px">Sarah Mitchell</h6>
<!-- /wp:heading -->

<!-- wp:paragraph {"fontSize":"small"} -->
<p class="has-small-font-size">Founder, Northwind</p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:media-text --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"top":"32px","right":"32px","bottom":"32px","left":"32px"}},"border":{"radius":"10px","color":"var(--sydney-global-color-8)","width":"1px"}},"backgroundColor":"white"} -->
<div class="wp-block-group has-border-color has-white-background-color has-background" style="border-color:var(--sydney-global-color-8);border-width:1px;border-radius:10px;padding-top:32px;padding-right:32px;padding-bottom:32px;padding-left:32px"><!-- wp:heading {"level":4,"style":{"typography":{"fontSize":"18px"}}} -->
<h4 class="wp-block-heading" style="font-size:18px">Delivered beyond expectations</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"bottom":"var(--wp--preset--spacing--30)"}}}} -->
<p style="margin-bottom:var(--wp--preset--spacing--30)">The team launched ahead of schedule and our new site lifted lead conversion noticeably. Communication was clear at every step.</p>
<!-- /wp:paragraph -->

<!-- wp:media-text {"mediaLink":"","mediaType":"image","mediaWidth":18,"verticalAlignment":"center","imageFill":false} -->
<div class="wp-block-media-text is-stacked-on-mobile is-vertically-aligned-center" style="grid-template-columns:18% auto"><figure class="wp-block-media-text__media"><img src="%%ASSETS%%/avatar-2.jpg" alt="" class="size-full"/></figure><div class="wp-block-media-text__content"><!-- wp:heading {"level":6,"style":{"typography":{"fontSize":"16px"},"spacing":{"margin":{"bottom":"5px"}}}} -->
<h6 class="wp-block-heading" style="margin-bottom:5px;font-size:16px">David Chen</h6>
<!-- /wp:heading -->

<!-- wp:paragraph {"fontSize":"small"} -->
<p class="has-small-font-size">Marketing Director, Lumen</p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:media-text --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"top":"32px","right":"32px","bottom":"32px","left":"32px"}},"border":{"radius":"10px","color":"var(--sydney-global-color-8)","width":"1px"}},"backgroundColor":"white"} -->
<div class="wp-block-group has-border-color has-white-background-color has-background" style="border-color:var(--sydney-global-color-8);border-width:1px;border-radius:10px;padding-top:32px;padding-right:32px;padding-bottom:32px;padding-left:32px"><!-- wp:heading {"level":4,"style":{"typography":{"fontSize":"18px"}}} -->
<h4 class="wp-block-heading" style="font-size:18px">Strategy to launch, flawless</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"bottom":"var(--wp--preset--spacing--30)"}}}} -->
<p style="margin-bottom:var(--wp--preset--spacing--30)">Every detail was considered, from positioning to the final pixel. Our brand has never looked more professional.</p>
<!-- /wp:paragraph -->

<!-- wp:media-text {"mediaLink":"","mediaType":"image","mediaWidth":18,"verticalAlignment":"center","imageFill":false} -->
<div class="wp-block-media-text is-stacked-on-mobile is-vertically-aligned-center" style="grid-template-columns:18% auto"><figure class="wp-block-media-text__media"><img src="%%ASSETS%%/avatar-3.jpg" alt="" class="size-full"/></figure><div class="wp-block-media-text__content"><!-- wp:heading {"level":6,"style":{"typography":{"fontSize":"16px"},"spacing":{"margin":{"bottom":"5px"}}}} -->
<h6 class="wp-block-heading" style="margin-bottom:5px;font-size:16px">Elena Rossi</h6>
<!-- /wp:heading -->

<!-- wp:paragraph {"fontSize":"small"} -->
<p class="has-small-font-size">CEO, Atlas Studio</p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:media-text --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","className":"center-mobile","style":{"color":{"background":"var(--sydney-global-color-6)"},"border":{"bottom":{"width":"1px","color":"#FFFFFF1A"}},"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70","left":"var:preset|spacing|30","right":"var:preset|spacing|30"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull center-mobile has-background" style="border-bottom-color:#FFFFFF1A;border-bottom-width:1px;background-color:var(--sydney-global-color-6);margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--70);padding-left:var(--wp--preset--spacing--30)"><!-- wp:columns {"verticalAlignment":"center","align":"wide"} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"50%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%"><!-- wp:heading {"style":{"color":{"text":"#FFFFFF"}}} -->
<h2 class="wp-block-heading has-text-color" style="color:#FFFFFF">Have a project in mind? Let’s get to work.</h2>
<!-- /wp:heading --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"50%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%"><!-- wp:buttons {"className":"center-mobile","layout":{"type":"flex","justifyContent":"right"}} -->
<div class="wp-block-buttons center-mobile"><!-- wp:button {"textAlign":"right","backgroundColor":"global_color_1","className":"is-style-default","style":{"border":{"width":"1px"}},"borderColor":"global_color_1"} -->
<div class="wp-block-button is-style-default"><a class="wp-block-button__link has-global-color-1-background-color has-background has-border-color has-global-color-1-border-color has-text-align-right wp-element-button" style="border-width:1px">Contact us</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
SYDNEY_STARTER_HOME;

		return str_replace( '%%ASSETS%%', get_template_directory_uri() . '/inc/starter-content/assets', $blocks );
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

/**
 * Enable the header/footer builder on fresh sites that never ran theme activation.
 *
 * The starter content above is built entirely around the builder: every
 * `sydney_header_row__*`, `sydney_section_fb_component__*` and `shfb_*` mod is
 * inert while the module is off, so the legacy header and footer render instead.
 *
 * `hf-builder` is normally switched on by `sydney_hf_enable_to_new_users()` on
 * `after_switch_theme` (inc/theme-update.php). The wp.org theme directory preview
 * updates the theme files in place and never re-fires activation, so that hook has
 * never run there and the module falls back to its default of off.
 *
 * Filtering the option rather than writing it keeps this read-only. Sites that did
 * run activation already hold an explicit value and return early below; established
 * sites are not fresh. Neither reaches the branch that enables the module.
 *
 * Registered at require time (functions.php:555) so it is in place before
 * class-header-footer-builder.php checks `is_module_active()` at include time
 * (functions.php:693).
 *
 * Both hooks are needed: `option_*` only fires when the row exists in the database,
 * `default_option_*` covers the case where nothing has ever written the option.
 *
 * @param mixed $modules Stored module states, or the default when the option is unset.
 * @return mixed Modules with `hf-builder` enabled, or `$modules` unchanged.
 */
function sydney_starter_content_force_hf_builder( $modules ) {
	// Established sites are out of scope entirely; bail before touching the value.
	if ( ! get_option( 'fresh_site' ) ) {
		return $modules;
	}

	$stored = is_array( $modules ) ? $modules : array();

	// An explicitly stored state always wins, including an explicit opt-out.
	if ( array_key_exists( 'hf-builder', $stored ) ) {
		return $modules;
	}

	$stored['hf-builder'] = true;

	return $stored;
}
add_filter( 'option_sydney-modules', 'sydney_starter_content_force_hf_builder' );
add_filter( 'default_option_sydney-modules', 'sydney_starter_content_force_hf_builder' );
