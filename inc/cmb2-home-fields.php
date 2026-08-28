<?php
/**
 * Hart Family of Home Services — Home page CMB2 fields + "field or default" helpers.
 *
 * Same override-or-default pattern as the other page templates: tpl_home.php ships
 * the design defaults inline and each is wired to a CMB2 field on the Home edit
 * screen ("Home Page Content" metabox). A blank field shows the default; a filled
 * field replaces it. Repeatable groups power the hero stats, the 9-service grid,
 * the About stats, and the Community partners.
 *
 * The capture hook (shared with the other helpers) lets a one-off prefill routine
 * record the template's defaults and write them to meta — inert on the frontend.
 *
 * @package Pegasus_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'HFHS_HOME_PREFIX', '_hfhs_home_' );

function hfhs_home_field( $key, $default = '' ) {
	if ( isset( $GLOBALS['hfhs_prefill'] ) ) { $GLOBALS['hfhs_prefill'][ HFHS_HOME_PREFIX . $key ] = $default; }
	$id  = get_queried_object_id();
	$val = $id ? get_post_meta( $id, HFHS_HOME_PREFIX . $key, true ) : '';
	if ( is_string( $val ) ) {
		$val = trim( $val );
	}
	return ( '' === $val || null === $val || array() === $val ) ? $default : $val;
}

function hfhs_home_group( $key, $default = array() ) {
	if ( isset( $GLOBALS['hfhs_prefill'] ) ) { $GLOBALS['hfhs_prefill'][ HFHS_HOME_PREFIX . $key ] = $default; }
	$id  = get_queried_object_id();
	$val = $id ? get_post_meta( $id, HFHS_HOME_PREFIX . $key, true ) : array();
	if ( ! is_array( $val ) ) {
		return $default;
	}
	$rows = array_filter(
		$val,
		function ( $row ) {
			return is_array( $row ) && '' !== trim( implode( '', array_map( 'strval', $row ) ) );
		}
	);
	return ! empty( $rows ) ? array_values( $rows ) : $default;
}

function hfhs_show_on_home_template( $cmb ) {
	$post_id = $cmb->object_id();
	if ( ! $post_id && isset( $_GET['post'] ) ) {
		$post_id = absint( $_GET['post'] );
	}
	return $post_id && 'tpl_home.php' === get_page_template_slug( $post_id );
}

add_action( 'cmb2_admin_init', 'hfhs_home_register_metaboxes' );
function hfhs_home_register_metaboxes() {
	$p = HFHS_HOME_PREFIX;

	$cmb = new_cmb2_box( array(
		'id'           => 'hfhs_home_content',
		'title'        => __( 'Home Page Content', 'pegasus' ),
		'object_types' => array( 'page' ),
		'context'      => 'normal',
		'priority'     => 'high',
		'closed'       => true,
		'show_on_cb'   => 'hfhs_show_on_home_template',
	) );

	/* Hero */
	$cmb->add_field( array( 'name' => 'Hero', 'type' => 'title', 'id' => $p . 't_hero', 'before_row' => '<hr>' ) );
	$cmb->add_field( array( 'name' => 'Hero Script', 'id' => $p . 'hero_script', 'type' => 'text', 'attributes' => array( 'placeholder' => 'From Our Family to Yours' ) ) );
	$cmb->add_field( array( 'name' => 'Hero Title', 'desc' => 'Use &lt;br&gt; for a line break and &lt;em&gt; for the italic accent.', 'id' => $p . 'hero_title', 'type' => 'textarea_small' ) );
	$cmb->add_field( array( 'name' => 'Hero Lead', 'id' => $p . 'hero_lead', 'type' => 'textarea_small' ) );
	$cmb->add_field( array( 'name' => 'Hero Background Image', 'id' => $p . 'hero_image', 'type' => 'file', 'options' => array( 'url' => false ) ) );
	$cmb->add_field( array( 'name' => 'Hero Button 1 Text', 'id' => $p . 'hero_btn1_text', 'type' => 'text' ) );
	$cmb->add_field( array( 'name' => 'Hero Button 1 Link', 'id' => $p . 'hero_btn1_link', 'type' => 'text' ) );
	$cmb->add_field( array( 'name' => 'Hero Button 2 Text', 'id' => $p . 'hero_btn2_text', 'type' => 'text' ) );
	$cmb->add_field( array( 'name' => 'Hero Button 2 Link', 'id' => $p . 'hero_btn2_link', 'type' => 'text' ) );
	$stats = $cmb->add_field( array( 'id' => $p . 'hero_stats', 'type' => 'group', 'options' => array( 'group_title' => 'Stat {#}', 'add_button' => 'Add Stat', 'remove_button' => 'Remove', 'sortable' => true, 'closed' => true ) ) );
	$cmb->add_group_field( $stats, array( 'name' => 'Label', 'id' => 'label', 'type' => 'text' ) );
	$cmb->add_group_field( $stats, array( 'name' => 'Value (HTML allowed for links)', 'id' => 'value', 'type' => 'text' ) );

	/* Welcome / Values */
	$cmb->add_field( array( 'name' => 'Welcome / Values', 'type' => 'title', 'id' => $p . 't_values', 'before_row' => '<hr>' ) );
	$cmb->add_field( array( 'name' => 'Values Eyebrow', 'id' => $p . 'values_eyebrow', 'type' => 'text', 'attributes' => array( 'placeholder' => 'Welcome' ) ) );
	$cmb->add_field( array( 'name' => 'Values Title', 'desc' => 'Use &lt;em&gt; for the italic accent.', 'id' => $p . 'values_title', 'type' => 'textarea_small' ) );
	$cmb->add_field( array( 'name' => 'Values Body', 'id' => $p . 'values_body', 'type' => 'wysiwyg', 'options' => array( 'media_buttons' => false, 'textarea_rows' => 6 ) ) );
	$cmb->add_field( array( 'name' => 'Values Script Sign-off', 'id' => $p . 'values_sign', 'type' => 'text' ) );

	/* Services */
	$cmb->add_field( array( 'name' => 'Services', 'type' => 'title', 'id' => $p . 't_services', 'before_row' => '<hr>' ) );
	$cmb->add_field( array( 'name' => 'Services Eyebrow', 'id' => $p . 'services_eyebrow', 'type' => 'text', 'attributes' => array( 'placeholder' => 'What We Do' ) ) );
	$cmb->add_field( array( 'name' => 'Services Title', 'id' => $p . 'services_title', 'type' => 'textarea_small' ) );
	$cmb->add_field( array( 'name' => 'Services Lead', 'id' => $p . 'services_lead', 'type' => 'textarea_small' ) );
	$svc = $cmb->add_field( array( 'id' => $p . 'services', 'type' => 'group', 'options' => array( 'group_title' => 'Service {#}', 'add_button' => 'Add Service', 'remove_button' => 'Remove', 'sortable' => true, 'closed' => true ) ) );
	$cmb->add_group_field( $svc, array( 'name' => 'Title', 'id' => 'title', 'type' => 'text' ) );
	$cmb->add_group_field( $svc, array( 'name' => 'Description', 'id' => 'desc', 'type' => 'textarea_small' ) );
	$cmb->add_group_field( $svc, array( 'name' => 'Link', 'id' => 'link', 'type' => 'text' ) );
	$cmb->add_group_field( $svc, array( 'name' => 'CTA Label', 'id' => 'cta', 'type' => 'text' ) );
	$cmb->add_group_field( $svc, array( 'name' => 'Background Image', 'id' => 'img', 'type' => 'file', 'options' => array( 'url' => false ) ) );

	/* About */
	$cmb->add_field( array( 'name' => 'About', 'type' => 'title', 'id' => $p . 't_about', 'before_row' => '<hr>' ) );
	$cmb->add_field( array( 'name' => 'About Eyebrow', 'id' => $p . 'about_eyebrow', 'type' => 'text', 'attributes' => array( 'placeholder' => 'About Us' ) ) );
	$cmb->add_field( array( 'name' => 'About Script', 'id' => $p . 'about_script', 'type' => 'text', 'attributes' => array( 'placeholder' => 'Meet the Hart Family' ) ) );
	$cmb->add_field( array( 'name' => 'About Title', 'desc' => 'Use &lt;em&gt; for the italic accent.', 'id' => $p . 'about_title', 'type' => 'textarea_small' ) );
	$cmb->add_field( array( 'name' => 'About Body', 'id' => $p . 'about_body', 'type' => 'wysiwyg', 'options' => array( 'media_buttons' => false, 'textarea_rows' => 5 ) ) );
	$cmb->add_field( array( 'name' => 'About Photo', 'id' => $p . 'about_image', 'type' => 'file', 'options' => array( 'url' => false ) ) );
	$astats = $cmb->add_field( array( 'id' => $p . 'about_stats', 'type' => 'group', 'options' => array( 'group_title' => 'Stat {#}', 'add_button' => 'Add Stat', 'remove_button' => 'Remove', 'sortable' => true, 'closed' => true ) ) );
	$cmb->add_group_field( $astats, array( 'name' => 'Value', 'id' => 'value', 'type' => 'text' ) );
	$cmb->add_group_field( $astats, array( 'name' => 'Label', 'id' => 'label', 'type' => 'text' ) );
	$cmb->add_field( array( 'name' => 'About Button Text', 'id' => $p . 'about_btn_text', 'type' => 'text' ) );
	$cmb->add_field( array( 'name' => 'About Button Link', 'id' => $p . 'about_btn_link', 'type' => 'text' ) );

	/* Testimonial */
	$cmb->add_field( array( 'name' => 'Testimonial', 'type' => 'title', 'id' => $p . 't_testi', 'before_row' => '<hr>' ) );
	$cmb->add_field( array( 'name' => 'Testimonial Script', 'id' => $p . 'testi_script', 'type' => 'text' ) );
	$cmb->add_field( array( 'name' => 'Testimonial Eyebrow', 'id' => $p . 'testi_eyebrow', 'type' => 'text' ) );
	$cmb->add_field( array( 'name' => 'Testimonial Quote', 'id' => $p . 'testi_quote', 'type' => 'textarea' ) );
	$cmb->add_field( array( 'name' => 'Testimonial Name', 'id' => $p . 'testi_name', 'type' => 'text' ) );
	$cmb->add_field( array( 'name' => 'Testimonial Role', 'id' => $p . 'testi_role', 'type' => 'text' ) );

	/* Community */
	$cmb->add_field( array( 'name' => 'Community', 'type' => 'title', 'id' => $p . 't_comm', 'before_row' => '<hr>' ) );
	$cmb->add_field( array( 'name' => 'Community Eyebrow', 'id' => $p . 'comm_eyebrow', 'type' => 'text', 'attributes' => array( 'placeholder' => 'Community' ) ) );
	$cmb->add_field( array( 'name' => 'Community Title', 'desc' => 'Use &lt;em&gt; for the italic accent.', 'id' => $p . 'comm_title', 'type' => 'textarea_small' ) );
	$cmb->add_field( array( 'name' => 'Community Body', 'id' => $p . 'comm_body', 'type' => 'textarea_small' ) );
	$partners = $cmb->add_field( array( 'id' => $p . 'comm_partners', 'type' => 'group', 'options' => array( 'group_title' => 'Partner {#}', 'add_button' => 'Add Partner', 'remove_button' => 'Remove', 'sortable' => true, 'closed' => true ) ) );
	$cmb->add_group_field( $partners, array( 'name' => 'Name', 'id' => 'name', 'type' => 'text' ) );
	$cmb->add_group_field( $partners, array( 'name' => 'Role', 'id' => 'role', 'type' => 'text' ) );
	$cmb->add_field( array( 'name' => 'Community Button Text', 'id' => $p . 'comm_btn_text', 'type' => 'text' ) );
	$cmb->add_field( array( 'name' => 'Community Button Link', 'id' => $p . 'comm_btn_link', 'type' => 'text' ) );
	$cmb->add_field( array( 'name' => 'Community Photo', 'id' => $p . 'comm_image', 'type' => 'file', 'options' => array( 'url' => false ) ) );
	$cmb->add_field( array( 'name' => 'Community Photo Alt Text', 'id' => $p . 'comm_image_alt', 'type' => 'text' ) );

	/* CTA */
	$cmb->add_field( array( 'name' => 'Closing CTA', 'type' => 'title', 'id' => $p . 't_cta', 'before_row' => '<hr>' ) );
	$cmb->add_field( array( 'name' => 'CTA Script', 'id' => $p . 'cta_script', 'type' => 'text' ) );
	$cmb->add_field( array( 'name' => 'CTA Title', 'desc' => 'Use &lt;em&gt; for the italic accent.', 'id' => $p . 'cta_title', 'type' => 'textarea_small' ) );
}
