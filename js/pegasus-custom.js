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
		
		
		
		/*var $grid = jQuery('.card-set-wrapper').imagesLoaded( function($) {
			// init Masonry after all images have loaded
			$grid.masonry({
				// options...
				//columnWidth: 360,
				itemSelector: '.card-set-item',
				gutter: 10
			});
		});*/
		
		
		
	});


	jQuery(window).load(function($) {
		// executes when complete page is fully loaded, including all frames, objects and images
		//alert("window is loaded");
		var $grid = jQuery('.card-set-wrapper').imagesLoaded( function($) {
			// init Masonry after all images have loaded
			$grid.packery({
				// options...
				//columnWidth: 360,
				itemSelector: '.card-set-item',
				gutter: 10
			});
		});
		
		jQuery('.ad-banner-area .ad-banner__content h2').matchHeight();
		
		jQuery('.ad-banner-area .ad-banner__content').matchHeight();
		
		
	});
