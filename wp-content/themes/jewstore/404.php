<?php get_header(); ?>

  <div class="wpdevart-not-found-page-content">

        <div class="wpdevart-not-found-page-image-container">
            <?php if (!empty(get_theme_mod( 'wpdevart_jewstore_not_found_image' ))) { ?><div class="wpdevart-not-found-page-image"><img src="<?php echo esc_url( get_theme_mod( 'wpdevart_jewstore_not_found_image' ) ); ?>"></div> <?php } ?>
        </div>

        <div class="wpdevart-not-found-content-elements" id="content_navigator"><h1 class="wpdevart-not-found-titile"><?php echo esc_html( get_theme_mod( 'wpdevart_jewstore_not_found_page_title' ) ); ?></h1></div>
        <div class="wpdevart-not-found-content-elements"><p class="wpdevart-not-found-desc"><?php echo esc_html( get_theme_mod( 'wpdevart_jewstore_not_found_page_description' ) );  ?></p></div>
        <div class="wpdevart-not-found-content-elements">
            <a href="<?php echo esc_url( get_theme_mod( 'wpdevart_jewstore_not_found_page_button_url' ) );  ?>"><div class="wpdevart_jewstore_hover_button <?php echo esc_attr( get_theme_mod( 'wpdevart_jewstore_not_found_page_button_style' ) ); ?>"><?php echo esc_html( get_theme_mod( 'wpdevart_jewstore_not_found_page_button_text' ) );  ?></div></a>
        </div>
        <div class="wpdevart-not-found-content-elements">
          <div class="wpdevart-search-page-form"><?php get_search_form(); ?></div>
        </div>
  </div>

<?php get_footer(); ?>