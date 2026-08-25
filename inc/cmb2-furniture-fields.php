<?php
/**
 * CMB2 fields + defaults + helpers for the Furniture template ( tpl_furniture.php ).
 *
 * Page-level content ( intro, pickup badge, "how it works" steps, inquire CTA )
 * is CMB2 post meta on the Furniture page. The collection grid is powered by the
 * rcd_furniture custom post type ( see inc/furniture-cpt.php ); when no pieces
 * exist yet the Claude Design default pieces are shown.
 *
 * Shares the generic render helpers ( rcd_home_media, rcd_home_row,
 * rcd_home_row_has_content ) defined in inc/cmb2-home-fields.php.
 *
 * @package Pegasus_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* ============================================================================
 * DEFAULTS
 * ========================================================================== */
if ( ! function_exists( 'rcd_furniture_defaults' ) ) {
	/**
	 * Claude Design default content for the furniture page ( page copy, default
	 * filter labels, and placeholder collection pieces ).
	 *
	 * @return array
	 */
	function rcd_furniture_defaults() {
		return array(

			// Intro.
			'intro_eyebrow' => 'Reclaimed &amp; Reimagined',
			'intro_heading' => 'The Furniture Collection',
			'intro_text'    => "A rotating, one-of-a-kind selection of high-end pieces we've sourced and restored by hand. Each is sold individually and available for local pickup in the Atlanta area.",
			'pickup_badge'  => 'Local pickup only · Inquire to purchase',

			// "How it works".
			'how_eyebrow'   => 'How It Works',
			'how_heading'   => 'Simple, local, by hand',
			'steps'         => array(
				array(
					'num'   => '01',
					'title' => 'Inquire',
					'desc'  => "See something you love? Send us a note and we'll confirm it's still available, with full condition details and dimensions.",
				),
				array(
					'num'   => '02',
					'title' => 'Reserve',
					'desc'  => "A simple deposit holds the piece in your name. We'll arrange a pickup window that works for you.",
				),
				array(
					'num'   => '03',
					'title' => 'Pick Up',
					'desc'  => "Collect your piece from our Atlanta studio. We'll help you load, and offer local delivery referrals on request.",
				),
			),
			'inquire_btn_text' => 'Inquire about a piece',
			'inquire_btn_link' => 'mailto:hello@renecatherinedesigns.com?subject=Furniture%20Inquiry',
			'coming_soon'      => 'An online shop for merch, candles &amp; more is coming soon.',

			// Default filter labels ( used until furniture_cat terms exist ).
			'filters' => array( 'All Pieces', 'Seating', 'Case Goods', 'Tables', 'Lighting &amp; Décor' ),

			// Default collection pieces ( used until rcd_furniture posts exist ).
			// 'cats' hold category NAMES that match the default filter labels so
			// the Isotope demo filters work out of the box.
			'pieces' => array(
				array( 'name' => 'Walnut Credenza',      'meta' => 'Restored · mid-century · solid walnut',        'price' => '$1,480', 'status' => 'available', 'cats' => array( 'Case Goods' ) ),
				array( 'name' => 'Carved Oak Armoire',   'meta' => 'Architectural revival · 19th c. French oak',   'price' => '$2,650', 'status' => 'available', 'cats' => array( 'Case Goods' ) ),
				array( 'name' => 'Brass &amp; Cane Bar Cart', 'meta' => 'Sourced &amp; refinished · brass, cane',   'price' => '$640',   'status' => 'reserved', 'cats' => array( 'Tables' ) ),
				array( 'name' => 'Velvet Slipper Chair', 'meta' => 'Reupholstered · vintage frame',                'price' => '$520',   'status' => 'available', 'cats' => array( 'Seating' ) ),
				array( 'name' => 'Marble-Top Console',   'meta' => 'Restored · honed Carrara, iron base',          'price' => '$1,120', 'status' => 'available', 'cats' => array( 'Tables' ) ),
				array( 'name' => 'Spindle Accent Table', 'meta' => 'Refinished · solid maple',                     'price' => '$310',   'status' => 'sold',      'cats' => array( 'Seating' ) ),
			),
		);
	}
}

/* ============================================================================
 * METABOX REGISTRATION ( on the Furniture page template )
 * ========================================================================== */
add_action( 'cmb2_admin_init', 'rcd_furniture_register_metaboxes' );
/**
 * Register the furniture-page metaboxes. Collapsed by default, shown only on
 * pages using tpl_furniture.php.
 */
function rcd_furniture_register_metaboxes() {

	if ( ! function_exists( 'new_cmb2_box' ) ) {
		return;
	}

	$prefix = 'rcd_fur_';
	$d      = rcd_furniture_defaults();

	$box_args = array(
		'object_types' => array( 'page' ),
		'context'      => 'normal',
		'priority'     => 'high',
		'closed'       => true,
		'show_on_cb'   => 'rcd_furniture_show_for_template',
	);

	/* Intro */
	$intro = new_cmb2_box( array_merge( $box_args, array(
		'id'    => $prefix . 'intro_box',
		'title' => __( 'Furniture — Intro', 'pegasus-child' ),
	) ) );
	$intro->add_field( array(
		'name'    => __( 'Eyebrow', 'pegasus-child' ),
		'id'      => $prefix . 'intro_eyebrow',
		'type'    => 'text',
		'default' => $d['intro_eyebrow'],
	) );
	$intro->add_field( array(
		'name'    => __( 'Heading', 'pegasus-child' ),
		'id'      => $prefix . 'intro_heading',
		'type'    => 'text',
		'default' => $d['intro_heading'],
	) );
	$intro->add_field( array(
		'name'    => __( 'Intro text', 'pegasus-child' ),
		'id'      => $prefix . 'intro_text',
		'type'    => 'textarea',
		'default' => $d['intro_text'],
	) );
	$intro->add_field( array(
		'name'    => __( 'Pickup badge', 'pegasus-child' ),
		'id'      => $prefix . 'pickup_badge',
		'type'    => 'text',
		'default' => $d['pickup_badge'],
	) );

	/* How it works */
	$how = new_cmb2_box( array_merge( $box_args, array(
		'id'    => $prefix . 'how_box',
		'title' => __( 'Furniture — How It Works', 'pegasus-child' ),
	) ) );
	$how->add_field( array(
		'name'    => __( 'Eyebrow', 'pegasus-child' ),
		'id'      => $prefix . 'how_eyebrow',
		'type'    => 'text',
		'default' => $d['how_eyebrow'],
	) );
	$how->add_field( array(
		'name'    => __( 'Heading', 'pegasus-child' ),
		'id'      => $prefix . 'how_heading',
		'type'    => 'text',
		'default' => $d['how_heading'],
	) );
	$steps_group = $how->add_field( array(
		'id'      => $prefix . 'steps',
		'type'    => 'group',
		'options' => array(
			'closed'        => true,
			'sortable'      => true,
			'group_title'   => __( 'Step {#}', 'pegasus-child' ),
			'add_button'    => __( 'Add Step', 'pegasus-child' ),
			'remove_button' => __( 'Remove Step', 'pegasus-child' ),
		),
	) );
	$how->add_group_field( $steps_group, array(
		'name' => __( 'Number', 'pegasus-child' ),
		'id'   => 'num',
		'type' => 'text_small',
	) );
	$how->add_group_field( $steps_group, array(
		'name' => __( 'Title', 'pegasus-child' ),
		'id'   => 'title',
		'type' => 'text',
	) );
	$how->add_group_field( $steps_group, array(
		'name' => __( 'Description', 'pegasus-child' ),
		'id'   => 'desc',
		'type' => 'textarea_small',
	) );
	$how->add_field( array(
		'name'    => __( 'Inquire button — text', 'pegasus-child' ),
		'id'      => $prefix . 'inquire_btn_text',
		'type'    => 'text',
		'default' => $d['inquire_btn_text'],
	) );
	$how->add_field( array(
		'name'    => __( 'Inquire button — link', 'pegasus-child' ),
		'id'      => $prefix . 'inquire_btn_link',
		'type'    => 'text',
		'default' => $d['inquire_btn_link'],
	) );
	$how->add_field( array(
		'name'    => __( 'Coming-soon note', 'pegasus-child' ),
		'id'      => $prefix . 'coming_soon',
		'type'    => 'text',
		'default' => $d['coming_soon'],
	) );
}

/**
 * show_on_cb: only display on pages using tpl_furniture.php.
 *
 * @param object $cmb CMB2 instance.
 * @return bool
 */
