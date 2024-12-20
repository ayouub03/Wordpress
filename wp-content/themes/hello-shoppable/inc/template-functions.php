<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Hello Shoppable
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function hello_shoppable_body_classes( $classes ) {
	// Adds a class of theme skin
	if( get_theme_mod( 'enable_dark_mode', false ) ){
		if( get_theme_mod( 'enable_image_greyscale', false ) ){
			$classes[] = 'grayscale-mode';
		}
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( get_theme_mod( 'sidebar_settings', 'right' ) == 'right' ){
		if ( !is_active_sidebar( 'right-sidebar' ) ) {
			$classes[] = 'no-sidebar';
		}
	}elseif ( get_theme_mod( 'sidebar_settings', 'right' ) == 'left' ){
		if ( !is_active_sidebar( 'left-sidebar' ) ) {
			$classes[] = 'no-sidebar';
		}
	}elseif ( get_theme_mod( 'sidebar_settings', 'right' ) == 'right-left' ){
		if ( !is_active_sidebar( 'left-sidebar' ) && !is_active_sidebar( 'right-sidebar' ) ) {
			$classes[] = 'no-sidebar';
		}
	}else{
		$classes[] = 'content-no-sidebar';
	}

	if ( ( is_home() || ( is_archive() && !hello_shoppable_wooCom_is_shop() ) ) && !get_theme_mod( 'sidebar_blog_page', true ) ){
		$classes[] = 'no-sidebar';
	}
	if ( is_page() && !get_theme_mod( 'sidebar_page', false ) ){
		$classes[] = 'no-sidebar';
	}
	if ( is_single() && !get_theme_mod( 'sidebar_single_post', true ) ){
		$classes[] = 'no-sidebar';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if( hello_shoppable_wooCom_is_shop() ){
		if ( get_theme_mod( 'woo_sidebar_layout', 'right' ) == 'right' ){
			if ( !is_active_sidebar( 'woocommerce-right-sidebar' ) ) {
				$classes[] = 'no-sidebar';
			}
		}elseif ( get_theme_mod( 'woo_sidebar_layout', 'right' ) == 'left' ){
			if ( !is_active_sidebar( 'woocommerce-left-sidebar' ) ) {
				$classes[] = 'no-sidebar';
			}
		}elseif ( get_theme_mod( 'woo_sidebar_layout', 'right' ) == 'right-left' ){
			if ( !is_active_sidebar( 'woocommerce-left-sidebar' ) && !is_active_sidebar( 'woocommerce-right-sidebar' ) ) {
				$classes[] = 'no-sidebar';
			}
		}else{
			$classes[] = 'content-no-sidebar';
		}
	}

	if ( ( hello_shoppable_wooCom_is_shop() || hello_shoppable_wooCom_is_product_category() ) && !get_theme_mod( 'enable_sidebar_woocommerce_shop', true ) ){
		$classes[] = 'no-sidebar';
	}

	if ( hello_shoppable_wooCom_is_product_page() && !get_theme_mod( 'enable_sidebar_woocommerce_single', true ) ){
		$classes[] = 'no-sidebar';
	}

	if( hello_shoppable_wooCom_is_cart() || hello_shoppable_wooCom_is_checkout() || hello_shoppable_wooCom_is_account_page() ){
		$classes[] = 'no-sidebar';
	}

	if ( get_theme_mod( 'enable_coming_maintenance', false ) ){
		$classes[] = 'coming-soon-maintenance-mode-active';
	}

	//Add class to transparent header
	$array =  get_theme_mod( 'transparent_header_select_setting', array() );

	if ( get_theme_mod( 'transparent_header', false ) ){
		if ( array_search( 'entire-site', $array ) !== false ) { 
			$classes[] = 'overlay-header';
		}

		if ( is_page() &&  array_search( 'page', $array ) !== false ){ 
			$classes[] = 'overlay-header';
		}

		if ( is_single() && array_search( 'post', $array ) !== false ){ 
			$classes[] = 'overlay-header';
		}

		if ( is_archive() && array_search( 'archive', $array ) !== false ){ 
			$classes[] = 'overlay-header';
		}

		if ( is_search() && array_search( 'search', $array ) !== false ){ 
			$classes[] = 'overlay-header';
		}

		if ( is_404() && array_search( '404', $array ) !== false ){ 
			$classes[] = 'overlay-header';
		}
		if ( is_front_page() && array_search( 'front-page', $array ) !== false ){ 
			$classes[] = 'overlay-header';
		}
		if ( hello_shoppable_wooCom_is_shop() && array_search( 'shop', $array ) !== false ){ 
			$classes[] = 'overlay-header';
		}
		if ( hello_shoppable_wooCom_is_product_page() && array_search( 'single-product', $array ) !== false ){ 
			$classes[] = 'overlay-header';
		}
		if ( hello_shoppable_wooCom_is_cart() && array_search( 'cart', $array ) !== false ){ 
			$classes[] = 'overlay-header';
		}
		if ( hello_shoppable_wooCom_is_checkout() && array_search( 'checkout', $array ) !== false ){ 
			$classes[] = 'overlay-header';
		}
		if ( hello_shoppable_wooCom_is_account_page() && array_search( 'my-account', $array ) !== false ){ 
			$classes[] = 'overlay-header';
		}
		if ( hello_shoppable_is_yith() && array_search( 'yith-wishlist', $array ) !== false ){ 
			$classes[] = 'overlay-header';
		}
	}		

 	return $classes;

}
add_filter( 'body_class', 'hello_shoppable_body_classes' );

if( !function_exists( 'hello_shoppable_get_icon_by_post_format' ) ):
/**
* Gives a css class for post format icon
*
* @return string
* @since Hello Shoppable 1.0.0
*/
function hello_shoppable_get_icon_by_post_format(){
    $icons = array(
        'standard' => 'fas fa-thumbtack',
        'sticky'   => 'fas fa-thumbtack',
        'aside'    => 'fas fa-file-alt',
        'image'    => 'fas fa-image',
        'video'    => 'far fa-play-circle',
        'quote'    => 'fas fa-quote-right',
        'link'     => 'fas fa-link',
        'gallery'  => 'fas fa-images',
        'status'   => 'fas fa-comment',
        'audio'    => 'fas fa-volume-up',
        'chat'     => 'fas fa-comments',
    );
    $format = get_post_format();
    if( empty( $format ) ){
        $format = 'standard';
    }
    return apply_filters( 'hello_shoppable_post_format_icon', $icons[ $format ] );
}
endif;

/**
 * Page/Post title in frontpage and blog
 */
function hello_shoppable_page_title_display() {
	if ( is_singular() || ( !is_home() && is_front_page() ) ): ?>
		<h1 class="page-title entry-title"><?php single_post_title(); ?></h1>
	<?php elseif ( is_archive() ) : 
		the_archive_title( '<h1 class="page-title">', '</h1>' );
	elseif ( is_search() ) : ?>
		<h1 class="page-title entry-title">
			<?php 
			/* translators: %s - Searched WordPress query variable*/
			printf( esc_html__( 'Search Results for: %s', 'hello-shoppable' ), get_search_query() );
			?>	
		</h1>
	<?php elseif ( is_404() ) :
		echo '<h1 class="page-title entry-title">' . esc_html__( 'Oops! That page can&#39;t be found.', 'hello-shoppable' ) . '</h1>';
	endif;
}

/**
 * Display page title
 */
function hello_shoppable_page_title() {
	if( get_theme_mod( 'disable_page_title', 'disable_front_page' ) == 'disable_all_pages' ){
		// this condition will disable page title from all pages
		echo '';
	}elseif( is_front_page() && get_theme_mod( 'disable_page_title', 'disable_front_page' ) == 'disable_front_page' ){
		// this condition will disable page title from front page only
		echo '';
	}else {
		hello_shoppable_page_title_display();
	}
}

/**
 * Display page title
 */
function hello_shoppable_is_page_title() {
	if( get_theme_mod( 'disable_page_title', 'disable_front_page' ) == 'disable_all_pages' ){
		// this condition will disable page title from all pages
		return false;
	}elseif( is_front_page() && get_theme_mod( 'disable_page_title', 'disable_front_page' ) == 'disable_front_page' ){
		// this condition will disable page title from front page only
		return false;
	}else {
		return true;
	}
}

/**
 * Display single post title
 */
function hello_shoppable_single_page_title() {
	if( get_theme_mod( 'enable_single_post_title', true ) ){
		hello_shoppable_page_title_display();
	}else {
		// this condition will disable page title from all pages
		echo '';
	}
}

/**
 * Display blog page title
 */
function hello_shoppable_blog_page_title() {
	if( get_theme_mod( 'enable_blog_archive_page_title', true ) ){
		hello_shoppable_page_title_display();
	}else {
		// this condition will disable page title from all pages
		echo '';
	}
}

/**
 * Adds custom size in images
 */
function hello_shoppable_image_size( $image_size ){
	$image_id = get_post_thumbnail_id();
	
	the_post_thumbnail( $image_size, array(
		'alt' => esc_attr(get_post_meta( $image_id, '_wp_attachment_image_alt', true))
	) );
}

/**
* Adds a submit button in search form
* 
* @since Hello Shoppable 1.0.0
* @param string $form
* @return string
*/
function hello_shoppable_modify_search_form( $form ){
	return str_replace( '</form>', '<button type="submit" class="search-button"><i class="fas fa-search"></i></button></form>', $form );
}
add_filter( 'get_search_form', 'hello_shoppable_modify_search_form' );

/**
 * Add breadcrumb
 */

if ( ! function_exists( 'hello_shoppable_breadcrumb' ) ) :

	function hello_shoppable_breadcrumb() {

		// Bail if Home Page.
		if ( ! is_home() && is_front_page() ) {
			return;
		} ?>
		<?php if( function_exists( 'bcn_display' ) ){ ?>
			<div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
			    <?php bcn_display(); ?>
			</div>
		<?php } ?>
		<?php
	}

endif;

if ( ! function_exists( 'hello_shoppable_breadcrumb_wrap' ) ) :
	/**
	 * Add Breadcrumb Wrapper
	 *
	 * @since Hello Shoppable 1.0.0
	 *
	 */
	
	function hello_shoppable_breadcrumb_wrap( $transparent = false ) {
		if( !is_home() && !hello_shoppable_is_bbpress() ) { ?>
	        <div class="breadcrumb-wrap">
	        	<?php if( $transparent ){ ?>
	        		<div class="container">
	        			<?php hello_shoppable_breadcrumb(); ?>
	        		</div>
				<?php } else{ hello_shoppable_breadcrumb(); } ?>
	        </div>
		<?php
		} 
	}
endif;

if ( ! function_exists( 'hello_shoppable_is_bbpress' ) ) :
	/**
	 * Check if bbPress is active and if on bbPress pages 
	 *
	 * @since Hello Shoppable 1.0.0
	 *
	 */
	
	function hello_shoppable_is_bbpress() {
		if( is_plugin_active('bbpress/bbpress.php') && is_bbpress() ) { 
			return true;
		}else{
			return false;
		}
	}
endif;

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function hello_shoppable_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'hello_shoppable_pingback_header' );

/**
* Add a class in body
*
* @since Hello Shoppable 1.0.0
* @param array $class
* @return array $class
*/
function hello_shoppable_body_class_modification( $class ){
	
	// Site Dark Mode
	if( !get_theme_mod( 'disable_dark_mode', true ) ){
		$class[] = 'dark-mode';
	}

	// Site Layouts
	if( get_theme_mod( 'site_layout', 'default' ) == 'default' ){
		$class[] = 'site-layout-default';
	}else if( get_theme_mod( 'site_layout', 'default' ) == 'box' ){
		$class[] = 'site-layout-box';
	}else if( get_theme_mod( 'site_layout', 'default' ) == 'frame' ){
		$class[] = 'site-layout-frame';
	}else if( get_theme_mod( 'site_layout', 'default' ) == 'extend' ){
		$class[] = 'site-layout-extend';
	}

	return $class;
}
add_filter( 'body_class', 'hello_shoppable_body_class_modification' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function hello_shoppable_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'hello_shoppable_content_width', 720 );
}
add_action( 'after_setup_theme', 'hello_shoppable_content_width', 0 );

