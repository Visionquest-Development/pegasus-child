<?php
/**
 * Furniture custom post type + taxonomies + per-piece CMB2 fields.
 *
 * Mirrors the Pegasus parent CPT conventions ( register_post_type /
 * register_taxonomy on init, hierarchical category + non-hierarchical tag ).
 * Registered unconditionally for this child theme. The Furniture page template
 * ( tpl_furniture.php ) queries this CPT to build the collection grid.
 *
 * @package Pegasus_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'init', 'rcd_register_furniture_cpt' );
/**
 * Register the Furniture post type and its Category / Tag taxonomies.
 */
function rcd_register_furniture_cpt() {

	$labels = array(
		'name'               => _x( 'Furniture', 'post type general name', 'pegasus-child' ),
		'singular_name'      => _x( 'Furniture Piece', 'post type singular name', 'pegasus-child' ),
		'add_new'            => _x( 'Add New', 'furniture', 'pegasus-child' ),
		'add_new_item'       => __( 'Add New Piece', 'pegasus-child' ),
		'edit_item'          => __( 'Edit Piece', 'pegasus-child' ),
		'new_item'           => __( 'New Piece', 'pegasus-child' ),
		'view_item'          => __( 'View Piece', 'pegasus-child' ),
		'search_items'       => __( 'Search Furniture', 'pegasus-child' ),
		'not_found'          => __( 'No furniture found', 'pegasus-child' ),
		'not_found_in_trash' => __( 'No furniture found in Trash', 'pegasus-child' ),
		'parent_item_colon'  => '',
		'menu_name'          => __( 'Furniture', 'pegasus-child' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'show_in_rest'       => true,
		'query_var'          => true,
		// Use a distinct slug so it never collides with the Furniture *page*.
		'rewrite'            => array( 'slug' => 'furniture-piece' ),
		'capability_type'    => 'post',
		'can_export'         => true,
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => 21,
		'menu_icon'          => 'dashicons-store',
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'page-attributes' ),
	);

	register_post_type( 'rcd_furniture', $args );

	// Category ( hierarchical ) — powers the filter row.
	register_taxonomy( 'furniture_cat', array( 'rcd_furniture' ), array(
		'hierarchical'      => true,
		'labels'            => array(
			'name'          => _x( 'Furniture Categories', 'taxonomy general name', 'pegasus-child' ),
			'singular_name' => _x( 'Category', 'taxonomy singular name', 'pegasus-child' ),
			'search_items'  => __( 'Search Categories', 'pegasus-child' ),
			'all_items'     => __( 'All Categories', 'pegasus-child' ),
			'edit_item'     => __( 'Edit Category', 'pegasus-child' ),
			'update_item'   => __( 'Update Category', 'pegasus-child' ),
			'add_new_item'  => __( 'Add New Category', 'pegasus-child' ),
			'new_item_name' => __( 'New Category Name', 'pegasus-child' ),
			'menu_name'     => __( 'Categories', 'pegasus-child' ),
		),
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_rest'      => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'furniture-category' ),
	) );

	// Tag ( non-hierarchical ).
	register_taxonomy( 'furniture_tag', array( 'rcd_furniture' ), array(
		'hierarchical'      => false,
		'labels'            => array(
			'name'          => _x( 'Furniture Tags', 'taxonomy general name', 'pegasus-child' ),
			'singular_name' => _x( 'Tag', 'taxonomy singular name', 'pegasus-child' ),
			'search_items'  => __( 'Search Tags', 'pegasus-child' ),
			'all_items'     => __( 'All Tags', 'pegasus-child' ),
			'edit_item'     => __( 'Edit Tag', 'pegasus-child' ),
			'update_item'   => __( 'Update Tag', 'pegasus-child' ),
			'add_new_item'  => __( 'Add New Tag', 'pegasus-child' ),
			'new_item_name' => __( 'New Tag Name', 'pegasus-child' ),
			'menu_name'     => __( 'Tags', 'pegasus-child' ),
		),
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_rest'      => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'furniture-tag' ),
	) );
}

/**
 * Flush rewrite rules once when the theme is (re)activated so the new CPT /
 * taxonomy permalinks work without a manual Settings → Permalinks save.
 */
add_action( 'after_switch_theme', 'rcd_furniture_flush_rewrites' );
function rcd_furniture_flush_rewrites() {
	rcd_register_furniture_cpt();
	flush_rewrite_rules();
}

/* ============================================================================
 * PER-PIECE CMB2 FIELDS ( on the rcd_furniture post type )
 * ========================================================================== */
add_action( 'cmb2_admin_init', 'rcd_furniture_register_piece_fields' );
/**
 * Product details for each furniture piece. The photo is the post's Featured
 * Image; the description is the post editor / excerpt.
 */
