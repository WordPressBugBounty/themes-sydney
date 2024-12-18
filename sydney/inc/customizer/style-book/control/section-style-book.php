<?php
/**
 * Pro customizer section.
 *
 * @since  1.0.0
 * @access public
 */
class Sydney_Customize_StyleBook_Toggle extends WP_Customize_Section {

	/**
	 * The type of customize section being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'stylebook-toggle';

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function json() {
		$json = parent::json();

		$json['pro_text'] = $this->pro_text;

		return $json;
	}

	/**
	 * Outputs the Underscore.js template.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	protected function render_template() { ?>

		<li id="accordion-section-{{ data.id }}" class="sydney-style-book-toggle control-section-{{ data.type }} cannot-expand">
			<h3>
				<span class="dashicons dashicons-admin-appearance"></span>{{ data.title }}
			</h3>
		</li>
	<?php }
}
