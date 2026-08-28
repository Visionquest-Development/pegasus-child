<?php
/**
 * Hart Family of Home Services — single service detail CMB2 override fields.
 *
 * Shown on any page using the "Service Detail Page" template (tpl_service_single.php).
 * Every field is BLANK by default — the front end falls back to that service's
 * entry in the shared Services Catalogue (inc/hfhs-services-catalogue.php). Fill a
 * field in and it overrides the catalogue/design default for that page only.
 *
 * @package Pegasus_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function hfhs_register_service_single_metaboxes() {
	$p       = 'hfhs_svc_';
	$show_on = array( 'key' => 'page-template', 'value' => 'tpl_service_single.php' );
	$common  = array(
		'object_types' => array( 'page' ),
		'context'      => 'normal',
		'priority'     => 'high',
		'closed'       => true,
		'show_on'      => $show_on,
	);

	/* Hero */
	$hero = new_cmb2_box( array_merge( $common, array( 'id' => $p . 'hero_box', 'title' => 'Service — Hero' ) ) );
	$hero->add_field( array( 'name' => 'Service Number', 'desc' => 'e.g. 01. Default: catalogue number.', 'id' => $p . 'number', 'type' => 'text_small' ) );
	$hero->add_field( array( 'name' => 'Script Tagline', 'id' => $p . 'script', 'type' => 'text' ) );
	$hero->add_field( array( 'name' => 'Lead Paragraph', 'id' => $p . 'lead', 'type' => 'textarea_small' ) );
	$hero->add_field( array( 'name' => 'Hero Background Image', 'id' => $p . 'hero_image', 'type' => 'file', 'options' => array( 'url' => false ) ) );

	/* Overview + Scope */
	$ov = new_cmb2_box( array_merge( $common, array( 'id' => $p . 'overview_box', 'title' => 'Service — What We Do + Scope' ) ) );
	$ov->add_field( array( 'name' => 'Overview Title', 'desc' => 'Use &lt;em&gt; for the italic accent.', 'id' => $p . 'overview_title', 'type' => 'textarea_small' ) );
	$ov->add_field( array( 'name' => 'Overview Body (WYSIWYG)', 'id' => $p . 'overview_body', 'type' => 'wysiwyg', 'options' => array( 'media_buttons' => false, 'textarea_rows' => 6 ) ) );
	$ov->add_field( array( 'name' => 'Scope Items', 'desc' => 'One item per row. Leave blank for the catalogue scope list.', 'id' => $p . 'scope', 'type' => 'text', 'repeatable' => true, 'text' => array( 'add_row_text' => 'Add Scope Item' ) ) );

	/* Principle band */
	$pr = new_cmb2_box( array_merge( $common, array( 'id' => $p . 'principle_box', 'title' => 'Service — Principle Band' ) ) );
	$pr->add_field( array( 'name' => 'Principle Line', 'desc' => 'The big centered phrase (e.g. "Water does not wait."). Blank hides the band unless the catalogue supplies one.', 'id' => $p . 'principle', 'type' => 'text' ) );

	/* Process */
	$proc = new_cmb2_box( array_merge( $common, array( 'id' => $p . 'process_box', 'title' => 'Service — Process Steps' ) ) );
	$proc_grp = $proc->add_field( array( 'id' => $p . 'process', 'type' => 'group', 'options' => array( 'group_title' => 'Step {#}', 'add_button' => 'Add Step', 'remove_button' => 'Remove', 'sortable' => true, 'closed' => true ) ) );
	$proc->add_group_field( $proc_grp, array( 'name' => 'Title', 'id' => 'title', 'type' => 'text' ) );
	$proc->add_group_field( $proc_grp, array( 'name' => 'Text', 'id' => 'text', 'type' => 'textarea_small' ) );

	/* Recent work gallery */
	$gal = new_cmb2_box( array_merge( $common, array( 'id' => $p . 'gallery_box', 'title' => 'Service — Recent Work Gallery' ) ) );
	$gal_grp = $gal->add_field( array( 'id' => $p . 'gallery', 'type' => 'group', 'options' => array( 'group_title' => 'Photo {#}', 'add_button' => 'Add Photo', 'remove_button' => 'Remove', 'sortable' => true, 'closed' => true ) ) );
	$gal->add_group_field( $gal_grp, array( 'name' => 'Image', 'id' => 'image', 'type' => 'file', 'options' => array( 'url' => false ) ) );
	$gal->add_group_field( $gal_grp, array( 'name' => 'Caption', 'id' => 'caption', 'type' => 'text' ) );
	$gal->add_group_field( $gal_grp, array( 'name' => 'Meta (e.g. RESIDENTIAL · ATLANTA)', 'id' => 'meta', 'type' => 'text' ) );

	/* Pricing + Warranty */
	$pw = new_cmb2_box( array_merge( $common, array( 'id' => $p . 'pw_box', 'title' => 'Service — Pricing + Warranty' ) ) );
	$pw->add_field( array( 'name' => 'Pricing Lead Line', 'id' => $p . 'pricing_line', 'type' => 'text' ) );
	$pw->add_field( array( 'name' => 'Pricing Body', 'id' => $p . 'pricing_body', 'type' => 'textarea_small' ) );
	$pw->add_field( array( 'name' => 'Warranty Lead Line', 'id' => $p . 'warranty_line', 'type' => 'text' ) );
	$pw->add_field( array( 'name' => 'Warranty Body', 'id' => $p . 'warranty_body', 'type' => 'textarea_small' ) );

	/* Related services */
	$rel = new_cmb2_box( array_merge( $common, array( 'id' => $p . 'related_box', 'title' => 'Service — Related Services' ) ) );
	$rel->add_field( array( 'name' => 'Related Service Slugs', 'desc' => 'One service slug per row (e.g. roofing, exterior-repairs). Leave blank for the catalogue default.', 'id' => $p . 'related', 'type' => 'text', 'repeatable' => true, 'text' => array( 'add_row_text' => 'Add Related Service' ) ) );

	/* Testimonial */
	$te = new_cmb2_box( array_merge( $common, array( 'id' => $p . 'testi_box', 'title' => 'Service — Testimonial' ) ) );
	$te->add_field( array( 'name' => 'Eyebrow', 'desc' => 'e.g. GUTTER SERVICES', 'id' => $p . 'testi_eyebrow', 'type' => 'text' ) );
	$te->add_field( array( 'name' => 'Quote', 'desc' => 'Blank hides the testimonial section unless the catalogue supplies one.', 'id' => $p . 'testi_quote', 'type' => 'textarea' ) );
	$te->add_field( array( 'name' => 'Author Name', 'id' => $p . 'testi_name', 'type' => 'text' ) );

	/* CTA */
	$cta = new_cmb2_box( array_merge( $common, array( 'id' => $p . 'cta_box', 'title' => 'Service — Bottom CTA' ) ) );
	$cta->add_field( array( 'name' => 'CTA Title', 'desc' => 'Default: "Request a free {service} estimate today."', 'id' => $p . 'cta_title', 'type' => 'textarea_small' ) );
}
add_action( 'cmb2_admin_init', 'hfhs_register_service_single_metaboxes' );
