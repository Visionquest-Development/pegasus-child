<?php
/**
 * Outlaw Coffee — Homepage CMB2 fields + render helpers.
 *
 * Included from the child theme functions.php. Registers the CMB2 metaboxes
 * that power the Home Template (tpl_home.php) and exposes the getter helpers
 * the template uses to fall back to the Claude Design defaults when a field
 * has not been filled in yet.
 *
 * @package pegasus-child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** Meta prefix for every homepage field. */
define( 'OCH_PREFIX', '_och_' );

/** Template slug the homepage boxes are attached to. */
define( 'OCH_TEMPLATE', 'tpl_home.php' );

/* -------------------------------------------------------------------------
 * Default content (single source of truth for admin + front-end fallback)
 * ---------------------------------------------------------------------- */

/**
 * The default homepage content pulled from the Claude Design mockup.
 *
 * Scalar defaults are also attached to their CMB2 fields so they pre-fill in
 * the editor; repeatable groups fall back to these arrays on the front end
 * until the editor saves their own rows.
 *
 * @return array
 */
function och_home_defaults() {
	static $defaults = null;
	if ( null !== $defaults ) {
		return $defaults;
	}

	$defaults = array(
		'hero' => array(
			'eyebrow'   => 'Roasted fresh to order',
			'title'     => 'Coffee for those who ride their own trail.',
			'text'      => 'Small-batch beans, roasted to order and shipped within 48 hours. Bold, full-bodied, and unmistakably Outlaw — brewed for the brave.',
			'btn1_text' => 'Shop the roasts',
			'btn1_url'  => '/online-shop/',
			'btn2_text' => 'Our story',
			'btn2_url'  => '#our-story',
			'rating'    => 'Rated 4.9 · American made & roasted',
			'badge'     => 'FRESH · SMALL BATCH · GEORGIA',
		),

		'value_props' => array(
			array(
				'icon'  => 'cup',
				'title' => 'Done the right way',
				'text'  => 'Great coffee begins with patience, purpose, and a commitment to doing things the right way.',
			),
			array(
				'icon'  => 'handshake',
				'title' => 'Built on community',
				'text'  => 'Coffee is a ritual that strengthens bonds, nurtures communities, and fosters moments of peace.',
			),
			array(
				'icon'  => 'stars',
				'title' => 'Service & respect',
				'text'  => 'We celebrate an enduring spirit of service through care and respect in everything we make.',
			),
		),

		'shop' => array(
			'eyebrow' => 'The lineup',
			'title'   => 'Shop the roasts',
		),

		'featured' => array(
			'eyebrow'  => 'Featured blend',
			'title'    => 'Campfire Gold',
			'text'     => 'A smooth, balanced blend built from Guatemala dark roast and Panama natural beans — rich depth with a bright touch of natural sweetness.',
			'specs'    => array(
				array(
					'label' => 'Tasting notes',
					'value' => 'Dark chocolate · toasted walnut · caramelized sugar · dried cherry',
				),
				array(
					'label' => 'Roast profile',
					'value' => 'Medium-dark, full body, smooth lingering finish',
				),
				array(
					'label' => 'Origin',
					'value' => 'Guatemala 80% / Panama Natural 20%',
				),
			),
			'cta_text' => 'Shop Campfire Gold — $19',
			'cta_url'  => '/online-shop/',
			'note'     => 'Ships within 48 hours',
		),

		'story' => array(
			'eyebrow'   => 'Our story',
			'title'     => 'Unleash your inner outlaw with our bold brew.',
			'text'      => 'In a world built on conformity, our coffee stands as a beacon for the brave. Inspired by the relentless spirit of the frontier, every batch is roasted for those who dare to carve their own path. Full-bodied, honest, and made to fuel the pursuit of greatness.',
			'cta_text'  => 'Join the ranks',
			'cta_url'   => '#',
			'flag_text' => 'Roasted & shipped from Georgia, USA',
		),
	);

	return $defaults;
}

/* -------------------------------------------------------------------------
 * Front-end getter helpers (used by tpl_home.php)
 * ---------------------------------------------------------------------- */

