<?php
/**
 * Declarative definition map for the front-page hero abilities.
 *
 * Loaded by Sydney_Abilities_Hero to build sydney/get-hero and
 * sydney/update-hero. Each entry describes one theme_mod: its key, a
 * descriptive type hint (not consumed by this group's execute callbacks),
 * and the default value. Defaults are literals (deriving at load time
 * breaks under WP_Mock stubs) but are pinned to the canonical registrations
 * by AbilitiesDefinitionsCanonTest — drift fails CI.
 *
 * Notes:
 *  - site_type's default 'nothing' is the HF-builder-active branch
 *    (inc/customizer/options/hero-area.php:26-32); legacy sites (HF builder
 *    inactive) register 'image' instead.
 *  - overlay_hidden has no registered add_setting() default (see
 *    inc/customizer/customizer.php:479-484); '' is the get_theme_mod()
 *    fallback convention used at the call site.
 *  - header_height and overlay_hidden are read-only in the ability — no
 *    write path exists for them.
 *
 * @package Sydney
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

return array(
	'front_page_type' => array(
		'theme_mod' => 'front_header_type',
		'type'      => 'enum',
		'default'   => 'nothing',
	),
	'site_type'       => array(
		'theme_mod' => 'site_header_type',
		'type'      => 'enum',
		'default'   => 'nothing',
	),
	'header_height'   => array(
		'theme_mod' => 'header_height',
		'type'      => 'int',
		'default'   => '300',
	),
	'overlay_hidden'  => array(
		'theme_mod' => 'hide_overlay',
		'type'      => 'checkbox',
		'default'   => '',
	),
);
