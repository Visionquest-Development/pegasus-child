<?php
/**
 * CMB2 fields for the Pegasus Home page template.
 *
 * These fields power the "Pegasus Home" page template (tpl_home_pegasus.php).
 * Every field is optional: when a field (or a whole repeatable group) is left
 * empty the front end falls back to the Claude Design defaults defined in
 * pegasus_home_defaults(). As soon as real content is saved into a row it
 * replaces the default for that section.
 *
 * Include this file from the child theme functions.php.
 *
 * @package Pegasus_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Front-end default content pulled from the Claude Design mockup.
 *
 * Used both as CMB2 field `default` values (for simple fields) and as the
 * front-end fallback for repeatable groups. Kept in one place so the admin
 * prefill and the rendered page never drift apart.
 *
 * @return array
 */
function pegasus_home_defaults() {
	// Permalink of the Demo page, used as a default button target where relevant.
	$demo_url = function_exists( 'pegasus_demo_page_url' ) ? pegasus_demo_page_url() : '';

	return array(
		// HERO.
		'hero_badge'          => 'WORDPRESS · BOOTSTRAP · FREE',
		'hero_heading_before' => 'The Bootstrap 5 theme for',
		'hero_heading_accent' => 'WordPress',
		'hero_heading_after'  => ', done right.',
		'hero_text'           => 'Pegasus is a custom Bootstrap 5 theme built on CMB2 and Font Awesome — paired with a suite of 20+ drop-in plugins that add real functionality to any site. Open source, and free forever.',
		'hero_image_caption'  => 'CMB2 · BOOTSTRAP 5',
		'hero_buttons'        => array(
			array(
				'label' => 'Get it on GitHub',
				'url'   => 'https://github.com/Visionquest-Development/pegasus',
				'style' => 'primary',
				'icon'  => 'fa fa-github',
			),
			array(
				'label' => 'How to use it',
				'url'   => '#docs',
				'style' => 'ghost',
				'icon'  => 'fa fa-book',
			),
		),
		'hero_stats'          => array(
			array( 'number' => '20+', 'label' => 'Plugins in the suite', 'accent' => 'green' ),
			array( 'number' => 'CMB2', 'label' => 'Custom fields built in', 'accent' => 'teal' ),
			array( 'number' => 'MIT', 'label' => 'Free & open source', 'accent' => 'blue' ),
		),

		// OVERVIEW.
		'overview_eyebrow'    => '01 — WHAT YOU GET',
		'overview_heading'    => 'A theme and a toolbox.',
		'overview_text'       => 'Install the theme for a polished Bootstrap 5 foundation. Add plugins à la carte for exactly the functionality you need — nothing you don\'t.',
		'overview_cards'      => array(
			array(
				'accent' => 'green',
				'eyebrow' => 'THE THEME',
				'title'  => 'WordPress Bootstrap Theme',
				'desc'   => 'A clean, responsive foundation you can customize deeply. Built with CMB2 for custom fields and Font Awesome for icons — extend it, don\'t fight it.',
				'tags'   => 'Bootstrap 5, CMB2, Font Awesome, Child themes',
				'btn_label' => 'View on GitHub',
				'btn_url'   => 'https://github.com/Visionquest-Development/pegasus',
				'btn_icon'  => 'fa fa-github',
			),
			array(
				'accent' => 'teal',
				'eyebrow' => 'THE SUITE',
				'title'  => 'Pegasus Suite of Plugins',
				'desc'   => 'Each plugin is installed separately, so your site stays lean. Carousels, count-ups, masonry grids, popups, filterable post grids and more — mix and match.',
				'tags'   => 'blog, carousel, masonry, countup, popup, +15',
				'btn_label' => 'Browse the demos',
				'btn_url'   => $demo_url ? $demo_url : '#plugins',
				'btn_icon'  => 'fa fa-th-large',
			),
		),

		// INSTALL.
		'install_eyebrow'     => '02 — GETTING STARTED',
		'install_heading'     => 'Up and running in one command.',
		'install_text'        => 'Clone the theme into your wp-content/themes directory, activate, and start building.',
		'install_cards'       => array(
			array(
				'label'   => 'PEGASUS THEME',
				'comment' => '# the Bootstrap 5 parent theme',
				'command' => 'git clone https://github.com/Visionquest-Development/pegasus.git pegasus',
			),
			array(
				'label'   => 'PEGASUS CHILD',
				'comment' => '# child theme for your customizations',
				'command' => 'git clone https://github.com/Visionquest-Development/pegasus-child.git pegasus-child',
			),
			array(
				'label'   => 'PEGASUS CAROUSEL',
				'comment' => '# example plugin: carousels & sliders',
				'command' => 'git clone https://github.com/Visionquest-Development/pegasus-carousel.git',
			),
			array(
				'label'   => 'PEGASUS SLIDER',
				'comment' => '# example plugin: hero sliders',
				'command' => 'git clone https://github.com/Visionquest-Development/pegasus-slider.git',
			),
		),
		'install_note'        => 'Prefer SSH? Every repo ships an SSH clone URL too. Child themes — pegasus-child &amp; timeline-child — install the same way.',

		// PLUGINS.
		'plugins_eyebrow'     => '03 — THE SUITE',
		'plugins_heading'     => 'One plugin per job.',
		'plugins_text'        => 'Install only what a page needs. Each plugin ships with its own example page you can copy from.',
		// Plugin cards are powered by inc/demo-content.json (shared with the Demo page), not CMB2.

		// DOCS.
		'docs_eyebrow'        => '04 — DOCUMENTATION',
		'docs_heading'        => 'Learn the Pegasus Options.',
		'docs_text'           => 'Everything is controlled from a friendly options panel — no code required. The guide walks you through changing the header, logo, footer widgets, colors, page templates and more.',
		'docs_btn_label'      => 'Read the full guide →',
		'docs_btn_url'        => '#',
		// The docs preview list is powered by inc/docs-content.json (shared with
		// the Documentation page), not CMB2.
	);
}

