<?php
/**
 * Hero Patterns
 *
 * @package sydney
 */

register_block_pattern(
	'sydney/hero-1',
	array(
		'title'      => __( 'Hero 1', 'sydney' ),
		'categories' => array( 'sydney-hero' ),
		'keywords'   => array( 'hero', 'agency', 'digital' ),
		'content'    => '<!-- wp:cover {"url":"https://images.unsplash.com/photo-1497215842964-222b430dc094?auto=format\u0026fit=crop\u0026w=1600","alt":"Digital agency workspace","dimRatio":90,"overlayColor":"global_color_6","isUserOverlayColor":true,"minHeight":70,"minHeightUnit":"vh","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"}}},"layout":{"type":"constrained"}} -->
		<div class="wp-block-cover alignfull" style="padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80);min-height:70vh"><img class="wp-block-cover__image-background" alt="Digital agency workspace" src="https://images.unsplash.com/photo-1497215842964-222b430dc094?auto=format&amp;fit=crop&amp;w=1600" data-object-fit="cover"/><span aria-hidden="true" class="wp-block-cover__background has-global-color-6-background-color has-background-dim-90 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:heading {"textAlign":"center","level":1,"style":{"color":{"text":"#ffffff"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}}}} -->
		<h1 class="wp-block-heading has-text-align-center has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:var(--wp--preset--spacing--30)">We build digital experiences that drive real growth.</h1>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"align":"center","style":{"color":{"text":"#dbdbdb"},"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|40"}}}} -->
		<p class="has-text-align-center has-text-color" style="color:#dbdbdb;margin-top:0;margin-bottom:var(--wp--preset--spacing--40);font-size:18px">From strategy to execution, we craft websites, apps, and campaigns that elevate brands and deliver measurable results. Your vision, amplified by our expertise.</p>
		<!-- /wp:paragraph -->

		<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
		<div class="wp-block-buttons" style="margin-top:0;margin-bottom:0"><!-- wp:button -->
		<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">Explore Our Work</a></div>
		<!-- /wp:button --></div>
		<!-- /wp:buttons --></div></div>
		<!-- /wp:cover -->',
	)
);

register_block_pattern(
	'sydney/hero-2',
	array(
		'title'      => __( 'Hero 2', 'sydney' ),
		'categories' => array( 'sydney-hero' ),
		'keywords'   => array( 'hero', 'agency', 'digital' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"}}},"backgroundColor":"global_color_6","layout":{"type":"constrained"}} -->
		<section class="wp-block-group alignfull has-global-color-6-background-color has-background" style="padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)"><!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60","left":"var:preset|spacing|60"},"margin":{"top":"0","bottom":"0"}}}} -->
		<div class="wp-block-columns alignwide are-vertically-aligned-center" style="margin-top:0;margin-bottom:0"><!-- wp:column {"verticalAlignment":"center"} -->
		<div class="wp-block-column is-vertically-aligned-center"><!-- wp:heading {"level":1,"style":{"color":{"text":"#ffffff"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}}}} -->
		<h1 class="wp-block-heading has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:var(--wp--preset--spacing--30)">We build digital experiences that drive real growth.</h1>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"style":{"color":{"text":"#dbdbdb"},"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|40"}}}} -->
		<p class="has-text-color" style="color:#dbdbdb;margin-top:0;margin-bottom:var(--wp--preset--spacing--40);font-size:18px">From strategy to execution, we craft websites, apps, and campaigns that elevate brands and deliver measurable results. Your vision, amplified by our expertise.</p>
		<!-- /wp:paragraph -->

		<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","justifyContent":"left"}} -->
		<div class="wp-block-buttons" style="margin-top:0;margin-bottom:0"><!-- wp:button -->
		<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">Explore Our Work</a></div>
		<!-- /wp:button --></div>
		<!-- /wp:buttons --></div>
		<!-- /wp:column -->

		<!-- wp:column {"verticalAlignment":"center"} -->
		<div class="wp-block-column is-vertically-aligned-center"><!-- wp:image {"sizeSlug":"large","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
		<figure class="wp-block-image size-large has-custom-border"><img src="https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?q=80&amp;w=1355&amp;auto=format&amp;fit=crop" alt="Digital agency workspace" style="border-radius:8px"/></figure>
		<!-- /wp:image --></div>
		<!-- /wp:column --></div>
		<!-- /wp:columns --></section>
		<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/hero-3',
	array(
		'title'      => __( 'Hero 3', 'sydney' ),
		'categories' => array( 'sydney-hero' ),
		'keywords'   => array( 'hero', 'agency', 'digital' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"}}},"backgroundColor":"global_color_6","layout":{"type":"constrained"}} -->
		<section class="wp-block-group alignfull has-global-color-6-background-color has-background" style="padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)"><!-- wp:heading {"textAlign":"center","level":1,"style":{"color":{"text":"#ffffff"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}}}} -->
		<h1 class="wp-block-heading has-text-align-center has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:var(--wp--preset--spacing--30)">We build digital experiences that drive real growth.</h1>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"align":"center","style":{"color":{"text":"#dbdbdb"},"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|40"}}}} -->
		<p class="has-text-align-center has-text-color" style="color:#dbdbdb;margin-top:0;margin-bottom:var(--wp--preset--spacing--40);font-size:18px">From strategy to execution, we craft websites, apps, and campaigns that elevate brands and deliver measurable results. Your vision, amplified by our expertise.</p>
		<!-- /wp:paragraph -->

		<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
		<div class="wp-block-buttons" style="margin-top:0;margin-bottom:0"><!-- wp:button -->
		<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">Explore Our Work</a></div>
		<!-- /wp:button --></div>
		<!-- /wp:buttons -->

		<!-- wp:image {"sizeSlug":"large","linkDestination":"none","align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}},"border":{"radius":"8px"}}} -->
		<figure class="wp-block-image alignwide size-large has-custom-border" style="margin-top:var(--wp--preset--spacing--50)"><img src="https://images.unsplash.com/photo-1758873271824-a3216c80d1ac?q=80&amp;w=3132&amp;auto=format&amp;fit=crop" alt="Digital agency workspace" style="border-radius:8px"/></figure>
		<!-- /wp:image --></section>
		<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/hero-4',
	array(
		'title'      => __( 'Hero 4', 'sydney' ),
		'categories' => array( 'sydney-hero' ),
		'keywords'   => array( 'hero', 'agency', 'digital' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"}}},"backgroundColor":"global_color_7","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-7-background-color has-background" style="padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)"><!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60","left":"var:preset|spacing|60"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20","margin":{"top":"0","bottom":"var:preset|spacing|30"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30)"><!-- wp:group {"style":{"spacing":{"blockGap":"0","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:image {"width":"40px","height":"40px","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"9999px","width":"2px","color":"#ffffff"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border" style="margin-top:0;margin-bottom:0"><img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Client" class="has-border-color" style="border-color:#ffffff;border-width:2px;border-radius:9999px;width:40px;height:40px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"width":"40px","height":"40px","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"9999px","width":"2px","color":"#ffffff"},"spacing":{"margin":{"left":"-12px","bottom":"0"}}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border" style="margin-bottom:0;margin-left:-12px"><img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Client" class="has-border-color" style="border-color:#ffffff;border-width:2px;border-radius:9999px;width:40px;height:40px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"width":"40px","height":"40px","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"9999px","width":"2px","color":"#ffffff"},"spacing":{"margin":{"left":"-12px","bottom":"0"}}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border" style="margin-bottom:0;margin-left:-12px"><img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Client" class="has-border-color" style="border-color:#ffffff;border-width:2px;border-radius:9999px;width:40px;height:40px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"width":"40px","height":"40px","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"9999px","width":"2px","color":"#ffffff"},"spacing":{"margin":{"left":"-12px","bottom":"0"}}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border" style="margin-bottom:0;margin-left:-12px"><img src="https://randomuser.me/api/portraits/men/75.jpg" alt="Client" class="has-border-color" style="border-color:#ffffff;border-width:2px;border-radius:9999px;width:40px;height:40px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"color":{"text":"#6d7685"},"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-color" style="color:#6d7685;margin-top:0;margin-bottom:0;font-size:14px">Trusted by <strong><span style="color:#00102E">500+</span></strong> brands worldwide</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:heading {"level":1,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}}}} -->
<h1 class="wp-block-heading" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30)">We build digital experiences that drive real growth.</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|40"}}}} -->
<p style="margin-top:0;margin-bottom:var(--wp--preset--spacing--40);font-size:18px">From strategy to execution, we craft websites, apps, and campaigns that elevate brands and deliver measurable results. Your vision, amplified by our expertise.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","justifyContent":"left"}} -->
<div class="wp-block-buttons" style="margin-top:0;margin-bottom:0"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">Explore Our Work</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:image {"sizeSlug":"large","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-large has-custom-border"><img src="https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?q=80&amp;w=1355&amp;auto=format&amp;fit=crop&amp;ixlib=rb-4.1.0&amp;ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Digital agency workspace" style="border-radius:8px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->',
	)
);


