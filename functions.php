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
		wp_enqueue_style('odor-css', get_stylesheet_directory_uri() . '/css/style.css', null, false, false);
		wp_enqueue_style('swiper-css', get_stylesheet_directory_uri() . '/css/swiper-bundle.min.css', null, false, false);

		wp_enqueue_style('lightbox-css', get_stylesheet_directory_uri() . '/css/lightbox.min.css', null, false, false);



	}
	add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

	/**
	* Proper way to enqueue JS
	*/
	function pegasus_child_bootstrap_js() {

		wp_enqueue_script( 'pegasus_child_custom_js', get_stylesheet_directory_uri() . '/js/pegasus-custom.js', array(), '', true );

		wp_enqueue_script( 'swiper_js', get_stylesheet_directory_uri() . '/js/swiper-bundle.min.js', array(), '', true );

		wp_enqueue_script( 'counter_js', get_stylesheet_directory_uri() . '/js/jquery.counterup.min.js', array(), '', true );


		wp_enqueue_script( 'isotope_js', get_stylesheet_directory_uri() . '/js/isotope.pkgd.min.js', array(), '', true );


		//wp_enqueue_script( 'masonry_js', get_stylesheet_directory_uri() . '/js/masonry.js', array(), '', true );

		wp_enqueue_script( 'match_height_js', get_stylesheet_directory_uri() . '/js/matchHeight.js', array(), '', true );

		wp_enqueue_script( 'packery_js', get_stylesheet_directory_uri() . '/js/packery.min.js', array(), '', true );

		wp_enqueue_script( 'images_loaded_js', get_stylesheet_directory_uri() . '/js/imagesLoaded.js', array(), '', true );

		wp_enqueue_script( 'lightbox_js', get_stylesheet_directory_uri() . '/js/lightbox.min.js', array(), '', true );


		wp_enqueue_script( 'odor_js', get_stylesheet_directory_uri() . '/js/script.js', array(), '', true );

		//wp_enqueue_script( 'pace_js', get_stylesheet_directory_uri() . '/js/pace.min.js', array(), '', true );


	} //end function
	add_action( 'wp_enqueue_scripts', 'pegasus_child_bootstrap_js' );

	/*============================
	======= Card Sets Post Type =======
	============================*/

	$card_sets_labels = array(
		'name' => _x('Card Sets', 'card sets general name', 'pegasus-bootstrap'),
		'singular_name' => _x('Card Set', 'card sets singular name', 'pegasus-bootstrap'),
		'add_new' => _x('Add New', 'card set', 'pegasus-bootstrap'),
		'add_new_item' => __('Add New Card Set', 'pegasus-bootstrap'),
		'edit_item' => __('Edit Card Set', 'pegasus-bootstrap'),
		'new_item' => __('New Card Set', 'pegasus-bootstrap'),
		'view_item' => __('View Card Set', 'pegasus-bootstrap'),
		'search_items' => __('Search Card Sets', 'pegasus-bootstrap'),
		'not_found' =>  __('No card sets found', 'pegasus-bootstrap'),
		'not_found_in_trash' => __('No card sets found in Trash', 'pegasus-bootstrap'),
		'parent_item_colon' => '',
		'menu_name' => 'Card Sets'
	);

	$card_sets_args = array(
		'labels' => $card_sets_labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'can_export' => true,
		'has_archive' => false,
		'rewrite' => array('slug' => 'card-sets'),
		'hierarchical' => true,
		'menu_position' => null,
		'supports' => array('title', 'thumbnail', 'comments', 'editor', 'permalink', 'custom-fields' )
	);

	register_post_type('card_sets', $card_sets_args);

	remove_post_type_support('card_sets', 'author', 'excerpt', 'trackbacks');


	// Initialize Taxonomy Labels for Tags
	$tags_labels = array(
		'name' => _x( 'Tags', 'taxonomy general name', 'pegasus-bootstrap' ),
		'singular_name' => _x( 'Tag', 'taxonomy singular name', 'pegasus-bootstrap'),
		'search_items' =>  __( 'Search Tags', 'pegasus-bootstrap'),
		'all_items' => __( 'All Tags', 'pegasus-bootstrap'),
		'parent_item' => __( 'Parent Tag', 'pegasus-bootstrap' ),
		'parent_item_colon' => __( 'Parent Tag:', 'pegasus-bootstrap'),
		'edit_item' => __( 'Edit Tag', 'pegasus-bootstrap' ),
		'update_item' => __( 'Update Tag', 'pegasus-bootstrap'),
		'add_new_item' => __( 'Add New Tag', 'pegasus-bootstrap' ),
		'new_item_name' => __( 'New Tag Name', 'pegasus-bootstrap'),
		'menu_name' => __( 'Tags', 'pegasus-bootstrap'),
	);

	// Initialize Taxonomy Labels for Categories
	$cats_labels = array(
		'name' => _x( 'Categories', 'taxonomy general name', 'pegasus-bootstrap' ),
		'singular_name' => _x( 'Category', 'taxonomy singular name', 'pegasus-bootstrap'),
		'search_items' =>  __( 'Search Categories', 'pegasus-bootstrap'),
		'all_items' => __( 'All Categories', 'pegasus-bootstrap'),
		'parent_item' => __( 'Parent Category', 'pegasus-bootstrap' ),
		'parent_item_colon' => __( 'Parent Category:', 'pegasus-bootstrap'),
		'edit_item' => __( 'Edit Category', 'pegasus-bootstrap' ),
		'update_item' => __( 'Update Category', 'pegasus-bootstrap'),
		'add_new_item' => __( 'Add New Category', 'pegasus-bootstrap' ),
		'new_item_name' => __( 'New Category Name', 'pegasus-bootstrap'),
		'menu_name' => __( 'Categories', 'pegasus-bootstrap'),
	);

	// Register Custom Taxonomy for Tags
	register_taxonomy('card_set_tags', array('card_sets'), array(
		'hierarchical' => false, // Tags are not hierarchical
		'labels' => $tags_labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'card-set-tags'),
	));

	// Register Custom Taxonomy for Categories
	register_taxonomy('card_set_categories', array('card_sets'), array(
		'hierarchical' => true, // Categories are hierarchical
		'labels' => $cats_labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'card-set-categories'),
	));


	//function remove_yoast_metabox_card_sets() {
		//remove_meta_box('wpseo_meta', 'card_sets', 'normal');
	//}
	//add_action('add_meta_boxes', 'remove_yoast_metabox_card_sets', 11);




	add_action('cmb2_admin_init', 'pegasus_card_sets_metabox' );

	function pegasus_card_sets_metabox() {
		$prefix = 'pegasus_card_sets_';

		$card_sets_metabox = new_cmb2_box(
			array(
				'id'           => $prefix . 'content',
				'title'        => __('Card Set Fields', 'pegasus-bootstrap'),
				'object_types' => array('card_sets'),
				'priority'     => 'high',
			)
		);


		$card_sets_metabox->add_field( array(
			'name' => __( 'Home Page Image', 'pegasus-bootstrap' ),
			'desc' => __( 'Image to display on the homepage.', 'pegasus-bootstrap' ),
			'id'   => $prefix . 'alt_image',
			'type' => 'file',
		) );

		$card_sets_metabox->add_field( array(
			'name' => __( 'Home Page Caption', 'pegasus-bootstrap' ),
			'desc' => __( 'Text / Headline to display on the homepage.', 'pegasus-bootstrap' ),
			'id'   => $prefix . 'alt_title',
			'type' => 'text',
		) );

		$card_sets_group_fields = $card_sets_metabox->add_field(
			array(
				'id'         => $prefix . 'cards',
				'type'       => 'group',
				'repeatable' => true,
				'options'    => array(
					'group_title'   => 'Card #{#}',
					'add_button'    => 'Add Another Card',
					'remove_button' => 'Remove Card',
					'sortable'      => true,
					'closed'        => true,
				),
			)
		);

		$card_sets_metabox->add_group_field(
			$card_sets_group_fields, array(
				'name' => 'Title',
				'id'   => $prefix . 'title',
				'type' => 'text',
			)
		);

		$card_sets_metabox->add_group_field(
			$card_sets_group_fields, array(
				'name' => 'Card Image',
				'id'   => $prefix . 'image',
				'type' => 'file',
			)
		);

		$card_sets_metabox->add_group_field(
			$card_sets_group_fields, array(
				'name' => 'Alt Text',
				'id'   => $prefix . 'alt_text',
				'type' => 'text',
			)
		);

		$card_sets_metabox->add_group_field(
			$card_sets_group_fields, array(
				'name' => 'Caption',
				'id'   => $prefix . 'caption',
				'type' => 'text',
			)
		);
	}

	// Make new custom column
	add_filter('manage_card_sets_posts_columns', 'posts_columns_id', 5);
	function posts_columns_id($defaults) {
		$defaults['pegasus_shortcode_id'] = __('Shortcode');
		return $defaults;
	}

	// Add content to new custom column
	add_action('manage_card_sets_posts_custom_column', 'posts_custom_id_columns', 5, 2);
	function posts_custom_id_columns($column, $post_id) {
		switch ($column) {
			case 'pegasus_shortcode_id':
				echo '<pre><code>[pegasus_card_set id="' . $post_id . '" ]</code></pre>';
				break;
		}
	}

	// Make custom column sortable
	add_filter('manage_edit-card_sets_sortable_columns', 'itsg_add_custom_column_make_sortable');
	function itsg_add_custom_column_make_sortable($columns) {
		$columns['usefulness'] = 'usefulness';
		return $columns;
	}

	// Handle the custom column sorting
	add_action('load-edit.php', 'itsg_add_custom_column_sort_request');
	function itsg_add_custom_column_sort_request() {
		add_filter('request', 'itsg_add_custom_column_do_sortable');
	}

	function itsg_add_custom_column_do_sortable($vars) {
		if ( isset( $vars['post_type'] ) && 'card_sets' == $vars['post_type'] ) {
			if ( isset($vars['orderby'] ) && 'usefulness' == $vars['orderby'] ) {
				$vars = array_merge(
					$vars,
					array(
						'meta_key' => '_ht_kb_usefulness',
						'orderby'  => 'meta_value_num',
					)
				);
			}
		}

		return $vars;
	}

	/*~~~~~~~~~~~~~~~~~~~~
		CARD SET SHORTCODE
	~~~~~~~~~~~~~~~~~~~~~*/
	// [pegasus_card_set id="5"]
	function pegasus_card_set_query_shortcode($atts) {
		$a = shortcode_atts(array(
			"id" => ''
		), $atts);

		// Construct the query for the custom post type
		$the_query = 'post_type=card_sets&p=' . $atts['id'];

		// Query the post
		query_posts($the_query);

		// Reset and setup variables
		global $post;
		$output = '';
		$the_id = '';

		// The loop
		if (have_posts()) : while (have_posts()) : the_post();

			$the_id = get_the_ID();
			$cards = get_post_meta($the_id, 'pegasus_card_sets_cards', true);

			if (!empty($cards)) {
				foreach ((array) $cards as $key => $card) {
					$prefix = 'pegasus_card_sets_';

					$card_title = isset($card[$prefix . 'title']) ? esc_html($card[$prefix . 'title']) : '';
					$card_image = isset($card[$prefix . 'image']) ? esc_url($card[$prefix . 'image']) : '';
					$card_alt_text = isset($card[$prefix . 'alt_text']) ? esc_attr($card[$prefix . 'alt_text']) : '';
					$card_caption = isset($card[$prefix . 'caption']) ? esc_html($card[$prefix . 'caption']) : '';

					$output .= "<div class='card-set-item'>";
					if ($card_image) {
						$output .= '<img class="card-set-img" src="' . $card_image . '" alt="' . $card_alt_text . '">';
					}
					if ($card_title) {
						$output .= '<h3 class="card-set-title">' . $card_title . '</h3>';
					}
					if ($card_caption) {
						$output .= '<p class="card-set-caption">' . $card_caption . '</p>';
					}
					$output .= "</div>";
				} // End foreach
			}

		endwhile; else:
			$output .= "No cards found.";
		endif;

		wp_reset_query();

		// Optional: Add enqueued styles/scripts if required
		//wp_enqueue_style('pegasus-card-set-css');
		//wp_enqueue_script('pegasus-card-set-js');

		return '<div class="card-set-wrapper">' . $output . '</div>';
	}
	add_shortcode("pegasus_card_set", "pegasus_card_set_query_shortcode");
	/*
	function register_query_vars( $vars ) {
		$vars[] = 'card-sets'; // Add card_set_slug to the list of valid query vars
		$vars[] = 'card_sets'; // Add card_set_slug to the list of valid query vars
		$vars[] = 'Card_sets'; // Add card_set_slug to the list of valid query vars
		return $vars;
	}
	add_filter( 'query_vars', 'register_query_vars' );
	*/









	add_filter('woocommerce_variation_is_visible', 'hide_out_of_stock_variations', 10, 4);

	function hide_out_of_stock_variations($visible, $variation_id, $variable_product, $variation) {
		// Get the variation object
		$variation_obj = wc_get_product($variation_id);

		// Check if stock management is enabled for this variation
		if ($variation_obj->managing_stock()) {
			// If stock quantity is 0 or less, hide this variation
			if ($variation_obj->get_stock_quantity() <= 0) {
				return false;
			}
		}

		return $visible;
	}

	// Additionally filter attribute options that would lead to out-of-stock variations
	add_filter('woocommerce_dropdown_variation_attribute_options_args', 'filter_out_of_stock_attributes', 10, 1);

	function filter_out_of_stock_attributes($args) {
		global $product;

		// Only apply to variable products
		if (!$product->is_type('variable')) {
			return $args;
		}

		// Get all available variations
		$variations = $product->get_available_variations();
		$filtered_options = [];

		// Current attribute being processed
		$current_attribute = sanitize_title($args['attribute']);

		foreach ($variations as $variation) {
			// Get the variation product
			$variation_obj = wc_get_product($variation['variation_id']);

			// Skip if variation has zero stock
			if ($variation_obj->managing_stock() && $variation_obj->get_stock_quantity() <= 0) {
				continue;
			}

			// If this is a valid variation, add its attribute value to the options
			if (isset($variation['attributes']['attribute_' . $current_attribute])) {
				$filtered_options[] = $variation['attributes']['attribute_' . $current_attribute];
			}
		}

		// Override the options with our filtered list
		if (!empty($filtered_options)) {
			$filtered_options = array_reverse($filtered_options);
			$args['options'] = array_unique($filtered_options);
		}

		//reverse_variation_dropdown_options();

		return $args;
	}

	add_filter('woocommerce_coupon_error', function ($message, $error_code, $coupon) {
		if (in_array($coupon->get_code(), ['beta', 'owner69420'])) {
			$message = '<div>Coupon is valid for registered users only. <a href="' . home_url('/register') . '">Register now!</a></div>';
		}

		return $message;
	}, 10, 3);


	function is_theme_my_login_page() {
		// Check if TML is active
		if ( ! function_exists( 'theme_my_login' ) ) {
			return false;
		}

		// Get current queried object
		global $wp_query;

		// Check for TML page by slug (default slugs: login, register, lostpassword, resetpass, logout)
		if ( is_page() && isset( $wp_query->query_vars['pagename'] ) ) {
			$tml_slugs = array( 'login', 'register', 'lostpassword', 'resetpass', 'logout' );

			// You can customize this list if you changed the page slugs in TML settings
			return in_array( $wp_query->query_vars['pagename'], $tml_slugs );
		}

		return false;
	}
