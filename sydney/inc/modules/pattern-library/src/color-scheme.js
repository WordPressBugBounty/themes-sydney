export const COLOR_SCHEMES = [ 'white', 'grey', 'dark' ];
export const DEFAULT_COLOR_SCHEME = 'white';

export const HEADING_BLOCKS = [ 'core/heading', 'core/post-title' ];
export const TEXT_BLOCKS = [
	'core/paragraph',
	'core/list',
	'core/quote',
	'core/pullquote',
	'core/post-date',
	'core/post-excerpt',
	'core/post-terms',
	'core/read-more',
	'core/table',
	'core/details',
];

// Global color targets per role, per scheme: a number is a Global color written back in its source form, a string is a
// literal color. Colors 1 and 2 (accent) are never mapped.
// Dark uses literal whites on Global color 6, the convention of Sydney's own header: Pro's Dark mode palette keeps 6 dark
// but turns 9 dark and 3, 4, 5 light, so no Global color is light on 6 under both palettes. A card on color 6 stays a step
// lighter than a card on color 7, so an emphasized card remains distinct from the regular ones.
const SCHEME_MAPS = {
	white: { background: {}, text: {}, border: {} },
	grey: { background: { 9: 7, 7: 9 }, text: {}, border: {} },
	dark: {
		background: { 9: 6, 7: '#ffffff0f', 6: '#ffffff24', 8: '#ffffff26' },
		text: { 3: '#ffffff', 4: '#ffffff', 6: '#ffffff', 5: '#ffffffb3', 8: '#ffffff99' },
		border: { 8: '#ffffff26', 7: '#ffffff26' },
	},
};

// Text colors Dark gives blocks without one of their own (see applyDarkDefault).
const DARK_DEFAULTS = { heading: '#ffffff', text: '#ffffffcc' };

// Slug attributes only hold Global color slugs: a literal goes to the style path that colors the same thing.
const LITERAL_PATHS = {
	backgroundColor: [ 'style', 'color', 'background' ],
	textColor: [ 'style', 'color', 'text' ],
	borderColor: [ 'style', 'border', 'color' ],
};

// Icon tints (duotone) cannot hold CSS variables, so exact value pairs are swapped per scheme. Anything else is left alone.
const DUOTONE_PATH = [ 'style', 'color', 'duotone' ];
const DUOTONE_MAPS = {
	dark: [ { from: [ '#000000', '#000000' ], to: [ '#ffffff', '#ffffff' ] } ],
};

const ROLE_PATHS = {
	background: [ [ 'backgroundColor' ], [ 'style', 'color', 'background' ] ],
	text: [
		[ 'textColor' ],
		[ 'style', 'color', 'text' ],
		[ 'style', 'elements', 'link', 'color', 'text' ],
		[ 'style', 'elements', 'link', ':hover', 'color', 'text' ],
	],
	border: [
		[ 'borderColor' ],
		[ 'style', 'border', 'color' ],
		...[ 'top', 'right', 'bottom', 'left' ].map( ( side ) => [ 'style', 'border', side, 'color' ] ),
	],
};

// Attributes holding a CSS custom property, per block, mapped with the text map.
const CSS_VAR_TEXT_PATHS = {
	'wpforms/form-selector': [ [ 'labelColor' ], [ 'labelSublabelColor' ] ],
};

const SLUG = /^global_color_(\d+)$/;
const PRESET = /^var:preset\|color\|global_color_(\d+)$/;
const CSS_VAR = /^var\(--sydney-global-color-(\d+)\)$/;

// Value forms a Global color is written in, and how to write color N in each.
const FORMS = [
	[ SLUG, ( n ) => `global_color_${ n }` ],
	[ PRESET, ( n ) => `var:preset|color|global_color_${ n }` ],
	[ CSS_VAR, ( n ) => `var(--sydney-global-color-${ n })` ],
];

const mapValue = ( value, map ) => {
	if ( typeof value !== 'string' ) {
		return value;
	}
	for ( const [ form, write ] of FORMS ) {
		const match = form.exec( value );
		if ( match ) {
			const target = map[ match[ 1 ] ];
			if ( target === undefined ) {
				return value;
			}
			return typeof target === 'number' ? write( target ) : target;
		}
	}
	return value;
};