register_block_pattern(
	'sydney/hero-5',
	array(
		'title'      => __( 'Hero 5', 'sydney' ),
		'categories' => array( 'sydney-hero' ),
		'keywords'   => array( 'hero', 'agency', 'digital' ),
		'content'    => '<!-- wp:cover {"url":"https://images.unsplash.com/photo-1497215842964-222b430dc094?auto=format\u0026fit=crop\u0026w=1600","alt":"Digital agency workspace","dimRatio":90,"overlayColor":"global_color_6","isUserOverlayColor":true,"minHeight":80,"minHeightUnit":"vh","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover alignfull" style="padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80);min-height:80vh"><img class="wp-block-cover__image-background" alt="Digital agency workspace" src="https://images.unsplash.com/photo-1497215842964-222b430dc094?auto=format&amp;fit=crop&amp;w=1600" data-object-fit="cover"/><span aria-hidden="true" class="wp-block-cover__background has-global-color-6-background-color has-background-dim-90 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20","margin":{"top":"0","bottom":"var:preset|spacing|30"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center","justifyContent":"center"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30)"><!-- wp:group {"style":{"spacing":{"blockGap":"0","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:image {"width":"40px","height":"40px","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"9999px","width":"2px","color":"#ffffff"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border" style="margin-top:0;margin-bottom:0"><img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Client" class="has-border-color" style="border-color:#ffffff;border-width:2px;border-radius:9999px;width:40px;height:40px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"width":"40px","height":"40px","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"9999px","width":"2px","color":"#ffffff"},"spacing":{"margin":{"left":"-12px","bottom":"0"}}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border" style="margin-bottom:0;margin-left:-12px"><img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Client" class="has-border-color" style="border-color:#ffffff;border-width:2px;border-radius:9999px;width:40px;height:40px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"width":"40px","height":"40px","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"9999px","width":"2px","color":"#ffffff"},"spacing":{"margin":{"left":"-12px","bottom":"0"}}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border" style="margin-bottom:0;margin-left:-12px"><img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Client" class="has-border-color" style="border-color:#ffffff;border-width:2px;border-radius:9999px;width:40px;height:40px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"width":"40px","height":"40px","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"9999px","width":"2px","color":"#ffffff"},"spacing":{"margin":{"left":"-12px","bottom":"0"}}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border" style="margin-bottom:0;margin-left:-12px"><img src="https://randomuser.me/api/portraits/men/75.jpg" alt="Client" class="has-border-color" style="border-color:#ffffff;border-width:2px;border-radius:9999px;width:40px;height:40px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"white"} -->
<p class="has-white-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:14px">Trusted by <strong><span>500+</span></strong> brands worldwide</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:heading {"textAlign":"center","level":1,"style":{"color":{"text":"#ffffff"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}}}} -->
<h1 class="wp-block-heading has-text-align-center has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:var(--wp--preset--spacing--30)">We build digital experiences that drive real growth.</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"color":{"text":"#dbdbdb"},"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|40"}}}} -->
<p class="has-text-align-center has-text-color" style="color:#dbdbdb;margin-top:0;margin-bottom:var(--wp--preset--spacing--40);font-size:18px">From strategy to execution, we craft websites, apps, and campaigns that elevate brands and deliver measurable results. Your vision, amplified by our expertise.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons" style="margin-top:0;margin-bottom:0"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">Explore Our Work</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline","style":{"color":{"text":"#ffffff"},"elements":{"link":{"color":{"text":"#ffffff"}}}}} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link has-text-color has-link-color wp-element-button" href="#" style="color:#ffffff">Book a Call</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></div>
<!-- /wp:cover -->',
	)
);

register_block_pattern(
	'sydney/hero-6',
	array(
		'title'      => __( 'Hero 6', 'sydney' ),
		'categories' => array( 'sydney-hero' ),
		'keywords'   => array( 'hero', 'agency', 'digital' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)"><!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60","left":"var:preset|spacing|60"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:heading {"level":1,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}}}} -->
<h1 class="wp-block-heading" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30)">We build digital experiences that <span style="color:var(--sydney-global-color-1">drive real growth.</span></h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|40"}}}} -->
<p style="margin-top:0;margin-bottom:var(--wp--preset--spacing--40);font-size:18px">From strategy to execution, we craft websites, apps, and campaigns that elevate brands and deliver measurable results. Your vision, amplified by our expertise.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","justifyContent":"left"}} -->
<div class="wp-block-buttons" style="margin-top:0;margin-bottom:0"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">Explore Our Work</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline","style":{"color":{"text":"#00102E"},"elements":{"link":{"color":{"text":"#00102E"}}}}} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link has-text-color has-link-color wp-element-button" href="#" style="color:#00102E">Book a Call</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->

