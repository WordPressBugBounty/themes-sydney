<?php
/**
 * Class for dynamic CSS output
 *
 */

if ( !class_exists( 'Sydney_Custom_CSS' ) ) :

	/**
	 * Sydney_Custom_CSS 
	 */
	Class Sydney_Custom_CSS {

		/**
		 * Instance
		 */     
		private static $instance;

		/**
		 * Customizer JS
		 */
		public $customizer_js;
		public $customizer_js_css_vars;
		public static $css_to_replace = array();

		/**
		 * Cached result of `get_theme_mod('sydney_global_color_css_vars')`.
		 * Stored on the singleton instance so that resetSingleton() (which nulls
		 * $instance) automatically clears the cache between test cases — avoiding
		 * the cross-test pollution that a PHP function-scope `static` would cause.
		 */
		private $use_css_vars_cache = null;

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
			$this->customizer_js = array();

			add_action( 'wp_enqueue_scripts', array( $this, 'print_styles' ) );

			// Cache invalidation: flush the cached base CSS on every event
			// that can change what build_base_css() generates. The signature
			// check in get_cached_base_css() self-heals anything missed here.
			add_action( 'customize_save_after', array( $this, 'flush_css_cache' ) );
			add_action( 'after_switch_theme', array( $this, 'flush_css_cache' ) );
			add_action( 'switch_theme', array( $this, 'flush_css_cache' ) );
			add_action( 'activated_plugin', array( $this, 'flush_css_cache' ) );
			add_action( 'deactivated_plugin', array( $this, 'flush_css_cache' ) );
			add_action( 'upgrader_process_complete', array( $this, 'flush_css_cache' ) );
			// HF Builder background images are stored as attachment IDs and
			// resolved to URLs at generation time; media-library edits change
			// the URL without any theme-mod write.
			add_action( 'attachment_updated', array( $this, 'flush_css_cache' ) );
			add_action( 'delete_attachment', array( $this, 'flush_css_cache' ) );

			add_action( 'updated_option', array( $this, 'maybe_flush_on_option_change' ) );
			add_action( 'added_option', array( $this, 'maybe_flush_on_option_change' ) );
			add_action( 'deleted_option', array( $this, 'maybe_flush_on_option_change' ) );
		}

		/**
		 * Build the cacheable base CSS. Pure function of saved settings
		 * (theme mods, active modules); request-dependent chunks are
		 * placeholder tokens replaced later by replace_context_tokens().
		 */
		private function build_base_css() {


            $custom = '';
        
            //Woocommerce
            $yith_buttons_visible = get_theme_mod( 'yith_buttons_visible', 0 );
            if ( $yith_buttons_visible ) {
                $custom .= ".yith-placeholder > * { opacity:1!important;left:0!important;}"."\n";
            }
        
            $custom .= '/*SYDNEY_CTX_1*/';
        
            $wc_button_hover = get_theme_mod( 'wc_button_hover', 0 );
            if ( $wc_button_hover ) {
                $custom .= "
                @media only screen and (min-width: 1024px) { 
                .loop-button-wrapper {position: absolute;bottom: 0;width: 100%;left: 0;opacity: 0;transition: all 0.3s;}
                .woocommerce ul.products li.product .woocommerce-loop-product__title,
                .woocommerce ul.products li.product .price {transition: all 0.3s;}
                .woocommerce ul.products li.product:hover .loop-button-wrapper {opacity: 1;bottom: 20px;}
                .woocommerce ul.products li.product:hover .woocommerce-loop-product__title,
                .woocommerce ul.products li.product:hover .price {opacity: 0;} }" . "\n";
            }
			
			$loop_product_alignment = get_theme_mod( 'swc_loop_product_alignment', 'center' );
            $custom .= ".woocommerce ul.products li.product { text-align:" . esc_attr( $loop_product_alignment ) . ";}"."\n";

            if ( 'left' === $loop_product_alignment ) {
                $custom .= ".woocommerce ul.products li.product .star-rating { margin-left:0;}"."\n";
            } elseif ( 'right' === $loop_product_alignment ) {
                $custom .= ".woocommerce ul.products li.product .star-rating { margin-right:0;}"."\n";
            }
        
            
      
            $custom .= '/*SYDNEY_CTX_2*/';

            //Header image
            $header_bg_size = get_theme_mod('header_bg_size','cover');  
            $header_height = get_theme_mod('header_height','300');
            $custom .= ".header-image { background-size:" . esc_attr($header_bg_size) . ";}"."\n";
            $custom .= ".header-image { height:" . intval($header_height) . "px; }"."\n";
        
            //Menu style
            $sticky_menu = get_theme_mod('sticky_menu','sticky');
            if ($sticky_menu === 'static') {
                $custom .= ".site-header.fixed { position: absolute;}"."\n";
            }
            $menu_style = get_theme_mod('menu_style','inline');
            if ($menu_style === 'centered') {
                $custom .= ".header-wrap .col-md-4, .header-wrap .col-md-8 { width: 100%; text-align: center;}"."\n";
                $custom .= "#mainnav { float: none;}"."\n";
                $custom .= "#mainnav li { float: none; display: inline-block;}"."\n";
                $custom .= "#mainnav ul ul li { display: block; text-align: left; float:left;}"."\n";
                if( get_bloginfo( 'description' ) || get_bloginfo( 'name' ) || get_theme_mod('site_logo') ) {
                    $custom .= ".site-logo, .header-wrap .col-md-4 { margin-bottom: 15px; }"."\n";
                }
                $custom .= ".btn-menu { margin: 0 auto; float: none; }"."\n";
                $custom .= ".header-wrap .container > .row { display: block; }"."\n";
            }   
        
            $custom .= '/*SYDNEY_CTX_3*/';
        
        
            //__COLORS
            $global_color_defaults = sydney_get_global_color_defaults();            
            $global_colors = array();
            
            $custom .= ":root {" . "\n";
            for ($i = 1; $i <= 9; $i++) {
                $color = get_theme_mod("global_color_" . $i, $global_color_defaults["global_color_" . $i]);
                $custom .= "  --sydney-global-color-" . $i . ":" . $color . ";" . "\n";
            }
            foreach ( sydney_get_extra_global_colors() as $n => $value ) {
                $custom .= "  --sydney-extra-global-color-" . $n . ":" . esc_attr( $value ) . ";" . "\n";
            }
            $custom .= "}" . "\n";

            //Primary color
            $primary_color = 'var(--sydney-global-color-1)';
            $custom .= ".llms-student-dashboard .llms-button-secondary:hover,.llms-button-action:hover,.facts-section.style2 .roll-counter i,.roll-team.type-b.style2 .team-item .team-social li:hover a,.portfolio-section.style2 .project-filter li a:hover,.timeline-section.style2 .timeline .icon .fa::before, .style1 .plan-icon, .style3 .plan-icon, .roll-team.type-b .team-social li a,#mainnav ul li a:hover, .sydney_contact_info_widget span, .roll-team .team-content .name,.roll-team .team-item .team-pop .team-social li:hover a,.roll-infomation li.address:before,.roll-infomation li.phone:before,.roll-infomation li.email:before,.roll-button.border,.roll-button:hover,.roll-icon-list .icon i,.roll-icon-list .content h3 a:hover,.roll-icon-box.white .content h3 a,.roll-icon-box .icon i,.roll-icon-box .content h3 a:hover,.switcher-container .switcher-icon a:focus,.go-top:hover,.hentry .meta-post a:hover,#mainnav > ul > li > a.active, #mainnav > ul > li > a:hover, button:hover, input[type=\"button\"]:hover, input[type=\"reset\"]:hover, input[type=\"submit\"]:hover, .text-color, .social-menu-widget a, .social-menu-widget a:hover, .archive .team-social li a, a, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a, .classic-alt .meta-post a, .single .meta-post a, .header-contact .fa,.social-navigation li a:hover,.widget_sydney_testimonials .fa-quote-left,.timeline-section.style2 .timeline-date, .content-area.modern .hentry .meta-post span:before, .content-area.modern .post-cat,.content-area.modern .read-more-gt { color:" . esc_attr($primary_color) . "}"."\n";
            $custom .= ".sydney-post-sharing .sharing-element:hover,.llms-student-dashboard .llms-button-secondary,.llms-button-action,.roll-team.type-b.style2 .avatar::after,.project-filter li a.active, .project-filter li a:hover,.woocommerce a.button,.woocommerce button.button,.woocommerce input.button,.project-filter li.active, .project-filter li:hover,.roll-team.type-b .team-item .team-social li:hover a,.preloader .pre-bounce1, .preloader .pre-bounce2,.roll-team .team-item .team-pop,.roll-progress .progress-animate,.roll-socials li a:hover,.roll-project .project-item .project-pop,.roll-project .project-filter li.active,.roll-project .project-filter li:hover,.roll-button.light:hover,.roll-button.border:hover,.roll-button,.roll-icon-box.white .icon,.owl-theme .owl-controls .owl-page.active span,.owl-theme .owl-controls.clickable .owl-page:hover span,.go-top,.bottom .socials li:hover a,.sidebar .widget:before,.blog-pagination ul li.active,.blog-pagination ul li:hover a,.content-area .hentry:after,.text-slider .maintitle:after,.error-wrap #search-submit:hover,#mainnav .sub-menu li:hover > a,#mainnav ul li ul:after, button, input[type=\"button\"], input[type=\"reset\"], input[type=\"submit\"], .panel-grid-cell .widget-title:after, .social-section.style2 .social-menu-widget li a:hover, .count-number, .cart-amount, .sydney-video.vid-lightbox .toggle-popup,.footer-contact .widget-title:after,.fp-contact .fa,.pricing-section.style4 .plan-item.featured-plan .plan-header, .woocommerce .widget_price_filter .ui-slider .ui-slider-range { background-color:" . esc_attr($primary_color) . "}"."\n";
            $custom .= ".llms-student-dashboard .llms-button-secondary,.llms-student-dashboard .llms-button-secondary:hover,.llms-button-action,.llms-button-action:hover,.owl-theme .owl-controls .owl-page:hover span,.owl-theme .owl-controls .owl-page.active span,.roll-team.type-b .team-social li a,.roll-socials li a:hover,.roll-socials li a,.roll-button.light:hover,.roll-button.border,.roll-button,.roll-icon-list .icon,.roll-icon-box .icon,.comment .comment-detail,.widget-tags .tag-list a:hover,.blog-pagination ul li,.error-wrap #search-submit:hover,textarea:focus,input[type=\"text\"]:focus,input[type=\"password\"]:focus,input[type=\"date\"]:focus,input[type=\"number\"]:focus,input[type=\"email\"]:focus,input[type=\"url\"]:focus,input[type=\"search\"]:focus,input[type=\"tel\"]:focus, button, input[type=\"button\"], input[type=\"reset\"], input[type=\"submit\"], .archive .team-social li a,.latest-news-wrapper.carousel.style2 .meta-post a:hover { border-color:" . esc_attr($primary_color) . "}"."\n";

			//Primary color SVGs
            $custom .= ".sydney_contact_info_widget span, .header-contact-info svg, .site-header .cart-contents:hover svg, .site-header .header-account:hover svg { fill:" . esc_attr( $primary_color ) . ";}" . "\n";
            $custom .= ".go-top:hover svg { stroke:" . esc_attr( $primary_color ) . ";}" . "\n";
        
            //Menu background
            $menu_bg_color = get_theme_mod( 'menu_bg_color', '#000000' );
            $rgba = $this->hex2rgba($menu_bg_color, 0.9);
            $custom .= ".site-header.float-header { background-color:" . esc_attr($rgba) . ";}" . "\n";
            $custom .= "@media only screen and (max-width: 1024px) { .site-header { background-color:" . esc_attr($menu_bg_color) . ";}}" . "\n";

            //Top level menu items color
            $top_items_color = get_theme_mod( 'top_items_color', '#ffffff' );
			$custom .= "#mainnav ul li a, #mainnav ul li::before { color:" . esc_attr($top_items_color) . "}"."\n"; 

            //Sub menu items color
            $submenu_items_color = get_theme_mod( 'submenu_items_color', '#ffffff' );
            $custom .= "#mainnav .sub-menu li a { color:" . esc_attr($submenu_items_color) . "}"."\n";
            //Sub menu background
            $submenu_background = get_theme_mod( 'submenu_background', '#1c1c1c' );
            $custom .= "#mainnav .sub-menu li a { background:" . esc_attr($submenu_background) . "}"."\n";
            //Header slider text
            $slider_text = get_theme_mod( 'slider_text', '#ffffff' );
            $custom .= ".text-slider .maintitle, .text-slider .subtitle { color:" . esc_attr($slider_text) . "}"."\n";
            //Body
            $body_text = get_theme_mod( 'body_text_color' );
            $custom .= "body { color:" . esc_attr($body_text) . "}"."\n";
            //Sidebar background
            $sidebar_background = get_theme_mod( 'sidebar_background', '#ffffff' );
            $custom .= "#secondary { background-color:" . esc_attr($sidebar_background) . "}"."\n";
            //Sidebar color
            $sidebar_color = get_theme_mod( 'sidebar_color', '#6d7685' );
            $custom .= "#secondary, #secondary a:not(.wp-block-button__link) { color:" . esc_attr($sidebar_color) . "}"."\n";           

            //Mobile menu icon
            $mobile_menu_color = get_theme_mod( 'mobile_menu_color', '#ffffff' );
            $custom .= ".btn-menu .sydney-svg-icon { fill:" . esc_attr($mobile_menu_color) . "}"."\n";
        
            //Menu items hover
            $menu_items_hover = get_theme_mod( 'menu_items_hover', '#d65050' );
            $custom .= "#mainnav ul li a:hover, .main-header #mainnav .menu > li > a:hover { color:" . esc_attr($menu_items_hover) . "}"."\n";
		
            //Rows overlay
            $rows_overlay = get_theme_mod( 'rows_overlay', '#000000' );
            $custom .= ".overlay { background-color:" . esc_attr($rows_overlay) . "}"."\n"; 
        
            //Page wrapper padding
            $pw_top_padding = get_theme_mod( 'wrapper_top_padding', '83' );
            $pw_bottom_padding = get_theme_mod( 'wrapper_bottom_padding', '100' );
            $custom .= ".page-wrap { padding-top:" . intval($pw_top_padding) . "px;}"."\n"; 
            $custom .= ".page-wrap { padding-bottom:" . intval($pw_bottom_padding) . "px;}"."\n";   

            $custom .= '/*SYDNEY_CTX_4*/';
        
            $text_slide = get_theme_mod('textslider_slide', 0);
            if ( $text_slide ) {
                $custom .= ".slide-inner { display:none;}"."\n";    
                $custom .= ".slide-inner.text-slider-stopped { display:block;}"."\n";   
            }
        
            $mobile_slider = get_theme_mod('mobile_slider', 'responsive');
            if ( $mobile_slider === 'responsive' ) {
                    $custom .= "@media only screen and (max-width: 1025px) {		
                    .mobile-slide {
                        display: block;
                    }
                    .slide-item {
                        background-image: none !important;
                    }
                    .header-slider {
                    }
                    .slide-item {
                        height: auto !important;
                    }
                    .slide-inner {
                        min-height: initial;
                    } 
                }"."\n";        
            }
        
            $custom .= '/*SYDNEY_CTX_5*/';
        
            /* Start porting */
            /* Back to top */
			$scrolltop_radius           = get_theme_mod( 'scrolltop_radius', 2 );
			$scrolltop_side_offset      = get_theme_mod( 'scrolltop_side_offset', 20 );
			$scrolltop_bottom_offset    = get_theme_mod( 'scrolltop_bottom_offset', 10 );
			$scrolltop_icon_size        = get_theme_mod( 'scrolltop_icon_size', 16 );
			$scrolltop_padding          = get_theme_mod( 'scrolltop_padding', 15 );

			$custom .= ".go-top.show { border-radius:" . esc_attr( $scrolltop_radius ) . "px;bottom:" . esc_attr( $scrolltop_bottom_offset ) . "px;}" . "\n";
			$custom .= ".go-top.position-right { right:" . esc_attr( $scrolltop_side_offset ) . "px;}" . "\n";
			$custom .= ".go-top.position-left { left:" . esc_attr( $scrolltop_side_offset ) . "px;}" . "\n";
			$custom .= $this->get_background_color_css( 'scrolltop_bg_color', '', '.go-top', false, 'global_color_1' );
			$custom .= $this->get_background_color_css( 'scrolltop_bg_color_hover', '', '.go-top:hover' );
			$custom .= $this->get_color_css( 'scrolltop_color', '', '.go-top' );
			$custom .= $this->get_stroke_css( 'scrolltop_color', '', '.go-top svg' );
			$custom .= $this->get_color_css( 'scrolltop_color_hover', '', '.go-top:hover', false, 'global_color_1' );
			$custom .= $this->get_stroke_css( 'scrolltop_color_hover', '', '.go-top:hover svg', 'global_color_1' );
			$custom .= ".go-top .sydney-svg-icon, .go-top .sydney-svg-icon svg { width:" . esc_attr( $scrolltop_icon_size ) . "px;height:" . esc_attr( $scrolltop_icon_size ) . "px;}" . "\n";
			$custom .= ".go-top { padding:" . esc_attr( $scrolltop_padding ) . "px;}" . "\n";
        
            /* Footer */
			$footer_widgets_divider         = get_theme_mod( 'footer_widgets_divider', 0 );
			$footer_widgets_divider_width   = get_theme_mod( 'footer_widgets_divider_width', 'contained' );
			$footer_widgets_divider_size    = get_theme_mod( 'footer_widgets_divider_size', 1 );
			$footer_widgets_divider_color   = get_theme_mod( 'footer_widgets_divider_color' );

			if ( $footer_widgets_divider ) {
				if ( 'contained' === $footer_widgets_divider_width ) {
					$custom .= ".footer-widgets-grid { border-top:" . esc_attr( $footer_widgets_divider_size ) . 'px solid ' . esc_attr( $footer_widgets_divider_color ) . ";}" . "\n";
				} else {
					$custom .= ".footer-widgets { border-top:" . esc_attr( $footer_widgets_divider_size ) . 'px solid ' . esc_attr( $footer_widgets_divider_color ) . ";}" . "\n";
				}
			}
            $custom .= $this->get_font_sizes_css( 'footer_copyright_font_size', $defaults = array( 'desktop' => 16, 'tablet' => 16, 'mobile' => 16 ), '.site-info' );
			$footer_credits_divider         = get_theme_mod( 'footer_credits_divider', 0 );
			$footer_credits_divider_width   = get_theme_mod( 'footer_credits_divider_width', 'contained' );
			$footer_credits_divider_size    = get_theme_mod( 'footer_credits_divider_size', 0 );
			$footer_credits_divider_color   = get_theme_mod( 'footer_credits_divider_color', 'rgba(33,33,33,0.1)' );            
			if ( $footer_credits_divider ) {
				if ( 'contained' === $footer_credits_divider_width ) {
					$custom .= ".site-info { border-top:" . esc_attr( $footer_credits_divider_size ) . 'px solid ' . esc_attr( $footer_credits_divider_color ) . ";}" . "\n";
				} else {
					$custom .= ".site-footer { border-top:" . esc_attr( $footer_credits_divider_size ) . 'px solid ' . esc_attr( $footer_credits_divider_color ) . ";}" . "\n";
				}
			} else {
				$custom .= ".site-info { border-top:0;}" . "\n";
			}           

			$footer_widgets_column_spacing_desktop = get_theme_mod( 'footer_widgets_column_spacing_desktop', 30 );
			$custom .= ".footer-widgets-grid { gap:" . esc_attr( $footer_widgets_column_spacing_desktop ) . "px;}" . "\n";
			$custom .= $this->get_top_bottom_padding_css( 'footer_widgets_padding', $defaults = array( 'desktop' => 95, 'tablet' => 60, 'mobile' => 60 ), '.footer-widgets-grid' );
			$custom .= $this->get_font_sizes_css( 'footer_widgets_title_size', $defaults = array( 'desktop' => 22, 'tablet' => 22, 'mobile' => 22 ), '.sidebar-column .widget .widget-title' );
			$custom .= $this->get_font_sizes_css( 'footer_widgets_body_size', $defaults = array( 'desktop' => 16, 'tablet' => 16, 'mobile' => 16 ), '.footer-widgets' );
			
			$custom .= $this->get_background_color_css( 'footer_widgets_background', '', '.footer-widgets' );
			$custom .= $this->get_color_css( 'footer_widgets_title_color', '', '.sidebar-column .widget .widget-title' );
			$custom .= $this->get_color_css( 'footer_widgets_headings_color', '', '.sidebar-column .widget h1, .sidebar-column .widget h2, .sidebar-column .widget h3, .sidebar-column .widget h4, .sidebar-column .widget h5, .sidebar-column .widget h6' );
			$custom .= $this->get_color_css( 'footer_widgets_color', '', '.sidebar-column .widget' );
			$custom .= $this->get_color_css( 'footer_widgets_links_color', '', '#sidebar-footer .widget a' );
			$custom .= $this->get_color_css( 'footer_widgets_links_hover_color', '', '#sidebar-footer .widget a:hover' );
			$custom .= $this->get_background_color_css( 'footer_background', '', '.site-footer' );
			$custom .= $this->get_color_css( 'footer_color', '', '.site-info, .site-info a' );
			$custom .= $this->get_fill_css( 'footer_color', '', '.site-info .sydney-svg-icon svg' );

            $footer_credits_padding = get_theme_mod( 'footer_credits_padding_desktop', 20 );
			$custom .= ".site-info { padding-top:" . esc_attr( $footer_credits_padding ) . 'px;padding-bottom:' . esc_attr( $footer_credits_padding ) . "px;}" . "\n";

			//Buttons
			$custom .= $this->get_top_bottom_padding_css( 'button_top_bottom_padding', $defaults = array( 'desktop' => 12, 'tablet' => 12, 'mobile' => 12 ), 'button,.roll-button,a.button,.wp-block-button__link,.wp-block-button.is-style-outline a,input[type="button"],input[type="reset"],input[type="submit"]' );
			$custom .= $this->get_left_right_padding_css( 'button_left_right_padding', $defaults = array( 'desktop' => 35, 'tablet' => 35, 'mobile' => 35 ), 'button,.roll-button,a.button,.wp-block-button__link,.wp-block-button.is-style-outline a,input[type="button"],input[type="reset"],input[type="submit"]' );

			$buttons_radius = get_theme_mod( 'buttons_radius' );
			$custom .= "button,.roll-button,a.button,.wp-block-button__link,input[type=\"button\"],input[type=\"reset\"],input[type=\"submit\"] { border-radius:" . intval( $buttons_radius ) . "px;}" . "\n";

			$custom .= ".wp-block-button__link { box-sizing: border-box; border: 2px solid transparent; }\n";
			$custom .= ".wp-block-button:not(.is-style-outline) .wp-block-button__link, .wp-block-button:not(.is-style-outline) .wp-block-button__link:hover { border-color: transparent; }\n";

			$custom .= $this->get_font_sizes_css( 'button_font_size', $defaults = array( 'desktop' => 14, 'tablet' => 14, 'mobile' => 14 ), 'button,.roll-button,a.button,.wp-block-button__link,input[type="button"],input[type="reset"],input[type="submit"]' );
			$button_text_transform = get_theme_mod( 'button_text_transform', 'uppercase' );
			$custom .= "button,.roll-button,a.button,.wp-block-button__link,input[type=\"button\"],input[type=\"reset\"],input[type=\"submit\"] { text-transform:" . esc_attr( $button_text_transform ) . ";}" . "\n";

			$custom .= $this->get_background_color_css( 'button_background_color', '', 'button,.wp-element-button,div.wpforms-container-full:not(.wpforms-render-modern) .wpforms-form input[type=submit],div.wpforms-container-full:not(.wpforms-render-modern) .wpforms-form button[type=submit],div.wpforms-container-full:not(.wpforms-render-modern) .wpforms-form .wpforms-page-button,.roll-button,a.button,.wp-block-button__link,input[type="button"],input[type="reset"],input[type="submit"]' );         
			$custom .= $this->get_background_color_css( 'button_background_color_hover', '', 'button:hover,.wp-element-button:hover,div.wpforms-container-full:not(.wpforms-render-modern) .wpforms-form input[type=submit]:hover,div.wpforms-container-full:not(.wpforms-render-modern) .wpforms-form button[type=submit]:hover,div.wpforms-container-full:not(.wpforms-render-modern) .wpforms-form .wpforms-page-button:hover,.roll-button:hover,a.button:hover,.wp-block-button__link:hover,input[type="button"]:hover,input[type="reset"]:hover,input[type="submit"]:hover' );         

			$custom .= $this->get_color_css( 'button_color', '', 'button,#sidebar-footer a.wp-block-button__link,.wp-element-button,div.wpforms-container-full:not(.wpforms-render-modern) .wpforms-form input[type=submit],div.wpforms-container-full:not(.wpforms-render-modern) .wpforms-form button[type=submit],div.wpforms-container-full:not(.wpforms-render-modern) .wpforms-form .wpforms-page-button,.checkout-button.button,a.button,.wp-block-button__link,input[type="button"],input[type="reset"],input[type="submit"]' );            
			$custom .= $this->get_color_css( 'button_color_hover', '', 'button:hover,#sidebar-footer .wp-block-button__link:hover,.wp-element-button:hover,div.wpforms-container-full:not(.wpforms-render-modern) .wpforms-form input[type=submit]:hover,div.wpforms-container-full:not(.wpforms-render-modern) .wpforms-form button[type=submit]:hover,div.wpforms-container-full:not(.wpforms-render-modern) .wpforms-form .wpforms-page-button:hover,.roll-button:hover,a.button:hover,.wp-block-button__link:hover,input[type="button"]:hover,input[type="reset"]:hover,input[type="submit"]:hover' );          

			// wp.org theme directory preview only, for now. There core prints
			// global-styles-inline-css *after* the theme's inline CSS, so its
			// `:root :where(.wp-element-button,.wp-block-button__link)` rule wins the
			// (0,1,0) tie against the button colors above and forces #fff text on a
			// #32373c background (issue #509). Re-stating the colors behind `:root`
			// lifts them to (0,2,0) so the theme wins whatever the print order is.
			//
			// Scoped to fresh sites - the preview forces `fresh_site` true via
			// `pre_option_fresh_site` - so established installs keep today's cascade,
			// including anyone overriding these buttons from Additional CSS. Drop the
			// condition once the specificity bump is applied theme-wide.
			if ( get_option( 'fresh_site' ) ) {
				$custom .= $this->get_background_color_css( 'button_background_color', '', ':root .wp-element-button,:root .wp-block-button__link' );
				$custom .= $this->get_background_color_css( 'button_background_color_hover', '', ':root .wp-element-button:hover,:root .wp-block-button__link:hover' );
				$custom .= $this->get_color_css( 'button_color', '', ':root .wp-element-button,:root .wp-block-button__link' );
				$custom .= $this->get_color_css( 'button_color_hover', '', ':root .wp-element-button:hover,:root .wp-block-button__link:hover' );
			}

			$button_border_color = get_theme_mod( 'button_border_color', '' );
			$button_border_color_hover = get_theme_mod( 'button_border_color_hover', '' );
			$custom .= ".is-style-outline .wp-block-button__link, div.wpforms-container-full:not(.wpforms-render-modern) .wpforms-form input[type=submit],div.wpforms-container-full:not(.wpforms-render-modern) .wpforms-form button[type=submit],div.wpforms-container-full:not(.wpforms-render-modern) .wpforms-form .wpforms-page-button, .roll-button, .wp-block-button__link.is-style-outline,button,a.button,.wp-block-button__link,input[type=\"button\"],input[type=\"reset\"],input[type=\"submit\"] { border-color:" . esc_attr( $button_border_color ) . ";}" . "\n";
			$custom .= "button:hover,div.wpforms-container-full:not(.wpforms-render-modern) .wpforms-form input[type=submit]:hover,div.wpforms-container-full:not(.wpforms-render-modern) .wpforms-form button[type=submit]:hover,div.wpforms-container-full:not(.wpforms-render-modern) .wpforms-form .wpforms-page-button:hover,.roll-button:hover,a.button:hover,.wp-block-button__link:hover,input[type=\"button\"]:hover,input[type=\"reset\"]:hover,input[type=\"submit\"]:hover { border-color:" . esc_attr( $button_border_color_hover ) . ";}" . "\n";

            //Blog
            $list_image_size = get_theme_mod( 'archive_featured_image_size_desktop', 30 );
            $custom .= ".posts-layout .list-image { width:" . esc_attr( $list_image_size ) . "%;}" . "\n";
            $custom .= ".posts-layout .list-content { width:" . (100 - esc_attr( $list_image_size ) ) . "%;}" . "\n";

            $image_spacing = get_theme_mod( 'archive_featured_image_spacing_desktop', 24 );
			$custom .= ".content-area:not(.layout4):not(.layout6) .posts-layout .entry-thumb { margin:0 0 " . esc_attr( $image_spacing ) . "px 0;}" . "\n";
            $custom .= ".layout4 .entry-thumb, .layout6 .entry-thumb { margin:0 " . esc_attr( $image_spacing ) . "px 0 0;}" . "\n";
            $custom .= ".layout6 article:nth-of-type(even) .list-image .entry-thumb { margin:0 0 0 " . esc_attr( $image_spacing ) . "px;}" . "\n";

            $archive_title_spacing = get_theme_mod( 'archive_title_spacing', 24 );
            $custom .= ".posts-layout .entry-header { margin-bottom:" . esc_attr( $archive_title_spacing ) . "px;}" . "\n";

            $archive_meta_spacing = get_theme_mod( 'archive_meta_spacing', 15 );
            $custom .= ".posts-layout .entry-meta.below-excerpt { margin:" . esc_attr( $archive_meta_spacing ) . "px 0 0;}" . "\n";
            $custom .= ".posts-layout .entry-meta.above-title { margin:0 0 " . esc_attr( $archive_meta_spacing ) . "px;}" . "\n";

            $custom .= $this->get_color_css( 'single_post_title_color', '', '.single .entry-header .entry-title' );
            $custom .= $this->get_color_css( 'single_post_meta_color', '', '.single .entry-header .entry-meta,.single .entry-header .entry-meta a' );
            $custom .= $this->get_font_sizes_css( 'single_post_meta_size', $defaults = array( 'desktop' => 12, 'tablet' => 12, 'mobile' => 12 ), '.single .entry-meta' );
            $custom .= $this->get_font_sizes_css( 'single_post_title_size', $defaults = array( 'desktop' => 48, 'tablet' => 32, 'mobile' => 32 ), '.single .entry-header .entry-title' );
            $custom .= $this->get_color_css( 'loop_post_text_color', '#233452', '.posts-layout .entry-post' );
            $custom .= $this->get_color_css( 'loop_post_title_color', '#00102E', '.posts-layout .entry-title a' );
            $custom .= $this->get_color_css( 'loop_post_meta_color', '#6d7685', '.posts-layout .author,.posts-layout .entry-meta a' );
            $custom .= $this->get_font_sizes_css( 'loop_post_text_size', $defaults = array( 'desktop' => 16, 'tablet' => 16, 'mobile' => 16 ), '.posts-layout .entry-post' );
            $custom .= $this->get_font_sizes_css( 'loop_post_meta_size', $defaults = array( 'desktop' => 12, 'tablet' => 12, 'mobile' => 12 ), '.posts-layout .entry-meta' );
            $custom .= $this->get_font_sizes_css( 'loop_post_title_size', $defaults = array( 'desktop' => 32, 'tablet' => 32, 'mobile' => 32 ), '.posts-layout .entry-title' );

            //Single 
            $single_post_header_alignment = get_theme_mod( 'single_post_header_alignment', 'left' );
            if ( 'middle' === $single_post_header_alignment ) {
                $custom .= ".single-post .entry-header { text-align:center;} .single-post .entry-header .entry-meta { -webkit-box-pack:center;-ms-flex-pack:center;justify-content:center;}" . "\n";
            }

            $single_post_header_spacing = get_theme_mod( 'single_post_header_spacing', 40 );
            $custom .= ".single .entry-header { margin-bottom:" . esc_attr( $single_post_header_spacing ) . "px;}" . "\n";

            $single_post_image_spacing = get_theme_mod( 'single_post_image_spacing', 38 );
            $custom .= ".single .entry-thumb { margin-bottom:" . esc_attr( $single_post_image_spacing ) . "px;}" . "\n";


            $single_post_meta_spacing = get_theme_mod( 'single_post_meta_spacing', 24 );
            $custom .= ".single .entry-meta-above { margin-bottom:" . esc_attr( $single_post_meta_spacing ) . "px;}" . "\n";
            $custom .= ".single .entry-meta-below { margin-top:" . esc_attr( $single_post_meta_spacing ) . "px;}" . "\n";

            //Header
			if ( Sydney_Modules::is_module_active( 'hf-builder' ) ) {
				$custom .= apply_filters( 'sydney_shfb_custom_css', Sydney_Header_Footer_Builder::custom_css() );
			} else {
				$custom .= $this->get_max_width_css( 'site_logo_size', $defaults = array( 'desktop' => 180, 'tablet' => 100, 'mobile' => 100 ), '.custom-logo-link img' );

				$main_header_divider_width  = get_theme_mod( 'main_header_divider_width', 'fullwidth' );
				$main_header_divider_size   = get_theme_mod( 'main_header_divider_size', 0 );
				$main_header_divider_color  = get_theme_mod( 'main_header_divider_color', 'rgba(255,255,255,0.1)' );
				
				if ( 'fullwidth' === $main_header_divider_width ) {
					$custom .= ".main-header, .bottom-header-row { border-bottom:" . esc_attr( $main_header_divider_size ) . 'px solid ' . esc_attr( $main_header_divider_color ) . ";}" . "\n";
					if ( 0 === $main_header_divider_size ) {
						$custom .= ".header_layout_3,.header_layout_4,.header_layout_5 { border-bottom: 1px solid " . esc_attr( $main_header_divider_color ) . ";}" . "\n";
					}            
				} else {
					$custom .= ".top-header-row,.site-header-inner, .bottom-header-inner { border-bottom:" . esc_attr( $main_header_divider_size ) . 'px solid ' . esc_attr( $main_header_divider_color ) . ";} .main-header,.bottom-header-row {border:0;}" . "\n";
					if ( 0 === $main_header_divider_size ) {
						$custom .= ".top-header-row { border-bottom: 1px solid " . esc_attr( $main_header_divider_color ) . ";}" . "\n";
					}            
				}

				$custom .= $this->get_background_color_css( 'main_header_background', '', '.main-header:not(.sticky-active),.header-search-form' );
				$custom .= $this->get_background_color_css( 'main_header_background_sticky', '', '.main-header.sticky-active' );

				$custom .= $this->get_color_css( 'main_header_color', '', '.main-header .site-title a,.main-header .site-description,.main-header #mainnav .menu > li > a,#mainnav .nav-menu > li > a, .main-header .header-contact a' );
				$custom .= $this->get_fill_css( 'main_header_color', '', '.main-header .sydney-svg-icon svg, .main-header .dropdown-symbol .sydney-svg-icon svg' );

				$custom .= $this->get_color_css( 'main_header_color_sticky', '', '.sticky-active .main-header .site-title a,.sticky-active .main-header .site-description, .sticky-active .main-header #mainnav .menu > li > a,.sticky-active .main-header .header-contact a,.sticky-active .main-header .logout-link, .sticky-active .main-header .html-item, .sticky-active .main-header .sydney-login-toggle' );
				$custom .= $this->get_fill_css( 'main_header_color_sticky', '', '.sticky-active .main-header .sydney-svg-icon svg,.sticky-active .main-header .dropdown-symbol .sydney-svg-icon svg' );  

				$custom .= $this->get_background_color_css( 'main_header_bottom_background', '', '.bottom-header-row' );
				$custom .= $this->get_color_css( 'main_header_bottom_color', '', '.bottom-header-row, .bottom-header-row .header-contact a,.bottom-header-row #mainnav .menu > li > a' );
				$custom .= $this->get_color_css( 'color_link_hover', '', '.bottom-header-row #mainnav .menu > li > a:hover' );
				$custom .= $this->get_fill_css( 'main_header_bottom_color', '', '.bottom-header-row .header-item svg,.dropdown-symbol .sydney-svg-icon svg' );
				
				$main_header_padding    = get_theme_mod( 'main_header_padding', 15 );
				$custom .= ".main-header .site-header-inner, .main-header .top-header-row { padding-top:" . esc_attr( $main_header_padding ) . 'px;padding-bottom:' . esc_attr( $main_header_padding ) . "px;}" . "\n";

				$main_header_bottom_padding = get_theme_mod( 'main_header_bottom_padding', 15 );
				$custom .= ".bottom-header-inner { padding-top:" . esc_attr( $main_header_bottom_padding ) . 'px;padding-bottom:' . esc_attr( $main_header_bottom_padding ) . "px;}" . "\n";

				$custom .= $this->get_background_color_css( 'main_header_submenu_background', '', '.bottom-header-row #mainnav ul ul li, .main-header #mainnav ul ul li' );
				$custom .= $this->get_color_css( 'main_header_submenu_color', '', '.bottom-header-row #mainnav ul ul li a,.bottom-header-row #mainnav ul ul li:hover a, .main-header #mainnav ul ul li:hover a,.main-header #mainnav ul ul li a' );
				$custom .= $this->get_fill_css( 'main_header_submenu_color', '', '.bottom-header-row #mainnav ul ul li svg, .main-header #mainnav ul ul li svg' );

				$header_icons_size = absint( get_theme_mod( 'header_icons_size', 16 ) );
				if ( ! $header_icons_size ) {
					// get_theme_mod() returns a stored empty string as-is, bypassing
					// the registered default above, so re-apply it here.
					$header_icons_size = 16;
				}
				$custom .= ".header-item .sydney-svg-icon { width:" . $header_icons_size . "px;height:" . $header_icons_size . "px;}" . "\n";
				$custom .= ".header-item .sydney-svg-icon svg { max-height:" . max( 0, $header_icons_size - 2 ) . "px;}" . "\n";
				
				$custom .= $this->get_background_color_css( 'search_bar_background_color', '', '.header-search-form' );

				//Submenu items hover
				$custom .= $this->get_color_css( 'submenu_items_hover', '', '#mainnav .sub-menu li:hover>a, .main-header #mainnav ul ul li:hover>a' );

				//Header mini cart
				$custom .= $this->get_color_css( 'body_text_color', '', '.main-header-cart .count-number' );
				$custom .= $this->get_background_color_rgba_css( 'body_text_color', '#233452', '.main-header-cart .widget_shopping_cart .widgettitle:after, .main-header-cart .widget_shopping_cart .woocommerce-mini-cart__buttons:before', '0.1' );

				//Mobile menu
				$mobile_menu_alignment = get_theme_mod( 'mobile_menu_alignment', 'left' );
				$custom .= ".sydney-offcanvas-menu .mainnav ul li,.mobile-header-item.offcanvas-items,.mobile-header-item.offcanvas-items .social-profile { text-align:" . esc_attr( $mobile_menu_alignment ) . ";}" . "\n";
				$custom .= ".sydney-offcanvas-menu #mainnav ul li { text-align:" . esc_attr( $mobile_menu_alignment ) . ";}" . "\n";
				if ( 'center' === $mobile_menu_alignment ) {
					$custom .= ".sydney-offcanvas-menu .header-item.header-woo {justify-content:center;} .mobile-header-item.offcanvas-items .button {align-self:center;}" . "\n";
				} elseif ( 'right' === $mobile_menu_alignment ) {
					$custom .= ".sydney-offcanvas-menu .header-item.header-woo {justify-content:flex-end;} .mobile-header-item.offcanvas-items .button {align-self:flex-end;}" . "\n";
				}

				$custom .= $this->get_color_css( 'offcanvas_submenu_color', '', '.sydney-offcanvas-menu #mainnav ul ul a' );

				$offcanvas_menu_font_size = get_theme_mod( 'offcanvas_menu_font_size', '18' );
				$custom .= ".sydney-offcanvas-menu #mainnav > div > ul > li > a { font-size:" . intval($offcanvas_menu_font_size) . "px; }"."\n";

				$offcanvas_submenu_font_size = get_theme_mod( 'offcanvas_submenu_font_size', '16' );
				$custom .= ".sydney-offcanvas-menu #mainnav ul ul li a { font-size:" . intval($offcanvas_submenu_font_size) . "px; }"."\n";

				$mobile_menu_link_separator     = get_theme_mod( 'mobile_menu_link_separator', 0 );
				$link_separator_color           = get_theme_mod( 'link_separator_color', 'rgba(238, 238, 238, 0.14)' );
				$mobile_header_separator_width  = get_theme_mod( 'mobile_header_separator_width', 1 );

				if ( $mobile_menu_link_separator ) {
					$custom .= ".sydney-offcanvas-menu .mainnav ul li { padding-top:5px;border-bottom: " . intval( $mobile_header_separator_width ) . "px solid " . esc_attr( $link_separator_color ) . ";}" . "\n";
				}

				$mobile_menu_link_spacing = get_theme_mod( 'mobile_menu_link_spacing', 20 );
				$custom .= ".sydney-offcanvas-menu .mainnav a { padding:" . esc_attr( $mobile_menu_link_spacing )/2 . "px 0;}" . "\n";

				$custom .= $this->get_background_color_css( 'mobile_header_background', '', '#masthead-mobile' );
				$custom .= $this->get_color_css( 'mobile_header_color', '', '#masthead-mobile .site-description, #masthead-mobile a:not(.button)' );
				$custom .= $this->get_fill_css( 'mobile_header_color', '', '#masthead-mobile svg' );

				$mobile_header_padding = get_theme_mod( 'mobile_header_padding', 15 );
				$custom .= ".mobile-header { padding-top:" . esc_attr( $mobile_header_padding ) . 'px;padding-bottom:' . esc_attr( $mobile_header_padding ) . "px;}" . "\n";

				$custom .= $this->get_background_color_css( 'offcanvas_menu_background', '', '.sydney-offcanvas-menu' );
				$custom .= $this->get_color_css( 'offcanvas_menu_color', '#ffffff', '.offcanvas-header-custom-text,.sydney-offcanvas-menu,.sydney-offcanvas-menu #mainnav a:not(.button),.sydney-offcanvas-menu a:not(.button)' );
				$custom .= $this->get_fill_css( 'offcanvas_menu_color', '#ffffff', '.sydney-offcanvas-menu svg, .sydney-offcanvas-menu .dropdown-symbol .sydney-svg-icon svg' );

				$offcanvas_mode = get_theme_mod( 'header_offcanvas_mode', 'layout1' );
				if ( 'layout2' === $offcanvas_mode ) {
					$custom .= ".sydney-offcanvas-menu {max-width:100%;}" . "\n";
				}            
			}
			if ( true !== get_theme_mod( 'sydney_use_height_for_logo', false ) ) {
				$custom .= $this->get_max_height_css( 'site_logo_size', $defaults = array( 'desktop' => 100, 'tablet' => 100, 'mobile' => 100 ), '.site-logo' );
			} else {
				$custom .= $this->get_height_css( 'site_logo_size', $defaults = array( 'desktop' => 100, 'tablet' => 100, 'mobile' => 100 ), '.site-logo, .shfb-component-logo .site-logo' );
				$custom .= ".site-logo { max-height: none; }"."\n";
			}
            
            //Site title
			$logo_site_title    = get_theme_mod('logo_site_title', 0);

            if ( $logo_site_title && '' !== get_theme_mod( 'site_logo' ) ) {
                $custom .= ".site-branding { display: flex;gap:15px;align-items:center; }"."\n";
            }           
            $site_title = get_theme_mod( 'site_title_color' );
            $custom .= ".site-title a, .site-title a:visited, .main-header .site-title a, .main-header .site-title a:visited  { color:" . esc_attr($site_title) . "}"."\n";
            //Site desc
            $site_desc = get_theme_mod( 'site_desc_color' );
            $custom .= ".site-description, .main-header .site-description { color:" . esc_attr($site_desc) . "}"."\n";

			$custom .= $this->get_font_sizes_css( 'site_title_font_size', $defaults = array( 'desktop' => 32, 'tablet' => 24, 'mobile' => 20 ), '.site-title' );
			$custom .= $this->get_font_sizes_css( 'site_desc_font_size', $defaults = array( 'desktop' => 16, 'tablet' => 16, 'mobile' => 16 ), '.site-description' );

			//Typography 
			$typography_defaults = wp_json_encode(
				array(
					'font'          => 'System default',
					'regularweight' => 'regular',
					'category'      => 'sans-serif',
				)
			);

			$body_font      = get_theme_mod( 'sydney_body_font', $typography_defaults );
			$headings_font  = get_theme_mod( 'sydney_headings_font', $typography_defaults );
		
			$body_font      = json_decode( $body_font, true );
			$headings_font  = json_decode( $headings_font, true );
			
			if ( 'System default' !== $body_font['font'] && 'google' === get_theme_mod( 'fonts_library', 'google' ) ) {
				$custom .= 'body { font-family:' . esc_attr( $body_font['font'] ) . ',' . esc_attr( $body_font['category'] ) . '; font-weight: ' . esc_attr( $body_font['regularweight'] ) . ';}' . "\n";   
			}
			
			if ( 'System default' !== $headings_font['font'] && 'google' === get_theme_mod( 'fonts_library', 'google' ) ) {
				$custom .= 'h1,h2,h3,h4,h5,h6,.site-title { font-family:' . esc_attr( $headings_font['font'] ) . ',' . esc_attr( $headings_font['category'] ) . '; font-weight: ' . esc_attr( $headings_font['regularweight'] ) . ';}' . "\n";
			}

            $enable_top_menu_typography = get_theme_mod( 'enable_top_menu_typography', 0 );
            if ( $enable_top_menu_typography ) {

                $menu_font      = get_theme_mod( 'sydney_menu_font', $typography_defaults );
                $menu_font      = json_decode( $menu_font, true );

                $menu_text_transform = get_theme_mod( 'menu_items_text_transform' );

                if ( 'System default' !== $menu_font['font'] && 'google' === get_theme_mod( 'fonts_library', 'google' ) ) {
                    $custom .= '#mainnav > div > ul > li > a { font-family:' . esc_attr( $menu_font['font'] ) . ',' . esc_attr( $menu_font['category'] ) . '; font-weight: ' . esc_attr( $menu_font['regularweight'] ) . ';}' . "\n";   
                }

                $custom .= "#mainnav > div > ul > li > a { text-transform:" . esc_attr( $menu_text_transform ) . ";}" . "\n";   
       
                $custom .= $this->get_font_sizes_css( 'sydney_menu_font_size', $defaults = array( 'desktop' => 14, 'tablet' => 14, 'mobile' => 14 ), '#mainnav > div > ul > li' );
                $custom .= $this->get_font_sizes_css( 'sydney_menu_font_size', $defaults = array( 'desktop' => 14, 'tablet' => 14, 'mobile' => 14 ), '.header-item' );
            }           

			$headings_font_style        = get_theme_mod( 'headings_font_style' );
			$headings_line_height       = get_theme_mod( 'headings_line_height', 1.2 );
			$headings_letter_spacing    = get_theme_mod( 'headings_letter_spacing' );
			$headings_text_transform    = get_theme_mod( 'headings_text_transform' );
			$headings_text_decoration   = get_theme_mod( 'headings_text_decoration' );

			$custom .= "h1,h2,h3,h4,h5,h6,.site-title { text-decoration:" . esc_attr( $headings_text_decoration ) . ";text-transform:" . esc_attr( $headings_text_transform ) . ";font-style:" . esc_attr( $headings_font_style ) . ";line-height:" . esc_attr( $headings_line_height ) . ";letter-spacing:" . esc_attr( $headings_letter_spacing ) . "px;}" . "\n";    

			$custom .= $this->get_font_sizes_css( 'h1_font_size', $defaults = array( 'desktop' => 48, 'tablet' => 42, 'mobile' => 32 ), 'h1:not(.site-title)' );
			$custom .= $this->get_font_sizes_css( 'h2_font_size', $defaults = array( 'desktop' => 38, 'tablet' => 32, 'mobile' => 24 ), 'h2' );
			$custom .= $this->get_font_sizes_css( 'h3_font_size', $defaults = array( 'desktop' => 32, 'tablet' => 24, 'mobile' => 20 ), 'h3' );
			$custom .= $this->get_font_sizes_css( 'h4_font_size', $defaults = array( 'desktop' => 24, 'tablet' => 18, 'mobile' => 16 ), 'h4' );
			$custom .= $this->get_font_sizes_css( 'h5_font_size', $defaults = array( 'desktop' => 20, 'tablet' => 16, 'mobile' => 16 ), 'h5' );
			$custom .= $this->get_font_sizes_css( 'h6_font_size', $defaults = array( 'desktop' => 16, 'tablet' => 16, 'mobile' => 16 ), 'h6' );

            $body_font_style        = get_theme_mod( 'body_font_style' );
			$body_line_height       = get_theme_mod( 'body_line_height', 1.68 );
			$body_letter_spacing    = get_theme_mod( 'body_letter_spacing' );
			$body_text_transform    = get_theme_mod( 'body_text_transform' );
			$body_text_decoration   = get_theme_mod( 'body_text_decoration' );

			$custom .= "p, .posts-layout .entry-post { text-decoration:" . esc_attr( $body_text_decoration ) . "}" . "\n";  
			$custom .= "body, .posts-layout .entry-post { text-transform:" . esc_attr( $body_text_transform ) . ";font-style:" . esc_attr( $body_font_style ) . ";line-height:" . esc_attr( $body_line_height ) . ";letter-spacing:" . esc_attr( $body_letter_spacing ) . "px;}" . "\n";    
			$custom .= $this->get_font_sizes_css( 'body_font_size', $defaults = array( 'desktop' => 16, 'tablet' => 16, 'mobile' => 16 ), 'body' );            

			//Woocommerce single
			$single_sku         = get_theme_mod( 'single_product_sku', 1 );
			$single_categories  = get_theme_mod( 'single_product_categories', 1 );
			$single_tags        = get_theme_mod( 'single_product_tags', 1 );
			$single_sticky_add_to_cart_elements_spacing = get_theme_mod( 'single_sticky_add_to_cart_elements_spacing', 35 );

			if( !$single_sku ) {
				$custom .= ".single-product .product_meta .sku_wrapper { display: none }";
			}
			if( !$single_categories ) {
				$custom .= ".single-product .product_meta .posted_in { display: none }";
			}
			if( !$single_tags ) {
				$custom .= ".single-product .product_meta .tagged_as { display: none }";
			}
			if( !$single_sku && !$single_categories && !$single_tags ) {
				$custom .= ".single-product .product_meta { border-top: 0; }";
			}

			$custom .= $this->get_font_sizes_css( 'single_product_title_size', $defaults = array( 'desktop' => 32, 'tablet' => 32, 'mobile' => 32 ), '.woocommerce div.product .product-gallery-summary .entry-title' );
			$custom .= $this->get_font_sizes_css( 'single_product_price_size', $defaults = array( 'desktop' => 24, 'tablet' => 24, 'mobile' => 24 ), '.woocommerce div.product .product-gallery-summary .price .amount' );            

            //Woocommerce loop
            $shop_product_element_spacing = get_theme_mod( 'shop_product_element_spacing', 12 );
			$custom .= ".woocommerce  ul.products li.product .col-md-7 > *,.woocommerce  ul.products li.product .col-md-8 > *,.woocommerce  ul.products li.product > * { margin-bottom:" . esc_attr( $shop_product_element_spacing ) . "px;}" . "\n";

			$shop_product_sale_tag_layout   = get_theme_mod( 'shop_product_sale_tag_layout', 'layout2' );
			$shop_sale_tag_spacing          = get_theme_mod( 'shop_sale_tag_spacing', 20 );
			$shop_sale_tag_radius           = get_theme_mod( 'shop_sale_tag_radius', 0 );

			$custom .= ".wc-block-grid__product-onsale, span.onsale {border-radius:" . esc_attr( $shop_sale_tag_radius ) . "px;top:" . esc_attr( $shop_sale_tag_spacing ) . "px!important;left:" . esc_attr( $shop_sale_tag_spacing ) . "px!important;}" . "\n";
			if ( 'layout2' === $shop_product_sale_tag_layout ) {
				$custom .= ".wc-block-grid__product-onsale, .products span.onsale {left:auto!important;right:" . esc_attr( $shop_sale_tag_spacing ) . "px;}" . "\n";
			}

			$custom .= $this->get_color_css( 'single_product_sale_color', '', '.wc-block-grid__product-onsale, span.onsale' );
			$custom .= $this->get_background_color_css( 'single_product_sale_background_color', '', '.wc-block-grid__product-onsale, span.onsale' );
			$custom .= $this->get_color_css( 'shop_product_product_title', '', 'ul.wc-block-grid__products li.wc-block-grid__product .wc-block-grid__product-title, ul.wc-block-grid__products li.wc-block-grid__product .woocommerce-loop-product__title, ul.wc-block-grid__products li.product .wc-block-grid__product-title, ul.wc-block-grid__products li.product .woocommerce-loop-product__title, ul.products li.wc-block-grid__product .wc-block-grid__product-title, ul.products li.wc-block-grid__product .woocommerce-loop-product__title, ul.products li.product .wc-block-grid__product-title, ul.products li.product .woocommerce-loop-product__title, ul.products li.product .woocommerce-loop-category__title, .woocommerce-loop-product__title .sydney-wc-loop-product__title' );

			$custom .= $this->get_color_css( 'body_text_color', '', 'a.wc-forward:not(.checkout-button)' );
			$custom .= $this->get_color_css( 'color_link_hover', '', 'a.wc-forward:not(.checkout-button):hover' );
			$custom .= $this->get_color_css( 'button_color_hover', '', '.woocommerce-pagination li .page-numbers:hover' );
			$custom .= $this->get_border_color_rgba_css( 'body_text_color', '#233452', '.woocommerce-sorting-wrapper', '0.1' );

            $shop_categories_alignment = get_theme_mod( 'shop_categories_alignment', 'center' );
			$custom .= "ul.products li.product-category .woocommerce-loop-category__title { text-align:" . esc_attr( $shop_categories_alignment ) . ";}" . "\n";

			$shop_categories_layout = get_theme_mod( 'shop_categories_layout', 'layout1' );
			$shop_categories_radius = get_theme_mod( 'shop_categories_radius', 0 );
			$custom .= "ul.products li.product-category > a, ul.products li.product-category > a > img { border-radius:" . esc_attr( $shop_categories_radius ) . "px;}" . "\n";
			if( 'layout4' === $shop_categories_layout ) {
				$custom .= ".product-category-item-layout4 ul.products li.product-category > a h2 { border-radius: 0 0 " . esc_attr( $shop_categories_radius ) . "px " . esc_attr( $shop_categories_radius ) . "px;}" . "\n";
			}

			//Cart display coupon form
			$shop_cart_show_coupon_form = get_theme_mod( 'shop_cart_show_coupon_form', 1 );
			if( !$shop_cart_show_coupon_form ) {
				$custom .= '.woocommerce-cart .coupon { display: none; }';
			}

			//Cart display coupon form
			$shop_checkout_show_coupon_form = get_theme_mod( 'shop_checkout_show_coupon_form', 1 );
			if( !$shop_checkout_show_coupon_form ) {
				$custom .= '.woocommerce-checkout .woocommerce-form-coupon-toggle { display: none; }';
			} 

			$shop_product_card_style        = get_theme_mod( 'shop_product_card_style', 'layout1' );
			$is_boxed_card                  = in_array( $shop_product_card_style, array( 'layout2', 'layout3' ), true );
			$shop_product_card_border_color = get_theme_mod( 'shop_product_card_border_color', '#eeeeee' );
			$shop_product_card_border_size  = get_theme_mod( 'shop_product_card_border_size', 1 );
			$shop_product_card_background   = get_theme_mod( 'shop_product_card_background' );
			$shop_product_card_radius       = get_theme_mod( 'shop_product_card_radius' );
			$shop_product_card_thumb_radius = get_theme_mod( 'shop_product_card_thumb_radius' );
			// Reuse already-fetched values; compare against registered defaults to detect user saves.
			$apply_card_border = $is_boxed_card || $shop_product_card_border_color !== '#eeeeee' || intval( $shop_product_card_border_size ) !== 1;

			$card_css = '';
			if ( $shop_product_card_background ) {
				$card_css .= 'background-color: ' . esc_attr( $shop_product_card_background ) . ';';
			}
			if ( $shop_product_card_radius ) {
				$card_css .= 'border-radius: ' . intval( $shop_product_card_radius ) . 'px;';
			}
			if ( $apply_card_border ) {
				$card_css .= 'border: ' . intval( $shop_product_card_border_size ) . 'px solid ' . esc_attr( $shop_product_card_border_color ) . ';';
			}
			if ( $is_boxed_card ) {
				$card_css .= 'padding:30px;';
			}
			if ( $card_css ) {
				$custom .= '.woocommerce-page ul.products li.product { ' . $card_css . '}' . "\n";
			}
			if ( $shop_product_card_thumb_radius ) {
				$custom .= 'ul.products li.wc-block-grid__product .loop-image-wrap, ul.products li.product .loop-image-wrap { overflow:hidden;border-radius:' . intval( $shop_product_card_thumb_radius ) . 'px;}' . "\n";
			}

			if ( 'layout3' === $shop_product_card_style ) {
				$custom .= "ul.wc-block-grid__products li.wc-block-grid__product .loop-image-wrap, ul.wc-block-grid__products li.product .loop-image-wrap, ul.products li.wc-block-grid__product .loop-image-wrap, ul.products li.product .loop-image-wrap { margin:-30px -30px 12px;}" . "\n";
			}  
            
            //Global colors
			// The #352 carve-outs live inside :where() so they add no specificity. Bare
			// :not() clauses inherit their argument's weight and pushed this rule from
			// (0,4,1) to (0,7,3), which made it outrank third-party block CSS it never
			// used to touch (issue #491). Keep any future exclusion inside the :where().
			$custom .= $this->get_color_css( 'color_link_default', '', '.entry-content a:not(.button):not(.elementor-button-link):not(.wp-block-button__link):not(:where(.has-link-color a,.wp-block-post-title a,.wp-block-latest-posts__post-title))' );
			$custom .= $this->get_color_css( 'color_link_hover', '', '.entry-content a:not(.button):not(.elementor-button-link):not(.wp-block-button__link):not(:where(.has-link-color a,.wp-block-post-title a,.wp-block-latest-posts__post-title)):hover' );
			$custom .= $this->get_color_css( 'color_heading_1', '', 'h1' );
			$custom .= $this->get_color_css( 'color_heading_2', '', 'h2' );
			$custom .= $this->get_color_css( 'color_heading_3', '', 'h3' );
			$custom .= $this->get_color_css( 'color_heading_4', '', 'h4' );
			$custom .= $this->get_color_css( 'color_heading_5', '', 'h5' );
			$custom .= $this->get_color_css( 'color_heading_6', '', 'h6' );            

			$custom .= $this->get_color_css( 'color_forms_text', '', 'div.wpforms-container-full:not(.wpforms-render-modern) .wpforms-form input[type=date], div.wpforms-container-full:not(.wpforms-render-modern) .wpforms-form input[type=email], div.wpforms-container-full:not(.wpforms-render-modern) .wpforms-form input[type=number], div.wpforms-container-full:not(.wpforms-render-modern) .wpforms-form input[type=password], div.wpforms-container-full:not(.wpforms-render-modern) .wpforms-form input[type=search], div.wpforms-container-full:not(.wpforms-render-modern) .wpforms-form input[type=tel], div.wpforms-container-full:not(.wpforms-render-modern) .wpforms-form input[type=text], div.wpforms-container-full:not(.wpforms-render-modern) .wpforms-form input[type=url], div.wpforms-container-full:not(.wpforms-render-modern) .wpforms-form select, div.wpforms-container-full:not(.wpforms-render-modern) .wpforms-form textarea,input[type="text"],input[type="email"],input[type="url"],input[type="password"],input[type="search"],input[type="number"],input[type="tel"],input[type="date"],textarea,select,.woocommerce .select2-container .select2-selection--single,.woocommerce-page .select2-container .select2-selection--single,input[type="text"]:focus, input[type="email"]:focus, input[type="url"]:focus, input[type="password"]:focus, input[type="search"]:focus, input[type="number"]:focus, input[type="tel"]:focus, input[type="date"]:focus, textarea:focus, select:focus, .woocommerce .select2-container .select2-selection--single:focus, .woocommerce-page .select2-container .select2-selection--single:focus,.select2-container--default .select2-selection--single .select2-selection__rendered,.wp-block-search .wp-block-search__input,.wp-block-search .wp-block-search__input:focus' );
			$custom .= $this->get_background_color_css( 'color_forms_background', '', 'div.wpforms-container-full:not(.wpforms-render-modern) .wpforms-form input[type=date], div.wpforms-container-full:not(.wpforms-render-modern) .wpforms-form input[type=email], div.wpforms-container-full:not(.wpforms-render-modern) .wpforms-form input[type=number], div.wpforms-container-full:not(.wpforms-render-modern) .wpforms-form input[type=password], div.wpforms-container-full:not(.wpforms-render-modern) .wpforms-form input[type=search], div.wpforms-container-full:not(.wpforms-render-modern) .wpforms-form input[type=tel], div.wpforms-container-full:not(.wpforms-render-modern) .wpforms-form input[type=text], div.wpforms-container-full:not(.wpforms-render-modern) .wpforms-form input[type=url], div.wpforms-container-full:not(.wpforms-render-modern) .wpforms-form select, div.wpforms-container-full:not(.wpforms-render-modern) .wpforms-form textarea,input[type="text"],input[type="email"],input[type="url"],input[type="password"],input[type="search"],input[type="number"],input[type="tel"],input[type="date"],textarea,select,.woocommerce .select2-container .select2-selection--single,.woocommerce-page .select2-container .select2-selection--single,.woocommerce-cart .woocommerce-cart-form .actions .coupon input[type="text"]' );
			$color_forms_borders    = get_theme_mod( 'color_forms_borders' );
			$custom .= "div.wpforms-container-full:not(.wpforms-render-modern) .wpforms-form input[type=date], div.wpforms-container-full:not(.wpforms-render-modern) .wpforms-form input[type=email], div.wpforms-container-full:not(.wpforms-render-modern) .wpforms-form input[type=number], div.wpforms-container-full:not(.wpforms-render-modern) .wpforms-form input[type=password], div.wpforms-container-full:not(.wpforms-render-modern) .wpforms-form input[type=search], div.wpforms-container-full:not(.wpforms-render-modern) .wpforms-form input[type=tel], div.wpforms-container-full:not(.wpforms-render-modern) .wpforms-form input[type=text], div.wpforms-container-full:not(.wpforms-render-modern) .wpforms-form input[type=url], div.wpforms-container-full:not(.wpforms-render-modern) .wpforms-form select, div.wpforms-container-full:not(.wpforms-render-modern) .wpforms-form textarea,input[type=\"text\"],input[type=\"email\"],input[type=\"url\"],input[type=\"password\"],input[type=\"search\"],input[type=\"number\"],input[type=\"tel\"],input[type=\"range\"],input[type=\"date\"],input[type=\"month\"],input[type=\"week\"],input[type=\"time\"],input[type=\"datetime\"],input[type=\"datetime-local\"],input[type=\"color\"],textarea,select,.woocommerce .select2-container .select2-selection--single,.woocommerce-page .select2-container .select2-selection--single,.woocommerce-account fieldset,.woocommerce-account .woocommerce-form-login, .woocommerce-account .woocommerce-form-register,.woocommerce-cart .woocommerce-cart-form .actions .coupon input[type=\"text\"],.wp-block-search .wp-block-search__input { border-color:" . esc_attr( $color_forms_borders ) . ";}" . "\n";
			$color_forms_placeholder    = get_theme_mod( 'color_forms_placeholder' );
			$custom .= "input::placeholder { color:" . esc_attr( $color_forms_placeholder ) . ";opacity:1;}" . "\n";
			$custom .= "input:-ms-input-placeholder { color:" . esc_attr( $color_forms_placeholder ) . ";}" . "\n";
			$custom .= "input::-ms-input-placeholder { color:" . esc_attr( $color_forms_placeholder ) . ";}" . "\n";

			// Modern WPForms engine: theme defaults via --wpforms-* custom
			// properties (overridable per-form in the builder). No-op when
			// WPForms is inactive so no dead variables ship.
			if ( function_exists( 'wpforms' ) ) {
				$custom .= $this->sydney_wpforms_css_vars();
			}

            /* End porting */

			//Images
			$image_border_radius = get_theme_mod('image_border_radius', 0);
			$custom .= "img { border-radius:" . intval($image_border_radius) . "px;}" . "\n";
			$custom .= $this->get_font_sizes_css('image_caption_font_size', $defaults = array( 'desktop' => 16, 'tablet' => 16, 'mobile' => 16 ), '.wp-caption-text, figcaption');
			$custom .= $this->get_color_css('image_caption_color', '', '.wp-caption-text, figcaption');

			//Container widths
			$container_width = get_theme_mod( 'container_width', 1170 );
			if ( 1170 !== $container_width ) {
				$custom .= '@media (min-width: 1200px) { .container { width:100%;max-width: ' . intval( $container_width ) . 'px; } }';
			}

			$narrow_container_width = get_theme_mod( 'narrow_container_width', 860 );
			if ( 860 !== $narrow_container_width ) {
				$custom .= '@media (min-width: 1200px) { .container-narrow { width:100%;max-width: ' . intval( $narrow_container_width ) . 'px; } }';
			}

			if ( get_theme_mod( 'sydney_enable_page_min_height', false ) && apply_filters( 'sydney_enable_page_min_height', true ) ) {
				$custom .= '.site { display:flex;flex-direction:column;min-height:100vh; } .site #content { flex:1; } .admin-bar .site {min-height:calc(100vh - 32px);}';
			}
        
			// Extension point for additional settings-only CSS (Sydney Pro's
			// options class, child themes). Hooked output is CACHED with the
			// base: it must depend only on saved settings, never on the
			// current request. Request-dependent CSS belongs in the
			// per-request 'sydney_custom_css' filter instead.
			return apply_filters( 'sydney_base_css', $custom );
		}

		/**
		 * Map Sydney design tokens onto WPForms' --wpforms-* custom properties.
		 *
		 * Emitted on `body` (not :root) so it acts as a theme default for the
		 * modern render engine while a per-form builder setting (scoped to
		 * #wpforms-{id}) still overrides it via the natural cascade. Structural
		 * values mirror Sydney's field rule (css/styles.css); color values
		 * reference Sydney's global-color CSS vars with literal fallbacks so
		 * they resolve whether or not the CSS-variable palette is enabled.
		 *
		 * Pure builder — the caller guards on function_exists( 'wpforms' ).
		 *
		 * @since 2.69
		 * @return string CSS declaration block.
		 */
		private function sydney_wpforms_css_vars() {
			$vars  = 'body{';
			// Structural — match Sydney's field rule (css/styles.css).
			$vars .= '--wpforms-field-border-color:var(--sydney-border-color,#e2e2e2);';
			$vars .= '--wpforms-field-border-size:1px;';
			$vars .= '--wpforms-field-border-radius:0;';
			$vars .= '--wpforms-field-text-color:var(--sydney-text-color,#4f5b66);';
			$vars .= '--wpforms-field-background-color:#ffffff;';
			$vars .= '--wpforms-label-color:var(--sydney-headings-color,#333333);';
			// Field sizing — match Sydney's field metrics (50px tall, 20px h-padding, 16px).
			$vars .= '--wpforms-field-size-font-size:16px;';
			$vars .= '--wpforms-field-size-input-height:50px;';
			$vars .= '--wpforms-field-size-padding-h:20px;';
			// Buttons — track the Customizer button background (falls back to global color 1).
			$vars .= '--wpforms-button-background-color:var(--sydney-button-background,var(--sydney-global-color-1));';
			$vars .= '--wpforms-button-text-color:#ffffff;';
			$vars .= '--wpforms-button-border-color:var(--sydney-button-background,var(--sydney-global-color-1));';
			// Button radius — same mod the theme applies to every button.
			$vars .= '--wpforms-button-border-radius:' . intval( get_theme_mod( 'buttons_radius' ) ) . 'px;';

			// Customizer "Forms" color controls override the field defaults for
			// modern forms (classic keeps its scoped rule). Emitted last so they
			// win over the token defaults above; a per-form builder value still
			// beats these via #wpforms-{id}. Only emit set controls so unset
			// ones keep the defaults.
			$forms_text   = get_theme_mod( 'color_forms_text' );
			$forms_bg     = get_theme_mod( 'color_forms_background' );
			$forms_border = get_theme_mod( 'color_forms_borders' );
			if ( $forms_border ) {
				$vars .= '--wpforms-field-border-color:' . esc_attr( $forms_border ) . ';';
			}
			if ( $forms_bg ) {
				$vars .= '--wpforms-field-background-color:' . esc_attr( $forms_bg ) . ';';
			}
			if ( $forms_text ) {
				$vars .= '--wpforms-field-text-color:' . esc_attr( $forms_text ) . ';';
			}
			$vars .= '}';

			// Button sizing — track the theme's responsive button settings
			// (same mods + defaults as the //Buttons block above). WPForms
			// sizes buttons via a fixed height with zero vertical padding, so
			// the height token carries the theme's vertical padding instead
			// (24px line-height + padding both sides + 1px borders).
			$devices = array(
				'desktop' => '@media (min-width: 992px)',
				'tablet'  => '@media (min-width: 576px) and (max-width:  991px)',
				'mobile'  => '@media (max-width: 575px)',
			);
			foreach ( $devices as $device => $media ) {
				$font_size = intval( get_theme_mod( 'button_font_size_' . $device, 14 ) );
				$padding_h = intval( get_theme_mod( 'button_left_right_padding_' . $device, 35 ) );
				$padding_v = intval( get_theme_mod( 'button_top_bottom_padding_' . $device, 12 ) );

				$vars .= $media . '{body{'
					. '--wpforms-button-size-font-size:' . $font_size . 'px;'
					. '--wpforms-button-size-padding-h:' . $padding_h . 'px;'
					. '--wpforms-button-size-height:' . ( 24 + 2 * $padding_v + 2 ) . 'px;'
					. '}}';
			}

			// Text transform has no --wpforms-* variable; scoped rule at a
			// specificity that beats WPForms' container reset.
			$button_text_transform = get_theme_mod( 'button_text_transform', 'uppercase' );
			$vars .= 'div.wpforms-container-full.wpforms-render-modern button[type=submit],'
				. 'div.wpforms-container-full.wpforms-render-modern input[type=submit],'
				. 'div.wpforms-container-full.wpforms-render-modern .wpforms-page-button'
				. '{text-transform:' . esc_attr( $button_text_transform ) . ';}';

			return $vars;
		}

		/**
		 * Output all custom CSS.
		 *
		 * Public contract unchanged: always generates fresh, filtered,
		 * minified CSS (the cache is consulted only by print_styles()),
		 * so external callers keep getting exactly today's output.
		 */
		public function output_css( $custom = false ) {
			return $this->assemble( $this->build_base_css() );
		}

		/**
		 * Turn a base CSS blob into the final output: contextual chunks
		 * replace their placeholder tokens in place (cascade order is part
		 * of the contract), then the third-party filter and the minifier
		 * run — both per-request, never cached.
		 */
		private function assemble( $base ) {
			$custom = $this->replace_context_tokens( $base );
			$custom = apply_filters( 'sydney_custom_css', $custom );

			return $this->minify( $custom );
		}

		/**
		 * Replace the SYDNEY_CTX_n placeholder tokens with the live
		 * contextual chunks. Tokens are plain CSS comments, so a missed
		 * replacement degrades to "chunk absent for one request" (the
		 * minifier strips comments), never to broken CSS.
		 */
		private function replace_context_tokens( $css ) {
			for ( $n = 1; $n <= 5; $n++ ) {
				$css = str_replace( '/*SYDNEY_CTX_' . $n . '*/', $this->get_contextual_css_chunk( $n ), $css );
			}

			return $css;
		}

		/**
		 * Transient key for the cached base CSS.
		 *
		 * Keyed by stylesheet (parent and child themes have separate theme
		 * mods) and by text direction (the HF Builder bakes is_rtl() into
		 * column and offcanvas CSS; LTR and RTL pages can coexist on
		 * multilingual sites, so each direction gets its own stable entry).
		 */
		private function cache_key() {
			return 'sydney_base_css_' . md5( get_stylesheet() ) . ( is_rtl() ? '_rtl' : '_ltr' );
		}

		/**
		 * Validity signature stored inside the transient and recomputed on
		 * every read, so theme updates, child-theme switches, module toggles
		 * and the centered-menu branding gate self-heal the cache even when
		 * no flush hook fired. Bump 'schema' when CSS-generation code changes
		 * within a release cycle.
		 */
		private function cache_signature() {
			$data = array(
				'schema'   => 3,
				'theme'    => wp_get_theme( get_template() )->get( 'Version' ),
				'child'    => get_stylesheet(),
				'hfb'      => Sydney_Modules::is_module_active( 'hf-builder' ),
				'fresh'    => (bool) get_option( 'fresh_site' ),
				'branding' => (bool) ( get_bloginfo( 'description' ) || get_bloginfo( 'name' ) || get_theme_mod( 'site_logo' ) ),
			);

			// Extensions contributing CSS via 'sydney_base_css' add their own
			// validity inputs here (e.g. Pro version, Pro feature toggles) so
			// their cached output self-heals like the free theme's.
			$data = apply_filters( 'sydney_css_cache_signature_data', $data );

			return md5( wp_json_encode( $data ) );
		}

		/**
		 * Read the cached base CSS. Returns false on miss, malformed value
		 * or stale signature.
		 */
		private function get_cached_base_css() {
			$cached = get_transient( $this->cache_key() );

			if ( ! is_array( $cached ) || ! isset( $cached['sig'], $cached['css'] ) || $cached['sig'] !== $this->cache_signature() ) {
				return false;
			}

			return $cached['css'];
		}

		/**
		 * Store the base CSS. The TTL keeps the transient out of autoload
		 * (expiration-less transients are stored with autoload=yes — ~100KB
		 * on every request) and backstops write paths that cannot be hooked
		 * (raw SQL edits of theme mods).
		 */
		private function set_cached_base_css( $css ) {
			set_transient(
				$this->cache_key(),
				array(
					'sig' => $this->cache_signature(),
					'css' => $css,
				),
				WEEK_IN_SECONDS
			);
		}

		/**
		 * Whether to skip the cache entirely (never read, never write).
		 *
		 * The Customizer preview must always generate fresh: get_theme_mod()
		 * returns unsaved changeset values there, and the preview JS
		 * (sydney_theme_options) depends on side effects of generation.
		 * SCRIPT_DEBUG covers local development, where the theme version in
		 * the signature does not change between code edits. The filter is
		 * the documented escape hatch for plugins that vary mods per request
		 * (e.g. via core's theme_mod_{$name} filters).
		 */
		private function cache_bypass() {
			return is_customize_preview()
				|| ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG )
				|| ! apply_filters( 'sydney_enable_css_cache', true );
		}

		/**
		 * Delete the cached base CSS — both text-direction variants, since a
		 * flush event on a multilingual site must invalidate LTR and RTL alike.
		 */
		public function flush_css_cache() {
			$prefix = 'sydney_base_css_' . md5( get_stylesheet() );

			delete_transient( $prefix . '_ltr' );
			delete_transient( $prefix . '_rtl' );
		}

		/**
		 * Flush the CSS cache when a watched option is written.
		 *
		 * theme_mods_{stylesheet} covers every write path to theme mods
		 * (Customizer publish, scheduled changesets via cron, starter-site
		 * imports, WP-CLI, remove_theme_mods()); sydney-modules covers module
		 * toggles; blogname/blogdescription cover the centered-menu branding
		 * gate. Matching at fire time (instead of registering dynamic
		 * update_option_{name} hooks) keeps the constructor free of
		 * get_stylesheet() calls at file-require time.
		 *
		 * @param string $option Option name being written.
		 */
		public function maybe_flush_on_option_change( $option ) {
			$watched = array(
				'theme_mods_' . get_stylesheet(),
				'sydney-modules',
				'blogname',
				'blogdescription',
			);

			if ( in_array( $option, $watched, true ) ) {
				$this->flush_css_cache();
			}
		}

		/**
		 * Print styles
		 *
		 * The only cache consumer: on a normal front-end request the base
		 * CSS comes from the transient; contextual chunks, the
		 * sydney_custom_css filter and the minifier always run live.
		 */
		public function print_styles() {

			if ( $this->cache_bypass() ) {
				$base = $this->build_base_css();
			} else {
				$base = $this->get_cached_base_css();

				if ( false === $base ) {
					$base = $this->build_base_css();
					$this->set_cached_base_css( $base );
				}
			}

			$custom = $this->assemble( $base );

			wp_add_inline_style( 'sydney-style-min', $custom );

			wp_localize_script( 'sydney_customizer', 'sydney_theme_options', $this->customizer_js );
		}

		/**
		 * Contextual CSS chunks — the only parts of the dynamic CSS that
		 * depend on the current request (conditional tags, queried objects,
		 * AMP). Computed live on every request; everything else is cacheable.
		 *
		 * Bodies are moved verbatim from output_css(); behavior must not change.
		 *
		 * @param int $n Chunk number (1-5).
		 * @return string CSS for this chunk in the current request context.
		 */
		private function get_contextual_css_chunk( $n ) {
			$custom = '';
			$is_amp = sydney_is_amp();

			switch ( $n ) {
				case 1:
					//Get thumbnails for shop and shop archives
					$shop_thumb = get_the_post_thumbnail_url( get_option( 'woocommerce_shop_page_id' ) );
					if ( class_exists( 'Woocommerce' ) && is_product_category() ) {
						global $wp_query;
						$cat            = $wp_query->get_queried_object();
						$thumbnail_id   = get_term_meta( $cat->term_id, 'thumbnail_id', true );
						$shop_archive_thumb = wp_get_attachment_url( $thumbnail_id );
					}

					if ( class_exists( 'Woocommerce' ) && is_shop() && $shop_thumb ) {
						$custom .= ".header-image { background-image:url(" . esc_url($shop_thumb) . ")!important;display:block;}"."\n";
						$custom .= ".site-header { background-color:transparent;}" . "\n";
						$custom .= "@media only screen and (max-width: 1024px) { .sydney-hero-area .header-image { height:300px!important; }}" . "\n";
						$shop_overlay = get_theme_mod( 'hide_overlay_shop' );
						if ( $shop_overlay ) {
							$custom .= ".header-image .overlay { background-color:transparent;}" . "\n";
						}
					} elseif ( class_exists( 'Woocommerce' ) && is_product_category() && $shop_archive_thumb ) {
						$custom .= ".header-image { background-image:url(" . esc_url($shop_archive_thumb) . ")!important;display:block;}"."\n";
						if ( !$is_amp ) {
							$custom .= ".site-header { background-color:transparent;}" . "\n";
						}
						$custom .= "@media only screen and (max-width: 1024px) { .sydney-hero-area .header-image { height:300px!important; }}" . "\n";
					} elseif ( $is_amp || (get_theme_mod( 'front_header_type', apply_filters( 'sydney_front_header_type_default', 'nothing' ) ) === 'nothing' && is_front_page()) || (get_theme_mod('site_header_type') === 'nothing' && !is_front_page()) ) {
						$menu_bg_color = get_theme_mod( 'menu_bg_color', '#263246' );
						$rgba   = $this->hex2rgba($menu_bg_color, 0.9);
						$custom .= ".site-header { background-color:" . esc_attr($rgba) . ";}" . "\n";
					}
					break;

				case 2:
					// Only emit smooth-scroll CSS when a post object is available
					// and the page isn't an Elementor layout. `global $post` is
					// required for the isset() check to see the queried post.
					global $post;
					if ( isset( $post ) ) {
						$elementor_page = get_post_meta( $post->ID, '_elementor_edit_mode', true );
						if ( !$elementor_page ) {
							$custom .= "html { scroll-behavior: smooth;}" . "\n";
						}
					} else {
						$custom .= "html { scroll-behavior: smooth;}" . "\n";
					}
					break;

				case 3:
					//AMP
					$sticky_menu = get_theme_mod( 'sticky_menu', 'sticky' );
					if ( 'sticky' === $sticky_menu && $is_amp ) {
						$custom .= ".site-header { position: -webkit-sticky;position: sticky;}"."\n";
					}
					break;

				case 4:
					if ( is_singular() ) {
						$post_type = get_post_type();

						//Boxed content
						$boxed = get_theme_mod( $post_type . '_boxed_content', 'unboxed' );
						if ( $boxed === 'boxed' ) {
							$custom .= "body.singular .content-inner, body.wp-singular .content-inner { padding: 60px; background-color: #fff; box-shadow: 0 0 15px 0 rgba(0,0,0,0.05);}"."\n";
							$custom .= "@media only screen and (max-width: 767px) { body.singular .content-inner, body.wp-singular .content-inner {padding: 20px;} }" . "\n";
						}
					}

					//Archive boxed content (applies to all archives: blog, CPT archives, taxonomies, etc.)
					if ( is_archive() || is_home() ) {
						$boxed = get_theme_mod( 'blog_archive_boxed_content', 'unboxed' );

						if ( $boxed === 'boxed' ) {
							$custom .= "body.archive .content-inner, body.blog .content-inner, body.home .content-inner { padding: 60px; background-color: #fff; box-shadow: 0 0 15px 0 rgba(0,0,0,0.05);}"."\n";
							$custom .= "@media only screen and (max-width: 767px) { body.archive .content-inner, body.blog .content-inner, body.home .content-inner {padding: 20px;} }" . "\n";
						}
					}
					break;

				case 5:
					if ( $is_amp ) {
						$custom .= ".go-top { bottom: 30px;opacity:1;visibility:visible;}" . "\n";
					}
					break;
			}

			return $custom;
		}

		/**
		 * CSS code minification.
		 */
		private function minify( $css ) {
			$css = preg_replace( '/\s+/', ' ', $css );
			$css = preg_replace( '/\/\*[^\!](.*?)\*\//', '', $css );
			$css = preg_replace( '/(,|:|;|\{|}) /', '$1', $css );
			$css = preg_replace( '/ (,|;|\{|})/', '$1', $css );
			$css = preg_replace( '/(:| )0\.([0-9]+)(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}.${2}${3}', $css );
			$css = preg_replace( '/(:| )(\.?)0(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}0', $css );

			return trim( $css );
		}

		/**
		 * Resolve a color mod against its connected global color.
		 *
		 * When the setting has a connected global color, the global is
		 * authoritative and wins over a stale literal value.
		 *
		 * @param string $setting        The color setting name.
		 * @param string $mod            The literal theme mod value.
		 * @param string $global_default Default for the global slot (for settings whose global setting has a customizer-registered default).
		 * @return string The resolved color value (or the literal mod when no global is connected).
		 */
		public static function resolve_global_color_mod( $setting, $mod, $global_default = '' ) {
			// Read the css-vars flag once per request; ~30+ color helpers call this
			// function, so avoid re-invoking get_theme_mod and its filter pipeline
			// on every rule.
			// Read via the singleton instance so the cache is tied to the instance
			// lifetime — nulling the singleton (e.g. in resetSingleton()) clears the
			// cache automatically, which prevents cross-test pollution in PHPUnit.
			$self = self::get_instance();
			if ( null === $self->use_css_vars_cache ) {
				$self->use_css_vars_cache = get_theme_mod( 'sydney_global_color_css_vars', false );
			}
			$use_css_vars = $self->use_css_vars_cache;

			// Check if a global color is connected.
			// Intentional: the global is unconditionally authoritative once connected.
			// The previous colors_match() guard (which only substituted when the literal
			// happened to equal the global) was removed deliberately — users who connect a
			// global slot accept that the global always wins, and the literal is treated as
			// a stale cache until the global is disconnected.
			$global_setting = get_theme_mod( 'global_' . $setting, $global_default );

			if ( $global_setting && strpos( $global_setting, 'global_color_' ) === 0 ) {
				if ( $use_css_vars ) {
					// Extract the color number and use the CSS variable
					$color_number = str_replace( 'global_color_', '', $global_setting );
					return 'var(--sydney-global-color-' . $color_number . ')';
				}

				// Get the global color value using proper defaults
				$global_color_defaults = sydney_get_global_color_defaults();
				$global_color_default  = isset( $global_color_defaults[ $global_setting ] ) ? $global_color_defaults[ $global_setting ] : '';
				$global_color_value    = get_theme_mod( $global_setting, $global_color_default );

				if ( $global_color_value ) {
					return $global_color_value;
				}
			}

			return $mod;
		}

		/**
		 * Get color CSS
		 */
		public static function get_background_color_css( $setting, $default, $selector, $important = false, $global_default = '' ) {
			$mod = get_theme_mod( $setting, $default );
			$mod = self::resolve_global_color_mod( $setting, $mod, $global_default );

			Sydney_Custom_CSS::get_instance()->mount_customizer_js_options( $selector, $setting, 'background-color', '', $important );

			return $selector . '{ background-color:' . esc_attr( $mod ) . ';}' . "\n";
		}

		/**
		 * Check if two color values match (handles different formats)
		 */
		public static function colors_match( $color1, $color2 ) {
			if ( empty( $color1 ) || empty( $color2 ) ) {
				return false;
			}

			// Normalize both colors: lowercase, trim, remove # prefix
			$color1 = strtolower( trim( ltrim( $color1, '#' ) ) );
			$color2 = strtolower( trim( ltrim( $color2, '#' ) ) );

			return $color1 === $color2;
		}

	/**
	 * Get color CSS
	 */
	public static function get_color_css( $setting, $default, $selector, $important = false, $global_default = '' ) {
		$mod = get_theme_mod( $setting, $default );
		$mod = self::resolve_global_color_mod( $setting, $mod, $global_default );

        Sydney_Custom_CSS::get_instance()->mount_customizer_js_options( $selector, $setting, 'color', '', $important );

		return $selector . '{ color:' . esc_attr( $mod ) . ';}' . "\n";
	}

	/**
	 * Get border color CSS
	 */
	public static function get_border_color_css( $setting = '', $default = '', $selector = '', $important = false, $global_default = '' ) {
		$mod = get_theme_mod( $setting, $default );
		$mod = self::resolve_global_color_mod( $setting, $mod, $global_default );

		Sydney_Custom_CSS::get_instance()->mount_customizer_js_options( $selector, $setting, 'border-color', '', $important );

		return $selector . '{ border-color:' . esc_attr( $mod ) . ( $important ? '!important' : '' ) . ';}' . "\n";
	}
		
	/**
	 * Get fill CSS
	 */
	public static function get_fill_css( $setting, $default, $selector, $important = false, $global_default = '' ) {
		$mod = get_theme_mod( $setting, $default );
		$mod = self::resolve_global_color_mod( $setting, $mod, $global_default );

		Sydney_Custom_CSS::get_instance()->mount_customizer_js_options( $selector, $setting, 'fill', '', $important );

		return $selector . '{ fill:' . esc_attr( $mod ) . ';}' . "\n";
	}
		
	/**
	 * Get stroke CSS
	 */
	public static function get_stroke_css( $setting, $default, $selector, $global_default = '' ) {
		$mod = get_theme_mod( $setting, $default );
		$mod = self::resolve_global_color_mod( $setting, $mod, $global_default );

		return $selector . '{ stroke:' . esc_attr( $mod ) . ';}' . "\n";
	}

		//Font sizes
		public static function get_font_sizes_css( $setting, $defaults, $selector ) {
			$devices    = array( 
				'desktop'   => '@media (min-width: 992px)',
				'tablet'    => '@media (min-width: 576px) and (max-width:  991px)',
				'mobile'    => '@media (max-width: 575px)',
			);

			$css = '';

			foreach ( $devices as $device => $media ) {
				$mod = get_theme_mod( $setting . '_' . $device, $defaults[$device] );
				$css .= $media . ' { ' . $selector . ' { font-size:' . intval( $mod ) . 'px;} }' . "\n";    
			}

			return $css;
		}

		public static function mount_customizer_js_options( $selector = '', $setting = '', $prop = '', $opacity = '', $important = false, $is_responsive = false, $type = '', $device = '', $unit = '' ) {
			$options = array(
				'option'        => $setting,
				'selector'      => $selector,
				'prop'          => $prop,
				'important'     => $important,
				'is_responsive' => $is_responsive,
				'type'          => $type,
				'device'        => $device,
				'unit'          => $unit,
			);

			if( $opacity ) {
				$options[ 'rgba' ] = $opacity;
			}

			$options[ 'pseudo' ] = true;
			
			self::get_instance()->customizer_js[] = $options;
		}
		
		//Max width
		public static function get_max_width_css( $setting, $defaults, $selector, $units = 'px' ) {
			$devices    = array( 
				'desktop'   => '@media (min-width: 992px)',
				'tablet'    => '@media (min-width: 576px) and (max-width:  991px)',
				'mobile'    => '@media (max-width: 575px)',
			);

			$css = '';

			foreach ( $devices as $device => $media ) {
				$mod = get_theme_mod( $setting . '_' . $device, $defaults[$device] );
				$css .= $media . ' { ' . $selector . ' { max-width:' . intval( $mod ) . $units . ';} }' . "\n";    
			}

			return $css;
		}

		//Min height
		public static function get_min_height_css( $setting, $defaults, $selector ) {
			$devices    = array(
				'desktop'   => '@media (min-width: 992px)',
				'tablet'    => '@media (min-width: 576px) and (max-width:  991px)',
				'mobile'    => '@media (max-width: 575px)',
			);

			$css = '';

			foreach ( $devices as $device => $media ) {
				$mod = get_theme_mod( $setting . '_' . $device, $defaults[$device] );
				$css .= $media . ' { ' . $selector . ' { min-height:' . intval( $mod ) . 'px;} }' . "\n";
			}

			return $css;
		}

		//height
		public static function get_height_css( $setting, $defaults, $selector ) {
			$devices    = array( 
				'desktop'   => '@media (min-width: 992px)',
				'tablet'    => '@media (min-width: 576px) and (max-width:  991px)',
				'mobile'    => '@media (max-width: 575px)',
			);

			$css = '';

			foreach ( $devices as $device => $media ) {
				$mod = get_theme_mod( $setting . '_' . $device, $defaults[$device] );
				$css .= $media . ' { ' . $selector . ' { height:' . intval( $mod ) . 'px;} }' . "\n";   
			}

			return $css;
		}    

		//Max height
		public static function get_max_height_css( $setting, $defaults, $selector ) {
			$devices    = array( 
				'desktop'   => '@media (min-width: 992px)',
				'tablet'    => '@media (min-width: 576px) and (max-width:  991px)',
				'mobile'    => '@media (max-width: 575px)',
			);

			$css = '';

			foreach ( $devices as $device => $media ) {
				$mod = get_theme_mod( $setting . '_' . $device, $defaults[$device] );
				$css .= $media . ' { ' . $selector . ' { max-height:' . intval( $mod ) . 'px;} }' . "\n";   
			}

			return $css;
		}   

		//Top bottom padding
		public static function get_top_bottom_padding_css( $setting, $defaults, $selector ) {
			$devices    = array( 
				'desktop'   => '@media (min-width: 992px)',
				'tablet'    => '@media (min-width: 576px) and (max-width:  991px)',
				'mobile'    => '@media (max-width: 575px)',
			);

			$css = '';

			foreach ( $devices as $device => $media ) {
				$mod = get_theme_mod( $setting . '_' . $device, $defaults[$device] );
				$css .= $media . ' { ' . $selector . ' { padding-top:' . intval( $mod ) . 'px;padding-bottom:' . intval( $mod ) . 'px;} }' . "\n";  
			}

			return $css;
		}   

		//Left right padding
		public static function get_left_right_padding_css( $setting, $defaults, $selector ) {
			$devices    = array( 
				'desktop'   => '@media (min-width: 992px)',
				'tablet'    => '@media (min-width: 576px) and (max-width:  991px)',
				'mobile'    => '@media (max-width: 575px)',
			);

			$css = '';

			foreach ( $devices as $device => $media ) {
				$mod = get_theme_mod( $setting . '_' . $device, $defaults[$device] );
				$css .= $media . ' { ' . $selector . ' { padding-left:' . intval( $mod ) . 'px;padding-right:' . intval( $mod ) . 'px;} }' . "\n";  
			}

			return $css;
		}   

        public function hex2rgba($color, $opacity = false) {

            $output = '';
            
            if ( $color !== false ) {
                if ($color[0] === '#' ) {
                    $color = substr( $color, 1 );
                }
                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
                $rgb =  array_map('hexdec', $hex);
                $opacity = 0.9;
                $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
            }
    
            return $output;
        }

		/**
		 * Get background color rgba CSS
		 */
		public static function get_background_color_rgba_css( $setting, $default, $selector, $opacity ) {
			$mod = get_theme_mod( $setting, $default );

			return $selector . '{ background-color:' . esc_attr( Sydney_Custom_CSS::get_instance()->hex2rgba( $mod, $opacity ) ) . ';}' . "\n";
		}        

 		/**
		 * Get border color rgba CSS
		 */
		public static function get_border_color_rgba_css( $setting, $default, $selector, $opacity, $important = false ) {
			$mod = get_theme_mod( $setting, $default );

			return $selector . '{ border-color:' . esc_attr( Sydney_Custom_CSS::get_instance()->hex2rgba( $mod, $opacity ) ) . ( $important ? '!important' : '' ) .';}' . "\n";
		}

		//Responsive dimensions
		public static function get_responsive_dimensions_css( $setting = '', $defaults = array(), $selector = '', $css_prop = '', $important = false ) {
			$devices = array( 
				'desktop'   => '@media (min-width: 992px)',
				'tablet'    => '@media (min-width: 576px) and (max-width:  991px)',
				'mobile'    => '@media (max-width: 575px)',
			);

			$css = '';

			foreach ( $devices as $device => $media ) {
				$mod_val = json_decode( get_theme_mod( $setting . '_' . $device, $defaults[$device] ) );
				$mod_val = is_object( $mod_val ) ? $mod_val : json_decode( $defaults[$device] );

				self::get_instance()->mount_customizer_js_options( $selector, $setting . '_' . $device, $css_prop, '', $important, true, 'dimensions', $device );

				if( $mod_val->top === '' && $mod_val->right === '' && $mod_val->bottom === '' && $mod_val->left === '' ) {
					continue;
				}

				$mod_val->top    = $mod_val->top === '' ? 0 : $mod_val->top;
				$mod_val->right  = $mod_val->right === '' ? 0 : $mod_val->right;
				$mod_val->bottom = $mod_val->bottom === '' ? 0 : $mod_val->bottom;
				$mod_val->left   = $mod_val->left === '' ? 0 : $mod_val->left;

				$css_prop_value = "{$mod_val->top}{$mod_val->unit} {$mod_val->right}{$mod_val->unit} {$mod_val->bottom}{$mod_val->unit} {$mod_val->left}{$mod_val->unit}";
				$css .= $media . ' { ' . $selector . ' { ' . $css_prop . ':' . esc_attr( $css_prop_value ) . ( $important ? '!important' : '' ) . '; } }' . "\n";   
			}

			return $css;
		}

		//Responsive CSS (can pass css prop and unit)
		public static function get_responsive_css( $setting = '', $defaults = array(), $selector = '', $css_prop = '', $unit = 'px', $important = false ) {
			$devices    = array( 
				'desktop'   => '@media (min-width: 992px)',
				'tablet'    => '@media (min-width: 576px) and (max-width:  991px)',
				'mobile'    => '@media (max-width: 575px)',
			);

			$css = '';

			foreach ( $devices as $device => $media ) {

				$default = ( isset( $defaults[ $device ] ) ) ? $defaults[ $device ] : $defaults;

				$mod = get_theme_mod( $setting . '_' . $device, $default );

				// Some properties need to be converted to be compatible with the respective css property
				$type = '';
				if( strpos( $setting, '_visibility' ) !== FALSE && $css_prop === 'display' ) {
					$type = 'display';
				}

				self::get_instance()->mount_customizer_js_options( $selector, $setting . '_' . $device, $css_prop, '', $important, true, $type, $device, $unit );

				// Check and convert value to be compatible with 'display' css property
				if( $css_prop === 'display' ) {
					if( $mod === 'hidden' ) {
						$mod = 'none';
					} else {
						continue;
					}
				}

				$css .= $media . ' { ' . $selector . ' { ' . $css_prop . ':' . esc_attr( $mod ) . ( $unit ? $unit : '' ) . ( $important ? '!important' : '' ) . '; } }' . "\n"; 
			}

			return $css;
		}

		//CSS (can pass css prop and unit)
		public static function get_css( $setting = '', $default_value = '', $selector = '', $css_prop = '', $unit = 'px', $important = false ) {
			$mod = get_theme_mod( $setting, $default_value );

			self::get_instance()->mount_customizer_js_options( $selector, $setting, $css_prop, '', $important, false, '', '', $unit );

			if( is_array( $css_prop ) ) {
				$css_output = '';

				foreach( $css_prop as $css ) {
					$css_output .= $selector . '{ '. $css['prop'] .':' . esc_attr( $mod ) . ( isset( $css['unit'] ) ? $css['unit'] : '' ) . ( $important ? '!important' : '' ) . ';}' . "\n";
				}

				return $css_output;
			} else {
				return $selector . '{ '. $css_prop .':' . esc_attr( $mod ) . ( $unit ? $unit : '' ) . ( $important ? '!important' : '' ) . ';}' . "\n";
			}
		}

		/**
		 * Get border bottom color rgba CSS
		 */
		public static function get_border_bottom_color_rgba_css( $setting = '', $default_value = '', $selector = '', $opacity = 1, $important = false ) {
			$mod = get_theme_mod( $setting, $default_value );

			self::get_instance()->mount_customizer_js_options( $selector, $setting, 'border-bottom-color', $opacity, $important );

			return $selector . '{ border-bottom-color:' . esc_attr( self::get_instance()->to_rgba( $mod, $opacity ) ) . ( $important ? '!important' : '' ) .';}' . "\n";
		}
		
		//Convert hex to rgba
		public static function to_rgba( $color = '', $opacity = false ) {

			$default = 'rgb(0,0,0)';

			if( strpos( $color, 'rgba' ) !== FALSE ) {
				return $color;
			}
		 
			if ( $color ) {
				if ( $color[0] === '#' ) {
					$color = substr( $color, 1 );
				}   
			}

			if (strlen($color) === 6) {
				$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
			} elseif ( strlen( $color ) === 3 ) {
				$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
			} else {
				return $default;
			}
		
			$rgb =  array_map('hexdec', $hex);
		
			if ( $opacity ){
				if( abs($opacity) > 1 )
					$opacity = 1.0;
				$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
			} else {
				$output = 'rgb('.implode(",",$rgb).')';
			}
		
			return $output;
		}

		// Get css variables
		public static function get_variables_css( $selector = '', $variables = array() ) {

			$devices    = array(
				'mobile'  => '',
				'tablet'  => '@media (min-width: 576px) and (max-width:  991px)',
				'desktop' => '@media (min-width: 992px)',
			);

			$css = '';

			foreach ( $devices as $device => $media ) {

				// Mobile first concept.
				if( 'mobile' === $device ) {
					$css .= $selector . ' {' . self::get_variables_css_content( $variables, $device ) . '}' . "\n";
				} else {
					$css .= $media . ' { ' . $selector . ' {'. self::get_variables_css_content( $variables, $device ) .'} }' . "\n";    
				}
			}

			self::get_instance()->mount_customizer_js_css_vars_options( $selector, $variables );

			return $css;
		}

		public static function get_variables_css_content( $variables, $device ) {
			$css = '';

			foreach( $variables as $variable ) {
				$temp_css = '';

				$is_responsive = is_array($variable[ 'defaults' ]);

				if( $is_responsive ) {
					$mod = get_theme_mod( $variable[ 'setting' ] . '_' . $device, $variable[ 'defaults' ][ $device ] );
				} else {
					$mod = get_theme_mod( $variable[ 'setting' ], $variable[ 'defaults' ] );
				}

				if( '--bt-color-bg' === $variable[ 'name' ] && substr( $mod, 0, 1 ) !== '#' ) {
					$mod = "#$mod";
				}
				
				$temp_css .= $variable[ 'name' ] .':' . $mod . $variable[ 'unit' ] .';' . "\n";

				if( ! $is_responsive && $device !== 'mobile' ) {
					$temp_css = '';
				}

				$css .= $temp_css;

				// phpcs:ignore WordPress.PHP.StrictInArray.MissingTrueStrict
				if ( ! in_array( $variable[ 'name' ], self::$css_to_replace ) ) {
					self::$css_to_replace[] = $variable[ 'name' ];
				}
			}

			return $css;
		}

		// CSS Variable val()
		public static function get_variable_css( $setting = '', $default_value = '', $selector = '', $prop = '', $unit = '' ) {

			$mod = get_theme_mod( $setting, $default_value );

			if ( $mod !== '' ) {

				if( $setting === 'background_color' && substr( $mod, 0, 1 ) !== '#' ) {
					$mod = '#'.$mod;
				}

				return $selector . ' { --'. $prop .':' . esc_attr( $mod ) . $unit .';}' . "\n"; 
			
			}
		}   

		// Responsive CSS Variable val()
		public static function get_responsive_variable_css( $setting = '', $defaults = array(), $selector = '', $variable_name = '', $unit = '' ) {

			$devices    = array( 
				'desktop' => '@media (min-width: 992px)',
				'tablet'  => '@media (min-width: 576px) and (max-width:  991px)',
				'mobile'  => '@media (max-width: 575px)',
			);

			$css = '';

			foreach ( $devices as $device => $media ) {
				$mod = get_theme_mod( $setting . '_' . $device, $defaults[ $device ] );
				if ( $mod !== '' ) {
					$css .= $media . ' { ' . $selector . ' { --'. $variable_name .':' . intval( $mod ) . $unit .';} }' . "\n";  
				}
			}

			return $css;
		}

		public static function mount_customizer_js_css_vars_options( $selector = '', $variables = array() ) {
			$options = array(
				'selector'      => $selector,
				'variables'     => $variables,
			);

			self::get_instance()->customizer_js_css_vars[] = $options;
		}   
		
		/**
		 * Get border top color CSS
		 */
		public static function get_border_top_color_css( $setting, $default_value, $selector ) {
			$mod = get_theme_mod( $setting, $default_value );

			self::get_instance()->mount_customizer_js_options( $selector, $setting, 'border-top-color' );

			return $selector . '{ border-top-color:' . esc_attr( $mod ) . ';}' . "\n";
		}

		/**
		 * Get border top color rgba CSS
		 */
		public static function get_border_top_color_rgba_css( $setting = '', $default_value = '', $selector = '', $opacity = 1, $important = false ) {
			$mod = get_theme_mod( $setting, $default_value );

			self::get_instance()->mount_customizer_js_options( $selector, $setting, 'border-top-color', $opacity, $important );

			return $selector . '{ border-top-color:' . esc_attr( self::get_instance()->to_rgba( $mod, $opacity ) ) . ( $important ? '!important' : '' ) .';}' . "\n";
		}
	}

	/**
	 * Initialize class
	 */
	Sydney_Custom_CSS::get_instance();

endif;