/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. This javascript will grab settings from customizer controls, and
 * then make any necessary changes to the page using jQuery.
 */

( function( $ ) {

	wp.customize( 'custom_logo_max_width', function( value ) {
		value.bind( function( to ) {
			$( 'body .custom-logo-link img.custom-logo' ).css( 'width', to );
		} );
	} );

	wp.customize( 'custom_logo', function( value ) {
		value.bind( function( to ) {

			if ( to ) {

				$( 'h1.site-title' ).css({
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute'
				});

			} else {

				// Give it a few ms to remove the image before we show the title back.
				setTimeout( function() {
					$( 'h1.site-title' ).css({
						clip: 'auto',
						position: 'relative'
					});

					$( 'h1.site-title' ).removeClass( 'hidden' );
				}, 900 );
			}
		} );
	} );

	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-logo-link a' ).text( to );
		} );
	} );

	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	wp.customize( 'footer_text', function( value ) {
		value.bind( function( to ) {
			$( '.site-footer .footer-text' ).html( to );
		} );
	} );

	wp.customize( 'form_action_url', function( value ) {
		value.bind( function( to ) {
			$('.site-footer form').attr('action', to );
			if ( '' === to ) {
				$( '.site-footer span.notice' ).removeClass( 'hidden' );
			} else {
				$( '.site-footer span.notice' ).addClass( 'hidden' );
			}
		} );
	} );

	wp.customize( 'form_placeholder_text', function( value ) {
		value.bind( function( to ) {
			$('.site-footer form input[type="email"]').attr('placeholder', to );
		} );
	} );

	wp.customize( 'form_button_text', function( value ) {
		value.bind( function( to ) {
			$( '.site-footer form button' ).text( to );
		} );
	} );

	wp.customize( 'form_display', function( value ) {
		value.bind( function( to ) {
			if ( true === to ) {
				$( '.site-footer form' ).removeClass( 'hidden' );
				$( '.site-footer .notice' ).removeClass( 'hidden' );
			} else {
				$( '.site-footer form' ).addClass( 'hidden' );
				$( '.site-footer .notice' ).addClass( 'hidden' );
			}
		} );
	} );

	wp.customize( 'footer_twitter_btn', function( value ) {
		value.bind( function( to ) {
			if ( true === to ) {
				$( '.site-footer .twitter-follow-button' ).removeClass( 'hidden' );
			} else {
				$( '.site-footer .twitter-follow-button' ).addClass( 'hidden' );
			}
		} );
	} );

	wp.customize( 'header_twitter_btns', function( value ) {
		value.bind( function( to ) {
			if ( true === to ) {
				$( '.site-header--right' ).removeClass( 'hidden' );
			} else {
				$( '.site-header--right' ).addClass( 'hidden' );
			}
		} );
	} );

	wp.customize( 'header_search', function( value ) {
		value.bind( function( to ) {
			if ( true === to ) {
				$( '#search-btn' ).removeClass( 'hidden' );
			} else {
				$( '#search-btn' ).addClass( 'hidden' );
			}
		} );
	} );

	wp.customize( 'post_categories', function( value ) {
		value.bind( function( to ) {
			if ( true === to ) {
				$( '.entry-meta .cat-links' ).removeClass( 'hidden' );
			} else {
				$( '.entry-meta .cat-links' ).addClass( 'hidden' );
			}
		} );
	} );

	wp.customize( 'post_tags', function( value ) {
		value.bind( function( to ) {
			if ( true === to ) {
				$( '.entry-meta .tags-links' ).removeClass( 'hidden' );
			} else {
				$( '.entry-meta .tags-links' ).addClass( 'hidden' );
			}
		} );
	} );

	wp.customize( 'post_comments', function( value ) {
		value.bind( function( to ) {
			if ( true === to ) {
				$( '.post-comments' ).removeClass( 'hidden' );
				$( '#comments' ).removeClass( 'hidden' );
			} else {
				$( '.post-comments' ).addClass( 'hidden' );
				$( '#comments' ).addClass( 'hidden' );
			}
		} );
	} );

	wp.customize( 'post_likes', function( value ) {
		value.bind( function( to ) {
			if ( true === to ) {
				$( '.post-likes' ).removeClass( 'hidden' );
			} else {
				$( '.post-likes' ).addClass( 'hidden' );
			}
		} );
	} );

	wp.customize( 'user_biography', function( value ) {
		value.bind( function( to ) {
			$( '.author-biography' ).html( to );
		} );
	} );

	wp.customize( 'user_url', function( value ) {
		value.bind( function( to ) {
			$( '.author-url' ).attr('href', to );

			//This part doesnt really work
			if ( '' === to ) {
				$( '.author-url' ).addClass( 'hidden' );
			} else {
				$( '.author-url' ).removeClass( 'hidden' );
			}
		} );
	} );

	wp.customize( 'user_avatar', function( value ) {
		value.bind( function( to ) {
			$( '.avatar' ).css( 'background-image', 'url( ' + to + ')' );
		} );
	});

} )( jQuery );