<?php
/**
 * Header/Footer Builder
 * Header Builder CSS Output
 * 
 * @package Sydney_Pro
 */

// @codingStandardsIgnoreStart WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

// Padding
$css .= Sydney_Custom_CSS::get_responsive_dimensions_css( 
    'sydney_section_fb_wrapper__footer_builder_padding', 
    array(
        'desktop' => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'tablet'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'mobile'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
    ), 
    '.shfb-footer', 
    'padding'
);

// Background Image
$fb_background_image = get_theme_mod( 'sydney_section_fb_wrapper__footer_builder_background_image', '' );
if( $fb_background_image ) {
    $image_url           = wp_get_attachment_image_url( $fb_background_image, 'full' );
    $background_size     = get_theme_mod( 'sydney_section_fb_wrapper__footer_builder_background_size', 'cover' );
    $background_position = get_theme_mod( 'sydney_section_fb_wrapper__footer_builder_background_position', 'center' );
    $background_repeat   = get_theme_mod( 'sydney_section_fb_wrapper__footer_builder_background_repeat', 'no-repeat' );

    $css .= '.shfb-footer { background-image: url(' . esc_url( $image_url ) . '); }';
    $css .= Sydney_Custom_CSS::get_css( 
        'sydney_section_fb_wrapper__footer_builder_background_size', 
        'cover', 
        '.shfb-footer', 
        'background-size', 
        '' 
    );
    $css .= Sydney_Custom_CSS::get_css( 
        'sydney_section_fb_wrapper__footer_builder_background_position', 
        'center', 
        '.shfb-footer', 
        'background-position', 
        '' 
    );
    $css .= Sydney_Custom_CSS::get_css( 
        'sydney_section_fb_wrapper__footer_builder_background_repeat', 
        'no-repeat', 
        '.shfb-footer', 
        'background-repeat', 
        '' 
    );
}

// Background Color
/**
 * Filters the builder footer's background colour default.
 *
 * Pro has shipped '#f5f5f5' here since 2025-04-22; free has rendered no
 * background since the builder landed. Both editions register the control at
 * '#f5f5f5', so free's picker shows grey while the site shows none - but
 * raising free's default would repaint the footer of every existing free site
 * that never touched the setting, so the editions stay split here.
 *
 * @since 1.0.0
 *
 * @param string $default Colour value, or '' for no background.
 */
$css .= Sydney_Custom_CSS::get_background_color_css(
	'sydney_section_fb_wrapper__footer_builder_background_color',
	apply_filters( 'sydney_footer_builder_background_default', '' ),
	'.shfb-footer'
);

// @codingStandardsIgnoreEnd WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound