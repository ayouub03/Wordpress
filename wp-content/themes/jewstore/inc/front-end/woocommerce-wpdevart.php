<?php 
    function wc_add_classes_summary_before_img () {
        if ( ( is_shop() || is_product_category() || is_product_tag() ) ) {
            ?>
                <div class="productslistimage">
            <?php
        }
    }
    add_action( 'woocommerce_before_shop_loop_item', 'wc_add_classes_summary_before_img');
    function wc_close_div_after_summary_img () {
        if ( ( is_shop() || is_product_category() || is_product_tag() ) ) {
            ?>
                </div>
            <?php
        }
    }
    add_action( 'woocommerce_before_shop_loop_item_title', 'wc_close_div_after_summary_img' );

    add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 10 );
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
	
    function wpdevart_jewstore_woo_enqueue() {
        wp_enqueue_style('wpdevart_jewstore_woocommerce_styles', get_theme_file_uri('/assets/css/front-end/wpdevart-woocommerce.css'));
    }
    add_action('wp_enqueue_scripts', 'wpdevart_jewstore_woo_enqueue');
    function wpdevart_jewstore_woo_footer_style() {
		wp_enqueue_style('wpdevart-woo-footer-styles', get_theme_file_uri('/assets/css/front-end/wpdevart-woocommerce-additional.css'));
	};
	add_action( 'get_footer', 'wpdevart_jewstore_woo_footer_style' );

    
    add_filter( 'body_class','wpdevart_jewstore_body_class' );
    function wpdevart_jewstore_body_class( $classes ) {
        if ( wpdevart_jewstore_is_woocommerce_activated() ) {
            $classes[] = 'woocommerce';
        }
        return $classes;
    }
    if ( ! function_exists( 'wpdevart_jewstore_is_woocommerce_activated' ) ) {
        function wpdevart_jewstore_is_woocommerce_activated() {
            if ( class_exists( 'woocommerce' ) ) { return true; } else { return false; }
        }
    }
    add_action( 'wp_enqueue_scripts', 'wpdevart_jewstore_custom_enqueue_wc_cart_fragments' );
    function wpdevart_jewstore_custom_enqueue_wc_cart_fragments() {
        wp_enqueue_script( 'wc-cart-fragments' );
    }
    add_filter( 'woocommerce_add_to_cart_fragments', 'wpdevart_jewstore_mini_cart_count');
    function wpdevart_jewstore_mini_cart_count($fragments){
        ob_start();
        ?>
        <div id="mini-cart-count">
            <?php echo esc_html(WC()->cart->get_cart_contents_count()); ?>
        </div>
        <?php
            $fragments['#mini-cart-count'] = ob_get_clean();
        return $fragments;
    }

    add_filter( 'woocommerce_add_to_cart_fragments', 'wpdevart_jewstore_refresh_cart_total');
    function wpdevart_jewstore_refresh_cart_total( $fragments ) {
            ob_start();
        ?>
            <div id="mini-cart-total">
                <?php echo esc_html_e('Total', 'jewstore'); ?>
                    <div class="clear"></div>
                    <?php echo wp_kses_post(WC()->cart->get_cart_total()); ?>
            </div>
            <?php
                    $fragments['#mini-cart-total'] = ob_get_clean();
            return $fragments;
    }
    if ( !function_exists( 'wpdevart_jewstore_header_cart_layout_one' ) ) {
        function wpdevart_jewstore_header_cart_layout_one() {
            if (!is_cart() && !is_checkout()) { ?>
                <div class="wpdevart-shopping-cart">
                    <?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
                </div>
            <?php }
        }
    }
    if ( !function_exists( 'wpdevart_jewstore_header_add_to_cart_fragment_one' ) ) {
        function wpdevart_jewstore_header_add_to_cart_fragment_one( $fragments ) {
            ob_start();
            wpdevart_jewstore_header_cart_layout_one();
            $fragments['a.wpdevart-shopping-cart'] = ob_get_clean();
            return $fragments;
        }
        add_filter( 'woocommerce_add_to_cart_fragments', 'wpdevart_jewstore_header_add_to_cart_fragment_one' );
    }
    if ( !function_exists( 'wpdevart_jewstore_header_cart_layout_two' ) ) {
        function wpdevart_jewstore_header_cart_layout_two() {
            if (!is_cart() && !is_checkout()) { ?>
                <div class="wpdevart-shopping-cart wpdevart-shopping-cart-layout-two <?php if ( (get_theme_mod('header_text') != 0) && (get_bloginfo('description') != '') ) { echo esc_attr('wpdevart-shopping-cart-layout-two-move'); } ?>">
                    <?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
                </div>
            <?php }
        }
    }
    if ( !function_exists( 'wpdevart_jewstore_header_add_to_cart_fragment_two' ) ) {
        function wpdevart_jewstore_header_add_to_cart_fragment_two( $fragments ) {
            ob_start();
            wpdevart_jewstore_header_cart_layout_two();
            $fragments['a.wpdevart-shopping-cart'] = ob_get_clean();
            return $fragments;
        }
        add_filter( 'woocommerce_add_to_cart_fragments', 'wpdevart_jewstore_header_add_to_cart_fragment_two' );
    }