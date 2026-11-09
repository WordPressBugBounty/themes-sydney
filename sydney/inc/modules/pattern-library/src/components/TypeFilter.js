import { useDispatch, useSelect } from '@wordpress/data';
import { Button, Flex } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import { STORE_NAME } from '../store/index.js';

/**
 * The category list of the active tab.
 *
 * @param {Object}             props
 * @param {Object[]}           props.items  The tab's items.
 * @param {Map<string,string>} props.labels Category label by slug.
 * @param {string[]}           props.order  Category display order.
 */
export function TypeFilter( { items, labels, order } ) {
	const selected = useSelect( ( select ) =>
		select( STORE_NAME ).getSelectedType()
	);
	const { setType } = useDispatch( STORE_NAME );

	const types = [
		...new Set( items.flatMap( ( p ) => p.categories || [] ) ),
	].sort( ( a, b ) => {
		const ai = order.indexOf( a );
		const bi = order.indexOf( b );
		if ( ai === -1 && bi === -1 ) {
			return a.localeCompare( b );
		}
		if ( ai === -1 ) {
			return 1;
		}
		if ( bi === -1 ) {
			return -1;
		}
		return ai - bi;
	} );

	const allTypes = [
		{ slug: 'all', label: __( 'All', 'sydney' ) },
		...types.map( ( slug ) => ( {
			slug,
			label: labels.get( slug ) || slug,
		} ) ),
	];

	return (
		<Flex
			direction="column"
			gap={ 1 }
			justify="flex-start"
			className="sydney-pattern-library-type-filter"
		>
			{ allTypes.map( ( { slug, label } ) => (
				<Button
					key={ slug }
					isPressed={ selected === slug }
					onClick={ () => setType( slug ) }
				>
					{ label }
				</Button>
			) ) }
		</Flex>
	);
}
