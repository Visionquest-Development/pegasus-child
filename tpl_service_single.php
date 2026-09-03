<?php
/*
	Template Name: Service Detail Page
*/
/**
 * Valor Care — individual service detail page (Companionship, Personal Care,
 * Respite Care, Homemaking, Dementia & Alzheimer's Support …).
 *
 * ONE reusable template for every service subpage. It matches the current page
 * to its entry in the shared Services Catalogue (by slug) and uses that entry's
 * title / lead / bullets / icon as sensible DEFAULT content, in the same brand
 * look-and-feel as the homepage. If the page has editor content it is shown in
 * the overview; otherwise a branded default blurb is used.
 *
 * Header & footer come from the theme options.
 *
 * @package Pegasus_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'vc_ss' ) ) {
	/**
	 * Service-single meta value with a (per-service) fallback. Returns the
	 * page's saved CMB2 value when set, otherwise the dynamic default resolved
	 * in the template.
	 *
	 * @param string $key      Full meta key (e.g. 'vc_svc_hero_lead').
	 * @param string $fallback Default to use when the field is empty.
	 * @return string
	 */
	function vc_ss( $key, $fallback = '' ) {
		$v = get_post_meta( get_the_ID(), $key, true );
		return ( '' === $v || null === $v ) ? $fallback : $v;
	}
}

if ( ! function_exists( 'vc_image_slot' ) ) {
	/** Output an image, or a styled placeholder when no image is set. */
	function vc_image_slot( $url, $placeholder, $wrap_class = '' ) {
		$out = '<div class="vc-slot ' . esc_attr( $wrap_class ) . '">';
		if ( $url ) {
			$out .= '<img src="' . esc_url( $url ) . '" alt="' . esc_attr( $placeholder ) . '" class="vc-slot-img">';
		} else {
			$out .= '<span class="vc-slot-ph">' . esc_html( $placeholder ) . '</span>';
		}
		$out .= '</div>';
		return $out;
	}
}

get_header();

$header_choice = function_exists( 'pegasus_get_option' ) ? pegasus_get_option( 'header_select' ) : '';
if ( 'header-three' === $header_choice ) {
	get_template_part( 'templates/additional_header' );
}
?>

