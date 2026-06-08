<?php
/**
 * Rice Capital Fund — CMB2 Metabox Registrations
 *
 * All page-template metaboxes live here, grouped by template.
 * This file is required from functions.php.
 *
 * Templates covered:
 *   §1  tpl_home.php   — Hero, Philosophy, Process, Pillars, CTA
 *   §2  tpl_team.php   — Team Members, Page Settings
 *   §3  tpl_about.php  — Hero, Mission, Stats, Trust Pillars, Providers, CTA
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }


/* ====================================================================
   §1  HOME PAGE  —  tpl_home.php
   ==================================================================== */

/* -----------------------------------------------------------------------
   HOME — Hero Section
   ----------------------------------------------------------------------- */
function pegasus_child_register_home_hero_metabox() {
	$cmb = new_cmb2_box( array(
		'id'           => 'rcf_home_hero_metabox',
		'title'        => __( 'Home — Hero Section', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'show_on'      => array( 'key' => 'page-template', 'value' => 'tpl_home.php' ),
		'context'      => 'normal',
		'priority'     => 'high',
	) );

	$cmb->add_field( array(
		'name'    => __( 'Heading', 'pegasus-child' ),
		'desc'    => __( 'Main hero heading (e.g. "Rice Capital Fund").', 'pegasus-child' ),
		'id'      => 'rcf_hero_heading',
		'type'    => 'text',
		'default' => 'Rice Capital Fund',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Subtitle / Eyebrow', 'pegasus-child' ),
		'id'      => 'rcf_hero_subtitle',
		'type'    => 'text',
		'default' => 'Hedge Fund & Advisory Firm',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Lede Paragraph', 'pegasus-child' ),
		'id'      => 'rcf_hero_lede',
		'type'    => 'textarea_small',
		'default' => 'A multi-strategy hedge fund and advisory firm focused on identifying attractive risk/reward opportunities and delivering consistent, risk-adjusted returns.',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Button 1 — Text', 'pegasus-child' ),
		'id'      => 'rcf_hero_btn1_text',
		'type'    => 'text_small',
		'default' => 'Our Approach',
	) );
	$cmb->add_field( array(
		'name' => __( 'Button 1 — URL', 'pegasus-child' ),
		'id'   => 'rcf_hero_btn1_url',
		'type' => 'text_url',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Button 2 — Text', 'pegasus-child' ),
		'id'      => 'rcf_hero_btn2_text',
		'type'    => 'text_small',
		'default' => 'Learn More',
	) );
	$cmb->add_field( array(
		'name' => __( 'Button 2 — URL', 'pegasus-child' ),
		'id'   => 'rcf_hero_btn2_url',
		'type' => 'text_url',
	) );
}
add_action( 'cmb2_admin_init', 'pegasus_child_register_home_hero_metabox' );


/* -----------------------------------------------------------------------
   HOME — Investment Philosophy (Tenets)
   ----------------------------------------------------------------------- */
function pegasus_child_register_home_philosophy_metabox() {
	$prefix = 'rcf_philosophy_';

	$cmb = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => __( 'Home — Investment Philosophy Section', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'show_on'      => array( 'key' => 'page-template', 'value' => 'tpl_home.php' ),
		'context'      => 'normal',
		'priority'     => 'high',
	) );

	$cmb->add_field( array(
		'name'    => __( 'Heading', 'pegasus-child' ),
		'desc'    => __( 'Use newlines for line breaks (e.g. "Patient capital,\ndisciplined process,\nasymmetric outcomes.").', 'pegasus-child' ),
		'id'      => $prefix . 'heading',
		'type'    => 'textarea_small',
		'default' => "Patient capital,\ndisciplined process,\nasymmetric outcomes.",
	) );
	$cmb->add_field( array(
		'name'    => __( 'Pull Quote', 'pegasus-child' ),
		'id'      => $prefix . 'quote',
		'type'    => 'textarea_small',
		'default' => '"We invest with the conviction that durable returns are earned through rigorous fundamental work, disciplined risk budgeting, and the patience to act only when the opportunity is genuinely asymmetric."',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Quote Attribution', 'pegasus-child' ),
		'id'      => $prefix . 'cite',
		'type'    => 'text',
		'default' => '— Investment Committee, Rice Capital Fund',
	) );

	$group_id = $cmb->add_field( array(
		'id'          => $prefix . 'tenets',
		'type'        => 'group',
		'description' => __( 'Three investment tenets displayed in a three-column ruled grid.', 'pegasus-child' ),
		'options'     => array(
			'group_title'   => __( 'Tenet {#}', 'pegasus-child' ),
			'add_button'    => __( 'Add Tenet', 'pegasus-child' ),
			'remove_button' => __( 'Remove Tenet', 'pegasus-child' ),
			'sortable'      => true,
			'closed'        => true,
		),
	) );
	$cmb->add_group_field( $group_id, array(
		'name' => __( 'Roman Numeral', 'pegasus-child' ),
		'desc' => __( 'e.g. I. or II. or III.', 'pegasus-child' ),
		'id'   => 'num',
		'type' => 'text_small',
	) );
	$cmb->add_group_field( $group_id, array(
		'name' => __( 'Title', 'pegasus-child' ),
		'id'   => 'title',
		'type' => 'text',
	) );
	$cmb->add_group_field( $group_id, array(
		'name' => __( 'Body Text', 'pegasus-child' ),
		'id'   => 'body',
		'type' => 'textarea_small',
	) );
}
add_action( 'cmb2_admin_init', 'pegasus_child_register_home_philosophy_metabox' );


