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
		wp_enqueue_style('pegasus-image-diff-css', get_stylesheet_directory_uri() . '/css/pegasus-image-diff.css', null, false, false);

		wp_enqueue_style('lightbox-css', get_stylesheet_directory_uri() . '/css/lightbox.min.css', null, false, false);
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

		wp_enqueue_script( 'matchHeight_js' );

		wp_enqueue_script( 'pegasus_child_custom_js', get_stylesheet_directory_uri() . '/js/pegasus-custom.js', array(), '', true );

		//wp_enqueue_script( 'matchHeight_js', get_stylesheet_directory_uri() . '/js/jquery.matchHeight-min.js', array(), '', true );

		wp_enqueue_script( 'pegasus_image_diff_js', get_stylesheet_directory_uri() . '/js/pegasus-image-diff.js', array(), '', true );

		wp_enqueue_script( 'lightbox_pegasus_js', get_stylesheet_directory_uri() . '/js/lightbox.min.js', array(), '', true );


	} //end function
	add_action( 'wp_enqueue_scripts', 'pegasus_child_bootstrap_js' );

	/**
	 * Homepage Service Cards metabox (CMB2) – shown only on the static front page
	 */
	if ( ! function_exists( 'oak_homepage_cards_metabox' ) ) {
		function oak_homepage_cards_metabox() {

			$homepage_id = (int) get_option( 'page_on_front' ); // ID of the static front page
			if ( ! $homepage_id ) {
				return; // bail if a front page is not set
			}

			$prefix = 'oak_homepage_cards_';

			$cmb = new_cmb2_box( array(
				'id'            => $prefix . 'metabox',
				'title'         => __( 'Homepage Service Cards', 'pegasus-bootstrap' ),
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
				'id'          => $prefix . 'group',
				'type'        => 'group',
				'description' => __( 'Add service cards for the homepage', 'pegasus-bootstrap' ),
				'options'     => array(
					'group_title'   => __( 'Card {#}', 'pegasus-bootstrap' ),
					'add_button'    => __( 'Add Another Card', 'pegasus-bootstrap' ),
					'remove_button' => __( 'Remove Card', 'pegasus-bootstrap' ),
					'sortable'      => true,
				),
			) );

			$cmb->add_group_field( $group_field_id, array(
				'name'    => __( 'Title', 'pegasus-bootstrap' ),
				'id'      => 'title',
				'type'    => 'text',
			) );

			$cmb->add_group_field( $group_field_id, array(
				'name'    => __( 'Description', 'pegasus-bootstrap' ),
				'id'      => 'description',
				'type'    => 'textarea_small',
			) );

			$cmb->add_group_field( $group_field_id, array(
				'name'    => __( 'Image', 'pegasus-bootstrap' ),
				'id'      => 'image',
				'type'    => 'file',
				'options' => array(
					'url' => false,
				),
				'text'    => array(
					'add_upload_file_text' => __( 'Add Card Image', 'pegasus-bootstrap' ),
				),
			) );

			$cmb->add_group_field( $group_field_id, array(
				'name'    => __( 'Image Alt Text', 'pegasus-bootstrap' ),
				'id'      => 'image_alt',
				'type'    => 'text',
			) );

			$cmb->add_group_field( $group_field_id, array(
				'name'    => __( 'Link URL', 'pegasus-bootstrap' ),
				'id'      => 'link',
				'type'    => 'text_url',
			) );

			$cmb->add_group_field( $group_field_id, array(
				'name'    => __( 'Icon Class', 'pegasus-bootstrap' ),
				'desc'    => __( 'Font Awesome class, e.g. fa fa-wrench', 'pegasus-bootstrap' ),
				'id'      => 'icon_class',
				'type'    => 'text',
			) );

			$cmb->add_group_field( $group_field_id, array(
				'name'    => __( 'Button Text', 'pegasus-bootstrap' ),
				'id'      => 'button_text',
				'type'    => 'text',
				'default' => 'Learn More',
			) );
		}
	}
	add_action( 'cmb2_admin_init', 'oak_homepage_cards_metabox' );


	/*============================
	======= Gallery Post Type ========
	============================*/

	$pegasus_gallery_labels = array(
		'name'               => _x( 'Galleries', 'gallery general name', 'pegasus' ),
		'singular_name'      => _x( 'Gallery', 'gallery singular name', 'pegasus' ),
		'add_new'            => _x( 'Add New', 'gallery', 'pegasus' ),
		'add_new_item'       => __( 'Add New Gallery', 'pegasus' ),
		'edit_item'          => __( 'Edit Gallery', 'pegasus' ),
		'new_item'           => __( 'New Gallery', 'pegasus' ),
		'view_item'          => __( 'View Gallery', 'pegasus' ),
		'search_items'       => __( 'Search Galleries', 'pegasus' ),
		'not_found'          => __( 'No galleries found', 'pegasus' ),
		'not_found_in_trash' => __( 'No galleries found in Trash', 'pegasus' ),
		'parent_item_colon'  => '',
		'menu_name'          => 'Pegasus Galleries',
	);

	// Args copied from logo slider so behavior is identical
	$pegasus_gallery_args = array(
		'labels'             => $pegasus_gallery_labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => true,
		/* this is important to make it so that page-portfolio.php will show when used */
		'capability_type'    => 'post',
		'can_export'         => true,
		/* make sure has_archive is turned off if you plan on using page-portfolio.php */
		'has_archive'        => false,
		'hierarchical'       => true,
		'menu_position'      => null,
		/* include this line to use global categories */
		//'taxonomies'         => array( 'category' ),
		'supports'           => array( 'title' ),
	);

	register_post_type( 'gallery', $pegasus_gallery_args );

	remove_post_type_support(
		'gallery',
		'editor',
		'permalink',
		'comments',
		'thumbnail',
		'custom-fields',
		'author',
		'excerpt',
		'trackbacks'
	);


	/**
	 * Admin list table: add Shortcode column for Gallery CPT
	 */
	add_filter( 'manage_gallery_posts_columns', 'gallery_posts_columns', 5 );
	function gallery_posts_columns( $defaults ) {
		$defaults['gallery_shortcode_id'] = __( 'Shortcode', 'pegasus' );
		return $defaults;
	}

	add_action( 'manage_gallery_posts_custom_column', 'gallery_custom_column_content', 5, 2 );
	function gallery_custom_column_content( $column, $post_id ) {
		switch ( $column ) {
			case 'gallery_shortcode_id':
				echo '<input
					type="text"
					readonly
					value="' . esc_html( '[pegasus_gallery id="' . $post_id . '"]' ) . '"
					class="regular-text code"
					id="pegasus-gallery-shortcode-' . esc_attr( $post_id ) . '"
					onClick="this.select();"
				>';
				break;
		}
	}





	/* CMB2 STUFF */


	add_action( 'cmb2_admin_init', 'register_cmb2_repeatable_image_group' );
	function register_cmb2_repeatable_image_group() {
		$prefix = 'camp_gallery_section_'; // Keep same prefix so template / shortcode meta keys stay identical

		$cmb = new_cmb2_box( array(
			'id'           => $prefix . 'metabox',
			'title'        => __( 'GALLERY', 'cmb2' ),
			// Attach to your new Gallery CPT (change from qbiq_events)
			'object_types' => array( 'gallery' ),
			// If you still want this on qbiq_events as well, use:
			// 'object_types' => array( 'pegasus_gallery', 'qbiq_events' ),
		) );

		$cmb->add_field( array(
			'name' => 'Title',
			'id'   => $prefix . 'title',
			'type' => 'text',
		) );

		$cmb->add_field( array(
			'name' => 'Description',
			'id'   => $prefix . 'description',
			'type' => 'textarea',
		) );

		$group_field_id = $cmb->add_field( array(
			'id'          => $prefix . 'image_group',
			'type'        => 'group',
			'description' => __( 'Add images for the gallery', 'cmb2' ),
			'options'     => array(
				'group_title'       => __( 'Entry {#}', 'cmb2' ), // {#} gets replaced by row number
				'add_button'        => __( 'Add Another Image', 'cmb2' ),
				'remove_button'     => __( 'Remove Image', 'cmb2' ),
				'sortable'          => true,
				'closed'            => true, // true to have the groups closed by default
			),
		) );

		// Image upload
		$cmb->add_group_field( $group_field_id, array(
			'name'       => 'Image',
			'id'         => 'image',
			'type'       => 'file',
			'options'    => array(
				//'url' => false, // Hide the text input for the url
			),
			'query_args' => array(
				'type' => array( 'image/gif', 'image/jpeg', 'image/png' ),
			),
			'preview_size' => 'medium', // Image size when previewing in admin
		) );

		$cmb->add_group_field( $group_field_id, array(
			'name' => 'Caption',
			'id'   => 'caption',
			'type' => 'text',
		) );

		$cmb->add_group_field( $group_field_id, array(
			'name' => 'Width',
			'id'   => 'width',
			'type' => 'text',
		) );
	}



	/*~~~~~~~~~~~~~~~~~~~~
		GALLERY SHORTCODE
	~~~~~~~~~~~~~~~~~~~~~*/
	// [pegasus_gallery id="123"]
	function pegasus_gallery_shortcode( $atts ) {

		$atts = shortcode_atts(
			array(
				'id' => '',
			),
			$atts,
			'pegasus_gallery'
		);

		if ( empty( $atts['id'] ) ) {
			return '';
		}

		$post_id = absint( $atts['id'] );

		// These meta keys and structure are exactly the same as in your template
		$images = get_post_meta( $post_id, 'camp_gallery_section_image_group', true );
		$title  = get_post_meta( $post_id, 'camp_gallery_section_title', true );
		$desc   = get_post_meta( $post_id, 'camp_gallery_section_description', true );

		ob_start();
		?>
		<section class="p-3 oak-images-grid oak-background-black">

			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<?php

							// $images, $title, $desc are already set above
							//var_dump($desc);
						?>

						<h2><?php echo $title; ?></h2>
						<p><?php echo $desc; ?></p>


						<?php



							//var_dump( $images );

							// Check if there are images and output them within the packery shortcode
							if ( ! empty( $images ) ) {
								$output = '[packery]';  // Start the shortcode

								foreach ( $images as $image ) {
									$img_url = esc_url( $image['image'] );
									$caption = esc_attr( $image['caption'] ?? 'My caption' );
									//Undefined array key "width"
									if ( isset( $image['width'] ) ) {
										$width = esc_attr( $image['width'] );
									}

									if ( empty( $width ) ) {
										$width = '306';
									}
									$output .= '<a href="' . $img_url . '"  data-lightbox="oak-location-image-gallery" data-title="' . $caption . '" class="wow fadeIn">';

										$output .= '<img src="' . $img_url . '" loading="lazy" width="' . $width . '" class="">';
									$output .= '</a>';

								}

								$output .= '[/packery]';  // Close the shortcode

								//var_dump();

								echo do_shortcode( $output );  // Execute the shortcode with all images included
							}

						?>




					</div>

				</div>
			</div>
		</section>
		<?php

		return ob_get_clean();
	}
	add_shortcode( 'pegasus_gallery', 'pegasus_gallery_shortcode' );

	/*============================
	======= Before/After CPT ========
	============================*/
	$oak_before_after_labels = array(
		'name'               => _x( 'Before & After', 'before_after general name', 'pegasus' ),
		'singular_name'      => _x( 'Before & After', 'before_after singular name', 'pegasus' ),
		'add_new'            => _x( 'Add New', 'before_after', 'pegasus' ),
		'add_new_item'       => __( 'Add New Before & After', 'pegasus' ),
		'edit_item'          => __( 'Edit Before & After', 'pegasus' ),
		'new_item'           => __( 'New Before & After', 'pegasus' ),
		'view_item'          => __( 'View Before & After', 'pegasus' ),
		'search_items'       => __( 'Search Before & After', 'pegasus' ),
		'not_found'          => __( 'No entries found', 'pegasus' ),
		'not_found_in_trash' => __( 'No entries found in Trash', 'pegasus' ),
		'parent_item_colon'  => '',
		'menu_name'          => 'Before & After',
	);

	$oak_before_after_args = array(
		'labels'             => $oak_before_after_labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'can_export'         => true,
		'has_archive'        => false,
		'hierarchical'       => true,
		'menu_position'      => null,
		'supports'           => array( 'title' ),
	);

	register_post_type( 'before_after', $oak_before_after_args );

	remove_post_type_support(
		'before_after',
		'editor',
		'permalink',
		'comments',
		'thumbnail',
		'custom-fields',
		'author',
		'excerpt',
		'trackbacks'
	);

	/**
	 * Admin list table: add Shortcode column for Before/After CPT.
	 */
	add_filter( 'manage_before_after_posts_columns', 'oak_before_after_posts_columns', 5 );
	function oak_before_after_posts_columns( $defaults ) {
		$defaults['before_after_shortcode_id'] = __( 'Shortcode', 'pegasus' );
		return $defaults;
	}

	add_action( 'manage_before_after_posts_custom_column', 'oak_before_after_custom_column_content', 5, 2 );
	function oak_before_after_custom_column_content( $column, $post_id ) {
		switch ( $column ) {
			case 'before_after_shortcode_id':
				echo '<input
					type="text"
					readonly
					value="' . esc_html( '[before_and_after id="' . $post_id . '"]' ) . '"
					class="regular-text code"
					id="before-after-shortcode-' . esc_attr( $post_id ) . '"
					onClick="this.select();"
				>';
				break;
		}
	}

	/* CMB2: Before/After fields */
	add_action( 'cmb2_admin_init', 'register_cmb2_before_after_group' );
	function register_cmb2_before_after_group() {
		$prefix = 'oak_before_after_';

		$cmb = new_cmb2_box( array(
			'id'           => $prefix . 'metabox',
			'title'        => __( 'Before & After', 'cmb2' ),
			'object_types' => array( 'before_after' ),
		) );

		$cmb->add_field( array(
			'name' => 'Heading',
			'id'   => $prefix . 'title',
			'type' => 'text',
		) );

		$cmb->add_field( array(
			'name'    => 'Before Image',
			'id'      => $prefix . 'before_image',
			'type'    => 'file',
			'options' => array(),
			'query_args' => array(
				'type' => array( 'image/gif', 'image/jpeg', 'image/png' ),
			),
			'preview_size' => 'medium',
		) );

		$cmb->add_field( array(
			'name'    => 'After Image',
			'id'      => $prefix . 'after_image',
			'type'    => 'file',
			'options' => array(),
			'query_args' => array(
				'type' => array( 'image/gif', 'image/jpeg', 'image/png' ),
			),
			'preview_size' => 'medium',
		) );
	}

	/*============================
	======= BEFORE/AFTER SHORTCODE ========
	============================*/
	// [before_and_after id="123"]
	function oak_before_after_shortcode( $atts ) {
		$atts = shortcode_atts(
			array(
				'id' => '',
			),
			$atts,
			'before_and_after'
		);

		if ( empty( $atts['id'] ) ) {
			return '';
		}

		$post_id = absint( $atts['id'] );
		$title   = get_post_meta( $post_id, 'oak_before_after_title', true );
		$before  = get_post_meta( $post_id, 'oak_before_after_before_image', true );
		$after   = get_post_meta( $post_id, 'oak_before_after_after_image', true );

		if ( empty( $before ) || empty( $after ) ) {
			return '';
		}

		ob_start();
		?>
		<section class="w-50 mx-auto py-5">
			<h2><?php echo esc_html( $title ? $title : 'Before/After' ); ?></h2>

			<div class="pegasus-image-diff" id="pegasus-image-diff-<?php echo esc_attr( $post_id ); ?>">
				<img
					class="pegasus-image-diff__image pegasus-image-diff__image--before"
					src="<?php echo esc_url( $before ); ?>"
					alt="Before"
				>
				<img
					class="pegasus-image-diff__image pegasus-image-diff__image--after"
					src="<?php echo esc_url( $after ); ?>"
					alt="After"
				>
				<div class="pegasus-image-diff__handle"></div>
			</div>
		</section>
		<?php
		return ob_get_clean();
	}
	add_shortcode( 'before_and_after', 'oak_before_after_shortcode' );
