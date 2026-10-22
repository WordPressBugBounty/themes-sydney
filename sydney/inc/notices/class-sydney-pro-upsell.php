<?php
/**
 * Sydney Pro upsell notice
 *
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Class to display the Sydney Pro upsell notices: the evergreen upgrade notice,
 * its WooCommerce orders variant and the Mega Menu teaser on Appearance > Menus.
 *
 * At most one prints per screen load, and none when another Sydney notice
 * already fired the 'sydney_admin_notice_printed' action on that load.
 */
class Sydney_Pro_Upsell_Notice {

	/**
	 * Days a "Maybe later" click hides the upgrade notice for.
	 *
	 * @var int
	 */
	const SNOOZE_DAYS = 60;

	/**
	 * Re-shows allowed after "Maybe later" before the notice counts as dismissed.
	 *
	 * @var int
	 */
	const MAX_RESHOWS = 2;

	/**
	 * Paid orders a store needs before the WooCommerce orders variant shows.
	 *
	 * @var int
	 */
	const MIN_PAID_ORDERS = 5;

	/**
	 * User meta key that permanently dismisses each notice.
	 *
	 * @var array
	 */
	const DISMISS_KEYS = array(
		'upgrade'    => 'sydney_pro_upsell_notice_dismiss',
		'woo_orders' => 'sydney_woo_orders_notice_dismiss',
		'mega_menu'  => 'sydney_mega_menu_notice_dismiss',
	);

	/**
	 * The notice resolved for the current screen, false until resolved.
	 *
	 * @var array|null|false
	 */
	private $notice = false;

	/**
	 * Constructor
	 */
	public function __construct() {
		if ( sydney_is_white_labelled() ) {
			return;
		}

		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
		add_action( 'admin_notices', array( $this, 'notice_markup' ), 20 );
		add_action( 'admin_init', array( $this, 'dismiss_notice_handler' ), 0 );
		add_action( 'switch_theme', array( $this, 'notice_data_remove' ) );
	}

	/**
	 * Enqueue admin scripts, only where a notice renders.
	 */
	public function admin_enqueue_scripts() {
		if ( ! $this->get_notice() ) {
			return;
		}

		wp_enqueue_style( 'sydney-notices', get_template_directory_uri() . '/inc/notices/sydney-notices.min.css', array(), '20260819', 'all' );
	}

	/**
	 * Resolve which notice, if any, belongs on the current screen.
	 *
	 * @return array|null
	 */
	public function get_notice() {
		if ( false === $this->notice ) {
			$this->notice = $this->resolve_notice();
		}

		return $this->notice;
	}

	/**
	 * Pick the notice for the current screen.
	 *
	 * @return array|null
	 */
	private function resolve_notice() {
		$screen = get_current_screen();

		if ( ! $screen ) {
			return null;
		}

		if ( 'nav-menus' === $screen->id ) {
			return $this->is_mega_menu_eligible() ? $this->notice_args( 'mega_menu' ) : null;
		}

		if ( ! current_user_can( 'manage_options' ) ) {
			return null;
		}

		$woocommerce = class_exists( 'WooCommerce' );

		// The orders variant takes the upgrade notice's slot on the screens they share.
		if ( $woocommerce && in_array( $screen->id, array( 'dashboard', 'edit-shop_order', 'woocommerce_page_wc-orders' ), true ) && ! $this->is_dismissed( 'woo_orders' ) && $this->get_paid_orders_count() >= self::MIN_PAID_ORDERS ) {
			return $this->notice_args( 'woo_orders' );
		}

		if ( $this->is_upgrade_hidden() ) {
			return null;
		}

		if ( $woocommerce && in_array( $screen->id, array( 'woocommerce_page_wc-settings', 'edit-product' ), true ) ) {
			return $this->notice_args( 'upgrade', true );
		}

		if ( in_array( $screen->id, array( 'dashboard', 'plugins', 'plugin-install', 'edit-page' ), true ) ) {
			return $this->notice_args( 'upgrade' );
		}

		return null;
	}

