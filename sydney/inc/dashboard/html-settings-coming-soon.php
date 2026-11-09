<?php
/**
 * Settings - Coming Soon
 *
 * Built from the AI Abilities section: the same heading and description, and
 * its grey well with the status on the left and the controls on the right.
 * The controls are one row of buttons: Create page (or Edit page, with a menu
 * for Preview and Change design, once a page is set), the Mode dropdown and
 * the Advanced dropdown. The design popover is the Template Builder's part
 * menu, opened on its builder choice, with a second panel for the designs.
 *
 * Shared by both editions. Pro unlocks the Advanced options and prints its
 * dialogs and its display conditions control through
 * sydney_coming_soon_settings_advanced.
 *
 * @package Dashboard
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$sydney_cs_state     = Sydney_Coming_Soon::state();
$sydney_cs_mode      = $sydney_cs_state['mode'];
$sydney_cs_page      = $sydney_cs_state['page'];
$sydney_cs_has_page  = null !== $sydney_cs_page;
$sydney_cs_is_pro    = defined( 'SYDNEY_PRO_VERSION' );
$sydney_cs_conflicts = Sydney_Coming_Soon::get_conflicts();
$sydney_cs_designs   = Sydney_Coming_Soon::get_designs();

// Coming Soon and Maintenance wait for a page while the mode is off. Once a
// mode is on, Mode stays open so it can be turned off.
$sydney_cs_locked = ! $sydney_cs_has_page && 'off' === $sydney_cs_mode;

$sydney_cs_modes = array(
	'off'         => array(
		'label'       => __( 'Off', 'sydney' ),
		'description' => __( 'Visitors see your live site.', 'sydney' ),
	),
	'coming-soon' => array(
		'label'       => __( 'Coming Soon', 'sydney' ),
		'description' => __( 'For a site that hasn\'t launched yet.', 'sydney' ),
	),
	'maintenance' => array(
		'label'       => __( 'Maintenance', 'sydney' ),
		'description' => __( 'For a live site that\'s briefly down. Search engines are told to check back later.', 'sydney' ),
	),
);

// The status beside the controls, one per state. The script swaps it on a change.
$sydney_cs_summaries = array(
	'none'        => __( 'No placeholder page yet. Create one to choose a mode.', 'sydney' ),
	'off'         => __( 'Off. Visitors see your live site.', 'sydney' ),
	'coming-soon' => __( 'Coming Soon. Visitors see the placeholder page.', 'sydney' ),
	'maintenance' => __( 'Maintenance. Visitors see the placeholder page. Search engines are told to check back later.', 'sydney' ),
);
$sydney_cs_summary   = $sydney_cs_summaries[ $sydney_cs_locked ? 'none' : $sydney_cs_mode ];

$sydney_cs_advanced = array(
	'conditions'   => array(
		'label' => __( 'Include / exclude pages', 'sydney' ),
		'utm'   => 'coming_soon_include_exclude',
	),
	'private-link' => array(
		'label' => __( 'Private link', 'sydney' ),
		'utm'   => 'coming_soon_private_link',
	),
	'ip-allowlist' => array(
		'label' => __( 'IP allowlist', 'sydney' ),
		'utm'   => 'coming_soon_ip_allowlist',
	),
);

$sydney_cs_pro_tooltip = __( 'This option is only available on Sydney Pro', 'sydney' );

?>

<!-- Coming Soon Section -->
<div class="sydney-dashboard-card-section bt-mt-5" id="sydney-coming-soon" data-mode="<?php echo esc_attr( $sydney_cs_mode ); ?>" data-has-page="<?php echo $sydney_cs_has_page ? '1' : '0'; ?>">
	<div class="sydney-dashboard-module-card">

		<h2 class="bt-m-0 bt-mb-2"><?php echo esc_html__( 'Coming Soon & Maintenance', 'sydney' ); ?></h2>

		<p class="bt-text-color-grey bt-m-0"><?php esc_html_e( 'Show visitors a placeholder page while you work on the site. Editors always see the real site.', 'sydney' ); ?></p>

		<?php // The AI Abilities section's grey well: the status on the left, the controls on the right. ?>
		<div class="sydney-dashboard-module-card-header sydney-dashboard-well bt-mt-5 bt-align-items-center">
			<div class="sydney-dashboard-module-card-header-info">
				<p class="bt-text-color-grey bt-m-0 sydney-coming-soon-summary"<?php foreach ( $sydney_cs_summaries as $sydney_cs_summary_key => $sydney_cs_summary_text ) : ?> data-summary-<?php echo esc_attr( $sydney_cs_summary_key ); ?>="<?php echo esc_attr( $sydney_cs_summary_text ); ?>"<?php endforeach; ?>><?php echo esc_html( $sydney_cs_summary ); ?></p>
			</div>
			<div class="sydney-dashboard-module-card-header-actions bt-pt-0">
				<div class="sydney-coming-soon-controls">

					<?php // Anchors the design menu, opened by Create page or Change design. ?>
					<div class="sydney-coming-soon-control sydney-coming-soon-page-control">
						<?php // Hidden, not left out, so a lost page brings Create page back without a reload. ?>
						<div class="sydney-coming-soon-page-picker<?php echo $sydney_cs_has_page ? ' bt-d-none' : ''; ?>">
							<a href="#" class="button button-medium button-primary sydney-coming-soon-page-toggle" role="button" aria-haspopup="true"><?php esc_html_e( 'Create page', 'sydney' ); ?></a>
						</div>
						<div class="sydney-coming-soon-split sydney-coming-soon-page-details<?php echo $sydney_cs_has_page ? '' : ' bt-d-none'; ?>">
							<a href="#" class="button button-medium sydney-coming-soon-button sydney-coming-soon-edit" data-edit-url="<?php echo $sydney_cs_has_page ? esc_url( $sydney_cs_page['edit_url'] ) : ''; ?>"><?php esc_html_e( 'Edit page', 'sydney' ); ?></a>
							<button type="button" class="button button-medium sydney-coming-soon-button sydney-coming-soon-dropdown-toggle" aria-haspopup="menu" aria-expanded="false" aria-label="<?php esc_attr_e( 'More page actions', 'sydney' ); ?>"><?php echo sydney_dashboard_icon( 'chevron-down', 18 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></button>
							<div class="part-menu sydney-coming-soon-dropdown sydney-coming-soon-page-menu" role="menu">
								<a href="<?php echo esc_url( Sydney_Coming_Soon::preview_url() ); ?>" class="part-menu-item sydney-coming-soon-dropdown-item sydney-coming-soon-preview" role="menuitem" target="_blank" rel="noopener"><span class="part-menu-label"><?php esc_html_e( 'Preview', 'sydney' ); ?></span></a>
								<a href="#" class="part-menu-item sydney-coming-soon-dropdown-item sydney-coming-soon-change" role="menuitem"><span class="part-menu-label"><?php esc_html_e( 'Change design', 'sydney' ); ?></span></a>
							</div>
						</div>

						<?php
						/*
						 * The Template Builder's part menu: the builder choice and the
						 * designs, on one sliding track.
						 */
						?>
						<div class="part-menu sydney-coming-soon-menu">
							<div class="part-menu-track">
								<div class="page-builder-wrapper part-menu-panel">
									<span class="page-builder-title"><?php esc_html_e( 'Choose your builder:', 'sydney' ); ?></span>
									<?php if ( class_exists( 'Elementor\Plugin' ) ) : ?>
										<span class="part-menu-item create-new elementor sydney-coming-soon-builder" data-builder="elementor"><?php sydney_get_svg_icon( 'icon-elementor', true ); ?><span class="part-menu-label"><?php esc_html_e( 'Elementor', 'sydney' ); ?></span></span>
									<?php endif; ?>
									<span class="part-menu-item create-new editor sydney-coming-soon-builder" data-builder="editor"><?php sydney_get_svg_icon( 'icon-wordpress', true ); ?><span class="part-menu-label"><?php esc_html_e( 'WordPress Editor', 'sydney' ); ?></span></span>
								</div>
								<div class="page-builder-wrapper part-menu-panel sydney-coming-soon-designs">
									<?php // Without Elementor the menu opens here, so there is no builder choice to go back to. ?>
									<?php if ( class_exists( 'Elementor\Plugin' ) ) : ?>
										<span class="part-menu-item part-menu-back sydney-coming-soon-designs-back"><?php echo sydney_dashboard_icon( 'chevron-left', 18 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span class="part-menu-label"><?php esc_html_e( 'Back', 'sydney' ); ?></span></span>
										<div class="part-menu-divider"></div>
									<?php endif; ?>
									<span class="page-builder-title"><?php esc_html_e( 'Choose a design:', 'sydney' ); ?></span>
									<div class="sydney-coming-soon-design-grid">
										<?php foreach ( $sydney_cs_designs as $sydney_cs_slug => $sydney_cs_design ) : ?>
											<?php
											$sydney_cs_design_name   = isset( $sydney_cs_design['name'] ) ? $sydney_cs_design['name'] : $sydney_cs_slug;
											$sydney_cs_design_thumb  = isset( $sydney_cs_design['thumbnail'] ) ? $sydney_cs_design['thumbnail'] : '';
											$sydney_cs_design_locked = ( ! isset( $sydney_cs_design['type'] ) || 'free' !== $sydney_cs_design['type'] ) && ! $sydney_cs_is_pro;
											?>
											<?php // The thumbnail alone is shown; the name stays for screen readers. ?>
											<?php if ( $sydney_cs_design_locked ) : ?>
												<a class="sydney-coming-soon-design is-locked" href="<?php echo esc_url( sydney_admin_upgrade_link( 'https://athemes.com/sydney-upgrade', array( 'utm_source' => 'dashboard_coming_soon', 'utm_medium' => 'link', 'utm_campaign' => 'Sydney', 'utm_content' => 'coming_soon_design' ), 'dashboard-coming-soon-design-link' ) ); ?>" target="_blank" rel="noopener" title="<?php echo esc_attr( $sydney_cs_pro_tooltip ); ?>" aria-label="<?php echo esc_attr( $sydney_cs_design_name ); ?>">
													<img src="<?php echo esc_url( $sydney_cs_design_thumb ); ?>" alt="" width="140" height="90" loading="lazy">
													<span class="sydney-coming-soon-design-lock"><?php echo sydney_dashboard_icon( 'lock', 14 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
												</a>
											<?php else : ?>
												<button type="button" class="sydney-coming-soon-design" data-design="<?php echo esc_attr( $sydney_cs_slug ); ?>" aria-label="<?php echo esc_attr( $sydney_cs_design_name ); ?>">
													<img src="<?php echo esc_url( $sydney_cs_design_thumb ); ?>" alt="" width="140" height="90" loading="lazy">
												</button>
											<?php endif; ?>
										<?php endforeach; ?>
									</div>
								</div>
							</div>
						</div>
					</div>

					<?php // The tooltip sits on the wrapper: a disabled button gets no hover. ?>
					<div class="sydney-coming-soon-control sydney-coming-soon-mode-control<?php echo $sydney_cs_locked ? ' sydney-dashboard-pro-tooltip' : ''; ?>"<?php echo $sydney_cs_locked ? ' data-tooltip-message="' . esc_attr__( 'Create a page first', 'sydney' ) . '"' : ''; ?>>
						<button type="button" class="button button-medium sydney-coming-soon-button sydney-coming-soon-dropdown-toggle sydney-coming-soon-mode-toggle" aria-haspopup="menu" aria-expanded="false"<?php disabled( $sydney_cs_locked ); ?>>
							<span><span class="sydney-coming-soon-mode-prefix"><?php esc_html_e( 'Mode:', 'sydney' ); ?></span> <span class="sydney-coming-soon-mode-label"><?php echo esc_html( $sydney_cs_modes[ $sydney_cs_mode ]['label'] ); ?></span></span>
							<?php echo sydney_dashboard_icon( 'chevron-down', 18 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</button>
						<div class="part-menu sydney-coming-soon-dropdown sydney-coming-soon-mode-menu" role="menu">
							<?php foreach ( $sydney_cs_modes as $sydney_cs_mode_value => $sydney_cs_mode_option ) : ?>
								<button type="button" class="part-menu-item sydney-coming-soon-dropdown-item sydney-coming-soon-mode-option" role="menuitemradio" data-mode="<?php echo esc_attr( $sydney_cs_mode_value ); ?>" aria-checked="<?php echo $sydney_cs_mode === $sydney_cs_mode_value ? 'true' : 'false'; ?>">
									<span class="sydney-coming-soon-mode-check" aria-hidden="true"><?php echo sydney_dashboard_icon( 'check-bold', 14 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
									<span class="sydney-coming-soon-mode-option-text">
										<span class="sydney-coming-soon-mode-option-label"><?php echo esc_html( $sydney_cs_mode_option['label'] ); ?></span>
										<span class="sydney-coming-soon-mode-option-description"><?php echo esc_html( $sydney_cs_mode_option['description'] ); ?></span>
									</span>
								</button>
							<?php endforeach; ?>
						</div>
					</div>

					<div class="sydney-coming-soon-control">
						<button type="button" class="button button-medium sydney-coming-soon-button sydney-coming-soon-dropdown-toggle sydney-coming-soon-advanced-toggle" aria-haspopup="menu" aria-expanded="false">
							<?php esc_html_e( 'Advanced', 'sydney' ); ?>
							<?php echo sydney_dashboard_icon( 'chevron-down', 18 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</button>
						<div class="part-menu sydney-coming-soon-dropdown sydney-coming-soon-advanced-menu" role="menu">
							<?php foreach ( $sydney_cs_advanced as $sydney_cs_key => $sydney_cs_option ) : ?>
								<?php if ( $sydney_cs_is_pro ) : ?>
									<a href="#" class="part-menu-item sydney-coming-soon-dropdown-item sydney-coming-soon-advanced" role="menuitem" data-dialog="<?php echo esc_attr( $sydney_cs_key ); ?>"><span class="part-menu-label"><?php echo esc_html( $sydney_cs_option['label'] ); ?></span></a>
								<?php else : ?>
									<a href="<?php echo esc_url( sydney_admin_upgrade_link( 'https://athemes.com/sydney-upgrade', array( 'utm_source' => 'dashboard_coming_soon', 'utm_medium' => 'link', 'utm_campaign' => 'Sydney', 'utm_content' => $sydney_cs_option['utm'] ), 'dashboard-coming-soon-advanced-link' ) ); ?>" class="part-menu-item sydney-coming-soon-dropdown-item sydney-coming-soon-advanced is-locked" role="menuitem" target="_blank" rel="noopener"><span class="part-menu-label"><?php echo esc_html( $sydney_cs_option['label'] ); ?></span><span class="sydney-dashboard-badge sydney-dashboard-badge-pro"><?php esc_html_e( 'Pro', 'sydney' ); ?></span></a>
								<?php endif; ?>
							<?php endforeach; ?>
						</div>
					</div>

				</div>
			</div>
		</div>

		<?php if ( ! empty( $sydney_cs_conflicts ) ) : ?>
			<p class="sydney-dashboard-license-error">
				<?php
				printf(
					/* translators: %s: comma separated names of plugins or settings. */
					esc_html__( 'Another coming soon or maintenance mode is active: %s. Turn it off so the two do not compete for your visitors.', 'sydney' ),
					esc_html( implode( ', ', $sydney_cs_conflicts ) )
				);
				?>
			</p>
		<?php endif; ?>

		<p class="sydney-dashboard-license-error sydney-coming-soon-page-missing<?php echo $sydney_cs_state['page_missing'] ? '' : ' bt-d-none'; ?>"><?php esc_html_e( 'The placeholder page was deleted. Visitors get a basic coming soon screen until you pick a new page.', 'sydney' ); ?></p>
		<p class="sydney-dashboard-license-error sydney-coming-soon-page-feedback bt-d-none"></p>
		<p class="sydney-dashboard-license-error sydney-coming-soon-mode-feedback bt-d-none"></p>
		<p class="sydney-dashboard-license-error sydney-coming-soon-advanced-feedback bt-d-none"></p>

		<?php
		/**
		 * Prints Pro's Advanced options dialogs and display conditions control.
		 */
		do_action( 'sydney_coming_soon_settings_advanced' );
		?>

	</div>
</div>
<!-- End Coming Soon Section -->
