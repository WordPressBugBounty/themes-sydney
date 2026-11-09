<?php
/**
 * Pro pricing patterns
 *
 * Returns a list of pattern arrays. See README.md for the format.
 *
 * @package Sydney
 */

return array(

	// Pricing 3: three plan cards with a price, a full-width button and a checked feature list.
	array(
		'name'       => 'sydney-pro/pricing-1',
		'title'      => __( 'Pricing 3', 'sydney' ),
		'categories' => array( 'sydney-pricing' ),
		'keywords'   => array( 'pricing', 'plans', 'cards', 'features' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_9","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-9-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)"><!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|40","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"grid","columnCount":null,"minimumColumnWidth":"18rem"}} -->
<div class="wp-block-group alignwide" style="margin-top:0;margin-bottom:0"><!-- wp:group {"style":{"border":{"radius":"16px","width":"1px"},"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"blockGap":"0"}},"backgroundColor":"global_color_7","borderColor":"global_color_8","layout":{"type":"flex","orientation":"vertical","justifyContent":"stretch"}} -->
<div class="wp-block-group has-border-color has-global-color-8-border-color has-global-color-7-background-color has-background" style="border-width:1px;border-radius:16px;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<h4 class="wp-block-heading" style="margin-top:0;margin-bottom:0">Starter plan</h4>
<!-- /wp:heading -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"},"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"bottom"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0"><!-- wp:paragraph {"style":{"typography":{"fontSize":"48px","fontStyle":"normal","fontWeight":"700","lineHeight":"1"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"global_color_4"} -->
<p class="has-global-color-4-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:48px;font-style:normal;font-weight:700;line-height:1">$19</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"4px"}}},"textColor":"global_color_5"} -->
<p class="has-global-color-5-color has-text-color" style="margin-top:0;margin-bottom:4px;font-size:14px">per month</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"0"}}}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:0"><!-- wp:button {"textColor":"global_color_4","width":100,"className":"is-style-outline"} -->
<div class="wp-block-button has-custom-width wp-block-button__width-100 is-style-outline"><a class="wp-block-button__link has-global-color-4-color has-text-color wp-element-button" href="#">Get started</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->

<!-- wp:group {"style":{"border":{"top":{"color":"var:preset|color|global_color_8","style":"dotted","width":"1px"}},"spacing":{"padding":{"top":"var:preset|spacing|40"},"margin":{"top":"var:preset|spacing|40","bottom":"0"},"blockGap":"0"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"stretch"}} -->
<div class="wp-block-group" style="border-top-color:var(--wp--preset--color--global-color-8);border-top-style:dotted;border-top-width:1px;margin-top:var(--wp--preset--spacing--40);margin-bottom:0;padding-top:var(--wp--preset--spacing--40)"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|20"}}},"textColor":"global_color_4"} -->
<p class="has-global-color-4-color has-text-color" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--20);font-size:14px;font-style:normal;font-weight:700;letter-spacing:0.1em;text-transform:uppercase">Features</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|40"}}},"textColor":"global_color_5"} -->
<p class="has-global-color-5-color has-text-color" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--40)">The essentials to get started.</p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20","margin":{"top":"0","bottom":"var:preset|spacing|30"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30)"><!-- wp:group {"style":{"border":{"radius":"999px"},"dimensions":{"minHeight":"22px"},"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"blockGap":"0","margin":{"top":"0","bottom":"0"}},"layout":{"selfStretch":"fixed","flexSize":"22px"},"typography":{"lineHeight":"0"}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-radius:999px;min-height:22px;margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;line-height:0"><!-- wp:image {"width":"14px","height":"14px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 20 20%27 fill=%27%23ffffff%27%3E%3Cpath fill-rule=%27evenodd%27 d=%27M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z%27 clip-rule=%27evenodd%27 /%3E%3C/svg%3E" alt="Included" style="width:14px;height:14px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0">Up to 3 team members</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20","margin":{"top":"0","bottom":"var:preset|spacing|30"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30)"><!-- wp:group {"style":{"border":{"radius":"999px"},"dimensions":{"minHeight":"22px"},"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"blockGap":"0","margin":{"top":"0","bottom":"0"}},"layout":{"selfStretch":"fixed","flexSize":"22px"},"typography":{"lineHeight":"0"}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-radius:999px;min-height:22px;margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;line-height:0"><!-- wp:image {"width":"14px","height":"14px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 20 20%27 fill=%27%23ffffff%27%3E%3Cpath fill-rule=%27evenodd%27 d=%27M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z%27 clip-rule=%27evenodd%27 /%3E%3C/svg%3E" alt="Included" style="width:14px;height:14px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0">10 GB secure storage</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20","margin":{"top":"0","bottom":"var:preset|spacing|30"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30)"><!-- wp:group {"style":{"border":{"radius":"999px"},"dimensions":{"minHeight":"22px"},"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"blockGap":"0","margin":{"top":"0","bottom":"0"}},"layout":{"selfStretch":"fixed","flexSize":"22px"},"typography":{"lineHeight":"0"}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-radius:999px;min-height:22px;margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;line-height:0"><!-- wp:image {"width":"14px","height":"14px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 20 20%27 fill=%27%23ffffff%27%3E%3Cpath fill-rule=%27evenodd%27 d=%27M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z%27 clip-rule=%27evenodd%27 /%3E%3C/svg%3E" alt="Included" style="width:14px;height:14px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0">Basic reports</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20","margin":{"top":"0","bottom":"var:preset|spacing|30"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30)"><!-- wp:group {"style":{"border":{"radius":"999px"},"dimensions":{"minHeight":"22px"},"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"blockGap":"0","margin":{"top":"0","bottom":"0"}},"layout":{"selfStretch":"fixed","flexSize":"22px"},"typography":{"lineHeight":"0"}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-radius:999px;min-height:22px;margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;line-height:0"><!-- wp:image {"width":"14px","height":"14px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 20 20%27 fill=%27%23ffffff%27%3E%3Cpath fill-rule=%27evenodd%27 d=%27M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z%27 clip-rule=%27evenodd%27 /%3E%3C/svg%3E" alt="Included" style="width:14px;height:14px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0">Email support</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:group {"style":{"border":{"radius":"999px"},"dimensions":{"minHeight":"22px"},"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"blockGap":"0","margin":{"top":"0","bottom":"0"}},"layout":{"selfStretch":"fixed","flexSize":"22px"},"typography":{"lineHeight":"0"}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-radius:999px;min-height:22px;margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;line-height:0"><!-- wp:image {"width":"14px","height":"14px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 20 20%27 fill=%27%23ffffff%27%3E%3Cpath fill-rule=%27evenodd%27 d=%27M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z%27 clip-rule=%27evenodd%27 /%3E%3C/svg%3E" alt="Included" style="width:14px;height:14px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0">Step-by-step onboarding guide</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"border":{"radius":"16px","width":"1px"},"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"blockGap":"0"}},"backgroundColor":"global_color_7","borderColor":"global_color_8","layout":{"type":"flex","orientation":"vertical","justifyContent":"stretch"}} -->
<div class="wp-block-group has-border-color has-global-color-8-border-color has-global-color-7-background-color has-background" style="border-width:1px;border-radius:16px;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"},"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<h4 class="wp-block-heading" style="margin-top:0;margin-bottom:0">Growth plan</h4>
<!-- /wp:heading -->

