<?php
/**
 * Valor Care — Individual service detail page CMB2 fields.
 *
 * These metaboxes appear on any page using the "Service Detail Page" template
 * (tpl_service_single.php) — i.e. the Companionship / Personal Care / Respite
 * Care / Homemaking / Dementia subpages.
 *
 * Field behavior matches the rest of the theme: leave a field blank and the
 * page shows its DEFAULT content (that service's entry from the Services
 * Catalogue, plus branded default copy). Fill a field in and it replaces the
 * default. Because the defaults differ per service, they are resolved in the
 * template (tpl_service_single.php) rather than as static CMB2 defaults — so
 * these admin fields are intentionally blank until you type into them.
 *
 * @package Pegasus_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the Service Detail page metaboxes.
 */
function valorcare_register_service_single_metaboxes() {

	$prefix  = 'vc_';
	$show_on = array(
		'key'   => 'page-template',
		'value' => 'tpl_service_single.php',
	);
	$box_common = array(
		'object_types' => array( 'page' ),
		'context'      => 'normal',
		'priority'     => 'high',
		'closed'       => true,
		'show_on'      => $show_on,
	);

	/* ------------------------------------------------------------ Hero */
	$hero = new_cmb2_box( array_merge( $box_common, array(
		'id'    => $prefix . 'svc_hero_box',
		'title' => esc_html__( 'Service — Hero', 'pegasus-child' ),
	) ) );
	$hero->add_field( array( 'name' => 'Eyebrow / breadcrumb label', 'desc' => 'Default: "Our Services".', 'id' => $prefix . 'svc_hero_eyebrow', 'type' => 'text' ) );
	$hero->add_field( array( 'name' => 'Lead paragraph', 'desc' => "Default: this service's short description from the Services Catalogue.", 'id' => $prefix . 'svc_hero_lead', 'type' => 'textarea_small' ) );
	$hero->add_field( array( 'name' => 'Font Awesome Icon', 'desc' => 'e.g. fa-users. Default: the catalogue icon for this service.', 'id' => $prefix . 'svc_icon', 'type' => 'text' ) );
	$hero->add_field( array( 'name' => 'Hero Photo', 'desc' => 'Replaces the placeholder in the hero. Leave blank to keep the placeholder.', 'id' => $prefix . 'svc_hero_image', 'type' => 'file', 'options' => array( 'url' => false ) ) );

	/* -------------------------------------------------------- Overview */
	$ov = new_cmb2_box( array_merge( $box_common, array(
		'id'    => $prefix . 'svc_overview_box',
		'title' => esc_html__( 'Service — Overview', 'pegasus-child' ),
	) ) );
	$ov->add_field( array( 'name' => 'Overview Heading', 'desc' => 'Default: "About {service name}".', 'id' => $prefix . 'svc_overview_heading', 'type' => 'text' ) );
	$ov->add_field( array( 'name' => 'Overview Body (WYSIWYG)', 'desc' => 'The main description. Default: a branded blurb built from this service.', 'id' => $prefix . 'svc_overview_body', 'type' => 'wysiwyg', 'options' => array( 'media_buttons' => true, 'textarea_rows' => 8 ) ) );

	/* -------------------------------------------------- What's Included */
	$inc = new_cmb2_box( array_merge( $box_common, array(
		'id'    => $prefix . 'svc_included_box',
		'title' => esc_html__( "Service — What's Included", 'pegasus-child' ),
	) ) );
	$inc->add_field( array( 'name' => 'Heading', 'desc' => 'Default: "What\'s Included".', 'id' => $prefix . 'svc_included_heading', 'type' => 'text' ) );
	$inc->add_field( array(
		'name'       => 'Bullets',
		'desc'       => 'One bullet per row — each becomes a gold-check row. Leave all rows blank to show this service\'s catalogue bullets.',
		'id'         => $prefix . 'svc_included_bullets',
		'type'       => 'text',
		'repeatable' => true,
		'text'       => array( 'add_row_text' => 'Add Bullet' ),
	) );

	/* ------------------------------------------------------------- CTA */
	$cta = new_cmb2_box( array_merge( $box_common, array(
		'id'    => $prefix . 'svc_cta_box',
		'title' => esc_html__( 'Service — Bottom CTA', 'pegasus-child' ),
	) ) );
	$cta->add_field( array( 'name' => 'Heading', 'desc' => 'Default: "Ready to talk about {service name}?".', 'id' => $prefix . 'svc_cta_heading', 'type' => 'text' ) );
	$cta->add_field( array( 'name' => 'Text', 'id' => $prefix . 'svc_cta_text', 'type' => 'textarea_small' ) );
}
add_action( 'cmb2_admin_init', 'valorcare_register_service_single_metaboxes' );
