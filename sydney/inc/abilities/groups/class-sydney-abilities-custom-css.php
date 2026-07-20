<?php
/**
 * Additional-CSS ability group: read and replace the site's Additional CSS.
 *
 * Storage reality: the core custom_css post for the active stylesheet — the
 * exact storage the Customizer's Additional CSS editor writes to
 * (WP_Customize_Custom_CSS_Setting::update() is a thin wrapper around
 * wp_update_custom_css_post()). Reading via wp_get_custom_css() and writing
 * via wp_update_custom_css_post() keeps revisions and the
 * update_custom_css_data filter (CSS-preprocessor plugins) intact.
 *
 * Security model mirrors core: the write is gated on the edit_css capability
 * (mapped through unfiltered_html — multisite non-super-admins and
 * DISALLOW_UNFILTERED_HTML sites are denied, exactly as the Customizer hides
 * its section). Core does not sanitize CSS content; its only content check is
 * the </style breakout scan in WP_Customize_Custom_CSS_Setting::validate().
 * wp_update_custom_css_post() never runs that validation itself, so this
 * group replicates the scan before writing.
 *
 * @package Sydney
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Sydney_Abilities_Custom_Css' ) ) :

	/**
	 * Sydney_Abilities_Custom_Css class.
	 */
	class Sydney_Abilities_Custom_Css {

		/**
		 * Register Additional-CSS abilities (read always, write when allowed).
		 */
		public function register() {
			$this->register_get_custom_css();
			$this->register_update_custom_css();
		}

		/**
		 * Register sydney/get-custom-css (read).
		 *
		 * Default edit_theme_options floor: the CSS is publicly rendered into
		 * every page's <style> output, so reading it is not sensitive.
		 */
		protected function register_get_custom_css() {
			Sydney_Ability::register(
				'sydney/get-custom-css',
				array(
					'label'            => __( 'Get Additional CSS', 'sydney' ),
					'description'      => __( 'Read the site\'s Additional CSS (the Customizer Additional CSS editor) for the active theme. Call before sydney/update-custom-css: updates are full replacements.', 'sydney' ),
					'input_schema'     => array( 'type' => 'object' ),
					'output_schema'    => Sydney_Ability::envelope_schema(
						array(
							'css' => array( 'type' => 'string' ),
						)
					),
					'execute_callback' => array( $this, 'execute_get_custom_css' ),
					'meta'             => array(
						'annotations' => Sydney_Ability::READ_ANNOTATIONS,
					),
				)
			);
		}

		/**
		 * Register sydney/update-custom-css (write, edit_css).
		 */
		protected function register_update_custom_css() {
			Sydney_Ability::register(
				'sydney/update-custom-css',
				array(
					'write'               => true, // ADR-0002: not registered while writes are off.
					'label'               => __( 'Update Additional CSS', 'sydney' ),
					'description'         => __( 'Replace the site\'s Additional CSS (the Customizer Additional CSS editor) for the active theme. Full replace: call sydney/get-custom-css first and send the complete stylesheet. Pass an empty string to clear. The CSS must not contain a </style> closing tag (or a partial one at the end).', 'sydney' ),
					'input_schema'        => array(
						'type'                 => 'object',
						'required'             => array( 'css' ),
						'additionalProperties' => false,
						'properties'           => array(
							'css' => array(
								'type'        => 'string',
								'description' => 'The complete new Additional CSS. An empty string clears it.',
							),
						),
					),
					'output_schema'       => Sydney_Ability::envelope_schema(
						array(
							'characters' => array( 'type' => 'integer' ),
						)
					),
					'execute_callback'    => array( $this, 'execute_update_custom_css' ),
					// Additional CSS is core's edit_css capability (routed through
					// unfiltered_html), not the default edit_theme_options floor.
					'permission_callback' => array( $this, 'check_edit_css' ),
					'meta'                => array(
						'annotations' => Sydney_Ability::WRITE_ANNOTATIONS,
					),
				)
			);
		}

		/**
		 * Permission check for the Additional-CSS write.
		 *
		 * @return bool
		 */
		public function check_edit_css() {
			return current_user_can( 'edit_css' );
		}

		/**
		 * Execute: read the active theme's Additional CSS.
		 *
		 * @param array $args Ability args (unused).
		 * @return array Response envelope.
		 */
		public function execute_get_custom_css( $args ) {
			return Sydney_Abilities_Response::success(
				__( 'Additional CSS retrieved.', 'sydney' ),
				array( 'css' => (string) wp_get_custom_css() )
			);
		}

		/**
		 * Execute: full-replace the active theme's Additional CSS.
		 *
		 * @param array $args Ability args. Expects $args['css'].
		 * @return array Response envelope.
		 */
		public function execute_update_custom_css( $args ) {
			if ( ! array_key_exists( 'css', $args ) || ! is_string( $args['css'] ) ) {
				return Sydney_Abilities_Response::error(
					__( 'A string "css" is required. Pass an empty string to clear the Additional CSS.', 'sydney' )
				);
			}

			$css      = $args['css'];
			$breakout = $this->find_style_breakout( $css );

			if ( null !== $breakout ) {
				return Sydney_Abilities_Response::error(
					/* translators: %s: the offending CSS fragment. */
					sprintf( __( 'The CSS must not contain "%s": it would close the style element and break out into markup.', 'sydney' ), $breakout )
				);
			}

			$result = wp_update_custom_css_post( $css );

			if ( is_wp_error( $result ) ) {
				return Sydney_Abilities_Response::error(
					__( 'The Additional CSS could not be saved.', 'sydney' )
				);
			}

			return Sydney_Abilities_Response::success(
				'' === $css
					? __( 'Additional CSS cleared.', 'sydney' )
					: __( 'Additional CSS updated.', 'sydney' ),
				array( 'characters' => strlen( $css ) )
			);
		}

		/**
		 * Find a </style> breakout in CSS text, mirroring core's
		 * WP_Customize_Custom_CSS_Setting::validate() scan (the validation the
		 * Customizer runs but wp_update_custom_css_post() does not).
		 *
		 * Custom CSS renders inside an HTML STYLE element, so the text must not
		 * contain a closing tag ("</style" followed by whitespace, "/" or ">")
		 * and must not END with a partial one (e.g. "</sty") that a concatenated
		 * later stylesheet could complete.
		 *
		 * @param string $css CSS text.
		 * @return string|null The offending fragment, or null when clean.
		 */
		protected function find_style_breakout( $css ) {
			$length = strlen( $css );

			for (
				$at = strcspn( $css, '<' );
				$at < $length;
				$at += strcspn( $css, '<', ++$at )
			) {
				$remaining = $length - $at;

				if ( 0 !== substr_compare( $css, '</style', $at, min( 7, $remaining ), true ) ) {
					continue;
				}

				if ( $remaining < 8 ) {
					return substr( $css, $at ); // Partial closing tag at end of string.
				}

				if ( 1 === strspn( $css, " \t\f\r\n/>", $at + 7, 1 ) ) {
					return substr( $css, $at, 8 );
				}
			}

			return null;
		}
	}

endif;
