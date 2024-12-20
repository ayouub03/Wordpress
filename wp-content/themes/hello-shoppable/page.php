<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Hello Shoppable
 */

get_header();

if( ( function_exists( 'bcn_display' ) && !is_front_page() && ( ( ( hello_shoppable_is_woocommerce() || hello_shoppable_is_yith() ) && get_theme_mod( 'woocommerce_breadcrumbs_controls', 'disable_in_all_page_post' ) == 'show_in_all_page_post' ) || get_theme_mod( 'breadcrumbs_controls', 'disable_in_all_page_post' ) == 'show_in_all_page_post' ) ) ||  hello_shoppable_is_page_title() ){
	?>
	<div class="page-head">
		<div class="container">
			<?php
			if( hello_shoppable_is_woocommerce() || hello_shoppable_is_yith() ){
				if( get_theme_mod( 'woocommerce_breadcrumbs_controls', 'disable_in_all_page_post' ) == 'show_in_all_page_post' ){
					hello_shoppable_breadcrumb_wrap();
				}
			}else{
				if( get_theme_mod( 'breadcrumbs_controls', 'disable_in_all_page_post' ) == 'show_in_all_page_post' ){
					hello_shoppable_breadcrumb_wrap();
				}
			}
			hello_shoppable_page_title();
			?>
		</div>
	</div>
<?php } ?>

<div id="content" class="site-content">
	<div class="container">
		<section class="wrap-detail-page">
			<div class="row">
				<?php
					if( !hello_shoppable_is_woocommerce() && !hello_shoppable_is_yith() ){
						$sidebarClass = 'col-lg-8';
						$sidebarColumnClass = 'col-lg-4';
						if ( get_theme_mod( 'sidebar_settings', 'right' ) == 'right' ){
							if( !is_active_sidebar( 'right-sidebar') ){
								$sidebarClass = "col-12";
							}	
						}elseif ( get_theme_mod( 'sidebar_settings', 'right' ) == 'left' ){
							if( !is_active_sidebar( 'left-sidebar') ){
								$sidebarClass = "col-12";
							}	
						}elseif ( get_theme_mod( 'sidebar_settings', 'right' ) == 'right-left' ){
							$sidebarClass = 'col-lg-6';
							$sidebarColumnClass = 'col-lg-3';
							if( !is_active_sidebar( 'left-sidebar') && !is_active_sidebar( 'right-sidebar') ){
								$sidebarClass = "col-12";
							}
						}
						if ( get_theme_mod( 'sidebar_settings', 'right' ) == 'no-sidebar' || !get_theme_mod( 'sidebar_page', false ) ){
							$sidebarClass = 'col-12';
						}
						if( get_theme_mod( 'sidebar_page', false ) ){
							if ( get_theme_mod( 'sidebar_settings', 'right' ) == 'left' ){ 
								if( is_active_sidebar( 'left-sidebar') ){ ?>
									<div id="secondary" class="sidebar left-sidebar <?php echo esc_attr( $sidebarColumnClass ); ?>">
										<?php dynamic_sidebar( 'left-sidebar' ); ?>
									</div>
								<?php }
							}elseif ( get_theme_mod( 'sidebar_settings', 'right' ) == 'right-left' ){
								if( is_active_sidebar( 'left-sidebar') || is_active_sidebar( 'right-sidebar') ){ ?>
									<div id="secondary" class="sidebar left-sidebar <?php echo esc_attr( $sidebarColumnClass ); ?>">
										<?php dynamic_sidebar( 'left-sidebar' ); ?>
									</div>
								<?php
								}
							}
						}
					}else{
						$sidebarClass = 'col-12';
					}
				?>
				<div id="primary" class="content-area <?php echo esc_attr( $sidebarClass ); ?>">
					<main id="main" class="site-main">
						<?php if( has_post_thumbnail() ){
							if( get_theme_mod( 'page_feature_image', 'show_in_all_pages' ) == 'show_in_all_pages' || !is_front_page() && get_theme_mod( 'page_feature_image', 'show_in_all_pages' ) == 'disable_in_frontpage' || get_theme_mod( 'page_feature_image', 'show_in_all_pages' ) == 'show_in_frontpage' && is_front_page() ){ ?>
							    <figure class="feature-image single-feature-image">
							        <?php 
							        $render_pages_image_size 	= get_theme_mod( 'render_pages_image_size', 'hello-shoppable-1370-550' );
							        hello_shoppable_image_size( $render_pages_image_size ); ?>
							    </figure>
							<?php }else{
								// will disable in all pages
								echo '';
							}
						}
						?>
					<?php
					while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/content', 'page' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; // End of the loop.
					?>
					</main><!-- #main -->
				</div><!-- #primary -->
				<?php
					if( !hello_shoppable_is_woocommerce() && !hello_shoppable_is_yith() ){
						if( get_theme_mod( 'sidebar_page', false ) ){
							if ( get_theme_mod( 'sidebar_settings', 'right' ) == 'right' ){ 
								if( is_active_sidebar( 'right-sidebar') ){ ?>
									<div id="secondary" class="sidebar right-sidebar <?php echo esc_attr( $sidebarColumnClass ); ?>">
										<?php dynamic_sidebar( 'right-sidebar' ); ?>
									</div>
								<?php }
							}elseif ( get_theme_mod( 'sidebar_settings', 'right' ) == 'right-left' ){
								if( is_active_sidebar( 'left-sidebar') || is_active_sidebar( 'right-sidebar') ){ ?>
									<div id="secondary-sidebar" class="sidebar right-sidebar <?php echo esc_attr( $sidebarColumnClass ); ?>">
										<?php dynamic_sidebar( 'right-sidebar' ); ?>
									</div>
								<?php
								}
							}
						}
					}
				?>
			</div>
		</section>
	</div><!-- #container -->
</div><!-- #content -->	
<?php get_footer();
