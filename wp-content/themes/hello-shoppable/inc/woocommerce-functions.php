<?php
/**
 * Functions for Woocommerce features
 *
 * @package Hello Shoppable
 */

/**
* Add a wrapper div to product
* @since Hello Shoppable 1.0.0
*/

function hello_shoppable_before_shop_loop_item(){
	echo '<div class="product-inner">';
}

add_action( 'woocommerce_before_shop_loop_item', 'hello_shoppable_before_shop_loop_item', 9 );

/**
* After shop loop item
* @since Hello Shoppable 1.0.0
*/
function hello_shoppable_after_shop_loop_item(){
    echo '</div>';
}
add_action( 'woocommerce_after_shop_loop_item', 'hello_shoppable_after_shop_loop_item', 34 );

/**
* Hide default page title
* @since Hello Shoppable 1.0.0
*/
function hello_shoppable_woo_show_page_title(){
    return false;
}
add_filter( 'woocommerce_show_page_title', 'hello_shoppable_woo_show_page_title' );

/**
* Change number or products per row.
* @since Hello Shoppable 1.0.0
*/
if ( !function_exists( 'hello_shoppable_loop_columns' ) ) {
	function hello_shoppable_loop_columns() {
        if( get_theme_mod( 'woocommerce_product_layout_type', 'product_layout_grid' ) == 'product_layout_grid' ){
          return get_theme_mod( 'woocommerce_shop_product_column', 3 );
        }elseif( get_theme_mod( 'woocommerce_product_layout_type', 'product_layout_grid' ) == 'product_layout_list' ){
          return get_theme_mod( 'woocommerce_shop_list_column', 2 );
        }
	}
}
add_filter( 'loop_shop_columns', 'hello_shoppable_loop_columns' );

/**
* Add cart link
* @since Hello Shoppable 1.0.0
*/
if ( !function_exists('hello_shoppable_cart_link') ) {
    function hello_shoppable_cart_link() {
        ?>	
            <a class="icon-cart" href="<?php echo esc_url( wc_get_cart_url() ); ?>">
                <span class="header-svg-icon">
                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         width="25px" height="25px" viewBox="0 0 25 25" enable-background="new 0 0 25 25" xml:space="preserve">
                        <path fill="#313131" d="M23.953,6.808h-4.348C19.09,3.523,16.249,1,12.822,1S6.554,3.523,6.039,6.808H1.052l0.01,13.225
                        C1.062,22.22,2.841,24,5.029,24h15.003C22.22,24,24,22.22,24,20.028L23.953,6.808z M12.822,3c2.321,0,4.26,1.633,4.749,3.808H8.073
                        C8.562,4.633,10.501,3,12.822,3z M20.032,22.016H5.029c-1.094,0-1.984-0.89-1.984-1.984L3.036,8.792h2.911V12h2V8.792h9.75v3.24h2
                        v-3.24h2.26l0.059,11.241C22.016,21.126,21.126,22.016,20.032,22.016z"/>
                    </svg>
                </span>
                <span class="count"><?php echo wp_kses_data( WC()->cart->get_cart_contents_count() ); ?></span>
                <div class="amount-cart"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></div> 
            </a>
        <?php
    }
}

