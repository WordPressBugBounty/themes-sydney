<?php

/**
 * Dashboard icon set.
 *
 * Every icon comes from @wordpress/icons, the set the block editor draws with,
 * so the dashboard reads as part of wp-admin rather than as its own world.
 * They are filled shapes on a 24x24 grid that take their colour from the
 * surrounding text, which leaves size as the only thing a caller passes.
 *
 * Source: WordPress/gutenberg, packages/icons/src/library/<name>.svg (GPL-2.0+)
 *
 * @package Dashboard
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Inner shapes for the dashboard icons, keyed by name.
 *
 * Entries hold the shapes only - the wrapping <svg> and its attributes come
 * from sydney_dashboard_icon(). Keys are the upstream Gutenberg file names, so
 * any of those entries can be checked against, or refreshed from, the library
 * directly.
 *
 * The wrapper fills, because that is how the Gutenberg icons are drawn. The
 * few entries below that are drawn as outlines instead carry their own stroke
 * attributes on each shape, which is what keeps the wrapper down to one form.
 *
 * @return array
 */
function sydney_dashboard_icons() {

	// Shared by the outline entries, so their weight stays in step.
	$stroke = 'fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"';

	return array(
		'arrow-right'       => '<path d="m14.5 6.5-1 1 3.7 3.7H4v1.6h13.2l-3.7 3.7 1 1 5.6-5.5z"/>',
		'bell'              => '<path fill-rule="evenodd" clip-rule="evenodd" d="M17 11.5c0 1.353.17 2.368.976 3 .266.209.602.376 1.024.5v1H5v-1c.422-.124.757-.291 1.024-.5.806-.632.976-1.647.976-3V9c0-2.8 2.2-5 5-5s5 2.2 5 5v2.5ZM15.5 9v2.5c0 .93.066 1.98.515 2.897l.053.103H7.932a4.018 4.018 0 0 0 .053-.103c.449-.917.515-1.967.515-2.897V9c0-1.972 1.528-3.5 3.5-3.5s3.5 1.528 3.5 3.5Zm-5.492 9.008c0-.176.023-.346.065-.508h3.854A1.996 1.996 0 0 1 12 20c-1.1 0-1.992-.892-1.992-1.992Z"/>',
		'caution'           => '<path fill-rule="evenodd" clip-rule="evenodd" d="M5.5 12a6.5 6.5 0 1 0 13 0 6.5 6.5 0 0 0-13 0ZM12 4a8 8 0 1 0 0 16 8 8 0 0 0 0-16Zm-.75 12v-1.5h1.5V16h-1.5Zm0-8v5h1.5V8h-1.5Z"/>',
		'chevron-down'      => '<path d="M17.5 11.6L12 16l-5.5-4.4.9-1.2L12 14l4.5-3.6 1 1.2z"/>',
		'chevron-left'      => '<path d="M14.6 7l-1.2-1L8 12l5.4 6 1.2-1-4.6-5z"/>',
		'chevron-right'     => '<path d="M10.6 6L9.4 7l4.6 5-4.6 5 1.2 1 5.4-6z"/>',
		'close'             => '<path d="m13.06 12 6.47-6.47-1.06-1.06L12 10.94 5.53 4.47 4.47 5.53 10.94 12l-6.47 6.47 1.06 1.06L12 13.06l6.47 6.47 1.06-1.06L13.06 12Z"/>',
		'cog'               => '<path fill-rule="evenodd" clip-rule="evenodd" d="M10.289 4.836A1 1 0 0 1 11.275 4h1.306a1 1 0 0 1 .987.836l.244 1.466c.787.26 1.503.679 2.108 1.218l1.393-.522a1 1 0 0 1 1.216.437l.653 1.13a1 1 0 0 1-.23 1.273l-1.148.944a6.025 6.025 0 0 1 0 2.435l1.149.946a1 1 0 0 1 .23 1.272l-.653 1.13a1 1 0 0 1-1.216.437l-1.394-.522c-.605.54-1.32.958-2.108 1.218l-.244 1.466a1 1 0 0 1-.987.836h-1.306a1 1 0 0 1-.986-.836l-.244-1.466a5.995 5.995 0 0 1-2.108-1.218l-1.394.522a1 1 0 0 1-1.217-.436l-.653-1.131a1 1 0 0 1 .23-1.272l1.149-.946a6.026 6.026 0 0 1 0-2.435l-1.148-.944a1 1 0 0 1-.23-1.272l.653-1.131a1 1 0 0 1 1.217-.437l1.393.522a5.994 5.994 0 0 1 2.108-1.218l.244-1.466ZM14.929 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>',
		'copy'              => '<path fill-rule="evenodd" clip-rule="evenodd" d="M5 4.5h11a.5.5 0 0 1 .5.5v11a.5.5 0 0 1-.5.5H5a.5.5 0 0 1-.5-.5V5a.5.5 0 0 1 .5-.5ZM3 5a2 2 0 0 1 2-2h11a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5Zm17 3v10.75c0 .69-.56 1.25-1.25 1.25H6v1.5h12.75a2.75 2.75 0 0 0 2.75-2.75V8H20Z"/>',
		'external'          => '<path d="M19.5 4.5h-7V6h4.44l-5.97 5.97 1.06 1.06L18 7.06v4.44h1.5v-7Zm-13 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-3H17v3a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h3V5.5h-3Z"/>',
		'help'              => '<path d="M12 4a8 8 0 1 1 .001 16.001A8 8 0 0 1 12 4Zm0 1.5a6.5 6.5 0 1 0-.001 13.001A6.5 6.5 0 0 0 12 5.5Zm.75 11h-1.5V15h1.5v1.5Zm-.445-9.234a3 3 0 0 1 .445 5.89V14h-1.5v-1.25c0-.57.452-.958.917-1.01A1.5 1.5 0 0 0 12 8.75a1.5 1.5 0 0 0-1.5 1.5H9a3 3 0 0 1 3.305-2.984Z"/>',
		'info'              => '<path d="M12 3.2c-4.8 0-8.8 3.9-8.8 8.8 0 4.8 3.9 8.8 8.8 8.8 4.8 0 8.8-3.9 8.8-8.8 0-4.8-4-8.8-8.8-8.8zm0 16c-4 0-7.2-3.3-7.2-7.2C4.8 8 8 4.8 12 4.8s7.2 3.3 7.2 7.2c0 4-3.2 7.2-7.2 7.2zM11 17h2v-6h-2v6zm0-8h2V7h-2v2z"/>',
		'list-view'         => '<path d="M3 6h11v1.5H3V6Zm3.5 5.5h11V13h-11v-1.5ZM21 17H10v1.5h11V17Z"/>',
		'lock'              => '<path d="M17 10h-1.2V7c0-2.1-1.7-3.8-3.8-3.8-2.1 0-3.8 1.7-3.8 3.8v3H7c-.6 0-1 .4-1 1v8c0 .6.4 1 1 1h10c.6 0 1-.4 1-1v-8c0-.6-.4-1-1-1zm-2.8 0H9.8V7c0-1.2 1-2.2 2.2-2.2s2.2 1 2.2 2.2v3z"/>',
		'more-vertical'     => '<path d="M13 19h-2v-2h2v2zm0-6h-2v-2h2v2zm0-6h-2V5h2v2z"/>',
		'play'              => '<path d="m8 18 9-6-9-6z"/>',
		'plus'              => '<path d="M11 12.5V17.5H12.5V12.5H17.5V11H12.5V6H11V11H6V12.5H11Z"/>',
		'rotate-left'       => '<path d="M12 4V2.2L9 4.8l3 2.5V5.5c3.6 0 6.5 2.9 6.5 6.5 0 2.9-1.9 5.3-4.5 6.2v.2l-.1-.2c-.4.1-.7.2-1.1.2l.2 1.5c.3 0 .6-.1 1-.2 3.5-.9 6-4 6-7.7 0-4.4-3.6-8-8-8zm-7.9 7l1.5.2c.1-1.2.5-2.3 1.2-3.2l-1.1-.9C4.8 8.2 4.3 9.6 4.1 11zm1.5 1.8l-1.5.2c.1.7.3 1.4.5 2 .3.7.6 1.3 1 1.8l1.2-.8c-.3-.5-.6-1-.8-1.5s-.4-1.1-.4-1.7zm1.5 5.5c1.1.9 2.4 1.4 3.8 1.6l.2-1.5c-1.1-.1-2.2-.5-3.1-1.2l-.9 1.1z"/>',
		'trash'             => '<path fill-rule="evenodd" clip-rule="evenodd" d="M12 5.5A2.25 2.25 0 0 0 9.878 7h4.244A2.251 2.251 0 0 0 12 5.5ZM12 4a3.751 3.751 0 0 0-3.675 3H5v1.5h1.27l.818 8.997a2.75 2.75 0 0 0 2.739 2.501h4.347a2.75 2.75 0 0 0 2.738-2.5L17.73 8.5H19V7h-3.325A3.751 3.751 0 0 0 12 4Zm4.224 4.5H7.776l.806 8.861a1.25 1.25 0 0 0 1.245 1.137h4.347a1.25 1.25 0 0 0 1.245-1.137l.805-8.861Z"/>',

		// Outlines. Lucide corner-down-right, the pencil, and the part glyphs
		// drawn in house.
		'corner-down-right' => '<path d="m15 10 5 5-5 5" ' . $stroke . '/><path d="M4 4v7a4 4 0 0 0 4 4h12" ' . $stroke . '/>',

		// Drawn on a 21 grid, so the group fits it to the 16-unit box the rest of
		// this section uses, with the weight pre-divided to land on 1.8.
		'pencil'            => '<g transform="translate(4 4) scale(0.7619)" fill="none" stroke="currentColor" stroke-width="2.36" stroke-linecap="round" stroke-linejoin="round">'
			. '<path d="M10 1.99609H3C2.46957 1.99609 1.96086 2.20681 1.58579 2.58188C1.21071 2.95695 1 3.46566 1 3.99609V17.9961C1 18.5265 1.21071 19.0352 1.58579 19.4103C1.96086 19.7854 2.46957 19.9961 3 19.9961H17C17.5304 19.9961 18.0391 19.7854 18.4142 19.4103C18.7893 19.0352 19 18.5265 19 17.9961V10.9961"/>'
			. '<path d="M16.3751 1.62132C16.7729 1.2235 17.3125 1 17.8751 1C18.4377 1 18.9773 1.2235 19.3751 1.62132C19.7729 2.01914 19.9964 2.55871 19.9964 3.12132C19.9964 3.68393 19.7729 4.2235 19.3751 4.62132L10.3621 13.6353C10.1246 13.8726 9.8313 14.0462 9.50909 14.1403L6.63609 14.9803C6.55005 15.0054 6.45883 15.0069 6.372 14.9847C6.28517 14.9624 6.20592 14.9173 6.14254 14.8539C6.07916 14.7905 6.03398 14.7112 6.01174 14.6244C5.98949 14.5376 5.991 14.4464 6.01609 14.3603L6.85609 11.4873C6.95062 11.1654 7.12463 10.8724 7.36209 10.6353L16.3751 1.62132Z"/>'
			. '</g>',
		'part-header'       => '<rect x="3" y="3.5" width="18" height="17" rx="2.4" ' . $stroke . '/><rect x="3" y="3.5" width="18" height="5" rx="2.4"/>',
		'part-page-title'   => '<rect x="3" y="3.5" width="18" height="17" rx="2.4" ' . $stroke . '/><rect x="6.5" y="8" width="11" height="3" rx="1.3"/>',
		'part-content'      => '<rect x="3" y="3.5" width="18" height="17" rx="2.4" ' . $stroke . '/><rect x="6.5" y="8.5" width="11" height="2.2" rx="1.1"/><rect x="6.5" y="13" width="7.5" height="2.2" rx="1.1"/>',
		'part-footer'       => '<rect x="3" y="3.5" width="18" height="17" rx="2.4" ' . $stroke . '/><rect x="3" y="15.5" width="18" height="5" rx="2.4"/>',

		// Its own weight: the badge it sits in is small enough that the shared
		// one renders as a hairline.
		'check-bold'        => '<polyline points="4 12.5 9.5 18 20 6.5" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"/>',
	);
}

