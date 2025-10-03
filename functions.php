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

		/* slick */
		wp_enqueue_style('slick-css', get_stylesheet_directory_uri() . '/css/slick.css', null, false, false);
		wp_enqueue_style('slick-theme-css', get_stylesheet_directory_uri() . '/css/slick-theme.css', null, false, false);

		wp_enqueue_style('magnific-css', get_stylesheet_directory_uri() . '/css/magnific.css', null, false, false);

	}
	add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
	/* ~~~~~^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^~~~~~
	~~~~PROPER WAY OF ADDING CHILD THEME CSS FILE ~~~~
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/




	/**
	* Proper way to enqueue JS and IE fixes as of Mar 2015
	*/
	function pegasus_child_bootstrap_js() {

		wp_enqueue_script( 'opp_custom_js', get_stylesheet_directory_uri() . '/js/custom.js', array(), '', true );

		wp_enqueue_script( 'matchHeight_js', get_stylesheet_directory_uri() . '/js/jquery.matchHeight-min.js', array(), '', true );

		wp_enqueue_script( 'fitvids_js', get_stylesheet_directory_uri() . '/js/fitvids.js', array(), '', true );

		//wp_enqueue_script( 'popup_js', get_stylesheet_directory_uri() . '/js/jquery.magnific-popup.min.js', array(), '', true );

		//wp_enqueue_script( 'pegasus_child_custom_js', get_stylesheet_directory_uri() . '/js/pegasus-custom.js', array(), '', true );
		//plugins_url( 'js/slick.min.js', dirname(__FILE__) . '/../../pegasus-carousel/pegasus-carousel.php' )
		$slick_js = get_stylesheet_directory_uri() . '/js/slick.js';

		wp_enqueue_script( 'slick_js', $slick_js, array(), '', true );

	} //end function
	add_action( 'wp_enqueue_scripts', 'pegasus_child_bootstrap_js' );

	function pegasus_child_admin_scripts() {
		//wp_enqueue_style('admin-styles', get_stylesheet_directory_uri().'/css/admin.css');
	}
	//add_action('admin_enqueue_scripts', 'pegasus_child_admin_scripts');



	/* ===============================================================================================
	============================ CUSTOM POST TYPE  ==================================================
	================================================================================================*/
	add_action( 'init', 'opp_cpt_init' );
	function opp_cpt_init() {

		/*================================
		========Pets Post Type ========
		================================*/
		$opp_labels = array(
			'name' => _x('Pets', 'post type general name', 'octane-bootstrap'),
			'singular_name' => _x('Pets', 'post type singular name', 'octane-bootstrap'),
			'add_new' => _x('Add New', 'pets', 'octane-bootstrap'),
			'add_new_item' => __('Add New Pets', 'octane-bootstrap'),
			'edit_item' => __('Edit Pet', 'octane-bootstrap'),
			'new_item' => __('New Pet', 'octane-bootstrap'),
			'view_item' => __('View Pet', 'octane-bootstrap'),
			'search_items' => __('Search Pets', 'octane-bootstrap'),
			'not_found' =>  __('No pet found', 'octane-bootstrap'),
			'not_found_in_trash' => __('No pet found in Trash', 'octane-bootstrap'),
			'parent_item_colon' => '',
			'menu_name' => 'Pets'
		);
		// Some arguments and in the last line 'supports', we say to WordPress what features are supported on the Project post type
		$opp_args = array(
			'labels' => $opp_labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'query_var' => true,
			'rewrite' => true,
			/* this is important to make it so that page-portfolio.php will show when used */
			'capability_type' => 'post',
			'can_export' => true,
			 /* make sure has_archive is turned off if you plan on using page-portfolio.php */
			'has_archive' => false,
			'hierarchical' => false,
			'menu_position' => null,
			/* include this line to use global categories */
			//'taxonomies' => array('category'),
			'supports' => array('title','editor','author','thumbnail','excerpt','comments','custom-fields','page-attributes'),

		);
		// We call this function to register the custom post type
		register_post_type('pets',$opp_args);

		/*============================
		======= Portfolio Taxonomy ========
		============================*/

		// Initialize Taxonomy Labels
		$tags_labels = array(
			'name' => _x( 'Tags', 'taxonomy general name', 'pegasus-bootstrap' ),
			'singular_name' => _x( 'Tag', 'taxonomy singular name' , 'pegasus-bootstrap'),
			'search_items' =>  __( 'Search Types' , 'pegasus-bootstrap'),
			'all_items' => __( 'All Tags' , 'pegasus-bootstrap'),
			'parent_item' => __( 'Parent Tags', 'pegasus-bootstrap' ),
			'parent_item_colon' => __( 'Parent Tags:' , 'pegasus-bootstrap'),
			'edit_item' => __( 'Edit Tags', 'pegasus-bootstrap' ),
			'update_item' => __( 'Update Tags' , 'pegasus-bootstrap'),
			'add_new_item' => __( 'Add New Tags', 'pegasus-bootstrap' ),
			'new_item_name' => __( 'New Tags Name' , 'pegasus-bootstrap'),
		);

		$cats_labels = array(
			'name' => _x( 'Categories', 'taxonomy general name', 'pegasus-bootstrap' ),
			'singular_name' => _x( 'Category', 'taxonomy singular name' , 'pegasus-bootstrap'),
			'search_items' =>  __( 'Search Types' , 'pegasus-bootstrap'),
			'all_items' => __( 'All Categories' , 'pegasus-bootstrap'),
			'parent_item' => __( 'Parent Category', 'pegasus-bootstrap' ),
			'parent_item_colon' => __( 'Parent Category:' , 'pegasus-bootstrap'),
			'edit_item' => __( 'Edit Categories', 'pegasus-bootstrap' ),
			'update_item' => __( 'Update Category' , 'pegasus-bootstrap'),
			'add_new_item' => __( 'Add New Category', 'pegasus-bootstrap' ),
			'new_item_name' => __( 'New Category Name' , 'pegasus-bootstrap'),
		);

		// Register Custom Taxonomy - Tags
		register_taxonomy('pettag',array('pets'), array(
			'hierarchical' => false, // define whether to use a system like tags or categories
			'labels' => $tags_labels,
			'show_ui' => true,
			'show_admin_column'     => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'pets-tag' ),
		));

		// Register Custom Taxonomy - Category
		register_taxonomy('petcategory',array('pets'), array(
			'hierarchical' => true, // define whether to use a system like tags or categories
			'labels' => $cats_labels,
			'show_ui' => true,
			'show_admin_column'     => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'pets-category' ),
		));


		/*================================
		========REHOME Post Type ========
		================================*/
		$rehome_labels = array(
			'name' => _x('ReHome', 'post type general name', 'octane-bootstrap'),
			'singular_name' => _x('ReHome', 'post type singular name', 'octane-bootstrap'),
			'add_new' => _x('Add New', 'pets', 'octane-bootstrap'),
			'add_new_item' => __('Add New Pets', 'octane-bootstrap'),
			'edit_item' => __('Edit Pet', 'octane-bootstrap'),
			'new_item' => __('New Pet', 'octane-bootstrap'),
			'view_item' => __('View Pet', 'octane-bootstrap'),
			'search_items' => __('Search Pets', 'octane-bootstrap'),
			'not_found' =>  __('No pet found', 'octane-bootstrap'),
			'not_found_in_trash' => __('No pet found in Trash', 'octane-bootstrap'),
			'parent_item_colon' => '',
			'menu_name' => 'ReHome'
		);
		// Some arguments and in the last line 'supports', we say to WordPress what features are supported on the Project post type
		$rehome_args = array(
			'labels' => $rehome_labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'query_var' => true,
			'rewrite' => true,
			/* this is important to make it so that page-portfolio.php will show when used */
			'capability_type' => 'post',
			'can_export' => true,
			 /* make sure has_archive is turned off if you plan on using page-portfolio.php */
			'has_archive' => false,
			'hierarchical' => false,
			'menu_position' => null,
			/* include this line to use global categories */
			//'taxonomies' => array('category'),
			'supports' => array('title','editor','author','thumbnail','excerpt','comments','custom-fields','page-attributes'),

		);
		// We call this function to register the custom post type
		register_post_type('rehome',$rehome_args);

		/*============================
		======= Portfolio Taxonomy ========
		============================*/

		// Initialize Taxonomy Labels
		$rehome_tags_labels = array(
			'name' => _x( 'Tags', 'taxonomy general name', 'pegasus-bootstrap' ),
			'singular_name' => _x( 'Tag', 'taxonomy singular name' , 'pegasus-bootstrap'),
			'search_items' =>  __( 'Search Types' , 'pegasus-bootstrap'),
			'all_items' => __( 'All Tags' , 'pegasus-bootstrap'),
			'parent_item' => __( 'Parent Tags', 'pegasus-bootstrap' ),
			'parent_item_colon' => __( 'Parent Tags:' , 'pegasus-bootstrap'),
			'edit_item' => __( 'Edit Tags', 'pegasus-bootstrap' ),
			'update_item' => __( 'Update Tags' , 'pegasus-bootstrap'),
			'add_new_item' => __( 'Add New Tags', 'pegasus-bootstrap' ),
			'new_item_name' => __( 'New Tags Name' , 'pegasus-bootstrap'),
		);

		$rehome_cats_labels = array(
			'name' => _x( 'Categories', 'taxonomy general name', 'pegasus-bootstrap' ),
			'singular_name' => _x( 'Category', 'taxonomy singular name' , 'pegasus-bootstrap'),
			'search_items' =>  __( 'Search Types' , 'pegasus-bootstrap'),
			'all_items' => __( 'All Categories' , 'pegasus-bootstrap'),
			'parent_item' => __( 'Parent Category', 'pegasus-bootstrap' ),
			'parent_item_colon' => __( 'Parent Category:' , 'pegasus-bootstrap'),
			'edit_item' => __( 'Edit Categories', 'pegasus-bootstrap' ),
			'update_item' => __( 'Update Category' , 'pegasus-bootstrap'),
			'add_new_item' => __( 'Add New Category', 'pegasus-bootstrap' ),
			'new_item_name' => __( 'New Category Name' , 'pegasus-bootstrap'),
		);

		// Register Custom Taxonomy - Tags
		register_taxonomy('rehometag', array('rehome'), array(
			'hierarchical' => false, // define whether to use a system like tags or categories
			'labels' => $rehome_tags_labels,
			'show_ui' => true,
			'show_admin_column'     => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'rehome-tag' ),
		));

		// Register Custom Taxonomy - Category
		register_taxonomy('rehomecategory', array('rehome'), array(
			'hierarchical' => true, // define whether to use a system like tags or categories
			'labels' => $rehome_cats_labels,
			'show_ui' => true,
			'show_admin_column'     => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'rehome-category' ),
		));

	}



	/**
	 * Overwrite args of custom post type registered by plugin
	 */
	add_filter( 'register_post_type_args', 'change_capabilities_of_opp' , 10, 2 );

	function change_capabilities_of_opp( $args, $post_type ){

		// Do not filter any other post type
		if (
			'administrator' !== $post_type ||
			'camp_opp_counselor_admin' !== $post_type ||
			'opp_volunteer' !== $post_type
		) {
			// Give other post_types their original arguments
			return $args;
		}

		// Change the capabilities of the "course_document" post_type
		$args['capabilities'] = array(
			'edit_post' => 'edit_course_document',
			'edit_posts' => 'edit_course_documents',
			'edit_others_posts' => 'edit_other_course_documents',
			'publish_posts' => 'publish_course_documents',
			'read_post' => 'read_course_document',
			'read_private_posts' => 'read_private_course_documents',
			'delete_post' => 'delete_course_document'
		);

		// Give the course_document post type it's arguments
		return $args;

	}



	/**
	 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
	 *
	 * Be sure to replace all instances of 'yourprefix_' with your project's prefix.
	 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
	 *
	 * @category YourThemeOrPlugin
	 * @package  Demo_CMB2
	 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
	 * @link     https://github.com/WebDevStudios/CMB2
	 */
	/**
	 * Get the bootstrap! If using the plugin from wordpress.org, REMOVE THIS!
	 */

	//require_once dirname( __FILE__ ) . '/inc/cmb2/init.php';





	add_action( 'cmb2_admin_init', 'opp_register_metabox' );
	/**
	 * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
	 */
	function opp_register_metabox() {
		// Start with an underscore to hide fields from custom fields list
		$prefix = 'pets';

		/*$cmb_demo->add_field( array(
			'name' => __( 'Test Text Area for Code', 'cmb2' ),
			'desc' => __( 'field description (optional)', 'cmb2' ),
			'id'   => $prefix . 'textarea_code',
			'type' => 'textarea_code',
		) ); */


		/* $cmb_demo->add_field( array(
			'name'       => __( 'Test Text', 'cmb2' ),
			'desc'       => __( 'field description (optional)', 'cmb2' ),
			'id'         => $prefix . 'text',
			'type'       => 'text',
			//'show_on_cb' => 'yourprefix_hide_if_no_cats', // function should return a bool value
			// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
			// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
			// 'on_front'        => false, // Optionally designate a field to wp-admin only
			// 'repeatable'      => true,
		) ); */


		/* $cmb_demo->add_field( array(
			'name' => __( 'Test Title Weeeee', 'cmb2' ),
			'desc' => __( 'This is a title description', 'cmb2' ),
			'id'   => $prefix . 'title',
			'type' => 'title',
		) ); */


		/* $cmb_demo->add_field( array(
			'name' => __( 'Test Image', 'cmb2' ),
			'desc' => __( 'Upload an image or enter a URL.', 'cmb2' ),
			'id'   => $prefix . 'image',
			'type' => 'file',
		) ); */
		$cmb_demo2 = new_cmb2_box( array(
			'id'            => $prefix . 'metabox2',
			'title'         => __( 'Pets Options', 'cmb2' ),
			'object_types'  => array( 'pets', 'rehome' ), // Post type
			// 'show_on_cb' => 'yourprefix_show_if_front_page', // function should return a bool value
			// 'context'    => 'normal',
			// 'priority'   => 'high',
			// 'show_names' => true, // Show field names on the left
			// 'cmb_styles' => false, // false to disable the CMB stylesheet
			// 'closed'     => true, // true to keep the metabox closed by default
		) );
		$cmb_demo2->add_field( array(
			'name' => __( 'Video URL', 'cmb2' ),
			//'desc' => __( 'Check this box to make the page fullwidth', 'cmb2' ),
			'id'   => $prefix . '_video_url',
			'type' => 'file',
			//'default'          => 'custom',
			//'text'    => array(
				//'add_upload_file_text' => 'Add File' // Change upload button text. Default: "Add or Upload File"
			//),
		) );
		$cmb_demo2->add_field( array(
			'name' => __( 'Gender', 'cmb2' ),
			//'desc' => __( 'Check this box to make the page fullwidth', 'cmb2' ),
			'id'   => $prefix . '_gender',
			'type' => 'select',
			'default'          => 'custom',
			'options'          => array(
				'custom' => __( 'Unknown', 'cmb2' ),
				'male'   => __( 'Male', 'cmb2' ),
				'female'     => __( 'Female', 'cmb2' ),
			),
		) );
		$cmb_demo2->add_field( array(
			'name' => __( 'Size', 'cmb2' ),
			//'desc' => __( 'Check this box to make the page fullwidth', 'cmb2' ),
			'id'   => $prefix . '_size',
			'type' => 'select',
			'default'          => 'small',
			'options'          => array(
				'small' => __( 'Small', 'cmb2' ),
				'medium'   => __( 'Medium', 'cmb2' ),
				'large'     => __( 'Large', 'cmb2' ),
			),
		) );
		$cmb_demo2->add_field( array(
			'name' => __( 'Full Grown', 'cmb2' ),
			//'desc' => __( 'Check this box to make the page fullwidth', 'cmb2' ),
			'id'   => $prefix . '_grown',
			'type' => 'select',
			'default'          => 'custom',
			'options'          => array(
				'custom' => __( 'Unknown', 'cmb2' ),
				'yes'   => __( 'Yes', 'cmb2' ),
				'no'     => __( 'No', 'cmb2' ),
			),
		) );
		$cmb_demo2->add_field( array(
			'name' => __( 'Primary Breed', 'cmb2' ),
			//'desc' => __( 'Check this box to make the page fullwidth', 'cmb2' ),
			'id'   => $prefix . '_breed',
			'type' => 'text',
		) );
		$cmb_demo2->add_field( array(
			'name' => __( 'Rescued From', 'cmb2' ),
			//'desc' => __( 'Check this box to make the page fullwidth', 'cmb2' ),
			'id'   => $prefix . '_rescue',
			'type' => 'text',
			'show_on_cb' => function( $cmb ) {
				// Hide this field for the 'rehome' post type
				if ( isset( $_GET['post'] ) ) {
					$post_id = $_GET['post'];
					return get_post_type( $post_id ) !== 'rehome';
				} elseif ( isset( $_GET['post_type'] ) && $_GET['post_type'] === 'rehome' ) {
					return false;
				}
				return true;
			},
		) );
		$cmb_demo2->add_field( array(
			'name' => __( 'Good With Other Dogs', 'cmb2' ),
			//'desc' => __( 'Check this box to make the page fullwidth', 'cmb2' ),
			'id'   => $prefix . '_friendly_to_dogs',
			'type' => 'select',
			'default'          => 'custom',
			'options'          => array(
				'custom' => __( 'Unknown', 'cmb2' ),
				'yes'   => __( 'Yes', 'cmb2' ),
				'no'     => __( 'No', 'cmb2' ),
			),
		) );
		$cmb_demo2->add_field( array(
			'name' => __( 'Good With Other Cats', 'cmb2' ),
			//'desc' => __( 'Check this box to make the page fullwidth', 'cmb2' ),
			'id'   => $prefix . '_friendly_to_cats',
			'type' => 'select',
			'default'          => 'custom',
			'options'          => array(
				'custom' => __( 'Unknown', 'cmb2' ),
				'yes'   => __( 'Yes', 'cmb2' ),
				'no'     => __( 'No', 'cmb2' ),
			),
		) );
		$cmb_demo2->add_field( array(
			'name' => __( 'Good With Other Children', 'cmb2' ),
			//'desc' => __( 'Check this box to make the page fullwidth', 'cmb2' ),
			'id'   => $prefix . '_friendly_to_child',
			'type' => 'select',
			'default'          => 'custom',
			'options'          => array(
				'custom' => __( 'Unknown', 'cmb2' ),
				'yes'   => __( 'Yes', 'cmb2' ),
				'no'     => __( 'No', 'cmb2' ),
			),
		) );
		$cmb_demo2->add_field( array(
			'name' => __( 'House Trained', 'cmb2' ),
			//'desc' => __( 'Check this box to make the page fullwidth', 'cmb2' ),
			'id'   => $prefix . '_house_trained',
			'type' => 'select',
			'default'          => 'custom',
			'options'          => array(
				'custom' => __( 'Unknown', 'cmb2' ),
				'yes'   => __( 'Yes', 'cmb2' ),
				'no'     => __( 'No', 'cmb2' ),
			),
		) );

		// Conditional field only for 'rehome' post type
		$cmb_demo2->add_field( array(
			'name' => __( 'Contact Information', 'cmb2' ),
			'id'   => $prefix . '_contact_info',
			'type' => 'wysiwyg',
			'show_on_cb' => 'show_if_rehome_post_type', // Use a callback function
		) );


	}



	function show_if_rehome_post_type( $cmb ) {
		if ( isset( $_GET['post'] ) ) {
			$post_id = $_GET['post'];
			return get_post_type( $post_id ) === 'rehome';
		} elseif ( isset( $_GET['post_type'] ) && $_GET['post_type'] === 'rehome' ) {
			return true;
		}
		return false;
	}

	add_action( 'cmb2_admin_init', 'opp_register_gallery_metabox' );

	function opp_register_gallery_metabox() {
		$prefix = 'pets_';

		$cmb_gallery = new_cmb2_box( array(
			'id'            => $prefix . 'gallery_metabox',
			'title'         => __( 'Gallery Images', 'cmb2' ),
			'object_types'  => array( 'pets', 'rehome' ), // Apply to both post types
			'priority'      => 'high',
		) );

		// Create a repeatable group field for gallery images
		$gallery_group = $cmb_gallery->add_field( array(
			'id'         => $prefix . 'gallery',
			'type'       => 'group',
			'repeatable' => true,
			'options'    => array(
				'group_title'   => 'Image #{#}',  // Dynamic title
				'add_button'    => 'Add Another Image',
				'remove_button' => 'Remove Image',
				'sortable'      => true,
				'closed'        => true,  // Start closed by default
			),
		) );

		// Image field inside the repeatable group
		$cmb_gallery->add_group_field( $gallery_group, array(
			'name' => __( 'Gallery Image', 'cmb2' ),
			'id'   => 'image',
			'type' => 'file',
			'preview_size' => 'thumbnail', // Show preview in WP Admin
			'query_args'   => array(
				'type' => array( 'image/jpeg', 'image/png', 'image/gif' ), // Allow only images
			),
		) );

		// Optional: Alt text field
		$cmb_gallery->add_group_field( $gallery_group, array(
			'name' => __( 'Alt Text', 'cmb2' ),
			'id'   => 'alt_text',
			'type' => 'text',
		) );

		// Optional: Caption field
		$cmb_gallery->add_group_field( $gallery_group, array(
			'name' => __( 'Caption', 'cmb2' ),
			'id'   => 'caption',
			'type' => 'text',
		) );
	}



	/**
	 * function disable_password_reset() { return false; }
	 * add_filter ( 'allow_password_reset', 'disable_password_reset' );
	**/

	/** Functions to support woocommerce */
	/** @Hide quantity in product detail using CSS */
	/*
	function hide_quantity_using_css() {
		if ( is_product() ) {
			global $product;
			$product_id = $product->get_id();
			if (has_term('Camp OPP', 'product_cat', $product_id)){
				?>
					<style type="text/css">.quantity, .buttons_added { width:0; height:0; display: none; visibility: hidden; }</style>
				<?php
			}
			if (has_term('Long Distance Love', 'product_cat', $product_id)){
				?>
					<style type="text/css">.quantity, .buttons_added { width:0; height:0; display: none; visibility: hidden; }</style>
				<?php
			}
		}
	}
	add_action( 'wp_head', 'hide_quantity_using_css' );
	
	*/

	add_filter( 'woocommerce_quantity_input_args', 'hide_quantity_input_field', 20, 2 );
	function hide_quantity_input_field( $args, $product ) {
		// Here set your product categories in the array (can be either an ID, a slug, a name or an array)
		$categories = array('Camp OPP');

		// Handling product variation
		$the_id = $product->is_type('variation') ? $product->get_parent_id() : $product->get_id();

		// Only on cart page for a specific product category
		if( is_cart() && has_term( $categories, 'product_cat', $the_id ) ){
			$input_value = $args['input_value'];
			$args['min_value'] = $args['max_value'] = $input_value;
		}
		return $args;
	}

	 /**
	 Remove all possible fields
	 **/
	function wc_remove_checkout_fields( $fields ) {

		// Billing fields
		unset( $fields['billing']['billing_company'] );
		unset( $fields['billing']['billing_state'] );
		unset( $fields['billing']['billing_address_1'] );
		unset( $fields['billing']['billing_address_2'] );
		unset( $fields['billing']['billing_city'] );
		unset( $fields['billing']['billing_postcode'] );

		// Shipping fields
		unset( $fields['shipping']['shipping_company'] );
		unset( $fields['shipping']['shipping_phone'] );
		unset( $fields['shipping']['shipping_state'] );
		unset( $fields['shipping']['shipping_first_name'] );
		unset( $fields['shipping']['shipping_last_name'] );
		unset( $fields['shipping']['shipping_address_1'] );
		unset( $fields['shipping']['shipping_address_2'] );
		unset( $fields['shipping']['shipping_city'] );
		unset( $fields['shipping']['shipping_postcode'] );

		// Order fields
		/** unset( $fields['order']['order_comments'] );**/

		return $fields;
	}
	add_filter( 'woocommerce_checkout_fields', 'wc_remove_checkout_fields' );

	add_action('wp_logout','ps_redirect_after_logout');
	function ps_redirect_after_logout(){
			 wp_redirect( 'https://opp.ourpalsplace.org' );
			 exit();
	}

	add_filter( 'woocommerce_valid_order_statuses_for_cancel', 'custom_valid_order_statuses_for_cancel', 10, 2 );
	function custom_valid_order_statuses_for_cancel( $statuses, $order ){

		// Set HERE the order statuses where you want the cancel button to appear
		$custom_statuses    = array( 'completed', 'pending', 'processing', 'on-hold', 'failed' );

		// Set HERE the delay (in days)
		$duration = 3; // 3 days

		// UPDATE: Get the order ID and the WC_Order object
		if( isset($_GET['order_id'])) {
			$order = wc_get_order( absint( $_GET['order_id'] ) );

			$delay = $duration*24*60*60; // (duration in seconds)
			$date_created_time  = strtotime($order->get_date_created()); // Creation date time stamp
			$date_modified_time = strtotime($order->get_date_modified()); // Modified date time stamp
			$now = strtotime("now"); // Now  time stamp

			// Using Creation date time stamp
			if ( ( $date_created_time + $delay ) >= $now ) return $custom_statuses;
			else return $statuses;
		}
	}

	/** Gravity forms for product Plugin function **/
	add_filter( 'woocommerce_gforms_strip_meta_html', 'configure_woocommerce_gforms_strip_meta_html' );
	function configure_woocommerce_gforms_strip_meta_html( $strip_html ) {
		$strip_html = false;
		return $strip_html;
	}
	add_filter( 'woocommerce_get_availability', 'wcs_custom_get_availability', 1, 2);
	function wcs_custom_get_availability( $availability, $_product ) {

		// Change In Stock Text
		if ( $_product->is_in_stock() ) {
			$availability['availability'] = __('Available!', 'woocommerce');
		}
		// Change Out of Stock Text
		if ( ! $_product->is_in_stock() ) {
			$availability['availability'] = __('Sold Out', 'woocommerce');
		}
		return $availability;
	}



	add_action( 'admin_init', 'my_remove_menu_pages' );
	function my_remove_menu_pages() {

		//global $current_user;
		//$user_id = get_current_user_id();
		//if( is_admin() && (  ) ){
		//your codes
		//}

		global $user_ID;

		//echo gettype($user_ID);

		if ( $user_ID === 8 ) { //jimbo




		}

		if ( $user_ID === 102 ) { //sophie
			remove_menu_page('gf_edit_forms');
			remove_menu_page('plugins.php');
			remove_menu_page('edit.php?post_type=woocustomemails');
			remove_menu_page('edit.php'); // Posts
			remove_menu_page('upload.php'); // Media
			remove_menu_page('link-manager.php'); // Links
			remove_menu_page('edit-comments.php');

			remove_menu_page('wc-admin'); //woocustomemails
			remove_menu_page('edit.php?post_type=wc-donation');
			remove_menu_page('woocommerce');
			remove_menu_page('edit.php?post_type=product');
			remove_menu_page('wp-mail-smtp');


			remove_menu_page('octane_plugin_options');
			remove_menu_page('lty_lottery');
			remove_menu_page('pegasus_options');



			//remove_menu_page('wp-mail-smtp');
			remove_menu_page('jetpack');
		}
	}
	
	
	/**
	 * VQD Home Slider via CMB2 (no JSON)
	 * - Visible only on post ID 2 or pages using template named "Home Template"
	 * - Repeatable slides: image (media upload), alignment, optional slide class, WYSIWYG content
	 * - Shortcode: [vqd_home_slider] or [vqd_home_slider id="123"]
	 */

	/**
	 * Helper: sanitize multiple classes safely.
	 */
	function vqd_sanitize_classes($class_string) {
		$classes = preg_split('/\s+/', (string) $class_string, -1, PREG_SPLIT_NO_EMPTY);
		$clean   = array_map('sanitize_html_class', $classes);
		return trim(implode(' ', array_filter($clean)));
	}

	/**
	 * Show-on callback: Only show box on post ID 2 OR when page template is "Home Template".
	 */
	function vqd_slider_show_on_home_cb( $cmb ) {
		$post_id = 0;
		if (isset($_GET['post'])) {
			$post_id = (int) $_GET['post'];
		} elseif (isset($_POST['post_ID'])) {
			$post_id = (int) $_POST['post_ID'];
		}
		
		if ( ! $post_id ) return false;

		// Condition 1: Exactly post ID 2
		if ( $post_id === 2 ) return true;

		// Condition 2: Page uses a template whose label is "Home Template"
		$template_slug = get_page_template_slug( $post_id ); // e.g. "templates/home-template.php"
		if ( $template_slug ) {
			// Common fallbacks by filename
			$allowed_slugs = [
				'home-template.php',
				'tpl_home.php',
				'template-home.php',
				'page-home.php',
				'front-page.php',
				'templates/home-template.php',
				'templates/home.php',
			];
			if ( in_array( $template_slug, $allowed_slugs, true ) ) {
				return true;
			}

			// Resolve by *display name* "Home Template" if theme exposes it
			$templates_map = wp_get_theme()->get_page_templates( get_post( $post_id ), 'page' ); // [file => "Name"]
			if ( isset($templates_map[$template_slug]) && $templates_map[$template_slug] === 'Home Template' ) {
				return true;
			}
		}

		return false;
	}

	/**
	 * Register CMB2 box + fields.
	 */
	add_action('cmb2_admin_init', function () {
		$prefix = 'vqd_slider_';

		$cmb = new_cmb2_box([
			'id'           => $prefix . 'box',
			'title'        => __('Hero Slider', 'vqd'),
			'object_types' => ['page'],            // homepage/page only
			'show_on_cb'   => 'vqd_slider_show_on_home_cb', // limit to ID 2 or "Home Template"
		]);

		$group_field_id = $cmb->add_field([
			'id'          => $prefix . 'slides',
			'type'        => 'group',
			'description' => __('Add slides for the homepage hero slider.', 'vqd'),
			'options'     => [
				'group_title'   => __('Slide {#}', 'vqd'),
				'add_button'    => __('Add Slide', 'vqd'),
				'remove_button' => __('Remove Slide', 'vqd'),
				'sortable'      => true,
				'closed'       => true,
			],
		]);

		// Image: media upload (single)
		$cmb->add_group_field($group_field_id, [
			'name'       => __('Slide Image', 'vqd'),
			'id'         => 'image',
			'type'       => 'file',
			'desc'       => __('Upload/select the slide image.', 'vqd'),
			'options'    => [
				'url' => true, // hide the text URL field; value will still be the URL
			],
			'query_args' => [
				'type' => ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/avif'],
			],
			'preview_size' => [200, 120],
		]);

		// Alignment class
		$cmb->add_group_field($group_field_id, [
			'name'    => __('Text Alignment', 'vqd'),
			'id'      => 'align',
			'type'    => 'radio_inline',
			'options' => [
				'pull-left'  => __('pull-left', 'vqd'),
				'pull-right' => __('pull-right', 'vqd'),
				'top-center' => __('top-center', 'vqd'),
			],
			'default' => 'top-center',
			'desc'    => __('Applies to the .home-slider-text container.', 'vqd'),
		]);

		// Optional extra class on [slide]
		$cmb->add_group_field($group_field_id, [
			'name' => __('Extra Slide Class (optional)', 'vqd'),
			'id'   => 'slide_class',
			'type' => 'text',
			'desc' => __('Added as class="..." on the [slide] shortcode wrapper.', 'vqd'),
		]);

		// WYSIWYG content for the slide
		$cmb->add_group_field($group_field_id, [
			'name'    => __('Slide Content', 'vqd'),
			'id'      => 'content',
			'type'    => 'wysiwyg',
			'options' => [
				'media_buttons' => true,
				'textarea_rows' => 8,
				'teeny'         => false,
				'wpautop'       => true,
			],
			'desc'    => __('Content inside the .home-slider-text container (headings, buttons, etc.).', 'vqd'),
		]);
	});

	/**
	 * Build the [slider]... string from CMB2 slides.
	 */
	function vqd_build_slider_shortcode_from_meta( $post_id ): string {
		$slides = get_post_meta( $post_id, 'vqd_slider_slides', true );
		if ( ! is_array($slides) || empty($slides) ) {
			return '';
		}

		$allowed_align = ['pull-left', 'pull-right', 'top-center'];
		$sc = '[slider]';
		$i  = 1;

		foreach ( $slides as $slide ) {
			// Image URL from CMB2 'file' field (can be URL or array depending on config)
			$img = '';
			if ( ! empty( $slide['image'] ) ) {
				$img = is_array($slide['image'])
					? ( isset($slide['image']['url']) ? esc_url($slide['image']['url']) : '' )
					: esc_url($slide['image']);
			}

			$align = ( isset($slide['align']) && in_array($slide['align'], $allowed_align, true) )
				? $slide['align'] : 'top-center';

			$slide_class_raw = isset($slide['slide_class']) ? $slide['slide_class'] : '';
			$slide_class     = vqd_sanitize_classes($slide_class_raw);

			$content = isset($slide['content']) ? $slide['content'] : '';
			$content = wp_kses_post( $content );

			$sc .= $slide_class ? '[slide class="' . $slide_class . '"]' : '[slide]';

			$sc .= '<div class="p-relative slide-' . intval($i) . '">';
			$sc .= '<div class="home-slider-text ' . esc_attr($align) . '">';
			$sc .= $content; // already kses-sanitized
			$sc .= '</div>';

			if ( $img ) {
				$sc .= '<img class="alignnone size-full" src="' . $img . '" />';
			}

			$sc .= '</div>'; // .p-relative
			$sc .= '[/slide]';

			$i++;
		}

		$sc .= '[/slider]';
		return $sc;
	}

	/**
	 * Shortcode: [vqd_home_slider] or [vqd_home_slider id="123"]
	 */
	add_shortcode('vqd_home_slider', function( $atts ) {
		$atts = shortcode_atts([
			'id' => '', // optional: render slider from a specific page ID
		], $atts, 'vqd_home_slider');

		$post_id = ! empty($atts['id']) ? intval($atts['id']) : get_the_ID();
		if ( ! $post_id ) return '';

		$shortcode_str = vqd_build_slider_shortcode_from_meta( $post_id );
		if ( '' === $shortcode_str ) return '';

		return do_shortcode( $shortcode_str );
	});
