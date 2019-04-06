<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #page div and all content after
 *
 * @package     Stash
 * @link        https://themebeans.com/themes/stash
 */

?>
</div><!-- .site-content -->

<?php
// Don't show the stash_footer_section on 404 and password protected pages.
if ( ! is_404() && ! post_password_required() ) :

	stash_footer_section();

	if ( is_singular( 'post' ) && get_theme_mod( 'navigation', stash_defaults( 'navigation' ) ) ) :
		/*
		 * The posts pagination outputs a set of page numbers with links to the previous and next pages of posts.
		 *
		 * @link https://codex.wordpress.org/Function_Reference/the_posts_pagination
		 */
		the_post_navigation(
			array(
				'next_text' => '<span class="meta-nav" aria-hidden="true"></span> ' .
					'<span class="screen-reader-text">' . esc_html__( 'Next post:', 'stash' ) . '</span> ' .
					'<span class="post-title">%title</span>' . wp_kses( stash_get_svg( array( 'icon' => 'right' ) ), stash_svg_allowed_html() ) . '</i>',
				'prev_text' => wp_kses( stash_get_svg( array( 'icon' => 'left' ) ), stash_svg_allowed_html() ) . '<span class="meta-nav" aria-hidden="true"></span> ' .
					'<span class="screen-reader-text">' . esc_html__( 'Previous post:', 'stash' ) . '</span> ' .
					'<span class="post-title">%title</span>',
			)
		);
	endif;

endif;

wp_footer();
?>
</body>
</html>
