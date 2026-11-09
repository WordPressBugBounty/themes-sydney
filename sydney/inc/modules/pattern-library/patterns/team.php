<?php
/**
 * Team patterns
 *
 * @package Sydney
 */

register_block_pattern(
	'sydney/team-1',
	array(
		'title'      => __( 'Team 1', 'sydney' ),
		'categories' => array( 'sydney-team' ),
		'keywords'   => array( 'team', 'agency', 'digital', 'columns', 'grid' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_9","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-9-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)"><!-- wp:group {"layout":{"type":"constrained","contentSize":"768px"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"600","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}},"color":{"text":"var:preset|color|global_color_1"}},"textColor":"global_color_1"} -->
<p class="has-text-align-center has-global-color-1-color has-text-color" style="color:var(--wp--preset--color--global-color-1);margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:600;letter-spacing:0.1em;text-transform:uppercase">Our Team</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<h2 class="wp-block-heading has-text-align-center" style="margin-top:0;margin-bottom:0">The people behind every pixel and strategy.</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<p class="has-text-align-center" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0;font-size:18px">A tight-knit crew of designers, developers, and strategists who live and breathe digital. We bring diverse skills and a shared obsession with quality.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|50","left":"var:preset|spacing|50"},"margin":{"top":"var:preset|spacing|50","bottom":"0"}}}} -->
<div class="wp-block-columns alignwide" style="margin-top:var(--wp--preset--spacing--50);margin-bottom:0"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center","flexWrap":"wrap"}} -->
<div class="wp-block-group"><!-- wp:image {"sizeSlug":"large","linkDestination":"none","style":{"border":{"radius":"8px"},"spacing":{"margin":{"top":"0","bottom":"0"}},"layout":{"selfStretch":"fit","flexSize":null}}} -->
<figure class="wp-block-image size-large has-custom-border" style="margin-top:0;margin-bottom:0"><img src="' . sydney_pattern_image_url( 'portrait-man-1.webp' ) . '" alt="James Thornton" style="border-radius:8px"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"textAlign":"center","level":4,"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<h4 class="wp-block-heading has-text-align-center" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">James Thornton</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"none"},"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|global_color_5"}}}},"textColor":"global_color_5"} -->
<p class="has-text-align-center has-global-color-5-color has-text-color has-link-color" style="margin-top:var(--wp--preset--spacing--20);margin-bottom:0;text-transform:none">Founder &amp; CEO</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}}}} -->
<p class="has-text-align-center" style="margin-top:var(--wp--preset--spacing--20);margin-bottom:0">Visionary leader with 15 years in digital, guiding strategy and client partnerships.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
<div class="wp-block-group"><!-- wp:image {"sizeSlug":"large","linkDestination":"none","style":{"border":{"radius":"8px"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-large has-custom-border" style="margin-top:0;margin-bottom:0"><img src="' . sydney_pattern_image_url( 'portrait-woman-1.webp' ) . '" alt="Elena Vasquez" style="border-radius:8px"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"textAlign":"center","level":4,"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<h4 class="wp-block-heading has-text-align-center" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">Elena Vasquez</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"none"},"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|global_color_5"}}}},"textColor":"global_color_5"} -->
<p class="has-text-align-center has-global-color-5-color has-text-color has-link-color" style="margin-top:var(--wp--preset--spacing--20);margin-bottom:0;text-transform:none">Creative Director</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}}}} -->
<p class="has-text-align-center" style="margin-top:var(--wp--preset--spacing--20);margin-bottom:0">Shapes every visual detail, from brand identity systems to immersive web experiences.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
<div class="wp-block-group"><!-- wp:image {"sizeSlug":"large","linkDestination":"none","style":{"border":{"radius":"8px"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-large has-custom-border" style="margin-top:0;margin-bottom:0"><img src="' . sydney_pattern_image_url( 'portrait-man-2.webp' ) . '" alt="David Kim" style="border-radius:8px"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"textAlign":"center","level":4,"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<h4 class="wp-block-heading has-text-align-center" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">David Kim</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"none"},"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|global_color_5"}}}},"textColor":"global_color_5"} -->
<p class="has-text-align-center has-global-color-5-color has-text-color has-link-color" style="margin-top:var(--wp--preset--spacing--20);margin-bottom:0;text-transform:none">Lead Developer</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}}}} -->
<p class="has-text-align-center" style="margin-top:var(--wp--preset--spacing--20);margin-bottom:0">Full-stack engineer who architects clean, scalable code for complex digital products.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/team-2',
	array(
		'title'      => __( 'Team 2', 'sydney' ),
		'categories' => array( 'sydney-team' ),
		'keywords'   => array( 'team', 'agency', 'digital', 'cards', 'columns' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_9","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-9-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:group {"align":"wide","layout":{"type":"constrained","contentSize":"","justifyContent":"left"}} -->
<div class="wp-block-group alignwide"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"600","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}},"color":{"text":"var:preset|color|global_color_1"}},"textColor":"global_color_1"} -->
<p class="has-global-color-1-color has-text-color" style="color:var(--wp--preset--color--global-color-1);margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:600;letter-spacing:0.1em;text-transform:uppercase">Our Team</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<h2 class="wp-block-heading" style="margin-top:0;margin-bottom:0">The people behind every pixel and strategy.</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<p style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0;font-size:18px">A tight-knit crew of designers, developers, and strategists who live and breathe digital. We bring diverse skills and a shared obsession with quality.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|50","left":"var:preset|spacing|50"},"margin":{"top":"var:preset|spacing|50","bottom":"0"}}}} -->
<div class="wp-block-columns alignwide" style="margin-top:var(--wp--preset--spacing--50);margin-bottom:0"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"border":{"radius":"8px"},"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"blockGap":"0"}},"backgroundColor":"global_color_7","layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group has-global-color-7-background-color has-background" style="border-radius:8px;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:image {"width":"128px","height":"128px","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":{"topLeft":"50%","topRight":"50%","bottomLeft":"50%","bottomRight":"50%"}},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border" style="margin-top:0;margin-bottom:0"><img src="' . sydney_pattern_image_url( 'portrait-man-1.webp' ) . '" alt="James Thornton" style="border-top-left-radius:50%;border-top-right-radius:50%;border-bottom-left-radius:50%;border-bottom-right-radius:50%;width:128px;height:128px"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<h4 class="wp-block-heading" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">James Thornton</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"textTransform":"none"},"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|global_color_5"}}}},"textColor":"global_color_5"} -->
<p class="has-global-color-5-color has-text-color has-link-color" style="margin-top:var(--wp--preset--spacing--20);margin-bottom:0;text-transform:none">Founder &amp; CEO</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}}}} -->
<p style="margin-top:var(--wp--preset--spacing--20);margin-bottom:0">Visionary leader with 15 years in digital, guiding strategy and client partnerships.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"border":{"radius":"8px"},"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"blockGap":"0"}},"backgroundColor":"global_color_7","layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group has-global-color-7-background-color has-background" style="border-radius:8px;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:image {"width":"128px","height":"128px","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":{"topLeft":"50%","topRight":"50%","bottomLeft":"50%","bottomRight":"50%"}},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border" style="margin-top:0;margin-bottom:0"><img src="' . sydney_pattern_image_url( 'portrait-woman-1.webp' ) . '" alt="Elena Vasquez" style="border-top-left-radius:50%;border-top-right-radius:50%;border-bottom-left-radius:50%;border-bottom-right-radius:50%;width:128px;height:128px"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<h4 class="wp-block-heading" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">Elena Vasquez</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"textTransform":"none"},"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|global_color_5"}}}},"textColor":"global_color_5"} -->
<p class="has-global-color-5-color has-text-color has-link-color" style="margin-top:var(--wp--preset--spacing--20);margin-bottom:0;text-transform:none">Creative Director</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}}}} -->
<p style="margin-top:var(--wp--preset--spacing--20);margin-bottom:0">Shapes every visual detail, from brand identity systems to immersive web experiences.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"border":{"radius":"8px"},"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"blockGap":"0"}},"backgroundColor":"global_color_7","layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group has-global-color-7-background-color has-background" style="border-radius:8px;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:image {"width":"128px","height":"128px","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":{"topLeft":"50%","topRight":"50%","bottomLeft":"50%","bottomRight":"50%"}},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border" style="margin-top:0;margin-bottom:0"><img src="' . sydney_pattern_image_url( 'portrait-man-2.webp' ) . '" alt="David Kim" style="border-top-left-radius:50%;border-top-right-radius:50%;border-bottom-left-radius:50%;border-bottom-right-radius:50%;width:128px;height:128px"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<h4 class="wp-block-heading" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">David Kim</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"textTransform":"none"},"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|global_color_5"}}}},"textColor":"global_color_5"} -->
<p class="has-global-color-5-color has-text-color has-link-color" style="margin-top:var(--wp--preset--spacing--20);margin-bottom:0;text-transform:none">Lead Developer</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}}}} -->
<p style="margin-top:var(--wp--preset--spacing--20);margin-bottom:0">Full-stack engineer who architects clean, scalable code for complex digital products.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/team-3',
	array(
		'title'      => __( 'Team 3', 'sydney' ),
		'categories' => array( 'sydney-team' ),
		'keywords'   => array( 'team', 'agency', 'digital', 'columns' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_9","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-9-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)"><!-- wp:group {"layout":{"type":"constrained","contentSize":"768px"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"600","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}}}} -->
