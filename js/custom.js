/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~OCTANE CUSTOM JS ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/

jQuery(document).ready(function ($) {
  $('#myCarousel').carousel({
    interval: 4000,
  });

  var sliderClass = $('.pets-slider');
  if ($(sliderClass).length) {
    sliderClass.slick({
      centerMode: true,
      centerPadding: '0',
      slidesToShow: 4,
      slidesToScroll: 4,
      dots: true,
      infinite: true,
      autoplay: true,
      responsive: [
        {
          breakpoint: 900,
          settings: {
            arrows: true,
            centerMode: true,
            centerPadding: '0',
            slidesToShow: 3
          }
        },
        {
          breakpoint: 768,
          settings: {
            arrows: true,
            centerMode: true,
            centerPadding: '0',
            slidesToShow: 1
          }
        }
      ]
    });
  }


  jQuery(document).ready(function($) {
    var petsSlider = $('.pets-template-slider');
    petsSlider.slick({
      slidesToShow: 3, // Show one slide at a time
      slidesToScroll: 1, // Scroll one slide at a time
      centerMode: true, // Center the current slide
      centerPadding: '0', // Add padding around the centered slide
      arrows: true, // Enable navigation arrows
      dots: true, // Disable dots
      infinite: true, // Enable infinite scrolling
      autoplay: true, // Enable autoplay
      autoplaySpeed: 3000, // Set autoplay speed
      responsive: [
        {
          breakpoint: 900,
          settings: {
            arrows: true,
            centerMode: true,
            centerPadding: '0',
            slidesToShow: 3
          }
        },
        {
          breakpoint: 768,
          settings: {
            arrows: true,
            centerMode: true,
            centerPadding: '0',
            slidesToShow: 1
          }
        }
      ]
    });

    // Apply matchHeight on slider initialization and every render
    petsSlider.on('setPosition', function() {
      petsSlider.find('img').matchHeight();
    });

    // Trigger matchHeight initially
    petsSlider.find('img').matchHeight();
  });

  $('.page-template-pets .content-item-container article').matchHeight();
  $('.volunteer-block').matchHeight();
  $('.camp-section').matchHeight();
  $('.camp-top-section').matchHeight();
  $('.camp-block').matchHeight();
  $('.counselor-page-block').matchHeight();
  $('.contact-section .card').matchHeight();
  $('.donation-block').matchHeight();
  //$('.donation-block p').matchHeight();

  //$('.volunteer-block p').matchHeight();


  $("#opp-button-1").on( 'click', function(){
    var targetUrl = window.location.host + '/volunteer-opportunities/';
    if (targetUrl) {
      window.location.href = targetUrl;
    } else {
      console.error("Target URL is not defined.");
    }
  });

  $("#opp-button-2").on( 'click', function(){
    var targetUrl = window.location.host + '/camp-counselors/';
    if (targetUrl) {
      window.location.href = targetUrl;
    } else {
      console.error("Target URL is not defined.");
    }
  });

  $("#opp-button-3").on( 'click', function(){
    var targetUrl = window.location.host + '/camp-opp-2025p/';
    if (targetUrl) {
      window.location.href = targetUrl;
    } else {
      console.error("Target URL is not defined.");
    }
  });

  $("#opp-button-4").on( 'click', function(){
    var targetUrl = window.location.host + '/contact';
    if (targetUrl) {
      window.location.href = targetUrl;
    } else {
      console.error("Target URL is not defined.");
    }
  });

  $("body").fitVids();
  $("body").fitVids('.pet-video-container');

  function checkboxes() {
    var checkboxes = document.querySelectorAll("#gform_14 input[type='checkbox']");
    var checkedCount = 0;

    let tempEle = document.createElement("div");
    let error_field = document.querySelector("#field_14_21");
    let temp = document.querySelector(".error-box");

    if (!temp) {
      tempEle.classList.add("error-box");
      error_field.appendChild(tempEle);
    }

    for (var i = 0; i < checkboxes.length; i++) {
      if (checkboxes[i].checked) {
        checkedCount++;
      }
    }

    if (checkedCount < 3) {
      document.querySelector("#field_14_21 .error-box").innerHTML = "Please check at least 3 checkboxes.";
      document.querySelector("#field_14_21 .error-box").classList.add("active");
      return false;
    }

    document.querySelector("#field_14_21 .error-box").innerHTML = "";
    document.querySelector("#field_14_21 .error-box").classList.remove("active");

    return true;
  }
});

jQuery(window).on( 'load', function ($) {
  //document.querySelector("#gform_submit_button_14").setAttribute( 'disabled', "disabled" );
});

jQuery(window).on( 'resize', function ($) {
  if (jQuery(window).width() > 780) {
    jQuery('.opp-home-box .textwidget p').matchHeight({
      byRow: false,
    });
    jQuery('.home-opp-content h1').matchHeight({
      byRow: false,
    });
    jQuery('.home-opp-content h2').matchHeight({
      byRow: false,
    });
  }
});
