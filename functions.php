<?php
/**
 * Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package     Stash
 * @link        https://themebeans.com/themes/stash
 */

if ( ! defined( 'STASH_DEBUG' ) ) :
	/**
	 * Check to see if development mode is active.
	 * If set to false, the theme will load un-minified assets.
	 */
	define( 'STASH_DEBUG', true );
endif;

if ( ! defined( 'STASH_ASSET_SUFFIX' ) ) :
	/**
	 * If not set to true, let's serve minified .css and .js assets.
	 * Don't modify this, unless you know what you're doing!
	 */
	if ( ! defined( 'STASH_DEBUG' ) || true === STASH_DEBUG ) {
		define( 'STASH_ASSET_SUFFIX', null );
	} else {
		define( 'STASH_ASSET_SUFFIX', '.min' );
	}
endif;

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function stash_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Stash, use a find and replace
	 * to change 'stash' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'stash', get_theme_file_path( '/languages' ) );

	/*
         * Add default posts and comments RSS feed links to head.
         */
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/**
	 * Filter Stash's custom-background support argument.
	 *
	 * @param array $args {
	 *     An array of custom-background support arguments.
	 * }
	 */
	add_theme_support(
		'custom-background',
		apply_filters(
			'stash_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'stash-featured-image', 1300, 500, true );

	/*
     	 * This theme uses wp_nav_menu() in the following locations.
     	 */
	register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary Menu', 'stash' ),
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);

	/*
	 * Enable support for the WordPress default Theme Logo
	 * See: https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo', array(
			'flex-width' => true,
		)
	);

	/*
	 * Enable support for Customizer Selective Refresh.
	 * See: https://make.wordpress.org/core/2016/02/16/selective-refresh-in-the-customizer/
	 */
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * Enable support for responsive embedded content
	 * See: https://wordpress.org/gutenberg/handbook/extensibility/theme-support/#responsive-embedded-content
	 */
	add_theme_support( 'responsive-embeds' );

	/**
	 * Custom colors for use in the editor.
	 *
	 * @link https://wordpress.org/gutenberg/handbook/reference/theme-support/
	 */
	add_theme_support(
		'editor-color-palette', array(
			array(
				'name'  => esc_html__( 'Black', 'stash' ),
				'slug'  => 'black',
				'color' => '#2a2a2a',
			),
			array(
				'name'  => esc_html__( 'Gray', 'stash' ),
				'slug'  => 'gray',
				'color' => '#727477',
			),
			array(
				'name'  => esc_html__( 'Light Gray', 'stash' ),
				'slug'  => 'light-gray',
				'color' => '#f8f8f8',
			),
			array(
				'name'  => esc_html__( 'White', 'stash' ),
				'slug'  => 'white',
				'color' => '#ffffff',
			),
			array(
				'name'  => esc_html__( 'Titan White', 'stash' ),
				'slug'  => 'titan-white',
				'color' => '#E0D8E2',
			),
			array(
				'name'  => esc_html__( 'Tropical Blue', 'stash' ),
				'slug'  => 'tropical-blue',
				'color' => '#C5DCF3',
			),
			array(
				'name'  => esc_html__( 'Peppermint', 'stash' ),
				'slug'  => 'peppermint',
				'color' => '#d0eac4',
			),
			array(
				'name'  => esc_html__( 'Iceberg', 'stash' ),
				'slug'  => 'iceberg',
				'color' => '#D6EFEE',
			),
			array(
				'name'  => esc_html__( 'Bridesmaid', 'stash' ),
				'slug'  => 'bridesmaid',
				'color' => '#FBE7DD',
			),
			array(
				'name'  => esc_html__( 'Pipi', 'stash' ),
				'slug'  => 'pipi',
				'color' => '#fbf3d6',
			),
			array(
				'name'  => esc_html__( 'Accent', 'stash' ),
				'slug'  => 'accent',
				'color' => esc_html( get_theme_mod( 'theme_accent_color', stash_defaults( 'theme_accent_color' ) ) ),
			),
		)
	);

	/**
	 * Custom font sizes for use in the editor.
	 *
	 * @link https://wordpress.org/gutenberg/handbook/extensibility/theme-support/#block-font-sizes
	 */
	add_theme_support(
		'editor-font-sizes', array(
			array(
				'name'      => esc_html__( 'Small', 'stash' ),
				'shortName' => esc_html__( 'S', 'stash' ),
				'size'      => 16,
				'slug'      => 'small',
			),
			array(
				'name'      => esc_html__( 'Medium', 'stash' ),
				'shortName' => esc_html__( 'M', 'stash' ),
				'size'      => 22,
				'slug'      => 'medium',
			),
			array(
				'name'      => esc_html__( 'Large', 'stash' ),
				'shortName' => esc_html__( 'L', 'stash' ),
				'size'      => 26,
				'slug'      => 'large',
			),
			array(
				'name'      => esc_html__( 'Huge', 'stash' ),
				'shortName' => esc_html__( 'XL', 'stash' ),
				'size'      => 34,
				'slug'      => 'huge',
			),
		)
	);

	// Add support for block styles.
	add_theme_support( 'wp-block-styles' );

	// Add support for full and wide alignment, if the sidebar is not in use.
	if ( ! is_active_sidebar( 'sidebar-6' ) ) {
		add_theme_support( 'align-wide' );
	}

	// Add support for editor styles.
	add_theme_support( 'editor-styles' );

	// Enqueue editor styles.
	add_editor_style( 'assets/css/style-editor' . STASH_ASSET_SUFFIX . '.css' );

	// Enqueue fonts in the editor.
	add_editor_style( stash_fonts_url() );

	/*
	 * Define starter content for the theme.
	 * See: https://make.wordpress.org/core/2016/11/30/starter-content-for-themes-in-4-7/
	 */
	$starter_content = array(
		'options'     => array(
			'show_on_front' => 'page',
			'page_on_front' => '{{home}}',
		),

		'attachments' => array(
			'image-logo' => array(
				'post_title' => _x( 'Logo', 'Theme starter content', 'stash' ),
				'file'       => 'inc/customizer/images/logo.png',
			),
		),

		'theme_mods'  => array(
			'show_on_front'         => 'page',
			'page_for_posts'        => '{{blog}}',
			'custom_logo'           => '{{image-logo}}',
			'custom_logo_max_width' => '50',
		),

		'posts'       => array(
			'blog' => array(),
		),
	);

	/**
	 * Filters Stash array of starter content.
	 *
	 * @since Stash 1.0
	 *
	 * @param array $starter_content Array of starter content.
	 */
	$starter_content = apply_filters( 'stash_starter_content', $starter_content );

	add_theme_support( 'starter-content', $starter_content );
}
add_action( 'after_setup_theme', 'stash_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function stash_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'stash_content_width', 700 );
}
add_action( 'after_setup_theme', 'stash_content_width', 0 );

