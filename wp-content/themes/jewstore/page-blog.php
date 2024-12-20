<?php get_header(); ?>

    <div class="page-banner">
        <div class="<?php if (empty(get_theme_mod( 'wpdevart_jewstore_archive_banner_bg_gradient_color' ))) 
                                { echo esc_attr( 'wpdevart-archive-banner__bg' ); } 
                                    else { echo esc_attr('wpdevart-archive-banner__bg-gradient'); } ?>">
        </div>
        <div class="container <?php if ( get_theme_mod( 'wpdevart_jewstore_archive_banner_width' ) == 'narrow' ) { echo esc_attr('wpdevart-banner-narrow-container'); } ?>">
            <h1 class="archive-banner__title"><?php the_title(); ?></h1>
        </div>
    </div>

    <?php get_template_part( 'template-parts/content/content' ); ?>

<?php get_footer(); ?>