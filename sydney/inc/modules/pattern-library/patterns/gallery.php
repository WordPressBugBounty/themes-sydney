<?php
/**
 * Gallery patterns
 *
 * @package Sydney
 */


// Gallery 1 — 3-column image grid.
register_block_pattern(
	'sydney/gallery-1',
	array(
		'title'      => __( 'Gallery 1', 'sydney' ),
		'categories' => array( 'sydney-gallery' ),
		'keywords'   => array( 'gallery', 'agency', 'portfolio', 'grid', 'images' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_9","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-9-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:group {"layout":{"type":"constrained","contentSize":"768px"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","fontSize":"14px","letterSpacing":"0.3em"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}}}} -->
<p class="has-text-align-center" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:700;letter-spacing:0.3em;text-transform:uppercase">Our Work</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<h2 class="wp-block-heading has-text-align-center" style="margin-top:0;margin-bottom:0">Selected Projects</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:gallery {"columns":3,"linkTo":"none","aspectRatio":"1","align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|50","bottom":"0"},"blockGap":"var:preset|spacing|40"},"border":{"radius":"8px"}}} -->
<figure class="wp-block-gallery alignwide has-nested-images columns-3 is-cropped" style="border-radius:8px;margin-top:var(--wp--preset--spacing--50);margin-bottom:0"><!-- wp:image {"aspectRatio":"1","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-6.webp' ) . '" alt="Color swatches and design sketches on a desk" style="border-radius:8px;aspect-ratio:1"/></figure>
<!-- /wp:image -->

<!-- wp:image {"aspectRatio":"1","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-4.webp' ) . '" alt="Desk with a desktop computer by an office window" style="border-radius:8px;aspect-ratio:1"/></figure>
<!-- /wp:image -->

<!-- wp:image {"aspectRatio":"1","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-5.webp' ) . '" alt="Desk with a laptop and a monitor" style="border-radius:8px;aspect-ratio:1"/></figure>
<!-- /wp:image -->

<!-- wp:image {"aspectRatio":"1","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-3.webp' ) . '" alt="Two people shaking hands in an office" style="border-radius:8px;aspect-ratio:1"/></figure>
<!-- /wp:image -->

<!-- wp:image {"aspectRatio":"1","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-1.webp' ) . '" alt="Team working on laptops around a wooden table" style="border-radius:8px;aspect-ratio:1"/></figure>
<!-- /wp:image -->

<!-- wp:image {"aspectRatio":"1","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-2.webp' ) . '" alt="Person typing on a laptop" style="border-radius:8px;aspect-ratio:1"/></figure>
<!-- /wp:image --></figure>
<!-- /wp:gallery --></section>
<!-- /wp:group -->',
	)
);

// Gallery 3 — Mixed layout with 2 large images on top and 4 smaller below.
register_block_pattern(
	'sydney/gallery-3',
	array(
		'title'      => __( 'Gallery 3', 'sydney' ),
		'categories' => array( 'sydney-gallery' ),
		'keywords'   => array( 'gallery', 'agency', 'portfolio', 'grid', 'images' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_9","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-9-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:group {"layout":{"type":"constrained","contentSize":"768px"}} -->
<div class="wp-block-group"><!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<h2 class="wp-block-heading has-text-align-center" style="margin-top:0;margin-bottom:0">Selected Projects</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:gallery {"columns":2,"linkTo":"none","align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|50","bottom":"0"},"blockGap":"var:preset|spacing|40"},"border":{"radius":"8px"}}} -->
<figure class="wp-block-gallery alignwide has-nested-images columns-2 is-cropped" style="border-radius:8px;margin-top:var(--wp--preset--spacing--50);margin-bottom:0"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-5.webp' ) . '" alt="Desk with a laptop and a monitor" style="border-radius:8px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-6.webp' ) . '" alt="Color swatches and design sketches on a desk" style="border-radius:8px"/></figure>
<!-- /wp:image --></figure>
<!-- /wp:gallery -->

<!-- wp:gallery {"columns":4,"linkTo":"none","aspectRatio":"1","align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"0"},"blockGap":"var:preset|spacing|40"},"border":{"radius":"8px"}}} -->
<figure class="wp-block-gallery alignwide has-nested-images columns-4 is-cropped" style="border-radius:8px;margin-top:var(--wp--preset--spacing--40);margin-bottom:0"><!-- wp:image {"aspectRatio":"1","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-4.webp' ) . '" alt="Desk with a desktop computer by an office window" style="border-radius:8px;aspect-ratio:1"/></figure>
<!-- /wp:image -->

<!-- wp:image {"aspectRatio":"1","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-2.webp' ) . '" alt="Person typing on a laptop" style="border-radius:8px;aspect-ratio:1"/></figure>
<!-- /wp:image -->

<!-- wp:image {"aspectRatio":"1","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-3.webp' ) . '" alt="Two people shaking hands in an office" style="border-radius:8px;aspect-ratio:1"/></figure>
<!-- /wp:image -->

<!-- wp:image {"aspectRatio":"1","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-1.webp' ) . '" alt="Team working on laptops around a wooden table" style="border-radius:8px;aspect-ratio:1"/></figure>
<!-- /wp:image --></figure>
<!-- /wp:gallery --></section>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/gallery-5',
	array(
		'title'      => __( 'Gallery 5', 'sydney' ),
		'categories' => array( 'sydney-gallery' ),
		'keywords'   => array( 'gallery', 'agency', 'portfolio', 'projects' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_9","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-9-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)"><!-- wp:group {"layout":{"type":"constrained","contentSize":"768px"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","fontSize":"12px","letterSpacing":"3px"},"spacing":{"margin":{"bottom":"var:preset|spacing|20","top":"0"}}},"textColor":"global_color_5"} -->
<p class="has-text-align-center has-global-color-5-color has-text-color" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--20);font-size:12px;font-style:normal;font-weight:700;letter-spacing:3px;text-transform:uppercase">Recent Work</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<h2 class="wp-block-heading has-text-align-center" style="margin-top:0;margin-bottom:0">Completed Projects</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|50","bottom":"0"},"blockGap":"var:preset|spacing|40"}},"layout":{"type":"grid","columnCount":4,"minimumColumnWidth":null}} -->
<div class="wp-block-group alignwide" style="margin-top:var(--wp--preset--spacing--50);margin-bottom:0"><!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"4px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-4.webp' ) . '" alt="Desk with a desktop computer by an office window" style="border-radius:4px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|30"},"margin":{"top":"var:preset|spacing|30"}},"border":{"top":{"color":"var:preset|color|global_color_8","width":"1px"},"right":{},"bottom":{},"left":{}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="border-top-color:var(--wp--preset--color--global-color-8);border-top-width:1px;margin-top:var(--wp--preset--spacing--30);padding-top:var(--wp--preset--spacing--30)"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","fontSize":"12px","letterSpacing":"3px"},"spacing":{"margin":{"bottom":"var:preset|spacing|20","top":"0"}}},"textColor":"global_color_5"} -->
<p class="has-global-color-5-color has-text-color" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--20);font-size:12px;font-style:normal;font-weight:700;letter-spacing:3px;text-transform:uppercase">01 — Branding</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<h4 class="wp-block-heading" style="margin-top:0;margin-bottom:0">Northwind — Brand Identity</h4>
<!-- /wp:heading --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"4px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-5.webp' ) . '" alt="Desk with a laptop and a monitor" style="border-radius:4px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|30"},"margin":{"top":"var:preset|spacing|30"}},"border":{"top":{"color":"var:preset|color|global_color_8","width":"1px"},"right":{},"bottom":{},"left":{}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="border-top-color:var(--wp--preset--color--global-color-8);border-top-width:1px;margin-top:var(--wp--preset--spacing--30);padding-top:var(--wp--preset--spacing--30)"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","fontSize":"12px","letterSpacing":"3px"},"spacing":{"margin":{"bottom":"var:preset|spacing|20","top":"0"}}},"textColor":"global_color_5"} -->
<p class="has-global-color-5-color has-text-color" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--20);font-size:12px;font-style:normal;font-weight:700;letter-spacing:3px;text-transform:uppercase">02 — Product</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<h4 class="wp-block-heading" style="margin-top:0;margin-bottom:0">Orbital — SaaS Platform</h4>
<!-- /wp:heading --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:image {"aspectRatio":"3/4","scale":"cover","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"4px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-6.webp' ) . '" alt="Color swatches and design sketches on a desk" style="border-radius:4px;aspect-ratio:3/4;object-fit:cover"/></figure>
<!-- /wp:image -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|30"},"margin":{"top":"var:preset|spacing|30"}},"border":{"top":{"color":"var:preset|color|global_color_8","width":"1px"},"right":{},"bottom":{},"left":{}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="border-top-color:var(--wp--preset--color--global-color-8);border-top-width:1px;margin-top:var(--wp--preset--spacing--30);padding-top:var(--wp--preset--spacing--30)"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","fontSize":"12px","letterSpacing":"3px"},"spacing":{"margin":{"bottom":"var:preset|spacing|20","top":"0"}}},"textColor":"global_color_5"} -->
<p class="has-global-color-5-color has-text-color" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--20);font-size:12px;font-style:normal;font-weight:700;letter-spacing:3px;text-transform:uppercase">03 — E-Commerce</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<h4 class="wp-block-heading" style="margin-top:0;margin-bottom:0">Harvest — E-Commerce</h4>
<!-- /wp:heading --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"4px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-1.webp' ) . '" alt="Team working on laptops around a wooden table" style="border-radius:4px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|30"},"margin":{"top":"var:preset|spacing|30"}},"border":{"top":{"color":"var:preset|color|global_color_8","width":"1px"},"right":{},"bottom":{},"left":{}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="border-top-color:var(--wp--preset--color--global-color-8);border-top-width:1px;margin-top:var(--wp--preset--spacing--30);padding-top:var(--wp--preset--spacing--30)"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","fontSize":"12px","letterSpacing":"3px"},"spacing":{"margin":{"bottom":"var:preset|spacing|20","top":"0"}}},"textColor":"global_color_5"} -->
<p class="has-global-color-5-color has-text-color" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--20);font-size:12px;font-style:normal;font-weight:700;letter-spacing:3px;text-transform:uppercase">04 — Web Design</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<h4 class="wp-block-heading" style="margin-top:0;margin-bottom:0">Brighton — Website Redesign</h4>
<!-- /wp:heading --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->',
	)
);


