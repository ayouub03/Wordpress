<?php
/**
 * Template part for displaying site info
 *
 * @package Shoppable Jewelry
 */

?>

<div class="site-info">
	<?php
    $shoppable_jewelry_site_info = wp_kses_post( html_entity_decode( esc_html__( 'Copyright &copy; ' , 'shoppable-jewelry' ) ) ) .  esc_html( date( 'Y' ) ) . ' '.  esc_html( get_bloginfo( 'name' ) ) . esc_html__( '. Powered by', 'shoppable-jewelry' ) . ' <a href="'.   esc_url( __( "https://wordpress.org/", "shoppable-jewelry" ) ) . '" target="_blank"> ' . esc_html__( 'WordPress', 'shoppable-jewelry' ) . '</a>';

    echo apply_filters( 'shoppable_copyright', $shoppable_jewelry_site_info ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
   ?>
</div><!-- .site-info -->