/**
 * Register widget areas.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function stash_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'stash' ),
			'id'            => 'sidebar-6',
			'description'   => esc_html__( 'Appears below the footer if there are widgets present.', 'stash' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
		)
	);
}
add_action( 'widgets_init', 'stash_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function stash_scripts() {

	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'stash-fonts', stash_fonts_url(), false, '@@pkg.version', 'all' );

	// Load theme styles.
	if ( is_child_theme() ) {
		wp_enqueue_style( 'stash-style', get_parent_theme_file_uri( '/style' . STASH_ASSET_SUFFIX . '.css' ), false, '@@pkg.version', 'all' );
		wp_enqueue_style( 'stash-child-style', get_theme_file_uri( '/style.css' ), false, '@@pkg.version', 'all' );
	} else {
		wp_enqueue_style( 'stash-style', get_theme_file_uri( '/style' . STASH_ASSET_SUFFIX . '.css' ), false, '@@pkg.version', 'all' );
	}

	// Load the standard WordPress comments reply javascript.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	/**
	 * Now let's check the same for the scripts.
	 */
	if ( SCRIPT_DEBUG || STASH_DEBUG ) {

		// Vendor scripts.
		wp_enqueue_script( 'likes', get_theme_file_uri( '/assets/js/vendors/likes.js' ), array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'headroom', get_theme_file_uri( '/assets/js/vendors/headroom.js' ), array( 'jquery' ), '@@pkg.version', true );

		// Check if Gutenberg is installed and load PhotoSwipe accordingly.
		if ( function_exists( 'register_block_type' ) ) {
			wp_enqueue_script( 'photoswipe', get_theme_file_uri( '/assets/js/photoswipe/photoswipe.js' ), array( 'jquery' ), '@@pkg.version', true );
			wp_enqueue_script( 'stash-photoswipe-init', get_theme_file_uri( '/assets/js/photoswipe/photoswipe-init.js' ), array( 'jquery' ), '@@pkg.version', true );
			wp_enqueue_script( 'stash-photoswipe-ui', get_theme_file_uri( '/assets/js/photoswipe/photoswipe-ui.js' ), array( 'jquery' ), '@@pkg.version', true );
		} else {
			wp_enqueue_script( 'stash-photoswipe-init', get_theme_file_uri( '/assets/js/photoswipe-classic/photoswipe-ui-default.js' ), array( 'jquery' ), '@@pkg.version', true );
			wp_enqueue_script( 'stash-photoswipe-ui', get_theme_file_uri( '/assets/js/photoswipe-classic/photoswipe.js' ), array( 'jquery' ), '@@pkg.version', true );
		}

		// Custom scripts.
		wp_enqueue_script( 'stash-global', get_theme_file_uri( '/assets/js/custom/global.js' ), array( 'jquery' ), '@@pkg.version', true );

		$translation_handle = 'stash-global';  // Variable for wp_localize_script.

	} else {
		wp_enqueue_script( 'stash-vendors-min', get_theme_file_uri( '/assets/js/vendors.min.js' ), array( 'jquery' ), '@@pkg.version', true );
		wp_enqueue_script( 'stash-custom-min', get_theme_file_uri( '/assets/js/custom.min.js' ), array( 'jquery' ), '@@pkg.version', true );

		// Check if Gutenberg is installed and load PhotoSwipe accordingly.
		if ( function_exists( 'register_block_type' ) ) {
			wp_enqueue_script( 'stash-photoswipe-min', get_theme_file_uri( '/assets/js/photoswipe.min.js' ), array( 'jquery' ), '@@pkg.version', true );
		} else {
			wp_enqueue_script( 'stash-photoswipe-min', get_theme_file_uri( '/assets/js/photoswipe-classic.min.js' ), array( 'jquery' ), '@@pkg.version', true );
		}

		$translation_handle = 'stash-custom-min';   // Variable for wp_localize_script.
	}

	$translation_array = array(
		'stash_comment' => esc_html__( 'Leave a Response', 'stash' ),
		'stash_author'  => esc_html__( 'Name', 'stash' ),
		'stash_email'   => esc_html__( 'Email', 'stash' ),
		'stash_url'     => esc_html__( 'Website', 'stash' ),
	);

	wp_localize_script( $translation_handle, 'stash_localization', $translation_array );
}
add_action( 'wp_enqueue_scripts', 'stash_scripts' );

