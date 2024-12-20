<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Hello Shoppable
 */

get_header(); ?>
<div class="page-head">
	<div class="container">
		<?php
		if( get_theme_mod( 'breadcrumbs_controls', 'disable_in_all_page_post' ) == 'disable_in_all_pages' || get_theme_mod( 'breadcrumbs_controls', 'disable_in_all_page_post' ) == 'show_in_all_page_post' ){
			hello_shoppable_breadcrumb_wrap();
		} 
		hello_shoppable_page_title_display();
		?>
	</div>
</div>
<div id="content" class="site-content">
	<div class="container">
		<div class="wrap-detail-page">
			<div class="search-post-wrap">
				<?php if ( have_posts() ) : ?>
				<div class="row masonry-wrapper">
					<?php
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						/**
						 * Run the loop for the search to output the results.
						 * If you want to overload this in a child theme then include a file
						 * called content-search.php and that will be used instead.
						 */
						get_template_part( 'template-parts/content', 'search' );

					endwhile; ?>
					</div>
						<?php
							if( get_theme_mod( 'enable_pagination', true ) ):
								the_posts_pagination( array(
									'next_text' => '<span>'.esc_html__( 'Next', 'hello-shoppable' ) .'</span><span class="screen-reader-text">' . esc_html__( 'Next page', 'hello-shoppable' ) . '</span>',
									'prev_text' => '<span>'.esc_html__( 'Prev', 'hello-shoppable' ) .'</span><span class="screen-reader-text">' . esc_html__( 'Previous page', 'hello-shoppable' ) . '</span>',
									'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'hello-shoppable' ) . ' </span>',
								) );
							endif;
						?>
					<?php
				else :

					get_template_part( 'template-parts/content', 'none' );

				endif;
				?>
			</div>
		</div>
	</div><!-- #container -->
</div><!-- #content -->
<?php
get_footer();
