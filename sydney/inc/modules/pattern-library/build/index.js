/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./node_modules/@wordpress/icons/build-module/library/close.js"
/*!*********************************************************************!*\
  !*** ./node_modules/@wordpress/icons/build-module/library/close.js ***!
  \*********************************************************************/
(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _wordpress_primitives__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/primitives */ "@wordpress/primitives");
/* harmony import */ var _wordpress_primitives__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_primitives__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react/jsx-runtime */ "react/jsx-runtime");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__);
/**
 * WordPress dependencies
 */


const close = /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(_wordpress_primitives__WEBPACK_IMPORTED_MODULE_0__.SVG, {
  xmlns: "http://www.w3.org/2000/svg",
  viewBox: "0 0 24 24",
  children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(_wordpress_primitives__WEBPACK_IMPORTED_MODULE_0__.Path, {
    d: "m13.06 12 6.47-6.47-1.06-1.06L12 10.94 5.53 4.47 4.47 5.53 10.94 12l-6.47 6.47 1.06 1.06L12 13.06l6.47 6.47 1.06-1.06L13.06 12Z"
  })
});
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (close);
//# sourceMappingURL=close.js.map

/***/ },

/***/ "./src/components/CollectionFilter.js"
/*!********************************************!*\
  !*** ./src/components/CollectionFilter.js ***!
  \********************************************/
(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   CollectionFilter: () => (/* binding */ CollectionFilter)
/* harmony export */ });
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/data */ "@wordpress/data");
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_data__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _store_index_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../store/index.js */ "./src/store/index.js");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! react/jsx-runtime */ "react/jsx-runtime");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__);





function CollectionFilter() {
  const selected = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_0__.useSelect)(select => select(_store_index_js__WEBPACK_IMPORTED_MODULE_3__.STORE_NAME).getSelectedCollection());
  const {
    setCollection
  } = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_0__.useDispatch)(_store_index_js__WEBPACK_IMPORTED_MODULE_3__.STORE_NAME);
  const collections = window.sydneyStudio?.collections || {};
  const options = [{
    key: 'all',
    name: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('All', 'sydney')
  }, ...Object.entries(collections).map(([slug, label]) => ({
    key: slug,
    name: label
  }))];
  function handleChange({
    selectedItem
  }) {
    setCollection(selectedItem.key);
  }
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__.CustomSelectControl, {
    value: options.find(o => o.key === selected),
    options: options,
    onChange: handleChange
  });
}

/***/ },

/***/ "./src/components/PatternGrid.js"
/*!***************************************!*\
  !*** ./src/components/PatternGrid.js ***!
  \***************************************/
(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   PatternGrid: () => (/* binding */ PatternGrid)
/* harmony export */ });
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/block-editor */ "@wordpress/block-editor");
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/blocks */ "@wordpress/blocks");
/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_blocks__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/data */ "@wordpress/data");
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_data__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var _store_index_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../store/index.js */ "./src/store/index.js");
/* harmony import */ var _constants_js__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ../constants.js */ "./src/constants.js");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! react/jsx-runtime */ "react/jsx-runtime");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_7___default = /*#__PURE__*/__webpack_require__.n(react_jsx_runtime__WEBPACK_IMPORTED_MODULE_7__);








