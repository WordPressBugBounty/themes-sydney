<?php
/**
 * Declarative definition map for the scroll-to-top ability.
 *
 * Loaded by Sydney_Abilities_Scrolltop to build sydney/get-scrolltop and
 * sydney/update-scrolltop. Single-entry map, deliberate: issue #488 chooses
 * uniformity across all seven ability groups plus canon pinning over
 * skipping a map file for a two-field group — this decision is settled, do
 * not revisit. The default is a literal (deriving at load time breaks under
 * WP_Mock stubs) but is pinned to the add_setting() registration in
 * inc/customizer/options/general.php by AbilitiesDefinitionsCanonTest —
 * drift fails CI.
 *
 * @package Sydney
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

return array(
	'enabled' => array(
		'theme_mod' => 'enable_scrolltop',
		'type'      => 'checkbox',
		'default'   => 1,
	),
);
