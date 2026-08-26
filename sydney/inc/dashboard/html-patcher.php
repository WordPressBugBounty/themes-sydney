<?php

/**
 * Patcher HTML
 *
 * @package Sydney
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

wp_enqueue_script( 'sydney-plugin-installer' );

?>

<style>
    .sydney-dashboard-alert {
        background-color: var(--sydney-dashboard-surface-sunken-light);
        border: 1px solid var(--sydney-dashboard-border);
        border-radius: 6px;
        padding: var(--sydney-dashboard-space-5);
        margin: 0 0 var(--sydney-dashboard-space-5);
        box-shadow: var(--sydney-dashboard-shadow-sm);
    }

    .sydney-dashboard-alert p {
        margin: 0
    }

    .sydney-dashboard-alert.sydney-dashboard-alert-with-icon {
        position: relative;
        padding-left: var(--sydney-dashboard-space-12)
    }

    .sydney-dashboard-alert.sydney-dashboard-alert-with-icon .alert-icon {
        position: absolute;
        top: 21px;
        left: 20px
    }


    .sydney-dashboard-alert.sydney-dashboard-alert-with-upsell-link {
        padding-right: var(--sydney-dashboard-space-40)
    }

    .sydney-dashboard-alert.sydney-dashboard-alert-with-upsell-link .sydney-dashboard-external-link {
        position: absolute;
        top: 22px;
        right: 20px
    }

    h2 {
        margin-block-end: var(--sydney-dashboard-space-2);
    }

    p {
        color: #757575;
    }

    #athemes-patcher-options-page {
        max-width: 1280px;
        margin: 0 auto;
        padding: var(--sydney-dashboard-space-6) var(--sydney-dashboard-space-6) var(--sydney-dashboard-space-6) 0;
    }

    .athemes-patcher-info-badge {
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-align-items: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        gap: var(--sydney-dashboard-space-2);
        color: #444;
        background-color: var(--sydney-dashboard-primary-tint);
        padding: var(--sydney-dashboard-space-3);
        border-radius: 7px;
        -webkit-text-decoration: none;
        text-decoration: none;
    }

    .athemes-patcher-info-badge:hover {
        color: #212121;
    }


    .components-panel__body {
        border: 0;
    }

    .athemes-patcher-card-title {
        font-size: 16px;
        font-weight: 600;
        margin-block-start: 0;
        margin-block-end: var(--sydney-dashboard-space-2);
    }

    .athemes-patcher-card-desc {
        color: #757575;
        margin-block-start: 0;
        margin-block-end: var(--sydney-dashboard-space-5);
    }

    .athemes-patcher-card {
        background-color: var(--sydney-dashboard-surface);
        box-shadow: var(--sydney-dashboard-shadow-sm);
        border-radius: 7px;
    }

    .athemes-patcher-card+.athemes-patcher-card {
        margin-block-start: var(--sydney-dashboard-space-5);
    }

    .athemes-patchers-table thead tr:first-of-type {
        border-top: 0;
    }

    .athemes-patchers-table tr {
        border-top: 1px solid var(--sydney-dashboard-border);
    }

    .athemes-patchers-table td,
    .athemes-patchers-table th {
        padding: var(--sydney-dashboard-space-2) 0;
    }

    .athemes-patchers-table th:first-of-type,
    .athemes-patchers-table th:last-of-type {
        width: 150px;
    }

    .athemes-patchers-table td {
        color: #444;
    }

    .css-1hdyajo {
        padding: var(--sydney-dashboard-space-5);
    }

    .css-3nngo0 {
        margin-block-start: 0;
        margin-block-end: var(--sydney-dashboard-space-5);
    }

    .css-1qudilh {
        background-color: var(--sydney-dashboard-surface-sunken-light);
        padding: var(--sydney-dashboard-space-5);
        border-radius: 7px;
        text-align: center;
    }

    .css-1yscn4x {
        margin-top: var(--sydney-dashboard-space-5);
    }

    .css-12dj36i {
        border-radius: 7px;
    }

    .css-13h15nb {
        background-color: var(--sydney-dashboard-surface-sunken-light);
        padding: var(--sydney-dashboard-space-5);
        border-radius: 7px;
        text-align: left;
    }

    .css-18si9r1 {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
    }

    .css-wpjqd {
        display: -webkit-inline-box;
        display: -webkit-inline-flex;
        display: -ms-inline-flexbox;
        display: inline-flex;
        -webkit-align-items: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        gap: var(--sydney-dashboard-space-1);
        background-color: transparent !important;
        color: var(--sydney-dashboard-primary) !important;
        border-radius: 4px;
        border: 2px solid var(--sydney-dashboard-primary);
    }

    .css-wpjqd:hover {
        background-color: var(--sydney-dashboard-primary);
        color: var(--sydney-dashboard-on-accent) !important;
    }

    .css-wpjqd:disabled {
        color: var(--sydney-dashboard-primary) !important;
        border: 2px solid var(--sydney-dashboard-primary);
    }

    .css-adm54n{display:-webkit-inline-box;display:-webkit-inline-flex;display:-ms-inline-flexbox;display:inline-flex;-webkit-align-items:center;-webkit-box-align:center;-ms-flex-align:center;align-items:center;gap:5px;background-color:var(--sydney-dashboard-primary);color:var(--sydney-dashboard-on-accent)!important;border-radius:4px;}

</style>
<div id="athemes-patcher-options-page">
    <?php if ( ! defined( 'SYDNEY_PRO_VERSION' ) ) : ?>
        <div class="sydney-dashboard-alert sydney-dashboard-alert-warning sydney-dashboard-alert-with-icon sydney-dashboard-alert-with-upsell-link">
            <div class="alert-icon">
                <?php echo sydney_dashboard_icon( 'caution', 20 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
            </div>
            <p class="bt-text-color-grey"><?php echo esc_html__( 'Please note this feature is available only in Sydney Pro', 'sydney' ); ?></p>
            <a href="<?php echo esc_url( sydney_admin_upgrade_link( 'https://athemes.com/sydney-upgrade', array( 'utm_source' => 'athemes-patcher', 'utm_medium' => 'link', 'utm_campaign' => 'Sydney' ), 'dashboard-patcher-upgrade-link' ) ); ?>" class="sydney-dashboard-external-link" target="_blank">
                <?php echo esc_html__( 'Upgrade Now', 'sydney' ); ?>

                <?php echo sydney_dashboard_icon( 'external', 16, 'sydney-svg-accent' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
            </a>
        </div>
    <?php endif; ?>

    <div data-wp-c16t="true" data-wp-component="Card" class="components-surface components-card athemes-patcher-card css-1hdyajo css-1otwcjs e19lxcc00">
        <div class="css-10klw3m e19lxcc00">
            <h2 class="css-3nngo0">aThemes Patcher</h2>
            <p>Welcome to the aThemes Patcher settings page. The Patcher allows you to apply small fixes to your website without the need to await for new releases, keeping your website up to date.</p>
            <a href="https://docs.athemes.com/article/pro-athemes-patcher/" class="athemes-patcher-info-badge" target="_blank">
                <?php echo sydney_dashboard_icon( 'info', 20 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>Learn more about the Patcher </a>
        </div>
        <div data-wp-c16t="true" data-wp-component="Elevation" class="components-elevation css-1w1p2h9 e19lxcc00" aria-hidden="true"></div>
        <div data-wp-c16t="true" data-wp-component="Elevation" class="components-elevation css-1w1p2h9 e19lxcc00" aria-hidden="true"></div>
    </div>
    <div data-wp-c16t="true" data-wp-component="Card" class="components-surface components-card athemes-patcher-card css-1hdyajo css-1otwcjs e19lxcc00">
        <div class="css-10klw3m e19lxcc00">
            <h3 class="athemes-patcher-card-title">Sydney Pro</h3>
            <p class="athemes-patcher-card-desc">The following patches are available for the version <?php echo esc_html( wp_get_theme( 'sydney' )->Version ); ?></p>
            <div data-wp-c16t="true" data-wp-component="CardBody" class="components-card__body components-card-body css-13h15nb css-9ii361 e19lxcc00">
                <table class="athemes-patchers-table css-18si9r1">
                    <thead>
                        <tr>
                            <th>Patch #</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#467</td>
                            <td>Improved performance when loading custom assets during page transitions.</td>
                            <td>
                                <?php if ( defined( 'SYDNEY_PRO_VERSION' ) && ! defined( 'ATHEMES_PATCHER_VERSION' ) ) : ?>
                                    <a class="components-button has-lock-icon css-adm54n sydney-dashboard-pro-tooltip sydney-install-plugin" href="<?php echo esc_url( sydney_admin_upgrade_link( 'https://athemes.com/sydney-upgrade', array( 'utm_source' => 'athemes-patcher', 'utm_medium' => 'link', 'utm_campaign' => 'Sydney' ), 'dashboard-patcher-upgrade-link' ) ); ?>" target="_blank" data-tooltip-message="<?php echo esc_attr__( 'This will install and activate the aThemes Patcher plugin', 'sydney' ); ?>" data-type="external" data-plugin-url="https://patcher.athemes.com/athemes-patcher.zip?nocache=<?php echo esc_attr( time() ); ?>" data-plugin-name="athemes-patcher/athemes-patcher.php" data-redirect-to="<?php echo esc_url( add_query_arg('page', 'athemes-patcher-bp', admin_url('admin.php')) ); ?>">
                                        Install Patcher
                                    </a>
                                <?php else : ?>
                                    <a class="components-button has-lock-icon css-adm54n sydney-dashboard-pro-tooltip" href="<?php echo esc_url( sydney_admin_upgrade_link( 'https://athemes.com/sydney-upgrade', array( 'utm_source' => 'athemes-patcher', 'utm_medium' => 'link', 'utm_campaign' => 'Sydney' ), 'dashboard-patcher-upgrade-link' ) ); ?>" target="_blank" data-tooltip-message="<?php echo esc_attr__( 'This is only available on Sydney Pro', 'sydney' ); ?>">
                                        Apply
                                        <?php echo sydney_dashboard_icon( 'lock', 18 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>#465</td>
                            <td>Updated widget behavior for smoother interactions across multiple devices.</td>
                            <td>
                                <button type="button" disabled="" class="components-button css-wpjqd">Applied <?php echo sydney_dashboard_icon( 'check', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>#463</td>
                            <td>Minor fix to improve admin panel usability. </td>
                            <td>
                                <button type="button" disabled="" class="components-button css-wpjqd">Applied <?php echo sydney_dashboard_icon( 'check', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="css-1yscn4x">
                <div class="css-12dj36i components-panel">
                    <div class="components-panel__body">
                        <h2 class="components-panel__body-title">
                            <button type="button" aria-expanded="false" class="components-button components-panel__body-toggle">
                                <span aria-hidden="true">
                                    <?php echo sydney_dashboard_icon( 'chevron-down', 24, 'components-panel__arrow' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                                </span>Logs </button>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <div data-wp-c16t="true" data-wp-component="Elevation" class="components-elevation css-1w1p2h9 e19lxcc00" aria-hidden="true"></div>
        <div data-wp-c16t="true" data-wp-component="Elevation" class="components-elevation css-1w1p2h9 e19lxcc00" aria-hidden="true"></div>
    </div>
</div>