/* -----------------------------------------------------------------------
   HOME — How We Invest (Process Steps)
   ----------------------------------------------------------------------- */
function pegasus_child_register_home_process_metabox() {
	$prefix = 'rcf_process_';

	$cmb = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => __( 'Home — How We Invest / Process Section', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'show_on'      => array( 'key' => 'page-template', 'value' => 'tpl_home.php' ),
		'context'      => 'normal',
		'priority'     => 'high',
	) );

	$cmb->add_field( array(
		'name'    => __( 'Heading', 'pegasus-child' ),
		'id'      => $prefix . 'heading',
		'type'    => 'textarea_small',
		'default' => "A repeatable process\nthat compounds judgment.",
	) );
	$cmb->add_field( array(
		'name'    => __( 'Lede Paragraph', 'pegasus-child' ),
		'id'      => $prefix . 'lede',
		'type'    => 'textarea_small',
		'default' => "Our investment process is deliberately slow at the front end and decisive at the back. Each step is designed to compound the firm's judgment — and to remove our own behavioral edge cases from the decision.",
	) );

	$group_id = $cmb->add_field( array(
		'id'          => $prefix . 'steps',
		'type'        => 'group',
		'description' => __( 'Process steps — typically four, displayed in a ruled grid.', 'pegasus-child' ),
		'options'     => array(
			'group_title'   => __( 'Step {#}', 'pegasus-child' ),
			'add_button'    => __( 'Add Step', 'pegasus-child' ),
			'remove_button' => __( 'Remove Step', 'pegasus-child' ),
			'sortable'      => true,
			'closed'        => true,
		),
	) );
	$cmb->add_group_field( $group_id, array(
		'name' => __( 'Step Number', 'pegasus-child' ),
		'desc' => __( 'e.g. 01, 02, 03, 04', 'pegasus-child' ),
		'id'   => 'num',
		'type' => 'text_small',
	) );
	$cmb->add_group_field( $group_id, array(
		'name' => __( 'Title', 'pegasus-child' ),
		'id'   => 'title',
		'type' => 'text',
	) );
	$cmb->add_group_field( $group_id, array(
		'name' => __( 'Body Text', 'pegasus-child' ),
		'id'   => 'body',
		'type' => 'textarea_small',
	) );
}
add_action( 'cmb2_admin_init', 'pegasus_child_register_home_process_metabox' );


/* -----------------------------------------------------------------------
   HOME — Pillars Section (icon + content columns)
   ----------------------------------------------------------------------- */
