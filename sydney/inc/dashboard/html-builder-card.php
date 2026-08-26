<?php

/**
 * One Template Builder card.
 *
 * Rendered once per stored template, and once more as the hidden prototype the
 * Add Template button clones. An empty $template['id'] is what makes it the
 * prototype: every Global-only branch below tests against 'global', so a blank
 * id produces exactly the card a new template needs.
 *
 * Expects $template, $settings, $parts, $part_icons, $existing_parts and
 * $disabled from the including template.
 *
 * @package Dashboard
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

?>
						<div class="template-item" data-id="<?php echo esc_attr( $template['id'] ); ?>">

							<div class="template-name">

								<?php if ( 'global' !== $template['id'] ) : ?>
								<h4><input type="text" name="template_name" value="<?php echo isset( $template['template_name'] ) ? esc_attr( $template['template_name'] ) : ''; ?>" placeholder="<?php esc_attr_e( 'Add a template name…', 'sydney' ); ?>"></h4>
								<?php else : ?>
								<h4><?php echo esc_html__('Global Template', 'sydney'); ?></h4>
								<?php endif; ?>

								<div class="template-options<?php echo ( isset( $template['id'] ) && 'global' === $template['id'] ) ? ' bt-d-none' : ''; ?>">
									<?php //Kept for the modal and the conditions input; opened from the Edit link below the title. ?>
									<div class="sydney-display-conditions-control" data-condition-settings="<?php echo esc_attr( wp_json_encode( $settings ) ); ?>">
										<div class="sydney-display-conditions-modal">
										<!-- Modal content goes here -->
										</div>
										<input class="sydney-display-conditions-textarea" type="hidden" name="conditions" value="<?php echo isset( $template['conditions'] ) ? esc_attr( $template['conditions'] ) : ''; ?>">
									</div>
									<a href="#" title="<?php esc_attr_e( 'Duplicate', 'sydney' ); ?>" class="duplicate-template"><?php echo sydney_dashboard_icon( 'copy', 20 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span class="tooltip"><?php esc_html_e( 'Duplicate', 'sydney' ); ?></span></a>
									<a href="#" title="<?php esc_attr_e( 'Delete', 'sydney' ); ?>" class="delete-template"><?php echo sydney_dashboard_icon( 'trash', 20 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span class="tooltip"><?php esc_html_e( 'Delete', 'sydney' ); ?></span></a>
								</div>
							</div>

							<p class="template-applies">
								<?php
								//Only the span is filled in by the JS, so the link stays put. Global
								//has no conditions, so its summary stays text instead of a second trigger.
								$applies_toggle = ( 'global' !== $template['id'] ) ? ' sydney-display-conditions-modal-toggle' : '';
								?>
								<span class="template-applies-text<?php echo esc_attr( $applies_toggle ); ?>"></span>
								<?php if ( 'global' !== $template['id'] ) : ?>
								<a href="#" title="<?php esc_attr_e( 'Edit Rules', 'sydney' ); ?>" aria-label="<?php esc_attr_e( 'Edit Rules', 'sydney' ); ?>" class="template-applies-edit sydney-display-conditions-modal-toggle"><?php echo sydney_dashboard_icon( 'pencil', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a>
								<?php endif; ?>
							</p>

							<?php
							foreach ( $parts as $template_type => $part ) :

								/*
								 * Where this slot gets its output when nothing is assigned here.
								 * Every other template falls through to Global, so only Global
								 * itself bottoms out at the theme's own output.
								 */
								$sub_label = ( 'global' !== $template['id'] )
									/* translators: points at the Global card, so keep this wording in step with the 'Global Template' card title. */
									? __( 'Follows Global Template', 'sydney' )
									: __( 'Theme default', 'sydney' );

								/*
								 * An assigned part shows its own template name instead. A part
								 * pointing at a template that no longer exists resolves to no
								 * name, and falls back to the inherited/default text - which is
								 * what actually renders in that case.
								 */
								$part_id       = ! empty( $template[ $template_type ] ) ? $template[ $template_type ] : '';
								$assigned_name = ( '' !== $part_id && isset( $existing_parts[ $part_id ] ) ) ? $existing_parts[ $part_id ] : '';

								/*
								 * Header options live on the part itself, not on this row, so
								 * they are read off the assigned part and held in the inputs
								 * below until Save Changes writes them back.
								 */
								$header_options = ( 'header' === $template_type && '' !== $part_id )
									? sydney_get_header_options( $part_id )
									: array( 'sticky' => 0, 'transparent' => 0 );
								?>
							<div class="template-part <?php echo esc_attr( $template_type ); ?>" data-page-builder="<?php echo !empty( $template[$template_type . '_builder'] ) ? esc_attr( $template[$template_type . '_builder'] ) : ''; ?>" data-part-type="<?php echo esc_attr( $template_type ); ?>" data-part-active="<?php echo !empty( $template[$template_type] ) ? 'active' : 'inactive'; ?>">
								<span class="part-icon">
									<?php echo sydney_dashboard_icon( $part_icons[ $template_type ], 21 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
									<span class="part-icon-check"><?php echo sydney_dashboard_icon( 'check-bold', 10 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
								</span>
								<div class="template-part-inner">
									<span class="part-title"><?php echo esc_html( $part ); ?></span>
									<span class="part-sub-label<?php echo $assigned_name ? ' part-sub-label--assigned' : ''; ?>">
										<?php echo sydney_dashboard_icon( 'corner-down-right', 14 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
										<span class="part-sub-label-text"><?php echo esc_html( $assigned_name ? $assigned_name : $sub_label ); ?></span>
									</span>
									<input class="part-id" type="hidden" name="<?php echo esc_attr( $template_type ); ?>" value="<?php echo isset( $template[$template_type] ) ? esc_attr( $template[$template_type] ) : ''; ?>">
									<?php if ( 'header' === $template_type ) : ?>
									<input class="header-option" type="hidden" name="header_sticky" value="<?php echo esc_attr( $header_options['sticky'] ); ?>">
									<input class="header-option" type="hidden" name="header_transparent" value="<?php echo esc_attr( $header_options['transparent'] ); ?>">
									<?php endif; ?>
								</div>
								<div class="part-options-toggle">
									<?php echo sydney_dashboard_icon( 'more-vertical', 20 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								</div>

								<?php
								/*
								 * The three panels below live in one sliding track: the top-level
								 * menu, the existing-parts list and the builder choice. Both
								 * drill-in rows move the track sideways instead of opening a
								 * separate popover of their own.
								 */
								?>
								<div class="part-menu">
									<div class="part-menu-track">
										<div class="part-options part-menu-panel">
											<?php //Both act on the assigned part, and both are hidden until there is one, so an unset slot still opens on Select Existing. ?>
											<span class="part-menu-item edit-part">
												<?php echo sydney_dashboard_icon( 'pencil', 20 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
												<span class="part-menu-label"><?php esc_html_e( 'Edit', 'sydney' ); ?></span>
											</span>
											<?php if ( 'header' === $template_type ) : ?>
											<span class="part-menu-item header-options">
												<?php echo sydney_dashboard_icon( 'cog', 20 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
												<span class="part-menu-label"><?php esc_html_e( 'Header Options', 'sydney' ); ?></span>
											</span>
											<?php endif; ?>
											<span class="part-menu-item select-existing">
												<?php echo sydney_dashboard_icon( 'list-view', 20 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
												<span class="part-menu-label"><?php esc_html_e( 'Select Existing', 'sydney' ); ?></span>
												<?php echo sydney_dashboard_icon( 'chevron-right', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
											</span>
											<span class="part-menu-item select-page-builder">
												<?php echo sydney_dashboard_icon( 'plus', 20 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
												<span class="part-menu-label"><?php esc_html_e( 'Create New', 'sydney' ); ?></span>
												<?php echo sydney_dashboard_icon( 'chevron-right', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
											</span>
											<div class="part-menu-divider"></div>
											<span class="part-menu-item reset">
												<?php echo sydney_dashboard_icon( 'rotate-left', 20 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
												<span class="part-menu-label"><?php esc_html_e( 'Reset', 'sydney' ); ?></span>
											</span>
										</div>
										<?php echo $this->existing_parts_select( $existing_parts ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
										<div class="page-builder-wrapper part-menu-panel">
											<?php echo $this->part_menu_back(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
											<span class="page-builder-title"><?php esc_html_e( 'Choose your builder:', 'sydney' ); ?></span>
											<?php if ( class_exists( 'Elementor\Plugin' ) ) : ?>
											<span <?php echo $disabled;  // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> class="part-menu-item create-new elementor" data-page-builder="elementor"><?php sydney_get_svg_icon( 'icon-elementor', true ); ?><span class="part-menu-label"><?php esc_html_e( 'Elementor', 'sydney' ); ?></span></span>
											<?php endif; ?>
											<span <?php echo $disabled;  // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> class="part-menu-item create-new editor" data-page-builder="editor"><?php sydney_get_svg_icon( 'icon-wordpress', true ); ?><span class="part-menu-label"><?php esc_html_e( 'WordPress Editor', 'sydney' ); ?></span></span>
										</div>
									</div>
								</div>
							</div>
							<?php endforeach; ?>
							<?php if ( !$this->settings['has_pro'] ) : ?>
								<?php echo $this->upgrade_overlay( isset( $template['upsell_copy'] ) ? $template['upsell_copy'] : '' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<?php endif; ?>
						</div>