/**
 * Enqueue Customizer settings into the block editor.
 */
function stash_editor_customizer_styles() {

	// Register Customizer styles within the editor to use for inline additions.
	wp_register_style( 'stash-editor-customizer-styles', false, '@@pkg.version', 'all' );

	// Enqueue the Customizer style.
	wp_enqueue_style( 'stash-editor-customizer-styles' );

	// Add custom colors to the editor.
	wp_add_inline_style( 'stash-editor-customizer-styles', stash_editor_customizer_colors() );
}
add_action( 'enqueue_block_editor_assets', 'stash_editor_customizer_styles' );

/**
 * Add customizer colors to the block editor.
 */
function stash_editor_customizer_colors() {

	// Retrieve colors from the Customizer.
	$background_color = get_theme_mod( 'background_color', '#ffffff' );
	$accent           = get_theme_mod( 'theme_accent_color', stash_defaults( 'theme_accent_color' ) );

	// Build styles.
	$css  = '';
	$css .= '.block-editor__container { background-color: #' . esc_attr( $background_color ) . '; }';

	return wp_strip_all_tags( apply_filters( 'stash_editor_customizer_colors', $css ) );
}

/**
 * Remove the duplicate stylesheet enqueue for older versions of the child theme.
 *
 * Since v1.5.0 Stash has a built-in auto-loader for loading the appropriate
 * parent theme stylesheet, without the need for a wp_enqueue_scripts function within
 * the child theme. This means that stylesheets will "just work" and there's less chance
 * that users will accidently disrupt stylesheet loading.
 */
function stash_remove_duplicate_child_parent_enqueue_scripts() {
	remove_action( 'wp_enqueue_scripts', 'stash_child_scripts', 10 );
}
add_action( 'init', 'stash_remove_duplicate_child_parent_enqueue_scripts' );

/**
 * Register custom fonts.
 * Based on Twenty Seventeen.
 */
