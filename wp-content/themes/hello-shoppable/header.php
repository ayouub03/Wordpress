<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Hello Shoppable
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php do_action( 'wp_body_open' ); ?>

<?php if( get_theme_mod( 'preloader', true )): ?>
	<div id="site-preloader">
		<div class="preloader-content">
			<?php
				$src = '';
				if( get_theme_mod( 'preloader_animation', 'animation_one' ) == 'animation_one' ){
					$src = get_template_directory_uri() . '/assets/images/preloader1.gif';
				}elseif( get_theme_mod( 'preloader_animation', 'animation_one' ) == 'animation_two' ){
					$src = get_template_directory_uri() . '/assets/images/preloader2.gif';
				}elseif( get_theme_mod( 'preloader_animation', 'animation_one' ) == 'animation_three' ){
					$src = get_template_directory_uri() . '/assets/images/preloader3.gif';
				}elseif( get_theme_mod( 'preloader_animation', 'animation_one' ) == 'animation_four' ){
					$src = get_template_directory_uri() . '/assets/images/preloader4.gif';
				}elseif( get_theme_mod( 'preloader_animation', 'animation_one' ) == 'animation_five' ){
					$src = get_template_directory_uri() . '/assets/images/preloader5.gif';
				}elseif( get_theme_mod( 'preloader_animation', 'animation_one' ) == 'animation_six' ){
					$src = get_template_directory_uri() . '/assets/images/preloader6.gif';
				}elseif( get_theme_mod( 'preloader_animation', 'animation_one' ) == 'animation_seven' ){
					$src = get_template_directory_uri() . '/assets/images/preloader7.gif';
				}elseif( get_theme_mod( 'preloader_animation', 'animation_one' ) == 'animation_eight' ){
					$src = get_template_directory_uri() . '/assets/images/preloader8.gif';
				}elseif( get_theme_mod( 'preloader_animation', 'animation_one' ) == 'animation_nine' ){
					$src = get_template_directory_uri() . '/assets/images/preloader9.gif';
				}elseif( get_theme_mod( 'preloader_animation', 'animation_one' ) == 'animation_ten' ){
					$src = get_template_directory_uri() . '/assets/images/preloader10.gif';
				}elseif( get_theme_mod( 'preloader_animation', 'animation_one' ) == 'animation_site_logo' ){
					$src = hello_shoppable_get_custom_logo_url();
				}elseif( get_theme_mod( 'preloader_animation', 'animation_one' ) == 'animation_custom' ){
					$src = hello_shoppable_preloader_custom_image();
				}

				echo apply_filters( 'hello_shoppable_preloader', '<img src="'. esc_url( $src ) .'" alt="">'); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			?>
		</div>
	</div>
<?php endif; ?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'hello-shoppable' ); ?></a>

	<?php
	if( get_theme_mod( 'sticky_notification_bar', false ) ){
		$sticky_class = 'sticky';
	}else {
		$sticky_class = '';
	}

	if( get_theme_mod( 'enable_notification_bar', false ) ) {
		?>
		<div class="notification-bar mobile-sticky <?php echo esc_html( $sticky_class ); ?>">
			<div class="container">
				<div class="notification-wrap">
					<?php if( get_theme_mod( 'enable_notification_bar_title', false ) ){ ?>
						<header class="notification-content">
							<span><?php echo esc_html(get_theme_mod( 'notification_bar_title', '' ));?></span>
						</header>
					<?php } ?>
					<?php 
					if( get_theme_mod( 'top_notification_button', true ) && !empty( get_theme_mod( 'top_notification_button_text', '' ) ) ){ 
						?>
						<div class="button-container"> 
							<?php
							$top_notification_button_text 	= get_theme_mod( 'top_notification_button_text', '' );
							$top_notification_button_link 	= get_theme_mod( 'top_notification_button_link', '' );
							$top_notification_button_target = get_theme_mod( 'top_notification_button_target', true );   
			        		$link_target = '';
							if( $top_notification_button_target ){
								$link_target = '_blank';
								}
								?>
							<a href="<?php echo esc_url( $top_notification_button_link ); ?>" target="<?php echo esc_attr( $link_target ); ?>" class="button-primary">
							<?php echo esc_html( $top_notification_button_text ); ?>
							</a>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	<?php } ?>

	<?php
	// fixed header
	if ( get_theme_mod( 'fixed_header', false ) ) {
		get_template_part( 'template-parts/header/header', 'fixed' );
	}

	if( get_theme_mod( 'header_layout', 'header_one' ) == '' || get_theme_mod( 'header_layout', 'header_one' ) == 'header_one' ){
		get_template_part( 'template-parts/header/header', 'one' );
	}elseif( get_theme_mod( 'header_layout', 'header_one' ) == 'header_two' ){
		get_template_part( 'template-parts/header/header', 'two' );
	}elseif( get_theme_mod( 'header_layout', 'header_one' ) == 'header_three' ) {
		get_template_part( 'template-parts/header/header', 'three' );
	}elseif( get_theme_mod( 'header_layout', 'header_one' ) == 'header_four' ) {
		get_template_part( 'template-parts/header/header', 'four' );
	}
	?>