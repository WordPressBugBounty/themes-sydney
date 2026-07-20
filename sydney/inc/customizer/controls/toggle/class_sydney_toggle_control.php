<?php
/**
 * Toggle control
 *
 * @package Sydney
 */

class Sydney_Toggle_Control extends WP_Customize_Control {
	/**
	 * The type of control being rendered
	 */
	public $type = 'sydney-toggle-control';

	public $separator = false;

	/**
	 * Export data to the JS template.
	 */
	public function to_json() {
		parent::to_json();

		$this->json['id']        = $this->id;
		$this->json['value']     = $this->value();
		// Parity with checked( $this->value() ): checked iff (string) value === '1'.
		$this->json['checked']   = ( (string) $this->value() === '1' );
		$this->json['separator'] = $this->separator;
	}

	/**
	 * Rendering is handled by the JS template (content_template).
	 */
	public function render_content() {}

	/**
	 * Underscore template, printed once per control type.
	 */
	public function content_template() {
		?>
		<# if ( 'before' === data.separator ) { #>
			<hr class="sydney-cust-divider before">
		<# } #>

		<div class="toggle-switch-control">
			<div class="toggle-switch">
				<input type="checkbox" id="{{ data.id }}" name="{{ data.id }}" class="toggle-switch-checkbox" value="{{ data.value }}" data-customize-setting-key-link="default" <# if ( data.checked ) { #>checked<# } #>>
				<label class="toggle-switch-label" for="{{ data.id }}" tabindex="0">
					<span class="toggle-switch-inner"></span>
					<span class="toggle-switch-switch"></span>
				</label>
			</div>
			<span class="customize-control-title">{{ data.label }}</span>
			<# if ( data.description ) { #>
				<span class="customize-control-description">{{ data.description }}</span>
			<# } #>
		</div>

		<# if ( 'after' === data.separator ) { #>
			<hr class="sydney-cust-divider">
		<# } #>
		<?php
	}
}