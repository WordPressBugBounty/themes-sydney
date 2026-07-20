<?php
/**
 * Color group control
 *
 * @package Sydney
 */

class Sydney_Color_Group extends WP_Customize_Control {

	public $type = 'sydney-color-group-control';

	public $remove_bordertop = false;

	public function enqueue() {
		wp_enqueue_script( 'sydney-pickr', get_template_directory_uri() . '/js/pickr.min.js', array( 'jquery' ), '1.8.2', true );
	}

	/**
	 * Export data to the JS template.
	 */
	public function to_json() {
		parent::to_json();

		$colors = array();
		foreach ( array_keys( $this->settings ) as $index => $key ) {
			$colors[] = array(
				'key'     => $key,
				'id'      => $this->settings[ $key ]->id,
				'default' => $this->settings[ $key ]->default,
				'value'   => $this->value( $key ),
				'tooltip' => 0 === $index ? __( 'Normal', 'sydney' ) : __( 'Hover', 'sydney' ),
			);
		}

		$this->json['colors']           = $colors;
		$this->json['remove_bordertop'] = (bool) $this->remove_bordertop;
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
		<div class="sydney-color-group<# if ( data.remove_bordertop ) { #> border-top-none<# } #>">
			<# if ( data.label ) { #>
				<div class="sydney-color-title">{{ data.label }}</div>
			<# } #>
			<div class="sydney-color-controls">
				<# _.each( data.colors, function( color ) { #>
					<div class="sydney-color-control" data-control-id="{{ color.id }}">
						<div class="sydney-color-tooltip">{{ color.tooltip }}</div>
						<div class="sydney-color-picker" data-default-color="{{ color.default }}" style="background-color: {{ color.value }};"></div>
						<input type="text" name="{{ color.id }}" value="{{ color.value }}" class="sydney-color-input" data-customize-setting-link="{{ color.id }}" />
					</div>
				<# } ); #>
			</div>
		</div>
		<?php
	}
}