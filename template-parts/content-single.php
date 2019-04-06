<?php
/**
 * The template part for displaying single posts
 *
 * @package     Stash
 * @link        https://themebeans.com/themes/stash
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="post-wrapper">

		<?php if ( ! is_singular( 'attachment' ) ) : ?>

			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				<hr class="divider">
			</header>

		<?php endif; ?>

		<?php stash_post_thumbnail(); ?>

		<div class="entry-content--wrapper clearfix">

			<div class="entry-content">

				<?php the_content(); ?>

				<?php
				wp_link_pages(
					array(
						'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'stash' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
						'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'stash' ) . ' </span>%',
						'separator'   => '<span class="screen-reader-text">, </span>',
					)
				);
				?>
			</div>

			<?php if ( ! is_singular( 'attachment' ) && ! post_password_required() ) : ?>

				<footer class="entry-footer content-wrap">

					<div class="clearfix">

						<div class="entry-meta">
							<?php stash_entry_taxonomies(); ?>
						</div>

						<div class="entry-actions">

							<?php

							/*
	    					 	* Add the likes action, if selected in the Customizer.
	    					 	* The $likes_visibility class is used to show/hide the .post-likes div in the Customizer.
	    					 	*/
							$likes_visibility = ( false === get_theme_mod( 'post_likes', stash_defaults( 'post_likes' ) ) ) ? 'hidden' : '';

							if ( get_theme_mod( 'post_likes' ) || is_customize_preview() ) :
							?>

								<div class="post-likes <?php echo esc_html( $likes_visibility ); ?>">
									<a class="like" rel="<?php echo esc_attr( $post->ID ); ?>">
										<?php echo wp_kses( stash_get_svg( array( 'icon' => 'heart' ) ), stash_svg_allowed_html() ); ?>
										<span><?php echo esc_html( stash_likes_count( $post->ID ) ); ?></span>
									</a>
								</div>

							<?php
							endif;

							/*
		    					 * Add the comments action, if selected in the Customizer.
							 * The $comments_visibility class is used to show/hide the .post-comments div in the Customizer.
							 */
							$comments_visibility = ( false === get_theme_mod( 'post_comments', stash_defaults( 'post_comments' ) ) ) ? 'hidden' : '';

							/*
							 * Add the option to display the comments as a show/hide function or not.
							 */
							$hidden_post_comments = ( false === get_theme_mod( 'hidden_post_comments', stash_defaults( 'hidden_post_comments' ) ) ) ? '' : 'is_not_hidden';

							if ( get_theme_mod( 'post_comments' ) || is_customize_preview() ) :
							?>

								<div class="post-comments <?php echo esc_html( $comments_visibility ); ?>">
									<a id="comments-toggle" href="<?php esc_url( comments_link() ); ?>" class="<?php echo esc_html( $hidden_post_comments ); ?>">
										<?php echo wp_kses( stash_get_svg( array( 'icon' => 'comment' ) ), stash_svg_allowed_html() ); ?>
										<span><?php echo esc_html( get_comments_number() ); ?></span>
									</a>
								</div>

							<?php endif; ?>

						</div>

					</div>

					<?php
						edit_post_link(
							sprintf(
								/* translators: %s: Name of current post */
								__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'stash' ),
								get_the_title()
							),
							'<span class="edit-link">',
							'</span>'
						);
					?>

				</footer>

			<?php endif; ?>

		</div>

	</div>

	<?php
	// Sidebar widget area.
	if ( is_single() && ! is_front_page() && is_active_sidebar( 'sidebar-6' ) ) {
		?>

		<aside class="widget-area widget-area--sidebar">
			<?php dynamic_sidebar( 'sidebar-6' ); ?>
		</aside>

	<?php } ?>

</article>
