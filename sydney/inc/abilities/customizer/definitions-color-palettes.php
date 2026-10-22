<?php
/**
 * Declarative catalog of Sydney's named global-color palettes.
 *
 * Consumed by Sydney_Abilities_Colors for sydney/list-color-palettes and
 * sydney/apply-color-palette. Each palette maps the 9 base global_color slots
 * to hex values, and dark_colors maps the same slots to the Dark palette Sydney Pro
 * applies with it. extra_global_color_* are intentionally not part of a palette.
 *
 * DUPLICATION NOTE: these mirror the plugin's client-side catalog at
 * athemes-starter-sites/v2/onboarding/src/data/color-schemes.js
 * (themeColorSchemes.sydney). Keep the two in sync. Single-source plan: expose the plugin catalog
 * over a filter or JSON file the theme can read once the plugin ships it.
 * dark_colors are theme-only: the starter-sites catalog has no dark versions.
 *
 * @package Sydney
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

return array(
	'default'       => array(
		'name'        => 'Default',
		'colors'      => array(
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
		'dark_colors' => array(
			'global_color_1' => '#e96060',
			'global_color_2' => '#f48a8a',
			'global_color_3' => '#c9d1dc',
			'global_color_4' => '#f3f5f8',
			'global_color_5' => '#9aa4b2',
			'global_color_6' => '#0b0f17',
			'global_color_7' => '#1a2130',
			'global_color_8' => '#2c3545',
			'global_color_9' => '#121722',
		),
	),
	'vibrant-blue'  => array(
		'name'        => 'Vibrant Blue',
		'colors'      => array(
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
		'dark_colors' => array(
			'global_color_1' => '#3b82f6',
			'global_color_2' => '#60a5fa',
			'global_color_3' => '#cbd5e1',
			'global_color_4' => '#f1f5f9',
			'global_color_5' => '#94a3b8',
			'global_color_6' => '#020617',
			'global_color_7' => '#1e293b',
			'global_color_8' => '#334155',
			'global_color_9' => '#0f172a',
		),
	),
	'sunset-warmth' => array(
		'name'        => 'Sunset Warmth',
		'colors'      => array(
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
		'dark_colors' => array(
			'global_color_1' => '#ea580c',
			'global_color_2' => '#fb923c',
			'global_color_3' => '#d6d3d1',
			'global_color_4' => '#fafaf9',
			'global_color_5' => '#a8a29e',
			'global_color_6' => '#0c0a09',
			'global_color_7' => '#292524',
			'global_color_8' => '#44403c',
			'global_color_9' => '#1c1917',
		),
	),
	'forest-green'  => array(
		'name'        => 'Forest Green',
		'colors'      => array(
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
		'dark_colors' => array(
			'global_color_1' => '#16a34a',
			'global_color_2' => '#22c55e',
			'global_color_3' => '#d4d4d8',
			'global_color_4' => '#fafafa',
			'global_color_5' => '#a1a1aa',
			'global_color_6' => '#09090b',
			'global_color_7' => '#27272a',
			'global_color_8' => '#3f3f46',
			'global_color_9' => '#18181b',
		),
	),
	'royal-purple'  => array(
		'name'        => 'Royal Purple',
		'colors'      => array(
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
		'dark_colors' => array(
			'global_color_1' => '#ad5ff8',
			'global_color_2' => '#c084fc',
			'global_color_3' => '#d4d4d8',
			'global_color_4' => '#fafafa',
			'global_color_5' => '#a1a1aa',
			'global_color_6' => '#09090b',
			'global_color_7' => '#27272a',
			'global_color_8' => '#3f3f46',
			'global_color_9' => '#18181b',
		),
	),
	'crimson-red'   => array(
		'name'        => 'Crimson Red',
		'colors'      => array(
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
		'dark_colors' => array(
			'global_color_1' => '#ef4444',
			'global_color_2' => '#f87171',
			'global_color_3' => '#d1d5db',
			'global_color_4' => '#f9fafb',
			'global_color_5' => '#9ca3af',
			'global_color_6' => '#030712',
			'global_color_7' => '#1f2937',
			'global_color_8' => '#374151',
			'global_color_9' => '#111827',
		),
	),
	'teal-aqua'     => array(
		'name'        => 'Teal Aqua',
		'colors'      => array(
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
		'dark_colors' => array(
			'global_color_1' => '#0d9488',
			'global_color_2' => '#14b8a6',
			'global_color_3' => '#cbd5e1',
			'global_color_4' => '#f1f5f9',
			'global_color_5' => '#94a3b8',
			'global_color_6' => '#020617',
			'global_color_7' => '#1e293b',
			'global_color_8' => '#334155',
			'global_color_9' => '#0f172a',
		),
	),
);
