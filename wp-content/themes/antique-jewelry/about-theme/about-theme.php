<?php
/**
 * Titan Notice Handler
 */

defined( 'ABSPATH' ) || exit;

define('ANTIQUE_JEWELRY_FREE_URL',__('https://www.titanthemes.net/themes/free-jewelry-wordpress-theme/','antique-jewelry'));
define('ANTIQUE_JEWELRY_SUPPORT',__('https://wordpress.org/support/theme/antique-jewelry/','antique-jewelry'));
define('ANTIQUE_JEWELRY_REVIEW',__('https://wordpress.org/support/theme/antique-jewelry/reviews/#new-post','antique-jewelry'));
define('ANTIQUE_JEWELRY_BUY_NOW',__('https://www.titanthemes.net/themes/jewelry-wordpress-theme/','antique-jewelry'));
define('ANTIQUE_JEWELRY_DOC_URL',__('https://titanthemes.net/documentation/antique-jewelry/','antique-jewelry'));
define('ANTIQUE_JEWELRY_LIVE_DEMO',__('https://titanthemes.net/preview/antique-jewelry/','antique-jewelry'));
/**
 * Admin Hook
 */
function antique_jewelry_admin_menu_page() {
    $antique_jewelry_theme = wp_get_theme( get_template() );

    add_theme_page(
        $antique_jewelry_theme->display( 'Name' ),
        $antique_jewelry_theme->display( 'Name' ),
        'manage_options',
        'antique-jewelry',
        'antique_jewelry_do_admin_page'
    );
}
add_action( 'admin_menu', 'antique_jewelry_admin_menu_page' );

/**
 * Enqueue getting started styles and scripts
 */
function titan_widgets_backend_enqueue() {
    wp_enqueue_style( 'titan-getting-started', get_template_directory_uri() . '/about-theme/about-theme.css' );
}
add_action( 'admin_enqueue_scripts', 'titan_widgets_backend_enqueue' );

/**
 * Class Titan_Notice_Handler
 */
class Titan_Notice_Handler {

    public static $nonce;

    /**
     * Empty Constructor
     */
    public function __construct() {
        // Activation notice
        add_action( 'switch_theme', array( $this, 'flush_dismiss_status' ) );
        add_action( 'admin_init', array( $this, 'getting_started_notice_dismissed' ) );
        add_action( 'admin_notices', array( $this, 'titan_theme_info_welcome_admin_notice' ), 3 );
        add_action( 'wp_ajax_titan_getting_started', array( $this, 'titan_getting_started' ) );
    }

    /**
     * Display an admin notice linking to the about page
     */
    public function titan_theme_info_welcome_admin_notice() {

    $current_screen = get_current_screen();

    $antique_jewelry_theme = wp_get_theme();
    if ( is_admin() && ! get_user_meta( get_current_user_id(), 'gs_notice_dismissed' ) && $current_screen->base != 'appearance_page_antique-jewelry' ) {
        echo '<div class="updated notice notice-success is-dismissible getting-started">';
        echo '<p><strong>' . sprintf( esc_html__( 'Welcome! Thank you for choosing %1$s.', 'antique-jewelry' ), esc_html( $antique_jewelry_theme->get( 'Name' ) ) ) . '</strong></p>';
        echo '<p class="plugin-notice">' . esc_html__( 'By clicking "Get Started," you can access our theme features.', 'antique-jewelry' ) . '</p>';
        echo '<div class="titan-buttons">';
        echo '<p><a href="' . esc_url(admin_url('themes.php?page=antique-jewelry')) . '" class="titan-install-plugins button button-primary">' . sprintf( esc_html__( 'Get started with %s', 'antique-jewelry' ), esc_html( $antique_jewelry_theme->get( 'Name' ) ) ) . '</a></p>';
        echo '<p><a href="' . esc_url( ANTIQUE_JEWELRY_BUY_NOW ) . '" class="button button-secondary" target="_blank">' . esc_html__( 'GO FOR PREMIUM', 'antique-jewelry' ) . '</a></p>';
        echo '</div>';
        echo '<a href="' . esc_url( wp_nonce_url( add_query_arg( 'gs-notice-dismissed', 'dismiss_admin_notices' ) ) ) . '" class="getting-started-notice-dismiss">Dismiss</a>';
        echo '</div>';
    }
}

    /**
     * Register dismissal of the getting started notification.
     * Acts on the dismiss link.
     * If clicked, the admin notice disappears and will no longer be visible to this user.
     */
    public function getting_started_notice_dismissed() {
        if ( isset( $_GET['gs-notice-dismissed'] ) ) {
            add_user_meta( get_current_user_id(), 'gs_notice_dismissed', 'true' );
        }
    }

    /**
     * Deletes the getting started notice's dismiss status upon theme switch.
     */
    public function flush_dismiss_status() {
        delete_user_meta( get_current_user_id(), 'gs_notice_dismissed' );
    }
}
new Titan_Notice_Handler();

/**
 * Render admin page.
 *
 * @since 1.0.0
 */
