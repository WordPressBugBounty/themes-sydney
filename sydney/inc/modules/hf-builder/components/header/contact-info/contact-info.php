<?php
/**
 * Header/Footer Builder
 * Contact Info Component
 *
 * @package Sydney_Pro
 */ ?>

<div class="shfb-builder-item shfb-component-contact_info" data-component-id="contact_info">
    <?php
    $this->customizer_edit_button();

    // The .header-contact block lives in contact_info_markup() so the
    // selective refresh partial renders exactly what the front end renders.
    $this->contact_info_markup();
    ?>
</div>
