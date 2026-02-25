<?php

/**
 * Settings Tab
 * 
 * @package Dashboard
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>

<div class="sydney-dashboard-row">
    <div class="sydney-dashboard-column">
        <div class="sydney-dashboard-card sydney-dashboard-card-top-spacing">
            <div class="sydney-dashboard-card-body sydney-dashboard-card-body-content-with-dividers">

                <?php 
                // Load License section.
                require get_template_directory() . '/inc/dashboard/html-settings-general.php';
                ?>

                <?php 
                // Load Misc section (Usage Tracking).
                require get_template_directory() . '/inc/dashboard/html-settings-misc.php';
                ?>

            </div>
        </div>
    </div>
</div>
