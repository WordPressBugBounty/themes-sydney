<?php
/**
 * Testimonials patterns
 *
 * @package Sydney
 */

register_block_pattern(
	'sydney/testimonials-1',
	array(
		'title'      => __( 'Testimonials 1', 'sydney' ),
		'categories' => array( 'sydney-testimonials' ),
		'keywords'   => array( 'testimonials', 'agency', 'digital', 'quote', 'single' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_6","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-6-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"768px"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:image {"width":"48px","height":"48px","sizeSlug":"full","linkDestination":"none","align":"center","className":"is-resized","style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|40"}},"color":{"duotone":["rgba(255, 255, 255, 0.46)","rgba(255, 255, 255, 0.46)"]}}} -->
<figure class="wp-block-image aligncenter size-full is-resized" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--40)"><img src="data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 24 24\' fill=\'%23dc2626\'%3E%3Cpath d=\'M9.983 3v7.391c0 5.704-3.731 9.57-8.983 10.609l-.995-2.151c2.432-.917 3.995-3.638 3.995-5.849H0V3h9.983zM24 3v7.391c0 5.704-3.731 9.57-8.983 10.609l-.995-2.151c2.432-.917 3.995-3.638 3.995-5.849H14V3h10z\' /%3E%3C/svg%3E" alt="Quote icon" style="width:48px;height:48px"/></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"22px","fontStyle":"italic","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffff"}}} -->
<p class="has-text-align-center has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0;font-size:22px;font-style:italic;font-weight:600">"They didn\'t just build us a website — they built us a growth engine. Traffic tripled in six months and conversions have never been higher."</p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50","bottom":"0"},"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--50);margin-bottom:0"><!-- wp:image {"width":"56px","height":"56px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"border":{"radius":"50%"}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border"><img src="https://randomuser.me/api/portraits/women/63.jpg" alt="Sarah Mitchell" style="border-radius:50%;width:56px;height:56px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffff"}}} -->
<p class="has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0;font-style:normal;font-weight:600">Sarah Mitchell</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#dbdbdb"}}} -->
<p class="has-text-color" style="color:#dbdbdb;margin-top:0;margin-bottom:0;font-size:14px">CMO, Elevate Commerce</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/testimonials-2',
	array(
		'title'      => __( 'Testimonials 2', 'sydney' ),
		'categories' => array( 'sydney-testimonials' ),
		'keywords'   => array( 'testimonials', 'agency', 'digital', 'grid', 'columns' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_7","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-7-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"768px"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}},"color":{"text":"var:preset|color|global_color_1"}},"textColor":"global_color_1"} -->
