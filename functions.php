<?php

	/**
	 * Pegasus Child — Mr Nice Guy Authentic Soul Food (branch: mrniceguy_theme)
	 *
	 * Plugin requirements (TGMPA) & Bootstrap CMB2
	 */
	//require_once get_template_directory_uri() . 'inc/class-tgm-plugin-activation.php';

	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	~~~~PROPER WAY OF ADDING CHILD THEME CSS FILE ~~~~
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/

	function theme_enqueue_styles() {
		wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

		/* Display (Anton), brush script (Kaushan Script) and body (Inter) fonts. */
		wp_enqueue_style( 'mng-fonts', 'https://fonts.googleapis.com/css2?family=Anton&family=Kaushan+Script&family=Inter:wght@400;500;600;700&display=swap', array(), null );
	}
	add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

	/** Preconnect to Google Fonts. */
	function mng_resource_hints( $urls, $relation_type ) {
		if ( 'preconnect' === $relation_type ) {
			$urls[] = array( 'href' => 'https://fonts.googleapis.com' );
			$urls[] = array( 'href' => 'https://fonts.gstatic.com', 'crossorigin' );
		}
		return $urls;
	}
	add_filter( 'wp_resource_hints', 'mng_resource_hints', 10, 2 );

	/**
	* Proper way to enqueue JS
	*/
	function pegasus_child_bootstrap_js() {

		/*
		 * pegasus-carousel registers slick; it's only enqueued on templates that use it,
		 * and only if the plugin is active (otherwise the strip is a CSS scroll-snap row).
		 */
		if ( is_page_template( array( 'tpl_mng_home.php', 'tpl_mng_catering.php' ) ) && wp_style_is( 'slick-css', 'registered' ) ) {
			wp_enqueue_style( 'slick-css' );
			wp_enqueue_style( 'slick-theme-css' );
			wp_enqueue_script( 'slick-js' );
		}

		$rel = '/js/pegasus-custom.js';
		wp_enqueue_script( 'pegasus_child_custom_js', get_stylesheet_directory_uri() . $rel, array( 'jquery' ), filemtime( get_stylesheet_directory() . $rel ), true );

	} //end function
	add_action( 'wp_enqueue_scripts', 'pegasus_child_bootstrap_js', 20 );

	/**
	 * Mr Nice Guy helpers: site data, images, SEO + schema, Pegasus defaults.
	 */
	require_once get_stylesheet_directory() . '/inc/mng-data.php';
	require_once get_stylesheet_directory() . '/inc/mng-seo.php';
	require_once get_stylesheet_directory() . '/inc/mng-setup.php';

	/**
	 * The parent enqueues this child stylesheet ('pegasus') before Bootstrap and the
	 * carousel / animate.css styles, so their rules would win over ours. Load it last.
	 */
	function mng_child_style_last() {
		global $wp_styles;
		if ( ! isset( $wp_styles->registered['pegasus'] ) ) {
			return;
		}
		$after = array( 'bootstrap-style', 'pegasus_font_awesome', 'slick-css', 'slick-theme-css', 'animate-css' );
		foreach ( $after as $handle ) {
			if ( wp_style_is( $handle, 'enqueued' ) && ! in_array( $handle, $wp_styles->registered['pegasus']->deps, true ) ) {
				$wp_styles->registered['pegasus']->deps[] = $handle;
			}
		}
	}
	add_action( 'wp_enqueue_scripts', 'mng_child_style_last', 100 );