function pegasus_child_register_home_pillars_metabox() {
	$prefix = 'rcf_home_pillars_';

	$cmb = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => __( 'Home — Pillars Section', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'show_on'      => array( 'key' => 'page-template', 'value' => 'tpl_home.php' ),
		'context'      => 'normal',
		'priority'     => 'high',
	) );

	$group_id = $cmb->add_field( array(
		'id'          => $prefix . 'group',
		'type'        => 'group',
		'description' => __( 'Each pillar appears as a column above the footer. Repeatable.', 'pegasus-child' ),
		'options'     => array(
			'group_title'   => __( 'Pillar {#}', 'pegasus-child' ),
			'add_button'    => __( 'Add Another Pillar', 'pegasus-child' ),
			'remove_button' => __( 'Remove Pillar', 'pegasus-child' ),
			'sortable'      => true,
			'closed'        => true,
		),
	) );

	$cmb->add_group_field( $group_id, array(
		'name' => __( 'Title', 'pegasus-child' ),
		'id'   => 'title',
		'type' => 'text',
	) );
	$cmb->add_group_field( $group_id, array(
		'name' => __( 'Font Awesome 4 Icon Class', 'pegasus-child' ),
		'desc' => __( 'Icon class without the leading "fa fa-". E.g. bar-chart, shield, handshake-o, users. See https://fontawesome.com/v4/icons/', 'pegasus-child' ),
		'id'   => 'icon',
		'type' => 'text',
	) );
	$cmb->add_group_field( $group_id, array(
		'name'    => __( 'Content', 'pegasus-child' ),
		'id'      => 'content',
		'type'    => 'wysiwyg',
		'options' => array(
			'textarea_rows' => 5,
			'media_buttons' => false,
		),
	) );
}
add_action( 'cmb2_admin_init', 'pegasus_child_register_home_pillars_metabox' );


/* -----------------------------------------------------------------------
   HOME — CTA Band
   ----------------------------------------------------------------------- */
function pegasus_child_register_home_cta_metabox() {
	$prefix = 'rcf_home_cta_';

	$cmb = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => __( 'Home — CTA Band', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'show_on'      => array( 'key' => 'page-template', 'value' => 'tpl_home.php' ),
		'context'      => 'normal',
		'priority'     => 'high',
	) );

	$cmb->add_field( array(
		'name'    => __( 'Eyebrow', 'pegasus-child' ),
		'id'      => $prefix . 'eyebrow',
		'type'    => 'text',
		'default' => 'For Qualified Investors',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Heading', 'pegasus-child' ),
		'id'      => $prefix . 'heading',
		'type'    => 'text',
		'default' => 'Begin a conversation with our Investor Relations team.',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Lede Paragraph', 'pegasus-child' ),
		'id'      => $prefix . 'lede',
		'type'    => 'textarea_small',
		'default' => 'Request the current strategy presentation, or schedule an introductory call with a member of the investment team. All inquiries are reviewed personally and held in confidence.',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Button 1 — Text', 'pegasus-child' ),
		'id'      => $prefix . 'btn1_text',
		'type'    => 'text_small',
		'default' => 'Schedule a Call',
	) );
	$cmb->add_field( array(
		'name' => __( 'Button 1 — URL', 'pegasus-child' ),
		'id'   => $prefix . 'btn1_url',
		'type' => 'text_url',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Button 2 — Text', 'pegasus-child' ),
		'id'      => $prefix . 'btn2_text',
		'type'    => 'text_small',
		'default' => 'Request the Deck',
	) );
	$cmb->add_field( array(
		'name' => __( 'Button 2 — URL', 'pegasus-child' ),
		'id'   => $prefix . 'btn2_url',
		'type' => 'text_url',
	) );
}
add_action( 'cmb2_admin_init', 'pegasus_child_register_home_cta_metabox' );


/* ====================================================================
   §2  TEAM PAGE  —  tpl_team.php
   ==================================================================== */

/* -----------------------------------------------------------------------
   TEAM — Members (repeatable portrait + bio rows)
   ----------------------------------------------------------------------- */
