<?php
/**
 * Radio images control
 *
 * @package Sydney
 */

class Sydney_Radio_Images extends WP_Customize_Control {

	public $type = 'sydney-radio-image';

	public $desc_below = false;

	public $class = '';

	public $cols = 4;

	public $is_responsive;

	/**
	 * Export data to the JS template.
	 */
	public function to_json() {
		parent::to_json();

		$choices = array();
		foreach ( $this->choices as $value => $args ) {
			$choices[] = array(
				'value'  => $value,
				'label'  => $args['label'],
				'url'    => sprintf( $args['url'], get_template_directory_uri(), get_stylesheet_directory_uri() ),
				'is_pro' => ! empty( $args['is_pro'] ),
			);
		}

		$devices = array();
		$values  = array();
		if ( $this->is_responsive ) {
			foreach ( array( 'desktop', 'tablet', 'mobile' ) as $device ) {
				if ( isset( $this->settings[ $device ] ) ) {
					$devices[]         = $device;
					$values[ $device ] = $this->value( $device );
				}
			}
		} else {
			$values['default'] = $this->value();
		}

		$this->json['id']            = $this->id;
		$this->json['choices']       = $choices;
		$this->json['devices']       = $devices;
		$this->json['values']        = $values;
		$this->json['is_responsive'] = (bool) $this->is_responsive;
		$this->json['cols']          = $this->cols;
		$this->json['class']         = $this->class;
		$this->json['desc_below']    = (bool) $this->desc_below;
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
		<# if ( data.choices.length ) { #>
			<# if ( data.label ) { #>
				<span class="customize-control-title">{{ data.label }}</span>
			<# } #>
			<# if ( data.description && ! data.desc_below ) { #>
				<span class="description customize-control-description">{{ data.description }}</span>
			<# } #>
			<div class="sydney-control-wrapper">
				<# if ( data.is_responsive ) { #>
					<ul class="sydney-devices-preview alt-position">
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
					var suffix = ( 'default' === device ) ? '' : '_' + device;
					var cls;
					if ( 'default' === device ) {
						cls = 'responsive-control-desktop active noresponsive';
					} else {
						cls = 'responsive-control-' + device;
						if ( 'desktop' === device ) { cls += ' active'; }
						if ( 'tablet' === device && -1 === data.devices.indexOf( 'mobile' ) ) { cls += ' show-mobile'; }
					}
					// Only the desktop/default wrapper carried the col + custom class in the PHP-rendered markup.
					if ( 'default' === device || 'desktop' === device ) {
						cls += ' sydney-radio-images-col-' + data.cols;
						if ( data.class ) { cls += ' ' + data.class; }
					}
				#>
					<div id="input_{{ data.id }}{{ suffix }}" class="sydney-radio-images-wrapper {{ cls }}">
						<# _.each( data.choices, function( choice ) { #>
							<label for="{{ data.id }}{{ suffix }}-{{ choice.value }}"<# if ( choice.is_pro ) { #> class="is-pro"<# } #>>
								<input type="radio" value="{{ choice.value }}" name="_customize-radio-{{ data.id }}{{ suffix }}" id="{{ data.id }}{{ suffix }}-{{ choice.value }}" data-customize-setting-key-link="{{ device }}" <# if ( String( choice.value ) === String( data.values[ device ] ) ) { #>checked<# } #> />
								<span class="screen-reader-text">{{ choice.label }}</span>
								<figure><img src="{{ choice.url }}" title="{{ choice.label }}" alt="{{ choice.label }}" /></figure>
								<span class="label-tooltip">{{ choice.label }}</span>
							</label>
						<# } ); #>
					</div>
				<# } ); #>

				<# if ( data.description && data.desc_below ) { #>
					<span class="description customize-control-description">{{ data.description }}</span>
				<# } #>
			</div>
		<# } #>
		<?php
	}

	/**
	 * Loads the jQuery UI Button script and hooks our custom styles in.
	 *
	 * @since  3.0.0
	 * @return void
	 */
	public function enqueue() {
		wp_enqueue_script( 'jquery-ui-button' );
	}

	/**
	 * Outputs custom styles to give the selected image a visible border.
	 */
	public function print_styles() { ?>

		<style type="text/css" id="hybrid-customize-sydney-radio-image-css">
			.customize-control-sydney-radio-image .sydney-radio-images-wrapper.ui-helper-clearfix:before,
			.customize-control-sydney-radio-image .sydney-radio-images-wrapper.ui-helper-clearfix:after { content: none !important; }
			.customize-control-sydney-radio-image img { border: 1px solid transparent;border-radius:3px;width:100%;display:block;transition: opacity 0.2s;}
			.customize-control-sydney-radio-image .img-cont {margin:5px;}
			<?php if ( $this->cols === 3 ) : ?>
				.customize-control-sydney-radio-image #<?php echo esc_attr( "input_{$this->id}" ); ?> label { float:left; width: 33.3333%;}
			<?php elseif ( $this->cols === 2 ) : ?>
				.customize-control-sydney-radio-image #<?php echo esc_attr( "input_{$this->id}" ); ?> label { float:left; width: 50%;}
			<?php else : ?>
				.customize-control-sydney-radio-image #<?php echo esc_attr( "input_{$this->id}" ); ?> label { float:left; width: 25%;}
			<?php endif; ?>
			.customize-control-sydney-radio-image img:hover { opacity:1; }
			.customize-control-sydney-radio-image .ui-icon { display: none; }
			.customize-control-sydney-radio-image .ui-state-active { border: none; background: transparent; }
			.customize-control-sydney-radio-image .ui-state-active img { border-color: #317CB5;opacity:1; }
			.customize-control-sydney-radio-image .ui-state-active .img-cont {position:relative;}
			.customize-control-sydney-radio-image .ui-state-active .img-cont:after { content:'';background:rgba(49, 124, 181, 0.1);top:0;left:0;position:absolute;width:100%;height:100%; }
		</style>
	<?php }
}