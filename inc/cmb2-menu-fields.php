<?php
/**
 * CMB2 fields for the Menu template (tpl_menu.php).
 *
 * Registered against the "page" object type and limited to pages using the
 * "Menu" template, so these fields only appear on the edit screen of the page
 * that uses tpl_menu.php.
 *
 * Editable sections:
 *   1. Menu — Hero (kicker/title/body + the three top "slider" images).
 *   2. Menu — Reserve a Table (CTA copy/buttons + hours/address/phone panel).
 *
 * Every field ships a default (see sp_menu_default / sp_menu_defaults) so the
 * admin boxes are pre-filled with the current copy and the front end renders
 * that same copy until an editor overrides it. This makes it obvious at a
 * glance what content still needs real values.
 *
 * @package pegasus-child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
 * Defaults — single source of truth, shared by the metaboxes and the template.
 * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

/**
 * All scalar-field defaults for the Menu page, keyed by full meta key.
 *
 * @return array
 */
function sp_menu_defaults() {
	return array(
		// Hero.
		'_sp_menu_hero_kicker' => 'au menu',
		'_sp_menu_hero_title'  => 'The bistro <em>menu</em>',
		'_sp_menu_hero_body'   => 'A short, seasonal menu of French bistro classics — written each Monday, cooked through Saturday. Available for lunch and dinner.',

		// Menu board — headings/footnote around the Toast-rendered menu (the menu
		// items and their section titles come from Toast and are not editable here).
		'_sp_menu_board_kicker'        => 'Bienvenue chez nous',
		'_sp_menu_board_title'         => 'La Carte',
		'_sp_menu_board_updated_label' => 'Updated',
		'_sp_menu_board_footnote'      => '20% gratuity added for parties of 6 or more · gluten-free bread on request',
		'_sp_menu_board_unavailable'   => 'Menu is currently unavailable. Please check back later.',

		// Reserve a table.
		'_sp_menu_cta_kicker'       => 'à bientôt',
		'_sp_menu_cta_title'        => 'Reserve a table<br/>for <em>two &mdash; or twelve.</em>',
		'_sp_menu_cta_body'         => 'We seat parties of any size. Walk-ins welcome at the counter and the bar; reservations recommended for the dining room.',
		'_sp_menu_cta_btn1_text'    => 'Book a table',
		'_sp_menu_cta_btn1_link'    => '#',
		'_sp_menu_cta_btn2_text'    => 'Private dining →',
		'_sp_menu_cta_btn2_link'    => '#',
		'_sp_menu_cta_btn1_classes' => 'sp-btn sp-btn--primary',
		'_sp_menu_cta_btn2_classes' => 'sp-btn sp-btn--ghost',
		'_sp_menu_cta_hours_heading' => 'Hours of service',
		'_sp_menu_cta_find_heading' => 'Find us',
		'_sp_menu_cta_address'      => "Sugar Peddler<br>3718 2nd Ave<br>Columbus, GA 31901",
		'_sp_menu_cta_phone'        => '706-330-3972',
	);
}

/**
 * Default rows for the repeatable "hours" group (pulled from the footer widget).
 *
 * @return array
 */
function sp_menu_hours_default() {
	return array(
		array(
			'label' => 'Mon &ndash; Fri',
			'value' => '7:30 &ndash; 5:00',
		),
		array(
			'label' => 'Saturday &amp; Sunday',
			'value' => 'Closed',
		),
	);
}

/**
 * Look up a single default by meta key.
 *
 * @param string $key Full meta key.
 * @return string
 */
function sp_menu_default( $key ) {
	$defaults = sp_menu_defaults();
	return isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';
}

/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
 * Read helpers (template side)
 * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

/**
 * Read a single Menu meta value, falling back to its registered default.
 *
 * @param string $key Full meta key.
 * @return string
 */
function sp_menu_meta( $key ) {
	$val = get_post_meta( get_the_ID(), $key, true );
	return ( '' !== $val && null !== $val ) ? $val : sp_menu_default( $key );
}

/**
 * Read a repeatable (group) Menu meta value with a fallback default array.
 *
 * @param string $key     Full meta key.
 * @param array  $default Rows to return when nothing is saved.
 * @return array
 */
function sp_menu_group( $key, $default = array() ) {
	$val = get_post_meta( get_the_ID(), $key, true );
	return ( is_array( $val ) && ! empty( $val ) ) ? $val : $default;
}

/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
 * Metabox registration
 * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

