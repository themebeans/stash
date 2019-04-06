/**
 * Theme javascript functions file.
 *
 */
( function( $ ) {
	"use strict";

		var
		body 	= $( 'body' ),
		b    	= $( '.site-header--right' ),
		c    	= $( '.twitter-btn-wrap' ),
		d    	= $( '.entry-content' ),
		r       = $( '#primary' ),
		e 	= body.find(d),
		f 	= r.find('.alignnone' ),
		g 	= $( '.post-thumbnail' ),
		h 	= $( '#header-search #search' ),
		q 	= e.find( 'blockquote' ),
		loaded 	= ( 'js--loaded' ),
		active 	= ( 'js--active' ),
		open 	= ( 'js--searchopen' ),
		opening = ( 'js--searchopening' ),
		hiding 	= ( 'js--searchhiding' ),
		dur  	= 500;

	/**
	 * Removes "no-js" and adds "js" classes to the body tag.
	 */
	(function(html){html.className = html.className.replace(/\bno-js\b/,'js');})(document.documentElement);

	/* Comments */
	function comments() {

		var
		commentsToggle  = $('#comments-toggle.is_not_hidden'),
		commentsDiv = $('#comments.is_hidden'),
	 	animationDur = 200;

		commentsToggle.on('click', function(e) {
			e.preventDefault();
			if( commentsToggle.hasClass(active) ) {
				commentsDiv.slideUp( animationDur , function() {
					commentsToggle.removeClass(active);
					commentsDiv.removeClass(active);
					commentsDiv.fadeOut(animationDur);
				});
			} else {
				commentsDiv.slideDown( animationDur , function() {
					commentsToggle.addClass(active);
					commentsDiv.addClass(active);
					commentsDiv.fadeIn(animationDur);
				});
			}
		});
	}

	/* Enable header searching */
	function headerSearch() {
		$( '#search-btn, #search-close' ).on("click", function(e) {
			e.preventDefault();
			if (body.hasClass(open)) {

				body.removeClass(open);
				body.addClass(hiding);
				setTimeout(function() {
					body.removeClass(hiding);
				}, dur);

			} else {

				body.addClass(opening);
				setTimeout(function() {
					body.addClass(open);
					body.removeClass(opening);
				}, dur);

				h.focus();
			}
		});
	}

	function headerSearchFocus() {
		h.keyup(function(){
			h.blur();
			h.focus();
		});

		h.change(function(){
			$( '#header-search' ).addClass(active);
			setTimeout(function() {
				$( '.header-search--enter' ).addClass(active);
			}, 1000);
		} );
	}

	/* Headroom.js */
	$( '#masthead' ).headroom({
		classes : {
			// when element is initialised
			initial : 'site-header--js',
			// when scrolling up
			pinned : 'site-header--pinned',
			// when scrolling down
			unpinned : 'site-header--unpinned',
			// when above offset
			top : 'site-header--top',
			// when below offset
			notTop : 'site-header--not-top'
		},
	} );

	/* Add loading class */
	setTimeout( function() {
		b.addClass( loaded ), c.addClass( loaded ), g.addClass( loaded )
	}, 300 );

	/* Document Ready */
	$( document ).ready( function() {

		headerSearch(),
		comments(),
		headerSearchFocus();

		/* Enable menu toggle for small screens */
		$( '.mobile-menu-toggle' ).on( 'click', function() {
			body.toggleClass( 'open-nav' );
		} );

		/* Comment form input placeholders */
		$( '#commentform textarea#comment' ).attr( 'placeholder', stash_localization.stash_comment );
		$( '#commentform input#author' ).attr( 'placeholder', stash_localization.stash_author );
		$( '#commentform input#email' ).attr( 'placeholder', stash_localization.stash_email );
		$( '#commentform input#url' ).attr( 'placeholder', stash_localization.stash_url );
	});

} )( jQuery );
