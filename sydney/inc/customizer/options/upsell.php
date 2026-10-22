<?php
/**
 * Pro upsell options
 *
 * @package Sydney
 */

/**
 * Main Header
 */
$wp_customize->add_setting( 
    'sydney_upsell_main_header',
	array(
		'default'           => '',
		'sanitize_callback' => 'sydney_sanitize_text',
	)
);

$wp_customize->add_control( 
    new Sydney_Upsell_Message( 
        $wp_customize, 
        'sydney_upsell_main_header',
        array(
            'section'     => 'sydney_section_main_header',
            'description' => __( 'Enhance your header with Sydney Pro!', 'sydney' ),
            'features'    => array(
                __( 'Building headers with Elementor', 'sydney' ),
                __( 'Extra header layouts', 'sydney' ),
                __( 'Top bar', 'sydney' ),
                __( 'Language switcher', 'sydney' ),
                __( 'Page Headers module', 'sydney' ),
                __( 'Elementor mega menu builder', 'sydney' ),
                '<a target="_blank" href="' . esc_url( sydney_admin_upgrade_link( 'https://athemes.com/sydney-upgrade/#features-header', array( 'utm_source' => 'theme_customizer_main_header', 'utm_medium' => 'sydney_customizer', 'utm_campaign' => 'Sydney', 'utm_content' => 'section_features' ), 'customizer-upsell-main-header-features-link' ) ) . '">' . __( '&hellip;and many more premium features', 'sydney' ) . '</a>',
            ),    
            'priority'    => 999,
        )
    ) 
);

/**
 * Mobile Header
 */
$wp_customize->add_setting( 
    'sydney_upsell_mobile_header',
	array(
		'default'           => '',
		'sanitize_callback' => 'sydney_sanitize_text',
	)
);

$wp_customize->add_control( 
    new Sydney_Upsell_Message( 
        $wp_customize, 
        'sydney_upsell_mobile_header',
        array(
            'section'     => 'sydney_section_mobile_header',
            'description' => __( 'Create fully custom, animated mobile headers with Sydney Pro!', 'sydney' ),
            'features'    => array(
                __( 'A mobile-only menu & logo', 'sydney' ),
                __( 'Custom breakpoints', 'sydney' ),
                __( 'Extra mobile header layouts', 'sydney' ),
                __( 'Header builder with Elementor', 'sydney' ),
            ),             
            'priority'    => 999,
            'show_button' => false,
        )
    ) 
);

$wp_customize->add_setting( 
    'sydney_upsell_mobile_header2',
	array(
		'default'           => '',
		'sanitize_callback' => 'sydney_sanitize_text',
	)
);

$wp_customize->add_control( 
    new Sydney_Upsell_Message( 
        $wp_customize, 
        'sydney_upsell_mobile_header2',
        array(
            'section'     => 'sydney_section_mobile_header',
            'intro_text'  => __( '&hellip;and for your offcanvas area:', 'sydney' ),
            'features'    => array(
                __( '6 animated opening effects', 'sydney' ),
                __( '4 menu link animations', 'sydney' ),
                __( 'Customizable background', 'sydney' ),
                __( 'Elementor template rendering', 'sydney' ),
                '<a target="_blank" href="' . esc_url( sydney_admin_upgrade_link( 'https://athemes.com/sydney-upgrade/#features-header', array( 'utm_source' => 'theme_customizer_mobile_header', 'utm_medium' => 'sydney_customizer', 'utm_campaign' => 'Sydney', 'utm_content' => 'section_features' ), 'customizer-upsell-mobile-header-features-link' ) ) . '">' . __( '&hellip;and many more premium features', 'sydney' ) . '</a>',
            ),             
            'priority'    => 999,
            'show_separator' => false,
        )
    ) 
);

/**
 * Footer widgets
 */
$wp_customize->add_setting( 
    'sydney_upsell_footer_widgets',
	array(
		'default'           => '',
		'sanitize_callback' => 'sydney_sanitize_text',
	)
);

