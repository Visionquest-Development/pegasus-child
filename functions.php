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

	}
	add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

	/**
	* Proper way to enqueue JS
	*/
	function pegasus_child_bootstrap_js() {

		wp_enqueue_script( 'pegasus_child_custom_js', get_stylesheet_directory_uri() . '/js/pegasus-custom.js', array(), '', true );

		//wp_enqueue_script( 'matchHeight_js', get_stylesheet_directory_uri() . '/js/jquery.matchHeight-min.js', array(), '', true );

		// Enqueue fitvids.js from CDN
		wp_enqueue_script('fitvids', 'https://cdnjs.cloudflare.com/ajax/libs/fitvids/1.1.0/jquery.fitvids.min.js', array('jquery'), '1.1.0', true);



	} //end function
	add_action( 'wp_enqueue_scripts', 'pegasus_child_bootstrap_js' );



	add_action( 'wp_enqueue_scripts', 'sk_enqueue_scripts' );
	function sk_enqueue_scripts() {

		wp_enqueue_style( 'animate', get_stylesheet_directory_uri() . '/css/animate.min.css' );

		wp_enqueue_script( 'wow', get_stylesheet_directory_uri() . '/js/wow.js', array(), '', true );

	}

	//* Enqueue script to activate WOW.js
	add_action('wp_enqueue_scripts', 'sk_wow_init_in_footer');
	function sk_wow_init_in_footer() {
		add_action( 'print_footer_scripts', 'wow_init' );
	}


	//* Add JavaScript before </body>
	function wow_init() { ?>
		<script type="text/javascript">
			//new WOW().init();
			var wow = new WOW(
				{
					boxClass:     'wow',      // animated element css class (default is wow)
					animateClass: 'animated', // animation css class (default is animated)
					offset:       0,          // distance to the element when triggering the animation (default is 0)
					mobile:       true,       // trigger animations on mobile devices (default is true)
					live:         true,       // act on asynchronously loaded content (default is true)
					callback:     function(box) {
					  // the callback is fired every time an animation is started
					  // the argument that is passed in is the DOM node being animated
					},
					scrollContainer: null,    // optional scroll container selector, otherwise use window,
					resetAnimation: true,     // reset animation on end (default is true)
				}
			);
			wow.init();
		</script>
	<?php }
	
	
	add_action('cmb2_admin_init', 'cmb2_homepage_metabox');

	function cmb2_homepage_metabox() {
		// Limit the metabox to the homepage only
		$homepage_id = get_option('page_on_front'); // Get the ID of the homepage

		$prefix = 'homepage_sections_';

		$cmb = new_cmb2_box(array(
			'id'            => $prefix . 'metabox',
			'title'         => __('Homepage Sections', 'cmb2'),
			'object_types'  => array('page'), // Post type
			'show_on'       => array('key' => 'id', 'value' => array($homepage_id)), // Only show on the homepage
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true, // Show field names on the left
		));

		$group_field_id = $cmb->add_field(array(
			'id'          => $prefix . 'repeatable_group',
			'type'        => 'group',
			'description' => __('Add multiple sections for the homepage', 'cmb2'),
			'options'     => array(
				'group_title'       => __('Section {#}', 'cmb2'),
				'add_button'        => __('Add Another Section', 'cmb2'),
				'remove_button'     => __('Remove Section', 'cmb2'),
				'sortable'          => true, // Allow reordering
			),
		));

		// Background image field
		$cmb->add_group_field($group_field_id, array(
			'name' => __('Background Image', 'cmb2'),
			'id'   => 'background_image',
			'type' => 'file',
			'options' => array(
				'url' => false, // Hide the text input for the file URL
			),
			'text' => array(
				'add_upload_file_text' => __('Add Background Image', 'cmb2'), // Change upload button text
			),
		));

		// Title field
		$cmb->add_group_field($group_field_id, array(
			'name' => __('Title', 'cmb2'),
			'id'   => 'title',
			'type' => 'text',
		));

		// Subtitle field
		$cmb->add_group_field($group_field_id, array(
			'name' => __('Subtitle', 'cmb2'),
			'id'   => 'subtitle',
			'type' => 'text',
		));

		// Paragraph field
		$cmb->add_group_field($group_field_id, array(
			'name' => __('Paragraph', 'cmb2'),
			'id'   => 'paragraph',
			'type' => 'textarea_small',
		));

		// Button 1 Text
		$cmb->add_group_field($group_field_id, array(
			'name' => __('Button 1 Text', 'cmb2'),
			'id'   => 'button1_text',
			'type' => 'text',
		));

		// Button 1 Link
		$cmb->add_group_field($group_field_id, array(
			'name' => __('Button 1 Link', 'cmb2'),
			'id'   => 'button1_link',
			'type' => 'text_url',
		));
		/*
		// Button 2 Text
		$cmb->add_group_field($group_field_id, array(
			'name' => __('Button 2 Text', 'cmb2'),
			'id'   => 'button2_text',
			'type' => 'text',
		));

		// Button 2 Link
		$cmb->add_group_field($group_field_id, array(
			'name' => __('Button 2 Link', 'cmb2'),
			'id'   => 'button2_link',
			'type' => 'text_url',
		));
		*/
	}
	
	
	
	
	
