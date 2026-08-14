<?php
/*
	Template Name: Home Page
*/
/**
 * Valor Care — Home page template.
 *
 * Based on the parent theme "No Sidebar Template" (tpl_page-full-width.php), then
 * adapted into a full-width, CMB2-driven home page built with Bootstrap 5 markup.
 *
 * All content falls back to the Claude Design defaults (see
 * valorcare_home_defaults() in inc/cmb2-home-fields.php) until the matching CMB2
 * field / repeatable row is filled in. Header and footer are handled by the
 * theme options, so this template only outputs the home page sections.
 *
 * @package Pegasus_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* -------------------------------------------------------------------------
 * Rendering helpers (guarded so they are only declared once).
 * ---------------------------------------------------------------------- */

if ( ! function_exists( 'vc_val' ) ) {
	/**
	 * Scalar field value with design-default fallback.
	 *
	 * @param string $key Default/meta key (without the vc_ prefix).
	 * @return string
	 */
	function vc_val( $key ) {
		$v = get_post_meta( get_the_ID(), 'vc_' . $key, true );
		if ( '' === $v || null === $v ) {
			return valorcare_home_default( $key );
		}
		return $v;
	}
}

if ( ! function_exists( 'vc_rows' ) ) {
	/**
	 * Repeatable group rows with design-default fallback.
	 *
	 * Blank rows (all fields empty — e.g. the single empty row CMB2 shows by
	 * default) are stripped, so the section keeps showing the design defaults
	 * until real content is entered.
	 *
	 * @param string $key Group key (without the vc_ prefix).
	 * @return array
	 */
	function vc_rows( $key ) {
		$defaults = valorcare_home_defaults();
		$rows     = get_post_meta( get_the_ID(), 'vc_' . $key, true );

		if ( is_array( $rows ) ) {
			$rows = array_values( array_filter(
				$rows,
				function( $row ) {
					if ( ! is_array( $row ) ) {
						return '' !== trim( (string) $row );
					}
					foreach ( $row as $field_key => $value ) {
						if ( '_id' === substr( $field_key, -3 ) ) {
							continue; // Skip the file field's companion attachment id.
						}
						if ( '' !== trim( (string) $value ) ) {
							return true;
						}
					}
					return false;
				}
			) );
		}

		if ( empty( $rows ) ) {
			return isset( $defaults[ $key ] ) ? $defaults[ $key ] : array();
		}
		return $rows;
	}
}

if ( ! function_exists( 'vc_para' ) ) {
	/**
	 * Escape and preserve line breaks for multi-line copy.
	 *
	 * @param string $text Raw text.
	 * @return string
	 */
	function vc_para( $text ) {
		return nl2br( esc_html( $text ) );
	}
}

