# Sydney Studio Pattern Library Implementation Plan

> **For Claude:** REQUIRED SUB-SKILL: Use superpowers:executing-plans to implement this plan task-by-task.

**Goal:** Add a "Sydney Studio" button to the WordPress block editor toolbar that opens a modal pattern library with collection and type filtering, blob iframe previews, Pro pattern upsell, and smart suggestions toast.

**Architecture:** A Sydney module at `inc/modules/pattern-library/` with a PHP class for pattern registration and asset enqueuing, a PHP config for collection metadata, and a React JS app compiled via `@wordpress/scripts`. Patterns are registered natively with WP core via `register_block_pattern()` so the REST API serves them; collection assignments are passed via `wp_localize_script`. The modal uses WP core `BlockPatternsList` + `Modal` components.

**Tech Stack:** PHP 7.2+, WordPress block editor APIs, `@wordpress/scripts` (build), `@wordpress/components` (Modal, Button, Snackbar, etc.), `@wordpress/block-editor` (BlockPatternsList), `@wordpress/plugins` (registerPlugin), `@wordpress/data` (store)

**Design doc:** `docs/plans/2026-02-18-sydney-studio-design.md`

---

## Task 1: Module registration + PHP scaffold

**Files:**
- Create: `inc/modules/pattern-library/class-sydney-pattern-library.php`
- Modify: `functions.php` (line ~691, add require after hf-builder line)
- Modify: `inc/modules/class-sydney-modules.php` (add pattern-library to get_modules array)

**Step 1: Create the main module class**

```php
<?php
/**
 * Sydney Studio - Pattern Library module
 *
 * @package Sydney
 */

if ( ! Sydney_Modules::is_module_active( 'pattern-library' ) ) {
	return;
}

if ( ! class_exists( 'Sydney_Pattern_Library' ) ) {

	/**
	 * Sydney Pattern Library
	 */
	class Sydney_Pattern_Library {

		/**
		 * Instance
		 *
		 * @var Sydney_Pattern_Library
		 */
		private static $instance;

		/**
		 * Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() {
			add_action( 'init', array( $this, 'register_patterns' ) );
			add_action( 'enqueue_block_editor_assets', array( $this, 'enqueue_assets' ) );
		}

		/**
		 * Register block patterns
		 */
		public function register_patterns() {
			$patterns_dir = get_template_directory() . '/inc/modules/pattern-library/patterns/';
			if ( ! is_dir( $patterns_dir ) ) {
				return;
			}
			foreach ( glob( $patterns_dir . '*.php' ) as $pattern_file ) {
				require $pattern_file;
			}
		}

		/**
		 * Enqueue block editor assets
		 */
		public function enqueue_assets() {
			$asset_file = get_template_directory() . '/inc/modules/pattern-library/build/index.asset.php';

			if ( ! file_exists( $asset_file ) ) {
				return;
			}

			$asset = require $asset_file;

			wp_enqueue_script(
				'sydney-studio',
				get_template_directory_uri() . '/inc/modules/pattern-library/build/index.js',
				$asset['dependencies'],
				$asset['version'],
				true
			);

			require get_template_directory() . '/inc/modules/pattern-library/patterns-config.php';

			wp_localize_script(
				'sydney-studio',
				'sydneyStudio',
				array(
					'collections'        => $sydney_studio_collections,
					'patternCollections' => $sydney_studio_pattern_collections,
					'isPro'              => defined( 'SYDNEY_PRO_VERSION' ),
					'upgradeUrl'         => 'https://athemes.com/sydney-pro/',
				)
			);
		}
	}

	Sydney_Pattern_Library::get_instance();
}
```

**Step 2: Register the module in `class-sydney-modules.php`**

In the `get_modules()` method, inside the `$modules['general']` array, add after the `block-templates` entry:

