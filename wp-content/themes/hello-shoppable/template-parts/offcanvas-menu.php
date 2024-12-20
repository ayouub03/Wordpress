<?php
/** 
* Template for Off canvas Menu
* @since Hello Shoppable 1.0.0
*/
?>
<div id="offcanvas-menu" class="offcanvas-menu-wrap">
	<div class="close-offcanvas-menu">
		<button class="fas fa-times"></button>
	</div>
	<div class="offcanvas-menu-inner">
		<div class="offcanvas-menu-content">
			<?php
			if( get_theme_mod( 'header_layout', 'header_one' ) == 'header_four' && get_theme_mod('header_advertisement_banner_button',true)){
			    if( get_theme_mod( 'header_advertisement_banner', '' ) != '' && get_theme_mod( 'mobile_ad_banner', true ) ){
			    	?>
				    <div class="d-md-none"> 
				    	<?php hello_shoppable_header_advertisement_banner(); ?> 
				    </div>
					<?php
				}
			}
			
			if( hello_shoppable_is_mobile_top_bar_enable() ){
				$header_parts = get_theme_mod( 'top_bar_sortable', '' );
				if( is_array( $header_parts ) && !empty( $header_parts ) ){ 
					foreach ( $header_parts as $header_part ) {
						if( $header_part == 'hello_shoppable_top_bar_menu' ){
							if( get_theme_mod( 'secondary_menu', true ) ){
								?>
								<div class="d-lg-none">
									<?php call_user_func( $header_part ); ?>
								</div>
								<?php
							}
						}elseif( $header_part == 'header_contact_info' ){
							if( get_theme_mod( 'mobile_contact_details', true ) ){
								?>
								<div class="d-lg-none">
									<?php get_template_part( 'template-parts/header', 'contact' ); ?>
								</div>
								<?php
							}
						}elseif( $header_part == 'hello_shoppable_top_bar_text' ){
							if( get_theme_mod( 'mobile_top_bar_text', true ) ){
								?>
								<div class="d-lg-none">
									<?php call_user_func( $header_part ); ?>
								</div>
								<?php
							}
						}elseif( $header_part == 'hello_shoppable_social' ){
							if( get_theme_mod( 'mobile_social_icons_header', true ) ){
								?>
								<div class="d-lg-none">
									<?php call_user_func( $header_part ); ?>
								</div>
								<?php
							}
						}
					}
				}
			}

			if ( get_theme_mod( 'header_button', true ) && get_theme_mod( 'mobile_header_buttons', true ) && !empty( get_theme_mod( 'header_button_text', '' ) ) ){
					?>
				<div class="header-btn-wrap d-lg-none">
					<div class="header-btn">
						<?php hello_shoppable_header_buttons(); ?>
					</div>
            	</div>	 
            	<?php
		    }
			?>
		</div>
	</div>
</div>