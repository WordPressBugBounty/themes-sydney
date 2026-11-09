import { BlockPreview } from '@wordpress/block-editor';
import { parse } from '@wordpress/blocks';
import { RegistryProvider, useRegistry, useSelect } from '@wordpress/data';
import {
	useCallback,
	useMemo,
	useState,
	useRef,
	useEffect,
	useLayoutEffect,
} from '@wordpress/element';
import { __ } from '@wordpress/i18n';
import { STORE_NAME } from '../store/index.js';
import { FavoriteToggle } from './FavoriteToggle.js';
import { toPreviewGeometry } from '../preview-geometry.js';
import { recolorBlocks } from '../color-scheme.js';
import { isLockedPattern, lockedLast } from '../pro-lock.js';

// Full page cards show this much of the page; hovering scrolls the rest into view.
const PAGE_CARD_HEIGHT = 420;
// Hover scroll speed, in px per second. 120 moves the preview a whole number
// of device pixels per frame at 60 and 120 Hz: at 150 every other frame landed
// on a half pixel and blurred, so the scroll shimmered.
const PAGE_SCROLL_SPEED = 120;

function getTypeIndex( pattern, order ) {
	const categories = pattern.categories || [];
	const indices = categories
		.map( ( c ) => order.indexOf( c ) )
		.filter( ( i ) => i !== -1 );
	return indices.length ? Math.min( ...indices ) : Infinity;
}

export function PatternGrid( {
	patterns,
	searchQuery,
	typeOrder,
	getBlocks,
	isLoading,
	onInsert,
} ) {
	const selectedType = useSelect( ( select ) =>
		select( STORE_NAME ).getSelectedType()
	);
	const favorites = useSelect( ( select ) =>
		select( STORE_NAME ).getFavorites()
	);
	const favoriteSet = useMemo( () => new Set( favorites ), [ favorites ] );
	const recentlyUsed = useSelect( ( select ) =>
		select( STORE_NAME ).getRecentlyUsed()
	);
	const recentlyUsedSet = useMemo(
		() => new Set( recentlyUsed ),
		[ recentlyUsed ]
	);
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
		const keywords = ( pattern.keywords || [] ).map( ( k ) =>
			String( k ).toLowerCase()
		);
		const matchesQuery =
			title.includes( q ) || keywords.some( ( k ) => k.includes( q ) );
		return matchesType && matchesQuery;
	} );

	const sorted = lockedLast(
		[ ...filtered ].sort( ( a, b ) => {
			if ( selectedType === 'recent' ) {
				// Preserve LRU ordering from the recentlyUsed array.
				return (
					( recentlyUsedOrder.get( a.name ) ?? Infinity ) -
					( recentlyUsedOrder.get( b.name ) ?? Infinity )
				);
			}
			return getTypeIndex( a, typeOrder ) - getTypeIndex( b, typeOrder );
		} ),
		isPro
	);

	if ( isLoading ) {
		return (
			<div
				className="sydney-pattern-library-loading-overlay"
				aria-live="polite"
				aria-busy="true"
			>
				<span className="sydney-pattern-library-spinner" />
				<span className="screen-reader-text">
					{ __( 'Loading patterns...', 'sydney' ) }
				</span>
			</div>
		);
	}

	if ( filtered.length === 0 ) {
		return (
			<div className="sydney-pattern-library-no-patterns">
				<p>{ __( 'No patterns found.', 'sydney' ) }</p>
			</div>
		);
	}

	return (
		<div className="sydney-pattern-library-pattern-grid">
			{ isFiltering && (
				<div
					className="sydney-pattern-library-loading-overlay"
					aria-live="polite"
					aria-busy="true"
				>
					<span className="sydney-pattern-library-spinner" />
					<span className="screen-reader-text">
						{ __( 'Loading patterns...', 'sydney' ) }
					</span>
				</div>
			) }
			{ sorted.map( ( pattern ) => (
				<PatternPreview
					key={ `${ selectedType }-${ pattern.name }` }
					pattern={ pattern }
					getBlocks={ getBlocks }
					onClick={ onInsert }
					isLocked={ isLockedPattern( pattern, isPro ) }
					upgradeUrl={ upgradeUrl }
				/>
			) ) }
		</div>
	);
}

