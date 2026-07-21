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

	}); //end document ready function


	jQuery(document).ready(function($) {
		// executes when HTML-Document is loaded and DOM is ready
		//alert("document is ready");

    $('.home-testimonial-slide-content blockquote').matchHeight();
	});


	jQuery(window).load(function($) {
		// executes when complete page is fully loaded, including all frames, objects and images
		//alert("window is loaded");
	});


	/* ============================================================
	   HOME NEWS QUERY SLIDER — matchHeight
	   Equalize the height of each slide's content inside
	   .home-news-query-slider so the slider doesn't jump as the
	   user cycles between posts of varying length / image size.

	   Runs on `document.ready` so it fires BEFORE the slippery
	   slider plugin initializes (the slider plugin's IIFE has been
	   ordered to load AFTER this file via a script dependency in
	   the child theme's functions.php). Otherwise slippery converts
	   the <ul> into absolutely-positioned cycling layers first and
	   matchHeight measures already-mutated dimensions.
	   ============================================================ */
	jQuery(document).ready(function ($) {
		if (typeof $.fn.matchHeight !== 'function') {
			return; // matchHeight plugin not loaded on this page
		}

		var $sliders = $('.home-news-query-slider');
		if (!$sliders.length) {
			return;
		}

		function applyMatchHeight() {
			$sliders.each(function () {
				var $slider = $(this);

				// Match the structural pieces too, so titles/excerpts/CTAs line up
				$slider.find('.home-news-query-slide-content h3').matchHeight();
				$slider.find('.home-news-query-slide-content p').matchHeight();

        // Inner article wrapper
				$slider.find('.home-news-query-slide-content').matchHeight();

        // Outer slide containers (<li>)
				$slider.find('.home-news-query-slide').matchHeight();

			});
		}

		// Initial pass — runs synchronously here so heights are locked in
		// before slippery's plugin.js IIFE runs (it's the next script tag).
		// Slide <img> tags from the_post_thumbnail() carry explicit width &
		// height attributes, so the browser reserves layout space immediately
		// — matchHeight measures correctly even before image bytes finish
		// downloading.
		applyMatchHeight();

		// Second pass on full window load, in case any non-thumbnail images
		// inside the slides (rendered via wysiwyg/the_content) shift heights
		// after they finish downloading. matchHeight is idempotent — calling
		// it again just refreshes the min-heights.
		jQuery(window).on('load', applyMatchHeight);
	});
