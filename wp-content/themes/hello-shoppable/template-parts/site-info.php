<?php
/**
 * Template part for displaying site info
 *
 * @package Hello Shoppable
 */

?>

<div class="site-info">
	<?php
    $site_info = wp_kses_post( html_entity_decode( esc_html__( 'Copyright &copy; ' , 'hello-shoppable' ) ) ) .  esc_html( date( 'Y' ) ) . esc_html__( ' Hello Shoppable. Powered by', 'hello-shoppable' ) . ' <a href="'.   esc_url( __( "https://wordpress.org/", "hello-shoppable" ) ) . '" target="_blank"> ' . esc_html__( 'WordPress', 'hello-shoppable' ) . '</a>';

    echo apply_filters( 'shoppable_copyright', $site_info ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
   ?>
</div><!-- .site-info -->
