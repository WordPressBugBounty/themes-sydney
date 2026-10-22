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

/**
 * How many starter sites the aThemes Starter Sites plugin registers, in total
 * and of type pro. Both are 0 while the plugin is inactive.
 *
 * @return array
 */
function sydney_dashboard_starter_counts()
{
	$demos  = apply_filters( 'atss_register_demos_list', array() ); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound
	$counts = array(
		'total' => 0,
		'pro'   => 0,
	);

	if ( ! is_array( $demos ) ) {
		return $counts;
	}

	foreach ( $demos as $demo ) {
		$counts['total']++;

		if ( isset( $demo['type'] ) && 'pro' === $demo['type'] ) {
			$counts['pro']++;
		}
	}

	return $counts;
}

/**
 * The Pro starter site a free user picked in the wizard and left at the Pro
 * gate, or false.
 *
 * @return array|false Array with the demo id and name.
 */
function sydney_dashboard_wizard_pro_pick()
{
	if ( defined( 'SYDNEY_PRO_VERSION' ) ) {
		return false;
	}

	$state = get_option( 'atss_wizard_state' );

	if ( empty( $state['data']['design']['selectedSiteId'] ) ) {
		return false;
	}

	$demo_id = $state['data']['design']['selectedSiteId'];
	$demos   = apply_filters( 'atss_register_demos_list', array() ); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound

	if ( ! isset( $demos[ $demo_id ]['type'] ) || 'pro' !== $demos[ $demo_id ]['type'] ) {
		return false;
	}

	return array(
		'id'   => $demo_id,
		'name' => isset( $demos[ $demo_id ]['name'] ) ? $demos[ $demo_id ]['name'] : $demo_id,
	);
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
	$settings['starter_counts']  = sydney_dashboard_starter_counts();
	$settings['wizard_pro_pick'] = sydney_dashboard_wizard_pro_pick();

	if ( $settings['wizard_pro_pick'] ) {
		$settings['hero_desc'] = sprintf(
			/* translators: 1: starter site name, 2: number of other Pro starter sites */
			esc_html__( 'You picked the %1$s template. It\'s part of Sydney Pro, along with %2$d more Pro templates and the Template Builder. 14-day money-back guarantee.', 'sydney' ),
			esc_html( $settings['wizard_pro_pick']['name'] ),
			max( 0, $settings['starter_counts']['pro'] - 1 )
		);
	} elseif ( get_option( 'atss_wizard_state' ) ) {
		$settings['hero_desc'] = esc_html__('Pick up where you left off! Click Resume wizard to finish choosing your template and customizing your site\'s design and branding.', 'sydney');
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

    $settings['upgrade_pro_website'] = sydney_admin_upgrade_link( 'https://athemes.com/sydney-upgrade', array( 'utm_source' => 'theme_info', 'utm_medium' => 'link', 'utm_campaign' => 'Sydney', 'utm_content' => 'topbar_website' ), 'dashboard-upgrade-pro-website-link' );

    $settings['upgrade_pro_settings'] = sydney_admin_upgrade_link( 'https://athemes.com/sydney-upgrade', array( 'utm_source' => 'theme_info', 'utm_medium' => 'link', 'utm_campaign' => 'Sydney', 'utm_content' => 'settings_card' ), 'dashboard-upgrade-pro-settings-link' );

	//
	// Starter Sites tab row, free only.
	//
	$settings['upgrade_pro_starter_sites'] = sydney_admin_upgrade_link( 'https://athemes.com/sydney-upgrade', array( 'utm_source' => 'dashboard_starter_sites', 'utm_medium' => 'link', 'utm_campaign' => 'Sydney', 'utm_content' => 'grid_strip' ), 'dashboard-upgrade-pro-starter-sites-link' );

	//
	// Hero "Unlock {Name}" button, free only, after the wizard's Pro gate.
	//
	$settings['upgrade_pro_hero'] = sydney_admin_upgrade_link( 'https://athemes.com/sydney-upgrade', array( 'utm_source' => 'dashboard_hero', 'utm_medium' => 'link', 'utm_campaign' => 'Sydney', 'utm_content' => 'unlock_template' ), 'dashboard-upgrade-pro-hero-link' );

	//
	// Support.
	//
    $settings['upgrade_pro_support'] = sydney_admin_upgrade_link( 'https://athemes.com/sydney-upgrade', array( 'utm_source' => 'dashboard_upgrade_support', 'utm_medium' => 'link', 'utm_campaign' => 'Sydney' ), 'dashboard-upgrade-pro-support-link' );

	//
	// Free vs Pro upgrade link.
	//
    $settings['upgrade_pro_freevspro'] = sydney_admin_upgrade_link( 'https://athemes.com/sydney-upgrade', array( 'utm_source' => 'dashboard_freevspro', 'utm_medium' => 'link', 'utm_campaign' => 'Sydney', 'utm_content' => 'freevspro_bottom' ), 'dashboard-upgrade-pro-freevspro-link' );

	//
	// Module upgrade link. Each Pro card on the Home tab builds its own, tagged
	// with its module id, in html-home.php.
	//
    $settings['upgrade_pro_module'] = sydney_admin_upgrade_link( 'https://athemes.com/sydney-upgrade', array( 'utm_source' => 'dashboard_module', 'utm_medium' => 'link', 'utm_campaign' => 'Sydney', 'utm_content' => 'home_header' ), 'dashboard-upgrade-pro-module-link' );

	//
	// Template Builder upgrade links. The notice and the card overlay share one
	// source, so the tab still reports as one row, and utm_content tells them apart.
	//
    $settings['upgrade_pro_builder_notice'] = sydney_admin_upgrade_link( 'https://athemes.com/sydney-upgrade#features', array( 'utm_source' => 'dashboard_template_builder', 'utm_medium' => 'link', 'utm_campaign' => 'Sydney', 'utm_content' => 'builder_notice' ), 'dashboard-upgrade-pro-builder-notice-link' );

    $settings['upgrade_pro_builder_card'] = sydney_admin_upgrade_link( 'https://athemes.com/sydney-upgrade#features', array( 'utm_source' => 'dashboard_template_builder', 'utm_medium' => 'link', 'utm_campaign' => 'Sydney', 'utm_content' => 'builder_card' ), 'dashboard-upgrade-pro-builder-card-link' );

	//
	// Promo.
	//
	$settings['promo_title']  = esc_html__('Upgrade to Pro', 'sydney');
	$settings['promo_desc']   = esc_html__('Take Sydney to a whole other level by upgrading to the Pro version.', 'sydney');
	$settings['promo_button'] = esc_html__('Discover Sydney Pro', 'sydney');

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
	// Premium support terms.
	//
	$settings['support_terms_link'] = sydney_admin_upgrade_link( 'https://athemes.com/support/', array( 'utm_source' => 'dashboard_upgrade_support', 'utm_medium' => 'link', 'utm_campaign' => 'Sydney', 'utm_content' => 'support_terms' ), 'dashboard-support-terms-link' );

	//
	// Free vs Pro top button. The bottom one is upgrade_pro_freevspro.
	//
	$settings['upgrade_pro_freevspro_top'] = sydney_admin_upgrade_link( 'https://athemes.com/sydney-upgrade', array( 'utm_source' => 'dashboard_freevspro', 'utm_medium' => 'link', 'utm_campaign' => 'Sydney', 'utm_content' => 'freevspro_top' ), 'dashboard-upgrade-pro-freevspro-top-link' );

	//
	// Pro copies the parent theme's Customizer settings on its first activation,
	// so a child theme's settings don't carry over.
	//
	$settings['upgrade_carries_over'] = 'sydney' === get_stylesheet();

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

	$notifications_key = 'sydney_dashboard_notifications_' . $theme_id;
	$notifications     = get_transient( $notifications_key );

	if ( false === $notifications ) {
		$notifications          = array();
		$notifications_response = wp_remote_get( 'https://athemes.com/wp-json/wp/v2/notifications?theme=' . $theme_id . '&per_page=3' );

		if ( ! is_wp_error( $notifications_response ) && 200 === (int) wp_remote_retrieve_response_code( $notifications_response ) ) {
			$notifications_body = json_decode( wp_remote_retrieve_body( $notifications_response ) );

			if ( is_array( $notifications_body ) ) {
				$notifications = $notifications_body;
			}
		}

		// A failed fetch is retried sooner than a good one is refreshed.
		set_transient( $notifications_key, $notifications, $notifications ? 12 * HOUR_IN_SECONDS : HOUR_IN_SECONDS );
	}

	$settings['notifications'] = $notifications ? $notifications : false;
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
			'utm_content' => 'card_top_bar',
			'desc'       => esc_html__('A bar above the header for contact details, links and social icons.', 'sydney'),
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
		'desc'        => __('Custom headers, footers and page layouts with Elementor or blocks.', 'sydney'),
	);
	$settings['features'][] = array(
		'category'    => 'general',
		'module'      => 'quick-links',
		'title'        => esc_html__('Quick Links Module', 'sydney'),
		'type'        => 'pro',
		'link_url'    => add_query_arg('autofocus[section]', 'sydney_quicklinks', admin_url('customize.php')),
		'link_label'  => esc_html__('Customize', 'sydney'),
		'docs_link'   => 'https://docs.athemes.com/article/443-pro-quick-links-module',
		'desc'        => __('A floating bar that keeps your contact and social links one click away.', 'sydney'),
	);
	$settings['features'][] = array(
		'category'    => 'general',
		'module'      => 'modal',
		'title'        => esc_html__('Modal', 'sydney'),
		'type'        => 'pro',
		'link_url'    => add_query_arg('autofocus[section]', 'sydney_section_modal_popup', admin_url('customize.php')),
		'link_label'  => esc_html__('Customize', 'sydney'),
		'docs_link'   => 'https://docs.athemes.com/article/modal-in-sydney-pro/',
		'desc'        => __('Pop-ups with your own content for offers, sign-ups or announcements.', 'sydney'),
	);
	$settings['features'][] = array(
		'category'    => 'general',
		'module'      => 'custom-fonts',
		'title'        => esc_html__('Custom Fonts', 'sydney'),
		'type'        => 'pro',
		'link_url'    => add_query_arg('autofocus[section]', 'sydney_section_typography_general', admin_url('customize.php')),
		'link_label'  => esc_html__('Customize', 'sydney'),
		'docs_link'   => 'https://docs.athemes.com/article/pro-custom-fonts-in-sydney-pro/',
		'desc'        => __('Upload your own fonts and use them across the Customizer.', 'sydney'),
	);
	$settings['features'][] = array(
		'category'    => 'general',
		'module'      => 'offcanvas-content',
		'title'        => esc_html__('Offcanvas Content', 'sydney'),
		'type'        => 'pro',
		'link_url'    => add_query_arg('autofocus[section]', 'sydney_section_offcanvas_content', admin_url('customize.php')),
		'link_label'  => esc_html__('Customize', 'sydney'),
		'docs_link'   => 'https://docs.athemes.com/article/offcanvas-content-module/',
		'desc'        => __('Slide-out panels with widgets, Elementor templates or custom content.', 'sydney'),
	);
	$settings['features'][] = array(
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
		$settings['features'][] = array(
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
	$settings['features'][] = array(
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
		$settings['features'][] = array(
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
		$settings['features'][] = array(
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
	$settings['features'][] = array(
		'category'    => 'blog',
		'module'      => 'ext-blog',
		'title'        => esc_html__('Extended Blog Module', 'sydney'),
		'type'        => 'pro',
		'link_url'    => add_query_arg('autofocus[panel]', 'sydney_panel_blog', admin_url('customize.php')),
		'link_label'  => esc_html__('Customize', 'sydney'),
		'docs_link'   => 'https://docs.athemes.com/article/438-pro-extended-blog-module',
		'desc'        => __('More blog layouts, post meta and single post options.', 'sydney'),
	);
	$settings['features'][] = array(
		'category'    => 'blog',
		'module'      => 'page-headers',
		'title'        => esc_html__('Page Headers', 'sydney'),
		'type'        => 'pro',
		//'link_url'        => admin_url( '/customize.php?autofocus[section]=sydney_breadcrumbs' ),
		//'link_label'  => esc_html__( 'Customize', 'sydney' ),
		'docs_link'   => 'https://docs.athemes.com/article/how-to-customize-page-headers-in-sydney-pro',
		'desc'        => __('Title banners with background images for posts, pages and archives.', 'sydney'),
	);
	$settings['features'][] = array(
		'category'    => 'blog',
		'module'      => 'breadcrumbs',
		'title'        => esc_html__('Breadcrumbs Module', 'sydney'),
		'type'        => 'pro',
		'link_url'    => add_query_arg('autofocus[section]', 'sydney_breadcrumbs', admin_url('customize.php')),
		'link_label'  => esc_html__('Customize', 'sydney'),
		'docs_link'   => 'https://docs.athemes.com/article/440-pro-breadcrumbs',
		'desc'        => __('Breadcrumb trails that help visitors and search engines find their way.', 'sydney'),
	);
	$settings['features'][] = array(
		'category'    => 'blog',
		'module'      => 'sidebar',
		'title'        => esc_html__('Sidebar Module', 'sydney'),
		'type'        => 'pro',
		'link_url'    => add_query_arg('autofocus[section]', 'sydney_section_sidebar', admin_url('customize.php')),
		'link_label'  => esc_html__('Customize', 'sydney'),
		'docs_link'   => 'https://docs.athemes.com/article/pro-sidebar-module',
		'desc'        => __('More sidebar layouts and styling options.', 'sydney'),
	);
	$settings['features'][] = array(
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
	$settings['features'][] = array(
		'category'    => 'integrations',
		'module'      => 'elementor-tools',
		'title'        => esc_html__('Elementor Tools', 'sydney'),
		'type'        => 'pro',
		//'link_url'            => admin_url( '/customize.php?autofocus[section]=sydney_section_modal_popup' ),
		//'link_label'  => esc_html__( 'Customize', 'sydney' ),
		'docs_link'   => 'https://docs.athemes.com/article/elementor-toolbox-module/',
		'desc'        => __('Custom CSS, particles, tooltips and sticky sections for Elementor.', 'sydney'),
	);
	$settings['features'][] = array(
		'category'    => 'integrations',
		'module'      => 'live-chat',
		'title'        => esc_html__('Live Chat (WhatsApp)', 'sydney'),
		'type'        => 'pro',
		'link_url'    => add_query_arg('autofocus[section]', 'sydney_section_live_chat', admin_url('customize.php')),
		'link_label'  => esc_html__('Customize', 'sydney'),
		'docs_link'   => 'https://docs.athemes.com/article/pro-live-chat-module-with-whatsapp-support/',
		'desc'        => __('A WhatsApp chat button on every page.', 'sydney'),
	);
	$settings['features'][] = array(
		'category'    => 'general',
		'module'      => 'html-designer',
		'title'        => esc_html__('Forms &amp; HTML Designer', 'sydney'),
		'type'        => 'pro',
		'link_url'    => add_query_arg('autofocus[section]', 'sydney_section_html_designer', admin_url('customize.php')),
		'link_label'  => esc_html__('Customize', 'sydney'),
		'docs_link'   => 'https://docs.athemes.com/article/forms-html-module/',
		'desc'        => __('Style your forms and HTML elements to match your site.', 'sydney'),
	);      
	$settings['features'][] = array(
		'type'       => 'pro',
		'title'      => esc_html__('Extra Widget Area', 'sydney'),
		'utm_content' => 'card_extra_widget_area',
		'desc'       => esc_html__('One more widget area for content beyond the sidebar and footer.', 'sydney'),
		'link_label' => esc_html__('Customize', 'sydney'),
		'link_url'   => add_query_arg('autofocus[section]', 'sydney_extra_widget_area', admin_url('customize.php')),
	);
	

	$settings['features'][] = array(
		'type'       => 'pro',
		'title'      => esc_html__('Hooks', 'sydney'),
		'desc'       => esc_html__('Insert your own code or content at hook points across the theme.', 'sydney'),
		'module'     => 'hooks',
		'link_label' => esc_html__('Customize', 'sydney'),
		'link_url'   => add_query_arg('autofocus[panel]', 'sydney_hooks_panel', admin_url('customize.php')),
		'docs_link'  => 'https://docs.athemes.com/article/pro-hooks-system-overview/',
	);

	$settings['features'][] = array(
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
	$settings['pro_link']       = sydney_admin_upgrade_link( 'https://athemes.com/sydney-upgrade', array( 'utm_source' => 'theme_table', 'utm_medium' => 'button', 'utm_campaign' => 'Sydney', 'utm_content' => 'import_modal' ), 'dashboard-pro-link' );

	return $settings;
}
add_filter( 'atss_register_demos_settings', 'sydney_demos_settings' );

