<?php
/*
	Template Name: Home Template
*/

/**
 * Home page template for Hart Family of Home Services.
 *
 * Adapted from the parent theme's "No Sidebar Template" (tpl_page-full-width.php).
 * Header and footer are intentionally handled by the parent theme via
 * get_header() / get_footer(); this template only outputs the home page body.
 *
 * NOTE: All copy below is hard-coded for now. Each section is structured so the
 * strings/images can be swapped for CMB2 fields on the Home edit screen later
 * (see the $hfhs_services array + section wrappers). All styling lives in
 * style.css — no inline CSS.
 */
?>
<?php get_header(); ?>

<?php
	// -------------------------------------------------------------------------
	// Service cards (data-driven so it maps cleanly onto CMB2 repeater later).
	// URLs point at the child pages already created under /services/.
	// -------------------------------------------------------------------------
	$hfhs_services = array(
		array(
			'title' => 'Gutters',
			'desc'  => 'Cleaning, repair, full replacement, and custom installations. Keep water moving away from your home and your foundation.',
			'link'  => home_url( '/services/gutters/' ),
			'cta'   => 'Explore Gutters',
			'img'   => 'https://hfhsgeorgia.com/wp-content/uploads/2024/12/gutters-small.webp',
		),
		array(
			'title' => 'Fencing',
			'desc'  => 'Wood privacy, picket, chain link, and custom gates. We’ve installed runs over 700 feet — no job is too long.',
			'link'  => home_url( '/services/fencing/' ),
			'cta'   => 'Explore Fencing',
			'img'   => 'https://hfhsgeorgia.com/wp-content/uploads/2024/12/fencing-header.webp',
		),
		array(
			'title' => 'Exterior Repairs',
			'desc'  => 'Siding, fascia, soffit, windows, pressure washing, and weatherproofing. Full-scale exterior maintenance for homes and HOAs.',
			'link'  => home_url( '/services/exterior-repairs/' ),
			'cta'   => 'Explore Exterior Repairs',
			'img'   => 'https://hfhsgeorgia.com/wp-content/uploads/2024/12/sofit-siding-header.webp',
		),
		array(
			'title' => 'Roofing',
			'desc'  => 'Inspections, shingle repair, leak diagnosis, and storm damage assessment. Safety and transparency on every project.',
			'link'  => home_url( '/services/roofing/' ),
			'cta'   => 'Explore Roofing',
			'img'   => 'https://hfhsgeorgia.com/wp-content/uploads/2024/12/roofing-header.webp',
		),
		array(
			'title' => 'Tree Services',
			'desc'  => 'Removal, trimming, storm cleanup, and debris hauling. Careful work that protects your property and landscape.',
			'link'  => home_url( '/services/tree-services/' ),
			'cta'   => 'Explore Tree Services',
			'img'   => 'https://hfhsgeorgia.com/wp-content/uploads/2024/12/Finished-Dead-Tree-Removal.webp',
		),
		array(
			'title' => 'Decking',
			'desc'  => 'New deck construction, repair, staining, refinishing, and railings. Pergolas and custom outdoor structures.',
			'link'  => home_url( '/services/decking/' ),
			'cta'   => 'Explore Decking',
			'img'   => 'https://hfhsgeorgia.com/wp-content/uploads/2025/03/decking-services.webp',
		),
		array(
			'title' => 'Handyman Services',
			'desc'  => 'The punch-list specialists. One call knocks out the whole honey-do list — mounts, fixtures, small fixes, and more.',
			'link'  => home_url( '/services/handyman/' ),
			'cta'   => 'Explore Handyman',
			'img'   => 'https://hfhsgeorgia.com/wp-content/uploads/2024/12/home-repair-small.webp',
		),
		array(
			'title' => 'Interior Repairs',
			'desc'  => 'Painting, drywall, trim, crown molding, and finish carpentry. Clean job sites and finishes that look intentional.',
			'link'  => home_url( '/services/interior-repairs/' ),
			'cta'   => 'Explore Interior Repairs',
			'img'   => 'https://hfhsgeorgia.com/wp-content/uploads/2024/12/sofit-repairs.webp',
		),
		array(
			'title' => 'Custom Projects',
			'desc'  => 'Saunas, chicken coops, climbing walls, pergolas, custom gates. If you can dream it, there’s a good chance we can build it.',
			'link'  => home_url( '/services/custom-projects/' ),
			'cta'   => 'Explore Custom Projects',
			'img'   => 'https://hfhsgeorgia.com/wp-content/uploads/2025/03/Dry-sauna-3.webp',
		),
	);

	// Generic placeholder line-icon reused per card. Swap per-service via CMB2 later.
	$hfhs_service_icon = '<svg class="hfhs-service__icon-svg" viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M12 30 32 14l20 16"/><path d="M18 28v20h28V28"/><path d="M28 48V36h8v12"/><path d="M8 40c3-3 6-3 9 0M47 40c3-3 6-3 9 0"/></svg>';
