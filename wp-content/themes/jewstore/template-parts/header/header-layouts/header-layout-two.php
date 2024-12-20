<div class="wpdevart-header-container">
        <div class="wpdevart-main-header-section-layouttwo">
			<div class="wpdevart-logo-area-layouttwo">
				<?php
				if ( has_custom_logo() && is_front_page()) {
					?><h1 class="wpdevart-header-logo-spaces-layouttwo"><a href="<?php echo esc_url(home_url()) ?>"><?php the_custom_logo() ?></a></h1><?php 
                }
				else if ( has_custom_logo() && !is_front_page()) {
					?><h2 class="wpdevart-header-logo-spaces-layouttwo"><a href="<?php echo esc_url(home_url()) ?>"><?php the_custom_logo() ?></a></h2><?php 
                }
				else if ( !has_custom_logo() && is_front_page() && get_theme_mod( 'wpdevart_jewstore_header_logo_gradient_color' )) {
					?><h1 class="wpdevart-logo-text-layouttwo-gradient"><a href="<?php echo esc_url(home_url()) ?>"><?php echo get_bloginfo('name') ?></a></h1><?php 
                }
				else if ( !has_custom_logo() && is_front_page() && empty(get_theme_mod( 'wpdevart_jewstore_header_logo_gradient_color' ))) {
					?><h1 class="wpdevart-logo-text-layouttwo"><a href="<?php echo esc_url(home_url()) ?>" class="wpdevart-logo-text-layouttwo-simple"><?php echo get_bloginfo('name') ?></a></h1><?php 
                }
				else if ( !has_custom_logo() && !is_front_page() && get_theme_mod( 'wpdevart_jewstore_header_logo_gradient_color' )) {
					?><h2 class="wpdevart-logo-text-layouttwo-gradient"><a href="<?php echo esc_url(home_url()) ?>"><?php echo get_bloginfo('name') ?></a></h2><?php 
                }
				else if ( !has_custom_logo() && !is_front_page() && empty(get_theme_mod( 'wpdevart_jewstore_header_logo_gradient_color' ))) {
					?><h2 class="wpdevart-logo-text-layouttwo"><a href="<?php echo esc_url(home_url()) ?>" class="wpdevart-logo-text-layouttwo-simple"><?php echo get_bloginfo('name') ?></a></h2><?php 
                }
                if ( (get_theme_mod('header_text') != 0) && (get_bloginfo('description') != '') ) { ?>
                    <p class="wpdevart-site-description wpdevart-site-description-layout-two"><?php echo get_bloginfo('description') ?></p><?php 
                }
				?>
			</div>
        </div>
        <?php if (get_theme_mod( 'wpdevart_jewstore_header_show_action_button', '1' )) { } else { ?>
        <div class="header-action-button-mobile-area-layouttwo">
        <a href="<?php echo esc_url( get_theme_mod( 'wpdevart_jewstore_header_action_button_url' ) );  ?>"><div class="wpdevart_jewstore_hover_button_small wpdevart-header-action-button <?php echo esc_attr( get_theme_mod( 'wpdevart_jewstore_header_action_button_style' ) ); ?>"><?php echo esc_html( get_theme_mod( 'wpdevart_jewstore_header_action_button_text' ) );  ?></div></a>
        </div>
        <?php } ?>
        <div class="wpdevart-menu-and-buttons-container-layouttwo">
        <div role="navigation" class="nav-container">
				<?php if ( class_exists( 'WooCommerce' ) ) { ?>
					<div class="header-woo-account-icon-mobile">
						<a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>">
                            <svg class="wpdevart-woo-account-icon" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                viewBox="0 0 30 21" enable-background="new 0 0 30 21" xml:space="preserve">
                                <path d="M23.762,23.039c-0.703-4.359-3.769-7.773-7.771-9.053c1.963-1.255,3.27-3.449,3.27-5.947
                                c0-3.893-3.167-7.06-7.06-7.06s-7.06,3.167-7.06,7.06c0,2.58,1.395,4.834,3.466,6.066c-3.822,1.367-6.721,4.708-7.402,8.934
                                l-0.158,0.982h22.874L23.762,23.039z M6.836,8.039c0-2.959,2.407-5.366,5.366-5.366s5.366,2.407,5.366,5.366
                                s-2.407,5.366-5.366,5.366S6.836,10.998,6.836,8.039z M3.088,22.326c1.128-4.227,4.933-7.201,9.396-7.201s8.268,2.973,9.396,7.201
                                H3.088z"/>
                            </svg>						
						</a> 
					</div>
				<?php } ?>
                <div class="wpdevart-search-button-icon-mobile">
                    <button onClick="wpdevartToggleModalSmall()" type="button" id="wpdevartsmallsearchbutton" class="site-header__search-trigger search-menu-buttons">
                        <svg class="site-header__search-trigger site-header-font-cursor" viewBox="0 0 25 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.61667 13.9833C11.1329 13.9833 13.9833 11.1329 13.9833 7.61667C13.9833 4.10045 11.1329 1.25 7.61667 1.25C4.10045 1.25 1.25 4.10045 1.25 7.61667C1.25 11.1329 4.10045 13.9833 7.61667 13.9833Z" class="site-header__search-trigger" stroke-width="1.5" stroke-miterlimit="10"></path>
                            <path d="M18.75 18.75L11.9917 11.9917" class="site-header__search-trigger" stroke-width="1.5" stroke-miterlimit="10"></path>
                        </svg>
					</button>
                </div>
				<nav class="navbar-wpdevart navbar-wpdevart-float" id="wpdevartmobilemenu">
                <div id="head-mobile" class="<?php if (empty(get_theme_mod( 'wpdevart_jewstore_mobile_menu_bg_gradient_color' ))) 
                                            { echo esc_attr( 'head-mobile-toolbar' ); } 
                                            else { echo esc_attr('head-mobile-toolbar-gradient'); } ?>"></div>
                <button onClick="wpdevartMenuToggleModal()" id="wpdevartOpenMenuButton" class="wpdevartmobilemenubutton wpdevart-mobile-icon-button"></button>
                    <?php
                            if ( has_nav_menu( 'primary_menu' ) ) {
                            wp_nav_menu(
                                array(
                                'theme_location' => 'primary_menu',
                                'container' => false,
                                'walker' => new Wpdevart_Walker_Nav_Primary(),
                                )
                            );
                            }
							else {
                                wp_nav_menu(
                                    array(
                                    'theme_location' => 'primary_menu',
                                    'container' => 'ul',
                                    'menu_class'     => 'simple-navbar-wpdevart',
                                    'depth'                => 1,
                                    )
                                );
                                }
                    ?>
            </nav>
        </div>
        <div class="wpdevart-search-and-button-container-layouttwo">
            <?php if ( class_exists( 'WooCommerce' ) ) { ?>
                    <div class="header-woo-account-icon">
                        <a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>">
                            <svg class="wpdevart-woo-account-icon" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                viewBox="0 0 30 21" enable-background="new 0 0 30 21" xml:space="preserve">
                                <path d="M23.762,23.039c-0.703-4.359-3.769-7.773-7.771-9.053c1.963-1.255,3.27-3.449,3.27-5.947
                                c0-3.893-3.167-7.06-7.06-7.06s-7.06,3.167-7.06,7.06c0,2.58,1.395,4.834,3.466,6.066c-3.822,1.367-6.721,4.708-7.402,8.934
                                l-0.158,0.982h22.874L23.762,23.039z M6.836,8.039c0-2.959,2.407-5.366,5.366-5.366s5.366,2.407,5.366,5.366
                                s-2.407,5.366-5.366,5.366S6.836,10.998,6.836,8.039z M3.088,22.326c1.128-4.227,4.933-7.201,9.396-7.201s8.268,2.973,9.396,7.201
                                H3.088z"/>
                            </svg>
						</a> 
                    </div>
                    <div class="header-cart-layout-two">
                        <a class="cart-customlocation" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'jewstore' ); ?>">
                            <svg class="wpdevart-woo-icon" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                viewBox="-3 0 30 21" enable-background="new 0 0 30 21" xml:space="preserve">
                                <path d="M23.953,6.808h-4.348C19.09,3.523,16.249,1,12.822,1S6.554,3.523,6.039,6.808H1.052l0.01,13.225
                                C1.062,22.22,2.841,24,5.029,24h15.003C22.22,24,24,22.22,24,20.028L23.953,6.808z M12.822,3c2.321,0,4.26,1.633,4.749,3.808H8.073
                                C8.562,4.633,10.501,3,12.822,3z M20.032,22.016H5.029c-1.094,0-1.984-0.89-1.984-1.984L3.036,8.792h2.911V12h2V8.792h9.75v3.24h2
                                v-3.24h2.26l0.059,11.241C22.016,21.126,21.126,22.016,20.032,22.016z"/>
                            </svg>
						<span class="custom-cart-count"><div id="mini-cart-count"></div></span> </a> 
						<?php wpdevart_jewstore_header_cart_layout_two() ?>
                    </div>   
            <?php } ?>
            <button onClick="wpdevartToggleModal()" type="button" id="wpdevartwidesearchbutton" class="search-trigger-layout-two search-menu-buttons">
                <svg class="search-trigger-layout-two" viewBox="0 0 25 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.61667 13.9833C11.1329 13.9833 13.9833 11.1329 13.9833 7.61667C13.9833 4.10045 11.1329 1.25 7.61667 1.25C4.10045 1.25 1.25 4.10045 1.25 7.61667C1.25 11.1329 4.10045 13.9833 7.61667 13.9833Z" class="search-trigger-layout-two" stroke-width="1.5" stroke-miterlimit="10"></path>
                    <path d="M18.75 18.75L11.9917 11.9917" class="search-trigger-layout-two" stroke-width="1.5" stroke-miterlimit="10"></path>
                </svg>
			</button>
            <?php if (get_theme_mod( 'wpdevart_jewstore_header_show_action_button', '1' )) { } else { ?>
                <div class="header-action-button-area-layouttwo">
                <a href="<?php echo esc_url( get_theme_mod( 'wpdevart_jewstore_header_action_button_url' ) );  ?>"><div class="wpdevart_jewstore_hover_button_small wpdevart-header-action-button <?php echo esc_attr( get_theme_mod( 'wpdevart_jewstore_header_action_button_style' ) ); ?>"><?php echo esc_html( get_theme_mod( 'wpdevart_jewstore_header_action_button_text' ) );  ?></div></a>
                </div>
            <?php } ?>
    </div>
    </div>
</div>