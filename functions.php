<?php

	/**
	 * Plugin requirements (TGMPA) & Bootstrap CMB2
	 */
	//require_once get_template_directory_uri() . 'inc/class-tgm-plugin-activation.php';

	/**
	 * OSPS26 — CMB2 metaboxes + icon helpers for the home and services templates.
	 */
	require_once get_stylesheet_directory() . '/inc/osps26-icons.php';
	require_once get_stylesheet_directory() . '/inc/cmb2-osps26.php';

	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	~~~~PROPER WAY OF ADDING CHILD THEME CSS FILE ~~~~
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/

	function theme_enqueue_styles() {
		wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

		/* qTip CSS */
		//wp_enqueue_style('twentytwenty-css', get_stylesheet_directory_uri() . '/css/twentytwenty.css', null, false, false);

		// Only load the OSPS26 design assets on the two new templates.
		if ( is_page_template( 'tpl_home.php' ) || is_page_template( 'tpl_services.php' ) || is_page_template( 'tpl_contact.php' ) ) {
			wp_enqueue_style(
				'osps26-fonts',
				'https://fonts.googleapis.com/css2?family=Archivo:wght@500;600;700;800;900&family=Public+Sans:wght@400;500;600;700&display=swap',
				array(),
				null
			);
			wp_enqueue_style(
				'osps26-design',
				get_stylesheet_directory_uri() . '/css/osps26-design.css',
				array( 'bootstrap-style', 'parent-style' ),
				filemtime( get_stylesheet_directory() . '/css/osps26-design.css' )
			);
		}
	}
	add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

	/**
	* Proper way to enqueue JS
	*/
	function pegasus_child_bootstrap_js() {

		wp_enqueue_script( 'pegasus_child_custom_js', get_stylesheet_directory_uri() . '/js/pegasus-custom.js', array(), '', true );

		//wp_enqueue_script( 'matchHeight_js', get_stylesheet_directory_uri() . '/js/jquery.matchHeight-min.js', array(), '', true );

		if ( is_page_template( 'tpl_home.php' ) || is_page_template( 'tpl_services.php' ) || is_page_template( 'tpl_contact.php' ) ) {
			wp_enqueue_script(
				'osps26-design',
				get_stylesheet_directory_uri() . '/js/osps26-design.js',
				array(),
				filemtime( get_stylesheet_directory() . '/js/osps26-design.js' ),
				true
			);
		}

	} //end function
	add_action( 'wp_enqueue_scripts', 'pegasus_child_bootstrap_js' );
