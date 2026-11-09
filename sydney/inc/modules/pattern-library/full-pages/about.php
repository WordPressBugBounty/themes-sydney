<?php
/**
 * About Full pages
 *
 * Returns a list of Full page definitions. See get_full_pages() in
 * class-sydney-pattern-library.php for the format.
 *
 * @package Sydney
 */

return array(

	// About 1: a consulting firm's about page. Page header, the firm's story, what it does, its values, client quotes and a call to action.
	array(
		'name'       => 'sydney/full-page-about-1',
		'title'      => __( 'About 1', 'sydney' ),
		'page_type'  => 'about',
		'sydney_pro' => false,
		'sections'   => array(
			array(
				'pattern' => 'sydney/page-header-1',
				'scheme'  => 'grey',
			),
			array(
				'pattern' => 'sydney/about-15',
				'scheme'  => 'white',
			),
			array(
				'pattern' => 'sydney/features-3',
				'scheme'  => 'grey',
			),
			array(
				'pattern' => 'sydney/about-14',
				'scheme'  => 'white',
			),
			array(
				'pattern' => 'sydney/testimonials-13',
				'scheme'  => 'grey',
			),
			array(
				'pattern' => 'sydney/cta-15',
				'scheme'  => 'dark',
			),
		),
	),

	// About 2: a digital agency's about page. Dark page header, who we are, numbers, the team, client reviews and a call to action.
	array(
		'name'       => 'sydney/full-page-about-2',
		'title'      => __( 'About 2', 'sydney' ),
		'page_type'  => 'about',
		'sydney_pro' => false,
		'sections'   => array(
			array(
				'pattern' => 'sydney/page-header-2',
				'scheme'  => 'dark',
			),
			array(
				'pattern' => 'sydney/about-5',
				'scheme'  => 'white',
			),
			array(
				'pattern' => 'sydney/about-7',
				'scheme'  => 'grey',
			),
			array(
				'pattern' => 'sydney/team-1',
				'scheme'  => 'white',
			),
			array(
				'pattern' => 'sydney/testimonials-2',
				'scheme'  => 'grey',
			),
			array(
				'pattern' => 'sydney/cta-17',
				'scheme'  => 'white',
			),
		),
	),

	// About 3 (Pro): featured-image page header, the story as a timeline, growth by year, the team, a client quote and a call to action.
	array(
		'name'       => 'sydney-pro/full-page-about-3',
		'title'      => __( 'About 3', 'sydney' ),
		'page_type'  => 'about',
		'sydney_pro' => true,
		'sections'   => array(
			array(
				'pattern' => 'sydney-pro/page-header-4',
				'scheme'  => 'dark',
			),
			array(
				'pattern' => 'sydney-pro/about-17',
				'scheme'  => 'white',
			),
			array(
				'pattern' => 'sydney-pro/stats-16',
				'scheme'  => 'grey',
			),
			array(
				'pattern' => 'sydney-pro/team-11',
				'scheme'  => 'white',
			),
			array(
				'pattern' => 'sydney-pro/testimonials-3',
				'scheme'  => 'grey',
			),
			array(
				'pattern' => 'sydney-pro/cta-8',
				'scheme'  => 'dark',
			),
		),
	),
);
