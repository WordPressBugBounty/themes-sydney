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
		<?php echo sydney_dashboard_icon( 'close', 20 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
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
						<?php esc_html_e("Let's Get Started", 'sydney'); ?>
					</a>
				<?php elseif ( 'active' === $this->get_plugin_status( $this->settings['starter_plugin_path'] ) && empty( get_option( 'atss_current_starter' ) ) && empty( get_option( 'atss_wizard_state' ) ) ) : ?>
					<a href="<?php echo esc_url(add_query_arg(array( 'page' => 'atss-onboarding-wizard' ), admin_url('admin.php'))); ?>" class="button button-primary sydney-dashboard-hero-button">
						<?php esc_html_e("Let's Get Started", 'sydney'); ?>
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
				<div class="sydney-dashboard-hero-notion bt-text-color-grey bt-mt-2">
					<?php esc_html_e('Clicking "Let\'s Get Started" button will install and activate the Sydney \'aThemes Starter Sites\' plugin.', 'sydney'); ?>
				</div>
			<?php endif; ?>
	</div>

	<div class="sydney-dashboard-hero-image">
		<img src="<?php echo esc_url($this->settings['hero_image']); ?>">
	</div>

</div>
<?php endif; ?>