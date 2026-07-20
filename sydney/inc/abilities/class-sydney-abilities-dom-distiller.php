<?php
/**
 * DOM distiller for the page-structure abilities.
 *
 * Pure, WordPress-independent: takes an HTML string and produces compact,
 * token-cheap structure summaries for AI clients writing CSS. No fetching,
 * no options, no theme mods — the group class owns those. This class only
 * parses and distills, so it can be unit-tested against fixed HTML fixtures.
 *
 * @package Sydney
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Sydney_Abilities_DOM_Distiller' ) ) :

	/**
	 * Distills rendered HTML into indented plain-text structure summaries.
	 */
	class Sydney_Abilities_DOM_Distiller {

		/**
		 * Tags dropped entirely (node and contents removed from the summary).
		 */
		const DROP_TAGS = array( 'script', 'style', 'noscript', 'link', 'meta', 'template', 'head' );

		/**
		 * Tags kept as a leaf line but never recursed into.
		 */
		const LEAF_TAGS = array( 'svg', 'iframe' );

		/**
		 * Maximum characters of a text snippet.
		 */
		const SNIPPET_LEN = 30;

		/**
		 * Parsed document.
		 *
		 * @var DOMDocument|null
		 */
		private $dom = null;

		/**
		 * XPath helper.
		 *
		 * @var DOMXPath|null
		 */
		private $xpath = null;

		/**
		 * Whether the HTML parsed successfully.
		 *
		 * @var bool
		 */
		private $loaded = false;

		/**
		 * Parse the HTML.
		 *
		 * @param string $html Rendered HTML.
		 */
		public function __construct( $html ) {
			if ( ! is_string( $html ) || '' === trim( $html ) ) {
				return;
			}

			$dom  = new DOMDocument();
			$prev = libxml_use_internal_errors( true );

			// The XML encoding hint forces UTF-8 interpretation without the
			// deprecated mb_convert_encoding('HTML-ENTITIES') dance (PHP 8.2+).
			$ok = $dom->loadHTML( '<?xml encoding="utf-8"?>' . $html, LIBXML_NOWARNING | LIBXML_NOERROR );

			libxml_clear_errors();
			libxml_use_internal_errors( $prev );

			if ( ! $ok ) {
				return;
			}

			$this->dom    = $dom;
			$this->xpath  = new DOMXPath( $dom );
			$this->loaded = true;
		}

		/**
		 * Did the HTML parse?
		 *
		 * @return bool
		 */
		public function is_loaded() {
			return $this->loaded;
		}

		/**
		 * Distilled whole-page (or subtree) tree as indented plain text.
		 *
		 * @param string $selector  Optional simple selector to scope the tree.
		 * @param int    $max_depth Maximum visual nesting depth.
		 * @param int    $size_cap  Hard character cap; depth auto-reduces to fit.
		 * @return string Indented tree, or '' if not loaded / selector unmatched.
		 */
		public function tree( $selector = '', $max_depth = 8, $size_cap = 15360 ) {
			if ( ! $this->loaded ) {
				return '';
			}

			$max_depth = max( 1, (int) $max_depth );

			if ( '' !== (string) $selector ) {
				$roots = $this->select_by_css( $selector, $this->body() );
				if ( empty( $roots ) ) {
					return '';
				}
				$root = $roots[0];
			} else {
				$root = $this->body();
			}

			if ( ! $root ) {
				return '';
			}

			$depth  = $max_depth;
			$output = '';
			$note   = '';

			// Render, then shrink depth until the output fits the size cap.
			while ( $depth >= 1 ) {
				$lines  = $this->render_node( $root, 0, 0, $depth );
				$output = implode( "\n", $lines );
				if ( strlen( $output ) <= $size_cap || 1 === $depth ) {
					if ( $depth < $max_depth ) {
						$note = "\n… (output truncated to depth {$depth} to fit size limit)";
					}
					break;
				}
				--$depth;
			}

			return $output . $note;
		}

		/**
		 * Scoped element query returning a compact summary of matches.
		 *
		 * @param array $filters        text|selector|area filters (at least one).
		 * @param int   $context_levels Ancestor levels to include per match.
		 * @param int   $max_matches    Cap on reported matches.
		 * @return string Summary text.
		 */
		public function find( array $filters, $context_levels = 3, $max_matches = 10 ) {
			if ( ! $this->loaded ) {
				return 'Could not parse the page HTML.';
			}

			$context_levels = max( 0, (int) $context_levels );
			$max_matches    = max( 1, (int) $max_matches );

			$scope = $this->body();
			if ( ! empty( $filters['area'] ) ) {
				$area_node = $this->resolve_area( $filters['area'] );
				if ( ! $area_node ) {
					return sprintf( 'No "%s" landmark found on the page.', $filters['area'] );
				}
				$scope = $area_node;
			}

			$sets = array();
			if ( ! empty( $filters['selector'] ) ) {
				$sets[] = $this->select_by_css( $filters['selector'], $scope );
			}
			if ( isset( $filters['text'] ) && '' !== (string) $filters['text'] ) {
				$sets[] = $this->find_by_text( (string) $filters['text'], $scope );
			}

			if ( empty( $sets ) ) {
				// Area-only query: report the landmark subtree's top elements.
				$sets[] = $this->element_children( $scope );
			}

			$matches = $this->intersect_node_sets( $sets );

			if ( empty( $matches ) ) {
				return $this->zero_match_message( $filters, $scope );
			}

			$total   = count( $matches );
			$shown   = array_slice( $matches, 0, $max_matches );
			$out      = array();
			$header   = sprintf( '%d match%s found', $total, 1 === $total ? '' : 'es' );
			if ( $total > count( $shown ) ) {
				$header .= sprintf( ' (showing first %d)', count( $shown ) );
			}
			$out[] = $header . ':';

			$i = 0;
			foreach ( $shown as $node ) {
				++$i;
				$out[] = '';
				$out[] = sprintf( 'match %d of %d:', $i, $total );
				$out[] = '  ' . $this->ancestor_path( $node, $context_levels );
				$out[] = '  ' . $this->sig_with_text( $node );

				$kids = $this->child_signatures( $node );
				if ( empty( $kids ) ) {
					$out[] = '    (no children)';
				} else {
					foreach ( $kids as $kid ) {
						$out[] = '    ' . $kid;
					}
				}

				$sibs = $this->sibling_signatures( $node );
				if ( ! empty( $sibs ) ) {
					$out[] = '  siblings: ' . implode( ', ', $sibs );
				}
			}

			return implode( "\n", $out );
		}

		/* ------------------------------------------------------------------ *
		 * Rendering helpers
		 * ------------------------------------------------------------------ */

		/**
		 * Recursively render a node into indented lines (wrapper chains collapsed).
		 *
		 * @param DOMElement $node         Node to render.
		 * @param int        $depth        Current logical depth.
		 * @param int        $indent_level Indentation level.
		 * @param int        $max_depth    Maximum depth.
		 * @return string[]
		 */
		private function render_node( $node, $depth, $indent_level, $max_depth ) {
			$lines = array();

			// Collapse single-child wrapper chains onto one line.
			$chain = array( $this->sig_with_text( $node ) );
			$cur   = $node;
			while ( true ) {
				if ( '' !== $this->direct_text( $cur ) ) {
					break;
				}
				$only = $this->only_element_child( $cur );
				if ( ! $only ) {
					break;
				}
				$chain[] = $this->sig_with_text( $only );
				$cur     = $only;
			}

			$indent  = str_repeat( '  ', $indent_level );
			$lines[] = $indent . implode( ' > ', $chain );

			$kids = $this->kids_for_recurse( $cur );
			if ( empty( $kids ) ) {
				return $lines;
			}

			if ( $depth + 1 >= $max_depth ) {
				$deeper  = $this->subtree_depth( $cur );
				$lines[] = str_repeat( '  ', $indent_level + 1 ) . sprintf( '… (+%d deeper levels)', $deeper );
				return $lines;
			}

			// Render children with consecutive-duplicate collapsing.
			$count = count( $kids );
			$j     = 0;
			while ( $j < $count ) {
				$rep     = $kids[ $j ];
				$rep_key = $this->dedup_key( $rep );
				$run     = 1;
				while ( $j + $run < $count && $this->dedup_key( $kids[ $j + $run ] ) === $rep_key ) {
					++$run;
				}
				$child_lines = $this->render_node( $rep, $depth + 1, $indent_level + 1, $max_depth );
				if ( $run > 1 && ! empty( $child_lines ) ) {
					$child_lines[0] .= ' ×' . $run;
				}
				$lines = array_merge( $lines, $child_lines );
				$j    += $run;
			}

			return $lines;
		}

		/**
		 * Element signature: tag.class1.class2#id.
		 *
		 * @param DOMElement $el Element.
		 * @return string
		 */
		private function signature( $el ) {
			$sig = strtolower( $el->nodeName );

			$class = trim( (string) $el->getAttribute( 'class' ) );
			if ( '' !== $class ) {
				$parts = preg_split( '/\s+/', $class );
				$sig  .= '.' . implode( '.', $parts );
			}

			$id = trim( (string) $el->getAttribute( 'id' ) );
			if ( '' !== $id ) {
				$sig .= '#' . $id;
			}

			return $sig;
		}

		/**
		 * Signature with a trailing text snippet when the element has direct text.
		 *
		 * @param DOMElement $el Element.
		 * @return string
		 */
		private function sig_with_text( $el ) {
			$sig     = $this->signature( $el );
			$snippet = $this->direct_text( $el );
			if ( '' !== $snippet ) {
				$sig .= ' "' . $snippet . '"';
			}
			return $sig;
		}

		/**
		 * Deduplication key: structural signature ignoring id and digit-bearing
		 * class tokens (menu-item-123, post-45, …) so instance ids don't defeat
		 * sibling collapsing.
		 *
		 * @param DOMElement $el Element.
		 * @return string
		 */
		private function dedup_key( $el ) {
			$key   = strtolower( $el->nodeName );
			$class = trim( (string) $el->getAttribute( 'class' ) );
			if ( '' !== $class ) {
				$parts = array();
				foreach ( preg_split( '/\s+/', $class ) as $token ) {
					if ( ! preg_match( '/\d/', $token ) ) {
						$parts[] = $token;
					}
				}
				if ( ! empty( $parts ) ) {
					$key .= '.' . implode( '.', $parts );
				}
			}
			return $key;
		}

		/**
		 * Whitespace-collapsed snippet of an element's direct (own) text.
		 *
		 * @param DOMElement $el Element.
		 * @return string
		 */
		private function direct_text( $el ) {
			$text = '';
			foreach ( $el->childNodes as $child ) {
				if ( XML_TEXT_NODE === $child->nodeType ) {
					$text .= $child->nodeValue;
				}
			}
			return $this->snippet( $text );
		}

		/**
		 * Trim, collapse whitespace, and cap a text string.
		 *
		 * @param string $text Raw text.
		 * @return string
		 */
		private function snippet( $text ) {
			$text = trim( preg_replace( '/\s+/', ' ', (string) $text ) );
			if ( '' === $text ) {
				return '';
			}
			if ( function_exists( 'mb_strlen' ) && mb_strlen( $text ) > self::SNIPPET_LEN ) {
				return mb_substr( $text, 0, self::SNIPPET_LEN ) . '…';
			}
			if ( strlen( $text ) > self::SNIPPET_LEN ) {
				return substr( $text, 0, self::SNIPPET_LEN ) . '…';
			}
			return $text;
		}

		/* ------------------------------------------------------------------ *
		 * Traversal helpers
		 * ------------------------------------------------------------------ */

		/**
		 * The <body> element, or the document element as a fallback.
		 *
		 * @return DOMElement|null
		 */
		private function body() {
			$bodies = $this->dom->getElementsByTagName( 'body' );
			if ( $bodies->length ) {
				return $bodies->item( 0 );
			}
			return $this->dom->documentElement;
		}

		/**
		 * Non-dropped element children of a node.
		 *
		 * @param DOMElement $node Node.
		 * @return DOMElement[]
		 */
		private function element_children( $node ) {
			$out = array();
			foreach ( $node->childNodes as $child ) {
				if ( XML_ELEMENT_NODE === $child->nodeType && ! $this->is_dropped( $child ) ) {
					$out[] = $child;
				}
			}
			return $out;
		}

		/**
		 * Children to recurse into (leaf tags such as svg/iframe yield none).
		 *
		 * @param DOMElement $node Node.
		 * @return DOMElement[]
		 */
		private function kids_for_recurse( $node ) {
			if ( in_array( strtolower( $node->nodeName ), self::LEAF_TAGS, true ) ) {
				return array();
			}
			return $this->element_children( $node );
		}

		/**
		 * The single element child of a node, or null when zero/multiple.
		 *
		 * @param DOMElement $node Node.
		 * @return DOMElement|null
		 */
		private function only_element_child( $node ) {
			if ( in_array( strtolower( $node->nodeName ), self::LEAF_TAGS, true ) ) {
				return null;
			}
			$kids = $this->element_children( $node );
			return 1 === count( $kids ) ? $kids[0] : null;
		}

		/**
		 * Is this element a dropped tag?
		 *
		 * @param DOMElement $el Element.
		 * @return bool
		 */
		private function is_dropped( $el ) {
			return in_array( strtolower( $el->nodeName ), self::DROP_TAGS, true );
		}

		/**
		 * Maximum remaining element depth beneath a node.
		 *
		 * @param DOMElement $node Node.
		 * @return int
		 */
		private function subtree_depth( $node ) {
			$kids = $this->kids_for_recurse( $node );
			if ( empty( $kids ) ) {
				return 0;
			}
			$max = 0;
			foreach ( $kids as $kid ) {
				$max = max( $max, $this->subtree_depth( $kid ) );
			}
			return $max + 1;
		}

		/* ------------------------------------------------------------------ *
		 * find() helpers
		 * ------------------------------------------------------------------ */

		/**
		 * Landmark container for an area keyword.
		 *
		 * @param string $area header|footer|main|sidebar|nav.
		 * @return DOMElement|null
		 */
		private function resolve_area( $area ) {
			$queries = array(
				'header'  => array( '//header', "//*[contains(concat(' ',normalize-space(@class),' '),' site-header ')]" ),
				'footer'  => array( '//footer', "//*[contains(concat(' ',normalize-space(@class),' '),' site-footer ')]" ),
				'main'    => array( '//main', "//*[@id='content']", "//*[contains(concat(' ',normalize-space(@class),' '),' site-main ')]" ),
				'sidebar' => array( "//*[@id='secondary']", '//aside', "//*[contains(concat(' ',normalize-space(@class),' '),' widget-area ')]" ),
				'nav'     => array( '//nav', "//*[contains(concat(' ',normalize-space(@class),' '),' main-navigation ')]", "//*[contains(concat(' ',normalize-space(@class),' '),' mainnav ')]" ),
			);

			$area = strtolower( (string) $area );
			if ( ! isset( $queries[ $area ] ) ) {
				return null;
			}

			foreach ( $queries[ $area ] as $q ) {
				$nodes = $this->xpath->query( $q );
				if ( $nodes && $nodes->length ) {
					return $nodes->item( 0 );
				}
			}
			return null;
		}

		/**
		 * Resolve a simple selector (tag, .class, #id, and combinations) within a scope.
		 *
		 * @param string     $selector Simple selector.
		 * @param DOMElement $scope    Scope element.
		 * @return DOMElement[]
		 */
		private function select_by_css( $selector, $scope ) {
			$xpath = $this->css_to_xpath( $selector );
			if ( '' === $xpath ) {
				return array();
			}
			$nodes = $this->xpath->query( $xpath, $scope );
			$out   = array();
			if ( $nodes ) {
				foreach ( $nodes as $node ) {
					if ( XML_ELEMENT_NODE === $node->nodeType && ! $this->is_dropped( $node ) ) {
						$out[] = $node;
					}
				}
			}
			return $out;
		}

		/**
		 * Convert a single simple selector (no combinators) to a scoped XPath.
		 *
		 * @param string $selector Selector.
		 * @return string XPath ('' if unparseable).
		 */
		private function css_to_xpath( $selector ) {
			$selector = trim( (string) $selector );
			if ( '' === $selector ) {
				return '';
			}

			$tag     = '*';
			$classes = array();
			$id      = '';

			if ( preg_match( '/^[a-zA-Z][a-zA-Z0-9-]*/', $selector, $m ) ) {
				$tag = strtolower( $m[0] );
			}
			if ( preg_match_all( '/\.([a-zA-Z0-9_-]+)/', $selector, $m ) ) {
				$classes = $m[1];
			}
			if ( preg_match( '/#([a-zA-Z0-9_-]+)/', $selector, $m ) ) {
				$id = $m[1];
			}

			$predicates = '';
			foreach ( $classes as $class ) {
				$predicates .= "[contains(concat(' ',normalize-space(@class),' '),' " . $class . " ')]";
			}
			if ( '' !== $id ) {
				$predicates .= "[@id='" . $id . "']";
			}

			return './/' . $tag . $predicates;
		}

		/**
		 * Innermost elements whose text contains the query (case-insensitive).
		 *
		 * "Innermost" = drop any match that has a descendant element also
		 * containing the text, so we return the leaf owning the text, not body.
		 *
		 * @param string     $text  Query substring.
		 * @param DOMElement $scope Scope element.
		 * @return DOMElement[]
		 */
		private function find_by_text( $text, $scope ) {
			$needle = $this->lower( $text );
			$hits   = array();
			$nodes  = $this->xpath->query( './/*', $scope );
			if ( $nodes ) {
				foreach ( $nodes as $node ) {
					if ( $this->is_dropped( $node ) ) {
						continue;
					}
					if ( false !== strpos( $this->lower( $node->textContent ), $needle ) ) {
						$hits[] = $node;
					}
				}
			}

			// Keep only innermost hits.
			$inner = array();
			foreach ( $hits as $node ) {
				$has_inner_hit = false;
				foreach ( $hits as $other ) {
					if ( $other !== $node && $this->is_ancestor( $node, $other ) ) {
						$has_inner_hit = true;
						break;
					}
				}
				if ( ! $has_inner_hit ) {
					$inner[] = $node;
				}
			}
			return $inner;
		}

		/**
		 * Intersect one or more node sets by node identity.
		 *
		 * @param array $sets Array of DOMElement[] arrays.
		 * @return DOMElement[]
		 */
		private function intersect_node_sets( $sets ) {
			$sets = array_values( array_filter( $sets, 'is_array' ) );
			if ( empty( $sets ) ) {
				return array();
			}
			$result = $sets[0];
			$total  = count( $sets );
			for ( $k = 1; $k < $total; $k++ ) {
				$next    = $sets[ $k ];
				$keep    = array();
				foreach ( $result as $node ) {
					foreach ( $next as $candidate ) {
						if ( $node === $candidate ) {
							$keep[] = $node;
							break;
						}
					}
				}
				$result = $keep;
			}
			return $result;
		}

		/**
		 * Is $ancestor an ancestor of $node?
		 *
		 * @param DOMElement $ancestor Candidate ancestor.
		 * @param DOMElement $node     Node.
		 * @return bool
		 */
		private function is_ancestor( $ancestor, $node ) {
			$parent = $node->parentNode;
			while ( $parent ) {
				if ( $parent === $ancestor ) {
					return true;
				}
				$parent = $parent->parentNode;
			}
			return false;
		}

		/**
		 * Ancestor path line for a match: outer > … > matched.
		 *
		 * @param DOMElement $node   Matched node.
		 * @param int        $levels Ancestor levels to include.
		 * @return string
		 */
		private function ancestor_path( $node, $levels ) {
			$chain  = array();
			$parent = $node->parentNode;
			while ( $parent && XML_ELEMENT_NODE === $parent->nodeType && count( $chain ) < $levels ) {
				if ( 'html' === strtolower( $parent->nodeName ) ) {
					break;
				}
				array_unshift( $chain, $this->signature( $parent ) );
				$parent = $parent->parentNode;
			}
			$chain[] = $this->signature( $node );
			return implode( ' > ', $chain );
		}

		/**
		 * Immediate child signatures (with text), consecutive dupes collapsed, capped.
		 *
		 * @param DOMElement $node Node.
		 * @return string[]
		 */
		private function child_signatures( $node ) {
			$kids = $this->kids_for_recurse( $node );
			return $this->collapse_signature_list( $kids, 8 );
		}

		/**
		 * Immediate sibling signatures (with text), consecutive dupes collapsed, capped.
		 *
		 * @param DOMElement $node Node.
		 * @return string[]
		 */
		private function sibling_signatures( $node ) {
			$parent = $node->parentNode;
			if ( ! $parent ) {
				return array();
			}
			$sibs = array();
			foreach ( $this->element_children( $parent ) as $child ) {
				if ( $child !== $node ) {
					$sibs[] = $child;
				}
			}
			return $this->collapse_signature_list( $sibs, 6 );
		}

		/**
		 * Turn an element list into capped, consecutive-dedup signature strings.
		 *
		 * @param DOMElement[] $els Elements.
		 * @param int          $cap Maximum entries.
		 * @return string[]
		 */
		private function collapse_signature_list( $els, $cap ) {
			$out   = array();
			$count = count( $els );
			$j     = 0;
			while ( $j < $count && count( $out ) < $cap ) {
				$rep = $els[ $j ];
				$key = $this->dedup_key( $rep );
				$run = 1;
				while ( $j + $run < $count && $this->dedup_key( $els[ $j + $run ] ) === $key ) {
					++$run;
				}
				$sig   = $this->sig_with_text( $rep );
				$out[] = $run > 1 ? $sig . ' ×' . $run : $sig;
				$j    += $run;
			}
			if ( $j < $count ) {
				$out[] = sprintf( '… (+%d more)', $count - $j );
			}
			return $out;
		}

		/**
		 * Zero-match message with nearest-miss text suggestions.
		 *
		 * @param array      $filters Filters used.
		 * @param DOMElement $scope   Scope element.
		 * @return string
		 */
		private function zero_match_message( $filters, $scope ) {
			$desc = array();
			if ( ! empty( $filters['selector'] ) ) {
				$desc[] = 'selector "' . $filters['selector'] . '"';
			}
			if ( isset( $filters['text'] ) && '' !== (string) $filters['text'] ) {
				$desc[] = 'text "' . $filters['text'] . '"';
			}
			if ( ! empty( $filters['area'] ) ) {
				$desc[] = 'area "' . $filters['area'] . '"';
			}
			$msg = 'No elements matched ' . ( empty( $desc ) ? 'the query' : implode( ' + ', $desc ) ) . '.';

			if ( isset( $filters['text'] ) && '' !== (string) $filters['text'] ) {
				$near = $this->nearest_text_matches( (string) $filters['text'], $scope );
				if ( ! empty( $near ) ) {
					$msg .= ' Nearest text matches: ' . implode( ', ', $near );
				}
			}
			return $msg;
		}

		/**
		 * Up to 5 elements whose text shares any word with the query.
		 *
		 * @param string     $text  Query.
		 * @param DOMElement $scope Scope.
		 * @return string[]
		 */
		private function nearest_text_matches( $text, $scope ) {
			$words = array_filter( preg_split( '/\s+/', $this->lower( $text ) ), 'strlen' );
			if ( empty( $words ) ) {
				return array();
			}
			$out   = array();
			$seen  = 0;
			$nodes = $this->xpath->query( './/*', $scope );
			if ( ! $nodes ) {
				return array();
			}
			foreach ( $nodes as $node ) {
				if ( $seen >= 5 ) {
					break;
				}
				if ( $this->is_dropped( $node ) || $this->element_children( $node ) ) {
					continue; // Leaf-ish text owners only.
				}
				$node_text = $this->lower( $node->textContent );
				if ( '' === trim( $node_text ) ) {
					continue;
				}
				foreach ( $words as $word ) {
					if ( false !== strpos( $node_text, $word ) ) {
						$out[] = '"' . $this->direct_text( $node ) . '" (' . $this->signature( $node ) . ')';
						++$seen;
						break;
					}
				}
			}
			return $out;
		}

		/**
		 * Lowercase a string (mb-aware).
		 *
		 * @param string $str String.
		 * @return string
		 */
		private function lower( $str ) {
			$str = (string) $str;
			return function_exists( 'mb_strtolower' ) ? mb_strtolower( $str ) : strtolower( $str );
		}
	}

endif;