function rcd_furniture_register_piece_fields() {

	if ( ! function_exists( 'new_cmb2_box' ) ) {
		return;
	}

	$box = new_cmb2_box( array(
		'id'           => 'rcd_furniture_piece_box',
		'title'        => __( 'Piece Details', 'pegasus-child' ),
		'object_types' => array( 'rcd_furniture' ),
		'context'      => 'normal',
		'priority'     => 'high',
		// Open by default: this is the primary editing surface for a furniture
		// piece, so its fields should be visible immediately ( a collapsed box
		// shows as an empty title bar in the block editor's Meta Boxes drawer ).
		// The page-template metaboxes stay collapsed; this CPT box does not.
		'closed'       => false,
	) );

	$box->add_field( array(
		'name'    => __( 'Status', 'pegasus-child' ),
		'id'      => 'rcd_fur_status',
		'type'    => 'select',
		'default' => 'available',
		'options' => array(
			'available' => __( 'Available', 'pegasus-child' ),
			'reserved'  => __( 'Reserved', 'pegasus-child' ),
			'sold'      => __( 'Sold', 'pegasus-child' ),
		),
	) );
	$box->add_field( array(
		'name' => __( 'Meta line', 'pegasus-child' ),
		'desc' => __( 'The small line under the title, e.g. "Restored · mid-century · solid walnut".', 'pegasus-child' ),
		'id'   => 'rcd_fur_meta_line',
		'type' => 'text',
	) );
	$box->add_field( array(
		'name' => __( 'Price', 'pegasus-child' ),
		'desc' => __( 'Shown as-is, e.g. "$1,480".', 'pegasus-child' ),
		'id'   => 'rcd_fur_price',
		'type' => 'text_small',
	) );
	$box->add_field( array(
		'name' => __( 'Inquire link ( optional )', 'pegasus-child' ),
		'desc' => __( 'Leave blank to auto-build a mailto with this piece in the subject line.', 'pegasus-child' ),
		'id'   => 'rcd_fur_inquire_link',
		'type' => 'text',
	) );

	/* Product gallery ( additional photos beyond the Featured Image ) — a
	   repeatable group so each shot carries its own alt text + caption. */
	$gal_group = $box->add_field( array(
		'id'          => 'rcd_fur_gallery',
		'type'        => 'group',
		'name'        => __( 'Gallery ( additional photos )', 'pegasus-child' ),
		'description' => __( 'Extra detail shots beyond the Featured Image. Each appears as a thumbnail and opens in the lightbox.', 'pegasus-child' ),
		'options'     => array(
			'closed'        => true,
			'sortable'      => true,
			'group_title'   => __( 'Photo {#}', 'pegasus-child' ),
			'add_button'    => __( 'Add Photo', 'pegasus-child' ),
			'remove_button' => __( 'Remove Photo', 'pegasus-child' ),
		),
	) );
	$box->add_group_field( $gal_group, array(
		'name'         => __( 'Image', 'pegasus-child' ),
		'id'           => 'image',
		'type'         => 'file',
		'options'      => array( 'url' => false ),
		'query_args'   => array( 'type' => 'image' ),
		'preview_size' => array( 160, 120 ),
	) );
	$box->add_group_field( $gal_group, array(
		'name' => __( 'Alt text', 'pegasus-child' ),
		'desc' => __( 'Describes the image for screen readers &amp; SEO. Falls back to the Media Library alt, then the piece title.', 'pegasus-child' ),
		'id'   => 'alt',
		'type' => 'text',
	) );
	$box->add_group_field( $gal_group, array(
		'name' => __( 'Caption', 'pegasus-child' ),
		'desc' => __( 'Optional — shown under the image in the lightbox.', 'pegasus-child' ),
		'id'   => 'caption',
		'type' => 'text',
	) );

	/* Spec details ( shown as a product spec list ). */
	$box->add_field( array(
		'name' => __( 'Dimensions', 'pegasus-child' ),
		'desc' => __( 'e.g. 72"W × 18"D × 32"H.', 'pegasus-child' ),
		'id'   => 'rcd_fur_dimensions',
		'type' => 'text',
	) );
	$box->add_field( array(
		'name' => __( 'Materials', 'pegasus-child' ),
		'desc' => __( 'e.g. Solid walnut, brass hardware.', 'pegasus-child' ),
		'id'   => 'rcd_fur_materials',
		'type' => 'text',
	) );
	$box->add_field( array(
		'name' => __( 'Condition', 'pegasus-child' ),
		'desc' => __( 'e.g. Fully restored, excellent.', 'pegasus-child' ),
		'id'   => 'rcd_fur_condition',
		'type' => 'text',
	) );
}
