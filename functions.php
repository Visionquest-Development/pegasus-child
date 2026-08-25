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

		//wp_enqueue_script( 'matchHeight_js', get_stylesheet_directory_uri() . '/js/jquery.matchHeight-min.js', array(), '', true );


	} //end function
	add_action( 'wp_enqueue_scripts', 'pegasus_child_bootstrap_js' );


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
			'options' => array( 'group_title' => 'Credential {#}', 'add_button' => 'Add Credential', 'remove_button' => 'Remove', 'sortable' => true ),
		) );
		$cmb->add_group_field( $creds, array( 'name' => 'Value', 'id' => 'value', 'type' => 'text' ) );
		$cmb->add_group_field( $creds, array( 'name' => 'Caption', 'id' => 'caption', 'type' => 'text' ) );

		$cmb->add_field( array( 'name' => 'Promises', 'type' => 'title', 'id' => $prefix . 'title_promises', 'before_row' => '<hr>' ) );
		$cmb->add_field( array( 'name' => 'Promises Eyebrow', 'id' => $prefix . 'promises_eyebrow', 'type' => 'text', 'attributes' => array( 'placeholder' => 'Why Choose Us' ) ) );
		$cmb->add_field( array( 'name' => 'Promises Heading', 'desc' => 'Use &lt;em&gt; for the italic accent.', 'id' => $prefix . 'promises_title', 'type' => 'textarea_small' ) );
		$promises = $cmb->add_field( array(
			'id'      => $prefix . 'promises',
			'type'    => 'group',
			'options' => array( 'group_title' => 'Promise {#}', 'add_button' => 'Add Promise', 'remove_button' => 'Remove', 'sortable' => true ),
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
