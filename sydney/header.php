<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Sydney
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php sydney_do_schema( 'html' ); ?>>

<?php wp_body_open(); ?>

<span id="toptarget"></span>

<?php do_action('sydney_before_site'); //Hooked: sydney_preloader() ?>

<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'sydney' ); ?></a>

	<?php do_action('sydney_before_header'); //Hooked: sydney_header_clone() ?>	

	<?php do_action( 'sydney_header' ); ?>

	<?php
	/**
	 * Hook 'sydney_after_header'
	 *
	 * The header/footer builder fires this hook itself, from inside its device
	 * loop, and guards its own fire the same way. Without the guard here a site
	 * running the builder fires the hook twice and every listener runs twice.
	 *
	 * @since 1.0.0
	 */
	if ( ! did_action( 'sydney_after_header' ) ) {
		do_action( 'sydney_after_header' );
	}
	?>

	<div class="sydney-hero-area">
		<?php sydney_slider_template(); ?>
		<div class="header-image">
			<?php sydney_header_overlay(); ?>
			<?php
			// Same default as sydney_header_style(): a site that never ran the header upgrade and never saved a type has an image header.
			$sydney_header_is_image = ( get_theme_mod( 'front_header_type', 'nothing' ) === 'image' && is_front_page() )
				|| ( get_theme_mod( 'site_header_type', get_option( 'sydney-update-header' ) ? 'nothing' : 'image' ) === 'image' && ! is_front_page() );

			/**
			 * An image header renders the <img> that takes over from the background
			 * below 1024px, unless free's hero already shows a shop or category
			 * thumbnail. The shop page falls back to it when it has no thumbnail.
			 * Short-circuit keeps get_the_post_thumbnail_url() off non-shop pages.
			 */
			$sydney_show_header_inner = ( $sydney_header_is_image && ! sydney_hero_thumbnail_replaces_header_image() )
				|| (
					class_exists( 'Woocommerce' ) && is_shop()
					&& ! get_the_post_thumbnail_url( get_option( 'woocommerce_shop_page_id' ) )
				);
			?>
			<?php if ( $sydney_show_header_inner ) : ?>
				<img class="header-inner" src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('name'); ?>">
			<?php endif; ?>
		</div>
		<?php sydney_header_video(); ?>

		<?php do_action('sydney_inside_hero'); ?>
	</div>

	<?php do_action('sydney_after_hero'); ?>

	<?php
	/**
	 * Pro's extra header widget area. Both theme mods are registered in
	 * inc/pro/customizer/customizer.php and the sidebar in
	 * build/pro/functions.php, so the gate keeps free's path literally today's,
	 * including on a site downgraded from Pro.
	 */
	if ( sydney_is_pro() && is_active_sidebar( 'sidebar-header' ) && get_theme_mod( 'activate_bh_widgets' ) && ( ! is_front_page() || ( is_front_page() && ! get_theme_mod( 'hide_bh_widgets' ) ) ) ) : ?>
		<div class="header-widgets">
			<div class="container">
				<?php dynamic_sidebar( 'sidebar-header' ); ?>
			</div>
		</div>
	<?php endif; ?>

	<div id="content" class="page-wrap">
		<?php do_action( 'sydney_before_main_container_start' ); ?>
		<div class="content-wrapper <?php echo esc_attr( apply_filters( 'sydney_main_container', 'container' ) ); ?>">
			<div class="row">	
				<?php do_action( 'sydney_main_container_start' ); ?>