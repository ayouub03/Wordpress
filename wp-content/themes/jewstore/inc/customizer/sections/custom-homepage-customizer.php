<?php
	$wp_customize->add_panel( 'wpdevart_jewstore_custom_homepage_panel', 
    array(
		'title'	=> esc_html__('Custom Homepage','jewstore'),
        'description'	=> esc_html__('Customize the theme custom homepage','jewstore'),		
		'priority'		=> 28
    ) 
	);
	$wp_customize->add_section('wpdevart_jewstore_custom_homepage_section',array(
		'title'	=> esc_html__('Enable Custom Homepage','jewstore'),
		'priority'		=> null,
		'panel'         => 'wpdevart_jewstore_custom_homepage_panel'
	));
    $wp_customize->add_setting( 'wpdevart_jewstore_custom_homepage_display_option',
    array(
       'default' => esc_html('1'),
       'transport' => 'refresh',
       'sanitize_callback' => 'wpdevart_jewstore_switch_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Toggle_Switch_Custom_control( $wp_customize, 'wpdevart_jewstore_custom_homepage_display_option',
        array(
        'label' => esc_html__( 'Enable custom homepage', 'jewstore' ),
		'description' => esc_html__( 'Display custom homepage instead of the latest posts', 'jewstore' ),
        'section' => 'wpdevart_jewstore_custom_homepage_section'
        )
    ) );

	$wp_customize->add_section('wpdevart_jewstore_custom_homepage_general_section',array(
		'title'	=> esc_html__('General','jewstore'),
		'priority'		=> null,
		'panel'         => 'wpdevart_jewstore_custom_homepage_panel'
	));
	$wp_customize->add_setting('wpdevart_jewstore_homepage_sections_title_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_homepage_sections_title_color', esc_html('#000000')),
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_homepage_sections_title_color', array(
        'label' => esc_html__('Sections Title Color','jewstore'),
        'section' => 'wpdevart_jewstore_custom_homepage_general_section',
        'settings' => 'wpdevart_jewstore_homepage_sections_title_color'
    )));
	
	$wp_customize->add_section('wpdevart_jewstore_custom_homepage_banner_section',array(
		'title'	=> esc_html__('Banner Section','jewstore'),
		'priority'		=> null,
		'panel'         => 'wpdevart_jewstore_custom_homepage_panel'
	));
	$wp_customize->add_setting('wpdevart_jewstore_custom_homepage_banner_theme',array(
		'default'	=> esc_html('banner-first-theme'),
		'sanitize_callback'	=> 'wpdevart_jewstore_text_sanitization'	
	));

	$wp_customize->add_control('wpdevart_jewstore_custom_homepage_banner_theme',array(
			'label'	=> esc_html__('Banner Theme','jewstore'),
			'section'	=> 'wpdevart_jewstore_custom_homepage_banner_section',
			'setting'	=> 'wpdevart_jewstore_custom_homepage_banner_theme',
			'type' => 'select',
			'choices' => array(
				'banner-first-theme' => esc_html__('First Theme', 'jewstore'),
				'banner-second-theme' => esc_html__('Second Theme', 'jewstore'),
				)
	));	
	$wp_customize->add_setting('wpdevart_jewstore_homepage_large_banner_bg_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_homepage_large_banner_bg_color', esc_html('#ffffff')),
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_homepage_large_banner_bg_color', array(
        'label' => esc_html__('Banner background color','jewstore'),
        'section' => 'wpdevart_jewstore_custom_homepage_banner_section',
        'settings' => 'wpdevart_jewstore_homepage_large_banner_bg_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_homepage_large_banner_bg_gradient_type',array(
		'default'	=> esc_html('to right'),
		'sanitize_callback'	=> 'wpdevart_jewstore_text_sanitization'
	));
	$wp_customize->add_control('wpdevart_jewstore_homepage_large_banner_bg_gradient_type',array(
			'label'	=> esc_html__('Gradient type','jewstore'),
			'section'	=> 'wpdevart_jewstore_custom_homepage_banner_section',
			'setting'	=> 'wpdevart_jewstore_homepage_large_banner_bg_gradient_type',
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
	$wp_customize->add_setting('wpdevart_jewstore_homepage_large_banner_bg_gradient_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_homepage_large_banner_bg_gradient_color', esc_html('#ffffff')),
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_homepage_large_banner_bg_gradient_color', array(
        'label' => esc_html__('Banner background gradient color','jewstore'),
        'section' => 'wpdevart_jewstore_custom_homepage_banner_section',
        'settings' => 'wpdevart_jewstore_homepage_large_banner_bg_gradient_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_custom_homepage_banner_short_description',array(
		'default'	=> esc_html('An online store that delivers more than expected!'),
		'sanitize_callback'	=> 'wpdevart_jewstore_text_sanitization'
	));
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'wpdevart_jewstore_custom_homepage_banner_short_description',
            array(
                'label'    => esc_html__('Banner short description','jewstore'),
                'section'  => 'wpdevart_jewstore_custom_homepage_banner_section',
                'settings' => 'wpdevart_jewstore_custom_homepage_banner_short_description',
                'type'     => 'text'
            )
        )
    );
    $wp_customize->add_setting( 'wpdevart_jewstore_custom_homepage_banner_short_description_font_size',
    array(
       'default' => esc_html('17'),
       'sanitize_callback' => 'wpdevart_jewstore_sanitize_integer'
		)
	);
	$wp_customize->add_control( new Wpdevart_Slider_Custom_Control( $wp_customize, 'wpdevart_jewstore_custom_homepage_banner_short_description_font_size',
		array(
		'label' => esc_html__( 'Short description font-size (px)', 'jewstore' ),
		'section' => 'wpdevart_jewstore_custom_homepage_banner_section',
		'input_attrs' => array(
			'min' => esc_html('1'),
			'max' => esc_html('35'),
			'step' => esc_html('1'),
		),
		)
	) );
	$wp_customize->add_setting('wpdevart_jewstore_custom_homepage_banner_short_description_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_custom_homepage_banner_short_description_color', esc_html('#333333')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_custom_homepage_banner_short_description_color', array(
        'label' => esc_html__('Short description color','jewstore'),
        'section' => 'wpdevart_jewstore_custom_homepage_banner_section',
        'settings' => 'wpdevart_jewstore_custom_homepage_banner_short_description_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_custom_homepage_banner_title',array(
		'default'	=> esc_html('Best Jewelry Store'),'jewstore',
		'sanitize_callback'	=> 'wpdevart_jewstore_text_sanitization'	
	));
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'wpdevart_jewstore_custom_homepage_banner_title',
            array(
                'label'    => esc_html__('Banner title','jewstore'),
                'section'  => 'wpdevart_jewstore_custom_homepage_banner_section',
                'settings' => 'wpdevart_jewstore_custom_homepage_banner_title',
                'type'     => 'text'
            )
        )
    );
    $wp_customize->add_setting( 'wpdevart_jewstore_custom_homepage_banner_title_font_size',
    array(
       'default' => esc_html('43'),
       'sanitize_callback' => 'wpdevart_jewstore_sanitize_integer'
		)
	);
	$wp_customize->add_control( new Wpdevart_Slider_Custom_Control( $wp_customize, 'wpdevart_jewstore_custom_homepage_banner_title_font_size',
		array(
		'label' => esc_html__( 'Title font-size (px)', 'jewstore' ),
		'section' => 'wpdevart_jewstore_custom_homepage_banner_section',
		'input_attrs' => array(
			'min' => esc_html('1'),
			'max' => esc_html('90'),
			'step' => esc_html('1'),
		),
		)
	) );
	$wp_customize->add_setting('wpdevart_jewstore_custom_homepage_banner_title_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_custom_homepage_banner_title_color', esc_html('#000000')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_custom_homepage_banner_title_color', array(
        'label' => esc_html__('Banner title color','jewstore'),
        'section' => 'wpdevart_jewstore_custom_homepage_banner_section',
        'settings' => 'wpdevart_jewstore_custom_homepage_banner_title_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_custom_homepage_banner_sliding_first_text',array(
		'default'	=> esc_html('Express Delivery'),'jewstore',
		'sanitize_callback'	=> 'wpdevart_jewstore_text_sanitization'	
	));
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'wpdevart_jewstore_custom_homepage_banner_sliding_first_text',
            array(
                'label'    => esc_html__('First sliding text','jewstore'),
                'section'  => 'wpdevart_jewstore_custom_homepage_banner_section',
                'settings' => 'wpdevart_jewstore_custom_homepage_banner_sliding_first_text',
                'type'     => 'text'
            )
        )
    );
	$wp_customize->add_setting('wpdevart_jewstore_custom_homepage_banner_sliding_second_text',array(
		'default'	=> esc_html('Valuable Prices'),'jewstore',
		'sanitize_callback'	=> 'wpdevart_jewstore_text_sanitization'	
	));
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'wpdevart_jewstore_custom_homepage_banner_sliding_second_text',
            array(
                'label'    => esc_html__('Second sliding text','jewstore'),
                'section'  => 'wpdevart_jewstore_custom_homepage_banner_section',
                'settings' => 'wpdevart_jewstore_custom_homepage_banner_sliding_second_text',
                'type'     => 'text'
            )
        )
    );
	$wp_customize->add_setting('wpdevart_jewstore_custom_homepage_banner_sliding_third_text',array(
		'default'	=> esc_html('24/7 Support'),'jewstore',
		'sanitize_callback'	=> 'wpdevart_jewstore_text_sanitization'	
	));
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'wpdevart_jewstore_custom_homepage_banner_sliding_third_text',
            array(
                'label'    => esc_html__('Third sliding text','jewstore'),
                'section'  => 'wpdevart_jewstore_custom_homepage_banner_section',
                'settings' => 'wpdevart_jewstore_custom_homepage_banner_sliding_third_text',
                'type'     => 'text'
            )
        )
    );
	$wp_customize->add_setting('wpdevart_jewstore_custom_homepage_banner_sliding_fourth_text',array(
		'default'	=> esc_html('Guaranteed Quality'),'jewstore',
		'sanitize_callback'	=> 'wpdevart_jewstore_text_sanitization'	
	));
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'wpdevart_jewstore_custom_homepage_banner_sliding_fourth_text',
            array(
                'label'    => esc_html__('Fourth sliding text','jewstore'),
                'section'  => 'wpdevart_jewstore_custom_homepage_banner_section',
                'settings' => 'wpdevart_jewstore_custom_homepage_banner_sliding_fourth_text',
                'type'     => 'text'
            )
        )
    );
    $wp_customize->add_setting( 'wpdevart_jewstore_custom_homepage_banner_sliding_text_font_size',
    array(
       'default' => esc_html('37'),
       'sanitize_callback' => 'wpdevart_jewstore_sanitize_integer'
		)
	);
	$wp_customize->add_control( new Wpdevart_Slider_Custom_Control( $wp_customize, 'wpdevart_jewstore_custom_homepage_banner_sliding_text_font_size',
		array(
		'label' => esc_html__( 'Sliding text font-size (px)', 'jewstore' ),
		'section' => 'wpdevart_jewstore_custom_homepage_banner_section',
		'input_attrs' => array(
			'min' => esc_html('35'),
			'max' => esc_html('40'),
			'step' => esc_html('1'),
		),
		)
	) );
	$wp_customize->add_setting('wpdevart_jewstore_custom_homepage_banner_sliding_text_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_custom_homepage_banner_sliding_text_color', esc_html('#f6901b')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_custom_homepage_banner_sliding_text_color', array(
        'label' => esc_html__('Sliding text title color','jewstore'),
        'section' => 'wpdevart_jewstore_custom_homepage_banner_section',
        'settings' => 'wpdevart_jewstore_custom_homepage_banner_sliding_text_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_custom_homepage_banner_content',array(
		'default'	=> esc_html('We offer all services in one place including express delivery, 24/7 support, competitive prices, and guaranteed quality. Use the navigation buttons below to find out more information about us and our services. Share and tell your friends about it.'),
		'sanitize_callback'	=> 'wpdevart_jewstore_text_sanitization'	
	));
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'wpdevart_jewstore_custom_homepage_banner_content',
            array(
                'label'    => esc_html__('Banner content text','jewstore'),
                'section'  => 'wpdevart_jewstore_custom_homepage_banner_section',
                'settings' => 'wpdevart_jewstore_custom_homepage_banner_content',
                'type'     => 'text'
            )
        )
    );
    $wp_customize->add_setting( 'wpdevart_jewstore_custom_homepage_banner_content_font_size',
    array(
       'default' => esc_html('17'),
       'sanitize_callback' => 'wpdevart_jewstore_sanitize_integer'
		)
	);
	$wp_customize->add_control( new Wpdevart_Slider_Custom_Control( $wp_customize, 'wpdevart_jewstore_custom_homepage_banner_content_font_size',
		array(
		'label' => esc_html__( 'Content text font-size (px)', 'jewstore' ),
		'section' => 'wpdevart_jewstore_custom_homepage_banner_section',
		'input_attrs' => array(
			'min' => esc_html('1'),
			'max' => esc_html('35'),
			'step' => esc_html('1'),
		),
		)
	) );
	$wp_customize->add_setting('wpdevart_jewstore_custom_homepage_banner_content_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_custom_homepage_banner_content_color', esc_html('#717171')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_custom_homepage_banner_content_color', array(
        'label' => esc_html__('Banner content text color','jewstore'),
        'section' => 'wpdevart_jewstore_custom_homepage_banner_section',
        'settings' => 'wpdevart_jewstore_custom_homepage_banner_content_color'
    )));
	$wp_customize->add_setting( 'wpdevart_jewstore_custom_homepage_show_banner_first_button',
    array(
       'default' => esc_html(''),
       'transport' => 'refresh',
       'sanitize_callback' => 'wpdevart_jewstore_switch_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Toggle_Switch_Custom_control( $wp_customize, 'wpdevart_jewstore_custom_homepage_show_banner_first_button',
        array(
        'label' => esc_html__( 'Hide the first button', 'jewstore' ),
        'section' => 'wpdevart_jewstore_custom_homepage_banner_section'
        )
    ) );
	$wp_customize->add_setting('wpdevart_jewstore_custom_homepage_banner_first_button_text',array(
		'default'	=> esc_html('More Details'),
		'sanitize_callback'	=> 'wpdevart_jewstore_text_sanitization'	
	));
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'wpdevart_jewstore_custom_homepage_banner_first_button_text',
            array(
                'label'    => esc_html__('First button text','jewstore'),
                'section'  => 'wpdevart_jewstore_custom_homepage_banner_section',
                'settings' => 'wpdevart_jewstore_custom_homepage_banner_first_button_text',
                'type'     => 'text'
            )
        )
    );
	$wp_customize->add_setting('wpdevart_jewstore_custom_homepage_banner_first_button_url',array(
		'default'	=> esc_url('#'),
		'sanitize_callback'	=> 'wpdevart_jewstore_url_sanitization'
	));
	$wp_customize->add_control('wpdevart_jewstore_custom_homepage_banner_first_button_url',array(
			'label'	=> esc_html__('First button URL','jewstore'),
			'section'	=> 'wpdevart_jewstore_custom_homepage_banner_section',
			'setting'	=> 'wpdevart_jewstore_custom_homepage_banner_first_button_url'
	));	
	$wp_customize->add_setting('wpdevart_jewstore_custom_homepage_banner_first_button_style',array(
		'default'	=> esc_html('wpdevart_jewstore_primary_button_slide primary_btn_slide_right'),
		'sanitize_callback'	=> 'wpdevart_jewstore_text_sanitization'	
	));

	$wp_customize->add_control('wpdevart_jewstore_custom_homepage_banner_first_button_style',array(
			'label'	=> esc_html__('First button color','jewstore'),
			'section'	=> 'wpdevart_jewstore_custom_homepage_banner_section',
			'setting'	=> 'wpdevart_jewstore_custom_homepage_banner_first_button_style',
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
	$wp_customize->add_setting( 'wpdevart_jewstore_custom_homepage_show_banner_second_button',
    array(
       'default' => esc_html(''),
       'transport' => 'refresh',
       'sanitize_callback' => 'wpdevart_jewstore_switch_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Toggle_Switch_Custom_control( $wp_customize, 'wpdevart_jewstore_custom_homepage_show_banner_second_button',
        array(
        'label' => esc_html__( 'Hide the second button', 'jewstore' ),
        'section' => 'wpdevart_jewstore_custom_homepage_banner_section'
        )
    ) );
	$wp_customize->add_setting('wpdevart_jewstore_custom_homepage_banner_second_button_text',array(
		'default'	=> esc_html('Shop Now'),
		'sanitize_callback'	=> 'wpdevart_jewstore_text_sanitization'	
	));
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'wpdevart_jewstore_custom_homepage_banner_second_button_text',
            array(
                'label'    => esc_html__('Second button text','jewstore'),
                'section'  => 'wpdevart_jewstore_custom_homepage_banner_section',
                'settings' => 'wpdevart_jewstore_custom_homepage_banner_second_button_text',
                'type'     => 'text'
            )
        )
    );
	$wp_customize->add_setting('wpdevart_jewstore_custom_homepage_banner_second_button_url',array(
		'default'	=> esc_url('#'),
		'sanitize_callback'	=> 'wpdevart_jewstore_url_sanitization'
	));
	$wp_customize->add_control('wpdevart_jewstore_custom_homepage_banner_second_button_url',array(
			'label'	=> esc_html__('Second button URL','jewstore'),
			'section'	=> 'wpdevart_jewstore_custom_homepage_banner_section',
			'setting'	=> 'wpdevart_jewstore_custom_homepage_banner_second_button_url'
	));	
	
	$wp_customize->add_setting('wpdevart_jewstore_custom_homepage_banner_second_button_style',array(
		'default'	=> esc_html('wpdevart_jewstore_eighth_button_slide eighth_btn_slide_right'),
		'sanitize_callback'	=> 'wpdevart_jewstore_text_sanitization'	
	));

	$wp_customize->add_control('wpdevart_jewstore_custom_homepage_banner_second_button_style',array(
			'label'	=> esc_html__('Second button color','jewstore'),
			'section'	=> 'wpdevart_jewstore_custom_homepage_banner_section',
			'setting'	=> 'wpdevart_jewstore_custom_homepage_banner_second_button_style',
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
	$wp_customize->add_setting('wpdevart_jewstore_custom_homepage_banner_image_1',array(
		'default'	=> esc_url(get_theme_file_uri('/images/banner-homepage-image-1.jpg')),
		'sanitize_callback'	=> 'wpdevart_jewstore_url_sanitization'
	));
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'wpdevart_jewstore_custom_homepage_banner_image_1', array(
        'label' => esc_html__('Banner Main Image','jewstore'),
		'description' => esc_html__( 'Recommended image size ~800*800', 'jewstore' ),
        'section' => 'wpdevart_jewstore_custom_homepage_banner_section',
        'settings' => 'wpdevart_jewstore_custom_homepage_banner_image_1',
        'button_labels' => array(
                    'select' => esc_html__('Select Image','jewstore'),
                    'remove' => esc_html__('Remove Image','jewstore'),
                    'change' => esc_html__('Change Image','jewstore'),
                    )
    )));
	$wp_customize->add_setting('wpdevart_jewstore_custom_homepage_banner_image_2',array(
		'default'	=> esc_url(get_theme_file_uri('/images/banner-homepage-image-2.jpg')),
		'sanitize_callback'	=> 'wpdevart_jewstore_url_sanitization'
	));
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'wpdevart_jewstore_custom_homepage_banner_image_2', array(
        'label' => esc_html__('Banner Second Image','jewstore'),
		'description' => esc_html__( 'Recommended image size ~800*800', 'jewstore' ),
        'section' => 'wpdevart_jewstore_custom_homepage_banner_section',
        'settings' => 'wpdevart_jewstore_custom_homepage_banner_image_2',
        'button_labels' => array(
                    'select' => esc_html__('Select Image','jewstore'),
                    'remove' => esc_html__('Remove Image','jewstore'),
                    'change' => esc_html__('Change Image','jewstore'),
                    )
    )));
	$wp_customize->add_setting('wpdevart_jewstore_custom_homepage_banner_image_3',array(
		'default'	=> esc_url(get_theme_file_uri('/images/banner-homepage-image-3.jpg')),
		'sanitize_callback'	=> 'wpdevart_jewstore_url_sanitization'
	));
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'wpdevart_jewstore_custom_homepage_banner_image_3', array(
        'label' => esc_html__('Banner Third Image','jewstore'),
		'description' => esc_html__( 'Recommended image size ~800*800', 'jewstore' ),
        'section' => 'wpdevart_jewstore_custom_homepage_banner_section',
        'settings' => 'wpdevart_jewstore_custom_homepage_banner_image_3',
        'button_labels' => array(
                    'select' => esc_html__('Select Image','jewstore'),
                    'remove' => esc_html__('Remove Image','jewstore'),
                    'change' => esc_html__('Change Image','jewstore'),
                    )
    )));
	$wp_customize->add_setting('wpdevart_jewstore_custom_homepage_banner_image_4',array(
		'default'	=> esc_url(get_theme_file_uri('/images/banner-homepage-image-4.png')),
		'sanitize_callback'	=> 'wpdevart_jewstore_url_sanitization'
	));
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'wpdevart_jewstore_custom_homepage_banner_image_4', array(
        'label' => esc_html__('Banner Fourth Image','jewstore'),
		'description' => esc_html__( 'Recommended image size ~800*800', 'jewstore' ),
        'section' => 'wpdevart_jewstore_custom_homepage_banner_section',
        'settings' => 'wpdevart_jewstore_custom_homepage_banner_image_4',
        'button_labels' => array(
                    'select' => esc_html__('Select Image','jewstore'),
                    'remove' => esc_html__('Remove Image','jewstore'),
                    'change' => esc_html__('Change Image','jewstore'),
                    )
    )));

	$wp_customize->add_section('wpdevart_jewstore_custom_homepage_call_action_section',array(
		'title'	=> esc_html__('Call to Action Section','jewstore'),					
		'priority'		=> null,
		'panel'         => 'wpdevart_jewstore_custom_homepage_panel'
	));

	$wp_customize->add_setting( 'wpdevart_jewstore_custom_homepage_hide_call_action',
    array(
       'default' => esc_html(''),
       'transport' => 'refresh',
       'sanitize_callback' => 'wpdevart_jewstore_switch_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Toggle_Switch_Custom_control( $wp_customize, 'wpdevart_jewstore_custom_homepage_hide_call_action',
        array(
        'label' => esc_html__( 'Hide Call to Action section', 'jewstore' ),
        'section' => 'wpdevart_jewstore_custom_homepage_call_action_section'
        )
    ) );
	$wp_customize->add_setting('wpdevart_jewstore_custom_homepage_call_action_title',array(
		'default'	=> esc_html('Best Offer'),
		'sanitize_callback'	=> 'wpdevart_jewstore_text_sanitization'	
	));
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'wpdevart_jewstore_custom_homepage_call_action_title',
            array(
                'label'    => esc_html__('Call to action title','jewstore'),
                'section'  => 'wpdevart_jewstore_custom_homepage_call_action_section',
                'settings' => 'wpdevart_jewstore_custom_homepage_call_action_title',
                'type'     => 'text'
            )
        )
    );
	$wp_customize->add_setting('wpdevart_jewstore_custom_homepage_call_action_desc',array(
		'default'	=> esc_html('A brief description of the section below.'),
		'sanitize_callback'	=> 'wpdevart_jewstore_text_sanitization'	
	));
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'wpdevart_jewstore_custom_homepage_call_action_desc',
            array(
                'label'    => esc_html__('Call to action description','jewstore'),
                'section'  => 'wpdevart_jewstore_custom_homepage_call_action_section',
                'settings' => 'wpdevart_jewstore_custom_homepage_call_action_desc',
                'type'     => 'text'
            )
        )
    );
	$wp_customize->add_setting('wpdevart_jewstore_custom_homepage_call_to_action_image',array(
		'default'	=> esc_url(get_theme_file_uri('/images/call-to-action.jpg')),
		'sanitize_callback'	=> 'wpdevart_jewstore_url_sanitization'
	));
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'wpdevart_jewstore_custom_homepage_call_to_action_image', array(
        'label' => esc_html__('Call To Action Image','jewstore'),
		'description' => esc_html__( 'Recommended image size ~1200*600', 'jewstore' ),
        'section' => 'wpdevart_jewstore_custom_homepage_call_action_section',
        'settings' => 'wpdevart_jewstore_custom_homepage_call_to_action_image',
        'button_labels' => array(
                    'select' => esc_html__('Select Image','jewstore'),
                    'remove' => esc_html__('Remove Image','jewstore'),
                    'change' => esc_html__('Change Image','jewstore'),
                    )
    )));
	$wp_customize->add_setting('wpdevart_jewstore_call_action_bg_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_call_action_bg_color', esc_html('#ffffff')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_call_action_bg_color', array(
        'label' => esc_html__('Call to action background color','jewstore'),
        'section' => 'wpdevart_jewstore_custom_homepage_call_action_section',
        'settings' => 'wpdevart_jewstore_call_action_bg_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_call_action_gradient_type',array(
		'default'	=> esc_html('to right'),
		'sanitize_callback'	=> 'wpdevart_jewstore_text_sanitization'	
	));
	$wp_customize->add_control('wpdevart_jewstore_call_action_gradient_type',array(
			'label'	=> esc_html__('Gradient type','jewstore'),
			'section'	=> 'wpdevart_jewstore_custom_homepage_call_action_section',
			'setting'	=> 'wpdevart_jewstore_call_action_gradient_type',
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
	$wp_customize->add_setting('wpdevart_jewstore_call_action_bg_gradient_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_call_action_bg_gradient_color', esc_html('#fcfcfc')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_call_action_bg_gradient_color', array(
        'label' => esc_html__('Call to action background gradient color','jewstore'),
        'section' => 'wpdevart_jewstore_custom_homepage_call_action_section',
        'settings' => 'wpdevart_jewstore_call_action_bg_gradient_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_custom_homepage_call_action_sub_title',array(
		'default'	=> esc_html('Call to Action Title'),
		'sanitize_callback'	=> 'wpdevart_jewstore_text_sanitization'	
	));
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'wpdevart_jewstore_custom_homepage_call_action_sub_title',
            array(
                'label'    => esc_html__('Call to action subtitle','jewstore'),
                'section'  => 'wpdevart_jewstore_custom_homepage_call_action_section',
                'settings' => 'wpdevart_jewstore_custom_homepage_call_action_sub_title',
                'type'     => 'text'
            )
        )
    );
	$wp_customize->add_setting('wpdevart_jewstore_call_action_sub_title_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_call_action_sub_title_color', esc_html('#717171')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_call_action_sub_title_color', array(
        'label' => esc_html__('Call to action subtitle color','jewstore'),
        'section' => 'wpdevart_jewstore_custom_homepage_call_action_section',
        'settings' => 'wpdevart_jewstore_call_action_sub_title_color'
    )));

    $wp_customize->add_setting( 'wpdevart_jewstore_call_action_sub_title_font_size',
    array(
       'default' => esc_html('30'),
       'sanitize_callback' => 'wpdevart_jewstore_sanitize_integer'
		)
	);
	$wp_customize->add_control( new Wpdevart_Slider_Custom_Control( $wp_customize, 'wpdevart_jewstore_call_action_sub_title_font_size',
		array(
		'label' => esc_html__( 'Call to action subtitle font-size (px)', 'jewstore' ),
		'section' => 'wpdevart_jewstore_custom_homepage_call_action_section',
		'input_attrs' => array(
			'min' => esc_html('25'),
			'max' => esc_html('45'),
			'step' => esc_html('1'),
		),
		)
	) );
	$wp_customize->add_setting('wpdevart_jewstore_custom_homepage_call_action_text',array(
		'default'	=> esc_html('This is sample text for a call to action section. You can use this section to encourage users to click a button and find out more information about your services.'),
		'sanitize_callback'	=> 'wpdevart_jewstore_text_sanitization'	
	));
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'wpdevart_jewstore_custom_homepage_call_action_text',
            array(
                'label'    => esc_html__('Call to action text','jewstore'),
                'section'  => 'wpdevart_jewstore_custom_homepage_call_action_section',
                'settings' => 'wpdevart_jewstore_custom_homepage_call_action_text',
                'type'     => 'text'
            )
        )
    );
	$wp_customize->add_setting('wpdevart_jewstore_call_action_text_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_call_action_text_color', esc_html('#717171')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_call_action_text_color', array(
        'label' => esc_html__('Call to action text color','jewstore'),
        'section' => 'wpdevart_jewstore_custom_homepage_call_action_section',
        'settings' => 'wpdevart_jewstore_call_action_text_color'
    )));

    $wp_customize->add_setting( 'wpdevart_jewstore_call_action_text_font_size',
    array(
       'default' => esc_html('16'),
       'sanitize_callback' => 'wpdevart_jewstore_sanitize_integer'
		)
	);
	$wp_customize->add_control( new Wpdevart_Slider_Custom_Control( $wp_customize, 'wpdevart_jewstore_call_action_text_font_size',
		array(
		'label' => esc_html__( 'Call to action text font-size (px)', 'jewstore' ),
		'section' => 'wpdevart_jewstore_custom_homepage_call_action_section',
		'input_attrs' => array(
			'min' => esc_html('15'),
			'max' => esc_html('45'),
			'step' => esc_html('1'),
		),
		)
	) );
	$wp_customize->add_setting('wpdevart_jewstore_custom_homepage_call_action_button_text',array(
		'default'	=> esc_html('Check More Details'),
		'sanitize_callback'	=> 'wpdevart_jewstore_text_sanitization'	
	));
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'wpdevart_jewstore_custom_homepage_call_action_button_text',
            array(
                'label'    => esc_html__('Call to action button text','jewstore'),
                'section'  => 'wpdevart_jewstore_custom_homepage_call_action_section',
                'settings' => 'wpdevart_jewstore_custom_homepage_call_action_button_text',
                'type'     => 'text'
            )
        )
    );
	$wp_customize->add_setting('wpdevart_jewstore_custom_homepage_call_action_button_url',array(
		'default'	=> esc_url('#'),
		'sanitize_callback'	=> 'wpdevart_jewstore_url_sanitization'	
	));
	$wp_customize->add_control('wpdevart_jewstore_custom_homepage_call_action_button_url',array(
			'label'	=> esc_html__('Call to action button URL','jewstore'),
			'section'	=> 'wpdevart_jewstore_custom_homepage_call_action_section',
			'setting'	=> 'wpdevart_jewstore_custom_homepage_call_action_button_url'
	));		

	$wp_customize->add_setting('wpdevart_jewstore_custom_homepage_call_action_button_style',array(
		'default'	=> esc_html('wpdevart_jewstore_primary_button_slide primary_btn_slide_right'),
		'sanitize_callback'	=> 'wpdevart_jewstore_text_sanitization'	
	));

	$wp_customize->add_control('wpdevart_jewstore_custom_homepage_call_action_button_style',array(
			'label'	=> esc_html__('Call to action button color','jewstore'),
			'section'	=> 'wpdevart_jewstore_custom_homepage_call_action_section',
			'setting'	=> 'wpdevart_jewstore_custom_homepage_call_action_button_style',
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
	$wp_customize->add_section('wpdevart_jewstore_custom_homepage_latest_posts_section',array(
		'title'	=> esc_html__('Latest Posts Section','jewstore'),					
		'priority'		=> null,
		'panel'         => 'wpdevart_jewstore_custom_homepage_panel'
	));

	$wp_customize->add_setting( 'wpdevart_jewstore_custom_homepage_hide_latest_post_section',
    array(
       'default' => esc_html(''),
       'transport' => 'refresh',
       'sanitize_callback' => 'wpdevart_jewstore_switch_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Toggle_Switch_Custom_control( $wp_customize, 'wpdevart_jewstore_custom_homepage_hide_latest_post_section',
        array(
        'label' => esc_html__( 'Hide Latest Posts section', 'jewstore' ),
        'section' => 'wpdevart_jewstore_custom_homepage_latest_posts_section'
        )
    ) );
	$wp_customize->add_setting('wpdevart_jewstore_custom_homepage_latest_post_title',array(
		'default'	=> esc_html('Latest Posts'),
		'sanitize_callback'	=> 'wpdevart_jewstore_text_sanitization'	
	));
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'wpdevart_jewstore_custom_homepage_latest_post_title',
            array(
                'label'    => esc_html__('Latest Posts section title','jewstore'),
                'section'  => 'wpdevart_jewstore_custom_homepage_latest_posts_section',
                'settings' => 'wpdevart_jewstore_custom_homepage_latest_post_title',
                'type'     => 'text'
            )
        )
    );
	$wp_customize->add_setting('wpdevart_jewstore_custom_homepage_latest_post_desctiption',array(
		'default'	=> esc_html('Latest posts from our blog'),
		'sanitize_callback'	=> 'wpdevart_jewstore_text_sanitization'	
	));
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'wpdevart_jewstore_custom_homepage_latest_post_desctiption',
            array(
                'label'    => esc_html__('Latest Posts section description','jewstore'),
                'section'  => 'wpdevart_jewstore_custom_homepage_latest_posts_section',
                'settings' => 'wpdevart_jewstore_custom_homepage_latest_post_desctiption',
                'type'     => 'text'
            )
        )
    );
	$wp_customize->add_setting( 'wpdevart_jewstore_custom_homepage_number_of_latest_posts',
    array(
       'default' => esc_html('6'),
       'sanitize_callback' => 'wpdevart_jewstore_sanitize_integer'
		)
	);
	$wp_customize->add_control( new Wpdevart_Slider_Custom_Control( $wp_customize, 'wpdevart_jewstore_custom_homepage_number_of_latest_posts',
		array(
		'label' => esc_html__( 'The number of posts', 'jewstore' ),
		'section' => 'wpdevart_jewstore_custom_homepage_latest_posts_section',
		'input_attrs' => array(
			'min' => esc_html('1'),
			'max' => esc_html('20'),
			'step' => esc_html('1'),
		),
		)
	) );
	$wp_customize->add_setting('wpdevart_jewstore_custom_homepage_latest_posts_block_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_custom_homepage_latest_posts_block_color', esc_html('#ffffff')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_custom_homepage_latest_posts_block_color', array(
        'label' => esc_html__('Latest posts block bg color','jewstore'),
        'section' => 'wpdevart_jewstore_custom_homepage_latest_posts_section',
        'settings' => 'wpdevart_jewstore_custom_homepage_latest_posts_block_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_custom_homepage_latest_posts_title_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_custom_homepage_latest_posts_title_color', esc_html('#000000')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_custom_homepage_latest_posts_title_color', array(
        'label' => esc_html__('Latest posts title color','jewstore'),
        'section' => 'wpdevart_jewstore_custom_homepage_latest_posts_section',
        'settings' => 'wpdevart_jewstore_custom_homepage_latest_posts_title_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_custom_homepage_latest_posts_text_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_custom_homepage_latest_posts_text_color', esc_html('#717171')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_custom_homepage_latest_posts_text_color', array(
        'label' => esc_html__('Latest posts text color','jewstore'),
        'section' => 'wpdevart_jewstore_custom_homepage_latest_posts_section',
        'settings' => 'wpdevart_jewstore_custom_homepage_latest_posts_text_color'
    )));