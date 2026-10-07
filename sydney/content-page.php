<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Sydney
 */
?>
<?php $disable_title  = get_post_meta( $post->ID, '_sydney_page_disable_title', true ); ?>
<?php $enable_featured  = get_post_meta( $post->ID, '_sydney_page_enable_featured', true ); ?>
<?php $enable_featured_all  = get_theme_mod( 'enable_page_feat_images', 0 ); ?>
<?php $header_layout  = apply_filters( 'sydney_content_header_layout', 'layout1', 'page' ); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="content-inner">
		<?php if ( ! $disable_title && 'layout3' !== $header_layout && ! apply_filters( 'sydney_disable_page_title', false ) ) : ?>
		<header class="entry-header">
			<?php do_action( 'sydney_before_title' ); ?>
			<?php the_title( '<h1 class="title-post entry-title" ' . sydney_get_schema( "headline" ) . '>', '</h1>' ); ?>
		</header><!-- .entry-header -->
		<?php endif; ?>

		<?php if ( has_post_thumbnail() && ( $enable_featured || $enable_featured_all ) && 'layout1' === $header_layout ) : ?>
		<div class="entry-thumb">
			<?php the_post_thumbnail('sydney-large-thumb'); ?>
		</div>
		<?php endif; ?>	

		<?php do_action( 'sydney_before_page_entry_content' ); ?>

		<div class="entry-content" <?php sydney_do_schema( 'entry_content' ); ?>>
			<?php
				do_action( 'sydney_before_page_the_content' );

				the_content();

				do_action( 'sydney_after_page_the_content' );
			?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'sydney' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->

		<?php do_action( 'sydney_after_page_entry_content' ); ?>

		<footer class="entry-footer">
			<?php edit_post_link( __( 'Edit', 'sydney' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-footer -->
	</div>
</article><!-- #post-## -->