<!-- wp:group {"style":{"border":{"radius":"6px","width":"1px"},"spacing":{"padding":{"top":"6px","bottom":"6px","left":"12px","right":"12px"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_9","borderColor":"global_color_8","layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group has-border-color has-global-color-8-border-color has-global-color-9-background-color has-background" style="border-width:1px;border-radius:6px;margin-top:0;margin-bottom:0;padding-top:6px;padding-right:12px;padding-bottom:6px;padding-left:12px"><!-- wp:paragraph {"style":{"typography":{"fontSize":"12px","fontStyle":"normal","fontWeight":"600","lineHeight":"1.2"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"global_color_4"} -->
<p class="has-global-color-4-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:12px;font-style:normal;font-weight:600;line-height:1.2">Most popular</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"},"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"bottom"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0"><!-- wp:paragraph {"style":{"typography":{"fontSize":"48px","fontStyle":"normal","fontWeight":"700","lineHeight":"1"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"global_color_4"} -->
<p class="has-global-color-4-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:48px;font-style:normal;font-weight:700;line-height:1">$39</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"4px"}}},"textColor":"global_color_5"} -->
<p class="has-global-color-5-color has-text-color" style="margin-top:0;margin-bottom:4px;font-size:14px">per month</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"0"}}}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:0"><!-- wp:button {"textColor":"global_color_4","width":100,"className":"is-style-outline"} -->
<div class="wp-block-button has-custom-width wp-block-button__width-100 is-style-outline"><a class="wp-block-button__link has-global-color-4-color has-text-color wp-element-button" href="#">Get started</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->

<!-- wp:group {"style":{"border":{"top":{"color":"var:preset|color|global_color_8","style":"dotted","width":"1px"}},"spacing":{"padding":{"top":"var:preset|spacing|40"},"margin":{"top":"var:preset|spacing|40","bottom":"0"},"blockGap":"0"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"stretch"}} -->
<div class="wp-block-group" style="border-top-color:var(--wp--preset--color--global-color-8);border-top-style:dotted;border-top-width:1px;margin-top:var(--wp--preset--spacing--40);margin-bottom:0;padding-top:var(--wp--preset--spacing--40)"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|20"}}},"textColor":"global_color_4"} -->
<p class="has-global-color-4-color has-text-color" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--20);font-size:14px;font-style:normal;font-weight:700;letter-spacing:0.1em;text-transform:uppercase">Features</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|40"}}},"textColor":"global_color_5"} -->
<p class="has-global-color-5-color has-text-color" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--40)">Everything in Starter, plus:</p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20","margin":{"top":"0","bottom":"var:preset|spacing|30"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30)"><!-- wp:group {"style":{"border":{"radius":"999px"},"dimensions":{"minHeight":"22px"},"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"blockGap":"0","margin":{"top":"0","bottom":"0"}},"layout":{"selfStretch":"fixed","flexSize":"22px"},"typography":{"lineHeight":"0"}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-radius:999px;min-height:22px;margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;line-height:0"><!-- wp:image {"width":"14px","height":"14px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 20 20%27 fill=%27%23ffffff%27%3E%3Cpath fill-rule=%27evenodd%27 d=%27M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z%27 clip-rule=%27evenodd%27 /%3E%3C/svg%3E" alt="Included" style="width:14px;height:14px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0">Up to 15 team members</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20","margin":{"top":"0","bottom":"var:preset|spacing|30"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30)"><!-- wp:group {"style":{"border":{"radius":"999px"},"dimensions":{"minHeight":"22px"},"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"blockGap":"0","margin":{"top":"0","bottom":"0"}},"layout":{"selfStretch":"fixed","flexSize":"22px"},"typography":{"lineHeight":"0"}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-radius:999px;min-height:22px;margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;line-height:0"><!-- wp:image {"width":"14px","height":"14px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 20 20%27 fill=%27%23ffffff%27%3E%3Cpath fill-rule=%27evenodd%27 d=%27M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z%27 clip-rule=%27evenodd%27 /%3E%3C/svg%3E" alt="Included" style="width:14px;height:14px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0">100 GB secure storage</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20","margin":{"top":"0","bottom":"var:preset|spacing|30"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30)"><!-- wp:group {"style":{"border":{"radius":"999px"},"dimensions":{"minHeight":"22px"},"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"blockGap":"0","margin":{"top":"0","bottom":"0"}},"layout":{"selfStretch":"fixed","flexSize":"22px"},"typography":{"lineHeight":"0"}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-radius:999px;min-height:22px;margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;line-height:0"><!-- wp:image {"width":"14px","height":"14px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 20 20%27 fill=%27%23ffffff%27%3E%3Cpath fill-rule=%27evenodd%27 d=%27M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z%27 clip-rule=%27evenodd%27 /%3E%3C/svg%3E" alt="Included" style="width:14px;height:14px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0">Advanced reports</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20","margin":{"top":"0","bottom":"var:preset|spacing|30"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30)"><!-- wp:group {"style":{"border":{"radius":"999px"},"dimensions":{"minHeight":"22px"},"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"blockGap":"0","margin":{"top":"0","bottom":"0"}},"layout":{"selfStretch":"fixed","flexSize":"22px"},"typography":{"lineHeight":"0"}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-radius:999px;min-height:22px;margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;line-height:0"><!-- wp:image {"width":"14px","height":"14px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 20 20%27 fill=%27%23ffffff%27%3E%3Cpath fill-rule=%27evenodd%27 d=%27M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z%27 clip-rule=%27evenodd%27 /%3E%3C/svg%3E" alt="Included" style="width:14px;height:14px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0">Priority email and chat support</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:group {"style":{"border":{"radius":"999px"},"dimensions":{"minHeight":"22px"},"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"blockGap":"0","margin":{"top":"0","bottom":"0"}},"layout":{"selfStretch":"fixed","flexSize":"22px"},"typography":{"lineHeight":"0"}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-radius:999px;min-height:22px;margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;line-height:0"><!-- wp:image {"width":"14px","height":"14px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 20 20%27 fill=%27%23ffffff%27%3E%3Cpath fill-rule=%27evenodd%27 d=%27M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z%27 clip-rule=%27evenodd%27 /%3E%3C/svg%3E" alt="Included" style="width:14px;height:14px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0">Custom integrations</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"border":{"radius":"16px","width":"1px"},"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"blockGap":"0"}},"backgroundColor":"global_color_7","borderColor":"global_color_8","layout":{"type":"flex","orientation":"vertical","justifyContent":"stretch"}} -->
<div class="wp-block-group has-border-color has-global-color-8-border-color has-global-color-7-background-color has-background" style="border-width:1px;border-radius:16px;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<h4 class="wp-block-heading" style="margin-top:0;margin-bottom:0">Scale plan</h4>
<!-- /wp:heading -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"},"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"bottom"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0"><!-- wp:paragraph {"style":{"typography":{"fontSize":"48px","fontStyle":"normal","fontWeight":"700","lineHeight":"1"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"global_color_4"} -->
<p class="has-global-color-4-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:48px;font-style:normal;font-weight:700;line-height:1">$79</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"4px"}}},"textColor":"global_color_5"} -->
<p class="has-global-color-5-color has-text-color" style="margin-top:0;margin-bottom:4px;font-size:14px">per month</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"0"}}}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:0"><!-- wp:button {"textColor":"global_color_4","width":100,"className":"is-style-outline"} -->
<div class="wp-block-button has-custom-width wp-block-button__width-100 is-style-outline"><a class="wp-block-button__link has-global-color-4-color has-text-color wp-element-button" href="#">Get started</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->