?>

<main id="page-wrap" class="hfhs-home">

	<!-- ================= HERO ================= -->
	<section class="hfhs-hero hfhs-section--dark" id="top">
		<div class="hfhs-hero__overlay" aria-hidden="true"></div>
		<div class="container hfhs-hero__inner">
			<p class="hfhs-eyebrow-script hfhs-eyebrow-script--light">From Our Family to Yours</p>
			<h1 class="hfhs-hero__title">Your Family of <br/><em>Home Service</em> Providers</h1>
			<p class="hfhs-hero__lead mb-3">Founded in 2023, Hart Family of Home Services is a family-owned, full-service home care team serving homeowners, property managers, and HOA communities across the Greater Atlanta area.</p>
			<div class="hfhs-hero__actions">
				<a class="hfhs-btn hfhs-btn--solid" href="#services">Explore Our Services</a>
				<a class="hfhs-btn hfhs-btn--outline-light" href="#about">Meet the Hart Family</a>
			</div>
		</div>

		<div class="container hfhs-hero__stats">
			<div class="row g-0 text-center">
				<div class="col-6 col-md-3 hfhs-stat">
					<span class="hfhs-stat__label">Established</span>
					<span class="hfhs-stat__value">2023</span>
				</div>
				<div class="col-6 col-md-3 hfhs-stat">
					<span class="hfhs-stat__label">Service Area</span>
					<span class="hfhs-stat__value">Greater Atlanta</span>
				</div>
				<div class="col-6 col-md-3 hfhs-stat">
					<span class="hfhs-stat__label">Licensed &amp; Insured</span>
					<span class="hfhs-stat__value">Yes</span>
				</div>
				<div class="col-6 col-md-3 hfhs-stat">
					<span class="hfhs-stat__label">Call Us</span>
					<span class="hfhs-stat__value"><a href="tel:+14045072579">404-507-2579</a></span>
				</div>
			</div>
		</div>
	</section>

	<!-- ================= WELCOME / VALUES ================= -->
	<section class="hfhs-values hfhs-section--white">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-9 col-xl-8 text-center">
					<p class="hfhs-eyebrow hfhs-eyebrow--line">Welcome</p>
					<h2 class="hfhs-display hfhs-values__title">We built this company on three values we <em>refuse to compromise on</em> &mdash; trust, integrity, and honesty.</h2>
					<p class="hfhs-values__body">What started as a single-service gutter cleaning operation has grown into a trusted, full-service home care team. We carry forward a family tradition of entrepreneurship that spans generations, and we bring that same standard to every home we serve.</p>
					<p class="hfhs-values__body">When you hire Hart Family of Home Services, you&rsquo;re not just getting a contractor &mdash; you&rsquo;re getting a team that treats your home like it&rsquo;s our own.</p>
					<p class="hfhs-eyebrow-script hfhs-values__sign">Family Owned. Honest Work. Reliable Results.</p>
				</div>
			</div>
		</div>
	</section>

	<!-- ================= SERVICES ================= -->
	<section class="hfhs-services hfhs-section--dark" id="services">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-9 col-xl-8 text-center hfhs-services__head">
					<p class="hfhs-eyebrow hfhs-eyebrow--light">What We Do</p>
					<h2 class="hfhs-display hfhs-services__title">Nine services. One trusted team.</h2>
					<p class="hfhs-services__lead">From seasonal maintenance to full-scale improvements, we handle home care end-to-end so you&rsquo;re never juggling multiple contractors. Click any service below to learn more.</p>
				</div>
			</div>

			<div class="row g-0 hfhs-services__grid">
				<?php foreach ( $hfhs_services as $i => $service ) : ?>
					<div class="col-12 col-md-6 col-lg-4">
						<a class="hfhs-service" href="<?php echo esc_url( $service['link'] ); ?>">
							<span class="hfhs-service__media"<?php if ( ! empty( $service['img'] ) ) : ?> style="background-image: url('<?php echo esc_url( $service['img'] ); ?>');"<?php endif; ?> aria-hidden="true"></span>
							<span class="hfhs-service__num"><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></span>
							<span class="hfhs-service__body">
								<span class="hfhs-service__icon" aria-hidden="true"><?php echo $hfhs_service_icon; // phpcs:ignore ?></span>
								<span class="hfhs-service__title"><?php echo esc_html( $service['title'] ); ?></span>
								<span class="hfhs-service__desc"><?php echo esc_html( $service['desc'] ); ?></span>
								<span class="hfhs-service__cta hfhs-arrow-link"><?php echo esc_html( $service['cta'] ); ?> <span class="hfhs-arrow" aria-hidden="true">&rarr;</span></span>
							</span>
						</a>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- ================= ABOUT ================= -->
	<section class="hfhs-about hfhs-section--light" id="about">
		<div class="container">
			<div class="row align-items-center g-5">
				<div class="col-lg-6">
					<div class="hfhs-about__media" role="img" aria-label="Josh Hart on a roofing job" style="background-image: url('<?php echo esc_url( get_stylesheet_directory_uri() . '/images/about-josh.jpg' ); ?>');">
						<span class="hfhs-frame hfhs-frame--tl" aria-hidden="true"></span>
						<span class="hfhs-frame hfhs-frame--br" aria-hidden="true"></span>
					</div>
				</div>
				<div class="col-lg-6">
					<p class="hfhs-eyebrow">About Us</p>
					<p class="hfhs-eyebrow-script hfhs-about__script">Meet the Hart Family</p>
					<h2 class="hfhs-display hfhs-about__title">Six family members. <em>One promise.</em></h2>
					<p class="hfhs-about__body">Josh Hart founded the company in 2023, carrying forward a family tradition of entrepreneurship that spans his grandfather, uncle, mother, and father. Today our team includes Destiny, Jacob, Andrew, Sage, and Faith &mdash; each bringing their own craft to your home.</p>
					<p class="hfhs-about__body">We&rsquo;re licensed, insured, and active in the local business community.</p>

					<div class="row hfhs-about__stats">
						<div class="col-6">
							<span class="hfhs-about__stat-value">BNI</span>
							<span class="hfhs-about__stat-label">Active Member</span>
						</div>
						<div class="col-6">
							<span class="hfhs-about__stat-value">Licensed &amp; Insured</span>
							<span class="hfhs-about__stat-label">All Services</span>
						</div>
					</div>

					<a class="hfhs-btn hfhs-btn--outline-dark" href="<?php echo esc_url( home_url( '/about/' ) ); ?>">Read Our Full Story</a>
				</div>
			</div>
		</div>
	</section>

	<!-- ================= TESTIMONIAL ================= -->
	<section class="hfhs-testimonial hfhs-section--dark">
		<span class="hfhs-testimonial__mark" aria-hidden="true">&ldquo;</span>
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-10 col-xl-8 text-center">
					<p class="hfhs-eyebrow-script hfhs-eyebrow-script--light">What our family of clients says</p>
					<p class="hfhs-eyebrow hfhs-eyebrow--light">A Property Manager&rsquo;s Perspective</p>
					<blockquote class="hfhs-testimonial__quote">
						We have completed at least 50 projects with Hart Family of Home Services and have yet to encounter a problem that wasn&rsquo;t immediately handled. They are on time, professional, responsive, and competitive.
					</blockquote>
					<div class="hfhs-stars" aria-label="5 out of 5 stars">
						<span aria-hidden="true">&#9733; &#9733; &#9733; &#9733; &#9733;</span>
					</div>
					<p class="hfhs-testimonial__name">Daniel Zisoff</p>
					<p class="hfhs-testimonial__role">Property Manager &middot; Greater Atlanta</p>
					<div class="hfhs-testimonial__links">
						<a class="hfhs-arrow-link hfhs-arrow-link--light" href="<?php echo esc_url( home_url( '/testimonials/' ) ); ?>">Read All Testimonials <span class="hfhs-arrow" aria-hidden="true">&rarr;</span></a>
						<a class="hfhs-arrow-link hfhs-arrow-link--light" href="<?php echo esc_url( home_url( '/testimonials/#submit' ) ); ?>">Submit a Testimonial <span class="hfhs-arrow" aria-hidden="true">&rarr;</span></a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- ================= COMMUNITY ================= -->
	<section class="hfhs-community hfhs-section--light">
		<div class="container">
			<div class="row align-items-center g-5">
				<div class="col-lg-6">
					<p class="hfhs-eyebrow">Community</p>
					<h2 class="hfhs-display hfhs-community__title">We&rsquo;re a family &mdash; and we <em>show up</em> for our community.</h2>
					<p class="hfhs-community__body">A business is only as strong as the community that supports it. We don&rsquo;t just operate in Atlanta &mdash; we invest in it. From sponsoring local scout troops to partnering with Family Promise of DeKalb, we give our time, resources, and hands to the organizations that make our neighborhoods better places to live.</p>

					<div class="hfhs-community__partners">
						<div class="row g-0">
							<div class="col-sm-6 hfhs-partner">
								<span class="hfhs-partner__name">Boy Scouts of America</span>
								<span class="hfhs-partner__role">Local Troop Support</span>
							</div>
							<div class="col-sm-6 hfhs-partner">
								<span class="hfhs-partner__name">Family Promise of DeKalb</span>
								<span class="hfhs-partner__role">Homeless Family Support</span>
							</div>
							<div class="col-sm-6 hfhs-partner">
								<span class="hfhs-partner__name">Local Youth Sports</span>
								<span class="hfhs-partner__role">Little League Sponsor</span>
							</div>
							<div class="col-sm-6 hfhs-partner">
								<span class="hfhs-partner__name">Habitat Partners</span>
								<span class="hfhs-partner__role">Home Repair Volunteers</span>
							</div>
						</div>
					</div>

					<a class="hfhs-btn hfhs-btn--outline-dark" href="<?php echo esc_url( home_url( '/community/' ) ); ?>">See How to Get Involved</a>
				</div>
				<div class="col-lg-6">
					<div class="hfhs-community__media">
						<img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/images/community-family-promise.jpg' ); ?>" alt="Family Promise of North Fulton/DeKalb thanks Josh &amp; Jacob of Hart Family of Home Services for their volunteer work" loading="lazy" />
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- ================= CTA ================= -->
	<section class="hfhs-cta hfhs-section--dark">
		<div class="container text-center">
			<p class="hfhs-eyebrow-script hfhs-eyebrow-script--light">Ready to get started?</p>
			<h2 class="hfhs-display hfhs-cta__title">Request a free estimate today.</h2>
			<div class="hfhs-cta__actions">
				<a class="hfhs-btn hfhs-btn--solid" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Contact Us</a>
				<a class="hfhs-btn hfhs-btn--outline-light" href="tel:+14045072579">Call 404-507-2579</a>
			</div>
		</div>
	</section>

</main><!-- end .hfhs-home -->

<?php get_footer(); ?>
