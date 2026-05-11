<?php
/**
 * Services patterns
 *
 * @package Sydney
 */


// Services 1 — 3-column card grid on dark bg with stacked icons.
register_block_pattern(
	'sydney/services-1',
	array(
		'title'      => __( 'Services 1', 'sydney' ),
		'categories' => array( 'sydney-services' ),
		'keywords'   => array( 'services', 'agency', 'digital' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"margin":{"top":"0","bottom":"0"},"blockGap":"0"}},"backgroundColor":"global_color_6","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-6-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:group {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained","contentSize":"768px"}} -->
<div class="wp-block-group" style="margin-bottom:var(--wp--preset--spacing--50)"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}}},"textColor":"white"} -->
<p class="has-text-align-center has-white-color has-text-color" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:700;letter-spacing:0.1em;text-transform:uppercase">What We Offer</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"color":{"text":"#ffffff"}}} -->
<h2 class="wp-block-heading has-text-align-center has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0">Our Services</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"grid","columnCount":3,"minimumColumnWidth":null}} -->
<div class="wp-block-group alignwide"><!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"margin":{"top":"0","bottom":"0"}},"border":{"radius":"8px"}},"backgroundColor":"global_color_9","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-global-color-9-background-color has-background" style="border-radius:8px;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:group {"metadata":{"name":"Icon"},"layout":{"type":"constrained","contentSize":"60px","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"60px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:60px"><!-- wp:image {"width":"35px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"color":{"duotone":["#ffffff","#ffffff"]}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25%22 /%3E%3C/svg%3E" alt="Interior icon" style="width:35px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"bottom":"0","top":"0"}}}} -->
<h4 class="wp-block-heading" style="margin-top:0;margin-bottom:0">Creative Direction</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<p style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">We guide visual and strategic creative work that shapes how your audience experiences your brand.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"margin":{"top":"0","bottom":"0"}},"border":{"radius":"8px"}},"backgroundColor":"global_color_9","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-global-color-9-background-color has-background" style="border-radius:8px;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:group {"metadata":{"name":"Icon"},"layout":{"type":"constrained","contentSize":"60px","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"60px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:60px"><!-- wp:image {"width":"35px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"color":{"duotone":["#ffffff","#ffffff"]}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.455 2.456L21.75 6l-1.036.259a3.375 3.375 0 0 0-2.455 2.456ZM16.894 20.567L16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z%22 /%3E%3C/svg%3E" alt="Exterior icon" style="width:35px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"bottom":"0","top":"0"}}}} -->
<h4 class="wp-block-heading" style="margin-top:0;margin-bottom:0">Brand Strategy</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<p style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">We develop positioning, messaging, and identity frameworks that make ambitious brands impossible to ignore.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"margin":{"top":"0","bottom":"0"}},"border":{"radius":"8px"}},"backgroundColor":"global_color_9","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-global-color-9-background-color has-background" style="border-radius:8px;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:group {"metadata":{"name":"Icon"},"layout":{"type":"constrained","contentSize":"60px","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"60px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:60px"><!-- wp:image {"width":"35px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"color":{"duotone":["#ffffff","#ffffff"]}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z%22 /%3E%3C/svg%3E" alt="Web Design icon" style="width:35px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"bottom":"0","top":"0"}}}} -->
<h4 class="wp-block-heading" style="margin-top:0;margin-bottom:0">Web Design</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<p style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">Conversion-focused websites that reflect your brand and engage visitors from the first scroll.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"margin":{"top":"0","bottom":"0"}},"border":{"radius":"8px"}},"backgroundColor":"global_color_9","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-global-color-9-background-color has-background" style="border-radius:8px;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:group {"metadata":{"name":"Icon"},"layout":{"type":"constrained","contentSize":"60px","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"60px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:60px"><!-- wp:image {"width":"35px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"color":{"duotone":["#ffffff","#ffffff"]}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M9.53 16.122a3 3 0 0 0-5.78 1.128 2.25 2.25 0 0 1-2.4 2.245 4.5 4.5 0 0 0 8.4-2.245c0-.399-.078-.78-.22-1.128Zm0 0a15.998 15.998 0 0 0 3.388-1.62m-5.043-.025a15.994 15.994 0 0 1 1.622-3.395m3.42 3.42a15.995 15.995 0 0 0 4.764-4.648l3.876-5.814a1.151 1.151 0 0 0-1.597-1.597L14.146 6.32a15.996 15.996 0 0 0-4.649 4.763m3.42 3.42a6.776 6.776 0 0 0-3.42-3.42%22 /%3E%3C/svg%3E" alt="Paint icon" style="width:35px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"bottom":"0","top":"0"}}}} -->
<h4 class="wp-block-heading" style="margin-top:0;margin-bottom:0">Digital Marketing</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<p style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">Data-driven campaigns across SEO, paid media, and social that move audiences from attention to action.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"margin":{"top":"0","bottom":"0"}},"border":{"radius":"8px"}},"backgroundColor":"global_color_9","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-global-color-9-background-color has-background" style="border-radius:8px;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:group {"metadata":{"name":"Icon"},"layout":{"type":"constrained","contentSize":"60px","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"60px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:60px"><!-- wp:image {"width":"35px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"color":{"duotone":["#ffffff","#ffffff"]}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z%22 /%3E%3C/svg%3E" alt="Window icon" style="width:35px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"bottom":"0","top":"0"}}}} -->
<h4 class="wp-block-heading" style="margin-top:0;margin-bottom:0">Content Creation</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<p style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">Compelling copy, visuals, and video that build authority and drive engagement at every stage.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"margin":{"top":"0","bottom":"0"}},"border":{"radius":"8px"}},"backgroundColor":"global_color_9","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-global-color-9-background-color has-background" style="border-radius:8px;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:group {"metadata":{"name":"Icon"},"layout":{"type":"constrained","contentSize":"60px","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"60px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:60px"><!-- wp:image {"width":"35px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"color":{"duotone":["#ffffff","#ffffff"]}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M21.75 6.75a4.5 4.5 0 0 1-4.884 4.484c-1.076-.091-2.264.071-2.95.904l-7.152 8.684a2.548 2.548 0 1 1-3.586-3.586l8.684-7.152c.833-.686.995-1.874.904-2.95a4.5 4.5 0 0 1 6.336-4.486l-3.276 3.276a3.004 3.004 0 0 0 2.25 2.25l3.276-3.276c.256.565.398 1.192.398 1.852Z%22 /%3E%3C/svg%3E" alt="Engine icon" style="width:35px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"bottom":"0","top":"0"}}}} -->
<h4 class="wp-block-heading" style="margin-top:0;margin-bottom:0">Growth Analytics</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<p style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">Clear dashboards and actionable reporting so you always know what\'s working and what to optimize next.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->',
	)
);

// Services 2 — Icon grid on dark bg, no cards, centered stacked icons.
register_block_pattern(
	'sydney/services-2',
	array(
		'title'      => __( 'Services 2', 'sydney' ),
		'categories' => array( 'sydney-services' ),
		'keywords'   => array( 'services', 'agency', 'digital' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"margin":{"top":"0","bottom":"0"},"blockGap":"0"}},"backgroundColor":"global_color_6","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-6-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:group {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained","contentSize":"768px"}} -->
<div class="wp-block-group" style="margin-bottom:var(--wp--preset--spacing--50)"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}}},"textColor":"white"} -->
<p class="has-text-align-center has-white-color has-text-color" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:700;letter-spacing:0.1em;text-transform:uppercase">What We Offer</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"color":{"text":"#ffffff"}}} -->
<h2 class="wp-block-heading has-text-align-center has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0">Our Services</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|50"}},"layout":{"type":"grid","columnCount":3,"minimumColumnWidth":null}} -->
<div class="wp-block-group alignwide"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:group {"metadata":{"name":"Icon"},"layout":{"type":"constrained","contentSize":"60px","justifyContent":"center"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"60px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:60px"><!-- wp:image {"width":"35px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"color":{"duotone":["#ffffff","#ffffff"]}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25%22 /%3E%3C/svg%3E" alt="Interior icon" style="width:35px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:heading {"textAlign":"center","level":4,"style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"color":{"text":"#ffffff"}}} -->
<h4 class="wp-block-heading has-text-align-center has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0">Creative Direction</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}},"color":{"text":"#dbdbdb"}}} -->
<p class="has-text-align-center has-text-color" style="color:#dbdbdb;margin-top:var(--wp--preset--spacing--30);margin-bottom:0">We guide visual and strategic creative work that shapes how your audience experiences your brand.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:group {"metadata":{"name":"Icon"},"layout":{"type":"constrained","contentSize":"60px","justifyContent":"center"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"60px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:60px"><!-- wp:image {"width":"35px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"color":{"duotone":["#ffffff","#ffffff"]}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.455 2.456L21.75 6l-1.036.259a3.375 3.375 0 0 0-2.455 2.456ZM16.894 20.567L16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z%22 /%3E%3C/svg%3E" alt="Exterior icon" style="width:35px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:heading {"textAlign":"center","level":4,"style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"color":{"text":"#ffffff"}}} -->
<h4 class="wp-block-heading has-text-align-center has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0">Brand Strategy</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}},"color":{"text":"#dbdbdb"}}} -->
<p class="has-text-align-center has-text-color" style="color:#dbdbdb;margin-top:var(--wp--preset--spacing--30);margin-bottom:0">We develop positioning, messaging, and identity frameworks that make ambitious brands impossible to ignore.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:group {"metadata":{"name":"Icon"},"layout":{"type":"constrained","contentSize":"60px","justifyContent":"center"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"60px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:60px"><!-- wp:image {"width":"35px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"color":{"duotone":["#ffffff","#ffffff"]}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z%22 /%3E%3C/svg%3E" alt="Web Design icon" style="width:35px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:heading {"textAlign":"center","level":4,"style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"color":{"text":"#ffffff"}}} -->
<h4 class="wp-block-heading has-text-align-center has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0">Web Design</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}},"color":{"text":"#dbdbdb"}}} -->
<p class="has-text-align-center has-text-color" style="color:#dbdbdb;margin-top:var(--wp--preset--spacing--30);margin-bottom:0">Conversion-focused websites that reflect your brand and engage visitors from the first scroll.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:group {"metadata":{"name":"Icon"},"layout":{"type":"constrained","contentSize":"60px","justifyContent":"center"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"60px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:60px"><!-- wp:image {"width":"35px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"color":{"duotone":["#ffffff","#ffffff"]}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M9.53 16.122a3 3 0 0 0-5.78 1.128 2.25 2.25 0 0 1-2.4 2.245 4.5 4.5 0 0 0 8.4-2.245c0-.399-.078-.78-.22-1.128Zm0 0a15.998 15.998 0 0 0 3.388-1.62m-5.043-.025a15.994 15.994 0 0 1 1.622-3.395m3.42 3.42a15.995 15.995 0 0 0 4.764-4.648l3.876-5.814a1.151 1.151 0 0 0-1.597-1.597L14.146 6.32a15.996 15.996 0 0 0-4.649 4.763m3.42 3.42a6.776 6.776 0 0 0-3.42-3.42%22 /%3E%3C/svg%3E" alt="Paint icon" style="width:35px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:heading {"textAlign":"center","level":4,"style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"color":{"text":"#ffffff"}}} -->
<h4 class="wp-block-heading has-text-align-center has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0">Digital Marketing</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}},"color":{"text":"#dbdbdb"}}} -->
<p class="has-text-align-center has-text-color" style="color:#dbdbdb;margin-top:var(--wp--preset--spacing--30);margin-bottom:0">Data-driven campaigns across SEO, paid media, and social that move audiences from attention to action.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:group {"metadata":{"name":"Icon"},"layout":{"type":"constrained","contentSize":"60px","justifyContent":"center"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"60px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:60px"><!-- wp:image {"width":"35px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"color":{"duotone":["#ffffff","#ffffff"]}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z%22 /%3E%3C/svg%3E" alt="Window icon" style="width:35px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:heading {"textAlign":"center","level":4,"style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"color":{"text":"#ffffff"}}} -->
<h4 class="wp-block-heading has-text-align-center has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0">Content Creation</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}},"color":{"text":"#dbdbdb"}}} -->
<p class="has-text-align-center has-text-color" style="color:#dbdbdb;margin-top:var(--wp--preset--spacing--30);margin-bottom:0">Compelling copy, visuals, and video that build authority and drive engagement at every stage.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:group {"metadata":{"name":"Icon"},"layout":{"type":"constrained","contentSize":"60px","justifyContent":"center"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"60px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:60px"><!-- wp:image {"width":"35px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"color":{"duotone":["#ffffff","#ffffff"]}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M21.75 6.75a4.5 4.5 0 0 1-4.884 4.484c-1.076-.091-2.264.071-2.95.904l-7.152 8.684a2.548 2.548 0 1 1-3.586-3.586l8.684-7.152c.833-.686.995-1.874.904-2.95a4.5 4.5 0 0 1 6.336-4.486l-3.276 3.276a3.004 3.004 0 0 0 2.25 2.25l3.276-3.276c.256.565.398 1.192.398 1.852Z%22 /%3E%3C/svg%3E" alt="Engine icon" style="width:35px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:heading {"textAlign":"center","level":4,"style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"color":{"text":"#ffffff"}}} -->
<h4 class="wp-block-heading has-text-align-center has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0">Growth Analytics</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}},"color":{"text":"#dbdbdb"}}} -->
<p class="has-text-align-center has-text-color" style="color:#dbdbdb;margin-top:var(--wp--preset--spacing--30);margin-bottom:0">Clear dashboards and actionable reporting so you always know what\'s working and what to optimize next.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->',
	)
);

