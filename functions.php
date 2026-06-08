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

		wp_enqueue_style(
			'sugarpeddler-fonts',
			'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500;1,600&family=Outfit:wght@300;400;500;600;700&family=Caveat:wght@400;500;600&display=swap',
			array(),
			null
		);

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
	 * Read a Home Page hero CMB2 value with a fallback.
	 */
	function sp_home_hero( $key, $default = '' ) {
		$val = get_post_meta( get_the_ID(), '_sp_home_hero_' . $key, true );
		return ( '' !== $val && null !== $val ) ? $val : $default;
	}

	/**
	 * CMB2 — Home Page hero fields.
	 * Only shown on pages using the "Home Page" template (tpl_home.php).
	 */
	add_action( 'cmb2_admin_init', 'sp_register_home_hero_metabox' );
	function sp_register_home_hero_metabox() {
		$prefix = '_sp_home_hero_';

		$cmb = new_cmb2_box( array(
			'id'           => 'sp_home_hero',
			'title'        => __( 'Home Page &mdash; Hero Section', 'pegasus-child' ),
			'object_types' => array( 'page' ),
			'show_on'      => array( 'key' => 'page-template', 'value' => 'tpl_home.php' ),
			'context'      => 'normal',
			'priority'     => 'high',
		) );

		$cmb->add_field( array(
			'name' => __( 'Eyebrow', 'pegasus-child' ),
			'desc' => __( 'Small uppercase line above the headline.', 'pegasus-child' ),
			'id'   => $prefix . 'eyebrow',
			'type' => 'text',
		) );

		$cmb->add_field( array(
			'name'    => __( 'Headline', 'pegasus-child' ),
			'desc'    => __( 'HTML allowed. Use &lt;br&gt; for line breaks and &lt;em&gt;...&lt;/em&gt; to color the italic accent pink.', 'pegasus-child' ),
			'id'      => $prefix . 'headline',
			'type'    => 'textarea_small',
		) );

		$cmb->add_field( array(
			'name' => __( 'Body copy', 'pegasus-child' ),
			'id'   => $prefix . 'body',
			'type' => 'textarea',
		) );

		$cmb->add_field( array(
			'name' => __( 'Primary button text', 'pegasus-child' ),
			'id'   => $prefix . 'btn1_text',
			'type' => 'text',
		) );
		$cmb->add_field( array(
			'name' => __( 'Primary button link', 'pegasus-child' ),
			'id'   => $prefix . 'btn1_link',
			'type' => 'text_url',
		) );

		$cmb->add_field( array(
			'name' => __( 'Secondary button text', 'pegasus-child' ),
			'id'   => $prefix . 'btn2_text',
			'type' => 'text',
		) );
		$cmb->add_field( array(
			'name' => __( 'Secondary button link', 'pegasus-child' ),
			'id'   => $prefix . 'btn2_link',
			'type' => 'text_url',
		) );

		$facts_group_id = $cmb->add_field( array(
			'id'          => $prefix . 'facts',
			'type'        => 'group',
			'description' => __( 'Small stats shown below the hero buttons. Drag to reorder.', 'pegasus-child' ),
			'options'     => array(
				'group_title'   => __( 'Fact {#}', 'pegasus-child' ),
				'add_button'    => __( 'Add another fact', 'pegasus-child' ),
				'remove_button' => __( 'Remove fact', 'pegasus-child' ),
				'sortable'      => true,
			),
		) );

		$cmb->add_group_field( $facts_group_id, array(
			'name' => __( 'Number', 'pegasus-child' ),
			'id'   => 'num',
			'type' => 'text_small',
		) );

		$cmb->add_group_field( $facts_group_id, array(
			'name' => __( 'Label', 'pegasus-child' ),
			'id'   => 'label',
			'type' => 'text',
		) );

		$cmb->add_field( array(
			'name'         => __( 'Hero image', 'pegasus-child' ),
			'desc'         => __( 'Right-side image. Leave empty to show a placeholder.', 'pegasus-child' ),
			'id'           => $prefix . 'image',
			'type'         => 'file',
			'options'      => array( 'url' => false ),
			'preview_size' => 'medium',
		) );
	}

	/**
	 * Format a price value with leading $.
	 * Whole-dollar values render without decimals; otherwise two-decimal.
	 */
	if ( ! function_exists( 'vqmenu_money' ) ) {
		function vqmenu_money( $value ) {
			if ( ! is_numeric( $value ) ) {
				return $value;
			}
			$f = (float) $value;
			$num = ( fmod( $f, 1.0 ) === 0.0 )
				? number_format( $f, 0, '.', '' )
				: number_format( $f, 2, '.', '' );
			return '$' . $num;
		}
	}

	/**
	 * Map a menu badge label (V, GF, GF*) to its CSS class.
	 */
	if ( ! function_exists( 'vqmenu_badge_class' ) ) {
		function vqmenu_badge_class( $label ) {
			$label = strtoupper( trim( (string) $label ) );
			return match ( $label ) {
				'V'         => 'sp-menu-badge sp-menu-badge--veg',
				'GF', 'GF*' => 'sp-menu-badge sp-menu-badge--gf',
				default     => 'sp-menu-badge',
			};
		}
	}