<p class="has-text-align-center" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:600;letter-spacing:0.1em;text-transform:uppercase">Our Team</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<h2 class="wp-block-heading has-text-align-center" style="margin-top:0;margin-bottom:0">The people behind every pixel and strategy.</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}},"color":{"text":"var:preset|color|global_color_5"}}} -->
<p class="has-text-align-center has-text-color" style="color:var(--wp--preset--color--global-color-5);margin-top:var(--wp--preset--spacing--30);margin-bottom:0;font-size:18px">A tight-knit crew of designers, developers, and strategists who live and breathe digital. We bring diverse skills and a shared obsession with quality.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|40","left":"var:preset|spacing|50"},"margin":{"top":"var:preset|spacing|50","bottom":"0"}}}} -->
<div class="wp-block-columns alignwide" style="margin-top:var(--wp--preset--spacing--50);margin-bottom:0"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
<div class="wp-block-group"><!-- wp:image {"sizeSlug":"large","linkDestination":"none","style":{"border":{"radius":"8px"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-large has-custom-border" style="margin-top:0;margin-bottom:0"><img src="' . sydney_pattern_image_url( 'portrait-man-1.webp' ) . '" alt="James Thornton" style="border-radius:8px"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"textAlign":"center","level":4,"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<h4 class="wp-block-heading has-text-align-center" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">James Thornton</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"none"},"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|global_color_4"}}}}} -->
<p class="has-text-align-center has-link-color" style="margin-top:var(--wp--preset--spacing--20);margin-bottom:0;text-transform:none">Founder &amp; CEO</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}},"color":{"text":"var:preset|color|global_color_5"}}} -->
<p class="has-text-align-center has-text-color" style="color:var(--wp--preset--color--global-color-5);margin-top:var(--wp--preset--spacing--20);margin-bottom:0">Visionary leader with 15 years in digital, guiding strategy and client partnerships.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
<div class="wp-block-group"><!-- wp:image {"sizeSlug":"large","linkDestination":"none","style":{"border":{"radius":"8px"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-large has-custom-border" style="margin-top:0;margin-bottom:0"><img src="' . sydney_pattern_image_url( 'portrait-man-2.webp' ) . '" alt="David Vasquez" style="border-radius:8px"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"textAlign":"center","level":4,"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<h4 class="wp-block-heading has-text-align-center" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">David Vasquez</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"none"},"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|global_color_4"}}}}} -->
<p class="has-text-align-center has-link-color" style="margin-top:var(--wp--preset--spacing--20);margin-bottom:0;text-transform:none">Creative Director</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}},"color":{"text":"var:preset|color|global_color_5"}}} -->
<p class="has-text-align-center has-text-color" style="color:var(--wp--preset--color--global-color-5);margin-top:var(--wp--preset--spacing--20);margin-bottom:0">Shapes every visual detail, from brand identity systems to immersive web experiences.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
<div class="wp-block-group"><!-- wp:image {"sizeSlug":"large","linkDestination":"none","style":{"border":{"radius":"8px"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-large has-custom-border" style="margin-top:0;margin-bottom:0"><img src="' . sydney_pattern_image_url( 'portrait-woman-1.webp' ) . '" alt="Elena Kim" style="border-radius:8px"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"textAlign":"center","level":4,"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<h4 class="wp-block-heading has-text-align-center" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">Elena Kim</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"none"},"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|global_color_4"}}}}} -->
<p class="has-text-align-center has-link-color" style="margin-top:var(--wp--preset--spacing--20);margin-bottom:0;text-transform:none">Lead Developer</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}},"color":{"text":"var:preset|color|global_color_5"}}} -->
<p class="has-text-align-center has-text-color" style="color:var(--wp--preset--color--global-color-5);margin-top:var(--wp--preset--spacing--20);margin-bottom:0">Full-stack engineer who architects clean, scalable code for complex digital products.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
<div class="wp-block-group"><!-- wp:image {"sizeSlug":"large","linkDestination":"none","style":{"border":{"radius":"8px"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-large has-custom-border" style="margin-top:0;margin-bottom:0"><img src="' . sydney_pattern_image_url( 'portrait-man-3.webp' ) . '" alt="Peter Mitchell" style="border-radius:8px"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"textAlign":"center","level":4,"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<h4 class="wp-block-heading has-text-align-center" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">Peter Mitchell</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"none"},"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|global_color_4"}}}}} -->
<p class="has-text-align-center has-link-color" style="margin-top:var(--wp--preset--spacing--20);margin-bottom:0;text-transform:none">Marketing Strategist</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}},"color":{"text":"var:preset|color|global_color_5"}}} -->
<p class="has-text-align-center has-text-color" style="color:var(--wp--preset--color--global-color-5);margin-top:var(--wp--preset--spacing--20);margin-bottom:0">Turns data into growth plans, running campaigns that consistently outperforms.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/team-5',
	array(
		'title'      => __( 'Team 5', 'sydney' ),
		'categories' => array( 'sydney-team' ),
		'keywords'   => array( 'team', 'agency', 'digital', 'circular', 'avatars' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_9","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-9-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)"><!-- wp:group {"layout":{"type":"constrained","contentSize":"768px"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"600","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}},"color":{"text":"var:preset|color|global_color_1"}},"textColor":"global_color_1"} -->
