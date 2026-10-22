<?php

	/**
	 * Pegasus Child — Ru San's Kennesaw (branch: rusans_theme)
	 *
	 * Plugin requirements (TGMPA) & Bootstrap CMB2
	 */
	//require_once get_template_directory_uri() . 'inc/class-tgm-plugin-activation.php';

	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	~~~~PROPER WAY OF ADDING CHILD THEME CSS FILE ~~~~
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/

	function theme_enqueue_styles() {
		wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

		/* Ru San's display + body fonts (Josefin Slab matches the printed menu). */
		wp_enqueue_style( 'rusans-fonts', 'https://fonts.googleapis.com/css2?family=Josefin+Slab:wght@600;700&family=Inter:wght@400;500;600&display=swap', array(), null );
	}
	add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

	/**
	 * Preconnect to Google Fonts so the font CSS isn't a slow render-blocking hop.
	 */
	function rusans_resource_hints( $urls, $relation_type ) {
		if ( 'preconnect' === $relation_type ) {
			$urls[] = array( 'href' => 'https://fonts.googleapis.com' );
			$urls[] = array( 'href' => 'https://fonts.gstatic.com', 'crossorigin' );
		}
		return $urls;
	}
	add_filter( 'wp_resource_hints', 'rusans_resource_hints', 10, 2 );

	/**
	* Proper way to enqueue JS
	*/
	function pegasus_child_bootstrap_js() {

		/*
		 * pegasus-carousel registers slick + match-height; pegasus-slider registers slippry.
		 * They're only enqueued on templates that use them, and only if the plugins are active.
		 */
		if ( is_page_template( array( 'tpl_home.php', 'tpl_gallery.php', 'tpl_catering.php' ) ) ) {
			if ( wp_style_is( 'slick-css', 'registered' ) ) {
				wp_enqueue_style( 'slick-css' );
				wp_enqueue_style( 'slick-theme-css' );
				wp_enqueue_script( 'slick-js' );
			}
		}
		if ( is_page_template( 'tpl_home.php' ) && wp_style_is( 'slippery-css', 'registered' ) ) {
			wp_enqueue_style( 'slippery-css' );
			wp_enqueue_style( 'slippery-slider-css' );
			wp_enqueue_script( 'slippery-js' );
		}

		$rel = '/js/pegasus-custom.js';
		wp_enqueue_script( 'pegasus_child_custom_js', get_stylesheet_directory_uri() . $rel, array( 'jquery' ), filemtime( get_stylesheet_directory() . $rel ), true );

	} //end function
	add_action( 'wp_enqueue_scripts', 'pegasus_child_bootstrap_js', 20 );

	/**
	 * Ru San's helpers: site data (NAP/hours/links), responsive images, SEO + schema.
	 */
	require_once get_stylesheet_directory() . '/inc/rusans-data.php';
	require_once get_stylesheet_directory() . '/inc/rusans-seo.php';

	/**
	 * Default the Pegasus header logo to the Ru San's logo until one is chosen in
	 * Pegasus Options. With no logo, the parent header prints the site name as an
	 * <h1>, which would give every page a second H1.
	 */
	function rusans_default_pegasus_logo( $opts ) {
		if ( ! is_array( $opts ) ) {
			$opts = array();
		}
		if ( empty( $opts['logo'] ) ) {
			$opts['logo'] = get_stylesheet_directory_uri() . '/images/rusans-logo.png';
		}
		return $opts;
	}
	add_filter( 'option_pegasus_options', 'rusans_default_pegasus_logo' );
	add_filter( 'default_option_pegasus_options', 'rusans_default_pegasus_logo' );


	/**
	 * The parent enqueues this child stylesheet ('pegasus') before Bootstrap
	 * ('bootstrap-style') and the slider/carousel CSS, so Bootstrap's .btn and
	 * heading rules would win over ours. Make the child stylesheet load last.
	 */
	function rusans_child_style_last() {
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
	add_action( 'wp_enqueue_scripts', 'rusans_child_style_last', 100 );
