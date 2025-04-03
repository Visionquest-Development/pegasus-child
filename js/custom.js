/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~OCTANE CUSTOM JS ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/



	jQuery(document).ready(function($) {
		
		
		$('#myCarousel').carousel({
			interval:   4000
		});
		
		
		var sliderClass = $('.pets-slider');
		if ( $(sliderClass).length ) {
			sliderClass.slick({
				centerMode: true,
				centerPadding: '60px',
				slidesToShow: 5,
				dots: true,
				infinite: true,
				speed: 300,
				
				
				responsive: [
					{
						breakpoint: 1024,
						settings: {
							slidesToShow: 3,
							slidesToScroll: 3,
							infinite: true,
							dots: true
						}
					},
					{
						breakpoint: 600,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 2
						}
					},
					{
						breakpoint: 480,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1
						}
					}
					// You can unslick at a given breakpoint now by adding:
					// settings: "unslick"
					// instead of a settings object
				]
			}); 
		}
		
		
		
		//$('.home-info-img img').matchHeight();
		$('.page-template-pets .content-item-container article').matchHeight();
		
		/*$('.open-popup-link').magnificPopup({
			items: {
				src: '#contact-popup'
			},
			type:'inline',
		  //midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
		}); */
		
		$("body").fitVids();
		
		$("body").fitVids('.pet-video-container');
		
		
		
		function checkboxes() {
			var checkboxes = document.querySelectorAll("#gform_14 input[type='checkbox']");
			var checkedCount = 0;
			  
			let tempEle = document.createElement("div");
			let error_field = document.querySelector("#field_14_21");
			  
			let temp = document.querySelector(".error-box");
				
			if ( temp ) {
				  //do nothing
			} else {
				tempEle.classList.add("error-box");
				error_field.appendChild(tempEle);
			}
			  
			for (var i = 0; i < checkboxes.length; i++) {
				if (checkboxes[i].checked) {
				  checkedCount++;
				}
			}
			//console.log( "check count", checkedCount );
			//document.querySelector("#gform_submit_button_14").setAttribute( 'disabled', "disabled" );
			if (checkedCount < 3) {

				document.querySelector("#field_14_21 .error-box").innerHTML = "Please check at least 3 checkboxes.";
				document.querySelector("#field_14_21 .error-box").classList.add("active");

				return false;
			}
			
			//document.querySelector("#gform_submit_button_14").removeAttribute( 'disabled' );
			//document.querySelector("#gform_submit_button_14").setAttribute( 'disabled', "disabled" );
		  
		    document.querySelector("#field_14_21 .error-box").innerHTML = "";
			document.querySelector("#field_14_21 .error-box").classList.remove("active");

		    return true;
		}
		
		//document.querySelector("form").addEventListener("change", checkboxes);
		
		
	}); //end document ready function

	
	jQuery(window).load(function($){
		//document.querySelector("#gform_submit_button_14").setAttribute( 'disabled', "disabled" );
	});
	
	jQuery(window).resize(function($) {
		if (jQuery(window).width() > 780) {
			jQuery('.opp-home-box .textwidget p').matchHeight({
				byRow: false
			});
			jQuery('.home-opp-content h1').matchHeight({
				byRow: false
			});
			jQuery('.home-opp-content h2').matchHeight({
				byRow: false
			});
			
		}else{
			//nothing
		}
	});
	