<?php

/**
 * Settings - General (License)
 * 
 * @package Dashboard
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>

<!-- License Section -->
<div class="sydney-dashboard-card-section">
       
        <?php if ( defined( 'SYDNEY_PRO_VERSION' ) ) : ?>

            <div class="sydney-dashboard-license-wrapper">
                <h2 class="bt-mb-5"><?php echo esc_html__( 'Sydney Pro License', 'sydney' ); ?></h2>
                <p class="bt-text-color-grey bt-mb-5"><?php echo esc_html__( 'Activate your license key for Sydney Pro to get the latest theme updates automatically, right from your WordPress Dashboard.', 'sydney' ); ?> </p>
                <?php do_action( 'sydney_pro_license_form' ); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound ?>
                <details class="sydney-dashboard-disclosure bt-mt-5">
                    <summary class="sydney-dashboard-disclosure-summary">
                        <?php echo sydney_dashboard_icon( 'chevron-down', 16, 'sydney-dashboard-disclosure-chevron' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                        <?php echo esc_html__( 'Where do I find my license key?', 'sydney' ); ?>
                    </summary>
                    <div class="sydney-dashboard-disclosure-content">
                        <p>
                            <?php printf(
                                // translators: %1$s is the opening link tag to the aThemes account, %2$s is the closing link tag, %3$s and %4$s wrap the name of the account section.
                                esc_html__( 'Log in to your %1$saThemes account%2$s, open the %3$sLicenses%4$s section, and click the key icon 🔑. Copy the key that appears and paste it here.', 'sydney' ),
                                '<a href="https://athemes.com/your-account/" target="_blank">',
                                '</a>',
                                '<strong>',
                                '</strong>'
                            ); ?>
                        </p>
                    </div>
                </details>
            </div>

        <?php else : ?>

            <div class="sydney-dashboard-module-card">
                <div class="sydney-dashboard-module-card-header">
                    <div class="sydney-dashboard-module-card-header-info">
                        <h2 class="bt-mb-5"><?php echo esc_html__( 'Get Sydney Pro', 'sydney' ); ?></h2>
                        <p class="bt-text-color-grey"><?php echo esc_html__( 'Take Sydney to a whole other level by upgrading to the premium version.', 'sydney' ); ?></p>
                    </div>
                    <div class="sydney-dashboard-module-card-header-actions">
                        <a href="<?php echo esc_url( $this->settings['upgrade_pro'] ); ?>" class="sydney-dashboard-external-link" target="_blank">
                            <?php echo esc_html__( 'Upgrade Now', 'sydney' ); ?>
                            <?php echo sydney_dashboard_icon( 'external', 16, 'sydney-svg-accent' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                        </a>
                    </div>
                </div>
            </div>

        <?php endif; ?>

</div>
<!-- End License Section -->

