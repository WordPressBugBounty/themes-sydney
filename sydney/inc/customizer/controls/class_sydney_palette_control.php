<?php
/**
 * Create page control
 *
 * @package Sydney
 *
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sydney_Palette_Control extends WP_Customize_Control {
		
	/**
	 * The type of control being rendered
	 */
	public $type = 'sydney-multicolor-control';

	/**
	 * Add support for palettes to be passed in.
	 *
	 * Supported palette values are true, false, or an array of RGBa and Hex colors.
	 */
	public $palette;
	/**
	 * Add support for showing the opacity value on the slider handle.
	 */
	public $show_opacity;   
	
	/**
	 * Constructor
	 */
	public function __construct( $manager, $id, $args = array(), $options = array() ) {
		parent::__construct( $manager, $id, $args );
	}

	/**
	 * Export data to the JS template.
	 */
	public function to_json() {
		parent::to_json();

		$colors = array();
		foreach ( array_keys( $this->settings ) as $key ) {
			$colors[] = array(
				'key'     => $key,
				'id'      => $this->settings[ $key ]->id,
				'default' => $this->settings[ $key ]->default,
				'value'   => $this->value( $key ),
			);
		}

		$this->json['colors'] = $colors;
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
		<div class="sydney-custom-palettes-wrapper">
			<# if ( data.label ) { #>
				<span class="customize-control-title">{{ data.label }}</span>
			<# } #>
			<# if ( data.description ) { #>
				<span class="customize-control-description">{{ data.description }}</span>
			<# } #>

			<div class="sydney-custom-palette">
				<# _.each( data.colors, function( color ) { #>
					<div class="sydney-color-control sydney-global-color-control">
						<div class="sydney-color-picker" data-default-color="{{ color.default }}" style="background-color: {{ color.value }};"></div>
						<input type="text" value="{{ color.value }}" class="sydney-color-input" data-customize-setting-link="{{ color.id }}" />
					</div>
				<# } ); #>
			</div>
		</div>
		<?php
	}
}
