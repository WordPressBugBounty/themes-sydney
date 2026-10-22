<?php

/**
 * Tabs Nav Items
 * 
 * @package Dashboard
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

?>

<div class="sydney-dashboard-row">
    <div class="sydney-dashboard-column">
        <div class="sydney-dashboard-card sydney-dashboard-card-top-spacing sydney-dashboard-card-tabs-divider">
            <div class="sydney-dashboard-card-body">
                
                <?php if ( in_array( $this->get_plugin_status( $this->settings['starter_plugin_path'] ), array( 'inactive', 'not_installed' ), true ) ) : ?>

                <div class="sydney-dashboard-row">

                    <div class="sydney-dashboard-starter-sites bt-d-block">
                        <div class="sydney-dashboard-starter-sites-locked">
                            <div class="sydney-dashboard-starter-sites-notice">
                                <div class="sydney-dashboard-starter-sites-notice-text"><?php esc_html_e('In order to be able to import any starter sites for Sydney you need to have the aThemes demo importer plugin active.', 'sydney'); ?></div>
                                <?php if ('not_installed' === $this->get_plugin_status($this->settings['starter_plugin_path'])) : ?>
                                    <a href="<?php echo esc_url(add_query_arg(array( 'page' => $this->settings['menu_slug'], 'tab' => 'starter-sites' ), admin_url('themes.php'))); ?>" class="button button-primary sydney-dashboard-plugin-ajax-button sydney-ajax-success-redirect" data-type="install" data-path="<?php echo esc_attr($this->settings['starter_plugin_path']); ?>" data-slug="<?php echo esc_attr($this->settings['starter_plugin_slug']); ?>"><?php esc_html_e('Install and Activate', 'sydney'); ?></a>
                                <?php else : ?>
                                    <a href="<?php echo esc_url(add_query_arg(array( 'page' => $this->settings['menu_slug'], 'tab' => 'starter-sites' ), admin_url('themes.php'))); ?>" class="button button-primary sydney-dashboard-plugin-ajax-button sydney-ajax-success-redirect" data-type="activate" data-path="<?php echo esc_attr($this->settings['starter_plugin_path']); ?>" data-slug="<?php echo esc_attr($this->settings['starter_plugin_slug']); ?>"><?php esc_html_e('Activate', 'sydney'); ?></a>
                                <?php endif; ?>
                            </div>
                        </div>

                        <figure>
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/inc/dashboard/assets/images/startersbg.jpg'); ?>" />
                        </figure>
                    </div>
                </div>

                <?php else : ?>

                <?php if ( ! $this->settings['has_pro'] && $this->settings['starter_counts']['pro'] ) : ?>
                    <div class="sydney-dashboard-starter-sites-pro-row">
                        <p>
                            <?php
                            echo esc_html( sprintf(
                                /* translators: 1: number of Pro starter sites, 2: number of all starter sites */
                                __( '%1$d of %2$d starter sites are Pro. Sydney Pro unlocks all of them, plus the Template Builder. 14-day money-back guarantee.', 'sydney' ),
                                $this->settings['starter_counts']['pro'],
                                $this->settings['starter_counts']['total']
                            ) );
                            ?>
                        </p>
                        <a href="<?php echo esc_url( $this->settings['upgrade_pro_starter_sites'] ); ?>" class="sydney-dashboard-external-link" target="_blank" rel="noopener">
                            <?php esc_html_e( 'Get Sydney Pro', 'sydney' ); ?>
                            <?php echo sydney_dashboard_icon( 'external', 16, 'sydney-svg-accent' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                        </a>
                    </div>
                <?php endif; ?>

                <div class="sydney-dashboard-row">
                    <?php
                    if (has_action('atss_starter_sites')) {
                        do_action('atss_starter_sites'); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound
                    } else {
                        ?>
                        <a href="<?php echo esc_url(add_query_arg(array( 'page' => 'starter-sites' ), admin_url('themes.php'))); ?>" class="button button-primary"><?php esc_html_e('Go to Starter Sites', 'sydney'); ?></a>
                        <?php
                    }
                    ?>
                </div>

                <?php endif; ?>

            </div>
        </div>
    </div>
</div>