```php
array(
    'slug'         => 'pattern-library',
    'name'         => esc_html__( 'Sydney Studio', 'sydney' ),
    'type'         => 'free',
    'link'         => '',
    'link_label'   => '',
    'activate_uri' => '&amp;activate_module_pattern-library',
    'text'         => __( 'Browse and insert Sydney patterns directly from the block editor.', 'sydney' ),
    'keywords'     => array( 'patterns', 'studio', 'block editor', 'library' ),
),
```

**Step 3: Require the module in `functions.php`**

After line 691 (the hf-builder require), add:

```php
require get_template_directory() . '/inc/modules/pattern-library/class-sydney-pattern-library.php';
```

**Step 4: Commit**

```bash
git add inc/modules/pattern-library/class-sydney-pattern-library.php inc/modules/class-sydney-modules.php functions.php
git commit -m "feat: scaffold Sydney Studio pattern library module"
```

---

## Task 2: Patterns config + pattern registration files

**Files:**
- Create: `inc/modules/pattern-library/patterns-config.php`
- Create: `inc/modules/pattern-library/patterns/hero-1.php`
- Create: `inc/modules/pattern-library/patterns/hero-2.php`
- Create: `inc/modules/pattern-library/patterns/hero-3.php`
- Create: `inc/modules/pattern-library/patterns/cta-1.php`
- Create: `inc/modules/pattern-library/patterns/cta-2.php`
- Create: `inc/modules/pattern-library/patterns/cta-3.php`
- Create: `inc/modules/pattern-library/patterns/team-1.php`
- Create: `inc/modules/pattern-library/patterns/testimonials-1.php`
- Create: `inc/modules/pattern-library/patterns/features-1.php`

**Step 1: Create pattern categories**

WP requires categories to exist before patterns reference them. Register custom pattern categories in `class-sydney-pattern-library.php` inside the `register_patterns()` method, before the glob loop:

```php
// Register pattern categories (types)
$categories = array(
    'sydney-hero'         => __( 'Hero', 'sydney' ),
    'sydney-cta'          => __( 'CTA', 'sydney' ),
    'sydney-team'         => __( 'Team', 'sydney' ),
    'sydney-testimonials' => __( 'Testimonials', 'sydney' ),
    'sydney-features'     => __( 'Features', 'sydney' ),
);

foreach ( $categories as $slug => $label ) {
    if ( ! WP_Block_Pattern_Categories_Registry::get_instance()->is_registered( $slug ) ) {
        register_block_pattern_category( $slug, array( 'label' => $label ) );
    }
}
```

**Step 2: Create `patterns-config.php`**

```php
<?php
/**
 * Sydney Studio - collections config
 *
 * @package Sydney
 */

$sydney_studio_collections = array(
	'local-services' => __( 'Local Services', 'sydney' ),
	'digital'        => __( 'Digital', 'sydney' ),
	'corporate'      => __( 'Corporate', 'sydney' ),
);

$sydney_studio_pattern_collections = array(
	'sydney/hero-1'         => array( 'local-services', 'corporate' ),
	'sydney/hero-2'         => array( 'digital' ),
	'sydney/hero-3'         => array( 'local-services' ),
	'sydney/cta-1'          => array( 'digital', 'corporate' ),
	'sydney/cta-2'          => array( 'local-services' ),
	'sydney/cta-3'          => array( 'corporate' ),
	'sydney/team-1'         => array( 'corporate' ),
	'sydney/testimonials-1' => array( 'local-services', 'digital' ),
	'sydney/features-1'     => array( 'digital' ),
);
```

**Step 3: Create placeholder pattern files**

Each pattern file follows this structure. Use simple placeholder block markup. Example `patterns/hero-1.php`:

