<?php

	// Define benignware\wp\bootstrap_hooks\wrap() before the_content runs — the
	// installed wp-bootstrap-hooks version calls it (features/content/embeds.php)
	// to wrap <iframe> embeds but never defines it, fataling any page with an
	// iframe (e.g. Contact). See the file header for details.
	require_once get_stylesheet_directory() . '/bootstrap-hooks-compat.php';

	/**
	 * Plugin requirements (TGMPA) & Bootstrap CMB2
	 */
	//require_once get_template_directory_uri() . 'inc/class-tgm-plugin-activation.php';

	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	~~~~PROPER WAY OF ADDING CHILD THEME CSS FILE ~~~~
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/

	function theme_enqueue_styles() {
		/*wp_enqueue_style(
			'parent-style',
			get_template_directory_uri() . '/style.css',
			array(),
			wp_get_theme()->get('Version')
		);*/

		wp_enqueue_style( 'child-style',
			get_stylesheet_directory_uri() . '/style.css',
			[],//array( 'parent-style' ),
			wp_get_theme()->get('Version') // Or filemtime( get_stylesheet_directory() . '/style.css' )
		);

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
			wp_enqueue_script( 'pegasus_matchheight_js', get_stylesheet_directory_uri() . '/js/matchHeight.js', [], '', true );
		}
		//wp_enqueue_script( 'matchHeight_js', get_stylesheet_directory_uri() . '/js/jquery.matchHeight-min.js', array(), '', true );

		// `match-height-js` is registered by the Pegasus Postgrid plugin on
		// wp_enqueue_scripts (priority 10). It's declared here as a dependency
		// so it loads BEFORE pegasus_custom.js — letting our matchHeight calls
		// run synchronously without waiting for window.load.
		wp_enqueue_script( 'match-height-js' );
		wp_enqueue_script(
			'pegasus_custom_js',
			get_stylesheet_directory_uri() . '/js/pegasus-custom.js',
			array( 'jquery', 'match-height-js' ),
			null,
			true
		);

	} //end function
	add_action( 'wp_enqueue_scripts', 'pegasus_child_bootstrap_js' );


	// Inject pegasus_custom_js as a dependency of pegasus-slider-plugin-js so
	// the slider plugin's IIFE (which calls $('.slippry-slider-container').slippry({...})
	// at script-load time) executes AFTER pegasus_custom_js. That lets us run
	// matchHeight on the natural <ul> markup BEFORE slippery converts the
	// slides into absolutely-positioned cycling layers — otherwise matchHeight
	// would measure slippery's already-modified heights and produce wrong values.
	//
	// Runs at priority 30 so the slider plugin (registered at 10) and our
	// force-enqueue (at 20) have both already fired.
	function pegasus_child_make_slider_depend_on_custom_js() {
		$wp_scripts = wp_scripts();
		if (
			isset( $wp_scripts->registered['pegasus-slider-plugin-js'] )
			&& ! in_array( 'pegasus_custom_js', $wp_scripts->registered['pegasus-slider-plugin-js']->deps, true )
		) {
			$wp_scripts->registered['pegasus-slider-plugin-js']->deps[] = 'pegasus_custom_js';
		}
	}
	add_action( 'wp_enqueue_scripts', 'pegasus_child_make_slider_depend_on_custom_js', 30 );


	// Quick fix: force-enqueue Pegasus Slider assets site-wide,
	// since the plugin only enqueues them inside its shortcode callbacks.
	function pegasus_child_force_slider_assets() {
		wp_enqueue_style(  'slippery-css' );
		wp_enqueue_style(  'slippery-slider-css' );
		wp_enqueue_script( 'slippery-js' );
		wp_enqueue_script( 'pegasus-slider-plugin-js' );
	}
	add_action( 'wp_enqueue_scripts', 'pegasus_child_force_slider_assets', 20 );


	// Quick fix: force-enqueue Pegasus Tabs assets site-wide,
	// since the plugin only enqueues them inside its shortcode callbacks.
	function pegasus_child_force_tabs_assets() {
		wp_enqueue_style(  'tabs-css' );
		wp_enqueue_script( 'pegasus-tabs-plugin-js' );
	}
	add_action( 'wp_enqueue_scripts', 'pegasus_child_force_tabs_assets', 20 );


	// Force-enqueue Pegasus Accordion assets site-wide, because the renderer
	// now builds .pegasus-accordion markup directly instead of going through
	// the [accordions] shortcode — so the plugin's own has_shortcode-gated
	// enqueue never fires.
	function pegasus_child_force_accordions_assets() {
		wp_enqueue_style(  'pegasus-accordions-css' );
		wp_enqueue_script( 'pegasus-accordions-plugin-js' );
	}
	add_action( 'wp_enqueue_scripts', 'pegasus_child_force_accordions_assets', 20 );


	// Force-enqueue the Pegasus Carousel (slick) stylesheets site-wide. The
	// pegasus-carousel plugin only ENQUEUES slick-css/slick-theme-css inside its
	// [pegasus_logo_slider] / [pegasus_testimonial_slider] shortcode callbacks,
	// which run during the_content — i.e. AFTER wp_head has already printed the
	// page styles, so the CSS <link> is emitted too late and dropped. (The slider
	// JS still works because scripts print in the footer, which is why the slider
	// initializes but renders unstyled — slides don't clip/float.) The handles are
	// registered by the plugin at priority 10, so enqueue them here at 20.
	function pegasus_child_force_carousel_assets() {
		wp_enqueue_style( 'slick-css' );
		wp_enqueue_style( 'slick-theme-css' );
	}
	add_action( 'wp_enqueue_scripts', 'pegasus_child_force_carousel_assets', 20 );


	// Force-enqueue Gravity Forms assets site-wide for the sidebar contact
	// form (ID 3). GF only auto-enqueues its form CSS (gform_basic/gform_theme)
	// when it detects a form in the POST CONTENT — GFFormDisplay::enqueue_scripts()
	// scans $wp_query->posts[*]->post_content and never looks at widgets/sidebars.
	// Because our contact form lives in a sidebar WIDGET, that scan never finds
	// it, so the form renders unstyled. Enqueue its assets explicitly here.
	function pegasus_child_force_gravityforms_assets() {
		if ( ! function_exists( 'gravity_form_enqueue_scripts' ) ) {
			return;
		}
		gravity_form_enqueue_scripts( 3, false );
	}
	add_action( 'wp_enqueue_scripts', 'pegasus_child_force_gravityforms_assets', 20 );


	// The current wp-bootstrap-hooks version dropped wp_bootstrap_posts_pagination(),
	// but every Pegasus template still calls it (guarded by function_exists), so
	// pagination silently stopped rendering. Shim it to core paginate_links() with
	// type=list — the one path the plugin's `paginate_links_output` filter hooks to
	// inject Bootstrap 5 classes (.pagination / .page-item / .page-link / .active).
	if ( ! function_exists( 'wp_bootstrap_posts_pagination' ) ) {
		function wp_bootstrap_posts_pagination( $args = array() ) {
			if ( $GLOBALS['wp_query']->max_num_pages <= 1 ) {
				return;
			}
			$args = wp_parse_args( $args, array(
				'mid_size'  => 1,
				'prev_text' => __( 'Previous', 'pegasus' ),
				'next_text' => __( 'Next', 'pegasus' ),
			) );
			$args['type'] = 'list'; // required for the plugin filter to add Bootstrap classes
			echo paginate_links( $args );
		}
	}


	// pegasus/index.php prints pagination TWICE: legacy my_pagination() (plain
	// paginate_links — no Bootstrap classes) AND wp_bootstrap_posts_pagination()
	// above. Since this child functions.php loads before the parent's, defining
	// my_pagination() here makes the parent's function_exists()-guarded version
	// skip, suppressing the duplicate plain block and leaving only the Bootstrap one.
	if ( ! function_exists( 'my_pagination' ) ) {
		function my_pagination() {
			// Intentionally empty — superseded by wp_bootstrap_posts_pagination().
		}
	}




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

		$output .= '<a href="' . esc_url( $link ) . '" ';
		if( true === $external ) {
			$output .= ' target="_blank" ';
		}
		$output .= ' class="btn  ' . esc_attr( $classes ) . '" ';
		$output .= '>';
		$output .= do_shortcode( $content );
		$output .= '</a>';

		return $output;
	}
	add_shortcode( 'btn', 'pegasus_button_func' );


	/*~~~~~~~~~~~~~~~~~~~~
		ICON
	~~~~~~~~~~~~~~~~~~~~~*/
	// [icon image="icon-folder-open"]
	function pegasus_icon_func( $atts, $content = null ) {
		$a = shortcode_atts(
			[
				'image' => '',
			],
			$atts
		);

		$img = $a['image'] ? $a['image'] : '#';

		$icon_map = [
			'icon-folder-open' => 'fa fa-folder-open',
			'icon-share'       => 'fa fa-share-square',
			'icon-picture'     => 'fa fa-image',
			'icon-search'      => 'fa fa-search',
			'icon-cog'         => 'fa fa-cog',
			'icon-user'        => 'fa fa-user',
		];

		if ( isset( $icon_map[ $img ] ) ) {
			return '<i class="' . esc_attr( $icon_map[ $img ] ) . '"></i>';
		}

		return 'No Icon found. ' . esc_html( $img );
	}
	add_shortcode( 'icon', 'pegasus_icon_func' );


	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		~~~~~~~~~~~~~~~~~~~Make Font Awesome available ~~~~~~~~~~~~~~
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/

	//add_action('wp_enqueue_scripts', 'enqueue_font_awesome');
	//function enqueue_font_awesome() {
	//wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css');
	//}

	/*===========================================================================================*/

	/*
	 * Function to delete Gravity Forms entries older than 2 weeks for a specific form ID

	function delete_old_gravityforms_entries() {
		// Replace this with your Gravity Forms Form ID
		$form_id = 1; // Change to the form ID you want to target

		if ( ! class_exists( 'GFAPI' ) ) {
			return;
		}

		// Calculate the date two weeks ago
		$two_weeks_ago = strtotime( '-2 weeks' );

		// Get all entries for the specific form
		$entries = GFAPI::get_entries( $form_id );

		// Loop through each entry
		foreach ( $entries as $entry ) {
			$entry_date = strtotime( $entry['date_created'] ); // Entry date

			// If the entry is older than two weeks, delete it
			if ( $entry_date < $two_weeks_ago ) {
				GFAPI::delete_entry( $entry['id'] );
			}
		}
	}

	// Schedule the function to run daily
	if ( ! wp_next_scheduled( 'daily_delete_old_gf_entries' ) ) {
		wp_schedule_event( time(), 'daily', 'daily_delete_old_gf_entries' );
	}

	// Hook the function to the scheduled event
	add_action( 'daily_delete_old_gf_entries', 'delete_old_gravityforms_entries' );
	*/
	/*===========================================================================================*/

	/**
	 * Delete Gravity Forms entries older than 14 days AND delete their uploaded files.
	 */
	function vqdev_delete_old_gf_entries_and_files() {
		if ( ! class_exists( 'GFAPI' ) || ! class_exists( 'GFFormsModel' ) ) {
			return;
		}

		$form_id = 1; // <-- your form ID

		// Strongly recommended: list the field IDs that contain resume uploads.
		// Example: array( 7 ) or array( 7, 12 )
		$resume_field_ids = array(); // <-- SET THIS

		$cutoff = gmdate( 'Y-m-d H:i:s', strtotime( '-14 days' ) );

		$search_criteria = array(
			'status'        => 'active',
			'field_filters' => array(
				array(
					'key'      => 'date_created',
					'operator' => '<',
					'value'    => $cutoff,
				),
			),
		);

		$sorting = array( 'key' => 'date_created', 'direction' => 'ASC' );

		$page_size = 100;
		$offset    = 0;

		do {
			$paging = array(
				'offset'    => $offset,
				'page_size' => $page_size,
			);

			$entries = GFAPI::get_entries( $form_id, $search_criteria, $sorting, $paging );
			if ( is_wp_error( $entries ) || empty( $entries ) ) {
				break;
			}

			$form = GFAPI::get_form( $form_id );
			if ( empty( $form ) ) {
				break;
			}

			foreach ( $entries as $entry ) {

				// Delete uploaded resume files first
				foreach ( $form['fields'] as $field ) {
					if ( $field->type !== 'fileupload' ) {
						continue;
					}

					// If you specified resume field IDs, only delete those
					if ( ! empty( $resume_field_ids ) && ! in_array( (int) $field->id, $resume_field_ids, true ) ) {
						continue;
					}

					$raw = rgar( $entry, (string) $field->id );
					if ( empty( $raw ) ) {
						continue;
					}

					// File Upload field may be a single URL or a JSON array of URLs (multi-file)
					$urls = array();
					if ( is_string( $raw ) && ( str_starts_with( trim( $raw ), '[' ) || str_starts_with( trim( $raw ), '{' ) ) ) {
						$decoded = json_decode( $raw, true );
						if ( is_array( $decoded ) ) {
							$urls = $decoded;
						}
					} else {
						$urls = array( $raw );
					}

					foreach ( $urls as $url ) {
						if ( ! is_string( $url ) || $url === '' ) {
							continue;
						}

						// Convert URL to absolute file path in uploads dir
						$file_path = GFFormsModel::get_physical_file_path( $url );
						if ( $file_path && file_exists( $file_path ) ) {
							@unlink( $file_path );
						}
					}
				}

				// Now delete the entry
				GFAPI::delete_entry( $entry['id'] );
			}

			$offset += $page_size;

		} while ( count( $entries ) === $page_size );
	}

	/**
	 * Schedule daily cleanup (WP-Cron).
	 */
	function vqdev_schedule_gf_cleanup() {
		if ( ! wp_next_scheduled( 'vqdev_daily_gf_cleanup' ) ) {
			wp_schedule_event( time(), 'daily', 'vqdev_daily_gf_cleanup' );
		}
	}
	add_action( 'wp', 'vqdev_schedule_gf_cleanup' );
	add_action( 'vqdev_daily_gf_cleanup', 'vqdev_delete_old_gf_entries_and_files' );

	/**
	 * Unschedule on theme switch (nice hygiene).
	 */
	function vqdev_unschedule_gf_cleanup() {
		$timestamp = wp_next_scheduled( 'vqdev_daily_gf_cleanup' );
		if ( $timestamp ) {
			wp_unschedule_event( $timestamp, 'vqdev_daily_gf_cleanup' );
		}
	}
	add_action( 'switch_theme', 'vqdev_unschedule_gf_cleanup' );


	/*===========================================================================================*/



	// Disable core update emails
	add_filter( 'auto_core_update_send_email', '__return_false' );

	// Disable plugin update emails
	add_filter( 'auto_plugin_update_send_email', '__return_false' );

	// Disable theme update emails
	add_filter( 'auto_theme_update_send_email', '__return_false' );

	function dequeue_styles_for_tpl_blocks() {
		if ( is_page_template( 'tpl_blocks.php' ) ) {
			wp_dequeue_style( 'parent-style' );
			wp_dequeue_style( 'pegasus-css' );
			wp_enqueue_style( 'custom-style', get_stylesheet_directory_uri() . '/style-lp.css', [], null );
		}
	}
	add_action( 'wp_enqueue_scripts', 'dequeue_styles_for_tpl_blocks', 20 );


	/**
	 * Home Slider — CMB2 metabox + render helper.
	 *
	 * Shows a repeatable image group on any page assigned the "Home Template"
	 * (tpl_home.php). Slides are unlimited and drag-reorderable. The render
	 * helper builds a [slider][slide]…[/slide][/slider] string from the saved
	 * meta and feeds it to do_shortcode(), so the existing Pegasus Slider JS
	 * and styling keep working unchanged.
	 */
	function pegasus_child_show_metabox_on_home_template( $cmb ) {
		$post_id = $cmb->object_id();
		if ( ! $post_id && isset( $_GET['post'] ) ) {
			$post_id = absint( $_GET['post'] );
		}
		if ( ! $post_id ) {
			return false;
		}
		return 'tpl_home.php' === get_page_template_slug( $post_id );
	}

	function pegasus_child_register_home_slider_metabox() {
		$cmb = new_cmb2_box( array(
			'id'           => 'pegasus_child_home_slider',
			'title'        => __( 'Home Slider', 'pegasus-child' ),
			'object_types' => array( 'page' ),
			'context'      => 'normal',
			'priority'     => 'high',
			'show_on_cb'   => 'pegasus_child_show_metabox_on_home_template',
		) );

		$group_id = $cmb->add_field( array(
			'id'          => 'home_slider_slides',
			'type'        => 'group',
			'description' => __( 'Add, remove, and drag-to-reorder slides. Each slide is one image.', 'pegasus-child' ),
			'options'     => array(
				'group_title'   => __( 'Slide {#}', 'pegasus-child' ),
				'add_button'    => __( 'Add slide', 'pegasus-child' ),
				'remove_button' => __( 'Remove slide', 'pegasus-child' ),
				'sortable'      => true,
			),
		) );

		$cmb->add_group_field( $group_id, array(
			'name'         => __( 'Image', 'pegasus-child' ),
			'desc'         => __( 'Upload from the media library OR paste a full image URL.', 'pegasus-child' ),
			'id'           => 'image',
			'type'         => 'file',
			'text'         => array( 'add_upload_file_text' => __( 'Add image', 'pegasus-child' ) ),
			'preview_size' => 'medium',
		) );
	}
	add_action( 'cmb2_admin_init', 'pegasus_child_register_home_slider_metabox' );

	/**
	 * Render the home slider by building a [slider]…[/slider] shortcode
	 * from the CMB2 group meta on the current page.
	 *
	 * Echoes nothing if the meta is empty (caller can supply a fallback).
	 */
	/**
	 * Empty-state output for the home-page CMB2-powered sections.
	 *
	 * Shown only to users who can edit the page — public visitors see
	 * nothing, so an unfinished page never leaks "no content yet" text
	 * to the world.
	 */
	function pegasus_child_render_empty_state( $message, $post_id = 0 ) {
		$post_id = $post_id ? $post_id : get_the_ID();
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
		$edit_link = get_edit_post_link( $post_id );
		printf(
			'<p class="pegasus-child-empty-state" style="padding:14px;border:1px dashed #cfd6df;background:#fafbfc;color:#666;border-radius:4px;">%s%s</p>',
			esc_html( $message ),
			$edit_link
				? ' <a href="' . esc_url( $edit_link ) . '">' . esc_html__( 'Edit page', 'pegasus-child' ) . '</a>'
				: ''
		);
	}

	function pegasus_child_register_home_whitepaper_metabox() {
		$cmb = new_cmb2_box( array(
			'id'           => 'pegasus_child_home_whitepaper',
			'title'        => __( 'Home Whitepaper', 'pegasus-child' ),
			'object_types' => array( 'page' ),
			'context'      => 'normal',
			'priority'     => 'high',
			'show_on_cb'   => 'pegasus_child_show_metabox_on_home_template',
		) );

		$cmb->add_field( array(
			'name' => __( 'Title', 'pegasus-child' ),
			'id'   => 'home_whitepaper_title',
			'type' => 'text',
		) );

		$cmb->add_field( array(
			'name'    => __( 'Content', 'pegasus-child' ),
			'id'      => 'home_whitepaper_content',
			'type'    => 'wysiwyg',
			'options' => array(
				'media_buttons' => true,
				'textarea_rows' => 8,
			),
		) );

		$cmb->add_field( array(
			'name' => __( 'Button Link', 'pegasus-child' ),
			'id'   => 'home_whitepaper_button_link',
			'type' => 'text_url',
		) );

		$cmb->add_field( array(
			'name' => __( 'Button Text', 'pegasus-child' ),
			'id'   => 'home_whitepaper_button_text',
			'type' => 'text',
		) );
	}
	add_action( 'cmb2_admin_init', 'pegasus_child_register_home_whitepaper_metabox' );

	function pegasus_child_render_home_whitepaper( $post_id = 0 ) {
		$post_id     = $post_id ? $post_id : get_the_ID();
		$title       = get_post_meta( $post_id, 'home_whitepaper_title', true );
		$content     = get_post_meta( $post_id, 'home_whitepaper_content', true );
		$button_link = get_post_meta( $post_id, 'home_whitepaper_button_link', true );
		$button_text = get_post_meta( $post_id, 'home_whitepaper_button_text', true );

		if ( '' === trim( $title ) && '' === trim( wp_strip_all_tags( $content ) ) && '' === trim( $button_link ) && '' === trim( $button_text ) ) {
			pegasus_child_render_empty_state( __( 'No whitepaper content has been added yet. Edit this page and add content under "Home Whitepaper".', 'pegasus-child' ), $post_id );
			return;
		}

		echo '<div class="home-whitepaper">';

		if ( $title ) {
			echo '<h2>' . esc_html( $title ) . '</h2>';
		}

		if ( $content ) {
			remove_filter( 'the_content', 'wp_filter_content_tags', 10 );
			$rendered_content = apply_filters( 'the_content', $content );
			add_filter( 'the_content', 'wp_filter_content_tags', 10 );
			echo '<div class="home-whitepaper-content">' . pegasus_child_strip_pct20_from_img_urls( $rendered_content ) . '</div>';
		}

		if ( $button_link && $button_text ) {
			echo '<a class="btn" href="' . esc_url( $button_link ) . '">' . esc_html( $button_text ) . '</a>';
		}

		echo '</div>';
	}

	/**
	 * Strip %20 (URL-encoded space) out of <img src> and srcset URLs.
	 *
	 * Many legacy uploads on this site have filenames with stray spaces in
	 * their `_wp_attached_file` records even though the files on disk have
	 * no space. The %20 in attribute values produces broken image links;
	 * this scrubs it so the URL resolves to the real file.
	 *
	 * Only touches `<img …>` tags; href URLs elsewhere are left alone.
	 */
	function pegasus_child_strip_pct20_from_img_urls( $html ) {
		if ( false === stripos( $html, '%20' ) ) {
			return $html;
		}
		return preg_replace_callback(
			'/<img\b[^>]*>/i',
			function ( $m ) {
				$tag = $m[0];
				$tag = preg_replace_callback(
					'/\b(src|srcset)\s*=\s*("([^"]*)"|\'([^\']*)\')/i',
					function ( $a ) {
						$attr  = $a[1];
						$quote = $a[2][0];
						$val   = $a[3] !== '' ? $a[3] : $a[4];
						return $attr . '=' . $quote . str_replace( '%20', '', $val ) . $quote;
					},
					$tag
				);
				return $tag;
			},
			$html
		);
	}

	function pegasus_child_render_home_slider( $post_id = 0 ) {
		$post_id = $post_id ? $post_id : get_the_ID();
		$slides  = get_post_meta( $post_id, 'home_slider_slides', true );

		$shortcode = '[slider]';
		$slide_id  = 1;
		if ( is_array( $slides ) ) {
			foreach ( $slides as $slide ) {
				$img_url = isset( $slide['image'] ) ? esc_url( $slide['image'] ) : '';
				if ( '' === $img_url ) {
					continue;
				}
				$shortcode .= '[slide id="' . absint( $slide_id ) . '"]<img class="size-full" src="' . $img_url . '" />[/slide]';
				$slide_id++;
			}
		}
		$shortcode .= '[/slider]';

		// Slide count is 1-indexed; nothing was added if it never advanced.
		if ( 1 === $slide_id ) {
			pegasus_child_render_empty_state( __( 'No slides have been added yet. Edit this page and add some under "Home Slider".', 'pegasus-child' ), $post_id );
			return;
		}

		echo do_shortcode( $shortcode );
	}


	/**
	 * Home Tabs — CMB2 metabox + render helper.
	 *
	 * Shows a repeatable group on any page using tpl_home.php. Each tab is a
	 * Title (text) + Content (wysiwyg). The render helper builds a
	 * [tabs][tab class="…" title="…"]content[/tab]…[/tabs] string and feeds
	 * it to do_shortcode(), so the existing Pegasus Tabs HTML (.js-tab-widget
	 * / ul.tab-list / li.tab-item / a.tab-link / section.tab-panel) and the
	 * positional classes (first/second/third/fourth/…) are preserved.
	 */
	function pegasus_child_register_home_tabs_metabox() {
		$cmb = new_cmb2_box( array(
			'id'           => 'pegasus_child_home_tabs',
			'title'        => __( 'Home Tabs', 'pegasus-child' ),
			'object_types' => array( 'page' ),
			'context'      => 'normal',
			'priority'     => 'high',
			'show_on_cb'   => 'pegasus_child_show_metabox_on_home_template',
		) );

		$group_id = $cmb->add_field( array(
			'id'          => 'home_tabs_items',
			'type'        => 'group',
			'description' => __( 'Add, remove, and drag-to-reorder tabs.', 'pegasus-child' ),
			'options'     => array(
				'group_title'   => __( 'Tab {#}', 'pegasus-child' ),
				'add_button'    => __( 'Add tab', 'pegasus-child' ),
				'remove_button' => __( 'Remove tab', 'pegasus-child' ),
				'sortable'      => true,
			),
		) );

		$cmb->add_group_field( $group_id, array(
			'name' => __( 'Title', 'pegasus-child' ),
			'id'   => 'title',
			'type' => 'text',
		) );

		$cmb->add_group_field( $group_id, array(
			'name'    => __( 'Content', 'pegasus-child' ),
			'id'      => 'content',
			'type'    => 'wysiwyg',
			'options' => array(
				'media_buttons' => true,
				'textarea_rows' => 12,
			),
		) );
	}
	add_action( 'cmb2_admin_init', 'pegasus_child_register_home_tabs_metabox' );

	/**
	 * Render the home tabs.
	 *
	 * Builds the exact HTML the [tabs]/[tab] shortcodes produce (.js-tab-widget
	 * > ul.tab-list > li.tab-item > a.tab-link, followed by section.tab-panel
	 * siblings) so the existing CSS and the tabs plugin JS keep working
	 * unchanged. Per-tab content is run through the standard `the_content`
	 * filter so wysiwyg HTML, image URLs, smart quotes, paragraph wrapping,
	 * responsive image transforms, and inline shortcodes (e.g. [btn]) all
	 * resolve consistently with regular post content. Building markup directly
	 * (rather than going through [tabs]/[tab]) avoids the shortcode parser
	 * choking on stray brackets or square-bracket characters that can appear
	 * in editor-pasted image markup.
	 */
	function pegasus_child_render_home_tabs( $post_id = 0 ) {
		$post_id = $post_id ? $post_id : get_the_ID();
		$tabs    = get_post_meta( $post_id, 'home_tabs_items', true );

		// Preserve the legacy positional class names so existing CSS keeps applying.
		$position_classes = array( 'first', 'second', 'third', 'fourth', 'fifth', 'sixth', 'seventh', 'eighth' );

		$list_items   = '';
		$section_html = '';
		$i = 0;
		if ( is_array( $tabs ) ) {
			foreach ( $tabs as $tab ) {
				$title   = isset( $tab['title'] )   ? trim( $tab['title'] )   : '';
				$content = isset( $tab['content'] ) ? $tab['content']         : '';
				if ( '' === $title && '' === trim( wp_strip_all_tags( $content ) ) ) {
					continue;
				}
				$class  = isset( $position_classes[ $i ] ) ? $position_classes[ $i ] : 'tab-' . ( $i + 1 );
				$tab_id = $i + 1;

				/*
				 * wp_filter_content_tags() (added to `the_content` at priority 10 in WP 5.5+)
				 * regenerates <img> tags using the attachment's canonical URL from
				 * _wp_attached_file. Legacy media-library records with a stray space
				 * in the filename produce URLs like CG2%20_600_… which 404 when the
				 * actual file on disk has no space. Suspend it for this render so the
				 * editor-saved src passes through verbatim.
				 */
				remove_filter( 'the_content', 'wp_filter_content_tags', 10 );
				$rendered = apply_filters( 'the_content', $content );
				add_filter( 'the_content', 'wp_filter_content_tags', 10 );

				// Safety net: if anything else (or the editor) injected %20 into
				// an <img src> / srcset, strip it so the URL points at the
				// real file on disk.
				$rendered = pegasus_child_strip_pct20_from_img_urls( $rendered );

				$list_items   .= '<li class="tab-item ' . esc_attr( $class ) . '">'
					. '<a class="tab-link" href="#tab-' . absint( $tab_id ) . '" >' . esc_html( $title ) . '</a>'
					. '</li>';
				$section_html .= '<section id="tab-' . absint( $tab_id ) . '" class="tab-panel">' . $rendered . '</section>';
				$i++;
			}
		}

		if ( 0 === $i ) {
			pegasus_child_render_empty_state( __( 'No tabs have been added yet. Edit this page and add some under "Home Tabs".', 'pegasus-child' ), $post_id );
			return;
		}

		echo '<div class="js-tab-widget"><ul class="tab-list" >' . $list_items . '</ul>' . $section_html . '</div>';
	}


	/**
	 * Home Accordion — CMB2 metabox + render helper.
	 *
	 * Shows a repeatable group on any page using tpl_home.php. Each row is a
	 * Title (text) + Content (wysiwyg). The render helper builds the exact
	 * HTML the [accordions]/[accordion] shortcodes produce so the existing
	 * .pegasus-accordion CSS and the plugin's accordion JS keep working:
	 *
	 *   <div class="pegasus-accordion">
	 *     <div class="accordion-item">
	 *       <button id="accordion-button-N" aria-expanded="false">
	 *         <span class="accordion-title">…</span>
	 *         <span class="icon" aria-hidden="true"></span>
	 *       </button>
	 *       <section id="accordion-N" class="accordion-panel accordion-content">…</section>
	 *     </div>
	 *     …
	 *   </div>
	 *
	 * Content is run through `the_content` (with wp_filter_content_tags
	 * temporarily removed) just like the tabs renderer, so wysiwyg HTML,
	 * paragraphs, smart quotes, and inline [btn] shortcodes resolve cleanly
	 * — and a safety-net pass strips %20 from <img src> URLs.
	 */
	function pegasus_child_register_home_accordion_metabox() {
		$cmb = new_cmb2_box( array(
			'id'           => 'pegasus_child_home_accordion',
			'title'        => __( 'Home Accordion', 'pegasus-child' ),
			'object_types' => array( 'page' ),
			'context'      => 'normal',
			'priority'     => 'high',
			'show_on_cb'   => 'pegasus_child_show_metabox_on_home_template',
		) );

		$group_id = $cmb->add_field( array(
			'id'          => 'home_accordion_items',
			'type'        => 'group',
			'description' => __( 'Add, remove, and drag-to-reorder accordion items.', 'pegasus-child' ),
			'options'     => array(
				'group_title'   => __( 'Accordion item {#}', 'pegasus-child' ),
				'add_button'    => __( 'Add accordion item', 'pegasus-child' ),
				'remove_button' => __( 'Remove accordion item', 'pegasus-child' ),
				'sortable'      => true,
			),
		) );

		$cmb->add_group_field( $group_id, array(
			'name' => __( 'Title', 'pegasus-child' ),
			'id'   => 'title',
			'type' => 'text',
		) );

		$cmb->add_group_field( $group_id, array(
			'name'    => __( 'Content', 'pegasus-child' ),
			'id'      => 'content',
			'type'    => 'wysiwyg',
			'options' => array(
				'media_buttons' => true,
				'textarea_rows' => 12,
			),
		) );
	}
	add_action( 'cmb2_admin_init', 'pegasus_child_register_home_accordion_metabox' );

	function pegasus_child_render_home_accordion( $post_id = 0 ) {
		$post_id = $post_id ? $post_id : get_the_ID();
		$items   = get_post_meta( $post_id, 'home_accordion_items', true );

		$rows = '';
		$i = 0;
		if ( is_array( $items ) ) {
			foreach ( $items as $item ) {
				$title   = isset( $item['title'] )   ? trim( $item['title'] )   : '';
				$content = isset( $item['content'] ) ? $item['content']         : '';
				if ( '' === $title && '' === trim( wp_strip_all_tags( $content ) ) ) {
					continue;
				}
				$item_id = $i + 1;

				// Mirror the tabs renderer: bypass wp_filter_content_tags so the editor's
				// saved <img src> passes through verbatim, then scrub any stray %20.
				remove_filter( 'the_content', 'wp_filter_content_tags', 10 );
				$rendered = apply_filters( 'the_content', $content );
				add_filter( 'the_content', 'wp_filter_content_tags', 10 );
				$rendered = pegasus_child_strip_pct20_from_img_urls( $rendered );

				$rows .= '<div class="accordion-item">'
					. '<button id="accordion-button-' . absint( $item_id ) . '" aria-expanded="false">'
					. '<span class="accordion-title">' . esc_html( $title ) . '</span>'
					. '<span class="icon" aria-hidden="true"></span>'
					. '</button>'
					. '<section id="accordion-' . absint( $item_id ) . '" class="accordion-panel accordion-content">' . $rendered . '</section>'
					. '</div>';
				$i++;
			}
		}

		if ( 0 === $i ) {
			pegasus_child_render_empty_state( __( 'No accordion items have been added yet. Edit this page and add some under "Home Accordion".', 'pegasus-child' ), $post_id );
			return;
		}

		echo '<div class="pegasus-accordion">' . $rows . '</div>';
	}

	function pegasus_child_render_home_news_query_slider() {
		$news_query = new WP_Query( array(
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'posts_per_page'      => 3,
			'category_name'       => 'news',
			'ignore_sticky_posts' => true,
		) );

		if ( ! $news_query->have_posts() ) {
			pegasus_child_render_empty_state( __( 'No published posts were found in the news category.', 'pegasus-child' ) );
			return;
		}

		wp_enqueue_style( 'slippery-css' );
		wp_enqueue_style( 'slippery-slider-css' );
		wp_enqueue_script( 'slippery-js' );
		wp_enqueue_script( 'pegasus-slider-plugin-js' );

		echo '<ul class="slippry-slider-container home-news-query-slider">';

		while ( $news_query->have_posts() ) {
			$news_query->the_post();

			echo '<li class="home-news-query-slide">';
			echo '<article class="home-news-query-slide-content">';

			if ( has_post_thumbnail() ) {
				the_post_thumbnail( 'medium_large', array( 'class' => 'home-news-query-slider-image' ) );
			}

			echo '<h3><a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a></h3>';
			echo '<p>' . esc_html( wp_trim_words( get_the_excerpt(), 25 ) ) . '</p>';
			echo '<a class="read-more-link" href="' . esc_url( get_permalink() ) . '">' . esc_html__( 'Read More', 'pegasus-child' ) . '</a>';
			echo '</article>';
			echo '</li>';
		}

		echo '</ul>';

		wp_reset_postdata();
	}

	function pegasus_child_register_home_testimonial_metabox() {
		$cmb = new_cmb2_box( array(
			'id'           => 'pegasus_child_home_testimonials',
			'title'        => __( 'Home Testimonials', 'pegasus-child' ),
			'object_types' => array( 'page' ),
			'context'      => 'normal',
			'priority'     => 'high',
			'show_on_cb'   => 'pegasus_child_show_metabox_on_home_template',
		) );

		$group_id = $cmb->add_field( array(
			'id'          => 'home_testimonials',
			'type'        => 'group',
			'description' => __( 'Add, remove, and drag-to-reorder testimonials for the homepage slider.', 'pegasus-child' ),
			'options'     => array(
				'group_title'   => __( 'Testimonial {#}', 'pegasus-child' ),
				'add_button'    => __( 'Add testimonial', 'pegasus-child' ),
				'remove_button' => __( 'Remove testimonial', 'pegasus-child' ),
				'sortable'      => true,
			),
		) );

		$cmb->add_group_field( $group_id, array(
			'name'    => __( 'Testimonial', 'pegasus-child' ),
			'id'      => 'quote',
			'type'    => 'textarea',
			'options' => array(
				'textarea_rows' => 6,
			),
		) );

		$cmb->add_group_field( $group_id, array(
			'name' => __( 'Name', 'pegasus-child' ),
			'id'   => 'name',
			'type' => 'text',
		) );

		$cmb->add_group_field( $group_id, array(
			'name' => __( 'Title / Company', 'pegasus-child' ),
			'id'   => 'title',
			'type' => 'text',
		) );
	}
	add_action( 'cmb2_admin_init', 'pegasus_child_register_home_testimonial_metabox' );

	function pegasus_child_render_home_testimonial_slider( $post_id = 0 ) {
		$post_id      = $post_id ? $post_id : get_the_ID();
		$testimonials = get_post_meta( $post_id, 'home_testimonials', true );

		if ( ! is_array( $testimonials ) ) {
			pegasus_child_render_empty_state( __( 'No testimonials have been added yet. Edit this page and add some under "Home Testimonials".', 'pegasus-child' ), $post_id );
			return;
		}

		$slides = '';

		foreach ( $testimonials as $testimonial ) {
			$quote = isset( $testimonial['quote'] ) ? trim( $testimonial['quote'] ) : '';
			$name  = isset( $testimonial['name'] ) ? trim( $testimonial['name'] ) : '';
			$title = isset( $testimonial['title'] ) ? trim( $testimonial['title'] ) : '';

			if ( '' === $quote && '' === $name && '' === $title ) {
				continue;
			}

			$slide  = '<li class="home-testimonial-slide">';
			$slide .= '<div class="home-testimonial-slide-content">';
			if ( $quote ) {
				$slide .= '<blockquote><p>' . esc_html( $quote ) . '</p></blockquote>';
			}
			if ( $name || $title ) {
				$slide .= '<p class="home-testimonial-attribution">';
				if ( $name ) {
					$slide .= '<strong>' . esc_html( $name ) . '</strong>';
				}
				if ( $name && $title ) {
					$slide .= '<br>';
				}
				if ( $title ) {
					$slide .= '<span>' . esc_html( $title ) . '</span>';
				}
				$slide .= '</p>';
			}
			$slide .= '</div>';
			$slide .= '</li>';

			$slides .= $slide;
		}

		if ( '' === $slides ) {
			pegasus_child_render_empty_state( __( 'No testimonials have been added yet. Edit this page and add some under "Home Testimonials".', 'pegasus-child' ), $post_id );
			return;
		}

		wp_enqueue_style( 'slippery-css' );
		wp_enqueue_style( 'slippery-slider-css' );
		wp_enqueue_script( 'slippery-js' );
		wp_enqueue_script( 'pegasus-slider-plugin-js' );

		echo '<ul class="slippry-slider-container home-testimonial-slider">' . $slides . '</ul>';
	}


	$apptivo_file = get_stylesheet_directory() . '/apptivo.php';

	if (file_exists($apptivo_file)) {
		require_once $apptivo_file;
		error_log("Apptivo integration loaded successfully.");
	} else {
		error_log("Apptivo integration file not found: " . $apptivo_file);
	}