<!-- wp:group {"style":{"border":{"top":{"color":"var:preset|color|global_color_8","style":"dotted","width":"1px"}},"spacing":{"padding":{"top":"var:preset|spacing|40"},"margin":{"top":"var:preset|spacing|40","bottom":"0"},"blockGap":"0"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"stretch"}} -->
<div class="wp-block-group" style="border-top-color:var(--wp--preset--color--global-color-8);border-top-style:dotted;border-top-width:1px;margin-top:var(--wp--preset--spacing--40);margin-bottom:0;padding-top:var(--wp--preset--spacing--40)"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","fontSize":"14px","letterSpacing":"0.1em"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|20"}}},"textColor":"global_color_4"} -->
<p class="has-global-color-4-color has-text-color" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--20);font-size:14px;font-style:normal;font-weight:700;letter-spacing:0.1em;text-transform:uppercase">Features</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|40"}}},"textColor":"global_color_5"} -->
<p class="has-global-color-5-color has-text-color" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--40)">Everything in Growth, plus:</p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20","margin":{"top":"0","bottom":"var:preset|spacing|30"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30)"><!-- wp:group {"style":{"border":{"radius":"999px"},"dimensions":{"minHeight":"22px"},"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"blockGap":"0","margin":{"top":"0","bottom":"0"}},"layout":{"selfStretch":"fixed","flexSize":"22px"},"typography":{"lineHeight":"0"}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-radius:999px;min-height:22px;margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;line-height:0"><!-- wp:image {"width":"14px","height":"14px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 20 20%27 fill=%27%23ffffff%27%3E%3Cpath fill-rule=%27evenodd%27 d=%27M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z%27 clip-rule=%27evenodd%27 /%3E%3C/svg%3E" alt="Included" style="width:14px;height:14px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0">Unlimited team members</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20","margin":{"top":"0","bottom":"var:preset|spacing|30"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30)"><!-- wp:group {"style":{"border":{"radius":"999px"},"dimensions":{"minHeight":"22px"},"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"blockGap":"0","margin":{"top":"0","bottom":"0"}},"layout":{"selfStretch":"fixed","flexSize":"22px"},"typography":{"lineHeight":"0"}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-radius:999px;min-height:22px;margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;line-height:0"><!-- wp:image {"width":"14px","height":"14px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 20 20%27 fill=%27%23ffffff%27%3E%3Cpath fill-rule=%27evenodd%27 d=%27M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z%27 clip-rule=%27evenodd%27 /%3E%3C/svg%3E" alt="Included" style="width:14px;height:14px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0">Unlimited storage</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20","margin":{"top":"0","bottom":"var:preset|spacing|30"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30)"><!-- wp:group {"style":{"border":{"radius":"999px"},"dimensions":{"minHeight":"22px"},"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"blockGap":"0","margin":{"top":"0","bottom":"0"}},"layout":{"selfStretch":"fixed","flexSize":"22px"},"typography":{"lineHeight":"0"}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-radius:999px;min-height:22px;margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;line-height:0"><!-- wp:image {"width":"14px","height":"14px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 20 20%27 fill=%27%23ffffff%27%3E%3Cpath fill-rule=%27evenodd%27 d=%27M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z%27 clip-rule=%27evenodd%27 /%3E%3C/svg%3E" alt="Included" style="width:14px;height:14px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0">Custom reporting dashboards</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20","margin":{"top":"0","bottom":"var:preset|spacing|30"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30)"><!-- wp:group {"style":{"border":{"radius":"999px"},"dimensions":{"minHeight":"22px"},"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"blockGap":"0","margin":{"top":"0","bottom":"0"}},"layout":{"selfStretch":"fixed","flexSize":"22px"},"typography":{"lineHeight":"0"}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-radius:999px;min-height:22px;margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;line-height:0"><!-- wp:image {"width":"14px","height":"14px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 20 20%27 fill=%27%23ffffff%27%3E%3Cpath fill-rule=%27evenodd%27 d=%27M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z%27 clip-rule=%27evenodd%27 /%3E%3C/svg%3E" alt="Included" style="width:14px;height:14px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0">Dedicated account manager</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:group {"style":{"border":{"radius":"999px"},"dimensions":{"minHeight":"22px"},"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"blockGap":"0","margin":{"top":"0","bottom":"0"}},"layout":{"selfStretch":"fixed","flexSize":"22px"},"typography":{"lineHeight":"0"}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-radius:999px;min-height:22px;margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;line-height:0"><!-- wp:image {"width":"14px","height":"14px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 20 20%27 fill=%27%23ffffff%27%3E%3Cpath fill-rule=%27evenodd%27 d=%27M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z%27 clip-rule=%27evenodd%27 /%3E%3C/svg%3E" alt="Included" style="width:14px;height:14px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0">Team training sessions</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->',
	),

	// Pricing 4: a pitch with trust points beside one featured plan card.
	array(
		'name'       => 'sydney-pro/pricing-2',
		'title'      => __( 'Pricing 4', 'sydney' ),
		'categories' => array( 'sydney-pricing' ),
		'keywords'   => array( 'pricing', 'plan', 'featured', 'split' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_9","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-9-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)"><!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|50","left":"var:preset|spacing|60"},"margin":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center" style="margin-top:0;margin-bottom:0"><!-- wp:column {"verticalAlignment":"center","width":"50%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%"><!-- wp:heading {"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}}}} -->
