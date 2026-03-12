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

		wp_enqueue_style( 'slick-css' );
		wp_enqueue_style( 'slick-theme-css' );
		wp_enqueue_script( 'match-height-js' );
		wp_enqueue_script( 'slick-js' );
		wp_enqueue_script( 'pegasus-carousel-plugin' );

		wp_enqueue_script( 'pegasus_child_custom_js', get_stylesheet_directory_uri() . '/js/pegasus-custom.js', array(), '', true );

		// Lightbox2.
		wp_enqueue_style( 'lightbox2-css', get_stylesheet_directory_uri() . '/css/lightbox.min.css', array(), '2.11.4' );
		wp_enqueue_script( 'lightbox2-js', get_stylesheet_directory_uri() . '/js/lightbox.min.js', array( 'jquery' ), '2.11.4', true );

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

		// Email
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

		$cmb->add_field(
			array(
				'name' => __( 'Reservation URL', 'pegasus-bootstrap' ),
				'desc' => __( 'OpenTable or reservation system link (optional)', 'pegasus-bootstrap' ),
				'id'   => $prefix . 'reservation_url',
				'type' => 'text_url',
			)
		);

		$cmb->add_field(
			array(
				'name' => __( 'Menu URL', 'pegasus-bootstrap' ),
				'desc' => __( 'Link to the menu page (optional).', 'pegasus-bootstrap' ),
				'id'   => $prefix . 'menu_url',
				'type' => 'text_url',
			)
		);

		$cmb->add_field(
			array(
				'name'    => __( 'Menu Button Text', 'pegasus-bootstrap' ),
				'desc'    => __( 'e.g. VIEW MENU', 'pegasus-bootstrap' ),
				'id'      => $prefix . 'menu_button_text',
				'type'    => 'text',
				'default' => 'View Menu',
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
				'name'    => __( 'Order Online Button Text', 'pegasus-bootstrap' ),
				'desc'    => __( 'e.g. ORDER ONLINE', 'pegasus-bootstrap' ),
				'id'      => $prefix . 'card_button_text',
				'type'    => 'text',
				'default' => 'Order Online',
			)
		);

		$cmb->add_field(
			array(
				'name' => __( 'Order Online Button Link', 'pegasus-bootstrap' ),
				'desc' => __( 'If empty, can link to the single location page.', 'pegasus-bootstrap' ),
				'id'   => $prefix . 'card_button_link',
				'type' => 'text_url',
			)
		);
	}
	add_action( 'cmb2_admin_init', 'mabellas_locations_metabox' );

	/**
	 * Pegasus Page Options for Locations CPT
	 */
	function mabellas_locations_page_options_metabox() {
		$prefix = 'pegasus';

		$cmb = new_cmb2_box( array(
			'id'           => $prefix . 'metabox2_locations',
			'title'        => __( 'Pegasus Page Options', 'pegasus' ),
			'object_types' => array( 'locations' ),
		) );

		$cmb->add_field( array(
			'name' => __( 'Fullwidth Container Checkbox', 'pegasus' ),
			'desc' => __( 'Check this box to make the page fullwidth, this shuold override the global fullwidth theme option.', 'pegasus' ),
			'id'   => $prefix . '-page-container-checkbox',
			'type' => 'checkbox',
		) );

		$cmb->add_field( array(
			'name' => __( 'Disable Page Header', 'pegasus' ),
			'desc' => __( 'Check this box to disable the Page Header.', 'pegasus' ),
			'id'   => $prefix . '-page-header-checkbox',
			'type' => 'checkbox',
		) );
	}
	add_action( 'cmb2_admin_init', 'mabellas_locations_page_options_metabox' );

	/**
	 * Additional Header Options for Locations CPT
	 */
	function mabellas_locations_additional_header_metabox() {
		$prefix = 'pegasus';

		$cmb = new_cmb2_box( array(
			'id'           => $prefix . 'metabox_locations_additional_header',
			'title'        => __( 'Additional Header Options', 'pegasus' ),
			'object_types' => array( 'locations' ),
		) );

		$cmb->add_field( array(
			'name'             => __( 'Additional Header', 'pegasus' ),
			'desc'             => __( 'Select Header Type (no hdr, sml hdr, lrg hdr)', 'pegasus' ),
			'id'               => $prefix . '_page_header_select',
			'type'             => 'select',
			'show_option_none' => false,
			'default'          => 'no-header',
			'options'          => array(
				'no-header'  => __( 'No Header - No Spacing', 'pegasus' ),
				'space'      => __( 'No Header - Just Spacing', 'pegasus' ),
				'sml-header' => __( 'Small Header - With Parallax', 'pegasus' ),
				'lrg-header' => __( 'Large Header - Full Width and Height', 'pegasus' ),
			),
		) );

		$cmb->add_field( array(
			'name'    => __( 'Overlay color', 'pegasus' ),
			'id'      => $prefix . '_add_header_overlay_color',
			'type'    => 'colorpicker',
			'default' => '#303543'
		) );

		$cmb->add_field( array(
			'name'    => __( 'Overlay Opacity', 'pegasus' ),
			'id'      => $prefix . '_add_header_overlay_opacity',
			'type'    => 'text',
			'default' => '0.4'
		) );

		$cmb->add_field( array(
			'name'    => __( 'NoSpacer Padding', 'pegasus' ),
			'id'      => $prefix . '_nospacer_padding',
			'type'    => 'text',
			'default' => '25px 0'
		) );

		$cmb->add_field( array(
			'name' => __( 'Disable Parallax', 'pegasus' ),
			'desc' => __( 'Check this box if you want to disable parallax effect.', 'pegasus' ),
			'id'   => $prefix . '_add_header_disable_parralax_chk',
			'type' => 'checkbox',
		) );

		$cmb->add_field( array(
			'name' => __( 'Disable Overlay', 'pegasus' ),
			'desc' => __( 'Check this box if you want to disable overlay on small or large header effect.', 'pegasus' ),
			'id'   => $prefix . '_add_header_disable_overlay_chk',
			'type' => 'checkbox',
		) );

		$cmb->add_field( array(
			'name'             => __( 'Image Repeat', 'pegasus' ),
			'desc'             => __( 'Choose how the background image repeats.', 'pegasus' ),
			'id'               => $prefix . '_add_header_bkg_img_repeat',
			'type'             => 'select',
			'show_option_none' => false,
			'default'          => 'none',
			'options'          => array(
				'no-repeat' => __( 'No Repeat', 'cmb2' ),
				'repeat'    => __( 'Repeat', 'cmb2' ),
				'repeat-x'  => __( 'Repeat X', 'cmb2' ),
				'repeat-y'  => __( 'Repeat Y', 'cmb2' ),
				'space'     => __( 'Space', 'cmb2' ),
				'round'     => __( 'Round', 'cmb2' ),
			),
		) );

		$cmb->add_field( array(
			'name'             => __( 'Image Position', 'pegasus' ),
			'desc'             => __( 'Choose the background image position.', 'pegasus' ),
			'id'               => $prefix . '_add_header_bkg_img_pos',
			'type'             => 'select',
			'show_option_none' => false,
			'default'          => '50-0',
			'options'          => array(
				'50-0'         => __( '50% 0', 'cmb2' ),
				'100-100'      => __( '100% 100%', 'cmb2' ),
				'center-center'=> __( 'Center Center', 'cmb2' ),
				'top-left'     => __( 'Top Left', 'cmb2' ),
				'top-center'   => __( 'Top Center', 'cmb2' ),
				'top-right'    => __( 'Top Right', 'cmb2' ),
				'bottom-left'  => __( 'Bottom Left', 'cmb2' ),
				'bottom-center'=> __( 'Bottom Center', 'cmb2' ),
				'bottom-right' => __( 'Bottom Right', 'cmb2' ),
			),
		) );

		$cmb->add_field( array(
			'name'             => __( 'Image Size', 'pegasus' ),
			'desc'             => __( 'Choose the background image size.', 'pegasus' ),
			'id'               => $prefix . '_add_header_bkg_img_size',
			'type'             => 'select',
			'show_option_none' => false,
			'default'          => 'cover',
			'options'          => array(
				'auto'    => __( 'None', 'cmb2' ),
				'cover'   => __( 'Cover', 'cmb2' ),
				'100-100' => __( '100% 100%', 'cmb2' ),
				'contain' => __( 'Contain', 'cmb2' ),
			),
		) );

		$cmb->add_field( array(
			'name' => __( 'Background Attachment Fixed', 'pegasus' ),
			'desc' => __( 'Check this box if you want the background image to be fixed / parallax effect.', 'pegasus' ),
			'id'   => $prefix . '_add_header_bkg_img_fixed_chk',
			'type' => 'checkbox',
		) );

		$cmb->add_field( array(
			'name'    => __( 'Header Content wysiwyg', 'cmb2' ),
			'desc'    => __( 'This will show up in the Additional Header select area.', 'cmb2' ),
			'id'      => $prefix . '_page_header_wysiwyg',
			'type'    => 'wysiwyg',
			'options' => array( 'textarea_rows' => 5 ),
		) );

		$cmb->add_field( array(
			'name'    => __( 'Header Content color', 'pegasus' ),
			'id'      => $prefix . '_page_header_wysiwyg_color',
			'type'    => 'rgba_colorpicker',
			'default' => '#fff'
		) );
	}
	add_action( 'cmb2_admin_init', 'mabellas_locations_additional_header_metabox' );

	/**
	 * Disable WooCommerce product reviews completely
	 */

	add_filter('woocommerce_product_tabs', function($tabs) {
		unset($tabs['reviews']);
		return $tabs;
	}, 98);

	add_filter('woocommerce_enable_reviews', '__return_false');
	add_filter('woocommerce_enable_review_rating', '__return_false');

	remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);

	add_filter('comments_open', function($open, $post_id) {
		if (get_post_type($post_id) === 'product') {
			return false;
		}
		return $open;
	}, 10, 2);

	/*====================================================
	 * Toast POS Menu Integration
	 *
	 * Fetches menu data from the Toast API via the vqdev-toast
	 * plugin and transforms it into the format expected by the
	 * theme's menu-tabs.php / menu-mobile.php templates.
	 *===================================================*/

	/**
	 * Fetch out-of-stock item GUIDs from the Toast Stock API.
	 *
	 * Cached for 5 minutes (stock changes more frequently than menus).
	 *
	 * @return array Set of GUIDs that are OUT_OF_STOCK, keyed by GUID for fast lookup.
	 */
	function vqdev_toast_get_oos_guids() {

		$cached = get_transient( 'vqdev_toast_oos_guids' );
		if ( false !== $cached ) {
			return $cached;
		}

		$result = vqdev_toast()->stock()->get_inventory();
		$oos    = array();

		if ( $result['success'] && is_array( $result['data'] ) ) {
			foreach ( $result['data'] as $entry ) {
				if ( 'OUT_OF_STOCK' === ( $entry['status'] ?? '' ) ) {
					$oos[ $entry['guid'] ] = true;
				}
			}
		}

		set_transient( 'vqdev_toast_oos_guids', $oos, 5 * MINUTE_IN_SECONDS );

		return $oos;
	}

	/**
	 * Fetch and transform Toast menu data into the theme's tab/section/item format.
	 *
	 * Returns cached data when available (1-hour transient).
	 * Skips the "Retail" menu. Resolves SIZE_PRICE items into extras.
	 * Includes item images from the Toast API.
	 * Marks out-of-stock items (or hides them, based on $hide_oos).
	 *
	 * @param array $skip_menus Menu names to exclude (default: ['Retail']).
	 * @param bool  $hide_oos   If true, completely remove OOS items. If false, mark them.
	 * @return array|null Theme-formatted menu data, or null on failure.
	 */
	function vqdev_toast_get_menu_data( $skip_menus = array( 'Retail' ), $hide_oos = false ) {

		if ( ! function_exists( 'vqdev_toast' ) ) {
			return null;
		}

		$cache_key = 'vqdev_toast_menu_data';
		$cached    = get_transient( $cache_key );
		if ( false !== $cached ) {
			return $cached;
		}

		$result = vqdev_toast()->menus()->get_menus_v2();
		if ( ! $result['success'] || empty( $result['data']['menus'] ) ) {
			return null;
		}

		$api = $result['data'];

		// Build lookup maps for modifier resolution.
		$mod_groups  = array();
		$mod_options = array();

		if ( ! empty( $api['modifierGroupReferences'] ) ) {
			foreach ( $api['modifierGroupReferences'] as $ref ) {
				$mod_groups[ $ref['referenceId'] ] = $ref;
			}
		}
		if ( ! empty( $api['modifierOptionReferences'] ) ) {
			foreach ( $api['modifierOptionReferences'] as $ref ) {
				$mod_options[ $ref['referenceId'] ] = $ref;
			}
		}

		// Fetch out-of-stock GUIDs.
		$oos_guids = vqdev_toast_get_oos_guids();

		$tabs = array();

		foreach ( $api['menus'] as $menu ) {
			if ( in_array( $menu['name'], $skip_menus, true ) ) {
				continue;
			}

			$tab = array(
				'id'          => sanitize_title( $menu['name'] ),
				'label'       => $menu['name'],
				'description' => ! empty( $menu['description'] ) ? $menu['description'] : '',
				'sections'    => array(),
				'footnotes'   => array(),
			);

			foreach ( $menu['menuGroups'] as $group ) {
				$has_subgroups = ! empty( $group['menuGroups'] );

				// If the group itself has items, add it as a section.
				if ( ! empty( $group['menuItems'] ) ) {
					$tab['sections'][] = vqdev_toast_transform_group( $group, $mod_groups, $mod_options, $oos_guids, $hide_oos );
				}

				// Flatten nested subgroups into their own sections.
				if ( $has_subgroups ) {
					foreach ( $group['menuGroups'] as $sub ) {
						if ( ! empty( $sub['menuItems'] ) ) {
							$tab['sections'][] = vqdev_toast_transform_group( $sub, $mod_groups, $mod_options, $oos_guids, $hide_oos );
						}
					}
				}
			}

			$tabs[] = $tab;
		}

		$last_updated = '';
		if ( ! empty( $api['lastUpdated'] ) ) {
			$ts = strtotime( $api['lastUpdated'] );
			if ( $ts ) {
				$last_updated = gmdate( 'Y-m-d', $ts );
			}
		}

		$menu_data = array(
			'restaurant_name' => 'Mabellas',
			'updated'         => $last_updated,
			'tabs'            => $tabs,
		);

		set_transient( $cache_key, $menu_data, HOUR_IN_SECONDS );

		return $menu_data;
	}

	/**
	 * Transform a Toast menuGroup into a theme section.
	 *
	 * @param array $group       Toast menuGroup object.
	 * @param array $mod_groups  Modifier group refs keyed by referenceId.
	 * @param array $mod_options Modifier option refs keyed by referenceId.
	 * @param array $oos_guids   Out-of-stock GUIDs keyed by GUID.
	 * @param bool  $hide_oos    Whether to hide OOS items entirely.
	 * @return array Theme section.
	 */
	function vqdev_toast_transform_group( $group, $mod_groups, $mod_options, $oos_guids = array(), $hide_oos = false ) {

		$items = array();

		foreach ( $group['menuItems'] as $toast_item ) {
			$is_oos = isset( $oos_guids[ $toast_item['guid'] ?? '' ] );

			// Skip OOS items entirely if configured.
			if ( $is_oos && $hide_oos ) {
				continue;
			}

			$theme_item = vqdev_toast_transform_item( $toast_item, $mod_groups, $mod_options );

			if ( $is_oos ) {
				$theme_item['out_of_stock'] = true;
			}

			$items[] = $theme_item;
		}

		return array(
			'title' => $group['name'] ?? '',
			'note'  => $group['description'] ?? '',
			'items' => $items,
		);
	}

	/**
	 * Transform a single Toast menuItem into a theme item.
	 *
	 * Resolves SIZE_PRICE items by looking up their size modifier group
	 * and converting each size option into an "extra" with label + price.
	 * Includes image URL when available from the Toast API.
	 *
	 * @param array $item        Toast menuItem object.
	 * @param array $mod_groups  Modifier group refs keyed by referenceId.
	 * @param array $mod_options Modifier option refs keyed by referenceId.
	 * @return array Theme item.
	 */
	function vqdev_toast_transform_item( $item, $mod_groups, $mod_options ) {

		$price  = '';
		$extras = array();

		if ( 'SIZE_PRICE' === ( $item['pricingStrategy'] ?? '' ) ) {
			// Find the size modifier group via the sizeSpecificPricingGuid.
			$size_guid = $item['pricingRules']['sizeSpecificPricingGuid'] ?? '';
			if ( $size_guid ) {
				foreach ( $item['modifierGroupReferences'] ?? array() as $ref_id ) {
					if ( isset( $mod_groups[ $ref_id ] ) && $mod_groups[ $ref_id ]['guid'] === $size_guid ) {
						foreach ( $mod_groups[ $ref_id ]['modifierOptionReferences'] as $opt_ref_id ) {
							if ( isset( $mod_options[ $opt_ref_id ] ) ) {
								$opt = $mod_options[ $opt_ref_id ];
								$extras[] = array(
									'label' => $opt['name'],
									'price' => ( null !== $opt['price'] ) ? (string) $opt['price'] : '',
								);
							}
						}
						break;
					}
				}
			}
		} else {
			$price = ( null !== $item['price'] ) ? (string) $item['price'] : '';
		}

		// Map allergens to badge labels.
		$badges = array();
		if ( ! empty( $item['allergens'] ) ) {
			foreach ( $item['allergens'] as $allergen ) {
				$badges[] = $allergen;
			}
		}

		// Image URL from Toast (S3-hosted).
		$image = ! empty( $item['image'] ) ? $item['image'] : '';

		return array(
			'name'         => $item['name'] ?? '',
			'description'  => $item['description'] ?? '',
			'price'        => $price,
			'badges'       => $badges,
			'spicy_level'  => 0,
			'extras'       => $extras,
			'image'        => $image,
			'out_of_stock' => false,
		);
	}

	/**
	 * Shortcode: [toast_menu]
	 *
	 * Renders the full Toast POS menu using the theme's existing
	 * menu-tabs (desktop) and menu-mobile templates.
	 *
	 * Usage: [toast_menu] or [toast_menu skip="Retail,Alcohol"]
	 */
	function vqdev_toast_menu_shortcode( $atts ) {

		$atts = shortcode_atts( array(
			'skip' => 'Retail',
		), $atts, 'toast_menu' );

		$skip_menus = array_map( 'trim', explode( ',', $atts['skip'] ) );
		$menu_data  = vqdev_toast_get_menu_data( $skip_menus );

		if ( ! $menu_data || empty( $menu_data['tabs'] ) ) {
			return '<div class="alert alert-warning">Menu is currently unavailable. Please check back later.</div>';
		}

		// Format helpers (define once).
		if ( ! function_exists( 'vqmenu_money' ) ) {
			function vqmenu_money( $value ) {
				$num = is_numeric( $value ) ? number_format( (float) $value, 2, '.', '' ) : $value;
				if ( is_numeric( $value ) && fmod( (float) $value, 1.0 ) === 0.0 ) {
					$num = number_format( (float) $value, 0, '.', '' );
				}
				return '$' . $num;
			}
		}

		if ( ! function_exists( 'vqmenu_badge_class' ) ) {
			function vqmenu_badge_class( $label ) {
				$label = strtoupper( trim( (string) $label ) );
				return match ( $label ) {
					'V'     => 'vqmenu-badge vqmenu-badge--veg',
					'GF'    => 'vqmenu-badge vqmenu-badge--gf',
					'GF*'   => 'vqmenu-badge vqmenu-badge--gf',
					default => 'vqmenu-badge',
				};
			}
		}

		// Enqueue the mobile menu JS.
		$theme_dir = get_stylesheet_directory();
		$theme_uri = get_stylesheet_directory_uri();
		$js_rel    = '/assets/restaurant-menu/restaurant-menu.js';
		if ( file_exists( $theme_dir . $js_rel ) ) {
			wp_enqueue_script( 'vq-restaurant-menu', $theme_uri . $js_rel, array(), filemtime( $theme_dir . $js_rel ), true );
		}

		$tabs = $menu_data['tabs'];

		ob_start();
		?>
		<div class="vqmenu">
			<header class="vqmenu-header mb-4">
				<?php if ( ! empty( $menu_data['restaurant_name'] ) ) : ?>
					<h2 class="vqmenu-title mb-1"><?php echo esc_html( $menu_data['restaurant_name'] ); ?></h2>
				<?php endif; ?>
				<?php if ( ! empty( $menu_data['updated'] ) ) : ?>
					<div class="vqmenu-meta text-muted">
						Updated: <?php echo esc_html( $menu_data['updated'] ); ?>
					</div>
				<?php endif; ?>
			</header>

			<!-- Desktop: tabbed menu (hidden < 992px) -->
			<div class="vqmenu-desktop">
				<?php include get_stylesheet_directory() . '/templates/menu-tabs.php'; ?>
			</div>

			<!-- Mobile: long-scroll menu (hidden >= 992px) -->
			<div class="vqmenu-mobile">
				<?php include get_stylesheet_directory() . '/templates/menu-mobile.php'; ?>
			</div>
		</div>
		<?php
		return ob_get_clean();
	}
	add_shortcode( 'toast_menu', 'vqdev_toast_menu_shortcode' );
