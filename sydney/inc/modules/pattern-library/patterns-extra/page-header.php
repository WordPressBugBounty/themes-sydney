<?php
/**
 * Pro Page Header patterns
 *
 * Returns a list of pattern arrays. See README.md for the format.
 *
 * @package Sydney
 */

return array(

	// Page Header 4: the page title and a short intro on the featured image, under a dark overlay that also stands alone on a page without one.
	array(
		'name'       => 'sydney-pro/page-header-4',
		'title'      => __( 'Page Header 4', 'sydney' ),
		'categories' => array( 'sydney-page-header' ),
		'keywords'   => array( 'page header', 'title', 'intro', 'cover', 'featured image' ),
		'content'    => '<!-- wp:cover {"useFeaturedImage":true,"dimRatio":70,"overlayColor":"global_color_6","isUserOverlayColor":true,"minHeight":360,"minHeightUnit":"px","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--60);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--60);padding-left:var(--wp--preset--spacing--40);min-height:360px"><span aria-hidden="true" class="wp-block-cover__background has-global-color-6-background-color has-background-dim-70 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"640px"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:post-title {"textAlign":"center","level":1,"style":{"color":{"text":"#ffffff"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}}}} /-->

<!-- wp:paragraph {"align":"center","style":{"color":{"text":"#ffffffcc"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-align-center has-text-color" style="color:#ffffffcc;margin-top:0;margin-bottom:0">A closer look at what we do, how we work and why it matters to the people we serve.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover -->',
	),
);
