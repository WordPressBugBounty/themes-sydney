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
		'check'             => '<path d="M16.5 7.5 10 13.9l-2.5-2.4-1 1 3.5 3.6 7.5-7.6z"/>',
		'chevron-down'      => '<path d="M17.5 11.6L12 16l-5.5-4.4.9-1.2L12 14l4.5-3.6 1 1.2z"/>',
		'chevron-left'      => '<path d="M14.6 7l-1.2-1L8 12l5.4 6 1.2-1-4.6-5z"/>',
		'chevron-right'     => '<path d="M10.6 6L9.4 7l4.6 5-4.6 5 1.2 1 5.4-6z"/>',
		'close'             => '<path d="m13.06 12 6.47-6.47-1.06-1.06L12 10.94 5.53 4.47 4.47 5.53 10.94 12l-6.47 6.47 1.06 1.06L12 13.06l6.47 6.47 1.06-1.06L13.06 12Z"/>',
		'cog'               => '<path fill-rule="evenodd" clip-rule="evenodd" d="M10.289 4.836A1 1 0 0 1 11.275 4h1.306a1 1 0 0 1 .987.836l.244 1.466c.787.26 1.503.679 2.108 1.218l1.393-.522a1 1 0 0 1 1.216.437l.653 1.13a1 1 0 0 1-.23 1.273l-1.148.944a6.025 6.025 0 0 1 0 2.435l1.149.946a1 1 0 0 1 .23 1.272l-.653 1.13a1 1 0 0 1-1.216.437l-1.394-.522c-.605.54-1.32.958-2.108 1.218l-.244 1.466a1 1 0 0 1-.987.836h-1.306a1 1 0 0 1-.986-.836l-.244-1.466a5.995 5.995 0 0 1-2.108-1.218l-1.394.522a1 1 0 0 1-1.217-.436l-.653-1.131a1 1 0 0 1 .23-1.272l1.149-.946a6.026 6.026 0 0 1 0-2.435l-1.148-.944a1 1 0 0 1-.23-1.272l.653-1.131a1 1 0 0 1 1.217-.437l1.393.522a5.994 5.994 0 0 1 2.108-1.218l.244-1.466ZM14.929 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>',
		'copy'              => '<path fill-rule="evenodd" clip-rule="evenodd" d="M5 4.5h11a.5.5 0 0 1 .5.5v11a.5.5 0 0 1-.5.5H5a.5.5 0 0 1-.5-.5V5a.5.5 0 0 1 .5-.5ZM3 5a2 2 0 0 1 2-2h11a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5Zm17 3v10.75c0 .69-.56 1.25-1.25 1.25H6v1.5h12.75a2.75 2.75 0 0 0 2.75-2.75V8H20Z"/>',
		'external'          => '<path d="M19.5 4.5h-7V6h4.44l-5.97 5.97 1.06 1.06L18 7.06v4.44h1.5v-7Zm-13 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-3H17v3a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h3V5.5h-3Z"/>',
		'help'              => '<path d="M12 4a8 8 0 1 1 .001 16.001A8 8 0 0 1 12 4Zm0 1.5a6.5 6.5 0 1 0-.001 13.001A6.5 6.5 0 0 0 12 5.5Zm.75 11h-1.5V15h1.5v1.5Zm-.445-9.234a3 3 0 0 1 .445 5.89V14h-1.5v-1.25c0-.57.452-.958.917-1.01A1.5 1.5 0 0 0 12 8.75a1.5 1.5 0 0 0-1.5 1.5H9a3 3 0 0 1 3.305-2.984Z"/>',
		'info'              => '<path fill-rule="evenodd" clip-rule="evenodd" d="M5.5 12a6.5 6.5 0 1 0 13 0 6.5 6.5 0 0 0-13 0ZM12 4a8 8 0 1 0 0 16 8 8 0 0 0 0-16Zm.75 4v1.5h-1.5V8h1.5Zm0 8v-5h-1.5v5h1.5Z"/>',
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
