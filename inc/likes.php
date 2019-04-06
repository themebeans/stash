<?php
/**
 * Likes support.
 *
 * @package     Stash
 * @link        https://themebeans.com/themes/stash
 */

/**
 * Check that ajax is working. Otherwise the like button won't work.
 * Create your own stash_likes_ajax_url() to override in a child theme.
 */
function stash_likes_ajax_url() {
	if ( is_singular( 'post' ) && get_theme_mod( 'post_likes', stash_defaults( 'post_likes' ) ) ) {
		echo '<script type="text/javascript">var ajaxurl = "' . esc_url( admin_url( 'admin-ajax.php' ) ) . '";</script>';
	}
}
add_action( 'wp_footer', 'stash_likes_ajax_url' );

/**
 * Get the current like count. This is used to show the amount of likes to the user.
 * Create your own stash_likes_count() to override in a child theme.
 *
 * @param integer $id ID of post.
 */
function stash_likes_count( $id ) {
	$likes = get_post_meta( $id, '_likers', true );
	if ( ! empty( $likes ) ) {
		return count( explode( ', ', $likes ) );
	} else {
		return '0';
	}
}

/**
 * Likes callback.
 * Create your own stash_likes_count() to override in a child theme.
 */
function stash_likes_callback() {

	$id       = json_decode( $_GET['data'] );
	$feedback = array( 'likes' => '' );

	// Get metabox values.
	$currentvalue = get_post_meta( $id, '_likers', true );
	$likes        = intval( get_post_meta( $id, '_likes_count', true ) );

	// Convert likers string to an array.
	$likesarray = explode( ', ', $currentvalue );

	// Check if the likers metabox already has a value to determine if the new entry has to be prefixed with a comma or not.
	if ( ! empty( $currentvalue ) ) {
		$newvalue = $currentvalue . ', ' . $_SERVER['REMOTE_ADDR'];
	} else {
		$newvalue = $_SERVER['REMOTE_ADDR'];
	}

	// Check if the IP address is already present, if not, add it.
	if ( strpos( $currentvalue, $_SERVER['REMOTE_ADDR'] ) === false ) {
		$nlikes = $likes + 1;
		if ( update_post_meta( $id, '_likers', $newvalue, $currentvalue ) && update_post_meta( $id, '_likes_count', $nlikes, $likes ) ) {
			$feedback = array(
				'likes'  => stash_likes_count( $id ),
				'status' => true,
			);
		}
	} else {
		$key = array_search( $_SERVER['REMOTE_ADDR'], $likesarray );
		unset( $likesarray[ $key ] );
		$nlikes = $likes - 1;

		if ( update_post_meta( $id, '_likers', implode( ', ', $likesarray ), $currentvalue ) && update_post_meta( $id, '_likes_count', $nlikes, $likes ) ) {
			$feedback = array(
				'likes'  => stash_likes_count( $id ),
				'status' => false,
			);
		}
	}

	echo wp_json_encode( $feedback );

	die();
}
add_action( 'wp_ajax_stash_likes_callback', 'stash_likes_callback' );
add_action( 'wp_ajax_nopriv_stash_likes_callback', 'stash_likes_callback' );
