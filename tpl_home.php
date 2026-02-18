<?php
/*
	Template Name: Home Template
*/
?>
	<?php get_header(); ?>

	<?php
		$header_choice = pegasus_get_option( 'header_select' );
		//var_dump($header_choice);
		if ( 'header-three' === $header_choice ) {
			get_template_part( 'templates/additional_header' );
		}
	?>

	<div id="page-wrap">

		<?php
			//full container page options
			$post_full_container_choice = get_post_meta( get_the_ID(), 'pegasus-page-container-checkbox', true );
			//full container theme option
			$global_full_container_option = pegasus_get_option('full_container_chk' );

			//assign post class
			$pegasus_post_container_choice = ( 'on' === $post_full_container_choice ) ? 'container-fluid' : 'container';
			//assign global class
			$pegasus_global_container_choice = ( 'on' === $global_full_container_option ) ? 'container-fluid' : 'container' ;
			//check global first then post
			$final_container_class = ( 'container-fluid' === $pegasus_global_container_choice ) ? $pegasus_global_container_choice : $pegasus_post_container_choice;

			//left align right sidebar?
			$left_align_sidebar_chk =  pegasus_get_option( 'sidebar_left_chk' ) ? pegasus_get_option( 'sidebar_left_chk' ) : 'off';
			//enable both sidebars?
			$pegasus_left_sidebar_option = ( 'on' === pegasus_get_option( 'both_sidebar_chk' ) ) ? pegasus_get_option( 'both_sidebar_chk' ) : 'off';
			//change content class if both sidebars
			$page_body_content_class = ( 'on' === $pegasus_left_sidebar_option  ) ? 'col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xg-6' : 'col-xs-12 col-sm-12 col-md-12 col-lg-9 col-xg-9';

			//page header page options
			$post_disable_page_header_choice = get_post_meta( get_the_ID(), 'pegasus-page-header-checkbox', true ) ? get_post_meta( get_the_ID(), 'pegasus-page-header-checkbox', true ) : 'off';
			//page header theme option
			$global_disable_page_header_option =  pegasus_get_option('page_header_chk' ) ? pegasus_get_option('page_header_chk' ) : 'off';
			//check theme option for page header before page option
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

				<div class="">
					<div class="content-no-sidebar">
						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
							<?php if( 'off' === $final_page_header_option ) { ?>
								<div class="page-header">
									<?php
									if( '' === $page_title ) {
										echo '';
									} elseif ( $page_title ) {
										echo '<h1>';
										echo the_title();
										echo '</h1>';
									}
									?>
								</div>
							<?php }else{ ?>
								<div class="page-header-spacer d-none"></div>
							<?php } ?>

							<?php the_content(); ?>

						<?php endwhile; else: ?>
							<?php /* kinda a 404 of sorts when not working */ ?>
							<div class="page-header">
								<h1>Oh no!</h1>
							</div>
							<p>No content is appearing for this page!</p>
						<?php endif; ?>
						<?php
							if ( function_exists( 'wp_bootstrap_edit_post_link' ) ) {
								// Edit post link
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
		<section id="home-slider" class="section-padding container d-none home-slider p-5">
		<?php
		echo do_shortcode(
			'[thumb_slider]
				[thumb_slide title="slide1" number="1"]
					<img src="http://slippry.com/assets/img/image-1.jpg" alt="This is caption 1">
				[/thumb_slide]
				[thumb_slide title="slide2" number="2"]
					<img src="http://slippry.com/assets/img/image-2.jpg" alt="This is caption 2">
				[/thumb_slide]
				[thumb_slide title="slide3" number="3"]
					<img src="http://slippry.com/assets/img/image-3.jpg" alt="This is caption 3">
				[/thumb_slide]
				[thumb_slide title="slide4" number="4"]
					<img src="http://slippry.com/assets/img/image-4.jpg" alt="This is caption 4">
				[/thumb_slide]
			[/thumb_slider]'
		);
		?>
		</section>

		<section id="our-service" class="section-padding  home-service service-section py-5 oak-section-light">
			<div class="container">
				<div class="row mb-4">
					<div class="col-lg-8 col-md-10 col-12">
						<div class="section-title">
							<h2>Our Services<span></span></h2>
							<p>We provide top-notch services to meet your needs.</p>
						</div>
					</div>
				</div>

				<div class="row g-4" id="service-contents">

					<div class="col-lg-3 col-md-3">
						<a class="service-card-link" href="/gallery/#interior-section">
							<div class="service-card card h-100">
								<img src="https://h4p.c69.myftpupload.com/wp-content/uploads/2023/02/56-300x200.webp" class="card-img-top" alt="Interior" title="Interior">
								<div class="card-body">
									<div class="service-icon">
										<i class="fa fa-wrench"></i>
									</div>
									<h3 class="card-title">Interior</h3>
									<p class="card-text">Update fixtures and finishes, redesign rooms, and create a more comfortable and attractive living area that reflects your personal style.</p>
									<span class="btn btn-brand btn-sm">Learn More <i class="fa fa-arrow-right"></i></span>
								</div>
							</div>
						</a>
					</div>

					<div class="col-lg-3 col-md-3">
						<a class="service-card-link" href="/gallery/#exterior-section">
							<div class="service-card card h-100">
								<img src="https://h4p.c69.myftpupload.com/wp-content/uploads/2023/02/9u9u9u.webp" class="card-img-top" alt="Exterior" title="Exterior">
								<div class="card-body">
									<div class="service-icon">
										<i class="fa fa-shield"></i>
									</div>
									<h3 class="card-title">Exterior</h3>
									<p class="card-text">Transform your property with exterior renovations. Increase its value and curb appeal with updated siding, roofing, landscaping, and outdoor living areas.</p>
									<span class="btn btn-brand btn-sm">Learn More <i class="fa fa-arrow-right"></i></span>
								</div>
							</div>
						</a>
					</div>

					<div class="col-lg-3 col-md-3">
						<a class="service-card-link" href="/gallery/#make-ready-section">
							<div class="service-card card h-100">
								<img src="https://h4p.c69.myftpupload.com/wp-content/uploads/2023/02/pexels-marianne-238377-500x295.jpg" class="card-img-top" alt="Make Ready" title="Make Ready">
								<div class="card-body">
									<div class="service-icon">
										<i class="fa fa-home"></i>
									</div>
									<h3 class="card-title">Make Ready Repairs</h3>
									<p class="card-text">From walkways and patios to water features and retaining walls, add texture and interest to your yard or garden with endless design possibilities.</p>
									<span class="btn btn-brand btn-sm">Learn More <i class="fa fa-arrow-right"></i></span>
								</div>
							</div>
						</a>
					</div>
					<div class="col-lg-3 col-md-3">
						<a class="service-card-link" href="/gallery/#commercial-section">
							<div class="service-card card h-100">
								<img src="https://h4p.c69.myftpupload.com/wp-content/uploads/2023/02/9u9u9u.webp" class="card-img-top" alt="Commercial" title="Commercial">
								<div class="card-body">
									<div class="service-icon">
										<i class="fa fa-building"></i>
									</div>
									<h3 class="card-title">Commercial</h3>
									<p class="card-text">Keep your commercial property looking sharp with efficient repairs, tenant make-readies, and renovations that minimize downtime.</p>
									<span class="btn btn-brand btn-sm">Learn More <i class="fa fa-arrow-right"></i></span>
								</div>
							</div>
						</a>
					</div>
				</div>
			</div>

		</section>


		<section id="ourfeatures" class="section-padding home-feature py-5 oak-section-light position-relative">
			<div class="container">
				<div class="row mb-4">
					<div class="col-lg-8 col-md-10 col-12">
						<div class="section-title">
							<h2>Why Choose Us <span></span></h2>
							<p>Here are just a few reasons we feel we could be right for the job.</p>
						</div>
					</div>
				</div>
				<div id="feature-content" class="row g-4">
					<div class="col-lg-4 col-md-6">
						<div class="feature-card">
							<div class="feature-icon"><i class="fa fa-star"></i></div>
							<div>
								<h3>Accredited</h3>
								<p>We're licensed, bonded and insured.</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6">
						<div class="feature-card">
							<div class="feature-icon"><i class="fa fa-clock-o"></i></div>
							<div>
								<h3>Experience</h3>
								<p>We have 12+ years of experience.</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6">
						<div class="feature-card">
							<div class="feature-icon"><i class="fa fa-check-square-o"></i></div>
							<div>
								<h3>Warranties</h3>
								<p>All Workmanship Warranties are fully transferrable.</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6">
						<div class="feature-card">
							<div class="feature-icon"><i class="fa fa-location-arrow"></i></div>
							<div>
								<h3>We're Local</h3>
								<p>We live and work in Greater Atlanta. We're part of the community.</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6">
						<div class="feature-card">
							<div class="feature-icon"><i class="fa fa-balance-scale"></i></div>
							<div>
								<h3>Free Estimates</h3>
								<p>Providing free inspections and consultations.</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6">
						<div class="feature-card">
							<div class="feature-icon"><i class="fa fa-child"></i></div>
							<div>
								<h3>Communication</h3>
								<p>Single contact to cover all your construction needs.</p>
							</div>
						</div>
					</div>
				</div>
			</div>

		</section>

		<section id="cta" class="section-padding oak-section-dark oak-cta" style="background-image:url('https://34oakcontracting.com/wp-content/plugins/clever-fox/inc/conceptly/images/bg/cta-bg.jpg');background-attachment:scroll;">
			<div class="container">
				<div class="row cta">
					<div id="cta-header" class="col-lg-9 col-md-12 col-12 text-lg-left text-center mb-lg-0 mb-4">
											<h3>Get a Free Consultation!</h3>

											<p>Get in touch with us and send some basic info for a quick quote.</p>

					</div>
					<div id="cta-btn" class="col-lg-3 col-md-12 col-12 text-lg-right text-center">
						<a href="https://34oakcontracting.com/contact/" class="boxed-btn purchase-btn"><i class="fa fa-star"></i>Get Your Free Quote!</a>
					</div>
				</div>
			</div>
		</section>

		<section id="our-partners" class="partners-section oak-section-dark">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="partner-grid">
							<div class="single-partner">
								<div class="inner-partner">
									<a class="partner-link" href="https://csmithrealty.kw.com/" aria-label="C-Smith Realty">
										<div class="partner-logo" style="background-image:url('https://34oakcontracting.com/wp-content/uploads/2026/01/C-Smith-Realty_LOGO-G6-scaled.png');"></div>
									</a>
								</div>
							</div>
							<div class="single-partner">
								<div class="inner-partner">
									<a class="partner-link" href="#" aria-label="Beacon">
										<div class="partner-logo" style="background-image:url('https://h4p.c69.myftpupload.com/wp-content/uploads/2023/02/beacon-500x500.png');"></div>
									</a>
								</div>
							</div>
							<div class="single-partner">
								<div class="inner-partner">
									<a class="partner-link" href="#" aria-label="Sherwin-Williams">
										<div class="partner-logo" style="background-image:url('https://h4p.c69.myftpupload.com/wp-content/uploads/2023/02/Sherwin-Williams-logo-500x281.png');"></div>
									</a>
								</div>
							</div>
							<div class="single-partner">
								<div class="inner-partner">
									<a class="partner-link" href="#" aria-label="ELD">
										<div class="partner-logo" style="background-image:url('https://h4p.c69.myftpupload.com/wp-content/uploads/2023/02/eld_logo_white-300x70.png');"></div>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

	</div><!-- end page wrap -->
    <?php get_footer(); ?>
