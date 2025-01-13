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




    var scrollSpy = new bootstrap.ScrollSpy(document.body, {
      target: '#dotnav'
    });

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
