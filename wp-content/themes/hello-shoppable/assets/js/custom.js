;(function( $ ){

/**
* Setting up functionality for slick navigation
*/
function slickNavHeight (){
  var headerHeight = $( '.site-header-primary .main-header' ).outerHeight();
  var headerHeight = $( '.site-header-two' ).outerHeight();
  $('.slicknav_nav').css( 'top', headerHeight );
}

/**
* Setting up functionality for alternative menu
*/
function wpMenuAccordion( selector ){
  var $ele = selector + ' .header-navigation .menu-item-has-children > a';
  $( $ele ).each( function(){
    var text = $( this ).text();
    text = text + '<button class="fas fa-plus submenu-icon"></button>';
    $( this ).html( text );
  });

  jQuery( document ).on( 'click', $ele + ' .submenu-icon', function( e ){
    e.preventDefault();
    e.stopPropagation();
    $parentLi = $( this ).parent().parent( 'li' );
    $childLi = $parentLi.find( 'li' );

    if( $parentLi.hasClass( 'open' ) ){
      /**
      * Closing all the ul inside and 
      * removing open class for all the li's
      */
      $parentLi.removeClass( 'open' );
      $childLi.removeClass( 'open' );
      $( this ).parent( 'a' ).next().slideUp();
      $( this ).parent( 'a' ).next().find( 'ul' ).slideUp();
    }else{
      $parentLi.addClass( 'open' );
      $( this ).parent( 'a' ).next().slideDown();
    }
  });
};

/**
* Setting up functionality for fixed header
*/

$mastheadHeight = $( '#masthead.site-header' ).height();
$stickymastheadHeight = $( '.overlay-header #masthead' ).height();

function fixed_header(){
  $notificationHight = $( '.notification-bar' ).height();
  var width = $( window ).width();

  if ( $mastheadHeight > $( window ).scrollTop() || $( window ).scrollTop() == 0 ) {
    $( '.fixed-header' ).hide();
      if ( HELLOSHOPPABLE.fixed_nav && $( '.fixed-header' ).hasClass( 'sticky-header' )){
          $( '.fixed-header' ).removeClass( 'sticky-header' );
          if( HELLOSHOPPABLE.fixed_notification ){
            $( '.fixed-header' ).css( 'marginTop' , 0 );
          }
          // Fixed header in admin bar
          if( HELLOSHOPPABLE.is_admin_bar_showing && width >= 782 ){
            $( '.fixed-header' ).css( 'marginTop', 0 );
          }
          if( HELLOSHOPPABLE.is_admin_bar_showing && width <= 781 ){
            $( '.fixed-header' ).css( 'marginTop', 0 );
          }
      }
  }else if ( HELLOSHOPPABLE.fixed_nav && !$( '.fixed-header' ).hasClass( 'sticky-header' )){
    $( '.fixed-header' ).show();
    if( !HELLOSHOPPABLE.mobile_fixed_nav_off || width >= 782 ){
      $( '.fixed-header' ).addClass( 'sticky-header' ).fadeIn();
    }
    if( HELLOSHOPPABLE.fixed_notification ){
      $( '.fixed-header' ).css( 'marginTop' , $notificationHight );
    }

    // Fixed header in admin bar
    if( HELLOSHOPPABLE.is_admin_bar_showing && width >= 782 ){
      $( '.fixed-header' ).css( 'marginTop', 32 );
    }
    if( HELLOSHOPPABLE.is_admin_bar_showing && width <= 781 ){
      $( '.fixed-header' ).css( 'marginTop', 46 );
    }
    if( HELLOSHOPPABLE.is_admin_bar_showing && width <= 600 ){
      $( '.fixed-header' ).css( 'marginTop', 0 );
    }

    // Fixed header and fixed notification in admin bar
    if( HELLOSHOPPABLE.fixed_notification && HELLOSHOPPABLE.is_admin_bar_showing && width >= 782 ){
      $( '.fixed-header' ).css( 'marginTop', $notificationHight + 32 );
    }
    if( HELLOSHOPPABLE.fixed_notification && HELLOSHOPPABLE.is_admin_bar_showing && width <= 781 ){
      $( '.fixed-header' ).css( 'marginTop', $notificationHight + 46 );
    }
    if( !HELLOSHOPPABLE.mobile_sticky_notification && width <= 781 ){
      $( '.fixed-header' ).css( 'marginTop', 0 );
    }
    if( !HELLOSHOPPABLE.mobile_sticky_notification && HELLOSHOPPABLE.is_admin_bar_showing && width <= 781 ){
      $( '.fixed-header' ).css( 'marginTop', 46 );
    }
    if( HELLOSHOPPABLE.fixed_notification && HELLOSHOPPABLE.is_admin_bar_showing && width <= 600 ){
      $( '.fixed-header' ).css( 'marginTop', $notificationHight );
    }
    if( !HELLOSHOPPABLE.mobile_sticky_notification && width <= 600 ){
      $( '.fixed-header' ).css( 'marginTop', 0 );
    }
    if( HELLOSHOPPABLE.mobile_fixed_nav_off && width <= 781 ){
      $( '.fixed-header' ).css( 'marginTop', 0 );
    }
  }
}

/**
* Setting up functionality for notification bar
*/
function is_user_logged() {
  
  var width = $( window ).width();
  $notificationHight = $( '.notification-bar' ).outerHeight();

  if( HELLOSHOPPABLE.is_admin_bar_showing ){
    // desktop - 32px
    if( width >= 782 ){
      if( HELLOSHOPPABLE.fixed_notification ) {
        $( '.notification-bar' ).css( 'top', 32 );
      }
    }

    // mobile with fixed admin bar - 46px
    if( width <= 781 ){
      if( HELLOSHOPPABLE.fixed_notification ) {
        $( '.notification-bar' ).css( 'top', 46 );
      }
      if( HELLOSHOPPABLE.fixed_notification && !HELLOSHOPPABLE.mobile_notification ){
        $( '.notification-bar' ).css( 'top', 0 );
      }
    }

    // mobile with absolute admin bar - 46px
    if( width <= 600 ){
      if( HELLOSHOPPABLE.fixed_notification ) {
        $( '.notification-bar' ).css( 'top', 0 );
      }
    }
  }
}

/**
* Setting up functionality for header two - transparent header
*/
function transparent_header_noti_bar() {
  $notificationHight = $( '.notification-bar' ).height();
  var width = $( window ).width();

  if ( $( 'body' ).hasClass( 'overlay-header' ) ) {
    if( HELLOSHOPPABLE.fixed_notification && HELLOSHOPPABLE.is_admin_bar_showing && width >= 782 ){
      $( '.notification-bar' ).css({ top : 32 });
      $( '.overlay-header .site-header' ).css( 'top' , $notificationHight );
    }else if( HELLOSHOPPABLE.fixed_notification && width >= 782 ){
      $( '.overlay-header .site-header' ).css( 'top' , $notificationHight );
    }else if( !HELLOSHOPPABLE.fixed_notification && HELLOSHOPPABLE.is_admin_bar_showing && width >= 782 ){
      $( '.overlay-header .site-header' ).css( 'top' , $notificationHight );
    }else if( !HELLOSHOPPABLE.fixed_notification && !HELLOSHOPPABLE.is_admin_bar_showing && width >= 782 ){
      $( '.overlay-header .site-header' ).css( 'top' , $notificationHight );
    }else if( !HELLOSHOPPABLE.mobile_notification && HELLOSHOPPABLE.is_admin_bar_showing && width <= 782 ){
      $( '.overlay-header .site-header' ).css( 'top' , 0 );
    }else if( HELLOSHOPPABLE.mobile_notification && HELLOSHOPPABLE.is_admin_bar_showing && width <= 782 ){
      $( '.overlay-header .site-header' ).css( 'top' , $notificationHight );
    }else if( !HELLOSHOPPABLE.mobile_notification && width <= 768 ){
      $( '.overlay-header .site-header' ).css( 'top' , 0 );
    }else if( HELLOSHOPPABLE.mobile_notification && width <= 768 ){
      $( '.overlay-header .site-header' ).css( 'top' , $notificationHight );
    }
  }
}

/**
* Setting up call functions
*/
// Document ready
jQuery( document ).ready( function() {
  slickNavHeight();
  is_user_logged();
  transparent_header_noti_bar();
  wpMenuAccordion( '#offcanvas-menu' );

// Toggle Nav on Click
    jQuery( document ).on( 'click','#popuplogin', function(){
    if ($('body').hasClass('show-popup-login')) {
      // Do things on Nav Close
      $('body').removeClass('show-popup-login');
    } else {
      // Do things on Nav Open
      $('body').addClass('show-popup-login');
    }
  });
  $('.login-canvas-toggle-nav').click(function () {
    $('body').removeClass('show-popup-login');
  });

/**
  * Offcanvas Menu
  */
  $( document ).on( 'click', '.offcanvas-menu-toggler, .close-offcanvas-menu button, .offcanvas-overlay', function( e ){
    e.preventDefault();
    $( 'body' ).toggleClass( 'offcanvas-slide-open' );
    setTimeout(function(){
      $( '.close-offcanvas-menu button' ).focus();
    }, 40);
  });
  $( '.close-offcanvas-menu button' ).click( function(){
    setTimeout(function(){
      $( '.offcanvas-menu-toggler' ).focus();
    }, 50);
  });

  jQuery( 'body' ).append( '<div class="offcanvas-overlay"></div>' );

  /**
  * Desktop Hamburger Nav on focus out event
  */
   jQuery( '.offcanvas-menu-wrap .offcanvas-menu-inner' ).on( 'focusout', function () {
     var $elem = jQuery( this );
     // let the browser set focus on the newly clicked elem before check
     setTimeout(function () {
       if ( ! $elem.find( ':focus' ).length ) {
         jQuery( '.offcanvas-menu-toggler' ).trigger( 'click' );
         $( '.offcanvas-menu-toggler' ).focus();
       }
     }, 0);
   });

  /**
   * Header Search from
  */
  jQuery( document ).on( 'click','.search-icon, .close-button', function(){
    $( '.header-search' ).toggleClass("search-in");
    $( '.header-search input' ).focus();
  });

  // search toggle on focus out event
  jQuery( '.header-search form' ).on( 'focusout', function () {
    var $elem = jQuery(this);
      // let the browser set focus on the newly clicked elem before check
      setTimeout(function () {
          if ( ! $elem.find( ':focus' ).length ) {
            jQuery( '.search-icon' ).trigger( 'click' );
            $( '.search-icon' ).focus();
          }
      }, 0);
  });

  jQuery( document ).on( 'click','.fixed-search-icon, .fixed-close-button', function(){
    $( '.fixed-header-search' ).toggleClass("search-in");
    $( '.fixed-header-search input' ).focus();
  });

  jQuery( '.fixed-header-search form' ).on( 'focusout', function () {
    var $elem = jQuery(this);
      // let the browser set focus on the newly clicked elem before check
      setTimeout(function () {
          if ( ! $elem.find( ':focus' ).length ) {
            jQuery( '.fixed-search-icon' ).trigger( 'click' );
            $( '.fixed-search-icon' ).focus();
          }
      }, 0);
  });

  /**
  * Header image slider
  */
  $( '.header-image-slider' ).slick({
      dots: true,
      arrows: true,
      adaptiveHeight: false,
      fade: HELLOSHOPPABLE.header_image_slider.fade,
      speed: parseInt( HELLOSHOPPABLE.header_image_slider.fadeControl ),
      cssEase: 'linear',
      autoplay: HELLOSHOPPABLE.header_image_slider.autoplay,
      autoplaySpeed: HELLOSHOPPABLE.header_image_slider.autoplaySpeed,
      infinite: true,
      prevArrow: $( '.header-slider-prev' ),
      nextArrow: $( '.header-slider-next' ),
      rows: 0,
      appendDots: $( '.header-slider-dots' ),
    });
  $( '.header-image-slider' ).attr( 'dir', 'ltr' );

  /**
  * Slick navigation
  */
  $( '#primary-menu' ).slicknav({
      duration: 500,
      closedSymbol: '<i class="fa fa-plus"></i>',
      openedSymbol: '<i class="fa fa-minus"></i>',
      appendTo: '.mobile-menu-container',
      allowParentLinks: true,
      nestedParentLinks : false,
      label: HELLOSHOPPABLE.responsive_header_menu_text,
      closeOnClick: true, // Close menu when a link is clicked.
  });

  /**
  * Slick navigation For Fixed Header
  */
  $('#fixed-primary-menu').slicknav({
    openedSymbol: '<i class="fa fa-minus"></i>',
    closedSymbol: '<i class="fa fa-plus"></i>',
    appendTo: '.fixed-menu-container',
    allowParentLinks: true,
    nestedParentLinks : false,
    label: HELLOSHOPPABLE.responsive_header_menu_text,
    closeOnClick: true, // Close menu when a link is clicked.
  });
  
  /**
  * Slick navigation mobile on focus out event
  */
  jQuery( '.slicknav_menu .slicknav_nav' ).on( 'focusout', function () {
    var $elem = jQuery(this);
    // let the browser set focus on the newly clicked elem before check
    setTimeout(function () {
      if ( ! $elem.find( ':focus' ).length ) {
        jQuery( '.slicknav_open' ).trigger( 'click' );
      }
    }, 0);
  });

  /**
  * transparent header banner content
  */
  if ( $( 'body' ).hasClass( 'overlay-header' ) ) {
    $( '.section-banner .banner-content' ).css( 'marginTop' , $stickymastheadHeight );
  }

  /**
  * Main posts slider
  */
  $( '.main-slider' ).slick({
      dots: true,
      arrows: true,
      adaptiveHeight: false,
      fade: HELLOSHOPPABLE.main_slider.fade,
      speed: parseInt( HELLOSHOPPABLE.main_slider.fadeControl ),
      cssEase: 'linear',
      autoplay: HELLOSHOPPABLE.main_slider.autoplay,
      autoplaySpeed: HELLOSHOPPABLE.main_slider.autoplaySpeed,
      infinite: true,
      prevArrow: $( '.main-slider-prev' ),
      nextArrow: $( '.main-slider-next' ),
      rows: 0,
      appendDots: $( '.main-slider-dots' ),
    });
  $( '.main-slider' ).attr( 'dir', 'ltr' );

  $( '.main-slider-layout-three' ).slick({
      dots: true,
      arrows: true,
      adaptiveHeight: false,
      speed: parseInt( HELLOSHOPPABLE.main_slider.fadeControl ),
      cssEase: 'linear',
      autoplay: HELLOSHOPPABLE.main_slider.autoplay,
      autoplaySpeed: HELLOSHOPPABLE.main_slider.autoplaySpeed,
      infinite: true,
      prevArrow: $( '.main-slider-prev' ),
      nextArrow: $( '.main-slider-next' ),
      rows: 0,
      appendDots: $( '.main-slider-dots' ),
      slidesToShow: HELLOSHOPPABLE.main_slider.slidesToShow,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
      ]
    });
  $( '.main-slider-layout-three' ).attr( 'dir', 'ltr' );

  /**
  * Sticky sidebar
  */
  if( HELLOSHOPPABLE.woo_sticky_sidebar || HELLOSHOPPABLE.sticky_sidebar ){
    var fixedHeight = 50;
    if( HELLOSHOPPABLE.fixed_nav ){
      fixedHeight = fixedHeight + $( '.fixed-header' ).height() + 20;
    }
    if( HELLOSHOPPABLE.fixed_notification && HELLOSHOPPABLE.notification_bar ){
      fixedHeight = fixedHeight + $( '.notification-bar' ).height();
    }
    $( '.content-area, .sticky-sidebar' ).theiaStickySidebar({
      // Settings
      additionalMarginTop: fixedHeight,
    });
  }

  /**
  * Back to top
  */
  jQuery( document ).on( 'click', '#back-to-top a', function() {
      $( 'html, body' ).animate({ scrollTop: 0 }, 800);
      return false;
  });

}); // closing document ready

// Window resize
jQuery( window ).on( 'resize', function(){
  slickNavHeight();
  is_user_logged();
  transparent_header_noti_bar();
  fixed_header();
  // mobile_fixed_header_notification();
});

// Window load
jQuery( window ).on( 'load', function(){
  /**
  * Site Preloader
  */
  $( '#site-preloader' ).fadeOut( 500 );

  /**
  * Back to top
  */
  if( HELLOSHOPPABLE.enable_scroll_top == true && $(window).scrollTop() > 200 ){
    $( '#back-to-top' ).fadeIn( 200 );
  } else{
    $( '#back-to-top' ).fadeOut( 200 );
  }

  /**
  * Masonry wrapper
  */
  if( jQuery( '.masonry-wrapper' ).length > 0 ){
    $grid = jQuery( '.masonry-wrapper' ).masonry({
      itemSelector: '.grid-post',
      // percentPosition: true,
      isAnimated: true,
    }); 
  }

  /**
  * Jetpack's infinite scroll on masonry layout
  */
  infinite_count = 0;
    $( document.body ).on( 'post-load', function () {

    infinite_count = infinite_count + 1;
    var container = '#infinite-view-' + infinite_count;
    $( container ).hide();

    $( $( container + ' .grid-post' ) ).each( function(){
      $items = $( this );
        $grid.append( $items ).masonry( 'appended', $items );
    });

    setTimeout( function(){
      $grid.masonry( 'layout' );
    },500);
    });

}); // closing window load

// Window scroll
jQuery( window ).on( 'scroll', function(){
  fixed_header();
  // mobile_fixed_header_notification();

  /**
  * Back to top
  */
  if( HELLOSHOPPABLE.scroll_top == true && $(window).scrollTop() > 200 ){
    $( '#back-to-top' ).fadeIn( 200 );
  } else{
    $( '#back-to-top' ).fadeOut( 200 );
  }
}); // closing window scroll

})( jQuery );