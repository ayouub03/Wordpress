<?php
/**
 * Customizer
 * 
 * @package WordPress
 * @subpackage antique-jewelry
 * @since antique-jewelry 1.0
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function antique_jewelry_customize_register( $wp_customize ) {
    // Check for existence of WP_Customize_Manager before proceeding
	if ( ! class_exists( 'WP_Customize_Manager' ) ) {
        return;
    }
    
    // Add the custom upsell section to the customizer
	$wp_customize->add_section( new Antique_Jewelry_Upsell_Section( $wp_customize, 'upsell_section', array(
		'title'       => __( 'Antique Jewelry', 'antique-jewelry' ),
		'button_text' => __( 'GO TO PREMIUM', 'antique-jewelry' ),
		'url'         => esc_url( ANTIQUE_JEWELRY_BUY_NOW ),
		'priority'    => 0,
	)));
}
add_action( 'customize_register', 'antique_jewelry_customize_register' );

if ( class_exists( 'WP_Customize_Section' ) ) {
	class Antique_Jewelry_Upsell_Section extends WP_Customize_Section {
		public $type = 'antique-jewelry-upsell';
		public $button_text = '';
		public $url = '';

		protected function render() {
			?>
			<li id="accordion-section-<?php echo esc_attr( $this->id ); ?>" class="antique_jewelry_upsell_section accordion-section control-section control-section-<?php echo esc_attr( $this->id ); ?> cannot-expand">
				<h3 class="accordion-section-title">
					<?php echo esc_html( $this->title ); ?>
					<a href="<?php echo esc_url( $this->url ); ?>" class="button button-secondary alignright" target="_blank" style="margin-top: -4px;"><?php echo esc_html( $this->button_text ); ?></a>
				</h3>
			</li>
			<?php
		}
	}
}

/**
 * Enqueue script for custom customize control.
 */
function antique_jewelry_custom_control_scripts() {
	wp_enqueue_script( 'antique-jewelry-custom-controls-js', get_template_directory_uri() . '/assets/js/custom-controls.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-sortable' ), '1.0', true );

    wp_enqueue_style( 'antique-jewelry-customizer-css', get_template_directory_uri() . '/assets/css/customizer.css', array(), '1.0' );
}
add_action( 'customize_controls_enqueue_scripts', 'antique_jewelry_custom_control_scripts' );