function getTypeIndex(pattern) {
  const categories = pattern.categories || [];
  const indices = categories.map(c => _constants_js__WEBPACK_IMPORTED_MODULE_6__.TYPE_ORDER.indexOf(c)).filter(i => i !== -1);
  return indices.length ? Math.min(...indices) : Infinity;
}
function PatternGrid({
  patterns,
  isLoading,
  onInsert
}) {
  const selectedCollection = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_2__.useSelect)(select => select(_store_index_js__WEBPACK_IMPORTED_MODULE_5__.STORE_NAME).getSelectedCollection());
  const selectedType = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_2__.useSelect)(select => select(_store_index_js__WEBPACK_IMPORTED_MODULE_5__.STORE_NAME).getSelectedType());
  const patternCollections = window.sydneyStudio?.patternCollections || {};
  const isPro = window.sydneyStudio?.isPro || false;
  const upgradeUrl = window.sydneyStudio?.upgradeUrl || '';
  const [isFiltering, setIsFiltering] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.useState)(false);
  const isFirstRender = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.useRef)(true);
  (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.useEffect)(() => {
    if (isFirstRender.current) {
      isFirstRender.current = false;
      return;
    }
    setIsFiltering(true);
    const timeout = setTimeout(() => setIsFiltering(false), 600);
    return () => clearTimeout(timeout);
  }, [selectedCollection, selectedType]);
  const filtered = patterns.filter(pattern => {
    const inCollection = selectedCollection === 'all' || (patternCollections[selectedCollection] || []).includes(pattern.name);
    const inType = selectedType === 'all' || (pattern.categories || []).includes(selectedType);
    return inCollection && inType;
  });
  const sorted = [...filtered].sort((a, b) => getTypeIndex(a) - getTypeIndex(b));
  const freePatterns = sorted.filter(p => !p.sydney_pro);
  const proPatterns = sorted.filter(p => p.sydney_pro);
  function handleClickPattern(pattern, blocks) {
    if (pattern.sydney_pro && !isPro) {
      window.open(upgradeUrl, '_blank');
      return;
    }
    onInsert(pattern, blocks);
  }
  if (isLoading) {
    return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_7__.jsxs)("div", {
      className: "sydney-studio-loading-overlay",
      "aria-live": "polite",
      "aria-busy": "true",
      children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_7__.jsx)("span", {
        className: "sydney-studio-spinner"
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_7__.jsx)("span", {
        className: "screen-reader-text",
        children: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Loading patterns...', 'sydney')
      })]
    });
  }
  if (filtered.length === 0) {
    return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_7__.jsx)("div", {
      className: "sydney-studio-no-patterns",
      children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_7__.jsx)("p", {
        children: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('No patterns found.', 'sydney')
      })
    });
  }
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_7__.jsxs)("div", {
    className: "sydney-studio-pattern-grid",
    children: [isFiltering && /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_7__.jsxs)("div", {
      className: "sydney-studio-loading-overlay",
      "aria-live": "polite",
      "aria-busy": "true",
      children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_7__.jsx)("span", {
        className: "sydney-studio-spinner"
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_7__.jsx)("span", {
        className: "screen-reader-text",
        children: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Loading patterns...', 'sydney')
      })]
    }), freePatterns.map(pattern => /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_7__.jsx)(PatternPreview, {
      pattern: pattern,
      onClick: handleClickPattern
    }, `${selectedType}-${selectedCollection}-${pattern.name}`)), proPatterns.length > 0 && /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_7__.jsx)("div", {
      className: "sydney-studio-pro-patterns",
      children: proPatterns.map(pattern => /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_7__.jsx)(PatternPreview, {
        pattern: pattern,
        onClick: handleClickPattern,
        isPro: !isPro
      }, `${selectedType}-${selectedCollection}-${pattern.name}`))
    })]
  });
}
function PatternPreview({
  pattern,
  onClick,
  isPro = false
}) {
  const blockRef = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.useRef)(null);
  const hasReportedLoaded = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.useRef)(false);
  const [inViewport, setInViewport] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.useState)(false);
  const [isLoaded, setIsLoaded] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.useState)(false);
  const blocks = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.useMemo)(() => {
    return (0,_wordpress_blocks__WEBPACK_IMPORTED_MODULE_1__.rawHandler)({
      HTML: pattern.content
    });
  }, [pattern.content]);

  // Trigger render only when scrolled into view.
  (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.useEffect)(() => {
    const el = blockRef.current;
    if (!el) return;
    const observer = new IntersectionObserver(entries => {
      if (entries[0].isIntersecting) {
        setInViewport(true);
        observer.disconnect();
      }
    });
    observer.observe(el);
    return () => observer.disconnect();
  }, []);

  // Watch for the BlockPreview iframe to finish loading, then drop the skeleton.
  (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.useEffect)(() => {
    if (!inViewport || hasReportedLoaded.current) return;
    const el = blockRef.current;
    if (!el) return;
    function handleLoad() {
      if (!hasReportedLoaded.current) {
        hasReportedLoaded.current = true;
        setIsLoaded(true);
      }
    }
    function checkIframe(iframe) {
      if (hasReportedLoaded.current) return;
      try {
        if (iframe.contentDocument?.readyState === 'complete') {
          handleLoad();
          return;
        }
      } catch (e) {}
      iframe.addEventListener('load', handleLoad, {
        once: true
      });
    }
    const mutObs = new MutationObserver(mutations => {
      for (const mutation of mutations) {
        for (const node of mutation.addedNodes) {
          if (node.tagName === 'IFRAME') {
            checkIframe(node);
          } else if (node.querySelector) {
            const iframe = node.querySelector('iframe');
            if (iframe) checkIframe(iframe);
          }
        }
      }
    });
    mutObs.observe(el, {
      childList: true,
      subtree: true
    });
    const existingIframe = el.querySelector('iframe');
    if (existingIframe) checkIframe(existingIframe);

    // Safety: unblock after 8 s if the iframe never fires load.
    const timeout = setTimeout(handleLoad, 8000);
    return () => {
      mutObs.disconnect();
      clearTimeout(timeout);
    };
  }, [inViewport]);
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_7__.jsxs)("button", {
    ref: blockRef,
    type: "button",
    className: "sydney-studio-pattern-item",
    "aria-label": pattern.title,
    onClick: () => onClick(pattern, blocks),
    children: [isPro && /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_7__.jsx)("span", {
      className: "sydney-studio-pro-badge",
      children: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)('Pro', 'sydney')
    }), inViewport && /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_7__.jsx)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_0__.BlockPreview, {
      blocks: blocks,
      viewportWidth: 1600,
      additionalStyles: [{
        css: '.is-root-container > .wp-block-cover,.is-root-container > .wp-block-group { max-width: 100% !important;margin-bottom: 0 !important; } .wp-block-cover { min-height: 500px !important; }'
      }]
    }), !isLoaded && /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_7__.jsx)("div", {
      className: "sydney-studio-pattern-skeleton",
      "aria-hidden": "true"
    })]
  });
}

