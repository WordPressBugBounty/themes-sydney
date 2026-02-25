<?php

/**
 * Settings - Misc
 * 
 * @package Dashboard
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>

<!-- Misc Section -->
<?php if ( ! defined( 'SYDNEY_PRO_VERSION' ) ) : ?>
<div class="sydney-dashboard-card-section" style="margin-top: 20px;">
	<div class="sydney-dashboard-module-card">
		<div class="sydney-dashboard-module-card-header bt-align-items-center">
			<div class="sydney-dashboard-module-card-header-info">
				<h2 class="bt-m-0 bt-mb-10px"><?php echo esc_html__( 'Improve Sydney', 'sydney' ); ?></h2>
				<p class="bt-text-color-grey"><?php esc_html_e( 'By allowing us to track usage data, we can better help you, as we will know which WordPress configurations, themes, and plugins we should test. No sensitive data is collected.', 'sydney' ); ?></p>
			</div>
			<div class="sydney-dashboard-module-card-header-actions bt-pt-0">
				<div class="sydney-dashboard-box-link">
					<?php if ( get_option( 'sydney-usage-tracking-enabled', 0 ) ) : ?>
						<a href="#" class="sydney-dashboard-link sydney-dashboard-link-danger sydney-dashboard-option-switcher" data-option-id="sydney-usage-tracking-enabled" data-option-activate="false">
							<?php echo esc_html__( 'Deactivate', 'sydney' ); ?>
						</a>
					<?php else : ?>
						<a href="#" class="sydney-dashboard-link sydney-dashboard-link-success sydney-dashboard-option-switcher" data-option-id="sydney-usage-tracking-enabled" data-option-activate="true">
							<?php echo esc_html__( 'Activate', 'sydney' ); ?>
						</a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
<!-- End Misc Section -->

