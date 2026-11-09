import {
	Modal,
	Button,
	SearchControl,
	ToggleControl,
	__experimentalHStack as HStack,
	__experimentalVStack as VStack,
} from '@wordpress/components';
import { close } from '@wordpress/icons';
import apiFetch from '@wordpress/api-fetch';
import { useSelect, useDispatch } from '@wordpress/data';
import {
	useCallback,
	useEffect,
	useLayoutEffect,
	useMemo,
	useRef,
} from '@wordpress/element';
import { __, sprintf } from '@wordpress/i18n';
import { STORE_NAME } from '../store/index.js';
import { TYPE_ORDER } from '../constants.js';
import { TypeFilter } from './TypeFilter.js';
import { PatternGrid } from './PatternGrid.js';
import { ColorSchemeSwatches } from './ColorSchemeSwatches.js';
import { getItemBlocks } from '../pattern-blocks.js';
import { toLibraryItem } from '../full-pages.js';
import { useFullPages, useProPatterns } from '../use-library-data.js';

// Full page types: each page lists under the category `page-<slug>`.
const PAGE_TYPES = window.sydneyPatternLibrary?.pageTypes || [];
const PAGE_ORDER = PAGE_TYPES.map( ( { slug } ) => `page-${ slug }` );
const PAGE_LABELS = new Map(
	PAGE_TYPES.map( ( { slug, label } ) => [ `page-${ slug }`, label ] )
);