<h2 class="wp-block-heading" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30)">One plan with everything your team needs</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|40"}}}} -->
<p style="margin-top:0;margin-bottom:var(--wp--preset--spacing--40);font-size:18px">No setup fees and no hidden costs. Try it free for 14 days, then pay one simple monthly price.</p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20","margin":{"top":"0","bottom":"var:preset|spacing|30"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30)"><!-- wp:group {"style":{"border":{"radius":"999px"},"dimensions":{"minHeight":"22px"},"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"blockGap":"0","margin":{"top":"0","bottom":"0"}},"layout":{"selfStretch":"fixed","flexSize":"22px"},"typography":{"lineHeight":"0"}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-radius:999px;min-height:22px;margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;line-height:0"><!-- wp:image {"width":"14px","height":"14px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 20 20%27 fill=%27%23ffffff%27%3E%3Cpath fill-rule=%27evenodd%27 d=%27M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z%27 clip-rule=%27evenodd%27 /%3E%3C/svg%3E" alt="Included" style="width:14px;height:14px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0">14-day free trial, no card required</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20","margin":{"top":"0","bottom":"var:preset|spacing|30"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--30)"><!-- wp:group {"style":{"border":{"radius":"999px"},"dimensions":{"minHeight":"22px"},"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"blockGap":"0","margin":{"top":"0","bottom":"0"}},"layout":{"selfStretch":"fixed","flexSize":"22px"},"typography":{"lineHeight":"0"}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-radius:999px;min-height:22px;margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;line-height:0"><!-- wp:image {"width":"14px","height":"14px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 20 20%27 fill=%27%23ffffff%27%3E%3Cpath fill-rule=%27evenodd%27 d=%27M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z%27 clip-rule=%27evenodd%27 /%3E%3C/svg%3E" alt="Included" style="width:14px;height:14px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0">Change or cancel your plan anytime</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:group {"style":{"border":{"radius":"999px"},"dimensions":{"minHeight":"22px"},"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"blockGap":"0","margin":{"top":"0","bottom":"0"}},"layout":{"selfStretch":"fixed","flexSize":"22px"},"typography":{"lineHeight":"0"}},"backgroundColor":"global_color_1","layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group has-global-color-1-background-color has-background" style="border-radius:999px;min-height:22px;margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;line-height:0"><!-- wp:image {"width":"14px","height":"14px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 20 20%27 fill=%27%23ffffff%27%3E%3Cpath fill-rule=%27evenodd%27 d=%27M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z%27 clip-rule=%27evenodd%27 /%3E%3C/svg%3E" alt="Included" style="width:14px;height:14px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0">Help from real people, 7 days a week</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"50%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%"><!-- wp:group {"style":{"border":{"radius":"16px","width":"1px"},"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"},"blockGap":"0"}},"backgroundColor":"global_color_7","borderColor":"global_color_8","layout":{"type":"flex","orientation":"vertical","justifyContent":"stretch"}} -->
<div class="wp-block-group has-border-color has-global-color-8-border-color has-global-color-7-background-color has-background" style="border-width:1px;border-radius:16px;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)"><!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<h4 class="wp-block-heading" style="margin-top:0;margin-bottom:0">Team plan</h4>
<!-- /wp:heading -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"},"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"bottom"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0"><!-- wp:paragraph {"style":{"typography":{"fontSize":"48px","fontStyle":"normal","fontWeight":"700","lineHeight":"1"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"global_color_4"} -->
<p class="has-global-color-4-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:48px;font-style:normal;font-weight:700;line-height:1">$49</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0","bottom":"4px"}}},"textColor":"global_color_5"} -->
<p class="has-global-color-5-color has-text-color" style="margin-top:0;margin-bottom:4px;font-size:14px">per month</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}}},"textColor":"global_color_5"} -->
<p class="has-global-color-5-color has-text-color" style="margin-top:var(--wp--preset--spacing--20);margin-bottom:0;font-size:14px">Billed yearly, or $59 billed monthly.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"0"}}}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:0"><!-- wp:button {"width":100} -->
<div class="wp-block-button has-custom-width wp-block-button__width-100"><a class="wp-block-button__link wp-element-button" href="#">Start free trial</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->',
	),

	// Pricing 5: a two-column price list of services and packages.
	array(
		'name'       => 'sydney-pro/pricing-3',
		'title'      => __( 'Pricing 5', 'sydney' ),
		'categories' => array( 'sydney-pricing' ),
		'keywords'   => array( 'pricing', 'price list', 'services', 'menu' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_9","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-9-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)"><!-- wp:group {"layout":{"type":"constrained","contentSize":"768px"}} -->
<div class="wp-block-group"><!-- wp:heading {"textAlign":"center","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<h2 class="wp-block-heading has-text-align-center" style="margin-top:0;margin-bottom:0">Services and prices</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"18px"},"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}}}} -->
<p class="has-text-align-center" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0;font-size:18px">Clear prices for every service. Book online or call us to find the right option for you.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|50","left":"var:preset|spacing|60"},"margin":{"top":"var:preset|spacing|60","bottom":"0"}}}} -->
<div class="wp-block-columns alignwide" style="margin-top:var(--wp--preset--spacing--60);margin-bottom:0"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|40"}}}} -->
<h4 class="wp-block-heading" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--40)">Sessions</h4>
<!-- /wp:heading -->

