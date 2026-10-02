<?php
	
	function theme_enqueue_styles() {
		wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
		wp_enqueue_style( 'child-style',
			get_stylesheet_directory_uri() . '/style.css',
			array( 'parent-style' ),
			filemtime( get_stylesheet_directory() . '/style.css' ) // cache-bust on every edit
		);
		
		/* qTip CSS */
		//wp_enqueue_style('twentytwenty-css', get_stylesheet_directory_uri() . '/css/twentytwenty.css', null, false, false);
		
		wp_enqueue_style( 'slick-css', get_stylesheet_directory_uri() . '/css/slick.css', array(), null, 'all' );
		wp_enqueue_style( 'slick-theme-css', get_stylesheet_directory_uri() . '/css/slick-theme.css', array(), null, 'all' );
		
	}
	add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

	/**
	 * The parent theme enqueues the child style.css under the 'pegasus' handle (with the
	 * theme-options :root CSS variables, e.g. --pegasus-nav-bg-color, attached as an inline
	 * style via wp_add_inline_style) but with NO version, so the browser can serve a stale
	 * copy. Give that handle a filemtime version so edits bust cache — do NOT dequeue it, or
	 * the inline --pegasus-* variables the header/footer depend on disappear.
	 */
	add_action( 'wp_enqueue_scripts', 'vq_version_pegasus_style', 100 );
	function vq_version_pegasus_style() {
		$styles = wp_styles();
		if ( isset( $styles->registered['pegasus'] ) ) {
			$styles->registered['pegasus']->ver = filemtime( get_stylesheet_directory() . '/style.css' );
		}
	}
	/* ~~~~~^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^~~~~~
	~~~~PROPER WAY OF ADDING CHILD THEME CSS FILE ~~~~
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/

	
	
	
	/**
	* Proper way to enqueue JS and IE fixes as of Mar 2015
	*/
	function pegasus_child_bootstrap_js() {
		
		//wp_enqueue_script( 'pegasus_custom_js', get_stylesheet_directory_uri() . '/js/octane-custom.js', array(), '', true );
		
		//wp_enqueue_script( 'matchHeight_js', get_stylesheet_directory_uri() . '/js/jquery.matchHeight-min.js', array(), '', true );
		/* scripts */
		wp_enqueue_script('modernizer_js', get_stylesheet_directory_uri() .'/js/modernizr.custom.js', array('jquery'), false, true);
		//wp_enqueue_script('mettile_js', get_stylesheet_directory_uri() .'/js/jquery.mettile-1.1.js', array('jquery'), false, true);
		
		//if( is_page( 'home' ) ) wp_enqueue_script('packery_js', get_stylesheet_directory_uri() .'/js/packery.pkgd.js', array('jquery'), false, true);
		//if( is_page( '2610' ) ) wp_enqueue_script('packery_js', get_stylesheet_directory_uri() .'/js/packery.pkgd.js', array('jquery'), false, true);
		if( is_page( '2610' ) ) wp_enqueue_script('masonry_js', get_stylesheet_directory_uri() .'/js/masonry.js', array('jquery'), false, true);

		// Single portfolio: Packery gallery (imagesLoaded is a WP-core registered handle) + Lightbox2.
		if ( is_singular( 'portfolio' ) ) {
			wp_enqueue_script( 'imagesloaded' );
			wp_enqueue_script( 'packery_js', get_stylesheet_directory_uri() . '/js/packery.pkgd.js', array( 'jquery', 'imagesloaded' ), null, true );
			// Lightbox2 (v2.11.4) — same library the sage_theme card-sets CPT uses. Auto-inits on
			// anchors with data-lightbox; captions via data-title; arrow keys built in.
			wp_enqueue_style( 'lightbox-css', get_stylesheet_directory_uri() . '/css/lightbox.min.css', array(), filemtime( get_stylesheet_directory() . '/css/lightbox.min.css' ) );
			wp_enqueue_script( 'lightbox_js', get_stylesheet_directory_uri() . '/js/lightbox.min.js', array( 'jquery' ), filemtime( get_stylesheet_directory() . '/js/lightbox.min.js' ), true );
		}

		wp_enqueue_script( 'visionquest_custom_js', get_stylesheet_directory_uri() . '/js/pegasus_custom.js', array(), '', true );
		
		if(is_page( '211' ) || is_category() ) wp_enqueue_script( 'classie_custom_js', get_stylesheet_directory_uri() . '/js/classie.js', array(), '', true );
		if(is_page( '211' ) || is_category() ) wp_enqueue_script('pegasus_custom_blog_js', get_stylesheet_directory_uri() .'/js/blog-js.js', array('jquery'), false, true);
		
		
		wp_enqueue_script( 'parallax_js', get_stylesheet_directory_uri() . '/js/parallax.js', array(), '', true );
		
		// if(is_page( '69' )) wp_enqueue_script( 'overflow_android_js', get_stylesheet_directory_uri() . '/js/overflow-android.min.js', array('jquery'), '', true );
		//if(is_page( '69' )) wp_enqueue_script( 'foundation_js', '//cdnjs.cloudflare.com/ajax/libs/foundation/5.5.0/js/foundation.min.js', array(), '', true );
		//if(is_page( '69' )) wp_enqueue_script( 'hammer_js', '//cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.6/hammer.min.js', array(), '', true );
		
		wp_enqueue_script( 'matchHeight_js', get_stylesheet_directory_uri() . '/js/jquery.matchHeight-min.js', array(), '', true );
		
		if(is_page( '131' )) wp_enqueue_script( 'mix_it_up_js', get_stylesheet_directory_uri() . '/js/mixitup.js', array(), '', true );
		if(is_page( '131' )) wp_enqueue_script( 'masonry');
		if(is_page( '131' )) wp_enqueue_style(  'portfolio_drawer_css', get_stylesheet_directory_uri() . '/css/portfolio-drawer.css', array(), null );
		if(is_page( '131' )) wp_enqueue_script( 'portfolio_drawer_js',  get_stylesheet_directory_uri() . '/js/portfolio-drawer.js',  array( 'jquery', 'mix_it_up_js' ), null, true );

		if( is_page_template( 'tpl_resume.php' ) ) wp_enqueue_style( 'resume_css', get_stylesheet_directory_uri() . '/css/resume.css', array(), null );
		
		wp_enqueue_script( 'slick-js', get_stylesheet_directory_uri() . '/js/slick.js', array( 'jquery' ), null, true );
		
		//if(is_page( '2588' )) wp_enqueue_script( 'stripe_custom_js', get_stylesheet_directory_uri() . '/js/stripe.js', array(), '', true );
		//if(is_page( '2588' )) wp_enqueue_script( 'stripe_js', 'https://js.stripe.com/v3', array(), '', false );
		
		wp_enqueue_script('gsap-js', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.2/gsap.min.js', array(), null, true);
		wp_enqueue_script('gsap-scrolltrigger', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.2/ScrollTrigger.min.js', array(), null, true);
		
	} //end function
	add_action( 'wp_enqueue_scripts', 'pegasus_child_bootstrap_js' );

	/* ===============================================================================================
	============================ PORTFOLIO CASE-STUDY FIELDS (CMB2) ==================================
	CMB2 is bundled by the parent Pegasus theme, so new_cmb2_box() is available here. Adds the
	live URL, an "engagement focus" label, and a repeatable image gallery that powers the Packery
	grid on single-portfolio.php. The gallery group is collapsed by default ('closed' => true).
	=============================================================================================== */
	add_action( 'cmb2_admin_init', 'vq_portfolio_cmb2_fields' );
	function vq_portfolio_cmb2_fields() {

		if ( ! function_exists( 'new_cmb2_box' ) ) {
			return;
		}

		$cmb = new_cmb2_box( array(
			'id'           => 'vq_portfolio_meta',
			'title'        => __( 'Project Details', 'pegasus-child' ),
			'object_types' => array( 'portfolio' ),
			'context'      => 'normal',
			'priority'     => 'high',
		) );

		$cmb->add_field( array(
			'name' => __( 'Live URL', 'pegasus-child' ),
			'id'   => 'vq_live_url',
			'type' => 'text_url',
			'desc' => __( 'Live site URL — powers the “View Live Site” button.', 'pegasus-child' ),
		) );

		$cmb->add_field( array(
			'name' => __( 'Engagement Focus', 'pegasus-child' ),
			'id'   => 'vq_engagement_focus',
			'type' => 'text',
			'desc' => __( 'Short service label, e.g. “Web Design &amp; Development · E-Commerce”.', 'pegasus-child' ),
		) );

		// Repeatable gallery group — collapsed by default per request.
		$gallery = $cmb->add_field( array(
			'id'          => 'vq_gallery',
			'type'        => 'group',
			'name'        => __( 'Project Gallery', 'pegasus-child' ),
			'description' => __( 'Images shown in the Packery grid on the project page.', 'pegasus-child' ),
			'options'     => array(
				'group_title'   => __( 'Image {#}', 'pegasus-child' ),
				'add_button'    => __( 'Add image', 'pegasus-child' ),
				'remove_button' => __( 'Remove image', 'pegasus-child' ),
				'sortable'      => true,
				'closed'        => true, // collapsed by default
			),
		) );

		$cmb->add_group_field( $gallery, array(
			'name'         => __( 'Image', 'pegasus-child' ),
			'id'           => 'image',
			'type'         => 'file',
			'options'      => array( 'url' => false ),
			'query_args'   => array( 'type' => 'image' ),
			'preview_size' => 'medium',
		) );

		$cmb->add_group_field( $gallery, array(
			'name' => __( 'Caption', 'pegasus-child' ),
			'id'   => 'caption',
			'type' => 'text',
		) );
	}
	

	
	/* ===============================================================================================
	============================ CUSTOM POST TYPE  ==================================================
	================================================================================================*/
	add_action( 'init', 'octane_cpt_init' );
	function octane_cpt_init() {
		
		

		/*============================
		======= Portfolio Post Type ========
		============================*/
		
		$portfolio_labels = array(
			'name' => _x('Portfolios', 'post type general name', 'octane-bootstrap'),
			'singular_name' => _x('Portfolio', 'post type singular name', 'octane-bootstrap'),
			'add_new' => _x('Add New', 'portfolio', 'octane-bootstrap'),
			'add_new_item' => __('Add New Portfolio', 'octane-bootstrap'),
			'edit_item' => __('Edit Portfolio', 'octane-bootstrap'),
			'new_item' => __('New Portfolio', 'octane-bootstrap'),
			'view_item' => __('View Portfolio', 'octane-bootstrap'),
			'search_items' => __('Search Portfolio', 'octane-bootstrap'),
			'not_found' =>  __('No portfolio found', 'octane-bootstrap'),
			'not_found_in_trash' => __('No portfolio found in Trash', 'octane-bootstrap'),
			'parent_item_colon' => '',
			'menu_name' => 'Portfolio'
		);
		   
		// Some arguments and in the last line 'supports', we say to WordPress what features are supported on the Project post type
		$portfolio_args = array(
			'labels' => $portfolio_labels,
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
			'hierarchical' => true,
			'menu_position' => null,
			/* include this line to use global categories */
			//'taxonomies' => array('category'),
			'supports' => array('title','editor','author','thumbnail','excerpt','comments','custom-fields','page-attributes')
		);
	
		// We call this function to register the custom post type
		register_post_type('portfolio',$portfolio_args);
		
		/*============================
		======= Portfolio Taxonomy ========
		============================*/
		
		
		// Initialize Taxonomy Labels
		$tax_labels = array(
			'name' => _x( 'Categories', 'taxonomy general name', 'octane-bootstrap' ),
			'singular_name' => _x( 'Cat', 'taxonomy singular name' , 'octane-bootstrap'),
			'search_items' =>  __( 'Search Types' , 'octane-bootstrap'),
			'all_items' => __( 'All Cats' , 'octane-bootstrap'),
			'parent_item' => __( 'Parent Cats', 'octane-bootstrap' ),
			'parent_item_colon' => __( 'Parent Cats:' , 'octane-bootstrap'),
			'edit_item' => __( 'Edit Cats', 'octane-bootstrap' ),
			'update_item' => __( 'Update Cats' , 'octane-bootstrap'),
			'add_new_item' => __( 'Add New Cats', 'octane-bootstrap' ),
			'new_item_name' => __( 'New Cats Name' , 'octane-bootstrap'),
		);
		
		// Register Custom Taxonomy
		register_taxonomy('portcats',array('portfolio'), array(
			'hierarchical' => true, // define whether to use a system like tags or categories
			'labels' => $tax_labels,
			'show_ui' => true,
			'show_admin_column'     => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'portfolio' ),
		));
		
		/*============================
			======= Portfolio TAGS ========
			============================*/
			
			// Add new taxonomy, NOT hierarchical (like tags)
			$labels = array(
				'name' => _x( 'Tags', 'taxonomy general name' ),
				'singular_name' => _x( 'Tag', 'taxonomy singular name' ),
				'search_items' =>  __( 'Search Tags' ),
				'popular_items' => __( 'Popular Tags' ),
				'all_items' => __( 'All Tags' ),
				'parent_item' => null,
				'parent_item_colon' => null,
				'edit_item' => __( 'Edit Tag' ), 
				'update_item' => __( 'Update Tag' ),
				'add_new_item' => __( 'Add New Tag' ),
				'new_item_name' => __( 'New Tag Name' ),
				'separate_items_with_commas' => __( 'Separate tags with commas' ),
				'add_or_remove_items' => __( 'Add or remove tags' ),
				'choose_from_most_used' => __( 'Choose from the most used tags' ),
				'menu_name' => __( 'Tags' ),
			); 

			register_taxonomy('feattag','portfolio',array(
				'hierarchical' => false,
				'labels' => $labels,
				'show_ui' => true,
				'update_count_callback' => '_update_post_term_count',
				'query_var' => true,
				'rewrite' => array( 'slug' => 'feattag' ),
			));
			
			
			
			
			
		
		/*============================
		======= END Taxonomy ====================================*/
		
		
		
	}
	
	

	/**
	* Better Pre-submission Confirmation
	* http://gravitywiz.com/2012/08/04/better-pre-submission-confirmation/
	* {all_fields}
	*/
	class GWPreviewConfirmation {

		private static $lead;

		public static function init() {
			add_filter( 'gform_pre_render', array( __class__, 'replace_merge_tags' ) );
		}

		public static function replace_merge_tags( $form ) {

			$current_page = isset(GFFormDisplay::$submission[$form['id']]) ? GFFormDisplay::$submission[$form['id']]['page_number'] : 1;
			$fields = array();

			// get all HTML fields on the current page
			foreach($form['fields'] as &$field) {

				// skip all fields on the first page
				if(rgar($field, 'pageNumber') <= 1)
					continue;

				$default_value = rgar($field, 'defaultValue');
				preg_match_all('/{.+}/', $default_value, $matches, PREG_SET_ORDER);
				if(!empty($matches)) {
					// if default value needs to be replaced but is not on current page, wait until on the current page to replace it
					if(rgar($field, 'pageNumber') != $current_page) {
						$field['defaultValue'] = '';
					} else {
						$field['defaultValue'] = self::preview_replace_variables($default_value, $form);
					}
				}

				// only run 'content' filter for fields on the current page
				if(rgar($field, 'pageNumber') != $current_page)
					continue;

				$html_content = rgar($field, 'content');
				preg_match_all('/{.+}/', $html_content, $matches, PREG_SET_ORDER);
				if(!empty($matches)) {
					$field['content'] = self::preview_replace_variables($html_content, $form);
				}

			}

			return $form;
		}

		/**
		* Adds special support for file upload, post image and multi input merge tags.
		*/
		public static function preview_special_merge_tags($value, $input_id, $merge_tag, $field) {
			
			// added to prevent overriding :noadmin filter (and other filters that remove fields)
			if( ! $value )
				return $value;
			
			$input_type = RGFormsModel::get_input_type($field);
			
			$is_upload_field = in_array( $input_type, array('post_image', 'fileupload') );
			$is_multi_input = is_array( rgar($field, 'inputs') );
			$is_input = intval( $input_id ) != $input_id;
			
			if( !$is_upload_field && !$is_multi_input )
				return $value;

			// if is individual input of multi-input field, return just that input value
			if( $is_input )
				return $value;
				
			$form = RGFormsModel::get_form_meta($field['formId']);
			$lead = self::create_lead($form);
			$currency = GFCommon::get_currency();

			if(is_array(rgar($field, 'inputs'))) {
				$value = RGFormsModel::get_lead_field_value($lead, $field);
				return GFCommon::get_lead_field_display($field, $value, $currency);
			}

			switch($input_type) {
			case 'fileupload':
				$value = self::preview_image_value("input_{$field['id']}", $field, $form, $lead);
				$value = self::preview_image_display($field, $form, $value);
				break;
			default:
				$value = self::preview_image_value("input_{$field['id']}", $field, $form, $lead);
				$value = GFCommon::get_lead_field_display($field, $value, $currency);
				break;
			}

			return $value;
		}

		public static function preview_image_value($input_name, $field, $form, $lead) {

			$field_id = $field['id'];
			$file_info = RGFormsModel::get_temp_filename($form['id'], $input_name);
			$source = RGFormsModel::get_upload_url($form['id']) . "/tmp/" . $file_info["temp_filename"];

			if(!$file_info)
				return '';

			switch(RGFormsModel::get_input_type($field)){

				case "post_image":
					list(,$image_title, $image_caption, $image_description) = explode("|:|", $lead[$field['id']]);
					$value = !empty($source) ? $source . "|:|" . $image_title . "|:|" . $image_caption . "|:|" . $image_description : "";
					break;

				case "fileupload" :
					$value = $source;
					break;

			}

			return $value;
		}

		public static function preview_image_display($field, $form, $value) {

			// need to get the tmp $file_info to retrieve real uploaded filename, otherwise will display ugly tmp name
			$input_name = "input_" . str_replace('.', '_', $field['id']);
			$file_info = RGFormsModel::get_temp_filename($form['id'], $input_name);

			$file_path = $value;
			if(!empty($file_path)){
				$file_path = esc_attr(str_replace(" ", "%20", $file_path));
				$value = "<a href='$file_path' target='_blank' title='" . __("Click to view", "gravityforms") . "'>" . $file_info['uploaded_filename'] . "</a>";
			}
			return $value;

		}

		/**
		* Retrieves $lead object from class if it has already been created; otherwise creates a new $lead object.
		*/
		public static function create_lead( $form ) {
			
			if( empty( self::$lead ) ) {
				self::$lead = GFFormsModel::create_lead( $form );
				self::clear_field_value_cache( $form );
			}
			
			return self::$lead;
		}

		public static function preview_replace_variables( $content, $form ) {

			$lead = self::create_lead($form);

			// add filter that will handle getting temporary URLs for file uploads and post image fields (removed below)
			// beware, the RGFormsModel::create_lead() function also triggers the gform_merge_tag_filter at some point and will
			// result in an infinite loop if not called first above
			add_filter('gform_merge_tag_filter', array('GWPreviewConfirmation', 'preview_special_merge_tags'), 10, 4);

			$content = GFCommon::replace_variables($content, $form, $lead, false, false, false);

			// remove filter so this function is not applied after preview functionality is complete
			remove_filter('gform_merge_tag_filter', array('GWPreviewConfirmation', 'preview_special_merge_tags'));

			return $content;
		}
		
		public static function clear_field_value_cache( $form ) {
			
			if( ! class_exists( 'GFCache' ) )
				return;
				
			foreach( $form['fields'] as &$field ) {
				if( GFFormsModel::get_input_type( $field ) == 'total' )
					GFCache::delete( 'GFFormsModel::get_lead_field_value__' . $field['id'] );
			}
			
		}

	}

	GWPreviewConfirmation::init();
	
	
	
	add_action('admin_head', 'my_custom_admin_style');

	function my_custom_admin_style() {
	  echo '<style>
		
		.js .tmce-active .wp-editor-area { color: black !important; }
		
	  </style>';
	}

	
		/* ========================================================================
	=================Enqueue Animate.CSS and WOW.js ==============================
	========================================================================*/
	add_action( 'wp_enqueue_scripts', 'sk_enqueue_scripts' );
	function sk_enqueue_scripts() {

		wp_enqueue_style( 'animate', get_stylesheet_directory_uri() . '/css/animate.min.css' );

		wp_enqueue_script( 'wow', get_stylesheet_directory_uri() . '/js/wow.min.js', array(), '', true );

	}

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


