<?php
/**
 * Register panels and sections for all public CPTs
 *
 * @package Sydney
 */

//Get post types (capability-filtered: viewable + has_archive, dedicated panels excluded)
$post_types = sydney_get_customizer_post_types();

//Register panels and sections
foreach ( $post_types as $current_post_type ) {

	//Panel
	$wp_customize->add_panel(
		'sydney_panel_cpt_' . $current_post_type->name,
		array(
			'title'     => $current_post_type->label,
			'priority'  => 50,
		)
	);

	//Singles section
	$wp_customize->add_section(
		'sydney_cpt_' . $current_post_type->name,
		array(
			'title'     => __( 'Singles', 'sydney' ),
			'panel'     => 'sydney_panel_cpt_' . $current_post_type->name,
		)
	);

	//Archives section
	$wp_customize->add_section(
		'sydney_cpt_' . $current_post_type->name . '_archives',
		array(
			'title'     => __( 'Archives', 'sydney' ),
			'panel'     => 'sydney_panel_cpt_' . $current_post_type->name,
		)
	);
}