/**
 * Get a single homepage meta value, falling back to a default.
 *
 * @param string $key     Field key without the OCH_PREFIX.
 * @param string $default Fallback value.
 * @return string
 */
function och_field( $key, $default = '' ) {
	$val = get_post_meta( get_the_ID(), OCH_PREFIX . $key, true );
	return ( '' !== $val && null !== $val ) ? $val : $default;
}

/**
 * Decide whether a repeatable row actually holds content.
 *
 * CMB2 always persists at least one blank group row when a post is saved, and
 * select/URL sub-fields even submit their own defaults (e.g. icon = "cup"),
 * so a "blank" row is never truly empty. We therefore only look at the
 * $significant sub-fields (the real content) when judging emptiness. For a
 * plain repeatable text field the row is the value itself.
 *
 * @param mixed $row         Group row (array) or scalar value.
 * @param array $significant Sub-field keys that count as content (groups only).
 * @return bool
 */
function och_row_has_content( $row, $significant = array() ) {
	if ( ! is_array( $row ) ) {
		return '' !== trim( (string) $row );
	}

	$keys = ! empty( $significant ) ? $significant : array_keys( $row );
	foreach ( $keys as $k ) {
		if ( ! isset( $row[ $k ] ) ) {
			continue;
		}
		$v = is_array( $row[ $k ] ) ? implode( '', $row[ $k ] ) : $row[ $k ];
		if ( '' !== trim( (string) $v ) ) {
			return true;
		}
	}
	return false;
}

/**
 * Get a repeatable group / repeatable field value, falling back to defaults.
 *
 * Blank rows (CMB2's auto-persisted empty row, or rows carrying only
 * select/URL defaults) are stripped first. If nothing real remains, the Claude
 * Design defaults are returned — so the homepage keeps showing default content
 * until the editor enters their own.
 *
 * @param string $key          Field key without the OCH_PREFIX.
 * @param array  $default_rows Fallback rows.
 * @param array  $significant  Sub-field keys that determine whether a row is "filled in".
 * @return array
 */
function och_group( $key, $default_rows = array(), $significant = array() ) {
	$val = get_post_meta( get_the_ID(), OCH_PREFIX . $key, true );

	if ( ! is_array( $val ) || empty( $val ) ) {
		return $default_rows;
	}

	$filled = array();
	foreach ( $val as $row ) {
		if ( och_row_has_content( $row, $significant ) ) {
			$filled[] = $row;
		}
	}

	return ! empty( $filled ) ? array_values( $filled ) : $default_rows;
}

/**
 * Output an <img> for a given URL, or a styled placeholder when empty.
 *
 * Uses a real <img> (no CSS background) so no inline styles are required.
 *
 * @param string $url         Image URL (may be empty).
 * @param string $classes     Class attribute for the img / placeholder.
 * @param string $placeholder Placeholder label shown when no image is set.
 * @param string $alt         Image alt text.
 * @return void
 */
function och_img_markup( $url, $classes, $placeholder = '', $alt = '' ) {
	if ( $url ) {
		printf(
			'<img class="%1$s" src="%2$s" alt="%3$s" loading="lazy" decoding="async">',
			esc_attr( $classes ),
			esc_url( $url ),
			esc_attr( $alt )
		);
		return;
	}
	printf(
		'<div class="%1$s och-img-placeholder"><span>%2$s</span></div>',
		esc_attr( $classes ),
		esc_html( $placeholder )
	);
}

/**
 * Output a top-level image meta field (stored as a URL), or a placeholder.
 *
 * @param string $key         Field key without the OCH_PREFIX.
 * @param string $classes     Class attribute for the img / placeholder.
 * @param string $placeholder Placeholder label shown when no image is set.
 * @param string $alt         Image alt text.
 * @return void
 */
function och_image( $key, $classes, $placeholder = '', $alt = '' ) {
	och_img_markup( och_field( $key, '' ), $classes, $placeholder, $alt );
}