/**
* Add product cart box
* @since Hello Shoppable 1.0.0
*/
if ( !function_exists('hello_shoppable_header_cart') ) {
    function hello_shoppable_header_cart() {
        ?>
            <div class="header-cart">
                <div class="header-cart-block">
                    <div class="header-cart-inner">
                        <?php hello_shoppable_cart_link(); ?>
                        <?php if( !hello_shoppable_wooCom_is_cart() && !hello_shoppable_wooCom_is_checkout() ){  ?>
                            <ul class="site-header-cart menu list-unstyled m-0">
                                <li>
                                	<?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
                                </li>
                            </ul>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php
    }
}

/**
* Add header add to cart fragment
* @since Hello Shoppable 1.0.0
*/
if ( !function_exists( 'hello_shoppable_header_add_to_cart_fragment' ) ) {
    function hello_shoppable_header_add_to_cart_fragment( $fragments ) {
        ob_start();
        hello_shoppable_cart_link();
        $fragments['a.cart-icon'] = ob_get_clean();
        return $fragments;
    }
    add_filter( 'woocommerce_add_to_cart_fragments', 'hello_shoppable_header_add_to_cart_fragment' );
}

/**
* Add product wishlist
* @since Hello Shoppable 1.0.0
*/
if ( !function_exists('hello_shoppable_head_wishlist') ) {
    function hello_shoppable_head_wishlist() {
        if ( function_exists( 'YITH_WCWL' ) ) {
            $wishlist_url = YITH_WCWL()->get_wishlist_url();
            ?>
            <div class="header-wishlist">
                <a href="<?php echo esc_url( $wishlist_url ); ?>">
                    <span class="header-svg-icon">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                             width="25px" height="25px" viewBox="0 0 25 25" enable-background="new 0 0 25 25" xml:space="preserve">
                            <path fill="#313131" d="M12.563,23.125l-0.601-0.532c0,0-1.414-1.252-1.773-1.595c-7.033-6.739-8.021-8.537-8.111-8.72l-0.023-0.046
                            c-0.721-1.098-1.101-2.359-1.101-3.658c0-3.693,3.005-6.697,6.697-6.697c1.845,0,3.587,0.759,4.846,2.074
                            c1.255-1.315,2.988-2.074,4.819-2.074c3.693,0,6.697,3.005,6.697,6.697c0,1.301-0.381,2.563-1.103,3.662l-0.02,0.043
                            c-0.09,0.183-1.082,1.987-8.152,8.759L12.563,23.125z M4.231,12.311c0.837,1.038,2.787,3.235,7.164,7.429
                            c0.194,0.185,0.706,0.645,1.121,1.015l1.018-0.978c4.576-4.382,6.511-6.594,7.298-7.589l0.542-0.793
                            c0.587-0.842,0.897-1.818,0.897-2.823c0-2.732-2.223-4.955-4.955-4.955c-1.633,0-3.164,0.824-4.096,2.203L12.498,6.89l-0.722-1.069
                            c-0.932-1.379-2.474-2.203-4.124-2.203c-2.732,0-4.955,2.223-4.955,4.955c0,1.005,0.31,1.982,0.897,2.823L4.231,12.311z"/>
                        </svg>
                    </span>
                    <span class="info-tooltip">
                        <?php esc_html_e( 'Wishlist', 'hello-shoppable' ); ?>
                    </span>
                </a>
            </div>
            <?php
        }
    }
}

/**
* Add product compare icon in header
* @since Hello Shoppable 1.0.0
*/
if (!function_exists( 'hello_shoppable_head_compare' ) ) {
    function hello_shoppable_head_compare() {
        if ( function_exists( 'yith_woocompare_constructor' ) ) {
            global $yith_woocompare;
            ?>
            <div class="header-compare">
                <a class="compare added" rel="nofollow" href="<?php echo esc_url( $yith_woocompare->obj->view_table_url() ); ?>">
                    <span class="header-svg-icon">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                             width="25px" height="25px" viewBox="0 0 25 25" enable-background="new 0 0 25 25" xml:space="preserve">
                            <g>
                                <path fill="#313131" d="M6.354,7.32L4.372,7.182c1.784-2.649,4.805-4.398,8.231-4.398c4.882,0,8.942,3.547,9.763,8.197h1.573
                                    c-0.837-5.511-5.594-9.753-11.336-9.753c-4.123,0-7.73,2.193-9.752,5.466L1.032,5.391l0.991,5.574L6.354,7.32z"/>
                                <path fill="#333333" d="M18.617,17.68l1.982,0.137c-1.784,2.649-4.805,4.398-8.231,4.398c-4.882,0-8.942-3.547-9.763-8.197H1.032
                                    c0.837,5.511,5.594,9.753,11.336,9.753c4.123,0,7.73-2.193,9.752-5.466l1.819,1.303l-0.991-5.574L18.617,17.68z"/>
                            </g>
                        </svg>
                    </span>
                    <span class="info-tooltip">
                        <?php esc_html_e( 'Compare', 'hello-shoppable' ); ?>
                    </span>
                </a>
            </div>
            <?php
        }
    }
}

/**
* Add buttons in compare and wishlist
* @since Hello Shoppable 1.0.0
*/
if (!function_exists('hello_shoppable_compare_wishlist_buttons')) {
    function hello_shoppable_compare_wishlist_buttons() {
        ?>
        <div class="product-compare-wishlist">     
        <?php
    }
    add_action( 'woocommerce_after_shop_loop_item', 'hello_shoppable_compare_wishlist_buttons', 10 );
}

/**
 * Closing for quick view, compare and wishlist.
 * @since Hello Shoppable 1.0.0
*/
if (!function_exists('hello_shoppable_compare_wishlist_buttons_close')) {
    add_action( 'woocommerce_after_shop_loop_item', 'hello_shoppable_compare_wishlist_buttons_close', 21 );
    function hello_shoppable_compare_wishlist_buttons_close() {
        echo '</div>'; /* .product-compare-wishlist */
    }
}

/**
* Add my account
* @since Hello Shoppable 1.0.0
*/
if ( !function_exists( 'hello_shoppable_my_account' ) ) {
    function hello_shoppable_my_account() {
    if (get_theme_mod('header_account_popup_login', true ) && !is_user_logged_in()) {
        $login_id = "popuplogin";
        $login_link = "#";
    } else {
        $login_id = "defaultlogin";
        $login_link = get_permalink(get_option('woocommerce_myaccount_page_id'));
    }
        ?>
        <div class="header-my-account">
            <div class="header-login"> 
               <a id="<?php echo esc_attr($login_id); ?>" href="<?php echo esc_url($login_link); ?>" data-tooltip="<?php esc_attr_e('My Account', 'hello-shoppable'); ?>" title="<?php esc_attr_e('My Account', 'hello-shoppable'); ?>">
                    <span class="header-svg-icon">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                             width="25px" height="25px" viewBox="0 0 25 25" enable-background="new 0 0 25 25" xml:space="preserve">
                            <path fill="#313131" d="M23.762,23.039c-0.703-4.359-3.769-7.773-7.771-9.053c1.963-1.255,3.27-3.449,3.27-5.947
                            c0-3.893-3.167-7.06-7.06-7.06s-7.06,3.167-7.06,7.06c0,2.58,1.395,4.834,3.466,6.066c-3.822,1.367-6.721,4.708-7.402,8.934
                            l-0.158,0.982h22.874L23.762,23.039z M6.836,8.039c0-2.959,2.407-5.366,5.366-5.366s5.366,2.407,5.366,5.366
                            s-2.407,5.366-5.366,5.366S6.836,10.998,6.836,8.039z M3.088,22.326c1.128-4.227,4.933-7.201,9.396-7.201s8.268,2.973,9.396,7.201
                            H3.088z"/>
                        </svg>
                    </span>
                    <span class="info-tooltip">
                        <?php esc_html_e( 'My Account', 'hello-shoppable' ); ?>
                    </span>
                </a>
            </div>
        </div>
        <?php
    }
}

function shoppable_popuplogin() {
    if (get_theme_mod('header_account_popup_login', true) && !is_user_logged_in()) {
        ?>
        <div id="popup-login">
            <a href="#" class="login-canvas-toggle-nav"><i class="fa fa-close"></i></a>
            <div id="popup-login-box">
                <?php
                if (is_admin())
                    return;
                if (is_user_logged_in())
                    return;
                echo do_shortcode('[woocommerce_my_account]');
                ?>
            </div>
        </div>
        <?php
    }
}

add_action('wp_footer', 'shoppable_popuplogin', 30);

/**
 * Check if WooCommerce is activated and is shop page.
 *
 * @return Bool
 * @since Hello Shoppable 1.0.0
 */
if( !function_exists( 'hello_shoppable_wooCom_is_shop' ) ){
    function hello_shoppable_wooCom_is_shop() {
        if ( class_exists( 'woocommerce' ) ) {  
            if ( is_shop()  ) {
                return true;
            }
        }else{
            return false;
        }
    }
    add_action( 'wp', 'hello_shoppable_wooCom_is_shop' );
}

/**
 * Check if WooCommerce is activated and is cart page.
 *
 * @return Bool
 * @since Hello Shoppable 1.0.0
 */
if( !function_exists( 'hello_shoppable_wooCom_is_cart' ) ){
    function hello_shoppable_wooCom_is_cart() {
        if ( class_exists( 'woocommerce' ) ) {  
            if ( is_cart()  ) {
                return true;
            }
        }else{
            return false;
        }
    }
    add_action( 'wp', 'hello_shoppable_wooCom_is_cart' );
}

/**
 * Check if WooCommerce is activated and is checkout page.
 *
 * @return Bool
 * @since Hello Shoppable 1.0.0
 */
if( !function_exists( 'hello_shoppable_wooCom_is_checkout' ) ){
    function hello_shoppable_wooCom_is_checkout() {
        if ( class_exists( 'woocommerce' ) ) {  
            if ( is_checkout()  ) {
                return true;
            }
        }else{
            return false;
        }
    }
    add_action( 'wp', 'hello_shoppable_wooCom_is_checkout' );
}

/**
 * Check if WooCommerce is activated and is account page.
 *
 * @return Bool
 * @since Hello Shoppable 1.0.0
 */
if( !function_exists( 'hello_shoppable_wooCom_is_account_page' ) ){
    function hello_shoppable_wooCom_is_account_page() {
        if ( class_exists( 'woocommerce' ) ) {  
            if ( is_account_page()  ) {
                return true;
            }
        }else{
            return false;
        }
    }
    add_action( 'wp', 'hello_shoppable_wooCom_is_account_page' );
}

/**
 * Check if on a page which uses WooCommerce templates.
 *
 * @return Bool
 * @since Hello Shoppable 1.0.0
 */

if( !function_exists( 'hello_shoppable_is_woocommerce' ) ){
    function hello_shoppable_is_woocommerce() {
        if ( class_exists( 'woocommerce' ) ) {  
            if ( is_account_page() || is_checkout() || is_cart() ) {
                return true;
            }
        }else{
            return false;
        }
    }
    add_action( 'wp', 'hello_shoppable_is_woocommerce' );
}

/**
 * Check if on a page which uses Yith templates.
 *
 * @return Bool
 * @since Hello Shoppable 1.0.0
 */

if( !function_exists( 'hello_shoppable_is_yith' ) ){
    function hello_shoppable_is_yith() {
        if ( class_exists( 'woocommerce' ) && function_exists( 'YITH_WCWL' ) ) {  
            if ( is_page( 'wishlist' ) ) {
                return true;
            }
        }else{
            return false;
        }
    }
    add_action( 'wp', 'hello_shoppable_is_yith' );
}

/**
* Modify excerpt item priority to last in product detail page.
* @since Hello Shoppable 1.0.0
*/
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 55 );

