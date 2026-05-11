<?php
/**
 * CTA patterns
 *
 * @package Sydney
 */


// CTA 1 — Dark centered section with single button.
register_block_pattern(
	'sydney/cta-1',
	array(
		'title'      => __( 'CTA 1', 'sydney' ),
		'categories' => array( 'sydney-cta' ),
		'keywords'   => array( 'cta', 'call to action' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"margin":{"top":"0","bottom":"0"}},"color":{"background":"#111111"}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-background" style="background-color:#111111;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"768px"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}},},"textColor":"white"} -->
<p class="has-text-align-center has-white-color has-text-color" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:700;letter-spacing:0.1em;text-transform:uppercase">Get Started</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}},"color":{"text":"#ffffff"}}} -->
<h2 class="wp-block-heading has-text-align-center has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:var(--wp--preset--spacing--30)">Ready to Take Your Brand to the Next Level?</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|50"}},"color":{"text":"#d1d5db"}}} -->
<p class="has-text-align-center has-text-color" style="color:#d1d5db;margin-top:0;margin-bottom:var(--wp--preset--spacing--50);font-size:18px">We partner with ambitious brands to create meaningful work. Let\'s start with a conversation and see where it leads.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons" style="margin-top:0;margin-bottom:0"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">Get Started</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->',
	)
);

// CTA 2 — Cover with background image and dark overlay.
register_block_pattern(
	'sydney/cta-2',
	array(
		'title'      => __( 'CTA 2', 'sydney' ),
		'categories' => array( 'sydney-cta' ),
		'keywords'   => array( 'cta', 'call to action', 'cover' ),
		'content'    => '<!-- wp:cover {"url":"https://images.unsplash.com/photo-1497366216548-37526070297c?w=1920\u0026h=1080\u0026crop=entropy\u0026fit=crop","dimRatio":80,"overlayColor":"black","isUserOverlayColor":true,"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"margin":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-cover alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><img class="wp-block-cover__image-background" alt="" src="https://images.unsplash.com/photo-1497366216548-37526070297c?w=1920&amp;h=1080&amp;crop=entropy&amp;fit=crop" data-object-fit="cover"/><span aria-hidden="true" class="wp-block-cover__background has-black-background-color has-background-dim-80 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"768px"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}},"color":{"text":"#ffffff"}}} -->
<h2 class="wp-block-heading has-text-align-center has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:var(--wp--preset--spacing--30)">Ready to Take Your Brand to the Next Level?</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|50"}},"color":{"text":"#d1d5db"}}} -->
<p class="has-text-align-center has-text-color" style="color:#d1d5db;margin-top:0;margin-bottom:var(--wp--preset--spacing--50);font-size:18px">We partner with ambitious brands to create meaningful work. Let\'s start with a conversation and see where it leads.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons" style="margin-top:0;margin-bottom:0"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">Get Started</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover -->',
	)
);

