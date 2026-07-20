<?php
/**
 * Declarative catalog of Sydney's named typography pairs.
 *
 * Consumed by Sydney_Abilities_Typography for sydney/list-typography-pairs and
 * sydney/apply-typography-pair. Each pair carries a heading + body family and
 * weight, and CSS-fallback category (serif pairs carry 'serif'); applying
 * writes them as the {font,regularweight,category} JSON the
 * sydney_headings_font / sydney_body_font theme_mods expect.
 *
 * DUPLICATION NOTE: mirrors the plugin's client-side catalog at
 * athemes-starter-sites/v2/onboarding/src/data/typography-pairs.js. Keep in sync. Single-source plan: expose the plugin catalog over a
 * filter or JSON file the theme can read once the plugin ships it.
 *
 * @package Sydney
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

return array(
	'system'          => array(
		'name'           => 'Native',
		'label'          => 'System Default',
		// 'System default' is the theme's sentinel: sydney_google_fonts_url()
		// skips it and inc/styles.php substitutes the actual system stack.
		// Never store a raw CSS stack here (esc_attr would mangle its quotes).
		'heading_font'   => 'System default',
		'heading_weight' => '600',
		'heading_category' => 'sans-serif',
		'body_font'      => 'System default',
		'body_weight'    => '400',
		'body_category' => 'sans-serif',
	),
	'default'         => array(
		'name'           => 'Precise',
		'label'          => 'Inter Tight & Inter',
		'heading_font'   => 'Inter Tight',
		'heading_weight' => '600',
		'heading_category' => 'sans-serif',
		'body_font'      => 'Inter',
		'body_weight'    => '400',
		'body_category' => 'sans-serif',
	),
	'classic-elegant' => array(
		'name'           => 'Luxurious',
		'label'          => 'Playfair Display & Source Sans Pro',
		'heading_font'   => 'Playfair Display',
		'heading_weight' => '600',
		'heading_category' => 'serif',
		'body_font'      => 'Source Sans Pro',
		'body_weight'    => '400',
		'body_category' => 'sans-serif',
	),
	'modern-clean'    => array(
		'name'           => 'Futuristic / Clean',
		'label'          => 'Space Grotesk & Inter',
		'heading_font'   => 'Space Grotesk',
		'heading_weight' => '600',
		'heading_category' => 'sans-serif',
		'body_font'      => 'Inter',
		'body_weight'    => '400',
		'body_category' => 'sans-serif',
	),
	'professional'    => array(
		'name'           => 'Institutional',
		'label'          => 'IBM Plex Serif & IBM Plex Sans',
		'heading_font'   => 'IBM Plex Serif',
		'heading_weight' => '600',
		'heading_category' => 'serif',
		'body_font'      => 'IBM Plex Sans',
		'body_weight'    => '400',
		'body_category' => 'sans-serif',
	),
	'creative-bold'   => array(
		'name'           => 'Expressive',
		'label'          => 'Syne & Hanken Grotesk',
		'heading_font'   => 'Syne',
		'heading_weight' => '700',
		'heading_category' => 'sans-serif',
		'body_font'      => 'Hanken Grotesk',
		'body_weight'    => '400',
		'body_category' => 'sans-serif',
	),
	'editorial'       => array(
		'name'           => 'Editorial',
		'label'          => 'Fraunces & Inter',
		'heading_font'   => 'Fraunces',
		'heading_weight' => '600',
		'heading_category' => 'serif',
		'body_font'      => 'Inter',
		'body_weight'    => '400',
		'body_category' => 'sans-serif',
	),
	'minimal-sans'    => array(
		'name'           => 'Calm / Minimal',
		'label'          => 'Work Sans',
		'heading_font'   => 'Work Sans',
		'heading_weight' => '600',
		'heading_category' => 'sans-serif',
		'body_font'      => 'Work Sans',
		'body_weight'    => '400',
		'body_category' => 'sans-serif',
	),
);