<p class="has-text-align-center has-global-color-1-color has-text-color" style="color:var(--wp--preset--color--global-color-1);margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:700;letter-spacing:0.1em;text-transform:uppercase">Client Testimonials</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<h2 class="wp-block-heading has-text-align-center" style="margin-top:0;margin-bottom:0">What our clients say about us.</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<p class="has-text-align-center" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0;font-size:18px">We let our results — and our clients — do the talking.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|50","left":"var:preset|spacing|50"},"margin":{"top":"var:preset|spacing|50","bottom":"0"}}}} -->
<div class="wp-block-columns alignwide" style="margin-top:var(--wp--preset--spacing--50);margin-bottom:0"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"color":{"background":"#ffffff"},"border":{"radius":"8px"},"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background" style="border-radius:8px;background-color:#ffffff;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:group {"style":{"spacing":{"blockGap":"4px","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:image {"width":"20px","height":"20px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"color":{"duotone":["#E6A414","#E6A414"]}}} -->
<figure class="wp-block-image size-full is-resized"><img src="data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 24 24\' fill=\'%23dc2626\'%3E%3Cpath fill-rule=\'evenodd\' d=\'M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z\' clip-rule=\'evenodd\' /%3E%3C/svg%3E" alt="Star" style="width:20px;height:20px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"width":"20px","height":"20px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"color":{"duotone":["#E6A414","#E6A414"]}}} -->
<figure class="wp-block-image size-full is-resized"><img src="data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 24 24\' fill=\'%23dc2626\'%3E%3Cpath fill-rule=\'evenodd\' d=\'M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z\' clip-rule=\'evenodd\' /%3E%3C/svg%3E" alt="Star" style="width:20px;height:20px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"width":"20px","height":"20px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"color":{"duotone":["#E6A414","#E6A414"]}}} -->
<figure class="wp-block-image size-full is-resized"><img src="data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 24 24\' fill=\'%23dc2626\'%3E%3Cpath fill-rule=\'evenodd\' d=\'M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z\' clip-rule=\'evenodd\' /%3E%3C/svg%3E" alt="Star" style="width:20px;height:20px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"width":"20px","height":"20px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"color":{"duotone":["#E6A414","#E6A414"]}}} -->
<figure class="wp-block-image size-full is-resized"><img src="data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 24 24\' fill=\'%23dc2626\'%3E%3Cpath fill-rule=\'evenodd\' d=\'M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z\' clip-rule=\'evenodd\' /%3E%3C/svg%3E" alt="Star" style="width:20px;height:20px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"width":"20px","height":"20px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"color":{"duotone":["#E6A414","#E6A414"]}}} -->
<figure class="wp-block-image size-full is-resized"><img src="data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 24 24\' fill=\'%23dc2626\'%3E%3Cpath fill-rule=\'evenodd\' d=\'M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z\' clip-rule=\'evenodd\' /%3E%3C/svg%3E" alt="Star" style="width:20px;height:20px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"18px","fontStyle":"italic"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0;font-size:18px;font-style:italic">"They didn\'t just build us a website — they built us a growth engine. Traffic tripled in six months and conversions have never been higher."</p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"0"},"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:0"><!-- wp:image {"width":"48px","height":"48px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"border":{"radius":"50%"}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border"><img src="https://randomuser.me/api/portraits/women/63.jpg" alt="Sarah Mitchell" style="border-radius:50%;width:48px;height:48px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontSize":"16px","fontStyle":"normal","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0;font-size:16px;font-style:normal;font-weight:600">Sarah Mitchell</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#6d7685"}}} -->
<p class="has-text-color" style="color:#6d7685;margin-top:0;margin-bottom:0;font-size:14px">CMO, Elevate Commerce</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"color":{"background":"#ffffff"},"border":{"radius":"8px"},"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background" style="border-radius:8px;background-color:#ffffff;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:group {"style":{"spacing":{"blockGap":"4px","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:image {"width":"20px","height":"20px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"color":{"duotone":["#E6A414","#E6A414"]}}} -->
<figure class="wp-block-image size-full is-resized"><img src="data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 24 24\' fill=\'%23dc2626\'%3E%3Cpath fill-rule=\'evenodd\' d=\'M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z\' clip-rule=\'evenodd\' /%3E%3C/svg%3E" alt="Star" style="width:20px;height:20px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"width":"20px","height":"20px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"color":{"duotone":["#E6A414","#E6A414"]}}} -->
<figure class="wp-block-image size-full is-resized"><img src="data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 24 24\' fill=\'%23dc2626\'%3E%3Cpath fill-rule=\'evenodd\' d=\'M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z\' clip-rule=\'evenodd\' /%3E%3C/svg%3E" alt="Star" style="width:20px;height:20px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"width":"20px","height":"20px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"color":{"duotone":["#E6A414","#E6A414"]}}} -->
<figure class="wp-block-image size-full is-resized"><img src="data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 24 24\' fill=\'%23dc2626\'%3E%3Cpath fill-rule=\'evenodd\' d=\'M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z\' clip-rule=\'evenodd\' /%3E%3C/svg%3E" alt="Star" style="width:20px;height:20px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"width":"20px","height":"20px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"color":{"duotone":["#E6A414","#E6A414"]}}} -->
<figure class="wp-block-image size-full is-resized"><img src="data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 24 24\' fill=\'%23dc2626\'%3E%3Cpath fill-rule=\'evenodd\' d=\'M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z\' clip-rule=\'evenodd\' /%3E%3C/svg%3E" alt="Star" style="width:20px;height:20px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"width":"20px","height":"20px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"color":{"duotone":["#E6A414","#E6A414"]}}} -->
<figure class="wp-block-image size-full is-resized"><img src="data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 24 24\' fill=\'%23dc2626\'%3E%3Cpath fill-rule=\'evenodd\' d=\'M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z\' clip-rule=\'evenodd\' /%3E%3C/svg%3E" alt="Star" style="width:20px;height:20px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"18px","fontStyle":"italic"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0;font-size:18px;font-style:italic">"From concept to launch, the process was seamless. They understood our vision instantly and delivered a product that exceeded every expectation."</p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"0"},"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:0"><!-- wp:image {"width":"48px","height":"48px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"border":{"radius":"50%"}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border"><img src="https://randomuser.me/api/portraits/men/45.jpg" alt="James Thornton" style="border-radius:50%;width:48px;height:48px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontSize":"16px","fontStyle":"normal","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0;font-size:16px;font-style:normal;font-weight:600">James Thornton</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#6d7685"}}} -->
<p class="has-text-color" style="color:#6d7685;margin-top:0;margin-bottom:0;font-size:14px">Founder, Thornton Labs</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"color":{"background":"#ffffff"},"border":{"radius":"8px"},"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background" style="border-radius:8px;background-color:#ffffff;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:group {"style":{"spacing":{"blockGap":"4px","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:image {"width":"20px","height":"20px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"color":{"duotone":["#E6A414","#E6A414"]}}} -->
<figure class="wp-block-image size-full is-resized"><img src="data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 24 24\' fill=\'%23dc2626\'%3E%3Cpath fill-rule=\'evenodd\' d=\'M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z\' clip-rule=\'evenodd\' /%3E%3C/svg%3E" alt="Star" style="width:20px;height:20px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"width":"20px","height":"20px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"color":{"duotone":["#E6A414","#E6A414"]}}} -->
<figure class="wp-block-image size-full is-resized"><img src="data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 24 24\' fill=\'%23dc2626\'%3E%3Cpath fill-rule=\'evenodd\' d=\'M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z\' clip-rule=\'evenodd\' /%3E%3C/svg%3E" alt="Star" style="width:20px;height:20px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"width":"20px","height":"20px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"color":{"duotone":["#E6A414","#E6A414"]}}} -->
<figure class="wp-block-image size-full is-resized"><img src="data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 24 24\' fill=\'%23dc2626\'%3E%3Cpath fill-rule=\'evenodd\' d=\'M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z\' clip-rule=\'evenodd\' /%3E%3C/svg%3E" alt="Star" style="width:20px;height:20px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"width":"20px","height":"20px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"color":{"duotone":["#E6A414","#E6A414"]}}} -->
<figure class="wp-block-image size-full is-resized"><img src="data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 24 24\' fill=\'%23dc2626\'%3E%3Cpath fill-rule=\'evenodd\' d=\'M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z\' clip-rule=\'evenodd\' /%3E%3C/svg%3E" alt="Star" style="width:20px;height:20px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"width":"20px","height":"20px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"color":{"duotone":["#E6A414","#E6A414"]}}} -->
<figure class="wp-block-image size-full is-resized"><img src="data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 24 24\' fill=\'%23dc2626\'%3E%3Cpath fill-rule=\'evenodd\' d=\'M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z\' clip-rule=\'evenodd\' /%3E%3C/svg%3E" alt="Star" style="width:20px;height:20px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"18px","fontStyle":"italic"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0;font-size:18px;font-style:italic">"Their strategic approach to our rebrand was game-changing. We saw a 40% increase in qualified leads within the first quarter of launch."</p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"0"},"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:0"><!-- wp:image {"width":"48px","height":"48px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"border":{"radius":"50%"}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border"><img src="https://randomuser.me/api/portraits/women/28.jpg" alt="Elena Vasquez" style="border-radius:50%;width:48px;height:48px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontSize":"16px","fontStyle":"normal","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0;font-size:16px;font-style:normal;font-weight:600">Elena Vasquez</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#6d7685"}}} -->
<p class="has-text-color" style="color:#6d7685;margin-top:0;margin-bottom:0;font-size:14px">CEO, Bright Pixel</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/testimonials-3',
	array(
		'title'      => __( 'Testimonials 3', 'sydney' ),
		'categories' => array( 'sydney-testimonials' ),
		'keywords'   => array( 'testimonials', 'agency', 'digital', 'split', 'image' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60","left":"var:preset|spacing|60"},"margin":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center" style="margin-top:0;margin-bottom:0"><!-- wp:column {"verticalAlignment":"center","width":"50%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}},"color":{"text":"var:preset|color|global_color_1"}},"textColor":"global_color_1"} -->
<p class="has-global-color-1-color has-text-color" style="color:var(--wp--preset--color--global-color-1);margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:700;letter-spacing:0.1em;text-transform:uppercase">Client Testimonials</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"28px","fontStyle":"italic","fontWeight":"700"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0;font-size:28px;font-style:italic;font-weight:700">"They didn\'t just build us a website — they built us a growth engine. Traffic tripled in six months."</p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50","bottom":"0"},"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--50);margin-bottom:0"><!-- wp:image {"width":"56px","height":"56px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"border":{"radius":"50%"}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border"><img src="https://randomuser.me/api/portraits/women/63.jpg" alt="Sarah Mitchell" style="border-radius:50%;width:56px;height:56px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontSize":"16px","fontStyle":"normal","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0;font-size:16px;font-style:normal;font-weight:600">Sarah Mitchell</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#6d7685"}}} -->
<p class="has-text-color" style="color:#6d7685;margin-top:0;margin-bottom:0;font-size:14px">CMO, Elevate Commerce</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"50%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%"><!-- wp:image {"sizeSlug":"large","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-large has-custom-border"><img src="https://images.unsplash.com/photo-1553877522-43269d4ea984?auto=format&amp;fit=crop&amp;w=1600" alt="Team collaboration" style="border-radius:8px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/testimonials-4',
	array(
		'title'      => __( 'Testimonials 4', 'sydney' ),
		'categories' => array( 'sydney-testimonials' ),
		'keywords'   => array( 'testimonials', 'agency', 'digital', 'dark', 'grid' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_6","layout":{"type":"constrained","wideSize":"920px"}} -->
<section class="wp-block-group alignfull has-global-color-6-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"768px"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}}},"textColor":"white"} -->
<p class="has-text-align-center has-white-color has-text-color" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:700;letter-spacing:0.1em;text-transform:uppercase">Client Testimonials</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffff"}}} -->
<h2 class="wp-block-heading has-text-align-center has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0">What our clients say about us.</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}},"layout":{"type":"grid","columnCount":2,"minimumColumnWidth":null}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--50)"><!-- wp:group {"style":{"border":{"radius":"8px","color":"#ffffff52","width":"1px"},"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_6","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-border-color has-global-color-6-background-color has-background" style="border-color:#ffffff52;border-width:1px;border-radius:8px;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:paragraph {"style":{"typography":{"fontSize":"18px","fontStyle":"italic"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#dbdbdb"}}} -->
<p class="has-text-color" style="color:#dbdbdb;margin-top:0;margin-bottom:0;font-size:18px;font-style:italic">"Their strategic approach to our rebrand was game-changing. We saw a 40% increase in qualified leads within the first quarter of launch."</p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"0"},"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:0"><!-- wp:image {"width":"48px","height":"48px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"border":{"radius":"50%"}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border"><img src="https://randomuser.me/api/portraits/women/28.jpg" alt="Elena Vasquez" style="border-radius:50%;width:48px;height:48px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontSize":"16px","fontStyle":"normal","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffff"}}} -->
<p class="has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0;font-size:16px;font-style:normal;font-weight:600">Elena Vasquez</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#dbdbdb"}}} -->
<p class="has-text-color" style="color:#dbdbdb;margin-top:0;margin-bottom:0;font-size:14px">CEO, Bright Pixel</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"border":{"radius":"8px","color":"#ffffff52","width":"1px"},"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_6","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-border-color has-global-color-6-background-color has-background" style="border-color:#ffffff52;border-width:1px;border-radius:8px;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:paragraph {"style":{"typography":{"fontSize":"18px","fontStyle":"italic"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#dbdbdb"}}} -->
<p class="has-text-color" style="color:#dbdbdb;margin-top:0;margin-bottom:0;font-size:18px;font-style:italic">"From concept to launch, the process was seamless. They understood our vision instantly and delivered a great product."</p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"0"},"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:0"><!-- wp:image {"width":"48px","height":"48px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"border":{"radius":"50%"}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border"><img src="https://randomuser.me/api/portraits/men/45.jpg" alt="James Thornton" style="border-radius:50%;width:48px;height:48px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontSize":"16px","fontStyle":"normal","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffff"}}} -->
<p class="has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0;font-size:16px;font-style:normal;font-weight:600">James Thornton</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#dbdbdb"}}} -->
<p class="has-text-color" style="color:#dbdbdb;margin-top:0;margin-bottom:0;font-size:14px">Founder, Thornton Labs</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"border":{"radius":"8px","color":"#ffffff52","width":"1px"},"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_6","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-border-color has-global-color-6-background-color has-background" style="border-color:#ffffff52;border-width:1px;border-radius:8px;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:paragraph {"style":{"typography":{"fontSize":"18px","fontStyle":"italic"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#dbdbdb"}}} -->
<p class="has-text-color" style="color:#dbdbdb;margin-top:0;margin-bottom:0;font-size:18px;font-style:italic">"They didn\'t just build us a website — they built us a growth engine. Traffic tripled in six months and conversions have never been higher."</p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"0"},"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:0"><!-- wp:image {"width":"48px","height":"48px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"border":{"radius":"50%"}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border"><img src="https://randomuser.me/api/portraits/women/63.jpg" alt="Sarah Mitchell" style="border-radius:50%;width:48px;height:48px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontSize":"16px","fontStyle":"normal","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffff"}}} -->
<p class="has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0;font-size:16px;font-style:normal;font-weight:600">Sarah Mitchell</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#dbdbdb"}}} -->
<p class="has-text-color" style="color:#dbdbdb;margin-top:0;margin-bottom:0;font-size:14px">CMO, Elevate Commerce</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"border":{"radius":"8px","color":"#ffffff52","width":"1px"},"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_6","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-border-color has-global-color-6-background-color has-background" style="border-color:#ffffff52;border-width:1px;border-radius:8px;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:paragraph {"style":{"typography":{"fontSize":"18px","fontStyle":"italic"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#dbdbdb"}}} -->
<p class="has-text-color" style="color:#dbdbdb;margin-top:0;margin-bottom:0;font-size:18px;font-style:italic">"We\'ve worked with agencies before, but none matched their level of transparency and craft. They feel like an extension of our own team."</p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"0"},"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:0"><!-- wp:image {"width":"48px","height":"48px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"border":{"radius":"50%"}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border"><img src="https://randomuser.me/api/portraits/men/22.jpg" alt="David Park" style="border-radius:50%;width:48px;height:48px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontSize":"16px","fontStyle":"normal","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffff"}}} -->
<p class="has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0;font-size:16px;font-style:normal;font-weight:600">David Park</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#dbdbdb"}}} -->
<p class="has-text-color" style="color:#dbdbdb;margin-top:0;margin-bottom:0;font-size:14px">CTO, Nexus Health</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/testimonials-5',
	array(
		'title'      => __( 'Testimonials 5', 'sydney' ),
		'categories' => array( 'sydney-testimonials' ),
		'keywords'   => array( 'testimonials', 'agency', 'digital', 'social-proof', 'centered' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_7","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-7-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"768px"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|20"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--20)"><!-- wp:group {"style":{"spacing":{"blockGap":"0","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:image {"width":"44px","height":"44px","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"50%","width":"2px","color":"#F4F5F7"}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border"><img src="https://randomuser.me/api/portraits/women/63.jpg" alt="Client" class="has-border-color" style="border-color:#F4F5F7;border-width:2px;border-radius:50%;width:44px;height:44px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"width":"44px","height":"44px","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"50%","width":"2px","color":"#F4F5F7"},"spacing":{"margin":{"left":"-12px"}}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border" style="margin-left:-12px"><img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Client" class="has-border-color" style="border-color:#F4F5F7;border-width:2px;border-radius:50%;width:44px;height:44px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"width":"44px","height":"44px","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"50%","width":"2px","color":"#F4F5F7"},"spacing":{"margin":{"left":"-12px"}}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border" style="margin-left:-12px"><img src="https://randomuser.me/api/portraits/women/28.jpg" alt="Client" class="has-border-color" style="border-color:#F4F5F7;border-width:2px;border-radius:50%;width:44px;height:44px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"width":"44px","height":"44px","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"50%","width":"2px","color":"#F4F5F7"},"spacing":{"margin":{"left":"-12px"}}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border" style="margin-left:-12px"><img src="https://randomuser.me/api/portraits/men/22.jpg" alt="Client" class="has-border-color" style="border-color:#F4F5F7;border-width:2px;border-radius:50%;width:44px;height:44px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"style":{"dimensions":{"minHeight":"44px"},"border":{"radius":"50%","width":"2px","color":"#F4F5F7"},"spacing":{"margin":{"left":"-12px"},"padding":{"top":"0","bottom":"0","left":"var:preset|spacing|20","right":"var:preset|spacing|20"}}},"backgroundColor":"global_color_6","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-border-color has-global-color-6-background-color has-background" style="border-color:#F4F5F7;border-width:2px;border-radius:50%;min-height:44px;margin-left:-12px;padding-top:0;padding-right:var(--wp--preset--spacing--20);padding-bottom:0;padding-left:var(--wp--preset--spacing--20)"><!-- wp:paragraph {"style":{"typography":{"fontSize":"12px","fontStyle":"normal","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffff"}}} -->
<p class="has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0;font-size:12px;font-style:normal;font-weight:600">50+</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}},"color":{"text":"var:preset|color|global_color_1"}},"textColor":"global_color_1"} -->
<p class="has-text-align-center has-global-color-1-color has-text-color" style="color:var(--wp--preset--color--global-color-1);margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:700;letter-spacing:0.1em;text-transform:uppercase">Trusted by 50+ Brands</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"28px","fontStyle":"italic","fontWeight":"700"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-align-center" style="margin-top:0;margin-bottom:0;font-size:28px;font-style:italic;font-weight:700">"They didn\'t just build us a website — they built us a growth engine. Traffic tripled in six months and conversions have never been higher."</p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--50);margin-bottom:0"><!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"16px","fontStyle":"normal","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-align-center" style="margin-top:0;margin-bottom:0;font-size:16px;font-style:normal;font-weight:600">Sarah Mitchell</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#6d7685"}}} -->
<p class="has-text-align-center has-text-color" style="color:#6d7685;margin-top:0;margin-bottom:0;font-size:14px">CMO, Elevate Commerce</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/testimonials-6',
	array(
		'title'      => __( 'Testimonials 6', 'sydney' ),
		'categories' => array( 'sydney-testimonials' ),
		'keywords'   => array( 'testimonials', 'agency', 'digital', 'asymmetric', 'light' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60","left":"var:preset|spacing|60"},"margin":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-columns alignwide" style="margin-top:0;margin-bottom:0"><!-- wp:column {"width":"33.33%"} -->
<div class="wp-block-column" style="flex-basis:33.33%"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}},"color":{"text":"var:preset|color|global_color_1"}},"textColor":"global_color_1"} -->
<p class="has-global-color-1-color has-text-color" style="color:var(--wp--preset--color--global-color-1);margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:700;letter-spacing:0.1em;text-transform:uppercase">Client Testimonials</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<h2 class="wp-block-heading" style="margin-top:0;margin-bottom:0">What our clients say about us.</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"0"}}}} -->
<p style="margin-top:var(--wp--preset--spacing--40);margin-bottom:0;font-size:18px">We let our results — and our clients — do the talking.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"66.66%"} -->
<div class="wp-block-column" style="flex-basis:66.66%"><!-- wp:group {"layout":{"type":"grid","columnCount":2,"minimumColumnWidth":null}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"color":{"background":"#F4F5F7"},"border":{"radius":"8px"},"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background" style="border-radius:8px;background-color:#F4F5F7;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:paragraph {"style":{"typography":{"fontSize":"18px","fontStyle":"italic"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0;font-size:18px;font-style:italic">"We\'ve worked with agencies before, but none matched their level of transparency and craft. They feel like an extension of our own team."</p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"0"},"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:0"><!-- wp:image {"width":"48px","height":"48px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"border":{"radius":"50%"}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border"><img src="https://randomuser.me/api/portraits/men/22.jpg" alt="David Park" style="border-radius:50%;width:48px;height:48px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontSize":"16px","fontStyle":"normal","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0;font-size:16px;font-style:normal;font-weight:600">David Park</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#6d7685"}}} -->
<p class="has-text-color" style="color:#6d7685;margin-top:0;margin-bottom:0;font-size:14px">CTO, Nexus Health</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"color":{"background":"#F4F5F7"},"border":{"radius":"8px"},"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background" style="border-radius:8px;background-color:#F4F5F7;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:paragraph {"style":{"typography":{"fontSize":"18px","fontStyle":"italic"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0;font-size:18px;font-style:italic">"Their strategic approach to our rebrand was game-changing. We saw a 40% increase in qualified leads within the first quarter of launch."</p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"0"},"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:0"><!-- wp:image {"width":"48px","height":"48px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"border":{"radius":"50%"}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border"><img src="https://randomuser.me/api/portraits/women/28.jpg" alt="Elena Vasquez" style="border-radius:50%;width:48px;height:48px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontSize":"16px","fontStyle":"normal","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0;font-size:16px;font-style:normal;font-weight:600">Elena Vasquez</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#6d7685"}}} -->
<p class="has-text-color" style="color:#6d7685;margin-top:0;margin-bottom:0;font-size:14px">CEO, Bright Pixel</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"color":{"background":"#F4F5F7"},"border":{"radius":"8px"},"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background" style="border-radius:8px;background-color:#F4F5F7;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:paragraph {"style":{"typography":{"fontSize":"18px","fontStyle":"italic"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0;font-size:18px;font-style:italic">"They didn\'t just build us a website — they built us a growth engine. Traffic tripled in six months and conversions have never been higher."</p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"0"},"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:0"><!-- wp:image {"width":"48px","height":"48px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"border":{"radius":"50%"}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border"><img src="https://randomuser.me/api/portraits/women/63.jpg" alt="Sarah Mitchell" style="border-radius:50%;width:48px;height:48px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontSize":"16px","fontStyle":"normal","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0;font-size:16px;font-style:normal;font-weight:600">Sarah Mitchell</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#6d7685"}}} -->
<p class="has-text-color" style="color:#6d7685;margin-top:0;margin-bottom:0;font-size:14px">CMO, Elevate Commerce</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"color":{"background":"#F4F5F7"},"border":{"radius":"8px"},"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background" style="border-radius:8px;background-color:#F4F5F7;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:paragraph {"style":{"typography":{"fontSize":"18px","fontStyle":"italic"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0;font-size:18px;font-style:italic">"From concept to launch, the process was seamless. They understood our vision instantly and delivered a product that exceeded every expectation."</p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"0"},"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:0"><!-- wp:image {"width":"48px","height":"48px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"border":{"radius":"50%"}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border"><img src="https://randomuser.me/api/portraits/men/45.jpg" alt="James Thornton" style="border-radius:50%;width:48px;height:48px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontSize":"16px","fontStyle":"normal","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0;font-size:16px;font-style:normal;font-weight:600">James Thornton</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#6d7685"}}} -->
<p class="has-text-color" style="color:#6d7685;margin-top:0;margin-bottom:0;font-size:14px">Founder, Thornton Labs</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/testimonials-7',
	array(
		'title'      => __( 'Testimonials 7', 'sydney' ),
		'categories' => array( 'sydney-testimonials' ),
		'keywords'   => array( 'testimonials', 'agency', 'digital', 'cover', 'fullwidth' ),
		'content'    => '<!-- wp:cover {"url":"https://images.unsplash.com/photo-1497215842964-222b430dc094?auto=format&fit=crop&w=1600","dimRatio":85,"overlayColor":"global_color_6","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)"><img class="wp-block-cover__image-background" alt="" src="https://images.unsplash.com/photo-1497215842964-222b430dc094?auto=format&amp;fit=crop&amp;w=1600" data-object-fit="cover"/><span aria-hidden="true" class="wp-block-cover__background has-global-color-6-background-color has-background-dim-90 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"768px"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:image {"width":"48px","height":"48px","sizeSlug":"full","linkDestination":"none","align":"center","className":"is-resized","style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|40"}},"color":{"duotone":["rgba(255, 255, 255, 0.46)","rgba(255, 255, 255, 0.46)"]}}} -->
<figure class="wp-block-image aligncenter size-full is-resized" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--40)"><img src="data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 24 24\' fill=\'%23dc2626\'%3E%3Cpath d=\'M9.983 3v7.391c0 5.704-3.731 9.57-8.983 10.609l-.995-2.151c2.432-.917 3.995-3.638 3.995-5.849H0V3h9.983zM24 3v7.391c0 5.704-3.731 9.57-8.983 10.609l-.995-2.151c2.432-.917 3.995-3.638 3.995-5.849H14V3h10z\' /%3E%3C/svg%3E" alt="Quote icon" style="width:48px;height:48px"/></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"22px","fontStyle":"italic","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffff"}}} -->
<p class="has-text-align-center has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0;font-size:22px;font-style:italic;font-weight:600">"From concept to launch, the process was seamless. They understood our vision instantly and delivered a product that exceeded every expectation we had."</p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"0"},"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:0"><!-- wp:image {"width":"56px","height":"56px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"border":{"radius":"50%"}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border"><img src="https://randomuser.me/api/portraits/men/45.jpg" alt="James Thornton" style="border-radius:50%;width:56px;height:56px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontSize":"16px","fontStyle":"normal","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffff"}}} -->
<p class="has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0;font-size:16px;font-style:normal;font-weight:600">James Thornton</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#dbdbdb"}}} -->
<p class="has-text-color" style="color:#dbdbdb;margin-top:0;margin-bottom:0;font-size:14px">Founder, Thornton Labs</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover -->',
	)
);

