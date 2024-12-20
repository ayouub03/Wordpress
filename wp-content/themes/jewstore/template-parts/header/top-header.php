<?php 
    if (get_theme_mod( 'wpdevart_jewstore_top_header_layout') == 'phoneleft') {
    ?>
        <div class="wpdevart-top-header <?php if (empty(get_theme_mod( 'wpdevart_jewstore_top_header_bg_gradient_color' ))) 
                    { echo esc_attr( 'wpdevart-top-header-bg-color' ); } 
                    else { echo esc_attr('wpdevart-top-header-gradient-color'); } ?>
                    <?php if (get_theme_mod( 'wpdevart_jewstore_enable_top_header_border', '1' )) { } 
                    else { echo esc_attr( 'wpdevart-top-header-border' ); } ?>">

        <div class="wpdevart-top-header-section">
        <div class="wpdevart-top-header-left">
            <?php if ( get_theme_mod( 'wpdevart_jewstore_top_header_phone_number' ) OR (get_theme_mod( 'wpdevart_jewstore_top_header_phone_number' ) != '') ) { ?>
                    <span class="wpdevart-top-header-phone">
                        <span class="wpdevart-phone-email-icon">
							<svg class="top-header-icons" width="22" height="22" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
								<path d="M8.26 1.289l-1.564.772c-5.793 3.02 2.798 20.944 9.31 20.944.46 0 .904-.094 1.317-.284l1.542-.755-2.898-5.594-1.54.754c-.181.087-.384.134-.597.134-2.561 0-6.841-8.204-4.241-9.596l1.546-.763-2.875-5.612zm7.746 22.711c-5.68 0-12.221-11.114-12.221-17.832 0-2.419.833-4.146 2.457-4.992l2.382-1.176 3.857 7.347-2.437 1.201c-1.439.772 2.409 8.424 3.956 7.68l2.399-1.179 3.816 7.36s-2.36 1.162-2.476 1.215c-.547.251-1.129.376-1.733.376"/>
							</svg>
						</span>
                        <span class="wpdevart-phone-email-text"><?php echo esc_html( get_theme_mod( 'wpdevart_jewstore_top_header_phone_number' ) );  ?></span>
                    </span>
            <?php }   ?>
            <?php if ( get_theme_mod( 'wpdevart_jewstore_top_header_email' ) OR (get_theme_mod( 'wpdevart_jewstore_top_header_email' ) != '') ) { ?>
                    <span class="wpdevart-top-header-email">
                        <span class="wpdevart-phone-email-icon">
							<svg class="top-header-icons" width="22" height="22" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
								<path d="M24 21h-24v-18h24v18zm-23-16.477v15.477h22v-15.477l-10.999 10-11.001-10zm21.089-.523h-20.176l10.088 9.171 10.088-9.171z"/>
							</svg>
						</span>
                        <span class="wpdevart-phone-email-text"><?php echo esc_html( get_theme_mod( 'wpdevart_jewstore_top_header_email' ) );  ?></span>
                    </span>
            <?php }   ?>
        </div>
        <div class="wpdevart-top-header-right">
        <div class="wpdevart-top-header-right-content">
            <?php if (get_theme_mod( 'wpdevart_jewstore_top_header_disable_twitter', '1' )) { } else { ?><span class="wpdevart-social-icons"><a href="<?php echo esc_url( get_theme_mod( 'wpdevart_jewstore_top_header_twitter_url' ) );  ?>" target="_blank"></a></span> <?php }; ?>
            <?php if (get_theme_mod( 'wpdevart_jewstore_top_header_disable_facebook', '1' )) { } else { ?> <span class="wpdevart-social-icons"><a href="<?php echo esc_url( get_theme_mod( 'wpdevart_jewstore_top_header_facebook_url' ) );  ?>" target="_blank"></a></span> <?php }; ?>
            <?php if (get_theme_mod( 'wpdevart_jewstore_top_header_disable_linkedin', '1' )) { } else { ?> <span class="wpdevart-social-icons"><a href="<?php echo esc_url( get_theme_mod( 'wpdevart_jewstore_top_header_linkedin_url' ) );  ?>" target="_blank"></a></span> <?php }; ?>
            <?php if (get_theme_mod( 'wpdevart_jewstore_top_header_disable_youtube', '1' )) { } else { ?> <span class="wpdevart-social-icons"><a href="<?php echo esc_url( get_theme_mod( 'wpdevart_jewstore_top_header_youtube_url' ) );  ?>" target="_blank"></a></span> <?php }; ?>
            <?php if (get_theme_mod( 'wpdevart_jewstore_top_header_disable_instagram', '1' )) { } else { ?> <span class="wpdevart-social-icons"><a href="<?php echo esc_url( get_theme_mod( 'wpdevart_jewstore_top_header_instagram_url' ) );  ?>" target="_blank"></a></span> <?php }; ?>
            <?php if (get_theme_mod( 'wpdevart_jewstore_top_header_disable_tiktok', '1' )) { } else { ?> <span class="wpdevart-social-icons"><a href="<?php echo esc_url( get_theme_mod( 'wpdevart_jewstore_top_header_tiktok_url' ) );  ?>" target="_blank"></a></span> <?php }; ?>
            <?php if (get_theme_mod( 'wpdevart_jewstore_top_header_disable_pinterest', '1' )) { } else { ?> <span class="wpdevart-social-icons"><a href="<?php echo esc_url( get_theme_mod( 'wpdevart_jewstore_top_header_pinterest_url' ) );  ?>" target="_blank"></a></span> <?php }; ?>
        </div>
        </div>
        </div>
        </div>
    <?php  
    }  
    else if (get_theme_mod( 'wpdevart_jewstore_top_header_layout') == 'phonesocialcenter') {
    ?>
        <div class="wpdevart-top-header <?php if (empty(get_theme_mod( 'wpdevart_jewstore_top_header_bg_gradient_color' ))) 
        { echo esc_attr( 'wpdevart-top-header-bg-color' ); } 
        else { echo esc_attr('wpdevart-top-header-gradient-color'); } ?>
        <?php if (get_theme_mod( 'wpdevart_jewstore_enable_top_header_border', '1' )) { } 
        else { echo esc_attr( 'wpdevart-top-header-border' ); } ?>">
        <div class="wpdevart-top-header-section">
        <div class="wpdevart-top-header-left-content">
            <?php if ( get_theme_mod( 'wpdevart_jewstore_top_header_phone_number' ) OR (get_theme_mod( 'wpdevart_jewstore_top_header_phone_number' ) != '') ) { ?>
                    <span class="wpdevart-top-header-phone">
                        <span class="wpdevart-phone-email-icon">
							<svg class="top-header-icons" width="22" height="22" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
								<path d="M8.26 1.289l-1.564.772c-5.793 3.02 2.798 20.944 9.31 20.944.46 0 .904-.094 1.317-.284l1.542-.755-2.898-5.594-1.54.754c-.181.087-.384.134-.597.134-2.561 0-6.841-8.204-4.241-9.596l1.546-.763-2.875-5.612zm7.746 22.711c-5.68 0-12.221-11.114-12.221-17.832 0-2.419.833-4.146 2.457-4.992l2.382-1.176 3.857 7.347-2.437 1.201c-1.439.772 2.409 8.424 3.956 7.68l2.399-1.179 3.816 7.36s-2.36 1.162-2.476 1.215c-.547.251-1.129.376-1.733.376"/>
							</svg>
						</span>
                        <span class="wpdevart-phone-email-text"><?php echo esc_html( get_theme_mod( 'wpdevart_jewstore_top_header_phone_number' ) );  ?></span>
                    </span>
            <?php }   ?>
            <?php if ( get_theme_mod( 'wpdevart_jewstore_top_header_email' ) OR (get_theme_mod( 'wpdevart_jewstore_top_header_email' ) != '') ) { ?>
                    <span class="wpdevart-top-header-email">
                        <span class="wpdevart-phone-email-icon">
							<svg class="top-header-icons" width="22" height="22" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
								<path d="M24 21h-24v-18h24v18zm-23-16.477v15.477h22v-15.477l-10.999 10-11.001-10zm21.089-.523h-20.176l10.088 9.171 10.088-9.171z"/>
							</svg>
						</span>
                        <span class="wpdevart-phone-email-text"><?php echo esc_html( get_theme_mod( 'wpdevart_jewstore_top_header_email' ) );  ?></span>
                    </span>
            <?php }   ?>
        </div>
        <div class="wpdevart-top-header-right-content">
            <?php if (get_theme_mod( 'wpdevart_jewstore_top_header_disable_twitter', '1' )) { } else { ?><span class="wpdevart-social-icons"><a href="<?php echo esc_url( get_theme_mod( 'wpdevart_jewstore_top_header_twitter_url' ) );  ?>" target="_blank"></a></span> <?php }; ?>
            <?php if (get_theme_mod( 'wpdevart_jewstore_top_header_disable_facebook', '1' )) { } else { ?> <span class="wpdevart-social-icons"><a href="<?php echo esc_url( get_theme_mod( 'wpdevart_jewstore_top_header_facebook_url' ) );  ?>" target="_blank"></a></span> <?php }; ?>
            <?php if (get_theme_mod( 'wpdevart_jewstore_top_header_disable_linkedin', '1' )) { } else { ?> <span class="wpdevart-social-icons"><a href="<?php echo esc_url( get_theme_mod( 'wpdevart_jewstore_top_header_linkedin_url' ) );  ?>" target="_blank"></a></span> <?php }; ?>
            <?php if (get_theme_mod( 'wpdevart_jewstore_top_header_disable_youtube', '1' )) { } else { ?> <span class="wpdevart-social-icons"><a href="<?php echo esc_url( get_theme_mod( 'wpdevart_jewstore_top_header_youtube_url' ) );  ?>" target="_blank"></a></span> <?php }; ?>
            <?php if (get_theme_mod( 'wpdevart_jewstore_top_header_disable_instagram', '1' )) { } else { ?> <span class="wpdevart-social-icons"><a href="<?php echo esc_url( get_theme_mod( 'wpdevart_jewstore_top_header_instagram_url' ) );  ?>" target="_blank"></a></span> <?php }; ?>
            <?php if (get_theme_mod( 'wpdevart_jewstore_top_header_disable_tiktok', '1' )) { } else { ?> <span class="wpdevart-social-icons"><a href="<?php echo esc_url( get_theme_mod( 'wpdevart_jewstore_top_header_tiktok_url' ) );  ?>" target="_blank"></a></span> <?php }; ?>
            <?php if (get_theme_mod( 'wpdevart_jewstore_top_header_disable_pinterest', '1' )) { } else { ?> <span class="wpdevart-social-icons"><a href="<?php echo esc_url( get_theme_mod( 'wpdevart_jewstore_top_header_pinterest_url' ) );  ?>" target="_blank"></a></span> <?php }; ?>
        </div>
        </div>
        </div>
    <?php  
    }  
    else if (get_theme_mod( 'wpdevart_jewstore_top_header_layout') == 'phoneright') {
    ?>
        <div class="wpdevart-top-header <?php if (empty(get_theme_mod( 'wpdevart_jewstore_top_header_bg_gradient_color' ))) 
        { echo esc_attr( 'wpdevart-top-header-bg-color' ); } 
        else { echo esc_attr('wpdevart-top-header-gradient-color'); } ?>
        <?php if (get_theme_mod( 'wpdevart_jewstore_enable_top_header_border', '1' )) { } 
        else { echo esc_attr( 'wpdevart-top-header-border' ); } ?>">
        <div class="wpdevart-top-header-section">
        <div class="wpdevart-top-header-left-icons">
        <div class="wpdevart-top-header-left-icons-content">
            <?php if (get_theme_mod( 'wpdevart_jewstore_top_header_disable_twitter', '1' )) { } else { ?><span class="wpdevart-social-icons"><a href="<?php echo esc_url( get_theme_mod( 'wpdevart_jewstore_top_header_twitter_url' ) );  ?>" target="_blank"></a></span> <?php }; ?>
            <?php if (get_theme_mod( 'wpdevart_jewstore_top_header_disable_facebook', '1' )) { } else { ?> <span class="wpdevart-social-icons"><a href="<?php echo esc_url( get_theme_mod( 'wpdevart_jewstore_top_header_facebook_url' ) );  ?>" target="_blank"></a></span> <?php }; ?>
            <?php if (get_theme_mod( 'wpdevart_jewstore_top_header_disable_linkedin', '1' )) { } else { ?> <span class="wpdevart-social-icons"><a href="<?php echo esc_url( get_theme_mod( 'wpdevart_jewstore_top_header_linkedin_url' ) );  ?>" target="_blank"></a></span> <?php }; ?>
            <?php if (get_theme_mod( 'wpdevart_jewstore_top_header_disable_youtube', '1' )) { } else { ?> <span class="wpdevart-social-icons"><a href="<?php echo esc_url( get_theme_mod( 'wpdevart_jewstore_top_header_youtube_url' ) );  ?>" target="_blank"></a></span> <?php }; ?>
            <?php if (get_theme_mod( 'wpdevart_jewstore_top_header_disable_instagram', '1' )) { } else { ?> <span class="wpdevart-social-icons"><a href="<?php echo esc_url( get_theme_mod( 'wpdevart_jewstore_top_header_instagram_url' ) );  ?>" target="_blank"></a></span> <?php }; ?>
            <?php if (get_theme_mod( 'wpdevart_jewstore_top_header_disable_tiktok', '1' )) { } else { ?> <span class="wpdevart-social-icons"><a href="<?php echo esc_url( get_theme_mod( 'wpdevart_jewstore_top_header_tiktok_url' ) );  ?>" target="_blank"></a></span> <?php }; ?>
            <?php if (get_theme_mod( 'wpdevart_jewstore_top_header_disable_pinterest', '1' )) { } else { ?> <span class="wpdevart-social-icons"><a href="<?php echo esc_url( get_theme_mod( 'wpdevart_jewstore_top_header_pinterest_url' ) );  ?>" target="_blank"></a></span> <?php }; ?>
        </div>
        </div>
        <div class="wpdevart-top-header-right-content">
            <?php if ( get_theme_mod( 'wpdevart_jewstore_top_header_phone_number' ) OR (get_theme_mod( 'wpdevart_jewstore_top_header_phone_number' ) != '') ) { ?>
                    <span class="wpdevart-top-header-phone">
                        <span class="wpdevart-phone-email-icon">
							<svg class="top-header-icons" width="22" height="22" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
								<path d="M8.26 1.289l-1.564.772c-5.793 3.02 2.798 20.944 9.31 20.944.46 0 .904-.094 1.317-.284l1.542-.755-2.898-5.594-1.54.754c-.181.087-.384.134-.597.134-2.561 0-6.841-8.204-4.241-9.596l1.546-.763-2.875-5.612zm7.746 22.711c-5.68 0-12.221-11.114-12.221-17.832 0-2.419.833-4.146 2.457-4.992l2.382-1.176 3.857 7.347-2.437 1.201c-1.439.772 2.409 8.424 3.956 7.68l2.399-1.179 3.816 7.36s-2.36 1.162-2.476 1.215c-.547.251-1.129.376-1.733.376"/>
							</svg>
						</span>
                        <span class="wpdevart-phone-email-text"><?php echo esc_html( get_theme_mod( 'wpdevart_jewstore_top_header_phone_number' ) );  ?></span>
                    </span>
            <?php }   ?>
            <?php if ( get_theme_mod( 'wpdevart_jewstore_top_header_email' ) OR (get_theme_mod( 'wpdevart_jewstore_top_header_email' ) != '') ) { ?>
                    <span class="wpdevart-top-header-email">
                        <span class="wpdevart-phone-email-icon">
							<svg class="top-header-icons" width="22" height="22" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
								<path d="M24 21h-24v-18h24v18zm-23-16.477v15.477h22v-15.477l-10.999 10-11.001-10zm21.089-.523h-20.176l10.088 9.171 10.088-9.171z"/>
							</svg>
						</span>
                        <span class="wpdevart-phone-email-text"><?php echo esc_html( get_theme_mod( 'wpdevart_jewstore_top_header_email' ) );  ?></span>
                    </span>
            <?php }   ?>
        </div>
        </div>
        </div>
    <?php  
    }  
?>