/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~PEGASUS CUSTOM JS ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/



	jQuery(document).ready(function($) {

		//if($(window).width() >= 768){
			//initialize()
		//}//end if

		//$( window ).resize(function() {
			//if($(window).width() > 768){
				//initialize();
			//}

		//});

    $('.ulg-logo-slider').slick({
		  centerMode: false,
      draggable: true,
      arrows: true,
      dots: true,
		  slidesToShow: 5,
		  autoplay: true,
		  autoplaySpeed: 6000,
		  speed: 800,
		  responsive: [
			{
			  breakpoint: 990,
			  settings: {
				arrows: true,
				centerMode: false,
				slidesToShow: 3
			  }
			},
			{
			  breakpoint: 560,
			  settings: {
				arrows: true,
				centerMode: false,
				slidesToShow: 2
			  }
			}
		  ]
		});

	}); //end document ready function


	jQuery(document).ready(function($) {
		// executes when HTML-Document is loaded and DOM is ready
		//alert("document is ready");
	});


	jQuery(window).on( 'load', function($) {
		// executes when complete page is fully loaded, including all frames, objects and images
		//alert("window is loaded");
	});


	/*====================================================================
	  Dynamic sticky nav positioning for header_three + ULG top bar
	  Reads #mega-menu's actual bottom edge and sets .vqmenu-mobile-nav
	  top value so it always sits directly below the fixed header,
	  whether the .on class is active or not.
	=====================================================================*/
	(function($) {
		var stickyNav = document.querySelector('.vqmenu-mobile-nav');
		var megaMenu  = document.getElementById('mega-menu');

		if (!stickyNav || !megaMenu) return;

		var ticking = false;

		function updateStickyNavTop() {
			var menuBottom = megaMenu.getBoundingClientRect().bottom;
			stickyNav.style.top = menuBottom + 'px';
			ticking = false;
		}

		function requestUpdate() {
			if (!ticking) {
				ticking = true;
				requestAnimationFrame(updateStickyNavTop);
			}
		}

		// Track scroll and resize
		window.addEventListener('scroll', requestUpdate, { passive: true });
		window.addEventListener('resize', requestUpdate);

		// Initial position once DOM is ready
		$(document).ready(updateStickyNavTop);

		// Re-check after full page load (fonts/images may shift heights)
		$(window).on('load', updateStickyNavTop);

	})(jQuery);
