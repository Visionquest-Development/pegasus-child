<?php
/**
 * Valor Care — About page CMB2 fields, defaults & accessors.
 *
 * Mirrors the home/services pattern (see inc/cmb2-home-fields.php). The About
 * page (tpl_about.php) is fully CMB2-driven: every field renders its design
 * default until a real value / repeatable row is filled in and saved.
 *
 * @package Pegasus_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * All default (design) content for the About page.
 *
 * @return array
 */
function valorcare_about_defaults() {
	static $defaults = null;
	if ( null !== $defaults ) {
		return $defaults;
	}

	$defaults = array(

		// ---- Hero ---------------------------------------------------------
		'about_eyebrow' => 'About Valor Care',
		'about_title'   => 'Compassionate Care, <em>Close to Home</em>',
		'about_intro'   => "Valor Care was founded on a simple belief: every senior deserves to age with dignity, comfort, and independence in the place they love most — home.",

		// ---- Our Story (two-column) --------------------------------------
		'about_story_eyebrow' => 'Our Story',
		'about_story_title'   => 'Care That Feels Like Family',
		'about_story_body'    => "Valor Care was built by caregivers who saw how much a familiar, trusted face means to an aging loved one. We set out to deliver the kind of care we would want for our own family — personal, dependable, and rooted in genuine compassion.\n\nEvery care plan is customized around what each client actually needs — from a few hours of companionship a week to daily hands-on support. We match a consistent caregiver to every client, so families always see a familiar face they can trust.",

		// ---- Our Values (grid) -------------------------------------------
		'about_values_eyebrow' => 'What Guides Us',
		'about_values_title'   => 'Our Core Values',
		'values' => array(
			array( 'icon' => 'fa-heart',        'title' => 'Compassion',  'text' => 'We lead with kindness and patience, treating every client with the warmth we would give our own family.' ),
			array( 'icon' => 'fa-shield',       'title' => 'Integrity',   'text' => 'Honest, transparent, and dependable — we do what we say, every visit, every time.' ),
			array( 'icon' => 'fa-users',        'title' => 'Respect',     'text' => 'We honor each person\'s dignity, independence, and preferences at every stage of care.' ),
			array( 'icon' => 'fa-star',         'title' => 'Excellence',  'text' => 'Vetted, trained caregivers and thoughtful, personalized plans that hold to a higher standard.' ),
		),

		// ---- Team (repeatable) -------------------------------------------
		'about_team_eyebrow' => 'Our Team',
		'about_team_title'   => 'Meet the People Behind Valor Care',
		'team' => array(
			array(
				'name'  => 'Wendi McCracken, RN, BSN',
				'role'  => 'Founder & Director of Care',
				'bio'   => "As a registered nurse, Wendi spent years at the bedside of seniors and their families — and saw first-hand how the right in-home support can transform someone's quality of life.\n\nShe founded Valor Care to bring that same standard of compassionate, professional care into the home, where people are happiest and most themselves.",
				'quote' => 'Everyone deserves to age with dignity, surrounded by the comfort of home.',
			),
		),

		// ---- Bottom CTA band ---------------------------------------------
		'about_cta_title'    => 'Ready to Learn More?',
		'about_cta_text'     => "Tell us a little about your situation and our care team will help you find the right level of support.",
		'about_cta_btn_text' => 'Contact Us',
		'about_cta_btn_link' => '/contact/',
	);

	return $defaults;
}

/**
 * Convenience accessor for a single scalar About-page default.
 *
 * @param string $key Default key (with the vc_ stripped, e.g. 'about_title').
 * @return string
 */
function valorcare_about_default( $key ) {
	$d = valorcare_about_defaults();
	return isset( $d[ $key ] ) && ! is_array( $d[ $key ] ) ? $d[ $key ] : '';
}

/* -------------------------------------------------------------------------
 * Metabox registration (only on pages using the About template).
 * ---------------------------------------------------------------------- */

/**
 * Register the About page metaboxes.
 */
