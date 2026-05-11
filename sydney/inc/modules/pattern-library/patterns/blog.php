<?php
/**
 * Blog patterns
 *
 * @package Sydney
 */


register_block_pattern(
	'sydney/blog-1',
	array(
		'title'      => __( 'Blog 1', 'sydney' ),
		'categories' => array( 'sydney-blog' ),
		'keywords'   => array( 'blog', 'agency', 'digital', 'news' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:group {"layout":{"type":"constrained","contentSize":"768px"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","fontSize":"12px","letterSpacing":"3px"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}}},"textColor":"global_color_5"} -->
<p class="has-text-align-center has-global-color-5-color has-text-color" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:12px;font-style:normal;font-weight:700;letter-spacing:3px;text-transform:uppercase">Our Blog</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<h2 class="wp-block-heading has-text-align-center" style="margin-top:0;margin-bottom:0">Insights, strategies, and industry trends.</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide" style="margin-top:var(--wp--preset--spacing--50)"><!-- wp:query {"queryId":1,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"align":"wide"} -->
<div class="wp-block-query alignwide"><!-- wp:post-template {"style":{"spacing":{"blockGap":"var:preset|spacing|50"}},"layout":{"type":"grid","columnCount":3}} -->
<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"16/9","sizeSlug":"large","style":{"border":{"radius":"8px"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} /-->

<!-- wp:post-terms {"term":"category","style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"600","letterSpacing":"0.1em"},"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|global_color_5"}}}},"textColor":"global_color_5","fontSize":"small"} /-->

<!-- wp:post-title {"level":4,"isLink":true,"style":{"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|global_color_4"}}},"typography":{"textDecoration":"none"}},"textColor":"global_color_4"} /-->

<!-- wp:post-excerpt {"moreText":"","showMoreOnNewLine":false,"excerptLength":25,"style":{"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}}}} /-->

<!-- wp:post-date {"metadata":{"bindings":{"datetime":{"source":"core/post-data","args":{"field":"date"}}}},"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}},"color":{"text":"#6d7685"}}} /-->
<!-- /wp:post-template --></div>
<!-- /wp:query --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/blog-2',
	array(
		'title'      => __( 'Blog 2', 'sydney' ),
		'categories' => array( 'sydney-blog' ),
		'keywords'   => array( 'blog', 'agency', 'digital', 'news' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_7","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-7-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|60"}}}} -->
<div class="wp-block-columns alignwide"><!-- wp:column {"width":"50%"} -->
<div class="wp-block-column" style="flex-basis:50%"><!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"left","verticalAlignment":"center"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","fontSize":"12px","letterSpacing":"3px"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}}},"textColor":"global_color_5"} -->
<p class="has-global-color-5-color has-text-color" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:12px;font-style:normal;font-weight:700;letter-spacing:3px;text-transform:uppercase">Our Blog</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}}}} -->
<h2 class="wp-block-heading" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30)">Latest from our blog</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|40"}}}} -->
<p style="margin-top:0;margin-bottom:var(--wp--preset--spacing--40);font-size:18px">Stay informed with industry insights, project updates, and expert advice from our team.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-buttons" style="margin-top:0;margin-bottom:0"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">View all posts</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"50%"} -->
<div class="wp-block-column" style="flex-basis:50%"><!-- wp:query {"queryId":23,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"metadata":{"categories":["posts"],"patternName":"core/query-medium-posts","name":"Image at left"}} -->
<div class="wp-block-query"><!-- wp:post-template {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}}} -->
<!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center" style="margin-top:0;margin-bottom:0"><!-- wp:column {"verticalAlignment":"center","width":"30%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:30%"><!-- wp:post-featured-image {"isLink":true,"aspectRatio":"1"} /--></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"50%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%"><!-- wp:post-title {"level":4,"isLink":true,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}},"elements":{"link":{"color":{"text":"var:preset|color|global_color_4"}}},"typography":{"textDecoration":"none"}},"textColor":"global_color_4"} /-->

<!-- wp:post-excerpt {"excerptLength":11} /--></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->
<!-- /wp:post-template --></div>
<!-- /wp:query --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->',
	)
);



