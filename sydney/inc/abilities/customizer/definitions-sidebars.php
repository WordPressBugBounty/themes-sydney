<?php
/**
 * Declarative definition map for the sidebar-layout abilities.
 *
 * Loaded by Sydney_Abilities_Sidebars to build sydney/get-sidebars and
 * sydney/update-sidebars. Sectioned, not flat: 'archive' pins the one
 * context that is NOT dynamically generated from post types (see
 * context_map()); 'defaults' pins the shared enabled/position fallback every
 * context — archive and each per-post-type pair — falls back to. Defaults
 * are literals (deriving at load time breaks under WP_Mock stubs) but are
 * pinned to inc/customizer/options/blog.php:620-644 (archive) and
 * inc/customizer/options/layouts.php:99-124 (per post type) by
 * AbilitiesDefinitionsCanonTest — drift fails CI. EXCLUDED_POST_TYPES stays a
 * class const on Sydney_Abilities_Sidebars — it is an ability-scope
 * decision, not customizer canon.
 *
 * @package Sydney
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

return array(
	'archive'  => array(
		'enabled_mod'  => 'sidebar_archives',
		'position_mod' => 'sidebar_archives_position',
	),
	'defaults' => array(
		'enabled'  => 1,
		'position' => 'sidebar-right',
	),
);
