<?php

require get_template_directory() . '/inc/customizer/custom-controls.php';
require get_template_directory() . '/inc/admin/sanitization.php';

function wpdevart_jewstore_customize_register( $wp_customize ) {

	require get_template_directory() . '/inc/customizer/sections/premium-link-section.php';
	require get_template_directory() . '/inc/customizer/sections/premium-features-list.php';

	require get_template_directory() . '/inc/customizer/sections/logo-customizer.php';
	require get_template_directory() . '/inc/customizer/sections/general-customizer.php';
	require get_template_directory() . '/inc/customizer/sections/custom-homepage-customizer.php';
	require get_template_directory() . '/inc/customizer/sections/top-header-customizer.php';
	require get_template_directory() . '/inc/customizer/sections/header-customizer.php';
	require get_template_directory() . '/inc/customizer/sections/single-post-customizer.php';
	require get_template_directory() . '/inc/customizer/sections/footer-customizer.php';
	require get_template_directory() . '/inc/customizer/sections/blog-archive-customizer.php';
	require get_template_directory() . '/inc/customizer/sections/not-found-customizer.php';
	if ( class_exists( 'WooCommerce' ) ) {
        require get_template_directory() . '/inc/customizer/sections/woocommerce-wpdevart-customizer.php';
    };
}

add_action( 'customize_register', 'wpdevart_jewstore_customize_register' );