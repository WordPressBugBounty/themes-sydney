import { BlockPreview } from '@wordpress/block-editor';
import { rawHandler } from '@wordpress/blocks';
import { useSelect } from '@wordpress/data';
import { useMemo, useState, useRef, useEffect } from '@wordpress/element';
import { __ } from '@wordpress/i18n';
import { STORE_NAME } from '../store/index.js';
import { TYPE_ORDER } from '../constants.js';
import { FavoriteToggle } from './FavoriteToggle.js';

function getTypeIndex( pattern ) {
	const categories = pattern.categories || [];
	const indices = categories.map( ( c ) => TYPE_ORDER.indexOf( c ) ).filter( ( i ) => i !== -1 );
	return indices.length ? Math.min( ...indices ) : Infinity;
}

export function PatternGrid( { patterns, isLoading, onInsert } ) {
	const selectedType = useSelect( ( select ) => select( STORE_NAME ).getSelectedType() );
	const searchQuery = useSelect( ( select ) => select( STORE_NAME ).getSearchQuery() );
	const favorites = useSelect( ( select ) => select( STORE_NAME ).getFavorites() );
	const favoriteSet = useMemo( () => new Set( favorites ), [ favorites ] );
	const recentlyUsed = useSelect( ( select ) => select( STORE_NAME ).getRecentlyUsed() );
	const recentlyUsedSet = useMemo( () => new Set( recentlyUsed ), [ recentlyUsed ] );
	const recentlyUsedOrder = useMemo( () => {
		const order = new Map();
		recentlyUsed.forEach( ( name, index ) => order.set( name, index ) );
		return order;
	}, [ recentlyUsed ] );
	const isPro = window.sydneyPatternLibrary?.isPro || false;
	const upgradeUrl = window.sydneyPatternLibrary?.upgradeUrl || '';

	const [ isFiltering, setIsFiltering ] = useState( false );
	const isFirstRender = useRef( true );

	useEffect( () => {
		if ( isFirstRender.current ) {
			isFirstRender.current = false;
			return;
		}
		setIsFiltering( true );
		const timeout = setTimeout( () => setIsFiltering( false ), 600 );
		return () => clearTimeout( timeout );
	}, [ selectedType ] );

	const q = ( searchQuery || '' ).trim().toLowerCase();
	const filtered = patterns.filter( ( pattern ) => {
		let matchesType;
		if ( selectedType === 'all' ) {
			matchesType = true;
		} else if ( selectedType === 'favorites' ) {
			matchesType = favoriteSet.has( pattern.name );
		} else if ( selectedType === 'recent' ) {
			matchesType = recentlyUsedSet.has( pattern.name );
		} else {
			matchesType = ( pattern.categories || [] ).includes( selectedType );
		}
		if ( ! q ) return matchesType;
		const title = ( pattern.title || '' ).toLowerCase();
		const keywords = ( pattern.keywords || [] ).map( ( k ) => String( k ).toLowerCase() );
		const matchesQuery = title.includes( q ) || keywords.some( ( k ) => k.includes( q ) );
		return matchesType && matchesQuery;
	} );

	const sorted = [ ...filtered ].sort( ( a, b ) => {
		if ( selectedType === 'recent' ) {
			// Preserve LRU ordering from the recentlyUsed array.
			return ( recentlyUsedOrder.get( a.name ) ?? Infinity ) - ( recentlyUsedOrder.get( b.name ) ?? Infinity );
		}
		return getTypeIndex( a ) - getTypeIndex( b );
	} );
	const freePatterns = sorted.filter( ( p ) => ! p.sydney_pro );
	const proPatterns = sorted.filter( ( p ) => p.sydney_pro );

	function handleClickPattern( pattern ) {
		if ( pattern.sydney_pro && ! isPro ) {
			window.open( upgradeUrl, '_blank' );
			return;
		}
		onInsert( pattern );
	}

	if ( isLoading ) {
		return (
			<div className="sydney-pattern-library-loading-overlay" aria-live="polite" aria-busy="true">
				<span className="sydney-pattern-library-spinner" />
				<span className="screen-reader-text">{ __( 'Loading patterns...', 'sydney' ) }</span>
			</div>
		);
	}

	if ( filtered.length === 0 ) {
		return <div className="sydney-pattern-library-no-patterns"><p>{ __( 'No patterns found.', 'sydney' ) }</p></div>;
	}

	return (
		<div className="sydney-pattern-library-pattern-grid">
			{ isFiltering && (
				<div className="sydney-pattern-library-loading-overlay" aria-live="polite" aria-busy="true">
					<span className="sydney-pattern-library-spinner" />
					<span className="screen-reader-text">{ __( 'Loading patterns...', 'sydney' ) }</span>
				</div>
			) }
			{ freePatterns.map( ( pattern ) => (
				<PatternPreview
					key={ `${ selectedType }-${ pattern.name }` }
					pattern={ pattern }
					onClick={ handleClickPattern }
				/>
			) ) }
			{ proPatterns.length > 0 && (
				<div className="sydney-pattern-library-pro-patterns">
					{ proPatterns.map( ( pattern ) => (
						<PatternPreview
							key={ `${ selectedType }-${ pattern.name }` }
							pattern={ pattern }
							onClick={ handleClickPattern }
							isPro={ ! isPro }
						/>
					) ) }
				</div>
			) }
		</div>
	);
}

