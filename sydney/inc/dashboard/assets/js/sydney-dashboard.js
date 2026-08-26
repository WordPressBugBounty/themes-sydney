/**
 * Sticky-kit v1.1.3 | MIT | Leaf Corcoran 2015 | http://leafo.net
 * 
 * @cc_on 
 * 
 */
(function(){var c,f;c=window.jQuery;f=c(window);c.fn.stick_in_parent=function(b){var A,w,J,n,B,K,p,q,L,k,E,t;null==b&&(b={});t=b.sticky_class;B=b.inner_scrolling;E=b.recalc_every;k=b.parent;q=b.offset_top;p=b.spacer;w=b.bottoming;null==q&&(q=0);null==k&&(k=void 0);null==B&&(B=!0);null==t&&(t="is_stuck");A=c(document);null==w&&(w=!0);L=function(a){var b;return window.getComputedStyle?(a=window.getComputedStyle(a[0]),b=parseFloat(a.getPropertyValue("width"))+parseFloat(a.getPropertyValue("margin-left"))+
parseFloat(a.getPropertyValue("margin-right")),"border-box"!==a.getPropertyValue("box-sizing")&&(b+=parseFloat(a.getPropertyValue("border-left-width"))+parseFloat(a.getPropertyValue("border-right-width"))+parseFloat(a.getPropertyValue("padding-left"))+parseFloat(a.getPropertyValue("padding-right"))),b):a.outerWidth(!0)};J=function(a,b,n,C,F,u,r,G){var v,H,m,D,I,d,g,x,y,z,h,l;if(!a.data("sticky_kit")){a.data("sticky_kit",!0);I=A.height();g=a.parent();null!=k&&(g=g.closest(k));if(!g.length)throw"failed to find stick parent";
v=m=!1;(h=null!=p?p&&a.closest(p):c("<div />"))&&h.css("position",a.css("position"));x=function(){var d,f,e;if(!G&&(I=A.height(),d=parseInt(g.css("border-top-width"),10),f=parseInt(g.css("padding-top"),10),b=parseInt(g.css("padding-bottom"),10),n=g.offset().top+d+f,C=g.height(),m&&(v=m=!1,null==p&&(a.insertAfter(h),h.detach()),a.css({position:"",top:"",width:"",bottom:""}).removeClass(t),e=!0),F=a.offset().top-(parseInt(a.css("margin-top"),10)||0)-q,u=a.outerHeight(!0),r=a.css("float"),h&&h.css({width:L(a),
height:u,display:a.css("display"),"vertical-align":a.css("vertical-align"),"float":r}),e))return l()};x();if(u!==C)return D=void 0,d=q,z=E,l=function(){var c,l,e,k;if(!G&&(e=!1,null!=z&&(--z,0>=z&&(z=E,x(),e=!0)),e||A.height()===I||x(),e=f.scrollTop(),null!=D&&(l=e-D),D=e,m?(w&&(k=e+u+d>C+n,v&&!k&&(v=!1,a.css({position:"fixed",bottom:"",top:d}).trigger("sticky_kit:unbottom"))),e<F&&(m=!1,d=q,null==p&&("left"!==r&&"right"!==r||a.insertAfter(h),h.detach()),c={position:"",width:"",top:""},a.css(c).removeClass(t).trigger("sticky_kit:unstick")),
B&&(c=f.height(),u+q>c&&!v&&(d-=l,d=Math.max(c-u,d),d=Math.min(q,d),m&&a.css({top:d+"px"})))):e>F&&(m=!0,c={position:"fixed",top:d},c.width="border-box"===a.css("box-sizing")?a.outerWidth()+"px":a.width()+"px",a.css(c).addClass(t),null==p&&(a.after(h),"left"!==r&&"right"!==r||h.append(a)),a.trigger("sticky_kit:stick")),m&&w&&(null==k&&(k=e+u+d>C+n),!v&&k)))return v=!0,"static"===g.css("position")&&g.css({position:"relative"}),a.css({position:"absolute",bottom:b,top:"auto"}).trigger("sticky_kit:bottom")},
y=function(){x();return l()},H=function(){G=!0;f.off("touchmove",l);f.off("scroll",l);f.off("resize",y);c(document.body).off("sticky_kit:recalc",y);a.off("sticky_kit:detach",H);a.removeData("sticky_kit");a.css({position:"",bottom:"",top:"",width:""});g.position("position","");if(m)return null==p&&("left"!==r&&"right"!==r||a.insertAfter(h),h.remove()),a.removeClass(t)},f.on("touchmove",l),f.on("scroll",l),f.on("resize",y),c(document.body).on("sticky_kit:recalc",y),a.on("sticky_kit:detach",H),setTimeout(l,
0)}};n=0;for(K=this.length;n<K;n++)b=this[n],J(c(b));return this}}).call(this);