/***/ },

/***/ "./src/components/SmartSuggestions.js"
/*!********************************************!*\
  !*** ./src/components/SmartSuggestions.js ***!
  \********************************************/
(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   SmartSuggestions: () => (/* binding */ SmartSuggestions)
/* harmony export */ });
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! react/jsx-runtime */ "react/jsx-runtime");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__);




// Session-level tracking (resets on page reload)

const dismissedCollections = new Set();
const insertedPatternNames = new Set();
function SmartSuggestions({
  onOpenModal
}) {
  const [suggestion, setSuggestion] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.useState)(null);
  const patternCollections = window.sydneyStudio?.patternCollections || {};
  const collections = window.sydneyStudio?.collections || {};
  (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.useEffect)(() => {
    function handlePatternInserted(event) {
      const {
        patternName,
        collection
      } = event.detail;
      if (!collection || collection === 'all' || dismissedCollections.has(collection)) {
        return;
      }
      insertedPatternNames.add(patternName);
      const related = (patternCollections[collection] || []).filter(name => !insertedPatternNames.has(name));
      if (related.length > 0) {
        const collectionLabel = collections[collection] || collection;
        setSuggestion({
          collection,
          collectionLabel
        });
      }
    }
    window.addEventListener('sydney-studio-pattern-inserted', handlePatternInserted);
    return () => window.removeEventListener('sydney-studio-pattern-inserted', handlePatternInserted);
  }, []);
  if (!suggestion) {
    return null;
  }
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__.Snackbar, {
    onRemove: () => {
      dismissedCollections.add(suggestion.collection);
      setSuggestion(null);
    },
    actions: [{
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('View patterns', 'sydney'),
      onClick: () => {
        onOpenModal(suggestion.collection);
        setSuggestion(null);
      }
    }],
    children: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Complete your layout \u2014 view more patterns from the same collection.', 'sydney')
  });
}

/***/ },

/***/ "./src/components/StudioModal.js"
/*!***************************************!*\
  !*** ./src/components/StudioModal.js ***!
  \***************************************/
(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   StudioModal: () => (/* binding */ StudioModal)
/* harmony export */ });
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_icons__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/icons */ "./node_modules/@wordpress/icons/build-module/library/close.js");
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/data */ "@wordpress/data");
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_data__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var _CollectionFilter_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./CollectionFilter.js */ "./src/components/CollectionFilter.js");
/* harmony import */ var _TypeFilter_js__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./TypeFilter.js */ "./src/components/TypeFilter.js");
/* harmony import */ var _PatternGrid_js__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./PatternGrid.js */ "./src/components/PatternGrid.js");
/* harmony import */ var _store_index_js__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ../store/index.js */ "./src/store/index.js");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! react/jsx-runtime */ "react/jsx-runtime");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_9___default = /*#__PURE__*/__webpack_require__.n(react_jsx_runtime__WEBPACK_IMPORTED_MODULE_9__);










