<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Hello Shoppable
 */

if ( ! function_exists( 'hello_shoppable_entry_header' ) ) :
	/**
	 * Prints HTML with meta information for the categories.
	 */
	function hello_shoppable_entry_header() {
		if ( 'post' === get_post_type() ) {
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( ' ' );
				if ( !is_single() && $categories_list ) {
					/* translators: 1: list of categories. */
					printf( '<span class="cat-links">' . '%1$s' . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}
		}
	}
endif;

if ( ! function_exists( 'hello_shoppable_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the tags and comments.
	 */
	function hello_shoppable_entry_footer() {

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date( 'M j, Y' ) ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date( 'M j, Y' ) )
		);
		$year = get_the_date( 'Y' );
		$month = get_the_date( 'm' );
		$link = ( is_single() ) ? get_month_link( $year, $month ) : get_permalink();

		$posted_on = '<a href="' . esc_url( $link ) . '" rel="bookmark">' . $time_string . '</a>';

		if ( !is_single() && get_theme_mod( 'enable_post_date', true ) ){
			echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
		if ( is_single() && get_theme_mod( 'enable_single_post_date', true ) ){
			echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		$byline = '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';

		if ( !is_single() && get_theme_mod( 'enable_post_author', true ) ){
			echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			if( !is_single() && get_theme_mod( 'enable_post_comment', true ) ){ 
				echo '<span class="comments-link">';
				comments_popup_link(
					sprintf(
						wp_kses(
							/* translators: %s: post title */
							__( 'Comment<span class="screen-reader-text"> on %s</span>', 'hello-shoppable' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					)
				);
				echo '</span>';
			}else if ( is_single() && get_theme_mod( 'enable_single_post_comment', true ) ){
				echo '<span class="comments-link">';
				comments_popup_link(
					sprintf(
						wp_kses(
							/* translators: %s: post title */
							__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'hello-shoppable' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					)
				);
				echo '</span>';
			}
		}

		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'hello-shoppable' ) );
			
			if( is_single() && $categories_list && get_theme_mod( 'enable_single_post_category', true ) ){
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . '%1$s' . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}
		
	}
endif;

if( !function_exists( 'hello_shoppable_single_post_tags' ) ){
	/**
	 * Prints HTML with meta information tags for single post.
	 */
	function hello_shoppable_single_post_tags(){
		if ( get_theme_mod( 'enable_single_post_tag_links', true ) ){
			if( get_the_tag_list() ){
				?>
				<div class="tag-links">
					<span class="screen-reader-text">
						<?php echo esc_html__( 'Tags', 'hello-shoppable' ); ?>
					</span>
					<?php echo get_the_tag_list( '', esc_html__( ', ', 'hello-shoppable' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</div>
				<?php
			}
		}
	}
}

if( !function_exists( 'hello_shoppable_get_day_link' ) ):
/**
* Returns the permalink of Post day
*
* @since Hello Shoppable 1.0.0
* @return url
*/
function hello_shoppable_get_day_link(){
	return get_day_link( get_the_time('Y'), get_the_time('m'), get_the_time('d') );
}
endif;

/**
 * Gets a nicely formatted string for the published date.
 *
 * @since Hello Shoppable 1.0.0
 * @return string
 */
if ( ! function_exists( 'hello_shoppable_time_link' ) ) :

function hello_shoppable_time_link() {

	$time_string = '<span class="entry-date published" datetime="%1$s">%2$s</span>';
	
	$time_string = sprintf( $time_string,
		get_the_date( DATE_W3C ),
		get_the_date()
	);
?>
	<span class="screen-reader-text"><?php echo esc_html__( 'Posted on', 'hello-shoppable' ); ?></span>
	<span class="posted-on">
		<a href="<?php echo esc_url( hello_shoppable_get_day_link() ); ?>" rel="bookmark">
			<?php echo wp_kses_post( $time_string ); ?>
		</a>
	</span>
	<?php		
}
endif;

if ( ! function_exists( 'hello_shoppable_edit_link' ) ) :

function hello_shoppable_edit_link( $echo = true ) {

	if( ! $echo ){
		ob_start();
	}

	edit_post_link(
		sprintf(
			/* translators: %s - Name of current post*/
			__( 'EDIT<span class="screen-reader-text"> "%s"</span>', 'hello-shoppable' ),
			get_the_title()
		),
		'<span class="edit-link">',
		'</span>'
	);

	if( ! $echo ){
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
}
endif;