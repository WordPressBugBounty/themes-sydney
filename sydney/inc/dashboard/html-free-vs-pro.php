<?php

/**
 * Free vs Pro tab
 *
 * @package Dashboard
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/*
 * One entry per table section. In a row, 'free' and 'pro' are true for a tick,
 * false for a cross, or a string shown as text. 'docs' links the label, 'desc'
 * adds a line under it, and 'sub' indents the row under the one above it.
 */
$sections = array(
	array(
		'title' => __( 'General', 'sydney' ),
		'rows'  => array(
			array(
				'label' => __( 'Updates', 'sydney' ),
				'free'  => __( 'Free Version Updates', 'sydney' ),
				'pro'   => __( 'Pro updates while your license is active', 'sydney' ),
			),
			array(
				'label' => __( 'Premium Email Support', 'sydney' ),
				'free'  => false,
				'pro'   => __( '12 months included, renewable', 'sydney' ),
				'docs'  => $this->settings['support_terms_link'],
			),
			array(
				'label' => __( 'Gutenberg Ready', 'sydney' ),
				'free'  => true,
				'pro'   => true,
			),
			array(
				'label' => __( 'Translation Ready', 'sydney' ),
				'free'  => true,
				'pro'   => true,
			),
			array(
				'label' => __( 'Starter Sites', 'sydney' ),
				'free'  => '9',
				'pro'   => '25',
			),
			array(
				'label' => __( 'Templates Builder Module', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'docs'  => 'https://docs.athemes.com/article/435-templates-system-overview',
				'desc'  => __( 'Display rules like "Show this template on all posts" or "Show this template on all pages" are available to dynamic render the templates.', 'sydney' ),
			),
			array(
				'label' => __( 'Build custom headers', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'sub'   => true,
			),
			array(
				'label' => __( 'Build custom footers', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'sub'   => true,
			),
			array(
				'label' => __( 'Build custom blog archives', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'sub'   => true,
			),
			array(
				'label' => __( 'Build custom blog archive items', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'sub'   => true,
			),
			array(
				'label' => __( 'Build custom blog posts', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'sub'   => true,
			),
			array(
				'label' => __( 'Build custom content blocks', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'sub'   => true,
				'desc'  => __( 'Hooks like before/after content, before/after title, etc, are available to render the custom content block.', 'sydney' ),
			),
			array(
				'label' => __( 'Build custom 404 page', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'sub'   => true,
			),
			array(
				'label' => __( 'Build custom WooCommerce pages', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'sub'   => true,
				'desc'  => __( 'Build custom shop pages like shop, single product, cart, checkout.', 'sydney' ),
			),
			array(
				'label' => __( 'Breadcrumbs Module', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'docs'  => 'https://docs.athemes.com/article/440-pro-breadcrumbs',
			),
			array(
				'label' => __( 'Modal Popup Module', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'docs'  => 'https://docs.athemes.com/article/modal-in-sydney-pro/',
			),
			array(
				'label' => __( 'Offcanvas Content Module', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'docs'  => 'https://docs.athemes.com/article/offcanvas-content-module/',
			),
			array(
				'label' => __( 'Custom Fonts Module', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'docs'  => 'https://docs.athemes.com/article/pro-custom-fonts-in-sydney-pro/',
			),
			array(
				'label' => __( 'Custom Fonts upload & Adobe Fonts support', 'sydney' ),
				'free'  => false,
				'pro'   => true,
			),
			array(
				'label' => __( 'Quick Links Module', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'docs'  => 'https://docs.athemes.com/article/443-pro-quick-links-module',
			),
			array(
				'label' => __( 'Live Chat (WhatsApp) Module', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'docs'  => 'https://docs.athemes.com/article/pro-live-chat-module-with-whatsapp-support/',
			),
			array(
				'label' => __( 'Browser Tools Module', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'docs'  => 'https://docs.athemes.com/article/pro-browser-tools-module/',
			),
			array(
				'label' => __( 'Forms & HTML Designer Module', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'docs'  => 'https://docs.athemes.com/article/forms-html-module/',
			),
			array(
				'label' => __( 'Sidebar Module', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'docs'  => 'https://docs.athemes.com/article/pro-sidebar-module',
			),
			array(
				'label' => __( 'Extra Widget Area', 'sydney' ),
				'free'  => false,
				'pro'   => true,
			),
			array(
				'label' => __( 'Extra Page Templates', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'desc'  => __( 'Contact with map, Login, and featured or no header image layouts.', 'sydney' ),
			),
			array(
				'label' => __( 'White Label', 'sydney' ),
				'free'  => false,
				'pro'   => __( 'Agency plan', 'sydney' ),
				'docs'  => 'https://docs.athemes.com/article/pro-white-label-sydney/',
			),
		),
	),
	array(
		'title' => __( 'Header', 'sydney' ),
		'rows'  => array(
			array(
				'label' => __( 'Mega Menu module', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'docs'  => 'https://docs.athemes.com/article/how-to-build-a-mega-menu-with-sydney-pro/',
			),
			array(
				'label' => __( 'More Header Options', 'sydney' ),
				'free'  => false,
				'pro'   => true,
			),
			array(
				'label' => __( 'Language switcher', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'sub'   => true,
			),
			array(
				'label' => __( 'HTML/Shortcode components', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'sub'   => true,
			),
			array(
				'label' => __( 'Different logo for mobile devices', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'sub'   => true,
			),
			array(
				'label' => __( 'Sticky Menu', 'sydney' ),
				'free'  => true,
				'pro'   => true,
			),
			array(
				'label' => __( 'Extra Slider Options', 'sydney' ),
				'free'  => false,
				'pro'   => true,
			),
			array(
				'label' => __( 'User friendly slider options, resulting in a faster slider setup time', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'sub'   => true,
			),
			array(
				'label' => __( 'Individual settings for each slide', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'sub'   => true,
			),
			array(
				'label' => __( 'Entrance animation choices for the text and buttons', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'sub'   => true,
			),
			array(
				'label' => __( 'New slider settings like title tag selector, hide the slider on secondary blog pages and more', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'sub'   => true,
			),
			array(
				'label' => __( 'Vertical and horizontal aligment opions for the slider content', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'sub'   => true,
			),
			array(
				'label' => __( 'Styling options including colors, typography and content width', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'sub'   => true,
			),
			array(
				'label' => __( 'Page Headers Module', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'docs'  => 'https://docs.athemes.com/article/how-to-customize-page-headers-in-sydney-pro',
				'desc'  => __( 'Page header options for posts, pages, archives, etc.', 'sydney' ),
			),
		),
	),
	array(
		'title' => __( 'Blog', 'sydney' ),
		'rows'  => array(
			array(
				'label' => __( 'Extended Blog Module', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'docs'  => 'https://docs.athemes.com/article/438-pro-extended-blog-module',
			),
			array(
				'label' => __( 'Blog Layouts', 'sydney' ),
				'free'  => '6',
				'pro'   => '7',
				'sub'   => true,
			),
			array(
				'label' => __( 'Featured posts in blog hero', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'sub'   => true,
			),
			array(
				'label' => __( 'Featured boxes', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'sub'   => true,
			),
			array(
				'label' => __( 'Archive header options', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'sub'   => true,
			),
			array(
				'label' => __( 'Pagination options', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'sub'   => true,
			),
			array(
				'label' => __( 'Reading progress and reading time', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'sub'   => true,
			),
			array(
				'label' => __( 'Last updated date', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'sub'   => true,
			),
			array(
				'label' => __( 'Post sharing', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'sub'   => true,
			),
			array(
				'label' => __( 'Post header layouts', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'sub'   => true,
			),
			array(
				'label' => __( 'Related posts layout options', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'sub'   => true,
			),
		),
	),
	array(
		'title' => __( 'Footer', 'sydney' ),
		'rows'  => array(
			array(
				'label' => __( 'Widget Areas', 'sydney' ),
				'free'  => true,
				'pro'   => true,
			),
			array(
				'label' => __( 'Credits', 'sydney' ),
				'free'  => true,
				'pro'   => true,
			),
			array(
				'label' => __( 'More Footer Options', 'sydney' ),
				'free'  => false,
				'pro'   => true,
			),
			array(
				'label' => __( 'Footer Separator', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'sub'   => true,
			),
			array(
				'label' => __( 'Footer Reveal Effect', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'sub'   => true,
			),
			array(
				'label' => __( 'Extra components', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'sub'   => true,
			),
			array(
				'label' => __( 'Pre-footer area', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'sub'   => true,
			),
		),
	),
	array(
		'title' => __( 'WooCommerce', 'sydney' ),
		'rows'  => array(
			array(
				'label' => __( 'WooCommerce Support', 'sydney' ),
				'free'  => __( 'Basic', 'sydney' ),
				'pro'   => __( 'Extended', 'sydney' ),
			),
			array(
				'label' => __( 'Extended WooCommerce Module', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'docs'  => 'https://docs.athemes.com/article/444-pro-extended-woocommerce-module',
			),
			array(
				'label' => __( 'Wishlist', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'sub'   => true,
			),
			array(
				'label' => __( 'Quick View', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'sub'   => true,
			),
			array(
				'label' => __( 'Product Swatch', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'sub'   => true,
			),
			array(
				'label' => __( 'Multistep Checkout', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'sub'   => true,
			),
			array(
				'label' => __( 'Single Sticky Add To Cart', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'sub'   => true,
			),
			array(
				'label' => __( 'Shop Header Styles', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'sub'   => true,
			),
			array(
				'label' => __( 'Product Tab Styles', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'sub'   => true,
			),
			array(
				'label' => __( 'Shop Pagination: Numeric, Infinite, Load More Button', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'sub'   => true,
			),
			array(
				'label' => __( 'Advanced Reviews', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'sub'   => true,
			),
			array(
				'label' => __( 'Quantity Input Styles', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'sub'   => true,
			),
			array(
				'label' => __( 'Extra Single Product Elements: Shortcode and HTML', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'sub'   => true,
			),
			array(
				'label' => __( 'AJAX Product Search', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'sub'   => true,
			),
			array(
				'label' => __( 'Extra Shop Sidebar Layouts', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'sub'   => true,
			),
			array(
				'label' => __( 'Product Gallery Layouts', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'sub'   => true,
			),
		),
	),
	array(
		'title' => __( 'Elementor', 'sydney' ),
		'desc'  => __( 'Includes aThemes Addons Pro: 65+ premium Elementor widgets.', 'sydney' ),
		'rows'  => array(
			array(
				'label' => __( 'aThemes Addons Pro widgets', 'sydney' ),
				'free'  => false,
				'pro'   => true,
			),
			array(
				'label' => __( 'Elementor Tools Module', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'docs'  => 'https://docs.athemes.com/article/elementor-toolbox-module/',
			),
			array(
				'label' => __( 'Custom CSS for any widget, column, or section', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'sub'   => true,
			),
			array(
				'label' => __( 'Glassmorphism effect', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'sub'   => true,
			),
			array(
				'label' => __( 'Wrapper link for sections', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'sub'   => true,
			),
			array(
				'label' => __( 'Particles background for sections', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'sub'   => true,
			),
			array(
				'label' => __( 'Animation effects', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'sub'   => true,
			),
			array(
				'label' => __( 'Sticky mode for widgets, columns, and sections', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'sub'   => true,
			),
			array(
				'label' => __( 'Tooltips for widgets', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'sub'   => true,
			),
			array(
				'label' => __( 'Testimonials Carousel Widget', 'sydney' ),
				'free'  => true,
				'pro'   => true,
			),
			array(
				'label' => __( 'Portfolio Widget', 'sydney' ),
				'free'  => __( '1 Style', 'sydney' ),
				'pro'   => __( '2 Styles', 'sydney' ),
			),
			array(
				'label' => __( 'Posts Widget', 'sydney' ),
				'free'  => __( '1 Style', 'sydney' ),
				'pro'   => __( '2 Styles', 'sydney' ),
			),
			array(
				'label' => __( 'Slider Widget', 'sydney' ),
				'free'  => true,
				'pro'   => true,
			),
			array(
				'label' => __( 'Employee Carousel Widget', 'sydney' ),
				'free'  => true,
				'pro'   => true,
			),
			array(
				'label' => __( 'Advanced Carousel Widget', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'docs'  => 'https://docs.athemes.com/article/pro-advanced-carousel-widget/',
			),
			array(
				'label' => __( 'Advanced Tabs Widget', 'sydney' ),
				'free'  => false,
				'pro'   => true,
			),
			array(
				'label' => __( 'News Bar Widget', 'sydney' ),
				'free'  => false,
				'pro'   => true,
			),
			array(
				'label' => __( 'LearnDash Courses Widget', 'sydney' ),
				'free'  => false,
				'pro'   => true,
			),
			array(
				'label' => __( 'MailChimp Widget', 'sydney' ),
				'free'  => false,
				'pro'   => true,
			),
			array(
				'label' => __( 'Single Employee Widget', 'sydney' ),
				'free'  => false,
				'pro'   => true,
			),
			array(
				'label' => __( 'Timeline Widget', 'sydney' ),
				'free'  => false,
				'pro'   => true,
			),
			array(
				'label' => __( 'Pricing Tables Widget', 'sydney' ),
				'free'  => false,
				'pro'   => true,
			),
			array(
				'label' => __( 'Food Menu Widget', 'sydney' ),
				'free'  => false,
				'pro'   => true,
			),
			array(
				'label' => __( 'Animated heading Widget', 'sydney' ),
				'free'  => false,
				'pro'   => true,
			),
			array(
				'label' => __( 'Dual heading Widget', 'sydney' ),
				'free'  => false,
				'pro'   => true,
			),
			array(
				'label' => __( 'Image hotspots Widget', 'sydney' ),
				'free'  => false,
				'pro'   => true,
			),
			array(
				'label' => __( 'Dual Buttons Widget', 'sydney' ),
				'free'  => false,
				'pro'   => true,
			),
			array(
				'label' => __( 'Contact Form 7 Widget', 'sydney' ),
				'free'  => false,
				'pro'   => true,
			),
			array(
				'label' => __( 'WPForms Widget', 'sydney' ),
				'free'  => false,
				'pro'   => true,
			),
			array(
				'label' => __( 'Ninja Forms Widget', 'sydney' ),
				'free'  => false,
				'pro'   => true,
			),
		),
	),
	array(
		'title' => __( 'Hooks', 'sydney' ),
		'rows'  => array(
			array(
				'label' => __( 'Hooks System', 'sydney' ),
				'free'  => false,
				'pro'   => true,
				'docs'  => 'https://docs.athemes.com/article/418-pro-hooks-system-overview',
				'desc'  => __( 'Hooks allow you to add HTML or shortcodes across different areas of your website', 'sydney' ),
			),
		),
	),
);

$external_icon = '<svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M3 2C2.44772 2 2 2.44772 2 3V12C2 12.5523 2.44772 13 3 13H12C12.5523 13 13 12.5523 13 12V8.5C13 8.22386 12.7761 8 12.5 8C12.2239 8 12 8.22386 12 8.5V12H3V3H6.5C6.77614 3 7 2.77614 7 2.5C7 2.22386 6.77614 2 6.5 2H3ZM12.8536 2.14645C12.9015 2.19439 12.9377 2.24964 12.9621 2.30861C12.9861 2.36669 12.9996 2.4303 13 2.497V2.5V2.50049V5.5C13 5.77614 12.7761 6 12.5 6C12.2239 6 12 5.77614 12 5.5V3.70711L6.85355 8.85355C6.65829 9.04882 6.34171 9.04882 6.14645 8.85355C5.95118 8.65829 5.95118 8.34171 6.14645 8.14645L11.2929 3H9.5C9.22386 3 9 2.77614 9 2.5C9 2.22386 9.22386 2 9.5 2H12.4999H12.5C12.5678 2 12.6324 2.01349 12.6914 2.03794C12.7504 2.06234 12.8056 2.09851 12.8536 2.14645Z" fill="black"></path></svg>';

$sub_item_icon = '<svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.83315 11.6377H12.5076L8.9814 15.1639L9.68862 15.8711L14.4201 11.1396L9.68862 6.40488L8.9814 7.11211L12.5076 10.6383H6.83315C5.03687 10.635 3.58257 9.18066 3.57925 7.38437V1.12891H2.57983V7.38437C2.58315 9.73184 4.48569 11.6344 6.83315 11.6377Z" fill="#A0A0A0"></path></svg>';

?>

<div class="sydney-dashboard-row">
    <div class="sydney-dashboard-column">
        <div class="sydney-dashboard-card sydney-dashboard-card-top-spacing sydney-dashboard-card-tabs-divider">
            <div class="sydney-dashboard-card-header bt-d-flex bt-justify-content-between bt-align-items-center">
                <h2><?php esc_html_e( 'Everything Sydney Pro adds', 'sydney' ); ?></h2>
                <a href="<?php echo esc_url( $this->settings['upgrade_pro_freevspro_top'] ); ?>" target="_blank" class="button button-primary">
                    <?php esc_html_e( 'Get Sydney Pro', 'sydney' ); ?>
                </a>
            </div>
            <div class="sydney-dashboard-card-body">

				<div class="sydney-dashboard-freevspro-table-responsive">
					<div class="sydney-dashboard-freevspro-table">

						<?php foreach ( $sections as $section ) : ?>
							<div class="sydney-dashboard-freevspro-table__item">
								<div class="sydney-dashboard-freevspro-table__header">
									<div class="sydney-dashboard-freevspro-table__row">
										<div class="sydney-dashboard-freevspro-table__column sydney-dashboard-freevspro-table__column--feature">
											<strong class="h4"><?php echo esc_html( $section['title'] ); ?></strong>
											<?php if ( ! empty( $section['desc'] ) ) : ?>
												<p class="cs-mb-0"><?php echo esc_html( $section['desc'] ); ?></p>
											<?php endif; ?>
										</div>
										<div class="sydney-dashboard-freevspro-table__column">
											<?php esc_html_e( 'Free', 'sydney' ); ?>
										</div>
										<div class="sydney-dashboard-freevspro-table__column">
											<?php esc_html_e( 'Pro', 'sydney' ); ?>
										</div>
									</div>
								</div>

								<div class="sydney-dashboard-freevspro-table__body">
									<?php foreach ( $section['rows'] as $row ) : ?>
										<div class="sydney-dashboard-freevspro-table__row<?php echo ! empty( $row['sub'] ) ? ' sub-item' : ''; ?>">
											<div class="sydney-dashboard-freevspro-table__column sydney-dashboard-freevspro-table__column--feature">
												<?php
												if ( ! empty( $row['sub'] ) ) {
													echo $sub_item_icon; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
												}
												?>
												<?php if ( ! empty( $row['docs'] ) ) : ?>
													<strong><a href="<?php echo esc_url( $row['docs'] ); ?>" target="_blank"><?php echo esc_html( $row['label'] ); ?><?php echo $external_icon; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a></strong>
												<?php else : ?>
													<strong><?php echo esc_html( $row['label'] ); ?></strong>
												<?php endif; ?>
												<?php if ( ! empty( $row['desc'] ) ) : ?>
													<p class="cs-mb-0"><?php echo esc_html( $row['desc'] ); ?></p>
												<?php endif; ?>
											</div>
											<?php foreach ( array( $row['free'], $row['pro'] ) as $cell ) : ?>
												<div class="sydney-dashboard-freevspro-table__column">
													<?php if ( true === $cell ) : ?>
														<i class="sydney-dashboard-freevspro-table__icon dashicons dashicons-saved"></i>
													<?php elseif ( false === $cell ) : ?>
														<i class="sydney-dashboard-freevspro-table__icon dashicons dashicons-no-alt"></i>
													<?php else : ?>
														<strong class="cs-ml-0"><?php echo esc_html( $cell ); ?></strong>
													<?php endif; ?>
												</div>
											<?php endforeach; ?>
										</div>
									<?php endforeach; ?>
								</div>
							</div>
						<?php endforeach; ?>

					</div>
				</div>

				<div style="display: flex; justify-content: space-between; align-items: center; gap: var(--sydney-dashboard-space-4); margin-top:var(--sydney-dashboard-space-7); margin-right:var(--sydney-dashboard-space-15);">
					<p class="sydney-dashboard-upgrade-reassurance">
						<?php esc_html_e( '14-day money-back guarantee, no questions asked.', 'sydney' ); ?>
						<?php esc_html_e( 'If you don\'t renew, your site and every Pro feature keep working.', 'sydney' ); ?>
						<?php if ( $this->settings['upgrade_carries_over'] ) : ?>
							<?php esc_html_e( 'Everything you\'ve built carries over to Sydney Pro.', 'sydney' ); ?>
						<?php endif; ?>
					</p>
					<a href="<?php echo esc_url($this->settings['upgrade_pro_freevspro']); ?>" target="_blank" class="button button-primary" style="margin: 0;">
						<?php esc_html_e( 'Get Sydney Pro', 'sydney' ); ?>
					</a>
				</div>

			</div>
        </div>
    </div>
</div>