// Services 3 — Alternating image-text rows on light bg with stacked icons.
register_block_pattern(
	'sydney/services-3',
	array(
		'title'      => __( 'Services 3', 'sydney' ),
		'categories' => array( 'sydney-services' ),
		'keywords'   => array( 'services', 'agency', 'digital' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"margin":{"top":"0","bottom":"0"},"blockGap":"0"},"color":{"background":"#F4F5F7"}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-background" style="background-color:#F4F5F7;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:group {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained","contentSize":"768px"}} -->
<div class="wp-block-group" style="margin-bottom:var(--wp--preset--spacing--50)"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}},"color":{"text":"var:preset|color|global_color_1"}},"textColor":"global_color_1"} -->
<p class="has-text-align-center has-global-color-1-color has-text-color" style="color:var(--wp--preset--color--global-color-1);margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:700;letter-spacing:0.1em;text-transform:uppercase">Our Services</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"0","top":"0"}}}} -->
<h2 class="wp-block-heading has-text-align-center" style="margin-top:0;margin-bottom:0">What We Offer</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|60"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide"><!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|50","left":"var:preset|spacing|50"}}}} -->
<div class="wp-block-columns alignwide"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:image {"sizeSlug":"large","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-large has-custom-border"><img src="https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&amp;fit=crop&amp;w=1600" alt="Creative Direction" style="border-radius:8px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:group {"metadata":{"name":"Icon"},"layout":{"type":"constrained","contentSize":"60px","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"60px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:60px"><!-- wp:image {"width":"35px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"color":{"duotone":["#ffffff","#ffffff"]}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25%22 /%3E%3C/svg%3E" alt="Interior icon" style="width:35px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"bottom":"0","top":"0"}}}} -->
<h3 class="wp-block-heading" style="margin-top:0;margin-bottom:0">Creative Direction</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<p style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">We craft visually compelling, conversion-focused websites that tell your brand story and turn first-time visitors into loyal customers.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|50","left":"var:preset|spacing|50"}}}} -->
<div class="wp-block-columns alignwide"><!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:group {"metadata":{"name":"Icon"},"layout":{"type":"constrained","contentSize":"60px","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"60px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:60px"><!-- wp:image {"width":"35px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"color":{"duotone":["#ffffff","#ffffff"]}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.455 2.456L21.75 6l-1.036.259a3.375 3.375 0 0 0-2.455 2.456ZM16.894 20.567L16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z%22 /%3E%3C/svg%3E" alt="Exterior icon" style="width:35px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"bottom":"0","top":"0"}}}} -->
<h3 class="wp-block-heading" style="margin-top:0;margin-bottom:0">Brand Strategy</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<p style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">From positioning and messaging to visual identity, our brand strategy work gives ambitious companies the clarity and confidence to lead their category.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:image {"sizeSlug":"large","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-large has-custom-border"><img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&amp;fit=crop&amp;w=1600" alt="Brand Strategy" style="border-radius:8px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|50","left":"var:preset|spacing|50"}}}} -->
<div class="wp-block-columns alignwide"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:image {"sizeSlug":"large","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-large has-custom-border"><img src="https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?auto=format&amp;fit=crop&amp;w=1600" alt="Web Design" style="border-radius:8px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:group {"metadata":{"name":"Icon"},"layout":{"type":"constrained","contentSize":"60px","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"60px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:60px"><!-- wp:image {"width":"35px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"color":{"duotone":["#ffffff","#ffffff"]}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z%22 /%3E%3C/svg%3E" alt="Web Design icon" style="width:35px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"bottom":"0","top":"0"}}}} -->
<h3 class="wp-block-heading" style="margin-top:0;margin-bottom:0">Web Design</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<p style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">We design and build high-performance websites that look exceptional, load fast, and turn visitors into loyal customers.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/services-4',
	array(
		'title'      => __( 'Services 4', 'sydney' ),
		'categories' => array( 'sydney-services' ),
		'keywords'   => array( 'services', 'agency', 'digital' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_7","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-7-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:group {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained","contentSize":"768px"}} -->
<div class="wp-block-group" style="margin-bottom:var(--wp--preset--spacing--50)"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","fontSize":"12px","letterSpacing":"3px"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}}},"textColor":"global_color_5"} -->
<p class="has-text-align-center has-global-color-5-color has-text-color" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:12px;font-style:normal;font-weight:700;letter-spacing:3px;text-transform:uppercase">What We Do</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"0","top":"0"}}}} -->
<h2 class="wp-block-heading has-text-align-center" style="margin-top:0;margin-bottom:0">Our core services</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"grid","columnCount":3,"minimumColumnWidth":null}} -->
<div class="wp-block-group alignwide"><!-- wp:group {"style":{"border":{"radius":"8px"},"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|50","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}},"backgroundColor":"global_color_6","layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group has-global-color-6-background-color has-background" style="border-radius:8px;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--40)"><!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"500"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffffcc"}}} -->
<p class="has-text-color" style="color:#ffffffcc;margin-top:0;margin-bottom:0;font-style:normal;font-weight:500">01.</p>
<!-- /wp:paragraph -->

<!-- wp:image {"aspectRatio":"16/9","scale":"cover","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-full has-custom-border" style="margin-top:0;margin-bottom:0"><img src="https://images.unsplash.com/photo-1515378791036-0648a3ef77b2?auto=format&amp;fit=crop&amp;w=1600" alt="Agency workspace" style="border-radius:8px;aspect-ratio:16/9;object-fit:cover"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffff"}}} -->
<h4 class="wp-block-heading has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0">Brand Identity</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|20"}},"color":{"text":"#ffffffcc"}}} -->
<p class="has-text-color" style="color:#ffffffcc;margin-top:0;margin-bottom:var(--wp--preset--spacing--20)">Distinctive visual identities that communicate your values, attract the right clients, and make your brand recognizable across every touchpoint.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"500","textDecoration":"underline"},"spacing":{"margin":{"top":"0","bottom":"0"}},"elements":{"link":{"color":{"text":"#ffffff"}}},"color":{"text":"#ffffff"}}} -->
<p class="has-text-color has-link-color" style="color:#ffffff;margin-top:0;margin-bottom:0;font-style:normal;font-weight:500;text-decoration:underline"><a href="#">Discover More</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"border":{"radius":"8px"},"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|50","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}},"backgroundColor":"global_color_6","layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group has-global-color-6-background-color has-background" style="border-radius:8px;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--40)"><!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"500"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffffcc"}}} -->
<p class="has-text-color" style="color:#ffffffcc;margin-top:0;margin-bottom:0;font-style:normal;font-weight:500">02.</p>
<!-- /wp:paragraph -->

<!-- wp:image {"aspectRatio":"16/9","scale":"cover","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-full has-custom-border" style="margin-top:0;margin-bottom:0"><img src="https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?auto=format&amp;fit=crop&amp;w=1600" alt="Strategy session" style="border-radius:8px;aspect-ratio:16/9;object-fit:cover"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffff"}}} -->
<h4 class="wp-block-heading has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0">Digital Strategy</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|20"}},"color":{"text":"#ffffffcc"}}} -->
<p class="has-text-color" style="color:#ffffffcc;margin-top:0;margin-bottom:var(--wp--preset--spacing--20)">Clear strategic frameworks that align your team, define your market position, and map a path to sustainable growth.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"500","textDecoration":"underline"},"spacing":{"margin":{"top":"0","bottom":"0"}},"elements":{"link":{"color":{"text":"#ffffff"}}},"color":{"text":"#ffffff"}}} -->
<p class="has-text-color has-link-color" style="color:#ffffff;margin-top:0;margin-bottom:0;font-style:normal;font-weight:500;text-decoration:underline"><a href="#">Discover More</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"border":{"radius":"8px"},"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|50","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}},"backgroundColor":"global_color_6","layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group has-global-color-6-background-color has-background" style="border-radius:8px;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--40)"><!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"500"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffffcc"}}} -->
<p class="has-text-color" style="color:#ffffffcc;margin-top:0;margin-bottom:0;font-style:normal;font-weight:500">03.</p>
<!-- /wp:paragraph -->

<!-- wp:image {"aspectRatio":"16/9","scale":"cover","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-full has-custom-border" style="margin-top:0;margin-bottom:0"><img src="https://images.unsplash.com/photo-1553877522-43269d4ea984?auto=format&amp;fit=crop&amp;w=1600" alt="Performance analytics" style="border-radius:8px;aspect-ratio:16/9;object-fit:cover"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffff"}}} -->
<h4 class="wp-block-heading has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0">Performance Marketing</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|20"}},"color":{"text":"#ffffffcc"}}} -->
<p class="has-text-color" style="color:#ffffffcc;margin-top:0;margin-bottom:var(--wp--preset--spacing--20)">Targeted campaigns built on audience insights and real data, engineered to maximize reach, engagement, and return on investment.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"500","textDecoration":"underline"},"spacing":{"margin":{"top":"0","bottom":"0"}},"elements":{"link":{"color":{"text":"#ffffff"}}},"color":{"text":"#ffffff"}}} -->
<p class="has-text-color has-link-color" style="color:#ffffff;margin-top:0;margin-bottom:0;font-style:normal;font-weight:500;text-decoration:underline"><a href="#">Discover More</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/services-5',
	array(
		'title'      => __( 'Services 5', 'sydney' ),
		'categories' => array( 'sydney-services' ),
		'keywords'   => array( 'services', 'agency', 'digital' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_6","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-6-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|40"}}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
<div class="wp-block-group alignwide" style="margin-bottom:var(--wp--preset--spacing--40)"><!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","fontSize":"12px","letterSpacing":"3px"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}},"color":{"text":"#6d7685"}}} -->
<p class="has-text-color" style="color:#6d7685;margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:12px;font-style:normal;font-weight:700;letter-spacing:3px;text-transform:uppercase">What We Do</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"color":{"text":"#ffffff"}}} -->
<h2 class="wp-block-heading has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0">Our core services</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-buttons" style="margin-top:0;margin-bottom:0"><!-- wp:button {"className":"is-style-outline","style":{"color":{"text":"#ffffff"},"elements":{"link":{"color":{"text":"#ffffff"}}}}} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link has-text-color has-link-color wp-element-button" href="#" style="color:#ffffff">View all services</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"grid","columnCount":3,"minimumColumnWidth":null}} -->
<div class="wp-block-group alignwide"><!-- wp:group {"style":{"border":{"top":{"color":"#ffffff8c","width":"1px"}},"spacing":{"padding":{"top":"var:preset|spacing|40"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="border-top-color:#ffffff8c;border-top-width:1px;padding-top:var(--wp--preset--spacing--40)"><!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"500"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffffcc"}}} -->
<p class="has-text-color" style="color:#ffffffcc;margin-top:0;margin-bottom:0;font-style:normal;font-weight:500">01</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|20"}},"color":{"text":"#ffffff"}}} -->
<h3 class="wp-block-heading has-text-color" style="color:#ffffff;margin-top:var(--wp--preset--spacing--30);margin-bottom:var(--wp--preset--spacing--20)">Brand Identity</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|20"}},"color":{"text":"#ffffffcc"}}} -->
<p class="has-text-color" style="color:#ffffffcc;margin-top:0;margin-bottom:var(--wp--preset--spacing--20)">Distinctive visual identities that communicate your values, attract the right clients, and make your brand recognizable across every touchpoint.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"border":{"top":{"color":"#ffffff8c","width":"1px"}},"spacing":{"padding":{"top":"var:preset|spacing|40"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="border-top-color:#ffffff8c;border-top-width:1px;padding-top:var(--wp--preset--spacing--40)"><!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"500"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffffcc"}}} -->
<p class="has-text-color" style="color:#ffffffcc;margin-top:0;margin-bottom:0;font-style:normal;font-weight:500">02</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|20"}},"color":{"text":"#ffffff"}}} -->
<h3 class="wp-block-heading has-text-color" style="color:#ffffff;margin-top:var(--wp--preset--spacing--30);margin-bottom:var(--wp--preset--spacing--20)">Digital Strategy</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|20"}},"color":{"text":"#ffffffcc"}}} -->
<p class="has-text-color" style="color:#ffffffcc;margin-top:0;margin-bottom:var(--wp--preset--spacing--20)">Clear strategic frameworks that align your team, define your market position, and map a path to sustainable growth.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"border":{"top":{"color":"#ffffff8c","width":"1px"}},"spacing":{"padding":{"top":"var:preset|spacing|40"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="border-top-color:#ffffff8c;border-top-width:1px;padding-top:var(--wp--preset--spacing--40)"><!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"500"},"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffffcc"}}} -->
<p class="has-text-color" style="color:#ffffffcc;margin-top:0;margin-bottom:0;font-style:normal;font-weight:500">03</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|20"}},"color":{"text":"#ffffff"}}} -->
<h3 class="wp-block-heading has-text-color" style="color:#ffffff;margin-top:var(--wp--preset--spacing--30);margin-bottom:var(--wp--preset--spacing--20)">Performance Marketing</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|20"}},"color":{"text":"#ffffffcc"}}} -->
<p class="has-text-color" style="color:#ffffffcc;margin-top:0;margin-bottom:var(--wp--preset--spacing--20)">Targeted campaigns built on audience insights and real data, engineered to maximize reach, engagement, and return on investment.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/services-6',
	array(
		'title'      => __( 'Services 6', 'sydney' ),
		'categories' => array( 'sydney-services' ),
		'keywords'   => array( 'services', 'agency', 'digital' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"margin":{"top":"0","bottom":"0"}},"color":{"background":"#ffffff"}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-background" style="background-color:#ffffff;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:group {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained","contentSize":"768px"}} -->
<div class="wp-block-group" style="margin-bottom:var(--wp--preset--spacing--50)"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","fontSize":"12px","letterSpacing":"3px"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}}},"textColor":"global_color_5"} -->
<p class="has-text-align-center has-global-color-5-color has-text-color" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:12px;font-style:normal;font-weight:700;letter-spacing:3px;text-transform:uppercase">What We Do</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"0","top":"0"}}}} -->
<h2 class="wp-block-heading has-text-align-center" style="margin-top:0;margin-bottom:0">Our core services</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|50","left":"var:preset|spacing|50"},"margin":{"bottom":"var:preset|spacing|40"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center" style="margin-bottom:var(--wp--preset--spacing--40)"><!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:image {"aspectRatio":"4/3","scale":"cover","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="https://images.unsplash.com/photo-1515378791036-0648a3ef77b2?auto=format&amp;fit=crop&amp;w=1600" alt="Agency workspace" style="border-radius:8px;aspect-ratio:4/3;object-fit:cover"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"500"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0;font-style:normal;font-weight:500">01</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"var:preset|spacing|30"}}}} -->
<h3 class="wp-block-heading" style="margin-top:var(--wp--preset--spacing--20);margin-bottom:var(--wp--preset--spacing--30)">Brand Identity</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"typography":{"fontSize":"18px"}}} -->
<p style="margin-top:0;margin-bottom:0;font-size:18px">Distinctive visual identities that communicate your values, attract the right clients, and make your brand recognizable across every touchpoint.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|50","left":"var:preset|spacing|50"},"margin":{"bottom":"var:preset|spacing|40"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center" style="margin-bottom:var(--wp--preset--spacing--40)"><!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"500"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0;font-style:normal;font-weight:500">02</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"var:preset|spacing|30"}}}} -->
<h3 class="wp-block-heading" style="margin-top:var(--wp--preset--spacing--20);margin-bottom:var(--wp--preset--spacing--30)">Digital Strategy</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"typography":{"fontSize":"18px"}}} -->
<p style="margin-top:0;margin-bottom:0;font-size:18px">Clear strategic frameworks that align your team, define your market position, and map a path to sustainable growth.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:image {"aspectRatio":"4/3","scale":"cover","sizeSlug":"full","linkDestination":"none","style":{"typography":{"fontStyle":"normal","fontWeight":"500"},"spacing":{"margin":{"top":"0","bottom":"0"}},"border":{"radius":{"topLeft":"8px","topRight":"8px","bottomLeft":"8px","bottomRight":"8px"}}}} -->
<figure class="wp-block-image size-full has-custom-border" style="margin-top:0;margin-bottom:0;font-style:normal;font-weight:500"><img src="https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?auto=format&amp;fit=crop&amp;w=1600" alt="Strategy session" style="border-top-left-radius:8px;border-top-right-radius:8px;border-bottom-left-radius:8px;border-bottom-right-radius:8px;aspect-ratio:4/3;object-fit:cover"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|50","left":"var:preset|spacing|50"},"margin":{"bottom":"var:preset|spacing|40"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center" style="margin-bottom:var(--wp--preset--spacing--40)"><!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:image {"aspectRatio":"4/3","scale":"cover","sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><img src="https://images.unsplash.com/photo-1553877522-43269d4ea984?auto=format&amp;fit=crop&amp;w=1600" alt="Performance analytics" style="border-radius:8px;aspect-ratio:4/3;object-fit:cover"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"500"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0;font-style:normal;font-weight:500">03</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"var:preset|spacing|30"}}}} -->
<h3 class="wp-block-heading" style="margin-top:var(--wp--preset--spacing--20);margin-bottom:var(--wp--preset--spacing--30)">Performance Marketing</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"typography":{"fontSize":"18px"}}} -->
<p style="margin-top:0;margin-bottom:0;font-size:18px">Targeted campaigns built on audience insights and real data, engineered to maximize reach, engagement, and return on investment.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->',
	)
);


