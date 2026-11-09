import { createRoot } from '@wordpress/element';
import { useEffect } from '@wordpress/element';
import { registerPlugin } from '@wordpress/plugins';
import {
	dispatch,
	select as selectStore,
	subscribe,
	useDispatch,
	useSelect,
} from '@wordpress/data';
import { store as blockEditorStore } from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';
import './index.css';
import './store/index.js';
import { STORE_NAME } from './store/index.js';
import { PatternLibraryModal } from './components/PatternLibraryModal.js';

// Sydney Canvas: no page title, no sidebar, full width content.
const CANVAS_TEMPLATE = 'page-templates/page_front-page.php';

function render( component, node ) {
	createRoot( node ).render( component );
}

function MainButton() {
	const { openModal } = useDispatch( STORE_NAME );

	return (
		<div
			role="button"
			tabIndex={ 0 }
			aria-label={ __( 'Pattern Library', 'sydney' ) }
			onClick={ () => openModal() }
			onKeyDown={ ( event ) => {
				if ( event.key === 'Enter' || event.key === ' ' ) {
					event.preventDefault();
					openModal();
				}
			} }
			className="components-button is-secondary sydney-pattern-library-toolbar-btn"
			style={ { marginLeft: '8px' } }
		>
			<svg
				width="16"
				height="16"
				viewBox="0 0 35 36"
				fill="none"
				xmlns="http://www.w3.org/2000/svg"
			>
				<path
					d="M17.7169 0H34.3047V18.119L17.7169 0ZM0.161307 10.6334H0C0 7.00073 1.00369 4.32034 3.01107 2.59221C5.01846 0.86407 8.11017 0 12.2863 0L34.3047 26.2925C34.3047 29.7841 33.3459 32.2793 31.428 33.7782C29.564 35.2417 26.5171 35.9735 22.2873 35.9735L0.161307 10.6334ZM0.0806536 17.7752L16.0501 36H0.0806536V17.7752Z"
					fill="currentColor"
				/>
			</svg>
			<span className="sydney-pattern-library-toolbar-btn-text">
				{ __( 'Pattern Library', 'sydney' ) }
			</span>
		</div>
	);
}

export function Modal() {
	const { closeModal } = useDispatch( STORE_NAME );
	const { insertBlocks } = useDispatch( blockEditorStore );
	const isOpen = useSelect( ( select ) =>
		select( STORE_NAME ).isModalOpen()
	);

	// A Full page appends at the end of the page root, whatever block is
	// selected, and switches a page to Sydney Canvas when the page offers it.
	function handleInsert( blocks, isFullPage = false ) {
		insertBlocks(
			blocks,
			isFullPage
				? selectStore( blockEditorStore ).getBlockCount()
				: undefined
		);
		const editor = selectStore( 'core/editor' );
		if (
			isFullPage &&
			editor?.getCurrentPostType() === 'page' &&
			editor.getEditorSettings().availableTemplates?.[ CANVAS_TEMPLATE ]
		) {
			dispatch( 'core/editor' ).editPost( { template: CANVAS_TEMPLATE } );
		}
		closeModal();
	}

	return (
		isOpen && (
			<PatternLibraryModal
				onClose={ closeModal }
				onInsert={ handleInsert }
			/>
		)
	);
}

// The library decides once per editor load whether to open itself.
let hasDecidedAutoOpen = false;
let stopWatchingEditor = null;

// Open the library on a new page when the user wants it. Posts, existing pages
// and editors without the core/editor store never open it. The decision waits
// until the editor has resolved the post and the Welcome Guide is closed, then
// is made exactly once.
function maybeAutoOpen() {
	if ( hasDecidedAutoOpen || stopWatchingEditor ) {
		return;
	}

	function decide() {
		if ( hasDecidedAutoOpen ) {
			return true;
		}
		const editor = selectStore( 'core/editor' );
		if ( ! editor ) {
			hasDecidedAutoOpen = true;
			return true;
		}
		const postType = editor.getCurrentPostType();
		if ( ! postType || ! editor.getCurrentPostId() ) {
			return false;
		}
		// A first-time editor visit shows WordPress's Welcome Guide: keep waiting
		// until it closes so the library does not open on top of it.
		const preferences = selectStore( 'core/preferences' );
		if ( preferences && preferences.get( 'core/edit-post', 'welcomeGuide' ) ) {
			return false;
		}
		hasDecidedAutoOpen = true;
		if (
			postType === 'page' &&
			editor.isEditedPostNew() &&
			selectStore( STORE_NAME ).getAutoOpen()
		) {
			dispatch( STORE_NAME ).openModal();
		}
		return true;
	}

	if ( decide() ) {
		return;
	}
	const unsubscribe = subscribe( () => {
		if ( decide() ) {
			unsubscribe();
			stopWatchingEditor = null;
		}
	} );
	stopWatchingEditor = unsubscribe;
}

const LibraryButton = () => {
	useEffect( () => {
		const btnId = 'sydney-pattern-library-btn';
		const mdlId = 'sydney-pattern-library-modal';
		const toolbar = '.editor-document-tools';
		if ( document.getElementById( btnId ) ) return;

		const timeoutId = setTimeout( () => {
			if ( document.getElementById( btnId ) ) return;
			const btnWrap = document.createElement( 'div' );
			const btn = Object.assign( btnWrap, { id: btnId } );
			document.querySelector( toolbar )?.after( btn );
			render( <MainButton />, btn );

			if ( document.getElementById( mdlId ) ) return;
			const modalWrap = document.createElement( 'div' );
			const modal = Object.assign( modalWrap, { id: mdlId } );
			document.body.append( modal );
			render( <Modal />, modal );
			maybeAutoOpen();
		}, 300 );
		return () => {
			clearTimeout( timeoutId );
			stopWatchingEditor?.();
			stopWatchingEditor = null;
		};
	}, [] );
	return null;
};

registerPlugin( 'sydney-pattern-library', {
	render: () => <LibraryButton />,
} );