/**
 * Change column number of related products in product detail page.
 *
 * @return array
 * @since Hello Shoppable 1.0.0
 */
if( !function_exists( 'hello_shoppable_related_products_args' ) ){
    add_filter( 'woocommerce_output_related_products_args', 'hello_shoppable_related_products_args', 20 );
    function hello_shoppable_related_products_args( $args ) {
        if( get_theme_mod( 'woocommerce_product_layout_type', 'product_layout_grid' ) == 'product_layout_grid' ){
            $args[ 'columns'] = 3;
            if ( get_theme_mod( 'woo_sidebar_layout', 'right' ) == 'right' ){
                if ( !is_active_sidebar( 'woocommerce-right-sidebar' ) ) {
                    $args[ 'columns'] = 4;
                }
            }elseif ( get_theme_mod( 'woo_sidebar_layout', 'right' ) == 'left' ){
                if ( !is_active_sidebar( 'woocommerce-left-sidebar' ) ) {
                    $args[ 'columns'] = 4;
                }
            }elseif ( get_theme_mod( 'woo_sidebar_layout', 'right' ) == 'right-left' ){
                if ( !is_active_sidebar( 'woocommerce-left-sidebar' ) && !is_active_sidebar( 'woocommerce-right-sidebar' ) ) {
                    $args[ 'columns'] = 4;
                }
            }else{
                $args[ 'columns'] = 4;
            }
            if ( ( !get_theme_mod( 'enable_sidebar_woocommerce_shop', true ) && ( hello_shoppable_wooCom_is_shop() || hello_shoppable_wooCom_is_product_category() ) ) || ( !get_theme_mod( 'enable_sidebar_woocommerce_single', true ) && hello_shoppable_wooCom_is_product_page() ) ){
                $args[ 'columns'] = 4;
            }
        }elseif( get_theme_mod( 'woocommerce_product_layout_type', 'product_layout_grid' ) == 'product_layout_list' ){
            $args[ 'columns'] = 2;
        }

        return $args;
    }
}