/**
 * Get a single Home field value, falling back to the design default.
 *
 * @param int    $post_id Page ID.
 * @param string $key     Field key without the pegasus_home_ prefix.
 * @return string
 */
function pegasus_home_field( $post_id, $key ) {
	$defaults = pegasus_home_defaults();
	$value    = get_post_meta( $post_id, 'pegasus_home_' . $key, true );

	if ( '' === $value || null === $value ) {
		return isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';
	}

	return $value;
}

/**
 * Get a repeatable group value, falling back to the design defaults.
 *
 * Fully-empty rows (CMB2's leftover blank row) are stripped so the default
 * content shows until the editor types real content into a row.
 *
 * @param int    $post_id Page ID.
 * @param string $key     Group key without the pegasus_home_ prefix.
 * @return array
 */
function pegasus_home_group( $post_id, $key ) {
	$defaults = pegasus_home_defaults();
	$value    = get_post_meta( $post_id, 'pegasus_home_' . $key, true );

	if ( is_array( $value ) ) {
		// Styling-only subfields have select defaults, so CMB2 persists them
		// even for an otherwise-blank leftover row. Ignore them when deciding
		// whether a row actually holds content.
		$ignore_keys = array( 'accent', 'style' );

		$value = array_filter(
			$value,
			function ( $row ) use ( $ignore_keys ) {
				if ( ! is_array( $row ) ) {
					return false;
				}
				$content = '';
				foreach ( $row as $sub_key => $sub_val ) {
					if ( in_array( $sub_key, $ignore_keys, true ) ) {
						continue;
					}
					$content .= is_scalar( $sub_val ) ? (string) $sub_val : '';
				}
				return '' !== trim( $content );
			}
		);
	}

	if ( empty( $value ) ) {
		return isset( $defaults[ $key ] ) ? $defaults[ $key ] : array();
	}

	return array_values( $value );
}

/**
 * Map an accent key to a scoped CSS modifier class.
 *
 * @param string $accent Accent key.
 * @return string
 */
function pegasus_home_accent_class( $accent ) {
	$allowed = array( 'green', 'lime', 'teal', 'blue' );
	$accent  = in_array( $accent, $allowed, true ) ? $accent : 'green';
	return 'ph-accent-' . $accent;
}

/**
 * Only show the Home meta boxes on pages using the Pegasus Home template.
 *
 * @param CMB2 $cmb CMB2 instance.
 * @return bool
 */