function StudioModal({
  onClose,
  onInsert,
  initialCollection
}) {
  const {
    setCollection
  } = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_2__.useDispatch)(_store_index_js__WEBPACK_IMPORTED_MODULE_8__.STORE_NAME);

  // isResolving becomes false once the core pattern registry has finished loading.
  const {
    patterns,
    isLoading
  } = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_2__.useSelect)(select => {
    const resolving = select("core").isResolving("getBlockPatterns");
    return {
      patterns: select("core").getBlockPatterns() || [],
      isLoading: resolving
    };
  });
  const sydneyPatterns = patterns.filter(p => p.name?.startsWith("sydney/"));
  (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.useEffect)(() => {
    if (initialCollection) {
      setCollection(initialCollection);
    }
  }, [initialCollection]);
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_9__.jsx)(_wordpress_components__WEBPACK_IMPORTED_MODULE_0__.Modal, {
    onRequestClose: onClose,
    className: "sydney-studio-modal",
    __experimentalHideHeader: true,
    size: "fill",
    children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_9__.jsxs)(_wordpress_components__WEBPACK_IMPORTED_MODULE_0__.__experimentalHStack, {
      spacing: 0,
      alignment: "flex-start",
      expanded: true,
      className: "sydney-studio-modal-container",
      children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_9__.jsxs)(_wordpress_components__WEBPACK_IMPORTED_MODULE_0__.__experimentalVStack, {
        className: "sydney-studio-modal-sidebar",
        alignment: "top",
        children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_9__.jsx)("div", {
          className: "sydney-studio-modal-title-container",
          children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_9__.jsxs)("h2", {
            className: "sydney-studio-modal-title",
            children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_9__.jsx)("svg", {
              width: "35",
              height: "36",
              viewBox: "0 0 35 36",
              fill: "none",
              xmlns: "http://www.w3.org/2000/svg",
              children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_9__.jsx)("path", {
                d: "M17.7169 0H34.3047V18.119L17.7169 0ZM0.161307 10.6334H0C0 7.00073 1.00369 4.32034 3.01107 2.59221C5.01846 0.86407 8.11017 0 12.2863 0L34.3047 26.2925C34.3047 29.7841 33.3459 32.2793 31.428 33.7782C29.564 35.2417 26.5171 35.9735 22.2873 35.9735L0.161307 10.6334ZM0.0806536 17.7752L16.0501 36H0.0806536V17.7752Z",
                fill: "#3c3c3c"
              })
            }), (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)("Sydney Studio", "sydney")]
          })
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_9__.jsx)("div", {
          className: "sydney-studio-modal-sidebar-content",
          children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_9__.jsx)(_TypeFilter_js__WEBPACK_IMPORTED_MODULE_6__.TypeFilter, {
            patterns: sydneyPatterns
          })
        })]
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_9__.jsxs)("div", {
        className: "sydney-studio-modal-content",
        children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_9__.jsxs)(_wordpress_components__WEBPACK_IMPORTED_MODULE_0__.__experimentalHStack, {
          spacing: 4,
          alignment: "center",
          justify: "space-between",
          className: "sydney-studio-modal-header",
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_9__.jsxs)(_wordpress_components__WEBPACK_IMPORTED_MODULE_0__.__experimentalHStack, {
            spacing: 4,
            alignment: "center",
            justify: "flex-start",
            children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_9__.jsx)("h4", {
              children: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)("Filter by collection", "sydney")
            }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_9__.jsx)(_CollectionFilter_js__WEBPACK_IMPORTED_MODULE_5__.CollectionFilter, {})]
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_9__.jsx)(_wordpress_components__WEBPACK_IMPORTED_MODULE_0__.Button, {
            icon: _wordpress_icons__WEBPACK_IMPORTED_MODULE_1__["default"],
            onClick: onClose,
            label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_4__.__)("Close", "sydney")
          })]
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_9__.jsx)("div", {
          className: "sydney-studio-modal-grid-container",
          children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_9__.jsx)(_PatternGrid_js__WEBPACK_IMPORTED_MODULE_7__.PatternGrid, {
            patterns: sydneyPatterns,
            isLoading: isLoading,
            onInsert: onInsert
          })
        })]
      })]
    })
  });
}

