/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~PEGASUS CUSTOM JS — RU SAN'S ~~~~~~~~~~~~~~~~~~~~~~~
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/

jQuery( function ( $ ) {
	'use strict';

	var reduceMotion = window.matchMedia && window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;

	/* ---------- Hero slider ----------
	 * Uses slippry (registered by the pegasus-slider plugin) when it's loaded,
	 * otherwise a tiny cross-fade so the hero still works without the plugin. */
	var $hero = $( '[data-rusans-hero]' );
	if ( $hero.length ) {
		if ( $.fn.slippry && ! reduceMotion ) {
			$hero.addClass( 'is-slippry' ).slippry( {
				elements: 'li',
				transition: 'fade',
				speed: 1200,
				pause: 5500,
				captions: false,
				pager: true,
				controls: false,
				adaptiveHeight: false,
				useCSS: true
			} );
		} else if ( ! reduceMotion ) {
			var $slides = $hero.children( 'li' ), idx = 0;
			if ( $slides.length > 1 ) {
				setInterval( function () {
					$slides.eq( idx ).removeClass( 'is-active' );
					idx = ( idx + 1 ) % $slides.length;
					$slides.eq( idx ).addClass( 'is-active' );
				}, 5500 );
			}
		}
	}

	/* ---------- Gallery strip carousel (slick from pegasus-carousel, optional) ---------- */
	var $car = $( '[data-rusans-carousel]' );
	if ( $car.length && $.fn.slick ) {
		$car.addClass( 'is-slick' ).slick( {
			slidesToShow: 4,
			slidesToScroll: 1,
			autoplay: ! reduceMotion,
			autoplaySpeed: 3500,
			arrows: true,
			dots: false,
			responsive: [
				{ breakpoint: 992, settings: { slidesToShow: 3 } },
				{ breakpoint: 768, settings: { slidesToShow: 2 } },
				{ breakpoint: 480, settings: { slidesToShow: 1, centerMode: true, centerPadding: '40px' } }
			]
		} );
	}

	/* ---------- Gallery lightbox (native <dialog>, no library) ---------- */
	var dialog = document.querySelector( '[data-rusans-lightbox-dialog]' );
	if ( dialog && typeof dialog.showModal === 'function' ) {
		var img = dialog.querySelector( 'img' ), cap = dialog.querySelector( '.rusans-lightbox__caption' );
		$( document ).on( 'click', '[data-rusans-lightbox]', function ( e ) {
			e.preventDefault();
			img.src = this.getAttribute( 'href' );
			img.alt = this.getAttribute( 'data-caption' ) || '';
			cap.textContent = img.alt;
			dialog.showModal();
		} );
		$( dialog ).on( 'click', function ( e ) {
			if ( e.target === dialog || $( e.target ).hasClass( 'rusans-lightbox__close' ) ) {
				dialog.close();
			}
		} );
	}

	/* ---------- Menu deep links: /menu/#rolls opens the Rolls tab ---------- */
	function openMenuTab( hash ) {
		var id = ( hash || '' ).replace( '#', '' );
		if ( ! id ) { return; }
		var btn = document.getElementById( 'tab-' + id );
		if ( btn && window.bootstrap && bootstrap.Tab ) {
			bootstrap.Tab.getOrCreateInstance( btn ).show();
		}
		var mobileBtn = document.querySelector( '[data-vqmenu-tab="mobile-tab-' + id + '"]' );
		if ( mobileBtn ) { mobileBtn.click(); }
	}
	openMenuTab( window.location.hash );
	$( window ).on( 'hashchange', function () { openMenuTab( window.location.hash ); } );

	/* ---------- Footer action bar: keep page content clear of it ---------- */
	if ( document.querySelector( '.rusans-actionbar' ) ) {
		document.body.classList.add( 'has-rusans-actionbar' );
	}
} );