function PatternPreview( {
	pattern,
	getBlocks,
	onClick,
	isLocked,
	upgradeUrl,
} ) {
	const isPage = pattern.kind === 'page';
	const pageScrollRef = useRef( null );
	const blockRef = useRef( null );
	const loadedHeight = useRef( 0 );
	const [ inViewport, setInViewport ] = useState( false );
	const [ isLoaded, setIsLoaded ] = useState( false );
	const handleLoad = useCallback( () => setIsLoaded( true ), [] );
	const scheme = useSelect( ( select ) =>
		select( STORE_NAME ).getColorScheme()
	);
	// Parsed once per mount, only for cards about to render. A scheme switch
	// recolors these same blocks: they keep their client ids, so the preview
	// repaints in place instead of rebuilding, and the card keeps its height.
	// A Full page keeps each section's own scheme, so it is built whole.
	const parsed = useMemo(
		() => ( inViewport && ! isPage ? parse( pattern.content ) : null ),
		[ inViewport, isPage, pattern.content ]
	);
	const blocks = useMemo( () => {
		if ( ! inViewport ) {
			return null;
		}
		return toPreviewGeometry(
			isPage
				? getBlocks( pattern, scheme )
				: recolorBlocks( parsed, scheme )
		);
	}, [ inViewport, isPage, parsed, pattern, scheme, getBlocks ] );

	// Mount the live preview only while the card is near the viewport, and
	// unmount it once the card scrolls away, so iframes do not accumulate.
	// The root is the grid's scroll container: against the page viewport the
	// container clips cards first and the margin never applies.
	useEffect( () => {
		const el = blockRef.current;
		if ( ! el ) return;
		const observer = new IntersectionObserver(
			( entries ) => {
				// A late delivery can carry several entries: the last is current.
				const { isIntersecting } = entries[ entries.length - 1 ];
				setInViewport( isIntersecting );
				if ( ! isIntersecting ) {
					// Keep the card at its last loaded height while the preview
					// is away, so the CSS columns do not reflow.
					if ( loadedHeight.current ) {
						el.style.minHeight = `${ loadedHeight.current }px`;
					}
					setIsLoaded( false );
				}
			},
			{
				root: el.closest(
					'.sydney-pattern-library-modal-grid-container'
				),
				rootMargin: '300px 0px',
			}
		);
		observer.observe( el );
		return () => observer.disconnect();
	}, [] );

	// A loaded card is exactly as tall as its preview: drop any held height and
	// measure the card. A layout effect, so the first measurement lands before
	// the card can be reported as scrolled away.
	useLayoutEffect( () => {
		if ( ! isLoaded ) return;
		const card = blockRef.current;
		card.style.minHeight = '';
		const observer = new ResizeObserver( ( entries ) => {
			loadedHeight.current = entries[ 0 ].borderBoxSize[ 0 ].blockSize;
		} );
		observer.observe( card );
		return () => observer.disconnect();
	}, [ isLoaded ] );

	// A Full page card scrolls its preview on hover by the part the card hides,
	// at a steady speed.
	useLayoutEffect( () => {
		if ( ! isPage || ! isLoaded ) return;
		const card = blockRef.current;
		const observer = new ResizeObserver( () => {
			const scroll = Math.max(
				0,
				pageScrollRef.current.offsetHeight - PAGE_CARD_HEIGHT
			);
			card.style.setProperty( '--sydney-page-scroll', `${ scroll }px` );
			card.style.setProperty(
				'--sydney-page-scroll-duration',
				`${ scroll / PAGE_SCROLL_SPEED }s`
			);
		} );
		observer.observe( pageScrollRef.current );
		return () => observer.disconnect();
	}, [ isPage, isLoaded ] );

	const livePreview = inViewport ? (
		<LivePreview
			blocks={ blocks }
			containerRef={ blockRef }
			onLoad={ handleLoad }
		/>
	) : (
		<div
			className="sydney-pattern-library-pattern-skeleton"
			aria-hidden="true"
		/>
	);
	const preview = isPage ? (
		<div
			ref={ pageScrollRef }
			className="sydney-pattern-library-page-scroll"
		>
			{ livePreview }
		</div>
	) : (
		livePreview
	);

	return (
		<div
			ref={ blockRef }
			className={ `sydney-pattern-library-pattern-item${
				isLoaded ? ' is-loaded' : ''
			}${ isLocked ? ' is-locked' : '' }${ isPage ? ' is-page' : '' }` }
		>
			{ isLocked ? (
				// A locked card previews only: clicking it inserts nothing.
				<div
					className="sydney-pattern-library-pattern-item__preview"
					role="group"
					aria-label={ pattern.title }
				>
					<span className="sydney-pattern-library-pro-badge">
						{ __( 'Pro', 'sydney' ) }
					</span>
					{ preview }
					<div className="sydney-pattern-library-upgrade-overlay">
						<p className="sydney-pattern-library-upgrade-text">
							{ isPage
								? __(
										'This page is available in Sydney Pro',
										'sydney'
								  )
								: __(
										'This pattern is available in Sydney Pro',
										'sydney'
								  ) }
						</p>
						<a
							className="components-button is-primary"
							href={ upgradeUrl }
							target="_blank"
							rel="noopener noreferrer"
						>
							{ __( 'Upgrade', 'sydney' ) }
						</a>
					</div>
				</div>
			) : (
				<>
					<FavoriteToggle patternName={ pattern.name } />
					<button
						type="button"
						className="sydney-pattern-library-pattern-item__action"
						aria-label={ pattern.title }
						onClick={ () => onClick( pattern ) }
					>
						{ preview }
					</button>
				</>
			) }
		</div>
	);
}

