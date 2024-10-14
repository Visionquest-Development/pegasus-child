<?php
	
	/**
	 * Plugin requirements (TGMPA) & Bootstrap CMB2
	 */
	//require_once get_template_directory_uri() . 'inc/class-tgm-plugin-activation.php';

	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	~~~~PROPER WAY OF ADDING CHILD THEME CSS FILE ~~~~
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/

	function theme_enqueue_styles() {
		wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
		
		/* qTip CSS */
		wp_enqueue_style('odor-css', get_stylesheet_directory_uri() . '/css/style.css', null, false, false);
		wp_enqueue_style('swiper-css', get_stylesheet_directory_uri() . '/css/swiper-bundle.min.css', null, false, false);
		
		
	}
	add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
		
	/**
	* Proper way to enqueue JS 
	*/
	function pegasus_child_bootstrap_js() {
		
		wp_enqueue_script( 'pegasus_custom_js', get_stylesheet_directory_uri() . '/js/pegasus-custom.js', array(), '', true );
		
		wp_enqueue_script( 'swiper_js', get_stylesheet_directory_uri() . '/js/swiper-bundle.min.js', array(), '', true );
		
		wp_enqueue_script( 'counter_js', get_stylesheet_directory_uri() . '/js/jquery.counterup.min.js', array(), '', true );
		
		
		wp_enqueue_script( 'isotope_js', get_stylesheet_directory_uri() . '/js/isotope.pkgd.min.js', array(), '', true );
		
		
		
		
		
		wp_enqueue_script( 'odor_js', get_stylesheet_directory_uri() . '/js/script.js', array(), '', true );
		
		//wp_enqueue_script( 'pace_js', get_stylesheet_directory_uri() . '/js/pace.min.js', array(), '', true );
		
		
	} //end function
	add_action( 'wp_enqueue_scripts', 'pegasus_child_bootstrap_js' );
	

	
