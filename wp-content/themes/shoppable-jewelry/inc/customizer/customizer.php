<?php
/**
 * Enqueue customizer css.
 */

function shoppable_jewelry_customize_enqueue_style() {

	wp_enqueue_style( 'shoppable-jewelry-customize-controls', get_stylesheet_directory_uri() . '/inc/customizer/customizer.css' );
}
add_action( 'customize_controls_enqueue_scripts', 'shoppable_jewelry_customize_enqueue_style', 99 );

/**
 * Kirki Customizer
 *
 * @return void
 */
add_action( 'init' , 'shoppable_jewelry_kirki_fields', 999, 1 );

function shoppable_jewelry_kirki_fields(){

	/**
	* If kirki is not installed do not run the kirki fields
	*/

	if ( !class_exists( 'Kirki' ) ) {
		return;
	}
	
	//Facts
	Kirki::add_section( 'blog_facts', array(
	    'title'          => esc_html__( 'Facts', 'shoppable-jewelry' ),
	    'panel'          => 'blog_homepage_options',
	    'capability'     => 'edit_theme_options',
	    'priority'       => 26,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Facts Section', 'shoppable-jewelry' ),
		'type'         => 'toggle',
		'settings'     => 'facts_section',
		'section'      => 'blog_facts',
		'default'      => false,
		'priority'	   => 10,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Fact one', 'shoppable-jewelry' ),
		'type'        => 'text',
		'settings'    => 'fact_one_title',
		'section'     => 'blog_facts',
		'default'     => '',
		'priority'	   => 20,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Fact One Content', 'shoppable-jewelry' ),
		'type'        => 'text',
		'settings'    => 'fact_one_content',
		'section'     => 'blog_facts',
		'default'     => '',
		'priority'	   => 30,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Fact Two', 'shoppable-jewelry' ),
		'type'        => 'text',
		'settings'    => 'fact_two_title',
		'section'     => 'blog_facts',
		'default'     => '',
		'priority'	   => 40,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Fact Two Content', 'shoppable-jewelry' ),
		'type'        => 'text',
		'settings'    => 'fact_two_content',
		'section'     => 'blog_facts',
		'default'     => '',
		'priority'	   => 50,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Fact Three', 'shoppable-jewelry' ),
		'type'        => 'text',
		'settings'    => 'fact_three_title',
		'section'     => 'blog_facts',
		'default'     => '',
		'priority'	   => 60,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Fact Three Content', 'shoppable-jewelry' ),
		'type'        => 'text',
		'settings'    => 'fact_three_content',
		'section'     => 'blog_facts',
		'default'     => '',
		'priority'	   => 70,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Fact Four', 'shoppable-jewelry' ),
		'type'        => 'text',
		'settings'    => 'fact_four_title',
		'section'     => 'blog_facts',
		'default'     => '',
		'priority'	   => 80,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Fact Four Content', 'shoppable-jewelry' ),
		'type'        => 'text',
		'settings'    => 'fact_four_content',
		'section'     => 'blog_facts',
		'default'     => '',
		'priority'	   => 90,
	) );

	// Responsive for Facts
	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'blog_facts_responsive_separator',
	    'section'     => 'blog_facts',
	    'default'     => esc_html__( 'Responsive', 'shoppable-jewelry' ),
	    'priority'	  => 100,
	    'active_callback' => array(
			array(
				'setting'  => 'facts_section',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Facts Section', 'shoppable-jewelry' ),
		'type'         => 'toggle',
		'settings'     => 'mobile_facts',
		'section'      => 'blog_facts',
		'default'      => true,
		'priority'	   => 110,
		'active_callback' => array(
			array(
				'setting'  => 'facts_section',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	//Centerstage Event
	Kirki::add_section('blog_centerstage_event',array(
		'title'          => esc_html__( 'Centerstage Events', 'shoppable-jewelry' ),
	    'panel'          => 'blog_homepage_options',
	    'capability'     => 'edit_theme_options',
	    'priority'       => 27,
	));

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Centerstage Event Section', 'shoppable-jewelry' ),
		'type'         => 'toggle',
		'settings'     => 'centerstage_event_section',
		'section'      => 'blog_centerstage_event',
		'default'      => false,
		'priority'	   => 10,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Page 1', 'shoppable-jewelry' ),
		'type'        => 'select',
		'settings'    => 'centerstage_event_page_one',
		'section'     => 'blog_centerstage_event',
		'default'     => '',
		'placeholder' => esc_html__( 'Select Page 1', 'shoppable-jewelry' ),
		'choices'     => shoppable_jewelry_get_pages(),
		'priority'	  => 20,
	));

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Page 2', 'shoppable-jewelry' ),
		'type'        => 'select',
		'settings'    => 'centerstage_event_page_two',
		'section'     => 'blog_centerstage_event',
		'default'     => '',
		'placeholder' => esc_html__( 'Select Page 2', 'shoppable-jewelry' ),
		'choices'     => shoppable_jewelry_get_pages(),
		'priority'	  => 30,
	));

	Kirki::add_field('hello-shoppable', array(
		'label'       => esc_html__( 'Page 3', 'shoppable-jewelry' ),
		'type'        => 'select',
		'settings'    => 'centerstage_event_page_three',
		'section'     => 'blog_centerstage_event',
		'default'     => '',
		'placeholder' => esc_html__( 'Select Page 3', 'shoppable-jewelry' ),
		'choices'     => shoppable_jewelry_get_pages(),
		'priority'	  => 40,
	));

	Kirki::add_field('hello-shoppable', array(
		'label'       => esc_html__( 'Page 4', 'shoppable-jewelry' ),
		'type'        => 'select',
		'settings'    => 'centerstage_event_page_four',
		'section'     => 'blog_centerstage_event',
		'default'     => '',
		'placeholder' => esc_html__( 'Select Page 4', 'shoppable-jewelry' ),
		'choices'     => shoppable_jewelry_get_pages(),
		'priority'	  => 50,
	));

	Kirki::add_field('hello-shoppable', array(
		'label'       => esc_html__( 'Page 5', 'shoppable-jewelry' ),
		'type'        => 'select',
		'settings'    => 'centerstage_event_page_five',
		'section'     => 'blog_centerstage_event',
		'default'     => '',
		'placeholder' => esc_html__( 'Select Page 5', 'shoppable-jewelry' ),
		'choices'     => shoppable_jewelry_get_pages(),
		'priority'	  => 60,
	));

	// Responsive for Centerstage Event
	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'centerstage_event_responsive_separator',
	    'section'     => 'blog_centerstage_event',
	    'default'     => esc_html__( 'Responsive', 'shoppable-jewelry' ),
	    'priority'	  => 70,
	    'active_callback' => array(
			array(
				'setting'  => 'centerstage_event_section',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Centerstage Events Section', 'shoppable-jewelry' ),
		'type'         => 'toggle',
		'settings'     => 'mobile_centerstage_events',
		'section'      => 'blog_centerstage_event',
		'default'      => true,
		'priority'	   => 80,
		'active_callback' => array(
			array(
				'setting'  => 'centerstage_event_section',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	//Redemption Codes
	Kirki::add_section( 'blog_redemption_codes', array(
	    'title'          => esc_html__( 'Redemption Codes', 'shoppable-jewelry' ),
	    'panel'          => 'blog_homepage_options',
	    'capability'     => 'edit_theme_options',
	    'priority'       => 28,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Redemption Codes Section', 'shoppable-jewelry' ),
		'type'         => 'toggle',
		'settings'     => 'redemption_codes_section',
		'section'      => 'blog_redemption_codes',
		'default'      => false,
		'priority'	   => 10,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Redemption Code Image One', 'shoppable-jewelry' ),
		'type'         => 'image',
		'settings'     => 'blog_code_image_one',
		'section'      => 'blog_redemption_codes',
		'default'      => '',
		'priority'	   => 20,
		'choices'     => array(
			'save_as' => 'id',
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Redemption code One', 'shoppable-jewelry' ),
		'type'        => 'text',
		'settings'    => 'redemption_code_one_content',
		'section'     => 'blog_redemption_codes',
		'default'     => '',
		'priority'	   => 30,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Redemption Code Image two', 'shoppable-jewelry' ),
		'type'         => 'image',
		'settings'     => 'blog_code_image_two',
		'section'      => 'blog_redemption_codes',
		'default'      => '',
		'priority'	   => 40,
		'choices'     => array(
			'save_as' => 'id',
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Redemption code Two', 'shoppable-jewelry' ),
		'type'        => 'text',
		'settings'    => 'redemption_code_two_content',
		'section'     => 'blog_redemption_codes',
		'default'     => '',
		'priority'	   => 50,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Redemption Code Image Three', 'shoppable-jewelry' ),
		'type'         => 'image',
		'settings'     => 'blog_code_image_three',
		'section'      => 'blog_redemption_codes',
		'default'      => '',
		'priority'	   => 60,
		'choices'     => array(
			'save_as' => 'id',
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Redemption code Three', 'shoppable-jewelry' ),
		'type'        => 'text',
		'settings'    => 'redemption_code_three_content',
		'section'     => 'blog_redemption_codes',
		'default'     => '',
		'priority'	   => 70,
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Redemption Code Image Four', 'shoppable-jewelry' ),
		'type'         => 'image',
		'settings'     => 'blog_code_image_four',
		'section'      => 'blog_redemption_codes',
		'default'      => '',
		'priority'	   => 80,
		'choices'     => array(
			'save_as' => 'id',
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'       => esc_html__( 'Redemption code Four', 'shoppable-jewelry' ),
		'type'        => 'text',
		'settings'    => 'redemption_code_four_content',
		'section'     => 'blog_redemption_codes',
		'default'     => '',
		'priority'	   => 90,
	) );

	// Responsive for Redemption Code
	Kirki::add_field( 'hello-shoppable', array(
	    'type'        => 'custom',
	    'settings'    => 'redemption_code_responsive_separator',
	    'section'     => 'blog_redemption_codes',
	    'default'     => esc_html__( 'Responsive', 'shoppable-jewelry' ),
	    'priority'	  => 100,
	    'active_callback' => array(
			array(
				'setting'  => 'redemption_codes_section',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );

	Kirki::add_field( 'hello-shoppable', array(
		'label'        => esc_html__( 'Redemption Codes Section', 'shoppable-jewelry' ),
		'type'         => 'toggle',
		'settings'     => 'mobile_redemption_codes',
		'section'      => 'blog_redemption_codes',
		'default'      => true,
		'priority'	   => 110,
		'active_callback' => array(
			array(
				'setting'  => 'redemption_codes_section',
				'operator' => '==',
				'value'    => true,
			),
		),
	) );
}