<!-- wp:columns {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40"},"blockGap":{"top":"var:preset|spacing|30","left":"var:preset|spacing|30"},"padding":{"top":"var:preset|spacing|30"}},"border":{"top":{"color":"var:preset|color|global_color_8","width":"1px"},"right":{"width":"0px","style":"none"},"bottom":{"width":"0px","style":"none"},"left":{"width":"0px","style":"none"}}}} -->
<div class="wp-block-columns" style="border-top-color:var(--wp--preset--color--global-color-8);border-top-width:1px;border-right-style:none;border-right-width:0px;border-bottom-style:none;border-bottom-width:0px;border-left-style:none;border-left-width:0px;margin-top:var(--wp--preset--spacing--40);padding-top:var(--wp--preset--spacing--30)"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"style":{"typography":{"fontSize":"36px","fontStyle":"normal","fontWeight":"700"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"global_color_1"} -->
<p class="has-global-color-1-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:36px;font-style:normal;font-weight:700">12+</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"color":{"text":"#6d7685"},"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-color" style="color:#6d7685;margin-top:0;margin-bottom:0;font-size:14px">Years in Business</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"style":{"border":{"left":{"color":"var:preset|color|global_color_8","width":"1px"},"top":{},"right":{},"bottom":{}},"spacing":{"padding":{"left":"var:preset|spacing|50"}}}} -->
<div class="wp-block-column" style="border-left-color:var(--wp--preset--color--global-color-8);border-left-width:1px;padding-left:var(--wp--preset--spacing--50)"><!-- wp:paragraph {"style":{"typography":{"fontSize":"36px","fontStyle":"normal","fontWeight":"700"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"global_color_1"} -->
<p class="has-global-color-1-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:36px;font-style:normal;font-weight:700">500+</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"color":{"text":"#6d7685"},"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-color" style="color:#6d7685;margin-top:0;margin-bottom:0;font-size:14px">Projects Delivered</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"style":{"border":{"left":{"color":"var:preset|color|global_color_8","width":"1px"},"top":{},"right":{},"bottom":{}},"spacing":{"padding":{"left":"var:preset|spacing|50"}}}} -->
<div class="wp-block-column" style="border-left-color:var(--wp--preset--color--global-color-8);border-left-width:1px;padding-left:var(--wp--preset--spacing--50)"><!-- wp:paragraph {"style":{"typography":{"fontSize":"36px","fontStyle":"normal","fontWeight":"700"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"global_color_1"} -->
<p class="has-global-color-1-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:36px;font-style:normal;font-weight:700">98%</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"color":{"text":"#6d7685"},"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-color" style="color:#6d7685;margin-top:0;margin-bottom:0;font-size:14px">Client Satisfaction</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:image {"sizeSlug":"large","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-large has-custom-border"><img src="https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?q=80&amp;w=1355&amp;auto=format&amp;fit=crop&amp;ixlib=rb-4.1.0&amp;ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Digital agency workspace" style="border-radius:8px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/hero-7',
	array(
		'title'      => __( 'Hero 7', 'sydney' ),
		'categories' => array( 'sydney-hero' ),
		'keywords'   => array( 'hero', 'agency', 'digital' ),
		'content'    => '<!-- wp:cover {"url":"https://images.unsplash.com/photo-1542744173-8e7e53415bb0?q=80\u0026w=1600\u0026auto=format\u0026fit=crop","alt":"Digital agency workspace","dimRatio":80,"overlayColor":"global_color_6","isUserOverlayColor":true,"focalPoint":{"x":0.5,"y":0.5},"minHeight":80,"minHeightUnit":"vh","contentPosition":"bottom center","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover alignfull has-custom-content-position is-position-bottom-center" style="padding-top:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30);min-height:80vh"><img class="wp-block-cover__image-background" alt="Digital agency workspace" src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?q=80&amp;w=1600&amp;auto=format&amp;fit=crop" style="object-position:50% 50%" data-object-fit="cover" data-object-position="50% 50%"/><span aria-hidden="true" class="wp-block-cover__background has-global-color-6-background-color has-background-dim-80 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:group {"align":"wide","layout":{"type":"flex","orientation":"vertical","verticalAlignment":"bottom","justifyContent":"left"}} -->
<div class="wp-block-group alignwide"><!-- wp:group {"layout":{"type":"constrained","contentSize":"750px","justifyContent":"left","wideSize":"750px"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20","margin":{"top":"0","bottom":"var:preset|spacing|30"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center","justifyContent":"left"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30)"><!-- wp:group {"style":{"spacing":{"blockGap":"0","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:image {"width":"40px","height":"40px","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"9999px","width":"2px","color":"#ffffff"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border" style="margin-top:0;margin-bottom:0"><img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Client" class="has-border-color" style="border-color:#ffffff;border-width:2px;border-radius:9999px;width:40px;height:40px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"width":"40px","height":"40px","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"9999px","width":"2px","color":"#ffffff"},"spacing":{"margin":{"left":"-12px","bottom":"0"}}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border" style="margin-bottom:0;margin-left:-12px"><img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Client" class="has-border-color" style="border-color:#ffffff;border-width:2px;border-radius:9999px;width:40px;height:40px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"width":"40px","height":"40px","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"9999px","width":"2px","color":"#ffffff"},"spacing":{"margin":{"left":"-12px","bottom":"0"}}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border" style="margin-bottom:0;margin-left:-12px"><img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Client" class="has-border-color" style="border-color:#ffffff;border-width:2px;border-radius:9999px;width:40px;height:40px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"width":"40px","height":"40px","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"9999px","width":"2px","color":"#ffffff"},"spacing":{"margin":{"left":"-12px","bottom":"0"}}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border" style="margin-bottom:0;margin-left:-12px"><img src="https://randomuser.me/api/portraits/men/75.jpg" alt="Client" class="has-border-color" style="border-color:#ffffff;border-width:2px;border-radius:9999px;width:40px;height:40px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"white"} -->
<p class="has-white-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:14px">Trusted by <strong><span>500+</span></strong> brands worldwide</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:heading {"level":1,"style":{"color":{"text":"#ffffff"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|40"}}}} -->
<h1 class="wp-block-heading has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:var(--wp--preset--spacing--40)">We build digital experiences that drive real growth.</h1>
<!-- /wp:heading -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","justifyContent":"left"}} -->
<div class="wp-block-buttons" style="margin-top:0;margin-bottom:0"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">Explore Our Work</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline","style":{"color":{"text":"#ffffff"},"elements":{"link":{"color":{"text":"#ffffff"}}}}} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link has-text-color has-link-color wp-element-button" href="#" style="color:#ffffff">Book a Call</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover -->',
	)
);

// Hero 1 — Left-aligned cover with contact info bar below.
register_block_pattern(
	'sydney/hero-8',
	array(
		'title'      => __( 'Hero 8', 'sydney' ),
		'categories' => array( 'sydney-hero' ),
		'keywords'   => array( 'hero', 'agency' ),
		'content'    => '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"blockGap":"0","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","wideSize":"","contentSize":"100%"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:cover {"url":"https://images.unsplash.com/photo-1553877522-43269d4ea984?auto=format\u0026fit=crop\u0026w=1600","dimRatio":80,"customOverlayColor":"#111111","isUserOverlayColor":true,"minHeight":70,"minHeightUnit":"vh","contentPosition":"center center","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50);min-height:70vh"><img class="wp-block-cover__image-background" alt="" src="https://images.unsplash.com/photo-1553877522-43269d4ea984?auto=format&amp;fit=crop&amp;w=1600" data-object-fit="cover"/><span aria-hidden="true" class="wp-block-cover__background has-background-dim-80 has-background-dim" style="background-color:#111111"></span><div class="wp-block-cover__inner-container"><!-- wp:group {"align":"wide","layout":{"type":"constrained","justifyContent":"left"}} -->
<div class="wp-block-group alignwide"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","fontSize":"14px","letterSpacing":"0.3em"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}},"color":{"text":"#ffffff"}}} -->
<p class="has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:700;letter-spacing:0.3em;text-transform:uppercase">We Build for Ambitious Brands</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":1,"style":{"color":{"text":"#ffffff"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}}}} -->
<h1 class="wp-block-heading has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:var(--wp--preset--spacing--30)">Strategic Thinking.<br>Measurable Results.</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|50"}},"color":{"text":"#dbdbdb"}}} -->
<p class="has-text-color" style="color:#dbdbdb;margin-top:0;margin-bottom:var(--wp--preset--spacing--50);font-size:18px">We partner with forward-thinking organizations to craft strategies and digital products that perform. Built for impact, delivered on time.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-buttons" style="margin-top:0;margin-bottom:0"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">Get Started</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover -->

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|30","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}},"border":{"top":{"color":"#333333","width":"1px"},"right":[],"bottom":[],"left":[]},"color":{"background":"#111111"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-background" style="border-top-color:#333333;border-top-width:1px;background-color:#111111;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--50)"><!-- wp:columns {"align":"wide","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"blockGap":{"top":"0"}}}} -->
<div class="wp-block-columns alignwide" style="margin-top:0;margin-bottom:0"><!-- wp:column {"verticalAlignment":"center","style":{"spacing":{"padding":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-column is-vertically-aligned-center" style="padding-top:0;padding-bottom:0"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"12px","bottom":"12px","left":"12px","right":"12px"}},"color":{"background":"var:preset|color|global_color_1"},"border":{"radius":"50%"},"layout":{"selfStretch":"fit","flexSize":null}},"backgroundColor":"global_color_1","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-radius:50%;background-color:var(--wp--preset--color--global-color-1);margin-top:0;margin-bottom:0;padding-top:12px;padding-right:12px;padding-bottom:12px;padding-left:12px"><!-- wp:image {"width":"24px","height":"24px","sizeSlug":"full","linkDestination":"none","className":"is-resized"} -->
<figure class="wp-block-image size-full is-resized"><img src="data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 fill=%27none%27 viewBox=%270 0 24 24%27 stroke-width=%271.5%27 stroke=%27%23ffffff%27%3E%3Cpath stroke-linecap=%27round%27 stroke-linejoin=%27round%27 d=%27M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z%27 /%3E%3C/svg%3E" alt="Phone icon" style="width:24px;height:24px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"600"},"color":{"text":"#ffffff"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0;font-style:normal;font-weight:600">Need Our Services?</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffffa6"}}} -->
<p class="has-text-color" style="color:#ffffffa6;margin-top:0;margin-bottom:0;font-size:14px">Call: (123) 456-7890</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"style":{"spacing":{"padding":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-column" style="padding-top:0;padding-bottom:0"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"12px","bottom":"12px","left":"12px","right":"12px"}},"color":{"background":"var:preset|color|global_color_1"},"border":{"radius":"50%"},"layout":{"selfStretch":"fit","flexSize":null}},"backgroundColor":"global_color_1","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-radius:50%;background-color:var(--wp--preset--color--global-color-1);margin-top:0;margin-bottom:0;padding-top:12px;padding-right:12px;padding-bottom:12px;padding-left:12px"><!-- wp:image {"width":"32px","height":"32px","sizeSlug":"full","linkDestination":"none","className":"is-resized"} -->
<figure class="wp-block-image size-full is-resized"><img src="data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 fill=%27none%27 viewBox=%270 0 24 24%27 stroke-width=%272%27 stroke=%27%23ffffff%27%3E%3Cpath stroke-linecap=%27round%27 stroke-linejoin=%27round%27 d=%27M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z%27/%3E%3C/svg%3E" alt="Clock" style="width:32px;height:32px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"600"},"color":{"text":"#ffffff"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0;font-style:normal;font-weight:600">Working Hours</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffffa6"}}} -->
<p class="has-text-color" style="color:#ffffffa6;margin-top:0;margin-bottom:0;font-size:14px">Mon–Fri 9:00 AM – 6:00 PM</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"style":{"spacing":{"padding":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-column" style="padding-top:0;padding-bottom:0"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"12px","bottom":"12px","left":"12px","right":"12px"}},"color":{"background":"var:preset|color|global_color_1"},"border":{"radius":"50%"},"layout":{"selfStretch":"fit","flexSize":null}},"backgroundColor":"global_color_1","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-radius:50%;background-color:var(--wp--preset--color--global-color-1);margin-top:0;margin-bottom:0;padding-top:12px;padding-right:12px;padding-bottom:12px;padding-left:12px"><!-- wp:image {"width":"24px","height":"24px","sizeSlug":"full","linkDestination":"none","className":"is-resized"} -->
<figure class="wp-block-image size-full is-resized"><img src="data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 fill=%27none%27 viewBox=%270 0 24 24%27 stroke-width=%271.5%27 stroke=%27%23ffffff%27%3E%3Cpath stroke-linecap=%27round%27 stroke-linejoin=%27round%27 d=%27M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75%27 /%3E%3C/svg%3E" alt="Email icon" style="width:24px;height:24px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"600"},"color":{"text":"#ffffff"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0;font-style:normal;font-weight:600">Email Us</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffffa6"}}} -->
<p class="has-text-color" style="color:#ffffffa6;margin-top:0;margin-bottom:0;font-size:14px">hello@example.com</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->',
	)
);

// Hero 2 — Centered cover with two buttons and slim contact strip below.
register_block_pattern(
	'sydney/hero-9',
	array(
		'title'      => __( 'Hero 9', 'sydney' ),
		'categories' => array( 'sydney-hero' ),
		'keywords'   => array( 'hero', 'agency' ),
		'content'    => '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"blockGap":"0","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","wideSize":"100%"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:cover {"url":"https://images.unsplash.com/photo-1515378791036-0648a3ef77b2?auto=format\u0026fit=crop\u0026w=1600","dimRatio":70,"customOverlayColor":"#111111","isUserOverlayColor":true,"minHeight":75,"minHeightUnit":"vh","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80","left":"var:preset|spacing|50","right":"var:preset|spacing|50"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--80);padding-left:var(--wp--preset--spacing--50);min-height:75vh"><img class="wp-block-cover__image-background" alt="" src="https://images.unsplash.com/photo-1515378791036-0648a3ef77b2?auto=format&amp;fit=crop&amp;w=1600" data-object-fit="cover"/><span aria-hidden="true" class="wp-block-cover__background has-background-dim-70 has-background-dim" style="background-color:#111111"></span><div class="wp-block-cover__inner-container"><!-- wp:group {"align":"wide","layout":{"type":"constrained","contentSize":"768px"}} -->
<div class="wp-block-group alignwide"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","fontSize":"14px","letterSpacing":"0.3em"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}}},"textColor":"white"} -->
<p class="has-text-align-center has-white-color has-text-color" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:700;letter-spacing:0.3em;text-transform:uppercase">We Build for Ambitious Brands</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","level":1,"style":{"color":{"text":"#ffffff"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}}}} -->
<h1 class="wp-block-heading has-text-align-center has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:var(--wp--preset--spacing--30)">Strategic Thinking.<br>Measurable Results.</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|50"}},"color":{"text":"#dbdbdb"}}} -->
<p class="has-text-align-center has-text-color" style="color:#dbdbdb;margin-top:0;margin-bottom:var(--wp--preset--spacing--50);font-size:18px">We partner with forward-thinking organizations to craft strategies and digital products that perform. Built for impact, delivered on time.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons" style="margin-top:0;margin-bottom:0"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">Get Started</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline","style":{"color":{"text":"#ffffff"},"elements":{"link":{"color":{"text":"#ffffff"}}}}} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link has-text-color has-link-color wp-element-button" href="#" style="color:#ffffff">Our Services</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover -->

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|50","right":"var:preset|spacing|50"},"margin":{"top":"0","bottom":"0"}},"border":{"top":{"color":"#333333","width":"1px"},"right":[],"bottom":[],"left":[]},"color":{"background":"#111111"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-background" style="border-top-color:#333333;border-top-width:1px;background-color:#111111;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--50)"><!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|60","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center"}} -->
<div class="wp-block-group alignwide" style="margin-top:0;margin-bottom:0"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:image {"width":"24px","height":"24px","sizeSlug":"full","linkDestination":"none","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 fill=%27none%27 viewBox=%270 0 24 24%27 stroke-width=%272%27 stroke=%27%23ffffff%27%3E%3Cpath stroke-linecap=%27round%27 stroke-linejoin=%27round%27 d=%27M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z%27/%3E%3C/svg%3E" alt="Phone" style="width:24px;height:24px"/></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"style":{"color":{"text":"#ffffffa6"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-color" style="color:#ffffffa6;margin-top:0;margin-bottom:0">(123) 456-7890</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:image {"width":"24px","height":"24px","sizeSlug":"full","linkDestination":"none","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 fill=%27none%27 viewBox=%270 0 24 24%27 stroke-width=%272%27 stroke=%27%23ffffff%27%3E%3Cpath stroke-linecap=%27round%27 stroke-linejoin=%27round%27 d=%27M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z%27/%3E%3C/svg%3E" alt="Clock" style="width:24px;height:24px"/></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"style":{"color":{"text":"#ffffffa6"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-color" style="color:#ffffffa6;margin-top:0;margin-bottom:0">Mon–Fri 9:00 AM – 6:00 PM</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:image {"width":"24px","height":"24px","sizeSlug":"full","linkDestination":"none","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 fill=%27none%27 viewBox=%270 0 24 24%27 stroke-width=%272%27 stroke=%27%23ffffff%27%3E%3Cpath stroke-linecap=%27round%27 stroke-linejoin=%27round%27 d=%27M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75%27/%3E%3C/svg%3E" alt="Email" style="width:24px;height:24px"/></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"style":{"color":{"text":"#ffffffa6"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-color" style="color:#ffffffa6;margin-top:0;margin-bottom:0">hello@example.com</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->',
	)
);

// Hero 3 — Left-aligned cover with gradient overlay and floating contact cards below.
register_block_pattern(
	'sydney/hero-10',
	array(
		'title'      => __( 'Hero 10', 'sydney' ),
		'categories' => array( 'sydney-hero' ),
		'keywords'   => array( 'hero', 'agency' ),
		'content'    => '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"blockGap":"0"}},"layout":{"type":"constrained","wideSize":"","contentSize":"100%"}} -->
<div class="wp-block-group alignfull" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:cover {"url":"https://images.unsplash.com/photo-1515378791036-0648a3ef77b2?auto=format\u0026fit=crop\u0026w=1600","dimRatio":70,"customOverlayColor":"#111111","isUserOverlayColor":true,"minHeight":60,"minHeightUnit":"vh","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover alignfull" style="padding-top:var(--wp--preset--spacing--80);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--80);padding-left:var(--wp--preset--spacing--50);min-height:60vh"><img class="wp-block-cover__image-background" alt="" src="https://images.unsplash.com/photo-1515378791036-0648a3ef77b2?auto=format&amp;fit=crop&amp;w=1600" data-object-fit="cover"/><span aria-hidden="true" class="wp-block-cover__background has-background-dim-70 has-background-dim" style="background-color:#111111"></span><div class="wp-block-cover__inner-container"><!-- wp:group {"align":"wide","layout":{"type":"constrained","justifyContent":"left"}} -->
<div class="wp-block-group alignwide"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","fontSize":"14px","letterSpacing":"0.3em"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}}},"textColor":"white"} -->
<p class="has-white-color has-text-color" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:700;letter-spacing:0.3em;text-transform:uppercase">We Build for Ambitious Brands</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":1,"style":{"color":{"text":"#ffffff"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}}}} -->
<h1 class="wp-block-heading has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:var(--wp--preset--spacing--30)">Strategic Thinking.<br>Measurable Results.</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|50"}},"color":{"text":"#dbdbdb"}}} -->
<p class="has-text-color" style="color:#dbdbdb;margin-top:0;margin-bottom:var(--wp--preset--spacing--50);font-size:18px">We partner with forward-thinking organizations to craft strategies and digital products that perform. Built for impact, delivered on time.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-buttons" style="margin-top:0;margin-bottom:0"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">Get Started</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover -->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"top":"-10vh","bottom":"0"},"blockGap":"var:preset|spacing|40","padding":{"top":"0","bottom":"0"}}},"layout":{"type":"grid","columnCount":3}} -->
<div class="wp-block-group alignwide" style="margin-top:-10vh;margin-bottom:0;padding-top:0;padding-bottom:0"><!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|20","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}},"border":{"radius":"8px"},"color":{"background":"#111111"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group has-background" style="border-radius:8px;background-color:#111111;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--20);padding-left:var(--wp--preset--spacing--40)"><!-- wp:image {"width":"24px","height":"24px","sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full is-resized"><img src="data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 fill=%27none%27 viewBox=%270 0 24 24%27 stroke-width=%272%27 stroke=%27%23ffffff%27%3E%3Cpath stroke-linecap=%27round%27 stroke-linejoin=%27round%27 d=%27M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z%27/%3E%3C/svg%3E" alt="Phone" style="width:24px;height:24px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"600"},"color":{"text":"#ffffff"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0;font-style:normal;font-weight:600">Need Our Services?</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffffa6"}}} -->
<p class="has-text-color" style="color:#ffffffa6;margin-top:0;margin-bottom:0;font-size:14px">Call: (123) 456-7890</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|20","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}},"border":{"radius":"8px"},"color":{"background":"#111111"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group has-background" style="border-radius:8px;background-color:#111111;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--20);padding-left:var(--wp--preset--spacing--40)"><!-- wp:image {"width":"24px","height":"24px","sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full is-resized"><img src="data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 fill=%27none%27 viewBox=%270 0 24 24%27 stroke-width=%272%27 stroke=%27%23ffffff%27%3E%3Cpath stroke-linecap=%27round%27 stroke-linejoin=%27round%27 d=%27M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z%27/%3E%3C/svg%3E" alt="Clock" style="width:24px;height:24px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"600"},"color":{"text":"#ffffff"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0;font-style:normal;font-weight:600">Working Hours</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffffa6"}}} -->
<p class="has-text-color" style="color:#ffffffa6;margin-top:0;margin-bottom:0;font-size:14px">Mon–Fri 9:00 AM – 6:00 PM</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|20","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}},"border":{"radius":"8px"},"color":{"background":"#111111"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group has-background" style="border-radius:8px;background-color:#111111;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--20);padding-left:var(--wp--preset--spacing--40)"><!-- wp:image {"width":"24px","height":"24px","sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full is-resized"><img src="data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 fill=%27none%27 viewBox=%270 0 24 24%27 stroke-width=%272%27 stroke=%27%23ffffff%27%3E%3Cpath stroke-linecap=%27round%27 stroke-linejoin=%27round%27 d=%27M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75%27/%3E%3C/svg%3E" alt="Email" style="width:24px;height:24px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"600"},"color":{"text":"#ffffff"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0;font-style:normal;font-weight:600">Email Us</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffffa6"}}} -->
<p class="has-text-color" style="color:#ffffffa6;margin-top:0;margin-bottom:0;font-size:14px">hello@example.com</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->',
	)
);

// Decorative ornament SVG data URI — shared across all construction-industrial patterns.
$sydney_construction_ornament = "";

register_block_pattern(
	'sydney/hero-11',
	array(
		'title'      => __( 'Hero 11', 'sydney' ),
		'categories' => array( 'sydney-hero' ),
		'keywords'   => array( 'hero', 'agency' ),
		'content'    => '<!-- wp:group {"align":"full","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull"><!-- wp:media-text {"align":"full","mediaType":"image","verticalAlignment":"center","imageFill":true,"style":{"spacing":{"padding":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_7"} -->
<div class="wp-block-media-text alignfull is-stacked-on-mobile is-vertically-aligned-center is-image-fill-element has-global-color-7-background-color has-background" style="padding-top:0;padding-bottom:0"><figure class="wp-block-media-text__media"><img src="https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&amp;fit=crop&amp;w=1600" alt="Agency workspace" style="object-position:50% 50%"/></figure><div class="wp-block-media-text__content"><!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--60);margin-bottom:var(--wp--preset--spacing--60)"><!-- wp:heading {"level":1,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}}}} -->
<h1 class="wp-block-heading" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30)">We Build What Lasts</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|60"}}}} -->
<p style="margin-top:0;margin-bottom:var(--wp--preset--spacing--60);font-size:18px">Award-winning agency delivering strategy, design, and digital products that move the needle for ambitious brands.</p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","letterSpacing":"3px","fontSize":"12px"},"color":{"text":"#6d7685"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-color" style="color:#6d7685;margin-top:0;margin-bottom:0;font-size:12px;letter-spacing:3px;text-transform:uppercase">established</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"700","fontSize":"48px"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0;font-size:48px;font-style:normal;font-weight:700">2009</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-buttons" style="margin-top:0;margin-bottom:0"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">Learn more</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div></div>
<!-- /wp:media-text --></div>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/hero-12',
	array(
		'title'      => __( 'Hero 12', 'sydney' ),
		'categories' => array( 'sydney-hero' ),
		'keywords'   => array( 'hero', 'agency' ),
		'content'    => '<!-- wp:group {"align":"full","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull"><!-- wp:media-text {"align":"full","mediaPosition":"right","mediaType":"image","mediaWidth":58,"verticalAlignment":"center","imageFill":true} -->
<div class="wp-block-media-text alignfull has-media-on-the-right is-stacked-on-mobile is-vertically-aligned-center is-image-fill-element" style="grid-template-columns:auto 58%"><div class="wp-block-media-text__content"><!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--60);margin-bottom:var(--wp--preset--spacing--60)"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","letterSpacing":"3px","fontSize":"12px"},"color":{"text":"#6d7685"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}}}} -->
<p class="has-text-color" style="color:#6d7685;margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:12px;letter-spacing:3px;text-transform:uppercase">Since 2009</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":1,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}}}} -->
<h1 class="wp-block-heading" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30)">We Build What Lasts</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|40"}}}} -->
<p style="margin-top:0;margin-bottom:var(--wp--preset--spacing--40);font-size:18px">Award-winning agency delivering strategy, design, and digital products that move the needle for ambitious brands.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-buttons" style="margin-top:0;margin-bottom:0"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">Get Started</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50","bottom":"0"},"padding":{"top":"var:preset|spacing|40"},"blockGap":"var:preset|spacing|50"},"border":{"top":{"color":"#dbdbdb","width":"1px"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"left"}} -->
<div class="wp-block-group" style="border-top-color:#dbdbdb;border-top-width:1px;margin-top:var(--wp--preset--spacing--50);margin-bottom:0;padding-top:var(--wp--preset--spacing--40)"><!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"700","fontSize":"30px"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0;font-size:30px;font-style:normal;font-weight:700">500+</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"color":{"text":"#6d7685"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-color" style="color:#6d7685;margin-top:0;margin-bottom:0;font-size:14px">Projects</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"700","fontSize":"30px"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0;font-size:30px;font-style:normal;font-weight:700">15+</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"color":{"text":"#6d7685"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-color" style="color:#6d7685;margin-top:0;margin-bottom:0;font-size:14px">Years</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"700","fontSize":"30px"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0;font-size:30px;font-style:normal;font-weight:700">98%</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"color":{"text":"#6d7685"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-color" style="color:#6d7685;margin-top:0;margin-bottom:0;font-size:14px">Satisfaction</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div><figure class="wp-block-media-text__media"><img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&amp;fit=crop&amp;w=1600" alt="Agency workspace" style="object-position:50% 50%"/></figure></div>
<!-- /wp:media-text --></div>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/hero-13',
	array(
		'title'      => __( 'Hero 13', 'sydney' ),
		'categories' => array( 'sydney-hero' ),
		'keywords'   => array( 'hero', 'agency' ),
		'content'    => '<!-- wp:cover {"dimRatio":0,"minHeight":85,"minHeightUnit":"vh","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_6","layout":{"type":"constrained"}} -->
<div class="wp-block-cover alignfull has-global-color-6-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80);min-height:85vh"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-0 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60","left":"var:preset|spacing|60"}}}} -->
<div class="wp-block-columns alignwide"><!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:heading {"level":1,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|40"}},"color":{"text":"#ffffff"}}} -->
<h1 class="wp-block-heading has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:var(--wp--preset--spacing--40)">Work With a Team You Can Count On</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffffb0"}}} -->
<p class="has-text-color" style="color:#ffffffb0;margin-top:0;margin-bottom:0;font-size:18px">From brand strategy to digital execution, our experienced team delivers reliable, high-quality work for organizations across every industry. Available when you need us most.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|40"},"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"wrap"}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--50);margin-bottom:var(--wp--preset--spacing--40)"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">Start a Project</a></div>
<!-- /wp:button -->

