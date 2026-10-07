<?php
/**
 * Footer Builder
 * Copyright/credits Component
 * 
 * @package Sydney_Pro
 */ 

// @codingStandardsIgnoreStart WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound ?>

<div class="shfb-builder-item shfb-component-copyright" data-component-id="copyright">
    <?php $this->customizer_edit_button(); 
    $credits 	= get_theme_mod( 'footer_credits', sydney_get_footer_credits_default() );

    $tags 		= array( '{theme_author}', '{site_title}', '{copyright}', '{year}' );
    $replace 	= array( sydney_get_theme_author_link(), get_bloginfo( 'name' ), '&copy;', date('Y') );

    $credits 	= str_replace( $tags, $replace, $credits ); ?>
    <div class="sydney-credits">
        <?php echo apply_filters( 'sydney_footer_builder_copyright_component_output', $credits ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
    </div>
</div>

<?php
// @codingStandardsIgnoreEnd WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound