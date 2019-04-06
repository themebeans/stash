<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package     Stash
 * @link        https://themebeans.com/themes/stash
 */

if ( ! function_exists( 'stash_site_logo' ) ) :
	/**
	 * Output an <img> tag of the site logo.
	 */
	function stash_site_logo() {

		$visibility = ( has_custom_logo() ) ? ' hidden' : null;

		do_action( 'stash_before_site_logo' );

		the_custom_logo();

		if ( ! has_custom_logo() || is_customize_preview() ) {
			printf( '<h1 class="h3 site-title site-logo %1$s" itemscope itemtype="http://schema.org/Organization"><a href="%2$s" rel="home" itemprop="url" class="black">%3$s</a></h1>', esc_attr( $visibility ), esc_url( home_url( '/' ) ), esc_html( get_bloginfo( 'name' ) ) );

		}

		do_action( 'stash_after_site_logo' );
	}

endif;

if ( ! function_exists( 'stash_post_thumbnail' ) ) :
	/**
	 * Display an optional post thumbnail.
	 *
	 * Wraps the post thumbnail a div element when on single views.
	 * Create your own stash_post_thumbnail() to override in a child theme.
	 */
	function stash_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( function_exists( 'register_block_type' ) && false === get_theme_mod( 'featured_images', stash_defaults( 'featured_images' ) ) ) {
			return;
		}

		/**
		 * Add an option to turn off/on fullwidth images.
		 */
		$class = ( false === get_theme_mod( 'fullwidth_featuredimg', stash_defaults( 'fullwidth_featuredimg' ) ) ) ? '' : 'fullwidth'; ?>

		<div class="post-thumbnail clearfix">
			<?php the_post_thumbnail( 'stash-featured-image', array( 'class' => $class ) ); ?>
			<hr class="divider">
		</div><!-- .post-thumbnail -->

	<?php
	}
endif;


if ( ! function_exists( 'stash_photoswipe' ) ) :
	/**
	 * Adds the PhotoSwipe gallery.
	 *
	 * Create your own stash_photoswipe() to override in a child theme.
	 */
	function stash_photoswipe() {
		?>

		<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

			<div class="pswp__bg"></div>

			<div class="pswp__scroll-wrap">

				<div class="pswp__container">
					<div class="pswp__item"></div>
					<div class="pswp__item"></div>
					<div class="pswp__item"></div>
				</div>

				<div class="pswp__ui pswp__ui--hidden">

					<div class="pswp__top-bar">

						<div class="pswp__counter"></div>

						<button class="pswp__button pswp__button--close" title="<?php esc_html_e( 'Close (esc)', 'stash' ); ?>"></button>

						<div class="pswp__preloader">
							<div class="pswp__preloader__icn">
								<div class="pswp__preloader__cut">
									<div class="pswp__preloader__donut"></div>
								</div>
							</div>
						</div>
					</div>

					<div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
						<div class="pswp__share-tooltip"></div>
					</div>

					<button class="pswp__button pswp__button--arrow--right" title="<?php esc_html_e( 'Next (arrow right)', 'stash' ); ?>"></button>
					<button class="pswp__button pswp__button--arrow--left" title="<?php esc_html_e( 'Previous (arrow left)', 'stash' ); ?>"></button>

					<div class="pswp__caption">
						<div class="pswp__caption__center"></div>
					</div>

				</div>

			</div>

		</div>
	<?php
	}
endif;

