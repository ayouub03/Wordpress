<?php
/**
 * Title: Banner Block
 * Slug: antique-jewelry/banner-block
 * Categories: banner
 * Block Types: core/template-part/banner
 */
?>

<!-- wp:cover {"customOverlayColor":"#6c2f53","isUserOverlayColor":true,"minHeight":600,"minHeightUnit":"px","className":"slider-area"} -->
<div class="wp-block-cover slider-area" style="min-height:600px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-100 has-background-dim" style="background-color:#6c2f53"></span><div class="wp-block-cover__inner-container"><!-- wp:group {"className":"wow fadeInLeft","layout":{"type":"constrained"}} -->
<div class="wp-block-group wow fadeInLeft"><!-- wp:columns {"verticalAlignment":"center","align":"wide","className":"slider-banner"} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center slider-banner"><!-- wp:column {"verticalAlignment":"center","width":"40%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:40%"><!-- wp:image {"id":27,"sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full"><img src="<?php echo esc_url(get_template_directory_uri()) ?>/assets/images/banner-image.png"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","className":"slider-content"} -->
<div class="wp-block-column is-vertically-aligned-center slider-content"><!-- wp:heading {"level":5,"style":{"typography":{"fontSize":"1rem","fontStyle":"normal","fontWeight":"500"},"spacing":{"margin":{"top":"0","bottom":"0","left":"0","right":"0"}}},"fontFamily":"sofia-sans-semi-condensed"} -->
<h5 class="wp-block-heading has-sofia-sans-semi-condensed-font-family" style="margin-top:0;margin-right:0;margin-bottom:0;margin-left:0;font-size:1rem;font-style:normal;font-weight:500"><?php echo esc_html('Athlone Paris','antique-jewelry'); ?></h5>
<!-- /wp:heading -->

<!-- wp:heading {"style":{"typography":{"textTransform":"uppercase","letterSpacing":"2px","fontSize":"42px"},"spacing":{"margin":{"right":"0","left":"0","top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}}},"textColor":"background","className":"is-slide-heading","fontFamily":"barlow-condensed"} -->
<h2 class="wp-block-heading is-slide-heading has-background-color has-text-color has-barlow-condensed-font-family" style="margin-top:var(--wp--preset--spacing--30);margin-right:0;margin-bottom:var(--wp--preset--spacing--30);margin-left:0;font-size:42px;letter-spacing:2px;text-transform:uppercase"><strong><?php echo esc_html('Unveil the Beauty of Handcrafted Jewelry','antique-jewelry'); ?></strong></h2>
<!-- /wp:heading -->

<!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:buttons {"className":"slide-btn"} -->
<div class="wp-block-buttons slide-btn"><!-- wp:button {"textColor":"contrast","style":{"color":{"background":"#ffd600"},"border":{"radius":"10px"},"spacing":{"padding":{"left":"15px","right":"15px","top":"8px","bottom":"8px"}},"typography":{"fontStyle":"normal","fontWeight":"600","textTransform":"uppercase","fontSize":"18px","letterSpacing":"1px"}},"className":"theme-btn","fontFamily":"barlow-condensed"} -->
<div class="wp-block-button has-custom-font-size theme-btn has-barlow-condensed-font-family" style="font-size:18px;font-style:normal;font-weight:600;letter-spacing:1px;text-transform:uppercase"><a class="wp-block-button__link has-contrast-color has-text-color has-background wp-element-button" href="#" style="border-radius:10px;background-color:#ffd600;padding-top:8px;padding-right:15px;padding-bottom:8px;padding-left:15px"><?php echo esc_html('Shop Collection','antique-jewelry'); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover -->