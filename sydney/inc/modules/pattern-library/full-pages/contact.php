<?php
/**
 * Contact Full pages
 *
 * Returns a list of Full page definitions. See get_full_pages() in
 * class-sydney-pattern-library.php for the format.
 *
 * @package Sydney
 */

return array(

	// Contact 1: a consulting firm's contact page, with no form. Page header, contact details and an email or call prompt.
	array(
		'name'       => 'sydney/full-page-contact-1',
		'title'      => __( 'Contact 1', 'sydney' ),
		'page_type'  => 'contact',
		'sydney_pro' => false,
		'sections'   => array(
			array(
				'pattern' => 'sydney/page-header-1',
				'scheme'  => 'grey',
			),
			array(
				'pattern' => 'sydney/contact-13',
				'scheme'  => 'white',
			),
			array(
				'pattern' => 'sydney/contact-14',
				'scheme'  => 'dark',
			),
		),
	),

	// Contact 2: a digital agency's contact page, with no form. Dark page header, contact details and an email sign-off.
	array(
		'name'       => 'sydney/full-page-contact-2',
		'title'      => __( 'Contact 2', 'sydney' ),
		'page_type'  => 'contact',
		'sydney_pro' => false,
		'sections'   => array(
			array(
				'pattern' => 'sydney/page-header-2',
				'scheme'  => 'dark',
			),
			array(
				'pattern' => 'sydney/contact-5',
				'scheme'  => 'white',
			),
			array(
				'pattern' => 'sydney/contact-12',
				'scheme'  => 'dark',
			),
		),
	),

	// Contact 3 (Pro): featured-image page header, a map with address, phone and hours, and three ways to get in touch. No form.
	array(
		'name'       => 'sydney-pro/full-page-contact-3',
		'title'      => __( 'Contact 3', 'sydney' ),
		'page_type'  => 'contact',
		'sydney_pro' => true,
		'sections'   => array(
			array(
				'pattern' => 'sydney-pro/page-header-4',
				'scheme'  => 'dark',
			),
			array(
				'pattern' => 'sydney-pro/contact-6',
				'scheme'  => 'grey',
			),
			array(
				'pattern' => 'sydney/contact-8',
				'scheme'  => 'white',
			),
		),
	),
);