$wp_customize->add_control( 
    new Sydney_Upsell_Message( 
        $wp_customize, 
        'sydney_upsell_footer_widgets',
        array(
            'section'     => 'sydney_section_footer_widgets',
            'description' => __( 'Create one-of-a-kind footer designs with Sydney Pro!', 'sydney' ),
            'features'    => array(
                __( 'Elementor footer builder', 'sydney' ),
                __( 'Footer background image', 'sydney' ),
                __( 'Pre-footer area', 'sydney' ),
                __( 'SVG footer separators', 'sydney' ),
                __( 'Reveal animation effect', 'sydney' ),
                '<a target="_blank" href="' . esc_url( sydney_admin_upgrade_link( 'https://athemes.com/sydney-upgrade/#features-footer', array( 'utm_source' => 'theme_customizer_footer_widgets', 'utm_medium' => 'sydney_customizer', 'utm_campaign' => 'Sydney', 'utm_content' => 'section_features' ), 'customizer-upsell-footer-widgets-features-link' ) ) . '">' . __( '&hellip;and many more premium features', 'sydney' ) . '</a>',                
            ),            
            'priority'    => 999,
        )
    ) 
);

/**
 * Footer credits
 */
$wp_customize->add_setting( 
    'sydney_upsell_footer_credits',
	array(
		'default'           => '',
		'sanitize_callback' => 'sydney_sanitize_text',
	)
);

$wp_customize->add_control( 
    new Sydney_Upsell_Message( 
        $wp_customize, 
        'sydney_upsell_footer_credits',
        array(
            'section'     => 'sydney_section_footer_credits',
            'description' => __( 'Create one-of-a-kind footer designs with Sydney Pro!', 'sydney' ),
            'features'    => array(
                __( 'Elementor footer builder', 'sydney' ),
                __( 'Footer background image', 'sydney' ),
                __( 'Pre-footer area', 'sydney' ),
                __( 'SVG footer separators', 'sydney' ),
                __( 'Reveal animation effect', 'sydney' ),
                '<a target="_blank" href="' . esc_url( sydney_admin_upgrade_link( 'https://athemes.com/sydney-upgrade/#features-footer', array( 'utm_source' => 'theme_customizer_footer_credits', 'utm_medium' => 'sydney_customizer', 'utm_campaign' => 'Sydney', 'utm_content' => 'section_features' ), 'customizer-upsell-footer-credits-features-link' ) ) . '">' . __( '&hellip;and many more premium features', 'sydney' ) . '</a>',   
            ), 
            'priority'    => 999,
        )
    ) 
);

/**
 * Blog
 */
$wp_customize->add_setting( 
    'sydney_upsell_blog_archives',
	array(
		'default'           => '',
		'sanitize_callback' => 'sydney_sanitize_text',
	)
);

$wp_customize->add_control( 
    new Sydney_Upsell_Message( 
        $wp_customize, 
        'sydney_upsell_blog_archives',
        array(
            'section'     => 'sydney_section_blog_archives',
            'description' => __( 'Boost your blog’s engagement with Sydney Pro!', 'sydney' ),
            'features'    => array(
                __( 'Premium post header layouts', 'sydney' ),
                __( 'Featured posts area', 'sydney' ),
                __( 'Reading time', 'sydney' ),
                __( 'Progress bar', 'sydney' ),
                __( 'Social sharing buttons', 'sydney' ),
                __( 'Elementor template builder for category pages', 'sydney' ),
                '<a target="_blank" href="' . esc_url( sydney_admin_upgrade_link( 'https://athemes.com/sydney-upgrade/#features-blog', array( 'utm_source' => 'theme_customizer_blog_archives', 'utm_medium' => 'sydney_customizer', 'utm_campaign' => 'Sydney', 'utm_content' => 'section_features' ), 'customizer-upsell-blog-archives-features-link' ) ) . '">' . __( '&hellip;and many more premium features', 'sydney' ) . '</a>',                
            ),
            'priority'    => 999,
        )
    ) 
);

$wp_customize->add_setting( 
    'sydney_upsell_blog_singles',
	array(
		'default'           => '',
		'sanitize_callback' => 'sydney_sanitize_text',
	)
);

