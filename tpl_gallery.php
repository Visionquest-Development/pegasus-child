<?php

/*
Template Name: Gallery Template
*/

get_header();

$header_choice = pegasus_get_option( 'header_select' );

// var_dump( $header_choice );
if ( 'header-three' === $header_choice ) {
	get_template_part( 'templates/additional_header' );
}
?>

<div id="page-wrap">
	<?php
	// Full container page options.
	$post_full_container_choice = get_post_meta( get_the_ID(), 'pegasus-page-container-checkbox', true );

	// Full container theme option.
	$global_full_container_option = pegasus_get_option( 'full_container_chk' );

	// Assign post class.
	$pegasus_post_container_choice = ( 'on' === $post_full_container_choice ) ? 'container-fluid' : 'container';

	// Assign global class.
	$pegasus_global_container_choice = ( 'on' === $global_full_container_option ) ? 'container-fluid' : 'container';

	// Check global first then post.
	$final_container_class = ( 'container-fluid' === $pegasus_global_container_choice ) ? $pegasus_global_container_choice : $pegasus_post_container_choice;

	// Left align right sidebar?
	$left_align_sidebar_chk = pegasus_get_option( 'sidebar_left_chk' ) ? pegasus_get_option( 'sidebar_left_chk' ) : 'off';

	// Enable both sidebars?
	$pegasus_left_sidebar_option = ( 'on' === pegasus_get_option( 'both_sidebar_chk' ) ) ? pegasus_get_option( 'both_sidebar_chk' ) : 'off';

	// Change content class if both sidebars.
	$page_body_content_class = ( 'on' === $pegasus_left_sidebar_option ) ? 'col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xg-6' : 'col-xs-12 col-sm-12 col-md-12 col-lg-9 col-xg-9';

	// Page header page options.
	$post_disable_page_header_choice = get_post_meta( get_the_ID(), 'pegasus-page-header-checkbox', true ) ? get_post_meta( get_the_ID(), 'pegasus-page-header-checkbox', true ) : 'off';

	// Page header theme option.
	$global_disable_page_header_option = pegasus_get_option( 'page_header_chk' ) ? pegasus_get_option( 'page_header_chk' ) : 'off';

	// Check theme option for page header before page option.
	$page_title = $post->post_title;
	$is_this_home = is_home();

	if ( 'on' === $global_disable_page_header_option ) {
		$final_page_header_option = 'on';
	} elseif ( 'on' === $post_disable_page_header_choice ) {
		$final_page_header_option = 'on';
	} else {
		$final_page_header_option = 'off';
	}

	if ( true === $is_this_home ) {
		$final_page_header_option = 'off';
	}
	?>
	<div class="<?php echo $final_container_class; ?>">
		<!-- Example row of columns -->
		<div class="">
			<div class="inner-content">
				<div class="content-no-sidebar">
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<?php if ( 'off' === $final_page_header_option ) { ?>
							<div class="page-header">
								<?php
								if ( '' === $page_title ) {
									echo '';
								} elseif ( $page_title ) {
									echo '<h1>';
									echo the_title();
									echo '</h1>';
								}
								?>
							</div>
						<?php } else { ?>
							<div class="page-header-spacer"></div>
						<?php } ?>

						<?php the_content(); ?>
					<?php endwhile; else : ?>
						<?php /* kinda a 404 of sorts when not working */ ?>
						<div class="page-header">
							<h1>Oh no!</h1>
						</div>
						<p>No content is appearing for this page!</p>
					<?php endif; ?>

					<?php
					if ( function_exists( 'wp_bootstrap_edit_post_link' ) ) {
						// Edit post link.
						wp_bootstrap_edit_post_link(
							sprintf(
								/* translators: %s: Name of current post */
								__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'pegasus' ),
								get_the_title()
							),
							'<span class="edit-link">',
							'</span>'
						);
					}

					if ( function_exists( 'wp_bootstrap_posts_pagination' ) ) {
						wp_bootstrap_posts_pagination( array(
							'prev_text'          => __( 'Previous page', 'pegasus' ),
							'next_text'          => __( 'Next page', 'pegasus' ),
							'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'pegasus' ) . ' </span>'
						) );
					}
					?>
				</div>
			</div><!--end inner content-->
		</div><!--end row -->
	</div><!-- end container -->


	<section class="container d-none py-5 gallery-cta-grid">
		<div class="row g-4">
			<div class="col-lg-4 col-md-6">
				<a class="gallery-cta-card" href="/services/interior-repairs/" style="background-image: url('https://34oakcontracting.com/wp-content/uploads/2024/07/images.jpeg');">
					<span class="gallery-cta-overlay"></span>
					<span class="gallery-cta-title">Interior</span>
				</a>
			</div>
			<div class="col-lg-4 col-md-6">
				<a class="gallery-cta-card" href="/services/exterior-repairs/" style="background-image: url('https://34oakcontracting.com/wp-content/uploads/2024/05/Copy-of-Copy-of-TOPHER-GALA-EXPERIMENT-1.png');">
					<span class="gallery-cta-overlay"></span>
					<span class="gallery-cta-title">Exterior</span>
				</a>
			</div>
			<div class="col-lg-4 col-md-6">
				<a class="gallery-cta-card" href="/services/make-ready-repairs/" style="background-image: url('https://34oakcontracting.com/wp-content/uploads/2024/05/BBB-Dynamic-Seal-4-2048x742.png');">
					<span class="gallery-cta-overlay"></span>
					<span class="gallery-cta-title">Make Ready</span>
				</a>
			</div>
		</div>
	</section>


	<?php $interior_img_path = get_stylesheet_directory_uri() . '/images/Interior'; ?>
		<section id="interior-section" class="service-feature-section py-5 oak-section-light">
			<div class="container">
				<div class="row g-4 align-items-center">
					<div class="col-lg-6 order-1 order-lg-1">
						<div class="make-ready-image" style="background-image: url('https://h4p.c69.myftpupload.com/wp-content/uploads/2023/02/56-300x200.webp');">
							<span class="make-ready-image-overlay"></span>
						</div>
					</div>
					<div class="col-lg-6 order-2 order-lg-2">
						<div class="make-ready-content">
							<div class="section-title">
								<h2>Interior <span></span></h2>
								<p>Refresh and reimagine living spaces with clean finishes, thoughtful upgrades, and quality repairs.</p>
							</div>
							<p>From fixtures and finishes to drywall, trim, and flooring, we bring craftsmanship that makes rooms feel new again.</p>
							<a class="btn btn-brand" href="/services/interior/">Explore Interior <i class="fa fa-arrow-right"></i></a>
						</div>
					</div>
				</div>

				<!-- Interior Service Cards -->
				<div class="row mt-5 mb-3">
					<div class="col-12">
						<div class="section-title">
							<h3>Our Interior Services <span></span></h3>
						</div>
					</div>
				</div>
				<div class="gallery-cta-grid">
					<div class="row g-4">
						<div class="col-lg-4 col-md-6">
							<a class="gallery-cta-card gallery-cta-card--sm" href="/services/interior/#kitchen-gallery" style="background-image: url('<?php echo $interior_img_path; ?>/kitchen/gallery-photos/kitchen-gallery-01.jpg');">
								<span class="gallery-cta-overlay"></span>
								<span class="gallery-cta-title">Kitchens</span>
							</a>
						</div>
						<div class="col-lg-4 col-md-6">
							<a class="gallery-cta-card gallery-cta-card--sm" href="/services/interior/#bathroom-gallery" style="background-image: url('<?php echo $interior_img_path; ?>/bathroom/gallery-photos/bathroom-gallery-01.jpg');">
								<span class="gallery-cta-overlay"></span>
								<span class="gallery-cta-title">Bathrooms</span>
							</a>
						</div>
						<div class="col-lg-4 col-md-6">
							<a class="gallery-cta-card gallery-cta-card--sm" href="/services/interior/#general-interior-gallery" style="background-image: url('<?php echo $interior_img_path; ?>/general-interior/built-ins/built-ins-01.jpg');">
								<span class="gallery-cta-overlay"></span>
								<span class="gallery-cta-title">Built-Ins & Cabinetry</span>
							</a>
						</div>
					</div>
				</div>

				<!-- Interior Featured Projects -->
				<div class="row mt-5 mb-3">
					<div class="col-12">
						<div class="section-title">
							<h3>Featured Projects <span></span></h3>
						</div>
					</div>
				</div>
				<div class="gallery-cta-grid">
					<div class="row g-4">
						<div class="col-lg-3 col-md-6">
							<a class="gallery-cta-card gallery-cta-card--sm" href="/services/interior/#canton-kitchen-upstairs" style="background-image: url('<?php echo $interior_img_path; ?>/kitchen/gallery-photos/kitchen-gallery-05.jpg');">
								<span class="gallery-cta-overlay"></span>
								<span class="gallery-cta-title">Canton Kitchen</span>
							</a>
						</div>
						<div class="col-lg-3 col-md-6">
							<a class="gallery-cta-card gallery-cta-card--sm" href="/services/interior/#woodstock-kitchen" style="background-image: url('<?php echo $interior_img_path; ?>/kitchen/gallery-photos/kitchen-gallery-10.jpg');">
								<span class="gallery-cta-overlay"></span>
								<span class="gallery-cta-title">Woodstock Kitchen</span>
							</a>
						</div>
						<div class="col-lg-3 col-md-6">
							<a class="gallery-cta-card gallery-cta-card--sm" href="/services/interior/#roswell-master-bath" style="background-image: url('<?php echo $interior_img_path; ?>/bathroom/gallery-photos/bathroom-gallery-05.jpg');">
								<span class="gallery-cta-overlay"></span>
								<span class="gallery-cta-title">Roswell Master Bath</span>
							</a>
						</div>
						<div class="col-lg-3 col-md-6">
							<a class="gallery-cta-card gallery-cta-card--sm" href="/services/interior/#general-interior-gallery" style="background-image: url('<?php echo $interior_img_path; ?>/general-interior/basement-after-woodstock.jpg');">
								<span class="gallery-cta-overlay"></span>
								<span class="gallery-cta-title">Basement Finish</span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</section>

		<?php $exterior_img_path = get_stylesheet_directory_uri() . '/images/Exterior'; ?>
		<section id="exterior-section" class="service-feature-section py-5 oak-section-accent">
			<div class="container">
				<div class="row g-4 align-items-center">
					<div class="col-lg-6 order-1 order-lg-2">
						<div class="make-ready-image" style="background-image: url('https://h4p.c69.myftpupload.com/wp-content/uploads/2023/02/9u9u9u.webp');">
							<span class="make-ready-image-overlay"></span>
						</div>
					</div>
					<div class="col-lg-6 order-2 order-lg-1">
						<div class="make-ready-content">
							<div class="section-title">
								<h2>Exterior <span></span></h2>
								<p>Transform your property with exterior renovations that boost curb appeal and protect your investment.</p>
							</div>
							<p>We handle siding, roofing, decks, fencing, and outdoor living upgrades with craftsmanship that stands up to the elements.</p>
							<a class="btn btn-brand" href="/services/exterior/">Explore Exterior <i class="fa fa-arrow-right"></i></a>
						</div>
					</div>
				</div>

				<!-- Exterior Service Cards -->
				<div class="row mt-5 mb-3">
					<div class="col-12">
						<div class="section-title">
							<h3>Our Exterior Services <span></span></h3>
						</div>
					</div>
				</div>
				<div class="gallery-cta-grid">
					<div class="row g-4">
						<div class="col-lg-4 col-md-6">
							<a class="gallery-cta-card gallery-cta-card--sm" href="/services/exterior/#roswell-siding-windows" style="background-image: url('<?php echo $exterior_img_path; ?>/gallery-photos/home-side-siding-fence.jpg');">
								<span class="gallery-cta-overlay"></span>
								<span class="gallery-cta-title">Siding & Windows</span>
							</a>
						</div>
						<div class="col-lg-4 col-md-6">
							<a class="gallery-cta-card gallery-cta-card--sm" href="/services/exterior/#marietta-roof-siding" style="background-image: url('<?php echo $exterior_img_path; ?>/gallery-photos/traditional-home-front-double-garage.jpg');">
								<span class="gallery-cta-overlay"></span>
								<span class="gallery-cta-title">Roofing & Gutters</span>
							</a>
						</div>
						<div class="col-lg-4 col-md-6">
							<a class="gallery-cta-card gallery-cta-card--sm" href="/services/exterior/#smyrna-porch" style="background-image: url('<?php echo $exterior_img_path; ?>/gallery-photos/screened-porch-sectional-sofa.jpg');">
								<span class="gallery-cta-overlay"></span>
								<span class="gallery-cta-title">Decks & Porches</span>
							</a>
						</div>
					</div>
				</div>

				<!-- Exterior Featured Projects -->
				<div class="row mt-5 mb-3">
					<div class="col-12">
						<div class="section-title">
							<h3>Featured Projects <span></span></h3>
						</div>
					</div>
				</div>
				<div class="gallery-cta-grid">
					<div class="row g-4">
						<div class="col-lg-3 col-md-6">
							<a class="gallery-cta-card gallery-cta-card--sm" href="/services/exterior/#blue-ridge" style="background-image: url('<?php echo $exterior_img_path; ?>/gallery-photos/cabin-multi-level-deck-twilight.jpg');">
								<span class="gallery-cta-overlay"></span>
								<span class="gallery-cta-title">Blue Ridge Cabin</span>
							</a>
						</div>
						<div class="col-lg-3 col-md-6">
							<a class="gallery-cta-card gallery-cta-card--sm" href="/services/exterior/#roswell-siding-gazebo" style="background-image: url('<?php echo $exterior_img_path; ?>/gallery-photos/green-siding-home-portico-entrance.jpg');">
								<span class="gallery-cta-overlay"></span>
								<span class="gallery-cta-title">Roswell Siding & Gazebo</span>
							</a>
						</div>
						<div class="col-lg-3 col-md-6">
							<a class="gallery-cta-card gallery-cta-card--sm" href="/services/exterior/#smyrna-porch" style="background-image: url('<?php echo $exterior_img_path; ?>/gallery-photos/covered-porch-stone-veneer-flag.jpg');">
								<span class="gallery-cta-overlay"></span>
								<span class="gallery-cta-title">Smyrna Porch & Sunroom</span>
							</a>
						</div>
						<div class="col-lg-3 col-md-6">
							<a class="gallery-cta-card gallery-cta-card--sm" href="/services/exterior/#woodstock-outdoor-living" style="background-image: url('<?php echo $exterior_img_path; ?>/gallery-photos/covered-patio-outdoor-furniture.jpg');">
								<span class="gallery-cta-overlay"></span>
								<span class="gallery-cta-title">Woodstock Outdoor Living</span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</section>

		<?php $mr_img_path = get_stylesheet_directory_uri() . '/images/make-ready'; ?>
		<section id="make-ready-section" class="make-ready-feature-section service-feature-section py-5 oak-section-light">
			<div class="container">
				<div class="row g-4 align-items-center">
					<div class="col-lg-6 order-1 order-lg-1">
						<div class="make-ready-image" style="background-image: url('https://h4p.c69.myftpupload.com/wp-content/uploads/2023/02/pexels-marianne-238377-500x295.jpg');">
							<span class="make-ready-image-overlay"></span>
						</div>
					</div>
					<div class="col-lg-6 order-2 order-lg-2">
						<div class="make-ready-content">
							<div class="section-title">
								<h2>Make Ready Repairs <span></span></h2>
								<p>Our bread-and-butter service for property managers, investors, and homeowners who need fast, dependable turnarounds.</p>
							</div>
							<p>We handle punch lists, minor repairs, paint touch-ups, flooring fixes, hardware replacements, and curb appeal upgrades so a property is ready to show, rent, or sell without delays.</p>
							<p>From the first walkthrough to final clean-up, we keep the process organized and transparent, deliver clear scopes, and hit timelines that keep your projects moving.</p>
							<a class="btn btn-brand" href="/services/make-ready/">Explore Make Ready <i class="fa fa-arrow-right"></i></a>
						</div>
					</div>
				</div>

				<!-- Make Ready Featured Projects -->
				<div class="row mt-5 mb-3">
					<div class="col-12">
						<div class="section-title">
							<h3>Featured Projects <span></span></h3>
						</div>
					</div>
				</div>
				<div class="gallery-cta-grid">
					<div class="row g-4">
						<div class="col-lg-4 col-md-6">
							<a class="gallery-cta-card gallery-cta-card--sm" href="/services/make-ready/#silverchase-make-ready" style="background-image: url('<?php echo $mr_img_path; ?>/silverchase-aaron-alona/after/after-018.jpg');">
								<span class="gallery-cta-overlay"></span>
								<span class="gallery-cta-title">Silverchase</span>
							</a>
						</div>
						<div class="col-lg-4 col-md-6">
							<a class="gallery-cta-card gallery-cta-card--sm" href="/services/make-ready/#greg-michell-make-ready" style="background-image: url('<?php echo $mr_img_path; ?>/greg-michell/after/after-18.jpg');">
								<span class="gallery-cta-overlay"></span>
								<span class="gallery-cta-title">Roswell</span>
							</a>
						</div>
						<div class="col-lg-4 col-md-6">
							<a class="gallery-cta-card gallery-cta-card--sm" href="/services/make-ready/#woodstock-make-ready" style="background-image: url('<?php echo $mr_img_path; ?>/woodstock-jc-jennifer/after/after-18.jpg');">
								<span class="gallery-cta-overlay"></span>
								<span class="gallery-cta-title">Woodstock</span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section id="commercial-section" class="service-feature-section py-5 oak-section-accent">
			<div class="container">
				<div class="row g-4 align-items-center">
					<div class="col-lg-6 order-1 order-lg-2">
						<div class="make-ready-image" style="background-image: url('https://h4p.c69.myftpupload.com/wp-content/uploads/2023/02/9u9u9u.webp');">
							<span class="make-ready-image-overlay"></span>
						</div>
					</div>
					<div class="col-lg-6 order-2 order-lg-1">
						<div class="make-ready-content">
							<div class="section-title">
								<h2>Commercial <span></span></h2>
								<p>Keep your business spaces sharp with efficient repairs and renovations that minimize downtime.</p>
							</div>
							<p>We coordinate scopes, schedules, and execution so your property stays tenant-ready and on brand.</p>
							<a class="btn btn-brand" href="/services/commercial/">Explore Commercial <i class="fa fa-arrow-right"></i></a>
						</div>
					</div>
				</div>
			</div>
		</section>


</div><!-- end page wrap -->

<?php get_footer(); ?>