	/**
	 * Copy and tracking for a notice.
	 *
	 * @param string $id          Notice id, a key of DISMISS_KEYS.
	 * @param bool   $woo_screens Whether the upgrade notice is on a WooCommerce screen.
	 * @return array
	 */
	private function notice_args( $id, $woo_screens = false ) {
		$utm_args = array(
			'utm_source'   => 'theme_notice',
			'utm_medium'   => 'link',
			'utm_campaign' => 'Sydney',
		);

		if ( 'mega_menu' === $id ) {
			$utm_args['utm_source']  = 'theme_nav_menus';
			$utm_args['utm_content'] = 'mega_menu';

			return array(
				'id'     => $id,
				'title'  => __( 'Turn your dropdowns into mega menus', 'sydney' ),
				'text'   => __( 'Sydney Pro lets you design mega menus with Elementor, so a dropdown can hold columns, images and widgets.', 'sydney' ),
				'button' => __( 'Upgrade to Sydney Pro', 'sydney' ),
				'url'    => sydney_admin_upgrade_link( 'https://athemes.com/sydney-upgrade/', $utm_args, 'notice-mega-menu-link' ),
			);
		}

		if ( 'woo_orders' === $id ) {
			$utm_args['utm_content'] = 'woo_orders_notice';

			return array(
				'id'     => $id,
				'title'  => __( 'Your store is taking orders', 'sydney' ),
				'text'   => __( 'Give your customers a smoother way to shop with Sydney Pro: sticky add-to-cart, multi-step checkout, quick view, wishlists and advanced reviews.', 'sydney' ),
				'button' => __( 'See Sydney Pro for WooCommerce', 'sydney' ),
				'url'    => sydney_admin_upgrade_link( 'https://athemes.com/sydney-upgrade/', $utm_args, 'notice-woo-orders-link' ),
			);
		}

		if ( $woo_screens ) {
			$utm_args['utm_content'] = 'upgrade_notice_woo';
			$text                    = __( 'Sticky add-to-cart, quick view, wishlist, product swatches and multi-step checkout, built into Sydney Pro.', 'sydney' );
		} else {
			$utm_args['utm_content'] = $this->get_snooze_count() ? 'upgrade_notice_reminder' : 'upgrade_notice';
			$text                    = __( 'Design your own headers and footers, choose from 35+ starter sites, add extra WooCommerce features and get a year of premium support.', 'sydney' );

			if ( did_action( 'elementor/loaded' ) ) {
				$text .= ' ' . __( 'It also includes aThemes Addons Pro, with 65+ premium Elementor widgets, at no extra cost.', 'sydney' );
			}
		}

		return array(
			'id'     => $id,
			'title'  => __( 'Build more with Sydney Pro', 'sydney' ),
			'text'   => $text,
			'button' => __( 'Upgrade to Sydney Pro', 'sydney' ),
			'url'    => sydney_admin_upgrade_link( 'https://athemes.com/sydney-upgrade/', $utm_args, 'notice-upgrade-link' ),
		);
	}

	/**
	 * Is a notice permanently dismissed for the current user?
	 *
	 * @param string $id Notice id, a key of DISMISS_KEYS.
	 * @return bool
	 */
	private function is_dismissed( $id ) {
		return (bool) get_user_meta( get_current_user_id(), self::DISMISS_KEYS[ $id ], true );
	}

	/**
	 * How many times the current user clicked "Maybe later".
	 *
	 * @return int
	 */
	private function get_snooze_count() {
		return (int) get_user_meta( get_current_user_id(), 'sydney_pro_upsell_notice_snooze_count', true );
	}

	/**
	 * Is the upgrade notice dismissed, out of re-shows or snoozed?
	 *
	 * @return bool
	 */
	private function is_upgrade_hidden() {
		if ( $this->is_dismissed( 'upgrade' ) || $this->get_snooze_count() > self::MAX_RESHOWS ) {
			return true;
		}

		$snoozed_at = (int) get_user_meta( get_current_user_id(), 'sydney_pro_upsell_notice_snooze', true );

		return $snoozed_at > strtotime( '-' . self::SNOOZE_DAYS . ' days' );
	}

	/**
	 * Processing plus completed orders. WooCommerce caches both counts.
	 *
	 * @return int
	 */
	private function get_paid_orders_count() {
		return (int) wc_orders_count( 'processing' ) + (int) wc_orders_count( 'completed' );
	}