/**
 * Get Related Posts
 *
 * @since Hello Shoppable 1.0.0
 * @param array $taxonomy
 * @param int $per_page Default 3
 * @return bool | object
 */

if( !function_exists( 'hello_shoppable_get_related_posts' ) ):
	function hello_shoppable_get_related_posts( $taxonomy = array(), $per_page = 4, $get_params = false ){
	   
	    # Show related posts only in single page.
	    if ( !is_single() )
	        return false;

	    # Get the current post object to start of
	    $current_post = get_queried_object();

	    # Get the post terms, just the ids
	    $terms = wp_get_post_terms( $current_post->ID, $taxonomy, array( 'fields' => 'ids' ) );

	    # Lets only continue if we actually have post terms and if we don't have an WP_Error object. If not, return false
	    if ( !$terms || is_wp_error( $terms ) )
	        return false;
	    
	    # Check if the users argument is valid
	    if( is_array( $taxonomy ) && count( $taxonomy ) > 0 ){

	        $tax_query_arg = array();

	        foreach( $taxonomy as $tax ){

	            $tax = filter_var( $tax, FILTER_UNSAFE_RAW );

	            if ( taxonomy_exists( $tax ) ){

	                array_push( $tax_query_arg, array(
	                    'taxonomy'         => $tax,
	                    'terms'            => $terms,
	                    'include_children' => false
	                ) );
	                
	            }
	        }

	        if( count( $tax_query_arg ) == 0 ){
	            return false;
	        }

	        if( count( $tax_query_arg ) > 1 ){
	            $tax_query_arg[ 'relation' ] = 'OR';
	        }
	        
	    }else
	        return false;
	    
	    # Set the default query arguments
	    $args = array(
	        'post_type'      => $current_post->post_type,
	        'post__not_in'   => array( $current_post->ID ),
	        'posts_per_page' => $per_page,
	        'tax_query'      => $tax_query_arg,
	    );

	    if( $get_params ){
	        return $args;
	    }
	    
	    # Now we can query our related posts and return them
	    $q = get_posts( $args );

	    return $q;
	}