register_block_pattern(
	'sydney/blog-3',
	array(
		'title'      => __( 'Blog 3', 'sydney' ),
		'categories' => array( 'sydney-blog' ),
		'keywords'   => array( 'blog', 'agency', 'digital', 'posts', 'grid' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:group {"layout":{"type":"constrained","contentSize":"768px"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"600","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}},"color":{"text":"var:preset|color|global_color_1"}},"textColor":"global_color_1"} -->
<p class="has-text-align-center has-global-color-1-color has-text-color" style="color:var(--wp--preset--color--global-color-1);margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:600;letter-spacing:0.1em;text-transform:uppercase">Our Blog</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<h2 class="wp-block-heading has-text-align-center" style="margin-top:0;margin-bottom:0">Insights, strategies, and industry trends.</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<p class="has-text-align-center" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0;font-size:18px">Practical advice and fresh perspectives from our team to help you navigate the digital landscape.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide" style="margin-top:var(--wp--preset--spacing--50)"><!-- wp:query {"queryId":1,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"align":"wide"} -->
<div class="wp-block-query alignwide"><!-- wp:post-template {"style":{"spacing":{"blockGap":"var:preset|spacing|50"}},"layout":{"type":"grid","columnCount":3}} -->
<!-- wp:post-featured-image {"isLink":true,"style":{"border":{"radius":"8px"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} /-->

<!-- wp:post-terms {"term":"category","style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"600","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|global_color_1"}}}},"textColor":"global_color_1"} /-->

<!-- wp:post-title {"level":4,"isLink":true,"style":{"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|global_color_4"}}},"typography":{"textDecoration":"none"}},"textColor":"global_color_4"} /-->

<!-- wp:post-excerpt {"moreText":"","showMoreOnNewLine":false,"excerptLength":25,"style":{"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}}}} /-->

<!-- wp:post-date {"metadata":{"bindings":{"datetime":{"source":"core/post-data","args":{"field":"date"}}}},"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}},"color":{"text":"#6d7685"}}} /-->
<!-- /wp:post-template --></div>
<!-- /wp:query --></div>
<!-- /wp:group -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50","bottom":"0"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--50);margin-bottom:0"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button">View All Posts</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></section>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/blog-4',
	array(
		'title'      => __( 'Blog 4', 'sydney' ),
		'categories' => array( 'sydney-blog' ),
		'keywords'   => array( 'blog', 'agency', 'digital', 'posts', 'cover' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_6","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-6-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)"><!-- wp:group {"layout":{"type":"constrained","contentSize":"768px"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"600","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}}},"textColor":"white"} -->
<p class="has-text-align-center has-white-color has-text-color" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:600;letter-spacing:0.1em;text-transform:uppercase">Our Blog</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffff"}}} -->
<h2 class="wp-block-heading has-text-align-center has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0">Insights, strategies, and industry trends.</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}},"color":{"text":"#dbdbdb"}}} -->
<p class="has-text-align-center has-text-color" style="color:#dbdbdb;margin-top:var(--wp--preset--spacing--30);margin-bottom:0;font-size:18px">Practical advice and fresh perspectives from our team to help you navigate the digital landscape.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide" style="margin-top:var(--wp--preset--spacing--50)"><!-- wp:query {"queryId":2,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"align":"wide"} -->
<div class="wp-block-query alignwide"><!-- wp:post-template {"style":{"spacing":{"blockGap":"var:preset|spacing|50"}},"layout":{"type":"grid","columnCount":3}} -->
<!-- wp:cover {"useFeaturedImage":true,"dimRatio":70,"overlayColor":"global_color_6","isUserOverlayColor":true,"minHeight":384,"minHeightUnit":"px","contentPosition":"bottom left","style":{"border":{"radius":"8px"},"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover has-custom-content-position is-position-bottom-left" style="border-radius:8px;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40);min-height:384px"><span aria-hidden="true" class="wp-block-cover__background has-global-color-6-background-color has-background-dim-70 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:post-terms {"term":"category","style":{"typography":{"textTransform":"uppercase","fontSize":"14px","fontStyle":"normal","fontWeight":"700"},"spacing":{"margin":{"top":"0","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|white"}}}},"textColor":"white"} /-->

<!-- wp:post-title {"level":4,"isLink":true,"style":{"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}},"elements":{"link":{"color":{"text":"#ffffff"}}},"typography":{"textDecoration":"none"},"color":{"text":"#ffffff"}}} /-->

<!-- wp:post-date {"metadata":{"bindings":{"datetime":{"source":"core/post-data","args":{"field":"date"}}}},"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}}},"textColor":"white"} /--></div></div>
<!-- /wp:cover -->
<!-- /wp:post-template --></div>
<!-- /wp:query --></div>
<!-- /wp:group -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"0"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:0"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button">View All Posts</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></section>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/blog-5',
	array(
		'title'      => __( 'Blog 5', 'sydney' ),
		'categories' => array( 'sydney-blog' ),
		'keywords'   => array( 'blog', 'agency', 'digital', 'posts', 'cards' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_7","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-7-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)"><!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
<div class="wp-block-group alignwide" style="margin-top:0;margin-bottom:0"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"672px","justifyContent":"left"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"600","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}},"color":{"text":"var:preset|color|global_color_1"}},"textColor":"global_color_1"} -->
<p class="has-global-color-1-color has-text-color" style="color:var(--wp--preset--color--global-color-1);margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:600;letter-spacing:0.1em;text-transform:uppercase">Our Blog</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<h2 class="wp-block-heading" style="margin-top:0;margin-bottom:0">Insights, strategies, and industry trends.</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-buttons" style="margin-top:0;margin-bottom:0"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button">View All Posts</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide" style="margin-top:var(--wp--preset--spacing--50)"><!-- wp:query {"queryId":4,"query":{"perPage":4,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"align":"wide"} -->
<div class="wp-block-query alignwide"><!-- wp:post-template {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"grid","columnCount":2}} -->
<!-- wp:group {"style":{"color":{"background":"#ffffff"},"border":{"radius":"8px","width":"1px"},"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"},"blockGap":"0"}},"borderColor":"global_color_8","layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group has-border-color has-global-color-8-border-color has-background" style="border-width:1px;border-radius:8px;background-color:#ffffff;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)"><!-- wp:post-terms {"term":"category","style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","fontSize":"14px","letterSpacing":"0em"},"spacing":{"margin":{"top":"0","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|global_color_1"}}}},"textColor":"global_color_1"} /-->

<!-- wp:post-title {"level":4,"isLink":true,"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}},"typography":{"textDecoration":"none","lineHeight":"1.2"},"layout":{"selfStretch":"fit","flexSize":null},"elements":{"link":{"color":{"text":"var:preset|color|global_color_4"}}}},"textColor":"global_color_4"} /-->

<!-- wp:post-excerpt {"moreText":"","showMoreOnNewLine":false,"excerptLength":12,"style":{"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}}}} /-->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"0"}},"layout":{"selfStretch":"fill","flexSize":null}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:0"><!-- wp:post-date {"metadata":{"bindings":{"datetime":{"source":"core/post-data","args":{"field":"date"}}}},"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#6d7685"},"layout":{"selfStretch":"fixed","flexSize":""}}} /-->

<!-- wp:read-more {"content":"Read More →","style":{"typography":{"fontSize":"14px","fontStyle":"normal","fontWeight":"600","textDecoration":"none"},"spacing":{"margin":{"top":"0","bottom":"0"}},"layout":{"selfStretch":"fill","flexSize":null}}} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<!-- /wp:post-template --></div>
<!-- /wp:query --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->',
	)
);


