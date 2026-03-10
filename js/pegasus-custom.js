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

    jQuery('.fooevents-event-listing-tiles-content h3 a').matchHeight();
    jQuery('.fooevents-event-listing-tiles-content h3').matchHeight();

    jQuery('.fooevents-event-listing-tiles-location').matchHeight();
    jQuery('.fooevents-event-listing-tiles-content .event-date').matchHeight();
    jQuery('.fooevents-event-listing-tiles-content .event-time').matchHeight();
    jQuery('.fooevents-event-listing-tiles-content .event-excerpt').matchHeight();

    jQuery('.fooevents-event-listing-tiles-content').matchHeight();


		// executes when complete page is fully loaded, including all frames, objects and images
		//alert("window is loaded");

    /*jQuery('#fooevents-event-listing-tiles').packery({
      // options...
      //columnWidth: 200,
      itemSelector: '.fooevents-event-listing-tiles-content',
      gutter: 10
    });*/
    /*var $grid = jQuery('#fooevents-event-listing-tiles').imagesLoaded( function() {
      // init Masonry after all images have loaded
      $grid.packery({
        // options...
        //columnWidth: 200,
        itemSelector: '.fooevents-event-listing-tiles-content',
        gutter: 10
      });
    });*/

	});





  (function($) {
    var $grid = $('#fooevents-event-listing-tiles');
    var resizeTimer;

    function initOrLayoutPackery() {
      if (!$grid.length) return;

      if (!$grid.data('packery')) {
        $grid.packery({
          itemSelector: '.fooevents-event-listing-tiles-content',
          gutter: 10
        });
      } else {
        $grid.packery('layout');
      }


    }

    function relayoutAfterHeaderToggle() {
      // immediate pass
      initOrLayoutPackery();

      // second pass after sidebar animation/margin shift settles
      setTimeout(function() {
        initOrLayoutPackery();
      }, 350);
    }

    $(window).on('load', function() {
      initOrLayoutPackery();
    });

    $(window).on('resize', function() {
      clearTimeout(resizeTimer);
      resizeTimer = setTimeout(function() {
        initOrLayoutPackery();
      }, 150);
    });

    // Header Five nav toggle button (.navi-btn a)
    $(document).on('click', '#header .navi-btn a, .navi-btn a', function() {
      relayoutAfterHeaderToggle();
    });

    // Fallback: if #header open class changes by other logic
    $(document).on('transitionend', '.mainbar, #header', function() {
      initOrLayoutPackery();
    });
  })(jQuery);

  // Packery grid for homepage FooEvents calendar list
  (function($) {
    var $calGrid = $('.fooevents-calendar-list');
    var calResizeTimer;

    function initOrLayoutCalendarPackery() {
      if (!$calGrid.length) return;

      if (!$calGrid.data('packery')) {
        $calGrid.packery({
          itemSelector: '.fooevents-calendar-list-item',
          gutter: 10
        });
      } else {
        $calGrid.packery('layout');
      }
    }

    function calRelayoutAfterHeaderToggle() {
      initOrLayoutCalendarPackery();
      setTimeout(function() {
        initOrLayoutCalendarPackery();
      }, 350);
    }

    $(window).on('load', function() {
      initOrLayoutCalendarPackery();
    });

    $(window).on('resize', function() {
      clearTimeout(calResizeTimer);
      calResizeTimer = setTimeout(function() {
        initOrLayoutCalendarPackery();
      }, 150);
    });

    $(document).on('click', '#header .navi-btn a, .navi-btn a', function() {
      calRelayoutAfterHeaderToggle();
    });

    $(document).on('transitionend', '.mainbar, #header', function() {
      initOrLayoutCalendarPackery();
    });
  })(jQuery);
