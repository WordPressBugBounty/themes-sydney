/**
 * Full page helpers. Imports nothing: jest and Playwright load this file directly.
 */

/**
 * Concatenate the blocks of every section, each in its own scheme.
 *
 * @param {Object}   page      Full page definition.
 * @param {Function} getBlocks ( name, scheme ) => Block[] | null.
 * @return {Array|null} Blocks, or null when any section cannot be built.
 */
export function composeFullPage( page, getBlocks ) {
	const blocks = [];
	for ( const section of page.sections ) {
		const sectionBlocks = getBlocks( section.pattern, section.scheme );
		if ( ! sectionBlocks ) {
			return null;
		}
		blocks.push( ...sectionBlocks );
	}
	return blocks;
}

/**
 * Shape a Full page like a library pattern so the grid can list it.
 *
 * @param {Object} page      Full page definition.
 * @param {string} typeLabel Translated page type label.
 * @return {Object} Library item.
 */
export function toLibraryItem( page, typeLabel ) {
	return {
		name: page.name,
		title: page.title,
		categories: [ 'page-' + page.page_type ],
		keywords: [ typeLabel ],
		sydney_pro: page.sydney_pro,
		kind: 'page',
		sections: page.sections,
	};
}
