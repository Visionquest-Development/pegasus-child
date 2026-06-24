<?php
/**
 * CMB2 metaboxes for the OSPS26 home + services templates.
 *
 * Boxes are scoped to their template via the `show_on` filter so they
 * only appear on pages using tpl_home.php or tpl_services.php.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'osps_register_home_metaboxes' ) ) {

	function osps_register_home_metaboxes() {

		$prefix = 'osps_home_';
		$show   = array( 'key' => 'page-template', 'value' => 'tpl_home.php' );

		/* ----- Section 01 — Hero ----- */
		$hero = new_cmb2_box( array(
			'id'           => $prefix . 'sec01_hero',
			'title'        => __( 'Section 01 — Hero', 'pegasus-child' ),
			'object_types' => array( 'page' ),
			'show_on'      => $show,
			'context'      => 'normal',
			'priority'     => 'high',
			'closed'       => true,
		) );
		$hero->add_field( array(
			'name'    => __( 'Eyebrow', 'pegasus-child' ),
			'id'      => $prefix . 'hero_eyebrow',
			'type'    => 'text',
			'default' => 'Medical Physics · Imaging Compliance',
		) );
		$hero->add_field( array(
			'name'    => __( 'Headline (line 1)', 'pegasus-child' ),
			'id'      => $prefix . 'hero_h1_line1',
			'type'    => 'text',
			'default' => 'Diagnostic imaging,',
		) );
		$hero->add_field( array(
			'name'    => __( 'Headline (accent line 2)', 'pegasus-child' ),
			'id'      => $prefix . 'hero_h1_line2',
			'type'    => 'text',
			'default' => 'measured to perfection.',
		) );
		$hero->add_field( array(
			'name'    => __( 'Lead paragraph', 'pegasus-child' ),
			'id'      => $prefix . 'hero_lead',
			'type'    => 'textarea',
			'default' => 'Independent medical physics for hospitals and imaging centers — Mammography, CT, MRI, Nuclear Medicine and more. We keep your systems accredited, your patients safe, and your operations audit-ready.',
		) );
		$hero->add_field( array(
			'name'    => __( 'Primary button label', 'pegasus-child' ),
			'id'      => $prefix . 'hero_btn_primary_label',
			'type'    => 'text',
			'default' => 'Request a Consultation',
		) );
		$hero->add_field( array(
			'name'    => __( 'Primary button URL', 'pegasus-child' ),
			'id'      => $prefix . 'hero_btn_primary_url',
			'type'    => 'text_url',
			'default' => '#contact',
		) );
		$hero->add_field( array(
			'name'    => __( 'Secondary button label', 'pegasus-child' ),
			'id'      => $prefix . 'hero_btn_secondary_label',
			'type'    => 'text',
			'default' => 'Explore Services',
		) );
		$hero->add_field( array(
			'name'    => __( 'Secondary button URL', 'pegasus-child' ),
			'id'      => $prefix . 'hero_btn_secondary_url',
			'type'    => 'text_url',
			'default' => '/services/',
		) );

		$hero_stat = $hero->add_field( array(
			'id'      => $prefix . 'hero_stats',
			'type'    => 'group',
			'name'    => __( 'Hero stat items', 'pegasus-child' ),
			'options' => array(
				'group_title'   => __( 'Stat {#}', 'pegasus-child' ),
				'add_button'    => __( 'Add stat', 'pegasus-child' ),
				'remove_button' => __( 'Remove stat', 'pegasus-child' ),
				'sortable'      => true,
				'closed'        => true,
			),
		) );
		$hero->add_group_field( $hero_stat, array(
			'name' => __( 'Number', 'pegasus-child' ),
			'id'   => 'number',
			'type' => 'text',
		) );
		$hero->add_group_field( $hero_stat, array(
			'name' => __( 'Label', 'pegasus-child' ),
			'id'   => 'label',
			'type' => 'text',
		) );

		/* ----- Section 02 — Trust Strip ----- */
		$trust = new_cmb2_box( array(
			'id'           => $prefix . 'sec02_trust',
			'title'        => __( 'Section 02 — Trust Strip', 'pegasus-child' ),
			'object_types' => array( 'page' ),
			'show_on'      => $show,
			'closed'       => true,
		) );
		$trust->add_field( array(
			'name'    => __( 'Label', 'pegasus-child' ),
			'id'      => $prefix . 'trust_label',
			'type'    => 'text',
			'default' => 'Accreditation expertise across',
		) );
		$trust->add_field( array(
			'name'       => __( 'Cert chips', 'pegasus-child' ),
			'id'         => $prefix . 'trust_chips',
			'type'       => 'text',
			'repeatable' => true,
			'options'    => array(
				'add_row_text' => __( 'Add chip', 'pegasus-child' ),
			),
		) );

		/* ----- Section 03 — Modalities ----- */
		$mods = new_cmb2_box( array(
			'id'           => $prefix . 'sec03_modalities',
			'title'        => __( 'Section 03 — Modalities', 'pegasus-child' ),
			'object_types' => array( 'page' ),
			'show_on'      => $show,
			'closed'       => true,
		) );
		$mods->add_field( array(
			'name'    => __( 'Eyebrow', 'pegasus-child' ),
			'id'      => $prefix . 'mod_eyebrow',
			'type'    => 'text',
			'default' => 'What we test',
		) );
		$mods->add_field( array(
			'name'    => __( 'Section title', 'pegasus-child' ),
			'id'      => $prefix . 'mod_title',
			'type'    => 'text',
			'default' => 'Physics support for every imaging modality',
		) );
		$mods->add_field( array(
			'name'    => __( 'Intro paragraph', 'pegasus-child' ),
			'id'      => $prefix . 'mod_intro',
			'type'    => 'textarea_small',
			'default' => 'Annual surveys, equipment evaluations, and ongoing QC — performed by board-certified physicists.',
		) );
		$mod_item = $mods->add_field( array(
			'id'      => $prefix . 'mod_items',
			'type'    => 'group',
			'name'    => __( 'Modality cards', 'pegasus-child' ),
			'options' => array(
				'group_title'   => __( 'Modality {#}', 'pegasus-child' ),
				'add_button'    => __( 'Add modality', 'pegasus-child' ),
				'remove_button' => __( 'Remove modality', 'pegasus-child' ),
				'sortable'      => true,
				'closed'        => true,
			),
		) );
		$mods->add_group_field( $mod_item, array(
			'name'    => __( 'Icon', 'pegasus-child' ),
			'id'      => 'icon',
			'type'    => 'select',
			'options' => osps_modality_icon_options(),
			'default' => 'mammography',
		) );
		$mods->add_group_field( $mod_item, array(
			'name' => __( 'Title', 'pegasus-child' ),
			'id'   => 'title',
			'type' => 'text',
		) );
		$mods->add_group_field( $mod_item, array(
			'name' => __( 'Description', 'pegasus-child' ),
			'id'   => 'desc',
			'type' => 'textarea_small',
		) );

		/* ----- Section 04 — Services Overview ----- */
		$svc = new_cmb2_box( array(
			'id'           => $prefix . 'sec04_services',
			'title'        => __( 'Section 04 — Services Overview', 'pegasus-child' ),
			'object_types' => array( 'page' ),
			'show_on'      => $show,
			'closed'       => true,
		) );
		$svc->add_field( array(
			'name'    => __( 'Eyebrow', 'pegasus-child' ),
			'id'      => $prefix . 'svc_eyebrow',
			'type'    => 'text',
			'default' => 'Core services',
		) );
		$svc->add_field( array(
			'name'    => __( 'Section title', 'pegasus-child' ),
			'id'      => $prefix . 'svc_title',
			'type'    => 'text',
			'default' => 'One partner for compliance, safety & design',
		) );
		$svc->add_field( array(
			'name'    => __( '"View all" link text', 'pegasus-child' ),
			'id'      => $prefix . 'svc_link_text',
			'type'    => 'text',
			'default' => 'View all services',
		) );
		$svc->add_field( array(
			'name'    => __( '"View all" link URL', 'pegasus-child' ),
			'id'      => $prefix . 'svc_link_url',
			'type'    => 'text_url',
			'default' => '/services/',
		) );
		$svc_item = $svc->add_field( array(
			'id'      => $prefix . 'svc_items',
			'type'    => 'group',
			'name'    => __( 'Service cards', 'pegasus-child' ),
			'options' => array(
				'group_title'   => __( 'Service {#}', 'pegasus-child' ),
				'add_button'    => __( 'Add service', 'pegasus-child' ),
				'remove_button' => __( 'Remove service', 'pegasus-child' ),
				'sortable'      => true,
				'closed'        => true,
			),
		) );
		$svc->add_group_field( $svc_item, array(
			'name'    => __( 'Icon', 'pegasus-child' ),
			'id'      => 'icon',
			'type'    => 'select',
			'options' => osps_service_icon_options(),
			'default' => 'accreditation',
		) );
		$svc->add_group_field( $svc_item, array(
			'name' => __( 'Title', 'pegasus-child' ),
			'id'   => 'title',
			'type' => 'text',
		) );
		$svc->add_group_field( $svc_item, array(
			'name' => __( 'Description', 'pegasus-child' ),
			'id'   => 'desc',
			'type' => 'textarea_small',
		) );
		$svc->add_group_field( $svc_item, array(
			'name' => __( 'Tag', 'pegasus-child' ),
			'id'   => 'tag',
			'type' => 'text',
		) );
		$svc->add_group_field( $svc_item, array(
			'name' => __( 'Link URL', 'pegasus-child' ),
			'id'   => 'url',
			'type' => 'text_url',
		) );

		$svc->add_field( array(
			'name'    => __( 'Closing card — title', 'pegasus-child' ),
			'id'      => $prefix . 'svc_cta_title',
			'type'    => 'text',
			'default' => 'Not sure where to start?',
		) );
		$svc->add_field( array(
			'name'    => __( 'Closing card — description', 'pegasus-child' ),
			'id'      => $prefix . 'svc_cta_desc',
			'type'    => 'textarea_small',
			'default' => "Tell us your equipment and deadlines — we'll map the exact testing and documentation you need.",
		) );
		$svc->add_field( array(
			'name'    => __( 'Closing card — button label', 'pegasus-child' ),
			'id'      => $prefix . 'svc_cta_btn_label',
			'type'    => 'text',
			'default' => 'Talk to a physicist',
		) );
		$svc->add_field( array(
			'name'    => __( 'Closing card — button URL', 'pegasus-child' ),
			'id'      => $prefix . 'svc_cta_btn_url',
			'type'    => 'text_url',
			'default' => '#contact',
		) );

		/* ----- Section 05 — Why Us / Stats Band ----- */
		$why = new_cmb2_box( array(
			'id'           => $prefix . 'sec05_why',
			'title'        => __( 'Section 05 — Why Us / Stats Band', 'pegasus-child' ),
			'object_types' => array( 'page' ),
			'show_on'      => $show,
			'closed'       => true,
		) );
		$why->add_field( array(
			'name'    => __( 'Eyebrow', 'pegasus-child' ),
			'id'      => $prefix . 'why_eyebrow',
			'type'    => 'text',
			'default' => 'Why One Stop',
		) );
		$why->add_field( array(
			'name'    => __( 'Heading', 'pegasus-child' ),
			'id'      => $prefix . 'why_heading',
			'type'    => 'text',
			'default' => "Founded by a medical physicist who's been in your shoes",
		) );
		$why->add_field( array(
			'name'    => __( 'Lead paragraph', 'pegasus-child' ),
			'id'      => $prefix . 'why_lead',
			'type'    => 'textarea',
			'default' => 'One Stop Physics Service was founded by a medical physicist who understands the challenges healthcare providers face today. We deliver diagnostic physics compliance that reduces risk and protects your reputation.',
		) );
		$why->add_field( array(
			'name'    => __( 'Button label', 'pegasus-child' ),
			'id'      => $prefix . 'why_btn_label',
			'type'    => 'text',
			'default' => 'See how we work',
		) );
		$why->add_field( array(
			'name'    => __( 'Button URL', 'pegasus-child' ),
			'id'      => $prefix . 'why_btn_url',
			'type'    => 'text_url',
			'default' => '/services/',
		) );
		$big_stat = $why->add_field( array(
			'id'      => $prefix . 'why_stats',
			'type'    => 'group',
			'name'    => __( 'Big stats', 'pegasus-child' ),
			'options' => array(
				'group_title'   => __( 'Stat {#}', 'pegasus-child' ),
				'add_button'    => __( 'Add stat', 'pegasus-child' ),
				'remove_button' => __( 'Remove stat', 'pegasus-child' ),
				'sortable'      => true,
				'closed'        => true,
			),
		) );
		$why->add_group_field( $big_stat, array(
			'name' => __( 'Number', 'pegasus-child' ),
			'id'   => 'number',
			'type' => 'text',
		) );
		$why->add_group_field( $big_stat, array(
			'name' => __( 'Unit suffix', 'pegasus-child' ),
			'id'   => 'unit',
			'type' => 'text',
		) );
		$why->add_group_field( $big_stat, array(
			'name' => __( 'Label', 'pegasus-child' ),
			'id'   => 'label',
			'type' => 'text',
		) );

		/* ----- Section 06 — Certifications ----- */
		$cert = new_cmb2_box( array(
			'id'           => $prefix . 'sec06_certs',
			'title'        => __( 'Section 06 — Certifications', 'pegasus-child' ),
			'object_types' => array( 'page' ),
			'show_on'      => $show,
			'closed'       => true,
		) );
		$cert->add_field( array(
			'name'    => __( 'Eyebrow', 'pegasus-child' ),
			'id'      => $prefix . 'cert_eyebrow',
			'type'    => 'text',
			'default' => 'Credentials you can trust',
		) );
		$cert->add_field( array(
			'name'    => __( 'Section title', 'pegasus-child' ),
			'id'      => $prefix . 'cert_title',
			'type'    => 'text',
			'default' => 'Board-certified expertise',
		) );
		$cert->add_field( array(
			'name'    => __( 'Intro paragraph', 'pegasus-child' ),
			'id'      => $prefix . 'cert_intro',
			'type'    => 'textarea_small',
			'default' => 'Our physicists hold the highest certifications in the field, so your reports stand up to any surveyor or regulator.',
		) );
		$cert_row = $cert->add_field( array(
			'id'      => $prefix . 'cert_rows',
			'type'    => 'group',
			'name'    => __( 'Cert rows', 'pegasus-child' ),
			'options' => array(
				'group_title'   => __( 'Cert {#}', 'pegasus-child' ),
				'add_button'    => __( 'Add cert', 'pegasus-child' ),
				'remove_button' => __( 'Remove cert', 'pegasus-child' ),
				'sortable'      => true,
				'closed'        => true,
			),
		) );
		$cert->add_group_field( $cert_row, array(
			'name' => __( 'Title', 'pegasus-child' ),
			'id'   => 'title',
			'type' => 'text',
		) );
		$cert->add_group_field( $cert_row, array(
			'name' => __( 'Sub-title', 'pegasus-child' ),
			'id'   => 'sub',
			'type' => 'text',
		) );

		$cert->add_field( array(
			'name'    => __( 'Accreditation tiles label', 'pegasus-child' ),
			'id'      => $prefix . 'accr_label',
			'type'    => 'text',
			'default' => 'We help you achieve & maintain accreditation with',
		) );
		$accr_tile = $cert->add_field( array(
			'id'      => $prefix . 'accr_tiles',
			'type'    => 'group',
			'name'    => __( 'Accreditation tiles', 'pegasus-child' ),
			'options' => array(
				'group_title'   => __( 'Tile {#}', 'pegasus-child' ),
				'add_button'    => __( 'Add tile', 'pegasus-child' ),
				'remove_button' => __( 'Remove tile', 'pegasus-child' ),
				'sortable'      => true,
				'closed'        => true,
			),
		) );
		$cert->add_group_field( $accr_tile, array(
			'name' => __( 'Monogram', 'pegasus-child' ),
			'id'   => 'mono',
			'type' => 'text',
		) );
		$cert->add_group_field( $accr_tile, array(
			'name' => __( 'Full name', 'pegasus-child' ),
			'id'   => 'full',
			'type' => 'text',
		) );

		$cert->add_field( array(
			'name'    => __( 'Trailing card — title', 'pegasus-child' ),
			'id'      => $prefix . 'cert_card_title',
			'type'    => 'text',
			'default' => 'Survey-ready documentation, every time',
		) );
		$cert->add_field( array(
			'name'    => __( 'Trailing card — description', 'pegasus-child' ),
			'id'      => $prefix . 'cert_card_desc',
			'type'    => 'textarea_small',
			'default' => 'Every visit ends with a clear, defensible report — corrective actions flagged, tolerances charted, and ready to hand to any surveyor.',
		) );

		/* ----- Section 07 — CTA ----- */
		$cta = new_cmb2_box( array(
			'id'           => $prefix . 'sec07_cta',
			'title'        => __( 'Section 07 — CTA', 'pegasus-child' ),
			'object_types' => array( 'page' ),
			'show_on'      => $show,
			'closed'       => true,
		) );
		$cta->add_field( array(
			'name'    => __( 'Eyebrow', 'pegasus-child' ),
			'id'      => $prefix . 'cta_eyebrow',
			'type'    => 'text',
			'default' => 'Get started',
		) );
		$cta->add_field( array(
			'name'    => __( 'Heading', 'pegasus-child' ),
			'id'      => $prefix . 'cta_heading',
			'type'    => 'text',
			'default' => 'Ready to keep your imaging program audit-ready?',
		) );
		$cta->add_field( array(
			'name'    => __( 'Lead paragraph', 'pegasus-child' ),
			'id'      => $prefix . 'cta_lead',
			'type'    => 'textarea',
			'default' => "Send us your equipment list and deadlines. We'll respond with a clear scope, timeline and quote — usually within one business day.",
		) );
		$cta->add_field( array(
			'name'    => __( 'Primary button label', 'pegasus-child' ),
			'id'      => $prefix . 'cta_btn1_label',
			'type'    => 'text',
			'default' => 'Call (813) 743-2373',
		) );
		$cta->add_field( array(
			'name'    => __( 'Primary button URL', 'pegasus-child' ),
			'id'      => $prefix . 'cta_btn1_url',
			'type'    => 'text',
			'default' => 'tel:+18137432373',
		) );
		$cta->add_field( array(
			'name'    => __( 'Secondary button label', 'pegasus-child' ),
			'id'      => $prefix . 'cta_btn2_label',
			'type'    => 'text',
			'default' => 'Request a Consultation',
		) );
		$cta->add_field( array(
			'name'    => __( 'Secondary button URL', 'pegasus-child' ),
			'id'      => $prefix . 'cta_btn2_url',
			'type'    => 'text',
			'default' => 'mailto:Lei@osps26.com',
		) );
	}
	add_action( 'cmb2_admin_init', 'osps_register_home_metaboxes' );
}

