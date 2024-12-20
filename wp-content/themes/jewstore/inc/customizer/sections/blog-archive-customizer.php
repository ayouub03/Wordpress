<?php 
	$wp_customize->add_panel( 'wpdevart_jewstore_blog_archive_search_panel', 
	array(
		'title'	=> esc_html__('Blog/Archive/Search','jewstore'),			
		'description'	=> esc_html__('Blog/Archive/Search pages settings','jewstore'),		
		'priority'		=> 27
	) 
	);

	##################------ Blog/Archive Page ------##################

	$wp_customize->add_section('wpdevart_jewstore_blog_section',array(
		'title'	=> esc_html__('Blog/Archive Page','jewstore'),
		'priority'		=> null,
		'panel'         => 'wpdevart_jewstore_blog_archive_search_panel'
	));
	$wp_customize->add_setting('wpdevart_jewstore_archive_banner_width',array(
		'default'	=> esc_html('narrow'),
		'sanitize_callback'	=> 'wpdevart_jewstore_text_sanitization'	
	));
	$wp_customize->add_control('wpdevart_jewstore_archive_banner_width',array(
			'label'	=> esc_html__('Blog/Archive banner width','jewstore'),
			'section'	=> 'wpdevart_jewstore_blog_section',
			'setting'	=> 'wpdevart_jewstore_archive_banner_width',
			'type' => 'select',
			'choices' => array(
				'narrow' => esc_html__('Narrow','jewstore'),
				'wide' => esc_html__('Wide','jewstore')
				)
	));	
	$wp_customize->add_setting('wpdevart_jewstore_archive_banner_title_alignment',array(
		'default'	=> esc_html('center'),
		'sanitize_callback'	=> 'wpdevart_jewstore_text_sanitization'	
	));
	$wp_customize->add_control('wpdevart_jewstore_archive_banner_title_alignment',array(
			'label'	=> esc_html__('Blog/Archive title alignment','jewstore'),
			'section'	=> 'wpdevart_jewstore_blog_section',
			'setting'	=> 'wpdevart_jewstore_archive_banner_title_alignment',
			'type' => 'select',
			'choices' => array(
				'left' => esc_html__('Left','jewstore'),
				'center' => esc_html__('Center','jewstore'),
				'right' => esc_html__('Right','jewstore')
				)
	));	
	$wp_customize->add_setting('wpdevart_jewstore_archive_banner_bg_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_archive_banner_bg_color', esc_html('#ffffff')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_archive_banner_bg_color', array(
        'label' => esc_html__('Blog/Archive banner background color','jewstore'),
        'section' => 'wpdevart_jewstore_blog_section',
        'settings' => 'wpdevart_jewstore_archive_banner_bg_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_archive_banner_bg_gradient_type',array(
		'default'	=> esc_html('to right'),
		'sanitize_callback'	=> 'wpdevart_jewstore_text_sanitization'	
	));
	$wp_customize->add_control('wpdevart_jewstore_archive_banner_bg_gradient_type',array(
			'label'	=> esc_html__('Archive pages banner gradient type','jewstore'),
			'section'	=> 'wpdevart_jewstore_blog_section',
			'setting'	=> 'wpdevart_jewstore_archive_banner_bg_gradient_type',
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
	$wp_customize->add_setting('wpdevart_jewstore_archive_banner_bg_gradient_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_archive_banner_bg_gradient_color', esc_html('#fffdfc')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_archive_banner_bg_gradient_color', array(
        'label' => esc_html__('Archive pages banner gradient color','jewstore'),
        'section' => 'wpdevart_jewstore_blog_section',
        'settings' => 'wpdevart_jewstore_archive_banner_bg_gradient_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_archive_banner_title_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_archive_banner_title_color', esc_html('#000000')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_archive_banner_title_color', array(
        'label' => esc_html__('Blog/Archive title color','jewstore'),
        'section' => 'wpdevart_jewstore_blog_section',
        'settings' => 'wpdevart_jewstore_archive_banner_title_color'
    )));
    $wp_customize->add_setting( 'wpdevart_jewstore_blog_archive_page_layout',
	array(
		'default' => esc_html('sidebarright'),
		'transport' => 'refresh',
		'sanitize_callback' => 'wpdevart_jewstore_text_sanitization'
	)
	);
	$wp_customize->add_control( new Wpdevart_Image_Radio_Button_Custom_Control( $wp_customize, 'wpdevart_jewstore_blog_archive_page_layout',
	array(
		'label' => esc_html__( 'Blog/Archive Page Layout', 'jewstore' ),
		'description' => esc_html__( 'Choose the blog/archive page layout.', 'jewstore' ),
		'section' => 'wpdevart_jewstore_blog_section',
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

	##################------ Search Page ------##################

	$wp_customize->add_section('wpdevart_jewstore_search_page_section',array(
		'title'	=> esc_html__('Search Page','jewstore'),					
		'priority'		=> null,
		'panel'         => 'wpdevart_jewstore_blog_archive_search_panel'
	));


	$wp_customize->add_setting('wpdevart_jewstore_search_banner_width',array(
		'default'	=> esc_html('narrow'),
		'sanitize_callback'	=> 'wpdevart_jewstore_text_sanitization'	
	));
	$wp_customize->add_control('wpdevart_jewstore_search_banner_width',array(
			'label'	=> esc_html__('Search page banner width','jewstore'),
			'section'	=> 'wpdevart_jewstore_search_page_section',
			'setting'	=> 'wpdevart_jewstore_search_banner_width',
			'type' => 'select',
			'choices' => array(
				'narrow' => esc_html__('Narrow','jewstore'),
				'wide' => esc_html__('Wide','jewstore')
				)
	));
	$wp_customize->add_setting('wpdevart_jewstore_search_banner_title_alignment',array(
		'default'	=> esc_html('center'),
		'sanitize_callback'	=> 'wpdevart_jewstore_text_sanitization'	
	));
	$wp_customize->add_control('wpdevart_jewstore_search_banner_title_alignment',array(
			'label'	=> esc_html__('Search page title alignment','jewstore'),
			'section'	=> 'wpdevart_jewstore_search_page_section',
			'setting'	=> 'wpdevart_jewstore_search_banner_title_alignment',
			'type' => 'select',
			'choices' => array(
				'left' => esc_html__('Left','jewstore'),
				'center' => esc_html__('Center','jewstore'),
				'right' => esc_html__('Right','jewstore')
				)
	));
	$wp_customize->add_setting('wpdevart_jewstore_search_banner_bg_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_search_banner_bg_color', esc_html('#ffffff')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_search_banner_bg_color', array(
		'label' => esc_html__('Search page banner background color','jewstore'),
		'section' => 'wpdevart_jewstore_search_page_section',
		'settings' => 'wpdevart_jewstore_search_banner_bg_color'
	)));
	$wp_customize->add_setting('wpdevart_jewstore_search_banner_bg_gradient_type',array(
		'default'	=> esc_html('to right'),
		'sanitize_callback'	=> 'wpdevart_jewstore_text_sanitization'	
	));
	$wp_customize->add_control('wpdevart_jewstore_search_banner_bg_gradient_type',array(
			'label'	=> esc_html__('Search page banner gradient type','jewstore'),
			'section'	=> 'wpdevart_jewstore_search_page_section',
			'setting'	=> 'wpdevart_jewstore_search_banner_bg_gradient_type',
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
	$wp_customize->add_setting('wpdevart_jewstore_search_banner_bg_gradient_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_search_banner_bg_gradient_color', esc_html('#fffdfc')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_search_banner_bg_gradient_color', array(
        'label' => esc_html__('Search page banner gradient color','jewstore'),
        'section' => 'wpdevart_jewstore_search_page_section',
        'settings' => 'wpdevart_jewstore_search_banner_bg_gradient_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_search_banner_title_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_search_banner_title_color', esc_html('#000000')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_search_banner_title_color', array(
		'label' => esc_html__('Search page title color','jewstore'),
		'section' => 'wpdevart_jewstore_search_page_section',
		'settings' => 'wpdevart_jewstore_search_banner_title_color'
	)));	
	$wp_customize->add_setting( 'wpdevart_jewstore_search_page_layout',
	array(
		'default' => esc_html('sidebarright'),
		'transport' => 'refresh',
		'sanitize_callback' => 'wpdevart_jewstore_text_sanitization'
	)
	);
	$wp_customize->add_control( new Wpdevart_Image_Radio_Button_Custom_Control( $wp_customize, 'wpdevart_jewstore_search_page_layout',
	array(
		'label' => esc_html__( 'Search Page Layout', 'jewstore' ),
		'description' => esc_html__( 'Choose the search page layout.', 'jewstore' ),
		'section' => 'wpdevart_jewstore_search_page_section',
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
	$wp_customize->add_setting('wpdevart_jewstore_search_page_button_style',array(
		'default'	=> esc_html('wpdevart_jewstore_eighth_button_slide eighth_btn_slide_right'),
		'sanitize_callback'	=> 'wpdevart_jewstore_text_sanitization'	
	));
	$wp_customize->add_control('wpdevart_jewstore_search_page_button_style',array(
			'label'	=> esc_html__('Search button color','jewstore'),
			'section'	=> 'wpdevart_jewstore_search_page_section',
			'setting'	=> 'wpdevart_jewstore_search_page_button_style',
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

	##################------ General ------##################
	
	$wp_customize->add_section('wpdevart_jewstore_blog_archive_search_general_section',array(
		'title'	=> esc_html__('General','jewstore'),
		'description'	=> esc_html__('This is the global options page for the Blog/Archive/Search posts lists.','jewstore'),
		'priority'		=> null,
		'panel'         => 'wpdevart_jewstore_blog_archive_search_panel'
	));
	$wp_customize->add_setting('wpdevart_jewstore_blog_settings_posts_list_bg_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_blog_settings_posts_list_bg_color', esc_html('#ffffff')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_blog_settings_posts_list_bg_color', array(
        'label' => esc_html__('Summary/Post/Page block background color','jewstore'),
        'section' => 'wpdevart_jewstore_blog_archive_search_general_section',
        'settings' => 'wpdevart_jewstore_blog_settings_posts_list_bg_color'
    )));
	$wp_customize->add_setting( 'wpdevart_jewstore_blog_archive_display_default_featured_image',
    array(
       'default' => esc_html(''),
       'transport' => 'refresh',
       'sanitize_callback' => 'wpdevart_jewstore_switch_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Toggle_Switch_Custom_control( $wp_customize, 'wpdevart_jewstore_blog_archive_display_default_featured_image',
        array(
        'label' => esc_html__( 'Enable Default Featured Image', 'jewstore' ),
		'description' => esc_html__( 'Display the default featured image for posts that do not have a selected featured image.', 'jewstore' ),
        'section' => 'wpdevart_jewstore_blog_archive_search_general_section'
        )
    ) );
	$wp_customize->add_setting( 'wpdevart_jewstore_blog_settings_title_font_size',
    array(
       'default' => esc_html('22'),
       'sanitize_callback' => 'wpdevart_jewstore_sanitize_integer'
		)
	);
	$wp_customize->add_control( new Wpdevart_Slider_Custom_Control( $wp_customize, 'wpdevart_jewstore_blog_settings_title_font_size',
		array(
		'label' => esc_html__( 'Title font-size (px)', 'jewstore' ),
		'section' => 'wpdevart_jewstore_blog_archive_search_general_section',
		'input_attrs' => array(
			'min' => esc_html('15'),
			'max' => esc_html('50'),
			'step' => esc_html('1'),
		),
		)
	) );
	$wp_customize->add_setting('wpdevart_jewstore_blog_settings_title_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_blog_settings_title_color', esc_html('#000000')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_blog_settings_title_color', array(
        'label' => esc_html__('Title color','jewstore'),
        'section' => 'wpdevart_jewstore_blog_archive_search_general_section',
        'settings' => 'wpdevart_jewstore_blog_settings_title_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_blog_settings_title_hover_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_blog_settings_title_hover_color', esc_html('#f6901b')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_blog_settings_title_hover_color', array(
        'label' => esc_html__('Title hover color','jewstore'),
        'section' => 'wpdevart_jewstore_blog_archive_search_general_section',
        'settings' => 'wpdevart_jewstore_blog_settings_title_hover_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_blog_settings_title_border_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_blog_settings_title_border_color', esc_html('#dddddd')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_blog_settings_title_border_color', array(
        'label' => esc_html__('Title border color','jewstore'),
        'section' => 'wpdevart_jewstore_blog_archive_search_general_section',
        'settings' => 'wpdevart_jewstore_blog_settings_title_border_color'
    )));
	$wp_customize->add_setting( 'wpdevart_jewstore_blog_settings_metas_font_size',
    array(
       'default' => esc_html('12'),
       'sanitize_callback' => 'wpdevart_jewstore_sanitize_integer'
		)
	);
	$wp_customize->add_control( new Wpdevart_Slider_Custom_Control( $wp_customize, 'wpdevart_jewstore_blog_settings_metas_font_size',
		array(
		'label' => esc_html__( 'Entry metas font-size (px)', 'jewstore' ),
		'section' => 'wpdevart_jewstore_blog_archive_search_general_section',
		'input_attrs' => array(
			'min' => esc_html('10'),
			'max' => esc_html('30'),
			'step' => esc_html('1'),
		),
		)
	) );
	$wp_customize->add_setting('wpdevart_jewstore_blog_settings_metas_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_blog_settings_metas_color', esc_html('#f6901b')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_blog_settings_metas_color', array(
        'label' => esc_html__('Color of the metas','jewstore'),
        'section' => 'wpdevart_jewstore_blog_archive_search_general_section',
        'settings' => 'wpdevart_jewstore_blog_settings_metas_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_blog_settings_metas_hover_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_blog_settings_metas_hover_color', esc_html('#000000')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_blog_settings_metas_hover_color', array(
        'label' => esc_html__('Entry metas hover color','jewstore'),
        'section' => 'wpdevart_jewstore_blog_archive_search_general_section',
        'settings' => 'wpdevart_jewstore_blog_settings_metas_hover_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_blog_settings_meta_icons_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_blog_settings_meta_icons_color', esc_html('#000000')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_blog_settings_meta_icons_color', array(
        'label' => esc_html__('Icons color of the metas','jewstore'),
        'section' => 'wpdevart_jewstore_blog_archive_search_general_section',
        'settings' => 'wpdevart_jewstore_blog_settings_meta_icons_color'
    )));
	$wp_customize->add_setting( 'wpdevart_jewstore_blog_settings_content_text_font_size',
    array(
       'default' => esc_html('15'),
       'sanitize_callback' => 'wpdevart_jewstore_sanitize_integer'
		)
	);
	$wp_customize->add_control( new Wpdevart_Slider_Custom_Control( $wp_customize, 'wpdevart_jewstore_blog_settings_content_text_font_size',
		array(
		'label' => esc_html__( 'Content font-size (px)', 'jewstore' ),
		'section' => 'wpdevart_jewstore_blog_archive_search_general_section',
		'input_attrs' => array(
			'min' => esc_html('10'),
			'max' => esc_html('40'),
			'step' => esc_html('1'),
		),
		)
	) );
	$wp_customize->add_setting('wpdevart_jewstore_blog_settings_content_text_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_blog_settings_content_text_color', esc_html('#717171')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_blog_settings_content_text_color', array(
        'label' => esc_html__('Content text color','jewstore'),
        'section' => 'wpdevart_jewstore_blog_archive_search_general_section',
        'settings' => 'wpdevart_jewstore_blog_settings_content_text_color'
    )));
	$wp_customize->add_setting( 'wpdevart_jewstore_blog_settings_category_text_font_size',
    array(
       'default' => esc_html('13'),
       'sanitize_callback' => 'wpdevart_jewstore_sanitize_integer'
		)
	);
	$wp_customize->add_control( new Wpdevart_Slider_Custom_Control( $wp_customize, 'wpdevart_jewstore_blog_settings_category_text_font_size',
		array(
		'label' => esc_html__( 'Category font-size (px)', 'jewstore' ),
		'section' => 'wpdevart_jewstore_blog_archive_search_general_section',
		'input_attrs' => array(
			'min' => esc_html('10'),
			'max' => esc_html('40'),
			'step' => esc_html('1'),
		),
		)
	) );
	$wp_customize->add_setting('wpdevart_jewstore_blog_settings_category_bg_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_blog_settings_category_bg_color', esc_html('#ffffff')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_blog_settings_category_bg_color', array(
        'label' => esc_html__('Categories background color','jewstore'),
        'section' => 'wpdevart_jewstore_blog_archive_search_general_section',
        'settings' => 'wpdevart_jewstore_blog_settings_category_bg_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_blog_settings_category_border_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_blog_settings_category_border_color', esc_html('#f6901b')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_blog_settings_category_border_color', array(
        'label' => esc_html__('Categories border color','jewstore'),
        'section' => 'wpdevart_jewstore_blog_archive_search_general_section',
        'settings' => 'wpdevart_jewstore_blog_settings_category_border_color'
    )));	
	$wp_customize->add_setting('wpdevart_jewstore_blog_settings_category_text_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_blog_settings_category_text_color', esc_html('#f6901b')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_blog_settings_category_text_color', array(
        'label' => esc_html__('Categories text color','jewstore'),
        'section' => 'wpdevart_jewstore_blog_archive_search_general_section',
        'settings' => 'wpdevart_jewstore_blog_settings_category_text_color'
    )));	
	$wp_customize->add_setting('wpdevart_jewstore_blog_settings_category_bg_hover_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_blog_settings_category_bg_hover_color', esc_html('#f6901b')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_blog_settings_category_bg_hover_color', array(
        'label' => esc_html__('Categories background hover color','jewstore'),
        'section' => 'wpdevart_jewstore_blog_archive_search_general_section',
        'settings' => 'wpdevart_jewstore_blog_settings_category_bg_hover_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_blog_settings_category_border_hover_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_blog_settings_category_border_hover_color', esc_html('#f6901b')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_blog_settings_category_border_hover_color', array(
        'label' => esc_html__('Categories border hover color','jewstore'),
        'section' => 'wpdevart_jewstore_blog_archive_search_general_section',
        'settings' => 'wpdevart_jewstore_blog_settings_category_border_hover_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_blog_settings_category_text_hover_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_blog_settings_category_text_hover_color', esc_html('#ffffff')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_blog_settings_category_text_hover_color', array(
        'label' => esc_html__('Categories text hover color','jewstore'),
        'section' => 'wpdevart_jewstore_blog_archive_search_general_section',
        'settings' => 'wpdevart_jewstore_blog_settings_category_text_hover_color'
    )));

	##################------ Pagination ------##################

	$wp_customize->add_section('wpdevart_jewstore_pagination_settings',array(
		'title'	=> esc_html__('Pagination','jewstore'),					
		'priority'		=> null,
		'panel'         => 'wpdevart_jewstore_blog_archive_search_panel'
	));

	$wp_customize->add_setting('wpdevart_jewstore_pagination_buttons_bg_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_pagination_buttons_bg_color', esc_html('#ffffff')),
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_pagination_buttons_bg_color', array(
        'label' => esc_html__('Buttons background color','jewstore'),
        'section' => 'wpdevart_jewstore_pagination_settings',
        'settings' => 'wpdevart_jewstore_pagination_buttons_bg_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_pagination_buttons_border_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_pagination_buttons_border_color', esc_html('#f6901b')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_pagination_buttons_border_color', array(
        'label' => esc_html__('Buttons border color','jewstore'),
        'section' => 'wpdevart_jewstore_pagination_settings',
        'settings' => 'wpdevart_jewstore_pagination_buttons_border_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_pagination_buttons_link_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_pagination_buttons_link_color', esc_html('#f6901b')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_pagination_buttons_link_color', array(
        'label' => esc_html__('Text color of active buttons','jewstore'),
        'section' => 'wpdevart_jewstore_pagination_settings',
        'settings' => 'wpdevart_jewstore_pagination_buttons_link_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_pagination_buttons_text_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_pagination_buttons_text_color', esc_html('#f9c0d7')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_pagination_buttons_text_color', array(
        'label' => esc_html__('Text color of inactive buttons','jewstore'),
        'section' => 'wpdevart_jewstore_pagination_settings',
        'settings' => 'wpdevart_jewstore_pagination_buttons_text_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_pagination_buttons_bg_hover_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_pagination_buttons_bg_hover_color', esc_html('#f6901b')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_pagination_buttons_bg_hover_color', array(
        'label' => esc_html__('Buttons background hover color','jewstore'),
        'section' => 'wpdevart_jewstore_pagination_settings',
        'settings' => 'wpdevart_jewstore_pagination_buttons_bg_hover_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_pagination_buttons_border_hover_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_pagination_buttons_border_hover_color', esc_html('#f6901b')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_pagination_buttons_border_hover_color', array(
        'label' => esc_html__('Buttons border hover color','jewstore'),
        'section' => 'wpdevart_jewstore_pagination_settings',
        'settings' => 'wpdevart_jewstore_pagination_buttons_border_hover_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_pagination_buttons_link_hover_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_pagination_buttons_link_hover_color', esc_html('#ffffff')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_pagination_buttons_link_hover_color', array(
        'label' => esc_html__('Text color of active buttons on hover','jewstore'),
        'section' => 'wpdevart_jewstore_pagination_settings',
        'settings' => 'wpdevart_jewstore_pagination_buttons_link_hover_color'
    )));
	$wp_customize->add_setting('wpdevart_jewstore_pagination_buttons_text_hover_color',array(
		'default'	=> apply_filters( 'parent_wpdevart_jewstore_pagination_buttons_text_hover_color', esc_html('#f9c0d7')),
		'sanitize_callback'	=> 'sanitize_hex_color'	
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpdevart_jewstore_pagination_buttons_text_hover_color', array(
        'label' => esc_html__('Text color of inactive buttons on hover','jewstore'),
        'section' => 'wpdevart_jewstore_pagination_settings',
        'settings' => 'wpdevart_jewstore_pagination_buttons_text_hover_color'
    )));