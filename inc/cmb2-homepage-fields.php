<?php
/**
 * Elliot Integration — Home page ( tpl_home.php ) CMB2 fields + front-end defaults.
 *
 * This file is included from the child theme functions.php.
 *
 * Behaviour requested by the client:
 *  - The front end shows the Claude Design default content until a field / group
 *    row is filled in and saved.
 *  - Simple text fields are pre-filled with the design defaults (CMB2 `default`).
 *  - Repeatable groups are left as a single blank row in the admin (CMB2's normal
 *    UI) and fall back to the full design defaults on the front end via
 *    elliot_home_group() until the editor adds real rows.
 *  - Every metabox and every repeatable group is closed by default.
 *
 * @package Pegasus_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* -------------------------------------------------------------------------
 * 1. DEFAULT CONTENT  ( single source of truth for admin pre-fill + front end )
 * ---------------------------------------------------------------------- */

/**
 * The full set of Claude Design default content for the home page.
 *
 * @return array
 */
function elliot_home_defaults() {
	return array(

		'hero' => array(
			'eyebrow'      => 'Full-service automation integrator',
			'title1'       => 'Integration,',
			'emph'         => 'engineered',
			'title3'       => 'end to end.',
			'intro'        => 'Robotics, controls, and UL-listed panels — designed, built, and commissioned by one licensed integrator. We wire it, we build it, we make your line run.',
			'btn1_text'    => 'Start a project',
			'btn1_link'    => '#contact',
			'btn2_text'    => 'View services',
			'btn2_link'    => '#services',
			'credentials'  => array(
				array( 'num' => '01', 'label' => 'Robotic Integration' ),
				array( 'num' => '02', 'label' => 'Control Panels · UL 508A' ),
				array( 'num' => '03', 'label' => 'Turnkey Lines' ),
				array( 'num' => '04', 'label' => 'Electrical Contracting' ),
			),
		),

		'statement' => array(
			'meta_l' => '01 — Practice',
			'meta_r' => 'One integrator, whole line',
			'title1' => 'Eight disciplines.',
			'emph'   => 'One integrator.',
			'p1'     => 'No hand-offs and no sub-contracted guesswork. The same person who designs your controls writes the schematics, builds the panel, and stands on your plant floor until it runs.',
			'p2'     => 'Electrical design, UL 508A fabrication, robotics, safety, and software — under one licensed contractor, accountable from concept to commissioning.',
		),

		'services' => array(
			'meta_l' => '02 — Capabilities',
			'meta_r' => 'What we do',
			'items'  => array(
				array( 'num' => '01', 'title' => 'Robotics & Integration', 'desc' => 'Robotic cells and integration — pick-and-place, assembly, and palletizing.' ),
				array( 'num' => '02', 'title' => 'Control Panels', 'desc' => 'UL 508A / ETL-listed control panels, designed and built in-house.' ),
				array( 'num' => '03', 'title' => 'Electrical Design & Fab', 'desc' => 'Licensed electrical contracting — schematics, fabrication, and install.' ),
				array( 'num' => '04', 'title' => 'Automation', 'desc' => 'Factory and warehouse automation — concept to commissioning.' ),
				array( 'num' => '05', 'title' => 'Safety System Design', 'desc' => 'Risk assessments, safety circuits, light curtains, and interlocks.' ),
				array( 'num' => '06', 'title' => 'HMI / SCADA & Software', 'desc' => 'Operator interfaces, supervisory control, databases, and software.' ),
				array( 'num' => '07', 'title' => 'Controls Training', 'desc' => 'Hands-on PLC and controls training for your maintenance teams.' ),
				array( 'num' => '08', 'title' => 'Turnkey Delivery', 'desc' => 'One integrator from first wire to full production.' ),
			),
		),

		'industries' => array(
			'meta_l' => '03 — Sectors',
			'meta_r' => 'Where we work',
			'title1' => 'Industries',
			'emph'   => 'we serve.',
			'items'  => array(
				array( 'code' => 'IND 01', 'name' => 'Food & Beverage' ),
				array( 'code' => 'IND 02', 'name' => 'Aerospace' ),
				array( 'code' => 'IND 03', 'name' => 'Consumer Products' ),
				array( 'code' => 'IND 04', 'name' => 'Automotive' ),
				array( 'code' => 'IND 05', 'name' => 'Ecommerce' ),
				array( 'code' => 'IND 06', 'name' => 'Material Handling' ),
				array( 'code' => 'IND 07', 'name' => 'Cranes' ),
				array( 'code' => 'IND 08', 'name' => 'Forestry' ),
			),
		),

		'credentials' => array(
			'meta_l' => '04 — Credentials',
			'meta_r' => 'Licensed · Listed · Accountable',
			'title1' => 'Licensed.',
			'title2' => 'Listed.',
			'emph'   => 'Accountable.',
			'para'   => 'Every panel that leaves the shop is built to UL 508A and ETL-listed. Every install is pulled by a licensed electrical contractor. One name on the work, start to finish.',
			'items'  => array(
				array( 'tag' => 'UL 508A', 'title' => 'Industrial Control Panels', 'desc' => 'Listed panel shop — built, labeled, and inspected in-house.' ),
				array( 'tag' => 'ETL', 'title' => 'Intertek Listed', 'desc' => 'Third-party listed assemblies for code-compliant installs.' ),
				array( 'tag' => 'LIC', 'title' => 'Electrical Contractor', 'desc' => 'Licensed, bonded, and insured for design and install.' ),
				array( 'tag' => 'FAB', 'title' => 'In-house Fabrication', 'desc' => 'Wiring, assembly, and testing under one roof.' ),
			),
		),

		'project' => array(
			'meta_l'  => '05 — Selected work',
			'meta_r'  => 'Case study',
			'eyebrow' => 'Robots for manufacturing',
			'title'   => 'Fully automated battery assembly system.',
			'specs'   => array(
				array( 'label' => 'Timeline', 'value' => '6 months — concept to FAT' ),
				array( 'label' => 'Throughput', 'value' => '300 battery assemblies / hr' ),
				array( 'label' => 'Platform', 'value' => 'CODESYS' ),
				array( 'label' => 'Scope', 'value' => 'Coordinated servo motion & Fanuc robotics' ),
			),
		),

		'process' => array(
			'meta_l' => '06 — How we work',
			'meta_r' => 'Concept to support',
			'title1' => 'A repeatable',
			'emph'   => 'six-step delivery.',
			'steps'  => array(
				array( 'num' => '01', 'title' => 'Discovery', 'desc' => 'Walk the floor, scope the line, define success.' ),
				array( 'num' => '02', 'title' => 'Design', 'desc' => 'Controls architecture, schematics, and safety.' ),
				array( 'num' => '03', 'title' => 'Fabricate', 'desc' => 'UL 508A panels built and tested in-house.' ),
				array( 'num' => '04', 'title' => 'Assemble', 'desc' => 'Mechanical, robotics, and electrical integration.' ),
				array( 'num' => '05', 'title' => 'Commission', 'desc' => 'On-site startup, tuning, and acceptance.' ),
				array( 'num' => '06', 'title' => 'Support', 'desc' => 'Training, documentation, and on-call service.' ),
			),
		),

		'about' => array(
			'meta_l' => '07 — About',
			'meta_r' => 'The integrator',
			'title1' => 'One integrator.',
			'emph'   => 'Whole line.',
			'p1'     => 'Elliot Integration is the controls and electrical practice of a licensed electrical contractor with decades on the plant floor — building robotic cells, UL-listed panels, and turnkey automation for manufacturers who want one accountable name on the work.',
			'p2'     => 'After years partnering on large integration jobs, the practice now runs solo and boutique: direct access to the engineer who designs, builds, and commissions your system — no layers, no hand-offs.',
			'tags'   => array(
				array( 'label' => 'Licensed Electrical Contractor' ),
				array( 'label' => 'UL 508A' ),
				array( 'label' => 'CODESYS' ),
				array( 'label' => 'Fanuc Robotics' ),
			),
		),

		'cta' => array(
			'eyebrow'  => 'Start a project',
			'title1'   => 'Not sure where to',
			'emph'     => 'start?',
			'para'     => 'Most projects begin with a short scoping call. Walk me through the line and I\'ll tell you, honestly, what it takes to automate it.',
			'btn_text' => 'Book a scoping call',
			'btn_link' => '#contact',
		),
	);
}

