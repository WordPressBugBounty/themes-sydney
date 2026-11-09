<?php
/**
 * Coming Soon module: the front-end gate.
 *
 * Runs on template_redirect at priority 11 and exits there, rather than
 * filtering template_include: WooCommerce's own coming soon mode and the page
 * builders filter that later and would win. Priority 11 is after core's
 * redirect_canonical and the sitemap renderer (both at 10) and before
 * template-loader.php serves robots.txt, the favicon and feeds, which is why
 * those three are bypassed by hand.
 *
 * Order: bypass checks, headers, query swap, render, exit.
 *
 * @package Sydney
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Sydney_Coming_Soon_Gate' ) ) :

	/**
	 * Sydney_Coming_Soon_Gate class.
	 */
	class Sydney_Coming_Soon_Gate {

		/**
		 * Query arg that previews the Placeholder page as visitors get it.
		 */
		const PREVIEW_ARG = Sydney_Coming_Soon::PREVIEW_ARG;

		/**
		 * Query arg carrying a bypass token, see Sydney_Coming_Soon::create_bypass_token().
		 */
		const TOKEN_ARG = Sydney_Coming_Soon::TOKEN_ARG;

		/**
		 * Theme front-end UI that has no place on the blank canvas, removed from
		 * wp_body_open and wp_footer. Functions by name, methods as Class::method.
		 * woocommerce_demo_store is WooCommerce's store notice.
		 *
		 * Every Sydney callback on those two hooks must be listed here or in
		 * KEPT_CALLBACKS: ComingSoonBlankCanvasLeakGuardTest fails on one that
		 * is in neither.
		 */
		const STRIPPED_CALLBACKS = array(
			'sydney_preloader',
			'sydney_quick_view_popup',
			'sydney_append_gotop_html',
			'sydney_live_chat',
			'sydney_modal_popup',
			'sydney_reading_progress',
			'sydney_single_product_reviews_advanced_modal',
			'Sydney_Offcanvas_Content::offcanvas_content',
			'Sydney_Top_Bar::login_modal',
			'Sydney_Pro_Header::login_modal',
			'aThemes_Elementor_Login_Modal::login_modal',
			'woocommerce_demo_store',
		);

		/**
		 * Sydney callbacks on wp_body_open and wp_footer that stay: Pro's Hooks
		 * module prints what the site owner put there, and the gate's own late
		 * strip prints nothing.
		 */
		const KEPT_CALLBACKS = array(
			'Sydney_Customizer_Hooks::hook_wp_footer',
			'Sydney_Coming_Soon_Gate::strip_ui_callbacks',
		);

		/**
		 * Page being rendered, for the template and the canonical tag.
		 *
		 * @var int
		 */
		protected static $page_id = 0;

		/**
		 * Hook the gate.
		 */
		public static function init() {
			add_action( 'template_redirect', array( __CLASS__, 'maybe_render' ), 11 );
		}

		/**
		 * What this request gets.
		 *
		 * @return string 'pass' (untouched), 'real' (the real site, uncached), 'render' (the Placeholder page) or 'preview' (the Placeholder page for an editor).
		 */
		public static function decide() {
			if ( is_admin() || wp_doing_ajax() || wp_doing_cron() || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {
				return 'pass';
			}

			if ( self::is_preview_request() ) {
				return 'preview';
			}

			if ( 'off' === Sydney_Coming_Soon::get_mode() ) {
				return 'pass';
			}

			if ( self::is_always_reachable() || ! self::is_covered() ) {
				return 'pass';
			}

			if ( self::user_sees_real_site() ) {
				return 'real';
			}

			return 'render';
		}

		/**
		 * Serve the Placeholder page, or leave the request alone.
		 */
		public static function maybe_render() {
			$decision = self::decide();

			if ( 'pass' === $decision ) {
				return;
			}

			// The real site on a URL the mode covers must not be cached either,
			// or a cache would hand it to the next visitor.
			if ( 'real' === $decision ) {
				self::no_cache();

				return;
			}

			$preview = 'preview' === $decision;
			$mode    = $preview ? 'coming-soon' : Sydney_Coming_Soon::get_mode();
			$page_id = Sydney_Coming_Soon::get_render_page_id();

			if ( ! Sydney_Coming_Soon::page_is_valid( $page_id ) ) {
				self::render_fallback( $mode );
				exit;
			}

			self::send_headers( $mode );

			if ( isset( $_SERVER['REQUEST_METHOD'] ) && 'HEAD' === $_SERVER['REQUEST_METHOD'] ) {
				exit;
			}

			self::$page_id = $page_id;

			self::swap_query( $page_id );

			if ( $preview ) {
				add_filter( 'wp_robots', 'wp_robots_no_robots' );
			} else {
				self::seo_overrides( $mode, $page_id );
			}

			/**
			 * Fires before the Placeholder page renders, after the main query
			 * was swapped to it.
			 *
			 * @param string $mode    'coming-soon' or 'maintenance'.
			 * @param int    $page_id Placeholder page ID.
			 * @param bool   $preview Whether an editor is previewing it.
			 */
			do_action( 'sydney_coming_soon_before_render', $mode, $page_id, $preview );

			self::strip_ui_callbacks();

			// Anything that hooked itself in while the page rendered goes too.
			add_action( 'wp_footer', array( __CLASS__, 'strip_ui_callbacks' ), 0 );

			add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_page_assets' ), 20 );

			require __DIR__ . '/template-placeholder.php';

			exit;
		}

		/**
		 * Whether an editor asked to preview the Placeholder page.
		 *
		 * @return bool
		 */
		public static function is_preview_request() {
			return isset( $_GET[ self::PREVIEW_ARG ] ) && current_user_can( 'edit_pages' ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Read-only view switch, capability-checked.
		}

		/**
		 * Whether this request gets the real site while a mode is on.
		 *
		 * @return bool
		 */
		public static function user_sees_real_site() {
			if ( current_user_can( 'edit_pages' ) ) {
				return true;
			}

			// A contributor previewing their own post.
			if ( is_preview() && current_user_can( 'edit_post', get_queried_object_id() ) ) {
				return true;
			}

			// The theme's own loopback fetch, see Sydney_Coming_Soon::create_bypass_token().
			if ( isset( $_GET[ self::TOKEN_ARG ] ) && Sydney_Coming_Soon::verify_bypass_token( sanitize_text_field( wp_unslash( $_GET[ self::TOKEN_ARG ] ) ), self::request_path() ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- The token is its own signature.
				return true;
			}

			/**
			 * Filters whether this request gets the real site while a mode is on.
			 *
			 * @param bool $sees_real_site Default false.
			 */
			return (bool) apply_filters( 'sydney_coming_soon_user_sees_real_site', false );
		}

		/**
		 * Whether the mode applies to this URL.
		 *
		 * @return bool
		 */
		public static function is_covered() {
			/**
			 * Filters whether the Site mode covers the current URL.
			 *
			 * @param bool $covered Default true: every URL.
			 */
			return (bool) apply_filters( 'sydney_coming_soon_is_covered', true );
		}

		/**
		 * Requests that always get through: robots.txt, the favicon, feeds,
		 * /.well-known/, XML sitemaps, WooCommerce's wc-api and core's shortcut
		 * URLs to the admin and the login screen. wp-admin, wp-login.php,
		 * admin-ajax, the REST API and wp-cron never reach template_redirect.
		 *
		 * @return bool
		 */
		public static function is_always_reachable() {
			$reachable = false;
			$path      = self::request_path();

			if ( is_robots() || is_favicon() || is_feed() ) {
				$reachable = true;
			} elseif ( 0 === strpos( $path, '.well-known/' ) ) {
				$reachable = true;
			} elseif ( ! get_query_var( 'sitemap' ) && ! is_404() && preg_match( '/(^|\/)[^\/]*sitemap[^\/]*\.xml$|\.xsl$/i', $path ) ) {
				// Core and the SEO plugins that set the sitemap query var serve
				// their sitemaps and exit before the gate, so one that gets here
				// was refused: before WordPress 7.1.1 an unknown core sitemap is
				// not even a 404, and the main query is the blog index.

				$reachable = true;
			} elseif ( get_query_var( 'wc-api' ) ) {
				$reachable = true;
			} elseif ( is_404() && in_array( untrailingslashit( $path ), array( 'admin', 'dashboard', 'login', 'wp-admin', 'wp-login', 'wp-login.php' ), true ) ) {
				// Left to wp_redirect_admin_locations(), at template_redirect 1000.
				$reachable = true;
			}

			/**
			 * Filters whether the current request always gets through.
			 *
			 * @param bool   $reachable Whether the request is let through.
			 * @param string $path      Request path relative to the site root, no leading slash.
			 */
			return (bool) apply_filters( 'sydney_coming_soon_always_reachable', $reachable, $path );
		}

		/**
		 * The request path relative to the site's home path, without the
		 * leading slash or the query string, decoded so that a path with
		 * non-ASCII characters equals Sydney_Coming_Soon::token_path().
		 *
		 * @return string
		 */
		public static function request_path() {
			$uri  = isset( $_SERVER['REQUEST_URI'] ) ? esc_url_raw( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '';
			$path = (string) wp_parse_url( $uri, PHP_URL_PATH );
			$home = (string) wp_parse_url( home_url( '/' ), PHP_URL_PATH );

			if ( '' !== $home && 0 === strpos( $path, $home ) ) {
				$path = substr( $path, strlen( $home ) );
			}

			return rawurldecode( trim( $path, '/' ) );
		}

		/**
		 * No-cache headers plus DONOTCACHEPAGE for the page cache plugins.
		 */
		public static function no_cache() {
			nocache_headers();

			if ( ! defined( 'DONOTCACHEPAGE' ) ) {
				define( 'DONOTCACHEPAGE', true ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedConstantFound -- The cache plugins' shared constant.
			}
		}

		/**
		 * Status and cache headers for the Placeholder page. Coming Soon is a
		 * normal 200 on every URL, unknown ones included. Maintenance is a 503
		 * that tells crawlers to come back in an hour.
		 *
		 * @param string $mode 'coming-soon' or 'maintenance'.
		 */
		public static function send_headers( $mode ) {
			self::no_cache();

			if ( 'maintenance' === $mode ) {
				status_header( 503 );
				header( 'Retry-After: 3600' );

				return;
			}

			status_header( 200 );
		}

		/**
		 * Point the main query at the Placeholder page, so <head> describes it.
		 * Both globals are swapped, not query_posts(), so is_main_query() stays
		 * true for the SEO plugins. The explicit statuses let a draft or private
		 * page through for visitors.
		 *
		 * @param int $page_id Placeholder page ID.
		 */
		public static function swap_query( $page_id ) {
			$query = new WP_Query(
				array(
					'page_id'     => $page_id,
					'post_type'   => 'page',
					'post_status' => Sydney_Coming_Soon::PAGE_STATUSES,
				)
			);

			$GLOBALS['wp_query']     = $query; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited -- The query swap is the point.
			$GLOBALS['wp_the_query'] = $query; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited -- Kept identical to wp_query, as core keeps them.

			if ( ! empty( $query->post ) ) {
				$GLOBALS['post'] = $query->post; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited -- Follows the swapped query.
				setup_postdata( $query->post );
			}
		}

		/**
		 * Coming Soon is the site's public face for a while, so the canonical
		 * points at the home page and the SEO plugins are told to index it. Core
		 * prints no canonical for an unpublished page, so a draft or private
		 * page gets the tag printed here instead.
		 *
		 * @param string $mode    Site mode.
		 * @param int    $page_id Placeholder page ID.
		 */
		public static function seo_overrides( $mode, $page_id ) {
			if ( 'coming-soon' !== $mode ) {
				return;
			}

			/**
			 * Filters whether the Coming Soon SEO overrides apply to this response.
			 *
			 * @param bool $apply   Default true.
			 * @param int  $page_id Placeholder page ID.
			 */
			if ( ! apply_filters( 'sydney_coming_soon_seo_overrides', true, $page_id ) ) {
				return;
			}

			if ( 'publish' === get_post_status( $page_id ) ) {
				add_filter( 'get_canonical_url', array( __CLASS__, 'canonical_url' ) );
			} else {
				add_action( 'wp_head', array( __CLASS__, 'print_canonical' ) );
			}

			add_filter( 'wpseo_canonical', array( __CLASS__, 'canonical_url' ), 99 );
			add_filter( 'rank_math/frontend/canonical', array( __CLASS__, 'canonical_url' ), 99 );
			add_filter( 'aioseo_canonical_url', array( __CLASS__, 'canonical_url' ), 99 );
			add_filter( 'seopress_titles_canonical', array( __CLASS__, 'seopress_canonical' ), 99 );

			// A site that asks search engines to stay away keeps asking.
			if ( '1' === (string) get_option( 'blog_public' ) ) {
				add_filter( 'wpseo_robots', array( __CLASS__, 'yoast_robots' ), 99 );
				add_filter( 'rank_math/frontend/robots', array( __CLASS__, 'rank_math_robots' ), 99 );
				add_filter( 'aioseo_robots_meta', array( __CLASS__, 'drop_noindex' ), 99 );
			}
		}

		/**
		 * The home URL, for the canonical filters.
		 *
		 * @return string
		 */
		public static function canonical_url() {
			return home_url( '/' );
		}

		/**
		 * Canonical tag for an unpublished Placeholder page.
		 */
		public static function print_canonical() {
			echo '<link rel="canonical" href="' . esc_url( home_url( '/' ) ) . '" />' . "\n";
		}

		/**
		 * SEOPress filters the whole tag.
		 *
		 * @return string
		 */
		public static function seopress_canonical() {
			return '<link rel="canonical" href="' . esc_url( home_url( '/' ) ) . '" />';
		}

		/**
		 * Yoast robots value.
		 *
		 * @return string
		 */
		public static function yoast_robots() {
			return 'index, follow';
		}

		/**
		 * Rank Math robots directives.
		 *
		 * @param mixed $robots Directives.
		 * @return mixed
		 */
		public static function rank_math_robots( $robots ) {
			if ( ! is_array( $robots ) ) {
				return $robots;
			}

			$robots['index']  = 'index';
			$robots['follow'] = 'follow';

			return $robots;
		}

		/**
		 * Drop noindex and nofollow from a robots directive map.
		 *
		 * @param mixed $robots Directives.
		 * @return mixed
		 */
		public static function drop_noindex( $robots ) {
			if ( is_array( $robots ) ) {
				unset( $robots['noindex'], $robots['nofollow'] );
			}

			return $robots;
		}

		/**
		 * Remove the theme's front-end UI from wp_body_open and wp_footer.
		 */
		public static function strip_ui_callbacks() {
			global $wp_filter;

			foreach ( array( 'wp_body_open', 'wp_footer' ) as $hook ) {
				if ( empty( $wp_filter[ $hook ] ) || ! $wp_filter[ $hook ] instanceof WP_Hook ) {
					continue;
				}

				foreach ( $wp_filter[ $hook ]->callbacks as $priority => $callbacks ) {
					foreach ( $callbacks as $callback ) {
						if ( in_array( self::callback_name( $callback['function'] ), self::STRIPPED_CALLBACKS, true ) ) {
							remove_action( $hook, $callback['function'], $priority );
						}
					}
				}
			}
		}

		/**
		 * A callback as STRIPPED_CALLBACKS names it.
		 *
		 * @param mixed $callback Hook callback.
		 * @return string Function name, Class::method, or '' for a closure.
		 */
		public static function callback_name( $callback ) {
			if ( is_string( $callback ) ) {
				return $callback;
			}

			if ( is_array( $callback ) && 2 === count( $callback ) && is_string( $callback[1] ) ) {
				$class = is_object( $callback[0] ) ? get_class( $callback[0] ) : (string) $callback[0];

				return $class . '::' . $callback[1];
			}

			return '';
		}

		/**
		 * Canvas styles, plus the Elementor page's own CSS in <head>.
		 *
		 * Elementor decides in Frontend::init(), on the original URL's post,
		 * whether to load its styles, so the Placeholder page asks for them here.
		 */
		public static function enqueue_page_assets() {
			// The Log in link sits on whatever the design puts behind it, so it
			// carries its own dark pill rather than taking the design's colors.
			wp_add_inline_style( 'sydney-style-min', 'body.sydney-coming-soon{margin:0;padding:0}#sydney-coming-soon{min-height:100vh}body.sydney-coming-soon .sydney-coming-soon-login{position:fixed;bottom:16px;left:50%;z-index:99;transform:translateX(-50%);padding:6px 14px;border-radius:999px;background:rgba(0,0,0,.6);color:#fff;font-size:13px;line-height:1.4;text-decoration:none}body.sydney-coming-soon .sydney-coming-soon-login:hover,body.sydney-coming-soon .sydney-coming-soon-login:focus{background:rgba(0,0,0,.8);color:#fff}' );

			$page_id = self::$page_id;

			if ( ! $page_id || ! self::is_built_with_elementor( $page_id ) ) {
				return;
			}

			$elementor = \Elementor\Plugin::$instance;

			if ( isset( $elementor->frontend ) && method_exists( $elementor->frontend, 'enqueue_styles' ) ) {
				$elementor->frontend->enqueue_styles();
			}

			if ( class_exists( '\Elementor\Core\Files\CSS\Post' ) ) {
				\Elementor\Core\Files\CSS\Post::create( $page_id )->enqueue();
			}
		}

		/**
		 * Whether Elementor is active and built the page. Asks Elementor's
		 * documents API, which Sydney_Coming_Soon::is_elementor_page() does not:
		 * that one reads post meta and works while Elementor is inactive.
		 *
		 * @param int $page_id Page ID.
		 * @return bool
		 */
		public static function is_built_with_elementor( $page_id ) {
			if ( ! class_exists( '\Elementor\Plugin' ) || ! isset( \Elementor\Plugin::$instance->documents ) ) {
				return false;
			}

			$document = \Elementor\Plugin::$instance->documents->get( $page_id );

			return $document && $document->is_built_with_elementor();
		}

		/**
		 * Where the placeholder's Log in link points, '' for no link. Owners
		 * locked out of their own site rarely know /wp-admin. A logged-in user
		 * has nowhere to go, and a login URL a plugin moved off wp-login.php was
		 * hidden on purpose, so neither gets one.
		 *
		 * @return string
		 */
		public static function login_link_url() {
			if ( is_user_logged_in() ) {
				return '';
			}

			$url = wp_login_url( home_url( '/' ) );

			/**
			 * Filters whether the placeholder shows a Log in link.
			 *
			 * @param bool   $show Whether to show it.
			 * @param string $url  The login URL it points to.
			 */
			$show = apply_filters( 'sydney_coming_soon_login_link', false !== strpos( $url, 'wp-login.php' ), $url );

			return $show ? $url : '';
		}

		/**
		 * The page is gone while a mode is on: a minimal screen of the theme's
		 * own, so visitors never get the real site.
		 *
		 * @param string $mode Site mode.
		 */
		public static function render_fallback( $mode ) {
			self::send_headers( $mode );

			if ( isset( $_SERVER['REQUEST_METHOD'] ) && 'HEAD' === $_SERVER['REQUEST_METHOD'] ) {
				return;
			}

			$message = ( 'maintenance' === $mode ) ? __( 'Down for maintenance. Please check back soon.', 'sydney' ) : __( 'Coming soon.', 'sydney' );
			?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo esc_html( get_bloginfo( 'name' ) ); ?></title>
<style>body{margin:0;min-height:100vh;display:flex;align-items:center;justify-content:center;padding:24px;box-sizing:border-box;background:#fff;color:#1e1e1e;font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Helvetica,Arial,sans-serif;text-align:center}h1{margin:0 0 12px;font-size:32px;line-height:1.2}p{margin:0;font-size:18px;color:#555}.sydney-coming-soon-login{position:fixed;bottom:16px;left:50%;transform:translateX(-50%);font-size:14px;color:#555}</style>
</head>
<body>
<main id="sydney-coming-soon">
<h1><?php echo esc_html( get_bloginfo( 'name' ) ); ?></h1>
<p><?php echo esc_html( $message ); ?></p>
</main>
			<?php $login_url = self::login_link_url(); ?>
			<?php if ( '' !== $login_url ) : ?>
<a class="sydney-coming-soon-login" href="<?php echo esc_url( $login_url ); ?>"><?php esc_html_e( 'Log in', 'sydney' ); ?></a>
			<?php endif; ?>
</body>
</html>
			<?php
		}
	}

endif;
