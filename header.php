<?php
/**
 * The header for our theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package     Stash
 * @link        https://themebeans.com/themes/stash
 */

$search_visibility  = ( false === get_theme_mod( 'header_search', stash_defaults( 'header_search' ) ) ) ? 'hidden' : null;
$twitter_visibility = ( false === get_theme_mod( 'header_twitter_btns', stash_defaults( 'header_twitter_btns' ) ) ) ? 'hidden' : null;

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	}
	?>
	<div id="page" class="site">

		<?php if ( ! is_404() ) : ?>

			<header id="masthead" class="site-header">

				<?php stash_site_logo(); ?>

				<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'stash' ); ?></a>

				<?php if ( has_nav_menu( 'primary' ) ) : ?>
					<nav id="site-navigation" class="main-navigation hide-on-mobile" role="navigation">
						<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
					</nav>
					<a id="nav-btn" class="mobile-menu-toggle" href="javascript:void(0);"><span><?php esc_html_e( 'Navigation', 'stash' ); ?></span></a>
				<?php
				endif;
				?>

				<?php
				if ( get_theme_mod( 'header_search', stash_defaults( 'header_search' ) ) || is_customize_preview() ) :
				?>
					<a id="search-btn" class="search-btn<?php echo esc_attr( $search_visibility ); ?>" href="javascript:void(0);">
						<?php echo wp_kses( stash_get_svg( array( 'icon' => 'search' ) ), stash_svg_allowed_html() ); ?>
					</a>
				<?php
				endif;

				if ( get_theme_mod( 'header_twitter_btns', stash_defaults( 'header_twitter_btns' ) ) || is_customize_preview() ) :
					?>
					<div class="site-header--right hide-on-mobile <?php echo esc_html( $twitter_visibility ); ?>">
						<?php stash_twitter_btn(); ?>
						<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
					</div>
				<?php endif; ?>

			</header>

			<?php if ( get_theme_mod( 'header_search', stash_defaults( 'header_search' ) ) || is_customize_preview() ) : ?>

				<form id="header-search" class="header-search" action="<?php echo esc_url( home_url( '/' ) ); ?>/" method="get" >
					<input type="text" name="s" id="search"/>
					<button id="header-search--submit" class="header-search--submit" type="submit" aria-label="Submit">
						<?php echo wp_kses( stash_get_svg( array( 'icon' => 'search' ) ), stash_svg_allowed_html() ); ?>
					</button>
					<span class="header-search--enter"><?php esc_html_e( 'Press Enter', 'stash' ); ?></span>
				</form>

			<?php endif; ?>

			<div id="content" class="site-content">

				<div id="search-close" class="search-close"></div>

		<?php
		endif;