<!-- wp:button {"style":{"color":{"background":"#ffffff","text":"#00102E"}}} -->
<div class="wp-block-button"><a class="wp-block-button__link has-text-color has-background wp-element-button" href="#" style="color:#00102E;background-color:#ffffff">Schedule a Call</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->

<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group"><!-- wp:image {"width":"24px","height":"24px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%222%22 stroke=%22%23d65050%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z%22/%3E%3C/svg%3E" alt="check icon" style="width:24px;height:24px"/></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffff"}}} -->
<p class="has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0;font-size:14px">Results-Driven Approach</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group"><!-- wp:image {"width":"24px","height":"24px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%222%22 stroke=%22%23d65050%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z%22/%3E%3C/svg%3E" alt="check icon" style="width:24px;height:24px"/></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffff"}}} -->
<p class="has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0;font-size:14px">Free Consultation</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:image {"aspectRatio":"1","scale":"cover","sizeSlug":"large","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-large has-custom-border"><img src="https://images.unsplash.com/photo-1553877522-43269d4ea984?q=80&amp;w=1287&amp;auto=format&amp;fit=crop" alt="Agency team at work" style="border-radius:8px;aspect-ratio:1;object-fit:cover"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div></div>
<!-- /wp:cover -->',
	)
);

register_block_pattern(
	'sydney/hero-14',
	array(
		'title'      => __( 'Hero 14', 'sydney' ),
		'categories' => array( 'sydney-hero' ),
		'keywords'   => array( 'hero', 'agency' ),
		'content'    => '<!-- wp:cover {"url":"https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format\u0026fit=crop\u0026w=1600","alt":"Agency creative workspace","dimRatio":90,"overlayColor":"global_color_6","isUserOverlayColor":true,"minHeight":85,"minHeightUnit":"vh","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover alignfull" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);min-height:85vh"><img class="wp-block-cover__image-background" alt="Agency creative workspace" src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&amp;fit=crop&amp;w=1600" data-object-fit="cover"/><span aria-hidden="true" class="wp-block-cover__background has-global-color-6-background-color has-background-dim-90 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"600","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}},"color":{"text":"var:preset|color|global_color_1"}},"textColor":"global_color_1"} -->
<p class="has-text-align-center has-global-color-1-color has-text-color" style="color:var(--wp--preset--color--global-color-1);margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:600;letter-spacing:0.1em;text-transform:uppercase">Award-Winning Agency</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","level":1,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|40"}},"color":{"text":"#ffffff"}}} -->
<h1 class="wp-block-heading has-text-align-center has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:var(--wp--preset--spacing--40)">Work With a Team You Can Count On</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffffb0"}}} -->
<p class="has-text-align-center has-text-color" style="color:#ffffffb0;margin-top:0;margin-bottom:0;font-size:18px">From brand strategy to digital execution, our experienced team delivers reliable, high-quality work for organizations across every industry. Available when you need us most.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"},"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","justifyContent":"center","flexWrap":"wrap"}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:var(--wp--preset--spacing--40)"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">Start a Project</a></div>
<!-- /wp:button -->

