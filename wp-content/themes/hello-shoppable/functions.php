<?php

/**
 * Hello Shoppable functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @since Hello Shoppable 1.0.0
 */

/**
 * Hello Shoppable works in WordPress 5.0 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '5.0', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

/**
 * Hello Shoppable functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Hello Shoppable
 */

if ( ! function_exists( 'hello_shoppable_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function hello_shoppable_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Hello Shoppable, use a find and replace
		 * to change 'hello-shoppable' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'hello-shoppable', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'hello-shoppable' ),
			'menu-3' => esc_html__( 'Secondary', 'hello-shoppable' ),
			'menu-2' => esc_html__( 'Footer', 'hello-shoppable' ),
			'menu-4' => esc_html__( 'Category Menu', 'hello-shoppable' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/**
		 * Add support for Post Formats.
		 *
		 * @link https://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats' , array( 'aside', 'gallery' , 'standard', 'link', 'image' , 'quote', 'status', 'video', 'audio' , 'chat' ));

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'width'       => 270,
			'height'      => 80,
			'flex-height' => true,
			'flex-width'  => true,
		) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for woocommerce.
		add_theme_support( 'woocommerce' );

		// Add custom image size.
		add_image_size( 'hello-shoppable-1920-550', 1920, 550, true );
		add_image_size( 'hello-shoppable-1370-790', 1370, 790, true );
		add_image_size( 'hello-shoppable-1370-550', 1370, 550, true );
		add_image_size( 'hello-shoppable-730-90', 730, 90, true );
		add_image_size( 'hello-shoppable-420-300', 420, 300, true );

		/*
		* This theme styles the visual editor to resemble the theme style,
		* specifically font, colors, icons, and column width.
		*/
		
		add_editor_style( array( '/assets/css/editor-style.min.css') );

		// Gutenberg support
		add_theme_support( 'editor-color-palette', array(
	       	array(
				'name'  => esc_html__( 'Tan', 'hello-shoppable' ),
				'slug'  => 'tan',
				'color' => '#D2B48C',
	       	),
	       	array(
	           	'name'  => esc_html__( 'Yellow', 'hello-shoppable' ),
	           	'slug'  => 'yellow',
	           	'color' => '#FDE64B',
	       	),
	       	array(
	           	'name'  => esc_html__( 'Orange', 'hello-shoppable' ),
	           	'slug'  => 'orange',
	           	'color' => '#ED7014',
	       	),
	       	array(
	           	'name'  => esc_html__( 'Red', 'hello-shoppable' ),
	           	'slug'  => 'red',
	           	'color' => '#D0312D',
	       	),
	       	array(
	           	'name'  => esc_html__( 'Pink', 'hello-shoppable' ),
	           	'slug'  => 'pink',
	           	'color' => '#b565a7',
	       	),
	       	array(
	           	'name'  => esc_html__( 'Purple', 'hello-shoppable' ),
	           	'slug'  => 'purple',
	           	'color' => '#A32CC4',
	       	),
	       	array(
	           	'name'  => esc_html__( 'Blue', 'hello-shoppable' ),
	           	'slug'  => 'blue',
	           	'color' => '#4E97D8',
	       	),
	       	array(
	           	'name'  => esc_html__( 'Green', 'hello-shoppable' ),
	           	'slug'  => 'green',
	           	'color' => '#00B294',
	       	),
	       	array(
	           	'name'  => esc_html__( 'Brown', 'hello-shoppable' ),
	           	'slug'  => 'brown',
	           	'color' => '#231709',
	       	),
	       	array(
	           	'name'  => esc_html__( 'Grey', 'hello-shoppable' ),
	           	'slug'  => 'grey',
	           	'color' => '#7D7D7D',
	       	),
	       	array(
	           	'name'  => esc_html__( 'Black', 'hello-shoppable' ),
	           	'slug'  => 'black',
	           	'color' => '#000000',
	       	),
	   	));

		add_theme_support( 'align-wide' );
		add_theme_support( 'editor-font-sizes', array(
		   	array(
		       	'name'      => esc_html__( 'small', 'hello-shoppable' ),
		       	'shortName' => esc_html__( 'S', 'hello-shoppable' ),
		       	'size'      => 12,
		       	'slug'      => 'small'
		   	),
		   	array(
		       	'name'      => esc_html__( 'regular', 'hello-shoppable' ),
		       	'shortName' => esc_html__( 'M', 'hello-shoppable' ),
		       	'size'      => 16,
		       	'slug'      => 'regular'
		   	),
		   	array(
		       	'name'      => esc_html__( 'larger', 'hello-shoppable' ),
		       	'shortName' => esc_html__( 'L', 'hello-shoppable' ),
		       	'size'      => 36,
		       	'slug'      => 'larger'
		   	),
		   	array(
		       	'name'      => esc_html__( 'huge', 'hello-shoppable' ),
		       	'shortName' => esc_html__( 'XL', 'hello-shoppable' ),
		       	'size'      => 48,
		       	'slug'      => 'huge'
		   	)
		));
		add_theme_support( 'editor-styles' );
		add_theme_support( 'wp-block-styles' );

		/* woocommerce support */
		add_theme_support( 'wc-product-gallery-zoom' );
	    add_theme_support( 'wc-product-gallery-lightbox' );
	    add_theme_support( 'wc-product-gallery-slider' );

	    add_theme_support( 'responsive-embeds' );
	}
endif;
add_action( 'after_setup_theme', 'hello_shoppable_setup' );

/**
 * Enqueue scripts and styles.
 */
function hello_shoppable_scripts() {

	 require_once get_theme_file_path ( 'inc/wptt-webfont-loader.php');

	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap.min.css' );
	if ( is_rtl() ){
		wp_enqueue_style( 'bootstrap-rtl', get_template_directory_uri() . '/assets/bootstrap/css/rtl/bootstrap.min.css' );
	}
	wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/slick/slick.css' );
	wp_enqueue_style( 'slicknav', get_template_directory_uri() . '/assets/css/slicknav.min.css' );
	wp_enqueue_style( 'slick-theme', get_template_directory_uri() . '/assets/slick/slick-theme.css' );
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/font-awesome/css/all.min.css' );
	wp_enqueue_style( 'hello-shoppable-blocks', get_template_directory_uri() . '/assets/css/blocks.min.css' );
	wp_enqueue_style( 'hello-shoppable-style', get_stylesheet_uri() );
	wp_enqueue_style( 'hello-shoppable-google-font', wptt_get_webfont_url( 'https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500;600;800;900&display=swap' ), false );

	$scripts = array(
		array(
			'id'     => 'bootstrap',
			'url'    => get_template_directory_uri() . '/assets/bootstrap/js/bootstrap.min.js',
			'footer' => true
		),
		array(
			'id'     => 'slick',
			'url'    => get_template_directory_uri() . '/assets/slick/slick.min.js',
			'footer' => true
		),
		array(
			'id'     => 'slicknav',
			'url'    => get_template_directory_uri() . '/assets/js/jquery.slicknav.min.js',
			'footer' => true
		),
		array(
			'id'     => 'hello-shoppable-skip-link-focus-fix',
			'url'    => get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js',
			'footer' => true
		),
		array(
			'id'     => 'hello-shoppable-navigation',
			'url'    => get_template_directory_uri() . '/assets/js/navigation.js',
			'footer' => true
		),
		array(
			'id'     => 'theia-sticky-sidebar',
			'url'    => get_template_directory_uri() . '/assets/js/theia-sticky-sidebar.min.js',
			'footer' => true
		),
		array(
			'id'     => 'html5shiv',
			'url'    => get_template_directory_uri() . '/assets/js/html5shiv.min.js',
			'footer' => true
		),
		array(
			'id'     => 'hello-shoppable-custom',
			'url'    => get_template_directory_uri() . '/assets/js/custom.min.js',
			'footer' => true
		)
	);

	hello_shoppable_add_scripts( $scripts );
	
	$locale = array(
		'is_rtl'                                 => is_rtl(),
		'is_admin_bar_showing'                   => is_admin_bar_showing() ? true : false,
		'responsive_header_menu_text'            => esc_html( get_theme_mod( 'responsive_header_menu_text', 'MENU' ) ),
		'header_image_slider' => array(
			'fade'          => absint( get_theme_mod( 'header_slider_effect', 'fade' ) == 'fade' ) ? true : false,
			'autoplay'      => absint( get_theme_mod( 'header_slider_autoplay', false ) ),
			'autoplaySpeed' => absint( get_theme_mod( 'slider_header_autoplay_speed', 4 ) * 1000 ),
			'fadeControl'   => absint( get_theme_mod( 'slider_header_fade_control', 5 ) ) * 100,
		),
		'main_slider' => array(
			'fade'          => absint( get_theme_mod( 'main_slider_effect', 'fade' ) == 'fade' ) ? true : false,
			'autoplay'      => absint( get_theme_mod( 'slider_autoplay', false ) ),
			'autoplaySpeed' => absint( get_theme_mod( 'slider_autoplay_speed', 4 ) * 1000 ),
			'fadeControl'   => absint( get_theme_mod( 'slider_fade_control', 5 ) ) * 100,
			'slidesToShow'  => absint( get_theme_mod( 'slider_column_controls', 2 ) ),
		),
		'fixed_nav'                  => get_theme_mod( 'fixed_header', false ) ? true : false,
		'mobile_fixed_nav_off'       => !get_theme_mod( 'mobile_fixed_header', false ) ? true : false,
		'scroll_top'         		 => get_theme_mod( 'scroll_top', true ),
		'notification_bar'           => get_theme_mod( 'enable_notification_bar', false ),
		'fixed_notification'         => get_theme_mod( 'sticky_notification_bar', false ),
		'mobile_notification'        => get_theme_mod( 'mobile_notification_bar', false ),
		'mobile_sticky_notification' => get_theme_mod( 'sticky_mobile_notification_bar', false ),
		'sticky_sidebar'             => get_theme_mod( 'sticky_sidebar', true ) ? true : false,
		'woo_sticky_sidebar'         => get_theme_mod( 'woo_sticky_sidebar', true ) ? true : false,
		'is_frame_layout'	         => ( get_theme_mod( 'site_layout', 'default' ) == 'frame' ) ? true : false,
	);
	$locale = apply_filters( 'hello_shoppable_localize_var', $locale );
	wp_localize_script( 'hello-shoppable-custom', 'HELLOSHOPPABLE', $locale );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'hello_shoppable_scripts' );

/**
* Add script
* 
* @since Hello Shoppable 1.0.0
*/
function hello_shoppable_add_scripts( $scripts ){
	foreach ( $scripts as $key => $value ) {
		wp_enqueue_script( $value['id'] , $value['url'] , array( 'jquery', 'jquery-masonry' ), 0.8, $value['footer'] );
	}
}

/**
 * Descriptions on Primary Menu
 */
function hello_shoppable_header_menu_desc( $item_output, $item, $depth, $args ){
    if ( 'menu-1' == $args->theme_location && $item->description )
        $item_output = str_replace( '</a>', '<span class="menu-description">' . $item->description . '</span></a>', $item_output );
    return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'hello_shoppable_header_menu_desc', 10, 4 );

/**
* Shoppable: Excerpt
*
* @since Hello Shoppable 1.0.0
*/
if( ! class_exists( 'Hello_Shoppable_Excerpt' ) ):

class Hello_Shoppable_Excerpt{

    /**
    * Default length (by WordPress)
    *
    * @since Hello Shoppable 1.0.0
    * @access public
    * @var int
    */
    public $length = 15;

    /**
    * Read more Text for excerpt
    * @since Hello Shoppable 1.0.0
    * @access public
    * @var string
    */
    public $more_text = '';

    /**
    * So you can call: hello_shoppable_excerpt( 'short' );
    *
    * @since Hello Shoppable 1.0.0
    * @access protected
    * @var    array
    */
    protected $types = array(
        'short'   => 15,
        'regular' => 25,
        'long'    => 55
    );

    /**
    * Stores class instance
    * 
    * @since Hello Shoppable 1.0.0
    * @access protected
    * @var    object
    */
    protected static $instance = NULL;

    /**
    * Retrives the instance of this class
    * 
    * @since Hello Shoppable 1.0.0
    * @access public
    * @return object
    */
    public static function get_instance() {

        if ( ! self::$instance ) {
          self::$instance = new self();
        }

        return self::$instance;
    }

    /**
    * Sets the length for the excerpt,then it adds the WP filter
    * And automatically calls the_excerpt();
    *
    * @since Hello Shoppable 1.0.0
    * @param string $new_length 
    * @access public
    * @return void
    */
    public function excerpt( $echo, $more_text, $new_length = 15 ) {

        $this->length    = $new_length;
        $this->more_text = $more_text;
        if(!is_admin()):
            add_filter( 'excerpt_more', array( $this, 'new_excerpt_more' ), 999 );
            add_filter( 'excerpt_length', array( $this, 'new_length' ), 999 );
        endif;

        if( $echo )
          the_excerpt();
        else
          return get_the_excerpt();

    }

    public function new_excerpt_more(){
        return $this->more_text;
    }

    /** 
    * Tells WP the new length
    *
    * @since Hello Shoppable 1.0.0
    * @access public
    * @return int
    */
    public function new_length() {

        if( isset( $this->types[ $this->length ] ) )
          return $this->types[ $this->length ];
        else
          return $this->length;
    }
}

endif;

/**
* Call to Hello_Shoppable_Excerpt
*
* @since  1.0.0
* @uses   Hello_Shoppable_Excerpt:::get_instance()->excerpt()
* @param  int $length
* @return void
*/
if( ! function_exists( 'hello_shoppable_excerpt' ) ):

    function hello_shoppable_excerpt( $length = 15, $echo = true, $more = '' ) {
        $length  = apply_filters( 'post_excerpt_length', $length );
        $excerpt = Hello_Shoppable_Excerpt::get_instance()->excerpt( false, $more, $length );
        
        the_excerpt();
    }
endif;

/**
* Enqueue editor styles for Gutenberg
* 
* @since Hello Shoppable 1.0.0
*/
function hello_shoppable_block_editor_styles() {
	require_once get_theme_file_path ( 'inc/wptt-webfont-loader.php');
	// Block styles.
	wp_enqueue_style( 'hello-shoppable-block-editor-style', get_theme_file_uri( '/assets/css/editor-blocks.min.css' ) );
	// Google Font
	wp_enqueue_style( 'hello-shoppable-google-font', wptt_get_webfont_url( 'https://fonts.googleapis.com/css?family=Poppins:300,400,400i,500,600,700,700i' ), false );
}
add_action( 'enqueue_block_editor_assets', 'hello_shoppable_block_editor_styles' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Functions for Woocommerce features
 */
require get_template_directory() . '/inc/woocommerce-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Dynamic CSS.
 */
require get_template_directory() . '/inc/customizer/loader.php';

/**
 * Getting Started Notification.
 */
require get_template_directory() . '/inc/getting-started/getting-started.php';

/**
 * Theme Info.
 */
require_once get_parent_theme_file_path( '/inc/theme-info/theme-info.php' );

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Disable Getting Start After activating Elementor.
 */
add_action( 'admin_init', function() {
	if ( did_action( 'elementor/loaded' ) ) {
		remove_action( 'admin_init', [ \Elementor\Plugin::$instance->admin, 'maybe_redirect_to_getting_started' ] );
	}
}, 1 );

/**
 * Skips redirection after WooCommerce plugin activation
 */
add_filter( 'woocommerce_enable_setup_wizard', '__return_false' );