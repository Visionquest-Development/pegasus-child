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

		wp_enqueue_style(
			'sugarpeddler-fonts',
			'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500;1,600&family=Outfit:wght@300;400;500;600;700&family=Caveat:wght@400;500;600&display=swap',
			array(),
			null
		);

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


	/**
	 * CMB2 — Home Page template fields.
	 * Registration + read helpers live in their own file. Every metabox is
	 * scoped to the "Home Page" template (tpl_home.php) only.
	 */
	require_once get_stylesheet_directory() . '/inc/cmb2-home-fields.php';

	/**
	 * Format a price value with leading $.
	 * Whole-dollar values render without decimals; otherwise two-decimal.
	 */
	if ( ! function_exists( 'vqmenu_money' ) ) {
		function vqmenu_money( $value ) {
			if ( ! is_numeric( $value ) ) {
				return $value;
			}
			$f = (float) $value;
			$num = ( fmod( $f, 1.0 ) === 0.0 )
				? number_format( $f, 0, '.', '' )
				: number_format( $f, 2, '.', '' );
			return '$' . $num;
		}
	}

	/**
	 * Map a menu badge label (V, GF, GF*) to its CSS class.
	 */
	if ( ! function_exists( 'vqmenu_badge_class' ) ) {
		function vqmenu_badge_class( $label ) {
			$label = strtoupper( trim( (string) $label ) );
			return match ( $label ) {
				'V'         => 'sp-menu-badge sp-menu-badge--veg',
				'GF', 'GF*' => 'sp-menu-badge sp-menu-badge--gf',
				default     => 'sp-menu-badge',
			};
		}
	}