/***/ },

/***/ "./src/components/TypeFilter.js"
/*!**************************************!*\
  !*** ./src/components/TypeFilter.js ***!
  \**************************************/
(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   TypeFilter: () => (/* binding */ TypeFilter)
/* harmony export */ });
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/data */ "@wordpress/data");
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_data__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _store_index_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../store/index.js */ "./src/store/index.js");
/* harmony import */ var _constants_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../constants.js */ "./src/constants.js");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! react/jsx-runtime */ "react/jsx-runtime");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__);






function TypeFilter({
  patterns
}) {
  const selected = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_0__.useSelect)(select => select(_store_index_js__WEBPACK_IMPORTED_MODULE_3__.STORE_NAME).getSelectedType());
  const {
    setType
  } = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_0__.useDispatch)(_store_index_js__WEBPACK_IMPORTED_MODULE_3__.STORE_NAME);
  const types = [...new Set(patterns.flatMap(p => p.categories || []))].sort((a, b) => {
    const ai = _constants_js__WEBPACK_IMPORTED_MODULE_4__.TYPE_ORDER.indexOf(a);
    const bi = _constants_js__WEBPACK_IMPORTED_MODULE_4__.TYPE_ORDER.indexOf(b);
    if (ai === -1 && bi === -1) return a.localeCompare(b);
    if (ai === -1) return 1;
    if (bi === -1) return -1;
    return ai - bi;
  });
  const allTypes = [{
    slug: 'all',
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('All', 'sydney')
  }, ...types.map(slug => {
    const raw = slug.replace('sydney-', '');
    let label;
    if (raw.toLowerCase() === 'cta') {
      label = 'CTA';
    } else {
      label = raw.replace(/-/g, ' ').replace(/^\w/, c => c.toUpperCase());
    }
    return {
      slug,
      label
    };
  })];
  function handleClick(slug) {
    setType(slug);
  }
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__.Flex, {
    direction: "column",
    gap: 1,
    children: allTypes.map(({
      slug,
      label
    }) => /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__.Button, {
      variant: selected === slug ? 'primary' : 'tertiary',
      onClick: () => handleClick(slug),
      children: label
    }, slug))
  });
}

/***/ },

/***/ "./src/constants.js"
/*!**************************!*\
  !*** ./src/constants.js ***!
  \**************************/
(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   TYPE_ORDER: () => (/* binding */ TYPE_ORDER)
/* harmony export */ });
const TYPE_ORDER = ['sydney-hero', 'sydney-about', 'sydney-services', 'sydney-features', 'sydney-cta', 'sydney-testimonials', 'sydney-team', 'sydney-pricing', 'sydney-gallery', 'sydney-blog', 'sydney-stats', 'sydney-faq', 'sydney-contact'];

/***/ },

/***/ "./src/store/index.js"
/*!****************************!*\
  !*** ./src/store/index.js ***!
  \****************************/
(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   STORE_NAME: () => (/* binding */ STORE_NAME)
/* harmony export */ });
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/data */ "@wordpress/data");
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_data__WEBPACK_IMPORTED_MODULE_0__);

const STORE_NAME = "sydney-studio";
const DEFAULT_STATE = {
  selectedCollection: "all",
  selectedType: "all",
  isModalOpen: false,
  initialCollection: null
};
const actions = {
  setCollection(collection) {
    return {
      type: "SET_COLLECTION",
      collection
    };
  },
  setType(patternType) {
    return {
      type: "SET_TYPE",
      patternType
    };
  },
  openModal(collection = null) {
    return {
      type: "OPEN_MODAL",
      collection
    };
  },
  closeModal() {
    return {
      type: "CLOSE_MODAL"
    };
  }
};
function reducer(state = DEFAULT_STATE, action) {
  switch (action.type) {
    case "SET_COLLECTION":
      return {
        ...state,
        selectedCollection: action.collection
      };
    case "SET_TYPE":
      return {
        ...state,
        selectedType: action.patternType
      };
    case "OPEN_MODAL":
      return {
        ...state,
        isModalOpen: true,
        initialCollection: action.collection
      };
    case "CLOSE_MODAL":
      return {
        ...state,
        isModalOpen: false,
        initialCollection: null
      };
  }
  return state;
}
const selectors = {
  getSelectedCollection(state) {
    return state.selectedCollection;
  },
  getSelectedType(state) {
    return state.selectedType;
  },
  isModalOpen(state) {
    return state.isModalOpen;
  },
  getInitialCollection(state) {
    return state.initialCollection;
  }
};
const store = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_0__.createReduxStore)(STORE_NAME, {
  reducer,
  actions,
  selectors
});
(0,_wordpress_data__WEBPACK_IMPORTED_MODULE_0__.register)(store);