endif;

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 * @since Hello Shoppable 1.0.0
 */
function hello_shoppable_widgets_init() {

	register_sidebar( array(
		'name'          => esc_html__( 'Right Sidebar', 'hello-shoppable' ),
		'id'            => 'right-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'hello-shoppable' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title-wrap"><h2 class="widget-title">',
		'after_title'   => '</h2></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Left Sidebar', 'hello-shoppable' ),
		'id'            => 'left-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'hello-shoppable' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title-wrap"><h2 class="widget-title">',
		'after_title'   => '</h2></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'WooCommerce Right Sidebar', 'hello-shoppable' ),
		'id'            => 'woocommerce-right-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'hello-shoppable' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title-wrap"><h2 class="widget-title">',
		'after_title'   => '</h2></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'WooCommerce Left Sidebar', 'hello-shoppable' ),
		'id'            => 'woocommerce-left-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'hello-shoppable' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title-wrap"><h2 class="widget-title">',
		'after_title'   => '</h2></div>',
	) );

	for( $i = 1; $i <= 4; $i++ ){
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Sidebar', 'hello-shoppable' ) . ' ' . $i,
			'id'            => 'footer-sidebar-' . $i,
			'description'   => esc_html__( 'Add widgets here.', 'hello-shoppable' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="footer-item">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	}
}
add_action( 'widgets_init', 'hello_shoppable_widgets_init' );

/**
 * Check whether the sidebar is active or not.
 *
 * @see https://codex.wordpress.org/Conditional_Tags
 * @since Hello Shoppable 1.0.0
 * @return bool whether the sidebar is active or not.
 */

function hello_shoppable_is_active_footer_sidebar(){
	for( $i = 1; $i <= 4; $i++ ){
		if ( is_active_sidebar( 'footer-sidebar-' . $i ) ) : 
			return true;
		endif;
	}
	return false;
}

if( ! function_exists( 'hello_shoppable_sort_category' ) ):
/**
 * Helper function for hello_shoppable_get_the_category()
 *
 * @since Hello Shoppable 1.0.0
 */
function hello_shoppable_sort_category( $a, $b ){
    return $a->term_id < $b->term_id;
}
endif;

/**
 * Validation functions
 *
 * @package Hello Shoppable
 */

if ( ! function_exists( 'hello_shoppable_validate_excerpt_count' ) ) :
	/**
	 * Check if the input value is valid integer.
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return string Whether the value is valid to the current preview.
	 */
	function hello_shoppable_validate_excerpt_count( $validity, $value ){
		$value = intval( $value );
		if ( empty( $value ) || ! is_numeric( $value ) ) {
			$validity->add( 'required', esc_html__( 'You must supply a valid number.', 'hello-shoppable' ) );
		} elseif ( $value < 1 ) {
			$validity->add( 'min_slider', esc_html__( 'Minimum no of Excerpt Lenght is 1', 'hello-shoppable' ) );
		} elseif ( $value > 50 ) {
			$validity->add( 'max_slider', esc_html__( 'Maximum no of Excerpt Lenght is 50', 'hello-shoppable' ) );
		}
		return $validity;
	}
endif;

/**
 * To disable archive prefix title.
 * @since Hello Shoppable 1.0.0
 */

function hello_shoppable_modify_archive_title( $title ) {
	if( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
    } elseif ( is_author() ) {
		$title = '<span class="vcard">' . get_the_author() . '</span>' ;
    } elseif ( is_year() ) {
        $title = get_the_date( _x( 'Y', 'yearly archives date format', 'hello-shoppable' ) );
    } elseif ( is_month() ) {
        $title = get_the_date( _x( 'F Y', 'monthly archives date format', 'hello-shoppable' ) );
    } elseif ( is_day() ) {
        $title = get_the_date( _x( 'F j, Y', 'daily archives date format', 'hello-shoppable' ) );
     } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    } elseif ( is_tax() ) {
        $title = single_term_title( '', false );
    }

	return $title;
}

