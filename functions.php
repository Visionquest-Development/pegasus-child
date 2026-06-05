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
	 * Sugarpeddler floral sprig (line-art SVG).
	 * Used as decorative corner accents in the home page template.
	 *
	 * @param array $args size, tone, flip, rotate, style.
	 * @return string SVG markup.
	 */
	function sp_sprig( $args = array() ) {
		$a = array_merge( array(
			'size'   => 60,
			'tone'   => 'currentColor',
			'flip'   => false,
			'rotate' => 0,
			'style'  => '',
		), $args );

		$transform  = sprintf( 'transform: scaleX(%d) rotate(%ddeg);', $a['flip'] ? -1 : 1, (int) $a['rotate'] );
		$full_style = $transform . ' ' . $a['style'];

		ob_start();
		?>
		<svg width="<?php echo (int) $a['size']; ?>" height="<?php echo (int) $a['size']; ?>" viewBox="0 0 120 120"
			 fill="none" stroke="<?php echo esc_attr( $a['tone'] ); ?>" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"
			 style="<?php echo esc_attr( $full_style ); ?>" aria-hidden="true">
			<path d="M14 106 C 32 86, 48 70, 62 54 S 88 26, 108 14" />
			<path d="M30 90 C 22 88, 16 92, 14 100 C 22 102, 28 98, 30 90 Z" />
			<path d="M46 72 C 38 70, 32 74, 30 82 C 38 84, 44 80, 46 72 Z" />
			<path d="M62 54 C 54 52, 48 56, 46 64 C 54 66, 60 62, 62 54 Z" />
			<path d="M52 80 C 60 78, 66 82, 68 90 C 60 92, 54 88, 52 80 Z" />
			<path d="M68 62 C 76 60, 82 64, 84 72 C 76 74, 70 70, 68 62 Z" />
			<path d="M84 44 C 92 42, 98 46, 100 54 C 92 56, 86 52, 84 44 Z" />
			<circle cx="98" cy="26" r="2.6" />
			<circle cx="92" cy="20" r="1.8" />
			<circle cx="104" cy="20" r="1.8" />
			<g transform="translate(14,106)">
				<circle cx="0" cy="0" r="2" />
				<path d="M-4 -2 q -3 -1 -4 -4 q 3 -1 5 1" />
				<path d="M-2 -4 q -1 -3 1 -5 q 3 1 3 4" />
			</g>
		</svg>
		<?php
		return ob_get_clean();
	}

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
