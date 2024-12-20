<?php
function storess_upsale_setting( $wp_customize ) {
	
	$wp_customize->add_section(
        'storely_upsale',
        array(
            'title' 		=> __('Get More Features in Storess Pro','storess'),
			'priority'      => 1,
		)
    );
	
	/*=========================================
	 Buttons
	=========================================*/
	
	class Storess_Button_Customize_Control extends WP_Customize_Control {
	public $type = 'storely_upsale';

	   function render_content() {
		?>
			<div class="upsale_info">
				<ul>
					<li><a href="https://preview.sellerthemes.com/pro/storess/" class="btn-secondary" target="_blank"><i class="dashicons dashicons-desktop"></i><?php _e( 'Pro Demo','storess' ); ?> </a></li>
					
					<li><a href="https://sellerthemes.com/storess-premium/" class="btn-primary" target="_blank"><i class="dashicons dashicons-cart"></i><?php _e( 'Purchase Now','storess' ); ?> </a></li>
					
					<li><a href="https://sellerthemes.ticksy.com/" class="btn-secondary" target="_blank"><i class="dashicons dashicons-sos"></i><?php _e( 'Ask for Support','storess' ); ?> </a></li>
					
					<li><a href="https://wordpress.org/support/theme/storess/reviews/#new-post" class="btn-green" target="_blank"><i class="dashicons dashicons-heart"></i><?php _e( 'Give us Rating','storess' ); ?> </a></li>
				</ul>
			</div>
		<?php
	   }
	}
	
	$wp_customize->add_setting(
		'storely_upsale_btns',
		array(
		   'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'storely_sanitize_text',
		)	
	);
	
	$wp_customize->add_control( new Storess_Button_Customize_Control( $wp_customize, 'storely_upsale_btns', array(
		'section' => 'storely_upsale',
    ))
);
}
add_action( 'customize_register', 'storess_upsale_setting',999 );