/**
 * Markup for a dashboard icon.
 *
 * @param string $name  Icon name, as keyed in sydney_dashboard_icons().
 * @param int    $size  Rendered width and height in pixels. Upstream draws
 *                      these for 24, so anything smaller is a deliberate fit
 *                      to the row it sits in.
 * @param string $classes Extra class on the <svg>.
 * @return string Empty string when the icon is unknown.
 */
function sydney_dashboard_icon( $name, $size = 24, $classes = '' ) {

	$icons = sydney_dashboard_icons();

	if ( ! isset( $icons[ $name ] ) ) {
		return '';
	}

	return sprintf(
		'<svg%1$s width="%2$s" height="%2$s" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">%3$s</svg>',
		$classes ? ' class="' . esc_attr( $classes ) . '"' : '',
		esc_attr( $size ),
		$icons[ $name ]
	);
}

/**
 * Brand marks for the AI clients named in the dashboard copy.
 *
 * These are third-party logos, not part of the Gutenberg set above: each keeps
 * its own viewBox and its own brand colour, so none of them can go through
 * sydney_dashboard_icon(), which draws one 24x24 grid in currentColor.
 *
 * Source: wpforms-lite, assets/images/admin/tools/ai-mcp/. The Figma export's
 * clip path and var(--fill-0, ...) wrapper are dropped here: the clip was the
 * full viewBox, so it clipped nothing, and its generated id would have collided
 * with any second copy on the page.
 *
 * @return array
 */
