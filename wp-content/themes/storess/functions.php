<?php
/**
 * Define Theme Version
 */
define( 'STORESS_THEME_VERSION', '14.9' );

function storess_css() {
	$parent_style = 'storely-parent-style';
	wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'storess-style', get_stylesheet_uri(), array( $parent_style ));
	
	wp_enqueue_style('storess-media-query',get_stylesheet_directory_uri().'/assets/css/responsive.css');
	wp_dequeue_style('storely-media-query');
	
	wp_enqueue_script('storess-custom-js', get_stylesheet_directory_uri() . '/assets/js/custom.js', array('jquery'), false, true);	
}
add_action( 'wp_enqueue_scripts', 'storess_css',999);


require get_stylesheet_directory() . '/inc/customizer/customizer-options/storess-pro.php';


/**
 * Import Settings From Parent Theme
 *
 */
function storess_parent_theme_options() {
	$storely_mods = get_option( 'theme_mods_storely' );
	if ( ! empty( $storely_mods ) ) {
		foreach ( $storely_mods as $storely_mod_k => $storely_mod_v ) {
			set_theme_mod( $storely_mod_k, $storely_mod_v );
		}
	}
}
add_action( 'after_switch_theme', 'storess_parent_theme_options' );