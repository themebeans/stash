<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package     Stash
 * @link        https://themebeans.com/themes/stash
 */

?>
<section class="no-results not-found content-wrap">

	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'stash' ); ?></h1>
	</header>

	<div class="page-content">
		<?php get_search_form(); ?>
	</div>

</section>
