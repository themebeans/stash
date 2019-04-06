var initPhotoSwipeFromDOM = function(gallerySelector) {

	// Parse slide data (url, title, size ...) from DOM elements
	var parseThumbnailElements = function(el) {

		var
		thumbElements = el.childNodes,
		numNodes = thumbElements.length,
		items = [],
		figureEl,
		linkEl,
		size,
		item;

		for(var i = 0; i < numNodes; i++) {

			// <figure> element
			figureEl = thumbElements[i];

			// Include only element nodes.
			if ( figureEl.nodeType !== 1 ) {
				continue;
			}

			// <figure> element
			linkEl = figureEl.children[0];

			// <img> element
			imageEl = linkEl.children[0];

			// <a> element
			aEl = imageEl.children[0];

			// If the <a> element exists.
			if ( aEl ) {
				var src = aEl.getAttribute('src');
			} else {
				var src = imageEl.getAttribute('src');
			}

			// Create slide object
			item = {
				src: src,
			};

			// <figcaption> element
			if ( linkEl.children.length > 1 ) {
				item.title = linkEl.children[1].innerHTML;
			}

			// If the <a> element exists.
			if ( aEl ) {

				// <img> thumbnail element
				if ( imageEl.children.length > 0 ) {
					item.msrc = aEl.getAttribute('src');
				}

			} else {

				// <img> thumbnail element
				if ( linkEl.children.length > 0 ) {
					item.msrc = imageEl.getAttribute('src');
				}

			}

			// Save link to element for getThumbBoundsFn
			item.el = figureEl;

			items.push( item );
		}

		return items;
	};

	// Find nearest parent element.
	var closest = function closest(el, fn) {
		return el && ( fn(el) ? el : closest(el.parentNode, fn) );
	};

	// Triggers when user clicks on thumbnail.
	var onThumbnailsClick = function(e) {
		e = e || window.event;
		e.preventDefault ? e.preventDefault() : e.returnValue = false;

		var eTarget = e.target || e.srcElement;

		// Find root element of slide.
		var clickedListItem = closest(eTarget, function(el) {
			return (el.tagName && el.tagName.toUpperCase() === 'LI');
		} );

		if ( ! clickedListItem ) {
			return;
		}

		// Find index of clicked item by looping through all child nodes.
		var
		clickedGallery = clickedListItem.parentNode,
		childNodes = clickedListItem.parentNode.childNodes,
		numChildNodes = childNodes.length,
		nodeIndex = 0,
		index;

		for ( var i = 0; i < numChildNodes; i++ ) {
			if ( childNodes[i].nodeType !== 1 ) {
				continue;
			}

			if ( childNodes[i] === clickedListItem ) {
				index = nodeIndex;
				break;
			}
			nodeIndex++;
		}

		if ( index >= 0 ) {

			var
			header = document.querySelector('.site-header');

			openPhotoSwipe( index, clickedGallery );

			header.classList.add( 'drop-in--unpinned' );
			header.classList.remove( 'drop-in--pinned' );
		}

		return false;
	};

	// Parse picture index and gallery index from URL (#&pid=1&gid=2)
	var photoswipeParseHash = function() {
		var
		hash = window.location.hash.substring(1),
		params = {};

		if(hash.length < 5) {
			return params;
		}

		var vars = hash.split('&');
		for (var i = 0; i < vars.length; i++) {
			if(!vars[i]) {
				continue;
			}
			var pair = vars[i].split('=');
			if(pair.length < 2) {
				continue;
			}
			params[pair[0]] = pair[1];
		}

		if ( params.gid ) {
			params.gid = parseInt( params.gid, 10 );
		}

		return params;
	};

	var openPhotoSwipe = function( index, galleryElement, disableAnimation, fromURL ) {
		var
		pswpElement = document.querySelectorAll('.pswp')[0],
		gallery,
		options,
		items;

		items = parseThumbnailElements( galleryElement );

		// Define options.
		options = {
			// define gallery index (for URL)
			closeOnScroll: true,
			galleryUID: galleryElement.getAttribute('data-pswp-uid'),
			getThumbBoundsFn: function(index) {
				var
				thumbnail   = items[index].el.getElementsByTagName('img')[0],
				pageYScroll = window.pageYOffset || document.documentElement.scrollTop,
				rect        = thumbnail.getBoundingClientRect();

				return { x:rect.left, y:rect.top + pageYScroll, w:rect.width };
			}

		};

		// PhotoSwipe opened from URL.
		if ( fromURL ) {
			if ( options.galleryPIDs ) {
				// Parse real index when custom PIDs are used - http://photoswipe.com/documentation/faq.html#custom-pid-in-url
				for( var j = 0; j < items.length; j++) {
					if(items[j].pid == index) {
						options.index = j;
						break;
					}
				}
			} else {
				// In URL indexes start from 1.
				options.index = parseInt(index, 10) - 1;
			}
		} else {
			options.index = parseInt(index, 10);
		}

		// Exit if index not found.
		if ( isNaN( options.index ) ) {
			return;
		}

		// Pass data to PhotoSwipe and initialize it.
		gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options );

		gallery.listen( 'gettingData', ( index, item ) => {

			if ( !item.w || !item.h ) {

				const innerImgEl = item.el.getElementsByTagName('img')[0]

				if ( innerImgEl ) {
					item.w = innerImgEl.width
					item.h = innerImgEl.height
				}

				const img = new Image()

				img.onload = function () {
					item.w = this.width;
					item.h = this.height;
					gallery.updateSize(true)
				}

				img.src = item.src;
			}
		} );

		gallery.init();
	};

	// Loop through all gallery elements and bind events.
	var galleryElements = document.querySelectorAll( gallerySelector );

	for( var i = 0, l = galleryElements.length; i < l; i++) {
		galleryElements[i].setAttribute('data-pswp-uid', i+1);
		galleryElements[i].onclick = onThumbnailsClick;
	}

	// Parse URL and open gallery if it contains #&pid=3&gid=1.
	var hashData = photoswipeParseHash();

	if ( hashData.pid && hashData.gid) {
		openPhotoSwipe( hashData.pid ,  galleryElements[ hashData.gid - 1 ], true, true );
	}
};

// Execute
initPhotoSwipeFromDOM( '.wp-block-gallery' );