register_block_pattern(
	'sydney/testimonials-8',
	array(
		'title'      => __( 'Testimonials 8', 'sydney' ),
		'categories' => array( 'sydney-testimonials' ),
		'keywords'   => array( 'testimonials', 'agency', 'digital', 'dark', 'columns' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_6","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-6-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|50","left":"var:preset|spacing|50"},"margin":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-columns alignwide" style="margin-top:0;margin-bottom:0"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"border":{"radius":"8px","color":"#ffffff52","width":"1px"},"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_6","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-border-color has-global-color-6-background-color has-background" style="border-color:#ffffff52;border-width:1px;border-radius:8px;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:group {"style":{"typography":{"fontSize":"18px","fontStyle":"italic"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#dbdbdb"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group has-text-color" style="color:#dbdbdb;margin-top:0;margin-bottom:0;font-size:18px;font-style:italic"><!-- wp:image {"width":"48px","height":"48px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"border":{"radius":"50%"}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border"><img src="https://randomuser.me/api/portraits/women/63.jpg" alt="Sarah Mitchell" style="border-radius:50%;width:48px;height:48px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontSize":"16px","fontStyle":"normal","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffff"}}} -->
<p class="has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0;font-size:16px;font-style:normal;font-weight:600">Sarah Mitchell</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#dbdbdb"}}} -->
<p class="has-text-color" style="color:#dbdbdb;margin-top:0;margin-bottom:0;font-size:14px">CMO, Elevate Commerce</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"},"blockGap":"var:preset|spacing|30"},"elements":{"link":{"color":{"text":"#ffffffa1"}}},"color":{"text":"#ffffffa1"}}} -->
<p class="has-text-color has-link-color" style="color:#ffffffa1;margin-top:var(--wp--preset--spacing--20);margin-bottom:0">"They didn\'t just build us a website — they built us a growth engine. Traffic tripled in six months and conversions have never been higher."</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"border":{"radius":"8px","color":"#ffffff52","width":"1px"},"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_6","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-border-color has-global-color-6-background-color has-background" style="border-color:#ffffff52;border-width:1px;border-radius:8px;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:group {"style":{"typography":{"fontSize":"18px","fontStyle":"italic"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#dbdbdb"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group has-text-color" style="color:#dbdbdb;margin-top:0;margin-bottom:0;font-size:18px;font-style:italic"><!-- wp:image {"width":"48px","height":"48px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"border":{"radius":"50%"}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border"><img src="https://randomuser.me/api/portraits/men/45.jpg" alt="James Thornton" style="border-radius:50%;width:48px;height:48px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontSize":"16px","fontStyle":"normal","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffff"}}} -->
<p class="has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0;font-size:16px;font-style:normal;font-weight:600">James Thornton</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#dbdbdb"}}} -->
<p class="has-text-color" style="color:#dbdbdb;margin-top:0;margin-bottom:0;font-size:14px">Founder, Thornton Labs</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"},"blockGap":"var:preset|spacing|30"},"elements":{"link":{"color":{"text":"#ffffffa1"}}},"color":{"text":"#ffffffa1"}}} -->
<p class="has-text-color has-link-color" style="color:#ffffffa1;margin-top:var(--wp--preset--spacing--20);margin-bottom:0">"From concept to launch, the process was seamless. They understood our vision instantly and delivered a product that exceeded every expectation."</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"border":{"radius":"8px","color":"#ffffff52","width":"1px"},"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_6","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-border-color has-global-color-6-background-color has-background" style="border-color:#ffffff52;border-width:1px;border-radius:8px;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:group {"style":{"typography":{"fontSize":"18px","fontStyle":"italic"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#dbdbdb"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group has-text-color" style="color:#dbdbdb;margin-top:0;margin-bottom:0;font-size:18px;font-style:italic"><!-- wp:image {"width":"48px","height":"48px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"border":{"radius":"50%"}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border"><img src="https://randomuser.me/api/portraits/women/28.jpg" alt="Elena Vasquez" style="border-radius:50%;width:48px;height:48px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontSize":"16px","fontStyle":"normal","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffff"}}} -->
<p class="has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0;font-size:16px;font-style:normal;font-weight:600">Elena Vasquez</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#dbdbdb"}}} -->
<p class="has-text-color" style="color:#dbdbdb;margin-top:0;margin-bottom:0;font-size:14px">CEO, Bright Pixel</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"},"blockGap":"var:preset|spacing|30"},"elements":{"link":{"color":{"text":"#ffffffa1"}}},"color":{"text":"#ffffffa1"}}} -->
<p class="has-text-color has-link-color" style="color:#ffffffa1;margin-top:var(--wp--preset--spacing--20);margin-bottom:0">"Their strategic approach to our rebrand was game-changing. We saw a 40% increase in qualified leads within the first quarter of launch."</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/testimonials-9',
	array(
		'title'      => __( 'Testimonials 9', 'sydney' ),
		'categories' => array( 'sydney-testimonials' ),
		'keywords'   => array( 'testimonials', 'agency', 'digital', 'border', 'stacked' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60","left":"var:preset|spacing|60"},"margin":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-columns alignwide" style="margin-top:0;margin-bottom:0"><!-- wp:column {"width":"33.33%"} -->
<div class="wp-block-column" style="flex-basis:33.33%"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}},"color":{"text":"var:preset|color|global_color_1"}},"textColor":"global_color_1"} -->
<p class="has-global-color-1-color has-text-color" style="color:var(--wp--preset--color--global-color-1);margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:700;letter-spacing:0.1em;text-transform:uppercase">Client Testimonials</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<h2 class="wp-block-heading" style="margin-top:0;margin-bottom:0">What our clients say about us.</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"0"}}}} -->
<p style="margin-top:var(--wp--preset--spacing--40);margin-bottom:0;font-size:18px">We let our results — and our clients — do the talking.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"66.66%"} -->
<div class="wp-block-column" style="flex-basis:66.66%"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|50","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:group {"style":{"border":{"left":{"color":"var:preset|color|global_color_8","width":"4px"}},"spacing":{"padding":{"left":"var:preset|spacing|40","top":"var:preset|spacing|40"},"margin":{"top":"0","bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="border-left-color:var(--wp--preset--color--global-color-8);border-left-width:4px;margin-top:0;margin-bottom:var(--wp--preset--spacing--50);padding-top:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:paragraph {"style":{"typography":{"fontSize":"18px","fontStyle":"italic"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0;font-size:18px;font-style:italic">"They didn\'t just build us a website — they built us a growth engine. Traffic tripled in six months and conversions have never been higher."</p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"},"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0"><!-- wp:image {"width":"48px","height":"48px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"border":{"radius":"50%"}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border"><img src="https://randomuser.me/api/portraits/women/63.jpg" alt="Sarah Mitchell" style="border-radius:50%;width:48px;height:48px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontSize":"16px","fontStyle":"normal","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0;font-size:16px;font-style:normal;font-weight:600">Sarah Mitchell</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#6d7685"}}} -->
<p class="has-text-color" style="color:#6d7685;margin-top:0;margin-bottom:0;font-size:14px">CMO, Elevate Commerce</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"border":{"left":{"color":"var:preset|color|global_color_8","width":"4px"}},"spacing":{"padding":{"left":"var:preset|spacing|40","top":"var:preset|spacing|40"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="border-left-color:var(--wp--preset--color--global-color-8);border-left-width:4px;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:paragraph {"style":{"typography":{"fontSize":"18px","fontStyle":"italic"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0;font-size:18px;font-style:italic">"From concept to launch, the process was seamless. They understood our vision instantly and delivered a product that exceeded every expectation."</p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"},"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0"><!-- wp:image {"width":"48px","height":"48px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"border":{"radius":"50%"}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border"><img src="https://randomuser.me/api/portraits/men/45.jpg" alt="James Thornton" style="border-radius:50%;width:48px;height:48px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontSize":"16px","fontStyle":"normal","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0;font-size:16px;font-style:normal;font-weight:600">James Thornton</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#6d7685"}}} -->
<p class="has-text-color" style="color:#6d7685;margin-top:0;margin-bottom:0;font-size:14px">Founder, Thornton Labs</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->',
	)
);


register_block_pattern(
	'sydney/testimonials-10',
	array(
		'title'      => __( 'Testimonials 10', 'sydney' ),
		'categories' => array( 'sydney-testimonials' ),
		'keywords'   => array( 'testimonials', 'professional-corporate' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_7","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-7-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained","contentSize":"768px"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--50)"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}},"color":{"text":"var:preset|color|global_color_1"}},"textColor":"global_color_1"} -->
<p class="has-text-align-center has-global-color-1-color has-text-color" style="color:var(--wp--preset--color--global-color-1);margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:700;letter-spacing:0.1em;text-transform:uppercase">Testimonials</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<h2 class="wp-block-heading has-text-align-center" style="margin-top:0;margin-bottom:0">What Our Clients Say</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|50","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"grid","columnCount":3}} -->
<div class="wp-block-group alignwide" style="margin-top:0;margin-bottom:0"><!-- wp:group {"style":{"color":{"background":"#ffffff"},"border":{"radius":"8px","color":"#dbdbdb","width":"1px"},"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-border-color has-background" style="border-color:#dbdbdb;border-width:1px;border-radius:8px;background-color:#ffffff;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|40"}}}} -->
<p style="margin-top:0;margin-bottom:var(--wp--preset--spacing--40)">"Their strategic guidance helped us navigate a complex market expansion. Revenue grew 40% in the first year of implementation. An exceptional partner for any growth-stage company."</p>
<!-- /wp:paragraph -->

<!-- wp:separator {"style":{"color":{"background":"#dbdbdb"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|40"}}}} -->
<hr class="wp-block-separator has-text-color has-alpha-channel-opacity has-background" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--40);background-color:#dbdbdb;color:#dbdbdb"/>
<!-- /wp:separator -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:image {"width":"48px","height":"48px","sizeSlug":"full","linkDestination":"none","className":"is-style-rounded is-resized","style":{"border":{"radius":"50%"}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border is-style-rounded"><img src="https://randomuser.me/api/portraits/men/32.jpg" alt="James Whitfield" style="border-radius:50%;width:48px;height:48px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0;font-style:normal;font-weight:600">James Whitfield</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#6d7685"}}} -->
<p class="has-text-color" style="color:#6d7685;margin-top:0;margin-bottom:0;font-size:14px">CEO, Meridian Corp</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"color":{"background":"#ffffff"},"border":{"radius":"8px","color":"#dbdbdb","width":"1px"},"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-border-color has-background" style="border-color:#dbdbdb;border-width:1px;border-radius:8px;background-color:#ffffff;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|40"}}}} -->
<p style="margin-top:0;margin-bottom:var(--wp--preset--spacing--40)">"The team delivered a comprehensive cost optimization strategy that reduced our operational overhead by 25%. Their analytical rigor and pragmatic approach set them apart."</p>
<!-- /wp:paragraph -->

<!-- wp:separator {"style":{"color":{"background":"#dbdbdb"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|40"}}}} -->
<hr class="wp-block-separator has-text-color has-alpha-channel-opacity has-background" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--40);background-color:#dbdbdb;color:#dbdbdb"/>
<!-- /wp:separator -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:image {"width":"48px","height":"48px","sizeSlug":"full","linkDestination":"none","className":"is-style-rounded is-resized","style":{"border":{"radius":"50%"}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border is-style-rounded"><img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Sarah Chen" style="border-radius:50%;width:48px;height:48px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0;font-style:normal;font-weight:600">Sarah Chen</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#6d7685"}}} -->
<p class="has-text-color" style="color:#6d7685;margin-top:0;margin-bottom:0;font-size:14px">CFO, Atlas Industries</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"color":{"background":"#ffffff"},"border":{"radius":"8px","color":"#dbdbdb","width":"1px"},"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-border-color has-background" style="border-color:#dbdbdb;border-width:1px;border-radius:8px;background-color:#ffffff;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|40"}}}} -->
<p style="margin-top:0;margin-bottom:var(--wp--preset--spacing--40)">"From day one, they understood our business challenges. Their digital transformation roadmap was clear, actionable, and delivered measurable results within six months."</p>
<!-- /wp:paragraph -->

<!-- wp:separator {"style":{"color":{"background":"#dbdbdb"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|40"}}}} -->
<hr class="wp-block-separator has-text-color has-alpha-channel-opacity has-background" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--40);background-color:#dbdbdb;color:#dbdbdb"/>
<!-- /wp:separator -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:image {"width":"48px","height":"48px","sizeSlug":"full","linkDestination":"none","className":"is-style-rounded is-resized","style":{"border":{"radius":"50%"}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border is-style-rounded"><img src="https://randomuser.me/api/portraits/men/55.jpg" alt="Robert Nakamura" style="border-radius:50%;width:48px;height:48px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0;font-style:normal;font-weight:600">Robert Nakamura</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#6d7685"}}} -->
<p class="has-text-color" style="color:#6d7685;margin-top:0;margin-bottom:0;font-size:14px">COO, Vertex Partners</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/testimonials-11',
	array(
		'title'      => __( 'Testimonials 11', 'sydney' ),
		'categories' => array( 'sydney-testimonials' ),
		'keywords'   => array( 'testimonials', 'professional-corporate' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_9","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-9-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"768px"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:image {"width":"56px","height":"56px","sizeSlug":"full","linkDestination":"none","align":"center","className":"is-resized","style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|50"}}}} -->
<figure class="wp-block-image aligncenter size-full is-resized" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--50)"><img src="data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 24 24\' fill=\'%23d65050\'%3E%3Cpath d=\'M4.583 17.321C3.553 16.227 3 15 3 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621.537-.278 1.24-.375 1.929-.311 1.804.167 3.226 1.648 3.226 3.489a3.5 3.5 0 01-3.5 3.5c-1.073 0-2.099-.49-2.748-1.179zm10 0C13.553 16.227 13 15 13 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621.537-.278 1.24-.375 1.929-.311 1.804.167 3.226 1.648 3.226 3.489a3.5 3.5 0 01-3.5 3.5c-1.073 0-2.099-.49-2.748-1.179z\'/%3E%3C/svg%3E" alt="Quote icon" style="width:56px;height:56px"/></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"22px","fontStyle":"italic"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|60"}}}} -->
<p class="has-text-align-center" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--60);font-size:22px;font-style:italic">"Partnering with this team was a pivotal decision for our organization. They brought clarity to our five-year strategy, streamlined our operations, and positioned us for sustainable growth. The results speak for themselves — 60% increase in operational efficiency and a culture shift that energized every department."</p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|40","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:image {"width":"56px","height":"56px","sizeSlug":"full","linkDestination":"none","className":"is-style-rounded is-resized","style":{"border":{"radius":"50%"}}} -->
<figure class="wp-block-image size-full is-style-rounded is-resized has-custom-border"><img src="https://randomuser.me/api/portraits/women/28.jpg" alt="Victoria Langford" style="border-radius:50%;width:56px;height:56px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0;font-style:normal;font-weight:600">Victoria Langford</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#6d7685"}}} -->
<p class="has-text-color" style="color:#6d7685;margin-top:0;margin-bottom:0;font-size:14px">VP of Operations, Pinnacle Group</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/testimonials-12',
	array(
		'title'      => __( 'Testimonials 12', 'sydney' ),
		'categories' => array( 'sydney-testimonials' ),
		'keywords'   => array( 'testimonials', 'professional-corporate' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_6","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-6-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained","contentSize":"768px"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--50)"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}}},"textColor":"white"} -->
<p class="has-text-align-center has-white-color has-text-color" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:700;letter-spacing:0.1em;text-transform:uppercase">Testimonials</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffff"}}} -->
<h2 class="wp-block-heading has-text-align-center has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0">Results That Speak Volumes</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|50","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"grid","columnCount":3}} -->
<div class="wp-block-group alignwide" style="margin-top:0;margin-bottom:0"><!-- wp:group {"style":{"border":{"radius":"8px","color":"rgba(255,255,255,0.15)","width":"1px"},"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-border-color" style="border-color:rgba(255,255,255,0.15);border-width:1px;border-radius:8px;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:group {"style":{"spacing":{"blockGap":"4px","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:image {"width":"20px","height":"20px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"color":{"duotone":["#d65050","#d65050"]}}} -->
<figure class="wp-block-image size-full is-resized"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 20 20%22 fill=%22%23d65050%22%3E%3Cpath d=%22M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z%22/%3E%3C/svg%3E" alt="Star" style="width:20px;height:20px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"width":"20px","height":"20px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"color":{"duotone":["#d65050","#d65050"]}}} -->
<figure class="wp-block-image size-full is-resized"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 20 20%22 fill=%22%23d65050%22%3E%3Cpath d=%22M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z%22/%3E%3C/svg%3E" alt="Star" style="width:20px;height:20px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"width":"20px","height":"20px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"color":{"duotone":["#d65050","#d65050"]}}} -->
<figure class="wp-block-image size-full is-resized"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 20 20%22 fill=%22%23d65050%22%3E%3Cpath d=%22M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z%22/%3E%3C/svg%3E" alt="Star" style="width:20px;height:20px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"width":"20px","height":"20px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"color":{"duotone":["#d65050","#d65050"]}}} -->
<figure class="wp-block-image size-full is-resized"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 20 20%22 fill=%22%23d65050%22%3E%3Cpath d=%22M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z%22/%3E%3C/svg%3E" alt="Star" style="width:20px;height:20px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"width":"20px","height":"20px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"color":{"duotone":["#d65050","#d65050"]}}} -->
<figure class="wp-block-image size-full is-resized"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 20 20%22 fill=%22%23d65050%22%3E%3Cpath d=%22M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z%22/%3E%3C/svg%3E" alt="Star" style="width:20px;height:20px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|40"}},"color":{"text":"#ffffff"}}} -->
<p class="has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:var(--wp--preset--spacing--40)">"A world-class consulting experience. They identified inefficiencies we had overlooked for years and delivered a turnaround plan that exceeded every benchmark."</p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:image {"width":"44px","height":"44px","sizeSlug":"full","linkDestination":"none","className":"is-style-rounded is-resized","style":{"border":{"radius":"50%"}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border is-style-rounded"><img src="https://randomuser.me/api/portraits/men/41.jpg" alt="Thomas Brennan" style="border-radius:50%;width:44px;height:44px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffff"}}} -->
<p class="has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0;font-style:normal;font-weight:600">Thomas Brennan</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#6d7685"}}} -->
<p class="has-text-color" style="color:#6d7685;margin-top:0;margin-bottom:0;font-size:14px">CEO, Pinnacle Group</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"border":{"radius":"8px","color":"rgba(255,255,255,0.15)","width":"1px"},"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-border-color" style="border-color:rgba(255,255,255,0.15);border-width:1px;border-radius:8px;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:group {"style":{"spacing":{"blockGap":"4px","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:image {"width":"20px","height":"20px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"color":{"duotone":["#d65050","#d65050"]}}} -->
<figure class="wp-block-image size-full is-resized"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 20 20%22 fill=%22%23d65050%22%3E%3Cpath d=%22M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z%22/%3E%3C/svg%3E" alt="Star" style="width:20px;height:20px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"width":"20px","height":"20px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"color":{"duotone":["#d65050","#d65050"]}}} -->
<figure class="wp-block-image size-full is-resized"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 20 20%22 fill=%22%23d65050%22%3E%3Cpath d=%22M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z%22/%3E%3C/svg%3E" alt="Star" style="width:20px;height:20px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"width":"20px","height":"20px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"color":{"duotone":["#d65050","#d65050"]}}} -->
<figure class="wp-block-image size-full is-resized"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 20 20%22 fill=%22%23d65050%22%3E%3Cpath d=%22M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z%22/%3E%3C/svg%3E" alt="Star" style="width:20px;height:20px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"width":"20px","height":"20px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"color":{"duotone":["#d65050","#d65050"]}}} -->
<figure class="wp-block-image size-full is-resized"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 20 20%22 fill=%22%23d65050%22%3E%3Cpath d=%22M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z%22/%3E%3C/svg%3E" alt="Star" style="width:20px;height:20px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"width":"20px","height":"20px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"color":{"duotone":["#d65050","#d65050"]}}} -->
<figure class="wp-block-image size-full is-resized"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 20 20%22 fill=%22%23d65050%22%3E%3Cpath d=%22M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z%22/%3E%3C/svg%3E" alt="Star" style="width:20px;height:20px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|40"}},"color":{"text":"#ffffff"}}} -->
<p class="has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:var(--wp--preset--spacing--40)">"Their supply chain optimization project delivered ROI within the first quarter. The teams deep industry knowledge and hands-on approach made all the difference."</p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:image {"width":"44px","height":"44px","sizeSlug":"full","linkDestination":"none","className":"is-style-rounded is-resized","style":{"border":{"radius":"50%"}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border is-style-rounded"><img src="https://randomuser.me/api/portraits/women/36.jpg" alt="Elena Voss" style="border-radius:50%;width:44px;height:44px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffff"}}} -->
<p class="has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0;font-style:normal;font-weight:600">Elena Voss</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#6d7685"}}} -->
<p class="has-text-color" style="color:#6d7685;margin-top:0;margin-bottom:0;font-size:14px">Director of Marketing, Meridian Corp</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"border":{"radius":"8px","color":"rgba(255,255,255,0.15)","width":"1px"},"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-border-color" style="border-color:rgba(255,255,255,0.15);border-width:1px;border-radius:8px;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:group {"style":{"spacing":{"blockGap":"4px","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:image {"width":"20px","height":"20px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"color":{"duotone":["#d65050","#d65050"]}}} -->
<figure class="wp-block-image size-full is-resized"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 20 20%22 fill=%22%23d65050%22%3E%3Cpath d=%22M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z%22/%3E%3C/svg%3E" alt="Star" style="width:20px;height:20px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"width":"20px","height":"20px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"color":{"duotone":["#d65050","#d65050"]}}} -->
<figure class="wp-block-image size-full is-resized"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 20 20%22 fill=%22%23d65050%22%3E%3Cpath d=%22M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z%22/%3E%3C/svg%3E" alt="Star" style="width:20px;height:20px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"width":"20px","height":"20px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"color":{"duotone":["#d65050","#d65050"]}}} -->
<figure class="wp-block-image size-full is-resized"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 20 20%22 fill=%22%23d65050%22%3E%3Cpath d=%22M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z%22/%3E%3C/svg%3E" alt="Star" style="width:20px;height:20px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"width":"20px","height":"20px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"color":{"duotone":["#d65050","#d65050"]}}} -->
<figure class="wp-block-image size-full is-resized"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 20 20%22 fill=%22%23d65050%22%3E%3Cpath d=%22M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z%22/%3E%3C/svg%3E" alt="Star" style="width:20px;height:20px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"width":"20px","height":"20px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"color":{"duotone":["#d65050","#d65050"]}}} -->
<figure class="wp-block-image size-full is-resized"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 20 20%22 fill=%22%23d65050%22%3E%3Cpath d=%22M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z%22/%3E%3C/svg%3E" alt="Star" style="width:20px;height:20px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|40"}},"color":{"text":"#ffffff"}}} -->
<p class="has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:var(--wp--preset--spacing--40)">"We engaged them for a post-merger integration and they exceeded expectations at every milestone. Their structured methodology kept all stakeholders aligned throughout."</p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:image {"width":"44px","height":"44px","sizeSlug":"full","linkDestination":"none","className":"is-style-rounded is-resized","style":{"border":{"radius":"50%"}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border is-style-rounded"><img src="https://randomuser.me/api/portraits/men/22.jpg" alt="Marcus Webb" style="border-radius:50%;width:44px;height:44px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffff"}}} -->
<p class="has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0;font-style:normal;font-weight:600">Marcus Webb</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#6d7685"}}} -->
<p class="has-text-color" style="color:#6d7685;margin-top:0;margin-bottom:0;font-size:14px">COO, Atlas Industries</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/testimonials-13',
	array(
		'title'      => __( 'Testimonials 13', 'sydney' ),
		'categories' => array( 'sydney-testimonials' ),
		'keywords'   => array( 'testimonials', 'professional-corporate' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_9","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-9-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained","contentSize":"768px"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--50)"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}},"color":{"text":"var:preset|color|global_color_1"}},"textColor":"global_color_1"} -->
<p class="has-text-align-center has-global-color-1-color has-text-color" style="color:var(--wp--preset--color--global-color-1);margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:700;letter-spacing:0.1em;text-transform:uppercase">Client Stories</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<h2 class="wp-block-heading has-text-align-center" style="margin-top:0;margin-bottom:0">Words From Our Partners</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|50","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"grid","columnCount":3}} -->
<div class="wp-block-group alignwide" style="margin-top:0;margin-bottom:0"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|40"}}}} -->
<p class="has-text-align-center" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--40)">"Their strategic clarity and execution discipline transformed our approach to scaling. We now operate with a level of precision we never thought possible."</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontStyle":"normal","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-align-center" style="margin-top:0;margin-bottom:0;font-style:normal;font-weight:600">Richard Gaines</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#6d7685"}}} -->
<p class="has-text-align-center has-text-color" style="color:#6d7685;margin-top:0;margin-bottom:0;font-size:14px">CEO, Pinnacle Group</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|40"}}}} -->
<p class="has-text-align-center" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--40)">"An outstanding partnership from start to finish. They brought deep expertise, transparent communication, and delivered measurable impact across every workstream."</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontStyle":"normal","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-align-center" style="margin-top:0;margin-bottom:0;font-style:normal;font-weight:600">Naomi Ashworth</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#6d7685"}}} -->
<p class="has-text-align-center has-text-color" style="color:#6d7685;margin-top:0;margin-bottom:0;font-size:14px">Director of Marketing, Atlas Industries</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|40"}}}} -->
<p class="has-text-align-center" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--40)">"They helped us rethink our entire value chain. The result was a leaner, faster organization that\'s now positioned as the market leader in our sector."</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontStyle":"normal","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-align-center" style="margin-top:0;margin-bottom:0;font-style:normal;font-weight:600">Philip Engstrom</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#6d7685"}}} -->
<p class="has-text-align-center has-text-color" style="color:#6d7685;margin-top:0;margin-bottom:0;font-size:14px">CFO, Meridian Corp</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->',
	)
);


// Testimonials 1 — Stacked review cards with red left border on white background.
register_block_pattern(
	'sydney/testimonials-14',
	array(
		'title'      => __( 'Testimonials 14', 'sydney' ),
		'categories' => array( 'sydney-testimonials' ),
		'keywords'   => array( 'testimonials', 'agency', 'digital', 'reviews', 'stacked' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"margin":{"top":"0","bottom":"0"}},"color":{"background":"#1c1c1c"}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-background" style="background-color:#1c1c1c;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|20","margin":{"bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide" style="margin-bottom:var(--wp--preset--spacing--50)"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"600","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}}},"textColor":"white"} -->
<p class="has-text-align-center has-white-color has-text-color" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:600;letter-spacing:0.1em;text-transform:uppercase">Client Reviews</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffff"}}} -->
<h2 class="wp-block-heading has-text-align-center has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0">What Our Clients Say</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|40"}}}} -->
<div class="wp-block-columns alignwide"><!-- wp:column {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}}} -->
<div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}},"color":{"background":"rgba(255,255,255,0.08)"},"border":{"radius":"8px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background" style="border-radius:8px;background-color:rgba(255,255,255,0.08);padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|20"}},"color":{"text":"#e3b248"}}} -->
<p class="has-text-color" style="color:#e3b248;margin-top:0;margin-bottom:var(--wp--preset--spacing--20);font-size:14px">★★★★★</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontStyle":"italic","fontWeight":"400","fontSize":"16px"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}},"color":{"text":"#ffffff"}}} -->
<p class="has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:16px;font-style:italic;font-weight:400">"Every deliverable was a masterpiece. The brand strategy took us on a clear journey — from positioning to execution. Truly world-class work."</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffff"}}} -->
<p class="has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0;font-style:normal;font-weight:600">James Whitfield</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"13px"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffffa8"}}} -->
<p class="has-text-color" style="color:#ffffffa8;margin-top:0;margin-bottom:0;font-size:13px">March 2025</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}},"color":{"background":"rgba(255,255,255,0.08)"},"border":{"radius":"8px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background" style="border-radius:8px;background-color:rgba(255,255,255,0.08);padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|20"}},"color":{"text":"#e3b248"}}} -->
<p class="has-text-color" style="color:#e3b248;margin-top:0;margin-bottom:var(--wp--preset--spacing--20);font-size:14px">★★★★★</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontStyle":"italic","fontWeight":"400","fontSize":"16px"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}},"color":{"text":"#ffffff"}}} -->
<p class="has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:16px;font-style:italic;font-weight:400">"Perfect for a growing brand. Strategic thinking and flawless execution."</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffff"}}} -->
<p class="has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0;font-style:normal;font-weight:600">Mia Torres</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"13px"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffffa8"}}} -->
<p class="has-text-color" style="color:#ffffffa8;margin-top:0;margin-bottom:0;font-size:13px">February 2025</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}}} -->
<div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}},"color":{"background":"rgba(255,255,255,0.08)"},"border":{"radius":"8px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background" style="border-radius:8px;background-color:rgba(255,255,255,0.08);padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|20"}},"color":{"text":"#e3b248"}}} -->
<p class="has-text-color" style="color:#e3b248;margin-top:0;margin-bottom:var(--wp--preset--spacing--20);font-size:14px">★★★★★</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontStyle":"italic","fontWeight":"400","fontSize":"16px"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}},"color":{"text":"#ffffff"}}} -->
<p class="has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:16px;font-style:italic;font-weight:400">"We launched our rebrand with their team and it was nothing short of transformative. They went above and beyond to make every milestone exceptional."</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffff"}}} -->
<p class="has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0;font-style:normal;font-weight:600">Robert &amp; Anna Kim</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"13px"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffffa8"}}} -->
<p class="has-text-color" style="color:#ffffffa8;margin-top:0;margin-bottom:0;font-size:13px">January 2025</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}},"color":{"background":"rgba(255,255,255,0.08)"},"border":{"radius":"8px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background" style="border-radius:8px;background-color:rgba(255,255,255,0.08);padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|20"}},"color":{"text":"#e3b248"}}} -->
<p class="has-text-color" style="color:#e3b248;margin-top:0;margin-bottom:var(--wp--preset--spacing--20);font-size:14px">★★★★★</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontStyle":"italic","fontWeight":"400","fontSize":"16px"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}},"color":{"text":"#ffffff"}}} -->
<p class="has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:16px;font-style:italic;font-weight:400">"The brand identity is hands down the best work we have ever seen. Sharp strategy, bold creative, and executed to absolute perfection. We have referred three clients this month already and we are not stopping."</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffff"}}} -->
<p class="has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0;font-style:normal;font-weight:600">Daniel Okafor</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"13px"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffffa8"}}} -->
<p class="has-text-color" style="color:#ffffffa8;margin-top:0;margin-bottom:0;font-size:13px">December 2024</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}}} -->
<div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}},"color":{"background":"rgba(255,255,255,0.08)"},"border":{"radius":"8px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background" style="border-radius:8px;background-color:rgba(255,255,255,0.08);padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|20"}},"color":{"text":"#e3b248"}}} -->
<p class="has-text-color" style="color:#e3b248;margin-top:0;margin-bottom:var(--wp--preset--spacing--20);font-size:14px">★★★★★</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontStyle":"italic","fontWeight":"400","fontSize":"16px"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}},"color":{"text":"#ffffff"}}} -->
<p class="has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:16px;font-style:italic;font-weight:400">"Brought our leadership team for a strategy offsite. The session was expertly facilitated, the strategic framework was extraordinary, and the team\'s recommendations were impeccable. Outcomes we will build on for years."</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffff"}}} -->
<p class="has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0;font-style:normal;font-weight:600">Claire Dubois</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"13px"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffffa8"}}} -->
<p class="has-text-color" style="color:#ffffffa8;margin-top:0;margin-bottom:0;font-size:13px">November 2024</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}},"color":{"background":"rgba(255,255,255,0.08)"},"border":{"radius":"8px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background" style="border-radius:8px;background-color:rgba(255,255,255,0.08);padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|20"}},"color":{"text":"#e3b248"}}} -->
<p class="has-text-color" style="color:#e3b248;margin-top:0;margin-bottom:var(--wp--preset--spacing--20);font-size:14px">★★★★★</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontStyle":"italic","fontWeight":"400","fontSize":"16px"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}},"color":{"text":"#ffffff"}}} -->
<p class="has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:16px;font-style:italic;font-weight:400">"Quick discovery call turned into a two-year partnership. No regrets."</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffff"}}} -->
<p class="has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0;font-style:normal;font-weight:600">Aisha Patel</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"13px"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffffa8"}}} -->
<p class="has-text-color" style="color:#ffffffa8;margin-top:0;margin-bottom:0;font-size:13px">October 2024</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->',
	)
);