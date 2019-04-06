<?php
/**
 * Enqueues front-end CSS for Customizer options.
 *
 * @package     Stash
 * @link        https://themebeans.com/themes/stash
 */

/**
 * Set the Custom CSS via Customizer options.
 */
function stash_customizer_css() {

	$theme_accent_color = get_theme_mod( 'theme_accent_color', stash_defaults( 'theme_accent_color' ) );
	$site_logo_width    = get_theme_mod( 'custom_logo_max_width', stash_defaults( 'custom_logo_max_width' ) );

	$theme_accent_color_rgb = stash_hex2rgb( $theme_accent_color );

	if ( empty( $theme_accent_color_rgb ) ) {
		return;
	}

	$rgb_50_opacity  = vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.5)', $theme_accent_color_rgb );
	$rgb_10_opacity  = vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.075)', $theme_accent_color_rgb );
	$rgb_100_opacity = vsprintf( 'rgba( %1$s, %2$s, %3$s, 1)', $theme_accent_color_rgb );

	$css =
	'
	body .custom-logo-link img.custom-logo {
		width: ' . esc_attr( $site_logo_width ) . 'px;
	}

	.has-accent-color { color: ' . esc_attr( $theme_accent_color ) . '; }

	.has-accent-background-color { background-color: ' . esc_attr( $theme_accent_color ) . '; }

	.entry-content .wp-block-button:not(.is-style-outline) .wp-block-button__link:not(.has-background):hover { background-color: ' . esc_attr( $theme_accent_color ) . '; }

	a:hover,
	a:focus,
	a:active,
	.widget-title,
	.logo_text:hover,
	.current-menu-item a,
	.footer-text a:hover,
	.site-header a:hover,
	.entry-actions .js--active .icon { color:' . esc_attr( $theme_accent_color ) . '; }

	p a:hover,
	article ul li a:hover,
	article ol li a:hover,
	.footer-text a:hover,
	body .the-list-item-link .the-list-item-title:hover,
	p a:focus,
	article ul li a:focus,
	article ol li a:focus,
	.footer-text a:focus,
	body .the-list-item-link:focus .the-list-item-title {
		color: ' . esc_attr( $theme_accent_color ) . '!important;
	}

	.cats,
	h1 a:hover,
	.logo a h1:hover,
	nav ul li a:hover,
	.error404 .page-content a,
	nav ul li.current-menu-item a, {
		color: ' . esc_attr( $theme_accent_color ) . '!important;
	}

	button:hover,
	button:focus,
	input[type="button"]:hover,
	input[type="button"]:focus,
	input[type="reset"]:hover,
	input[type="reset"]:focus,
	input[type="submit"]:hover,
	input[type="submit"]:focus,
	form button:hover,
	form button:focus,
	article .button a:hover,
	article .button a:hover,
	article .button a:focus,
	article input[type="button"]:hover,
	article input[type="button"]:focus,
	article input[type="reset"]:hover,
	article input[type="reset"]:focus,
	article input[type="submit"]:hover,
	article input[type="submit"]:focus,
	.author-url {
		background-color: ' . esc_attr( $theme_accent_color ) . ';
	}
	';

	// Minify.
	if ( function_exists( 'themebeans_minify_css' ) ) {
		$css = themebeans_minify_css( $css );
	}

	return wp_strip_all_tags( $css );
}

/**
 * Enqueue the Customizer styles on the front-end.
 */
function stash_customizer_styles() {
	wp_add_inline_style( 'stash-style', stash_customizer_css() );
}
add_action( 'wp_enqueue_scripts', 'stash_customizer_styles' );
