<?php
$shoppable_jewelry_page_one 	= get_theme_mod( 'centerstage_event_page_one', '' );
$shoppable_jewelry_page_two 	= get_theme_mod( 'centerstage_event_page_two', '' );
$shoppable_jewelry_page_three = get_theme_mod( 'centerstage_event_page_three', '' );
$shoppable_jewelry_page_four  = get_theme_mod( 'centerstage_event_page_four', '' );
$shoppable_jewelry_page_five  = get_theme_mod( 'centerstage_event_page_five', '');

$shoppable_jewelry_page_array = array();
$shoppable_jewelry_has_page = false;
$shoppable_jewelry_has_array = false;
if( !empty( $shoppable_jewelry_page_one ) ){
	$shoppable_jewelry_has_page = true;	
}
if( !empty( $shoppable_jewelry_page_two ) ){
	$shoppable_jewelry_has_page = true;
	$shoppable_jewelry_has_array = true;
	$shoppable_jewelry_page_array['page_two'] = array(
		'ID' => $shoppable_jewelry_page_two,
	);
}
if( !empty( $shoppable_jewelry_page_three ) ){
	$shoppable_jewelry_has_page = true;
	$shoppable_jewelry_has_array = true;
	$shoppable_jewelry_page_array['page_three'] = array(
		'ID' => $shoppable_jewelry_page_three,
	);
}
if( !empty( $shoppable_jewelry_page_four ) ){
	$shoppable_jewelry_has_page = true;
	$shoppable_jewelry_has_array = true;
	$shoppable_jewelry_page_array['page_four'] = array(
		'ID' => $shoppable_jewelry_page_four,
	);
}
if( !empty( $shoppable_jewelry_page_five ) ){
	$shoppable_jewelry_has_page = true;
	$shoppable_jewelry_has_array = true;
	$shoppable_jewelry_page_array['page_five'] = array(
		'ID' => $shoppable_jewelry_page_five,
	);
}

if( get_theme_mod( 'centerstage_event_section', false ) && $shoppable_jewelry_has_page ){ ?>
	<section class="section-centerstage-event-area">
		<?php if( !empty( $shoppable_jewelry_page_one ) ){ ?>
			<div class="section-title-wrap text-center col-lg-6 offset-lg-3 col-md-8 offset-md-2">
				<h2 class="section-title">
					<a href="<?php echo esc_url( get_permalink( $shoppable_jewelry_page_one ) ); ?>">
						<?php echo esc_html( get_the_title( $shoppable_jewelry_page_one ) ); ?>
					</a>
				</h2>
				<p>
					<?php 
					$shoppable_jewelry_excerpt = get_the_excerpt( $shoppable_jewelry_page_one );
					$shoppable_jewelry_result  = wp_trim_words( $shoppable_jewelry_excerpt, 18, '' );
					echo esc_html( $shoppable_jewelry_result );?>	
				</p>
			</div>
		<?php }
		if ( $shoppable_jewelry_has_array ){ ?>
			<div class="row">
				<?php foreach( $shoppable_jewelry_page_array as $shoppable_jewelry_each_page ){ ?>
					<div class="col-12">
						<div class="event-wrapper">
							<article class="event-iconbox">
								<div class="event-icon">
									<i class="fas fa-calendar-check"></i>
								</div>
								<div class="entry-content">
									<h3 class="entry-title">
										<a href="<?php echo esc_url( get_permalink( $shoppable_jewelry_each_page[ 'ID' ] ) ); ?>">
											<?php echo esc_html( get_the_title( $shoppable_jewelry_each_page[ 'ID' ] ) ); ?>
										</a>
									</h3>
									<div class="entry-text">
										<?php 
										$shoppable_jewelry_excerpt = get_the_excerpt( $shoppable_jewelry_each_page[ 'ID' ] );
										$shoppable_jewelry_result  = wp_trim_words( $shoppable_jewelry_excerpt, 15, '' );
										echo esc_html( $shoppable_jewelry_result );
										?>
									</div>
								</div>
								<a href="<?php echo esc_url( get_permalink( $shoppable_jewelry_each_page[ 'ID' ] ) ); ?>" class="event-page-link">
									<i class="fas fa-plus"></i>
								</a>
							</article>
						</div>
					</div>
				<?php } ?>
			</div>
		<?php } ?>
	</section>	
<?php } ?>