<!-- wp:button {"style":{"color":{"background":"#ffffff","text":"#00102E"}}} -->
<div class="wp-block-button"><a class="wp-block-button__link has-text-color has-background wp-element-button" href="#" style="color:#00102E;background-color:#ffffff">Schedule a Call</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group"><!-- wp:image {"width":"24px","height":"24px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%222%22 stroke=%22%23d65050%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z%22/%3E%3C/svg%3E" alt="check icon" style="width:24px;height:24px"/></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffff"}}} -->
<p class="has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0;font-size:14px">Results-Driven Approach</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group"><!-- wp:image {"width":"24px","height":"24px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%222%22 stroke=%22%23d65050%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z%22/%3E%3C/svg%3E" alt="check icon" style="width:24px;height:24px"/></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffff"}}} -->
<p class="has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0;font-size:14px">Free Consultation</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group"><!-- wp:image {"width":"24px","height":"24px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%222%22 stroke=%22%23d65050%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z%22/%3E%3C/svg%3E" alt="check icon" style="width:24px;height:24px"/></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffff"}}} -->
<p class="has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0;font-size:14px">Satisfaction Guaranteed</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover -->',
	)
);

register_block_pattern(
	'sydney/hero-15',
	array(
		'title'      => __( 'Hero 15', 'sydney' ),
		'categories' => array( 'sydney-hero' ),
		'keywords'   => array( 'hero', 'agency' ),
		'content'    => '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"margin":{"top":"0","bottom":"0"}},"color":{"background":"#ffffff"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-background" style="background-color:#ffffff;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)"><!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60","left":"var:preset|spacing|60"}}}} -->
<div class="wp-block-columns alignwide"><!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:image {"aspectRatio":"1","scale":"cover","sizeSlug":"large","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-large has-custom-border"><img src="https://images.unsplash.com/photo-1515378791036-0648a3ef77b2?auto=format&amp;fit=crop&amp;w=1600" alt="Creative professional at work" style="border-radius:8px;aspect-ratio:1;object-fit:cover"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"600","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}},"color":{"text":"var:preset|color|global_color_1"}},"textColor":"global_color_1"} -->
<p class="has-global-color-1-color has-text-color" style="color:var(--wp--preset--color--global-color-1);margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:600;letter-spacing:0.1em;text-transform:uppercase">Award-Winning Agency</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":1,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|40"}}}} -->
<h1 class="wp-block-heading" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--40)">Work With a Team You Can Count On</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0;font-size:18px">From brand strategy to digital execution, our experienced team delivers reliable, high-quality work for organizations across every industry. Available when you need us most.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|40"},"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"wrap"}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--50);margin-bottom:var(--wp--preset--spacing--40)"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">Start a Project</a></div>
<!-- /wp:button -->

<!-- wp:button {"style":{"color":{"background":"#00102E","text":"#ffffff"}}} -->
<div class="wp-block-button"><a class="wp-block-button__link has-text-color has-background wp-element-button" href="#" style="color:#ffffff;background-color:#00102E">Schedule a Call</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->

