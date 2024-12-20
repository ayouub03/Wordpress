<?php
/**
 * Template part for displaying site branding.
 *
 * @since Hello Shoppable 1.0.0
 */

?>

<div class="site-branding">
	<?php
	$the_custom_logo_url = hello_shoppable_get_custom_logo_url();
	if ( $the_custom_logo_url !== '' ) {
	?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<img src="<?php echo esc_url(  $the_custom_logo_url ); ?>" id="headerLogo">
		</a>
	<?php }	
		if( get_theme_mod( 'site_title', true ) ){
			if ( is_front_page() && is_home() ) :
				?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			else :
				?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;
		}
		$hello_shoppable_description = get_bloginfo( 'description', 'display' );
		if( get_theme_mod( 'site_tagline', true ) ){
			if ( $hello_shoppable_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo esc_html($hello_shoppable_description); ?></p>
			<?php endif;
		}
	?>
</div><!-- .site-branding -->