add_filter( 'get_the_archive_title', 'hello_shoppable_modify_archive_title' );

if( ! function_exists( 'hello_shoppable_get_the_category' ) ):
/**
* Returns categories after sorting by term id descending
* 
* @since Hello Shoppable 1.0.0
* @uses hello_shoppable_sort_category()
* @return array
*/
function hello_shoppable_get_the_category( $id = false ){
    $failed = true;

    if( !$id ){
        $id = get_the_id();
    }
    
    # Check if Yoast Plugin is installed 
    # If yes then, get Primary category, set by Plugin

    if ( class_exists( 'WPSEO_Primary_Term' ) ){

        # Show the post's 'Primary' category, if this Yoast feature is available, & one is set
        $wpseo_primary_term = new WPSEO_Primary_Term( 'category', $id );
        $wpseo_primary_term = $wpseo_primary_term->get_primary_term();

        $hello_shoppable_cat[0] = get_term( $wpseo_primary_term );

        if ( !is_wp_error( $hello_shoppable_cat[0] ) ) { 
           $failed = false;
        }
    }

    if( $failed ){

      $hello_shoppable_cat = get_the_category( $id );
      usort( $hello_shoppable_cat, 'hello_shoppable_sort_category' );  
    }
    
    return $hello_shoppable_cat;
}

endif;

/**
* Get post categoriesby by term id
* 
* @since Hello Shoppable 1.0.0
* @uses hello_shoppable_get_post_categories()
* @return array
*/
function hello_shoppable_get_post_categories(){

	$terms = get_terms( array(
	    'taxonomy' => 'category',
	    'hide_empty' => true,
	) );

	if( empty($terms) || !is_array( $terms ) ){
		return array();
	}

	$data = array();
	foreach ( $terms as $key => $value) {
		$term_id = absint( $value->term_id );
		$data[$term_id] =  esc_html( $value->name );
	}
	return $data;

}

/**
* Get Custom Logo URL
* 
* @since Hello Shoppable 1.0.0
*/
function hello_shoppable_get_custom_logo_url(){
    $custom_logo_id = get_theme_mod( 'custom_logo' );
    $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
    if ( is_array($image) ){
	    return $image[0];
	}else{
		return '';
	}
}

/**
* Add a Pre-loader image
* @since Hello Shoppable 1.0.0
*/
function hello_shoppable_preloader_custom_image(){
	$preloader_custom_image = wp_get_attachment_url( get_theme_mod( 'preloader_custom_image', '' ) );
	if ( $preloader_custom_image ){
 	?>
	 	<span class="preloader-image-wrap">
	 		<img src="<?php echo esc_url( $preloader_custom_image ); ?>">
	 	</span>
	<?php
	}
}

/**
* Add a home page custom banner
* @since Hello Shoppable 1.0.0
*/
function hello_shoppable_banner(){

	$width_control = '';
	if( get_theme_mod( 'banner_width_controls', 'full' ) == 'boxed' ){
		$width_control = 'container boxed';
	}
	$banner_image_ID 		= get_theme_mod( 'banner_image', '' );
	$render_banner_image 	= get_theme_mod( 'render_banner_image_size', 'hello-shoppable-1920-550' );
	$banner_obj 			= wp_get_attachment_image_src( $banner_image_ID, $render_banner_image );
	if( !$banner_image_ID ){
		$banner_image = get_theme_file_uri( '/assets/images/hello-shoppable-1920-550.jpg' );
	}else{
		$banner_image = $banner_obj[0];
	}

	$alignmentClass = 'text-center';
	if ( get_theme_mod( 'main_banner_content_alignment' , 'center' ) == 'left' ){
		$alignmentClass = 'ml-0';
	}elseif ( get_theme_mod( 'main_banner_content_alignment' , 'center' ) == 'right' ){
		$alignmentClass = 'mr-0 text-right';
	}
 	?>

 	<div class="section-banner main-banner <?php echo esc_attr( $width_control ); ?>">
		<div class="banner-img" style="background-image: url( <?php echo esc_url( $banner_image ); ?> );">
			<div class="container">
				<div class="banner-content <?php echo esc_attr( $alignmentClass ); ?>">
					<?php if( get_theme_mod( 'hero_banner_title', true ) ){ ?>
						<h2 class="entry-title">
							<?php 
							$banner_title = get_theme_mod( 'banner_title', '' );
							echo esc_html( $banner_title ? $banner_title : '' ); ?>
						</h2>
					<?php } ?>
					<?php if( get_theme_mod( 'hero_banner_subtitle', true ) ){ ?>
						<p class="entry-subtitle">
							<?php 
							$banner_subtitle = get_theme_mod( 'banner_subtitle', '' );
							echo esc_html( $banner_subtitle ? $banner_subtitle : '' ); 
							?> 
						</p>
					<?php } ?>
					<?php 
					if( get_theme_mod( 'hero_banner_buttons', true )  && !empty( get_theme_mod( 'banner_button_text', '' ) ) ) { 
						?>
			        	<div class="button-container">
			        		<?php
			    			$banner_button_text 	= get_theme_mod( 'banner_button_text', '' );
							$banner_button_link 	= get_theme_mod( 'banner_button_link', '' );
							$banner_button_target 	= get_theme_mod( 'banner_new_window_button_target', true );   
				        		$link_target = '';
								if( $banner_button_target ){
									$link_target = '_blank';
									}
								?>
							<a href="<?php echo esc_url( $banner_button_link ); ?>" target="<?php echo esc_attr( $link_target ); ?>" class="button-primary">
							<?php echo esc_html( $banner_button_text ); ?>
							</a>	
						</div>
					<?php } ?>
				</div>
			</div>
			<div class="image-overlay"></div>
		</div>
	</div>
	<?php
}

