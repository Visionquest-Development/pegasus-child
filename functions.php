<?php

	/**
	 * Pegasus Child — Insurance Guy Joe (branch: insuranceguyjoe_theme)
	 *
	 * Plugin requirements (TGMPA) & Bootstrap CMB2
	 */
	//require_once get_template_directory_uri() . 'inc/class-tgm-plugin-activation.php';

	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	~~~~PROPER WAY OF ADDING CHILD THEME CSS FILE ~~~~
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/

	function theme_enqueue_styles() {
		wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
		/* No web fonts: the theme uses a system font stack (no render-blocking font requests). */
	}
	add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

	/**
	* Proper way to enqueue JS
	*/
	function pegasus_child_bootstrap_js() {

		/*
		 * pegasus-carousel (slick) only when the home page has 2+ testimonials to rotate.
		 * pegasus-slider isn't used: a rotating hero slows the LCP image and hurts conversions.
		 */
		$deps = array( 'jquery' );
		if ( is_front_page() && count( (array) igj_site( 'testimonials', array() ) ) > 1 && wp_script_is( 'slick-js', 'registered' ) ) {
			wp_enqueue_style( 'slick-css' );
			wp_enqueue_style( 'slick-theme-css' );
			wp_enqueue_script( 'slick-js' );
			$deps[] = 'slick-js';
		}

		$rel = '/js/pegasus-custom.js';
		wp_enqueue_script( 'pegasus_child_custom_js', get_stylesheet_directory_uri() . $rel, $deps, filemtime( get_stylesheet_directory() . $rel ), true );

	} //end function
	add_action( 'wp_enqueue_scripts', 'pegasus_child_bootstrap_js', 20 );

	/**
	 * Insurance Guy Joe helpers: site data, responsive images, SEO + schema, setup.
	 */
	require_once get_stylesheet_directory() . '/inc/igj-data.php';
	require_once get_stylesheet_directory() . '/inc/igj-seo.php';
	require_once get_stylesheet_directory() . '/inc/igj-setup.php';

	/**
	 * The parent enqueues this child stylesheet ('pegasus') before Bootstrap
	 * ('bootstrap-style') and plugin CSS, so Bootstrap would win. Load ours last.
	 */
	function igj_child_style_last() {
		global $wp_styles;
		if ( ! isset( $wp_styles->registered['pegasus'] ) ) {
			return;
		}
		$after = array( 'bootstrap-style', 'pegasus_font_awesome', 'slick-css', 'slick-theme-css', 'slippery-css', 'slippery-slider-css', 'animate-css' );
		foreach ( $after as $handle ) {
			if ( wp_style_is( $handle, 'enqueued' ) && ! in_array( $handle, $wp_styles->registered['pegasus']->deps, true ) ) {
				$wp_styles->registered['pegasus']->deps[] = $handle;
			}
		}
	}
	add_action( 'wp_enqueue_scripts', 'igj_child_style_last', 100 );
