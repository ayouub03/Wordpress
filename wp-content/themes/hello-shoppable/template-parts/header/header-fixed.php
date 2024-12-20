<div class="fixed-header">
	<div class="container">
		<div class="fixed-header-inner d-flex align-items-center justify-content-between">
			<div class="site-navigation-container d-flex align-items-center flex-grow-1">
				<?php
				if ( get_theme_mod( 'enable_header_woo_cat_menu', true ) && get_theme_mod( 'fixed_header_category_menu', false ) ) {
					if ( has_nav_menu( 'menu-4' ) ) {
						?>
						<nav class="header-category-nav d-none d-lg-block">
				            <ul class="nav navbar-nav navbar-left">
				                <li class="menu-item menu-item-has-children">
				                    <a href="#">
				                    	<span class="menu-icon">
				                    		<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
												 width="32px" height="20px" viewBox="0 0 32 20" enable-background="new 0 0 32 20" xml:space="preserve">
												<path fill="#313131" d="M29.958,4.141H2.042C1.466,4.141,1,3.47,1,2.641s0.466-1.5,1.042-1.5h27.917c0.575,0,1.042,0.672,1.042,1.5
													S30.533,4.141,29.958,4.141z"/>
												<path fill="#313131" d="M29.958,11.503H2.042c-0.575,0-1.042-0.672-1.042-1.5c0-0.828,0.466-1.5,1.042-1.5h27.917
													c0.575,0,1.042,0.672,1.042,1.5C31,10.831,30.533,11.503,29.958,11.503z"/>
												<path fill="#313131" d="M29.958,18.864H2.042c-0.575,0-1.042-0.672-1.042-1.5s0.466-1.5,1.042-1.5h27.917
													c0.575,0,1.042,0.672,1.042,1.5S30.533,18.864,29.958,18.864z"/>
											</svg>
				                    	</span>
				                    	<span class="category-menu-label d-none">
				                        	<?php echo esc_html( get_theme_mod( 'header_woo_cat_menu_label', '' ) ); ?>
				                        </span>
				                    </a>
				                    <?php
				                    wp_nav_menu(array(
				                        'container'      => '',
										'theme_location' => 'menu-4',
										'menu_id'        => 'woo-cat-menu',
										'menu_class' => 'dropdown-menu',
				                    ));
				                    ?>
				                </li>
				            </ul>
				        </nav>
            		<?php
            		} else {
            			if( class_exists( 'WooCommerce' ) ){
            				$categories = get_categories( 'taxonomy=product_cat' );
        					if( is_array( $categories ) && !empty( $categories ) ){
        						?>
				                <nav class="header-category-nav d-none d-lg-block">
				                	<ul class="nav navbar-nav navbar-left">
						                <li class="menu-item menu-item-has-children">
						                    <a href="#">
						                    	<span class="menu-icon">
						                    		<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
													 width="32px" height="20px" viewBox="0 0 32 20" enable-background="new 0 0 32 20" xml:space="preserve">
														<path fill="#313131" d="M29.958,4.141H2.042C1.466,4.141,1,3.47,1,2.641s0.466-1.5,1.042-1.5h27.917c0.575,0,1.042,0.672,1.042,1.5
															S30.533,4.141,29.958,4.141z"/>
														<path fill="#313131" d="M29.958,11.503H2.042c-0.575,0-1.042-0.672-1.042-1.5c0-0.828,0.466-1.5,1.042-1.5h27.917
															c0.575,0,1.042,0.672,1.042,1.5C31,10.831,30.533,11.503,29.958,11.503z"/>
														<path fill="#313131" d="M29.958,18.864H2.042c-0.575,0-1.042-0.672-1.042-1.5s0.466-1.5,1.042-1.5h27.917
															c0.575,0,1.042,0.672,1.042,1.5S30.533,18.864,29.958,18.864z"/>
													</svg>
						                    	</span>
						                        <span class="category-menu-label d-none">
						                        	<?php echo esc_html( get_theme_mod( 'header_woo_cat_menu_label', '' ) ); ?>
						                        </span>
						                    </a>
						                    <ul class="menu-categories-menu dropdown-menu">
						                        <?php
						                        foreach( $categories as $category ) {
						                            $category_permalink = get_category_link( $category->cat_ID );
						                            ?>
						                            <li class="menu-item <?php echo esc_attr( $category->category_nicename ); ?>">
						                            	<a href="<?php echo esc_url( $category_permalink ); ?>">
						                            		<?php echo esc_html( $category->cat_name ); ?>
						                            	</a>
						                            </li>  
						                        <?php } ?>
						                    </ul>
						                </li>
						            </ul>
				                </nav>
				        		<?php
				        	}
			        	}
			        }
		        }
		        ?>
		        <div class="site-branding">
			        <?php 
					if ( get_theme_mod( 'fixed_header_logo', true ) ) {
						$the_custom_logo_url = hello_shoppable_get_custom_logo_url();
						if ( $the_custom_logo_url !== '' ) {
							?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
								<img src="<?php echo esc_url(  $the_custom_logo_url ); ?>" id="headerLogo">
							</a>
							<?php
						}
					}
					
					if ( get_theme_mod( 'fixed_header_title', true ) ) { 
						if( get_theme_mod( 'site_title', true ) ){
							if ( is_front_page() && is_home() ) {
								?>
								<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
								<?php
							} else {
								?>
								<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
								<?php
							}
						}
					}
					
					if ( get_theme_mod( 'fixed_header_tagline', false ) ) { 
						$hello_shoppable_description = get_bloginfo( 'description', 'display' );
						if( get_theme_mod( 'site_tagline', true ) ){
							if ( $hello_shoppable_description ) {
								?>
								<p class="site-description"><?php echo esc_html($hello_shoppable_description); ?></p>
								<?php
							}
						}
					}
					?>
				</div>
		        <?php if ( get_theme_mod ( 'fixed_header_main_menu', true ) ) { ?>
			        <nav id="site-navigation" class="main-navigation d-none d-lg-flex flex-grow-1 <?php echo esc_attr( hello_shoppable_primary_menu_alignment() ); ?>">
						<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'hello-shoppable' ); ?></button>
						<?php
						if ( has_nav_menu( 'menu-1' ) ) :
							wp_nav_menu( 
								array(
									'container'      => '',
									'theme_location' => 'menu-1',
									'menu_id'        => 'fixed-primary-menu',
									'menu_class'     => 'menu nav-menu',
								)
							);
						else :
							wp_page_menu(
								array(
									'menu_class' => 'menu-wrap',
									'before'     => '<ul id="fixed-primary-menu" class="menu nav-menu">',
									'after'      => '</ul>',
								)
							);
						endif;
						?>
					</nav><!-- #site-navigation -->
				<?php } ?>	
	        </div>
	        <div class="header-right-wrap">
			    <div class="header-right d-flex align-items-center">
			    	<div class="fixed-menu-container d-inline-block"></div>
			        <!-- Search form structure -->
					<?php 
					if( get_theme_mod( 'enable_search_icon', true ) && get_theme_mod( 'fixed_header_search_icon', true ) ): 
					?>
						<div id="search-form" class="header-search-wrap d-inline-block">
							<button class="fixed-search-icon">
								<svg version="1.1" id="Layer_1" x="0px" y="0px" width="25px" height="25px" viewBox="0 0 25 25" enable-background="new 0 0 25 25" xml:space="preserve">
									<g>
										<path fill="#333333" d="M24.362,23.182l-6.371-6.368c1.448-1.714,2.325-3.924,2.325-6.337c0-5.425-4.413-9.838-9.838-9.838
											c-5.425,0-9.838,4.413-9.838,9.838c0,5.425,4.413,9.838,9.838,9.838c2.412,0,4.621-0.876,6.334-2.321l6.372,6.368L24.362,23.182z
											 M2.326,10.477c0-4.495,3.656-8.151,8.151-8.151c4.495,0,8.151,3.656,8.151,8.151s-3.656,8.151-8.151,8.151
											C5.982,18.627,2.326,14.971,2.326,10.477z"/>
									</g>
								</svg>
							</button>
						</div>
					<?php endif; ?>
					<div class="woo-header-icon d-none d-lg-block">
						<?php 
						if ( class_exists( 'WooCommerce' ) ) {
							if ( get_theme_mod( 'fixed_header_wooCommerce_compare', true ) ) { 
							
						        if( get_theme_mod( 'woocommerce_compare', true ) ){
						        	hello_shoppable_head_compare();
					        	}
					     	} 
						    if ( get_theme_mod( 'fixed_header_wooCommerce_wishlist', true ) ) { 
						        if( get_theme_mod( 'woocommerce_wishlist', true ) ){
						        	hello_shoppable_head_wishlist();
					        	}
					        }
						    if ( get_theme_mod( 'fixed_header_wooCommerce_myaccount', true ) ) { 
						        if( get_theme_mod( 'woocommerce_account', true ) ){
						        	hello_shoppable_my_account();
					        	}
					        }
						    if ( get_theme_mod( 'fixed_header_wooCommerce_cart', true ) ) {     
						        if( get_theme_mod( 'woocommerce_cart', true ) ) {
						        	hello_shoppable_header_cart();
					        	}
					        }
					    }
					    ?>
					</div>
			    </div>
			</div>
			<?php 
			if( get_theme_mod( 'header_button', true ) && get_theme_mod( 'fixed_header_button', false ) && !empty( get_theme_mod( 'header_button_text', '' ) ) ){ 
				?>
				<div class="header-btn d-none d-lg-block">
					<?php hello_shoppable_header_buttons(); ?>
				</div>
			<?php } ?>
		</div>
	</div><!-- header search form -->
	<div class="fixed-header-search">
		<div class="container">
			<div class="fixed-header-search-inner">
				<?php
				if( class_exists('WooCommerce' ) && function_exists( 'header_woocommerce_product_search' ) ){
					header_woocommerce_product_search();
				}else{
					get_search_form();
				}
				?>
				<button class="fixed-close-button">
					<span class="fas fa-times"></span>
				</button>
			</div>
		</div>
	</div>
	<!-- header search form end-->
</div>