<footer class="<?php 
                    if (!get_theme_mod( 'wpdevart_jewstore_footer_template' )) { echo esc_attr('wpdevart-footer-one'); }
                    $wpdevartFooterStyle = get_theme_mod( 'wpdevart_jewstore_footer_template' ); echo esc_attr($wpdevartFooterStyle);
                ?>">
				
			<?php if ( get_theme_mod( 'wpdevart_jewstore_pre_footer_wave_display_option' ) == '1' ) { ?>	
				<div class="footer-one-pre">
				</div>
			<?php }
			
            if ( ( is_active_sidebar( 'wpdevart_jewstore_footer_large_widget' ) ) OR ( is_active_sidebar( 'wpdevart_jewstore_footer_widget_01' ) ) OR ( is_active_sidebar( 'wpdevart_jewstore_footer_widget_02' ) ) ) { ?>

                <div class="wpdevart-footer-container">

                        <div class="site-footer__col-two-layout-two">
                        <div class="wpdevart-widgets-inner">
                        <?php        
                                if ( is_active_sidebar( 'wpdevart_jewstore_footer_widget_01' ) ) {
                                    dynamic_sidebar( 'wpdevart_jewstore_footer_widget_01' ); 
                                }
                        ?>
                        </div>
                        </div>

                        <div class="site-footer__col-one">
                        <div class="wpdevart-widgets-inner">
                        <?php
                                if ( is_active_sidebar( 'wpdevart_jewstore_footer_large_widget' ) ) {
                                    dynamic_sidebar( 'wpdevart_jewstore_footer_large_widget' ); 
                                }
                        ?>
                        </div>
                        </div>


                        <div class="site-footer__col-three-layout-two">
                        <div class="wpdevart-widgets-inner">
                        <?php
                                if ( is_active_sidebar( 'wpdevart_jewstore_footer_widget_02' ) ) {
                                    dynamic_sidebar( 'wpdevart_jewstore_footer_widget_02' ); 
                                } 
                        ?>    
                        </div>
                        </div>

                </div>

            <?php } ?>

			<div class="<?php if ( get_theme_mod( 'wpdevart_jewstore_footer_image_display_option' ) == '1' ) {echo esc_attr( 'wpdevart-footer-copyright-text' );} else {echo esc_attr( 'wpdevart-footer-copyright-only-text' );} ?>">
				<?php
				$wpdevartFooterOption = get_theme_mod( 'wpdevart_jewstore_footer_copyright_text' );
				$wpdevartFooterWP = sprintf( esc_html__( ' %s Powered by WordPress.', 'jewstore' ), '<a target="_blank" title="'. apply_filters( 'parent_wpdevart_child_footer_url_title', esc_html('WordPress JewStore Theme')) .'" href="'. apply_filters( 'parent_wpdevart_child_wp_page_url', esc_url('https://wordpress.org/themes/jewstore')) .'">'. apply_filters( 'parent_wpdevart_child_footer_url_text', esc_html('Jewelry Store')) .'</a>' );
				?>
				<p><?php echo esc_html($wpdevartFooterOption); echo $wpdevartFooterWP; ?></p>
			</div>

</footer>