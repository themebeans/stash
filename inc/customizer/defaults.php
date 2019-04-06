<?php
/**
 * Customizer defaults
 *
 * @package     Stash
 * @link        https://themebeans.com/themes/stash
 */

/**
 * Get the default option for @@pkg.name's Customizer settings.
 *
 * @param  string|string $name Option key name to get.
 * @return mixin
 */
function stash_defaults( $name ) {
	static $defaults;

	if ( ! $defaults ) {
		$defaults = apply_filters(
			'stash_defaults', array(

				// Identity.
				'custom_logo_max_width' => 45,

				// Author.
				'user_biography'        => esc_html__( 'I am Stash, a quintessential WordPress theme for writers, bloggers, content marketers and those who crave a place to stash their articles. Built by Rich Tabor of ThemeBeans.' ),
				'user_url'              => 'https://richtabor.com',
				'user_avatar'           => get_theme_file_uri( '/inc/customizer/images/avatar.jpg' ),

				// Blog.
				'featured_images'       => false,
				'header_search'         => false,
				'fullwidth_featuredimg' => false,
				'one_img_gallery'       => false,
				'navgiation'            => false,
				'post_categories'       => false,
				'post_tags'             => false,
				'post_likes'            => true,
				'post_comments'         => true,
				'hidden_post_comments'  => true,

				// Footer.
				'footer_text'           => esc_html__( 'I am a laid-back WordPress theme. I was created by Rich Tabor of ThemeBeans, who works with WordPress themes for a living. Sign up below to receive updates, discounts and pre-release info on upcoming themes and plugins. It’s good stuff - I don’t spam.', 'stash' ),
				'form_action_url'       => '',
				'form_placeholder_text' => esc_html__( 'Enter your email address...', 'stash' ),
				'form_button_text'      => esc_html__( 'Sign me up!', 'stash' ),
				'form_display'          => true,
				'footer_twitter_btn'    => true,

				// Twitter.
				'header_twitter_btns'   => true,
				'twitter_username'      => '',
				'twitter_tweet_text'    => '',

				// Colors.
				'theme_accent_color'    => '#2DADB4',
			)
		);
	}

	return isset( $defaults[ $name ] ) ? $defaults[ $name ] : null;
}
