<?php
/**
 * Hart Family of Home Services — Services Hub (/services/) CMB2 fields + helpers.
 *
 * Same override-or-default pattern as the other templates: tpl_services.php ships
 * defaults (the same ten service cards as the home page grid) and each value is
 * wired to a field in the "Services Hub Content" metabox. Blank = default.
 *
 * The box shows on pages using the "Services Hub Template" and on the top-level
 * "services" page while it has no template (it gets the hub automatically).
 *
 * @package Pegasus_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'HFHS_HUB_PREFIX', '_hfhs_hub_' );

function hfhs_hub_field( $key, $default = '' ) {
	$id  = get_queried_object_id();
	$val = $id ? get_post_meta( $id, HFHS_HUB_PREFIX . $key, true ) : '';
	if ( is_string( $val ) ) {
		$val = trim( $val );
	}
	return ( '' === $val || null === $val || array() === $val ) ? $default : $val;
}

function hfhs_hub_group( $key, $default = array() ) {
	$id  = get_queried_object_id();
	$val = $id ? get_post_meta( $id, HFHS_HUB_PREFIX . $key, true ) : array();
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

function hfhs_show_on_services_hub( $cmb ) {
	$post_id = $cmb->object_id();
	if ( ! $post_id && isset( $_GET['post'] ) ) {
		$post_id = absint( $_GET['post'] );
	}
	if ( ! $post_id ) {
		return false;
	}
	$tpl = get_page_template_slug( $post_id );
	if ( 'tpl_services.php' === $tpl ) {
		return true;
	}
	return '' === $tpl && 'services' === get_post_field( 'post_name', $post_id ) && ! wp_get_post_parent_id( $post_id );
}

add_action( 'cmb2_admin_init', 'hfhs_hub_register_metaboxes' );
function hfhs_hub_register_metaboxes() {
	$p = HFHS_HUB_PREFIX;

	$cmb = new_cmb2_box( array(
		'id'           => 'hfhs_hub_content',
		'title'        => __( 'Services Hub Content', 'pegasus' ),
		'object_types' => array( 'page' ),
		'context'      => 'normal',
		'priority'     => 'high',
		'closed'       => true,
		'show_on_cb'   => 'hfhs_show_on_services_hub',
	) );

	$cmb->add_field( array( 'name' => '1. Hero', 'type' => 'title', 'id' => $p . 't_hero', 'desc' => 'Every field is optional — leave blank to keep the default shown on the page.' ) );
	$cmb->add_field( array( 'name' => 'Hero Eyebrow', 'id' => $p . 'hero_eyebrow', 'type' => 'text', 'attributes' => array( 'placeholder' => 'Our Services' ) ) );
	$cmb->add_field( array( 'name' => 'Hero Script', 'id' => $p . 'hero_script', 'type' => 'text', 'attributes' => array( 'placeholder' => 'From Our Family to Yours.' ) ) );
	$cmb->add_field( array( 'name' => 'Hero Title', 'desc' => 'Use &lt;em&gt; for the italic accent.', 'id' => $p . 'hero_title', 'type' => 'textarea_small', 'attributes' => array( 'placeholder' => 'Ten services. <em>One trusted team.</em>' ) ) );
	$cmb->add_field( array( 'name' => 'Hero Intro', 'id' => $p . 'hero_text', 'type' => 'textarea_small' ) );
	$cmb->add_field( array( 'name' => 'Hero Background Image', 'desc' => 'Optional (the page Featured Image is also used if set).', 'id' => $p . 'hero_image', 'type' => 'file', 'options' => array( 'url' => false ) ) );

	$cmb->add_field( array( 'name' => '2. Services Grid', 'type' => 'title', 'id' => $p . 't_services', 'before_row' => '<hr>', 'desc' => 'Leave the list empty to show the default ten service cards (same as the home page). Once you add a card, only your cards show.' ) );
	$cmb->add_field( array( 'name' => 'Grid Eyebrow', 'id' => $p . 'services_eyebrow', 'type' => 'text', 'attributes' => array( 'placeholder' => 'What We Do' ) ) );
	$cmb->add_field( array( 'name' => 'Grid Intro', 'id' => $p . 'services_lead', 'type' => 'textarea_small' ) );
	$svc = $cmb->add_field( array( 'id' => $p . 'services', 'type' => 'group', 'options' => array( 'group_title' => 'Service {#}', 'add_button' => 'Add Service', 'remove_button' => 'Remove', 'sortable' => true, 'closed' => true ) ) );
	$cmb->add_group_field( $svc, array( 'name' => 'Title', 'id' => 'title', 'type' => 'text' ) );
	$cmb->add_group_field( $svc, array( 'name' => 'Description', 'id' => 'desc', 'type' => 'textarea_small' ) );
	$cmb->add_group_field( $svc, array( 'name' => 'Link', 'desc' => 'e.g. /services/gutters/', 'id' => 'link', 'type' => 'text' ) );
	$cmb->add_group_field( $svc, array( 'name' => 'Link Text', 'id' => 'cta', 'type' => 'text' ) );
	$cmb->add_group_field( $svc, array( 'name' => 'Background Image', 'id' => 'img', 'type' => 'file', 'options' => array( 'url' => false ) ) );

	$cmb->add_field( array( 'name' => '3. Closing CTA', 'type' => 'title', 'id' => $p . 't_cta', 'before_row' => '<hr>' ) );
	$cmb->add_field( array( 'name' => 'CTA Script', 'id' => $p . 'cta_script', 'type' => 'text', 'attributes' => array( 'placeholder' => 'Ready to get started?' ) ) );
	$cmb->add_field( array( 'name' => 'CTA Title', 'desc' => 'Use &lt;em&gt; for the italic accent.', 'id' => $p . 'cta_title', 'type' => 'textarea_small', 'attributes' => array( 'placeholder' => 'Request a free estimate today.' ) ) );
}
