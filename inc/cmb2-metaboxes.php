<?php
/**
 * CMB2 metabox registrations for the Gen2 Automation homepage
 * (tpl_schematic.php / "Homepage" template).
 *
 * Requires the CMB2 plugin to be active. If CMB2 is not loaded the
 * registration silently no-ops and the template falls back to its
 * hard-coded defaults.
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

add_action( 'cmb2_admin_init', 'gen2_register_homepage_metaboxes' );

function gen2_register_homepage_metaboxes() {
	if ( ! function_exists( 'new_cmb2_box' ) ) { return; }

	// Only show these boxes on pages assigned to the Homepage template.
	$show_on = array(
		'key'   => 'page-template',
		'value' => 'tpl_schematic.php',
	);

	/* ───── 1 — HERO SECTION ─────────────────────────────────────────── */
	$hero = new_cmb2_box( array(
		'id'           => 'gen2_hero_metabox',
		'title'        => esc_html__( '1 — Hero Section', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'context'      => 'normal',
		'priority'     => 'high',
		'show_on'      => $show_on,
	) );

	$hero->add_field( array(
		'name' => 'Subtitle / Eyebrow',
		'desc' => 'Small caps line above the headline. Maps to .gen2-schem-hero__eyebrow',
		'id'   => 'gen2_hero_subtitle',
		'type' => 'text',
	) );

	$hero->add_field( array(
		'name' => 'Title',
		'desc' => 'Main headline. Use line breaks for stacked lines. Maps to .gen2-schem-hero__title',
		'id'   => 'gen2_hero_title',
		'type' => 'textarea_small',
	) );

	$hero->add_field( array(
		'name' => 'Title Accent',
		'desc' => 'Optional copper-coloured tail rendered on its own line. Maps to .gen2-schem-hero__title-accent',
		'id'   => 'gen2_hero_title_accent',
		'type' => 'text',
	) );

	$hero->add_field( array(
		'name'    => 'Intro Body (WYSIWYG)',
		'desc'    => 'Paragraph beside the headline. Maps to .gen2-schem-hero__intro',
		'id'      => 'gen2_hero_intro',
		'type'    => 'wysiwyg',
		'options' => array( 'media_buttons' => false, 'textarea_rows' => 5 ),
	) );

	$hero->add_field( array(
		'name' => 'Primary Button — Text',
		'id'   => 'gen2_hero_btn_primary_text',
		'type' => 'text',
	) );
	$hero->add_field( array(
		'name' => 'Primary Button — URL',
		'id'   => 'gen2_hero_btn_primary_url',
		'type' => 'text_url',
	) );
	$hero->add_field( array(
		'name' => 'Secondary Button — Text',
		'id'   => 'gen2_hero_btn_secondary_text',
		'type' => 'text',
	) );
	$hero->add_field( array(
		'name' => 'Secondary Button — URL',
		'id'   => 'gen2_hero_btn_secondary_url',
		'type' => 'text_url',
	) );

	// Repeatable stats — maps to .gen2-schem-hero__stats
	$stats_group = $hero->add_field( array(
		'id'          => 'gen2_hero_stats',
		'type'        => 'group',
		'description' => 'Stat strip at the bottom of the hero. Maps to .gen2-schem-hero__stats',
		'options'     => array(
			'group_title'   => 'Stat {#}',
			'add_button'    => 'Add Stat',
			'remove_button' => 'Remove Stat',
			'sortable'      => true,
		),
	) );

	$hero->add_group_field( $stats_group, array(
		'name' => 'Number / Value',
		'desc' => 'Big copper figure (e.g. "18 yrs", "240+")',
		'id'   => 'stat_number',
		'type' => 'text',
	) );

	$hero->add_group_field( $stats_group, array(
		'name' => 'Label',
		'desc' => 'Caption beside the number (e.g. "in field")',
		'id'   => 'stat_label',
		'type' => 'text',
	) );

	/* ───── SERVICES CATALOGUE (lives on tpl_services.php, drives both the
	   Services inner page AND the Homepage's section 2) ─────────────── */
	$services = new_cmb2_box( array(
		'id'           => 'gen2_services_metabox',
		'title'        => esc_html__( 'Services Catalogue (drives Services page &amp; Homepage §2)', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'context'      => 'normal',
		'priority'     => 'high',
		'show_on'      => array(
			'key'   => 'page-template',
			'value' => 'tpl_services.php',
		),
	) );

	$services->add_field( array(
		'name' => 'Subtitle / Eyebrow',
		'desc' => 'Maps to .gen2-schem-services__doc (e.g. "§ 02 · WHAT WE DO")',
		'id'   => 'gen2_services_subtitle',
		'type' => 'text',
	) );

	$services->add_field( array(
		'name' => 'Title',
		'desc' => 'Section headline (use line breaks for stacked lines). Maps to .gen2-schem-services__title',
		'id'   => 'gen2_services_title',
		'type' => 'textarea_small',
	) );

	$services->add_field( array(
		'name' => 'Title Accent',
		'desc' => 'Optional copper-coloured tail. Maps to .gen2-schem-services__title-accent',
		'id'   => 'gen2_services_title_accent',
		'type' => 'text',
	) );

	$services->add_field( array(
		'name'    => 'Intro Body (WYSIWYG)',
		'desc'    => 'Paragraph beside the title. Maps to .gen2-schem-services__intro',
		'id'      => 'gen2_services_intro',
		'type'    => 'wysiwyg',
		'options' => array( 'media_buttons' => false, 'textarea_rows' => 4 ),
	) );

	// Repeatable service cards — maps to .gen2-schem-services__grid
	$cards_group = $services->add_field( array(
		'id'          => 'gen2_services_cards',
		'type'        => 'group',
		'description' => 'Service cards. Maps to .gen2-schem-services__grid',
		'options'     => array(
			'group_title'   => 'Service {#}',
			'add_button'    => 'Add Service Card',
			'remove_button' => 'Remove Service Card',
			'sortable'      => true,
		),
	) );

	$services->add_group_field( $cards_group, array(
		'name' => 'Code',
		'desc' => 'Short code (e.g. "S-AUT")',
		'id'   => 'card_code',
		'type' => 'text',
	) );

	$services->add_group_field( $cards_group, array(
		'name' => 'Card Title',
		'id'   => 'card_title',
		'type' => 'text',
	) );

	$services->add_group_field( $cards_group, array(
		'name' => 'Description',
		'id'   => 'card_description',
		'type' => 'textarea_small',
	) );

	$services->add_group_field( $cards_group, array(
		'name'    => 'Bullets (WYSIWYG — use a UL list)',
		'desc'    => 'Add a bulleted list. Each &lt;li&gt; renders as one styled bullet row.',
		'id'      => 'card_bullets',
		'type'    => 'wysiwyg',
		'options' => array( 'media_buttons' => false, 'textarea_rows' => 6 ),
	) );

	/* ───── 3 — INDUSTRIES SECTION ───────────────────────────────────── */
	$industries = new_cmb2_box( array(
		'id'           => 'gen2_industries_metabox',
		'title'        => esc_html__( '3 — Industries Section', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'context'      => 'normal',
		'priority'     => 'high',
		'show_on'      => $show_on,
	) );

	$industries->add_field( array(
		'name' => 'Subtitle / Eyebrow',
		'desc' => 'Doc-strip label (e.g. "§ 03 · INDUSTRIES").',
		'id'   => 'gen2_industries_subtitle',
		'type' => 'text',
	) );

	$industries->add_field( array(
		'name' => 'Title — Before Accent',
		'desc' => 'Lines above the copper accent. Use line breaks for stacked lines.',
		'id'   => 'gen2_industries_title_before',
		'type' => 'textarea_small',
	) );

	$industries->add_field( array(
		'name' => 'Title Accent',
		'desc' => 'Copper-coloured tail of the title.',
		'id'   => 'gen2_industries_title_accent',
		'type' => 'text',
	) );

	$industries->add_field( array(
		'name'    => 'Intro (WYSIWYG)',
		'desc'    => 'Optional paragraph below the title.',
		'id'      => 'gen2_industries_intro',
		'type'    => 'wysiwyg',
		'options' => array( 'media_buttons' => false, 'textarea_rows' => 4 ),
	) );

	$industries_group = $industries->add_field( array(
		'id'          => 'gen2_industries_list',
		'type'        => 'group',
		'description' => 'Industries served. Each row is one labeled cell in the grid.',
		'options'     => array(
			'group_title'   => 'Industry {#}',
			'add_button'    => 'Add Industry',
			'remove_button' => 'Remove Industry',
			'sortable'      => true,
		),
	) );

	$industries->add_group_field( $industries_group, array(
		'name' => 'Name',
		'desc' => 'e.g. "Aerospace", "Food &amp; Beverage"',
		'id'   => 'industry_name',
		'type' => 'text',
	) );

	$industries->add_group_field( $industries_group, array(
		'name' => 'Detail (optional)',
		'desc' => 'Optional short note rendered under the industry name (e.g. "Mills / Lumber" for Forestry).',
		'id'   => 'industry_detail',
		'type' => 'text',
	) );

	/* ───── 4 — CODESYS PARTNER SECTION ──────────────────────────────── */
	$codesys = new_cmb2_box( array(
		'id'           => 'gen2_codesys_metabox',
		'title'        => esc_html__( '4 — CODESYS Partner Section', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'context'      => 'normal',
		'priority'     => 'high',
		'show_on'      => $show_on,
	) );

	$codesys->add_field( array(
		'name' => 'Subtitle / Eyebrow',
		'desc' => 'First doc-strip label (e.g. "§ 03 · STRATEGIC PARTNERSHIP"). Maps to .gen2-schem-codesys__doc',
		'id'   => 'gen2_codesys_subtitle',
		'type' => 'text',
	) );

	$codesys->add_field( array(
		'name' => 'Partner Attribution',
		'desc' => 'Second doc-strip label (e.g. "CODESYS · GMBH · KEMPTEN, DE").',
		'id'   => 'gen2_codesys_partner_label',
		'type' => 'text',
	) );

	$codesys->add_field( array(
		'name' => 'Title — Before Accent',
		'desc' => 'Text rendered above the copper accent (e.g. "AUTHORIZED"). Use line breaks for stacked lines.',
		'id'   => 'gen2_codesys_title_before',
		'type' => 'textarea_small',
	) );

	$codesys->add_field( array(
		'name' => 'Title Accent',
		'desc' => 'Copper-coloured middle line (e.g. "APPLICATION").',
		'id'   => 'gen2_codesys_title_accent',
		'type' => 'text',
	) );

	$codesys->add_field( array(
		'name' => 'Title — After Accent',
		'desc' => 'Text rendered below the accent (e.g. "PARTNER.").',
		'id'   => 'gen2_codesys_title_after',
		'type' => 'textarea_small',
	) );

	$codesys->add_field( array(
		'name'    => 'Intro Body (WYSIWYG)',
		'desc'    => 'Body paragraph beside the title. Replaces the default when filled. Maps to .gen2-schem-codesys__intro',
		'id'      => 'gen2_codesys_intro',
		'type'    => 'wysiwyg',
		'options' => array( 'media_buttons' => false, 'textarea_rows' => 5 ),
	) );

	$codesys->add_field( array(
		'name' => 'Capability Pills Strip',
		'desc' => 'Single-line capability strip below the intro. e.g. "&#9656; AUTHORIZED SOLUTIONS · &#9656; CONSULTING · &#9656; TRAINING · &#9656; INTEGRATION"',
		'id'   => 'gen2_codesys_pills',
		'type' => 'textarea_small',
	) );

	$codesys->add_field( array(
		'name' => 'Schematic Caption',
		'desc' => 'Label rendered beneath the right-column schematic (e.g. "FIG. 02 · PNL-A · CODESYS RUNTIME ON CPU-1518F").',
		'id'   => 'gen2_codesys_schem_label',
		'type' => 'text',
	) );

	// Repeatable capability cells — maps to .gen2-schem-codesys__cells
	$cod_cells_group = $codesys->add_field( array(
		'id'          => 'gen2_codesys_cells',
		'type'        => 'group',
		'description' => 'Capability cells under the main partner block. Maps to .gen2-schem-codesys__cells',
		'options'     => array(
			'group_title'   => 'Cell {#}',
			'add_button'    => 'Add Cell',
			'remove_button' => 'Remove Cell',
			'sortable'      => true,
		),
	) );

	$codesys->add_group_field( $cod_cells_group, array(
		'name' => 'Cell Title',
		'id'   => 'cell_title',
		'type' => 'text',
	) );

	$codesys->add_group_field( $cod_cells_group, array(
		'name' => 'Cell Description',
		'id'   => 'cell_description',
		'type' => 'textarea_small',
	) );

	/* ───── 5 — CASE STUDY SECTION (Amazon) ──────────────────────────── */
	$case = new_cmb2_box( array(
		'id'           => 'gen2_case_metabox',
		'title'        => esc_html__( '5 — Case Study Section', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'context'      => 'normal',
		'priority'     => 'high',
		'show_on'      => $show_on,
	) );

	$case->add_field( array(
		'name' => 'Subtitle / Eyebrow',
		'desc' => 'First doc-strip label (e.g. "§ 04 · CASE STUDY").',
		'id'   => 'gen2_case_subtitle',
		'type' => 'text',
	) );

	$case->add_field( array(
		'name' => 'Client Label',
		'desc' => 'Second doc-strip label (e.g. "CLIENT: AMAZON ROBOTICS · 2024").',
		'id'   => 'gen2_case_client_label',
		'type' => 'text',
	) );

	$case->add_field( array(
		'name' => 'Featured Project Eyebrow',
		'desc' => 'Small copper line above the title (e.g. "▸ FEATURED PROJECT · BFI4 / SACRAMENTO").',
		'id'   => 'gen2_case_eyebrow',
		'type' => 'text',
	) );

	$case->add_field( array(
		'name' => 'Title Template',
		'desc' => 'Multi-line title. Use new lines for line breaks. Put <code>{{accent}}</code> where the copper accent word should appear inline.',
		'id'   => 'gen2_case_title_template',
		'type' => 'textarea_small',
	) );

	$case->add_field( array(
		'name' => 'Title Accent Word',
		'desc' => 'Copper-coloured word that replaces <code>{{accent}}</code> in the title above (e.g. "AMAZON\'S").',
		'id'   => 'gen2_case_title_accent',
		'type' => 'text',
	) );

	$case->add_field( array(
		'name'    => 'Intro Body (WYSIWYG)',
		'desc'    => 'Body paragraph beneath the title. Maps to .gen2-schem-case__intro',
		'id'      => 'gen2_case_intro',
		'type'    => 'wysiwyg',
		'options' => array( 'media_buttons' => false, 'textarea_rows' => 5 ),
	) );

	$case->add_field( array(
		'name'       => 'Hero Image',
		'desc'       => 'Optional. When set, replaces the placeholder block beneath the intro.',
		'id'         => 'gen2_case_hero_image',
		'type'       => 'file',
		'options'    => array( 'url' => false ),
		'text'       => array( 'add_upload_file_text' => 'Upload Hero Image' ),
		'query_args' => array( 'type' => array( 'image/jpeg', 'image/jpg', 'image/png', 'image/webp' ) ),
	) );

	$case->add_field( array(
		'name' => 'Hero Video URL (overrides image)',
		'desc' => 'Optional. Direct video URL (.mp4 / .webm / .mov) or a YouTube / Vimeo URL. When set, the video replaces the Hero Image above.',
		'id'   => 'gen2_case_hero_video_url',
		'type' => 'text_url',
	) );

	$case->add_field( array(
		'name' => 'Hero Image — Placeholder Label',
		'desc' => 'Shown inside the placeholder block when neither a Hero Image nor a Hero Video URL is set.',
		'id'   => 'gen2_case_hero_placeholder_label',
		'type' => 'text',
	) );

	// Repeatable stat cards in the right column.
	$case_stats_group = $case->add_field( array(
		'id'          => 'gen2_case_stats',
		'type'        => 'group',
		'description' => 'Stat cards in the right column. Counter ("01", "02", …) is auto-numbered from index.',
		'options'     => array(
			'group_title'   => 'Stat {#}',
			'add_button'    => 'Add Stat',
			'remove_button' => 'Remove Stat',
			'sortable'      => true,
		),
	) );

	$case->add_group_field( $case_stats_group, array(
		'name' => 'Label',
		'desc' => 'e.g. "DELIVERED", "TIMELINE", "THROUGHPUT"',
		'id'   => 'stat_label',
		'type' => 'text',
	) );

	$case->add_group_field( $case_stats_group, array(
		'name' => 'Value',
		'desc' => 'Big bold value (e.g. "18 cells", "6 months · concept → FAT")',
		'id'   => 'stat_value',
		'type' => 'text',
	) );

	/* ───── 6 — PROCESS SECTION ──────────────────────────────────────── */
	$process = new_cmb2_box( array(
		'id'           => 'gen2_process_metabox',
		'title'        => esc_html__( '6 — Process Section', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'context'      => 'normal',
		'priority'     => 'high',
		'show_on'      => $show_on,
	) );

	$process->add_field( array(
		'name' => 'Subtitle / Eyebrow',
		'desc' => 'Doc-strip label (e.g. "§ 05 · PROCESS · CONCEPT → COMMISSION").',
		'id'   => 'gen2_process_subtitle',
		'type' => 'text',
	) );

	$process->add_field( array(
		'name' => 'Title — Before Accent',
		'desc' => 'Lines above the copper accent (e.g. "A REPEATABLE"). Use line breaks for stacked lines.',
		'id'   => 'gen2_process_title_before',
		'type' => 'textarea_small',
	) );

	$process->add_field( array(
		'name' => 'Title Accent',
		'desc' => 'Copper-coloured tail of the title (e.g. "SIX-STEP DELIVERY.").',
		'id'   => 'gen2_process_title_accent',
		'type' => 'text',
	) );

	// Repeatable process steps — drive both the schematic flow SVG labels
	// and the step cards beneath it.
	$process_steps_group = $process->add_field( array(
		'id'          => 'gen2_process_steps',
		'type'        => 'group',
		'description' => 'Process steps. Step labels populate both the schematic flow SVG and the cards beneath it. Numbering is auto-generated.',
		'options'     => array(
			'group_title'   => 'Step {#}',
			'add_button'    => 'Add Step',
			'remove_button' => 'Remove Step',
			'sortable'      => true,
		),
	) );

	$process->add_group_field( $process_steps_group, array(
		'name' => 'Step Name',
		'desc' => 'Short label rendered in the SVG and the card heading (e.g. "DISCOVERY").',
		'id'   => 'step_name',
		'type' => 'text',
	) );

	$process->add_group_field( $process_steps_group, array(
		'name' => 'Step Description',
		'id'   => 'step_description',
		'type' => 'textarea_small',
	) );

	/* ───── 7 — MANUFACTURERS / CLIENT LOGOS ─────────────────────────── */
	$mfg = new_cmb2_box( array(
		'id'           => 'gen2_manufacturers_metabox',
		'title'        => esc_html__( '7 — Manufacturers / Client Logos Strip', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'context'      => 'normal',
		'priority'     => 'high',
		'show_on'      => $show_on,
	) );

	$mfg->add_field( array(
		'name' => 'Strip Label',
		'desc' => 'Small caption above the logo row. Maps to .gen2-schem-logos__label',
		'id'   => 'gen2_manufacturers_label',
		'type' => 'text',
	) );

	$mfg_logos_group = $mfg->add_field( array(
		'id'          => 'gen2_manufacturers_logos',
		'type'        => 'group',
		'description' => 'Client / manufacturer logos. Upload an image or just enter a wordmark — image wins if both are set. 6 logos look best in the row.',
		'options'     => array(
			'group_title'   => 'Logo {#}',
			'add_button'    => 'Add Logo',
			'remove_button' => 'Remove Logo',
			'sortable'      => true,
		),
	) );

	$mfg->add_group_field( $mfg_logos_group, array(
		'name'       => 'Logo Image',
		'desc'       => 'Optional. SVG, PNG, or JPG. Used as the rendered logo when set.',
		'id'         => 'logo_image',
		'type'       => 'file',
		'options'    => array( 'url' => false ),
		'text'       => array( 'add_upload_file_text' => 'Upload Logo' ),
		'query_args' => array( 'type' => array( 'image/jpeg', 'image/jpg', 'image/png', 'image/webp', 'image/svg+xml' ) ),
	) );

	$mfg->add_group_field( $mfg_logos_group, array(
		'name' => 'Name / Wordmark',
		'desc' => 'Used as the image alt attribute. If no Logo Image is uploaded, this name is rendered as a text wordmark.',
		'id'   => 'logo_name',
		'type' => 'text',
	) );

	$mfg->add_group_field( $mfg_logos_group, array(
		'name'    => 'Link URL',
		'desc'    => 'Optional. If set, the logo wraps in a link.',
		'id'      => 'logo_url',
		'type'    => 'text_url',
		'default' => '',
	) );

	/* ───── 8 — LEADERSHIP / TEAM SECTION ───────────────────────────── */
	$team = new_cmb2_box( array(
		'id'           => 'gen2_team_metabox',
		'title'        => esc_html__( '8 — Leadership Section', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'context'      => 'normal',
		'priority'     => 'high',
		'show_on'      => $show_on,
	) );

	$team->add_field( array(
		'name' => 'Subtitle / Eyebrow',
		'desc' => 'Doc-strip label (e.g. "§ 06 · LEADERSHIP").',
		'id'   => 'gen2_team_subtitle',
		'type' => 'text',
	) );

	$team->add_field( array(
		'name' => 'Title — Before Accent',
		'desc' => 'Lines above the copper accent (e.g. "ENGINEERS").',
		'id'   => 'gen2_team_title_before',
		'type' => 'textarea_small',
	) );

	$team->add_field( array(
		'name' => 'Title Accent',
		'desc' => 'Copper-coloured tail of the title (e.g. "ON THE FLOOR.").',
		'id'   => 'gen2_team_title_accent',
		'type' => 'text',
	) );

	$team->add_field( array(
		'name'    => 'Intro Body (WYSIWYG)',
		'desc'    => 'Paragraph beside the title.',
		'id'      => 'gen2_team_intro',
		'type'    => 'wysiwyg',
		'options' => array( 'media_buttons' => false, 'textarea_rows' => 4 ),
	) );

	$team_members_group = $team->add_field( array(
		'id'          => 'gen2_team_members',
		'type'        => 'group',
		'description' => 'Team / leadership cards. 4 members look best in the row.',
		'options'     => array(
			'group_title'   => 'Member {#}',
			'add_button'    => 'Add Member',
			'remove_button' => 'Remove Member',
			'sortable'      => true,
		),
	) );

	$team->add_group_field( $team_members_group, array(
		'name'       => 'Portrait Photo',
		'desc'       => 'Optional. Square crop works best. Falls back to a striped placeholder when empty.',
		'id'         => 'member_photo',
		'type'       => 'file',
		'options'    => array( 'url' => false ),
		'text'       => array( 'add_upload_file_text' => 'Upload Portrait' ),
		'query_args' => array( 'type' => array( 'image/jpeg', 'image/jpg', 'image/png', 'image/webp' ) ),
	) );

	$team->add_group_field( $team_members_group, array(
		'name' => 'Name',
		'id'   => 'member_name',
		'type' => 'text',
	) );

	$team->add_group_field( $team_members_group, array(
		'name' => 'Role',
		'desc' => 'e.g. "Founder · Principal Controls"',
		'id'   => 'member_role',
		'type' => 'text',
	) );

	$team->add_group_field( $team_members_group, array(
		'name' => 'Credentials',
		'desc' => 'Small copper line beneath the role (e.g. "M.Sc EECS · 22 yrs").',
		'id'   => 'member_credentials',
		'type' => 'text',
	) );

	/* ───── 9 — CALL-TO-ACTION SECTION ───────────────────────────────── */
	$cta = new_cmb2_box( array(
		'id'           => 'gen2_cta_metabox',
		'title'        => esc_html__( '9 — Call-to-Action Section', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'context'      => 'normal',
		'priority'     => 'high',
		'show_on'      => $show_on,
	) );

	$cta->add_field( array(
		'name' => 'Title — Before Underline',
		'desc' => 'Lines above the underlined word. Use line breaks for stacked lines (e.g. "LET\'S BUILD\nSOMETHING").',
		'id'   => 'gen2_cta_title_before',
		'type' => 'textarea_small',
	) );

	$cta->add_field( array(
		'name' => 'Title — Underlined Word',
		'desc' => 'Rendered on the final line with the bold underline (e.g. "HEAVY.").',
		'id'   => 'gen2_cta_title_underline',
		'type' => 'text',
	) );

	$cta->add_field( array(
		'name'    => 'Lead Text (WYSIWYG)',
		'desc'    => 'Short paragraph beside the title. Maps to .gen2-schem-cta__lead',
		'id'      => 'gen2_cta_lead',
		'type'    => 'wysiwyg',
		'options' => array( 'media_buttons' => false, 'textarea_rows' => 4 ),
	) );

	$cta->add_field( array(
		'name' => 'Button — Text',
		'id'   => 'gen2_cta_btn_text',
		'type' => 'text',
	) );

	$cta->add_field( array(
		'name' => 'Button — URL',
		'id'   => 'gen2_cta_btn_url',
		'type' => 'text_url',
	) );

	$cta->add_field( array(
		'name' => 'Contact Line',
		'desc' => 'Phone / email line under the button (e.g. "(503) 555-0142 · HELLO@GEN2AUTOMATION.COM").',
		'id'   => 'gen2_cta_contact',
		'type' => 'text',
	) );

	/* ───── SERVICES PAGE — TOP SECTION ──────────────────────────────── */
	$svc_page = new_cmb2_box( array(
		'id'           => 'gen2_svc_page_top_metabox',
		'title'        => esc_html__( 'Services Page — Top Section', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'context'      => 'normal',
		'priority'     => 'high',
		'show_on'      => array(
			'key'   => 'page-template',
			'value' => 'tpl_services.php',
		),
	) );

	$svc_page->add_field( array(
		'name' => 'Huge Title',
		'desc' => 'Large display headline. HTML is allowed — use <code>&lt;br&gt;</code> for line breaks and <code>&lt;em&gt;…&lt;/em&gt;</code> to render a copper-coloured italic accent (e.g. <em>We make it run.</em>).',
		'id'   => 'gen2_svc_page_title',
		'type' => 'textarea_small',
	) );

	$svc_page->add_field( array(
		'name'    => 'Intro Content (WYSIWYG)',
		'desc'    => 'Paragraph beside the headline.',
		'id'      => 'gen2_svc_page_intro',
		'type'    => 'wysiwyg',
		'options' => array( 'media_buttons' => false, 'textarea_rows' => 5 ),
	) );

	/* ═════════════════════════════════════════════════════════════════════
	   EXPERIENCE PAGE  (tpl_experience.php)
	   ═════════════════════════════════════════════════════════════════════ */
	$exp_show_on = array(
		'key'   => 'page-template',
		'value' => 'tpl_experience.php',
	);

	/* ───── EXP 1 — HERO ──────────────────────────────────────────────── */
	$exp_hero = new_cmb2_box( array(
		'id'           => 'gen2_exp_hero_metabox',
		'title'        => esc_html__( 'Experience — 1 · Hero', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'context'      => 'normal',
		'priority'     => 'high',
		'show_on'      => $exp_show_on,
	) );
	$exp_hero->add_field( array( 'name' => 'Subtitle / Eyebrow', 'id' => 'gen2_exp_hero_subtitle',     'type' => 'text' ) );
	$exp_hero->add_field( array( 'name' => 'Title — Before Accent', 'desc' => 'Use line breaks for stacked lines.', 'id' => 'gen2_exp_hero_title_before', 'type' => 'textarea_small' ) );
	$exp_hero->add_field( array( 'name' => 'Title Accent', 'id' => 'gen2_exp_hero_title_accent', 'type' => 'text' ) );
	$exp_hero->add_field( array( 'name' => 'Intro (WYSIWYG)', 'id' => 'gen2_exp_hero_intro', 'type' => 'wysiwyg', 'options' => array( 'media_buttons' => false, 'textarea_rows' => 4 ) ) );

	/* ───── EXP 2 — PROJECTS & SHOWCASES ─────────────────────────────── */
	$exp_proj = new_cmb2_box( array(
		'id'           => 'gen2_exp_projects_metabox',
		'title'        => esc_html__( 'Experience — 2 · Projects &amp; Showcases', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'context'      => 'normal',
		'priority'     => 'high',
		'show_on'      => $exp_show_on,
	) );
	$exp_proj->add_field( array( 'name' => 'Subtitle / Eyebrow', 'id' => 'gen2_exp_projects_subtitle',     'type' => 'text' ) );
	$exp_proj->add_field( array( 'name' => 'Title — Before Accent', 'id' => 'gen2_exp_projects_title_before', 'type' => 'textarea_small' ) );
	$exp_proj->add_field( array( 'name' => 'Title Accent', 'id' => 'gen2_exp_projects_title_accent', 'type' => 'text' ) );
	$exp_proj->add_field( array( 'name' => 'Intro (WYSIWYG)', 'id' => 'gen2_exp_projects_intro', 'type' => 'wysiwyg', 'options' => array( 'media_buttons' => false, 'textarea_rows' => 4 ) ) );

	$exp_proj_group = $exp_proj->add_field( array(
		'id'          => 'gen2_exp_projects_items',
		'type'        => 'group',
		'description' => 'Repeatable showcase cards. Each item renders a card with image, title, client, and short description.',
		'options'     => array(
			'group_title'   => 'Project / Showcase {#}',
			'add_button'    => 'Add Project',
			'remove_button' => 'Remove Project',
			'sortable'      => true,
		),
	) );
	$exp_proj->add_group_field( $exp_proj_group, array(
		'name'       => 'Image',
		'desc'       => 'Optional. Falls back to a striped placeholder when empty.',
		'id'         => 'project_image',
		'type'       => 'file',
		'options'    => array( 'url' => false ),
		'text'       => array( 'add_upload_file_text' => 'Upload Project Image' ),
		'query_args' => array( 'type' => array( 'image/jpeg', 'image/jpg', 'image/png', 'image/webp' ) ),
	) );
	$exp_proj->add_group_field( $exp_proj_group, array( 'name' => 'Title',           'id' => 'project_title',       'type' => 'text' ) );
	$exp_proj->add_group_field( $exp_proj_group, array( 'name' => 'Client / Tag',    'desc' => 'Small line above the title (e.g. "AMAZON ROBOTICS · 2024").', 'id' => 'project_client', 'type' => 'text' ) );
	$exp_proj->add_group_field( $exp_proj_group, array( 'name' => 'Description',     'id' => 'project_description', 'type' => 'textarea_small' ) );
	$exp_proj->add_group_field( $exp_proj_group, array( 'name' => 'Link URL (opt.)', 'id' => 'project_link_url',    'type' => 'text_url' ) );
	$exp_proj->add_group_field( $exp_proj_group, array( 'name' => 'Link Label (opt.)','id' => 'project_link_label',  'type' => 'text' ) );

	/* ───── EXP 3 — PLATFORMS WE HAVE EXPERIENCE ON ──────────────────── */
	$exp_plat = new_cmb2_box( array(
		'id'           => 'gen2_exp_platforms_metabox',
		'title'        => esc_html__( 'Experience — 3 · Platforms', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'context'      => 'normal',
		'priority'     => 'high',
		'show_on'      => $exp_show_on,
	) );
	$exp_plat->add_field( array( 'name' => 'Subtitle / Eyebrow', 'id' => 'gen2_exp_platforms_subtitle',     'type' => 'text' ) );
	$exp_plat->add_field( array( 'name' => 'Title — Before Accent', 'id' => 'gen2_exp_platforms_title_before', 'type' => 'textarea_small' ) );
	$exp_plat->add_field( array( 'name' => 'Title Accent', 'id' => 'gen2_exp_platforms_title_accent', 'type' => 'text' ) );
	$exp_plat->add_field( array( 'name' => 'Intro (WYSIWYG)', 'id' => 'gen2_exp_platforms_intro', 'type' => 'wysiwyg', 'options' => array( 'media_buttons' => false, 'textarea_rows' => 4 ) ) );

	$exp_plat_group = $exp_plat->add_field( array(
		'id'          => 'gen2_exp_platforms_categories',
		'type'        => 'group',
		'description' => 'Platform categories (Controllers, Robotic Arms, HMI / SCADA, …). Each renders a card; items within each card are entered as a single textarea — <strong>one item per line</strong> — and rendered as styled chips.',
		'options'     => array(
			'group_title'   => 'Category {#}',
			'add_button'    => 'Add Category',
			'remove_button' => 'Remove Category',
			'sortable'      => true,
		),
	) );
	$exp_plat->add_group_field( $exp_plat_group, array( 'name' => 'Category Title',    'desc' => 'e.g. "Controllers", "Robotic Arms", "HMI / SCADA"', 'id' => 'category_title',    'type' => 'text' ) );
	$exp_plat->add_group_field( $exp_plat_group, array( 'name' => 'Category Subtitle (opt.)', 'id' => 'category_subtitle', 'type' => 'text' ) );
	$exp_plat->add_group_field( $exp_plat_group, array(
		'name' => 'Items (one per line)',
		'desc' => 'List of brands / software / tools — one per line. Each becomes a styled chip in the card.',
		'id'   => 'category_items',
		'type' => 'textarea_small',
	) );

	/* ───── EXP 4 — CODESYS CALLOUT ──────────────────────────────────── */
	$exp_cod = new_cmb2_box( array(
		'id'           => 'gen2_exp_codesys_metabox',
		'title'        => esc_html__( 'Experience — 4 · CODESYS Callout', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'context'      => 'normal',
		'priority'     => 'high',
		'show_on'      => $exp_show_on,
	) );
	$exp_cod->add_field( array( 'name' => 'Subtitle / Eyebrow', 'id' => 'gen2_exp_codesys_subtitle',     'type' => 'text' ) );
	$exp_cod->add_field( array( 'name' => 'Title — Before Accent', 'id' => 'gen2_exp_codesys_title_before', 'type' => 'textarea_small' ) );
	$exp_cod->add_field( array( 'name' => 'Title Accent', 'id' => 'gen2_exp_codesys_title_accent', 'type' => 'text' ) );
	$exp_cod->add_field( array( 'name' => 'Body (WYSIWYG)', 'id' => 'gen2_exp_codesys_body', 'type' => 'wysiwyg', 'options' => array( 'media_buttons' => false, 'textarea_rows' => 6 ) ) );

	/* ───── EXP 5 — PROJECT MANAGEMENT ───────────────────────────────── */
	$exp_pm = new_cmb2_box( array(
		'id'           => 'gen2_exp_pm_metabox',
		'title'        => esc_html__( 'Experience — 5 · Project Management', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'context'      => 'normal',
		'priority'     => 'high',
		'show_on'      => $exp_show_on,
	) );
	$exp_pm->add_field( array( 'name' => 'Subtitle / Eyebrow', 'id' => 'gen2_exp_pm_subtitle',     'type' => 'text' ) );
	$exp_pm->add_field( array( 'name' => 'Title — Before Accent', 'id' => 'gen2_exp_pm_title_before', 'type' => 'textarea_small' ) );
	$exp_pm->add_field( array( 'name' => 'Title Accent', 'id' => 'gen2_exp_pm_title_accent', 'type' => 'text' ) );
	$exp_pm->add_field( array( 'name' => 'Body (WYSIWYG)', 'desc' => 'Use a bulleted list if you want chip-style highlights below the paragraph.', 'id' => 'gen2_exp_pm_body', 'type' => 'wysiwyg', 'options' => array( 'media_buttons' => false, 'textarea_rows' => 6 ) ) );
}

/**
 * Tiny helpers that the template uses to render the CMB2 values.
 */

if ( ! function_exists( 'gen2_meta' ) ) {
/** Get a single post-meta value with a fallback. */
function gen2_meta( $key, $fallback = '', $post_id = 0 ) {
	$post_id = $post_id ?: get_the_ID();
	$value   = get_post_meta( $post_id, $key, true );
	return ( '' === $value || null === $value ) ? $fallback : $value;
}
}

if ( ! function_exists( 'gen2_meta_group' ) ) {
/** Get a group field array with a fallback. */
function gen2_meta_group( $key, $fallback = array(), $post_id = 0 ) {
	$post_id = $post_id ?: get_the_ID();
	$value   = get_post_meta( $post_id, $key, true );
	return ( is_array( $value ) && ! empty( $value ) ) ? $value : $fallback;
}
}

if ( ! function_exists( 'gen2_render_lines' ) ) {
/** Echo a multi-line text value with newlines converted to <br>. */
function gen2_render_lines( $text ) {
	echo nl2br( esc_html( trim( $text ) ) );
}
}

if ( ! function_exists( 'gen2_render_wysiwyg' ) ) {
/** Echo a stored CMB2 wysiwyg value through the_content filter. */
function gen2_render_wysiwyg( $html ) {
	echo apply_filters( 'the_content', $html );
}
}

if ( ! function_exists( 'gen2_get_page_by_template' ) ) {
/**
 * Generic helper: find the first published page assigned to a given Page
 * Template file. Results are cached per request per template.
 */
function gen2_get_page_by_template( $template_file ) {
	static $cache = array();
	if ( isset( $cache[ $template_file ] ) ) { return $cache[ $template_file ]; }

	// Prefer WordPress's static front-page setting when it matches the
	// requested template (covers the common Homepage case).
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

if ( ! function_exists( 'gen2_get_homepage_id' ) ) {
function gen2_get_homepage_id() { return gen2_get_page_by_template( 'tpl_schematic.php' ); }
}

if ( ! function_exists( 'gen2_get_services_page_id' ) ) {
/** Locate the page that holds the Services CMB2 data (the canonical
 *  services catalogue, shared by tpl_schematic.php §2 and tpl_services.php). */
function gen2_get_services_page_id() { return gen2_get_page_by_template( 'tpl_services.php' ); }
}

if ( ! function_exists( 'gen2_meta_from' ) ) {
/** Read a meta value from a specific page id, with a fallback. */
function gen2_meta_from( $key, $page_id, $fallback = '' ) {
	if ( ! $page_id ) { return $fallback; }
	$value = get_post_meta( $page_id, $key, true );
	return ( '' === $value || null === $value ) ? $fallback : $value;
}
}

if ( ! function_exists( 'gen2_meta_group_from' ) ) {
/** Read a group field from a specific page id, with a fallback. */
function gen2_meta_group_from( $key, $page_id, $fallback = array() ) {
	if ( ! $page_id ) { return $fallback; }
	$value = get_post_meta( $page_id, $key, true );
	return ( is_array( $value ) && ! empty( $value ) ) ? $value : $fallback;
}
}