const getAt = ( object, path ) => path.reduce( ( node, key ) => ( node && typeof node === 'object' ? node[ key ] : undefined ), object );

const setAt = ( object, path, value ) => {
	const [ key, ...rest ] = path;
	const current = object || {};
	return { ...current, [ key ]: rest.length ? setAt( current[ key ], rest, value ) : value };
};

const withoutKey = ( object, key ) => Object.fromEntries( Object.entries( object ).filter( ( [ name ] ) => name !== key ) );

const mapRole = ( attributes, paths, map ) => paths.reduce( ( current, path ) => {
	const value = getAt( current, path );
	const mapped = mapValue( value, map );
	if ( mapped === value ) {
		return current;
	}
	const literalPath = path.length === 1 && LITERAL_PATHS[ path[ 0 ] ];
	if ( literalPath && ! SLUG.test( mapped ) ) {
		return setAt( withoutKey( current, path[ 0 ] ), literalPath, mapped );
	}
	return setAt( current, path, mapped );
}, attributes );

const mapDuotone = ( attributes, scheme ) => {
	const value = getAt( attributes, DUOTONE_PATH );
	if ( ! Array.isArray( value ) ) {
		return attributes;
	}
	const rule = ( DUOTONE_MAPS[ scheme ] || [] ).find( ( { from } ) => from.length === value.length && from.every( ( color, index ) => value[ index ] === color ) );
	return rule ? setAt( attributes, DUOTONE_PATH, [ ...rule.to ] ) : attributes;
};

const isPhotoSubtree = ( block ) => block.name === 'core/cover' || Boolean( block.attributes?.style?.background?.backgroundImage );

const ownText = ( attributes ) => {
	if ( attributes.textColor ) {
		return { textColor: attributes.textColor };
	}
	const text = attributes.style?.color?.text;
	return text ? { style: text } : null;
};

const applyDarkDefault = ( block, attributes, inherited ) => {
	if ( ownText( attributes ) ) {
		return attributes;
	}
	if ( HEADING_BLOCKS.includes( block.name ) ) {
		if ( inherited?.textColor ) {
			return { ...attributes, textColor: inherited.textColor };
		}
		return setAt( attributes, [ 'style', 'color', 'text' ], inherited?.style || DARK_DEFAULTS.heading );
	}
	if ( TEXT_BLOCKS.includes( block.name ) && ! inherited ) {
		return setAt( attributes, [ 'style', 'color', 'text' ], DARK_DEFAULTS.text );
	}
	return attributes;
};

const recolorBlock = ( block, maps, scheme, inherited ) => {
	if ( isPhotoSubtree( block ) ) {
		return block;
	}

	let attributes = block.attributes || {};
	attributes = mapRole( attributes, ROLE_PATHS.background, maps.background );
	attributes = mapRole( attributes, ROLE_PATHS.text, maps.text );
	attributes = mapRole( attributes, ROLE_PATHS.border, maps.border );
	attributes = mapRole( attributes, CSS_VAR_TEXT_PATHS[ block.name ] || [], maps.text );

	attributes = mapDuotone( attributes, scheme );

	if ( scheme === 'dark' ) {
		attributes = applyDarkDefault( block, attributes, inherited );
	}

	const childInherited = ownText( attributes ) || inherited;

	return {
		...block,
		attributes,
		innerBlocks: ( block.innerBlocks || [] ).map( ( child ) => recolorBlock( child, maps, scheme, childInherited ) ),
	};
};

/**
 * Recolors blocks for a color scheme. Pure: never mutates its input. White and unknown schemes return the input array itself, and unchanged nested objects are shared.
 *
 * @param {Object[]} blocks Parsed blocks ({ name, attributes, innerBlocks }).
 * @param {string}   scheme One of COLOR_SCHEMES. Anything else behaves as white.
 * @return {Object[]} Recolored blocks.
 */
export const recolorBlocks = ( blocks, scheme ) => {
	const resolved = COLOR_SCHEMES.includes( scheme ) ? scheme : DEFAULT_COLOR_SCHEME;
	if ( resolved === 'white' ) {
		return blocks;
	}
	return blocks.map( ( block ) => recolorBlock( block, SCHEME_MAPS[ resolved ], resolved, null ) );
};
