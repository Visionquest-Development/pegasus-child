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

		/* qTip CSS */
		//wp_enqueue_style('twentytwenty-css', get_stylesheet_directory_uri() . '/css/twentytwenty.css', null, false, false);

		wp_enqueue_style('prism-css', 'https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism.min.css', null, false, false );

	}
	add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

	/**
	* Proper way to enqueue JS
	*/
	function pegasus_child_bootstrap_js() {

		wp_enqueue_script( 'pegasus_child_custom_js', get_stylesheet_directory_uri() . '/js/pegasus-custom.js', array(), '', true );

		wp_enqueue_script('prism-js', 'https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js', ['jquery'], null, true);

		//wp_enqueue_script( 'matchHeight_js', get_stylesheet_directory_uri() . '/js/jquery.matchHeight-min.js', array(), '', true );

	} //end function
	add_action( 'wp_enqueue_scripts', 'pegasus_child_bootstrap_js' );


	function custom_code_shortcode($atts, $content = null) {
		// Extract shortcode attributes with a default language of "plaintext"
		$atts = shortcode_atts(
			array(
				'lang' => 'javascript', // Default language class
			),
			$atts,
			'code'
		);

		// Sanitize the content to prevent XSS attacks
		//$content = esc_html($content);

		// Wrap the content in a <code> block with the specified language class
		return '<pre><code class="language-' . esc_attr($atts['lang']) . '">' . $content . '</code></pre>';
	}
	add_shortcode('code', 'custom_code_shortcode');
