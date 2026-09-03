<?php
/*
	Template Name: Contact Page
*/
/**
 * Valor Care — Contact page template.
 *
 * Same brand look-and-feel as the homepage consultation section (tpl_home.php),
 * built from Bootstrap 5 markup and the shared Valor Care CSS. Fully CMB2-driven
 * (see inc/cmb2-contact-fields.php): every field falls back to its design
 * default until a real value is filled in and saved.
 *
 * The form card renders a Gravity Forms shortcode when one is set in the
 * backend; otherwise it shows the built-in contact form. Header & footer are
 * handled by the theme options.
 *
 * @package Pegasus_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* -------------------------------------------------------------------------
 * Rendering helpers (guarded so they are only declared once).
 * ---------------------------------------------------------------------- */

if ( ! function_exists( 'vc_contact_val' ) ) {
	/**
	 * Scalar Contact-page field value with design-default fallback.
	 *
	 * @param string $key Key without the vc_ prefix (e.g. 'contact_title').
	 * @return string
	 */
	function vc_contact_val( $key ) {
		$v = get_post_meta( get_the_ID(), 'vc_' . $key, true );
		if ( '' === $v || null === $v ) {
			return function_exists( 'valorcare_contact_default' ) ? valorcare_contact_default( $key ) : '';
		}
		return $v;
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

// Match the parent's full-width template: header-three needs the additional
// header included explicitly.
$header_choice = function_exists( 'pegasus_get_option' ) ? pegasus_get_option( 'header_select' ) : '';
if ( 'header-three' === $header_choice ) {
	get_template_part( 'templates/additional_header' );
}
?>

<div id="page-wrap">
	<div class="vc-home vc-contact-page">

		<?php while ( have_posts() ) : the_post(); ?>

		<!-- ============================ HERO ============================ -->
		<section class="vc-svc-hero">
			<div class="container py-5">
				<div class="row g-5 align-items-end py-lg-3">
					<div class="col-lg-7">
						<div class="vc-eyebrow vc-eyebrow--light"><?php echo esc_html( vc_contact_val( 'contact_eyebrow' ) ); ?></div>
						<h1 class="vc-serif vc-h1 vc-svc-hero__title wow fadeInUp"><?php echo wp_kses_post( vc_contact_val( 'contact_title' ) ); ?></h1>
					</div>
					<div class="col-lg-5">
						<p class="vc-svc-hero__intro wow fadeInUp" data-wow-delay="0.1s"><?php echo nl2br( esc_html( vc_contact_val( 'contact_intro' ) ) ); ?></p>
					</div>
				</div>
			</div>
		</section>

		<!-- ========================== CONTACT =========================== -->
		<section id="contact" class="vc-consult py-5">
			<div class="container py-lg-4">
				<div class="row g-5">

					<!-- Contact details -->
					<div class="col-lg-5">
						<h2 class="vc-serif vc-title vc-title--light mb-0 wow fadeInLeft"><?php echo esc_html( vc_contact_val( 'contact_info_title' ) ); ?></h2>
						<div class="vc-rule"></div>
						<div class="d-flex flex-column gap-3 mt-4">
							<?php $phone = vc_contact_val( 'contact_phone' ); if ( $phone ) : ?>
								<a href="<?php echo esc_url( vc_contact_val( 'contact_phone_link' ) ); ?>" class="vc-contact">
									<span class="vc-contact-icon"><i class="fa fa-phone"></i></span>
									<?php echo esc_html( $phone ); ?>
								</a>
							<?php endif; ?>
							<?php $email = vc_contact_val( 'contact_email' ); if ( $email ) : ?>
								<a href="mailto:<?php echo esc_attr( $email ); ?>" class="vc-contact">
									<span class="vc-contact-icon"><i class="fa fa-envelope"></i></span>
									<?php echo esc_html( $email ); ?>
								</a>
							<?php endif; ?>
							<?php $address = vc_contact_val( 'contact_address' ); if ( $address ) : ?>
								<div class="vc-contact">
									<span class="vc-contact-icon"><i class="fa fa-map-marker"></i></span>
									<?php echo esc_html( $address ); ?>
								</div>
							<?php endif; ?>
							<?php $hours = trim( (string) vc_contact_val( 'contact_hours' ) ); if ( '' !== $hours ) : ?>
								<div class="vc-contact vc-contact--stack">
									<span class="vc-contact-icon"><i class="fa fa-clock-o"></i></span>
									<span><?php echo nl2br( esc_html( $hours ) ); ?></span>
								</div>
							<?php endif; ?>
						</div>

						<?php $map = vc_contact_val( 'contact_map_image' ); if ( $map ) : ?>
							<div class="mt-4">
								<?php echo vc_image_slot( $map, 'Service-area map', 'vc-map vc-ar-4x3' ); ?>
							</div>
						<?php endif; ?>
					</div>

					<!-- Form card -->
					<div class="col-lg-7">
						<div class="vc-form-card p-4 p-md-5 wow fadeInRight">
							<h2 class="vc-serif vc-form-title mb-4"><?php echo esc_html( vc_contact_val( 'contact_form_title' ) ); ?></h2>
							<?php
							// A Gravity Forms shortcode set in the backend replaces the
							// built-in form entirely. Blank ⇒ keep the built-in form.
							$vc_form_shortcode = trim( (string) vc_contact_val( 'contact_form_shortcode' ) );
							if ( '' !== $vc_form_shortcode ) :
								echo do_shortcode( $vc_form_shortcode );
							else :
							?>
							<form class="row g-3" method="post" action="">
								<div class="col-md-6">
									<label class="form-label vc-form-label" for="vc-name">Your Name</label>
									<input type="text" id="vc-name" name="vc-name" class="form-control">
								</div>
								<div class="col-md-6">
									<label class="form-label vc-form-label" for="vc-phone">Phone</label>
									<input type="tel" id="vc-phone" name="vc-phone" class="form-control">
								</div>
								<div class="col-12">
									<label class="form-label vc-form-label" for="vc-email">Email</label>
									<input type="email" id="vc-email" name="vc-email" class="form-control">
								</div>
								<div class="col-12">
									<label class="form-label vc-form-label" for="vc-message">How can we help?</label>
									<textarea id="vc-message" name="vc-message" class="form-control" rows="4"></textarea>
								</div>
								<div class="col-12 d-flex flex-wrap align-items-center gap-3">
									<button type="submit" class="btn btn-lg fw-bold px-4 vc-btn-gold">Send Message</button>
									<span class="vc-form-note"><?php echo esc_html( vc_contact_val( 'contact_form_note' ) ); ?></span>
								</div>
							</form>
							<?php endif; ?>
						</div>
					</div>

				</div>
			</div>
		</section>

		<?php endwhile; ?>

	</div><!-- .vc-contact-page -->
</div><!-- #page-wrap -->

<?php get_footer(); ?>
