<?php
/**
 * Home Full pages
 *
 * Returns a list of Full page definitions. See get_full_pages() in
 * class-sydney-pattern-library.php for the format.
 *
 * @package Sydney
 */

return array(

	// Home 1: a consulting firm's home page. Photo hero, services, who we are, numbers, client quotes and a photo call to action.
	array(
		'name'       => 'sydney/full-page-home-1',
		'title'      => __( 'Home 1', 'sydney' ),
		'page_type'  => 'home',
		'sydney_pro' => false,
		'sections'   => array(
			array(
				'pattern' => 'sydney/hero-21',
				'scheme'  => 'dark',
			),
			array(
				'pattern' => 'sydney/services-20',
				'scheme'  => 'white',
			),
			array(
				'pattern' => 'sydney/about-13',
				'scheme'  => 'grey',
			),
			array(
				'pattern' => 'sydney/stats-14',
				'scheme'  => 'dark',
			),
			array(
				'pattern' => 'sydney/testimonials-10',
				'scheme'  => 'white',
			),
			array(
				'pattern' => 'sydney/cta-16',
				'scheme'  => 'dark',
			),
		),
	),

	// Home 2: a digital agency's home page. Photo hero, services, who we are, a photo client quote and a call to action.
	array(
		'name'       => 'sydney/full-page-home-2',
		'title'      => __( 'Home 2', 'sydney' ),
		'page_type'  => 'home',
		'sydney_pro' => false,
		'sections'   => array(
			array(
				'pattern' => 'sydney/hero-5',
				'scheme'  => 'dark',
			),
			array(
				'pattern' => 'sydney/services-2',
				'scheme'  => 'grey',
			),
			array(
				'pattern' => 'sydney/about-1',
				'scheme'  => 'white',
			),
			array(
				'pattern' => 'sydney/testimonials-7',
				'scheme'  => 'dark',
			),
			array(
				'pattern' => 'sydney/cta-1',
				'scheme'  => 'white',
			),
		),
	),

	// Home 3 (Pro): photo hero with a contact bar, photo feature cards, who we are, client results, a photo client quote and a call to action.
	array(
		'name'       => 'sydney-pro/full-page-home-3',
		'title'      => __( 'Home 3', 'sydney' ),
		'page_type'  => 'home',
		'sydney_pro' => true,
		'sections'   => array(
			array(
				'pattern' => 'sydney-pro/hero-8',
				'scheme'  => 'white',
			),
			array(
				'pattern' => 'sydney-pro/features-6',
				'scheme'  => 'grey',
			),
			array(
				'pattern' => 'sydney-pro/about-6',
				'scheme'  => 'white',
			),
			array(
				'pattern' => 'sydney-pro/stats-15',
				'scheme'  => 'grey',
			),
			array(
				'pattern' => 'sydney-pro/testimonials-16',
				'scheme'  => 'dark',
			),
			array(
				'pattern' => 'sydney-pro/cta-23',
				'scheme'  => 'white',
			),
		),
	),
);
