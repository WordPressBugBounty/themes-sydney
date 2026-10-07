<?php
/**
 * Display Conditions
 *
 * Front-end evaluation engine. The admin-only helpers that build the modal and
 * answer the select2 ajax search live in inc/display-conditions-admin.php.
 *
 * @package Sydney
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Per-request cache store for the display conditions engine.
 *
 * Every memo lives in this one array so sydney_display_conditions_reset_cache()
 * can flush all of them at once. Returned by reference so callers write
 * straight into the static.
 *
 * @return array {
 *     @type array|null $registry Memoized condition registry, null until built.
 *     @type array      $options  Memoized get_option() reads, keyed by option name.
 *     @type array      $results  Memoized evaluation results, keyed by rule-set hash.
 * }
 */
function &sydney_display_conditions_cache() {

	static $cache = array(
		'registry' => null,
		'options'  => array(),
		'results'  => array(),
	);

	return $cache;
}

/**
 * Flush the display conditions per-request caches.
 *
 * Nothing in the theme calls this: within a single request the registry, the
 * template builder option and the evaluation results are all invariant. It
 * exists so unit tests (whose statics outlive the test that filled them) can
 * start from a clean slate, and as an escape hatch for code that changes the
 * template builder option mid-request.
 *
 * @return void
 */
function sydney_display_conditions_reset_cache() {

	$cache = &sydney_display_conditions_cache();

	$cache = array(
		'registry' => null,
		'options'  => array(),
		'results'  => array(),
	);
}

/**
 * Read an option once per request.
 *
 * sydney_templates_display_conditions() and sydney_get_global_template() both
 * walk the same template builder option, so the read is shared between them.
 *
 * @param string $option Option name.
 * @return mixed Option value.
 */
function sydney_display_conditions_get_option( $option ) {

	$cache = &sydney_display_conditions_cache();

	if ( ! array_key_exists( $option, $cache['options'] ) ) {
		$cache['options'][ $option ] = get_option( $option );
	}

	return $cache['options'][ $option ];
}

/**
 * Display Conditions for the templates
 */
function sydney_templates_display_conditions( $option ) {

	$templates = sydney_display_conditions_get_option( $option );

	// If no templates, return
	if ( empty( $templates ) || ! is_array( $templates ) ) {
		return false;
	}

	// Last matching row wins, exactly like the end() of the old results array.
	// end() on an empty array returns false, which is the no-match return here.
	$result = false;

	foreach ( $templates as $key => $template ) {

		if ( ! is_array( $template ) ) {
			continue;
		}

		$conditions = ( isset( $template['conditions'] ) ) ? $template['conditions'] : array();
		$conditions = ( is_string( $conditions ) ) ? json_decode( $conditions, true ) : $conditions;
		$conditions = ( is_array( $conditions ) ) ? $conditions : array();

		if ( sydney_get_display_conditions( $conditions, false ) || ( isset( $template['id'] ) && 'global' === $template['id'] ) ) {
			$result = array(
				'header'        => $template['header'] ?? '',
				'page_title'    => $template['page_title'] ?? '',
				'content'       => $template['content'] ?? '',
				'footer'        => $template['footer'] ?? '',
			);
		}
	}

	return $result;
}

/**
 * Get the global template
 */
function sydney_get_global_template() {
	$templates = sydney_display_conditions_get_option( 'sydney_template_builder_data' );

	// If no templates, return
	if ( empty( $templates ) || ! is_array( $templates ) ) {
		return;
	}

	$template  = array();

	foreach ( $templates as $key => $value ) {
		if ( isset( $value['id'] ) && 'global' === $value['id'] ) {
			$template[] = array(
				'header'        => $value['header'] ?? '',
				'page_title'    => $value['page_title'] ?? '',
				'content'       => $value['content'] ?? '',
				'footer'        => $value['footer'] ?? '',
			);
		}
	}

	return $template;
}