<div id="page-wrap">
	<div class="vc-home vc-service-single">

		<?php
		while ( have_posts() ) : the_post();

			$this_slug    = get_post_field( 'post_name', get_the_ID() );
			$services_id  = function_exists( 'valorcare_get_services_page_id' ) ? valorcare_get_services_page_id() : 0;
			$services_url = $services_id ? trailingslashit( get_permalink( $services_id ) ) : home_url( '/services/' );

			// Match this page to its catalogue entry (by title slug).
			$catalogue = function_exists( 'valorcare_services_defaults' ) ? valorcare_services_defaults() : array( 'catalogue' => array() );
			$catalogue = isset( $catalogue['catalogue'] ) ? $catalogue['catalogue'] : array();
			$match     = null;
			foreach ( $catalogue as $c ) {
				if ( isset( $c['title'] ) && sanitize_title( $c['title'] ) === $this_slug ) {
					$match = $c;
					break;
				}
			}

			$svc_title = get_the_title();

			// --- Per-service DEFAULTS derived from the catalogue match --------
			$def_icon = ( $match && ! empty( $match['icon'] ) )    ? $match['icon']    : 'fa-heart';
			$def_lead = ( $match && ! empty( $match['text'] ) )    ? $match['text']    : get_the_excerpt();
			$def_bull = ( $match && ! empty( $match['bullets'] ) ) ? $match['bullets'] : '<ul><li>Personalized, one-on-one support</li><li>Consistent, vetted caregivers</li><li>Flexible scheduling — a few hours a week to daily</li><li>No doctor\'s order required</li></ul>';
			$svc_code = ( $match && ! empty( $match['code'] ) )    ? $match['code']    : '';

			// --- CMB2 overrides (blank field ⇒ default) -----------------------
			$svc_eyebrow = vc_ss( 'vc_svc_hero_eyebrow',     'Our Services' );
			$svc_lead    = vc_ss( 'vc_svc_hero_lead',        $def_lead );
			$svc_icon    = vc_ss( 'vc_svc_icon',             $def_icon );
			$hero_image  = vc_ss( 'vc_svc_hero_image',       '' );
			$ov_heading  = vc_ss( 'vc_svc_overview_heading', 'About ' . $svc_title );
			$inc_heading = vc_ss( 'vc_svc_included_heading', "What's Included" );
			// What's Included: repeatable bullets (one row = one <li>). Build the
			// list from any filled rows; fall back to this service's catalogue
			// bullets when every row is blank (same "defaults until filled" rule).
			$inc_rows = get_post_meta( get_the_ID(), 'vc_svc_included_bullets', true );
			$inc_rows = is_array( $inc_rows ) ? array_values( array_filter( array_map( 'trim', $inc_rows ), 'strlen' ) ) : array();
			if ( ! empty( $inc_rows ) ) {
				$svc_bull = '<ul>';
				foreach ( $inc_rows as $inc_li ) {
					$svc_bull .= '<li>' . esc_html( $inc_li ) . '</li>';
				}
				$svc_bull .= '</ul>';
			} else {
				$svc_bull = $def_bull;
			}
			$cta_heading = vc_ss( 'vc_svc_cta_heading',      'Ready to talk about ' . $svc_title . '?' );
			$cta_text    = vc_ss( 'vc_svc_cta_text',         'Tell us a little about your situation and our care team will follow up personally. We reply within one business day.' );

			// Overview body priority: CMB2 field ▸ page editor content ▸ blurb.
			$ov_body_meta  = get_post_meta( get_the_ID(), 'vc_svc_overview_body', true );
			$has_content   = ( '' !== trim( (string) get_the_content() ) );
			$default_body  = '<p>At Valor Care, our <strong>' . esc_html( $svc_title ) . '</strong> service is delivered by compassionate, dependable caregivers who treat your loved one like family. ' . esc_html( $def_lead ) . '</p>';
			$default_body .= '<p>Every plan is personalized around what your family actually needs — from a few hours a week to daily support — and no doctor\'s order is required to get started. We match a consistent caregiver to your loved one so they always see a familiar, trusted face.</p>';

			// Contact defaults reused from the homepage consultation section.
			$phone      = function_exists( 'valorcare_home_default' ) ? valorcare_home_default( 'consult_phone' )      : '770-910-CARE (2273)';
			$phone_link = function_exists( 'valorcare_home_default' ) ? valorcare_home_default( 'consult_phone_link' ) : 'tel:+17709102273';
			$email      = function_exists( 'valorcare_home_default' ) ? valorcare_home_default( 'consult_email' )      : 'valorcarega@gmail.com';
		?>

		<!-- ============================ HERO ============================ -->
		<section class="vc-service-hero">
			<div class="container py-5">
				<div class="row align-items-center g-5 py-lg-3">
					<div class="col-lg-6">
						<a class="vc-eyebrow vc-eyebrow--light vc-service-crumb" href="<?php echo esc_url( $services_url ); ?>">
							<i class="fa fa-angle-left me-2"></i><?php echo esc_html( $svc_eyebrow ); ?>
						</a>
						<h1 class="vc-serif vc-h1 mt-2 wow fadeInUp"><?php echo esc_html( $svc_title ); ?></h1>
						<p class="vc-hero-lead wow fadeInUp" data-wow-delay="0.1s"><?php echo esc_html( $svc_lead ); ?></p>
						<div class="d-flex flex-wrap gap-3 mt-4 wow fadeInUp" data-wow-delay="0.2s">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>#consultation" class="btn btn-lg fw-bold px-4 vc-btn-gold">Request a Free Consultation</a>
							<a href="<?php echo esc_url( $phone_link ); ?>" class="btn btn-lg px-4 vc-btn-outline">
								<i class="fa fa-phone me-2 vc-gold-text"></i><?php echo esc_html( $phone ); ?>
							</a>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="vc-framed vc-framed--bl wow fadeInRight">
							<div class="vc-framed__accent"></div>
							<?php echo vc_image_slot( $hero_image, $svc_title . ' — Valor Care', 'vc-framed__media vc-ar-4x3' ); ?>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- ===================== OVERVIEW + INCLUDED ==================== -->
		<section class="vc-service-overview py-5">
			<div class="container py-lg-4">
				<div class="row g-5">
					<div class="col-lg-7">
						<div class="d-flex align-items-center gap-3">
							<span class="vc-badge-icon vc-badge-icon--static"><i class="fa <?php echo esc_attr( $svc_icon ); ?>"></i></span>
							<div>
								<div class="vc-eyebrow">Overview<?php echo $svc_code ? ' &middot; ' . esc_html( $svc_code ) : ''; ?></div>
								<h2 class="vc-serif vc-title m-0 wow fadeInUp"><?php echo esc_html( $ov_heading ); ?></h2>
							</div>
						</div>
						<div class="vc-rule"></div>
						<div class="vc-service-body">
							<?php
							if ( '' !== trim( (string) $ov_body_meta ) ) {
								echo apply_filters( 'the_content', $ov_body_meta );
							} elseif ( $has_content ) {
								the_content();
							} else {
								echo wp_kses_post( $default_body );
							}
							?>
						</div>
					</div>
					<div class="col-lg-5">
						<div class="vc-included-card wow fadeInRight">
							<h3 class="vc-serif vc-included-title"><?php echo esc_html( $inc_heading ); ?></h3>
							<div class="vc-included"><?php echo apply_filters( 'the_content', $svc_bull ); ?></div>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>#consultation" class="btn fw-bold px-4 py-2 vc-btn-navy mt-3">Talk with Our Team</a>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- ======================= OTHER SERVICES ======================= -->
		<?php
		$others = array();
		foreach ( $catalogue as $c ) {
			$slug = isset( $c['title'] ) ? sanitize_title( $c['title'] ) : '';
			if ( '' === $slug || $slug === $this_slug ) {
				continue;
			}
			$others[] = array(
				'title' => $c['title'],
				'text'  => isset( $c['text'] ) ? $c['text'] : '',
				'icon'  => isset( $c['icon'] ) && $c['icon'] ? $c['icon'] : 'fa-heart',
				'url'   => $services_url . $slug . '/',
			);
		}
		if ( $others ) :
		?>
		<section class="vc-service-other py-5">
			<div class="container py-lg-4">
				<div class="text-center mx-auto vc-section-head-xs mb-4 wow fadeInUp">
					<div class="vc-eyebrow">Explore More</div>
					<h2 class="vc-serif vc-title">Our Other Services</h2>
				</div>
				<div class="row g-4 justify-content-center">
					<?php foreach ( $others as $oi => $o ) : ?>
						<div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="<?php echo esc_attr( $oi * 0.1 ); ?>s">
							<a class="vc-card vc-other-card h-100 d-flex flex-column p-4 text-decoration-none" href="<?php echo esc_url( $o['url'] ); ?>">
								<span class="vc-badge-icon vc-badge-icon--static"><i class="fa <?php echo esc_attr( $o['icon'] ); ?>"></i></span>
								<h3 class="vc-serif vc-card__title mt-3"><?php echo esc_html( $o['title'] ); ?></h3>
								<p class="vc-card__text"><?php echo esc_html( $o['text'] ); ?></p>
								<span class="vc-readmore mt-auto">Learn more <i class="fa fa-arrow-circle-right ms-1"></i></span>
							</a>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
		<?php endif; ?>

		<!-- ============================= CTA ============================ -->
		<section class="vc-consult vc-service-cta py-5">
			<div class="container py-lg-4">
				<div class="row align-items-center g-4">
					<div class="col-lg-8">
						<h2 class="vc-serif vc-title vc-title--light m-0 wow fadeInUp"><?php echo esc_html( $cta_heading ); ?></h2>
						<p class="vc-consult-text mb-0 mt-3"><?php echo nl2br( esc_html( $cta_text ) ); ?></p>
						<div class="d-flex flex-column gap-2 mt-4">
							<a href="<?php echo esc_url( $phone_link ); ?>" class="vc-contact">
								<span class="vc-contact-icon"><i class="fa fa-phone"></i></span><?php echo esc_html( $phone ); ?>
							</a>
							<a href="mailto:<?php echo esc_attr( $email ); ?>" class="vc-contact">
								<span class="vc-contact-icon"><i class="fa fa-envelope"></i></span><?php echo esc_html( $email ); ?>
							</a>
						</div>
					</div>
					<div class="col-lg-4 text-lg-end">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>#consultation" class="btn btn-lg fw-bold px-4 vc-btn-gold">Request a Free Consultation</a>
					</div>
				</div>
			</div>
		</section>

		<?php endwhile; ?>

	</div><!-- .vc-service-single -->
</div><!-- #page-wrap -->

<?php get_footer(); ?>