register_block_pattern(
	'sydney/services-7',
	array(
		'title'      => __( 'Services 7', 'sydney' ),
		'categories' => array( 'sydney-services' ),
		'keywords'   => array( 'services', 'agency', 'digital' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"margin":{"top":"0","bottom":"0"},"blockGap":"0"},"color":{"background":"#ffffff"}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-background" style="background-color:#ffffff;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:group {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained","contentSize":"768px"}} -->
<div class="wp-block-group" style="margin-bottom:var(--wp--preset--spacing--50)"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}},"color":{"text":"var:preset|color|global_color_1"}},"textColor":"global_color_1"} -->
<p class="has-text-align-center has-global-color-1-color has-text-color" style="color:var(--wp--preset--color--global-color-1);margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:700;letter-spacing:0.1em;text-transform:uppercase">Our Services</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"0","top":"0"}}}} -->
<h2 class="wp-block-heading has-text-align-center" style="margin-top:0;margin-bottom:0">Everything you need to win online.</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}},"typography":{"fontSize":"18px"}}} -->
<p class="has-text-align-center" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0;font-size:18px">We offer end-to-end digital services designed to help ambitious brands launch, grow, and dominate their market.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"grid","columnCount":3,"minimumColumnWidth":null}} -->
<div class="wp-block-group alignwide"><!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:group {"metadata":{"name":"Icon"},"layout":{"type":"constrained","contentSize":"60px","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"60px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:60px"><!-- wp:image {"width":"35px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"color":{"duotone":["#ffffff","#ffffff"]}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23d65050%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M9.53 16.122a3 3 0 0 0-5.78 1.128 2.25 2.25 0 0 1-2.4 2.245 4.5 4.5 0 0 0 8.4-2.245c0-.399-.078-.78-.22-1.128Zm0 0a15.998 15.998 0 0 0 3.388-1.62m-5.043-.025a15.994 15.994 0 0 1 1.622-3.395m3.42 3.42a15.995 15.995 0 0 0 4.764-4.648l3.876-5.814a1.151 1.151 0 0 0-1.597-1.597L14.146 6.32a15.996 15.996 0 0 0-4.649 4.763m3.42 3.42a6.776 6.776 0 0 0-3.42-3.42%22 /%3E%3C/svg%3E" alt="Design icon" style="width:35px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"bottom":"0","top":"0"}}}} -->
<h4 class="wp-block-heading" style="margin-top:0;margin-bottom:0">Web Design</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<p style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">Stunning, conversion-focused websites that reflect your brand and engage your audience from the first click.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:group {"metadata":{"name":"Icon"},"layout":{"type":"constrained","contentSize":"60px","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"60px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:60px"><!-- wp:image {"width":"35px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"color":{"duotone":["#ffffff","#ffffff"]}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23d65050%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M17.25 6.75 22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3-4.5 16.5%22 /%3E%3C/svg%3E" alt="Development icon" style="width:35px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"bottom":"0","top":"0"}}}} -->
<h4 class="wp-block-heading" style="margin-top:0;margin-bottom:0">Development</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<p style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">Clean, scalable code built on modern frameworks. We develop fast, secure, and reliable digital products.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:group {"metadata":{"name":"Icon"},"layout":{"type":"constrained","contentSize":"60px","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"60px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:60px"><!-- wp:image {"width":"35px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"color":{"duotone":["#ffffff","#ffffff"]}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23d65050%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z%22 /%3E%3C/svg%3E" alt="Marketing icon" style="width:35px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"bottom":"0","top":"0"}}}} -->
<h4 class="wp-block-heading" style="margin-top:0;margin-bottom:0">Digital Marketing</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<p style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">Data-driven campaigns across SEO, paid media, and social that put your brand in front of the right people.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:group {"metadata":{"name":"Icon"},"layout":{"type":"constrained","contentSize":"60px","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"60px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:60px"><!-- wp:image {"width":"35px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"color":{"duotone":["#ffffff","#ffffff"]}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23d65050%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z%22 /%3E%3C/svg%3E" alt="Branding icon" style="width:35px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"bottom":"0","top":"0"}}}} -->
<h4 class="wp-block-heading" style="margin-top:0;margin-bottom:0">Brand Strategy</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<p style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">We define your positioning, voice, and visual identity so every touchpoint tells a cohesive, compelling story.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:group {"metadata":{"name":"Icon"},"layout":{"type":"constrained","contentSize":"60px","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"60px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:60px"><!-- wp:image {"width":"35px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"color":{"duotone":["#ffffff","#ffffff"]}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23d65050%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3%22 /%3E%3C/svg%3E" alt="Mobile icon" style="width:35px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"bottom":"0","top":"0"}}}} -->
<h4 class="wp-block-heading" style="margin-top:0;margin-bottom:0">Mobile Apps</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<p style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">Native and cross-platform mobile applications built for performance, usability, and long-term growth.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:group {"metadata":{"name":"Icon"},"layout":{"type":"constrained","contentSize":"60px","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"60px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:60px"><!-- wp:image {"width":"35px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"color":{"duotone":["#ffffff","#ffffff"]}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23d65050%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5m.75-9 3-3 2.148 2.148A12.061 12.061 0 0 1 16.5 7.605%22 /%3E%3C/svg%3E" alt="Analytics icon" style="width:35px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"bottom":"0","top":"0"}}}} -->
<h4 class="wp-block-heading" style="margin-top:0;margin-bottom:0">Analytics &amp; SEO</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<p style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">Deep insights and search optimization that turn traffic into leads and leads into loyal customers.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/services-8',
	array(
		'title'      => __( 'Services 8', 'sydney' ),
		'categories' => array( 'sydney-services' ),
		'keywords'   => array( 'services', 'agency', 'digital' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"margin":{"top":"0","bottom":"0"},"blockGap":"0"}},"backgroundColor":"global_color_6","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-6-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:group {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained","contentSize":"768px"}} -->
<div class="wp-block-group" style="margin-bottom:var(--wp--preset--spacing--50)"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}}},"textColor":"white"} -->
<p class="has-text-align-center has-white-color has-text-color" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:700;letter-spacing:0.1em;text-transform:uppercase">Our Services</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"color":{"text":"#ffffff"}}} -->
<h2 class="wp-block-heading has-text-align-center has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0">Everything you need to win online.</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}},"typography":{"fontSize":"18px"},"color":{"text":"#dbdbdb"}}} -->
<p class="has-text-align-center has-text-color" style="color:#dbdbdb;margin-top:var(--wp--preset--spacing--30);margin-bottom:0;font-size:18px">We offer end-to-end digital services designed to help ambitious brands launch, grow, and dominate their market.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|50"}},"layout":{"type":"grid","columnCount":2,"minimumColumnWidth":null}} -->
<div class="wp-block-group alignwide"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:group {"metadata":{"name":"Icon"},"style":{"layout":{"selfStretch":"fixed","flexSize":"96px"}},"layout":{"type":"constrained","contentSize":"56px","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"56px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:56px"><!-- wp:image {"width":"28px","scale":"cover","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"layout":{"selfStretch":"fit","flexSize":null}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M9.53 16.122a3 3 0 0 0-5.78 1.128 2.25 2.25 0 0 1-2.4 2.245 4.5 4.5 0 0 0 8.4-2.245c0-.399-.078-.78-.22-1.128Zm0 0a15.998 15.998 0 0 0 3.388-1.62m-5.043-.025a15.994 15.994 0 0 1 1.622-3.395m3.42 3.42a15.995 15.995 0 0 0 4.764-4.648l3.876-5.814a1.151 1.151 0 0 0-1.597-1.597L14.146 6.32a15.996 15.996 0 0 0-4.649 4.763m3.42 3.42a6.776 6.776 0 0 0-3.42-3.42%22 /%3E%3C/svg%3E" alt="Design icon" style="object-fit:cover;width:28px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"color":{"text":"#ffffff"}}} -->
<h4 class="wp-block-heading has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0">Web Design</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}},"color":{"text":"#dbdbdb"}}} -->
<p class="has-text-color" style="color:#dbdbdb;margin-top:var(--wp--preset--spacing--30);margin-bottom:0">Stunning, conversion-focused websites that reflect your brand and engage your audience from the first click.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:group {"metadata":{"name":"Icon"},"style":{"layout":{"selfStretch":"fixed","flexSize":"96px"}},"layout":{"type":"constrained","contentSize":"56px","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"56px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:56px"><!-- wp:image {"width":"28px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"layout":{"selfStretch":"fit","flexSize":null}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M17.25 6.75 22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3-4.5 16.5%22 /%3E%3C/svg%3E" alt="Development icon" style="width:28px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"color":{"text":"#ffffff"}}} -->
<h4 class="wp-block-heading has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0">Development</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}},"color":{"text":"#dbdbdb"}}} -->
<p class="has-text-color" style="color:#dbdbdb;margin-top:var(--wp--preset--spacing--30);margin-bottom:0">Clean, scalable code built on modern frameworks. We develop fast, secure, and reliable digital products.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
<div class="wp-block-group"><!-- wp:group {"metadata":{"name":"Icon"},"style":{"layout":{"selfStretch":"fixed","flexSize":"96px"}},"layout":{"type":"constrained","contentSize":"56px","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"56px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:56px"><!-- wp:image {"width":"28px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"layout":{"selfStretch":"fit","flexSize":null}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z%22 /%3E%3C/svg%3E" alt="Marketing icon" style="width:28px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"color":{"text":"#ffffff"}}} -->
<h4 class="wp-block-heading has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0">Digital Marketing</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}},"color":{"text":"#dbdbdb"}}} -->
<p class="has-text-color" style="color:#dbdbdb;margin-top:var(--wp--preset--spacing--30);margin-bottom:0">Data-driven campaigns across SEO, paid media, and social that put your brand in front of the right people.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
<div class="wp-block-group"><!-- wp:group {"metadata":{"name":"Icon"},"style":{"layout":{"selfStretch":"fixed","flexSize":"96px"}},"layout":{"type":"constrained","contentSize":"56px","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"56px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:56px"><!-- wp:image {"width":"28px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"layout":{"selfStretch":"fit","flexSize":null}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z%22 /%3E%3C/svg%3E" alt="Branding icon" style="width:28px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"color":{"text":"#ffffff"}}} -->
<h4 class="wp-block-heading has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0">Brand Strategy</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}},"color":{"text":"#dbdbdb"}}} -->
<p class="has-text-color" style="color:#dbdbdb;margin-top:var(--wp--preset--spacing--30);margin-bottom:0">We define your positioning, voice, and visual identity so every touchpoint tells a cohesive, compelling story.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
<div class="wp-block-group"><!-- wp:group {"metadata":{"name":"Icon"},"style":{"layout":{"selfStretch":"fixed","flexSize":"96px"}},"layout":{"type":"constrained","contentSize":"56px","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"56px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:56px"><!-- wp:image {"width":"28px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"layout":{"selfStretch":"fit","flexSize":null}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3%22 /%3E%3C/svg%3E" alt="Mobile icon" style="width:28px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"color":{"text":"#ffffff"}}} -->
<h4 class="wp-block-heading has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0">Mobile Apps</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}},"color":{"text":"#dbdbdb"}}} -->
<p class="has-text-color" style="color:#dbdbdb;margin-top:var(--wp--preset--spacing--30);margin-bottom:0">Native and cross-platform mobile applications built for performance, usability, and long-term growth.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
<div class="wp-block-group"><!-- wp:group {"metadata":{"name":"Icon"},"style":{"layout":{"selfStretch":"fixed","flexSize":"96px"}},"layout":{"type":"constrained","contentSize":"56px","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"56px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:56px"><!-- wp:image {"width":"28px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"layout":{"selfStretch":"fit","flexSize":null}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5m.75-9 3-3 2.148 2.148A12.061 12.061 0 0 1 16.5 7.605%22 /%3E%3C/svg%3E" alt="Analytics icon" style="width:28px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"color":{"text":"#ffffff"}}} -->
<h4 class="wp-block-heading has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0">Analytics &amp; SEO</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}},"color":{"text":"#dbdbdb"}}} -->
<p class="has-text-color" style="color:#dbdbdb;margin-top:var(--wp--preset--spacing--30);margin-bottom:0">Deep insights and search optimization that turn traffic into leads and leads into loyal customers.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/services-9',
	array(
		'title'      => __( 'Services 9', 'sydney' ),
		'categories' => array( 'sydney-services' ),
		'keywords'   => array( 'services', 'agency', 'digital' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"margin":{"top":"0","bottom":"0"},"blockGap":"0"},"color":{"background":"#ffffff"}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-background" style="background-color:#ffffff;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60","left":"var:preset|spacing|60"},"margin":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-columns alignwide" style="margin-top:0;margin-bottom:0"><!-- wp:column {"width":"33.33%","style":{"spacing":{"blockGap":"0"}}} -->
<div class="wp-block-column" style="flex-basis:33.33%"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}},"color":{"text":"var:preset|color|global_color_1"}},"textColor":"global_color_1"} -->
<p class="has-global-color-1-color has-text-color" style="color:var(--wp--preset--color--global-color-1);margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:700;letter-spacing:0.1em;text-transform:uppercase">Our Services</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"style":{"spacing":{"margin":{"bottom":"0","top":"0"}}}} -->
<h2 class="wp-block-heading" style="margin-top:0;margin-bottom:0">Everything you need to win online.</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}},"typography":{"fontSize":"18px"}}} -->
<p style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0;font-size:18px">We offer end-to-end digital services designed to help ambitious brands launch, grow, and dominate their market.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"0"}}}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:0"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">View All Services</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"66.66%"} -->
<div class="wp-block-column" style="flex-basis:66.66%"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"grid","columnCount":2,"minimumColumnWidth":null}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:group {"metadata":{"name":"Icon"},"layout":{"type":"constrained","contentSize":"56px","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"56px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:56px"><!-- wp:image {"width":"28px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"layout":{"selfStretch":"fit","flexSize":null}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M9.53 16.122a3 3 0 0 0-5.78 1.128 2.25 2.25 0 0 1-2.4 2.245 4.5 4.5 0 0 0 8.4-2.245c0-.399-.078-.78-.22-1.128Zm0 0a15.998 15.998 0 0 0 3.388-1.62m-5.043-.025a15.994 15.994 0 0 1 1.622-3.395m3.42 3.42a15.995 15.995 0 0 0 4.764-4.648l3.876-5.814a1.151 1.151 0 0 0-1.597-1.597L14.146 6.32a15.996 15.996 0 0 0-4.649 4.763m3.42 3.42a6.776 6.776 0 0 0-3.42-3.42%22 /%3E%3C/svg%3E" alt="Design icon" style="width:28px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"bottom":"0","top":"var:preset|spacing|30"}}}} -->
<h4 class="wp-block-heading" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">Web Design</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<p style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">Stunning, conversion-focused websites that reflect your brand and engage your audience from the first click.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:group {"metadata":{"name":"Icon"},"layout":{"type":"constrained","contentSize":"56px","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"56px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:56px"><!-- wp:image {"width":"28px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"layout":{"selfStretch":"fit","flexSize":null}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M17.25 6.75 22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3-4.5 16.5%22 /%3E%3C/svg%3E" alt="Development icon" style="width:28px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"bottom":"0","top":"var:preset|spacing|30"}}}} -->
<h4 class="wp-block-heading" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">Development</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<p style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">Clean, scalable code built on modern frameworks. We develop fast, secure, and reliable digital products.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:group {"metadata":{"name":"Icon"},"layout":{"type":"constrained","contentSize":"56px","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"56px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:56px"><!-- wp:image {"width":"28px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"layout":{"selfStretch":"fit","flexSize":null}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z%22 /%3E%3C/svg%3E" alt="Marketing icon" style="width:28px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"bottom":"0","top":"var:preset|spacing|30"}}}} -->
<h4 class="wp-block-heading" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">Digital Marketing</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<p style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">Data-driven campaigns across SEO, paid media, and social that put your brand in front of the right people.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:group {"metadata":{"name":"Icon"},"layout":{"type":"constrained","contentSize":"56px","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"56px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:56px"><!-- wp:image {"width":"28px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"layout":{"selfStretch":"fit","flexSize":null}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z%22 /%3E%3C/svg%3E" alt="Branding icon" style="width:28px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"bottom":"0","top":"var:preset|spacing|30"}}}} -->
<h4 class="wp-block-heading" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">Brand Strategy</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<p style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">We define your positioning, voice, and visual identity so every touchpoint tells a cohesive, compelling story.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/services-10',
	array(
		'title'      => __( 'Services 10', 'sydney' ),
		'categories' => array( 'sydney-services' ),
		'keywords'   => array( 'services', 'agency', 'digital' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"margin":{"top":"0","bottom":"0"},"blockGap":"0"},"color":{"background":"#ffffff"}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-background" style="background-color:#ffffff;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained","contentSize":"768px","justifyContent":"left"}} -->
<div class="wp-block-group alignwide" style="margin-bottom:var(--wp--preset--spacing--70)"><!-- wp:heading {"style":{"spacing":{"margin":{"bottom":"0","top":"0"}}}} -->
<h2 class="wp-block-heading" style="margin-top:0;margin-bottom:0">What sets us apart is our relentless focus on strategy, craft, and measurable outcomes that are specially tailored for every client.</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|50"}},"layout":{"type":"grid","columnCount":4,"minimumColumnWidth":null}} -->
<div class="wp-block-group alignwide"><!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:image {"width":"36px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}},"color":{"duotone":["#8a8a8a","#8a8a8a"]}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30)"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%231c1c1c%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M9.53 16.122a3 3 0 0 0-5.78 1.128 2.25 2.25 0 0 1-2.4 2.245 4.5 4.5 0 0 0 8.4-2.245c0-.399-.078-.78-.22-1.128Zm0 0a15.998 15.998 0 0 0 3.388-1.62m-5.043-.025a15.994 15.994 0 0 1 1.622-3.395m3.42 3.42a15.995 15.995 0 0 0 4.764-4.648l3.876-5.814a1.151 1.151 0 0 0-1.597-1.597L14.146 6.32a15.996 15.996 0 0 0-4.649 4.763m3.42 3.42a6.776 6.776 0 0 0-3.42-3.42%22 /%3E%3C/svg%3E" alt="Design icon" style="width:36px"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"bottom":"0","top":"0"}}}} -->
<h4 class="wp-block-heading" style="margin-top:0;margin-bottom:0">Web Design</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<p style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">Stunning, conversion-focused websites that reflect your brand and engage your audience from the first click.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:image {"width":"36px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}},"color":{"duotone":["#8a8a8a","#8a8a8a"]}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30)"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%231c1c1c%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M17.25 6.75 22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3-4.5 16.5%22 /%3E%3C/svg%3E" alt="Development icon" style="width:36px"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"bottom":"0","top":"0"}}}} -->
<h4 class="wp-block-heading" style="margin-top:0;margin-bottom:0">Development</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<p style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">Clean, scalable code built on modern frameworks. We develop fast, secure, and reliable digital products.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:image {"width":"36px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}},"color":{"duotone":["#8a8a8a","#8a8a8a"]}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30)"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%231c1c1c%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z%22 /%3E%3C/svg%3E" alt="Marketing icon" style="width:36px"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"bottom":"0","top":"0"}}}} -->
<h4 class="wp-block-heading" style="margin-top:0;margin-bottom:0">Digital Marketing</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<p style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">Data-driven campaigns across SEO, paid media, and social that put your brand in front of the right people.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:image {"width":"36px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}},"color":{"duotone":["#8a8a8a","#8a8a8a"]}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30)"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%231c1c1c%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z%22 /%3E%3C/svg%3E" alt="Branding icon" style="width:36px"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"bottom":"0","top":"0"}}}} -->
<h4 class="wp-block-heading" style="margin-top:0;margin-bottom:0">Brand Strategy</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<p style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">We define your positioning, voice, and visual identity so every touchpoint tells a cohesive, compelling story.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/services-11',
	array(
		'title'      => __( 'Services 11', 'sydney' ),
		'categories' => array( 'sydney-services' ),
		'keywords'   => array( 'services', 'agency', 'digital' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"margin":{"top":"0","bottom":"0"},"blockGap":"0"},"color":{"background":"#ffffff"}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-background" style="background-color:#ffffff;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:group {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained","contentSize":"768px"}} -->
<div class="wp-block-group" style="margin-bottom:var(--wp--preset--spacing--50)"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"bottom":"var:preset|spacing|20","top":"0"}},"color":{"text":"var:preset|color|global_color_1"}},"textColor":"global_color_1"} -->
<p class="has-text-align-center has-global-color-1-color has-text-color" style="color:var(--wp--preset--color--global-color-1);margin-top:0;margin-bottom:var(--wp--preset--spacing--20);font-size:14px;font-style:normal;font-weight:700;letter-spacing:0.1em;text-transform:uppercase">Our Services</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"0","top":"0"}}}} -->
<h2 class="wp-block-heading has-text-align-center" style="margin-top:0;margin-bottom:0">Everything you need to win online.</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}},"typography":{"fontSize":"18px"}}} -->
<p class="has-text-align-center" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0;font-size:18px">We offer end-to-end digital services designed to help ambitious brands launch, grow, and dominate their market.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|50"}},"layout":{"type":"grid","columnCount":3,"minimumColumnWidth":null}} -->
<div class="wp-block-group alignwide"><!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:image {"sizeSlug":"large","linkDestination":"none","style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-large has-custom-border" style="margin-top:0;margin-bottom:0"><img src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?q=80&amp;fit=crop&amp;w=1600" alt="Web design process on screen" style="border-radius:8px"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"bottom":"0","top":"var:preset|spacing|30"}}}} -->
<h4 class="wp-block-heading" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">Web Design</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<p style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">Stunning, conversion-focused websites that reflect your brand and engage your audience from the first click.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:image {"sizeSlug":"large","linkDestination":"none","style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-large has-custom-border" style="margin-top:0;margin-bottom:0"><img src="https://images.unsplash.com/photo-1457305237443-44c3d5a30b89?q=80&amp;w=1600" alt="Development technology close-up" style="border-radius:8px"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"bottom":"0","top":"var:preset|spacing|30"}}}} -->
<h4 class="wp-block-heading" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">Development</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<p style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">Clean, scalable code built on modern frameworks. We develop fast, secure, and reliable digital products.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-full has-custom-border" style="margin-top:0;margin-bottom:0"><img src="https://images.unsplash.com/photo-1553877522-43269d4ea984?auto=format&amp;fit=crop&amp;w=1600" alt="Digital marketing strategy session" style="border-radius:8px"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"bottom":"0","top":"var:preset|spacing|30"}}}} -->
<h4 class="wp-block-heading" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">Digital Marketing</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<p style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">Data-driven campaigns across SEO, paid media, and social that put your brand in front of the right people.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/services-12',
	array(
		'title'      => __( 'Services 12', 'sydney' ),
		'categories' => array( 'sydney-services' ),
		'keywords'   => array( 'services', 'agency', 'digital' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"margin":{"top":"0","bottom":"0"},"blockGap":"0"}},"backgroundColor":"global_color_7","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-7-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:group {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained","contentSize":"768px"}} -->
