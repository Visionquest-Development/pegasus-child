<?php
/**
 * CMB2 fields + defaults for the Home template ( tpl_home.php ).
 *
 * Included from the child theme functions.php. CMB2 itself is bundled with,
 * and loaded by, the Pegasus parent theme.
 *
 * Every section on the home page reads its content through the helpers at the
 * bottom of this file. When a field / repeatable row is left empty the template
 * falls back to the Claude Design defaults defined in rcd_home_defaults(), so
 * the front end shows the finished design out of the box and each row is
 * replaced only once real content is saved into it.
 *
 * @package Pegasus_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* ============================================================================
 * DEFAULTS  ( single source of truth, shared by the admin + the template )
 * ========================================================================== */
if ( ! function_exists( 'rcd_home_defaults' ) ) {
	/**
	 * All Claude Design default content for the home page.
	 *
	 * @return array
	 */
	function rcd_home_defaults() {
		return array(

			// Hero.
			'hero_layout'      => 'split', // split | centered | fullbleed.
			'hero_watermark'   => 'off',
			'hero_eyebrow'     => 'Interior Design Studio',
			'hero_heading'     => 'Historic craftsmanship,<br>modern <em>elegance</em>.',
			'hero_text'        => 'We curate interiors and breathe new life into structural furniture — sourced, restored, and reimagined for the way you live.',
			'hero_btn1_text'   => 'Explore Services',
			'hero_btn1_link'   => '#services',
			'hero_btn2_text'   => 'Shop Furniture',
			'hero_btn2_link'   => '#furniture',
			'hero_stat_number' => '15+',
			'hero_stat_text'   => 'years sourcing &amp; restoring pieces with a story',
			'hero_image'       => '',

			// Brand statement.
			'brand_statement'  => "At Rene Catherine Design, we don't just design interiors — we curate experiences and breathe new life into spaces and structures. True luxury lies in the details.",

			// Services.
			'services_eyebrow' => 'What We Do',
			'services_heading' => 'Three ways we work',
			'services_link_text' => 'All services',
			'services_link_url'  => '#services',
			'services'         => array(
				array(
					'n'     => '01',
					'tag'   => 'Interiors & Styling',
					'title' => 'Bespoke Curation',
					'desc'  => 'Tailored interior transformations and single-room styling — composed around how you actually live.',
					'link'  => '#',
				),
				array(
					'n'     => '02',
					'tag'   => 'Furniture & Revivals',
					'title' => 'Restoration & Sourcing',
					'desc'  => 'Reclaimed, high-end furniture and architectural revivals, given a second life with patient hands.',
					'link'  => '#',
				),
				array(
					'n'     => '03',
					'tag'   => '3D & Sourcing',
					'title' => 'Immersive Technical Design',
					'desc'  => 'Premium 3D modeling and dynamic sourcing breakdowns — see the room before a single piece moves.',
					'link'  => '#',
				),
			),

			// Approach.
			'approach_eyebrow' => 'Our Approach',
			'approach_heading' => 'Source.<br>Restore.<br><em>Reimagine.</em>',
			'approach_text'    => 'A patient, detail-led process — equal parts treasure hunt and atelier. Every room and every piece earns its place.',
			'values'           => array(
				array(
					'num'   => '01',
					'title' => 'We Source',
					'desc'  => 'We hunt for character — provenance, materials, and pieces with a story worth keeping.',
				),
				array(
					'num'   => '02',
					'title' => 'We Restore',
					'desc'  => 'We bring craftsmanship back to life, honoring the original maker while meeting modern standards.',
				),
				array(
					'num'   => '03',
					'title' => 'We Reimagine',
					'desc'  => 'We compose rooms and pieces into something layered, collected, and unmistakably yours.',
				),
			),

			// Featured gallery.
			'gallery_eyebrow'  => 'Selected Work',
			'gallery_heading'  => 'A portfolio in progress',
			'gallery'          => array(
				array( 'caption' => 'Full-Home Transformation' ),
				array( 'caption' => 'Single-Room Styling' ),
				array( 'caption' => 'Restored Sideboard' ),
				array( 'caption' => '3D Spatial Model' ),
				array( 'caption' => 'Sourced Lighting' ),
			),

			// Furniture band.
			'furn_eyebrow'     => 'Reclaimed &amp; Reimagined',
			'furn_heading'     => 'Furniture with<br>a second story.',
			'furn_text'        => 'We rescue and restore high-end, structural pieces — then reimagine them for a new home. Each one is one-of-a-kind.',
			'furn_note'        => 'Available for local pickup · Inquire to purchase',
			'furn_btn_text'    => 'Browse the collection',
			'furn_btn_link'    => '#furniture',
			'furn_images'      => array(
				array( 'size' => 'a' ),
				array( 'size' => 'b' ),
			),

			// Testimonial.
			'testimonials'     => array(
				array(
					'quote'       => 'Rene has an eye for the pieces no one else sees — and the patience to bring them all the way back. Our home finally feels like us.',
					'attribution' => 'A Recent Client · Atlanta',
				),
			),

			// CTA.
			'cta_eyebrow'      => 'Now Booking',
			'cta_heading'      => 'Begin your <em>commission</em>.',
			'cta_text'         => 'Our studio is accepting select projects — interiors, restorations, and immersive technical design. Tell us about your space.',
			'cta_btn_text'     => 'Start the conversation',
			'cta_btn_link'     => 'mailto:hello@renecatherinedesigns.com',
		);
	}
}

