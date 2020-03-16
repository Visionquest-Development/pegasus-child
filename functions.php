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
		//Clients / Success Stories Portfolio Page with sort/filter grid
		if ( is_page( '3112' ) ) {
			wp_enqueue_script( 'pegasus_custom_js', get_stylesheet_directory_uri() . '/js/pegasus-custom.js', array(), '', true );
			wp_enqueue_script( 'pegasus_modernizer_js', get_stylesheet_directory_uri() . '/js/modernizer.js', array(), '', true );
			wp_enqueue_script( 'pegasus_images_loaded_js', get_stylesheet_directory_uri() . '/js/imagesloaded.js', array(), '', true );
			wp_enqueue_script( 'pegasus_classie_js', get_stylesheet_directory_uri() . '/js/classie.js', array(), '', true );
			wp_enqueue_script( 'pegasus_flickety_js', get_stylesheet_directory_uri() . '/js/flickety.js', array(), '', true );
			wp_enqueue_script( 'pegasus_filterable_js', get_stylesheet_directory_uri() . '/js/filterable.main.js', array(), '', true );
			wp_enqueue_script( 'pegasus_isotope_js', get_stylesheet_directory_uri() . '/js/isotope.js', array(), '', true );
		}
		//wp_enqueue_script( 'matchHeight_js', get_stylesheet_directory_uri() . '/js/jquery.matchHeight-min.js', array(), '', true );
		
		
	} //end function
	add_action( 'wp_enqueue_scripts', 'pegasus_child_bootstrap_js' );




	// CUSTOM POST TYPES

	function cadence_custom_post_types() {


		// Portfolio

		$labels_portfolio = array(
			'add_new' => 'Add New', 'portfolio-type',
			'add_new_item' => 'Add New Portfolio Post',
			'edit_item' => 'Edit Portfolio Post',
			'menu_name' => 'Portfolio',
			'name' => 'Portfolio', 'post type general name',
			'new_item' => 'New Portfolio Post',
			'not_found' =>  'No portfolio posts found',
			'not_found_in_trash' => 'No portfolio posts found in Trash',
			'parent_item_colon' => '',
			'singular_name' => 'Portfolio Post', 'post type singular name',
			'search_items' => 'Search Portfolio Posts',
			'view_item' => 'View Portfolio Post',
		);
		$args_portfolio = array(
			'capability_type' => 'post',
			'has_archive' => true,
			'hierarchical' => true,
			'labels' => $labels_portfolio,
			'menu_position' => 4,
			'public' => true,
			'publicly_queryable' => true,
			'query_var' => true,
			'show_in_menu' => true,
			'show_ui' => true,
			'supports' => array( 'comments', 'editor', 'excerpt', 'thumbnail', 'title' ),
			'singular_label' => 'Portfolio',
		);
		register_post_type( 'portfolio-type', $args_portfolio );


	}

	add_action( 'init', 'cadence_custom_post_types' );


	// CUSTOM TAXONOMIES

	function cadence_custom_taxonomies() {


		// Portfolio Categories

		$labels = array(
			'add_new_item' => 'Add New Category',
			'all_items' => 'All Categories' ,
			'edit_item' => 'Edit Category' ,
			'name' => 'Portfolio Categories', 'taxonomy general name' ,
			'new_item_name' => 'New Genre Category' ,
			'menu_name' => 'Categories' ,
			'parent_item' => 'Parent Category' ,
			'parent_item_colon' => 'Parent Category:',
			'singular_name' => 'Portfolio Category', 'taxonomy singular name' ,
			'search_items' =>  'Search Categories' ,
			'update_item' => 'Update Category' ,
		);
		register_taxonomy( 'portfolio-category', array( 'portfolio-type' ), array(
			'hierarchical' => true,
			'labels' => $labels,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'portfolio-type/category' ),
			'show_ui' => true,
		));


		// Portfolio Tags

		$labels = array(
			'add_new_item' => 'Add New Tag' ,
			'all_items' => 'All Tags' ,
			'edit_item' => 'Edit Tag' ,
			'menu_name' => 'Portfolio Tags' ,
			'name' => 'Portfolio Tags', 'taxonomy general name' ,
			'new_item_name' => 'New Genre Tag' ,
			'parent_item' => 'Parent Tag' ,
			'parent_item_colon' => 'Parent Tag:' ,
			'singular_name' =>  'Portfolio Tag', 'taxonomy singular name' ,
			'search_items' =>   'Search Tags' ,
			'update_item' => 'Update Tag' ,
		);
		register_taxonomy( 'portfolio-tags', array( 'portfolio-type' ), array(
			'hierarchical' => true,
			'labels' => $labels,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'portfolio-type/tag' ),
			'show_ui' => true,
		));


	}

	add_action( 'init', 'cadence_custom_taxonomies', 0 );



	// Extra Fields
	add_action( 'admin_init', 'extra_fields', 1 );

	function extra_fields() {
		add_meta_box( 'extra_fields', 'Additional settings', 'blog_fields_box_func', 'post', 'normal', 'high'  );
		//add_meta_box( 'extra_fields', 'Additional settings', 'extra_fields_box_page_func', 'page', 'normal', 'high'  );
		add_meta_box( 'extra_fields', 'Additional settings', 'extra_fields_box_port_func', 'portfolio-type', 'normal', 'high'  );
	}


	function extra_fields_box_port_func( $post ){
		?>
		<h4>Few words about project</h4>
		<p>
			<input type="text" name="extra[port-descr]" style="width:100%;" value="<?php echo get_post_meta( $post->ID, 'port-descr', 1 ); ?>"/>
		</p>


		<h4>You can upload up to 3 additional images (Optional. For slider)</h4>
		<p>
			<label for="upload_image">Upload Image 1: </label>
			<input id="upload_image" type="text" size="90" name="extra[image]" value="<?php echo get_post_meta( $post->ID, 'image', true ); ?>" />
			<input class="upload_image_button" type="button" value="Upload" /><br/>

		</p>
		<input type="hidden" name="extra_fields_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" />
		<p>
			<label for="upload_image">Upload Image 2: </label>
			<input id="upload_image" type="text" size="90" name="extra[image2]" value="<?php echo get_post_meta( $post->ID, 'image2', true ); ?>" />
			<input class="upload_image_button" type="button" value="Upload" /><br/>

		</p>
		<input type="hidden" name="extra_fields_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" />

		<p>
			<label for="upload_image">Upload Image 3: </label>
			<input id="upload_image" type="text" size="90" name="extra[image3]" value="<?php echo get_post_meta( $post->ID, 'image3', true ); ?>" />
			<input class="upload_image_button" type="button" value="Upload" /><br/>

		</p>
		<input type="hidden" name="extra_fields_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" />
		<h4>Or past code for Video (iframe height="360" width="100%" )</h4>
		<p>
			<textarea type="text" name="extra[video]" style="width:100%;height:50px;"><?php echo get_post_meta( $post->ID, 'video', 1 ); ?></textarea>
		</p>
		<?php
	}

	function blog_fields_box_func( $post ){
		?>
		<h4>If it will be Video post please paste code here( Iframe width="640")</h4>
		<p>
			<textarea type="text" name="extra[video]" style="width:100%;height:50px;"><?php echo get_post_meta( $post->ID, 'video', 1 ); ?></textarea>
		</p>
		<?php
	}
	/*
	function extra_fields_box_page_func( $post ){
		?>
		<h4>Custom page description (Optional)</h4>
		<p>
			<textarea type="text" name="extra[description]" style="width:100%;height:50px;"><?php echo get_post_meta($post->ID, 'description', 1); ?></textarea>
		</p>
		<h4>FullWidth Slider on this page? Please input slider alias</h4>
		<p>
			<input type="text" name="extra[sliderr]" value="<?php echo get_post_meta( $post->ID, 'sliderr', 1 ); ?>">
		</p>
		<?php
	}

	add_action( 'save_post', 'extra_fields_update', 0 );

	function extra_fields_update( $post_id ){
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE  ) return false;
		if ( !current_user_can( 'edit_post', $post_id ) ) return false;
		if( !isset( $_POST['extra'] ) ) return false;


		$_POST['extra'] = array_map( 'trim', $_POST['extra'] );
		foreach( $_POST['extra'] as $key=>$value ){
			if( empty( $value ) )
				delete_post_meta( $post_id, $key );
			update_post_meta( $post_id, $key, $value );
		}
		return $post_id;
	}
	*/


	/*~~~~~~~~~~~~~~~~~~~~
		BTN
	~~~~~~~~~~~~~~~~~~~~~*/

	// [btn size=”small” url=”https://dev.cadence-group.com/hire-us”] text [/btn]
	function pegasus_button_func( $atts, $content = null ) {
		$a = shortcode_atts( array(
			'url' => '#',
			'external' => '',
			'classes' => '',
		), $atts );

		$link = "{$a['url']}" ? "{$a['url']}" : '#';
		$external = ( "true" === "{$a['external']}" || "yes" === "{$a['external']}" ) ? true : false;
		$classes = "{$a['classes']}";
		$output = '';
		$content = $content ? $content : 'Read More';

		$output .= '<a href="' . $link . '" ';
		if( true === $external ) {
			$output .= ' target="_blank" ';
		}
		$output .= ' class="btn  ' . $classes . '" ';
		$output .= '>';
		$output .= $content;
		$output .= '</a>';

		return $output;
	}
	add_shortcode( 'btn', 'pegasus_button_func' );