function rcd_furniture_show_for_template( $cmb ) {
	$post_id = 0;

	if ( isset( $_GET['post'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification
		$post_id = absint( $_GET['post'] );
	} elseif ( isset( $_POST['post_ID'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification
		$post_id = absint( $_POST['post_ID'] );
	}

	if ( ! $post_id ) {
		return false;
	}

	return ( 'tpl_furniture.php' === get_post_meta( $post_id, '_wp_page_template', true ) );
}

/* ============================================================================
 * TEMPLATE HELPERS
 * ========================================================================== */

if ( ! function_exists( 'rcd_fur_field' ) ) {
	/**
	 * Get a single furniture page field, falling back to the Claude Design default.
	 *
	 * @param string $key     Field key without the rcd_fur_ prefix.
	 * @param int    $post_id Optional post ID.
	 * @return mixed
	 */
	function rcd_fur_field( $key, $post_id = 0 ) {
		$post_id = $post_id ? $post_id : get_the_ID();
		$value   = get_post_meta( $post_id, 'rcd_fur_' . $key, true );

		if ( '' === $value || null === $value || false === $value ) {
			$defaults = rcd_furniture_defaults();
			return isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';
		}

		return $value;
	}
}

if ( ! function_exists( 'rcd_fur_rows' ) ) {
	/**
	 * Get repeatable group rows ( rcd_fur_ prefix ), discarding empty rows and
	 * falling back to the Claude Design defaults when nothing real is saved.
	 *
	 * @param string $key     Group key without the rcd_fur_ prefix.
	 * @param int    $post_id Optional post ID.
	 * @return array
	 */
	function rcd_fur_rows( $key, $post_id = 0 ) {
		$post_id = $post_id ? $post_id : get_the_ID();
		$rows    = get_post_meta( $post_id, 'rcd_fur_' . $key, true );
		$clean   = array();

		if ( is_array( $rows ) ) {
			foreach ( $rows as $row ) {
				if ( rcd_home_row_has_content( $row ) ) {
					$clean[] = $row;
				}
			}
		}

		if ( empty( $clean ) ) {
			$defaults = rcd_furniture_defaults();
			return isset( $defaults[ $key ] ) ? $defaults[ $key ] : array();
		}

		return $clean;
	}
}

if ( ! function_exists( 'rcd_get_furniture_pieces' ) ) {
	/**
	 * The collection grid: published rcd_furniture posts normalised to a common
	 * shape, or the Claude Design default pieces when none exist yet.
	 *
	 * @return array
	 */
	function rcd_get_furniture_pieces() {
		$query = new WP_Query( array(
			'post_type'      => 'rcd_furniture',
			'post_status'    => 'publish',
			'posts_per_page' => 60,
			'orderby'        => array( 'menu_order' => 'ASC', 'date' => 'DESC' ),
			'no_found_rows'  => true,
		) );

		if ( ! $query->have_posts() ) {
			wp_reset_postdata();
			$defaults = rcd_furniture_defaults();
			return $defaults['pieces'];
		}

		$pieces = array();
		while ( $query->have_posts() ) {
			$query->the_post();
			$id       = get_the_ID();
			$status   = get_post_meta( $id, 'rcd_fur_status', true );
			$cats     = wp_get_post_terms( $id, 'furniture_cat', array( 'fields' => 'names' ) );
			$pieces[] = array(
				'name'      => get_the_title(),
				'meta'      => (string) get_post_meta( $id, 'rcd_fur_meta_line', true ),
				'price'     => (string) get_post_meta( $id, 'rcd_fur_price', true ),
				'status'    => $status ? $status : 'available',
				'image'     => (string) get_the_post_thumbnail_url( $id, 'large' ),
				'inquire'   => (string) get_post_meta( $id, 'rcd_fur_inquire_link', true ),
				'permalink' => get_permalink( $id ),
				'cats'      => ( is_array( $cats ) && ! is_wp_error( $cats ) ) ? $cats : array(),
			);
		}
		wp_reset_postdata();

		return $pieces;
	}
}

if ( ! function_exists( 'rcd_get_furniture_filters' ) ) {
	/**
	 * Filter-row labels: "All Pieces" + the furniture_cat terms, or the Claude
	 * Design default labels until any categories are created.
	 *
	 * @return array
	 */
	function rcd_get_furniture_filters() {
		$terms = get_terms( array(
			'taxonomy'   => 'furniture_cat',
			'hide_empty' => false,
		) );

		if ( is_wp_error( $terms ) || empty( $terms ) ) {
			$defaults = rcd_furniture_defaults();
			return $defaults['filters'];
		}

		$labels = array( __( 'All Pieces', 'pegasus-child' ) );
		foreach ( $terms as $term ) {
			$labels[] = $term->name;
		}
		return $labels;
	}
}

if ( ! function_exists( 'rcd_fur_class' ) ) {
	/**
	 * Turn a category name into an Isotope filter slug. Matches the transform
	 * used on the filter buttons AND the grid items so they line up ( same
	 * approach as the cadence portfolio: strtolower( sanitize_html_class() ) ).
	 *
	 * @param string $name Category / filter name.
	 * @return string
	 */
	function rcd_fur_class( $name ) {
		return strtolower( sanitize_html_class( html_entity_decode( (string) $name, ENT_QUOTES ) ) );
	}
}

if ( ! function_exists( 'rcd_furniture_status_meta' ) ) {
	/**
	 * Presentation map for a piece status ( label, CTA text, badge + card classes ).
	 *
	 * @param string $status available | reserved | sold.
	 * @return array
	 */
	function rcd_furniture_status_meta( $status ) {
		switch ( $status ) {
			case 'sold':
				return array(
					'label'      => __( 'Sold', 'pegasus-child' ),
					'cta'        => __( 'View', 'pegasus-child' ),
					'badge_class' => 'rcd-fur-badge--sold',
					'card_class'  => 'rcd-fur-card--sold',
				);
			case 'reserved':
				return array(
					'label'      => __( 'Reserved', 'pegasus-child' ),
					'cta'        => __( 'Join Waitlist', 'pegasus-child' ),
					'badge_class' => 'rcd-fur-badge--reserved',
					'card_class'  => 'rcd-fur-card--reserved',
				);
			default:
				return array(
					'label'      => __( 'Available', 'pegasus-child' ),
					'cta'        => __( 'Inquire', 'pegasus-child' ),
					'badge_class' => 'rcd-fur-badge--available',
					'card_class'  => '',
				);
		}
	}
}
