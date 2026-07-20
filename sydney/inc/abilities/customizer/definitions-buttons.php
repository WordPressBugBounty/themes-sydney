<?php
/**
 * Declarative definition map for the button styles abilities.
 *
 * Consumed by Sydney_Abilities_Buttons to build sydney/get-button-styles and
 * sydney/update-button-styles from the theme's Buttons customizer section
 * (sydney_section_buttons). Three sections:
 *  - colors: each slot pairs a literal theme_mod with its global_* companion.
 *            Writing a literal also clears the companion so the literal renders
 *            (resolve_global_color_mod() treats a connected global as authoritative).
 *  - sizes:  responsive groups; the agent sends {desktop,tablet,mobile} and the
 *            callback fans it out (absint) onto the three flat theme_mods in `keys`.
 *  - radius: a single (non-responsive) scalar theme_mod.
 *
 * Defaults mirror the add_setting() registration defaults in
 * inc/customizer/options/general.php.
 *
 * @package Sydney
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

return array(

	'colors' => array(
		'background'       => array(
			'theme_mod'  => 'button_background_color',
			'global_mod' => 'global_button_background_color',
			'type'       => 'color',
			'role'       => 'default background',
			'default'    => '',
		),
		'text'             => array(
			'theme_mod'  => 'button_color',
			'global_mod' => 'global_button_color',
			'type'       => 'color',
			'role'       => 'default text',
			'default'    => '',
		),
		'border'           => array(
			'theme_mod'  => 'button_border_color',
			'global_mod' => 'global_button_border_color',
			'type'       => 'color',
			'role'       => 'default border',
			'default'    => '',
		),
		'background_hover' => array(
			'theme_mod'  => 'button_background_color_hover',
			'global_mod' => 'global_button_background_color_hover',
			'type'       => 'color',
			'role'       => 'hover background',
			'default'    => '',
		),
		'text_hover'       => array(
			'theme_mod'  => 'button_color_hover',
			'global_mod' => 'global_button_color_hover',
			'type'       => 'color',
			'role'       => 'hover text',
			'default'    => '',
		),
		'border_hover'     => array(
			'theme_mod'  => 'button_border_color_hover',
			'global_mod' => 'global_button_border_color_hover',
			'type'       => 'color',
			'role'       => 'hover border',
			'default'    => '',
		),
	),

	'sizes'  => array(
		'top_bottom_padding' => array(
			'type'     => 'int-responsive',
			'keys'     => array(
				'desktop' => 'button_top_bottom_padding_desktop',
				'tablet'  => 'button_top_bottom_padding_tablet',
				'mobile'  => 'button_top_bottom_padding_mobile',
			),
			'defaults' => array(
				'desktop' => 12,
				'tablet'  => 12,
				'mobile'  => 12,
			),
		),
		'left_right_padding' => array(
			'type'     => 'int-responsive',
			'keys'     => array(
				'desktop' => 'button_left_right_padding_desktop',
				'tablet'  => 'button_left_right_padding_tablet',
				'mobile'  => 'button_left_right_padding_mobile',
			),
			'defaults' => array(
				'desktop' => 35,
				'tablet'  => 35,
				'mobile'  => 35,
			),
		),
		'font_size'          => array(
			'type'     => 'int-responsive',
			'keys'     => array(
				'desktop' => 'button_font_size_desktop',
				'tablet'  => 'button_font_size_tablet',
				'mobile'  => 'button_font_size_mobile',
			),
			'defaults' => array(
				'desktop' => 13,
				'tablet'  => 13,
				'mobile'  => 13,
			),
		),
	),

	'radius' => array(
		'theme_mod' => 'buttons_radius',
		'type'      => 'int',
		'default'   => 3,
	),
);