```php
<?php
/**
 * Pattern: Hero 1
 *
 * @package Sydney
 */

register_block_pattern(
	'sydney/hero-1',
	array(
		'title'      => __( 'Hero 1', 'sydney' ),
		'categories' => array( 'sydney-hero' ),
		'content'    => '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"80px","bottom":"80px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull">
	<!-- wp:heading {"level":1} -->
	<h1>Welcome to Our Services</h1>
	<!-- /wp:heading -->
	<!-- wp:paragraph -->
	<p>We provide top-quality local services tailored to your needs.</p>
	<!-- /wp:paragraph -->
	<!-- wp:buttons -->
	<div class="wp-block-buttons">
		<!-- wp:button -->
		<div class="wp-block-button"><a class="wp-block-button__link">Get Started</a></div>
		<!-- /wp:button -->
	</div>
	<!-- /wp:buttons -->
</div>
<!-- /wp:group -->',
	)
);
```

Follow the same structure for the other 8 patterns, adjusting `name`, `title`, `categories` (use the appropriate `sydney-*` category slug), and placeholder content appropriately:

- `hero-2.php` — category `sydney-hero`, title "Hero 2"
- `hero-3.php` — category `sydney-hero`, title "Hero 3"
- `cta-1.php` — category `sydney-cta`, title "CTA 1"
- `cta-2.php` — category `sydney-cta`, title "CTA 2"
- `cta-3.php` — category `sydney-cta`, title "CTA 3"
- `team-1.php` — category `sydney-team`, title "Team 1"
- `testimonials-1.php` — category `sydney-testimonials`, title "Testimonials 1"
- `features-1.php` — category `sydney-features`, title "Features 1"

**Step 4: Verify patterns register**

Enable the module in WP admin (Appearance → Sydney Dashboard → Modules → activate Sydney Studio), then open the block editor and check: WP Patterns panel should list categories `Hero`, `CTA`, etc. with Sydney patterns inside.

**Step 5: Commit**

```bash
git add inc/modules/pattern-library/patterns-config.php inc/modules/pattern-library/patterns/
git commit -m "feat: add pattern registration and collection config for Sydney Studio"
```

---

## Task 3: Build setup (`@wordpress/scripts`)

**Files:**
- Create: `inc/modules/pattern-library/package.json`
- Create: `inc/modules/pattern-library/.gitignore`

**Step 1: Create `package.json`**

```json
{
  "name": "sydney-studio",
  "version": "1.0.0",
  "private": true,
  "scripts": {
    "build": "wp-scripts build src/index.js --output-path=build",
    "start": "wp-scripts start src/index.js --output-path=build"
  },
  "devDependencies": {
    "@wordpress/scripts": "^30.0.0"
  }
}
```

**Step 2: Create `.gitignore`**

```
node_modules/
```

**Step 3: Install dependencies**

```bash
cd inc/modules/pattern-library
npm install
```

Expected: `node_modules/` created, `package-lock.json` created.

**Step 4: Create minimal entry point to verify build works**

Create `src/index.js`:

```js
console.log( 'Sydney Studio loaded' );
```

**Step 5: Run build**

```bash
npm run build
```

Expected: `build/index.js` and `build/index.asset.php` created.

**Step 6: Commit**

```bash
cd ../../..  # back to theme root
git add inc/modules/pattern-library/package.json inc/modules/pattern-library/package-lock.json inc/modules/pattern-library/.gitignore inc/modules/pattern-library/build/ inc/modules/pattern-library/src/index.js
git commit -m "feat: add @wordpress/scripts build setup for Sydney Studio"
```

---

## Task 4: wp.data store

**Files:**
- Create: `inc/modules/pattern-library/src/store/index.js`

**Step 1: Create the store**

```js
import { createReduxStore, register } from '@wordpress/data';

const STORE_NAME = 'sydney-studio';

const DEFAULT_STATE = {
	selectedCollection: 'all',
	selectedType: 'all',
};

const actions = {
	setCollection( collection ) {
		return { type: 'SET_COLLECTION', collection };
	},
	setType( patternType ) {
		return { type: 'SET_TYPE', patternType };
	},
};

function reducer( state = DEFAULT_STATE, action ) {
	switch ( action.type ) {
		case 'SET_COLLECTION':
			return { ...state, selectedCollection: action.collection };
		case 'SET_TYPE':
			return { ...state, selectedType: action.patternType };
	}
	return state;
}

const selectors = {
	getSelectedCollection( state ) {
		return state.selectedCollection;
	},
	getSelectedType( state ) {
		return state.selectedType;
	},
};

const store = createReduxStore( STORE_NAME, { reducer, actions, selectors } );
register( store );

export { STORE_NAME };
```