function pegasus_home_show_on_template( $cmb ) {
	$post_id = 0;

	if ( isset( $_GET['post'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification
		$post_id = absint( $_GET['post'] ); // phpcs:ignore WordPress.Security.NonceVerification
	} elseif ( isset( $_POST['post_ID'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification
		$post_id = absint( $_POST['post_ID'] ); // phpcs:ignore WordPress.Security.NonceVerification
	}

	if ( ! $post_id ) {
		return false;
	}

	$template = get_post_meta( $post_id, '_wp_page_template', true );

	return 'tpl_home_pegasus.php' === $template;
}

/**
 * Register the Pegasus Home CMB2 meta boxes.
 */
function pegasus_home_register_metaboxes() {
	$prefix   = 'pegasus_home_';
	$defaults = pegasus_home_defaults();

	// Shared group options: collapsed by default per requirements.
	$group_options = function ( $singular ) {
		return array(
			'group_title'   => $singular . ' {#}',
			'add_button'    => 'Add ' . $singular,
			'remove_button' => 'Remove ' . $singular,
			'sortable'      => true,
			'closed'        => true, // Repeatable rows collapsed by default.
		);
	};

	$accent_options = array(
		'green' => 'Green',
		'lime'  => 'Lime',
		'teal'  => 'Teal',
		'blue'  => 'Blue',
	);

	/* ------------------------------------------------------------------ *
	 * HERO
	 * ------------------------------------------------------------------ */
	$hero = new_cmb2_box( array(
		'id'           => $prefix . 'hero_metabox',
		'title'        => __( 'Home · Hero', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'context'      => 'normal',
		'priority'     => 'high',
		'closed'       => true, // Metabox collapsed by default.
		'show_on_cb'   => 'pegasus_home_show_on_template',
	) );

	$hero->add_field( array(
		'name'    => __( 'Badge text', 'pegasus-child' ),
		'id'      => $prefix . 'hero_badge',
		'type'    => 'text',
		'default' => $defaults['hero_badge'],
	) );
	$hero->add_field( array(
		'name'    => __( 'Heading — before accent', 'pegasus-child' ),
		'id'      => $prefix . 'hero_heading_before',
		'type'    => 'text',
		'default' => $defaults['hero_heading_before'],
	) );
	$hero->add_field( array(
		'name'    => __( 'Heading — accent word', 'pegasus-child' ),
		'desc'    => __( 'Shown in the gradient highlight.', 'pegasus-child' ),
		'id'      => $prefix . 'hero_heading_accent',
		'type'    => 'text',
		'default' => $defaults['hero_heading_accent'],
	) );
	$hero->add_field( array(
		'name'    => __( 'Heading — after accent', 'pegasus-child' ),
		'id'      => $prefix . 'hero_heading_after',
		'type'    => 'text',
		'default' => $defaults['hero_heading_after'],
	) );
	$hero->add_field( array(
		'name'    => __( 'Intro paragraph', 'pegasus-child' ),
		'id'      => $prefix . 'hero_text',
		'type'    => 'textarea',
		'default' => $defaults['hero_text'],
	) );
	$hero->add_field( array(
		'name'         => __( 'Hero image', 'pegasus-child' ),
		'desc'         => __( 'The Pegasus mascot / artwork. Falls back to a placeholder tile.', 'pegasus-child' ),
		'id'           => $prefix . 'hero_image',
		'type'         => 'file',
		'options'      => array( 'url' => false ),
		'query_args'   => array( 'type' => array( 'image/png', 'image/jpeg', 'image/gif', 'image/svg+xml', 'image/webp' ) ),
		'preview_size' => 'medium',
	) );
	$hero->add_field( array(
		'name'    => __( 'Hero image caption', 'pegasus-child' ),
		'id'      => $prefix . 'hero_image_caption',
		'type'    => 'text',
		'default' => $defaults['hero_image_caption'],
	) );

	$hero_buttons = $hero->add_field( array(
		'id'      => $prefix . 'hero_buttons',
		'type'    => 'group',
		'options' => $group_options( __( 'Button', 'pegasus-child' ) ),
	) );
	$hero->add_group_field( $hero_buttons, array(
		'name' => __( 'Label', 'pegasus-child' ),
		'id'   => 'label',
		'type' => 'text',
	) );
	$hero->add_group_field( $hero_buttons, array(
		'name' => __( 'URL', 'pegasus-child' ),
		'id'   => 'url',
		'type' => 'text_url',
	) );
	$hero->add_group_field( $hero_buttons, array(
		'name'    => __( 'Font Awesome icon class', 'pegasus-child' ),
		'desc'    => __( 'Optional, e.g. fa-brands fa-github', 'pegasus-child' ),
		'id'      => 'icon',
		'type'    => 'text',
	) );
	$hero->add_group_field( $hero_buttons, array(
		'name'             => __( 'Style', 'pegasus-child' ),
		'id'               => 'style',
		'type'             => 'select',
		'show_option_none' => false,
		'default'          => 'primary',
		'options'          => array(
			'primary' => __( 'Primary (solid green)', 'pegasus-child' ),
			'ghost'   => __( 'Ghost (outline)', 'pegasus-child' ),
		),
	) );

	$hero_stats = $hero->add_field( array(
		'id'      => $prefix . 'hero_stats',
		'type'    => 'group',
		'options' => $group_options( __( 'Stat', 'pegasus-child' ) ),
	) );
	$hero->add_group_field( $hero_stats, array(
		'name' => __( 'Number', 'pegasus-child' ),
		'id'   => 'number',
		'type' => 'text',
	) );
	$hero->add_group_field( $hero_stats, array(
		'name' => __( 'Label', 'pegasus-child' ),
		'id'   => 'label',
		'type' => 'text',
	) );
	$hero->add_group_field( $hero_stats, array(
		'name'             => __( 'Accent', 'pegasus-child' ),
		'id'               => 'accent',
		'type'             => 'select',
		'show_option_none' => false,
		'default'          => 'green',
		'options'          => $accent_options,
	) );

	/* ------------------------------------------------------------------ *
	 * OVERVIEW
	 * ------------------------------------------------------------------ */
	$overview = new_cmb2_box( array(
		'id'           => $prefix . 'overview_metabox',
		'title'        => __( 'Home · Overview', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'context'      => 'normal',
		'priority'     => 'high',
		'closed'       => true,
		'show_on_cb'   => 'pegasus_home_show_on_template',
	) );
	$overview->add_field( array(
		'name'    => __( 'Eyebrow', 'pegasus-child' ),
		'id'      => $prefix . 'overview_eyebrow',
		'type'    => 'text',
		'default' => $defaults['overview_eyebrow'],
	) );
	$overview->add_field( array(
		'name'    => __( 'Heading', 'pegasus-child' ),
		'id'      => $prefix . 'overview_heading',
		'type'    => 'text',
		'default' => $defaults['overview_heading'],
	) );
	$overview->add_field( array(
		'name'    => __( 'Intro paragraph', 'pegasus-child' ),
		'id'      => $prefix . 'overview_text',
		'type'    => 'textarea',
		'default' => $defaults['overview_text'],
	) );
	$overview_cards = $overview->add_field( array(
		'id'      => $prefix . 'overview_cards',
		'type'    => 'group',
		'options' => $group_options( __( 'Card', 'pegasus-child' ) ),
	) );
	$overview->add_group_field( $overview_cards, array(
		'name'             => __( 'Accent', 'pegasus-child' ),
		'id'               => 'accent',
		'type'             => 'select',
		'show_option_none' => false,
		'default'          => 'green',
		'options'          => $accent_options,
	) );
	$overview->add_group_field( $overview_cards, array(
		'name' => __( 'Eyebrow', 'pegasus-child' ),
		'id'   => 'eyebrow',
		'type' => 'text',
	) );
	$overview->add_group_field( $overview_cards, array(
		'name' => __( 'Title', 'pegasus-child' ),
		'id'   => 'title',
		'type' => 'text',
	) );
	$overview->add_group_field( $overview_cards, array(
		'name' => __( 'Description', 'pegasus-child' ),
		'id'   => 'desc',
		'type' => 'textarea_small',
	) );
	$overview->add_group_field( $overview_cards, array(
		'name' => __( 'Tags', 'pegasus-child' ),
		'desc' => __( 'Comma-separated list of pills.', 'pegasus-child' ),
		'id'   => 'tags',
		'type' => 'text',
	) );
	$overview->add_group_field( $overview_cards, array(
		'name' => __( 'Button label', 'pegasus-child' ),
		'desc' => __( 'Leave empty to hide the button.', 'pegasus-child' ),
		'id'   => 'btn_label',
		'type' => 'text',
	) );
	$overview->add_group_field( $overview_cards, array(
		'name' => __( 'Button URL', 'pegasus-child' ),
		'id'   => 'btn_url',
		'type' => 'text_url',
	) );
	$overview->add_group_field( $overview_cards, array(
		'name' => __( 'Button icon', 'pegasus-child' ),
		'desc' => __( 'Font Awesome 4 class, e.g. fa fa-github', 'pegasus-child' ),
		'id'   => 'btn_icon',
		'type' => 'text',
	) );

	/* ------------------------------------------------------------------ *
	 * INSTALL
	 * ------------------------------------------------------------------ */
	$install = new_cmb2_box( array(
		'id'           => $prefix . 'install_metabox',
		'title'        => __( 'Home · Install', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'context'      => 'normal',
		'priority'     => 'high',
		'closed'       => true,
		'show_on_cb'   => 'pegasus_home_show_on_template',
	) );
	$install->add_field( array(
		'name'    => __( 'Eyebrow', 'pegasus-child' ),
		'id'      => $prefix . 'install_eyebrow',
		'type'    => 'text',
		'default' => $defaults['install_eyebrow'],
	) );
	$install->add_field( array(
		'name'    => __( 'Heading', 'pegasus-child' ),
		'id'      => $prefix . 'install_heading',
		'type'    => 'text',
		'default' => $defaults['install_heading'],
	) );
	$install->add_field( array(
		'name'    => __( 'Intro paragraph', 'pegasus-child' ),
		'id'      => $prefix . 'install_text',
		'type'    => 'textarea',
		'default' => $defaults['install_text'],
	) );
	$install_cards = $install->add_field( array(
		'id'      => $prefix . 'install_cards',
		'type'    => 'group',
		'options' => $group_options( __( 'Terminal card', 'pegasus-child' ) ),
	) );
	$install->add_group_field( $install_cards, array(
		'name' => __( 'Terminal label', 'pegasus-child' ),
		'id'   => 'label',
		'type' => 'text',
	) );
	$install->add_group_field( $install_cards, array(
		'name' => __( 'Comment line', 'pegasus-child' ),
		'id'   => 'comment',
		'type' => 'text',
	) );
	$install->add_group_field( $install_cards, array(
		'name' => __( 'Command', 'pegasus-child' ),
		'id'   => 'command',
		'type' => 'textarea_small',
	) );
	$install->add_field( array(
		'name'    => __( 'Footer note', 'pegasus-child' ),
		'desc'    => __( 'Dashed note below the terminal cards. Basic HTML allowed.', 'pegasus-child' ),
		'id'      => $prefix . 'install_note',
		'type'    => 'textarea',
		'default' => $defaults['install_note'],
	) );

	/* ------------------------------------------------------------------ *
	 * PLUGINS
	 * ------------------------------------------------------------------ */
	$plugins = new_cmb2_box( array(
		'id'           => $prefix . 'plugins_metabox',
		'title'        => __( 'Home · Plugins', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'context'      => 'normal',
		'priority'     => 'high',
		'closed'       => true,
		'show_on_cb'   => 'pegasus_home_show_on_template',
	) );
	$plugins->add_field( array(
		'name'    => __( 'Eyebrow', 'pegasus-child' ),
		'id'      => $prefix . 'plugins_eyebrow',
		'type'    => 'text',
		'default' => $defaults['plugins_eyebrow'],
	) );
	$plugins->add_field( array(
		'name'    => __( 'Heading', 'pegasus-child' ),
		'id'      => $prefix . 'plugins_heading',
		'type'    => 'text',
		'default' => $defaults['plugins_heading'],
	) );
	$plugins->add_field( array(
		'name'    => __( 'Intro paragraph', 'pegasus-child' ),
		'id'      => $prefix . 'plugins_text',
		'type'    => 'textarea',
		'default' => $defaults['plugins_text'],
	) );
	// The plugin cards themselves are powered by inc/demo-content.json (shared
	// with the Demo page) via inc/demo-data.php — no CMB2 group here.

	/* ------------------------------------------------------------------ *
	 * DOCS
	 * ------------------------------------------------------------------ */
	$docs = new_cmb2_box( array(
		'id'           => $prefix . 'docs_metabox',
		'title'        => __( 'Home · Docs', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'context'      => 'normal',
		'priority'     => 'high',
		'closed'       => true,
		'show_on_cb'   => 'pegasus_home_show_on_template',
	) );
	$docs->add_field( array(
		'name'    => __( 'Eyebrow', 'pegasus-child' ),
		'id'      => $prefix . 'docs_eyebrow',
		'type'    => 'text',
		'default' => $defaults['docs_eyebrow'],
	) );
	$docs->add_field( array(
		'name'    => __( 'Heading', 'pegasus-child' ),
		'id'      => $prefix . 'docs_heading',
		'type'    => 'text',
		'default' => $defaults['docs_heading'],
	) );
	$docs->add_field( array(
		'name'    => __( 'Intro paragraph', 'pegasus-child' ),
		'id'      => $prefix . 'docs_text',
		'type'    => 'textarea',
		'default' => $defaults['docs_text'],
	) );
	$docs->add_field( array(
		'name'    => __( 'Button label', 'pegasus-child' ),
		'id'      => $prefix . 'docs_btn_label',
		'type'    => 'text',
		'default' => $defaults['docs_btn_label'],
	) );
	$docs->add_field( array(
		'name'    => __( 'Button URL', 'pegasus-child' ),
		'id'      => $prefix . 'docs_btn_url',
		'type'    => 'text_url',
		'default' => $defaults['docs_btn_url'],
	) );
	// The docs preview list itself is powered by inc/docs-content.json (shared
	// with the Documentation page) via inc/docs-data.php — no CMB2 group here.
}
add_action( 'cmb2_admin_init', 'pegasus_home_register_metaboxes' );