/**
 * Return an inline SVG for a value-prop icon key.
 *
 * SVG presentation attributes are used (not CSS), colour is inherited via
 * `currentColor` so styling stays in style.css.
 *
 * @param string $key Icon key.
 * @return string SVG markup.
 */
function och_icon( $key ) {
	$icons = array(
		'cup'       => '<path d="M17 8h1a4 4 0 1 1 0 8h-1"/><path d="M3 8h14v9a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4Z"/><path d="M6 2v2M10 2v2M14 2v2"/>',
		'handshake' => '<path d="m11 17 2 2a1 1 0 1 0 3-3"/><path d="m14 14 2.5 2.5a1 1 0 1 0 3-3l-3.9-3.9a3 3 0 0 0-4.2 0l-.9.9a1 1 0 1 1-3-3l2.8-2.8a5.8 5.8 0 0 1 7.1-.9l.5.3a2 2 0 0 0 1.4.2L21 4"/><path d="m21 3 1 11h-2"/><path d="M3 3 2 14l6.5 6.5a1 1 0 1 0 3-3"/><path d="M3 4h8"/>',
		'stars'     => '<path d="M12 3l1.9 4 4.1.5-3 2.9.8 4.1L12 12.6 8.2 14.5l.8-4.1-3-2.9 4.1-.5z"/>',
		'flame'     => '<path d="M8.5 14.5A2.5 2.5 0 0 0 11 12c0-1.38-.5-2-1-3-1.072-2.143-.224-4.054 2-6 .5 2.5 2 4.9 4 6.5 2 1.6 3 3.5 3 5.5a7 7 0 1 1-14 0c0-1.153.433-2.294 1-3a2.5 2.5 0 0 0 2.5 2.5z"/>',
		'leaf'      => '<path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"/><path d="M2 21c0-3 1.85-5.36 5.08-6"/>',
	);

	$key  = isset( $icons[ $key ] ) ? $key : 'cup';
	$fill = ( 'stars' === $key ) ? 'fill="currentColor" stroke="none"' : 'fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"';

	return '<svg viewBox="0 0 24 24" ' . $fill . ' aria-hidden="true" focusable="false">' . $icons[ $key ] . '</svg>';
}

/* -------------------------------------------------------------------------
 * Show-on callback — only display these boxes on the Home Template
 * ---------------------------------------------------------------------- */

/**
 * Only show the homepage metaboxes when the page uses the Home Template.
 *
 * @param CMB2 $cmb CMB2 instance.
 * @return bool
 */
