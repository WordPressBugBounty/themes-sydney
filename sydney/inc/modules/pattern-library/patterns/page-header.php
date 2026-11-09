<?php
/**
 * Page Header patterns
 *
 * @package Sydney
 */

// Page Header 1: the page title centered over a short intro.
register_block_pattern(
	'sydney/page-header-1',
	array(
		'title'      => __( 'Page Header 1', 'sydney' ),
		'categories' => array( 'sydney-page-header' ),
		'keywords'   => array( 'page header', 'title', 'intro', 'centered' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_9","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-9-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:group {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"640px"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0"><!-- wp:post-title {"textAlign":"center","level":1,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}}}} /-->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"var:preset|color|global_color_5"}}} -->
<p class="has-text-align-center has-text-color" style="color:var(--wp--preset--color--global-color-5);margin-top:0;margin-bottom:0">Everything you need to know, gathered in one place. Take a look around and get in touch if a question comes up.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->',
	)
);

// Page Header 2: the page title and a short intro side by side over a thin bottom border.
register_block_pattern(
	'sydney/page-header-2',
	array(
		'title'      => __( 'Page Header 2', 'sydney' ),
		'categories' => array( 'sydney-page-header' ),
		'keywords'   => array( 'page header', 'title', 'intro', 'columns' ),
		'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"},"margin":{"top":"0","bottom":"0"}},"border":{"bottom":{"color":"var:preset|color|global_color_8","width":"1px"}}},"backgroundColor":"global_color_9","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-9-background-color has-background" style="border-bottom-color:var(--wp--preset--color--global-color-8);border-bottom-width:1px;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:columns {"verticalAlignment":"bottom","align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|30","left":"var:preset|spacing|60"},"margin":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-bottom" style="margin-top:0;margin-bottom:0"><!-- wp:column {"verticalAlignment":"bottom","width":"50%"} -->
<div class="wp-block-column is-vertically-aligned-bottom" style="flex-basis:50%"><!-- wp:post-title {"level":1,"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} /--></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"bottom","width":"50%"} -->
<div class="wp-block-column is-vertically-aligned-bottom" style="flex-basis:50%"><!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"var:preset|color|global_color_5"}}} -->
<p class="has-text-color" style="color:var(--wp--preset--color--global-color-5);margin-top:0;margin-bottom:0">We help growing businesses plan, build and run the work that matters most to them, with a team that stays close from the first call to the final result.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->',
	)
);

// Page Header 3: breadcrumbs above a left-aligned page title and intro, registered only where WordPress ships the Breadcrumbs block (7.0 and later).
if ( function_exists( 'render_block_core_breadcrumbs' ) ) {
	register_block_pattern(
		'sydney/page-header-3',
		array(
			'title'      => __( 'Page Header 3', 'sydney' ),
			'categories' => array( 'sydney-page-header' ),
			'keywords'   => array( 'page header', 'title', 'intro', 'breadcrumbs' ),
			'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"global_color_9","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-global-color-9-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"740px","justifyContent":"left"}} -->
<div class="wp-block-group alignwide" style="margin-top:0;margin-bottom:0"><!-- wp:breadcrumbs {"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}}}} /-->

<!-- wp:post-title {"level":1,"style":{"spacing":{"margin":{"top":"0","bottom":"var:preset|spacing|30"}}}} /-->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}},"color":{"text":"var:preset|color|global_color_5"}}} -->
<p class="has-text-color" style="color:var(--wp--preset--color--global-color-5);margin-top:0;margin-bottom:0">Find the details you came for below, or reach out to our team for a quick answer.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->',
		)
	);
}
