<?php
/**
 * Valor Care — Services page CMB2 fields, shared helpers & front-end defaults.
 *
 * Mirrors the home-fields pattern (see inc/cmb2-home-fields.php). The Services
 * page (tpl_services.php) owns the canonical "Services Catalogue" repeatable
 * group (vc_services). That same catalogue drives BOTH the Services inner page
 * and the Homepage services grid (tpl_home.php §Services) — so services are
 * edited in exactly one place.
 *
 * Field behavior matches the rest of the theme: the design defaults render on
 * the front end until a real row/field is filled in and saved.
 *
 * @package Pegasus_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * All default (design) content for the Services page + the shared catalogue.
 *
 * @return array
 */
function valorcare_services_defaults() {
	static $defaults = null;
	if ( null !== $defaults ) {
		return $defaults;
	}

	$defaults = array(

		// ---- Services page top / hero -------------------------------------
		'services_page_eyebrow'      => 'Our Services',
		'services_page_title'        => 'In-Home Care for Seniors',
		'services_page_intro'        => "Every client receives a customized plan built around what they actually need — from a few hours a week to daily support. No doctor's order required.",

		// ---- Services page CTA (bottom) -----------------------------------
		'services_page_cta_title'    => 'Not sure which service fits?',
		'services_page_cta_text'     => "Most families start with a free consultation. Tell us a little about your situation and our care team will help you map out the right level of support.",
		'services_page_cta_btn_text' => 'Request a Free Consultation',
		'services_page_cta_btn_link' => '#consultation',

		// ---- Shared services catalogue ------------------------------------
		// Drives the Homepage grid (icon/title/text/image/link) AND the
		// Services page detail blocks (code/title/text/bullets/image).
		'catalogue' => array(
			array(
				'code'      => 'SVC-01',
				'icon'      => 'fa-users',
				'title'     => 'Companionship',
				'text'      => 'Meaningful conversation, shared activities, errands, and a reassuring presence that keeps isolation at bay.',
				'bullets'   => '<ul><li>Meaningful conversation &amp; company</li><li>Errands, shopping &amp; appointments</li><li>Shared hobbies &amp; activities</li><li>Medication &amp; appointment reminders</li></ul>',
				'link_text' => '',
				'link_url'  => '',
			),
			array(
				'code'      => 'SVC-02',
				'icon'      => 'fa-heart',
				'title'     => 'Personal Care',
				'text'      => 'Respectful, hands-on help with bathing, grooming, dressing, mobility, and other daily personal needs.',
				'bullets'   => '<ul><li>Bathing, grooming &amp; dressing</li><li>Mobility &amp; transfer assistance</li><li>Toileting &amp; incontinence care</li><li>Feeding &amp; hydration support</li></ul>',
				'link_text' => '',
				'link_url'  => '',
			),
			array(
				'code'      => 'SVC-03',
				'icon'      => 'fa-clock-o',
				'title'     => 'Respite Care',
				'text'      => 'Family caregivers need rest too. We step in for a few hours, a weekend, or longer so you can recharge.',
				'bullets'   => '<ul><li>A few hours, a weekend, or longer</li><li>Coverage while you travel or rest</li><li>Consistent, vetted caregivers</li><li>Peace of mind for the whole family</li></ul>',
				'link_text' => '',
				'link_url'  => '',
			),
			array(
				'code'      => 'SVC-04',
				'icon'      => 'fa-home',
				'title'     => 'Homemaking',
				'text'      => 'Light housekeeping, laundry, meal preparation, and feeding assistance that keep the home running comfortably.',
				'bullets'   => '<ul><li>Light housekeeping &amp; laundry</li><li>Meal planning &amp; preparation</li><li>Feeding assistance</li><li>A tidy, comfortable home</li></ul>',
				'link_text' => '',
				'link_url'  => '',
			),
			array(
				'code'      => 'SVC-05',
				'icon'      => 'fa-lightbulb-o',
				'title'     => "Dementia & Alzheimer's Support",
				'text'      => 'Gentle guidance, daily structure, and safety-focused support tailored to memory-related needs.',
				'bullets'   => '<ul><li>Gentle redirection &amp; daily structure</li><li>Safety-focused supervision</li><li>Familiar routines &amp; reassurance</li><li>Support for family caregivers</li></ul>',
				'link_text' => '',
				'link_url'  => '',
			),
		),
	);

	return $defaults;
}

/**
 * Convenience accessor for a single scalar Services-page default.
 *
 * @param string $key Default key.
 * @return string
 */
function valorcare_services_default( $key ) {
	$d = valorcare_services_defaults();
	return isset( $d[ $key ] ) && ! is_array( $d[ $key ] ) ? $d[ $key ] : '';
}