register_block_pattern(
	'sydney/blog-6',
	array(
		'title'      => __( 'Blog 6', 'sydney' ),
		'categories' => array( 'sydney-blog' ),
		'keywords'   => array( 'blog', 'professional-corporate' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_7","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-7-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)"><!-- wp:group {"layout":{"type":"constrained","contentSize":"768px"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"600","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}},"color":{"text":"var:preset|color|global_color_1"}},"textColor":"global_color_1"} -->
<p class="has-text-align-center has-global-color-1-color has-text-color" style="color:var(--wp--preset--color--global-color-1);margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:600;letter-spacing:0.1em;text-transform:uppercase">Latest Insights</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<h2 class="wp-block-heading has-text-align-center" style="margin-top:0;margin-bottom:0">Ideas That Drive Results</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide" style="margin-top:var(--wp--preset--spacing--50)"><!-- wp:query {"queryId":1,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"align":"wide"} -->
<div class="wp-block-query alignwide"><!-- wp:post-template {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"grid","columnCount":3}} -->
<!-- wp:group {"style":{"color":{"background":"#ffffff"},"border":{"radius":"8px","width":"1px"},"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"blockGap":"0"}},"borderColor":"global_color_8","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-border-color has-global-color-8-border-color has-background" style="border-width:1px;border-radius:8px;background-color:#ffffff;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:post-featured-image {"isLink":true,"aspectRatio":"16/9","sizeSlug":"large","style":{"border":{"radius":{"topLeft":"8px","topRight":"8px","bottomLeft":"0px","bottomRight":"0px"}},"spacing":{"margin":{"top":"0","bottom":"0"}}}} /-->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"blockGap":"0"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:post-terms {"term":"category","style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"600","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"top":"0","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|global_color_1"}}}},"textColor":"global_color_1"} /-->

<!-- wp:post-title {"level":4,"isLink":true,"style":{"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|global_color_6"}}},"typography":{"textDecoration":"none","lineHeight":"1.2"}},"textColor":"global_color_6"} /-->