if ( ! function_exists( 'osps_register_services_metaboxes' ) ) {

	function osps_register_services_metaboxes() {

		$prefix = 'osps_svcs_';
		$show   = array( 'key' => 'page-template', 'value' => 'tpl_services.php' );

		/* ----- Section 01 — Page Hero ----- */
		$hero = new_cmb2_box( array(
			'id'           => $prefix . 'sec01_hero',
			'title'        => __( 'Section 01 — Page Hero', 'pegasus-child' ),
			'object_types' => array( 'page' ),
			'show_on'      => $show,
			'closed'       => true,
		) );
		$hero->add_field( array(
			'name'    => __( 'Eyebrow', 'pegasus-child' ),
			'id'      => $prefix . 'hero_eyebrow',
			'type'    => 'text',
			'default' => 'What we do',
		) );
		$hero->add_field( array(
			'name'    => __( 'Headline', 'pegasus-child' ),
			'id'      => $prefix . 'hero_h1',
			'type'    => 'text',
			'default' => 'Comprehensive medical physics, end to end',
		) );
		$hero->add_field( array(
			'name'    => __( 'Lead paragraph', 'pegasus-child' ),
			'id'      => $prefix . 'hero_lead',
			'type'    => 'textarea',
			'default' => 'From accreditation and routine QC to shielding design and AI evaluation — one team keeps every imaging modality compliant, safe and performing at its best.',
		) );
		$chip = $hero->add_field( array(
			'id'      => $prefix . 'hero_chips',
			'type'    => 'group',
			'name'    => __( 'Jump-link chips', 'pegasus-child' ),
			'options' => array(
				'group_title'   => __( 'Chip {#}', 'pegasus-child' ),
				'add_button'    => __( 'Add chip', 'pegasus-child' ),
				'remove_button' => __( 'Remove chip', 'pegasus-child' ),
				'sortable'      => true,
				'closed'        => true,
			),
		) );
		$hero->add_group_field( $chip, array(
			'name' => __( 'Label', 'pegasus-child' ),
			'id'   => 'label',
			'type' => 'text',
		) );
		$hero->add_group_field( $chip, array(
			'name' => __( 'Anchor (e.g. #accreditation)', 'pegasus-child' ),
			'id'   => 'anchor',
			'type' => 'text',
		) );

		/* ----- Section 02 — Service Detail Blocks ----- */
		$detail = new_cmb2_box( array(
			'id'           => $prefix . 'sec02_details',
			'title'        => __( 'Section 02 — Service Detail Blocks', 'pegasus-child' ),
			'object_types' => array( 'page' ),
			'show_on'      => $show,
			'closed'       => true,
		) );
		$block = $detail->add_field( array(
			'id'      => $prefix . 'blocks',
			'type'    => 'group',
			'name'    => __( 'Service blocks', 'pegasus-child' ),
			'options' => array(
				'group_title'   => __( 'Block {#}', 'pegasus-child' ),
				'add_button'    => __( 'Add block', 'pegasus-child' ),
				'remove_button' => __( 'Remove block', 'pegasus-child' ),
				'sortable'      => true,
				'closed'        => true,
			),
		) );
		$detail->add_group_field( $block, array(
			'name' => __( 'Anchor ID (e.g. accreditation)', 'pegasus-child' ),
			'id'   => 'anchor',
			'type' => 'text',
		) );
		$detail->add_group_field( $block, array(
			'name' => __( 'Section number label (e.g. "01 — Accreditation")', 'pegasus-child' ),
			'id'   => 'num',
			'type' => 'text',
		) );
		$detail->add_group_field( $block, array(
			'name' => __( 'Heading', 'pegasus-child' ),
			'id'   => 'heading',
			'type' => 'text',
		) );
		$detail->add_group_field( $block, array(
			'name' => __( 'Description', 'pegasus-child' ),
			'id'   => 'desc',
			'type' => 'textarea',
		) );
		$detail->add_group_field( $block, array(
			'name'       => __( 'Feature points (HTML allowed for <b>)', 'pegasus-child' ),
			'id'         => 'features',
			'type'       => 'textarea_small',
			'repeatable' => true,
			'options'    => array(
				'add_row_text' => __( 'Add feature', 'pegasus-child' ),
			),
		) );
		$detail->add_group_field( $block, array(
			'name'       => __( 'Tags', 'pegasus-child' ),
			'id'         => 'tags',
			'type'       => 'text',
			'repeatable' => true,
			'options'    => array(
				'add_row_text' => __( 'Add tag', 'pegasus-child' ),
			),
		) );
		$detail->add_group_field( $block, array(
			'name'    => __( 'Visual style', 'pegasus-child' ),
			'id'      => 'visual',
			'type'    => 'select',
			'options' => osps_visual_options(),
			'default' => 'check',
		) );
		$detail->add_group_field( $block, array(
			'name'    => __( 'Visual color scheme', 'pegasus-child' ),
			'id'      => 'scheme',
			'type'    => 'select',
			'options' => array(
				'teal-blue'    => __( 'Teal → Blue 700', 'pegasus-child' ),
				'blue-teal'    => __( 'Blue → Teal', 'pegasus-child' ),
				'teal-deep'    => __( 'Teal → Deep Teal', 'pegasus-child' ),
				'blue7-teal'   => __( 'Blue 700 → Teal', 'pegasus-child' ),
				'teal-blue-2'  => __( 'Teal → Blue', 'pegasus-child' ),
			),
			'default' => 'teal-blue',
		) );
		$detail->add_group_field( $block, array(
			'name' => __( 'Reverse layout (image on left)?', 'pegasus-child' ),
			'id'   => 'reverse',
			'type' => 'checkbox',
		) );
		$detail->add_group_field( $block, array(
			'name' => __( 'Tinted "mist" background?', 'pegasus-child' ),
			'id'   => 'mist',
			'type' => 'checkbox',
		) );

		/* ----- Section 03 — Process ----- */
		$proc = new_cmb2_box( array(
			'id'           => $prefix . 'sec03_process',
			'title'        => __( 'Section 03 — Process', 'pegasus-child' ),
			'object_types' => array( 'page' ),
			'show_on'      => $show,
			'closed'       => true,
		) );
		$proc->add_field( array(
			'name'    => __( 'Eyebrow', 'pegasus-child' ),
			'id'      => $prefix . 'proc_eyebrow',
			'type'    => 'text',
			'default' => 'How we work',
		) );
		$proc->add_field( array(
			'name'    => __( 'Section title', 'pegasus-child' ),
			'id'      => $prefix . 'proc_title',
			'type'    => 'text',
			'default' => 'A clear path to compliance',
		) );
		$step = $proc->add_field( array(
			'id'      => $prefix . 'proc_steps',
			'type'    => 'group',
			'name'    => __( 'Steps', 'pegasus-child' ),
			'options' => array(
				'group_title'   => __( 'Step {#}', 'pegasus-child' ),
				'add_button'    => __( 'Add step', 'pegasus-child' ),
				'remove_button' => __( 'Remove step', 'pegasus-child' ),
				'sortable'      => true,
				'closed'        => true,
			),
		) );
		$proc->add_group_field( $step, array(
			'name' => __( 'Step number', 'pegasus-child' ),
			'id'   => 'number',
			'type' => 'text',
		) );
		$proc->add_group_field( $step, array(
			'name' => __( 'Title', 'pegasus-child' ),
			'id'   => 'title',
			'type' => 'text',
		) );
		$proc->add_group_field( $step, array(
			'name' => __( 'Description', 'pegasus-child' ),
			'id'   => 'desc',
			'type' => 'textarea_small',
		) );

		/* ----- Section 04 — CTA ----- */
		$cta = new_cmb2_box( array(
			'id'           => $prefix . 'sec04_cta',
			'title'        => __( 'Section 04 — CTA', 'pegasus-child' ),
			'object_types' => array( 'page' ),
			'show_on'      => $show,
			'closed'       => true,
		) );
		$cta->add_field( array(
			'name'    => __( 'Eyebrow', 'pegasus-child' ),
			'id'      => $prefix . 'cta_eyebrow',
			'type'    => 'text',
			'default' => 'Get started',
		) );
		$cta->add_field( array(
			'name'    => __( 'Heading', 'pegasus-child' ),
			'id'      => $prefix . 'cta_heading',
			'type'    => 'text',
			'default' => 'Tell us what you need tested',
		) );
		$cta->add_field( array(
			'name'    => __( 'Lead paragraph', 'pegasus-child' ),
			'id'      => $prefix . 'cta_lead',
			'type'    => 'textarea',
			'default' => "Share your equipment and timelines and we'll respond with a clear scope, schedule and quote.",
		) );
		$cta->add_field( array(
			'name'    => __( 'Primary button label', 'pegasus-child' ),
			'id'      => $prefix . 'cta_btn1_label',
			'type'    => 'text',
			'default' => 'Call (813) 743-2373',
		) );
		$cta->add_field( array(
			'name'    => __( 'Primary button URL', 'pegasus-child' ),
			'id'      => $prefix . 'cta_btn1_url',
			'type'    => 'text',
			'default' => 'tel:+18137432373',
		) );
		$cta->add_field( array(
			'name'    => __( 'Secondary button label', 'pegasus-child' ),
			'id'      => $prefix . 'cta_btn2_label',
			'type'    => 'text',
			'default' => 'Request a Consultation',
		) );
		$cta->add_field( array(
			'name'    => __( 'Secondary button URL', 'pegasus-child' ),
			'id'      => $prefix . 'cta_btn2_url',
			'type'    => 'text',
			'default' => 'mailto:Lei@osps26.com',
		) );
	}
	add_action( 'cmb2_admin_init', 'osps_register_services_metaboxes' );
}