/**
 * Prefill the Services Catalogue group in the admin with the default services
 * whenever the page has none saved yet.
 *
 * CMB2 group fields can't use the scalar `default` arg, so without this the
 * catalogue metabox opens blank even though the front end renders five default
 * services. This makes those defaults appear as real, editable rows in the
 * backend so the client can see and tweak the actual copy.
 *
 * Non-destructive: this only affects what CMB2 shows (it hooks the meta *read*,
 * not a save). Nothing is written to the database until the page is saved, and
 * the front-end templates keep their own raw-meta "defaults until filled"
 * fallback, so this filter never interferes with them.
 *
 * @param mixed  $override  CMB2 no-override sentinel (returned to keep normal fetch).
 * @param int    $object_id Page ID being edited.
 * @param array  $args      Field args.
 * @param object $field     CMB2_Field instance.
 * @return mixed Default catalogue rows to seed, or $override to fetch normally.
 */
function valorcare_prefill_services_catalogue( $override, $object_id, $args, $field ) {
	$existing = get_post_meta( $object_id, 'vc_services', true );
	// Real saved rows exist ⇒ leave CMB2 to fetch them normally.
	if ( is_array( $existing ) && ! empty( valorcare_nonempty_rows( $existing ) ) ) {
		return $override;
	}
	$defaults = valorcare_services_defaults();
	return isset( $defaults['catalogue'] ) ? $defaults['catalogue'] : $override;
}
add_filter( 'cmb2_override_vc_services_meta_value', 'valorcare_prefill_services_catalogue', 10, 4 );

/* -------------------------------------------------------------------------
 * Shared helpers (guarded) — cross-template page lookups + meta reads.
 * ---------------------------------------------------------------------- */

if ( ! function_exists( 'valorcare_get_page_by_template' ) ) {
	/**
	 * Find the first published page assigned to a given Page Template file.
	 * Cached per request per template.
	 *
	 * @param string $template_file e.g. 'tpl_services.php'
	 * @return int Page ID, or 0.
	 */
	function valorcare_get_page_by_template( $template_file ) {
		static $cache = array();
		if ( isset( $cache[ $template_file ] ) ) {
			return $cache[ $template_file ];
		}

		// Prefer the static front-page setting when it matches (Homepage case).
		$front = (int) get_option( 'page_on_front' );
		if ( $front && $template_file === get_page_template_slug( $front ) ) {
			return $cache[ $template_file ] = $front;
		}

		$pages = get_posts( array(
			'post_type'      => 'page',
			'post_status'    => 'publish',
			'posts_per_page' => 1,
			'fields'         => 'ids',
			'meta_query'     => array(
				array(
					'key'   => '_wp_page_template',
					'value' => $template_file,
				),
			),
		) );

		return $cache[ $template_file ] = ! empty( $pages ) ? (int) $pages[0] : 0;
	}
}

if ( ! function_exists( 'valorcare_get_services_page_id' ) ) {
	/** Locate the page that holds the canonical Services Catalogue. */
	function valorcare_get_services_page_id() {
		return valorcare_get_page_by_template( 'tpl_services.php' );
	}
}

if ( ! function_exists( 'valorcare_meta_from' ) ) {
	/** Read a scalar meta value from a specific page id, with a fallback. */
	function valorcare_meta_from( $key, $page_id, $fallback = '' ) {
		if ( ! $page_id ) {
			return $fallback;
		}
		$value = get_post_meta( $page_id, $key, true );
		return ( '' === $value || null === $value ) ? $fallback : $value;
	}
}

if ( ! function_exists( 'valorcare_meta_group_from' ) ) {
	/** Read a group field from a specific page id, with a fallback. */
	function valorcare_meta_group_from( $key, $page_id, $fallback = array() ) {
		if ( ! $page_id ) {
			return $fallback;
		}
		$value = get_post_meta( $page_id, $key, true );
		return ( is_array( $value ) && ! empty( $value ) ) ? $value : $fallback;
	}
}

if ( ! function_exists( 'valorcare_nonempty_rows' ) ) {
	/**
	 * Strip blank repeatable-group rows (all fields empty — e.g. the single
	 * empty row CMB2 shows by default). Keeps the "defaults until real content"
	 * behavior working. File fields' companion `_id` keys are ignored.
	 *
	 * @param mixed $rows
	 * @return array
	 */
	function valorcare_nonempty_rows( $rows ) {
		if ( ! is_array( $rows ) ) {
			return array();
		}
		return array_values( array_filter(
			$rows,
			function( $row ) {
				if ( ! is_array( $row ) ) {
					return '' !== trim( (string) $row );
				}
				foreach ( $row as $field_key => $value ) {
					if ( '_id' === substr( $field_key, -3 ) ) {
						continue;
					}
					if ( '' !== trim( (string) $value ) ) {
						return true;
					}
				}
				return false;
			}
		) );
	}
}

/* -------------------------------------------------------------------------
 * Metabox registration (only on pages using the Services template).
 * ---------------------------------------------------------------------- */

/**
 * Register the Services page metaboxes.
 */