// Core's BlockPreview gives every mount a child data registry that subscribes
// to its parent registry and never unsubscribes, so each preview that ever
// mounted would stay reachable from the editor. Each preview gets its own view
// of the registry instead: the view records those store-less subscriptions and
// drops them when the preview unmounts. Store-specific subscriptions (useSelect)
// pass through untouched, since their callers already unsubscribe.
function createPreviewRegistry( registry ) {
	const unsubscribes = new Set();
	const view = Object.create( registry );

	view.subscribe = ( listener, storeNameOrDescriptor ) => {
		const unsubscribe = registry.subscribe(
			listener,
			storeNameOrDescriptor
		);
		if ( storeNameOrDescriptor ) {
			return unsubscribe;
		}
		unsubscribes.add( unsubscribe );
		return () => {
			unsubscribes.delete( unsubscribe );
			unsubscribe();
		};
	};

	return {
		registry,
		view,
		release() {
			unsubscribes.forEach( ( unsubscribe ) => unsubscribe() );
			unsubscribes.clear();
		},
	};
}

function usePreviewRegistry() {
	const registry = useRegistry();

	// One view per mount: BlockPreview caches its child registry by the registry
	// it receives, so a new view per render would build a new child each time.
	// A ref guarantees that identity, which useMemo does not.
	const scopedRef = useRef( null );
	if ( ! scopedRef.current || scopedRef.current.registry !== registry ) {
		scopedRef.current = createPreviewRegistry( registry );
	}
	const scoped = scopedRef.current;

	useEffect( () => {
		return () => {
			scoped.release();
		};
	}, [ scoped ] );

	return scoped.view;
}

function LivePreview( { blocks, containerRef, onLoad } ) {
	const [ isLoaded, setIsLoaded ] = useState( false );
	const previewRegistry = usePreviewRegistry();

	// Drop the skeleton once the BlockPreview iframe has loaded and laid out
	// its content. The preview container has no height until core has measured
	// that content; the iframe's own readyState is already 'complete' on the
	// blank document it starts with, well before the pattern renders.
	useEffect( () => {
		let done = false;

		function handleLoad() {
			if ( ! done ) {
				done = true;
				setIsLoaded( true );
			}
		}

		// Safety: unblock after 8 s if the preview never lays out, or never
		// renders (core renders nothing for an empty block list).
		const timeout = setTimeout( handleLoad, 8000 );

		const container = containerRef.current?.querySelector(
			'.block-editor-block-preview__container'
		);
		let observer;
		if ( container ) {
			observer = new ResizeObserver( ( entries ) => {
				if ( entries[ 0 ].contentRect.height > 0 ) handleLoad();
			} );
			observer.observe( container );
		}

		return () => {
			// Unmounted: a late layout must not set state.
			done = true;
			if ( observer ) observer.disconnect();
			clearTimeout( timeout );
		};
	}, [ containerRef ] );

	// Tell the card from the commit that shows the loaded preview, so a load
	// that lands as the card scrolls away never reaches it after the unmount.
	useLayoutEffect( () => {
		if ( isLoaded ) onLoad();
	}, [ isLoaded, onLoad ] );

	return (
		<>
			<RegistryProvider value={ previewRegistry }>
				<BlockPreview
					blocks={ blocks }
					viewportWidth={ 1600 }
					additionalStyles={ [
						{
							css: '.is-root-container > .wp-block-cover,.is-root-container > .wp-block-group { max-width: 100% !important;margin-bottom: 0 !important; }',
						},
					] }
				/>
			</RegistryProvider>
			{ ! isLoaded && (
				<div
					className="sydney-pattern-library-pattern-skeleton"
					aria-hidden="true"
				/>
			) }
		</>
	);
}
