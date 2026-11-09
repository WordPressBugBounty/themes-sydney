<?php
/**
 * Services Full pages
 *
 * Returns a list of Full page definitions. See get_full_pages() in
 * class-sydney-pattern-library.php for the format.
 *
 * @package Sydney
 */

return array(

	// Services 1: a consulting firm's services page. Page header, six services, proven results, client reviews and a call to action.
	array(
		'name'       => 'sydney/full-page-services-1',
		'title'      => __( 'Services 1', 'sydney' ),
		'page_type'  => 'services',
		'sydney_pro' => false,
		'sections'   => array(
			array(
				'pattern' => 'sydney/page-header-1',
				'scheme'  => 'grey',
			),
			array(
				'pattern' => 'sydney/services-22',
				'scheme'  => 'white',
			),
			array(
				'pattern' => 'sydney/stats-13',
				'scheme'  => 'dark',
			),
			array(
				'pattern' => 'sydney/testimonials-12',
				'scheme'  => 'grey',
			),
			array(
				'pattern' => 'sydney/cta-13',
				'scheme'  => 'white',
			),
		),
	),

	// Services 2: a digital agency's services page. Dark page header, core services, why choose us, numbers, client quotes and a photo call to action.
	array(
		'name'       => 'sydney/full-page-services-2',
		'title'      => __( 'Services 2', 'sydney' ),
		'page_type'  => 'services',
		'sydney_pro' => false,
		'sections'   => array(
			array(
				'pattern' => 'sydney/page-header-2',
				'scheme'  => 'dark',
			),
			array(
				'pattern' => 'sydney/services-6',
				'scheme'  => 'white',
			),
			array(
				'pattern' => 'sydney/features-1',
				'scheme'  => 'grey',
			),
			array(
				'pattern' => 'sydney/stats-2',
				'scheme'  => 'white',
			),
			array(
				'pattern' => 'sydney/testimonials-8',
				'scheme'  => 'grey',
			),
			array(
				'pattern' => 'sydney/cta-7',
				'scheme'  => 'dark',
			),
		),
	),

	// Services 3 (Pro): featured-image page header, services with photos, numbers on a photo, pricing plans, client reviews and a call to action.
	array(
		'name'       => 'sydney-pro/full-page-services-3',
		'title'      => __( 'Services 3', 'sydney' ),
		'page_type'  => 'services',
		'sydney_pro' => true,
		'sections'   => array(
			array(
				'pattern' => 'sydney-pro/page-header-4',
				'scheme'  => 'dark',
			),
			array(
				'pattern' => 'sydney-pro/services-3',
				'scheme'  => 'white',
			),
			array(
				'pattern' => 'sydney-pro/stats-4',
				'scheme'  => 'dark',
			),
			array(
				'pattern' => 'sydney-pro/pricing-1',
				'scheme'  => 'white',
			),
			array(
				'pattern' => 'sydney-pro/testimonials-14',
				'scheme'  => 'grey',
			),
			array(
				'pattern' => 'sydney-pro/cta-20',
				'scheme'  => 'white',
			),
		),
	),
);
