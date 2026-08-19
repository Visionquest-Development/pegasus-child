<?php
/**
 * CMB2 fields for the About template (tpl_about.php).
 *
 * The front end shows these defaults until real content is saved. Defaults live
 * in sb_about_defaults() so the admin prefill and the template fallback stay in
 * sync. The metabox is collapsed by default and only shows on the About template.
 *
 * @package Pegasus_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Canonical default content for the About page.
 *
 * @return array
 */
function sb_about_defaults() {
	$img = 'https://thestoutbrothers.com/wp-content/uploads/';

	return array(
		'hero_kicker'      => 'Our Story',
		'hero_heading'     => 'About The Stout Brothers',
		'hero_image'       => $img . '2023/08/the-stout-brothers-about.jpg',
		'hero_text'        => "Welcome to The Stout Brothers Beer Market, where our passion for craft beer comes to life. With over 10 years of serving the finest and most unique craft beers, we have become a beloved destination for beer lovers near and far. Our journey began in Smyrna Market Village, Smyrna, Georgia, and since then we have expanded our presence to Canton Street in Roswell and historic Downtown Woodstock, Georgia. At each location, we offer a carefully curated selection of craft beers that you won't find in your average store. We're not just a beer store, we're a community of beer enthusiasts who are here to share our love for exceptional brews. And that's not all – we've also partnered with local breweries, introduced gourmet food snacks, and now proudly serve freshly roasted coffee at our Woodstock location. The Stout Brothers is a place like no other, where you can experience the true essence of beer culture. Come join us and discover what makes The Stout Brothers special.",
		'owner_kicker'     => 'Meet The Owner',
		'owner_heading'    => 'About The Owner',
		'owner_image'      => $img . '2023/08/Brandon_01a.jpg',
		'owner_text'       => "Brandon King has a long-time passion for the restaurant and bar industry. He's been in the booze industry for almost three decades and has endless creativity for pairing great drinks with great food. As the owner of The Stout Brothers, Brandon's goal is to share products of local breweries and culinary geniuses with the communities that house them.",
		'locations_kicker' => 'Come See Us',
		'locations_heading' => 'Explore Our Locations',
	);
}

/**
 * Register the About page metabox.
 */
function sb_about_register_metaboxes() {

	if ( ! function_exists( 'new_cmb2_box' ) ) {
		return;
	}

	$prefix = '_sb_about_';
	$d      = sb_about_defaults();

	$box = new_cmb2_box( array(
		'id'           => $prefix . 'box',
		'title'        => __( 'About Page', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'context'      => 'normal',
		'priority'     => 'high',
		'closed'       => true,
		'show_on'      => array( 'key' => 'page-template', 'value' => 'tpl_about.php' ),
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

	// Owner.
	$box->add_field( array( 'name' => __( 'Owner — kicker', 'pegasus-child' ), 'id' => $prefix . 'owner_kicker', 'type' => 'text', 'default' => $d['owner_kicker'] ) );
	$box->add_field( array( 'name' => __( 'Owner — heading', 'pegasus-child' ), 'id' => $prefix . 'owner_heading', 'type' => 'text', 'default' => $d['owner_heading'] ) );
	$box->add_field( array(
		'name'         => __( 'Owner — image', 'pegasus-child' ),
		'id'           => $prefix . 'owner_image',
		'type'         => 'file',
		'options'      => array( 'url' => false ),
		'query_args'   => array( 'type' => 'image' ),
		'preview_size' => 'medium',
	) );
	$box->add_field( array( 'name' => __( 'Owner — text', 'pegasus-child' ), 'id' => $prefix . 'owner_text', 'type' => 'textarea', 'default' => $d['owner_text'] ) );

	// Locations section.
	$box->add_field( array( 'name' => __( 'Locations — kicker', 'pegasus-child' ), 'id' => $prefix . 'locations_kicker', 'type' => 'text', 'default' => $d['locations_kicker'] ) );
	$box->add_field( array( 'name' => __( 'Locations — heading', 'pegasus-child' ), 'id' => $prefix . 'locations_heading', 'type' => 'text', 'default' => $d['locations_heading'] ) );
}
add_action( 'cmb2_admin_init', 'sb_about_register_metaboxes' );

/**
 * Get an About field, falling back to its design default.
 *
 * @param int    $post_id Page ID.
 * @param string $key     Key without the `_sb_about_` prefix.
 * @return string
 */
function sb_about_field( $post_id, $key ) {
	$d = sb_about_defaults();
	$v = get_post_meta( $post_id, '_sb_about_' . $key, true );

	if ( is_string( $v ) && '' !== trim( $v ) ) {
		return $v;
	}

	return isset( $d[ $key ] ) ? $d[ $key ] : '';
}
