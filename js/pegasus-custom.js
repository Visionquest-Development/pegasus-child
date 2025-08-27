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

		// Initialize collapsible search functionality
		initializeCollapsibleSearch();

	}); //end document ready function

	/**
	 * Initialize collapsible search functionality
	 * Bootstrap 5 implementation
	 */
	function initializeCollapsibleSearch() {
		const $ = jQuery;
		const searchToggleBtn = $('#searchToggleButton');
		const searchCollapse = $('#headerSearchCollapse');
		const searchInput = $('#headerSearchInput');
		const chevronIcon = searchToggleBtn.find('.chevron-icon');

		// Initialize Bootstrap 5 Collapse instance
		let bsCollapse = null;
		if (searchCollapse.length && typeof bootstrap !== 'undefined') {
			bsCollapse = new bootstrap.Collapse(searchCollapse[0], {
				toggle: false
			});
		}

		// Handle search toggle button click
		searchToggleBtn.on('click', function(e) {
			e.preventDefault();
			
			if (bsCollapse) {
				// Bootstrap 5
				bsCollapse.toggle();
			} else {
				// Fallback to jQuery if Bootstrap 5 not available
				searchCollapse.toggleClass('show');
				if (searchCollapse.hasClass('show')) {
					triggerShowEvent();
				} else {
					triggerHideEvent();
				}
			}
		});

		// Helper functions for manual toggle
		function triggerShowEvent() {
			chevronIcon.removeClass('fa-chevron-down').addClass('fa-chevron-up');
			searchToggleBtn.attr('aria-expanded', 'true');
			setTimeout(function() {
				searchInput.focus();
			}, 150);
		}

		function triggerHideEvent() {
			chevronIcon.removeClass('fa-chevron-up').addClass('fa-chevron-down');
			searchToggleBtn.attr('aria-expanded', 'false');
		}

		// Handle Bootstrap 5 collapse events
		searchCollapse.on('show.bs.collapse', function() {
			triggerShowEvent();
		});

		searchCollapse.on('hide.bs.collapse', function() {
			triggerHideEvent();
		});

		// Handle escape key to close search
		$(document).on('keydown', function(e) {
			if (e.key === 'Escape' && searchCollapse.hasClass('show')) {
				if (bsCollapse) {
					bsCollapse.hide();
				} else {
					searchCollapse.removeClass('show');
					triggerHideEvent();
				}
				searchToggleBtn.focus(); // Return focus to toggle button
			}
		});

		// Close search when clicking outside
		$(document).on('click', function(e) {
			if (searchCollapse.hasClass('show') && 
				!$(e.target).closest('.search-collapse-container').length && 
				!$(e.target).closest('.search-toggle-btn').length) {
				
				if (bsCollapse) {
					bsCollapse.hide();
				} else {
					searchCollapse.removeClass('show');
					triggerHideEvent();
				}
			}
		});

		// Prevent search form from closing when clicking inside it
		searchCollapse.on('click', function(e) {
			e.stopPropagation();
		});

		// Debug logging and functionality test
		if (typeof bootstrap === 'undefined') {
			console.warn('Bootstrap 5 not detected. Using fallback functionality for collapsible search.');
		} else {
			console.log('Bootstrap 5 detected. Collapsible search functionality initialized.');
		}

		// Verify elements exist
		if (searchToggleBtn.length === 0) {
			console.warn('Search toggle button not found. Make sure search is enabled in theme options.');
		}
		if (searchCollapse.length === 0) {
			console.warn('Search collapse container not found.');
		}
		if (searchInput.length === 0) {
			console.warn('Search input field not found.');
		}

		// Test function for debugging (can be called from browser console)
		window.testSearchToggle = function() {
			if (bsCollapse) {
				console.log('Testing Bootstrap 5 collapse...');
				bsCollapse.toggle();
			} else {
				console.log('Testing fallback toggle...');
				searchCollapse.toggleClass('show');
				if (searchCollapse.hasClass('show')) {
					triggerShowEvent();
				} else {
					triggerHideEvent();
				}
			}
		};
	}
	


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