<!-- wp:group {"style":{"border":{"bottom":{"color":"var:preset|color|global_color_8","style":"dotted","width":"1px"}},"spacing":{"padding":{"bottom":"var:preset|spacing|30"},"margin":{"top":"0","bottom":"var:preset|spacing|30"}}}} -->
<div class="wp-block-group" style="border-bottom-color:var(--wp--preset--color--global-color-8);border-bottom-style:dotted;border-bottom-width:1px;margin-top:0;margin-bottom:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30)"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between","verticalAlignment":"top"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:paragraph {"style":{"typography":{"fontSize":"18px","fontStyle":"normal","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"global_color_4"} -->
<p class="has-global-color-4-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:18px;font-style:normal;font-weight:600">Initial consultation</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"18px","fontStyle":"normal","fontWeight":"700"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"global_color_1"} -->
<p class="has-global-color-1-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:18px;font-style:normal;font-weight:700">$40</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"15px"},"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}}},"textColor":"global_color_5"} -->
<p class="has-global-color-5-color has-text-color" style="margin-top:var(--wp--preset--spacing--20);margin-bottom:0;font-size:15px">A 30-minute meeting to understand your needs and goals.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"border":{"bottom":{"color":"var:preset|color|global_color_8","style":"dotted","width":"1px"}},"spacing":{"padding":{"bottom":"var:preset|spacing|30"},"margin":{"top":"0","bottom":"var:preset|spacing|30"}}}} -->
<div class="wp-block-group" style="border-bottom-color:var(--wp--preset--color--global-color-8);border-bottom-style:dotted;border-bottom-width:1px;margin-top:0;margin-bottom:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30)"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between","verticalAlignment":"top"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:paragraph {"style":{"typography":{"fontSize":"18px","fontStyle":"normal","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"global_color_4"} -->
<p class="has-global-color-4-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:18px;font-style:normal;font-weight:600">Standard session</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"18px","fontStyle":"normal","fontWeight":"700"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"global_color_1"} -->
<p class="has-global-color-1-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:18px;font-style:normal;font-weight:700">$65</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"15px"},"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}}},"textColor":"global_color_5"} -->
<p class="has-global-color-5-color has-text-color" style="margin-top:var(--wp--preset--spacing--20);margin-bottom:0;font-size:15px">Our most booked option: one hour with a specialist.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"border":{"bottom":{"color":"var:preset|color|global_color_8","style":"dotted","width":"1px"}},"spacing":{"padding":{"bottom":"var:preset|spacing|30"},"margin":{"top":"0","bottom":"var:preset|spacing|30"}}}} -->
<div class="wp-block-group" style="border-bottom-color:var(--wp--preset--color--global-color-8);border-bottom-style:dotted;border-bottom-width:1px;margin-top:0;margin-bottom:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30)"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between","verticalAlignment":"top"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:paragraph {"style":{"typography":{"fontSize":"18px","fontStyle":"normal","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"global_color_4"} -->
<p class="has-global-color-4-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:18px;font-style:normal;font-weight:600">Extended session</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"18px","fontStyle":"normal","fontWeight":"700"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"global_color_1"} -->
<p class="has-global-color-1-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:18px;font-style:normal;font-weight:700">$90</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"15px"},"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}}},"textColor":"global_color_5"} -->
<p class="has-global-color-5-color has-text-color" style="margin-top:var(--wp--preset--spacing--20);margin-bottom:0;font-size:15px">Ninety minutes for more detailed or complex work.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between","verticalAlignment":"top"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:paragraph {"style":{"typography":{"fontSize":"18px","fontStyle":"normal","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"global_color_4"} -->
<p class="has-global-color-4-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:18px;font-style:normal;font-weight:600">Follow-up visit</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"18px","fontStyle":"normal","fontWeight":"700"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"global_color_1"} -->
<p class="has-global-color-1-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:18px;font-style:normal;font-weight:700">$35</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"15px"},"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}}},"textColor":"global_color_5"} -->
<p class="has-global-color-5-color has-text-color" style="margin-top:var(--wp--preset--spacing--20);margin-bottom:0;font-size:15px">A short check-in within four weeks of your last session.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|40"}}}} -->
<h4 class="wp-block-heading" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--40)">Packages</h4>
<!-- /wp:heading -->

