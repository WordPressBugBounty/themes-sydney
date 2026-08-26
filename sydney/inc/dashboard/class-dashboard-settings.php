<?php

/**
 *
 * Dashboard Settings
 * @package Dashboard
 *
 * PARITY: inc/dashboard/ is kept identical between Sydney (free) and Sydney Pro
 * so the folder can be copied either way. Gate version-specific behaviour at
 * runtime — defined( 'SYDNEY_PRO_VERSION' ) or $settings['has_pro'] — instead of
 * forking a file. Anything added here must be added to the other codebase too.
 *
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

if ( !is_admin() ) {
	return;
}

/**
 * Whether the dashboard renders the Template Builder tab. Free carries it as an
 * upsell, Pro needs the templates module on.
 *
 * Lives outside sydney_dashboard_settings() because the admin menu has to ask
 * the same question on every page load, and building the settings array reaches
 * out to athemes.com for notifications.
 */
function sydney_dashboard_has_builder_tab()
{
	if ( ! defined( 'SYDNEY_PRO_VERSION' ) ) {
		return true;
	}

	return class_exists( 'Sydney_Modules' ) && Sydney_Modules::is_module_active( 'templates' );
}

function sydney_dashboard_settings()
{

	$settings = array();

	//
	// General.
	//
	$settings['menu_slug']           = 'sydney-dashboard';
	$settings['starter_plugin_slug'] = 'athemes-starter-sites';
	$settings['starter_plugin_path'] = 'athemes-starter-sites/athemes-starter-sites.php';
	$settings['has_pro']             = defined( 'SYDNEY_PRO_VERSION' ) ? true : false;
	$settings['website_link']        = 'https://athemes.com/';

	//
	// Hero.
	//
	$settings['hero_title'] = esc_html__('Welcome to Sydney', 'sydney');
	$settings['hero_desc'] = esc_html__('Sydney is installed and ready to go! Click "Let\'s Get Started" to browse our professionally designed starter sites and get your website up and running in minutes.', 'sydney');
	if ( get_option( 'atss_wizard_state' ) ) {
		$settings['hero_desc'] = esc_html__('Pick up where you left off! Click Resume Site Wizard to finish choosing your template and customizing your site\'s design and branding.', 'sydney');
	} elseif ( empty( get_option( 'atss_wizard_state' ) ) && get_option( 'atss_current_starter' ) ) {
		$settings['hero_desc']  = esc_html__('Starter Site is installed and ready for you! Check out the resources on this page to help you get started. Enjoy using Sydney!', 'sydney');
	}
	
	$settings['hero_image'] = get_template_directory_uri() . '/inc/dashboard/assets/images/welcome-banner@2x.png';

	//
	// Documentation.
	//
	$settings['documentation_link'] = 'https://docs.athemes.com/documentation/sydney/';

	//
	// Upgrade to Pro.
	//
    $settings['upgrade_pro'] = sydney_admin_upgrade_link( 'https://athemes.com/sydney-upgrade', array( 'utm_source' => 'theme_info', 'utm_medium' => 'link', 'utm_campaign' => 'Sydney' ), 'dashboard-upgrade-pro-link' );

	//
	// Support.
	//
    $settings['upgrade_pro_support'] = sydney_admin_upgrade_link( 'https://athemes.com/sydney-upgrade', array( 'utm_source' => 'dashboard_upgrade_support', 'utm_medium' => 'link', 'utm_campaign' => 'Sydney' ), 'dashboard-upgrade-pro-support-link' );

	//
	// Free vs Pro upgrade link.
	//
    $settings['upgrade_pro_freevspro'] = sydney_admin_upgrade_link( 'https://athemes.com/sydney-upgrade', array( 'utm_source' => 'dashboard_freevspro', 'utm_medium' => 'link', 'utm_campaign' => 'Sydney' ), 'dashboard-upgrade-pro-freevspro-link' );

	//
	// Module upgrade link.
	//
    $settings['upgrade_pro_module'] = sydney_admin_upgrade_link( 'https://athemes.com/sydney-upgrade', array( 'utm_source' => 'dashboard_module', 'utm_medium' => 'link', 'utm_campaign' => 'Sydney' ), 'dashboard-upgrade-pro-module-link' );

	//
	// Template Builder upgrade link. Every upsell on that tab points here, so the
	// notice and the card overlay report as one placement.
	//
    $settings['upgrade_pro_builder'] = sydney_admin_upgrade_link( 'https://athemes.com/sydney-upgrade', array( 'utm_source' => 'dashboard_template_builder', 'utm_medium' => 'link', 'utm_campaign' => 'Sydney' ), 'dashboard-upgrade-pro-builder-link' );

	//
	// Promo.
	//
	$settings['promo_title']  = esc_html__('Upgrade to Pro', 'sydney');
	$settings['promo_desc']   = esc_html__('Take Sydney to a whole other level by upgrading to the Pro version.', 'sydney');
	$settings['promo_button'] = esc_html__('Discover Sydney Pro', 'sydney');
    $settings['promo_link']   = sydney_admin_upgrade_link( 'https://athemes.com/sydney-upgrade', array( 'utm_source' => 'theme_info', 'utm_medium' => 'link', 'utm_campaign' => 'Sydney' ), 'dashboard-promo-link' );

	//
	// Review.
	//
	$settings['review_link']       = 'https://wordpress.org/support/theme/sydney/reviews/';
	$settings['suggest_idea_link'] = 'https://athemes.com/feature-request/';

	//
	// Knowledge Base.
	//
	$settings['knowledge_base_link'] = 'https://docs.athemes.com/documentation/sydney/';

	//
	// Support.
	//
	$settings['support_link']     = 'https://athemes.com/support/';

    $settings['support_pro_link'] = sydney_admin_upgrade_link( 'https://athemes.com/sydney-upgrade', array( 'utm_source' => 'theme_support', 'utm_medium' => 'button', 'utm_campaign' => 'Sydney' ), 'dashboard-support-pro-link' );

	//
	// Community.
	//
	$settings['community_link'] = 'https://www.facebook.com/groups/athemes/';

	//
	// Tutorial.
	//
	$settings['tutorial_link'] = 'https://athemes.com/video-tutorials/sydney/';

	//
	// Changelog.
	//
	$theme = wp_get_theme();
	$settings['changelog_version'] = $theme->version;
	$settings['changelog_link']    = 'https://athemes.com/changelog/sydney/';

	//
	// Social Links.
	//
	$settings['facebook_link'] = 'https://www.facebook.com/groups/athemes/';
	$settings['twitter_link']  = 'https://twitter.com/athemesdotcom';
	$settings['youtube_link']  = 'https://www.youtube.com/@Athemes';

	//
	// Tabs.
	//
	$settings['tabs']  = array(
		'home'           => esc_html__('Home', 'sydney'),
		'starter-sites'  => esc_html__('Starter Sites', 'sydney'),
		'settings'       => esc_html__('Settings', 'sydney'),
	);

	if ( class_exists( 'Sydney_Setup_Checklist' ) && Sydney_Setup_Checklist::instance()->should_show_tab() ) {
		$settings['tabs']['setup'] = esc_html__( 'Setup', 'sydney' );
	}

	$settings['tabs']['free-vs-pro'] = esc_html__('Free vs Pro', 'sydney');

	if ( sydney_dashboard_has_builder_tab() ) {
		$settings['tabs'] = array_merge(
			array_slice( $settings['tabs'], 0, 2 ),
			array( 'builder' => esc_html__( 'Template Builder', 'sydney' ) ),
			array_slice( $settings['tabs'], 2 )
		);
	}
	

	//
	// Settings.
	//
	$settings['settings'] = array(
		'general'     => esc_html__('License', 'sydney'),
		'misc'        => esc_html__('Misc', 'sydney'),
		'abilities'   => esc_html__('AI Abilities', 'sydney'),
	);

	//
	// Notifications.
	//
	
	if ( isset( $settings['has_pro'] ) && $settings['has_pro'] ) {
		$theme_id = '4672';
	} else {
		$theme_id = '4671';
	}

	$notifications_response    = wp_remote_get( 'https://athemes.com/wp-json/wp/v2/notifications?theme=' . $theme_id . '&per_page=3' );
	$settings['notifications'] = ! is_wp_error( $notifications_response ) || wp_remote_retrieve_response_code( $notifications_response ) === 200 ? json_decode( wp_remote_retrieve_body( $notifications_response ) ) : false;
	$settings['notifications_tabs'] = false;

	//
	// Demos.
	//
	$settings['demos'] = array();

	//
	// Plugins.
	//
	$settings['plugins'] = array();

	$settings['plugins'][] = array(
		'slug'   => 'athemes-blocks',
		'path'   => 'athemes-blocks/athemes-blocks.php',
		'icon'   => 'https://plugins.svn.wordpress.org/athemes-blocks/assets/icon-256x256.png',
		'banner' => 'https://plugins.svn.wordpress.org/athemes-blocks/assets/banner-772x250.png',
		'title'  => esc_html__('aThemes Blocks', 'sydney'),
		'desc'   => esc_html__('Extend the Gutenberg Block Editor with additional functionality.', 'sydney'),
	);

	$settings['plugins'][] = array(
		'slug'   => 'wpforms-lite',
		'path'   => 'wpforms-lite/wpforms.php',
		'icon'   => 'https://plugins.svn.wordpress.org/wpforms-lite/assets/icon-256x256.png',
		'banner' => 'https://plugins.svn.wordpress.org/wpforms-lite/assets/banner-772x250.png',
		'title'  => esc_html__('WPForms', 'sydney'),
		'desc'   => esc_html__('The best WordPress contact form plugin. Drag & Drop online form builder that helps you create beautiful contact forms + custom forms in minutes.', 'sydney'),
	);

	$settings['plugins'][] = array(
		'slug'   => 'leadin',
		'path'   => 'leadin/leadin.php',
		'icon'   => 'https://plugins.svn.wordpress.org/leadin/assets/icon-256x256.png',
		'banner' => 'https://plugins.svn.wordpress.org/leadin/assets/banner-772x250.png',
		'title'  => esc_html__('HubSpot', 'sydney'),
		'desc'   => esc_html__('HubSpot is a platform with all the tools and integrations you need for marketing, sales, and customer service.', 'sydney'),
	);

	//
	// Features.
	//
	$settings['features'] = array();

	$settings['features'][] = array(
		'type'       => 'free',
		'title'      => esc_html__('Site Title and Logo', 'sydney'),
		'desc'       => esc_html__('Set the title and upload logo.', 'sydney'),
		'link_label' => esc_html__('Customize', 'sydney'),
		'link_url'   => add_query_arg('autofocus[control]', 'blogname', admin_url('customize.php')),
	);

	if ( Sydney_Modules::is_module_active( 'hf-builder' ) ) {

		$settings['features'][] = array(
			'type'       => 'free',
			'title'      => esc_html__('Header Builder', 'sydney'),
			'desc'       => esc_html__('Drag and drop header builder.', 'sydney'),
			'link_label' => esc_html__('Customize', 'sydney'),
			'link_url'   => add_query_arg('autofocus[section]', 'sydney_section_hb_wrapper', admin_url('customize.php')),
		);
	
		$settings['features'][] = array(
			'type'       => 'free',
			'title'      => esc_html__('Footer Builder', 'sydney'),
			'desc'       => esc_html__('Drag and drop footer builder.', 'sydney'),
			'link_label' => esc_html__('Customize', 'sydney'),
			'link_url'   => add_query_arg('autofocus[section]', 'sydney_section_fb_wrapper', admin_url('customize.php')),
		);

	} else {

		$settings['features'][] = array(
			'type'       => 'free',
			'title'      => esc_html__('Header Options', 'sydney'),
			'desc'       => esc_html__('Customize the header options for your theme.', 'sydney'),
			'link_label' => esc_html__('Customize', 'sydney'),
			'link_url'   => add_query_arg('autofocus[panel]', 'sydney_panel_header', admin_url('customize.php')),
		);
	
		$settings['features'][] = array(
			'type'       => 'free',
			'title'      => esc_html__('Footer Credits', 'sydney'),
			'desc'       => esc_html__('Customize the footer credits for your theme.', 'sydney'),
			'link_label' => esc_html__('Customize', 'sydney'),
			'link_url'   => add_query_arg('autofocus[section]', 'sydney_section_footer_credits', admin_url('customize.php')),
		);      
	}

	$settings['features'][] = array(
		'type'       => 'free',
		'title'      => esc_html__('Typography', 'sydney'),
		'desc'       => esc_html__('Set the global font size, style and library.', 'sydney'),
		'link_label' => esc_html__('Customize', 'sydney'),
		'link_url'   => add_query_arg('autofocus[panel]', 'sydney_panel_global_styles', admin_url('customize.php')),
	);

	$settings['features'][] = array(
		'type'       => 'free',
		'title'      => esc_html__('Color Options', 'sydney'),
		'desc'       => esc_html__('Change the colors for various elements.', 'sydney'),
		'link_label' => esc_html__('Customize', 'sydney'),
		'link_url'   => add_query_arg('autofocus[section]', 'colors', admin_url('customize.php')),
	);

	$settings['features'][] = array(
		'type'       => 'free',
		'title'      => esc_html__('Buttons', 'sydney'),
		'desc'       => esc_html__('Customize the buttons in your theme.', 'sydney'),
		'link_label' => esc_html__('Customize', 'sydney'),
		'link_url'   => add_query_arg('autofocus[section]', 'sydney_section_buttons', admin_url('customize.php')),
	);
	
	$settings['features'][] = array(
		'type'       => 'free',
		'title'      => esc_html__('Blog Options', 'sydney'),
		'desc'       => esc_html__('Customize the blog options for your theme.', 'sydney'),
		'link_label' => esc_html__('Customize', 'sydney'),
		'link_url'   => add_query_arg('autofocus[panel]', 'sydney_panel_blog', admin_url('customize.php')),
	);
	//Start Pro Features

	// Add top bar option only if header/footer builder is NOT active
	if ( ! Sydney_Modules::is_module_active( 'hf-builder' ) ) {
		$settings['features'][] = array(
			'category'   => 'header',
			'type'       => 'pro',
			'title'      => esc_html__('Top bar', 'sydney'),
			'desc'       => esc_html__('Customize the top bar of your theme.', 'sydney'),
			'link_label' => esc_html__('Customize', 'sydney'),
			'docs_link'   => 'https://docs.athemes.com/article/pro-how-to-configure-the-top-bar/',
			'link_url'   => add_query_arg('autofocus[section]', 'sydney_section_top_bar', admin_url('customize.php')),
		);
	}
	$settings['features'][] = array(
		'category'    => 'general',
		'module'      => 'templates',
		'title'        => esc_html__('Template Builder', 'sydney'),
		'type'        => 'pro',
		'redirect_url' => admin_url( 'admin.php?page=sydney-dashboard&tab=builder' ),
		//'link_url'    => add_query_arg('post_type', 'athemes_hf', admin_url('edit.php')),
		//'link_label'  => esc_html__('Build templates', 'sydney'),
		'docs_link'   => 'https://docs.athemes.com/article/435-templates-system-overview',
		'desc'        => __('Build headers, footers etc. with Elementor.', 'sydney'),
	);
	$settings['features'][] = array(
		'category'    => 'general',
		'module'      => 'quick-links',
		'title'        => esc_html__('Quick Links Module', 'sydney'),
		'type'        => 'pro',
		'link_url'    => add_query_arg('autofocus[section]', 'sydney_quicklinks', admin_url('customize.php')),
		'link_label'  => esc_html__('Customize', 'sydney'),
		'docs_link'   => 'https://docs.athemes.com/article/443-pro-quick-links-module',
		'desc'        => __('Floating quick links bar (contact, social etc.)', 'sydney'),
	);
	$settings['features'][] = array(
		'category'    => 'general',
		'module'      => 'modal',
		'title'        => esc_html__('Modal', 'sydney'),
		'type'        => 'pro',
		'link_url'    => add_query_arg('autofocus[section]', 'sydney_section_modal_popup', admin_url('customize.php')),
		'link_label'  => esc_html__('Customize', 'sydney'),
		'docs_link'   => 'https://docs.athemes.com/article/modal-in-sydney-pro/',
		'desc'        => __('Modal with custom content', 'sydney'),
	);
	$settings['features'][] = array(
		'category'    => 'general',
		'module'      => 'custom-fonts',
		'title'        => esc_html__('Custom Fonts', 'sydney'),
		'type'        => 'pro',
		'link_url'    => add_query_arg('autofocus[section]', 'sydney_section_typography_general', admin_url('customize.php')),
		'link_label'  => esc_html__('Customize', 'sydney'),
		'docs_link'   => 'https://docs.athemes.com/article/pro-custom-fonts-in-sydney-pro/',
		'desc'        => __('Add custom fonts to your site.', 'sydney'),
	);
	$settings['features'][] = array(
		'category'    => 'general',
		'module'      => 'offcanvas-content',
		'title'        => esc_html__('Offcanvas Content', 'sydney'),
		'type'        => 'pro',
		'link_url'    => add_query_arg('autofocus[section]', 'sydney_section_offcanvas_content', admin_url('customize.php')),
		'link_label'  => esc_html__('Customize', 'sydney'),
		'docs_link'   => 'https://docs.athemes.com/article/offcanvas-content-module/',
		'desc'        => __('Offcanvas sidebars, Elementor templates or custom content', 'sydney'),
	);
	$settings['features'][] = array(
		'category'    => 'general',
		'module'      => 'browser-tools',
		'title'        => esc_html__('Browser Tools', 'sydney'),
		'type'        => 'pro',
		'link_url'    => add_query_arg('autofocus[section]', 'sydney_browser_tools', admin_url('customize.php')),
		'link_label'  => esc_html__('Customize', 'sydney'),
		'docs_link'   => 'https://docs.athemes.com/article/pro-browser-tools-module/',
		'desc'        => __('Scrollbar, mobile theme color, prevent text copy', 'sydney'),
	);  
	if ( !Sydney_Modules::is_module_active( 'hf-builder' ) ) {
		$settings['features'][] = array(
			'category'    => 'header',
			'module'      => 'ext-header',
			'title'        => esc_html__('Extended Header Module', 'sydney'),
			'type'        => 'pro',
			'link_url'    => add_query_arg('autofocus[panel]', 'sydney_panel_header', admin_url('customize.php')),
			'link_label'  => esc_html__('Customize', 'sydney'),
			'docs_link'   => 'https://docs.athemes.com/article/436-pro-extended-header-module',
			'desc'        => __('New features for your header area.', 'sydney'),
		);
	}
	$settings['features'][] = array(
		'category'    => 'header',
		'module'      => 'mega-menu',
		'title'        => esc_html__('Mega Menu', 'sydney'),
		'type'        => 'pro',
		//'link_url'        => admin_url( '/customize.php?autofocus[section]=sydney_mega_menu' ),
		//'link_label'  => esc_html__( 'Customize', 'sydney' ),
		'docs_link'   => 'https://docs.athemes.com/article/how-to-build-a-mega-menu-with-sydney-pro/',
		'desc'        => __('Mega menu with Elementor support', 'sydney'),
		'dependency'  => array(
			'callback' => function() {
				return defined( 'ELEMENTOR_VERSION' );
			},
			'message'  => esc_html__( 'Requires Elementor', 'sydney' ),
		),      
	);
	if ( !Sydney_Modules::is_module_active( 'hf-builder' ) ) {
		$settings['features'][] = array(
			'category'    => 'footer',
			'module'      => 'ext-footer',
			'title'        => esc_html__('Extended Footer Module', 'sydney'),
			'type'        => 'pro',
			'link_url'    => add_query_arg('autofocus[panel]', 'sydney_panel_footer', admin_url('customize.php')),
			'link_label'  => esc_html__('Customize', 'sydney'),
			'docs_link'   => 'https://docs.athemes.com/article/442-pro-extended-footer-module',
			'desc'        => __('Extra features for your footer', 'sydney'),
		);
	}
	if ( Sydney_Modules::is_module_active( 'hf-builder' ) ) {
		$settings['features'][] = array(
			'category'    => 'footer',
			'module'      => 'pre-footer',
			'title'        => esc_html__('Pre-Footer Module', 'sydney'),
			'type'        => 'pro',
			'link_url'    => add_query_arg('autofocus[section]', 'sydney_footer_contact', admin_url('customize.php')),
			'link_label'  => esc_html__('Customize', 'sydney'),
			'docs_link'   => 'https://docs.athemes.com/article/pre-footer-area/',
			'desc'        => __('Pre-footer module', 'sydney'),
		);
	}
	$settings['features'][] = array(
		'category'    => 'blog',
		'module'      => 'ext-blog',
		'title'        => esc_html__('Extended Blog Module', 'sydney'),
		'type'        => 'pro',
		'link_url'    => add_query_arg('autofocus[panel]', 'sydney_panel_blog', admin_url('customize.php')),
		'link_label'  => esc_html__('Customize', 'sydney'),
		'docs_link'   => 'https://docs.athemes.com/article/438-pro-extended-blog-module',
		'desc'        => __('Extra features for your blog.', 'sydney'),
	);
	$settings['features'][] = array(
		'category'    => 'blog',
		'module'      => 'page-headers',
		'title'        => esc_html__('Page Headers', 'sydney'),
		'type'        => 'pro',
		//'link_url'        => admin_url( '/customize.php?autofocus[section]=sydney_breadcrumbs' ),
		//'link_label'  => esc_html__( 'Customize', 'sydney' ),
		'docs_link'   => 'https://docs.athemes.com/article/how-to-customize-page-headers-in-sydney-pro',
		'desc'        => __('Page Header options for posts, pages, archives etc.', 'sydney'),
	);
	$settings['features'][] = array(
		'category'    => 'blog',
		'module'      => 'breadcrumbs',
		'title'        => esc_html__('Breadcrumbs Module', 'sydney'),
		'type'        => 'pro',
		'link_url'    => add_query_arg('autofocus[section]', 'sydney_breadcrumbs', admin_url('customize.php')),
		'link_label'  => esc_html__('Customize', 'sydney'),
		'docs_link'   => 'https://docs.athemes.com/article/440-pro-breadcrumbs',
		'desc'        => __('Breadcrumbs functionality.', 'sydney'),
	);
	$settings['features'][] = array(
		'category'    => 'blog',
		'module'      => 'sidebar',
		'title'        => esc_html__('Sidebar Module', 'sydney'),
		'type'        => 'pro',
		'link_url'    => add_query_arg('autofocus[section]', 'sydney_section_sidebar', admin_url('customize.php')),
		'link_label'  => esc_html__('Customize', 'sydney'),
		'docs_link'   => 'https://docs.athemes.com/article/pro-sidebar-module',
		'desc'        => __('Extended sidebar options.', 'sydney'),
	);
	$settings['features'][] = array(
		'category'    => 'integrations',
		'module'      => 'ext-woocommerce',
		'title'        => esc_html__('Extended WooCommerce', 'sydney'),
		'type'        => 'pro',
		'link_url'    => add_query_arg('autofocus[panel]', 'woocommerce', admin_url('customize.php')),
		'link_label'  => esc_html__('Customize', 'sydney'),
		'docs_link'   => 'https://docs.athemes.com/article/444-pro-extended-woocommerce-module',
		'desc'        => __('Extra features for WooCommerce', 'sydney'),
		'dependency'  => array(
			'callback' => function() {
				return class_exists( 'WooCommerce' );
			},
			'message'  => esc_html__( 'Requires WooCommerce', 'sydney' ),
		),
	);
	$settings['features'][] = array(
		'category'    => 'integrations',
		'module'      => 'elementor-tools',
		'title'        => esc_html__('Elementor Tools', 'sydney'),
		'type'        => 'pro',
		//'link_url'            => admin_url( '/customize.php?autofocus[section]=sydney_section_modal_popup' ),
		//'link_label'  => esc_html__( 'Customize', 'sydney' ),
		'docs_link'   => 'https://docs.athemes.com/article/elementor-toolbox-module/',
		'desc'        => __('Custom CSS and other tools for Elementor', 'sydney'),
	);
	$settings['features'][] = array(
		'category'    => 'integrations',
		'module'      => 'live-chat',
		'title'        => esc_html__('Live Chat (WhatsApp)', 'sydney'),
		'type'        => 'pro',
		'link_url'    => add_query_arg('autofocus[section]', 'sydney_section_live_chat', admin_url('customize.php')),
		'link_label'  => esc_html__('Customize', 'sydney'),
		'docs_link'   => 'https://docs.athemes.com/article/pro-live-chat-module-with-whatsapp-support/',
		'desc'        => __('Live chat floating icon', 'sydney'),
	);
	$settings['features'][] = array(
		'category'    => 'general',
		'module'      => 'html-designer',
		'title'        => esc_html__('Forms &amp; HTML Designer', 'sydney'),
		'type'        => 'pro',
		'link_url'    => add_query_arg('autofocus[section]', 'sydney_section_html_designer', admin_url('customize.php')),
		'link_label'  => esc_html__('Customize', 'sydney'),
		'docs_link'   => 'https://docs.athemes.com/article/forms-html-module/',
		'desc'        => __('Design options for HTML elements and forms.', 'sydney'),
	);      
	$settings['features'][] = array(
		'type'       => 'pro',
		'title'      => esc_html__('Extra Widget Area', 'sydney'),
		'desc'       => esc_html__('Add an extra widget area to your theme.', 'sydney'),
		'link_label' => esc_html__('Customize', 'sydney'),
		'link_url'   => add_query_arg('autofocus[section]', 'sydney_extra_widget_area', admin_url('customize.php')),
	);
	

	$settings['features'][] = array(
		'type'       => 'pro',
		'title'      => esc_html__('Hooks', 'sydney'),
		'desc'       => esc_html__('Add your custom code to various hooks', 'sydney'),
		'module'     => 'hooks',
		'link_label' => esc_html__('Customize', 'sydney'),
		'link_url'   => add_query_arg('autofocus[panel]', 'sydney_hooks_panel', admin_url('customize.php')),
		'docs_link'  => 'https://docs.athemes.com/article/pro-hooks-system-overview/',
	);

	$settings['features'][] = array(
		'type'       => 'pro',
		'title'      => esc_html__('White Label (Agency)', 'sydney'),
		'desc'       => esc_html__('Rename and present Sydney as your own.', 'sydney'),
		'docs_link'  => 'https://docs.athemes.com/article/pro-white-label-sydney/',
		'link_label' => esc_html__('Learn More', 'sydney'),
	);

	//Register the Block Templates module only if the function exists
	if ( function_exists( 'block_template_part' ) ) {
		$settings['features'][] = array(
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

	$settings['features'][] = array(
		'category' => 'general',
		'module'   => 'pattern-library',
		'title'    => esc_html__( 'Pattern Library', 'sydney' ),
		'type'     => 'free',
		'desc'     => __( 'Browse and insert Sydney patterns directly from the block editor.', 'sydney' ),
	);

	// Useful plugins.
	$settings['useful-plugins'] = array(
		'merchant' => array(
			'slug' => 'merchant',
			'path' => 'merchant/merchant.php',
			'name' => __( 'Merchant', 'sydney' ),
			'img_url' => get_template_directory_uri() . '/images/admin/merchant-logo.png',
		),
		'athemes-addons-for-elementor-lite' => array(
			'slug' => 'athemes-addons-for-elementor-lite',
			'path' => 'athemes-addons-for-elementor-lite/athemes-addons-elementor.php',
			'name' => __( 'aThemes Addons for Elementor', 'sydney' ),
			'img_url' => get_template_directory_uri() . '/images/admin/athemes-addons-logo.png',
		),
	);

	return $settings;
}
add_filter('sydney_dashboard_settings', 'sydney_dashboard_settings');

/**
 * Get all modules ids
 * 
 */
function sydney_get_modules_ids() {
	$settings = sydney_dashboard_settings();

	$modules = array();

	foreach ( $settings[ 'features' ] as $feature ) {
		if( ! isset( $feature[ 'module' ] ) ) {
			continue;
		}

		$modules[] = $feature[ 'module' ];
	}
	
	return $modules;
}

/**
 * Demos Settings
 * 
 */
function sydney_demos_settings($settings) {

	// Categories.
	$settings['categories'] = array(
		'business'  => 'Business',
		'portfolio' => 'Portfolio',
		'ecommerce' => 'eCommerce',
		'event'     => 'Events',
	);

	// Builders.
	$settings['builders'] = array(
		'gutenberg' => 'Gutenberg',
		'elementor' => 'Elementor',
	);

	// Pro.
	$settings['has_pro']        = defined( 'SYDNEY_PRO_VERSION' ) ? true : false;
	$settings['pro_status']     = defined( 'SYDNEY_PRO_VERSION' ) ? true : false; //for backward compatibility
	$settings['pro_label']      = esc_html__('Get Pro', 'sydney');
	$settings['pro_link']       = sydney_admin_upgrade_link( 'https://athemes.com/theme/sydney', array( 'utm_source' => 'theme_table', 'utm_medium' => 'button', 'utm_campaign' => 'Sydney' ), 'dashboard-pro-link' );

	return $settings;
}
add_filter( 'atss_register_demos_settings', 'sydney_demos_settings' );