$wp_customize->add_control( 
    new Sydney_Upsell_Message( 
        $wp_customize, 
        'sydney_upsell_blog_singles',
        array(
            'section'     => 'sydney_section_blog_singles',
            'description' => __( 'Boost your blog’s engagement with Sydney Pro!', 'sydney' ),
            'features'    => array(
                __( 'Extra post header layouts', 'sydney' ),
                __( 'Reading time', 'sydney' ),
                __( 'Progress bar', 'sydney' ),
                __( 'Last updated date', 'sydney' ),
                __( 'Social sharing buttons', 'sydney' ),
                __( 'Breadcrumbs', 'sydney' ),
                __( 'Elementor template builder for single posts', 'sydney' ),
                '<a target="_blank" href="' . esc_url( sydney_admin_upgrade_link( 'https://athemes.com/sydney-upgrade/#features-blog', array( 'utm_source' => 'theme_customizer_blog_singles', 'utm_medium' => 'sydney_customizer', 'utm_campaign' => 'Sydney', 'utm_content' => 'section_features' ), 'customizer-upsell-blog-singles-features-link' ) ) . '">' . __( '&hellip;and many more premium features', 'sydney' ) . '</a>',                
            ),            
            'priority'    => 999,
        )
    ) 
);

/**
 * Slider
 */
$wp_customize->add_setting( 
    'sydney_upsell_hero_slider',
	array(
		'default'           => '',
		'sanitize_callback' => 'sydney_sanitize_text',
	)
);

$wp_customize->add_control( 
    new Sydney_Upsell_Message( 
        $wp_customize, 
        'sydney_upsell_hero_slider',
        array(
            'section'     => 'sydney_slider',
            'description' => __( 'Create an even more engaging slider with Sydney Pro!', 'sydney' ),
            'features'    => array(
                __( 'Extra styling options', 'sydney' ),
                __( 'A different button for each slide', 'sydney' ),
                __( 'Fade and slide transitions', 'sydney' ),
                __( 'Button and text animations', 'sydney' ),
                __( 'Title tag control', 'sydney' ),
                '<a target="_blank" href="' . esc_url( sydney_admin_upgrade_link( 'https://athemes.com/sydney-upgrade/#features', array( 'utm_source' => 'theme_customizer_hero_slider', 'utm_medium' => 'sydney_customizer', 'utm_campaign' => 'Sydney', 'utm_content' => 'section_features' ), 'customizer-upsell-hero-slider-features-link' ) ) . '">' . __( '&hellip;and many more premium features', 'sydney' ) . '</a>',
            ),             
            'priority'    => 999,
        )
    ) 
);


/**
 * Typography
 */
$wp_customize->add_setting( 
    'sydney_upsell_typography',
	array(
		'default'           => '',
		'sanitize_callback' => 'sydney_sanitize_text',
	)
);

$wp_customize->add_control( 
    new Sydney_Upsell_Message( 
        $wp_customize, 
        'sydney_upsell_typography',
        array(
            'section'     => 'sydney_section_typography_headings',
            'description' => __( 'Get access to more fonts with Sydney Pro!', 'sydney' ),
            'intro_text'  => __( 'Specifically:', 'sydney' ),
            'features'    => array(
                __( 'Adobe Fonts integration', 'sydney' ),
                __( 'An option to upload custom fonts', 'sydney' ),
                '<a target="_blank" href="' . esc_url( sydney_admin_upgrade_link( 'https://athemes.com/sydney-upgrade/#features-general', array( 'utm_source' => 'theme_customizer_typography_headings', 'utm_medium' => 'sydney_customizer', 'utm_campaign' => 'Sydney', 'utm_content' => 'section_features' ), 'customizer-upsell-typography-headings-features-link' ) ) . '">' . __( '&hellip;and many more premium features', 'sydney' ) . '</a>',
            ),             
            'priority'    => 999,
        )
    ) 
);
$wp_customize->add_setting( 
    'sydney_upsell_typography_body',
	array(
		'default'           => '',
		'sanitize_callback' => 'sydney_sanitize_text',
	)
);

