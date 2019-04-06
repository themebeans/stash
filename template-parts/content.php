<?php
/**
 * The template part for displaying content
 *
 * @package     Stash
 * @link        https://themebeans.com/themes/stash
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php the_title( sprintf( '<h2 class="entry-title h3"><a href="%s" class="is-underlined-on-hover" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

	<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
		<span class="sticky-post"><?php esc_html_e( 'Featured', 'stash' ); ?></span>
	<?php endif; ?>

</article>