if ( ! function_exists( 'vc_image_slot' ) ) {
	/**
	 * Output an image, or a styled placeholder when no image is set.
	 *
	 * @param string $url         Image URL (may be empty).
	 * @param string $placeholder Placeholder / alt text.
	 * @param string $wrap_class  Extra classes for the slot wrapper (e.g. aspect ratio).
	 * @return string
	 */
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
?>

<div id="page-wrap">
	<div class="vc-home">

		<?php while ( have_posts() ) : the_post(); ?>

		<!-- ============================ HERO ============================ -->
		<section class="vc-hero">
			<div class="container py-5">
				<div class="row align-items-center g-5 py-lg-4">
					<div class="col-lg-6">
						<div class="vc-badge">
							<i class="fa fa-star"></i> <?php echo esc_html( vc_val( 'hero_badge' ) ); ?>
						</div>
						<h1 class="vc-serif vc-h1">
							<?php echo esc_html( vc_val( 'hero_title_1' ) ); ?><br>
							<span class="vc-gold-text"><?php echo esc_html( vc_val( 'hero_title_2' ) ); ?></span>
						</h1>
						<p class="vc-hero-lead"><?php echo vc_para( vc_val( 'hero_text' ) ); ?></p>
						<div class="d-flex flex-wrap gap-3 mt-4">
							<a href="<?php echo esc_url( vc_val( 'hero_btn1_link' ) ); ?>" class="btn btn-lg fw-bold px-4 vc-btn-gold">
								<?php echo esc_html( vc_val( 'hero_btn1_text' ) ); ?>
							</a>
							<a href="<?php echo esc_url( vc_val( 'hero_btn2_link' ) ); ?>" class="btn btn-lg px-4 vc-btn-outline">
								<i class="fa fa-phone me-2 vc-gold-text"></i><?php echo esc_html( vc_val( 'hero_btn2_text' ) ); ?>
							</a>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="vc-framed vc-framed--bl">
							<div class="vc-framed__accent"></div>
							<?php echo vc_image_slot( vc_val( 'hero_image' ), 'Caregiver with senior client at home', 'vc-framed__media vc-ar-4x3' ); ?>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- ========================== TRUST BAR ========================= -->
		<section class="vc-trustbar">
			<div class="container py-4">
				<div class="row text-center g-4">
					<?php foreach ( vc_rows( 'trust' ) as $item ) : ?>
						<div class="col-6 col-lg-3 vc-trust-item">
							<i class="fa <?php echo esc_attr( $item['icon'] ); ?> vc-trust-icon"></i>
							<span class="vc-trust-text"><?php echo esc_html( $item['text'] ); ?></span>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<!-- =========================== SERVICES ========================= -->
		<section class="vc-services py-5">
			<div class="container py-lg-4">
				<div class="text-center mx-auto vc-section-head">
					<div class="vc-eyebrow"><?php echo esc_html( vc_val( 'services_eyebrow' ) ); ?></div>
					<h2 class="vc-serif vc-title"><?php echo esc_html( vc_val( 'services_title' ) ); ?></h2>
					<div class="vc-ornament">
						<span class="vc-ornament-line"></span>
						<i class="fa fa-star vc-ornament-star"></i>
						<span class="vc-ornament-line"></span>
					</div>
					<p class="vc-lead"><?php echo esc_html( vc_val( 'services_intro' ) ); ?></p>
				</div>

				<?php
				// The services grid pulls its cards from the Services page
				// (tpl_services.php) so the catalogue is edited in one place.
				// Falls back to the design defaults until real content is saved.
				$svc_page_id  = function_exists( 'valorcare_get_services_page_id' ) ? valorcare_get_services_page_id() : 0;
				$svc_fallback = function_exists( 'valorcare_services_defaults' ) ? valorcare_services_defaults() : array( 'catalogue' => array() );
				$svc_fallback = $svc_fallback['catalogue'];
				$services     = function_exists( 'valorcare_meta_group_from' ) ? valorcare_meta_group_from( 'vc_services', $svc_page_id, $svc_fallback ) : $svc_fallback;
				$services     = function_exists( 'valorcare_nonempty_rows' ) ? valorcare_nonempty_rows( $services ) : $services;
				if ( empty( $services ) ) { $services = $svc_fallback; }
				// Base URL of the Services page — used to link each card to its
				// matching service subpage (child of the Services page).
				$svc_page_url = $svc_page_id ? trailingslashit( get_permalink( $svc_page_id ) ) : home_url( '/services/' );
				?>
				<div class="row g-4 mt-3 justify-content-center">
					<?php foreach ( $services as $service ) :
						$svc_img = isset( $service['image'] ) ? $service['image'] : '';
						// Button URL: explicit Button URL wins, else the service's subpage.
						$svc_link = ! empty( $service['link_url'] )
							? $service['link_url']
							: ( ! empty( $service['title'] ) ? $svc_page_url . sanitize_title( $service['title'] ) . '/' : '' );
					?>
						<div class="col-md-6 col-lg-4">
							<div class="vc-card h-100 d-flex flex-column">
								<div class="vc-card__media vc-ar-3x2">
									<?php echo vc_image_slot( $svc_img, isset( $service['title'] ) ? $service['title'] : 'Service photo', '' ); ?>
								</div>
								<div class="vc-card__body p-4 d-flex flex-column flex-grow-1">
									<?php if ( ! empty( $service['icon'] ) ) : ?>
									<div class="vc-badge-icon">
										<i class="fa <?php echo esc_attr( $service['icon'] ); ?>"></i>
									</div>
									<?php endif; ?>
									<h3 class="vc-serif vc-card__title"><?php echo esc_html( isset( $service['title'] ) ? $service['title'] : '' ); ?></h3>
									<p class="vc-card__text"><?php echo esc_html( isset( $service['text'] ) ? $service['text'] : '' ); ?></p>
									<?php if ( ! empty( $svc_link ) ) : ?>
										<a href="<?php echo esc_url( $svc_link ); ?>" class="vc-readmore">
											<?php echo esc_html( ! empty( $service['link_text'] ) ? $service['link_text'] : 'Read more' ); ?> <i class="fa fa-arrow-circle-right ms-1"></i>
										</a>
									<?php endif; ?>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<!-- ===================== IS IT TIME (SIGNS) ===================== -->
		<section class="vc-signs py-5">
			<div class="container py-lg-4">
				<div class="row align-items-center g-5">
					<div class="col-lg-5">
						<div class="vc-framed vc-framed--tr">
							<div class="vc-framed__accent"></div>
							<?php echo vc_image_slot( vc_val( 'signs_image' ), 'Senior at home, family visit', 'vc-framed__media vc-ar-4x5' ); ?>
						</div>
					</div>
					<div class="col-lg-7">
						<h2 class="vc-serif vc-title mb-0"><?php echo esc_html( vc_val( 'signs_title' ) ); ?></h2>
						<p class="vc-signs-sub"><?php echo esc_html( vc_val( 'signs_subtitle' ) ); ?></p>
						<div class="row g-3">
							<?php foreach ( vc_rows( 'signs' ) as $sign ) : ?>
								<div class="col-sm-6 vc-check">
									<i class="fa fa-check-circle vc-check-icon"></i>
									<span class="vc-check-text"><?php echo esc_html( $sign['text'] ); ?></span>
								</div>
							<?php endforeach; ?>
						</div>
						<div class="vc-signs-cta d-flex flex-wrap align-items-center gap-3">
							<p class="vc-serif vc-signs-cta-text"><?php echo esc_html( vc_val( 'signs_cta_text' ) ); ?></p>
							<a href="<?php echo esc_url( vc_val( 'signs_btn_link' ) ); ?>" class="btn fw-bold px-4 py-2 vc-btn-navy">
								<?php echo esc_html( vc_val( 'signs_btn_text' ) ); ?>
							</a>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- ======================== WHY CHOOSE US ======================= -->
		<section class="vc-why py-5">
			<div class="container py-lg-4">
				<div class="text-center mx-auto vc-section-head-sm">
					<div class="vc-eyebrow vc-eyebrow--light"><?php echo esc_html( vc_val( 'why_eyebrow' ) ); ?></div>
					<h2 class="vc-serif vc-title vc-title--light"><?php echo esc_html( vc_val( 'why_title' ) ); ?></h2>
				</div>
				<div class="row g-4 mt-2">
					<?php foreach ( vc_rows( 'why' ) as $reason ) : ?>
						<div class="col-md-6 col-lg-4">
							<div class="vc-why-card h-100 p-4">
								<i class="fa <?php echo esc_attr( $reason['icon'] ); ?> vc-why-icon"></i>
								<h3 class="vc-serif vc-why-title"><?php echo esc_html( $reason['title'] ); ?></h3>
								<p class="vc-why-text"><?php echo esc_html( $reason['text'] ); ?></p>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<!-- ========================== FOUNDER =========================== -->
		<section class="vc-founder py-5">
			<div class="container py-lg-4">
				<div class="row align-items-center g-5">
					<div class="col-lg-5 order-lg-2">
						<div class="vc-framed vc-framed--bl">
							<div class="vc-framed__accent vc-framed__accent--solid"></div>
							<?php echo vc_image_slot( vc_val( 'founder_image' ), 'Wendi McCracken, RN, BSN', 'vc-framed__media vc-ar-1x1' ); ?>
						</div>
					</div>
					<div class="col-lg-7 order-lg-1">
						<div class="vc-eyebrow"><?php echo esc_html( vc_val( 'founder_eyebrow' ) ); ?></div>
						<h2 class="vc-serif vc-title"><?php echo esc_html( vc_val( 'founder_name' ) ); ?></h2>
						<div class="vc-rule"></div>
						<?php
						$bio_paras = preg_split( '/\n\s*\n|\n/', trim( vc_val( 'founder_bio' ) ) );
						foreach ( $bio_paras as $para ) :
							if ( '' === trim( $para ) ) {
								continue;
							}
							?>
							<p class="vc-founder-bio"><?php echo esc_html( trim( $para ) ); ?></p>
						<?php endforeach; ?>
						<blockquote class="vc-serif vc-quote"><?php echo esc_html( vc_val( 'founder_quote' ) ); ?></blockquote>
					</div>
				</div>
			</div>
		</section>

		<!-- ======================== TESTIMONIALS ======================== -->
		<section class="vc-testimonials py-5">
			<div class="container py-lg-4">
				<div class="text-center mx-auto mb-4 vc-section-head-xs">
					<div class="vc-eyebrow"><?php echo esc_html( vc_val( 'testimonials_eyebrow' ) ); ?></div>
					<h2 class="vc-serif vc-title"><?php echo esc_html( vc_val( 'testimonials_title' ) ); ?></h2>
				</div>
				<div class="row g-4">
					<?php foreach ( vc_rows( 'testimonials' ) as $t ) : ?>
						<div class="col-lg-4">
							<div class="vc-testimonial h-100 p-4">
								<i class="fa fa-quote-left vc-quote-icon"></i>
								<p class="vc-testimonial-text"><?php echo vc_para( $t['quote'] ); ?></p>
								<div class="vc-serif vc-testimonial-name"><?php echo esc_html( $t['name'] ); ?></div>
								<div class="vc-testimonial-meta"><?php echo esc_html( $t['meta'] ); ?></div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<!-- ========================= SERVICE AREA ======================= -->
		<section class="vc-area py-5">
			<div class="container py-lg-4">
				<div class="row g-5 align-items-center">
					<div class="col-lg-6">
						<div class="vc-eyebrow"><?php echo esc_html( vc_val( 'area_eyebrow' ) ); ?></div>
						<h2 class="vc-serif vc-title vc-area-title"><?php echo esc_html( vc_val( 'area_title' ) ); ?></h2>
						<p class="vc-lead"><?php echo esc_html( vc_val( 'area_text' ) ); ?></p>
						<div class="row g-4 mt-1">
							<?php foreach ( vc_rows( 'area_counties' ) as $county ) :
								$cities = array_filter( array_map( 'trim', explode( ',', $county['cities'] ) ) );
							?>
								<div class="col-sm-6">
									<div class="vc-serif vc-county-title"><?php echo esc_html( $county['name'] ); ?></div>
									<div class="d-flex flex-wrap gap-2">
										<?php foreach ( $cities as $city ) : ?>
											<span class="vc-city"><?php echo esc_html( $city ); ?></span>
										<?php endforeach; ?>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
					<div class="col-lg-6">
						<?php echo vc_image_slot( vc_val( 'area_image' ), 'Service-area map (Cobb & Paulding)', 'vc-map vc-ar-4x3' ); ?>
					</div>
				</div>
			</div>
		</section>

		<!-- ======================== CONSULTATION ======================== -->
		<section id="consultation" class="vc-consult py-5">
			<div class="container py-lg-4">
				<div class="row g-5">
					<div class="col-lg-5">
						<h2 class="vc-serif vc-title vc-title--light mb-0"><?php echo esc_html( vc_val( 'consult_title' ) ); ?></h2>
						<div class="vc-rule"></div>
						<p class="vc-consult-text"><?php echo vc_para( vc_val( 'consult_text' ) ); ?></p>
						<div class="d-flex flex-column gap-3 mt-4">
							<a href="<?php echo esc_url( vc_val( 'consult_phone_link' ) ); ?>" class="vc-contact">
								<span class="vc-contact-icon"><i class="fa fa-phone"></i></span>
								<?php echo esc_html( vc_val( 'consult_phone' ) ); ?>
							</a>
							<a href="mailto:<?php echo esc_attr( vc_val( 'consult_email' ) ); ?>" class="vc-contact">
								<span class="vc-contact-icon"><i class="fa fa-envelope"></i></span>
								<?php echo esc_html( vc_val( 'consult_email' ) ); ?>
							</a>
							<div class="vc-contact">
								<span class="vc-contact-icon"><i class="fa fa-credit-card"></i></span>
								<?php echo esc_html( vc_val( 'consult_payment' ) ); ?>
							</div>
						</div>
					</div>
					<div class="col-lg-7">
						<div class="vc-form-card p-4 p-md-5">
							<?php
							// A Gravity Forms shortcode set in the backend replaces the
							// built-in form entirely. Blank ⇒ keep the built-in form.
							$vc_form_shortcode = trim( (string) vc_val( 'consult_form_shortcode' ) );
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
								<div class="col-md-6">
									<label class="form-label vc-form-label" for="vc-email">Email</label>
									<input type="email" id="vc-email" name="vc-email" class="form-control">
								</div>
								<div class="col-md-6">
									<label class="form-label vc-form-label" for="vc-care">Care Needed</label>
									<select id="vc-care" name="vc-care" class="form-select">
										<?php foreach ( vc_rows( 'care_options' ) as $opt ) : ?>
											<option><?php echo esc_html( $opt['label'] ); ?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="col-12">
									<label class="form-label vc-form-label" for="vc-message">How can we help?</label>
									<textarea id="vc-message" name="vc-message" class="form-control" rows="4"></textarea>
								</div>
								<div class="col-12 d-flex flex-wrap align-items-center gap-3">
									<button type="submit" class="btn btn-lg fw-bold px-4 vc-btn-gold">Send Request</button>
									<span class="vc-form-note"><?php echo esc_html( vc_val( 'form_note' ) ); ?></span>
								</div>
							</form>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- ========================= FAQ & CAREERS ====================== -->
		<section class="vc-faq py-5">
			<div class="container py-lg-4">
				<div class="row g-5">
					<div class="col-lg-7">
						<h2 class="vc-serif vc-title vc-faq-title"><?php echo esc_html( vc_val( 'faq_title' ) ); ?></h2>
						<div class="accordion vc-faq-accordion" id="vcFaq">
							<?php foreach ( vc_rows( 'faq' ) as $i => $faq ) :
								$faq_id  = 'vcFaq' . $i;
								$is_open = ( 0 === $i );
							?>
								<div class="accordion-item">
									<h3 class="accordion-header">
										<button class="accordion-button vc-serif<?php echo $is_open ? '' : ' collapsed'; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo esc_attr( $faq_id ); ?>" aria-expanded="<?php echo $is_open ? 'true' : 'false'; ?>" aria-controls="<?php echo esc_attr( $faq_id ); ?>">
											<?php echo esc_html( $faq['question'] ); ?>
										</button>
									</h3>
									<div id="<?php echo esc_attr( $faq_id ); ?>" class="accordion-collapse collapse<?php echo $is_open ? ' show' : ''; ?>" data-bs-parent="#vcFaq">
										<div class="accordion-body vc-faq-body"><?php echo vc_para( $faq['answer'] ); ?></div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
					<div class="col-lg-5">
						<div class="vc-careers p-4 p-xl-5 h-100 d-flex flex-column justify-content-center">
							<i class="fa fa-briefcase vc-careers-icon"></i>
							<h2 class="vc-serif vc-careers-title"><?php echo esc_html( vc_val( 'careers_title' ) ); ?></h2>
							<p class="vc-careers-text"><?php echo vc_para( vc_val( 'careers_text' ) ); ?></p>
							<a href="<?php echo esc_url( vc_val( 'careers_btn_link' ) ); ?>" class="btn fw-bold px-4 py-2 align-self-start mt-2 vc-btn-gold">
								<?php echo esc_html( vc_val( 'careers_btn_text' ) ); ?>
							</a>
						</div>
					</div>
				</div>
			</div>
		</section>

		<?php endwhile; ?>

	</div><!-- .vc-home -->
</div><!-- #page-wrap -->

<?php get_footer(); ?>
