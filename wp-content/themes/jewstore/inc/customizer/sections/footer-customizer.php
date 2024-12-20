<?php 
        $wp_customize->add_section('wpdevart_jewstore_footer_section',array(
            'title'	=> esc_html__('Footer','jewstore'),
            'priority'		=> 30
        ));
        $wp_customize->add_setting( 'wpdevart_jewstore_footer_layout',
        array(
            'default' => esc_html('wpdevartfivewidgets'),
            'transport' => 'refresh',
            'sanitize_callback' => 'wpdevart_jewstore_text_sanitization'
        )
        );
        $wp_customize->add_control( new Wpdevart_Image_Radio_Button_Custom_Control( $wp_customize, 'wpdevart_jewstore_footer_layout',
        array(
            'label' => esc_html__( 'Footer layout', 'jewstore' ),
            'description' => esc_html__( 'Select the layout of the footer', 'jewstore' ),
            'section' => 'wpdevart_jewstore_footer_section',
            'choices' => array(
            'wpdevartthreewidgetsleft' => array(
                'image' => trailingslashit( get_template_directory_uri() ) . 'images/footer-layout-one.jpg',
                'name' => esc_html__( 'Large widget on the left', 'jewstore' )
            ),
            'wpdevartthreewidgetscenter' => array(
                'image' => trailingslashit( get_template_directory_uri() ) . 'images/footer-layout-two.jpg',
                'name' => esc_html__( 'Large widget in the center', 'jewstore' )
            ),
            'wpdevartthreewidgetsright' => array(
                'image' => trailingslashit( get_template_directory_uri() ) . 'images/footer-layout-three.jpg',
                'name' => esc_html__( 'Large widget on the right', 'jewstore' )
            ),
            'wpdevartfourwidgets' => array(
                'image' => trailingslashit( get_template_directory_uri() ) . 'images/footer-layout-four.jpg',
                'name' => esc_html__( 'Four widgets', 'jewstore' )
            ),
            'wpdevartfourwidgetsalternative' => array(
                'image' => trailingslashit( get_template_directory_uri() ) . 'images/footer-layout-five.jpg',
                'name' => esc_html__( 'Four widgets - alternative', 'jewstore' )
            ),
            'wpdevartfivewidgets' => array(
                'image' => trailingslashit( get_template_directory_uri() ) . 'images/footer-layout-six.jpg',
                'name' => esc_html__( 'Five widgets', 'jewstore' )
            )
            )
        )
        ) );
        $wp_customize->add_setting( 'wpdevart_jewstore_pre_footer_wave_display_option',
        array(
           'default' => esc_html('1'),
           'transport' => 'refresh',
           'sanitize_callback' => 'wpdevart_jewstore_switch_sanitization'
        )
        );
        $wp_customize->add_control( new Wpdevart_Toggle_Switch_Custom_control( $wp_customize, 'wpdevart_jewstore_pre_footer_wave_display_option',
            array(
            'label' => esc_html__( 'Display Wave before footer', 'jewstore' ),
            'description' => esc_html__( 'Disable this option if you do not want to display the wave before the footer.', 'jewstore' ),
            'section' => 'wpdevart_jewstore_footer_section'
            )
        ) );
        $wp_customize->add_setting('wpdevart_jewstore_footer_copyright_text',array(
            'default'	=> esc_html('Copyright ©2023. All rights reserved.'),
            'sanitize_callback'	=> 'wpdevart_jewstore_text_sanitization'	
        ));
        $wp_customize->add_control( new WP_Customize_Control(
            $wp_customize,
            'wpdevart_jewstore_footer_copyright_text',
                array(
                    'label'    => esc_html__('Copyright text','jewstore'),
                    'section'  => 'wpdevart_jewstore_footer_section',
                    'settings' => 'wpdevart_jewstore_footer_copyright_text',
                    'type'     => 'text'
                )
            )
        );