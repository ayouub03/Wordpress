<?php

    $wp_customize->register_section_type( 'Wpdevart_Premium_Features_List' );


	##################------ Premium Features Sections ------##################

	$wp_customize->add_section(
		new Wpdevart_Premium_Features_List(
			$wp_customize,
			'wpdevart_jewstore_theme_general_features',
			array(
				'title'         => esc_html__( 'Even More Options in the Premium Version!', 'jewstore' ),
                'upsell_link'  => apply_filters( 'parent_wpdevart_jewstore_premium_features_url', esc_url('https://wpdevart.com/jewstore-best-wordpress-jewelry-store-theme')),
				'premium_features_list' => array(
					esc_html__( '+40 Other Popular Fonts', 'jewstore' ),
					esc_html__( 'Wide and Full-Width Layouts', 'jewstore' ),
					esc_html__( 'Preloader', 'jewstore' ),
                    esc_html__( 'Button Animation', 'jewstore' ),
                    esc_html__( '+6 Beautiful Patterns', 'jewstore' ),
					esc_html__( 'Customizable Search Overlay', 'jewstore' ),
					esc_html__( 'Back To Top Button', 'jewstore' ),
					esc_html__( '... and Other Premium Features', 'jewstore' ),
				),
				'panel'         => 'wpdevart_jewstore_general_settings_panel',
				'priority'      => 7777,
			)
		)
	);

	$wp_customize->add_section(
		new Wpdevart_Premium_Features_List(
			$wp_customize,
			'wpdevart_jewstore_theme_header_features',
			array(
				'title'         => esc_html__( 'Even More Options in the Premium Version!', 'jewstore' ),
                'upsell_link'  => apply_filters( 'parent_wpdevart_jewstore_premium_features_url', esc_url('https://wpdevart.com/jewstore-best-wordpress-jewelry-store-theme')),
				'premium_features_list' => array(
					esc_html__( 'Sticky Header Feature', 'jewstore' ),
					esc_html__( 'Sticky Header Feature for Mobile', 'jewstore' ),
                    esc_html__( 'Logo Animations', 'jewstore' ),
					esc_html__( 'Search Button Animations', 'jewstore' ),
                    esc_html__( 'Woo Cart Animations', 'jewstore' ),
					esc_html__( 'Wide and Full-Width Layouts', 'jewstore' ),
					esc_html__( '... and Other Premium Features', 'jewstore' ),
				),
				'panel'         => 'wpdevart_jewstore_header_panel',
				'priority'      => 7777,
			)
		)
	);

	$wp_customize->add_section(
		new Wpdevart_Premium_Features_List(
			$wp_customize,
			'wpdevart_jewstore_theme_single_post_page_features',
			array(
				'title'         => esc_html__( 'Even More Options in the Premium Version!', 'jewstore' ),
                'upsell_link'  => apply_filters( 'parent_wpdevart_jewstore_premium_features_url', esc_url('https://wpdevart.com/jewstore-best-wordpress-jewelry-store-theme')),
				'premium_features_list' => array(
					esc_html__( '+6 Beautiful Patterns', 'jewstore' ),
                    esc_html__( 'Post/Page Title Animations', 'jewstore' ),
					esc_html__( 'Post/Page Banner Animations', 'jewstore' ),
                    esc_html__( '4 Animated Banner Elements', 'jewstore' ),
					esc_html__( 'Animated Elements Colors', 'jewstore' ),
					esc_html__( 'Wide and Full-Width Layouts', 'jewstore' ),
					esc_html__( '... and Other Premium Features', 'jewstore' ),
				),
				'panel'         => 'wpdevart_jewstore_single_post_page_panel',
				'priority'      => 7777,
			)
		)
	);

	$wp_customize->add_section(
		new Wpdevart_Premium_Features_List(
			$wp_customize,
			'wpdevart_jewstore_theme_blog_archive_search_features',
			array(
				'title'         => esc_html__( 'Even More Options in the Premium Version!', 'jewstore' ),
                'upsell_link'  => apply_filters( 'parent_wpdevart_jewstore_premium_features_url', esc_url('https://wpdevart.com/jewstore-best-wordpress-jewelry-store-theme')),
				'premium_features_list' => array(
					esc_html__( 'Images Hover Effects', 'jewstore' ),
					esc_html__( 'Archive/Search Page Title Animations', 'jewstore' ),
                    esc_html__( 'Archive/Search Page Banner Animations', 'jewstore' ),
					esc_html__( '4 Animated Elements', 'jewstore' ),
                    esc_html__( 'Animated Elements Colors', 'jewstore' ),
					esc_html__( 'Wide and Full-Width Layouts', 'jewstore' ),
					esc_html__( '... and Other Premium Features', 'jewstore' ),
				),
				'panel'         => 'wpdevart_jewstore_blog_archive_search_panel',
				'priority'      => 7777,
			)
		)
	);

    $wp_customize->add_section(
		new Wpdevart_Premium_Features_List(
			$wp_customize,
			'wpdevart_jewstore_theme_custom_homepage_features',
			array(
				'title'         => esc_html__( 'Even More Options in the Premium Version!', 'jewstore' ),
                'upsell_link'  => apply_filters( 'parent_wpdevart_jewstore_premium_features_url', esc_url('https://wpdevart.com/jewstore-best-wordpress-jewelry-store-theme')),
				'premium_features_list' => array(
                    esc_html__( '+4 Beautiful Banner Themes', 'jewstore' ),
                    esc_html__( 'Homepage Sections Positions', 'jewstore' ),
					esc_html__( 'WooCommerce Section', 'jewstore' ),
					esc_html__( 'Sales Section', 'jewstore' ),
                    esc_html__( 'Benefits of Ordering Section', 'jewstore' ),
                    esc_html__( 'Shop by Brand Section', 'jewstore' ),
                    esc_html__( 'Shop by Category Section', 'jewstore' ),
					esc_html__( 'Achievements Section', 'jewstore' ),
					esc_html__( 'Advantages Section', 'jewstore' ),
					esc_html__( 'Services Section', 'jewstore' ),
					esc_html__( 'Sections Description Color', 'jewstore' ),
					esc_html__( 'Sections Title Lines Color', 'jewstore' ),
					esc_html__( 'Wide and Full-Width Layouts', 'jewstore' ),
					esc_html__( '... and Other Premium Features', 'jewstore' ),
				),
				'panel'         => 'wpdevart_jewstore_custom_homepage_panel',
				'priority'      => 7777,
			)
		)
	);

	$wp_customize->add_section(
		new Wpdevart_Premium_Features_List(
			$wp_customize,
			'wpdevart_jewstore_theme_woo_features',
			array(
				'title'         => esc_html__( 'Even More Options in the Premium Version!', 'jewstore' ),
                'upsell_link'  => apply_filters( 'parent_wpdevart_jewstore_premium_features_url', esc_url('https://wpdevart.com/jewstore-best-wordpress-jewelry-store-theme')),
				'premium_features_list' => array(
                    esc_html__( 'WooCommerce Search Bar Section', 'jewstore' ),
                    esc_html__( 'Customizable Category List and Search Bar', 'jewstore' ),
					esc_html__( 'WooCommerce Breadcrumbs', 'jewstore' ),
					esc_html__( 'WooCommerce Header Cart Design', 'jewstore' ),
                    esc_html__( 'WooCommerce Button Animation', 'jewstore' ),
					esc_html__( 'WooCommerce Sidebar Options', 'jewstore' ),
					esc_html__( 'Wide and Full-Width Layouts', 'jewstore' ),
					esc_html__( '... and Other Premium Features', 'jewstore' ),
				),
				'panel'         => 'wpdevart_jewstore_woocommerce_settings_panel',
				'priority'      => 7777,
			)
		)
	);
        
    ##################------ Premium Features Controls------##################

    $wp_customize->add_setting( 'wpdevart_jewstore_logo_settings_premium_features',
    array(
        'sanitize_callback' => 'wpdevart_jewstore_text_sanitization',
    )
    );
    $wp_customize->add_control( new Wpdevart_Premium_Features_Control_List( $wp_customize, 'wpdevart_jewstore_logo_settings_premium_features',
    array(
        'label' => esc_html__( 'More Features in the Premium Version!', 'jewstore' ),
        'section' => 'title_tagline',
        'priority' => 50,
        'choices' => array(
            'feature1' => array(
                'name' => esc_html__( 'Logo Animation', 'jewstore' )
            ),
            'feature2' => array(
                'name' => esc_html__( 'Text Logo Font-size', 'jewstore' )
            ),
            'feature3' => array(
                'name' => esc_html__( 'Text Logo Font Weight', 'jewstore' )
            ),
            'feature4' => array(
                'name' => esc_html__( 'Site Description Color', 'jewstore' )
            ),
            'feature5' => array(
                'name' => esc_html__( 'Site Description Font-size', 'jewstore' )
            ),
            'feature6' => array(
                'name' => esc_html__( '... and Other Premium Features', 'jewstore' )
            ),
        )
    )
    ) );

    $wp_customize->add_setting( 'wpdevart_jewstore_font_settings_premium_features',
    array(
        'sanitize_callback' => 'wpdevart_jewstore_text_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Premium_Features_Control_List( $wp_customize, 'wpdevart_jewstore_font_settings_premium_features',
    array(
        'label' => esc_html__( 'More Features in the Premium Version!', 'jewstore' ),
        'section' => 'wpdevart_jewstore_fonts_section',
        'priority' => 777,
        'choices' => array(
            'feature1' => array(
                'name' => esc_html__( '+40 Other Popular Fonts', 'jewstore' )
            ),
            'feature2' => array(
                'name' => esc_html__( '... and Other Premium Features', 'jewstore' )
            ),
        )
    )
    ) );

    $wp_customize->add_setting( 'wpdevart_jewstore_primary_button_settings_premium_features',
    array(
        'sanitize_callback' => 'wpdevart_jewstore_text_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Premium_Features_Control_List( $wp_customize, 'wpdevart_jewstore_primary_button_settings_premium_features',
    array(
        'label' => esc_html__( 'More Features in the Premium Version!', 'jewstore' ),
        'section' => 'wpdevart_jewstore_primary_button_settings',
        'priority' => 777,
        'choices' => array(
            'feature1' => array(
                'name' => esc_html__( 'Button Animation', 'jewstore' )
            ),
            'feature2' => array(
                'name' => esc_html__( '... and Other Premium Features', 'jewstore' )
            ),
        )
    )
    ) );

    $wp_customize->add_setting( 'wpdevart_jewstore_header_general_settings_premium_features',
    array(
        'sanitize_callback' => 'wpdevart_jewstore_text_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Premium_Features_Control_List( $wp_customize, 'wpdevart_jewstore_header_general_settings_premium_features',
    array(
        'label' => esc_html__( 'More Features in the Premium Version!', 'jewstore' ),
        'section' => 'wpdevart_jewstore_header_section',
        'priority' => 777,
        'choices' => array(
            'feature1' => array(
                'name' => esc_html__( 'Sticky Header Feature', 'jewstore' )
            ),
            'feature2' => array(
                'name' => esc_html__( 'Sticky Header Feature for Mobile', 'jewstore' )
            ),
            'feature3' => array(
                'name' => esc_html__( 'Animations for Header Elements', 'jewstore' )
            ),
            'feature4' => array(
                'name' => esc_html__( '... and Other Premium Features', 'jewstore' )
            ),
        )
    )
    ) );

    $wp_customize->add_setting( 'wpdevart_jewstore_top_header_settings_premium_features',
    array(
        'sanitize_callback' => 'wpdevart_jewstore_text_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Premium_Features_Control_List( $wp_customize, 'wpdevart_jewstore_top_header_settings_premium_features',
    array(
        'label' => esc_html__( 'More Features in the Premium Version!', 'jewstore' ),
        'section' => 'wpdevart_jewstore_top_header_section',
        'priority' => 777,
        'choices' => array(
            'feature1' => array(
                'name' => esc_html__( 'Address Section', 'jewstore' )
            ),
            'feature2' => array(
                'name' => esc_html__( 'Phone/Email/Address Icon Color', 'jewstore' )
            ),
            'feature3' => array(
                'name' => esc_html__( 'Animations for Top Header Elements', 'jewstore' )
            ),
            'feature4' => array(
                'name' => esc_html__( '... and Other Premium Features', 'jewstore' )
            ),
        )
    )
    ) );
    
    $wp_customize->add_setting( 'wpdevart_jewstore_header_menu_search_settings_premium_features',
    array(
        'sanitize_callback' => 'wpdevart_jewstore_text_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Premium_Features_Control_List( $wp_customize, 'wpdevart_jewstore_header_menu_search_settings_premium_features',
    array(
        'label' => esc_html__( 'More Features in the Premium Version!', 'jewstore' ),
        'section' => 'wpdevart_jewstore_header_menu_search_section',
        'priority' => 777,
        'choices' => array(
            'feature1' => array(
                'name' => esc_html__( 'Search Button Animations', 'jewstore' )
            ),
            'feature2' => array(
                'name' => esc_html__( '... and Other Premium Features', 'jewstore' )
            ),
        )
    )
    ) );

	if ( class_exists( 'WooCommerce' ) ) {
    $wp_customize->add_setting( 'wpdevart_jewstore_woo_primary_button_settings_premium_features',
    array(
        'sanitize_callback' => 'wpdevart_jewstore_text_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Premium_Features_Control_List( $wp_customize, 'wpdevart_jewstore_woo_primary_button_settings_premium_features',
    array(
        'label' => esc_html__( 'More Features in the Premium Version!', 'jewstore' ),
        'section' => 'woocommerce_primary_button_colors_section',
        'priority' => 777,
        'choices' => array(
            'feature1' => array(
                'name' => esc_html__( 'WooCommerce Button Animation', 'jewstore' )
            ),
            'feature2' => array(
                'name' => esc_html__( '... and Other Premium Features', 'jewstore' )
            ),
        )
    )
    ) );
    };

    $wp_customize->add_setting( 'wpdevart_jewstore_single_post_settings_premium_features',
    array(
        'sanitize_callback' => 'wpdevart_jewstore_text_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Premium_Features_Control_List( $wp_customize, 'wpdevart_jewstore_single_post_settings_premium_features',
    array(
        'label' => esc_html__( 'More Features in the Premium Version!', 'jewstore' ),
        'section' => 'wpdevart_jewstore_single_post_section',
        'priority' => 777,
        'choices' => array(
            'feature1' => array(
                'name' => esc_html__( '+6 Beautiful Patterns', 'jewstore' )
            ),
            'feature2' => array(
                'name' => esc_html__( 'Title Animations', 'jewstore' )
            ),
            'feature3' => array(
                'name' => esc_html__( 'Banner Animations', 'jewstore' )
            ),
            'feature4' => array(
                'name' => esc_html__( '4 Animated Elements', 'jewstore' )
            ),
            'feature5' => array(
                'name' => esc_html__( 'Animated Elements Colors', 'jewstore' )
            ),
            'feature6' => array(
                'name' => esc_html__( '... and Other Premium Features', 'jewstore' )
            ),
        )
    )
    ) );
    $wp_customize->add_setting( 'wpdevart_jewstore_single_page_settings_premium_features',
    array(
        'sanitize_callback' => 'wpdevart_jewstore_text_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Premium_Features_Control_List( $wp_customize, 'wpdevart_jewstore_single_page_settings_premium_features',
    array(
        'label' => esc_html__( 'More Features in the Premium Version!', 'jewstore' ),
        'section' => 'wpdevart_jewstore_single_page_section',
        'priority' => 777,
        'choices' => array(
            'feature1' => array(
                'name' => esc_html__( '+6 Beautiful Patterns', 'jewstore' )
            ),
            'feature2' => array(
                'name' => esc_html__( 'Title Animations', 'jewstore' )
            ),
            'feature3' => array(
                'name' => esc_html__( 'Banner Animations', 'jewstore' )
            ),
            'feature4' => array(
                'name' => esc_html__( '4 Animated Elements', 'jewstore' )
            ),
            'feature5' => array(
                'name' => esc_html__( 'Animated Elements Colors', 'jewstore' )
            ),
            'feature6' => array(
                'name' => esc_html__( '... and Other Premium Features', 'jewstore' )
            ),
        )
    )
    ) );

    $wp_customize->add_setting( 'wpdevart_jewstore_blog_archive_page_settings_premium_features',
    array(
        'sanitize_callback' => 'wpdevart_jewstore_text_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Premium_Features_Control_List( $wp_customize, 'wpdevart_jewstore_blog_archive_page_settings_premium_features',
    array(
        'label' => esc_html__( 'More Features in the Premium Version!', 'jewstore' ),
        'section' => 'wpdevart_jewstore_blog_section',
        'priority' => 777,
        'choices' => array(
            'feature1' => array(
                'name' => esc_html__( 'Title Animations', 'jewstore' )
            ),
            'feature2' => array(
                'name' => esc_html__( 'Banner Animations', 'jewstore' )
            ),
            'feature3' => array(
                'name' => esc_html__( '4 Animated Elements', 'jewstore' )
            ),
            'feature4' => array(
                'name' => esc_html__( 'Animated Elements Colors', 'jewstore' )
            ),
            'feature5' => array(
                'name' => esc_html__( '... and Other Premium Features', 'jewstore' )
            ),
        )
    )
    ) );
    $wp_customize->add_setting( 'wpdevart_jewstore_search_page_settings_premium_features',
    array(
        'sanitize_callback' => 'wpdevart_jewstore_text_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Premium_Features_Control_List( $wp_customize, 'wpdevart_jewstore_search_page_settings_premium_features',
    array(
        'label' => esc_html__( 'More Features in the Premium Version!', 'jewstore' ),
        'section' => 'wpdevart_jewstore_search_page_section',
        'priority' => 777,
        'choices' => array(
            'feature1' => array(
                'name' => esc_html__( 'Title Animations', 'jewstore' )
            ),
            'feature2' => array(
                'name' => esc_html__( 'Banner Animations', 'jewstore' )
            ),
            'feature3' => array(
                'name' => esc_html__( '4 Animated Elements', 'jewstore' )
            ),
            'feature4' => array(
                'name' => esc_html__( 'Animated Elements Colors', 'jewstore' )
            ),
            'feature5' => array(
                'name' => esc_html__( '... and Other Premium Features', 'jewstore' )
            ),
        )
    )
    ) );
    $wp_customize->add_setting( 'wpdevart_jewstore_blog_settings_premium_features',
    array(
        'sanitize_callback' => 'wpdevart_jewstore_text_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Premium_Features_Control_List( $wp_customize, 'wpdevart_jewstore_blog_settings_premium_features',
    array(
        'label' => esc_html__( 'More Features in the Premium Version!', 'jewstore' ),
        'section' => 'wpdevart_jewstore_blog_archive_search_general_section',
        'priority' => 777,
        'choices' => array(
            'feature1' => array(
                'name' => esc_html__( 'Images Hover Effects', 'jewstore' )
            ),
            'feature2' => array(
                'name' => esc_html__( 'Ordering of Metas', 'jewstore' )
            ),
            'feature3' => array(
                'name' => esc_html__( '... and Other Premium Features', 'jewstore' )
            ),
        )
    )
    ) );
    $wp_customize->add_setting( 'wpdevart_jewstore_custom_homepage_banner_premium_features',
    array(
        'sanitize_callback' => 'wpdevart_jewstore_text_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Premium_Features_Control_List( $wp_customize, 'wpdevart_jewstore_custom_homepage_banner_premium_features',
    array(
        'label' => esc_html__( 'More Features in the Premium Version!', 'jewstore' ),
        'section' => 'wpdevart_jewstore_custom_homepage_banner_section',
        'priority' => 777,
        'choices' => array(
            'feature1' => array(
                'name' => esc_html__( '+4 Beautiful Banner Themes', 'jewstore' )
            ),
            'feature2' => array(
                'name' => esc_html__( '... and Other Premium Features', 'jewstore' )
            ),
        )
    )
    ) );
    $wp_customize->add_setting( 'wpdevart_jewstore_custom_homepage_general_premium_features',
    array(
        'sanitize_callback' => 'wpdevart_jewstore_text_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Premium_Features_Control_List( $wp_customize, 'wpdevart_jewstore_custom_homepage_general_premium_features',
    array(
        'label' => esc_html__( 'More Features in the Premium Version!', 'jewstore' ),
        'section' => 'wpdevart_jewstore_custom_homepage_general_section',
        'priority' => 777,
        'choices' => array(
            'feature1' => array(
                'name' => esc_html__( 'Ordering of Sections', 'jewstore' )
            ),
            'feature2' => array(
                'name' => esc_html__( 'Sections Description Color', 'jewstore' )
            ),
            'feature3' => array(
                'name' => esc_html__( 'Sections Title Lines Color', 'jewstore' )
            ),
            'feature4' => array(
                'name' => esc_html__( '... and Other Premium Features', 'jewstore' )
            ),
        )
    )
    ) );
    $wp_customize->add_setting( 'wpdevart_jewstore_footer_premium_features',
    array(
        'sanitize_callback' => 'wpdevart_jewstore_text_sanitization'
    )
    );
    $wp_customize->add_control( new Wpdevart_Premium_Features_Control_List( $wp_customize, 'wpdevart_jewstore_footer_premium_features',
    array(
        'label' => esc_html__( 'More Features in the Premium Version!', 'jewstore' ),
        'section' => 'wpdevart_jewstore_footer_section',
        'priority' => 777,
        'choices' => array(
            'feature1' => array(
                'name' => esc_html__( '+4 Beautiful Footer Themes', 'jewstore' )
            ),
            'feature2' => array(
                'name' => esc_html__( 'Copyright Section Image', 'jewstore' )
            ),
            'feature3' => array(
                'name' => esc_html__( '... and Other Premium Features', 'jewstore' )
            ),
        )
    )
    ) );