**Step 2: Import store in `src/index.js`**

```js
import './store/index.js';

console.log( 'Sydney Studio loaded' );
```

**Step 3: Build and verify no errors**

```bash
cd inc/modules/pattern-library && npm run build
```

Expected: clean build, no errors.

**Step 4: Commit**

```bash
cd ../../..
git add inc/modules/pattern-library/src/store/index.js inc/modules/pattern-library/src/index.js inc/modules/pattern-library/build/
git commit -m "feat: add wp.data store for Sydney Studio filter state"
```

---

## Task 5: CollectionFilter and TypeFilter components

**Files:**
- Create: `inc/modules/pattern-library/src/components/CollectionFilter.js`
- Create: `inc/modules/pattern-library/src/components/TypeFilter.js`

**Step 1: Create `CollectionFilter.js`**

```js
import { useDispatch, useSelect } from '@wordpress/data';
import { Button, Flex } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import { STORE_NAME } from '../store/index.js';

export function CollectionFilter() {
	const selected = useSelect( ( select ) => select( STORE_NAME ).getSelectedCollection() );
	const { setCollection } = useDispatch( STORE_NAME );
	const collections = window.sydneyStudio?.collections || {};

	const allCollections = [
		{ slug: 'all', label: __( 'All', 'sydney' ) },
		...Object.entries( collections ).map( ( [ slug, label ] ) => ( { slug, label } ) ),
	];

	return (
		<Flex gap={ 2 } wrap>
			{ allCollections.map( ( { slug, label } ) => (
				<Button
					key={ slug }
					variant={ selected === slug ? 'primary' : 'secondary' }
					onClick={ () => setCollection( slug ) }
				>
					{ label }
				</Button>
			) ) }
		</Flex>
	);
}
```

**Step 2: Create `TypeFilter.js`**

```js
import { useDispatch, useSelect } from '@wordpress/data';
import { Button, Flex } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import { STORE_NAME } from '../store/index.js';

export function TypeFilter( { patterns } ) {
	const selected = useSelect( ( select ) => select( STORE_NAME ).getSelectedType() );
	const { setType } = useDispatch( STORE_NAME );

	// Derive unique types from pattern categories
	const types = [ ...new Set( patterns.flatMap( ( p ) => p.categories || [] ) ) ];

	const allTypes = [
		{ slug: 'all', label: __( 'All', 'sydney' ) },
		...types.map( ( slug ) => ( {
			slug,
			label: slug.replace( 'sydney-', '' ).replace( /-/g, ' ' ).replace( /^\w/, ( c ) => c.toUpperCase() ),
		} ) ),
	];

	return (
		<Flex direction="column" gap={ 1 }>
			{ allTypes.map( ( { slug, label } ) => (
				<Button
					key={ slug }
					variant={ selected === slug ? 'primary' : 'tertiary' }
					onClick={ () => setType( slug ) }
				>
					{ label }
				</Button>
			) ) }
		</Flex>
	);
}
```

**Step 3: Build and verify no errors**

```bash
cd inc/modules/pattern-library && npm run build
```

**Step 4: Commit**

```bash
cd ../../..
git add inc/modules/pattern-library/src/components/CollectionFilter.js inc/modules/pattern-library/src/components/TypeFilter.js inc/modules/pattern-library/build/
git commit -m "feat: add CollectionFilter and TypeFilter components"
```

---

## Task 6: PatternGrid component

**Files:**
- Create: `inc/modules/pattern-library/src/components/PatternGrid.js`