	/**
	 * Mega Menu teaser conditions: Elementor on, Max Mega Menu off, and a
	 * dropdown in the menu assigned to the primary location.
	 *
	 * @return bool
	 */
	private function is_mega_menu_eligible() {
		if ( ! current_user_can( 'edit_theme_options' ) || $this->is_dismissed( 'mega_menu' ) ) {
			return false;
		}

		if ( ! did_action( 'elementor/loaded' ) || function_exists( 'max_mega_menu_is_enabled' ) ) {
			return false;
		}

		$locations = get_nav_menu_locations();

		if ( empty( $locations['primary'] ) ) {
			return false;
		}

		$items = wp_get_nav_menu_items( $locations['primary'] );

		foreach ( (array) $items as $item ) {
			if ( (int) $item->menu_item_parent ) {
				return true;
			}
		}

		return false;
	}

	/**
	 * Show HTML markup if conditions meet.
	 */
	public function notice_markup() {
		$notice = $this->get_notice();

		// One Sydney notice per screen load.
		if ( ! $notice || did_action( 'sydney_admin_notice_printed' ) ) {
			return;
		}

		?>

		<div class="sydney-notice notice" style="position:relative;">
			<h3><?php echo esc_html( $notice['title'] ); ?></h3>

			<p><?php echo esc_html( $notice['text'] ); ?></p>

			<a href="<?php echo esc_url( $notice['url'] ); ?>" class="sydney-btn sydney-btn-primary" target="_blank"><?php echo esc_html( $notice['button'] ); ?></a>

			<?php if ( 'upgrade' === $notice['id'] ) : ?>
				<a href="<?php echo esc_url( wp_nonce_url( add_query_arg( 'sydney_upsell_notice_snooze', '1' ), 'sydney_upsell_notice_nonce' ) ); ?>" class="sydney-btn sydney-btn-secondary"><?php esc_html_e( 'Maybe later', 'sydney' ); ?></a>
			<?php endif; ?>

			<a class="notice-dismiss" href="<?php echo esc_url( wp_nonce_url( add_query_arg( 'sydney_upsell_notice_dismiss', $notice['id'] ), 'sydney_upsell_notice_nonce' ) ); ?>" style="text-decoration:none;"><span class="screen-reader-text"><?php esc_html_e( 'Dismiss this notice.', 'sydney' ); ?></span></a>
		</div>

		<?php
		do_action( 'sydney_admin_notice_printed' );
	}

	/**
	 * Dismiss a notice permanently, or snooze the upgrade notice.
	 */
	public function dismiss_notice_handler() {
		if ( ! isset( $_GET['sydney_upsell_notice_dismiss'] ) && ! isset( $_GET['sydney_upsell_notice_snooze'] ) ) {
			return;
		}

		// Verify nonce for security
		if ( ! isset( $_GET['_wpnonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_GET['_wpnonce'] ) ), 'sydney_upsell_notice_nonce' ) ) {
			return;
		}

		$user_id = get_current_user_id();

		if ( isset( $_GET['sydney_upsell_notice_dismiss'] ) ) {
			$id = sanitize_key( wp_unslash( $_GET['sydney_upsell_notice_dismiss'] ) );

			if ( isset( self::DISMISS_KEYS[ $id ] ) ) {
				update_user_meta( $user_id, self::DISMISS_KEYS[ $id ], 'true' );
			}

			return;
		}

		// A reload of the snooze URL must not count as a second click.
		if ( $this->is_upgrade_hidden() ) {
			return;
		}

		update_user_meta( $user_id, 'sydney_pro_upsell_notice_snooze', time() );
		update_user_meta( $user_id, 'sydney_pro_upsell_notice_snooze_count', $this->get_snooze_count() + 1 );
	}

	/**
	 * Delete data on theme switch
	 */
	public function notice_data_remove() {
		$keys = array_merge( array_values( self::DISMISS_KEYS ), array( 'sydney_pro_upsell_notice_snooze', 'sydney_pro_upsell_notice_snooze_count' ) );

		foreach ( $keys as $key ) {
			delete_metadata( 'user', 0, $key, '', true );
		}
	}
}

new Sydney_Pro_Upsell_Notice();
