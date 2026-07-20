<?php
class Sydney_Responsive_Slider extends WP_Customize_Control {

	/**
	 * The type of control being rendered
	 */
	public $type = 'sydney-responsive-slider';

	public $is_responsive;

	public $separator = false;

	/**
	 * Export data to the JS template.
	 */
	public function to_json() {
		parent::to_json();

		$devices = $this->is_responsive ? array( 'desktop', 'tablet', 'mobile' ) : array( 'desktop' );
		$values  = array();
		foreach ( $devices as $device ) {
			$values[ $device ] = $this->value( 'size_' . $device );
		}

		$this->json['is_responsive'] = (bool) $this->is_responsive;
		$this->json['separator']     = $this->separator;
		$this->json['values']        = $values;
		$this->json['min']           = isset( $this->input_attrs['min'] ) ? absint( $this->input_attrs['min'] ) : 0;
		$this->json['max']           = isset( $this->input_attrs['max'] ) ? absint( $this->input_attrs['max'] ) : 100;
		$this->json['step']          = isset( $this->input_attrs['step'] ) ? $this->input_attrs['step'] : 1;
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
		<# var devices = data.is_responsive ? [ 'desktop', 'tablet', 'mobile' ] : [ 'desktop' ]; #>
		<# if ( 'before' === data.separator ) { #>
			<hr class="sydney-cust-divider before">
		<# } #>
			<div class="range-slider-wrapper font-size-range">
				<div class="device-heading">
					<div class="customize-control-title">{{ data.label }}</div>
					<# if ( data.is_responsive ) { #>
					<ul class="sydney-devices-preview">
						<li class="desktop"><button type="button" class="preview-desktop active" data-device="desktop"><i class="dashicons dashicons-desktop"></i></button></li>
						<li class="tablet"><button type="button" class="preview-tablet" data-device="tablet"><i class="dashicons dashicons-tablet"></i></button></li>
						<li class="mobile"><button type="button" class="preview-mobile" data-device="mobile"><i class="dashicons dashicons-smartphone"></i></button></li>
					</ul>
					<# } #>
				</div>
				<# _.each( devices, function( device ) { #>
					<div class="range-slider font-size-{{ device }}<# if ( 'desktop' === device ) { #> active<# } #><# if ( ! data.is_responsive ) { #> noresponsive<# } #>">
						<input class="range-slider__range" type="range" value="{{ data.values[ device ] }}" data-customize-setting-key-link="size_{{ device }}" min="{{ data.min }}" max="{{ data.max }}" step="{{ data.step }}">
						<input class="range-slider__value" type="number" value="{{ data.values[ device ] }}" data-customize-setting-key-link="size_{{ device }}" min="{{ data.min }}" max="{{ data.max }}" step="{{ data.step }}">
					</div>
				<# } ); #>
			</div>
			<# if ( data.description ) { #>
				<span style="margin-top: 10px;" class="description customize-control-description">{{ data.description }}</span>
			<# } #>
		<# if ( 'after' === data.separator ) { #>
			<hr class="sydney-cust-divider">
		<# } #>
		<?php
	}
}
