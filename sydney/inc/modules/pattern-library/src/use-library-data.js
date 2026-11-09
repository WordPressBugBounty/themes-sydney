import apiFetch from '@wordpress/api-fetch';
import { useEffect, useState } from '@wordpress/element';

/**
 * A hook that reads one list from a library route. The route is requested
 * once per editor load and shared by every open of the library. A failure
 * logs, yields an empty list, and is forgotten so the next open retries.
 *
 * @param {string} path  REST path.
 * @param {string} key   Response key that holds the list.
 * @param {string} label What the list holds, for the error message.
 * @return {Function} Hook returning `{ items: Object[], isLoading: boolean }`.
 */
function createLibraryDataHook( path, key, label ) {
	let request = null;
	let loaded = null;

	function fetchItems() {
		if ( ! request ) {
			request = apiFetch( { path } )
				.then( ( response ) => {
					loaded = Array.isArray( response?.[ key ] )
						? response[ key ]
						: [];
					return loaded;
				} )
				.catch( ( error ) => {
					// eslint-disable-next-line no-console
					console.error(
						`Sydney pattern library: failed to load ${ label }`,
						error
					);
					request = null;
					return [];
				} );
		}
		return request;
	}

	return function useLibraryData() {
		const [ state, setState ] = useState( () =>
			loaded
				? { items: loaded, isLoading: false }
				: { items: [], isLoading: true }
		);

		useEffect( () => {
			if ( loaded ) {
				return;
			}
			let isMounted = true;
			fetchItems().then( ( items ) => {
				if ( isMounted ) {
					setState( { items, isLoading: false } );
				}
			} );
			return () => {
				isMounted = false;
			};
		}, [] );

		return state;
	};
}

/** The Pro patterns the library lists beside the registered ones. */
export const useProPatterns = createLibraryDataHook(
	'/sydney/v1/pro-patterns',
	'patterns',
	'Pro patterns'
);

/** The Full page definitions listed under the Pages tab. */
export const useFullPages = createLibraryDataHook(
	'/sydney/v1/full-pages',
	'pages',
	'Full pages'
);