function sydney_dashboard_brand_icons() {

	return array(
		'claude'   => array(
			'viewbox' => '0 0 16 16',
			'path'    => 'M3.136 10.64L6.288 8.88L6.336 8.72L6.288 8.64H6.128L5.6 8.608L3.808 8.56L2.24 8.48L0.72 8.4L0.336 8.32L0 7.84L0.032 7.6L0.352 7.392L0.816 7.424L1.824 7.504L3.344 7.6L4.448 7.664L6.08 7.856H6.336L6.368 7.744L6.288 7.68L6.224 7.616L4.64 6.56L2.944 5.44L2.048 4.784L1.568 4.464L1.328 4.144L1.232 3.472L1.664 2.992L2.256 3.04L2.4 3.072L2.992 3.536L4.272 4.512L5.92 5.76L6.16 5.952L6.256 5.888L6.272 5.84L6.16 5.664L5.28 4L4.32 2.336L3.888 1.648L3.776 1.232C3.728 1.072 3.712 0.912 3.712 0.752L4.192 0.08L4.48 0L5.152 0.096L5.408 0.32L5.824 1.28L6.48 2.768L7.52 4.784L7.84 5.392L8 5.936L8.048 6.096H8.16V6.016L8.24 4.864L8.4 3.472L8.56 1.68L8.608 1.168L8.864 0.56L9.344 0.24L9.76 0.416L10.08 0.88L10.032 1.168L9.856 2.4L9.44 4.336L9.2 5.648H9.344L9.504 5.472L10.16 4.608L11.264 3.232L11.744 2.672L12.32 2.08L12.688 1.792H13.376L13.872 2.544L13.648 3.328L12.944 4.224L12.352 4.976L11.504 6.112L10.992 7.024L11.04 7.088H11.152L13.072 6.672L14.096 6.496L15.312 6.288L15.872 6.544L15.936 6.8L15.712 7.344L14.4 7.664L12.864 7.984L10.576 8.512L10.544 8.528L10.576 8.576L11.6 8.672L12.048 8.704H13.136L15.152 8.864L15.68 9.184L15.984 9.616L15.936 9.936L15.12 10.352L14.032 10.096L11.472 9.488L10.608 9.28H10.48V9.344L11.216 10.064L12.544 11.264L14.24 12.816L14.32 13.2L14.112 13.52L13.888 13.488L12.416 12.368L11.84 11.888L10.56 10.8H10.48V10.912L10.768 11.344L12.336 13.696L12.416 14.416L12.304 14.64L11.888 14.8L11.456 14.704L10.528 13.424L9.568 11.984L8.816 10.672L8.736 10.736L8.272 15.568L8.064 15.808L7.584 16L7.184 15.68L6.96 15.2L7.184 14.208L7.44 12.928L7.648 11.904L7.84 10.64L7.952 10.224V10.192H7.84L6.88 11.52L5.44 13.488L4.288 14.704L4.016 14.816L3.536 14.576L3.584 14.128L3.84 13.76L5.44 11.712L6.4 10.448L7.04 9.712L7.024 9.632H6.976L2.752 12.384L2 12.48L1.68 12.16L1.712 11.68L1.872 11.52L3.152 10.64H3.136Z',
			'fill'    => '#D97757',
		),
		'chatgpt'  => array(
			'viewbox' => '4 4 16 16',
			'path'    => 'M18.8528 10.5483C18.9879 10.1422 19.0569 9.71708 19.0569 9.28915C19.0569 8.58104 18.8683 7.88571 18.5105 7.27465C17.7915 6.02317 16.4578 5.25053 15.0144 5.25053C14.7304 5.25053 14.446 5.28053 14.1684 5.34012C13.7944 4.91875 13.3353 4.58145 12.8215 4.35045C12.3076 4.11944 11.7506 4 11.1872 3.99998H11.1619C11.1593 4.00007 11.1554 4.00007 11.1524 4.00007C9.40419 4.00007 7.85386 5.12813 7.31639 6.7912C6.19096 7.02129 5.21942 7.72709 4.65139 8.72489C4.2947 9.33966 4.10673 10.0377 4.1065 10.7485C4.10665 11.7473 4.47744 12.7106 5.14709 13.4517C5.01191 13.8578 4.94297 14.2829 4.94291 14.7109C4.94297 15.419 5.13158 16.1143 5.48934 16.7254C6.20822 17.9772 7.54204 18.7494 8.98561 18.7494C9.26983 18.7494 9.55325 18.7194 9.83116 18.6598C10.2052 19.0812 10.6643 19.4185 11.1782 19.6495C11.6921 19.8805 12.2492 19.9999 12.8126 20H12.8379L12.8482 19.9999C14.5974 19.9999 16.1472 18.8719 16.6847 17.2073C17.8101 16.9771 18.7816 16.2713 19.3497 15.2735C19.706 14.6593 19.8936 13.9618 19.8935 13.2517C19.8934 12.2529 19.5226 11.2896 18.853 10.5485L18.8528 10.5483ZM12.8389 18.954H12.8348C12.1349 18.9537 11.4572 18.7082 10.9195 18.2601C10.9515 18.2429 10.983 18.225 11.0142 18.2064L14.1999 16.3662C14.2794 16.321 14.3455 16.2555 14.3915 16.1764C14.4375 16.0974 14.4618 16.0075 14.4618 15.916V11.4217L15.8083 12.1992C15.8227 12.2063 15.8325 12.2202 15.8345 12.2361V15.9556C15.8327 17.6092 14.4927 18.9507 12.8389 18.954ZM6.39672 16.2026C6.13358 15.7475 5.99495 15.2312 5.99478 14.7056C5.99478 14.5342 6.00976 14.3623 6.03892 14.1934C6.06259 14.2076 6.10392 14.2328 6.13356 14.2499L9.31934 16.09C9.39879 16.1363 9.4891 16.1607 9.58106 16.1607C9.67301 16.1607 9.76332 16.1363 9.84275 16.09L13.7322 13.8441V15.3992C13.7327 15.4071 13.7311 15.415 13.7278 15.4222C13.7244 15.4294 13.7193 15.4357 13.713 15.4405L10.4925 17.2999C10.0368 17.5621 9.52027 17.7002 8.99448 17.7004C8.46817 17.7003 7.95113 17.5619 7.49519 17.299C7.03926 17.036 6.66045 16.6579 6.39676 16.2024L6.39672 16.2026ZM5.55864 9.24778C5.90852 8.64001 6.46099 8.17465 7.11938 7.93315C7.11938 7.9606 7.1178 8.00917 7.1178 8.04294V11.7233L7.11775 11.7264C7.11777 11.8177 7.14197 11.9075 7.1879 11.9865C7.23383 12.0655 7.29984 12.1309 7.37924 12.1762L11.2688 14.4217L9.9222 15.1992C9.91556 15.2036 9.90793 15.2062 9.90001 15.2069C9.89208 15.2076 9.88411 15.2064 9.87679 15.2033L6.65601 13.3423C6.20069 13.0785 5.82268 12.6997 5.55988 12.2438C5.29708 11.788 5.15871 11.271 5.15864 10.7448C5.15885 10.2195 5.29683 9.70331 5.55881 9.24791L5.55864 9.24778ZM16.6218 11.8223L12.7323 9.57645L14.0789 8.79925C14.0855 8.79486 14.0931 8.79219 14.101 8.79147C14.109 8.79075 14.117 8.792 14.1243 8.79512L17.3451 10.6545C18.2721 11.1901 18.844 12.1805 18.844 13.2515C18.844 14.5077 18.0602 15.6318 16.8816 16.0656V12.2752C16.8817 12.2738 16.8817 12.2723 16.8817 12.271C16.8817 12.0857 16.7824 11.9144 16.6218 11.8223ZM17.9621 9.80513C17.9384 9.7906 17.8971 9.7657 17.8674 9.74866L14.6816 7.90847C14.6022 7.86217 14.5119 7.83776 14.42 7.83771C14.3281 7.83771 14.2377 7.86222 14.1584 7.90847L10.2688 10.1543V8.59925L10.2688 8.59657C10.2688 8.58907 10.2705 8.58167 10.2739 8.57496C10.2773 8.56825 10.2821 8.56242 10.2881 8.55792L13.5086 6.70007C13.9641 6.43745 14.4807 6.29919 15.0065 6.29915C16.6624 6.29915 18.0053 7.64202 18.0053 9.29789C18.0052 9.46781 17.9907 9.63742 17.9621 9.80491V9.80513ZM9.53678 12.5767L8.18991 11.7992C8.18285 11.7957 8.17676 11.7905 8.17219 11.7841C8.16763 11.7776 8.16472 11.7701 8.16374 11.7623V8.04285C8.16444 6.38782 9.50731 5.0461 11.1625 5.0461C11.8635 5.04625 12.5423 5.29181 13.0812 5.74017C13.0493 5.75744 13.0177 5.77533 12.9865 5.79384L9.80077 7.63398C9.72128 7.67921 9.65519 7.74468 9.60921 7.82373C9.56323 7.90278 9.53899 7.9926 9.53897 8.08405V8.08703L9.53678 12.5767ZM10.2682 10.9996L12.0006 9.99912L13.7328 10.999V12.9994L12.0006 13.9993L10.2682 12.9994V10.9996Z',
			'fill'    => '#000000',
		),
		'cursor'   => array(
			'viewbox' => '0 0 14.0346 16',
			'path'    => 'M13.755 3.787L7.34977 0.0889769C7.14409 -0.0298 6.8903 -0.0298 6.68462 0.0889769L0.279692 3.787C0.106789 3.88683 4.03303e-05 4.07146 4.03303e-05 4.27143V11.7285C4.03303e-05 11.9285 0.106789 12.1131 0.279692 12.2129L6.68492 15.911C6.8906 16.0297 7.1444 16.0297 7.35007 15.911L13.7553 12.2129C13.9282 12.1131 14.035 11.9285 14.035 11.7285V4.27143C14.035 4.07146 13.9282 3.88683 13.7553 3.787H13.755ZM13.3527 4.57032L7.16935 15.2801C7.12756 15.3523 7.0172 15.3228 7.0172 15.2392V8.22655C7.0172 8.08642 6.94232 7.95682 6.82084 7.88645L0.747884 4.38028C0.675715 4.33848 0.705184 4.22813 0.788779 4.22813H13.1554C13.331 4.22813 13.4408 4.41847 13.353 4.57062H13.3527V4.57032Z',
			'fill'    => '#26251E',
		),
	);
}

/**
 * Markup for a brand mark, sized to sit inline with a line of text.
 *
 * preserveAspectRatio is left at its default, so a mark that is not square
 * (Cursor) centres inside the box rather than stretching to fill it.
 *
 * @param string $name    Brand name, as keyed in sydney_dashboard_brand_icons().
 * @param int    $size    Rendered width and height in pixels.
 * @param string $classes Extra class on the <svg>.
 * @return string Empty string when the brand is unknown.
 */
function sydney_dashboard_brand_icon( $name, $size = 12, $classes = 'sydney-dashboard-brand-icon' ) {

	$icons = sydney_dashboard_brand_icons();

	if ( ! isset( $icons[ $name ] ) ) {
		return '';
	}

	return sprintf(
		'<svg%1$s width="%2$s" height="%2$s" viewBox="%3$s" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false"><path d="%4$s" fill="%5$s"/></svg>',
		$classes ? ' class="' . esc_attr( $classes ) . '"' : '',
		esc_attr( $size ),
		esc_attr( $icons[ $name ]['viewbox'] ),
		esc_attr( $icons[ $name ]['path'] ),
		esc_attr( $icons[ $name ]['fill'] )
	);
}