/***/ },

/***/ "./src/index.css"
/*!***********************!*\
  !*** ./src/index.css ***!
  \***********************/
(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ },

/***/ "react/jsx-runtime"
/*!**********************************!*\
  !*** external "ReactJSXRuntime" ***!
  \**********************************/
(module) {

module.exports = window["ReactJSXRuntime"];

/***/ },

/***/ "@wordpress/block-editor"
/*!*************************************!*\
  !*** external ["wp","blockEditor"] ***!
  \*************************************/
(module) {

module.exports = window["wp"]["blockEditor"];

/***/ },

/***/ "@wordpress/blocks"
/*!********************************!*\
  !*** external ["wp","blocks"] ***!
  \********************************/
(module) {

module.exports = window["wp"]["blocks"];

/***/ },

/***/ "@wordpress/components"
/*!************************************!*\
  !*** external ["wp","components"] ***!
  \************************************/
(module) {

module.exports = window["wp"]["components"];

/***/ },

/***/ "@wordpress/data"
/*!******************************!*\
  !*** external ["wp","data"] ***!
  \******************************/
(module) {

module.exports = window["wp"]["data"];

/***/ },

/***/ "@wordpress/element"
/*!*********************************!*\
  !*** external ["wp","element"] ***!
  \*********************************/
(module) {

module.exports = window["wp"]["element"];

/***/ },

/***/ "@wordpress/i18n"
/*!******************************!*\
  !*** external ["wp","i18n"] ***!
  \******************************/
(module) {

module.exports = window["wp"]["i18n"];

/***/ },

/***/ "@wordpress/plugins"
/*!*********************************!*\
  !*** external ["wp","plugins"] ***!
  \*********************************/
(module) {

module.exports = window["wp"]["plugins"];

/***/ },

/***/ "@wordpress/primitives"
/*!************************************!*\
  !*** external ["wp","primitives"] ***!
  \************************************/
(module) {

module.exports = window["wp"]["primitives"];

/***/ }

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Check if module exists (development only)
/******/ 		if (__webpack_modules__[moduleId] === undefined) {
/******/ 			var e = new Error("Cannot find module '" + moduleId + "'");
/******/ 			e.code = 'MODULE_NOT_FOUND';
/******/ 			throw e;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry needs to be wrapped in an IIFE because it needs to be isolated against other modules in the chunk.
(() => {
/*!**********************!*\
  !*** ./src/index.js ***!
  \**********************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_plugins__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/plugins */ "@wordpress/plugins");
/* harmony import */ var _wordpress_plugins__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_plugins__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/data */ "@wordpress/data");
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_data__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/block-editor */ "@wordpress/block-editor");
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @wordpress/blocks */ "@wordpress/blocks");
/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_wordpress_blocks__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var _index_css__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./index.css */ "./src/index.css");
/* harmony import */ var _store_index_js__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./store/index.js */ "./src/store/index.js");
/* harmony import */ var _components_StudioModal_js__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ./components/StudioModal.js */ "./src/components/StudioModal.js");
/* harmony import */ var _components_SmartSuggestions_js__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! ./components/SmartSuggestions.js */ "./src/components/SmartSuggestions.js");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! react/jsx-runtime */ "react/jsx-runtime");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_10___default = /*#__PURE__*/__webpack_require__.n(react_jsx_runtime__WEBPACK_IMPORTED_MODULE_10__);













