<?php
/**
 * Pro Gallery patterns
 *
 * Returns a list of pattern arrays. See README.md for the format.
 *
 * @package Sydney
 */

return array(

	// Gallery 2: a bento grid with one large square and five small ones.
	array(
		'name'       => 'sydney-pro/gallery-2',
		'title'      => __( 'Gallery 2', 'sydney' ),
		'categories' => array( 'sydney-gallery' ),
		'keywords'   => array( 'gallery', 'agency', 'portfolio', 'grid', 'images' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_9","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-9-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:group {"layout":{"type":"constrained","contentSize":"768px"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","fontSize":"14px","letterSpacing":"0.3em"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}},"color":{"text":"var:preset|color|global_color_1"}},"textColor":"global_color_1"} -->
<p class="has-text-align-center has-global-color-1-color has-text-color" style="color:var(--wp--preset--color--global-color-1);margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:700;letter-spacing:0.3em;text-transform:uppercase">Our Work</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<h2 class="wp-block-heading has-text-align-center" style="margin-top:0;margin-bottom:0">Selected Projects</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|50","bottom":"0"},"blockGap":"var:preset|spacing|30"}},"layout":{"type":"grid","columnCount":3,"minimumColumnWidth":null}} -->
<div class="wp-block-group alignwide" style="margin-top:var(--wp--preset--spacing--50);margin-bottom:0"><!-- wp:image {"aspectRatio":"1","scale":"cover","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"},"layout":{"columnSpan":2,"rowSpan":2}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-4.webp' ) . '" alt="Desk with a desktop computer by an office window" style="border-radius:8px;aspect-ratio:1;object-fit:cover"/></figure>
<!-- /wp:image -->

<!-- wp:image {"aspectRatio":"1","scale":"cover","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-5.webp' ) . '" alt="Desk with a laptop and a monitor" style="border-radius:8px;aspect-ratio:1;object-fit:cover"/></figure>
<!-- /wp:image -->

<!-- wp:image {"aspectRatio":"1","scale":"cover","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-6.webp' ) . '" alt="Color swatches and design sketches on a desk" style="border-radius:8px;aspect-ratio:1;object-fit:cover"/></figure>
<!-- /wp:image -->

<!-- wp:image {"aspectRatio":"1","scale":"cover","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-1.webp' ) . '" alt="Team working on laptops around a wooden table" style="border-radius:8px;aspect-ratio:1;object-fit:cover"/></figure>
<!-- /wp:image -->

<!-- wp:image {"aspectRatio":"1","scale":"cover","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-2.webp' ) . '" alt="Person typing on a laptop" style="border-radius:8px;aspect-ratio:1;object-fit:cover"/></figure>
<!-- /wp:image -->

<!-- wp:image {"aspectRatio":"1","scale":"cover","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-3.webp' ) . '" alt="Two people shaking hands in an office" style="border-radius:8px;aspect-ratio:1;object-fit:cover"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->',
	),

	array(
		'name'       => 'sydney-pro/gallery-4',
		'title'      => __( 'Gallery 4', 'sydney' ),
		'categories' => array( 'sydney-gallery' ),
		'keywords'   => array( 'gallery', 'agency', 'portfolio', 'projects' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_9","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-9-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)"><!-- wp:group {"layout":{"type":"constrained","contentSize":"768px"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","fontSize":"12px","letterSpacing":"3px"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}}},"textColor":"global_color_5"} -->
<p class="has-text-align-center has-global-color-5-color has-text-color" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:12px;font-style:normal;font-weight:700;letter-spacing:3px;text-transform:uppercase">Our Portfolio</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<h2 class="wp-block-heading has-text-align-center" style="margin-top:0;margin-bottom:0">Featured Projects</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|50","bottom":"0"},"blockGap":"var:preset|spacing|40"}},"layout":{"type":"grid","columnCount":3,"minimumColumnWidth":null}} -->
<div class="wp-block-group alignwide" style="margin-top:var(--wp--preset--spacing--50);margin-bottom:0"><!-- wp:cover {"url":"' . sydney_pattern_image_url( 'scene-small-6.webp' ) . '","dimRatio":60,"overlayColor":"global_color_6","isUserOverlayColor":true,"contentPosition":"bottom left","style":{"border":{"radius":"4px"},"dimensions":{"aspectRatio":"4/3"},"spacing":{"padding":{"right":"var:preset|spacing|40","left":"var:preset|spacing|40","top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover has-custom-content-position is-position-bottom-left" style="border-radius:4px;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><img class="wp-block-cover__image-background" alt="" src="' . sydney_pattern_image_url( 'scene-small-6.webp' ) . '" data-object-fit="cover"/><span aria-hidden="true" class="wp-block-cover__background has-global-color-6-background-color has-background-dim-60 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","fontSize":"12px","letterSpacing":"3px"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}},"color":{"text":"#ffffffbf"},"elements":{"link":{"color":{"text":"#ffffffbf"}}}}} -->
<p class="has-text-color has-link-color" style="color:#ffffffbf;margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:12px;font-style:normal;font-weight:700;letter-spacing:3px;text-transform:uppercase">Branding</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffff"}}} -->
<h4 class="wp-block-heading has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0">Northwind — Brand Identity</h4>
<!-- /wp:heading --></div></div>
<!-- /wp:cover -->

<!-- wp:cover {"url":"' . sydney_pattern_image_url( 'scene-small-4.webp' ) . '","dimRatio":60,"overlayColor":"global_color_6","isUserOverlayColor":true,"contentPosition":"bottom left","style":{"border":{"radius":"4px"},"dimensions":{"aspectRatio":"4/3"},"spacing":{"padding":{"right":"var:preset|spacing|40","left":"var:preset|spacing|40","top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover has-custom-content-position is-position-bottom-left" style="border-radius:4px;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><img class="wp-block-cover__image-background" alt="" src="' . sydney_pattern_image_url( 'scene-small-4.webp' ) . '" data-object-fit="cover"/><span aria-hidden="true" class="wp-block-cover__background has-global-color-6-background-color has-background-dim-60 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","fontSize":"12px","letterSpacing":"3px"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}},"color":{"text":"#ffffffbf"},"elements":{"link":{"color":{"text":"#ffffffbf"}}}}} -->
<p class="has-text-color has-link-color" style="color:#ffffffbf;margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:12px;font-style:normal;font-weight:700;letter-spacing:3px;text-transform:uppercase">Product</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffff"}}} -->
<h4 class="wp-block-heading has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0">Orbital — SaaS Platform</h4>
<!-- /wp:heading --></div></div>
<!-- /wp:cover -->

<!-- wp:cover {"url":"' . sydney_pattern_image_url( 'scene-small-5.webp' ) . '","dimRatio":60,"overlayColor":"global_color_6","isUserOverlayColor":true,"contentPosition":"bottom left","style":{"border":{"radius":"4px"},"dimensions":{"aspectRatio":"4/3"},"spacing":{"padding":{"right":"var:preset|spacing|40","left":"var:preset|spacing|40","top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover has-custom-content-position is-position-bottom-left" style="border-radius:4px;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><img class="wp-block-cover__image-background" alt="" src="' . sydney_pattern_image_url( 'scene-small-5.webp' ) . '" data-object-fit="cover"/><span aria-hidden="true" class="wp-block-cover__background has-global-color-6-background-color has-background-dim-60 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","fontSize":"12px","letterSpacing":"3px"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}},"color":{"text":"#ffffffbf"},"elements":{"link":{"color":{"text":"#ffffffbf"}}}}} -->
<p class="has-text-color has-link-color" style="color:#ffffffbf;margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:12px;font-style:normal;font-weight:700;letter-spacing:3px;text-transform:uppercase">E-Commerce</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffff"}}} -->
<h4 class="wp-block-heading has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0">Harvest — E-Commerce</h4>
<!-- /wp:heading --></div></div>
<!-- /wp:cover -->

<!-- wp:cover {"url":"' . sydney_pattern_image_url( 'scene-small-3.webp' ) . '","dimRatio":60,"overlayColor":"global_color_6","isUserOverlayColor":true,"contentPosition":"bottom left","style":{"border":{"radius":"4px"},"dimensions":{"aspectRatio":"4/3"},"spacing":{"padding":{"right":"var:preset|spacing|40","left":"var:preset|spacing|40","top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover has-custom-content-position is-position-bottom-left" style="border-radius:4px;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><img class="wp-block-cover__image-background" alt="" src="' . sydney_pattern_image_url( 'scene-small-3.webp' ) . '" data-object-fit="cover"/><span aria-hidden="true" class="wp-block-cover__background has-global-color-6-background-color has-background-dim-60 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","fontSize":"12px","letterSpacing":"3px"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}},"color":{"text":"#ffffffbf"},"elements":{"link":{"color":{"text":"#ffffffbf"}}}}} -->
<p class="has-text-color has-link-color" style="color:#ffffffbf;margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:12px;font-style:normal;font-weight:700;letter-spacing:3px;text-transform:uppercase">Web Design</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffff"}}} -->
<h4 class="wp-block-heading has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0">Brighton — Website Redesign</h4>
<!-- /wp:heading --></div></div>
<!-- /wp:cover -->

<!-- wp:cover {"url":"' . sydney_pattern_image_url( 'scene-small-1.webp' ) . '","dimRatio":60,"overlayColor":"global_color_6","isUserOverlayColor":true,"contentPosition":"bottom left","style":{"border":{"radius":"4px"},"dimensions":{"aspectRatio":"4/3"},"spacing":{"padding":{"right":"var:preset|spacing|40","left":"var:preset|spacing|40","top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover has-custom-content-position is-position-bottom-left" style="border-radius:4px;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><img class="wp-block-cover__image-background" alt="" src="' . sydney_pattern_image_url( 'scene-small-1.webp' ) . '" data-object-fit="cover"/><span aria-hidden="true" class="wp-block-cover__background has-global-color-6-background-color has-background-dim-60 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","fontSize":"12px","letterSpacing":"3px"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}},"color":{"text":"#ffffffbf"},"elements":{"link":{"color":{"text":"#ffffffbf"}}}}} -->
<p class="has-text-color has-link-color" style="color:#ffffffbf;margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:12px;font-style:normal;font-weight:700;letter-spacing:3px;text-transform:uppercase">Mobile</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffff"}}} -->
<h4 class="wp-block-heading has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0">Luma — Mobile App</h4>
<!-- /wp:heading --></div></div>
<!-- /wp:cover -->

<!-- wp:cover {"url":"' . sydney_pattern_image_url( 'scene-small-2.webp' ) . '","dimRatio":60,"overlayColor":"global_color_6","isUserOverlayColor":true,"contentPosition":"bottom left","style":{"border":{"radius":"4px"},"dimensions":{"aspectRatio":"4/3"},"spacing":{"padding":{"right":"var:preset|spacing|40","left":"var:preset|spacing|40","top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover has-custom-content-position is-position-bottom-left" style="border-radius:4px;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><img class="wp-block-cover__image-background" alt="" src="' . sydney_pattern_image_url( 'scene-small-2.webp' ) . '" data-object-fit="cover"/><span aria-hidden="true" class="wp-block-cover__background has-global-color-6-background-color has-background-dim-60 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","fontSize":"12px","letterSpacing":"3px"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}},"color":{"text":"#ffffffbf"},"elements":{"link":{"color":{"text":"#ffffffbf"}}}}} -->
<p class="has-text-color has-link-color" style="color:#ffffffbf;margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:12px;font-style:normal;font-weight:700;letter-spacing:3px;text-transform:uppercase">Strategy</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffff"}}} -->
<h4 class="wp-block-heading has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0">Studio Lab — Campaign</h4>
<!-- /wp:heading --></div></div>
<!-- /wp:cover --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->',
	),

	array(
		'name'       => 'sydney-pro/gallery-8',
		'title'      => __( 'Gallery 8', 'sydney' ),
		'categories' => array( 'sydney-gallery' ),
		'keywords'   => array( 'gallery', 'agency', 'digital', 'masonry' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_9","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-9-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:group {"layout":{"type":"constrained","contentSize":"768px"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"600","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}}}} -->
<p class="has-text-align-center" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:600;letter-spacing:0.1em;text-transform:uppercase">Our Work</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<h2 class="wp-block-heading has-text-align-center" style="margin-top:0;margin-bottom:0">Projects we\'re proud of.</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}},"color":{"text":"var:preset|color|global_color_5"}}} -->
<p class="has-text-align-center has-text-color" style="color:var(--wp--preset--color--global-color-5);margin-top:var(--wp--preset--spacing--30);margin-bottom:0;font-size:18px">A selection of recent work across branding, web design, and digital campaigns for ambitious clients worldwide.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:gallery {"columns":2,"linkTo":"none","align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|50","bottom":"0"},"blockGap":"var:preset|spacing|40"},"border":{"radius":"8px"}}} -->
<figure class="wp-block-gallery alignwide has-nested-images columns-2 is-cropped" style="border-radius:8px;margin-top:var(--wp--preset--spacing--50);margin-bottom:0"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-4.webp' ) . '" alt="Desk with a desktop computer by an office window" style="border-radius:8px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-5.webp' ) . '" alt="Desk with a laptop and a monitor" style="border-radius:8px"/></figure>
<!-- /wp:image --></figure>
<!-- /wp:gallery -->

<!-- wp:gallery {"columns":3,"linkTo":"none","aspectRatio":"1","align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"0"},"blockGap":"var:preset|spacing|40"},"border":{"radius":"8px"}}} -->
<figure class="wp-block-gallery alignwide has-nested-images columns-3 is-cropped" style="border-radius:8px;margin-top:var(--wp--preset--spacing--40);margin-bottom:0"><!-- wp:image {"aspectRatio":"1","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-1.webp' ) . '" alt="Team working on laptops around a wooden table" style="border-radius:8px;aspect-ratio:1"/></figure>
<!-- /wp:image -->

<!-- wp:image {"aspectRatio":"1","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-6.webp' ) . '" alt="Color swatches and design sketches on a desk" style="border-radius:8px;aspect-ratio:1"/></figure>
<!-- /wp:image -->

<!-- wp:image {"aspectRatio":"1","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="' . sydney_pattern_image_url( 'scene-small-2.webp' ) . '" alt="Person typing on a laptop" style="border-radius:8px;aspect-ratio:1"/></figure>
<!-- /wp:image --></figure>
<!-- /wp:gallery -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50","bottom":"0"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--50);margin-bottom:0"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button">View All Projects</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></section>
<!-- /wp:group -->',
	),

	// Gallery 16: staggered photo columns with an intro and a short caption under each photo.
	array(
		'name'       => 'sydney-pro/gallery-16',
		'title'      => __( 'Gallery 16', 'sydney' ),
		'categories' => array( 'sydney-gallery' ),
		'keywords'   => array( 'gallery', 'agency', 'portfolio', 'collage', 'editorial' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_9","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-9-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)"><!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|50","left":"var:preset|spacing|50"},"margin":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-columns alignwide" style="margin-top:0;margin-bottom:0"><!-- wp:column {"verticalAlignment":"top","width":"30%"} -->
<div class="wp-block-column is-vertically-aligned-top" style="flex-basis:30%"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}}},"textColor":"global_color_1"} -->
<p class="has-global-color-1-color has-text-color" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:700;letter-spacing:0.1em;text-transform:uppercase">Portfolio</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}}}} -->
<h2 class="wp-block-heading" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30)">Work with a story behind it</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|40"}}},"textColor":"global_color_5"} -->
<p class="has-global-color-5-color has-text-color" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--40)">Offices, brands and launches we shaped with our clients, from the first sketch to the opening day.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-buttons" style="margin-top:0;margin-bottom:0"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">View All Projects</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->

<!-- wp:image {"aspectRatio":"4/5","scale":"cover","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"},"spacing":{"margin":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|20"}}}} -->
<figure class="wp-block-image size-full has-custom-border" style="margin-top:var(--wp--preset--spacing--60);margin-bottom:var(--wp--preset--spacing--20)"><img src="' . sydney_pattern_image_url( 'scene-small-6.webp' ) . '" alt="Color swatches and design sketches on a desk" style="border-radius:8px;aspect-ratio:4/5;object-fit:cover"/></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"global_color_5"} -->
<p class="has-global-color-5-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:14px">Color study for a retail brand</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"40%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:40%"><!-- wp:image {"aspectRatio":"4/5","scale":"cover","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|20"}}}} -->
<figure class="wp-block-image size-full has-custom-border" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--20)"><img src="' . sydney_pattern_image_url( 'scene-large-1.webp' ) . '" alt="Woman on a phone call at her desk in a shared office" style="border-radius:8px;aspect-ratio:4/5;object-fit:cover"/></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"global_color_5"} -->
<p class="has-global-color-5-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:14px">Office fit-out for a growing studio</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"bottom","width":"30%"} -->
<div class="wp-block-column is-vertically-aligned-bottom" style="flex-basis:30%"><!-- wp:image {"aspectRatio":"3/4","scale":"cover","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|20"}}}} -->
<figure class="wp-block-image size-full has-custom-border" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--20)"><img src="' . sydney_pattern_image_url( 'scene-small-2.webp' ) . '" alt="Person typing on a laptop" style="border-radius:8px;aspect-ratio:3/4;object-fit:cover"/></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"global_color_5"} -->
<p class="has-global-color-5-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:14px">Workspace refresh for a remote team</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->',
	),
);
