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
	});


	jQuery(window).on( 'load', function($) {
		// executes when complete page is fully loaded, including all frames, objects and images
		//alert("window is loaded");
	});


	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	   "Learn the Half Second" — reveal the comparison bars / figures when the
	   section scrolls into view. Falls back gracefully (bars show full width)
	   if IntersectionObserver is unavailable.
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
	(function () {
		var section = document.querySelector('.qb-halfsec');
		if (!section || !('IntersectionObserver' in window)) { return; }

		// Prep: set the animatable start state only now that JS can finish it.
		section.classList.add('qb-hs-prep');

		var io = new IntersectionObserver(function (entries) {
			entries.forEach(function (entry) {
				if (entry.isIntersecting) {
					entry.target.classList.add('is-visible');
					io.unobserve(entry.target);
				}
			});
		}, { threshold: 0.3 });

		io.observe(section);
	})();


	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	   Read Accelerator — Cover 2 / Cover 3 image tabs in the hero app mock.
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
	(function () {
		document.querySelectorAll('.v1-appmock').forEach(function (mock) {
			var tabs = mock.querySelectorAll('.v1-cover-tab');
			var imgs = mock.querySelectorAll('.v1-cover-img');
			if (!tabs.length || !imgs.length) { return; }

			tabs.forEach(function (tab) {
				tab.addEventListener('click', function () {
					var cover = tab.getAttribute('data-cover');
					tabs.forEach(function (t) {
						var on = (t === tab);
						t.classList.toggle('active', on);
						t.setAttribute('aria-selected', on ? 'true' : 'false');
					});
					imgs.forEach(function (im) {
						im.classList.toggle('is-active', im.getAttribute('data-cover') === cover);
					});
				});
			});
		});
	})();
