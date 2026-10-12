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

		wp_enqueue_script( 'matchHeight_js', get_stylesheet_directory_uri() . '/js/matchHeight.js', array(), '', true );


	} //end function
	add_action( 'wp_enqueue_scripts', 'pegasus_child_bootstrap_js' );
	
	add_action('init', 'vine_and_vision_register_directory_cpt');
	function vine_and_vision_register_directory_cpt() {
		$labels = array(
			'name'               => _x('Directory', 'post type general name', 'pegasus-bootstrap'),
			'singular_name'      => _x('Directory Entry', 'post type singular name', 'pegasus-bootstrap'),
			'menu_name'          => _x('Directory', 'admin menu', 'pegasus-bootstrap'),
			'name_admin_bar'     => _x('Directory Entry', 'add new on admin bar', 'pegasus-bootstrap'),
			'add_new'            => _x('Add New', 'directory entry', 'pegasus-bootstrap'),
			'add_new_item'       => __('Add New Directory Entry', 'pegasus-bootstrap'),
			'new_item'           => __('New Directory Entry', 'pegasus-bootstrap'),
			'edit_item'          => __('Edit Directory Entry', 'pegasus-bootstrap'),
			'view_item'          => __('View Directory Entry', 'pegasus-bootstrap'),
			'all_items'          => __('All Directory Entries', 'pegasus-bootstrap'),
			'search_items'       => __('Search Directory Entries', 'pegasus-bootstrap'),
			'parent_item_colon'  => __('Parent Entry:', 'pegasus-bootstrap'),
			'not_found'          => __('No directory entries found.', 'pegasus-bootstrap'),
			'not_found_in_trash' => __('No directory entries found in Trash.', 'pegasus-bootstrap'),
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array('slug' => 'directory'),
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array('title', 'editor', 'thumbnail', 'custom-fields')
		);

		register_post_type('directory', $args);
	}
	
	add_action('init', 'register_directory_taxonomies');

	function register_directory_taxonomies() {
		// Initialize Taxonomy Labels for Directory Tags
		$directory_tags_labels = array(
			'name'              => _x( 'Tags', 'taxonomy general name', 'pegasus-bootstrap' ),
			'singular_name'     => _x( 'Tag', 'taxonomy singular name', 'pegasus-bootstrap' ),
			'search_items'      => __( 'Search Tags', 'pegasus-bootstrap' ),
			'all_items'         => __( 'All Tags', 'pegasus-bootstrap' ),
			'parent_item'       => __( 'Parent Tag', 'pegasus-bootstrap' ),
			'parent_item_colon' => __( 'Parent Tag:', 'pegasus-bootstrap' ),
			'edit_item'         => __( 'Edit Tag', 'pegasus-bootstrap' ),
			'update_item'       => __( 'Update Tag', 'pegasus-bootstrap' ),
			'add_new_item'      => __( 'Add New Tag', 'pegasus-bootstrap' ),
			'new_item_name'     => __( 'New Tag Name', 'pegasus-bootstrap' ),
			'menu_name'         => __( 'Tags', 'pegasus-bootstrap' ),
		);

		// Initialize Taxonomy Labels for Directory Categories
		$directory_categories_labels = array(
			'name'              => _x( 'Categories', 'taxonomy general name', 'pegasus-bootstrap' ),
			'singular_name'     => _x( 'Category', 'taxonomy singular name', 'pegasus-bootstrap' ),
			'search_items'      => __( 'Search Categories', 'pegasus-bootstrap' ),
			'all_items'         => __( 'All Categories', 'pegasus-bootstrap' ),
			'parent_item'       => __( 'Parent Category', 'pegasus-bootstrap' ),
			'parent_item_colon' => __( 'Parent Category:', 'pegasus-bootstrap' ),
			'edit_item'         => __( 'Edit Category', 'pegasus-bootstrap' ),
			'update_item'       => __( 'Update Category', 'pegasus-bootstrap' ),
			'add_new_item'      => __( 'Add New Category', 'pegasus-bootstrap' ),
			'new_item_name'     => __( 'New Category Name', 'pegasus-bootstrap' ),
			'menu_name'         => __( 'Categories', 'pegasus-bootstrap' ),
		);

		// Register Custom Taxonomy for Directory Tags
		register_taxonomy('directory_tags', array('directory'), array(
			'hierarchical'      => false,
			'labels'            => $directory_tags_labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array('slug' => 'directory-tags'),
		));

		// Register Custom Taxonomy for Directory Categories
		register_taxonomy('directory_categories', array('directory'), array(
			'hierarchical'      => true,
			'labels'            => $directory_categories_labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array('slug' => 'directory-categories'),
		));
	}
	
	
	add_action('cmb2_admin_init', 'vine_and_vision_directory_metabox');
	function vine_and_vision_directory_metabox() {
		$prefix = 'vv_directory_';

		$directory_metabox = new_cmb2_box(array(
			'id'           => $prefix . 'metabox',
			'title'        => __('Directory Info', 'pegasus-bootstrap'),
			'object_types' => array('directory'),
			'priority'     => 'high',
		));

		$directory_metabox->add_field(array(
			'name' => __('Company Name', 'pegasus-bootstrap'),
			'id'   => $prefix . 'company_name',
			'type' => 'text',
		));

		$directory_metabox->add_field(array(
			'name' => __('Company Logo', 'pegasus-bootstrap'),
			'id'   => $prefix . 'company_logo',
			'type' => 'file',
		));

		$directory_metabox->add_field(array(
			'name' => __('Company Website', 'pegasus-bootstrap'),
			'id'   => $prefix . 'company_website',
			'type' => 'text_url',
		));

		$directory_metabox->add_field(array(
			'name' => __('Contact Info', 'pegasus-bootstrap'),
			'id'   => $prefix . 'contact',
			'type' => 'text',
		));

		$directory_metabox->add_field(array(
			'name' => __('Email', 'pegasus-bootstrap'),
			'id'   => $prefix . 'email',
			'type' => 'text_email',
		));
	}

	add_filter('manage_directory_posts_columns', 'vv_directory_columns');
	function vv_directory_columns($columns) {
		$columns['vv_shortcode'] = __('Shortcode', 'pegasus-bootstrap');
		return $columns;
	}

	add_action('manage_directory_posts_custom_column', 'vv_directory_custom_column', 10, 2);
	function vv_directory_custom_column($column, $post_id) {
		if ($column === 'vv_shortcode') {
			echo '<code>[vv_directory id="' . $post_id . '"]</code>';
		}
	}

	