<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group"><!-- wp:image {"width":"24px","height":"24px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%222%22 stroke=%22%23d65050%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z%22/%3E%3C/svg%3E" alt="check icon" style="width:24px;height:24px"/></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0;font-size:14px">Results-Driven Approach</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group"><!-- wp:image {"width":"24px","height":"24px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%222%22 stroke=%22%23d65050%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z%22/%3E%3C/svg%3E" alt="check icon" style="width:24px;height:24px"/></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0;font-size:14px">Free Consultation</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/hero-16',
	array(
		'title'      => __( 'Hero 16', 'sydney' ),
		'categories' => array( 'sydney-hero' ),
		'keywords'   => array( 'hero', 'agency' ),
		'content'    => '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"margin":{"top":"0","bottom":"0"}},"color":{"background":"#ffffff"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-background" style="background-color:#ffffff;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)"><!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60","left":"var:preset|spacing|60"}}}} -->
<div class="wp-block-columns alignwide"><!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:heading {"level":1,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|40"}}}} -->
<h1 class="wp-block-heading" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--40)">Work With a Team You Can Count On</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0;font-size:18px">From brand strategy to digital execution, our experienced team delivers reliable, high-quality work for organizations across every industry. Available when you need us most.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|40"},"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"wrap"}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--50);margin-bottom:var(--wp--preset--spacing--40)"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">Start a Project</a></div>
<!-- /wp:button -->

<!-- wp:button {"style":{"color":{"background":"#00102E","text":"#ffffff"}}} -->
<div class="wp-block-button"><a class="wp-block-button__link has-text-color has-background wp-element-button" href="#" style="color:#ffffff;background-color:#00102E">Schedule a Call</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->

<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group"><!-- wp:image {"width":"24px","height":"24px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%222%22 stroke=%22%23d65050%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z%22/%3E%3C/svg%3E" alt="check icon" style="width:24px;height:24px"/></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0;font-size:14px">Results-Driven Approach</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group"><!-- wp:image {"width":"24px","height":"24px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%222%22 stroke=%22%23d65050%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z%22/%3E%3C/svg%3E" alt="check icon" style="width:24px;height:24px"/></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0;font-size:14px">Free Consultation</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:image {"aspectRatio":"1","scale":"cover","sizeSlug":"large","linkDestination":"none"} -->
<figure class="wp-block-image size-large"><img src="https://images.unsplash.com/photo-1515378791036-0648a3ef77b2?q=80&amp;w=1600&amp;auto=format" alt="Agency team collaborating" style="aspect-ratio:1;object-fit:cover"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/hero-17',
	array(
		'title'      => __( 'Hero 17', 'sydney' ),
		'categories' => array( 'sydney-hero' ),
		'keywords'   => array( 'hero', 'agency' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"}},"dimensions":{"minHeight":""}},"backgroundColor":"global_color_6","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-6-background-color has-background" style="padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)"><!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|50"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group alignwide"><!-- wp:image {"width":"208px","height":"208px","scale":"cover","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"9999px","color":"rgba(255,255,255,0.3)","width":"4px"}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border"><img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Alex Morgan" class="has-border-color" style="border-color:rgba(255,255,255,0.3);border-width:4px;border-radius:9999px;object-fit:cover;width:208px;height:208px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":1,"style":{"color":{"text":"#ffffff"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}}}} -->
<h1 class="wp-block-heading has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:var(--wp--preset--spacing--30)">My name is Alex Morgan. Digital Product Designer</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"color":{"text":"#ffffffcc"},"spacing":{"margin":{"top":"0","bottom":"0"}},"typography":{"fontSize":"18px"}}} -->
<p class="has-text-color" style="color:#ffffffcc;margin-top:0;margin-bottom:0;font-size:18px">Creative Director &amp; Partner</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|50"}},"border":{"top":{"color":"rgba(255,255,255,0.2)","width":"1px"}}}} -->
<div class="wp-block-group alignwide" style="border-top-color:rgba(255,255,255,0.2);border-top-width:1px;padding-top:var(--wp--preset--spacing--50)"><!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|50","left":"var:preset|spacing|50"}}}} -->
<div class="wp-block-columns alignwide"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"style":{"color":{"text":"rgba(255,255,255,0.6)"},"typography":{"fontStyle":"normal","fontWeight":"400","letterSpacing":"0.1em","textTransform":"uppercase","fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-color" style="color:rgba(255,255,255,0.6);margin-top:0;margin-bottom:0;font-size:14px;font-style:normal;font-weight:400;letter-spacing:0.1em;text-transform:uppercase">We Create For</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"color":{"text":"#ffffff"},"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}}},"fontSize":"medium"} -->
<p class="has-text-color has-medium-font-size" style="color:#ffffff;margin-top:var(--wp--preset--spacing--20);margin-bottom:0">Web &amp; Mobile</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"style":{"color":{"text":"rgba(255,255,255,0.6)"},"typography":{"fontStyle":"normal","fontWeight":"400","letterSpacing":"0.1em","textTransform":"uppercase","fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-color" style="color:rgba(255,255,255,0.6);margin-top:0;margin-bottom:0;font-size:14px;font-style:normal;font-weight:400;letter-spacing:0.1em;text-transform:uppercase">Phone</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"color":{"text":"#ffffff"},"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}}},"fontSize":"medium"} -->
<p class="has-text-color has-medium-font-size" style="color:#ffffff;margin-top:var(--wp--preset--spacing--20);margin-bottom:0">(123) 456-7890</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"style":{"color":{"text":"rgba(255,255,255,0.6)"},"typography":{"fontStyle":"normal","fontWeight":"400","letterSpacing":"0.1em","textTransform":"uppercase","fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-color" style="color:rgba(255,255,255,0.6);margin-top:0;margin-bottom:0;font-size:14px;font-style:normal;font-weight:400;letter-spacing:0.1em;text-transform:uppercase">Drop your Message</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"color":{"text":"#ffffff"},"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}}},"fontSize":"medium"} -->
<p class="has-text-color has-medium-font-size" style="color:#ffffff;margin-top:var(--wp--preset--spacing--20);margin-bottom:0"><a style="color:#ffffff" href="mailto:hello@example.com">office@example.com</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/hero-18',
	array(
		'title'      => __( 'Hero 18', 'sydney' ),
		'categories' => array( 'sydney-hero' ),
		'keywords'   => array( 'hero', 'agency' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"margin":{"top":"0","bottom":"0"}},"dimensions":{"minHeight":""}},"backgroundColor":"global_color_6","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-6-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
<div class="wp-block-group"><!-- wp:image {"width":"112px","height":"112px","scale":"cover","sizeSlug":"full","linkDestination":"none","align":"center","className":"is-style-rounded","style":{"border":{"width":"4px","color":"var(\u002d\u002dsydney-global-color-8)"},"layout":{"selfStretch":"fit","flexSize":null},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|20"}}}} -->
<figure class="wp-block-image aligncenter size-full is-resized has-custom-border is-style-rounded" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--20)"><img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Alex Morgan" class="has-border-color" style="border-color:var(--sydney-global-color-8);border-width:4px;object-fit:cover;width:112px;height:112px"/></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"align":"center","style":{"color":{"text":"#ffffffcc"},"spacing":{"margin":{"top":"0","bottom":"0"}},"typography":{"fontSize":"18px"}}} -->
<p class="has-text-align-center has-text-color" style="color:#ffffffcc;margin-top:0;margin-bottom:0;font-size:18px">Creative Director</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","level":1,"style":{"color":{"text":"#ffffff"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<h1 class="wp-block-heading has-text-align-center has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0">Alex Morgan</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"color":{"text":"#ffffff99"},"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|40"}}}} -->
<p class="has-text-align-center has-text-color" style="color:#ffffff99;margin-top:0;margin-bottom:var(--wp--preset--spacing--40);font-size:18px">A creative professional with over 10 years of experience crafting digital products, brand identities, and user experiences that make an impact.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons" style="margin-top:0;margin-bottom:0"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">View Our Work</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/hero-19',
	array(
		'title'      => __( 'Hero 19', 'sydney' ),
		'categories' => array( 'sydney-hero' ),
		'keywords'   => array( 'hero', 'agency' ),
		'content'    => '<!-- wp:cover {"url":"https://images.unsplash.com/photo-1521737604893-d14cc237f11d?auto=format\u0026fit=crop\u0026w=1600","alt":"Team meeting","dimRatio":80,"overlayColor":"global_color_6","isUserOverlayColor":true,"minHeight":80,"minHeightUnit":"vh","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover alignfull" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);min-height:80vh"><img class="wp-block-cover__image-background" alt="Team meeting" src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?auto=format&amp;fit=crop&amp;w=1600" data-object-fit="cover"/><span aria-hidden="true" class="wp-block-cover__background has-global-color-6-background-color has-background-dim-80 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700"},"color":{"text":"var:preset|color|global_color_9"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-align-center has-text-color" style="color:var(--wp--preset--color--global-color-9);margin-top:0;margin-bottom:0;font-style:normal;font-weight:700;text-transform:uppercase">Rated #1 Strategy Consultancy 2026</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","level":1,"style":{"color":{"text":"#ffffff"},"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}}}} -->
<h1 class="wp-block-heading has-text-align-center has-text-color" style="color:#ffffff;margin-top:var(--wp--preset--spacing--30);margin-bottom:var(--wp--preset--spacing--30)">Transform Your Business<br>Strategy for Growth</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"color":{"text":"#dbdbdb"},"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|50"}}}} -->
<p class="has-text-align-center has-text-color" style="color:#dbdbdb;margin-top:0;margin-bottom:var(--wp--preset--spacing--50);font-size:18px">We partner with ambitious organizations to unlock new revenue streams, optimize operations, and build resilient strategies that drive measurable results.</p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|40","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:group {"style":{"spacing":{"blockGap":"0","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:image {"width":"40px","height":"40px","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"9999px","width":"2px","color":"#ffffff"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border" style="margin-top:0;margin-bottom:0"><img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Client" class="has-border-color" style="border-color:#ffffff;border-width:2px;border-radius:9999px;width:40px;height:40px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"width":"40px","height":"40px","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"9999px","width":"2px","color":"#ffffff"},"spacing":{"margin":{"left":"-12px","bottom":"0"}}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border" style="margin-bottom:0;margin-left:-12px"><img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Client" class="has-border-color" style="border-color:#ffffff;border-width:2px;border-radius:9999px;width:40px;height:40px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"width":"40px","height":"40px","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"9999px","width":"2px","color":"#ffffff"},"spacing":{"margin":{"left":"-12px","bottom":"0"}}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border" style="margin-bottom:0;margin-left:-12px"><img src="https://randomuser.me/api/portraits/men/55.jpg" alt="Client" class="has-border-color" style="border-color:#ffffff;border-width:2px;border-radius:9999px;width:40px;height:40px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"width":"40px","height":"40px","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"9999px","width":"2px","color":"#ffffff"},"spacing":{"margin":{"left":"-12px","bottom":"0"}}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border" style="margin-bottom:0;margin-left:-12px"><img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Client" class="has-border-color" style="border-color:#ffffff;border-width:2px;border-radius:9999px;width:40px;height:40px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons" style="margin-top:0;margin-bottom:0"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">Book a Consultation</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover -->',
	)
);

register_block_pattern(
	'sydney/hero-20',
	array(
		'title'      => __( 'Hero 20', 'sydney' ),
		'categories' => array( 'sydney-hero' ),
		'keywords'   => array( 'hero', 'agency' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)"><!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60","left":"var:preset|spacing|60"},"margin":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center" style="margin-top:0;margin-bottom:0"><!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","fontSize":"14px"},"color":{"text":"var:preset|color|global_color_1"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}}}} -->
