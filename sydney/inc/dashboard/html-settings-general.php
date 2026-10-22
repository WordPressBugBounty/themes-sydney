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
                                '<a href="' . esc_url( sydney_admin_upgrade_link( 'https://athemes.com/your-account/', array( 'utm_source' => 'theme_license', 'utm_medium' => 'link', 'utm_campaign' => 'Sydney', 'utm_content' => 'license_tab_account' ), 'license-tab-account-link' ) ) . '" target="_blank">',
                                '</a>',
                                '<strong>',
                                '</strong>'
                            ); ?>
                        </p>
                    </div>
                </details>
            </div>

        <?php else : ?>

            <?php $sydney_can_upgrade = class_exists( 'Sydney_Pro_Upgrade' ) && Sydney_Pro_Upgrade::can_upgrade(); ?>

            <div class="sydney-dashboard-module-card<?php echo $sydney_can_upgrade ? ' sydney-pro-upgrade' : ''; ?>">
                <div class="sydney-dashboard-module-card-header">
                    <div class="sydney-dashboard-module-card-header-info">
                        <h2 class="bt-mb-5"><?php echo esc_html__( 'Get Sydney Pro', 'sydney' ); ?></h2>
                        <p class="bt-text-color-grey">
                            <?php echo esc_html__( 'Take Sydney to a whole other level by upgrading to the premium version.', 'sydney' ); ?>
                            <?php if ( $this->settings['upgrade_carries_over'] ) : ?>
                                <?php echo esc_html__( 'Everything you\'ve built carries over to Sydney Pro.', 'sydney' ); ?>
                            <?php endif; ?>
                        </p>
                        <?php if ( $sydney_can_upgrade ) : ?>
                            <p class="bt-text-color-grey sydney-pro-upgrade-prompt">
                                <?php echo esc_html__( 'Already have Sydney Pro?', 'sydney' ); ?>
                                <button type="button" class="sydney-pro-upgrade-reveal"><?php echo esc_html__( 'Enter your license key', 'sydney' ); ?></button>
                            </p>
                        <?php endif; ?>
                    </div>
                    <div class="sydney-dashboard-module-card-header-actions">
                        <a href="<?php echo esc_url( $this->settings['upgrade_pro_settings'] ); ?>" class="sydney-dashboard-external-link" target="_blank">
                            <?php echo esc_html__( 'Get Sydney Pro', 'sydney' ); ?>
                            <?php echo sydney_dashboard_icon( 'external', 16, 'sydney-svg-accent' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                        </a>
                    </div>
                </div>

                <?php if ( $sydney_can_upgrade ) : ?>
                    <div class="sydney-pro-upgrade-form" hidden>
                        <form action="" method="post" autocomplete="off" class="sydney-pro-upgrade-row">
                            <div class="sydney-license-key-input">
                                <i class="dashicons dashicons-admin-network"></i>
                                <input type="text" id="sydney-pro-upgrade-key" class="sydney-pro-upgrade-key" placeholder="<?php echo esc_attr__( 'Enter your license key here', 'sydney' ); ?>" aria-label="<?php echo esc_attr__( 'License key', 'sydney' ); ?>" />
                            </div>
                            <button type="submit" class="button sydney-pro-upgrade-start"><?php echo esc_html__( 'Install & activate', 'sydney' ); ?></button>
                            <button type="button" class="sydney-pro-upgrade-cancel"><?php echo esc_html__( 'Cancel', 'sydney' ); ?></button>
                        </form>
                        <div class="sydney-pro-upgrade-error" role="alert" hidden></div>
                        <p class="bt-text-color-grey sydney-pro-upgrade-note"><?php echo esc_html__( 'This installs and activates Sydney Pro automatically. Your settings and content stay as they are.', 'sydney' ); ?></p>
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

                    <?php require get_template_directory() . '/inc/dashboard/html-pro-upgrade-modal.php'; ?>
                <?php endif; ?>
            </div>

        <?php endif; ?>

</div>
<!-- End License Section -->