function pegasus_child_register_team_members_metabox() {
	$prefix = 'rcf_team_members_';

	$cmb = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => __( 'Team — Members', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'show_on'      => array( 'key' => 'page-template', 'value' => 'tpl_team.php' ),
		'context'      => 'normal',
		'priority'     => 'high',
	) );

	$group_id = $cmb->add_field( array(
		'id'          => $prefix . 'group',
		'type'        => 'group',
		'description' => __( 'Each entry renders as a large-portrait + bio row, alternating left/right.', 'pegasus-child' ),
		'options'     => array(
			'group_title'   => __( 'Member {#}', 'pegasus-child' ),
			'add_button'    => __( 'Add Another Member', 'pegasus-child' ),
			'remove_button' => __( 'Remove Member', 'pegasus-child' ),
			'sortable'      => true,
			'closed'        => true,
		),
	) );

	$cmb->add_group_field( $group_id, array(
		'name'         => __( 'Portrait', 'pegasus-child' ),
		'id'           => 'portrait',
		'type'         => 'file',
		'options'      => array( 'url' => false ),
		'text'         => array( 'add_upload_file_text' => __( 'Add Portrait', 'pegasus-child' ) ),
		'query_args'   => array( 'type' => 'image' ),
		'preview_size' => 'medium',
	) );
	$cmb->add_group_field( $group_id, array(
		'name' => __( 'Name', 'pegasus-child' ),
		'id'   => 'name',
		'type' => 'text',
	) );
	$cmb->add_group_field( $group_id, array(
		'name' => __( 'Role / Title', 'pegasus-child' ),
		'id'   => 'role',
		'type' => 'text',
	) );
	$cmb->add_group_field( $group_id, array(
		'name' => __( 'Credential Line', 'pegasus-child' ),
		'desc' => __( 'Italic line below the name, e.g. "CFA · 22 years investing experience".', 'pegasus-child' ),
		'id'   => 'credential',
		'type' => 'text',
	) );
	$cmb->add_group_field( $group_id, array(
		'name'    => __( 'Biography', 'pegasus-child' ),
		'desc'    => __( 'Full bio paragraphs.', 'pegasus-child' ),
		'id'      => 'bio',
		'type'    => 'wysiwyg',
		'options' => array(
			'textarea_rows' => 10,
			'media_buttons' => false,
		),
	) );
	$cmb->add_group_field( $group_id, array(
		'name' => __( 'Meta 1 — Value', 'pegasus-child' ),
		'desc' => __( 'e.g. "22 yrs"', 'pegasus-child' ),
		'id'   => 'meta_1_value',
		'type' => 'text_small',
	) );
	$cmb->add_group_field( $group_id, array(
		'name' => __( 'Meta 1 — Label', 'pegasus-child' ),
		'desc' => __( 'e.g. "Investing"', 'pegasus-child' ),
		'id'   => 'meta_1_label',
		'type' => 'text_small',
	) );
	$cmb->add_group_field( $group_id, array(
		'name' => __( 'Meta 2 — Value', 'pegasus-child' ),
		'id'   => 'meta_2_value',
		'type' => 'text_small',
	) );
	$cmb->add_group_field( $group_id, array(
		'name' => __( 'Meta 2 — Label', 'pegasus-child' ),
		'id'   => 'meta_2_label',
		'type' => 'text_small',
	) );
	$cmb->add_group_field( $group_id, array(
		'name' => __( 'Meta 3 — Value', 'pegasus-child' ),
		'id'   => 'meta_3_value',
		'type' => 'text_small',
	) );
	$cmb->add_group_field( $group_id, array(
		'name' => __( 'Meta 3 — Label', 'pegasus-child' ),
		'id'   => 'meta_3_label',
		'type' => 'text_small',
	) );
}
add_action( 'cmb2_admin_init', 'pegasus_child_register_team_members_metabox' );


/* -----------------------------------------------------------------------
   TEAM — Page Settings (intro copy + CTA band)
   ----------------------------------------------------------------------- */
function pegasus_child_register_team_page_settings_metabox() {
	$prefix = 'rcf_team_page_';

	$cmb = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => __( 'Team — Page Settings', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'show_on'      => array( 'key' => 'page-template', 'value' => 'tpl_team.php' ),
		'context'      => 'normal',
		'priority'     => 'high',
	) );

	$cmb->add_field( array(
		'name'    => __( 'Intro Headline', 'pegasus-child' ),
		'desc'    => __( 'Headline for the cream intro section.', 'pegasus-child' ),
		'id'      => $prefix . 'intro_headline',
		'type'    => 'text',
		'default' => 'Six partners. One investment culture.',
	) );
	$cmb->add_field( array(
		'name' => __( 'Intro Body — Paragraph 1', 'pegasus-child' ),
		'id'   => $prefix . 'intro_body_1',
		'type' => 'textarea_small',
	) );
	$cmb->add_field( array(
		'name' => __( 'Intro Body — Paragraph 2', 'pegasus-child' ),
		'id'   => $prefix . 'intro_body_2',
		'type' => 'textarea_small',
	) );
	$cmb->add_field( array(
		'name'    => __( 'CTA Eyebrow', 'pegasus-child' ),
		'id'      => $prefix . 'cta_eyebrow',
		'type'    => 'text',
		'default' => 'Beyond Investment Leadership',
	) );
	$cmb->add_field( array(
		'name'    => __( 'CTA Heading', 'pegasus-child' ),
		'id'      => $prefix . 'cta_heading',
		'type'    => 'text',
		'default' => 'A 21-person team supporting every position we hold.',
	) );
	$cmb->add_field( array(
		'name' => __( 'CTA Lede', 'pegasus-child' ),
		'id'   => $prefix . 'cta_lede',
		'type' => 'textarea_small',
	) );
	$cmb->add_field( array(
		'name'    => __( 'CTA Button — Text', 'pegasus-child' ),
		'id'      => $prefix . 'cta_btn_text',
		'type'    => 'text_small',
		'default' => 'Contact Investor Relations',
	) );
	$cmb->add_field( array(
		'name' => __( 'CTA Button — URL', 'pegasus-child' ),
		'id'   => $prefix . 'cta_btn_url',
		'type' => 'text_url',
	) );
}
add_action( 'cmb2_admin_init', 'pegasus_child_register_team_page_settings_metabox' );


