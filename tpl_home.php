<?php
/*
	Template Name: Home Template
*/
?>
	<?php get_header(); ?>

	<?php
		$header_choice = pegasus_get_option( 'header_select' );
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

		<?php
		$service_cards = get_post_meta( get_the_ID(), 'rhr_homepage_cards_group', true );
		if ( ! is_array( $service_cards ) ) {
			$service_cards = [];
		}
		?>

		<section id="our-service" class="section-padding  home-service service-section py-5 rhr-section-light">
			<div class="container">
				<div class="row mb-4">
					<div class="col-lg-8 col-md-10 col-12">
						<div class="section-title">
							<h2>Our Services<span></span></h2>
							<p>Professional renovation services tailored to transform your space.</p>
						</div>
					</div>
				</div>

				<div class="row g-4" id="service-contents">
					<?php if ( ! empty( $service_cards ) ) : ?>
						<?php foreach ( $service_cards as $card ) :
							$card_title = isset( $card['title'] ) ? $card['title'] : '';
							$card_description = isset( $card['description'] ) ? $card['description'] : '';
							$card_link = isset( $card['link'] ) ? $card['link'] : '';
							$card_icon = isset( $card['icon_class'] ) ? $card['icon_class'] : '';
							$card_button = isset( $card['button_text'] ) && $card['button_text'] !== '' ? $card['button_text'] : 'Learn More';
							$card_image = isset( $card['image'] ) ? $card['image'] : '';
							$card_alt = isset( $card['image_alt'] ) ? $card['image_alt'] : $card_title;
						?>
							<div class="col-lg-3 col-md-6">
								<a class="service-card-link" href="<?php echo esc_url( $card_link ); ?>">
									<div class="service-card card h-100">
										<?php if ( $card_image ) : ?>
											<img src="<?php echo esc_url( $card_image ); ?>" class="card-img-top" alt="<?php echo esc_attr( $card_alt ); ?>" title="<?php echo esc_attr( $card_alt ); ?>">
										<?php endif; ?>
										<div class="card-body">
											<?php if ( $card_icon ) : ?>
												<div class="service-icon">
													<i class="<?php echo esc_attr( $card_icon ); ?>"></i>
												</div>
											<?php endif; ?>
											<?php if ( $card_title ) : ?>
												<h3 class="card-title"><?php echo esc_html( $card_title ); ?></h3>
											<?php endif; ?>
											<?php if ( $card_description ) : ?>
												<p class="card-text"><?php echo esc_html( $card_description ); ?></p>
											<?php endif; ?>
											<span class="btn btn-brand btn-sm">
												<?php echo esc_html( $card_button ); ?> <i class="fa fa-arrow-right"></i>
											</span>
										</div>
									</div>
								</a>
							</div>
						<?php endforeach; ?>
					<?php else: ?>
						<!-- Default service cards if no custom fields set -->
						<div class="col-lg-3 col-md-6">
							<a class="service-card-link" href="#services">
								<div class="service-card card h-100">
									<div class="card-body">
										<div class="service-icon">
											<i class="fa fa-kitchen-set"></i>
										</div>
										<h3 class="card-title">Kitchen Remodeling</h3>
										<p class="card-text">Transform your kitchen with custom cabinetry and modern finishes.</p>
										<span class="btn btn-brand btn-sm">
											Learn More <i class="fa fa-arrow-right"></i>
										</span>
									</div>
								</div>
							</a>
						</div>
						<div class="col-lg-3 col-md-6">
							<a class="service-card-link" href="#services">
								<div class="service-card card h-100">
									<div class="card-body">
										<div class="service-icon">
											<i class="fa fa-bath"></i>
										</div>
										<h3 class="card-title">Bathroom Renovation</h3>
										<p class="card-text">Create your personal spa retreat with elegant fixtures and tile work.</p>
										<span class="btn btn-brand btn-sm">
											Learn More <i class="fa fa-arrow-right"></i>
										</span>
									</div>
								</div>
							</a>
						</div>
						<div class="col-lg-3 col-md-6">
							<a class="service-card-link" href="#services">
								<div class="service-card card h-100">
									<div class="card-body">
										<div class="service-icon">
											<i class="fa fa-home"></i>
										</div>
										<h3 class="card-title">Whole Home Remodels</h3>
										<p class="card-text">Complete home transformations that reflect your lifestyle.</p>
										<span class="btn btn-brand btn-sm">
											Learn More <i class="fa fa-arrow-right"></i>
										</span>
									</div>
								</div>
							</a>
						</div>
						<div class="col-lg-3 col-md-6">
							<a class="service-card-link" href="#services">
								<div class="service-card card h-100">
									<div class="card-body">
										<div class="service-icon">
											<i class="fa fa-hammer"></i>
										</div>
										<h3 class="card-title">Custom Carpentry</h3>
										<p class="card-text">Expertly crafted built-ins, trim work, and custom millwork.</p>
										<span class="btn btn-brand btn-sm">
											Learn More <i class="fa fa-arrow-right"></i>
										</span>
									</div>
								</div>
							</a>
						</div>
					<?php endif; ?>
				</div>
			</div>

		</section>

		<section id="ourfeatures" class="section-padding home-feature py-5 rhr-section-light position-relative">
			<div class="container">
				<div class="row mb-4">
					<div class="col-lg-8 col-md-10 col-12">
						<div class="section-title">
							<h2>Why Choose Us <span></span></h2>
							<p>Quality craftsmanship and reliable service you can trust.</p>
						</div>
					</div>
				</div>
				<div id="feature-content" class="row g-4">
					<div class="col-lg-4 col-md-6">
						<div class="feature-card">
							<div class="feature-icon"><i class="fa fa-star"></i></div>
							<div>
								<h3>Licensed & Insured</h3>
								<p>Fully licensed, bonded and insured for your protection.</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6">
						<div class="feature-card">
							<div class="feature-icon"><i class="fa fa-clock-o"></i></div>
							<div>
								<h3>Experienced Team</h3>
								<p>Over 15 years of professional renovation experience.</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6">
						<div class="feature-card">
							<div class="feature-icon"><i class="fa fa-check-square-o"></i></div>
							<div>
								<h3>Quality Guarantee</h3>
								<p>Comprehensive warranties on all workmanship.</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6">
						<div class="feature-card">
							<div class="feature-icon"><i class="fa fa-location-arrow"></i></div>
							<div>
								<h3>Local Service</h3>
								<p>Proudly serving our local community.</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6">
						<div class="feature-card">
							<div class="feature-icon"><i class="fa fa-balance-scale"></i></div>
							<div>
								<h3>Free Estimates</h3>
								<p>Complimentary consultations and project estimates.</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6">
						<div class="feature-card">
							<div class="feature-icon"><i class="fa fa-comments-o"></i></div>
							<div>
								<h3>Clear Communication</h3>
								<p>Transparent updates throughout your project.</p>
							</div>
						</div>
					</div>
				</div>
			</div>

		</section>

		<section id="cta" class="section-padding rhr-section-dark rhr-cta" >
			<div class="container">
				<div class="row cta">
					<div id="cta-header" class="col-lg-9 col-md-12 col-12 text-lg-left text-center mb-lg-0 mb-4">
						<h3>Ready to Transform Your Space?</h3>
						<p>Get in touch with us today for a free consultation and estimate.</p>
					</div>
					<div id="cta-btn" class="col-lg-3 col-md-12 col-12 text-lg-right text-center">
						<a href="/contact/" class="boxed-btn purchase-btn"><i class="fa fa-phone"></i>Get Your Free Quote!</a>
					</div>
				</div>
			</div>
		</section>

	</div><!-- end page wrap -->
    <?php get_footer(); ?>