/**
* Add a header advertisement banner
* @since Hello Shoppable 1.0.0
*/
function hello_shoppable_header_advertisement_banner(){
	$bannerImageID 						= get_theme_mod( 'header_advertisement_banner', '' );
	$render_header_ad_image_size 		= get_theme_mod( 'render_header_ad_image_size', 'hello-shoppable-730-90' );
	$header_advertisement_banner_obj 	= wp_get_attachment_image_src( $bannerImageID, $render_header_ad_image_size );
	if ( is_array(  $header_advertisement_banner_obj ) ){
		$header_advertisement_banner = $header_advertisement_banner_obj[0];
	}else{
		$header_advertisement_banner = '';
	}
	$alt = get_post_meta( $bannerImageID, '_wp_attachment_image_alt', true);

	$header_banner_target	= get_theme_mod( 'header_banner_target', true );
	$link_target = '';
	if( $header_banner_target ){
		$link_target = '_blank';
	}
 	?>
	 	<div class="header-advertisement-banner">
	 		<a href="<?php echo esc_url( get_theme_mod( 'header_advertisement_banner_link', '#' ) ); ?>" alt="<?php echo esc_attr( $alt ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
	 			<img src="<?php echo esc_url( $header_advertisement_banner ); ?>">
	 		</a>
	 	</div>
	<?php
}

/**
* Add a footer image
* @since Hello Shoppable 1.0.0
*/
function hello_shoppable_footer_logo(){
	$render_bottom_footer_image_size 	= get_theme_mod( 'render_bottom_footer_image_size', 'full' );
	$bottom_footer_image_id 			= get_theme_mod( 'bottom_footer_image', '' );
	$get_bottom_footer_image_array 		= wp_get_attachment_image_src( $bottom_footer_image_id, $render_bottom_footer_image_size );
	if( is_array( $get_bottom_footer_image_array ) ){
		$bottom_footer_image = $get_bottom_footer_image_array[0];
	}else{
		$bottom_footer_image = '';
	}
	$alt = get_post_meta( get_theme_mod( 'bottom_footer_image', '' ), '_wp_attachment_image_alt', true );
	if ( $bottom_footer_image ){
		$bottom_footer_image_target = get_theme_mod( 'bottom_footer_image_target', true );
		$link_target = '';
		if( $bottom_footer_image_target ){
			$link_target = '_blank';
		} ?>
	 	<div class="bottom-footer-image-wrap">
	 		<a href="<?php echo esc_url( get_theme_mod( 'bottom_footer_image_link', '' ) ); ?>" alt="<?php echo esc_attr($alt); ?>" target="<?php echo esc_attr( $link_target ); ?>">
	 			<img src="<?php echo esc_url( $bottom_footer_image ); ?>">
	 		</a>
	 	</div>
	<?php }
}

/**
* Add excerpt length
* @since Hello Shoppable 1.0.0
*/
function hello_shoppable_excerpt_length( $length ) {
	if ( is_admin() ) return $length;
	$excerpt_length = get_theme_mod( 'excerpt_length' , 60 );
	return $excerpt_length;	
}
add_filter( 'excerpt_length', 'hello_shoppable_excerpt_length', 999 );

if( !function_exists( 'hello_shoppable_has_header_media' ) ){
	/**
	* Check if header media slider item is empty.
	* 
	* @since Hello Shoppable 1.0.0
	* @return bool
	*/
	function hello_shoppable_has_header_media(){
		$header_slider_defaults = array(
			array(
				'slider_item' 	=> '',
			)			
		);
		$header_image_slider = get_theme_mod( 'header_image_slider', $header_slider_defaults );
		$has_header_media = false;
		if ( is_array( $header_image_slider ) ){
			foreach( $header_image_slider as $value ){
				if( !empty( $value['slider_item'] ) ){
					$has_header_media = true;
					break;
				}
			}
		}
		return $has_header_media;
	}
}

if( !function_exists( 'hello_shoppable_header_media' ) ){
	/**
	* Add header banner/slider.
	* 
	* @since Hello Shoppable 1.0.0
	*/
	function hello_shoppable_header_media(){
		$header_slider_defaults = array(
			array(
				'slider_item' 	=> '',
			)			
		);
		$header_image_slider = get_theme_mod( 'header_image_slider', $header_slider_defaults ); ?>
		<div class="header-image-slider">
		    <?php 
		    $render_header_image_size = get_theme_mod( 'render_header_image_size', 'full' );
		    foreach( $header_image_slider as $slider_item ) :
			    if( wp_attachment_is_image( $slider_item['slider_item'] ) ){
		    		$get_header_image_array = wp_get_attachment_image_src( $slider_item['slider_item'], $render_header_image_size );
	    			if( is_array( $get_header_image_array ) ){
	    				$header_image_url = $get_header_image_array[0];
	    			}else{
	    				$header_image_url = '';
	    			}
		    	}else{
		    		if( empty( $slider_item['slider_item'] ) ){
	    				$header_image_url = '';
	    			}else{
	    				$header_image_url = $slider_item['slider_item'];
	    			}
		    	} ?>
		    	<div class="header-slide-item" style="background-image: url( <?php echo esc_url( $header_image_url ); ?> )">
		    		<div class="slider-inner"></div>
		      </div>
		    <?php endforeach; ?>
		</div>
		<?php if( get_theme_mod( 'header_slider_arrows', true ) ) { ?>
			<ul class="slick-control">
		        <li class="header-slider-prev">
		        	<span></span>
		        </li>
		        <li class="header-slider-next">
		        	<span></span>
		        </li>
		    </ul>
		<?php }
		if ( get_theme_mod( 'header_slider_dots', true ) ){ ?>
			<div class="header-slider-dots"></div>
		<?php }
	}
}
	
