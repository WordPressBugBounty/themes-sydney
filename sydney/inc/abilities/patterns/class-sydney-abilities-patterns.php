<?php
/**
 * Page-assembly abilities for the Sydney Abilities API.
 *
 * Holds the two execute callbacks (list-patterns / create-page-from-patterns)
 * and the helpers they need. The protected seams pattern_library_active(),
 * get_all_patterns(), and get_pattern_by_slug() wrap the module check and the
 * final core WP_Block_Patterns_Registry so they can be overridden in unit tests.
 *
 * @package Sydney
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Sydney_Abilities_Patterns' ) ) :

	/**
	 * Sydney_Abilities_Patterns class.
	 */
	class Sydney_Abilities_Patterns {

		/**
		 * Pattern-name prefixes recognized as Sydney's own patterns.
		 *
		 * @var string[]
		 */
		const PREFIXES = array( 'sydney/', 'sydney-pro/' );

		/**
		 * Canvas page template (recon: "Sydney Canvas").
		 *
		 * @var string
		 */
		const CANVAS_TEMPLATE = 'page-templates/page_front-page.php';

		/**
		 * Post statuses the create ability accepts.
		 *
		 * @var string[]
		 */
		const ALLOWED_STATUSES = array( 'draft', 'publish', 'pending', 'private' );

		/**
		 * Register the page-assembly abilities (read always, write when allowed).
		 */
		public function register() {

			Sydney_Ability::register(
				'sydney/list-patterns',
				array(
					'label'            => __( 'List Sydney patterns', 'sydney' ),
					'description'      => __( 'Enumerate Sydney and Sydney Pro block patterns (slug, title, categories, keywords) so a page can be assembled from them.', 'sydney' ),
					'input_schema'     => array(
						'type'       => 'object',
						'properties' => new stdClass(),
					),
					'output_schema'    => Sydney_Ability::envelope_schema(
						array(
									'patterns' => array(
										'type'  => 'array',
										'items' => array( 'type' => 'object' ),
									),
						)
					),
					'execute_callback' => array( $this, 'execute_list_patterns' ),
					'meta'             => array(
						'annotations' => Sydney_Ability::READ_ANNOTATIONS,
					),
				)
			);

			Sydney_Ability::register(
				'sydney/create-page-from-patterns',
				array(
					'write' => true,
					'label'            => __( 'Create page from patterns', 'sydney' ),
					'description'      => __( 'Create a page by concatenating the block markup of an ordered list of Sydney pattern slugs (get slugs from sydney/list-patterns). Requires the Sydney pattern-library module. All-or-nothing: if any slug is unknown or empty, no page is created and the bad slugs are returned in data.not_found. Optionally assigns the full-width Sydney Canvas template.', 'sydney' ),
					'input_schema'     => array(
						'type'                 => 'object',
						'required'             => array( 'title', 'pattern_slugs' ),
						'additionalProperties' => false,
						'properties'           => array(
							'title'         => array(
								'type'        => 'string',
								'description' => 'Title for the new page.',
							),
							'pattern_slugs' => array(
								'type'        => 'array',
								'description' => 'Ordered list of Sydney pattern slugs (e.g. sydney/hero-1). Markup is concatenated in this order.',
								'items'       => array( 'type' => 'string' ),
							),
							'template'      => array(
								'type'        => 'string',
								'description' => 'Optional page template. Use "canvas" for the full-width Sydney Canvas template, or a raw template file path.',
							),
							'status'        => array(
								'type'        => 'string',
								'description' => 'Post status. One of draft, publish, pending, private. Defaults to draft.',
								'enum'        => array( 'draft', 'publish', 'pending', 'private' ),
							),
						),
					),
					'output_schema'    => Sydney_Ability::envelope_schema(
						array(
									'page_id'     => array( 'type' => 'integer' ),
									'edit_url'    => array( 'type' => 'string' ),
									'preview_url' => array( 'type' => 'string' ),
									'used'        => array(
										'type'  => 'array',
										'items' => array( 'type' => 'string' ),
									),
						)
					),
					'execute_callback' => array( $this, 'execute_create_page_from_patterns' ),
					'meta'             => array(
						'annotations' => array_merge( Sydney_Ability::WRITE_ANNOTATIONS, array( 'idempotent' => false ) ),
					),
				)
			);
		}

		/**
		 * Whether the pattern-library module is active.
		 *
		 * Protected so tests can override without the module option.
		 *
		 * @return bool
		 */
		protected function pattern_library_active() {
			return class_exists( 'Sydney_Modules' ) && Sydney_Modules::is_module_active( 'pattern-library' );
		}

		/**
		 * All registered block patterns.
		 *
		 * Protected so tests can override without the final core registry class.
		 *
		 * @return array
		 */
		protected function get_all_patterns() {
			if ( ! class_exists( 'WP_Block_Patterns_Registry' ) ) {
				return array();
			}
			return WP_Block_Patterns_Registry::get_instance()->get_all_registered();
		}

		/**
		 * A single registered pattern by slug, or null.
		 *
		 * Protected so tests can override without the final core registry class.
		 *
		 * @param string $slug Pattern slug.
		 * @return array|null
		 */
		protected function get_pattern_by_slug( $slug ) {
			if ( ! class_exists( 'WP_Block_Patterns_Registry' ) ) {
				return null;
			}
			return WP_Block_Patterns_Registry::get_instance()->get_registered( $slug );
		}

		/**
		 * Pattern-name prefixes recognized as Sydney's own, filterable so
		 * Sydney Pro / child themes can register additional prefixes.
		 *
		 * @return string[]
		 */
		public static function pattern_prefixes() {
			/**
			 * Filters the pattern-name prefixes treated as Sydney patterns.
			 *
			 * @param string[] $prefixes Pattern name prefixes (e.g. 'sydney/').
			 */
			return apply_filters( 'sydney_abilities_pattern_prefixes', self::PREFIXES );
		}

		/**
		 * Whether a pattern name belongs to Sydney (free or pro).
		 *
		 * @param string $name Pattern name.
		 * @return bool
		 */
		protected function is_sydney_pattern( $name ) {
			foreach ( static::pattern_prefixes() as $prefix ) {
				if ( 0 === strpos( (string) $name, $prefix ) ) {
					return true;
				}
			}
			return false;
		}

		/**
		 * Execute: enumerate Sydney's registered patterns.
		 *
		 * @param array $args Ability args (unused).
		 * @return array Response envelope.
		 */
		public function execute_list_patterns( $args ) {

			if ( ! $this->pattern_library_active() ) {
				return Sydney_Abilities_Response::error(
					__( 'The Sydney pattern library module is not active. Enable it to list patterns.', 'sydney' )
				);
			}

			$patterns = array();

			foreach ( $this->get_all_patterns() as $pattern ) {
				if ( empty( $pattern['name'] ) || ! $this->is_sydney_pattern( $pattern['name'] ) ) {
					continue;
				}

				$patterns[] = array(
					'slug'       => $pattern['name'],
					'title'      => isset( $pattern['title'] ) ? $pattern['title'] : '',
					'categories' => isset( $pattern['categories'] ) ? array_values( (array) $pattern['categories'] ) : array(),
					'keywords'   => isset( $pattern['keywords'] ) ? array_values( (array) $pattern['keywords'] ) : array(),
				);
			}

			return Sydney_Abilities_Response::success(
				/* translators: %d: number of patterns found. */
				sprintf( __( 'Found %d Sydney patterns.', 'sydney' ), count( $patterns ) ),
				array( 'patterns' => $patterns )
			);
		}

		/**
		 * Execute: create a page by stitching together patterns (all-or-nothing).
		 *
		 * Preflight-resolves EVERY requested slug first; a slug resolves only when
		 * it is known in the registry AND has non-empty content. If ANY slug is
		 * unknown or empty, nothing is created and an error envelope carrying the
		 * not_found list is returned. Only when all slugs resolve does it
		 * concatenate their serialized markup into post_content, insert a page,
		 * optionally assign the Sydney Canvas template, and return the new page id
		 * plus edit/preview URLs. On a post-insert failure (WP_Error from
		 * wp_insert_post, or any later step) the draft is deleted so no orphan
		 * remains.
		 *
		 * @param array $args Ability args. Expects:
		 *               title (string), pattern_slugs (string[]),
		 *               template (string, optional: 'canvas' or a template file),
		 *               status (string, optional, default 'draft').
		 * @return array Response envelope.
		 */
		public function execute_create_page_from_patterns( $args ) {

			if ( ! $this->pattern_library_active() ) {
				return Sydney_Abilities_Response::error(
					__( 'The Sydney pattern library module is not active. Enable it to assemble pages from patterns.', 'sydney' )
				);
			}

			$title = isset( $args['title'] ) ? sanitize_text_field( $args['title'] ) : '';
			if ( '' === $title ) {
				return Sydney_Abilities_Response::error(
					__( 'A non-empty page title is required.', 'sydney' )
				);
			}

			$slugs = isset( $args['pattern_slugs'] ) && is_array( $args['pattern_slugs'] ) ? $args['pattern_slugs'] : array();
			if ( empty( $slugs ) ) {
				return Sydney_Abilities_Response::error(
					__( 'At least one pattern slug is required in pattern_slugs.', 'sydney' )
				);
			}

			// Preflight-resolve EVERY slug in order before writing anything.
			// A slug resolves only when it is known AND has non-empty content.
			$content_parts = array();
			$used          = array();
			$not_found     = array();

			foreach ( $slugs as $slug ) {
				$slug    = (string) $slug;
				$pattern = $this->get_pattern_by_slug( $slug );

				if ( ! is_array( $pattern ) || ! isset( $pattern['content'] ) || '' === $pattern['content'] ) {
					$not_found[] = $slug;
					continue;
				}

				$content_parts[] = $pattern['content'];
				$used[]          = $slug;
			}

			// All-or-nothing: if ANY slug failed to resolve, create nothing and
			// return the not_found list so the caller can fix slugs and retry.
			if ( ! empty( $not_found ) ) {
				return Sydney_Abilities_Response::error(
					/* translators: %s: comma-separated list of unresolved pattern slugs. */
					sprintf( __( 'No page was created. These pattern slugs are unknown or empty: %s', 'sydney' ), implode( ', ', $not_found ) ),
					array( 'not_found' => $not_found )
				);
			}

			$post_content = implode( "\n\n", $content_parts );

			// Resolve status against the allow-list; anything else falls back to draft.
			$status = isset( $args['status'] ) ? (string) $args['status'] : 'draft';
			if ( ! in_array( $status, self::ALLOWED_STATUSES, true ) ) {
				$status = 'draft';
			}

			// The ability's registration floor is edit_theme_options, which does not
			// imply content capabilities — enforce the page caps core would require:
			// publish/private need publish_pages, draft/pending need edit_pages.
			$needed_cap = in_array( $status, array( 'publish', 'private' ), true ) ? 'publish_pages' : 'edit_pages';
			if ( ! current_user_can( $needed_cap ) ) {
				return Sydney_Abilities_Response::error(
					/* translators: %s: requested post status. */
					sprintf( __( 'You are not allowed to create a page with the "%s" status.', 'sydney' ), $status )
				);
			}

			// wp_insert_post() expects slashed data (it runs wp_unslash on it);
			// pattern markup contains literal backslash escapes (- etc.)
			// that would otherwise be stripped, corrupting the block JSON.
			$page_id = wp_insert_post(
				array(
					'post_title'   => wp_slash( $title ),
					'post_type'    => 'page',
					'post_status'  => $status,
					'post_content' => wp_slash( $post_content ),
				)
			);

			if ( is_wp_error( $page_id ) || ! $page_id ) {
				return Sydney_Abilities_Response::error(
					__( 'The page could not be created.', 'sydney' )
				);
			}

			$page_id = (int) $page_id;

			// Optional page template. 'canvas' maps to the Sydney Canvas template;
			// any other non-empty value is treated as a raw template file path.
			// On failure, roll back the freshly-inserted draft so no orphan remains.
			if ( ! empty( $args['template'] ) ) {
				$template = ( 'canvas' === $args['template'] ) ? self::CANVAS_TEMPLATE : (string) $args['template'];
				$meta_ok  = update_post_meta( $page_id, '_wp_page_template', $template );

				if ( false === $meta_ok ) {
					wp_delete_post( $page_id, true );
					return Sydney_Abilities_Response::error(
						__( 'The page template could not be assigned; the draft was removed.', 'sydney' )
					);
				}
			}

			$data = array(
				'page_id'     => $page_id,
				'edit_url'    => get_edit_post_link( $page_id, 'raw' ),
				'preview_url' => get_preview_post_link( $page_id ),
				'used'        => $used,
			);

			return Sydney_Abilities_Response::success(
				/* translators: 1: page title, 2: number of patterns used. */
				sprintf( __( 'Created page "%1$s" from %2$d patterns.', 'sydney' ), $title, count( $used ) ),
				$data
			);
		}
	}

endif;