<div class="wp-block-group" style="margin-bottom:var(--wp--preset--spacing--50)"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}},"color":{"text":"var:preset|color|global_color_1"}},"textColor":"global_color_1"} -->
<p class="has-text-align-center has-global-color-1-color has-text-color" style="color:var(--wp--preset--color--global-color-1);margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:700;letter-spacing:0.1em;text-transform:uppercase">Our Services</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"0","top":"0"}}}} -->
<h2 class="wp-block-heading has-text-align-center" style="margin-top:0;margin-bottom:0">Everything you need to win online.</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}},"typography":{"fontSize":"18px"}}} -->
<p class="has-text-align-center" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0;font-size:18px">We offer end-to-end digital services designed to help ambitious brands launch, grow, and dominate their market.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"grid","columnCount":3,"minimumColumnWidth":null}} -->
<div class="wp-block-group alignwide"><!-- wp:group {"style":{"color":{"background":"#ffffff"},"border":{"radius":"8px"},"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background" style="border-radius:8px;background-color:#ffffff;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)"><!-- wp:group {"metadata":{"name":"Icon"},"layout":{"type":"constrained","contentSize":"56px"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"56px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:56px"><!-- wp:image {"width":"28px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"layout":{"selfStretch":"fit","flexSize":null}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M9.53 16.122a3 3 0 0 0-5.78 1.128 2.25 2.25 0 0 1-2.4 2.245 4.5 4.5 0 0 0 8.4-2.245c0-.399-.078-.78-.22-1.128Zm0 0a15.998 15.998 0 0 0 3.388-1.62m-5.043-.025a15.994 15.994 0 0 1 1.622-3.395m3.42 3.42a15.995 15.995 0 0 0 4.764-4.648l3.876-5.814a1.151 1.151 0 0 0-1.597-1.597L14.146 6.32a15.996 15.996 0 0 0-4.649 4.763m3.42 3.42a6.776 6.776 0 0 0-3.42-3.42%22 /%3E%3C/svg%3E" alt="Design icon" style="width:28px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:heading {"textAlign":"center","level":4,"style":{"spacing":{"margin":{"bottom":"0","top":"var:preset|spacing|40"}}}} -->
<h4 class="wp-block-heading has-text-align-center" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:0">Web Design</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<p class="has-text-align-center" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">Stunning, conversion-focused websites that reflect your brand and engage your audience from the first click.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"color":{"background":"#ffffff"},"border":{"radius":"8px"},"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background" style="border-radius:8px;background-color:#ffffff;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)"><!-- wp:group {"metadata":{"name":"Icon"},"layout":{"type":"constrained","contentSize":"56px"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"56px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:56px"><!-- wp:image {"width":"28px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"layout":{"selfStretch":"fit","flexSize":null}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M17.25 6.75 22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3-4.5 16.5%22 /%3E%3C/svg%3E" alt="Development icon" style="width:28px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:heading {"textAlign":"center","level":4,"style":{"spacing":{"margin":{"bottom":"0","top":"var:preset|spacing|40"}}}} -->
<h4 class="wp-block-heading has-text-align-center" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:0">Development</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<p class="has-text-align-center" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">Clean, scalable code built on modern frameworks. We develop fast, secure, and reliable digital products.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"color":{"background":"#ffffff"},"border":{"radius":"8px"},"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background" style="border-radius:8px;background-color:#ffffff;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)"><!-- wp:group {"metadata":{"name":"Icon"},"layout":{"type":"constrained","contentSize":"56px"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"56px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:56px"><!-- wp:image {"width":"28px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"layout":{"selfStretch":"fit","flexSize":null}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z%22 /%3E%3C/svg%3E" alt="Marketing icon" style="width:28px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:heading {"textAlign":"center","level":4,"style":{"spacing":{"margin":{"bottom":"0","top":"var:preset|spacing|40"}}}} -->
<h4 class="wp-block-heading has-text-align-center" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:0">Digital Marketing</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<p class="has-text-align-center" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">Data-driven campaigns across SEO, paid media, and social that put your brand in front of the right people.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"color":{"background":"#ffffff"},"border":{"radius":"8px"},"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background" style="border-radius:8px;background-color:#ffffff;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)"><!-- wp:group {"metadata":{"name":"Icon"},"layout":{"type":"constrained","contentSize":"56px"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"56px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:56px"><!-- wp:image {"width":"28px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"layout":{"selfStretch":"fit","flexSize":null}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z%22 /%3E%3C/svg%3E" alt="Branding icon" style="width:28px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:heading {"textAlign":"center","level":4,"style":{"spacing":{"margin":{"bottom":"0","top":"var:preset|spacing|40"}}}} -->
<h4 class="wp-block-heading has-text-align-center" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:0">Brand Strategy</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<p class="has-text-align-center" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">We define your positioning, voice, and visual identity so every touchpoint tells a cohesive, compelling story.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"color":{"background":"#ffffff"},"border":{"radius":"8px"},"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background" style="border-radius:8px;background-color:#ffffff;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)"><!-- wp:group {"metadata":{"name":"Icon"},"layout":{"type":"constrained","contentSize":"56px"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"56px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:56px"><!-- wp:image {"width":"28px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"layout":{"selfStretch":"fit","flexSize":null}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3%22 /%3E%3C/svg%3E" alt="Mobile icon" style="width:28px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:heading {"textAlign":"center","level":4,"style":{"spacing":{"margin":{"bottom":"0","top":"var:preset|spacing|40"}}}} -->
<h4 class="wp-block-heading has-text-align-center" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:0">Mobile Apps</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<p class="has-text-align-center" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">Native and cross-platform mobile applications built for performance, usability, and long-term growth.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"color":{"background":"#ffffff"},"border":{"radius":"8px"},"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background" style="border-radius:8px;background-color:#ffffff;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)"><!-- wp:group {"metadata":{"name":"Icon"},"layout":{"type":"constrained","contentSize":"56px"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"56px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:56px"><!-- wp:image {"width":"28px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"layout":{"selfStretch":"fit","flexSize":null}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5m.75-9 3-3 2.148 2.148A12.061 12.061 0 0 1 16.5 7.605%22 /%3E%3C/svg%3E" alt="Analytics icon" style="width:28px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:heading {"textAlign":"center","level":4,"style":{"spacing":{"margin":{"bottom":"0","top":"var:preset|spacing|40"}}}} -->
<h4 class="wp-block-heading has-text-align-center" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:0">Analytics &amp; SEO</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<p class="has-text-align-center" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">Deep insights and search optimization that turn traffic into leads and leads into loyal customers.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/services-13',
	array(
		'title'      => __( 'Services 13', 'sydney' ),
		'categories' => array( 'sydney-services' ),
		'keywords'   => array( 'services', 'agency', 'digital' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"margin":{"top":"0","bottom":"0"},"blockGap":"0"}},"backgroundColor":"global_color_7","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-7-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:group {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained","contentSize":"768px"}} -->
<div class="wp-block-group" style="margin-bottom:var(--wp--preset--spacing--50)"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}},"color":{"text":"var:preset|color|global_color_1"}},"textColor":"global_color_1"} -->
<p class="has-text-align-center has-global-color-1-color has-text-color" style="color:var(--wp--preset--color--global-color-1);margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:700;letter-spacing:0.1em;text-transform:uppercase">Our Services</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"0","top":"0"}}}} -->
<h2 class="wp-block-heading has-text-align-center" style="margin-top:0;margin-bottom:0">Everything you need to win online.</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}},"typography":{"fontSize":"18px"}}} -->
<p class="has-text-align-center" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0;font-size:18px">We offer end-to-end digital services designed to help ambitious brands launch, grow, and dominate their market.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"grid","columnCount":2,"minimumColumnWidth":null}} -->
<div class="wp-block-group alignwide"><!-- wp:group {"style":{"color":{"background":"#ffffff"},"border":{"radius":"8px"},"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background" style="border-radius:8px;background-color:#ffffff;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)"><!-- wp:group {"metadata":{"name":"Icon"},"layout":{"type":"constrained","contentSize":"56px"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"56px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:56px"><!-- wp:image {"width":"28px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"layout":{"selfStretch":"fit","flexSize":null}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M9.53 16.122a3 3 0 0 0-5.78 1.128 2.25 2.25 0 0 1-2.4 2.245 4.5 4.5 0 0 0 8.4-2.245c0-.399-.078-.78-.22-1.128Zm0 0a15.998 15.998 0 0 0 3.388-1.62m-5.043-.025a15.994 15.994 0 0 1 1.622-3.395m3.42 3.42a15.995 15.995 0 0 0 4.764-4.648l3.876-5.814a1.151 1.151 0 0 0-1.597-1.597L14.146 6.32a15.996 15.996 0 0 0-4.649 4.763m3.42 3.42a6.776 6.776 0 0 0-3.42-3.42%22 /%3E%3C/svg%3E" alt="Design icon" style="width:28px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:heading {"textAlign":"center","level":4,"style":{"spacing":{"margin":{"bottom":"0","top":"var:preset|spacing|40"}}}} -->
<h4 class="wp-block-heading has-text-align-center" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:0">Web Design</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<p class="has-text-align-center" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">Stunning, conversion-focused websites that reflect your brand and engage your audience from the first click.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"color":{"background":"#ffffff"},"border":{"radius":"8px"},"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background" style="border-radius:8px;background-color:#ffffff;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)"><!-- wp:group {"metadata":{"name":"Icon"},"layout":{"type":"constrained","contentSize":"56px"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"56px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:56px"><!-- wp:image {"width":"28px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"layout":{"selfStretch":"fit","flexSize":null}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M17.25 6.75 22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3-4.5 16.5%22 /%3E%3C/svg%3E" alt="Development icon" style="width:28px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:heading {"textAlign":"center","level":4,"style":{"spacing":{"margin":{"bottom":"0","top":"var:preset|spacing|40"}}}} -->
<h4 class="wp-block-heading has-text-align-center" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:0">Development</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<p class="has-text-align-center" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">Clean, scalable code built on modern frameworks. We develop fast, secure, and reliable digital products.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"color":{"background":"#ffffff"},"border":{"radius":"8px"},"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background" style="border-radius:8px;background-color:#ffffff;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)"><!-- wp:group {"metadata":{"name":"Icon"},"layout":{"type":"constrained","contentSize":"56px"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"56px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:56px"><!-- wp:image {"width":"28px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"layout":{"selfStretch":"fit","flexSize":null}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z%22 /%3E%3C/svg%3E" alt="Marketing icon" style="width:28px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:heading {"textAlign":"center","level":4,"style":{"spacing":{"margin":{"bottom":"0","top":"var:preset|spacing|40"}}}} -->
<h4 class="wp-block-heading has-text-align-center" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:0">Digital Marketing</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<p class="has-text-align-center" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">Data-driven campaigns across SEO, paid media, and social that put your brand in front of the right people.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"color":{"background":"#ffffff"},"border":{"radius":"8px"},"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background" style="border-radius:8px;background-color:#ffffff;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)"><!-- wp:group {"metadata":{"name":"Icon"},"layout":{"type":"constrained","contentSize":"56px"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"56px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:56px"><!-- wp:image {"width":"28px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"layout":{"selfStretch":"fit","flexSize":null}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z%22 /%3E%3C/svg%3E" alt="Branding icon" style="width:28px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:heading {"textAlign":"center","level":4,"style":{"spacing":{"margin":{"bottom":"0","top":"var:preset|spacing|40"}}}} -->
<h4 class="wp-block-heading has-text-align-center" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:0">Brand Strategy</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<p class="has-text-align-center" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0">We define your positioning, voice, and visual identity so every touchpoint tells a cohesive, compelling story.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/services-14',
	array(
		'title'      => __( 'Services 14', 'sydney' ),
		'categories' => array( 'sydney-services' ),
		'keywords'   => array( 'services', 'local', 'business' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_9","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-9-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:group {"layout":{"type":"constrained","contentSize":"768px"}} -->
<div class="wp-block-group"><!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|40"}}}} -->
<h2 class="wp-block-heading has-text-align-center" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--40)">What We Do Best</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-align-center" style="margin-top:0;margin-bottom:0;font-size:18px">From routine maintenance to complex installations, our licensed professionals handle every job with care, precision, and a commitment to your satisfaction.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|50","left":"var:preset|spacing|50"},"margin":{"top":"var:preset|spacing|60","bottom":"0"}}}} -->
<div class="wp-block-columns alignwide" style="margin-top:var(--wp--preset--spacing--60);margin-bottom:0"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:group {"metadata":{"name":"Icon"},"style":{"layout":{"selfStretch":"fixed","flexSize":"96px"}},"layout":{"type":"constrained","contentSize":"56px","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"56px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:56px"><!-- wp:image {"width":"28px","sizeSlug":"large","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"layout":{"selfStretch":"fit","flexSize":null}}} -->
<figure class="wp-block-image size-large is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z%22/%3E%3C/svg%3E" alt="Design icon" style="width:28px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|20"}}}} -->
<h4 class="wp-block-heading" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--20)">Electrical Services</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0;font-size:18px">Panel upgrades, wiring repairs, lighting installations, and full electrical system diagnostics for your home or business.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
<div class="wp-block-group"><!-- wp:group {"metadata":{"name":"Icon"},"style":{"layout":{"selfStretch":"fixed","flexSize":"96px"}},"layout":{"type":"constrained","contentSize":"56px","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"56px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:56px"><!-- wp:image {"width":"28px","sizeSlug":"large","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"layout":{"selfStretch":"fit","flexSize":null}}} -->
<figure class="wp-block-image size-large is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M12 21.75c4.97 0 9-4.03 9-9 0-4.97-9-12.75-9-12.75S3 8.78 3 12.75c0 4.97 4.03 9 9 9z%22/%3E%3C/svg%3E" alt="Design icon" style="width:28px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|20"}}}} -->
<h4 class="wp-block-heading" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--20)">Plumbing Solutions</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0;font-size:18px">Leak detection, pipe repair, water heater installation, and drain cleaning — fast response for every plumbing emergency.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|50","left":"var:preset|spacing|50"},"margin":{"top":"var:preset|spacing|50","bottom":"0"}}}} -->
<div class="wp-block-columns alignwide" style="margin-top:var(--wp--preset--spacing--50);margin-bottom:0"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
<div class="wp-block-group"><!-- wp:group {"metadata":{"name":"Icon"},"style":{"layout":{"selfStretch":"fixed","flexSize":"96px"}},"layout":{"type":"constrained","contentSize":"56px","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"56px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:56px"><!-- wp:image {"width":"28px","sizeSlug":"large","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"layout":{"selfStretch":"fit","flexSize":null}}} -->
<figure class="wp-block-image size-large is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M2.25 12l8.954-8.955a1.126 1.126 0 011.591 0l8.955 8.955M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25%22/%3E%3C/svg%3E" alt="Design icon" style="width:28px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|20"}}}} -->
<h4 class="wp-block-heading" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--20)">Home Renovation</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0;font-size:18px">Kitchen remodels, bathroom upgrades, basement finishing, and complete home transformations handled start to finish.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
<div class="wp-block-group"><!-- wp:group {"metadata":{"name":"Icon"},"style":{"layout":{"selfStretch":"fixed","flexSize":"96px"}},"layout":{"type":"constrained","contentSize":"56px","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"56px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:56px"><!-- wp:image {"width":"28px","sizeSlug":"large","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"layout":{"selfStretch":"fit","flexSize":null}}} -->
<figure class="wp-block-image size-large is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M21.75 6.75a4.5 4.5 0 01-4.884 4.484c-1.076-.091-2.264.071-2.95.904l-7.152 8.684a2.548 2.548 0 11-3.586-3.586l8.684-7.152c.833-.686.995-1.874.904-2.95a4.5 4.5 0 016.336-4.486l-3.276 3.276a3.004 3.004 0 002.25 2.25l3.276-3.276c.256.565.398 1.192.398 1.852z%22/%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M4.867 19.125h.008v.008h-.008v-.008z%22/%3E%3C/svg%3E" alt="Design icon" style="width:28px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|20"}}}} -->
<h4 class="wp-block-heading" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--20)">General Maintenance</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0;font-size:18px">Routine inspections, handyman tasks, seasonal upkeep, and preventive maintenance to keep your property in top shape.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|60","bottom":"0"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--60);margin-bottom:0"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">View All Services</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></section>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/services-15',
	array(
		'title'      => __( 'Services 15', 'sydney' ),
		'categories' => array( 'sydney-services' ),
		'keywords'   => array( 'services', 'local', 'business' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"margin":{"top":"0","bottom":"0"}},"color":{"background":"#F4F5F7"}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-background" style="background-color:#F4F5F7;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|60","left":"var:preset|spacing|60"}}}} -->
<div class="wp-block-columns alignwide"><!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:image {"aspectRatio":"1","scale":"cover","sizeSlug":"large","linkDestination":"none","style":{"border":{"radius":"8px"}}} -->
<figure class="wp-block-image size-large has-custom-border"><img src="https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?auto=format&amp;fit=crop&amp;w=1600" alt="Home service work in progress" style="border-radius:8px;aspect-ratio:1;object-fit:cover"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:heading {"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|40"}}}} -->
<h2 class="wp-block-heading" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--40)">What We Do Best</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0;font-size:18px">From routine maintenance to complex installations, our licensed professionals handle every job with care, precision, and a commitment to your satisfaction.</p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50","bottom":"0"},"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--50);margin-bottom:0"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:group {"metadata":{"name":"Icon"},"style":{"layout":{"selfStretch":"fixed","flexSize":"66px"}},"layout":{"type":"constrained","contentSize":"56px","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"56px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:56px"><!-- wp:image {"width":"28px","sizeSlug":"large","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"layout":{"selfStretch":"fit","flexSize":null}}} -->
<figure class="wp-block-image size-large is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z%22/%3E%3C/svg%3E" alt="Design icon" style="width:28px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|20"}}}} -->
<h4 class="wp-block-heading" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--20)">Electrical Services</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0">Panel upgrades, wiring repairs, lighting installations, and diagnostics.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:group {"metadata":{"name":"Icon"},"style":{"layout":{"selfStretch":"fixed","flexSize":"66px"}},"layout":{"type":"constrained","contentSize":"56px","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"56px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:56px"><!-- wp:image {"width":"28px","sizeSlug":"large","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"layout":{"selfStretch":"fit","flexSize":null}}} -->
<figure class="wp-block-image size-large is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M2.25 12l8.954-8.955a1.126 1.126 0 011.591 0l8.955 8.955M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25%22/%3E%3C/svg%3E" alt="Design icon" style="width:28px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|20"}}}} -->
<h4 class="wp-block-heading" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--20)">Home Renovation</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0">Kitchen remodels, bathroom upgrades, and complete home transformations.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:group {"metadata":{"name":"Icon"},"style":{"layout":{"selfStretch":"fixed","flexSize":"66px"}},"layout":{"type":"constrained","contentSize":"56px","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"56px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:56px"><!-- wp:image {"width":"28px","sizeSlug":"large","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"layout":{"selfStretch":"fit","flexSize":null}}} -->
<figure class="wp-block-image size-large is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M21.75 6.75a4.5 4.5 0 01-4.884 4.484c-1.076-.091-2.264.071-2.95.904l-7.152 8.684a2.548 2.548 0 11-3.586-3.586l8.684-7.152c.833-.686.995-1.874.904-2.95a4.5 4.5 0 016.336-4.486l-3.276 3.276a3.004 3.004 0 002.25 2.25l3.276-3.276c.256.565.398 1.192.398 1.852z%22/%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M4.867 19.125h.008v.008h-.008v-.008z%22/%3E%3C/svg%3E" alt="Design icon" style="width:28px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|20"}}}} -->
<h4 class="wp-block-heading" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--20)">General Maintenance</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0">Routine inspections, handyman tasks, and preventive maintenance.</p>
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
	'sydney/services-16',
	array(
		'title'      => __( 'Services 16', 'sydney' ),
		'categories' => array( 'sydney-services' ),
		'keywords'   => array( 'services', 'local', 'business' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_9","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-9-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:group {"layout":{"type":"constrained","contentSize":"768px"}} -->
<div class="wp-block-group"><!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|40"}}}} -->
<h2 class="wp-block-heading has-text-align-center" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--40)">What We Do Best</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-align-center" style="margin-top:0;margin-bottom:0;font-size:18px">From routine maintenance to complex installations, our licensed professionals handle every job with care, precision, and a commitment to your satisfaction.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|50","left":"var:preset|spacing|50"},"margin":{"top":"var:preset|spacing|50","bottom":"0"}}}} -->
<div class="wp-block-columns alignwide" style="margin-top:var(--wp--preset--spacing--50);margin-bottom:0"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"border":{"radius":"8px"},"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"blockGap":"0"},"color":{"background":"#ffffff"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background" style="border-radius:8px;background-color:#ffffff;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:image {"sizeSlug":"large","linkDestination":"none","style":{"border":{"radius":{"topLeft":"8px","topRight":"8px","bottomLeft":"0px","bottomRight":"0px"}},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-large has-custom-border" style="margin-top:0;margin-bottom:0"><img src="https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?auto=format&amp;fit=crop&amp;w=1600" alt="Electrical work" style="border-top-left-radius:8px;border-top-right-radius:8px;border-bottom-left-radius:0px;border-bottom-right-radius:0px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"blockGap":"0","margin":{"top":"0","bottom":"0"}},"border":{"width":"1px"}},"borderColor":"global_color_8","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-border-color has-global-color-8-border-color" style="border-width:1px;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--40)"><!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|20"}}}} -->
<h4 class="wp-block-heading" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--20)">Electrical Services</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0">Panel upgrades, wiring repairs, lighting installations, and full electrical system diagnostics for your home or business location.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"border":{"radius":"8px"},"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"blockGap":"0"},"color":{"background":"#ffffff"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background" style="border-radius:8px;background-color:#ffffff;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:image {"sizeSlug":"large","linkDestination":"none","style":{"border":{"radius":{"topLeft":"8px","topRight":"8px","bottomLeft":"0px","bottomRight":"0px"}},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-large has-custom-border" style="margin-top:0;margin-bottom:0"><img src="https://images.unsplash.com/photo-1553877522-43269d4ea984?auto=format&amp;fit=crop&amp;w=1600" alt="Plumbing work" style="border-top-left-radius:8px;border-top-right-radius:8px;border-bottom-left-radius:0px;border-bottom-right-radius:0px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"blockGap":"0","margin":{"top":"0","bottom":"0"}},"border":{"width":"1px"}},"borderColor":"global_color_8","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-border-color has-global-color-8-border-color" style="border-width:1px;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--40)"><!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|20"}}}} -->
<h4 class="wp-block-heading" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--20)">Plumbing Solutions</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0">Leak detection, pipe repair, water heater installation, and drain cleaning — fast response for every plumbing emergency.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"border":{"radius":"8px"},"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"blockGap":"0"},"color":{"background":"#ffffff"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background" style="border-radius:8px;background-color:#ffffff;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:image {"sizeSlug":"large","linkDestination":"none","style":{"border":{"radius":{"topLeft":"8px","topRight":"8px","bottomLeft":"0px","bottomRight":"0px"}},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-large has-custom-border" style="margin-top:0;margin-bottom:0"><img src="https://images.unsplash.com/photo-1515378791036-0648a3ef77b2?auto=format&amp;fit=crop&amp;w=1600" alt="Renovation work" style="border-top-left-radius:8px;border-top-right-radius:8px;border-bottom-left-radius:0px;border-bottom-right-radius:0px"/></figure>
<!-- /wp:image -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"blockGap":"0","margin":{"top":"0","bottom":"0"}},"border":{"width":"1px"}},"borderColor":"global_color_8","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-border-color has-global-color-8-border-color" style="border-width:1px;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--40)"><!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|20"}}}} -->
<h4 class="wp-block-heading" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--20)">Home Renovation</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0">Kitchen remodels, bathroom upgrades, basement finishing, and complete home transformations handled start to finish.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">View All Services</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></section>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/services-17',
	array(
		'title'      => __( 'Services 17', 'sydney' ),
		'categories' => array( 'sydney-services' ),
		'keywords'   => array( 'services', 'local', 'business' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_7","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-7-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:group {"layout":{"type":"constrained","contentSize":"768px"}} -->
<div class="wp-block-group"><!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|40"}}}} -->
<h2 class="wp-block-heading has-text-align-center" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--40)">What We Do Best</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-align-center" style="margin-top:0;margin-bottom:0;font-size:18px">From routine maintenance to complex installations, our licensed professionals handle every job with care, precision, and a commitment to your satisfaction.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|50","bottom":"0"},"blockGap":"var:preset|spacing|40"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group alignwide" style="margin-top:var(--wp--preset--spacing--50);margin-bottom:0"><!-- wp:columns {"className":"is-style-default","style":{"spacing":{"blockGap":{"top":"0","left":"0"},"margin":{"top":"0","bottom":"0"}},"border":{"radius":"8px"},"color":{"background":"#ffffff"}}} -->
<div class="wp-block-columns is-style-default has-background" style="border-radius:8px;background-color:#ffffff;margin-top:0;margin-bottom:0"><!-- wp:column {"verticalAlignment":"center","width":"50%","style":{"spacing":{"blockGap":"0"}}} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%"><!-- wp:image {"sizeSlug":"large","linkDestination":"none","style":{"border":{"radius":{"topLeft":"8px","bottomLeft":"8px","topRight":"0px","bottomRight":"0px"}},"spacing":{"margin":{"right":"0","left":"0","top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-large has-custom-border" style="margin-top:0;margin-right:0;margin-bottom:0;margin-left:0"><img src="https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?auto=format&amp;fit=crop&amp;w=1600" alt="Electrical work" style="border-top-left-radius:8px;border-top-right-radius:0px;border-bottom-left-radius:8px;border-bottom-right-radius:0px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"50%","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}}} -->
<div class="wp-block-column is-vertically-aligned-center" style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40);flex-basis:50%"><!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|20"}}}} -->
<h3 class="wp-block-heading" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--20)">Electrical Services</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0;font-size:18px">Panel upgrades, wiring repairs, lighting installations, and full electrical system diagnostics for your home or business.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:columns {"className":"is-style-default","style":{"spacing":{"blockGap":{"top":"0","left":"0"},"margin":{"top":"0","bottom":"0"}},"border":{"radius":"8px"},"color":{"background":"#ffffff"}}} -->
<div class="wp-block-columns is-style-default has-background" style="border-radius:8px;background-color:#ffffff;margin-top:0;margin-bottom:0"><!-- wp:column {"verticalAlignment":"center","width":"50%","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}}} -->
<div class="wp-block-column is-vertically-aligned-center" style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40);flex-basis:50%"><!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|20"}}}} -->
<h3 class="wp-block-heading" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--20)">Plumbing Solutions</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0;font-size:18px">Leak detection, pipe repair, water heater installation, and drain cleaning — fast response for every plumbing emergency.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"50%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%"><!-- wp:image {"sizeSlug":"large","linkDestination":"none","style":{"border":{"radius":{"topRight":"8px","bottomRight":"8px","topLeft":"0px","bottomLeft":"0px"}}}} -->
<figure class="wp-block-image size-large has-custom-border"><img src="https://images.unsplash.com/photo-1553877522-43269d4ea984?auto=format&amp;fit=crop&amp;w=1600" alt="Plumbing work" style="border-top-left-radius:0px;border-top-right-radius:8px;border-bottom-left-radius:0px;border-bottom-right-radius:8px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:columns {"className":"is-style-default","style":{"spacing":{"blockGap":{"top":"0","left":"0"}},"border":{"radius":"8px"},"color":{"background":"#ffffff"}}} -->
<div class="wp-block-columns is-style-default has-background" style="border-radius:8px;background-color:#ffffff"><!-- wp:column {"verticalAlignment":"center","width":"50%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%"><!-- wp:image {"sizeSlug":"large","linkDestination":"none","style":{"border":{"radius":{"topLeft":"8px","bottomLeft":"8px","topRight":"0px","bottomRight":"0px"}}}} -->
<figure class="wp-block-image size-large has-custom-border"><img src="https://images.unsplash.com/photo-1515378791036-0648a3ef77b2?auto=format&amp;fit=crop&amp;w=1600" alt="Renovation work" style="border-top-left-radius:8px;border-top-right-radius:0px;border-bottom-left-radius:8px;border-bottom-right-radius:0px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"50%","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}}} -->
<div class="wp-block-column is-vertically-aligned-center" style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40);flex-basis:50%"><!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|20"}}}} -->
<h3 class="wp-block-heading" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--20)">Home Renovation</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0;font-size:18px">Kitchen remodels, bathroom upgrades, basement finishing, and complete home transformations handled start to finish.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->',
	)
);


