<?php get_header(); ?>
 
    <div class="page-banner">
          <div class="<?php if (empty(get_theme_mod( 'wpdevart_jewstore_archive_banner_bg_gradient_color' ))) 
                                { echo esc_attr( 'wpdevart-archive-banner__bg' ); } 
                                    else { echo esc_attr('wpdevart-archive-banner__bg-gradient'); } ?>">
          </div>
          <div class="container <?php if ( get_theme_mod( 'wpdevart_jewstore_archive_banner_width' ) == 'narrow' ) { echo esc_attr('wpdevart-banner-narrow-container'); } ?>"><h1 class="archive-banner__title"><?php the_archive_title(); ?></h1></div>
    </div>

    <div class="wpdevart-main-container">
    <div class="container <?php if (( get_theme_mod( 'wpdevart_jewstore_blog_archive_page_layout' ) != 'sidebarnone' ) && ( get_theme_mod( 'wpdevart_jewstore_blog_archive_page_layout' ) == 'sidebarleft' ))
                                                    { echo esc_attr('container-with-sidebar wpdevart-main-content-sidebarleft'); } 
                                                else if (( get_theme_mod( 'wpdevart_jewstore_blog_archive_page_layout' ) != 'sidebarnone' ) && ( get_theme_mod( 'wpdevart_jewstore_blog_archive_page_layout' ) != 'sidebarleft' )) 
                                                    { echo esc_attr('container-with-sidebar'); } 
                                                ?> wpdevart-main-content" id="content_navigator">
    <div role="main" class="<?php  if ( get_theme_mod( 'wpdevart_jewstore_blog_archive_page_layout' ) == 'sidebarnone' ) { echo esc_attr('wpdevart-posts-list-with-pagination-full-width'); } else { echo esc_attr('wpdevart-posts-list-with-pagination'); } ?>">
        <div class="wpdevart-posts-list-with-pagination-inner">
            <?php if( !is_singular() && have_posts() ) {
                      while ( have_posts() ) : the_post();
                      ?> <div class="<?php  if ( get_theme_mod( 'wpdevart_jewstore_blog_archive_page_layout' ) == 'sidebarnone' ) { echo esc_attr('wpdevart-post-summary-content-full-width'); } else { echo esc_attr('wpdevart-post-summary-content'); } ?>"> <?php
                            get_template_part( 'template-parts/content/posts-list' );
                      ?> </div> <?php
                      endwhile; 
                    } 
            ?>  
        </div> 

        <div class="wpdevart-pagination">
            <div class="wpdevart-pagination-container">                         
              <?php
              echo paginate_links(array(
                'show_all'     => False,
                'end_size'     => 2,
                'mid_size'     => 2,
                'prev_next'    => true,
                'prev_text'    => esc_attr('<'),
                'next_text'    => esc_attr('>'),
                'type'         => 'list',
                'add_args'     => False,
                'add_fragment' => '',
                'before_page_number' => '',
                'after_page_number'  => ''
              ));
              ?>
            </div>
        </div>

    </div>
    <?php if ( get_theme_mod( 'wpdevart_jewstore_blog_archive_page_layout' ) != 'sidebarnone' ) { get_template_part( 'template-parts/sidebar/sidebar-default' ); } ?>
    </div>
    </div>

<?php get_footer(); ?>