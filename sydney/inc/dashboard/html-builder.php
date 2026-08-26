<?php

/**
 * Tabs Nav Items
 * 
 * @package Dashboard
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/*
 * Free renders the whole tab as a locked upsell, so it previews sample cards
 * instead of stored ones. Nothing here is saved, and no template part exists to
 * back it - the sample names only ever have to survive the markup below.
 */
$is_preview = !$this->settings['has_pro'];

$existing_parts = $is_preview ? $this->get_sample_template_parts() : $this->get_template_parts();

$parts = $this->get_template_part_labels();

// The icon each part slot is drawn with, by part type.
$part_icons = array(
	'header'     => 'part-header',
	'page_title' => 'part-page-title',
	'content'    => 'part-content',
	'footer'     => 'part-footer',
);

//disabled links in free
$disabled = $is_preview ? 'style="pointer-events:none;"' : '';

?>
<div class="sydney-dashboard-row">
	<div class="sydney-dashboard-column">
		<div class="sydney-dashboard-card sydney-dashboard-card-top-spacing sydney-dashboard-card-tabs-divider">

		<div class="template-builder-wrapper">
			<?php //The tab this panel belongs to is already labelled "Template Builder", so the heading is here for structure rather than to be read twice. ?>
			<h2 class="screen-reader-text"><?php esc_html_e( 'Template Builder', 'sydney' ); ?></h2>

			<?php if ( $is_preview ) : ?>
				<?php
				/*
				 * Free drops the description row entirely and folds its tutorial link
				 * in here, so the one row that still does anything holds everything
				 * that does. What the builder is for is left to the cards themselves.
				 */
				?>
				<div class="template-builder-pro-notice">
					<p><?php esc_html_e( 'Build your own headers, footers and page layouts with Elementor or the block editor. Requires Sydney Pro.', 'sydney' ); ?></p>
					<div class="template-builder-pro-notice-actions">
						<?php echo $this->template_builder_tutorial_link(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<a class="button button-primary button-medium" href="<?php echo esc_url( $this->settings['upgrade_pro_builder'] ); ?>"><?php esc_html_e( 'Upgrade now', 'sydney' ); ?></a>
					</div>
				</div>
			<?php else : ?>
				<div class="sydney-dashboard-card-header template-builder-header bt-d-flex bt-justify-content-between bt-align-items-center">
					<div>
						<p class="bt-text-color-grey"><?php esc_html_e( 'Assign any or all parts to the Global Template, or to templates that target specific pages.', 'sydney' ); ?></p>
					</div>
					<?php echo $this->template_builder_tutorial_link(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</div>
			<?php endif; ?>

			<div id="template-builder" data-pro="<?php echo esc_attr( $this->settings['has_pro'] ? "true" : "false" ); ?>" data-label-theme-default="<?php esc_attr_e( 'Theme default', 'sydney' ); ?>" data-label-inherited="<?php esc_attr_e( 'Follows Global Template', 'sydney' ); ?>">
				<?php 
				$templates = array();

				if ( $is_preview ) {
					$templates = $this->get_sample_templates();
				} else {
					$custom_templates = get_option( 'sydney_template_builder_data' );

					if ( !is_array( $custom_templates ) && empty( $custom_templates ) ) {
						$templates['global'] = array(
							'id'            => 'global',
							'template_name' => 'Global',
							'conditions'    => '',
							'header'        => '',
							'page_title'    => '',
							'content'       => '',
							'footer'        => '',
						);
					} else {
						$templates = $custom_templates;
					}
				}

				if ( !empty( $templates ) ) : ?>
					<?php foreach ( $templates as $key => $template ) : ?>

						<?php            
						$conditions = ( isset( $template['conditions'] ) ) ? json_decode($template['conditions'], true ) : array();

						//Sample cards bring their own, since the resolver behind
						//get_option_text() ships with Pro only.
						$labels = isset( $template['condition_labels'] ) ? $template['condition_labels'] : array();

						if ( empty( $labels ) && ! empty( $conditions ) ) {
							foreach ( $conditions as $value ) {
								if ( ! empty( $value['id'] ) ) {
									$labels[ $value['id'] ] = $this->get_option_text($value);
								}
							}
						}

						$settings = array(
							'values'        => $conditions,
							'labels'        => $labels,
							'title'         => ! empty( $template['template_name'] ) ? $template['template_name'] : __( 'Display Conditions', 'sydney' ),
							//What the modal heading falls back to once the name input is cleared.
							'default_title' => __( 'Display Conditions', 'sydney' ),
						);
						?>
						<?php require get_template_directory() . '/inc/dashboard/html-builder-card.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound ?>
					<?php endforeach; ?>
				<?php endif; //check if templates is empty ?>

				<div class="add-new-template-wrapper">
					<span id="add-new-template" <?php echo $disabled; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>><span class="add-new-template-icon"><?php echo sydney_dashboard_icon( 'plus', 24 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span><?php esc_html_e( 'Add Template', 'sydney' ); ?></span>
					<?php if ( $is_preview ) : ?>
						<?php echo $this->upgrade_overlay( __( 'Add as many templates as your site needs.', 'sydney' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<?php endif; ?>
				</div>

			</div>
			
			<?php
			/*
			 * The card Add Template clones. Kept outside #template-builder so the save
			 * and the label refreshes, which all scope to it, never see this one.
			 */
			$template = array(
				'id'            => '',
				'template_name' => '',
				'conditions'    => '',
				'header'        => '',
				'page_title'    => '',
				'content'       => '',
				'footer'        => '',
			);

			$settings = array(
				'values' => array(),
				'labels' => array(),
			);
			?>
			<div id="template-builder-blank" class="bt-d-none">
				<?php require get_template_directory() . '/inc/dashboard/html-builder-card.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound ?>
			</div>

			<?php //Nothing the preview can save, so the free tab drops the whole bar rather than showing two dead buttons in the primary action slot. ?>
			<?php if ( !$is_preview ) : ?>
			<div class="template-builder-footer">
				<button class="button button-medium" id="discard-templates" disabled><?php esc_html_e( 'Discard', 'sydney' ); ?></button>
				<button class="button button-primary button-medium" id="save-templates" disabled><?php esc_html_e( 'Save Changes', 'sydney' ); ?></button>
			</div>
			<?php endif; ?>

			<?php
			// One confirm dialog for every destructive action on this tab. The title,
			// message and confirm label are filled in by the JS when it opens.
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

			<?php
			// Options carried by the header part itself, so the same dialog serves
			// every card. Nothing is stored until Save Changes, same as the rest of
			// the builder.
			?>
			<dialog class="sydney-confirm-dialog sydney-options-dialog" id="sydney-header-options-dialog" aria-labelledby="sydney-header-options-title">
				<h2 class="sydney-confirm-dialog-title" id="sydney-header-options-title"><?php esc_html_e( 'Header Options', 'sydney' ); ?></h2>
				<div class="sydney-options-dialog-fields">
					<label class="sydney-options-dialog-field">
						<input type="checkbox" name="header_sticky" value="1">
						<span><?php esc_html_e( 'Enable Sticky Header', 'sydney' ); ?></span>
					</label>
					<label class="sydney-options-dialog-field">
						<input type="checkbox" name="header_transparent" value="1">
						<span><?php esc_html_e( 'Enable Transparent Header', 'sydney' ); ?></span>
					</label>
				</div>
				<div class="sydney-confirm-dialog-actions">
					<button type="button" class="button sydney-confirm-dialog-cancel"><?php esc_html_e( 'Cancel', 'sydney' ); ?></button>
					<button type="button" class="button button-primary sydney-options-dialog-apply"><?php esc_html_e( 'Apply', 'sydney' ); ?></button>
				</div>
			</dialog>

			<?php
			// Watch tutorial plays in here instead of leaving for the video host.
			// The iframe stays srcless until the link is clicked and is cleared
			// on close, so the host only loads while the video is open.
			?>
			<dialog class="sydney-confirm-dialog sydney-video-dialog" id="sydney-tutorial-dialog" aria-label="<?php esc_attr_e( 'Tutorial video', 'sydney' ); ?>">
				<div class="sydney-video-dialog-header">
					<?php //Keeps .sydney-confirm-dialog-cancel, which is what the dialog's own dismiss handler is bound to. ?>
					<button type="button" class="sydney-video-dialog-close sydney-confirm-dialog-cancel" aria-label="<?php esc_attr_e( 'Close', 'sydney' ); ?>"><?php echo sydney_dashboard_icon( 'close', 20 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></button>
				</div>
				<div class="sydney-video-dialog-body">
					<iframe class="sydney-video-dialog-iframe" allow="autoplay; fullscreen" allowfullscreen title="<?php esc_attr_e( 'Watch tutorial', 'sydney' ); ?>"></iframe>
				</div>
			</dialog>

			<div class="sydney-elementor-iframe-wrapper" style="display:none;">
				<iframe class="sydney-elementor-iframe"></iframe>
				<a href="#" class="sydney-editor-close"><?php sydney_get_svg_icon( 'icon-cancel', true ); ?></a>
			</div>			

			</div>
		</div>
	</div>
</div>