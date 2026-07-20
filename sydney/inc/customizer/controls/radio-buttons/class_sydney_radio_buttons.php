<?php
/**
 * Radio buttons control
 *
 * @package Sydney
 */

class Sydney_Radio_Buttons extends WP_Customize_Control {

	public $type = 'sydney-radio-buttons';

	public $cols;

	public $desc_position = 'before-buttons';

	public $is_responsive;

	/**
	 * Export data to the JS template.
	 */
	public function to_json() {
		parent::to_json();

		$allowed_tags = array(
			'div' => array(
				'style' => array(),
			),
			'svg'     => array(
				'class'       => true,
				'xmlns'       => true,
				'width'       => true,
				'height'      => true,
				'viewbox'     => true,
				'aria-hidden' => true,
				'role'        => true,
				'focusable'   => true,
			),
			'path'    => array(
				'd'      => true,
			),
			'rect'    => array(
				'x'      => true,
				'y'      => true,
				'width'  => true,
				'height' => true,
				'transform' => true,
			),
		);

		$choices = array();
		foreach ( $this->choices as $key => $value ) {
			$choices[ $key ] = wp_kses( $value, $allowed_tags );
		}

		$devices = array();
		$values  = array();
		if ( $this->is_responsive ) {
			foreach ( array( 'desktop', 'tablet', 'mobile' ) as $device ) {
				if ( isset( $this->settings[ $device ] ) ) {
					$devices[]          = $device;
					$values[ $device ]  = $this->value( $device );
				}
			}
		} else {
			$values['default'] = $this->value();
		}

		$this->json['id']            = $this->id;
		$this->json['choices']       = $choices;
		$this->json['is_responsive'] = (bool) $this->is_responsive;
		$this->json['devices']       = $devices;
		$this->json['values']        = $values;
		$this->json['desc_position'] = $this->desc_position;
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
		<div class="sydney-control-wrapper">
			<div class="text_radio_button_control">
				<# if ( data.label ) { #>
					<span class="customize-control-title">{{ data.label }}</span>
				<# } #>
				<# if ( data.description && 'before-buttons' === data.desc_position ) { #>
					<span class="customize-control-description">{{ data.description }}</span>
				<# } #>
				<# if ( data.is_responsive ) { #>
					<ul class="sydney-devices-preview">
						<# if ( -1 !== data.devices.indexOf( 'desktop' ) ) { #>
						<li class="desktop"><button type="button" class="preview-desktop active" data-device="desktop"><i class="dashicons dashicons-desktop"></i></button></li>
						<# } #>
						<# if ( -1 !== data.devices.indexOf( 'tablet' ) ) { #>
						<li class="tablet"><button type="button" class="preview-tablet" data-device="tablet"><i class="dashicons dashicons-tablet"></i></button></li>
						<# } #>
						<# if ( -1 !== data.devices.indexOf( 'mobile' ) ) { #>
						<li class="mobile"><button type="button" class="preview-mobile" data-device="mobile"><i class="dashicons dashicons-smartphone"></i></button></li>
						<# } #>
					</ul>
				<# } #>

				<#
				var groups = data.is_responsive ? data.devices : [ 'default' ];
				_.each( groups, function( device ) {
					var cls, name;
					if ( 'default' === device ) {
						cls  = 'responsive-control-desktop active noresponsive';
						name = data.id;
					} else {
						cls  = 'responsive-control-' + device;
						if ( 'desktop' === device ) {
							cls += ' active';
						}
						if ( 'tablet' === device && -1 === data.devices.indexOf( 'mobile' ) ) {
							cls += ' show-mobile';
						}
						name = data.id + '_' + device;
					}
				#>
					<div class="radio-buttons {{ cls }}">
						<# _.each( data.choices, function( choice, choiceKey ) { #>
							<label class="radio-button-label">
								<input type="radio" name="{{ name }}" value="{{ choiceKey }}" data-customize-setting-key-link="{{ device }}" <# if ( String( choiceKey ) === String( data.values[ device ] ) ) { #>checked<# } #>/>
								<span>{{{ choice }}}</span>
							</label>
						<# } ); #>
					</div>
				<# } ); #>

				<# if ( data.description && 'after-buttons' === data.desc_position ) { #>
					<span class="customize-control-description">{{ data.description }}</span>
				<# } #>
			</div>
		</div>
		<?php
	}
}