register_block_pattern(
	'sydney/services-18',
	array(
		'title'      => __( 'Services 18', 'sydney' ),
		'categories' => array( 'sydney-services' ),
		'keywords'   => array( 'services', 'agency', 'digital' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_6","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-6-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:group {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained","contentSize":"768px"}} -->
<div class="wp-block-group" style="margin-bottom:var(--wp--preset--spacing--50)"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}}},"textColor":"white"} -->
<p class="has-text-align-center has-white-color has-text-color" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:700;letter-spacing:0.1em;text-transform:uppercase">What I Do</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","style":{"color":{"text":"#ffffff"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}}}} -->
<h2 class="wp-block-heading has-text-align-center has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:var(--wp--preset--spacing--30)">Services I Offer</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"color":{"text":"#ffffff99"},"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|40"}}}} -->
<p class="has-text-align-center has-text-color" style="color:#ffffff99;margin-top:0;margin-bottom:var(--wp--preset--spacing--40);font-size:18px">From concept to launch, I provide end-to-end creative solutions tailored to your business goals.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|50"}},"layout":{"type":"grid","columnCount":null,"minimumColumnWidth":"22rem"}} -->
<div class="wp-block-group alignwide"><!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"margin":{"top":"0","bottom":"0"}},"border":{"color":"#ffffff4d","width":"1px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-border-color" style="border-color:#ffffff4d;border-width:1px;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:image {"aspectRatio":"4/3","scale":"cover","sizeSlug":"full","linkDestination":"none","className":"has-custom-border","style":{"border":{"radius":"8px"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|40"}}}} -->
<figure class="wp-block-image size-full has-custom-border" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--40)"><img src="https://images.unsplash.com/photo-1561070791-2526d30994b5?auto=format&amp;fit=crop&amp;w=1600" alt="UI/UX Design" style="border-radius:8px;aspect-ratio:4/3;object-fit:cover"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3,"style":{"color":{"text":"#ffffff"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}}}} -->
<h3 class="wp-block-heading has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:var(--wp--preset--spacing--30)">UI/UX Design</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"color":{"text":"#ffffff99"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-color" style="color:#ffffff99;margin-top:0;margin-bottom:0">Creating intuitive interfaces and seamless user experiences that delight your customers and drive engagement.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"margin":{"top":"0","bottom":"0"}},"border":{"color":"#ffffff4d","width":"1px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-border-color" style="border-color:#ffffff4d;border-width:1px;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:image {"aspectRatio":"4/3","scale":"cover","sizeSlug":"full","linkDestination":"none","className":"has-custom-border","style":{"border":{"radius":"8px"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|40"}}}} -->
<figure class="wp-block-image size-full has-custom-border" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--40)"><img src="https://images.unsplash.com/photo-1499951360447-b19be8fe80f5?auto=format&amp;fit=crop&amp;w=1600" alt="Web Development" style="border-radius:8px;aspect-ratio:4/3;object-fit:cover"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3,"style":{"color":{"text":"#ffffff"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}}}} -->
<h3 class="wp-block-heading has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:var(--wp--preset--spacing--30)">Web Development</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"color":{"text":"#ffffff99"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-color" style="color:#ffffff99;margin-top:0;margin-bottom:0">Building fast, responsive websites and web applications using modern technologies and best practices.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"margin":{"top":"0","bottom":"0"}},"border":{"color":"#ffffff4d","width":"1px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-border-color" style="border-color:#ffffff4d;border-width:1px;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:image {"aspectRatio":"4/3","scale":"cover","sizeSlug":"full","linkDestination":"none","className":"has-custom-border","style":{"border":{"radius":"8px"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|40"}}}} -->
<figure class="wp-block-image size-full has-custom-border" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--40)"><img src="https://images.unsplash.com/photo-1542744094-3a31f272c490?auto=format&amp;fit=crop&amp;w=1600" alt="Brand Identity" style="border-radius:8px;aspect-ratio:4/3;object-fit:cover"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3,"style":{"color":{"text":"#ffffff"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}}}} -->
<h3 class="wp-block-heading has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:var(--wp--preset--spacing--30)">Brand Identity</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"color":{"text":"#ffffff99"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-color" style="color:#ffffff99;margin-top:0;margin-bottom:0">Developing cohesive brand identities that communicate your values and stand out in a crowded market.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"margin":{"top":"0","bottom":"0"}},"border":{"color":"#ffffff4d","width":"1px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-border-color" style="border-color:#ffffff4d;border-width:1px;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:image {"aspectRatio":"4/3","scale":"cover","sizeSlug":"full","linkDestination":"none","className":"has-custom-border","style":{"border":{"radius":"8px"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|40"}}}} -->
<figure class="wp-block-image size-full has-custom-border" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--40)"><img src="https://images.unsplash.com/photo-1483478550801-ceba5fe50e8e?auto=format&amp;fit=crop&amp;w=1600" alt="Mobile Apps" style="border-radius:8px;aspect-ratio:4/3;object-fit:cover"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3,"style":{"color":{"text":"#ffffff"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}}}} -->
<h3 class="wp-block-heading has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:var(--wp--preset--spacing--30)">Mobile Apps</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"color":{"text":"#ffffff99"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-color" style="color:#ffffff99;margin-top:0;margin-bottom:0">Designing and developing mobile applications that provide native-quality experiences across platforms.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/services-19',
	array(
		'title'      => __( 'Services 19', 'sydney' ),
		'categories' => array( 'sydney-services' ),
		'keywords'   => array( 'services', 'agency', 'digital' ),
		'content'    => '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"}}},"backgroundColor":"global_color_6","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-global-color-6-background-color has-background" style="padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)"><!-- wp:group {"tagName":"section","align":"wide","style":{"spacing":{"padding":{"top":"0","bottom":"0"},"margin":{"top":"0","bottom":"0"},"blockGap":"var:preset|spacing|40"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top","justifyContent":"space-between"}} -->
<section class="wp-block-group alignwide" style="margin-top:0;margin-bottom:0;padding-top:0;padding-bottom:0"><!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained","justifyContent":"left"}} -->
<div class="wp-block-group alignwide" style="margin-bottom:var(--wp--preset--spacing--50)"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}}},"textColor":"white"} -->
<p class="has-white-color has-text-color" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:700;letter-spacing:0.1em;text-transform:uppercase">What I Do</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"style":{"color":{"text":"#ffffff"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<h2 class="wp-block-heading has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0">Services I Offer</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained","justifyContent":"left"}} -->
<div class="wp-block-group alignwide"><!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"var:preset|spacing|40"},"padding":{"top":"0","bottom":"var:preset|spacing|20"},"margin":{"top":"0","bottom":"0"}},"border":{"bottom":{"color":"#ffffff4d","width":"1px"},"top":{},"right":{},"left":{}}}} -->
<div class="wp-block-columns" style="border-bottom-color:#ffffff4d;border-bottom-width:1px;margin-top:0;margin-bottom:0;padding-top:0;padding-bottom:var(--wp--preset--spacing--20)"><!-- wp:column {"width":"70px"} -->
<div class="wp-block-column" style="flex-basis:70px"><!-- wp:group {"metadata":{"name":"Icon"},"layout":{"type":"constrained","contentSize":"60px","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"60px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:60px"><!-- wp:image {"width":"35px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"color":{"duotone":["#ffffff","#ffffff"]}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M9.53 16.122a3 3 0 0 0-5.78 1.128 2.25 2.25 0 0 1-2.4 2.245 4.5 4.5 0 0 0 8.4-2.245c0-.399-.078-.78-.22-1.128Zm0 0a15.998 15.998 0 0 0 3.388-1.62m-5.043-.025a15.994 15.994 0 0 1 1.622-3.395m3.42 3.42a15.995 15.995 0 0 0 4.764-4.648l3.876-5.814a1.151 1.151 0 0 0-1.597-1.597L14.146 6.32a15.996 15.996 0 0 0-4.649 4.763m3.42 3.42a6.776 6.776 0 0 0-3.42-3.42%22 /%3E%3C/svg%3E" alt="Design icon" style="width:35px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":4,"style":{"color":{"text":"#ffffff"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|20"}}}} -->
<h4 class="wp-block-heading has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:var(--wp--preset--spacing--20)">UI/UX Design</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"color":{"text":"#ffffff99"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-color" style="color:#ffffff99;margin-top:0;margin-bottom:0">Creating intuitive interfaces and seamless user experiences that delight your customers and drive engagement.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"var:preset|spacing|40"},"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|20"},"margin":{"top":"0","bottom":"0"}},"border":{"bottom":{"color":"#ffffff4d","width":"1px"},"top":{},"right":{},"left":{}}}} -->
<div class="wp-block-columns" style="border-bottom-color:#ffffff4d;border-bottom-width:1px;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--20)"><!-- wp:column {"width":"70px"} -->
<div class="wp-block-column" style="flex-basis:70px"><!-- wp:group {"metadata":{"name":"Icon"},"layout":{"type":"constrained","contentSize":"60px","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"60px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:60px"><!-- wp:image {"width":"35px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"color":{"duotone":["#ffffff","#ffffff"]}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M17.25 6.75 22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3-4.5 16.5%22 /%3E%3C/svg%3E" alt="Code icon" style="width:35px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":4,"style":{"color":{"text":"#ffffff"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|20"}}}} -->
<h4 class="wp-block-heading has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:var(--wp--preset--spacing--20)">Web Development</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"color":{"text":"#ffffff99"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-color" style="color:#ffffff99;margin-top:0;margin-bottom:0">Building fast, responsive websites and web applications using modern technologies and best practices.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"var:preset|spacing|40"},"padding":{"top":"var:preset|spacing|40","bottom":"0"},"margin":{"top":"0","bottom":"0"}},"border":{"bottom":{"width":"0px","style":"none"}}}} -->
<div class="wp-block-columns" style="border-bottom-style:none;border-bottom-width:0px;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--40);padding-bottom:0"><!-- wp:column {"width":"70px"} -->
<div class="wp-block-column" style="flex-basis:70px"><!-- wp:group {"metadata":{"name":"Icon"},"layout":{"type":"constrained","contentSize":"60px","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"60px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:60px"><!-- wp:image {"width":"35px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"color":{"duotone":["#ffffff","#ffffff"]}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 0 1-1.125-1.125v-3.75ZM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-8.25ZM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-2.25Z%22 /%3E%3C/svg%3E" alt="Brand icon" style="width:35px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":4,"style":{"color":{"text":"#ffffff"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|20"}}}} -->
<h4 class="wp-block-heading has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:var(--wp--preset--spacing--20)">Brand Identity</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"color":{"text":"#ffffff99"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p class="has-text-color" style="color:#ffffff99;margin-top:0;margin-bottom:0">Developing cohesive brand identities that communicate your values and stand out in a crowded market.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group --></section>
<!-- /wp:group --></div>
<!-- /wp:group -->',
	)
);


register_block_pattern(
	'sydney/services-20',
	array(
		'title'      => __( 'Services 20', 'sydney' ),
		'categories' => array( 'sydney-services' ),
		'keywords'   => array( 'services', 'professional-corporate' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"margin":{"top":"0","bottom":"0"},"blockGap":"0"},"color":{"background":"#ffffff"}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-background" style="background-color:#ffffff;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)"><!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|70","left":"var:preset|spacing|70"}}}} -->
<div class="wp-block-columns alignwide"><!-- wp:column {"width":"45%"} -->
<div class="wp-block-column" style="flex-basis:45%"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}},"color":{"text":"var:preset|color|global_color_1"}},"textColor":"global_color_1"} -->
<p class="has-global-color-1-color has-text-color" style="color:var(--wp--preset--color--global-color-1);margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:700;letter-spacing:0.1em;text-transform:uppercase">Our Services</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|40","top":"0"}}}} -->
<h2 class="wp-block-heading" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--40)">Expert Consulting for Modern Enterprises</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|50"}}}} -->
<p style="margin-top:0;margin-bottom:var(--wp--preset--spacing--50)">From strategy to execution, we partner with leadership teams to solve their most pressing challenges. Our consultants bring deep industry expertise and a pragmatic approach to every engagement.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button">Explore All Services</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"55%"} -->
<div class="wp-block-column" style="flex-basis:55%"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"grid","columnCount":2,"minimumColumnWidth":null}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}},"border":{"color":"#dbdbdb","width":"1px","radius":"8px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-border-color" style="border-color:#dbdbdb;border-width:1px;border-radius:8px;padding-top:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40)"><!-- wp:group {"metadata":{"name":"Icon"},"layout":{"type":"constrained","contentSize":"56px","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"56px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:56px"><!-- wp:image {"width":"28px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"layout":{"selfStretch":"fit","flexSize":null}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6%22 /%3E%3C/svg%3E" alt="Strategic Planning icon" style="width:28px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|20","top":"0"}}}} -->
<h4 class="wp-block-heading" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--20)">Strategic Planning</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"typography":{"fontSize":"14px"}}} -->
<p style="margin-top:0;margin-bottom:0;font-size:14px">Actionable roadmaps aligned with your long-term vision and goals.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}},"border":{"color":"#dbdbdb","width":"1px","radius":"8px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-border-color" style="border-color:#dbdbdb;border-width:1px;border-radius:8px;padding-top:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40)"><!-- wp:group {"metadata":{"name":"Icon"},"layout":{"type":"constrained","contentSize":"56px","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"56px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:56px"><!-- wp:image {"width":"28px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"layout":{"selfStretch":"fit","flexSize":null}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z%22 /%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z%22 /%3E%3C/svg%3E" alt="Operational Excellence icon" style="width:28px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|20","top":"0"}}}} -->
<h4 class="wp-block-heading" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--20)">Operational Excellence</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"typography":{"fontSize":"14px"}}} -->
<p style="margin-top:0;margin-bottom:0;font-size:14px">Optimize processes and drive efficiency across your organization.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}},"border":{"color":"#dbdbdb","width":"1px","radius":"8px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-border-color" style="border-color:#dbdbdb;border-width:1px;border-radius:8px;padding-top:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40)"><!-- wp:group {"metadata":{"name":"Icon"},"layout":{"type":"constrained","contentSize":"56px","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"56px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:56px"><!-- wp:image {"width":"28px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"layout":{"selfStretch":"fit","flexSize":null}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125%22 /%3E%3C/svg%3E" alt="Digital Transformation icon" style="width:28px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|20","top":"0"}}}} -->
<h4 class="wp-block-heading" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--20)">Digital Transformation</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"typography":{"fontSize":"14px"}}} -->
<p style="margin-top:0;margin-bottom:0;font-size:14px">Modernize capabilities and embrace technology-driven growth.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}},"border":{"color":"#dbdbdb","width":"1px","radius":"8px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-border-color" style="border-color:#dbdbdb;border-width:1px;border-radius:8px;padding-top:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40)"><!-- wp:group {"metadata":{"name":"Icon"},"layout":{"type":"constrained","contentSize":"56px","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"56px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:56px"><!-- wp:image {"width":"28px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"layout":{"selfStretch":"fit","flexSize":null}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z%22 /%3E%3C/svg%3E" alt="Leadership Development icon" style="width:28px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|20","top":"0"}}}} -->
<h4 class="wp-block-heading" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--20)">Leadership Development</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"typography":{"fontSize":"14px"}}} -->
<p style="margin-top:0;margin-bottom:0;font-size:14px">Build capable leaders who inspire teams and drive results.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/services-21',
	array(
		'title'      => __( 'Services 21', 'sydney' ),
		'categories' => array( 'sydney-services' ),
		'keywords'   => array( 'services', 'professional-corporate' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"margin":{"top":"0","bottom":"0"},"blockGap":"0"},"color":{"background":"#ffffff"}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-background" style="background-color:#ffffff;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)"><!-- wp:group {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained","contentSize":"672px"}} -->
<div class="wp-block-group" style="margin-bottom:var(--wp--preset--spacing--50)"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}},"color":{"text":"var:preset|color|global_color_1"}},"textColor":"global_color_1"} -->
<p class="has-text-align-center has-global-color-1-color has-text-color" style="color:var(--wp--preset--color--global-color-1);margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:700;letter-spacing:0.1em;text-transform:uppercase">Our Expertise</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"0","top":"0"}}}} -->
<h2 class="wp-block-heading has-text-align-center" style="margin-top:0;margin-bottom:0">Consulting Solutions</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|50"}},"layout":{"type":"grid","columnCount":3,"minimumColumnWidth":null}} -->
<div class="wp-block-group alignwide"><!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}},"border":{"radius":"8px","color":"#dbdbdb","width":"1px","top":{"color":"var:preset|color|global_color_1","width":"3px"},"right":{},"bottom":{},"left":{}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-border-color" style="border-color:#dbdbdb;border-width:1px;border-radius:8px;border-top-color:var(--wp--preset--color--global-color-1);border-top-width:3px;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:group {"metadata":{"name":"Icon"},"layout":{"type":"constrained","contentSize":"56px","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"56px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:56px"><!-- wp:image {"width":"28px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"layout":{"selfStretch":"fit","flexSize":null}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6%22 /%3E%3C/svg%3E" alt="Strategic Planning icon" style="width:28px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|20","top":"0"}}}} -->
<h4 class="wp-block-heading" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--20)">Strategic Planning</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0">Define your long-term vision with actionable roadmaps that align leadership, resources, and market opportunity.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}},"border":{"radius":"8px","color":"#dbdbdb","width":"1px","top":{"color":"var:preset|color|global_color_1","width":"3px"},"right":{},"bottom":{},"left":{}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-border-color" style="border-color:#dbdbdb;border-width:1px;border-radius:8px;border-top-color:var(--wp--preset--color--global-color-1);border-top-width:3px;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:group {"metadata":{"name":"Icon"},"layout":{"type":"constrained","contentSize":"56px","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"56px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:56px"><!-- wp:image {"width":"28px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"layout":{"selfStretch":"fit","flexSize":null}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z%22 /%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z%22 /%3E%3C/svg%3E" alt="Operational Excellence icon" style="width:28px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|20","top":"0"}}}} -->
<h4 class="wp-block-heading" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--20)">Operational Excellence</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0">Streamline processes, reduce costs, and improve performance across every layer of your organization.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}},"border":{"radius":"8px","color":"#dbdbdb","width":"1px","top":{"color":"var:preset|color|global_color_1","width":"3px"},"right":{},"bottom":{},"left":{}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-border-color" style="border-color:#dbdbdb;border-width:1px;border-radius:8px;border-top-color:var(--wp--preset--color--global-color-1);border-top-width:3px;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:group {"metadata":{"name":"Icon"},"layout":{"type":"constrained","contentSize":"56px","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"56px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:56px"><!-- wp:image {"width":"28px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"layout":{"selfStretch":"fit","flexSize":null}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125%22 /%3E%3C/svg%3E" alt="Digital Transformation icon" style="width:28px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|20","top":"0"}}}} -->
<h4 class="wp-block-heading" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--20)">Digital Transformation</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0">Modernize your technology stack and digital capabilities to meet evolving market demands.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}},"border":{"radius":"8px","color":"#dbdbdb","width":"1px","top":{"color":"var:preset|color|global_color_1","width":"3px"},"right":{},"bottom":{},"left":{}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-border-color" style="border-color:#dbdbdb;border-width:1px;border-radius:8px;border-top-color:var(--wp--preset--color--global-color-1);border-top-width:3px;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:group {"metadata":{"name":"Icon"},"layout":{"type":"constrained","contentSize":"56px","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"56px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:56px"><!-- wp:image {"width":"28px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"layout":{"selfStretch":"fit","flexSize":null}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z%22 /%3E%3C/svg%3E" alt="Leadership Development icon" style="width:28px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|20","top":"0"}}}} -->
<h4 class="wp-block-heading" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--20)">Leadership Development</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0">Build capable leaders who inspire teams, navigate complexity, and deliver consistent results.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}},"border":{"radius":"8px","color":"#dbdbdb","width":"1px","top":{"color":"var:preset|color|global_color_1","width":"3px"},"right":{},"bottom":{},"left":{}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-border-color" style="border-color:#dbdbdb;border-width:1px;border-radius:8px;border-top-color:var(--wp--preset--color--global-color-1);border-top-width:3px;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:group {"metadata":{"name":"Icon"},"layout":{"type":"constrained","contentSize":"56px","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"56px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:56px"><!-- wp:image {"width":"28px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"layout":{"selfStretch":"fit","flexSize":null}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z%22 /%3E%3C/svg%3E" alt="Financial Advisory icon" style="width:28px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|20","top":"0"}}}} -->
<h4 class="wp-block-heading" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--20)">Financial Advisory</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0">Optimize capital allocation, manage risk, and drive shareholder value with data-driven financial strategies.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}},"border":{"radius":"8px","color":"#dbdbdb","width":"1px","top":{"color":"var:preset|color|global_color_1","width":"3px"},"right":{},"bottom":{},"left":{}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-border-color" style="border-color:#dbdbdb;border-width:1px;border-radius:8px;border-top-color:var(--wp--preset--color--global-color-1);border-top-width:3px;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:group {"metadata":{"name":"Icon"},"layout":{"type":"constrained","contentSize":"56px","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"56px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:56px"><!-- wp:image {"width":"28px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"layout":{"selfStretch":"fit","flexSize":null}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941%22 /%3E%3C/svg%3E" alt="Market Analysis icon" style="width:28px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|20","top":"0"}}}} -->
<h4 class="wp-block-heading" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--20)">Market Analysis</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0">Gain deep market intelligence and competitive insights to inform strategic decision-making.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->',
	)
);

