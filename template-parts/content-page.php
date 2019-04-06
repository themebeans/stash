<?php
/**
 * The template part for displaying single pages.
 *
 * @package     Stash
 * @link        https://themebeans.com/themes/stash
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="post-wrapper">

		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			<hr class="divider">
		</header>

		<?php stash_post_thumbnail(); ?>

		<div class="entry-content">
			<?php
			the_content();

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

	</div>

	<?php
	// Sidebar widget area.
	if ( is_active_sidebar( 'sidebar-6' ) ) {
		?>
		<aside class="widget-area widget-area--sidebar">
			<?php dynamic_sidebar( 'sidebar-6' ); ?>
		</aside>
	<?php } ?>

</article>