register_block_pattern(
	'sydney/gallery-6',
	array(
		'title'      => __( 'Gallery 6', 'sydney' ),
		'categories' => array( 'sydney-gallery' ),
		'keywords'   => array( 'gallery', 'agency', 'digital', 'grid', 'images' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_9","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-9-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)"><!-- wp:group {"layout":{"type":"constrained","contentSize":"768px"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"600","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}},"color":{"text":"var:preset|color|global_color_1"}},"textColor":"global_color_1"} -->
<p class="has-text-align-center has-global-color-1-color has-text-color" style="color:var(--wp--preset--color--global-color-1);margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:600;letter-spacing:0.1em;text-transform:uppercase">Our Work</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<h2 class="wp-block-heading has-text-align-center" style="margin-top:0;margin-bottom:0">Projects we\'re proud of.</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<p class="has-text-align-center" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0;font-size:18px">A selection of recent work across branding, web design, and digital campaigns for ambitious clients worldwide.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:gallery {"columns":3,"linkTo":"none","aspectRatio":"1","align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|50","bottom":"0"},"blockGap":"var:preset|spacing|40"},"border":{"radius":"8px"}}} -->
<figure class="wp-block-gallery alignwide has-nested-images columns-3 is-cropped" style="border-radius:8px;margin-top:var(--wp--preset--spacing--50);margin-bottom:0"><!-- wp:image {"aspectRatio":"1","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-5.webp' ) . '" alt="Desk with a laptop and a monitor" style="border-radius:8px;aspect-ratio:1"/></figure>
<!-- /wp:image -->

<!-- wp:image {"aspectRatio":"1","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-6.webp' ) . '" alt="Color swatches and design sketches on a desk" style="border-radius:8px;aspect-ratio:1"/></figure>
<!-- /wp:image -->

<!-- wp:image {"aspectRatio":"1","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-2.webp' ) . '" alt="Person typing on a laptop" style="border-radius:8px;aspect-ratio:1"/></figure>
<!-- /wp:image -->

<!-- wp:image {"aspectRatio":"1","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-4.webp' ) . '" alt="Desk with a desktop computer by an office window" style="border-radius:8px;aspect-ratio:1"/></figure>
<!-- /wp:image -->

<!-- wp:image {"aspectRatio":"1","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-3.webp' ) . '" alt="Two people shaking hands in an office" style="border-radius:8px;aspect-ratio:1"/></figure>
<!-- /wp:image -->

<!-- wp:image {"aspectRatio":"1","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-1.webp' ) . '" alt="Team working on laptops around a wooden table" style="border-radius:8px;aspect-ratio:1"/></figure>
<!-- /wp:image --></figure>
<!-- /wp:gallery -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50","bottom":"0"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--50);margin-bottom:0"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button">View All Projects</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></section>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/gallery-7',
	array(
		'title'      => __( 'Gallery 7', 'sydney' ),
		'categories' => array( 'sydney-gallery' ),
		'keywords'   => array( 'gallery', 'agency', 'digital', 'portfolio', 'columns' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_9","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-9-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)"><!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
<div class="wp-block-group alignwide" style="margin-top:0;margin-bottom:0"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"672px","justifyContent":"left"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"600","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}},"color":{"text":"var:preset|color|global_color_1"}},"textColor":"global_color_1"} -->
<p class="has-global-color-1-color has-text-color" style="color:var(--wp--preset--color--global-color-1);margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:600;letter-spacing:0.1em;text-transform:uppercase">Our Work</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<h2 class="wp-block-heading" style="margin-top:0;margin-bottom:0">Projects we\'re proud of.</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-buttons" style="margin-top:0;margin-bottom:0"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button">View All Projects</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->

<!-- wp:gallery {"columns":2,"linkTo":"none","align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|50","bottom":"0"},"blockGap":"var:preset|spacing|40"},"border":{"radius":"8px"}}} -->
<figure class="wp-block-gallery alignwide has-nested-images columns-2 is-cropped" style="border-radius:8px;margin-top:var(--wp--preset--spacing--50);margin-bottom:0"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-6.webp' ) . '" alt="Color swatches and design sketches on a desk" style="border-radius:8px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-4.webp' ) . '" alt="Desk with a desktop computer by an office window" style="border-radius:8px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-3.webp' ) . '" alt="Two people shaking hands in an office" style="border-radius:8px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-5.webp' ) . '" alt="Desk with a laptop and a monitor" style="border-radius:8px"/></figure>
<!-- /wp:image --></figure>
<!-- /wp:gallery --></section>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/gallery-9',
	array(
		'title'      => __( 'Gallery 9', 'sydney' ),
		'categories' => array( 'sydney-gallery' ),
		'keywords'   => array( 'gallery', 'agency', 'portfolio', 'grid', 'images' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_9","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-9-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)"><!-- wp:group {"layout":{"type":"constrained","contentSize":"768px"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"600","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}},"color":{"text":"var:preset|color|global_color_1"}},"textColor":"global_color_1"} -->
<p class="has-text-align-center has-global-color-1-color has-text-color" style="color:var(--wp--preset--color--global-color-1);margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:600;letter-spacing:0.1em;text-transform:uppercase">Our Work</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<h2 class="wp-block-heading has-text-align-center" style="margin-top:0;margin-bottom:0">Recent Projects We\'re Proud Of</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<p class="has-text-align-center" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0;font-size:18px">A selection of recent work across branding, websites, and digital products for ambitious clients.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:gallery {"columns":2,"linkTo":"none","align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|50","bottom":"0"},"blockGap":"var:preset|spacing|40"},"border":{"radius":"8px"}}} -->
<figure class="wp-block-gallery alignwide has-nested-images columns-2 is-cropped" style="border-radius:8px;margin-top:var(--wp--preset--spacing--50);margin-bottom:0"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-5.webp' ) . '" alt="Desk with a laptop and a monitor" style="border-radius:8px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-6.webp' ) . '" alt="Color swatches and design sketches on a desk" style="border-radius:8px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-4.webp' ) . '" alt="Desk with a desktop computer by an office window" style="border-radius:8px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-2.webp' ) . '" alt="Person typing on a laptop" style="border-radius:8px"/></figure>
<!-- /wp:image --></figure>
<!-- /wp:gallery -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50","bottom":"0"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--50);margin-bottom:0"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">View All Projects</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></section>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/gallery-10',
	array(
		'title'      => __( 'Gallery 10', 'sydney' ),
		'categories' => array( 'sydney-gallery' ),
		'keywords'   => array( 'gallery', 'agency', 'portfolio', 'columns' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_9","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-9-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)"><!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
<div class="wp-block-group alignwide" style="margin-top:0;margin-bottom:0"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"672px","justifyContent":"left"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"600","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}},"color":{"text":"var:preset|color|global_color_1"}},"textColor":"global_color_1"} -->
<p class="has-global-color-1-color has-text-color" style="color:var(--wp--preset--color--global-color-1);margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:600;letter-spacing:0.1em;text-transform:uppercase">Our Work</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<h2 class="wp-block-heading" style="margin-top:0;margin-bottom:0">Recent Projects We\'re Proud Of</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-buttons" style="margin-top:0;margin-bottom:0"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">View All Projects</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->

<!-- wp:gallery {"columns":3,"linkTo":"none","aspectRatio":"1","align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|50","bottom":"0"},"blockGap":"var:preset|spacing|40"},"border":{"radius":"8px"}}} -->
<figure class="wp-block-gallery alignwide has-nested-images columns-3 is-cropped" style="border-radius:8px;margin-top:var(--wp--preset--spacing--50);margin-bottom:0"><!-- wp:image {"aspectRatio":"1","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-6.webp' ) . '" alt="Color swatches and design sketches on a desk" style="border-radius:8px;aspect-ratio:1"/></figure>
<!-- /wp:image -->

<!-- wp:image {"aspectRatio":"1","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-4.webp' ) . '" alt="Desk with a desktop computer by an office window" style="border-radius:8px;aspect-ratio:1"/></figure>
<!-- /wp:image -->

<!-- wp:image {"aspectRatio":"1","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-5.webp' ) . '" alt="Desk with a laptop and a monitor" style="border-radius:8px;aspect-ratio:1"/></figure>
<!-- /wp:image -->

<!-- wp:image {"aspectRatio":"1","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-3.webp' ) . '" alt="Two people shaking hands in an office" style="border-radius:8px;aspect-ratio:1"/></figure>
<!-- /wp:image -->

<!-- wp:image {"aspectRatio":"1","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-1.webp' ) . '" alt="Team working on laptops around a wooden table" style="border-radius:8px;aspect-ratio:1"/></figure>
<!-- /wp:image -->

<!-- wp:image {"aspectRatio":"1","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-2.webp' ) . '" alt="Person typing on a laptop" style="border-radius:8px;aspect-ratio:1"/></figure>
<!-- /wp:image --></figure>
<!-- /wp:gallery --></section>
<!-- /wp:group -->',
	)
);


register_block_pattern(
	'sydney/gallery-11',
	array(
		'title'      => __( 'Gallery 11', 'sydney' ),
		'categories' => array( 'sydney-gallery' ),
		'keywords'   => array( 'gallery', 'agency', 'portfolio' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_9","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-9-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:group {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained","contentSize":"768px"}} -->
<div class="wp-block-group" style="margin-bottom:var(--wp--preset--spacing--50)"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}},"color":{"text":"var:preset|color|global_color_1"}},"textColor":"global_color_1"} -->
<p class="has-text-align-center has-global-color-1-color has-text-color" style="color:var(--wp--preset--color--global-color-1);margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:700;letter-spacing:0.1em;text-transform:uppercase">Portfolio</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}}}} -->
<h2 class="wp-block-heading has-text-align-center" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30)">Selected Work</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-align-center" style="margin-top:0;margin-bottom:0;font-size:18px">A curated selection of projects that showcase our approach to design and development.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:gallery {"columns":3,"linkTo":"none","aspectRatio":"1","align":"wide","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"blockGap":"var:preset|spacing|40"},"border":{"radius":"8px"}}} -->
<figure class="wp-block-gallery alignwide has-nested-images columns-3 is-cropped" style="border-radius:8px;margin-top:0;margin-bottom:0"><!-- wp:image {"aspectRatio":"1","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-4.webp' ) . '" alt="Desk with a desktop computer by an office window" style="border-radius:8px;aspect-ratio:1"/></figure>
<!-- /wp:image -->

<!-- wp:image {"aspectRatio":"1","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-5.webp' ) . '" alt="Desk with a laptop and a monitor" style="border-radius:8px;aspect-ratio:1"/></figure>
<!-- /wp:image -->

<!-- wp:image {"aspectRatio":"1","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-6.webp' ) . '" alt="Color swatches and design sketches on a desk" style="border-radius:8px;aspect-ratio:1"/></figure>
<!-- /wp:image -->

<!-- wp:image {"aspectRatio":"1","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-1.webp' ) . '" alt="Team working on laptops around a wooden table" style="border-radius:8px;aspect-ratio:1"/></figure>
<!-- /wp:image -->

<!-- wp:image {"aspectRatio":"1","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-2.webp' ) . '" alt="Person typing on a laptop" style="border-radius:8px;aspect-ratio:1"/></figure>
<!-- /wp:image -->

<!-- wp:image {"aspectRatio":"1","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-3.webp' ) . '" alt="Two people shaking hands in an office" style="border-radius:8px;aspect-ratio:1"/></figure>
<!-- /wp:image --></figure>
<!-- /wp:gallery --></section>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/gallery-12',
	array(
		'title'      => __( 'Gallery 12', 'sydney' ),
		'categories' => array( 'sydney-gallery' ),
		'keywords'   => array( 'gallery', 'agency', 'portfolio' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_9","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-9-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:group {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained","contentSize":"768px"}} -->
<div class="wp-block-group" style="margin-bottom:var(--wp--preset--spacing--50)"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}}}} -->
<p class="has-text-align-center" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:700;letter-spacing:0.1em;text-transform:uppercase">Portfolio</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}}}} -->
<h2 class="wp-block-heading has-text-align-center" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30)">Selected Work</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"color":{"text":"var:preset|color|global_color_5"},"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|40"}}}} -->
<p class="has-text-align-center has-text-color" style="color:var(--wp--preset--color--global-color-5);margin-top:0;margin-bottom:var(--wp--preset--spacing--40);font-size:18px">A curated selection of projects that showcase our approach to design and development.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|50"}},"layout":{"type":"grid","columnCount":2,"minimumColumnWidth":null}} -->
<div class="wp-block-group alignwide"><!-- wp:group {"style":{"spacing":{"blockGap":"0","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:image {"aspectRatio":"4/3","scale":"cover","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"},"spacing":{"margin":{"bottom":"var:preset|spacing|30"}}}} -->
<figure class="wp-block-image size-full has-custom-border" style="margin-bottom:var(--wp--preset--spacing--30)"><img src="' . sydney_pattern_image_url( 'scene-small-5.webp' ) . '" alt="Desk with a laptop and a monitor" style="border-radius:8px;aspect-ratio:4/3;object-fit:cover"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|20"}}}} -->
<h3 class="wp-block-heading" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--20)">Brand Redesign</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"color":{"text":"var:preset|color|global_color_5"},"spacing":{"margin":{"top":"0"}}}} -->
<p class="has-text-color" style="color:var(--wp--preset--color--global-color-5);margin-top:0">UI/UX Design</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:image {"aspectRatio":"4/3","scale":"cover","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"},"spacing":{"margin":{"bottom":"var:preset|spacing|30"}}}} -->
<figure class="wp-block-image size-full has-custom-border" style="margin-bottom:var(--wp--preset--spacing--30)"><img src="' . sydney_pattern_image_url( 'scene-small-6.webp' ) . '" alt="Color swatches and design sketches on a desk" style="border-radius:8px;aspect-ratio:4/3;object-fit:cover"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|20"}}}} -->
<h3 class="wp-block-heading" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--20)">E-Commerce Platform</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"color":{"text":"var:preset|color|global_color_5"},"spacing":{"margin":{"top":"0"}}}} -->
<p class="has-text-color" style="color:var(--wp--preset--color--global-color-5);margin-top:0">Web Development</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:image {"aspectRatio":"4/3","scale":"cover","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"},"spacing":{"margin":{"bottom":"var:preset|spacing|30"}}}} -->
<figure class="wp-block-image size-full has-custom-border" style="margin-bottom:var(--wp--preset--spacing--30)"><img src="' . sydney_pattern_image_url( 'scene-small-4.webp' ) . '" alt="Desk with a desktop computer by an office window" style="border-radius:8px;aspect-ratio:4/3;object-fit:cover"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|20"}}}} -->
<h3 class="wp-block-heading" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--20)">Fitness App</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"color":{"text":"var:preset|color|global_color_5"},"spacing":{"margin":{"top":"0"}}}} -->
<p class="has-text-color" style="color:var(--wp--preset--color--global-color-5);margin-top:0">Mobile Design</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:image {"aspectRatio":"4/3","scale":"cover","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"},"spacing":{"margin":{"bottom":"var:preset|spacing|30"}}}} -->
<figure class="wp-block-image size-full has-custom-border" style="margin-bottom:var(--wp--preset--spacing--30)"><img src="' . sydney_pattern_image_url( 'scene-small-2.webp' ) . '" alt="Person typing on a laptop" style="border-radius:8px;aspect-ratio:4/3;object-fit:cover"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|20"}}}} -->
<h3 class="wp-block-heading" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--20)">Analytics Dashboard</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"color":{"text":"var:preset|color|global_color_5"},"spacing":{"margin":{"top":"0"}}}} -->
<p class="has-text-color" style="color:var(--wp--preset--color--global-color-5);margin-top:0">Product Design</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/gallery-13',
	array(
		'title'      => __( 'Gallery 13', 'sydney' ),
		'categories' => array( 'sydney-gallery' ),
		'keywords'   => array( 'gallery', 'agency', 'portfolio' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_9","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-9-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained","justifyContent":"left"}} -->
<div class="wp-block-group alignwide" style="margin-bottom:var(--wp--preset--spacing--50)"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}}}} -->
<p style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:700;letter-spacing:0.1em;text-transform:uppercase">Portfolio</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<h2 class="wp-block-heading" style="margin-top:0;margin-bottom:0">Selected Work</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|60"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide"><!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|50"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:image {"aspectRatio":"4/3","scale":"cover","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-6.webp' ) . '" alt="Color swatches and design sketches on a desk" style="border-radius:8px;aspect-ratio:4/3;object-fit:cover"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"600","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}},"color":{"text":"var:preset|color|global_color_5"}}} -->
<p class="has-text-color" style="color:var(--wp--preset--color--global-color-5);margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:600;letter-spacing:0.1em;text-transform:uppercase">UI/UX Design</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}}}} -->
<h3 class="wp-block-heading" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30)">Brand Redesign</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"color":{"text":"var:preset|color|global_color_5"},"spacing":{"margin":{"top":"0"}}}} -->
<p class="has-text-color" style="color:var(--wp--preset--color--global-color-5);margin-top:0">A complete visual overhaul for an ambitious client.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|global_color_4"}}}}} -->
<p class="has-link-color" style="margin-top:0;margin-bottom:0;font-style:normal;font-weight:600"><a href="#">View Case Study →</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|50"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"600","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}},"color":{"text":"var:preset|color|global_color_5"}}} -->
<p class="has-text-color" style="color:var(--wp--preset--color--global-color-5);margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:600;letter-spacing:0.1em;text-transform:uppercase">Web Development</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}}}} -->
<h3 class="wp-block-heading" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30)">E-Commerce Platform</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"color":{"text":"var:preset|color|global_color_5"},"spacing":{"margin":{"top":"0"}}}} -->
<p class="has-text-color" style="color:var(--wp--preset--color--global-color-5);margin-top:0">Custom online store with advanced filtering and seamless checkout.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|global_color_4"}}}}} -->
<p class="has-link-color" style="margin-top:0;margin-bottom:0;font-style:normal;font-weight:600"><a href="#">View Case Study →</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:image {"aspectRatio":"4/3","scale":"cover","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-4.webp' ) . '" alt="Desk with a desktop computer by an office window" style="border-radius:8px;aspect-ratio:4/3;object-fit:cover"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->',
	)
);


