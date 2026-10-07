<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Sydney
 */

$sydney_sidebar_id = apply_filters( 'sydney_sidebar_id', 'sidebar-1' );

if ( ! is_active_sidebar( $sydney_sidebar_id ) ) {
	return;
}
?>

<div id="secondary" class="widget-area col-md-3" role="complementary" <?php sydney_do_schema( 'sidebar' ); ?>>
	<?php do_action( 'sydney_sidebar_after_start' ); ?>
	<?php dynamic_sidebar( $sydney_sidebar_id ); ?>
	<?php do_action( 'sydney_sidebar_before_end' ); ?>
</div><!-- #secondary -->
