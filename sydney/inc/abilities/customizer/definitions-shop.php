<?php
/**
 * Declarative definition map for the WooCommerce shop abilities.
 *
 * Loaded by Sydney_Abilities_Shop to build sydney/get-shop and
 * sydney/update-shop. Each entry describes one theme_mod: its key, a
 * descriptive type hint (not consumed by this group's execute callbacks),
 * and the default value. Defaults are literals (deriving at load time
 * breaks under WP_Mock stubs) but are pinned to the add_setting()
 * registrations in inc/customizer/options/woocommerce.php by
 * AbilitiesDefinitionsCanonTest — drift fails CI. Defaults are the literal
 * stored values (e.g. 'product-grid'), not the ability's friendlier
 * caller-facing values (e.g. 'grid') — the caller-facing <-> stored-value
 * translation tables (Sydney_Abilities_Shop::LAYOUTS, ::SIDEBARS, ::ELEMENTS)
 * stay class consts, same as the colors precedent for validation allowlists.
 *
 * @package Sydney
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

return array(
	'layout'             => array(
		'theme_mod' => 'shop_archive_layout',
		'type'      => 'enum',
		'default'   => 'product-grid',
	),
	'sidebar'            => array(
		'theme_mod' => 'shop_archive_sidebar',
		'type'      => 'enum',
		'default'   => 'sidebar-left',
	),
	'card_style'         => array(
		'theme_mod' => 'shop_product_card_style',
		'type'      => 'enum',
		'default'   => 'layout1',
	),
	'card_elements'      => array(
		'theme_mod' => 'shop_card_elements',
		'type'      => 'multi-enum',
		'default'   => array( 'woocommerce_template_loop_product_title', 'woocommerce_template_loop_rating', 'woocommerce_template_loop_price' ),
	),
	'card_alignment'     => array(
		'theme_mod' => 'swc_loop_product_alignment',
		'type'      => 'enum',
		'default'   => 'center',
	),
	'add_to_cart_layout' => array(
		'theme_mod' => 'shop_product_add_to_cart_layout',
		'type'      => 'enum',
		'default'   => 'layout2',
	),
);
