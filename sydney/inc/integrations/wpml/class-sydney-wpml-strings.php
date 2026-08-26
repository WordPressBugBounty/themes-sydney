<?php
/**
 * Integration with WPML for the header's Customizer text options.
 *
 * Those values are stored as theme mods, so they never pass through a gettext
 * function and WPML's scan of the theme files can never see them: the frontend
 * keeps rendering the source language even when a translation exists. This
 * class registers them as WPML strings and translates them back on read, via
 * the core `theme_mod_{$name}` filter, which covers both the header/footer
 * builder components and the classic header.
 *
 * @package Sydney
 */

if ( ! class_exists( 'Sydney_WPML_Strings' ) ) :

	/**
	 * Sydney_WPML_Strings class.
	 */
	class Sydney_WPML_Strings {

		/**
		 * WPML context (domain) the strings are registered under.
		 *
		 * Part of the persisted string identity in WPML — changing it after
		 * release orphans every translation users have already entered.
		 *
		 * @var string
		 */
		const CONTEXT = 'Sydney';

		/**
		 * Option holding the hash of the last registered set of values.
		 *
		 * @var string
		 */
		const HASH_OPTION = 'sydney_wpml_strings_hash';

		/**
		 * Prefix of the core filter each mapped theme mod is translated through.
		 *
		 * @var string
		 */
		const MOD_FILTER_PREFIX = 'theme_mod_';

		/**
		 * Theme mod => translator-facing WPML string name, resolved once per
		 * request in the constructor so `translate()` doesn't re-run the
		 * `sydney_wpml_translatable_theme_mods` filter on every mapped read.
		 *
		 * @var array
		 */
		protected $strings = array();

		/**
		 * Constructor.
		 */
		public function __construct() {
			$this->strings = self::get_strings();

			foreach ( array_keys( $this->strings ) as $mod ) {
				add_filter( self::MOD_FILTER_PREFIX . $mod, array( $this, 'translate' ) );
			}

			add_action( 'admin_init', array( $this, 'register_strings' ) );
		}

		/**
		 * Theme mod => translator-facing WPML string name.
		 *
		 * The names are part of the persisted string identity in WPML and must
		 * be treated as frozen once shipped. Sydney Pro extends this map through
		 * the filter rather than duplicating the class.
		 *
		 * Falls back to the built-in map if a filter callback returns a
		 * non-array, since callers immediately run array_keys()/foreach over
		 * the result.
		 *
		 * @return array
		 */
		public static function get_strings() {
			$strings = array(
				'header_html_content'  => 'Header HTML content',
				'header_button_text'   => 'Header button text',
				'header_button_link'   => 'Header button link',
				'header_contact_mail'  => 'Header contact email',
				'header_contact_phone' => 'Header contact phone',
			);

			$filtered = apply_filters( 'sydney_wpml_translatable_theme_mods', $strings );

			return is_array( $filtered ) ? $filtered : $strings;
		}

		/**
		 * Translate a theme mod value on read.
		 *
		 * Hooked to `theme_mod_{$name}`, so the mod name comes from the current
		 * filter. Admin and REST reads are left untouched: the Customizer must
		 * keep showing (and saving) the source string, and the abilities REST
		 * endpoints must keep reporting it.
		 *
		 * @param mixed $value Theme mod value.
		 * @return mixed
		 */
		public function translate( $value ) {
			if ( ! is_string( $value ) || '' === $value ) {
				return $value;
			}

			if ( is_admin() || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {
				return $value;
			}

			$mod = substr( (string) current_filter(), strlen( self::MOD_FILTER_PREFIX ) );

			if ( ! isset( $this->strings[ $mod ] ) ) {
				return $value;
			}

			return apply_filters( 'wpml_translate_single_string', $value, self::CONTEXT, $this->strings[ $mod ] );
		}

		/**
		 * Register the current source values as WPML strings.
		 *
		 * Reads the raw option with get_theme_mods() — get_theme_mod() would run
		 * translate() and register a translation as the source string. The hash
		 * guard keeps this off the query budget of every admin page load while
		 * still catching values saved before this release. It only tracks
		 * Sydney's own mod values though, so it can't detect WPML's string
		 * table being reset independently (e.g. a site migration) while the mod
		 * values stay the same; the `sydney_wpml_force_register_strings` filter
		 * bypasses the guard for that case. The one variant of that it does
		 * handle by itself is String Translation being activated after the
		 * theme: the hash is never stored while nothing is listening, so the
		 * first request after ST activates registers everything.
		 *
		 * @return void
		 */
		public function register_strings() {
			$mods = get_theme_mods();

			if ( ! is_array( $mods ) ) {
				return;
			}

			$values = array();

			foreach ( $this->strings as $mod => $name ) {
				if ( ! isset( $mods[ $mod ] ) || ! is_string( $mods[ $mod ] ) || '' === $mods[ $mod ] ) {
					continue;
				}

				$values[ $name ] = $mods[ $mod ];
			}

			if ( empty( $values ) ) {
				return;
			}

			// Both `wpml_register_single_string` and `wpml_translate_single_string`
			// come from WPML String Translation, a separate plugin from the WPML
			// core this integration gates on. With ST inactive the do_action()
			// loop below registers nothing — and storing the hash anyway would
			// make that no-op permanent: the admin installs ST later, the hash
			// still matches, and the strings never reach the string table.
			if ( ! has_action( 'wpml_register_single_string' ) ) {
				return;
			}

			$hash = md5( wp_json_encode( $values ) );

			if ( get_option( self::HASH_OPTION ) === $hash && ! apply_filters( 'sydney_wpml_force_register_strings', false ) ) {
				return;
			}

			foreach ( $values as $name => $value ) {
				do_action( 'wpml_register_single_string', self::CONTEXT, $name, $value );
			}

			update_option( self::HASH_OPTION, $hash );
		}
	}

	$sydney_wpml_strings = new Sydney_WPML_Strings();

endif;