if ( ! function_exists( 'stash_post_gallery' ) ) :
	/**
	 * Change the WordPress default gallery output.
	 *
	 * Integrates PhotoSwipe support into the standard WordPress gallery.
	 * Create your own stash_post_gallery() to override in a child theme.
	 */
	function stash_post_gallery( $output, $attr ) {

		// If Gutenberg is installed, return.
		if ( function_exists( 'register_block_type' ) ) {
			return;
		}

		if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'tiled-gallery' ) ) {
			return;
		}

		global $post;

		if ( isset( $attr['orderby'] ) ) {
			$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
			if ( ! $attr['orderby'] ) {
				unset( $attr['orderby'] );
			}
		}

		extract(
			shortcode_atts(
				array(
					'order'      => 'ASC',
					'orderby'    => 'menu_order ID',
					'id'         => $post->ID,
					'itemtag'    => 'dl',
					'icontag'    => 'dt',
					'captiontag' => 'dd',
					'columns'    => 1,
					'size'       => 'thumbnail',
					'include'    => '',
					'exclude'    => '',
				), $attr
			)
		);

		$id = intval( $id );

		if ( 'RAND' === $order ) {
			$orderby = 'none';
		}

		if ( ! empty( $include ) ) {
			$include      = preg_replace( '/[^0-9,]+/', '', $include );
			$_attachments = get_posts(
				array(
					'include'        => $include,
					'post_status'    => 'inherit',
					'post_type'      => 'attachment',
					'post_mime_type' => 'image',
					'order'          => $order,
					'orderby'        => $orderby,
				)
			);

			$attachments = array();
			foreach ( $_attachments as $key => $val ) {
				$attachments[ $val->ID ] = $_attachments[ $key ];
			}
		}

		if ( empty( $attachments ) ) {
			return '';
		}

		$i = 1;

		$class = ( false === get_theme_mod( 'one_img_gallery', stash_defaults( 'one_img_gallery' ) ) ) ? 'one-img' : '';

		// Here's your actual output, you may customize it to your need.
		$output = "<div id=\"photoswipe-gallery\" class=\"photoswipe-gallery {$class}\" itemscope itemtype=\"http://schema.org/ImageGallery\">\n";

		// Now you loop through each attachment.
		foreach ( $attachments as $id => $attachment ) {

			$img = wp_get_attachment_image_src( $id, 'full' );

			$output .= "<figure class=\"gallery-img--{$i}\" itemprop=\"associatedMedia\" itemscope itemtype=\"http://schema.org/ImageObject\">\n";
			$output .= "<a href=\"{$img[0]}\" class=\"photoswipe-link\" itemprop=\"contentUrl\" data-size=\"{$img[1]}x{$img[2]}\"   width=\"{$img[1]}\" height=\"{$img[2]}\" alt=\"\" />\n";
			$output .= "<img src=\"{$img[0]}\" width=\"{$img[1]}\" height=\"{$img[2]}\" alt=\"\" />\n";
			$output .= "</a>\n";
			$output .= "</figure>\n";

			$i++;
		}

		$output .= "</div>\n";

		return $output;
	}
endif;
add_filter( 'post_gallery', 'stash_post_gallery', 10, 2 );

if ( ! function_exists( 'stash_twitter_btn' ) ) :
	/**
	 * Return the Twitter share and follow buttons.
	 *
	 * Checks if a Twitter username is entered in the Customizer, then outputs.
	 * Create your own stash_twitter_btn() to override in a child theme.
	 */
	function stash_twitter_btn() {

		if ( get_theme_mod( 'header_twitter_btns', stash_defaults( 'header_twitter_btns' ) ) || is_customize_preview() ) :
			/*
			 * Grab the Twitter username via the Customizer and strip out the "@".
			 */
			$twitter_username = str_replace( '@', '', get_theme_mod( 'twitter_username', stash_defaults( 'twitter_username' ) ) );

			/*
			 * Custom Tweet text variable, if it's entered in the Customizer.
			 * We will add that to the singluar post Tweet button, instead of the page title, if so.
			 */
			$data_text         = get_theme_mod( 'twitter_tweet_text', stash_defaults( 'twitter_tweet_text' ) );
			$twitter_data_text = ( $data_text ) ? $data_text : '';

			if ( is_singular( 'post' ) || ! $twitter_username ) :
				printf(
					'<a href="https://twitter.com/share" class="twitter-share-button"{count} data-text="%1$s" data-via="%2$s" data-related="%2$s">%3$s</a>',
					esc_html( $twitter_data_text ),
					esc_html( $twitter_username ),
					esc_html( 'Tweet', 'stash' )
				);
			else :
				// Only output the Twitter follow button if there is a username entered in the Customizer.
				printf(
					'<a href="https://twitter.com/%1$s" class="twitter-follow-button" data-show-count="false" data-show-screen-name="false">%2$s @%1$s</a>',
					esc_html( $twitter_username ),
					esc_html( 'Follow', 'stash' )
				);
			endif;
		endif;

	}
endif;

