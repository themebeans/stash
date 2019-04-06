<?php
/**
 * Stash Customizer functionality
 *
 * @package     Stash
 * @link        https://themebeans.com/themes/stash
 */

/**
 * Customizer.
 *
 * @param WP_Customize_Manager $wp_customize the Customizer object.
 */
function stash_customize_register( $wp_customize ) {

	/**
	 * Add custom controls.
	 */
	require get_parent_theme_file_path( THEMEBEANS_CUSTOM_CONTROLS_DIR . '/class-themebeans-range-control.php' );

	/**
	 * Top-Level Customizer sections and panels.
	 */
	$wp_customize->add_panel(
		'stash_theme_options', array(
			'title'    => esc_html__( 'Theme Options', 'stash' ),
			'priority' => 30,
		)
	);

	/**
	 * Add the site logo max-width options to the Site Identity section.
	 */
	$wp_customize->add_setting(
		'custom_logo_max_width', array(
			'default'           => stash_defaults( 'custom_logo_max_width' ),
			'transport'         => 'postMessage',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		new ThemeBeans_Range_Control(
			$wp_customize, 'custom_logo_max_width', array(
				'default'     => stash_defaults( 'custom_logo_max_width' ),
				'type'        => 'themebeans-range',
				'label'       => esc_html__( 'Logo Max Width', 'stash' ),
				'description' => 'px',
				'section'     => 'title_tagline',
				'priority'    => 8,
				'input_attrs' => array(
					'min'  => 20,
					'max'  => 200,
					'step' => 2,
				),
			)
		)
	);

	$wp_customize->add_section(
		'stash_author', array(
			'title' => esc_html__( 'Profile', 'stash' ),
			'panel' => 'stash_theme_options',
		)
	);

	$wp_customize->add_setting(
		'user_biography', array(
			'default'           => stash_defaults( 'user_biography' ),
			'sanitize_callback' => 'stash_sanitize_html',
		)
	);

	$wp_customize->add_control(
		'user_biography', array(
			'type'    => 'textarea',
			'label'   => esc_html__( 'Biography', 'stash' ),
			'section' => 'stash_author',
		)
	);

	$wp_customize->add_setting(
		'user_url', array(
			'default'           => stash_defaults( 'user_url' ),
			'sanitize_callback' => 'esc_url_raw',
		)
	);

	$wp_customize->add_control(
		'user_url', array(
			'type'    => 'url',
			'label'   => esc_html__( 'External URL', 'stash' ),
			'section' => 'stash_author',
		)
	);

	$wp_customize->add_setting(
		'user_avatar', array(
			'default'           => stash_defaults( 'user_avatar' ),
			'sanitize_callback' => 'stash_sanitize_image',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize, 'user_avatar', array(
				'label'       => esc_html__( 'Avatar', 'stash' ),
				'description' => esc_html__( 'Upload your profile avatar to show in the biography section.', 'stash' ),
				'section'     => 'stash_author',
				'settings'    => 'user_avatar',
			)
		)
	);

	/**
	 * Add the general section.
	 */
	$wp_customize->add_section(
		'stash_general', array(
			'title' => esc_html__( 'Blog', 'stash' ),
			'panel' => 'stash_theme_options',
		)
	);

	// Add the fullwidth featured image setting and control.
	$wp_customize->add_setting(
		'header_search', array(
			'default'           => stash_defaults( 'header_search' ),
			'sanitize_callback' => 'stash_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'header_search', array(
			'type'        => 'checkbox',
			'label'       => esc_html__( 'Header Search', 'stash' ),
			'description' => esc_html__( 'Enable the search icon and drop-in search bar on all pages and posts.', 'stash' ),
			'section'     => 'stash_general',
		)
	);

	// If Gutenberg exist, use this control.
	if ( function_exists( 'register_block_type' ) ) {
		$wp_customize->add_setting(
			'featured_images', array(
				'default'           => true,
				'default'           => stash_defaults( 'featured_images' ),
				'sanitize_callback' => 'stash_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			'featured_images', array(
				'type'        => 'checkbox',
				'label'       => esc_html__( 'Single Featured Images', 'stash' ),
				'description' => esc_html__( 'Enable featured images to display on single views.', 'stash' ),
				'section'     => 'stash_general',
			)
		);

	}

	$wp_customize->add_setting(
		'fullwidth_featuredimg', array(
			'default'           => false,
			'default'           => stash_defaults( 'fullwidth_featuredimg' ),
			'sanitize_callback' => 'stash_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'fullwidth_featuredimg', array(
			'type'        => 'checkbox',
			'label'       => esc_html__( 'Fullwidth Featured Images', 'stash' ),
			'description' => esc_html__( 'Enable edge-to-edge featured images on single posts views.', 'stash' ),
			'section'     => 'stash_general',
		)
	);

	// If Gutenberg does not exist, use this control.
	if ( ! function_exists( 'register_block_type' ) ) {
		$wp_customize->add_setting(
			'one_img_gallery', array(
				'default'           => stash_defaults( 'one_img_gallery' ),
				'sanitize_callback' => 'stash_sanitize_checkbox',
			)
		);

		$wp_customize->add_control(
			'one_img_gallery', array(
				'type'        => 'checkbox',
				'label'       => esc_html__( 'Show all gallery images', 'stash' ),
				'description' => esc_html__( 'Show all images uploaded to a lightbox gallery, instead of just the first image.', 'stash' ),
				'section'     => 'stash_general',
			)
		);
	}

	$wp_customize->add_setting(
		'navigation', array(
			'default'           => stash_defaults( 'navigation' ),
			'sanitize_callback' => 'stash_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'navigation', array(
			'type'        => 'checkbox',
			'label'       => esc_html__( 'Post Navigation', 'stash' ),
			'description' => esc_html__( 'Enable post to post navigation to be displayed on single posts.', 'stash' ),
			'section'     => 'stash_general',
		)
	);

	$wp_customize->add_setting(
		'post_categories', array(
			'default'           => stash_defaults( 'post_categories' ),
			'sanitize_callback' => 'stash_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'post_categories', array(
			'type'        => 'checkbox',
			'label'       => esc_html__( 'Post Categories', 'stash' ),
			'description' => esc_html__( 'Enable post category meta beneath the single post in the entry footer.', 'stash' ),
			'section'     => 'stash_general',
		)
	);

	$wp_customize->add_setting(
		'post_tags', array(
			'default'           => stash_defaults( 'post_tags' ),
			'sanitize_callback' => 'stash_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'post_tags', array(
			'type'        => 'checkbox',
			'label'       => esc_html__( 'Post Tags', 'stash' ),
			'description' => esc_html__( 'Enable post tag meta beneath the single post in the entry footer.', 'stash' ),
			'section'     => 'stash_general',
		)
	);

	// Add the post likes setting and control.
	$wp_customize->add_setting(
		'post_likes', array(
			'default'           => stash_defaults( 'post_likes' ),
			'sanitize_callback' => 'stash_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'post_likes', array(
			'type'        => 'checkbox',
			'label'       => esc_html__( 'Post Likes', 'stash' ),
			'description' => esc_html__( 'Enable likes on posts, viewable on the single post entry footer.', 'stash' ),
			'section'     => 'stash_general',
		)
	);

	// Add the post comments setting and control.
	$wp_customize->add_setting(
		'post_comments', array(
			'default'           => stash_defaults( 'post_comments' ),
			'sanitize_callback' => 'stash_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'post_comments', array(
			'type'        => 'checkbox',
			'label'       => esc_html__( 'Post Comments', 'stash' ),
			'description' => esc_html__( 'Enable comments on posts. Comments are viewable from the comments icon trigger.', 'stash' ),
			'section'     => 'stash_general',
		)
	);

	// Add the post comments setting and control.
	$wp_customize->add_setting(
		'hidden_post_comments', array(
			'default'           => stash_defaults( 'hidden_post_comments' ),
			'sanitize_callback' => 'stash_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'hidden_post_comments', array(
			'type'        => 'checkbox',
			'label'       => esc_html__( 'Enable Hidden Comments', 'stash' ),
			'description' => esc_html__( 'Enable the show/hide comments functionality on posts.', 'stash' ),
			'section'     => 'stash_general',
		)
	);

	/**
	 * Add the footer section.
	 */
	$wp_customize->add_section(
		'stash_footer', array(
			'title' => esc_html__( 'Footer', 'stash' ),
			'panel' => 'stash_theme_options',
		)
	);

	// Add the footer text setting and control.
	$wp_customize->add_setting(
		'footer_text', array(
			'default'           => stash_defaults( 'footer_text' ),
			'sanitize_callback' => 'stash_sanitize_html',
		)
	);

	$wp_customize->add_control(
		'footer_text', array(
			'type'        => 'textarea',
			'label'       => esc_html__( 'Footer Text', 'stash' ),
			'description' => esc_html__( 'Enter custom text to be used in the footer section throughout the theme.', 'stash' ),
			'section'     => 'stash_footer',
		)
	);

	// Add the footer text setting and control.
	$wp_customize->add_setting(
		'form_action_url', array(
			'default'           => stash_defaults( 'form_action_url' ),
			'sanitize_callback' => 'esc_url_raw',
		)
	);

	$wp_customize->add_control(
		'form_action_url', array(
			'type'        => 'url',
			'label'       => esc_html__( 'Form Action URL', 'stash' ),
			'description' => esc_html__( 'Enter your form action URL.', 'stash' ),
			'section'     => 'stash_footer',
		)
	);

	// Add the form placeholder text setting and control.
	$wp_customize->add_setting(
		'form_placeholder_text', array(
			'default'           => stash_defaults( 'form_placeholder_text' ),
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		)
	);

	$wp_customize->add_control(
		'form_placeholder_text', array(
			'type'        => 'text',
			'label'       => esc_html__( 'Placeholder Text', 'stash' ),
			'description' => esc_html__( 'Customize the text within the email input.', 'stash' ),
			'section'     => 'stash_footer',
		)
	);

	// Add the form button text setting and control.
	$wp_customize->add_setting(
		'form_button_text', array(
			'default'           => stash_defaults( 'form_button_text' ),
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		)
	);

	$wp_customize->add_control(
		'form_button_text', array(
			'type'        => 'text',
			'label'       => esc_html__( 'Submit Button Text', 'stash' ),
			'description' => esc_html__( 'Customize the button text on the form.', 'stash' ),
			'section'     => 'stash_footer',
		)
	);

	// Add the form on/off setting and control.
	$wp_customize->add_setting(
		'form_display', array(
			'default'           => stash_defaults( 'form_display' ),
			'sanitize_callback' => 'stash_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'form_display', array(
			'type'    => 'checkbox',
			'label'   => esc_html__( 'Show signup form ', 'stash' ),
			'section' => 'stash_footer',
		)
	);

	// Add the header Twitter buttons setting and control.
	$wp_customize->add_setting(
		'footer_twitter_btn', array(
			'default'           => stash_defaults( 'footer_twitter_btn' ),
			'sanitize_callback' => 'stash_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'footer_twitter_btn', array(
			'type'    => 'checkbox',
			'label'   => esc_html__( 'Show Twitter button', 'stash' ),
			'section' => 'stash_footer',
		)
	);

	/**
	 * Add the Twitter section.
	 */
	$wp_customize->add_section(
		'stash_twitter', array(
			'title' => esc_html__( 'Twitter', 'stash' ),
			'panel' => 'stash_theme_options',
		)
	);

	$wp_customize->add_setting(
		'header_twitter_btns', array(
			'default'           => stash_defaults( 'header_twitter_btns' ),
			'sanitize_callback' => 'stash_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'header_twitter_btns', array(
			'type'    => 'checkbox',
			'label'   => esc_html__( 'Show Twitter buttons', 'stash' ),
			'section' => 'stash_twitter',
		)
	);

	$wp_customize->add_setting(
		'twitter_username', array(
			'default'           => stash_defaults( 'twitter_username' ),
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		)
	);

	$wp_customize->add_control(
		'twitter_username', array(
			'type'        => 'text',
			'label'       => esc_html__( 'Twitter Username', 'stash' ),
			'description' => esc_html__( 'Enter your Twitter username, which will be used throughout the theme. i.e. @richard_tabor', 'stash' ),
			'section'     => 'stash_twitter',
		)
	);

	$wp_customize->add_setting(
		'twitter_tweet_text', array(
			'default'           => stash_defaults( 'twitter_tweet_text' ),
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		)
	);

	$wp_customize->add_control(
		'twitter_tweet_text', array(
			'type'        => 'textarea',
			'label'       => esc_html__( 'Twitter Text', 'stash' ),
			'description' => esc_html__( 'Optional. Enter custom text to be used in lieu of the post title. Keep it short and simple.', 'stash' ),
			'section'     => 'stash_twitter',
		)
	);

	/**
	 * Add the Colors section.
	 */
	$wp_customize->add_setting(
		'theme_accent_color', array(
			'default'           => stash_defaults( 'theme_accent_color' ),
			'sanitize_callback' => 'sanitize_hex_color',
			'priority'          => 1,
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'theme_accent_color', array(
				'label'   => esc_html__( 'Accent Color', 'stash' ),
				'section' => 'colors',
			)
		)
	);

	/**
	 * Set transports for the Customizer.
	 */
	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	$wp_customize->get_setting( 'user_biography' )->transport = 'postMessage';
	$wp_customize->get_setting( 'user_url' )->transport       = 'postMessage';
	$wp_customize->get_setting( 'user_avatar' )->transport    = 'postMessage';

	$wp_customize->get_setting( 'header_twitter_btns' )->transport = 'postMessage';
	$wp_customize->get_setting( 'post_categories' )->transport     = 'postMessage';
	$wp_customize->get_setting( 'post_tags' )->transport           = 'postMessage';
	$wp_customize->get_setting( 'post_comments' )->transport       = 'postMessage';
	$wp_customize->get_setting( 'post_likes' )->transport          = 'postMessage';
	$wp_customize->get_setting( 'header_search' )->transport       = 'postMessage';

	$wp_customize->get_setting( 'footer_text' )->transport           = 'postMessage';
	$wp_customize->get_setting( 'form_display' )->transport          = 'postMessage';
	$wp_customize->get_setting( 'form_action_url' )->transport       = 'postMessage';
	$wp_customize->get_setting( 'form_placeholder_text' )->transport = 'postMessage';
	$wp_customize->get_setting( 'form_button_text' )->transport      = 'postMessage';
	$wp_customize->get_setting( 'footer_twitter_btn' )->transport    = 'postMessage';
}
add_action( 'customize_register', 'stash_customize_register', 11 );

/**
 * Writes the .avatar background image out to the 'head' element of the document
 * by reading the value from the theme mod value in the options table.
 */
function stash_customizer_avatar_css() {
?>
	<?php if ( is_customize_preview() ) : ?>
		<style type="text/css">
			<?php
			if ( 0 < count(
				strlen(
					(
					$user_avatar = get_theme_mod( 'user_avatar', stash_defaults( 'user_avatar' ) ) )
				)
			) ) {
			?>
				.author-avatar img {
					background-image: url( <?php echo esc_url( $user_avatar ); ?> );
				}
			<?php } ?>
		</style>
		<?php endif; ?>
<?php
}
add_action( 'wp_head', 'stash_customizer_avatar_css' );

/**
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 */
function stash_customize_preview_js() {
	wp_enqueue_script( 'stash-customize-preview', get_theme_file_uri() . '/assets/js/admin/customize-preview' . STASH_ASSET_SUFFIX . '.js', array( 'customize-preview' ), '@@pkg.version', true );
}
add_action( 'customize_preview_init', 'stash_customize_preview_js' );

/**
 * Load dynamic logic for the customizer controls area.
 */
function stash_customize_controls_js() {
	wp_enqueue_script( 'stash-customize-controls', get_theme_file_uri( '/assets/js/admin/customize-controls' . STASH_ASSET_SUFFIX . '.js' ), array( 'customize-controls' ), '@@pkg.version', true );
}
add_action( 'customize_controls_enqueue_scripts', 'stash_customize_controls_js' );
