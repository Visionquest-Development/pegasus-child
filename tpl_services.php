<?php
/*
	Template Name: Services Hub Template
*/

/**
 * Services hub (/services/) for Hart Family of Home Services.
 *
 * Lists every service as the same card grid used on the home page. Also applied
 * automatically to the top-level "services" page while it has no template (see
 * hfhs_services_hub_fallback() in inc/hfhs-site-fixes.php), so /services/ no
 * longer falls back to the blog sidebar layout.
 *
 * CMB2: "Services Hub Content" (inc/cmb2-services-hub-fields.php). Blank = default.
 */
?>
<?php get_header(); ?>

<?php
	$hero_bg  = hfhs_hero_bg( hfhs_hub_field( 'hero_image', '' ), get_stylesheet_directory_uri() . '/images/hero.jpg' );
	$services = hfhs_hub_group( 'services', hfhs_default_service_cards() );

	$hfhs_service_icon = '<svg class="hfhs-service__icon-svg" viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M12 30 32 14l20 16"/><path d="M18 28v20h28V28"/><path d="M28 48V36h8v12"/><path d="M8 40c3-3 6-3 9 0M47 40c3-3 6-3 9 0"/></svg>';
	$hfhs_icons_uri  = get_stylesheet_directory_uri() . '/images/branding/icons/';
	$hfhs_icons_path = get_stylesheet_directory() . '/images/branding/icons/';
?>

<main id="page-wrap" class="hfhs-home hfhs-services-hub">

	<!-- ================= 1. HERO ================= -->
	<section class="hfhs-hero hfhs-contact-hero hfhs-section--dark" id="top" style="background-image: url('<?php echo esc_url( $hero_bg ); ?>');">
		<div class="hfhs-hero__overlay" aria-hidden="true"></div>
		<div class="container hfhs-hero__inner wow fadeInUp" data-wow-duration="1s">
			<nav class="hfhs-breadcrumb" aria-label="Breadcrumb">
				<a href="<?php echo esc_url( hfhs_home_link( '/' ) ); ?>">Home</a>
				<span aria-hidden="true">/</span>
				<span aria-current="page"><?php echo esc_html( get_the_title() ); ?></span>
			</nav>
			<p class="hfhs-eyebrow hfhs-eyebrow--light"><?php echo esc_html( hfhs_hub_field( 'hero_eyebrow', 'Our Services' ) ); ?></p>
			<p class="hfhs-eyebrow-script hfhs-eyebrow-script--light"><?php echo esc_html( hfhs_hub_field( 'hero_script', 'From Our Family to Yours.' ) ); ?></p>
			<h1 class="hfhs-hero__title"><?php echo wp_kses_post( hfhs_hub_field( 'hero_title', 'Ten services. <em>One trusted team.</em>' ) ); ?></h1>
			<p class="hfhs-hero__lead"><?php echo esc_html( hfhs_hub_field( 'hero_text', 'From seasonal maintenance to full-scale improvements, we handle home care end-to-end so you’re never juggling multiple contractors.' ) ); ?></p>
		</div>
	</section>

	<!-- ================= 2. SERVICES GRID ================= -->
	<section class="hfhs-services hfhs-section--dark" id="services">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-9 col-xl-8 text-center hfhs-services__head wow fadeInUp" data-wow-duration="0.9s">
					<p class="hfhs-eyebrow hfhs-eyebrow--light"><?php echo esc_html( hfhs_hub_field( 'services_eyebrow', 'What We Do' ) ); ?></p>
					<p class="hfhs-services__lead"><?php echo esc_html( hfhs_hub_field( 'services_lead', 'Click any service below to learn more.' ) ); ?></p>
				</div>
			</div>

			<div class="row g-0 hfhs-services__grid">
				<?php foreach ( $services as $i => $service ) : ?>
					<div class="col-12 col-md-6 col-lg-4">
						<a class="hfhs-service wow fadeInUp" data-wow-duration="0.7s" data-wow-delay="<?php echo esc_attr( ( $i % 3 ) * 0.12 ); ?>s" href="<?php echo esc_url( ! empty( $service['link'] ) ? hfhs_url( $service['link'] ) : '#' ); ?>">
							<span class="hfhs-service__media"<?php if ( ! empty( $service['img'] ) ) : ?> style="background-image: url('<?php echo esc_url( $service['img'] ); ?>');"<?php endif; ?> aria-hidden="true"></span>
							<span class="hfhs-service__num"><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></span>
							<span class="hfhs-service__body">
								<span class="hfhs-service__icon" aria-hidden="true">
									<?php
									$svc_slug = ! empty( $service['link'] ) ? basename( untrailingslashit( (string) wp_parse_url( $service['link'], PHP_URL_PATH ) ) ) : '';
									$svc_icon = $svc_slug ? $hfhs_icons_path . $svc_slug . '-icon.png' : '';
									if ( $svc_icon && file_exists( $svc_icon ) ) : ?>
										<img class="hfhs-service__icon-img" src="<?php echo esc_url( $hfhs_icons_uri . $svc_slug . '-icon.png' ); ?>" alt="" width="58" height="58" loading="lazy" />
									<?php else : echo $hfhs_service_icon; // phpcs:ignore
									endif; ?>
								</span>
								<span class="hfhs-service__title"><?php echo esc_html( isset( $service['title'] ) ? $service['title'] : '' ); ?></span>
								<span class="hfhs-service__desc"><?php echo esc_html( isset( $service['desc'] ) ? $service['desc'] : '' ); ?></span>
								<?php if ( ! empty( $service['cta'] ) ) : ?>
									<span class="hfhs-service__cta hfhs-arrow-link"><?php echo esc_html( $service['cta'] ); ?> <span class="hfhs-arrow" aria-hidden="true">&rarr;</span></span>
								<?php endif; ?>
							</span>
						</a>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- ================= 3. CTA ================= -->
	<section class="hfhs-cta hfhs-section--dark">
		<div class="container text-center wow fadeInUp" data-wow-duration="0.9s">
			<p class="hfhs-eyebrow-script hfhs-eyebrow-script--light"><?php echo esc_html( hfhs_hub_field( 'cta_script', 'Ready to get started?' ) ); ?></p>
			<h2 class="hfhs-display hfhs-cta__title"><?php echo wp_kses_post( hfhs_hub_field( 'cta_title', 'Request a free estimate today.' ) ); ?></h2>
			<div class="hfhs-cta__actions">
				<a class="hfhs-btn hfhs-btn--solid" href="<?php echo esc_url( hfhs_home_link( '/contact/' ) ); ?>">Contact Us</a>
				<a class="hfhs-btn hfhs-btn--outline-light" href="tel:+14045072579">Call 404-507-2579</a>
			</div>
		</div>
	</section>

</main><!-- end .hfhs-services-hub -->

<?php get_footer(); ?>
