<?php
    $wp_customize->add_section('wpdevart_jewstore_top_header_section',array(
		'title'	=> esc_html__('Top Header','jewstore'),
		'priority'		=> 23
	));
	$wp_customize->add_setting( 'wpdevart_jewstore_enable_top_header',
    array(
       'default' => esc_html(''),
       'transport' => 'refresh',
       'sanitize_callback' => 'wpdevart_jewstore_switch_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Toggle_Switch_Custom_control( $wp_customize, 'wpdevart_jewstore_enable_top_header',
        array(
        'label' => esc_html__( 'Hide Top Header', 'jewstore' ),
        'section' => 'wpdevart_jewstore_top_header_section'
        )
    ) );
	$wp_customize->add_setting( 'wpdevart_jewstore_top_header_layout',
	array(
		'default' => esc_html('phoneleft'),
		'transport' => 'refresh',
		'sanitize_callback' => 'wpdevart_jewstore_text_sanitization'
	)
	);
	$wp_customize->add_control( new Wpdevart_Image_Radio_Button_Custom_Control( $wp_customize, 'wpdevart_jewstore_top_header_layout',
	array(
		'label' => esc_html__( 'Top header layout', 'jewstore' ),
		'description' => esc_html__( 'Select the position of the top header elements', 'jewstore' ),
		'section' => 'wpdevart_jewstore_top_header_section',
		'choices' => array(
		'phoneleft' => array(
			'image' => trailingslashit( get_template_directory_uri() ) . 'images/email-left.png',
			'name' => esc_html__( 'Phone and email on the left side', 'jewstore' )
		),
		'phonesocialcenter' => array(
			'image' => trailingslashit( get_template_directory_uri() ) . 'images/email-social-center.png',
			'name' => esc_html__( 'Center', 'jewstore' )
		),
		'phoneright' => array(
			'image' => trailingslashit( get_template_directory_uri() ) . 'images/email-right.png',
			'name' => esc_html__( 'Phone and email on the right side', 'jewstore' )
		)
		)
	)
	) );
	$wp_customize->add_setting('wpdevart_jewstore_top_header_bg_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_top_header_bg_color', esc_html('#ffffff')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_top_header_bg_color', array(
        'label' => esc_html__('Top header background color','jewstore'),
        'section' => 'wpdevart_jewstore_top_header_section',
        'settings' => 'wpdevart_jewstore_top_header_bg_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_top_header_gradient_type',array(
		'default'	=> esc_html('to right'),
		'sanitize_callback'	=> 'wpdevart_jewstore_text_sanitization'	
	));
	$wp_customize->add_control('wpdevart_jewstore_top_header_gradient_type',array(
			'label'	=> esc_html__('Gradient type','jewstore'),
			'section'	=> 'wpdevart_jewstore_top_header_section',
			'setting'	=> 'wpdevart_jewstore_top_header_gradient_type',
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
	$wp_customize->add_setting('wpdevart_jewstore_top_header_bg_gradient_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_top_header_bg_gradient_color', esc_html('#ffffff')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_top_header_bg_gradient_color', array(
        'label' => esc_html__('Top header gradient color','jewstore'),
        'section' => 'wpdevart_jewstore_top_header_section',
        'settings' => 'wpdevart_jewstore_top_header_bg_gradient_color'
    )));
	$wp_customize->add_setting( 'wpdevart_jewstore_enable_top_header_border',
    array(
       'default' => esc_html(''),
       'transport' => 'refresh',
       'sanitize_callback' => 'wpdevart_jewstore_switch_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Toggle_Switch_Custom_control( $wp_customize, 'wpdevart_jewstore_enable_top_header_border',
        array(
        'label' => esc_html__( 'Hide top header border', 'jewstore' ),
        'section' => 'wpdevart_jewstore_top_header_section'
        )
    ) );
	$wp_customize->add_setting('wpdevart_jewstore_top_header_border_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_top_header_border_color', esc_html('#f7f7f7')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_top_header_border_color', array(
        'label' => esc_html__('Top header border color','jewstore'),
        'section' => 'wpdevart_jewstore_top_header_section',
        'settings' => 'wpdevart_jewstore_top_header_border_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_top_header_text_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_top_header_text_color', esc_html('#000000')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_top_header_text_color', array(
        'label' => esc_html__('Top header text color','jewstore'),
        'section' => 'wpdevart_jewstore_top_header_section',
        'settings' => 'wpdevart_jewstore_top_header_text_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_top_header_phone_number',array(
		'default'	=> esc_html('(555) 555-1234'),
		'sanitize_callback'	=> 'wpdevart_jewstore_text_sanitization'	
	));
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'wpdevart_jewstore_top_header_phone_number',
            array(
                'label'    => esc_html__('Phone Number','jewstore'),
                'section'  => 'wpdevart_jewstore_top_header_section',
                'settings' => 'wpdevart_jewstore_top_header_phone_number',
                'type'     => 'text'
            )
        )
    );
	$wp_customize->add_setting('wpdevart_jewstore_top_header_email', array(
			'default'	=> esc_html('info@example.com'),
			'sanitize_callback' => 'sanitize_email'
		)
	);
	$wp_customize->add_control('wpdevart_jewstore_top_header_email', array(
			'label' => esc_html__( 'Email', 'jewstore' ),
			'section' => 'wpdevart_jewstore_top_header_section',
			'settings' => 'wpdevart_jewstore_top_header_email',
			'type' => 'email'
		)
	);
	$wp_customize->add_setting('wpdevart_jewstore_top_header_social_icons_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_top_header_social_icons_color', esc_html('#000000')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_top_header_social_icons_color', array(
        'label' => esc_html__('Social icons color','jewstore'),
        'section' => 'wpdevart_jewstore_top_header_section',
        'settings' => 'wpdevart_jewstore_top_header_social_icons_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_top_header_social_icons_bg_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_top_header_social_icons_bg_color', esc_html('#ffffff')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_top_header_social_icons_bg_color', array(
        'label' => esc_html__('Social icons background color','jewstore'),
        'section' => 'wpdevart_jewstore_top_header_section',
        'settings' => 'wpdevart_jewstore_top_header_social_icons_bg_color'
    )));
    $wp_customize->add_setting( 'wpdevart_jewstore_top_header_disable_twitter',
    array(
       'default' => esc_html(''),
       'transport' => 'refresh',
       'sanitize_callback' => 'wpdevart_jewstore_switch_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Toggle_Switch_Custom_control( $wp_customize, 'wpdevart_jewstore_top_header_disable_twitter',
        array(
        'label' => esc_html__( 'Hide Twitter icon', 'jewstore' ),
        'section' => 'wpdevart_jewstore_top_header_section'
        )
    ) );
	$wp_customize->add_setting('wpdevart_jewstore_top_header_twitter_url',array(
		'default'	=> esc_url('https://twitter.com'),
		'sanitize_callback'	=> 'wpdevart_jewstore_url_sanitization'	
	));
	$wp_customize->add_control('wpdevart_jewstore_top_header_twitter_url',array(
			'label'	=> esc_html__('Twitter page URL','jewstore'),
			'section'	=> 'wpdevart_jewstore_top_header_section',
			'setting'	=> 'wpdevart_jewstore_top_header_twitter_url'
	));	

    $wp_customize->add_setting( 'wpdevart_jewstore_top_header_disable_facebook',
    array(
       'default' => esc_html(''),
       'transport' => 'refresh',
       'sanitize_callback' => 'wpdevart_jewstore_switch_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Toggle_Switch_Custom_control( $wp_customize, 'wpdevart_jewstore_top_header_disable_facebook',
        array(
        'label' => esc_html__( 'Hide Facebook icon', 'jewstore' ),
        'section' => 'wpdevart_jewstore_top_header_section'
        )
    ) );
	$wp_customize->add_setting('wpdevart_jewstore_top_header_facebook_url',array(
		'default'	=> esc_url('https://www.facebook.com/'),
		'sanitize_callback'	=> 'wpdevart_jewstore_url_sanitization'	
	));
	$wp_customize->add_control('wpdevart_jewstore_top_header_facebook_url',array(
			'label'	=> esc_html__('Facebook page URL','jewstore'),
			'section'	=> 'wpdevart_jewstore_top_header_section',
			'setting'	=> 'wpdevart_jewstore_top_header_facebook_url'
	));	

	$wp_customize->add_setting( 'wpdevart_jewstore_top_header_disable_linkedin',
    array(
       'default' => esc_html(''),
       'transport' => 'refresh',
       'sanitize_callback' => 'wpdevart_jewstore_switch_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Toggle_Switch_Custom_control( $wp_customize, 'wpdevart_jewstore_top_header_disable_linkedin',
        array(
        'label' => esc_html__( 'Hide Linkedin icon', 'jewstore' ),
        'section' => 'wpdevart_jewstore_top_header_section'
        )
    ) );
	$wp_customize->add_setting('wpdevart_jewstore_top_header_linkedin_url',array(
		'default'	=> esc_url('https://www.linkedin.com'),
		'sanitize_callback'	=> 'wpdevart_jewstore_url_sanitization'	
	));
	$wp_customize->add_control('wpdevart_jewstore_top_header_linkedin_url',array(
			'label'	=> esc_html__('Linkedin page URL','jewstore'),
			'section'	=> 'wpdevart_jewstore_top_header_section',
			'setting'	=> 'wpdevart_jewstore_top_header_linkedin_url'
	));	

	$wp_customize->add_setting( 'wpdevart_jewstore_top_header_disable_youtube',
    array(
       'default' => esc_html(''),
       'transport' => 'refresh',
       'sanitize_callback' => 'wpdevart_jewstore_switch_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Toggle_Switch_Custom_control( $wp_customize, 'wpdevart_jewstore_top_header_disable_youtube',
        array(
        'label' => esc_html__( 'Hide YouTube icon', 'jewstore' ),
        'section' => 'wpdevart_jewstore_top_header_section'
        )
    ) );
	$wp_customize->add_setting('wpdevart_jewstore_top_header_youtube_url',array(
		'default'	=> esc_url('https://www.youtube.com/'),
		'sanitize_callback'	=> 'wpdevart_jewstore_url_sanitization'	
	));
	$wp_customize->add_control('wpdevart_jewstore_top_header_youtube_url',array(
			'label'	=> esc_html__('YouTube page URL','jewstore'),
			'section'	=> 'wpdevart_jewstore_top_header_section',
			'setting'	=> 'wpdevart_jewstore_top_header_youtube_url'
	));	

	$wp_customize->add_setting( 'wpdevart_jewstore_top_header_disable_instagram',
    array(
       'default' => esc_html(''),
       'transport' => 'refresh',
       'sanitize_callback' => 'wpdevart_jewstore_switch_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Toggle_Switch_Custom_control( $wp_customize, 'wpdevart_jewstore_top_header_disable_instagram',
        array(
        'label' => esc_html__( 'Hide Instagram icon', 'jewstore' ),
        'section' => 'wpdevart_jewstore_top_header_section'
        )
    ) );
	$wp_customize->add_setting('wpdevart_jewstore_top_header_instagram_url',array(
		'default'	=> esc_url('https://www.instagram.com/'),
		'sanitize_callback'	=> 'wpdevart_jewstore_url_sanitization'	
	));
	$wp_customize->add_control('wpdevart_jewstore_top_header_instagram_url',array(
			'label'	=> esc_html__('Instagram page URL','jewstore'),
			'section'	=> 'wpdevart_jewstore_top_header_section',
			'setting'	=> 'wpdevart_jewstore_top_header_instagram_url'
	));

	$wp_customize->add_setting( 'wpdevart_jewstore_top_header_disable_tiktok',
    array(
       'default' => esc_html(''),
       'transport' => 'refresh',
       'sanitize_callback' => 'wpdevart_jewstore_switch_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Toggle_Switch_Custom_control( $wp_customize, 'wpdevart_jewstore_top_header_disable_tiktok',
        array(
        'label' => esc_html__( 'Hide TikTok icon', 'jewstore' ),
        'section' => 'wpdevart_jewstore_top_header_section'
        )
    ) );
	$wp_customize->add_setting('wpdevart_jewstore_top_header_tiktok_url',array(
		'default'	=> esc_url('https://www.tiktok.com/'),
		'sanitize_callback'	=> 'wpdevart_jewstore_url_sanitization'	
	));
	$wp_customize->add_control('wpdevart_jewstore_top_header_tiktok_url',array(
			'label'	=> esc_html__('TikTok page URL','jewstore'),
			'section'	=> 'wpdevart_jewstore_top_header_section',
			'setting'	=> 'wpdevart_jewstore_top_header_tiktok_url'
	));

	$wp_customize->add_setting( 'wpdevart_jewstore_top_header_disable_pinterest',
    array(
       'default' => esc_html(''),
       'transport' => 'refresh',
       'sanitize_callback' => 'wpdevart_jewstore_switch_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Toggle_Switch_Custom_control( $wp_customize, 'wpdevart_jewstore_top_header_disable_pinterest',
        array(
        'label' => esc_html__( 'Hide Pinterest icon', 'jewstore' ),
        'section' => 'wpdevart_jewstore_top_header_section'
        )
    ) );
	$wp_customize->add_setting('wpdevart_jewstore_top_header_pinterest_url',array(
		'default'	=> esc_url('https://www.pinterest.com/'),
		'sanitize_callback'	=> 'wpdevart_jewstore_url_sanitization'	
	));
	$wp_customize->add_control('wpdevart_jewstore_top_header_pinterest_url',array(
			'label'	=> esc_html__('Pinterest page URL','jewstore'),
			'section'	=> 'wpdevart_jewstore_top_header_section',
			'setting'	=> 'wpdevart_jewstore_top_header_pinterest_url'
	));