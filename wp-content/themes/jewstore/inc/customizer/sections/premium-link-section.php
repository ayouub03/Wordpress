<?php

##################------ Pro Button Section ------##################
	$wp_customize->register_section_type( 'wpdevart_jewstore_Section_Premium' );

	$wp_customize->add_section(
		new wpdevart_jewstore_Section_Premium(
			$wp_customize,
			'theme_upsell',
			array(
				'title'    => esc_html__('JewStore','jewstore'),
				'pro_text' => esc_html__('Premium','jewstore'),
				'pro_url'  => apply_filters( 'parent_wpdevart_jewstore_premium_features_url', esc_url('https://wpdevart.com/jewstore-best-wordpress-jewelry-store-theme')),
				'priority'  => 10,
			)
		)
	);