function valorcare_register_services_metaboxes() {

	$prefix   = 'vc_';
	$defaults = valorcare_services_defaults();
	$show_on  = array(
		'key'   => 'page-template',
		'value' => 'tpl_services.php',
	);

	/* ---------------------------------------------------- Services — Top */
	$top = new_cmb2_box( array(
		'id'           => $prefix . 'services_page_top_box',
		'title'        => esc_html__( 'Services — Top Section', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'context'      => 'normal',
		'priority'     => 'high',
		'closed'       => true,
		'show_on'      => $show_on,
	) );
	$top->add_field( array( 'name' => 'Eyebrow', 'id' => $prefix . 'services_page_eyebrow', 'type' => 'text', 'default' => $defaults['services_page_eyebrow'] ) );
	$top->add_field( array( 'name' => 'Heading', 'desc' => 'HTML allowed — wrap words in <code>&lt;em&gt;…&lt;/em&gt;</code> for a gold accent.', 'id' => $prefix . 'services_page_title', 'type' => 'textarea_small', 'default' => $defaults['services_page_title'] ) );
	$top->add_field( array( 'name' => 'Intro', 'id' => $prefix . 'services_page_intro', 'type' => 'textarea', 'default' => $defaults['services_page_intro'] ) );

	/* ------------------------------- Services Catalogue (shared w/ Home) */
	$cat = new_cmb2_box( array(
		'id'           => $prefix . 'services_catalogue_box',
		'title'        => esc_html__( 'Services Catalogue (shared with Homepage)', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'context'      => 'normal',
		'priority'     => 'high',
		'closed'       => true,
		'show_on'      => $show_on,
	) );
	$cards = $cat->add_field( array(
		'id'          => $prefix . 'services',
		'type'        => 'group',
		'description' => 'Service cards. Drives both this Services page and the Homepage services grid.',
		'options'     => array(
			'group_title'   => 'Service {#}',
			'add_button'    => 'Add Service',
			'remove_button' => 'Remove Service',
			'sortable'      => true,
			'closed'        => true,
		),
	) );
	$cat->add_group_field( $cards, array( 'name' => 'Code', 'desc' => 'Short code shown on the Services page (e.g. "SVC-01").', 'id' => 'code', 'type' => 'text' ) );
	$cat->add_group_field( $cards, array( 'name' => 'Font Awesome Icon', 'desc' => 'e.g. fa-users, fa-heart (used on the Homepage card).', 'id' => 'icon', 'type' => 'text' ) );
	$cat->add_group_field( $cards, array( 'name' => 'Title', 'id' => 'title', 'type' => 'text' ) );
	$cat->add_group_field( $cards, array( 'name' => 'Short Description', 'desc' => 'Used on the Homepage card and as the lead on the Services page.', 'id' => 'text', 'type' => 'textarea_small' ) );
	$cat->add_group_field( $cards, array( 'name' => 'Bullets (WYSIWYG — use a UL list)', 'desc' => 'Optional. Detail list shown on the Services page block.', 'id' => 'bullets', 'type' => 'wysiwyg', 'options' => array( 'media_buttons' => false, 'textarea_rows' => 6 ) ) );
	$cat->add_group_field( $cards, array( 'name' => 'Photo', 'desc' => 'Optional. Used on the Homepage card media and the Services page block. Leave blank to show the placeholder.', 'id' => 'image', 'type' => 'file', 'options' => array( 'url' => false ) ) );
	$cat->add_group_field( $cards, array( 'name' => 'Button Text', 'desc' => 'Optional. Label for the button (defaults to "Learn More" on the Services page / "Read more" on the Homepage).', 'id' => 'link_text', 'type' => 'text' ) );
	$cat->add_group_field( $cards, array( 'name' => 'Button URL (individual service page)', 'desc' => 'Optional. When filled, a "Learn More" button appears on this Services-page block and the Homepage card, linking to the individual service page. Leave blank to hide the button.', 'id' => 'link_url', 'type' => 'text' ) );

	/* ---------------------------------------------------- Services — CTA */
	$cta = new_cmb2_box( array(
		'id'           => $prefix . 'services_page_cta_box',
		'title'        => esc_html__( 'Services — Bottom CTA', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'context'      => 'normal',
		'priority'     => 'high',
		'closed'       => true,
		'show_on'      => $show_on,
	) );
	$cta->add_field( array( 'name' => 'Heading', 'desc' => 'HTML allowed — <code>&lt;em&gt;…&lt;/em&gt;</code> renders a gold accent.', 'id' => $prefix . 'services_page_cta_title', 'type' => 'textarea_small', 'default' => $defaults['services_page_cta_title'] ) );
	$cta->add_field( array( 'name' => 'Text', 'id' => $prefix . 'services_page_cta_text', 'type' => 'textarea_small', 'default' => $defaults['services_page_cta_text'] ) );
	$cta->add_field( array( 'name' => 'Button Text', 'id' => $prefix . 'services_page_cta_btn_text', 'type' => 'text', 'default' => $defaults['services_page_cta_btn_text'] ) );
	$cta->add_field( array( 'name' => 'Button Link', 'id' => $prefix . 'services_page_cta_btn_link', 'type' => 'text', 'default' => $defaults['services_page_cta_btn_link'] ) );
}
add_action( 'cmb2_admin_init', 'valorcare_register_services_metaboxes' );
