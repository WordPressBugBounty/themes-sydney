<?php
/**
 * Declarative definition map for the typography abilities.
 *
 * Loaded by Sydney_Abilities_Typography to build sydney/get-typography and
 * sydney/update-typography. Three sections:
 *  - fonts:  JSON theme_mods (sydney_google_fonts_sanitize).
 *  - extras: scalar theme_mods. enum entries are validated against `enum`;
 *            number entries are stored via sydney_sanitize_text (strings).
 *  - sizes:  responsive groups; the agent sends {desktop,tablet,mobile} and
 *            the group fans it out (absint) onto the three flat theme_mods
 *            named in each group's `keys`.
 *
 * @package Sydney
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

return array(

	'fonts'  => array(
		'body'     => array(
			'theme_mod' => 'sydney_body_font',
			'type'      => 'font-json',
			'default'   => '{"font":"System default","regularweight":"regular","category":"sans-serif"}',
		),
		'headings' => array(
			'theme_mod' => 'sydney_headings_font',
			'type'      => 'font-json',
			'default'   => '{"font":"System default","regularweight":"bold","category":"sans-serif"}',
		),
	),

	'extras' => array(
		// Body extras.
		'body_font_style'          => array(
			'theme_mod' => 'body_font_style',
			'type'      => 'enum',
			'enum'      => array( 'normal', 'italic', 'oblique' ),
			'default'   => 'normal',
		),
		'body_line_height'         => array(
			'theme_mod' => 'body_line_height',
			'type'      => 'number',
			'default'   => 1.7,
		),
		'body_letter_spacing'      => array(
			'theme_mod' => 'body_letter_spacing',
			'type'      => 'number',
			'default'   => 0,
		),
		'body_text_transform'      => array(
			'theme_mod' => 'body_text_transform',
			'type'      => 'enum',
			'enum'      => array( 'none', 'capitalize', 'lowercase', 'uppercase' ),
			'default'   => 'none',
		),
		'body_text_decoration'     => array(
			'theme_mod' => 'body_text_decoration',
			'type'      => 'enum',
			'enum'      => array( 'none', 'underline', 'line-through' ),
			'default'   => 'none',
		),
		// Headings extras.
		'headings_font_style'      => array(
			'theme_mod' => 'headings_font_style',
			'type'      => 'enum',
			'enum'      => array( 'normal', 'italic', 'oblique' ),
			'default'   => 'normal',
		),
		'headings_line_height'     => array(
			'theme_mod' => 'headings_line_height',
			'type'      => 'number',
			'default'   => 1.2,
		),
		'headings_letter_spacing'  => array(
			'theme_mod' => 'headings_letter_spacing',
			'type'      => 'number',
			'default'   => 0,
		),
		'headings_text_transform'  => array(
			'theme_mod' => 'headings_text_transform',
			'type'      => 'enum',
			'enum'      => array( 'none', 'capitalize', 'lowercase', 'uppercase' ),
			'default'   => 'none',
		),
		'headings_text_decoration' => array(
			'theme_mod' => 'headings_text_decoration',
			'type'      => 'enum',
			'enum'      => array( 'none', 'underline', 'line-through' ),
			'default'   => 'none',
		),
	),

	'sizes'  => array(
		'body' => array(
			'type'     => 'int-responsive',
			'keys'     => array(
				'desktop' => 'body_font_size_desktop',
				'tablet'  => 'body_font_size_tablet',
				'mobile'  => 'body_font_size_mobile',
			),
			'defaults' => array( 'desktop' => 16, 'tablet' => 16, 'mobile' => 16 ),
		),
		'h1'   => array(
			'type'     => 'int-responsive',
			'keys'     => array(
				'desktop' => 'h1_font_size_desktop',
				'tablet'  => 'h1_font_size_tablet',
				'mobile'  => 'h1_font_size_mobile',
			),
			'defaults' => array( 'desktop' => 48, 'tablet' => 42, 'mobile' => 32 ),
		),
		'h2'   => array(
			'type'     => 'int-responsive',
			'keys'     => array(
				'desktop' => 'h2_font_size_desktop',
				'tablet'  => 'h2_font_size_tablet',
				'mobile'  => 'h2_font_size_mobile',
			),
			'defaults' => array( 'desktop' => 38, 'tablet' => 32, 'mobile' => 24 ),
		),
		'h3'   => array(
			'type'     => 'int-responsive',
			'keys'     => array(
				'desktop' => 'h3_font_size_desktop',
				'tablet'  => 'h3_font_size_tablet',
				'mobile'  => 'h3_font_size_mobile',
			),
			'defaults' => array( 'desktop' => 32, 'tablet' => 24, 'mobile' => 20 ),
		),
		'h4'   => array(
			'type'     => 'int-responsive',
			'keys'     => array(
				'desktop' => 'h4_font_size_desktop',
				'tablet'  => 'h4_font_size_tablet',
				'mobile'  => 'h4_font_size_mobile',
			),
			'defaults' => array( 'desktop' => 24, 'tablet' => 18, 'mobile' => 16 ),
		),
		'h5'   => array(
			'type'     => 'int-responsive',
			'keys'     => array(
				'desktop' => 'h5_font_size_desktop',
				'tablet'  => 'h5_font_size_tablet',
				'mobile'  => 'h5_font_size_mobile',
			),
			'defaults' => array( 'desktop' => 18, 'tablet' => 16, 'mobile' => 16 ),
		),
		'h6'   => array(
			'type'     => 'int-responsive',
			'keys'     => array(
				'desktop' => 'h6_font_size_desktop',
				'tablet'  => 'h6_font_size_tablet',
				'mobile'  => 'h6_font_size_mobile',
			),
			'defaults' => array( 'desktop' => 16, 'tablet' => 16, 'mobile' => 16 ),
		),
	),
);
