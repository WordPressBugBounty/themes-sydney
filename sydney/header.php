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
			$sydney_header_is_image = ( get_theme_mod( 'front_header_type', 'nothing' ) === 'image' && is_front_page() )
				|| ( get_theme_mod( 'site_header_type' ) === 'image' && ! is_front_page() );

			/**
			 * The shop fallback. Free can only reach it behind an image header, so
			 * the leading test keeps get_the_post_thumbnail_url() off every page
			 * that cannot use the answer.
			 */
			$sydney_shop_needs_header = ( sydney_is_pro() || $sydney_header_is_image )
				&& class_exists( 'Woocommerce' ) && is_shop()
				&& ! get_the_post_thumbnail_url( get_option( 'woocommerce_shop_page_id' ) );

			/**
			 * Pro shows the header image for any image header or on the shop
			 * fallback; free shows it only where both hold. Free defaults
			 * front_header_type to 'nothing' and Pro to 'slider', and neither
			 * equals 'image', so both terms are identical in the two editions and
			 * only the operator differs.
			 */
			$sydney_show_header_inner = sydney_is_pro()
				? ( $sydney_header_is_image || $sydney_shop_needs_header )
				: ( $sydney_header_is_image && $sydney_shop_needs_header );
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