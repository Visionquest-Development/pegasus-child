<?php
/*
	Template Name: Contact Template
*/

/**
 * Contact page template for Hart Family of Home Services.
 *
 * Header/footer handled by the parent theme via get_header()/get_footer().
 *
 * Fully CMB2-driven ("Contact Page Content" metabox in functions.php). The
 * estimate form is a Gravity Forms shortcode field — paste the [gravityform]
 * tag into "Gravity Forms Shortcode" and it renders in place of the placeholder.
 * Repeatable groups power the Direct-Contact items and the Service-Area cities.
 */
?>
<?php get_header(); ?>

<?php
	$hero_bg = hfhs_contact_field( 'hero_image', get_stylesheet_directory_uri() . '/images/hero.jpg' );

	$form_shortcode = hfhs_contact_field( 'form_shortcode', '' );

	// Direct-contact items (repeatable; falls back to these four).
	$direct = hfhs_contact_group( 'direct', array(
		array( 'icon' => 'phone', 'label' => 'Call or Text', 'value' => '404-507-2579', 'subtext' => 'Text a photo of your project to save time on estimates.' ),
		array( 'icon' => 'email', 'label' => 'Email', 'value' => 'contact@hfhsgeorgia.com', 'subtext' => 'For sales inquiries: sales@hfhsgeorgia.com' ),
		array( 'icon' => 'location', 'label' => 'Service Area', 'value' => 'Greater Atlanta, GA', 'subtext' => 'Serving homeowners, HOA boards, property managers, and commercial clients across metro Atlanta.' ),
		array( 'icon' => 'hours', 'label' => 'Hours', 'value' => 'Monday–Friday · 9:00 AM — 6:00 PM', 'subtext' => "Saturday · By appointment\nSunday · With our families" ),
	) );

	// Inline line-icons for the direct-contact items.
	$hfhs_contact_icons = array(
		'phone'    => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6.6 10.8a12 12 0 0 0 5.6 5.6l1.9-1.9a1 1 0 0 1 1-.24 11 11 0 0 0 3.4.55 1 1 0 0 1 1 1V19a1 1 0 0 1-1 1A16 16 0 0 1 4 5a1 1 0 0 1 1-1h2.4a1 1 0 0 1 1 1 11 11 0 0 0 .55 3.4 1 1 0 0 1-.24 1z"/></svg>',
		'email'    => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="1.5"/><path d="m4 7 8 6 8-6"/></svg>',
		'location' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 21s7-6.3 7-11a7 7 0 1 0-14 0c0 4.7 7 11 7 11z"/><circle cx="12" cy="10" r="2.5"/></svg>',
		'hours'    => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="8.5"/><path d="M12 7.5V12l3 2"/></svg>',
	);

	// Cities served (repeatable text; falls back to these).
	$cities = hfhs_contact_field( 'cities', array(
		'Atlanta', 'Suwanee', 'Alpharetta', 'Acworth',
		'Kennesaw', 'Marietta', 'Vinings', 'Decatur',
		'Sandy Springs', 'Roswell', 'Dunwoody', 'Smyrna',
	) );
	if ( ! is_array( $cities ) ) {
		$cities = array_filter( array_map( 'trim', explode( ',', (string) $cities ) ) );
	}
?>

