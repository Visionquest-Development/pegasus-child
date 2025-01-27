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
		
		
		var isBackgroundFixed = false; // State to track whether the class has been added

		function toggle_background_attachment_fixed() {
			$('.tickets-container, .qbiqcamp-home-section').toggleClass('background-attachment-fixed');
			isBackgroundFixed = !isBackgroundFixed; // Update state
		}

		function checkWindowSize() {
			var currentWidth = $(window).width();
			if (currentWidth <= 768 && !isBackgroundFixed) {
				// Window size is less than or equal to 768px and background isn't fixed
				toggle_background_attachment_fixed();
			} else if (currentWidth > 768 && isBackgroundFixed) {
				// Window size is greater than 768px and background is fixed
				toggle_background_attachment_fixed();
			}
		}

		// Initial check
		checkWindowSize();

		// Check on resize
		$(window).resize(checkWindowSize);
		
		
		
		/*
		function toggle_background_attachment_fixed() {
			$('.tickets-container').toggleClass('background-attachment-fixed');
			$('.qbiqcamp-home-section').toggleClass('background-attachment-fixed');
		}
		
		if( $(window).width() <= 768 ){
			toggle_background_attachment_fixed();
		} //end if
		
		$( window ).resize(function() {
			if($(window).width() < 768){
				toggle_background_attachment_fixed();
			}
		});
		*/
		
		
	}); //end document ready function


	jQuery(document).ready(function($) {
		// executes when HTML-Document is loaded and DOM is ready
		//alert("document is ready");

		$("iframe").fitVids();
		
		
		document.querySelectorAll(".card-wrap").forEach((cardWrap) => {
		  const card = cardWrap.querySelector(".card");
		  const cardBg = cardWrap.querySelector(".card-bg");

		  let width = cardWrap.offsetWidth;
		  let height = cardWrap.offsetHeight;

		  cardWrap.addEventListener("mousemove", (e) => {
			const mouseX = e.pageX - cardWrap.offsetLeft - width / 2;
			const mouseY = e.pageY - cardWrap.offsetTop - height / 2;
			const mousePX = mouseX / width;
			const mousePY = mouseY / height;

			const rX = mousePX * 30;
			const rY = mousePY * -30;

			card.style.transform = `rotateY(${rX}deg) rotateX(${rY}deg)`;

			const tX = mousePX * -40;
			const tY = mousePY * -40;
			cardBg.style.transform = `translateX(${tX}px) translateY(${tY}px)`;
		  });

		  cardWrap.addEventListener("mouseenter", () => {
			clearTimeout(cardWrap.mouseLeaveDelay);
		  });

		  cardWrap.addEventListener("mouseleave", () => {
			cardWrap.mouseLeaveDelay = setTimeout(() => {
			  card.style.transform = "";
			  cardBg.style.transform = "";
			}, 1000);
		  });

		  cardBg.style.backgroundImage = `url(${cardWrap.getAttribute("data-image")})`;
		});

		
		
		document.querySelectorAll('.city-item').forEach(item => {
		  const stateId = item.getAttribute('data-state'); // Get the state ID from the data attribute

		  item.addEventListener('mouseenter', () => {
			const stateElement = document.querySelector(`#qbiq-camp-map #${stateId}`);
			
			if ( "ALL" === stateId ) {			
				document.querySelectorAll('#qbiq-camp-map svg path').forEach(path => {
					path.style.fill = '#f15033'; // Keep all states highlighted
				});
			}
			
			if ( "LEAD" === stateId ) {		
				let stateArray = [
					'path#GA',
					'path#NJ',
					'path#NV',
					'path#TN',
					'path#TX',
				];
				
				//console.log( stateArray );
				
				
				stateArray.forEach(state => {
					//console.log( '#qbiq-camp-map svg ' + state );
					document.querySelectorAll('#qbiq-camp-map svg ' + state ).forEach(path => {
						path.style.fill = '#f15033';
					});
				});
			}
			
			if (stateElement) {
			  stateElement.style.fill = '#f15033'; // Set the fill color
			  stateElement.style.cursor = 'pointer'; // Add cursor style
			}
		  });

		  item.addEventListener('mouseleave', () => {
			const stateElement = document.querySelector(`#qbiq-camp-map #${stateId}`);
			
			if ( "ALL" === stateId ) {			
				document.querySelectorAll('#qbiq-camp-map svg path').forEach(path => {
					path.style.fill = ''; // Keep all states highlighted
				});
			}
			
			if ( "LEAD" === stateId ) {		
				let stateArray = [
					'path#GA',
					'path#NJ',
					'path#NV',
					'path#TN',
					'path#TX',
				];
				stateArray.forEach(state => {
					document.querySelectorAll('#qbiq-camp-map svg ' + state ).forEach(path => {
						path.style.fill = '';
					});
				});
			}
			
			if (stateElement) {
			  stateElement.style.fill = ''; // Reset the fill color
			  stateElement.style.cursor = ''; // Reset the cursor style
			}
		  });
		});

	});
	
	
	document.addEventListener('DOMContentLoaded', function() {
		// Function to update the SVG height
		function updateSvgHeight() {
			var svg = document.getElementById('usa');
			if (!svg) return; // Exit if the SVG is not found

			// Check if the window width is less than 768 pixels
			if (window.innerWidth < 768) {
				svg.setAttribute('height', '350'); // Set height to 350
			} else {
				svg.setAttribute('height', '450'); // Replace 'original_height' with your default value
			}
		}

		// Call the function initially and whenever the window is resized
		updateSvgHeight();
		window.addEventListener('resize', updateSvgHeight);
	});


	/*document.addEventListener('DOMContentLoaded', () => {
	  // Select all ticket containers and tickets
	  const containers = document.querySelectorAll('.register-ticket-container');

	  containers.forEach((container) => {
		const ticket = container.querySelector('.register-ticket');

		if (ticket) {
		  container.addEventListener('mousemove', (e) => {
			const rect = ticket.getBoundingClientRect();

			// Calculate the center of the ticket
			const ticketCenterX = rect.left + rect.width / 2;
			const ticketCenterY = rect.top + rect.height / 2;

			// Calculate the angle between the cursor and the ticket center
			const angleX = (e.clientX - ticketCenterX) / 10; // Smaller divisor for more dramatic rotation
			const angleY = -(e.clientY - ticketCenterY) / 10;

			// Apply rotation transform
			ticket.style.transform = `rotateX(${angleY}deg) rotateY(${angleX}deg)`;
		  });

		  container.addEventListener('mouseleave', () => {
			// Reset the rotation when the cursor leaves the container
			ticket.style.transform = `rotateX(0deg) rotateY(0deg)`;
		  });
		}
	  });
	});*/
	
	document.querySelectorAll(".register-ticket-container").forEach((cardWrap) => {
		  const card = cardWrap.querySelector(".register-ticket");
		  //const cardBg = cardWrap.querySelector(".card-bg");

		  let width = cardWrap.offsetWidth;
		  let height = cardWrap.offsetHeight;

		  cardWrap.addEventListener("mousemove", (e) => {
			const mouseX = e.pageX - cardWrap.offsetLeft - width / 2;
			const mouseY = e.pageY - cardWrap.offsetTop - height / 2;
			const mousePX = mouseX / width;
			const mousePY = mouseY / height;

			const rX = mousePX * 30;
			const rY = mousePY * -30;

			card.style.transform = `rotateY(${rX}deg) rotateX(${rY}deg)`;

			const tX = mousePX * -40;
			const tY = mousePY * -40;
			//cardBg.style.transform = `translateX(${tX}px) translateY(${tY}px)`;
		  });

		  cardWrap.addEventListener("mouseenter", () => {
			clearTimeout(cardWrap.mouseLeaveDelay);
		  });

		  cardWrap.addEventListener("mouseleave", () => {
			cardWrap.mouseLeaveDelay = setTimeout(() => {
			  card.style.transform = "";
			  //cardBg.style.transform = "";
			}, 1000);
		  });

		  //cardBg.style.backgroundImage = `url(${cardWrap.getAttribute("data-image")})`;
	});



	/*jQuery(window).on('load', function($) {
		// executes when complete page is fully loaded, including all frames, objects and images
		//alert("window is loaded");
		let QBIQselector = jQuery('.home #large-header .pegasus-header-content');
		var headerContent = QBIQselector.html();
		jQuery('.home #large-header canvas').remove();
		//jQuery('#large-header').append('<video autoplay loop muted id="bgvid"><source src="https://www.youtube.com/embed/4aTS5iATUQc?rel=0&controls=0&autoplay=1&mute=1&start=60');
		let largeHeader = jQuery('.home #large-header').html(
			'<div class="w-embed-youtubevideo youtube losangeles _2">' + 
			'<video autoplay muted loop preload="auto" playsinline>' +
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
	});*/
	
	
	jQuery(window).on('load', function($) {
		// Executes when the complete page is fully loaded, including all frames, objects, and images

		let QBIQselector = jQuery('.home #large-header .pegasus-header-content');
		var headerContent = QBIQselector.html();
		

		// Create a video element dynamically
		let videoElement = document.createElement('video');
		videoElement.autoplay = true;
		videoElement.muted = true;
		videoElement.loop = true;
		videoElement.playsInline = true; 
		videoElement.preload = 'auto';
		

		// Create a source element and add it to the video
		let sourceElement = document.createElement('source');
		sourceElement.src = 'https://qbiqcamp.com/wp-content/uploads/2024/11/QBIQ-WEB-BANNER-VIDEO-1.mp4';
		sourceElement.type = 'video/mp4';
		
		
		videoElement.appendChild(sourceElement);
		jQuery('.home #large-header canvas').remove();

		// Prefetch the video
		videoElement.addEventListener('canplaythrough', function() {
			// Append the video to the DOM once it's ready
			let largeHeader = jQuery('.home #large-header');
			largeHeader.html('<div class="w-embed-youtubevideo youtube losangeles _2"></div>');
			largeHeader.find('.w-embed-youtubevideo').append(videoElement);

			// Re-add the header content
			largeHeader.append('<div class="pegasus-header-content wow fadeIn d-block" data-wow-delay="1.5s">' + headerContent + '</div>');
		});

		// Start loading the video
		videoElement.load();
		
		
		
		
	});

	
	
