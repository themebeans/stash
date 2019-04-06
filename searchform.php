<?php
/**
 * Display custom search form.
 *
 * @link https://developer.wordpress.org/reference/functions/get_search_form/#Examples
 *
 * @package     Stash
 * @link        https://themebeans.com/themes/stash
 */

$unique_id = esc_attr( uniqid( 'search-form-' ) );
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="<?php echo esc_attr( $unique_id ); ?>">
		<span class="screen-reader-text"><?php echo esc_html_x( 'Search for:', 'label', 'stash' ); ?></span>
	</label>
	<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder', 'stash' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr__( 'Search for:', 'stash' ); ?>" />
	<input type="submit" class="search-submit" value="<?php echo esc_html_x( 'Search', 'submit button', 'stash' ); ?>" />
</form>