/**
 * Check if WooCommerce is activated and is product detail page.
 *
 * @return bool
 * @since Hello Shoppable 1.0.0
 */
if( !function_exists( 'hello_shoppable_wooCom_is_product_page' ) ){
    function hello_shoppable_wooCom_is_product_page() {
        if ( class_exists( 'woocommerce' ) ) {  
            if ( is_product() ) {
                return true;
            }
        }else{
            return false;
        }
    }
    add_action( 'wp', 'hello_shoppable_wooCom_is_product_page' );
}

/**
 * Check if WooCommerce is activated and is product category page.
 *
 * @return bool
 * @since Hello Shoppable 1.0.0
 */
if( !function_exists( 'hello_shoppable_wooCom_is_product_category' ) ){
    function hello_shoppable_wooCom_is_product_category() {
        if ( class_exists( 'woocommerce' ) ) {  
            if ( is_product_category() ) {
                return true;
            }
        }else{
            return false;
        }
    }
    add_action( 'wp', 'hello_shoppable_wooCom_is_product_category' );
}


/**
 * Add left sidebar to product detail page.
 *
 * @since Hello Shoppable 1.0.0
 */
if( !function_exists( 'hello_shoppable_woo_product_detail_left_sidebar' ) ){
    function hello_shoppable_woo_product_detail_left_sidebar( $sidebarColumnClass ){
        $sticky_class = get_theme_mod( 'woo_sticky_sidebar', true ) ? ' sticky-sidebar' : '';
        if ( get_theme_mod( 'woo_sidebar_layout', 'right' ) == 'left' ){ 
            if( is_active_sidebar( 'woocommerce-left-sidebar') ){ ?>
                <div id="secondary" class="sidebar left-sidebar <?php echo esc_attr( $sidebarColumnClass ); echo esc_attr( $sticky_class ); ?>">
                    <?php dynamic_sidebar( 'woocommerce-left-sidebar' ); ?>
                </div>
            <?php }
        }elseif ( get_theme_mod( 'woo_sidebar_layout', 'right' ) == 'right-left' ){
            if( is_active_sidebar( 'woocommerce-left-sidebar') || is_active_sidebar( 'woocommerce-right-sidebar') ){ ?>
                <div id="secondary" class="sidebar left-sidebar <?php echo esc_attr( $sidebarColumnClass ); echo esc_attr( $sticky_class ); ?>">
                    <?php dynamic_sidebar( 'woocommerce-left-sidebar' ); ?>
                </div>
            <?php
            }
        }
    }
}

