<header id="masthead" class="site-header header-one">
	<div class="top-header">
		<?php
		if( get_theme_mod( 'top_header_section', true ) ){
			hello_shoppable_the_top_bar();
		}
		if( get_theme_mod( 'mobile_top_header', true ) ){
			if( hello_shoppable_is_mobile_top_bar_enable() || ( get_theme_mod( 'header_button', true ) && get_theme_mod( 'mobile_header_buttons', true ) && !empty( get_theme_mod( 'header_button_text', '' ) ) ) ){
				?>
				<div class="alt-menu-icon d-lg-none">
					<a class="offcanvas-menu-toggler" href="#">
						<span class="icon-bar-wrap">
							<span class="icon-bar"></span>
						</span>
						<span class="iconbar-label d-lg-none"><?php echo esc_html( get_theme_mod( 'top_bar_name', esc_html__( 'TOP MENU', 'hello-shoppable' ) ) ); ?></span>
					</a>
				</div>
				<?php
			}
		}
		?>
	</div>
	<div class="mid-header header-image-wrap d-flex align-items-center">
		<?php if( hello_shoppable_has_header_media() ){ hello_shoppable_header_media(); } ?>
		<div class="container">
			<div class="mid-header-inner">
				<div class="row align-items-center">
					<div class="<?php echo esc_attr( hello_shoppable_header_icon_group_class() ); ?> col-md-3 col-lg-2">
						<?php get_template_part( 'template-parts/site', 'branding' ); ?>
					</div>
					<div class="col-7 col-md-9 col-lg-10">
						<div class="d-flex align-items-center justify-content-end">
							<div class="header-cat-search-form d-none d-md-block flex-grow-1">
							    <?php
						    	if( get_theme_mod( 'enable_search_icon', true ) ){
									//move function to plugin
									if( class_exists('WooCommerce' ) && function_exists( 'header_woocommerce_product_search' ) ){
										header_woocommerce_product_search();
									}else{
										get_search_form();
									}
					    		}
						   	 	?>
							</div>
							<div class="bottom-contact d-none d-lg-flex align-items-center ml-5">
								<?php if( get_theme_mod( 'mid_contact_phone_detail', false ) ){ ?>
									<a href="<?php echo esc_attr( 'tel:' . get_theme_mod( 'mid_contact_phone_number', '' ) ); ?>">
										<span class="icon">
											<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
												 width="30px" height="30px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve">
											<path d="M30,24.493c-0.001-0.534-0.123-1.042-0.306-1.504l0,0c-0.362-0.908-0.93-1.699-1.578-2.387
												c-0.649-0.688-1.383-1.277-2.1-1.775c-0.431-0.299-0.948-0.649-1.526-0.934c-0.289-0.142-0.595-0.269-0.918-0.362
												c-0.323-0.093-0.663-0.152-1.017-0.152c-0.258,0-0.523,0.032-0.785,0.105c-0.263,0.073-0.522,0.188-0.768,0.344
												c-0.364,0.233-0.68,0.515-0.982,0.8c-0.226,0.214-0.443,0.429-0.655,0.63c-0.317,0.301-0.625,0.563-0.908,0.734
												c-0.141,0.086-0.275,0.149-0.4,0.19c-0.126,0.041-0.242,0.06-0.362,0.061c-0.171-0.001-0.357-0.038-0.599-0.16
												c-1.425-0.724-2.834-1.776-4.063-3.006c-1.23-1.23-2.279-2.638-3.001-4.059l-0.043-0.084l0.043,0.084
												c-0.122-0.242-0.159-0.427-0.16-0.599c0-0.106,0.016-0.21,0.048-0.32c0.055-0.192,0.167-0.405,0.33-0.634
												c0.243-0.343,0.598-0.71,0.97-1.093c0.186-0.192,0.376-0.389,0.558-0.596c0.182-0.207,0.356-0.425,0.509-0.664
												c0.157-0.246,0.271-0.505,0.344-0.768c0.073-0.263,0.105-0.527,0.105-0.785c0-0.354-0.059-0.694-0.152-1.017
												c-0.14-0.484-0.354-0.93-0.586-1.34c-0.233-0.409-0.485-0.781-0.71-1.104l0,0c-0.499-0.717-1.087-1.45-1.776-2.1
												C8.824,1.35,8.033,0.782,7.125,0.42l0,0C6.664,0.237,6.156,0.115,5.622,0.115c-0.37,0-0.752,0.06-1.124,0.202h0
												c-0.313,0.12-0.599,0.281-0.859,0.465C3.248,1.06,2.913,1.391,2.62,1.734C2.327,2.079,2.075,2.437,1.856,2.777l0,0
												C1.315,3.619,0.88,4.524,0.58,5.473c-0.3,0.948-0.466,1.94-0.466,2.95c0,0.464,0.035,0.931,0.107,1.398v0
												c0.184,1.186,0.555,2.308,1.039,3.369c0.484,1.062,1.081,2.063,1.721,3.014c0.45,0.668,0.922,1.31,1.393,1.93
												c2.064,2.713,4.579,5.148,7.112,7.348c1.215,1.055,2.585,2.026,4.067,2.801c1.482,0.774,3.078,1.353,4.74,1.61
												C20.761,29.965,21.229,30,21.692,30c1.009,0,2.001-0.165,2.949-0.466c0.948-0.3,1.854-0.735,2.696-1.276
												c0.452-0.291,0.939-0.641,1.38-1.071c0.22-0.215,0.429-0.451,0.614-0.711c0.185-0.26,0.346-0.546,0.465-0.859v0
												C29.94,25.245,30,24.863,30,24.493z M28.381,25.075L28.381,25.075c-0.067,0.176-0.163,0.351-0.285,0.523
												c-0.183,0.258-0.425,0.509-0.699,0.742c-0.274,0.233-0.578,0.449-0.878,0.642c-0.737,0.474-1.523,0.85-2.334,1.106
												c-0.812,0.257-1.648,0.395-2.492,0.395c-0.388,0-0.777-0.029-1.167-0.089c-1.466-0.227-2.908-0.744-4.269-1.456
												c-1.361-0.711-2.64-1.615-3.775-2.601c-2.49-2.162-4.931-4.532-6.9-7.121c-0.461-0.606-0.915-1.225-1.343-1.859
												c-0.608-0.902-1.161-1.834-1.599-2.795c-0.438-0.961-0.762-1.95-0.92-2.972l0,0C1.66,9.199,1.631,8.81,1.631,8.422
												c0-0.844,0.138-1.68,0.395-2.492c0.257-0.811,0.633-1.597,1.106-2.334l0.051-0.08l-0.051,0.08c0.257-0.4,0.555-0.807,0.88-1.141
												c0.163-0.167,0.332-0.315,0.504-0.437c0.172-0.122,0.347-0.218,0.523-0.285c0.183-0.07,0.376-0.102,0.583-0.103
												C5.919,1.63,6.246,1.702,6.565,1.829c0.678,0.269,1.32,0.718,1.907,1.272c0.587,0.553,1.116,1.207,1.571,1.862l0,0
												c0.288,0.414,0.594,0.874,0.818,1.33c0.112,0.228,0.204,0.453,0.265,0.667c0.062,0.214,0.093,0.415,0.093,0.598
												c0,0.134-0.016,0.258-0.05,0.378c-0.034,0.12-0.085,0.238-0.162,0.359c-0.142,0.223-0.363,0.482-0.624,0.757
												c-0.195,0.207-0.412,0.424-0.63,0.655c-0.327,0.347-0.659,0.722-0.928,1.162c-0.134,0.22-0.251,0.458-0.335,0.717
												c-0.085,0.258-0.136,0.539-0.135,0.832c-0.001,0.422,0.108,0.862,0.325,1.286v0c0.807,1.587,1.948,3.11,3.28,4.443
												c1.333,1.333,2.857,2.476,4.449,3.286c0.424,0.217,0.864,0.326,1.286,0.325c0.26,0,0.511-0.04,0.745-0.109
												c0.41-0.12,0.767-0.322,1.088-0.55c0.48-0.343,0.889-0.75,1.268-1.116c0.189-0.183,0.37-0.357,0.541-0.507
												c0.171-0.151,0.334-0.278,0.48-0.371c0.122-0.077,0.239-0.128,0.359-0.162c0.12-0.033,0.244-0.05,0.378-0.05
												c0.183,0,0.384,0.031,0.598,0.093c0.321,0.092,0.668,0.252,1.009,0.447c0.342,0.194,0.678,0.421,0.988,0.637
												c0.655,0.455,1.309,0.984,1.862,1.571c0.554,0.587,1.003,1.229,1.273,1.907c0.127,0.319,0.199,0.646,0.198,0.943
												C28.483,24.7,28.451,24.893,28.381,25.075z"/>
											</svg>
										</span>
										<span class="label">
											<?php echo esc_html( get_theme_mod( 'mid_contact_phone_label', '' ) ); ?>
										</span>
										<div class="mid-contact-phone"><?php echo esc_html( get_theme_mod( 'mid_contact_phone_number', '' ) ); ?></div>
									</a>
								<?php } ?>
							</div>
							<div class="header-icon header-right ml-lg-5 ml-2">
								<!-- Search form structure -->
								<?php
								if( get_theme_mod( 'enable_search_icon', true ) && get_theme_mod( 'enable_mobile_search_icon', true ) ){
									?>
									<div id="search-form" class="header-search-wrap d-md-none">
										<?php hello_shoppable_header_search_icon(); ?>
									</div>
									<?php
								}
								if ( class_exists('WooCommerce' ) ) { 
							        if( get_theme_mod( 'woocommerce_compare', true ) ){
							        	hello_shoppable_head_compare();
							        }
							        if( get_theme_mod( 'woocommerce_wishlist', true ) ){
							        	hello_shoppable_head_wishlist();
							        }
							        if( get_theme_mod( 'woocommerce_account', true ) ){
							        	hello_shoppable_my_account();
							        }
							        if( get_theme_mod( 'woocommerce_cart', true ) ){
							        	hello_shoppable_header_cart();
							    	}
								}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="header-bg-overlay"></div>
	</div>
	<div class="bottom-header ">
		<div class="container">
			<div class="bottom-header-inner d-flex align-items-center justify-content-between">
				<div class="site-navigation-container d-flex align-items-center flex-lg-grow-1">
					<?php
					if ( get_theme_mod( 'enable_header_woo_cat_menu', true ) ) {
						get_template_part( 'template-parts/header/header', 'category-menu' );
			        }
			        ?>
			        <nav id="site-navigation" class="main-navigation d-none d-lg-flex flex-grow-1 <?php echo esc_attr( hello_shoppable_primary_menu_alignment() ); ?>">
						<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'hello-shoppable' ); ?></button>
						<?php
						if ( has_nav_menu( 'menu-1' ) ) :
							wp_nav_menu( 
								array(
									'container'      => '',
									'theme_location' => 'menu-1',
									'menu_id'        => 'primary-menu',
									'menu_class'     => 'menu nav-menu',
								)
							);
						else :
							wp_page_menu(
								array(
									'menu_class' => 'menu-wrap',
									'before'     => '<ul id="primary-menu" class="menu nav-menu">',
									'after'      => '</ul>',
								)
							);
						endif;
						?>
					</nav><!-- #site-navigation -->	
		        </div>
				<?php if( get_theme_mod( 'header_button', true ) && !empty( get_theme_mod( 'header_button_text', '' ) ) ){ ?>
					<div class="header-btn d-none d-lg-block ml-5">
						<?php hello_shoppable_header_buttons(); ?>
					</div>
				<?php } ?>	
				<div class="mobile-menu-container"></div>
			</div>
		</div><!-- header search form -->
		<div class="header-search">
			<div class="container">
				<?php
				//move function to plugin
				if( class_exists('WooCommerce' ) && function_exists( 'header_woocommerce_product_search' ) ){
					header_woocommerce_product_search();
				}else{
					get_search_form();
				}
				?>				
				<button class="close-button">
					<span class="fas fa-times"></span>
				</button>
			</div>
		</div>
		<!-- header search form end-->
	</div>
	<?php get_template_part( 'template-parts/offcanvas', 'menu' ); ?>
</header><!-- #masthead -->