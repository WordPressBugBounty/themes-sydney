<?php
/**
 * Placeholder page designs.
 *
 * Free designs ship their content in designs/<slug>/. Pro designs are listed
 * here only by name and thumbnail, so free can show them locked; their content
 * lives in inc/pro/modules/coming-soon/templates/ and is supplied through the
 * sydney_coming_soon_design_content filter.
 *
 * @package Sydney
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$sydney_cs_thumbnails = get_template_directory_uri() . '/inc/modules/coming-soon/designs/thumbnails/';

return array(
	'starter'   => array(
		'name'      => __( 'Starter', 'sydney' ),
		'type'      => 'free',
		'thumbnail' => $sydney_cs_thumbnails . 'starter.svg',
	),
	'launch'    => array(
		'name'      => __( 'Launch', 'sydney' ),
		'type'      => 'pro',
		'thumbnail' => $sydney_cs_thumbnails . 'launch.svg',
	),
	'spotlight' => array(
		'name'      => __( 'Spotlight', 'sydney' ),
		'type'      => 'pro',
		'thumbnail' => $sydney_cs_thumbnails . 'spotlight.svg',
	),
	'studio'    => array(
		'name'      => __( 'Studio', 'sydney' ),
		'type'      => 'pro',
		'thumbnail' => $sydney_cs_thumbnails . 'studio.svg',
	),
);
