<?php

defined( 'ABSPATH' ) || exit;

class WpDevArt_Theme_Notice_Handler {

	public function __construct() {
        add_action( 'switch_theme', array( $this, 'flush_dismiss_status' ) );
        add_action( 'admin_init', array($this,'getting_started_notice_dismissed' ) );
        add_action( 'admin_notices', array( $this, 'wpdevart_theme_info_welcome_admin_notice' ), 3 );
    }

    public function wpdevart_theme_info_welcome_admin_notice() {
        $theme = wp_get_theme();
        if ( is_admin() && !get_user_meta( get_current_user_id(), 'gs_notice_dismissed' ) ){
            echo '<div class="updated notice notice-success is-dismissible getting-started getting-started-wrap">';
                    echo '<div class="getting-content">';
                        echo ( '<h2>' . sprintf( esc_html__( 'Welcome to %1$s Theme', 'jewstore' ), esc_attr ( $theme->get( 'Name' ) ) ) . '</h2>' );
                        echo '<h3>To fully take advantage of the best our theme can offer, get started.</h3>';
                        echo ( '<p><a href="'.esc_url( admin_url( 'themes.php?page=wpdevart-theme-about' ) ).'" class="button button-secondary getting-started-main-button">' . sprintf( esc_html__( 'Get started with %s','jewstore' ), esc_attr ( $theme->get( 'Name' ) ) ) . '</a>' );
                        echo ( '<a href="'.apply_filters( 'parent_wpdevart_jewstore_premium_features_url', esc_url('https://wpdevart.com/jewstore-best-wordpress-jewelry-store-theme')).'" class="button button-secondary getting-started-main-button getting-started-focus-button" target="_blank">' . sprintf( esc_html__( '%s Premium','jewstore' ), esc_attr ( $theme->get( 'Name' ) ) ) . '</a></p>' );
                        echo ( '<p class="plugin-notice">'.esc_html__( 'To get started, take action and learn more about our theme. If you want to hide this notice, click the Dismiss button in the top right corner.', 'jewstore' ).'</p>' );
                    echo '</div>';
                    echo '<a href="' . esc_url( wp_nonce_url( add_query_arg( 'gs-notice-dismissed', 'dismiss_admin_notices' ) ) ) . '" class="getting-started-notice-dismiss">Dismiss</a>';   
            echo '</div>';
        }
    }

    public function getting_started_notice_dismissed() {
        if ( isset( $_GET['gs-notice-dismissed'] ) ){
            add_user_meta( get_current_user_id(), 'gs_notice_dismissed', 'true' );
        }
    }

    public function flush_dismiss_status() {
        delete_user_meta( get_current_user_id(), 'gs_notice_dismissed', 'true' );
    }

}
new WpDevArt_Theme_Notice_Handler;