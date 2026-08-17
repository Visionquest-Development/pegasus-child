<?php
/**
 * Elliot Integration — Services page ( tpl_services.php ) CMB2 fields + defaults.
 *
 * Same "defaults until changed" pattern as the home page:
 *  - Simple hero / CTA fields are pre-filled with the design defaults.
 *  - The 8 service blocks are a single repeatable group that falls back to the
 *    full design defaults on the front end until real rows are added.
 *  - Every metabox and the repeatable group are closed by default.
 *
 * Shares the elliot_field() / elliot_group() front-end helpers defined in
 * cmb2-homepage-fields.php ( both files are required from functions.php ).
 *
 * @package Pegasus_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* -------------------------------------------------------------------------
 * 1. DEFAULT CONTENT
 * ---------------------------------------------------------------------- */

/**
 * Claude Design default content for the services page.
 *
 * @return array
 */
function elliot_services_defaults() {
	return array(

		'hero' => array(
			'eyebrow' => 'Services & capabilities',
			'line1'   => 'We design it.',
			'line2'   => 'We build it.',
			'emph'    => 'We make it run.',
			'intro'   => 'Eight disciplines, one accountable integrator. The same engineer who designs your control system writes the schematics, builds the panel, and stands on your plant floor until it runs.',
		),

		/* Each block: short label ( used for the index + eyebrow ), full title,
		   an italic lead line, and its feature bullets. The number, background
		   theme and image side are derived from position on the front end. */
		'services' => array(
			array(
				'label'    => 'Robotics',
				'title'    => 'Robotics & Integration',
				'lead'     => 'Robotic cells and integration — pick-and-place, assembly, and palletizing.',
				'features' => array(
					'Fanuc & collaborative robot integration',
					'End-of-arm tooling & vision guidance',
					'Cell safety, guarding & commissioning',
				),
			),
			array(
				'label'    => 'Motion Control',
				'title'    => 'Motion Control',
				'lead'     => 'Coordinated multi-axis motion, kinematics, and servo systems.',
				'features' => array(
					'Synchronized servo & gantry motion',
					'Cam profiling & electronic gearing',
					'Tuning for throughput & precision',
				),
			),
			array(
				'label'    => 'Automation',
				'title'    => 'Factory & Warehouse Automation',
				'lead'     => 'Factory, warehouse, and ecommerce automation — concept to commissioning.',
				'features' => array(
					'Factory automation & process control',
					'Warehouse & ecommerce automation',
					'Battery & assembly line systems',
				),
			),
			array(
				'label'    => 'Electrical & Panels',
				'title'    => 'Electrical Design & Fabrication',
				'lead'     => 'UL 508A / ETL-listed control panels, designed and built in-house.',
				'features' => array(
					'Licensed electrical contracting',
					'UL 508A panel shop, ETL listed',
					'Schematics, fabrication & field install',
				),
			),
			array(
				'label'    => 'Safety Systems',
				'title'    => 'Safety System Design',
				'lead'     => 'Risk assessments, safety circuits, light curtains, and interlocks.',
				'features' => array(
					'Risk assessments & safety validation',
					'Light curtains, interlocks & e-stops',
					'Safety-rated control circuits',
				),
			),
			array(
				'label'    => 'HMI / SCADA',
				'title'    => 'HMI, SCADA & Software',
				'lead'     => 'Operator interfaces, supervisory control, databases, and software.',
				'features' => array(
					'Operator interfaces & dashboards',
					'SCADA & supervisory control',
					'Data historians & reporting',
				),
			),
			array(
				'label'    => 'Training',
				'title'    => 'Controls Training',
				'lead'     => 'Hands-on PLC and controls training for your maintenance and engineering teams.',
				'features' => array(
					'PLC & CODESYS fundamentals',
					'Troubleshooting on your equipment',
					'Documentation & handover',
				),
			),
			array(
				'label'    => 'Turnkey',
				'title'    => 'Turnkey Delivery',
				'lead'     => 'One integrator from first wire to full production.',
				'features' => array(
					'Single point of accountability',
					'Design, build, install & commission',
					'Ongoing support & service',
				),
			),
		),

		'cta' => array(
			'eyebrow'  => 'Start a project',
			'title'    => 'Not sure which service',
			'emph'     => 'fits your project?',
			'para'     => 'Most projects begin with a short scoping call. Walk me through the line and I\'ll tell you, honestly, what it takes.',
			'btn_text' => 'Book a scoping call',
			'btn_link' => '#contact',
		),
	);
}

/* -------------------------------------------------------------------------
 * 2. CMB2 METABOXES  ( shown only on the tpl_services.php page template )
 * ---------------------------------------------------------------------- */

add_action( 'cmb2_admin_init', 'elliot_services_register_metaboxes' );

/**
 * Register the services-page metaboxes.
 */