<p class="has-text-color" style="color:var(--wp--preset--color--global-color-1);margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:700;text-transform:uppercase">Strategic Advisory</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":1,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}}}} -->
<h1 class="wp-block-heading" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30)">Driving Growth Through Expert Advisory</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|50"}}}} -->
<p style="margin-top:0;margin-bottom:var(--wp--preset--spacing--50);font-size:18px">From operational excellence to market expansion, our consultants deliver actionable strategies that accelerate your trajectory and create lasting competitive advantage.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"left"}} -->
<div class="wp-block-buttons" style="margin-top:0;margin-bottom:0"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">Get Started</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="#">Learn More</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:image {"sizeSlug":"large","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-large has-custom-border"><img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?auto=format&amp;fit=crop&amp;w=1600" alt="Conference room strategy session" style="border-radius:8px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/hero-21',
	array(
		'title'      => __( 'Hero 21', 'sydney' ),
		'categories' => array( 'sydney-hero' ),
		'keywords'   => array( 'hero', 'agency' ),
		'content'    => '<!-- wp:cover {"url":"https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format\u0026fit=crop\u0026w=1600","alt":"Modern office","dimRatio":75,"overlayColor":"global_color_6","isUserOverlayColor":true,"minHeight":80,"minHeightUnit":"vh","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover alignfull" style="padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80);min-height:80vh"><img class="wp-block-cover__image-background" alt="Modern office" src="https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&amp;fit=crop&amp;w=1600" data-object-fit="cover"/><span aria-hidden="true" class="wp-block-cover__background has-global-color-6-background-color has-background-dim-80 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","justifyContent":"left"}} -->
<div class="wp-block-group alignwide" style="margin-top:0;margin-bottom:0"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}}},"textColor":"white"} -->
<p class="has-white-color has-text-color" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-style:normal;font-weight:700;text-transform:uppercase">● Leadership Advisory</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":1,"style":{"color":{"text":"#ffffff"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}}}} -->
<h1 class="wp-block-heading has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:var(--wp--preset--spacing--30)">Accelerate Growth with Precision Strategy</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"color":{"text":"#dbdbdb"},"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|50"}}}} -->
<p class="has-text-color" style="color:#dbdbdb;margin-top:0;margin-bottom:var(--wp--preset--spacing--50);font-size:18px">From boardroom to execution — we equip your leadership team with the insights and frameworks needed to outperform in any market condition.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"left"}} -->
<div class="wp-block-buttons" style="margin-top:0;margin-bottom:0"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">Start Your Project</a></div>
<!-- /wp:button -->

<!-- wp:button {"backgroundColor":"global_color_9","textColor":"global_color_1","className":"is-style-fill","style":{"elements":{"link":{"color":{"text":"var:preset|color|global_color_1"}}}}} -->
<div class="wp-block-button is-style-fill"><a class="wp-block-button__link has-global-color-1-color has-global-color-9-background-color has-text-color has-background has-link-color wp-element-button" href="#">View Case Studies</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover -->',
	)
);

register_block_pattern(
	'sydney/hero-22',
	array(
		'title'      => __( 'Hero 22', 'sydney' ),
		'categories' => array( 'sydney-hero' ),
		'keywords'   => array( 'hero', 'agency' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"0","bottom":"0"},"blockGap":"0","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"stretch"}} -->
<section class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:0;padding-bottom:0"><!-- wp:group {"style":{"layout":{"selfStretch":"fill","flexSize":null},"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"}},"dimensions":{"minHeight":"80vh"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="min-height:80vh;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:cover {"url":"https://images.unsplash.com/photo-1560179707-f14e90ef3623?auto=format\u0026fit=crop\u0026w=1600","alt":"Office building","dimRatio":0,"minHeight":80,"minHeightUnit":"vh","style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;min-height:80vh"><img class="wp-block-cover__image-background" alt="Office building" src="https://images.unsplash.com/photo-1560179707-f14e90ef3623?auto=format&amp;fit=crop&amp;w=1600" data-object-fit="cover"/><span aria-hidden="true" class="wp-block-cover__background has-background-dim-0 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","placeholder":"Write title…","fontSize":"large"} -->
<p class="has-text-align-center has-large-font-size"></p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:cover --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"layout":{"selfStretch":"fill","flexSize":null},"color":{"background":"#00102E"},"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80","left":"var:preset|spacing|60","right":"var:preset|spacing|60"},"blockGap":"var:preset|spacing|40"}},"layout":{"type":"flex","orientation":"vertical","verticalAlignment":"center","justifyContent":"left"}} -->
<div class="wp-block-group has-background" style="background-color:#00102E;padding-top:var(--wp--preset--spacing--80);padding-right:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--80);padding-left:var(--wp--preset--spacing--60)"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"},"layout":{"selfStretch":"fill","flexSize":null}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}}},"textColor":"white"} -->
<p class="has-white-color has-text-color" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-style:normal;font-weight:700;text-transform:uppercase">Results-Driven Consulting</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":1,"style":{"color":{"text":"#ffffff"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}}}} -->
<h1 class="wp-block-heading has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:var(--wp--preset--spacing--30)">Build a Resilient, Future-Ready Enterprise</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|50"}}},"textColor":"white"} -->
<p class="has-white-color has-text-color" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--50)">Our senior consultants bring deep industry expertise and proven methodologies to help you navigate disruption and capitalize on emerging opportunities.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|20"}}},"layout":{"type":"flex","justifyContent":"left"}} -->
<div class="wp-block-buttons" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--20)"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">Request a Proposal</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"border":{"top":{"color":"rgba(255,255,255,0.2)","width":"1px"}},"spacing":{"padding":{"top":"var:preset|spacing|40"},"blockGap":"var:preset|spacing|30","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="border-top-color:rgba(255,255,255,0.2);border-top-width:1px;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--40)"><!-- wp:group {"style":{"spacing":{"blockGap":"0","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:image {"width":"32px","height":"32px","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"9999px","width":"2px","color":"#00102E"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border" style="margin-top:0;margin-bottom:0"><img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Consultant" class="has-border-color" style="border-color:#00102E;border-width:2px;border-radius:9999px;width:32px;height:32px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"width":"32px","height":"32px","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"9999px","width":"2px","color":"#00102E"},"spacing":{"margin":{"left":"-10px","bottom":"0"}}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border" style="margin-bottom:0;margin-left:-10px"><img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Consultant" class="has-border-color" style="border-color:#00102E;border-width:2px;border-radius:9999px;width:32px;height:32px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"width":"32px","height":"32px","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"9999px","width":"2px","color":"#00102E"},"spacing":{"margin":{"left":"-10px","bottom":"0"}}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border" style="margin-bottom:0;margin-left:-10px"><img src="https://randomuser.me/api/portraits/men/67.jpg" alt="Consultant" class="has-border-color" style="border-color:#00102E;border-width:2px;border-radius:9999px;width:32px;height:32px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffffa1"}}} -->
<p class="has-text-color" style="color:#ffffffa1;margin-top:0;margin-bottom:0">60+ senior consultants across 12 industries</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
',
	)
);

// Hero 1 — Light centered layout with image below.
register_block_pattern(
	'sydney/hero-23',
	array(
		'title'      => __( 'Hero 23', 'sydney' ),
		'categories' => array( 'sydney-hero' ),
		'keywords'   => array( 'hero', 'agency' ),
		'content'    => '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"backgroundColor":"white","layout":{"type":"constrained","wideSize":"1140px"}} -->
<div class="wp-block-group alignfull has-white-background-color has-background" style="padding-top:var(--wp--preset--spacing--80);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--80);padding-left:var(--wp--preset--spacing--50)"><!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained","wideSize":"700px"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","letterSpacing":"3px","fontSize":"14px","fontStyle":"normal","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}}},"textColor":"global_color_1"} -->
<p class="has-text-align-center has-global-color-1-color has-text-color" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:600;letter-spacing:3px;text-transform:uppercase">Est. 2010</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","level":1,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}}}} -->
<h1 class="wp-block-heading has-text-align-center" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30)">Where Every Brief Becomes a Story</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|50"}},"color":{"text":"#6d7685"}}} -->
<p class="has-text-align-center has-text-color" style="color:#6d7685;margin-top:0;margin-bottom:var(--wp--preset--spacing--50);font-size:18px">We craft digital experiences where strategy meets creativity. Our team brings every brief to life with meticulous attention to craft and lasting impact.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons" style="margin-top:0;margin-bottom:0"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">Start a Project</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="#">View Our Work</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none","align":"wide","style":{"border":{"radius":"12px"},"spacing":{"margin":{"top":"var:preset|spacing|60","bottom":"0"}}}} -->
<figure class="wp-block-image alignwide size-full has-custom-border" style="margin-top:var(--wp--preset--spacing--60);margin-bottom:0;border-radius:12px"><img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&amp;fit=crop&amp;w=1600" alt="Creative agency studio"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->',
	)
);

