/* Insurance Guy Joe — small progressive enhancements (no render-blocking JS). */
jQuery( function ( $ ) {
	var reduce = window.matchMedia && window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;

	/* Testimonials carousel (pegasus-carousel / slick) when there are 2+ testimonials. */
	var $t = $( '.igj-testimonials--carousel' );
	if ( $t.length && $.fn.slick ) {
		$t.slick( { dots: true, arrows: false, adaptiveHeight: true, autoplay: ! reduce, autoplaySpeed: 7000 } );
	}

	/* Header shadow once the page scrolls. */
	var $h = $( '.igj-header' );
	$( window ).on( 'scroll', function () {
		$h.toggleClass( 'is-scrolled', window.scrollY > 8 );
	} );

	/* Open the FAQ answer targeted by the URL hash (e.g. /faq/#q-…). */
	if ( window.location.hash ) {
		var el = document.getElementById( window.location.hash.slice( 1 ) );
		if ( el && el.tagName === 'DETAILS' ) {
			el.open = true;
		}
	}

	/*
	 * Safety net for pegasus-wow: WOW.js hides .wow boxes until a scroll event,
	 * so content already in view (or in tools that never scroll) could stay hidden.
	 * Reveal any box as soon as it intersects the viewport.
	 */
	var boxes = document.querySelectorAll( '.wow' );
	var reveal = function ( box ) {
		box.style.visibility = 'visible';
		if ( reduce || box.style.animationName === 'none' ) {
			box.style.animationName = reduce ? 'none' : '';
		}
	};
	if ( 'IntersectionObserver' in window ) {
		var io = new IntersectionObserver( function ( entries ) {
			entries.forEach( function ( e ) {
				if ( e.isIntersecting ) {
					reveal( e.target );
					io.unobserve( e.target );
				}
			} );
		} );
		boxes.forEach( function ( b ) { io.observe( b ); } );
	} else {
		boxes.forEach( reveal );
	}
} );
