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
    var headerContent = jQuery('.home #large-header .pegasus-header-content').html();
    jQuery('.home #large-header canvas').remove();
    //jQuery('#large-header').append('<video autoplay loop muted id="bgvid"><source src="https://www.youtube.com/embed/4aTS5iATUQc?rel=0&controls=0&autoplay=1&mute=1&start=60');
    jQuery('.home #large-header').html('<div class="w-embed-youtubevideo youtube losangeles _2"><iframe ' +
      'src="https://www.youtube.com/embed/4aTS5iATUQc?rel=0&amp;controls=0&amp;autoplay=1&amp;mute=1&amp;start=60" ' +
      'frameborder="0" style="position:absolute;left:0;top:0;width:100%;height:100%;pointer-events:none"' +
      ' allow="autoplay; encrypted-media" allowfullscreen="" title="Front Page"></iframe></div>')
      .append('<div class="pegasus-header-content">' + headerContent + '</div>');
	});
