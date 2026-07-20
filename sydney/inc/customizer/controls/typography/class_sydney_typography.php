<?php
class Sydney_Typography_Control extends WP_Customize_Control {
		/**
		 * The type of control being rendered
		 */
		public $type = 'sydney-google_fonts';
		/**
		 * The list of Google Fonts
		 */
		private $fontList = false;
		/**
		 * The saved font values decoded from json
		 */
		private $fontValues = [];
		/**
		 * The index of the saved font within the list of Google fonts
		 */
		private $fontListIndex = 0;
		/**
		 * The number of fonts to display from the json file. Either positive integer or 'all'. Default = 'all'
		 */
		private $fontCount = 'all';
		/**
		 * The font list sort order. Either 'alpha' or 'popular'. Default = 'alpha'
		 */
		private $fontOrderBy = 'alpha';
		/**
		 * Get our list of fonts from the json file
		 */
		public function __construct( $manager, $id, $args = array(), $options = array() ) {
			parent::__construct( $manager, $id, $args );
			// Get the font sort order
			if ( isset( $this->input_attrs['orderby'] ) && strtolower( $this->input_attrs['orderby'] ) === 'popular' ) {
				$this->fontOrderBy = 'popular';
			}
			// Get the list of Google fonts
			if ( isset( $this->input_attrs['font_count'] ) ) {
				if ( 'all' !== strtolower( $this->input_attrs['font_count'] ) ) {
					$this->fontCount = ( abs( (int) $this->input_attrs['font_count'] ) > 0 ? abs( (int) $this->input_attrs['font_count'] ) : 'all' );
				}
			}
			$this->fontList = $this->get_google_fonts();
			// Decode the default json font value
			$this->fontValues = json_decode( $this->value( 'family' ) );
			// Find the index of our default font within our list of Google fonts
			$this->fontListIndex = $this->get_font_index( $this->fontList, $this->fontValues->font );
		}
		/**
		 * Enqueue our scripts and styles
		 */
		public function enqueue() {
			wp_enqueue_script( 'sydney-select2-js', get_template_directory_uri() . '/inc/customizer/controls/typography/select2.full.min.js', array( 'jquery' ), '4.0.13', true );
			wp_enqueue_style( 'sydney-select2-css', get_template_directory_uri() . '/inc/customizer/controls/typography/select2.min.css', array(), '4.0.13', 'all' );
		}
		/**
		 * Export control data to JavaScript. The fonts catalog is intentionally
		 * NOT exported — it is fetched on demand from sydney/v1/google-fonts.
		 */
		public function to_json() {
			parent::to_json();
		}
		/**
		 * Render the control in the customizer
		 */
		public function render_content() {
			if( !empty($this->fontList) ) {
				?>
				<?php if( !empty( $this->label ) ) { ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php } ?>	
				<?php if( !empty( $this->description ) ) { ?>
						<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
					<?php } ?>							
				<div class="google_fonts_select_control popover-block">
					<input type="hidden" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $this->value( 'family' ) ); ?>" class="customize-control-google-font-selection" <?php $this->link( 'family' ); ?> />
					<div class="google-fonts">
						<div class="font-control-title"><strong><?php esc_html_e( 'Font family', 'sydney' ) ?></strong></div>

						<select class="google-fonts-list" control-name="<?php echo esc_attr( $this->id ); ?>">
							<?php if ( ! empty( $this->fontValues->font ) ) : ?>
								<option value="<?php echo esc_attr( $this->fontValues->font ); ?>" selected='selected'><?php echo esc_html( $this->fontValues->font ); ?></option>
							<?php endif; ?>
						</select>
					</div>

					<div class="range-slider-wrapper cols2-control">
					<div class="font-control-title w50"><strong><?php esc_html_e( 'Font weight', 'sydney' ) ?></strong></div>
					<?php if ( $this->input_attrs['disableRegular'] === false ) : ?>
						<select class="google-fonts-regularweight-style w50">
							<?php
								foreach( $this->fontList[$this->fontListIndex]->variants as $key => $value ) {
									echo '<option value="' . esc_attr( $value ) . '" ' . selected( $this->fontValues->regularweight, $value, false ) . '>' . esc_html( $value ) . '</option>';
								}
							?>
						</select>
					<?php endif; ?>
					</div>

					<?php if ( $this->input_attrs['disableRegular'] === false ) : ?>
						<?php
							$current_extras = isset( $this->fontValues->extraweights ) ? $this->fontValues->extraweights : array();
							if ( ! is_array( $current_extras ) ) {
								$current_extras = array();
							}
							$current_extras = array_map(
								static function ( $w ) {
									return 'regular' === $w ? '400' : (string) $w;
								},
								$current_extras
							);
							$primary_normalised = 'regular' === $this->fontValues->regularweight ? '400' : $this->fontValues->regularweight;
						?>
						<div class="google-fonts-extras-wrapper">
							<div class="font-control-title"><strong><?php esc_html_e( 'Additional weights to load', 'sydney' ); ?></strong></div>
							<select class="google-fonts-extraweights-style" multiple="multiple">
								<?php
									foreach ( $this->fontList[ $this->fontListIndex ]->variants as $key => $value ) {
										$variant_normalised = 'regular' === $value ? '400' : $value;
										// Skip the primary in the extras dropdown — it's already loaded.
										if ( $variant_normalised === $primary_normalised ) {
											continue;
										}
										$is_selected = in_array( $variant_normalised, $current_extras, true );
										echo '<option value="' . esc_attr( $value ) . '" ' . selected( $is_selected, true, false ) . '>' . esc_html( $value ) . '</option>';
									}
								?>
							</select>
						</div>
					<?php endif; ?>

					<input type="hidden" class="google-fonts-category" value="<?php echo esc_html( $this->fontValues->category ); ?>">
				</div>
				<?php
			}
		}

		/**
		 * Find the index of the saved font in our multidimensional array of Google Fonts
		 */
		public function get_font_index( $haystack, $needle ) {
			foreach( $haystack as $key => $value ) {
				if( $value->family === $needle ) {
					return $key;
				}
			}
			return false;
		}

		/**
		 * Return the list of Google Fonts (delegates to the shared catalog provider).
		 */
		public function get_google_fonts() {
			return Sydney_Google_Fonts_REST::get_catalog();
		}
	}