function render(component, node) {
  if (typeof _wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createRoot !== "function") {
    return;
  }
  (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createRoot)(node).render(component);
}
function MainButton() {
  const {
    openModal
  } = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_2__.useDispatch)(_store_index_js__WEBPACK_IMPORTED_MODULE_7__.STORE_NAME);
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_10__.jsxs)("div", {
    role: "button",
    onClick: () => openModal(),
    className: "components-button is-secondary sydney-studio-toolbar-btn",
    style: {
      marginLeft: "8px"
    },
    children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_10__.jsx)("svg", {
      width: "16",
      height: "16",
      viewBox: "0 0 35 36",
      fill: "none",
      xmlns: "http://www.w3.org/2000/svg",
      children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_10__.jsx)("path", {
        d: "M17.7169 0H34.3047V18.119L17.7169 0ZM0.161307 10.6334H0C0 7.00073 1.00369 4.32034 3.01107 2.59221C5.01846 0.86407 8.11017 0 12.2863 0L34.3047 26.2925C34.3047 29.7841 33.3459 32.2793 31.428 33.7782C29.564 35.2417 26.5171 35.9735 22.2873 35.9735L0.161307 10.6334ZM0.0806536 17.7752L16.0501 36H0.0806536V17.7752Z",
        fill: "currentColor"
      })
    }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_10__.jsx)("span", {
      className: "sydney-studio-toolbar-btn-text",
      children: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)("Sydney Studio", "sydney")
    })]
  });
}
function Modal() {
  const {
    closeModal
  } = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_2__.useDispatch)(_store_index_js__WEBPACK_IMPORTED_MODULE_7__.STORE_NAME);
  const {
    insertBlocks
  } = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_2__.useDispatch)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3__.store);
  const isOpen = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_2__.useSelect)(select => select(_store_index_js__WEBPACK_IMPORTED_MODULE_7__.STORE_NAME).isModalOpen());
  const initialCollection = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_2__.useSelect)(select => select(_store_index_js__WEBPACK_IMPORTED_MODULE_7__.STORE_NAME).getInitialCollection());
  function handleInsert(pattern) {
    const blocks = (0,_wordpress_blocks__WEBPACK_IMPORTED_MODULE_4__.parse)(pattern.content);
    insertBlocks(blocks);
    const activeCollection = wp.data.select(_store_index_js__WEBPACK_IMPORTED_MODULE_7__.STORE_NAME).getSelectedCollection();
    window.dispatchEvent(new CustomEvent("sydney-studio-pattern-inserted", {
      detail: {
        patternName: pattern.name,
        collection: activeCollection
      }
    }));
    closeModal();
  }
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_10__.jsxs)(react_jsx_runtime__WEBPACK_IMPORTED_MODULE_10__.Fragment, {
    children: [isOpen && /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_10__.jsx)(_components_StudioModal_js__WEBPACK_IMPORTED_MODULE_8__.StudioModal, {
      onClose: closeModal,
      onInsert: handleInsert,
      initialCollection: initialCollection
    }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_10__.jsx)(_components_SmartSuggestions_js__WEBPACK_IMPORTED_MODULE_9__.SmartSuggestions, {
      onOpenModal: collection => wp.data.dispatch(_store_index_js__WEBPACK_IMPORTED_MODULE_7__.STORE_NAME).openModal(collection)
    })]
  });
}
const LibraryButton = () => {
  (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.useEffect)(() => {
    if (typeof _wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createRoot !== "function") return;
    const btnId = "sydney-studio-btn";
    const mdlId = "sydney-studio-modal";
    const page = ".edit-post-header-toolbar";
    const fse = ".edit-site-header-edit-mode__start";
    if (document.getElementById(btnId)) return;
    requestAnimationFrame(() => {
      requestAnimationFrame(() => {
        if (document.getElementById(btnId)) return;
        const btnWrap = document.createElement("div");
        const btn = Object.assign(btnWrap, {
          id: btnId
        });
        document.querySelector(page)?.append(btn);
        document.querySelector(fse)?.append(btn);
        render(/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_10__.jsx)(MainButton, {}), btn);
        if (document.getElementById(mdlId)) return;
        const modalWrap = document.createElement("div");
        const modal = Object.assign(modalWrap, {
          id: mdlId
        });
        document.body.append(modal);
        render(/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_10__.jsx)(Modal, {}), modal);
      });
    });
  }, []);
  return null;
};
(0,_wordpress_plugins__WEBPACK_IMPORTED_MODULE_1__.registerPlugin)("sydney-studio", {
  render: () => /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_10__.jsx)(LibraryButton, {})
});
})();

/******/ })()
;
//# sourceMappingURL=index.js.map