<?php
/**
 * Declarative definition map for the global colors abilities.
 *
 * Loaded by Sydney_Abilities_Colors to build sydney/get-global-colors
 * and sydney/update-global-colors. Each entry describes one color theme_mod:
 * its key, the sanitizer-selecting type, an agent-facing role hint, and the
 * default value. Defaults are literals (deriving at load time breaks under
 * WP_Mock stubs) but are pinned to sydney_get_global_color_defaults() by
 * AbilitiesDefinitionsCanonTest — drift fails CI.
 *
 * @package Sydney
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

return array(
	'global_color_1'       => array(
		'theme_mod' => 'global_color_1',
		'type'      => 'color',
		'role'      => 'primary / accent',
		'default'   => '#d65050',
	),
	'global_color_2'       => array(
		'theme_mod' => 'global_color_2',
		'type'      => 'color',
		'role'      => 'primary hover / accent dark',
		'default'   => '#b73d3d',
	),
	'global_color_3'       => array(
		'theme_mod' => 'global_color_3',
		'type'      => 'color',
		'role'      => 'secondary',
		'default'   => '#233452',
	),
	'global_color_4'       => array(
		'theme_mod' => 'global_color_4',
		'type'      => 'color',
		'role'      => 'headings / dark',
		'default'   => '#00102E',
	),
	'global_color_5'       => array(
		'theme_mod' => 'global_color_5',
		'type'      => 'color',
		'role'      => 'body text',
		'default'   => '#6d7685',
	),
	'global_color_6'       => array(
		'theme_mod' => 'global_color_6',
		'type'      => 'color',
		'role'      => 'body text strong / dark',
		'default'   => '#00102E',
	),
	'global_color_7'       => array(
		'theme_mod' => 'global_color_7',
		'type'      => 'color',
		'role'      => 'light background',
		'default'   => '#F4F5F7',
	),
	'global_color_8'       => array(
		'theme_mod' => 'global_color_8',
		'type'      => 'color',
		'role'      => 'borders / dividers',
		'default'   => '#dbdbdb',
	),
	'global_color_9'       => array(
		'theme_mod' => 'global_color_9',
		'type'      => 'color',
		'role'      => 'white / base background',
		'default'   => '#ffffff',
	),
	'extra_global_color_1' => array(
		'theme_mod' => 'extra_global_color_1',
		'type'      => 'color',
		'role'      => 'extra / custom (renders only if set)',
		'default'   => '',
	),
	'extra_global_color_2' => array(
		'theme_mod' => 'extra_global_color_2',
		'type'      => 'color',
		'role'      => 'extra / custom (renders only if set)',
		'default'   => '',
	),
);