function PatternPreview( { pattern, onClick, isPro = false } ) {
	const blockRef = useRef( null );
	const [ inViewport, setInViewport ] = useState( false );

	// Mount the live preview only while the card is near the viewport, and
	// unmount it once the card scrolls away, so iframes do not accumulate.
	// The root is the grid's scroll container: against the page viewport the
	// container clips cards first and the margin never applies.
	useEffect( () => {
		const el = blockRef.current;
		if ( ! el ) return;
		const observer = new IntersectionObserver(
			( entries ) => setInViewport( entries[ 0 ].isIntersecting ),
			{
				root: el.closest( '.sydney-pattern-library-modal-grid-container' ),
				rootMargin: '300px 0px',
			}
		);
		observer.observe( el );
		return () => observer.disconnect();
	}, [] );

	return (
		<div
			ref={ blockRef }
			className="sydney-pattern-library-pattern-item"
		>
			<FavoriteToggle patternName={ pattern.name } />
			<button
				type="button"
				className="sydney-pattern-library-pattern-item__action"
				aria-label={ pattern.title }
				onClick={ () => onClick( pattern ) }
			>
				{ isPro && (
					<span className="sydney-pattern-library-pro-badge">{ __( 'Pro', 'sydney' ) }</span>
				) }
				{ inViewport ? (
					<LivePreview content={ pattern.content } containerRef={ blockRef } />
				) : (
					<div className="sydney-pattern-library-pattern-skeleton" aria-hidden="true" />
				) }
			</button>
		</div>
	);
}

function LivePreview( { content, containerRef } ) {
	const [ isLoaded, setIsLoaded ] = useState( false );

	// Parsed only for cards that are about to render.
	const blocks = useMemo( () => rawHandler( { HTML: content } ), [ content ] );

	// Watch for the BlockPreview iframe to finish loading, then drop the skeleton.
	useEffect( () => {
		const el = containerRef.current;
		if ( ! el ) return;
		let done = false;

		function handleLoad() {
			if ( ! done ) {
				done = true;
				setIsLoaded( true );
			}
		}

		function checkIframe( iframe ) {
			if ( done ) return;
			try {
				if ( iframe.contentDocument?.readyState === 'complete' ) {
					handleLoad();
					return;
				}
			} catch ( e ) {}
			iframe.addEventListener( 'load', handleLoad, { once: true } );
		}

		const mutObs = new MutationObserver( ( mutations ) => {
			for ( const mutation of mutations ) {
				for ( const node of mutation.addedNodes ) {
					if ( node.tagName === 'IFRAME' ) {
						checkIframe( node );
					} else if ( node.querySelector ) {
						const iframe = node.querySelector( 'iframe' );
						if ( iframe ) checkIframe( iframe );
					}
				}
			}
		} );
		mutObs.observe( el, { childList: true, subtree: true } );

		const existingIframe = el.querySelector( 'iframe' );
		if ( existingIframe ) checkIframe( existingIframe );

		// Safety: unblock after 8 s if the iframe never fires load.
		const timeout = setTimeout( handleLoad, 8000 );

		return () => {
			// Unmounted: a late iframe load must not set state.
			done = true;
			mutObs.disconnect();
			clearTimeout( timeout );
		};
	}, [ containerRef ] );

	return (
		<>
			<BlockPreview
				blocks={ blocks }
				viewportWidth={ 1600 }
				additionalStyles={ [
					{ css: '.is-root-container > .wp-block-cover,.is-root-container > .wp-block-group { max-width: 100% !important;margin-bottom: 0 !important; } .wp-block-cover { min-height: 500px !important; }' },
				] }
			/>
			{ ! isLoaded && (
				<div className="sydney-pattern-library-pattern-skeleton" aria-hidden="true" />
			) }
		</>
	);
}
