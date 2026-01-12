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


	} //end function
	add_action( 'wp_enqueue_scripts', 'pegasus_child_bootstrap_js' );


	/**
	 * Homepage Sections metabox (CMB2) – shown only on the static front page
	 */
	if ( ! function_exists( 'cmb2_homepage_metabox' ) ) {
		function cmb2_homepage_metabox() {

			$homepage_id = (int) get_option( 'page_on_front' ); // ID of the static front page
			if ( ! $homepage_id ) {
				return; // bail if a front page is not set
			}

			$prefix = 'homepage_sections_';

			$cmb = new_cmb2_box( array(
				'id'            => $prefix . 'metabox',
				'title'         => __( 'Homepage Sections', 'pegasus-bootstrap' ),
				'object_types'  => array( 'page' ),
				'show_on'       => array(
					'key'   => 'id',
					'value' => array( $homepage_id ),
				),
				'context'       => 'normal',
				'priority'      => 'high',
				'show_names'    => true,
			) );

			$group_field_id = $cmb->add_field( array(
				'id'          => $prefix . 'repeatable_group',
				'type'        => 'group',
				'description' => __( 'Add multiple sections for the homepage', 'pegasus-bootstrap' ),
				'options'     => array(
					'group_title'   => __( 'Section {#}', 'pegasus-bootstrap' ),
					'add_button'    => __( 'Add Another Section', 'pegasus-bootstrap' ),
					'remove_button' => __( 'Remove Section', 'pegasus-bootstrap' ),
					'sortable'      => true,
				),
			) );

			// Background image
			$cmb->add_group_field( $group_field_id, array(
				'name'    => __( 'Background Image', 'pegasus-bootstrap' ),
				'id'      => 'background_image',
				'type'    => 'file',
				'options' => array(
					'url' => false, // hide URL input
				),
				'text'    => array(
					'add_upload_file_text' => __( 'Add Background Image', 'pegasus-bootstrap' ),
				),
			) );

			// Title
			$cmb->add_group_field( $group_field_id, array(
				'name' => __( 'Title', 'pegasus-bootstrap' ),
				'id'   => 'title',
				'type' => 'text',
			) );

			// Subtitle
			$cmb->add_group_field( $group_field_id, array(
				'name' => __( 'Subtitle', 'pegasus-bootstrap' ),
				'id'   => 'subtitle',
				'type' => 'text',
			) );

			// Paragraph
			$cmb->add_group_field( $group_field_id, array(
				'name' => __( 'Paragraph', 'pegasus-bootstrap' ),
				'id'   => 'paragraph',
				'type' => 'wysiwyg',
			) );

			// Button 1 Text
			$cmb->add_group_field( $group_field_id, array(
				'name' => __( 'Button 1 Text', 'pegasus-bootstrap' ),
				'id'   => 'button1_text',
				'type' => 'text',
			) );

			// Button 1 Link
			$cmb->add_group_field( $group_field_id, array(
				'name' => __( 'Button 1 Link', 'pegasus-bootstrap' ),
				'id'   => 'button1_link',
				'type' => 'text_url',
			) );
		}
	}
	add_action( 'cmb2_admin_init', 'cmb2_homepage_metabox' );

	/**
	 * Helper: normalize CMB2 file field (ID / array / URL) to a URL
	 */
	if ( ! function_exists( 'mabellas_get_cmb2_image_url' ) ) {
		function mabellas_get_cmb2_image_url( $value ) {

			if ( empty( $value ) ) {
				return '';
			}

			// CMB2 can give us an array with 'id' and/or 'url'
			if ( is_array( $value ) ) {
				if ( ! empty( $value['url'] ) ) {
					return esc_url( $value['url'] );
				}
				if ( ! empty( $value['id'] ) ) {
					$value = (int) $value['id'];
				}
			}

			// Attachment ID
			if ( is_numeric( $value ) ) {
				$src = wp_get_attachment_image_src( (int) $value, 'full' );
				if ( $src && ! empty( $src[0] ) ) {
					return esc_url( $src[0] );
				}
			}

			// Plain URL
			return esc_url( $value );
		}
	}

	/**
	 * Register Locations Custom Post Type + Taxonomies
	 */
	function mabellas_register_locations_cpt() {

		/*============================
		======= Locations Post Type =======
		============================*/

		$locations_labels = array(
			'name'               => _x( 'Locations', 'locations general name', 'pegasus-bootstrap' ),
			'singular_name'      => _x( 'Location', 'locations singular name', 'pegasus-bootstrap' ),
			'add_new'            => _x( 'Add New', 'location', 'pegasus-bootstrap' ),
			'add_new_item'       => __( 'Add New Location', 'pegasus-bootstrap' ),
			'edit_item'          => __( 'Edit Location', 'pegasus-bootstrap' ),
			'new_item'           => __( 'New Location', 'pegasus-bootstrap' ),
			'view_item'          => __( 'View Location', 'pegasus-bootstrap' ),
			'search_items'       => __( 'Search Locations', 'pegasus-bootstrap' ),
			'not_found'          => __( 'No locations found', 'pegasus-bootstrap' ),
			'not_found_in_trash' => __( 'No locations found in Trash', 'pegasus-bootstrap' ),
			'parent_item_colon'  => '',
			'menu_name'          => __( 'Locations', 'pegasus-bootstrap' ),
		);

		$locations_args = array(
			'labels'             => $locations_labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'capability_type'    => 'post',
			'can_export'         => true,
			'has_archive'        => false,
			'rewrite'            => array( 'slug' => 'locations' ),
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
			'show_in_rest'       => true,
			'menu_icon'          => 'dashicons-location-alt',
		);

		register_post_type( 'locations', $locations_args );

		// Remove supports you don't want
		remove_post_type_support( 'locations', 'author' );
		remove_post_type_support( 'locations', 'excerpt' );
		remove_post_type_support( 'locations', 'trackbacks' );

		/*============================
		======= Taxonomy: Tags =======
		============================*/

		$location_tags_labels = array(
			'name'              => _x( 'Location Tags', 'taxonomy general name', 'pegasus-bootstrap' ),
			'singular_name'     => _x( 'Location Tag', 'taxonomy singular name', 'pegasus-bootstrap' ),
			'search_items'      => __( 'Search Location Tags', 'pegasus-bootstrap' ),
			'all_items'         => __( 'All Location Tags', 'pegasus-bootstrap' ),
			'parent_item'       => __( 'Parent Location Tag', 'pegasus-bootstrap' ),
			'parent_item_colon' => __( 'Parent Location Tag:', 'pegasus-bootstrap' ),
			'edit_item'         => __( 'Edit Location Tag', 'pegasus-bootstrap' ),
			'update_item'       => __( 'Update Location Tag', 'pegasus-bootstrap' ),
			'add_new_item'      => __( 'Add New Location Tag', 'pegasus-bootstrap' ),
			'new_item_name'     => __( 'New Location Tag Name', 'pegasus-bootstrap' ),
			'menu_name'         => __( 'Location Tags', 'pegasus-bootstrap' ),
		);

		register_taxonomy(
			'location_tags',
			array( 'locations' ),
			array(
				'hierarchical'      => false,
				'labels'            => $location_tags_labels,
				'show_ui'           => true,
				'show_admin_column' => true,
				'query_var'         => true,
				'rewrite'           => array( 'slug' => 'location-tags' ),
			)
		);

		/*============================
		======= Taxonomy: Categories =======
		============================*/

		$location_cats_labels = array(
			'name'              => _x( 'Location Categories', 'taxonomy general name', 'pegasus-bootstrap' ),
			'singular_name'     => _x( 'Location Category', 'taxonomy singular name', 'pegasus-bootstrap' ),
			'search_items'      => __( 'Search Location Categories', 'pegasus-bootstrap' ),
			'all_items'         => __( 'All Location Categories', 'pegasus-bootstrap' ),
			'parent_item'       => __( 'Parent Location Category', 'pegasus-bootstrap' ),
			'parent_item_colon' => __( 'Parent Location Category:', 'pegasus-bootstrap' ),
			'edit_item'         => __( 'Edit Location Category', 'pegasus-bootstrap' ),
			'update_item'       => __( 'Update Location Category', 'pegasus-bootstrap' ),
			'add_new_item'      => __( 'Add New Location Category', 'pegasus-bootstrap' ),
			'new_item_name'     => __( 'New Location Category Name', 'pegasus-bootstrap' ),
			'menu_name'         => __( 'Location Categories', 'pegasus-bootstrap' ),
		);

		register_taxonomy(
			'location_categories',
			array( 'locations' ),
			array(
				'hierarchical'      => true,
				'labels'            => $location_cats_labels,
				'show_ui'           => true,
				'show_admin_column' => true,
				'query_var'         => true,
				'rewrite'           => array( 'slug' => 'location-categories' ),
			)
		);
	}
	add_action( 'init', 'mabellas_register_locations_cpt' );

	/**
	 * CMB2 metabox for Locations CPT
	 */
	function mabellas_locations_metabox() {

		$prefix = 'mabellas_location_';

		$cmb = new_cmb2_box(
			array(
				'id'           => $prefix . 'details',
				'title'        => __( 'Location Details', 'pegasus-bootstrap' ),
				'object_types' => array( 'locations' ),
				'context'      => 'normal',
				'priority'     => 'high',
				'show_names'   => true,
			)
		);

		// Display name (if different from post title)
		$cmb->add_field(
			array(
				'name' => __( 'Display Name', 'pegasus-bootstrap' ),
				'desc' => __( 'Optional. If empty, the post title will be used.', 'pegasus-bootstrap' ),
				'id'   => $prefix . 'display_name',
				'type' => 'text',
			)
		);

		// Address fields
		$cmb->add_field(
			array(
				'name' => __( 'Street Address', 'pegasus-bootstrap' ),
				'id'   => $prefix . 'street',
				'type' => 'text',
			)
		);

		$cmb->add_field(
			array(
				'name' => __( 'Address Line 2', 'pegasus-bootstrap' ),
				'id'   => $prefix . 'street2',
				'type' => 'text',
			)
		);

		$cmb->add_field(
			array(
				'name' => __( 'City', 'pegasus-bootstrap' ),
				'id'   => $prefix . 'city',
				'type' => 'text',
				'default' => 'Columbus',
			)
		);

		$cmb->add_field(
			array(
				'name'    => __( 'State', 'pegasus-bootstrap' ),
				'id'      => $prefix . 'state',
				'type'    => 'text_small',
				'default' => 'GA',
			)
		);

		$cmb->add_field(
			array(
				'name' => __( 'Postal Code', 'pegasus-bootstrap' ),
				'id'   => $prefix . 'zip',
				'type' => 'text_small',
			)
		);

		// Phone (human display)
		$cmb->add_field(
			array(
				'name' => __( 'Phone (Display)', 'pegasus-bootstrap' ),
				'desc' => __( 'e.g. (706) 940-0070', 'pegasus-bootstrap' ),
				'id'   => $prefix . 'phone_display',
				'type' => 'text',
			)
		);

		// Phone (tel link)
		$cmb->add_field(
			array(
				'name' => __( 'Phone (tel value)', 'pegasus-bootstrap' ),
				'desc' => __( 'e.g. +17069400070 (digits only, with country code)', 'pegasus-bootstrap' ),
				'id'   => $prefix . 'phone_tel',
				'type' => 'text',
			)
		);

		// Optional secondary phone
		$cmb->add_field(
			array(
				'name' => __( 'Secondary Phone (Display)', 'pegasus-bootstrap' ),
				'id'   => $prefix . 'phone2_display',
				'type' => 'text',
			)
		);

		$cmb->add_field(
			array(
				'name' => __( 'Secondary Phone (tel value)', 'pegasus-bootstrap' ),
				'id'   => $prefix . 'phone2_tel',
				'type' => 'text',
			)
		);

		// URLs
		$cmb->add_field(
			array(
				'name' => __( 'Google Maps URL', 'pegasus-bootstrap' ),
				'id'   => $prefix . 'maps_url',
				'type' => 'text_url',
			)
		);

		$cmb->add_field(
			array(
				'name' => __( 'Reservation URL', 'pegasus-bootstrap' ),
				'desc' => __( 'OpenTable or reservation system link (optional)', 'pegasus-bootstrap' ),
				'id'   => $prefix . 'reservation_url',
				'type' => 'text_url',
			)
		);

		// Card / Front-end display meta
		$cmb->add_field(
			array(
				'name' => __( 'Card Background Image', 'pegasus-bootstrap' ),
				'desc' => __( 'Used for the locations grid on the homepage.', 'pegasus-bootstrap' ),
				'id'   => $prefix . 'card_background_image',
				'type' => 'file',
				'options' => array(
					'url' => false,
				),
				'text' => array(
					'add_upload_file_text' => __( 'Add Card Image', 'pegasus-bootstrap' ),
				),
			)
		);

		$cmb->add_field(
			array(
				'name'    => __( 'Card Button Text', 'pegasus-bootstrap' ),
				'desc'    => __( 'e.g. VISIT US', 'pegasus-bootstrap' ),
				'id'      => $prefix . 'card_button_text',
				'type'    => 'text',
				'default' => 'Visit Us',
			)
		);

		$cmb->add_field(
			array(
				'name' => __( 'Card Button Link', 'pegasus-bootstrap' ),
				'desc' => __( 'If empty, can link to the single location page.', 'pegasus-bootstrap' ),
				'id'   => $prefix . 'card_button_link',
				'type' => 'text_url',
			)
		);
	}
	add_action( 'cmb2_admin_init', 'mabellas_locations_metabox' );
