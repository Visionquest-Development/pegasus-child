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
		wp_enqueue_style('lightbox-css', get_stylesheet_directory_uri() . '/css/lightbox.min.css', null, false, false);
		
		wp_enqueue_style( 'animate', get_stylesheet_directory_uri() . '/css/animate.min.css' );


	}
	add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

	/**
	* Proper way to enqueue JS
	*/
	function pegasus_child_bootstrap_js() {

		wp_enqueue_script( 'pegasus_child_custom_js', get_stylesheet_directory_uri() . '/js/pegasus-custom.js', array(), '', true );

		//wp_enqueue_script( 'matchHeight_js', get_stylesheet_directory_uri() . '/js/jquery.matchHeight-min.js', array(), '', true );

		// Enqueue fitvids.js from CDN
		wp_enqueue_script('fitvids', 'https://cdnjs.cloudflare.com/ajax/libs/fitvids/1.2.0/jquery.fitvids.min.js', array('jquery'), '1.1.0', true);

		wp_enqueue_script( 'parallax_js', get_template_directory_uri() . '/js/parallax.js', array(), '', true );
		
		wp_enqueue_script( 'lightbox_js', get_stylesheet_directory_uri() . '/js/lightbox.min.js', array(), '', true );

		//wp_enqueue_script( 'masonry_js', get_template_directory_uri() . '/js/parallax.js', array(), '', true );
		
		wp_enqueue_script( 'wow', get_stylesheet_directory_uri() . '/js/wow.js', array(), '', true );


	} //end function
	add_action( 'wp_enqueue_scripts', 'pegasus_child_bootstrap_js' );


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
			'type' => 'wysiwyg',
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
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/* CUSTOM EVENT PAGE TEMPLATE */
	
	
	
	
	add_action('init', 'register_qbiq_events_post_type');

	function register_qbiq_events_post_type() {
		// Define labels for the QBIQ Events post type
		$qbiq_events_labels = array(
			'name' => _x('QBIQ Events', 'General name', 'text-domain'),
			'singular_name' => _x('Event', 'Singular name', 'text-domain'),
			'add_new' => _x('Add New', 'Event', 'text-domain'),
			'add_new_item' => __('Add New Event', 'text-domain'),
			'edit_item' => __('Edit Event', 'text-domain'),
			'new_item' => __('New Event', 'text-domain'),
			'view_item' => __('View Event', 'text-domain'),
			'search_items' => __('Search Events', 'text-domain'),
			'not_found' =>  __('No events found', 'text-domain'),
			'not_found_in_trash' => __('No events found in Trash', 'text-domain'),
			'parent_item_colon' => '',
			'menu_name' => 'QBIQ Events'
		);

		// Set up the arguments for the post type
		$qbiq_events_args = array(
			'labels' => $qbiq_events_labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'query_var' => true,
			'rewrite' => array('slug' => 'qbiq-events'),
			'capability_type' => 'post',
			'has_archive' => true,  // Set to true to allow archive page
			'hierarchical' => false,  // Events are typically not hierarchical
			'menu_position' => 5,  // Position in the admin menu (5 - below Posts)
			'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'comments', 'custom-fields')
		);

		// Register the post type
		register_post_type('qbiq_events', $qbiq_events_args);
		
		
		$qbiq_coaches_labels = array(
			'name' => _x('QBIQ Coaches', 'General name', 'text-domain'),
			'singular_name' => _x('Coaches', 'Singular name', 'text-domain'),
			'add_new' => _x('Add New', 'Coaches', 'text-domain'),
			'add_new_item' => __('Add New Coaches', 'text-domain'),
			'edit_item' => __('Edit Coaches', 'text-domain'),
			'new_item' => __('New Coaches', 'text-domain'),
			'view_item' => __('View Coaches', 'text-domain'),
			'search_items' => __('Search Coaches', 'text-domain'),
			'not_found' =>  __('No coaches found', 'text-domain'),
			'not_found_in_trash' => __('No coaches found in Trash', 'text-domain'),
			'parent_item_colon' => '',
			'menu_name' => 'QBIQ Coaches'
		);

		// Set up the arguments for the post type
		$qbiq_coaches_args = array(
			'labels' => $qbiq_coaches_labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'query_var' => true,
			'rewrite' => array('slug' => 'qbiq-coaches'),
			'capability_type' => 'post',
			'has_archive' => true,  // Set to true to allow archive page
			'hierarchical' => false,  // Events are typically not hierarchical
			'menu_position' => 5,  // Position in the admin menu (5 - below Posts)
			'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'comments', 'custom-fields')
		);

		// Register the post type
		register_post_type('qbiq_coaches', $qbiq_coaches_args);
	}
		
	
	

	add_action('cmb2_admin_init', 'register_custom_section_fields');
	function register_custom_section_fields() {
		$prefix = 'camp_page_section_';

		$cmb = new_cmb2_box(array(
			'id'           => $prefix . 'metabox',
			'title'        => __('Camp Page Section', 'cmb2'),
			//'object_types' => array('page'), // Only show on pages
			//'show_on'      => array(
				//'key'   => 'page-template',
				//'value' => 'tpl_campPage.php', // Restrict to specific template
			//),
			'object_types' => array('qbiq_events'),
		));
		
		/*$cmb->add_field(array(
			'name' => 'Color',
			'id'   => $prefix . 'page_color',
			'type'    => 'colorpicker',
			//'default' => '#ffffff',
			'options' => array(
			    'alpha' => true,
			),
		));*/

		$cmb->add_field(array(
			'name' => __('Event Title', 'cmb2'),
			'id'   => $prefix . 'event_title',
			'type' => 'text',
		));

		$cmb->add_field(array(
			'name' => __('Event Start Date', 'cmb2'),
			'id'   => $prefix . 'event_date',
			'type' => 'text_date',
			'date_format' => 'Y-m-d',
			
		));
		
		$cmb->add_field(array(
			'name' => __('Event End Date', 'cmb2'),
			'id'   => $prefix . 'event_end_date',
			'type' => 'text_date',
		));

		$cmb->add_field(array(
			'name' => __('Event Description', 'cmb2'),
			'id'   => $prefix . 'event_description',
			'type' => 'textarea',
		));

		$cmb->add_field(array(
			'name' => __('Button Text', 'cmb2'),
			'id'   => $prefix . 'button_text',
			'type' => 'text',
		));

		$cmb->add_field(array(
			'name' => __('Button Link', 'cmb2'),
			'id'   => $prefix . 'button_link',
			'type' => 'text_url',
		));

		$cmb->add_field(array(
			'name' => __('Background Image', 'cmb2'),
			'id'   => $prefix . 'background_image',
			'type' => 'file',
		));

		$cmb->add_field(array(
			'name' => __('Video Link', 'cmb2'),
			'id'   => $prefix . 'video_link',
			'type' => 'text_url',
		));
	}
	
	add_action('cmb2_admin_init', 'register_cmb2_repeatable_image_group');
	function register_cmb2_repeatable_image_group() {
		$prefix = 'camp_gallery_section_'; // Change this prefix as needed
 
		$cmb = new_cmb2_box(array(
			'id'           => $prefix . 'metabox',
			'title'        => __('QBIQ EVENT GALLERY', 'cmb2'),
			//'object_types' => array('page'), // Change to your desired post type
			//'show_on'      => array(
				//'key'   => 'page-template',
				//'value' => 'tpl_campPage.php', // Restrict to specific template
			//),
			'object_types' => array('qbiq_events'),
		));
		
		$cmb->add_field(array(
			'name' => 'Title',
			'id'   => $prefix . 'title',
			'type' => 'text',
		));
		
		$cmb->add_field(array(
			'name' => 'Description',
			'id'   => $prefix . 'description',
			'type' => 'textarea',
		));		

		$group_field_id = $cmb->add_field(array(
			'id'          => $prefix . 'image_group',
			'type'        => 'group',
			'description' => __('Add images for the gallery', 'cmb2'),
			'options'     => array(
				'group_title'       => __('Entry {#}', 'cmb2'), // {#} gets replaced by row number
				'add_button'        => __('Add Another Image', 'cmb2'),
				'remove_button'     => __('Remove Image', 'cmb2'),
				'sortable'          => true,
				'closed'            => true, // true to have the groups closed by default
			),
		));

		// Add image upload fields to the group
		$cmb->add_group_field($group_field_id, array(
			'name' => 'Image',
			'id'   => 'image',
			'type' => 'file',
			'options' => array(
				//'url' => false, // Hide the text input for the url
			),
			'query_args' => array(
				'type' => array('image/gif', 'image/jpeg', 'image/png'),
			),
			'preview_size' => 'medium', // Image size to use when previewing in the admin.
		));
		
		$cmb->add_group_field($group_field_id, array(
			'name' => 'Caption',
			'id'   => 'caption',
			'type' => 'text',
			
		));
		
		$cmb->add_group_field($group_field_id, array(
			'name' => 'Width',
			'id'   => 'width',
			'type' => 'text',
			
		));
	}


	add_action('cmb2_admin_init', 'camp_page_metabox');
	function camp_page_metabox() {
		$prefix = 'camp_accomdation_';

		$cmb = new_cmb2_box(array(
			'id'           => $prefix . 'metabox',
			'title'        => __('Camp Accomdation Section', 'cmb2'),
			//'object_types' => array('page'),
			//'show_on'      => array(
				//'key'   => 'page-template',
				//'value' => 'tpl_campPage.php',
			//),
			'object_types' => array('qbiq_events'),
		));

		$cmb->add_field(array(
			'name' => __('Hotel Name', 'cmb2'),
			'id'   => $prefix . 'hotel_name',
			'type' => 'text',
		));

		$cmb->add_field(array(
			'name' => __('Hotel Description', 'cmb2'),
			'id'   => $prefix . 'hotel_description',
			'type' => 'textarea',
		));

		$cmb->add_field(array(
			'name' => __('Hotel Image', 'cmb2'),
			'id'   => $prefix . 'hotel_image',
			'type' => 'file',
		));

		$cmb->add_field(array(
			'name' => __('Hotel Booking Link', 'cmb2'),
			'id'   => $prefix . 'hotel_link',
			'type' => 'text_url',
		));

		$cmb->add_field(array(
			'name' => __('Facility Name', 'cmb2'),
			'id'   => $prefix . 'facility_name',
			'type' => 'text',
		));

		$cmb->add_field(array(
			'name' => __('Facility Address', 'cmb2'),
			'id'   => $prefix . 'facility_address',
			'type' => 'textarea',
		));

		$cmb->add_field(array(
			'name' => __('Facility Image', 'cmb2'),
			'id'   => $prefix . 'facility_image',
			'type' => 'file',
		));

		$cmb->add_field(array(
			'name' => __('Facility Directions Link', 'cmb2'),
			'id'   => $prefix . 'facility_directions_link',
			'type' => 'text_url',
		));
	}

	add_action('cmb2_admin_init', 'register_itinerary_fields');
	function register_itinerary_fields() {
		$prefix = 'itinerary_';

		$cmb = new_cmb2_box(array(
			'id'           => $prefix . 'metabox',
			'title'        => __('Itinerary Details', 'cmb2'),
			//'object_types' => array('page'), // Display on pages
			//'show_on'      => array(
				//'key'   => 'page-template',
				//'value' => 'tpl_campPage.php', // Restrict to specific template
			//),
			'object_types' => array('qbiq_events'),
		));
		

		$days_group_id = $cmb->add_field(array(
			'id'          => $prefix . 'days',
			'type'        => 'group',
			'description' => __('Add itinerary days', 'cmb2'),
			'options'     => array(
				'group_title'   => __('Day {#}', 'cmb2'), // Title for each day
				'add_button'    => __('Add Another Day', 'cmb2'),
				'remove_button' => __('Remove Day', 'cmb2'),
				'sortable'      => true,
			),
		));

		// Day Title
		$cmb->add_group_field($days_group_id, array(
			'name' => __('Day Title', 'cmb2'),
			'id'   => 'day_title',
			'type' => 'text',
			'description' => __('Example: "Friday"', 'cmb2'),
		));

		// Day Date
		$cmb->add_group_field($days_group_id, array(
			'name' => __('Day Date', 'cmb2'),
			'id'   => 'day_date',
			'type' => 'text_date',
			'date_format' => 'Y-m-d',
			'description' => __('Example: "2025-01-10"', 'cmb2'),
		));
		
		
		
		$cmb->add_group_field($days_group_id, array(
			'name' => __('Schedule', 'cmb2'),
			'id'   => 'schedule',
			'type' => 'textarea_code',
			'repeatable' => true, // Allow multiple schedules per day
		));
		
		
		/*
		$group_field_id = $cmb->add_field( array(
			'id'          => 'wiki_test_repeat_group',
			'type'        => 'group',
			'description' => __( 'Generates reusable form entries', 'cmb2' ),
			// 'repeatable'  => false, // use false if you want non-repeatable group
			'options'     => array(
				'group_title'       => __( 'Entry {#}', 'cmb2' ), // since version 1.1.4, {#} gets replaced by row number
				'add_button'        => __( 'Add Another Entry', 'cmb2' ),
				'remove_button'     => __( 'Remove Entry', 'cmb2' ),
				'sortable'          => true,
				// 'closed'         => true, // true to have the groups closed by default
				// 'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'cmb2' ), // Performs confirmation before removing group.
			),
		) );

		// Id's for group's fields only need to be unique for the group. Prefix is not needed.
		$cmb->add_group_field( $group_field_id, array(
			'name' => 'Entry Title',
			'id'   => 'title',
			'type' => 'text',
			// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
		) );
		*/
	}
	
	add_action('cmb2_admin_init', 'register_cmb2_fields_for_camp');
	function register_cmb2_fields_for_camp() {
		$prefix = 'camp_tickets_'; // Prefix for all fields

		$cmb = new_cmb2_box(array(
			'id'            => $prefix . 'metabox',
			'title'         => __('Camp Page Details', 'cmb2'),
			//'object_types' => array('page'), // Display on pages
			//'show_on'      => array(
				//'key'   => 'page-template',
				//'value' => 'tpl_campPage.php', // Restrict to specific template
			//),
			'object_types' => array('qbiq_events'),
		));

		// Add all necessary fields
		$cmb->add_field(array(
			'name'    => 'Background Image',
			'id'      => $prefix . 'header_image',
			'type'    => 'file',
			
			'text'    => array(
				'add_upload_file_text' => 'Add Image' // Change upload button text. Default: "Add or Upload File"
			),
		));
		
		$cmb->add_field(array(
			'name'    => 'Ticket Image',
			'id'      => $prefix . 'ticket_image',
			'type'    => 'file',
			
			'text'    => array(
				'add_upload_file_text' => 'Add Image' // Change upload button text. Default: "Add or Upload File"
			),
		));

		/*$cmb->add_field(array(
			'name' => 'Event Date',
			'id'   => $prefix . 'event_date',
			'type' => 'text_date',
		));*/

		$cmb->add_field(array(
			'name' => 'Available Spots',
			'id'   => $prefix . 'available_spots',
			'type' => 'text_small',
		));
		
		$cmb->add_field(array(
			'name' => 'Event Title',
			'id'   => $prefix . 'event_title',
			'type' => 'textarea_small',
		));

		$cmb->add_field(array(
			'name' => 'Event Description',
			'id'   => $prefix . 'event_description',
			'type' => 'textarea_code',
		));

		// Add more fields as necessary...
	}
	
	
	
	
	
	
	
	
	add_action('cmb2_admin_init', 'register_coaches_fields');
	function register_coaches_fields() {
		$prefix = 'camp_coaches_';

		$cmb = new_cmb2_box(array(
			'id'           => $prefix . 'metabox',
			'title'        => __('Camp Coach Bio', 'cmb2'),
			//'object_types' => array('page'), // Only show on pages
			//'show_on'      => array(
				//'key'   => 'page-template',
				//'value' => 'tpl_campPage.php', // Restrict to specific template
			//),
			'object_types' => array('qbiq_coaches'),
		));

		$cmb = new_cmb2_box(array(
			'id'            => $prefix . 'metabox',
			'title'         => __('Coach Biography', 'cmb2'),
			//'object_types' => array('page'), // Display on pages
			//'show_on'      => array(
				//'key'   => 'page-template',
				//'value' => 'tpl_campPage.php', // Restrict to specific template
			//),
			'object_types' => array('qbiq_events'),
		));

		// Add all necessary fields
		$cmb->add_field(array(
			'name'    => 'Bio Image URL',
			'id'      => $prefix . 'bio_image',
			'type'    => 'file',
			
			'text'    => array(
				'add_upload_file_text' => 'Add Image' // Change upload button text. Default: "Add or Upload File"
			),
		));

		
		
		$cmb->add_field(array(
			'name' => 'Coach Title',
			'id'   => $prefix . 'title',
			'type' => 'textarea_small',
		));

		$cmb->add_field(array(
			'name' => 'Coach Description',
			'id'   => $prefix . 'description',
			'type' => 'wysiwyg',
		));
		
		$cmb->add_field(array(
			'name' => 'Coach Video',
			'id'   => $prefix . 'video',
			'type' => 'text_url',
		));
	}
	
	
	
	
	
	function parse_date_string($dateString) {
		// Check if the string contains a date range
		if (strpos($dateString, '-') !== false) {
			$dates = explode('-', $dateString);
			$startDate = new DateTime(trim($dates[0]));
			$endDate = new DateTime(trim($dates[1]));
			return array($startDate, $endDate);
		} else {
			// Handle single date
			$date = new DateTime($dateString);
			return array($date);
		}
	}
	
	function display_qbiq_events_shortcode() { 
		// Define the query arguments
		$args = array(
			'post_type'      => 'qbiq_events', // Ensure this matches your actual custom post type name
			'posts_per_page' => -1,            // Adjust this number based on your needs
			'post_status'    => 'publish',     // Only fetch published posts
			
			'orderby'        => 'meta_value',
			'meta_key'       => 'camp_page_section_event_date',
			'meta_type'      => 'DATE',
			'order'          => 'ASC',
			
			/*'order'          => 'ASC',
			'orderby'        => 'date'
			'orderby'        => 'meta_value',  // Changed from 'date' to 'meta_value'
			'meta_key'       => 'camp_page_section_event_date',  // Specifies which meta key to sort by
			'meta_type'      => 'DATE',
			'meta_query'     => array(
				'relation' => 'OR', // Use OR relation to combine conditions
				array(
					'key'     => 'camp_page_section_event_date',
					'compare' => 'EXISTS' // Selects posts that have a date set
				),
				array(
					'key'     => 'camp_page_section_event_date',
					'compare' => 'NOT EXISTS' // Selects posts that do not have a date set
				)
			) */
		);

		// Perform the query
		$query = new WP_Query($args);
		$output = '<section class="qbiq-camp-cards"><div id="app" class="container-fluid">';

		if ($query->have_posts()) {
			while ($query->have_posts()) {
				$query->the_post();
				$post_id = get_the_ID();
				

				// Retrieve custom fields/meta data. Customize these lines based on your actual field IDs.
				//$event_image = get_post_meta($post_id, 'event_image_url', true); // Assumes you have a custom field for the image
				$event_image = get_the_post_thumbnail_url($post_id, 'full') ? get_the_post_thumbnail_url($post_id, 'full') : 'https://images.unsplash.com/photo-1479660656269-197ebb83b540?dpr=2&auto=compress,format&fit=crop&w=1199&h=798&q=80&cs=tinysrgb&crop=';
				//$event_image = 'https://images.unsplash.com/photo-1479660656269-197ebb83b540?dpr=2&auto=compress,format&fit=crop&w=1199&h=798&q=80&cs=tinysrgb&crop=';
				
				$event_url = get_permalink($post_id);
				$event_location = get_the_title(); // Assuming the post title is used as the location
				$event_description = get_the_excerpt() ?? 'Read More' ; // Assuming you use the excerpt for the description
				
				$event_date = get_post_meta($post_id, 'camp_page_section_event_date', true);
				$event_date_end = get_post_meta($post_id, 'camp_page_section_event_end_date', true);
				
				
				//$output .= $event_date;
				//if ( null !== $event_date && '' !== $event_date ) {
					//$final_date = parse_date_string($event_date);
					//$final_end_date = parse_date_string($event_date_end);
					
					//$output .= $final_date[0]->format('M d Y');
					//echo '<pre>';
					//var_dump($event_date);
					//echo '</pre>';
					
					//if (count($final_date) > 1) {
						
						//date range
						//$output .= $final_date[0]->format('M d Y') . " - " . $final_end_date[1]->format('M d Y');
						
					//} else {
						//single day
						//$output .= $final_date[0]->format('M d Y') . "\n";
					//}
				//}
				
				if (!empty($event_date)) {
					$formatted_date = DateTime::createFromFormat('Y-m-d', $event_date)->format('M d, Y');
					//echo $formatted_date; // Outputs: May 05, 2025
				} else {
					$formatted_date = 'No event date provided.';
				}

				// If you want to handle the end date too:
				/*if (!empty($event_date_end)) {
					$formatted_end_date = DateTime::createFromFormat('Y-m-d', $event_date_end)->format('M d, Y');
					$formatted_date .= ' - ' . $formatted_end_date;
				}*/
				
				
				
				$output .= '<a href="' . $event_url . '" class="card-wrap" data-image="' . esc_url($event_image) . '">
								<div class="card">
									<div class="card-bg"></div>
									<div class="card-info">
										<h1>' . esc_html($event_location) . '</h1>
										<p>' . esc_html($formatted_date) . '</p>
									</div>
								</div>
							</a>';
			}
		} else {
			$output .= '<p>No events found.</p>';
		}

		$output .= '</div></section>';

		// Reset post data to avoid conflicts
		wp_reset_postdata();

		return $output;
	}

	add_shortcode('display_qbiq_events', 'display_qbiq_events_shortcode');
	
	


	
	function display_coaches_shortcode() {
		// Arguments for the query
		$args = array(
			'post_type'      => 'qbiq_coaches', // Make sure this is the correct post type
			'posts_per_page' => -1,             // Fetch all coaches
			'post_status'    => 'publish',      // Only fetch published posts
			'order'          => 'ASC',
			'order_by'       => 'title'
		);

		// The query
		$query = new WP_Query($args);
		$output = '';
		
		function qbiq_is_youtube_video($url) {
			// Parse the URL and extract components
			$parsed_url = parse_url($url);

			// Check if the host is a YouTube domain
			if (!isset($parsed_url['host'])) {
				return false;
			}

			$youtube_hosts = ['www.youtube.com', 'youtube.com', 'youtu.be'];
			if (in_array($parsed_url['host'], $youtube_hosts)) {
				// Further check if it's a valid YouTube watch URL or a shortened youtu.be URL
				if ($parsed_url['host'] == 'youtu.be') {
					// youtu.be URLs are always YouTube videos
					return true;
				} elseif (isset($parsed_url['path']) && $parsed_url['path'] === '/watch') {
					// Check for 'v' parameter in query string which signifies video ID on standard YouTube URLs
					parse_str($parsed_url['query'], $query_params);
					return isset($query_params['v']);
				} elseif (isset($parsed_url['path']) && strpos($parsed_url['path'], '/embed/') === 0) {
					// Check if it is an embed URL which contains '/embed/' followed by video ID
					return true;
				}
			}

			return false;
		}

		function qbiq_convert_youtube_url_to_embed($url) {
			$parsed_url = parse_url($url);
			
			 if (!isset($parsed_url['host'])) {
				// Return the original URL or handle the error as needed
				return $url; // Optionally, you could return false or an error message
			}
			if ($parsed_url['host'] === 'www.youtube.com' || $parsed_url['host'] === 'youtube.com') {
				parse_str($parsed_url['query'], $query_params);
				if (isset($query_params['v'])) {
					return 'https://www.youtube.com/embed/' . $query_params['v'];
				}
			} elseif ($parsed_url['host'] === 'youtu.be') {
				return 'https://www.youtube.com/embed' . $parsed_url['path'];
			}
			return $url; // Return the original URL if it's not a YouTube link
		}
		
		function slugifyCssName($name) {
			// Normalize the string to remove accents and special characters
			$normalized = iconv('UTF-8', 'ASCII//TRANSLIT', $name);

			// Convert to lowercase
			$lowercased = strtolower($normalized);

			// Replace spaces and unwanted characters with hyphens
			$slug = preg_replace('/[^a-z0-9-]+/', '-', $lowercased);

			// Remove duplicate hyphens
			$slug = preg_replace('/-+/', '-', $slug);

			// Trim hyphens from the beginning and end of the slug
			$slug = trim($slug, '-');

			return $slug;
		}

		if ($query->have_posts()) {
			while ($query->have_posts()) {
				
				$query->the_post();
				$post_id = get_the_ID();
				$post_title = get_the_title();
				
				
				

				// Fetch the meta values
				$bio_image = get_post_meta($post_id, 'camp_coaches_bio_image', true);
				$coach_title = get_post_meta($post_id, 'camp_coaches_title', true);
				$coach_description = get_post_meta($post_id, 'camp_coaches_description', true);
				
				$coach_video = get_post_meta($post_id, 'camp_coaches_video', true);
				
				
				$embed_url = qbiq_convert_youtube_url_to_embed($coach_video);
		

				// Build the output HTML
				$output .= '<section class="coaches-section ' . slugifyCssName( $post_title ) . '"><div class="container "><div class="row">';
				$output .= '
				<div class="col-md-12 col-lg-6">
					<div class="mt-5 mb-5 image-container " style="background-image: url(' . esc_url($bio_image) . ');">';
						if ( $bio_image ) { 
							$output .= '<div class="coach-image-container">';
							//$output .= '<img class="image-fluid" src="' . esc_url($bio_image) . '" alt="Bio Image">';
							
							
							
							$output .= '</div>';
							 
						} else {
							$output .= '<div class="coach-info-solo">';
							$output .= '<h1>' . $post_title . '</h1>';
							$output .= '<h2>' . esc_html($coach_title) . '</h2>';
							$output .= '<p>' . wp_kses_post($coach_description) . '</p>';
							$output .= '</div>';
						}
						
							$output .= '<div class="coach-info">';
							$output .= '<h1>' . $post_title . '</h1>';
							$output .= '<h2>' . esc_html($coach_title) . '</h2>';
							$output .= '<p>' . wp_kses_post($coach_description) . '</p>';
							$output .= '</div>';
						
						
						$output .= '</div>';
					$output .= '</div>';
				$output .= '<div class="col-md-12 col-lg-6">';
					$output .= '<div class="video-container mt-5 mb-5">';
						if ( !empty($embed_url) ) {
							if ( qbiq_is_youtube_video($embed_url)  ) {
								$output .= '<div class="youtube-container">';
								$output .= '<iframe src="' . esc_url($embed_url) . '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
								$output .= '</div>';
							} else {
								$output .= '<figure class="wp-block-video">';
									$output .= '<video class=" img-fluid lazyloading" controls>';
										$output .= '<source src="' . esc_url($coach_video) . '" type="video/mp4">';
										$output .= 'Your browser does not support the video tag.';
									$output .= '</video>';
								$output .= '</figure>';
								
							}
						}
					$output .= '</div>';
				$output .= '</div>';
				
				$output .= '</div></div></section>';
			}
		} else {
			$output .= '<p>No coaches found.</p>';
		}

		

		// Reset post data to avoid conflicts
		wp_reset_postdata();

		return $output;
	}

	// Register the shortcode
	add_shortcode('display_coaches', 'display_coaches_shortcode');
	
	/* =============================================================================================================*/

	/**
	 * Homepage promo popup — Black Friday defaults, editable via CMB2 on the front page.
	 */
	if ( ! function_exists( 'qbiq_promo_defaults' ) ) {
		function qbiq_promo_defaults() {
			return array(
				'heading'        => 'BLACK FRIDAY',
				'offer'          => '25% OFF ALL QBIQ PRODUCTS & QBIQ TRAINING CAMP',
				'products_label' => 'QBIQ PRODUCTS',
				'products_url'   => 'https://qbiqsystem.com',
				'camp_label'     => 'QBIQ TRAINING CAMP',
				'camp_url'       => 'https://qbiqcamp.com',
				'code_label'     => 'DISCOUNT CODE',
				'code'           => 'TOMBRADY',
				'modal_title'    => 'Special Offer',
			);
		}
	}

	if ( ! function_exists( 'qbiq_promo_get_field' ) ) {
		function qbiq_promo_get_field( $key ) {
			$defaults = qbiq_promo_defaults();
			$default  = isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';
			$front_id = (int) get_option( 'page_on_front' );
			if ( ! $front_id ) {
				return $default;
			}
			$val = get_post_meta( $front_id, 'qbiq_promo_' . $key, true );
			if ( '' === $val || false === $val ) {
				return $default;
			}
			return $val;
		}
	}

	if ( ! function_exists( 'qbiq_promo_is_hidden' ) ) {
		function qbiq_promo_is_hidden() {
			$front_id = (int) get_option( 'page_on_front' );
			if ( ! $front_id ) {
				return false;
			}
			return 'on' === get_post_meta( $front_id, 'qbiq_promo_hide', true );
		}
	}

	if ( ! function_exists( 'qbiq_promo_host_label' ) ) {
		function qbiq_promo_host_label( $url, $fallback ) {
			$host = function_exists( 'wp_parse_url' ) ? wp_parse_url( $url, PHP_URL_HOST ) : parse_url( $url, PHP_URL_HOST );
			if ( ! $host ) {
				return $fallback;
			}
			return strtoupper( $host );
		}
	}

	add_action( 'cmb2_admin_init', 'qbiq_register_promo_popup_metabox' );
	function qbiq_register_promo_popup_metabox() {
		$homepage_id = get_option( 'page_on_front' );
		if ( ! $homepage_id ) {
			return;
		}

		$defaults = qbiq_promo_defaults();

		$cmb = new_cmb2_box( array(
			'id'           => 'qbiq_promo_metabox',
			'title'        => __( 'Promo Popup (Homepage)', 'cmb2' ),
			'object_types' => array( 'page' ),
			'show_on'      => array( 'key' => 'id', 'value' => array( $homepage_id ) ),
			'context'      => 'normal',
			'priority'     => 'high',
			'show_names'   => true,
		) );

		$cmb->add_field( array(
			'name' => __( 'Hide this popup', 'cmb2' ),
			'desc' => __( 'Check to stop showing the homepage promo popup.', 'cmb2' ),
			'id'   => 'qbiq_promo_hide',
			'type' => 'checkbox',
		) );

		$cmb->add_field( array(
			'name'    => __( 'Modal title', 'cmb2' ),
			'id'      => 'qbiq_promo_modal_title',
			'type'    => 'text',
			'default' => $defaults['modal_title'],
		) );

		$cmb->add_field( array(
			'name'    => __( 'Heading', 'cmb2' ),
			'id'      => 'qbiq_promo_heading',
			'type'    => 'text',
			'default' => $defaults['heading'],
		) );

		$cmb->add_field( array(
			'name'    => __( 'Offer text', 'cmb2' ),
			'id'      => 'qbiq_promo_offer',
			'type'    => 'text',
			'default' => $defaults['offer'],
		) );

		$cmb->add_field( array(
			'name'    => __( 'Products label', 'cmb2' ),
			'id'      => 'qbiq_promo_products_label',
			'type'    => 'text',
			'default' => $defaults['products_label'],
		) );

		$cmb->add_field( array(
			'name'    => __( 'Products URL', 'cmb2' ),
			'id'      => 'qbiq_promo_products_url',
			'type'    => 'text_url',
			'default' => $defaults['products_url'],
		) );

		$cmb->add_field( array(
			'name'    => __( 'Training Camp label', 'cmb2' ),
			'id'      => 'qbiq_promo_camp_label',
			'type'    => 'text',
			'default' => $defaults['camp_label'],
		) );

		$cmb->add_field( array(
			'name'    => __( 'Training Camp URL', 'cmb2' ),
			'id'      => 'qbiq_promo_camp_url',
			'type'    => 'text_url',
			'default' => $defaults['camp_url'],
		) );

		$cmb->add_field( array(
			'name'    => __( 'Discount code label', 'cmb2' ),
			'id'      => 'qbiq_promo_code_label',
			'type'    => 'text',
			'default' => $defaults['code_label'],
		) );

		$cmb->add_field( array(
			'name'    => __( 'Discount code', 'cmb2' ),
			'id'      => 'qbiq_promo_code',
			'type'    => 'text',
			'default' => $defaults['code'],
			'desc'    => __( 'Copied to the clipboard by the Copy code button.', 'cmb2' ),
		) );
	}

	if ( ! function_exists( 'qbiq_render_black_friday_promo' ) ) {
		function qbiq_render_black_friday_promo() {
			$heading        = qbiq_promo_get_field( 'heading' );
			$offer          = qbiq_promo_get_field( 'offer' );
			$code           = qbiq_promo_get_field( 'code' );
			$products_label = qbiq_promo_get_field( 'products_label' );
			$products_url   = qbiq_promo_get_field( 'products_url' );
			$camp_label     = qbiq_promo_get_field( 'camp_label' );
			$camp_url       = qbiq_promo_get_field( 'camp_url' );
			$code_label     = qbiq_promo_get_field( 'code_label' );

			if ( '' === $heading && '' === $offer && '' === $code ) {
				return;
			}

			if ( $heading ) {
				echo '<div class="qbiq-title qbiq-gradient">' . esc_html( $heading ) . '</div>';
			}

			if ( $offer ) {
				echo '<div class="qbiq-callout">' . esc_html( $offer ) . '</div>';
			}

			echo '<div class="qbiq-links">';
			if ( $products_label && $products_url ) {
				echo '<div class="qbiq-callout">';
				echo esc_html( $products_label ) . ': ';
				echo '<a href="' . esc_url( $products_url ) . '">' . esc_html( qbiq_promo_host_label( $products_url, 'QBIQSYSTEM.COM' ) ) . '</a>';
				echo '</div>';
			}
			if ( $camp_label && $camp_url ) {
				echo '<div class="qbiq-callout">';
				echo esc_html( $camp_label ) . ': ';
				echo '<a href="' . esc_url( $camp_url ) . '">' . esc_html( qbiq_promo_host_label( $camp_url, 'QBIQCAMP.COM' ) ) . '</a>';
				echo '</div>';
			}
			echo '</div>';

			if ( $code ) {
				echo '<div class="qbiq-promo mt-2" role="status" aria-live="polite">';
				if ( $code_label ) {
					echo '<span class="text-1">' . esc_html( $code_label ) . ': </span>';
				}
				echo '<code class="code-block">' . esc_html( $code ) . '</code>';
				echo '</div>';
			}
		}
	}

	// Keep the previous function name as a wrapper in case anything else still calls it.
	if ( ! function_exists( 'vqdev_render_monthly_promo_from_hardcoded_json' ) ) {
		function vqdev_render_monthly_promo_from_hardcoded_json() {
			qbiq_render_black_friday_promo();
		}
	}

	// Output the modal in the footer only on the homepage, unless it is hidden in CMB2.
	add_action( 'wp_footer', function () {
		if ( ! is_front_page() ) {
			return;
		}
		if ( qbiq_promo_is_hidden() ) {
			return;
		}

		ob_start();
		qbiq_render_black_friday_promo();
		$promo_html = trim( ob_get_clean() );

		if ( '' === $promo_html ) {
			return;
		}

		$modal_title = qbiq_promo_get_field( 'modal_title' );
		$code        = qbiq_promo_get_field( 'code' );

		?>
		<!-- Home Promo Modal -->
		<div class="modal fade" id="homePromoModal" tabindex="-1" aria-labelledby="homePromoLabel" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content">

			  <div class="modal-header">
				<h2 class="modal-title fs-5" id="homePromoLabel"><?php echo esc_html( $modal_title ); ?></h2>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="<?php echo esc_attr__( 'Close', 'textdomain' ); ?>"></button>
			  </div>

			  <div class="modal-body">

				<!-- Existing popup background is left alone; flyer art will be handled later. -->

				<div class="qbiq-hero">
				  <?php get_template_part( 'templates/logo', 'header' ); ?>

				  <div class="">
					<?php qbiq_render_black_friday_promo(); ?>
				  </div>
				</div>

			  </div>

			  <div class="modal-footer">
				<?php if ( $code ) : ?>
				<button type="button" id="promoCopyBtn" class="btn btn-outline-secondary">Copy code</button>
				<?php endif; ?>
				<button type="button" class="btn btn-primary" data-bs-dismiss="modal">Got it</button>
				<button type="button" id="promoHide7dBtn" class="btn btn-link ms-auto" data-bs-dismiss="modal" style="text-decoration:none">
				  Don’t show for 7 days
				</button>
			  </div>
			</div>
		  </div>
		</div>

		<script>
		(function() {
		  const HIDE_KEY = 'qbiqBfPromoHiddenUntil';
		  const nowSec = Math.floor(Date.now() / 1000);
		  try {
			const until = JSON.parse(localStorage.getItem(HIDE_KEY));
			if (until && nowSec < Number(until)) {
			  return; // still within hide window
			}
		  } catch (e) {}

		  const modalEl = document.getElementById('homePromoModal');
		  if (!modalEl || typeof bootstrap === 'undefined' || !bootstrap.Modal) return;

		  const modal = new bootstrap.Modal(modalEl);

		  // Auto-show after a brief delay
		  window.setTimeout(function() {
			modal.show();
		  }, 800);

		  // Copy code button
		  const copyBtn = document.getElementById('promoCopyBtn');
		  if (copyBtn) {
			copyBtn.addEventListener('click', function() {
			  const codeEl = modalEl.querySelector('#homePromoModal .code-block');
			  const text = codeEl ? codeEl.textContent.trim() : '';
			  if (!text) return;
			  if (navigator.clipboard && navigator.clipboard.writeText) {
				navigator.clipboard.writeText(text).then(function() {
				  copyBtn.textContent = 'Copied!';
				  setTimeout(function(){ copyBtn.textContent = 'Copy code'; }, 1500);
				});
			  }
			});
		  }

		  // Hide for 7 days
		  const hide7Btn = document.getElementById('promoHide7dBtn');
		  if (hide7Btn) {
			hide7Btn.addEventListener('click', function() {
			  const SEVEN_DAYS = 7 * 24 * 60 * 60;
			  const until = nowSec + SEVEN_DAYS;
			  try { localStorage.setItem(HIDE_KEY, JSON.stringify(until)); } catch (e) {}
			});
		  }
		})();
		</script>
		<?php
	}, 100);