**Step 1: Create `PatternGrid.js`**

The `BlockPatternsList` component from `@wordpress/block-editor` expects a `patterns` array and an `onClickPattern` callback.

```js
import { BlockPatternsList } from '@wordpress/block-editor';
import { useSelect } from '@wordpress/data';
import { __ } from '@wordpress/i18n';
import { STORE_NAME } from '../store/index.js';

export function PatternGrid( { patterns, onInsert } ) {
	const selectedCollection = useSelect( ( select ) => select( STORE_NAME ).getSelectedCollection() );
	const selectedType = useSelect( ( select ) => select( STORE_NAME ).getSelectedType() );
	const patternCollections = window.sydneyStudio?.patternCollections || {};
	const isPro = window.sydneyStudio?.isPro || false;
	const upgradeUrl = window.sydneyStudio?.upgradeUrl || '';

	const filtered = patterns.filter( ( pattern ) => {
		const inCollection =
			selectedCollection === 'all' ||
			( patternCollections[ pattern.name ] || [] ).includes( selectedCollection );

		const inType =
			selectedType === 'all' ||
			( pattern.categories || [] ).includes( selectedType );

		return inCollection && inType;
	} );

	// Separate free and pro patterns
	const freePatterns = filtered.filter( ( p ) => ! p.sydney_pro );
	const proPatterns = filtered.filter( ( p ) => p.sydney_pro );

	function handleClickPattern( pattern, blocks ) {
		if ( pattern.sydney_pro && ! isPro ) {
			window.open( upgradeUrl, '_blank' );
			return;
		}
		onInsert( pattern, blocks );
	}

	if ( filtered.length === 0 ) {
		return <p>{ __( 'No patterns found.', 'sydney' ) }</p>;
	}

	return (
		<BlockPatternsList
			patterns={ filtered }
			onClickPattern={ handleClickPattern }
			isDraggable={ false }
		/>
	);
}
```

**Note on Pro badge:** `BlockPatternsList` renders each pattern — Pro badge overlay will be added in Task 8 after the modal is wired up and we can see how patterns render. For now the Pro click behavior (open upgrade URL) is handled.

**Step 2: Build and verify**

```bash
cd inc/modules/pattern-library && npm run build
```

**Step 3: Commit**

```bash
cd ../../..
git add inc/modules/pattern-library/src/components/PatternGrid.js inc/modules/pattern-library/build/
git commit -m "feat: add PatternGrid component with collection/type filtering"
```

---

## Task 7: StudioModal component

**Files:**
- Create: `inc/modules/pattern-library/src/components/StudioModal.js`

**Step 1: Create `StudioModal.js`**

```js
import { Modal, Flex, FlexBlock, FlexItem } from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import { store as blockEditorStore } from '@wordpress/block-editor';
import { useDispatch } from '@wordpress/data';
import { store as blockStore } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';
import { CollectionFilter } from './CollectionFilter.js';
import { TypeFilter } from './TypeFilter.js';
import { PatternGrid } from './PatternGrid.js';

export function StudioModal( { onClose, onInsert } ) {
	const patterns = useSelect( ( select ) => {
		// Fetch all registered patterns via the REST store
		return select( 'core' ).getBlockPatterns() || [];
	} );

	// Only show sydney/* patterns
	const sydneyPatterns = patterns.filter( ( p ) => p.name?.startsWith( 'sydney/' ) );

	return (
		<Modal
			title={ __( 'Sydney Studio', 'sydney' ) }
			onRequestClose={ onClose }
			isFullScreen={ false }
			className="sydney-studio-modal"
			size="large"
		>
			<Flex direction="column" gap={ 4 } style={ { height: '100%' } }>
				<FlexItem>
					<CollectionFilter />
				</FlexItem>
				<FlexBlock>
					<Flex gap={ 4 } align="flex-start" style={ { height: '100%' } }>
						<FlexItem style={ { width: '160px', flexShrink: 0 } }>
							<TypeFilter patterns={ sydneyPatterns } />
						</FlexItem>
						<FlexBlock>
							<PatternGrid
								patterns={ sydneyPatterns }
								onInsert={ onInsert }
							/>
						</FlexBlock>
					</Flex>
				</FlexBlock>
			</Flex>
		</Modal>
	);
}
```

