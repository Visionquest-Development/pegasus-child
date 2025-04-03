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

		/* slick */
		wp_enqueue_style('slick-css', get_stylesheet_directory_uri() . '/css/slick.css', null, false, false);
		wp_enqueue_style('slick-theme-css', get_stylesheet_directory_uri() . '/css/slick-theme.css', null, false, false);

		wp_enqueue_style('magnific-css', get_stylesheet_directory_uri() . '/css/magnific.css', null, false, false);

	}
	add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
	/* ~~~~~^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^~~~~~
	~~~~PROPER WAY OF ADDING CHILD THEME CSS FILE ~~~~
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/




	/**
	* Proper way to enqueue JS and IE fixes as of Mar 2015
	*/
	function pegasus_child_bootstrap_js() {

		wp_enqueue_script( 'opp_custom_js', get_stylesheet_directory_uri() . '/js/custom.js', array(), '', true );

		wp_enqueue_script( 'matchHeight_js', get_stylesheet_directory_uri() . '/js/jquery.matchHeight-min.js', array(), '', true );

		wp_enqueue_script( 'fitvids_js', get_stylesheet_directory_uri() . '/js/fitvids.js', array(), '', true );

		//wp_enqueue_script( 'popup_js', get_stylesheet_directory_uri() . '/js/jquery.magnific-popup.min.js', array(), '', true );

		//wp_enqueue_script( 'pegasus_child_custom_js', get_stylesheet_directory_uri() . '/js/pegasus-custom.js', array(), '', true );
		//plugins_url( 'js/slick.min.js', dirname(__FILE__) . '/../../pegasus-carousel/pegasus-carousel.php' )
		$slick_js = get_stylesheet_directory_uri() . '/js/slick.js';

		wp_enqueue_script( 'slick_js', $slick_js, array(), '', true );

	} //end function
	add_action( 'wp_enqueue_scripts', 'pegasus_child_bootstrap_js' );

	function pegasus_child_admin_scripts() {
		//wp_enqueue_style('admin-styles', get_stylesheet_directory_uri().'/css/admin.css');
	}
	//add_action('admin_enqueue_scripts', 'pegasus_child_admin_scripts');


