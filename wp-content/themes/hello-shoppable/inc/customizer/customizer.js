/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	wp.customize( 'logo_width', function( value ) {
		value.bind( function( to ) {
			$( '.site-header .site-branding > a' ).css( "max-width", to + 'px' );
		} );
	} );

	wp.customize( 'fix_header_logo_width', function( value ) {
		value.bind( function( to ) {
			$( '.fixed-header .site-branding > a' ).css( "max-width", to + 'px' );
		} );
	} );

	// Pre-loader image width
	wp.customize( 'preloader_custom_image_width', function( value ) {
		value.bind( function( to ) {
			$( '.preloader-content' ).css( "max-width", to + 'px' );
		} );
	} );

	// Header image height
	wp.customize( 'header_image_height', function( value ) {
	    value.bind( function( to ) {
	        $( ".header-image-wrap" ).css( "height", to + 'px' );
	    } );
	} );

	// Notification bar text
	wp.customize( 'notification_bar_title', function( value ) {
		value.bind( function( to ) {
			$( '.notification-bar .notification-content span' ).text( to );
		} );
	} );

	// Notification bar image height
	wp.customize( 'notification_bar_image_height', function( value ) {
	    value.bind( function( to ) {
	        $( ".notification-bar" ).css( "height", to + 'px' );
	    } );
	} );

	// footer social icon size
	wp.customize( 'social_icons_size', function( value ) {
	    value.bind( function( to ) {
	        $( ".site-footer .social-profile ul li a" ).css( "font-size", to + 'px' );
	    } );
	} );

	// Main slider / image height
	wp.customize( 'main_slider_height', function( value ) {
	    value.bind( function( to ) {
	        $( ".slider-layout-one .banner-img" ).css( "height", to + 'px' );
	        $( ".slider-layout-two .slide-item" ).css( "height", to + 'px' );
	        $( ".slider-layout-three .banner-img" ).css( "height", to + 'px' );
	    } );
	} );

	// Main banner height
	wp.customize( 'main_banner_height', function( value ) {
	    value.bind( function( to ) {
	        $( ".main-banner .banner-img" ).css( "height", to + 'px' );
	    } );
	} );

	// Main slider Three / spacing
	wp.customize( 'slider_column_space_controls', function( value ) {
	    value.bind( function( to ) {
	        $( ".section-banner .slider-layout-three .slick-list" ).css( "margin-left", '-' + to + 'px' );
	        $( ".section-banner .slider-layout-three .slick-list" ).css( "margin-right", '-' + to + 'px' );
	        $( ".section-banner .slider-layout-three .slide-item" ).css( "margin-left", to + 'px' );
	        $( ".section-banner .slider-layout-three .slide-item" ).css( "margin-right", to + 'px' );
	    } );
	} );

	// Bottom footer image width
	wp.customize( 'bottom_footer_image_width', function( value ) {
		value.bind( function( to ) {
			$( '.bottom-footer-image-wrap > a' ).css( "max-width", to + 'px' );
		} );
	} );

	// Top bar text
	wp.customize( 'top_bar_text', function( value ) {
		value.bind( function( to ) {
			$( '.top-header .header-text .top-title' ).text( to );
		} );
	} );
	wp.customize( 'top_bar_button_text', function( value ) {
		value.bind( function( to ) {
			$( '.top-header .header-text .top-link' ).text( to );
		} );
	} );

	// Contact details
	wp.customize( 'contact_phone', function( value ) {
		value.bind( function( to ) {
			$( '.header-contact ul li .sh-contact-phone' ).text( to );
		} );
	} );

	wp.customize( 'contact_email', function( value ) {
		value.bind( function( to ) {
			$( '.header-contact ul li .sh-contact-email' ).text( to );
		} );
	} );

	wp.customize( 'contact_address', function( value ) {
		value.bind( function( to ) {
			$( '.header-contact ul li .sh-contact-address' ).text( to );
		} );
	} );

	
	// Mid header one contact details
	wp.customize( 'mid_contact_phone_label', function( value ) {
		value.bind( function( to ) {
			$( '.bottom-contact .label' ).text( to );
		} );
	} );

	wp.customize( 'mid_contact_phone_number', function( value ) {
		value.bind( function( to ) {
			$( '.bottom-contact .mid-contact-phone' ).text( to );
		} );
	} );

	// Main banner title and description.
	wp.customize( 'banner_title', function( value ) {
		value.bind( function( to ) {
			$( '.section-banner .entry-title' ).text( to );
		} );
	} );
	wp.customize( 'banner_subtitle', function( value ) {
		value.bind( function( to ) {
			$( '.section-banner .entry-subtitle' ).text( to );
		} );
	} );

	// Latest post section title and description.
	wp.customize( 'latest_posts_section_title', function( value ) {
		value.bind( function( to ) {
			$( '.section-post-area .section-title-wrap .section-title' ).text( to );
		} );
	} );
	wp.customize( 'latest_posts_section_description', function( value ) {
		value.bind( function( to ) {
			$( '.section-post-area .section-title-wrap p' ).text( to );
		} );
	} );

	// About the author title
	wp.customize( 'single_post_author_title', function( value ) {
	    value.bind( function( to ) {
	        $( '.author-info .section-title-wrap .section-title' ).text( to );
	    } );
	} );

	// Related post title
	wp.customize( 'related_posts_title', function( value ) {
	    value.bind( function( to ) {
	        $( '.section-ralated-post .section-title' ).text( to );
	    } );
	} );

	// Maintenance section title and description.
	wp.customize( 'coming_maintenance_title', function( value ) {
		value.bind( function( to ) {
			$( '.wrap-coming-maintenance-mode .section-title' ).text( to );
		} );
	} );
	wp.customize( 'coming_maintenance_content', function( value ) {
		value.bind( function( to ) {
			$( '.wrap-coming-maintenance-mode .maintenance-content h3' ).text( to );
		} );
	} );

	// Blog Post border radius
	wp.customize( 'latest_posts_radius', function( value ) {
	    value.bind( function( to ) {
	    	$( '#primary .grid-post article:not(.sticky) .featured-image a ' ).css( "borderRadius", to + 'px' );
	        $( '#primary article.list-post .featured-image a' ).css( "borderRadius", to + 'px' );
	        $( '#primary article.single-post .featured-image a' ).css( "borderRadius", to + 'px' );
	        $( 'article.sticky' ).css( "borderRadius", to + 'px' );
	        
	    } );
	} );

	// Sale button border radius
	wp.customize( 'sale_button_border_radius', function( value ) {
	    value.bind( function( to ) {
	        $( 'body[class*="woocommerce"] span.onsale' ).css( "borderRadius", to + 'px' );
	    } );
	} );

	// Sale button text
	wp.customize( 'woocommerce_sale_badge_text', function( value ) {
		value.bind( function( to ) {
			$( 'body[class*="woocommerce"] span.onsale' ).text( to );
		} );
	} );

	// product image radius
	wp.customize( 'shop_product_image_radius', function( value ) {
	    value.bind( function( to ) {
	        $( '.products li.product .woo-product-image img' ).css( "borderRadius", to + 'px' );
	    } );
	} );

	// product card border radius
	wp.customize( 'shop_product_card_radius', function( value ) {
	    value.bind( function( to ) {
	        $( '.product .product-inner' ).css( "borderRadius", to + 'px' );
	    } );
	} );

	// Add to cart layout four diagonal spacing
	wp.customize( 'cart_four_diagonal_spacing', function( value ) {
	    value.bind( function( to ) {
	        $( 'body[class*=woocommerce] ul.products li.product .button-cart_button_three' ).css( "left", to + 'px' );
	        $( 'body[class*=woocommerce] ul.products li.product .button-cart_button_three' ).css( "bottom", to + 'px' );
	    } );
	} );

	// Sale Button diagonal spacing
	wp.customize( 'sale_button_diagonal_spacing', function( value ) {
	    value.bind( function( to ) {
	        $( 'body[class*=woocommerce] ul.products li.product .onsale' ).css( "top", to + 'px' );
	        $( 'body[class*=woocommerce] ul.products li.product .onsale' ).css( "right", to + 'px' );
	    } );
	} );

} )( jQuery );