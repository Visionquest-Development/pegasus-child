<?php
/**
 * Template Name: RC Home
 * File: tpl_home.php
 *
 * Home page for Russell Contracting. Content is driven by CMB2 metaboxes
 * defined in inc/cmb2-fields.php; missing values fall back to the design
 * defaults in RC_Defaults so the page renders correctly on a fresh install.
 *
 * Requires: Bootstrap 5 + Bootstrap Icons + child style.css (see functions.php).
 * Shared chrome (top bar, navbar, CTA band, footer) lives in header.php / footer.php.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

/* Hero */
$hero_defaults = RC_Defaults::home_hero();
$hero_line1    = rc_field( 'rc_hero_headline_line1', $hero_defaults['headline_line1'] );
$hero_line2    = rc_field( 'rc_hero_headline_line2', $hero_defaults['headline_line2'] );
$hero_subhead  = rc_field( 'rc_hero_subhead',        $hero_defaults['subhead'] );
$hero_btn1_txt = rc_field( 'rc_hero_primary_btn_text',   $hero_defaults['primary_btn_text'] );
$hero_btn1_url = rc_field( 'rc_hero_primary_btn_url',    $hero_defaults['primary_btn_url'] );
$hero_btn2_txt = rc_field( 'rc_hero_secondary_btn_text', $hero_defaults['secondary_btn_text'] );
$hero_btn2_url = rc_field( 'rc_hero_secondary_btn_url',  $hero_defaults['secondary_btn_url'] );

$hero_badge_saved = rc_field( 'rc_hero_badge_image', '' );
$hero_badge_url   = $hero_badge_saved
	? esc_url( $hero_badge_saved )
	: esc_url( get_stylesheet_directory_uri() . '/assets/images/branding/russell-contracting-mascot-logo.jpg' );
$hero_bkg_url   = esc_url( get_stylesheet_directory_uri() . '/assets/images/hero-slider/finished-kitchen-white-quartz-pendant-01.jpg' );

/* Services grid */
$svc_intro     = RC_Defaults::home_services_intro();
$svc_eyebrow   = rc_field( 'rc_services_eyebrow',  $svc_intro['eyebrow'] );
$svc_subtitle  = rc_field( 'rc_services_subtitle', $svc_intro['subtitle'] );
$rc_services   = rc_group( 'rc_services', RC_Defaults::home_services() );

/* Why choose us */
$why_intro     = RC_Defaults::home_why_intro();
$why_eyebrow   = rc_field( 'rc_why_eyebrow',  $why_intro['eyebrow'] );
$why_subtitle  = rc_field( 'rc_why_subtitle', $why_intro['subtitle'] );
$rc_reasons    = rc_group( 'rc_reasons', RC_Defaults::home_reasons() );

/* Bottom CTA */
$cta_defaults = RC_Defaults::home_cta();
$cta_headline = rc_field( 'rc_home_cta_headline', $cta_defaults['headline'] );
$cta_subhead  = rc_field( 'rc_home_cta_subhead',  $cta_defaults['subhead'] );
$cta_btn_text = rc_field( 'rc_home_cta_btn_text', $cta_defaults['btn_text'] );
$cta_btn_url  = rc_link( rc_field( 'rc_home_cta_btn_url', $cta_defaults['btn_url'] ) );
?>

<!-- ============ HERO ============ -->
<header class="rc-hero">
	<div class="rc-hero__pattern" aria-hidden="true"></div>
	<div class="container rc-hero__inner">
		<img src="<?php echo $hero_badge_url; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" class="rc-hero__badge">
		<h1 class="rc-hero__title">
			<?php echo esc_html( $hero_line1 ); ?><br>
			<span class="rc-hero__title-alt"><?php echo esc_html( $hero_line2 ); ?></span>
		</h1>
		<p class="rc-hero__subhead"><?php echo esc_html( $hero_subhead ); ?></p>
		<div class="rc-hero__actions">
			<a href="<?php echo rc_link( $hero_btn1_url ); ?>" class="rc-btn-gold rc-btn-gold--lg"><?php echo esc_html( $hero_btn1_txt ); ?></a>
			<a href="<?php echo rc_link( $hero_btn2_url ); ?>" class="rc-btn-outline"><?php echo esc_html( $hero_btn2_txt ); ?></a>
		</div>
	</div>
</header>

<!-- ============ SERVICES ============ -->
<section class="rc-services">
	<div class="container">
		<h2 class="rc-eyebrow text-white"><?php echo esc_html( $svc_eyebrow ); ?></h2>
		<p class="rc-section-subtitle"><?php echo esc_html( $svc_subtitle ); ?></p>
		<div class="row g-4">
			<?php foreach ( $rc_services as $svc ) :
				$title = isset( $svc['title'] ) ? $svc['title'] : '';
				$icon  = isset( $svc['icon'] )  ? $svc['icon']  : 'bi-tools';
				$blurb = isset( $svc['blurb'] ) ? $svc['blurb'] : '';
				$url   = isset( $svc['url'] )   ? $svc['url']   : '#';
			?>
				<div class="col-md-6 col-lg-3">
					<div class="rc-service-card">
						<div class="rc-service-card__ring-wrap">
							<div class="rc-ring"><i class="bi <?php echo esc_attr( $icon ); ?>"></i></div>
						</div>
						<div class="rc-service-card__body">
							<h3 class="rc-service-card__title"><?php echo esc_html( $title ); ?></h3>
							<p class="rc-service-card__blurb"><?php echo esc_html( $blurb ); ?></p>
							<a href="<?php echo rc_link( $url ); ?>" class="rc-btn-gold rc-btn-gold--sm align-self-start mt-2"><?php esc_html_e( 'Learn More', 'pegasus-child' ); ?> <i class="bi bi-arrow-right ms-1"></i></a>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ============ WHY CHOOSE US ============ -->
<section class="rc-why">
	<div class="container">
		<h2 class="rc-eyebrow text-white"><?php echo esc_html( $why_eyebrow ); ?></h2>
		<p class="rc-section-subtitle"><?php echo esc_html( $why_subtitle ); ?></p>
		<div class="row g-3">
			<?php foreach ( $rc_reasons as $r ) :
				$rtitle = isset( $r['title'] ) ? $r['title'] : '';
				$ricon  = isset( $r['icon'] )  ? $r['icon']  : 'bi-check2';
				$rtext  = isset( $r['text'] )  ? $r['text']  : '';
			?>
				<div class="col-md-6 col-lg-4">
					<div class="rc-why-tile">
						<div class="rc-why-ico"><i class="bi <?php echo esc_attr( $ricon ); ?>"></i></div>
						<div>
							<h4 class="rc-why-tile__title"><?php echo esc_html( $rtitle ); ?></h4>
							<p class="rc-why-tile__text"><?php echo esc_html( $rtext ); ?></p>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ============ BOTTOM CTA ============ -->
<section class="rc-cta">
	<div class="container">
		<div class="row align-items-center g-3 text-center text-lg-start">
			<div class="col-lg-8">
				<h2 class="rc-cta__title"><?php echo esc_html( $cta_headline ); ?></h2>
				<p class="rc-cta__subhead"><?php echo esc_html( $cta_subhead ); ?></p>
			</div>
			<div class="col-lg-4 text-lg-end">
				<a href="<?php echo $cta_btn_url; ?>" class="rc-btn-gold rc-btn-gold--xl"><i class="bi bi-chat-dots-fill me-2"></i><?php echo esc_html( $cta_btn_text ); ?></a>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();
