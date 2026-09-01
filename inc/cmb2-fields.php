<?php
/**
 * Rice Capital Fund — CMB2 Metabox Registrations
 *
 * All page-template metaboxes live here, grouped by template.
 * This file is required from functions.php.
 *
 * Templates covered:
 *   §1  tpl_home.php   — Hero, Pillars, Philosophy, Process, Leadership, CTA
 *   §2  tpl_team.php   — Team Members, Page Settings
 *   §3  tpl_about.php  — Hero, Mission, Stats, Trust Pillars, Providers, CTA
 *   §4  tpl_contact.php — Sub-Hero, Reach Us (details + form), Channels, Disclaimer
 *   §5  tpl_investment-approach.php — Sub-Hero, Overview, Lenses, Process, CTA
 *   §6  Posts page (home.php) — Blog Sub-Hero
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
		'title'        => __( 'Home — §01 Hero Section', 'pegasus-child' ),
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
		'name'    => __( 'Button 1 — CSS Classes', 'pegasus-child' ),
		'desc'    => __( 'Space-separated CSS classes. Base: rcf-btn. Variants: rcf-btn--light &amp; rcf-btn--outline-light (dark/navy sections), rcf-btn--ghost (light sections).', 'pegasus-child' ),
		'id'      => 'rcf_hero_btn1_class',
		'type'    => 'text',
		'default' => 'rcf-btn rcf-btn--light',
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
	$cmb->add_field( array(
		'name'    => __( 'Button 2 — CSS Classes', 'pegasus-child' ),
		'desc'    => __( 'Space-separated CSS classes. Base: rcf-btn. Variants: rcf-btn--light &amp; rcf-btn--outline-light (dark/navy sections), rcf-btn--ghost (light sections).', 'pegasus-child' ),
		'id'      => 'rcf_hero_btn2_class',
		'type'    => 'text',
		'default' => 'rcf-btn rcf-btn--outline-light',
	) );
}
add_action( 'cmb2_admin_init', 'pegasus_child_register_home_hero_metabox' );


/* -----------------------------------------------------------------------
   HOME — Pillars Section (icon + content columns)
   ----------------------------------------------------------------------- */
