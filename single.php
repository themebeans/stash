<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package     Stash
 * @link        https://themebeans.com/themes/stash
 */

get_header(); ?>

<div id="primary" class="content-area">

	<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) :

			the_post();

			// Include the single post content template.
			get_template_part( 'template-parts/content', 'single' );

			if ( ! is_singular( 'attachment' ) ) {
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
			}

		endwhile;
		?>

	</main>
</div>

<?php

stash_photoswipe();

get_footer(); ?>
