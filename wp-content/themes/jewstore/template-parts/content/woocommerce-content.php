<div class="wpdevart-woo-container">
    <div class="main-woo-container <?php if (( get_theme_mod( 'wpdevart_jewstore_woocommerce_cart_checkout_account_layout' ) != 'sidebarnone' ) && ( get_theme_mod( 'wpdevart_jewstore_woocommerce_cart_checkout_account_layout' ) == 'sidebarleft' ))
                                                { echo esc_attr('woo-container-with-sidebar wpdevart-woo-main-content-sidebarleft'); } 
                                                    else if (( get_theme_mod( 'wpdevart_jewstore_woocommerce_cart_checkout_account_layout' ) != 'sidebarnone' ) && ( get_theme_mod( 'wpdevart_jewstore_woocommerce_cart_checkout_account_layout' ) != 'sidebarleft' )) 
                                                        { echo esc_attr('woo-container-with-sidebar'); } 
                                                            ?> wpdevart-woo-main-content" id="content_navigator">
        <div role="main" class="<?php  if ( get_theme_mod( 'wpdevart_jewstore_woocommerce_cart_checkout_account_layout' ) == 'sidebarnone' ) { echo esc_attr('wpdevart-woo-product-list-full-width'); } else { echo esc_attr('wpdevart-woo-product-list-with-sidebar'); } ?>">
                <div class="woocommerce">
                    <h1 class="page-banner__title"><?php the_title(); ?></h1>
                    <?php the_content(); ?> 
                    <div class="wpdevart-wp-link-pages">
                        <?php wp_link_pages( array(
                            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'jewstore' ),
                            'after'  => '</div>',
                            ) );
                        ?>
                    </div>
                </div>
        </div>
        <?php  if ( get_theme_mod( 'wpdevart_jewstore_woocommerce_cart_checkout_account_layout' ) != 'sidebarnone' ) 
                    { get_template_part( 'template-parts/sidebar/sidebar-woo-wpdevart' ); } ?>
    </div>
</div>