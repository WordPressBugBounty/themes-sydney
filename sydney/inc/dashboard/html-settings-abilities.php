<?php
/**
 * Settings - AI Abilities
 *
 * A single option row with a mode dropdown (Off / Read-only / Read & write) on
 * the right that maps to the two gating options, plus a "Connect external AI
 * clients" row that installs the Vibe AI plugin (reusing the dashboard's
 * plugin-ajax link). No divider between the two rows.
 *
 * @package Sydney
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Sydney_Abilities' ) ) {
	require_once get_template_directory() . '/inc/abilities/class-sydney-abilities.php';
}

// Current mode derived through the same filtered accessors that gate
// registration — a plugin filter enabling the gates at runtime must show
// here, not the raw options.
$sydney_ai_enabled = Sydney_Abilities::is_enabled();
$sydney_ai_writes  = Sydney_Abilities::writes_enabled();
$sydney_ai_mode    = ! $sydney_ai_enabled ? 'off' : ( $sydney_ai_writes ? 'write' : 'read' );

$sydney_ai_modes = array(
	'off'   => esc_html__( 'Off', 'sydney' ),
	'read'  => esc_html__( 'Read-only', 'sydney' ),
	'write' => esc_html__( 'Read & write', 'sydney' ),
);

// Vibe AI plugin (the external MCP bridge). Status drives the install link.
$sydney_vibe_path   = 'vibe-ai/vibe-ai.php';
$sydney_vibe_status = method_exists( $this, 'get_plugin_status' ) ? $this->get_plugin_status( $sydney_vibe_path ) : 'not_installed';

// After a successful install/activate, send the user to Vibe AI's settings page.
$sydney_vibe_settings_url = admin_url( 'admin.php?page=vibe-ai' );

?>

<!-- AI Abilities Section -->
<div class="sydney-dashboard-card-section bt-mt-5">
	<div class="sydney-dashboard-module-card">

		<h2 class="bt-m-0 bt-mb-5 bt-inline-flex-center" style="gap:var(--sydney-dashboard-space-1);">
			<?php echo esc_html__( 'AI Abilities', 'sydney' ); ?>
			<svg class="sydney-svg-accent" width="20" height="20" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M8.66666 4.66666L6 3.66666L8.66666 2.66566L9.66666 0L10.6676 2.66566L13.3333 3.66666L10.6676 4.66666L9.66666 7.33331L8.66666 4.66666ZM3.33331 10L0 8.66666L3.33331 7.33331L4.66666 4L6 7.33331L9.33331 8.66666L6 10L4.66666 13.3333L3.33331 10Z" fill="currentColor"/>
			</svg>
		</h2>

		<div class="sydney-dashboard-module-card-header bt-align-items-center">
			<div class="sydney-dashboard-module-card-header-info">
				<p class="bt-text-color-grey bt-m-0"><?php esc_html_e( 'Let AI assistants read and update Sydney settings, import starter sites, and build pages with the Sydney Pattern Library through the WordPress Abilities API. Off by default.', 'sydney' ); ?> <a href="https://docs.athemes.com/article/abilities-in-sydney/" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'See example prompts', 'sydney' ); ?></a></p>
			</div>
			<div class="sydney-dashboard-module-card-header-actions bt-pt-0">
				<div class="sydney-dashboard-box-link bt-flex-center" style="gap:var(--sydney-dashboard-space-4); flex-wrap:wrap;">
					<?php foreach ( $sydney_ai_modes as $sydney_mode_value => $sydney_mode_label ) : ?>
						<label class="bt-inline-flex-center bt-m-0" style="gap:var(--sydney-dashboard-space-1); cursor:pointer; white-space:nowrap;">
							<input
								type="radio"
								name="sydney-abilities-mode"
								class="sydney-abilities-mode-radio bt-m-0"
								value="<?php echo esc_attr( $sydney_mode_value ); ?>"
								<?php checked( $sydney_ai_mode, $sydney_mode_value ); ?>
							/>
							<span><?php echo esc_html( $sydney_mode_label ); ?></span>
						</label>
					<?php endforeach; ?>
					<span class="sydney-abilities-mode-feedback bt-text-color-grey" style="display:none; font-size:12px;"></span>
				</div>
			</div>
		</div>

		<div class="sydney-abilities-writes-warning" style="margin-top:var(--sydney-dashboard-space-4); padding:var(--sydney-dashboard-space-2) var(--sydney-dashboard-space-3); border-radius:var(--sydney-dashboard-radius-sm); color:var(--sydney-dashboard-danger); background-color:var(--sydney-dashboard-danger-tint);<?php echo ( 'write' === $sydney_ai_mode ) ? '' : ' display:none;'; ?>">
			<?php esc_html_e( 'Write access is enabled: every logged-in user who can edit theme options — including AI clients connected over REST or MCP — can change theme settings, install recommended plugins, and create pages on this site.', 'sydney' ); ?>
		</div>

		<div class="sydney-dashboard-module-card-header bt-mt-5 bt-align-items-end">
			<div class="sydney-dashboard-module-card-header-info">
				<p class="bt-text-color-grey bt-m-0"><?php esc_html_e( '[Optional] Install Vibe AI to expose these abilities over MCP, so clients like Claude, ChatGPT, and Cursor can connect.', 'sydney' ); ?></p>
			</div>
			<div class="sydney-dashboard-module-card-header-actions bt-pt-0">
				<div class="sydney-dashboard-box-link">
					<?php if ( 'active' === $sydney_vibe_status ) : ?>
						<span class="sydney-dashboard-external-link sydney-dashboard-link-success">
							<?php echo esc_html__( 'Vibe AI active', 'sydney' ); ?>
						</span>
					<?php elseif ( 'inactive' === $sydney_vibe_status ) : ?>
						<a href="<?php echo esc_url( $sydney_vibe_settings_url ); ?>" class="sydney-dashboard-external-link sydney-dashboard-link-success sydney-dashboard-plugin-ajax-button sydney-ajax-success-redirect" data-type="activate" data-path="<?php echo esc_attr( $sydney_vibe_path ); ?>" data-slug="vibe-ai">
							<?php echo esc_html__( 'Activate Vibe AI', 'sydney' ); ?>
						</a>
					<?php else : ?>
						<a href="<?php echo esc_url( $sydney_vibe_settings_url ); ?>" class="sydney-dashboard-external-link sydney-dashboard-link-success sydney-dashboard-plugin-ajax-button sydney-ajax-success-redirect" data-type="install" data-path="<?php echo esc_attr( $sydney_vibe_path ); ?>" data-slug="vibe-ai">
							<?php echo esc_html__( 'Install Vibe AI', 'sydney' ); ?>
						</a>
					<?php endif; ?>
				</div>
			</div>
		</div>

	</div>

	<script>
( function ( $ ) {
	$( document ).on( 'change', '.sydney-abilities-mode-radio', function () {
		var $radios   = $( '.sydney-abilities-mode-radio' );
		var $feedback = $( '.sydney-abilities-mode-feedback' );
		var mode      = $( this ).val();

		$radios.prop( 'disabled', true );
		$feedback.hide();

		$.post( window.sydney_dashboard.ajax_url, {
			action: 'sydney_abilities_mode',
			nonce: window.sydney_dashboard.nonce,
			mode: mode
		} ).done( function ( response ) {
			if ( ! response || ! response.success ) {
				$feedback.text( window.sydney_dashboard.i18n.failed_message ).show();
			} else {
				$( '.sydney-abilities-writes-warning' ).toggle( 'write' === mode );
			}
		} ).fail( function () {
			$feedback.text( window.sydney_dashboard.i18n.failed_message ).show();
		} ).always( function () {
			$radios.prop( 'disabled', false );
		} );
	} );
}( jQuery ) );
	</script>
</div>
<!-- End AI Abilities Section -->
