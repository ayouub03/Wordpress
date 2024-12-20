<?php

function shoppable_jewelry_default_styles(){

	// Begin Style
	$shoppable_jewelry_css = '<style>';

	# Responsive Facts
	if( !get_theme_mod( 'mobile_facts', true ) ){
		$shoppable_jewelry_css .= '
			@media screen and (max-width: 767px){
				.section-facts-area {
	    			display: none;
				}
			}
		';
	}

	# Responsive Centerstage Events
	if( !get_theme_mod( 'mobile_centerstage_events', true ) ){
		$shoppable_jewelry_css .= '
			@media screen and (max-width: 767px){
				.section-centerstage-event-area {
	    			display: none;
				}
			}
		';
	}

	# Responsive Redemption code
	if( !get_theme_mod( 'mobile_redemption_codes', true ) ){
		$shoppable_jewelry_css .= '
			@media screen and (max-width: 767px){
				.section-redemption-code-area {
	    			display: none;
				}
			}
		';
	}

	// End Style
	$shoppable_jewelry_css .= '</style>';

	// return generated & compressed CSS
	echo str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $shoppable_jewelry_css); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}
add_action( 'wp_head', 'shoppable_jewelry_default_styles', 99 );