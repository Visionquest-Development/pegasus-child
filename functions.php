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

		/* Google Fonts used by the Valor Care home template (Cinzel + Lato) */
		wp_enqueue_style(
			'valorcare-fonts',
			'https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&family=Lato:ital,wght@0,300;0,400;0,700;0,900;1,400&display=swap',
			array(),
			null
		);

		/* qTip CSS */
		//wp_enqueue_style('twentytwenty-css', get_stylesheet_directory_uri() . '/css/twentytwenty.css', null, false, false);

	}
	add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

	/**
	 * Load Google Fonts preconnect hints for faster font delivery.
	 */
	function valorcare_font_preconnect() {
		echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
		echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
	}
	add_action( 'wp_head', 'valorcare_font_preconnect', 1 );

	/**
	 * Theme CMB2 field definitions + shared helpers.
	 * (Only meaningful when CMB2 is available via the parent theme.)
	 */
	function valorcare_include_cmb2_fields() {
		foreach ( array( 'cmb2-home-fields.php', 'cmb2-services-fields.php', 'cmb2-service-single-fields.php', 'cmb2-about-fields.php', 'cmb2-contact-fields.php', 'cmb2-apply-fields.php' ) as $file ) {
			$path = get_stylesheet_directory() . '/inc/' . $file;
			if ( file_exists( $path ) ) {
				require_once $path;
			}
		}
	}
	add_action( 'after_setup_theme', 'valorcare_include_cmb2_fields' );

	/**
	 * Caregiver Application (Gravity Form) — keep the theme-bundled field set in
	 * sync with Gravity Form ID 2. Safe no-op when Gravity Forms is inactive.
	 */
	function valorcare_include_gravity_forms() {
		$path = get_stylesheet_directory() . '/inc/gf-caregiver-application.php';
		if ( file_exists( $path ) ) {
			require_once $path;
		}
	}
	add_action( 'after_setup_theme', 'valorcare_include_gravity_forms' );

	/**
	* Proper way to enqueue JS
	*/
	function pegasus_child_bootstrap_js() {

		wp_enqueue_script( 'pegasus_child_custom_js', get_stylesheet_directory_uri() . '/js/pegasus-custom.js', array(), '', true );

		//wp_enqueue_script( 'matchHeight_js', get_stylesheet_directory_uri() . '/js/jquery.matchHeight-min.js', array(), '', true );


	} //end function
	add_action( 'wp_enqueue_scripts', 'pegasus_child_bootstrap_js' );

	/*
	 * Scroll animations are provided by the Pegasus Wow plugin, which enqueues
	 * Animate.css + WOW.js site-wide and initializes WOW in the footer
	 * (animateClass "animated"). Templates opt an element in with class
	 * "wow fadeInUp" (any Animate.css animation) plus optional data-wow-delay /
	 * data-wow-duration / data-wow-offset / data-wow-iteration attributes.
	 * Nothing to enqueue here — keep the plugin active.
	 */