/* ============================================================================
 * METABOX REGISTRATION
 * ========================================================================== */
add_action( 'cmb2_admin_init', 'rcd_home_register_metaboxes' );
/**
 * Register the home-page metaboxes. Every box is collapsed by default and only
 * displays on pages using the tpl_home.php template.
 */
function rcd_home_register_metaboxes() {

	if ( ! function_exists( 'new_cmb2_box' ) ) {
		return;
	}

	$prefix = 'rcd_home_';
	$d      = rcd_home_defaults();

	$box_args = array(
		'object_types' => array( 'page' ),
		'context'      => 'normal',
		'priority'     => 'high',
		'closed'       => true, // Metabox collapsed by default.
		'show_on_cb'   => 'rcd_home_show_for_template',
	);

	// Shared options for repeatable groups ( collapsed rows by default ).
	$group_opts = array(
		'closed'     => true,
		'sortable'   => true,
	);

	/* ---------------------------------------------------------------------
	 * HERO
	 * ------------------------------------------------------------------- */
	$hero = new_cmb2_box( array_merge( $box_args, array(
		'id'    => $prefix . 'hero_box',
		'title' => __( 'Home — Hero', 'pegasus-child' ),
	) ) );
	$hero->add_field( array(
		'name'    => __( 'Hero layout', 'pegasus-child' ),
		'id'      => $prefix . 'hero_layout',
		'type'    => 'select',
		'default' => $d['hero_layout'],
		'options' => array(
			'split'     => __( 'Split ( image right )', 'pegasus-child' ),
			'centered'  => __( 'Centered', 'pegasus-child' ),
			'fullbleed' => __( 'Full bleed', 'pegasus-child' ),
		),
	) );
	$hero->add_field( array(
		'name'    => __( 'RC watermark behind hero', 'pegasus-child' ),
		'id'      => $prefix . 'hero_watermark',
		'type'    => 'checkbox',
	) );
	$hero->add_field( array(
		'name'    => __( 'Eyebrow', 'pegasus-child' ),
		'id'      => $prefix . 'hero_eyebrow',
		'type'    => 'text',
		'default' => $d['hero_eyebrow'],
	) );
	$hero->add_field( array(
		'name'    => __( 'Heading', 'pegasus-child' ),
		'desc'    => __( 'Basic HTML allowed: &lt;br&gt; for line breaks, &lt;em&gt; for the gold italic accent.', 'pegasus-child' ),
		'id'      => $prefix . 'hero_heading',
		'type'    => 'textarea_small',
		'default' => $d['hero_heading'],
	) );
	$hero->add_field( array(
		'name'    => __( 'Intro text', 'pegasus-child' ),
		'id'      => $prefix . 'hero_text',
		'type'    => 'textarea_small',
		'default' => $d['hero_text'],
	) );
	$hero->add_field( array(
		'name'         => __( 'Hero image', 'pegasus-child' ),
		'id'           => $prefix . 'hero_image',
		'type'         => 'file',
		'options'      => array( 'url' => false ),
		'query_args'   => array( 'type' => 'image' ),
		'preview_size' => 'medium',
	) );
	$hero->add_field( array(
		'name'    => __( 'Primary button — text', 'pegasus-child' ),
		'id'      => $prefix . 'hero_btn1_text',
		'type'    => 'text',
		'default' => $d['hero_btn1_text'],
	) );
	$hero->add_field( array(
		'name'    => __( 'Primary button — link', 'pegasus-child' ),
		'id'      => $prefix . 'hero_btn1_link',
		'type'    => 'text',
		'default' => $d['hero_btn1_link'],
	) );
	$hero->add_field( array(
		'name'    => __( 'Secondary button — text', 'pegasus-child' ),
		'id'      => $prefix . 'hero_btn2_text',
		'type'    => 'text',
		'default' => $d['hero_btn2_text'],
	) );
	$hero->add_field( array(
		'name'    => __( 'Secondary button — link', 'pegasus-child' ),
		'id'      => $prefix . 'hero_btn2_link',
		'type'    => 'text',
		'default' => $d['hero_btn2_link'],
	) );
	$hero->add_field( array(
		'name'    => __( 'Stat — number', 'pegasus-child' ),
		'id'      => $prefix . 'hero_stat_number',
		'type'    => 'text_small',
		'default' => $d['hero_stat_number'],
	) );
	$hero->add_field( array(
		'name'    => __( 'Stat — caption', 'pegasus-child' ),
		'id'      => $prefix . 'hero_stat_text',
		'type'    => 'text',
		'default' => $d['hero_stat_text'],
	) );

	/* ---------------------------------------------------------------------
	 * BRAND STATEMENT
	 * ------------------------------------------------------------------- */
	$brand = new_cmb2_box( array_merge( $box_args, array(
		'id'    => $prefix . 'brand_box',
		'title' => __( 'Home — Brand Statement', 'pegasus-child' ),
	) ) );
	$brand->add_field( array(
		'name'    => __( 'Statement', 'pegasus-child' ),
		'id'      => $prefix . 'brand_statement',
		'type'    => 'textarea',
		'default' => $d['brand_statement'],
	) );

	/* ---------------------------------------------------------------------
	 * SERVICES
	 * ------------------------------------------------------------------- */
	$services = new_cmb2_box( array_merge( $box_args, array(
		'id'    => $prefix . 'services_box',
		'title' => __( 'Home — Services', 'pegasus-child' ),
	) ) );
	$services->add_field( array(
		'name'    => __( 'Eyebrow', 'pegasus-child' ),
		'id'      => $prefix . 'services_eyebrow',
		'type'    => 'text',
		'default' => $d['services_eyebrow'],
	) );
	$services->add_field( array(
		'name'    => __( 'Heading', 'pegasus-child' ),
		'id'      => $prefix . 'services_heading',
		'type'    => 'text',
		'default' => $d['services_heading'],
	) );
	$services->add_field( array(
		'name'    => __( 'Top link — text', 'pegasus-child' ),
		'id'      => $prefix . 'services_link_text',
		'type'    => 'text',
		'default' => $d['services_link_text'],
	) );
	$services->add_field( array(
		'name'    => __( 'Top link — url', 'pegasus-child' ),
		'id'      => $prefix . 'services_link_url',
		'type'    => 'text',
		'default' => $d['services_link_url'],
	) );
	$svc_group = $services->add_field( array(
		'id'      => $prefix . 'services',
		'type'    => 'group',
		'options' => array_merge( $group_opts, array(
			'group_title'   => __( 'Service {#}', 'pegasus-child' ),
			'add_button'    => __( 'Add Service', 'pegasus-child' ),
			'remove_button' => __( 'Remove Service', 'pegasus-child' ),
		) ),
	) );
	$services->add_group_field( $svc_group, array(
		'name'         => __( 'Image', 'pegasus-child' ),
		'id'           => 'image',
		'type'         => 'file',
		'options'      => array( 'url' => false ),
		'query_args'   => array( 'type' => 'image' ),
		'preview_size' => 'medium',
	) );
	$services->add_group_field( $svc_group, array(
		'name' => __( 'Number', 'pegasus-child' ),
		'id'   => 'n',
		'type' => 'text_small',
	) );
	$services->add_group_field( $svc_group, array(
		'name' => __( 'Tag', 'pegasus-child' ),
		'id'   => 'tag',
		'type' => 'text',
	) );
	$services->add_group_field( $svc_group, array(
		'name' => __( 'Title', 'pegasus-child' ),
		'id'   => 'title',
		'type' => 'text',
	) );
	$services->add_group_field( $svc_group, array(
		'name' => __( 'Description', 'pegasus-child' ),
		'id'   => 'desc',
		'type' => 'textarea_small',
	) );
	$services->add_group_field( $svc_group, array(
		'name' => __( 'Learn-more link', 'pegasus-child' ),
		'id'   => 'link',
		'type' => 'text',
	) );

	/* ---------------------------------------------------------------------
	 * APPROACH
	 * ------------------------------------------------------------------- */
	$approach = new_cmb2_box( array_merge( $box_args, array(
		'id'    => $prefix . 'approach_box',
		'title' => __( 'Home — Approach', 'pegasus-child' ),
	) ) );
	$approach->add_field( array(
		'name'    => __( 'Eyebrow', 'pegasus-child' ),
		'id'      => $prefix . 'approach_eyebrow',
		'type'    => 'text',
		'default' => $d['approach_eyebrow'],
	) );
	$approach->add_field( array(
		'name'    => __( 'Heading', 'pegasus-child' ),
		'desc'    => __( 'Basic HTML allowed ( &lt;br&gt;, &lt;em&gt; ).', 'pegasus-child' ),
		'id'      => $prefix . 'approach_heading',
		'type'    => 'textarea_small',
		'default' => $d['approach_heading'],
	) );
	$approach->add_field( array(
		'name'    => __( 'Intro text', 'pegasus-child' ),
		'id'      => $prefix . 'approach_text',
		'type'    => 'textarea_small',
		'default' => $d['approach_text'],
	) );
	$val_group = $approach->add_field( array(
		'id'      => $prefix . 'values',
		'type'    => 'group',
		'options' => array_merge( $group_opts, array(
			'group_title'   => __( 'Value {#}', 'pegasus-child' ),
			'add_button'    => __( 'Add Value', 'pegasus-child' ),
			'remove_button' => __( 'Remove Value', 'pegasus-child' ),
		) ),
	) );
	$approach->add_group_field( $val_group, array(
		'name' => __( 'Number', 'pegasus-child' ),
		'id'   => 'num',
		'type' => 'text_small',
	) );
	$approach->add_group_field( $val_group, array(
		'name' => __( 'Title', 'pegasus-child' ),
		'id'   => 'title',
		'type' => 'text',
	) );
	$approach->add_group_field( $val_group, array(
		'name' => __( 'Description', 'pegasus-child' ),
		'id'   => 'desc',
		'type' => 'textarea_small',
	) );

	/* ---------------------------------------------------------------------
	 * FEATURED GALLERY
	 * ------------------------------------------------------------------- */
	$gallery = new_cmb2_box( array_merge( $box_args, array(
		'id'    => $prefix . 'gallery_box',
		'title' => __( 'Home — Featured Gallery', 'pegasus-child' ),
	) ) );
	$gallery->add_field( array(
		'name'    => __( 'Eyebrow', 'pegasus-child' ),
		'id'      => $prefix . 'gallery_eyebrow',
		'type'    => 'text',
		'default' => $d['gallery_eyebrow'],
	) );
	$gallery->add_field( array(
		'name'    => __( 'Heading', 'pegasus-child' ),
		'id'      => $prefix . 'gallery_heading',
		'type'    => 'text',
		'default' => $d['gallery_heading'],
	) );
	$gal_group = $gallery->add_field( array(
		'id'      => $prefix . 'gallery',
		'type'    => 'group',
		'options' => array_merge( $group_opts, array(
			'group_title'   => __( 'Item {#}', 'pegasus-child' ),
			'add_button'    => __( 'Add Gallery Item', 'pegasus-child' ),
			'remove_button' => __( 'Remove Gallery Item', 'pegasus-child' ),
		) ),
	) );
	$gallery->add_group_field( $gal_group, array(
		'name'         => __( 'Image', 'pegasus-child' ),
		'id'           => 'image',
		'type'         => 'file',
		'options'      => array( 'url' => false ),
		'query_args'   => array( 'type' => 'image' ),
		'preview_size' => 'medium',
	) );
	$gallery->add_group_field( $gal_group, array(
		'name' => __( 'Caption', 'pegasus-child' ),
		'id'   => 'caption',
		'type' => 'text',
	) );

	/* ---------------------------------------------------------------------
	 * FURNITURE BAND
	 * ------------------------------------------------------------------- */
	$furn = new_cmb2_box( array_merge( $box_args, array(
		'id'    => $prefix . 'furniture_box',
		'title' => __( 'Home — Furniture Band', 'pegasus-child' ),
	) ) );
	$furn->add_field( array(
		'name'    => __( 'Eyebrow', 'pegasus-child' ),
		'id'      => $prefix . 'furn_eyebrow',
		'type'    => 'text',
		'default' => $d['furn_eyebrow'],
	) );
	$furn->add_field( array(
		'name'    => __( 'Heading', 'pegasus-child' ),
		'desc'    => __( 'Basic HTML allowed ( &lt;br&gt;, &lt;em&gt; ).', 'pegasus-child' ),
		'id'      => $prefix . 'furn_heading',
		'type'    => 'textarea_small',
		'default' => $d['furn_heading'],
	) );
	$furn->add_field( array(
		'name'    => __( 'Body text', 'pegasus-child' ),
		'id'      => $prefix . 'furn_text',
		'type'    => 'textarea_small',
		'default' => $d['furn_text'],
	) );
	$furn->add_field( array(
		'name'    => __( 'Note ( gold )', 'pegasus-child' ),
		'id'      => $prefix . 'furn_note',
		'type'    => 'text',
		'default' => $d['furn_note'],
	) );
	$furn->add_field( array(
		'name'    => __( 'Button — text', 'pegasus-child' ),
		'id'      => $prefix . 'furn_btn_text',
		'type'    => 'text',
		'default' => $d['furn_btn_text'],
	) );
	$furn->add_field( array(
		'name'    => __( 'Button — link', 'pegasus-child' ),
		'id'      => $prefix . 'furn_btn_link',
		'type'    => 'text',
		'default' => $d['furn_btn_link'],
	) );
	$furn_group = $furn->add_field( array(
		'id'      => $prefix . 'furn_images',
		'type'    => 'group',
		'options' => array_merge( $group_opts, array(
			'group_title'   => __( 'Image {#}', 'pegasus-child' ),
			'add_button'    => __( 'Add Image', 'pegasus-child' ),
			'remove_button' => __( 'Remove Image', 'pegasus-child' ),
		) ),
	) );
	$furn->add_group_field( $furn_group, array(
		'name'         => __( 'Image', 'pegasus-child' ),
		'id'           => 'image',
		'type'         => 'file',
		'options'      => array( 'url' => false ),
		'query_args'   => array( 'type' => 'image' ),
		'preview_size' => 'medium',
	) );

	/* ---------------------------------------------------------------------
	 * TESTIMONIAL
	 * ------------------------------------------------------------------- */
	$testi = new_cmb2_box( array_merge( $box_args, array(
		'id'    => $prefix . 'testimonial_box',
		'title' => __( 'Home — Testimonial', 'pegasus-child' ),
	) ) );
	$testi_group = $testi->add_field( array(
		'id'      => $prefix . 'testimonials',
		'type'    => 'group',
		'options' => array_merge( $group_opts, array(
			'group_title'   => __( 'Testimonial {#}', 'pegasus-child' ),
			'add_button'    => __( 'Add Testimonial', 'pegasus-child' ),
			'remove_button' => __( 'Remove Testimonial', 'pegasus-child' ),
		) ),
	) );
	$testi->add_group_field( $testi_group, array(
		'name' => __( 'Quote', 'pegasus-child' ),
		'id'   => 'quote',
		'type' => 'textarea_small',
	) );
	$testi->add_group_field( $testi_group, array(
		'name' => __( 'Attribution', 'pegasus-child' ),
		'id'   => 'attribution',
		'type' => 'text',
	) );

	/* ---------------------------------------------------------------------
	 * CTA
	 * ------------------------------------------------------------------- */
	$cta = new_cmb2_box( array_merge( $box_args, array(
		'id'    => $prefix . 'cta_box',
		'title' => __( 'Home — Call To Action', 'pegasus-child' ),
	) ) );
	$cta->add_field( array(
		'name'    => __( 'Eyebrow', 'pegasus-child' ),
		'id'      => $prefix . 'cta_eyebrow',
		'type'    => 'text',
		'default' => $d['cta_eyebrow'],
	) );
	$cta->add_field( array(
		'name'    => __( 'Heading', 'pegasus-child' ),
		'desc'    => __( 'Basic HTML allowed ( &lt;br&gt;, &lt;em&gt; ).', 'pegasus-child' ),
		'id'      => $prefix . 'cta_heading',
		'type'    => 'textarea_small',
		'default' => $d['cta_heading'],
	) );
	$cta->add_field( array(
		'name'    => __( 'Body text', 'pegasus-child' ),
		'id'      => $prefix . 'cta_text',
		'type'    => 'textarea_small',
		'default' => $d['cta_text'],
	) );
	$cta->add_field( array(
		'name'    => __( 'Button — text', 'pegasus-child' ),
		'id'      => $prefix . 'cta_btn_text',
		'type'    => 'text',
		'default' => $d['cta_btn_text'],
	) );
	$cta->add_field( array(
		'name'    => __( 'Button — link', 'pegasus-child' ),
		'id'      => $prefix . 'cta_btn_link',
		'type'    => 'text',
		'default' => $d['cta_btn_link'],
	) );
}

