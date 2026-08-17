<?php

	/**
	 * Plugin requirements (TGMPA) & Bootstrap CMB2
	 */
	//require_once get_template_directory_uri() . 'inc/class-tgm-plugin-activation.php';

	/**
	 * Home page ( tpl_home.php ) CMB2 fields + design default content.
	 * CMB2 itself is bootstrapped by the parent Pegasus theme.
	 */
	require_once get_stylesheet_directory() . '/inc/cmb2-homepage-fields.php';

	/**
	 * Services page ( tpl_services.php ) CMB2 fields + design default content.
	 * Loaded after the home fields file, which defines the shared
	 * elliot_field() / elliot_group() front-end helpers.
	 */
	require_once get_stylesheet_directory() . '/inc/cmb2-services-fields.php';

	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	~~~~PROPER WAY OF ADDING CHILD THEME CSS FILE ~~~~
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/

	function theme_enqueue_styles() {
		wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

		/* Google Fonts used by the Elliot Integration design */
		wp_enqueue_style(
			'elliot-fonts',
			'https://fonts.googleapis.com/css2?family=Spectral:ital,wght@0,400;0,500;0,600;1,400;1,500;1,600&family=IBM+Plex+Mono:wght@400;500;600&family=IBM+Plex+Sans:wght@400;500;600&display=swap',
			array(),
			null
		);

		/* The child style.css itself is enqueued by the parent theme under the
		   'pegasus' handle ( get_stylesheet_uri() ). We do not enqueue it a
		   second time here — instead pegasus_child_fix_style_cache() below
		   re-registers that single handle so it loads after Bootstrap and
		   busts cache on every edit. */

		/* qTip CSS */
		//wp_enqueue_style('twentytwenty-css', get_stylesheet_directory_uri() . '/css/twentytwenty.css', null, false, false);

	}
	add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

	/**
	* Proper way to enqueue JS
	*/
	function pegasus_child_bootstrap_js() {

		wp_enqueue_script( 'pegasus_child_custom_js', get_stylesheet_directory_uri() . '/js/pegasus-custom.js', array(), '', true );

		//wp_enqueue_script( 'matchHeight_js', get_stylesheet_directory_uri() . '/js/jquery.matchHeight-min.js', array(), '', true );


	} //end function
	add_action( 'wp_enqueue_scripts', 'pegasus_child_bootstrap_js' );
