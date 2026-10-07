<?php
/**
 * Active and partial callback functions
 *
 * @package Sydney
 */


/**
 * Footer widgets divider
 */
function sydney_callback_footer_widgets_divider() {
    
    $divider = get_theme_mod( 'footer_widgets_divider' );

	if ( $divider ) {
		return true;
	} else {
		return false;
	}   
}

function sydney_callback_sidebar_archives() {
    $sidebar = get_theme_mod( 'sidebar_archives' );

	if ( $sidebar ) {
		return true;
	} else {
		return false;
	}       
}

/**
 * Single post archives
 */
function sydney_callback_sidebar_single_post() {
    $sidebar = get_theme_mod( 'sidebar_single_post', 1 );

	if ( $sidebar ) {
		return true;
	} else {
		return false;
	}       
}

/**
 * Sale percentage
 */
function sydney_callback_sale_percentage() {
    $enable = get_theme_mod( 'sale_badge_percent', 0 );

	if ( $enable ) {
		return true;
	} else {
		return false;
	}  
}

/**
 * Footer credits divider
 */
function sydney_callback_footer_credits_divider() {
    $divider = get_theme_mod( 'footer_credits_divider', 1 );

	if ( $divider ) {
		return true;
	} else {
		return false;
	}      
}

/**
 * Enable custom palette
 */
function sydney_callback_custom_palette() {
    $enable = get_theme_mod( 'custom_palette_toggle', 0 );

	if ( $enable ) {
		return true;
	} else {
		return false;
	}      
}

/**
 * Excerpt
 */
function sydney_callback_excerpt() {
    $enable = get_theme_mod( 'show_excerpt', 0 );

	if ( $enable ) {
		return true;
	} else {
		return false;
	}   
}

/**
 * Scroll to top
 */
function sydney_callback_scrolltop() {
    $enable = get_theme_mod( 'enable_scrolltop', 1 );

	if ( $enable ) {
		return true;
	} else {
		return false;
	}   
}

