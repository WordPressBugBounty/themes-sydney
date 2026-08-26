<?php

/**
 * Notifications Sidebar
 * 
 * @package Dashboard
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>

<div class="sydney-dashboard-notifications-sidebar">
    <a href="#" class="sydney-dashboard-notifications-sidebar-close" title="<?php echo esc_attr__( 'Close the sidebar', 'sydney' ); ?>">
        <?php echo sydney_dashboard_icon( 'close', 20 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
    </a>
    <div class="sydney-dashboard-notifications-sidebar-inner">

        <div class="sydney-dashboard-notifications-sidebar-header">
            <div class="sydney-dashboard-notifications-sidebar-header-icon">
                <?php echo sydney_dashboard_icon( 'bell', 24, 'sydney-svg-accent' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
            </div>
            <div class="sydney-dashboard-notifications-sidebar-header-content">
                <h3>
                    <?php 
                    if( $notification_read ) {
                        echo esc_html__( 'Changelog', 'sydney' );
                    } else {
                        echo esc_html__( 'New Update', 'sydney' );
                    } ?>
                </h3>
            </div>
        </div>
        <?php if( $this->settings[ 'notifications_tabs' ] ) : ?>
            <div class="sydney-dashboard-notifications-sidebar-tabs">
                <nav class="sydney-dashboard-tabs-nav sydney-dashboard-tabs-nav-no-negative-margin" data-tab-wrapper-id="notifications-sidebar">
                    <ul>
                        <li class="sydney-dashboard-tabs-nav-item active">
                            <a href="#" class="sydney-dashboard-tabs-nav-link" data-tab-to="notifications-sidebar-sydney">
                                <?php echo esc_html__( 'Sydney', 'sydney' ); ?>
                            </a>
                        </li>
                        <li class="sydney-dashboard-tabs-nav-item">
                            <a href="#" class="sydney-dashboard-tabs-nav-link" data-tab-to="notifications-sidebar-sydney-pro">
                                <?php echo esc_html__( 'Sydney Pro', 'sydney' ); ?>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        <?php endif; ?>
        <div class="sydney-dashboard-notifications-sidebar-body sydney-dashboard-tab-content-wrapper" data-tab-wrapper-id="notifications-sidebar">
            <div class="sydney-dashboard-tab-content active" data-tab-content-id="notifications-sidebar-sydney">
                <?php 
                
                if( isset( $this->settings[ 'notifications' ] ) && $this->settings[ 'notifications' ] ) : 
                    $display_version = true;

                    ?>

                    <?php foreach( $this->settings[ 'notifications' ] as $notification ) : 
                        $date    = isset( $notification->post_date ) ? $notification->post_date : false;
                        $version = isset( $notification->post_title ) ? $notification->post_title : false;
                        $content = isset( $notification->post_content ) ? $notification->post_content : false;
                        
                        ?>

                        <div class="sydney-dashboard-notification">
                            <?php if ( $date ) : ?>
                                <span class="sydney-dashboard-notification-date" data-raw-date="<?php echo esc_attr( $date ); ?>">
                                    <?php if ( $display_version ) : ?>
                                        <h3 class="sydney-dashboard-notification-version"><?php echo esc_html( $version ); ?></h3>
                                    <?php endif; ?>
                                    <?php printf( '(%s)', esc_html( date_format( date_create( $date ), 'F j, Y' ) ) ); ?>
                                </span>
                            <?php endif; ?>
                            <?php if ( $content ) : ?>
                                <div class="sydney-dashboard-notification-content">
                                    <?php echo wp_kses_post( $content ); ?>
                                </div>
                            <?php endif; ?>
                        </div>

                    <?php 
                        $display_version = true;
                    endforeach; ?>

                <?php else : ?>

                    <div class="sydney-dashboard-notification">
                        <div class="sydney-dashboard-notification-content">
                            <p class="changelog-description"><?php echo esc_html__( 'No notifications found', 'sydney' ); ?></p>
                        </div>
                    </div>

                <?php 
                endif; ?>

            </div>

            <?php if( $this->settings[ 'notifications_tabs' ] ) : ?>
            <div class="sydney-dashboard-tab-content" data-tab-content-id="notifications-sidebar-sydney-pro">
                <?php 
                
                if( isset( $this->settings[ 'notifications_pro' ] ) && $this->settings[ 'notifications_pro' ] ) : 
                    $display_version = false;

                    ?>

                    <?php foreach( $this->settings[ 'notifications_pro' ] as $notification ) : 
                        $date    = isset( $notification->date ) ? $notification->date : false;
                        $version = isset( $notification->title->rendered ) ? $notification->title->rendered : false;
                        $content = isset( $notification->content->rendered ) ? $notification->content->rendered : false;
                        
                        ?>

                        <div class="sydney-dashboard-notification">
                            <?php if( $date ) : ?>
                                <span class="sydney-dashboard-notification-date">
                                    <?php echo esc_html( date_format( date_create( $date ), 'F j, Y' ) ); ?>
                                    <?php if( $display_version ) : ?>
                                        <span class="sydney-dashboard-notification-version"><?php printf( '(%s)', esc_html( $version ) ); ?></span>
                                    <?php endif; ?>
                                </span>
                            <?php endif; ?>
                            <?php if( $content ) : ?>
                                <div class="sydney-dashboard-notification-content">
                                    <?php echo wp_kses_post( $content ); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php 
                        $display_version = true;
                    endforeach; ?>

                <?php else : ?>

                    <div class="sydney-dashboard-notification">
                        <div class="sydney-dashboard-notification-content">
                            <p class="changelog-description"><?php echo esc_html__( 'No notifications found', 'sydney' ); ?></p>
                        </div>
                    </div>

                <?php 
                endif; ?>

            </div>
            <?php endif; ?>

        </div>

    </div>
</div>