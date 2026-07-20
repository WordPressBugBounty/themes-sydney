<?php
/**
 * Declarative per-component settings map for the Header/Footer builder abilities.
 *
 * Loaded by Sydney_Abilities_HF to build sydney/get-hf-component-settings
 * and sydney/update-hf-component-settings. Keyed by area ('header'/'footer') then
 * by component id. Each component declares the content/functional settings an agent
 * may read and write.
 *
 * IMPORTANT: each setting carries the LITERAL theme_mod key. Sydney does NOT store
 * every component setting under sydney_section_hb_component__{id}_{setting}_{device}
 * — the visibility key for `logo` does, but `button` uses shfb_button_visibility_*,
 * `secondary_menu` uses secondary_menu_visibility_*, and content settings reuse the
 * legacy "moved from general" keys (header_button_text, footer_credits, etc.). So the
 * write ability NEVER interpolates a key — it looks up the verbatim key here. This
 * preserves "no raw key access": the client supplies values into curated setting
 * names (text/link/visibility/...), and the ability resolves them to real mods.
 *
 * Setting `type` -> write handling (see Sydney_Abilities_Registry):
 *   text             -> sydney_sanitize_text
 *   url              -> esc_url_raw
 *   class            -> esc_attr
 *   checkbox         -> sydney_sanitize_checkbox (returns 1 or '' — never 0)
 *   enum             -> validated against `enum`, stored verbatim
 *   int              -> absint
 *   enum-responsive  -> per-device validated against `enum`, fanned out to `keys`
 *   int-responsive   -> per-device absint, fanned out to `keys`
 *
 * The raw-markup HTML component (header `html`, footer `html`) is intentionally
 * ABSENT from both areas — exposing header_html_content / footer_html_content for
 * writes is an XSS surface. Unknown components (including `html`) are rejected.
 *
 * Coverage cuts: menu *selection* (which nav menu is assigned), the social icon
 * *list* (the repeater of profile URLs), and logo *text / site-title* are
 * intentionally NOT mapped — none has a curated, single writable theme_mod that
 * fits this phase's content/functional model. Their omission is deliberate, not a gap.
 *
 * Visual styling (colors, padding, margin, borders, component typography) is out of
 * scope for this phase and is intentionally NOT mapped.
 *
 * Checkbox defaults use '' (not 0) so each boolean has ONE representation:
 * sydney_sanitize_checkbox returns 1 or '' and never 0. (cart/account default to
 * the theme's real "on" value, 1.)
 *
 * @package Sydney
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Shared visibility enum.
 */
$sydney_hf_visibility_enum = array( 'visible', 'hidden' );

/**
 * Build a standard {visible,hidden} responsive visibility setting from a key prefix.
 *
 * @param string $prefix Theme_mod prefix; the per-device suffix is appended.
 * @return array
 */
$sydney_hf_visibility = function ( $prefix ) use ( $sydney_hf_visibility_enum ) {
	return array(
		'type'     => 'enum-responsive',
		'enum'     => $sydney_hf_visibility_enum,
		'default'  => 'visible',
		'keys'     => array(
			'desktop' => $prefix . '_desktop',
			'tablet'  => $prefix . '_tablet',
			'mobile'  => $prefix . '_mobile',
		),
	);
};

