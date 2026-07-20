<?php
/**
 * Alpha color control
 *
 * @package Sydney
 */

class Sydney_Alpha_Color extends WP_Customize_Control {

	public $type = 'sydney-alpha-color';

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

	public $remove_bordertop = false;

	public $connected_global = false;

	public function enqueue() {
		wp_enqueue_script( 'sydney-pickr', get_template_directory_uri() . '/js/pickr.min.js', array( 'jquery' ), '1.8.2', true );
	}

	/**
	 * Export data to the JS template.
	 */
	public function to_json() {
		parent::to_json();

		$items = array();
		$keys  = array_keys( $this->settings );

		foreach ( $keys as $index => $key ) {
			if ( 0 === $index && count( $this->settings ) > 1 ) {
				$items[] = array(
					'kind'    => 'global',
					'key'     => $key,
					'id'      => $this->settings[ $key ]->id,
					'element' => str_replace( 'global_', '', $this->settings[ $key ]->id ),
					'value'   => $this->value( $key ),
				);
				continue;
			}

			// The literal stored value — always kept in the <input> so WP Customizer's
			// linkElements binding never sees a phantom change on section open.
			$literal = $this->value( $key );
			// The display color shown in the swatch: resolved to the global hex when a
			// global is connected, so the picker reflects the colour currently in use.
			$display = $literal;

			if ( isset( $this->settings['global'] ) ) {
				$connected = $this->value( 'global' );

				if ( $connected && 0 === strpos( $connected, 'global_color_' ) ) {
					$palette_defaults = sydney_get_global_color_defaults();
					$palette_default  = isset( $palette_defaults[ $connected ] ) ? $palette_defaults[ $connected ] : '';
					$resolved         = get_theme_mod( $connected, $palette_default );

					if ( $resolved ) {
						$display = $resolved;
					}
				}
			}

			$items[] = array(
				'kind'    => 'color',
				'key'     => $key,
				'id'      => $this->settings[ $key ]->id,
				'default' => $this->settings[ $key ]->default,
				'literal' => $literal,
				'display' => $display,
			);
		}

		$this->json['items'] = $items;
		// The Border_Bottom subclass has a compound type string that cannot be a
		// template selector; both classes render through the parent's template
		// and JS constructor. PHP still stamps the compound classes on the <li>.
		$this->json['type'] = 'sydney-alpha-color';
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
		<div class="sydney-color-controls">
			<# if ( data.label ) { #>
				<span class="customize-control-title">{{ data.label }}</span>
			<# } #>
			<# if ( data.description ) { #>
				<span class="description customize-control-description">{{ data.description }}</span>
			<# } #>
			<div class="color-options">
				<# _.each( data.items, function( item ) { #>
					<# if ( 'global' === item.kind ) { #>
						<div class="sydney-global-control">
							<span class="dashicons dashicons-admin-site-alt3"></span>
							<div class="global-colors-dropdown" data-element="{{ item.element }}">
								<div class="title">
									<?php esc_html_e( 'Select a Global Color', 'sydney' ); ?>
									<a href="javascript:wp.customize.control( 'custom_palette' ).focus();"><span class="dashicons dashicons-admin-generic"></span></a>
								</div>
							</div>
							<input type="hidden" name="{{ item.id }}" value="{{ item.value }}" class="sydney-connected-global" data-customize-setting-link="{{ item.id }}" />
						</div>
					<# } else { #>
						<div class="sydney-color-control" data-control-id="{{ item.id }}">
							<div class="sydney-color-picker" data-default-color="{{ item.default }}" data-display-color="{{ item.display }}" style="background-color: {{ item.display }};"></div>
							<input type="text" name="{{ item.id }}" value="{{ item.literal }}" class="sydney-color-input" data-customize-setting-link="{{ item.id }}" />
						</div>
					<# } #>
				<# } ); #>
			</div>
		</div>
		<?php
	}
}

class Sydney_Alpha_Color_Border_Bottom extends Sydney_Alpha_Color {
	public $type = 'sydney-alpha-color sydney-alpha-color-border-bottom';
}