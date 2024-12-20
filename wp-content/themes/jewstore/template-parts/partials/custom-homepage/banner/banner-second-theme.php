<div class="wpdevart-homepage-page-banner 
          <?php if (empty(get_theme_mod( 'wpdevart_jewstore_homepage_large_banner_bg_gradient_color' ))) 
                { echo esc_attr( 'wpdevart-homepage-bg-color' ); } 
                else { echo esc_attr('wpdevart-homepage-bg-gradient-color'); } ?>" id="content_navigator">
    <div class="wpdevart-homepage-container">
        <div class="wpdevart-home-banner">
            <div class="wpdevart-home-banner-one-second-theme">
              <div class="wpdevart-home-banner-inner">

              <div class="wpdevart-banner-short-text"><?php echo esc_html( get_theme_mod( 'wpdevart_jewstore_custom_homepage_banner_short_description' ) );  ?></div>
              <div class="wpdevart-banner-title"><?php echo esc_html( get_theme_mod( 'wpdevart_jewstore_custom_homepage_banner_title' ) ); ?></div>

              <?php if ( empty(get_theme_mod( 'wpdevart_jewstore_custom_homepage_banner_sliding_first_text' )) && empty(get_theme_mod( 'wpdevart_jewstore_custom_homepage_banner_sliding_second_text' )) && empty(get_theme_mod( 'wpdevart_jewstore_custom_homepage_banner_sliding_third_text' )) && empty(get_theme_mod( 'wpdevart_jewstore_custom_homepage_banner_sliding_fourth_text' )) ) { } else { ?>

                    <div class="sliding-text-container">
                      <div class="sliding-text">
                        <ul>
                          <?php if (!empty(get_theme_mod( 'wpdevart_jewstore_custom_homepage_banner_sliding_first_text' ))) { ?><li><?php echo esc_html( get_theme_mod( 'wpdevart_jewstore_custom_homepage_banner_sliding_first_text' ) ) ?></li><?php } ?>
                          <?php if (!empty(get_theme_mod( 'wpdevart_jewstore_custom_homepage_banner_sliding_second_text' ))) { ?><li><?php echo esc_html( get_theme_mod( 'wpdevart_jewstore_custom_homepage_banner_sliding_second_text' ) ) ?></li><?php } ?>
                          <?php if (!empty(get_theme_mod( 'wpdevart_jewstore_custom_homepage_banner_sliding_third_text' ))) { ?><li><?php echo esc_html( get_theme_mod( 'wpdevart_jewstore_custom_homepage_banner_sliding_third_text' ) ) ?></li><?php } ?>
                          <?php if (!empty(get_theme_mod( 'wpdevart_jewstore_custom_homepage_banner_sliding_fourth_text' ))) { ?><li><?php echo esc_html( get_theme_mod( 'wpdevart_jewstore_custom_homepage_banner_sliding_fourth_text' ) ) ?></li><?php } ?>
                        </ul>
                      </div>
                    </div>

              <?php } ?>

              <div class="wpdevart-banner-content"><?php echo esc_html( get_theme_mod( 'wpdevart_jewstore_custom_homepage_banner_content' ) );  ?></div>
              
              <div id="outer">
                  <?php if (get_theme_mod( 'wpdevart_jewstore_custom_homepage_show_banner_first_button', '1' )) { } else { 
                    ?><a href="<?php echo esc_url( get_theme_mod( 'wpdevart_jewstore_custom_homepage_banner_first_button_url' ) );  ?>"><div class="wpdevart_jewstore_hover_button wpdevart-banner-button-one <?php echo esc_html( get_theme_mod( 'wpdevart_jewstore_custom_homepage_banner_first_button_style' ) ); ?>"><?php echo esc_html( get_theme_mod( 'wpdevart_jewstore_custom_homepage_banner_first_button_text' ) );  ?></div></a>
                  <?php } ?>
                  <?php if (get_theme_mod( 'wpdevart_jewstore_custom_homepage_show_banner_second_button', '1' )) { } else { 
                    ?> <a href="<?php echo esc_url( get_theme_mod( 'wpdevart_jewstore_custom_homepage_banner_second_button_url' ) );  ?>"><div class="wpdevart_jewstore_hover_button wpdevart-banner-button-two <?php echo esc_html( get_theme_mod( 'wpdevart_jewstore_custom_homepage_banner_second_button_style' ) ); ?>"><?php echo esc_html( get_theme_mod( 'wpdevart_jewstore_custom_homepage_banner_second_button_text' ) );  ?></div></a>
                  <?php } ?>
              </div>

              </div>
            </div>

            <div class="wpdevart-home-banner-two">
                <div class="wpdevart-home-banner-inner">
                    <div class="wpdevart-banner-image-wrapper">
                        <div class="wpdevart-banner-second-theme-image">
                            <?php 
                                if ( ! get_theme_mod( 'wpdevart_jewstore_custom_homepage_banner_image_1' )) { } else { ?>
                                <img src="<?php echo esc_url( get_theme_mod( 'wpdevart_jewstore_custom_homepage_banner_image_1' ) ); ?>">
                                <?php }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>