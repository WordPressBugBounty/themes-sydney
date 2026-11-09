<?php
/**
 * Pro features ability group: sydney/get-pro-features, registered on free
 * sites only. Lists what Sydney Pro adds, from the dashboard's Pro feature
 * rows and the header/footer builder's Pro components, with one upgrade link.
 *
 * @package Sydney
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Sydney_Abilities_Pro_Features' ) ) :

	/**
	 * Sydney_Abilities_Pro_Features class.
	 */
	class Sydney_Abilities_Pro_Features {

		/**
		 * What a dashboard Pro row unlocks for an agent, keyed by the row's
		 * module, else its id. settings entries are <ability subject>.<field>=<value>.
		 * The shortcode hero entry is written inline in execute_get_pro_features()
		 * because no dashboard row covers it.
		 */
		const FEATURE_FACTS = array(
			'templates'       => array(
				'abilities' => array( 'sydney/get-templates', 'sydney/update-template', 'sydney/create-template-part', 'sydney/delete-template' ),
			),
			'ext-blog'        => array(
				'settings' => array( 'blog.layout=layout7' ),
			),
			'ext-woocommerce' => array(
				'settings' => array( 'shop.add_to_cart_layout=layout3', 'shop.add_to_cart_layout=layout4' ),
			),
			'dark-mode'       => array(
				'settings' => array( 'colors.dark_mode=true', 'colors.scheme=dark', 'colors.default_scheme=system' ),
			),
		);

		/**
		 * Register sydney/get-pro-features. Sydney Pro sites get nothing.
		 */
		public function register() {
			if ( defined( 'SYDNEY_PRO_VERSION' ) ) {
				return;
			}

			Sydney_Ability::register(
				'sydney/get-pro-features',
				array(
					'label'            => __( 'Get Sydney Pro features', 'sydney' ),
					'description'      => __( 'Lists what Sydney Pro adds to this site\'s free Sydney theme, with an upgrade link. Use when the user asks for something no other sydney/ ability can do, asks about Sydney Pro or pricing, or asks what else the theme can do.', 'sydney' ),
					'input_schema'     => array( 'type' => 'object' ),
					'output_schema'    => Sydney_Ability::envelope_schema(
						array(
							'edition'          => array( 'type' => 'string' ),
							'upgrade_url'      => array( 'type' => 'string' ),
							'upgrade_url_note' => array( 'type' => 'string' ),
							'features'         => array(
								'type'  => 'array',
								'items' => array(
									'type'       => 'object',
									'properties' => array(
										'name'        => array( 'type' => 'string' ),
										'description' => array( 'type' => 'string' ),
										'settings'    => array(
											'type'        => 'array',
											'items'       => array( 'type' => 'string' ),
											'description' => 'Option values the feature unlocks, as <ability subject>.<field>=<value>, e.g. blog.layout=layout7.',
										),
										'abilities'   => array(
											'type'        => 'array',
											'items'       => array( 'type' => 'string' ),
											'description' => 'Abilities that exist only on Sydney Pro.',
										),
									),
								),
							),
						)
					),
					'execute_callback' => array( $this, 'execute_get_pro_features' ),
					'meta'             => array(
						'annotations' => Sydney_Ability::READ_ANNOTATIONS,
					),
				)
			);
		}

		/**
		 * Execute: list the Sydney Pro features.
		 *
		 * @param array $args Ability args (unused).
		 * @return array Response envelope.
		 */
		public function execute_get_pro_features( $args ) {
			$features = array_merge(
				$this->dashboard_features(),
				$this->builder_features(),
				array(
					array(
						'name'        => __( 'Shortcode hero', 'sydney' ),
						'description' => __( 'Use a shortcode, such as a slider plugin\'s, as the hero on the front page or on other pages.', 'sydney' ),
						'settings'    => array( 'hero.front_page_type=shortcode', 'hero.site_type=shortcode' ),
						'abilities'   => array(),
					),
				)
			);

			$count = count( $features );

			return Sydney_Abilities_Response::success(
				/* translators: %d: number of Sydney Pro features. */
				sprintf( _n( '%d Sydney Pro feature listed.', '%d Sydney Pro features listed.', $count, 'sydney' ), $count ),
				array_merge(
					array( 'edition' => 'free' ),
					Sydney_Abilities_Response::upgrade_link( 'sydney/get-pro-features' ),
					array( 'features' => $features )
				)
			);
		}

		/**
		 * The Pro rows the dashboard Home tab lists.
		 *
		 * @return array
		 */
		protected function dashboard_features() {
			if ( ! function_exists( 'sydney_dashboard_features' ) ) {
				require_once get_template_directory() . '/inc/dashboard/features.php';
			}

			$all_facts = self::FEATURE_FACTS;
			$features  = array();

			foreach ( sydney_dashboard_features() as $row ) {
				if ( ! isset( $row['type'] ) || 'pro' !== $row['type'] ) {
					continue;
				}

				$key   = isset( $row['module'] ) ? $row['module'] : ( isset( $row['id'] ) ? $row['id'] : '' );
				$facts = isset( $all_facts[ $key ] ) ? $all_facts[ $key ] : array();

				$features[] = array(
					'name'        => html_entity_decode( $row['title'], ENT_QUOTES, 'UTF-8' ),
					'description' => html_entity_decode( $row['desc'], ENT_QUOTES, 'UTF-8' ),
					'settings'    => isset( $facts['settings'] ) ? $facts['settings'] : array(),
					'abilities'   => isset( $facts['abilities'] ) ? $facts['abilities'] : array(),
				);
			}

			return $features;
		}

		/**
		 * One entry per header/footer builder component Sydney Pro adds.
		 *
		 * @return array
		 */
		protected function builder_features() {
			if ( ! class_exists( 'Sydney_HF_Layout' ) ) {
				require_once get_template_directory() . '/inc/abilities/customizer/class-sydney-hf-layout.php';
			}

			$registry   = Sydney_HF_Layout::registry();
			$components = array();

			foreach ( array( 'header', 'footer' ) as $area ) {
				$upsell = isset( $registry[ $area . '_upsell' ] ) ? $registry[ $area . '_upsell' ] : array();

				if ( ! is_array( $upsell ) ) {
					continue;
				}

				foreach ( $upsell as $entry ) {
					// Same validity rule as Sydney_HF_Layout::pro_components(), except label-only entries are kept.
					if ( ! is_array( $entry ) || ! isset( $entry['id'], $entry['label'] ) ) {
						continue;
					}

					if ( ! isset( $components[ $entry['id'] ] ) ) {
						$components[ $entry['id'] ] = array(
							'label' => $entry['label'],
							'areas' => array(),
						);
					}

					$components[ $entry['id'] ]['areas'][] = $area;
				}
			}

			$features = array();

			foreach ( $components as $id => $component ) {
				$label_only = in_array( $id, Sydney_HF_Layout::LABEL_ONLY_COMPONENTS, true );
				$settings   = array();

				if ( ! $label_only ) {
					foreach ( $component['areas'] as $area ) {
						$settings[] = $area . '.component=' . $id;
					}
				}

				// Keep this description in step with Sydney_HF_Layout::LABEL_ONLY_COMPONENTS.
				if ( 'language_switcher' === $id ) {
					$description = __( 'A header builder component that shows a WPML or Polylang language switcher.', 'sydney' );
				} elseif ( 2 === count( $component['areas'] ) ) {
					$description = __( 'A header and footer builder component.', 'sydney' );
				} elseif ( 'footer' === $component['areas'][0] ) {
					$description = __( 'A footer builder component.', 'sydney' );
				} else {
					$description = __( 'A header builder component.', 'sydney' );
				}

				$features[] = array(
					'name'        => html_entity_decode( $component['label'], ENT_QUOTES, 'UTF-8' ),
					'description' => $description,
					'settings'    => $settings,
					'abilities'   => array(),
				);
			}

			return $features;
		}
	}

endif;