/**
 * Add right sidebar to product detail page.
 *
 * @since Hello Shoppable 1.0.0
 */
if( !function_exists( 'hello_shoppable_woo_product_detail_right_sidebar' ) ){
    function hello_shoppable_woo_product_detail_right_sidebar( $sidebarColumnClass ){
        $sticky_class = get_theme_mod( 'woo_sticky_sidebar', true ) ? ' sticky-sidebar' : '';
        if ( get_theme_mod( 'woo_sidebar_layout', 'right' ) == 'right' ){ 
            if( is_active_sidebar( 'woocommerce-right-sidebar') ){
                ?>
                <div id="secondary" class="sidebar right-sidebar <?php echo esc_attr( $sidebarColumnClass ); echo esc_attr( $sticky_class ); ?>">
                    <?php dynamic_sidebar( 'woocommerce-right-sidebar' ); ?>
                </div>
            <?php }
        }elseif ( get_theme_mod( 'woo_sidebar_layout', 'right' ) == 'right-left' ){
            if( is_active_sidebar( 'woocommerce-left-sidebar') || is_active_sidebar( 'woocommerce-right-sidebar') ){ ?>
                <div id="secondary-sidebar" class="sidebar right-sidebar  <?php echo esc_attr( $sidebarColumnClass ); echo esc_attr( $sticky_class ); ?>">
                    <?php dynamic_sidebar( 'woocommerce-right-sidebar' ); ?>
                </div>
            <?php
            }
        }
    }
}

/**
 * Returns the sidebar column classes in product detail page.
 *
 * @return array
 * @since Hello Shoppable 1.0.0
 */
if( !function_exists( 'hello_shoppable_get_sidebar_class' ) ){
    function hello_shoppable_get_sidebar_class(){
        $sidebarClass = 'col-lg-8';
        $sidebarColumnClass = 'col-lg-4';

        if ( get_theme_mod( 'woo_sidebar_layout', 'right' ) == 'right' ){
            if( !is_active_sidebar( 'woocommerce-right-sidebar') ){
                $sidebarClass = "col-12";
            }   
        }elseif ( get_theme_mod( 'woo_sidebar_layout', 'right' ) == 'left' ){
            if( !is_active_sidebar( 'woocommerce-left-sidebar') ){
                $sidebarClass = "col-12";
            }   
        }elseif ( get_theme_mod( 'woo_sidebar_layout', 'right' ) == 'right-left' ){
            $sidebarClass = 'col-lg-6';
            $sidebarColumnClass = 'col-lg-3';
            if( !is_active_sidebar( 'woocommerce-left-sidebar') && !is_active_sidebar( 'woocommerce-right-sidebar') ){
                $sidebarClass = "col-12";
            }
        }else{
            $sidebarClass = 'col-12';
        }
        if ( ( !get_theme_mod( 'enable_sidebar_woocommerce_shop', true ) && ( hello_shoppable_wooCom_is_shop() || hello_shoppable_wooCom_is_product_category() ) ) || ( !get_theme_mod( 'enable_sidebar_woocommerce_single', true ) && hello_shoppable_wooCom_is_product_page() ) ){
            $sidebarClass = 'col-12';
        }
        $colClasses = array(
            'sidebarClass' => $sidebarClass, 
            'sidebarColumnClass' => $sidebarColumnClass, 
        );
        return $colClasses;
    }
}

/**
 * Add wrapper product gallery in product detail page.
 *
 * @since Hello Shoppable 1.0.0
 */
