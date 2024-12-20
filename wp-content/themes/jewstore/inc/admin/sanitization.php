<?php

##################------ Sanitization ------##################

if ( ! function_exists( 'wpdevart_jewstore_switch_sanitization' ) ) {
    function wpdevart_jewstore_switch_sanitization( $input ) {
        if ( true == $input ) {
            return 1;
        } else {
            return 0;
        }
    }
}

if ( ! function_exists( 'wpdevart_jewstore_url_sanitization' ) ) {
    function wpdevart_jewstore_url_sanitization( $input ) {
        if ( strpos( $input, ',' ) !== false) {
            $input = explode( ',', $input );
        }
        if ( is_array( $input ) ) {
            foreach ($input as $key => $value) {
                $input[$key] = esc_url_raw( $value );
            }
            $input = implode( ',', $input );
        }
        else {
            $input = esc_url_raw( $input );
        }
        return $input;
    }
}

if ( ! function_exists( 'wpdevart_jewstore_sanitize_integer' ) ) {
    function wpdevart_jewstore_sanitize_integer( $input ) {
        return (int) $input;
    }
}
if ( ! function_exists( 'wpdevart_jewstore_text_sanitization' ) ) {
    function wpdevart_jewstore_text_sanitization( $input ) {
        if ( strpos( $input, ' ,' ) !== false) {
            $input = explode( ' ,', $input );
        }
        if( is_array( $input ) ) {
            foreach ( $input as $key => $value ) {
                $input[$key] = sanitize_text_field( $value );
            }
            $input = implode( ' ,', $input );
        }
        else {
            $input = sanitize_text_field( $input );
        }
        return $input;
    }
}