export function PatternLibraryModal( { onClose, onInsert } ) {
	// isResolving becomes false once the core pattern registry has finished loading.
	const { patterns, isLoading } = useSelect( ( select ) => {
		const resolving = select( 'core' ).isResolving( 'getBlockPatterns' );
		return {
			patterns: select( 'core' ).getBlockPatterns() || [],
			isLoading: resolving,
		};
	} );

	const searchQuery = useSelect( ( select ) =>
		select( STORE_NAME ).getSearchQuery()
	);
	const selectedType = useSelect( ( select ) =>
		select( STORE_NAME ).getSelectedType()
	);
	const favorites = useSelect( ( select ) =>
		select( STORE_NAME ).getFavorites()
	);
	const recentlyUsed = useSelect( ( select ) =>
		select( STORE_NAME ).getRecentlyUsed()
	);
	const autoOpen = useSelect( ( select ) =>
		select( STORE_NAME ).getAutoOpen()
	);
	const colorScheme = useSelect( ( select ) =>
		select( STORE_NAME ).getColorScheme()
	);
	const activeTab = useSelect( ( select ) =>
		select( STORE_NAME ).getActiveTab()
	);
	const {
		setSearch,
		setType,
		trackPatternInsert,
		setAutoOpen,
		setColorScheme,
		setActiveTab,
	} = useDispatch( STORE_NAME );
	const categories = useSelect(
		( select ) => select( 'core' ).getBlockPatternCategories(),
		[]
	);
	const categoryLabels = useMemo(
		() =>
			new Map(
				( categories || [] ).map( ( { name, label } ) => [
					name,
					label,
				] )
			),
		[ categories ]
	);

	const { items: proPatterns, isLoading: isLoadingPro } = useProPatterns();
	const { items: fullPages } = useFullPages();

	const sydneyPatterns = useMemo(
		() => [
			...patterns.filter( ( p ) => p.name?.startsWith( 'sydney/' ) ),
			...proPatterns,
		],
		[ patterns, proPatterns ]
	);
	const patternsByName = useMemo(
		() => new Map( sydneyPatterns.map( ( p ) => [ p.name, p ] ) ),
		[ sydneyPatterns ]
	);

	// A Full page lists only when every section it names is loaded, so an
	// insert is never partial.
	const pageItems = useMemo(
		() =>
			fullPages
				.filter(
					( page ) =>
						page.sections?.length > 0 &&
						page.sections.every( ( section ) =>
							patternsByName.has( section.pattern )
						)
				)
				.map( ( page ) =>
					toLibraryItem(
						page,
						PAGE_LABELS.get( `page-${ page.page_type }` ) ||
							page.page_type
					)
				),
		[ fullPages, patternsByName ]
	);

	const showPagesTab = pageItems.length > 0;
	const isPagesTab = showPagesTab && activeTab === 'pages';
	// A new category or tab starts its grid at the top, not at the scroll
	// position of the last one. A layout effect, so the old position is never
	// painted.
	const gridRef = useRef( null );
	useLayoutEffect( () => {
		gridRef.current.scrollTop = 0;
	}, [ selectedType, isPagesTab ] );
	const items = isPagesTab ? pageItems : sydneyPatterns;
	const getBlocks = useCallback(
		( item, scheme ) => getItemBlocks( item, scheme, patternsByName ),
		[ patternsByName ]
	);

	// Favorites and Recently used count only the active tab's items.
	const itemNames = new Set( items.map( ( item ) => item.name ) );
	const tabFavoritesCount = favorites.filter( ( name ) =>
		itemNames.has( name )
	).length;
	const isFavoritesActive = selectedType === 'favorites';
	const showFavoritesFilter = tabFavoritesCount > 0;

	// Leave Favorites once the active tab has none left, so its view is never
	// an empty grid. The store does this only when no favorite is left at all.
	useEffect( () => {
		if ( isFavoritesActive && tabFavoritesCount === 0 ) {
			setType( 'all' );
		}
	}, [ isFavoritesActive, tabFavoritesCount, setType ] );

	const isRecentActive = selectedType === 'recent';
	const showRecentFilter =
		recentlyUsed.some( ( name ) => itemNames.has( name ) ) ||
		isRecentActive;

	function handleInsert( item ) {
		const blocks = getBlocks( item, colorScheme );
		trackPatternInsert( item.name );
		apiFetch( {
			path: '/sydney/v1/pattern-insert',
			method: 'POST',
			data: { pattern: item.name },
		} ).catch( ( error ) => {
			// Quiet failure — usage telemetry is never load-bearing for the insert.
			// eslint-disable-next-line no-console
			console.error(
				'Sydney pattern library: failed to track pattern insert',
				error
			);
		} );
		// A Full page goes after everything on the page, never into a selected block.
		onInsert( blocks, item.kind === 'page' );
	}

	return (
		<Modal
			onRequestClose={ onClose }
			className="sydney-pattern-library-modal"
			__experimentalHideHeader={ true }
			size="fill"
		>
			<HStack
				spacing={ 0 }
				alignment="flex-start"
				expanded
				className="sydney-pattern-library-modal-container"
			>
				<VStack
					className="sydney-pattern-library-modal-sidebar"
					alignment="top"
				>
					<div className="sydney-pattern-library-modal-title-container">
						<h2 className="sydney-pattern-library-modal-title">
							<svg
								width="35"
								height="36"
								viewBox="0 0 35 36"
								fill="none"
								xmlns="http://www.w3.org/2000/svg"
							>
								<path
									d="M17.7169 0H34.3047V18.119L17.7169 0ZM0.161307 10.6334H0C0 7.00073 1.00369 4.32034 3.01107 2.59221C5.01846 0.86407 8.11017 0 12.2863 0L34.3047 26.2925C34.3047 29.7841 33.3459 32.2793 31.428 33.7782C29.564 35.2417 26.5171 35.9735 22.2873 35.9735L0.161307 10.6334ZM0.0806536 17.7752L16.0501 36H0.0806536V17.7752Z"
									fill="#3c3c3c"
								/>
							</svg>
							{ __( 'Pattern Library', 'sydney' ) }
						</h2>
					</div>
					<div className="sydney-pattern-library-modal-sidebar-content">
						{ showPagesTab && (
							<div
								className="sydney-pattern-library-tabs"
								role="tablist"
							>
								<Button
									role="tab"
									aria-selected={ ! isPagesTab }
									onClick={ () => setActiveTab( 'patterns' ) }
								>
									{ __( 'Patterns', 'sydney' ) }
								</Button>
								<Button
									role="tab"
									aria-selected={ isPagesTab }
									onClick={ () => setActiveTab( 'pages' ) }
								>
									{ __( 'Pages', 'sydney' ) }
								</Button>
							</div>
						) }
						{ /* The Pages tab has no search for now: drop the ! isPagesTab check to bring it back. */ }
						{ ! isPagesTab && (
							<div className="sydney-pattern-library-modal-search">
								<SearchControl
									value={ searchQuery }
									onChange={ setSearch }
									placeholder={
										isPagesTab
											? __( 'Search pages', 'sydney' )
											: __( 'Search patterns', 'sydney' )
									}
									__nextHasNoMarginBottom
								/>
							</div>
						) }
						<TypeFilter
							items={ items }
							labels={ isPagesTab ? PAGE_LABELS : categoryLabels }
							order={ isPagesTab ? PAGE_ORDER : TYPE_ORDER }
						/>
					</div>
					{ ! isPagesTab && (
						<div className="sydney-pattern-library-sidebar-footer">
							<ColorSchemeSwatches
								value={ colorScheme }
								onChange={ setColorScheme }
							/>
						</div>
					) }
				</VStack>
				<div className="sydney-pattern-library-modal-content">
					<HStack
						spacing={ 4 }
						alignment="center"
						justify="space-between"
						className="sydney-pattern-library-modal-header"
					>
						<div className="sydney-pattern-library-modal-header-left">
							{ showRecentFilter && (
								<button
									type="button"
									className={ `sydney-pattern-library-recently-used-filter${
										isRecentActive ? ' is-active' : ''
									}` }
									aria-pressed={ isRecentActive }
									onClick={ () =>
										setType(
											isRecentActive ? 'all' : 'recent'
										)
									}
								>
									<svg
										width="14"
										height="14"
										viewBox="0 0 24 24"
										fill="none"
										stroke="currentColor"
										strokeWidth="2"
										strokeLinecap="round"
										strokeLinejoin="round"
										aria-hidden="true"
										focusable="false"
									>
										<polyline points="1 4 1 10 7 10" />
										<path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10" />
									</svg>
									{ __( 'Recently used', 'sydney' ) }
								</button>
							) }
							{ showFavoritesFilter && (
								<button
									type="button"
									className={ `sydney-pattern-library-favorites-filter${
										isFavoritesActive ? ' is-active' : ''
									}` }
									aria-pressed={ isFavoritesActive }
									onClick={ () =>
										setType(
											isFavoritesActive
												? 'all'
												: 'favorites'
										)
									}
								>
									<svg
										width="14"
										height="14"
										viewBox="0 0 24 24"
										fill={
											isFavoritesActive
												? 'currentColor'
												: 'none'
										}
										stroke="currentColor"
										strokeWidth="2"
										strokeLinecap="round"
										strokeLinejoin="round"
										aria-hidden="true"
										focusable="false"
									>
										<path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" />
									</svg>
									{ sprintf(
										/* translators: %d: number of favorited patterns */
										__( 'Favorites (%d)', 'sydney' ),
										tabFavoritesCount
									) }
								</button>
							) }
						</div>
						<div className="sydney-pattern-library-modal-header-right">
							<ToggleControl
								label={ __(
									'Open Pattern Library when creating new pages',
									'sydney'
								) }
								checked={ autoOpen }
								onChange={ setAutoOpen }
								__nextHasNoMarginBottom
							/>
							<Button
								icon={ close }
								onClick={ onClose }
								label={ __( 'Close', 'sydney' ) }
							/>
						</div>
					</HStack>
					<div
						ref={ gridRef }
						className="sydney-pattern-library-modal-grid-container"
					>
						<PatternGrid
							patterns={ items }
							searchQuery={ isPagesTab ? '' : searchQuery }
							typeOrder={ isPagesTab ? PAGE_ORDER : TYPE_ORDER }
							getBlocks={ getBlocks }
							isLoading={ isLoading || isLoadingPro }
							onInsert={ handleInsert }
						/>
					</div>
				</div>
			</HStack>
		</Modal>
	);
}
