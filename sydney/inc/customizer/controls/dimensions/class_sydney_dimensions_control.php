<?php
/**
 * Dimensions control
 *
 * @package Sydney
 */

class Sydney_Dimensions_Control extends WP_Customize_Control {
	public $type = 'sydney-dimensions-control';
    public $units = array();
    public $sides = array();
    public $link_values_toggle;
    public $is_responsive;

    /**
     * Export data to the JS template.
     */
    public function to_json() {
        parent::to_json();

        $devices = $this->is_responsive ? array( 'desktop', 'tablet', 'mobile' ) : array( 'desktop' );
        $values  = array();

        foreach ( $devices as $device ) {
            $raw     = $this->value( $device );
            $decoded = $raw ? json_decode( $raw ) : null;

            $values[ $device ] = array(
                'raw'    => $raw ? $raw : '',
                'unit'   => isset( $decoded->unit ) ? $decoded->unit : 'px',
                'linked' => ! empty( $decoded->linked ),
                'top'    => isset( $decoded->top ) ? $decoded->top : '',
                'right'  => isset( $decoded->right ) ? $decoded->right : '',
                'bottom' => isset( $decoded->bottom ) ? $decoded->bottom : '',
                'left'   => isset( $decoded->left ) ? $decoded->left : '',
            );
        }

        $this->json['units']              = $this->units;
        $this->json['sides']              = $this->sides;
        $this->json['link_values_toggle'] = (bool) $this->link_values_toggle;
        $this->json['is_responsive']      = (bool) $this->is_responsive;
        $this->json['values']             = $values;
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
		<#
		var devices    = data.is_responsive ? [ 'desktop', 'tablet', 'mobile' ] : [ 'desktop' ];
		var sideLabels = {
			top: '<?php echo esc_js( __( 'Top', 'sydney' ) ); ?>',
			right: '<?php echo esc_js( __( 'Right', 'sydney' ) ); ?>',
			bottom: '<?php echo esc_js( __( 'Bottom', 'sydney' ) ); ?>',
			left: '<?php echo esc_js( __( 'Left', 'sydney' ) ); ?>'
		};
		#>
		<div class="sydney-control-wrapper">
            <div class="sydney-dimensions-control">
                <span class="customize-control-title">{{ data.label }}</span>
                <# if ( data.description ) { #>
                    <span class="customize-control-description">{{ data.description }}</span>
                <# } #>
                <div class="sydney-dimensions-wrapper">
                    <div class="sydney-dimensions-header">
                        <# _.each( devices, function( device ) { #>
                            <div class="sydney-dimensions-units responsive-control-{{ device }}<# if ( 'desktop' === device ) { #> active<# } #>" data-device-type="{{ device }}">
                                <select class="sydney-dimensions-unit">
                                <# _.each( data.units, function( unit ) { #>
                                    <option value="{{ unit }}" <# if ( unit === data.values[ device ].unit ) { #>selected<# } #>>{{ unit }}</option>
                                <# } ); #>
                                </select>
                            </div>
                            <# if ( data.link_values_toggle ) { #>
                                <div class="sydney-dimensions-link-values <# if ( data.values[ device ].linked ) { #>linked <# } #>responsive-control-{{ device }}<# if ( 'desktop' === device ) { #> active<# } #>" data-device-type="{{ device }}">
                                    <button type="button" class="sydney-dimensions-link-btn" title="<?php esc_attr_e( 'Link values together', 'sydney' ); ?>">
                                        <i class="sydney-dimensions-icon sydney-dimensions-icon-link dashicons dashicons-admin-links"></i>
                                        <i class="sydney-dimensions-icon sydney-dimensions-icon-unlink dashicons dashicons-editor-unlink"></i>
                                    </button>
                                </div>
                            <# } #>
                        <# } ); #>
                        <# if ( data.is_responsive ) { #>
                            <ul class="sydney-devices-preview">
                                <li class="desktop"><button type="button" class="preview-desktop active" data-device="desktop"><i class="dashicons dashicons-desktop"></i></button></li>
                                <li class="tablet"><button type="button" class="preview-tablet" data-device="tablet"><i class="dashicons dashicons-tablet"></i></button></li>
                                <li class="mobile"><button type="button" class="preview-mobile" data-device="mobile"><i class="dashicons dashicons-smartphone"></i></button></li>
                            </ul>
                        <# } #>
                    </div>
                    <# _.each( devices, function( device ) { #>
                        <div class="sydney-dimensions-inputs responsive-control-{{ device }}<# if ( 'desktop' === device ) { #> active<# } #>" data-device-type="{{ device }}">
                            <# _.each( [ 'top', 'right', 'bottom', 'left' ], function( side ) { if ( data.sides[ side ] ) { #>
                                <div class="sydney-dimensions-input-wrapper">
                                    <input type="number" min="-500" max="500" value="{{ data.values[ device ][ side ] }}" data-side="{{ side }}" class="sydney-dimensions-input" />
                                    <label class="sydney-dimensions-input-label">{{ sideLabels[ side ] }}</label>
                                </div>
                            <# } } ); #>
                            <input type="hidden" value="{{ data.values[ device ].raw }}" data-customize-setting-key-link="{{ device }}" class="sydney-dimensions-value" />
                        </div>
                    <# } ); #>
                </div>
            </div>
        </div>
		<?php
	}
}
