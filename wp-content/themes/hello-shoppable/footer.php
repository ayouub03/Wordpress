<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Hello Shoppable
 */

?>
	<?php
	$has_footer_bg = '';
	$render_footer_image_size 	= get_theme_mod( 'render_footer_image_size', 'full' );
	$footer_image_id 			= get_theme_mod( 'footer_image', '' );
	$get_footer_image_array 	= wp_get_attachment_image_src( $footer_image_id, $render_footer_image_size );
	if( is_array( $get_footer_image_array ) ){
		$footer_image = $get_footer_image_array[0];
	}else{
		$footer_image = '';
	}
	if ( $footer_image || get_theme_mod( 'top_footer_background_color', '' ) ){
		$has_footer_bg = 'has-footer-bg';
	}
	?>

	<footer id="colophon" class="site-footer <?php echo esc_attr( $has_footer_bg ) ?>" style="background-image: url(<?php echo esc_url( $footer_image ) ?>">
		<div class="site-footer-inner">
			<?php 
			if( get_theme_mod( 'footer_widget', true ) ):
			 if( hello_shoppable_is_active_footer_sidebar() ):
			  ?>
				<div class="top-footer">
					<div class="wrap-footer-sidebar">
						<div class="container">
							<?php
							$footer_widget = get_theme_mod( 'footer_widget_layout', 'footer_style_one' );
							$layout = str_replace( '_', '-', $footer_widget );
							?>
							<div class="footer-grid <?php echo esc_attr( $layout ); ?> <?php echo esc_attr( get_theme_mod( 'footer_widget_content_alignment', 'text-left' ) ); ?>">
								<?php
								if( $footer_widget == '' || $footer_widget == 'footer_style_one' || $footer_widget == 'footer_style_two' || $footer_widget == 'footer_style_three' || $footer_widget == 'footer_style_four' || $footer_widget == 'footer_style_five' ){
									get_template_part( 'template-parts/footer/footer-widget-column', 'four' );
								}
								elseif( $footer_widget == 'footer_style_six' || $footer_widget == 'footer_style_seven' || $footer_widget == 'footer_style_eight' || $footer_widget == 'footer_style_nine' ){
									get_template_part( 'template-parts/footer/footer-widget-column', 'three' );
								}
								elseif( $footer_widget == 'footer_style_ten' ){
									get_template_part( 'template-parts/footer/footer-widget-column', 'two' );
								}
								elseif( $footer_widget == 'footer_style_eleven' ){
									get_template_part( 'template-parts/footer/footer-widget-column', 'one' );
								}
								?>
							</div>
						</div>
					</div>
				</div>
			<?php
				endif;
			endif;
			?>
			<div class="bottom-footer">
				<div class="container">
					<?php
					$footer_parts = get_theme_mod( 'footer_sortable', '' );
					if( !is_array( $footer_parts ) || empty( $footer_parts ) ){
						if( hello_shoppable_copyright_pro() ){
							?>
							<div class="col-lg-12 text-center"><?php get_template_part( 'template-parts/site', 'info' ); ?></div>
							<?php
						}
					}
					elseif( is_array( $footer_parts ) && !empty( $footer_parts ) && !hello_shoppable_copyright_pro() ) {
						?>
						<div class="bottom-footer-content d-sm-flex align-items-center justify-content-between">
							<?php									
								foreach ( $footer_parts as $footer_part ) {
									call_user_func( $footer_part );
								}
							?>
						</div>
						<?php
					}
					elseif( is_array( $footer_parts ) && !empty( $footer_parts ) && hello_shoppable_copyright_pro() ) {
						if( get_theme_mod( 'copyright_vertical_alignment', 'none' ) == 'none' ){
							?>
							<div class="row align-items-center">
								<?php if( get_theme_mod( 'copyright_horizontal_alignment', 'left' ) == 'left' ){ ?>
									<div class="col-lg-5">
										<?php get_template_part( 'template-parts/site', 'info' ); ?>
									</div>
								<?php } ?>
								<div class="col-lg-7">
									<div class="bottom-footer-content d-sm-flex align-items-center justify-content-between">
										<?php
										foreach ( $footer_parts as $footer_part ) {
											call_user_func( $footer_part );
										}
										?>
									</div>
								</div>
								<?php if( get_theme_mod( 'copyright_horizontal_alignment', 'left' ) == 'right' ){ ?>
									<div class="col-lg-5 text-right">
										<?php get_template_part( 'template-parts/site', 'info' ); ?>
									</div>
								<?php } ?>
							</div>
							<?php 
						}else{
							?>
							<div class="row">
								<?php if( get_theme_mod( 'copyright_vertical_alignment', 'none' ) == 'top' ){ ?>
									<div class="col-lg-12 text-center mb-3"><?php get_template_part( 'template-parts/site', 'info' ); ?></div>
								<?php } ?>
								<div class="col-lg-12">
									<div class="bottom-footer-content d-sm-flex align-items-center justify-content-between">
										<?php									
											foreach ( $footer_parts as $footer_part ) {
												call_user_func( $footer_part );
											}
										?>
									</div>
								</div>
								<?php if( get_theme_mod( 'copyright_vertical_alignment', 'none' ) == 'bottom' ){ ?>
									<div class="col-lg-12 text-center mt-3"><?php get_template_part( 'template-parts/site', 'info' ); ?> </div>
									<?php } ?>
							</div>
							<?php
						}
					}
					?>
				</div> 
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

<div id="back-to-top">
    <a href="javascript:void(0)"><i class="fa fa-angle-up"></i></a>
</div>
<!-- #back-to-top -->

</body>
</html>
