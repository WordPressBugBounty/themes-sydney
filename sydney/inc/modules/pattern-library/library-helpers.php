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