// Hero 2 — Cover with background image and info bar below.
register_block_pattern(
	'sydney/hero-24',
	array(
		'title'      => __( 'Hero 24', 'sydney' ),
		'categories' => array( 'sydney-hero' ),
		'keywords'   => array( 'hero', 'agency' ),
		'content'    => '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"blockGap":"0"}},"layout":{"type":"constrained","wideSize":"100%"}} -->
<div class="wp-block-group alignfull" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:cover {"url":"https://images.unsplash.com/photo-1553877522-43269d4ea984?auto=format\u0026fit=crop\u0026w=1600","dimRatio":70,"customOverlayColor":"#000000","isUserOverlayColor":true,"minHeight":70,"minHeightUnit":"vh","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80","left":"var:preset|spacing|50","right":"var:preset|spacing|50"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","wideSize":"700px"}} -->
<div class="wp-block-cover alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--80);padding-left:var(--wp--preset--spacing--50);min-height:70vh"><img class="wp-block-cover__image-background" alt="" src="https://images.unsplash.com/photo-1553877522-43269d4ea984?auto=format&amp;fit=crop&amp;w=1600" data-object-fit="cover"/><span aria-hidden="true" class="wp-block-cover__background has-background-dim-70 has-background-dim" style="background-color:#000000"></span><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","letterSpacing":"3px","fontSize":"14px","fontStyle":"normal","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}}},"textColor":"white"} -->
<p class="has-text-align-center has-white-color has-text-color" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:600;letter-spacing:3px;text-transform:uppercase">Est. 2010</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","level":1,"style":{"color":{"text":"#ffffff"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}}}} -->
<h1 class="wp-block-heading has-text-align-center has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:var(--wp--preset--spacing--30)">Where Every Brief Becomes a Story</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|50"}},"color":{"text":"#dbdbdb"}}} -->
<p class="has-text-align-center has-text-color" style="color:#dbdbdb;margin-top:0;margin-bottom:var(--wp--preset--spacing--50);font-size:18px">We craft digital experiences where strategy meets creativity. Our team brings every brief to life with meticulous attention to craft and lasting impact.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons" style="margin-top:0;margin-bottom:0"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">Start a Project</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></div>
<!-- /wp:cover -->

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}},"border":{"top":{"color":"#333333","width":"1px"},"right":[],"bottom":[],"left":[]},"color":{"background":"#1c1c1c"}},"layout":{"type":"constrained","wideSize":"1140px"}} -->
<div class="wp-block-group alignfull has-background" style="border-top-color:#333333;border-top-width:1px;background-color:#1c1c1c;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)"><!-- wp:columns {"verticalAlignment":"top","align":"wide","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-top" style="margin-top:0;margin-bottom:0"><!-- wp:column {"verticalAlignment":"top","style":{"spacing":{"blockGap":"var:preset|spacing|20"}}} -->
<div class="wp-block-column is-vertically-aligned-top"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","letterSpacing":"3px","fontStyle":"normal","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffffa8"}},"fontSize":"small"} -->
<p class="has-text-align-center has-text-color has-small-font-size" style="color:#ffffffa8;margin-top:0;margin-bottom:0;font-style:normal;font-weight:600;letter-spacing:3px;text-transform:uppercase">Working Hours</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"color":{"text":"#ffffff"},"typography":{"fontStyle":"normal","fontWeight":"700"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-align-center has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0;font-style:normal;font-weight:700">Mon–Fri: 9:00 AM – 6:00 PM</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"top","style":{"spacing":{"blockGap":"var:preset|spacing|20"}}} -->
<div class="wp-block-column is-vertically-aligned-top"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","letterSpacing":"3px","fontStyle":"normal","fontWeight":"600"},"color":{"text":"#ffffffa8"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"fontSize":"small"} -->
<p class="has-text-align-center has-text-color has-small-font-size" style="color:#ffffffa8;margin-top:0;margin-bottom:0;font-style:normal;font-weight:600;letter-spacing:3px;text-transform:uppercase">Location</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"color":{"text":"#ffffff"},"typography":{"fontStyle":"normal","fontWeight":"700"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-align-center has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0;font-style:normal;font-weight:700">74 Pine St, New York, NY 10005</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"top","style":{"spacing":{"blockGap":"var:preset|spacing|20"}}} -->
<div class="wp-block-column is-vertically-aligned-top"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","letterSpacing":"3px","fontStyle":"normal","fontWeight":"600"},"color":{"text":"#ffffffa8"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"fontSize":"small"} -->
<p class="has-text-align-center has-text-color has-small-font-size" style="color:#ffffffa8;margin-top:0;margin-bottom:0;font-style:normal;font-weight:600;letter-spacing:3px;text-transform:uppercase">Contact</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"color":{"text":"#ffffff"},"typography":{"fontStyle":"normal","fontWeight":"700"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-align-center has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0;font-style:normal;font-weight:700">(123) 456-7890</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->',
	)
);


// Decorative ornament SVG data URI — shared across all construction-industrial patterns.
$sydney_construction_ornament = "";

register_block_pattern(
	'sydney/hero-25',
	array(
		'title'      => __( 'Hero 25', 'sydney' ),
		'categories' => array( 'sydney-hero' ),
		'keywords'   => array( 'hero', 'agency' ),
		'content'    => '<!-- wp:group {"align":"full","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull"><!-- wp:media-text {"align":"full","mediaType":"image","verticalAlignment":"center","imageFill":true,"style":{"spacing":{"padding":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_7"} -->
<div class="wp-block-media-text alignfull is-stacked-on-mobile is-vertically-aligned-center is-image-fill-element has-global-color-7-background-color has-background" style="padding-top:0;padding-bottom:0"><figure class="wp-block-media-text__media"><img src="https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&amp;fit=crop&amp;w=1600" alt="Agency workspace" style="object-position:50% 50%"/></figure><div class="wp-block-media-text__content"><!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--60);margin-bottom:var(--wp--preset--spacing--60)"><!-- wp:heading {"level":1,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}}}} -->
<h1 class="wp-block-heading" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30)">We Build What Lasts</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|60"}}}} -->
<p style="margin-top:0;margin-bottom:var(--wp--preset--spacing--60);font-size:18px">Award-winning agency delivering strategy, design, and digital products that move the needle for ambitious brands.</p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","letterSpacing":"3px","fontSize":"12px"},"color":{"text":"#6d7685"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-color" style="color:#6d7685;margin-top:0;margin-bottom:0;font-size:12px;letter-spacing:3px;text-transform:uppercase">established</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"700","fontSize":"48px"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0;font-size:48px;font-style:normal;font-weight:700">2009</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-buttons" style="margin-top:0;margin-bottom:0"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">Learn more</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div></div>
<!-- /wp:media-text --></div>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/hero-26',
	array(
		'title'      => __( 'Hero 26', 'sydney' ),
		'categories' => array( 'sydney-hero' ),
		'keywords'   => array( 'hero', 'agency' ),
		'content'    => '<!-- wp:group {"align":"full","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull"><!-- wp:media-text {"align":"full","mediaPosition":"right","mediaType":"image","mediaWidth":58,"verticalAlignment":"center","imageFill":true} -->
<div class="wp-block-media-text alignfull has-media-on-the-right is-stacked-on-mobile is-vertically-aligned-center is-image-fill-element" style="grid-template-columns:auto 58%"><div class="wp-block-media-text__content"><!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--60);margin-bottom:var(--wp--preset--spacing--60)"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","letterSpacing":"3px","fontSize":"12px"},"color":{"text":"#6d7685"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}}}} -->
<p class="has-text-color" style="color:#6d7685;margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:12px;letter-spacing:3px;text-transform:uppercase">Since 2009</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":1,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}}}} -->
<h1 class="wp-block-heading" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30)">We Build What Lasts</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|40"}}}} -->
<p style="margin-top:0;margin-bottom:var(--wp--preset--spacing--40);font-size:18px">Award-winning agency delivering strategy, design, and digital products that move the needle for ambitious brands.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-buttons" style="margin-top:0;margin-bottom:0"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">Get Started</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50","bottom":"0"},"padding":{"top":"var:preset|spacing|40"},"blockGap":"var:preset|spacing|50"},"border":{"top":{"color":"#dbdbdb","width":"1px"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"left"}} -->
<div class="wp-block-group" style="border-top-color:#dbdbdb;border-top-width:1px;margin-top:var(--wp--preset--spacing--50);margin-bottom:0;padding-top:var(--wp--preset--spacing--40)"><!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"700","fontSize":"30px"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0;font-size:30px;font-style:normal;font-weight:700">500+</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"color":{"text":"#6d7685"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-color" style="color:#6d7685;margin-top:0;margin-bottom:0;font-size:14px">Projects</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"700","fontSize":"30px"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0;font-size:30px;font-style:normal;font-weight:700">15+</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"color":{"text":"#6d7685"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-color" style="color:#6d7685;margin-top:0;margin-bottom:0;font-size:14px">Years</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"700","fontSize":"30px"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0;font-size:30px;font-style:normal;font-weight:700">98%</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"color":{"text":"#6d7685"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-color" style="color:#6d7685;margin-top:0;margin-bottom:0;font-size:14px">Satisfaction</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div><figure class="wp-block-media-text__media"><img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&amp;fit=crop&amp;w=1600" alt="Agency workspace" style="object-position:50% 50%"/></figure></div>
<!-- /wp:media-text --></div>
<!-- /wp:group -->',
	)
);