if( !function_exists( 'hello_shoppable_woocommerce_before_single_product_summary' ) ){
    add_action( 'woocommerce_before_single_product_summary', 'hello_shoppable_woocommerce_before_single_product_summary', 5 );
    function hello_shoppable_woocommerce_before_single_product_summary(){
        echo '<div class="product-detail-wrapper d-flex flex-wrap align-items-center">';
    }
}

/**
 * Add left sidebar before tabs in product detail page.
 *
 * @since Hello Shoppable 1.0.0
 */
if( !function_exists( 'hello_shoppable_woocommerce_after_single_product_summary' ) ){
    add_action( 'woocommerce_after_single_product_summary', 'hello_shoppable_woocommerce_after_single_product_summary', 5 );
    function hello_shoppable_woocommerce_after_single_product_summary(){
        $getSidebarClass = hello_shoppable_get_sidebar_class();
        echo '</div>';/* .product-detail-wrapper */
        echo '<div class="row">';
        if( get_theme_mod( 'enable_sidebar_woocommerce_single', true ) ){
            hello_shoppable_woo_product_detail_left_sidebar( $getSidebarClass[ 'sidebarColumnClass' ] );
        }
            echo '<div class="'. esc_attr( $getSidebarClass[ 'sidebarClass' ] ) .'">';
    }
}

/**
 * Add right sidebar before tabs in product detail page.
 *
 * @since Hello Shoppable 1.0.0
 */
if( !function_exists( 'hello_shoppable_woocommerce_after_single_product' ) ){
    add_action( 'woocommerce_after_single_product', 'hello_shoppable_woocommerce_after_single_product' );
    function hello_shoppable_woocommerce_after_single_product(){
        $getSidebarClass = hello_shoppable_get_sidebar_class();
        if( get_theme_mod( 'enable_sidebar_woocommerce_single', true ) ){
            hello_shoppable_woo_product_detail_right_sidebar( $getSidebarClass[ 'sidebarColumnClass' ] );
        }
            echo '</div>';/* col woocommerce tabs and related products */
        echo '</div>';/* .row */
    }
}

/**
 * Add icon and tooltip text for Yith Woocommerce Quick View.
 *
 * @since Hello Shoppable 1.0.0
 */
if( !function_exists( 'hello_shoppable_yith_add_quick_view_button_html' ) ){
    add_filter( 'yith_add_quick_view_button_html', 'hello_shoppable_yith_add_quick_view_button_html', 10, 3 );
    function hello_shoppable_yith_add_quick_view_button_html( $button, $label, $product ){
        
        $product_id = $product->get_id();

        $button = '<div class="product-view"><a href="#" class="yith-wcqv-button" data-product_id="' . esc_attr( $product_id ) . '"><i class="fas fa-search"></i><span class="info-tooltip">' . $label . '</span></a></div>';
        return $button;
    }
}

/**
 * Modify $label for Yith Woocommerce Wishlist.
 *
 * @since Hello Shoppable 1.0.0
 */
if( !function_exists( 'hello_shoppable_yith_wcwl_button_label' ) ){
     add_filter( 'yith_wcwl_button_label', 'hello_shoppable_yith_wcwl_button_label' );
    function hello_shoppable_yith_wcwl_button_label( $label_option ){
        $label_option = '<span class="info-tooltip">'.$label_option.'</span>';
        return $label_option;
    }
}

/**
 * Modify $browse_wishlist_text for Yith Woocommerce Wishlist.
 *
 * @since Hello Shoppable 1.0.0
 */
if( !function_exists( 'hello_shoppable_yith_wcwl_browse_wishlist_label' ) ){
    function hello_shoppable_yith_wcwl_browse_wishlist_label( $browse_wishlist_text ){
        add_filter( 'yith_wcwl_browse_wishlist_label', 'hello_shoppable_yith_wcwl_browse_wishlist_label' );
        if( strpos( $browse_wishlist_text, 'info-tooltip' ) === false ){
            $browse_wishlist_text = '<i class="fas fa-heart"></i><span class="info-tooltip">'.$browse_wishlist_text.'</span>';
        }
        return $browse_wishlist_text;
    }
}

/**
 * Loop product structure
 */
function hello_shoppable_loop_product_structure() {
    $elements   = array( 'woocommerce_template_loop_product_title', 'woocommerce_template_loop_price' );

    $loop_count = 0;
    foreach ( $elements as $element ) {
        call_user_func( $element );
        if( $loop_count < 1 ){
            if( get_theme_mod( 'enable_shop_page_rating', true ) ){
                hello_shoppable_zero_woocommerce_template_loop_rating();
                woocommerce_template_loop_rating();
            }
        }
        $loop_count++;
    }
}