if ( ! function_exists( 'stash_footer_section' ) ) :
	/**
	 * Return the Twitter share and follow buttons.
	 *
	 * Checks if a Twitter username is entered in the Customizer, then outputs.
	 * Create your own stash_footer_section() to override in a child theme.
	 */
	function stash_footer_section() {

		$footer_text                = get_theme_mod( 'footer_text', stash_defaults( 'footer_text' ) );
		$form_display               = get_theme_mod( 'form_display', stash_defaults( 'form_display' ) );
		$form_action_url            = get_theme_mod( 'form_action_url', stash_defaults( 'form_action_url' ) );
		$form_placeholder_text      = get_theme_mod( 'form_placeholder_text', stash_defaults( 'form_placeholder_text' ) );
		$form_button_text           = get_theme_mod( 'form_button_text', stash_defaults( 'form_button_text' ) );
		$form_visibility            = ( false === $form_display ) ? 'hidden' : '';
		$form_action_url_visibility = ( '' !== $form_action_url ) ? 'hidden' : '';

		$twitter_username              = str_replace( '@', '', get_theme_mod( 'twitter_username', stash_defaults( 'twitter_username' ) ) );
		$footer_twitter_btn            = get_theme_mod( 'footer_twitter_btn', stash_defaults( 'footer_twitter_btn' ) );
		$footer_twitter_btn_visibility = ( false === $footer_twitter_btn ) ? 'hidden' : '';

		/*
		 * If both the footer text and form action URL are not entered in the Customizer,
		 * we will return early without loading the footer section.
		 */
		if ( ! $footer_text && ! $form_action_url ) {
			return;
		}

		echo '<footer class="site-footer content-wrap" role="contentinfo">';

		echo '<div class="site-footer--inner"><hr class="divider">';

		if ( $footer_text ) {
			printf( '<p class="footer-text">%1$s</p>', esc_html( $footer_text ) );
		}

		if ( $form_display || is_customize_preview() ) :

			printf( '<form action="%s" method="post" class="%s">', esc_url( $form_action_url ), esc_html( $form_visibility ) );
				printf( '<input type="email" placeholder="%s" name="EMAIL">', esc_html( $form_placeholder_text ) );
				printf( '<input type="hidden" name="LOCATION" value="%s">', esc_html( get_bloginfo( 'name', 'display' ) ) );
				printf( '<button type="submit" class="button">%s</button>', esc_html( $form_button_text ) );
			printf( '</form>' );

			if ( ! $form_action_url && is_user_logged_in() ) {
				printf(
					'<span class="notice %s">%s</span>',
					esc_html( $form_action_url_visibility ),
					esc_html( 'Please enter your form action URL', 'stash' )
				);
			}

			endif;

		if ( $footer_twitter_btn && $twitter_username ) :
			// Only output the Twitter follow button if there is a username entered in the Customizer.
			printf(
				'<div class="twitter-btn-wrap"><a href="https://twitter.com/%1$s" class="twitter-follow-button %3$s" data-show-count="true" data-size="large" data-show-screen-name="true">%2$s @%1$s</a></div>',
				esc_html( $twitter_username ),
				esc_html( 'Follow', 'stash' ),
				esc_html( $footer_twitter_btn_visibility )
			);

			endif;

		echo '</div><!-- .site-footer--inner -->';
		echo '</footer><!-- .site-footer -->';

	}
endif;

if ( ! function_exists( 'stash_entry_taxonomies' ) ) :
	/**
	 * Print HTML with category and tags for current post.
	 * Create your own stash_entry_taxonomies() to override in a child theme.
	 */
	function stash_entry_taxonomies() {

		if ( get_theme_mod( 'post_categories', stash_defaults( 'post_categories' ) ) === true || is_customize_preview() ) :

			$categories_list       = get_the_category_list( esc_html( ' ', 'Used between list items, there is a space after the comma.', 'stash' ) );
			$categories_visibility = ( false === get_theme_mod( 'post_categories' ) ) ? 'hidden' : '';

			if ( $categories_list && stash_categorized_blog() ) {
				printf(
					'<div class="cat-links %1$s"><span class="screen-reader-text">%2$s </span>%3$s</div>',
					esc_html( $categories_visibility ),
					esc_html_x( 'Categories', 'Used before category names.', 'stash' ),
					$categories_list
				);
			}
		endif;

		if ( get_theme_mod( 'post_tags', stash_defaults( 'post_tags' ) ) === true || is_customize_preview() ) :

			$tags_list       = get_the_tag_list( '', esc_html( ' ', 'Used between list items, there is a space after the comma.', 'stash' ) );
			$tags_visibility = ( false === get_theme_mod( 'post_tags', stash_defaults( 'post_tags' ) ) ) ? 'hidden' : '';

			if ( $tags_list ) {
				printf(
					'<div class="tags-links %1$s"><span class="screen-reader-text">%2$s </span>%3$s</div>',
					esc_html( $tags_visibility ),
					esc_html_x( 'Tags', 'Used before tag names.', 'stash' ),
					$tags_list
				);
			}
		endif;
	}
endif;

/**
 * Determine whether blog/site has more than one category.
 *
 * @return bool True of there is more than one category, false otherwise.
 */
function stash_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'stash_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories(
			array(
				'fields'     => 'ids',
				'hide_empty' => 1,

				// We only need to know if there is more than one category.
				'number'     => 2,
			)
		);

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'stash_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so stash_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so stash_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in { @see stash_categorized_blog() }.
 */
function stash_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'stash_categories' );
}
add_action( 'edit_category', 'stash_category_transient_flusher' );
add_action( 'save_post', 'stash_category_transient_flusher' );
