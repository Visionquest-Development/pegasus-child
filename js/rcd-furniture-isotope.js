/**
 * Furniture collection — Isotope filtering.
 *
 * Mirrors the cadence_group_theme portfolio approach: initialise Isotope on the
 * grid after images load, then let the filter buttons ( data-filter=".slug" )
 * drive iso.arrange(). Vanilla JS — no jQuery, Modernizr or classie needed.
 */
( function () {
	'use strict';

	var grid = document.querySelector( '.rcd-fur-grid' );
	if ( ! grid || typeof Isotope === 'undefined' ) {
		return;
	}

	var buttons = [].slice.call( document.querySelectorAll( '.rcd-fur-filters [data-filter]' ) );

	function start() {
		var iso = new Isotope( grid, {
			itemSelector: '.rcd-fur-item',
			percentPosition: true,
			transitionDuration: '0.5s',
			masonry: {
				columnWidth: '.rcd-fur-sizer'
			}
		} );

		grid.classList.add( 'is-loaded' );

		buttons.forEach( function ( button ) {
			button.addEventListener( 'click', function () {
				buttons.forEach( function ( other ) {
					other.classList.remove( 'rcd-fur-pill--active' );
				} );
				button.classList.add( 'rcd-fur-pill--active' );

				iso.arrange( {
					filter: button.getAttribute( 'data-filter' )
				} );
			} );
		} );

		// Re-layout once fonts/late images settle.
		window.addEventListener( 'load', function () {
			iso.layout();
		} );
	}

	if ( typeof imagesLoaded === 'function' ) {
		imagesLoaded( grid, start );
	} else {
		start();
	}
} )();
