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

	/* ───── 2 — SERVICES SECTION ─────────────────────────────────────── */
	$services = new_cmb2_box( array(
		'id'           => 'gen2_services_metabox',
		'title'        => esc_html__( '2 — Services Section', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'context'      => 'normal',
		'priority'     => 'high',
		'show_on'      => $show_on,
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

	/* ───── 3 — CODESYS PARTNER SECTION ──────────────────────────────── */
	$codesys = new_cmb2_box( array(
		'id'           => 'gen2_codesys_metabox',
		'title'        => esc_html__( '3 — CODESYS Partner Section', 'pegasus-child' ),
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

	/* ───── 4 — CASE STUDY SECTION (Amazon) ──────────────────────────── */
	$case = new_cmb2_box( array(
		'id'           => 'gen2_case_metabox',
		'title'        => esc_html__( '4 — Case Study Section', 'pegasus-child' ),
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

	/* ───── 5 — PROCESS SECTION ──────────────────────────────────────── */
	$process = new_cmb2_box( array(
		'id'           => 'gen2_process_metabox',
		'title'        => esc_html__( '5 — Process Section', 'pegasus-child' ),
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

	/* ───── MANUFACTURERS / CLIENT LOGOS ─────────────────────────────── */
	$mfg = new_cmb2_box( array(
		'id'           => 'gen2_manufacturers_metabox',
		'title'        => esc_html__( 'Manufacturers / Client Logos Strip', 'pegasus-child' ),
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

	/* ───── 6 — LEADERSHIP / TEAM SECTION ───────────────────────────── */
	$team = new_cmb2_box( array(
		'id'           => 'gen2_team_metabox',
		'title'        => esc_html__( '6 — Leadership Section', 'pegasus-child' ),
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

	/* ───── 7 — CALL-TO-ACTION SECTION ───────────────────────────────── */
	$cta = new_cmb2_box( array(
		'id'           => 'gen2_cta_metabox',
		'title'        => esc_html__( '7 — Call-to-Action Section', 'pegasus-child' ),
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

	$svc_page->add_field( array(
		'name'        => 'Service Cards Source',
		'desc'        => 'The service list shown below is pulled from the homepage\'s "2 — Services Section" repeater. To edit which services appear here, edit the page that uses the <strong>Homepage</strong> (tpl_schematic.php) template.',
		'id'          => 'gen2_svc_page_source_note',
		'type'        => 'title',
	) );
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

if ( ! function_exists( 'gen2_get_homepage_id' ) ) {
/**
 * Locate the page that holds the Gen2 homepage CMB2 data so other templates
 * (e.g. tpl_services.php) can pull from the same single source of truth.
 *
 * Order:
 *   1. WordPress's static front-page setting (Settings → Reading).
 *   2. The first published page assigned to tpl_schematic.php.
 *
 * Cached per request to avoid repeating the meta query.
 */
function gen2_get_homepage_id() {
	static $cache = null;
	if ( null !== $cache ) { return $cache; }

	$front = (int) get_option( 'page_on_front' );
	if ( $front && 'tpl_schematic.php' === get_page_template_slug( $front ) ) {
		return $cache = $front;
	}

	$pages = get_posts( array(
		'post_type'      => 'page',
		'post_status'    => 'publish',
		'posts_per_page' => 1,
		'fields'         => 'ids',
		'meta_query'     => array(
			array(
				'key'   => '_wp_page_template',
				'value' => 'tpl_schematic.php',
			),
		),
	) );

	return $cache = ! empty( $pages ) ? (int) $pages[0] : 0;
}
}
