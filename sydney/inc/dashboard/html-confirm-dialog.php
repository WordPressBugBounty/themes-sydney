<?php
/**
 * The dashboard's confirm dialog, for actions that destroy something. The
 * title, message and confirm label are filled in by the JS when it opens.
 *
 * Printed once per dashboard page, after the tabs: every tab is printed on
 * every load, and a dialog inside a hidden tab never shows.
 *
 * @package Dashboard
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>
<dialog class="sydney-confirm-dialog" id="sydney-template-builder-confirm" aria-labelledby="sydney-template-builder-confirm-title" aria-describedby="sydney-template-builder-confirm-message">
	<span class="sydney-confirm-dialog-icon">
		<?php echo sydney_dashboard_icon( 'caution', 40 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</span>
	<h2 class="sydney-confirm-dialog-title" id="sydney-template-builder-confirm-title"></h2>
	<p class="sydney-confirm-dialog-message" id="sydney-template-builder-confirm-message"></p>
	<div class="sydney-confirm-dialog-actions">
		<button type="button" class="button sydney-confirm-dialog-cancel"><?php esc_html_e( 'Cancel', 'sydney' ); ?></button>
		<button type="button" class="button button-warning sydney-confirm-dialog-confirm"></button>
	</div>
</dialog>
