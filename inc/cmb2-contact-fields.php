<?php
/**
 * CMB2 fields for the Contact template (tpl_contact.php).
 *
 * The page is mostly powered by the Locations CPT; these fields drive the hero
 * and the form section. Leave the Gravity Forms shortcode blank to show the
 * default message. Metabox is collapsed and only shows on the Contact template.
 *
 * @package Pegasus_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Canonical default content for the Contact page.
 *
 * @return array
 */
function sb_contact_defaults() {
	$img = 'https://thestoutbrothers.com/wp-content/uploads/';

	return array(
		'hero_kicker'       => 'Get In Touch',
		'hero_heading'      => 'Contact Us',
		'hero_image'        => $img . '2023/08/the-stout-brothers-about.jpg',
		'hero_text'         => "Questions about our tap list, private events, or just want to say hello? Reach out below — or stop by one of our three metro Atlanta tap rooms. We'd love to see you.",
		'form_kicker'       => 'Send Us A Message',
		'form_heading'      => 'Drop Us A Line',
		'form_shortcode'    => '',
		'form_default_text' => "Our contact form will live right here. In the meantime, email us and we'll get back to you as soon as we can.",
		'general_email'     => 'megan@thestoutbrothers.com',
		'general_phone'     => '',
		'locations_kicker'  => 'Come See Us',
		'locations_heading' => 'Visit A Tap Room',
	);
}

/**
 * Register the Contact page metabox.
 */
function sb_contact_register_metaboxes() {

	if ( ! function_exists( 'new_cmb2_box' ) ) {
		return;
	}

	$prefix = '_sb_contact_';
	$d      = sb_contact_defaults();

	$box = new_cmb2_box( array(
		'id'           => $prefix . 'box',
		'title'        => __( 'Contact Page', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'context'      => 'normal',
		'priority'     => 'high',
		'closed'       => true,
		'show_on'      => array( 'key' => 'page-template', 'value' => 'tpl_contact.php' ),
	) );

	// Hero.
	$box->add_field( array( 'name' => __( 'Hero — kicker', 'pegasus-child' ), 'id' => $prefix . 'hero_kicker', 'type' => 'text', 'default' => $d['hero_kicker'] ) );
	$box->add_field( array( 'name' => __( 'Hero — heading', 'pegasus-child' ), 'id' => $prefix . 'hero_heading', 'type' => 'text', 'default' => $d['hero_heading'] ) );
	$box->add_field( array(
		'name'         => __( 'Hero — background image', 'pegasus-child' ),
		'id'           => $prefix . 'hero_image',
		'type'         => 'file',
		'options'      => array( 'url' => false ),
		'query_args'   => array( 'type' => 'image' ),
		'preview_size' => 'medium',
	) );
	$box->add_field( array( 'name' => __( 'Hero — intro text', 'pegasus-child' ), 'id' => $prefix . 'hero_text', 'type' => 'textarea', 'default' => $d['hero_text'] ) );

	// Form section.
	$box->add_field( array( 'name' => __( 'Form — kicker', 'pegasus-child' ), 'id' => $prefix . 'form_kicker', 'type' => 'text', 'default' => $d['form_kicker'] ) );
	$box->add_field( array( 'name' => __( 'Form — heading', 'pegasus-child' ), 'id' => $prefix . 'form_heading', 'type' => 'text', 'default' => $d['form_heading'] ) );
	$box->add_field( array(
		'name' => __( 'Gravity Forms shortcode', 'pegasus-child' ),
		'desc' => __( 'Paste your Gravity Forms shortcode, e.g. [gravityform id="1" title="false" description="false"]. Leave blank to show the default message below.', 'pegasus-child' ),
		'id'   => $prefix . 'form_shortcode',
		'type' => 'text',
	) );
	$box->add_field( array( 'name' => __( 'Form — default message', 'pegasus-child' ), 'desc' => __( 'Shown when the Gravity Forms shortcode is empty.', 'pegasus-child' ), 'id' => $prefix . 'form_default_text', 'type' => 'textarea', 'default' => $d['form_default_text'] ) );
	$box->add_field( array( 'name' => __( 'General email', 'pegasus-child' ), 'desc' => __( 'Used for the "Email Us" button in the default message.', 'pegasus-child' ), 'id' => $prefix . 'general_email', 'type' => 'text', 'default' => $d['general_email'] ) );
	$box->add_field( array( 'name' => __( 'General phone', 'pegasus-child' ), 'id' => $prefix . 'general_phone', 'type' => 'text' ) );

	// Locations section.
	$box->add_field( array( 'name' => __( 'Locations — kicker', 'pegasus-child' ), 'id' => $prefix . 'locations_kicker', 'type' => 'text', 'default' => $d['locations_kicker'] ) );
	$box->add_field( array( 'name' => __( 'Locations — heading', 'pegasus-child' ), 'id' => $prefix . 'locations_heading', 'type' => 'text', 'default' => $d['locations_heading'] ) );
}
add_action( 'cmb2_admin_init', 'sb_contact_register_metaboxes' );

/**
 * Get a Contact field, falling back to its design default.
 *
 * @param int    $post_id Page ID.
 * @param string $key     Key without the `_sb_contact_` prefix.
 * @return string
 */
function sb_contact_field( $post_id, $key ) {
	$d = sb_contact_defaults();
	$v = get_post_meta( $post_id, '_sb_contact_' . $key, true );

	if ( is_string( $v ) && '' !== trim( $v ) ) {
		return $v;
	}

	return isset( $d[ $key ] ) ? $d[ $key ] : '';
}
