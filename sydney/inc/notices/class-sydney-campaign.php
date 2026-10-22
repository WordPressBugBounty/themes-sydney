<?php
/**
 * Sydney campaign notice
 *
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Class to display the theme review notice after certain period.
 *
 */
class Sydney_Campaign_Notice {

	/**
	 * Start date target. The notice and the Customizer line show from this day.
	 *
	 * @var string
	 */
	private static $start_date_target = '2026-11-24';

	/**
	 * End date target. Dates are compared in UTC.
	 *
	 * @var string
	 */
	private static $end_date_target = '2026-12-01';

	/**
	 * Highest discount the campaign offers, in percent.
	 *
	 * @var int
	 */
	private static $discount = 40;

	/**
	 * Constructor
	 */
	public function __construct() {
		if( sydney_is_white_labelled() ) {
			return;
		}

		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
		add_action( 'admin_notices', array( $this, 'review_notice_markup' ), 0 );
		add_action( 'admin_init', array( $this, 'dismiss_notice_handler' ), 0 );
	}

	/**
	 * Enqueue admin scripts, only where the notice renders.
	 *
	 * @param string $hook_suffix The current admin page.
	 */
	public function admin_enqueue_scripts( $hook_suffix ) {
		if ( ! $this->should_display( $hook_suffix ) ) {
			return;
		}

		wp_enqueue_style( 'sydney-notices', get_template_directory_uri() . '/inc/notices/sydney-notices.min.css', array(), '20260819', 'all' );
		$this->add_inline_style();
	}

    /**
     * Add inline style.
     * 
     * @return void
     */
    public function add_inline_style() {
        $css = "
            .toplevel_page_sydney-dashboard #wpbody-content>.updated.sydney-campaign-notice, 
            .toplevel_page_sydney-dashboard #wpbody-content>.notice.sydney-campaign-notice {
                display: block !important;
                margin: -1px -1px 0px -20px;
            }

            .sydney-campaign-notice {
                position: relative !important;
                background-color: #000;
                padding: 30px 30px 0px !important;
                border-left: 0;
            }

            @media(min-width: 1270px) {
                .sydney-campaign-notice {
                    padding: 45px 61px 40px !important;
					margin-left: -20px;
                }
            }

            .sydney-campaign-notice h3 {
                color: #FFF;
                font-size: 42px;
                font-weight: 700;
                line-height: 1.1;
                margin-bottom: 20px;
            }

            .sydney-campaign-notice p {
                color: #FFF;
                font-size: 16px;
                line-height: 1.5;
                max-width: 520px;
                margin-bottom: 30px;
            }

            @media(min-width: 576px) {
                .sydney-campaign-notice h3 {
                    min-width: 425px;
                    max-width: 25%;
                    line-height: 0.8;
                }   
            }

            .sydney-campaign-notice h3 span {
                position: relative;
                top: 12px;
                display: inline-flex;
                align-items: center;
                gap: 10px;
                color: #FFDB12;
            }

            .sydney-campaign-notice-thumbnail {
                max-width: 100%;
                height: auto;
                margin-top: 30px;
            }

            @media(min-width: 1270px) {
                .sydney-campaign-notice-thumbnail {
                    position: absolute;
                    right: 40px;
                    bottom: 0;
                    max-width: 553px;
                    margin-top: 0;
                }
            }

            @media(min-width: 1300px) {
                .sydney-campaign-notice-thumbnail {
                    max-width: 663px;
                }
            }

            .sydney-campaign-notice-percent {
                position: relative;
                max-width: 118px;
                top: -2px;
            }

            .sydney-campaign-notice .sydney-btn {
                font-size: 19px;
                padding: 19px 41px;
                border-radius: 0;
            }

            .sydney-campaign-notice .notice-dismiss,
            .sydney-campaign-notice .notice-dismiss:before {
                color: #FFF;
            }

            .sydney-campaign-notice .notice-dismiss:active:before, 
            .sydney-campaign-notice .notice-dismiss:focus:before, 
            .sydney-campaign-notice .notice-dismiss:hover:before {
                color: #757575;
            }
        ";

