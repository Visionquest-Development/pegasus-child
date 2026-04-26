
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

		/* THE FLOATING BUTTON ON ABOUT US PAGE */

		$("#expand-button").on("click", function(event){
			//first open the container with the social stuff
			$("#expand-past-container").slideToggle();
			// Then add a class to the button to give it a hover
			$("#expand-button").toggleClass("current-menu-item");
			event.preventDefault();
		});
		
		/* MS CLOSE BUTTON - JS LIB AND RESUME PAGE */
		
		$('.page-template-tpl_js .legend .ms-close-btn').on( 'click', function(){
			$(this).toggleClass( 'closed' );
			$('.page-template-tpl_js .legend ul').fadeToggle(700);
		});
		
		
		
		  $('.carousel-orbit .slick-carousel').slick({
			centerMode: true,
			centerPadding: '0px',
			slidesToShow: 5,
			infinite: true,
			autoplay: true,
			autoplaySpeed: 3000,
			speed: 800,
			arrows: false,
			dots: false,
			pauseOnHover: false,
			variableWidth: false, // for cards to align well
			responsive: [
			  {
				breakpoint: 768,
				settings: {
				  slidesToShow: 3
				}
			  },
			  {
				breakpoint: 480,
				settings: {
				  slidesToShow: 1
				}
			  }
			]
		  });

		  // OPTIONAL: Click a card to bring it forward
		  $('.planet-card').on('click', function() {
			const index = $(this).parent().data('slick-index');
			$('.slick-carousel').slick('slickGoTo', index);
		  });
		
		
		
		// executes when complete page is fully loaded, including all frames, objects and images
		//alert("window is loaded");
		//let VQDEVselector = jQuery('.page-template-tpl_resume #large-header .pegasus-header-content');
		//var headerContent = VQDEVselector.html();
		
		//jQuery('.page-template-tpl_resume #large-header canvas').remove();
		//jQuery('#large-header').append('<video autoplay loop muted id="bgvid"><source src="https://www.youtube.com/embed/4aTS5iATUQc?rel=0&controls=0&autoplay=1&mute=1&start=60');
		
		/*let largeHeader = jQuery('.page-template-tpl_resume #page-wrap').prepend(
			'<div class="vqdev-background-container"><div class="w-embed-youtubevideo youtube fullheightwidth ">' + 
			'<video autoplay muted loop preload="auto">' +
				'<source src="https://visionquestdevelopment.com/storage/vqdev_background.mp4" type="video/mp4">' + 
				'Your browser does not support the video tag.' +
			'</video>' +  
			//'<iframe ' +
			//'src="https://www.youtube.com/embed/4aTS5iATUQc?rel=0&amp;controls=0&amp;autoplay=1&amp;mute=1&amp;start=60" ' +
			////'src="https://qbiqcamp.com/wp-content/uploads/2024/11/QBIQ-WEB-BANNER-VIDEO.mp4" ' +
			////'src="https://www.youtube.com/embed/2s4qYVu9itY?rel=0&amp;controls=0&amp;autoplay=1&amp;mute=1&amp;start=60" ' +
			//'frameborder="0" style="position:absolute;left:0;top:0;width:100%;height:100%;pointer-events:none"' +
			//' allow="autoplay; encrypted-media" allowfullscreen="" title="Front Page"></iframe>' + 
			'</div></div>');*/
		//largeHeader.append('<div class="pegasus-header-content d-block" data-wow-delay="2s">' + headerContent + '</div>');
		
		
		
		
		var dark_switch = ".page-template-tpl_resume .switch.dark-theme";
		var dark_theme_button = "#toggle-dark-theme";
		
		
		
		
		function toggleButtonClasses( element ) {
			$( element ).toggleClass('btn-default').toggleClass('btn-primary');
			//console.log( "jim" );
		}
		
		function getThemeValue( ) {
			//console.log( 'current theme color: ', $( dark_switch ).data('theme') );
			let outputValue = $( dark_switch ).attr('data-theme');
			return outputValue;
		}
		
		function changeThemeColor() {
			var currentTheme = getThemeValue();
			var newTheme = currentTheme === 'light' ? 'dark' : 'light';
			$(dark_switch).attr('data-theme', newTheme);
			/* if (  'light' === getThemeValue() ) {
				$(dark_switch).attr('data-theme', 'dark');
			}
			if ( 'dark' === getThemeValue() ) {
				$(dark_switch).attr('data-theme', 'light');
			} */
			//console.log( 'data attr changed to: ', getThemeValue() );
		}

		function toggleVideoBackground() {
			var container = $('.page-template-tpl_resume #page-wrap');
			var body = $( 'body' );
			var header = $('.page-template-tpl_resume .page-header');
			var resume = $('#resume-container');
			var theme = getThemeValue();
			
			if ('dark' === theme) {
				if (container.find('.vqdev-background-container').length === 0) {
					container.prepend(
						'<div class="vqdev-background-container"><div class="w-embed-youtubevideo youtube fullheightwidth">' +
						'<video autoplay muted loop preload="auto">' +
						'<source src="https://visionquestdevelopment.com/storage/vqdev_background.mp4" type="video/mp4">' +
						'Your browser does not support the video tag.' +
						'</video></div></div>'
					);
					body.addClass('black');
					header.addClass('white');
					resume.addClass('reverse');
				}
			} else {
				container.find('.vqdev-background-container').remove();
				body.removeClass('black');
				header.removeClass('white');
				resume.removeClass('reverse');
			}
		}
		
		//dark theme button
		$(dark_theme_button).on('click', function() {
			
			//toggleButtonClasses( this );
			//$(this).toggleClass('btn-default').toggleClass('btn-primary');
			
			//changeThemeColor();		
			
			//toggleVideoBackground();
			
			$(dark_switch).trigger('click');
		});
		
		//dark theme switch
		$(dark_switch).on('change', function() {
			//var currentTheme = getThemeValue();
			
			changeThemeColor();
			
			toggleButtonClasses( dark_theme_button );
			
			toggleVideoBackground();
			
			//$(dark_theme_button).trigger('click');
		});
		
		
		
		
		
		/* MATCHHEIGHT */

		$('.page-template-tpl_portfolio .mix-container .mix .card').matchHeight();
		
		$('.page-template-tpl_get_started .get-started-pricing .card h3').matchHeight();
		$('.page-template-tpl_get_started .get-started-pricing .card p').matchHeight();
		$('.page-template-tpl_get_started .get-started-pricing .card img').matchHeight();
		$('.page-template-tpl_get_started .get-started-pricing .card').matchHeight();
		
		
		/* HOME PAGE */
		$('.home #design .card h3').matchHeight();
		$('.home #design .card h4').matchHeight();
		$('.home #design .card').matchHeight();
		
		
		$('.home #development .card').matchHeight();
		
		
		
		
		



		
		
		
		//$('.page-template-tpl_portfolio .mix-container .mix .card .card-info').matchHeight();
		//$('#portfolio-list .portfolio-item').matchHeight();
		//$('.sow-slider-base .sow-slider-images li').matchHeight();
		
		/* */ 
		//var vqdev_grid = document.querySelector('.page-template-tpl_get_started .grid');
		//var pckry = new Packery( vqdev_grid, {
			//itemSelector: '.grid-item',
			//gutter: 10
		//});
		
		//var elem = document.querySelector('.page-template-tpl_get_started .grid');
		//var msnry = new Masonry(elem, {
		  //itemSelector: '.grid-item',
		  //columnWidth: '.grid-item', // This ensures all columns have the same width
		  //percentPosition: true,
		  //gutter: 30
		//});
		

		console.log( '██    ██ ██ ███████ ██  ██████  ███    ██  ██████  ██    ██ ███████  ███████ ████████' );
		console.log( '██    ██ ██ ██      ██ ██    ██ ████   ██ ██    ██ ██    ██ ██       ██         ██   ' );
		console.log( '██    ██ ██ ███████ ██ ██    ██ ██ ██  ██ ██    ██ ██    ██ █████    ███████    ██   ' );
		console.log( '██  ██  ██      ██ ██ ██    ██ ██  ██ ██ ██  █ ██ ██    ██ ██            ██    ██   ' );
		console.log( '████   ██ ███████ ██  ██████  ██   ████  ██████   ██████  ███████  ███████    ██   ' );
		
		
	}); //end document ready function