**Step 2: Build and verify**

```bash
cd inc/modules/pattern-library && npm run build
```

**Step 3: Commit**

```bash
cd ../../..
git add inc/modules/pattern-library/src/components/StudioModal.js inc/modules/pattern-library/build/
git commit -m "feat: add StudioModal component"
```

---

## Task 8: Toolbar button + plugin registration (wire everything together)

**Files:**
- Modify: `inc/modules/pattern-library/src/index.js`

**Step 1: Update `src/index.js`**

```js
import { registerPlugin } from '@wordpress/plugins';
import { useState } from '@wordpress/element';
import { Button } from '@wordpress/components';
import { useDispatch } from '@wordpress/data';
import { store as blockEditorStore } from '@wordpress/block-editor';
import { createBlocksFromInnerBlocksTemplate, serialize } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';
import './store/index.js';
import { StudioModal } from './components/StudioModal.js';

// Note: The exact slot/fill for top-bar button placement next to the inserter
// needs to be determined during implementation. Try these in order:
// 1. PluginToolbar (from @wordpress/edit-post)
// 2. PluginBlockToolbar
// 3. A custom slot via SlotFillProvider if needed
// The component below uses a generic approach that can be adapted.

import { PluginToolbar } from '@wordpress/edit-post';

function SydneyStudioPlugin() {
	const [ isOpen, setIsOpen ] = useState( false );
	const { insertBlocks } = useDispatch( blockEditorStore );

	function handleInsert( pattern ) {
		// Parse pattern content into blocks and insert
		const { parse } = wp.blocks;
		const blocks = parse( pattern.content );
		insertBlocks( blocks );
		setIsOpen( false );
	}

	return (
		<>
			<PluginToolbar>
				<Button
					variant="tertiary"
					onClick={ () => setIsOpen( true ) }
				>
					{ __( 'Sydney Studio', 'sydney' ) }
				</Button>
			</PluginToolbar>
			{ isOpen && (
				<StudioModal
					onClose={ () => setIsOpen( false ) }
					onInsert={ handleInsert }
				/>
			) }
		</>
	);
}

registerPlugin( 'sydney-studio', {
	render: SydneyStudioPlugin,
} );
```

**Important:** If `PluginToolbar` is not available or doesn't place the button next to the inserter, check the WP source for the correct slot name. Alternatives:
- `PluginPrePublishPanel` (wrong position)
- Check `@wordpress/edit-post` exports for the right toolbar slot
- As a fallback, use `PluginSidebar` with a toggle button in the toolbar

**Step 2: Build**

```bash
cd inc/modules/pattern-library && npm run build
```

**Step 3: Test in the browser**

1. Make sure the module is active (WP Admin → Appearance → Sydney Dashboard → activate Sydney Studio)
2. Open the block editor on any page
3. Look for "Sydney Studio" button in the top toolbar
4. Click it — the modal should open
5. Verify collection pills render (All, Local Services, Digital, Corporate)
6. Verify type filter renders in the sidebar
7. Verify Sydney patterns appear in the grid with previews
8. Click a pattern — it should be inserted into the editor

**Step 4: Commit**

```bash
cd ../../..
git add inc/modules/pattern-library/src/index.js inc/modules/pattern-library/build/
git commit -m "feat: wire toolbar button and plugin registration for Sydney Studio"
```

---

## Task 9: SmartSuggestions component

**Files:**
- Create: `inc/modules/pattern-library/src/components/SmartSuggestions.js`
- Modify: `inc/modules/pattern-library/src/index.js`

