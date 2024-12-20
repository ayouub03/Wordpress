<?php
	if ( post_password_required() ) {
		return;
	}
?>
<div id="comments" class="comments-area">
	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
			printf(
				_nx(
					'One thought on "%2$s"',
					'%1$s thoughts on "%2$s"',
					get_comments_number(),
					'comments title',
					'jewstore'
				),
				number_format_i18n( get_comments_number() ),
				'<span>' . esc_html(get_the_title()) . '</span>'
			);
			?>
		</h2>
		<ol class="comment-list">
			<?php
			wp_list_comments( array(
				'style'       => 'ol',
				'short_ping'  => true,
				'avatar_size' => 74,
			) );
			?>
		</ol>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav class="navigation comment-navigation" role="navigation">
				<h2 class="wpdevart-comment-navigation-title"><?php esc_html_e( 'Comment navigation', 'jewstore' ); ?></h2>
				<div class="wpdevart-comment-navigation-links">
					<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'jewstore' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'jewstore' ) ); ?></div>
				</div>
			</nav>
		<?php endif; ?>
		<?php if ( ! comments_open() && get_comments_number() ) : ?>
			<p class="no-comments"><?php echo esc_html_e( 'Comments are closed.', 'jewstore' ); ?></p>
		<?php endif; ?>
	<?php endif; ?>
	<?php comment_form(); ?>
</div>
