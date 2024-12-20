<?php if (has_post_thumbnail() ){ ?>
    <div class="wpdevart-images-hover-effect">
        <a href="<?php the_permalink(); ?>"> 
            <div class="<?php echo esc_attr( get_theme_mod( 'wpdevart_jewstore_posts_list_images_hover_effect' ) ); ?>"> 
                <img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" />
            </div>
        </a>
    </div>
<?php } else if ( get_theme_mod( 'wpdevart_jewstore_blog_archive_display_default_featured_image' ) == '1' ) { ?> 
    <div class="wpdevart-images-hover-effect">
        <a href="<?php the_permalink(); ?>"> 
            <div class="<?php echo esc_attr( get_theme_mod( 'wpdevart_jewstore_posts_list_images_hover_effect' ) ); ?>"> 
                <img src="<?php echo esc_url(get_theme_file_uri('/images/wpdevart-no-image.jpg')); ?>" />
            </div>
        </a>
    </div>
    <?php } ?>
<div class="wpdevart-posts-list-title">
<h2 class="post-list-title"><a href="<?php the_permalink(); ?>"><?php if( empty( $post->post_title ) ) { echo esc_html__( 'No Title', 'jewstore'); } else { echo esc_html(wp_trim_words(get_the_title(), 4)); } ?></a></h2>
</div>
<div class="wpdevart-entry-meta">
    <?php echo esc_html(get_the_date('F j, Y')); ?>
    <i class="fa-solid fa-user-tag wpdevart-icon-padding"></i><?php the_author_posts_link(); ?>
    <a href="<?php comments_link(); ?>"><i class="fa-regular fa-comments wpdevart-icon-padding"></i><?php esc_attr(comments_number('0', '1', '%')); ?></a>
</div>
<div class="wpdevart-post-text-content"><p><?php echo esc_html(wp_trim_words(get_the_content(), 20)); ?></p></div>
<?php if ( has_category() ) { ?>
    <div class="wpdevart-entry-meta-category">
        <?php echo get_the_category_list(' '); ?>
    </div>
<?php } ?>