<?php
/**
 * The template for displaying Author biography
 *
 * @package     Stash
 * @link        https://themebeans.com/themes/stash
 */

?>
<section class="hero hero--profile content-wrap">

	<div class="hero-avatar-wrap">

		<?php
		// Assign variables from the Customizer, to be used below.
		$user_url       = get_theme_mod( 'user_url', stash_defaults( 'user_url' ) );
		$user_avatar    = get_theme_mod( 'user_avatar', stash_defaults( 'user_avatar' ) );
		$user_biography = get_theme_mod( 'user_biography', stash_defaults( 'user_biography' ) );

		// Retrieve the user avatar.
		if ( $user_avatar || is_customize_preview() ) {
			printf( '<div class="author-avatar">' );
				printf(
					'<div class="avatar" style="background-image: url(%1$s);" alt="%2$s"></div>',
					esc_url( $user_avatar ),
					esc_attr( get_bloginfo( 'name', 'display' ) )
				);
			printf( '</div><!-- .author-avatar -->' );
		}

		// Retrieve the user URL.
		if ( $user_url || is_customize_preview() ) {

			$user_url_visibility = ( '' !== $user_url ) ? 'hidden' : '';

			printf(
				'<a class="author-url" href="%s" class="%s">%s</i></a>',
				esc_url( $user_url ),
				esc_html( $user_url_visibility ),
				wp_kses( stash_get_svg( array( 'icon' => 'chain' ) ), stash_svg_allowed_html() )
			);
		}
		?>

	</div>

	<?php
	// Retrieve the user URL, if entered in the Customizer.
	if ( $user_biography || is_customize_preview() ) :
		printf( '<p class="author-biography">%s</p>', $user_biography );
	endif;
	?>

</section>
