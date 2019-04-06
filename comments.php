<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package     Stash
 * @link        https://themebeans.com/themes/stash
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}

/*
 * Add the comments toggle, if selected in the Customizer.
 * The $comments_visibility class is used to show/hide the .comments-area div in the Customizer.
 */
$comments_visibility = ( false === get_theme_mod( 'post_comments', stash_defaults( 'post_comments' ) ) ) ? 'hidden' : '';

/*
 * Add the option to display the comments as a show/hide function or not.
 */
$hidden_post_comments = ( false === get_theme_mod( 'hidden_post_comments', stash_defaults( 'hidden_post_comments' ) ) ) ? '' : 'is_hidden';

if ( get_theme_mod( 'post_comments', stash_defaults( 'post_comments' ) ) || is_customize_preview() ) : ?>

<div class="entry-content--wrapper content-wrap clearfix">

	<div id="comments" class="comments-area <?php echo esc_html( $comments_visibility ); ?> <?php echo esc_html( $hidden_post_comments ); ?>">

		<?php if ( have_comments() ) : ?>

			<ol class="comment-list">
				<?php
					wp_list_comments(
						array(
							'style'       => 'ol',
							'short_ping'  => true,
							'avatar_size' => 42,
							'callback'    => 'stash_comments',
						)
					);
				?>
			</ol>

		<?php endif; ?>

		<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'stash' ); ?></p>
		<?php endif; ?>

		<?php
		comment_form(
			array(
				'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
				'title_reply_after'  => '</h2>',
			)
		);
		?>

	</div>

</div>

<?php
endif;