<!-- wp:post-excerpt {"moreText":"","showMoreOnNewLine":false,"excerptLength":20,"style":{"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}}}} /-->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"0"},"blockGap":"var:preset|spacing|30"},"layout":{"selfStretch":"fill","flexSize":null}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"left","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:0"><!-- wp:post-date {"metadata":{"bindings":{"datetime":{"source":"core/post-data","args":{"field":"date"}}}},"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}},"layout":{"selfStretch":"fill","flexSize":null}},"textColor":"global_color_5"} /-->

<!-- wp:read-more {"content":"Read More →","style":{"typography":{"fontSize":"14px","fontStyle":"normal","fontWeight":"600","textDecoration":"none"},"spacing":{"margin":{"top":"0","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|global_color_1"}}},"layout":{"selfStretch":"fill","flexSize":null}}} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<!-- /wp:post-template --></div>
<!-- /wp:query --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/blog-7',
	array(
		'title'      => __( 'Blog 7', 'sydney' ),
		'categories' => array( 'sydney-blog' ),
		'keywords'   => array( 'blog', 'professional-corporate' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_9","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-9-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)"><!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|50"}}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
<div class="wp-block-group alignwide" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--50)"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"480px","justifyContent":"left"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"600","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}},"color":{"text":"var:preset|color|global_color_1"}},"textColor":"global_color_1"} -->
<p class="has-global-color-1-color has-text-color" style="color:var(--wp--preset--color--global-color-1);margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:600;letter-spacing:0.1em;text-transform:uppercase">From the Blog</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<h2 class="wp-block-heading" style="margin-top:0;margin-bottom:0">Recent Articles</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:read-more {"content":"View All Articles →","style":{"typography":{"fontSize":"14px","fontStyle":"normal","fontWeight":"600","textDecoration":"none"},"spacing":{"margin":{"top":"0","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|global_color_1"}}}}} /--></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"top":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide" style="margin-top:0"><!-- wp:query {"queryId":2,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"align":"wide"} -->
<div class="wp-block-query alignwide"><!-- wp:post-template {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"grid","columnCount":3}} -->
<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"16/9","sizeSlug":"large","style":{"border":{"radius":"8px"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}}}} /-->