<p class="has-text-align-center has-global-color-1-color has-text-color" style="color:var(--wp--preset--color--global-color-1);margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:600;letter-spacing:0.1em;text-transform:uppercase">Our Team</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<h2 class="wp-block-heading has-text-align-center" style="margin-top:0;margin-bottom:0">The people behind every pixel and strategy.</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<p class="has-text-align-center" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0;font-size:18px">A tight-knit crew of designers, developers, and strategists who live and breathe digital. We bring diverse skills and a shared obsession with quality.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|50","left":"var:preset|spacing|50"},"margin":{"top":"var:preset|spacing|50","bottom":"0"}}}} -->
<div class="wp-block-columns alignwide" style="margin-top:var(--wp--preset--spacing--50);margin-bottom:0"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
<div class="wp-block-group"><!-- wp:image {"width":"128px","height":"128px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"border":{"radius":"50%"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border" style="margin-top:0;margin-bottom:0"><img src="' . sydney_pattern_image_url( 'portrait-man-1.webp' ) . '" alt="James Thornton" style="border-radius:50%;width:128px;height:128px"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"textAlign":"center","level":4,"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<h4 class="wp-block-heading has-text-align-center" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">James Thornton</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"none"},"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|global_color_5"}}}},"textColor":"global_color_5"} -->
<p class="has-text-align-center has-global-color-5-color has-text-color has-link-color" style="margin-top:var(--wp--preset--spacing--20);margin-bottom:0;text-transform:none">Founder &amp; CEO</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}}}} -->
<p class="has-text-align-center" style="margin-top:var(--wp--preset--spacing--20);margin-bottom:0">Visionary leader with 15 years in digital, guiding strategy and client partnerships.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
<div class="wp-block-group"><!-- wp:image {"width":"128px","height":"128px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"border":{"radius":"50%"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border" style="margin-top:0;margin-bottom:0"><img src="' . sydney_pattern_image_url( 'portrait-woman-1.webp' ) . '" alt="Elena Vasquez" style="border-radius:50%;width:128px;height:128px"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"textAlign":"center","level":4,"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<h4 class="wp-block-heading has-text-align-center" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">Elena Vasquez</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"none"},"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|global_color_5"}}}},"textColor":"global_color_5"} -->
<p class="has-text-align-center has-global-color-5-color has-text-color has-link-color" style="margin-top:var(--wp--preset--spacing--20);margin-bottom:0;text-transform:none">Creative Director</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}}}} -->
<p class="has-text-align-center" style="margin-top:var(--wp--preset--spacing--20);margin-bottom:0">Shapes every visual detail, from brand identity systems to immersive web experiences.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
<div class="wp-block-group"><!-- wp:image {"width":"128px","height":"128px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"border":{"radius":"50%"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border" style="margin-top:0;margin-bottom:0"><img src="' . sydney_pattern_image_url( 'portrait-man-2.webp' ) . '" alt="David Kim" style="border-radius:50%;width:128px;height:128px"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"textAlign":"center","level":4,"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<h4 class="wp-block-heading has-text-align-center" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">David Kim</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"none"},"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|global_color_5"}}}},"textColor":"global_color_5"} -->
<p class="has-text-align-center has-global-color-5-color has-text-color has-link-color" style="margin-top:var(--wp--preset--spacing--20);margin-bottom:0;text-transform:none">Lead Developer</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}}}} -->
<p class="has-text-align-center" style="margin-top:var(--wp--preset--spacing--20);margin-bottom:0">Full-stack engineer who architects clean, scalable code for complex digital products.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/team-6',
	array(
		'title'      => __( 'Team 6', 'sydney' ),
		'categories' => array( 'sydney-team' ),
		'keywords'   => array( 'team', 'agency', 'digital', 'photo', 'cards' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_9","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-9-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:group {"layout":{"type":"constrained","contentSize":"768px"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"600","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}},"color":{"text":"var:preset|color|global_color_1"}},"textColor":"global_color_1"} -->
<p class="has-text-align-center has-global-color-1-color has-text-color" style="color:var(--wp--preset--color--global-color-1);margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:600;letter-spacing:0.1em;text-transform:uppercase">Our Team</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<h2 class="wp-block-heading has-text-align-center" style="margin-top:0;margin-bottom:0">The people behind every pixel and strategy.</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<p class="has-text-align-center" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0;font-size:18px">A tight-knit crew of designers, developers, and strategists who live and breathe digital. We bring diverse skills and a shared obsession with quality.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:image {"aspectRatio":"16/9","scale":"cover","sizeSlug":"full","linkDestination":"none","align":"wide","style":{"border":{"radius":"8px"},"spacing":{"margin":{"top":"var:preset|spacing|50","bottom":"0"}}}} -->
<figure class="wp-block-image alignwide size-full has-custom-border" style="margin-top:var(--wp--preset--spacing--50);margin-bottom:0"><img src="' . sydney_pattern_image_url( 'scene-large-3.webp' ) . '" alt="Person reviewing a chart with a pen next to a laptop" style="border-radius:8px;aspect-ratio:16/9;object-fit:cover"/></figure>
<!-- /wp:image -->

<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|40","left":"var:preset|spacing|40"},"margin":{"top":"var:preset|spacing|40","bottom":"0"}}}} -->
<div class="wp-block-columns alignwide" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:0"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"border":{"radius":"8px"},"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30","left":"var:preset|spacing|30","right":"var:preset|spacing|30"},"blockGap":"0"}},"backgroundColor":"global_color_7","layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
<div class="wp-block-group has-global-color-7-background-color has-background" style="border-radius:8px;padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30)"><!-- wp:image {"width":"96px","height":"96px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"border":{"radius":"50%"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border" style="margin-top:0;margin-bottom:0"><img src="' . sydney_pattern_image_url( 'portrait-man-1.webp' ) . '" alt="James Thornton" style="border-radius:50%;width:96px;height:96px"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"textAlign":"center","level":4,"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<h4 class="wp-block-heading has-text-align-center" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">James Thornton</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"none"},"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|global_color_5"}}}},"textColor":"global_color_5"} -->
<p class="has-text-align-center has-global-color-5-color has-text-color has-link-color" style="margin-top:var(--wp--preset--spacing--20);margin-bottom:0;text-transform:none">Founder &amp; CEO</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}}}} -->
<p class="has-text-align-center" style="margin-top:var(--wp--preset--spacing--20);margin-bottom:0">Visionary leader with 15 years in digital, guiding strategy and client partnerships.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"border":{"radius":"8px"},"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30","left":"var:preset|spacing|30","right":"var:preset|spacing|30"},"blockGap":"0"}},"backgroundColor":"global_color_7","layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
<div class="wp-block-group has-global-color-7-background-color has-background" style="border-radius:8px;padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30)"><!-- wp:image {"width":"96px","height":"96px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"border":{"radius":"50%"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border" style="margin-top:0;margin-bottom:0"><img src="' . sydney_pattern_image_url( 'portrait-woman-1.webp' ) . '" alt="Elena Vasquez" style="border-radius:50%;width:96px;height:96px"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"textAlign":"center","level":4,"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<h4 class="wp-block-heading has-text-align-center" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">Elena Vasquez</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"none"},"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|global_color_5"}}}},"textColor":"global_color_5"} -->
<p class="has-text-align-center has-global-color-5-color has-text-color has-link-color" style="margin-top:var(--wp--preset--spacing--20);margin-bottom:0;text-transform:none">Creative Director</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}}}} -->
<p class="has-text-align-center" style="margin-top:var(--wp--preset--spacing--20);margin-bottom:0">Shapes every visual detail, from brand identity systems to immersive web experiences.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"border":{"radius":"8px"},"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30","left":"var:preset|spacing|30","right":"var:preset|spacing|30"},"blockGap":"0"}},"backgroundColor":"global_color_7","layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
<div class="wp-block-group has-global-color-7-background-color has-background" style="border-radius:8px;padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30)"><!-- wp:image {"width":"96px","height":"96px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"border":{"radius":"50%"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border" style="margin-top:0;margin-bottom:0"><img src="' . sydney_pattern_image_url( 'portrait-man-2.webp' ) . '" alt="David Kim" style="border-radius:50%;width:96px;height:96px"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"textAlign":"center","level":4,"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<h4 class="wp-block-heading has-text-align-center" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">David Kim</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"none"},"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|global_color_5"}}}},"textColor":"global_color_5"} -->
<p class="has-text-align-center has-global-color-5-color has-text-color has-link-color" style="margin-top:var(--wp--preset--spacing--20);margin-bottom:0;text-transform:none">Lead Developer</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}}}} -->
<p class="has-text-align-center" style="margin-top:var(--wp--preset--spacing--20);margin-bottom:0">Full-stack engineer who architects clean, scalable code for complex digital products.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"border":{"radius":"8px"},"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30","left":"var:preset|spacing|30","right":"var:preset|spacing|30"},"blockGap":"0"}},"backgroundColor":"global_color_7","layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
<div class="wp-block-group has-global-color-7-background-color has-background" style="border-radius:8px;padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30)"><!-- wp:image {"width":"96px","height":"96px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"border":{"radius":"50%"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border" style="margin-top:0;margin-bottom:0"><img src="' . sydney_pattern_image_url( 'portrait-woman-2.webp' ) . '" alt="Sarah Mitchell" style="border-radius:50%;width:96px;height:96px"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"textAlign":"center","level":4,"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<h4 class="wp-block-heading has-text-align-center" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">Sarah Mitchell</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"none"},"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|global_color_5"}}}},"textColor":"global_color_5"} -->
<p class="has-text-align-center has-global-color-5-color has-text-color has-link-color" style="margin-top:var(--wp--preset--spacing--20);margin-bottom:0;text-transform:none">Marketing Strategist</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}}}} -->
<p class="has-text-align-center" style="margin-top:var(--wp--preset--spacing--20);margin-bottom:0">Turns data into growth plans, running campaigns that consistently outperform.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/team-7',
	array(
		'title'      => __( 'Team 7', 'sydney' ),
		'categories' => array( 'sydney-team' ),
		'keywords'   => array( 'team', 'agency', 'digital', 'grid' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_9","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-9-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:group {"layout":{"type":"constrained","contentSize":"768px"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"600","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}}}} -->
<p class="has-text-align-center" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:600;letter-spacing:0.1em;text-transform:uppercase">Our Team</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<h2 class="wp-block-heading has-text-align-center" style="margin-top:0;margin-bottom:0">The people behind every pixel and strategy.</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}},"color":{"text":"var:preset|color|global_color_5"}}} -->
<p class="has-text-align-center has-text-color" style="color:var(--wp--preset--color--global-color-5);margin-top:var(--wp--preset--spacing--30);margin-bottom:0;font-size:18px">A tight-knit crew of designers, developers, and strategists who live and breathe digital. We bring diverse skills and a shared obsession with quality.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}},"layout":{"type":"grid","columnCount":2,"minimumColumnWidth":null}} -->
<div class="wp-block-group alignwide" style="margin-top:var(--wp--preset--spacing--50)"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
<div class="wp-block-group"><!-- wp:image {"width":"112px","height":"112px","aspectRatio":"1","scale":"cover","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border"><img src="' . sydney_pattern_image_url( 'portrait-woman-2.webp' ) . '" alt="Sarah Mitchell" style="border-radius:8px;aspect-ratio:1;object-fit:cover;width:112px;height:112px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<h4 class="wp-block-heading" style="margin-top:0;margin-bottom:0">Sarah Mitchell</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"textTransform":"none"},"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|global_color_4"}}}}} -->
<p class="has-link-color" style="margin-top:var(--wp--preset--spacing--20);margin-bottom:0;text-transform:none">Marketing Strategist</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}},"color":{"text":"var:preset|color|global_color_5"}}} -->
<p class="has-text-color" style="color:var(--wp--preset--color--global-color-5);margin-top:var(--wp--preset--spacing--20);margin-bottom:0">Turns data into growth plans, running campaigns that consistently outperform benchmarks.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
<div class="wp-block-group"><!-- wp:image {"width":"112px","height":"112px","aspectRatio":"1","scale":"cover","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border"><img src="' . sydney_pattern_image_url( 'portrait-man-2.webp' ) . '" alt="David Kim" style="border-radius:8px;aspect-ratio:1;object-fit:cover;width:112px;height:112px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<h4 class="wp-block-heading" style="margin-top:0;margin-bottom:0">David Kim</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"textTransform":"none"},"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|global_color_4"}}}}} -->
<p class="has-link-color" style="margin-top:var(--wp--preset--spacing--20);margin-bottom:0;text-transform:none">Lead Developer</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}},"color":{"text":"var:preset|color|global_color_5"}}} -->
<p class="has-text-color" style="color:var(--wp--preset--color--global-color-5);margin-top:var(--wp--preset--spacing--20);margin-bottom:0">Full-stack engineer who architects clean, scalable code for complex digital products.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
<div class="wp-block-group"><!-- wp:image {"width":"112px","height":"112px","aspectRatio":"1","scale":"cover","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border"><img src="' . sydney_pattern_image_url( 'portrait-woman-1.webp' ) . '" alt="Elena Vasquez" style="border-radius:8px;aspect-ratio:1;object-fit:cover;width:112px;height:112px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<h4 class="wp-block-heading" style="margin-top:0;margin-bottom:0">Elena Vasquez</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"textTransform":"none"},"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|global_color_4"}}}}} -->
<p class="has-link-color" style="margin-top:var(--wp--preset--spacing--20);margin-bottom:0;text-transform:none">Creative Director</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}},"color":{"text":"var:preset|color|global_color_5"}}} -->
<p class="has-text-color" style="color:var(--wp--preset--color--global-color-5);margin-top:var(--wp--preset--spacing--20);margin-bottom:0">Shapes every visual detail, from brand identity systems to immersive web experiences.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
<div class="wp-block-group"><!-- wp:image {"width":"112px","height":"112px","aspectRatio":"1","scale":"cover","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border"><img src="' . sydney_pattern_image_url( 'portrait-man-1.webp' ) . '" alt="James Thornton" style="border-radius:8px;aspect-ratio:1;object-fit:cover;width:112px;height:112px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<h4 class="wp-block-heading" style="margin-top:0;margin-bottom:0">James Thornton</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"textTransform":"none"},"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|global_color_4"}}}}} -->
<p class="has-link-color" style="margin-top:var(--wp--preset--spacing--20);margin-bottom:0;text-transform:none">Founder &amp; CEO</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}},"color":{"text":"var:preset|color|global_color_5"}}} -->
<p class="has-text-color" style="color:var(--wp--preset--color--global-color-5);margin-top:var(--wp--preset--spacing--20);margin-bottom:0">Visionary leader with 15 years in digital, guiding strategy and client partnerships.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/team-9',
	array(
		'title'      => __( 'Team 9', 'sydney' ),
		'categories' => array( 'sydney-team' ),
		'keywords'   => array( 'team', 'local', 'services', 'grid', 'minimal' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"margin":{"top":"0","bottom":"0"},"blockGap":"0"}},"layout":{"type":"constrained"},"backgroundColor":"global_color_9"} -->
