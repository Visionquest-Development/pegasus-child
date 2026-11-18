<?php
/**
 * Hart Family of Home Services — Thank You page CMB2 fields + helper.
 *
 * For tpl_thank_you.php (the page the contact form redirects to after a
 * submission). Blank field = the default shown on the page.
 *
 * @package Pegasus_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'HFHS_THANKS_PREFIX', '_hfhs_thanks_' );

function hfhs_thanks_field( $key, $default = '' ) {
	$id  = get_queried_object_id();
	$val = $id ? get_post_meta( $id, HFHS_THANKS_PREFIX . $key, true ) : '';
	if ( is_string( $val ) ) {
		$val = trim( $val );
	}
	return ( '' === $val || null === $val || array() === $val ) ? $default : $val;
}

function hfhs_show_on_thank_you_template( $cmb ) {
	$post_id = $cmb->object_id();
	if ( ! $post_id && isset( $_GET['post'] ) ) {
		$post_id = absint( $_GET['post'] );
	}
	return $post_id && 'tpl_thank_you.php' === get_page_template_slug( $post_id );
}

/**
 * Keep the thank-you page out of search results.
 */
function hfhs_thank_you_noindex( $robots ) {
	if ( is_page_template( 'tpl_thank_you.php' ) ) {
		$robots['noindex'] = true;
		$robots['follow']  = true;
	}
	return $robots;
}
add_filter( 'wp_robots', 'hfhs_thank_you_noindex' );

add_action( 'cmb2_admin_init', 'hfhs_thanks_register_metaboxes' );
function hfhs_thanks_register_metaboxes() {
	$p = HFHS_THANKS_PREFIX;

	$cmb = new_cmb2_box( array(
		'id'           => 'hfhs_thanks_content',
		'title'        => __( 'Thank You Page Content', 'pegasus' ),
		'object_types' => array( 'page' ),
		'context'      => 'normal',
		'priority'     => 'high',
		'closed'       => true,
		'show_on_cb'   => 'hfhs_show_on_thank_you_template',
	) );

	$cmb->add_field( array( 'name' => '1. Message', 'type' => 'title', 'id' => $p . 't_msg', 'desc' => 'Every field is optional — leave blank to keep the default shown on the page.' ) );
	$cmb->add_field( array( 'name' => 'Eyebrow', 'id' => $p . 'eyebrow', 'type' => 'text', 'attributes' => array( 'placeholder' => 'Thank You' ) ) );
	$cmb->add_field( array( 'name' => 'Script', 'id' => $p . 'script', 'type' => 'text', 'attributes' => array( 'placeholder' => 'From Our Family to Yours.' ) ) );
	$cmb->add_field( array( 'name' => 'Title', 'desc' => 'Use &lt;em&gt; for the italic accent.', 'id' => $p . 'title', 'type' => 'textarea_small', 'attributes' => array( 'placeholder' => 'We got your request. <em>We’ll respond within one business day.</em>' ) ) );
	$cmb->add_field( array( 'name' => 'Body', 'id' => $p . 'body', 'type' => 'textarea_small' ) );
	$cmb->add_field( array( 'name' => 'Background Image', 'desc' => 'Optional (the page Featured Image is also used if set).', 'id' => $p . 'image', 'type' => 'file', 'options' => array( 'url' => false ) ) );

	$cmb->add_field( array( 'name' => '2. Buttons', 'type' => 'title', 'id' => $p . 't_btns', 'before_row' => '<hr>' ) );
	$cmb->add_field( array( 'name' => 'Button 1 Text', 'id' => $p . 'btn1_text', 'type' => 'text', 'attributes' => array( 'placeholder' => 'Back to Home' ) ) );
	$cmb->add_field( array( 'name' => 'Button 1 Link', 'id' => $p . 'btn1_link', 'type' => 'text', 'attributes' => array( 'placeholder' => '/' ) ) );
	$cmb->add_field( array( 'name' => 'Button 2 Text', 'id' => $p . 'btn2_text', 'type' => 'text', 'attributes' => array( 'placeholder' => 'Explore Our Services' ) ) );
	$cmb->add_field( array( 'name' => 'Button 2 Link', 'id' => $p . 'btn2_link', 'type' => 'text', 'attributes' => array( 'placeholder' => '/services/' ) ) );
}