<!-- wp:post-title {"level":4,"isLink":true,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|20"}},"elements":{"link":{"color":{"text":"var:preset|color|global_color_6"}}},"typography":{"textDecoration":"none","lineHeight":"1.2"}},"textColor":"global_color_6"} /-->

<!-- wp:post-date {"metadata":{"bindings":{"datetime":{"source":"core/post-data","args":{"field":"date"}}}},"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#6d7685"}}} /-->
<!-- /wp:post-template --></div>
<!-- /wp:query --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/blog-8',
	array(
		'title'      => __( 'Blog 8', 'sydney' ),
		'categories' => array( 'sydney-blog' ),
		'keywords'   => array( 'blog', 'professional-corporate' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_9","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-9-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)"><!-- wp:group {"layout":{"type":"constrained","contentSize":"768px"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"600","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}},"color":{"text":"var:preset|color|global_color_1"}},"textColor":"global_color_1"} -->
<p class="has-text-align-center has-global-color-1-color has-text-color" style="color:var(--wp--preset--color--global-color-1);margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:600;letter-spacing:0.1em;text-transform:uppercase">Featured Insights</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<h2 class="wp-block-heading has-text-align-center" style="margin-top:0;margin-bottom:0">What We&#39;re Thinking</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:columns {"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|50","bottom":"0"},"blockGap":{"left":"var:preset|spacing|50"}}}} -->
<div class="wp-block-columns alignwide" style="margin-top:var(--wp--preset--spacing--50);margin-bottom:0"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:query {"queryId":3,"query":{"perPage":1,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false}} -->
<div class="wp-block-query"><!-- wp:post-template {"style":{"spacing":{"blockGap":"0"}}} -->
<!-- wp:post-featured-image {"isLink":true,"style":{"border":{"radius":"8px"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|40"}}}} /-->

<!-- wp:post-terms {"term":"category","style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"600","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"top":"0","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|global_color_1"}}}},"textColor":"global_color_1"} /-->

<!-- wp:post-title {"level":3,"isLink":true,"style":{"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|global_color_6"}}},"typography":{"textDecoration":"none"}},"textColor":"global_color_6"} /-->

<!-- wp:post-excerpt {"moreText":"","showMoreOnNewLine":false,"excerptLength":30,"style":{"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}}}} /-->

<!-- wp:post-date {"metadata":{"bindings":{"datetime":{"source":"core/post-data","args":{"field":"date"}}}},"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}},"color":{"text":"#6d7685"}}} /-->
<!-- /wp:post-template --></div>
<!-- /wp:query --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:query {"queryId":4,"query":{"perPage":2,"pages":0,"offset":1,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false}} -->
<div class="wp-block-query"><!-- wp:post-template {"style":{"spacing":{"blockGap":"var:preset|spacing|50"}}} -->
<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
<div class="wp-block-group"><!-- wp:post-featured-image {"isLink":true,"width":"192px","height":"144px","style":{"border":{"radius":"8px"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} /-->

<!-- wp:group {"style":{"spacing":{"blockGap":"0","padding":{"left":"var:preset|spacing|30"}}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group" style="padding-left:var(--wp--preset--spacing--30)"><!-- wp:post-terms {"term":"category","style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"600","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"top":"0","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|global_color_1"}}}},"textColor":"global_color_1"} /-->

<!-- wp:post-title {"level":4,"isLink":true,"style":{"spacing":{"margin":{"top":"var:preset|spacing|10","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|global_color_6"}}},"typography":{"textDecoration":"none"}},"textColor":"global_color_6"} /-->

<!-- wp:post-excerpt {"moreText":"","showMoreOnNewLine":false,"excerptLength":15,"style":{"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}},"typography":{"fontSize":"14px"}}} /-->

<!-- wp:post-date {"metadata":{"bindings":{"datetime":{"source":"core/post-data","args":{"field":"date"}}}},"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}},"color":{"text":"#6d7685"}}} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<!-- /wp:post-template --></div>
<!-- /wp:query --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->',
	)
);
