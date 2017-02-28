<?php
	
	function theme_enqueue_styles() {
		wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
		
		/* qTip CSS */
		//wp_enqueue_style('twentytwenty-css', get_stylesheet_directory_uri() . '/css/twentytwenty.css', null, false, false);
		
	}
	add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
	/* ~~~~~^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^~~~~~
	~~~~PROPER WAY OF ADDING CHILD THEME CSS FILE ~~~~
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/

	
	
	
	/**
	* Proper way to enqueue JS and IE fixes as of Mar 2015
	*/
	function pegasus_child_bootstrap_js() {
		
		//wp_enqueue_script( 'pegasus_custom_js', get_stylesheet_directory_uri() . '/js/octane-custom.js', array(), '', true );
		
		//wp_enqueue_script( 'matchHeight_js', get_stylesheet_directory_uri() . '/js/jquery.matchHeight-min.js', array(), '', true );
		
		
	} //end function
	add_action( 'wp_enqueue_scripts', 'pegasus_child_bootstrap_js' );
	

	
