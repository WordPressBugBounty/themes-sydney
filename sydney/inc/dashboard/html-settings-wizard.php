<?php

/**
 * Settings - Wizard
 *
 * @package Dashboard
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>

<!-- Site Wizard Section -->
<?php if ( class_exists( 'ATSS_Onboarding_Wizard' ) && ( get_option( 'atss_wizard_state' ) || get_option( 'atss_current_starter' ) ) ) : ?>
<div class="sydney-dashboard-card-section" style="margin-top: 20px;">
	<div class="sydney-dashboard-module-card">
		<div class="sydney-dashboard-module-card-header bt-align-items-center">
			<div class="sydney-dashboard-module-card-header-info">
				<h2 class="bt-m-0 bt-mb-10px"><?php echo esc_html__( 'Site Wizard', 'sydney' ); ?></h2>
				<p class="bt-text-color-grey"><?php esc_html_e( 'Relaunch the site wizard to set up a fresh template for your site, allowing you to easily incorporate new color and font presets, as well as additional features.', 'sydney' ); ?></p>
			</div>
			<div class="sydney-dashboard-module-card-header-actions bt-pt-0">
				<div class="sydney-dashboard-box-link">
					<a href="<?php echo esc_url( admin_url( 'admin.php?page=atss-onboarding-wizard' ) ); ?>" class="sydney-dashboard-link sydney-dashboard-link-primary button button-primary">
						<?php echo esc_html__( 'Relaunch Wizard', 'sydney' ); ?>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
<!-- End Site Wizard Section -->
