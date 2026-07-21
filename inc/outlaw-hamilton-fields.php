<?php
/**
 * Outlaw Coffee — Hamilton Mill landing page CMB2 fields.
 *
 * Registers the CMB2 metaboxes that power the Hamilton Mill Landing template
 * (tpl_hamilton-mill.php) and supplies the defaults used as the front-end
 * fallback. Reuses the generic render helpers defined in
 * inc/outlaw-home-fields.php (och_field, och_group, och_image, och_icon, …),
 * so this file only declares its own defaults + metaboxes.
 *
 * @package pegasus-child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** Template slug the Hamilton Mill boxes are attached to. */
define( 'OCH_HM_TEMPLATE', 'tpl_hamilton-mill.php' );

/* -------------------------------------------------------------------------
 * Default content (single source of truth for admin + front-end fallback)
 * ---------------------------------------------------------------------- */

/**
 * Default Hamilton Mill landing content. Mirrors the copy the template shipped
 * with; every field falls back to these until edited in the page editor.
 *
 * @return array
 */
function och_hamilton_defaults() {
	static $defaults = null;
	if ( null !== $defaults ) {
		return $defaults;
	}

	$defaults = array(
		'hero' => array(
			'eyebrow'   => 'Hamilton Mill Neighbors',
			'title'     => 'Great coffee, delivered to your door for $1.50',
			'text'      => 'Welcome, Hamilton Mill! Shop our full lineup of fresh-roasted coffee online, and choose <strong>flat $1.50 neighborhood delivery</strong> at checkout — one low fee, no matter how much you buy. Prefer shipping? That&rsquo;s still an option too. The choice is yours.',
			'btn1_text' => 'Sign up for delivery',
			'btn1_url'  => '#hm-signup',
			'btn2_text' => 'Shop coffee',
			'btn2_url'  => '/online-shop/',
			'note'      => 'Flat $1.50 delivery for verified Hamilton Mill residents',
		),

		'steps' => array(
			array(
				'icon'  => 'handshake',
				'title' => '1. Create your account',
				'text'  => 'Sign up right here (or on our regular registration page). It takes a minute and lets us know a Hamilton Mill neighbor wants in.',
			),
			array(
				'icon'  => 'leaf',
				'title' => '2. We confirm your address',
				'text'  => 'We quickly verify you live in Hamilton Mill, then flip on your neighborhood delivery perk. You will get an email once you are approved.',
			),
			array(
				'icon'  => 'cup',
				'title' => '3. Get $1.50 delivery',
				'text'  => 'At checkout you will see a flat $1.50 Local Delivery option — no matter how much you order — right alongside the usual paid shipping choices.',
			),
		),

		'steps_heading' => array(
			'eyebrow' => 'How it works',
			'title'   => 'Three steps to $1.50 delivery',
		),

		'signup' => array(
			'eyebrow' => 'Get started',
			'title'   => 'Sign up for Hamilton Mill delivery',
			'text'    => 'Create your account below. Once we confirm you live in Hamilton Mill, we&rsquo;ll turn on your flat $1.50 delivery — you&rsquo;ll see it as a shipping choice every time you check out.',
			'form_id' => '36',
		),

		'shop' => array(
			'eyebrow'  => 'While you&rsquo;re here',
			'title'    => 'Start with a fan favorite',
			'btn_text' => 'Shop all coffee',
			'btn_url'  => '/online-shop/',
		),
	);

	return $defaults;
}

/* -------------------------------------------------------------------------
 * Show-on callback — only display these boxes on the Hamilton Mill template
 * ---------------------------------------------------------------------- */

/**
 * Only show the Hamilton Mill metaboxes when the page uses that template.
 *
 * @param CMB2 $cmb CMB2 instance.
 * @return bool
 */
