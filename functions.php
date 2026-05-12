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

                // Modern Fonts
                wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;800&family=Playfair+Display:wght@700&display=swap', array(), null );

                // Enqueue child style to load AFTER the parent's compiled bootstrap CSS
                wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style', 'bootstrap-style'), wp_get_theme()->get('Version') );
        }
        // Use priority 20 to ensure this runs after the parent theme's enqueue script
        add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles', 20 );

        /**
        * Proper way to enqueue JS
        */
        function pegasus_child_bootstrap_js() {
                wp_enqueue_script( 'pegasus_child_custom_js', get_stylesheet_directory_uri() . '/js/pegasus-custom.js', array(), '', true );
        } //end function
        add_action( 'wp_enqueue_scripts', 'pegasus_child_bootstrap_js' );

