<?php
/**
 * Declarative catalog of Sydney's named global-color palettes.
 *
 * Consumed by Sydney_Abilities_Colors for sydney/list-color-palettes and
 * sydney/apply-color-palette. Each palette maps the 9 base global_color slots
 * to hex values; extra_global_color_* are intentionally not part of a palette.
 *
 * DUPLICATION NOTE: these mirror the plugin's client-side catalog at
 * athemes-starter-sites/v2/onboarding/src/data/color-schemes.js
 * (themeColorSchemes.sydney). Keep the two in sync. Single-source plan: expose the plugin catalog
 * over a filter or JSON file the theme can read once the plugin ships it.
 *
 * @package Sydney
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

return array(
	'default'       => array(
		'name'   => 'Default',
		'colors' => array(
			'global_color_1' => '#d65050',
			'global_color_2' => '#b73d3d',
			'global_color_3' => '#233452',
			'global_color_4' => '#00102E',
			'global_color_5' => '#6d7685',
			'global_color_6' => '#00102E',
			'global_color_7' => '#F4F5F7',
			'global_color_8' => '#dbdbdb',
			'global_color_9' => '#ffffff',
		),
	),
	'vibrant-blue'  => array(
		'name'   => 'Vibrant Blue',
		'colors' => array(
			'global_color_1' => '#2563eb',
			'global_color_2' => '#1d4ed8',
			'global_color_3' => '#334155',
			'global_color_4' => '#0f172a',
			'global_color_5' => '#64748b',
			'global_color_6' => '#1e293b',
			'global_color_7' => '#f8fafc',
			'global_color_8' => '#e2e8f0',
			'global_color_9' => '#ffffff',
		),
	),
	'sunset-warmth' => array(
		'name'   => 'Sunset Warmth',
		'colors' => array(
			'global_color_1' => '#f97316',
			'global_color_2' => '#ea580c',
			'global_color_3' => '#44403c',
			'global_color_4' => '#1c1917',
			'global_color_5' => '#78716c',
			'global_color_6' => '#292524',
			'global_color_7' => '#fafaf9',
			'global_color_8' => '#e7e5e4',
			'global_color_9' => '#ffffff',
		),
	),
	'forest-green'  => array(
		'name'   => 'Forest Green',
		'colors' => array(
			'global_color_1' => '#16a34a',
			'global_color_2' => '#15803d',
			'global_color_3' => '#3f3f46',
			'global_color_4' => '#18181b',
			'global_color_5' => '#71717a',
			'global_color_6' => '#27272a',
			'global_color_7' => '#fafafa',
			'global_color_8' => '#e4e4e7',
			'global_color_9' => '#ffffff',
		),
	),
	'royal-purple'  => array(
		'name'   => 'Royal Purple',
		'colors' => array(
			'global_color_1' => '#9333ea',
			'global_color_2' => '#7e22ce',
			'global_color_3' => '#3f3f46',
			'global_color_4' => '#18181b',
			'global_color_5' => '#71717a',
			'global_color_6' => '#27272a',
			'global_color_7' => '#fafafa',
			'global_color_8' => '#e4e4e7',
			'global_color_9' => '#ffffff',
		),
	),
	'crimson-red'   => array(
		'name'   => 'Crimson Red',
		'colors' => array(
			'global_color_1' => '#dc2626',
			'global_color_2' => '#b91c1c',
			'global_color_3' => '#374151',
			'global_color_4' => '#111827',
			'global_color_5' => '#6b7280',
			'global_color_6' => '#1f2937',
			'global_color_7' => '#f9fafb',
			'global_color_8' => '#e5e7eb',
			'global_color_9' => '#ffffff',
		),
	),
	'teal-aqua'     => array(
		'name'   => 'Teal Aqua',
		'colors' => array(
			'global_color_1' => '#14b8a6',
			'global_color_2' => '#0d9488',
			'global_color_3' => '#334155',
			'global_color_4' => '#0f172a',
			'global_color_5' => '#64748b',
			'global_color_6' => '#1e293b',
			'global_color_7' => '#f8fafc',
			'global_color_8' => '#e2e8f0',
			'global_color_9' => '#ffffff',
		),
	),
);