function stash_fonts_url() {
	$fonts_url = '';

	/*
	 * Translators: If there are characters in your language that are not
	 * supported by Roboto, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$roboto = esc_html_x( 'on', 'Roboto font: on or off', 'stash' );

	if ( 'off' !== $roboto ) {
		$font_families = array();

		if ( 'off' !== $roboto ) {
			$font_families[] = 'Roboto:300,400';
		}

		$query_args = array(
			'family' => rawurlencode( implode( '|', $font_families ) ),
			'subset' => rawurlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Register and enqueue a custom stylesheet in the WordPress admin.
 */
function stash_enqueue_admin_style() {
	wp_enqueue_style( 'stash-admin', get_theme_file_uri( '/assets/css/style-admin.css' ), false, '1.0.0' );
}
add_action( 'admin_enqueue_scripts', 'stash_enqueue_admin_style' );

/**
 * Load required scripts for custom widgets.
 */
function stash_enqueue_admin_scripts() {
	global $pagenow, $wp_customize;

	if ( 'widgets.php' === $pagenow || isset( $wp_customize ) ) {
		wp_enqueue_media();
		wp_enqueue_script( 'widget-image-upload', get_theme_file_uri( '/assets/js/admin/admin.js' ), array( 'jquery' ), '@@pkg.version', true );
	}
}
add_action( 'admin_enqueue_scripts', 'stash_enqueue_admin_scripts' );

/**
 * Add preconnect for Google Fonts.
 *
 * @param  array|array   $urls           URLs to print for resource hints.
 * @param  string|string $relation_type  The relation type the URLs are printed.
 * @return array|array   $urls           URLs to print for resource hints.
 */
function stash_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'stash-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}

add_filter( 'wp_resource_hints', 'stash_resource_hints', 10, 2 );

/**
 * Filter the text prepended to the post title for protected posts.
 * Create your own stash_protected_title_format() to override in a child theme.
 *
 * @link https://developer.wordpress.org/reference/hooks/protected_title_format/
 * @param string $title Title for protected posts.
 */
function stash_protected_title_format( $title ) {
	return '%s';
}
add_filter( 'protected_title_format', 'stash_protected_title_format' );

if ( ! function_exists( 'stash_protected_form' ) ) :
	/**
	 * Filter the HTML output for the protected post password form.
	 * Create your own stash_protected_form() to override in a child theme.
	 *
	 * @link https://developer.wordpress.org/reference/hooks/the_password_form/
	 * @link https://codex.wordpress.org/Using_Password_Protection
	 */
	function stash_protected_form() {
		global $post;

		$label = 'pwbox-' . ( empty( $post->ID ) ? rand() : $post->ID );

		$o = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
		<label for="' . esc_attr( $label ) . '">' . esc_html__( 'Password:', 'stash' ) . ' </label><input name="post_password" placeholder="' . esc_attr__( 'Enter password here & press enter...', 'stash' ) . '" type="password" placeholder=""/><input type="submit" name="Submit" value="' . esc_attr__( 'Submit', 'stash' ) . '" />
		</form>';

		return $o;
	}
	add_filter( 'the_password_form', 'stash_protected_form' );
endif;

if ( ! function_exists( 'stash_comments' ) ) :
	/**
	 * Define custom callback function for comment output.
	 * Based strongly on the output from Twenty Sixteen.
	 *
	 * @link https://codex.wordpress.org/Function_Reference/wp_list_comments
	 * @link https://wordpress.org/themes/twentysixteen/
	 *
	 * @param string  $comment Comment to output.
	 * @param array   $args Arguments to pass through.
	 * @param integer $depth Amount of comments to go down by
	 *
	 * Create your own stash_comments() to override in a child theme.
	 */
	function stash_comments( $comment, $args, $depth ) {

		global $post;

		$GLOBALS['comment'] = $comment;

		extract( $args, EXTR_SKIP );

		if ( 'div' === $args['style'] ) {
			$tag       = 'div';
			$add_below = 'comment';
		} else {
			$tag       = 'li';
			$add_below = 'div-comment';
		}

		$allowed_html_array = array(
			'a'      => array(
				'href'  => array(),
				'title' => array(),
			),
			'br'     => array(),
			'cite'   => array(),
			'em'     => array(),
			'strong' => array(),
		);

		?>

		<<?php echo esc_attr( $tag ); ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID(); ?>">

		<?php if ( 'div' !== $args['style'] ) : ?>
			<article id="div-comment-<?php esc_attr( comment_ID() ); ?>" class="comment-body">
		<?php endif; ?>

			<footer class="comment-meta">

				<div class="comment-author vcard">
					<div class="avatar-wrapper">
						<?php
						if ( 0 !== $args['avatar_size'] ) {
							echo get_avatar( $comment, $args['avatar_size'] );
						}
						?>
					</div>

					<div class="comment-metadata">
						<?php printf( wp_kses( __( '<b class="fn">%s</b>', 'stash' ), $allowed_html_array ), get_comment_author_link() ); ?>

						<span class="comment-date">
							<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
							<?php
							/* translators: 1: date, 2: time */
								printf( esc_html__( '%1$s at %2$s', 'stash' ), get_comment_date(), get_comment_time() );
								?>
								</a>
								<?php
								edit_comment_link( __( 'Edit', 'stash' ), '', '' );
							?>
							<?php
							comment_reply_link(
								array_merge(
									$args, array(
										'add_below' => $add_below,
										'depth'     => $depth,
										'max_depth' => $args['max_depth'],
									)
								)
							);
?>

							<?php if ( '0' === $comment->comment_approved ) : ?>
								<span class="comment-awaiting-moderation"><?php esc_html_e( 'Awaiting moderation', 'stash' ); ?></span>
							<?php endif; ?>
						</span>
					</div>

				</div>

			</footer>

			<div class="comment-content">
				<?php comment_text(); ?>
			</div>

		<?php if ( 'div' !== $args['style'] ) : ?>
			</article>
		<?php
		endif;
	}
endif;

if ( ! function_exists( 'stash_comment_submit_button' ) ) :
	/**
	 * Filter the value of the comments submit button on single posts and pages.
	 * Create your own stash_comment_submit_button() to override in a child theme.
	 *
	 * @link https://developer.wordpress.org/reference/hooks/comment_form_submit_button/
	 *
	 * @param string $button Passes through comments submit button.
	 */
	function stash_comment_submit_button( $button ) {
		$button = '<input name="submit" type="submit" class="form-submit" value="' . esc_html__( 'Submit your Response', 'stash' ) . '" />';
		return $button;
	}
	add_filter( 'comment_form_submit_button', 'stash_comment_submit_button' );
endif;

/**
 * Convert HEX to RGB.
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 * HEX code, empty array otherwise.
 */
function stash_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) === 3 ) {
		$r = hexdec( substr( $color, 0, 1 ) . substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ) . substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ) . substr( $color, 2, 1 ) );
	} elseif ( strlen( $color ) === 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array(
		'red'   => $r,
		'green' => $g,
		'blue'  => $b,
	);
}

