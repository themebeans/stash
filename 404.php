<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package     Stash
 * @link        https://themebeans.com/themes/stash
 */

get_header(); ?>

<div id="primary" class="content-area">

	<main id="main" class="site-main" role="main">

		<section class="error-404 not-found">

			<header class="page-header">
				<?php stash_site_logo(); ?>
				<p><?php esc_html_e( 'Sorry, this page does not exist', 'stash' ); ?></p>
			</header>

			<div class="page-content">
				<?php
				printf(
					'<p><a href="%1$s">%2$s &rarr;</a></p>',
					esc_url( home_url( '/' ) ),
					esc_html__( 'Go back to the homepage', 'stash' )
				);
				?>
			</div>

		</section>

	</main>

</div>

<?php
get_footer();
