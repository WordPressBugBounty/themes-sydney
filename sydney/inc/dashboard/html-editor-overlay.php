<?php
/**
 * Editor overlay: the iframe the Template Builder parts and the Coming Soon
 * placeholder page open their editor in.
 *
 * Printed once per dashboard page, outside the tabs: every tab is rendered and
 * only the active one is shown, so an overlay inside one tab would stay hidden
 * when another tab opened it.
 *
 * @package Dashboard
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>
<div class="sydney-elementor-iframe-wrapper" style="display:none;">
	<iframe class="sydney-elementor-iframe"></iframe>
	<a href="#" class="sydney-editor-close"><?php sydney_get_svg_icon( 'icon-cancel', true ); ?></a>
</div>
