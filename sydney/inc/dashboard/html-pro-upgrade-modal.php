<?php

/**
 * Sydney Pro upgrade progress popup (running, success, error).
 *
 * Rendered by html-settings-general.php inside Sydney_Dashboard, so $this is
 * the dashboard. sydney-dashboard.js moves it to <body> and drives it.
 *
 * @package Dashboard
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// null from get_plugin_status() means the user cannot install plugins
// (DISALLOW_FILE_MODS, or a role without install_plugins): offer Starter Sites
// only when the plugin is already active then.
$sydney_atss_status      = $this->get_plugin_status( $this->settings['starter_plugin_path'] );
$sydney_atss_active      = null === $sydney_atss_status
    ? in_array( $this->settings['starter_plugin_path'], (array) get_option( 'active_plugins', array() ), true )
    : 'active' === $sydney_atss_status;
$sydney_atss_installable = ! $sydney_atss_active && null !== $sydney_atss_status;

?>

<div class="sydney-pro-upgrade-modal-overlay" hidden>
    <div class="sydney-pro-upgrade-modal" role="dialog" aria-modal="true" aria-labelledby="sydney-pro-upgrade-modal-running-label" tabindex="-1">

        <!-- Running -->
        <div class="sydney-pro-upgrade-modal__running">
            <svg class="sydney-pro-upgrade-modal__spinner" aria-hidden="true" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M34 18C34 15.8989 33.5861 13.8183 32.7821 11.8771C31.978 9.93586 30.7994 8.17203 29.3137 6.68629C27.828 5.20055 26.0641 4.022 24.1229 3.21793C22.1817 2.41385 20.1011 2 18 2C15.8988 2 13.8183 2.41385 11.8771 3.21793C9.93585 4.022 8.17203 5.20055 6.68629 6.68629C5.20055 8.17203 4.022 9.93586 3.21793 11.8771C2.41385 13.8183 2 15.8989 2 18" stroke="url(#sydney-pro-spinner-progress-0)" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" stroke-dasharray="0.1 8"/>
                <path d="M3.21793 24.1229C4.022 26.0641 5.20055 27.828 6.68629 29.3137C8.17203 30.7994 9.93585 31.978 11.8771 32.7821C13.8183 33.5861 15.8988 34 18 34C20.1011 34 22.1817 33.5861 24.1229 32.7821C26.0641 31.978 27.828 30.7994 29.3137 29.3137C30.7994 27.828 31.978 26.0641 32.7821 24.1229" stroke="url(#sydney-pro-spinner-progress-1)" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" stroke-dasharray="0.1 8"/>
                <defs>
                    <linearGradient id="sydney-pro-spinner-progress-0" x1="34" y1="18" x2="2" y2="18" gradientUnits="userSpaceOnUse">
                        <stop stop-color="currentColor"/>
                        <stop offset="1" stop-color="currentColor" stop-opacity="0.5"/>
                    </linearGradient>
                    <linearGradient id="sydney-pro-spinner-progress-1" x1="33" y1="23.5" x2="3" y2="24" gradientUnits="userSpaceOnUse">
                        <stop stop-opacity="0" stop-color="currentColor"/>
                        <stop offset="1" stop-color="currentColor" stop-opacity="0.48"/>
                    </linearGradient>
                </defs>
            </svg>
            <span class="sydney-pro-upgrade-modal__text">
                <span id="sydney-pro-upgrade-modal-running-label" class="sydney-pro-upgrade-modal__running-label"></span>
                <span class="sydney-pro-upgrade-modal__running-sub"><span class="sydney-pro-upgrade-modal__counter"></span> &middot; <?php echo esc_html__( 'Please keep this window open', 'sydney' ); ?></span>
            </span>
        </div>

        <!-- Success -->
        <div class="sydney-pro-upgrade-modal__success">
            <div class="sydney-pro-upgrade-modal__check" aria-hidden="true"></div>
            <h2 id="sydney-pro-upgrade-modal-title" class="sydney-pro-upgrade-modal__title"><?php echo esc_html__( 'Sydney Pro Installed Successfully', 'sydney' ); ?></h2>
            <p class="sydney-pro-upgrade-modal__desc"><?php echo esc_html__( 'It&#8217;s now your active theme. Here are a few good places to start:', 'sydney' ); ?></p>
            <div class="sydney-pro-upgrade-modal__links">
                <?php if ( $sydney_atss_active || $sydney_atss_installable ) : ?>
                    <a href="<?php echo esc_url( admin_url( 'admin.php?page=atss-onboarding-wizard' ) ); ?>" class="sydney-pro-upgrade-modal__link sydney-dashboard-feature-card<?php echo $sydney_atss_installable ? ' sydney-pro-upgrade-modal__link--needs-plugin' : ''; ?>"<?php if ( $sydney_atss_installable ) : ?> data-slug="<?php echo esc_attr( $this->settings['starter_plugin_slug'] ); ?>" data-path="<?php echo esc_attr( $this->settings['starter_plugin_path'] ); ?>"<?php endif; ?>>
                        <span class="sydney-pro-upgrade-modal__link-text">
                            <span class="sydney-pro-upgrade-modal__link-title"><?php echo esc_html__( 'Starter Sites', 'sydney' ); ?></span>
                            <span class="sydney-pro-upgrade-modal__link-sub"><?php echo esc_html__( 'Import a ready-made site design', 'sydney' ); ?></span>
                            <?php if ( $sydney_atss_installable ) : ?><span class="sydney-pro-upgrade-modal__link-error" role="alert"></span><?php endif; ?>
                        </span>
                        <span class="sydney-pro-upgrade-modal__link-arrow" aria-hidden="true"></span>
                        <?php if ( $sydney_atss_installable ) : ?><svg class="sydney-pro-upgrade-modal__link-spinner" aria-hidden="true" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M34 18C34 15.8989 33.5861 13.8183 32.7821 11.8771C31.978 9.93586 30.7994 8.17203 29.3137 6.68629C27.828 5.20055 26.0641 4.022 24.1229 3.21793C22.1817 2.41385 20.1011 2 18 2C15.8988 2 13.8183 2.41385 11.8771 3.21793C9.93585 4.022 8.17203 5.20055 6.68629 6.68629C5.20055 8.17203 4.022 9.93586 3.21793 11.8771C2.41385 13.8183 2 15.8989 2 18" stroke="url(#sydney-pro-spinner-link-0)" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" stroke-dasharray="0.1 8"/><path d="M3.21793 24.1229C4.022 26.0641 5.20055 27.828 6.68629 29.3137C8.17203 30.7994 9.93585 31.978 11.8771 32.7821C13.8183 33.5861 15.8988 34 18 34C20.1011 34 22.1817 33.5861 24.1229 32.7821C26.0641 31.978 27.828 30.7994 29.3137 29.3137C30.7994 27.828 31.978 26.0641 32.7821 24.1229" stroke="url(#sydney-pro-spinner-link-1)" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" stroke-dasharray="0.1 8"/><defs><linearGradient id="sydney-pro-spinner-link-0" x1="34" y1="18" x2="2" y2="18" gradientUnits="userSpaceOnUse"><stop stop-color="currentColor"/><stop offset="1" stop-color="currentColor" stop-opacity="0.5"/></linearGradient><linearGradient id="sydney-pro-spinner-link-1" x1="33" y1="23.5" x2="3" y2="24" gradientUnits="userSpaceOnUse"><stop stop-opacity="0" stop-color="currentColor"/><stop offset="1" stop-color="currentColor" stop-opacity="0.48"/></linearGradient></defs></svg><?php endif; ?>
                    </a>
                <?php endif; ?>
                <a href="<?php echo esc_url( wp_nonce_url( add_query_arg( array( 'page' => 'sydney-dashboard', 'tab' => 'builder', 'activate_module_templates' => 1 ), admin_url( 'admin.php' ) ), 'sydney_modules_nonce' ) ); ?>" class="sydney-pro-upgrade-modal__link sydney-dashboard-feature-card">
                    <span class="sydney-pro-upgrade-modal__link-text">
                        <span class="sydney-pro-upgrade-modal__link-title"><?php echo esc_html__( 'Template Builder', 'sydney' ); ?></span>
                        <span class="sydney-pro-upgrade-modal__link-sub"><?php echo esc_html__( 'Build headers, footers and layouts', 'sydney' ); ?></span>
                    </span>
                    <span class="sydney-pro-upgrade-modal__link-arrow" aria-hidden="true"></span>
                </a>
                <a href="<?php echo esc_url( admin_url( 'admin.php?page=sydney-dashboard&tab=home#sydney-pro-modules' ) ); ?>" class="sydney-pro-upgrade-modal__link sydney-dashboard-feature-card">
                    <span class="sydney-pro-upgrade-modal__link-text">
                        <span class="sydney-pro-upgrade-modal__link-title"><?php echo esc_html__( 'Pro Modules', 'sydney' ); ?></span>
                        <span class="sydney-pro-upgrade-modal__link-sub"><?php echo esc_html__( 'Mega menus, custom fonts and more', 'sydney' ); ?></span>
                    </span>
                    <span class="sydney-pro-upgrade-modal__link-arrow" aria-hidden="true"></span>
                </a>
            </div>
            <div class="sydney-pro-upgrade-modal__actions">
                <button type="button" class="button button-primary sydney-pro-upgrade-modal__ok"><?php echo esc_html__( 'OK', 'sydney' ); ?></button>
            </div>
        </div>

        <!-- Error -->
        <div class="sydney-pro-upgrade-modal__error">
            <div class="sydney-pro-upgrade-modal__error-line">
                <span class="sydney-pro-upgrade-modal__x" aria-hidden="true"></span>
                <span class="sydney-pro-upgrade-modal__text">
                    <span id="sydney-pro-upgrade-modal-error-label" class="sydney-pro-upgrade-modal__error-label"><?php echo esc_html__( 'Installation failed', 'sydney' ); ?></span>
                    <span class="sydney-pro-upgrade-modal__error-sub"></span>
                </span>
            </div>
            <div class="sydney-pro-upgrade-modal__message"></div>
            <div class="sydney-pro-upgrade-modal__actions sydney-pro-upgrade-modal__actions--split">
                <button type="button" class="button sydney-pro-upgrade-modal__close"><?php echo esc_html__( 'Close', 'sydney' ); ?></button>
                <button type="button" class="button button-primary sydney-pro-upgrade-modal__retry"><?php echo esc_html__( 'Try again', 'sydney' ); ?></button>
            </div>
        </div>

    </div>
</div>
