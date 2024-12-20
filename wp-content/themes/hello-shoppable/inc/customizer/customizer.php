<?php
/**
 * Hello Shoppable Theme Customizer
 *
 * @package Hello Shoppable
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function hello_shoppable_customize_register( $wp_customize ) {
	include_once ABSPATH . 'wp-admin/includes/plugin.php';
	if( is_plugin_active( 'shoppable-pro/shoppable-pro.php' ) ){
		return;
	}
	// Load custom control functions.
	require get_template_directory() . '/inc/customizer/controls.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

	// Register custom section types.
	$wp_customize->register_section_type( 'Hello_Shoppable_Customize_Section_Upsell' );

	// Register sections.
	$wp_customize->add_section(
		new Hello_Shoppable_Customize_Section_Upsell(
			$wp_customize,
			'theme_upsell',
			array(
				'title'    => esc_html__( 'Shoppable Pro', 'hello-shoppable' ),
				'pro_text' => esc_html__( 'Upgrade To Pro', 'hello-shoppable' ),
				'pro_url'  => 'https://bosathemes.com/shoppable-pro/',
				'priority'  => 1,
			)
		)
	);
}
add_action( 'customize_register', 'hello_shoppable_customize_register' );

/**
 * Restructures WooCommerce product catalog customizer options.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function hello_shoppable_customizer_structure( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	if ( class_exists( 'WooCommerce') ) {
		$wp_customize->get_panel( 'woocommerce' )->priority  	= 90;

		$wp_customize->get_control( 'woocommerce_shop_page_display' )->priority  = '400';
		$wp_customize->get_control( 'woocommerce_category_archive_display' )->priority  = '410';
		$wp_customize->get_control( 'woocommerce_default_catalog_orderby' )->priority  = '420';
	}

	if ( class_exists( 'Kirki') ) {
		$wp_customize->get_section( 'title_tagline' )->panel  	= 'header_options';
		
		$wp_customize->get_control( 'blogdescription' )->priority  			= 12;


	}
}
add_action( 'customize_register', 'hello_shoppable_customizer_structure', 15 );

/**
 * Enqueue style for custom customize control.
 */
