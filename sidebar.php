<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package     Stash
 * @link        https://themebeans.com/themes/stash
 */

if ( ! is_active_sidebar( 'sidebar-6' ) ) {
	return;
}

if ( is_home() ) {
	return;
}
?>

<aside id="secondary" class="widget-area content-wrap" role="complementary">

	<div class="widget-area__inner">

		<?php do_action( 'stash_before_footer_widgets' ); ?>

		<?php dynamic_sidebar( 'sidebar-6' ); ?>

		<?php do_action( 'stash_after_footer_widgets' ); ?>

	</div>
</aside>