/**
 * The display conditions registry.
 *
 * Maps a condition id to a predicate that answers "does the current request
 * match this condition?". Each predicate receives the rule's integer id and the
 * raw rule array, and returns a boolean. It is only invoked when a rule names
 * that exact condition id, so the predicate bodies keep the short-circuit
 * behaviour of the if-chain they replaced.
 *
 * The array is memoized for the request: nothing in it can change mid-request,
 * including whether WooCommerce is loaded.
 *
 * @return array Condition id => callable( int $object_id, array $rule ): bool.
 */
function sydney_get_display_conditions_registry() {

	$cache = &sydney_display_conditions_cache();

	if ( is_array( $cache['registry'] ) ) {
		return $cache['registry'];
	}

	$registry = array(

		// Entire Site
		'all' => function( $object_id, $rule ) {
			return true;
		},

		// Basic
		'singular' => function( $object_id, $rule ) {
			return (bool) is_singular();
		},

		'singular-post-type' => function( $object_id, $rule ) {

			// This condition stores a post type slug, not an ID, so the raw rule
			// value is what carries it. sanitize_key() is deliberately not applied:
			// is_singular() compares with in_array( …, …, true ), so a key the
			// sanitizer rewrote would silently never match. The raw value is
			// validated against what is registered instead.
			$object_slug = ( isset( $rule['id'] ) && is_scalar( $rule['id'] ) ) ? trim( (string) $rule['id'] ) : '';

			if ( $object_slug === '' ) {
				return false;
			}

			if ( post_type_exists( $object_slug ) ) {
				return (bool) is_singular( $object_slug );
			}

			// No absint()-era rules exist for this condition, so unlike
			// post-type-archive there is nothing to honour with a bare
			// is_singular() fallback: a slug that is empty, numeric or no longer
			// registered simply matches nothing.
			return false;
		},

		'archive' => function( $object_id, $rule ) {
			return (bool) is_archive();
		},

		'post-type-archive' => function( $object_id, $rule ) {

			// This condition stores a post type slug, not an ID, so the raw rule
			// value is what carries it. sanitize_key() is deliberately not applied:
			// is_post_type_archive() compares with in_array( …, …, true ), so a key
			// the sanitizer rewrote would silently never match. The raw value is
			// validated against what is registered instead.
			$object_slug = ( isset( $rule['id'] ) && is_scalar( $rule['id'] ) ) ? trim( (string) $rule['id'] ) : '';

			if ( $object_slug !== '' && post_type_exists( $object_slug ) ) {
				return (bool) is_post_type_archive( $object_slug );
			}

			// Rules saved while the slug was being absint()ed kept an empty or a
			// numeric id. Those keep the bare is_post_type_archive() check, which
			// matches any post type archive exactly like it did before.
			if ( $object_slug === '' || is_numeric( $object_slug ) ) {
				return (bool) is_post_type_archive();
			}

			// A post type that is named but not registered right now - a deactivated
			// plugin - matches nothing rather than every archive.
			return false;
		},

		// Posts
		'single-post' => function( $object_id, $rule ) {
			return (bool) is_single();
		},

		'post-archives' => function( $object_id, $rule ) {
			return (bool) is_archive();
		},

		'post-categories' => function( $object_id, $rule ) {
			return (bool) is_category();
		},

		'post-tags' => function( $object_id, $rule ) {
			return (bool) is_tag();
		},

		'cpt-post-id' => function( $object_id, $rule ) {
			return ( $object_id > 0 && get_queried_object_id() === $object_id );
		},

		'cpt-term-id' => function( $object_id, $rule ) {
			return ( $object_id > 0 && get_queried_object_id() === $object_id );
		},

		'cpt-taxonomy-id' => function( $object_id, $rule ) {

			// This condition stores a taxonomy slug, not an ID. sanitize_key() is
			// deliberately not applied: register_taxonomy() does not lowercase the
			// key it is given and is_tax() intersects against the registered keys
			// as-is, so a sanitized key would silently never match. The raw value is
			// validated against what is registered instead.
			$object_slug = ( isset( $rule['id'] ) && is_scalar( $rule['id'] ) ) ? trim( (string) $rule['id'] ) : '';

			if ( $object_slug !== '' && taxonomy_exists( $object_slug ) ) {
				return (bool) is_tax( $object_slug );
			}

			// Rules saved before the slug was preserved on save kept an empty or a
			// numeric id, so those keep falling back to a bare is_tax() check, which
			// matches any custom taxonomy archive exactly like it did before.
			if ( $object_slug === '' || is_numeric( $object_slug ) ) {
				return (bool) is_tax();
			}

			// A taxonomy that is named but not registered right now matches nothing
			// rather than every taxonomy archive.
			return false;
		},

		'taxonomy-term-id' => function( $object_id, $rule ) {

			if ( $object_id <= 0 ) {
				return false;
			}

			// is_category() and is_tag() take the term themselves; every other
			// public taxonomy archive has to be compared against the queried term.
			return ( is_category( $object_id ) || is_tag( $object_id ) || ( is_tax() && get_queried_object_id() === $object_id ) );
		},

		'has-term' => function( $object_id, $rule ) {

			// taxonomy-term-id above matches the term's own archive; this one
			// matches singular content the term is assigned to.
			if ( $object_id <= 0 || ! is_singular() ) {
				return false;
			}

			// get_term() answers null for a term that is gone and WP_Error for a
			// broken taxonomy, so the instanceof covers both.
			$term = get_term( $object_id );

			return ( $term instanceof WP_Term && has_term( $term->term_id, $term->taxonomy ) );
		},

		// Pages
		'single-page' => function( $object_id, $rule ) {
			return (bool) is_page();
		},

		'page-template' => function( $object_id, $rule ) {

			// This condition stores a page template file such as
			// `templates/full-width.php`. sanitize_key() would strip the slash and
			// the dot out of it, so the value is only trimmed of stray markup here.
			$object_template = ( ! empty( $rule['id'] ) && is_scalar( $rule['id'] ) ) ? sanitize_text_field( (string) $rule['id'] ) : '';

			if ( $object_template === '' ) {
				return false;
			}

			return (bool) is_page_template( $object_template );
		},

		'page-parent' => function( $object_id, $rule ) {

			if ( $object_id <= 0 || ! is_page() ) {
				return false;
			}

			// Ancestors, not the direct parent, so a grandchild page matches too.
			$ancestors = (array) get_post_ancestors( get_queried_object_id() );

			return in_array( $object_id, array_map( 'intval', $ancestors ), true );
		},

	);

	// The groups below are unioned with += rather than array_merge(): '404' is a
	// numeric array key, and array_merge() would renumber it out of reach of the
	// '404' condition lookup.

	// WooCommerce
	if ( class_exists( 'WooCommerce' ) ) {

		$registry += array(

			'single-product' => function( $object_id, $rule ) {
				return (bool) is_singular( 'product' );
			},

			'product-archives' => function( $object_id, $rule ) {
				return ( is_shop() || is_product_tag() || is_product_category() );
			},

			'product-categories' => function( $object_id, $rule ) {
				return (bool) is_product_category();
			},

			'product-tags' => function( $object_id, $rule ) {
				return (bool) is_product_tag();
			},

			'product-id' => function( $object_id, $rule ) {
				return ( $object_id > 0 && get_queried_object_id() === $object_id );
			},

			'woo-cart' => function( $object_id, $rule ) {
				return (bool) is_cart();
			},

			'woo-checkout' => function( $object_id, $rule ) {
				return (bool) is_checkout();
			},

			'woo-account' => function( $object_id, $rule ) {
				return (bool) is_account_page();
			},

			'woo-order-received' => function( $object_id, $rule ) {
				return (bool) is_order_received_page();
			},

		);

	}

	$registry += array(

		// Specific
		'post-id' => function( $object_id, $rule ) {
			return ( $object_id > 0 && get_queried_object_id() === $object_id );
		},

		'page-id' => function( $object_id, $rule ) {
			return ( $object_id > 0 && get_queried_object_id() === $object_id );
		},

		'category-id' => function( $object_id, $rule ) {
			return ( is_category() && get_queried_object_id() === $object_id );
		},

		'tag-id' => function( $object_id, $rule ) {
			return ( is_tag() && get_queried_object_id() === $object_id );
		},

		// Matches both the author archive and any single entry written by that
		// author, which is what this condition resolved to on wp_footer before.
		'author-id' => function( $object_id, $rule ) {
			return ( $object_id > 0 && ( is_author( $object_id ) || ( is_singular() && (int) get_post_field( 'post_author', get_queried_object_id() ) === $object_id ) ) );
		},

		// User Auth
		'logged-in' => function( $object_id, $rule ) {
			return (bool) is_user_logged_in();
		},

		'logged-out' => function( $object_id, $rule ) {
			return ! is_user_logged_in();
		},

		'user-can' => function( $object_id, $rule ) {

			// This condition stores a capability name, not an ID, so the raw rule
			// value is what carries it.
			$object_slug = ( isset( $rule['id'] ) && is_scalar( $rule['id'] ) ) ? trim( (string) $rule['id'] ) : '';

			if ( $object_slug === '' ) {
				return false;
			}

			return (bool) current_user_can( $object_slug );
		},

		// Others
		'front-page' => function( $object_id, $rule ) {
			return (bool) is_front_page();
		},

		'blog' => function( $object_id, $rule ) {
			return (bool) is_home();
		},

		'404' => function( $object_id, $rule ) {
			return (bool) is_404();
		},

		'search' => function( $object_id, $rule ) {
			return (bool) is_search();
		},

		'author' => function( $object_id, $rule ) {
			return (bool) is_author();
		},

		'date-archive' => function( $object_id, $rule ) {
			return (bool) is_date();
		},

		'paged' => function( $object_id, $rule ) {
			return (bool) is_paged();
		},

		'privacy-policy-page' => function( $object_id, $rule ) {

			if ( ! is_page() ) {
				return false;
			}

			$post_id    = intval( get_queried_object_id() );
			$privacy_id = intval( get_option( 'wp_page_for_privacy_policy' ) );

			return ( $post_id > 0 && $privacy_id > 0 && $post_id === $privacy_id );
		},

		'schedule' => function( $object_id, $rule ) {

			// This condition carries its own bounds instead of an ID: `start` and
			// `end` are each either '' or a `Y-m-d\TH:i` string in the site timezone.
			$start = ( isset( $rule['start'] ) && is_scalar( $rule['start'] ) ) ? trim( (string) $rule['start'] ) : '';
			$end   = ( isset( $rule['end'] ) && is_scalar( $rule['end'] ) ) ? trim( (string) $rule['end'] ) : '';

			// Shape is checked here rather than trusted from whichever surface saved
			// the rule: the customizer settings sanitize the whole set as text, so a
			// bound can reach this predicate as any string, and the comparison below
			// is lexicographic - `'2026-08-17T14:30' <= '9'` would be a window that
			// never closes. A malformed bound makes the rule inert instead.
			foreach ( array( $start, $end ) as $bound ) {
				if ( '' !== $bound && ! preg_match( '/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}$/', $bound ) ) {
					return false;
				}
			}

			// A window with no bounds at all matches nothing, so a half-configured
			// row stays inert instead of matching every request.
			if ( $start === '' && $end === '' ) {
				return false;
			}

			// current_time() rather than current_datetime(), which is WP 5.3+ - both
			// read the same site-timezone wall clock.
			$now = current_time( 'Y-m-d\TH:i' );

			// `Y-m-d\TH:i` is fixed width and most significant first, so comparing
			// the strings orders the bounds correctly without parsing them.
			return ( ( $start === '' || $now >= $start ) && ( $end === '' || $now <= $end ) );
		},

	);

	/**
	 * Filter the display conditions registry.
	 *
	 * Add a condition id mapped to a callable( int $object_id, array $rule ): bool
	 * to teach the engine a new condition, or replace an existing entry to change
	 * how a built-in condition matches.
	 *
	 * @param array $registry Condition id => predicate callable.
	 */
	$registry = apply_filters( 'sydney_display_conditions_registry', $registry );
	$registry = is_array( $registry ) ? $registry : array();

	$cache['registry'] = $registry;

	return $registry;
}

