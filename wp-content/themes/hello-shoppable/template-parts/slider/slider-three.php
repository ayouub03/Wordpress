<?php
$width_control = '';
if( get_theme_mod( 'slider_width_controls', 'full' ) == 'boxed' ){
	$width_control = 'container boxed';
}

$slider_layout = 'slider-layout-three';
if( get_theme_mod( 'slider_type', 'category' ) == 'category' ){
	$posts_per_page_count = get_theme_mod( 'slider_posts_number', 6 );
	$slider_id = get_theme_mod( 'slider_category', '' );
	$query = new WP_Query( apply_filters( 'hello_shoppable_cat_slider_args', array(
		'post_type'           => 'post',
		'post_status'         => 'publish',
		'posts_per_page'      => $posts_per_page_count,
		'category__in'        => $slider_id,
		'offset'              => 0,
		'ignore_sticky_posts' => 1
	) ) );
}else{
	$page_ids = get_theme_mod( 'slider_pages', '' );
	$query = new WP_Query( apply_filters( 'hello_shoppable_page_slider_args', array(
		'post_type'           => 'page',
		'post__in'            => $page_ids,
		'post_status'         => 'publish',
	) ) );
} ?>

<div class="main-slider-wrap <?php echo esc_attr( $slider_layout ); ?> <?php echo esc_attr( $width_control ); ?>">
	<div class="main-slider-layout-three">
		<?php
			while ( $query->have_posts() ) : $query->the_post();
			$slider_three_size	 	= 'hello-shoppable-1370-550';
			$render_slider_image 	= get_theme_mod( 'render_slider_image_size', '' );
			if ( empty( $render_slider_image ) ){
            	$render_slider_image = $slider_three_size;
            }
			$image = get_the_post_thumbnail_url( get_the_ID(), $render_slider_image );
		?>
			<div class="slide-item">
				<div class="banner-img" style="background-image: url( <?php echo esc_url( $image ); ?> );">
					<?php
					$alignmentClass = 'text-center';
					if ( get_theme_mod( 'main_slider_content_alignment' , 'center' ) == 'left' ){
						$alignmentClass = 'text-left';
					}elseif ( get_theme_mod( 'main_slider_content_alignment' , 'center' ) == 'right' ){
						$alignmentClass = 'text-right';
					}
					?>
					<div class="slide-inner">
						<div class="banner-content <?php echo esc_attr( $alignmentClass ); ?>">
						    <div class="entry-content">
						    	<header class="entry-header">
									<?php
									if( get_theme_mod( 'hero_slider_category', true ) && get_theme_mod( 'slider_type', 'category' ) == 'category' ){
										hello_shoppable_entry_header();
									}
									if ( is_singular() ) :
										the_title( '<h1 class="entry-title">', '</h1>' );
									else :
										if ( get_theme_mod( 'slider_title', true ) ){
											the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
										}
									endif; 
									
									?>
								</header><!-- .entry-header -->
								<div class="entry-meta">
									<?php
										if( get_theme_mod( 'slider_date', true ) ): ?>
											<span class="posted-on">
												<a href="<?php echo esc_url( hello_shoppable_get_day_link() ); ?>" >
													<?php echo esc_html(get_the_date('M j, Y')); ?>
												</a>
											</span>
										<?php endif; 
										if( get_theme_mod( 'slider_author', true ) ): ?>
											<span class="byline">
												<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
													<?php echo get_the_author(); ?>
												</a>
											</span>
										<?php endif; 
										if( get_theme_mod( 'slider_type', 'category' ) == 'category' ){
											if( get_theme_mod( 'slider_comment', true ) ):
												echo '<span class="comments-link">';
												comments_popup_link(
													sprintf(
														wp_kses(
															/* translators: %s: post title */
															__( 'Comment<span class="screen-reader-text"> on %s</span>', 'hello-shoppable' ),
															array(
																'span' => array(
																	'class' => array(),
																),
															)
														),
														get_the_title()
													)
												);
												echo '</span>';
											endif;
										}
									?>	
						        </div><!-- .entry-meta -->
								
								<?php if ( get_theme_mod( 'slider_excerpt', true ) || ( get_theme_mod( 'hero_slider_button', true ) && !empty( get_theme_mod( 'slider_button_text', '' ) ) ) ){ ?>
						        	<div class="entry-text">
										<?php
											if ( get_theme_mod( 'slider_excerpt', true ) ){
												$excerpt_length = get_theme_mod( 'slider_excerpt_length', 25 );
												hello_shoppable_excerpt( $excerpt_length , true );
											}
										?>
										<?php 
										if( get_theme_mod( 'hero_slider_button', true )  && !empty( get_theme_mod( 'slider_button_text', '' ) ) ) { 
										?>
											<div class="button-container">
								        		<?php
								        		$slider_button_text 	= get_theme_mod( 'slider_button_text', '' );
												$slider_button_link 	= get_theme_mod( 'slider_button_link', '' );
												$slider_button_target 	= get_theme_mod( 'slider_new_window_button_target', true );  
									        	$link_target = '';
												if( $slider_button_target ){
														$link_target = '_blank';
													}
												?>
												<a href="<?php echo esc_url( $slider_button_link ); ?>" target="<?php echo esc_attr( $link_target ); ?>" class="button-primary">
												<?php echo esc_html( $slider_button_text ); ?>
												</a>	
											</div>
										<?php } ?> 
									</div>
								<?php } ?>
							</div><!-- .entry-content -->
						</div>
					</div>
					<div class="image-overlay"></div>
				</div>
			</div>
		<?php
		endwhile; 
		wp_reset_postdata();
		?>
	</div>
	<?php if( get_theme_mod( 'slider_arrows', true ) ) { ?>
		<ul class="slick-control">
	        <li class="main-slider-prev">
	        	<span></span>
	        </li>
	        <li class="main-slider-next">
	        	<span></span>
	        </li>
	    </ul>
	<?php } ?>
</div>
<?php if ( get_theme_mod( 'slider_dots', true ) ){ ?>
	<div class="main-slider-dots"></div>
<?php } ?>