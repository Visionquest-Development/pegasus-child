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

		// Google Fonts used by the Gen2 design system (Technical Schematic +
		// Services templates). Loaded before the child stylesheet so the
		// @font-family stacks resolve.
		wp_enqueue_style(
			'gen2-fonts',
			'https://fonts.googleapis.com/css2?family=Archivo:wght@400;500;600;700;800;900&family=Archivo+Narrow:wght@400;500;600;700&family=Anton&family=Newsreader:ital,wght@0,300;0,400;0,500;0,600;1,400&family=JetBrains+Mono:wght@400;500;600&display=swap',
			array(),
			null
		);

		// Child stylesheet — explicit enqueue so we can set the dependency
		// chain (parent + fonts must load first) and bust cache by mtime.
		$child_style = get_stylesheet_directory() . '/style.css';
		wp_enqueue_style(
			'pegasus-child-style',
			get_stylesheet_directory_uri() . '/style.css',
			array( 'parent-style', 'gen2-fonts' ),
			file_exists( $child_style ) ? filemtime( $child_style ) : false
		);
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

	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	~~~~ CMB2 METABOXES FOR HOMEPAGE SECTIONS ~~~~~~
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	require_once get_stylesheet_directory() . '/inc/cmb2-metaboxes.php';
