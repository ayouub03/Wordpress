<header id="masthead" class="site-header header-two">
	<div class="top-header">
		<?php
		if( get_theme_mod( 'top_header_section', true ) ){
			hello_shoppable_the_top_bar();
		}
		?>
		<?php
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
	<?php get_template_part( 'template-parts/offcanvas', 'menu' ); ?>
	<div class="bottom-header header-image-wrap d-flex align-items-center">
		<?php if( hello_shoppable_has_header_media() ){ hello_shoppable_header_media(); } ?>
		<div class="container">
			<div class="bottom-header-inner d-flex align-items-center justify-content-between">
				<?php
				if ( get_theme_mod( 'enable_header_woo_cat_menu', true ) ) {
					get_template_part( 'template-parts/header/header', 'category-menu' );
		        }
		        ?>
				<div class="<?php echo esc_attr( hello_shoppable_header_icon_group_class() ); ?> col-lg-2 flex-grow-1 p-0">
					<?php get_template_part( 'template-parts/site', 'branding' ); ?>
					<div id="slicknav-mobile" class="d-block d-lg-none"></div>
				</div>	
				<div class="main-navigation-wrap">
					<nav id="site-navigation" class="main-navigation d-none d-lg-flex <?php echo esc_attr( hello_shoppable_primary_menu_alignment() ); ?>">
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
				    <div class="header-right" >
				        <!-- Search form structure -->
						<?php if( get_theme_mod( 'enable_search_icon', true ) ): ?>
							<div id="search-form" class="header-search-wrap ">
								<?php hello_shoppable_header_search_icon(); ?>
							</div>
						<?php endif; ?>
						<?php
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
					<?php if( get_theme_mod( 'header_button', true ) && !empty( get_theme_mod( 'header_button_text', '' ) ) ){ ?>
						<div class="header-btn">
							<?php hello_shoppable_header_buttons(); ?>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<!-- header search form -->
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
		<div class="header-bg-overlay"></div>
	</div>
	<!-- mobile nav -->
	<div class="mobile-menu-container"></div>
</header><!-- #masthead -->