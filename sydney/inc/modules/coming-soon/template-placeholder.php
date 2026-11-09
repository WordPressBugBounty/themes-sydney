<?php
/**
 * The Placeholder page on a blank canvas.
 *
 * No Sydney header, footer or post title, but wp_head(), wp_body_open() and
 * wp_footer() all run, so plugins, the Hooks module and Dark mode still apply.
 * Loaded by Sydney_Coming_Soon_Gate::maybe_render() after the main query was
 * swapped to the page.
 *
 * An Elementor page renders through the_content() too: Elementor's own content
 * filter swaps in the builder output. get_builder_content_for_display() would
 * return '' here, since it refuses the post being displayed.
 *
 * @package Sydney
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class( 'sydney-coming-soon' ); ?>>
<?php wp_body_open(); ?>
<main id="sydney-coming-soon">
	<?php
	while ( have_posts() ) :
		the_post();
		the_content();
	endwhile;
	?>
</main>
<?php $sydney_cs_login_url = Sydney_Coming_Soon_Gate::login_link_url(); ?>
<?php if ( '' !== $sydney_cs_login_url ) : ?>
	<a class="sydney-coming-soon-login" href="<?php echo esc_url( $sydney_cs_login_url ); ?>"><?php esc_html_e( 'Log in', 'sydney' ); ?></a>
<?php endif; ?>
<?php wp_footer(); ?>
</body>
</html>
