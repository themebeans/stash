<?php
/**
 * The template for displaying search results pages
 *
 * @package     Stash
 * @link        https://themebeans.com/themes/stash
 */

get_header(); ?>

<div id="primary" class="content-area">

	<main id="main" class="site-main hfeed" role="main">

	<?php if ( have_posts() ) : ?>

		<header class="page-header">
			<h1 class="page-title">
				<?php /* translators: search query */ ?>
				<?php printf( esc_html__( 'Search Results for: %s', 'stash' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?>
			</h1>
			<hr class="divider">
		</header>

		<?php
		// Start the Loop.
		while ( have_posts() ) :

			the_post();

			/*
			 * Include the Post-Format-specific template for the content.
			 * If you want to override this in a child theme, then include a file
			 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
			 */
			get_template_part( 'template-parts/content', get_post_format() );

		endwhile;

		if ( have_posts() ) :
			// Previous/next page navigation.
			the_posts_pagination(
				array(
					'prev_text'          => esc_html__( 'Previous', 'stash' ),
					'next_text'          => esc_html__( 'Next', 'stash' ),
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'stash' ) . ' </span>',
				)
			);
		endif;

	else :
		get_template_part( 'template-parts/content', 'none' );

	endif;
	?>

	</main>
</div>

<?php
get_footer();
