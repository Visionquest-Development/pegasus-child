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

		$("iframe").fitVids();


	});


	jQuery(window).on('load', function($) {
		// executes when complete page is fully loaded, including all frames, objects and images
		//alert("window is loaded");
		let QBIQselector = jQuery('.home #large-header .pegasus-header-content');
		var headerContent = QBIQselector.html();
		jQuery('.home #large-header canvas').remove();
		//jQuery('#large-header').append('<video autoplay loop muted id="bgvid"><source src="https://www.youtube.com/embed/4aTS5iATUQc?rel=0&controls=0&autoplay=1&mute=1&start=60');
		let largeHeader = jQuery('.home #large-header').html(
			'<div class="w-embed-youtubevideo youtube losangeles _2">' + 
			'<video autoplay muted loop preload="auto">' +
				'<source src="https://qbiqcamp.com/wp-content/uploads/2024/11/QBIQ-WEB-BANNER-VIDEO-1.mp4" type="video/mp4">' + 
				'Your browser does not support the video tag.' +
			'</video>' +  
			//'<iframe ' +
			//'src="https://www.youtube.com/embed/4aTS5iATUQc?rel=0&amp;controls=0&amp;autoplay=1&amp;mute=1&amp;start=60" ' +
			////'src="https://qbiqcamp.com/wp-content/uploads/2024/11/QBIQ-WEB-BANNER-VIDEO.mp4" ' +
			////'src="https://www.youtube.com/embed/2s4qYVu9itY?rel=0&amp;controls=0&amp;autoplay=1&amp;mute=1&amp;start=60" ' +
			//'frameborder="0" style="position:absolute;left:0;top:0;width:100%;height:100%;pointer-events:none"' +
			//' allow="autoplay; encrypted-media" allowfullscreen="" title="Front Page"></iframe>' + 
			'</div>');
		largeHeader.append('<div class="pegasus-header-content wow fadeIn d-block" data-wow-delay="2s">' + headerContent + '</div>');
	});
	