/* -------------------------------------------------------------------------
 * 2. FRONT-END HELPERS  ( "defaults until changed" )
 * ---------------------------------------------------------------------- */

/**
 * Return a saved simple meta value, or the supplied default when empty.
 *
 * @param int    $post_id Post ID.
 * @param string $key     Meta key.
 * @param string $default Default value.
 * @return string
 */
function elliot_field( $post_id, $key, $default = '' ) {
	$value = get_post_meta( $post_id, $key, true );
	return ( '' === $value || null === $value || false === $value ) ? $default : $value;
}

/**
 * Return a saved repeatable-group value, or the full defaults array when empty.
 *
 * @param int    $post_id  Post ID.
 * @param string $key      Meta key.
 * @param array  $defaults Default rows.
 * @return array
 */
function elliot_group( $post_id, $key, $defaults = array() ) {
	$value = get_post_meta( $post_id, $key, true );
	return ( empty( $value ) || ! is_array( $value ) ) ? $defaults : $value;
}

/* -------------------------------------------------------------------------
 * 3. CMB2 METABOXES  ( shown only on the tpl_home.php page template )
 * ---------------------------------------------------------------------- */

add_action( 'cmb2_admin_init', 'elliot_home_register_metaboxes' );

/**
 * Register all home-page metaboxes.
 */