if ( ! function_exists( 'osps_register_contact_metaboxes' ) ) {

	function osps_register_contact_metaboxes() {

		$prefix = 'osps_contact_';
		$show   = array( 'key' => 'page-template', 'value' => 'tpl_contact.php' );

		/* ----- Section 01 — Page Hero ----- */
		$hero = new_cmb2_box( array(
			'id'           => $prefix . 'sec01_hero',
			'title'        => __( 'Section 01 — Page Hero', 'pegasus-child' ),
			'object_types' => array( 'page' ),
			'show_on'      => $show,
			'closed'       => true,
		) );
		$hero->add_field( array(
			'name'    => __( 'Eyebrow', 'pegasus-child' ),
			'id'      => $prefix . 'hero_eyebrow',
			'type'    => 'text',
			'default' => 'Get in touch',
		) );
		$hero->add_field( array(
			'name'    => __( 'Headline', 'pegasus-child' ),
			'id'      => $prefix . 'hero_h1',
			'type'    => 'text',
			'default' => "Let's talk about your imaging program",
		) );
		$hero->add_field( array(
			'name'    => __( 'Lead paragraph', 'pegasus-child' ),
			'id'      => $prefix . 'hero_lead',
			'type'    => 'textarea',
			'default' => "Share your equipment and timelines and we'll respond with a clear scope, schedule and quote — usually within one business day.",
		) );

		/* ----- Section 02 — Contact Details + Form ----- */
		$contact = new_cmb2_box( array(
			'id'           => $prefix . 'sec02_contact',
			'title'        => __( 'Section 02 — Contact Details + Form', 'pegasus-child' ),
			'object_types' => array( 'page' ),
			'show_on'      => $show,
			'closed'       => true,
		) );
		$contact->add_field( array(
			'name'    => __( 'Eyebrow', 'pegasus-child' ),
			'id'      => $prefix . 'sec_eyebrow',
			'type'    => 'text',
			'default' => 'How to contact us',
		) );
		$contact->add_field( array(
			'name'    => __( 'Section title', 'pegasus-child' ),
			'id'      => $prefix . 'sec_title',
			'type'    => 'text',
			'default' => 'Multiple ways to connect',
		) );
		$contact->add_field( array(
			'name'    => __( 'Intro paragraph', 'pegasus-child' ),
			'id'      => $prefix . 'sec_intro',
			'type'    => 'textarea_small',
			'default' => 'Pick the channel that works best — we respond promptly to all inquiries.',
		) );

		$method = $contact->add_field( array(
			'id'      => $prefix . 'methods',
			'type'    => 'group',
			'name'    => __( 'Contact cards', 'pegasus-child' ),
			'options' => array(
				'group_title'   => __( 'Card {#}', 'pegasus-child' ),
				'add_button'    => __( 'Add card', 'pegasus-child' ),
				'remove_button' => __( 'Remove card', 'pegasus-child' ),
				'sortable'      => true,
				'closed'        => true,
			),
		) );
		$contact->add_group_field( $method, array(
			'name'    => __( 'Icon', 'pegasus-child' ),
			'id'      => 'icon',
			'type'    => 'select',
			'options' => osps_contact_icon_options(),
			'default' => 'email',
		) );
		$contact->add_group_field( $method, array(
			'name' => __( 'Card title', 'pegasus-child' ),
			'id'   => 'title',
			'type' => 'text',
		) );
		$contact->add_group_field( $method, array(
			'name' => __( 'Line 1 — label (e.g. "Primary")', 'pegasus-child' ),
			'id'   => 'line1_label',
			'type' => 'text',
		) );
		$contact->add_group_field( $method, array(
			'name' => __( 'Line 1 — value', 'pegasus-child' ),
			'id'   => 'line1_value',
			'type' => 'text',
		) );
		$contact->add_group_field( $method, array(
			'name'        => __( 'Line 1 — link (e.g. mailto:, tel:, https://)', 'pegasus-child' ),
			'id'          => 'line1_url',
			'type'        => 'text',
			'description' => __( 'Leave blank for plain text.', 'pegasus-child' ),
		) );
		$contact->add_group_field( $method, array(
			'name' => __( 'Line 2 — label (optional)', 'pegasus-child' ),
			'id'   => 'line2_label',
			'type' => 'text',
		) );
		$contact->add_group_field( $method, array(
			'name' => __( 'Line 2 — value (optional)', 'pegasus-child' ),
			'id'   => 'line2_value',
			'type' => 'text',
		) );
		$contact->add_group_field( $method, array(
			'name' => __( 'Line 2 — link (optional)', 'pegasus-child' ),
			'id'   => 'line2_url',
			'type' => 'text',
		) );

		$contact->add_field( array(
			'name'    => __( 'Form card — eyebrow', 'pegasus-child' ),
			'id'      => $prefix . 'form_eyebrow',
			'type'    => 'text',
			'default' => 'Send a message',
		) );
		$contact->add_field( array(
			'name'    => __( 'Form card — heading', 'pegasus-child' ),
			'id'      => $prefix . 'form_heading',
			'type'    => 'text',
			'default' => 'Request a consultation',
		) );
		$contact->add_field( array(
			'name'    => __( 'Form card — intro', 'pegasus-child' ),
			'id'      => $prefix . 'form_intro',
			'type'    => 'textarea_small',
			'default' => "Fill out the form below and we'll respond within one business day.",
		) );
		$contact->add_field( array(
			'name'        => __( 'Gravity Forms shortcode', 'pegasus-child' ),
			'id'          => $prefix . 'form_shortcode',
			'type'        => 'textarea_small',
			'description' => __( 'e.g. [gravityform id="1" title="false" description="false"]', 'pegasus-child' ),
		) );

		/* ----- Section 03 — Payment Information ----- */
		$pay = new_cmb2_box( array(
			'id'           => $prefix . 'sec03_payments',
			'title'        => __( 'Section 03 — Payment Information', 'pegasus-child' ),
			'object_types' => array( 'page' ),
			'show_on'      => $show,
			'closed'       => true,
		) );
		$pay->add_field( array(
			'name'    => __( 'Eyebrow', 'pegasus-child' ),
			'id'      => $prefix . 'pay_eyebrow',
			'type'    => 'text',
			'default' => 'Billing & payment',
		) );
		$pay->add_field( array(
			'name'    => __( 'Section title', 'pegasus-child' ),
			'id'      => $prefix . 'pay_title',
			'type'    => 'text',
			'default' => 'How we accept payment',
		) );
		$pay->add_field( array(
			'name'    => __( 'Intro paragraph', 'pegasus-child' ),
			'id'      => $prefix . 'pay_intro',
			'type'    => 'textarea_small',
			'default' => 'One Stop Physics Service accepts a variety of payment methods.',
		) );

		$pay_method = $pay->add_field( array(
			'id'      => $prefix . 'pay_methods',
			'type'    => 'group',
			'name'    => __( 'Payment cards', 'pegasus-child' ),
			'options' => array(
				'group_title'   => __( 'Method {#}', 'pegasus-child' ),
				'add_button'    => __( 'Add method', 'pegasus-child' ),
				'remove_button' => __( 'Remove method', 'pegasus-child' ),
				'sortable'      => true,
				'closed'        => true,
			),
		) );
		$pay->add_group_field( $pay_method, array(
			'name'    => __( 'Icon', 'pegasus-child' ),
			'id'      => 'icon',
			'type'    => 'select',
			'options' => osps_payment_icon_options(),
			'default' => 'cards',
		) );
		$pay->add_group_field( $pay_method, array(
			'name' => __( 'Title', 'pegasus-child' ),
			'id'   => 'title',
			'type' => 'text',
		) );
		$pay->add_group_field( $pay_method, array(
			'name' => __( 'Description', 'pegasus-child' ),
			'id'   => 'desc',
			'type' => 'textarea_small',
		) );

		/* ----- Section 04 — CTA ----- */
		$cta = new_cmb2_box( array(
			'id'           => $prefix . 'sec04_cta',
			'title'        => __( 'Section 04 — CTA', 'pegasus-child' ),
			'object_types' => array( 'page' ),
			'show_on'      => $show,
			'closed'       => true,
		) );
		$cta->add_field( array(
			'name'    => __( 'Eyebrow', 'pegasus-child' ),
			'id'      => $prefix . 'cta_eyebrow',
			'type'    => 'text',
			'default' => 'Prefer to talk?',
		) );
		$cta->add_field( array(
			'name'    => __( 'Heading', 'pegasus-child' ),
			'id'      => $prefix . 'cta_heading',
			'type'    => 'text',
			'default' => 'Call us — we pick up.',
		) );
		$cta->add_field( array(
			'name'    => __( 'Lead paragraph', 'pegasus-child' ),
			'id'      => $prefix . 'cta_lead',
			'type'    => 'textarea',
			'default' => "Have a tight deadline or a complex question? A board-certified physicist is just a phone call away.",
		) );
		$cta->add_field( array(
			'name'    => __( 'Primary button label', 'pegasus-child' ),
			'id'      => $prefix . 'cta_btn1_label',
			'type'    => 'text',
			'default' => 'Call (813) 743-2373',
		) );
		$cta->add_field( array(
			'name'    => __( 'Primary button URL', 'pegasus-child' ),
			'id'      => $prefix . 'cta_btn1_url',
			'type'    => 'text',
			'default' => 'tel:+18137432373',
		) );
		$cta->add_field( array(
			'name'    => __( 'Secondary button label', 'pegasus-child' ),
			'id'      => $prefix . 'cta_btn2_label',
			'type'    => 'text',
			'default' => 'Email Lei',
		) );
		$cta->add_field( array(
			'name'    => __( 'Secondary button URL', 'pegasus-child' ),
			'id'      => $prefix . 'cta_btn2_url',
			'type'    => 'text',
			'default' => 'mailto:Lei@osps26.com',
		) );
	}
	add_action( 'cmb2_admin_init', 'osps_register_contact_metaboxes' );
}

