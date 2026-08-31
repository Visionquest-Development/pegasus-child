<?php
/**
 * Valor Care — Apply / Careers page CMB2 fields, defaults & accessors.
 *
 * Mirrors the contact/home pattern. The Apply page (tpl_apply.php) wraps the
 * Caregiver Application Gravity Form (ID 2) in the Valor Care look-and-feel;
 * every field renders its design default until a real value is filled in.
 *
 * @package Pegasus_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * All default (design) content for the Apply page.
 *
 * @return array
 */
function valorcare_apply_defaults() {
	static $defaults = null;
	if ( null !== $defaults ) {
		return $defaults;
	}

	$defaults = array(

		// ---- Hero ---------------------------------------------------------
		'apply_eyebrow' => 'Careers',
		'apply_title'   => 'Join Our Care Team',
		'apply_intro'   => "We're looking for dependable, compassionate caregivers who genuinely enjoy helping seniors feel safe, respected, and valued in their own homes. Tell us about your experience and availability, and we'll be in touch.",

		// ---- Supporting column -------------------------------------------
		'apply_aside_title' => 'Why Caregivers Choose Valor Care',
		'apply_aside_text'  => 'Meaningful work where your presence truly matters, supported by a team that values both our clients and our caregivers.',
		'apply_points'      => array(
			array( 'text' => 'Meaningful, one-on-one work with seniors' ),
			array( 'text' => 'Flexible PRN scheduling around your life' ),
			array( 'text' => 'Consistent clients and a familiar routine' ),
			array( 'text' => 'A team that treats you like family' ),
		),
		'apply_prn_notice'   => 'Caregiver positions are currently PRN (as-needed). Hours, shifts, and client assignments are not guaranteed and are offered based on client needs, location, qualifications, availability, and agency scheduling. As our client base grows, additional or more consistent hours may become available.',
		'apply_contact_note' => 'Questions before you apply? Call us at 770-910-CARE (2273).',

		// ---- Form ---------------------------------------------------------
		'apply_form_title'     => 'Caregiver Application',
		'apply_form_shortcode' => '[gravityform id="2" title="false" description="false" ajax="true"]',
	);

	return $defaults;
}

/**
 * Convenience accessor for a single scalar Apply-page default.
 *
 * @param string $key Default key.
 * @return string
 */
function valorcare_apply_default( $key ) {
	$d = valorcare_apply_defaults();
	return isset( $d[ $key ] ) && ! is_array( $d[ $key ] ) ? $d[ $key ] : '';
}

/* -------------------------------------------------------------------------
 * Metabox registration (only on pages using the Apply template).
 * ---------------------------------------------------------------------- */

/**
 * Register the Apply page metaboxes.
 */
function valorcare_register_apply_metaboxes() {

	$prefix   = 'vc_';
	$defaults = valorcare_apply_defaults();
	$show_on  = array(
		'key'   => 'page-template',
		'value' => 'tpl_apply.php',
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
		'id'    => $prefix . 'apply_hero_box',
		'title' => esc_html__( 'Apply — Hero', 'pegasus-child' ),
	) ) );
	$hero->add_field( array( 'name' => 'Eyebrow', 'id' => $prefix . 'apply_eyebrow', 'type' => 'text', 'default' => $defaults['apply_eyebrow'] ) );
	$hero->add_field( array( 'name' => 'Heading', 'desc' => 'HTML allowed — wrap words in <code>&lt;em&gt;…&lt;/em&gt;</code> for a gold accent.', 'id' => $prefix . 'apply_title', 'type' => 'textarea_small', 'default' => $defaults['apply_title'] ) );
	$hero->add_field( array( 'name' => 'Intro', 'id' => $prefix . 'apply_intro', 'type' => 'textarea', 'default' => $defaults['apply_intro'] ) );

	/* --------------------------------------------------- Supporting column */
	$aside = new_cmb2_box( array_merge( $box_common, array(
		'id'    => $prefix . 'apply_aside_box',
		'title' => esc_html__( 'Apply — Supporting Column', 'pegasus-child' ),
	) ) );
	$aside->add_field( array( 'name' => 'Heading', 'id' => $prefix . 'apply_aside_title', 'type' => 'text', 'default' => $defaults['apply_aside_title'] ) );
	$aside->add_field( array( 'name' => 'Text', 'id' => $prefix . 'apply_aside_text', 'type' => 'textarea_small', 'default' => $defaults['apply_aside_text'] ) );
	$points = $aside->add_field( array(
		'id'      => $prefix . 'apply_points',
		'type'    => 'group',
		'options' => array(
			'group_title'   => 'Point {#}',
			'add_button'    => 'Add Point',
			'remove_button' => 'Remove Point',
			'sortable'      => true,
			'closed'        => true,
		),
	) );
	$aside->add_group_field( $points, array( 'name' => 'Point', 'id' => 'text', 'type' => 'text' ) );
	$aside->add_field( array( 'name' => 'PRN Notice', 'desc' => 'Shown as a highlighted callout.', 'id' => $prefix . 'apply_prn_notice', 'type' => 'textarea', 'default' => $defaults['apply_prn_notice'] ) );
	$aside->add_field( array( 'name' => 'Contact Note', 'id' => $prefix . 'apply_contact_note', 'type' => 'textarea_small', 'default' => $defaults['apply_contact_note'] ) );

	/* ------------------------------------------------------------- Form */
	$form = new_cmb2_box( array_merge( $box_common, array(
		'id'    => $prefix . 'apply_form_box',
		'title' => esc_html__( 'Apply — Application Form', 'pegasus-child' ),
	) ) );
	$form->add_field( array( 'name' => 'Form Heading', 'id' => $prefix . 'apply_form_title', 'type' => 'text', 'default' => $defaults['apply_form_title'] ) );
	$form->add_field( array(
		'name' => 'Gravity Forms Shortcode',
		'desc' => 'The Caregiver Application form. Defaults to Gravity Form ID 2 — change only if you swap forms. Leave blank to hide the form.',
		'id'   => $prefix . 'apply_form_shortcode',
		'type' => 'textarea_small',
		'default' => $defaults['apply_form_shortcode'],
	) );
}
add_action( 'cmb2_admin_init', 'valorcare_register_apply_metaboxes' );