/**
 * Display Conditions
 *
 * v2 semantics evaluate the whole rule set as one boolean instead of letting the
 * last matching rule overwrite the ones before it:
 *
 *     result = ( has_resolvable_includes ? any_include_matched : $default ) && ! any_exclude_matched
 *
 * Includes therefore behave like an OR list and excludes veto the outcome. A rule
 * set that resolves to nothing - every row half-saved, or naming a condition no
 * longer in the registry - still returns the default untouched.
 *
 * Two outcomes differ from the pre-4.x last-match-wins loop:
 *
 * 1. An exclude no longer loses to a matching include placed after it. A matching
 *    exclude now vetoes the result whatever its position in the set.
 * 2. On a default-true consumer, a rule set that only holds includes and matches
 *    none of them now returns false. It used to fall through to the default and
 *    show up everywhere the includes did not name.
 *
 * Return 'legacy' from `sydney_display_conditions_semantics` to get the old loop
 * back verbatim.
 *
 * The result is memoized per request, keyed by the resolved rule set, the default
 * and the semantics. Callers passing a theme mod name and callers passing the
 * decoded rule array therefore share one cache entry.
 *
 * BEHAVIOUR NOTE: because the memo stores the post-filter value, the
 * `sydney_display_conditions_result` filter now fires once per unique rule set
 * per request instead of once per call. The contract is unchanged for a given
 * input - the same rules still produce the same filtered result - but a filter
 * callback that counts invocations or reacts to unrelated state will see fewer
 * calls. Return false from `sydney_display_conditions_use_cache` to opt out.
 */
