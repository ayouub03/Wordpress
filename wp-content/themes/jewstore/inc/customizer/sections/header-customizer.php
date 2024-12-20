<?php
	$wp_customize->add_panel( 'wpdevart_jewstore_header_panel', 
	array(
		'title'	=> esc_html__('Header','jewstore'),			
		'description'	=> esc_html__('Customize the theme header options','jewstore'),		
		'priority'		=> 24
	) 
	);
    $wp_customize->add_section('wpdevart_jewstore_header_section',array(
		'title'	=> esc_html__('General','jewstore'),					
		'priority'		=> null,
		'panel'         => 'wpdevart_jewstore_header_panel'
	));

	$wp_customize->add_setting( 'wpdevart_jewstore_header_layout',
	array(
		'default' => esc_html('headerlayoutone'),
		'transport' => 'refresh',
		'sanitize_callback' => 'wpdevart_jewstore_text_sanitization'
	)
	);
	$wp_customize->add_control( new Wpdevart_Image_Radio_Button_Custom_Control( $wp_customize, 'wpdevart_jewstore_header_layout',
	array(
		'label' => esc_html__( 'Header layout', 'jewstore' ),
		'description' => esc_html__( 'Select the position of the header elements', 'jewstore' ),
		'section' => 'wpdevart_jewstore_header_section',
		'choices' => array(
		'headerlayoutone' => array(
			'image' => trailingslashit( get_template_directory_uri() ) . 'images/header-layout-one.jpg',
			'name' => esc_html__( 'All header elements on one line', 'jewstore' )
		),
		'headerlayouttwo' => array(
			'image' => trailingslashit( get_template_directory_uri() ) . 'images/header-layout-two.jpg',
			'name' => esc_html__( 'Logo on the top side of the menu', 'jewstore' )
		),
		)
	)
	) );
	$wp_customize->add_setting('wpdevart_jewstore_header_bg_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_header_bg_color', esc_html('#ffffff')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_header_bg_color', array(
        'label' => esc_html__('Header background color','jewstore'),
        'section' => 'wpdevart_jewstore_header_section',
        'settings' => 'wpdevart_jewstore_header_bg_color'
    )));

	$wp_customize->add_setting('wpdevart_jewstore_header_gradient_type',array(
		'default'	=> esc_html('to right'),
		'sanitize_callback'	=> 'wpdevart_jewstore_text_sanitization'	
	));
	$wp_customize->add_control('wpdevart_jewstore_header_gradient_type',array(
			'label'	=> esc_html__('Gradient type','jewstore'),
			'section'	=> 'wpdevart_jewstore_header_section',
			'setting'	=> 'wpdevart_jewstore_header_gradient_type',
			'type' => 'select',
			'choices' => array(
				'to right' => esc_html__('To right','jewstore'),
				'to left' => esc_html__('To left','jewstore'),
				'to bottom' => esc_html__('To bottom','jewstore'),
				'to top' => esc_html__('To top','jewstore'),
				'to bottom right' => esc_html__('To bottom right','jewstore'),
				'to bottom left' => esc_html__('To bottom left','jewstore'),
				'to top right' => esc_html__('To top right','jewstore'),
				'to top left' => esc_html__('To top left','jewstore'),
				)
	));	
	$wp_customize->add_setting('wpdevart_jewstore_header_bg_gradient_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_header_bg_gradient_color', esc_html('#ffffff')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_header_bg_gradient_color', array(
        'label' => esc_html__('Header gradient color','jewstore'),
        'section' => 'wpdevart_jewstore_header_section',
        'settings' => 'wpdevart_jewstore_header_bg_gradient_color'
    )));
	$wp_customize->add_setting( 'wpdevart_jewstore_enable_main_header_border',
    array(
       'default' => esc_html(''),
       'transport' => 'refresh',
       'sanitize_callback' => 'wpdevart_jewstore_switch_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Toggle_Switch_Custom_control( $wp_customize, 'wpdevart_jewstore_enable_main_header_border',
        array(
        'label' => esc_html__( 'Hide the header border', 'jewstore' ),
        'section' => 'wpdevart_jewstore_header_section'
        )
    ) );
	$wp_customize->add_setting('wpdevart_jewstore_main_header_border_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_main_header_border_color', esc_html('#fbf8f8')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_main_header_border_color', array(
        'label' => esc_html__('Header border color','jewstore'),
        'section' => 'wpdevart_jewstore_header_section',
        'settings' => 'wpdevart_jewstore_main_header_border_color'
    )));
	$wp_customize->add_setting( 'wpdevart_jewstore_header_show_action_button',
    array(
       'default' => esc_html(''),
       'transport' => 'refresh',
       'sanitize_callback' => 'wpdevart_jewstore_switch_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Toggle_Switch_Custom_control( $wp_customize, 'wpdevart_jewstore_header_show_action_button',
        array(
        'label' => esc_html__( 'Hide the action button', 'jewstore' ),
        'section' => 'wpdevart_jewstore_header_section'
        )
    ) );
	$wp_customize->add_setting('wpdevart_jewstore_header_action_button_text',array(
		'default'	=> esc_html('Join Us'),
		'sanitize_callback'	=> 'wpdevart_jewstore_text_sanitization'	
	));
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'wpdevart_jewstore_header_action_button_text',
            array(
                'label'    => esc_html__('Header action button text','jewstore'),
                'section'  => 'wpdevart_jewstore_header_section',
                'settings' => 'wpdevart_jewstore_header_action_button_text',
                'type'     => 'text'
            )
        )
    );
	$wp_customize->add_setting('wpdevart_jewstore_header_action_button_url',array(
		'default'	=> esc_url('#'),
		'sanitize_callback'	=> 'wpdevart_jewstore_url_sanitization'
	));
	$wp_customize->add_control('wpdevart_jewstore_header_action_button_url',array(
			'label'	=> esc_html__('Header action button URL','jewstore'),
			'section'	=> 'wpdevart_jewstore_header_section',
			'setting'	=> 'wpdevart_jewstore_header_action_button_url'
	));	
	$wp_customize->add_setting('wpdevart_jewstore_header_action_button_style',array(
		'default'	=> esc_html('wpdevart_jewstore_eighth_button_slide eighth_btn_slide_right'),
		'sanitize_callback'	=> 'wpdevart_jewstore_text_sanitization'	
	));
	$wp_customize->add_control('wpdevart_jewstore_header_action_button_style',array(
			'label'	=> esc_html__('Header action button color','jewstore'),
			'section'	=> 'wpdevart_jewstore_header_section',
			'setting'	=> 'wpdevart_jewstore_header_action_button_style',
			'type' => 'select',
			'choices' => array(
				'wpdevart_jewstore_primary_button_slide primary_btn_slide_right' => esc_html__('Custom Primary', 'jewstore'),
				'wpdevart_jewstore_secondary_button_slide secondary_btn_slide_right' => esc_html__('Custom Secondary', 'jewstore'),
				'wpdevart_jewstore_first_button_slide first_btn_slide_right' => esc_html__('WpDevArt Color', 'jewstore'),
				'wpdevart_jewstore_second_button_slide second_btn_slide_right' => esc_html__('Grapefruit Red', 'jewstore'),
				'wpdevart_jewstore_third_button_slide third_btn_slide_right' => esc_html__('Blue', 'jewstore'),
				'wpdevart_jewstore_fourth_button_slide fourth_btn_slide_right' => esc_html__('Black', 'jewstore'),
				'wpdevart_jewstore_fifth_button_slide fifth_btn_slide_right' => esc_html__('Green', 'jewstore'),
				'wpdevart_jewstore_sixth_button_slide sixth_btn_slide_right' => esc_html__('Yellow', 'jewstore'),
				'wpdevart_jewstore_seventh_button_slide seventh_btn_slide_right' => esc_html__('Custom Green', 'jewstore'),
				'wpdevart_jewstore_eighth_button_slide eighth_btn_slide_right' => esc_html__('White', 'jewstore'),
				)
	));

	$wp_customize->add_section('wpdevart_jewstore_header_menu_search_section',array(
		'title'	=> esc_html__('Menu and Search','jewstore'),					
		'priority'		=> null,
		'panel'         => 'wpdevart_jewstore_header_panel'
	));
	$wp_customize->add_setting('wpdevart_jewstore_header_search_button_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_header_search_button_color', esc_html('#f6901b')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_header_search_button_color', array(
        'label' => esc_html__('Search button color','jewstore'),
        'section' => 'wpdevart_jewstore_header_menu_search_section',
        'settings' => 'wpdevart_jewstore_header_search_button_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_header_menu_items_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_header_menu_items_color', esc_html('#000000')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_header_menu_items_color', array(
        'label' => esc_html__('Menu items color','jewstore'),
        'section' => 'wpdevart_jewstore_header_menu_search_section',
        'settings' => 'wpdevart_jewstore_header_menu_items_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_main_header_sub_menu_bg_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_main_header_sub_menu_bg_color', esc_html('#ffffff')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_main_header_sub_menu_bg_color', array(
        'label' => esc_html__('Sub menu background color','jewstore'),
        'section' => 'wpdevart_jewstore_header_menu_search_section',
        'settings' => 'wpdevart_jewstore_main_header_sub_menu_bg_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_main_header_sub_menu_items_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_main_header_sub_menu_items_color', esc_html('#000000')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_main_header_sub_menu_items_color', array(
        'label' => esc_html__('Sub menu items color','jewstore'),
        'section' => 'wpdevart_jewstore_header_menu_search_section',
        'settings' => 'wpdevart_jewstore_main_header_sub_menu_items_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_main_header_sub_menu_top_border_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_main_header_sub_menu_top_border_color', esc_html('#f6901b')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_main_header_sub_menu_top_border_color', array(
        'label' => esc_html__('Sub menu border color','jewstore'),
        'section' => 'wpdevart_jewstore_header_menu_search_section',
        'settings' => 'wpdevart_jewstore_main_header_sub_menu_top_border_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_header_mobile_menu_background_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_header_mobile_menu_background_color', esc_html('#fcfcfc')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_header_mobile_menu_background_color', array(
        'label' => esc_html__('Mobile toolbar background color','jewstore'),
        'section' => 'wpdevart_jewstore_header_menu_search_section',
        'settings' => 'wpdevart_jewstore_header_mobile_menu_background_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_mobile_menu_bg_gradient_type',array(
		'default'	=> esc_html('to right'),
		'sanitize_callback'	=> 'wpdevart_jewstore_text_sanitization'	
	));
	$wp_customize->add_control('wpdevart_jewstore_mobile_menu_bg_gradient_type',array(
			'label'	=> esc_html__('Gradient type','jewstore'),
			'section'	=> 'wpdevart_jewstore_header_menu_search_section',
			'setting'	=> 'wpdevart_jewstore_mobile_menu_bg_gradient_type',
			'type' => 'select',
			'choices' => array(
				'to right' => esc_html__('To right','jewstore'),
				'to left' => esc_html__('To left','jewstore'),
				'to bottom' => esc_html__('To bottom','jewstore'),
				'to top' => esc_html__('To top','jewstore'),
				'to bottom right' => esc_html__('To bottom right','jewstore'),
				'to bottom left' => esc_html__('To bottom left','jewstore'),
				'to top right' => esc_html__('To top right','jewstore'),
				'to top left' => esc_html__('To top left','jewstore'),
				)
	));	
	$wp_customize->add_setting('wpdevart_jewstore_mobile_menu_bg_gradient_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_mobile_menu_bg_gradient_color', esc_html('#fcfcfc')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_mobile_menu_bg_gradient_color', array(
        'label' => esc_html__('Mobile toolbar background gradient color','jewstore'),
        'section' => 'wpdevart_jewstore_header_menu_search_section',
        'settings' => 'wpdevart_jewstore_mobile_menu_bg_gradient_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_header_descktop_search_button_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_header_descktop_search_button_color', esc_html('#f6901b')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_header_descktop_search_button_color', array(
        'label' => esc_html__('Mobile search button color','jewstore'),
        'section' => 'wpdevart_jewstore_header_menu_search_section',
        'settings' => 'wpdevart_jewstore_header_descktop_search_button_color'
    )));

	$wp_customize->add_setting('wpdevart_jewstore_header_mobile_menu_button_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_header_mobile_menu_button_color', esc_html('#f6901b')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_header_mobile_menu_button_color', array(
        'label' => esc_html__('Mobile menu button color','jewstore'),
        'section' => 'wpdevart_jewstore_header_menu_search_section',
        'settings' => 'wpdevart_jewstore_header_mobile_menu_button_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_main_header_mobile_menu_background_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_main_header_mobile_menu_background_color', esc_html('#ffffff')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_main_header_mobile_menu_background_color', array(
        'label' => esc_html__('Mobile menu background color','jewstore'),
        'section' => 'wpdevart_jewstore_header_menu_search_section',
        'settings' => 'wpdevart_jewstore_main_header_mobile_menu_background_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_main_header_mobile_menu_link_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_main_header_mobile_menu_link_color', esc_html('#000000')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_main_header_mobile_menu_link_color', array(
        'label' => esc_html__('Mobile menu link color','jewstore'),
        'section' => 'wpdevart_jewstore_header_menu_search_section',
        'settings' => 'wpdevart_jewstore_main_header_mobile_menu_link_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_main_header_mobile_menu_border_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_main_header_mobile_menu_border_color', esc_html('#f7f7f7')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_main_header_mobile_menu_border_color', array(
        'label' => esc_html__('Mobile menu borders color','jewstore'),
        'section' => 'wpdevart_jewstore_header_menu_search_section',
        'settings' => 'wpdevart_jewstore_main_header_mobile_menu_border_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_main_header_mobile_sub_menu_button_bg_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_main_header_mobile_sub_menu_button_bg_color', esc_html('#f6901b')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_main_header_mobile_sub_menu_button_bg_color', array(
        'label' => esc_html__('Mobile sub-menu button BG color','jewstore'),
        'section' => 'wpdevart_jewstore_header_menu_search_section',
        'settings' => 'wpdevart_jewstore_main_header_mobile_sub_menu_button_bg_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_main_header_mobile_sub_menu_button_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_main_header_mobile_sub_menu_button_color', esc_html('#ffffff')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_main_header_mobile_sub_menu_button_color', array(
        'label' => esc_html__('Mobile sub-menu button color','jewstore'),
        'section' => 'wpdevart_jewstore_header_menu_search_section',
        'settings' => 'wpdevart_jewstore_main_header_mobile_sub_menu_button_color'
    )));

	if ( class_exists( 'WooCommerce' ) ) {
		$wp_customize->add_section('wpdevart_jewstore_header_woo_cart',array(
			'title'	=> esc_html__('WooCommerce','jewstore'),					
			'priority'		=> null,
			'panel'         => 'wpdevart_jewstore_header_panel'
		));
		$wp_customize->add_setting('wpdevart_jewstore_woocommerce_account_icon_color',array(
			'default'	=> apply_filters( 'parent_wpdevart_jewstore_woocommerce_account_icon_color', esc_html('#f6901b')),
			'sanitize_callback'	=> 'sanitize_hex_color'	
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_woocommerce_account_icon_color', array(
			'label' => esc_html__('WooCommerce account icon color','jewstore'),
			'section' => 'wpdevart_jewstore_header_woo_cart',
			'settings' => 'wpdevart_jewstore_woocommerce_account_icon_color'
		)));
		$wp_customize->add_setting('wpdevart_jewstore_woocommerce_cart_icon_color',array(
			'default'	=> apply_filters( 'parent_wpdevart_jewstore_woocommerce_cart_icon_color', esc_html('#f6901b')),
			'sanitize_callback'	=> 'sanitize_hex_color'	
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_woocommerce_cart_icon_color', array(
			'label' => esc_html__('WooCommerce cart icon color','jewstore'),
			'section' => 'wpdevart_jewstore_header_woo_cart',
			'settings' => 'wpdevart_jewstore_woocommerce_cart_icon_color'
		)));
		$wp_customize->add_setting('wpdevart_jewstore_woocommerce_cart_icon_number_color',array(
			'default'	=> apply_filters( 'parent_wpdevart_jewstore_woocommerce_cart_icon_number_color', esc_html('#ffffff')),
			'sanitize_callback'	=> 'sanitize_hex_color'	
		));
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_woocommerce_cart_icon_number_color', array(
			'label' => esc_html__('WooCommerce cart number color','jewstore'),
			'section' => 'wpdevart_jewstore_header_woo_cart',
			'settings' => 'wpdevart_jewstore_woocommerce_cart_icon_number_color'
		)));
	};