function sydney_callback_scrolltop_text() {
    $enable = get_theme_mod( 'enable_scrolltop', 1 );
	$type   = get_theme_mod( 'scrolltop_type', 'icon' );

	if ( $enable && 'text' === $type ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Read more
 */
function sydney_callback_read_more() {
    $enable = get_theme_mod( 'read_more_link', 0 );

	if ( $enable ) {
		return true;
	} else {
		return false;
	}   
}

/**
 * Grid archives
 */
function sydney_callback_grid_archives() {
	$layout = get_theme_mod( 'blog_layout', 'layout3' );

	if ( 'layout3' === $layout || 'layout5' === $layout || 'layout7' === $layout ) {
		return true;
	} else {
		return false;
	}
}

/**
 * List archives
 */
function sydney_callback_list_archives() {
	$layout = get_theme_mod( 'blog_layout', 'layout3' );

	if ( 'layout4' === $layout ) {
		return true;
	} else {
		return false;
	}
}

/**
 * List archives
 */
function sydney_callback_list_general_archives() {
	$layout = get_theme_mod( 'blog_layout', 'layout3' );

	if ( 'layout4' === $layout || 'layout6' === $layout ) {
		return true;
	} else {
		return false;
	}
}


/**
 * Author avatar
 */
function sydney_callback_author_avatar() {
	$meta = get_theme_mod( 'archive_meta_elements', array( 'post_date' ) );

	if ( in_array( 'post_author', $meta, true ) ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Header layouts
 */
function sydney_callback_header_layout_1_2() {
	$layout = get_theme_mod( 'header_layout_desktop', 'header_layout_1' );

	if ( 'header_layout_1' === $layout || 'header_layout_2' === $layout || 'header_layout_6' === $layout || 'header_layout_7' === $layout ) {
		return true;
	} else {
		return false;
	}
}

function sydney_callback_header_layout_3() {
	$layout = get_theme_mod( 'header_layout_desktop', 'header_layout_1' );
	
	if ( 'header_layout_3' === $layout ) {
		return true;
	} else { 
		return false;
	}
}

function sydney_callback_header_layout_4() {
	$layout = get_theme_mod( 'header_layout_desktop', 'header_layout_1' );
	
	if ( 'header_layout_4' === $layout ) {
		return true;
	} else { 
		return false;
	}
}


function sydney_callback_header_layout_5() {
	$layout = get_theme_mod( 'header_layout_desktop', 'header_layout_1' );
	
	if ( 'header_layout_5' === $layout ) {
		return true;
	} else { 
		return false;
	}
}

function sydney_callback_header_bottom() {
	$layout = get_theme_mod( 'header_layout_desktop', 'header_layout_1' );

	if ( 'header_layout_3' === $layout || 'header_layout_4' === $layout || 'header_layout_5' === $layout ) {
		return true;
	} else { 
		return false;
	}
}


/**
 * Disable sticky and container options for header layouts 6 and 7
 */
function sydney_callback_container_sticky() {
	$layout = get_theme_mod( 'header_layout_desktop', 'header_layout_2' );

	if ( 'header_layout_6' !== $layout && 'header_layout_7' !== $layout ) {
		return true;
	} else {
		return false;
	}
}

function sydney_callback_header_layouts_6_7() {
	$layout = get_theme_mod( 'header_layout_desktop', 'header_layout_2' );

	if ( 'header_layout_6' === $layout || 'header_layout_7' === $layout ) {
		return true;
	} else {
		return false;
	}
}


/**
 * Sticky header
 */
function sydney_callback_sticky_header() {
	$enable = get_theme_mod( 'enable_sticky_header', 1 );
	$layout = get_theme_mod( 'header_layout_desktop', 'header_layout_2' );

	if ( $enable && 'header_layout_6' !== $layout && 'header_layout_7' !== $layout ) {
		return true;
	} else {
		return false;
	}
}


/**
 * Header elements
 */
function sydney_callback_header_elements( $element ) {

	$layout = get_theme_mod( 'header_layout_desktop', 'header_layout_1' );

	// The same defaults the settings register, so an unsaved list reads as the
	// list the header actually renders. Without one in_array() gets false.
	$defaults = sydney_get_default_header_components();

	switch ( $layout ) {
		case 'header_layout_1':
		case 'header_layout_2':
		case 'header_layout_6':
		case 'header_layout_7':
			$elements = get_theme_mod( 'header_components_l1', $defaults['l1'] );

			if ( in_array( $element, $elements, true ) ) {
				return true;
			} else {
				return false;
			}

			break;

		case 'header_layout_3':
			$elements       = get_theme_mod( 'header_components_l3left', $defaults['l3left'] );
			$elements_right = get_theme_mod( 'header_components_l3right', $defaults['l3right'] );

			if ( in_array( $element, $elements, true ) || in_array( $element, $elements_right, true ) ) {
				return true;
			} else {
				return false;
			}

			break;

		case 'header_layout_4':
			$elements        = get_theme_mod( 'header_components_l4top', $defaults['l4top'] );
			$elements_bottom = get_theme_mod( 'header_components_l4bottom', $defaults['l4bottom'] );

			if ( in_array( $element, $elements, true ) || in_array( $element, $elements_bottom, true ) ) {
				return true;
			} else {
				return false;
			}

			break;

		case 'header_layout_5':
			$elements        = get_theme_mod( 'header_components_l5topleft', $defaults['l5topleft'] );
			$elements_right  = get_theme_mod( 'header_components_l5topright', $defaults['l5topright'] );
			$elements_bottom = get_theme_mod( 'header_components_l5bottom', $defaults['l5bottom'] );

			if ( in_array( $element, $elements, true ) || in_array( $element, $elements_bottom, true ) || in_array( $element, $elements_right, true ) ) {
				return true;
			} else {
				return false;
			}

			break;

		default:
			return false;

			break;
	}
}

/**
 * Top bar elements
 */
function sydney_callback_topbar_elements( $element ) {
	
	$elements_left  = get_theme_mod( 'topbar_components_left' );
	$elements_right = get_theme_mod( 'topbar_components_right' );

	if ( in_array( $element, $elements_left, true ) || in_array( $element, $elements_right, true ) ) {
		return true;
	} else {
		return false;
	}
}

function sydney_callback_topbar_center_contents() {
	$elements_left  = get_theme_mod( 'topbar_components_left' );
	$elements_right = get_theme_mod( 'topbar_components_right' );   

	if ( empty( $elements_left ) || empty( $elements_right ) ) {
		return true;
	} else {
		return false;
	}   
}

function sydney_callback_related_post_title() {
    $enable = get_theme_mod( 'single_post_show_related_posts', 0 );

	if ( $enable ) {
		return true;
	} else {
		return false;
	}       
}

function sydney_callback_menu_position() {
    $layout = get_theme_mod( 'header_layout_desktop', 'header_layout_2' );

	if ( 'header_layout_2' === $layout ) {
		return true;
	} else {
		return false;
	}       
}

function sydney_callback_menu_typography() {
    $enable = get_theme_mod( 'enable_top_menu_typography', 0 );

	if ( $enable ) {
		return true;
	} else {
		return false;
	}       
}

function sydney_callback_blog_page_title() {
    $enable = get_theme_mod( 'blog_index_title', 0 );

	if ( $enable ) {
		return true;
	} else {
		return false;
	}   
}

//Featured posts
function sydney_callback_featured_posts() {
    $enable = get_theme_mod( 'enable_featured_posts', 0 );

	if ( $enable ) {
		return true;
	} else {
		return false;
	}       
}

//Featured boxes
function sydney_callback_featured_boxes() {
    $enable = get_theme_mod( 'enable_featured_boxes', 0 );

	if ( $enable ) {
		return true;
	} else {
		return false;
	}       
}

//Post sharing
function sydney_callback_single_post_sharing() {
    $enable = get_theme_mod( 'enable_post_sharing', 0 );

	if ( $enable ) {
		return true;
	} else {
		return false;
	}       
}

//Read more link
function sydney_callback_read_more_link() {
    $enable = get_theme_mod( 'read_more_link', 0 );

	if ( $enable ) {
		return true;
	} else {
		return false;
	}       
}

//Load more
function sydney_callback_load_more_posts() {
    $enable = get_theme_mod( 'pagination_type', 'numeric' );

	if ( 'button' === $enable ) {
		return true;
	} else {
		return false;
	}       
}   


//Post header
function sydney_callback_post_header_banner() {
    $enable = get_theme_mod( 'post_header_layout', 'layout1' );

	if ( 'layout1' !== $enable ) {
		return true;
	} else {
		return false;
	}       
}

function sydney_callback_post_header_overlay() {
	$enable = get_theme_mod( 'post_header_layout', 'layout1' );

	if ( 'layout3' === $enable ) {
		return true;
	} else {
		return false;
	}       
}

function sydney_callback_archive_header_overlay() {
	$enable = get_theme_mod( 'archive_title_layout', 'layout1' );

	if ( 'layout2' === $enable ) {
		return true;
	} else {
		return false;
	}       
}

function sydney_callback_post_header_custom_content() {
	$enable = get_theme_mod( 'post_header_custom_content_toggle', 0 );

	if ( $enable ) {
		return true;
	} else {
		return false;
	}       
}

/**
 * Whether the given archive meta element is enabled.
 */
function sydney_callback_archive_meta_elements( $element ) {
	
	$elements   = get_theme_mod( 'archive_meta_elements' );

	if ( in_array( $element, $elements ) ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Whether the given single-post meta element is enabled.
 */
function sydney_callback_single_meta_elements( $element ) {
	
	$elements   = get_theme_mod( 'single_post_meta_elements' );

	if ( in_array( $element, $elements ) ) {
		return true;
	} else {
		return false;
	}
}

//Archive header
function sydney_callback_archive_title_layout() {
    $enable = get_theme_mod( 'archive_title_layout', 'layout1' );

	if ( 'layout1' !== $enable ) {
		return true;
	} else {
		return false;
	}       
}

//Reading progress
function sydney_callback_reading_progress() {
    $enable = get_theme_mod( 'single_post_reading_progress', 0 );

	if ( $enable ) {
		return true;
	} else {
		return false;
	}       
}


//Footer reveal
function sydney_footer_reveal_callback() {
    $enable = get_theme_mod( 'enable_footer_reveal', 0 );

	if ( $enable ) {
		return true;
	} else {
		return false;
	}       
}

//Copyright elements
function sydney_callback_copyright_elements( $element ) {
	$elements_left  = get_theme_mod( 'footer_copyright_components_left' );
	$elements_right = get_theme_mod( 'footer_copyright_components_right' );

	if ( in_array( $element, $elements_left ) || in_array( $element, $elements_right ) ) {
		return true;
	} else {
		return false;
	}   
}

//Separator
function sydney_callback_footer_separator() {
	$enable = get_theme_mod( 'enable_footer_separator', 0 );

	if ( $enable ) {
		return true;
	} else {
		return false;
	}       
}

//Footer contact right
function sydney_callback_footer_contact_right( $element ) {
	$footer_action_right_select = get_theme_mod( 'footer_action_right_select', 'shortcode' );

	if ( $element === $footer_action_right_select ) {
		return true;
	} else {
		return false;
	}
}

//quick links
function sydney_callback_quick_links() {
	$enable = get_theme_mod( 'enable_quick_links', 0 );

	if ( $enable ) {
		return true;
	} else {
		return false;
	}       
}

//wishlist
function sydney_callback_shop_product_wishlist_layout() {
	$layout = get_theme_mod( 'shop_product_wishlist_layout', 'layout1' );

	if( 'layout1' !== $layout ) {
		return true;
	} else {
		return false;
	}
}
function sydney_callback_shop_product_wishlist_tooltip() {
	$layout = get_theme_mod( 'shop_product_wishlist_layout', 'layout1' );
	$enable = get_theme_mod( 'shop_product_wishlist_tooltip', 0 );

	if( $enable && 'layout1' !== $layout ) {
		return true;
	} else {
		return false;
	}
}

//Gallery
function sydney_callback_single_product_gallery_image_layout() {
	$layout = get_theme_mod( 'single_product_gallery', 'gallery-default' );

	if ( 'gallery-showcase' === $layout || 'gallery-full-width' === $layout ) {
		return true;
	} else {
		return false;
	}   
}

//Shop header styles
function sydney_callback_shop_archive_header_style_alignment() {
	$style = get_theme_mod( 'shop_archive_header_style', 'style1' );

	if ( 'style2' !== $style ) {
		return true;
	} else {
		return false;
	}   
}

//Sticky add to cart
function sydney_callback_single_sticky_add_to_cart() {
	$enable = get_theme_mod( 'single_sticky_add_to_cart', 0 );

	if ( $enable ) {
		return true;
	} else {
		return false;
	}   
}

//Tabs
function sydney_single_product_tabs_alignment() {
	$layout = get_theme_mod( 'single_product_tabs_layout', 'style1' );

	if( ! in_array( $layout, array( 'style6' ) ) ) {
		return true;
	} else {
		return false;
	}
}

function sydney_single_product_tabs_is_accordion_layout() {
	$layout = get_theme_mod( 'single_product_tabs_layout', 'style1' );

	if( in_array( $layout, array( 'style6' ) ) ) {
		return true;
	} else {
		return false;
	}
}

function sydney_single_product_reviews_advanced_enable() {
	$enable = get_theme_mod( 'single_product_reviews_advanced_enable', 0 );

	if( $enable ) {
		return true;
	} else {
		return false;
	}
}

function sydney_callback_single_tabs_border_color_active() {
	$layout = get_theme_mod( 'single_product_tabs_layout', 'style1' );

	if( ! in_array( $layout, array( 'style3', 'style5', 'style6' ) ) ) {
		return true;
	} else {
		return false;
	}
}

function sydney_callback_single_tabs_background_color() {
	$layout = get_theme_mod( 'single_product_tabs_layout', 'style1' );

	if( ! in_array( $layout, array( 'style1', 'style2', 'style6' ) ) ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Single product elements
 */
function sydney_single_product_elements_show() {
	$single_product_gallery = get_theme_mod( 'single_product_gallery', 'gallery-default' );

	if ( 'gallery-full-width' !== $single_product_gallery ) {
		return true;
	} else {
		return false;
	} 
}

function sydney_callback_single_product_elements( $element ) {

	$elements = get_theme_mod( 'single_product_elements_order' );

	if ( in_array( $element, $elements ) ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Shop Ajax Search
 */
function sydney_shop_search_ajax_is_enabled() {
	$enable = get_theme_mod( 'shop_search_enable_ajax', 0 );

	if ( $enable ) {
		return true;
	} else {
		return false;
	} 
}


/**
 * WooCommerce product catalog sidebar
 */
function sydney_callback_shop_archive_sidebar_slide() {
	$sidebar = get_theme_mod( 'shop_archive_sidebar', 'no-sidebar' );

	if ( 'sidebar-slide' === $sidebar ) {
		return true;
	} else {
		return false;
	}   
}

function sydney_callback_shop_archive_sidebar_top() {
	$sidebar = get_theme_mod( 'shop_archive_sidebar', 'no-sidebar' );

	if ( 'sidebar-top' === $sidebar ) {
		return true;
	} else {
		return false;
	}   
}

/**
 * Typography Adobe Fonts library
 */
function sydney_font_library_google() {
	$lib = get_theme_mod( 'fonts_library', 'google' );

	if ( $lib === 'google' ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Typography Google Fonts library
 */
function sydney_font_library_adobe() {
	$lib = get_theme_mod( 'fonts_library', 'google' );

	if ( $lib === 'adobe' ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Modal Popup
 */
if( ! function_exists( 'sydney_callback_modal_popup_not_layout_3' ) ) {
    function sydney_callback_modal_popup_not_layout_3() {
        $layout = get_theme_mod( 'modal_popup_layout', 'style1' );

        if( 'style3' !== $layout ) {
            return true;
        } else {
            return false;
        }
    }
}

if( ! function_exists( 'sydney_callback_modal_popup_display_post_types' ) ) {
    function sydney_callback_modal_popup_display_post_types() {
        $type = get_theme_mod( 'modal_popup_display', 'all' );

        if( 'post-types' === $type ) {
            return true;
        } else {
            return false;
        }
    }
}

if( ! function_exists( 'sydney_callback_modal_popup_display_posts_in' ) ) {
    function sydney_callback_modal_popup_display_posts_in() {
        $type = get_theme_mod( 'modal_popup_display', 'all' );

        if( 'posts-in' === $type ) {
            return true;
        } else {
            return false;
        }
    }
}

if( ! function_exists( 'sydney_callback_modal_popup_display_posts_and_types' ) ) {
    function sydney_callback_modal_popup_display_posts_and_types() {
        $type = get_theme_mod( 'modal_popup_display', 'all' );

        if( 'post-types' === $type || 'posts-in' === $type ) {
            return true;
        } else {
            return false;
        }
    }
}

function sydney_font_library_custom() {
	$custom_fonts  = Sydney_Modules::is_module_active( 'custom-fonts' );
	$fonts_library = get_theme_mod( 'fonts_library', 'google' );

	if ( $custom_fonts && $fonts_library === 'custom' ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Offcanvas content
 */
function sydney_offcanvas_custom_content_callback() {
	$custom_content = get_theme_mod( 'offcanvas_content', 'custom' );

	if ( 'custom' === $custom_content ) {
		return true;
	} else {
		return false;
	}
}

function sydney_offcanvas_content_sidebar_callback() {
	$custom_content = get_theme_mod( 'offcanvas_content', 'custom' );

	if ( 'sidebar' === $custom_content ) {
		return true;
	} else {
		return false;
	}
}

function sydney_offcanvas_content_elementor_callback() {
	$custom_content = get_theme_mod( 'offcanvas_content', 'custom' );

	if ( 'elementor' === $custom_content ) {
		return true;
	} else {
		return false;
	}
}

function sydney_callback_modal_popup_elementor_template() {
	$type = get_theme_mod( 'modal_popup_content_type', 'modal_popup_content' );

	if( 'elementor_template' === $type ) {
		return true;
	} else {
		return false;
	}
}

function sydney_callback_modal_popup_content() {
	$type = get_theme_mod( 'modal_popup_content_type', 'modal_popup_content' );

	if( 'modal_popup_content' === $type ) {
		return true;
	} else {
		return false;
	}
}

function sydney_callback_meta_theme_color() {
	$enable = get_theme_mod( 'enable_meta_theme_color', 0 );

	if ( $enable ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Transparent header
 */
function sydney_callback_transparent_header() {
	$transparent_header = get_theme_mod( 'transparent_header', '' );

	if ( ! empty( $transparent_header ) && '[]' !== $transparent_header ) {
		return true;
	} else {
		return false;
	}
}

function sydney_callback_scrollbar() {
	$enable = get_theme_mod( 'enable_scrollbar_custom', 0 );

	if ( $enable ) {
		return true;
	} else {
		return false;
	}
}

function sydney_callback_offcanvas_link_separator() {
	$enable = get_theme_mod( 'mobile_menu_link_separator', 0 );

	if ( $enable ) {
		return true;
	} else {
		return false;
	}
}

function sydney_block_templates_active_callback() {
	$enable = get_theme_mod( 'enable_block_templates', 0 );

	if ( $enable ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Header Builder
 */
if ( ! function_exists( 'sydney_shfb_search_layout_is_hidden' ) ) {
	function sydney_shfb_search_layout_is_hidden() {
		$layout = get_theme_mod( 'shfb_search_layout', 'hidden' );

		if ( 'hidden' === $layout ) {
			return true;
		} else {
			return false;
		} 
	}
}

if ( ! function_exists( 'sydney_shfb_search_layout_is_visible' ) ) {
	function sydney_shfb_search_layout_is_visible() {
		$layout = get_theme_mod( 'shfb_search_layout', 'hidden' );

		if ( 'visible' === $layout ) {
			return true;
		} else {
			return false;
		} 
	}
}

/**
 * Sticky Header
 */
if ( ! function_exists( 'sydney_sticky_header_enabled' ) ) {
	function sydney_sticky_header_enabled() {
		$enable = get_theme_mod( 'enable_sticky_header', 1 );

		if ( $enable ) {
			return true;
		} else {
			return false;
		} 
	}
}

/**
 * Header Icons
 */
if ( ! function_exists( 'sydney_callback_header_icon_search_custom_type' ) ) {
	function sydney_callback_header_icon_search_custom_type( $icon ) {
		switch ( $icon ) {
			case 'search':
				$value = get_theme_mod( 'search_icon', 'icon-search' );
				break;

			case 'cart':
				$value = get_theme_mod( 'cart_icon', 'icon-cart' );
				break;

			case 'account':
				$value = get_theme_mod( 'account_icon', 'icon-user' );
				break;

			case 'wishlist':
				$value = get_theme_mod( 'wishlist_icon', 'icon-wishlist' );
				break;
			
		}
		
		if ( 'icon-custom' === $value ) {
			return true;
		} else {
			return false;
		} 
	}
}

if ( ! function_exists( 'sydney_callback_header_icon_custom' ) ) {
	function sydney_callback_header_icon_custom( $icon ) {
		switch ( $icon ) {
			case 'search':
				$value = get_theme_mod( 'search_icon', 'icon-search' );
				break;

			case 'cart':
				$value = get_theme_mod( 'cart_icon', 'icon-cart' );
				break;

			case 'account':
				$value = get_theme_mod( 'account_icon', 'icon-user' );
				break;

			case 'wishlist':
				$value = get_theme_mod( 'wishlist_icon', 'icon-wishlist' );
				break;
			
		}

		if ( 'icon-custom' === $value ) {
			return true;
		} else {
			return false;
		} 
	}
}

/**
 * Header contact info partial
 *
 * Render callback for the header_contact_mail / header_contact_phone selective
 * refresh partials. Dispatches to whichever header is actually rendering, so the
 * preview markup matches the front end markup.
 */
function sydney_partial_header_contact_info() {
	if ( class_exists( 'Sydney_Modules' ) && Sydney_Modules::is_module_active( 'hf-builder' ) && class_exists( 'Sydney_Header_Footer_Builder' ) ) {
		Sydney_Header_Footer_Builder::get_instance()->contact_info_markup();
		return;
	}

	if ( class_exists( 'Sydney_Header' ) ) {
		Sydney_Header::get_instance()->contact_info();
	}
}