function sydney_get_display_conditions( $maybe_rules, $default = true, $mod_default = '[]' ) {

	$rules  = array();
	$result = $default;

	if ( is_array( $maybe_rules ) ) {
		$rules = $maybe_rules;
	} else {
		$option = get_theme_mod( $maybe_rules, $mod_default );
		$rules  = is_string( $option ) ? json_decode( $option, true ) : $option;
		$rules  = is_array( $rules ) ? $rules : array();
	}

	/**
	 * Filter which evaluation semantics the engine applies.
	 *
	 * The escape hatch back to the pre-4.x behaviour, where the last matching
	 * rule overwrote every rule before it. Return 'legacy' for that loop;
	 * anything else - 'v2' included - keeps the include/exclude formula
	 * documented above.
	 *
	 * The default is 'legacy' because the two editions are at different points:
	 * Pro has shipped the v2 formula since 4.x and filters this back to 'v2'
	 * from inc/pro/functions.php, while free has only ever run the old loop. A
	 * shared 'v2' default would silently re-evaluate every free site that has a
	 * matching exclude sitting before a matching include - free's own control
	 * offers both row types - and the transparent header would vanish with no
	 * migration and no notice. The predicate fixes apply under both semantics,
	 * so free still gets those.
	 *
	 * @param string $semantics Either 'v2' or 'legacy'. Default 'legacy'.
	 */
	$semantics = apply_filters( 'sydney_display_conditions_semantics', 'legacy' );

	$cache     = &sydney_display_conditions_cache();
	$cache_key = '';

	/**
	 * Filter whether the per-request result cache is used.
	 *
	 * @param bool $use_cache Whether to memoize the evaluation. Default true.
	 */
	$use_cache = apply_filters( 'sydney_display_conditions_use_cache', true );

	if ( $use_cache ) {

		// The key only has to be a stable hash of the inputs, and the semantics
		// are one of them.
		$cache_key = md5( (string) wp_json_encode( array( $rules, $default, $semantics ) ) );

		if ( array_key_exists( $cache_key, $cache['results'] ) ) {
			return $cache['results'][ $cache_key ];
		}

	}

	if ( ! empty( $rules ) ) {

		$registry = sydney_get_display_conditions_registry();

		if ( $semantics === 'legacy' ) {

			// Frozen copy of the pre-4.x loop, get_userdata() call site included.
			// Nothing here changes when the v2 branch below does.
			foreach ( $rules as $rule ) {

				if ( ! is_array( $rule ) ) {
					continue;
				}

				$object_id = ( ! empty( $rule['id'] ) ) ? intval( $rule['id'] ) : 0;
				$condition = ( ! empty( $rule['condition'] ) ) ? $rule['condition'] : '';
				$type      = ( ! empty( $rule['type'] ) ) ? $rule['type'] : '';

				// Half-saved rules carry no condition or no usable type. Skip them
				// instead of reading them as an exclude.
				if ( $condition === '' || ! in_array( $type, array( 'include', 'exclude' ), true ) ) {
					continue;
				}

				$boolean = ( $type === 'include' ) ? true : false;

				if ( isset( $registry[ $condition ] ) && is_callable( $registry[ $condition ] ) && $registry[ $condition ]( $object_id, $rule ) ) {
					$result = $boolean;
				}

				// User Roles
				if ( substr( $condition, 0, 10 ) === 'user_role_' && is_user_logged_in() ) {

					$user_role  = str_replace( 'user_role_', '', $condition );
					$user_id    = get_current_user_id();
					$user_data  = get_userdata( $user_id );
					$user_roles = ( $user_data && ! empty( $user_data->roles ) ) ? (array) $user_data->roles : array();

					if ( in_array( $user_role, $user_roles, true ) ) {
						$result = $boolean;
					}

				}

			}

		} else {

			$resolved    = false;
			$has_include = false;
			$include_hit = false;
			$exclude_hit = false;

			// Roles are read at most once per evaluation, however many role rules
			// the set holds. null means "not read yet", an array means read.
			$user_roles = null;

			foreach ( $rules as $rule ) {

				if ( ! is_array( $rule ) ) {
					continue;
				}

				$object_id = ( ! empty( $rule['id'] ) ) ? intval( $rule['id'] ) : 0;
				$condition = ( ! empty( $rule['condition'] ) ) ? $rule['condition'] : '';
				$type      = ( ! empty( $rule['type'] ) ) ? $rule['type'] : '';

				// Half-saved rules carry no condition or no usable type. Skip them
				// instead of reading them as an exclude.
				if ( $condition === '' || ! in_array( $type, array( 'include', 'exclude' ), true ) ) {
					continue;
				}

				$is_registered = ( isset( $registry[ $condition ] ) && is_callable( $registry[ $condition ] ) );
				$is_role       = ( substr( $condition, 0, 10 ) === 'user_role_' );

				// A condition nothing can answer - a deactivated plugin's, or one a
				// filter stopped registering - is skipped whole. It must not count as
				// an include, or the set would start hiding everything it does not
				// name the moment that plugin goes away.
				if ( ! $is_registered && ! $is_role ) {
					continue;
				}

				$resolved = true;
				$matches  = false;

				if ( $is_registered ) {
					$matches = (bool) $registry[ $condition ]( $object_id, $rule );
				}

				// User Roles
				if ( ! $matches && $is_role ) {

					if ( $user_roles === null ) {
						$user_data  = is_user_logged_in() ? get_userdata( get_current_user_id() ) : false;
						$user_roles = ( $user_data && ! empty( $user_data->roles ) ) ? (array) $user_data->roles : array();
					}

					$matches = in_array( str_replace( 'user_role_', '', $condition ), $user_roles, true );

				}

				if ( $type === 'include' ) {

					$has_include = true;

					if ( $matches ) {
						$include_hit = true;
					}

				} elseif ( $matches ) {
					$exclude_hit = true;
				}

			}

			// With no include to satisfy, the default carries the first half of the
			// formula: a set of excludes that match nothing leaves the caller's
			// default alone rather than forcing a true.
			if ( $resolved ) {
				$result = ( $has_include ? $include_hit : $default ) && ! $exclude_hit;
			}

		}

	}

	$result = apply_filters( 'sydney_display_conditions_result', $result, $rules );

	if ( $use_cache ) {
		$cache['results'][ $cache_key ] = $result;
	}

	return $result;
}
