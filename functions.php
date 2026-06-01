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

		// Google Fonts — Archivo (display) + Inter (body)
		wp_enqueue_style(
			'qbiq-fonts',
			'https://fonts.googleapis.com/css2?family=Archivo:wght@500;600;700;800;900&family=Inter:wght@400;500;600;700;800&display=swap',
			array(),
			null
		);

		// Bootstrap Icons
		wp_enqueue_style(
			'bootstrap-icons',
			'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css',
			array(),
			'1.11.3'
		);

		// QBIQ tokens (sitewide)
		wp_enqueue_style(
			'qbiq-tokens',
			get_stylesheet_directory_uri() . '/assets/css/qbiq.css',
			array( 'parent-style' ),
			filemtime( get_stylesheet_directory() . '/assets/css/qbiq.css' )
		);

		// Home V1 page-scoped styles (only on the Home template)
		if ( is_page_template( 'tpl_home.php' ) ) {
			wp_enqueue_style(
				'qbiq-home',
				get_stylesheet_directory_uri() . '/assets/css/qbiq-home.css',
				array( 'qbiq-tokens' ),
				filemtime( get_stylesheet_directory() . '/assets/css/qbiq-home.css' )
			);
		}

		// How It Works page-scoped styles
		if ( is_page_template( 'tpl_works.php' ) ) {
			wp_enqueue_style(
				'qbiq-works',
				get_stylesheet_directory_uri() . '/assets/css/qbiq-works.css',
				array( 'qbiq-tokens' ),
				filemtime( get_stylesheet_directory() . '/assets/css/qbiq-works.css' )
			);
		}

		// For Coaches page-scoped styles
		if ( is_page_template( 'tpl_coaches.php' ) ) {
			wp_enqueue_style(
				'qbiq-coaches',
				get_stylesheet_directory_uri() . '/assets/css/qbiq-coaches.css',
				array( 'qbiq-tokens' ),
				filemtime( get_stylesheet_directory() . '/assets/css/qbiq-coaches.css' )
			);
		}

		// Camps & Training Centers page-scoped styles
		if ( is_page_template( 'tpl_camp.php' ) ) {
			wp_enqueue_style(
				'qbiq-camp',
				get_stylesheet_directory_uri() . '/assets/css/qbiq-camp.css',
				array( 'qbiq-tokens' ),
				filemtime( get_stylesheet_directory() . '/assets/css/qbiq-camp.css' )
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


	} //end function
	add_action( 'wp_enqueue_scripts', 'pegasus_child_bootstrap_js' );

	/**
	 * CMB2 metaboxes for the QBIQ Home template.
	 */
	$qbiq_home_metaboxes = get_stylesheet_directory() . '/inc/cmb2-home-metaboxes.php';
	if ( file_exists( $qbiq_home_metaboxes ) ) {
		require_once $qbiq_home_metaboxes;
	}
