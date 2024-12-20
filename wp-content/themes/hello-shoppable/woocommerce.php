<?php
/**
 * The template for displaying archived woocommerce products
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @package Hello Shoppable
 */
get_header(); 
?>
<div class="page-head">
	<div class="container">
		<?php
		if ( get_theme_mod( 'woocommerce_breadcrumbs_controls', 'disable_in_all_page_post' ) == 'disable_in_all_pages' || get_theme_mod( 'woocommerce_breadcrumbs_controls', 'disable_in_all_page_post' ) == 'show_in_all_page_post'){
			if( hello_shoppable_wooCom_is_product_page() ){
				if ( get_theme_mod( 'enable_single_product_breadcrumbs', true ) ){
					hello_shoppable_breadcrumb_wrap();
				}			 
			}else {
				hello_shoppable_breadcrumb_wrap();
			}
		}
		?>
		<?php if( hello_shoppable_wooCom_is_product_page() || hello_shoppable_wooCom_is_shop() ){
			if( ( hello_shoppable_wooCom_is_product_page() && get_theme_mod( 'enable_single_product_title', true ) ) || ( hello_shoppable_wooCom_is_shop() && get_theme_mod( 'enable_shop_page_title', true ) ) ){ ?>
				<h1 class="page-title">
					<?php woocommerce_page_title(); ?>
				</h1>
			<?php } ?>
		<?php } else { ?>
			<h1 class="page-title">
				<?php woocommerce_page_title(); ?>
			</h1>
		<?php } ?>
	</div>
</div>
<div id="content" class="site-content">
	<div class="container">
		<section class="wrap-detail-page ">
				<div class="row">
					<?php
					$getSidebarClass = hello_shoppable_get_sidebar_class();
					$sidebarClass = 'col-12';
					if( !hello_shoppable_wooCom_is_product_page() ){
						$sidebarClass = $getSidebarClass[ 'sidebarClass' ];
						if( get_theme_mod( 'enable_sidebar_woocommerce_shop', true ) ){
							hello_shoppable_woo_product_detail_left_sidebar( $getSidebarClass[ 'sidebarColumnClass' ] );
						}
					}	
					?>
					
					<div id="primary" class="content-area <?php echo esc_attr( $sidebarClass ); ?>">
						<main id="main" class="site-main post-detail-content woocommerce-products" role="main">
							<?php if ( have_posts() ) :
								woocommerce_content();
							endif;
							?>
						</main><!-- #main -->
					</div><!-- #primary -->
					<?php
					if( !hello_shoppable_wooCom_is_product_page() ){
						if( get_theme_mod( 'enable_sidebar_woocommerce_shop', true ) ){
							hello_shoppable_woo_product_detail_right_sidebar( $getSidebarClass[ 'sidebarColumnClass' ] );
						}
					} ?>
				</div>
		</section>
	</div><!-- #container -->
</div><!-- #content -->
<?php
get_footer();