register_block_pattern(
	'sydney/services-22',
	array(
		'title'      => __( 'Services 22', 'sydney' ),
		'categories' => array( 'sydney-services' ),
		'keywords'   => array( 'services', 'professional-corporate' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"margin":{"top":"0","bottom":"0"},"blockGap":"0"}},"backgroundColor":"global_color_6","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-6-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)"><!-- wp:group {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained","contentSize":"672px"}} -->
<div class="wp-block-group" style="margin-bottom:var(--wp--preset--spacing--50)"><!-- wp:paragraph {"align":"center","style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}}},"textColor":"white"} -->
<p class="has-text-align-center has-white-color has-text-color" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30);font-size:14px;font-style:normal;font-weight:700;letter-spacing:0.1em;text-transform:uppercase">Services</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|30","top":"0"}},"color":{"text":"#ffffff"}}} -->
<h2 class="wp-block-heading has-text-align-center has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:var(--wp--preset--spacing--30)">Built for Business Impact</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffff"}}} -->
<p class="has-text-align-center has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0">Our six core practice areas cover every dimension of organizational performance, from boardroom strategy to frontline execution.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|50"}},"layout":{"type":"grid","columnCount":3,"minimumColumnWidth":null}} -->
<div class="wp-block-group alignwide"><!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}},"border":{"color":"rgba(255,255,255,0.15)","width":"1px","radius":"8px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-border-color" style="border-color:rgba(255,255,255,0.15);border-width:1px;border-radius:8px;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:group {"metadata":{"name":"Icon"},"layout":{"type":"constrained","contentSize":"56px","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"56px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:56px"><!-- wp:image {"width":"28px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"layout":{"selfStretch":"fit","flexSize":null}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6%22 /%3E%3C/svg%3E" alt="Strategic Planning icon" style="width:28px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|20","top":"0"}},"color":{"text":"#ffffff"}}} -->
<h4 class="wp-block-heading has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:var(--wp--preset--spacing--20)">Strategic Planning</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffff"}}} -->
<p class="has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0">Define your long-term vision with actionable roadmaps that align leadership and resources.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}},"border":{"color":"rgba(255,255,255,0.15)","width":"1px","radius":"8px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-border-color" style="border-color:rgba(255,255,255,0.15);border-width:1px;border-radius:8px;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:group {"metadata":{"name":"Icon"},"layout":{"type":"constrained","contentSize":"56px","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"56px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:56px"><!-- wp:image {"width":"28px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"layout":{"selfStretch":"fit","flexSize":null}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z%22 /%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z%22 /%3E%3C/svg%3E" alt="Operational Excellence icon" style="width:28px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|20","top":"0"}},"color":{"text":"#ffffff"}}} -->
<h4 class="wp-block-heading has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:var(--wp--preset--spacing--20)">Operational Excellence</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffff"}}} -->
<p class="has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0">Streamline processes and improve performance across every layer of your organization.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}},"border":{"color":"rgba(255,255,255,0.15)","width":"1px","radius":"8px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-border-color" style="border-color:rgba(255,255,255,0.15);border-width:1px;border-radius:8px;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:group {"metadata":{"name":"Icon"},"layout":{"type":"constrained","contentSize":"56px","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"56px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:56px"><!-- wp:image {"width":"28px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"layout":{"selfStretch":"fit","flexSize":null}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125%22 /%3E%3C/svg%3E" alt="Digital Transformation icon" style="width:28px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|20","top":"0"}},"color":{"text":"#ffffff"}}} -->
<h4 class="wp-block-heading has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:var(--wp--preset--spacing--20)">Digital Transformation</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffff"}}} -->
<p class="has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0">Modernize your technology stack and digital capabilities for the future.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}},"border":{"color":"rgba(255,255,255,0.15)","width":"1px","radius":"8px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-border-color" style="border-color:rgba(255,255,255,0.15);border-width:1px;border-radius:8px;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:group {"metadata":{"name":"Icon"},"layout":{"type":"constrained","contentSize":"56px","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"56px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:56px"><!-- wp:image {"width":"28px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"layout":{"selfStretch":"fit","flexSize":null}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z%22 /%3E%3C/svg%3E" alt="Leadership Development icon" style="width:28px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|20","top":"0"}},"color":{"text":"#ffffff"}}} -->
<h4 class="wp-block-heading has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:var(--wp--preset--spacing--20)">Leadership Development</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffff"}}} -->
<p class="has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0">Build capable leaders who inspire teams and drive organizational success.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}},"border":{"color":"rgba(255,255,255,0.15)","width":"1px","radius":"8px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-border-color" style="border-color:rgba(255,255,255,0.15);border-width:1px;border-radius:8px;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:group {"metadata":{"name":"Icon"},"layout":{"type":"constrained","contentSize":"56px","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"56px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:56px"><!-- wp:image {"width":"28px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"layout":{"selfStretch":"fit","flexSize":null}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z%22 /%3E%3C/svg%3E" alt="Financial Advisory icon" style="width:28px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|20","top":"0"}},"color":{"text":"#ffffff"}}} -->
<h4 class="wp-block-heading has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:var(--wp--preset--spacing--20)">Financial Advisory</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffff"}}} -->
<p class="has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0">Optimize capital allocation and manage risk with data-driven financial strategies.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}},"border":{"color":"rgba(255,255,255,0.15)","width":"1px","radius":"8px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-border-color" style="border-color:rgba(255,255,255,0.15);border-width:1px;border-radius:8px;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:group {"metadata":{"name":"Icon"},"layout":{"type":"constrained","contentSize":"56px","justifyContent":"left"}} -->
<div class="wp-block-group"><!-- wp:group {"style":{"dimensions":{"minHeight":"56px"},"border":{"radius":{"topLeft":"50px","topRight":"50px","bottomLeft":"50px","bottomRight":"50px"}}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-top-left-radius:50px;border-top-right-radius:50px;border-bottom-left-radius:50px;border-bottom-right-radius:50px;min-height:56px"><!-- wp:image {"width":"28px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"bottom":"0","top":"0"}},"layout":{"selfStretch":"fit","flexSize":null}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke-width=%221.5%22 stroke=%22%23ffffff%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 d=%22M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941%22 /%3E%3C/svg%3E" alt="Market Analysis icon" style="width:28px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|20","top":"0"}},"color":{"text":"#ffffff"}}} -->
<h4 class="wp-block-heading has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:var(--wp--preset--spacing--20)">Market Analysis</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"#ffffff"}}} -->
<p class="has-text-color" style="color:#ffffff;margin-top:0;margin-bottom:0">Gain deep market intelligence and competitive insights for better decisions.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->',
	)
);