if( !function_exists( 'hello_shoppable_has_social' ) ){
	/**
	* Check if social media icon is empty.
	* 
	* @since Hello Shoppable 1.0.0
	* @return bool
	*/
	function hello_shoppable_has_social(){
		$social_defaults = array(
			array(
				'icon' 		=> '',
				'link' 		=> '',
				'target' 	=> true,
			)			
		);
		$social_icons = get_theme_mod( 'social_media_links', $social_defaults );
		$has_social = false;
		if ( is_array( $social_icons ) ){
			foreach( $social_icons as $value ){
				if( !empty( $value['icon'] ) ){
					$has_social = true;
					break;
				}
			}
		}
		return $has_social;
	}
}

if( !function_exists( 'hello_shoppable_social' ) ){
	/**
	* Add social icons.
	* 
	* @since Hello Shoppable 1.0.0
	*/
	function hello_shoppable_social(){
		if( enabled_header_sortable_element( 'hello_shoppable_social' ) && hello_shoppable_has_social() ){ 
				echo '<div class="social-profile">';
				    echo '<ul class="social-group">';
					    $count = 0.2;
					    $social_defaults = array(
							array(
								'icon' 		=> '',
								'link' 		=> '',
								'target' 	=> true,
							)			
						);
						$social_icons = get_theme_mod( 'social_media_links', $social_defaults );
					    foreach( $social_icons as $value ){
					        if( $value['target'] ){
					    		$link_target = '_blank';
					    	}else{
					    		$link_target = '';
					    	}
					        if( !empty( $value['icon'] ) ){
					            echo '<li><a href="' . esc_url( $value['link'] ) . '" target="' .esc_attr( $link_target ). '"><i class=" ' . esc_attr( $value['icon'] ) . '"></i></a></li>';
					            $count = $count + 0.2;
					        }
					    }
				    echo '</ul>';
			    echo '</div>';
		}
	}
}

if( !function_exists( 'hello_shoppable_has_footer_social' ) ){
	/**
	* Check if social media icon is empty.
	* 
	* @since Hello Shoppable 1.0.0
	* @return bool
	*/
	function hello_shoppable_has_footer_social(){
		$social_defaults = array(
			array(
				'icon' 		=> '',
				'link' 		=> '',
				'target' 	=> true,
			)			
		);
		$social_icons = get_theme_mod( 'footer_social_profile_links', $social_defaults );
		$has_social = false;
		if ( is_array( $social_icons ) ){
			foreach( $social_icons as $value ){
				if( !empty( $value['icon'] ) ){
					$has_social = true;
					break;
				}
			}
		}
		return $has_social;
	}
}

if( !function_exists( 'hello_shoppable_footer_social' ) ){
	/**
	* Add social icons to footer.
	* 
	* @since Hello Shoppable 1.0.0
	*/
	function hello_shoppable_footer_social(){
		if( hello_shoppable_has_footer_social() ){
			$social_defaults = array(
				array(
					'icon' 		=> '',
					'link' 		=> '',
					'target' 	=> true,
				)			
			);
			$social_icons = get_theme_mod( 'footer_social_profile_links', $social_defaults );
			echo '<div class="social-profile">';
			    echo '<ul class="social-group">';
				    $count = 0.2;
				    foreach( $social_icons as $value ){
				        if( $value['target'] ){
				    		$link_target = '_blank';
				    	}else{
				    		$link_target = '';
				    	}
				        if( !empty( $value['icon'] ) ){
				            echo '<li><a href="' . esc_url( $value['link'] ) . '" target="' .esc_attr( $link_target ). '"><i class=" ' . esc_attr( $value['icon'] ) . '"></i></a></li>';
				            $count = $count + 0.2;
				        }
				    }
			    echo '</ul>';
		    echo '</div>';
		}
	}
}

if( !function_exists( 'hello_shoppable_header_buttons' ) ){
	/**
	* Add header buttons.
	* 
	* @since Hello Shoppable 1.0.0
	*/
	function hello_shoppable_header_buttons(){
		$header_button_text 	= get_theme_mod( 'header_button_text', '' );
		$header_button_link 	= get_theme_mod( 'header_button_link', '' );
		$header_button_target 	= get_theme_mod( 'header_button_target', true );

		$link_target = '';
		if( $header_button_target ){
			$link_target = '_blank';
		}
		?>
		<a href="<?php echo esc_url( $header_button_link ); ?>" target="<?php echo esc_attr( $link_target ); ?>" class="button-primary">
			<?php echo esc_html( $header_button_text ); ?>
		</a>	
		<?php
	}
}

/**
* Get pages by post id.
* 
* @since Hello Shoppable 1.0.0
* @return array.
*/
function hello_shoppable_get_pages(){
    $page_array = get_pages();
    $pages_list = array();
    foreach ( $page_array as $key => $value ){
        $page_id = absint( $value->ID );
        $pages_list[ $page_id ] = $value->post_title;
    }
    return $pages_list;
}

if( !function_exists( 'hello_shoppable_blog_advertisement_banner' ) ){
	/**
	* Add a blog advertisement banner
	* @since Hello Shoppable 1.0.0
	*/
    function hello_shoppable_blog_advertisement_banner(){
        $blogAdvertID 					= get_theme_mod( 'blog_advertisement_banner', '' );
        $render_blog_ad_image_size 		= get_theme_mod( 'render_blog_ad_image_size', 'full' );
        $blog_advertisement_banner_obj 	= wp_get_attachment_image_src( $blogAdvertID, $render_blog_ad_image_size );
        if ( is_array(  $blog_advertisement_banner_obj ) ){
            $blog_advertisement_banner = $blog_advertisement_banner_obj[0];
            $advert_target = get_theme_mod( 'blog_advertisement_banner_target', true );
            $alt = get_post_meta( $blogAdvertID, '_wp_attachment_image_alt', true); ?>
            <div class="section-advert">
                <a href="<?php echo esc_url( get_theme_mod( 'blog_advertisement_banner_link', '#' ) ); ?>" alt="<?php echo esc_attr( $alt ); ?>" target="<?php echo esc_attr( $advert_target ); ?>">
                    <img src="<?php echo esc_url( $blog_advertisement_banner ); ?>">
                </a>
            </div>
        <?php }
    }
}

