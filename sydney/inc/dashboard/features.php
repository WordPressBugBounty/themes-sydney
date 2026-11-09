<?php

/**
 *
 * Dashboard feature rows
 * @package Dashboard
 *
 * Gate version-specific behaviour at runtime, with defined( 'SYDNEY_PRO_VERSION' )
 * or $settings['has_pro'], instead of forking a file.
 *
 * Loaded on every request, not only in wp-admin: the abilities read the Pro
 * rows over REST, where class-dashboard-settings.php returns early.
 *
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * The feature rows the dashboard Home tab lists, free and Pro.
 *
 * @return array
 */
function sydney_dashboard_features()
{
	$features = array();

	$features[] = array(
		'type'       => 'free',
		'title'      => esc_html__('Site Title and Logo', 'sydney'),
		'desc'       => esc_html__('Set the title and upload logo.', 'sydney'),
		'link_label' => esc_html__('Customize', 'sydney'),
		'link_url'   => add_query_arg('autofocus[control]', 'blogname', admin_url('customize.php')),
	);

	if ( Sydney_Modules::is_module_active( 'hf-builder' ) ) {

		$features[] = array(
			'type'       => 'free',
			'title'      => esc_html__('Header Builder', 'sydney'),
			'desc'       => esc_html__('Drag and drop header builder.', 'sydney'),
			'link_label' => esc_html__('Customize', 'sydney'),
			'link_url'   => add_query_arg('autofocus[section]', 'sydney_section_hb_wrapper', admin_url('customize.php')),
		);
	
		$features[] = array(
			'type'       => 'free',
			'title'      => esc_html__('Footer Builder', 'sydney'),
			'desc'       => esc_html__('Drag and drop footer builder.', 'sydney'),
			'link_label' => esc_html__('Customize', 'sydney'),
			'link_url'   => add_query_arg('autofocus[section]', 'sydney_section_fb_wrapper', admin_url('customize.php')),
		);

	} else {

		$features[] = array(
			'type'       => 'free',
			'title'      => esc_html__('Header Options', 'sydney'),
			'desc'       => esc_html__('Customize the header options for your theme.', 'sydney'),
			'link_label' => esc_html__('Customize', 'sydney'),
			'link_url'   => add_query_arg('autofocus[panel]', 'sydney_panel_header', admin_url('customize.php')),
		);
	
		$features[] = array(
			'type'       => 'free',
			'title'      => esc_html__('Footer Credits', 'sydney'),
			'desc'       => esc_html__('Customize the footer credits for your theme.', 'sydney'),
			'link_label' => esc_html__('Customize', 'sydney'),
			'link_url'   => add_query_arg('autofocus[section]', 'sydney_section_footer_credits', admin_url('customize.php')),
		);      
	}

	$features[] = array(
		'type'       => 'free',
		'title'      => esc_html__('Typography', 'sydney'),
		'desc'       => esc_html__('Set the global font size, style and library.', 'sydney'),
		'link_label' => esc_html__('Customize', 'sydney'),
		'link_url'   => add_query_arg('autofocus[panel]', 'sydney_panel_global_styles', admin_url('customize.php')),
	);

	$features[] = array(
		'type'       => 'free',
		'title'      => esc_html__('Color Options', 'sydney'),
		'desc'       => esc_html__('Change the colors for various elements.', 'sydney'),
		'link_label' => esc_html__('Customize', 'sydney'),
		'link_url'   => add_query_arg('autofocus[section]', 'colors', admin_url('customize.php')),
	);

	$features[] = array(
		'type'       => 'free',
		'title'      => esc_html__('Buttons', 'sydney'),
		'desc'       => esc_html__('Customize the buttons in your theme.', 'sydney'),
		'link_label' => esc_html__('Customize', 'sydney'),
		'link_url'   => add_query_arg('autofocus[section]', 'sydney_section_buttons', admin_url('customize.php')),
	);
	
	$features[] = array(
		'type'       => 'free',
		'title'      => esc_html__('Blog Options', 'sydney'),
		'desc'       => esc_html__('Customize the blog options for your theme.', 'sydney'),
		'link_label' => esc_html__('Customize', 'sydney'),
		'link_url'   => add_query_arg('autofocus[panel]', 'sydney_panel_blog', admin_url('customize.php')),
	);
	//Start Pro Features

	// Add top bar option only if header/footer builder is NOT active
	if ( ! Sydney_Modules::is_module_active( 'hf-builder' ) ) {
		$features[] = array(
			'category'   => 'header',
			'type'       => 'pro',
			'title'      => esc_html__('Top bar', 'sydney'),
			'utm_content' => 'card_top_bar',
			'desc'       => esc_html__('A bar above the header for contact details, links and social icons.', 'sydney'),
			'link_label' => esc_html__('Customize', 'sydney'),
			'docs_link'   => 'https://docs.athemes.com/article/pro-how-to-configure-the-top-bar/',
			'link_url'   => add_query_arg('autofocus[section]', 'sydney_section_top_bar', admin_url('customize.php')),
		);
	}
	$features[] = array(
		'category'    => 'general',
		'module'      => 'templates',
		'title'        => esc_html__('Template Builder', 'sydney'),
		'type'        => 'pro',
		'redirect_url' => admin_url( 'admin.php?page=sydney-dashboard&tab=builder' ),
		//'link_url'    => add_query_arg('post_type', 'athemes_hf', admin_url('edit.php')),
		//'link_label'  => esc_html__('Build templates', 'sydney'),
		'docs_link'   => 'https://docs.athemes.com/article/435-templates-system-overview',
		'desc'        => __('Custom headers, footers and page layouts with Elementor or blocks.', 'sydney'),
	);
	$features[] = array(
		'category'    => 'general',
		'module'      => 'quick-links',
		'title'        => esc_html__('Quick Links Module', 'sydney'),
		'type'        => 'pro',
		'link_url'    => add_query_arg('autofocus[section]', 'sydney_quicklinks', admin_url('customize.php')),
		'link_label'  => esc_html__('Customize', 'sydney'),
		'docs_link'   => 'https://docs.athemes.com/article/443-pro-quick-links-module',
		'desc'        => __('A floating bar that keeps your contact and social links one click away.', 'sydney'),
	);
	$features[] = array(
		'category'    => 'general',
		'module'      => 'modal',
		'title'        => esc_html__('Modal', 'sydney'),
		'type'        => 'pro',
		'link_url'    => add_query_arg('autofocus[section]', 'sydney_section_modal_popup', admin_url('customize.php')),
		'link_label'  => esc_html__('Customize', 'sydney'),
		'docs_link'   => 'https://docs.athemes.com/article/modal-in-sydney-pro/',
		'desc'        => __('Pop-ups with your own content for offers, sign-ups or announcements.', 'sydney'),
	);
	$features[] = array(
		'category'    => 'general',
		'module'      => 'custom-fonts',
		'title'        => esc_html__('Custom Fonts', 'sydney'),
		'type'        => 'pro',
		'link_url'    => add_query_arg('autofocus[section]', 'sydney_section_typography_general', admin_url('customize.php')),
		'link_label'  => esc_html__('Customize', 'sydney'),
		'docs_link'   => 'https://docs.athemes.com/article/pro-custom-fonts-in-sydney-pro/',
		'desc'        => __('Upload your own fonts and use them across the Customizer.', 'sydney'),
	);
	$features[] = array(
		'category'    => 'general',
		'module'      => 'offcanvas-content',
		'title'        => esc_html__('Offcanvas Content', 'sydney'),
		'type'        => 'pro',
		'link_url'    => add_query_arg('autofocus[section]', 'sydney_section_offcanvas_content', admin_url('customize.php')),
		'link_label'  => esc_html__('Customize', 'sydney'),
		'docs_link'   => 'https://docs.athemes.com/article/offcanvas-content-module/',
		'desc'        => __('Slide-out panels with widgets, Elementor templates or custom content.', 'sydney'),
	);
	$features[] = array(
		'category'    => 'general',
		'module'      => 'browser-tools',
		'title'        => esc_html__('Browser Tools', 'sydney'),
		'type'        => 'pro',
		'link_url'    => add_query_arg('autofocus[section]', 'sydney_browser_tools', admin_url('customize.php')),
		'link_label'  => esc_html__('Customize', 'sydney'),
		'docs_link'   => 'https://docs.athemes.com/article/pro-browser-tools-module/',
		'desc'        => __('Style the scrollbar, color the mobile browser bar and protect your text from copying.', 'sydney'),
	);  
	if ( !Sydney_Modules::is_module_active( 'hf-builder' ) ) {
		$features[] = array(
			'category'    => 'header',
			'module'      => 'ext-header',
			'title'        => esc_html__('Extended Header Module', 'sydney'),
			'type'        => 'pro',
			'link_url'    => add_query_arg('autofocus[panel]', 'sydney_panel_header', admin_url('customize.php')),
			'link_label'  => esc_html__('Customize', 'sydney'),
			'docs_link'   => 'https://docs.athemes.com/article/436-pro-extended-header-module',
			'desc'        => __('More header layouts, elements and styling options.', 'sydney'),
		);
	}
	$features[] = array(
		'category'    => 'header',
		'module'      => 'mega-menu',
		'title'        => esc_html__('Mega Menu', 'sydney'),
		'type'        => 'pro',
		//'link_url'        => admin_url( '/customize.php?autofocus[section]=sydney_mega_menu' ),
		//'link_label'  => esc_html__( 'Customize', 'sydney' ),
		'docs_link'   => 'https://docs.athemes.com/article/how-to-build-a-mega-menu-with-sydney-pro/',
		'desc'        => __('Multi-column menus you design with Elementor.', 'sydney'),
		'dependency'  => array(
			'callback' => function() {
				return defined( 'ELEMENTOR_VERSION' );
			},
			'message'  => esc_html__( 'Requires Elementor', 'sydney' ),
		),      
	);
	if ( !Sydney_Modules::is_module_active( 'hf-builder' ) ) {
		$features[] = array(
			'category'    => 'footer',
			'module'      => 'ext-footer',
			'title'        => esc_html__('Extended Footer Module', 'sydney'),
			'type'        => 'pro',
			'link_url'    => add_query_arg('autofocus[panel]', 'sydney_panel_footer', admin_url('customize.php')),
			'link_label'  => esc_html__('Customize', 'sydney'),
			'docs_link'   => 'https://docs.athemes.com/article/442-pro-extended-footer-module',
			'desc'        => __('More footer layouts, widget areas and styling options.', 'sydney'),
		);
	}
	if ( Sydney_Modules::is_module_active( 'hf-builder' ) ) {
		$features[] = array(
			'category'    => 'footer',
			'module'      => 'pre-footer',
			'title'        => esc_html__('Pre-Footer Module', 'sydney'),
			'type'        => 'pro',
			'link_url'    => add_query_arg('autofocus[section]', 'sydney_footer_contact', admin_url('customize.php')),
			'link_label'  => esc_html__('Customize', 'sydney'),
			'docs_link'   => 'https://docs.athemes.com/article/pre-footer-area/',
			'desc'        => __('A call-to-action area above the footer on every page.', 'sydney'),
		);
	}
	$features[] = array(
		'category'    => 'blog',
		'module'      => 'ext-blog',
		'title'        => esc_html__('Extended Blog Module', 'sydney'),
		'type'        => 'pro',
		'link_url'    => add_query_arg('autofocus[panel]', 'sydney_panel_blog', admin_url('customize.php')),
		'link_label'  => esc_html__('Customize', 'sydney'),
		'docs_link'   => 'https://docs.athemes.com/article/438-pro-extended-blog-module',
		'desc'        => __('More blog layouts, post meta and single post options.', 'sydney'),
	);
	$features[] = array(
		'category'    => 'blog',
		'module'      => 'page-headers',
		'title'        => esc_html__('Page Headers', 'sydney'),
		'type'        => 'pro',
		//'link_url'        => admin_url( '/customize.php?autofocus[section]=sydney_breadcrumbs' ),
		//'link_label'  => esc_html__( 'Customize', 'sydney' ),
		'docs_link'   => 'https://docs.athemes.com/article/how-to-customize-page-headers-in-sydney-pro',
		'desc'        => __('Title banners with background images for posts, pages and archives.', 'sydney'),
	);
	$features[] = array(
		'category'    => 'blog',
		'module'      => 'breadcrumbs',
		'title'        => esc_html__('Breadcrumbs Module', 'sydney'),
		'type'        => 'pro',
		'link_url'    => add_query_arg('autofocus[section]', 'sydney_breadcrumbs', admin_url('customize.php')),
		'link_label'  => esc_html__('Customize', 'sydney'),
		'docs_link'   => 'https://docs.athemes.com/article/440-pro-breadcrumbs',
		'desc'        => __('Breadcrumb trails that help visitors and search engines find their way.', 'sydney'),
	);
	$features[] = array(
		'category'    => 'blog',
		'module'      => 'sidebar',
		'title'        => esc_html__('Sidebar Module', 'sydney'),
		'type'        => 'pro',
		'link_url'    => add_query_arg('autofocus[section]', 'sydney_section_sidebar', admin_url('customize.php')),
		'link_label'  => esc_html__('Customize', 'sydney'),
		'docs_link'   => 'https://docs.athemes.com/article/pro-sidebar-module',
		'desc'        => __('More sidebar layouts and styling options.', 'sydney'),
	);
	$features[] = array(
		'category'    => 'integrations',
		'module'      => 'ext-woocommerce',
		'title'        => esc_html__('Extended WooCommerce', 'sydney'),
		'type'        => 'pro',
		'link_url'    => add_query_arg('autofocus[panel]', 'woocommerce', admin_url('customize.php')),
		'link_label'  => esc_html__('Customize', 'sydney'),
		'docs_link'   => 'https://docs.athemes.com/article/444-pro-extended-woocommerce-module',
		'desc'        => __('Wishlist, product swatches, sticky add-to-cart, multi-step checkout and more.', 'sydney'),
		'dependency'  => array(
			'callback' => function() {
				return class_exists( 'WooCommerce' );
			},
			'message'  => esc_html__( 'Requires WooCommerce', 'sydney' ),
		),
	);
	$features[] = array(
		'category'    => 'integrations',
		'module'      => 'elementor-tools',
		'title'        => esc_html__('Elementor Tools', 'sydney'),
		'type'        => 'pro',
		//'link_url'            => admin_url( '/customize.php?autofocus[section]=sydney_section_modal_popup' ),
		//'link_label'  => esc_html__( 'Customize', 'sydney' ),
		'docs_link'   => 'https://docs.athemes.com/article/elementor-toolbox-module/',
		'desc'        => __('Custom CSS, particles, tooltips and sticky sections for Elementor.', 'sydney'),
	);
	$features[] = array(
		'category'    => 'integrations',
		'module'      => 'live-chat',
		'title'        => esc_html__('Live Chat (WhatsApp)', 'sydney'),
		'type'        => 'pro',
		'link_url'    => add_query_arg('autofocus[section]', 'sydney_section_live_chat', admin_url('customize.php')),
		'link_label'  => esc_html__('Customize', 'sydney'),
		'docs_link'   => 'https://docs.athemes.com/article/pro-live-chat-module-with-whatsapp-support/',
		'desc'        => __('A WhatsApp chat button on every page.', 'sydney'),
	);
	$features[] = array(
		'category'    => 'general',
		'module'      => 'html-designer',
		'title'        => esc_html__('Forms &amp; HTML Designer', 'sydney'),
		'type'        => 'pro',
		'link_url'    => add_query_arg('autofocus[section]', 'sydney_section_html_designer', admin_url('customize.php')),
		'link_label'  => esc_html__('Customize', 'sydney'),
		'docs_link'   => 'https://docs.athemes.com/article/forms-html-module/',
		'desc'        => __('Style your forms and HTML elements to match your site.', 'sydney'),
	);      
	$features[] = array(
		'type'       => 'pro',
		'title'      => esc_html__('Extra Widget Area', 'sydney'),
		'utm_content' => 'card_extra_widget_area',
		'desc'       => esc_html__('One more widget area for content beyond the sidebar and footer.', 'sydney'),
		'link_label' => esc_html__('Customize', 'sydney'),
		'link_url'   => add_query_arg('autofocus[section]', 'sydney_extra_widget_area', admin_url('customize.php')),
	);
	

	$features[] = array(
		'type'       => 'pro',
		'title'      => esc_html__('Hooks', 'sydney'),
		'desc'       => esc_html__('Insert your own code or content at hook points across the theme.', 'sydney'),
		'module'     => 'hooks',
		'link_label' => esc_html__('Customize', 'sydney'),
		'link_url'   => add_query_arg('autofocus[panel]', 'sydney_hooks_panel', admin_url('customize.php')),
		'docs_link'  => 'https://docs.athemes.com/article/pro-hooks-system-overview/',
	);

	$features[] = array(
		'id'          => 'dark-mode',
		'type'        => 'pro',
		'category'    => 'general',
		'title'       => esc_html__('Dark mode', 'sydney'),
		'utm_content' => 'card_dark_mode',
		'desc'        => esc_html__('A dark color scheme with its own palette that visitors can switch to.', 'sydney'),
		'link_label'  => esc_html__('Customize', 'sydney'),
		'link_url'    => add_query_arg('autofocus[section]', 'colors', admin_url('customize.php')),
	);

	$features[] = array(
		'id'         => 'white-label',
		'type'       => 'pro',
		'title'      => esc_html__('White Label (Agency)', 'sydney'),
		'utm_content' => 'card_white_label',
		'desc'       => esc_html__('Hand clients a site that carries your brand, not ours.', 'sydney'),
		'docs_link'  => 'https://docs.athemes.com/article/pro-white-label-sydney/',
		'link_label' => esc_html__('Learn More', 'sydney'),
	);

	//Register the Block Templates module only if the function exists
	if ( function_exists( 'block_template_part' ) ) {
		$features[] = array(
			'category'    => 'general',
			'module'      => 'block-templates',
			'title'        => esc_html__('Block Templates', 'sydney'),
			'type'        => 'free',
			'link_url'    => add_query_arg('autofocus[section]', 'sydney_block_templates', admin_url('customize.php')),
			'link_label'  => esc_html__('Customize', 'sydney'),
			'docs_link'   => 'https://docs.athemes.com/article/block-templates-module/',
			'desc'        => __('Build headers, footers etc. with the site editor.', 'sydney'),
		);
	}

	$features[] = array(
		'category' => 'general',
		'module'   => 'pattern-library',
		'title'    => esc_html__( 'Pattern Library', 'sydney' ),
		'type'     => 'free',
		'desc'     => __( 'Browse and insert Sydney patterns directly from the block editor.', 'sydney' ),
	);

	return $features;
}