        wp_add_inline_style( 'sydney-notices', $css );
    }

    /**
	 * Is notice dismissed?.
	 * 
     * @return bool
	 */
	public function is_dismissed() {
		$user_id = get_current_user_id();

        return get_user_meta( $user_id, 'sydney_disable_bf2026_notice', true ) ? true : false;
	}

	/**
	 * Is the campaign window open?
	 *
	 * @return bool
	 */
	public static function is_live() {
		$current_date = time();

		return $current_date >= strtotime( self::$start_date_target ) && $current_date < strtotime( self::$end_date_target );
	}

	/**
	 * Should the notice render on this admin page?
	 *
	 * @param string $hook_suffix The current admin page.
	 * @return bool
	 */
	public function should_display( $hook_suffix ) {
		if ( 'toplevel_page_sydney-dashboard' !== $hook_suffix ) {
			return false;
		}

		return current_user_can( 'manage_options' ) && self::is_live() && ! $this->is_dismissed();
	}

	/**
	 * Show HTML markup if conditions meet.
     * 
     * @return void
	 */
	public function review_notice_markup() {
		global $hook_suffix;

		if ( ! $this->should_display( $hook_suffix ) ) {
			return;
		}
		
		?>
        
        <div class="sydney-notice sydney-campaign-notice" style="position:relative;">
			<h3><?php echo wp_kses_post( sprintf(
                /* Translators: 1. Image url. 2. Image alt text. */
                __( 'Sydney Black Friday: Up to <span><img src="%1$s" class="sydney-campaign-notice-percent" alt="%2$s" /> Off!</span>', 'sydney' ),
                get_template_directory_uri() . '/images/admin/40-percent.png',
                esc_attr( sprintf(
                    /* Translators: 1. Discount percent. */
                    __( 'Up to %1$d percent off', 'sydney' ),
                    self::$discount
                ) )
            ) ); ?></h3>

            <p><?php echo esc_html( sprintf(
                /* Translators: 1. Last day of the sale. */
                __( 'Design your own headers, footers, single posts and archives with the Template Builder in Sydney Pro. The sale ends %1$s.', 'sydney' ),
                date_i18n( 'F j', strtotime( self::$end_date_target ) )
            ) ); ?></p>

            <a href="<?php echo esc_url( sydney_admin_upgrade_link( 'https://athemes.com/sydney-upgrade/', array( 'utm_source' => 'theme_notice', 'utm_medium' => 'link', 'utm_campaign' => 'Sydney', 'utm_content' => 'bf2026_notice' ), 'notice-campaign-link' ) ); ?>" class="sydney-btn sydney-btn-primary" target="_blank"><?php esc_html_e( 'Give Me This Deal', 'sydney' ); ?></a>

            <img src="<?php echo esc_url( get_template_directory_uri() . '/images/admin/people-trust.png' ); ?>" alt="<?php echo esc_attr__( 'Sydney Pro customers', 'sydney' ); ?>" class="sydney-campaign-notice-thumbnail" />

			<a class="notice-dismiss" href="<?php echo esc_url( wp_nonce_url( add_query_arg( 'nag_sydney_disable_campaign_notice', '0' ), 'sydney_campaign_notice_nonce' ) ); ?>" style="text-decoration:none;"></a>
		</div>

		<?php
	}

	/**
	 * Disable campaign notice permanently
	 */
	public function dismiss_notice_handler() {
		if ( isset( $_GET['nag_sydney_disable_campaign_notice'] ) && '0' === $_GET['nag_sydney_disable_campaign_notice'] ) {
			// Verify nonce for security
			if ( ! isset( $_GET['_wpnonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_GET['_wpnonce'] ) ), 'sydney_campaign_notice_nonce' ) ) {
				return;
			}
			add_user_meta( get_current_user_id(), 'sydney_disable_bf2026_notice', 'true', true );
		}
	}
}

new Sydney_Campaign_Notice();