if( !function_exists( 'hello_shoppable_get_intermediate_image_sizes' ) ){
	/**
	* Array of image sizes.
	* 
	* @since Hello Shoppable 1.0.0
	* @return array
	*/
	function hello_shoppable_get_intermediate_image_sizes(){

		$data 	= array(
			'full'				=> esc_html__( 'Full Size', 'hello-shoppable' ),
			'large'				=> esc_html__( 'Large Size', 'hello-shoppable' ),
			'medium'			=> esc_html__( 'Medium Size', 'hello-shoppable' ),
			'medium_large'		=> esc_html__( 'Medium Large Size', 'hello-shoppable' ),
			'thumbnail'			=> esc_html__( 'Thumbnail Size', 'hello-shoppable' ),
			'1536x1536'			=> esc_html__( '1536x1536 Size', 'hello-shoppable' ),
			'2048x2048'			=> esc_html__( '2048x2048 Size', 'hello-shoppable' ),
			'hello-shoppable-1920-550' => esc_html__( '1920x550 Size', 'hello-shoppable' ),
			'hello-shoppable-1370-790'	=> esc_html__( '1370x790 Size', 'hello-shoppable' ),
			'hello-shoppable-1370-550'	=> esc_html__( '1370x550 Size', 'hello-shoppable' ),
			'hello-shoppable-730-90'	=> esc_html__( '730x90 Size', 'hello-shoppable' ),
			'hello-shoppable-420-300'	=> esc_html__( '420x300 Size', 'hello-shoppable' ),
		);
		
		return $data;

	}
}

if( !function_exists( 'hello_shoppable_footer_menu' ) ){
	/**
	 * Array menu to footer.
	 * 
	 * @since Hello Shoppable 1.0.0
	 * @return array
	 */
	function hello_shoppable_footer_menu(){
		if ( has_nav_menu( 'menu-2' ) ){
			echo '<div class="footer-menu"><!-- Footer Menu-->';
				wp_nav_menu( array(
					'theme_location' => 'menu-2',
					'menu_id'        => 'footer-menu',
					'depth'          => 1,
				) );
			echo '</div><!-- footer Menu-->';
		}
	}
}

if( !function_exists( 'hello_shoppable_top_bar_menu' ) ){
	/**
	 * Add menu to top bar.
	 * 
	 * @since Hello Shoppable 1.0.0
	 * @return array
	 */
	function hello_shoppable_top_bar_menu(){
		if( has_nav_menu( 'menu-3') ){ ?>
			<nav id="secondary-navigation" class="header-navigation">
				<button class="menu-toggle" aria-controls="secondary-menu" aria-expanded="false"><?php esc_html_e( 'Secondary Menu', 'hello-shoppable' ); ?></button>
				<?php
				wp_nav_menu( array(
					'theme_location' => 'menu-3',
					'menu_id'        => 'secondary-menu',
				) );
				?>
			</nav><!-- #site-navigation -->
		<?php }
	}
}

if( !function_exists( 'hello_shoppable_top_bar_text' ) ){
	/**
	 * Add top bar header text.
	 * 
	 * @since Hello Shoppable 1.0.0
	 * @return array
	 */
	function hello_shoppable_top_bar_text(){ 
		$top_bar_button_text = get_theme_mod( 'top_bar_button_text', '' ); 
		?>
		<div class="header-text">
			<?php if( get_theme_mod( 'enable_top_bar_text', false ) ){ ?>
				<span class= "top-title">
					<?php echo esc_html( get_theme_mod( 'top_bar_text', '' ) ); ?>
				</span>
			<?php } ?>

			<?php
			if( get_theme_mod( 'enable_top_bar_button', false ) ){
				$link_target = '';
				if( get_theme_mod( 'top_bar_button_target', true ) ){
					$link_target = '_blank';
				}
				?>
				<a href="<?php echo esc_url( get_theme_mod( 'top_bar_button_link', '' ) ); ?>" class="top-link" target="<?php echo esc_attr( $link_target ); ?>">
					<?php echo esc_html( $top_bar_button_text ); ?>
				</a>
			<?php } ?>
		</div>
		<?php
	} 
} 

if( !function_exists( 'enabled_header_sortable_element' ) ){
	/**
	 * Checks if header sortable element is visible/active.
	 * 
	 * @since Hello Shoppable 1.0.0
	 * @return bool
	 */
	function enabled_header_sortable_element( $header_part ){
		$header_parts = get_theme_mod( 'top_bar_sortable', '' );
		if( is_array( $header_parts ) && !empty( $header_parts ) ){
			if( in_array( $header_part, $header_parts ) ){
				if( $header_part == 'hello_shoppable_top_bar_menu' ){
					if( has_nav_menu( 'menu-3') ){
						return true;
					}
				}elseif( $header_part == 'hello_shoppable_top_bar_text' ){
					return true;	
				}elseif( $header_part == 'hello_shoppable_social' ){
					if( hello_shoppable_has_social() ){
						return true;
					}
				}elseif( $header_part == 'header_contact_info' ){
					return true;
				}
			}
		}
		return false;
	}
}

/**
 * Prints HTML with date meta information for the tags and comments.
 */
function hello_shoppable_render_date_time() {

	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date( 'M j, Y' ) ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date( 'M j, Y' ) )
	);
	$year = get_the_date( 'Y' );
	$month = get_the_date( 'm' );
	$link = ( is_single() ) ? get_month_link( $year, $month ) : get_permalink();

	$posted_on = '<a href="' . esc_url( $link ) . '" rel="bookmark">' . $time_string . '</a>';

	echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

if( !function_exists( 'hello_shoppable_primary_menu_alignment' ) ){
	/**
	 * Returns header primary menu alignment class.
	 * 
	 * @since Hello Shoppable 1.0.0
	 * @return string
	 */
	function hello_shoppable_primary_menu_alignment(){
		$primary_menu_alignment = get_theme_mod( 'header_menu_alignment', 'left' );
		$alignment_class = '';
		if( $primary_menu_alignment == 'center' ){
			$alignment_class = 'justify-content-center';
		}elseif( $primary_menu_alignment == 'right' ){
			$alignment_class = 'justify-content-end';
		}
		return $alignment_class;
	}
}

