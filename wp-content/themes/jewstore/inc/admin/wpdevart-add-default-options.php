<?php

require get_template_directory() . '/inc/admin/sanitization.php';

add_action('after_switch_theme', 'wpdevart_jewstore_register_default_options_once');

function wpdevart_jewstore_register_default_options_once () {
    
    //* General default options
    $default = wpdevart_jewstore_text_sanitization('Alegreya');
    if (!get_theme_mod('wpdevart_jewstore_global_fonts')) {
        set_theme_mod( 'wpdevart_jewstore_global_fonts', $default);
    }
    $default = wpdevart_jewstore_switch_sanitization('');
    if (!get_theme_mod('wpdevart_jewstore_enable_preloader')) {
        set_theme_mod( 'wpdevart_jewstore_enable_preloader', $default);
    }
    $default = wpdevart_jewstore_sanitize_integer('1');
    if (!get_theme_mod('wpdevart_jewstore_preloader_time')) {
        set_theme_mod( 'wpdevart_jewstore_preloader_time', $default);
    }		
    $default = sanitize_hex_color('#ffffff');
    if(!get_theme_mod('wpdevart_jewstore_preloader_bg_color')) {
        set_theme_mod('wpdevart_jewstore_preloader_bg_color', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('wpdevart-preloader-three-loader');
    if (!get_theme_mod('wpdevart_jewstore_preloader_style')) {
        set_theme_mod( 'wpdevart_jewstore_preloader_style', $default);
    }
    $default = sanitize_hex_color('#f6901b');
    if (!get_theme_mod('wpdevart_jewstore_preloader_loader_color')) {
        set_theme_mod( 'wpdevart_jewstore_preloader_loader_color', $default);
    }
    $default = sanitize_hex_color('#ffffff');
    if (!get_theme_mod('wpdevart_jewstore_main_container_bg_color')) {
        set_theme_mod( 'wpdevart_jewstore_main_container_bg_color', $default);
    }
    $default = sanitize_hex_color('#000000');
    if (!get_theme_mod('wpdevart_jewstore_main_container_heading_color')) {
        set_theme_mod( 'wpdevart_jewstore_main_container_heading_color', $default);
    }
    $default = sanitize_hex_color('#333333');
    if (!get_theme_mod('wpdevart_jewstore_main_container_text_color')) {
        set_theme_mod( 'wpdevart_jewstore_main_container_text_color', $default);
    }
    $default = sanitize_hex_color('#000000');
    if (!get_theme_mod('wpdevart_jewstore_main_container_link_color')) {
        set_theme_mod( 'wpdevart_jewstore_main_container_link_color', $default);
    }
    $default = sanitize_hex_color('#f6901b');
    if (!get_theme_mod('wpdevart_jewstore_main_container_link_hover_color')) {
        set_theme_mod( 'wpdevart_jewstore_main_container_link_hover_color', $default);
    }
    $default = sanitize_hex_color('#ffffff');
    if (!get_theme_mod('wpdevart_jewstore_main_container_sidebar_bg_color')) {
        set_theme_mod( 'wpdevart_jewstore_main_container_sidebar_bg_color', $default);
    }
    $default = sanitize_hex_color('#e2e2e2');
    if (!get_theme_mod('wpdevart_jewstore_main_container_sidebar_shadow_color')) {
        set_theme_mod( 'wpdevart_jewstore_main_container_sidebar_shadow_color', $default);
    }
    $default = sanitize_hex_color('#000000');
    if (!get_theme_mod('wpdevart_jewstore_main_container_sidebar_heading_color')) {
        set_theme_mod( 'wpdevart_jewstore_main_container_sidebar_heading_color', $default);
    }
    $default = sanitize_hex_color('#333333');
    if (!get_theme_mod('wpdevart_jewstore_main_container_sidebar_text_color')) {
        set_theme_mod( 'wpdevart_jewstore_main_container_sidebar_text_color', $default);
    }
    $default = sanitize_hex_color('#000000');
    if (!get_theme_mod('wpdevart_jewstore_main_container_sidebar_link_color')) {
        set_theme_mod( 'wpdevart_jewstore_main_container_sidebar_link_color', $default);
    }
    $default = sanitize_hex_color('#f6901b');
    if (!get_theme_mod('wpdevart_jewstore_main_container_sidebar_link_hover_color')) {
        set_theme_mod( 'wpdevart_jewstore_main_container_sidebar_link_hover_color', $default);
    }
    $default = sanitize_hex_color('#ffffff');
    if (!get_theme_mod('wpdevart_jewstore_primary_button_bg_color')) {
        set_theme_mod( 'wpdevart_jewstore_primary_button_bg_color', $default);
    }
    $default = sanitize_hex_color('#f6901b');
    if (!get_theme_mod('wpdevart_jewstore_primary_button_border_color')) {
        set_theme_mod( 'wpdevart_jewstore_primary_button_border_color', $default);
    }    
    $default = sanitize_hex_color('#f6901b');
    if (!get_theme_mod('wpdevart_jewstore_primary_button_border_hover_color')) {
        set_theme_mod( 'wpdevart_jewstore_primary_button_border_hover_color', $default);
    }
    $default = sanitize_hex_color('#f6901b');
    if (!get_theme_mod('wpdevart_jewstore_primary_button_link_color')) {
        set_theme_mod( 'wpdevart_jewstore_primary_button_link_color', $default);
    }
    $default = sanitize_hex_color('#f6901b');
    if (!get_theme_mod('wpdevart_jewstore_primary_button_bg_hover_color')) {
        set_theme_mod( 'wpdevart_jewstore_primary_button_bg_hover_color', $default);
    }
    $default = sanitize_hex_color('#ffffff');
    if (!get_theme_mod('wpdevart_jewstore_primary_button_link_hover_color')) {
        set_theme_mod( 'wpdevart_jewstore_primary_button_link_hover_color', $default);
    }
    $default = wpdevart_jewstore_sanitize_integer('17');
    if(!get_theme_mod('wpdevart_jewstore_main_container_text_font_size')) {
        set_theme_mod('wpdevart_jewstore_main_container_text_font_size', $default);
    }
    $default = wpdevart_jewstore_sanitize_integer('17');
    if(!get_theme_mod('wpdevart_jewstore_main_container_link_font_size')) {
        set_theme_mod('wpdevart_jewstore_main_container_link_font_size', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('400');
    if(!get_theme_mod('wpdevart_jewstore_main_container_link_font_weight')) {
        set_theme_mod('wpdevart_jewstore_main_container_link_font_weight', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('normal');
    if(!get_theme_mod('wpdevart_jewstore_main_container_link_font_style')) {
        set_theme_mod('wpdevart_jewstore_main_container_link_font_style', $default);
    }
    $default = wpdevart_jewstore_sanitize_integer('40');
    if(!get_theme_mod('wpdevart_jewstore_main_container_heading_h1_font_size')) {
        set_theme_mod('wpdevart_jewstore_main_container_heading_h1_font_size', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('400');
    if(!get_theme_mod('wpdevart_jewstore_main_container_heading_h1_font_weight')) {
        set_theme_mod('wpdevart_jewstore_main_container_heading_h1_font_weight', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('normal');
    if(!get_theme_mod('wpdevart_jewstore_main_container_heading_h1_font_style')) {
        set_theme_mod('wpdevart_jewstore_main_container_heading_h1_font_style', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('uppercase');
    if(!get_theme_mod('wpdevart_jewstore_main_container_heading_h1_font_transform')) {
        set_theme_mod('wpdevart_jewstore_main_container_heading_h1_font_transform', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('none');
    if(!get_theme_mod('wpdevart_jewstore_main_container_heading_h1_font_decoration')) {
        set_theme_mod('wpdevart_jewstore_main_container_heading_h1_font_decoration', $default);
    }
    $default = wpdevart_jewstore_sanitize_integer('28');
    if(!get_theme_mod('wpdevart_jewstore_main_container_heading_h2_font_size')) {
        set_theme_mod('wpdevart_jewstore_main_container_heading_h2_font_size', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('400');
    if(!get_theme_mod('wpdevart_jewstore_main_container_heading_h2_font_weight')) {
        set_theme_mod('wpdevart_jewstore_main_container_heading_h2_font_weight', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('normal');
    if(!get_theme_mod('wpdevart_jewstore_main_container_heading_h2_font_style')) {
        set_theme_mod('wpdevart_jewstore_main_container_heading_h2_font_style', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('uppercase');
    if(!get_theme_mod('wpdevart_jewstore_main_container_heading_h2_font_transform')) {
        set_theme_mod('wpdevart_jewstore_main_container_heading_h2_font_transform', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('none');
    if(!get_theme_mod('wpdevart_jewstore_main_container_heading_h2_font_decoration')) {
        set_theme_mod('wpdevart_jewstore_main_container_heading_h2_font_decoration', $default);
    }

    $default = wpdevart_jewstore_sanitize_integer('24');
    if(!get_theme_mod('wpdevart_jewstore_main_container_heading_h3_font_size')) {
        set_theme_mod('wpdevart_jewstore_main_container_heading_h3_font_size', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('400');
    if(!get_theme_mod('wpdevart_jewstore_main_container_heading_h3_font_weight')) {
        set_theme_mod('wpdevart_jewstore_main_container_heading_h3_font_weight', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('normal');
    if(!get_theme_mod('wpdevart_jewstore_main_container_heading_h3_font_style')) {
        set_theme_mod('wpdevart_jewstore_main_container_heading_h3_font_style', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('uppercase');
    if(!get_theme_mod('wpdevart_jewstore_main_container_heading_h3_font_transform')) {
        set_theme_mod('wpdevart_jewstore_main_container_heading_h3_font_transform', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('none');
    if(!get_theme_mod('wpdevart_jewstore_main_container_heading_h3_font_decoration')) {
        set_theme_mod('wpdevart_jewstore_main_container_heading_h3_font_decoration', $default);
    }
    
    $default = wpdevart_jewstore_sanitize_integer('23');
    if(!get_theme_mod('wpdevart_jewstore_main_container_heading_h4_font_size')) {
        set_theme_mod('wpdevart_jewstore_main_container_heading_h4_font_size', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('400');
    if(!get_theme_mod('wpdevart_jewstore_main_container_heading_h4_font_weight')) {
        set_theme_mod('wpdevart_jewstore_main_container_heading_h4_font_weight', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('normal');
    if(!get_theme_mod('wpdevart_jewstore_main_container_heading_h4_font_style')) {
        set_theme_mod('wpdevart_jewstore_main_container_heading_h4_font_style', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('uppercase');
    if(!get_theme_mod('wpdevart_jewstore_main_container_heading_h4_font_transform')) {
        set_theme_mod('wpdevart_jewstore_main_container_heading_h4_font_transform', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('none');
    if(!get_theme_mod('wpdevart_jewstore_main_container_heading_h4_font_decoration')) {
        set_theme_mod('wpdevart_jewstore_main_container_heading_h4_font_decoration', $default);
    }

    $default = wpdevart_jewstore_sanitize_integer('22');
    if(!get_theme_mod('wpdevart_jewstore_main_container_heading_h5_font_size')) {
        set_theme_mod('wpdevart_jewstore_main_container_heading_h5_font_size', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('400');
    if(!get_theme_mod('wpdevart_jewstore_main_container_heading_h5_font_weight')) {
        set_theme_mod('wpdevart_jewstore_main_container_heading_h5_font_weight', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('normal');
    if(!get_theme_mod('wpdevart_jewstore_main_container_heading_h5_font_style')) {
        set_theme_mod('wpdevart_jewstore_main_container_heading_h5_font_style', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('uppercase');
    if(!get_theme_mod('wpdevart_jewstore_main_container_heading_h5_font_transform')) {
        set_theme_mod('wpdevart_jewstore_main_container_heading_h5_font_transform', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('none');
    if(!get_theme_mod('wpdevart_jewstore_main_container_heading_h5_font_decoration')) {
        set_theme_mod('wpdevart_jewstore_main_container_heading_h5_font_decoration', $default);
    }

    $default = wpdevart_jewstore_sanitize_integer('20');
    if(!get_theme_mod('wpdevart_jewstore_main_container_heading_h6_font_size')) {
        set_theme_mod('wpdevart_jewstore_main_container_heading_h6_font_size', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('400');
    if(!get_theme_mod('wpdevart_jewstore_main_container_heading_h6_font_weight')) {
        set_theme_mod('wpdevart_jewstore_main_container_heading_h6_font_weight', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('normal');
    if(!get_theme_mod('wpdevart_jewstore_main_container_heading_h6_font_style')) {
        set_theme_mod('wpdevart_jewstore_main_container_heading_h6_font_style', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('uppercase');
    if(!get_theme_mod('wpdevart_jewstore_main_container_heading_h6_font_transform')) {
        set_theme_mod('wpdevart_jewstore_main_container_heading_h6_font_transform', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('none');
    if(!get_theme_mod('wpdevart_jewstore_main_container_heading_h6_font_decoration')) {
        set_theme_mod('wpdevart_jewstore_main_container_heading_h6_font_decoration', $default);
    }
    $default = sanitize_hex_color('#000000');
    if (!get_theme_mod('wpdevart_jewstore_search_overlay_bg_color')) {
        set_theme_mod( 'wpdevart_jewstore_search_overlay_bg_color', $default);
    }
    $default = sanitize_hex_color('#000000');
    if (!get_theme_mod('wpdevart_jewstore_search_overlay_input_bg_color')) {
        set_theme_mod( 'wpdevart_jewstore_search_overlay_input_bg_color', $default);
    }
    $default = sanitize_hex_color('#838383');
    if (!get_theme_mod('wpdevart_jewstore_search_overlay_input_border_color')) {
        set_theme_mod( 'wpdevart_jewstore_search_overlay_input_border_color', $default);
    }
    $default = sanitize_hex_color('#ffffff');
    if (!get_theme_mod('wpdevart_jewstore_search_overlay_input_text_icon_color')) {
        set_theme_mod( 'wpdevart_jewstore_search_overlay_input_text_icon_color', $default);
    }
    $default = sanitize_hex_color('#ffffff');
    if (!get_theme_mod('wpdevart_jewstore_search_overlay_close_icon_color')) {
        set_theme_mod( 'wpdevart_jewstore_search_overlay_close_icon_color', $default);
    }

	//* Top Header default options

    $default = wpdevart_jewstore_switch_sanitization('');
    if (!get_theme_mod('wpdevart_jewstore_enable_top_header')) {
        set_theme_mod( 'wpdevart_jewstore_enable_top_header', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('phoneleft');
    if (!get_theme_mod('wpdevart_jewstore_top_header_layout')) {
        set_theme_mod( 'wpdevart_jewstore_top_header_layout', $default);
    }
    $default = sanitize_hex_color('#ffffff');
    if(!get_theme_mod('wpdevart_jewstore_top_header_bg_color')) {
        set_theme_mod('wpdevart_jewstore_top_header_bg_color', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('to right');
    if (!get_theme_mod('wpdevart_jewstore_top_header_gradient_type')) {
        set_theme_mod( 'wpdevart_jewstore_top_header_gradient_type', $default);
    }
    $default = sanitize_hex_color('#ffffff');
    if(!get_theme_mod('wpdevart_jewstore_top_header_bg_gradient_color')) {
        set_theme_mod('wpdevart_jewstore_top_header_bg_gradient_color', $default);
    }
    $default = wpdevart_jewstore_switch_sanitization('');
    if (!get_theme_mod('wpdevart_jewstore_enable_top_header_border')) {
        set_theme_mod( 'wpdevart_jewstore_enable_top_header_border', $default);
    }
    $default = sanitize_hex_color('#f7f7f7');
    if(!get_theme_mod('wpdevart_jewstore_top_header_border_color')) {
        set_theme_mod('wpdevart_jewstore_top_header_border_color', $default);
    }
    $default = sanitize_hex_color('#000000');
    if(!get_theme_mod('wpdevart_jewstore_top_header_text_color')) {
        set_theme_mod('wpdevart_jewstore_top_header_text_color', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('(555) 555-1234');
    if (!get_theme_mod('wpdevart_jewstore_top_header_phone_number')) {
        set_theme_mod( 'wpdevart_jewstore_top_header_phone_number', $default);
    }
    $default = sanitize_email('info@example.com');
    if ( !get_theme_mod('wpdevart_jewstore_top_header_email')) {
        set_theme_mod( 'wpdevart_jewstore_top_header_email', $default);
    }
    $default = sanitize_hex_color('#000000');
    if(!get_theme_mod('wpdevart_jewstore_top_header_social_icons_color')) {
        set_theme_mod('wpdevart_jewstore_top_header_social_icons_color', $default);
    }
    $default = sanitize_hex_color('#ffffff');
    if(!get_theme_mod('wpdevart_jewstore_top_header_social_icons_bg_color')) {
        set_theme_mod('wpdevart_jewstore_top_header_social_icons_bg_color', $default);
    }
    $default = wpdevart_jewstore_switch_sanitization('');
    if (!get_theme_mod('wpdevart_jewstore_top_header_disable_twitter')) {
        set_theme_mod( 'wpdevart_jewstore_top_header_disable_twitter', $default);
    }
    $default = esc_url('https://twitter.com');
    if(!get_theme_mod('wpdevart_jewstore_top_header_twitter_url')) {
        set_theme_mod('wpdevart_jewstore_top_header_twitter_url', $default);
    }
    $default = wpdevart_jewstore_switch_sanitization('');
    if (!get_theme_mod('wpdevart_jewstore_top_header_disable_facebook')) {
        set_theme_mod( 'wpdevart_jewstore_top_header_disable_facebook', $default);
    }
    $default = esc_url('https://www.facebook.com');
    if(!get_theme_mod('wpdevart_jewstore_top_header_facebook_url')) {
        set_theme_mod('wpdevart_jewstore_top_header_facebook_url', $default);
    }
    $default = wpdevart_jewstore_switch_sanitization('');
    if (!get_theme_mod('wpdevart_jewstore_top_header_disable_linkedin')) {
        set_theme_mod( 'wpdevart_jewstore_top_header_disable_linkedin', $default);
    }
    $default = esc_url('https://www.linkedin.com');
    if(!get_theme_mod('wpdevart_jewstore_top_header_linkedin_url')) {
        set_theme_mod('wpdevart_jewstore_top_header_linkedin_url', $default);
    }
    $default = wpdevart_jewstore_switch_sanitization('');
    if (!get_theme_mod('wpdevart_jewstore_top_header_disable_youtube')) {
        set_theme_mod( 'wpdevart_jewstore_top_header_disable_youtube', $default);
    }
    $default = esc_url('https://www.youtube.com');
    if(!get_theme_mod('wpdevart_jewstore_top_header_youtube_url')) {
        set_theme_mod('wpdevart_jewstore_top_header_youtube_url', $default);
    }
    $default = wpdevart_jewstore_switch_sanitization('');
    if (!get_theme_mod('wpdevart_jewstore_top_header_disable_instagram')) {
        set_theme_mod( 'wpdevart_jewstore_top_header_disable_instagram', $default);
    }
    $default = esc_url('https://www.instagram.com');
    if(!get_theme_mod('wpdevart_jewstore_top_header_instagram_url')) {
        set_theme_mod('wpdevart_jewstore_top_header_instagram_url', $default);
    }
    $default = wpdevart_jewstore_switch_sanitization('');
    if (!get_theme_mod('wpdevart_jewstore_top_header_disable_tiktok')) {
        set_theme_mod( 'wpdevart_jewstore_top_header_disable_tiktok', $default);
    }
    $default = esc_url('https://www.tiktok.com/');
    if(!get_theme_mod('wpdevart_jewstore_top_header_tiktok_url')) {
        set_theme_mod('wpdevart_jewstore_top_header_tiktok_url', $default);
    }
    $default = wpdevart_jewstore_switch_sanitization('');
    if (!get_theme_mod('wpdevart_jewstore_top_header_disable_pinterest')) {
        set_theme_mod( 'wpdevart_jewstore_top_header_disable_pinterest', $default);
    }
    $default = esc_url('https://www.pinterest.com/');
    if(!get_theme_mod('wpdevart_jewstore_top_header_pinterest_url')) {
        set_theme_mod('wpdevart_jewstore_top_header_pinterest_url', $default);
    }

    //* Header default options

    $default = wpdevart_jewstore_switch_sanitization('');
    if (!get_theme_mod('wpdevart_jewstore_enable_sticky_header')) {
        set_theme_mod( 'wpdevart_jewstore_enable_sticky_header', $default);
    }
    $default = wpdevart_jewstore_switch_sanitization('');
    if (!get_theme_mod('wpdevart_jewstore_enable_sticky_header_mobile')) {
        set_theme_mod( 'wpdevart_jewstore_enable_sticky_header_mobile', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('headerlayoutone');
    if (!get_theme_mod('wpdevart_jewstore_header_layout')) {
        set_theme_mod( 'wpdevart_jewstore_header_layout', $default);
    }
    $default = sanitize_hex_color('#ffffff');
    if(!get_theme_mod('wpdevart_jewstore_header_bg_color')) {
        set_theme_mod('wpdevart_jewstore_header_bg_color', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('to right');
    if (!get_theme_mod('wpdevart_jewstore_header_gradient_type')) {
        set_theme_mod( 'wpdevart_jewstore_header_gradient_type', $default);
    }
    $default = sanitize_hex_color('#ffffff');
    if(!get_theme_mod('wpdevart_jewstore_header_bg_gradient_color')) {
        set_theme_mod('wpdevart_jewstore_header_bg_gradient_color', $default);
    }
    $default = wpdevart_jewstore_switch_sanitization('');
    if (!get_theme_mod('wpdevart_jewstore_enable_main_header_border')) {
        set_theme_mod( 'wpdevart_jewstore_enable_main_header_border', $default);
    }
    $default = sanitize_hex_color('#fbf8f8');
    if(!get_theme_mod('wpdevart_jewstore_main_header_border_color')) {
        set_theme_mod('wpdevart_jewstore_main_header_border_color', $default);
    }
    $default = wpdevart_jewstore_sanitize_integer('60');
    if(!get_theme_mod('wpdevart_jewstore_header_logo_max_height')) {
        set_theme_mod('wpdevart_jewstore_header_logo_max_height', $default);
    }
    $default = wpdevart_jewstore_sanitize_integer('70');
    if(!get_theme_mod('wpdevart_jewstore_header_logo_mobile_max_height')) {
        set_theme_mod('wpdevart_jewstore_header_logo_mobile_max_height', $default);
    }
    $default = sanitize_hex_color('#f6901b');
    if(!get_theme_mod('wpdevart_jewstore_header_logo_text_color')) {
        set_theme_mod('wpdevart_jewstore_header_logo_text_color', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('to right');
    if (!get_theme_mod('wpdevart_jewstore_header_logo_gradient_type')) {
        set_theme_mod( 'wpdevart_jewstore_header_logo_gradient_type', $default);
    }
    $default = sanitize_hex_color('#f6901b');
    if(!get_theme_mod('wpdevart_jewstore_header_logo_gradient_color')) {
        set_theme_mod('wpdevart_jewstore_header_logo_gradient_color', $default);
    }
    $default = wpdevart_jewstore_sanitize_integer('30');
    if(!get_theme_mod('wpdevart_jewstore_header_logo_font_size')) {
        set_theme_mod('wpdevart_jewstore_header_logo_font_size', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('600');
    if(!get_theme_mod('wpdevart_jewstore_header_logo_font_weight')) {
        set_theme_mod('wpdevart_jewstore_header_logo_font_weight', $default);
    }
    $default = wpdevart_jewstore_switch_sanitization('');
    if(!get_theme_mod('header_text')) {
        set_theme_mod('header_text', $default);
    }
    $default = sanitize_hex_color('#333333');
    if(!get_theme_mod('wpdevart_jewstore_header_site_description_color')) {
        set_theme_mod('wpdevart_jewstore_header_site_description_color', $default);
    }
    $default = wpdevart_jewstore_sanitize_integer('18');
    if(!get_theme_mod('wpdevart_jewstore_header_site_description_font_size')) {
        set_theme_mod('wpdevart_jewstore_header_site_description_font_size', $default);
    }
    $default = sanitize_hex_color('#000000');
    if(!get_theme_mod('wpdevart_jewstore_header_menu_items_color')) {
        set_theme_mod('wpdevart_jewstore_header_menu_items_color', $default);
    }
    $default = sanitize_hex_color('#ffffff');
    if(!get_theme_mod('wpdevart_jewstore_main_header_sub_menu_bg_color')) {
        set_theme_mod('wpdevart_jewstore_main_header_sub_menu_bg_color', $default);
    }
    $default = sanitize_hex_color('#000000');
    if(!get_theme_mod('wpdevart_jewstore_main_header_sub_menu_items_color')) {
        set_theme_mod('wpdevart_jewstore_main_header_sub_menu_items_color', $default);
    }
    $default = sanitize_hex_color('#f6901b');
    if(!get_theme_mod('wpdevart_jewstore_main_header_sub_menu_top_border_color')) {
        set_theme_mod('wpdevart_jewstore_main_header_sub_menu_top_border_color', $default);
    }
    $default = sanitize_hex_color('#f6901b');
    if(!get_theme_mod('wpdevart_jewstore_header_mobile_menu_button_color')) {
        set_theme_mod('wpdevart_jewstore_header_mobile_menu_button_color', $default);
    }
    $default = sanitize_hex_color('#fcfcfc');
    if(!get_theme_mod('wpdevart_jewstore_header_mobile_menu_background_color')) {
        set_theme_mod('wpdevart_jewstore_header_mobile_menu_background_color', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('to right');
    if (!get_theme_mod('wpdevart_jewstore_mobile_menu_bg_gradient_type')) {
        set_theme_mod( 'wpdevart_jewstore_mobile_menu_bg_gradient_type', $default);
    }
    $default = sanitize_hex_color('#fcfcfc');
    if(!get_theme_mod('wpdevart_jewstore_mobile_menu_bg_gradient_color')) {
        set_theme_mod('wpdevart_jewstore_mobile_menu_bg_gradient_color', $default);
    }
    $default = sanitize_hex_color('#ffffff');
    if(!get_theme_mod('wpdevart_jewstore_main_header_mobile_menu_background_color')) {
        set_theme_mod('wpdevart_jewstore_main_header_mobile_menu_background_color', $default);
    }
    $default = sanitize_hex_color('#000000');
    if(!get_theme_mod('wpdevart_jewstore_main_header_mobile_menu_link_color')) {
        set_theme_mod('wpdevart_jewstore_main_header_mobile_menu_link_color', $default);
    }
    $default = sanitize_hex_color('#f7f7f7');
    if(!get_theme_mod('wpdevart_jewstore_main_header_mobile_menu_border_color')) {
        set_theme_mod('wpdevart_jewstore_main_header_mobile_menu_border_color', $default);
    }
    $default = sanitize_hex_color('#f6901b');
    if (!get_theme_mod('wpdevart_jewstore_main_header_mobile_sub_menu_button_bg_color')) {
        set_theme_mod( 'wpdevart_jewstore_main_header_mobile_sub_menu_button_bg_color', $default);
    }
    $default = sanitize_hex_color('#ffffff');
    if(!get_theme_mod('wpdevart_jewstore_main_header_mobile_sub_menu_button_color')) {
        set_theme_mod('wpdevart_jewstore_main_header_mobile_sub_menu_button_color', $default);
    }
    $default = sanitize_hex_color('#f6901b');
    if(!get_theme_mod('wpdevart_jewstore_header_search_button_color')) {
        set_theme_mod('wpdevart_jewstore_header_search_button_color', $default);
    }
    $default = sanitize_hex_color('#f6901b');
    if(!get_theme_mod('wpdevart_jewstore_header_descktop_search_button_color')) {
        set_theme_mod('wpdevart_jewstore_header_descktop_search_button_color', $default);
    }
    $default = wpdevart_jewstore_switch_sanitization('');
    if(!get_theme_mod('wpdevart_jewstore_header_show_action_button')) {
        set_theme_mod('wpdevart_jewstore_header_show_action_button', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('Join Us');
    if(!get_theme_mod('wpdevart_jewstore_header_action_button_text')) {
        set_theme_mod('wpdevart_jewstore_header_action_button_text', $default);
    }
    $default = esc_url('#');
    if(!get_theme_mod('wpdevart_jewstore_header_action_button_url')) {
        set_theme_mod('wpdevart_jewstore_header_action_button_url', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('wpdevart_jewstore_eighth_button_slide eighth_btn_slide_right');
    if(!get_theme_mod('wpdevart_jewstore_header_action_button_style')) {
        set_theme_mod('wpdevart_jewstore_header_action_button_style', $default);
    }

    //* Single post default options

    $default = wpdevart_jewstore_text_sanitization('narrow');
    if(!get_theme_mod('wpdevart_jewstore_single_post_banner_width')) {
        set_theme_mod('wpdevart_jewstore_single_post_banner_width', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('center');
    if(!get_theme_mod('wpdevart_jewstore_single_post_title_alignment')) {
        set_theme_mod('wpdevart_jewstore_single_post_title_alignment', $default);
    }
    $default = sanitize_hex_color('#ffffff');
    if(!get_theme_mod('wpdevart_jewstore_single_post_banner_bg_color')) {
        set_theme_mod('wpdevart_jewstore_single_post_banner_bg_color', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('to right');
    if (!get_theme_mod('wpdevart_jewstore_single_post_banner_gradient_type')) {
        set_theme_mod( 'wpdevart_jewstore_single_post_banner_gradient_type', $default);
    }
    $default = sanitize_hex_color('#fffdfc');
    if(!get_theme_mod('wpdevart_jewstore_single_post_banner_gradient_color')) {
        set_theme_mod('wpdevart_jewstore_single_post_banner_gradient_color', $default);
    }
    $default = sanitize_hex_color('#000000');
    if(!get_theme_mod('wpdevart_jewstore_single_post_banner_title_color')) {
        set_theme_mod('wpdevart_jewstore_single_post_banner_title_color', $default);
    }
    $default = sanitize_hex_color('#333333');
    if(!get_theme_mod('wpdevart_jewstore_single_post_banner_entry_text_color')) {
        set_theme_mod('wpdevart_jewstore_single_post_banner_entry_text_color', $default);
    }
    $default = sanitize_hex_color('#f6901b');
    if(!get_theme_mod('wpdevart_jewstore_single_post_banner_entry_link_color')) {
        set_theme_mod('wpdevart_jewstore_single_post_banner_entry_link_color', $default);
    }
    $default = sanitize_hex_color('#333333');
    if(!get_theme_mod('wpdevart_jewstore_single_post_banner_entry_link_hover_color')) {
        set_theme_mod('wpdevart_jewstore_single_post_banner_entry_link_hover_color', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('sidebarright');
    if (!get_theme_mod('wpdevart_jewstore_single_post_layout')) {
        set_theme_mod( 'wpdevart_jewstore_single_post_layout', $default);
    }

    //* Single page default options  

    $default = wpdevart_jewstore_text_sanitization('narrow');
    if(!get_theme_mod('wpdevart_jewstore_single_page_banner_width')) {
        set_theme_mod('wpdevart_jewstore_single_page_banner_width', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('center');
    if(!get_theme_mod('wpdevart_jewstore_single_page_title_alignment')) {
        set_theme_mod('wpdevart_jewstore_single_page_title_alignment', $default);
    }
    $default = sanitize_hex_color('#ffffff');
    if(!get_theme_mod('wpdevart_jewstore_single_page_banner_bg_color')) {
        set_theme_mod('wpdevart_jewstore_single_page_banner_bg_color', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('to right');
    if (!get_theme_mod('wpdevart_jewstore_single_page_banner_gradient_type')) {
        set_theme_mod( 'wpdevart_jewstore_single_page_banner_gradient_type', $default);
    }
    $default = sanitize_hex_color('#fffdfc');
    if(!get_theme_mod('wpdevart_jewstore_single_page_banner_gradient_color')) {
        set_theme_mod('wpdevart_jewstore_single_page_banner_gradient_color', $default);
    }
    $default = sanitize_hex_color('#000000');
    if(!get_theme_mod('wpdevart_jewstore_single_page_banner_title_color')) {
        set_theme_mod('wpdevart_jewstore_single_page_banner_title_color', $default);
    }
    $default = sanitize_hex_color('#333333');
    if(!get_theme_mod('wpdevart_jewstore_single_page_banner_entry_text_color')) {
        set_theme_mod('wpdevart_jewstore_single_page_banner_entry_text_color', $default);
    }
    $default = sanitize_hex_color('#f6901b');
    if(!get_theme_mod('wpdevart_jewstore_single_page_banner_entry_link_color')) {
        set_theme_mod('wpdevart_jewstore_single_page_banner_entry_link_color', $default);
    }
    $default = sanitize_hex_color('#333333');
    if(!get_theme_mod('wpdevart_jewstore_single_page_banner_entry_link_hover_color')) {
        set_theme_mod('wpdevart_jewstore_single_page_banner_entry_link_hover_color', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('sidebarnone');
    if (!get_theme_mod('wpdevart_jewstore_single_page_layout')) {
        set_theme_mod( 'wpdevart_jewstore_single_page_layout', $default);
    }
	
    //* Breadcrumbs
	
    $default = wpdevart_jewstore_switch_sanitization('');
    if(!get_theme_mod('wpdevart_jewstore_post_breadcrumbs_display_option')) {
        set_theme_mod('wpdevart_jewstore_post_breadcrumbs_display_option', $default);
    }
    $default = wpdevart_jewstore_switch_sanitization('');
    if(!get_theme_mod('wpdevart_jewstore_page_breadcrumbs_display_option')) {
        set_theme_mod('wpdevart_jewstore_page_breadcrumbs_display_option', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('Home');
    if(!get_theme_mod('wpdevart_jewstore_page_breadcrumbs_home_text')) {
        set_theme_mod('wpdevart_jewstore_page_breadcrumbs_home_text', $default);
    }
	
    //* Comments

    $default = sanitize_hex_color('#ffffff');
    if (!get_theme_mod('wpdevart_jewstore_comments_reply_box_bg_color')) {
        set_theme_mod( 'wpdevart_jewstore_comments_reply_box_bg_color', $default);
    }
    $default = sanitize_hex_color('#333333');
    if (!get_theme_mod('wpdevart_jewstore_comments_reply_box_text_color')) {
        set_theme_mod( 'wpdevart_jewstore_comments_reply_box_text_color', $default);
    }
    $default = sanitize_hex_color('#000000');
    if (!get_theme_mod('wpdevart_jewstore_comments_reply_box_heading_color')) {
        set_theme_mod( 'wpdevart_jewstore_comments_reply_box_heading_color', $default);
    }
    $default = sanitize_hex_color('#000000');
    if (!get_theme_mod('wpdevart_jewstore_comments_reply_box_link_color')) {
        set_theme_mod( 'wpdevart_jewstore_comments_reply_box_link_color', $default);
    }
    $default = sanitize_hex_color('#f6901b');
    if (!get_theme_mod('wpdevart_jewstore_comments_reply_box_link_hover_color')) {
        set_theme_mod( 'wpdevart_jewstore_comments_reply_box_link_hover_color', $default);
    }
    $default = sanitize_hex_color('#ffffff');
    if (!get_theme_mod('wpdevart_jewstore_comments_reply_button_bg_color')) {
        set_theme_mod( 'wpdevart_jewstore_comments_reply_button_bg_color', $default);
    }
    $default = sanitize_hex_color('#f6901b');
    if (!get_theme_mod('wpdevart_jewstore_comments_reply_button_border_color')) {
        set_theme_mod( 'wpdevart_jewstore_comments_reply_button_border_color', $default);
    }
    $default = sanitize_hex_color('#f6901b');
    if (!get_theme_mod('wpdevart_jewstore_comments_reply_button_link_color')) {
        set_theme_mod( 'wpdevart_jewstore_comments_reply_button_link_color', $default);
    }
    $default = sanitize_hex_color('#f6901b');
    if (!get_theme_mod('wpdevart_jewstore_comments_reply_button_bg_hover_color')) {
        set_theme_mod( 'wpdevart_jewstore_comments_reply_button_bg_hover_color', $default);
    }
    $default = sanitize_hex_color('#f6901b');
    if (!get_theme_mod('wpdevart_jewstore_comments_reply_button_border_hover_color')) {
        set_theme_mod( 'wpdevart_jewstore_comments_reply_button_border_hover_color', $default);
    }
    $default = sanitize_hex_color('#ffffff');
    if (!get_theme_mod('wpdevart_jewstore_comments_reply_button_link_hover_color')) {
        set_theme_mod( 'wpdevart_jewstore_comments_reply_button_link_hover_color', $default);
    }
	
    //* Homepage default options 

    $default = wpdevart_jewstore_switch_sanitization('1');
    if(!get_theme_mod('wpdevart_jewstore_custom_homepage_display_option')) {
        set_theme_mod('wpdevart_jewstore_custom_homepage_display_option', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('banner-first-theme');
    if(!get_theme_mod('wpdevart_jewstore_custom_homepage_banner_theme')) {
        set_theme_mod('wpdevart_jewstore_custom_homepage_banner_theme', $default);
    }
    $default = sanitize_hex_color('#ffffff');
    if(!get_theme_mod('wpdevart_jewstore_homepage_large_banner_bg_color')) {
        set_theme_mod('wpdevart_jewstore_homepage_large_banner_bg_color', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('to right');
    if(!get_theme_mod('wpdevart_jewstore_homepage_large_banner_bg_gradient_type')) {
        set_theme_mod('wpdevart_jewstore_homepage_large_banner_bg_gradient_type', $default);
    }
    $default = sanitize_hex_color('#ffffff');
    if(!get_theme_mod('wpdevart_jewstore_homepage_large_banner_bg_gradient_color')) {
        set_theme_mod('wpdevart_jewstore_homepage_large_banner_bg_gradient_color', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('An online store that delivers more than expected!');
    if(!get_theme_mod('wpdevart_jewstore_custom_homepage_banner_short_description')) {
        set_theme_mod('wpdevart_jewstore_custom_homepage_banner_short_description', $default);
    }
    $default = wpdevart_jewstore_sanitize_integer('17');
    if(!get_theme_mod('wpdevart_jewstore_custom_homepage_banner_short_description_font_size')) {
        set_theme_mod('wpdevart_jewstore_custom_homepage_banner_short_description_font_size', $default);
    }
    $default = sanitize_hex_color('#333333');
    if(!get_theme_mod('wpdevart_jewstore_custom_homepage_banner_short_description_color')) {
        set_theme_mod('wpdevart_jewstore_custom_homepage_banner_short_description_color', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('Best Jewelry Store');
    if(!get_theme_mod('wpdevart_jewstore_custom_homepage_banner_title')) {
        set_theme_mod('wpdevart_jewstore_custom_homepage_banner_title', $default);
    }
    $default = wpdevart_jewstore_sanitize_integer('43');
    if(!get_theme_mod('wpdevart_jewstore_custom_homepage_banner_title_font_size')) {
        set_theme_mod('wpdevart_jewstore_custom_homepage_banner_title_font_size', $default);
    }
    $default = sanitize_hex_color('#000000');
    if(!get_theme_mod('wpdevart_jewstore_custom_homepage_banner_title_color')) {
        set_theme_mod('wpdevart_jewstore_custom_homepage_banner_title_color', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('Express Delivery');
    if(!get_theme_mod('wpdevart_jewstore_custom_homepage_banner_sliding_first_text')) {
        set_theme_mod('wpdevart_jewstore_custom_homepage_banner_sliding_first_text', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('Valuable Prices');
    if(!get_theme_mod('wpdevart_jewstore_custom_homepage_banner_sliding_second_text')) {
        set_theme_mod('wpdevart_jewstore_custom_homepage_banner_sliding_second_text', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('24/7 Support');
    if(!get_theme_mod('wpdevart_jewstore_custom_homepage_banner_sliding_third_text')) {
        set_theme_mod('wpdevart_jewstore_custom_homepage_banner_sliding_third_text', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('Guaranteed Quality');
    if(!get_theme_mod('wpdevart_jewstore_custom_homepage_banner_sliding_fourth_text')) {
        set_theme_mod('wpdevart_jewstore_custom_homepage_banner_sliding_fourth_text', $default);
    }
    $default = wpdevart_jewstore_sanitize_integer('37');
    if(!get_theme_mod('wpdevart_jewstore_custom_homepage_banner_sliding_text_font_size')) {
        set_theme_mod('wpdevart_jewstore_custom_homepage_banner_sliding_text_font_size', $default);
    }
    $default = sanitize_hex_color('#f6901b');
    if(!get_theme_mod('wpdevart_jewstore_custom_homepage_banner_sliding_text_color')) {
        set_theme_mod('wpdevart_jewstore_custom_homepage_banner_sliding_text_color', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('We offer all services in one place including express delivery, 24/7 support, competitive prices, and guaranteed quality. Use the navigation buttons below to find out more information about us and our services. Share and tell your friends about it.');
    if(!get_theme_mod('wpdevart_jewstore_custom_homepage_banner_content')) {
        set_theme_mod('wpdevart_jewstore_custom_homepage_banner_content', $default);
    }
    $default = wpdevart_jewstore_sanitize_integer('17');
    if(!get_theme_mod('wpdevart_jewstore_custom_homepage_banner_content_font_size')) {
        set_theme_mod('wpdevart_jewstore_custom_homepage_banner_content_font_size', $default);
    }
    $default = sanitize_hex_color('#717171');
    if(!get_theme_mod('wpdevart_jewstore_custom_homepage_banner_content_color')) {
        set_theme_mod('wpdevart_jewstore_custom_homepage_banner_content_color', $default);
    }
    $default = wpdevart_jewstore_switch_sanitization('');
    if(!get_theme_mod('wpdevart_jewstore_custom_homepage_show_banner_first_button')) {
        set_theme_mod('wpdevart_jewstore_custom_homepage_show_banner_first_button', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('More Details');
    if(!get_theme_mod('wpdevart_jewstore_custom_homepage_banner_first_button_text')) {
        set_theme_mod('wpdevart_jewstore_custom_homepage_banner_first_button_text', $default);
    }
    $default = esc_url('#');
    if(!get_theme_mod('wpdevart_jewstore_custom_homepage_banner_first_button_url')) {
        set_theme_mod('wpdevart_jewstore_custom_homepage_banner_first_button_url', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('wpdevart_jewstore_primary_button_slide primary_btn_slide_right');
    if(!get_theme_mod('wpdevart_jewstore_custom_homepage_banner_first_button_style')) {
        set_theme_mod('wpdevart_jewstore_custom_homepage_banner_first_button_style', $default);
    }
    $default = wpdevart_jewstore_switch_sanitization('');
    if(!get_theme_mod('wpdevart_jewstore_custom_homepage_show_banner_second_button')) {
        set_theme_mod('wpdevart_jewstore_custom_homepage_show_banner_second_button', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('Shop Now');
    if(!get_theme_mod('wpdevart_jewstore_custom_homepage_banner_second_button_text')) {
        set_theme_mod('wpdevart_jewstore_custom_homepage_banner_second_button_text', $default);
    }
    $default = esc_url('#');
    if(!get_theme_mod('wpdevart_jewstore_custom_homepage_banner_second_button_url')) {
        set_theme_mod('wpdevart_jewstore_custom_homepage_banner_second_button_url', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('wpdevart_jewstore_eighth_button_slide eighth_btn_slide_right');
    if(!get_theme_mod('wpdevart_jewstore_custom_homepage_banner_second_button_style')) {
        set_theme_mod('wpdevart_jewstore_custom_homepage_banner_second_button_style', $default);
    }
    $default = esc_url(get_theme_file_uri('/images/banner-homepage-image-1.jpg'));
    if(!get_theme_mod('wpdevart_jewstore_custom_homepage_banner_image_1')) {
        set_theme_mod('wpdevart_jewstore_custom_homepage_banner_image_1', $default);
    }
    $default = esc_url(get_theme_file_uri('/images/banner-homepage-image-2.jpg'));
    if(!get_theme_mod('wpdevart_jewstore_custom_homepage_banner_image_2')) {
        set_theme_mod('wpdevart_jewstore_custom_homepage_banner_image_2', $default);
    }
    $default = esc_url(get_theme_file_uri('/images/banner-homepage-image-3.jpg'));
    if(!get_theme_mod('wpdevart_jewstore_custom_homepage_banner_image_3')) {
        set_theme_mod('wpdevart_jewstore_custom_homepage_banner_image_3', $default);
    }
    $default = esc_url(get_theme_file_uri('/images/banner-homepage-image-4.png'));
    if(!get_theme_mod('wpdevart_jewstore_custom_homepage_banner_image_4')) {
        set_theme_mod('wpdevart_jewstore_custom_homepage_banner_image_4', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('banner,woocommerce,sales,benefits-of-ordering,shop-by-brand,shop-by-category,call-to-action,achievements,advantages,services,latest-posts');
    if(!get_theme_mod('wpdevart_jewstore_homepage_sort_sections')) {
        set_theme_mod('wpdevart_jewstore_homepage_sort_sections', $default);
    }
    $default = sanitize_hex_color('#000000');
    if(!get_theme_mod('wpdevart_jewstore_homepage_sections_title_color')) {
        set_theme_mod('wpdevart_jewstore_homepage_sections_title_color', $default);
    }

    $default = wpdevart_jewstore_switch_sanitization('');
    if (!get_theme_mod('wpdevart_jewstore_custom_homepage_hide_woocommerce_products_list')) {
        set_theme_mod( 'wpdevart_jewstore_custom_homepage_hide_woocommerce_products_list', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('Latest Products');
    if(!get_theme_mod('wpdevart_jewstore_custom_homepage_woocommerce_products_list_title')) {
        set_theme_mod('wpdevart_jewstore_custom_homepage_woocommerce_products_list_title', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('Check out the latest added products below.');
    if(!get_theme_mod('wpdevart_jewstore_custom_homepage_woocommerce_products_list_desc')) {
        set_theme_mod('wpdevart_jewstore_custom_homepage_woocommerce_products_list_desc', $default);
    }
    $default = wpdevart_jewstore_sanitize_integer('5');
    if(!get_theme_mod('wpdevart_jewstore_custom_homepage_number_of_woocommerce_products')) {
        set_theme_mod('wpdevart_jewstore_custom_homepage_number_of_woocommerce_products', $default);
    }
    $default = sanitize_hex_color('#ffffff');
    if(!get_theme_mod('wpdevart_jewstore_custom_homepage_woocommerce_products_block_color')) {
        set_theme_mod('wpdevart_jewstore_custom_homepage_woocommerce_products_block_color', $default);
    }
    $default = sanitize_hex_color('#000000');
    if(!get_theme_mod('wpdevart_jewstore_custom_homepage_woocommerce_products_title_color')) {
        set_theme_mod('wpdevart_jewstore_custom_homepage_woocommerce_products_title_color', $default);
    }
    $default = sanitize_hex_color('#333333');
    if(!get_theme_mod('wpdevart_jewstore_custom_homepage_woocommerce_products_price_color')) {
        set_theme_mod('wpdevart_jewstore_custom_homepage_woocommerce_products_price_color', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('Check the Product');
    if(!get_theme_mod('wpdevart_jewstore_custom_homepage_woocommerce_button_text')) {
        set_theme_mod('wpdevart_jewstore_custom_homepage_woocommerce_button_text', $default);
    }
    $default = sanitize_hex_color('#f6901b');
    if(!get_theme_mod('wpdevart_jewstore_custom_homepage_woocommerce_button_bg_color')) {
        set_theme_mod('wpdevart_jewstore_custom_homepage_woocommerce_button_bg_color', $default);
    }
    $default = sanitize_hex_color('#ffffff');
    if(!get_theme_mod('wpdevart_jewstore_custom_homepage_woocommerce_button_link_color')) {
        set_theme_mod('wpdevart_jewstore_custom_homepage_woocommerce_button_link_color', $default);
    }
    $default = wpdevart_jewstore_switch_sanitization('');
    if (!get_theme_mod('wpdevart_jewstore_custom_homepage_hide_call_action')) {
        set_theme_mod( 'wpdevart_jewstore_custom_homepage_hide_call_action', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('Best Offer');
    if(!get_theme_mod('wpdevart_jewstore_custom_homepage_call_action_title')) {
        set_theme_mod('wpdevart_jewstore_custom_homepage_call_action_title', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('A brief description of the section below.');
    if(!get_theme_mod('wpdevart_jewstore_custom_homepage_call_action_desc')) {
        set_theme_mod('wpdevart_jewstore_custom_homepage_call_action_desc', $default);
    }
    $default = esc_url(get_theme_file_uri('/images/call-to-action.jpg'));
    if(!get_theme_mod('wpdevart_jewstore_custom_homepage_call_to_action_image')) {
        set_theme_mod('wpdevart_jewstore_custom_homepage_call_to_action_image', $default);
    }
    $default = sanitize_hex_color('#ffffff');
    if(!get_theme_mod('wpdevart_jewstore_call_action_bg_color')) {
        set_theme_mod('wpdevart_jewstore_call_action_bg_color', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('to right');
    if(!get_theme_mod('wpdevart_jewstore_call_action_gradient_type')) {
        set_theme_mod('wpdevart_jewstore_call_action_gradient_type', $default);
    }
    $default =  sanitize_hex_color('#fcfcfc');
    if(!get_theme_mod('wpdevart_jewstore_call_action_bg_gradient_color')) {
        set_theme_mod('wpdevart_jewstore_call_action_bg_gradient_color', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('Call to Action Title');
    if(!get_theme_mod('wpdevart_jewstore_custom_homepage_call_action_sub_title')) {
        set_theme_mod('wpdevart_jewstore_custom_homepage_call_action_sub_title', $default);
    }
    $default = sanitize_hex_color('#717171');
    if(!get_theme_mod('wpdevart_jewstore_call_action_sub_title_color')) {
        set_theme_mod('wpdevart_jewstore_call_action_sub_title_color', $default);
    }
    $default = wpdevart_jewstore_sanitize_integer('30');
    if(!get_theme_mod('wpdevart_jewstore_call_action_sub_title_font_size')) {
        set_theme_mod('wpdevart_jewstore_call_action_sub_title_font_size', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('This is an important post or event that visitors to our site should pay attention to. Any important content can be added here. This is test content, so feel free to add your own text here. If you are interested or want to know more details, you can click the link below and check more details.');
    if(!get_theme_mod('wpdevart_jewstore_custom_homepage_call_action_text')) {
        set_theme_mod('wpdevart_jewstore_custom_homepage_call_action_text', $default);
    }
    $default = sanitize_hex_color('#717171');
    if(!get_theme_mod('wpdevart_jewstore_call_action_text_color')) {
        set_theme_mod('wpdevart_jewstore_call_action_text_color', $default);
    }
    $default = wpdevart_jewstore_sanitize_integer('16');
    if(!get_theme_mod('wpdevart_jewstore_call_action_text_font_size')) {
        set_theme_mod('wpdevart_jewstore_call_action_text_font_size', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('Learn More');
    if(!get_theme_mod('wpdevart_jewstore_custom_homepage_call_action_button_text')) {
        set_theme_mod('wpdevart_jewstore_custom_homepage_call_action_button_text', $default);
    }
    $default = esc_url('#');
    if(!get_theme_mod('wpdevart_jewstore_custom_homepage_call_action_button_url')) {
        set_theme_mod('wpdevart_jewstore_custom_homepage_call_action_button_url', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('wpdevart_jewstore_primary_button_slide primary_btn_slide_right');
    if(!get_theme_mod('wpdevart_jewstore_custom_homepage_call_action_button_style')) {
        set_theme_mod('wpdevart_jewstore_custom_homepage_call_action_button_style', $default);
    }
    $default = wpdevart_jewstore_switch_sanitization('');
    if (!get_theme_mod('wpdevart_jewstore_custom_homepage_hide_latest_post_section')) {
        set_theme_mod( 'wpdevart_jewstore_custom_homepage_hide_latest_post_section', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('Latest Posts');
    if(!get_theme_mod('wpdevart_jewstore_custom_homepage_latest_post_title')) {
        set_theme_mod('wpdevart_jewstore_custom_homepage_latest_post_title', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('Latest posts from our blog');
    if(!get_theme_mod('wpdevart_jewstore_custom_homepage_latest_post_desctiption')) {
        set_theme_mod('wpdevart_jewstore_custom_homepage_latest_post_desctiption', $default);
    }
    $default = wpdevart_jewstore_sanitize_integer('6');
    if(!get_theme_mod('wpdevart_jewstore_custom_homepage_number_of_latest_posts')) {
        set_theme_mod('wpdevart_jewstore_custom_homepage_number_of_latest_posts', $default);
    }
    $default = sanitize_hex_color('#ffffff');
    if(!get_theme_mod('wpdevart_jewstore_custom_homepage_latest_posts_block_color')) {
        set_theme_mod('wpdevart_jewstore_custom_homepage_latest_posts_block_color', $default);
    }
    $default = sanitize_hex_color('#000000');
    if(!get_theme_mod('wpdevart_jewstore_custom_homepage_latest_posts_title_color')) {
        set_theme_mod('wpdevart_jewstore_custom_homepage_latest_posts_title_color', $default);
    }
    $default = sanitize_hex_color('#717171');
    if(!get_theme_mod('wpdevart_jewstore_custom_homepage_latest_posts_text_color')) {
        set_theme_mod('wpdevart_jewstore_custom_homepage_latest_posts_text_color', $default);
    }

    //* Blog and Archive default options  

    $default = wpdevart_jewstore_text_sanitization('narrow');
    if(!get_theme_mod('wpdevart_jewstore_archive_banner_width')) {
        set_theme_mod('wpdevart_jewstore_archive_banner_width', $default);
    }
    $default = sanitize_hex_color('#ffffff');
    if(!get_theme_mod('wpdevart_jewstore_archive_banner_bg_color')) {
        set_theme_mod('wpdevart_jewstore_archive_banner_bg_color', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('to right');
    if (!get_theme_mod('wpdevart_jewstore_archive_banner_bg_gradient_type')) {
        set_theme_mod( 'wpdevart_jewstore_archive_banner_bg_gradient_type', $default);
    }
    $default = sanitize_hex_color('#fffdfc');
    if(!get_theme_mod('wpdevart_jewstore_archive_banner_bg_gradient_color')) {
        set_theme_mod('wpdevart_jewstore_archive_banner_bg_gradient_color', $default);
    }
    $default = sanitize_hex_color('#000000');
    if(!get_theme_mod('wpdevart_jewstore_archive_banner_title_color')) {
        set_theme_mod('wpdevart_jewstore_archive_banner_title_color', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('center');
    if(!get_theme_mod('wpdevart_jewstore_archive_banner_title_alignment')) {
        set_theme_mod('wpdevart_jewstore_archive_banner_title_alignment', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('sidebarright');
    if (!get_theme_mod('wpdevart_jewstore_blog_archive_page_layout')) {
        set_theme_mod( 'wpdevart_jewstore_blog_archive_page_layout', $default);
    }	
    $default = sanitize_hex_color('#ffffff');
    if(!get_theme_mod('wpdevart_jewstore_blog_settings_posts_list_bg_color')) {
        set_theme_mod('wpdevart_jewstore_blog_settings_posts_list_bg_color', $default);
    }
    $default = wpdevart_jewstore_switch_sanitization('');
    if(!get_theme_mod('wpdevart_jewstore_blog_archive_display_default_featured_image')) {
        set_theme_mod('wpdevart_jewstore_blog_archive_display_default_featured_image', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('figureblogimage');
    if (!get_theme_mod('wpdevart_jewstore_posts_list_images_hover_effect')) {
        set_theme_mod( 'wpdevart_jewstore_posts_list_images_hover_effect', $default);
    }
    $default = wpdevart_jewstore_sanitize_integer('22');
    if(!get_theme_mod('wpdevart_jewstore_blog_settings_title_font_size')) {
        set_theme_mod('wpdevart_jewstore_blog_settings_title_font_size', $default);
    }
    $default = sanitize_hex_color('#000000');
    if(!get_theme_mod('wpdevart_jewstore_blog_settings_title_color')) {
        set_theme_mod('wpdevart_jewstore_blog_settings_title_color', $default);
    }
    $default = sanitize_hex_color('#f6901b');
    if(!get_theme_mod('wpdevart_jewstore_blog_settings_title_hover_color')) {
        set_theme_mod('wpdevart_jewstore_blog_settings_title_hover_color', $default);
    }
    $default = sanitize_hex_color('#dddddd');
    if(!get_theme_mod('wpdevart_jewstore_blog_settings_title_border_color')) {
        set_theme_mod('wpdevart_jewstore_blog_settings_title_border_color', $default);
    }
    $default = wpdevart_jewstore_sanitize_integer('12');
    if(!get_theme_mod('wpdevart_jewstore_blog_settings_metas_font_size')) {
        set_theme_mod('wpdevart_jewstore_blog_settings_metas_font_size', $default);
    }
    $default = sanitize_hex_color('#f6901b');
    if(!get_theme_mod('wpdevart_jewstore_blog_settings_metas_color')) {
        set_theme_mod('wpdevart_jewstore_blog_settings_metas_color', $default);
    }
    $default = sanitize_hex_color('#000000');
    if(!get_theme_mod('wpdevart_jewstore_blog_settings_metas_hover_color')) {
        set_theme_mod('wpdevart_jewstore_blog_settings_metas_hover_color', $default);
    }
    $default = sanitize_hex_color('#000000');
    if(!get_theme_mod('wpdevart_jewstore_blog_settings_meta_icons_color')) {
        set_theme_mod('wpdevart_jewstore_blog_settings_meta_icons_color', $default);
    }
    $default = wpdevart_jewstore_sanitize_integer('15');
    if(!get_theme_mod('wpdevart_jewstore_blog_settings_content_text_font_size')) {
        set_theme_mod('wpdevart_jewstore_blog_settings_content_text_font_size', $default);
    }
    $default = sanitize_hex_color('#717171');
    if(!get_theme_mod('wpdevart_jewstore_blog_settings_content_text_color')) {
        set_theme_mod('wpdevart_jewstore_blog_settings_content_text_color', $default);
    }
    $default = wpdevart_jewstore_sanitize_integer('13');
    if(!get_theme_mod('wpdevart_jewstore_blog_settings_category_text_font_size')) {
        set_theme_mod('wpdevart_jewstore_blog_settings_category_text_font_size', $default);
    }
    $default = sanitize_hex_color('#ffffff');
    if(!get_theme_mod('wpdevart_jewstore_blog_settings_category_bg_color')) {
        set_theme_mod('wpdevart_jewstore_blog_settings_category_bg_color', $default);
    }
    $default = sanitize_hex_color('#f6901b');
    if(!get_theme_mod('wpdevart_jewstore_blog_settings_category_border_color')) {
        set_theme_mod('wpdevart_jewstore_blog_settings_category_border_color', $default);
    }
    $default = sanitize_hex_color('#f6901b');
    if(!get_theme_mod('wpdevart_jewstore_blog_settings_category_text_color')) {
        set_theme_mod('wpdevart_jewstore_blog_settings_category_text_color', $default);
    }
    $default = sanitize_hex_color('#f6901b');
    if(!get_theme_mod('wpdevart_jewstore_blog_settings_category_bg_hover_color')) {
        set_theme_mod('wpdevart_jewstore_blog_settings_category_bg_hover_color', $default);
    }
    $default = sanitize_hex_color('#f6901b');
    if(!get_theme_mod('wpdevart_jewstore_blog_settings_category_border_hover_color')) {
        set_theme_mod('wpdevart_jewstore_blog_settings_category_border_hover_color', $default);
    }
    $default = sanitize_hex_color('#ffffff');
    if(!get_theme_mod('wpdevart_jewstore_blog_settings_category_text_hover_color')) {
        set_theme_mod('wpdevart_jewstore_blog_settings_category_text_hover_color', $default);
    }

    //* Pagination

    $default = sanitize_hex_color('#ffffff');
    if (!get_theme_mod('wpdevart_jewstore_pagination_buttons_bg_color')) {
        set_theme_mod( 'wpdevart_jewstore_pagination_buttons_bg_color', $default);
    }	
    $default = sanitize_hex_color('#f6901b');
    if (!get_theme_mod('wpdevart_jewstore_pagination_buttons_border_color')) {
        set_theme_mod( 'wpdevart_jewstore_pagination_buttons_border_color', $default);
    }
    $default = sanitize_hex_color('#f6901b');
    if (!get_theme_mod('wpdevart_jewstore_pagination_buttons_link_color')) {
        set_theme_mod( 'wpdevart_jewstore_pagination_buttons_link_color', $default);
    }
    $default = sanitize_hex_color('#f9c0d7');
    if (!get_theme_mod('wpdevart_jewstore_pagination_buttons_text_color')) {
        set_theme_mod( 'wpdevart_jewstore_pagination_buttons_text_color', $default);
    }
    $default = sanitize_hex_color('#f6901b');
    if (!get_theme_mod('wpdevart_jewstore_pagination_buttons_bg_hover_color')) {
        set_theme_mod( 'wpdevart_jewstore_pagination_buttons_bg_hover_color', $default);
    }
    $default = sanitize_hex_color('#f6901b');
    if (!get_theme_mod('wpdevart_jewstore_pagination_buttons_border_hover_color')) {
        set_theme_mod( 'wpdevart_jewstore_pagination_buttons_border_hover_color', $default);
    }
    $default = sanitize_hex_color('#ffffff');
    if (!get_theme_mod('wpdevart_jewstore_pagination_buttons_link_hover_color')) {
        set_theme_mod( 'wpdevart_jewstore_pagination_buttons_link_hover_color', $default);
    }
    $default = sanitize_hex_color('#f9c0d7');
    if (!get_theme_mod('wpdevart_jewstore_pagination_buttons_text_hover_color')) {
        set_theme_mod( 'wpdevart_jewstore_pagination_buttons_text_hover_color', $default);
    }

    //* Footer default options

    $default = wpdevart_jewstore_text_sanitization('wpdevartfivewidgets');
    if(!get_theme_mod('wpdevart_jewstore_footer_layout')) {
        set_theme_mod('wpdevart_jewstore_footer_layout', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('wpdevart-footer-one');
    if(!get_theme_mod('wpdevart_jewstore_footer_template')) {
        set_theme_mod('wpdevart_jewstore_footer_template', $default);
    }
    $default = wpdevart_jewstore_switch_sanitization('1');
    if(!get_theme_mod('wpdevart_jewstore_pre_footer_wave_display_option')) {
        set_theme_mod('wpdevart_jewstore_pre_footer_wave_display_option', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('All rights reserved.');
    if(!get_theme_mod('wpdevart_jewstore_footer_copyright_text')) {
        set_theme_mod('wpdevart_jewstore_footer_copyright_text', $default);
    }
    $default = wpdevart_jewstore_switch_sanitization('');
    if(!get_theme_mod('wpdevart_jewstore_footer_image_display_option')) {
        set_theme_mod('wpdevart_jewstore_footer_image_display_option', $default);
    }
    $default = esc_url(get_theme_file_uri('/images/payment-systems-footer.png'));
    if(!get_theme_mod('wpdevart_jewstore_footer_copyright_section_image')) {
        set_theme_mod('wpdevart_jewstore_footer_copyright_section_image', $default);
    }

    //* Search page default options  
    
    $default = wpdevart_jewstore_text_sanitization('narrow');
    if(!get_theme_mod('wpdevart_jewstore_search_banner_width')) {
        set_theme_mod('wpdevart_jewstore_search_banner_width', $default);
    }
    $default = sanitize_hex_color('#ffffff');
    if(!get_theme_mod('wpdevart_jewstore_search_banner_bg_color')) {
        set_theme_mod('wpdevart_jewstore_search_banner_bg_color', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('to right');
    if (!get_theme_mod('wpdevart_jewstore_search_banner_bg_gradient_type')) {
        set_theme_mod( 'wpdevart_jewstore_search_banner_bg_gradient_type', $default);
    }
    $default = sanitize_hex_color('#fffdfc');
    if(!get_theme_mod('wpdevart_jewstore_search_banner_bg_gradient_color')) {
        set_theme_mod('wpdevart_jewstore_search_banner_bg_gradient_color', $default);
    }
    $default = sanitize_hex_color('#000000');
    if(!get_theme_mod('wpdevart_jewstore_search_banner_title_color')) {
        set_theme_mod('wpdevart_jewstore_search_banner_title_color', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('center');
    if(!get_theme_mod('wpdevart_jewstore_search_banner_title_alignment')) {
        set_theme_mod('wpdevart_jewstore_search_banner_title_alignment', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('sidebarright');
    if (!get_theme_mod('wpdevart_jewstore_search_page_layout')) {
        set_theme_mod( 'wpdevart_jewstore_search_page_layout', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('wpdevart_jewstore_eighth_button_slide eighth_btn_slide_right');
    if (!get_theme_mod('wpdevart_jewstore_search_page_button_style')) {
        set_theme_mod( 'wpdevart_jewstore_search_page_button_style', $default);
    }
    //* 404 error page default options  

    $default = sanitize_hex_color('#ffffff');
    if(!get_theme_mod('wpdevart_jewstore_not_found_page_bg_color')) {
        set_theme_mod('wpdevart_jewstore_not_found_page_bg_color', $default);
    }
    $default = esc_url(get_theme_file_uri('/images/wpdevart-default-404.png'));
    if(!get_theme_mod('wpdevart_jewstore_not_found_image')) {
        set_theme_mod('wpdevart_jewstore_not_found_image', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('Oops! Page Not Found');
    if(!get_theme_mod('wpdevart_jewstore_not_found_page_title')) {
        set_theme_mod('wpdevart_jewstore_not_found_page_title', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('The page or URL you are trying to access was not found. Use the homepage link below to navigate to the homepage. You can also use the search function.');
    if(!get_theme_mod('wpdevart_jewstore_not_found_page_description')) {
        set_theme_mod('wpdevart_jewstore_not_found_page_description', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('Back to Homepage');
    if(!get_theme_mod('wpdevart_jewstore_not_found_page_button_text')) {
        set_theme_mod('wpdevart_jewstore_not_found_page_button_text', $default);
    }
    $default = esc_url(get_home_url());
    if(!get_theme_mod('wpdevart_jewstore_not_found_page_button_url')) {
        set_theme_mod('wpdevart_jewstore_not_found_page_button_url', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('wpdevart_jewstore_eighth_button_slide eighth_btn_slide_right');
    if(!get_theme_mod('wpdevart_jewstore_not_found_page_button_style')) {
        set_theme_mod('wpdevart_jewstore_not_found_page_button_style', $default);
    }

    //* WooCommerce

    $default = wpdevart_jewstore_text_sanitization('sidebarnone');
    if (!get_theme_mod('wpdevart_jewstore_woocommerce_shop_category_layout')) {
        set_theme_mod( 'wpdevart_jewstore_woocommerce_shop_category_layout', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('sidebarnone');
    if (!get_theme_mod('wpdevart_jewstore_woocommerce_product_pages_layout')) {
        set_theme_mod( 'wpdevart_jewstore_woocommerce_product_pages_layout', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('sidebarnone');
    if (!get_theme_mod('wpdevart_jewstore_woocommerce_cart_checkout_account_layout')) {
        set_theme_mod( 'wpdevart_jewstore_woocommerce_cart_checkout_account_layout', $default);
    }
    $default = wpdevart_jewstore_switch_sanitization('');
    if(!get_theme_mod('wpdevart_jewstore_woo_shop_cat_breadcrumbs_display_option')) {
        set_theme_mod('wpdevart_jewstore_woo_shop_cat_breadcrumbs_display_option', $default);
    }
    $default = wpdevart_jewstore_switch_sanitization('');
    if(!get_theme_mod('wpdevart_jewstore_woo_products_breadcrumbs_display_option')) {
        set_theme_mod('wpdevart_jewstore_woo_products_breadcrumbs_display_option', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('Home');
    if(!get_theme_mod('wpdevart_jewstore_woo_breadcrumbs_home_text')) {
        set_theme_mod('wpdevart_jewstore_woo_breadcrumbs_home_text', $default);
    }
    $default = wpdevart_jewstore_text_sanitization('Shop');
    if(!get_theme_mod('wpdevart_jewstore_woo_breadcrumbs_shop_text')) {
        set_theme_mod('wpdevart_jewstore_woo_breadcrumbs_shop_text', $default);
    }
    $default = sanitize_hex_color('#333333');
    if (!get_theme_mod('wpdevart_jewstore_woo_breadcrumbs_color')) {
        set_theme_mod( 'wpdevart_jewstore_woo_breadcrumbs_color', $default);
    }
    $default = sanitize_hex_color('#f6901b');
    if (!get_theme_mod('wpdevart_jewstore_woo_breadcrumbs_hover_color')) {
        set_theme_mod( 'wpdevart_jewstore_woo_breadcrumbs_hover_color', $default);
    }
    $default = sanitize_hex_color('#f6901b');
    if (!get_theme_mod('wpdevart_jewstore_woocommerce_account_icon_color')) {
        set_theme_mod( 'wpdevart_jewstore_woocommerce_account_icon_color', $default);
    }
    $default = sanitize_hex_color('#f6901b');
    if (!get_theme_mod('wpdevart_jewstore_woocommerce_cart_icon_color')) {
        set_theme_mod( 'wpdevart_jewstore_woocommerce_cart_icon_color', $default);
    }
    $default = sanitize_hex_color('#ffffff');
    if (!get_theme_mod('wpdevart_jewstore_woocommerce_cart_icon_number_color')) {
        set_theme_mod( 'wpdevart_jewstore_woocommerce_cart_icon_number_color', $default);
    }
    $default = sanitize_hex_color('#ffffff');
    if (!get_theme_mod('wpdevart_jewstore_woocommerce_page_bg_color')) {
        set_theme_mod( 'wpdevart_jewstore_woocommerce_page_bg_color', $default);
    }
    $default = sanitize_hex_color('#ffffff');
    if (!get_theme_mod('wpdevart_jewstore_woocommerce_products_blocks_bg_color')) {
        set_theme_mod( 'wpdevart_jewstore_woocommerce_products_blocks_bg_color', $default);
    }
    $default = sanitize_hex_color('#000000');
    if (!get_theme_mod('wpdevart_jewstore_woocommerce_heading_color')) {
        set_theme_mod( 'wpdevart_jewstore_woocommerce_heading_color', $default);
    }
    $default = sanitize_hex_color('#333333');
    if (!get_theme_mod('wpdevart_jewstore_woocommerce_text_color')) {
        set_theme_mod( 'wpdevart_jewstore_woocommerce_text_color', $default);
    }
    $default = sanitize_hex_color('#000000');
    if (!get_theme_mod('wpdevart_jewstore_woocommerce_link_color')) {
        set_theme_mod( 'wpdevart_jewstore_woocommerce_link_color', $default);
    }
    $default = sanitize_hex_color('#f6901b');
    if (!get_theme_mod('wpdevart_jewstore_woocommerce_link_hover_color')) {
        set_theme_mod( 'wpdevart_jewstore_woocommerce_link_hover_color', $default);
    }
    $default = sanitize_hex_color('#ffffff');
    if (!get_theme_mod('wpdevart_jewstore_woocommerce_sales_bg_color')) {
        set_theme_mod( 'wpdevart_jewstore_woocommerce_sales_bg_color', $default);
    }
    $default = sanitize_hex_color('#f6901b');
    if (!get_theme_mod('wpdevart_jewstore_woocommerce_sales_text_color')) {
        set_theme_mod( 'wpdevart_jewstore_woocommerce_sales_text_color', $default);
    }
    $default = sanitize_hex_color('#f6901b');
    if (!get_theme_mod('wpdevart_jewstore_woocommerce_active_tab_color')) {
        set_theme_mod( 'wpdevart_jewstore_woocommerce_active_tab_color', $default);
    }
    $default = sanitize_hex_color('#7e7e7e');
    if (!get_theme_mod('wpdevart_jewstore_woocommerce_inactive_tab_color')) {
        set_theme_mod( 'wpdevart_jewstore_woocommerce_inactive_tab_color', $default);
    }
    $default = sanitize_hex_color('#e2eeff');
    if (!get_theme_mod('wpdevart_jewstore_woocommerce_tab_border_color')) {
        set_theme_mod( 'wpdevart_jewstore_woocommerce_tab_border_color', $default);
    }
    $default = sanitize_hex_color('#f6901b');
    if (!get_theme_mod('wpdevart_jewstore_woocommerce_rating_color')) {
        set_theme_mod( 'wpdevart_jewstore_woocommerce_rating_color', $default);
    }
    $default = sanitize_hex_color('#f6901b');
    if (!get_theme_mod('wpdevart_jewstore_woocommerce_info_border_icon_color')) {
        set_theme_mod( 'wpdevart_jewstore_woocommerce_info_border_icon_color', $default);
    }
    $default = sanitize_hex_color('#ffffff');
    if (!get_theme_mod('wpdevart_jewstore_woo_pagination_buttons_bg_color')) {
        set_theme_mod( 'wpdevart_jewstore_woo_pagination_buttons_bg_color', $default);
    }
    $default = sanitize_hex_color('#f6901b');
    if (!get_theme_mod('wpdevart_jewstore_woo_pagination_buttons_border_color')) {
        set_theme_mod( 'wpdevart_jewstore_woo_pagination_buttons_border_color', $default);
    }
    $default = sanitize_hex_color('#f9c0d7');
    if (!get_theme_mod('wpdevart_jewstore_woo_pagination_buttons_text_color')) {
        set_theme_mod( 'wpdevart_jewstore_woo_pagination_buttons_text_color', $default);
    }
    $default = sanitize_hex_color('#f6901b');
    if (!get_theme_mod('wpdevart_jewstore_woo_pagination_buttons_link_color')) {
        set_theme_mod( 'wpdevart_jewstore_woo_pagination_buttons_link_color', $default);
    }
    $default = sanitize_hex_color('#f6901b');
    if (!get_theme_mod('wpdevart_jewstore_woo_pagination_buttons_bg_hover_color')) {
        set_theme_mod( 'wpdevart_jewstore_woo_pagination_buttons_bg_hover_color', $default);
    }
    $default = sanitize_hex_color('#f6901b');
    if (!get_theme_mod('wpdevart_jewstore_woo_pagination_buttons_border_hover_color')) {
        set_theme_mod( 'wpdevart_jewstore_woo_pagination_buttons_border_hover_color', $default);
    }
    $default = sanitize_hex_color('#ffffff');
    if (!get_theme_mod('wpdevart_jewstore_woo_pagination_buttons_link_hover_color')) {
        set_theme_mod( 'wpdevart_jewstore_woo_pagination_buttons_link_hover_color', $default);
    }
    $default = sanitize_hex_color('#f9c0d7');
    if (!get_theme_mod('wpdevart_jewstore_woo_pagination_buttons_text_hover_color')) {
        set_theme_mod( 'wpdevart_jewstore_woo_pagination_buttons_text_hover_color', $default);
    }
    $default = wpdevart_jewstore_sanitize_integer('18');
    if(!get_theme_mod('wpdevart_jewstore_woo_pagination_text_font_size')) {
        set_theme_mod('wpdevart_jewstore_woo_pagination_text_font_size', $default);
    }
    $default = wpdevart_jewstore_sanitize_integer('17');
    if(!get_theme_mod('wpdevart_jewstore_woocommerce_text_font_size')) {
        set_theme_mod('wpdevart_jewstore_woocommerce_text_font_size', $default);
    }
    $default = wpdevart_jewstore_sanitize_integer('17');
    if(!get_theme_mod('wpdevart_jewstore_woocommerce_link_font_size')) {
        set_theme_mod('wpdevart_jewstore_woocommerce_link_font_size', $default);
    }
    $default = wpdevart_jewstore_sanitize_integer('40');
    if(!get_theme_mod('wpdevart_jewstore_woocommerce_heading_h1_font_size')) {
        set_theme_mod('wpdevart_jewstore_woocommerce_heading_h1_font_size', $default);
    }
    $default = sanitize_hex_color('#ffffff');
    if (!get_theme_mod('wpdevart_jewstore_header_cart_bg_color')) {
        set_theme_mod( 'wpdevart_jewstore_header_cart_bg_color', $default);
    }
    $default = sanitize_hex_color('#e2e2e2');
    if (!get_theme_mod('wpdevart_jewstore_header_cart_border_color')) {
        set_theme_mod( 'wpdevart_jewstore_header_cart_border_color', $default);
    }
    $default = sanitize_hex_color('#000000');
    if (!get_theme_mod('wpdevart_jewstore_header_cart_text_link_color')) {
        set_theme_mod( 'wpdevart_jewstore_header_cart_text_link_color', $default);
    }
    $default = sanitize_hex_color('#f6901b');
    if (!get_theme_mod('wpdevart_jewstore_header_cart_remove_color')) {
        set_theme_mod( 'wpdevart_jewstore_header_cart_remove_color', $default);
    }
    $default = sanitize_hex_color('#000000');
    if (!get_theme_mod('wpdevart_jewstore_header_cart_remove_hover_color')) {
        set_theme_mod( 'wpdevart_jewstore_header_cart_remove_hover_color', $default);
    }
    $default = sanitize_hex_color('#ffffff');
    if (!get_theme_mod('wpdevart_jewstore_woo_primary_button_bg_color')) {
        set_theme_mod( 'wpdevart_jewstore_woo_primary_button_bg_color', $default);
    }
    $default = sanitize_hex_color('#f6901b');
    if (!get_theme_mod('wpdevart_jewstore_woo_primary_button_border_color')) {
        set_theme_mod( 'wpdevart_jewstore_woo_primary_button_border_color', $default);
    }
    $default = sanitize_hex_color('#f6901b');
    if (!get_theme_mod('wpdevart_jewstore_woo_primary_button_link_color')) {
        set_theme_mod( 'wpdevart_jewstore_woo_primary_button_link_color', $default);
    }
    $default = sanitize_hex_color('#f6901b');
    if (!get_theme_mod('wpdevart_jewstore_woo_primary_button_bg_hover_color')) {
        set_theme_mod( 'wpdevart_jewstore_woo_primary_button_bg_hover_color', $default);
    }
    $default = sanitize_hex_color('#f6901b');
    if (!get_theme_mod('wpdevart_jewstore_woo_primary_button_border_hover_color')) {
        set_theme_mod( 'wpdevart_jewstore_woo_primary_button_border_hover_color', $default);
    }
    $default = sanitize_hex_color('#ffffff');
    if (!get_theme_mod('wpdevart_jewstore_woo_primary_button_link_hover_color')) {
        set_theme_mod( 'wpdevart_jewstore_woo_primary_button_link_hover_color', $default);
    }
    $default = sanitize_hex_color('#ffffff');
    if (!get_theme_mod('wpdevart_jewstore_woocommerce_sidebar_bg_color')) {
        set_theme_mod( 'wpdevart_jewstore_woocommerce_sidebar_bg_color', $default);
    }
    $default = sanitize_hex_color('#e2e2e2');
    if (!get_theme_mod('wpdevart_jewstore_woocommerce_widget_shadow_color')) {
        set_theme_mod( 'wpdevart_jewstore_woocommerce_widget_shadow_color', $default);
    }
    $default = sanitize_hex_color('#000000');
    if (!get_theme_mod('wpdevart_jewstore_woocommerce_sidebar_headings_color')) {
        set_theme_mod( 'wpdevart_jewstore_woocommerce_sidebar_headings_color', $default);
    }
    $default = sanitize_hex_color('#333333');
    if (!get_theme_mod('wpdevart_jewstore_woocommerce_sidebar_text_color')) {
        set_theme_mod( 'wpdevart_jewstore_woocommerce_sidebar_text_color', $default);
    }
    $default = sanitize_hex_color('#000000');
    if (!get_theme_mod('wpdevart_jewstore_woocommerce_sidebar_link_color')) {
        set_theme_mod( 'wpdevart_jewstore_woocommerce_sidebar_link_color', $default);
    }
    $default = sanitize_hex_color('#f6901b');
    if (!get_theme_mod('wpdevart_jewstore_woocommerce_sidebar_link_hover_color')) {
        set_theme_mod( 'wpdevart_jewstore_woocommerce_sidebar_link_hover_color', $default);
    }

}