/**
 * QBIQ Seasonal Promo slider.
 *
 * Initialises Slick (shipped with the Pegasus Carousel plugin) on the seasonal
 * promo slider rendered by the [seasonal_slider] shortcode. A fade hero-style
 * carousel: one promo at a time, auto-rotating.
 */
( function ( $ ) {
	'use strict';

	$( function () {
		var $slider = $( '.qbiq-seasonal-slider' );

		if ( ! $slider.length || typeof $.fn.slick !== 'function' ) {
			return;
		}

		$slider.each( function () {
			var $s = $( this );

			// A single slide doesn't need arrows/dots/autoplay.
			var single = $s.children( '.qb-seasonal-slide' ).length < 2;

			$s.slick( {
				dots:           ! single,
				arrows:         ! single,
				infinite:       ! single,
				autoplay:       ! single,
				autoplaySpeed:  6000,
				speed:          700,
				fade:           true,
				cssEase:        'ease',
				pauseOnHover:   true,
				slidesToShow:   1,
				slidesToScroll: 1,
				adaptiveHeight: false
			} );
		} );
	} );
} )( jQuery );
