<?php get_header(); 
  if ( get_option('show_on_front') == 'posts' && is_home() && is_front_page() && get_theme_mod( 'wpdevart_jewstore_custom_homepage_display_option' ) == '1' ) {
    ?>

    <?php 
          $homepageBannerTheme = get_theme_mod( 'wpdevart_jewstore_custom_homepage_banner_theme' );
          if ( $homepageBannerTheme == 'banner-first-theme' )  {
            get_template_part( 'template-parts/partials/custom-homepage/banner/banner-first-theme' );
          } 
          elseif ( $homepageBannerTheme == 'banner-second-theme') {
            get_template_part( 'template-parts/partials/custom-homepage/banner/banner-second-theme' );
          } 
    ?>
    
    <?php if (get_theme_mod( 'wpdevart_jewstore_custom_homepage_hide_call_action', '1' )) { } else { 
          get_template_part( 'template-parts/partials/custom-homepage/wpdevart-call-to-action' );
    }; ?>
 
    <?php if (get_theme_mod( 'wpdevart_jewstore_custom_homepage_hide_latest_post_section', '1' )) { } else {
          get_template_part( 'template-parts/partials/custom-homepage/wpdevart-latest-post-section' );
    }; 

    } 
    
    else if ( get_option('show_on_front') == 'posts' && is_home() && is_front_page() && get_theme_mod( 'wpdevart_jewstore_custom_homepage_display_option' ) != '1' ) { 
      get_template_part( 'template-parts/content/content' );
    }

    else {
            while(have_posts()) {
              the_post(); 
              ?>
                  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                      <div class="page-banner">
						  <div class="<?php if (empty(get_theme_mod( 'wpdevart_jewstore_single_page_banner_gradient_color' ))) 
							  { echo esc_attr( 'wpdevart-page-banner__bg' ); } 
								else { echo esc_attr('wpdevart-page-banner__bg-gradient'); } ?>">
						  </div>
                          <div class="container <?php if ( get_theme_mod( 'wpdevart_jewstore_single_page_banner_width' ) == 'narrow' ) { echo esc_attr('wpdevart-banner-narrow-container'); } ?>">
                              <div class="page-banner-content"><h1 class="page-banner__title"><?php the_title(); ?></h1>
                              </div>
                          </div>
                      </div>

                      <div class="wpdevart-main-container">
                      <div role="main" class="container <?php if (( get_theme_mod( 'wpdevart_jewstore_single_page_layout' ) != 'sidebarnone' ) && ( get_theme_mod( 'wpdevart_jewstore_single_page_layout' ) == 'sidebarleft' ))
                                                    { echo esc_attr('container-with-sidebar wpdevart-main-content-sidebarleft'); } 
                                                else if (( get_theme_mod( 'wpdevart_jewstore_single_page_layout' ) != 'sidebarnone' ) && ( get_theme_mod( 'wpdevart_jewstore_single_page_layout' ) != 'sidebarleft' )) 
                                                    { echo esc_attr('container-with-sidebar'); } 
                                                ?> wpdevart-main-content" id="content_navigator">
                            <div class="generic-content <?php if ( get_theme_mod( 'wpdevart_jewstore_single_page_layout' ) == 'sidebarnone' ) { echo esc_attr('generic-content-full-width'); } ?>">
                                <?php get_template_part( 'template-parts/content/generic-content' ); ?>
                            </div>
                            <?php if ( get_theme_mod( 'wpdevart_jewstore_single_page_layout' ) != 'sidebarnone' ) { get_template_part( 'template-parts/sidebar/sidebar-default' ); } ?>
                      </div>
                      </div>
                  </article>
              <?php }
    }

get_footer(); ?>