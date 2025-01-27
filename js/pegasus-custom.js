/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~PEGASUS CUSTOM JS ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/

  // responsive-tables.js
	jQuery(document).ready(function($) {
		var switched = false;
		var updateTables = function() {
			if (($(window).width() < 767) && !switched ){
			  switched = true;
			  $("table.responsive").each(function(i, element) {
				splitTable($(element));
			  });
			  return true;
			}
			else if (switched && ($(window).width() > 767)) {
			  switched = false;
			  $("table.responsive").each(function(i, element) {
				unsplitTable($(element));
			  });
			}
		};

		$(window).load(updateTables);
		$(window).on("redraw",function(){switched=false;updateTables();}); // An event to listen for
		$(window).on("resize", updateTables);


		function splitTable(original) {
			original.wrap("<div class='table-wrapper' />");

			var copy = original.clone();
			copy.find("td:not(:first-child), th:not(:first-child)").css("display", "none");
			copy.removeClass("responsive");

			original.closest(".table-wrapper").append(copy);
			copy.wrap("<div class='pinned' />");
			original.wrap("<div class='scrollable' />");

			setCellHeights(original, copy);
		}

		function unsplitTable(original) {
			original.closest(".table-wrapper").find(".pinned").remove();
			original.unwrap();
			original.unwrap();
		}

		function setCellHeights(original, copy) {
			var tr = original.find('tr'),
				tr_copy = copy.find('tr'),
				heights = [];

			tr.each(function (index) {
			  var self = $(this),
				  tx = self.find('th, td');

			  tx.each(function () {
				var height = $(this).outerHeight(true);
				heights[index] = heights[index] || 0;
				if (height > heights[index]) heights[index] = height;
			  });

			});

			tr_copy.each(function (index) {
			  $(this).height(heights[index]);
			});
		}
	});

	jQuery(window).on('load resize', function ($) {
		if (jQuery(this).width() < 767) {
			jQuery('table tfoot').hide();
		} else {
			jQuery('table tfoot').show();
		}
	});



	jQuery(document).ready(function($) {

		//if($(window).width() >= 768){
			//initialize()
		//}//end if

		//$( window ).resize(function() {
			//if($(window).width() > 768){
				//initialize();
			//}

		//});
		
		

    jQuery( '.keegans-header-menu li a' ).removeAttr("data-toggle").removeAttr("data-bs-toggle");


	/*jQuery(window).load(function($) {
		// executes when complete page is fully loaded, including all frames, objects and images
		//alert("window is loaded");
		
		
		
		var $grid = jQuery('body.page-template-tpl_masonry .pegasus-logo-slider-wrapper').imagesLoaded( function($) {
			// init Masonry after all images have loaded
			$grid.masonry({
				// options...
				//columnWidth: 360,
				itemSelector: '.pegasus-logo-slider-container',
				gutter: 10
			});
		});
	});*/
	
	jQuery(window).load(function($) {
		// Executes when the complete page is fully loaded, including all frames, objects, and images
		
		var $element = jQuery('body.page-template-tpl_masonry');
		if ( $element.length ) {
			var $grid = jQuery('.pegasus-logo-slider-wrapper').imagesLoaded(function() {
				// Initialize Masonry after all images have loaded
				$grid.masonry({
					// options
					itemSelector: '.pegasus-logo-slider-container',
					gutter: 10
				});
			});
		}
		

		// Function to refresh Masonry
		function refreshMasonry() {
			if ($grid) {
				$grid.masonry('layout');
			}
		}

		// Detect changes in .mainbar or #header using MutationObserver
		var observerConfig = { childList: true, subtree: true, attributes: true };

		var observerCallback = function(mutationsList) {
			for (let mutation of mutationsList) {
				// Check if the mutation affects .mainbar or #header
				if (mutation.target.matches('.mainbar, #header')) {
					refreshMasonry();
				}
			}
		};

		var mainbar = document.querySelector('.mainbar');
		var header = document.querySelector('#header');
		if (mainbar || header) {
			var observer = new MutationObserver(observerCallback);
			if (mainbar) observer.observe(mainbar, observerConfig);
			if (header) observer.observe(header, observerConfig);
		}

		// Optional: Manually trigger Masonry refresh when needed
		jQuery('.mainbar, #header').on('customChange', function() {
			refreshMasonry();
		});
	});


	var $dotElement = jQuery('#dotnav');
	if ( $dotElement.length ) {
		var scrollSpy = new bootstrap.ScrollSpy(document.body, {
		  target: '#dotnav'
		});
	}
    var scrollSpy2 = new bootstrap.ScrollSpy(document.body, {
      target: '#menu-main-nav-2'
    });


    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl, {
        placement: 'left',
      })
    });

		// $(function () {
		//   $('[data-toggle="tooltip"]').tooltip();
		// });



	}); //end document ready function


	// jQuery(document).ready(function($) {
	// 	// executes when HTML-Document is loaded and DOM is ready
	// 	//alert("document is ready");
	// });


	jQuery(window).on('load', function($) {
		// executes when complete page is fully loaded, including all frames, objects and images
		//alert("window is loaded");
	});
