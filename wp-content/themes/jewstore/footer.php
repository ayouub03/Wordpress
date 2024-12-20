<?php

      $footer_layout = get_theme_mod( 'wpdevart_jewstore_footer_layout' );
      if ( $footer_layout == 'wpdevartthreewidgetsleft' )  {
        get_template_part( 'template-parts/footer/footer-layout-one' );
      } 
      elseif ( $footer_layout == 'wpdevartthreewidgetscenter') {
        get_template_part( 'template-parts/footer/footer-layout-two' );
      } 
      elseif ( $footer_layout == 'wpdevartthreewidgetsright') {
          get_template_part( 'template-parts/footer/footer-layout-three' );
      } 
      elseif ( $footer_layout == 'wpdevartfourwidgets') {
          get_template_part( 'template-parts/footer/footer-layout-four' );
      }
      elseif ( $footer_layout == 'wpdevartfourwidgetsalternative') {
        get_template_part( 'template-parts/footer/footer-layout-five' );
      }
      elseif ( $footer_layout == 'wpdevartfivewidgets') {
        get_template_part( 'template-parts/footer/footer-layout-six' );
      }
      ?>

    <?php get_template_part('template-parts/partials/popup-search'); ?>
  
<?php wp_footer(); ?>
</body>    
</html>





