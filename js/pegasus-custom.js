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

    $('.pegasus-toggle .pegasus-trigger').each(function() {
      var $trigger = $(this);
      if ($trigger.find('.pegasus-toggle-icon').length === 0) {
        $trigger.append(' <i class="fa fa-chevron-up pegasus-toggle-icon" aria-hidden="true"></i>');
      }

    });

    $('.pegasus-toggle .pegasus-trigger').on('click', function() {
      var $trigger = $(this);
      $trigger.find('.pegasus-toggle-icon').toggleClass('fa-chevron-up fa-chevron-down');
    });


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
			  breakpoint: 768,
			  settings: {
				arrows: true,
				centerMode: false,
				slidesToShow: 3
			  }
			},
			{
			  breakpoint: 480,
			  settings: {
				arrows: true,
				centerMode: false,
				slidesToShow: 1
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

	jQuery(window).on( 'ready', function($) {
		// executes when complete page is fully loaded, including all frames, objects and images
		//alert("window is loaded");


	});

