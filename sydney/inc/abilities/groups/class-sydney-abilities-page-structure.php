<?php
/**
 * Page-structure abilities: help AI clients write accurate CSS cheaply.
 *
 * Three read-only abilities, in preferred order of cost:
 *  1. sydney/get-theme-selectors  — static Sydney selector cheat sheet (~0 fetch).
 *  2. sydney/find-elements        — scoped live query, only matching nodes.
 *  3. sydney/get-page-structure   — full distilled page tree (fallback).
 *
 * The live abilities fetch the rendered front end over a same-site loopback
 * request, distill the HTML with Sydney_Abilities_DOM_Distiller, and share a
 * short-lived HTML transient so iterate-look-iterate loops cost one fetch.
 *
 * @package Sydney
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once get_template_directory() . '/inc/abilities/class-sydney-abilities-dom-distiller.php';

if ( ! class_exists( 'Sydney_Abilities_Page_Structure' ) ) :

	/**
	 * Registers the page-structure read abilities.
	 */
	class Sydney_Abilities_Page_Structure {

		/**
		 * Transient TTL for fetched HTML.
		 */
		const CACHE_TTL = 300; // 5 minutes.

		/**
		 * Register all three read abilities.
		 */
		public function register() {
			Sydney_Ability::register(
				'sydney/get-theme-selectors',
				array(
					'label'            => __( 'Get theme CSS selectors', 'sydney' ),
					'description'      => __( 'Call this FIRST for any styling/CSS request. Returns a compact cheat sheet of Sydney\'s stable CSS selectors and custom properties (header, navigation, hero, footer, sidebar, buttons, core block classes) so you can write CSS with no page fetch. Only query the live page (sydney/find-elements) if the target is page-specific content not covered here. Apply CSS with sydney/update-custom-css.', 'sydney' ),
					'input_schema'     => array( 'type' => 'object' ),
					'output_schema'    => Sydney_Ability::envelope_schema(
						array(
							'reference' => array( 'type' => 'string' ),
							'version'   => array( 'type' => 'string' ),
						)
					),
					'execute_callback' => array( $this, 'execute_get_theme_selectors' ),
					'meta'             => array( 'annotations' => Sydney_Ability::READ_ANNOTATIONS ),
				)
			);

			Sydney_Ability::register(
				'sydney/find-elements',
				array(
					'label'            => __( 'Find page elements', 'sydney' ),
					'description'      => __( 'Query a rendered front-end page on THIS site and return only the elements matching a text, selector, and/or area filter, with their ancestor path and immediate children — the cheap default when you need a CSS selector for a specific element. Provide at least one of text/selector/area. Prefer sydney/get-theme-selectors first for stable structure. Note: server-rendered HTML only — JS-modified DOM (open mobile menu, sticky-scroll classes) is not visible.', 'sydney' ),
					'input_schema'     => array(
						'type'       => 'object',
						'required'   => array( 'url' ),
						'properties' => array(
							'url'            => array(
								'type'        => 'string',
								'description' => 'Front-end URL on this site to inspect (must be same-site).',
							),
							'text'           => array(
								'type'        => 'string',
								'description' => 'Case-insensitive substring of visible text to match.',
							),
							'selector'       => array(
								'type'        => 'string',
								'description' => 'Simple selector: tag, .class, #id, or a combination (e.g. a.button, .menu-item). No descendant combinators.',
							),
							'area'           => array(
								'type'        => 'string',
								'enum'        => array( 'header', 'footer', 'main', 'sidebar', 'nav' ),
								'description' => 'Restrict the query to a landmark region.',
							),
							'context_levels' => array(
								'type'        => 'integer',
								'default'     => 3,
								'description' => 'Ancestor levels to include per match (default 3).',
							),
						),
					),
					'output_schema'    => Sydney_Ability::envelope_schema(
						array(
							'url'     => array( 'type' => 'string' ),
							'summary' => array( 'type' => 'string' ),
						)
					),
					'execute_callback' => array( $this, 'execute_find_elements' ),
					'meta'             => array( 'annotations' => Sydney_Ability::READ_ANNOTATIONS ),
				)
			);

			Sydney_Ability::register(
				'sydney/get-page-structure',
				array(
					'label'            => __( 'Get page structure', 'sydney' ),
					'description'      => __( 'Return a distilled element tree of a rendered front-end page on THIS site (tags, classes, ids, short text — no attributes), for page-wide restyling. Use only when you need the whole page; for a single element use sydney/find-elements instead. Server-rendered HTML only.', 'sydney' ),
					'input_schema'     => array(
						'type'       => 'object',
						'required'   => array( 'url' ),
						'properties' => array(
							'url'       => array(
								'type'        => 'string',
								'description' => 'Front-end URL on this site to inspect (must be same-site).',
							),
							'selector'  => array(
								'type'        => 'string',
								'description' => 'Optional simple selector to scope the tree to a subtree.',
							),
							'max_depth' => array(
								'type'        => 'integer',
								'default'     => 8,
								'description' => 'Maximum nesting depth to render (default 8).',
							),
						),
					),
					'output_schema'    => Sydney_Ability::envelope_schema(
						array(
							'url'     => array( 'type' => 'string' ),
							'summary' => array( 'type' => 'string' ),
						)
					),
					'execute_callback' => array( $this, 'execute_get_page_structure' ),
					'meta'             => array( 'annotations' => Sydney_Ability::READ_ANNOTATIONS ),
				)
			);
		}

		/**
		 * Static Sydney selector reference.
		 *
		 * @param array $args Unused.
		 * @return array
		 */
		public function execute_get_theme_selectors( $args ) {
			$version = defined( 'SYDNEY_THEME_VERSION' ) ? SYDNEY_THEME_VERSION : (string) wp_get_theme()->get( 'Version' );

			return Sydney_Abilities_Response::success(
				__( 'Sydney selector reference retrieved.', 'sydney' ),
				array(
					'reference' => $this->theme_selectors_reference(),
					'version'   => $version,
				)
			);
		}

		/**
		 * Scoped element query.
		 *
		 * @param array $args Input.
		 * @return array
		 */
		public function execute_find_elements( $args ) {
			$filters = array();
			foreach ( array( 'text', 'selector', 'area' ) as $key ) {
				if ( isset( $args[ $key ] ) && '' !== trim( (string) $args[ $key ] ) ) {
					$filters[ $key ] = trim( (string) $args[ $key ] );
				}
			}

			if ( empty( $filters ) ) {
				return Sydney_Abilities_Response::error( __( 'Provide at least one filter: text, selector, or area.', 'sydney' ) );
			}

			if ( isset( $filters['area'] ) && ! in_array( $filters['area'], array( 'header', 'footer', 'main', 'sidebar', 'nav' ), true ) ) {
				return Sydney_Abilities_Response::error( __( 'area must be one of: header, footer, main, sidebar, nav.', 'sydney' ) );
			}

			$fetched = $this->fetch_html( isset( $args['url'] ) ? $args['url'] : '' );
			if ( null !== $fetched['error'] ) {
				return Sydney_Abilities_Response::error( $fetched['error'] );
			}

			$context_levels = isset( $args['context_levels'] ) ? absint( $args['context_levels'] ) : 3;

			$distiller = new Sydney_Abilities_DOM_Distiller( $fetched['html'] );
			$summary   = $distiller->find( $filters, $context_levels );

			return Sydney_Abilities_Response::success(
				__( 'Query complete.', 'sydney' ),
				array(
					'url'     => esc_url_raw( $args['url'] ),
					'summary' => $summary,
				)
			);
		}

		/**
		 * Full distilled page tree.
		 *
		 * @param array $args Input.
		 * @return array
		 */
		public function execute_get_page_structure( $args ) {
			$fetched = $this->fetch_html( isset( $args['url'] ) ? $args['url'] : '' );
			if ( null !== $fetched['error'] ) {
				return Sydney_Abilities_Response::error( $fetched['error'] );
			}

			$selector  = isset( $args['selector'] ) ? trim( (string) $args['selector'] ) : '';
			$max_depth = isset( $args['max_depth'] ) ? absint( $args['max_depth'] ) : 8;

			$distiller = new Sydney_Abilities_DOM_Distiller( $fetched['html'] );

			if ( ! $distiller->is_loaded() ) {
				return Sydney_Abilities_Response::error( __( 'Could not parse the page HTML.', 'sydney' ) );
			}

			$tree = $distiller->tree( $selector, $max_depth );

			if ( '' === $tree ) {
				return Sydney_Abilities_Response::error(
					'' !== $selector
						? sprintf( /* translators: %s: CSS selector. */ __( 'No element matched the selector "%s".', 'sydney' ), $selector )
						: __( 'The page produced an empty structure.', 'sydney' )
				);
			}

			return Sydney_Abilities_Response::success(
				__( 'Page structure retrieved.', 'sydney' ),
				array(
					'url'     => esc_url_raw( $args['url'] ),
					'summary' => $tree,
				)
			);
		}

		/**
		 * Fetch rendered HTML for a same-site URL, transient-cached.
		 *
		 * Same-origin only: the host must match home_url(), guarding against
		 * server-side request forgery to arbitrary hosts.
		 *
		 * @param string $url URL.
		 * @return array { html: string|null, error: string|null }
		 */
		protected function fetch_html( $url ) {
			$url = trim( (string) $url );
			if ( '' === $url ) {
				return $this->fetch_error( __( 'A url is required.', 'sydney' ) );
			}

			$parts = wp_parse_url( $url );
			if ( empty( $parts['host'] ) || empty( $parts['scheme'] ) ) {
				return $this->fetch_error( __( 'Provide an absolute http(s) URL on this site.', 'sydney' ) );
			}
			if ( ! in_array( strtolower( $parts['scheme'] ), array( 'http', 'https' ), true ) ) {
				return $this->fetch_error( __( 'Only http(s) URLs are allowed.', 'sydney' ) );
			}

			$home = wp_parse_url( home_url() );
			$home_host = isset( $home['host'] ) ? strtolower( $home['host'] ) : '';
			if ( '' === $home_host || strtolower( $parts['host'] ) !== $home_host ) {
				return $this->fetch_error( __( 'Only same-site URLs are allowed (the page must be on this site).', 'sydney' ) );
			}

			$key    = 'sydney_page_html_' . md5( $url );
			$cached = get_transient( $key );
			if ( false !== $cached ) {
				return array(
					'html'  => (string) $cached,
					'error' => null,
				);
			}

			$response = wp_remote_get(
				$url,
				array(
					'timeout'     => 10,
					'redirection' => 2,
				)
			);

			if ( is_wp_error( $response ) ) {
				return $this->fetch_error( sprintf( /* translators: %s: error detail. */ __( 'Could not fetch the page: %s', 'sydney' ), $response->get_error_message() ) );
			}

			$code = (int) wp_remote_retrieve_response_code( $response );
			if ( 200 !== $code ) {
				return $this->fetch_error( sprintf( /* translators: %d: HTTP status code. */ __( 'The page returned HTTP %d.', 'sydney' ), $code ) );
			}

			$ctype = (string) wp_remote_retrieve_header( $response, 'content-type' );
			if ( '' !== $ctype && false === stripos( $ctype, 'html' ) ) {
				return $this->fetch_error( __( 'The URL did not return an HTML page.', 'sydney' ) );
			}

			$html = (string) wp_remote_retrieve_body( $response );
			if ( '' === trim( $html ) ) {
				return $this->fetch_error( __( 'The page returned an empty body.', 'sydney' ) );
			}

			set_transient( $key, $html, self::CACHE_TTL );

			return array(
				'html'  => $html,
				'error' => null,
			);
		}

		/**
		 * Fetch-error shape.
		 *
		 * @param string $message Message.
		 * @return array
		 */
		private function fetch_error( $message ) {
			return array(
				'html'  => null,
				'error' => $message,
			);
		}

		/**
		 * The static selector cheat sheet.
		 *
		 * Maintained with the theme. Notes Sydney's two header/footer engines:
		 * the classic header (Sydney_Header) and the HF Builder module, whose
		 * markup differs. Only stable, load-bearing selectors are listed.
		 *
		 * @return string
		 */
		protected function theme_selectors_reference() {
			return <<<'REF'
SYDNEY THEME — CSS SELECTOR CHEAT SHEET
Prefer overriding the CSS custom properties below over deep selector chains.
Sydney ships TWO header/footer engines; both may exist in markup — target the
one your site uses. Classes marked (classic) / (hf) note which engine renders them.

LAYOUT WRAPPERS
  #page                     Outer site wrapper (.hfeed.site)
  #content                  Main content wrapper
  .container                Default content container (width-constrained row)
  .content-area / #primary  Main content column
  .site-main                Main content region

HEADER
  .site-header              Header root (hf)
  .site-header-inner        Header inner container (hf)
  .header-wrap              Header wrapper (classic)
  .header-inner             Header inner row (classic)
  .header-image             Header/hero image container
  .sydney-hero-area         Hero/slider area

NAVIGATION
  .main-navigation          Primary nav (hf)
  .mainnav                  Primary nav (classic)
  .menu-item                A menu list item
  .menu-item-has-children   Menu item with a submenu
  .sub-menu                 Submenu <ul>
  .current-menu-item        Active menu item
  .btn-menu                 Mobile menu toggle (classic)
  .menu-toggle              Mobile menu toggle (hf)

FOOTER
  .site-footer / #colophon  Footer root
  .footer-widgets           Footer widget region
  .footer-widgets-grid      Footer widgets grid
  .site-info                Footer credits/copyright row

SIDEBAR
  #secondary                Sidebar root
  .widget-area              Widget region
  .widget                   A single widget

BUTTONS
  .button                   Theme button
  .roll-button              Header call-to-action button
  .wp-block-button__link    Gutenberg button
  .btn-menu                 Mobile menu button (classic)

CORE BLOCKS (Gutenberg)
  .wp-block-group, .wp-block-columns, .wp-block-column
  .wp-block-cover, .wp-block-image, .wp-block-heading, .wp-block-buttons
  .entry-content            Post/page content wrapper

BODY CLASSES OF NOTE
  .home, .blog, .archive, .single, .page
  .sidebar-* / .no-sidebar  Layout variants
  .elementor-page           Page built with Elementor

CSS CUSTOM PROPERTIES (override these first)
  --sydney-global-color-1 … --sydney-global-color-9   Global palette slots
  --sydney-text-color        Body text color
  --sydney-headings-color    Headings color
  --sydney-grey-color        Muted/secondary text
  --sydney-border-color      Borders
  --sydney-button-background Button background
  --sydney-light-background  Light section background
  --sydney-dark-background   Dark section background
  --sydney-scrolltop-distance Back-to-top reveal distance

NOTES
  • Elementor pages wrap content in .elementor / .e-con / .e-con-inner containers.
  • Values are emitted as inline CSS with literal values AND custom properties;
    overriding the property cascades to most elements.
  • This is server-rendered structure. JS-only state (open off-canvas menu,
    sticky-scroll classes) is NOT reflected here — use sydney/find-elements
    against the live page for content-specific elements.
REF;
		}
	}

endif;
