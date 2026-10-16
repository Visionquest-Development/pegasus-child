<?php
/*
Template Name: Landing Template
*/

get_header();

$header_choice = pegasus_get_option( 'header_select' );
if ( 'header-three' === $header_choice ) {
	get_template_part( 'templates/additional_header' );
}
?>

<div id="page-wrap">
	<div class="page-header-spacer"></div>

	<?php $oak_hero_bg = content_url( '/uploads/roofing-construction-hero.jpg' ); ?>
	<section class="oak-landing bg-black text-white" style="--oak-hero-bg: url('<?php echo esc_url( $oak_hero_bg ); ?>');">

		<!-- HERO -->
		<div class="oak-hero">
			<div class="container text-center py-5">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="oak-landing-logo d-inline-block mb-4">
					<img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/images/34oak-contracting-logo-only.png' ); ?>" alt="34 Oak Contracting">
				</a>

				<h1 class="display-3 fw-bold text-uppercase oak-gradient-text">
					Roofing, Remodeling &amp; Renovations
				</h1>

				<div class="oak-divider"></div>

				<p class="lead fst-italic mb-4">
					Built for Lasting Results
				</p>

				<h2 class="fw-bold mb-4">
					Interior &bull; Exterior &bull; Whole-Home
				</h2>

				<p class="fs-5 mb-4 mx-auto" style="max-width: 760px;">
					34 Oak Contracting provides quality construction, remodeling, and home improvement services across North Georgia. Whether you're upgrading the inside of your home or improving curb appeal outside, we help homeowners get the job done right.
				</p>

				<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn oak-btn me-2 mb-2">Request a Free Estimate</a>
				<a href="tel:16785057663" class="btn btn-outline-light mb-2">Call or Text 678-505-ROOF</a>
			</div>
		</div>

		<img class="oak-landing-house d-block mx-auto mb-3" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/images/house-only.png' ); ?>" alt="Home upgrades">


		<!-- CHOOSE YOUR PROJECT -->
		<div class="container py-5">
			<div class="text-center mb-5">
				<h2 class="fw-bold text-uppercase oak-gradient-text">What Can We Build For You?</h2>
				<p class="text-white-50">Explore our interior and exterior services.</p>
			</div>

			<div class="row g-4 justify-content-center">
				<div class="col-md-6">
					<a href="<?php echo esc_url( home_url( '/interior-landing/' ) ); ?>" class="oak-card oak-card-link p-4 h-100 d-block text-decoration-none text-white">
						<div class="oak-icon"><i class="fa fa-cutlery" aria-hidden="true"></i></div>
						<h3 class="h3 fw-bold text-uppercase oak-gradient-text">Interior Services</h3>
						<p class="text-white-50">
							Kitchens, bathrooms, flooring, painting, trim, and drywall &mdash; transform the spaces you live in every day.
						</p>
						<ul>
							<li>Kitchen Remodels</li>
							<li>Bathroom Remodels</li>
							<li>Flooring</li>
							<li>Interior Painting</li>
							<li>Trim &amp; Millwork</li>
							<li>Drywall &amp; Repairs</li>
						</ul>
						<span class="btn oak-btn mt-3">View Interior Services</span>
					</a>
				</div>

				<div class="col-md-6">
					<a href="<?php echo esc_url( home_url( '/exterior-landing/' ) ); ?>" class="oak-card oak-card-link p-4 h-100 d-block text-decoration-none text-white">
						<div class="oak-icon"><i class="fa fa-home" aria-hidden="true"></i></div>
						<h3 class="h3 fw-bold text-uppercase oak-gradient-text">Exterior Services</h3>
						<p class="text-white-50">
							Roofing, siding, windows, concrete, fencing, and painting &mdash; protect your investment and improve curb appeal.
						</p>
						<ul>
							<li>Roofing</li>
							<li>Siding</li>
							<li>Windows</li>
							<li>Concrete</li>
							<li>Fencing</li>
							<li>Exterior Painting</li>
						</ul>
						<span class="btn oak-btn mt-3">View Exterior Services</span>
					</a>
				</div>
			</div>
		</div>

		<img class="oak-landing-free-estimates d-block mx-auto" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/images/free-estimates-banner-only.png' ); ?>" alt="Free Estimates">


		<!-- TRUST SECTION -->
		<div class="container py-5">
			<div class="row g-4 align-items-center">
				<div class="col-lg-6">
					<h2 class="fw-bold oak-gradient-text">Quality Workmanship. Honest Pricing.</h2>
					<p class="fs-5 text-white-50">
						We believe in clear communication, dependable scheduling, and quality work that protects your home for years to come.
					</p>

					<div class="row g-3 mt-3">
						<div class="col-sm-6">
							<strong class="oak-gold">Licensed &amp; Insured</strong>
							<p class="small text-white-50 mb-0">Professional. Reliable. Local.</p>
						</div>
						<div class="col-sm-6">
							<strong class="oak-gold">Local Company</strong>
							<p class="small text-white-50 mb-0">Proudly serving North Georgia.</p>
						</div>
						<div class="col-sm-6">
							<strong class="oak-gold">Quality Workmanship</strong>
							<p class="small text-white-50 mb-0">Built on trust. Backed by experience.</p>
						</div>
						<div class="col-sm-6">
							<strong class="oak-gold">Satisfaction Guaranteed</strong>
							<p class="small text-white-50 mb-0">We treat your home like our own.</p>
						</div>
					</div>
				</div>

				<div class="col-lg-6 text-center">
					<div class="oak-card p-4">
						<h3 class="fw-bold">Get Your Free Estimate</h3>
						<p class="text-white-50">Call, text, or submit a request online.</p>
						<a href="tel:16785057663" class="display-6 fw-bold text-white text-decoration-none">
							678-505-ROOF
						</a>
						<div class="mt-4">
							<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn oak-btn">Contact Us Today</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- FOOTER CTA -->
		<div class="text-center py-4" style="background: linear-gradient(90deg, #b87408, #f5c14c, #b87408); color: #000;">
			<strong class="text-uppercase">Proudly Serving North Georgia</strong>
		</div>
	</section>

</div><!-- end page wrap -->

<?php get_footer(); ?>
