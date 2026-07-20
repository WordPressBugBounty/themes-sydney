<?php
/**
 * Shared post-type list for the auto-generated Customizer CPT panels.
 *
 * @package Sydney
 */

if ( ! function_exists( 'sydney_get_customizer_post_types' ) ) {
	/**
	 * Post types that should receive an auto-generated Customizer panel.
	 *
	 * Filters public post types by capability instead of by name: a type must be
	 * publicly viewable (`is_post_type_viewable()`) and expose an archive
	 * (`has_archive`, which may be a slug string). Types with their own dedicated
	 * panels or remapping (`post`, `page`, `product`, `attachment`) are always
	 * excluded here. The result is exposed through the `sydney_customizer_post_types`
	 * filter as an escape hatch.
	 *
	 * @since 2.70
	 *
	 * @return array Array of WP_Post_Type objects keyed by post-type name.
	 */
	function sydney_get_customizer_post_types() {
		static $post_types = null;

		if ( null !== $post_types ) {
			return $post_types;
		}

		$post_types = get_post_types( array( 'public' => true ), 'objects' );

		// Types that already have dedicated panels or remapped controls.
		$dedicated = array( 'post', 'page', 'product', 'attachment' );
		foreach ( $dedicated as $name ) {
			unset( $post_types[ $name ] );
		}

		foreach ( $post_types as $name => $post_type ) {
			if ( ! is_post_type_viewable( $post_type ) || ! $post_type->has_archive ) {
				unset( $post_types[ $name ] );
			}
		}

		/**
		 * Filters the post types that get an auto-generated Customizer panel.
		 *
		 * @since 2.70
		 *
		 * @param array $post_types Array of WP_Post_Type objects keyed by name.
		 */
		$post_types = apply_filters( 'sydney_customizer_post_types', $post_types );

		return $post_types;
	}
}
