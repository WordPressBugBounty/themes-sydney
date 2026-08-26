/**
 * aThemes shared license activation UI.
 *
 * Binds activate/deactivate controls to the shared admin-ajax handler and reports the result in a
 * lightweight modal. Works for any product: wrap the controls in an element with
 * `data-athemes-license-slug="<slug>"` containing a `.athemes-license-key` input and
 * `.athemes-license-activate` / `.athemes-license-deactivate` buttons.
 */
( function () {
	'use strict';

	var overlay = null;
	var escHandler = null;

	/**
	 * Close the modal if open.
	 */
	function closeModal() {
		if ( escHandler ) {
			document.removeEventListener( 'keydown', escHandler );
			escHandler = null;
		}

		if ( overlay && overlay.parentNode ) {
			overlay.parentNode.removeChild( overlay );
		}

		overlay = null;
	}

	/**
	 * Resolve the config a product published for its own license form.
	 *
	 * Client::get_inline_config_script() writes one entry per product slug, so several products
	 * can coexist in one request without overwriting each other's action name, nonce, return URL
	 * or labels.
	 *
	 * @param {string} slug Product slug read from the form container.
	 *
	 * @return {Object} ajaxUrl, action, nonce, reloadUrl and okLabel for that product.
	 */
	function configFor( slug ) {
		var shared  = window.aThemesUpdater || {};
		var product = ( shared.products && shared.products[ slug ] ) || {};

		return {
			ajaxUrl: shared.ajaxUrl || '',
			action: product.action || '',
			nonce: product.nonce || '',
			reloadUrl: product.reloadUrl || '',
			okLabel: ( product.i18n && product.i18n.ok ) || 'OK'
		};
	}

	/**
	 * Reload after a successful action, returning to the product's settings screen when one is
	 * provided. Some dashboards (e.g. Sydney) track the active tab in JS only, so a plain reload
	 * would drop the user on the default tab instead of the license field.
	 *
	 * @param {Object} config Product config from configFor().
	 */
	function reloadOrRedirect( config ) {
		if ( config && config.reloadUrl ) {
			window.location.assign( config.reloadUrl );
		} else {
			window.location.reload();
		}
	}

	/**
	 * Render a server message into an element, allowing only safe <a> links (http/https href,
	 * optional target=_blank, optional title). Any other tag falls through to its text content, so
	 * unknown/unsafe markup is stripped without breaking the flow.
	 *
	 * The message is server-controlled (e.g. EDD Software Licensing returns "The key has expired.
	 * <a href='…' title='…' target='_blank'>Click here to renew this license key.</a>"), so we
	 * cannot pipe it through innerHTML directly.
	 *
	 * @param {HTMLElement} target The container element.
	 * @param {string}      html   The raw message returned by the server.
	 */
	function renderMessage( target, html ) {
		target.textContent = '';

		if ( ! html ) {
			return;
		}

		var template = document.createElement( 'template' );
		template.innerHTML = String( html );

		var walk = function ( source, sink ) {
			source.childNodes.forEach( function ( node ) {
				if ( node.nodeType === Node.TEXT_NODE ) {
					sink.appendChild( document.createTextNode( node.nodeValue ) );

					return;
				}

				if ( node.nodeType !== Node.ELEMENT_NODE ) {
					return;
				}

				if ( node.tagName === 'A' ) {
					var href = node.getAttribute( 'href' ) || '';

					// Only accept absolute http(s) URLs — blocks javascript:, data:, and relative links.
					if ( ! /^https?:\/\//i.test( href ) ) {
						sink.appendChild( document.createTextNode( node.textContent ) );

						return;
					}

					var anchor = document.createElement( 'a' );
					anchor.href = href;

					if ( node.getAttribute( 'target' ) === '_blank' ) {
						anchor.target = '_blank';
						anchor.rel    = 'noopener';
					}

					var title = node.getAttribute( 'title' );

					if ( title ) {
						anchor.title = title;
					}

					walk( node, anchor );
					sink.appendChild( anchor );

					return;
				}

				// Unknown element — drop the wrapper, keep the text.
				walk( node, sink );
			} );
		};

		walk( template.content, target );
	}

	/**
	 * Show a result modal.
	 *
	 * @param {Object} options type ('success'|'error'), message, okLabel, and optional onClose callback.
	 */
	function showModal( options ) {
		closeModal();

		var okLabel = options.okLabel || 'OK';

		overlay = document.createElement( 'div' );
		overlay.className = 'athemes-modal-overlay';
		overlay.innerHTML =
			'<div class="athemes-modal athemes-modal--' + ( options.type || 'info' ) + '" role="dialog" aria-modal="true">' +
				'<div class="athemes-modal__icon" aria-hidden="true"></div>' +
				'<div class="athemes-modal__message"></div>' +
				'<div class="athemes-modal__actions">' +
					'<button type="button" class="button button-primary athemes-modal__ok">' + okLabel + '</button>' +
				'</div>' +
			'</div>';

		renderMessage( overlay.querySelector( '.athemes-modal__message' ), options.message );

		function done() {
			closeModal();

			if ( typeof options.onClose === 'function' ) {
				options.onClose();
			}
		}

		overlay.querySelector( '.athemes-modal__ok' ).addEventListener( 'click', done );

		overlay.addEventListener( 'click', function ( event ) {
			if ( event.target === overlay ) {
				done();
			}
		} );

		escHandler = function ( event ) {
			if ( event.key === 'Escape' ) {
				// Prevent the browser's default Escape action ("stop loading"), which would abort
				// the reload that done() triggers on success.
				event.preventDefault();
				done();
			}
		};
		document.addEventListener( 'keydown', escHandler );

		document.body.appendChild( overlay );
		overlay.querySelector( '.athemes-modal__ok' ).focus();
	}

	/**
	 * Toggle the loading spinner on a button.
	 *
	 * @param {HTMLElement} button  The button.
	 * @param {boolean}     loading Whether the request is in flight.
	 */
	function setLoading( button, loading ) {
		button.classList.toggle( 'athemes-license-loading', loading );
		button.disabled = loading;
	}

	/**
	 * Send an activate/deactivate request and report the outcome.
	 *
	 * @param {string}      task   'activate' or 'deactivate'.
	 * @param {HTMLElement} root   The container element.
	 * @param {HTMLElement} button The clicked button.
	 */
	function request( task, root, button ) {
		var slug   = root.getAttribute( 'data-athemes-license-slug' ) || '';
		var config = configFor( slug );
		var input  = root.querySelector( '.athemes-license-key' );
		var key    = input ? input.value.trim() : '';

		// No published config for this slug means the product never attached the client's inline
		// config, or did so without registering. Firing the request would post an empty action and
		// get a bare 0 back.
		if ( ! config.action ) {
			showModal( { type: 'error', message: 'License form is not configured. Please reload the page.' } );

			return;
		}

		setLoading( button, true );

		var body = new URLSearchParams();
		body.append( 'action', config.action );
		body.append( 'nonce', config.nonce );
		body.append( 'task', task );
		body.append( 'slug', slug );
		body.append( 'license', key );

		fetch( config.ajaxUrl, {
			method: 'POST',
			credentials: 'same-origin',
			headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8' },
			body: body.toString()
		} )
			.then( function ( response ) {
				return response.json();
			} )
			.then( function ( result ) {
				var data = result && result.data ? result.data : {};

				if ( result && result.success ) {
					showModal( {
						type: 'success',
						message: data.message || 'Done.',
						okLabel: config.okLabel,
						onClose: function () {
							reloadOrRedirect( config );
						}
					} );

					return;
				}

				showModal( {
					type: 'error',
					message: data.message || 'Something went wrong. Please try again.',
					okLabel: config.okLabel
				} );
			} )
			.catch( function () {
				showModal( {
					type: 'error',
					message: 'Could not reach the server. Please try again.',
					okLabel: config.okLabel
				} );
			} )
			.finally( function () {
				// Always clear the loading state once the request settles.
				setLoading( button, false );
			} );
	}

	document.addEventListener( 'click', function ( event ) {
		var button = event.target.closest( '.athemes-license-activate, .athemes-license-deactivate' );

		if ( ! button ) {
			return;
		}

		var root = button.closest( '[data-athemes-license-slug]' );

		if ( ! root ) {
			return;
		}

		event.preventDefault();

		// Take over the click in the capture phase so the product's own license-button handler
		// (e.g. a dashboard script) never runs — those typically swap the button for a spinner
		// that only resets on a full-page form submit, which no longer happens now that
		// activation is AJAX.
		event.stopImmediatePropagation();

		request( button.classList.contains( 'athemes-license-deactivate' ) ? 'deactivate' : 'activate', root, button );
	}, true );

	// Products typically wrap the controls in a real <form>, and the buttons are type="button" —
	// so pressing Enter in the key input triggers the browser's implicit form submission: a full
	// POST/reload that goes nowhere. Take it over: Enter activates when the form offers an
	// Activate button, and does nothing in the deactivate state (Enter must never deactivate).
	document.addEventListener( 'submit', function ( event ) {
		var root = event.target.closest ? event.target.closest( '[data-athemes-license-slug]' ) : null;

		if ( ! root ) {
			return;
		}

		event.preventDefault();
		event.stopImmediatePropagation();

		var button = root.querySelector( '.athemes-license-activate' );

		if ( button && ! button.disabled ) {
			request( 'activate', root, button );
		}
	}, true );
} )();
