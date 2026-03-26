<?php

/**
 *
 * Hero
 * @package Dashboard
 *
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

global $pagenow;

$screen = get_current_screen(); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound
$user   = wp_get_current_user(); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound
$transient = sprintf('%s_hero_notice', get_template());
?>

<?php if (!get_transient($transient)) : ?>
<div class="sydney-dashboard-hero">
	<div class="sydney-dashboard-dismissable" data-notice="<?php echo esc_attr($transient); ?>">
		<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 8C0 3.59375 3.5625 0 8 0C12.4062 0 16 3.59375 16 8C16 12.4375 12.4062 16 8 16C3.5625 16 0 12.4375 0 8ZM5.46875 6.53125L6.9375 8L5.46875 9.46875C5.15625 9.78125 5.15625 10.25 5.46875 10.5312C5.75 10.8438 6.21875 10.8438 6.5 10.5312L7.96875 9.0625L9.46875 10.5312C9.75 10.8438 10.2188 10.8438 10.5 10.5312C10.8125 10.25 10.8125 9.78125 10.5 9.46875L9.03125 8L10.5 6.53125C10.8125 6.25 10.8125 5.78125 10.5 5.46875C10.2188 5.1875 9.75 5.1875 9.46875 5.46875L7.96875 6.96875L6.5 5.46875C6.21875 5.1875 5.75 5.1875 5.46875 5.46875C5.15625 5.78125 5.15625 6.25 5.46875 6.53125Z" fill="#A7AAAD"/></svg>
	</div>
	<div class="sydney-dashboard-hero-content">

		<div class="sydney-dashboard-hero-hello">
			<?php esc_html_e('Hello, ', 'sydney'); ?>
			<?php echo esc_html($user->display_name); ?>
			<?php esc_html_e('👋🏻', 'sydney'); ?>
		</div>

		<div class="sydney-dashboard-hero-title">
			<?php echo wp_kses_post($this->settings['hero_title']); ?>
			<?php if ($this->settings['has_pro']) { ?>
				<sup class="sydney-dashboard-hero-badge sydney-dashboard-hero-badge-pro">pro</sup>
			<?php } else { ?>
				<sup class="sydney-dashboard-hero-badge sydney-dashboard-hero-badge-free">free</sup>
			<?php } ?>
		</div>

		<div class="sydney-dashboard-hero-desc">
			<?php echo wp_kses_post($this->settings['hero_desc']); ?>
		</div>


			<div class="sydney-dashboard-hero-actions">
				<?php if ( in_array( $this->get_plugin_status( $this->settings['starter_plugin_path'] ), array( 'inactive', 'not_installed' ), true ) ) : ?>
					<a href="<?php echo esc_url(add_query_arg(array( 'page' => 'atss-onboarding-wizard' ), admin_url('admin.php'))); ?>" class="button button-primary sydney-dashboard-plugin-ajax-button sydney-ajax-success-redirect" data-type="install" data-path="<?php echo esc_attr($this->settings['starter_plugin_path']); ?>" data-slug="<?php echo esc_attr($this->settings['starter_plugin_slug']); ?>">
						<?php esc_html_e('Start Building With Templates', 'sydney'); ?>
					</a>
				<?php elseif ( 'active' === $this->get_plugin_status( $this->settings['starter_plugin_path'] ) && empty( get_option( 'atss_current_starter' ) ) && empty( get_option( 'atss_wizard_state' ) ) ) : ?>
					<a href="<?php echo esc_url(add_query_arg(array( 'page' => 'atss-onboarding-wizard' ), admin_url('admin.php'))); ?>" class="button button-primary sydney-dashboard-hero-button">
						<?php esc_html_e('Start Building With Templates', 'sydney'); ?>
					</a>
				<?php elseif ( 'active' === $this->get_plugin_status( $this->settings['starter_plugin_path'] ) && ! empty( get_option( 'atss_wizard_state' ) ) ) : ?>
					<a href="<?php echo esc_url(add_query_arg(array( 'page' => 'atss-onboarding-wizard' ), admin_url('admin.php'))); ?>" class="button button-primary sydney-dashboard-hero-button">
						<?php esc_html_e('Resume wizard', 'sydney'); ?>
					</a>				
				<?php else : ?>
					<a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="button button-primary" target="_blank">
						<?php echo esc_html__( 'Start Customizing', 'sydney' ); ?>
					</a>
				<?php endif; ?>
			</div>

			<?php if ('active' !== $this->get_plugin_status($this->settings['starter_plugin_path'])) : ?>
				<div class="sydney-dashboard-hero-notion">
					<?php esc_html_e('Clicking "Start Building With Templates" button will install and activate the Sydney \'aThemes Starter Sites\' plugin.', 'sydney'); ?>
				</div>
			<?php endif; ?>
	</div>

	<div class="sydney-dashboard-hero-image">
		<img src="<?php echo esc_url($this->settings['hero_image']); ?>">
	</div>

</div>
<?php endif; ?>