**Step 1: Create `SmartSuggestions.js`**

This component listens for pattern insertions and shows a `Snackbar` suggesting related patterns from the same collection.

```js
import { useState, useEffect } from '@wordpress/element';
import { Snackbar } from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import { __ } from '@wordpress/i18n';

// Session-level tracking (resets on page reload)
const dismissedCollections = new Set();
const insertedPatternNames = new Set();

export function SmartSuggestions( { onOpenModal } ) {
	const [ suggestion, setSuggestion ] = useState( null );

	const patternCollections = window.sydneyStudio?.patternCollections || {};
	const collections = window.sydneyStudio?.collections || {};

	// This function is called from index.js after a pattern is inserted
	// We expose it via a simple event so SmartSuggestions stays self-contained
	useEffect( () => {
		function handlePatternInserted( event ) {
			const { patternName, collection } = event.detail;

			if ( ! collection || collection === 'all' || dismissedCollections.has( collection ) ) {
				return;
			}

			insertedPatternNames.add( patternName );

			// Find other patterns in the same collection not yet inserted
			const related = Object.entries( patternCollections )
				.filter( ( [ name, cols ] ) => cols.includes( collection ) && ! insertedPatternNames.has( name ) );

			if ( related.length > 0 ) {
				const collectionLabel = collections[ collection ] || collection;
				setSuggestion( { collection, collectionLabel } );
			}
		}

		window.addEventListener( 'sydney-studio-pattern-inserted', handlePatternInserted );
		return () => window.removeEventListener( 'sydney-studio-pattern-inserted', handlePatternInserted );
	}, [] );

	if ( ! suggestion ) {
		return null;
	}

	return (
		<Snackbar
			onRemove={ () => {
				dismissedCollections.add( suggestion.collection );
				setSuggestion( null );
			} }
			actions={ [
				{
					label: __( 'View patterns', 'sydney' ),
					onClick: () => {
						onOpenModal( suggestion.collection );
						setSuggestion( null );
					},
				},
			] }
		>
			{ /* translators: %s: collection name */ }
			{ __( 'Complete your layout — view more patterns from the same collection.', 'sydney' ) }
		</Snackbar>
	);
}
```

**Step 2: Update `src/index.js` to wire SmartSuggestions**

Import and render `SmartSuggestions`. Dispatch the custom event after insertion. Update the `handleInsert` function and add `SmartSuggestions` to the render:

```js
import { SmartSuggestions } from './components/SmartSuggestions.js';

// Inside SydneyStudioPlugin:
const [ openToCollection, setOpenToCollection ] = useState( null );

function handleInsert( pattern ) {
	const { parse } = wp.blocks;
	const blocks = parse( pattern.content );
	insertBlocks( blocks );

	// Get the active collection from the store
	const activeCollection = wp.data.select( 'sydney-studio' ).getSelectedCollection();

	// Dispatch event for SmartSuggestions
	window.dispatchEvent( new CustomEvent( 'sydney-studio-pattern-inserted', {
		detail: { patternName: pattern.name, collection: activeCollection },
	} ) );

	setIsOpen( false );
}

function handleOpenModalWithCollection( collection ) {
	setOpenToCollection( collection );
	setIsOpen( true );
}

// In the render, pass openToCollection to StudioModal and add SmartSuggestions:
// <StudioModal onClose={...} onInsert={...} initialCollection={openToCollection} />
// <SmartSuggestions onOpenModal={handleOpenModalWithCollection} />
```

Also update `StudioModal.js` to accept and apply `initialCollection` prop — on mount, dispatch `setCollection(initialCollection)` if provided.

**Step 3: Build and test**

```bash
cd inc/modules/pattern-library && npm run build
```

Test: insert a pattern from the Local Services collection. A snackbar should appear offering to show more Local Services patterns. Click "View patterns" — modal should reopen with Local Services pre-selected. Dismiss should not show the toast again for that collection.

**Step 4: Commit**

