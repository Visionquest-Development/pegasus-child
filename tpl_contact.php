<?php
/*
	Template Name: OSPS26 — Contact
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$pid    = get_the_ID();
$prefix = 'osps_contact_';

$hero_eyebrow = get_post_meta( $pid, $prefix . 'hero_eyebrow', true ) ?: 'Get in touch';
$hero_h1      = get_post_meta( $pid, $prefix . 'hero_h1', true ) ?: "Let's talk about your imaging program";
$hero_lead    = get_post_meta( $pid, $prefix . 'hero_lead', true ) ?: "Share your equipment and timelines and we'll respond with a clear scope, schedule and quote — usually within one business day.";

$sec_eyebrow = get_post_meta( $pid, $prefix . 'sec_eyebrow', true ) ?: 'How to contact us';
$sec_title   = get_post_meta( $pid, $prefix . 'sec_title', true ) ?: 'Multiple ways to connect';
$sec_intro   = get_post_meta( $pid, $prefix . 'sec_intro', true ) ?: 'Pick the channel that works best — we respond promptly to all inquiries.';

$methods = get_post_meta( $pid, $prefix . 'methods', true );
if ( empty( $methods ) || ! is_array( $methods ) ) {
	$methods = array(
		array(
			'icon'        => 'email',
			'title'       => 'Email',
			'line1_label' => 'Primary',
			'line1_value' => 'Lei@osps26.com',
			'line1_url'   => 'mailto:Lei@osps26.com',
			'line2_label' => 'Secondary',
			'line2_value' => 'Leodingsz@gmail.com',
			'line2_url'   => 'mailto:Leodingsz@gmail.com',
		),
		array(
			'icon'        => 'phone',
			'title'       => 'Phone',
			'line1_label' => 'Call',
			'line1_value' => '(813) 743-2373',
			'line1_url'   => 'tel:+18137432373',
			'line2_label' => '',
			'line2_value' => '',
			'line2_url'   => '',
		),
		array(
			'icon'        => 'location',
			'title'       => 'Location',
			'line1_label' => 'Address',
			'line1_value' => 'Coconut Creek, FL 33073',
			'line1_url'   => '',
			'line2_label' => '',
			'line2_value' => '',
			'line2_url'   => '',
		),
	);
}

$form_eyebrow   = get_post_meta( $pid, $prefix . 'form_eyebrow', true ) ?: 'Send a message';
$form_heading   = get_post_meta( $pid, $prefix . 'form_heading', true ) ?: 'Request a consultation';
$form_intro     = get_post_meta( $pid, $prefix . 'form_intro', true ) ?: "Fill out the form below and we'll respond within one business day.";
$form_shortcode = get_post_meta( $pid, $prefix . 'form_shortcode', true );

$pay_eyebrow = get_post_meta( $pid, $prefix . 'pay_eyebrow', true ) ?: 'Billing & payment';
$pay_title   = get_post_meta( $pid, $prefix . 'pay_title', true ) ?: 'How we accept payment';
$pay_intro   = get_post_meta( $pid, $prefix . 'pay_intro', true ) ?: 'One Stop Physics Service accepts a variety of payment methods.';

$pay_methods = get_post_meta( $pid, $prefix . 'pay_methods', true );
if ( empty( $pay_methods ) || ! is_array( $pay_methods ) ) {
	$pay_methods = array(
		array( 'icon' => 'cards', 'title' => 'Cards',          'desc' => 'Debit and credit cards accepted for invoices and consultations.' ),
		array( 'icon' => 'bank',  'title' => 'Bank transfers', 'desc' => 'ACH payments and wire transfers for enterprise accounts.' ),
		array( 'icon' => 'check', 'title' => 'Checks',         'desc' => 'Traditional paper checks — mail-in details on invoice.' ),
	);
}

$cta_eyebrow = get_post_meta( $pid, $prefix . 'cta_eyebrow', true ) ?: 'Prefer to talk?';
$cta_heading = get_post_meta( $pid, $prefix . 'cta_heading', true ) ?: 'Call us — we pick up.';
$cta_lead    = get_post_meta( $pid, $prefix . 'cta_lead', true ) ?: 'Have a tight deadline or a complex question? A board-certified physicist is just a phone call away.';
$cta_btn1_l  = get_post_meta( $pid, $prefix . 'cta_btn1_label', true ) ?: 'Call (813) 743-2373';
$cta_btn1_u  = get_post_meta( $pid, $prefix . 'cta_btn1_url', true ) ?: 'tel:+18137432373';
$cta_btn2_l  = get_post_meta( $pid, $prefix . 'cta_btn2_label', true ) ?: 'Email Lei';
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
		</div>
	</header>

	<!-- ===================== SECTION 02 — CONTACT DETAILS + FORM ===================== -->
	<section class="section">
		<div class="container">
			<div class="row align-items-end mb-5">
				<div class="col-lg-8">
					<span class="eyebrow mb-3"><?php echo esc_html( $sec_eyebrow ); ?></span>
					<h2 class="sec-title"><?php echo esc_html( $sec_title ); ?></h2>
				</div>
				<div class="col-lg-4 text-lg-end">
					<p class="mb-0 text-secondary"><?php echo esc_html( $sec_intro ); ?></p>
				</div>
			</div>

			<div class="row g-4">

				<div class="col-lg-5">
					<div class="d-flex flex-column gap-4">
						<?php foreach ( $methods as $m ) : $m = wp_parse_args( (array) $m, array( 'icon' => 'email', 'title' => '', 'line1_label' => '', 'line1_value' => '', 'line1_url' => '', 'line2_label' => '', 'line2_value' => '', 'line2_url' => '' ) ); ?>
							<div class="svc-card fade-up">
								<div class="d-flex align-items-start gap-3">
									<span class="s-ico flex-shrink-0"><?php echo osps_contact_icon( $m['icon'] ); ?></span>
									<div class="flex-grow-1">
										<h3 class="mb-3"><?php echo esc_html( $m['title'] ); ?></h3>
										<div class="d-flex flex-column gap-2">
											<?php if ( ! empty( $m['line1_value'] ) ) : ?>
												<div>
													<?php if ( ! empty( $m['line1_label'] ) ) : ?>
														<small class="d-block text-uppercase text-secondary fw-semibold" style="letter-spacing:.12em;font-size:.72rem;"><?php echo esc_html( $m['line1_label'] ); ?></small>
													<?php endif; ?>
													<?php if ( ! empty( $m['line1_url'] ) ) : ?>
														<a class="fw-semibold link-dark" href="<?php echo esc_url( $m['line1_url'] ); ?>"><?php echo esc_html( $m['line1_value'] ); ?></a>
													<?php else : ?>
														<span class="fw-semibold"><?php echo esc_html( $m['line1_value'] ); ?></span>
													<?php endif; ?>
												</div>
											<?php endif; ?>
											<?php if ( ! empty( $m['line2_value'] ) ) : ?>
												<div>
													<?php if ( ! empty( $m['line2_label'] ) ) : ?>
														<small class="d-block text-uppercase text-secondary fw-semibold" style="letter-spacing:.12em;font-size:.72rem;"><?php echo esc_html( $m['line2_label'] ); ?></small>
													<?php endif; ?>
													<?php if ( ! empty( $m['line2_url'] ) ) : ?>
														<a class="fw-semibold link-dark" href="<?php echo esc_url( $m['line2_url'] ); ?>"><?php echo esc_html( $m['line2_value'] ); ?></a>
													<?php else : ?>
														<span class="fw-semibold"><?php echo esc_html( $m['line2_value'] ); ?></span>
													<?php endif; ?>
												</div>
											<?php endif; ?>
										</div>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>

				<div class="col-lg-7">
					<div class="svc-card fade-up h-100">
						<span class="eyebrow mb-3"><?php echo esc_html( $form_eyebrow ); ?></span>
						<h3 class="mb-2"><?php echo esc_html( $form_heading ); ?></h3>
						<p class="text-secondary mb-4"><?php echo esc_html( $form_intro ); ?></p>
						<div class="osps26-form">
							<?php
							if ( ! empty( $form_shortcode ) ) {
								echo do_shortcode( $form_shortcode );
							} else {
								echo '<p class="text-secondary fst-italic mb-0">' . esc_html__( 'Add a Gravity Forms shortcode in the page editor (Section 02 — Contact Details + Form) to display the form here.', 'pegasus-child' ) . '</p>';
							}
							?>
						</div>
					</div>
				</div>

			</div>
		</div>
	</section>

	<!-- ===================== SECTION 03 — PAYMENT INFORMATION ===================== -->
	<section class="section mist">
		<div class="container">
			<div class="row align-items-end mb-5">
				<div class="col-lg-8">
					<span class="eyebrow mb-3"><?php echo esc_html( $pay_eyebrow ); ?></span>
					<h2 class="sec-title"><?php echo esc_html( $pay_title ); ?></h2>
				</div>
				<div class="col-lg-4 text-lg-end">
					<p class="mb-0 text-secondary"><?php echo esc_html( $pay_intro ); ?></p>
				</div>
			</div>
			<div class="row g-4">
				<?php foreach ( $pay_methods as $p ) : $p = wp_parse_args( (array) $p, array( 'icon' => 'cards', 'title' => '', 'desc' => '' ) ); ?>
					<div class="col-md-6 col-lg-4 fade-up">
						<div class="modality h-100">
							<span class="m-ico"><?php echo osps_contact_icon( $p['icon'] ); ?></span>
							<h3><?php echo esc_html( $p['title'] ); ?></h3>
							<p><?php echo esc_html( $p['desc'] ); ?></p>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- ===================== SECTION 04 — CTA ===================== -->
	<section class="section pt-5" id="contact-cta">
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
