<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Hello Shoppable
 */
?>

<?php
	$stickyClass = "col-12";
	$layout_class = '';
	if( get_theme_mod( 'sidebar_settings', 'right' ) == 'right' ) {
		if ( get_theme_mod( 'archive_post_layout', 'list' ) == 'grid' ){
			$stickyClass = "col-sm-6 grid-post";
			if( !is_active_sidebar( 'right-sidebar') ){
				$stickyClass = "col-sm-6 col-lg-4 grid-post";
			}
		}
	}elseif( get_theme_mod( 'sidebar_settings', 'right' ) == 'left' ) {
		if ( get_theme_mod( 'archive_post_layout', 'list' ) == 'grid' ){
			$stickyClass = "col-sm-6 grid-post";
			if( !is_active_sidebar( 'left-sidebar') ){
				$stickyClass = "col-sm-6 col-lg-4 grid-post";
			}
		}
	}elseif( get_theme_mod( 'sidebar_settings', 'right' ) == 'no-sidebar' ) {
		if ( get_theme_mod( 'archive_post_layout', 'list' ) == 'grid' ){
			$stickyClass = "col-sm-6 col-lg-4 grid-post";
		}
	}elseif( get_theme_mod( 'sidebar_settings', 'right' ) == 'right-left' ) {
		if ( get_theme_mod( 'archive_post_layout', 'list' ) == 'grid' ){
			$stickyClass = "col-sm-6 col-lg-6 grid-post";
			if( !is_active_sidebar( 'left-sidebar') && !is_active_sidebar( 'right-sidebar') ){
				$stickyClass = "col-sm-6 col-lg-4 grid-post";
			}
		}
	}
	if( !get_theme_mod( 'sidebar_blog_page', true ) && get_theme_mod( 'archive_post_layout', 'list' ) == 'grid' ){
		$stickyClass = "col-sm-6 col-lg-4 grid-post";
	}

	if( get_theme_mod( 'archive_post_layout', 'list' ) == 'list' ){
		$layout_class = 'list-post';
	}elseif( get_theme_mod( 'archive_post_layout', 'list' ) == 'single' ){
		$layout_class = 'single-post';
	}
?>
<div class="<?php echo esc_attr( $stickyClass );?>">
	<article id="post-<?php the_ID(); ?>" <?php post_class( $layout_class ) ?>>
		<figure class="featured-image">
		    <a href="<?php the_permalink(); ?>">
				<?php if( has_post_thumbnail() ){        
		                $grid_list_size = 'hello-shoppable-420-300';
		                $single_size 	= 'hello-shoppable-1370-550';
		                $render_post_image_size = get_theme_mod( 'render_post_image_size', '' );
		                if ( !empty( $render_post_image_size ) ){
		                	$grid_list_size = $render_post_image_size;
		                	$single_size 	= $render_post_image_size;
		                }
		                if( get_theme_mod( 'sidebar_settings', 'right' ) == 'right' ) {
		                	if ( get_theme_mod( 'archive_post_layout', 'list' ) == 'grid' || get_theme_mod( 'archive_post_layout', 'list' ) == 'list' ){
		                		hello_shoppable_image_size( $grid_list_size );
		                	}elseif( get_theme_mod( 'archive_post_layout', 'list' ) == 'single' ){
		                		hello_shoppable_image_size( $single_size );
		                	}
		                }elseif( get_theme_mod( 'sidebar_settings', 'right' ) == 'left' ) {
		                	if ( get_theme_mod( 'archive_post_layout', 'list' ) == 'grid' || get_theme_mod( 'archive_post_layout', 'list' ) == 'list' ){
		                		hello_shoppable_image_size( $grid_list_size );
		                	}elseif( get_theme_mod( 'archive_post_layout', 'list' ) == 'single' ){
		                		hello_shoppable_image_size( $single_size );
		                	}
		                }elseif( get_theme_mod( 'sidebar_settings', 'right' ) == 'no-sidebar' ) {
		                	if ( get_theme_mod( 'archive_post_layout', 'list' ) == 'grid' || get_theme_mod( 'archive_post_layout', 'list' ) == 'list' ){
		                		hello_shoppable_image_size( $grid_list_size );
		                	}elseif( get_theme_mod( 'archive_post_layout', 'list' ) == 'single' ){
		                		hello_shoppable_image_size( $single_size );
		                	}
		                }elseif( get_theme_mod( 'sidebar_settings', 'right' ) == 'right-left' ) {
		                	if ( get_theme_mod( 'archive_post_layout', 'list' ) == 'grid' || get_theme_mod( 'archive_post_layout', 'list' ) == 'list' ){
		                		hello_shoppable_image_size( $grid_list_size );
		                	}elseif( get_theme_mod( 'archive_post_layout', 'list' ) == 'single' ){
		                		hello_shoppable_image_size( $single_size );
		                	}
		                }
				}else{ ?>
					<div class="thumbnail-placeholder">
						<svg class="fallback-svg" viewBox="0 0 1000 800" preserveAspectRatio="none">
		                    <rect width="1000" height="800" style="fill:#F8F8F8;"></rect>
		            	</svg>
					</div>
				<?php } ?>
			</a>
		</figure><!-- .recent-image -->
	    <div class="entry-content">
	    	<header class="entry-header">
				<?php 
					if( get_theme_mod( 'enable_post_category', true ) ){
						hello_shoppable_entry_header();
					}
					if( get_theme_mod( 'enable_post_title', true ) ){
						the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
					}
				?>

			</header><!-- .entry-header -->
			<div class="entry-meta">
	           <?php hello_shoppable_entry_footer(); ?>
	        </div><!-- .entry-meta -->
			
			<?php if ( get_theme_mod( 'enable_post_excerpt', true ) || ( get_theme_mod( 'enable_post_button', true ) && !empty( get_theme_mod( 'post_button_text', '' ) ) ) ){ ?>
		        <div class="entry-text">
					<?php
						if ( get_theme_mod( 'enable_post_excerpt', true ) ){
							$excerpt_length = get_theme_mod( 'post_excerpt_length', 15 );
							hello_shoppable_excerpt( $excerpt_length , true );
						}
					?>
					<?php 
					if( get_theme_mod( 'enable_post_button', true )  && !empty( get_theme_mod( 'post_button_text', '' ) ) ) { 
						?>
						<div class="button-container">
			        		<?php
			        		$post_button_text 	= get_theme_mod( 'post_button_text', '' );
							$post_button_link 	= get_theme_mod( 'post_button_link', '' );
							$post_button_target = get_theme_mod( 'post_new_window_button_target', true );  
				        	$link_target = '';
							if( $post_button_target ){
								$link_target = '_blank';
								}
							?>
							<a href="<?php echo esc_url( $post_button_link ); ?>" target="<?php echo esc_attr( $link_target ); ?>" class="button-primary">
							<?php echo esc_html( $post_button_text ); ?>
							</a>	
						</div>
					<?php } ?> 
				</div>
			<?php } ?>
		</div><!-- .entry-content -->
	</article><!-- #post-->
</div>