function elliot_home_register_metaboxes() {

	$d       = elliot_home_defaults();
	$show_on = array( 'key' => 'page-template', 'value' => 'tpl_home.php' );

	/* ----- SECTION 1 · HERO -------------------------------------------- */
	$hero = new_cmb2_box( array(
		'id'           => 'elliot_home_hero',
		'title'        => 'Home · 01 Hero',
		'object_types' => array( 'page' ),
		'show_on'      => $show_on,
		'closed'       => true,
		'context'      => 'normal',
		'priority'     => 'high',
	) );
	$hero->add_field( array( 'name' => 'Eyebrow', 'id' => 'elliot_hero_eyebrow', 'type' => 'text', 'default' => $d['hero']['eyebrow'] ) );
	$hero->add_field( array( 'name' => 'Heading line 1', 'id' => 'elliot_hero_title1', 'type' => 'text', 'default' => $d['hero']['title1'] ) );
	$hero->add_field( array( 'name' => 'Heading emphasis (italic gold)', 'id' => 'elliot_hero_emph', 'type' => 'text', 'default' => $d['hero']['emph'] ) );
	$hero->add_field( array( 'name' => 'Heading line 3', 'id' => 'elliot_hero_title3', 'type' => 'text', 'default' => $d['hero']['title3'] ) );
	$hero->add_field( array( 'name' => 'Intro paragraph', 'id' => 'elliot_hero_intro', 'type' => 'textarea_small', 'default' => $d['hero']['intro'] ) );
	$hero->add_field( array( 'name' => 'Primary button text', 'id' => 'elliot_hero_btn1_text', 'type' => 'text', 'default' => $d['hero']['btn1_text'] ) );
	$hero->add_field( array( 'name' => 'Primary button link', 'id' => 'elliot_hero_btn1_link', 'type' => 'text', 'default' => $d['hero']['btn1_link'] ) );
	$hero->add_field( array( 'name' => 'Secondary button text', 'id' => 'elliot_hero_btn2_text', 'type' => 'text', 'default' => $d['hero']['btn2_text'] ) );
	$hero->add_field( array( 'name' => 'Secondary button link', 'id' => 'elliot_hero_btn2_link', 'type' => 'text', 'default' => $d['hero']['btn2_link'] ) );
	$hero_creds = $hero->add_field( array(
		'name'    => 'Credentials strip',
		'id'      => 'elliot_hero_credentials',
		'type'    => 'group',
		'options' => array(
			'group_title'   => 'Credential {#}',
			'add_button'    => 'Add credential',
			'remove_button' => 'Remove credential',
			'sortable'      => true,
			'closed'        => true,
		),
	) );
	$hero->add_group_field( $hero_creds, array( 'name' => 'Number', 'id' => 'num', 'type' => 'text' ) );
	$hero->add_group_field( $hero_creds, array( 'name' => 'Label', 'id' => 'label', 'type' => 'text' ) );

	/* ----- SECTION 2 · STATEMENT --------------------------------------- */
	$stmt = new_cmb2_box( array(
		'id'           => 'elliot_home_statement',
		'title'        => 'Home · 02 Statement',
		'object_types' => array( 'page' ),
		'show_on'      => $show_on,
		'closed'       => true,
	) );
	$stmt->add_field( array( 'name' => 'Section label (left)', 'id' => 'elliot_stmt_meta_l', 'type' => 'text', 'default' => $d['statement']['meta_l'] ) );
	$stmt->add_field( array( 'name' => 'Section label (right)', 'id' => 'elliot_stmt_meta_r', 'type' => 'text', 'default' => $d['statement']['meta_r'] ) );
	$stmt->add_field( array( 'name' => 'Heading line 1', 'id' => 'elliot_stmt_title1', 'type' => 'text', 'default' => $d['statement']['title1'] ) );
	$stmt->add_field( array( 'name' => 'Heading emphasis (italic gold)', 'id' => 'elliot_stmt_emph', 'type' => 'text', 'default' => $d['statement']['emph'] ) );
	$stmt->add_field( array( 'name' => 'Paragraph 1', 'id' => 'elliot_stmt_p1', 'type' => 'textarea_small', 'default' => $d['statement']['p1'] ) );
	$stmt->add_field( array( 'name' => 'Paragraph 2', 'id' => 'elliot_stmt_p2', 'type' => 'textarea_small', 'default' => $d['statement']['p2'] ) );

	/* ----- SECTION 3 · SERVICES ---------------------------------------- */
	$svc = new_cmb2_box( array(
		'id'           => 'elliot_home_services',
		'title'        => 'Home · 03 Services',
		'object_types' => array( 'page' ),
		'show_on'      => $show_on,
		'closed'       => true,
	) );
	$svc->add_field( array( 'name' => 'Section label (left)', 'id' => 'elliot_svc_meta_l', 'type' => 'text', 'default' => $d['services']['meta_l'] ) );
	$svc->add_field( array( 'name' => 'Section label (right)', 'id' => 'elliot_svc_meta_r', 'type' => 'text', 'default' => $d['services']['meta_r'] ) );
	$svc_items = $svc->add_field( array(
		'name'    => 'Services',
		'id'      => 'elliot_svc_items',
		'type'    => 'group',
		'options' => array(
			'group_title'   => 'Service {#}',
			'add_button'    => 'Add service',
			'remove_button' => 'Remove service',
			'sortable'      => true,
			'closed'        => true,
		),
	) );
	$svc->add_group_field( $svc_items, array( 'name' => 'Number', 'id' => 'num', 'type' => 'text' ) );
	$svc->add_group_field( $svc_items, array( 'name' => 'Title', 'id' => 'title', 'type' => 'text' ) );
	$svc->add_group_field( $svc_items, array( 'name' => 'Description', 'id' => 'desc', 'type' => 'textarea_small' ) );

	/* ----- SECTION 4 · INDUSTRIES -------------------------------------- */
	$ind = new_cmb2_box( array(
		'id'           => 'elliot_home_industries',
		'title'        => 'Home · 04 Industries',
		'object_types' => array( 'page' ),
		'show_on'      => $show_on,
		'closed'       => true,
	) );
	$ind->add_field( array( 'name' => 'Section label (left)', 'id' => 'elliot_ind_meta_l', 'type' => 'text', 'default' => $d['industries']['meta_l'] ) );
	$ind->add_field( array( 'name' => 'Section label (right)', 'id' => 'elliot_ind_meta_r', 'type' => 'text', 'default' => $d['industries']['meta_r'] ) );
	$ind->add_field( array( 'name' => 'Heading', 'id' => 'elliot_ind_title1', 'type' => 'text', 'default' => $d['industries']['title1'] ) );
	$ind->add_field( array( 'name' => 'Heading emphasis (italic gold)', 'id' => 'elliot_ind_emph', 'type' => 'text', 'default' => $d['industries']['emph'] ) );
	$ind_items = $ind->add_field( array(
		'name'    => 'Industries',
		'id'      => 'elliot_ind_items',
		'type'    => 'group',
		'options' => array(
			'group_title'   => 'Industry {#}',
			'add_button'    => 'Add industry',
			'remove_button' => 'Remove industry',
			'sortable'      => true,
			'closed'        => true,
		),
	) );
	$ind->add_group_field( $ind_items, array( 'name' => 'Code', 'id' => 'code', 'type' => 'text' ) );
	$ind->add_group_field( $ind_items, array( 'name' => 'Name', 'id' => 'name', 'type' => 'text' ) );

	/* ----- SECTION 5 · CREDENTIALS BAND -------------------------------- */
	$cred = new_cmb2_box( array(
		'id'           => 'elliot_home_credentials',
		'title'        => 'Home · 05 Credentials band',
		'object_types' => array( 'page' ),
		'show_on'      => $show_on,
		'closed'       => true,
	) );
	$cred->add_field( array( 'name' => 'Section label (left)', 'id' => 'elliot_cred_meta_l', 'type' => 'text', 'default' => $d['credentials']['meta_l'] ) );
	$cred->add_field( array( 'name' => 'Section label (right)', 'id' => 'elliot_cred_meta_r', 'type' => 'text', 'default' => $d['credentials']['meta_r'] ) );
	$cred->add_field( array( 'name' => 'Heading line 1', 'id' => 'elliot_cred_title1', 'type' => 'text', 'default' => $d['credentials']['title1'] ) );
	$cred->add_field( array( 'name' => 'Heading line 2', 'id' => 'elliot_cred_title2', 'type' => 'text', 'default' => $d['credentials']['title2'] ) );
	$cred->add_field( array( 'name' => 'Heading emphasis (italic gold)', 'id' => 'elliot_cred_emph', 'type' => 'text', 'default' => $d['credentials']['emph'] ) );
	$cred->add_field( array( 'name' => 'Paragraph', 'id' => 'elliot_cred_para', 'type' => 'textarea_small', 'default' => $d['credentials']['para'] ) );
	$cred_items = $cred->add_field( array(
		'name'    => 'Credential cards',
		'id'      => 'elliot_cred_items',
		'type'    => 'group',
		'options' => array(
			'group_title'   => 'Card {#}',
			'add_button'    => 'Add card',
			'remove_button' => 'Remove card',
			'sortable'      => true,
			'closed'        => true,
		),
	) );
	$cred->add_group_field( $cred_items, array( 'name' => 'Tag', 'id' => 'tag', 'type' => 'text' ) );
	$cred->add_group_field( $cred_items, array( 'name' => 'Title', 'id' => 'title', 'type' => 'text' ) );
	$cred->add_group_field( $cred_items, array( 'name' => 'Description', 'id' => 'desc', 'type' => 'textarea_small' ) );

	/* ----- SECTION 6 · FEATURED PROJECT -------------------------------- */
	$proj = new_cmb2_box( array(
		'id'           => 'elliot_home_project',
		'title'        => 'Home · 06 Featured project',
		'object_types' => array( 'page' ),
		'show_on'      => $show_on,
		'closed'       => true,
	) );
	$proj->add_field( array( 'name' => 'Section label (left)', 'id' => 'elliot_proj_meta_l', 'type' => 'text', 'default' => $d['project']['meta_l'] ) );
	$proj->add_field( array( 'name' => 'Section label (right)', 'id' => 'elliot_proj_meta_r', 'type' => 'text', 'default' => $d['project']['meta_r'] ) );
	$proj->add_field( array(
		'name' => 'Project photo',
		'id'   => 'elliot_proj_image',
		'type' => 'file',
		'options'      => array( 'url' => false ),
		'query_args'   => array( 'type' => 'image' ),
		'preview_size' => 'medium',
	) );
	$proj->add_field( array( 'name' => 'Eyebrow', 'id' => 'elliot_proj_eyebrow', 'type' => 'text', 'default' => $d['project']['eyebrow'] ) );
	$proj->add_field( array( 'name' => 'Title', 'id' => 'elliot_proj_title', 'type' => 'text', 'default' => $d['project']['title'] ) );
	$proj_specs = $proj->add_field( array(
		'name'    => 'Spec rows',
		'id'      => 'elliot_proj_specs',
		'type'    => 'group',
		'options' => array(
			'group_title'   => 'Spec {#}',
			'add_button'    => 'Add spec',
			'remove_button' => 'Remove spec',
			'sortable'      => true,
			'closed'        => true,
		),
	) );
	$proj->add_group_field( $proj_specs, array( 'name' => 'Label', 'id' => 'label', 'type' => 'text' ) );
	$proj->add_group_field( $proj_specs, array( 'name' => 'Value', 'id' => 'value', 'type' => 'text' ) );

	/* ----- SECTION 7 · PROCESS ----------------------------------------- */
	$proc = new_cmb2_box( array(
		'id'           => 'elliot_home_process',
		'title'        => 'Home · 07 Process',
		'object_types' => array( 'page' ),
		'show_on'      => $show_on,
		'closed'       => true,
	) );
	$proc->add_field( array( 'name' => 'Section label (left)', 'id' => 'elliot_proc_meta_l', 'type' => 'text', 'default' => $d['process']['meta_l'] ) );
	$proc->add_field( array( 'name' => 'Section label (right)', 'id' => 'elliot_proc_meta_r', 'type' => 'text', 'default' => $d['process']['meta_r'] ) );
	$proc->add_field( array( 'name' => 'Heading line 1', 'id' => 'elliot_proc_title1', 'type' => 'text', 'default' => $d['process']['title1'] ) );
	$proc->add_field( array( 'name' => 'Heading emphasis (italic gold)', 'id' => 'elliot_proc_emph', 'type' => 'text', 'default' => $d['process']['emph'] ) );
	$proc_steps = $proc->add_field( array(
		'name'    => 'Steps',
		'id'      => 'elliot_proc_steps',
		'type'    => 'group',
		'options' => array(
			'group_title'   => 'Step {#}',
			'add_button'    => 'Add step',
			'remove_button' => 'Remove step',
			'sortable'      => true,
			'closed'        => true,
		),
	) );
	$proc->add_group_field( $proc_steps, array( 'name' => 'Number', 'id' => 'num', 'type' => 'text' ) );
	$proc->add_group_field( $proc_steps, array( 'name' => 'Title', 'id' => 'title', 'type' => 'text' ) );
	$proc->add_group_field( $proc_steps, array( 'name' => 'Description', 'id' => 'desc', 'type' => 'textarea_small' ) );

	/* ----- SECTION 8 · ABOUT ------------------------------------------- */
	$about = new_cmb2_box( array(
		'id'           => 'elliot_home_about',
		'title'        => 'Home · 08 About',
		'object_types' => array( 'page' ),
		'show_on'      => $show_on,
		'closed'       => true,
	) );
	$about->add_field( array( 'name' => 'Section label (left)', 'id' => 'elliot_about_meta_l', 'type' => 'text', 'default' => $d['about']['meta_l'] ) );
	$about->add_field( array( 'name' => 'Section label (right)', 'id' => 'elliot_about_meta_r', 'type' => 'text', 'default' => $d['about']['meta_r'] ) );
	$about->add_field( array(
		'name' => 'Portrait photo',
		'id'   => 'elliot_about_image',
		'type' => 'file',
		'options'      => array( 'url' => false ),
		'query_args'   => array( 'type' => 'image' ),
		'preview_size' => 'medium',
	) );
	$about->add_field( array( 'name' => 'Heading line 1', 'id' => 'elliot_about_title1', 'type' => 'text', 'default' => $d['about']['title1'] ) );
	$about->add_field( array( 'name' => 'Heading emphasis (italic gold)', 'id' => 'elliot_about_emph', 'type' => 'text', 'default' => $d['about']['emph'] ) );
	$about->add_field( array( 'name' => 'Paragraph 1', 'id' => 'elliot_about_p1', 'type' => 'textarea_small', 'default' => $d['about']['p1'] ) );
	$about->add_field( array( 'name' => 'Paragraph 2', 'id' => 'elliot_about_p2', 'type' => 'textarea_small', 'default' => $d['about']['p2'] ) );
	$about_tags = $about->add_field( array(
		'name'    => 'Capability tags',
		'id'      => 'elliot_about_tags',
		'type'    => 'group',
		'options' => array(
			'group_title'   => 'Tag {#}',
			'add_button'    => 'Add tag',
			'remove_button' => 'Remove tag',
			'sortable'      => true,
			'closed'        => true,
		),
	) );
	$about->add_group_field( $about_tags, array( 'name' => 'Label', 'id' => 'label', 'type' => 'text' ) );

	/* ----- SECTION 9 · CTA --------------------------------------------- */
	$cta = new_cmb2_box( array(
		'id'           => 'elliot_home_cta',
		'title'        => 'Home · 09 Call to action',
		'object_types' => array( 'page' ),
		'show_on'      => $show_on,
		'closed'       => true,
	) );
	$cta->add_field( array( 'name' => 'Eyebrow', 'id' => 'elliot_cta_eyebrow', 'type' => 'text', 'default' => $d['cta']['eyebrow'] ) );
	$cta->add_field( array( 'name' => 'Heading', 'id' => 'elliot_cta_title1', 'type' => 'text', 'default' => $d['cta']['title1'] ) );
	$cta->add_field( array( 'name' => 'Heading emphasis (italic gold)', 'id' => 'elliot_cta_emph', 'type' => 'text', 'default' => $d['cta']['emph'] ) );
	$cta->add_field( array( 'name' => 'Paragraph', 'id' => 'elliot_cta_para', 'type' => 'textarea_small', 'default' => $d['cta']['para'] ) );
	$cta->add_field( array( 'name' => 'Button text', 'id' => 'elliot_cta_btn_text', 'type' => 'text', 'default' => $d['cta']['btn_text'] ) );
	$cta->add_field( array( 'name' => 'Button link', 'id' => 'elliot_cta_btn_link', 'type' => 'text', 'default' => $d['cta']['btn_link'] ) );
}
