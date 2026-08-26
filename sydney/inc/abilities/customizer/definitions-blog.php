<?php
/**
 * Declarative definition map for the blog/archive layout abilities.
 *
 * Loaded by Sydney_Abilities_Blog to build sydney/get-blog-layout and
 * sydney/update-blog-layout. Each entry describes one theme_mod: its key,
 * a descriptive type hint (not consumed by this group's execute callbacks),
 * and the default value. Defaults are literals (deriving at load time breaks
 * under WP_Mock stubs) but are pinned to the add_setting() registrations in
 * inc/customizer/options/blog.php by AbilitiesDefinitionsCanonTest — drift
 * fails CI.
 *
 * Notes:
 *  - columns' default '3' is deliberately a string, not an int: it pins the
 *    exact add_setting() literal for archives_grid_columns, which stores a
 *    radio value as a string.
 *
 * @package Sydney
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

return array(
	'layout'         => array(
		'theme_mod' => 'blog_layout',
		'type'      => 'enum',
		'default'   => 'layout2',
	),
	'columns'        => array(
		'theme_mod' => 'archives_grid_columns',
		'type'      => 'int',
		'default'   => '3',
	),
	'show_content'   => array(
		'theme_mod' => 'show_excerpt',
		'type'      => 'checkbox',
		'default'   => 1,
	),
	'excerpt_length' => array(
		'theme_mod' => 'exc_lenght',
		'type'      => 'int',
		'default'   => 22,
	),
	'read_more_link' => array(
		'theme_mod' => 'read_more_link',
		'type'      => 'checkbox',
		'default'   => 0,
	),
	'meta_elements'  => array(
		'theme_mod' => 'archive_meta_elements',
		'type'      => 'multi-enum',
		'default'   => array( 'post_date', 'post_categories' ),
	),
);
