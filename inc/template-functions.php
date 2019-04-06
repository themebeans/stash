<?php
/**
 * Additional features to allow styling of the templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package     Stash
 * @link        https://themebeans.com/themes/stash
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function stash_body_classes( $classes ) {
	global $post;

	// Add a class if the sidebar is active.
	if ( ( is_singular( 'post' ) || is_page() ) && is_active_sidebar( 'sidebar-6' ) ) {
		$classes[] = 'has-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'stash_body_classes' );

/**
 * Adds a custom template for the block editor for the post type.
 */
function stash_add_template_to_posts() {

	if ( function_exists( 'register_block_type' ) && true === get_theme_mod( 'featured_images', stash_defaults( 'featured_images' ) ) ) {
		return;
	}

	$post_type_object = get_post_type_object( 'post' );

	$post_type_object->template = array(
		array(
			'core/image',
			array(
				'align'     => 'full',
				'className' => 'wp-block-image--stash-featured',
			),
		),
		array(
			'core/paragraph',
		),
	);
}
add_action( 'init', 'stash_add_template_to_posts' );

/**
 * Adds a custom template for the block editor for the page post type.
 */
function stash_add_template_to_pages() {

	if ( function_exists( 'register_block_type' ) && true === get_theme_mod( 'featured_images', stash_defaults( 'featured_images' ) ) ) {
		return;
	}

	$post_type_object = get_post_type_object( 'page' );

	$post_type_object->template = array(
		array(
			'core/image',
			array(
				'align'     => 'full',
				'className' => 'wp-block-image--stash-featured',
			),
		),
		array(
			'core/paragraph',
		),
	);
}
add_action( 'init', 'stash_add_template_to_pages' );
