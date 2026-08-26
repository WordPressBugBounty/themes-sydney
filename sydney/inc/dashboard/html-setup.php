<?php
/**
 * Setup Tab — product education checklist.
 *
 * @package Dashboard
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$state      = Sydney_Setup_Checklist::instance()->get_state();
$categories = $state['categories'];
?>
<div class="sydney-dashboard-row">
	<div class="sydney-dashboard-column">
		<div class="sydney-dashboard-card sydney-dashboard-card-top-spacing sydney-dashboard-card-tabs-divider">
			<div class="sydney-dashboard-card-body">

				<div class="sydney-setup-checklist">
					<div class="sydney-setup-checklist-live screen-reader-text" aria-live="polite" role="status"></div>
					<header class="sydney-setup-checklist-intro">
						<h2><?php esc_html_e( 'Get your site ready', 'sydney' ); ?></h2>
						<p class="bt-text-color-grey"><?php esc_html_e( 'Work through this checklist to set up the basics. Each step links straight to the right Customizer section, and we will mark things off automatically as you go.', 'sydney' ); ?></p>
					</header>

					<?php foreach ( $categories as $cat_slug => $category ) :
						$cat_all_done   = ! empty( $category['all_done'] );
						$done_count     = isset( $category['done_count'] )  ? (int) $category['done_count']  : 0;
						$total_count    = isset( $category['total_count'] ) ? (int) $category['total_count'] : 0;
						$progress_state = $cat_all_done ? 'done' : ( $done_count > 0 ? 'partial' : 'empty' );
						$section_class  = 'sydney-setup-checklist-category bt-mb-5';
						$section_class .= $cat_all_done ? ' is-fully-done is-collapsed' : '';
						$items_id       = 'sydney-setup-items-' . $cat_slug;
						$progress_label = sprintf(
							/* translators: 1: number of completed items, 2: total items in this category */
							__( '%1$d of %2$d complete', 'sydney' ),
							$done_count,
							$total_count
						);
						?>
						<section class="<?php echo esc_attr( $section_class ); ?>" data-category="<?php echo esc_attr( $cat_slug ); ?>">
							<div class="sydney-setup-checklist-category-box">
								<header class="sydney-setup-checklist-category-header">
									<span class="sydney-setup-checklist-category-progress is-state-<?php echo esc_attr( $progress_state ); ?>"
										data-done="<?php echo esc_attr( $done_count ); ?>"
										data-total="<?php echo esc_attr( $total_count ); ?>"
										aria-label="<?php echo esc_attr( $progress_label ); ?>">
										<span class="sydney-setup-checklist-category-progress-fraction" aria-hidden="true"><?php echo esc_html( $done_count . '/' . $total_count ); ?></span>
										<?php echo sydney_dashboard_icon( 'check-bold', 18, 'sydney-setup-checklist-category-progress-check' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
									</span>
									<h3 class="sydney-setup-checklist-category-label"><?php echo esc_html( $category['label'] ); ?></h3>
									<button type="button"
										class="sydney-setup-checklist-category-toggle"
										aria-expanded="<?php echo $cat_all_done ? 'false' : 'true'; ?>"
										aria-controls="<?php echo esc_attr( $items_id ); ?>"
										aria-label="<?php
											/* translators: %s: name of the setup checklist category, e.g. "Branding" */
											echo esc_attr( sprintf( __( 'Toggle %s items', 'sydney' ), $category['label'] ) );
										?>">
										<?php echo sydney_dashboard_icon( 'chevron-down', 20 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
									</button>
								</header>

								<ul id="<?php echo esc_attr( $items_id ); ?>" class="sydney-setup-checklist-items">
								<?php foreach ( $category['items'] as $item_slug => $item ) :
									$is_done      = $item['is_done'];
									$is_auto      = $item['is_auto'];
									$action_type  = $item['action_type'];
									$row_class    = 'sydney-setup-checklist-item' . ( $is_done ? ' is-done' : '' );
									$toggle_label = $is_done ? esc_html__( 'Mark incomplete', 'sydney' ) : esc_html__( 'Mark complete', 'sydney' );
									?>
									<?php
									$has_help        = ! empty( $item['help_image'] );
									$help_aria_label = sprintf(
										/* translators: %s: name of the checklist item, e.g. "Logo & Site Title" */
										__( 'Show help for %s', 'sydney' ),
										$item['title']
									);
									?>
									<li class="<?php echo esc_attr( $row_class ); ?>"
										data-item-slug="<?php echo esc_attr( $item_slug ); ?>"
										data-is-auto="<?php echo $is_auto ? '1' : '0'; ?>">
										<button type="button"
											class="sydney-setup-checklist-item-status"
											data-complete="<?php echo $is_done ? '0' : '1'; ?>"
											aria-pressed="<?php echo $is_done ? 'true' : 'false'; ?>"
											aria-label="<?php echo esc_attr( $toggle_label ); ?>"
											<?php disabled( $is_auto ); ?>>
											<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
												<circle cx="9" cy="9" r="8" stroke="currentColor" stroke-width="1.5" fill="none" class="ring" />
												<path d="M5 9.5l2.5 2.5L13 7" stroke="currentColor" stroke-width="1.8" fill="none" stroke-linecap="round" stroke-linejoin="round" class="check" />
											</svg>
										</button>

										<div class="sydney-setup-checklist-item-text">
											<span class="sydney-setup-checklist-item-title bt-font-weight-500"><?php echo esc_html( $item['title'] ); ?></span>
											<span class="sydney-setup-checklist-item-desc bt-text-color-grey"><?php echo esc_html( $item['description'] ); ?></span>
										</div>

										<div class="sydney-setup-checklist-item-actions">
											<?php if ( $has_help ) : ?>
												<button type="button"
													class="sydney-setup-checklist-help"
													data-help-image="<?php echo esc_url( $item['help_image'] ); ?>"
													aria-haspopup="dialog"
													aria-label="<?php echo esc_attr( $help_aria_label ); ?>">
													<?php echo sydney_dashboard_icon( 'help', 20 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
												</button>
											<?php endif; ?>
											<?php if ( 'homepage_setup' === $action_type ) : ?>
												<a href="#" class="button-secondary sydney-setup-homepage-button">
													<?php echo esc_html( $item['action_label'] ); ?>
												</a>
											<?php elseif ( 'install_plugin' === $action_type ) :
												$plugin_status = isset( $item['plugin_status'] ) ? $item['plugin_status'] : 'not_installed';
												if ( 'active' === $plugin_status && ! empty( $item['manage_url'] ) ) : ?>
												<a href="<?php echo esc_url( $item['manage_url'] ); ?>" class="button-secondary">
													<?php echo esc_html( isset( $item['manage_label'] ) ? $item['manage_label'] : __( 'Manage', 'sydney' ) ); ?>
												</a>
												<?php else :
													if ( 'inactive' === $plugin_status ) {
														$button_label = esc_html__( 'Activate', 'sydney' );
														$button_type  = 'activate';
													} else {
														$button_label = esc_html( $item['action_label'] );
														$button_type  = 'install';
													}
													?>
												<a href="#"
													class="button-secondary sydney-dashboard-plugin-ajax-button"
													data-type="<?php echo esc_attr( $button_type ); ?>"
													data-slug="<?php echo esc_attr( $item['plugin_slug'] ); ?>"
													data-path="<?php echo esc_attr( $item['plugin_path'] ); ?>">
													<?php echo $button_label; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- already escaped above ?>
												</a>
												<?php endif; ?>
											<?php else : ?>
												<a href="<?php echo esc_url( $item['action_url'] ); ?>" class="button-secondary" target="_blank" rel="noopener">
													<?php echo esc_html( $item['action_label'] ); ?>
												</a>
											<?php endif; ?>
										</div>

									</li>
								<?php endforeach; ?>
							</ul>
							</div>
						</section>
					<?php endforeach; ?>

					<dialog class="sydney-setup-checklist-help-dialog" id="sydney-setup-checklist-help-dialog" aria-label="<?php esc_attr_e( 'Help', 'sydney' ); ?>">
						<button type="button" class="sydney-setup-checklist-help-dialog-close" aria-label="<?php esc_attr_e( 'Close', 'sydney' ); ?>">
							<?php echo sydney_dashboard_icon( 'close', 18 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</button>
						<img class="sydney-setup-checklist-help-dialog-image" src="" alt="">
					</dialog>

				</div>

			</div>
		</div>
	</div>
</div>
