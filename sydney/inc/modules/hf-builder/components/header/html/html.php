<?php
/**
 * Header/Footer Builder
 * HTML Component
 * 
 * @package Sydney_Pro
 */ 

/**
 * Filters the setting id behind the header builder's HTML component.
 *
 * The two editions store this content under different ids and always have.
 * Pro cannot use 'header_html_content': its classic header's HTML element
 * already owns that id, registered by the ext-header module, so sharing it
 * would make editing either one overwrite the other. Free has no such element
 * and has always used the plain id.
 *
 * Unifying the id would empty the component on every existing site of
 * whichever edition lost, so the ids stay as they are and the filter carries
 * the difference.
 *
 * @since 1.0.0
 *
 * @param string $setting Theme mod id.
 */
$header_html_setting = apply_filters( 'sydney_hfb_header_html_setting', 'header_html_content' ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
$header_html_content = get_theme_mod( $header_html_setting, '' ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
if( ! $header_html_content ) {
    return '';
} ?>

<div class="shfb-builder-item shfb-component-html" data-component-id="html">
    <?php $this->customizer_edit_button(); ?>
    <div class="header-html">
        <?php echo wp_kses_post( $header_html_content ); ?>
    </div>
</div>