function pegasus_child_register_home_pillars_metabox() {
	$prefix = 'rcf_home_pillars_';

	$cmb = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => __( 'Home — §02 Pillars Section', 'pegasus-child' ),
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
   HOME — Investment Philosophy (Tenets)
   ----------------------------------------------------------------------- */
function pegasus_child_register_home_philosophy_metabox() {
	$prefix = 'rcf_philosophy_';

	$cmb = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => __( 'Home — §03 Investment Philosophy Section', 'pegasus-child' ),
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
		'title'        => __( 'Home — §04 How We Invest / Process Section', 'pegasus-child' ),
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
   HOME — Leadership Preview (informational — powered by the Team page)
   ----------------------------------------------------------------------- */
function pegasus_child_register_home_leadership_metabox() {
	$cmb = new_cmb2_box( array(
		'id'           => 'rcf_home_leadership_metabox',
		'title'        => __( 'Home — §05 Leadership Section', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'show_on'      => array( 'key' => 'page-template', 'value' => 'tpl_home.php' ),
		'context'      => 'normal',
		'priority'     => 'high',
	) );

	// Build a link to edit the Team page, if one exists.
	$team_pages = get_posts( array(
		'post_type'      => 'page',
		'posts_per_page' => 1,
		'meta_query'     => array(
			array( 'key' => '_wp_page_template', 'value' => 'tpl_team.php' ),
		),
	) );
	// get_edit_post_link() can return null (e.g. before edit caps are resolved),
	// so guard it — never pass null to esc_url().
	$edit_link = ! empty( $team_pages ) ? get_edit_post_link( $team_pages[0]->ID ) : '';

	if ( $edit_link ) {
		$desc = sprintf(
			/* translators: %s: URL to edit the Team page. */
			__( 'This section has no fields of its own. It automatically displays the first three members from the <strong>Team page</strong>, in the order they are listed there. To change who appears or their order, <a href="%s">edit the Team page &rarr; Team — Members</a> and drag members to reorder.', 'pegasus-child' ),
			esc_url( $edit_link )
		);
	} elseif ( ! empty( $team_pages ) ) {
		$desc = __( 'This section has no fields of its own. It automatically displays the first three members from the <strong>Team page</strong>, in the order they are listed there. To change who appears or their order, edit the Team page &rarr; Team — Members and drag members to reorder.', 'pegasus-child' );
	} else {
		$desc = __( 'This section has no fields of its own. It automatically displays the first three members from the <strong>Team page</strong> (the page using the "Team" template), in the order they are listed there. No Team page exists yet — create one using the Team template to populate this section.', 'pegasus-child' );
	}

	$cmb->add_field( array(
		'name' => __( 'Powered by the Team page', 'pegasus-child' ),
		'desc' => $desc,
		'id'   => 'rcf_home_leadership_info',
		'type' => 'title',
	) );
}
add_action( 'cmb2_admin_init', 'pegasus_child_register_home_leadership_metabox' );


/* -----------------------------------------------------------------------
   HOME — CTA Band
   ----------------------------------------------------------------------- */
function pegasus_child_register_home_cta_metabox() {
	$prefix = 'rcf_home_cta_';

	$cmb = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => __( 'Home — §06 CTA Band', 'pegasus-child' ),
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
		'name'    => __( 'Button 1 — CSS Classes', 'pegasus-child' ),
		'desc'    => __( 'Space-separated CSS classes. Base: rcf-btn. Variants: rcf-btn--light &amp; rcf-btn--outline-light (dark/navy sections), rcf-btn--ghost (light sections).', 'pegasus-child' ),
		'id'      => $prefix . 'btn1_class',
		'type'    => 'text',
		'default' => 'rcf-btn rcf-btn--light',
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
	$cmb->add_field( array(
		'name'    => __( 'Button 2 — CSS Classes', 'pegasus-child' ),
		'desc'    => __( 'Space-separated CSS classes. Base: rcf-btn. Variants: rcf-btn--light &amp; rcf-btn--outline-light (dark/navy sections), rcf-btn--ghost (light sections).', 'pegasus-child' ),
		'id'      => $prefix . 'btn2_class',
		'type'    => 'text',
		'default' => 'rcf-btn rcf-btn--outline-light',
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
	$cmb->add_field( array(
		'name'    => __( 'CTA Button — CSS Classes', 'pegasus-child' ),
		'desc'    => __( 'Space-separated CSS classes. Base: rcf-btn. Variants: rcf-btn--light &amp; rcf-btn--outline-light (dark/navy sections), rcf-btn--ghost (light sections).', 'pegasus-child' ),
		'id'      => $prefix . 'cta_btn_class',
		'type'    => 'text',
		'default' => 'rcf-btn rcf-btn--light',
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
		'name'    => __( 'Button 1 — CSS Classes', 'pegasus-child' ),
		'desc'    => __( 'Space-separated CSS classes. Base: rcf-btn. Variants: rcf-btn--light &amp; rcf-btn--outline-light (dark/navy sections), rcf-btn--ghost (light sections).', 'pegasus-child' ),
		'id'      => $prefix . 'btn1_class',
		'type'    => 'text',
		'default' => 'rcf-btn rcf-btn--light',
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
	$cmb->add_field( array(
		'name'    => __( 'Button 2 — CSS Classes', 'pegasus-child' ),
		'desc'    => __( 'Space-separated CSS classes. Base: rcf-btn. Variants: rcf-btn--light &amp; rcf-btn--outline-light (dark/navy sections), rcf-btn--ghost (light sections).', 'pegasus-child' ),
		'id'      => $prefix . 'btn2_class',
		'type'    => 'text',
		'default' => 'rcf-btn rcf-btn--outline-light',
	) );
}
add_action( 'cmb2_admin_init', 'pegasus_child_register_about_cta_metabox' );


/* ====================================================================
   §4  CONTACT PAGE  —  tpl_contact.php
   ==================================================================== */

/* -----------------------------------------------------------------------
   CONTACT — Sub-Hero / Page Heading
   ----------------------------------------------------------------------- */
function pegasus_child_register_contact_hero_metabox() {
	$cmb = new_cmb2_box( array(
		'id'           => 'rcf_contact_hero_metabox',
		'title'        => __( 'Contact — Sub-Hero / Page Heading', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'show_on'      => array( 'key' => 'page-template', 'value' => 'tpl_contact.php' ),
		'context'      => 'normal',
		'priority'     => 'high',
	) );

	$cmb->add_field( array(
		'name'    => __( 'Heading', 'pegasus-child' ),
		'desc'    => __( 'Use newlines for line breaks.', 'pegasus-child' ),
		'id'      => 'rcf_contact_hero_heading',
		'type'    => 'textarea_small',
		'default' => "Begin a\nconversation.",
	) );
	$cmb->add_field( array(
		'name'    => __( 'Sub-heading Paragraph', 'pegasus-child' ),
		'id'      => 'rcf_contact_hero_sub',
		'type'    => 'textarea_small',
		'default' => 'Request the current strategy presentation, arrange an introductory call, or direct a question to the appropriate desk. Every inquiry is reviewed personally by a member of the firm.',
	) );
}
add_action( 'cmb2_admin_init', 'pegasus_child_register_contact_hero_metabox' );


/* -----------------------------------------------------------------------
   CONTACT — §01 Reach Us (contact details + message form)
   ----------------------------------------------------------------------- */
function pegasus_child_register_contact_reach_metabox() {
	$cmb = new_cmb2_box( array(
		'id'           => 'rcf_contact_reach_metabox',
		'title'        => __( 'Contact — §01 Reach Us (details + form)', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'show_on'      => array( 'key' => 'page-template', 'value' => 'tpl_contact.php' ),
		'context'      => 'normal',
		'priority'     => 'high',
	) );

	$cmb->add_field( array(
		'name' => __( 'Contact Details', 'pegasus-child' ),
		'desc' => __( 'The left-hand column: eyebrow, heading, intro, and contact points.', 'pegasus-child' ),
		'id'   => 'rcf_contact_details_title',
		'type' => 'title',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Eyebrow', 'pegasus-child' ),
		'id'      => 'rcf_contact_eyebrow',
		'type'    => 'text',
		'default' => 'Investor Relations',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Aside Heading', 'pegasus-child' ),
		'desc'    => __( 'Use newlines for line breaks.', 'pegasus-child' ),
		'id'      => 'rcf_contact_aside_heading',
		'type'    => 'textarea_small',
		'default' => "Speak directly\nwith our IR team.",
	) );
	$cmb->add_field( array(
		'name'    => __( 'Aside Body', 'pegasus-child' ),
		'id'      => 'rcf_contact_aside_body',
		'type'    => 'textarea_small',
		'default' => 'We hold every conversation in confidence and respond to qualified inquiries within one business day. For time-sensitive matters, please call the office directly.',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Email Address', 'pegasus-child' ),
		'id'      => 'rcf_contact_email',
		'type'    => 'text_email',
		'default' => 'info@ricecapitalfund.com',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Phone (display)', 'pegasus-child' ),
		'id'      => 'rcf_contact_phone',
		'type'    => 'text_medium',
		'default' => '404.555.0123',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Phone (dial string)', 'pegasus-child' ),
		'desc'    => __( 'Digits only, used for the tel: link. E.g. 4045550123', 'pegasus-child' ),
		'id'      => 'rcf_contact_phone_link',
		'type'    => 'text_medium',
		'default' => '4045550123',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Office Address', 'pegasus-child' ),
		'desc'    => __( 'Use newlines for line breaks.', 'pegasus-child' ),
		'id'      => 'rcf_contact_address',
		'type'    => 'textarea_small',
		'default' => "1180 Peachtree Street NE\nSuite 2400\nAtlanta, Georgia 30309",
	) );
	$cmb->add_field( array(
		'name'    => __( 'Office Hours', 'pegasus-child' ),
		'id'      => 'rcf_contact_hours',
		'type'    => 'text',
		'default' => "Monday\xe2\x80\x93Friday \xc2\xb7 9:00am\xe2\x80\x935:00pm ET",
	) );

	$cmb->add_field( array(
		'name' => __( 'Message Form', 'pegasus-child' ),
		'desc' => __( 'The right-hand form card. Leave the shortcode empty to use the built-in styled form; submissions are emailed to the recipient below.', 'pegasus-child' ),
		'id'   => 'rcf_contact_form_title',
		'type' => 'title',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Form Heading', 'pegasus-child' ),
		'id'      => 'rcf_contact_form_heading',
		'type'    => 'text',
		'default' => 'Send a secure message',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Recipient Email', 'pegasus-child' ),
		'desc'    => __( 'Where built-in form submissions are delivered. Falls back to the site admin email if left blank.', 'pegasus-child' ),
		'id'      => 'rcf_contact_form_recipient',
		'type'    => 'text_email',
		'default' => 'info@ricecapitalfund.com',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Success Message', 'pegasus-child' ),
		'id'      => 'rcf_contact_form_success',
		'type'    => 'textarea_small',
		'default' => 'Thank you — your message has been received. A member of our Investor Relations team will be in touch shortly.',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Fine-print Note (under the button)', 'pegasus-child' ),
		'id'      => 'rcf_contact_form_note',
		'type'    => 'textarea_small',
		'default' => 'This form is intended for prospective and existing qualified investors. Submitting it does not create an investment advisory relationship, and nothing on this page constitutes an offer to sell or a solicitation to buy any security.',
	) );
	$cmb->add_field( array(
		'name' => __( 'Form Shortcode (optional override)', 'pegasus-child' ),
		'desc' => __( 'Paste a Contact Form 7 / Gravity Forms / WPForms shortcode to replace the built-in form. Leave blank to use the built-in form.', 'pegasus-child' ),
		'id'   => 'rcf_contact_form_shortcode',
		'type' => 'text',
	) );
}
add_action( 'cmb2_admin_init', 'pegasus_child_register_contact_reach_metabox' );


/* -----------------------------------------------------------------------
   CONTACT — §02 Contact Channels (repeatable)
   ----------------------------------------------------------------------- */
function pegasus_child_register_contact_channels_metabox() {
	$cmb = new_cmb2_box( array(
		'id'           => 'rcf_contact_channels_metabox',
		'title'        => __( 'Contact — §02 Contact Channels', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'show_on'      => array( 'key' => 'page-template', 'value' => 'tpl_contact.php' ),
		'context'      => 'normal',
		'priority'     => 'high',
	) );

	$group_id = $cmb->add_field( array(
		'id'          => 'rcf_contact_channels',
		'type'        => 'group',
		'description' => __( 'Direct-line cards below the form — typically three. Repeatable.', 'pegasus-child' ),
		'options'     => array(
			'group_title'   => __( 'Channel {#}', 'pegasus-child' ),
			'add_button'    => __( 'Add Channel', 'pegasus-child' ),
			'remove_button' => __( 'Remove Channel', 'pegasus-child' ),
			'sortable'      => true,
			'closed'        => true,
		),
	) );
	$cmb->add_group_field( $group_id, array(
		'name' => __( 'Font Awesome 4 Icon Class', 'pegasus-child' ),
		'desc' => __( 'Icon class without the leading "fa fa-". E.g. line-chart, envelope-o, newspaper-o.', 'pegasus-child' ),
		'id'   => 'icon',
		'type' => 'text',
	) );
	$cmb->add_group_field( $group_id, array(
		'name' => __( 'Label', 'pegasus-child' ),
		'id'   => 'label',
		'type' => 'text',
	) );
	$cmb->add_group_field( $group_id, array(
		'name' => __( 'Detail (email or phone)', 'pegasus-child' ),
		'desc' => __( 'If a valid email is entered it becomes a mailto: link automatically.', 'pegasus-child' ),
		'id'   => 'detail',
		'type' => 'text',
	) );
	$cmb->add_group_field( $group_id, array(
		'name' => __( 'Note', 'pegasus-child' ),
		'id'   => 'note',
		'type' => 'textarea_small',
	) );
}
add_action( 'cmb2_admin_init', 'pegasus_child_register_contact_channels_metabox' );


/* -----------------------------------------------------------------------
   CONTACT — Closing Disclaimer Band
   ----------------------------------------------------------------------- */
function pegasus_child_register_contact_cta_metabox() {
	$cmb = new_cmb2_box( array(
		'id'           => 'rcf_contact_cta_metabox',
		'title'        => __( 'Contact — Closing Disclaimer Band', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'show_on'      => array( 'key' => 'page-template', 'value' => 'tpl_contact.php' ),
		'context'      => 'normal',
		'priority'     => 'high',
	) );

	$cmb->add_field( array(
		'name'    => __( 'Eyebrow', 'pegasus-child' ),
		'id'      => 'rcf_contact_cta_eyebrow',
		'type'    => 'text',
		'default' => 'For Qualified Investors Only',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Heading', 'pegasus-child' ),
		'id'      => 'rcf_contact_cta_heading',
		'type'    => 'text',
		'default' => 'Access to fund materials is restricted.',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Lede Paragraph', 'pegasus-child' ),
		'id'      => 'rcf_contact_cta_lede',
		'type'    => 'textarea_small',
		'default' => 'Detailed performance, offering documents, and operational due-diligence materials are made available only to verified qualified purchasers and institutional investors under NDA. Please identify your investor category when you write.',
	) );
}
add_action( 'cmb2_admin_init', 'pegasus_child_register_contact_cta_metabox' );


/* ====================================================================
   §5  INVESTMENT APPROACH  —  tpl_investment-approach.php
   ==================================================================== */

/* -----------------------------------------------------------------------
   INVESTMENT APPROACH — Sub-Hero / Page Heading
   ----------------------------------------------------------------------- */
function pegasus_child_register_ia_hero_metabox() {
	$cmb = new_cmb2_box( array(
		'id'           => 'rcf_ia_hero_metabox',
		'title'        => __( 'Approach — Sub-Hero / Page Heading', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'show_on'      => array( 'key' => 'page-template', 'value' => 'tpl_investment-approach.php' ),
		'context'      => 'normal',
		'priority'     => 'high',
	) );

	$cmb->add_field( array(
		'name'    => __( 'Heading', 'pegasus-child' ),
		'desc'    => __( 'Use newlines for line breaks.', 'pegasus-child' ),
		'id'      => 'rcf_ia_hero_heading',
		'type'    => 'textarea_small',
		'default' => "A multi-strategy approach\nfocused on risk and reward.",
	) );
	$cmb->add_field( array(
		'name'    => __( 'Sub-heading Paragraph', 'pegasus-child' ),
		'id'      => 'rcf_ia_hero_sub',
		'type'    => 'textarea_small',
		'default' => 'Research driven. Risk aware. Opportunistic. A disciplined framework for finding asymmetry across public markets — and protecting capital when the odds turn.',
	) );
}
add_action( 'cmb2_admin_init', 'pegasus_child_register_ia_hero_metabox' );


/* -----------------------------------------------------------------------
   INVESTMENT APPROACH — §01 Overview
   ----------------------------------------------------------------------- */
function pegasus_child_register_ia_overview_metabox() {
	$cmb = new_cmb2_box( array(
		'id'           => 'rcf_ia_overview_metabox',
		'title'        => __( 'Approach — §01 Overview', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'show_on'      => array( 'key' => 'page-template', 'value' => 'tpl_investment-approach.php' ),
		'context'      => 'normal',
		'priority'     => 'high',
	) );

	$cmb->add_field( array(
		'name'    => __( 'Eyebrow', 'pegasus-child' ),
		'id'      => 'rcf_ia_overview_eyebrow',
		'type'    => 'text',
		'default' => 'Our Approach',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Heading', 'pegasus-child' ),
		'desc'    => __( 'Use newlines for line breaks.', 'pegasus-child' ),
		'id'      => 'rcf_ia_overview_heading',
		'type'    => 'textarea_small',
		'default' => "Research driven.\nRisk aware.\nOpportunistic.",
	) );
	$cmb->add_field( array(
		'name'    => __( 'Body Paragraph 1', 'pegasus-child' ),
		'id'      => 'rcf_ia_overview_body_1',
		'type'    => 'textarea_small',
		'default' => 'Rice Capital evaluates opportunities across public markets using fundamentals, valuation, technical structure, macro conditions, liquidity, and catalysts.',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Body Paragraph 2', 'pegasus-child' ),
		'id'      => 'rcf_ia_overview_body_2',
		'type'    => 'textarea_small',
		'default' => 'The objective is to identify attractive risk/reward opportunities while maintaining a strong focus on portfolio construction, drawdown control, and capital preservation.',
	) );
}
add_action( 'cmb2_admin_init', 'pegasus_child_register_ia_overview_metabox' );


/* -----------------------------------------------------------------------
   INVESTMENT APPROACH — §02 What We Evaluate (lenses, repeatable)
   ----------------------------------------------------------------------- */
function pegasus_child_register_ia_lenses_metabox() {
	$cmb = new_cmb2_box( array(
		'id'           => 'rcf_ia_lenses_metabox',
		'title'        => __( 'Approach — §02 What We Evaluate', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'show_on'      => array( 'key' => 'page-template', 'value' => 'tpl_investment-approach.php' ),
		'context'      => 'normal',
		'priority'     => 'high',
	) );

	$cmb->add_field( array(
		'name'    => __( 'Eyebrow', 'pegasus-child' ),
		'id'      => 'rcf_ia_lenses_eyebrow',
		'type'    => 'text',
		'default' => 'What We Evaluate',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Heading', 'pegasus-child' ),
		'id'      => 'rcf_ia_lenses_heading',
		'type'    => 'text',
		'default' => 'Six lenses on every position.',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Lede Paragraph', 'pegasus-child' ),
		'id'      => 'rcf_ia_lenses_lede',
		'type'    => 'textarea_small',
		'default' => 'No single factor earns a position a place in the book. Each opportunity is pressure-tested across the same six dimensions before it is sized.',
	) );

	$group_id = $cmb->add_field( array(
		'id'          => 'rcf_ia_lenses',
		'type'        => 'group',
		'description' => __( 'Evaluation lenses — displayed as a card grid. Repeatable.', 'pegasus-child' ),
		'options'     => array(
			'group_title'   => __( 'Lens {#}', 'pegasus-child' ),
			'add_button'    => __( 'Add Lens', 'pegasus-child' ),
			'remove_button' => __( 'Remove Lens', 'pegasus-child' ),
			'sortable'      => true,
			'closed'        => true,
		),
	) );
	$cmb->add_group_field( $group_id, array(
		'name' => __( 'Label', 'pegasus-child' ),
		'id'   => 'label',
		'type' => 'text',
	) );
	$cmb->add_group_field( $group_id, array(
		'name' => __( 'Description', 'pegasus-child' ),
		'id'   => 'desc',
		'type' => 'textarea_small',
	) );
}
add_action( 'cmb2_admin_init', 'pegasus_child_register_ia_lenses_metabox' );


/* -----------------------------------------------------------------------
   INVESTMENT APPROACH — §03 The Process (repeatable steps)
   ----------------------------------------------------------------------- */
function pegasus_child_register_ia_process_metabox() {
	$cmb = new_cmb2_box( array(
		'id'           => 'rcf_ia_process_metabox',
		'title'        => __( 'Approach — §03 The Process', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'show_on'      => array( 'key' => 'page-template', 'value' => 'tpl_investment-approach.php' ),
		'context'      => 'normal',
		'priority'     => 'high',
	) );

	$cmb->add_field( array(
		'name'    => __( 'Eyebrow', 'pegasus-child' ),
		'id'      => 'rcf_ia_process_eyebrow',
		'type'    => 'text',
		'default' => 'The Process',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Heading', 'pegasus-child' ),
		'desc'    => __( 'Use newlines for line breaks.', 'pegasus-child' ),
		'id'      => 'rcf_ia_process_heading',
		'type'    => 'textarea_small',
		'default' => "From idea to position,\nby a repeatable path.",
	) );
	$cmb->add_field( array(
		'name'    => __( 'Lede Paragraph', 'pegasus-child' ),
		'id'      => 'rcf_ia_process_lede',
		'type'    => 'textarea_small',
		'default' => 'Every position travels the same four stages — deliberate at the front end, disciplined at the back.',
	) );

	$group_id = $cmb->add_field( array(
		'id'          => 'rcf_ia_process_steps',
		'type'        => 'group',
		'description' => __( 'Process steps — typically four, in a ruled navy grid. Repeatable.', 'pegasus-child' ),
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
add_action( 'cmb2_admin_init', 'pegasus_child_register_ia_process_metabox' );


/* -----------------------------------------------------------------------
   INVESTMENT APPROACH — CTA Band
   ----------------------------------------------------------------------- */
function pegasus_child_register_ia_cta_metabox() {
	$cmb = new_cmb2_box( array(
		'id'           => 'rcf_ia_cta_metabox',
		'title'        => __( 'Approach — CTA Band', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'show_on'      => array( 'key' => 'page-template', 'value' => 'tpl_investment-approach.php' ),
		'context'      => 'normal',
		'priority'     => 'high',
	) );

	$cmb->add_field( array(
		'name'    => __( 'Eyebrow', 'pegasus-child' ),
		'id'      => 'rcf_ia_cta_eyebrow',
		'type'    => 'text',
		'default' => 'For Qualified Investors',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Heading', 'pegasus-child' ),
		'id'      => 'rcf_ia_cta_heading',
		'type'    => 'text',
		'default' => 'See the approach applied.',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Lede Paragraph', 'pegasus-child' ),
		'id'      => 'rcf_ia_cta_lede',
		'type'    => 'textarea_small',
		'default' => 'Request the current strategy presentation, or speak with our Investor Relations team about how the process translates into the live portfolio.',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Button 1 — Text', 'pegasus-child' ),
		'id'      => 'rcf_ia_cta_btn1_text',
		'type'    => 'text_small',
		'default' => 'Request the Deck',
	) );
	$cmb->add_field( array(
		'name' => __( 'Button 1 — URL', 'pegasus-child' ),
		'id'   => 'rcf_ia_cta_btn1_url',
		'type' => 'text_url',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Button 1 — CSS Classes', 'pegasus-child' ),
		'desc'    => __( 'Space-separated CSS classes. Base: rcf-btn. Variants: rcf-btn--light &amp; rcf-btn--outline-light (dark/navy sections), rcf-btn--ghost (light sections).', 'pegasus-child' ),
		'id'      => 'rcf_ia_cta_btn1_class',
		'type'    => 'text',
		'default' => 'rcf-btn rcf-btn--light',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Button 2 — Text', 'pegasus-child' ),
		'id'      => 'rcf_ia_cta_btn2_text',
		'type'    => 'text_small',
		'default' => 'Speak with IR',
	) );
	$cmb->add_field( array(
		'name' => __( 'Button 2 — URL', 'pegasus-child' ),
		'id'   => 'rcf_ia_cta_btn2_url',
		'type' => 'text_url',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Button 2 — CSS Classes', 'pegasus-child' ),
		'desc'    => __( 'Space-separated CSS classes. Base: rcf-btn. Variants: rcf-btn--light &amp; rcf-btn--outline-light (dark/navy sections), rcf-btn--ghost (light sections).', 'pegasus-child' ),
		'id'      => 'rcf_ia_cta_btn2_class',
		'type'    => 'text',
		'default' => 'rcf-btn rcf-btn--outline-light',
	) );
}
add_action( 'cmb2_admin_init', 'pegasus_child_register_ia_cta_metabox' );


/* ====================================================================
   §6  POSTS PAGE (BLOG)  —  home.php
   The posts page ignores its template dropdown, so target it by ID.
   ==================================================================== */

/* -----------------------------------------------------------------------
   BLOG — Sub-Hero / Page Heading (shown on the "Posts page")
   ----------------------------------------------------------------------- */
function pegasus_child_register_blog_hero_metabox() {
	$posts_page_id = (int) get_option( 'page_for_posts' );
	if ( ! $posts_page_id ) {
		return; // No posts page assigned under Settings → Reading.
	}

	$cmb = new_cmb2_box( array(
		'id'           => 'rcf_blog_hero_metabox',
		'title'        => __( 'Blog — Sub-Hero / Page Heading', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'show_on'      => array( 'key' => 'id', 'value' => array( $posts_page_id ) ),
		'context'      => 'normal',
		'priority'     => 'high',
	) );

	$cmb->add_field( array(
		'name'    => __( 'Heading', 'pegasus-child' ),
		'desc'    => __( 'Heading shown at the top of the blog / news listing.', 'pegasus-child' ),
		'id'      => 'rcf_blog_hero_heading',
		'type'    => 'text',
		'default' => 'News & Insights',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Sub-heading Paragraph', 'pegasus-child' ),
		'id'      => 'rcf_blog_hero_sub',
		'type'    => 'textarea_small',
		'default' => 'Commentary, firm updates, and perspective from the Rice Capital investment team.',
	) );
}
add_action( 'cmb2_admin_init', 'pegasus_child_register_blog_hero_metabox' );