<main id="page-wrap" class="hfhs-home hfhs-contact-page">

	<!-- ================= HERO ================= -->
	<section class="hfhs-hero hfhs-contact-hero hfhs-section--dark" id="top" style="background-image: url('<?php echo esc_url( $hero_bg ); ?>');">
		<div class="hfhs-hero__overlay" aria-hidden="true"></div>
		<div class="container hfhs-hero__inner wow fadeInUp" data-wow-duration="1s">
			<nav class="hfhs-breadcrumb" aria-label="Breadcrumb">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
				<span aria-hidden="true">/</span>
				<span aria-current="page">Contact</span>
			</nav>
			<p class="hfhs-eyebrow hfhs-eyebrow--light"><?php echo esc_html( hfhs_contact_field( 'hero_eyebrow', 'Contact Us' ) ); ?></p>
			<p class="hfhs-eyebrow-script hfhs-eyebrow-script--light"><?php echo esc_html( hfhs_contact_field( 'hero_script', 'From Our Family to Yours.' ) ); ?></p>
			<h1 class="hfhs-hero__title"><?php echo wp_kses_post( hfhs_contact_field( 'hero_title', 'Request a <em>free estimate.</em>' ) ); ?></h1>
			<p class="hfhs-hero__lead"><?php echo esc_html( hfhs_contact_field( 'hero_text', 'Tell us a little about your project and we’ll get back to you within one business day with a written, itemized estimate. For urgent repairs, give us a call.' ) ); ?></p>
		</div>
	</section>

	<!-- ================= FORM + DIRECT CONTACT ================= -->
	<section class="hfhs-contact hfhs-section--white">
		<div class="container">
			<div class="row g-5">
				<!-- Estimate form -->
				<div class="col-lg-7 hfhs-contact__form wow fadeInUp" data-wow-duration="0.9s">
					<p class="hfhs-eyebrow"><?php echo esc_html( hfhs_contact_field( 'form_eyebrow', 'Free Estimate Form' ) ); ?></p>
					<p class="hfhs-eyebrow-script hfhs-contact__script"><?php echo esc_html( hfhs_contact_field( 'form_script', 'Tell us about your project.' ) ); ?></p>
					<h2 class="hfhs-display hfhs-contact__title"><?php echo wp_kses_post( hfhs_contact_field( 'form_title', 'We&rsquo;ll respond <em>within one business day.</em>' ) ); ?></h2>

					<div class="hfhs-contact__formwrap">
						<?php if ( $form_shortcode ) : ?>
							<?php echo do_shortcode( $form_shortcode ); ?>
						<?php else : ?>
							<div class="hfhs-form-placeholder hfhs-form-placeholder--light" role="note">
								<span class="hfhs-form-placeholder__label">Gravity Forms</span>
								<p class="hfhs-form-placeholder__text">The free-estimate form will be embedded here. Add the Gravity Forms shortcode to the &ldquo;Gravity Forms Shortcode&rdquo; field on this page once the form is built.</p>
							</div>
						<?php endif; ?>
					</div>
				</div>

				<!-- Direct contact card -->
				<div class="col-lg-5 hfhs-contact__aside wow fadeInUp" data-wow-duration="0.9s" data-wow-delay="0.15s">
					<div class="hfhs-cdirect">
						<p class="hfhs-cdirect__heading"><?php echo esc_html( hfhs_contact_field( 'direct_heading', 'Direct Contact' ) ); ?></p>
						<?php foreach ( $direct as $item ) :
							$icon    = isset( $item['icon'] ) ? $item['icon'] : '';
							$label   = isset( $item['label'] ) ? $item['label'] : '';
							$value   = isset( $item['value'] ) ? $item['value'] : '';
							$subtext = isset( $item['subtext'] ) ? $item['subtext'] : '';
							$svg     = isset( $hfhs_contact_icons[ $icon ] ) ? $hfhs_contact_icons[ $icon ] : '';
						?>
							<div class="hfhs-cdirect__item wow fadeInUp" data-wow-duration="0.7s">
								<span class="hfhs-cdirect__icon" aria-hidden="true"><?php echo $svg; // phpcs:ignore ?></span>
								<div class="hfhs-cdirect__body">
									<?php if ( $label ) : ?><span class="hfhs-cdirect__label"><?php echo esc_html( $label ); ?></span><?php endif; ?>
									<?php if ( $value ) : ?>
										<span class="hfhs-cdirect__value">
											<?php
											if ( 'phone' === $icon ) {
												echo '<a href="tel:' . esc_attr( preg_replace( '/[^0-9+]/', '', $value ) ) . '">' . esc_html( $value ) . '</a>';
											} elseif ( 'email' === $icon ) {
												echo '<a href="mailto:' . esc_attr( $value ) . '">' . esc_html( $value ) . '</a>';
											} else {
												echo esc_html( $value );
											}
											?>
										</span>
									<?php endif; ?>
									<?php if ( $subtext ) : ?><span class="hfhs-cdirect__sub"><?php echo nl2br( esc_html( $subtext ) ); ?></span><?php endif; ?>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- ================= SERVICE AREA ================= -->
	<section class="hfhs-area hfhs-section--light">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-9 col-xl-8 text-center hfhs-area__head wow fadeInUp" data-wow-duration="0.9s">
					<p class="hfhs-eyebrow"><?php echo esc_html( hfhs_contact_field( 'area_eyebrow', 'Service Area' ) ); ?></p>
					<p class="hfhs-eyebrow-script"><?php echo esc_html( hfhs_contact_field( 'area_script', 'Where we work.' ) ); ?></p>
					<h2 class="hfhs-display hfhs-area__title"><?php echo wp_kses_post( hfhs_contact_field( 'area_title', 'Proud to serve <em>Greater Atlanta.</em>' ) ); ?></h2>
					<p class="hfhs-area__text"><?php echo esc_html( hfhs_contact_field( 'area_text', 'We cover a wide swath of metro Atlanta — inside the Perimeter and well beyond. Not sure if you’re in our range? Give us a call at 404-507-2579 and we’ll let you know on the spot.' ) ); ?></p>
				</div>
			</div>

			<?php if ( ! empty( $cities ) ) : ?>
				<div class="row g-0 hfhs-cities">
					<?php foreach ( $cities as $city ) : ?>
						<div class="col-6 col-md-3 hfhs-cities__cell"><?php echo esc_html( $city ); ?></div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
	</section>

	<!-- ================= CTA ================= -->
	<section class="hfhs-cta hfhs-section--dark">
		<div class="container text-center wow fadeInUp" data-wow-duration="0.9s">
			<p class="hfhs-eyebrow-script hfhs-eyebrow-script--light"><?php echo esc_html( hfhs_contact_field( 'cta_script', 'Prefer to talk first?' ) ); ?></p>
			<h2 class="hfhs-display hfhs-cta__title"><?php echo wp_kses_post( hfhs_contact_field( 'cta_title', 'Give us a call. We actually answer.' ) ); ?></h2>
			<div class="hfhs-cta__actions">
				<a class="hfhs-btn hfhs-btn--solid" href="tel:+14045072579">Call 404-507-2579</a>
				<a class="hfhs-btn hfhs-btn--outline-light" href="mailto:contact@hfhsgeorgia.com">Email Us</a>
			</div>
		</div>
	</section>

</main><!-- end .hfhs-contact-page -->

<?php get_footer(); ?>