/**
* Check if all getting started recommended plugins are active.
* @since Hello Shoppable 1.0.0
*/
if( !function_exists( 'hello_shoppable_all_gs_plugin_active' ) ){
	function hello_shoppable_all_gs_plugin_active() {
		if( is_plugin_active( 'advanced-import/advanced-import.php' ) && is_plugin_active( 'keon-toolset/keon-toolset.php' ) && is_plugin_active( 'kirki/kirki.php' ) && is_plugin_active( 'elementor/elementor.php' ) && is_plugin_active( 'elementskit-lite/elementskit-lite.php' ) && is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) && is_plugin_active( 'bosa-elementor-for-woocommerce/bosa-elementor-for-woocommerce.php' ) && is_plugin_active( 'woocommerce/woocommerce.php' ) && is_plugin_active( 'classic-widgets/classic-widgets.php' ) ){
			return true;
		}else{
			return false;
		}
	}
}


if( !function_exists( 'hello_shoppable_the_top_bar' ) ){
	/**
	* Prints top bar header.
	* @since Hello Shoppable 1.0.0
	*/
	function hello_shoppable_the_top_bar() {
		$header_parts = get_theme_mod( 'top_bar_sortable', '' );
		if( is_array( $header_parts ) && !empty( $header_parts ) ){
			if( enabled_header_sortable_element( 'hello_shoppable_top_bar_menu' ) || enabled_header_sortable_element( 'hello_shoppable_social' ) || enabled_header_sortable_element( 'header_contact_info' ) || enabled_header_sortable_element( 'hello_shoppable_top_bar_text' ) ){
				?>
				<div class="top-header-outer">
					<div class="container">
						<div class="top-header-inner d-none d-lg-flex align-items-center justify-content-between">
							<?php
							foreach ( $header_parts as $header_part ) {
								if( $header_part == 'header_contact_info' ){
									get_template_part( 'template-parts/header', 'contact' );
								}else{
									call_user_func( $header_part );
								}
							}
							?>
						</div>
					</div>
				</div>
				<?php
			}
		}
	}
}

if( !function_exists( 'hello_shoppable_is_mobile_top_bar_enable' ) ){
	/**
	* Check if mobile top bar sortable elements enabled.
	* @since Hello Shoppable 1.0.0
	*/
	function hello_shoppable_is_mobile_top_bar_enable(){
		if( ( get_theme_mod( 'secondary_menu', true ) && enabled_header_sortable_element( 'hello_shoppable_top_bar_menu' ) ) || ( enabled_header_sortable_element( 'hello_shoppable_social' ) && get_theme_mod( 'mobile_social_icons_header', true ) ) || ( enabled_header_sortable_element( 'header_contact_info' ) && get_theme_mod( 'mobile_contact_details', true ) ) || ( get_theme_mod( 'mobile_top_bar_text', true ) && enabled_header_sortable_element( 'hello_shoppable_top_bar_text' ) ) ){
			return true;
		}
		return false;
	}
}

/**
 * Adds filter to force import demo for advanced import plugin.
 *
 */
function hello_shoppable_prefix_advanced_import_force_proceed() {
	return true;
}

add_action( 'advanced_import_force_proceed', 'hello_shoppable_prefix_advanced_import_force_proceed', 10 );

/**
 * Mobile header icon group class.
 *
 */
function hello_shoppable_header_icon_group_class(){
	$site_branding_class = 'col-5';
	if( ( !get_theme_mod( 'mobile_woocommerce_compare', true ) || !get_theme_mod( 'woocommerce_compare', true ) ) && ( !get_theme_mod( 'mobile_woocommerce_wishlist', true ) || !get_theme_mod( 'woocommerce_wishlist', true ) ) && ( !get_theme_mod( 'mobile_woocommerce_account', true ) || !get_theme_mod( 'woocommerce_account', true ) ) && ( !get_theme_mod( 'mobile_woocommerce_cart', true ) || !get_theme_mod( 'woocommerce_cart', true ) ) && ( !get_theme_mod( 'enable_search_icon', true ) || !get_theme_mod( 'enable_mobile_search_icon', true ) ) ){
		$site_branding_class = 'col-12 text-center';
	}

	return $site_branding_class;
}

/**
 * Header mobile search icon.
 *
 */
function hello_shoppable_header_search_icon(){
	?>
	<button class="search-icon">
		<svg version="1.1" id="Layer_1" x="0px" y="0px" width="25px" height="25px" viewBox="0 0 25 25" enable-background="new 0 0 25 25" xml:space="preserve">
			<g>
				<path fill="#333333" d="M24.362,23.182l-6.371-6.368c1.448-1.714,2.325-3.924,2.325-6.337c0-5.425-4.413-9.838-9.838-9.838
					c-5.425,0-9.838,4.413-9.838,9.838c0,5.425,4.413,9.838,9.838,9.838c2.412,0,4.621-0.876,6.334-2.321l6.372,6.368L24.362,23.182z
					 M2.326,10.477c0-4.495,3.656-8.151,8.151-8.151c4.495,0,8.151,3.656,8.151,8.151s-3.656,8.151-8.151,8.151
					C5.982,18.627,2.326,14.971,2.326,10.477z"/>
			</g>
		</svg>
	</button>
	<?php
}

/**
 * Copyright check.
 *
 */
function hello_shoppable_copyright_pro(){
	if( function_exists('shoppable_pro_copyright_filter') ){
		if( !empty( get_theme_mod( 'shoppable_pro_copyright_text', shoppable_pro_get_copyright_text() ) ) && get_theme_mod( 'shoppable_pro_enable_copyright', true ) ){
			return true;
		}else{
			return false;
		}
	}else{
		return true;
	}
}


add_action( 'init', 'hello_shoppable_copyright_enable', 1 );
/**
 * Enables copyright filter.
 *
 */
function hello_shoppable_copyright_enable(){
	add_filter( 'shoppable_pro_add_copyright_option', function(){
		return true;
	} );
}