add_action( 'customize_controls_enqueue_scripts', 'hello_shoppable_custom_customize_enqueue' );
function hello_shoppable_custom_customize_enqueue() {
	wp_enqueue_style( 'hello-shoppable-customize-controls', get_template_directory_uri() . '/inc/customizer/customizer.css' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function hello_shoppable_customize_preview_js() {
	wp_enqueue_script( 'hello-shoppable-customizer', get_template_directory_uri() . '/inc/customizer/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'hello_shoppable_customize_preview_js' );

function hello_shoppable_customize_getting_js() {
	wp_enqueue_script( 'hello-shoppable-customizer-getting-started', get_template_directory_uri() . '/inc/getting-started/getting-started.js', array( 'customize-controls', 'jquery' ), true );
}
add_action( 'customize_controls_enqueue_scripts', 'hello_shoppable_customize_getting_js' );

/**
 * Kirki Customizer
 *
 * @return void
 */
add_action( 'init' , 'hello_shoppable_kirki_fields' );

function hello_shoppable_kirki_fields(){

	/**
	* If kirki is not installed do not run the kirki fields
	*/

	if ( !class_exists( 'Kirki' ) ) {
		return;
	}

	Kirki::add_config( 'hello-shoppable', array(
		'capability'  => 'edit_theme_options',
		'option_type' => 'theme_mod',
	) );

	// Documentation & Demo
	Kirki::add_panel( 'documentation_demo_options', array(
	    'title' => esc_html__( 'Documentation & Demo', 'hello-shoppable' ),
	    'priority' => 25,
	) );

	Kirki::add_section( 'documentation_options', array(
	    'title' => esc_html__( 'Documentation', 'hello-shoppable' ),
	    'panel' => "documentation_demo_options",
	    'priority' => 10,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Documentation', 'hello-shoppable' ),
	    'type'        => 'custom',
	    'settings'    => 'documentaion_description_info',
	    'section'     => 'documentation_options',
	    'default'  => wp_kses( __( 'For step-by-step tutorial and documentation <a target="_blank" href="https://bosathemes.com/docs/shoppable">click here</a>.', 'hello-shoppable' ), array(
			    'a' => array(
			      'target' => array(),
			      'href' => array(),
			    ),
		  	)
		),
	    'priority'	  => 10,
	) );

	Kirki::add_section( 'demo_options', array(
	    'title' => esc_html__( 'Demo', 'hello-shoppable' ),
	    'panel' => "documentation_demo_options",
	    'priority' => 20,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Demo', 'hello-shoppable' ),
	    'type'        => 'custom',
	    'settings'    => 'demo_description_info',
	    'section'     => 'demo_options',
	    'default'  => wp_kses( __( 'Check out the starter demo <a target="_blank" href="https://demo.bosathemes.com/shoppable/hello-shoppable/"> here</a>.', 'hello-shoppable' ), array(
			    'a' => array(
			      'target' => array(),
			      'href' => array(),
			    ),
		  	)
		),
	    'priority'	  => 10,
	) );
	
	// Colors Options

	Kirki::add_field( 'hello-shoppable', array(
	    'label'        => esc_html__( 'Dark Mode', 'hello-shoppable' ),
	    'type'         => 'toggle',
	    'settings'     => 'enable_dark_mode',
	    'section'      => 'colors',
	    'default'      => false,
	    'priority'     => 5,
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'label'        => esc_html__( 'Image Greyscale', 'hello-shoppable' ),
	    'type'         => 'toggle',
	    'settings'     => 'enable_image_greyscale',
	    'section'      => 'colors',
	    'default'      => false,
	    'priority'     => 6,
	    'active_callback' => array(
	      array(
	        'setting'  => 'enable_dark_mode',
	        'operator' => '==',
	        'value'    => true,
	      ),
	    ),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'label'        => esc_html__( 'Show Image Color on Hover', 'hello-shoppable' ),
	    'type'         => 'toggle',
	    'settings'     => 'enable_image_color_on_hover',
	    'section'      => 'colors',
	    'default'      => false,
	    'priority'     => 7,
	    'active_callback' => array(
	      array(
	        'setting'  => 'enable_dark_mode',
	        'operator' => '==',
	        'value'    => true,
	      ),
	      array(
	        'setting'  => 'enable_image_greyscale',
	        'operator' => '==',
	        'value'    => true,
	      ),
	    ),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'general_color_separator',
	    'section'     => 'colors',
	    'default'  	  => wp_kses_post(
	    	'<div class="customizer_separator_title">'.esc_html__( 'General Colors', 'hello-shoppable' ).'</div>'
	    ),
	    'priority'	  => 10,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Body Text Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'site_body_text_color',
		'section'      => 'colors',
		'default'      => '#333333',
		'priority'     => 20,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Page and Single Post Title Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'page_post_text_color',
		'section'      => 'colors',
		'default'      => '#030303',
		'priority'     => 30,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Post Meta Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'general_post_meta_color',
		'section'      => 'colors',
		'default'      => '#717171',
		'priority'     => 35,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Primary Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'site_primary_color',
		'section'      => 'colors',
		'default'      => '#EB5A3E',
		'priority'     => 40,
		'choices'	   => array(
			'alpha'		=> true,
		),
	) );
	
	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Hover Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'site_hover_color',
		'section'      => 'colors',
		'default'     => '#2154ac',
		'priority'    => 50,
		'choices'	   => array(
			'alpha'		=> true,
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'links_color_border',
	    'section'     => 'colors',
	    'default'  => wp_kses( '<hr class="customizer_separator">', array(
			    'hr' => array(
			      'class' => array(),
			    ),
		  	)
		),
	    'priority'	  => 60,
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'links_color_separator',
	    'section'     => 'colors',
	    'default'  	  => wp_kses_post( 
	    	'<div class="customizer_separator_title">'.esc_html__( 'General Links Colors', 'hello-shoppable' ).'</div>'
	    ),
	    'priority'	  => 70,
	    'active_callback' => array(
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Text Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'site_general_link_color',
		'section'      => 'colors',
		'default'      => '#a6a6a6',
		'priority'     => 80,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Hover Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'site_general_link_hover',
		'section'      => 'colors',
		'default'      => '#2154ac',
		'priority'     => 90,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'heading_color_border',
	    'section'     => 'colors',
	    'default'  => wp_kses( '<hr class="customizer_separator">', array(
			    'hr' => array(
			      'class' => array(),
			    ),
		  	)
		),
	    'priority'	  => 100,
	    'active_callback' => array(
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'heading_color_separator',
	    'section'     => 'colors',
	    'default'  	  => wp_kses_post(
	    	'<div class="customizer_separator_title">'.esc_html__( 'Headings Colors', 'hello-shoppable' ).'</div>'
	    ),
	    'priority'	  => 110,
	    'active_callback' => array(
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Heading 1 (H1)', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'heading_one_text_color',
		'section'      => 'colors',
		'default'      => '#030303',
		'priority'     => 120,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Heading 2 (H2)', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'heading_two_text_color',
		'section'      => 'colors',
		'default'      => '#030303',
		'priority'     => 130,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Heading 3 (H3)', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'heading_three_text_color',
		'section'      => 'colors',
		'default'      => '#030303',
		'priority'     => 140,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Heading 4 (H4)', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'heading_four_text_color',
		'section'      => 'colors',
		'default'      => '#030303',
		'priority'     => 150,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Heading 5 (H5)', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'heading_five_text_color',
		'section'      => 'colors',
		'default'      => '#030303',
		'priority'     => 160,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Heading 6 (H6)', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'heading_six_text_color',
		'section'      => 'colors',
		'default'      => '#030303',
		'priority'     => 170,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'form_color_border',
	    'section'     => 'colors',
	    'default'  => wp_kses( '<hr class="customizer_separator">', array(
			    'hr' => array(
			      'class' => array(),
			    ),
		  	)
		),
	    'priority'	  => 180,
	    'active_callback' => array(
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'form_color_separator',
	    'section'     => 'colors',
	    'default'  	  => wp_kses_post(
	    	'<div class="customizer_separator_title">'.esc_html__( 'Form Fields Colors', 'hello-shoppable' ).'</div>'
	    ),
	    'priority'	  => 190,
	    'active_callback' => array(
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Background Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'form_bg_color',
		'section'      => 'colors',
		'default'      => '',
		'priority'     => 210,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Placeholder Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'form_placeholder_color',
		'section'      => 'colors',
		'default'      => '',
		'priority'     => 220,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Text Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'form_text_color',
		'section'      => 'colors',
		'default'      => '',
		'priority'     => 230,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Border Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'form_border_color',
		'section'      => 'colors',
		'default'      => '',
		'priority'     => 240,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	// General Options
	Kirki::add_panel( 'general_options', array(
	    'title' => esc_html__( 'General', 'hello-shoppable' ),
	    'priority' => 30,
	) );

	// Site Layouts Options
	Kirki::add_section( 'site_layout_options', array(
	    'title' 		=> esc_html__( 'Site Layouts', 'hello-shoppable' ),
	    'panel'			=> 'general_options',
	    'capability' 	=> 'edit_theme_options',
	    'priority' 		=> 20,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Site Layouts', 'hello-shoppable' ),
		'type'        => 'radio-buttonset',
		'settings'    => 'site_layout',
		'section'     => 'site_layout_options',
		'default'     => 'default',
		'choices'  => array(
			'default'  => esc_html__( 'Default', 'hello-shoppable' ),
			'box'      => esc_html__( 'Box', 'hello-shoppable' ),
			'frame'    => esc_html__( 'Frame', 'hello-shoppable' ),
			'extend'   => esc_html__( 'Extend', 'hello-shoppable' ),
		),
		'priority'	  => 10,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Site Layouts (Box & Frame) Shadow', 'hello-shoppable' ),
		'type'         => 'toggle',
		'settings'     => 'site_layout_shadow',
		'section'      => 'site_layout_options',
		'default'      => true,
		'priority'	   => 15,
		'active_callback' => array(
			array(
				'setting'  => 'site_layout',
				'operator' => 'contains',
				'value'    => array( 'box', 'frame' ),
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Background Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'box_frame_background_color',
		'section'      => 'site_layout_options',
		'default'      => '',
		'priority'	  => 20,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'site_layout',
				'operator' => 'contains',
				'value'    => array( 'box', 'frame' ),
			),
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Background Image', 'hello-shoppable' ),
		'type'         => 'image',
		'settings'     => 'box_frame_background_image',
		'section'      => 'site_layout_options',
		'default'      => '',
		'choices'     => array(
			'save_as' => 'id',
		),
		'priority'	  => 30,
		'active_callback' => array(
			array(
				'setting'  => 'site_layout',
				'operator' => 'contains',
				'value'    => array( 'box', 'frame' ),
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Background Image Size', 'hello-shoppable' ),
		'type'         => 'radio-buttonset',
		'settings'     => 'box_frame_image_size',
		'section'      => 'site_layout_options',
		'default'      => 'cover',
		'choices'      => array(
			'cover'    => esc_html__( 'Cover', 'hello-shoppable' ),
			'pattern'  => esc_html__( 'Repeat', 'hello-shoppable' ),
			'norepeat' => esc_html__( 'No Repeat', 'hello-shoppable' ),
		),
		'priority'	  => 40,
		'active_callback' => array(
			array(
				'setting'  => 'site_layout',
				'operator' => 'contains',
				'value'    => array( 'box', 'frame' ),
			),
		),
	) );

	// Pages Options
	Kirki::add_section( 'pages_options', array(
	    'title'          => esc_html__( 'Pages', 'hello-shoppable' ),
	    'capability'     => 'edit_theme_options',
	    'panel'			 => 'general_options',
	    'priority'       => 30,
	) );

	Kirki::add_field( 'hello-shoppable',  array(
		'label'       => esc_html__( 'Page Title', 'hello-shoppable' ),
		'type'        => 'select',
		'settings'    => 'disable_page_title',
		'section'     => 'pages_options',
		'default'     => 'disable_front_page',
		'choices'     => array(
			'disable_all_pages'   => esc_html__( 'Disable from all', 'hello-shoppable' ),
			'enable_all_pages'    => esc_html__( 'Enable in all', 'hello-shoppable' ),
			'disable_front_page'  => esc_html__( 'Disable from frontpage only', 'hello-shoppable' ),
		),
		'priority'	   => 10,
	) );
	
	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Feature Image', 'hello-shoppable' ),
		'type'        => 'select',
		'settings'    => 'page_feature_image',
		'section'     => 'pages_options',
		'default'     => 'show_in_all_pages',
		'choices' => array(
			'show_in_all_pages'    => esc_html__( 'Show in all Pages', 'hello-shoppable' ),
			'disable_in_all_pages' => esc_html__( 'Disable in all Pages', 'hello-shoppable' ),
			'disable_in_frontpage' => esc_html__( 'Disable in Frontpage only', 'hello-shoppable' ),
			'show_in_frontpage'    => esc_html__( 'Show in Frontpage only', 'hello-shoppable' ),
		),
		'priority'	   => 30,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Choose Image Size', 'hello-shoppable' ),
		'type'        => 'select',
		'settings'    => 'render_pages_image_size',
		'section'     => 'pages_options',
		'default'     => 'hello-shoppable-1370-550',
		'placeholder' => esc_html__( 'Select Image Size', 'hello-shoppable' ),
		'choices'     => hello_shoppable_get_intermediate_image_sizes(),
		'priority'	  => 40,
		'active_callback' => array(
			array(
				'setting'  => 'page_feature_image',
				'operator' => 'contains',
				'value'    => array( 'show_in_all_pages', 'show_in_frontpage', 'disable_in_frontpage' ),
			),
		),
	) );

	// Sidebar Options
	Kirki::add_section( 'sidebar_options', array(
	    'title'          => esc_html__( 'Sidebar', 'hello-shoppable' ),
	    'capability'     => 'edit_theme_options',
	    'panel'			 => 'general_options',
	    'priority'       => 35,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Sidebar Layouts', 'hello-shoppable' ),
		'type'        => 'radio-buttonset',
		'settings'    => 'sidebar_settings',
		'section'     => 'sidebar_options',
		'default'     => 'right',
		'priority'	  => 10,
		'choices'  => array(
			'right'      => esc_html__( 'Right', 'hello-shoppable' ),
			'left'       => esc_html__( 'Left', 'hello-shoppable' ),
			'right-left' => esc_html__( 'Both', 'hello-shoppable' ),
			'no-sidebar' => esc_html__( 'None', 'hello-shoppable' ),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Sticky Position', 'hello-shoppable' ),
		'type'         => 'toggle',
		'settings'     => 'sticky_sidebar',
		'section'      => 'sidebar_options',
		'default'      => true,
		'priority'	   => 40,
		'active_callback' => array(
			array(
				'setting'  => 'sidebar_settings',
				'operator' => 'contains',
				'value'    => array( 'right', 'left', 'right-left' ),
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Blog Page Sidebar', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'sidebar_blog_page',
		'section'     => 'sidebar_options',
		'default'     => true,
		'priority'	  => 50,
		'active_callback' => array(
			array(
				'setting'  => 'sidebar_settings',
				'operator' => 'contains',
				'value'    => array( 'right', 'left', 'right-left' ),
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Single Post Sidebar', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'sidebar_single_post',
		'section'     => 'sidebar_options',
		'default'     => true,
		'priority'	  => 60,
		'active_callback' => array(
			array(
				'setting'  => 'sidebar_settings',
				'operator' => 'contains',
				'value'    => array( 'right', 'left', 'right-left' ),
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Page Sidebar', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'sidebar_page',
		'section'     => 'sidebar_options',
		'default'     => false,
		'priority'	  => 70,
		'active_callback' => array(
			array(
				'setting'  => 'sidebar_settings',
				'operator' => 'contains',
				'value'    => array( 'right', 'left', 'right-left' ),
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Widget Title Typography', 'hello-shoppable' ),
		'type'         => 'typography',
		'settings'     => 'sidebar_widget_title_font_control',
		'section'      => 'sidebar_options',
		'default'  => array(
			'font-family'     => 'Inter',
			'variant'         => '500',
			'font-style'      => 'normal',
			'font-size'       => '16px',
			'text-transform'  => 'uppercase',
			'line-height'     => '1.3',
			'letter-spacing'  => '0',
			'text-decoration' => 'none',
			'text-align'	  => '',
		),
		'priority'	  => 80,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.sidebar .widget .widget-title',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'sidebar_settings',
				'operator' => 'contains',
				'value'    => array( 'right', 'left', 'right-left' ),
			),
		),
	) );

	// Preloader Options
	Kirki::add_section( 'preloader_options', array(
	    'title'          => esc_html__( 'Preloader', 'hello-shoppable' ),
	    'capability'     => 'edit_theme_options',
	    'panel'			 => 'general_options',
	    'priority'       => 40,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Preloader', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'preloader',
		'section'     => 'preloader_options',
		'default'     => true,
		'priority'	  => 10,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Preloader Animations', 'hello-shoppable' ),
		'type'        => 'select',
		'settings'    => 'preloader_animation',
		'section'     => 'preloader_options',
		'default'     => 'animation_one',
		'choices'  => array(
			'animation_one'       => esc_html__( 'Animation One', 'hello-shoppable' ),
			'animation_two'       => esc_html__( 'Animation Two', 'hello-shoppable' ),
			'animation_three'     => esc_html__( 'Animation Three', 'hello-shoppable' ),
			'animation_four'      => esc_html__( 'Animation Four', 'hello-shoppable' ),
			'animation_five'      => esc_html__( 'Animation Five', 'hello-shoppable' ),
			'animation_six'       => esc_html__( 'Animation six', 'hello-shoppable' ),
			'animation_seven'     => esc_html__( 'Animation Seven', 'hello-shoppable' ),
			'animation_eight'     => esc_html__( 'Animation Eight', 'hello-shoppable' ),
			'animation_nine'      => esc_html__( 'Animation Nine', 'hello-shoppable' ),
			'animation_ten'       => esc_html__( 'Animation Ten', 'hello-shoppable' ),
			'animation_white'     => esc_html__( 'White Color to Fade', 'hello-shoppable' ),
			'animation_black'     => esc_html__( 'Black Color to Fade', 'hello-shoppable' ),
			'animation_site_logo' => esc_html__( 'Site Logo', 'hello-shoppable' ),
			'animation_custom'    => esc_html__( 'Custom Image Upload', 'hello-shoppable' ),
		),
		'priority'	   => 20,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Select Image', 'hello-shoppable' ),
		'type'         => 'image',
		'settings'     => 'preloader_custom_image',
		'section'      => 'preloader_options',
		'default'      => '',
		'choices'     => array(
			'save_as' => 'id',
		),
		'priority'	   => 30,
		'active_callback' => array(
			array(
				'setting'  => 'preloader_animation',
				'operator' => 'contains',
				'value'    => array( 'animation_custom' ),
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Image Width', 'hello-shoppable' ),
		'type'         => 'slider',
		'settings'     => 'preloader_custom_image_width',
		'section'      => 'preloader_options',
		'transport'    => 'postMessage',
		'default'      => 40,
		'choices'      => array(
			'min'  => 10,
			'max'  => 200,
			'step' => 1,
		),
		'priority'	   => 40,
		'active_callback' => array(
			array(
				'setting'  => 'preloader_animation',
				'operator' => 'contains',
				'value'    => array( 'animation_one', 'animation_two', 'animation_three', 'animation_four', 'animation_five', 'animation_six', 'animation_seven', 'animation_eight', 'animation_nine', 'animation_ten', 'animation_site_logo', 'animation_custom' ),
			),
		),
	) );

	// Breadcrumbs
	Kirki::add_section( 'breadcrumbs_options', array(
	    'title'          => esc_html__( 'Breadcrumbs', 'hello-shoppable' ),
	    'capability'     => 'edit_theme_options',
	    'panel'			 => 'general_options',
	    'priority'       => 50,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Breadcrumbs', 'hello-shoppable' ),
		'type'        => 'select',
		'settings'    => 'breadcrumbs_controls',
		'section'     => 'breadcrumbs_options',
		'default'     => 'disable_in_all_page_post',
		'choices'  => array(
			'disable_in_all_pages'     => esc_html__( 'Disable in all Pages Only', 'hello-shoppable' ),
			'disable_in_all_page_post' => esc_html__( 'Disable in all Pages & Posts', 'hello-shoppable' ),
			'show_in_all_page_post'    => esc_html__( 'Show in all Pages & Posts', 'hello-shoppable' ),
		),
		'priority'	   => 10,
	) );

	// Scroll Top
	Kirki::add_section( 'scroll_top_options', array(
	    'title'          => esc_html__( 'Scroll to Top', 'hello-shoppable' ),
	    'capability'     => 'edit_theme_options',
	    'panel'			 => 'general_options',
	    'priority'       => 60,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Scroll to Top', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'scroll_top',
		'section'     => 'scroll_top_options',
		'default'     => true,
		'priority'	  => 10,
	) );

	// Responsive
	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'scroll_top_responsive_separator',
	    'section'     => 'scroll_top_options',
	    'default'     => esc_html__( 'Responsive', 'hello-shoppable' ),
	    'priority'	  => 15,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Scroll to Top', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'mobile_scroll_top',
		'section'     => 'scroll_top_options',
		'default'     => false,
		'priority'	  => 20,
		'active_callback' => array(
			array(
				'setting'  => 'scroll_top',
				'operator' => '=',
				'value'    => true,
			),
		),
	) );

	// General Buttons
	Kirki::add_section( 'general_buttons_options', array(
	    'title'          => esc_html__( 'Buttons', 'hello-shoppable' ),
	    'capability'     => 'edit_theme_options',
	    'panel'			 => 'general_options',
	    'priority'       => 80,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Colors', 'hello-shoppable' ),
		'type'        => 'radio-buttonset',
		'settings'    => 'general_button_controls',
		'section'     => 'general_buttons_options',
		'default'     => 'normal',
		'choices'  => array(
			'normal' 			=> esc_html__( 'Normal', 'hello-shoppable' ),
			'hover' 			=> esc_html__( 'Hover', 'hello-shoppable' ),
		),
		'priority'	  => 10,
		'transport'   => 'postMessage',
	) );

	new \Kirki\Field\Color(
		[
			'settings'    => 'general_button_text_color',
			'label'       => esc_html__( 'Text Color', 'hello-shoppable' ),
			'section'     => 'general_buttons_options',
			'default'     => '#FFFFFF',
			'priority'	  => 20,
			'choices'	   => array(
				'alpha'		=> true,
			),
			'active_callback'	=> [
				[
					'setting'  => 'general_button_controls',
					'operator' => '==',
					'value'    => 'normal',
				],
			],
		]
	);

	new \Kirki\Field\Color(
		[
			'settings'    => 'general_button_bg_color',
			'label'       => esc_html__( 'Background Color', 'hello-shoppable' ),
			'section'     => 'general_buttons_options',
			'default'     => '#333333',
			'priority'	  => 30,
			'choices'	   => array(
				'alpha'		=> true,
			),
			'active_callback'	=> [
				[
					'setting'  => 'general_button_controls',
					'operator' => '==',
					'value'    => 'normal',
				],
			],
		]
	);

	new \Kirki\Field\Color(
		[
			'settings'    => 'general_button_border_color',
			'label'       => esc_html__( 'Border Color', 'hello-shoppable' ),
			'section'     => 'general_buttons_options',
			'default'     => '',
			'priority'	  => 40,
			'choices'	   => array(
				'alpha'		=> true,
			),
			'active_callback'	=> [
				[
					'setting'  => 'general_button_controls',
					'operator' => '==',
					'value'    => 'normal',
				],
			],
		]
	);

	new \Kirki\Field\Color(
		[
			'settings'    => 'general_button_text_hover_color',
			'label'       => esc_html__( 'Text Hover Color', 'hello-shoppable' ),
			'section'     => 'general_buttons_options',
			'default'     => '#ffffff',
			'priority'	  => 50,
			'choices'	   => array(
				'alpha'		=> true,
			),
			'active_callback'	=> [
				[
					'setting'  => 'general_button_controls',
					'operator' => '==',
					'value'    => 'hover',
				],
			],
		]
	);

	new \Kirki\Field\Color(
		[
			'settings'    => 'general_button_bg_hover_color',
			'label'       => esc_html__( 'Background Hover Color', 'hello-shoppable' ),
			'section'     => 'general_buttons_options',
			'default'     => '#2154ac',
			'priority'	  => 60,
			'choices'	   => array(
				'alpha'		=> true,
			),
			'active_callback'	=> [
				[
					'setting'  => 'general_button_controls',
					'operator' => '==',
					'value'    => 'hover',
				],
			],
		]
	);

	new \Kirki\Field\Color(
		[
			'settings'    => 'general_button_border_hover_color',
			'label'       => esc_html__( 'Border Hover Color', 'hello-shoppable' ),
			'section'     => 'general_buttons_options',
			'default'     => '#2154ac',
			'priority'	  => 70,
			'choices'	   => array(
				'alpha'		=> true,
			),
			'active_callback'	=> [
				[
					'setting'  => 'general_button_controls',
					'operator' => '==',
					'value'    => 'hover',
				],
			],
		]
	);

	new \Kirki\Field\Slider(
		[
			'settings'    => 'general_button_border_width',
			'label'       => esc_html__( 'Border Width (in px)', 'hello-shoppable' ),
			'section'     => 'general_buttons_options',
			'default'     => 0,
			'choices'     => [
				'min'  => 0,
				'max'  => 5,
				'step' => 1,
			],
			'priority'    => 80,
		]
	);

	new \Kirki\Field\Slider(
		[
			'settings'    => 'general_button_radius',
			'label'       => esc_html__( 'Border Radius', 'hello-shoppable' ),
			'section'     => 'general_buttons_options',
			'default'     => 0,
			'choices'     => [
				'min'  => 0,
				'max'  => 100,
				'step' => 1,
			],
			'priority'    => 80,
		]
	);

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'general_button_radius_border',
	    'section'     => 'general_buttons_options',
	    'default'  => wp_kses( '<hr class="customizer_separator">', array(
			    'hr' => array(
			      'class' => array(),
			    ),
		  	)
		),
	    'priority'	  => 100,
	) );

	new \Kirki\Field\Typography(
		[
			'settings'    => 'general_button_typography',
			'label'       => esc_html__( 'Button Text Typography', 'hello-shoppable' ),
			'section'     => 'general_buttons_options',
			'priority'    => 110,
			'transport'   => 'auto',
			'default'     => [
				'font-family'     => 'Inter',
				'variant'         => 'regular',
				'font-style'      => 'normal',
				'font-size'       => '15px',
				'line-height'     => '1.6',
				'letter-spacing'  => '0',
				'text-transform'  => 'none',
				'text-decoration' => 'none',
				'text-align'      => '',
			],
			'output'   => array(
				array(
						'element' 	=> array('input[type="button"]',
					   	'input[type="reset"]',
				      	'input[type="submit"]',
				      	'.button-primary',
				      	'.widget.widget_search .wp-block-search__button',
				      	'.wp-block-search__button'
					)
				)
			),
		]
	);

	// Header Options
	Kirki::add_panel( 'header_options', array(
	    'title' => esc_html__( 'Header', 'hello-shoppable' ),
	    'priority' => 35,
	) );

	// Site Identity - Title & Tagline
	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Logo Image Width', 'hello-shoppable' ),
		'type'         => 'slider',
		'settings'     => 'logo_width',
		'section'      => 'title_tagline',
		'transport'    => 'postMessage',
		'priority'     => '8',
		'default'      => 270,
		'choices'      => array(
			'min'  => 50,
			'max'  => 270,
			'step' => 5,
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Site Title', 'hello-shoppable' ),
		'type'         => 'toggle',
		'settings'     => 'site_title',
		'section'      => 'title_tagline',
		'priority'     => 9,
		'default'      => true,
	) ); 

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Site Tagline', 'hello-shoppable' ),
		'type'         => 'toggle',
		'settings'     => 'site_tagline',
		'section'      => 'title_tagline',
		'priority'     => 11,
		'default'      => true,
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'title_tagline_color_border',
	    'section'     => 'title_tagline',
	    'default'     => wp_kses_post( '<hr class="customizer_separator">' ),
	    'priority'	  => 33,
	    'active_callback' => array(
			array(
				array(
					'setting'  => 'site_title',
					'operator' => '==',
					'value'    => true,
				),
				array(
					'setting'  => 'site_tagline',
					'operator' => '==',
					'value'    => true,
				),
			),	
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'title_tagline_color_separator',
	    'section'     => 'title_tagline',
	    'default'  	  => wp_kses_post(
	    	'<div class="customizer_separator_title">'.esc_html__( 'Colors', 'hello-shoppable' ).'</div>'
	    ),
	    'priority'	  => 33,
	    'active_callback' => array(
			array(
				array(
					'setting'  => 'site_title',
					'operator' => '==',
					'value'    => true,
				),
				array(
					'setting'  => 'site_tagline',
					'operator' => '==',
					'value'    => true,
				),
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Site Title Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'site_title_color',
		'section'      => 'title_tagline',
		'default'      => '#030303',
		'priority'	   => 35,
		'transport'	   => 'auto',
		'choices'	   => array(
			'alpha'		=> true,
		),	
		'active_callback' => array(
			array(
				'setting'  => 'site_title',
				'operator' => '==',
				'value'    => true,
			),
		),
		'output'      => array(
			array(
				'element' => '.site-branding .site-title',
				'property' => 'color',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Site Tagline Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'site_tagline_color',
		'section'      => 'title_tagline',
		'default'      => '#767676',
		'priority'	   => 40,
		'transport'	   => 'auto',
		'choices'	   => array(
			'alpha'		=> true,
		),	
		'active_callback' => array(
			array(
				'setting'  => 'site_tagline',
				'operator' => '==',
				'value'    => true,
			),
		),
		'output'      => array(
			array(
				'element' => '.site-branding .site-description',
				'property' => 'color',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'title_typography_border',
	    'section'     => 'title_tagline',
	    'default'     => wp_kses_post( '<hr class="customizer_separator">' ),
	    'priority'	  => 42,
	    'active_callback' => array(
			array(
				array(
					'setting'  => 'site_title',
					'operator' => '==',
					'value'    => true,
				),
				array(
					'setting'  => 'site_tagline',
					'operator' => '==',
					'value'    => true,
				),
			),	
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Site Title Typography', 'hello-shoppable' ),
		'type'         => 'typography',
		'settings'     => 'site_title_font_control',
		'section'      => 'title_tagline',
		'default'  => array(
			'font-family'     => 'Inter',
			'variant'         => '600',
			'font-style'      => 'normal',
			'font-size'       => '22px',
			'line-height'     => '1',
			'letter-spacing'  => '0',
			'text-transform'  => 'none',
			'text-decoration' => 'none',
			'text-align'      => '',	
			
		),
		'priority'	  => 45,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.site-branding .site-title',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'site_title',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'site_description_space',
	    'section'     => 'title_tagline',
	    'default'     => wp_kses_post( '<span class="typography_spacer"></span>' ),
	    'priority'	  => 47,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Site Tagline Typography', 'hello-shoppable' ),
		'type'         => 'typography',
		'settings'     => 'site_description_font_control',
		'section'      => 'title_tagline',
		'default'  => array(
			'font-family'     => 'Inter',
			'variant'         => 'regular',
			'font-style'      => 'normal',
			'font-size'       => '14px',
			'line-height'     => '1.1',
			'letter-spacing'  => '0',
			'text-transform'  => 'none',
			'text-decoration' => 'none',
			'text-align'      => '',
		),
		'priority'	  => 50,
		'transport'   => 'auto',
		'output'   => array(
			array(
				'element' => '.site-branding .site-description',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'site_tagline',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	// Top Bar Options
	Kirki::add_section( 'top_bar_options', array(
	    'title'      => esc_html__( 'Top Bar', 'hello-shoppable' ),
	    'panel'      => 'header_options',	   
	    'capability' => 'edit_theme_options',
	    'priority'   => 25,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'type'        => 'radio-buttonset',
		'settings'    => 'top_bar_tab',
		'section'     => 'top_bar_options',
		'default'     => 'top_bar_general_tab',
		'choices'  => array(
			'top_bar_general_tab'     => esc_html__( 'General', 'hello-shoppable' ),
			'top_bar_style_tab'     	=> esc_html__( 'Style', 'hello-shoppable' ),
		),
		'transport'	   => 'postMessage',
		'priority'	   => 10,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Top Bar', 'hello-shoppable' ),
		'type'         => 'toggle',
		'settings'     => 'top_header_section',
		'section'      => 'top_bar_options',
		'default'      => true,
		'priority'	   => 15,
		'active_callback' => array(
			array(
				'setting'  => 'top_bar_tab',
				'operator' => '==',
				'value'    => 'top_bar_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Top Bar Elements', 'hello-shoppable' ),
		'type'         => 'sortable',
		'settings'     => 'top_bar_sortable',
		'section'      => 'top_bar_options',
		'default'      => '',
		'priority'	   => 20,
		'choices'      => apply_filters( 'hello_shoppable_header_sortable_filter', array(
			'hello_shoppable_top_bar_menu' 	=> esc_html__( 'Top Bar Menu', 'hello-shoppable' ),
			'header_contact_info' 			=> esc_html__( 'Contact Info', 'hello-shoppable' ),
			'hello_shoppable_top_bar_text' 	=> esc_html__( 'Advertisement Text', 'hello-shoppable' ),
			'hello_shoppable_social' 		=> esc_html__( 'Social Profiles', 'hello-shoppable' ),
		) ),
		'active_callback' => array(
			array(
				'setting'  => 'top_bar_tab',
				'operator' => '==',
				'value'    => 'top_bar_general_tab',
			),
		),
	) );

	// Contact Info Options
	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'contact_details_separator',
	    'section'     => 'top_bar_options',
	    'default'     => esc_html__( 'Contact Info Options', 'hello-shoppable' ),
	    'priority'	   => 30,
	    'active_callback' => array(
	    	array(
				'setting'  => 'top_bar_tab',
				'operator' => '==',
				'value'    => 'top_bar_general_tab',
			),
			array(
				'setting'  => 'top_bar_sortable',
				'operator' => 'contains',
				'value'    => array( 'header_contact_info' ),
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Phone Number', 'hello-shoppable' ),
		'type'         => 'toggle',
		'settings'     => 'enable_contact_phone',
		'section'      => 'top_bar_options',
		'default'      => false,
		'priority'	   => 35,
		'active_callback' => array(
			array(
				'setting'  => 'top_bar_tab',
				'operator' => '==',
				'value'    => 'top_bar_general_tab',
			),
			array(
				'setting'  => 'top_bar_sortable',
				'operator' => 'contains',
				'value'    => array( 'header_contact_info' ),
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Phone Number', 'hello-shoppable' ),
		'type'         => 'text',
		'settings'     => 'contact_phone',
		'section'      => 'top_bar_options',
		'default'      => '',
		'priority'	   => 40,
		'transport'	   => 'postMessage',
		'active_callback' => array(
			array(
				'setting'  => 'top_bar_tab',
				'operator' => '==',
				'value'    => 'top_bar_general_tab',
			),
			array(
				'setting'  => 'top_bar_sortable',
				'operator' => 'contains',
				'value'    => array( 'header_contact_info' ),
			),
			array(
				'setting'  => 'enable_contact_phone',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Email', 'hello-shoppable' ),
		'type'         => 'toggle',
		'settings'     => 'enable_contact_email',
		'section'      => 'top_bar_options',
		'default'      => false,
		'priority'	   => 45,
		'active_callback' => array(
			array(
				'setting'  => 'top_bar_tab',
				'operator' => '==',
				'value'    => 'top_bar_general_tab',
			),
			array(
				'setting'  => 'top_bar_sortable',
				'operator' => 'contains',
				'value'    => array( 'header_contact_info' ),
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Email', 'hello-shoppable' ),
		'type'         => 'text',
		'settings'     => 'contact_email',
		'section'      => 'top_bar_options',
		'default'      => '',
		'priority'	   => 50,
		'transport'	   => 'postMessage',
		'active_callback' => array(
			array(
				'setting'  => 'top_bar_tab',
				'operator' => '==',
				'value'    => 'top_bar_general_tab',
			),
			array(
				'setting'  => 'top_bar_sortable',
				'operator' => 'contains',
				'value'    => array( 'header_contact_info' ),
			),
			array(
				'setting'  => 'enable_contact_email',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Address', 'hello-shoppable' ),
		'type'         => 'toggle',
		'settings'     => 'enable_contact_address',
		'section'      => 'top_bar_options',
		'default'      => false,
		'priority'	   => 55,
		'active_callback' => array(
			array(
				'setting'  => 'top_bar_tab',
				'operator' => '==',
				'value'    => 'top_bar_general_tab',
			),
			array(
				'setting'  => 'top_bar_sortable',
				'operator' => 'contains',
				'value'    => array( 'header_contact_info' ),
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Address', 'hello-shoppable' ),
		'type'         => 'text',
		'settings'     => 'contact_address',
		'section'      => 'top_bar_options',
		'default'      => '',
		'priority'	   => 60,
		'transport'	   => 'postMessage',
		'active_callback' => array(
			array(
				'setting'  => 'top_bar_tab',
				'operator' => '==',
				'value'    => 'top_bar_general_tab',
			),
			array(
				'setting'  => 'top_bar_sortable',
				'operator' => 'contains',
				'value'    => array( 'header_contact_info' ),
			),
			array(
				'setting'  => 'enable_contact_address',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	// Top Bar Text Options
	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'topbar_text_separator',
	    'section'     => 'top_bar_options',
	    'default'     => esc_html__( 'Advertisement Text Options', 'hello-shoppable' ),
	    'priority'	   => 65,
	    'active_callback' => array(
	    	array(
				'setting'  => 'top_bar_tab',
				'operator' => '==',
				'value'    => 'top_bar_general_tab',
			),
			array(
				'setting'  => 'top_bar_sortable',
				'operator' => 'contains',
				'value'    => array( 'hello_shoppable_top_bar_text' ),
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Advertisement Text', 'hello-shoppable' ),
		'type'         => 'toggle',
		'settings'     => 'enable_top_bar_text',
		'section'      => 'top_bar_options',
		'default'      => false,
		'priority'	   => 67,
		'active_callback' => array(
			array(
				'setting'  => 'top_bar_tab',
				'operator' => '==',
				'value'    => 'top_bar_general_tab',
			),
			array(
				'setting'  => 'top_bar_sortable',
				'operator' => 'contains',
				'value'    => array( 'hello_shoppable_top_bar_text' ),
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Advertisement Text', 'hello-shoppable' ),
		'type'         => 'textarea',
		'settings'     => 'top_bar_text',
		'section'      => 'top_bar_options',
		'default'      => '',
		'priority'	   => 70,
		'transport'	   => 'postMessage',
		'active_callback' => array(
			array(
				'setting'  => 'top_bar_tab',
				'operator' => '==',
				'value'    => 'top_bar_general_tab',
			),
			array(
				'setting'  => 'top_bar_sortable',
				'operator' => 'contains',
				'value'    => array( 'hello_shoppable_top_bar_text' ),
			),
			array(
				'setting'  => 'enable_top_bar_text',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Button', 'hello-shoppable' ),
		'type'         => 'toggle',
		'settings'     => 'enable_top_bar_button',
		'section'      => 'top_bar_options',
		'default'      => false,
		'priority'	   => 71,
		'active_callback' => array(
			array(
				'setting'  => 'top_bar_tab',
				'operator' => '==',
				'value'    => 'top_bar_general_tab',
			),
			array(
				'setting'  => 'top_bar_sortable',
				'operator' => 'contains',
				'value'    => array( 'hello_shoppable_top_bar_text' ),
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Button Text', 'hello-shoppable' ),
		'type'         => 'text',
		'settings'     => 'top_bar_button_text',
		'section'      => 'top_bar_options',
		'default'      => '',
		'priority'	   => 72,
		'transport'	   => 'postMessage',
		'active_callback' => array(
			array(
				'setting'  => 'top_bar_tab',
				'operator' => '==',
				'value'    => 'top_bar_general_tab',
			),
			array(
				'setting'  => 'top_bar_sortable',
				'operator' => 'contains',
				'value'    => array( 'hello_shoppable_top_bar_text' ),
			),
			array(
				'setting'  => 'enable_top_bar_button',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Button Link', 'hello-shoppable' ),
		'type'         => 'text',
		'settings'     => 'top_bar_button_link',
		'section'      => 'top_bar_options',
		'default'      => '',
		'priority'	   => 73,
		'active_callback' => array(
			array(
				'setting'  => 'top_bar_tab',
				'operator' => '==',
				'value'    => 'top_bar_general_tab',
			),
			array(
				'setting'  => 'top_bar_sortable',
				'operator' => 'contains',
				'value'    => array( 'hello_shoppable_top_bar_text' ),
			),
			array(
				'setting'  => 'enable_top_bar_button',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Open in New Window', 'hello-shoppable' ),
		'description' => esc_html__( 'If enabled, the link will be open in an another browser window.', 'hello-shoppable' ),
		'type'         => 'toggle',
		'settings'     => 'top_bar_button_target',
		'section'      => 'top_bar_options',
		'default'      => true,
		'priority'	   => 74,
		'active_callback' => array(
			array(
				'setting'  => 'top_bar_tab',
				'operator' => '==',
				'value'    => 'top_bar_general_tab',
			),
			array(
				'setting'  => 'top_bar_sortable',
				'operator' => 'contains',
				'value'    => array( 'hello_shoppable_top_bar_text' ),
			),
			array(
				'setting'  => 'enable_top_bar_button',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	// Social Profile Options
	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'topbar_social_separator',
	    'section'     => 'top_bar_options',
	    'default'     => esc_html__( 'Social Profiles Options', 'hello-shoppable' ),
	    'priority'	   => 75,
	    'active_callback' => array(
	    	array(
				'setting'  => 'top_bar_tab',
				'operator' => '==',
				'value'    => 'top_bar_general_tab',
			),
			array(
				'setting'  => 'top_bar_sortable',
				'operator' => 'contains',
				'value'    => array( 'hello_shoppable_social' ),
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Social Profiles', 'hello-shoppable' ),
		'type'        => 'repeater',
		'section'     => 'top_bar_options',
		'row_label' => array(
			'type'  => 'text',
			'value' => esc_html__( 'Social Profile', 'hello-shoppable' ),
		),
		'settings' => 'social_media_links',
		'default' => array(
			array(
				'icon' 		=> '',
				'link' 		=> '',
				'target' 	=> true,
				),		
		),
		'priority'	  => 80,
		'fields' => array(
			'icon' => array(
				'label'       => esc_html__( 'Fontawesome Icon', 'hello-shoppable' ),
				'type'        => 'text',
				'description' => esc_html__( 'Input Icon name. For Example:- fab fa-facebook For more icons https://fontawesome.com/icons?d=gallery&m=free', 'hello-shoppable' ),
			),
			'link' => array(
				'label'       => esc_html__( 'Link', 'hello-shoppable' ),
				'type'        => 'text',
			),
			'target' => array(
				'label'       => esc_html__( 'Open Link in New Window', 'hello-shoppable' ),
				'type'        => 'checkbox',
				'default' 	  => true,
			),			
		),
		'choices' => array(
			'limit' => 20,
		),
		'active_callback' => array(
			array(
				'setting'  => 'top_bar_tab',
				'operator' => '==',
				'value'    => 'top_bar_general_tab',
			),
			array(
				'setting'  => 'top_bar_sortable',
				'operator' => 'contains',
				'value'    => array( 'hello_shoppable_social' ),
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'top_bar_colors_title',
	    'section'     => 'top_bar_options',
	    'default'  	  => wp_kses_post(
	    	'<div class="customizer_separator_title">'.esc_html__( 'Colors', 'hello-shoppable' ).'</div>'
	    ),
	    'priority'	  => 85,
	    'active_callback' => array(
			array(
				'setting'  => 'top_bar_tab',
				'operator' => '==',
				'value'    => 'top_bar_style_tab',
			),
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Background Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'top_header_background_color',
		'section'      => 'top_bar_options',
		'default'      => '',
		'priority'	   => 90,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'top_bar_tab',
				'operator' => '==',
				'value'    => 'top_bar_style_tab',
			),
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Text Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'top_header_text_color',
		'section'      => 'top_bar_options',
		'default'      => '#333333',
		'priority'	   => 95,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'top_bar_tab',
				'operator' => '==',
				'value'    => 'top_bar_style_tab',
			),
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Text Link Hover Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'top_header_text_link_hover_color',
		'section'      => 'top_bar_options',
		'default'      => '#2154ac',
		'priority'	   => 100,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'top_bar_tab',
				'operator' => '==',
				'value'    => 'top_bar_style_tab',
			),
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Section Border', 'hello-shoppable' ),
		'type'         => 'toggle',
		'settings'     => 'top_header_border',
		'section'      => 'top_bar_options',
		'default'      => false,
		'priority'	   => 105,
		'active_callback' => array(
			array(
				'setting'  => 'top_bar_tab',
				'operator' => '==',
				'value'    => 'top_bar_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Border Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'top_header_border_color',
		'section'      => 'top_bar_options',
		'default'      => '#F1F1F1',
		'priority'	   => 110,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'top_bar_tab',
				'operator' => '==',
				'value'    => 'top_bar_style_tab',
			),
			array(
				'setting'  => 'top_header_border',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'top_bar_advert_colors',
	    'section'     => 'top_bar_options',
	    'default'  	  => wp_kses_post(
	    	'<div class="customizer_separator_title">'.esc_html__( 'Advertisement Text Colors', 'hello-shoppable' ).'</div>'
	    ),
	    'priority'	  => 112,
	    'active_callback' => array(
			array(
				'setting'  => 'top_bar_tab',
				'operator' => '==',
				'value'    => 'top_bar_style_tab',
			),
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'top_bar_sortable',
				'operator' => 'contains',
				'value'    => array( 'hello_shoppable_top_bar_text' ),
			),
			array(
				array(
					'setting'  => 'enable_top_bar_text',
					'operator' => '==',
					'value'    => true,
				),
				array(
					'setting'  => 'enable_top_bar_button',
					'operator' => '==',
					'value'    => true,
				),
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Advertisement Text Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'top_bar_text_color',
		'section'      => 'top_bar_options',
		'default'      => '#717171',
		'priority'	   => 115,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'top_bar_tab',
				'operator' => '==',
				'value'    => 'top_bar_style_tab',
			),
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'enable_top_bar_text',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'top_bar_sortable',
				'operator' => 'contains',
				'value'    => array( 'hello_shoppable_top_bar_text' ),
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Advertisement Button Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'top_bar_link_color',
		'section'      => 'top_bar_options',
		'default'      => '#a6a6a6',
		'priority'	   => 120,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'top_bar_tab',
				'operator' => '==',
				'value'    => 'top_bar_style_tab',
			),
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'enable_top_bar_button',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'top_bar_sortable',
				'operator' => 'contains',
				'value'    => array( 'hello_shoppable_top_bar_text' ),
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'top_bar_typography_border',
	    'section'     => 'top_bar_options',
	    'default'     => wp_kses_post( '<hr class="customizer_separator">' ),
	    'priority'	  => 125,
	    'active_callback' => array(
			array(
				'setting'  => 'top_bar_tab',
				'operator' => '==',
				'value'    => 'top_bar_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Typography', 'hello-shoppable' ),
		'type'         => 'typography',
		'settings'     => 'top_bar_elements_font_control',
		'section'      => 'top_bar_options',
		'default'  => array(
			'font-family'     => 'Inter',
			'variant'         => '600',
			'font-style'      => 'normal',
			'font-size'       => '11px',
			'line-height'     => '1.3',
			'letter-spacing'  => '0',
			'text-transform'  => 'capitalize',
			'text-decoration' => 'none',
			'text-align'      => '',
		),
		'priority'	  => 130,
		'transport'   => 'auto',
		'output'   => array(
			array(
				'element' => array( '.header-navigation ul.menu li a', '.slicknav_menu .slicknav_nav li a', '.site-header .header-contact ul li a', '.site-header .header-contact ul li', '.site-header .header-text' )
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'top_bar_tab',
				'operator' => '==',
				'value'    => 'top_bar_style_tab',
			),
		),
	) );

	// Responsive
	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'top_bar_responsive_separator',
	    'section'     => 'top_bar_options',
	    'default'     => esc_html__( 'Responsive', 'hello-shoppable' ),
	    'priority'	  => 200,
	    'active_callback' => array(
			array(
				'setting'  => 'top_bar_tab',
				'operator' => '==',
				'value'    => 'top_bar_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Top Bar', 'hello-shoppable' ),
		'type'         => 'toggle',
		'settings'     => 'mobile_top_header',
		'section'      => 'top_bar_options',
		'default'      => true,
		'priority'	   => 210,
		'active_callback' => array(
			array(
				'setting'  => 'top_bar_tab',
				'operator' => '==',
				'value'    => 'top_bar_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(	
		'label'       => esc_html__( 'Top Bar Name', 'hello-shoppable' ),
		'type'        => 'text',
		'settings'    => 'top_bar_name',
		'section'     => 'top_bar_options',
		'default'     => esc_html__( 'TOP MENU', 'hello-shoppable' ),
		'priority'	  => 220,
		'active_callback' => array(
			array(
				'setting'  => 'top_bar_tab',
				'operator' => '==',
				'value'    => 'top_bar_general_tab',
			),
			array(
				'setting'  => 'mobile_top_header',
				'operator' => '=',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Top Header Section Border', 'hello-shoppable' ),
		'type'         => 'toggle',
		'settings'     => 'mobile_top_header_border',
		'section'      => 'top_bar_options',
		'default'      => true,
		'priority'	   => 225,
		'active_callback' => array(
			array(
				'setting'  => 'top_bar_tab',
				'operator' => '==',
				'value'    => 'top_bar_general_tab',
			),
			array(
				'setting'  => 'mobile_top_header',
				'operator' => '=',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Top Bar Menu', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'secondary_menu',
		'section'     => 'top_bar_options',
		'default'     => true,
		'priority'	  => 230,
		'active_callback' => array(
			array(
				'setting'  => 'top_bar_tab',
				'operator' => '==',
				'value'    => 'top_bar_general_tab',
			),
			array(
				'setting'  => 'mobile_top_header',
				'operator' => '=',
				'value'    => true,
			),
			array(
				'setting'  => 'top_bar_sortable',
				'operator' => 'contains',
				'value'    => array( 'hello_shoppable_top_bar_menu' ),
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Contact Info', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'mobile_contact_details',
		'section'     => 'top_bar_options',
		'default'     => true,
		'priority'	  => 240,
		'active_callback' => array(
			array(
				'setting'  => 'top_bar_tab',
				'operator' => '==',
				'value'    => 'top_bar_general_tab',
			),
			array(
				'setting'  => 'mobile_top_header',
				'operator' => '=',
				'value'    => true,
			),
			array(
				'setting'  => 'top_bar_sortable',
				'operator' => 'contains',
				'value'    => array( 'header_contact_info' ),
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Advertisement Text', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'mobile_top_bar_text',
		'section'     => 'top_bar_options',
		'default'     => true,
		'priority'	  => 250,
		'active_callback' => array(
			array(
				'setting'  => 'top_bar_tab',
				'operator' => '==',
				'value'    => 'top_bar_general_tab',
			),
			array(
				'setting'  => 'top_bar_sortable',
				'operator' => 'contains',
				'value'    => array( 'hello_shoppable_top_bar_text' ),
			),
			array(
				'setting'  => 'mobile_top_header',
				'operator' => '=',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Social Profiles', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'mobile_social_icons_header',
		'section'     => 'top_bar_options',
		'default'     => true,
		'priority'	  => 260,
		'active_callback' => array(
			array(
				'setting'  => 'top_bar_tab',
				'operator' => '==',
				'value'    => 'top_bar_general_tab',
			),
			array(
				'setting'  => 'mobile_top_header',
				'operator' => '=',
				'value'    => true,
			),
			array(
				'setting'  => 'top_bar_sortable',
				'operator' => 'contains',
				'value'    => array( 'hello_shoppable_social' ),
			),
		),
	) );

	// Header Style Options
	Kirki::add_section( 'header_style_options', array(
	    'title'      => esc_html__( 'Main Header', 'hello-shoppable' ),
	    'panel'      => 'header_options',	   
	    'capability' => 'edit_theme_options',
	    'priority'   => '30',
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'type'        => 'radio-buttonset',
		'settings'    => 'main_header_tab',
		'section'     => 'header_style_options',
		'default'     => 'header_general_tab',
		'choices'  => array(
			'header_general_tab'   => esc_html__( 'General', 'hello-shoppable' ),
			'header_style_tab'     => esc_html__( 'Style', 'hello-shoppable' ),
		),
		'transport'	   => 'postMessage',
		'priority'	   => 10,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Header Style', 'hello-shoppable' ),
		'description' => esc_html__( 'Select style & scroll below to change its options', 'hello-shoppable' ),
		'type'        => 'radio-image',
		'settings'    => 'header_layout',
		'section'     => 'header_style_options',
		'default'     => 'header_one',
		'choices'     => apply_filters( 'hello_shoppable_header_layout_filter', array(
			'header_one'    => array(
				'src' => get_template_directory_uri() . '/assets/images/header-layout-1.svg',
				'alt' => esc_html__( 'Header One', 'hello-shoppable' )
			),
			'header_two'    => array(
				'src' => get_template_directory_uri() . '/assets/images/header-layout-2.svg',
				'alt' => esc_html__('Header Two', 'hello-shoppable' )
			),
			'header_three'    => array(
				'src' => get_template_directory_uri() . '/assets/images/header-layout-3.svg',
				'alt' => esc_html__('Header Three', 'hello-shoppable' )
			),
			'header_four'    => array(
				'src' => get_template_directory_uri() . '/assets/images/header-layout-4.svg',
				'alt' => esc_html__('Header Four', 'hello-shoppable' )
			),
		) ),
		'priority'	  => 15,
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_general_tab',
			),
		),
	) );

	#Transparent Header
	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Transparent Header', 'hello-shoppable' ),
		'type'         => 'toggle',
		'settings'     => 'transparent_header',
		'section'      => 'header_style_options',
		'default'      => false,
		'priority'	   => 17,
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Apply Transparent Header To', 'hello-shoppable' ),
		'description' => esc_html__( 'Transparent header will be applied to selected options', 'hello-shoppable' ),
		'type'		  => 'select',
		'settings'    => 'transparent_header_select_setting',
		'section'     => 'header_style_options',
		'priority'	  => 18,
		'default'     => array(),
		'multiple'    => 20,
		'choices'     => array(
			'entire-site'		=> esc_html__( 'Entire Site', 'hello-shoppable' ),
			'page' 		  		=> esc_html__( 'Page', 'hello-shoppable' ),	
			'post'       		=> esc_html__( 'Post', 'hello-shoppable' ),
			'archive' 	  		=> esc_html__( 'Archive', 'hello-shoppable' ),
			'search'      		=> esc_html__( 'search', 'hello-shoppable' ),
			'404'      			=> esc_html__( '404 Error', 'hello-shoppable' ),
			'front-page'    	=> esc_html__( 'Front Page', 'hello-shoppable' ),
			'blog-page'    		=> esc_html__( 'Blog Page', 'hello-shoppable' ),
			'shop'    			=> esc_html__( 'Shop', 'hello-shoppable' ),
			'single-product'    => esc_html__( 'Single Product', 'hello-shoppable' ),
			'cart'   		 	=> esc_html__( 'Cart', 'hello-shoppable' ),
			'checkout'    		=> esc_html__( 'Checkout', 'hello-shoppable' ),
			'my-account'    	=> esc_html__( 'My Account', 'hello-shoppable' ),
			'yith-wishlist'    	=> esc_html__( 'YITH Wishlist', 'hello-shoppable' ),
		), 
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_general_tab',
			),
			array(
				'setting'  => 'transparent_header',
				'operator' => '==',
				'value'    => true,
			),
		),	
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Phone Detail', 'hello-shoppable' ),
		'type'         => 'toggle',
		'settings'     => 'mid_contact_phone_detail',
		'section'      => 'header_style_options',
		'default'      => false,
		'priority'	   => 20,
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_general_tab',
			),
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one' ),
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Phone Label', 'hello-shoppable' ),
		'type'         => 'text',
		'settings'     => 'mid_contact_phone_label',
		'section'      => 'header_style_options',
		'default'      => '',
		'priority'	   => 25,
		'transport'	   => 'postMessage',
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_general_tab',
			),
			array(
				'setting'  => 'mid_contact_phone_detail',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one' ),
			),
		),
	) );



	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Phone Number', 'hello-shoppable' ),
		'type'         => 'text',
		'settings'     => 'mid_contact_phone_number',
		'section'      => 'header_style_options',
		'default'      => '',
		'priority'	   => 26,
		'transport'	   => 'postMessage',
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_general_tab',
			),
			array(
				'setting'  => 'mid_contact_phone_detail',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one' ),
			),
		),
	) );

	// WooCommerce Cat Menu Options
	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Category Menu', 'hello-shoppable' ),
		'type'         => 'toggle',
		'settings'     => 'enable_header_woo_cat_menu',
		'section'      => 'header_style_options',
		'default'      => true,
		'priority'	   => 55,
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'    => esc_html__( 'Category Menu Label', 'hello-shoppable' ),
		'type'     => 'text',
		'settings' => 'header_woo_cat_menu_label',
		'section'  => 'header_style_options',
		'default'  => '',
		'priority' => 60,
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_general_tab',
			),
			array(
				'setting'  => 'enable_header_woo_cat_menu',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'    => esc_html__( 'WooCommerce Compare', 'hello-shoppable' ),
		'type'     => 'toggle',
		'settings' => 'woocommerce_compare',
		'section'  => 'header_style_options',
		'default'  => true,
		'priority' => 90,
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'    => esc_html__( 'WooCommerce Wishlist', 'hello-shoppable' ),
		'type'     => 'toggle',
		'settings' => 'woocommerce_wishlist',
		'section'  => 'header_style_options',
		'default'  => true,
		'priority' => 100,
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'    => esc_html__( 'WooCommerce My Account', 'hello-shoppable' ),
		'type'     => 'toggle',
		'settings' => 'woocommerce_account',
		'section'  => 'header_style_options',
		'default'  => true,
		'priority' => 110,
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_general_tab',
			),
		),
	) );

	new \Kirki\Field\Toggle(
      	[
		    'settings'    => 'header_account_popup_login',
		    'label'       => esc_html__( 'Open My Account in Popup', 'hello-shoppable' ),
		    'section'     => 'header_style_options',
		    'default'     => true,
		    'priority'    => 115,
	      	'active_callback' => [
	          	[
			      'setting'  => 'main_header_tab',
			      'operator' => '==',
			      'value'    => 'header_general_tab',
		       	],
		        [
		          'setting'  => 'woocommerce_account',
		          'operator' => '==',
		          'value'    => true,
		        ],
         	],
      	]
  	);

	Kirki::add_field( 'hello-shoppable', array(
		'label'    => esc_html__( 'WooCommerce Cart', 'hello-shoppable' ),
		'type'     => 'toggle',
		'settings' => 'woocommerce_cart',
		'section'  => 'header_style_options',
		'default'  => true,
		'priority' => 120,
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'    => esc_html__( 'Search', 'hello-shoppable' ),
		'type'     => 'toggle',
		'settings' => 'enable_search_icon',
		'section'  => 'header_style_options',
		'default'  => true,
		'priority' => 125,
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'header_banner_separator',
	    'section'     => 'header_style_options',
	    'default'     => esc_html__( 'Header Banner Options', 'hello-shoppable' ),
	    'priority'	  => 130,
	    'active_callback' => array(
	    	array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_general_tab',
			),
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_four' ),
			),
		),
	) );

	// Header advertisement banner
	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Advertisement Banner', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'header_advertisement_banner_button',
		'section'     => 'header_style_options',
		'default'     => true,
		'priority'	  => 132,
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_general_tab',
				),
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_four' ),
				),
			),
		) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Advertisement Banner', 'hello-shoppable' ),
		'description'  => esc_html__( 'Image dimensions 730 by 90 pixels is recommended.', 'hello-shoppable' ),
		'type'         => 'image',
		'settings'     => 'header_advertisement_banner',
		'section'      => 'header_style_options',
		'default'      => '',
		'choices'     => array(
			'save_as' => 'id',
		),
		'priority'	   => 133,
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_general_tab',
			),
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_four' ),
			),
			array(
				'setting'  => 'header_advertisement_banner_button',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Choose Image Size', 'hello-shoppable' ),
		'type'        => 'select',
		'settings'    => 'render_header_ad_image_size',
		'section'     => 'header_style_options',
		'default'     => 'hello-shoppable-730-90',
		'placeholder' => esc_html__( 'Select Image Size', 'hello-shoppable' ),
		'choices'     => hello_shoppable_get_intermediate_image_sizes(),
		'priority'	  => 134,
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_general_tab',
			),
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_four' ),
			),
			array(
				'setting'  => 'header_advertisement_banner_button',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	// Header advertisement banner link
	Kirki::add_field( 'hello-shoppable', array(
		'label'    => esc_html__( 'Advertisement Banner Link', 'hello-shoppable' ),
		'type'     => 'link',
		'settings' => 'header_advertisement_banner_link',
		'section'  => 'header_style_options',
		'default'  => '#',
		'priority' => 135,
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_general_tab',
			),
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_four' ),
			),
			array(
				'setting'  => 'header_advertisement_banner_button',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Open Link in New Window', 'hello-shoppable' ),
		'type'         => 'toggle',
		'settings'     => 'header_banner_target',
		'section'      => 'header_style_options',
		'default'      => true,
		'priority'	   => 136,
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_general_tab',
			),
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_four' ),
			),
			array(
				'setting'  => 'header_advertisement_banner_button',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'header_button_separator',
	    'section'     => 'header_style_options',
	    'default'     => esc_html__( 'Header Button Options', 'hello-shoppable' ),
	    'priority'	  => 140,
	    'active_callback' => array(
	    	array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_general_tab',
			),
		),
	) );

	// Header button
	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Button', 'hello-shoppable' ),
		'type'         => 'toggle',
		'settings'     => 'header_button',
		'section'      => 'header_style_options',
		'default'      => true,
		'priority'	   => 145,
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Text', 'hello-shoppable' ),
		'type'         => 'text',
		'settings'     => 'header_button_text',
		'section'      => 'header_style_options',
		'default'      => '',
		'priority'	   => 147,
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_general_tab',
			),
			array(
				'setting'  => 'header_button',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Link', 'hello-shoppable' ),
		'type'         => 'text',
		'settings'     => 'header_button_link',
		'section'      => 'header_style_options',
		'default'      => '',
		'priority'	   => 148,
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_general_tab',
			),
			array(
				'setting'  => 'header_button',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Open Link in New Window', 'hello-shoppable' ),
		'type'         => 'toggle',
		'settings'     => 'header_button_target',
		'section'      => 'header_style_options',
		'default'      => true,
		'priority'	   => 149,
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_general_tab',
			),
			array(
				'setting'  => 'header_button',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'header_media_separator',
	    'section'     => 'header_style_options',
	    'default'     => esc_html__( 'Header Media', 'hello-shoppable' ),
	    'priority'	  => 175,
	    'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_general_tab',
			),
		),
	) );

	// Header media options
	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Header Image Slider', 'hello-shoppable' ),
		'description' => esc_html__( 'Recommended image size 1920x550 pixel. Add only one image to make header banner.', 'hello-shoppable' ),
		'type'        => 'repeater',
		'section'     => 'header_style_options',
		'row_label' => array(
			'type'  => 'text',
		),
		'button_label' => esc_html__('Add New Image', 'hello-shoppable' ),
		'settings'     => 'header_image_slider',
		'default'      => array(
				array(
					'slider_item' 	=> '',
					)			
		),
		'fields' => array(
			'slider_item' => array(
				'label'       => esc_html__( 'Image', 'hello-shoppable' ),
				'type'        => 'image',
				'default'     => '',
				'choices'     => array(
					'save_as' => 'id',
				),
			)
		),
		'choices' => array(
			'limit' => 10,
		),
		'priority' => 180,
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Choose Image Size', 'hello-shoppable' ),
		'type'        => 'select',
		'settings'    => 'render_header_image_size',
		'section'     => 'header_style_options',
		'default'     => 'full',
		'placeholder' => esc_html__( 'Select Image Size', 'hello-shoppable' ),
		'choices'     => hello_shoppable_get_intermediate_image_sizes(),
		'priority'    => 185,
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Background Image Size', 'hello-shoppable' ),
		'type'         => 'radio-buttonset',
		'settings'     => 'header_image_size',
		'section'      => 'header_style_options',
		'default'      => 'cover',
		'choices'      => array(
			'cover'    => esc_html__( 'Cover', 'hello-shoppable' ),
			'pattern'  => esc_html__( 'Repeat', 'hello-shoppable' ),
			'norepeat' => esc_html__( 'No Repeat', 'hello-shoppable' ),
		),
		'priority'	   => 190,
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Slide Effect', 'hello-shoppable' ),
		'type'        => 'radio-buttonset',
		'settings'    => 'header_slider_effect',
		'section'     => 'header_style_options',
		'default'     => 'fade',
		'choices'  => array(
			'fade'             => esc_html__( 'Fade', 'hello-shoppable' ),
			'horizontal-slide' => esc_html__( 'Slide', 'hello-shoppable' ),
		),
		'priority'	  => 195,
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Fade Control Time ( in sec )', 'hello-shoppable' ),
		'type'         => 'number',
		'settings'     => 'slider_header_fade_control',
		'section'      => 'header_style_options',
		'default'      => 5,
		'choices' => array(
				'min' => '3',
				'max' => '60',
				'step'=> '1',
		),
		'priority'	   => 200,
		'active_callback' => array( 
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_general_tab',
			),
			array(
				'setting' => 'header_slider_effect',
				'operator' => '==',
				'value'	   => 'fade',
			), 
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Arrows', 'hello-shoppable' ),
		'type'         => 'toggle',
		'settings'     => 'header_slider_arrows',
		'section'      => 'header_style_options',
		'default'      => true,
		'priority'	   => 210,
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Dots', 'hello-shoppable' ),
		'type'         => 'toggle',
		'settings'     => 'header_slider_dots',
		'section'      => 'header_style_options',
		'default'      => true,
		'priority'	   => 220,
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Auto Play', 'hello-shoppable' ),
		'type'         => 'toggle',
		'settings'     => 'header_slider_autoplay',
		'section'      => 'header_style_options',
		'default'      => false,
		'priority'	   => 230,
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Auto Play Timeout ( in sec )', 'hello-shoppable' ),
		'type'         => 'number',
		'settings'     => 'slider_header_autoplay_speed',
		'section'      => 'header_style_options',
		'default'      => 4,
		'choices' => array(
				'min' => '1',
				'max' => '60',
				'step'=> '1',
		),
		'priority'	  => 240,
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_general_tab',
			),
			array(
				'setting'  => 'header_slider_autoplay',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	// Main header styles

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Header Full Width', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'enable_header_full_width',
		'section'     => 'header_style_options',
		'default'     => false,
		'priority'	  => 255,
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_style_tab',
			),
			array(
				'setting'  => 'site_layout',
				'operator' => 'contains',
				'value'    => array( 'default','extend' ),
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Header Height (in px)', 'hello-shoppable' ),
		'description' => esc_html__( 'This option will only apply to Desktop. Please click on below Desktop Icon to see changes. Automatically adjust by theme default in the responsive devices.
		', 'hello-shoppable' ),
		'type'        => 'slider',
		'settings'    => 'header_image_height',
		'section'     => 'header_style_options',
		'transport'   => 'postMessage',
		'default'     => 110,
		'choices'     => array(
			'min'  => 50,
			'max'  => 1200,
			'step' => 10,
		),
		'priority'	   => 260,
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Menu Alignment', 'hello-shoppable' ),
		'type'        => 'radio-buttonset',
		'settings'    => 'header_menu_alignment',
		'section'     => 'header_style_options',
		'default'     => 'left',
		'choices'     => array(
			'left'	 	=> esc_html__( 'Left', 'hello-shoppable' ),
			'center'  	=> esc_html__( 'Center', 'hello-shoppable' ),   
			'right'		=> esc_html__( 'Right', 'hello-shoppable' ),
		),
		'priority'	   => 262,
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'mid_header_color_border',
	    'section'     => 'header_style_options',
	    'default'     => wp_kses_post( '<hr class="customizer_separator">' ),
	    'priority'	  => 265,
	    'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_style_tab',
			),
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one', 'header_three', 'header_four' ),
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'mid_header_color_separator',
	    'section'     => 'header_style_options',
	    'default'  	  => wp_kses_post(
	    	'<div class="customizer_separator_title">'.esc_html__( 'Mid Header', 'hello-shoppable' ).'</div>'
	    ),
	    'priority'	  => 266,
	    'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_style_tab',
			),
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one', 'header_three', 'header_four' ),
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Background Color', 'hello-shoppable' ),
		'description'  => esc_html__( 'It can be used as a transparent background color over image.', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'mid_header_background_color',
		'section'      => 'header_style_options',
		'default'      => '',
		'priority'	   => 270,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_style_tab',
			),
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one', 'header_three', 'header_four' ),
			),
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Text Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'mid_header_text_color',
		'section'      => 'header_style_options',
		'default'      => '#333333',
		'priority'	   => 285,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_style_tab',
			),
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one', 'header_four'  ),
			),
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Text Link Hover Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'mid_header_text_link_hover_color',
		'section'      => 'header_style_options',
		'default'      => '#2154ac',
		'priority'	   => 290,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_style_tab',
			),
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one', 'header_three','header_four' ),
			),
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Section Border', 'hello-shoppable' ),
		'type'         => 'toggle',
		'settings'     => 'mid_header_border',
		'section'      => 'header_style_options',
		'default'      => true,
		'priority'	   => 300,
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_style_tab',
			),
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one', 'header_three', 'header_four' ),
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Border Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'mid_header_border_color',
		'section'      => 'header_style_options',
		'default'      => '#F1F1F1',
		'priority'	   => 301,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_style_tab',
			),
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one', 'header_three', 'header_four' ),
			),
			array(
				'setting'  => 'mid_header_border',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'bottom_header_color_border',
	    'section'     => 'header_style_options',
	    'default'     => wp_kses_post( '<hr class="customizer_separator">' ),
	    'priority'	  => 305,
	    'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_style_tab',
			),
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'bottom_header_color_separator',
	    'section'     => 'header_style_options',
	    'default'  	  => wp_kses_post(
	    	'<div class="customizer_separator_title">'.esc_html__( 'Bottom Header', 'hello-shoppable' ).'</div>'
	    ),
	    'priority'	  => 306,
	    'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_style_tab',
			),
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Background Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'bottom_header_background_color',
		'section'      => 'header_style_options',
		'default'      => '',
		'priority'	   => 310,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_style_tab',
			),
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Text Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'bottom_header_text_color',
		'section'      => 'header_style_options',
		'default'      => '#333333',
		'priority'	   => 315,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_style_tab',
			),
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Menu Active Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'header_menu_active_color',
		'section'      => 'header_style_options',
		'default'      => '#2154ac',
		'priority'	   => 320,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_style_tab',
			),
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );


	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Text Hover Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'bottom_header_text_link_hover_color',
		'section'      => 'header_style_options',
		'default'      => '#2154ac',
		'priority'	   => 325,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_style_tab',
			),
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Sub Menu Link Hover Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'sub_menu_link_hover_color',
		'section'      => 'header_style_options',
		'default'      => '#2154ac',
		'priority'	   => 330,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_style_tab',
			),
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'header_cart_border',
	    'section'     => 'header_style_options',
	    'default'     => wp_kses_post( '<hr class="customizer_separator">' ),
	    'priority'	  => 332,
	    'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_style_tab',
			),
			array(
				'setting'  => 'woocommerce_cart',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'header_cart_colors',
	    'section'     => 'header_style_options',
	    'default'  	  => wp_kses_post(
	    	'<div class="customizer_separator_title">'.esc_html__( 'WooCommerce Cart Colors', 'hello-shoppable' ).'</div>'
	    ),
	    'priority'	  => 333,
	    'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_style_tab',
			),
			array(
				'setting'  => 'woocommerce_cart',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Background Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'cart_count_bg_color',
		'section'      => 'header_style_options',
		'default'      => '#EB5A3E',
		'priority'	   => 334,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_style_tab',
			),
			array(
				'setting'  => 'woocommerce_cart',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Text Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'cart_count_color',
		'section'      => 'header_style_options',
		'default'      => '#ffffff',
		'priority'	   => 335,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_style_tab',
			),
			array(
				'setting'  => 'woocommerce_cart',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'header_search_form_border',
	    'section'     => 'header_style_options',
	    'default'     => wp_kses_post( '<hr class="customizer_separator">' ),
	    'priority'	  => 336,
	    'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_style_tab',
			),
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one', 'header_four' ),
			),
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'header_search_form_colors',
	    'section'     => 'header_style_options',
	    'default'  	  => wp_kses_post(
	    	'<div class="customizer_separator_title">'.esc_html__( 'Search Form Colors', 'hello-shoppable' ).'</div>'
	    ),
	    'priority'	  => 336,
	    'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_style_tab',
			),
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one', 'header_four' ),
			),
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Background Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'header_search_bg_color',
		'section'      => 'header_style_options',
		'default'      => '#F8F8F8',
		'priority'	   => 336,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_style_tab',
			),
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one', 'header_four' ),
			),
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Placeholder Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'header_search_placeholder_color',
		'section'      => 'header_style_options',
		'default'      => '',
		'priority'	   => 337,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_style_tab',
			),
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one', 'header_four' ),
			),
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Text Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'header_search_text_color',
		'section'      => 'header_style_options',
		'default'      => '',
		'priority'	   => 338,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_style_tab',
			),
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one', 'header_four' ),
			),
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Border Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'header_search_border_color',
		'section'      => 'header_style_options',
		'default'      => '',
		'priority'     => 338,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_style_tab',
			),
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_one', 'header_four' ),
			),
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'header_cat_menu_border',
	    'section'     => 'header_style_options',
	    'default'     => wp_kses_post( '<hr class="customizer_separator">' ),
	    'priority'	  => 340,
	    'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_style_tab',
			),
			array(
				'setting'  => 'enable_header_woo_cat_menu',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'header_cat_menu_style_title',
	    'section'     => 'header_style_options',
	    'default'  	  => wp_kses_post(
	    	'<div class="customizer_separator_title">'.esc_html__( 'Category Menu Button', 'hello-shoppable' ).'</div>'
	    ),
	    'priority'	  => 341,
	    'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_style_tab',
			),
			array(
				'setting'  => 'enable_header_woo_cat_menu',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	new \Kirki\Field\Toggle(
      	[
		    'settings'    => 'enable_header_cat_menu_width',
		    'label'       => esc_html__( 'Dropdown Width', 'hello-shoppable' ),
		    'section'     => 'header_style_options',
		    'default'     => false,
		    'priority'    => 341,
	      	'active_callback' => [
	          	[
			    	'setting'  => 'main_header_tab',
			    	'operator' => '==',
			    	'value'    => 'header_style_tab',
		       	],
		        [
		        	'setting'  => 'enable_header_woo_cat_menu',
					'operator' => '==',
					'value'    => true,
		        ],
         	],
      	]
  	);

  	new \Kirki\Field\Slider(
		[
			'settings'    => 'header_cat_menu_width',
			'label'       => esc_html__( 'Dropdown Width (in px)', 'hello-shoppable' ),
			'section'     => 'header_style_options',
			'default'     => 180,
			'choices'     => [
				'min'  => 180,
				'max'  => 500,
				'step' => 1,
			],
			'priority'    => 341,
			'active_callback' => [
	          	[
			    	'setting'  => 'main_header_tab',
			    	'operator' => '==',
			    	'value'    => 'header_style_tab',
		       	],
		        [
		        	'setting'  => 'enable_header_woo_cat_menu',
					'operator' => '==',
					'value'    => true,
		        ],
		        [
		        	'setting'  => 'enable_header_cat_menu_width',
					'operator' => '==',
					'value'    => true,
		        ],
         	],
		]
	);

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Colors', 'hello-shoppable' ),
		'type'        => 'radio-buttonset',
		'settings'    => 'header_cat_menu_controls',
		'section'     => 'header_style_options',
		'default'     => 'normal',
		'choices'  => array(
			'normal' 			=> esc_html__( 'Normal', 'hello-shoppable' ),
			'hover' 			=> esc_html__( 'Hover', 'hello-shoppable' ),
		),
		'priority'	  => 342,
		'transport'   => 'postMessage',
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_style_tab',
			),
			array(
				'setting'  => 'enable_header_woo_cat_menu',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Text Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'header_cat_menu_text_color',
		'section'      => 'header_style_options',
		'default'      => '',
		'priority'	   => 343,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_style_tab',
			),
			array(
				'setting'  => 'enable_header_woo_cat_menu',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'header_cat_menu_controls',
				'operator' => '==',
				'value'    => 'normal',
			),
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Background Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'header_cat_menu_bg_color',
		'section'      => 'header_style_options',
		'default'      => '',
		'priority'	   => 344,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_style_tab',
			),
			array(
				'setting'  => 'enable_header_woo_cat_menu',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'header_cat_menu_controls',
				'operator' => '==',
				'value'    => 'normal',
			),
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Border Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'header_cat_menu_border_color',
		'section'      => 'header_style_options',
		'default'      => '',
		'priority'	   => 345,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_style_tab',
			),
			array(
				'setting'  => 'enable_header_woo_cat_menu',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'header_cat_menu_controls',
				'operator' => '==',
				'value'    => 'normal',
			),
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Text Hover Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'header_cat_menu_text_hover_color',
		'section'      => 'header_style_options',
		'default'      => '',
		'priority'	   => 346,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_style_tab',
			),
			array(
				'setting'  => 'enable_header_woo_cat_menu',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'header_cat_menu_controls',
				'operator' => '==',
				'value'    => 'hover',
			),
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Background Hover Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'header_cat_menu_background_hover_color',
		'section'      => 'header_style_options',
		'default'      => '',
		'priority'	   => 347,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_style_tab',
			),
			array(
				'setting'  => 'enable_header_woo_cat_menu',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'header_cat_menu_controls',
				'operator' => '==',
				'value'    => 'hover',
			),
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Border Hover Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'header_cat_menu_border_hover_color',
		'section'      => 'header_style_options',
		'default'      => '',
		'priority'	   => 348,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_style_tab',
			),
			array(
				'setting'  => 'enable_header_woo_cat_menu',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'header_cat_menu_controls',
				'operator' => '==',
				'value'    => 'hover',
			),
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Border Width (in px)', 'hello-shoppable' ),
		'type'         => 'slider',
		'settings'     => 'header_cat_menu_border_width',
		'section'      => 'header_style_options',
		'default'      => 0,
		'priority'	   => 349,
		'choices'		=> array(
			'min'	=> 0,
			'max'	=> 5,
			'step'	=> 1,
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_style_tab',
			),
			array(
				'setting'  => 'enable_header_woo_cat_menu',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Border Radius (in px)', 'hello-shoppable' ),
		'type'         => 'slider',
		'settings'     => 'header_cat_menu_border_radius',
		'section'      => 'header_style_options',
		'default'      => 0,
		'priority'	   => 350,
		'choices'		=> array(
			'min'	=> 0,
			'max'	=> 100,
			'step'	=> 1,
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_style_tab',
			),
			array(
				'setting'  => 'enable_header_woo_cat_menu',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'header_button_border',
	    'section'     => 'header_style_options',
	    'default'     => wp_kses_post( '<hr class="customizer_separator">' ),
	    'priority'	  => 355,
	    'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_style_tab',
			),
			array(
				'setting'  => 'header_button',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'header_button_style_title',
	    'section'     => 'header_style_options',
	    'default'  	  => wp_kses_post(
	    	'<div class="customizer_separator_title">'.esc_html__( 'Header Button', 'hello-shoppable' ).'</div>'
	    ),
	    'priority'	  => 356,
	    'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_style_tab',
			),
			array(
				'setting'  => 'header_button',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Colors', 'hello-shoppable' ),
		'type'        => 'radio-buttonset',
		'settings'    => 'header_button_controls',
		'section'     => 'header_style_options',
		'default'     => 'normal',
		'choices'  => array(
			'normal' 			=> esc_html__( 'Normal', 'hello-shoppable' ),
			'hover' 			=> esc_html__( 'Hover', 'hello-shoppable' ),
		),
		'priority'	  => 357,
		'transport'   => 'postMessage',
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_style_tab',
			),
			array(
				'setting'  => 'header_button',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Text Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'header_button_text_color',
		'section'      => 'header_style_options',
		'default'      => '',
		'priority'	   => 358,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_style_tab',
			),
			array(
				'setting'  => 'header_button',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'header_button_controls',
				'operator' => '==',
				'value'    => 'normal',
			),
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Background Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'header_button_bg_color',
		'section'      => 'header_style_options',
		'default'      => '',
		'priority'	   => 360,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_style_tab',
			),
			array(
				'setting'  => 'header_button',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'header_button_controls',
				'operator' => '==',
				'value'    => 'normal',
			),
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Border Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'header_button_border_color',
		'section'      => 'header_style_options',
		'default'      => '',
		'priority'	   => 365,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_style_tab',
			),
			array(
				'setting'  => 'header_button',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'header_button_controls',
				'operator' => '==',
				'value'    => 'normal',
			),
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Text Hover Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'header_button_text_hover_color',
		'section'      => 'header_style_options',
		'default'      => '',
		'priority'	   => 370,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_style_tab',
			),
			array(
				'setting'  => 'header_button',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'header_button_controls',
				'operator' => '==',
				'value'    => 'hover',
			),
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Background Hover Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'header_button_background_hover_color',
		'section'      => 'header_style_options',
		'default'      => '',
		'priority'	   => 380,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_style_tab',
			),
			array(
				'setting'  => 'header_button',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'header_button_controls',
				'operator' => '==',
				'value'    => 'hover',
			),
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Border Hover Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'header_button_border_hover_color',
		'section'      => 'header_style_options',
		'default'      => '',
		'priority'	   => 385,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_style_tab',
			),
			array(
				'setting'  => 'header_button',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'header_button_controls',
				'operator' => '==',
				'value'    => 'hover',
			),
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Border Width (in px)', 'hello-shoppable' ),
		'type'         => 'slider',
		'settings'     => 'header_button_border_width',
		'section'      => 'header_style_options',
		'default'      => '',
		'priority'	   => 390,
		'choices'		=> array(
			'min'	=> 0,
			'max'	=> 5,
			'step'	=> 1,
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_style_tab',
			),
			array(
				'setting'  => 'header_button',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Border Radius (in px)', 'hello-shoppable' ),
		'type'         => 'slider',
		'settings'     => 'header_button_radius',
		'section'      => 'header_style_options',
		'default'      => '',
		'priority'	   => 395,
		'choices'		=> array(
			'min'	=> 0,
			'max'	=> 100,
			'step'	=> 1,
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_style_tab',
			),
			array(
				'setting'  => 'header_button',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'header_typography_color_border',
	    'section'     => 'header_style_options',
	    'default'  => wp_kses( '<hr class="customizer_separator">', array(
			    'hr' => array(
			      'class' => array(),
			    ),
		  	)
		),
	    'priority'	  => 400,
	    'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Header Buttons Typography', 'hello-shoppable' ),
		'type'         => 'typography',
		'settings'     => 'header_buttons_font_control',
		'section'      => 'header_style_options',
		'default'  => array(
			'font-family'     => 'Inter',
			'variant'         => '600',
			'font-style'      => 'normal',
			'font-size'       => '14px',
			'line-height'     => '1.6',
			'letter-spacing'  => '0',
			'text-transform'  => 'none',
			'text-decoration' => 'none',
			'text-align'      => '',
		),
		'priority'	  => 410,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.site-header .header-btn a',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_style_tab',
			),
			array(
				'setting'  => 'header_button',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'header_button_space',
	    'section'     => 'header_style_options',
	    'default'     => wp_kses_post( '<span class="typography_spacer"></span>' ),
	    'priority'	  => 420,
	    'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_style_tab',
			),
			array(
				'setting'  => 'header_button',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Main Menu Typography', 'hello-shoppable' ),
		'type'         => 'typography',
		'settings'     => 'main_menu_font_control',
		'section'      => 'header_style_options',
		'default'  => array(
			'font-family'     => 'Inter',
			'variant'         => '600',
			'font-style'      => 'normal',
			'font-size'       => '12px',
			'line-height'     => '1.5',
			'letter-spacing'  => '0',
			'text-transform'  => 'uppercase',
			'text-decoration' => 'none',
			'text-align'      => '',
		),
		'priority'	  => 430,
		'transport'   => 'auto',
		'output'   => array(
			array(
				'element' => array( '.main-navigation ul.menu li a', '.slicknav_menu .slicknav_nav li a' )
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'header_main_menu_space',
	    'section'     => 'header_style_options',
	    'default'     => wp_kses_post( '<span class="typography_spacer"></span>' ),
	    'priority'	  => 450,
	    'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Main Menu Description Typography', 'hello-shoppable' ),
		'type'         => 'typography',
		'settings'     => 'main_menu_description_font_control',
		'section'      => 'header_style_options',
		'default'  => array(
			'font-family'     => 'Inter',
			'variant'         => 'regular',
			'font-style'      => 'normal',
			'font-size'       => '11px',
			'line-height'     => '1.3',
			'letter-spacing'  => '0',
			'text-transform'  => 'none',
			'text-decoration' => 'none',
			'text-align'      => '',
		),
		'priority'	  => 460,
		'transport'   => 'auto',
		'output'   => array(
			array(
				'element' => array( '.main-navigation .menu-description, .slicknav_menu .menu-description' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'header_menu_description_space',
	    'section'     => 'header_style_options',
	    'default'     => wp_kses_post( '<span class="typography_spacer"></span>' ),
	    'priority'	  => 470,
	    'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Category Menu Typography', 'hello-shoppable' ),
		'type'         => 'typography',
		'settings'     => 'woo_cat_menu_font_control',
		'section'      => 'header_style_options',
		'default'  => array(
			'font-family'     => 'Inter',
			'font-size'       => '15px',
			'text-transform'  => 'none',
			'variant'         => '500',
			'font-style'      => 'normal',
			'line-height'     => '1.6',
			'letter-spacing'  => '1px',
			'text-decoration' => 'none',
			'text-align'      => '',
		),
		'priority'	  =>  480,
		'transport'   => 'auto',
		'output'   => array(
			array(
				'element' => array( '.bottom-header .header-category-nav ul li a' )
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_style_tab',
			),
			array(
				'setting'  => 'enable_header_woo_cat_menu',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'woo_cat_menu_font_space',
	    'section'     => 'header_style_options',
	    'default'     => wp_kses_post( '<span class="typography_spacer"></span>' ),
	    'priority'	  => 485,
	    'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_style_tab',
			),
			array(
				'setting'  => 'enable_header_woo_cat_menu',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'main_menu_description_info',
	    'section'     => 'header_style_options',
	    'default'  => wp_kses( __( 'For more information about how to setup menu description <a target="_blank" href="https://bosathemes.com/docs/shoppable/how-to-setup-menu-description/">click here</a>', 'hello-shoppable' ), array(
			    'a' => array(
			      'target' => array(),
			      'href' => array(),
			    ),
		  	)
		),
	    'priority'	  => 490,
	    'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_style_tab',
			),
		),
	) );

	// Responsive
	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'header_style_responsive_separator',
	    'section'     => 'header_style_options',
	    'default'     => esc_html__( 'Responsive', 'hello-shoppable' ),
	    'priority'	  => 550,
	    'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Header Menu Text', 'hello-shoppable' ),
		'type'         => 'text',
		'settings'     => 'responsive_header_menu_text',
		'section'      => 'header_style_options',
		'default'      => esc_html__( 'MENU', 'hello-shoppable' ),
		'priority'	   => 560,
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Mid Header Section Border', 'hello-shoppable' ),
		'type'         => 'toggle',
		'settings'     => 'mobile_mid_header_border',
		'section'      => 'header_style_options',
		'default'      => true,
		'priority'	   => 570,
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Header Advertisement Banner', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'mobile_ad_banner',
		'section'     => 'header_style_options',
		'default'     => true,
		'priority'	  => 590,
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_general_tab',
			),
			array(
				'setting'  => 'header_layout',
				'operator' => 'contains',
				'value'    => array( 'header_four' ),
			),
			array(
				'setting'  => 'mobile_top_header',
				'operator' => '=',
				'value'    => true,
			),
			array(
				'setting'  => 'header_advertisement_banner_button',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Header Search', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'enable_mobile_search_icon',
		'section'     => 'header_style_options',
		'default'     => true,
		'priority'	  => 600,
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_general_tab',
			),
			array(
				'setting'  => 'enable_search_icon',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'mobile_top_header',
				'operator' => '=',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'    => esc_html__( 'WooCommerce Compare', 'hello-shoppable' ),
		'type'     => 'toggle',
		'settings' => 'mobile_woocommerce_compare',
		'section'  => 'header_style_options',
		'default'  => true,
		'priority' => 610,
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_compare',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'    => esc_html__( 'WooCommerce Wishlist', 'hello-shoppable' ),
		'type'     => 'toggle',
		'settings' => 'mobile_woocommerce_wishlist',
		'section'  => 'header_style_options',
		'default'  => true,
		'priority' => 620,
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_wishlist',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'    => esc_html__( 'WooCommerce My Account', 'hello-shoppable' ),
		'type'     => 'toggle',
		'settings' => 'mobile_woocommerce_account',
		'section'  => 'header_style_options',
		'default'  => true,
		'priority' => 630,
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_account',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'    => esc_html__( 'WooCommerce Cart', 'hello-shoppable' ),
		'type'     => 'toggle',
		'settings' => 'mobile_woocommerce_cart',
		'section'  => 'header_style_options',
		'default'  => true,
		'priority' => 640,
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_cart',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Category Menu', 'hello-shoppable' ),
		'type'         => 'toggle',
		'settings'     => 'enable_mobile_header_woo_cat_menu',
		'section'      => 'header_style_options',
		'default'      => true,
		'priority'	   => 650,
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_general_tab',
			),
			array(
				'setting'  => 'enable_header_woo_cat_menu',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Category Menu Label', 'hello-shoppable' ),
		'type'         => 'toggle',
		'settings'     => 'enable_mobile_cat_menu_label',
		'section'      => 'header_style_options',
		'default'      => true,
		'priority'	   => 655,
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_general_tab',
			),
			array(
				'setting'  => 'enable_header_woo_cat_menu',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'enable_mobile_header_woo_cat_menu',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Header Buttons', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'mobile_header_buttons',
		'section'     => 'header_style_options',
		'default'     => true,
		'priority'	  => 660,
		'active_callback' => array(
			array(
				'setting'  => 'main_header_tab',
				'operator' => '==',
				'value'    => 'header_general_tab',
			),
			array(
				'setting'  => 'header_button',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'mobile_top_header',
				'operator' => '=',
				'value'    => true,
			),
		),
	) );

	// Top Notification Options
	Kirki::add_section( 'notification_bar_options', array(
	    'title'      => esc_html__( 'Top Notification Bar', 'hello-shoppable' ),
	    'panel'      => 'header_options',	   
	    'capability' => 'edit_theme_options',
	    'priority'   => 20,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'type'        => 'radio-buttonset',
		'settings'    => 'top_notification_tab',
		'section'     => 'notification_bar_options',
		'default'     => 'top_notification_general_tab',
		'choices'  => array(
			'top_notification_general_tab'     => esc_html__( 'General', 'hello-shoppable' ),
			'top_notification_style_tab'     	 => esc_html__( 'Style', 'hello-shoppable' ),
		),
		'transport'	   => 'postMessage',
		'priority'	   => 10,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Header Notification Bar', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'enable_notification_bar',
		'section'     => 'notification_bar_options',
		'default'     => false,
		'priority'	  => 15,
		'active_callback' => array(
			array(
				'setting'  => 'top_notification_tab',
				'operator' => '==',
				'value'    => 'top_notification_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'    => esc_html__( 'Sticky Position', 'hello-shoppable' ),
		'type'     => 'toggle',
		'settings' => 'sticky_notification_bar',
		'section'  => 'notification_bar_options',
		'default'  => false,
		'priority' => 20,
		'active_callback' => array(
		    array(
				'setting'  => 'top_notification_tab',
				'operator' => '==',
				'value'    => 'top_notification_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Title', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'enable_notification_bar_title',
		'section'     => 'notification_bar_options',
		'default'     => false,
		'priority'	  => 23,
		'active_callback' => array(
			array(
				'setting'  => 'top_notification_tab',
				'operator' => '==',
				'value'    => 'top_notification_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'    => esc_html__( 'Title', 'hello-shoppable' ),
		'type'     => 'text',
		'settings' => 'notification_bar_title',
		'section'  => 'notification_bar_options',
		'default'  => '',
		'priority' => 25,
		'transport' => 'postMessage',
		'active_callback' => array(
		    array(
				'setting'  => 'top_notification_tab',
				'operator' => '==',
				'value'    => 'top_notification_general_tab',
			),
			array(
				'setting'  => 'enable_notification_bar_title',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'top_notification_button_separator',
	    'section'     => 'notification_bar_options',
	    'default'     => esc_html__( 'Top Notification Bar Button Options', 'hello-shoppable' ),
	    'priority'	  => 30,
	    'active_callback' => array(
	    	array(
				'setting'  => 'top_notification_tab',
				'operator' => '==',
				'value'    => 'top_notification_general_tab',
			),
		),
	) );

	// Top Notification Bar Button
	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Button', 'hello-shoppable' ),
		'type'         => 'toggle',
		'settings'     => 'top_notification_button',
		'section'      => 'notification_bar_options',
		'default'      => true,
		'priority'	   => 40,
		'active_callback' => array(
			array(
				'setting'  => 'top_notification_tab',
				'operator' => '==',
				'value'    => 'top_notification_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Text', 'hello-shoppable' ),
		'type'         => 'text',
		'settings'     => 'top_notification_button_text',
		'section'      => 'notification_bar_options',
		'default'      => '',
		'priority'	   => 50,
		'active_callback' => array(
			array(
				'setting'  => 'top_notification_tab',
				'operator' => '==',
				'value'    => 'top_notification_general_tab',
			),
			array(
				'setting'  => 'top_notification_button',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Link', 'hello-shoppable' ),
		'type'         => 'text',
		'settings'     => 'top_notification_button_link',
		'section'      => 'notification_bar_options',
		'default'      => '',
		'priority'	   => 60,
		'active_callback' => array(
			array(
				'setting'  => 'top_notification_tab',
				'operator' => '==',
				'value'    => 'top_notification_general_tab',
			),
			array(
				'setting'  => 'top_notification_button',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Open Link in New Window', 'hello-shoppable' ),
		'type'         => 'toggle',
		'settings'     => 'top_notification_button_target',
		'section'      => 'notification_bar_options',
		'default'      => true,
		'priority'	   => 70,
		'active_callback' => array(
			array(
				'setting'  => 'top_notification_tab',
				'operator' => '==',
				'value'    => 'top_notification_general_tab',
			),
			array(
				'setting'  => 'top_notification_button',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	//Responsive
	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'top_notification_bar_responsive_separator',
	    'section'     => 'notification_bar_options',
	    'default'     => esc_html__( 'Responsive', 'hello-shoppable' ),
	    'priority'	  => 90,
	    'active_callback' => array(
	    array(
				'setting'  => 'top_notification_tab',
				'operator' => '==',
				'value'    => 'top_notification_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       		=> esc_html__( 'Header Notification Bar', 'hello-shoppable' ),
		'type'        		=> 'toggle',
		'settings'    		=> 'mobile_notification_bar',
		'section'     		=> 'notification_bar_options',
		'default'     		=> false,
		'priority'	        => 100,
		'active_callback'	=> array(
			array(
				'setting'  => 'top_notification_tab',
				'operator' => '==',
				'value'    => 'top_notification_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Sticky Header Notification Bar', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'sticky_mobile_notification_bar',
		'section'     => 'notification_bar_options',
		'default'     => false,
		'priority'	  => 110,
		'active_callback' => array(
			array(
				'setting'  => 'top_notification_tab',
				'operator' => '==',
				'value'    => 'top_notification_general_tab',
			),
			array(
				'setting'  => 'sticky_notification_bar',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Section Height (in px)', 'hello-shoppable' ),
		'description' => esc_html__( 'This option will only apply to Desktop. Please click on below Desktop Icon to see changes. Automatically adjust by theme default in the responsive devices.
		', 'hello-shoppable' ),
		'type'        => 'slider',
		'settings'    => 'notification_bar_image_height',
		'section'     => 'notification_bar_options',
		'transport'   => 'postMessage',
		'default'     => 40,
		'priority'	  => 130,
		'choices'     => array(
			'min'  => 10,
			'max'  => 300,
			'step' => 1,
		),
		'active_callback' => array(
		    array(
				'setting'  => 'top_notification_tab',
				'operator' => '==',
				'value'    => 'top_notification_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Background Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'notification_bar_background_color',
		'section'      => 'notification_bar_options',
		'default'      => '#1a1a1a',
		'priority'	   => 140,	
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'top_notification_tab',
				'operator' => '==',
				'value'    => 'top_notification_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Text Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'notification_bar_title_color',
		'section'      => 'notification_bar_options',
		'default'      => '#ffffff',
		'priority'	   => 150,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'enable_notification_bar_title',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'top_notification_tab',
				'operator' => '==',
				'value'    => 'top_notification_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'noti_button_border',
	    'section'     => 'notification_bar_options',
	    'default'     => wp_kses_post( '<hr class="customizer_separator">' ),
	    'priority'	  => 160,
	    'active_callback' => array(
			array(
				'setting'  => 'top_notification_tab',
				'operator' => '==',
				'value'    => 'top_notification_style_tab',
			),
			array(
				'setting'  => 'top_notification_button',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'noti_button_style_title',
	    'section'     => 'notification_bar_options',
	    'default'  	  => wp_kses_post(
	    	'<div class="customizer_separator_title">'.esc_html__( 'Top Notification Bar Button', 'hello-shoppable' ).'</div>'
	    ),
	    'priority'	  => 170,
	    'active_callback' => array(
			array(
				'setting'  => 'top_notification_tab',
				'operator' => '==',
				'value'    => 'top_notification_style_tab',
			),
			array(
				'setting'  => 'top_notification_button',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Colors', 'hello-shoppable' ),
		'type'        => 'radio-buttonset',
		'settings'    => 'noti_button_controls',
		'section'     => 'notification_bar_options',
		'default'     => 'normal',
		'choices'  => array(
			'normal' 			=> esc_html__( 'Normal', 'hello-shoppable' ),
			'hover' 			=> esc_html__( 'Hover', 'hello-shoppable' ),
		),
		'priority'	  => 180,
		'transport'   => 'postMessage',
		'active_callback' => array(
			array(
				'setting'  => 'top_notification_tab',
				'operator' => '==',
				'value'    => 'top_notification_style_tab',
			),
			array(
				'setting'  => 'top_notification_button',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Background Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'noti_button_bg_color',
		'section'      => 'notification_bar_options',
		'default'      => '',
		'priority'	   => 185,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'top_notification_tab',
				'operator' => '==',
				'value'    => 'top_notification_style_tab',
			),
			array(
				'setting'  => 'top_notification_button',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'noti_button_controls',
				'operator' => '==',
				'value'    => 'normal',
			),
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Text Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'noti_button_text_color',
		'section'      => 'notification_bar_options',
		'default'      => '',
		'priority'	   => 190,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'top_notification_tab',
				'operator' => '==',
				'value'    => 'top_notification_style_tab',
			),
			array(
				'setting'  => 'top_notification_button',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'noti_button_controls',
				'operator' => '==',
				'value'    => 'normal',
			),
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Border Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'noti_button_border_color',
		'section'      => 'notification_bar_options',
		'default'      => '',
		'priority'	   => 200,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'top_notification_tab',
				'operator' => '==',
				'value'    => 'top_notification_style_tab',
			),
			array(
				'setting'  => 'top_notification_button',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'noti_button_controls',
				'operator' => '==',
				'value'    => 'normal',
			),
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Background Hover Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'noti_button_background_hover_color',
		'section'      => 'notification_bar_options',
		'default'      => '',
		'priority'	   => 205,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'top_notification_tab',
				'operator' => '==',
				'value'    => 'top_notification_style_tab',
			),
			array(
				'setting'  => 'top_notification_button',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'noti_button_controls',
				'operator' => '==',
				'value'    => 'hover',
			),
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Text Hover Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'noti_button_text_hover_color',
		'section'      => 'notification_bar_options',
		'default'      => '',
		'priority'	   => 210,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'top_notification_tab',
				'operator' => '==',
				'value'    => 'top_notification_style_tab',
			),
			array(
				'setting'  => 'top_notification_button',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'noti_button_controls',
				'operator' => '==',
				'value'    => 'hover',
			),
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Border Hover Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'noti_button_border_hover_color',
		'section'      => 'notification_bar_options',
		'default'      => '',
		'priority'	   => 215,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'top_notification_tab',
				'operator' => '==',
				'value'    => 'top_notification_style_tab',
			),
			array(
				'setting'  => 'top_notification_button',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'noti_button_controls',
				'operator' => '==',
				'value'    => 'hover',
			),
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Border Width (in px)', 'hello-shoppable' ),
		'type'         => 'slider',
		'settings'     => 'noti_button_border_width',
		'section'      => 'notification_bar_options',
		'default'      => '',
		'priority'	   => 220,
		'choices'		=> array(
			'min'	=> 0,
			'max'	=> 5,
			'step'	=> 1,
		),
		'active_callback' => array(
			array(
				'setting'  => 'top_notification_tab',
				'operator' => '==',
				'value'    => 'top_notification_style_tab',
			),
			array(
				'setting'  => 'top_notification_button',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Border Radius (in px)', 'hello-shoppable' ),
		'type'         => 'slider',
		'settings'     => 'noti_button_radius',
		'section'      => 'notification_bar_options',
		'default'      => '',
		'priority'	   => 225,
		'choices'		=> array(
			'min'	=> 0,
			'max'	=> 100,
			'step'	=> 1,
		),
		'active_callback' => array(
			array(
				'setting'  => 'top_notification_tab',
				'operator' => '==',
				'value'    => 'top_notification_style_tab',
			),
			array(
				'setting'  => 'top_notification_button',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'noti_typography_border',
	    'section'     => 'notification_bar_options',
	    'default'     => wp_kses_post( '<hr class="customizer_separator">' ),
	    'priority'	  => 227,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Title Typography', 'hello-shoppable' ),
		'type'         => 'typography',
		'settings'     => 'notification_bar_title_font_control',
		'section'      => 'notification_bar_options',
		'default'  => array(
			'font-family'    => 'Open Sans',
			'variant'        => 'regular',
			'font-style'      => '',
			'font-size'      => '13px',
			'line-height'    => '1.3',
			'letter-spacing'  => '',
			'text-transform' => 'none',
			'text-decoration' => '',
			'text-align'      => '',
		),
		'priority'	  => 230,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.notification-bar .notification-content',
			),
		),
		'active_callback' => array(
		    array(
				'setting'  => 'top_notification_tab',
				'operator' => '==',
				'value'    => 'top_notification_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'notification_typography_space',
	    'section'     => 'notification_bar_options',
	    'default'     => wp_kses_post( '<span class="typography_spacer"></span>' ),
	    'priority'	  => 235,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Notification Bar Buttons Typography', 'hello-shoppable' ),
		'type'         => 'typography',
		'settings'     => 'notification_bar_buttons_font_control',
		'section'      => 'notification_bar_options',
		'default'  => array(
			'font-family'     => 'Open Sans',
			'variant'         => '500',
			'font-style'      => '',
			'font-size'       => '13px',
			'line-height'     => '1.3',
			'letter-spacing'  => '',
			'text-transform'  => 'none',
			'text-decoration' => '',
			'text-align'      => '',
			
		),
		'priority'	  => 240,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.notification-bar .button-container a',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'top_notification_button',
				'operator' => '==',
				'value'    => true,
			),
		    array(
				'setting'  => 'top_notification_tab',
				'operator' => '==',
				'value'    => 'top_notification_style_tab',
			),
		),
	) );

	// Fixed Header
	Kirki::add_section( 'fixed_header', array(
	    'title'          => esc_html__( 'Fixed Header', 'hello-shoppable' ),
	    'capability'     => 'edit_theme_options',
	    'panel'			 => 'header_options',
	    'priority'       => 50,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'type'        => 'radio-buttonset',
		'settings'    => 'fixed_header_tab',
		'section'     => 'fixed_header',
		'default'     => 'fixed_header_general_tab',
		'choices'  => array(
			'fixed_header_general_tab'     => esc_html__( 'General', 'hello-shoppable' ),
			'fixed_header_style_tab'     	=> esc_html__( 'Style', 'hello-shoppable' ),
		),
		'transport'	   => 'postMessage',
		'priority'	   => 10,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Fixed Header', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'fixed_header',
		'section'     => 'fixed_header',
		'default'     => false,
		'priority'	  => 20,
		'active_callback' => array(
			array(
				'setting'  => 'fixed_header_tab',
				'operator' => '==',
				'value'    => 'fixed_header_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Logo', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'fixed_header_logo',
		'section'     => 'fixed_header',
		'default'     => true,
		'priority'	  => 30,
		'active_callback' => array(
			array(
				'setting'  => 'fixed_header_tab',
				'operator' => '==',
				'value'    => 'fixed_header_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Site Title', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'fixed_header_title',
		'section'     => 'fixed_header',
		'default'     => true,
		'priority'	  => 40,
		'active_callback' => array(
			array(
				'setting'  => 'fixed_header_tab',
				'operator' => '==',
				'value'    => 'fixed_header_general_tab',
			),
			array(
				'setting'  => 'site_title',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Site Tagline', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'fixed_header_tagline',
		'section'     => 'fixed_header',
		'default'     => false,
		'priority'	  => 50,
		'active_callback' => array(
			array(
				'setting'  => 'fixed_header_tab',
				'operator' => '==',
				'value'    => 'fixed_header_general_tab',
			),
			array(
				'setting'  => 'site_tagline',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Main Menu', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'fixed_header_main_menu',
		'section'     => 'fixed_header',
		'default'     => true,
		'priority'	  => 60,
		'active_callback' => array(
			array(
				'setting'  => 'fixed_header_tab',
				'operator' => '==',
				'value'    => 'fixed_header_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Button', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'fixed_header_button',
		'section'     => 'fixed_header',
		'default'     => false,
		'priority'	  => 70,
		'active_callback' => array(
			array(
				'setting'  => 'fixed_header_tab',
				'operator' => '==',
				'value'    => 'fixed_header_general_tab',
			),
			array(
				'setting'  => 'header_button',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Category Menu', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'fixed_header_category_menu',
		'section'     => 'fixed_header',
		'default'     => false,
		'priority'	  => 80,
		'active_callback' => array(
			array(
				'setting'  => 'fixed_header_tab',
				'operator' => '==',
				'value'    => 'fixed_header_general_tab',
			),
			array(
				'setting'  => 'enable_header_woo_cat_menu',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'WooCommerce Compare', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'fixed_header_wooCommerce_compare',
		'section'     => 'fixed_header',
		'default'     => true,
		'priority'	  => 90,
		'active_callback' => array(
			array(
				'setting'  => 'fixed_header_tab',
				'operator' => '==',
				'value'    => 'fixed_header_general_tab',
			),
			array(
				'setting'  => 'woocommerce_compare',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'WooCommerce Wishlist', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'fixed_header_wooCommerce_wishlist',
		'section'     => 'fixed_header',
		'default'     => true,
		'priority'	  => 100,
		'active_callback' => array(
			array(
				'setting'  => 'fixed_header_tab',
				'operator' => '==',
				'value'    => 'fixed_header_general_tab',
			),
			array(
				'setting'  => 'woocommerce_wishlist',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'WooCommerce My Account', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'fixed_header_wooCommerce_myaccount',
		'section'     => 'fixed_header',
		'default'     => true,
		'priority'	  => 110,
		'active_callback' => array(
			array(
				'setting'  => 'fixed_header_tab',
				'operator' => '==',
				'value'    => 'fixed_header_general_tab',
			),
			array(
				'setting'  => 'woocommerce_account',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'WooCommerce Cart', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'fixed_header_wooCommerce_cart',
		'section'     => 'fixed_header',
		'default'     => true,
		'priority'	  => 120,
		'active_callback' => array(
			array(
				'setting'  => 'fixed_header_tab',
				'operator' => '==',
				'value'    => 'fixed_header_general_tab',
			),
			array(
				'setting'  => 'woocommerce_cart',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Search Icon', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'fixed_header_search_icon',
		'section'     => 'fixed_header',
		'default'     => true,
		'priority'	  => 130,
		'active_callback' => array(
			array(
				'setting'  => 'fixed_header_tab',
				'operator' => '==',
				'value'    => 'fixed_header_general_tab',
			),
			array(
				'setting'  => 'enable_search_icon',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'fixed_header_responsive_separator',
	    'section'     => 'fixed_header',
	    'default'     => esc_html__( 'Responsive', 'hello-shoppable' ),
	    'priority'	  => 140,
	    'active_callback' => array(
			array(
				'setting'  => 'fixed_header_tab',
				'operator' => '==',
				'value'    => 'fixed_header_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Fixed Header', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'mobile_fixed_header',
		'section'     => 'fixed_header',
		'default'     => false,
		'priority'	  => 150,
		'active_callback' => array(
			array(
				'setting'  => 'fixed_header_tab',
				'operator' => '==',
				'value'    => 'fixed_header_general_tab',
			),
		),
	) );

 	#Fixed Header Style

 	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Logo Image Width', 'hello-shoppable' ),
		'type'         => 'slider',
		'settings'     => 'fix_header_logo_width',
		'section'      => 'fixed_header',
		'transport'    => 'postMessage',
		'priority'     => 153,
		'default'      => 270,
		'choices'      => array(
			'min'  => 50,
			'max'  => 270,
			'step' => 5,
		),
		'active_callback' => array(
			array(
				'setting'  => 'fixed_header_tab',
				'operator' => '==',
				'value'    => 'fixed_header_style_tab',
			),
			array(
				'setting' => 'fixed_header_logo',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

 	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'fixed_header_colors_title',
	    'section'     => 'fixed_header',
	    'default'  	  => wp_kses_post(
	    	'<div class="customizer_separator_title">'.esc_html__( 'Colors', 'hello-shoppable' ).'</div>'
	    ),
	    'priority'	  => 154,
	    'active_callback' => array(
			array(
				'setting'  => 'fixed_header_tab',
				'operator' => '==',
				'value'    => 'fixed_header_style_tab',
			),
		),
	) );

 	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Background Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'fix_header_bottom_background_color',
		'section'      => 'fixed_header',
		'default'      => '',
		'priority'	   => 155,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'fixed_header_tab',
				'operator' => '==',
				'value'    => 'fixed_header_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Site Title Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'fixed_header_title_color',
		'section'      => 'fixed_header',
		'default'      => '#030303',
		'priority'	   => 160,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'fixed_header_tab',
				'operator' => '==',
				'value'    => 'fixed_header_style_tab',
			),
			array(
				'setting' => 'fixed_header_title',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'site_title',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Site Tagline Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'fixed_header_tagline_color',
		'section'      => 'fixed_header',
		'default'      => '#767676',
		'priority'	   => 170,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'fixed_header_tab',
				'operator' => '==',
				'value'    => 'fixed_header_style_tab',
			),
			array(
				'setting' => 'fixed_header_tagline',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'site_tagline',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Text Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'fixed_header_menu_text_color',
		'section'      => 'fixed_header',
		'default'      => '#333333',
		'priority'	   => 190,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'fixed_header_tab',
				'operator' => '==',
				'value'    => 'fixed_header_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Hover Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'fixed_header_bottom_text_link_hover_color',
		'section'      => 'fixed_header',
		'default'      => '#2154ac',
		'priority'	   => 200,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'fixed_header_tab',
				'operator' => '==',
				'value'    => 'fixed_header_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Active Menu Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'fixed_header_menu_active_color',
		'section'      => 'fixed_header',
		'default'      => '#2154ac',
		'priority'	   => 210,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'fixed_header_tab',
				'operator' => '==',
				'value'    => 'fixed_header_style_tab',
			),
			array(
				'setting'  => 'fixed_header_main_menu',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Sub Menu Hover Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'fix_header_sub_menu_link_hover_color',
		'section'      => 'fixed_header',
		'default'      => '#2154ac',
		'priority'	   => 220,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'fixed_header_tab',
				'operator' => '==',
				'value'    => 'fixed_header_style_tab',
			),
			array(
				'setting'  => 'fixed_header_main_menu',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	#Fix Header Category Menu
	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'fixed_header_site_border',
	    'section'     => 'fixed_header',
	    'default'     => wp_kses_post( '<hr class="customizer_separator">' ),
	    'priority'	  => 250,
	    'active_callback' => array(
			array(
				'setting'  => 'fixed_header_tab',
				'operator' => '==',
				'value'    => 'fixed_header_style_tab',
			),
			array(
				'setting' => 'fixed_header_category_menu',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'enable_header_woo_cat_menu',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'fixed_header_cat_menu_style_title',
	    'section'     => 'fixed_header',
	    'default'  	  => wp_kses_post(
	    	'<div class="customizer_separator_title">'.esc_html__( 'Fixed Header Category Menu Button', 'hello-shoppable' ).'</div>'
	    ),
	    'priority'	  => 260,
	    'active_callback' => array(
			array(
				'setting'  => 'fixed_header_tab',
				'operator' => '==',
				'value'    => 'fixed_header_style_tab',
			),
			array(
				'setting' => 'fixed_header_category_menu',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'enable_header_woo_cat_menu',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Colors', 'hello-shoppable' ),
		'type'        => 'radio-buttonset',
		'settings'    => 'fixed_header_cat_menu_controls',
		'section'     => 'fixed_header',
		'default'     => 'normal',
		'choices'  => array(
			'normal' 			=> esc_html__( 'Normal', 'hello-shoppable' ),
			'hover' 			=> esc_html__( 'Hover', 'hello-shoppable' ),
		),
		'priority'	  => 270,
		'transport'   => 'postMessage',
		'active_callback' => array(
			array(
				'setting'  => 'fixed_header_tab',
				'operator' => '==',
				'value'    => 'fixed_header_style_tab',
			),
			array(
				'setting' => 'fixed_header_category_menu',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'enable_header_woo_cat_menu',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Background Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'fixed_header_cat_menu_bg_color',
		'section'      => 'fixed_header',
		'default'      => '',
		'priority'	   => 280,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'fixed_header_tab',
				'operator' => '==',
				'value'    => 'fixed_header_style_tab',
			),
			array(
				'setting'  => 'fixed_header_cat_menu_controls',
				'operator' => '==',
				'value'    => 'normal',
			),
			array(
				'setting' => 'fixed_header_category_menu',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'enable_header_woo_cat_menu',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Text Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'fixed_header_cat_menu_text_color',
		'section'      => 'fixed_header',
		'default'      => '',
		'priority'	   => 290,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'fixed_header_tab',
				'operator' => '==',
				'value'    => 'fixed_header_style_tab',
			),
			array(
				'setting'  => 'fixed_header_cat_menu_controls',
				'operator' => '==',
				'value'    => 'normal',
			),
			array(
				'setting' => 'fixed_header_category_menu',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'enable_header_woo_cat_menu',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Border Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'fixed_header_cat_menu_border_color',
		'section'      => 'fixed_header',
		'default'      => '',
		'priority'	   => 300,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'fixed_header_tab',
				'operator' => '==',
				'value'    => 'fixed_header_style_tab',
			),
			array(
				'setting'  => 'fixed_header_cat_menu_controls',
				'operator' => '==',
				'value'    => 'normal',
			),
			array(
				'setting' => 'fixed_header_category_menu',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'enable_header_woo_cat_menu',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Background Hover Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'fixed_header_cat_menu_background_hover_color',
		'section'      => 'fixed_header',
		'default'      => '',
		'priority'	   => 310,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'fixed_header_tab',
				'operator' => '==',
				'value'    => 'fixed_header_style_tab',
			),
			array(
				'setting'  => 'fixed_header_cat_menu_controls',
				'operator' => '==',
				'value'    => 'hover',
			),
			array(
				'setting' => 'fixed_header_category_menu',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'enable_header_woo_cat_menu',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Text Hover Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'fixed_header_cat_menu_text_hover_color',
		'section'      => 'fixed_header',
		'default'      => '',
		'priority'	   => 320,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'fixed_header_tab',
				'operator' => '==',
				'value'    => 'fixed_header_style_tab',
			),
			array(
				'setting'  => 'fixed_header_cat_menu_controls',
				'operator' => '==',
				'value'    => 'hover',
			),
			array(
				'setting' => 'fixed_header_category_menu',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'enable_header_woo_cat_menu',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Border Hover Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'fixed_header_cat_menu_border_hover_color',
		'section'      => 'fixed_header',
		'default'      => '',
		'priority'	   => 330,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'fixed_header_tab',
				'operator' => '==',
				'value'    => 'fixed_header_style_tab',
			),
			array(
				'setting'  => 'fixed_header_cat_menu_controls',
				'operator' => '==',
				'value'    => 'hover',
			),
			array(
				'setting' => 'fixed_header_category_menu',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'enable_header_woo_cat_menu',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	#Fix Header Buttons
	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'fixed_header_button_border',
	    'section'     => 'fixed_header',
	    'default'     => wp_kses_post( '<hr class="customizer_separator">' ),
	    'priority'	  => 340,
	    'active_callback' => array(
			array(
				'setting'  => 'fixed_header_tab',
				'operator' => '==',
				'value'    => 'fixed_header_style_tab',
			),
			array(
				'setting' => 'fixed_header_button',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'header_button',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'fixed_header_button_style_title',
	    'section'     => 'fixed_header',
	    'default'  	  => wp_kses_post(
	    	'<div class="customizer_separator_title">'.esc_html__( 'Fixed Header Button', 'hello-shoppable' ).'</div>'
	    ),
	    'priority'	  => 350,
	    'active_callback' => array(
			array(
				'setting'  => 'fixed_header_tab',
				'operator' => '==',
				'value'    => 'fixed_header_style_tab',
			),
			array(
				'setting'  => 'fixed_header_button',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'header_button',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Colors', 'hello-shoppable' ),
		'type'        => 'radio-buttonset',
		'settings'    => 'fixed_header_button_controls',
		'section'     => 'fixed_header',
		'default'     => 'normal',
		'choices'  => array(
			'normal' 			=> esc_html__( 'Normal', 'hello-shoppable' ),
			'hover' 			=> esc_html__( 'Hover', 'hello-shoppable' ),
		),
		'priority'	  => 360,
		'transport'   => 'postMessage',
		'active_callback' => array(
			array(
				'setting'  => 'fixed_header_tab',
				'operator' => '==',
				'value'    => 'fixed_header_style_tab',
			),
			array(
				'setting'  => 'fixed_header_button',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'header_button',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Background Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'fixed_header_button_bg_color',
		'section'      => 'fixed_header',
		'default'      => '',
		'priority'	   => 370,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'fixed_header_tab',
				'operator' => '==',
				'value'    => 'fixed_header_style_tab',
			),
			array(
				'setting'  => 'fixed_header_button_controls',
				'operator' => '==',
				'value'    => 'normal',
			),
			array(
				'setting'  => 'fixed_header_button',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'header_button',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Text Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'fixed_header_button_text_color',
		'section'      => 'fixed_header',
		'default'      => '',
		'priority'	   => 380,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'fixed_header_tab',
				'operator' => '==',
				'value'    => 'fixed_header_style_tab',
			),
			array(
				'setting'  => 'fixed_header_button_controls',
				'operator' => '==',
				'value'    => 'normal',
			),
			array(
				'setting'  => 'fixed_header_button',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'header_button',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Border Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'fixed_header_button_border_color',
		'section'      => 'fixed_header',
		'default'      => '',
		'priority'	   => 390,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'fixed_header_tab',
				'operator' => '==',
				'value'    => 'fixed_header_style_tab',
			),
			array(
				'setting'  => 'fixed_header_button_controls',
				'operator' => '==',
				'value'    => 'normal',
			),
			array(
				'setting'  => 'fixed_header_button',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'header_button',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Background Hover Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'fixed_header_button_background_hover_color',
		'section'      => 'fixed_header',
		'default'      => '',
		'priority'	   => 400,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'fixed_header_tab',
				'operator' => '==',
				'value'    => 'fixed_header_style_tab',
			),
			array(
				'setting'  => 'fixed_header_button_controls',
				'operator' => '==',
				'value'    => 'hover',
			),
			array(
				'setting'  => 'fixed_header_button',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'header_button',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Text Hover Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'fixed_header_button_text_hover_color',
		'section'      => 'fixed_header',
		'default'      => '',
		'priority'	   => 410,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'fixed_header_tab',
				'operator' => '==',
				'value'    => 'fixed_header_style_tab',
			),
			array(
				'setting'  => 'fixed_header_button_controls',
				'operator' => '==',
				'value'    => 'hover',
			),
			array(
				'setting'  => 'fixed_header_button',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'header_button',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Border Hover Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'fixed_header_button_border_hover_color',
		'section'      => 'fixed_header',
		'default'      => '',
		'priority'	   => 420,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'fixed_header_tab',
				'operator' => '==',
				'value'    => 'fixed_header_style_tab',
			),
			array(
				'setting'  => 'fixed_header_button_controls',
				'operator' => '==',
				'value'    => 'hover',
			),
			array(
				'setting'  => 'fixed_header_button',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'header_button',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	//Typography Options
	Kirki::add_panel( 'typography', array(
	    'title'          => esc_html__( 'Typography', 'hello-shoppable' ),
	    'priority'       => 70,
	) );

	Kirki::add_section( 'heading_typography', array(
	    'title'          => esc_html__( 'Headings', 'hello-shoppable' ),
	    'capability'     => 'edit_theme_options',
	    'panel'			 => 'typography',
	    'priority'       => 10,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Headings (H1 - H6)', 'hello-shoppable' ),
		'type'         => 'typography',
		'settings'     => 'general_title_font_control',
		'section'      => 'heading_typography',
		'default'  => array(
			'font-family'     => 'Inter',
			'variant'		  => '600',
			'font-style'      => 'normal',
			'font-size'       => '',
			'line-height'     => '1.3',
			'letter-spacing'  => '0',
			'text-transform'  => 'none',
			'text-decoration' => 'none',
			'text-align'      => '',
		),
		'priority'	  => 10,
		'transport'   => 'auto',
		'output'   => array(
			array(
				'element' => array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' ),
			),
		),	
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'heading_typography_space',
	    'section'     => 'heading_typography',
	    'default'     => wp_kses_post( '<span class="typography_spacer"></span>' ),
	    'priority'	  => 12,
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'heading_font_size_border',
	    'section'     => 'heading_typography',
	    'default'     => wp_kses_post( '<hr class="customizer_separator">' ),
	    'priority'	  => 15,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Heading 1 (H1)', 'hello-shoppable' ),
		'description'  => esc_html__( 'Font Size', 'hello-shoppable' ),
		'type'         => 'slider',
		'settings'     => 'heading_one_font_size',
		'section'      => 'heading_typography',
		'default'  	   => 32,
		'priority'	  => 20,
		'choices'	  => array(
			'min'	=> 0,
			'max'	=> 100,
			'step'	=> 1
		),
		'transport'   => 'auto',
		'output'   => array(
			array(
				'element' 	=> '.entry-content h1',
				'property'	=> 'font-size',
				'suffix'	=> 'px'
			),
		),	
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Heading 2 (H2)', 'hello-shoppable' ),
		'description'  => esc_html__( 'Font Size', 'hello-shoppable' ),
		'type'         => 'slider',
		'settings'     => 'heading_two_font_size',
		'section'      => 'heading_typography',
		'default'  	   => 24,
		'priority'	  => 30,
		'choices'	  => array(
			'min'	=> 0,
			'max'	=> 100,
			'step'	=> 1
		),
		'transport'   => 'auto',
		'output'   => array(
			array(
				'element' 	=> '.entry-content h2',
				'property'	=> 'font-size',
				'suffix'	=> 'px'
			),
		),	
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Heading 3 (H3)', 'hello-shoppable' ),
		'description'  => esc_html__( 'Font Size', 'hello-shoppable' ),
		'type'         => 'slider',
		'settings'     => 'heading_three_font_size',
		'section'      => 'heading_typography',
		'default'  	   => 21,
		'priority'	  => 40,
		'choices'	  => array(
			'min'	=> 0,
			'max'	=> 100,
			'step'	=> 1
		),
		'transport'   => 'auto',
		'output'   => array(
			array(
				'element' 	=> '.entry-content h3',
				'property'	=> 'font-size',
				'suffix'	=> 'px'
			),
		),	
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Heading 4 (H4)', 'hello-shoppable' ),
		'description'  => esc_html__( 'Font Size', 'hello-shoppable' ),
		'type'         => 'slider',
		'settings'     => 'heading_four_font_size',
		'section'      => 'heading_typography',
		'default'  	   => 20,
		'priority'	  => 50,
		'choices'	  => array(
			'min'	=> 0,
			'max'	=> 100,
			'step'	=> 1
		),
		'transport'   => 'auto',
		'output'   => array(
			array(
				'element' 	=> '.entry-content h4',
				'property'	=> 'font-size',
				'suffix'	=> 'px'
			),
		),	
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Heading 5 (H5)', 'hello-shoppable' ),
		'description'  => esc_html__( 'Font Size', 'hello-shoppable' ),
		'type'         => 'slider',
		'settings'     => 'heading_five_font_size',
		'section'      => 'heading_typography',
		'default'  	   => 15,
		'priority'	  => 60,
		'choices'	  => array(
			'min'	=> 0,
			'max'	=> 100,
			'step'	=> 1
		),
		'transport'   => 'auto',
		'output'   => array(
			array(
				'element' 	=> '.entry-content h5',
				'property'	=> 'font-size',
				'suffix'	=> 'px'
			),
		),	
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Heading 6 (H6)', 'hello-shoppable' ),
		'description'  => esc_html__( 'Font Size', 'hello-shoppable' ),
		'type'         => 'slider',
		'settings'     => 'heading_six_font_size',
		'section'      => 'heading_typography',
		'default'  	   => 14,
		'priority'	  => 70,
		'choices'	  => array(
			'min'	=> 0,
			'max'	=> 100,
			'step'	=> 1
		),
		'transport'   => 'auto',
		'output'   => array(
			array(
				'element' 	=> '.entry-content h6',
				'property'	=> 'font-size',
				'suffix'	=> 'px'
			),
		),	
	) );

	Kirki::add_section( 'general_typography', array(
	    'title'          => esc_html__( 'General', 'hello-shoppable' ),
	    'capability'     => 'edit_theme_options',
	    'panel'			 => 'typography',
	    'priority'       => 20,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Body', 'hello-shoppable' ),
		'type'         => 'typography',
		'settings'     => 'body_font_control',
		'section'      => 'general_typography',
		'default'  => array(
			'font-family'    => 'Inter',
			'variant'        => 'regular',
			'font-style'       => '',
			'font-size'      => '15px',
			'line-height'     => '1.6',
			'letter-spacing'  => '0',
			'text-transform'  => '',
			'text-decoration' => '',
			'text-align'      => '',
		),
		'priority'	  => 60,
		'transport'   => 'auto',
		'output' => array( 
			array(
				'element' => 'body',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'body_font_space',
	    'section'     => 'general_typography',
	    'default'     => wp_kses_post( '<span class="typography_spacer"></span>' ),
	    'priority'	  => 70,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Page & Single Post Title', 'hello-shoppable' ),
		'type'         => 'typography',
		'settings'     => 'page_title_font_control',
		'section'      => 'general_typography',
		'default'  => array(
			'font-family'    => 'Inter',
			'variant'        => '600',
			'font-style'      => '',
			'font-size'      => '48px',
			'line-height'     => '1.3',
			'letter-spacing'  => '0',
			'text-transform' => 'none',
			'text-decoration' => '',
			'text-align'      => '',
		),
		'priority'	  => 80,
		'transport'   => 'auto',
		'output'   => array(
			array(
				'element' => array( '.page-title' ),
			),
		),
	) );

	// Footer Options
	Kirki::add_panel( 'footer_options', array(
	    'title' => esc_html__( 'Footer', 'hello-shoppable' ),
	    'priority' => 95,
	) );

	//Footer General Options
	Kirki::add_section( 'footer_general_options', array(
	    'title'          => esc_html__( 'General', 'hello-shoppable' ),
	    'panel'          => 'footer_options',
	    'capability'     => 'edit_theme_options',
	    'priority'		 => 10,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Select Background Image', 'hello-shoppable' ),
		'description' => esc_html__( 'Recommended image size 1920x550 pixel.', 'hello-shoppable' ),
		'type'        => 'image',
		'settings'    => 'footer_image',
		'section'     => 'footer_general_options',
		'default'      => '',
		'choices'     => array(
			'save_as' => 'id',
		),
		'priority'	   => 10,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Choose Image Size', 'hello-shoppable' ),
		'type'        => 'select',
		'settings'    => 'render_footer_image_size',
		'section'     => 'footer_general_options',
		'default'     => 'full',
		'placeholder' => esc_html__( 'Select Image Size', 'hello-shoppable' ),
		'choices'     => hello_shoppable_get_intermediate_image_sizes(),
		'priority'	  => 20,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Background Image Size', 'hello-shoppable' ),
		'type'         => 'radio-buttonset',
		'settings'     => 'footer_image_size',
		'section'      => 'footer_general_options',
		'default'      => 'cover',
		'choices'      => array(
			'cover'    => esc_html__( 'Cover', 'hello-shoppable' ),
			'pattern'  => esc_html__( 'Repeat', 'hello-shoppable' ),
			'norepeat' => esc_html__( 'No Repeat', 'hello-shoppable' ),
		),
		'priority'	   => 30,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Image Overlay Opacity', 'hello-shoppable' ),
		'type'        => 'slider',
		'settings'    => 'footer_image_overlay_opacity',
		'section'     => 'footer_general_options',
		'default'     => 7,
		'choices'     => array(
			'min'  => 0,
			'max'  => 9,
			'step' => 1,
		),
		'priority'	   => 35,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Parallax Scrolling', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'footer_parallax_scrolling',
		'section'     => 'footer_general_options',
		'default'     => false,
		'priority'	  => 40,
	) );

	// Footer Widgets Options
	Kirki::add_section( 'footer_widgets_options', array(
	    'title'          => esc_html__( 'Footer Widgets', 'hello-shoppable' ),
	    'panel'          => 'footer_options',
	    'capability'     => 'edit_theme_options',
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'type'        => 'radio-buttonset',
		'settings'    => 'footer_widget_tab',
		'section'     => 'footer_widgets_options',
		'default'     => 'footer_widget_general_tab',
		'choices'  => array(
			'footer_widget_general_tab'     => esc_html__( 'General', 'hello-shoppable' ),
			'footer_widget_style_tab'     	=> esc_html__( 'Style', 'hello-shoppable' ),
		),
		'transport'	   => 'postMessage',
		'priority'	   => 10,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Footer Widget Area', 'hello-shoppable' ),
		'type'         => 'toggle',
		'settings'     => 'footer_widget',
		'section'      => 'footer_widgets_options',
		'default'      => true,
		'priority'	   => 15,
		'active_callback' => array(
			array(
				'setting'  => 'footer_widget_tab',
				'operator' => '==',
				'value'    => 'footer_widget_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Widget Columns Layouts', 'hello-shoppable' ),
		'type'        => 'radio-image',
		'settings'    => 'footer_widget_layout',
		'section'     => 'footer_widgets_options',
		'default'     => 'footer_style_one',
		'choices'  => array(
			'footer_style_one'	=> array(
				'src' => get_template_directory_uri() . '/assets/images/widget-layout-1.svg',
				'alt' => esc_html__( 'Footer One', 'hello-shoppable' )
			),
			'footer_style_two'	=> array(
				'src' => get_template_directory_uri() . '/assets/images/widget-layout-2.svg',
				'alt' => esc_html__( 'Footer Two', 'hello-shoppable' )
			),
			'footer_style_three' => array(
				'src' => get_template_directory_uri() . '/assets/images/widget-layout-3.svg',
				'alt' => esc_html__( 'Footer Three', 'hello-shoppable' )
			),
			'footer_style_four'   => array(
				'src' => get_template_directory_uri() . '/assets/images/widget-layout-4.svg',
				'alt' => esc_html__( 'Footer Four', 'hello-shoppable' )
			),
			'footer_style_five'   => array(
				'src' => get_template_directory_uri() . '/assets/images/widget-layout-5.svg',
				'alt' => esc_html__( 'Footer Five', 'hello-shoppable' )
			),
			'footer_style_six'    => array(
				'src' => get_template_directory_uri() . '/assets/images/widget-layout-6.svg',
				'alt' => esc_html__( 'Footer Six', 'hello-shoppable' )
			),
			'footer_style_seven'  => array(
				'src' => get_template_directory_uri() . '/assets/images/widget-layout-7.svg',
				'alt' => esc_html__( 'Footer Seven', 'hello-shoppable' )
			),
			'footer_style_eight'  => array(
				'src' => get_template_directory_uri() . '/assets/images/widget-layout-8.svg',
				'alt' => esc_html__( 'Footer Eight', 'hello-shoppable' )
			),
			'footer_style_nine'   => array(
				'src' => get_template_directory_uri() . '/assets/images/widget-layout-9.svg',
				'alt' => esc_html__( 'Footer Nine', 'hello-shoppable' )
			),
			'footer_style_ten'    => array(
				'src' => get_template_directory_uri() . '/assets/images/widget-layout-10.svg',
				'alt' => esc_html__( 'Footer Ten', 'hello-shoppable' )
			),
			'footer_style_eleven' => array(
				'src' => get_template_directory_uri() . '/assets/images/widget-layout-11.svg',
				'alt' => esc_html__( 'Footer Eleven', 'hello-shoppable' )
			)

		),
		'priority'	   => 16,
		'active_callback' => array(
			array(
				'setting'  => 'footer_widget_tab',
				'operator' => '==',
				'value'    => 'footer_widget_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Content Alignment', 'hello-shoppable' ),
		'type'        => 'radio-buttonset',
		'settings'    => 'footer_widget_content_alignment',
		'section'     => 'footer_widgets_options',
		'default'     => 'text-left',
		'choices'  => array(
			'text-left'   => esc_html__( 'Left', 'hello-shoppable' ),
			'text-center' => esc_html__( 'Center', 'hello-shoppable' ),
			'text-right'  => esc_html__( 'Right', 'hello-shoppable' ),
		),
		'priority'	   => 45,
		'active_callback' => array(
			array(
				'setting'  => 'footer_widget_tab',
				'operator' => '==',
				'value'    => 'footer_widget_style_tab',
			),
		),
	) );

	new \Kirki\Field\Dimensions(
		[
			'settings'    => 'footer_widget_padding',
			'label'       => esc_html__( 'Padding', 'hello-shoppable' ),
			'section'     => 'footer_widgets_options',
			'default'     => [
				'padding-top'    => '50px',
				'padding-bottom' => '50px',
			],
			'choices'     => [
				'labels' => [
					'padding-top'  		=> esc_html__( 'Top', 'hello-shoppable' ),
					'padding-bottom'	=> esc_html__( 'Bottom', 'hello-shoppable' ),
				],
			],
			'priority'	  => 50,
			'transport'   => 'auto',
			'output'      => [
				[
					'choice'      => 'padding-top',
			      	'element'     => '.wrap-footer-sidebar',
			    	'property'    => 'padding-top',
				],
				[
					'choice'      => 'padding-bottom',
			      	'element'     => '.wrap-footer-sidebar',
			    	'property'    => 'padding-bottom',
				]
			],
			'active_callback' => [
				[
					'setting'  => 'footer_widget_tab',
					'operator' => '==',
					'value'    => 'footer_widget_style_tab',
				]
			],  
		]
	);

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'top_footer_color_border',
	    'section'     => 'footer_widgets_options',
	    'default'  => wp_kses( '<hr class="customizer_separator">', array(
			    'hr' => array(
			      'class' => array(),
			    ),
		  	)
		),
	    'priority'	  => 55,
	    'active_callback' => array(
			array(
				'setting'  => 'footer_widget_tab',
				'operator' => '==',
				'value'    => 'footer_widget_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'footer_widgets_colors_title',
	    'section'     => 'footer_widgets_options',
	    'default'  	  => wp_kses_post(
	    	'<div class="customizer_separator_title">'.esc_html__( 'Colors', 'hello-shoppable' ).'</div>'
	    ),
	    'priority'	  => 60,
	    'active_callback' => array(
	    	array(
				'setting'  => 'footer_widget_tab',
				'operator' => '==',
				'value'    => 'footer_widget_style_tab',
			),
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Background Color', 'hello-shoppable' ),
		'description'  => esc_html__( 'It can be used as a transparent background color over image.', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'top_footer_background_color',
		'section'      => 'footer_widgets_options',
		'default'      => '',
		'priority'	   => 70,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'footer_widget_tab',
				'operator' => '==',
				'value'    => 'footer_widget_style_tab',
			),
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Widget Title Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'top_footer_widget_title_color',
		'section'      => 'footer_widgets_options',
		'default'      => '#030303',
		'priority'	   => 80,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'footer_widget_tab',
				'operator' => '==',
				'value'    => 'footer_widget_style_tab',
			),
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Widgets Link Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'top_footer_widget_link_color',
		'section'      => 'footer_widgets_options',
		'default'      => '#656565',
		'priority'	   => 90,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'footer_widget_tab',
				'operator' => '==',
				'value'    => 'footer_widget_style_tab',
			),
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Widgets Content Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'top_footer_widget_content_color',
		'section'      => 'footer_widgets_options',
		'default'      => '#656565',
		'priority'	   => 100,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'footer_widget_tab',
				'operator' => '==',
				'value'    => 'footer_widget_style_tab',
			),
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Widgets Link Hover Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'top_footer_widget_link_hover_color',
		'section'      => 'footer_widgets_options',
		'default'      => '#2154ac',
		'priority'	   => 110,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'footer_widget_tab',
				'operator' => '==',
				'value'    => 'footer_widget_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'top_footer_typography_border',
	    'section'     => 'footer_widgets_options',
	    'default'  => wp_kses( '<hr class="customizer_separator">', array(
			    'hr' => array(
			      'class' => array(),
			    ),
		  	)
		),
	    'priority'	  => 115,
	    'active_callback' => array(
			array(
				'setting'  => 'footer_widget_tab',
				'operator' => '==',
				'value'    => 'footer_widget_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Widget Title Typography', 'hello-shoppable' ),
		'type'         => 'typography',
		'settings'     => 'footer_widget_title_font_control',
		'section'      => 'footer_widgets_options',
		'default'  => array(
			'font-family'     => 'Inter',
			'variant'         => '500',
			'font-style'      => 'normal',
			'font-size'       => '18px',
			'text-transform'  => 'none',
			'line-height'     => '1.3',
			'letter-spacing'  => '0',
			'text-decoration' => 'none',
			'text-align'      => '',
		),
		'priority'	  => 120,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.site-footer .widget .widget-title',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'footer_widget_tab',
				'operator' => '==',
				'value'    => 'footer_widget_style_tab',
			),
		),
	) );

	// Responsive
	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'footer_responsive_separator',
	    'section'     => 'footer_widgets_options',
	    'default'     => esc_html__( 'Responsive', 'hello-shoppable' ),
	    'priority'	  => 140,
	    'active_callback' => array(
			array(
				'setting'  => 'footer_widget_tab',
				'operator' => '==',
				'value'    => 'footer_widget_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Footer Widget Area', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'responsive_footer_widget',
		'section'     => 'footer_widgets_options',
		'default'     => true,
		'priority'	  => 150,
		'active_callback' => array(
			array(
				'setting'  => 'footer_widget_tab',
				'operator' => '==',
				'value'    => 'footer_widget_general_tab',
			),
			array(
				'setting'  => 'footer_widget',
				'operator' => '=',
				'value'    => true,
			),
		),
	) );

	// Footer Copyright Options
	Kirki::add_section( 'footer_copyright_options', array(
	    'title'          => esc_html__( 'Copyright Area', 'hello-shoppable' ),
	    'panel'          => 'footer_options',
	    'capability'     => 'edit_theme_options',
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'type'        => 'radio-buttonset',
		'settings'    => 'footer_copyright_tab',
		'section'     => 'footer_copyright_options',
		'default'     => 'copyright_general_tab',
		'choices'  => array(
			'copyright_general_tab'     => esc_html__( 'General', 'hello-shoppable' ),
			'copyright_style_tab'     	=> esc_html__( 'Style', 'hello-shoppable' ),
		),
		'transport'	   => 'postMessage',
		'priority'	   => 10,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Footer Elements', 'hello-shoppable' ),
		'type'         => 'sortable',
		'settings'     => 'footer_sortable',
		'section'      => 'footer_copyright_options',
		'default'      => '',
		'priority'	   => 20,
		'choices'      => apply_filters( 'hello_shoppable_footer_sortable_filter', array(
			'hello_shoppable_footer_social' 	=> esc_html__( 'Social Profile', 'hello-shoppable' ),
			'hello_shoppable_footer_menu' 	=> esc_html__( 'Footer Menu', 'hello-shoppable' ),
			'hello_shoppable_footer_logo' 	=> esc_html__( 'Footer Logo', 'hello-shoppable' ),
		) ),
		'active_callback' => array(
			array(
				'setting'  => 'footer_copyright_tab',
				'operator' => '==',
				'value'    => 'copyright_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Copyright Vertical Position', 'hello-shoppable' ),
		'type'        => 'radio-buttonset',
		'settings'    => 'copyright_vertical_alignment',
		'section'     => 'footer_copyright_options',
		'default'     => 'none',
		'choices'  => array(
			'none' 			=> esc_html__( 'None', 'hello-shoppable' ),
			'top' 			=> esc_html__( 'Top', 'hello-shoppable' ),
			'bottom' 		=> esc_html__( 'Bottom', 'hello-shoppable' ),
		),
		'priority'	   => 30,
		'active_callback' => array(
			array(
				'setting'  => 'footer_copyright_tab',
				'operator' => '==',
				'value'    => 'copyright_general_tab',
			),
			array(
		        'setting'  => 'footer_sortable',
		        'operator' => 'contains',
		        'value'    => array( 'hello_shoppable_footer_social', 'hello_shoppable_footer_menu', 'hello_shoppable_footer_logo' ),
		    ),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Copyright Horizontal Position', 'hello-shoppable' ),
		'type'        => 'radio-buttonset',
		'settings'    => 'copyright_horizontal_alignment',
		'section'     => 'footer_copyright_options',
		'default'     => 'left',
		'choices'  => array(
			'left' 			=> esc_html__( 'Left', 'hello-shoppable' ),
			'right' 		=> esc_html__( 'Right', 'hello-shoppable' ),
		),
		'priority'	   => 35,
		'active_callback' => array(
			array(
				'setting'  => 'footer_copyright_tab',
				'operator' => '==',
				'value'    => 'copyright_general_tab',
			),
			array(
				'setting'  => 'copyright_vertical_alignment',
				'operator' => '==',
				'value'    => 'none',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'footer_social_separator',
	    'section'     => 'footer_copyright_options',
	    'default'     => esc_html__( 'Social Profiles Options', 'hello-shoppable' ),
	    'priority'	   => 37,
	    'active_callback' => array(
	    	array(
				'setting'  => 'footer_sortable',
				'operator' => 'contains',
				'value'    => array( 'hello_shoppable_footer_social' ),
			),
			array(
				'setting'  => 'footer_copyright_tab',
				'operator' => '==',
				'value'    => 'copyright_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Social Profiles', 'hello-shoppable' ),
		'type'        => 'repeater',
		'section'     => 'footer_copyright_options',
		'row_label' => array(
			'type'  => 'text',
			'value' => esc_html__( 'Social Profile', 'hello-shoppable' ),
		),
		'settings' => 'footer_social_profile_links',
		'default' => array(
			array(
				'icon' 		=> '',
				'link' 		=> '',
				'target' 	=> true,
				),		
		),
		'priority'	  => 40,
		'fields' => array(
			'icon' => array(
				'label'       => esc_html__( 'Fontawesome Icon', 'hello-shoppable' ),
				'type'        => 'text',
				'description' => esc_html__( 'Input Icon name. For Example:- fab fa-facebook For more icons https://fontawesome.com/icons?d=gallery&m=free', 'hello-shoppable' ),
			),
			'link' => array(
				'label'       => esc_html__( 'Link', 'hello-shoppable' ),
				'type'        => 'text',
			),
			'target' => array(
				'label'       => esc_html__( 'Open Link in New Window', 'hello-shoppable' ),
				'type'        => 'checkbox',
				'default' 	  => true,
			),			
		),
		'choices' => array(
			'limit' => 20,
		),
		'active_callback' => array(
			array(
				'setting'  => 'footer_sortable',
				'operator' => 'contains',
				'value'    => array( 'hello_shoppable_footer_social' ),
			),
			array(
				'setting'  => 'footer_copyright_tab',
				'operator' => '==',
				'value'    => 'copyright_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'footer_logo_separator',
	    'section'     => 'footer_copyright_options',
	    'default'     => esc_html__( 'Footer Logo Options', 'hello-shoppable' ),
	    'priority'	   => 45,
	    'active_callback' => array(
	    	array(
				'setting'  => 'footer_sortable',
				'operator' => 'contains',
				'value'    => array( 'hello_shoppable_footer_logo' ),
			),
			array(
				'setting'  => 'footer_copyright_tab',
				'operator' => '==',
				'value'    => 'copyright_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Select Image', 'hello-shoppable' ),
		'type'         => 'image',
		'settings'     => 'bottom_footer_image',
		'section'      => 'footer_copyright_options',
		'default'      => '',
		'choices'     => array(
			'save_as' => 'id',
		),
		'priority'	   => 50,
		'active_callback' => array(
			array(
				'setting'  => 'footer_sortable',
				'operator' => 'contains',
				'value'    => array( 'hello_shoppable_footer_logo' ),
			),
			array(
				'setting'  => 'footer_copyright_tab',
				'operator' => '==',
				'value'    => 'copyright_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Choose Image Size', 'hello-shoppable' ),
		'type'        => 'select',
		'settings'    => 'render_bottom_footer_image_size',
		'section'     => 'footer_copyright_options',
		'default'     => 'full',
		'placeholder' => esc_html__( 'Select Image Size', 'hello-shoppable' ),
		'choices'     => hello_shoppable_get_intermediate_image_sizes(),
		'priority'	  => 55,
		'active_callback' => array(
			array(
				'setting'  => 'footer_sortable',
				'operator' => 'contains',
				'value'    => array( 'hello_shoppable_footer_logo' ),
			),
			array(
				'setting'  => 'footer_copyright_tab',
				'operator' => '==',
				'value'    => 'copyright_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'    => esc_html__( 'Image Link', 'hello-shoppable' ),
		'type'     => 'link',
		'settings' => 'bottom_footer_image_link',
		'section'  => 'footer_copyright_options',
		'default'  => '',
		'priority' => 60,
		'active_callback' => array(
			array(
				'setting'  => 'footer_sortable',
				'operator' => 'contains',
				'value'    => array( 'hello_shoppable_footer_logo' ),
			),
			array(
				'setting'  => 'footer_copyright_tab',
				'operator' => '==',
				'value'    => 'copyright_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'    => esc_html__( 'Open in New Window', 'hello-shoppable' ),
		'description' => esc_html__( 'If enabled, the link will be open in an another browser window.', 'hello-shoppable' ),
		'type'     => 'toggle',
		'settings' => 'bottom_footer_image_target',
		'section'  => 'footer_copyright_options',
		'default'  => true,
		'priority' => 70,
		'active_callback' => array(
			array(
				'setting'  => 'footer_sortable',
				'operator' => 'contains',
				'value'    => array( 'hello_shoppable_footer_logo' ),
			),
			array(
				'setting'  => 'footer_copyright_tab',
				'operator' => '==',
				'value'    => 'copyright_general_tab',
			),
		),
	) );

	// Footer styles
	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Footer Full Width', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'enable_footer_full_width',
		'section'     => 'footer_copyright_options',
		'default'     => false,
		'priority'	  => 95,
		'active_callback' => array(
			array(
				'setting'  => 'footer_copyright_tab',
				'operator' => '==',
				'value'    => 'copyright_style_tab',
			),
		),
	) );

	new \Kirki\Field\Dimensions(
		[
			'settings'    => 'bottom_footer_padding',
			'label'       => esc_html__( 'Padding', 'hello-shoppable' ),
			'section'     => 'footer_copyright_options',
			'default'     => [
				'padding-top'    => '30px',
				'padding-bottom' => '30px',
			],
			'choices'     => [
				'labels' => [
					'padding-top'  		=> esc_html__( 'Top', 'hello-shoppable' ),
					'padding-bottom'	=> esc_html__( 'Bottom', 'hello-shoppable' ),
				],
			],
			'priority'    => 100,
			'transport'   => 'auto',
			'output'      => [
				[
					'choice'      => 'padding-top',
			      	'element'     => '.bottom-footer',
			    	'property'    => 'padding-top',
				],
				[
					'choice'      => 'padding-bottom',
			      	'element'     => '.bottom-footer',
			    	'property'    => 'padding-bottom',
				]
			],
			'active_callback' => [
				[
					'setting'  => 'footer_copyright_tab',
					'operator' => '==',
					'value'    => 'copyright_style_tab',
				]
			], 
		]
	);

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Social Profiles Size', 'hello-shoppable' ),
		'type'        => 'slider',
		'settings'    => 'social_icons_size',
		'section'     => 'footer_copyright_options',
		'transport'   => 'postMessage',
		'default'     => 15,
		'choices'     => array(
			'min'  => 10,
			'max'  => 100,
			'step' => 1,
		),
		'priority'	  => 105,
		'active_callback' => array(
			array(
				'setting'  => 'footer_sortable',
				'operator' => 'contains',
				'value'    => array( 'hello_shoppable_footer_social' ),
			),
			array(
				'setting'  => 'footer_copyright_tab',
				'operator' => '==',
				'value'    => 'copyright_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Logo Width', 'hello-shoppable' ),
		'type'         => 'slider',
		'settings'     => 'bottom_footer_image_width',
		'section'      => 'footer_copyright_options',
		'transport'    => 'postMessage',
		'default'      => 270,
		'choices'      => array(
			'min'  => 10,
			'max'  => 1140,
			'step' => 5,
		),
		'priority'	   => 110,
		'active_callback' => array(
			array(
				'setting'  => 'footer_sortable',
				'operator' => 'contains',
				'value'    => array( 'hello_shoppable_footer_logo' ),
			),
			array(
				'setting'  => 'footer_copyright_tab',
				'operator' => '==',
				'value'    => 'copyright_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'bottom_footer_color_border',
	    'section'     => 'footer_copyright_options',
	    'default'  => wp_kses( '<hr class="customizer_separator">', array(
			    'hr' => array(
			      'class' => array(),
			    ),
		  	)
		),
	    'priority'	  => 125,
	    'active_callback' => array(
			array(
				'setting'  => 'footer_copyright_tab',
				'operator' => '==',
				'value'    => 'copyright_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'bottom_footer_colors_title',
	    'section'     => 'footer_copyright_options',
	    'default'  	  => wp_kses_post(
	    	'<div class="customizer_separator_title">'.esc_html__( 'Colors', 'hello-shoppable' ).'</div>'
	    ),
	    'priority'	  => 130,
	    'active_callback' => array(
	    	array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'footer_copyright_tab',
				'operator' => '==',
				'value'    => 'copyright_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Background Color', 'hello-shoppable' ),
		'description'  => esc_html__( 'It can be used as a transparent background color over image.', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'bottom_footer_background_color',
		'section'      => 'footer_copyright_options',
		'default'      => '',
		'priority'	   => 140,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'footer_copyright_tab',
				'operator' => '==',
				'value'    => 'copyright_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Text Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'bottom_footer_text_color',
		'section'      => 'footer_copyright_options',
		'default'      => '#656565',
		'priority'	   => 150,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'footer_copyright_tab',
				'operator' => '==',
				'value'    => 'copyright_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Text Link Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'bottom_footer_text_link_color',
		'section'      => 'footer_copyright_options',
		'default'      => '#383838',
		'priority'	   => 160,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'footer_copyright_tab',
				'operator' => '==',
				'value'    => 'copyright_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Text Link Hover Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'bottom_footer_text_link_hover_color',
		'section'      => 'footer_copyright_options',
		'default'      => '#2154ac',
		'priority'	   => 170,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'footer_copyright_tab',
				'operator' => '==',
				'value'    => 'copyright_style_tab',
			),
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'bottom_footer_typography_border',
	    'section'     => 'footer_copyright_options',
	    'default'  => wp_kses( '<hr class="customizer_separator">', array(
			    'hr' => array(
			      'class' => array(),
			    ),
		  	)
		),
	    'priority'	  => 175,
	    'active_callback' => array(
			array(
				'setting'  => 'footer_copyright_tab',
				'operator' => '==',
				'value'    => 'copyright_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Copyright Area Typography', 'hello-shoppable' ),
		'type'         => 'typography',
		'settings'     => 'footer_style_font_control',
		'section'      => 'footer_copyright_options',
		'default'  => array(
			'font-family'     => 'Inter',
			'variant'         => 'regular',
			'font-style'      => 'normal',
			'font-size'       => '14px',
			'line-height'     => '1.6',
			'letter-spacing'  => '0',
			'text-transform'  => 'none',
			'text-decoration' => 'none',
			'text-align'      => '',
		),
		'priority'	  => 180,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => array( '.site-footer .site-info', '.site-footer .footer-menu ul li a' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'footer_copyright_tab',
				'operator' => '==',
				'value'    => 'copyright_style_tab',
			),
		),
	) );

	// Responsive
	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'copyright_responsive_separator',
	    'section'     => 'footer_copyright_options',
	    'default'     => esc_html__( 'Responsive', 'hello-shoppable' ),
	    'priority'	  => 190,
	    'active_callback' => array(
			array(
				'setting'  => 'footer_copyright_tab',
				'operator' => '==',
				'value'    => 'copyright_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Social Profiles', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'mobile_social_icons_footer',
		'section'     => 'footer_copyright_options',
		'default'     => true,
		'priority'	  => 200,
		'active_callback' => array(
			array(
				'setting'  => 'footer_copyright_tab',
				'operator' => '==',
				'value'    => 'copyright_general_tab',
			),
			array(
				'setting'  => 'footer_sortable',
				'operator' => 'contains',
				'value'    => array( 'hello_shoppable_footer_social' ),
			),
		),
	) );

	// Blog Homepage Options
	Kirki::add_panel( 'blog_homepage_options', array(
	    'title' => esc_html__( 'Blog', 'hello-shoppable' ),
	    'priority' => 80,
	) );

	// Main Banner / Post Slider 
	Kirki::add_section( 'main_slider_options', array(
	    'title'          => esc_html__( 'Homepage Hero', 'hello-shoppable' ),
	    'panel'          => 'blog_homepage_options',
	    'capability'     => 'edit_theme_options',
	    'priority'       => '10',
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'type'        => 'radio-buttonset',
		'settings'    => 'hero_tab',
		'section'     => 'main_slider_options',
		'default'     => 'hero_general_tab',
		'choices'  => array(
			'hero_general_tab'   => esc_html__( 'General', 'hello-shoppable' ),
			'hero_style_tab'     => esc_html__( 'Style', 'hello-shoppable' ),
		),
		'transport'	   => 'postMessage',
		'priority'	   => 10,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Display Options', 'hello-shoppable' ),
		'type'        => 'radio-buttonset',
		'settings'    => 'main_slider_controls',
		'section'     => 'main_slider_options',
		'default'     => 'slider',
		'choices'  => array(
			'slider' 			=> esc_html__( 'Slider', 'hello-shoppable' ),
			'banner' 			=> esc_html__( 'Banner', 'hello-shoppable' ),
			'no_slider_banner' 	=> esc_html__( 'None', 'hello-shoppable' ),
		),
		'priority'	   => 20,
		'active_callback' => array(
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_general_tab',
			),
		),
	) );

	// Slider settings

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Slider Layout', 'hello-shoppable' ),
		'description' => esc_html__( 'Select layout & scroll below to change its options', 'hello-shoppable' ),
		'type'        => 'radio-image',
		'settings'    => 'main_slider_layout',
		'section'     => 'main_slider_options',
		'default'     => 'main_slider_one',
		'choices'     => apply_filters( 'hello_shoppable_slider_layout_filter', array(
			'main_slider_one'    => array(
				'src'	=> get_template_directory_uri() . '/assets/images/slider-layout-1.svg',
				'alt'	=> esc_html__( 'Slider One', 'hello-shoppable' )
			),
			'main_slider_two'    => array( 
				'src'	=> get_template_directory_uri() . '/assets/images/slider-layout-2.svg',
				'alt'	=> esc_html__( 'Slider Two', 'hello-shoppable' )
			),
			'main_slider_three'  => array(
				'src'	=> get_template_directory_uri() . '/assets/images/slider-layout-3.svg',
				'alt'	=> esc_html__( 'Slider Three', 'hello-shoppable' )
			)
		) ),
		'priority'	   => 30,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Slider Columns', 'hello-shoppable' ),
		'type'        => 'select',
		'settings'    => 'slider_column_controls',
		'section'     => 'main_slider_options',
		'default'     => '2',
		'choices'  => array(
			'1' => esc_html__( '1 Column', 'hello-shoppable' ),
			'2' => esc_html__( '2 Columns', 'hello-shoppable' ),
			'3' => esc_html__( '3 Columns', 'hello-shoppable' ),
			'4' => esc_html__( '4 Columns', 'hello-shoppable' ),
		),
		'priority'	   => 40,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_general_tab',
			),
			array(
				'setting'  => 'main_slider_layout',
				'operator' => '==',
				'value'    => array( 'main_slider_three' ),
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Slider Type', 'hello-shoppable' ),
		'type'        => 'radio-buttonset',
		'settings'    => 'slider_type',
		'section'     => 'main_slider_options',
		'default'     => 'category',
		'choices'     => array(
			'category'	=> esc_html__( 'Category', 'hello-shoppable' ),
			'page'		=> esc_html__( 'Page', 'hello-shoppable' ),
		),
		'priority'	  => 45,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Choose Category', 'hello-shoppable' ),
		'description' => esc_html__( 'Recent posts will show if any category is not chosen. Recommended posts containing feature images size with 1920x940 pixel.', 'hello-shoppable' ),
		'type'        => 'select',
		'settings'    => 'slider_category',
		'section'     => 'main_slider_options',
		'default'     => '',
		'placeholder' => esc_html__( 'Select category', 'hello-shoppable' ),
		'choices'     => hello_shoppable_get_post_categories(),
		'priority'	  => 50,
		'multiple'	  => 5,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_general_tab',
			),
			array(
				'setting'  => 'slider_type',
				'operator' => '==',
				'value'    => 'category',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Choose Pages', 'hello-shoppable' ),
		'description' => esc_html__( 'Recent pages will show if any category is not chosen. Recommended pages containing feature images size with 1920x940 pixel.', 'hello-shoppable' ),
		'type'        => 'select',
		'settings'    => 'slider_pages',
		'section'     => 'main_slider_options',
		'default'     => '',
		'placeholder' => esc_html__( 'Select Pages', 'hello-shoppable' ),
		'choices'     => hello_shoppable_get_pages(),
		'priority'	  => 55,
		'multiple'	  => 20,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_general_tab',
			),
			array(
				'setting'  => 'slider_type',
				'operator' => '==',
				'value'    => 'page',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Choose Image Size', 'hello-shoppable' ),
		'type'        => 'select',
		'settings'    => 'render_slider_image_size',
		'section'     => 'main_slider_options',
		'default'     => '',
		'placeholder' => esc_html__( 'Select Image Size', 'hello-shoppable' ),
		'choices'     => hello_shoppable_get_intermediate_image_sizes(),
		'priority'	  => 60,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Post View Number', 'hello-shoppable' ),
		'description'  => esc_html__( 'Number of posts to show.', 'hello-shoppable' ),
		'type'         => 'number',
		'settings'     => 'slider_posts_number',
		'section'      => 'main_slider_options',
		'default'      => 6,
		'choices' => array(
				'min' => '1',
				'max' => '20',
				'step' => '1',
		),
		'priority'	   => 75,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_general_tab',
			),
			array(
				'setting'  => 'slider_type',
				'operator' => '==',
				'value'    => 'category',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Slide Effect', 'hello-shoppable' ),
		'type'        => 'radio-buttonset',
		'settings'    => 'main_slider_effect',
		'section'     => 'main_slider_options',
		'default'     => 'fade',
		'choices'  => array(
			'fade'             => esc_html__( 'Fade', 'hello-shoppable' ),
			'horizontal-slide' => esc_html__( 'Slide', 'hello-shoppable' ),
		),
		'priority'	   => 80,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_general_tab',
			),
			array(
				'setting'  => 'main_slider_layout',
				'operator' => 'contains',
				'value'    => array( 'main_slider_one', 'main_slider_two' ),
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Fade Control Time ( in sec )', 'hello-shoppable' ),
		'type'         => 'number',
		'settings'     => 'slider_fade_control',
		'section'      => 'main_slider_options',
		'default'      => 5,
		'choices' => array(
				'min' => '3',
				'max' => '60',
				'step'=> '1',
		),
		'priority'	   => 90,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_general_tab',
			),
			array(
				'setting'  => 'main_slider_effect',
				'operator' => '==',
				'value'    => 'fade',
			),
			array(
				'setting'  => 'main_slider_layout',
				'operator' => 'contains',
				'value'    => array( 'main_slider_one', 'main_slider_two' ),
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Arrows', 'hello-shoppable' ),
		'type'         => 'toggle',
		'settings'     => 'slider_arrows',
		'section'      => 'main_slider_options',
		'default'      => true,
		'priority'	   => 100,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Dots', 'hello-shoppable' ),
		'type'         => 'toggle',
		'settings'     => 'slider_dots',
		'section'      => 'main_slider_options',
		'default'      => true,
		'priority'	   => 110,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Auto Play', 'hello-shoppable' ),
		'type'         => 'toggle',
		'settings'     => 'slider_autoplay',
		'section'      => 'main_slider_options',
		'default'      => false,
		'priority'	   => 120,		
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Auto Play Timeout ( in sec )', 'hello-shoppable' ),
		'type'         => 'number',
		'settings'     => 'slider_autoplay_speed',
		'section'      => 'main_slider_options',
		'default'      => 4,
		'choices' => array(
				'min' => '1',
				'max' => '60',
				'step'=> '1',
		),
		'priority'	   => 130,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'slider_autoplay',
				'operator' => '==',
				'value'	   => true,
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Title', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'slider_title',
		'section'     => 'main_slider_options',
		'default'     => true,
		'priority'	  => 150,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Category', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'hero_slider_category',
		'section'     => 'main_slider_options',
		'default'     => true,
		'priority'	  => 160,	
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_general_tab',
			),
			array(
				'setting'  => 'slider_type',
				'operator' => '==',
				'value'    => 'category',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Date', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'slider_date',
		'section'     => 'main_slider_options',
		'default'     => true,
		'priority'	  => 170,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Author', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'slider_author',
		'section'     => 'main_slider_options',
		'default'     => true,
		'priority'	  => 180,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Comments Link', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'slider_comment',
		'section'     => 'main_slider_options',
		'default'     => true,
		'priority'	  => 190,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_general_tab',
			),
			array(
				'setting'  => 'slider_type',
				'operator' => '==',
				'value'    => 'category',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Excerpt', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'slider_excerpt',
		'section'     => 'main_slider_options',
		'default'     => true,
		'priority'	  => 200,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Excerpt Length', 'hello-shoppable' ),
		'type'        => 'number',
		'settings'    => 'slider_excerpt_length',
		'section'     => 'main_slider_options',
		'default'     => 25,
		'choices' => array(
			'min' => '5',
			'max' => '100',
			'step' => '5',
		),
		'priority'	  => 210,
		'active_callback' => array(
			array(
				'setting'  => 'slider_excerpt',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'slider_button_separator',
	    'section'     => 'main_slider_options',
	    'default'     => esc_html__( 'Slider Button Options', 'hello-shoppable' ),
	    'priority'	  => 215,
	    'active_callback' => array(
	    	array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_general_tab',
			),
		),
	) );

	#Slider Button
	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Button', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'hero_slider_button',
		'section'     => 'main_slider_options',
		'default'     => true,
		'priority'	  => 220,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Text', 'hello-shoppable' ),
		'type'         => 'text',
		'settings'     => 'slider_button_text',
		'section'      => 'main_slider_options',
		'default'      => '',
		'priority'	   => 222,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_general_tab',
			),
			array(
				'setting'  => 'hero_slider_button',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Link', 'hello-shoppable' ),
		'type'         => 'text',
		'settings'     => 'slider_button_link',
		'section'      => 'main_slider_options',
		'default'      => '',
		'priority'	   => 224,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_general_tab',
			),
			array(
				'setting'  => 'hero_slider_button',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );


	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Open Link in New Window', 'hello-shoppable' ),
		'type'         => 'toggle',
		'settings'     => 'slider_new_window_button_target',
		'section'      => 'main_slider_options',
		'default'      => true,
		'priority'	   => 226,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_general_tab',
			),
			array(
				'setting'  => 'hero_slider_button',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Slider Columns Space', 'hello-shoppable' ),
		'type'        => 'slider',
		'settings'    => 'slider_column_space_controls',
		'section'     => 'main_slider_options',
		'transport'   => 'postMessage',
		'default'     => 5,
		'choices'     => array(
			'min'  => 0,
			'max'  => 15,
			'step' => 1,
		),
		'priority'	   => 240,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_style_tab',
			),
			array(
				'setting'  => 'main_slider_layout',
				'operator' => '==',
				'value'    => array( 'main_slider_three' ),
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Height (in px)', 'hello-shoppable' ),
		'description' => esc_html__( 'This option will only apply to Desktop. Please click on below Desktop Icon to see changes. Automatically adjust by theme default in the responsive devices.
		', 'hello-shoppable' ),
		'type'        => 'slider',
		'settings'    => 'main_slider_height',
		'section'     => 'main_slider_options',
		'transport'   => 'postMessage',
		'default'     => 550,
		'choices'     => array(
			'min'  => 50,
			'max'  => 1500,
			'step' => 10,
		),
		'priority'	   => 245,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Image Overlay Opacity', 'hello-shoppable' ),
		'type'        => 'slider',
		'settings'    => 'hero_slider_overlay_opacity',
		'section'     => 'main_slider_options',
		'default'     => 7,
		'choices'     => array(
			'min'  => 0,
			'max'  => 9,
			'step' => 1,
		),
		'priority'	   => 250,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Background Image Size', 'hello-shoppable' ),
		'type'         => 'radio-buttonset',
		'settings'     => 'main_slider_image_size',
		'section'      => 'main_slider_options',
		'default'      => 'cover',
		'choices'      => array(
			'cover'    => esc_html__( 'Cover', 'hello-shoppable' ),
			'pattern'  => esc_html__( 'Repeat', 'hello-shoppable' ),
			'norepeat' => esc_html__( 'No Repeat', 'hello-shoppable' ),
		),
		'priority'	   => 260,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Content Horizontal Alignment', 'hello-shoppable' ),
		'type'        => 'radio-buttonset',
		'settings'    => 'main_slider_content_alignment',
		'section'     => 'main_slider_options',
		'default'     => 'center',
		'choices'  => array(
			'left'   => esc_html__( 'Left', 'hello-shoppable' ),
			'center' => esc_html__( 'Center', 'hello-shoppable' ),
			'right'  => esc_html__( 'Right', 'hello-shoppable' ),
		),
		'priority'	   => 270,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Content Vertical Alignment', 'hello-shoppable' ),
		'type'        => 'radio-buttonset',
		'settings'    => 'banner_slider_content_alignment',
		'section'     => 'main_slider_options',
		'default'     => 'align-center',
		'choices'  => array(
			'align-top'     => esc_html__( 'Top', 'hello-shoppable' ),
			'align-center'  => esc_html__( 'Center', 'hello-shoppable' ),
			'align-bottom'  => esc_html__( 'Bottom', 'hello-shoppable' ),
		),
		'priority'	   => 280,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Width Controls', 'hello-shoppable' ),
		'type'        => 'radio-buttonset',
		'settings'    => 'slider_width_controls',
		'section'     => 'main_slider_options',
		'default'     => 'full',
		'choices'  => array(
			'full'   => esc_html__( 'Full', 'hello-shoppable' ),
			'boxed'  => esc_html__( 'Boxed', 'hello-shoppable' ),
		),
		'priority'	   => 290,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'main_slider_typography_border',
	    'section'     => 'main_slider_options',
	    'default'  => wp_kses( '<hr class="customizer_separator">', array(
			    'hr' => array(
			      'class' => array(),
			    ),
		  	)
		),
	    'priority'	  => 320,
	    'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Title Typography', 'hello-shoppable' ),
		'type'         => 'typography',
		'settings'     => 'main_slider_title_font_control',
		'section'      => 'main_slider_options',
		'default'  => array(
			'font-family'     => 'Inter',
			'variant'         => '600',
			'font-style'      => 'normal',
			'font-size'       => '50px',
			'line-height'     => '1.3',
			'letter-spacing'  => '0',
			'text-transform'  => 'uppercase',
			'text-decoration' => 'none',
			'text-align'      => '',
		),
		'priority'	  => 322,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.section-banner .banner-content .entry-title',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_style_tab',
			),
			array(
				'setting'  => 'slider_title',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'main_slider_title_space',
	    'section'     => 'main_slider_options',
	    'default'     => wp_kses_post( '<span class="typography_spacer"></span>' ),
	    'priority'	  => 325,
	    'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_style_tab',
			),
			array(
				'setting'  => 'slider_title',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Category Typography', 'hello-shoppable' ),
		'type'         => 'typography',
		'settings'     => 'main_slider_cat_font_control',
		'section'      => 'main_slider_options',
		'default'  => array(
			'font-family'     => 'Inter',
			'variant'         => 'regular',
			'font-style'      => 'normal',
			'font-size'       => '15px',
			'line-height'     => '1.2',
			'letter-spacing'  => '0',
			'text-transform'  => 'uppercase',
			'text-decoration' => 'none',
			'text-align'      => '',
		),
		'priority'	  => 330,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.section-banner .banner-content .entry-header .cat-links a',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_style_tab',
			),
			array(
				'setting'  => 'hero_slider_category',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'slider_type',
				'operator' => '==',
				'value'    => 'category',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'main_slider_cat_space',
	    'section'     => 'main_slider_options',
	    'default'     => wp_kses_post( '<span class="typography_spacer"></span>' ),
	    'priority'	  => 335,
	    'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_style_tab',
			),
			array(
				'setting'  => 'hero_slider_category',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'slider_type',
				'operator' => '==',
				'value'    => 'category',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Meta Typography', 'hello-shoppable' ),
		'type'         => 'typography',
		'settings'     => 'main_slider_meta_font_control',
		'section'      => 'main_slider_options',
		'default'  => array(
			'font-family'     => 'Inter',
			'variant'         => 'regular',
			'font-style'      => 'normal',
			'font-size'       => '13px',
			'line-height'     => '1.6',
			'letter-spacing'  => '0',
			'text-transform'  => 'capitalize',
			'text-decoration' => 'none',
			'text-align'      => '',
		),
		'priority'	  => 340,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.section-banner .banner-content .entry-meta a',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_style_tab',
			),
			array(
				array(
				'setting'  => 'slider_date',
				'operator' => '==',
				'value'    => true,
				),
				array(
				'setting'  => 'slider_author',
				'operator' => '==',
				'value'    => true,
				),
				array(
				'setting'  => 'slider_comment',
				'operator' => '==',
				'value'    => true,
				),
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'main_slider_meta_space',
	    'section'     => 'main_slider_options',
	    'default'     => wp_kses_post( '<span class="typography_spacer"></span>' ),
	    'priority'	  => 345,
	    'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_style_tab',
			),
			array(
				array(
				'setting'  => 'slider_date',
				'operator' => '==',
				'value'    => true,
				),
				array(
				'setting'  => 'slider_author',
				'operator' => '==',
				'value'    => true,
				),
				array(
				'setting'  => 'slider_comment',
				'operator' => '==',
				'value'    => true,
				),
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Excerpt Typography', 'hello-shoppable' ),
		'type'         => 'typography',
		'settings'     => 'main_slider_excerpt_font_control',
		'section'      => 'main_slider_options',
		'default'  => array(
			'font-family'     => 'Inter',
			'variant'         => 'regular',
			'font-style'      => 'normal',
			'font-size'       => '15px',
			'line-height'     => '1.6',
			'text-transform'  => 'initial',
			'letter-spacing'  => '0',
			'text-decoration' => 'none',
			'text-align'      => '',
		),
		'priority'	  => 350,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.section-banner .banner-content .entry-text p',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_style_tab',
			),
			array(
				'setting'  => 'slider_excerpt',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'main_slider_excerpt_space',
	    'section'     => 'main_slider_options',
	    'default'     => wp_kses_post( '<span class="typography_spacer"></span>' ),
	    'priority'	  => 355,
	    'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_style_tab',
			),
			array(
				'setting'  => 'slider_excerpt',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Slider Button Typography', 'hello-shoppable' ),
		'type'         => 'typography',
		'settings'     => 'main_slider_button_font_control',
		'section'      => 'main_slider_options',
		'default'  => array(
			'font-family'     => 'Inter',
			'variant'         => '500',
			'font-style'      => 'normal',
			'font-size'       => '15px',
			'line-height'     => '1.6',
			'letter-spacing'  => '0',
			'text-transform'  => 'capitalize',
			'text-decoration' => 'none',
			'text-align'      => '',
		),
		'priority'	  => 360,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.section-banner .slide-inner .banner-content .button-container a',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'slider',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_style_tab',
			),
			array(
				'setting'  => 'hero_slider_button',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	// Banner settings

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Select Image', 'hello-shoppable' ),
		'description' => esc_html__( 'Recommended image size 1920x940 pixel.', 'hello-shoppable' ),
		'type'        => 'image',
		'settings'    => 'banner_image',
		'section'     => 'main_slider_options',
		'default'	  => '',
		'choices'     => array(
			'save_as' => 'id',
		),
		'priority'	   => 450,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_general_tab',
			),
		)
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Choose Image Size', 'hello-shoppable' ),
		'type'        => 'select',
		'settings'    => 'render_banner_image_size',
		'section'     => 'main_slider_options',
		'default'     => 'hello-shoppable-1920-550',
		'placeholder' => esc_html__( 'Select Image Size', 'hello-shoppable' ),
		'choices'     => hello_shoppable_get_intermediate_image_sizes(),
		'priority'	  => 460,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Background Image Size', 'hello-shoppable' ),
		'type'         => 'radio-buttonset',
		'settings'     => 'main_banner_image_size',
		'section'      => 'main_slider_options',
		'default'      => 'cover',
		'choices'      => array(
			'cover'    => esc_html__( 'Cover', 'hello-shoppable' ),
			'pattern'  => esc_html__( 'Repeat', 'hello-shoppable' ),
			'norepeat' => esc_html__( 'No Repeat', 'hello-shoppable' ),
		),
		'priority'	   => 470,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Title', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'hero_banner_title',
		'section'     => 'main_slider_options',
		'default'     => true,
		'priority'	  => 490,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Title', 'hello-shoppable' ),
		'type'        => 'text',
		'settings'    => 'banner_title',
		'section'     => 'main_slider_options',
		'default'     => '',
		'priority'	  => 500,
		'transport'	   => 'postMessage',
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_general_tab',
			),
			array(
				'setting'  => 'hero_banner_title',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Subtitle', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'hero_banner_subtitle',
		'section'     => 'main_slider_options',
		'default'     => true,
		'priority'	  => 510,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Subtitle', 'hello-shoppable' ),
		'type'        => 'text',
		'settings'    => 'banner_subtitle',
		'section'     => 'main_slider_options',
		'default'     => '',
		'priority'	  => 520,
		'transport'	   => 'postMessage',
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_general_tab',
			),
			array(
				'setting'  => 'hero_banner_subtitle',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'banner_button_separator',
	    'section'     => 'main_slider_options',
	    'default'     => esc_html__( 'Banner Button Options', 'hello-shoppable' ),
	    'priority'	  => 540,
	    'active_callback' => array(
	    	array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_general_tab',
			),
		),
	) );

	#Banner Buttons
	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Button', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'hero_banner_buttons',
		'section'     => 'main_slider_options',
		'default'     => true,
		'priority'	  => 542,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Text', 'hello-shoppable' ),
		'type'         => 'text',
		'settings'     => 'banner_button_text',
		'section'      => 'main_slider_options',
		'default'      => '',
		'priority'	   => 543,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_general_tab',
			),
			array(
				'setting'  => 'hero_banner_buttons',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Link', 'hello-shoppable' ),
		'type'         => 'text',
		'settings'     => 'banner_button_link',
		'section'      => 'main_slider_options',
		'default'      => '',
		'priority'	   => 545,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_general_tab',
			),
			array(
				'setting'  => 'hero_banner_buttons',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );


	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Open Link in New Window', 'hello-shoppable' ),
		'type'         => 'toggle',
		'settings'     => 'banner_new_window_button_target',
		'section'      => 'main_slider_options',
		'default'      => true,
		'priority'	   => 550,
	'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_general_tab',
			),
			array(
				'setting'  => 'hero_banner_buttons',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Height (in px)', 'hello-shoppable' ),
		'description' => esc_html__( 'This option will only apply to Desktop. Please click on below Desktop Icon to see changes. Automatically adjust by theme default in the responsive devices.
		', 'hello-shoppable' ),
		'type'        => 'slider',
		'settings'    => 'main_banner_height',
		'section'     => 'main_slider_options',
		'transport'   => 'postMessage',
		'default'     => 550,
		'choices'     => array(
			'min'  => 50,
			'max'  => 1500,
			'step' => 10,
		),
		'priority'	   => 570,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Image Overlay Opacity', 'hello-shoppable' ),
		'type'        => 'slider',
		'settings'    => 'hero_banner_overlay_opacity',
		'section'     => 'main_slider_options',
		'default'     => 7,
		'choices'     => array(
			'min'  => 0,
			'max'  => 9,
			'step' => 1,
		),
		'priority'	   => 580,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Background Image Size', 'hello-shoppable' ),
		'type'         => 'radio-buttonset',
		'settings'     => 'main_banner_image_size',
		'section'      => 'main_slider_options',
		'default'      => 'cover',
		'choices'      => array(
			'cover'    => esc_html__( 'Cover', 'hello-shoppable' ),
			'pattern'  => esc_html__( 'Repeat', 'hello-shoppable' ),
			'norepeat' => esc_html__( 'No Repeat', 'hello-shoppable' ),
		),
		'priority'	   => 590,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Content Alignment', 'hello-shoppable' ),
		'type'        => 'radio-buttonset',
		'settings'    => 'main_banner_content_alignment',
		'section'     => 'main_slider_options',
		'default'     => 'center',
		'choices'  => array(
			'left'   => esc_html__( 'Left', 'hello-shoppable' ),
			'center' => esc_html__( 'Center', 'hello-shoppable' ),
			'right'  => esc_html__( 'Right', 'hello-shoppable' ),
		),
		'priority'	   => 600,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Width Controls', 'hello-shoppable' ),
		'type'        => 'radio-buttonset',
		'settings'    => 'banner_width_controls',
		'section'     => 'main_slider_options',
		'default'     => 'full',
		'choices'  => array(
			'full'   => esc_html__( 'Full', 'hello-shoppable' ),
			'boxed'  => esc_html__( 'Boxed', 'hello-shoppable' ),
		),
		'priority'	   => 602,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'main_banner_typography_border',
	    'section'     => 'main_slider_options',
	    'default'  => wp_kses( '<hr class="customizer_separator">', array(
			    'hr' => array(
			      'class' => array(),
			    ),
		  	)
		),
	    'priority'	  => 608,
	    'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Title Typography', 'hello-shoppable' ),
		'type'         => 'typography',
		'settings'     => 'main_banner_title_font_control',
		'section'      => 'main_slider_options',
		'default'  => array(
			'font-family'     => 'Inter',
			'variant'         => '600',
			'font-style'      => 'normal',
			'font-size'       => '50px',
			'line-height'     => '1.3',
			'letter-spacing'  => '0',
			'text-transform'  => 'uppercase',
			'text-decoration' => 'none',
			'text-align'      => '',
		),
		'priority'	  => 610,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.section-banner .banner-content .entry-title',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_style_tab',
			),
			array(
				'setting'  => 'hero_banner_title',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'main_banner_title_space',
	    'section'     => 'main_slider_options',
	    'default'     => wp_kses_post( '<span class="typography_spacer"></span>' ),
	    'priority'	  => 615,
	    'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_style_tab',
			),
			array(
				'setting'  => 'hero_banner_title',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Subtitle Typography', 'hello-shoppable' ),
		'type'         => 'typography',
		'settings'     => 'main_banner_subtitle_font_control',
		'section'      => 'main_slider_options',
		'default'  => array(
			'font-family'     => 'Inter',
			'variant'         => 'regular',
			'font-style'      => 'normal',
			'font-size'       => '15px',
			'line-height'     => '1.6',
			'letter-spacing'  => '0',
			'text-transform'  => 'initial',
			'text-decoration' => 'none',
			'text-align'      => '',
		),
		'priority'	  => 620,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.section-banner .banner-content .entry-subtitle',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_style_tab',
			),
			array(
				'setting'  => 'hero_banner_subtitle',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'main_banner_subtitle_font_space',
	    'section'     => 'main_slider_options',
	    'default'     => wp_kses_post( '<span class="typography_spacer"></span>' ),
	    'priority'	  => 625,
	    'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_style_tab',
			),
			array(
				'setting'  => 'hero_banner_subtitle',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Banner Button Typography', 'hello-shoppable' ),
		'type'         => 'typography',
		'settings'     => 'main_banner_button_font_control',
		'section'      => 'main_slider_options',
		'default'  => array(
			'font-family'     => 'Inter',
			'variant'         => '500',
			'font-style'      => 'normal',
			'font-size'       => '15px',
			'line-height'     => '1.6',
			'letter-spacing'  => '0',
			'text-transform'  => 'capitalize',
			'text-decoration' => 'none',
			'text-align'      => '',
		),
		'priority'	  => 630,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.section-banner .banner-content .button-container a',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '==',
				'value'    => 'banner',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_style_tab',
			),
			array(
				'setting'  => 'hero_banner_buttons',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	// Responsive
	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'main_slider_responsive_separator',
	    'section'     => 'main_slider_options',
	    'default'     => esc_html__( 'Responsive', 'hello-shoppable' ),
	    'priority'	  => 640,
	    'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '!=',
				'value'    => 'no_slider_banner',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Homepage Hero', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'mobile_main_slider',
		'section'     => 'main_slider_options',
		'default'     => true,
		'priority'	  => 650,
		'active_callback' => array(
			array(
				'setting'  => 'main_slider_controls',
				'operator' => '!=',
				'value'    => 'no_slider_banner',
			),
			array(
				'setting'  => 'hero_tab',
				'operator' => '==',
				'value'    => 'hero_general_tab',
			),
		),
	) );

	// Blog advertisement banner
	Kirki::add_section( 'blog_advert_banner_options', array(
	    'title'          => esc_html__( 'Blog Advertisement Banner', 'hello-shoppable' ),
	    'panel'          => 'blog_homepage_options',
	    'capability'     => 'edit_theme_options',
	    'priority'       => '25',
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'    => esc_html__( 'Advertisement Banner ', 'hello-shoppable' ),
		'type'     => 'toggle',
		'settings' => 'enable_blog_advertisement_banner',
		'section'  => 'blog_advert_banner_options',
		'default'  => false,
		'priority' => 10,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Advertisement Banner', 'hello-shoppable' ),
		'description'  => esc_html__( 'Image dimensions 1230 by 100 pixels is recommended.', 'hello-shoppable' ),
		'type'         => 'image',
		'settings'     => 'blog_advertisement_banner',
		'section'      => 'blog_advert_banner_options',
		'default'      => '',
		'priority'	   => 20,
		'choices'     => array(
			'save_as' => 'id',
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Choose Image Size', 'hello-shoppable' ),
		'type'        => 'select',
		'settings'    => 'render_blog_ad_image_size',
		'section'     => 'blog_advert_banner_options',
		'default'     => 'full',
		'placeholder' => esc_html__( 'Select Image Size', 'hello-shoppable' ),
		'choices'     => hello_shoppable_get_intermediate_image_sizes(),
		'priority'	  => 30,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'    => esc_html__( 'Advertisement Banner Link', 'hello-shoppable' ),
		'type'     => 'link',
		'settings' => 'blog_advertisement_banner_link',
		'section'  => 'blog_advert_banner_options',
		'default'  => '#',
		'priority' => 40,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'    		=> esc_html__( 'Open in New Window', 'hello-shoppable' ),
		'description' 	=> esc_html__( 'If enabled, the link will be open in an another browser window.', 'hello-shoppable' ),
		'type'     		=> 'toggle',
		'settings' 		=> 'blog_advertisement_banner_target',
		'section'  		=> 'blog_advert_banner_options',
		'default'  		=> true,
		'priority' 		=> 50,
	) );

	// Responsive
	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'avertisement_banner_responsive_separator',
	    'section'     => 'blog_advert_banner_options',
	    'default'     => esc_html__( 'Responsive', 'hello-shoppable' ),
	    'priority'	  => 60,	
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Advertisement Banner', 'hello-shoppable' ),
		'type'         => 'toggle',
		'settings'     => 'enable_mobile_advertisement_banner',
		'section'      => 'blog_advert_banner_options',
		'default'      => false,
		'priority'	   => 70,
	) );

	// Blog Archives Options
	Kirki::add_section( 'latest_posts_options', array(
	    'title'          => esc_html__( 'Blog Archives', 'hello-shoppable' ),
	    'panel'          => 'blog_homepage_options',
	    'capability'     => 'edit_theme_options',
	    'priority'       => '30',
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'type'        => 'radio-buttonset',
		'settings'    => 'latest_posts_tab',
		'section'     => 'latest_posts_options',
		'default'     => 'latest_post_general_tab',
		'choices'  => array(
			'latest_post_general_tab'   => esc_html__( 'General', 'hello-shoppable' ),
			'latest_post_style_tab'     => esc_html__( 'Style', 'hello-shoppable' ),
		),
		'transport'	   => 'postMessage',
		'priority'	   => 10,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Latest Posts Section', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'enable_latest_posts_section',
		'section'     => 'latest_posts_options',
		'default'     => true,
		'priority'	  => 15,
		'active_callback' => array(
			array(
				'setting'  => 'latest_posts_tab',
				'operator' => '==',
				'value'    => 'latest_post_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Section Title', 'hello-shoppable' ),
		'type'         => 'toggle',
		'settings'     => 'enable_latest_posts_section_title',
		'section'      => 'latest_posts_options',
		'default'      => false,
		'priority'	   => 20,
		'active_callback' => array(
			array(
				'setting'  => 'latest_posts_tab',
				'operator' => '==',
				'value'    => 'latest_post_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Section Title', 'hello-shoppable' ),
		'type'        => 'text',
		'settings'    => 'latest_posts_section_title',
		'section'     => 'latest_posts_options',
		'default'     => '',
		'priority'	  => 30,
		'transport'	  => 'postMessage',
		'active_callback' => array(
			array(
				'setting'  => 'enable_latest_posts_section_title',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'latest_posts_tab',
				'operator' => '==',
				'value'    => 'latest_post_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Section Description', 'hello-shoppable' ),
		'type'         => 'toggle',
		'settings'     => 'enable_latest_posts_section_description',
		'section'      => 'latest_posts_options',
		'default'      => false,
		'priority'	   => 50,
		'active_callback' => array(
			array(
				'setting'  => 'latest_posts_tab',
				'operator' => '==',
				'value'    => 'latest_post_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Section Description', 'hello-shoppable' ),
		'type'        => 'text',
		'settings'    => 'latest_posts_section_description',
		'section'     => 'latest_posts_options',
		'default'     => '',
		'priority'	  => 60,
		'transport'	  => 'postMessage',
		'active_callback' => array(
			array(
				'setting'  => 'enable_latest_posts_section_description',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'latest_posts_tab',
				'operator' => '==',
				'value'    => 'latest_post_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Post Layouts', 'hello-shoppable' ),
		'description' => esc_html__( 'Grid / List / Single', 'hello-shoppable' ),
		'type'        => 'radio-image',
		'settings'    => 'archive_post_layout',
		'section'     => 'latest_posts_options',
		'default'     => 'list',
		'choices'     => apply_filters( 'hello_shoppable_archive_post_layout_filter', array(
			'grid'      => array(
				'src'	=> get_template_directory_uri() . '/assets/images/grid-layout.svg',
				'alt'	=> esc_html__( 'Grid', 'hello-shoppable' )
			),
			'list'      => array(
				'src'	=> get_template_directory_uri() . '/assets/images/list-layout.svg',
				'alt'	=> esc_html__( 'List', 'hello-shoppable' )
			),
			'single'    => array(
				'src'	=> get_template_directory_uri() . '/assets/images/single-layout.svg',
				'alt'	=> esc_html__( 'Single', 'hello-shoppable' )
			)
		) ),
		'priority'	   => 70,
		'active_callback' => array(
			array(
				'setting'  => 'latest_posts_tab',
				'operator' => '==',
				'value'    => 'latest_post_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Choose Category', 'hello-shoppable' ),
		'description' => esc_html__( 'Recent posts will show if any category is not chosen.', 'hello-shoppable' ),
		'type'        => 'select',
		'settings'    => 'latest_posts_category',
		'section'     => 'latest_posts_options',
		'default'     => '',
		'placeholder' => esc_html__( 'Select category', 'hello-shoppable' ), 
		'choices'     => hello_shoppable_get_post_categories(),
		'priority'	  => 80,
		'multiple'	  => 5,
		'active_callback' => array(
			array(
				'setting'  => 'latest_posts_tab',
				'operator' => '==',
				'value'    => 'latest_post_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Choose Image Size', 'hello-shoppable' ),
		'type'        => 'select',
		'settings'    => 'render_post_image_size',
		'section'     => 'latest_posts_options',
		'default'     => '',
		'placeholder' => esc_html__( 'Select Image Size', 'hello-shoppable' ),
		'choices'     => hello_shoppable_get_intermediate_image_sizes(),
		'priority'	   => 90,
		'active_callback' => array(
			array(
				'setting'  => 'latest_posts_tab',
				'operator' => '==',
				'value'    => 'latest_post_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Post View Number', 'hello-shoppable' ),
		'description' => esc_html__( 'Number of posts to show.', 'hello-shoppable' ),
		'type'        => 'number',
		'settings'    => 'archive_post_per_page',
		'section'     => 'latest_posts_options',
		'default'     => 10,
		'choices'  => array(
			'min' => '0',
			'max' => '20',
			'step' => '1',
		),
		'priority'	   => 100,
		'active_callback' => array(
			array(
				'setting'  => 'latest_posts_tab',
				'operator' => '==',
				'value'    => 'latest_post_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Title', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'enable_post_title',
		'section'     => 'latest_posts_options',
		'default'     => true,
		'priority'	  => 110,
		'active_callback' => array(
			array(
				'setting'  => 'latest_posts_tab',
				'operator' => '==',
				'value'    => 'latest_post_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Category', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'enable_post_category',
		'section'     => 'latest_posts_options',
		'default'     => true,
		'priority'	  => 120,
		'active_callback' => array(
			array(
				'setting'  => 'latest_posts_tab',
				'operator' => '==',
				'value'    => 'latest_post_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Date', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'enable_post_date',
		'section'     => 'latest_posts_options',
		'default'     => true,
		'priority'	  => 130,
		'active_callback' => array(
			array(
				'setting'  => 'latest_posts_tab',
				'operator' => '==',
				'value'    => 'latest_post_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Author', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'enable_post_author',
		'section'     => 'latest_posts_options',
		'default'     => true,
		'priority'	  => 140,
		'active_callback' => array(
			array(
				'setting'  => 'latest_posts_tab',
				'operator' => '==',
				'value'    => 'latest_post_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Comments Link', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'enable_post_comment',
		'section'     => 'latest_posts_options',
		'default'     => true,
		'priority'	  => 150,
		'active_callback' => array(
			array(
				'setting'  => 'latest_posts_tab',
				'operator' => '==',
				'value'    => 'latest_post_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Excerpt', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'enable_post_excerpt',
		'section'     => 'latest_posts_options',
		'default'     => true,
		'priority'	  => 160,
		'active_callback' => array(
			array(
				'setting'  => 'latest_posts_tab',
				'operator' => '==',
				'value'    => 'latest_post_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Excerpt Length', 'hello-shoppable' ),
		'description' => esc_html__( 'Select number of words to display in excerpt', 'hello-shoppable' ),
		'type'        => 'number',
		'settings'    => 'post_excerpt_length',
		'section'     => 'latest_posts_options',
		'default'     => 15,
		'choices' => array(
			'min'  => '5',
			'max'  => '60',
			'step' => '5',
		),
		'priority'	   => 170,
		'active_callback' => array(
			array(
				'setting'  => 'enable_post_excerpt',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'latest_posts_tab',
				'operator' => '==',
				'value'    => 'latest_post_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Pagination', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'enable_pagination',
		'section'     => 'latest_posts_options',
		'default'     => true,
		'priority'	  => 172,
		'active_callback' => array(
			array(
				'setting'  => 'latest_posts_tab',
				'operator' => '==',
				'value'    => 'latest_post_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'posts_button_separator',
	    'section'     => 'latest_posts_options',
	    'default'     => esc_html__( 'Post Button Options', 'hello-shoppable' ),
	    'priority'	  => 175,
	    'active_callback' => array(
	    	array(
				'setting'  => 'latest_posts_tab',
				'operator' => '==',
				'value'    => 'latest_post_general_tab',
			),
		),
	) );

	#Post Buttons
	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Button', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'enable_post_button',
		'section'     => 'latest_posts_options',
		'default'     => true,
		'priority'	  => 180,
		'active_callback' => array(
			array(
				'setting'  => 'latest_posts_tab',
				'operator' => '==',
				'value'    => 'latest_post_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Text', 'hello-shoppable' ),
		'type'         => 'text',
		'settings'     => 'post_button_text',
		'section'      => 'latest_posts_options',
		'default'      => '',
		'priority'	   => 182,
		'active_callback' => array(
			array(
				'setting'  => 'latest_posts_tab',
				'operator' => '==',
				'value'    => 'latest_post_general_tab',
			),
			array(
				'setting'  => 'enable_post_button',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Link', 'hello-shoppable' ),
		'type'         => 'text',
		'settings'     => 'post_button_link',
		'section'      => 'latest_posts_options',
		'default'      => '',
		'priority'	   => 184,
		'active_callback' => array(
			array(
				'setting'  => 'latest_posts_tab',
				'operator' => '==',
				'value'    => 'latest_post_general_tab',
			),
			array(
				'setting'  => 'enable_post_button',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );


	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Open Link in New Window', 'hello-shoppable' ),
		'type'         => 'toggle',
		'settings'     => 'post_new_window_button_target',
		'section'      => 'latest_posts_options',
		'default'      => true,
		'priority'	   => 186,
	'active_callback' => array(
			array(
				'setting'  => 'latest_posts_tab',
				'operator' => '==',
				'value'    => 'latest_post_general_tab',
			),
			array(
				'setting'  => 'enable_post_button',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'blog_archive_separator',
	    'section'     => 'latest_posts_options',
	    'default'     => esc_html__( 'Blog Archives Options', 'hello-shoppable' ),
	    'priority'	  => 265,
	    'active_callback' => array(
			array(
				'setting'  => 'latest_posts_tab',
				'operator' => '==',
				'value'    => 'latest_post_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable',  array(
		'label'       => esc_html__( 'Blog Archive Pages Title', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'enable_blog_archive_page_title',
		'section'     => 'latest_posts_options',
		'default'     => true,
		'priority'	   => 270,
		'active_callback' => array(
			array(
				'setting'  => 'latest_posts_tab',
				'operator' => '==',
				'value'    => 'latest_post_general_tab',
			),
		),
	) );

	// Blog Page Style Options

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Posts Border Radius (px)', 'hello-shoppable' ),
		'type'        => 'slider',
		'settings'    => 'latest_posts_radius',
		'section'     => 'latest_posts_options',
		'default'     =>  0,
		'transport'   => 'postMessage',
		'choices'     => array(
			'min'  => 0,
			'max'  => 50,
			'step' => 1,
		),
		'priority'	   => 305,
		'active_callback' => array(
			array(
				'setting'  => 'latest_posts_tab',
				'operator' => '==',
				'value'    => 'latest_post_style_tab',
			),
		),
	) );

	Kirki::add_field(  'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'latest_post_typography_border',
	    'section'     => 'latest_posts_options',
	    'default'     => wp_kses_post( '<hr class="customizer_separator">' ),
	    'priority'	  => 415,
	    'active_callback' => array(
			array(
				'setting'  => 'latest_posts_tab',
				'operator' => '==',
				'value'    => 'latest_post_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Section Title Typography', 'hello-shoppable' ),
		'type'         => 'typography',
		'settings'     => 'latest_posts_section_title_font_control',
		'section'      => 'latest_posts_options',
		'default'  => array(
			'font-family'     => 'Inter',
			'variant'         => '600',
			'font-size'       => '24px',
			'font-style'      => 'normal',
			'line-height'     => '1.3',
			'letter-spacing'  => '0',
			'text-transform'  => 'none',
			'text-decoration' => 'none',
			'text-align'      => '',
		),
		'priority'	  => 420,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.section-post-area .section-title-wrap .section-title',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'enable_latest_posts_section_title',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'latest_posts_tab',
				'operator' => '==',
				'value'    => 'latest_post_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'latest_posts_section_title_space',
	    'section'     => 'latest_posts_options',
	    'default'     => wp_kses_post( '<span class="typography_spacer"></span>' ),
	    'priority'	  => 424,
	    'active_callback' => array(
			array(
				'setting'  => 'enable_latest_posts_section_title',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'latest_posts_tab',
				'operator' => '==',
				'value'    => 'latest_post_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Section Description Typography', 'hello-shoppable' ),
		'type'         => 'typography',
		'settings'     => 'latest_posts_section_description_font_control',
		'section'      => 'latest_posts_options',
		'default'  => array(
			'font-family'     => 'Inter',
			'variant'         => 'regular',
			'font-size'       => '16px',
			'font-style'      => 'normal',
			'line-height'     => '1.6',
			'letter-spacing'  => '0',
			'text-transform'  => 'none',
			'text-decoration' => 'none',
			'text-align'      => '',
		),
		'priority'	  => 425,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '.section-post-area .section-title-wrap p',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'enable_latest_posts_section_description',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'latest_posts_tab',
				'operator' => '==',
				'value'    => 'latest_post_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'latest_posts_section_description_space',
	    'section'     => 'latest_posts_options',
	    'default'     => wp_kses_post( '<span class="typography_spacer"></span>' ),
	    'priority'	  => 429,
	    'active_callback' => array(
			array(
				'setting'  => 'enable_latest_posts_section_description',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'latest_posts_tab',
				'operator' => '==',
				'value'    => 'latest_post_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Post Title Typography', 'hello-shoppable' ),
		'type'         => 'typography',
		'settings'     => 'blog_post_title_font_control',
		'section'      => 'latest_posts_options',
		'default'  => array(
			'font-family'     => 'Inter',
			'variant'         => '500',
			'font-size'       => '21px',
			'font-style'      => 'normal',
			'line-height'     => '1.3',
			'letter-spacing'  => '0',
			'text-transform'  => 'none',
			'text-decoration' => 'none',
			'text-align'      => '',
		),
		'priority'	   => 430,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '#primary article .entry-title',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'enable_post_title',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'latest_posts_tab',
				'operator' => '==',
				'value'    => 'latest_post_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'blog_post_title_space',
	    'section'     => 'latest_posts_options',
	    'default'     => wp_kses_post( '<span class="typography_spacer"></span>' ),
	    'priority'	  => 439,
	    'active_callback' => array(
			array(
				'setting'  => 'enable_post_title',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'latest_posts_tab',
				'operator' => '==',
				'value'    => 'latest_post_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Post Category Typography', 'hello-shoppable' ),
		'type'         => 'typography',
		'settings'     => 'blog_post_cat_font_control',
		'section'      => 'latest_posts_options',
		'default'  => array(
			'font-family'     => 'Inter',
			'variant'         => 'regular',
			'font-size'       => '13px',
			'font-style'      => 'normal',
			'line-height'     => '1.3',
			'letter-spacing'  => '0',
			'text-decoration' => 'none',
			'text-transform'  => 'uppercase',
			'text-align'      => '',
		),
		'priority'	  => 440,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '#primary .post .entry-content .entry-header .cat-links a',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'enable_post_category',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'latest_posts_tab',
				'operator' => '==',
				'value'    => 'latest_post_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'blog_post_cat_space',
	    'section'     => 'latest_posts_options',
	    'default'     => wp_kses_post( '<span class="typography_spacer"></span>' ),
	    'priority'	  => 449,
	    'active_callback' => array(
			array(
				'setting'  => 'enable_post_category',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'latest_posts_tab',
				'operator' => '==',
				'value'    => 'latest_post_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Post Meta Typography', 'hello-shoppable' ),
		'type'         => 'typography',
		'settings'     => 'blog_post_meta_font_control',
		'section'      => 'latest_posts_options',
		'default'  => array(
			'font-family'     => 'Inter',
			'variant'         => 'regular',
			'font-size'       => '13px',
			'font-style'      => 'normal',
			'line-height'     => '1.6',
			'letter-spacing'  => '0',
			'text-transform'  => 'capitalize',
			'text-decoration' => 'none',
			'text-align'      => '',
		),
		'priority'	  => 450,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '#primary .entry-meta',
			),
		),
		'active_callback' => array(
			array(
				array(
				'setting'  => 'enable_post_date',
				'operator' => '==',
				'value'    => true,
				),
				array(
				'setting'  => 'enable_post_author',
				'operator' => '==',
				'value'    => true,
				),
				array(
				'setting'  => 'enable_post_comment',
				'operator' => '==',
				'value'    => true,
				),
			),
			array(
				'setting'  => 'latest_posts_tab',
				'operator' => '==',
				'value'    => 'latest_post_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'blog_post_meta_space',
	    'section'     => 'latest_posts_options',
	    'default'     => wp_kses_post( '<span class="typography_spacer"></span>' ),
	    'priority'	  => 459,
	    'active_callback' => array(
			array(
				array(
				'setting'  => 'enable_post_date',
				'operator' => '==',
				'value'    => true,
				),
				array(
				'setting'  => 'enable_post_author',
				'operator' => '==',
				'value'    => true,
				),
				array(
				'setting'  => 'enable_post_comment',
				'operator' => '==',
				'value'    => true,
				),
			),
			array(
				'setting'  => 'latest_posts_tab',
				'operator' => '==',
				'value'    => 'latest_post_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Post Excerpt Typography', 'hello-shoppable' ),
		'type'         => 'typography',
		'settings'     => 'blog_post_excerpt_font_control',
		'section'      => 'latest_posts_options',
		'default'  => array(
			'font-family'     => 'Inter',
			'variant'         => 'regular',
			'font-size'       => '15px',
			'font-style'      => 'normal',
			'line-height'     => '1.6',
			'letter-spacing'  => '0',
			'text-transform'  => 'initial',
			'text-decoration' => 'none',
			'text-align'      => '',
		),
		'priority'	  => 460,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '#primary .entry-text p',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'enable_post_excerpt',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'latest_posts_tab',
				'operator' => '==',
				'value'    => 'latest_post_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'blog_post_excerpt_space',
	    'section'     => 'latest_posts_options',
	    'default'     => wp_kses_post( '<span class="typography_spacer"></span>' ),
	    'priority'	  => 469,
	    'active_callback' => array(
			array(
				'setting'  => 'enable_post_excerpt',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'latest_posts_tab',
				'operator' => '==',
				'value'    => 'latest_post_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Post Button Typography', 'hello-shoppable' ),
		'type'         => 'typography',
		'settings'     => 'blog_post_button_font_control',
		'section'      => 'latest_posts_options',
		'default'  => array(
			'font-family'     => 'Inter',
			'variant'         => '600',
			'font-size'       => '14px',
			'font-style'      => 'normal',
			'line-height'     => '1.6',
			'letter-spacing'  => '0',
			'text-transform'  => 'capitalize',
			'text-decoration' => 'none',
			'text-align'      => '',
		),
		'priority'	  => 470,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => '#primary .post .entry-text .button-container a',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'enable_post_button',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'latest_posts_tab',
				'operator' => '==',
				'value'    => 'latest_post_style_tab',
			),
		),
	) );

	// Responsive
	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'latest_posts_responsive_separator',
	    'section'     => 'latest_posts_options',
	    'default'     => esc_html__( 'Responsive', 'hello-shoppable' ),
	    'priority'	  => 480,
	    'active_callback' => array(
			array(
				'setting'  => 'latest_posts_tab',
				'operator' => '==',
				'value'    => 'latest_post_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Latest Posts', 'hello-shoppable' ),
		'type'         => 'toggle',
		'settings'     => 'enable_mobile_latest_posts',
		'section'      => 'latest_posts_options',
		'default'      => true,
		'priority'	   => 490,
		'active_callback' => array(
			array(
				'setting'  => 'latest_posts_tab',
				'operator' => '==',
				'value'    => 'latest_post_general_tab',
			),
		),
	) );

	// Single Post Options
	Kirki::add_section( 'single_post_options', array(
	    'title'          => esc_html__( 'Single Post', 'hello-shoppable' ),
	    'capability'     => 'edit_theme_options',
	    'panel'			 => 'blog_homepage_options',
	    'priority'       => '140',
	) );

	Kirki::add_field( 'hello-shoppable',  array(
		'label'       => esc_html__( 'Post Title', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'enable_single_post_title',
		'section'     => 'single_post_options',
		'default'     => true,
		'priority'	   => 10,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Feature Image', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'enable_single_feature_image',
		'section'     => 'single_post_options',
		'default'     => true,
		'priority'	   => 30,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Choose Image Size', 'hello-shoppable' ),
		'type'        => 'select',
		'settings'    => 'render_single_post_image_size',
		'section'     => 'single_post_options',
		'default'     => 'hello-shoppable-1370-550',
		'placeholder' => esc_html__( 'Select Image Size', 'hello-shoppable' ),
		'choices'     => hello_shoppable_get_intermediate_image_sizes(),
		'priority'	  => 40,
		'active_callback' => array(
			array(
				'setting'  => 'enable_single_feature_image',
				'operator' => '==',
				'value'    => true,	
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Date', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'enable_single_post_date',
		'section'     => 'single_post_options',
		'default'     => true,
		'priority'	  => 90,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Comments Link', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'enable_single_post_comment',
		'section'     => 'single_post_options',
		'default'     => true,
		'priority'	  => 100,
	) );
	
	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Category', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'enable_single_post_category',
		'section'     => 'single_post_options',
		'default'     => true,
		'priority'	  => 110,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Tag Links', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'enable_single_post_tag_links',
		'section'     => 'single_post_options',
		'default'     => true,
		'priority'	  => 120,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Author', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'enable_single_post_author',
		'section'     => 'single_post_options',
		'default'     => true,
		'priority'	  => 130,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Author Title', 'hello-shoppable' ),
		'type'        => 'text',
		'settings'    => 'single_post_author_title',
		'section'     => 'single_post_options',
		'default'     => esc_html__( 'About the Author', 'hello-shoppable' ),
		'priority'	  => 140,
		'transport'	  => 'postMessage',
		'active_callback' => array(
			array(
				'setting'  => 'enable_single_post_author',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Related Posts', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'enable_related_posts',
		'section'     => 'single_post_options',
		'default'     => true,
		'priority'	  => 150,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Related Posts Section Title', 'hello-shoppable' ),
		'type'        => 'text',
		'settings'    => 'related_posts_title',
		'section'     => 'single_post_options',
		'default'     => esc_html__( 'You may also like these', 'hello-shoppable' ),
		'priority'	  => 160,
		'transport'	  => 'postMessage',
		'active_callback' => array(
			array(
				'setting'  => 'enable_related_posts',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Choose Image Size', 'hello-shoppable' ),
		'description' => esc_html__( 'For related posts.', 'hello-shoppable' ),
		'type'        => 'select',
		'settings'    => 'render_related_post_image_size',
		'section'     => 'single_post_options',
		'default'     => 'hello-shoppable-420-300',
		'placeholder' => esc_html__( 'Select Image Size', 'hello-shoppable' ),
		'choices'     => hello_shoppable_get_intermediate_image_sizes(),
		'priority'	  => 170,
		'active_callback' => array(
			array(
				'setting'  => 'enable_related_posts',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Related Posts Items', 'hello-shoppable' ),
		'description' => esc_html__( 'Total number of related posts to show.', 'hello-shoppable' ),
		'type'        => 'number',
		'settings'    => 'related_posts_count',
		'section'     => 'single_post_options',
		'default'     => 4,
		'choices' => array(
			'min' => '1',
			'max' => '12',
			'step' => '1',
		),
		'priority'	   => 180,
		'active_callback' => array(
			array(
				'setting'  => 'enable_related_posts',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Related Posts Date', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'related_post_date',
		'section'     => 'single_post_options',
		'default'     => true,
		'priority'	  => 190,
		'active_callback' => array(
			array(
				'setting'  => 'enable_related_posts',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	// WooCommerce

	// Breadcrumbs
	Kirki::add_section( 'woocommerce_sidebar_options', array(
	    'title'          => esc_html__( 'Sidebar', 'hello-shoppable' ),
	    'capability'     => 'edit_theme_options',
	    'panel'			 => 'woocommerce',
	    'priority'       => 8,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Sidebar Layouts', 'hello-shoppable' ),
		'type'        => 'radio-buttonset',
		'settings'    => 'woo_sidebar_layout',
		'section'     => 'woocommerce_sidebar_options',
		'default'     => 'right',
		'priority'	  => 10,
		'choices'  => array(
			'right'      => esc_html__( 'Right', 'hello-shoppable' ),
			'left'       => esc_html__( 'Left', 'hello-shoppable' ),
			'right-left' => esc_html__( 'Both', 'hello-shoppable' ),
			'no-sidebar' => esc_html__( 'None', 'hello-shoppable' ),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Sticky Position', 'hello-shoppable' ),
		'type'         => 'toggle',
		'settings'     => 'woo_sticky_sidebar',
		'section'      => 'woocommerce_sidebar_options',
		'default'      => true,
		'priority'	   => 15,
		'active_callback' => array(
			array(
				'setting'  => 'woo_sidebar_layout',
				'operator' => 'contains',
				'value'    => array( 'right', 'left', 'right-left' ),
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Shop Sidebar', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'enable_sidebar_woocommerce_shop',
		'section'     => 'woocommerce_sidebar_options',
		'default'     => true,
		'priority'	  =>  20,
		'active_callback' => array(
			array(
				'setting'  => 'woo_sidebar_layout',
				'operator' => 'contains',
				'value'    => array( 'right', 'left', 'right-left' ),
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Single Product Sidebar', 'hello-shoppable' ),
		'type'        => 'toggle',
		'settings'    => 'enable_sidebar_woocommerce_single',
		'section'     => 'woocommerce_sidebar_options',
		'default'     => true,
		'priority'	  =>  30,
		'active_callback' => array(
			array(
				'setting'  => 'woo_sidebar_layout',
				'operator' => 'contains',
				'value'    => array( 'right', 'left', 'right-left' ),
			),
		),
	) );

	// Breadcrumbs
	Kirki::add_section( 'woocommerce_breadcrumbs_options', array(
	    'title'          => esc_html__( 'Breadcrumbs', 'hello-shoppable' ),
	    'capability'     => 'edit_theme_options',
	    'panel'			 => 'woocommerce',
	    'priority'       => 9,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Breadcrumbs', 'hello-shoppable' ),
		'type'        => 'select',
		'settings'    => 'woocommerce_breadcrumbs_controls',
		'section'     => 'woocommerce_breadcrumbs_options',
		'default'     => 'disable_in_all_page_post',
		'choices'  => array(
			'disable_in_all_pages'     => esc_html__( 'Disable in all Pages Only', 'hello-shoppable' ),
			'disable_in_all_page_post' => esc_html__( 'Disable in all Pages & Products', 'hello-shoppable' ),
			'show_in_all_page_post'    => esc_html__( 'Show in all Pages & Products', 'hello-shoppable' ),
		),
		'priority'	   => 10,
	) );

	// WooCommerce product catalog
	Kirki::add_field( 'hello-shoppable', array(
		'type'        => 'radio-buttonset',
		'settings'    => 'woocommerce_product_catalog_tabs',
		'section'     => 'woocommerce_product_catalog',
		'default'     => 'product_catalog_general_tab',
		'choices'  => array(
			'product_catalog_general_tab'     => esc_html__( 'General', 'hello-shoppable' ),
			'product_catalog_style_tab'     => esc_html__( 'Style', 'hello-shoppable' ),
		),
		'transport'	   => 'postMessage',
		'priority'	   => 10,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Shop Page Title', 'hello-shoppable' ),
		'type'         => 'toggle',
		'settings'     => 'enable_shop_page_title',
		'section'      => 'woocommerce_product_catalog',
		'default'      => true,
		'priority'	   => 20,
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'product_card_separator',
	    'section'     => 'woocommerce_product_catalog',
	    'default'     => esc_html__( 'Product Wrapper Options', 'hello-shoppable' ),
	    'priority'	  => 30,
	    'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'			=> esc_html__( 'Product Layout Type', 'hello-shoppable' ),
		'type'			=> 'radio-image',
		'settings'		=> 'woocommerce_product_layout_type',
		'section'		=> 'woocommerce_product_catalog',
		'default'		=> 'product_layout_grid',
		'choices'		=> apply_filters( 'hello_shoppable_woocommerce_product_layout_type_filter', array(
			'product_layout_grid'		=> array(
				'src'	=> get_template_directory_uri() . '/assets/images/product-layout-type-one.svg',
				'alt'	=> esc_html__( 'Product Layout Grid', 'hello-shoppable' )
			),
			'product_layout_list'		=> array(
				'src'	=> get_template_directory_uri() . '/assets/images/product-layout-type-two.svg',
				'alt'	=> esc_html__( 'Product Layout List', 'hello-shoppable' )
			)
		) ),
		'priority'	   => 40,
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'			=> esc_html__( 'Content Alignment', 'hello-shoppable' ),
		'type'			=> 'radio-buttonset',
		'settings'		=> 'woocommerce_product_card_text_alignment',
		'section'		=> 'woocommerce_product_catalog',
		'default'		=> 'center',
		'choices'		=> array(
			'left'		=> esc_html__( 'Left', 'hello-shoppable' ),
			'center'	=> esc_html__( 'Center', 'hello-shoppable' ),
			'right'		=> esc_html__( 'Right', 'hello-shoppable' ),
		),
		'priority'	   => 60,
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Products Per Row', 'hello-shoppable' ),
		'description'  => esc_html__( 'How many products should be shown per row?', 'hello-shoppable' ),
		'type'         => 'number',
		'settings'     => 'woocommerce_shop_product_column',
		'section'      => 'woocommerce_product_catalog',
		'default'      => 3,
		'choices' => array(
			'min' => '1',
			'max' => '4',
			'step'=> '1',
		),
		'priority'	   => 70,
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_general_tab',
			),
			array(
				'setting'  => 'woocommerce_product_layout_type',
				'operator' => '==',
				'value'    => 'product_layout_grid',
			),

		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Products Per Row', 'hello-shoppable' ),
		'description'  => esc_html__( 'How many products should be shown per row?', 'hello-shoppable' ),
		'type'         => 'number',
		'settings'     => 'woocommerce_shop_list_column',
		'section'      => 'woocommerce_product_catalog',
		'default'      => 2,
		'choices' => array(
			'min' => '1',
			'max' => '3',
			'step'=> '1',
		),
		'priority'	   => 80,
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_general_tab',
			),
			array(
				'setting'  => 'woocommerce_product_layout_type',
				'operator' => '==',
				'value'    => 'product_layout_list',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Rating', 'hello-shoppable' ),
		'type'         => 'toggle',
		'settings'     => 'enable_shop_page_rating',
		'section'      => 'woocommerce_product_catalog',
		'default'      => true,
		'priority'     => 95,
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'add_to_cart_separator',
	    'section'     => 'woocommerce_product_catalog',
	    'default'     => esc_html__( 'Add To Cart Button Options', 'hello-shoppable' ),
	    'priority'	  => 100,
	    'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'			=> esc_html__( 'Add To Cart Button', 'hello-shoppable' ),
		'type'			=> 'radio-image',
		'settings'		=> 'woocommerce_add_to_cart_button',
		'section'		=> 'woocommerce_product_catalog',
		'default'		=> 'cart_button_two',
		'choices'		=> apply_filters( 'hello_shoppable_woocommerce_add_to_cart_button_filter', array(
			'cart_button_one'		=> array(
				'src'	=> get_template_directory_uri() . '/assets/images/cart-button-one.svg',
				'alt'	=> esc_html__( 'Cart Button One', 'hello-shoppable' )
			),
			'cart_button_two'		=> array(
				'src'	=> get_template_directory_uri() . '/assets/images/cart-button-two.svg',
				'alt'	=> esc_html__( 'Cart Button Two', 'hello-shoppable' )
			),
			'cart_button_three'		=> array(
				'src'	=> get_template_directory_uri() . '/assets/images/cart-button-three.svg',
				'alt'	=> esc_html__( 'Cart Button Three', 'hello-shoppable' )
			),
		) ),
		'priority'	   => 110,
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'sale_tag_separator',
	    'section'     => 'woocommerce_product_catalog',
	    'default'     => esc_html__( 'Sale Tag Options', 'hello-shoppable' ),
	    'priority'	  => 140,
	    'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'			=> esc_html__( 'Sale Tag Layout', 'hello-shoppable' ),
		'type'			=> 'radio-image',
		'settings'		=> 'woocommerce_sale_tag_layout',
		'section'		=> 'woocommerce_product_catalog',
		'default'		=> 'sale_tag_layout_one',
		'choices'		=> apply_filters( 'hello_shoppable_woocommerce_sale_tag_layout_filter', array(
			'sale_tag_layout_one'		=> array(
				'src'	=> get_template_directory_uri() . '/assets/images/product-badge-style-one.svg',
				'alt'	=> esc_html__( 'Sale Tag Layout One', 'hello-shoppable' )
			),
			'sale_tag_layout_two'		=> array(
				'src'	=> get_template_directory_uri() . '/assets/images/product-badge-style-two.svg',
				'alt'	=> esc_html__( 'Sale Tag Layout Two', 'hello-shoppable' )
			)
		) ),
		'priority'	   => 150,
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_general_tab',
			),
			array(
				'setting'  => 'icon_group_layout',
				'operator' => '!=',
				'value'    => 'group_layout_four',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Sale Badge Text', 'hello-shoppable' ),
		'type'        => 'text',
		'settings'    => 'woocommerce_sale_badge_text',
		'section'     => 'woocommerce_product_catalog',
		'default'     => esc_html__( 'Sale!', 'hello-shoppable' ),
		'priority'	  => 160,
		'transport'	  => 'postMessage',
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_general_tab',
			),
			array(
				'setting'  => 'enable_sale_badge_percent',
				'operator' => '==',
				'value'    => false,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Sale Badge Percentage', 'hello-shoppable' ),
		'description' => esc_html__( 'Replaces sale badge text with sale percent.', 'hello-shoppable' ),
		'type'         => 'toggle',
		'settings'     => 'enable_sale_badge_percent',
		'section'      => 'woocommerce_product_catalog',
		'default'      => false,
		'priority'	   => 170,
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_general_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Sale Badge Percentage Text', 'hello-shoppable' ),
		'description' => esc_html__( 'Input text to accompany with percentage {value} tag. Example: {value}% OFF!', 'hello-shoppable' ),
		'type'        => 'text',
		'settings'    => 'woocommerce_sale_badge_percent',
		'section'     => 'woocommerce_product_catalog',
		'default'     => esc_html__( '-{value}%', 'hello-shoppable' ),
		'priority'	  => 180,
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_general_tab',
			),
			array(
				'setting'  => 'enable_sale_badge_percent',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'product_card_style_separator',
	    'section'     => 'woocommerce_product_catalog',
	    'default'     => esc_html__( 'Product Wrapper Options', 'hello-shoppable' ),
	    'priority'	  => 190,
	    'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'			=> esc_html__( 'Product Card Style', 'hello-shoppable' ),
		'type'			=> 'radio-image',
		'settings'		=> 'woocommerce_product_card_style',
		'section'		=> 'woocommerce_product_catalog',
		'default'		=> 'card_style_one',
		'choices'		=> apply_filters( 'hello_shoppable_woocommerce_product_card_style_filter', array(
			'card_style_one'		=> array(
				'src'		=> get_template_directory_uri() . '/assets/images/product-card-style-one.svg',
				'alt'		=> esc_html__( 'Card Style One', 'hello-shoppable' )
			),
			'card_style_two'		=> array(
				'src'		=> get_template_directory_uri() . '/assets/images/product-card-style-two.svg',
				'alt'		=> esc_html__( 'Card Style Two', 'hello-shoppable' )
			),
			'card_style_three'		=> array(
				'src'		=> get_template_directory_uri() . '/assets/images/product-card-style-three.svg',
				'alt'		=> esc_html__( 'Card Style Three', 'hello-shoppable' )
			)
		) ),
		'priority'	   => 200,
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Product Image Radius', 'hello-shoppable' ),
		'type'         => 'slider',
		'settings'     => 'shop_product_image_radius',
		'section'      => 'woocommerce_product_catalog',
		'transport'    => 'postMessage',
		'default'      => 0,
		'choices'      => array(
			'min'  => 0,
			'max'  => 200,
			'step' => 1,
		),
		'priority'	   => 210,
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Product Card Border Radius', 'hello-shoppable' ),
		'type'         => 'slider',
		'settings'     => 'shop_product_card_radius',
		'section'      => 'woocommerce_product_catalog',
		'transport'    => 'postMessage',
		'default'      => 0,
		'choices'      => array(
			'min'  => 0,
			'max'  => 200,
			'step' => 1,
		),
		'priority'	   => 220,
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
			array(
				'setting'  => 'woocommerce_product_card_style',
				'operator' => 'contains',
				'value'    => array( 'card_style_two', 'card_style_three' ),
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'add_to_cart_style_separator',
	    'section'     => 'woocommerce_product_catalog',
	    'default'     => esc_html__( 'Add To Cart Button Options', 'hello-shoppable' ),
	    'priority'	   => 230,
	    'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
			array(
				'setting'  => 'woocommerce_add_to_cart_button',
				'operator' => 'contains',
				'value'    => array('cart_button_three' ),
			)
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Add to Cart Button Spacing', 'hello-shoppable' ),
		'type'         => 'slider',
		'settings'     => 'cart_four_diagonal_spacing',
		'section'      => 'woocommerce_product_catalog',
		'transport'    => 'postMessage',
		'default'      => 10,
		'choices'      => array(
			'min'  => 0,
			'max'  => 50,
			'step' => 1,
		),
		'priority'	   => 270,
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
			array(
				'setting'  => 'woocommerce_add_to_cart_button',
				'operator' => 'contains',
				'value'    => array( 'cart_button_three' ),
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'sale_tag_style_separator',
	    'section'     => 'woocommerce_product_catalog',
	    'default'     => esc_html__( 'Sale Tag Options', 'hello-shoppable' ),
	    'priority'	  => 310,
	    'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Sale Tag Background Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'sale_tag_bg_color',
		'section'      => 'woocommerce_product_catalog',
		'default'      => '#EB5A3E',
		'priority'	   => 320,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Sale Tag Text Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'sale_tag_text_color',
		'section'      => 'woocommerce_product_catalog',
		'default'      => '#ffffff',
		'priority'	   => 330,
		'choices'	   => array(
			'alpha'		=> true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'enable_dark_mode',
				'operator' => '==',
				'value'    => false,
			),
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'sale_button_radius_border',
	    'section'     => 'woocommerce_product_catalog',
	    'default'  => wp_kses( '<hr class="customizer_separator">', array(
			    'hr' => array(
			      'class' => array(),
			    ),
		  	)
		),
	    'priority'	  => 335,
	    'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Sale Button Border Radius', 'hello-shoppable' ),
		'type'         => 'slider',
		'settings'     => 'sale_button_border_radius',
		'section'      => 'woocommerce_product_catalog',
		'transport'    => 'postMessage',
		'default'      => 0,
		'choices'      => array(
			'min'  => 0,
			'max'  => 50,
			'step' => 1,
		),
		'priority'	   => 340,
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Sale Button Spacing', 'hello-shoppable' ),
		'type'         => 'slider',
		'settings'     => 'sale_button_diagonal_spacing',
		'section'      => 'woocommerce_product_catalog',
		'transport'    => 'postMessage',
		'default'      => 8,
		'choices'      => array(
			'min'  => 0,
			'max'  => 50,
			'step' => 1,
		),
		'priority'	   => 350,
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'shop_product_title_border',
	    'section'     => 'woocommerce_product_catalog',
	    'default'  => wp_kses( '<hr class="customizer_separator">', array(
			    'hr' => array(
			      'class' => array(),
			    ),
		  	)
		),
	    'priority'	  => 355,
	    'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Product Title Font Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'shop_product_title_font_color',
		'section'      => 'woocommerce_product_catalog',
		'default'      => '',
		'priority'	   => 356,
		'transport'	   => 'auto',
		'choices'	   => array(
			'alpha'		=> true,
		),	
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
		),
		'output'      => array(
			array(
				'element' => 'body[class*=woocommerce] ul.products li.product .woocommerce-loop-product__title',
				'property' => 'color',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Product Price Font Color', 'hello-shoppable' ),
		'type'         => 'color',
		'settings'     => 'shop_product_price_font_color',
		'section'      => 'woocommerce_product_catalog',
		'default'      => '',
		'priority'	   => 358,
		'transport'	   => 'auto',
		'choices'	   => array(
			'alpha'		=> true,
		),	
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
		),
		'output'      => array(
			array(
				'element' => 'body[class*=woocommerce] ul.products li.product .price',
				'property' => 'color',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Product Title Typography', 'hello-shoppable' ),
		'type'         => 'typography',
		'settings'     => 'shop_product_title_font_control',
		'section'      => 'woocommerce_product_catalog',
		'default'  => array(
			'font-family'     => 'Inter',
			'variant'         => '600',
			'font-style'      => 'normal',
			'font-size'       => '20px',
			'line-height'     => '1.3',
			'letter-spacing'  => '0',
			'text-transform'  => 'none',
			'text-decoration' => 'none',
			'text-align'      => '',
		),
		'priority'	   => 360,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => 'body[class*=woocommerce] ul.products li.product .woocommerce-loop-product__title',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'shop_product_title_font_space',
	    'section'     => 'woocommerce_product_catalog',
	    'default'     => wp_kses_post( '<span class="typography_spacer"></span>' ),
	    'priority'	  => 365,
	    'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Product Price Typography', 'hello-shoppable' ),
		'type'         => 'typography',
		'settings'     => 'shop_product_price_font_control',
		'section'      => 'woocommerce_product_catalog',
		'default'  => array(
			'font-family'     => 'Inter',
			'variant'         => '500',
			'font-style'      => 'normal',
			'font-size'       => '16px',
			'line-height'     => '1.6',
			'letter-spacing'  => '0',
			'text-transform'  => 'none',
			'text-align'      => '',
			'text-decoration' => 'none',
		),
		'priority'	   => 370,
		'transport'   => 'auto',
		'output'      => array(
			array(
				'element' => 'body[class*=woocommerce] ul.products li.product .price',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'shop_product_price_font_space',
	    'section'     => 'woocommerce_product_catalog',
	    'default'     => wp_kses_post( '<span class="typography_spacer"></span>' ),
	    'priority'	  => 375,
	    'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'shop_page_display_border',
	    'section'     => 'woocommerce_product_catalog',
	    'default'  => wp_kses( '<hr class="customizer_separator">', array(
			    'hr' => array(
			      'class' => array(),
			    ),
		  	)
		),
	    'priority'	  => 386,
	    'active_callback' => array(
			array(
				'setting'  => 'woocommerce_product_catalog_tabs',
				'operator' => '==',
				'value'    => 'product_catalog_style_tab',
			),
		),
	) );

	Kirki::add_section( 'woocommerce_single_product', array(
	    'title'      => esc_html__( 'Single Products', 'hello-shoppable' ),
	    'panel'      => 'woocommerce',	   
	    'capability' => 'edit_theme_options',
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Image Zoom / Magnification', 'hello-shoppable' ),
		'description'  => esc_html__( 'Every slider step changes 10% zoom to the previous zoom level. For example: 1.1 zoom level is now 110% zoom.', 'hello-shoppable' ),
		'type'         => 'slider',
		'settings'     => 'single_product_iamge_magnify',
		'section'      => 'woocommerce_single_product',
		'default'      => 1,
		'choices'      => array(
			'min'  => 0,
			'max'  => 3,
			'step' => 0.1,
		),
		'priority'	   => 10,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Single Product Page Title', 'hello-shoppable' ),
		'type'         => 'toggle',
		'settings'     => 'enable_single_product_title',
		'section'      => 'woocommerce_single_product',
		'default'      => true,
		'priority'	   => 20,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        		=> esc_html__( 'Breadcrumbs', 'hello-shoppable' ),
		'type'         		=> 'toggle',
		'settings'     		=> 'enable_single_product_breadcrumbs',
		'section'      		=> 'woocommerce_single_product',
		'default'      		=> true,
		'priority'	  		=> 30,
		'active_callback' => array(
			array(
				'setting'  => 'woocommerce_breadcrumbs_controls',
				'operator' => '!=',
				'value'    => 'disable_in_all_page_post',
			),
		)
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'SKU', 'hello-shoppable' ),
		'type'         => 'toggle',
		'settings'     => 'enable_single_product_sku',
		'section'      => 'woocommerce_single_product',
		'default'      => true,
		'priority'	   => 40,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Category', 'hello-shoppable' ),
		'type'         => 'toggle',
		'settings'     => 'enable_single_product_category',
		'section'      => 'woocommerce_single_product',
		'default'      => true,
		'priority'	   => 50,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Tags', 'hello-shoppable' ),
		'type'         => 'toggle',
		'settings'     => 'enable_single_product_tags',
		'section'      => 'woocommerce_single_product',
		'default'      => true,
		'priority'	   => 60,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Product Tabs', 'hello-shoppable' ),
		'type'         => 'toggle',
		'settings'     => 'enable_single_product_tabs',
		'section'      => 'woocommerce_single_product',
		'default'      => true,
		'priority'	   => 70,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Related Products', 'hello-shoppable' ),
		'type'         => 'toggle',
		'settings'     => 'enable_single_product_related_products',
		'section'      => 'woocommerce_single_product',
		'default'      => true,
		'priority'	   => 80,
	) );

	//  Woocommerce Buttons
	Kirki::add_section( 'woocommerce_buttons_options', array(
	    'title'          => esc_html__( 'Buttons', 'hello-shoppable' ),
	    'capability'     => 'edit_theme_options',
	    'panel'			 => 'woocommerce',
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Colors', 'hello-shoppable' ),
		'type'        => 'radio-buttonset',
		'settings'    => 'woocommerce_button_controls',
		'section'     => 'woocommerce_buttons_options',
		'default'     => 'normal',
		'choices'  => array(
			'normal' 			=> esc_html__( 'Normal', 'hello-shoppable' ),
			'hover' 			=> esc_html__( 'Hover', 'hello-shoppable' ),
		),
		'priority'	  => 10,
		'transport'   => 'postMessage',
	) );

	new \Kirki\Field\Color(
		[
			'settings'    => 'woocommerce_button_text_color',
			'label'       => esc_html__( 'Text Color', 'hello-shoppable' ),
			'section'     => 'woocommerce_buttons_options',
			'default'     => '#FFFFFF',
			'priority'	  => 20,
			'choices'	   => array(
				'alpha'		=> true,
			),
			'active_callback'	=> [
				[
					'setting'  => 'woocommerce_button_controls',
					'operator' => '==',
					'value'    => 'normal',
				],
			],
		]
	);

	new \Kirki\Field\Color(
		[
			'settings'    => 'woocommerce_button_bg_color',
			'label'       => esc_html__( 'Background Color', 'hello-shoppable' ),
			'section'     => 'woocommerce_buttons_options',
			'default'     => '#333333',
			'priority'	  => 30,
			'choices'	   => array(
				'alpha'		=> true,
			),
			'active_callback'	=> [
				[
					'setting'  => 'woocommerce_button_controls',
					'operator' => '==',
					'value'    => 'normal',
				],
			],
		]
	);

	new \Kirki\Field\Color(
		[
			'settings'    => 'woocommerce_button_border_color',
			'label'       => esc_html__( 'Border Color', 'hello-shoppable' ),
			'section'     => 'woocommerce_buttons_options',
			'default'     => '',
			'priority'	  => 40,
			'choices'	   => array(
				'alpha'		=> true,
			),
			'active_callback'	=> [
				[
					'setting'  => 'woocommerce_button_controls',
					'operator' => '==',
					'value'    => 'normal',
				],
			],
		]
	);

	new \Kirki\Field\Color(
		[
			'settings'    => 'woocommerce_button_text_hover_color',
			'label'       => esc_html__( 'Text Hover Color', 'hello-shoppable' ),
			'section'     => 'woocommerce_buttons_options',
			'default'     => '#ffffff',
			'priority'	  => 50,
			'choices'	   => array(
				'alpha'		=> true,
			),
			'active_callback'	=> [
				[
					'setting'  => 'woocommerce_button_controls',
					'operator' => '==',
					'value'    => 'hover',
				],
			],
		]
	);

	new \Kirki\Field\Color(
		[
			'settings'    => 'woocommerce_button_bg_hover_color',
			'label'       => esc_html__( 'Background Hover Color', 'hello-shoppable' ),
			'section'     => 'woocommerce_buttons_options',
			'default'     => '#2154ac',
			'priority'	  => 60,
			'choices'	   => array(
				'alpha'		=> true,
			),
			'active_callback'	=> [
				[
					'setting'  => 'woocommerce_button_controls',
					'operator' => '==',
					'value'    => 'hover',
				],
			],
		]
	);

	new \Kirki\Field\Color(
		[
			'settings'    => 'woocommerce_button_border_hover_color',
			'label'       => esc_html__( 'Border Hover Color', 'hello-shoppable' ),
			'section'     => 'woocommerce_buttons_options',
			'default'     => '#2154ac',
			'priority'	  => 70,
			'choices'	   => array(
				'alpha'		=> true,
			),
			'active_callback'	=> [
				[
					'setting'  => 'woocommerce_button_controls',
					'operator' => '==',
					'value'    => 'hover',
				],
			],
		]
	);

	new \Kirki\Field\Slider(
		[
			'settings'    => 'woocommerce_button_border_width',
			'label'       => esc_html__( 'Border Width (in px)', 'hello-shoppable' ),
			'section'     => 'woocommerce_buttons_options',
			'default'     => 0,
			'choices'     => [
				'min'  => 0,
				'max'  => 5,
				'step' => 1,
			],
			'priority'    => 80,
		]
	);

	new \Kirki\Field\Slider(
		[
			'settings'    => 'woocommerce_button_radius',
			'label'       => esc_html__( 'Border Radius', 'hello-shoppable' ),
			'section'     => 'woocommerce_buttons_options',
			'default'     => 0,
			'choices'     => [
				'min'  => 0,
				'max'  => 100,
				'step' => 1,
			],
			'priority'    => 80,
		]
	);

	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'woocommerce_button_radius_border',
	    'section'     => 'woocommerce_buttons_options',
	    'default'  => wp_kses( '<hr class="customizer_separator">', array(
			    'hr' => array(
			      'class' => array(),
			    ),
		  	)
		),
	    'priority'	  => 100,
	) );

	new \Kirki\Field\Typography(
		[
			'settings'    => 'woocommerce_button_typography',
			'label'       => esc_html__( 'Button Text Typography', 'hello-shoppable' ),
			'section'     => 'woocommerce_buttons_options',
			'priority'    => 110,
			'transport'   => 'auto',
			'default'     => [
				'font-family'     => 'Inter',
				'variant'         => 'regular',
				'font-style'      => 'normal',
				'font-size'       => '15px',
				'line-height'     => '1.6',
				'letter-spacing'  => '0',
				'text-transform'  => 'uppercase',
				'text-decoration' => 'none',
				'text-align'      => '',
			],
			'output'   => array(
				array(
					'element' 	=> array('.woocommerce #respond input#submit', '.woocommerce a.button', '.woocommerce button.button', '.woocommerce input.button', '.woocommerce a.button.alt', '.woocommerce button.button.alt','.woocommerce:where(body:not(.woocommerce-block-theme-has-button-styles)) button.button.alt.disabled','.woocommerce .product-inner .add_to_cart_button','.woocommerce .product-inner .added_to_cart')
				)
			),
		]
	);
}