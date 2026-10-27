/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ PEGASUS CUSTOM JS — MR NICE GUY ~~~~~~~~~~~~~~~~~~~~~~~
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/

jQuery( function ( $ ) {
	'use strict';

	var reduceMotion = window.matchMedia && window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;

	/* ---------- Gallery strip carousel (slick from pegasus-carousel, optional) ---------- */
	var $car = $( '[data-mng-carousel]' );
	if ( $car.length && $.fn.slick ) {
		$car.addClass( 'is-slick' ).slick( {
			slidesToShow: 4,
			slidesToScroll: 1,
			autoplay: ! reduceMotion,
			autoplaySpeed: 3200,
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
	var dialog = document.querySelector( '[data-mng-lightbox-dialog]' );
	if ( dialog && typeof dialog.showModal === 'function' ) {
		var img = dialog.querySelector( 'img' ), cap = dialog.querySelector( '.mng-lightbox__caption' );
		$( document ).on( 'click', '[data-mng-lightbox]', function ( e ) {
			e.preventDefault();
			img.src = this.getAttribute( 'href' );
			img.alt = this.getAttribute( 'data-caption' ) || '';
			cap.textContent = img.alt;
			dialog.showModal();
		} );
		$( dialog ).on( 'click', function ( e ) {
			if ( e.target === dialog || $( e.target ).hasClass( 'mng-lightbox__close' ) ) {
				dialog.close();
			}
		} );
	}

	/* ---------- Menu day chips: keep the sticky nav below the sticky header ---------- */
	var header = document.querySelector( '.mng-header' ), menuNav = document.querySelector( '.mng-menu-nav' );
	function placeMenuNav() {
		if ( header && menuNav ) {
			var top = window.getComputedStyle( header ).position === 'sticky' ? header.getBoundingClientRect().height : 0;
			menuNav.style.top = top + 'px';
		}
	}
	placeMenuNav();
	$( window ).on( 'resize', placeMenuNav );

	/* ---------- Footer action bar: keep page content clear of it ---------- */
	if ( document.querySelector( '.mng-actionbar' ) ) {
		document.body.classList.add( 'has-mng-actionbar' );
	}
} );
