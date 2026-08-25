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

		/* Google Fonts used by the Rene Catherine home design ( Cormorant Garamond + Mulish ) */
		wp_enqueue_style( 'rcd-google-fonts', 'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400;1,500&family=Mulish:wght@300;400;500;600;700&display=swap', array(), null );

		/* qTip CSS */
		//wp_enqueue_style('twentytwenty-css', get_stylesheet_directory_uri() . '/css/twentytwenty.css', null, false, false);

	}
	add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

	/**
	 * Home template ( tpl_home.php ) CMB2 fields, defaults + render helpers.
	 */
	require_once get_stylesheet_directory() . '/inc/cmb2-home-fields.php';

	/**
	 * Services template ( tpl_services.php ) CMB2 fields, defaults + render helpers.
	 * Loaded after the home fields — it reuses the generic rcd_home_media() /
	 * rcd_home_row() / rcd_home_row_has_content() helpers defined there.
	 */
	require_once get_stylesheet_directory() . '/inc/cmb2-services-fields.php';

	/**
	 * Furniture custom post type + taxonomies + per-piece CMB2 fields.
	 */
	require_once get_stylesheet_directory() . '/inc/furniture-cpt.php';

	/**
	 * Furniture template ( tpl_furniture.php ) page CMB2 fields, defaults + helpers.
	 */
	require_once get_stylesheet_directory() . '/inc/cmb2-furniture-fields.php';

	/**
	 * Contact template ( tpl_contact.php ) CMB2 fields, defaults + form handler.
	 */
	require_once get_stylesheet_directory() . '/inc/cmb2-contact-fields.php';

	/**
	* Proper way to enqueue JS
	*/
	function pegasus_child_bootstrap_js() {

		wp_enqueue_script( 'pegasus_child_custom_js', get_stylesheet_directory_uri() . '/js/pegasus-custom.js', array(), '', true );

		//wp_enqueue_script( 'matchHeight_js', get_stylesheet_directory_uri() . '/js/jquery.matchHeight-min.js', array(), '', true );


	} //end function
	add_action( 'wp_enqueue_scripts', 'pegasus_child_bootstrap_js' );

	/**
	 * Isotope filtering for the Furniture collection grid — loaded only on the
	 * Furniture template. Mirrors the cadence_group_theme portfolio setup
	 * ( Isotope + imagesLoaded + a small vanilla init ).
	 */
	function rcd_furniture_isotope_scripts() {

		if ( ! is_page_template( 'tpl_furniture.php' ) ) {
			return;
		}

		$dir = get_stylesheet_directory_uri() . '/js/';

		wp_enqueue_script( 'imagesloaded', $dir . 'imagesloaded.js', array(), '4.1.4', true );
		wp_enqueue_script( 'isotope', $dir . 'isotope.js', array(), '3.0.6', true );
		wp_enqueue_script( 'rcd-furniture-isotope', $dir . 'rcd-furniture-isotope.js', array( 'isotope', 'imagesloaded' ), '1.0.0', true );

	} //end function
	add_action( 'wp_enqueue_scripts', 'rcd_furniture_isotope_scripts' );
