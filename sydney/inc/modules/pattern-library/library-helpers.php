<?php
/**
 * Pattern Library helpers
 *
 * @package Sydney
 */

/**
 * Returns the ID of the first WPForms form found, or 1 as fallback.
 *
 * @return int
 */
function sydney_get_wpforms_form_id() {
	if ( ! function_exists( 'wpforms' ) ) {
		return 1;
	}

	$forms = get_posts(
		array(
			'post_type'      => 'wpforms',
			'posts_per_page' => 1,
			'post_status'    => 'publish',
			'fields'         => 'ids',
			'no_found_rows'  => true,
		)
	);

	if ( empty( $forms ) ) {
		return 1;
	}

	return (int) $forms[0];
}

/**
 * Returns the URL of an image bundled with the pattern library.
 *
 * @param string $file File name inside the pattern library images folder.
 * @return string
 */
function sydney_pattern_image_url( $file ) {
	return esc_url( get_template_directory_uri() . '/inc/modules/pattern-library/images/' . $file );
}