$wp_customize->add_control( 
    new Sydney_Upsell_Message( 
        $wp_customize, 
        'sydney_upsell_typography_body',
        array(
            'section'     => 'sydney_section_typography_body',
            'description' => __( 'Get access to more fonts with Sydney Pro!', 'sydney' ),
            'intro_text'  => __( 'Specifically:', 'sydney' ),
            'features'    => array(
                __( 'Adobe Fonts integration', 'sydney' ),
                __( 'An option to upload custom fonts', 'sydney' ),
                '<a target="_blank" href="' . esc_url( sydney_admin_upgrade_link( 'https://athemes.com/sydney-upgrade/#features-general', array( 'utm_source' => 'theme_customizer_typography_body', 'utm_medium' => 'sydney_customizer', 'utm_campaign' => 'Sydney', 'utm_content' => 'section_features' ), 'customizer-upsell-typography-body-features-link' ) ) . '">' . __( '&hellip;and many more premium features', 'sydney' ) . '</a>',
            ),             
            'priority'    => 999,
        )
    ) 
);

/**
 * WooCommerce
 */
if ( class_exists( 'Woocommerce' ) ) {
    $wp_customize->add_setting( 
        'sydney_upsell_shop_catalog',
        array(
            'default'           => '',
            'sanitize_callback' => 'sydney_sanitize_text',
        )
    );

    $wp_customize->add_control( 
        new Sydney_Upsell_Message( 
            $wp_customize, 
            'sydney_upsell_shop_catalog',
            array(
                'section'     => 'woocommerce_product_catalog',
                'description' => __( 'Help shoppers find and pick products faster with Sydney Pro!', 'sydney' ),
                'features'    => array(
                    __( 'Product swatches', 'sydney' ),
                    __( 'AJAX product search', 'sydney' ),
                    __( 'Shop header styles', 'sydney' ),
                    __( 'Quick view', 'sydney' ),
                    __( 'Product card layouts', 'sydney' ),
                ),
                'button_link' => sydney_admin_upgrade_link( 'https://athemes.com/sydney-upgrade', array( 'utm_source' => 'theme_customizer_deep', 'utm_medium' => 'sydney_customizer', 'utm_campaign' => 'Sydney', 'utm_content' => 'shop_catalog_upsell' ), 'customizer-upsell-message-button' ),
                'priority'    => 999,
            )
        ) 
    );

    $wp_customize->add_setting( 
        'sydney_upsell_single_product',
        array(
            'default'           => '',
            'sanitize_callback' => 'sydney_sanitize_text',
        )
    );

    $wp_customize->add_control( 
        new Sydney_Upsell_Message( 
            $wp_customize, 
            'sydney_upsell_single_product',
            array(
                'section'     => 'sydney_section_single_product',
                'description' => __( 'Turn more product views into sales with Sydney Pro!', 'sydney' ),
                'features'    => array(
                    __( 'Sticky add to cart', 'sydney' ),
                    __( 'Product gallery layouts', 'sydney' ),
                    __( 'Product tab styles', 'sydney' ),
                    __( 'Advanced reviews', 'sydney' ),
                ),
                'button_link' => sydney_admin_upgrade_link( 'https://athemes.com/sydney-upgrade', array( 'utm_source' => 'theme_customizer_deep', 'utm_medium' => 'sydney_customizer', 'utm_campaign' => 'Sydney', 'utm_content' => 'shop_single_upsell' ), 'customizer-upsell-message-button' ),
                'priority'    => 999,
            )
        ) 
    );

    $wp_customize->add_setting( 
        'sydney_upsell_shop_checkout',
        array(
            'default'           => '',
            'sanitize_callback' => 'sydney_sanitize_text',
        )
    );

    $wp_customize->add_control( 
        new Sydney_Upsell_Message( 
            $wp_customize, 
            'sydney_upsell_shop_checkout',
            array(
                'section'     => 'woocommerce_checkout',
                'description' => __( 'Multi-step and distraction-free checkout, in Sydney Pro.', 'sydney' ),
                'features'    => array(
                    __( 'Multi-step checkout layout', 'sydney' ),
                    __( 'Distraction-free checkout', 'sydney' ),
                ),
                'button_link' => sydney_admin_upgrade_link( 'https://athemes.com/sydney-upgrade', array( 'utm_source' => 'theme_customizer_deep', 'utm_medium' => 'sydney_customizer', 'utm_campaign' => 'Sydney', 'utm_content' => 'shop_checkout_upsell' ), 'customizer-upsell-message-button' ),
                'priority'    => 999,
            )
        ) 
    );
}
