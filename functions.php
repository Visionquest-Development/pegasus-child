<?php

	/**
	 * Plugin requirements (TGMPA) & Bootstrap CMB2
	 */
	//require_once get_template_directory_uri() . 'inc/class-tgm-plugin-activation.php';

	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	~~~~PROPER WAY OF ADDING CHILD THEME CSS FILE ~~~~
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/

	/**
	 * Load service catalogue + service-single CMB2 fields (mirrors the
	 * valorcare_theme structure: shared per-service defaults in inc/, plus the
	 * override metaboxes for the reusable Service Detail Page template).
	 */
	function hfhs_include_inc_files() {
		foreach ( array( 'hfhs-services-catalogue.php', 'cmb2-service-single-fields.php', 'cmb2-home-fields.php' ) as $file ) {
			$path = get_stylesheet_directory() . '/inc/' . $file;
			if ( file_exists( $path ) ) {
				require_once $path;
			}
		}
	}
	add_action( 'after_setup_theme', 'hfhs_include_inc_files' );

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
	 * FAQ template: load the pegasus-accordion plugin's CSS/JS.
	 *
	 * The plugin only auto-enqueues its assets when the [accordions] shortcode is in
	 * the page's post_content. Our FAQ template generates that shortcode from CMB2
	 * fields instead (so post_content stays empty), so we enqueue the plugin's own
	 * registered handles here when the FAQ template is in use. The accordion's base
	 * CSS stays in the plugin; style.css only overrides the look. Priority 20 runs
	 * after the plugin registers the handles (its callback is at the default 10).
	 */
	function hfhs_faq_enqueue_accordion() {
		if ( is_page_template( 'tpl_faq.php' ) ) {
			wp_enqueue_style( 'pegasus-accordions-css' );
			wp_enqueue_script( 'pegasus-accordions-plugin-js' );
		}
	}
	add_action( 'wp_enqueue_scripts', 'hfhs_faq_enqueue_accordion', 20 );


	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	~~~~ ABOUT PAGE — CMB2 FIELDS + "FIELD OR DEFAULT" HELPERS ~~~~~~~~~~~~~~~~~~~~
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	The About template (tpl_about.php) renders hard-coded default copy so the page
	looks complete out of the box. Each string/image is ALSO wired to a CMB2 field
	on the About page edit screen — when a field is filled in, its value replaces
	the matching default; when left blank, the default shows. Helpers below encode
	that "override-or-default" rule so the template stays readable.
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

	define( 'HFHS_ABOUT_PREFIX', '_hfhs_about_' );

	/**
	 * Return a single About-page meta value, or $default when the field is empty.
	 * Bound to the queried page so it works anywhere inside the template.
	 */
	function hfhs_about_field( $key, $default = '' ) {
		if ( isset( $GLOBALS['hfhs_prefill'] ) ) { $GLOBALS['hfhs_prefill'][ HFHS_ABOUT_PREFIX . $key ] = $default; }
		$id  = get_queried_object_id();
		$val = $id ? get_post_meta( $id, HFHS_ABOUT_PREFIX . $key, true ) : '';
		if ( is_string( $val ) ) {
			$val = trim( $val );
		}
		return ( '' === $val || null === $val || array() === $val ) ? $default : $val;
	}

	/**
	 * Return a repeatable-group meta value (array of rows), or $default array when
	 * the group has no filled rows.
	 */
	function hfhs_about_group( $key, $default = array() ) {
		if ( isset( $GLOBALS['hfhs_prefill'] ) ) { $GLOBALS['hfhs_prefill'][ HFHS_ABOUT_PREFIX . $key ] = $default; }
		$id  = get_queried_object_id();
		$val = $id ? get_post_meta( $id, HFHS_ABOUT_PREFIX . $key, true ) : array();
		if ( ! is_array( $val ) ) {
			return $default;
		}
		// Drop rows where every value is blank (an empty CMB2 group row).
		$rows = array_filter(
			$val,
			function( $row ) {
				return is_array( $row ) && '' !== trim( implode( '', array_map( 'strval', $row ) ) );
			}
		);
		return ! empty( $rows ) ? array_values( $rows ) : $default;
	}

	/**
	 * Only show the About metabox on pages that actually use the About template.
	 */
	function hfhs_show_on_about_template( $cmb ) {
		$post_id = $cmb->object_id();
		if ( ! $post_id && isset( $_GET['post'] ) ) {
			$post_id = absint( $_GET['post'] );
		}
		return $post_id && 'tpl_about.php' === get_page_template_slug( $post_id );
	}

	add_action( 'cmb2_admin_init', 'hfhs_about_register_metaboxes' );
	function hfhs_about_register_metaboxes() {
		$prefix = HFHS_ABOUT_PREFIX;

		$cmb = new_cmb2_box(
			array(
				'id'           => 'hfhs_about_content',
				'title'        => __( 'About Page Content', 'pegasus' ),
				'object_types' => array( 'page' ),
				'context'      => 'normal',
				'priority'     => 'high',
				'closed'       => true,
				'show_on_cb'   => 'hfhs_show_on_about_template',
			)
		);

		$cmb->add_field( array( 'name' => 'Hero', 'type' => 'title', 'id' => $prefix . 'title_hero', 'before_row' => '<hr>' ) );
		$cmb->add_field( array( 'name' => 'Hero Script Eyebrow', 'id' => $prefix . 'hero_eyebrow', 'type' => 'text', 'attributes' => array( 'placeholder' => 'Meet the Hart Family' ) ) );
		$cmb->add_field( array( 'name' => 'Hero Title', 'desc' => 'Wrap a phrase in &lt;em&gt;…&lt;/em&gt; for the italic accent.', 'id' => $prefix . 'hero_title', 'type' => 'textarea_small', 'attributes' => array( 'placeholder' => 'Your family of <em>home service</em> providers in Atlanta.' ) ) );
		$cmb->add_field( array( 'name' => 'Hero Intro', 'id' => $prefix . 'hero_text', 'type' => 'textarea_small' ) );
		$cmb->add_field( array( 'name' => 'Hero Background Image', 'id' => $prefix . 'hero_image', 'type' => 'file', 'options' => array( 'url' => false ), 'text' => array( 'add_upload_file_text' => 'Add Image' ) ) );

		$cmb->add_field( array( 'name' => 'Our Story', 'type' => 'title', 'id' => $prefix . 'title_story', 'before_row' => '<hr>' ) );
		$cmb->add_field( array( 'name' => 'Story Photo', 'id' => $prefix . 'story_image', 'type' => 'file', 'options' => array( 'url' => false ) ) );
		$cmb->add_field( array( 'name' => 'Story Photo Alt Text', 'id' => $prefix . 'story_image_alt', 'type' => 'text' ) );
		$cmb->add_field( array( 'name' => 'Story Heading', 'desc' => 'Use &lt;em&gt; for the italic accent.', 'id' => $prefix . 'story_title', 'type' => 'textarea_small' ) );
		$cmb->add_field( array( 'name' => 'Story Body', 'id' => $prefix . 'story_body', 'type' => 'wysiwyg', 'options' => array( 'textarea_rows' => 8 ) ) );
		$cmb->add_field( array( 'name' => 'Story Script Sign-off', 'id' => $prefix . 'story_sign', 'type' => 'text', 'attributes' => array( 'placeholder' => 'Family Owned. Honest Work. Reliable Results.' ) ) );

		$cmb->add_field( array( 'name' => 'Principle Band', 'type' => 'title', 'id' => $prefix . 'title_principle', 'before_row' => '<hr>' ) );
		$cmb->add_field( array( 'name' => 'Principle Script Eyebrow', 'id' => $prefix . 'principle_eyebrow', 'type' => 'text', 'attributes' => array( 'placeholder' => 'A simple principle' ) ) );
		$cmb->add_field( array( 'name' => 'Principle Statement', 'id' => $prefix . 'principle_text', 'type' => 'textarea_small' ) );

		$cmb->add_field( array( 'name' => 'Credentials Strip', 'type' => 'title', 'id' => $prefix . 'title_creds', 'before_row' => '<hr>' ) );
		$creds = $cmb->add_field( array(
			'id'      => $prefix . 'credentials',
			'type'    => 'group',
			'options' => array( 'group_title' => 'Credential {#}', 'add_button' => 'Add Credential', 'remove_button' => 'Remove', 'sortable' => true, 'closed' => true ),
		) );
		$cmb->add_group_field( $creds, array( 'name' => 'Value', 'id' => 'value', 'type' => 'text' ) );
		$cmb->add_group_field( $creds, array( 'name' => 'Caption', 'id' => 'caption', 'type' => 'text' ) );

		$cmb->add_field( array( 'name' => 'Promises', 'type' => 'title', 'id' => $prefix . 'title_promises', 'before_row' => '<hr>' ) );
		$cmb->add_field( array( 'name' => 'Promises Eyebrow', 'id' => $prefix . 'promises_eyebrow', 'type' => 'text', 'attributes' => array( 'placeholder' => 'Why Choose Us' ) ) );
		$cmb->add_field( array( 'name' => 'Promises Heading', 'desc' => 'Use &lt;em&gt; for the italic accent.', 'id' => $prefix . 'promises_title', 'type' => 'textarea_small' ) );
		$promises = $cmb->add_field( array(
			'id'      => $prefix . 'promises',
			'type'    => 'group',
			'options' => array( 'group_title' => 'Promise {#}', 'add_button' => 'Add Promise', 'remove_button' => 'Remove', 'sortable' => true, 'closed' => true ),
		) );
		$cmb->add_group_field( $promises, array( 'name' => 'Title', 'id' => 'title', 'type' => 'text' ) );
		$cmb->add_group_field( $promises, array( 'name' => 'Text', 'id' => 'text', 'type' => 'textarea_small' ) );

		$cmb->add_field( array( 'name' => 'Team', 'type' => 'title', 'id' => $prefix . 'title_team', 'before_row' => '<hr>' ) );
		$cmb->add_field( array( 'name' => 'Team Eyebrow', 'id' => $prefix . 'team_eyebrow', 'type' => 'text', 'attributes' => array( 'placeholder' => 'The Team' ) ) );
		$cmb->add_field( array( 'name' => 'Team Script', 'id' => $prefix . 'team_script', 'type' => 'text', 'attributes' => array( 'placeholder' => 'The people who show up.' ) ) );
		$cmb->add_field( array( 'name' => 'Team Heading', 'desc' => 'Team members are pulled from the Staff post type. Use &lt;em&gt; for the italic accent.', 'id' => $prefix . 'team_title', 'type' => 'textarea_small' ) );

		$cmb->add_field( array( 'name' => 'Testimonial', 'type' => 'title', 'id' => $prefix . 'title_testi', 'before_row' => '<hr>' ) );
		$cmb->add_field( array( 'name' => 'Testimonial Script Eyebrow', 'id' => $prefix . 'testi_script', 'type' => 'text', 'attributes' => array( 'placeholder' => 'In their own words' ) ) );
		$cmb->add_field( array( 'name' => 'Testimonial Eyebrow', 'id' => $prefix . 'testi_eyebrow', 'type' => 'text', 'attributes' => array( 'placeholder' => 'From a Homeowner' ) ) );
		$cmb->add_field( array( 'name' => 'Testimonial Quote', 'id' => $prefix . 'testi_quote', 'type' => 'textarea' ) );
		$cmb->add_field( array( 'name' => 'Testimonial Name', 'id' => $prefix . 'testi_name', 'type' => 'text' ) );
		$cmb->add_field( array( 'name' => 'Testimonial Role', 'id' => $prefix . 'testi_role', 'type' => 'text' ) );

		$cmb->add_field( array( 'name' => 'Closing CTA', 'type' => 'title', 'id' => $prefix . 'title_cta', 'before_row' => '<hr>' ) );
		$cmb->add_field( array( 'name' => 'CTA Script', 'id' => $prefix . 'cta_script', 'type' => 'text', 'attributes' => array( 'placeholder' => 'From our family to yours.' ) ) );
		$cmb->add_field( array( 'name' => 'CTA Heading', 'desc' => 'Use &lt;em&gt; for the italic accent.', 'id' => $prefix . 'cta_title', 'type' => 'textarea_small' ) );
	}


	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	~~~~ STAFF CPT — CMB2 FIELDS ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	The parent theme registers the pegasus_staff post type (name = title, photo =
	featured image) but no custom fields. The About team grid needs a role plus the
	two "in their own words" prompts from the design, so we add them here.
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

	add_action( 'cmb2_admin_init', 'hfhs_staff_register_metabox' );
	function hfhs_staff_register_metabox() {
		$prefix = '_hfhs_staff_';

		$cmb = new_cmb2_box(
			array(
				'id'           => 'hfhs_staff_details',
				'title'        => __( 'Staff Details', 'pegasus' ),
				'object_types' => array( 'pegasus_staff' ),
				'context'      => 'normal',
				'priority'     => 'high',
			)
		);

		$cmb->add_field( array( 'name' => 'Role / Title', 'desc' => 'e.g. Founder &amp; Owner, Field Manager', 'id' => $prefix . 'role', 'type' => 'text' ) );
		$cmb->add_field( array( 'name' => 'Bio', 'desc' => 'Optional. A written bio for this person. When present, it replaces the three prompt answers below on the About page (this is how Charlotte&rsquo;s card works in the design). Uses the main editor above &mdash; leave the editor empty to show the prompts instead.', 'id' => $prefix . 'bio_note', 'type' => 'title' ) );
		$cmb->add_field( array( 'name' => 'Favorite project with HFHS and why?', 'id' => $prefix . 'project', 'type' => 'textarea_small' ) );
		$cmb->add_field( array( 'name' => 'Favorite customer moment or experience?', 'id' => $prefix . 'moment', 'type' => 'textarea_small' ) );
		$cmb->add_field( array( 'name' => 'Why should customers trust you with their home?', 'id' => $prefix . 'trust', 'type' => 'textarea_small' ) );
	}


	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	~~~~ TESTIMONIALS PAGE — CMB2 FIELDS + "FIELD OR DEFAULT" HELPERS ~~~~~~~~~~~~~
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	Same override-or-default pattern as the About page: the template ships default
	copy, each string is wired to a CMB2 field on the Testimonials edit screen, and
	the field replaces the default when filled in. The testimonial SLIDER itself is
	NOT a CMB2 field — it is powered by the pegasus_testimonial CPT via the theme's
	[pegasus_testimonial_slider] shortcode (Slick carousel from the pegasus-carousel
	plugin). The "three ways to share" cards use a repeatable group.
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

	define( 'HFHS_TESTI_PREFIX', '_hfhs_testi_' );

	function hfhs_testi_field( $key, $default = '' ) {
		if ( isset( $GLOBALS['hfhs_prefill'] ) ) { $GLOBALS['hfhs_prefill'][ HFHS_TESTI_PREFIX . $key ] = $default; }
		$id  = get_queried_object_id();
		$val = $id ? get_post_meta( $id, HFHS_TESTI_PREFIX . $key, true ) : '';
		if ( is_string( $val ) ) {
			$val = trim( $val );
		}
		return ( '' === $val || null === $val || array() === $val ) ? $default : $val;
	}

	function hfhs_testi_group( $key, $default = array() ) {
		if ( isset( $GLOBALS['hfhs_prefill'] ) ) { $GLOBALS['hfhs_prefill'][ HFHS_TESTI_PREFIX . $key ] = $default; }
		$id  = get_queried_object_id();
		$val = $id ? get_post_meta( $id, HFHS_TESTI_PREFIX . $key, true ) : array();
		if ( ! is_array( $val ) ) {
			return $default;
		}
		$rows = array_filter(
			$val,
			function( $row ) {
				return is_array( $row ) && '' !== trim( implode( '', array_map( 'strval', $row ) ) );
			}
		);
		return ! empty( $rows ) ? array_values( $rows ) : $default;
	}

	function hfhs_show_on_testimonials_template( $cmb ) {
		$post_id = $cmb->object_id();
		if ( ! $post_id && isset( $_GET['post'] ) ) {
			$post_id = absint( $_GET['post'] );
		}
		return $post_id && 'tpl_testimonials.php' === get_page_template_slug( $post_id );
	}

	add_action( 'cmb2_admin_init', 'hfhs_testi_register_metaboxes' );
	function hfhs_testi_register_metaboxes() {
		$prefix = HFHS_TESTI_PREFIX;

		$cmb = new_cmb2_box(
			array(
				'id'           => 'hfhs_testi_content',
				'title'        => __( 'Testimonials Page Content', 'pegasus' ),
				'object_types' => array( 'page' ),
				'context'      => 'normal',
				'priority'     => 'high',
				'closed'       => true,
				'show_on_cb'   => 'hfhs_show_on_testimonials_template',
			)
		);

		$cmb->add_field( array( 'name' => 'Hero', 'type' => 'title', 'id' => $prefix . 'title_hero', 'before_row' => '<hr>' ) );
		$cmb->add_field( array( 'name' => 'Hero Eyebrow', 'id' => $prefix . 'hero_eyebrow', 'type' => 'text', 'attributes' => array( 'placeholder' => 'Testimonials' ) ) );
		$cmb->add_field( array( 'name' => 'Hero Script', 'id' => $prefix . 'hero_script', 'type' => 'text', 'attributes' => array( 'placeholder' => 'What our family of clients says.' ) ) );
		$cmb->add_field( array( 'name' => 'Hero Title', 'desc' => 'Use &lt;em&gt; for the italic accent.', 'id' => $prefix . 'hero_title', 'type' => 'textarea_small' ) );
		$cmb->add_field( array( 'name' => 'Hero Intro', 'id' => $prefix . 'hero_text', 'type' => 'textarea_small' ) );
		$cmb->add_field( array( 'name' => 'Hero Background Image', 'id' => $prefix . 'hero_image', 'type' => 'file', 'options' => array( 'url' => false ) ) );

		$cmb->add_field( array( 'name' => 'Slider Header', 'type' => 'title', 'id' => $prefix . 'title_slider', 'before_row' => '<hr>', 'desc' => 'The slider itself is powered by the Testimonials (pegasus_testimonial) post type via the [pegasus_testimonial_slider] shortcode — add/edit slides there, not here.' ) );
		$cmb->add_field( array( 'name' => 'Slider Eyebrow', 'id' => $prefix . 'slider_eyebrow', 'type' => 'text', 'attributes' => array( 'placeholder' => 'Reviews' ) ) );
		$cmb->add_field( array( 'name' => 'Slider Script', 'id' => $prefix . 'slider_script', 'type' => 'text', 'attributes' => array( 'placeholder' => 'Honest words.' ) ) );
		$cmb->add_field( array( 'name' => 'Slider Title', 'desc' => 'Use &lt;em&gt; for the italic accent.', 'id' => $prefix . 'slider_title', 'type' => 'textarea_small' ) );

		$cmb->add_field( array( 'name' => 'Ways to Share', 'type' => 'title', 'id' => $prefix . 'title_ways', 'before_row' => '<hr>' ) );
		$cmb->add_field( array( 'name' => 'Ways Eyebrow', 'id' => $prefix . 'ways_eyebrow', 'type' => 'text', 'attributes' => array( 'placeholder' => 'Leave a Review' ) ) );
		$cmb->add_field( array( 'name' => 'Ways Script', 'id' => $prefix . 'ways_script', 'type' => 'text', 'attributes' => array( 'placeholder' => 'Your words help other families.' ) ) );
		$cmb->add_field( array( 'name' => 'Ways Title', 'desc' => 'Use &lt;em&gt; for the italic accent.', 'id' => $prefix . 'ways_title', 'type' => 'textarea_small' ) );
		$ways = $cmb->add_field( array(
			'id'      => $prefix . 'ways',
			'type'    => 'group',
			'options' => array( 'group_title' => 'Way {#}', 'add_button' => 'Add Way', 'remove_button' => 'Remove', 'sortable' => true, 'closed' => true ),
		) );
		$cmb->add_group_field( $ways, array( 'name' => 'Title', 'id' => 'title', 'type' => 'text' ) );
		$cmb->add_group_field( $ways, array( 'name' => 'Text', 'id' => 'text', 'type' => 'textarea_small' ) );
		$cmb->add_group_field( $ways, array( 'name' => 'Link Label', 'id' => 'link_label', 'type' => 'text' ) );
		$cmb->add_group_field( $ways, array( 'name' => 'Link URL', 'id' => 'link_url', 'type' => 'text', 'desc' => 'Use #form to scroll to the submission form.' ) );

		$cmb->add_field( array( 'name' => 'Share / Submission Form', 'type' => 'title', 'id' => $prefix . 'title_form', 'before_row' => '<hr>' ) );
		$cmb->add_field( array( 'name' => 'Form Eyebrow', 'id' => $prefix . 'form_eyebrow', 'type' => 'text', 'attributes' => array( 'placeholder' => 'Share Your Experience' ) ) );
		$cmb->add_field( array( 'name' => 'Form Script', 'id' => $prefix . 'form_script', 'type' => 'text', 'attributes' => array( 'placeholder' => 'From our family to yours.' ) ) );
		$cmb->add_field( array( 'name' => 'Form Title', 'desc' => 'Use &lt;em&gt; for the italic accent.', 'id' => $prefix . 'form_title', 'type' => 'textarea_small' ) );
		$cmb->add_field( array( 'name' => 'Form Intro', 'id' => $prefix . 'form_text', 'type' => 'textarea_small' ) );
		$cmb->add_field( array( 'name' => 'Form Shortcode', 'desc' => 'Paste the Gravity Forms shortcode here (e.g. [gravityform id="1" title="false"]) once the form is built. Left blank, a placeholder shows.', 'id' => $prefix . 'form_shortcode', 'type' => 'text' ) );

		$cmb->add_field( array( 'name' => 'Closing CTA', 'type' => 'title', 'id' => $prefix . 'title_cta', 'before_row' => '<hr>' ) );
		$cmb->add_field( array( 'name' => 'CTA Script', 'id' => $prefix . 'cta_script', 'type' => 'text', 'attributes' => array( 'placeholder' => 'Ready to get started?' ) ) );
		$cmb->add_field( array( 'name' => 'CTA Title', 'desc' => 'Use &lt;em&gt; for the italic accent.', 'id' => $prefix . 'cta_title', 'type' => 'textarea_small' ) );
	}


	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	~~~~ COMMUNITY PAGE — CMB2 FIELDS + "FIELD OR DEFAULT" HELPERS ~~~~~~~~~~~~~~~~
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	Fully CMB2-driven (same override-or-default pattern as About/Testimonials).
	Repeatable groups: Partners (4) and Get-Involved ways (3).
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

	define( 'HFHS_COMM_PREFIX', '_hfhs_comm_' );

	function hfhs_comm_field( $key, $default = '' ) {
		if ( isset( $GLOBALS['hfhs_prefill'] ) ) { $GLOBALS['hfhs_prefill'][ HFHS_COMM_PREFIX . $key ] = $default; }
		$id  = get_queried_object_id();
		$val = $id ? get_post_meta( $id, HFHS_COMM_PREFIX . $key, true ) : '';
		if ( is_string( $val ) ) {
			$val = trim( $val );
		}
		return ( '' === $val || null === $val || array() === $val ) ? $default : $val;
	}

	function hfhs_comm_group( $key, $default = array() ) {
		if ( isset( $GLOBALS['hfhs_prefill'] ) ) { $GLOBALS['hfhs_prefill'][ HFHS_COMM_PREFIX . $key ] = $default; }
		$id  = get_queried_object_id();
		$val = $id ? get_post_meta( $id, HFHS_COMM_PREFIX . $key, true ) : array();
		if ( ! is_array( $val ) ) {
			return $default;
		}
		$rows = array_filter(
			$val,
			function( $row ) {
				return is_array( $row ) && '' !== trim( implode( '', array_map( 'strval', $row ) ) );
			}
		);
		return ! empty( $rows ) ? array_values( $rows ) : $default;
	}

	function hfhs_show_on_community_template( $cmb ) {
		$post_id = $cmb->object_id();
		if ( ! $post_id && isset( $_GET['post'] ) ) {
			$post_id = absint( $_GET['post'] );
		}
		return $post_id && 'tpl_community.php' === get_page_template_slug( $post_id );
	}

	add_action( 'cmb2_admin_init', 'hfhs_comm_register_metaboxes' );
	function hfhs_comm_register_metaboxes() {
		$prefix = HFHS_COMM_PREFIX;

		$cmb = new_cmb2_box(
			array(
				'id'           => 'hfhs_comm_content',
				'title'        => __( 'Community Page Content', 'pegasus' ),
				'object_types' => array( 'page' ),
				'context'      => 'normal',
				'priority'     => 'high',
				'closed'       => true,
				'show_on_cb'   => 'hfhs_show_on_community_template',
			)
		);

		$cmb->add_field( array( 'name' => 'Hero', 'type' => 'title', 'id' => $prefix . 'title_hero', 'before_row' => '<hr>' ) );
		$cmb->add_field( array( 'name' => 'Hero Script', 'id' => $prefix . 'hero_script', 'type' => 'text', 'attributes' => array( 'placeholder' => 'Taking care of each other.' ) ) );
		$cmb->add_field( array( 'name' => 'Hero Title', 'desc' => 'Use &lt;em&gt; for the italic accent.', 'id' => $prefix . 'hero_title', 'type' => 'textarea_small' ) );
		$cmb->add_field( array( 'name' => 'Hero Intro', 'id' => $prefix . 'hero_text', 'type' => 'textarea_small' ) );
		$cmb->add_field( array( 'name' => 'Hero Background Image', 'id' => $prefix . 'hero_image', 'type' => 'file', 'options' => array( 'url' => false ) ) );

		$cmb->add_field( array( 'name' => 'Our Mission', 'type' => 'title', 'id' => $prefix . 'title_mission', 'before_row' => '<hr>' ) );
		$cmb->add_field( array( 'name' => 'Mission Eyebrow', 'id' => $prefix . 'mission_eyebrow', 'type' => 'text', 'attributes' => array( 'placeholder' => 'Our Mission' ) ) );
		$cmb->add_field( array( 'name' => 'Mission Title', 'desc' => 'Use &lt;em&gt; for the italic accent.', 'id' => $prefix . 'mission_title', 'type' => 'textarea_small' ) );
		$cmb->add_field( array( 'name' => 'Mission Body', 'id' => $prefix . 'mission_body', 'type' => 'wysiwyg', 'options' => array( 'textarea_rows' => 6 ) ) );
		$cmb->add_field( array( 'name' => 'Mission Script Sign-off', 'id' => $prefix . 'mission_sign', 'type' => 'text', 'attributes' => array( 'placeholder' => 'Built on Trust, Integrity, and Honesty.' ) ) );

		$cmb->add_field( array( 'name' => 'Partners', 'type' => 'title', 'id' => $prefix . 'title_partners', 'before_row' => '<hr>' ) );
		$cmb->add_field( array( 'name' => 'Partners Eyebrow', 'id' => $prefix . 'partners_eyebrow', 'type' => 'text', 'attributes' => array( 'placeholder' => 'Our Partners' ) ) );
		$cmb->add_field( array( 'name' => 'Partners Script', 'id' => $prefix . 'partners_script', 'type' => 'text', 'attributes' => array( 'placeholder' => 'Who we show up for.' ) ) );
		$cmb->add_field( array( 'name' => 'Partners Title', 'desc' => 'Use &lt;em&gt; for the italic accent.', 'id' => $prefix . 'partners_title', 'type' => 'textarea_small' ) );
		$partners = $cmb->add_field( array(
			'id'      => $prefix . 'partners',
			'type'    => 'group',
			'options' => array( 'group_title' => 'Partner {#}', 'add_button' => 'Add Partner', 'remove_button' => 'Remove', 'sortable' => true, 'closed' => true ),
		) );
		$cmb->add_group_field( $partners, array( 'name' => 'Name', 'id' => 'title', 'type' => 'text' ) );
		$cmb->add_group_field( $partners, array( 'name' => 'Subtitle', 'id' => 'subtitle', 'type' => 'text' ) );
		$cmb->add_group_field( $partners, array( 'name' => 'Description', 'id' => 'text', 'type' => 'textarea_small' ) );

		$cmb->add_field( array( 'name' => 'Recently in the Field', 'type' => 'title', 'id' => $prefix . 'title_field', 'before_row' => '<hr>' ) );
		$cmb->add_field( array( 'name' => 'Field Eyebrow', 'id' => $prefix . 'field_eyebrow', 'type' => 'text', 'attributes' => array( 'placeholder' => 'Recently in the Field' ) ) );
		$cmb->add_field( array( 'name' => 'Field Script', 'id' => $prefix . 'field_script', 'type' => 'text', 'attributes' => array( 'placeholder' => 'From the Family Promise family.' ) ) );
		$cmb->add_field( array( 'name' => 'Field Title', 'desc' => 'Use &lt;em&gt; for the italic accent.', 'id' => $prefix . 'field_title', 'type' => 'textarea_small' ) );
		$cmb->add_field( array( 'name' => 'Field Body', 'id' => $prefix . 'field_body', 'type' => 'wysiwyg', 'options' => array( 'textarea_rows' => 5 ) ) );
		$cmb->add_field( array( 'name' => 'Field Link Label', 'id' => $prefix . 'field_link_label', 'type' => 'text', 'attributes' => array( 'placeholder' => 'Read the Facebook Post &rarr;' ) ) );
		$cmb->add_field( array( 'name' => 'Field Link URL', 'id' => $prefix . 'field_link_url', 'type' => 'text' ) );
		$cmb->add_field( array( 'name' => 'Field Photo', 'desc' => 'Optional photo for the right column.', 'id' => $prefix . 'field_image', 'type' => 'file', 'options' => array( 'url' => false ) ) );

		$cmb->add_field( array( 'name' => 'Get Involved', 'type' => 'title', 'id' => $prefix . 'title_involve', 'before_row' => '<hr>' ) );
		$cmb->add_field( array( 'name' => 'Involve Eyebrow', 'id' => $prefix . 'involve_eyebrow', 'type' => 'text', 'attributes' => array( 'placeholder' => 'Get Involved' ) ) );
		$cmb->add_field( array( 'name' => 'Involve Script', 'id' => $prefix . 'involve_script', 'type' => 'text', 'attributes' => array( 'placeholder' => 'Help us help more families.' ) ) );
		$cmb->add_field( array( 'name' => 'Involve Title', 'desc' => 'Use &lt;em&gt; for the italic accent.', 'id' => $prefix . 'involve_title', 'type' => 'textarea_small' ) );
		$involve = $cmb->add_field( array(
			'id'      => $prefix . 'involve',
			'type'    => 'group',
			'options' => array( 'group_title' => 'Way {#}', 'add_button' => 'Add Way', 'remove_button' => 'Remove', 'sortable' => true, 'closed' => true ),
		) );
		$cmb->add_group_field( $involve, array( 'name' => 'Title', 'id' => 'title', 'type' => 'text' ) );
		$cmb->add_group_field( $involve, array( 'name' => 'Text', 'id' => 'text', 'type' => 'textarea_small' ) );
		$cmb->add_group_field( $involve, array( 'name' => 'Link Label', 'id' => 'link_label', 'type' => 'text' ) );
		$cmb->add_group_field( $involve, array( 'name' => 'Link URL', 'id' => 'link_url', 'type' => 'text' ) );
		$cmb->add_field( array( 'name' => 'Involve Note (script line under cards)', 'id' => $prefix . 'involve_note', 'type' => 'text', 'attributes' => array( 'placeholder' => 'Our commitment: pro bono work every year, for families who need it most.' ) ) );

		$cmb->add_field( array( 'name' => 'Closing CTA', 'type' => 'title', 'id' => $prefix . 'title_cta', 'before_row' => '<hr>' ) );
		$cmb->add_field( array( 'name' => 'CTA Script', 'id' => $prefix . 'cta_script', 'type' => 'text', 'attributes' => array( 'placeholder' => 'From Our Family to Yours.' ) ) );
		$cmb->add_field( array( 'name' => 'CTA Title', 'desc' => 'Use &lt;em&gt; for the italic accent.', 'id' => $prefix . 'cta_title', 'type' => 'textarea_small' ) );
	}


	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	~~~~ FAQ PAGE — CMB2 FIELDS + "FIELD OR DEFAULT" HELPERS ~~~~~~~~~~~~~~~~~~~~~~~
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	Fully CMB2-driven. The accordion Q&A is a repeatable group; the template turns
	it into the pegasus-accordion plugin's [accordions][accordion]…[/accordion]
	shortcode. Same override-or-default pattern as the other page templates.
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

	define( 'HFHS_FAQ_PREFIX', '_hfhs_faq_' );

	function hfhs_faq_field( $key, $default = '' ) {
		if ( isset( $GLOBALS['hfhs_prefill'] ) ) { $GLOBALS['hfhs_prefill'][ HFHS_FAQ_PREFIX . $key ] = $default; }
		$id  = get_queried_object_id();
		$val = $id ? get_post_meta( $id, HFHS_FAQ_PREFIX . $key, true ) : '';
		if ( is_string( $val ) ) {
			$val = trim( $val );
		}
		return ( '' === $val || null === $val || array() === $val ) ? $default : $val;
	}

	function hfhs_faq_group( $key, $default = array() ) {
		if ( isset( $GLOBALS['hfhs_prefill'] ) ) { $GLOBALS['hfhs_prefill'][ HFHS_FAQ_PREFIX . $key ] = $default; }
		$id  = get_queried_object_id();
		$val = $id ? get_post_meta( $id, HFHS_FAQ_PREFIX . $key, true ) : array();
		if ( ! is_array( $val ) ) {
			return $default;
		}
		$rows = array_filter(
			$val,
			function( $row ) {
				return is_array( $row ) && '' !== trim( implode( '', array_map( 'strval', $row ) ) );
			}
		);
		return ! empty( $rows ) ? array_values( $rows ) : $default;
	}

	function hfhs_show_on_faq_template( $cmb ) {
		$post_id = $cmb->object_id();
		if ( ! $post_id && isset( $_GET['post'] ) ) {
			$post_id = absint( $_GET['post'] );
		}
		return $post_id && 'tpl_faq.php' === get_page_template_slug( $post_id );
	}

	add_action( 'cmb2_admin_init', 'hfhs_faq_register_metaboxes' );
	function hfhs_faq_register_metaboxes() {
		$prefix = HFHS_FAQ_PREFIX;

		$cmb = new_cmb2_box(
			array(
				'id'           => 'hfhs_faq_content',
				'title'        => __( 'FAQ Page Content', 'pegasus' ),
				'object_types' => array( 'page' ),
				'context'      => 'normal',
				'priority'     => 'high',
				'closed'       => true,
				'show_on_cb'   => 'hfhs_show_on_faq_template',
			)
		);

		$cmb->add_field( array( 'name' => 'Hero', 'type' => 'title', 'id' => $prefix . 'title_hero', 'before_row' => '<hr>' ) );
		$cmb->add_field( array( 'name' => 'Hero Eyebrow', 'id' => $prefix . 'hero_eyebrow', 'type' => 'text', 'attributes' => array( 'placeholder' => 'Frequently Asked' ) ) );
		$cmb->add_field( array( 'name' => 'Hero Script', 'id' => $prefix . 'hero_script', 'type' => 'text', 'attributes' => array( 'placeholder' => 'Everything you need to know first.' ) ) );
		$cmb->add_field( array( 'name' => 'Hero Title', 'desc' => 'Use &lt;em&gt; for the italic accent.', 'id' => $prefix . 'hero_title', 'type' => 'textarea_small' ) );
		$cmb->add_field( array( 'name' => 'Hero Intro', 'id' => $prefix . 'hero_text', 'type' => 'textarea_small' ) );
		$cmb->add_field( array( 'name' => 'Hero Background Image', 'id' => $prefix . 'hero_image', 'type' => 'file', 'options' => array( 'url' => false ) ) );

		$cmb->add_field( array( 'name' => 'Intro Column (left)', 'type' => 'title', 'id' => $prefix . 'title_intro', 'before_row' => '<hr>' ) );
		$cmb->add_field( array( 'name' => 'Intro Eyebrow', 'id' => $prefix . 'intro_eyebrow', 'type' => 'text', 'attributes' => array( 'placeholder' => 'Got a Question?' ) ) );
		$cmb->add_field( array( 'name' => 'Intro Script', 'id' => $prefix . 'intro_script', 'type' => 'text', 'attributes' => array( 'placeholder' => 'Plainly put.' ) ) );
		$cmb->add_field( array( 'name' => 'Intro Title', 'desc' => 'Use &lt;em&gt; for the italic accent.', 'id' => $prefix . 'intro_title', 'type' => 'textarea_small' ) );
		$cmb->add_field( array( 'name' => 'Intro Body', 'id' => $prefix . 'intro_body', 'type' => 'wysiwyg', 'options' => array( 'textarea_rows' => 5 ) ) );
		$cmb->add_field( array( 'name' => 'Intro Phone', 'id' => $prefix . 'intro_phone', 'type' => 'text', 'attributes' => array( 'placeholder' => '404-507-2579' ) ) );

		$cmb->add_field( array( 'name' => 'Questions &amp; Answers', 'type' => 'title', 'id' => $prefix . 'title_faqs', 'before_row' => '<hr>', 'desc' => 'Rendered as an accordion (pegasus-accordion plugin). Drag to reorder.' ) );
		$faqs = $cmb->add_field( array(
			'id'      => $prefix . 'faqs',
			'type'    => 'group',
			'options' => array( 'group_title' => 'Q{#}', 'add_button' => 'Add Question', 'remove_button' => 'Remove Question', 'sortable' => true, 'closed' => true ),
		) );
		$cmb->add_group_field( $faqs, array( 'name' => 'Question', 'id' => 'question', 'type' => 'text' ) );
		$cmb->add_group_field( $faqs, array( 'name' => 'Answer', 'id' => 'answer', 'type' => 'textarea' ) );

		$cmb->add_field( array( 'name' => 'Closing CTA', 'type' => 'title', 'id' => $prefix . 'title_cta', 'before_row' => '<hr>' ) );
		$cmb->add_field( array( 'name' => 'CTA Script', 'id' => $prefix . 'cta_script', 'type' => 'text', 'attributes' => array( 'placeholder' => 'Still have questions?' ) ) );
		$cmb->add_field( array( 'name' => 'CTA Title', 'desc' => 'Use &lt;em&gt; for the italic accent.', 'id' => $prefix . 'cta_title', 'type' => 'textarea_small' ) );
	}


	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	~~~~ CONTACT PAGE — CMB2 FIELDS + "FIELD OR DEFAULT" HELPERS ~~~~~~~~~~~~~~~~~~~
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	Fully CMB2-driven. The estimate form is a Gravity Forms shortcode field (drop
	the [gravityform] tag in). Repeatable groups: Direct-Contact items and the
	Service-Area city list. Same override-or-default pattern as the other pages.
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

	define( 'HFHS_CONTACT_PREFIX', '_hfhs_contact_' );

	function hfhs_contact_field( $key, $default = '' ) {
		if ( isset( $GLOBALS['hfhs_prefill'] ) ) { $GLOBALS['hfhs_prefill'][ HFHS_CONTACT_PREFIX . $key ] = $default; }
		$id  = get_queried_object_id();
		$val = $id ? get_post_meta( $id, HFHS_CONTACT_PREFIX . $key, true ) : '';
		if ( is_string( $val ) ) {
			$val = trim( $val );
		}
		return ( '' === $val || null === $val || array() === $val ) ? $default : $val;
	}

	function hfhs_contact_group( $key, $default = array() ) {
		if ( isset( $GLOBALS['hfhs_prefill'] ) ) { $GLOBALS['hfhs_prefill'][ HFHS_CONTACT_PREFIX . $key ] = $default; }
		$id  = get_queried_object_id();
		$val = $id ? get_post_meta( $id, HFHS_CONTACT_PREFIX . $key, true ) : array();
		if ( ! is_array( $val ) ) {
			return $default;
		}
		$rows = array_filter(
			$val,
			function( $row ) {
				return is_array( $row ) && '' !== trim( implode( '', array_map( 'strval', $row ) ) );
			}
		);
		return ! empty( $rows ) ? array_values( $rows ) : $default;
	}

	function hfhs_show_on_contact_template( $cmb ) {
		$post_id = $cmb->object_id();
		if ( ! $post_id && isset( $_GET['post'] ) ) {
			$post_id = absint( $_GET['post'] );
		}
		return $post_id && 'tpl_contact.php' === get_page_template_slug( $post_id );
	}

	add_action( 'cmb2_admin_init', 'hfhs_contact_register_metaboxes' );
	function hfhs_contact_register_metaboxes() {
		$prefix = HFHS_CONTACT_PREFIX;

		$cmb = new_cmb2_box(
			array(
				'id'           => 'hfhs_contact_content',
				'title'        => __( 'Contact Page Content', 'pegasus' ),
				'object_types' => array( 'page' ),
				'context'      => 'normal',
				'priority'     => 'high',
				'closed'       => true,
				'show_on_cb'   => 'hfhs_show_on_contact_template',
			)
		);

		$cmb->add_field( array( 'name' => 'Hero', 'type' => 'title', 'id' => $prefix . 'title_hero', 'before_row' => '<hr>' ) );
		$cmb->add_field( array( 'name' => 'Hero Eyebrow', 'id' => $prefix . 'hero_eyebrow', 'type' => 'text', 'attributes' => array( 'placeholder' => 'Contact Us' ) ) );
		$cmb->add_field( array( 'name' => 'Hero Script', 'id' => $prefix . 'hero_script', 'type' => 'text', 'attributes' => array( 'placeholder' => 'From Our Family to Yours.' ) ) );
		$cmb->add_field( array( 'name' => 'Hero Title', 'desc' => 'Use &lt;em&gt; for the italic accent.', 'id' => $prefix . 'hero_title', 'type' => 'textarea_small' ) );
		$cmb->add_field( array( 'name' => 'Hero Intro', 'id' => $prefix . 'hero_text', 'type' => 'textarea_small' ) );
		$cmb->add_field( array( 'name' => 'Hero Background Image', 'id' => $prefix . 'hero_image', 'type' => 'file', 'options' => array( 'url' => false ) ) );

		$cmb->add_field( array( 'name' => 'Estimate Form (left)', 'type' => 'title', 'id' => $prefix . 'title_form', 'before_row' => '<hr>' ) );
		$cmb->add_field( array( 'name' => 'Form Eyebrow', 'id' => $prefix . 'form_eyebrow', 'type' => 'text', 'attributes' => array( 'placeholder' => 'Free Estimate Form' ) ) );
		$cmb->add_field( array( 'name' => 'Form Script', 'id' => $prefix . 'form_script', 'type' => 'text', 'attributes' => array( 'placeholder' => 'Tell us about your project.' ) ) );
		$cmb->add_field( array( 'name' => 'Form Title', 'desc' => 'Use &lt;em&gt; for the italic accent.', 'id' => $prefix . 'form_title', 'type' => 'textarea_small' ) );
		$cmb->add_field( array( 'name' => 'Gravity Forms Shortcode', 'desc' => 'Paste the Gravity Forms shortcode here (e.g. [gravityform id="1" title="false" description="false"]). Left blank, a placeholder shows.', 'id' => $prefix . 'form_shortcode', 'type' => 'text' ) );

		$cmb->add_field( array( 'name' => 'Direct Contact (right card)', 'type' => 'title', 'id' => $prefix . 'title_direct', 'before_row' => '<hr>' ) );
		$cmb->add_field( array( 'name' => 'Direct Contact Heading', 'id' => $prefix . 'direct_heading', 'type' => 'text', 'attributes' => array( 'placeholder' => 'Direct Contact' ) ) );
		$direct = $cmb->add_field( array(
			'id'      => $prefix . 'direct',
			'type'    => 'group',
			'options' => array( 'group_title' => 'Item {#}', 'add_button' => 'Add Item', 'remove_button' => 'Remove', 'sortable' => true, 'closed' => true ),
		) );
		$cmb->add_group_field( $direct, array( 'name' => 'Icon', 'id' => 'icon', 'type' => 'select', 'options' => array( 'phone' => 'Phone', 'email' => 'Email', 'location' => 'Location', 'hours' => 'Hours (clock)' ), 'default' => 'phone' ) );
		$cmb->add_group_field( $direct, array( 'name' => 'Label', 'id' => 'label', 'type' => 'text' ) );
		$cmb->add_group_field( $direct, array( 'name' => 'Value', 'id' => 'value', 'type' => 'text', 'desc' => 'Phone/Email values are auto-linked.' ) );
		$cmb->add_group_field( $direct, array( 'name' => 'Subtext', 'id' => 'subtext', 'type' => 'textarea_small', 'desc' => 'Line breaks are preserved.' ) );

		$cmb->add_field( array( 'name' => 'Service Area', 'type' => 'title', 'id' => $prefix . 'title_area', 'before_row' => '<hr>' ) );
		$cmb->add_field( array( 'name' => 'Area Eyebrow', 'id' => $prefix . 'area_eyebrow', 'type' => 'text', 'attributes' => array( 'placeholder' => 'Service Area' ) ) );
		$cmb->add_field( array( 'name' => 'Area Script', 'id' => $prefix . 'area_script', 'type' => 'text', 'attributes' => array( 'placeholder' => 'Where we work.' ) ) );
		$cmb->add_field( array( 'name' => 'Area Title', 'desc' => 'Use &lt;em&gt; for the italic accent.', 'id' => $prefix . 'area_title', 'type' => 'textarea_small' ) );
		$cmb->add_field( array( 'name' => 'Area Intro', 'id' => $prefix . 'area_text', 'type' => 'textarea_small' ) );
		$cmb->add_field( array( 'name' => 'Cities Served', 'desc' => 'One city per row. Drag to reorder.', 'id' => $prefix . 'cities', 'type' => 'text', 'repeatable' => true, 'options' => array( 'add_row_text' => 'Add City' ) ) );

		$cmb->add_field( array( 'name' => 'Closing CTA', 'type' => 'title', 'id' => $prefix . 'title_cta', 'before_row' => '<hr>' ) );
		$cmb->add_field( array( 'name' => 'CTA Script', 'id' => $prefix . 'cta_script', 'type' => 'text', 'attributes' => array( 'placeholder' => 'Prefer to talk first?' ) ) );
		$cmb->add_field( array( 'name' => 'CTA Title', 'desc' => 'Use &lt;em&gt; for the italic accent.', 'id' => $prefix . 'cta_title', 'type' => 'textarea_small' ) );
	}
