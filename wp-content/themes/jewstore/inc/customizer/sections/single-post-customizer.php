<?php 
	$wp_customize->add_panel( 'wpdevart_jewstore_single_post_page_panel', 
	array(
		'title'	=> esc_html__('Single Post/Page','jewstore'),			
		'description'	=> esc_html__('Single Post/Page settings','jewstore'),		
		'priority'		=> 25
	) 
	);

	##################------ Single Post ------##################

	$wp_customize->add_section('wpdevart_jewstore_single_post_section',array(
		'title'	=> esc_html__('Single Post','jewstore'),					
		'priority'		=> null,
		'panel'         => 'wpdevart_jewstore_single_post_page_panel'
	));

	$wp_customize->add_setting('wpdevart_jewstore_single_post_banner_width',array(
		'default'	=> esc_html('narrow'),
		'sanitize_callback'	=> 'wpdevart_jewstore_text_sanitization'	
	));
	$wp_customize->add_control('wpdevart_jewstore_single_post_banner_width',array(
			'label'	=> esc_html__('Single post banner width','jewstore'),
			'section'	=> 'wpdevart_jewstore_single_post_section',
			'setting'	=> 'wpdevart_jewstore_single_post_banner_width',
			'type' => 'select',
			'choices' => array(
				'narrow' => esc_html__('Narrow','jewstore'),
				'wide' => esc_html__('Wide','jewstore')
				)
	));	
	$wp_customize->add_setting('wpdevart_jewstore_single_post_title_alignment',array(
		'default'	=> esc_html('center'),
		'sanitize_callback'	=> 'wpdevart_jewstore_text_sanitization'	
	));
	$wp_customize->add_control('wpdevart_jewstore_single_post_title_alignment',array(
			'label'	=> esc_html__('Position of elements','jewstore'),
			'section'	=> 'wpdevart_jewstore_single_post_section',
			'setting'	=> 'wpdevart_jewstore_single_post_title_alignment',
			'type' => 'select',
			'choices' => array(
				'left' => esc_html__('Left','jewstore'),
				'center' => esc_html__('Center','jewstore'),
				'right' => esc_html__('Right','jewstore')
				)
	));	
	$wp_customize->add_setting('wpdevart_jewstore_single_post_banner_bg_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_single_post_banner_bg_color', esc_html('#ffffff')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_single_post_banner_bg_color', array(
        'label' => esc_html__('Single post banner BG color','jewstore'),
        'section' => 'wpdevart_jewstore_single_post_section',
        'settings' => 'wpdevart_jewstore_single_post_banner_bg_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_single_post_banner_gradient_type',array(
		'default'	=> esc_html('to right'),
		'sanitize_callback'	=> 'wpdevart_jewstore_text_sanitization'	
	));
	$wp_customize->add_control('wpdevart_jewstore_single_post_banner_gradient_type',array(
			'label'	=> esc_html__('Single post banner gradient type','jewstore'),
			'section'	=> 'wpdevart_jewstore_single_post_section',
			'setting'	=> 'wpdevart_jewstore_single_post_banner_gradient_type',
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
	$wp_customize->add_setting('wpdevart_jewstore_single_post_banner_gradient_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_single_post_banner_gradient_color', esc_html('#fffdfc')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_single_post_banner_gradient_color', array(
        'label' => esc_html__('Single post banner gradient color','jewstore'),
        'section' => 'wpdevart_jewstore_single_post_section',
        'settings' => 'wpdevart_jewstore_single_post_banner_gradient_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_single_post_banner_title_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_single_post_banner_title_color', esc_html('#000000')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_single_post_banner_title_color', array(
        'label' => esc_html__('Banner/Single Post title color','jewstore'),
        'section' => 'wpdevart_jewstore_single_post_section',
        'settings' => 'wpdevart_jewstore_single_post_banner_title_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_single_post_banner_entry_text_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_single_post_banner_entry_text_color', esc_html('#333333')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_single_post_banner_entry_text_color', array(
        'label' => esc_html__('Banner text color','jewstore'),
        'section' => 'wpdevart_jewstore_single_post_section',
        'settings' => 'wpdevart_jewstore_single_post_banner_entry_text_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_single_post_banner_entry_link_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_single_post_banner_entry_link_color', esc_html('#f6901b')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_single_post_banner_entry_link_color', array(
        'label' => esc_html__('Banner link color','jewstore'),
        'section' => 'wpdevart_jewstore_single_post_section',
        'settings' => 'wpdevart_jewstore_single_post_banner_entry_link_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_single_post_banner_entry_link_hover_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_single_post_banner_entry_link_hover_color', esc_html('#333333')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_single_post_banner_entry_link_hover_color', array(
        'label' => esc_html__('Banner link hover color','jewstore'),
        'section' => 'wpdevart_jewstore_single_post_section',
        'settings' => 'wpdevart_jewstore_single_post_banner_entry_link_hover_color'
    )));
    $wp_customize->add_setting( 'wpdevart_jewstore_single_post_layout',
	array(
		'default' => esc_html('sidebarright'),
		'transport' => 'refresh',
		'sanitize_callback' => 'wpdevart_jewstore_text_sanitization'
	)
	);
	$wp_customize->add_control( new Wpdevart_Image_Radio_Button_Custom_Control( $wp_customize, 'wpdevart_jewstore_single_post_layout',
	array(
		'label' => esc_html__( 'Single Post Layout', 'jewstore' ),
		'description' => esc_html__( 'Choose the single post layout.', 'jewstore' ),
		'section' => 'wpdevart_jewstore_single_post_section',
		'choices' => array(
		'sidebarleft' => array(
			'image' => trailingslashit( get_template_directory_uri() ) . 'images/sidebar-left.png',
			'name' => esc_html__( 'Left Sidebar', 'jewstore' )
		),
		'sidebarnone' => array(
			'image' => trailingslashit( get_template_directory_uri() ) . 'images/sidebar-none.png',
			'name' => esc_html__( 'No Sidebar', 'jewstore' )
		),
		'sidebarright' => array(
			'image' => trailingslashit( get_template_directory_uri() ) . 'images/sidebar-right.png',
			'name' => esc_html__( 'Right Sidebar', 'jewstore' )
		)
		)
	)
	) );

	##################------ Single Page ------##################

	$wp_customize->add_section('wpdevart_jewstore_single_page_section',array(
		'title'	=> esc_html__('Single Page','jewstore'),					
		'priority'		=> null,
		'panel'         => 'wpdevart_jewstore_single_post_page_panel'
	));

	$wp_customize->add_setting('wpdevart_jewstore_single_page_banner_width',array(
		'default'	=> esc_html('narrow'),
		'sanitize_callback'	=> 'wpdevart_jewstore_text_sanitization'	
	));
	$wp_customize->add_control('wpdevart_jewstore_single_page_banner_width',array(
			'label'	=> esc_html__('Single page banner width','jewstore'),
			'section'	=> 'wpdevart_jewstore_single_page_section',
			'setting'	=> 'wpdevart_jewstore_single_page_banner_width',
			'type' => 'select',
			'choices' => array(
				'narrow' => esc_html__('Narrow','jewstore'),
				'wide' => esc_html__('Wide','jewstore')
				)
	));	
	$wp_customize->add_setting('wpdevart_jewstore_single_page_title_alignment',array(
		'default'	=> esc_html('center'),
		'sanitize_callback'	=> 'wpdevart_jewstore_text_sanitization'	
	));
	$wp_customize->add_control('wpdevart_jewstore_single_page_title_alignment',array(
			'label'	=> esc_html__('Position of elements','jewstore'),
			'section'	=> 'wpdevart_jewstore_single_page_section',
			'setting'	=> 'wpdevart_jewstore_single_page_title_alignment',
			'type' => 'select',
			'choices' => array(
				'left' => esc_html__('Left','jewstore'),
				'center' => esc_html__('Center','jewstore'),
				'right' => esc_html__('Right','jewstore')
				)
	));	
	$wp_customize->add_setting('wpdevart_jewstore_single_page_banner_bg_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_single_page_banner_bg_color', esc_html('#ffffff')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_single_page_banner_bg_color', array(
        'label' => esc_html__('Single page banner BG color','jewstore'),
        'section' => 'wpdevart_jewstore_single_page_section',
        'settings' => 'wpdevart_jewstore_single_page_banner_bg_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_single_page_banner_gradient_type',array(
		'default'	=> esc_html('to right'),
		'sanitize_callback'	=> 'wpdevart_jewstore_text_sanitization'	
	));
	$wp_customize->add_control('wpdevart_jewstore_single_page_banner_gradient_type',array(
			'label'	=> esc_html__('Single page banner gradient type','jewstore'),
			'section'	=> 'wpdevart_jewstore_single_page_section',
			'setting'	=> 'wpdevart_jewstore_single_page_banner_gradient_type',
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
	$wp_customize->add_setting('wpdevart_jewstore_single_page_banner_gradient_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_single_page_banner_gradient_color', esc_html('#fffdfc')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_single_page_banner_gradient_color', array(
        'label' => esc_html__('Single page banner gradient color','jewstore'),
        'section' => 'wpdevart_jewstore_single_page_section',
        'settings' => 'wpdevart_jewstore_single_page_banner_gradient_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_single_page_banner_title_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_single_page_banner_title_color', esc_html('#000000')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_single_page_banner_title_color', array(
        'label' => esc_html__('Banner/Single page title color','jewstore'),
        'section' => 'wpdevart_jewstore_single_page_section',
        'settings' => 'wpdevart_jewstore_single_page_banner_title_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_single_page_banner_entry_text_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_single_page_banner_entry_text_color', esc_html('#333333')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_single_page_banner_entry_text_color', array(
        'label' => esc_html__('Banner text color','jewstore'),
        'section' => 'wpdevart_jewstore_single_page_section',
        'settings' => 'wpdevart_jewstore_single_page_banner_entry_text_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_single_page_banner_entry_link_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_single_page_banner_entry_link_color', esc_html('#f6901b')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_single_page_banner_entry_link_color', array(
        'label' => esc_html__('Banner link color','jewstore'),
        'section' => 'wpdevart_jewstore_single_page_section',
        'settings' => 'wpdevart_jewstore_single_page_banner_entry_link_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_single_page_banner_entry_link_hover_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_single_page_banner_entry_link_hover_color', esc_html('#333333')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_single_page_banner_entry_link_hover_color', array(
        'label' => esc_html__('Banner link hover color','jewstore'),
        'section' => 'wpdevart_jewstore_single_page_section',
        'settings' => 'wpdevart_jewstore_single_page_banner_entry_link_hover_color'
    )));
    $wp_customize->add_setting( 'wpdevart_jewstore_single_page_layout',
	array(
		'default' => esc_html('sidebarnone'),
		'transport' => 'refresh',
		'sanitize_callback' => 'wpdevart_jewstore_text_sanitization'
	)
	);
	$wp_customize->add_control( new Wpdevart_Image_Radio_Button_Custom_Control( $wp_customize, 'wpdevart_jewstore_single_page_layout',
	array(
		'label' => esc_html__( 'Single Page Layout', 'jewstore' ),
		'description' => esc_html__( 'Choose the single page layout.', 'jewstore' ),
		'section' => 'wpdevart_jewstore_single_page_section',
		'choices' => array(
		'sidebarleft' => array(
			'image' => trailingslashit( get_template_directory_uri() ) . 'images/sidebar-left.png',
			'name' => esc_html__( 'Left Sidebar', 'jewstore' )
		),
		'sidebarnone' => array(
			'image' => trailingslashit( get_template_directory_uri() ) . 'images/sidebar-none.png',
			'name' => esc_html__( 'No Sidebar', 'jewstore' )
		),
		'sidebarright' => array(
			'image' => trailingslashit( get_template_directory_uri() ) . 'images/sidebar-right.png',
			'name' => esc_html__( 'Right Sidebar', 'jewstore' )
		)
		)
	)
	) );

	##################------ Breadcrumbs ------##################

	$wp_customize->add_section('wpdevart_jewstore_breadcrumbs_section',array(
		'title'	=> esc_html__('Breadcrumbs','jewstore'),
		'description'	=> esc_html__('This section is for single posts and pages only. If you want to enable/edit WooCommerce breadcrumbs, you can do so from the WooCommerce WpDevArt section.','jewstore'),	
		'priority'		=> null,
		'panel'         => 'wpdevart_jewstore_single_post_page_panel'
	));

	$wp_customize->add_setting( 'wpdevart_jewstore_post_breadcrumbs_display_option',
    array(
       'default' => esc_html(''),
       'transport' => 'refresh',
       'sanitize_callback' => 'wpdevart_jewstore_switch_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Toggle_Switch_Custom_control( $wp_customize, 'wpdevart_jewstore_post_breadcrumbs_display_option',
        array(
        'label' => esc_html__( 'Enable Post Breadcrumbs', 'jewstore' ),
		'description' => esc_html__( 'Check the option if you need to display the breadcrumbs for the single post.', 'jewstore' ),
        'section' => 'wpdevart_jewstore_breadcrumbs_section'
        )
    ) );
	$wp_customize->add_setting( 'wpdevart_jewstore_page_breadcrumbs_display_option',
    array(
       'default' => esc_html(''),
       'transport' => 'refresh',
       'sanitize_callback' => 'wpdevart_jewstore_switch_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Toggle_Switch_Custom_control( $wp_customize, 'wpdevart_jewstore_page_breadcrumbs_display_option',
        array(
        'label' => esc_html__( 'Enable Page Breadcrumbs', 'jewstore' ),
		'description' => esc_html__( 'Check the option if you need to display the breadcrumbs for the single page.', 'jewstore' ),
        'section' => 'wpdevart_jewstore_breadcrumbs_section'
        )
    ) );
	$wp_customize->add_setting('wpdevart_jewstore_page_breadcrumbs_home_text',array(
		'default'	=> esc_html('Home'),'jewstore',
		'sanitize_callback'	=> 'wpdevart_jewstore_text_sanitization'	
	));
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'wpdevart_jewstore_page_breadcrumbs_home_text',
            array(
                'label'    => esc_html__('Breadcrumb Home Text','jewstore'),
                'section'  => 'wpdevart_jewstore_breadcrumbs_section',
                'settings' => 'wpdevart_jewstore_page_breadcrumbs_home_text',
                'type'     => 'text'
            )
        )
    );

	##################------ Comments ------##################

	$wp_customize->add_section('wpdevart_jewstore_comments_settings',array(
		'title'	=> esc_html__('Comments Box','jewstore'),
		'description'	=> esc_html__('The Comment Box is a block of user responses. Other comments section settings can be managed on the General settings page (for example, the Post Comment button can be controlled in the Primary Button section, or the text colors for Comment*, Name*, Email*, or Website can be controlled in the Colors section).','jewstore'),	
		'priority'		=> null,
		'panel'         => 'wpdevart_jewstore_single_post_page_panel'
	));
	$wp_customize->add_setting('wpdevart_jewstore_comments_reply_box_bg_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_comments_reply_box_bg_color', esc_html('#ffffff')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_comments_reply_box_bg_color', array(
        'label' => esc_html__('Comments reply box background color','jewstore'),
        'section' => 'wpdevart_jewstore_comments_settings',
        'settings' => 'wpdevart_jewstore_comments_reply_box_bg_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_comments_reply_box_text_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_comments_reply_box_text_color', esc_html('#333333')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_comments_reply_box_text_color', array(
        'label' => esc_html__('Comments reply box text color','jewstore'),
        'section' => 'wpdevart_jewstore_comments_settings',
        'settings' => 'wpdevart_jewstore_comments_reply_box_text_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_comments_reply_box_heading_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_comments_reply_box_heading_color', esc_html('#000000')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_comments_reply_box_heading_color', array(
        'label' => esc_html__('Comments reply box heading color','jewstore'),
        'section' => 'wpdevart_jewstore_comments_settings',
        'settings' => 'wpdevart_jewstore_comments_reply_box_heading_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_comments_reply_box_link_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_comments_reply_box_link_color', esc_html('#000000')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_comments_reply_box_link_color', array(
        'label' => esc_html__('Comments reply box link color','jewstore'),
        'section' => 'wpdevart_jewstore_comments_settings',
        'settings' => 'wpdevart_jewstore_comments_reply_box_link_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_comments_reply_box_link_hover_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_comments_reply_box_link_hover_color', esc_html('#f6901b')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_comments_reply_box_link_hover_color', array(
        'label' => esc_html__('Comments reply box link hover color','jewstore'),
        'section' => 'wpdevart_jewstore_comments_settings',
        'settings' => 'wpdevart_jewstore_comments_reply_box_link_hover_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_comments_reply_button_bg_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_comments_reply_button_bg_color', esc_html('#ffffff')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_comments_reply_button_bg_color', array(
        'label' => esc_html__('Comments reply button bg color','jewstore'),
        'section' => 'wpdevart_jewstore_comments_settings',
        'settings' => 'wpdevart_jewstore_comments_reply_button_bg_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_comments_reply_button_border_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_comments_reply_button_border_color', esc_html('#f6901b')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_comments_reply_button_border_color', array(
        'label' => esc_html__('Comments reply button border color','jewstore'),
        'section' => 'wpdevart_jewstore_comments_settings',
        'settings' => 'wpdevart_jewstore_comments_reply_button_border_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_comments_reply_button_link_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_comments_reply_button_link_color', esc_html('#f6901b')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_comments_reply_button_link_color', array(
        'label' => esc_html__('Comments reply button link color','jewstore'),
        'section' => 'wpdevart_jewstore_comments_settings',
        'settings' => 'wpdevart_jewstore_comments_reply_button_link_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_comments_reply_button_bg_hover_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_comments_reply_button_bg_hover_color', esc_html('#f6901b')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_comments_reply_button_bg_hover_color', array(
        'label' => esc_html__('Comments reply button bg hover color','jewstore'),
        'section' => 'wpdevart_jewstore_comments_settings',
        'settings' => 'wpdevart_jewstore_comments_reply_button_bg_hover_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_comments_reply_button_border_hover_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_comments_reply_button_border_hover_color', esc_html('#f6901b')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_comments_reply_button_border_hover_color', array(
        'label' => esc_html__('Comments reply button border hover color','jewstore'),
        'section' => 'wpdevart_jewstore_comments_settings',
        'settings' => 'wpdevart_jewstore_comments_reply_button_border_hover_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_comments_reply_button_link_hover_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_comments_reply_button_link_hover_color', esc_html('#ffffff')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_comments_reply_button_link_hover_color', array(
        'label' => esc_html__('Comments reply button link hover color','jewstore'),
        'section' => 'wpdevart_jewstore_comments_settings',
        'settings' => 'wpdevart_jewstore_comments_reply_button_link_hover_color'
    )));