function valorcare_register_about_metaboxes() {

	$prefix   = 'vc_';
	$defaults = valorcare_about_defaults();
	$show_on  = array(
		'key'   => 'page-template',
		'value' => 'tpl_about.php',
	);
	$box_common = array(
		'object_types' => array( 'page' ),
		'context'      => 'normal',
		'priority'     => 'high',
		'closed'       => true,
		'show_on'      => $show_on,
	);

	/* ------------------------------------------------------------- Hero */
	$hero = new_cmb2_box( array_merge( $box_common, array(
		'id'    => $prefix . 'about_hero_box',
		'title' => esc_html__( 'About — Hero', 'pegasus-child' ),
	) ) );
	$hero->add_field( array( 'name' => 'Eyebrow', 'id' => $prefix . 'about_eyebrow', 'type' => 'text', 'default' => $defaults['about_eyebrow'] ) );
	$hero->add_field( array( 'name' => 'Heading', 'desc' => 'HTML allowed — wrap words in <code>&lt;em&gt;…&lt;/em&gt;</code> for a gold accent.', 'id' => $prefix . 'about_title', 'type' => 'textarea_small', 'default' => $defaults['about_title'] ) );
	$hero->add_field( array( 'name' => 'Intro', 'id' => $prefix . 'about_intro', 'type' => 'textarea', 'default' => $defaults['about_intro'] ) );
	$hero->add_field( array( 'name' => 'Hero Photo', 'desc' => 'Leave blank to show the placeholder.', 'id' => $prefix . 'about_hero_image', 'type' => 'file', 'options' => array( 'url' => false ) ) );

	/* -------------------------------------------------------- Our Story */
	$story = new_cmb2_box( array_merge( $box_common, array(
		'id'    => $prefix . 'about_story_box',
		'title' => esc_html__( 'About — Our Story', 'pegasus-child' ),
	) ) );
	$story->add_field( array( 'name' => 'Eyebrow', 'id' => $prefix . 'about_story_eyebrow', 'type' => 'text', 'default' => $defaults['about_story_eyebrow'] ) );
	$story->add_field( array( 'name' => 'Heading', 'id' => $prefix . 'about_story_title', 'type' => 'text', 'default' => $defaults['about_story_title'] ) );
	$story->add_field( array( 'name' => 'Body', 'desc' => 'One paragraph per line (blank line between paragraphs).', 'id' => $prefix . 'about_story_body', 'type' => 'textarea', 'default' => $defaults['about_story_body'] ) );
	$story->add_field( array( 'name' => 'Story Photo', 'desc' => 'Leave blank to show the placeholder.', 'id' => $prefix . 'about_story_image', 'type' => 'file', 'options' => array( 'url' => false ) ) );

	/* ------------------------------------------------------- Our Values */
	$values = new_cmb2_box( array_merge( $box_common, array(
		'id'    => $prefix . 'about_values_box',
		'title' => esc_html__( 'About — Our Values', 'pegasus-child' ),
	) ) );
	$values->add_field( array( 'name' => 'Eyebrow', 'id' => $prefix . 'about_values_eyebrow', 'type' => 'text', 'default' => $defaults['about_values_eyebrow'] ) );
	$values->add_field( array( 'name' => 'Heading', 'id' => $prefix . 'about_values_title', 'type' => 'text', 'default' => $defaults['about_values_title'] ) );
	$val_group = $values->add_field( array(
		'id'      => $prefix . 'values',
		'type'    => 'group',
		'options' => array(
			'group_title'   => 'Value {#}',
			'add_button'    => 'Add Value',
			'remove_button' => 'Remove Value',
			'sortable'      => true,
			'closed'        => true,
		),
	) );
	$values->add_group_field( $val_group, array( 'name' => 'Font Awesome Icon', 'desc' => 'e.g. fa-heart, fa-shield.', 'id' => 'icon', 'type' => 'text' ) );
	$values->add_group_field( $val_group, array( 'name' => 'Title', 'id' => 'title', 'type' => 'text' ) );
	$values->add_group_field( $val_group, array( 'name' => 'Text', 'id' => 'text', 'type' => 'textarea_small' ) );

	/* -------------------------------------------------------------- Team */
	$team = new_cmb2_box( array_merge( $box_common, array(
		'id'    => $prefix . 'about_team_box',
		'title' => esc_html__( 'About — Team', 'pegasus-child' ),
	) ) );
	$team->add_field( array( 'name' => 'Eyebrow', 'id' => $prefix . 'about_team_eyebrow', 'type' => 'text', 'default' => $defaults['about_team_eyebrow'] ) );
	$team->add_field( array( 'name' => 'Heading', 'id' => $prefix . 'about_team_title', 'type' => 'text', 'default' => $defaults['about_team_title'] ) );
	$team_group = $team->add_field( array(
		'id'      => $prefix . 'team',
		'type'    => 'group',
		'description' => 'Team members. Add a row for each person — the first person shows as the featured founder; add more as you hire.',
		'options' => array(
			'group_title'   => 'Team Member {#}',
			'add_button'    => 'Add Team Member',
			'remove_button' => 'Remove Team Member',
			'sortable'      => true,
			'closed'        => true,
		),
	) );
	$team->add_group_field( $team_group, array( 'name' => 'Name', 'id' => 'name', 'type' => 'text' ) );
	$team->add_group_field( $team_group, array( 'name' => 'Role / Title', 'desc' => 'e.g. Founder & Director of Care, Caregiver.', 'id' => 'role', 'type' => 'text' ) );
	$team->add_group_field( $team_group, array( 'name' => 'Portrait', 'desc' => 'Leave blank to show the placeholder.', 'id' => 'image', 'type' => 'file', 'options' => array( 'url' => false ) ) );
	$team->add_group_field( $team_group, array( 'name' => 'Bio', 'desc' => 'One paragraph per line (blank line between paragraphs).', 'id' => 'bio', 'type' => 'textarea' ) );
	$team->add_group_field( $team_group, array( 'name' => 'Pull Quote', 'desc' => 'Optional. Leave blank to hide.', 'id' => 'quote', 'type' => 'textarea_small' ) );

	/* --------------------------------------------------------- Bottom CTA */
	$cta = new_cmb2_box( array_merge( $box_common, array(
		'id'    => $prefix . 'about_cta_box',
		'title' => esc_html__( 'About — Bottom CTA', 'pegasus-child' ),
	) ) );
	$cta->add_field( array( 'name' => 'Heading', 'desc' => 'HTML allowed — <code>&lt;em&gt;…&lt;/em&gt;</code> renders a gold accent.', 'id' => $prefix . 'about_cta_title', 'type' => 'textarea_small', 'default' => $defaults['about_cta_title'] ) );
	$cta->add_field( array( 'name' => 'Text', 'id' => $prefix . 'about_cta_text', 'type' => 'textarea_small', 'default' => $defaults['about_cta_text'] ) );
	$cta->add_field( array( 'name' => 'Button Text', 'id' => $prefix . 'about_cta_btn_text', 'type' => 'text', 'default' => $defaults['about_cta_btn_text'] ) );
	$cta->add_field( array( 'name' => 'Button Link', 'id' => $prefix . 'about_cta_btn_link', 'type' => 'text', 'default' => $defaults['about_cta_btn_link'] ) );
}
add_action( 'cmb2_admin_init', 'valorcare_register_about_metaboxes' );
