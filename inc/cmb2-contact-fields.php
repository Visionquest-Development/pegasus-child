<?php
/**
 * Valor Care — Contact page CMB2 fields, defaults & accessors.
 *
 * Mirrors the home/services pattern (see inc/cmb2-home-fields.php). The Contact
 * page (tpl_contact.php) is fully CMB2-driven: every field renders its design
 * default until a real value is filled in and saved.
 *
 * The contact form can be replaced with a Gravity Forms shortcode — paste one
 * into the "Gravity Forms Shortcode" field and it takes over the form card.
 * Leave it blank to keep the built-in form.
 *
 * @package Pegasus_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * All default (design) content for the Contact page.
 *
 * @return array
 */
function valorcare_contact_defaults() {
	static $defaults = null;
	if ( null !== $defaults ) {
		return $defaults;
	}

	$defaults = array(

		// ---- Hero ---------------------------------------------------------
		'contact_eyebrow' => 'Get in Touch',
		'contact_title'   => "Let's Talk About <em>Care</em>",
		'contact_intro'   => "Whether you're ready to begin or just exploring options, we're here to help. Reach out and our care team will follow up personally — usually within one business day.",

		// ---- Contact details (left column) -------------------------------
		'contact_info_title' => 'Contact Details',
		'contact_phone'      => '770-910-CARE (2273)',
		'contact_phone_link' => 'tel:+17709102273',
		'contact_email'      => 'valorcarega@gmail.com',
		'contact_address'    => 'Serving Cobb & Paulding County, GA',
		'contact_hours'      => "Mon–Fri: 8:00am – 6:00pm\nWeekends: By appointment",

		// ---- Form card (right column) ------------------------------------
		'contact_form_title'     => 'Send Us a Message',
		'contact_form_note'      => 'We reply within one business day.',
		'contact_form_shortcode' => '',

		// ---- Optional map image ------------------------------------------
		'contact_map_image' => '',
	);

	return $defaults;
}

/**
 * Convenience accessor for a single scalar Contact-page default.
 *
 * @param string $key Default key (e.g. 'contact_title').
 * @return string
 */
function valorcare_contact_default( $key ) {
	$d = valorcare_contact_defaults();
	return isset( $d[ $key ] ) && ! is_array( $d[ $key ] ) ? $d[ $key ] : '';
}

/* -------------------------------------------------------------------------
 * Metabox registration (only on pages using the Contact template).
 * ---------------------------------------------------------------------- */

/**
 * Register the Contact page metaboxes.
 */
function valorcare_register_contact_metaboxes() {

	$prefix   = 'vc_';
	$defaults = valorcare_contact_defaults();
	$show_on  = array(
		'key'   => 'page-template',
		'value' => 'tpl_contact.php',
	);
	$box_common = array(
		'object_types' => array( 'page' ),
		'context'      => 'normal',
		'priority'     => 'high',
		'closed'       => true,
		'show_on'      => $show_on,
	);

	/* ------------------------------------------------------------- Hero */
	$hero = new_cmb2_box( array_merge( $box_common, array(
		'id'    => $prefix . 'contact_hero_box',
		'title' => esc_html__( 'Contact — Hero', 'pegasus-child' ),
	) ) );
	$hero->add_field( array( 'name' => 'Eyebrow', 'id' => $prefix . 'contact_eyebrow', 'type' => 'text', 'default' => $defaults['contact_eyebrow'] ) );
	$hero->add_field( array( 'name' => 'Heading', 'desc' => 'HTML allowed — wrap words in <code>&lt;em&gt;…&lt;/em&gt;</code> for a gold accent.', 'id' => $prefix . 'contact_title', 'type' => 'textarea_small', 'default' => $defaults['contact_title'] ) );
	$hero->add_field( array( 'name' => 'Intro', 'id' => $prefix . 'contact_intro', 'type' => 'textarea', 'default' => $defaults['contact_intro'] ) );

	/* ---------------------------------------------------- Contact details */
	$info = new_cmb2_box( array_merge( $box_common, array(
		'id'    => $prefix . 'contact_info_box',
		'title' => esc_html__( 'Contact — Details', 'pegasus-child' ),
	) ) );
	$info->add_field( array( 'name' => 'Heading', 'id' => $prefix . 'contact_info_title', 'type' => 'text', 'default' => $defaults['contact_info_title'] ) );
	$info->add_field( array( 'name' => 'Phone (display)', 'id' => $prefix . 'contact_phone', 'type' => 'text', 'default' => $defaults['contact_phone'] ) );
	$info->add_field( array( 'name' => 'Phone Link', 'desc' => 'e.g. tel:+17709102273', 'id' => $prefix . 'contact_phone_link', 'type' => 'text', 'default' => $defaults['contact_phone_link'] ) );
	$info->add_field( array( 'name' => 'Email', 'id' => $prefix . 'contact_email', 'type' => 'text', 'default' => $defaults['contact_email'] ) );
	$info->add_field( array( 'name' => 'Address / Service Area', 'id' => $prefix . 'contact_address', 'type' => 'text', 'default' => $defaults['contact_address'] ) );
	$info->add_field( array( 'name' => 'Hours', 'desc' => 'One line per row.', 'id' => $prefix . 'contact_hours', 'type' => 'textarea_small', 'default' => $defaults['contact_hours'] ) );
	$info->add_field( array( 'name' => 'Map Image', 'desc' => 'Optional. Shown below the contact details. Leave blank to hide.', 'id' => $prefix . 'contact_map_image', 'type' => 'file', 'options' => array( 'url' => false ) ) );

	/* ------------------------------------------------------------- Form */
	$form = new_cmb2_box( array_merge( $box_common, array(
		'id'    => $prefix . 'contact_form_box',
		'title' => esc_html__( 'Contact — Form', 'pegasus-child' ),
	) ) );
	$form->add_field( array( 'name' => 'Form Heading', 'id' => $prefix . 'contact_form_title', 'type' => 'text', 'default' => $defaults['contact_form_title'] ) );
	$form->add_field( array( 'name' => 'Form Reply Note', 'id' => $prefix . 'contact_form_note', 'type' => 'text', 'default' => $defaults['contact_form_note'] ) );
	$form->add_field( array(
		'name' => 'Gravity Forms Shortcode',
		'desc' => 'Optional. Paste a Gravity Forms shortcode (e.g. <code>[gravityform id="1" title="false" description="false"]</code>) to replace the built-in contact form. Leave blank to keep the built-in form.',
		'id'   => $prefix . 'contact_form_shortcode',
		'type' => 'textarea_small',
	) );
}
add_action( 'cmb2_admin_init', 'valorcare_register_contact_metaboxes' );