<section class="wp-block-group alignfull has-background has-global-color-9-background-color" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained","contentSize":"768px","justifyContent":"left"}} -->
<div class="wp-block-group alignwide" style="margin-bottom:var(--wp--preset--spacing--50)"><!-- wp:heading {"style":{"spacing":{"margin":{"bottom":"0","top":"0"}}}} -->
<h2 class="wp-block-heading" style="margin-top:0;margin-bottom:0">A licensed, background-checked crew with real trade experience.</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|50"}},"layout":{"type":"grid","columnCount":4,"minimumColumnWidth":null}} -->
<div class="wp-block-group alignwide"><!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}}}} -->
<figure class="wp-block-image size-full has-custom-border" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30)"><img src="' . sydney_pattern_image_url( 'portrait-man-1.webp' ) . '" alt="Robert Harmon" style="border-radius:8px"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"bottom":"0","top":"0"}}}} -->
<h4 class="wp-block-heading" style="margin-top:0;margin-bottom:0">Robert Harmon</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}}},"textColor":"global_color_5"} -->
<p class="has-text-color has-global-color-5-color" style="margin-top:var(--wp--preset--spacing--20);margin-bottom:0">Founder &amp; Master Electrician</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}}}} -->
<p style="margin-top:var(--wp--preset--spacing--20);margin-bottom:0">20+ years of hands-on experience, leading every project with precision and a commitment to safety.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}}}} -->
<figure class="wp-block-image size-full has-custom-border" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30)"><img src="' . sydney_pattern_image_url( 'portrait-woman-1.webp' ) . '" alt="Maria Santos" style="border-radius:8px"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"bottom":"0","top":"0"}}}} -->
<h4 class="wp-block-heading" style="margin-top:0;margin-bottom:0">Maria Santos</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}}},"textColor":"global_color_5"} -->
<p class="has-text-color has-global-color-5-color" style="margin-top:var(--wp--preset--spacing--20);margin-bottom:0">Operations Manager</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}}}} -->
<p style="margin-top:var(--wp--preset--spacing--20);margin-bottom:0">Keeps every job on schedule and on budget, coordinating crews and ensuring customer satisfaction.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}}}} -->
<figure class="wp-block-image size-full has-custom-border" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30)"><img src="' . sydney_pattern_image_url( 'portrait-man-2.webp' ) . '" alt="Jake Brennan" style="border-radius:8px"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"bottom":"0","top":"0"}}}} -->
<h4 class="wp-block-heading" style="margin-top:0;margin-bottom:0">Jake Brennan</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}}},"textColor":"global_color_5"} -->
<p class="has-text-color has-global-color-5-color" style="margin-top:var(--wp--preset--spacing--20);margin-bottom:0">Lead Plumber</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}}}} -->
<p style="margin-top:var(--wp--preset--spacing--20);margin-bottom:0">Certified journeyman with a reputation for clean, reliable work on residential and commercial systems.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}}}} -->
<figure class="wp-block-image size-full has-custom-border" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30)"><img src="' . sydney_pattern_image_url( 'portrait-man-3.webp' ) . '" alt="Carlos Rivera" style="border-radius:8px"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"bottom":"0","top":"0"}}}} -->
<h4 class="wp-block-heading" style="margin-top:0;margin-bottom:0">Carlos Rivera</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}}},"textColor":"global_color_5"} -->
<p class="has-text-color has-global-color-5-color" style="margin-top:var(--wp--preset--spacing--20);margin-bottom:0">Senior Technician</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}}}} -->
<p style="margin-top:var(--wp--preset--spacing--20);margin-bottom:0">Specializes in HVAC and general contracting, bringing versatility and deep trade knowledge to the team.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->',
	)
);
