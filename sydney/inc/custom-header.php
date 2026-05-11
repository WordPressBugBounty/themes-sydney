<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * You can add an optional custom header image to header.php like so ...

	<?php if ( get_header_image() ) : ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
	</a>
	<?php endif; // End header image check. ?>

 *
 * @package Sydney
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses sydney_header_style()
 * @uses sydney_admin_header_style()
 * @uses sydney_admin_header_image()
 */
function sydney_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'sydney_custom_header_args', array(
		'default-image'          => get_template_directory_uri() . '/images/header.jpg',
		'default-text-color'     => '000000',
		'width'                  => 1920,
		'height'                 => 1080,
		'flex-height'            => true,
		'video'                  => true,
		'video-active-callback'  => '',
		'wp-head-callback'       => 'sydney_header_style',
		'admin-head-callback'    => 'sydney_admin_header_style',
		'admin-preview-callback' => 'sydney_admin_header_image',
	) ) );
}
add_action( 'after_setup_theme', 'sydney_custom_header_setup' );

/**
 * Video header settings
 */
function sydney_video_settings( $settings ) {
	$settings['l10n']['play']   = '';
	$settings['l10n']['pause']  = '';
	$settings['minWidth']       = '100';
	$settings['minHeight']      = '100';    
	
	return $settings;
}
add_filter( 'header_video_settings', 'sydney_video_settings' );

if ( ! function_exists( 'sydney_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see sydney_custom_header_setup().
 */
function sydney_header_style() {
    if ( !get_option( 'sydney-update-header' ) ) {
        $site_header = get_theme_mod('site_header_type','image');
    } else {
        $site_header = get_theme_mod('site_header_type','nothing');
    }

	if ( get_header_image() && ( get_theme_mod('front_header_type') === 'image' && is_front_page() || $site_header === 'image' && !is_front_page() ) ) {
	?>
	<style type="text/css">
		.header-image {
			background-image: url(<?php echo esc_url( get_header_image() ); ?>);
			display: block;
		}
		@media only screen and (max-width: 1024px) {
			.header-inner {
				display: block;
			}
			.header-image {
				background-image: none;
				height: auto !important;
			}
		}
	</style>
	<?php
	}

	// Hero YouTube placeholder: keep the header image visible when WP core's
	// wp-custom-header.js wipes the inner <img>, and lock the container's
	// aspect ratio so the height does not jump while the YouTube iframe
	// is inserted (intrinsic 1920x1080) before fitVids wraps it. Issue #346.
	$is_video_hero = ( get_theme_mod( 'front_header_type' ) === 'core-video' && is_front_page() )
		|| ( get_theme_mod( 'site_header_type' ) === 'core-video' && ! is_front_page() );

	if (
		$is_video_hero
		&& function_exists( 'is_header_video_active' )
		&& is_header_video_active()
		&& get_header_image()
	) {
		$video_settings = function_exists( 'get_header_video_settings' ) ? get_header_video_settings() : array();
		$mime_type      = isset( $video_settings['mimeType'] ) ? $video_settings['mimeType'] : '';

		if ( 'video/x-youtube' === $mime_type ) {
			$header_obj = function_exists( 'get_custom_header' ) ? get_custom_header() : null;
			$ratio_w    = ( $header_obj && ! empty( $header_obj->width ) ) ? (int) $header_obj->width : 1920;
			$ratio_h    = ( $header_obj && ! empty( $header_obj->height ) ) ? (int) $header_obj->height : 1080;
			?>
			<style type="text/css">
				.wp-custom-header {
					aspect-ratio: <?php echo (int) $ratio_w; ?> / <?php echo (int) $ratio_h; ?>;
					overflow: hidden;
					background-image: url("<?php echo esc_url( get_header_image() ); ?>");
					background-size: cover;
					background-position: center;
					background-repeat: no-repeat;
				}
				.wp-custom-header > img {
					display: none;
				}
				.wp-custom-header > iframe {
					display: block;
					width: 100%;
					height: 100%;
					border: 0;
					opacity: 0;
					animation: sydney-yth-fadein 0.6s ease 0.8s forwards;
				}
				@keyframes sydney-yth-fadein {
					to { opacity: 1; }
				}
			</style>
			<?php
		}
	}
}
endif; // sydney_header_style

if ( ! function_exists( 'sydney_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see sydney_custom_header_setup().
 */
function sydney_admin_header_style() {
?>
	<style type="text/css">
		.appearance_page_custom-header #headimg {
			border: none;
		}
		#headimg h1,
		#desc {
		}
		#headimg h1 {
		}
		#headimg h1 a {
		}
		#desc {
		}
		#headimg img {
		}
	</style>
<?php
}
endif; // sydney_admin_header_style

if ( ! function_exists( 'sydney_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see sydney_custom_header_setup().
 */
function sydney_admin_header_image() {
	$style = sprintf( ' style="color:#%s;"', esc_attr( get_header_textcolor() ) );
?>
	<div id="headimg">
		<h1 class="displaying-header-text"><a id="name"<?php echo $style; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<div class="displaying-header-text" id="desc"<?php echo $style; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>><?php bloginfo( 'description' ); ?></div>
		<?php if ( get_header_image() ) : ?>
		<img src="<?php header_image(); ?>" alt="">
		<?php endif; ?>
	</div>
<?php
}
endif; // sydney_admin_header_image