return array(

	'header' => array(

		'logo'           => array(
			'label'    => 'Site Identity',
			'settings' => array(
				'text_alignment' => array(
					'type'     => 'enum-responsive',
					'enum'     => array( 'left', 'center', 'right' ),
					'default'  => 'left',
					'sanitize' => 'sydney_sanitize_text',
					'keys'     => array(
						'desktop' => 'sydney_section_hb_component__logo_text_alignment_desktop',
						'tablet'  => 'sydney_section_hb_component__logo_text_alignment_tablet',
						'mobile'  => 'sydney_section_hb_component__logo_text_alignment_mobile',
					),
				),
				// site_logo_size_* defaults 100 per breakpoint VERIFIED against
				// inc/customizer/options/header.php.
				'size'           => array(
					'type'     => 'int-responsive',
					'defaults' => array(
						'desktop' => 100,
						'tablet'  => 100,
						'mobile'  => 100,
					),
					'keys'     => array(
						'desktop' => 'site_logo_size_desktop',
						'tablet'  => 'site_logo_size_tablet',
						'mobile'  => 'site_logo_size_mobile',
					),
				),
				'visibility'     => $sydney_hf_visibility( 'sydney_section_hb_component__logo_visibility' ),
			),
		),

		'menu'           => array(
			'label'    => 'Primary Menu',
			'settings' => array(
				'visibility' => $sydney_hf_visibility( 'sydney_section_hb_component__menu_visibility' ),
			),
		),

		'secondary_menu' => array(
			'label'    => 'Secondary Menu',
			'settings' => array(
				'visibility' => $sydney_hf_visibility( 'secondary_menu_visibility' ),
			),
		),

		'social'         => array(
			'label'    => 'Social',
			'settings' => array(
				// Header social prefix shfb_social_visibility_* VERIFIED against
				// inc/modules/hf-builder/components/header/social/customize-options.php.
				'visibility' => $sydney_hf_visibility( 'shfb_social_visibility' ),
			),
		),

		'search'         => array(
			'label'    => 'Search',
			'settings' => array(
				'visibility' => $sydney_hf_visibility( 'shfb_search_icon_visibility' ),
			),
		),

		'button'         => array(
			'label'    => 'Button',
			'settings' => array(
				// VERIFIED against inc/customizer/options/header.php: header_button_text
				// default 'Click me' (sydney_sanitize_text), header_button_link default
				// '#' (esc_url_raw). header_button_newtab source default is 0; we store
				// '' deliberately (one boolean representation via sydney_sanitize_checkbox).
				'text'       => array(
					'type'      => 'text',
					'default'   => 'Click me',
					'sanitize'  => 'sydney_sanitize_text',
					'theme_mod' => 'header_button_text',
				),
				'link'       => array(
					'type'      => 'url',
					'default'   => '#',
					'sanitize'  => 'esc_url_raw',
					'theme_mod' => 'header_button_link',
				),
				'class'      => array(
					'type'      => 'class',
					'default'   => '',
					'sanitize'  => 'esc_attr',
					'theme_mod' => 'header_button_class',
				),
				'newtab'     => array(
					'type'      => 'checkbox',
					'default'   => '',
					'sanitize'  => 'sydney_sanitize_checkbox',
					'theme_mod' => 'header_button_newtab',
				),
				'visibility' => $sydney_hf_visibility( 'shfb_button_visibility' ),
			),
		),

		'contact_info'   => array(
			'label'    => 'Contact Info',
			// VERIFIED against inc/customizer/options/header.php: header_contact_mail
			// default 'office@example.org', header_contact_phone default '111222333'.
			// shfb_contact_info_display_inline VERIFIED in the contact-info component.
			'settings' => array(
				'mail'           => array(
					'type'      => 'text',
					'default'   => 'office@example.org',
					'sanitize'  => 'sydney_sanitize_text',
					'theme_mod' => 'header_contact_mail',
				),
				'phone'          => array(
					'type'      => 'text',
					'default'   => '111222333',
					'sanitize'  => 'sydney_sanitize_text',
					'theme_mod' => 'header_contact_phone',
				),
				'display_inline' => array(
					'type'      => 'checkbox',
					'default'   => '',
					'sanitize'  => 'sydney_sanitize_checkbox',
					'theme_mod' => 'shfb_contact_info_display_inline',
				),
				'visibility'     => $sydney_hf_visibility( 'shfb_contact_info_visibility' ),
			),
		),

		'woo_icons'      => array(
			'label'    => 'WooCommerce Icons',
			// VERIFIED against source: enable_header_cart / enable_header_account
			// defaults 1 (inc/customizer/options/header.php), and
			// shfb_woo_icons_space_between_icons_* defaults 25 (wc-icons component).
			'settings' => array(
				'cart'                => array(
					'type'      => 'checkbox',
					'default'   => 1,
					'sanitize'  => 'sydney_sanitize_checkbox',
					'theme_mod' => 'enable_header_cart',
				),
				'account'             => array(
					'type'      => 'checkbox',
					'default'   => 1,
					'sanitize'  => 'sydney_sanitize_checkbox',
					'theme_mod' => 'enable_header_account',
				),
				'title'               => array(
					'type'      => 'text',
					'default'   => '',
					'sanitize'  => 'sydney_sanitize_text',
					'theme_mod' => 'main_header_cart_account_title',
				),
				'space_between_icons' => array(
					'type'     => 'int-responsive',
					'defaults' => array(
						'desktop' => 25,
						'tablet'  => 25,
						'mobile'  => 25,
					),
					'keys'     => array(
						'desktop' => 'shfb_woo_icons_space_between_icons_desktop',
						'tablet'  => 'shfb_woo_icons_space_between_icons_tablet',
						'mobile'  => 'shfb_woo_icons_space_between_icons_mobile',
					),
				),
				'visibility'          => $sydney_hf_visibility( 'shfb_woo_icons_visibility' ),
			),
		),
	),

	'footer' => array(

		'copyright' => array(
			'label'    => 'Copyright',
			'settings' => array(
				// footer_credits has a real template default in the theme (NOT an
				// empty string). Canonical source: sydney_get_footer_credits_default()
				// in inc/extras.php; the literal below is pinned to it by
				// AbilitiesDefinitionsCanonTest — drift fails CI. Sanitize with
				// sydney_sanitize_text (the setting's own sanitize_callback), NOT
				// wp_kses_post.
				'credits'    => array(
					'type'      => 'text',
					/* translators: 1: copyright/year/site-title token string, 2: theme author token. */
					'default'   => sprintf( esc_html__( '%1$1s. Proudly powered by %2$2s', 'sydney' ), '{copyright} {year} {site_title}', '{theme_author}' ),
					'sanitize'  => 'sydney_sanitize_text',
					'theme_mod' => 'footer_credits',
				),
				'visibility' => $sydney_hf_visibility( 'sydney_section_fb_component__copyright_visibility' ),
			),
		),

		'social'    => array(
			'label'    => 'Social',
			'settings' => array(
				// Footer social prefix shfb_footer_social_visibility_* VERIFIED against
				// inc/modules/hf-builder/components/footer/social/customize-options.php.
				'visibility' => $sydney_hf_visibility( 'shfb_footer_social_visibility' ),
			),
		),

		'button'    => array(
			'label'    => 'Button 1',
			'settings' => array(
				'text'       => array(
					'type'      => 'text',
					'default'   => 'Click me',
					'sanitize'  => 'sydney_sanitize_text',
					'theme_mod' => 'shfb_footer_button_text',
				),
				'link'       => array(
					'type'      => 'url',
					'default'   => '#',
					'sanitize'  => 'esc_url_raw',
					'theme_mod' => 'shfb_footer_button_link',
				),
				'class'      => array(
					'type'      => 'class',
					'default'   => '',
					'sanitize'  => 'esc_attr',
					'theme_mod' => 'shfb_footer_button_class',
				),
				'newtab'     => array(
					'type'      => 'checkbox',
					'default'   => '',
					'sanitize'  => 'sydney_sanitize_checkbox',
					'theme_mod' => 'shfb_footer_button_newtab',
				),
				'visibility' => $sydney_hf_visibility( 'shfb_footer_button_visibility' ),
			),
		),

		'widget1'   => array(
			'label'    => 'Widget Area 1',
			'settings' => array(
				'visibility' => $sydney_hf_visibility( 'sydney_section_fb_component__widget1_visibility' ),
			),
		),

		'widget2'   => array(
			'label'    => 'Widget Area 2',
			'settings' => array(
				'visibility' => $sydney_hf_visibility( 'sydney_section_fb_component__widget2_visibility' ),
			),
		),

		'widget3'   => array(
			'label'    => 'Widget Area 3',
			'settings' => array(
				'visibility' => $sydney_hf_visibility( 'sydney_section_fb_component__widget3_visibility' ),
			),
		),

		'widget4'   => array(
			'label'    => 'Widget Area 4',
			'settings' => array(
				'visibility' => $sydney_hf_visibility( 'sydney_section_fb_component__widget4_visibility' ),
			),
		),
	),
);