/**
 * Modifies tag cloud widget arguments to have all tags in the widget same font size.
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array A new modified arguments.
 */
function stash_widget_tag_cloud_args( $args ) {
	$args['largest']  = .8;
	$args['smallest'] = .8;
	$args['unit']     = 'em';
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'stash_widget_tag_cloud_args' );

/**
 * Make custom image sizes selectable from the WordPress admin.
 *
 * @param array $sizes Available sizes.
 * @see https://developer.wordpress.org/reference/functions/add_image_size/#for-media-library-images-admin
 */
function stash_add_editor_image_sizes( $sizes ) {
	return array_merge(
		$sizes, array(
			'stash-featured-image' => esc_html__( 'Featured Image' ),
		)
	);
}
add_filter( 'image_size_names_choose', 'stash_add_editor_image_sizes' );

if ( ! function_exists( 'stash_pingback_header' ) ) :
	/**
	 * Add a pingback url auto-discovery header for singularly identifiable articles.
	 */
	function stash_pingback_header() {
		if ( is_singular() && pings_open() ) {
			echo '<link rel="pingback" href="', bloginfo( 'pingback_url' ), '">';
		}
	}
	add_action( 'wp_head', 'stash_pingback_header' );
endif;

/**
 * Customizer additions.
 */
require get_theme_file_path( '/inc/customizer/defaults.php' );
require get_theme_file_path( '/inc/customizer/customizer.php' );
require get_theme_file_path( '/inc/customizer/customizer-css.php' );
require get_theme_file_path( '/inc/customizer/sanitization.php' );

/**
 * Custom template tags for this theme.
 */
require get_theme_file_path( '/inc/template-tags.php' );

/**
 * Additional features to allow styling of the templates.
 */
require get_theme_file_path( '/inc/template-functions.php' );

/**
 * SVG icons functions and filters.
 */
require get_theme_file_path( '/inc/icons.php' );

/**
 * Load Likes compatibility file.
 */
require get_theme_file_path( '/inc/likes.php' );

/**
 * Admin specific functions.
 */
require get_parent_theme_file_path( '/inc/admin/init.php' );

/**
 * Disable Dashboard Doc.
 */
function themebeans_guide() {}