/* ====================================================================
   §3  ABOUT PAGE  —  tpl_about.php
   ==================================================================== */

/* -----------------------------------------------------------------------
   ABOUT — Sub-hero / Page Heading
   ----------------------------------------------------------------------- */
function pegasus_child_register_about_hero_metabox() {
	$cmb = new_cmb2_box( array(
		'id'           => 'rcf_about_hero_metabox',
		'title'        => __( 'About — Sub-Hero / Page Heading', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'show_on'      => array( 'key' => 'page-template', 'value' => 'tpl_about.php' ),
		'context'      => 'normal',
		'priority'     => 'high',
	) );
	$prefix = 'rcf_about_';

	$cmb->add_field( array(
		'name' => __( 'Hero Heading', 'pegasus-child' ),
		'desc' => __( 'Main h1. Newlines become line breaks.', 'pegasus-child' ),
		'id'   => $prefix . 'hero_heading',
		'type' => 'textarea_small',
	) );
	$cmb->add_field( array(
		'name' => __( 'Hero Sub-text', 'pegasus-child' ),
		'id'   => $prefix . 'hero_sub',
		'type' => 'textarea_small',
	) );
}
add_action( 'cmb2_admin_init', 'pegasus_child_register_about_hero_metabox' );


/* -----------------------------------------------------------------------
   ABOUT — Mission Statement  (§ 01)
   ----------------------------------------------------------------------- */
function pegasus_child_register_about_mission_metabox() {
	$cmb = new_cmb2_box( array(
		'id'           => 'rcf_about_mission_metabox',
		'title'        => __( 'About — §01 Mission Statement', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'show_on'      => array( 'key' => 'page-template', 'value' => 'tpl_about.php' ),
		'context'      => 'normal',
		'priority'     => 'high',
	) );
	$prefix = 'rcf_about_mission_';

	$cmb->add_field( array(
		'name' => __( 'Aside Heading', 'pegasus-child' ),
		'id'   => $prefix . 'aside_heading',
		'type' => 'textarea_small',
	) );
	$cmb->add_field( array(
		'name' => __( 'Aside Body', 'pegasus-child' ),
		'id'   => $prefix . 'aside_body',
		'type' => 'textarea_small',
	) );
	$cmb->add_field( array(
		'name' => __( 'Body — Paragraph 1', 'pegasus-child' ),
		'id'   => $prefix . 'body_1',
		'type' => 'textarea_small',
	) );
	$cmb->add_field( array(
		'name' => __( 'Body — Paragraph 2', 'pegasus-child' ),
		'id'   => $prefix . 'body_2',
		'type' => 'textarea_small',
	) );
	$cmb->add_field( array(
		'name' => __( 'Body — Paragraph 3', 'pegasus-child' ),
		'id'   => $prefix . 'body_3',
		'type' => 'textarea_small',
	) );
}
add_action( 'cmb2_admin_init', 'pegasus_child_register_about_mission_metabox' );


/* -----------------------------------------------------------------------
   ABOUT — Stats Band  (§ 02)
   ----------------------------------------------------------------------- */
function pegasus_child_register_about_stats_metabox() {
	$cmb = new_cmb2_box( array(
		'id'           => 'rcf_about_stats_metabox',
		'title'        => __( 'About — §02 Stats Band', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'show_on'      => array( 'key' => 'page-template', 'value' => 'tpl_about.php' ),
		'context'      => 'normal',
		'priority'     => 'high',
	) );
	$prefix = 'rcf_about_stats_';

	$cmb->add_field( array(
		'name' => __( 'Section Heading', 'pegasus-child' ),
		'id'   => $prefix . 'heading',
		'type' => 'textarea_small',
	) );
	$cmb->add_field( array(
		'name' => __( 'Section Lede', 'pegasus-child' ),
		'id'   => $prefix . 'lede',
		'type' => 'textarea_small',
	) );

	$group_id = $cmb->add_field( array(
		'id'          => $prefix . 'items',
		'type'        => 'group',
		'description' => __( 'Repeatable stat items — add up to four.', 'pegasus-child' ),
		'options'     => array(
			'group_title'   => __( 'Stat {#}', 'pegasus-child' ),
			'add_button'    => __( 'Add Stat', 'pegasus-child' ),
			'remove_button' => __( 'Remove Stat', 'pegasus-child' ),
			'sortable'      => true,
			'closed'        => false,
		),
	) );
	$cmb->add_group_field( $group_id, array(
		'name' => __( 'Value (number part)', 'pegasus-child' ),
		'desc' => __( 'e.g. $1.4 or 21', 'pegasus-child' ),
		'id'   => 'value',
		'type' => 'text_small',
	) );
	$cmb->add_group_field( $group_id, array(
		'name' => __( 'Suffix (unit)', 'pegasus-child' ),
		'desc' => __( 'e.g. B, YR, %, + — leave blank if none.', 'pegasus-child' ),
		'id'   => 'suffix',
		'type' => 'text_small',
	) );
	$cmb->add_group_field( $group_id, array(
		'name' => __( 'Label (two-line description)', 'pegasus-child' ),
		'desc' => __( 'Newline creates a second line, e.g. "Assets under\nmanagement".', 'pegasus-child' ),
		'id'   => 'label',
		'type' => 'textarea_small',
	) );
}
add_action( 'cmb2_admin_init', 'pegasus_child_register_about_stats_metabox' );


/* -----------------------------------------------------------------------
   ABOUT — Trust Pillars  (§ 03)
   Bullet items use a wysiwyg field so the editor can format a UL list.
   ----------------------------------------------------------------------- */
function pegasus_child_register_about_pillars_metabox() {
	$cmb = new_cmb2_box( array(
		'id'           => 'rcf_about_pillars_metabox',
		'title'        => __( 'About — §03 Trust Pillars', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'show_on'      => array( 'key' => 'page-template', 'value' => 'tpl_about.php' ),
		'context'      => 'normal',
		'priority'     => 'high',
	) );

	$group_id = $cmb->add_field( array(
		'id'          => 'rcf_about_trust_pillars',
		'type'        => 'group',
		'description' => __( 'Repeatable trust pillars — typically 5. Each has body copy and a wysiwyg bullet list.', 'pegasus-child' ),
		'options'     => array(
			'group_title'   => __( 'Pillar {#}', 'pegasus-child' ),
			'add_button'    => __( 'Add Pillar', 'pegasus-child' ),
			'remove_button' => __( 'Remove Pillar', 'pegasus-child' ),
			'sortable'      => true,
			'closed'        => true,
		),
	) );
	$cmb->add_group_field( $group_id, array(
		'name' => __( 'Number / Roman Numeral', 'pegasus-child' ),
		'desc' => __( 'e.g. I. II. III. IV. V.', 'pegasus-child' ),
		'id'   => 'num',
		'type' => 'text_small',
	) );
	$cmb->add_group_field( $group_id, array(
		'name' => __( 'Kicker (small label above title)', 'pegasus-child' ),
		'id'   => 'kicker',
		'type' => 'text',
	) );
	$cmb->add_group_field( $group_id, array(
		'name' => __( 'Title', 'pegasus-child' ),
		'id'   => 'title',
		'type' => 'text',
	) );
	$cmb->add_group_field( $group_id, array(
		'name' => __( 'Body Paragraph 1', 'pegasus-child' ),
		'id'   => 'body_1',
		'type' => 'textarea_small',
	) );
	$cmb->add_group_field( $group_id, array(
		'name' => __( 'Body Paragraph 2', 'pegasus-child' ),
		'id'   => 'body_2',
		'type' => 'textarea_small',
	) );
	$cmb->add_group_field( $group_id, array(
		'name'    => __( 'Bullet Items (wysiwyg list)', 'pegasus-child' ),
		'desc'    => __( 'Use the editor to create a bulleted list. CSS class rcf-pillar-list is applied automatically.', 'pegasus-child' ),
		'id'      => 'items_wysiwyg',
		'type'    => 'wysiwyg',
		'options' => array(
			'textarea_rows' => 6,
			'media_buttons' => false,
		),
	) );
}
add_action( 'cmb2_admin_init', 'pegasus_child_register_about_pillars_metabox' );


/* -----------------------------------------------------------------------
   ABOUT — Service Providers  (§ 04)
   ----------------------------------------------------------------------- */
function pegasus_child_register_about_providers_metabox() {
	$cmb = new_cmb2_box( array(
		'id'           => 'rcf_about_providers_metabox',
		'title'        => __( 'About — §04 Service Providers', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'show_on'      => array( 'key' => 'page-template', 'value' => 'tpl_about.php' ),
		'context'      => 'normal',
		'priority'     => 'high',
	) );

	$group_id = $cmb->add_field( array(
		'id'          => 'rcf_about_providers',
		'type'        => 'group',
		'description' => __( 'Repeatable service provider grid cells. Use a newline in Name for two-line display.', 'pegasus-child' ),
		'options'     => array(
			'group_title'   => __( 'Provider {#}', 'pegasus-child' ),
			'add_button'    => __( 'Add Provider', 'pegasus-child' ),
			'remove_button' => __( 'Remove Provider', 'pegasus-child' ),
			'sortable'      => true,
			'closed'        => true,
		),
	) );
	$cmb->add_group_field( $group_id, array(
		'name' => __( 'Role / Category', 'pegasus-child' ),
		'desc' => __( 'e.g. Prime Broker, Auditor, Custodian', 'pegasus-child' ),
		'id'   => 'role',
		'type' => 'text',
	) );
	$cmb->add_group_field( $group_id, array(
		'name' => __( 'Provider Name', 'pegasus-child' ),
		'desc' => __( 'Use a newline to create a two-line display name.', 'pegasus-child' ),
		'id'   => 'name',
		'type' => 'textarea_small',
	) );
	$cmb->add_group_field( $group_id, array(
		'name' => __( 'Note (optional small-text beneath name)', 'pegasus-child' ),
		'id'   => 'note',
		'type' => 'text',
	) );
}
add_action( 'cmb2_admin_init', 'pegasus_child_register_about_providers_metabox' );


/* -----------------------------------------------------------------------
   ABOUT — CTA Band
   ----------------------------------------------------------------------- */
function pegasus_child_register_about_cta_metabox() {
	$cmb = new_cmb2_box( array(
		'id'           => 'rcf_about_cta_metabox',
		'title'        => __( 'About — CTA Band', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'show_on'      => array( 'key' => 'page-template', 'value' => 'tpl_about.php' ),
		'context'      => 'normal',
		'priority'     => 'high',
	) );
	$prefix = 'rcf_about_cta_';

	$cmb->add_field( array(
		'name' => __( 'Eyebrow', 'pegasus-child' ),
		'id'   => $prefix . 'eyebrow',
		'type' => 'text',
	) );
	$cmb->add_field( array(
		'name' => __( 'Heading', 'pegasus-child' ),
		'id'   => $prefix . 'heading',
		'type' => 'textarea_small',
	) );
	$cmb->add_field( array(
		'name' => __( 'Lede', 'pegasus-child' ),
		'id'   => $prefix . 'lede',
		'type' => 'textarea_small',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Button 1 — Text', 'pegasus-child' ),
		'id'      => $prefix . 'btn1_text',
		'type'    => 'text_small',
		'default' => 'Request the Diligence Pack',
	) );
	$cmb->add_field( array(
		'name' => __( 'Button 1 — URL', 'pegasus-child' ),
		'id'   => $prefix . 'btn1_url',
		'type' => 'text_url',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Button 2 — Text', 'pegasus-child' ),
		'id'      => $prefix . 'btn2_text',
		'type'    => 'text_small',
		'default' => 'Speak with IR',
	) );
	$cmb->add_field( array(
		'name' => __( 'Button 2 — URL', 'pegasus-child' ),
		'id'   => $prefix . 'btn2_url',
		'type' => 'text_url',
	) );
}
add_action( 'cmb2_admin_init', 'pegasus_child_register_about_cta_metabox' );