/**
 * show_on_cb: only display the home metaboxes on pages using tpl_home.php.
 *
 * @param object $cmb CMB2 instance.
 * @return bool
 */
function rcd_home_show_for_template( $cmb ) {
	$post_id = 0;

	if ( isset( $_GET['post'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification
		$post_id = absint( $_GET['post'] );
	} elseif ( isset( $_POST['post_ID'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification
		$post_id = absint( $_POST['post_ID'] );
	}

	if ( ! $post_id ) {
		return false;
	}

	return ( 'tpl_home.php' === get_post_meta( $post_id, '_wp_page_template', true ) );
}

/* ============================================================================
 * TEMPLATE HELPERS  ( used by tpl_home.php )
 * ========================================================================== */

if ( ! function_exists( 'rcd_home_field' ) ) {
	/**
	 * Get a single home field, falling back to the Claude Design default.
	 *
	 * @param string $key     Field key without the rcd_home_ prefix.
	 * @param int    $post_id Optional post ID.
	 * @return mixed
	 */
	function rcd_home_field( $key, $post_id = 0 ) {
		$post_id = $post_id ? $post_id : get_the_ID();
		$value   = get_post_meta( $post_id, 'rcd_home_' . $key, true );

		if ( '' === $value || null === $value || false === $value ) {
			$defaults = rcd_home_defaults();
			return isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';
		}

		return $value;
	}
}

if ( ! function_exists( 'rcd_home_rows' ) ) {
	/**
	 * Get repeatable group rows, discarding rows that are entirely empty. When
	 * nothing real has been entered the Claude Design default rows are returned,
	 * so the front end always shows a finished section.
	 *
	 * @param string $key     Group key without the rcd_home_ prefix.
	 * @param int    $post_id Optional post ID.
	 * @return array
	 */
	function rcd_home_rows( $key, $post_id = 0 ) {
		$post_id = $post_id ? $post_id : get_the_ID();
		$rows    = get_post_meta( $post_id, 'rcd_home_' . $key, true );
		$clean   = array();

		if ( is_array( $rows ) ) {
			foreach ( $rows as $row ) {
				if ( rcd_home_row_has_content( $row ) ) {
					$clean[] = $row;
				}
			}
		}

		if ( empty( $clean ) ) {
			$defaults = rcd_home_defaults();
			return isset( $defaults[ $key ] ) ? $defaults[ $key ] : array();
		}

		return $clean;
	}
}

if ( ! function_exists( 'rcd_home_row_has_content' ) ) {
	/**
	 * Does a group row contain any non-empty value ( ignoring CMB2's *_id keys )?
	 *
	 * @param array $row Group row.
	 * @return bool
	 */
	function rcd_home_row_has_content( $row ) {
		if ( ! is_array( $row ) ) {
			return false;
		}
		foreach ( $row as $field_key => $value ) {
			if ( is_array( $value ) ) {
				if ( ! empty( array_filter( $value ) ) ) {
					return true;
				}
			} elseif ( '' !== trim( (string) $value ) ) {
				return true;
			}
		}
		return false;
	}
}

if ( ! function_exists( 'rcd_home_row' ) ) {
	/**
	 * Read a value from a group row with a fallback.
	 *
	 * @param array  $row      Group row.
	 * @param string $key      Sub-field key.
	 * @param string $fallback Fallback value.
	 * @return string
	 */
	function rcd_home_row( $row, $key, $fallback = '' ) {
		return ( is_array( $row ) && isset( $row[ $key ] ) && '' !== trim( (string) $row[ $key ] ) ) ? $row[ $key ] : $fallback;
	}
}

if ( ! function_exists( 'rcd_home_media' ) ) {
	/**
	 * Output an <img> when a URL is present, otherwise a styled placeholder slot
	 * that mirrors the Claude Design empty-image-slot look.
	 *
	 * @param string $url         Image URL.
	 * @param string $size_class  Sizing/shape class ( e.g. rcd-media-tall ).
	 * @param string $placeholder Placeholder caption.
	 * @param string $alt         Image alt text.
	 */
	function rcd_home_media( $url, $size_class = '', $placeholder = 'Drop an image', $alt = '' ) {
		if ( $url ) {
			printf(
				'<img src="%1$s" alt="%2$s" class="rcd-media %3$s" loading="lazy">',
				esc_url( $url ),
				esc_attr( $alt ),
				esc_attr( $size_class )
			);
		} else {
			printf(
				'<div class="rcd-slot %1$s"><span>%2$s</span></div>',
				esc_attr( $size_class ),
				esc_html( $placeholder )
			);
		}
	}
}
