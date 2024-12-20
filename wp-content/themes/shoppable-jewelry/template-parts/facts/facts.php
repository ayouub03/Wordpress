<?php
$shoppable_jewelry_fact_one_title 	= get_theme_mod( 'fact_one_title', '' );
$shoppable_jewelry_fact_one_content   = get_theme_mod( 'fact_one_content', '' );

$shoppable_jewelry_fact_two_title 	= get_theme_mod( 'fact_two_title', '' );
$shoppable_jewelry_fact_two_content   = get_theme_mod( 'fact_two_content', '' );

$shoppable_jewelry_fact_three_title   = get_theme_mod( 'fact_three_title', '' );
$shoppable_jewelry_fact_three_content = get_theme_mod( 'fact_three_content', '' );

$shoppable_jewelry_fact_four_title    = get_theme_mod( 'fact_four_title', '' );
$shoppable_jewelry_fact_four_content  = get_theme_mod( 'fact_four_content', '' );


$shoppable_jewelry_fact_array = array();
$shoppable_jewelry_has_fact = false;
if( !empty( $shoppable_jewelry_fact_one_title) || !empty($shoppable_jewelry_fact_one_content ) ){
	$shoppable_jewelry_has_fact = true;
	$shoppable_jewelry_fact_array['fact_one'] = array(
		'title' => $shoppable_jewelry_fact_one_title,
		'content' => $shoppable_jewelry_fact_one_content,
	);
}
if( !empty($shoppable_jewelry_fact_two_title) || !empty($shoppable_jewelry_fact_two_content ) ){
	$shoppable_jewelry_has_fact = true;
	$shoppable_jewelry_fact_array['fact_two'] = array(
		'title' => $shoppable_jewelry_fact_two_title,
		'content' => $shoppable_jewelry_fact_two_content,
	);
}
if( !empty( $shoppable_jewelry_fact_three_title) || !empty($shoppable_jewelry_fact_three_content) ){
	$shoppable_jewelry_has_fact = true;
	$shoppable_jewelry_fact_array['fact_three'] = array(
		'title' => $shoppable_jewelry_fact_three_title,
		'content' => $shoppable_jewelry_fact_three_content,
	);
}
if( !empty( $shoppable_jewelry_fact_four_title) || !empty($shoppable_jewelry_fact_four_content) ){
	$shoppable_jewelry_has_fact = true;
	$shoppable_jewelry_fact_array['fact_four'] = array(
		'title' => $shoppable_jewelry_fact_four_title,
		'content' => $shoppable_jewelry_fact_four_content,
	);
}

if( get_theme_mod( 'facts_section', false ) && $shoppable_jewelry_has_fact ){ ?>
	<section class="section-facts-area">
		<div class="row justify-content-center">
			<?php foreach( $shoppable_jewelry_fact_array as $shoppable_jewelry_each_fact ){ ?>
				<div class="col-md-6">
					<article class="info-content-wrap">
						<figure class="info-icon">
							<i class="fa-solid fa-circle-info"></i>
						</figure>					
						<div class="entry-content">
							<header class="entry-header">
								<h3 class="entry-title">
									<?php echo esc_html( $shoppable_jewelry_each_fact['title'] ); ?>
								</h3>
								<p>
								<?php echo esc_html( $shoppable_jewelry_each_fact['content'] ); ?>
								</p>
							</header>
						</div>
					</article>
				</div>
			<?php } ?>
		</div>
	</section>
<?php } ?>  