function antique_jewelry_do_admin_page() { 
    $antique_jewelry_theme = wp_get_theme(); ?>
    <div class="antique-jewelry-themeinfo-page--wrapper">
        <div class="free&pro">
            <div id="antique-jewelry-admin-about-page-1">
                <div class="theme-detail">
                   <div class="antique-jewelry-admin-card-header-1">
                    <div class="antique-jewelry-header-left">
                        <h2>
                            <?php echo esc_html( $antique_jewelry_theme->Name ); ?> <span><?php echo esc_html($antique_jewelry_theme['Version']);?></span>
                        </h2>
                        <p>
                            <?php
                            echo wp_kses_post( apply_filters( 'titan_theme_description', esc_html( $antique_jewelry_theme->get( 'Description' ) ) ) );
                        ?>
                        </p>
                    </div>
                    <div class="antique-jewelry-header-right">
                        <div class="antique-jewelry-pro-button">
                            <a href="<?php echo esc_url( ANTIQUE_JEWELRY_BUY_NOW ); ?>" class="antique-jewelry-button button-primary" target="_blank" rel="noreferrer">
                                <?php esc_html_e( 'UPGRADE TO PREMIUM', 'antique-jewelry' ); ?>
                            </a>
                        </div>
                    </div>
                </div>   
                </div>   
                <div class="antique-jewelry-features">
                    <div class="antique-jewelry-features-box">
                        <h3><?php esc_html_e( 'PREMIUM DEMONSTRATION', 'antique-jewelry' ); ?></h3>
                        <p><?php esc_html_e( 'Effortlessly create and customize your website by arranging text, images, and other elements using the Gutenberg editor, making web design easy and accessible for all skill levels.', 'antique-jewelry' ); ?></p>
                        <a href="<?php echo esc_url( ANTIQUE_JEWELRY_LIVE_DEMO ); ?>" class="antique-jewelry-button button-secondary-1" target="_blank" rel="noreferrer">
                                <?php esc_html_e( 'DEMONSTRATION', 'antique-jewelry' ); ?>
                            </a>
                    </div>
                    <div class="antique-jewelry-features-box">
                        <h3><?php esc_html_e( 'REVIEWS', 'antique-jewelry' ); ?></h3>
                        <p><?php esc_html_e( 'We would be happy to hear your thoughts and value your evaluation.', 'antique-jewelry' ); ?></p>
                        <a href="<?php echo esc_url( ANTIQUE_JEWELRY_REVIEW ); ?>" class="antique-jewelry-button button-secondary-1" target="_blank" rel="noreferrer">
                                <?php esc_html_e( 'REVIEWS', 'antique-jewelry' ); ?>
                            </a>
                    </div>
                    <div class="antique-jewelry-features-box">
                        <h3><?php esc_html_e( '24/7 SUPPORT', 'antique-jewelry' ); ?></h3>
                        <p><?php esc_html_e( 'Please do not hesitate to contact us at support if you need help installing our lite theme. We are prepared to assist you!', 'antique-jewelry' ); ?></p>
                        <a href="<?php echo esc_url( ANTIQUE_JEWELRY_SUPPORT ); ?>" class="antique-jewelry-button button-secondary-1" target="_blank" rel="noreferrer">
                            <?php esc_html_e( 'SUPPORT', 'antique-jewelry' ); ?>
                        </a>
                    </div>
                    <div class="antique-jewelry-features-box">
                        <h3><?php esc_html_e( 'THEME INSTRUCTION', 'antique-jewelry' ); ?></h3>
                        <p><?php esc_html_e( 'If you need assistance configuring and setting up the theme, our tutorial is available. A fast and simple method for setting up the theme.', 'antique-jewelry' ); ?></p>
                        <a href="<?php echo esc_url( ANTIQUE_JEWELRY_DOC_URL ); ?>" class="antique-jewelry-button button-secondary-1" target="_blank" rel="noreferrer">
                                <?php esc_html_e( 'DOCUMENTATION', 'antique-jewelry' ); ?>
                            </a>
                    </div>
                </div>   
            </div>
            <div id="antique-jewelry-admin-about-page-2">
                <div class="theme-detail">
                   <div class="antique-jewelry-admin-card-header-1">
                        <div class="antique-jewelry-header-left-pro"> 
                            <h2><?php esc_html_e( 'The premium version of this theme will be available for you to enhance or unlock our premium features.', 'antique-jewelry' ); ?></h2>
                        </div>
                        <div class="antique-jewelry-header-right-2">
                            <div class="antique-jewelry-pro-button">
                                <a href="<?php echo esc_url( ANTIQUE_JEWELRY_BUY_NOW ); ?>" class="antique-jewelry-button button-primary-1 buy-now" target="_blank" rel="noreferrer">
                                    <?php esc_html_e( 'GO TO PREMIUM', 'antique-jewelry' ); ?>
                                </a>
                            </div>
                            <div class="antique-jewelry-pro-button">
                                <a href="<?php echo esc_url( ANTIQUE_JEWELRY_LIVE_DEMO ); ?>" class="antique-jewelry-button button-primary-1 pro-demo" target="_blank" rel="noreferrer">
                                    <?php esc_html_e( 'PREMIUM DEMO', 'antique-jewelry' ); ?>
                                </a>
                            </div> 
                        </div>
                    </div>
                    <div class="antique-jewelry-admin-card-header-2">
                        <img class="img_responsive" style="width: 100%;" src="<?php echo esc_url( $antique_jewelry_theme->get_screenshot() ); ?>" />
                    </div> 
                </div>    
            </div>
        </div>
    </div>
<?php } ?>