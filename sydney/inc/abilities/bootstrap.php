<?php
/**
 * Bootstrap for the Sydney abilities system.
 *
 * Loaded from functions.php. Returns early unless the dashboard master toggle
 * is on AND the Abilities API is available (core 6.9+ or a polyfill such as
 * WP Vibe). Registers the Sydney category and abilities on both the
 * pre-6.9 and 6.9+ core action names — everything else (group files, the
 * customizer sanitizers) is loaded lazily by the registry when the Abilities
 * API actually initializes. Finally it exposes Sydney's two gating
 * decisions to the multi-theme athemes-starter-sites plugin via cross-repo
 * filters (see docs/adr/0003-starter-sites-abilities-gating.md); harmless when
 * the plugin is absent.
 *
 * @package Sydney
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

require_once get_template_directory() . '/inc/abilities/class-sydney-abilities.php';

// Master switch — registers nothing when off.
if ( ! Sydney_Abilities::is_enabled() ) {
	return;
}

// Abilities API not present (pre-6.9 and no WP Vibe polyfill).
if ( ! function_exists( 'wp_register_ability' ) ) {
	return;
}

// The registry is the single loader for the abilities system: its
// load_groups() requires the core classes and every group file when the
// Abilities API initializes, so nothing else is paid for up front.
require_once get_template_directory() . '/inc/abilities/class-sydney-abilities-registry.php';

// Register the Sydney category on both the pre-6.9 and 6.9+ core hook names.
add_action( 'abilities_api_categories_init', array( 'Sydney_Abilities_Registry', 'register_categories' ) );
add_action( 'wp_abilities_api_categories_init', array( 'Sydney_Abilities_Registry', 'register_categories' ) );

// Register abilities on both the pre-6.9 and 6.9+ core hook names.
add_action( 'abilities_api_init', array( 'Sydney_Abilities_Registry', 'register_abilities' ) );
add_action( 'wp_abilities_api_init', array( 'Sydney_Abilities_Registry', 'register_abilities' ) );

// Let the athemes-starter-sites plugin (multi-theme) gate its own abilities on Sydney's toggles. Harmless when the plugin is absent.
add_filter( 'atss_abilities_enabled', array( 'Sydney_Abilities', 'is_enabled' ) );
add_filter( 'atss_abilities_allow_writes', array( 'Sydney_Abilities', 'writes_enabled' ) );
