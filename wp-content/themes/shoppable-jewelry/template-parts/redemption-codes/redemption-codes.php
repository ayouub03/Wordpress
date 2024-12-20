<?php
$shoppable_jewelry_blogcodeimageoneID = get_theme_mod( 'blog_code_image_one','');
$shoppable_jewelry_blogcodeimagetwoID = get_theme_mod( 'blog_code_image_two','');       
$shoppable_jewelry_blogcodeimagethreeID = get_theme_mod( 'blog_code_image_three','');
$shoppable_jewelry_blogcodeimagefourID = get_theme_mod( 'blog_code_image_four','');
$shoppable_jewelry_blogcodeoneID = get_theme_mod( 'redemption_code_one_content','');
$shoppable_jewelry_blogcodetwoID = get_theme_mod( 'redemption_code_two_content','');
$shoppable_jewelry_blogcodethreeID = get_theme_mod( 'redemption_code_three_content','');
$shoppable_jewelry_blogcodefourID = get_theme_mod( 'redemption_code_four_content','');

$shoppable_jewelry_vouchers_array = array();
$shoppable_jewelry_has_code_img = false;
$shoppable_jewelry_has_code_txt = false;
if( !empty( $shoppable_jewelry_blogcodeimageoneID ) ){
	$shoppable_jewelry_blog_voucher_one  = wp_get_attachment_image_src( $shoppable_jewelry_blogcodeimageoneID,'hello-shoppable-420-300');
 	if ( is_array(  $shoppable_jewelry_blog_voucher_one ) ){
 		$shoppable_jewelry_has_code_img = true;
 		$shoppable_jewelry_has_code_txt = true;
   	 	$shoppable_jewelry_blog_vouchers_one = $shoppable_jewelry_blog_voucher_one[0];
   	 	$shoppable_jewelry_vouchers_array['image_one'] = array(
			'ID' => $shoppable_jewelry_blog_vouchers_one,
			'txt' => $shoppable_jewelry_blogcodeoneID,
		);	
  	}
}
if( !empty( $shoppable_jewelry_blogcodeimagetwoID ) ){
	$shoppable_jewelry_blog_voucher_two = wp_get_attachment_image_src( $shoppable_jewelry_blogcodeimagetwoID,'hello-shoppable-420-300');
	if ( is_array(  $shoppable_jewelry_blog_voucher_two ) ){
		$shoppable_jewelry_has_code_img = true;
		$shoppable_jewelry_has_code_txt = true;	
        $shoppable_jewelry_blog_vouchers_two = $shoppable_jewelry_blog_voucher_two[0];
        $shoppable_jewelry_vouchers_array['image_two'] = array(
			'ID' => $shoppable_jewelry_blog_vouchers_two,
			'txt' => $shoppable_jewelry_blogcodetwoID,
		);	
  	}
}
if( !empty( $shoppable_jewelry_blogcodeimagethreeID ) ){	
	$shoppable_jewelry_blog_voucher_three = wp_get_attachment_image_src( $shoppable_jewelry_blogcodeimagethreeID,'hello-shoppable-420-300');
	if ( is_array(  $shoppable_jewelry_blog_voucher_three ) ){
		$shoppable_jewelry_has_code_img = true;
		$shoppable_jewelry_has_code_txt = true;
      	$shoppable_jewelry_blog_vouchers_three = $shoppable_jewelry_blog_voucher_three[0];
      	$shoppable_jewelry_vouchers_array['image_three'] = array(
			'ID' => $shoppable_jewelry_blog_vouchers_three,
			'txt' => $shoppable_jewelry_blogcodethreeID,
		);	
  	}
}
if( !empty( $shoppable_jewelry_blogcodeimagefourID ) ){	
	$shoppable_jewelry_blog_voucher_four = wp_get_attachment_image_src( $shoppable_jewelry_blogcodeimagefourID,'hello-shoppable-420-300');
	if ( is_array(  $shoppable_jewelry_blog_voucher_four ) ){
		$shoppable_jewelry_has_code_img = true;
		$shoppable_jewelry_has_code_txt = true;
      	$shoppable_jewelry_blog_vouchers_four = $shoppable_jewelry_blog_voucher_four[0];
      	$shoppable_jewelry_vouchers_array['image_four'] = array(
			'ID' => $shoppable_jewelry_blog_vouchers_four,
			'txt' => $shoppable_jewelry_blogcodefourID,
		);	
  	}
}

if( get_theme_mod( 'redemption_codes_section', false ) && $shoppable_jewelry_has_code_img && $shoppable_jewelry_has_code_txt ){ ?>
	<section class="section-redemption-code-area">
		<div class="row">
			<?php foreach( $shoppable_jewelry_vouchers_array as $shoppable_jewelry_each_vouchers ){ ?>
				<div class="col-md-3 col-sm-6">
					<article class="redeem-code-content-wrap">
						<figure class= "featured-image">
							<img src="<?php echo esc_url( $shoppable_jewelry_each_vouchers['ID'] ); ?>">
						</figure>
						<?php if( !empty( $shoppable_jewelry_each_vouchers['txt'] ) ) { ?>
							<div class="redeem-code-txt">
								<?php
									echo esc_html( $shoppable_jewelry_each_vouchers['txt'] );
								?>
							</div>
						<?php } ?>
					</article>
				</div>
			<?php } ?>
		</div>	
	</section>
<?php } ?>