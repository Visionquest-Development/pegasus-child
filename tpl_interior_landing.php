<?php
/*
Template Name: Landing - Interior Template
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
					Interior Remodeling &amp; Renovation
				</h1>

				<div class="oak-divider"></div>

				<p class="lead fst-italic mb-4">
					Built for Lasting Results
				</p>

				<h2 class="fw-bold mb-4">
					Kitchens &bull; Bathrooms &bull; Interiors
				</h2>

				<p class="fs-5 mb-4 mx-auto" style="max-width: 760px;">
					34 Oak Contracting brings craftsmanship and care to every interior remodel across North Georgia. From full kitchen and bathroom renovations to flooring, painting, trim, and drywall, we help homeowners transform the spaces they live in every day.
				</p>

				<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn oak-btn me-2 mb-2">Request a Free Estimate</a>
				<a href="tel:6783839503" class="btn btn-outline-light mb-2">Call or Text 678-383-9503</a>
			</div>
		</div>

		<img class="oak-landing-house d-block mx-auto mb-3" src="<?php echo esc_url( get_stylesheet_directory_uri() . '/images/house-only.png' ); ?>" alt="Interior remodels">


		<!-- SERVICES -->
		<div class="container py-5">
			<div class="text-center mb-5">
				<h2 class="fw-bold text-uppercase oak-gradient-text">Our Interior Services</h2>
				<p class="text-white-50">Kitchens, bathrooms, flooring, painting, trim, and drywall.</p>
			</div>

			<div class="row g-4">
				<div class="col-md-6 col-lg-4">
					<div class="oak-card p-4">
						<div class="oak-icon"><i class="fa fa-cutlery" aria-hidden="true"></i></div>
						<h3 class="h4 fw-bold">Kitchen Remodels</h3>
						<ul>
							<li>Custom cabinetry</li>
							<li>Countertops &amp; backsplashes</li>
							<li>Islands &amp; layouts</li>
							<li>Lighting &amp; fixtures</li>
							<li>Full kitchen renovations</li>
						</ul>
					</div>
				</div>

				<div class="col-md-6 col-lg-4">
					<div class="oak-card p-4">
						<div class="oak-icon"><i class="fa fa-bath" aria-hidden="true"></i></div>
						<h3 class="h4 fw-bold">Bathroom Remodels</h3>
						<ul>
							<li>Tile showers &amp; tubs</li>
							<li>Vanities &amp; countertops</li>
							<li>Flooring &amp; fixtures</li>
							<li>Half &amp; primary baths</li>
							<li>Full bathroom renovations</li>
						</ul>
					</div>
				</div>

				<div class="col-md-6 col-lg-4">
					<div class="oak-card p-4">
						<div class="oak-icon"><i class="fa fa-th-large" aria-hidden="true"></i></div>
						<h3 class="h4 fw-bold">Flooring</h3>
						<ul>
							<li>Hardwood &amp; engineered wood</li>
							<li>Luxury vinyl plank (LVP)</li>
							<li>Tile &amp; stone</li>
							<li>Carpet replacement</li>
							<li>Refinishing &amp; repairs</li>
						</ul>
					</div>
				</div>

				<div class="col-md-6 col-lg-4">
					<div class="oak-card p-4">
						<div class="oak-icon"><i class="fa fa-paint-brush" aria-hidden="true"></i></div>
						<h3 class="h4 fw-bold">Interior Painting</h3>
						<ul>
							<li>Walls, ceilings &amp; trim</li>
							<li>Cabinet painting &amp; refinishing</li>
							<li>Color consultations</li>
							<li>Accent walls</li>
							<li>Whole-home repaints</li>
						</ul>
					</div>
				</div>

				<div class="col-md-6 col-lg-4">
					<div class="oak-card p-4">
						<div class="oak-icon"><i class="fa fa-columns" aria-hidden="true"></i></div>
						<h3 class="h4 fw-bold">Trim &amp; Millwork</h3>
						<ul>
							<li>Crown molding</li>
							<li>Baseboards &amp; casing</li>
							<li>Wainscoting &amp; shiplap</li>
							<li>Interior doors</li>
							<li>Built-ins &amp; custom trim</li>
						</ul>
					</div>
				</div>

				<div class="col-md-6 col-lg-4">
					<div class="oak-card p-4">
						<div class="oak-icon"><i class="fa fa-square-o" aria-hidden="true"></i></div>
						<h3 class="h4 fw-bold">Drywall &amp; Repairs</h3>
						<ul>
							<li>Drywall installation</li>
							<li>Patches &amp; holes</li>
							<li>Ceiling repairs</li>
							<li>Texture matching</li>
							<li>Water damage repairs</li>
						</ul>
					</div>
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
						We believe in clear communication, dependable scheduling, and quality craftsmanship that transforms the spaces you live in every day.
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
						<a href="tel:6783839503" class="display-6 fw-bold text-white text-decoration-none">
							678-383-9503
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