<!-- wp:group {"style":{"border":{"bottom":{"color":"var:preset|color|global_color_8","style":"dotted","width":"1px"}},"spacing":{"padding":{"bottom":"var:preset|spacing|30"},"margin":{"top":"0","bottom":"var:preset|spacing|30"}}}} -->
<div class="wp-block-group" style="border-bottom-color:var(--wp--preset--color--global-color-8);border-bottom-style:dotted;border-bottom-width:1px;margin-top:0;margin-bottom:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30)"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between","verticalAlignment":"top"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:paragraph {"style":{"typography":{"fontSize":"18px","fontStyle":"normal","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"global_color_4"} -->
<p class="has-global-color-4-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:18px;font-style:normal;font-weight:600">Starter package</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"18px","fontStyle":"normal","fontWeight":"700"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"global_color_1"} -->
<p class="has-global-color-1-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:18px;font-style:normal;font-weight:700">$180</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"15px"},"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}}},"textColor":"global_color_5"} -->
<p class="has-global-color-5-color has-text-color" style="margin-top:var(--wp--preset--spacing--20);margin-bottom:0;font-size:15px">Three standard sessions, booked whenever suits you.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"border":{"bottom":{"color":"var:preset|color|global_color_8","style":"dotted","width":"1px"}},"spacing":{"padding":{"bottom":"var:preset|spacing|30"},"margin":{"top":"0","bottom":"var:preset|spacing|30"}}}} -->
<div class="wp-block-group" style="border-bottom-color:var(--wp--preset--color--global-color-8);border-bottom-style:dotted;border-bottom-width:1px;margin-top:0;margin-bottom:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30)"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between","verticalAlignment":"top"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:paragraph {"style":{"typography":{"fontSize":"18px","fontStyle":"normal","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"global_color_4"} -->
<p class="has-global-color-4-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:18px;font-style:normal;font-weight:600">Monthly membership</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"18px","fontStyle":"normal","fontWeight":"700"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"global_color_1"} -->
<p class="has-global-color-1-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:18px;font-style:normal;font-weight:700">$220</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"15px"},"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}}},"textColor":"global_color_5"} -->
<p class="has-global-color-5-color has-text-color" style="margin-top:var(--wp--preset--spacing--20);margin-bottom:0;font-size:15px">Four sessions a month with priority booking.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"border":{"bottom":{"color":"var:preset|color|global_color_8","style":"dotted","width":"1px"}},"spacing":{"padding":{"bottom":"var:preset|spacing|30"},"margin":{"top":"0","bottom":"var:preset|spacing|30"}}}} -->
<div class="wp-block-group" style="border-bottom-color:var(--wp--preset--color--global-color-8);border-bottom-style:dotted;border-bottom-width:1px;margin-top:0;margin-bottom:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30)"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between","verticalAlignment":"top"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:paragraph {"style":{"typography":{"fontSize":"18px","fontStyle":"normal","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"global_color_4"} -->
<p class="has-global-color-4-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:18px;font-style:normal;font-weight:600">Premium package</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"18px","fontStyle":"normal","fontWeight":"700"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"global_color_1"} -->
<p class="has-global-color-1-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:18px;font-style:normal;font-weight:700">$550</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"15px"},"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}}},"textColor":"global_color_5"} -->
<p class="has-global-color-5-color has-text-color" style="margin-top:var(--wp--preset--spacing--20);margin-bottom:0;font-size:15px">Ten sessions plus a personal plan and progress reviews.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between","verticalAlignment":"top"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:paragraph {"style":{"typography":{"fontSize":"18px","fontStyle":"normal","fontWeight":"600"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"global_color_4"} -->
<p class="has-global-color-4-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:18px;font-style:normal;font-weight:600">Gift card</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"18px","fontStyle":"normal","fontWeight":"700"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"global_color_1"} -->
<p class="has-global-color-1-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:18px;font-style:normal;font-weight:700">From $50</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"15px"},"spacing":{"margin":{"top":"var:preset|spacing|20","bottom":"0"}}},"textColor":"global_color_5"} -->
<p class="has-global-color-5-color has-text-color" style="margin-top:var(--wp--preset--spacing--20);margin-bottom:0;font-size:15px">Any amount, valid for twelve months on every service.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->',
	),

	// Pricing 6: three plans with the name, price and button in a grey box and a checked feature list below it.
	array(
		'name'       => 'sydney-pro/pricing-4',
		'title'      => __( 'Pricing 6', 'sydney' ),
		'categories' => array( 'sydney-pricing' ),
		'keywords'   => array( 'pricing', 'plans', 'tiers', 'features' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_9","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-9-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)"><!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|30","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"grid","columnCount":null,"minimumColumnWidth":"18rem"}} -->
<div class="wp-block-group alignwide" style="margin-top:0;margin-bottom:0"><!-- wp:group {"style":{"spacing":{"blockGap":"0","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"stretch"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:group {"style":{"border":{"radius":"16px"},"dimensions":{"minHeight":"340px"},"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"blockGap":"0","margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_7","layout":{"type":"flex","orientation":"vertical","justifyContent":"stretch","verticalAlignment":"space-between"}} -->
<div class="wp-block-group has-global-color-7-background-color has-background" style="border-radius:16px;min-height:340px;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|20"}}}} -->
<h4 class="wp-block-heading" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--20)">Starter</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"global_color_5"} -->
<p class="has-global-color-5-color has-text-color" style="margin-top:0;margin-bottom:0">For your first website</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50","bottom":"0"}}}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--50);margin-bottom:0"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"},"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"bottom"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:paragraph {"style":{"typography":{"fontSize":"48px","fontStyle":"normal","fontWeight":"700","lineHeight":"1"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"global_color_4"} -->
<p class="has-global-color-4-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:48px;font-style:normal;font-weight:700;line-height:1">$12</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"16px"},"spacing":{"margin":{"top":"0","bottom":"4px"}}},"textColor":"global_color_5"} -->
<p class="has-global-color-5-color has-text-color" style="margin-top:0;margin-bottom:4px;font-size:16px">/ month</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"0"}}}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:0"><!-- wp:button {"width":100} -->
<div class="wp-block-button has-custom-width wp-block-button__width-100"><a class="wp-block-button__link wp-element-button" href="#">Get started</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"},"padding":{"left":"var:preset|spacing|20","right":"var:preset|spacing|20"}}}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0;padding-right:var(--wp--preset--spacing--20);padding-left:var(--wp--preset--spacing--20)"><!-- wp:group {"style":{"border":{"bottom":{"color":"var:preset|color|global_color_8","style":"dashed","width":"1px"}},"spacing":{"blockGap":"var:preset|spacing|20","padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="border-bottom-color:var(--wp--preset--color--global-color-8);border-bottom-style:dashed;border-bottom-width:1px;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30)"><!-- wp:group {"style":{"dimensions":{"minHeight":"16px"},"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"blockGap":"0","margin":{"top":"0","bottom":"0"}},"layout":{"selfStretch":"fixed","flexSize":"16px"},"typography":{"lineHeight":"0"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="min-height:16px;margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;line-height:0"><!-- wp:image {"width":"16px","height":"16px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"duotone":["#000000","#000000"]}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 20 20%27 fill=%27%23333333%27%3E%3Cpath fill-rule=%27evenodd%27 d=%27M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z%27 clip-rule=%27evenodd%27 /%3E%3C/svg%3E" alt="Included" style="width:16px;height:16px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0">1 website</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"border":{"bottom":{"color":"var:preset|color|global_color_8","style":"dashed","width":"1px"}},"spacing":{"blockGap":"var:preset|spacing|20","padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="border-bottom-color:var(--wp--preset--color--global-color-8);border-bottom-style:dashed;border-bottom-width:1px;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30)"><!-- wp:group {"style":{"dimensions":{"minHeight":"16px"},"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"blockGap":"0","margin":{"top":"0","bottom":"0"}},"layout":{"selfStretch":"fixed","flexSize":"16px"},"typography":{"lineHeight":"0"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="min-height:16px;margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;line-height:0"><!-- wp:image {"width":"16px","height":"16px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"duotone":["#000000","#000000"]}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 20 20%27 fill=%27%23333333%27%3E%3Cpath fill-rule=%27evenodd%27 d=%27M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z%27 clip-rule=%27evenodd%27 /%3E%3C/svg%3E" alt="Included" style="width:16px;height:16px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0">5 GB storage</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"border":{"bottom":{"color":"var:preset|color|global_color_8","style":"dashed","width":"1px"}},"spacing":{"blockGap":"var:preset|spacing|20","padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="border-bottom-color:var(--wp--preset--color--global-color-8);border-bottom-style:dashed;border-bottom-width:1px;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30)"><!-- wp:group {"style":{"dimensions":{"minHeight":"16px"},"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"blockGap":"0","margin":{"top":"0","bottom":"0"}},"layout":{"selfStretch":"fixed","flexSize":"16px"},"typography":{"lineHeight":"0"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="min-height:16px;margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;line-height:0"><!-- wp:image {"width":"16px","height":"16px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"duotone":["#000000","#000000"]}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 20 20%27 fill=%27%23333333%27%3E%3Cpath fill-rule=%27evenodd%27 d=%27M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z%27 clip-rule=%27evenodd%27 /%3E%3C/svg%3E" alt="Included" style="width:16px;height:16px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0">Free SSL certificate</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20","padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30)"><!-- wp:group {"style":{"dimensions":{"minHeight":"16px"},"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"blockGap":"0","margin":{"top":"0","bottom":"0"}},"layout":{"selfStretch":"fixed","flexSize":"16px"},"typography":{"lineHeight":"0"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="min-height:16px;margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;line-height:0"><!-- wp:image {"width":"16px","height":"16px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"duotone":["#000000","#000000"]}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 20 20%27 fill=%27%23333333%27%3E%3Cpath fill-rule=%27evenodd%27 d=%27M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z%27 clip-rule=%27evenodd%27 /%3E%3C/svg%3E" alt="Included" style="width:16px;height:16px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0">Email support</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"stretch"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:group {"style":{"border":{"radius":"16px"},"dimensions":{"minHeight":"340px"},"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"blockGap":"0","margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_7","layout":{"type":"flex","orientation":"vertical","justifyContent":"stretch","verticalAlignment":"space-between"}} -->
<div class="wp-block-group has-global-color-7-background-color has-background" style="border-radius:16px;min-height:340px;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|20"}}}} -->
<h4 class="wp-block-heading" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--20)">Team</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"global_color_5"} -->
<p class="has-global-color-5-color has-text-color" style="margin-top:0;margin-bottom:0">For small teams that grow</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50","bottom":"0"}}}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--50);margin-bottom:0"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"},"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"bottom"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:paragraph {"style":{"typography":{"fontSize":"48px","fontStyle":"normal","fontWeight":"700","lineHeight":"1"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"global_color_4"} -->
<p class="has-global-color-4-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:48px;font-style:normal;font-weight:700;line-height:1">$29</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"16px"},"spacing":{"margin":{"top":"0","bottom":"4px"}}},"textColor":"global_color_5"} -->
<p class="has-global-color-5-color has-text-color" style="margin-top:0;margin-bottom:4px;font-size:16px">/ month</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"0"}}}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:0"><!-- wp:button {"width":100} -->
<div class="wp-block-button has-custom-width wp-block-button__width-100"><a class="wp-block-button__link wp-element-button" href="#">Get started</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"},"padding":{"left":"var:preset|spacing|20","right":"var:preset|spacing|20"}}}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0;padding-right:var(--wp--preset--spacing--20);padding-left:var(--wp--preset--spacing--20)"><!-- wp:group {"style":{"border":{"bottom":{"color":"var:preset|color|global_color_8","style":"dashed","width":"1px"}},"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"},"margin":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-group" style="border-bottom-color:var(--wp--preset--color--global-color-8);border-bottom-style:dashed;border-bottom-width:1px;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30)"><!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"global_color_5"} -->
<p class="has-global-color-5-color has-text-color" style="margin-top:0;margin-bottom:0">Everything in Starter, plus:</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"border":{"bottom":{"color":"var:preset|color|global_color_8","style":"dashed","width":"1px"}},"spacing":{"blockGap":"var:preset|spacing|20","padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="border-bottom-color:var(--wp--preset--color--global-color-8);border-bottom-style:dashed;border-bottom-width:1px;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30)"><!-- wp:group {"style":{"dimensions":{"minHeight":"16px"},"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"blockGap":"0","margin":{"top":"0","bottom":"0"}},"layout":{"selfStretch":"fixed","flexSize":"16px"},"typography":{"lineHeight":"0"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="min-height:16px;margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;line-height:0"><!-- wp:image {"width":"16px","height":"16px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"duotone":["#000000","#000000"]}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 20 20%27 fill=%27%23333333%27%3E%3Cpath fill-rule=%27evenodd%27 d=%27M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z%27 clip-rule=%27evenodd%27 /%3E%3C/svg%3E" alt="Included" style="width:16px;height:16px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0">5 websites</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"border":{"bottom":{"color":"var:preset|color|global_color_8","style":"dashed","width":"1px"}},"spacing":{"blockGap":"var:preset|spacing|20","padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="border-bottom-color:var(--wp--preset--color--global-color-8);border-bottom-style:dashed;border-bottom-width:1px;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30)"><!-- wp:group {"style":{"dimensions":{"minHeight":"16px"},"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"blockGap":"0","margin":{"top":"0","bottom":"0"}},"layout":{"selfStretch":"fixed","flexSize":"16px"},"typography":{"lineHeight":"0"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="min-height:16px;margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;line-height:0"><!-- wp:image {"width":"16px","height":"16px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"duotone":["#000000","#000000"]}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 20 20%27 fill=%27%23333333%27%3E%3Cpath fill-rule=%27evenodd%27 d=%27M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z%27 clip-rule=%27evenodd%27 /%3E%3C/svg%3E" alt="Included" style="width:16px;height:16px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0">50 GB storage</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"border":{"bottom":{"color":"var:preset|color|global_color_8","style":"dashed","width":"1px"}},"spacing":{"blockGap":"var:preset|spacing|20","padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="border-bottom-color:var(--wp--preset--color--global-color-8);border-bottom-style:dashed;border-bottom-width:1px;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30)"><!-- wp:group {"style":{"dimensions":{"minHeight":"16px"},"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"blockGap":"0","margin":{"top":"0","bottom":"0"}},"layout":{"selfStretch":"fixed","flexSize":"16px"},"typography":{"lineHeight":"0"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="min-height:16px;margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;line-height:0"><!-- wp:image {"width":"16px","height":"16px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"duotone":["#000000","#000000"]}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 20 20%27 fill=%27%23333333%27%3E%3Cpath fill-rule=%27evenodd%27 d=%27M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z%27 clip-rule=%27evenodd%27 /%3E%3C/svg%3E" alt="Included" style="width:16px;height:16px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0">Team roles and permissions</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20","padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30)"><!-- wp:group {"style":{"dimensions":{"minHeight":"16px"},"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"blockGap":"0","margin":{"top":"0","bottom":"0"}},"layout":{"selfStretch":"fixed","flexSize":"16px"},"typography":{"lineHeight":"0"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="min-height:16px;margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;line-height:0"><!-- wp:image {"width":"16px","height":"16px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"duotone":["#000000","#000000"]}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 20 20%27 fill=%27%23333333%27%3E%3Cpath fill-rule=%27evenodd%27 d=%27M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z%27 clip-rule=%27evenodd%27 /%3E%3C/svg%3E" alt="Included" style="width:16px;height:16px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0">Priority chat support</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"0","margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"stretch"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:group {"style":{"border":{"radius":"16px"},"dimensions":{"minHeight":"340px"},"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"blockGap":"0","margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_7","layout":{"type":"flex","orientation":"vertical","justifyContent":"stretch","verticalAlignment":"space-between"}} -->
<div class="wp-block-group has-global-color-7-background-color has-background" style="border-radius:16px;min-height:340px;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|20"}}}} -->
<h4 class="wp-block-heading" style="margin-top:0;margin-bottom:var(--wp--preset--spacing--20)">Business</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"global_color_5"} -->
<p class="has-global-color-5-color has-text-color" style="margin-top:0;margin-bottom:0">For companies at scale</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50","bottom":"0"}}}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--50);margin-bottom:0"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"},"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"bottom"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:paragraph {"style":{"typography":{"fontSize":"48px","fontStyle":"normal","fontWeight":"700","lineHeight":"1"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"global_color_4"} -->
<p class="has-global-color-4-color has-text-color" style="margin-top:0;margin-bottom:0;font-size:48px;font-style:normal;font-weight:700;line-height:1">$59</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"16px"},"spacing":{"margin":{"top":"0","bottom":"4px"}}},"textColor":"global_color_5"} -->
<p class="has-global-color-5-color has-text-color" style="margin-top:0;margin-bottom:4px;font-size:16px">/ month</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"0"}}}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:0"><!-- wp:button {"width":100} -->
<div class="wp-block-button has-custom-width wp-block-button__width-100"><a class="wp-block-button__link wp-element-button" href="#">Get started</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"},"padding":{"left":"var:preset|spacing|20","right":"var:preset|spacing|20"}}}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0;padding-right:var(--wp--preset--spacing--20);padding-left:var(--wp--preset--spacing--20)"><!-- wp:group {"style":{"border":{"bottom":{"color":"var:preset|color|global_color_8","style":"dashed","width":"1px"}},"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"},"margin":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-group" style="border-bottom-color:var(--wp--preset--color--global-color-8);border-bottom-style:dashed;border-bottom-width:1px;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30)"><!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"textColor":"global_color_5"} -->
<p class="has-global-color-5-color has-text-color" style="margin-top:0;margin-bottom:0">Everything in Team, plus:</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"border":{"bottom":{"color":"var:preset|color|global_color_8","style":"dashed","width":"1px"}},"spacing":{"blockGap":"var:preset|spacing|20","padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="border-bottom-color:var(--wp--preset--color--global-color-8);border-bottom-style:dashed;border-bottom-width:1px;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30)"><!-- wp:group {"style":{"dimensions":{"minHeight":"16px"},"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"blockGap":"0","margin":{"top":"0","bottom":"0"}},"layout":{"selfStretch":"fixed","flexSize":"16px"},"typography":{"lineHeight":"0"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="min-height:16px;margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;line-height:0"><!-- wp:image {"width":"16px","height":"16px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"duotone":["#000000","#000000"]}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 20 20%27 fill=%27%23333333%27%3E%3Cpath fill-rule=%27evenodd%27 d=%27M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z%27 clip-rule=%27evenodd%27 /%3E%3C/svg%3E" alt="Included" style="width:16px;height:16px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0">Unlimited websites</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"border":{"bottom":{"color":"var:preset|color|global_color_8","style":"dashed","width":"1px"}},"spacing":{"blockGap":"var:preset|spacing|20","padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="border-bottom-color:var(--wp--preset--color--global-color-8);border-bottom-style:dashed;border-bottom-width:1px;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30)"><!-- wp:group {"style":{"dimensions":{"minHeight":"16px"},"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"blockGap":"0","margin":{"top":"0","bottom":"0"}},"layout":{"selfStretch":"fixed","flexSize":"16px"},"typography":{"lineHeight":"0"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="min-height:16px;margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;line-height:0"><!-- wp:image {"width":"16px","height":"16px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"duotone":["#000000","#000000"]}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 20 20%27 fill=%27%23333333%27%3E%3Cpath fill-rule=%27evenodd%27 d=%27M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z%27 clip-rule=%27evenodd%27 /%3E%3C/svg%3E" alt="Included" style="width:16px;height:16px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0">500 GB storage</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"border":{"bottom":{"color":"var:preset|color|global_color_8","style":"dashed","width":"1px"}},"spacing":{"blockGap":"var:preset|spacing|20","padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="border-bottom-color:var(--wp--preset--color--global-color-8);border-bottom-style:dashed;border-bottom-width:1px;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30)"><!-- wp:group {"style":{"dimensions":{"minHeight":"16px"},"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"blockGap":"0","margin":{"top":"0","bottom":"0"}},"layout":{"selfStretch":"fixed","flexSize":"16px"},"typography":{"lineHeight":"0"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="min-height:16px;margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;line-height:0"><!-- wp:image {"width":"16px","height":"16px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"duotone":["#000000","#000000"]}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 20 20%27 fill=%27%23333333%27%3E%3Cpath fill-rule=%27evenodd%27 d=%27M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z%27 clip-rule=%27evenodd%27 /%3E%3C/svg%3E" alt="Included" style="width:16px;height:16px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0">Daily backups</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20","padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30)"><!-- wp:group {"style":{"dimensions":{"minHeight":"16px"},"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"blockGap":"0","margin":{"top":"0","bottom":"0"}},"layout":{"selfStretch":"fixed","flexSize":"16px"},"typography":{"lineHeight":"0"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="min-height:16px;margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;line-height:0"><!-- wp:image {"width":"16px","height":"16px","sizeSlug":"full","linkDestination":"none","className":"is-resized","style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"duotone":["#000000","#000000"]}}} -->
<figure class="wp-block-image size-full is-resized" style="margin-top:0;margin-bottom:0"><img src="data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 20 20%27 fill=%27%23333333%27%3E%3Cpath fill-rule=%27evenodd%27 d=%27M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z%27 clip-rule=%27evenodd%27 /%3E%3C/svg%3E" alt="Included" style="width:16px;height:16px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<p style="margin-top:0;margin-bottom:0">Dedicated account manager</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->',
	),
);