```bash
cd ../../..
git add inc/modules/pattern-library/src/components/SmartSuggestions.js inc/modules/pattern-library/src/index.js inc/modules/pattern-library/build/
git commit -m "feat: add SmartSuggestions toast for Sydney Studio"
```

---

## Task 10: Pro pattern badge

**Files:**
- Modify: `inc/modules/pattern-library/src/components/PatternGrid.js`

The `BlockPatternsList` renders each pattern in its own container. We need to wrap it to overlay a Pro badge on Pro patterns. Since `BlockPatternsList` doesn't expose per-pattern rendering, we use a CSS approach with a wrapper div + `data-` attributes, or we render a custom grid alongside it.

**Step 1: Add Pro badge via CSS overlay approach**

Update `PatternGrid.js` to split free and pro patterns into two `BlockPatternsList` instances inside a wrapper, with Pro patterns wrapped in a div that has a `data-sydney-pro` attribute:

```js
// Replace the single BlockPatternsList render with:
return (
	<>
		{ freePatterns.length > 0 && (
			<BlockPatternsList
				patterns={ freePatterns }
				onClickPattern={ handleClickPattern }
				isDraggable={ false }
			/>
		) }
		{ proPatterns.length > 0 && (
			<div className="sydney-studio-pro-patterns">
				<BlockPatternsList
					patterns={ proPatterns }
					onClickPattern={ handleClickPattern }
					isDraggable={ false }
				/>
			</div>
		) }
	</>
);
```

**Step 2: Add inline styles for the Pro badge**

In `index.js`, add minimal inline CSS via `wp_add_inline_style` in PHP, or add a `<style>` tag in the React plugin component:

Add to `SydneyStudioPlugin` render:

```js
<style>{ `
	.sydney-studio-pro-patterns .block-editor-block-patterns-list__item::after {
		content: 'Pro';
		position: absolute;
		top: 8px;
		right: 8px;
		background: #1d2327;
		color: #fff;
		font-size: 10px;
		font-weight: 600;
		padding: 2px 6px;
		border-radius: 2px;
		pointer-events: none;
	}
	.sydney-studio-pro-patterns .block-editor-block-patterns-list__item {
		position: relative;
	}
` }</style>
```

**Step 3: Build and test**

```bash
cd inc/modules/pattern-library && npm run build
```

If Pro patterns exist (requires marking a pattern with metadata), verify the "Pro" badge appears. For testing without the Pro plugin: temporarily add `'sydney_pro' => true` to one pattern's registration array.

**Step 4: Commit**

```bash
cd ../../..
git add inc/modules/pattern-library/src/components/PatternGrid.js inc/modules/pattern-library/src/index.js inc/modules/pattern-library/build/
git commit -m "feat: add Pro badge overlay for Sydney Studio pro patterns"
```

---

## Task 11: Final review and cleanup

**Step 1: Run PHPCS**

```bash
composer phpcs
```

Fix any violations (`composer phpcs:fix` for auto-fixable ones).

**Step 2: Verify module can be activated/deactivated**

1. Go to WP Admin → Appearance → Sydney Dashboard → Modules
2. Deactivate Sydney Studio — confirm no JS errors, button disappears from editor
3. Reactivate — confirm everything works

**Step 3: Verify all 9 patterns appear**

Open block editor, open Sydney Studio modal, confirm all 9 patterns show in the "All" view.

**Step 4: Verify collection filter**

Select "Digital" collection — confirm only `hero-2`, `cta-1`, `testimonials-1`, `features-1` appear.

**Step 5: Verify type filter**

Select "Hero" type — confirm only hero patterns appear.

**Step 6: Verify Pro pattern handling**

With `SYDNEY_PRO_VERSION` not defined, click a Pro-badged pattern — confirm it opens the upgrade URL in a new tab rather than inserting.

**Step 7: Final commit**

```bash
git add -A
git commit -m "feat: Sydney Studio pattern library - complete implementation"
```