function elliot_services_register_metaboxes() {

	$d       = elliot_services_defaults();
	$show_on = array( 'key' => 'page-template', 'value' => 'tpl_services.php' );

	/* ----- SECTION 1 · HERO -------------------------------------------- */
	$hero = new_cmb2_box( array(
		'id'           => 'elliot_services_hero',
		'title'        => 'Services · 01 Hero',
		'object_types' => array( 'page' ),
		'show_on'      => $show_on,
		'closed'       => true,
		'context'      => 'normal',
		'priority'     => 'high',
	) );
	$hero->add_field( array( 'name' => 'Eyebrow', 'id' => 'elliot_svc2_eyebrow', 'type' => 'text', 'default' => $d['hero']['eyebrow'] ) );
	$hero->add_field( array( 'name' => 'Heading line 1', 'id' => 'elliot_svc2_h_line1', 'type' => 'text', 'default' => $d['hero']['line1'] ) );
	$hero->add_field( array( 'name' => 'Heading line 2', 'id' => 'elliot_svc2_h_line2', 'type' => 'text', 'default' => $d['hero']['line2'] ) );
	$hero->add_field( array( 'name' => 'Heading emphasis (italic gold)', 'id' => 'elliot_svc2_h_emph', 'type' => 'text', 'default' => $d['hero']['emph'] ) );
	$hero->add_field( array( 'name' => 'Intro paragraph', 'id' => 'elliot_svc2_intro', 'type' => 'textarea_small', 'default' => $d['hero']['intro'] ) );

	/* ----- SECTION 2 · SERVICE BLOCKS ---------------------------------- */
	$blocks = new_cmb2_box( array(
		'id'           => 'elliot_services_blocks',
		'title'        => 'Services · 02 Service blocks',
		'object_types' => array( 'page' ),
		'show_on'      => $show_on,
		'closed'       => true,
	) );
	$blocks->add_field( array(
		'name'        => 'Note',
		'id'          => 'elliot_svc2_note',
		'type'        => 'title',
		'after_row'   => '<p style="margin:.4em 0 0;color:#666;font-style:italic;">The number, background colour ( light / cream / dark ) and image side are set automatically by each block\'s position. The jump index at the top is generated from these blocks.</p>',
	) );
	$items = $blocks->add_field( array(
		'name'    => 'Service blocks',
		'id'      => 'elliot_svc2_items',
		'type'    => 'group',
		'options' => array(
			'group_title'   => 'Service {#}',
			'add_button'    => 'Add service',
			'remove_button' => 'Remove service',
			'sortable'      => true,
			'closed'        => true,
		),
	) );
	$blocks->add_group_field( $items, array( 'name' => 'Short label (index + eyebrow)', 'id' => 'label', 'type' => 'text' ) );
	$blocks->add_group_field( $items, array( 'name' => 'Title', 'id' => 'title', 'type' => 'text' ) );
	$blocks->add_group_field( $items, array( 'name' => 'Lead (italic)', 'id' => 'lead', 'type' => 'textarea_small' ) );
	$blocks->add_group_field( $items, array( 'name' => 'Features', 'desc' => 'One feature per line.', 'id' => 'features', 'type' => 'textarea_small' ) );
	$blocks->add_group_field( $items, array(
		'name'         => 'Photo',
		'id'           => 'image',
		'type'         => 'file',
		'options'      => array( 'url' => false ),
		'query_args'   => array( 'type' => 'image' ),
		'preview_size' => 'medium',
	) );

	/* ----- SECTION 3 · CTA --------------------------------------------- */
	$cta = new_cmb2_box( array(
		'id'           => 'elliot_services_cta',
		'title'        => 'Services · 03 Call to action',
		'object_types' => array( 'page' ),
		'show_on'      => $show_on,
		'closed'       => true,
	) );
	$cta->add_field( array( 'name' => 'Eyebrow', 'id' => 'elliot_svc2_cta_eyebrow', 'type' => 'text', 'default' => $d['cta']['eyebrow'] ) );
	$cta->add_field( array( 'name' => 'Heading', 'id' => 'elliot_svc2_cta_title', 'type' => 'text', 'default' => $d['cta']['title'] ) );
	$cta->add_field( array( 'name' => 'Heading emphasis (italic gold)', 'id' => 'elliot_svc2_cta_emph', 'type' => 'text', 'default' => $d['cta']['emph'] ) );
	$cta->add_field( array( 'name' => 'Paragraph', 'id' => 'elliot_svc2_cta_para', 'type' => 'textarea_small', 'default' => $d['cta']['para'] ) );
	$cta->add_field( array( 'name' => 'Button text', 'id' => 'elliot_svc2_cta_btn_text', 'type' => 'text', 'default' => $d['cta']['btn_text'] ) );
	$cta->add_field( array( 'name' => 'Button link', 'id' => 'elliot_svc2_cta_btn_link', 'type' => 'text', 'default' => $d['cta']['btn_link'] ) );
}
