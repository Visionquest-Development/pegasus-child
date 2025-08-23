
<?php /* Template Name: Contact Template */ ?>
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
	<?php get_header(); ?>
	<div id="">

		<div class="container-fluid home-opp-content ">
			<div class="content-no-sidebar row">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<?php the_content(); ?>
				<?php endwhile; else: ?>
					<?php /* kinda a 404 of sorts when not working */ ?>
					<div class="page-header">
						<h1>Oh no!</h1>
					</div>
					<p>No content is appearing for this page!</p>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<div class=" contact-section mb-3">
		<div class="row g-0 text-center">
			<!-- Address Section -->
			<div class="col-md-3 ">
				<div class="card  h-100">
					<div class="card-body">
						<i class="fa fa-map-marker fa-2x text-primary mb-3"></i>
						<h5 class="card-title">Address</h5>
						<p class="card-text">
							4508 Canton Road, Marietta,<br>
							GA 30066
						</p>
					</div>
				</div>
			</div>

			<!-- Phone and Email Section -->
			<div class="col-md-3 ">
				<div class="card h-100">
					<div class="card-body">
						<i class="fa fa-phone fa-2x text-primary mb-3"></i>
						<h5 class="card-title">Phone</h5>
						<p class="card-text"><a href="tel:678-361-7623">678-361-7623</a></p>
						<i class="fa fa-envelope fa-2x text-primary mb-3"></i>
						<h5 class="card-title">Email</h5>
						<p class="card-text">
							<a href="mailto:helpanimals@ourpalsplace.org" class="text-primary">helpanimals@ourpalsplace.org</a>
						</p>
					</div>
				</div>
			</div>

			<!-- Learning Center Section -->
			<div class="col-md-3 ">
				<div class="card  h-100">
					<div class="card-body">
						<h5 class="card-title">Learning Center</h5>
						<p class="card-text">
							Education programs are scheduled through our Director of Education, Kendra McCool:
						</p>
						<p class="card-text">
							<a href="mailto:kendra.mccool@ourpalsplace.org" class="text-primary">kendra.mccool@ourpalsplace.org</a>
						</p>
					</div>
				</div>
			</div>

			<!-- Executive Director and Director of Finance Section -->
			<div class="col-md-3 ">
				<div class="card  h-100">
					<div class="card-body">
						<h5 class="card-title">Executive Director</h5>
						<p class="card-text">
							Gigi Graves<br>
							<a href="mailto:gigi.graves@ourpalsplace.org" class="text-primary">gigi.graves@ourpalsplace.org</a><br>
							(678) 361-7623
						</p>
						<h5 class="card-title mt-4">Director of Finance</h5>
						<p class="card-text">
							Jeff McCrory<br>
							<a href="mailto:jeffrey.mccrory@ourpalsplace.org" class="text-primary">jeffrey.mccrory@ourpalsplace.org</a>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- end page wrap -->
    <?php get_footer(); ?>
