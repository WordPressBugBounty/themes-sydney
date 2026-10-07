<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Sydney
 */
?>
				<?php do_action( 'sydney_main_container_end' ); ?>
			</div>
		</div>
	</div><!-- #content -->

	<?php do_action('sydney_before_footer'); ?>

	<?php do_action( 'sydney_footer' ); ?>

	<?php do_action('sydney_after_footer'); ?>

</div><!-- #page -->

<?php do_action('sydney_after_site'); ?>

<?php wp_footer(); ?>

</body>
</html>
