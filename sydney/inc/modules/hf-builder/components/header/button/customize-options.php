<?php
/**
 * Header/Footer Builder
 * Button Component
 * 
 * @package Sydney_Pro
 */

// @codingStandardsIgnoreStart WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

// List of options we'll need to move.
$opts_to_move = array(
    'general' => array(
        'header_button_text',
        'header_button_link',
        'header_button_class',
        'header_button_newtab'
    ),
    'style'   => array()
);

$wp_customize->add_section(
    new Sydney_Section_Hidden(
        $wp_customize,
        'sydney_section_hb_component__button',
        array(
            'title'      => esc_html__( 'Button', 'sydney' ),
            'panel'      => 'sydney_panel_header'
        )
    )
);

$wp_customize->add_setting(
    'sydney_section_hb_component__button_tabs',
    array(
        'default'           => '',
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control(
    new Sydney_Tab_Control (
        $wp_customize,
        'sydney_section_hb_component__button_tabs',
        array(
            'label' 				=> '',
            'section'       		=> 'sydney_section_hb_component__button',
            'controls_general'		=> wp_json_encode(
                array_merge(
                    array(
                        '#customize-control-shfb_button_visibility'
                    ),  
                    array_map( function( $name ){ return "#customize-control-$name"; }, $opts_to_move[ 'general' ] )
                )
            ),
            'controls_design'		=> wp_json_encode(
                array_merge(
                    array(
                        '#customize-control-shfb_button_default_state_title',
                        '#customize-control-shfb_button_background',
                        '#customize-control-shfb_button',
                        '#customize-control-shfb_button_border',

			            // Sticky State
			            '#customize-control-shfb_button_sticky_title',
                        '#customize-control-shfb_button_sticky_background',
                        '#customize-control-shfb_button_sticky',
                        '#customize-control-shfb_button_sticky_border',
                        '#customize-control-shfb_button_layout_title',
                        '#customize-control-shfb_button_padding',
                        '#customize-control-shfb_button_margin'
                    ),
                    array_map( function( $name ){ return "#customize-control-$name"; }, $opts_to_move[ 'style' ] )
                )
            ),
            'priority' 				=> 10
        )
    )
);

/**
 * Layout (Tab Content)
 * 
 */

// Visibility
$wp_customize->add_setting( 
    'shfb_button_visibility_desktop',
    array(
        'default' 			=> 'visible',
        'sanitize_callback' => 'sydney_sanitize_text',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_setting( 
    'shfb_button_visibility_tablet',
    array(
        'default' 			=> 'visible',
        'sanitize_callback' => 'sydney_sanitize_text',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_setting( 
    'shfb_button_visibility_mobile',
    array(
        'default' 			=> 'visible',
        'sanitize_callback' => 'sydney_sanitize_text',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control( 
    new Sydney_Radio_Buttons( 
        $wp_customize, 
        'shfb_button_visibility',
        array(
            'label'         => esc_html__( 'Visibility', 'sydney' ),
            'section'       => 'sydney_section_hb_component__button',
            'is_responsive' => true,
            'settings' => array(
                'desktop' 		=> 'shfb_button_visibility_desktop',
                'tablet' 		=> 'shfb_button_visibility_tablet',
                'mobile' 		=> 'shfb_button_visibility_mobile'
            ),
            'choices'       => array(
                'visible' => esc_html__( 'Visible', 'sydney' ),
                'hidden'  => esc_html__( 'Hidden', 'sydney' )
            ),
            'priority'      => 30
        )
    ) 
);

// Move existing options.
$priority = 20;
foreach( $opts_to_move as $control_tabs ) {
    foreach( $control_tabs as $option_name ) {

        if( $wp_customize->get_control( $option_name ) === NULL ) {
            continue;
        }
        
        $wp_customize->get_control( $option_name )->section  = 'sydney_section_hb_component__button';
        $wp_customize->get_control( $option_name )->priority = $priority;
        $wp_customize->get_control( $option_name )->active_callback  = function(){};
        
        $priority++;
    }
}

if ( $wp_customize->get_setting( 'header_button_text' ) !== NULL ) {
    $wp_customize->get_setting( 'header_button_text' )->transport = 'refresh';
}
if ( $wp_customize->get_setting( 'header_button_link' ) !== NULL ) {
    $wp_customize->get_setting( 'header_button_link' )->transport = 'refresh';
}

/**
 * Design (Tab Content)
 * 
 */

// Default State Title.
$wp_customize->add_setting( 'shfb_button_default_state_title',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'esc_attr'
	)
);
$wp_customize->add_control( new Sydney_Text_Control( $wp_customize, 'shfb_button_default_state_title',
		array(
			'label'    => esc_html__( 'Default state', 'sydney' ),
			'section'  => 'sydney_section_hb_component__button',
            'priority' => 30
		)
	)
);

// Background Color.
$wp_customize->add_setting(
	'shfb_button_background_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'sydney_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_setting(
	'shfb_button_background_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'sydney_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
    new Sydney_Color_Group(
        $wp_customize,
        'shfb_button_background',
        array(
            'label'    => esc_html__( 'Background Color', 'sydney' ),
            'section'  => 'sydney_section_hb_component__button',
            'settings' => array(
                'normal' => 'shfb_button_background_color',
                'hover'  => 'shfb_button_background_color_hover',
            ),
            'priority' => 31
        )
    )
);

// Text Color.
$wp_customize->add_setting(
	'shfb_button_color',
	array(
		'default'           => '#FFF',
		'sanitize_callback' => 'sydney_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);

// Background Color Hover.
$wp_customize->add_setting(
	'shfb_button_color_hover',
	array(
		'default'           => '#FFF',
		'sanitize_callback' => 'sydney_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
    new Sydney_Color_Group(
        $wp_customize,
        'shfb_button',
        array(
            'label'    => esc_html__( 'Button Color', 'sydney' ),
            'section'  => 'sydney_section_hb_component__button',
            'settings' => array(
                'normal' => 'shfb_button_color',
                'hover'  => 'shfb_button_color_hover',
            ),
            'priority' => 32
        )
    )
);

// Border Color.
$wp_customize->add_setting(
	'shfb_button_border_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'sydney_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_setting(
	'shfb_button_border_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'sydney_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
    new Sydney_Color_Group(
        $wp_customize,
        'shfb_button_border',
        array(
            'label'    => esc_html__( 'Border Color', 'sydney' ),
            'section'  => 'sydney_section_hb_component__button',
            'settings' => array(
                'normal' => 'shfb_button_border_color',
                'hover'  => 'shfb_button_border_color_hover',
            ),
            'priority' => 33
        )
    )
);

// Sticky Header - Title
$wp_customize->add_setting( 
    'shfb_button_sticky_title',
    array(
        'default' 			=> '',
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control( 
    new Sydney_Text_Control( 
        $wp_customize, 
        'shfb_button_sticky_title',
        array(
            'label'			  => esc_html__( 'Sticky Mode', 'sydney' ),
            'section' 		  => 'sydney_section_hb_component__button',
            'active_callback' => 'sydney_callback_sticky_header',
            'priority'	 	  => 67
        )
    )
);

// Sticky Header - Background Color.
$wp_customize->add_setting(
	'shfb_button_sticky_background_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'sydney_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_setting(
	'shfb_button_sticky_background_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'sydney_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
    new Sydney_Color_Group(
        $wp_customize,
        'shfb_button_sticky_background',
        array(
            'label'    => esc_html__( 'Background Color', 'sydney' ),
            'section'  => 'sydney_section_hb_component__button',
            'settings' => array(
                'normal' => 'shfb_button_sticky_background_color',
                'hover'  => 'shfb_button_sticky_background_color_hover',
            ),
			'active_callback' => 'sydney_callback_sticky_header',
            'priority' => 68
        )
    )
);

// Sticky Header - Text Color.
$wp_customize->add_setting(
	'shfb_button_sticky_color',
	array(
		'default'           => '#FFF',
		'sanitize_callback' => 'sydney_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_setting(
	'shfb_button_sticky_color_hover',
	array(
		'default'           => '#FFF',
		'sanitize_callback' => 'sydney_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
    new Sydney_Color_Group(
        $wp_customize,
        'shfb_button_sticky',
        array(
            'label'    => esc_html__( 'Text Color', 'sydney' ),
            'section'  => 'sydney_section_hb_component__button',
            'settings' => array(
                'normal' => 'shfb_button_sticky_color',
                'hover'  => 'shfb_button_sticky_color_hover',
            ),
			'active_callback' => 'sydney_callback_sticky_header',
            'priority' => 69
        )
    )
);


// Sticky Header - Border Color.
$wp_customize->add_setting(
	'shfb_button_sticky_border_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'sydney_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_setting(
	'shfb_button_sticky_border_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'sydney_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
    new Sydney_Color_Group(
        $wp_customize,
        'shfb_button_sticky_border',
        array(
            'label'    => esc_html__( 'Border Color', 'sydney' ),
            'section'  => 'sydney_section_hb_component__button',
            'settings' => array(
                'normal' => 'shfb_button_sticky_border_color',
                'hover'  => 'shfb_button_sticky_border_color_hover',
            ),
			'active_callback' => 'sydney_callback_sticky_header',
            'priority' => 70
        )
    )
);

// Layout Title
$wp_customize->add_setting(
    'shfb_button_layout_title',
    array(
        'default'           => '',
        'sanitize_callback' => 'esc_attr'
    )
);

$wp_customize->add_control(
    new Sydney_Text_Control(
        $wp_customize,
        'shfb_button_layout_title',
        array(
            'label'    => esc_html__( 'Layout', 'sydney' ),
            'section'  => 'sydney_section_hb_component__button',
            'priority' => 70,
            'separator' => 'before'
        )
    )
);

// Padding
$wp_customize->add_setting( 
    'shfb_button_padding_desktop',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'sydney_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_setting( 
    'shfb_button_padding_tablet',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'sydney_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_setting( 
    'shfb_button_padding_mobile',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'sydney_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_control( 
    new Sydney_Dimensions_Control( 
        $wp_customize, 
        'shfb_button_padding',
        array(
            'label'           	=> __( 'Wrapper Padding', 'sydney' ),
            'section'         	=> 'sydney_section_hb_component__button',
            'sides'             => array(
                'top'    => true,
                'right'  => true,
                'bottom' => true,
                'left'   => true
            ),
            'units'              => array( 'px', '%', 'rem', 'em', 'vw', 'vh' ),
            'link_values_toggle' => true,
            'is_responsive'   	 => true,
            'settings'        	 => array(
                'desktop' => 'shfb_button_padding_desktop',
                'tablet'  => 'shfb_button_padding_tablet',
                'mobile'  => 'shfb_button_padding_mobile'
            ),
            'priority'	      	 => 72
        )
    )
);

// Margin
$wp_customize->add_setting( 
    'shfb_button_margin_desktop',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'sydney_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_setting( 
    'shfb_button_margin_tablet',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'sydney_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_setting( 
    'shfb_button_margin_mobile',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'sydney_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_control( 
    new Sydney_Dimensions_Control( 
        $wp_customize, 
        'shfb_button_margin',
        array(
            'label'           	=> __( 'Wrapper Margin', 'sydney' ),
            'section'         	=> 'sydney_section_hb_component__button',
            'sides'             => array(
                'top'    => true,
                'right'  => true,
                'bottom' => true,
                'left'   => true
            ),
            'units'              => array( 'px', '%', 'rem', 'em', 'vw', 'vh' ),
            'link_values_toggle' => true,
            'is_responsive'   	 => true,
            'settings'        	 => array(
                'desktop' => 'shfb_button_margin_desktop',
                'tablet'  => 'shfb_button_margin_tablet',
                'mobile'  => 'shfb_button_margin_mobile'
            ),
            'priority'	      	 => 72
        )
    )
);

// @codingStandardsIgnoreEnd WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound