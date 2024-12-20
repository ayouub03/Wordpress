<?php 
    function wpdevart_jewstore_enqueue_fonts_url() {
        $wpdevartFontFamily = get_theme_mod( 'wpdevart_jewstore_global_fonts' );
        $fonts_url = '';
        $fonts     = array();
        $subsets   = '';
        if (  $wpdevartFontFamily == "Roboto"  ) {
            $fonts[] = "Roboto:300,400,500,600,700";
        }
        if (  $wpdevartFontFamily == "Poppins"  ) {
            $fonts[] = "Poppins:300,400,500,600,700,800,900";
        }
        if (  $wpdevartFontFamily == "Open Sans"  ) {
            $fonts[] = "Open Sans:300,400,500,600,700,800,900";
        }
        if (  $wpdevartFontFamily == "Alegreya"  ) {
            $fonts[] = "Alegreya:300,400,500,600,700,800,900";
        }
        if (  $wpdevartFontFamily == "Alegreya Sans"  ) {
            $fonts[] = "Alegreya Sans:300,400,500,600,700,800,900";
        }
        if (  $wpdevartFontFamily == "Lato"  ) {
            $fonts[] = "Lato:300,400,500,600,700,800,900";
        }
        if (  $wpdevartFontFamily == "Montserrat"  ) {
            $fonts[] = "Montserrat:300,400,500,600,700,800,900";
        }
        if (  $wpdevartFontFamily == "Oswald"  ) {
            $fonts[] = "Oswald:300,400,500,600,700,800,900";
        }
        if (  $wpdevartFontFamily == "Raleway"  ) {
            $fonts[] = "Raleway:300,400,500,600,700,800,900";
        }
        if (  $wpdevartFontFamily == "Inknut Antiqua"  ) {
            $fonts[] = "Inknut Antiqua:300,400,500,600,700,800,900";
        };
        $is_ssl = is_ssl() ? 'https' : 'http';
    
        if (  $fonts  ) {
            $fonts_url = add_query_arg( array(
                'family' => urlencode( implode( '|', $fonts  ) ),
                'subset' => urlencode( $subsets ),
            ), "$is_ssl://fonts.googleapis.com/css" );
        }
        return esc_url($fonts_url);
}