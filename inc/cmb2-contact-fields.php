<?php
/**
 * Elliot Integration — Contact page ( tpl_contact.php ) CMB2 fields + defaults.
 *
 * Same "defaults until changed" pattern as the home and services pages:
 *  - Simple hero / intro fields are pre-filled with the design defaults.
 *  - The contact-detail rows are a single repeatable group that falls back to
 *    the full design defaults on the front end until real rows are added.
 *  - The contact form itself is a Gravity Forms shortcode, stored in a plain
 *    CMB2 text field and rendered through do_shortcode() on the front end.
 *  - Every metabox and the repeatable group are closed by default.
 *
 * Shares the elliot_field() / elliot_group() front-end helpers defined in
 * cmb2-homepage-fields.php ( all three files are required from functions.php ).
 *
 * @package Pegasus_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* -------------------------------------------------------------------------
 * 1. DEFAULT CONTENT
 * ---------------------------------------------------------------------- */

/**
 * Claude Design default content for the contact page.
 *
 * @return array
 */
function elliot_contact_defaults() {
	return array(

		'hero' => array(
			'eyebrow' => 'Start a project',
			'line1'   => 'Let\'s talk about',
			'emph'    => 'your line.',
			'intro'   => 'Tell me about the process you want to automate. Most projects begin with a short scoping call — walk me through it and I\'ll tell you, honestly, what it takes.',
		),

		/* Contact detail rows. Each row: a mono label, the value shown below it,
		   and an optional link ( mailto: / tel: / map URL ) that wraps the value. */
		'details' => array(
			array(
				'label' => 'Email',
				'value' => 'info@elliotintegration.com',
				'link'  => 'mailto:info@elliotintegration.com',
			),
			array(
				'label' => 'Phone',
				'value' => '(555) 010-0000',
				'link'  => 'tel:+15550100000',
			),
			array(
				'label' => 'Location',
				'value' => 'Serving the Southeast · Georgia, USA',
				'link'  => '',
			),
			array(
				'label' => 'Hours',
				'value' => 'Mon – Fri · 8:00am – 5:00pm ET',
				'link'  => '',
			),
		),

		'form' => array(
			'eyebrow'   => 'Send a message',
			'title'     => 'Project inquiry',
			'shortcode' => '',
		),
	);
}

/* -------------------------------------------------------------------------
 * 2. CMB2 METABOXES  ( shown only on the tpl_contact.php page template )
 * ---------------------------------------------------------------------- */

add_action( 'cmb2_admin_init', 'elliot_contact_register_metaboxes' );

/**
 * Register the contact-page metaboxes.
 */
function elliot_contact_register_metaboxes() {

	$d       = elliot_contact_defaults();
	$show_on = array( 'key' => 'page-template', 'value' => 'tpl_contact.php' );

	/* ----- SECTION 1 · HERO -------------------------------------------- */
	$hero = new_cmb2_box( array(
		'id'           => 'elliot_contact_hero',
		'title'        => 'Contact · 01 Hero',
		'object_types' => array( 'page' ),
		'show_on'      => $show_on,
		'closed'       => true,
		'context'      => 'normal',
		'priority'     => 'high',
	) );
	$hero->add_field( array( 'name' => 'Eyebrow', 'id' => 'elliot_contact_eyebrow', 'type' => 'text', 'default' => $d['hero']['eyebrow'] ) );
	$hero->add_field( array( 'name' => 'Heading line 1', 'id' => 'elliot_contact_h_line1', 'type' => 'text', 'default' => $d['hero']['line1'] ) );
	$hero->add_field( array( 'name' => 'Heading emphasis (italic gold)', 'id' => 'elliot_contact_h_emph', 'type' => 'text', 'default' => $d['hero']['emph'] ) );
	$hero->add_field( array( 'name' => 'Intro paragraph', 'id' => 'elliot_contact_intro', 'type' => 'textarea_small', 'default' => $d['hero']['intro'] ) );

	/* ----- SECTION 2 · CONTACT DETAILS --------------------------------- */
	$info = new_cmb2_box( array(
		'id'           => 'elliot_contact_info',
		'title'        => 'Contact · 02 Contact details',
		'object_types' => array( 'page' ),
		'show_on'      => $show_on,
		'closed'       => true,
	) );
	$info->add_field( array(
		'name'      => 'Note',
		'id'        => 'elliot_contact_info_note',
		'type'      => 'title',
		'after_row' => '<p style="margin:.4em 0 0;color:#666;font-style:italic;">Each row shows a small label with its value underneath. Add an optional link ( e.g. <code>mailto:you@site.com</code>, <code>tel:+15550100000</code>, or a map URL ) to make the value clickable.</p>',
	) );
	$details = $info->add_field( array(
		'name'    => 'Contact details',
		'id'      => 'elliot_contact_details',
		'type'    => 'group',
		'options' => array(
			'group_title'   => 'Detail {#}',
			'add_button'    => 'Add detail',
			'remove_button' => 'Remove detail',
			'sortable'      => true,
			'closed'        => true,
		),
	) );
	$info->add_group_field( $details, array( 'name' => 'Label', 'id' => 'label', 'type' => 'text' ) );
	$info->add_group_field( $details, array( 'name' => 'Value', 'id' => 'value', 'type' => 'text' ) );
	$info->add_group_field( $details, array( 'name' => 'Link (optional)', 'desc' => 'mailto: / tel: / https:// — leave blank for plain text.', 'id' => 'link', 'type' => 'text' ) );

	/* ----- SECTION 3 · FORM ( Gravity Forms shortcode ) ---------------- */
	$form = new_cmb2_box( array(
		'id'           => 'elliot_contact_form',
		'title'        => 'Contact · 03 Form',
		'object_types' => array( 'page' ),
		'show_on'      => $show_on,
		'closed'       => true,
	) );
	$form->add_field( array( 'name' => 'Form panel eyebrow', 'id' => 'elliot_contact_form_eyebrow', 'type' => 'text', 'default' => $d['form']['eyebrow'] ) );
	$form->add_field( array( 'name' => 'Form panel heading', 'id' => 'elliot_contact_form_title', 'type' => 'text', 'default' => $d['form']['title'] ) );
	$form->add_field( array(
		'name'    => 'Gravity Forms shortcode',
		'desc'    => 'Paste the Gravity Forms shortcode, e.g. <code>[gravityform id="1" title="false" description="false" ajax="true"]</code>. Leave blank to show a placeholder until the form is ready.',
		'id'      => 'elliot_contact_form_sc',
		'type'    => 'text',
		'default' => $d['form']['shortcode'],
	) );
}