function och_show_on_hamilton_template( $cmb ) {
	$post_id = 0;

	if ( isset( $_GET['post'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification
		$post_id = (int) $_GET['post']; // phpcs:ignore WordPress.Security.NonceVerification
	} elseif ( isset( $_POST['post_ID'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification
		$post_id = (int) $_POST['post_ID']; // phpcs:ignore WordPress.Security.NonceVerification
	}

	if ( ! $post_id ) {
		return false;
	}

	return OCH_HM_TEMPLATE === get_page_template_slug( $post_id );
}

/* -------------------------------------------------------------------------
 * Metabox registration
 * ---------------------------------------------------------------------- */

/**
 * Register the Hamilton Mill landing metaboxes.
 *
 * @return void
 */
function och_register_hamilton_metaboxes() {
	$d    = och_hamilton_defaults();
	$args = array(
		'object_types' => array( 'page' ),
		'context'      => 'normal',
		'priority'     => 'high',
		'show_on_cb'   => 'och_show_on_hamilton_template',
		'closed'       => true,
	);

	/* ---------------------------------- Hero ---------------------------- */
	$hero = new_cmb2_box( array_merge( $args, array( 'id' => 'och_hm_hero_box', 'title' => 'Hamilton Mill — Hero' ) ) );
	$hero->add_field( array( 'name' => 'Eyebrow', 'id' => OCH_PREFIX . 'hm_hero_eyebrow', 'type' => 'text', 'default' => $d['hero']['eyebrow'] ) );
	$hero->add_field( array( 'name' => 'Title', 'id' => OCH_PREFIX . 'hm_hero_title', 'type' => 'text', 'default' => $d['hero']['title'] ) );
	$hero->add_field( array( 'name' => 'Intro text', 'desc' => 'Basic HTML allowed (e.g. &lt;strong&gt;).', 'id' => OCH_PREFIX . 'hm_hero_text', 'type' => 'textarea_small', 'default' => $d['hero']['text'] ) );
	$hero->add_field( array( 'name' => 'Primary button — label', 'id' => OCH_PREFIX . 'hm_hero_btn1_text', 'type' => 'text', 'default' => $d['hero']['btn1_text'] ) );
	$hero->add_field( array( 'name' => 'Primary button — URL', 'desc' => 'Use #hm-signup to jump to the signup form on this page.', 'id' => OCH_PREFIX . 'hm_hero_btn1_url', 'type' => 'text_url', 'default' => $d['hero']['btn1_url'] ) );
	$hero->add_field( array( 'name' => 'Secondary button — label', 'id' => OCH_PREFIX . 'hm_hero_btn2_text', 'type' => 'text', 'default' => $d['hero']['btn2_text'] ) );
	$hero->add_field( array( 'name' => 'Secondary button — URL', 'id' => OCH_PREFIX . 'hm_hero_btn2_url', 'type' => 'text_url', 'default' => $d['hero']['btn2_url'] ) );
	$hero->add_field( array( 'name' => 'Badge / note line', 'id' => OCH_PREFIX . 'hm_hero_note', 'type' => 'text', 'default' => $d['hero']['note'] ) );
	$hero->add_field( array( 'name' => 'Hero image', 'id' => OCH_PREFIX . 'hm_hero_image', 'type' => 'file', 'options' => array( 'url' => false ), 'query_args' => array( 'type' => 'image' ) ) );

	/* ------------------------------ How it works ----------------------- */
	$how = new_cmb2_box( array_merge( $args, array( 'id' => 'och_hm_steps_box', 'title' => 'Hamilton Mill — How It Works' ) ) );
	$how->add_field( array( 'name' => 'Eyebrow', 'id' => OCH_PREFIX . 'hm_steps_eyebrow', 'type' => 'text', 'default' => $d['steps_heading']['eyebrow'] ) );
	$how->add_field( array( 'name' => 'Heading', 'id' => OCH_PREFIX . 'hm_steps_title', 'type' => 'text', 'default' => $d['steps_heading']['title'] ) );
	$steps_group = $how->add_field(
		array(
			'id'      => OCH_PREFIX . 'hm_steps',
			'type'    => 'group',
			'options' => array(
				'group_title'   => 'Step {#}',
				'add_button'    => 'Add step',
				'remove_button' => 'Remove step',
				'sortable'      => true,
				'closed'        => true,
			),
		)
	);
	$how->add_group_field( $steps_group, array( 'name' => 'Icon', 'id' => 'icon', 'type' => 'select', 'options' => och_icon_options(), 'default' => 'cup' ) );
	$how->add_group_field( $steps_group, array( 'name' => 'Title', 'id' => 'title', 'type' => 'text' ) );
	$how->add_group_field( $steps_group, array( 'name' => 'Text', 'id' => 'text', 'type' => 'textarea_small' ) );

	/* -------------------------------- Signup --------------------------- */
	$signup = new_cmb2_box( array_merge( $args, array( 'id' => 'och_hm_signup_box', 'title' => 'Hamilton Mill — Signup' ) ) );
	$signup->add_field( array( 'name' => 'Eyebrow', 'id' => OCH_PREFIX . 'hm_signup_eyebrow', 'type' => 'text', 'default' => $d['signup']['eyebrow'] ) );
	$signup->add_field( array( 'name' => 'Title', 'id' => OCH_PREFIX . 'hm_signup_title', 'type' => 'text', 'default' => $d['signup']['title'] ) );
	$signup->add_field( array( 'name' => 'Intro text', 'id' => OCH_PREFIX . 'hm_signup_text', 'type' => 'textarea_small', 'default' => $d['signup']['text'] ) );
	$signup->add_field( array( 'name' => 'WPForms form ID', 'desc' => 'The registration form to embed (default 36).', 'id' => OCH_PREFIX . 'hm_signup_form_id', 'type' => 'text_small', 'default' => $d['signup']['form_id'] ) );

	/* --------------------------------- Shop ---------------------------- */
	$shop = new_cmb2_box( array_merge( $args, array( 'id' => 'och_hm_shop_box', 'title' => 'Hamilton Mill — Shop Row' ) ) );
	$shop->add_field( array( 'name' => 'Eyebrow', 'id' => OCH_PREFIX . 'hm_shop_eyebrow', 'type' => 'text', 'default' => $d['shop']['eyebrow'] ) );
	$shop->add_field( array( 'name' => 'Title', 'id' => OCH_PREFIX . 'hm_shop_title', 'type' => 'text', 'default' => $d['shop']['title'] ) );
	$shop->add_field( array( 'name' => 'Button — label', 'id' => OCH_PREFIX . 'hm_shop_btn_text', 'type' => 'text', 'default' => $d['shop']['btn_text'] ) );
	$shop->add_field( array( 'name' => 'Button — URL', 'id' => OCH_PREFIX . 'hm_shop_btn_url', 'type' => 'text_url', 'default' => $d['shop']['btn_url'] ) );
	// The product grid itself is the WooCommerce [featured_products] shortcode —
	// mark products as Featured in WooCommerce to control which appear.
}
add_action( 'cmb2_admin_init', 'och_register_hamilton_metaboxes' );