function och_show_on_home_template( $cmb ) {
	$post_id = 0;

	if ( isset( $_GET['post'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification
		$post_id = (int) $_GET['post']; // phpcs:ignore WordPress.Security.NonceVerification
	} elseif ( isset( $_POST['post_ID'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification
		$post_id = (int) $_POST['post_ID']; // phpcs:ignore WordPress.Security.NonceVerification
	}

	if ( ! $post_id ) {
		return false;
	}

	return OCH_TEMPLATE === get_page_template_slug( $post_id );
}

/**
 * A small icon-choice option set reused by the value-prop group.
 *
 * @return array
 */
function och_icon_options() {
	return array(
		'cup'       => 'Coffee cup',
		'handshake' => 'Handshake',
		'stars'     => 'Star',
		'flame'     => 'Flame',
		'leaf'      => 'Leaf',
	);
}

/* -------------------------------------------------------------------------
 * Metabox registration
 * ---------------------------------------------------------------------- */

/**
 * Register the homepage CMB2 metaboxes.
 *
 * @return void
 */
function och_register_home_metaboxes() {
	$d       = och_home_defaults();
	$show_on = 'och_show_on_home_template';
	$args    = array(
		'object_types' => array( 'page' ),
		'context'      => 'normal',
		'priority'     => 'high',
		'show_on_cb'   => $show_on,
		'closed'       => true, // Collapse the metabox by default.
	);

	/* ---------------------------------- Hero ---------------------------- */
	$hero = new_cmb2_box(
		array_merge(
			$args,
			array(
				'id'   => 'och_hero_box',
				'title' => 'Homepage — Hero',
			)
		)
	);
	$hero->add_field( array( 'name' => 'Eyebrow', 'id' => OCH_PREFIX . 'hero_eyebrow', 'type' => 'text', 'default' => $d['hero']['eyebrow'] ) );
	$hero->add_field( array( 'name' => 'Title', 'id' => OCH_PREFIX . 'hero_title', 'type' => 'text', 'default' => $d['hero']['title'] ) );
	$hero->add_field( array( 'name' => 'Intro text', 'id' => OCH_PREFIX . 'hero_text', 'type' => 'textarea_small', 'default' => $d['hero']['text'] ) );
	$hero->add_field( array( 'name' => 'Primary button — label', 'id' => OCH_PREFIX . 'hero_btn1_text', 'type' => 'text', 'default' => $d['hero']['btn1_text'] ) );
	$hero->add_field( array( 'name' => 'Primary button — URL', 'id' => OCH_PREFIX . 'hero_btn1_url', 'type' => 'text_url', 'default' => $d['hero']['btn1_url'] ) );
	$hero->add_field( array( 'name' => 'Secondary button — label', 'id' => OCH_PREFIX . 'hero_btn2_text', 'type' => 'text', 'default' => $d['hero']['btn2_text'] ) );
	$hero->add_field( array( 'name' => 'Secondary button — URL', 'id' => OCH_PREFIX . 'hero_btn2_url', 'type' => 'text_url', 'default' => $d['hero']['btn2_url'] ) );
	$hero->add_field( array( 'name' => 'Rating line', 'id' => OCH_PREFIX . 'hero_rating', 'type' => 'text', 'default' => $d['hero']['rating'] ) );
	$hero->add_field( array( 'name' => 'Image badge', 'id' => OCH_PREFIX . 'hero_badge', 'type' => 'text', 'default' => $d['hero']['badge'] ) );
	$hero->add_field( array( 'name' => 'Hero image', 'id' => OCH_PREFIX . 'hero_image', 'type' => 'file', 'options' => array( 'url' => false ), 'query_args' => array( 'type' => 'image' ) ) );

	/* ------------------------------ Value props ------------------------ */
	$vp = new_cmb2_box(
		array_merge(
			$args,
			array(
				'id'    => 'och_valueprops_box',
				'title' => 'Homepage — Value Props',
			)
		)
	);
	$vp_group = $vp->add_field(
		array(
			'id'         => OCH_PREFIX . 'value_props',
			'type'       => 'group',
			'options'    => array(
				'group_title'   => 'Value Prop {#}',
				'add_button'    => 'Add value prop',
				'remove_button' => 'Remove value prop',
				'sortable'      => true,
				'closed'        => true, // Collapse each repeatable row by default.
			),
		)
	);
	$vp->add_group_field( $vp_group, array( 'name' => 'Icon', 'id' => 'icon', 'type' => 'select', 'options' => och_icon_options(), 'default' => 'cup' ) );
	$vp->add_group_field( $vp_group, array( 'name' => 'Title', 'id' => 'title', 'type' => 'text' ) );
	$vp->add_group_field( $vp_group, array( 'name' => 'Text', 'id' => 'text', 'type' => 'textarea_small' ) );

	/* ------------------------------- Shop grid ------------------------- */
	$shop = new_cmb2_box(
		array_merge(
			$args,
			array(
				'id'    => 'och_shop_box',
				'title' => 'Homepage — Shop the Roasts',
			)
		)
	);
	$shop->add_field( array( 'name' => 'Eyebrow', 'id' => OCH_PREFIX . 'shop_eyebrow', 'type' => 'text', 'default' => $d['shop']['eyebrow'] ) );
	$shop->add_field( array( 'name' => 'Title', 'id' => OCH_PREFIX . 'shop_title', 'type' => 'text', 'default' => $d['shop']['title'] ) );
	// The grid itself is driven by the WooCommerce [featured_products] shortcode
	// in tpl_home.php — mark products as Featured in WooCommerce to control it.

	/* ------------------------------ Featured --------------------------- */
	$feat = new_cmb2_box(
		array_merge(
			$args,
			array(
				'id'    => 'och_featured_box',
				'title' => 'Homepage — Featured Blend',
			)
		)
	);
	$feat->add_field( array( 'name' => 'Eyebrow', 'id' => OCH_PREFIX . 'feat_eyebrow', 'type' => 'text', 'default' => $d['featured']['eyebrow'] ) );
	$feat->add_field( array( 'name' => 'Title', 'id' => OCH_PREFIX . 'feat_title', 'type' => 'text', 'default' => $d['featured']['title'] ) );
	$feat->add_field( array( 'name' => 'Text', 'id' => OCH_PREFIX . 'feat_text', 'type' => 'textarea_small', 'default' => $d['featured']['text'] ) );
	$feat->add_field( array( 'name' => 'Featured image', 'id' => OCH_PREFIX . 'feat_image', 'type' => 'file', 'options' => array( 'url' => false ), 'query_args' => array( 'type' => 'image' ) ) );
	$feat_group = $feat->add_field(
		array(
			'id'      => OCH_PREFIX . 'feat_specs',
			'type'    => 'group',
			'options' => array(
				'group_title'   => 'Spec {#}',
				'add_button'    => 'Add spec',
				'remove_button' => 'Remove spec',
				'sortable'      => true,
				'closed'        => true, // Collapse each repeatable row by default.
			),
		)
	);
	$feat->add_group_field( $feat_group, array( 'name' => 'Label', 'id' => 'label', 'type' => 'text' ) );
	$feat->add_group_field( $feat_group, array( 'name' => 'Value', 'id' => 'value', 'type' => 'text' ) );
	$feat->add_field( array( 'name' => 'CTA — label', 'id' => OCH_PREFIX . 'feat_cta_text', 'type' => 'text', 'default' => $d['featured']['cta_text'] ) );
	$feat->add_field( array( 'name' => 'CTA — URL', 'id' => OCH_PREFIX . 'feat_cta_url', 'type' => 'text_url', 'default' => $d['featured']['cta_url'] ) );
	$feat->add_field( array( 'name' => 'CTA note', 'id' => OCH_PREFIX . 'feat_note', 'type' => 'text', 'default' => $d['featured']['note'] ) );

	/* ------------------------------- Story ----------------------------- */
	$story = new_cmb2_box(
		array_merge(
			$args,
			array(
				'id'    => 'och_story_box',
				'title' => 'Homepage — Brand Story',
			)
		)
	);
	$story->add_field( array( 'name' => 'Eyebrow', 'id' => OCH_PREFIX . 'story_eyebrow', 'type' => 'text', 'default' => $d['story']['eyebrow'] ) );
	$story->add_field( array( 'name' => 'Title', 'id' => OCH_PREFIX . 'story_title', 'type' => 'text', 'default' => $d['story']['title'] ) );
	$story->add_field( array( 'name' => 'Text', 'id' => OCH_PREFIX . 'story_text', 'type' => 'textarea', 'default' => $d['story']['text'] ) );
	$story->add_field( array( 'name' => 'CTA — label', 'id' => OCH_PREFIX . 'story_cta_text', 'type' => 'text', 'default' => $d['story']['cta_text'] ) );
	$story->add_field( array( 'name' => 'CTA — URL', 'id' => OCH_PREFIX . 'story_cta_url', 'type' => 'text_url', 'default' => $d['story']['cta_url'] ) );
	$story->add_field( array( 'name' => 'Flag line', 'id' => OCH_PREFIX . 'story_flag_text', 'type' => 'text', 'default' => $d['story']['flag_text'] ) );
	$story->add_field( array( 'name' => 'Story image', 'id' => OCH_PREFIX . 'story_image', 'type' => 'file', 'options' => array( 'url' => false ), 'query_args' => array( 'type' => 'image' ) ) );
}
add_action( 'cmb2_admin_init', 'och_register_home_metaboxes' );
