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


	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	~~~~ HOME PILLARS CMB2 METABOX (tpl_home.php) ~~~~
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/

	function pegasus_child_register_home_pillars_metabox() {
		$prefix = 'rcf_home_pillars_';

		$cmb = new_cmb2_box( array(
			'id'           => $prefix . 'metabox',
			'title'        => __( 'Home Pillars Section', 'pegasus-child' ),
			'object_types' => array( 'page' ),
			'show_on'      => array(
				'key'   => 'page-template',
				'value' => 'tpl_home.php',
			),
			'context'      => 'normal',
			'priority'     => 'high',
		) );

		$group_id = $cmb->add_field( array(
			'id'          => $prefix . 'group',
			'type'        => 'group',
			'description' => __( 'Each pillar appears as a column in the Home Pillars Section above the footer.', 'pegasus-child' ),
			'options'     => array(
				'group_title'   => __( 'Pillar {#}', 'pegasus-child' ),
				'add_button'    => __( 'Add Another Pillar', 'pegasus-child' ),
				'remove_button' => __( 'Remove Pillar', 'pegasus-child' ),
				'sortable'      => true,
				'closed'        => true,
			),
		) );

		$cmb->add_group_field( $group_id, array(
			'name' => __( 'Title', 'pegasus-child' ),
			'id'   => 'title',
			'type' => 'text',
		) );

		$cmb->add_group_field( $group_id, array(
			'name' => __( 'Font Awesome 4 Icon Class', 'pegasus-child' ),
			'desc' => __( 'Enter the icon class without the leading "fa fa-". Example: bar-chart, shield, handshake-o, users. See https://fontawesome.com/v4/icons/', 'pegasus-child' ),
			'id'   => 'icon',
			'type' => 'text',
		) );

		$cmb->add_group_field( $group_id, array(
			'name'    => __( 'Content', 'pegasus-child' ),
			'id'      => 'content',
			'type'    => 'wysiwyg',
			'options' => array(
				'textarea_rows' => 5,
				'media_buttons' => false,
			),
		) );
	}
	add_action( 'cmb2_admin_init', 'pegasus_child_register_home_pillars_metabox' );
