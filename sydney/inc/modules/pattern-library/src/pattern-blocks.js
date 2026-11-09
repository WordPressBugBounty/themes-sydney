import { parse } from '@wordpress/blocks';
import { recolorBlocks } from './color-scheme.js';
import { composeFullPage } from './full-pages.js';

/**
 * A pattern's blocks in a Color scheme, for an insert. Previews parse once and
 * run the same recolorBlocks on each scheme switch, so a preview always
 * matches what lands in the page.
 *
 * @param {string} content Pattern markup.
 * @param {string} scheme  One of COLOR_SCHEMES.
 * @return {Object[]} Parsed, recolored blocks.
 */
export const getPatternBlocks = ( content, scheme ) =>
	recolorBlocks( parse( content ), scheme );

/**
 * A library item's blocks. A pattern takes the chosen scheme. A Full page
 * ignores it: each section keeps the scheme its definition names.
 *
 * @param {Object}             item     Pattern, or Full page item (`kind: 'page'`).
 * @param {string}             scheme   One of COLOR_SCHEMES.
 * @param {Map<string,Object>} patterns Library patterns by name.
 * @return {Object[]|null} Blocks, or null when a Full page section is missing.
 */
export function getItemBlocks( item, scheme, patterns ) {
	if ( item.kind !== 'page' ) {
		return getPatternBlocks( item.content, scheme );
	}
	return composeFullPage( item, ( name, sectionScheme ) => {
		const pattern = patterns.get( name );
		return pattern
			? getPatternBlocks( pattern.content, sectionScheme )
			: null;
	} );
}
