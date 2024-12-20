<?php
/**
 * Theme functions and definitions
 *
 * @package Shoppable Jewelry 1.0.0
 */

require get_stylesheet_directory() . '/inc/customizer/customizer.php';
require get_stylesheet_directory() . '/inc/customizer/loader.php';

if ( ! function_exists( 'shoppable_jewelry_enqueue_styles' ) ) :
	/**
	 * @since Shoppable Jewelry 1.0.0
	 */
	function shoppable_jewelry_enqueue_styles() {
        require_once get_theme_file_path ( 'inc/wptt-webfont-loader.php');

		wp_enqueue_style( 'shoppable-jewelry-style-parent', get_template_directory_uri() . '/style.css',
			array(
				'bootstrap',
				'slick',
				'slicknav',
				'slick-theme',
				'fontawesome',
				'hello-shoppable-blocks',
				'hello-shoppable-google-font'
				)
		);
	    wp_enqueue_style(
            'shoppable-jewelry-google-fonts',
            wptt_get_webfont_url( "https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" ),
            false
        );


	}

endif;
add_action( 'wp_enqueue_scripts', 'shoppable_jewelry_enqueue_styles', 10 );


//Stop WooCommerce redirect on activation
add_filter( 'woocommerce_enable_setup_wizard', '__return_false' );

/**
* Get pages by post id.
* 
* @since Shoppable Jewelry 1.0.0
* @return array.
*/
function shoppable_jewelry_get_pages(){
    $shoppable_jewelry_page_array = get_pages();
    $shoppable_jewelry_pages_list = array();
    foreach ( $shoppable_jewelry_page_array as $shoppable_jewelry_key => $shoppable_jewelry_value ){
        $shoppable_jewelry_page_id = absint( $shoppable_jewelry_value->ID );
        $shoppable_jewelry_pages_list[ $shoppable_jewelry_page_id ] = $shoppable_jewelry_value->post_title;
    }
    return $shoppable_jewelry_pages_list;
}

add_theme_support( "title-tag" );
add_theme_support( 'automatic-feed-links' );