/**
 * Adds cart layout div to add-to-cart loop structure.
 */
if( !function_exists( 'hello_shoppable_cart_button_loop_structure' ) ){
    function hello_shoppable_cart_button_loop_structure() {
        $cart_button_layout     = get_theme_mod( 'woocommerce_add_to_cart_button', 'cart_button_two' );
        echo '<div class="button-' . esc_attr( $cart_button_layout ) . '">';
            woocommerce_template_loop_add_to_cart();
        echo '</div>';
    }
}

/**
 * Inserts the opening figure tag inside product-inner div.
 */
if( !function_exists( 'hello_shoppable_product_inner_figure_start' ) ){
    function hello_shoppable_product_inner_figure_start(){
        echo '<figure class="woo-product-image">';
    }
}

/**
 * Inserts the closing figure tag.
 */
if( !function_exists( 'hello_shoppable_product_inner_figure_close' ) ){
    function hello_shoppable_product_inner_figure_close(){
        echo '</figure>';
    }
}

/**
 * Inserts the opening div tag after product-inner div.
 */
if( !function_exists( 'hello_shoppable_product_inner_contents_start' ) ){
    function hello_shoppable_product_inner_contents_start(){
        echo '<div class="product-inner-contents">';
    }
}

/**
 * Inserts the closing div tag for product-inner-content div.
 */
if( !function_exists( 'hello_shoppable_product_inner_contents_close' ) ){
    function hello_shoppable_product_inner_contents_close(){
        echo '</div>';
    }
}

/**
 * Removes product's title from shop loop.
 */
add_action( 'woocommerce_shop_loop_item_title', 'hello_shoppable_woocommerce_shop_loop_item_title', 9 );
function hello_shoppable_woocommerce_shop_loop_item_title(){
    remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title' );
}

/**
 * Removes product's rating and price from shop loop.
 */
add_action( 'woocommerce_after_shop_loop_item_title', 'hello_shoppable_woocommerce_after_shop_loop_item_title', 4 );
function hello_shoppable_woocommerce_after_shop_loop_item_title(){
    remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
    remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price' );
}

/**
 * Removes product's add to cart button from shop loop.
 */
add_action( 'woocommerce_after_shop_loop_item', 'hello_shoppable_woocommerce_after_shop_loop_item', 9 );
function hello_shoppable_woocommerce_after_shop_loop_item(){
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
}

/**
 * Hook into Woocommerce
 */
add_action( 'wp_loaded', 'hello_shoppable_woocommerce_hooks' );
function hello_shoppable_woocommerce_hooks() {

    add_action( 'woocommerce_before_shop_loop_item', 'hello_shoppable_product_inner_figure_start', 9 );
    add_action( 'woocommerce_after_shop_loop_item', 'hello_shoppable_product_inner_figure_close', 22 );

    add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_open', 29 );
    //Add elements from sortable option
    add_action( 'woocommerce_after_shop_loop_item', 'hello_shoppable_loop_product_structure', 30 );
    add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 31 );

    add_action( 'woocommerce_after_shop_loop_item', 'hello_shoppable_product_inner_contents_start', 25 );
    add_action( 'woocommerce_after_shop_loop_item', 'hello_shoppable_product_inner_contents_close', 33 );

    $cart_button_layout     = get_theme_mod( 'woocommerce_add_to_cart_button', 'cart_button_two' );
    if( $cart_button_layout == 'cart_button_two' ){
        add_action( 'woocommerce_after_shop_loop_item', 'hello_shoppable_cart_button_loop_structure', 32 );
    }elseif( $cart_button_layout == 'cart_button_three' ){
        add_action( 'woocommerce_after_shop_loop_item', 'hello_shoppable_cart_button_loop_structure', 21 );
    }

}

/**
 * Single product hooks
 */
add_action( 'wp', 'hello_shoppable_single_product_hooks' );
function hello_shoppable_single_product_hooks(){
    if( hello_shoppable_wooCom_is_product_page() ){
        $enable_single_product_tabs = get_theme_mod( 'enable_single_product_tabs', true );
        if( !$enable_single_product_tabs ){
            remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs' );
        }

        $enable_single_product_related_products = get_theme_mod( 'enable_single_product_related_products', true );
        if( !$enable_single_product_related_products ){
            remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
        }
    }
}

/**
 * Add to cart button html.
 */