// CTA 3 — Dark centered with decorative bar and feature highlights.
register_block_pattern(
	'sydney/cta-3',
	array(
		'title'      => __( 'CTA 3', 'sydney' ),
		'categories' => array( 'sydney-cta' ),
		'keywords'   => array( 'cta', 'call to action' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"margin":{"top":"0","bottom":"0"}},"color":{"background":"#111111"}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-background" style="background-color:#111111;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"768px"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:group {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|40"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center"}} -->
<div class="wp-block-group" style="margin-bottom:var(--wp--preset--spacing--40)"><!-- wp:group {"style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"}},"dimensions":{"minHeight":"4px"},"layout":{"selfStretch":"fixed","flexSize":"64px"},"color":{"background":"var:preset|color|global_color_1"}},"backgroundColor":"global_color_1","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="background-color:var(--wp--preset--color--global-color-1);min-height:4px;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}},"color":{"text":"#ffffff"}}} -->
<h2 class="wp-block-heading has-text-align-center has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:var(--wp--preset--spacing--30)">Ready to Take Your Brand to the Next Level?</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|50"}},"color":{"text":"#d1d5db"}}} -->
<p class="has-text-align-center has-text-color" style="color:#d1d5db;margin-top:0;margin-bottom:var(--wp--preset--spacing--50);font-size:18px">We partner with ambitious brands to create meaningful work. Let\'s start with a conversation and see where it leads.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|50"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--50)"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">Get Started</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"center"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#9ca3af"}}} -->
<p class="has-text-color" style="color:#9ca3af;margin-top:0;margin-bottom:0;font-size:14px">Free Consultation</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"right":"var:preset|spacing|30","left":"var:preset|spacing|30"}},"color":{"text":"#9ca3af"}}} -->
<p class="has-text-color" style="color:#9ca3af;margin-top:0;margin-bottom:0;padding-right:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30);font-size:14px">&bull;</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#9ca3af"}}} -->
<p class="has-text-color" style="color:#9ca3af;margin-top:0;margin-bottom:0;font-size:14px">Dedicated Support</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"right":"var:preset|spacing|30","left":"var:preset|spacing|30"}},"color":{"text":"#9ca3af"}}} -->
<p class="has-text-color" style="color:#9ca3af;margin-top:0;margin-bottom:0;padding-right:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30);font-size:14px">&bull;</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#9ca3af"}}} -->
<p class="has-text-color" style="color:#9ca3af;margin-top:0;margin-bottom:0;font-size:14px">100% Satisfaction</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/cta-4',
	array(
		'title'      => __( 'CTA 4', 'sydney' ),
		'categories' => array( 'sydney-cta' ),
		'keywords'   => array( 'cta', 'call to action', 'agency', 'digital' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_7","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-7-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|50","left":"var:preset|spacing|50"},"margin":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center" style="margin-top:0;margin-bottom:0"><!-- wp:column {"verticalAlignment":"center","width":"66.66%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:66.66%"><!-- wp:heading {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<h2 class="wp-block-heading" style="margin-top:0;margin-bottom:0">Let\'s build something extraordinary together.</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<p style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0;font-size:18px">Whether you need a new website, a full rebrand, or a digital strategy that actually delivers — we\'re ready when you are.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"33.33%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:33.33%"><!-- wp:buttons {"layout":{"type":"flex","justifyContent":"right"}} -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">Start Your Project</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/cta-5',
	array(
		'title'      => __( 'CTA 5', 'sydney' ),
		'categories' => array( 'sydney-cta' ),
		'keywords'   => array( 'cta', 'call to action', 'agency', 'digital', 'image' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_6","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-6-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60","left":"var:preset|spacing|60"},"margin":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center" style="margin-top:0;margin-bottom:0"><!-- wp:column {"verticalAlignment":"center","width":"50%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}},"color":{"text":"var:preset|color|global_color_1"}},"textColor":"global_color_1"} -->
<p class="has-global-color-1-color has-text-color" style="color:var(--wp--preset--color--global-color-1);margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:700;letter-spacing:0.1em;text-transform:uppercase">Ready to Start?</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffff"}}} -->
<h2 class="wp-block-heading has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0">Let\'s build something extraordinary together.</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}},"color":{"text":"#dbdbdb"}}} -->
<p class="has-text-color" style="color:#dbdbdb;margin-top:var(--wp--preset--spacing--30);margin-bottom:0;font-size:18px">Whether you need a new website, a full rebrand, or a digital strategy that actually delivers — we\'re ready when you are.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"0"}}}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:0"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">Start Your Project</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"50%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%"><!-- wp:image {"sizeSlug":"large","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-large has-custom-border"><img src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&amp;fit=crop&amp;w=1600" alt="Team collaborating on a digital project" style="border-radius:8px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/cta-6',
	array(
		'title'      => __( 'CTA 6', 'sydney' ),
		'categories' => array( 'sydney-cta' ),
		'keywords'   => array( 'cta', 'call to action', 'agency', 'digital', 'minimal' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_7","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-7-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|50","left":"var:preset|spacing|50"},"margin":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center" style="margin-top:0;margin-bottom:0"><!-- wp:column {"verticalAlignment":"center","width":"66.66%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:66.66%"><!-- wp:heading {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<h2 class="wp-block-heading" style="margin-top:0;margin-bottom:0">Let\'s build something extraordinary together.</h2>
<!-- /wp:heading --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"33.33%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:33.33%"><!-- wp:buttons {"layout":{"type":"flex","justifyContent":"right"}} -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">Start Your Project</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/cta-7',
	array(
		'title'      => __( 'CTA 7', 'sydney' ),
		'categories' => array( 'sydney-cta' ),
		'keywords'   => array( 'cta', 'call to action', 'agency', 'digital', 'cover', 'buttons' ),
		'content'    => '<!-- wp:cover {"url":"https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format\u0026fit=crop\u0026w=1600","alt":"Digital agency team at work","dimRatio":75,"overlayColor":"global_color_6","isUserOverlayColor":true,"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)"><img class="wp-block-cover__image-background" alt="Digital agency team at work" src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&amp;fit=crop&amp;w=1600" data-object-fit="cover"/><span aria-hidden="true" class="wp-block-cover__background has-global-color-6-background-color has-background-dim-80 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"768px"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffff"}}} -->
<h2 class="wp-block-heading has-text-align-center has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0">Let\'s build something extraordinary together.</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}},"color":{"text":"#dbdbdb"}}} -->
<p class="has-text-align-center has-text-color" style="color:#dbdbdb;margin-top:var(--wp--preset--spacing--30);margin-bottom:0;font-size:18px">Whether you need a new website, a full rebrand, or a digital strategy that actually delivers — we combine strategy, creativity, and data to help you attract, engage, and convert your ideal audience. Let\'s make your brand stand out.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"0"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:0"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">Start Your Project</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline","style":{"color":{"text":"#ffffff"},"elements":{"link":{"color":{"text":"#ffffff"}}}}} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link has-text-color has-link-color wp-element-button" href="#" style="color:#ffffff">Learn More</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover -->',
	)
);

register_block_pattern(
	'sydney/cta-8',
	array(
		'title'      => __( 'CTA 8', 'sydney' ),
		'categories' => array( 'sydney-cta' ),
		'keywords'   => array( 'cta', 'call to action', 'agency', 'digital', 'avatars', 'testimonial' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_6","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-6-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"768px"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:group {"style":{"spacing":{"blockGap":"0","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:image {"width":"44px","height":"44px","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"50%","width":"2px","color":"#00102E"}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border"><img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Client" class="has-border-color" style="border-color:#00102E;border-width:2px;border-radius:50%;width:44px;height:44px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"width":"44px","height":"44px","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"50%","width":"2px","color":"#00102E"},"spacing":{"margin":{"left":"-12px"}}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border" style="margin-left:-12px"><img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Client" class="has-border-color" style="border-color:#00102E;border-width:2px;border-radius:50%;width:44px;height:44px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"width":"44px","height":"44px","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"50%","width":"2px","color":"#00102E"},"spacing":{"margin":{"left":"-12px"}}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border" style="margin-left:-12px"><img src="https://randomuser.me/api/portraits/men/55.jpg" alt="Client" class="has-border-color" style="border-color:#00102E;border-width:2px;border-radius:50%;width:44px;height:44px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"className":"has-global-color-1-background-color has-background","style":{"dimensions":{"minHeight":"44px"},"border":{"radius":"50%","width":"2px","color":"#00102E"},"spacing":{"margin":{"left":"-12px"},"padding":{"top":"0","bottom":"0","left":"var:preset|spacing|20","right":"var:preset|spacing|20"}},"backgroundColor":"global_color_1"},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background has-border-color" style="border-color:#00102E;border-width:2px;border-radius:50%;min-height:44px;margin-left:-12px;padding-top:0;padding-right:var(--wp--preset--spacing--20);padding-bottom:0;padding-left:var(--wp--preset--spacing--20)"><!-- wp:paragraph {"style":{"typography":{"fontSize":"12px","fontStyle":"normal","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffff"}}} -->
<p class="has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0;font-size:12px;font-style:normal;font-weight:600">99+</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffff"}}} -->
<h2 class="wp-block-heading has-text-align-center has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0">Let\'s build something extraordinary together.</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}},"color":{"text":"#dbdbdb"}}} -->
<p class="has-text-align-center has-text-color" style="color:#dbdbdb;margin-top:var(--wp--preset--spacing--30);margin-bottom:0;font-size:18px">Whether you need a new website, a full rebrand, or a digital strategy that actually delivers — we\'re ready when you are.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"0"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:0"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">Get a Quote</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/cta-9',
	array(
		'title'      => __( 'CTA 9', 'sydney' ),
		'categories' => array( 'sydney-cta' ),
		'keywords'   => array( 'cta', 'call to action', 'agency', 'digital', 'stats' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_7","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-7-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60","left":"var:preset|spacing|60"},"margin":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center" style="margin-top:0;margin-bottom:0"><!-- wp:column {"verticalAlignment":"center","width":"50%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}},"color":{"text":"var:preset|color|global_color_1"}},"textColor":"global_color_1"} -->
<p class="has-global-color-1-color has-text-color" style="color:var(--wp--preset--color--global-color-1);margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:700;letter-spacing:0.1em;text-transform:uppercase">The Numbers Speak</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<h2 class="wp-block-heading" style="margin-top:0;margin-bottom:0">Let\'s build something extraordinary together.</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<p style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0;font-size:18px">Whether you need a new website, a full rebrand, or a digital strategy that actually delivers — we\'re ready when you are.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"0"}}}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:0"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">Start Your Project</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"50%","style":{"spacing":{"blockGap":"0"}}} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%"><!-- wp:group {"layout":{"type":"grid","columnCount":2,"minimumColumnWidth":null}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"color":{"background":"#ffffff"},"border":{"radius":"8px"},"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background" style="border-radius:8px;background-color:#ffffff;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"36px","fontStyle":"normal","fontWeight":"700"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-align-center" style="margin-top:0;margin-bottom:0;font-size:36px;font-style:normal;font-weight:700">12+</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-align-center" style="margin-top:0;margin-bottom:0">Years of Experience</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"color":{"background":"#ffffff"},"border":{"radius":"8px"},"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background" style="border-radius:8px;background-color:#ffffff;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"36px","fontStyle":"normal","fontWeight":"700"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-align-center" style="margin-top:0;margin-bottom:0;font-size:36px;font-style:normal;font-weight:700">3.5x</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-align-center" style="margin-top:0;margin-bottom:0">Average ROI Increase</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"color":{"background":"#ffffff"},"border":{"radius":"8px"},"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background" style="border-radius:8px;background-color:#ffffff;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"36px","fontStyle":"normal","fontWeight":"700"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-align-center" style="margin-top:0;margin-bottom:0;font-size:36px;font-style:normal;font-weight:700">98%</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-align-center" style="margin-top:0;margin-bottom:0">Client Satisfaction</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"color":{"background":"#ffffff"},"border":{"radius":"8px"},"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background" style="border-radius:8px;background-color:#ffffff;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"36px","fontStyle":"normal","fontWeight":"700"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-align-center" style="margin-top:0;margin-bottom:0;font-size:36px;font-style:normal;font-weight:700">200+</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-align-center" style="margin-top:0;margin-bottom:0">Projects Delivered</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/cta-10',
	array(
		'title'      => __( 'CTA 10', 'sydney' ),
		'categories' => array( 'sydney-cta' ),
		'keywords'   => array( 'cta', 'call to action', 'agency', 'image' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_9","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-9-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60","left":"var:preset|spacing|60"},"margin":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center" style="margin-top:0;margin-bottom:0"><!-- wp:column {"verticalAlignment":"center","width":"50%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%"><!-- wp:image {"sizeSlug":"large","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-large has-custom-border"><img src="https://images.unsplash.com/photo-1521791136064-7986c2920216?auto=format&amp;fit=crop&amp;w=1600" alt="Handshake with satisfied customer" style="border-radius:8px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"50%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%"><!-- wp:heading {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<h2 class="wp-block-heading" style="margin-top:0;margin-bottom:0">Ready to Get Your Project Started?</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"0"}}}} -->
<p style="margin-top:var(--wp--preset--spacing--40);margin-bottom:0;font-size:18px">Whether you need a complete brand strategy or a focused campaign, our team delivers results. Get in touch and let\'s discuss your goals.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"0"}}}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:0"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">Start a Project</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="#">Schedule a Call</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/cta-11',
	array(
		'title'      => __( 'CTA 11', 'sydney' ),
		'categories' => array( 'sydney-cta' ),
		'keywords'   => array( 'cta', 'call to action', 'agency', 'cover', 'image' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_9","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-9-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:cover {"url":"https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format\u0026fit=crop\u0026w=1600","alt":"Agency team at work","dimRatio":80,"overlayColor":"global_color_6","isUserOverlayColor":true,"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}},"border":{"radius":"8px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover alignwide" style="border-radius:8px;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><img class="wp-block-cover__image-background" alt="Agency team at work" src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&amp;fit=crop&amp;w=1600" data-object-fit="cover"/><span aria-hidden="true" class="wp-block-cover__background has-global-color-6-background-color has-background-dim-80 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"768px"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffff"}}} -->
<h2 class="wp-block-heading has-text-align-center has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0">Ready to Get Your Project Started?</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"0"}},"color":{"text":"#dbdbdb"}}} -->
<p class="has-text-align-center has-text-color" style="color:#dbdbdb;margin-top:var(--wp--preset--spacing--40);margin-bottom:0;font-size:18px">Whether you need a complete brand strategy or a focused campaign, our team delivers results. Get in touch and let\'s discuss your goals.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50","bottom":"0"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--50);margin-bottom:0"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">Start a Project</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline","style":{"color":{"text":"#ffffff"},"elements":{"link":{"color":{"text":"#ffffff"}}}}} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link has-text-color has-link-color wp-element-button" href="#" style="color:#ffffff">Schedule a Call</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover --></section>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/cta-12',
	array(
		'title'      => __( 'CTA 12', 'sydney' ),
		'categories' => array( 'sydney-cta' ),
		'keywords'   => array( 'cta', 'portfolio', 'agency' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"backgroundColor":"global_color_1","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-1-background-color has-background" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:heading {"textAlign":"center","style":{"color":{"text":"#ffffff"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}}}} -->
<h2 class="wp-block-heading has-text-align-center has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:var(--wp--preset--spacing--30)">Have a Project in Mind?</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"color":{"text":"rgba(255,255,255,0.8)"},"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|40"}}}} -->
<p class="has-text-align-center has-text-color" style="color:rgba(255,255,255,0.8);margin-top:0;margin-bottom:var(--wp--preset--spacing--40);font-size:18px">We are always open to new opportunities and exciting projects. Let\'s connect and bring your ideas to life.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons" style="margin-top:0;margin-bottom:0"><!-- wp:button {"style":{"color":{"background":"#ffffff","text":"#00102E"}}} -->
<div class="wp-block-button"><a class="wp-block-button__link has-text-color has-background wp-element-button" href="#" style="color:#00102E;background-color:#ffffff">Start a Conversation</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></section>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/cta-13',
	array(
		'title'      => __( 'CTA 13', 'sydney' ),
		'categories' => array( 'sydney-cta' ),
		'keywords'   => array( 'cta', 'portfolio', 'agency' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_9","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-9-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70","left":"var:preset|spacing|70","right":"var:preset|spacing|70"}},"border":{"radius":"8px"}},"backgroundColor":"global_color_6","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide has-global-color-6-background-color has-background" style="border-radius:8px;padding-top:var(--wp--preset--spacing--70);padding-right:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70);padding-left:var(--wp--preset--spacing--70)"><!-- wp:heading {"textAlign":"center","style":{"color":{"text":"#ffffff"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}}}} -->
<h2 class="wp-block-heading has-text-align-center has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:var(--wp--preset--spacing--30)">Have a Project in Mind?</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"color":{"text":"#ffffff99"},"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|40"}}}} -->
<p class="has-text-align-center has-text-color" style="color:#ffffff99;margin-top:0;margin-bottom:var(--wp--preset--spacing--40);font-size:18px">We\'re always open to new opportunities and exciting projects. Let\'s connect and bring your ideas to life.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons" style="margin-top:0;margin-bottom:0"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">Start a Conversation</a></div>
<!-- /wp:button -->

<!-- wp:button {"textColor":"white","className":"is-style-outline","style":{"elements":{"link":{"color":{"text":"var:preset|color|white"}}}}} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link has-white-color has-text-color has-link-color wp-element-button" href="#">View Our Work</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->',
	)
);


register_block_pattern(
	'sydney/cta-14',
	array(
		'title'      => __( 'CTA 14', 'sydney' ),
		'categories' => array( 'sydney-cta' ),
		'keywords'   => array( 'cta', 'professional-corporate' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_7","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-7-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"768px"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<h2 class="wp-block-heading has-text-align-center" style="margin-top:0;margin-bottom:0">Ready to Transform Your Business?</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<p class="has-text-align-center" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0;font-size:18px">Partner with our team of experts to unlock new opportunities, streamline operations, and accelerate sustainable growth for your organization.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50","bottom":"0"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--50);margin-bottom:0"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">Schedule a Free Consultation</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/cta-15',
	array(
		'title'      => __( 'CTA 15', 'sydney' ),
		'categories' => array( 'sydney-cta' ),
		'keywords'   => array( 'cta', 'professional-corporate' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_6","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-6-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"768px"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffff"}}} -->
<h2 class="wp-block-heading has-text-align-center has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0">Let\'s Build Your Growth Strategy</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}},"color":{"text":"#dbdbdb"}}} -->
<p class="has-text-align-center has-text-color" style="color:#dbdbdb;margin-top:var(--wp--preset--spacing--30);margin-bottom:0;font-size:18px">Our consultants have helped over 500 companies achieve measurable results. Let us show you how a tailored strategy can drive your business forward.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50","bottom":"0"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--50);margin-bottom:0"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">Get Started Today</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline","style":{"color":{"text":"#ffffff"},"elements":{"link":{"color":{"text":"#ffffff"}}}}} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link has-text-color has-link-color wp-element-button" href="#" style="color:#ffffff">Learn More</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/cta-16',
	array(
		'title'      => __( 'CTA 16', 'sydney' ),
		'categories' => array( 'sydney-cta' ),
		'keywords'   => array( 'cta', 'professional-corporate' ),
		'content'    => '<!-- wp:cover {"url":"https://images.unsplash.com/photo-1542744173-8e7e53415bb0?auto=format\u0026fit=crop\u0026w=1600","alt":"Conference room","dimRatio":80,"overlayColor":"global_color_6","isUserOverlayColor":true,"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)"><img class="wp-block-cover__image-background" alt="Conference room" src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?auto=format&amp;fit=crop&amp;w=1600" data-object-fit="cover"/><span aria-hidden="true" class="wp-block-cover__background has-global-color-6-background-color has-background-dim-80 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"768px"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffff"}}} -->
<h2 class="wp-block-heading has-text-align-center has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0">Let\'s Build Something Exceptional Together</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}},"color":{"text":"#dbdbdb"}}} -->
<p class="has-text-align-center has-text-color" style="color:#dbdbdb;margin-top:var(--wp--preset--spacing--30);margin-bottom:0;font-size:18px">Whether you\'re scaling operations, entering new markets, or optimizing performance — our team is here to make it happen. Start the conversation today.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50","bottom":"0"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--50);margin-bottom:0"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">Schedule Your Consultation</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover -->',
	)
);


// CTA 17 — Dark centered with eyebrow and office hours.
register_block_pattern(
	'sydney/cta-17',
	array(
		'title'      => __( 'CTA 17', 'sydney' ),
		'categories' => array( 'sydney-cta' ),
		'keywords'   => array( 'cta', 'call to action', 'agency' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"margin":{"top":"0","bottom":"0"}},"color":{"background":"#1c1c1c"}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-background" style="background-color:#1c1c1c;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"768px"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"500","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}}},"textColor":"white"} -->
<p class="has-text-align-center has-white-color has-text-color" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:500;letter-spacing:0.1em;text-transform:uppercase">Let\'s Work Together</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|40"}},"color":{"text":"#ffffff"}}} -->
<h2 class="wp-block-heading has-text-align-center has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:var(--wp--preset--spacing--40)">Start Your Next Project Today</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|40"}},"color":{"text":"#dbdbdb"}}} -->
<p class="has-text-align-center has-text-color" style="color:#dbdbdb;margin-top:0;margin-bottom:var(--wp--preset--spacing--40);font-size:18px">We work with forward-thinking brands to bring bold ideas to life. From strategy to execution, we\'re with you every step of the way.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|40"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--40)"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">Start a Project</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline","style":{"color":{"text":"#ffffff"},"elements":{"link":{"color":{"text":"#ffffff"}}}}} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link has-text-color has-link-color wp-element-button" href="#" style="color:#ffffff">View Our Work</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffffa8"}}} -->
<p class="has-text-align-center has-text-color" style="color:#ffffffa8;margin-top:0;margin-bottom:0">Mon – Fri: 9:00 AM – 6:00 PM  |  Weekend sessions by appointment</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->',
	)
);

// CTA 18 — Cover with background image and dark overlay.
register_block_pattern(
	'sydney/cta-18',
	array(
		'title'      => __( 'CTA 18', 'sydney' ),
		'categories' => array( 'sydney-cta' ),
		'keywords'   => array( 'cta', 'call to action', 'agency', 'cover' ),
		'content'    => '<!-- wp:cover {"url":"https://images.unsplash.com/photo-1497366216548-37526070297c?w=1920\u0026h=1080\u0026crop=entropy\u0026fit=crop","dimRatio":60,"overlayColor":"black","isUserOverlayColor":true,"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"margin":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-cover alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)"><img class="wp-block-cover__image-background" alt="" src="https://images.unsplash.com/photo-1497366216548-37526070297c?w=1920&amp;h=1080&amp;crop=entropy&amp;fit=crop" data-object-fit="cover"/><span aria-hidden="true" class="wp-block-cover__background has-black-background-color has-background-dim-60 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"768px"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"500","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}}},"textColor":"white"} -->
<p class="has-text-align-center has-white-color has-text-color" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:500;letter-spacing:0.1em;text-transform:uppercase">Let\'s Work Together</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|40"}},"color":{"text":"#ffffff"}}} -->
<h2 class="wp-block-heading has-text-align-center has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:var(--wp--preset--spacing--40)">Start Your Next Project Today</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|40"}},"color":{"text":"#dbdbdb"}}} -->
<p class="has-text-align-center has-text-color" style="color:#dbdbdb;margin-top:0;margin-bottom:var(--wp--preset--spacing--40);font-size:18px">We work with forward-thinking brands to bring bold ideas to life. From strategy to execution, we\'re with you every step of the way.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons" style="margin-top:0;margin-bottom:0"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">Start a Project</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline","style":{"color":{"text":"#ffffff"},"elements":{"link":{"color":{"text":"#ffffff"}}}}} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link has-text-color has-link-color wp-element-button" href="#" style="color:#ffffff">View Our Work</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover -->',
	)
);

// CTA 19 — Light background with three service cards.
register_block_pattern(
	'sydney/cta-19',
	array(
		'title'      => __( 'CTA 19', 'sydney' ),
		'categories' => array( 'sydney-cta' ),
		'keywords'   => array( 'cta', 'call to action', 'agency', 'services', 'cards' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_7","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-7-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained","contentSize":"768px"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--50)"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"500","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}},"color":{"text":"var:preset|color|global_color_1"}},"textColor":"global_color_1"} -->
<p class="has-text-align-center has-global-color-1-color has-text-color" style="color:var(--wp--preset--color--global-color-1);margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:500;letter-spacing:0.1em;text-transform:uppercase">What We Do</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<h2 class="wp-block-heading has-text-align-center" style="margin-top:0;margin-bottom:0">Start Your Next Project Today</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|40","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"grid","columnCount":3,"minimumColumnWidth":null}} -->
<div class="wp-block-group alignwide" style="margin-top:0;margin-bottom:0"><!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"margin":{"top":"0","bottom":"0"}},"border":{"radius":"8px"},"color":{"background":"#ffffff"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background" style="border-radius:8px;background-color:#ffffff;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--40)"><!-- wp:image {"width":"48px","height":"48px","sizeSlug":"full","linkDestination":"none","align":"center","style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}},"color":{"duotone":"var:preset|duotone|dark-grayscale"}}} -->
<figure class="wp-block-image aligncenter size-full is-resized" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30)"><img src="data:image/svg+xml,%3Csvg%20xmlns=%27http://www.w3.org/2000/svg%27%20width=%2748%27%20height=%2748%27%20viewBox=%270%200%2024%2024%27%20fill=%27none%27%20stroke=%27%23c1272d%27%20stroke-width=%271.5%27%20stroke-linecap=%27round%27%20stroke-linejoin=%27round%27%3E%3Ccircle%20cx=%2712%27%20cy=%2712%27%20r=%2710%27/%3E%3Cpolyline%20points=%2712%206%2012%2012%2016%2014%27/%3E%3C/svg%3E" alt="Strategy icon" style="width:48px;height:48px"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"textAlign":"center","level":4,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|20"}}}} -->
<h4 class="wp-block-heading has-text-align-center" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--20)">Strategy & Planning</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}}}} -->
<p class="has-text-align-center" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30)">We align your brand vision with market insight to build campaigns that resonate with your audience.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons" style="margin-top:0;margin-bottom:0"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">Start a Project</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"margin":{"top":"0","bottom":"0"}},"border":{"radius":"8px"},"color":{"background":"#ffffff"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background" style="border-radius:8px;background-color:#ffffff;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--40)"><!-- wp:image {"width":"48px","height":"48px","sizeSlug":"full","linkDestination":"none","align":"center","style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}},"color":{"duotone":"var:preset|duotone|dark-grayscale"}}} -->
<figure class="wp-block-image aligncenter size-full is-resized" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30)"><img src="data:image/svg+xml,%3Csvg%20xmlns=%27http://www.w3.org/2000/svg%27%20width=%2748%27%20height=%2748%27%20viewBox=%270%200%2024%2024%27%20fill=%27none%27%20stroke=%27%23c1272d%27%20stroke-width=%271.5%27%20stroke-linecap=%27round%27%20stroke-linejoin=%27round%27%3E%3Cpath%20d=%27M6%202L3%206v14a2%202%200%200%200%202%202h14a2%202%200%200%200%202-2V6l-3-4z%27/%3E%3Cline%20x1=%273%27%20y1=%276%27%20x2=%2721%27%20y2=%276%27/%3E%3Cpath%20d=%27M16%2010a4%204%200%200%201-8%200%27/%3E%3C/svg%3E" alt="Design icon" style="width:48px;height:48px"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"textAlign":"center","level":4,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|20"}}}} -->
<h4 class="wp-block-heading has-text-align-center" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--20)">Design & Build</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}}}} -->
<p class="has-text-align-center" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30)">From wireframes to final delivery, we craft digital experiences that engage your audience and drive measurable results.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons" style="margin-top:0;margin-bottom:0"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">Learn More</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"margin":{"top":"0","bottom":"0"}},"border":{"radius":"8px"},"color":{"background":"#ffffff"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background" style="border-radius:8px;background-color:#ffffff;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--40)"><!-- wp:image {"width":"48px","height":"48px","sizeSlug":"full","linkDestination":"none","align":"center","style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}},"color":{"duotone":"var:preset|duotone|dark-grayscale"}}} -->
<figure class="wp-block-image aligncenter size-full is-resized" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30)"><img src="data:image/svg+xml,%3Csvg%20xmlns=%27http://www.w3.org/2000/svg%27%20width=%2748%27%20height=%2748%27%20viewBox=%270%200%2024%2024%27%20fill=%27none%27%20stroke=%27%23c1272d%27%20stroke-width=%271.5%27%20stroke-linecap=%27round%27%20stroke-linejoin=%27round%27%3E%3Cpath%20d=%27M17%2021v-2a4%204%200%200%200-4-4H5a4%204%200%200%200-4%204v2%27/%3E%3Ccircle%20cx=%279%27%20cy=%277%27%20r=%274%27/%3E%3Cpath%20d=%27M23%2021v-2a4%204%200%200%200-3-3.87%27/%3E%3Cpath%20d=%27M16%203.13a4%204%200%200%201%200%207.75%27/%3E%3C/svg%3E" alt="Support icon" style="width:48px;height:48px"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"textAlign":"center","level":4,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|20"}}}} -->
<h4 class="wp-block-heading has-text-align-center" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--20)">Ongoing Support</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}}}} -->
<p class="has-text-align-center" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30)">After launch, we stay in your corner with maintenance, optimization, and growth support to keep your brand performing.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons" style="margin-top:0;margin-bottom:0"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">Learn More</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->',
	)
);
