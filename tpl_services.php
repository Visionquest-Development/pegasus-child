<?php
/*
	Template Name: OSPS26 — Services
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$pid    = get_the_ID();
$prefix = 'osps_svcs_';

$hero_eyebrow = get_post_meta( $pid, $prefix . 'hero_eyebrow', true ) ?: 'What we do';
$hero_h1      = get_post_meta( $pid, $prefix . 'hero_h1', true ) ?: 'Comprehensive medical physics, end to end';
$hero_lead    = get_post_meta( $pid, $prefix . 'hero_lead', true ) ?: 'From accreditation and routine QC to shielding design and AI evaluation — one team keeps every imaging modality compliant, safe and performing at its best.';
$hero_chips   = get_post_meta( $pid, $prefix . 'hero_chips', true );
if ( empty( $hero_chips ) || ! is_array( $hero_chips ) ) {
	$hero_chips = array(
		array( 'label' => 'Accreditation',    'anchor' => '#accreditation' ),
		array( 'label' => 'MRI Safety',       'anchor' => '#mri-safety' ),
		array( 'label' => 'Radiation Safety', 'anchor' => '#rso' ),
		array( 'label' => 'Facility Design',  'anchor' => '#facility' ),
		array( 'label' => 'Advanced Tech',    'anchor' => '#advanced' ),
	);
}

$blocks = get_post_meta( $pid, $prefix . 'blocks', true );
if ( empty( $blocks ) || ! is_array( $blocks ) ) {
	$blocks = array(
		array(
			'anchor'   => 'accreditation',
			'num'      => '01 — Accreditation',
			'heading'  => 'Accreditation Guidance',
			'desc'     => "We've guided thousands of imaging systems to accreditation across every major body. From the first application to the on-site survey, we handle the testing and documentation so your team can stay focused on patients.",
			'features' => array(
				'<b>ACR, TJC, IAC & RadSite</b> — application support, phantom testing and submission packages.',
				'<b>Annual physics surveys</b> across CT, MRI, mammography, nuclear medicine, fluoroscopy and X-ray.',
				'<b>Survey-ready reports</b> with charted tolerances and clear corrective actions.',
			),
			'tags'    => array( 'ACR', 'The Joint Commission', 'IAC', 'RadSite', 'MQSA' ),
			'visual'  => 'check',
			'scheme'  => 'teal-blue',
			'reverse' => '',
			'mist'    => '',
		),
		array(
			'anchor'   => 'mri-safety',
			'num'      => '02 — MRI Safety',
			'heading'  => 'MRI Safety & Implant Evaluations',
			'desc'     => "Magnetic fields don't forgive guesswork. We evaluate implants, build screening protocols and stand up the MRSO/MRSE program your facility needs to scan with confidence.",
			'features' => array(
				'<b>Implant safety evaluations</b> with documented conditional-scanning parameters — typically within 24 hours.',
				'<b>Zone design & signage</b> and patient screening protocols that satisfy surveyors.',
				'<b>MRSO / MRSE support</b> and staff training to maintain a compliant safety program.',
			),
			'tags'    => array( 'Implant clearance', 'Zone IV signage', 'MRSO / MRSE' ),
			'visual'  => 'mri',
			'scheme'  => 'blue-teal',
			'reverse' => 'on',
			'mist'    => 'on',
		),
		array(
			'anchor'   => 'rso',
			'num'      => '03 — Radiation Safety',
			'heading'  => 'Radiation Safety Officer (RSO) Support',
			'desc'     => 'Whether you need a designated RSO or expert backup for the one you have, we run a defensible radiation safety program for medical and industrial sectors alike.',
			'features' => array(
				'<b>Designated & consulting RSO</b> services for medical and industrial facilities.',
				'<b>Program management & audits</b> — license maintenance, ALARA reviews and dosimetry oversight.',
				'<b>Staff training</b> and regulatory liaison with state and federal agencies.',
			),
			'tags'    => array( 'Medical', 'Industrial', 'ALARA', 'Licensing' ),
			'visual'  => 'trefoil',
			'scheme'  => 'teal-deep',
			'reverse' => '',
			'mist'    => '',
		),
		array(
			'anchor'   => 'facility',
			'num'      => '04 — Facility Design',
			'heading'  => 'Facility & Shielding Design',
			'desc'     => 'Building or renovating? We design and evaluate structural shielding for diagnostic and therapeutic suites, delivering stamped reports that pass inspection the first time.',
			'features' => array(
				'<b>Shielding design calculations</b> for CT, X-ray, fluoroscopy, mammography and nuclear medicine suites.',
				'<b>Post-construction surveys</b> to verify barriers perform as designed.',
				'<b>Stamped, regulator-ready reports</b> for permitting and equipment installation.',
			),
			'tags'    => array( 'Shielding calcs', 'Room layout', 'Barrier survey' ),
			'visual'  => 'facility',
			'scheme'  => 'blue7-teal',
			'reverse' => 'on',
			'mist'    => 'on',
		),
		array(
			'anchor'   => 'advanced',
			'num'      => '05 — Advanced Technology',
			'heading'  => 'AI Evaluation & Theranostics',
			'desc'     => 'The imaging landscape is moving fast. We help you adopt new technology responsibly — validating AI tools and developing theranostic programs grounded in sound physics.',
			'features' => array(
				'<b>AI performance evaluation</b> — acceptance testing and ongoing QA for AI imaging tools.',
				'<b>Theranostic program development</b> — dosimetry, workflow and safety from the ground up.',
				'<b>Technology roadmaps</b> to plan investments with confidence.',
			),
			'tags'    => array( 'AI QA', 'Theranostics', 'Dosimetry' ),
			'visual'  => 'chip',
			'scheme'  => 'teal-blue-2',
			'reverse' => '',
			'mist'    => '',
		),
	);
}

$proc_eyebrow = get_post_meta( $pid, $prefix . 'proc_eyebrow', true ) ?: 'How we work';
$proc_title   = get_post_meta( $pid, $prefix . 'proc_title', true ) ?: 'A clear path to compliance';
$proc_steps   = get_post_meta( $pid, $prefix . 'proc_steps', true );
if ( empty( $proc_steps ) || ! is_array( $proc_steps ) ) {
	$proc_steps = array(
		array( 'number' => '1', 'title' => 'Scope & quote',      'desc' => 'Send your equipment list and deadlines. We map exactly what testing and documentation you need — usually within one business day.' ),
		array( 'number' => '2', 'title' => 'Schedule',           'desc' => 'We coordinate around your clinical hours to minimize downtime, on-site or remote where appropriate.' ),
		array( 'number' => '3', 'title' => 'Test & evaluate',    'desc' => 'Board-certified physicists perform measurements, evaluations and safety reviews to current standards.' ),
		array( 'number' => '4', 'title' => 'Report & support',   'desc' => 'You receive a survey-ready report with corrective actions, plus follow-up support through your survey.' ),
	);
}

$cta_eyebrow = get_post_meta( $pid, $prefix . 'cta_eyebrow', true ) ?: 'Get started';
$cta_heading = get_post_meta( $pid, $prefix . 'cta_heading', true ) ?: 'Tell us what you need tested';
$cta_lead    = get_post_meta( $pid, $prefix . 'cta_lead', true ) ?: "Share your equipment and timelines and we'll respond with a clear scope, schedule and quote.";
$cta_btn1_l  = get_post_meta( $pid, $prefix . 'cta_btn1_label', true ) ?: 'Call (813) 743-2373';
$cta_btn1_u  = get_post_meta( $pid, $prefix . 'cta_btn1_url', true ) ?: 'tel:+18137432373';
$cta_btn2_l  = get_post_meta( $pid, $prefix . 'cta_btn2_label', true ) ?: 'Request a Consultation';
$cta_btn2_u  = get_post_meta( $pid, $prefix . 'cta_btn2_url', true ) ?: 'mailto:Lei@osps26.com';

$home_url = esc_url( home_url( '/' ) );
?>

<main class="osps26">

	<!-- ===================== SECTION 01 — PAGE HERO ===================== -->
	<header class="page-hero">
		<span class="glow"></span>
		<div class="grid-deco"></div>
		<div class="container position-relative py-5">
			<div class="row">
				<div class="col-lg-8">
					<div class="crumbs mb-3"><a href="<?php echo $home_url; ?>">Home</a> &nbsp;/&nbsp; <span class="text-white"><?php echo esc_html( get_the_title() ); ?></span></div>
					<span class="eyebrow on-dark mb-3"><?php echo esc_html( $hero_eyebrow ); ?></span>
					<h1 class="display mb-4" style="font-size:clamp(2.4rem,4.6vw,3.6rem);"><?php echo esc_html( $hero_h1 ); ?></h1>
					<p class="lead-xl mb-0 pe-lg-5"><?php echo esc_html( $hero_lead ); ?></p>
				</div>
			</div>
			<div class="row g-3 mt-4 pt-3">
				<?php foreach ( $hero_chips as $chip ) : $chip = wp_parse_args( (array) $chip, array( 'label' => '', 'anchor' => '' ) ); ?>
					<div class="col-6 col-md-auto"><a href="<?php echo esc_url( $chip['anchor'] ); ?>" class="btn btn-ghost on-dark btn-sm"><?php echo esc_html( $chip['label'] ); ?></a></div>
				<?php endforeach; ?>
			</div>
		</div>
	</header>

	<!-- ===================== SECTION 02 — SERVICE DETAIL BLOCKS ===================== -->
	<?php foreach ( $blocks as $i => $b ) :
		$b           = wp_parse_args( (array) $b, array( 'anchor' => '', 'num' => '', 'heading' => '', 'desc' => '', 'features' => array(), 'tags' => array(), 'visual' => 'check', 'scheme' => 'teal-blue', 'reverse' => '', 'mist' => '' ) );
		$reverse_cls = ( 'on' === $b['reverse'] ) ? ' flex-lg-row-reverse' : '';
		$mist_cls    = ( 'on' === $b['mist'] ) ? ' section mist' : '';
		$gradient    = osps_visual_gradient( $b['scheme'] );
		?>
		<section id="<?php echo esc_attr( $b['anchor'] ); ?>" class="svc-detail border-0<?php echo esc_attr( $mist_cls ); ?>">
			<div class="container">
				<div class="row g-5 align-items-center<?php echo esc_attr( $reverse_cls ); ?>">
					<div class="col-lg-6 fade-up">
						<div class="num"><?php echo esc_html( $b['num'] ); ?></div>
						<h2><?php echo esc_html( $b['heading'] ); ?></h2>
						<p class="mb-4"><?php echo esc_html( $b['desc'] ); ?></p>
						<?php if ( ! empty( $b['features'] ) && is_array( $b['features'] ) ) : foreach ( $b['features'] as $feat ) : if ( '' === trim( $feat ) ) continue; ?>
							<div class="feat">
								<?php echo osps_check_icon(); ?>
								<div><?php echo wp_kses( $feat, array( 'b' => array(), 'strong' => array(), 'em' => array(), 'i' => array(), 'br' => array() ) ); ?></div>
							</div>
						<?php endforeach; endif; ?>
						<?php if ( ! empty( $b['tags'] ) && is_array( $b['tags'] ) ) : ?>
							<div class="d-flex flex-wrap gap-2 mt-4">
								<?php foreach ( $b['tags'] as $tag ) : if ( '' === trim( $tag ) ) continue; ?>
									<span class="tag"><?php echo esc_html( $tag ); ?></span>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
					</div>
					<div class="col-lg-6 fade-up">
						<div class="svc-visual" style="background:<?php echo esc_attr( $gradient ); ?>;">
							<div class="scan-deco">
								<?php echo osps_visual_svg( $b['visual'] ); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	<?php endforeach; ?>

	<!-- ===================== SECTION 03 — PROCESS ===================== -->
	<section class="section cream">
		<div class="container">
			<div class="text-center mb-5">
				<span class="eyebrow centered mb-3"><?php echo esc_html( $proc_eyebrow ); ?></span>
				<h2 class="sec-title"><?php echo esc_html( $proc_title ); ?></h2>
			</div>
			<div class="row g-4">
				<?php foreach ( $proc_steps as $st ) : $st = wp_parse_args( (array) $st, array( 'number' => '', 'title' => '', 'desc' => '' ) ); ?>
					<div class="col-md-6 col-lg-3 fade-up">
						<div class="step">
							<div class="step-n"><?php echo esc_html( $st['number'] ); ?></div>
							<h3><?php echo esc_html( $st['title'] ); ?></h3>
							<p><?php echo esc_html( $st['desc'] ); ?></p>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- ===================== SECTION 04 — CTA ===================== -->
	<section class="section pt-5" id="contact">
		<div class="container">
			<div class="cta-band p-4 p-lg-5">
				<svg class="trefoil-bg" viewBox="0 0 100 100"><g fill="currentColor"><path d="M 57.5 37.0 A 15 15 0 0 1 42.5 37.0 L 29.0 13.6 A 42 42 0 0 1 71.0 13.6 Z"/><path transform="rotate(120 50 50)" d="M 57.5 37.0 A 15 15 0 0 1 42.5 37.0 L 29.0 13.6 A 42 42 0 0 1 71.0 13.6 Z"/><path transform="rotate(240 50 50)" d="M 57.5 37.0 A 15 15 0 0 1 42.5 37.0 L 29.0 13.6 A 42 42 0 0 1 71.0 13.6 Z"/><circle cx="50" cy="50" r="7.5"/></g></svg>
				<div class="row align-items-center g-4 position-relative">
					<div class="col-lg-7">
						<span class="eyebrow on-dark mb-3"><?php echo esc_html( $cta_eyebrow ); ?></span>
						<h2 class="sec-title mb-2"><?php echo esc_html( $cta_heading ); ?></h2>
						<p class="lead-xl mb-0 text-white-50"><?php echo esc_html( $cta_lead ); ?></p>
					</div>
					<div class="col-lg-5 text-lg-end">
						<div class="d-flex flex-column flex-sm-row gap-3 justify-content-lg-end">
							<a href="<?php echo esc_url( $cta_btn1_u ); ?>" class="btn btn-white btn-lg"><?php echo esc_html( $cta_btn1_l ); ?></a>
							<a href="<?php echo esc_url( $cta_btn2_u ); ?>" class="btn btn-cyan btn-lg"><?php echo esc_html( $cta_btn2_l ); ?></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

</main>

<?php get_footer(); ?>