function hello_shoppable_filter_loop_add_to_cart( $button, $product, $args ) {
    global $product;

    //Return if not button layout 3
    $cart_button_layout     = get_theme_mod( 'woocommerce_add_to_cart_button', 'cart_button_two' );

    if ( $cart_button_layout != 'cart_button_three' ) {
        return $button;
    }
    $text = '<i class="fas fa-shopping-cart"></i>';
    $button = sprintf(
        '<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
        esc_url( $product->add_to_cart_url() ),
        esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
        esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
        isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
        $text
    );

    return $button;
}
add_filter( 'woocommerce_loop_add_to_cart_link', 'hello_shoppable_filter_loop_add_to_cart', 10, 3 );

/**
 * Sales badge text
 */
function hello_shoppable_sale_badge_tag( $html, $post, $product ) {

    if ( !$product->is_on_sale() ) {
        return;
    }   

    $badge_text     = get_theme_mod( 'woocommerce_sale_badge_text', 'Sale!' );
    $enable_sale_percent = get_theme_mod( 'enable_sale_badge_percent', false );
    $percent_text   = get_theme_mod( 'woocommerce_sale_badge_percent', '-{value}%' );

    if( !$enable_sale_percent ){
        $badge = '<span class="onsale">' . esc_html( $badge_text ) . '</span>';
    }
    else{
        if( $product->is_type( 'variable' ) ){
            $percentages = array();

            // Get all variation prices
            $prices = $product->get_variation_prices();

            // Loop through variation prices
            foreach( $prices['price'] as $key => $price ){
                // Only on sale variations
                if( $prices['regular_price'][$key] !== $price ){
                    // Calculate and set in the array the percentage for each variation on sale
                    $percentages[] = round( 100 - ( floatval($prices['sale_price'][$key]) / floatval($prices['regular_price'][$key]) * 100 ) );
                }
            }
            $percentage = max( $percentages );
      
        }elseif( $product->is_type('grouped') ){
            $percentages    = array();
            $children_ids   = $product->get_children();
      
            foreach( $children_ids as $child_id ){
                $child_product = wc_get_product($child_id);
      
                $regular_price = (float) $child_product->get_regular_price();
                $sale_price    = (float) $child_product->get_sale_price();
      
                if ( $sale_price != 0 || ! empty($sale_price) ) {
                    $percentages[] = round(100 - ($sale_price / $regular_price * 100));
                }
            }
            $percentage = max($percentages) ;
        }else{
            $regular_price = (float) $product->get_regular_price();
            $sale_price    = (float) $product->get_sale_price();
      
            if( $sale_price != 0 || ! empty($sale_price) ){
                $percentage = round(100 - ($sale_price / $regular_price * 100) );
            }else{
                return $html;
            }
        }

        $percent_text = str_replace( '{value}', $percentage, $percent_text );

        $badge = '<span class="onsale">' . esc_html( $percent_text ) . '</span>';

    }
    
    return $badge;
}
add_filter( 'woocommerce_sale_flash', 'hello_shoppable_sale_badge_tag', 10, 3 );

if( !function_exists('hello_shoppable_add_woocommerce_product_class') ){
    /**
     * WooCommerce Post Class filter.
     *
     */
    function hello_shoppable_add_woocommerce_product_class( $classes, $product ){

        if( get_theme_mod( 'woocommerce_product_layout_type', 'product_layout_grid' ) == 'product_layout_grid' ){
            $classes[] = 'product-grid';
        }elseif( get_theme_mod( 'woocommerce_product_layout_type', 'product_layout_grid' ) == 'product_layout_list' ){
            $classes[] = 'product-list';
        }
        return $classes;
    }
}
add_filter( 'woocommerce_post_class', 'hello_shoppable_add_woocommerce_product_class', 10, 2 );

add_filter( 'woocommerce_single_product_zoom_options', 'hello_shoppable_single_product_zoom_options' );
if( !function_exists('hello_shoppable_single_product_zoom_options') ){
    /**
     * WooCommerce single product zoom magnification level.
     *
     */
    function hello_shoppable_single_product_zoom_options( $zoom_options ) {
        // Changing the magnification level:
        $magnification = get_theme_mod( 'single_product_iamge_magnify', 1 );
        $zoom_options['magnify'] = $magnification;

        return $zoom_options;
    }
}

/**
 * Adds rating stars even when no rating is given.
 */
function hello_shoppable_zero_woocommerce_template_loop_rating(){
    global $product;
    $count = 0;
    $rating = $product->get_average_rating();

    if ( 0 == $rating ) {
        /* translators: %s: rating */
        $label = sprintf( __( 'Rated %s out of 5', 'hello-shoppable' ), $rating );
        echo '<div class="star-rating" role="img" aria-label="' . esc_attr( $label ) . '">' . wc_get_star_rating_html( $rating, $count ) . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }
}
add_action( 'bew_woo_widget_zero_rating', 'hello_shoppable_zero_woocommerce_template_loop_rating' );