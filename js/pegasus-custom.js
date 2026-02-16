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

	/**
	 * Restaurant Menu Tabs helper
	 * - Supports deep linking: /menu-page/#dinner
	 * - Remembers last selected tab using localStorage
	 * Requires Bootstrap 5 JS for Tab behavior.
	 */
	(function () {
	  'use strict';

	  const tabsEl = document.getElementById('vqmenuTabs');
	  if (!tabsEl) return;

	  const STORAGE_KEY = 'vqmenu_active_tab';

	  function getTabButtonById(tabId) {
		// tabId is like "dinner" -> button#tab-dinner
		return document.querySelector(`#vqmenuTabs button#tab-${CSS.escape(tabId)}`);
	  }

	  function showTab(buttonEl) {
		if (!buttonEl) return;

		// Bootstrap Tab API
		if (window.bootstrap && window.bootstrap.Tab) {
		  const tab = new window.bootstrap.Tab(buttonEl);
		  tab.show();
		  return;
		}

		// Fallback: basic class toggling (in case Bootstrap JS isn't loaded)
		document.querySelectorAll('#vqmenuTabs .nav-link').forEach(btn => {
		  btn.classList.remove('active');
		  btn.setAttribute('aria-selected', 'false');
		});
		document.querySelectorAll('#vqmenuTabContent .tab-pane').forEach(pane => {
		  pane.classList.remove('show', 'active');
		});

		buttonEl.classList.add('active');
		buttonEl.setAttribute('aria-selected', 'true');

		const target = buttonEl.getAttribute('data-bs-target');
		if (target) {
		  const pane = document.querySelector(target);
		  if (pane) pane.classList.add('show', 'active');
		}
	  }

	  function resolveInitialTabId() {
		// 1) hash (e.g. #dinner)
		const hashId = (window.location.hash || '').replace('#', '').trim();
		if (hashId) return hashId;

		// 2) localStorage
		try {
		  const saved = localStorage.getItem(STORAGE_KEY);
		  if (saved) return saved;
		} catch (e) {}

		return null;
	  }

	  // Save tab changes + update hash
	  tabsEl.addEventListener('shown.bs.tab', function (e) {
		const btn = e.target;
		const id = (btn.id || '').replace(/^tab-/, '');
		if (!id) return;

		// set hash without jumping
		history.replaceState(null, '', `#${id}`);

		try {
		  localStorage.setItem(STORAGE_KEY, id);
		} catch (err) {}
	  });

	  // Initial activation
	  const initialId = resolveInitialTabId();
	  if (initialId) {
		const btn = getTabButtonById(initialId);
		if (btn) showTab(btn);
	  }

	})();
