<?php
/**
 * Declarative definition map for the social-links abilities.
 *
 * Loaded by Sydney_Abilities_Social to build sydney/get-social-links and
 * sydney/update-social-links. Each entry describes one theme_mod: its key,
 * a descriptive type hint (not consumed by this group's execute callbacks),
 * and the default value. Defaults are literals (deriving at load time
 * breaks under WP_Mock stubs) but are pinned to the add_setting()
 * registrations in inc/customizer/options/header.php and
 * inc/customizer/options/footer.php by AbilitiesDefinitionsCanonTest — drift
 * fails CI.
 *
 * @package Sydney
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

return array(
	'header' => array(
		'theme_mod' => 'social_profiles_header',
		'type'      => 'urls',
		'default'   => '',
	),
	'footer' => array(
		'theme_mod' => 'social_profiles_footer',
		'type'      => 'urls',
		'default'   => '',
	),
);
