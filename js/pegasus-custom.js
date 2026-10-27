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