(function ($) {

	'use strict';

	$(document).ready(function () {

		// Globals
		var $body = $('body');

		// Dashboard hero re-position
		var $header = $('.wp-header-end');
		var $notice = $('.sydney-dashboard-notice');

		if ($header.length && $notice.length) {
			$header.after($notice);
			$notice.addClass('show');
		}

		// Dashboard hero dismissable
		var $dismissable = $('.sydney-dashboard-dismissable');

		if ($dismissable.length) {

			$dismissable.on('click', function () {

				$dismissable.parent().hide();

				$.post(window.sydney_dashboard.ajax_url, {
					action: 'sydney_dismissed_handler',
					nonce: window.sydney_dashboard.nonce,
					notice: $dismissable.data('notice'),
				});

			});

		}

		//Templates builder
		const $template_save = $('#save-templates');

		if ($template_save.length) {

			$template_save.on('click', function (e) {

				e.preventDefault();

				//Nothing has changed since the last save, so there is nothing to store.
				if (this.disabled) {
					return;
				}

				$( this ).html( '<i class="dashicons dashicons-update-alt"></i>' + window.sydney_dashboard.i18n.saving );

				var data = [];

				$('#template-builder .template-item').each(function() {

					var id 				= $(this).data('id');
					var template_name 	= $(this).find('input[name="template_name"]').val();
					var conditions 		= $(this).find('input[name="conditions"]').val();

					var header 			= $(this).find('input[name="header"]').val();
					var header_builder 	= $(this).find('.template-part.header').data('page-builder');

					//Stored on the header part rather than in this row, but posted
					//from here so one Save covers the whole card.
					var header_sticky 		= $(this).find('input[name="header_sticky"]').val();
					var header_transparent 	= $(this).find('input[name="header_transparent"]').val();

					var page_title 			= $(this).find('input[name="page_title"]').val();
					var page_title_builder 	= $(this).find('.template-part.page_title').data('page-builder');

					var content 		= $(this).find('input[name="content"]').val();
					var content_builder = $(this).find('.template-part.content').data('page-builder');

					var footer 			= $(this).find('input[name="footer"]').val();
					var footer_builder 	= $(this).find('.template-part.footer').data('page-builder');

					var template_item = {
						id: id,
						template_name: template_name,
						header: header,
						header_builder: header_builder,
						header_sticky: header_sticky,
						header_transparent: header_transparent,
						page_title: page_title,
						page_title_builder: page_title_builder,
						content: content,
						content_builder: content_builder,
						footer: footer,
						footer_builder: footer_builder,
						conditions: conditions
					};

					data.push(template_item);
				});		
			

				$.post( window.sydney_dashboard.ajax_url, {
					action: 'sydney_template_builder_data',
					data: data,
					nonce: window.sydney_dashboard.nonce,
				}, function ( response ) {
					if( response.success ) {
						$template_save.html(window.sydney_dashboard.i18n.saved);

						$('#save-templates').addClass('saved');

						//The DOM now matches the saved option, so there is nothing to
						//save or discard until the next change.
						$('#save-templates').prop('disabled', true);
						$('#discard-templates').prop('disabled', true);

						setTimeout(function () {
							$template_save.html(window.sydney_dashboard.i18n.save);
							$template_save.blur();
						},2000);
					} else {
						save_failed();
					}
				}).fail(function () {
					save_failed();
				});

				// Nothing was stored, so the 'saved' class stays off and the
				// unsaved-changes warning stays armed.
				function save_failed() {
					$template_save.html(window.sydney_dashboard.i18n.error);

					setTimeout(function () {
						$template_save.html(window.sydney_dashboard.i18n.save);
						$template_save.blur();
					},2000);
				}
			});
		}

		//Did this click land outside the dialog's box?
		//
		//A <dialog> reports itself as the click target for both its backdrop and
		//its own padding, so testing the target alone dismisses the dialog when
		//the user clicks the padding around its contents. Only the geometry can
		//tell the two apart.
		function is_backdrop_click(dialog, e) {

			//A keyboard-activated button fires a click carrying no coordinates,
			//which would otherwise read as a point outside every box.
			if (!e.detail) {
				return false;
			}

			var rect = dialog.getBoundingClientRect();

			return e.clientX < rect.left || e.clientX > rect.right ||
				e.clientY < rect.top || e.clientY > rect.bottom;
		}

		//Shared confirm step for the destructive builder actions. Callers hand over
		//the copy plus a callback holding the destructive work, so nothing happens
		//until the confirm button is clicked - Cancel, Esc and a backdrop click all
		//dismiss and drop the callback untouched.
		var $confirm_dialog  = $('#sydney-template-builder-confirm');
		var confirm_callback = null; //pending destructive action
		var confirm_trigger  = null; //control focus goes back to when cancelled

		function close_confirm_dialog() {
			var dialog = $confirm_dialog[0];

			if (!dialog) {
				return;
			}

			if (typeof dialog.close === 'function' && dialog.open) {
				dialog.close();
			} else {
				dialog.removeAttribute('open');
			}
		}

		function template_confirm(options, on_confirm) {
			var dialog = $confirm_dialog[0];

			//The dialog is only printed on the builder tab. Without it, fall back to
			//the browser confirm rather than running the action unchallenged.
			if (!dialog) {
				if (window.confirm(options.message)) {
					on_confirm();
				}

				return;
			}

			confirm_callback = on_confirm;
			confirm_trigger  = options.trigger || null;

			$confirm_dialog.find('.sydney-confirm-dialog-title').text(options.title);
			$confirm_dialog.find('.sydney-confirm-dialog-message').text(options.message);
			$confirm_dialog.find('.sydney-confirm-dialog-confirm').text(options.confirm_label);

			if (typeof dialog.showModal === 'function') {
				dialog.showModal();
			} else {
				dialog.setAttribute('open', '');
			}

			//Destructive confirm, so the safe choice takes focus.
			$confirm_dialog.find('.sydney-confirm-dialog-cancel').trigger('focus');
		}

		//Delegated, so these are bound once no matter how often the dialog is
		//opened and closed.
		$(document).on('click', '#sydney-template-builder-confirm .sydney-confirm-dialog-confirm', function () {
			var callback = confirm_callback;

			//Taken before closing, so the 'close' handler below sees a confirm
			//rather than a cancel.
			confirm_callback = null;
			confirm_trigger  = null;

			close_confirm_dialog();

			if (typeof callback === 'function') {
				callback();
			}
		});

		$(document).on('click', '#sydney-template-builder-confirm .sydney-confirm-dialog-cancel', function () {
			close_confirm_dialog();
		});

		//A click outside the card landed on the backdrop, so treat it as a dismissal.
		$(document).on('click', '#sydney-template-builder-confirm', function (e) {
			if (is_backdrop_click(this, e)) {
				close_confirm_dialog();
			}
		});

		//'close' also covers Esc. Anything reaching here still holding the callback
		//was cancelled, so the action is dropped and focus goes back to the
		//trigger. The event doesn't bubble, so it can't be delegated.
		if ($confirm_dialog.length) {
			$confirm_dialog[0].addEventListener('close', function () {
				confirm_callback = null;

				if (confirm_trigger) {
					$(confirm_trigger).trigger('focus');
					confirm_trigger = null;
				}
			});
		}

		//Watch tutorial plays inside the dashboard. The iframe stays srcless
		//until the link is clicked and is cleared again on close, which is
		//also what stops the audio.
		var $video_dialog = $('#sydney-tutorial-dialog');
		var video_trigger = null; //control focus goes back to on close

		function close_video_dialog() {
			var dialog = $video_dialog[0];

			if (!dialog) {
				return;
			}

			if (typeof dialog.close === 'function' && dialog.open) {
				dialog.close();
			} else {
				dialog.removeAttribute('open');
			}
		}

		$(document).on('click', '.template-builder-tutorial', function (e) {
			var dialog = $video_dialog[0];

			//Without the dialog the link keeps working as a plain link.
			if (!dialog) {
				return;
			}

			e.preventDefault();

			video_trigger = this;

			$video_dialog.find('.sydney-video-dialog-iframe').attr('src', $(this).attr('data-video-embed'));

			if (typeof dialog.showModal === 'function') {
				dialog.showModal();
			} else {
				dialog.setAttribute('open', '');
			}
		});

		$(document).on('click', '#sydney-tutorial-dialog .sydney-confirm-dialog-cancel', function () {
			close_video_dialog();
		});

		//A click outside the card landed on the backdrop, so treat it as a dismissal.
		$(document).on('click', '#sydney-tutorial-dialog', function (e) {
			if (is_backdrop_click(this, e)) {
				close_video_dialog();
			}
		});

		//'close' also covers Esc.
		if ($video_dialog.length) {
			$video_dialog[0].addEventListener('close', function () {
				$video_dialog.find('.sydney-video-dialog-iframe').removeAttr('src');

				if (video_trigger) {
					$(video_trigger).trigger('focus');
					video_trigger = null;
				}
			});
		}

		//Header Options. The values belong to the header part rather than to the
		//card, but they are held in the card's hidden inputs until Save Changes
		//posts them - so Discard reverts them with everything else. Cancel, Esc
		//and a backdrop click leave the inputs untouched.
		var $header_options_dialog = $('#sydney-header-options-dialog');
		var header_options_part    = null; //.template-part the dialog was opened from
		var header_options_trigger = null;

		function close_header_options_dialog() {
			var dialog = $header_options_dialog[0];

			if (!dialog) {
				return;
			}

			if (typeof dialog.close === 'function' && dialog.open) {
				dialog.close();
			} else {
				dialog.removeAttribute('open');
			}
		}

		//The options are stored per part, so every card holding that part has to
		//move together. Left to drift, two cards would post different values for
		//the same part and the last row saved would decide it.
		function sync_header_options(part_id, options) {

			if (!part_id) {
				return;
			}

			$('#template-builder .template-part.header').each(function () {
				var $part = $(this);

				if ($part.find('input[name="header"]').val() !== part_id) {
					return;
				}

				$part.find('input[name="header_sticky"]').val(options.sticky);
				$part.find('input[name="header_transparent"]').val(options.transparent);
			});

			//The pickers seed a card's inputs when a part is picked, so they carry
			//the same values - otherwise the next card to pick this part would seed
			//itself from the page load and revert what was just applied.
			$('.existing-parts-item[data-id="' + part_id + '"]')
				.attr('data-header-sticky', options.sticky)
				.attr('data-header-transparent', options.transparent);
		}

		$(document).on('click', '.part-options .header-options', function () {
			var dialog = $header_options_dialog[0];
			var $part  = $(this).closest('.template-part');

			close_part_menus();

			if (!dialog) {
				return;
			}

			header_options_part    = $part;
			header_options_trigger = this;

			$header_options_dialog.find('input[name="header_sticky"]')
				.prop('checked', $part.find('input[name="header_sticky"]').val() === '1');
			$header_options_dialog.find('input[name="header_transparent"]')
				.prop('checked', $part.find('input[name="header_transparent"]').val() === '1');

			if (typeof dialog.showModal === 'function') {
				dialog.showModal();
			} else {
				dialog.setAttribute('open', '');
			}
		});

		$(document).on('click', '#sydney-header-options-dialog .sydney-options-dialog-apply', function () {
			var $part = header_options_part;

			if (!$part) {
				close_header_options_dialog();

				return;
			}

			var options = {
				sticky:      $header_options_dialog.find('input[name="header_sticky"]').is(':checked') ? '1' : '0',
				transparent: $header_options_dialog.find('input[name="header_transparent"]').is(':checked') ? '1' : '0'
			};

			sync_header_options($part.find('input[name="header"]').val(), options);

			//Taken before closing, so the 'close' handler below sees an applied
			//change rather than a dismissal.
			header_options_part = null;

			close_header_options_dialog();

			save_notice();
		});

		$(document).on('click', '#sydney-header-options-dialog .sydney-confirm-dialog-cancel', function () {
			close_header_options_dialog();
		});

		//A click outside the card landed on the backdrop, so treat it as a dismissal.
		$(document).on('click', '#sydney-header-options-dialog', function (e) {
			if (is_backdrop_click(this, e)) {
				close_header_options_dialog();
			}
		});

		//'close' also covers Esc. Focus goes back to the row that opened it. The
		//event doesn't bubble, so it can't be delegated.
		if ($header_options_dialog.length) {
			$header_options_dialog[0].addEventListener('close', function () {
				header_options_part = null;

				if (header_options_trigger) {
					$(header_options_trigger).trigger('focus');
					header_options_trigger = null;
				}
			});
		}

		//Discard unsaved template changes. The builder is rendered from the saved
		//option, so a reload is the revert. The tab is kept through the 'tab' query
		//arg, which the dashboard already resolves server side.
		const $template_discard = $('#discard-templates');

		if ($template_discard.length) {

			$template_discard.on('click', function (e) {

				e.preventDefault();

				//A disabled button fires no click of its own, but a scripted one can
				//still land here and there is nothing to discard in that state.
				if (this.disabled) {
					return;
				}

				var i18n = window.sydney_dashboard.i18n;

				template_confirm({
					title:         i18n.confirm_discard_title,
					message:       i18n.confirm_discard_message,
					confirm_label: i18n.confirm_discard_button,
					trigger:       this
				}, function () {

					//Disarm the unsaved changes warning before navigating away.
					$('#save-templates').addClass('saved');

					var url = new URL(window.location.href);
					url.hash = '';
					url.searchParams.set('tab', 'builder');

					window.location.replace(url.href);

				});

			});

		}
		
			// Add new template
			const $add_template = $('#add-new-template');

			if ($add_template.length) {

				$('#add-new-template').on('click', function() {
					//Cloned from the blank prototype rather than from the Global card, so
					//there is nothing to undo - only the id has to be filled in.
					var $template_item = $('#template-builder-blank .template-item').first().clone();

					$template_item.attr('data-id', 'sydney-template-' + Math.random().toString(36).slice(2));

					$template_item.appendTo('#template-builder');

					refresh_part_sub_labels();
					refresh_applies_to();

					$template_item.find('input[name="template_name"]').trigger('focus');

					save_notice();
				});

			}


			//The popover animates its own height, so switching panels means handing it
			//the height of the one it is sliding to. Measured rather than hardcoded:
			//how many parts exist, and whether Elementor is installed, both vary.
			function part_menu_view( $menu, view ) {
				var index = { menu: 0, list: 1, builder: 2 }[ view ] || 0;

				$menu.attr('data-view', view);
				$menu.css('height', $menu.find('.part-menu-panel').eq( index ).outerHeight());
			}

			function close_part_menus() {
				$('.part-menu.open').removeClass('open').removeAttr('data-view').css('height', '');

				//The menu clips its own overflow to hide the panels either side of
				//the one in view, so the arrow pointing back at the ellipsis is drawn
				//by the row instead and tracks the open state from here.
				$('.template-part.part-menu-open').removeClass('part-menu-open');
			}

			//One open at a time, and every open starts at the top level.
			function part_menu_toggle( $part ) {
				var $menu    = $part.find('.part-menu').first();
				var was_open = $menu.hasClass('open');

				close_part_menus();

				if ( ! was_open ) {
					$menu.addClass('open');
					$part.addClass('part-menu-open');
					part_menu_view( $menu, 'menu' );
				}
			}

			$(document).on('click', '.part-options-toggle', function() {
				part_menu_toggle( $( this ).closest('.template-part') );
			});

			//The part title is the affordance the old "Select %s" label used to be,
			//so it opens the same options menu the ellipsis does - an unset part to
			//pick one, a set part to edit or reset it.
			$(document).on('click', '.template-part-inner .part-title, .template-part-inner .part-sub-label', function() {
				part_menu_toggle( $( this ).closest('.template-part') );
			});

			//Registered once here rather than per open, which is what the panels used
			//to do - each open stacked another global listener that never came off.
			$(document).on('click.sydneyPartMenu', function(e) {
				if ( ! $(e.target).closest('.part-menu, .part-options-toggle, .part-title, .part-sub-label').length ) {
					close_part_menus();
				}
			});

			$(document).on('click', '.part-menu-back', function() {
				part_menu_view( $( this ).closest('.part-menu'), 'menu' );
			});

			//delete
			$(document).on('click', '.template-options .delete-template', function(e) {
				e.preventDefault();

				var $template_item = $(this).closest('.template-item');
				var i18n           = window.sydney_dashboard.i18n;

				template_confirm({
					title:         i18n.confirm_delete_title,
					message:       i18n.confirm_delete_message,
					confirm_label: i18n.confirm_delete_button,
					trigger:       this
				}, function () {

					$template_item.fadeOut(300, function() {
						$(this).remove();
					} );

					save_notice();

				});
			});

			$( '#template-builder' ).sortable({
				opacity: 0.6,
				revert: true,
				animation: 150,
				cursor: 'move',
				cancel: '.not-sortable',
				handle: '.sort-handle',
			});

			//"Header" becomes "Header (1)", and duplicating that gives "Header (2)" -
			//the counter is re-derived from the base name rather than nested.
			function unique_template_name( name ) {
				name = $.trim( name || '' );

				if ( ! name ) {
					return name;
				}

				var taken = {};

				$('#template-builder .template-item input[name="template_name"]').each(function() {
					taken[ $.trim( $(this).val() || '' ) ] = true;
				});

				if ( ! taken[ name ] ) {
					return name;
				}

				var base 	= name.replace(/\s*\(\d+\)$/, '');
				var index 	= 1;

				while ( taken[ base + ' (' + index + ')' ] ) {
					index++;
				}

				return base + ' (' + index + ')';
			}

			//duplicate
			$(document).on('click', '.template-options .duplicate-template', function(e) {
				e.preventDefault();

				//The outside-click close runs after this handler, so an open part menu
				//would be cloned open.
				close_part_menus();

				var $source 		= $(this).closest('.template-item');
				var $template_item 	= $source.clone();

				$template_item.attr('data-id', 'sydney-template-' + Math.random().toString(36).slice(2)); //replace id

				//Read off the source: cloning an input copies its value attribute, not
				//whatever has been typed into it since.
				$template_item.find('input[name="template_name"]').val(
					unique_template_name( $source.find('input[name="template_name"]').val() )
				);

				$template_item.insertAfter($(this).closest('.template-item')).hide().fadeIn(300);

				refresh_part_sub_labels();
				refresh_applies_to();

				save_notice();
			});


			//select existing
			$(document).on('click', '.part-options .select-existing', function() {
				part_menu_view( $(this).closest('.part-menu'), 'list' );
			});

			//PHP prints every picker from one snapshot taken on load, so a part made
			//in this session has to be added to them by hand. Every picker, not just
			//the row that made it - including the blank card Add Template clones,
			//which came from the same snapshot.
			function add_part_to_pickers( id, title, page_builder ) {
				$('.existing-parts-wrapper').each(function() {
					var $wrapper 	= $(this);
					var $list 		= $wrapper.find('.existing-parts-list');

					//The first part on a site replaces the empty notice.
					if ( ! $list.length ) {
						$wrapper.find('.part-menu-empty').remove();
						$list = $('<div class="existing-parts-list"></div>').appendTo( $wrapper );
					}

					//No header options yet, so the picker's own defaults apply until
					//some are set and synced onto the row.
					$('<span class="part-menu-item existing-parts-item"></span>')
						.attr( 'data-id', id )
						.attr( 'data-page-builder', page_builder )
						.text( title )
						.appendTo( $list );
				});
			}

			//select existing
			$(document).on('click', '.existing-parts-item', function() {
				var $item 			= $(this);
				var $template_item 	= $item.closest('.template-item');
				var $part 			= $item.closest('.template-part');
				var part_type 		= $part.data('part-type');

				$template_item.find('input[name="' + part_type + '"]').val( $item.data('id') );

				//The slot now points at a different part, so it inherits that
				//part's own saved options rather than keeping the last one's.
				if ( part_type === 'header' ) {
					$part.find('input[name="header_sticky"]').val( $item.attr('data-header-sticky') || '0' );
					$part.find('input[name="header_transparent"]').val( $item.attr('data-header-transparent') || '0' );
				}

				$part.attr('data-part-active', 'active');
				$part.attr('data-page-builder', $item.data('page-builder'));

				//Setting a Global part changes what the other cards inherit.
				refresh_part_sub_labels();

				close_part_menus();

				save_notice();
			});

			//reset
			$(document).on('click', '.part-options .reset', function() {
				var $template_item 	= $(this).closest('.template-item');
				var $part 			= $(this).closest('.template-part');
				var part_type 		= $part.data('part-type');

				$template_item.find('input[name="' + part_type + '"]').val('');

				//Nothing assigned, so there is no part for these to be posted
				//against. Left set, they would be applied to whatever is picked next.
				if ( part_type === 'header' ) {
					$part.find('input.header-option').val('0');
				}

				$part.attr('data-part-active', 'inactive');

				//Clearing a Global part sends the other cards back to the theme default.
				refresh_part_sub_labels();

				close_part_menus();

				save_notice();
			});

			//select page builder
			$(document).on('click', '.part-options .select-page-builder', function() {
				part_menu_view( $(this).closest('.part-menu'), 'builder' );
			});

			//Both builders open in the same overlay. Elementor's editor is already
			//chrome-free; the block editor is stripped by sydney-canvas=1 on the URL,
			//which class-dashboard.php puts there.
			function open_editor_iframe( url ) {
				var $wrapper = $( '.sydney-elementor-iframe-wrapper' );

				$wrapper.find( '.sydney-elementor-iframe' )
					.one( 'load', function() {
						$wrapper.show().css( 'z-index', '9999' );
					} )
					.attr( 'src', url );
			}

			//Same-origin iframe, so the parent can read the editor's own dirty
			//flag: Elementor's saver, or the block editor's stores. Any failure
			//means the editor isn't booted or the API moved - never block the close.
			function editor_has_unsaved_changes() {
				try {
					var win = $( '.sydney-elementor-iframe' )[0].contentWindow;

					if ( win.elementor && win.elementor.saver ) {
						return win.elementor.saver.isEditorChanged();
					}

					if ( win.wp && win.wp.data && win.wp.data.select( 'core/editor' ) ) {
						if ( win.wp.data.select( 'core/editor' ).isEditedPostDirty() ) {
							return true;
						}

						//Core's own leave warning checks dirty entity records too,
						//which catches synced patterns edited inline.
						var core = win.wp.data.select( 'core' );

						return !! ( core && core.__experimentalGetDirtyEntityRecords && core.__experimentalGetDirtyEntityRecords().length );
					}
				} catch ( e ) {}

				return false;
			}

			//Bound once: the callbacks that open the overlay run many times per page.
			$(document).on('click', '.sydney-editor-close', function() {
				if ( editor_has_unsaved_changes() && ! window.confirm( window.sydney_dashboard.i18n.unsaved_editor_changes || '' ) ) {
					return false;
				}

				$( '.sydney-elementor-iframe-wrapper' ).hide().css( 'z-index', '0' );

				//Swap in a fresh iframe rather than keep or navigate the old one: a
				//discarded-but-dirty editor's own beforeunload would fire the
				//browser's Leave Site prompt the next time a part sets src on it.
				//Detaching skips beforeunload entirely.
				$( '.sydney-elementor-iframe' ).replaceWith( '<iframe class="sydney-elementor-iframe"></iframe>' );

				return false;
			});

			//create new
			$(document).on('click', '.page-builder-wrapper .create-new', function() {

				var $template_item = $(this).closest('.template-item');
				var id 	= $template_item.data('id');
				var part 		= $(this ).parents('.template-part');
				var part_type 	= part.data('part-type');

				var page_builder = $(this).data('page-builder');

				//spinner
				$(this).append('<i class="dashicons dashicons-update-alt page-builder-spinner"></i>');

				//Read live, so an unsaved rename still names the new part.
				var template_name = $template_item.find('input[name="template_name"]').val() || '';

				$.post( window.sydney_dashboard.ajax_url, {
					action: 'insert_template_part_callback',
					key: id,
					part_type: part_type,
					page_builder: page_builder,
					template_name: template_name,
					//Always a fresh part: Create New stays available on a set slot so
					//it can be swapped without resetting first, and Edit is what
					//reopens the one already assigned.
					part_id: '',
					nonce: window.sydney_dashboard.nonce,
				}, function ( response ) {
					if( response.success ) {
						$template_item.find('input[name="' + part_type + '"]').val(response.data.id);

						//Brand new, so it carries no options of its own yet.
						if ( part_type === 'header' ) {
							part.find('input.header-option').val('0');
						}

						//Offer it everywhere straight away, rather than only after a
						//reload. The sub-labels read the name back out of the picker.
						add_part_to_pickers(response.data.id, response.data.title || '', page_builder);

						//A new Global part is something the other cards now inherit.
						refresh_part_sub_labels();

						open_editor_iframe( response.data.url );

						//Handle save notice
						save_notice();

						//set the page builder
						part.attr('data-page-builder', page_builder );

						//this part is active
						setTimeout(function() {
							part.attr('data-part-active', 'active');
							$('.page-builder-spinner').remove();
						}, 3000);
					}
				});

				return false;

			});

			//handle edit
			$(document).on('click', '.part-options .edit-part', function() {
				var part = $(this ).parents('.template-part');
				var part_type = part.data('part-type');
				//The spinner replaces the row's icon; the label stays untouched.
				var $icon    = $(this).children('svg');
				//Clone the Reset row's circular arrow: same icon set, so it keeps the
				//menu icons' box, color and baseline without any correction rules.
				var $spinner = part.find('.part-options .reset svg').first().clone().addClass('part-menu-spinner');

				var id = part.find('input[name="' + part_type + '"]').val();

				var page_builder = part.data('page-builder');

				if ( $spinner.length ) {
					$icon.hide().before( $spinner );
				}

				$.post( window.sydney_dashboard.ajax_url, {
					action: 'edit_template_part_callback',
					key: id,
					part_type: part_type,
					page_builder: page_builder,
					nonce: window.sydney_dashboard.nonce,
				}, function ( response ) {
					if( response.success ) {
						open_editor_iframe( response.data.url );
					}

					setTimeout(function() {
						$spinner.remove();
						$icon.show();
					}, 3000);
				});

			} );

			//Sub-label under each part title: what renders in that slot while nothing
			//is assigned there. Derived from the current DOM only, so every path that
			//sets or clears a part just calls this instead of patching labels itself.
			//CSS hides the sub-label while the part is set, so the text is kept warm
			//for the moment it is cleared again.
			function refresh_part_sub_labels() {
				var $builder = $('#template-builder');

				if ( !$builder.length ) {
					return;
				}

				var theme_default = $builder.attr('data-label-theme-default');
				var inherited     = $builder.attr('data-label-inherited');

				$builder.find('.template-item').each(function() {
					var is_global = $(this).attr('data-id') === 'global';

					$(this).find('.template-part').each(function() {
						var $part = $(this);
						var id    = $part.find('input.part-id').val();
						var name  = id ? part_name( $part, id ) : '';

						if ( name ) {
							//The slot's own value, so no inheritance arrow.
							$part.find('.part-sub-label').addClass('part-sub-label--assigned');
							$part.find('.part-sub-label-text').text( name );

							return;
						}

						//Only Global bottoms out at the theme's own output; every other
						//template falls through to Global whatever Global resolves to.
						$part.find('.part-sub-label').removeClass('part-sub-label--assigned');
						$part.find('.part-sub-label-text').text( is_global ? theme_default : inherited );
					});
				});
			}

			//Condition id -> label, read off the flat list the modal builds its
			//condition select from - PHP already concatenated the groups into it,
			//filter-injected ones included. Absent in the free version, which prints
			//no conditions script.
			function dc_condition_labels() {
				var map = {};

				if ( typeof window.sydneyDCConditions === 'undefined' ) {
					return map;
				}

				$.each(window.sydneyDCConditions, function(i, section) {
					//A section with no options is a condition in its own right - `all` is one.
					if ( !section.options || !section.options.length ) {
						map[ section.id ] = section.text;

						return;
					}

					$.each(section.options, function(k, option) {
						map[ option.id ] = option.text;
					});
				});

				return map;
			}

			//What a card's display conditions add up to, in words. Lists what is
			//configured rather than asserting how overlapping rules resolve.
			function refresh_applies_to() {
				var $builder = $('#template-builder');

				if ( !$builder.length ) {
					return;
				}

				var i18n    = window.sydney_dashboard.i18n;
				var generic = dc_condition_labels();

				$builder.find('.template-item').each(function() {
					var $card = $(this);
					var $line = $card.find('.template-applies').first();

					if ( !$line.length ) {
						return;
					}

					var is_global = $card.attr('data-id') === 'global';
					var value;

					if ( is_global ) {
						value = i18n.applies_global;
					} else {
						var $control = $card.find('.sydney-display-conditions-control').first();
						var labels   = ( $control.data('condition-settings') || {} ).labels || {};
						var include  = [];
						var exclude  = [];
						var parsed   = [];

						try {
							parsed = JSON.parse( $card.find('.sydney-display-conditions-textarea').val() || '[]' );
						} catch ( e ) {
							parsed = [];
						}

						$.each(parsed, function(i, rule) {
							if ( !rule || !rule.condition ) {
								return;
							}

							var name = '';

							if ( rule.id ) {
								//Preferred over the server-rendered labels, so a condition added
								//since page load resolves to its object's name too.
								var $option = $control.find('select[name="id"] option[value="' + rule.id + '"]').first();

								name = $option.length ? $option.text() : ( labels[ rule.id ] || '' );
							}

							if ( !name ) {
								name = generic[ rule.condition ] || rule.condition;
							}

							( rule.type === 'exclude' ? exclude : include ).push( name );
						});

						if ( !include.length && !exclude.length ) {
							value = i18n.applies_none;
						} else {
							value = include.join(', ');

							if ( exclude.length ) {
								var except = i18n.applies_except.replace('%s', exclude.join(', '));

								value = value ? value + ' · ' + except : except;
							}
						}
					}

					//Built with text nodes - these carry post and term titles.
					var $text = $line.find('.template-applies-text').empty();

					//Global's copy reads as a sentence on its own, so it drops the label.
					if ( !is_global ) {
						$text
							.append( $('<span class="template-applies-label"></span>').text( i18n.applies_label ) )
							.append( document.createTextNode(' ') );
					}

					$text.append( $('<span class="template-applies-value"></span>').text( value ) );
				});
			}

			//Rendered empty by PHP, so the first fill happens here.
			refresh_applies_to();

			//Name of the template assigned to a part. The row's own picker lists every
			//existing part, including the ones made in this session, so it is the
			//lookup table. Not resolving means the template is gone, and the caller
			//falls back to the inherited/default text.
			function part_name( $part, id ) {
				return $part.find('.existing-parts-item[data-id="' + id + '"]').first().text();
			}

			//save notice
			function save_notice() {
				//return if free
				var $container = $('.sydney-dashboard-container');
				if ( $container.data('theme') == 'sydney' ) {
					return;
				}

				$('#save-templates').removeClass('saved').prop('disabled', false);
				$('#discard-templates').prop('disabled', false);

				//Namespaced, so repeated calls (typing, for instance) replace the
				//handler instead of stacking a new one on every change.
				$(window).off('beforeunload.sydneyTemplates').on('beforeunload.sydneyTemplates', function() {
					if ( !$('#save-templates').hasClass('saved') ) {
						return window.sydney_dashboard.i18n.unsaved_changes;
					}
				});
			}

			//A template rename is an unsaved change too
			$(document).on('input', '#template-builder input[name="template_name"]', function() {
				save_notice();
			});

			//The display conditions modal writes to this hidden input and triggers change
			$(document).on('change', '#template-builder .sydney-display-conditions-textarea', function() {
				refresh_applies_to();
				save_notice();
			});


		//Display conditions
		$(document).on('sydney-display-conditions-select2-initalize', function (event, item) {
			var $item = $(item);
			var $control = $item.closest('.sydney-display-conditions-control');
			var $typeSelectWrap = $item.find('.sydney-display-conditions-select2-type');
			var $typeSelect = $typeSelectWrap.find('select');
			var $conditionSelectWrap = $item.find('.sydney-display-conditions-select2-condition');
			var $conditionSelect = $conditionSelectWrap.find('select');
			var $idSelectWrap = $item.find('.sydney-display-conditions-select2-id');
			var $idSelect = $idSelectWrap.find('select');
			var $scheduleWrap = $item.find('.sydney-display-conditions-schedule');
			$typeSelect.select2({
			  width: '100%',
			  minimumResultsForSearch: -1
			});
			$typeSelect.on('select2:select', function (event) {
			  $typeSelectWrap.attr('data-type', event.params.data.id);
			});
			$conditionSelect.select2({
			  width: '100%',
			  dropdownCssClass: 'sydney-dc-dropdown'
			});
			//Rebuilt on every condition change: a closed list - capabilities,
			//languages, post types, page templates - is browsable, so its picker
			//opens on click, and select2 only reads minimumInputLength at init.
			var initIdSelect = function () {
			  if ($idSelect.data('select2')) {
				$idSelect.select2('destroy');
			  }

			  $idSelect.select2({
				width: '100%',
				dropdownCssClass: 'sydney-dc-dropdown',
				placeholder: '',
				allowClear: true,
				minimumInputLength: $conditionSelect.find(':selected').data('browse') ? 0 : 1,
				ajax: {
				  url: window.sydney_dashboard.ajax_url,
				  dataType: 'json',
				  delay: 250,
				  cache: true,
				  data: function data(params) {
					return {
					  action: 'sydney_templates_display_conditions_select_ajax',
					  term: params.term,
					  nonce: window.sydney_dashboard.nonce,
					  source: $conditionSelect.val()
					};
				  },
				  processResults: function processResults(response, params) {

					if (response.success) {
					  return {
						results: response.data
					  };
					}

					return {};
				  }
				}
			  });
			};
			$conditionSelect.on('select2:select', function (event) {
			  var $element = $(event.params.data.element);

			  if ($element.data('ajax')) {
				$idSelectWrap.removeClass('hidden');
			  } else {
				$idSelectWrap.addClass('hidden');
			  }

			  //The only condition that carries its own fields instead of an object id.
			  if ($element.data('fields') === 'schedule') {
				$scheduleWrap.removeClass('hidden');
			  } else {
				$scheduleWrap.addClass('hidden').find('input').val('');
			  }

			  //Options left from the previous condition's search would otherwise
			  //stay in the select and come back as results.
			  $idSelect.val(null).trigger('change').empty();
			  initIdSelect();
			});
			var $conditionSelected = $conditionSelect.find(':selected');

			if ($conditionSelected.data('ajax')) {
			  $idSelectWrap.removeClass('hidden');
			}

			if ($conditionSelected.data('fields') === 'schedule') {
			  $scheduleWrap.removeClass('hidden');
			}

			initIdSelect();
		  });
		  $(document).on('click', '.sydney-display-conditions-modal-toggle', function (event) {
			event.preventDefault();
			var $button = $(this);
			var template = wp.template('sydney-display-conditions-template');
			var $control = $button.closest('.sydney-display-conditions-control');

			//The Edit link under the card title sits outside the control, so fall back
			//to the one belonging to its card.
			if (!$control.length) {
			  $control = $button.closest('.template-item').find('.sydney-display-conditions-control').first();
			}

			var $modal = $control.find('.sydney-display-conditions-modal');
		
			if (!$modal.data('initialized')) {
			  $control.append(template($control.data('condition-settings')));
			  var $items = $control.find('.sydney-display-conditions-modal-content-list-item').not('.hidden');
		
			  if ($items.length) {
				$items.each(function () {
				  $(document).trigger('sydney-display-conditions-select2-initalize', this);
				});
			  }
		
			  $modal = $control.find('.sydney-display-conditions-modal');
			  $modal.data('initialized', true);
			  $modal.addClass('open');
			} else {
			  $modal.toggleClass('open');
			}

			//The template is rendered once per control, so a rename after that would
			//leave the heading stale. Read live, with the rendered title as fallback.
			var $modalTitle = $modal.find('.sydney-display-conditions-modal-header h3');

			if ($modalTitle.length) {
			  var settings = $control.data('condition-settings') || {};
			  var $name = $control.closest('.template-item').find('input[name="template_name"]');

			  //A cleared name reads as the generic heading, not as the name the card
			  //was rendered with. Global has no name input, so it keeps its title.
			  $modalTitle.text($name.length ? ($name.val() || settings.default_title || '') : (settings.title || ''));
			}
		  });
		  $(document).on('click', '.sydney-display-conditions-modal', function (event) {
			event.preventDefault();
			var $modal = $(this);
		
			if ($(event.target).is($modal)) {
			  $( '.sydney-display-conditions-modal' ).removeClass('open');
			}
		  });
		  $(document).on('click', '.sydney-display-conditions-modal-add', function (event) {
			event.preventDefault();
			var $button = $(this);
			var $control = $button.closest('.sydney-display-conditions-control');
			var $modal = $control.find('.sydney-display-conditions-modal');
			var $list = $modal.find('.sydney-display-conditions-modal-content-list');
			var $item = $modal.find('.sydney-display-conditions-modal-content-list-item').first().clone();
			$item.removeClass('hidden');
			$list.append($item);
			$(document).trigger('sydney-display-conditions-select2-initalize', $item);
		  });
		  $(document).on('click', '.sydney-display-conditions-modal-remove', function (event) {
			event.preventDefault();
			var $item = $(this).closest('.sydney-display-conditions-modal-content-list-item');
			$item.remove();
		  });
		  $(document).on('click', '.sydney-display-conditions-modal-save', function (event) {
			event.preventDefault();
			var data = [];
			var $button = $(this);
			var $control = $button.closest('.sydney-display-conditions-control');
			var $modal = $control.find('.sydney-display-conditions-modal');
			var $textarea = $control.find('.sydney-display-conditions-textarea');
			var $items = $modal.find('.sydney-display-conditions-modal-content-list-item').not('.hidden');
			$items.each(function () {
			  var $item = $(this);
			  var condition = $item.find('select[name="condition"]').val();
			  var rule = {
				type: $item.find('select[name="type"]').val(),
				condition: condition
			  };

			  //Date Range carries its own bounds instead of an object id.
			  if (condition === 'schedule') {
				rule.start = $item.find('input[name="start"]').val() || '';
				rule.end = $item.find('input[name="end"]').val() || '';
			  } else {
				rule.id = $item.find('select[name="id"]').val();
			  }

			  data.push(rule);
			});
			$textarea.val(JSON.stringify(data)).trigger('change');
		});

		// Tabs Navigation
		const tabs = $( '.sydney-dashboard-tabs-nav' );
		if( tabs.length ) {

			// Slides the shared underline under the active link.
			const moveTabsIndicator = function( nav ) {
				const
					list   = nav.querySelector( 'ul' ),
					active = nav.querySelector( '.sydney-dashboard-tabs-nav-item.active .sydney-dashboard-tabs-nav-link' );

				if( ! list || ! active ) {
					nav.classList.remove( 'sydney-dashboard-tabs-nav-indicator-ready' );
					return;
				}

				const
					listRect = list.getBoundingClientRect(),
					linkRect = active.getBoundingClientRect();

				// Hidden panels measure zero - wait for the resize that layout brings.
				if( ! linkRect.width ) {
					return;
				}

				list.style.setProperty( '--sydney-dashboard-tabs-indicator-top', ( linkRect.bottom - listRect.top ) + 'px' );
				list.style.setProperty( '--sydney-dashboard-tabs-indicator-offset', ( linkRect.left - listRect.left ) + 'px' );
				list.style.setProperty( '--sydney-dashboard-tabs-indicator-width', linkRect.width + 'px' );

				if( nav.classList.contains( 'sydney-dashboard-tabs-nav-indicator-ready' ) ) {
					return;
				}

				// Enable the transition a frame later so the first placement doesn't slide in.
				window.requestAnimationFrame( function(){
					nav.classList.add( 'sydney-dashboard-tabs-nav-indicator-ready' );
				} );
			};

			tabs.each(function(){
				const tabWrapperId = $( this ).data( 'tab-wrapper-id' );
				const nav          = this;

				moveTabsIndicator( nav );

				const navList = nav.querySelector( 'ul' );

				if( navList && window.ResizeObserver ) {
					new window.ResizeObserver( function(){
						moveTabsIndicator( nav );
					} ).observe( navList );
				}

				$( this ).find( '.sydney-dashboard-tabs-nav-link' ).on( 'click', function(e){
					e.preventDefault();

					const
						tabsNavLink  = $( this ).closest( '.sydney-dashboard-tabs-nav' ).find( '.sydney-dashboard-tabs-nav-link' ),
						to           = $( this ).data( 'tab-to' );

					// Tab Nav Item
					tabsNavLink.each( function(){
						$( this ).closest( '.sydney-dashboard-tabs-nav-item' ).removeClass( 'active' );
					});

					$( this ).closest( '.sydney-dashboard-tabs-nav-item' ).addClass( 'active' );

					moveTabsIndicator( nav );

					// Tab Content
					const tabContentWrapper = $( '.sydney-dashboard-tab-content-wrapper[data-tab-wrapper-id="'+ tabWrapperId +'"]' );
					tabContentWrapper.find( '> .sydney-dashboard-tab-content' ).removeClass( 'active' );
					tabContentWrapper.find( '> .sydney-dashboard-tab-content[data-tab-content-id="'+ to +'"]' ).addClass( 'active' );

					// Keep the URL on the visible tab, so a reload or a copied link lands back here.
					if( tabWrapperId === 'main' && window.history.replaceState ) {
						const url = new URL( window.location.href );

						url.searchParams.set( 'tab', to );
						window.history.replaceState( null, '', url.toString() );
					}

					// Recalculate sticky
					if( to === 'home' ) {
						$( document.body ).trigger( 'sticky_kit:recalc' );
					}
				} );
			});

		}

		// License button
		var $license = $('.sydney-license-button');

		if ($license.length) {

			$license.on('click', function (e) {

				var $button = $(this);

				if ($button.data('type') === 'activate') {
					$button.html('<i class="dashicons dashicons-update-alt"></i>' + window.sydney_dashboard.i18n.activating);
				} else {
					$button.html('<i class="dashicons dashicons-update-alt"></i>' + window.sydney_dashboard.i18n.deactivating);
				}

			});

		}

		// Install plugin
		var $plugin = $('.sydney-dashboard-plugin-ajax-button');

		if ($plugin.length) {

			$plugin.on('click', function (e) {

				e.preventDefault();

				var $button = $(this);
				var href = $button.attr('href');
				var slug = $button.data('slug');
				var type = $button.data('type');
				var path = $button.data('path');
				var caption = $button.html();

				$button.addClass('sydney-ajax-progress');
				$button.parent().siblings('.sydney-dashboard-hero-warning').remove();

				if (type === 'install') {
					$button.html('<i class="dashicons dashicons-update-alt"></i>' + window.sydney_dashboard.i18n.installing);
				} else if (type === 'activate') {
					$button.html('<i class="dashicons dashicons-update-alt"></i>' + window.sydney_dashboard.i18n.activating);
				} else if (type === 'deactivate') {
					$button.html('<i class="dashicons dashicons-update-alt"></i>' + window.sydney_dashboard.i18n.deactivating);
				}

				$.post(window.sydney_dashboard.ajax_url, {
					action: 'sydney_plugin',
					nonce: window.sydney_dashboard.nonce,
					slug: slug,
					type: type,
					path: path,
				}, function (response) {

					if (response.success) {
						if( $button.hasClass( 'sydney-ajax-success-redirect' ) ) {
							setTimeout(function () {
								$button.html(window.sydney_dashboard.i18n.redirecting);

								setTimeout(function () {
									window.location = href;
								}, 1000);
							}, 500);

							return false;
						}
						if( type === 'install' ) {
							$button
								.html( window.sydney_dashboard.i18n.deactivate )
								.removeClass( 'sydney-dashboard-link-info' )
								.addClass( 'sydney-dashboard-link-danger' )
								.removeClass( 'loading' )
								.data( 'type', 'deactivate' );
						} else if( type === 'deactivate' ) {
							$button
								.html( window.sydney_dashboard.i18n.activate )
								.removeClass( 'sydney-dashboard-link-danger' )
								.addClass( 'sydney-dashboard-link-success' )
								.removeClass( 'loading' )
								.data( 'type', 'activate' );
						} else {
							$button
								.html( window.sydney_dashboard.i18n.deactivate )
								.removeClass( 'sydney-dashboard-link-success' )
								.addClass( 'sydney-dashboard-link-danger' )
								.removeClass( 'loading' )
								.data( 'type', 'deactivate' );
						}

						$button.removeClass( 'sydney-ajax-progress' );

					} else if (response.data) {

						$button.html(caption);
						$button.parent().after('<div class="sydney-dashboard-hero-warning">' + response.data + '</div>');

					} else {

						$button.html(caption);
						$button.parent().after('<div class="sydney-dashboard-hero-warning">' + window.sydney_dashboard.i18n.failed_message + '</div>');

					}

				}).fail(function (xhr, textStatus, e) {

					$button.html(caption);
					$button.parent().after('<div class="sydney-dashboard-hero-warning">' + window.sydney_dashboard.i18n.failed_message + '</div>');

				});

			});

		}

		// Activate Module
		const $activationModuleButton = $('.sydney-dashboard-module-activation');

		if ( $activationModuleButton.length ) {
			$activationModuleButton.on('click', function (e) {
				e.preventDefault();
				const 
					$this          = $( this ),
					moduleId 	   = $this.data( 'module-id' ),
					activate   	   = $this.data( 'module-activate' ) ? true : false,
					redirectUrl	   = $this.data( 'module-redirect' ),
					loadingMessage = activate ? window.sydney_dashboard.i18n.activating : window.sydney_dashboard.i18n.deactivating;

				$this
					.html( '<i class="dashicons dashicons-update-alt"></i>' + loadingMessage )
					.removeClass( 'sydney-dashboard-link-success' )
					.addClass( 'loading' );

				$.post( window.sydney_dashboard.ajax_url, {
					action: 'sydney_module_activation_handler',
					nonce: window.sydney_dashboard.nonce,
					module: moduleId,
					activate: activate
				}, function ( response ) {
					if( response.success ) {

						if( activate ) {
							$this
								.html( window.sydney_dashboard.i18n.deactivate )
								.removeClass( 'sydney-dashboard-link-success' )
								.addClass( 'sydney-dashboard-link-danger' )
								.removeClass( 'loading' )
								.data( 'module-activate', false );

							$this
								.parent()
								.find( '.sydney-dashboard-customize-link' )
								.removeClass( 'bt-d-none' );

							if( redirectUrl ) {
								window.location = redirectUrl;
							}
						} else {
							$this
								.html( window.sydney_dashboard.i18n.activate )
								.removeClass( 'sydney-dashboard-link-danger' )
								.addClass( 'sydney-dashboard-link-success' )
								.removeClass( 'loading' )
								.data( 'module-activate', true );

							$this
								.parent()
								.find( '.sydney-dashboard-customize-link' )
								.addClass( 'bt-d-none' );

							if( redirectUrl ) {
								window.location.reload();
							}								
						}
					}
				});
			});
		}

		// Activate All Modules
		const $activationAllModulesButton = $('.sydney-dashboard-module-activation-all');

		if ( $activationAllModulesButton.length ) {
			$activationAllModulesButton.on( 'click', function(e){
				e.preventDefault();

				const 
					$this          = $( this ),
					activate   	   = $this.data( 'module-activate' ) ? true : false,
					loadingMessage = activate ? window.sydney_dashboard.i18n.activating : window.sydney_dashboard.i18n.deactivating;

				$this
					.html( loadingMessage )
					.addClass( 'loading' );

					$.post( window.sydney_dashboard.ajax_url, {
						action: 'sydney_module_activation_all_handler',
						nonce: window.sydney_dashboard.nonce,
						activate: activate
					}, function ( response ) {
						if( response.success ) {
							window.location.reload();
						}
					});
			} );
		}

		// Sticky Sidebar
		$( '.sydney-dashboard-sticky-wrapper' ).stick_in_parent({
			offset_top: 54
		});

		// Notifications Sidebar
		const $notificationsSidebar = $( '.sydney-dashboard-notifications-sidebar' );
		if( $notificationsSidebar.length ) {
		
			// Open/Toggle Sidebar
			$( '.sydney-dashboard-theme-notifications' ).on( 'click', function(e){
				e.preventDefault();

				const latestNotificationDate = $notificationsSidebar.find( '.sydney-dashboard-notification:first-child .sydney-dashboard-notification-date' ).data( 'raw-date' );

				$notificationsSidebar.toggleClass( 'opened' );

				if( ! $( this ).hasClass( 'read' ) ) {
					$.post( window.sydney_dashboard.ajax_url, {
						action: 'sydney_notifications_read',
						latest_notification_date: latestNotificationDate,
						nonce: window.sydney_dashboard.nonce,
					}, function ( response ) {
						if( response.success ) {
							setTimeout(function(){
								$( '.sydney-dashboard-theme-notifications' ).addClass( 'read' );
							}, 2000);
						}
					});
				}
			} );

			$( window ).on( 'scroll', function(){
				if( window.pageYOffset > 60 ) {
					$notificationsSidebar.addClass( 'scrolled' );
				} else {
					$notificationsSidebar.removeClass( 'scrolled' );
				}
			} );

			// Close Sidebar
			$( '.sydney-dashboard-notifications-sidebar-close' ).on( 'click', function(e){
				e.preventDefault();

				$notificationsSidebar.addClass( 'closing' );
				setTimeout(function(){
					$notificationsSidebar.removeClass( 'opened' );
					$notificationsSidebar.removeClass( 'closing' );
				}, 300);
			} );

		}

		// Option Switcher (for usage tracking toggle)
		var $optionSwitcher = $('.sydney-dashboard-option-switcher');

		if ($optionSwitcher.length) {
			$optionSwitcher.on('click', function (e) {
				e.preventDefault();

				const 
					$this          = $( this ),
					optionId 	   = $this.data( 'option-id' ),
					activate   	   = $this.data( 'option-activate' ) ? true : false,
					loadingMessage = activate ? window.sydney_dashboard.i18n.activating : window.sydney_dashboard.i18n.deactivating;

				$this
					.html( loadingMessage )
					.removeClass( 'sydney-dashboard-link-success' )
					.addClass( 'loading' );

				$.post( window.sydney_dashboard.ajax_url, {
					action: 'sydney_option_switcher_handler',
					nonce: window.sydney_dashboard.nonce,
					optionId: optionId,
					activate: activate
				}, function ( response ) {
					if( response.success ) {

						if( activate ) {
							$this
								.html( window.sydney_dashboard.i18n.deactivate )
								.removeClass( 'sydney-dashboard-link-success' )
								.addClass( 'sydney-dashboard-link-danger' )
								.removeClass( 'loading' )
								.data( 'option-activate', false );

						} else {
							$this
								.html( window.sydney_dashboard.i18n.activate )
								.removeClass( 'sydney-dashboard-link-danger' )
								.addClass( 'sydney-dashboard-link-success' )
								.removeClass( 'loading' )
								.data( 'option-activate', true );
						}

					} else {
						$this
							.html( window.sydney_dashboard.i18n.error )
							.removeClass( 'loading' );
					}
				});

			});
		}

		// Setup Checklist — manual toggle via the status button (the circle/check)
		$(document).on('click', '.sydney-setup-checklist-item-status', function (e) {
			e.preventDefault();

			var $button = $(this);
			if ($button.is('[disabled]')) {
				return;
			}
			var $row      = $button.closest('.sydney-setup-checklist-item');
			var slug      = $row.data('item-slug');
			var nextState = $button.data('complete') === 1 || $button.data('complete') === '1';
			var wasDone   = $row.hasClass('is-done');

			// Optimistic UI: flip state immediately, revert on failure.
			applyState(nextState);
			$button.addClass('is-loading');

			$.post(window.sydney_dashboard.ajax_url, {
				action:   'sydney_setup_checklist_toggle',
				nonce:    window.sydney_dashboard.nonce,
				slug:     slug,
				complete: nextState ? 'true' : 'false'
			}, function (response) {
				$button.removeClass('is-loading');

				if (!response.success) {
					applyState(wasDone);
					return;
				}

				// Reconcile against server truth, then announce.
				applyState(!!response.data.is_done);

				var itemTitle = $row.find('.sydney-setup-checklist-item-title').text();
				$('.sydney-setup-checklist-live').text(
					itemTitle + ': ' + (response.data.is_done ? window.sydney_dashboard.i18n.mark_incomplete : window.sydney_dashboard.i18n.mark_complete)
				);

				if (response.data.all_done) {
					window.location.reload();
				}
			}).fail(function () {
				$button.removeClass('is-loading');
				applyState(wasDone);
			});

			function applyState(done) {
				if (done) {
					$row.addClass('is-done');
					$button
						.data('complete', '0')
						.attr('aria-pressed', 'true')
						.attr('aria-label', window.sydney_dashboard.i18n.mark_incomplete);
				} else {
					$row.removeClass('is-done');
					$button
						.data('complete', '1')
						.attr('aria-pressed', 'false')
						.attr('aria-label', window.sydney_dashboard.i18n.mark_complete);
				}
				updateCategoryDoneState($row.closest('.sydney-setup-checklist-category'));
			}
		});

		// Setup Checklist — 1-click homepage
		$(document).on('click', '.sydney-setup-homepage-button', function (e) {
			e.preventDefault();

			var $button = $(this);
			var caption = $button.html();
			$button.html(window.sydney_dashboard.i18n.saving).attr('disabled', 'disabled');

			$.post(window.sydney_dashboard.ajax_url, {
				action: 'sydney_setup_homepage',
				nonce:  window.sydney_dashboard.nonce
			}, function (response) {
				if (!response.success) {
					$button.html(caption).removeAttr('disabled');
					return;
				}

				var $row = $button.closest('.sydney-setup-checklist-item');
				$row.addClass('is-done');
				$button
					.html(window.sydney_dashboard.i18n.edit_homepage)
					.removeAttr('disabled')
					.attr('href', response.data.home_edit_url)
					.removeClass('sydney-setup-homepage-button');
				updateCategoryDoneState($row.closest('.sydney-setup-checklist-category'));

				if (response.data.all_done) {
					window.location.reload();
				}
			}).fail(function () {
				$button.html(caption).removeAttr('disabled');
			});
		});

		// Setup Checklist — collapse/expand a fully-done section
		$(document).on('click', '.sydney-setup-checklist-category-toggle', function (e) {
			e.preventDefault();
			var $btn      = $(this);
			var $section  = $btn.closest('.sydney-setup-checklist-category');
			var collapsed = $section.toggleClass('is-collapsed').hasClass('is-collapsed');
			$btn.attr('aria-expanded', collapsed ? 'false' : 'true');
		});

		// Setup Checklist — clicking anywhere on a collapsed section header expands it.
		$(document).on('click', '.sydney-setup-checklist-category.is-collapsed .sydney-setup-checklist-category-header', function (e) {
			if ($(e.target).closest('.sydney-setup-checklist-category-toggle').length) {
				return;
			}
			var $section = $(this).closest('.sydney-setup-checklist-category');
			$section.removeClass('is-collapsed');
			$section.find('.sydney-setup-checklist-category-toggle').attr('aria-expanded', 'true');
		});

		// Once-per-page-load ping that flips the "checklist actually used"
		// flag on the server. Server-side flows (manual toggle, 1-click
		// homepage) already mark themselves used directly — this exists for
		// the JS-only events (help open, action link click, plugin install).
		var checklistMarkedUsed = false;
		function markChecklistUsed() {
			if (checklistMarkedUsed) {
				return;
			}
			checklistMarkedUsed = true;
			$.post(window.sydney_dashboard.ajax_url, {
				action: 'sydney_setup_checklist_mark_used',
				nonce:  window.sydney_dashboard.nonce
			});
		}

		// Any action link (Customize / Manage / Install Merchant CTA) inside
		// a checklist row counts as engagement.
		$(document).on('click', '.sydney-setup-checklist-item-actions a', function () {
			markChecklistUsed();
		});

		// Setup Checklist — help image dialog. Clicking a help icon opens
		// a shared native <dialog> showing the item's image. Image src is
		// cleared on close so we don't hold the bitmap when not visible.
		$(document).on('click', '.sydney-setup-checklist-help', function (e) {
			e.preventDefault();
			var dialog = document.getElementById('sydney-setup-checklist-help-dialog');
			if (!dialog) {
				return;
			}
			var src = $(this).data('help-image');
			if (!src) {
				return;
			}
			var img = dialog.querySelector('.sydney-setup-checklist-help-dialog-image');
			if (img) {
				img.src = src;
				img.alt = $(this).attr('aria-label') || '';
			}

			// Opening the help image counts as engagement.
			markChecklistUsed();

			if (typeof dialog.showModal === 'function') {
				dialog.showModal();
			} else {
				dialog.setAttribute('open', '');
			}
		});

		// Close on backdrop click - a click landing outside the dialog's own box.
		$(document).on('click', '.sydney-setup-checklist-help-dialog', function (e) {
			if (is_backdrop_click(this, e) && typeof this.close === 'function') {
				this.close();
			}
		});

		// Close button inside the dialog.
		$(document).on('click', '.sydney-setup-checklist-help-dialog-close', function () {
			var dialog = this.closest('dialog');
			if (dialog && typeof dialog.close === 'function') {
				dialog.close();
			}
		});

		// Release the image bitmap when the dialog closes. `close` doesn't
		// bubble, so jQuery delegation can't catch it — bind directly.
		(function () {
			var helpDialog = document.getElementById('sydney-setup-checklist-help-dialog');
			if (!helpDialog) {
				return;
			}
			helpDialog.addEventListener('close', function () {
				var img = helpDialog.querySelector('.sydney-setup-checklist-help-dialog-image');
				if (img) {
					img.removeAttribute('src');
				}
			});
		}());

		// Recompute fully-done state for a category after an item toggle.
		function updateCategoryDoneState($section) {
			if (!$section || !$section.length) {
				return;
			}
			var $items    = $section.find('.sydney-setup-checklist-item');
			var total     = $items.length;
			var doneCount = $items.filter('.is-done').length;
			var allDone   = total > 0 && doneCount === total;
			var wasFully  = $section.hasClass('is-fully-done');

			// Update fraction circle.
			var $progress = $section.find('.sydney-setup-checklist-category-progress');
			if ($progress.length) {
				$progress.find('.sydney-setup-checklist-category-progress-fraction').text(doneCount + '/' + total);
				$progress.attr('data-done', doneCount);
				$progress.removeClass('is-state-empty is-state-partial is-state-done');
				if (allDone) {
					$progress.addClass('is-state-done');
				} else if (doneCount > 0) {
					$progress.addClass('is-state-partial');
				} else {
					$progress.addClass('is-state-empty');
				}
			}

			if (allDone && !wasFully) {
				$section.addClass('is-fully-done is-collapsed');
				$section.find('.sydney-setup-checklist-category-toggle').attr('aria-expanded', 'false');
			} else if (!allDone && wasFully) {
				$section.removeClass('is-fully-done is-collapsed');
				$section.find('.sydney-setup-checklist-category-toggle').attr('aria-expanded', 'true');
			}
		}

	});

})(jQuery);