register_block_pattern(
	'sydney/gallery-14',
	array(
		'title'      => __( 'Gallery 14', 'sydney' ),
		'categories' => array( 'sydney-gallery' ),
		'keywords'   => array( 'gallery', 'agency', 'portfolio', 'grid', 'images' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_9","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-9-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)"><!-- wp:group {"layout":{"type":"constrained","contentSize":"768px"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"600","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}},"color":{"text":"var:preset|color|global_color_1"}},"textColor":"global_color_1"} -->
<p class="has-text-align-center has-global-color-1-color has-text-color" style="color:var(--wp--preset--color--global-color-1);margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:600;letter-spacing:0.1em;text-transform:uppercase">Our Work</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<h2 class="wp-block-heading has-text-align-center" style="margin-top:0;margin-bottom:0">Selected Projects</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<p class="has-text-align-center" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0;font-size:18px">A selection of recent work across branding, websites, and digital products for ambitious clients.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:gallery {"columns":3,"linkTo":"none","aspectRatio":"1","align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|50","bottom":"0"},"blockGap":"var:preset|spacing|30"},"border":{"radius":"8px"}}} -->
<figure class="wp-block-gallery alignwide has-nested-images columns-3 is-cropped" style="border-radius:8px;margin-top:var(--wp--preset--spacing--50);margin-bottom:0"><!-- wp:image {"aspectRatio":"1","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-4.webp' ) . '" alt="Desk with a desktop computer by an office window" style="border-radius:8px;aspect-ratio:1"/></figure>
<!-- /wp:image -->

<!-- wp:image {"aspectRatio":"1","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-5.webp' ) . '" alt="Desk with a laptop and a monitor" style="border-radius:8px;aspect-ratio:1"/></figure>
<!-- /wp:image -->

<!-- wp:image {"aspectRatio":"1","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-6.webp' ) . '" alt="Color swatches and design sketches on a desk" style="border-radius:8px;aspect-ratio:1"/></figure>
<!-- /wp:image -->

<!-- wp:image {"aspectRatio":"1","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-1.webp' ) . '" alt="Team working on laptops around a wooden table" style="border-radius:8px;aspect-ratio:1"/></figure>
<!-- /wp:image -->

<!-- wp:image {"aspectRatio":"1","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-2.webp' ) . '" alt="Person typing on a laptop" style="border-radius:8px;aspect-ratio:1"/></figure>
<!-- /wp:image -->

<!-- wp:image {"aspectRatio":"1","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-3.webp' ) . '" alt="Two people shaking hands in an office" style="border-radius:8px;aspect-ratio:1"/></figure>
<!-- /wp:image --></figure>
<!-- /wp:gallery --></section>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/gallery-15',
	array(
		'title'      => __( 'Gallery 15', 'sydney' ),
		'categories' => array( 'sydney-gallery' ),
		'keywords'   => array( 'gallery', 'agency', 'portfolio', 'grid', 'images' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_9","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-9-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)"><!-- wp:group {"layout":{"type":"constrained","contentSize":"768px"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"600","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}},"color":{"text":"var:preset|color|global_color_1"}},"textColor":"global_color_1"} -->
<p class="has-text-align-center has-global-color-1-color has-text-color" style="color:var(--wp--preset--color--global-color-1);margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:600;letter-spacing:0.1em;text-transform:uppercase">Our Work</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<h2 class="wp-block-heading has-text-align-center" style="margin-top:0;margin-bottom:0">Selected Projects</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<p class="has-text-align-center" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0;font-size:18px">A selection of recent work across branding, websites, and digital products for ambitious clients.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:gallery {"columns":2,"linkTo":"none","align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|50","bottom":"0"},"blockGap":"var:preset|spacing|30"},"border":{"radius":"8px"}}} -->
<figure class="wp-block-gallery alignwide has-nested-images columns-2 is-cropped" style="border-radius:8px;margin-top:var(--wp--preset--spacing--50);margin-bottom:0"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-5.webp' ) . '" alt="Desk with a laptop and a monitor" style="border-radius:8px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-6.webp' ) . '" alt="Color swatches and design sketches on a desk" style="border-radius:8px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-4.webp' ) . '" alt="Desk with a desktop computer by an office window" style="border-radius:8px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-2.webp' ) . '" alt="Person typing on a laptop" style="border-radius:8px"/></figure>
<!-- /wp:image --></figure>
<!-- /wp:gallery --></section>
<!-- /wp:group -->',
	)
);
