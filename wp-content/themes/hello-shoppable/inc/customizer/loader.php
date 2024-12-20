<?php
/**
* Loads all the comp3nts related to customizer 
*
* @since Hello Shoppable 1.0.0
*/

if( !function_exists( 'hello_shoppable_hex2rgba' ) ):
/**
* Convert hexdec color string to rgb(a) string
*/
function hello_shoppable_hex2rgba($color, $opacity = false) {
 
    $default = 'rgba(0,0,0, 0.1)';
 
    # Return default if no color provided
    if( empty( $color ) )
          return $default; 
 
    # Sanitize $color if "#" is provided 
    if ( $color[0] == '#' ) {
        $color = substr( $color, 1 );
    }

    # Check if color has 6 or 3 characters and get values
    if ( strlen( $color ) == 6 ) {
            $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
    } elseif ( strlen( $color ) == 3 ) {
            $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
    } else {
            return $default;
    }
 
    # Convert hexadec to rgb
    $rgb =  array_map('hexdec', $hex);

    # Check if opacity is set(rgba or rgb)
    if( $opacity ){
        if( abs( $opacity ) > 1 )
            $opacity = 1.0;
        $output = 'rgba('.implode( ",",$rgb ).','.$opacity.')';
    } else {
        $output = 'rgb('.implode( ",",$rgb ).')';
    }

    # Return rgb(a) color string
    return $output;
}
endif;

function hello_shoppable_default_styles(){

	// Begin Style
	$css = '<style>';

	# Site Title
	#Site Title Height
	$logo_width = get_theme_mod( 'logo_width', 270 );
	$css .= '
		.site-header .site-branding > a {
			max-width: '. esc_attr( $logo_width ) .'px;
			overflow: hidden;
			display: inline-block;
		}
	';
	// Global colors
	$site_primary_color = get_theme_mod( 'site_primary_color', '#EB5A3E' );
	$site_hover_color = get_theme_mod( 'site_hover_color', '#2154ac' );

	$css .= '
		/* Primary Background, border, color*/
		.header-cart a.cart-icon span.count, .woocommerce span.onsale, body .woocommerce.widget_price_filter .ui-slider .ui-slider-handle, #secondary .widget_block .wc-block-grid__product-onsale {
			background-color: '. esc_attr( $site_primary_color ) .';
		}
		#offcanvas-menu .header-btn-wrap .header-btn .button-text:hover, #offcanvas-menu .header-btn-wrap .header-btn .button-text:focus, #offcanvas-menu .header-btn-wrap .header-btn .button-text:active {
			color: '. esc_attr( $site_primary_color ) .';
		}

		/* Hover Background, border, color */
		.button-primary:hover, .button-primary:active, .button-primary:focus, .comment-navigation .nav-previous a:hover:before, .comment-navigation .nav-previous a:hover:after, .comment-navigation .nav-previous a:focus:before, .comment-navigation .nav-previous a:focus:after, .comment-navigation .nav-next a:hover:before, .comment-navigation .nav-next a:hover:after, .comment-navigation .nav-next a:focus:before, .comment-navigation .nav-next a:focus:after, .posts-navigation .nav-previous a:hover:before, .posts-navigation .nav-previous a:hover:after, .posts-navigation .nav-previous a:focus:before, .posts-navigation .nav-previous a:focus:after, .posts-navigation .nav-next a:hover:before, .posts-navigation .nav-next a:hover:after, .posts-navigation .nav-next a:focus:before, .posts-navigation .nav-next a:focus:after, .post-navigation .nav-previous a:hover:before, .post-navigation .nav-previous a:hover:after, .post-navigation .nav-previous a:focus:before, .post-navigation .nav-previous a:focus:after, .post-navigation .nav-next a:hover:before, .post-navigation .nav-next a:hover:after, .post-navigation .nav-next a:focus:before, .post-navigation .nav-next a:focus:after, .comments-area .comment-list .reply a:hover, .comments-area .comment-list .reply a:focus, .comments-area .comment-list .reply a:active, .widget.widget_search .wp-block-search__button:hover, .widget .tagcloud a:hover, .widget .tagcloud a:focus, .widget .tagcloud a:active, .slicknav_btn:hover .slicknav_icon-bar, .slicknav_btn:focus .slicknav_icon-bar, .slicknav_btn:hover .slicknav_icon-bar, .slicknav_btn:hover .slicknav_icon-bar:first-child:before, .slicknav_btn:hover .slicknav_icon-bar:first-child:after, .slicknav_btn:focus .slicknav_icon-bar:first-child:before, .slicknav_btn:focus .slicknav_icon-bar:first-child:after, .slicknav_btn:hover .slicknav_icon-bar:first-child:before, .slicknav_btn:hover .slicknav_icon-bar:first-child:after, .woocommerce ul.products li.product .button-cart_button_three > a:hover, .woocommerce ul.products li.product .button-cart_button_three > a:focus, .woocommerce #respond input#submit:hover, .woocommerce #respond input#submit:focus, .woocommerce #respond input#submit:active, .woocommerce a.button:hover, .woocommerce a.button:focus, .woocommerce a.button:active, .woocommerce button.button:hover, .woocommerce button.button:focus, .woocommerce button.button:active, .woocommerce input.button:hover, .woocommerce input.button:focus, .woocommerce input.button:active, .woocommerce a.button.alt:hover, .woocommerce a.button.alt:focus, .woocommerce a.button.alt:active, .woocommerce button.button.alt:hover, .woocommerce button.button.alt:focus, .woocommerce button.button.alt:active, .wishlist_table td .product-view a:hover, .wishlist_table td.product-add-to-cart a:hover, body[class*=woocommerce] .widget.widget_product_search [type=submit]:hover, body[class*=woocommerce] .widget.widget_product_search [type=submit]:focus, body[class*=woocommerce] .widget.widget_product_search [type=submit]:active,button[type=submit]:hover,button[type=submit]:active,button[type=submit]:focus {
			background-color: '. esc_attr( $site_hover_color ) .';
		}
		a:focus, button:focus, button:hover, button:active, button:focus, input[type=button]:hover, input[type=button]:active, input[type=button]:focus, input[type=reset]:hover, input[type=reset]:active, input[type=reset]:focus, input[type=submit]:hover, input[type=submit]:active, input[type=submit]:focus, .slick-control li.slick-arrow:not(.slick-disabled):hover span, .slick-control li.slick-arrow:not(.slick-disabled):focus span, .slick-control li.slick-arrow:not(.slick-disabled):active span, .slider-layout-three .slick-control li.slick-arrow:hover, .slider-layout-three .slick-control li.slick-arrow:focus, .slider-layout-three .slick-control li.slick-arrow:active, .slider-layout-three .slick-control li.slick-arrow:hover span, .slider-layout-three .slick-control li.slick-arrow:focus span, .slider-layout-three .slick-control li.slick-arrow:active span, .wrap-coming-maintenance-mode .coming-maintenance-image-wrap .slick-control li:not(.slick-disabled):hover span, .wrap-coming-maintenance-mode .coming-maintenance-image-wrap .slick-control li:not(.slick-disabled):focus span, .wrap-coming-maintenance-mode .coming-maintenance-image-wrap .slick-control li:not(.slick-disabled):active span, .widget .tagcloud a:hover, .widget .tagcloud a:focus, .widget .tagcloud a:active,#back-to-top a:hover, #back-to-top a:focus, #back-to-top a:active {
			border-color: '. esc_attr( $site_hover_color ) .';
		}
		a:hover, a:focus, a:active, .main-navigation ul.menu > li:hover > a, .main-navigation ul.menu > li:focus > a, .main-navigation ul.menu > li:active > a, .main-navigation ul.menu > li:focus-within > a, .main-navigation ul.menu > li.focus > a, .main-navigation ul.menu ul li a:hover, .main-navigation ul.menu ul li a:focus, .main-navigation ul.menu ul li a:active, .breadcrumb-wrap .breadcrumbs a:hover, .comments-area .comment-list .comment-metadata > a:hover, .comments-area .comment-list .comment-metadata > a:focus, .comments-area .comment-list .comment-metadata > a:active, .widget ul li a:hover, .widget ul li a:focus, .widget ul li a:active, .widget ol li a:hover, .widget ol li a:focus, .widget ol li a:active, .author-widget .socialgroup ul li a:hover, .author-widget .socialgroup ul li a:focus, .author-widget .socialgroup ul li a:active, .slicknav_menu .slicknav_nav li a:hover, .slicknav_menu .slicknav_nav li a:focus, .slicknav_menu .slicknav_nav li a:active, .woocommerce ul.products li.product .woocommerce-loop-product__title:hover, .woocommerce ul.products li.product .woocommerce-loop-product__title:focus, .woocommerce ul.products li.product .woocommerce-loop-product__title:active, .woocommerce ul.products li.product .price:hover, .woocommerce a.added_to_cart:hover, .woocommerce a.added_to_cart:focus, .woocommerce a.added_to_cart:active, .woocommerce .woocommerce-MyAccount-navigation ul li a:hover, .woocommerce .woocommerce-MyAccount-navigation ul li a:focus, .woocommerce .woocommerce-MyAccount-navigation ul li a:active, .product-detail-wrapper .entry-summary .woocommerce-review-link:hover, .product-detail-wrapper .entry-summary .woocommerce-review-link:focus, .product-detail-wrapper .entry-summary .yith-wcwl-add-to-wishlist a:hover, .product-detail-wrapper .entry-summary .yith-wcwl-add-to-wishlist a:focus, .product-detail-wrapper .entry-summary .compare:hover,