add_action( 'cmb2_admin_init', 'sp_register_menu_metaboxes' );
function sp_register_menu_metaboxes() {

	$show_on = array( 'key' => 'page-template', 'value' => 'tpl_menu.php' );

	/* ── 1. Menu — Hero (top "slider" images + copy) ─────────────────────── */
	$prefix = '_sp_menu_hero_';
	$cmb    = new_cmb2_box( array(
		'id'           => 'sp_menu_hero',
		'title'        => __( '1. Menu &mdash; Hero &amp; Top Images', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'show_on'      => $show_on,
		'context'      => 'normal',
		'priority'     => 'high',
		'closed'       => true,
	) );

	$cmb->add_field( array(
		'name'    => __( 'Eyebrow', 'pegasus-child' ),
		'desc'    => __( 'Small handwritten line above the headline.', 'pegasus-child' ),
		'id'      => $prefix . 'kicker',
		'type'    => 'text',
		'default' => sp_menu_default( $prefix . 'kicker' ),
	) );
	$cmb->add_field( array(
		'name'    => __( 'Headline', 'pegasus-child' ),
		'desc'    => __( 'HTML allowed. Use &lt;em&gt;...&lt;/em&gt; to color the italic accent pink.', 'pegasus-child' ),
		'id'      => $prefix . 'title',
		'type'    => 'textarea_small',
		'default' => sp_menu_default( $prefix . 'title' ),
	) );
	$cmb->add_field( array(
		'name'    => __( 'Body copy', 'pegasus-child' ),
		'id'      => $prefix . 'body',
		'type'    => 'textarea',
		'default' => sp_menu_default( $prefix . 'body' ),
	) );

	$cmb->add_field( array(
		'name'         => __( 'Top image — left', 'pegasus-child' ),
		'desc'         => __( 'Narrow left photo in the top strip. Leave empty to show a placeholder.', 'pegasus-child' ),
		'id'           => $prefix . 'image_left',
		'type'         => 'file',
		'options'      => array( 'url' => false ),
		'preview_size' => 'medium',
	) );
	$cmb->add_field( array(
		'name'         => __( 'Top image — center (wide)', 'pegasus-child' ),
		'desc'         => __( 'Wide center photo in the top strip. Leave empty to show a placeholder.', 'pegasus-child' ),
		'id'           => $prefix . 'image_center',
		'type'         => 'file',
		'options'      => array( 'url' => false ),
		'preview_size' => 'medium',
	) );
	$cmb->add_field( array(
		'name'         => __( 'Top image — right', 'pegasus-child' ),
		'desc'         => __( 'Narrow right photo in the top strip. Leave empty to show a placeholder.', 'pegasus-child' ),
		'id'           => $prefix . 'image_right',
		'type'         => 'file',
		'options'      => array( 'url' => false ),
		'preview_size' => 'medium',
	) );

	/* ── 2. Menu — Menu Board (headings around the Toast-rendered menu) ───── */
	$prefix = '_sp_menu_board_';
	$cmb    = new_cmb2_box( array(
		'id'           => 'sp_menu_board',
		'title'        => __( '2. Menu &mdash; Menu Board (headings)', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'show_on'      => $show_on,
		'context'      => 'normal',
		'priority'     => 'high',
		'closed'       => true,
	) );

	$cmb->add_field( array(
		'name'    => __( 'Kicker', 'pegasus-child' ),
		'desc'    => __( 'Small line above the menu title ( e.g. "Bienvenue chez nous" ).', 'pegasus-child' ),
		'id'      => $prefix . 'kicker',
		'type'    => 'text',
		'default' => sp_menu_default( $prefix . 'kicker' ),
	) );
	$cmb->add_field( array(
		'name'    => __( 'Title', 'pegasus-child' ),
		'desc'    => __( 'HTML allowed ( &lt;em&gt; / &lt;br&gt; ).', 'pegasus-child' ),
		'id'      => $prefix . 'title',
		'type'    => 'text',
		'default' => sp_menu_default( $prefix . 'title' ),
	) );
	$cmb->add_field( array(
		'name'    => __( '&ldquo;Updated&rdquo; label', 'pegasus-child' ),
		'desc'    => __( 'Prefix before the auto date ( the date itself comes from Toast ). Leave empty to hide the line.', 'pegasus-child' ),
		'id'      => $prefix . 'updated_label',
		'type'    => 'text',
		'default' => sp_menu_default( $prefix . 'updated_label' ),
	) );
	$cmb->add_field( array(
		'name'    => __( 'Footnote', 'pegasus-child' ),
		'desc'    => __( 'Small print under the menu. Leave empty to hide it.', 'pegasus-child' ),
		'id'      => $prefix . 'footnote',
		'type'    => 'textarea_small',
		'default' => sp_menu_default( $prefix . 'footnote' ),
	) );
	$cmb->add_field( array(
		'name'    => __( 'Menu-unavailable message', 'pegasus-child' ),
		'desc'    => __( 'Shown only if the Toast menu cannot be loaded.', 'pegasus-child' ),
		'id'      => $prefix . 'unavailable',
		'type'    => 'text',
		'default' => sp_menu_default( $prefix . 'unavailable' ),
	) );

	/* ── 3. Menu — Reserve a Table ───────────────────────────────────────── */
	$prefix = '_sp_menu_cta_';
	$cmb    = new_cmb2_box( array(
		'id'           => 'sp_menu_cta',
		'title'        => __( '3. Menu &mdash; Reserve a Table', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'show_on'      => $show_on,
		'context'      => 'normal',
		'priority'     => 'high',
		'closed'       => true,
	) );

	$cmb->add_field( array(
		'name'    => __( 'Eyebrow', 'pegasus-child' ),
		'id'      => $prefix . 'kicker',
		'type'    => 'text',
		'default' => sp_menu_default( $prefix . 'kicker' ),
	) );
	$cmb->add_field( array(
		'name'    => __( 'Title', 'pegasus-child' ),
		'desc'    => __( 'HTML allowed. Use &lt;br&gt; for line breaks and &lt;em&gt;...&lt;/em&gt; for the italic accent.', 'pegasus-child' ),
		'id'      => $prefix . 'title',
		'type'    => 'textarea_small',
		'default' => sp_menu_default( $prefix . 'title' ),
	) );
	$cmb->add_field( array(
		'name'    => __( 'Body copy', 'pegasus-child' ),
		'id'      => $prefix . 'body',
		'type'    => 'textarea',
		'default' => sp_menu_default( $prefix . 'body' ),
	) );
	$cmb->add_field( array(
		'name'    => __( 'Primary button text', 'pegasus-child' ),
		'id'      => $prefix . 'btn1_text',
		'type'    => 'text',
		'default' => sp_menu_default( $prefix . 'btn1_text' ),
	) );
	$cmb->add_field( array(
		'name'    => __( 'Primary button link', 'pegasus-child' ),
		'id'      => $prefix . 'btn1_link',
		'type'    => 'text_url',
		'default' => sp_menu_default( $prefix . 'btn1_link' ),
	) );
	$cmb->add_field( array(
		'name'    => __( 'Secondary button text', 'pegasus-child' ),
		'id'      => $prefix . 'btn2_text',
		'type'    => 'text',
		'default' => sp_menu_default( $prefix . 'btn2_text' ),
	) );
	$cmb->add_field( array(
		'name'    => __( 'Secondary button link', 'pegasus-child' ),
		'id'      => $prefix . 'btn2_link',
		'type'    => 'text_url',
		'default' => sp_menu_default( $prefix . 'btn2_link' ),
	) );
	$cmb->add_field( array(
		'name'    => __( 'Primary button classes', 'pegasus-child' ),
		'id'      => $prefix . 'btn1_classes',
		'type'    => 'text',
		'default' => sp_menu_default( $prefix . 'btn1_classes' ),
	) );
	$cmb->add_field( array(
		'name'    => __( 'Secondary button classes', 'pegasus-child' ),
		'id'      => $prefix . 'btn2_classes',
		'type'    => 'text',
		'default' => sp_menu_default( $prefix . 'btn2_classes' ),
	) );

	$cmb->add_field( array(
		'name'    => __( 'Hours heading', 'pegasus-child' ),
		'id'      => $prefix . 'hours_heading',
		'type'    => 'text',
		'default' => sp_menu_default( $prefix . 'hours_heading' ),
	) );
	$hours = $cmb->add_field( array(
		'id'          => $prefix . 'hours',
		'type'        => 'group',
		'description' => __( 'Hours rows (day label + time). Default matches the footer widget: Mon–Fri 7:30–5:00, Sat &amp; Sun Closed.', 'pegasus-child' ),
		'options'     => array(
			'group_title'   => __( 'Row {#}', 'pegasus-child' ),
			'add_button'    => __( 'Add another row', 'pegasus-child' ),
			'remove_button' => __( 'Remove row', 'pegasus-child' ),
			'sortable'      => true,
			'closed'        => true,
		),
	) );
	$cmb->add_group_field( $hours, array(
		'name' => __( 'Day label', 'pegasus-child' ),
		'id'   => 'label',
		'type' => 'text',
	) );
	$cmb->add_group_field( $hours, array(
		'name' => __( 'Time', 'pegasus-child' ),
		'id'   => 'value',
		'type' => 'text',
	) );

	$cmb->add_field( array(
		'name'    => __( 'Find-us heading', 'pegasus-child' ),
		'id'      => $prefix . 'find_heading',
		'type'    => 'text',
		'default' => sp_menu_default( $prefix . 'find_heading' ),
	) );
	$cmb->add_field( array(
		'name'    => __( 'Address', 'pegasus-child' ),
		'desc'    => __( 'HTML allowed. Use &lt;br&gt; for line breaks. Default pulled from the footer widget.', 'pegasus-child' ),
		'id'      => $prefix . 'address',
		'type'    => 'textarea_small',
		'default' => sp_menu_default( $prefix . 'address' ),
	) );
	$cmb->add_field( array(
		'name'    => __( 'Phone', 'pegasus-child' ),
		'desc'    => __( 'Rendered as a click-to-call link. Default pulled from the footer widget.', 'pegasus-child' ),
		'id'      => $prefix . 'phone',
		'type'    => 'text',
		'default' => sp_menu_default( $prefix . 'phone' ),
	) );
}
