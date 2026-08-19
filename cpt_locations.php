<?php


	/**
	 * Register Locations Custom Post Type + Taxonomies
	 */
	function ulg_register_locations_cpt() {

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
	add_action( 'init', 'ulg_register_locations_cpt' );



	function ulg_locations_metabox() {

		$prefix = 'ulg_location_';

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

		$cmb->add_field(
			array(
				'name' => __( 'Subtitle', 'pegasus-bootstrap' ),
				'desc' => __( 'Optional.', 'pegasus-bootstrap' ),
				'id'   => $prefix . 'sub_title',
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

		$cmb->add_field(
			array(
				'name' => __( 'Email', 'pegasus-bootstrap' ),
				'id'   => $prefix . 'email',
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

		// Homepage card links (fall back to the single location page if empty).
		$cmb->add_field(
			array(
				'name' => __( 'Tap List URL', 'pegasus-bootstrap' ),
				'desc' => __( 'Homepage card link. If empty, links to this location page.', 'pegasus-bootstrap' ),
				'id'   => $prefix . 'taplist_url',
				'type' => 'text_url',
			)
		);

		$cmb->add_field(
			array(
				'name' => __( 'Events URL', 'pegasus-bootstrap' ),
				'desc' => __( 'Homepage card link. If empty, links to this location page.', 'pegasus-bootstrap' ),
				'id'   => $prefix . 'events_url',
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

		$cmb->add_field(
			array(
				'name' => __( 'Hours of Operation', 'pegasus-bootstrap' ),
				'desc' => __( 'Hours of operation.', 'pegasus-bootstrap' ),
				'id'   => $prefix . 'hours_op',
				'type' => 'wysiwyg',
			)
		);

		$cmb->add_field(
			array(
				'name' => __( 'Facebook Link', 'pegasus-bootstrap' ),
				'desc' => __( 'FB link.', 'pegasus-bootstrap' ),
				'id'   => $prefix . 'social_fb',
				'type' => 'text_url',
			)
		);

		$cmb->add_field(
			array(
				'name' => __( 'Instagram Link', 'pegasus-bootstrap' ),
				'desc' => __( 'IG link.', 'pegasus-bootstrap' ),
				'id'   => $prefix . 'social_ig',
				'type' => 'text_url',
			)
		);

	}
	add_action( 'cmb2_admin_init', 'ulg_locations_metabox' );

	add_action( 'cmb2_admin_init', 'locations_register_metaboxes' );
	function locations_register_metaboxes() {

		$prefix = 'location_';

		$locations_metabox = new_cmb2_box( array(
			'id'           => $prefix . 'metabox',
			'title'        => __( 'Location Details', 'pegasus-bootstrap' ),
			'object_types' => array( 'locations' ), // or whatever your CPT slug is
			'context'      => 'normal',
			'priority'     => 'high',
			'show_names'   => true,
		) );

		// …your other location fields (address, phone, etc)…

		/**
		 * Repeatable Gallery group
		 */
		$gallery_group_id = $locations_metabox->add_field( array(
			'id'         => $prefix . 'gallery', // meta key: location_gallery
			'type'       => 'group',
			'repeatable' => true,
			'description'=> __( 'Add images for this location gallery.', 'pegasus-bootstrap' ),
			'options'    => array(
				'group_title'   => __( 'Image {#}', 'pegasus-bootstrap' ),
				'add_button'    => __( 'Add Another Image', 'pegasus-bootstrap' ),
				'remove_button' => __( 'Remove Image', 'pegasus-bootstrap' ),
				'sortable'      => true,
				'closed'        => true,
			),
		) );

		// Title (optional)
		$locations_metabox->add_group_field( $gallery_group_id, array(
			'name' => __( 'Title', 'pegasus-bootstrap' ),
			'id'   => $prefix . 'gallery_title',
			'type' => 'text',
		) );

		// Image
		$locations_metabox->add_group_field( $gallery_group_id, array(
			'name' => __( 'Image', 'pegasus-bootstrap' ),
			'id'   => $prefix . 'gallery_image',
			'type' => 'file',
			'options' => array(
				'url' => false, // hide raw URL field in admin
			),
		) );

		// Alt Text
		$locations_metabox->add_group_field( $gallery_group_id, array(
			'name' => __( 'Alt Text', 'pegasus-bootstrap' ),
			'id'   => $prefix . 'gallery_alt_text',
			'type' => 'text',
		) );

		// Caption
		$locations_metabox->add_group_field( $gallery_group_id, array(
			'name' => __( 'Caption', 'pegasus-bootstrap' ),
			'id'   => $prefix . 'gallery_caption',
			'type' => 'text',
		) );
	}


	/**
	 * Location single-page section content (hero status, quick facts, tap list,
	 * events, hours). Repeatable groups; the front end falls back to the design
	 * defaults until real content is saved.
	 */
	add_action( 'cmb2_admin_init', 'sb_location_page_metaboxes' );
	function sb_location_page_metaboxes() {

		if ( ! function_exists( 'new_cmb2_box' ) ) {
			return;
		}

		$prefix = 'sb_loc_';

		$box = new_cmb2_box( array(
			'id'           => $prefix . 'page_box',
			'title'        => __( 'Location Page Content', 'pegasus-child' ),
			'object_types' => array( 'locations' ),
			'context'      => 'normal',
			'priority'     => 'high',
			'closed'       => true,
		) );

		$box->add_field( array(
			'name'    => __( 'Hero status text', 'pegasus-child' ),
			'desc'    => __( 'Small label next to the dot in the hero, e.g. "Open Daily".', 'pegasus-child' ),
			'id'      => $prefix . 'hero_status',
			'type'    => 'text',
			'default' => 'Open Daily',
		) );

		$box->add_field( array(
			'name' => __( '"See Full Tap List" URL', 'pegasus-child' ),
			'id'   => $prefix . 'taplist_full_url',
			'type' => 'text_url',
		) );

		// Quick facts bar.
		$qf = $box->add_field( array(
			'id'         => $prefix . 'quick_facts',
			'type'       => 'group',
			'repeatable' => true,
			'options'    => array(
				'group_title'   => __( 'Fact {#}', 'pegasus-child' ),
				'add_button'    => __( 'Add fact', 'pegasus-child' ),
				'remove_button' => __( 'Remove fact', 'pegasus-child' ),
				'closed'        => true,
			),
		) );
		$box->add_group_field( $qf, array( 'name' => __( 'Value', 'pegasus-child' ), 'id' => 'value', 'type' => 'text' ) );
		$box->add_group_field( $qf, array( 'name' => __( 'Label', 'pegasus-child' ), 'id' => 'label', 'type' => 'text' ) );

		// Tap list.
		$tap = $box->add_field( array(
			'id'         => $prefix . 'taplist',
			'type'       => 'group',
			'repeatable' => true,
			'options'    => array(
				'group_title'   => __( 'Beer {#}', 'pegasus-child' ),
				'add_button'    => __( 'Add beer', 'pegasus-child' ),
				'remove_button' => __( 'Remove beer', 'pegasus-child' ),
				'closed'        => true,
			),
		) );
		$box->add_group_field( $tap, array( 'name' => __( 'Name', 'pegasus-child' ), 'id' => 'name', 'type' => 'text' ) );
		$box->add_group_field( $tap, array( 'name' => __( 'Brewery', 'pegasus-child' ), 'id' => 'brewery', 'type' => 'text' ) );
		$box->add_group_field( $tap, array( 'name' => __( 'Style', 'pegasus-child' ), 'id' => 'style', 'type' => 'text' ) );
		$box->add_group_field( $tap, array( 'name' => __( 'ABV', 'pegasus-child' ), 'id' => 'abv', 'type' => 'text_small' ) );
		$box->add_group_field( $tap, array( 'name' => __( 'Price', 'pegasus-child' ), 'id' => 'price', 'type' => 'text_small' ) );

		// Events.
		$ev = $box->add_field( array(
			'id'         => $prefix . 'events',
			'type'       => 'group',
			'repeatable' => true,
			'options'    => array(
				'group_title'   => __( 'Event {#}', 'pegasus-child' ),
				'add_button'    => __( 'Add event', 'pegasus-child' ),
				'remove_button' => __( 'Remove event', 'pegasus-child' ),
				'closed'        => true,
			),
		) );
		$box->add_group_field( $ev, array( 'name' => __( 'Day', 'pegasus-child' ), 'id' => 'day', 'type' => 'text_small' ) );
		$box->add_group_field( $ev, array( 'name' => __( 'Month', 'pegasus-child' ), 'id' => 'month', 'type' => 'text_small', 'desc' => __( 'e.g. JUL', 'pegasus-child' ) ) );
		$box->add_group_field( $ev, array( 'name' => __( 'Title', 'pegasus-child' ), 'id' => 'title', 'type' => 'text' ) );
		$box->add_group_field( $ev, array( 'name' => __( 'Time', 'pegasus-child' ), 'id' => 'time', 'type' => 'text_small' ) );
		$box->add_group_field( $ev, array( 'name' => __( 'Description', 'pegasus-child' ), 'id' => 'description', 'type' => 'textarea_small' ) );

		// Hours.
		$hr = $box->add_field( array(
			'id'         => $prefix . 'hours',
			'type'       => 'group',
			'repeatable' => true,
			'options'    => array(
				'group_title'   => __( 'Row {#}', 'pegasus-child' ),
				'add_button'    => __( 'Add hours row', 'pegasus-child' ),
				'remove_button' => __( 'Remove row', 'pegasus-child' ),
				'closed'        => true,
			),
		) );
		$box->add_group_field( $hr, array( 'name' => __( 'Days', 'pegasus-child' ), 'id' => 'label', 'type' => 'text' ) );
		$box->add_group_field( $hr, array( 'name' => __( 'Time', 'pegasus-child' ), 'id' => 'time', 'type' => 'text' ) );
	}


	/**
	 * Get a single sb_loc_ field, falling back to a default.
	 */
	function sb_location_field( $post_id, $key, $default = '' ) {
		$value = get_post_meta( $post_id, 'sb_loc_' . $key, true );
		return ( is_string( $value ) && '' !== trim( $value ) ) ? $value : $default;
	}

	/**
	 * Get a repeatable group's rows, falling back to a default array when no row
	 * has real content (reuses sb_home_row_has_content from the home fields).
	 */
	function sb_location_group_rows( $post_id, $meta_key, $default = array() ) {
		$rows = get_post_meta( $post_id, $meta_key, true );

		if ( is_array( $rows ) ) {
			if ( function_exists( 'sb_home_row_has_content' ) ) {
				$rows = array_values( array_filter( $rows, 'sb_home_row_has_content' ) );
			} else {
				$rows = array_values( array_filter( $rows ) );
			}
			if ( ! empty( $rows ) ) {
				return $rows;
			}
		}

		return $default;
	}




