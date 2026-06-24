<?php
/*
	Template Name: OSPS26 — Home
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$pid    = get_the_ID();
$prefix = 'osps_home_';

$hero_eyebrow      = get_post_meta( $pid, $prefix . 'hero_eyebrow', true ) ?: 'Medical Physics · Imaging Compliance';
$hero_h1_1         = get_post_meta( $pid, $prefix . 'hero_h1_line1', true ) ?: 'Diagnostic imaging,';
$hero_h1_2         = get_post_meta( $pid, $prefix . 'hero_h1_line2', true ) ?: 'measured to perfection.';
$hero_lead         = get_post_meta( $pid, $prefix . 'hero_lead', true ) ?: 'Independent medical physics for hospitals and imaging centers — Mammography, CT, MRI, Nuclear Medicine and more. We keep your systems accredited, your patients safe, and your operations audit-ready.';
$hero_btn1_label   = get_post_meta( $pid, $prefix . 'hero_btn_primary_label', true ) ?: 'Request a Consultation';
$hero_btn1_url     = get_post_meta( $pid, $prefix . 'hero_btn_primary_url', true ) ?: '#contact';
$hero_btn2_label   = get_post_meta( $pid, $prefix . 'hero_btn_secondary_label', true ) ?: 'Explore Services';
$hero_btn2_url     = get_post_meta( $pid, $prefix . 'hero_btn_secondary_url', true ) ?: '/services/';

$hero_stats = get_post_meta( $pid, $prefix . 'hero_stats', true );
if ( empty( $hero_stats ) || ! is_array( $hero_stats ) ) {
	$hero_stats = array(
		array( 'number' => '1,000s', 'label' => 'Systems guided to accreditation' ),
		array( 'number' => 'All 4',  'label' => 'Major bodies: ACR · TJC · IAC · RadSite' ),
		array( 'number' => '100%',   'label' => 'Board-certified physicists' ),
	);
}

$trust_label = get_post_meta( $pid, $prefix . 'trust_label', true ) ?: 'Accreditation expertise across';
$trust_chips = get_post_meta( $pid, $prefix . 'trust_chips', true );
if ( empty( $trust_chips ) || ! is_array( $trust_chips ) ) {
	$trust_chips = array( 'ACR', 'The Joint Commission', 'IAC', 'RadSite', 'State & FDA / MQSA' );
}

$mod_eyebrow = get_post_meta( $pid, $prefix . 'mod_eyebrow', true ) ?: 'What we test';
$mod_title   = get_post_meta( $pid, $prefix . 'mod_title', true ) ?: 'Physics support for every imaging modality';
$mod_intro   = get_post_meta( $pid, $prefix . 'mod_intro', true ) ?: 'Annual surveys, equipment evaluations, and ongoing QC — performed by board-certified physicists.';
$mod_items = array_values( array_filter( (array) get_post_meta( $pid, $prefix . 'mod_items', true ), function ( $row ) {
	$row = (array) $row;
	return ! empty( $row['title'] ) || ! empty( $row['desc'] );
} ) );
if ( empty( $mod_items ) ) {
	$mod_items = array(
		array( 'icon' => 'mammography', 'title' => 'Mammography', 'desc' => 'MQSA & ACR surveys, ADM evaluations, breast tomosynthesis.' ),
		array( 'icon' => 'ct',          'title' => 'CT',          'desc' => 'Dose optimization, CTDI, image quality & ACR phantom analysis.' ),
		array( 'icon' => 'mri',         'title' => 'MRI',         'desc' => 'ACR phantom, SNR & geometric accuracy, plus implant safety.' ),
		array( 'icon' => 'nuclear',     'title' => 'Nuclear Med', 'desc' => 'Gamma camera, SPECT & PET uniformity, dose calibrator QC.' ),
		array( 'icon' => 'fluoro',      'title' => 'Fluoroscopy', 'desc' => 'Entrance exposure, AKR, image intensifier & flat-panel QC.' ),
		array( 'icon' => 'xray',        'title' => 'X-Ray / DR',  'desc' => 'Radiographic & portable units, kVp, HVL and detector QC.' ),
	);
}

$svc_eyebrow   = get_post_meta( $pid, $prefix . 'svc_eyebrow', true ) ?: 'Core services';
$svc_title     = get_post_meta( $pid, $prefix . 'svc_title', true ) ?: 'One partner for compliance, safety & design';
$svc_link_text = get_post_meta( $pid, $prefix . 'svc_link_text', true ) ?: 'View all services';
$svc_link_url  = get_post_meta( $pid, $prefix . 'svc_link_url', true ) ?: '/services/';
$svc_items = array_values( array_filter( (array) get_post_meta( $pid, $prefix . 'svc_items', true ), function ( $row ) {
	$row = (array) $row;
	return ! empty( $row['title'] ) || ! empty( $row['desc'] );
} ) );
if ( empty( $svc_items ) ) {
	$svc_items = array(
		array( 'icon' => 'accreditation', 'title' => 'Accreditation Guidance',     'desc' => 'End-to-end support for ACR, TJC, IAC and RadSite — applications, testing, documentation and on-site survey prep.', 'tag' => 'ACR · TJC · IAC · RadSite', 'url' => '/services/#accreditation' ),
		array( 'icon' => 'mri-safety',    'title' => 'MRI Safety',                 'desc' => 'MRI implant safety evaluations, Zone signage, screening protocols and MRSO/MRSE program support.',                       'tag' => 'MRSO / MRSE',              'url' => '/services/#mri-safety' ),
		array( 'icon' => 'rso',           'title' => 'Radiation Safety (RSO)',     'desc' => 'Radiation Safety Officer support for medical and industrial sectors — program management, audits and training.',           'tag' => 'Medical & Industrial',     'url' => '/services/#rso' ),
		array( 'icon' => 'facility',      'title' => 'Facility & Shielding Design','desc' => 'Structural shielding design and evaluation for new builds and renovations, with stamped reports.',                          'tag' => 'Shielding · Layout',       'url' => '/services/#facility' ),
		array( 'icon' => 'advanced',      'title' => 'Advanced Technology',        'desc' => 'AI performance evaluation and theranostic program development to keep your imaging program future-ready.',                'tag' => 'AI · Theranostics',        'url' => '/services/#advanced' ),
	);
}
$svc_cta_title = get_post_meta( $pid, $prefix . 'svc_cta_title', true ) ?: 'Not sure where to start?';
$svc_cta_desc  = get_post_meta( $pid, $prefix . 'svc_cta_desc', true ) ?: "Tell us your equipment and deadlines — we'll map the exact testing and documentation you need.";
$svc_cta_btn_l = get_post_meta( $pid, $prefix . 'svc_cta_btn_label', true ) ?: 'Talk to a physicist';
$svc_cta_btn_u = get_post_meta( $pid, $prefix . 'svc_cta_btn_url', true ) ?: '#contact';

$why_eyebrow = get_post_meta( $pid, $prefix . 'why_eyebrow', true ) ?: 'Why One Stop';
$why_heading = get_post_meta( $pid, $prefix . 'why_heading', true ) ?: "Founded by a medical physicist who's been in your shoes";
$why_lead    = get_post_meta( $pid, $prefix . 'why_lead', true ) ?: 'One Stop Physics Service was founded by a medical physicist who understands the challenges healthcare providers face today. We deliver diagnostic physics compliance that reduces risk and protects your reputation.';
$why_btn_l   = get_post_meta( $pid, $prefix . 'why_btn_label', true ) ?: 'See how we work';
$why_btn_u   = get_post_meta( $pid, $prefix . 'why_btn_url', true ) ?: '/services/';
$why_stats   = get_post_meta( $pid, $prefix . 'why_stats', true );
if ( empty( $why_stats ) || ! is_array( $why_stats ) ) {
	$why_stats = array(
		array( 'number' => '1,000', 'unit' => 's', 'label' => 'Imaging systems guided through accreditation' ),
		array( 'number' => '24',    'unit' => 'h', 'label' => 'Typical turnaround on MRI implant clearances' ),
		array( 'number' => '4',     'unit' => '+', 'label' => 'Board certifications held across our team' ),
		array( 'number' => '50',    'unit' => '+', 'label' => 'Facilities supported nationwide' ),
	);
}

$cert_eyebrow = get_post_meta( $pid, $prefix . 'cert_eyebrow', true ) ?: 'Credentials you can trust';
$cert_title   = get_post_meta( $pid, $prefix . 'cert_title', true ) ?: 'Board-certified expertise';
$cert_intro   = get_post_meta( $pid, $prefix . 'cert_intro', true ) ?: 'Our physicists hold the highest certifications in the field, so your reports stand up to any surveyor or regulator.';
$cert_rows    = get_post_meta( $pid, $prefix . 'cert_rows', true );
if ( empty( $cert_rows ) || ! is_array( $cert_rows ) ) {
	$cert_rows = array(
		array( 'title' => 'American Board of Radiology',                       'sub' => 'ABR — Diagnostic Medical Physics' ),
		array( 'title' => 'American Board of Science in Nuclear Medicine',     'sub' => 'ABSNM' ),
		array( 'title' => 'American Board of Medical Physics',                 'sub' => 'ABMP' ),
		array( 'title' => 'Magnetic Resonance Safety',                         'sub' => 'MRSO & MRSE certified' ),
	);
}
$accr_label = get_post_meta( $pid, $prefix . 'accr_label', true ) ?: 'We help you achieve & maintain accreditation with';
$accr_tiles = get_post_meta( $pid, $prefix . 'accr_tiles', true );
if ( empty( $accr_tiles ) || ! is_array( $accr_tiles ) ) {
	$accr_tiles = array(
		array( 'mono' => 'ACR',     'full' => 'American College of Radiology' ),
		array( 'mono' => 'TJC',     'full' => 'The Joint Commission' ),
		array( 'mono' => 'IAC',     'full' => 'Intersocietal Accreditation' ),
		array( 'mono' => 'RadSite', 'full' => 'Imaging Accreditation' ),
		array( 'mono' => 'MQSA',    'full' => 'FDA Mammography' ),
		array( 'mono' => 'State',   'full' => 'Dept. of Health' ),
	);
}
$cert_card_title = get_post_meta( $pid, $prefix . 'cert_card_title', true ) ?: 'Survey-ready documentation, every time';
$cert_card_desc  = get_post_meta( $pid, $prefix . 'cert_card_desc', true ) ?: 'Every visit ends with a clear, defensible report — corrective actions flagged, tolerances charted, and ready to hand to any surveyor.';

$cta_eyebrow = get_post_meta( $pid, $prefix . 'cta_eyebrow', true ) ?: 'Get started';
$cta_heading = get_post_meta( $pid, $prefix . 'cta_heading', true ) ?: 'Ready to keep your imaging program audit-ready?';
$cta_lead    = get_post_meta( $pid, $prefix . 'cta_lead', true ) ?: "Send us your equipment list and deadlines. We'll respond with a clear scope, timeline and quote — usually within one business day.";
$cta_btn1_l  = get_post_meta( $pid, $prefix . 'cta_btn1_label', true ) ?: 'Call (813) 743-2373';
$cta_btn1_u  = get_post_meta( $pid, $prefix . 'cta_btn1_url', true ) ?: 'tel:+18137432373';
$cta_btn2_l  = get_post_meta( $pid, $prefix . 'cta_btn2_label', true ) ?: 'Request a Consultation';
$cta_btn2_u  = get_post_meta( $pid, $prefix . 'cta_btn2_url', true ) ?: 'mailto:Lei@osps26.com';
?>

<main class="osps26">

	<!-- ===================== SECTION 01 — HERO ===================== -->
	<header class="hero">
		<div class="hero-grid"></div>
		<div class="container position-relative py-5">
			<div class="row align-items-center g-5">
				<div class="col-lg-6">
					<span class="eyebrow mb-3"><?php echo esc_html( $hero_eyebrow ); ?></span>
					<h1 class="display mb-4"><?php echo esc_html( $hero_h1_1 ); ?><br><span class="accent"><?php echo esc_html( $hero_h1_2 ); ?></span></h1>
					<p class="lead-xl mb-4 pe-lg-4"><?php echo esc_html( $hero_lead ); ?></p>
					<div class="d-flex flex-wrap gap-3 mb-5">
						<a href="<?php echo esc_url( $hero_btn1_url ); ?>" class="btn btn-brand btn-lg"><?php echo esc_html( $hero_btn1_label ); ?></a>
						<a href="<?php echo esc_url( $hero_btn2_url ); ?>" class="btn btn-ghost btn-lg"><?php echo esc_html( $hero_btn2_label ); ?></a>
					</div>
					<div class="hero-stats">
						<?php foreach ( (array) $hero_stats as $stat ) : $stat = (array) $stat; ?>
							<div>
								<div class="n"><?php echo esc_html( $stat['number'] ?? '' ); ?></div>
								<div class="l"><?php echo esc_html( $stat['label'] ?? '' ); ?></div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="hero-visual">
						<div class="scanwrap">
							<svg viewBox="0 0 400 430" width="100%" height="100%" preserveAspectRatio="xMidYMid slice" fill="none">
								<defs>
									<radialGradient id="hg" cx="50%" cy="42%" r="60%">
										<stop offset="0%" stop-color="#eafcff" stop-opacity=".22"/>
										<stop offset="100%" stop-color="#eafcff" stop-opacity="0"/>
									</radialGradient>
								</defs>
								<rect width="400" height="430" fill="url(#hg)"/>
								<g stroke="#9be7f0" stroke-opacity=".5" stroke-width="1.4">
									<circle cx="200" cy="190" r="150"/>
									<circle cx="200" cy="190" r="120"/>
									<circle cx="200" cy="190" r="86"/>
									<circle cx="200" cy="190" r="50"/>
								</g>
								<g stroke="#bdf0f6" stroke-opacity=".28" stroke-width="1">
									<line x1="200" y1="40" x2="200" y2="340"/>
									<line x1="50" y1="190" x2="350" y2="190"/>
									<line x1="94" y1="84" x2="306" y2="296"/>
									<line x1="306" y1="84" x2="94" y2="296"/>
								</g>
								<path d="M200 190 L200 40 A150 150 0 0 1 330 115 Z" fill="#22B5C6" fill-opacity=".18"/>
								<g fill="#ffffff" fill-opacity=".10" stroke="#cdf3f8" stroke-opacity=".4" stroke-width="1.2">
									<ellipse cx="170" cy="170" rx="38" ry="46"/>
									<ellipse cx="232" cy="178" rx="30" ry="40"/>
									<circle cx="200" cy="240" r="22"/>
								</g>
								<circle cx="200" cy="190" r="4" fill="#22B5C6"/>
								<g stroke="#22B5C6" stroke-opacity=".7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" fill="none">
									<path d="M40 392 H120 l10 -26 l14 52 l12 -78 l14 104 l10 -52 H400"/>
								</g>
							</svg>
						</div>
						<div class="position-absolute bottom-0 start-0 text-white ms-4 mb-4" style="z-index:3;">
							<div class="text-uppercase small opacity-75" style="letter-spacing:.18em;font-size:.72rem;">Live QC reading</div>
							<div class="fw-bold" style="font-family:var(--font-head);font-size:1.05rem;">CT · WW 400 / WL 0 — Within tolerance</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</header>

	<!-- ===================== SECTION 02 — TRUST STRIP ===================== -->
	<section class="trust-strip py-4">
		<div class="container">
			<div class="row align-items-center g-3">
				<div class="col-lg-3"><span class="label"><?php echo esc_html( $trust_label ); ?></span></div>
				<div class="col-lg-9">
					<div class="d-flex flex-wrap justify-content-lg-end gap-4 gap-lg-5">
						<?php foreach ( $trust_chips as $chip ) : if ( '' === trim( $chip ) ) continue; ?>
							<span class="cert-chip"><span class="dot"></span><?php echo esc_html( $chip ); ?></span>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- ===================== SECTION 03 — MODALITIES ===================== -->
	<section class="section">
		<div class="container">
			<div class="row align-items-end mb-5">
				<div class="col-lg-8">
					<span class="eyebrow mb-3"><?php echo esc_html( $mod_eyebrow ); ?></span>
					<h2 class="sec-title"><?php echo esc_html( $mod_title ); ?></h2>
				</div>
				<div class="col-lg-4 text-lg-end">
					<p class="mb-0 text-secondary"><?php echo esc_html( $mod_intro ); ?></p>
				</div>
			</div>
			<div class="row g-4">
				<?php foreach ( (array) $mod_items as $m ) : $m = (array) $m; ?>
					<div class="col-6 col-lg-4 col-xl-2 fade-up">
						<div class="modality">
							<span class="m-ico"><?php echo osps_modality_icon( $m['icon'] ?? '' ); ?></span>
							<h3><?php echo esc_html( $m['title'] ?? '' ); ?></h3>
							<p><?php echo esc_html( $m['desc'] ?? '' ); ?></p>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- ===================== SECTION 04 — SERVICES OVERVIEW ===================== -->
	<section class="section mist">
		<div class="container">
			<div class="row align-items-end mb-5">
				<div class="col-lg-7">
					<span class="eyebrow mb-3"><?php echo esc_html( $svc_eyebrow ); ?></span>
					<h2 class="sec-title"><?php echo esc_html( $svc_title ); ?></h2>
				</div>
				<div class="col-lg-5 text-lg-end align-self-center">
					<a href="<?php echo esc_url( $svc_link_url ); ?>" class="link-arrow"><?php echo esc_html( $svc_link_text ); ?>
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
					</a>
				</div>
			</div>
			<div class="row g-4">
				<?php foreach ( (array) $svc_items as $s ) : $s = (array) $s; ?>
					<div class="col-md-6 col-lg-4 fade-up">
						<a href="<?php echo esc_url( $s['url'] ?? '' ); ?>" class="text-reset svc-card d-block">
							<span class="s-ico"><?php echo osps_service_icon( $s['icon'] ?? '' ); ?></span>
							<h3><?php echo esc_html( $s['title'] ?? '' ); ?></h3>
							<p><?php echo esc_html( $s['desc'] ?? '' ); ?></p>
							<?php if ( ! empty( $s['tag'] ) ) : ?>
								<span class="tag"><?php echo esc_html( $s['tag'] ); ?></span>
							<?php endif; ?>
						</a>
					</div>
				<?php endforeach; ?>
				<div class="col-md-6 col-lg-4 fade-up">
					<div class="svc-card d-flex flex-column justify-content-center border-0" style="background:linear-gradient(150deg,var(--teal),var(--blue-700));">
						<h3 class="text-white"><?php echo esc_html( $svc_cta_title ); ?></h3>
						<p class="text-white-50"><?php echo esc_html( $svc_cta_desc ); ?></p>
						<a href="<?php echo esc_url( $svc_cta_btn_u ); ?>" class="btn btn-cyan align-self-start mt-1"><?php echo esc_html( $svc_cta_btn_l ); ?></a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- ===================== SECTION 05 — WHY US / STATS BAND ===================== -->
	<section class="section band-dark">
		<span class="glow" style="left:-120px;top:-120px;"></span>
		<span class="glow" style="right:-160px;bottom:-200px;"></span>
		<div class="container position-relative">
			<div class="row g-5 align-items-center">
				<div class="col-lg-5">
					<span class="eyebrow on-dark mb-3"><?php echo esc_html( $why_eyebrow ); ?></span>
					<h2 class="sec-sub mb-3 fw-bolder" style="font-family:var(--font-head);"><?php echo esc_html( $why_heading ); ?></h2>
					<p class="lead-xl mb-4"><?php echo esc_html( $why_lead ); ?></p>
					<a href="<?php echo esc_url( $why_btn_u ); ?>" class="btn btn-cyan"><?php echo esc_html( $why_btn_l ); ?></a>
				</div>
				<div class="col-lg-7">
					<div class="row g-4">
						<?php foreach ( (array) $why_stats as $st ) : $st = (array) $st; ?>
							<div class="col-sm-6">
								<div class="bigstat">
									<div class="n"><?php echo esc_html( $st['number'] ?? '' ); ?><?php if ( ! empty( $st['unit'] ) ) : ?><span class="u"><?php echo esc_html( $st['unit'] ); ?></span><?php endif; ?></div>
									<div class="l"><?php echo esc_html( $st['label'] ?? '' ); ?></div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- ===================== SECTION 06 — CERTIFICATIONS ===================== -->
	<section class="section">
		<div class="container">
			<div class="row g-5">
				<div class="col-lg-5">
					<span class="eyebrow mb-3"><?php echo esc_html( $cert_eyebrow ); ?></span>
					<h2 class="sec-title mb-3"><?php echo esc_html( $cert_title ); ?></h2>
					<p class="text-secondary mb-4"><?php echo esc_html( $cert_intro ); ?></p>
					<div>
						<?php foreach ( (array) $cert_rows as $cr ) : $cr = (array) $cr; ?>
							<div class="cert-row">
								<span class="badge-ico"><?php echo osps_badge_icon(); ?></span>
								<div><b><?php echo esc_html( $cr['title'] ?? '' ); ?></b><span><?php echo esc_html( $cr['sub'] ?? '' ); ?></span></div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
				<div class="col-lg-7">
					<div class="row g-3 align-items-stretch">
						<div class="col-12">
							<p class="label trust-strip border-0 p-0 mb-2 bg-transparent"><?php echo esc_html( $accr_label ); ?></p>
						</div>
						<?php foreach ( (array) $accr_tiles as $tile ) : $tile = (array) $tile; ?>
							<div class="col-4 col-md-3">
								<div class="accr-tile">
									<span class="mono"><?php echo esc_html( $tile['mono'] ?? '' ); ?></span>
									<span class="full"><?php echo esc_html( $tile['full'] ?? '' ); ?></span>
								</div>
							</div>
						<?php endforeach; ?>
						<div class="col-12">
							<div class="svc-card mt-2 border-0" style="background:var(--cream);">
								<div class="d-flex align-items-start gap-3">
									<span class="m-ico flex-shrink-0"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6M9 15l2 2 4-4"/></svg></span>
									<div>
										<h3 class="fs-6 mt-0 mb-1"><?php echo esc_html( $cert_card_title ); ?></h3>
										<p class="m-0 small" style="color:var(--slate);"><?php echo esc_html( $cert_card_desc ); ?></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- ===================== SECTION 07 — CTA ===================== -->
	<section class="pb-5 pt-2" id="contact">
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