/**
 * Icon-key options for the contact card select.
 */
function osps_contact_icon_options() {
	return array(
		'email'    => __( 'Email (envelope)', 'pegasus-child' ),
		'phone'    => __( 'Phone (handset)', 'pegasus-child' ),
		'location' => __( 'Location (map pin)', 'pegasus-child' ),
		'hours'    => __( 'Hours (clock)', 'pegasus-child' ),
	);
}

/**
 * Icon-key options for the payment-method select.
 */
function osps_payment_icon_options() {
	return array(
		'cards' => __( 'Cards (credit/debit)', 'pegasus-child' ),
		'bank'  => __( 'Bank (ACH / Wire)', 'pegasus-child' ),
		'check' => __( 'Check', 'pegasus-child' ),
	);
}

/**
 * Icon-key options for the modality select.
 */
function osps_modality_icon_options() {
	return array(
		'mammography' => __( 'Mammography', 'pegasus-child' ),
		'ct'          => __( 'CT', 'pegasus-child' ),
		'mri'         => __( 'MRI', 'pegasus-child' ),
		'nuclear'     => __( 'Nuclear Medicine', 'pegasus-child' ),
		'fluoro'      => __( 'Fluoroscopy', 'pegasus-child' ),
		'xray'        => __( 'X-Ray / DR', 'pegasus-child' ),
	);
}

/**
 * Icon-key options for the services-overview select.
 */
function osps_service_icon_options() {
	return array(
		'accreditation' => __( 'Accreditation (checklist)', 'pegasus-child' ),
		'mri-safety'    => __( 'MRI Safety (shield)', 'pegasus-child' ),
		'rso'           => __( 'Radiation Safety (trefoil)', 'pegasus-child' ),
		'facility'      => __( 'Facility (building)', 'pegasus-child' ),
		'advanced'      => __( 'Advanced Tech (chip)', 'pegasus-child' ),
	);
}

/**
 * Visual options for service-detail blocks.
 */
function osps_visual_options() {
	return array(
		'check'    => __( 'Document with check (Accreditation)', 'pegasus-child' ),
		'mri'      => __( 'MRI rings', 'pegasus-child' ),
		'trefoil'  => __( 'Radiation trefoil', 'pegasus-child' ),
		'facility' => __( 'Floor plan (Facility)', 'pegasus-child' ),
		'chip'     => __( 'Chip (Advanced Tech)', 'pegasus-child' ),
	);
}
