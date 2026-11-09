export const PREVIEW_VIEWPORT_HEIGHT = 900;

const VH_PATTERN = /^(\d+(?:\.\d+)?)vh$/;
const vhToPx = ( value ) => value * ( PREVIEW_VIEWPORT_HEIGHT / 100 );

const convertBlock = ( block ) => {
	let attributes = block.attributes;

	if ( attributes ) {
		if ( block.name === 'core/cover' && attributes.minHeightUnit === 'vh' ) {
			attributes = { ...attributes, minHeight: vhToPx( attributes.minHeight ), minHeightUnit: 'px' };
		}

		const minHeight = attributes.style?.dimensions?.minHeight;
		const match = typeof minHeight === 'string' ? VH_PATTERN.exec( minHeight ) : null;

		if ( match ) {
			attributes = {
				...attributes,
				style: {
					...attributes.style,
					dimensions: { ...attributes.style.dimensions, minHeight: `${ vhToPx( Number( match[ 1 ] ) ) }px` },
				},
			};
		}
	}

	return {
		...block,
		attributes,
		innerBlocks: ( block.innerBlocks || [] ).map( convertBlock ),
	};
};

export const toPreviewGeometry = ( blocks ) => blocks.map( convertBlock );