.product-detail-wrapper .entry-summary .compare:focus, .product-detail-wrapper .product_meta span a:hover, .product-detail-wrapper .product_meta span a:focus, .product-detail-wrapper .product_meta span a:active,#back-to-top a:hover, #back-to-top a:focus, #back-to-top a:active {
			color: '. esc_attr( $site_hover_color ) .';
		}

	';
	
	// Default skin colors
	if( !get_theme_mod( 'enable_dark_mode', false ) ){

		# Colors
		$site_body_text_color = get_theme_mod( 'site_body_text_color', '#414141' );
		$site_heading_text_color = get_theme_mod( 'site_heading_text_color', '#030303' );
		$heading_one_text_color 	= get_theme_mod( 'heading_one_text_color', '#030303' );
		$heading_two_text_color 	= get_theme_mod( 'heading_two_text_color', '#030303' );
		$heading_three_text_color 	= get_theme_mod( 'heading_three_text_color', '#030303' );
		$heading_four_text_color 	= get_theme_mod( 'heading_four_text_color', '#030303' );
		$heading_five_text_color 	= get_theme_mod( 'heading_five_text_color', '#030303' );
		$heading_six_text_color 	= get_theme_mod( 'heading_six_text_color', '#030303' );
		$page_post_text_color = get_theme_mod( 'page_post_text_color', '#030303' );

		$site_general_link_color = get_theme_mod( 'site_general_link_color', '#3795eb' );
		$css .= '
			/* Site general link color */
			a {
				color: '. esc_attr( $site_general_link_color ) .';
			}
			/* Page and Single Post Title */
			.page-title {
				color: '. esc_attr( $page_post_text_color ) .';
			}
			/* Site body Text */
			body {
				color: '. esc_attr( $site_body_text_color ) .';
			}
			h1 {
				color: '. esc_attr( $heading_one_text_color ) .';
			}
			h2 {
				color: '. esc_attr( $heading_two_text_color ) .';
			}
			h3 {
				color: '. esc_attr( $heading_three_text_color ) .';
			}
			h4 {
				color: '. esc_attr( $heading_four_text_color ) .';
			}
			h5 {
				color: '. esc_attr( $heading_five_text_color ) .';
			}
			h6 {
				color: '. esc_attr( $heading_six_text_color ) .';
			}
			/* Heading Text */
			h1, h2, h3, h4, h5, h6, .product-title {
				color: '. esc_attr( $site_heading_text_color ) .';
			}	
		';

		/* Site general meta color */
		$general_post_meta_color 		= get_theme_mod( 'general_post_meta_color', '#717171' );
		$css .= '
			.entry-meta a {
				color: '. esc_attr( $general_post_meta_color ) .';
			}
			.entry-meta a:before,
			.single .cat-links:before,
			.single .entry-meta .tag-links:before {
				color: '. esc_attr( hello_shoppable_hex2rgba( $general_post_meta_color, 0.8 ) ).';
			}
		';
		#Form fields color
		$form_text_color 		= get_theme_mod( 'form_text_color', '' );
		$form_bg_color 			= get_theme_mod( 'form_bg_color', '' );
		$form_border_color      = get_theme_mod( 'form_border_color', '' );
		$form_placeholder_color = get_theme_mod( 'form_placeholder_color', '' );
		$css .= '
			input:not([type="submit"]),
			textarea {
				background-color: '. esc_attr( $form_bg_color ) .';
				border-color: '. esc_attr( $form_border_color ) .';
				color: '. esc_attr( $form_text_color ) .';
			}
			input::-webkit-input-placeholder {
			  color: '. esc_attr( $form_placeholder_color ) .';
			}
			input::-moz-placeholder {
			  color: '. esc_attr( $form_placeholder_color ) .';
			}
			input:-ms-input-placeholder {
			  color: '. esc_attr( $form_placeholder_color ) .';
			}
			input:-moz-placeholder {
			  color: '. esc_attr( $form_placeholder_color ) .';
			}
			.header-one .header-cat-search-form form {
				background-color: '. esc_attr( $form_bg_color ) .';
			}
			.header-one .header-cat-search-form form {
				border-color: '. esc_attr( $form_border_color ) .';
			}
			.header-four .bottom-header .header-cat-search-form form > div .header-search-select {
				background-color: '. esc_attr( $form_bg_color ) .';
			}
			.header-cat-search-form select, 
			.header-cat-search-form form input.header-search-input, 
			.header-cat-search-form form button.header-search-button, 
			.header-cat-search-form form div:after,
			.header-cat-search-form .search-form button.search-button {
				color: '. esc_attr( $form_text_color ) .';
			}
		';
		# general button options
		$general_button_text_color 			= get_theme_mod( 'general_button_text_color', '#FFFFFF' );
		$general_button_bg_color 			= get_theme_mod( 'general_button_bg_color', '#333333' );
		$general_button_border_color 		= get_theme_mod( 'general_button_border_color', '' );
		
		$general_button_text_hover_color 	= get_theme_mod( 'general_button_text_hover_color', '#ffffff' );
		$general_button_bg_hover_color 		= get_theme_mod( 'general_button_bg_hover_color', '#2154ac' );
		$general_button_border_hover_color 	= get_theme_mod( 'general_button_border_hover_color', '#2154ac' );
		
		$general_button_border_width 		= get_theme_mod( 'general_button_border_width', 0 );
		$general_button_radius 				= get_theme_mod( 'general_button_radius', 0 );
		$css .= '
			input[type="button"],
			input[type="reset"],
			input[type="submit"],
			.button-primary,
			.wp-block-search__button,
			.widget.widget_search .wp-block-search__button {
				background-color: '. esc_attr( $general_button_bg_color ) .';
				border-color: '.esc_attr($general_button_border_color) .';
				color: '. esc_attr( $general_button_text_color ) .';
			}
			input[type="button"],
			input[type="reset"],
			input[type="submit"],
			.button-primary,
			.wp-block-search__button,
			.widget.widget_search .wp-block-search__button {
				border-width: '. esc_attr( $general_button_border_width ) .'px;
				border-radius: '. esc_attr( $general_button_radius ) .'px;
				border-style: solid;
			}
			input[type="button"]:hover,
			input[type="button"]:focus,
			input[type="reset"]:hover,
			input[type="reset"]:focus,
			input[type="submit"]:hover,
			input[type="submit"]:focus,
			.button-primary:hover,
			.button-primary:focus,
			.wp-block-search__button:hover,
			.wp-block-search__button:focus,
			.widget.widget_search .wp-block-search__button:hover,
			.widget.widget_search .wp-block-search__button:focus {
				background-color: '. esc_attr( $general_button_bg_hover_color ) .';
				border-color: '. esc_attr( $general_button_border_hover_color ) .';
				color: '. esc_attr( $general_button_text_hover_color ) .';
			}
		';

		# woocommerce button options
		$woocommerce_button_text_color 			= get_theme_mod( 'woocommerce_button_text_color', '#FFFFFF' );
		$woocommerce_button_bg_color 			= get_theme_mod( 'woocommerce_button_bg_color', '#333333' );
		$woocommerce_button_border_color 		= get_theme_mod( 'woocommerce_button_border_color', '' );
		
		$woocommerce_button_text_hover_color 	= get_theme_mod( 'woocommerce_button_text_hover_color', '#ffffff' );
		$woocommerce_button_bg_hover_color 		= get_theme_mod( 'woocommerce_button_bg_hover_color', '#2154ac' );
		$woocommerce_button_border_hover_color 	= get_theme_mod( 'woocommerce_button_border_hover_color', '#2154ac' );
		
		$woocommerce_button_border_width 		= get_theme_mod( 'woocommerce_button_border_width', 0 );
		$woocommerce_button_radius 				= get_theme_mod( 'woocommerce_button_radius', 0 );
		$css .= '
			.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce a.button.alt, .woocommerce button.button.alt,.woocommerce:where(body:not(.woocommerce-block-theme-has-button-styles)) button.button.alt.disabled {
				background-color: '. esc_attr( $woocommerce_button_bg_color ) .';
				border-color: '. esc_attr( $woocommerce_button_border_color ) .';
				color: '. esc_attr( $woocommerce_button_text_color ) .';
			}
			.woocommerce #respond input#submit:hover, .woocommerce #respond input#submit:focus, .woocommerce #respond input#submit:active, .woocommerce a.button:hover, .woocommerce a.button:focus, .woocommerce a.button:active, .woocommerce button.button:hover, .woocommerce button.button:focus, .woocommerce button.button:active, .woocommerce input.button:hover, .woocommerce input.button:focus, .woocommerce input.button:active, .woocommerce a.button.alt:hover, .woocommerce a.button.alt:focus, .woocommerce a.button.alt:active, .woocommerce button.button.alt:hover, .woocommerce button.button.alt:focus, .woocommerce button.button.alt:active,.woocommerce:where(body:not(.woocommerce-block-theme-has-button-styles)) button.button.alt.disabled:hover,.woocommerce:where(body:not(.woocommerce-block-theme-has-button-styles)) button.button.alt.disabled:focus {
				background-color: '. esc_attr( $woocommerce_button_bg_hover_color ) .';
				border-color: '. esc_attr( $woocommerce_button_border_hover_color ) .';
				color: '. esc_attr( $woocommerce_button_text_hover_color ) .';
			}
			.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce a.button.alt, .woocommerce button.button.alt {
				border-radius: '. esc_attr( $woocommerce_button_radius ) .'px;
			}
			.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce a.button.alt, .woocommerce button.button.alt {
				border-width: '. esc_attr( $woocommerce_button_border_width ) .'px;
				border-style: solid;
			}
		';

		/* Notification Bar */
		$notification_bar_background_color 			= get_theme_mod( 'notification_bar_background_color', '#1a1a1a' );
		$notification_bar_title_color 				= get_theme_mod( 'notification_bar_title_color', '#ffffff' );
		$notification_bar_image_height 				= get_theme_mod( 'notification_bar_image_height', 40 );
		$css .= '
			.notification-bar {
				background-color: '. esc_attr( $notification_bar_background_color ) .';
			}
			.notification-bar {
				max-height: '. esc_attr( $notification_bar_image_height ) .';
			}
			.notification-bar .notification-wrap {
				color: '. esc_attr( $notification_bar_title_color ) .';
			}
		';

		# Notification Button
		if( get_theme_mod( 'top_notification_button', true ) ){
			$noti_button_bg_color 		= get_theme_mod( 'noti_button_bg_color', '' );
			$noti_button_text_color 		= get_theme_mod( 'noti_button_text_color', '' );
			$noti_button_border_color 	= get_theme_mod( 'noti_button_border_color', '' );

			$noti_button_text_hover_color 	= get_theme_mod( 'noti_button_text_hover_color', '' );
			if( empty( $noti_button_text_hover_color ) ){
				$noti_button_text_hover_color = $general_button_text_hover_color;
			}
			$noti_button_background_hover_color 	= get_theme_mod( 'noti_button_background_hover_color', '' );
			if( empty( $noti_button_background_hover_color ) ){
				$noti_button_background_hover_color = $general_button_bg_hover_color;
			}
			$noti_button_border_hover_color 	= get_theme_mod( 'noti_button_border_hover_color', '' );
			if( empty( $noti_button_border_hover_color ) ){
				$noti_button_border_hover_color = $general_button_border_hover_color;
			}

			$noti_button_border_width 	= get_theme_mod( 'noti_button_border_width', '' );
			$noti_button_radius 			= get_theme_mod( 'noti_button_radius', '' );
			$css .= '
				.notification-bar .button-container a {
					border-width: '. esc_attr( $noti_button_border_width ) .'px;
					border-style: solid;
				}
				.notification-bar .button-container a {
					background-color: '. esc_attr( $noti_button_bg_color ) .';
					border-color: '. esc_attr( $noti_button_border_color ) .';
					color: '. esc_attr( $noti_button_text_color ) .';
				}

				.notification-bar .button-container a:hover,
				.notification-bar .button-container a:focus,
				.notification-bar .button-container a:active {
					background-color: '. esc_attr( $noti_button_background_hover_color ) .';
					border-color: '. esc_attr( $noti_button_border_hover_color ) .';
					color: '. esc_attr( $noti_button_text_hover_color ) .';
				}

				.notification-bar .button-container a {
					border-radius: '. esc_attr( $noti_button_radius ) .'px;
				}
			';
		}

		/* Top Header Color */
		$top_bar_text_color 				= get_theme_mod( 'top_bar_text_color', '#717171' );
		$top_bar_link_color 				= get_theme_mod( 'top_bar_link_color', '#a6a6a6' );
		$top_header_background_color 		= get_theme_mod( 'top_header_background_color', '' );
		$top_header_text_color 				= get_theme_mod( 'top_header_text_color', '#717171' );
		$top_header_text_link_hover_color 	= get_theme_mod( 'top_header_text_link_hover_color', '#2154ac' );
		$css .= '
			.site-header .top-header {
				background-color: '. esc_attr( $top_header_background_color ) .';
			}
			.site-header .header-navigation ul li a,.site-header .header-contact ul li,.site-header .social-profile ul li a,.site-header .header-text {
				color: '. esc_attr( $top_header_text_color ) .';
			}
			.site-header .header-text {
				color: '. esc_attr( $top_bar_text_color ) .';
			}
			.site-header .header-text a {
				color: '. esc_attr( $top_bar_link_color ) .';
			}
			.site-header .header-navigation ul li a:hover, .site-header .header-navigation ul li a:focus,.site-header .header-navigation ul li a:active,
			.site-header .header-contact ul li a:hover,.site-header .header-contact ul li a:focus,.site-header .header-contact ul li a:active,
			.site-header .social-profile ul li a:hover,.site-header .social-profile ul li a:focus,.site-header .social-profile ul li a:active,
			.site-header .header-text a:hover,.site-header .header-text a:focus, .site-header .header-text a:active {
				color: '. esc_attr( $top_header_text_link_hover_color ) .';
			}
		';
		$top_header_border_color = get_theme_mod( 'top_header_border_color', '#F1F1F1' );
		$mid_header_border_color = get_theme_mod( 'mid_header_border_color', '#F1F1F1' );
		$css .= '
			.top-header {
				border-color: '.esc_attr( $top_header_border_color ) .';
			}
			.bottom-header-inner {
				border-color: '.esc_attr( $mid_header_border_color ) .';
			}
			.header-three .mid-header {
				border-color: '.esc_attr( $mid_header_border_color ) .';
			}
			.header-four .mid-header {
				border-color: '.esc_attr( $mid_header_border_color ) .';
			}
		';

		/* Mid Header Background */
		$mid_header_background_color = get_theme_mod( 'mid_header_background_color', '' );
		$mid_header_text_color = get_theme_mod( 'mid_header_text_color', '#333333' );
		$mid_header_text_link_hover_color = get_theme_mod( 'mid_header_text_link_hover_color', '#2154ac' );

		/* Header search colors */
		$header_search_bg_color 			= get_theme_mod( 'header_search_bg_color', '#F8F8F8' );
		$header_search_placeholder_color 	= get_theme_mod( 'header_search_placeholder_color', '' );
		if( empty( $header_search_placeholder_color ) ){
			$header_search_placeholder_color = $form_placeholder_color;
		}
		$header_search_text_color		 	= get_theme_mod( 'header_search_text_color', '' );
		if( empty( $header_search_text_color ) ){
			$header_search_text_color = $form_text_color;
		}
		$header_search_border_color		 	= get_theme_mod( 'header_search_border_color', '' );
		if( empty( $header_search_border_color ) ){
			$header_search_border_color = $form_border_color;
		}

		/* Bottom Header Background */
		$bottom_header_background_color 	 = get_theme_mod( 'bottom_header_background_color', '' );
		$bottom_header_text_color 			 = get_theme_mod( 'bottom_header_text_color', '#333333' );
		$header_menu_active_color 			 = get_theme_mod( 'header_menu_active_color', '#2154ac' );
		$sub_menu_link_hover_color 			 = get_theme_mod( 'sub_menu_link_hover_color', '#2154ac' );
		$bottom_header_text_link_hover_color = get_theme_mod( 'bottom_header_text_link_hover_color', '#2154ac' );

		if( get_theme_mod( 'header_layout', 'header_one' ) == 'header_one' ){
			// Header 1 mid-header color,background,border css
			$css .= '
				.header-bg-overlay {
					background-color: '. esc_attr( $mid_header_background_color ) .';
				}
				.site-header .bottom-contact a,.amount-cart {
					color: '. esc_attr( $mid_header_text_color ) .';
				}
				.header-right svg path,.bottom-contact svg path {
					fill: '. esc_attr( $mid_header_text_color ) .';
				}
				.site-header .bottom-contact .label {
					color: '. esc_attr( hello_shoppable_hex2rgba( $mid_header_text_color, 0.6 ) ).';
				}
				.header-right a:hover svg path,.header-right a:focus svg path {
					fill: '. esc_attr( $mid_header_text_link_hover_color ) .';
				}
				.site-header .bottom-contact a:hover, .site-header .bottom-contact a:focus, .header-cat-search-form form button.header-search-button:hover, .header-cat-search-form form button.header-search-button:focus {
					color: '. esc_attr( $mid_header_text_link_hover_color ) .';
				}
			';
			// Header 1 bottom-header color,background,border css
			$css .='
			    .bottom-header {
			    	background-color: '. esc_attr( $bottom_header_background_color ) .';
			    } 
			    .main-navigation ul.menu > li.current-menu-item > a {
					color: '. esc_attr( $header_menu_active_color ) .';
				}
				.main-navigation ul.menu > li > a,
				.mobile-menu-container .slicknav_menu .slicknav_menutxt {
					color: '. esc_attr( $bottom_header_text_color ) .';
				}
				.slicknav_btn .slicknav_icon span,
				.slicknav_btn .slicknav_icon span,
				.slicknav_btn .slicknav_icon span:first-child:before, 
				.slicknav_btn .slicknav_icon span:first-child:before, 
				.slicknav_btn .slicknav_icon span:first-child:after,
				.slicknav_btn .slicknav_icon span:first-child:after {
					background-color: '. esc_attr( $bottom_header_text_color ) .';
				}
				.main-navigation ul.menu > li > a:hover,.main-navigation ul.menu > li > a:focus,
				.header-category-nav .navbar-nav li li a:hover,.header-category-nav .navbar-nav li li a:focus,
				.mobile-menu-container .slicknav_menu slicknav_btn:hover .slicknav_menutxt,
				.mobile-menu-container .slicknav_menu slicknav_btn:focus .slicknav_menutxt {
					color: '. esc_attr( $bottom_header_text_link_hover_color ) .';
				}
				.mobile-menu-container .slicknav_btn:hover .slicknav_icon span,
				.mobile-menu-container .slicknav_btn:focus .slicknav_icon span,
				.mobile-menu-container .slicknav_btn:hover .slicknav_icon span:first-child:before, 
				.mobile-menu-container .slicknav_btn:focus .slicknav_icon span:first-child:before, 
				.mobile-menu-container .slicknav_btn:hover .slicknav_icon span:first-child:after,
				.mobile-menu-container .slicknav_btn:focus .slicknav_icon span:first-child:after {
					background-color: '. esc_attr( $bottom_header_text_link_hover_color ) .';
				}
				/* search form color */
				.header-cat-search-form form {
					background-color: '. esc_attr( $header_search_bg_color ) .';
					border-color: '. esc_attr( $header_search_border_color ) .';
					color: '. esc_attr( $header_search_text_color ) .';
				}
				.header-cat-search-form form div {
					border-left-color: '. esc_attr( hello_shoppable_hex2rgba( $header_search_text_color, 0.06 ) ).'; 
					border-right-color: '. esc_attr( hello_shoppable_hex2rgba( $header_search_text_color, 0.06 ) ).'; 
				}
			';
		}elseif( get_theme_mod( 'header_layout', 'header_one' ) == 'header_two' ){
			// Header 2 bottom-header color,background,border css
			$css .= '
				.bottom-header,
				.mobile-menu-container {
					background-color: '. esc_attr( $bottom_header_background_color ) .';
				}
				.main-navigation ul.menu > li.current-menu-item > a {
					color: '. esc_attr( $header_menu_active_color ) .';
				}
				.main-navigation ul.menu > li > a,.amount-cart,
				.mobile-menu-container .slicknav_menu .slicknav_menutxt {
					color: '. esc_attr( $bottom_header_text_color ) .';
				}
				.header-right svg path {
					fill: '. esc_attr( $bottom_header_text_color ) .';
				}
				.slicknav_btn .slicknav_icon span,
				.slicknav_btn .slicknav_icon span,
				.slicknav_btn .slicknav_icon span:first-child:before, 
				.slicknav_btn .slicknav_icon span:first-child:before, 
				.slicknav_btn .slicknav_icon span:first-child:after,
				.slicknav_btn .slicknav_icon span:first-child:after {
					background-color: '. esc_attr( $bottom_header_text_color ) .';
				}
				.main-navigation ul.menu > li > a:hover,.main-navigation ul.menu > li > a:focus,
				.header-category-nav .navbar-nav li li a:hover,.header-category-nav .navbar-nav li li a:focus,
				.mobile-menu-container .slicknav_menu .slicknav_btn:hover .slicknav_menutxt,
				.mobile-menu-container .slicknav_menu .slicknav_btn:focus .slicknav_menutxt {
					color: '. esc_attr( $bottom_header_text_link_hover_color ) .';
				}
				.header-right svg:hover path,
				.header-right svg:focus path {
					fill: '. esc_attr( $bottom_header_text_link_hover_color ) .';
				}
				.mobile-menu-container .slicknav_btn:hover .slicknav_icon span,
				.mobile-menu-container .slicknav_btn:focus .slicknav_icon span,
				.mobile-menu-container .slicknav_btn:hover .slicknav_icon span:first-child:before, 
				.mobile-menu-container .slicknav_btn:focus .slicknav_icon span:first-child:before, 
				.mobile-menu-container .slicknav_btn:hover .slicknav_icon span:first-child:after,
				.mobile-menu-container .slicknav_btn:focus .slicknav_icon span:first-child:after {
					background-color: '. esc_attr( $bottom_header_text_link_hover_color ) .';
				}
			';

			if( !get_theme_mod( 'enable_search_icon', true ) || !get_theme_mod( 'enable_mobile_search_icon', true ) ){
				$css .= '
					@media screen and (max-width: 991px){
						.header-two .header-search-wrap {
							display:none!important;
						}
					}
				';
			}
		}elseif( get_theme_mod( 'header_layout', 'header_one' ) == 'header_three' ){
			// Header 3 mid-header color,background,border css
			$css .= '
				.mid-header {
					background-color: '. esc_attr( $mid_header_background_color ) .';
				}
			';
			// Header 3 bottom-header color,background,border css
			$css .= '
				.bottom-header {
					background-color: '. esc_attr( $bottom_header_background_color ) .';
				}
				.main-navigation ul.menu > li > a,.header-three .amount-cart,
				.mobile-menu-container .slicknav_menu .slicknav_menutxt {
					color: '. esc_attr( $bottom_header_text_color ) .';
				}
				.header-icons svg path {
					fill: '. esc_attr( $bottom_header_text_color ) .';
				}
				.main-navigation ul.menu > li.current-menu-item > a {
					color: '. esc_attr( $header_menu_active_color ) .';
				}
				.slicknav_btn .slicknav_icon span,
				.slicknav_btn .slicknav_icon span,
				.slicknav_btn .slicknav_icon span:first-child:before, 
				.slicknav_btn .slicknav_icon span:first-child:before, 
				.slicknav_btn .slicknav_icon span:first-child:after,
				.slicknav_btn .slicknav_icon span:first-child:after {
					background-color: '. esc_attr( $bottom_header_text_color ) .';
				}
				.main-navigation ul.menu > li > a:hover,.main-navigation ul.menu > li > a:focus,
				.header-category-nav .navbar-nav li li a:hover,.header-category-nav .navbar-nav li li a:focus,
				.mobile-menu-container .slicknav_menu .slicknav_btn:hover .slicknav_menutxt,
				.mobile-menu-container .slicknav_menu .slicknav_btn:focus .slicknav_menutxt {
					color: '. esc_attr( $bottom_header_text_link_hover_color ) .';
				}
				.header-right a:hover svg path,.header-right a:focus svg path,
				.header-search-wrap .search-icon:hover svg path,.header-search-wrap .search-icon:focus svg path {
					fill: '. esc_attr( $bottom_header_text_link_hover_color ) .';
				}
				.mobile-menu-container .slicknav_btn:hover .slicknav_icon span,
				.mobile-menu-container .slicknav_btn:focus .slicknav_icon span,
				.mobile-menu-container .slicknav_btn:hover .slicknav_icon span:first-child:before, 
				.mobile-menu-container .slicknav_btn:focus .slicknav_icon span:first-child:before, 
				.mobile-menu-container .slicknav_btn:hover .slicknav_icon span:first-child:after,
				.mobile-menu-container .slicknav_btn:focus .slicknav_icon span:first-child:after {
					background-color: '. esc_attr( $bottom_header_text_link_hover_color ) .';
				}
			';

			if( !get_theme_mod( 'enable_search_icon', true ) || !get_theme_mod( 'enable_mobile_search_icon', true ) ){
				$css .= '
					@media screen and (max-width: 991px){
						.header-three .header-search-wrap {
							display:none!important;
						}
					}
				';
			}
		}elseif( get_theme_mod( 'header_layout', 'header_one' ) == 'header_four' ){
			// Header 4 mid-header color,background,border css
			$css .= '
				.mid-header .header-bg-overlay {
					background-color: '. esc_attr( $mid_header_background_color ) .';
				}
				.amount-cart {
					color: '. esc_attr( $mid_header_text_color ) .';
				}
				.header-icon svg path {
					fill: '. esc_attr( $mid_header_text_color ) .';
				}
				.header-icon svg:hover path,.header-four .header-icon svg:focus path {
					fill: '. esc_attr( $mid_header_text_link_hover_color ) .';
				}
			';
			// Header 4 bottom-header color,background,border css
			$css .='
				.bottom-header {
					background-color: '. esc_attr( $bottom_header_background_color ) .';
				}
				.main-navigation ul.menu > li.current-menu-item > a {
					color: '. esc_attr( $header_menu_active_color ) .';
				}
				.main-navigation ul.menu > li > a,
				.mobile-menu-container .slicknav_menu .slicknav_menutxt {
					color: '. esc_attr( $bottom_header_text_color ) .';
				}
				.slicknav_btn .slicknav_icon span,
				.slicknav_btn .slicknav_icon span,
				.slicknav_btn .slicknav_icon span:first-child:before, 
				.slicknav_btn .slicknav_icon span:first-child:before, 
				.slicknav_btn .slicknav_icon span:first-child:after,
				.slicknav_btn .slicknav_icon span:first-child:after {
					background-color: '. esc_attr( $bottom_header_text_color ) .';
				}
				.main-navigation ul.menu > li > a:hover,.main-navigation ul.menu > li > a:focus,
				.header-category-nav .navbar-nav li li a:hover,.header-category-nav .navbar-nav li li a:focus,
				.mobile-menu-container .slicknav_menu .slicknav_btn:hover .slicknav_menutxt,
				.mobile-menu-container .slicknav_menu .slicknav_btn:focus .slicknav_menutxt {
					color: '. esc_attr( $bottom_header_text_link_hover_color ) .';
				}
				.mobile-menu-container .slicknav_btn:hover .slicknav_icon span,
				.mobile-menu-container .slicknav_btn:focus .slicknav_icon span,
				.mobile-menu-container .slicknav_btn:hover .slicknav_icon span:first-child:before, 
				.mobile-menu-container .slicknav_btn:focus .slicknav_icon span:first-child:before, 
				.mobile-menu-container .slicknav_btn:hover .slicknav_icon span:first-child:after,
				.mobile-menu-container .slicknav_btn:focus .slicknav_icon span:first-child:after {
					background-color: '. esc_attr( $bottom_header_text_link_hover_color ) .';
				}
				/* search form color */
				.bottom-header .header-cat-search-form form > div .header-search-select {
					background-color: '. esc_attr( $header_search_bg_color ) .';
					color: '. esc_attr( $header_search_text_color ) .';
				}
				.bottom-header .header-cat-search-form form {
					border-left-color: '. esc_attr( hello_shoppable_hex2rgba( $header_search_text_color, 0.06 ) ).'; 
					border-right-color: '. esc_attr( hello_shoppable_hex2rgba( $header_search_text_color, 0.06 ) ).'; 
				}
				.bottom-header .header-cat-search-form form {
					border-left-color: '. esc_attr( $header_search_border_color ) .';
					border-right-color: '. esc_attr( $header_search_border_color ) .';
				}
			';
		}	

		$css .= '
			.header-cat-search-form form input::-webkit-input-placeholder { /* Chrome/Opera/Safari */
			  color: '. esc_attr( $header_search_placeholder_color ) .';
			}
			.header-cat-search-form form input::-moz-placeholder { /* Firefox 19+ */
			  color: '. esc_attr( $header_search_placeholder_color ) .';
			}
			.header-cat-search-form form input:-ms-input-placeholder { /* IE 10+ */
			  color: '. esc_attr( $header_search_placeholder_color ) .';
			}
			.header-cat-search-form form input:-moz-placeholder { /* Firefox 18- */
			  color: '. esc_attr( $header_search_placeholder_color ) .';
			}
			.header-cat-search-form select,.header-cat-search-form form input.header-search-input,.header-cat-search-form form button.header-search-button,.header-cat-search-form form div:after,.header-cat-search-form .search-form button.search-button {
				color: '. esc_attr( $header_search_text_color ) .';
			}
			.header-cat-search-form form button.header-search-button:hover,.header-cat-search-form form button.header-search-button:focus {
				color: '. esc_attr( $mid_header_text_link_hover_color ) .';
			}
		';

		# Header Sub Menu Hove Text color
		$css .= '
			#masthead .main-navigation ul.menu ul li a:hover,
			#masthead .main-navigation ul.menu ul li a:focus,
			#masthead .main-navigation ul.menu ul li a:active {
				color: '. esc_attr( $sub_menu_link_hover_color ) .';
			}
		';

		# Header Cat Menu Button
		if( get_theme_mod( 'enable_header_woo_cat_menu', true ) ){
			if( get_theme_mod( 'enable_header_cat_menu_width', false ) ){
				$header_cat_menu_width 	= get_theme_mod( 'header_cat_menu_width', 180 );
				$css .= '
					@media screen and (min-width: 992px){
						.header-category-nav .navbar-nav .dropdown-menu,
						.header-category-nav .navbar-nav .sub-menu {
							min-width: '. esc_attr( $header_cat_menu_width ) .'px;
						}
					}
				';
			}
			
			$header_cat_menu_bg_color 		= get_theme_mod( 'header_cat_menu_bg_color', '' );
			$header_cat_menu_border_color 	= get_theme_mod( 'header_cat_menu_border_color', '' );
			$header_cat_menu_text_color 	= get_theme_mod( 'header_cat_menu_text_color', '' );

			$header_cat_menu_text_hover_color 	= get_theme_mod( 'header_cat_menu_text_hover_color', '' );
			if( empty( $header_cat_menu_text_hover_color ) ){
				$header_cat_menu_text_hover_color = $general_button_text_hover_color;
			}
			$header_cat_menu_background_hover_color 	= get_theme_mod( 'header_cat_menu_background_hover_color', '' );
			if( empty( $header_cat_menu_background_hover_color ) ){
				$header_cat_menu_background_hover_color = $general_button_bg_hover_color;
			}
			$header_cat_menu_border_hover_color 	= get_theme_mod( 'header_cat_menu_border_hover_color', '' );
			if( empty( $header_cat_menu_border_hover_color ) ){
				$header_cat_menu_border_hover_color = $general_button_border_hover_color;
			}

			$header_cat_menu_border_width 	= get_theme_mod( 'header_cat_menu_border_width', 0 );
			$header_cat_menu_border_radius 	= get_theme_mod( 'header_cat_menu_border_radius', 0 );
			$css .= '
				.header-category-nav .navbar-nav > li > a {
					background-color: '. esc_attr( $header_cat_menu_bg_color ) .';
					border-color: '. esc_attr( $header_cat_menu_border_color ) .';
					color: '. esc_attr( $header_cat_menu_text_color ) .';
				}
				.header-category-nav .navbar-nav .menu-icon svg path {
					fill: '. esc_attr( $header_cat_menu_text_color ) .';
				}
				.header-category-nav .navbar-nav > li > a:hover,.header-category-nav .navbar-nav > li > a:focus,.header-category-nav .navbar-nav > li > a:active {
					background-color: '. esc_attr( $header_cat_menu_background_hover_color ) .';
					border-color: '. esc_attr( $header_cat_menu_border_hover_color ) .';
					color: '. esc_attr( $header_cat_menu_text_hover_color ) .';
				}
				.header-category-nav .navbar-nav > li > a:hover .menu-icon svg path,.header-category-nav .navbar-nav > li > a:focus .menu-icon svg path,
				.header-category-nav .navbar-nav > li > a:active .menu-icon svg path {
					fill: '. esc_attr( $header_cat_menu_text_hover_color ) .';
				}
				.header-category-nav .navbar-nav > li > a {
					border-width: '. esc_attr( $header_cat_menu_border_width ) .'px;
					border-style: solid;
				}
				.header-category-nav .navbar-nav > li > a {
					border-radius: '. esc_attr( $header_cat_menu_border_radius ) .'px;
				}
			';
		}
		
		# Header Button
		if( get_theme_mod( 'header_button', true ) ){
			$header_button_bg_color 		= get_theme_mod( 'header_button_bg_color', '' );
			$header_button_border_color 	= get_theme_mod( 'header_button_border_color', '' );
			$header_button_text_color 		= get_theme_mod( 'header_button_text_color', '' );

			$header_button_text_hover_color 	= get_theme_mod( 'header_button_text_hover_color', '' );
			if( empty( $header_button_text_hover_color ) ){
				$header_button_text_hover_color = $general_button_text_hover_color;
			}
			$header_button_background_hover_color 	= get_theme_mod( 'header_button_background_hover_color', '' );
			if( empty( $header_button_background_hover_color ) ){
				$header_button_background_hover_color = $general_button_bg_hover_color;
			}
			$header_button_border_hover_color 	= get_theme_mod( 'header_button_border_hover_color', '' );
			if( empty( $header_button_border_hover_color ) ){
				$header_button_border_hover_color = $general_button_border_hover_color;
			}

			$header_button_border_width 	= get_theme_mod( 'header_button_border_width', '' );
			$header_button_radius 			= get_theme_mod( 'header_button_radius', '' );
			$css .= '
				.site-header .button-primary {
					border-width: '. esc_attr( $header_button_border_width ) .'px;
					border-style: solid;
				}
				.site-header .button-primary {
					background-color: '. esc_attr( $header_button_bg_color ) .';
					border-color: '. esc_attr( $header_button_border_color ) .';
					color: '. esc_attr( $header_button_text_color ) .';
				}

				.site-header .button-primary:hover,
				.site-header .button-primary:focus,
				.site-header .button-primary:active {
					background-color: '. esc_attr( $header_button_background_hover_color ) .';
					border-color: '. esc_attr( $header_button_border_hover_color ) .';
					color: '. esc_attr( $header_button_text_hover_color ) .';
				}

				.site-header .button-primary {
					border-radius: '. esc_attr( $header_button_radius ) .'px;
				}
			';
		}

		$fixed_header_background_color 	= get_theme_mod( 'fix_header_bottom_background_color', '' );
		$fixed_header_title_color       = get_theme_mod( 'fixed_header_title_color', '#030303' );
		$fixed_header_tagline_color     = get_theme_mod( 'fixed_header_tagline_color', '#767676' );
		$css .= '
			.sticky-header.fixed-header {
				background-color: '. esc_attr( $fixed_header_background_color ) .';
			}
			.fixed-header .site-branding .site-title {
				color: '. esc_attr( $fixed_header_title_color ) .';
			}
			.fixed-header .site-branding .site-description {
				color: '. esc_attr( $fixed_header_tagline_color ) .';
			}
		';

		#Fixed Header Color
		$fixed_header_menu_text_color 		 	= get_theme_mod( 'fixed_header_menu_text_color', '#333333' );
		$fixed_header_menu_active_color 		= get_theme_mod( 'fixed_header_menu_active_color', '#2154ac' );
		$fixed_header_text_link_hover_color     = get_theme_mod( 'fixed_header_bottom_text_link_hover_color', '#2154ac' );
		$fixed_header_sub_menu_link_hover_color = get_theme_mod( 'fix_header_sub_menu_link_hover_color', '#2154ac' );
		$css .= '
			.fixed-header .main-navigation ul.menu > li > a,
			.fixed-menu-container .slicknav_menu .slicknav_menutxt,
			.fixed-header .amount-cart {
				color: '. esc_attr( $fixed_header_menu_text_color ) .';
			}
			.fixed-header .main-navigation ul.menu > li.current_page_item > a {
				color: '. esc_attr( $fixed_header_menu_active_color ) .';
			}
			.fixed-header .header-right svg path {
				fill: '. esc_attr( $fixed_header_menu_text_color ) .';
			}
			.fixed-menu-container .slicknav_btn .slicknav_icon span,
			.fixed-menu-container .slicknav_btn .slicknav_icon span:first-child:before, 
			.fixed-menu-container .slicknav_btn .slicknav_icon span:first-child:after {
				background-color: '. esc_attr( $fixed_header_menu_text_color ) .';
			}
			.fixed-header .main-navigation ul.menu > li > a:hover,
			.fixed-header .main-navigation ul.menu > li > a:focus,
			.fixed-menu-container .slicknav_menu slicknav_btn:hover .slicknav_menutxt,
			.fixed-menu-container .slicknav_menu slicknav_btn:focus .slicknav_menutxt,
			.fixed-header .site-branding .site-title a:hover,
			.fixed-header .site-branding .site-title a:focus {
				color: '. esc_attr( $fixed_header_text_link_hover_color ) .';
			}
			.fixed-header .header-right a:hover svg path,
			.fixed-header .header-right a:hover svg path,
			.fixed-header .header-right button:hover svg path,
			.fixed-header .header-right button:hover svg path {
				fill: '. esc_attr( $fixed_header_text_link_hover_color ) .';
			}
			.fixed-menu-container .slicknav_btn:hover .slicknav_icon span,
			.fixed-menu-container .slicknav_btn:focus .slicknav_icon span,
			.fixed-menu-container .slicknav_btn:hover .slicknav_icon span:first-child:before, 
			.fixed-menu-container .slicknav_btn:focus .slicknav_icon span:first-child:before, 
			.fixed-menu-container .slicknav_btn:focus .slicknav_icon span:first-child:after,
			.fixed-menu-container .slicknav_btn:hover .slicknav_icon span:first-child:after {
				background-color: '. esc_attr( $fixed_header_menu_text_color ) .';
			}
			.fixed-header .main-navigation ul.menu ul li a:hover,
			.fixed-header .main-navigation ul.menu ul li a:focus,
			.fixed-header .main-navigation ul.menu ul li a:active {
				color: '. esc_attr( $fixed_header_sub_menu_link_hover_color ) .';
			}
		';

		#Fixed Header Button
		$fixed_header_button_bg_color 		= get_theme_mod( 'fixed_header_button_bg_color', '' );
		$fixed_header_button_border_color 	= get_theme_mod( 'fixed_header_button_border_color', '' );
		$fixed_header_button_text_color 	= get_theme_mod( 'fixed_header_button_text_color', '' );
		$css .= '
			.fixed-header .button-primary {
				background-color: '. esc_attr( $fixed_header_button_bg_color ) .';
				border-color: '. esc_attr( $fixed_header_button_border_color ) .';
				color: '. esc_attr( $fixed_header_button_text_color ) .';
			}
		';

		$fixed_header_button_text_hover_color 	= get_theme_mod( 'fixed_header_button_text_hover_color', '' );
		if( empty( $fixed_header_button_text_hover_color ) ){
			$fixed_header_button_text_hover_color = $general_button_text_hover_color;
		}
		$fixed_header_button_background_hover_color 	= get_theme_mod( 'fixed_header_button_background_hover_color', '' );
		if( empty( $fixed_header_button_background_hover_color ) ){
			$fixed_header_button_background_hover_color = $general_button_bg_hover_color;
		}
		$fixed_header_button_border_hover_color 	= get_theme_mod( 'fixed_header_button_border_hover_color', '' );
		if( empty( $fixed_header_button_border_hover_color ) ){
			$fixed_header_button_border_hover_color = $general_button_border_hover_color;
		}
		$css .= '
			.fixed-header .button-primary:hover,
			.fixed-header .button-primary:focus {
				background-color: '. esc_attr( $fixed_header_button_text_hover_color ) .';
				border-color: '. esc_attr( $fixed_header_button_background_hover_color ) .';
				color: '. esc_attr( $fixed_header_button_border_hover_color ) .';
			}
		';

		#Fixed Header Cat Menu Button
		$fixed_header_cat_menu_bg_color 		= get_theme_mod( 'fixed_header_cat_menu_bg_color', '' );
		$fixed_header_cat_menu_border_color 	= get_theme_mod( 'fixed_header_cat_menu_border_color', '' );
		$fixed_header_cat_menu_text_color 	    = get_theme_mod( 'fixed_header_cat_menu_text_color', '' );
		$css .='
			.fixed-header .header-category-nav .navbar-nav > li > a {
				background-color: '. esc_attr( $fixed_header_cat_menu_bg_color ) .';
				border-color: '. esc_attr( $fixed_header_cat_menu_border_color ) .';
				color: '. esc_attr( $fixed_header_cat_menu_text_color ) .';
			}
			.fixed-header .header-category-nav .navbar-nav > li > a svg path {
				fill: '. esc_attr( $fixed_header_cat_menu_text_color ) .';
			}
		';

		$fixed_header_cat_menu_text_hover_color 	= get_theme_mod( 'fixed_header_cat_menu_text_hover_color', '' );
		if( empty( $fixed_header_cat_menu_text_hover_color ) ){
			$fixed_header_cat_menu_text_hover_color = $general_button_text_hover_color;
		}
		$fixed_header_cat_menu_background_hover_color 	= get_theme_mod( 'fixed_header_cat_menu_background_hover_color', '' );
		if( empty( $fixed_header_cat_menu_background_hover_color ) ){
			$fixed_header_cat_menu_background_hover_color = $general_button_bg_hover_color;
		}
		$fixed_header_cat_menu_border_hover_color 	= get_theme_mod( 'fixed_header_cat_menu_border_hover_color', '' );
		if( empty( $fixed_header_cat_menu_border_hover_color ) ){
			$fixed_header_cat_menu_border_hover_color = $general_button_border_hover_color;
		}
		$css .='
			.fixed-header .header-category-nav .navbar-nav > li > a:hover,
			.fixed-header .header-category-nav .navbar-nav > li > a:focus {
				background-color: '. esc_attr( $fixed_header_cat_menu_text_hover_color ) .';
				border-color: '. esc_attr( $fixed_header_cat_menu_background_hover_color ) .';
				color: '. esc_attr( $fixed_header_cat_menu_border_hover_color ) .';
			}
			.fixed-header .header-category-nav .navbar-nav > li > a:hover svg path,
			.fixed-header .header-category-nav .navbar-nav > li > a:focus svg path {
				background-color: '. esc_attr( $fixed_header_cat_menu_text_hover_color ) .';
				border-color: '. esc_attr( $fixed_header_cat_menu_background_hover_color ) .';
				color: '. esc_attr( $fixed_header_cat_menu_border_hover_color ) .';
			}
		';

		# Fixed Header Site Title
		#Fixed Header Site Title Height
		$fix_logo_width = get_theme_mod( 'fix_header_logo_width', 270 );
		$css .= '	
			.fixed-header .site-branding > a {
				max-width: '. esc_attr( $fix_logo_width ) .'px;
				overflow: hidden;
				display: inline-block;
			}	
		';
		
		# Top Footer Color
		$top_footer_background_color = get_theme_mod( 'top_footer_background_color', '' );
		$top_footer_widget_title_color = get_theme_mod( 'top_footer_widget_title_color', '#030303' );
		$top_footer_widget_link_color = get_theme_mod( 'top_footer_widget_link_color', '#656565' );
		$top_footer_widget_content_color = get_theme_mod( 'top_footer_widget_content_color', '#656565' );
		$top_footer_widget_link_hover_color = get_theme_mod( 'top_footer_widget_link_hover_color', '#2154ac' );
		$css .= '
			.top-footer {
				background-color: '. esc_attr( $top_footer_background_color ) .';
			}
		';

		$css .= '
			.site-footer h1, 
			.site-footer h2, 
			.site-footer h3, 
			.site-footer h4, 
			.site-footer h5, 
			.site-footer h6,
			.site-footer .product-title {
				color: '. esc_attr( $top_footer_widget_title_color ) .';
			}
		';
		$css .= '
			.site-footer a, 
			.site-footer .widget ul li a,
			.site-footer .widget .tagcloud a,
			.site-footer .post .entry-meta a,
			.site-footer .post .entry-meta a:before {
				color: '. esc_attr( $top_footer_widget_link_color ) .';
			}

			.site-footer,
			.site-footer table th, 
			.site-footer table td,
			.site-footer .widget.widget_calendar table {
				color: '. esc_attr( $top_footer_widget_content_color ) .';
			}

			.site-footer a:hover, 
			.site-footer a:focus, 
			.site-footer a:active, 
			.site-footer .widget ul li a:hover, 
			.site-footer .widget ul li a:focus, 
			.site-footer .widget ul li a:active,
			.site-footer .post .entry-meta a:hover, 
			.site-footer .post .entry-meta a:focus, 
			.site-footer .post .entry-meta a:active,
			.site-footer .post .entry-meta a:hover:before, 
			.site-footer .post .entry-meta a:focus:before, 
			.site-footer .post .entry-meta a:active:before {
				color: '. esc_attr( $top_footer_widget_link_hover_color ) .';
			}

			.site-footer .widget .tagcloud a:hover,
			.site-footer .widget .tagcloud a:focus,
			.site-footer .widget .tagcloud a:active {
				background-color: '. esc_attr( $top_footer_widget_link_hover_color ) .';
				border-color: '. esc_attr( $top_footer_widget_link_hover_color ) .';
				color: #FFFFFF;
			}
		';

		# Bottom Footer Color
		$bottom_footer_background_color = get_theme_mod( 'bottom_footer_background_color', '' );
		$bottom_footer_text_color = get_theme_mod( 'bottom_footer_text_color', '#656565' );
		$bottom_footer_text_link_color = get_theme_mod( 'bottom_footer_text_link_color', '#383838' );
		$bottom_footer_text_link_hover_color = get_theme_mod( 'bottom_footer_text_link_hover_color', '#2154ac' );
		$css .= '
			.bottom-footer {
				background-color: '. esc_attr( $bottom_footer_background_color ) .';
			}
		';

		$css .= '
			.bottom-footer {
				color: '. esc_attr( $bottom_footer_text_color ) .';
			}
		';

		$css .= '
			.site-footer-five .social-profile {
				border-bottom-color: '. esc_attr( hello_shoppable_hex2rgba( $bottom_footer_text_color, 0.1 ) ).';
			}
		';

		$css .= '
			.site-footer .social-profile ul li a {
				background-color: '. esc_attr( hello_shoppable_hex2rgba( $bottom_footer_text_link_color, 0.1 ) ).';
			}
		';

		$css .= '
			.site-footer .footer-menu ul li {
				border-left-color: '. esc_attr( hello_shoppable_hex2rgba( $bottom_footer_text_link_color, 0.2 ) ).';
			}
		';

		$css .= '
			.site-info a, .site-footer .social-profile ul li a, .footer-menu ul li a {
				color: '. esc_attr( $bottom_footer_text_link_color ) .';
			}
		';

		$css .= '
			.site-footer .site-info a:hover, 
			.site-footer .site-info a:focus, 
			.site-footer .site-info a:active, 
			.site-footer .footer-menu ul li a:hover,
			.site-footer .footer-menu ul li a:focus,
			.site-footer .footer-menu ul li a:active {
				color: '. esc_attr( $bottom_footer_text_link_hover_color ) .';
			}
			.site-footer .social-profile ul li a:hover, 
			.site-footer .social-profile ul li a:focus, 
			.site-footer .social-profile ul li a:active {
				background-color: '. esc_attr( $bottom_footer_text_link_hover_color ) .';
			}
		';

		# Responsive
		# Header Responsive Notification Bar
		if( !get_theme_mod( 'mobile_notification_bar', false ) ){
			$css .= '
				@media screen and (max-width: 767px){
					.notification-bar {
		    			display: none;
					}
				}
			';
		}

		# # Header Responsive Sticky Notification Bar
		if( !get_theme_mod( 'sticky_mobile_notification_bar', false ) ){
			$css .= '
				@media screen and (max-width: 781px){
					.notification-bar.mobile-sticky {
		    			position: relative;
		    			top: 0 !important;
					}
				}
			';
		}

		// WooCommerce colors
		// Sale Tag Colors
		$sale_tag_bg_color = get_theme_mod( 'sale_tag_bg_color', '#EB5A3E' );
		$sale_tag_text_color = get_theme_mod( 'sale_tag_text_color', '#ffffff' );
		$css .= '
			body[class*="woocommerce"] span.onsale {
				background-color: '. esc_attr( $sale_tag_bg_color ) .';
				color: '. esc_attr( $sale_tag_text_color ) .';
			}
		';

		// Hero slider overlay
		$hero_slider_overlay_opacity 	= get_theme_mod( 'hero_slider_overlay_opacity', 7 );
		$hero_banner_overlay_opacity 	= get_theme_mod( 'hero_banner_overlay_opacity', 7 );
		$css .= '
			.main-slider-wrap .banner-img .image-overlay {
				background-color: rgba( 255, 255, 255, 0.'. esc_attr( $hero_slider_overlay_opacity ) .'  );
			}
			.main-banner .banner-img .image-overlay {
				background-color: rgba( 255, 255, 255, 0.'. esc_attr( $hero_banner_overlay_opacity ) .'  );
			}
		';

		// footer image overlay opacity
		$footer_image_overlay_opacity 	= get_theme_mod( 'footer_image_overlay_opacity', 7 );
		$css .= '
			.site-footer .site-footer-inner {
				background-color: rgba(255, 255, 255, 0.'. esc_attr( $footer_image_overlay_opacity ) .' );
			}
		';

	}else{
		// Dark mode css
		$css .= '
			/***text-color for dark***/
			body,.site-header .site-description,.header-cat-search-form form button.header-search-button,.widget ul li a,
			.widget ol li a,input[type=text], input[type=email], input[type=url], input[type=password], input[type=search], input[type=number], input[type=tel],
			input[type=range],input[type=date],input[type=month],input[type=week],input[type=time], input[type=datetime],input[type=datetime-local],
			input[type=color],select,textarea,.woocommerce .woocommerce-result-count, .woocommerce .woocommerce-ordering select,.woocommerce ul.products li.product .price,
			.woocommerce div.product p.price,.woocommerce div.product .woocommerce-tabs ul.tabs li a,.amount-cart {
				color: #D5D5D5;
			}
			.main-navigation ul.menu > li > a {
				color: #E5E5E5;
			}
			blockquote,h1,h2,h3,h4,h5,h6,.page-title,.comment-navigation .nav-previous,.comment-navigation .nav-next,.posts-navigation .nav-previous,
			.posts-navigation .nav-next,.post-navigation .nav-previous,.post-navigation .nav-next,.comment-navigation .nav-previous a,
			.comment-navigation .nav-next a,.posts-navigation .nav-previous a,.posts-navigation .nav-next a,.post-navigation .nav-previous a,
			.post-navigation .nav-next a,#back-to-top a,.fixed-header .site-branding .site-title,.site-header .site-branding .site-title,.header-search .search-form .search-button,
			.comments-area .comment-list .comment-author .fn,.woocommerce #reviews #comments ol.commentlist .woocommerce-review__author,
			.widget.widget_search .wp-block-search__label,.woocommerce .woocommerce-cart-form table.cart td.product-name a,
			.product-detail-wrapper .entry-summary .yith-wcwl-add-to-wishlist a,.product-detail-wrapper .entry-summary .compare,
			.product-detail-wrapper .product_meta span,.site-info a,.woocommerce div.product .woocommerce-tabs ul.tabs li.active,.page-numbers {
				color: #FFFFFF;
			}
			.header-navigation ul.menu > li > a,.entry-header .cat-links a,.entry-meta a,.site-header .social-profile ul li a,.site-header .header-text,
			.site-header .header-contact ul li,.comments-area .comment-list .comment-metadata > a,
			.woocommerce #reviews #comments ol.commentlist .woocommerce-review__published-date,.product-detail-wrapper .entry-summary .woocommerce-review-link,
			.product-detail-wrapper .product_meta span span,.product-detail-wrapper .product_meta span a {
				color: #919191;
			}
			.header-icon svg path,.bottom-contact svg path,.woo-header-icon svg path,.fixed-search-icon svg path {
				fill: #D5D5D5;
			}
			/***background-color for dark***/
			body,.comments-area .comment-list .comment-author .avatar,input[type=text],input[type=email],input[type=url],input[type=password],input[type=search], 
			input[type=number],input[type=tel],input[type=range],input[type=date],input[type=month],input[type=week],input[type=time],input[type=datetime], 
			input[type=datetime-local],input[type=color],textarea {
				background-color: #000000;
			}
			.sticky-header.fixed-header {
				background-color: #000000;
				box-shadow: 0 0 20px 0 rgba(255, 255, 255, 0.25)
			}
			.page-head, .inner-banner-wrap .breadcrumb-wrap,.header-cat-search-form form,.banner-img,.bottom-footer,.author-info .author-content-wrap,
			.woocommerce .woocommerce-result-count,.woocommerce .woocommerce-ordering select,
			#back-to-top a,.wrap-ralated-posts .post .entry-content,.header-cart-block:hover ul.site-header-cart {
				background-color: #090909;
			}
			#back-to-top a,.header-cart-block:hover ul.site-header-cart {
				border-color: #090909;
			}
			
			.main-slider-wrap .banner-img .image-overlay,
			.main-banner .banner-img .image-overlay {
				background-color: rgba(9, 9, 9, 0.7);
			}
			.hentry .thumbnail-placeholder svg rect {
				fill: #090909 !important;
			}
			/***header border-color for dark***/
			table,table td,table tr:first-child th ~ td,input[type=text],input[type=email],input[type=url],input[type=password],input[type=search],input[type=number],
			input[type=tel],input[type=range],input[type=date],input[type=month],input[type=week],input[type=time],input[type=datetime],input[type=datetime-local],
			input[type=color],select,textarea,.page-numbers,.site-content.list-post,.top-header,.bottom-header-inner,.comments-area .comment-list .comment-body,
			.woocommerce #reviews #comments ol.commentlist li .comment-text,body.a2a_menu,.woocommerce button.button:disabled,
			.woocommerce button.button:disabled[disabled],.woocommerce .woocommerce-MyAccount-navigation ul li,.woocommerce .woocommerce-form-login,
			.woocommerce div.product .woocommerce-tabs ul.tabs:before,.woocommerce div.product .woocommerce-tabs .panel table,
			.woocommerce div.product .woocommerce-tabs .panel table th,.woocommerce div.product .woocommerce-tabs .panel table td,
			body .select2-container--default .select2-selection--single,.woocommerce .woocommerce-ResetPassword,.woocommerce table.shop_table,
			.woocommerce table.shop_table tbody td,.header-cat-search-form form div,.woocommerce .woocommerce-result-count, .woocommerce .woocommerce-ordering select,
			.site-content .list-post {
				border-color: #222222;
			}
			input[type=text]:focus,input[type=text]:active,input[type=email]:focus,input[type=email]:active,input[type=url]:focus,input[type=url]:active,
			input[type=password]:focus,input[type=password]:active,input[type=search]:focus,input[type=search]:active,input[type=number]:focus,input[type=number]:active,
			input[type=tel]:focus,input[type=tel]:active,input[type=range]:focus,input[type=range]:active,input[type=date]:focus,input[type=date]:active,
			input[type=month]:focus,input[type=month]:active,input[type=week]:focus,input[type=week]:active,input[type=time]:focus,input[type=time]:active,
			input[type=datetime]:focus,input[type=datetime]:active,input[type=datetime-local]:focus,input[type=datetime-local]:active,input[type=color]:focus,
			input[type=color]:active,textarea:focus,textarea:active {
			  	border-color: #ffffff;
			}
			form.wc-block-components-form .wc-block-components-text-input input[type=email],
			form.wc-block-components-form .wc-block-components-text-input input[type=number],
			form.wc-block-components-form .wc-block-components-text-input input[type=tel],
			form.wc-block-components-form .wc-block-components-text-input input[type=text],
			form.wc-block-components-form .wc-block-components-text-input input[type=url],
			form.wc-block-components-text-input input[type=email],
			form.wc-block-components-text-input input[type=number],
			form.wc-block-components-text-input input[type=tel],
			form.wc-block-components-text-input input[type=text],
			form.wc-block-components-text-input input[type=url],
			.wc-block-components-combobox .wc-block-components-combobox-control input.components-combobox-control__input,
			.wc-block-components-form .wc-block-components-combobox .wc-block-components-combobox-control input.components-combobox-control__input {
				background-color: #000000 !important;
				border-color: #222222!important;
				color: #D5D5D5!important;
			}
			.wp-block-latest-comments a {
				box-shadow: inset 0 -1px 0 #222222;
			}
			.wc-block-components-form .wc-block-components-text-input label, 
			.wc-block-components-text-input label,
			.wc-block-components-combobox .wc-block-components-combobox-control label.components-base-control__label,
			.wc-block-components-form .wc-block-components-combobox .wc-block-components-combobox-control label.components-base-control__label {
				color: #D5D5D5!important;
			}
		';

		# Black and White
		if( get_theme_mod( 'enable_image_greyscale', false ) ){
			$css .= '
				.section-banner .slider-layout-one .banner-img,
				.header-image-wrap .header-slide-item,
				.site-footer .site-footer-inner,
				.wrap-coming-maintenance-mode .coming-maintenance-slide-item {
					background-blend-mode: luminosity,normal;
				}
				body.grayscale-mode img {
					filter: grayscale(100%);
					-webkit-filter: grayscale(100%);
				}
				body.grayscale-mode img {
					transition: all 0.4s;
				}
			';
			if( get_theme_mod( 'enable_image_color_on_hover', false ) ){
				$css .= '
					body.grayscale-mode img:hover,
					body.grayscale-mode img:focus {
						filter: grayscale(0);
						-webkit-filter: grayscale(0);
					}
				';
			}
		}

		// Dark Mode Hero slider overlay
		$hero_slider_overlay_opacity 	= get_theme_mod( 'hero_slider_overlay_opacity', 7 );
		$hero_banner_overlay_opacity 	= get_theme_mod( 'hero_banner_overlay_opacity', 7 );
		$css .= '
			.main-slider-wrap .banner-img .image-overlay {
				background-color: rgba( 0, 0, 0, 0.'. esc_attr( $hero_slider_overlay_opacity ) .'  );
			}
			.main-banner .banner-img .image-overlay {
				background-color: rgba( 0, 0, 0, 0.'. esc_attr( $hero_banner_overlay_opacity ) .'  );
			}
		';

		// Dark Mode footer image overlay opacity
		$footer_image_overlay_opacity 	= get_theme_mod( 'footer_image_overlay_opacity', 7 );
		$css .= '
			.site-footer .site-footer-inner {
				background-color: rgba(0, 0, 0, 0.'. esc_attr( $footer_image_overlay_opacity ) .' );
			}
		';
	}
	
	# Header full width
	if( get_theme_mod( 'site_layout', 'default' ) == 'default' || get_theme_mod( 'site_layout', 'default' ) == 'extend' ){
		if(get_theme_mod( 'enable_header_full_width', false )){
			$css .= '
			@media only screen and (min-width: 1200px) {
				.site-header .container,
				.fixed-header .container {
					max-width: 100%;
					width: 100%;
					padding: 0 40px;
				}
			}
			';
		}

		# Bottom Footer full width
		if(get_theme_mod( 'enable_footer_full_width', false )){
			$css .= '
			@media only screen and (min-width: 1200px) {
				.site-footer .bottom-footer .container {
					max-width: 100%;
					width: 100%;
					padding: 0 40px;
				}
			}
			';
		}
	}

	if( !get_theme_mod( 'fixed_header_site_title', true ) ){
		$css .= '
			.site-header.sticky-header .site-branding .site-title {
				display: none;
			}
		';
	}

	if( !get_theme_mod( 'fixed_header_site_tagline', true ) ){
		$css .= '
			.site-header.sticky-header .site-branding .site-description {
				display: none;
			}
		';
	}

	if( !get_theme_mod( 'mobile_fixed_header', false ) ){
		$css .= '
			@media screen and (max-width: 991px){
				.site-header.sticky-header .fixed-header {
				    position: relative;
				}
			}
		';
	}

	# Header Border For Desktop
	if( !get_theme_mod( 'top_header_border', false ) || !get_theme_mod( 'top_header_section', true ) ){
		$css .= '
			@media screen and (min-width: 992px){
				.top-header {
					border-bottom: none !important;
				}
			}
		';
	}

	if( !get_theme_mod( 'mid_header_border', true ) ){
		$css .= '
			@media screen and (min-width: 992px){
				.mid-header {
					border-bottom: none !important;
				}
				.bottom-header-inner {
					border-top: none !important;
				}
			}
		';
	}

	if( !get_theme_mod( 'enable_mobile_header_woo_cat_menu', true ) ){ 
		$css .= '
			@media screen and (max-width: 991px){
				.site-header .header-category-nav {
					display:none!important;
				}
			}
		';
	}

	# Header Border For mobile
	if( !get_theme_mod( 'mobile_top_header_border', true ) ){
		$css .= '
			@media screen and (max-width: 991px){
				.top-header {
					border-bottom: none !important;
				}
			}
		';
	}
	if( !get_theme_mod( 'mobile_mid_header_border', true ) ){
		$css .= '
			@media screen and (max-width: 991px){
				.mid-header,
				.bottom-header,
				.header-one .bottom-header {
					border-bottom: none !important;
				}
			}
		';
	}

	if( !get_theme_mod( 'mobile_woocommerce_compare', true ) || !get_theme_mod( 'woocommerce_compare', true ) ){
		$css .= '
			@media screen and (max-width: 767px){
				.site-header .header-right .header-compare {
					display: none !important;
				}
			}
		';
	}
	if( !get_theme_mod( 'mobile_woocommerce_wishlist', true ) || !get_theme_mod( 'woocommerce_wishlist', true ) ){
		$css .= '
			@media screen and (max-width: 767px){
				.site-header .header-right .header-wishlist {
					display: none !important;
				}
			}
		';
	}
	if( !get_theme_mod( 'mobile_woocommerce_account', true ) || !get_theme_mod( 'woocommerce_account', true ) ){
		$css .= '
			@media screen and (max-width: 767px){
				.site-header .header-right .header-my-account {
					display: none !important;
				}
			}
		';
	}
	if( !get_theme_mod( 'mobile_woocommerce_cart', true ) || !get_theme_mod( 'woocommerce_cart', true ) ){
		$css .= '
			@media screen and (max-width: 767px){
				.site-header .header-right .header-cart {
					display: none !important;
				}
			}
		';
	}

	if( !get_theme_mod( 'enable_mobile_cat_menu_label', true ) ){
		$css .= '
			@media screen and (max-width: 767px){
				.header-category-nav .category-menu-label,
				.header-category-nav .navbar-nav > li > a:after {
					display: none;
				}
			}
		';
	}
	
	# Header Image / Slider
	# Header Image Height
	$header_image_height = get_theme_mod( 'header_image_height', 110 );
	$css .= '
		@media only screen and (min-width: 992px) {
			.site-header:not(.sticky-header) .header-image-wrap {
				height: '. esc_attr( $header_image_height ) .'px;
				width: 100%;
				position: relative;
			}
		}
	';

	# Header Image Sizes
	#Cover Size
	if( get_theme_mod( 'header_image_size', 'cover' ) == 'cover' ){
		$css .= '
			.header-slide-item {
				background-position: center center;
				background-repeat: no-repeat;
				background-size: cover;
			}
		';
	}
	#Repeat Size
	elseif( get_theme_mod( 'header_image_size', 'cover' ) == 'pattern' ){
		$css .= '
			.header-slide-item {
				background-position: center center;
				background-repeat: repeat;
				background-size: inherit;
			}
		';
	}
	#Fit Size
	elseif( get_theme_mod( 'header_image_size', 'cover' ) == 'norepeat' ){
		$css .= '
			.header-slide-item {
				background-position: center center;
				background-repeat: no-repeat;
				background-size: inherit;
			}
		';
	}

	# Header Slider
	if( get_theme_mod( 'header_media_options', 'image' ) == 'slider' ){
		$css .= '
		#customize-control-header_image {
				display: none;
			}
		';
	}

	/* Header cart count color */
	$cart_count_bg_color 	= get_theme_mod( 'cart_count_bg_color', '#EB5A3E' );
	$cart_count_color  		= get_theme_mod( 'cart_count_color', '#ffffff' );
	$css .= '
		.header-cart a.icon-cart span.count {
			background-color: '. esc_attr( $cart_count_bg_color ) .';
		}
		.header-cart a.icon-cart span.count {
			color: '. esc_attr( $cart_count_color ) .';
		}
	';

	# Preloading Animations
	if( get_theme_mod( 'preloader', true ) ){
		#White Color to Fade
		if( get_theme_mod( 'preloader_animation', 'animation_one' ) == 'animation_white' ){
			$css .= '
				#site-preloader {
	    			background-color: #ffffff;
				}
			';
		}
		#Black Color to Fade
		elseif( get_theme_mod( 'preloader_animation', 'animation_one' ) == 'animation_black' ){
			$css .= '
				#site-preloader {
	    			background-color: #000000;
				}
			';
		}
	}

	# Preloader logo and custom image width
	$preloader_custom_image_width = get_theme_mod( 'preloader_custom_image_width', 40 );
	$css .= '
		.preloader-content {
			max-width: '. esc_attr( $preloader_custom_image_width ) .'px;
			overflow: hidden;
			display: inline-block;
		}
	';

	# Main Slider / Image
	#Height
	$main_slider_height = get_theme_mod( 'main_slider_height', 650 );
	$main_banner_height = get_theme_mod( 'main_banner_height', 650 );
	$css .= '
		@media only screen and (min-width: 768px) {
			.slider-layout-one .banner-img {
				min-height: '. esc_attr( $main_slider_height ) .'px;
			}
			.slider-layout-two .slide-item {
				min-height: '. esc_attr( $main_slider_height ) .'px;
			}
			.slider-layout-three .banner-img {
				min-height: '. esc_attr( $main_slider_height ) .'px;
			}
			.main-banner .banner-img {
				min-height: '. esc_attr( $main_banner_height ) .'px;
			}
		}
	';

	#Slider Three column Gap
	$slider_column_space_controls = get_theme_mod( 'slider_column_space_controls', 5 );
	$css .= '
		.section-banner .slider-layout-three .slick-list {
			margin-left: -'. esc_attr( $slider_column_space_controls ) .'px;
			margin-right: -'. esc_attr( $slider_column_space_controls ) .'px;
		}
		.section-banner .slider-layout-three .slide-item {
			margin-left: '. esc_attr( $slider_column_space_controls ) .'px;
			margin-right: '. esc_attr( $slider_column_space_controls ) .'px;
		}
	';

	# Slider
	if ( get_theme_mod( 'main_slider_controls', 'slider' ) == 'slider' ){

		#Image Sizes Slider
		#Cover Size
		if( get_theme_mod( 'main_slider_image_size', 'cover' ) == 'cover' ){
			$css .= '
				.section-banner .banner-img {
					background-position: center center;
					background-repeat: no-repeat;
					background-size: cover;
				}
			';
		}
		#Repeat Size
		elseif( get_theme_mod( 'main_slider_image_size', 'cover' ) == 'pattern' ){
			$css .= '
				.section-banner .banner-img {
					background-position: center center;
					background-repeat: repeat;
					background-size: inherit;
				}
			';
		}
		#Fit Size
		elseif( get_theme_mod( 'main_slider_image_size', 'cover' ) == 'norepeat' ){
			$css .= '
				.section-banner .banner-img {
					background-position: center center;
					background-repeat: no-repeat;
					background-size: inherit;
				}
			';
		}

		#Slider Content Alignment
		if( get_theme_mod( 'banner_slider_content_alignment', 'align-center' ) == 'align-center' ){
			$css .= '
				.section-banner .slider-layout-one .banner-img,
				.section-banner .slider-layout-two .slide-inner,
				.section-banner .slider-layout-three .banner-img {
					-webkit-align-items: center;
		    		-moz-align-items: center;
		    		-ms-align-items: center;
		    		-ms-flex-align: center;
		    		align-items: center;
		    	}
			';
		}elseif( get_theme_mod( 'banner_slider_content_alignment', 'align-center' ) == 'align-top' ) {
			$css .= '
				.section-banner .slider-layout-one .banner-img,
				.section-banner .slider-layout-two .slide-inner,
				.section-banner .slider-layout-three .banner-img {
					-webkit-align-items: flex-start;
		    		-moz-align-items: flex-start;
		    		-ms-align-items: flex-start;
		    		-ms-flex-align: flex-start;
		    		align-items: flex-start;
		    	}
			';
		}elseif( get_theme_mod( 'banner_slider_content_alignment', 'align-center' ) == 'align-bottom' ) {
			$css .= '
				.section-banner .slider-layout-one .banner-img,
				.section-banner .slider-layout-two .slide-inner,
				.section-banner .slider-layout-three .banner-img {
					-webkit-align-items: flex-end;
		    		-moz-align-items: flex-end;
		    		-ms-align-items: flex-end;
		    		-ms-flex-align: flex-end;
		    		align-items: flex-end;
		    	}
			';
		}
	}
	
	# Banner
	elseif( get_theme_mod( 'main_slider_controls', 'slider' ) == 'banner' ){
		#Blog Banner Color 
		$background_color_main_banner	= get_theme_mod( 'background_color_main_banner', '');
		$css .= '
			.section-banner .banner-img .overlay {
				background-color: '. esc_attr( $background_color_main_banner ) .';
			}
		';

		#Image Sizes Banner
		#Cover Size
		if( get_theme_mod( 'main_banner_image_size', 'cover' ) == 'cover' ){
			$css .= '
				.main-banner .banner-img {
					background-position: center center;
					background-repeat: no-repeat;
					background-size: cover;
				}
			';
		}
		#Repeat Size
		elseif( get_theme_mod( 'main_banner_image_size', 'cover' ) == 'pattern' ){
			$css .= '
				.main-banner .banner-img {
					background-position: center center;
					background-repeat: repeat;
					background-size: inherit;
				}
			';
		}
		#Fit Size
		elseif( get_theme_mod( 'main_banner_image_size', 'cover' ) == 'norepeat' ){
			$css .= '
				.main-banner .banner-img {
					background-position: center center;
					background-repeat: no-repeat;
					background-size: inherit;
				}
			';
		}
	}

	# Footer Image Sizes
	#Cover Size
	if( get_theme_mod( 'footer_image_size', 'cover' ) == 'cover' ){
		$css .= '
			.site-footer.has-footer-bg {
				background-position: center center;
				background-repeat: no-repeat;
				background-size: cover;
			}
		';
	}
	#Repeat Size
	elseif( get_theme_mod( 'footer_image_size', 'cover' ) == 'pattern' ){
		$css .= '
			.site-footer.has-footer-bg {
				background-position: center center;
				background-repeat: repeat;
				background-size: inherit;
			}
		';
	}
	#Fit Size
	elseif( get_theme_mod( 'footer_image_size', 'cover' ) == 'norepeat' ){
		$css .= '
			.site-footer.has-footer-bg {
				background-position: center center;
				background-repeat: no-repeat;
				background-size: inherit;
			}
		';
	}

	# Footer Border
	if( get_theme_mod( 'disable_footer_border', false ) ){
		$css .= '
			.site-footer-five .social-profile,
			.site-footer-eight .social-profile {
				border-bottom: none;
			}
		';
	}

	# Social Media Size
	$social_icons_size = get_theme_mod( 'social_icons_size', 15 );
	$css .= '
		.site-footer .social-profile ul li a {
			font-size: '. esc_attr( $social_icons_size ) .'px;
		}
	';

	#Parallax Scrolling
	if( get_theme_mod( 'footer_parallax_scrolling', false ) ){
		$css .= '
		.site-footer.has-footer-bg {
				background-position: center center;
				background-attachment: fixed;
			}
		';
	}
	
	#Global Layouts
	if( get_theme_mod( 'site_layout', 'default' ) == 'box' || get_theme_mod( 'site_layout', 'default' ) == 'frame' ){
		$box_frame_background_color = get_theme_mod( 'box_frame_background_color', '' );
		$css .= '
			/* Box and Frame */
			.site-layout-box:before, 
			.site-layout-frame:before {
				background-color: '. esc_attr( $box_frame_background_color ) .';
			}
		';
		if( get_theme_mod( 'box_frame_image_size', 'cover' ) == 'cover' ){
			$css .= '
				.site-layout-box,
				.site-layout-frame {
					background-position: center center;
					background-repeat: no-repeat;
					background-size: cover;
				}
			';
		}
		elseif( get_theme_mod( 'box_frame_image_size', 'cover' ) == 'pattern' ){
			$css .= '
				.site-layout-box,
				.site-layout-frame {
					background-position: center center;
					background-repeat: repeat;
					background-size: inherit;
				}
			';
		}
		elseif( get_theme_mod( 'box_frame_image_size', 'cover' ) == 'norepeat' ){
			$css .= '
				.site-layout-box,
				.site-layout-frame {
					background-position: center center;
					background-repeat: no-repeat;
					background-size: inherit;
				}
			';
		}
	}

	if( !get_theme_mod( 'site_layout_shadow', true ) ){
		$css .= '
			.site-layout-box .site, .site-layout-frame .site {
    			box-shadow: none;
			}
		';
	}

    #Blog Page Radius
    $latest_posts_radius = get_theme_mod( 'latest_posts_radius', 0 );
    $css .= '
    	#primary article .featured-image a {
    		border-radius: '. esc_attr( $latest_posts_radius ) .'px;
    	}
    	#primary article .featured-image a { 
    		border-radius: 0px;
    	}
    	#primary article.sticky .featured-image a { 
    		border-radius: 0px;
    	}
    	article.sticky {
    		border-radius: '. esc_attr( $latest_posts_radius ) .'px;
    	}
    ';

	# Blog Homepage

	# Responsive

	# Responsive Footer Social Icons 
	if( !get_theme_mod( 'mobile_social_icons_footer', true ) ){
		$css .= '
			@media screen and (max-width: 991px){
				.site-footer .social-profile {
	    			display: none;
				}
			}
		';
	}


	# Responsive Main Slider / Banner
	if( !get_theme_mod( 'mobile_main_slider', true ) ){
		$css .= '
			@media screen and (max-width: 767px){
				.section-banner {
	    			display: none;
				}
			}
		';
	}

	# Responsive Latest Posts
	if( !get_theme_mod( 'enable_mobile_latest_posts', true ) ){
		$css .= '
			@media screen and (max-width: 767px){
				.section-post-area {
	    			display: none;
				}
			}
		';
	}

	# Responsive Advertisement Banner
	if( !get_theme_mod( 'enable_mobile_advertisement_banner', false ) ){
		$css .= '
			@media screen and (max-width: 767px){
				.section-advert {
	    			display: none;
				}
			}
		';
	}

	#Bottom Footer image width
	$bottom_footer_image_width = get_theme_mod( 'bottom_footer_image_width', 270 );
	$css .= '
		.bottom-footer-image-wrap > a {
			max-width: '. esc_attr( $bottom_footer_image_width ) .'px;
			overflow: hidden;
			display: inline-block;
		}
	';

	# Responsive Footer Widget
	if( !get_theme_mod( 'responsive_footer_widget', true ) ){
		$css .= '
			@media screen and (max-width: 767px){
				.top-footer {
	    			display: none;
				}
			}
		';
	}

	# Responsive Scroll to Top
	if( !get_theme_mod( 'mobile_scroll_top', false ) ){
		$css .= '
			@media screen and (max-width: 767px){
				#back-to-top {
	    			display: none !important;
				}
			}
		';
	}

	# Sidebar Border
	if( !get_theme_mod( 'sidebar_widget_title_border', true ) ){
		$css .= '
			.sidebar .widget .widget-title::before,
			.sidebar .widget .widget-title::after{
	    		display: none;
			}
		';
	}

	// woocommerce option styles

	// woocommerce product card styles
	$product_card_style = get_theme_mod( 'woocommerce_product_card_style', 'card_style_one' );
	// Product image and card radius
	$shop_product_image_radius 	= get_theme_mod( 'shop_product_image_radius', 0 );
	$shop_product_card_radius 	= get_theme_mod( 'shop_product_card_radius', 0 );
	if( $product_card_style == 'card_style_one' ){
		$css .= '
			.products li.product .woo-product-image img {
				border-radius: '. esc_attr( $shop_product_image_radius ) .'px;
			}
		';
	}if( $product_card_style == 'card_style_two' ){
		$css .= '
			.product .product-inner {
				border: 1px solid #e6e6e6;
				padding: 15px;
			}
			.product .product-inner {
				border-radius: '. esc_attr( $shop_product_card_radius ) .'px;
				overflow: hidden
			}
			.products li.product .woo-product-image img {
				border-radius: '. esc_attr( $shop_product_image_radius ) .'px;
			}
		';
	}elseif( $product_card_style == 'card_style_three' ){
		$css .= '
			.product .product-inner {
				border: 1px solid #e6e6e6;
			}
			.product .product-inner .product-inner-contents {
				padding: 0 20px 20px;
			}
			.product .product-inner {
				border-radius: '. esc_attr( $shop_product_card_radius ) .'px;
				overflow: hidden;
			}
		';
	}

	// Add to cart layout four diagonal spacing
	$cart_four_diagonal_spacing = get_theme_mod( 'cart_four_diagonal_spacing', 10 );
	$css .= '
		body[class*=woocommerce] ul.products li.product .button-cart_button_three {
		    left: '. esc_attr( $cart_four_diagonal_spacing ) .'px;
		    bottom: '. esc_attr( $cart_four_diagonal_spacing ) .'px;
		}
	';

	// Sale Tag Layout
	$sale_tag_layout = get_theme_mod( 'woocommerce_sale_tag_layout', 'sale_tag_layout_one' );
	// Sale Button diagonal spacing
	$sale_button_diagonal_spacing = get_theme_mod( 'sale_button_diagonal_spacing', 8 );

	if( $sale_tag_layout == 'sale_tag_layout_one' ){
		$css .= '
			body[class*="woocommerce"] ul.products li.product .onsale {
				top: '. esc_attr( $sale_button_diagonal_spacing ) .'px;
				right: '. esc_attr( $sale_button_diagonal_spacing ) .'px;
			}
		';
	}elseif( $sale_tag_layout == 'sale_tag_layout_two' ){
		$css .= '
			body[class*="woocommerce"] ul.products li.product .onsale {
				top: '. esc_attr( $sale_button_diagonal_spacing ) .'px;
				left: '. esc_attr( $sale_button_diagonal_spacing ) .'px;
				right: auto;
			}
		';
	}

	$sale_button_border_radius = get_theme_mod( 'sale_button_border_radius', 0 );
	$css .= '
		body[class*="woocommerce"] span.onsale {
			border-radius: '. esc_attr( $sale_button_border_radius ) .'px;
		}
	';

	// Single Products
	$enable_single_product_sku = get_theme_mod( 'enable_single_product_sku', true );
	$enable_single_product_category = get_theme_mod( 'enable_single_product_category', true );
	$enable_single_product_tags = get_theme_mod( 'enable_single_product_tags', true );

    if( !$enable_single_product_sku ){
        $css .= '
			.single-product .product_meta .sku_wrapper {
				display: none !important;
			}
		';
    }
    if( !$enable_single_product_category ){
        $css .= '
			.single-product .product_meta .posted_in {
				display: none !important;
			}
		';
    }

    if( !$enable_single_product_tags ){
        $css .= '
			.single-product .product_meta .tagged_as {
				display: none !important;
			}
		';
    }

    // disable single product border
    if( !$enable_single_product_sku && !$enable_single_product_category && !$enable_single_product_tags ){
    	$css .= '
			body[class*=woocommerce] .product_meta {
				border-top: none;
				padding-top: 0;
			}
		';
    }

    // Single product page title container
    if ( !get_theme_mod( 'enable_single_product_title', true ) && ( !get_theme_mod( 'enable_single_product_breadcrumbs', true ) || get_theme_mod( 'woocommerce_breadcrumbs_controls', 'disable_in_all_page_post' ) == 'disable_in_all_page_post' ) ){
    	$css .= '
			.single-product .page-head {
				display: none!important;
			}
		';
    }

    // Shop page title container
    if ( !get_theme_mod( 'enable_shop_page_title', true ) && get_theme_mod( 'woocommerce_breadcrumbs_controls', 'disable_in_all_page_post' ) == 'disable_in_all_page_post' ){
    	$css .= '
			.woocommerce-shop .page-head {
				display: none!important;
			}
		';
    }

    // icon group
    $css .= '
    
	';

	$woocommerce_product_card_text_alignment 	= get_theme_mod( 'woocommerce_product_card_text_alignment', 'center' );
	$css .= '
		.woocommerce ul.products li.product .product-inner {
			text-align: '. esc_attr( $woocommerce_product_card_text_alignment ) .';
		}
	';

	// End Style
	$css .= '</style>';
	?>
	<?php if( get_theme_mod( 'site_layout', 'default' ) == 'box' || get_theme_mod( 'site_layout', 'default' ) == 'frame' ){ ?>
		<style type="text/css">
		    .site-layout-frame,
		    .site-layout-box { background-image: url('<?php echo esc_url( wp_get_attachment_url( get_theme_mod( 'box_frame_background_image', '' ) ) ); ?>'); }
		</style>
	<?php } ?>
	<?php

	// return generated & compressed CSS
	echo str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $css); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}
add_action( 'wp_head', 'hello_shoppable_default_styles' );