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

		<div class="container-fluid my-5 home-locations" >
			<h2 class="text-white text-center pb-3">Locations</h2>
			<div class="row g-3">

				<!-- UPTOWN COLUMBUS -->
				<div class="col-lg-6">
					<div class="mabellas-location-card text-center h-100 p-3 text-white wow fadeInLeft">

						<div class="mabellas-location-image"
							 style="background-image:url('https://visionquestdev.com/mabellas/wp-content/uploads/2025/12/INYtFcBSnyge5MW6Z7bQ_Mabellas-62.png');">
						</div>

						<h2>UPTOWN COLUMBUS</h2>

						<a href="/locations/uptown-columbus" class="mabellas-location-btn">VISIT US</a>
						<a href="/menu/uptown-columbus" class="mabellas-location-btn">VIEW MENU</a>
					</div>
				</div>

				<!-- MIDLAND -->
				<div class="col-lg-6">
					<div class="mabellas-location-card text-center h-100 p-3 text-white wow fadeInRight">

						<div class="mabellas-location-image"
							 style="background-image:url('https://visionquestdev.com/mabellas/wp-content/uploads/2025/12/EkmDKBDTRaC41Pg7v0uw_Mabellas-17.png');">
						</div>

						<h2>MIDLAND</h2>

						<a href="/locations/midland" class="mabellas-location-btn">VISIT US</a>
						<a href="/menus/midland" class="mabellas-location-btn">VIEW MENU</a>
					</div>
				</div>

			</div>
		</div>

		<!-- Special Events Section -->
		<section id="special-events" class="section-padding py-5 mabellas-section-light">
			<div class="container">
				<div class="row align-items-center g-4">
					<div class="col-lg-6 order-2 order-lg-1">
						<h2>Special Events</h2>
						<h3 class="mb-3">Immortal Estate Wine Dinner at Mabella Midland</h3>
						<p class="mb-2"><strong>Date:</strong> March 25th, 2026</p>
						<p class="mb-2"><strong>Time:</strong> 6:30pm</p>
						<p class="mb-2"><strong>Where:</strong> Mabella Midland (6835 Midland Commons Blvd, Columbus, GA)</p>
						<p class="mb-4"><strong>Tickets:</strong> $125 per person, tax &amp; gratuity included</p>

						<p class="mb-3">
							Rooted in Stone, Bound by Time: Dinner So Good It&apos;s Immortal
						</p>
						<p class="mb-3">
							Join us at Mabella Midland for one night that will be etched in immortality.
							Experience a menu carefully crafted by our Chef and paired with wines from Immortal Estate.
							Tickets are $125 per person.
						</p>
						<p class="mb-3">
							The wine dinner is only for patrons aged 21 or older.
							This event will be held only at our Mabella Midland location: 6835 Midland Commons Blvd, Columbus, GA.
						</p>
						<p class="mb-0">We look forward to sharing an immortal dinner with you.</p>
					</div>
					<div class="col-lg-6 order-1 order-lg-2">
						<img
							src="http://mabellas.com/wp-content/uploads/2026/02/Immortal_Dinner.png"
							alt="Immortal Estate Wine Dinner at Mabella Midland"
							class="img-fluid w-100"
						>
					</div>
				</div>
			</div>
		</section>

		<hr>

		<main id="primary" class="site-main mabellas-home">
			<h2 class="text-white text-center pb-2 px-3">The "Talk" of the Town</h2>
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
					// Get all homepage sections from CMB2 group.
					$sections = get_post_meta( get_the_ID(), 'homepage_sections_repeatable_group', true );
					?>

					<?php if ( ! empty( $sections ) && is_array( $sections ) ) : ?>

						<?php
						$index = 0;

						foreach ( $sections as $section ) :

							// Safely pull values out of the section array.
							$bg_value   = isset( $section['background_image'] ) ? $section['background_image'] : '';
							$image_url  = function_exists( 'mabellas_get_cmb2_image_url' ) ? mabellas_get_cmb2_image_url( $bg_value ) : '';

							$title      = isset( $section['title'] ) ? $section['title'] : '';
							$subtitle   = isset( $section['subtitle'] ) ? $section['subtitle'] : '';
							$paragraph  = isset( $section['paragraph'] ) ? $section['paragraph'] : '';
							$btn_text   = isset( $section['button1_text'] ) ? $section['button1_text'] : '';
							$btn_link   = isset( $section['button1_link'] ) ? $section['button1_link'] : '';

							$is_even    = ( $index % 2 === 0 ); // even index = text left, image right
							?>

							<section class="mabellas-home-section mt-3 pb-3">
								<div class="container-fluid">
									<div class="row g-4 align-items-stretch">

										<?php if ( $is_even ) : ?>

											<!-- Text left / Image right -->
											<div class="col-lg-4 d-flex">
												<div class="mabellas-home-section-text pegasus-bg-dark w-100 d-flex flex-column justify-content-center text-center text-white p-5 wow fadeInLeft">
													<?php if ( $title ) : ?>
														<h2 class="mabellas-section-title mb-2">
															<?php echo esc_html( $title ); ?>
														</h2>
													<?php endif; ?>

													<?php if ( $subtitle ) : ?>
														<p class="mabellas-section-subtitle mb-3 text-uppercase small">
															<?php echo esc_html( $subtitle ); ?>
														</p>
													<?php endif; ?>

													<?php if ( $paragraph ) : ?>
														<div class="mabellas-section-paragraph mb-4">
															<?php
															// wysiwyg content – allow formatting.
															echo wp_kses_post( wpautop( $paragraph ) );
															?>
														</div>
													<?php endif; ?>

													<?php if ( $btn_text && $btn_link ) : ?>
														<a class="btn mabellas-btn mabellas-section-btn" href="<?php echo esc_url( $btn_link ); ?>">
															<?php echo esc_html( $btn_text ); ?>
														</a>
													<?php endif; ?>
												</div>
											</div>

											<div class="col-lg-8">
												<div class="mabellas-home-section-image h-100 wow fadeInUp">
													<?php if ( $image_url ) : ?>
														<img src="<?php echo esc_url( $image_url ); ?>" alt="" class="img-fluid w-100 h-100 ">
													<?php endif; ?>
												</div>
											</div>

										<?php else : ?>

											<!-- Image left / Text right -->
											<div class="col-lg-8 order-lg-1 order-2">
												<div class="mabellas-home-section-image h-100 wow fadeInUp">
													<?php if ( $image_url ) : ?>
														<img src="<?php echo esc_url( $image_url ); ?>" alt="" class="img-fluid w-100 h-100 ">
													<?php endif; ?>
												</div>
											</div>

											<div class="col-lg-4 order-lg-2 order-1 d-flex">
												<div class="mabellas-home-section-text pegasus-bg-dark w-100 d-flex flex-column justify-content-center text-center text-white p-5 wow fadeInRight">
													<?php if ( $title ) : ?>
														<h2 class="mabellas-section-title mb-2">
															<?php echo esc_html( $title ); ?>
														</h2>
													<?php endif; ?>

													<?php if ( $subtitle ) : ?>
														<p class="mabellas-section-subtitle mb-3 text-uppercase small">
															<?php echo esc_html( $subtitle ); ?>
														</p>
													<?php endif; ?>

													<?php if ( $paragraph ) : ?>
														<div class="mabellas-section-paragraph mb-4">
															<?php echo wp_kses_post( wpautop( $paragraph ) ); ?>
														</div>
													<?php endif; ?>

													<?php if ( $btn_text && $btn_link ) : ?>
														<a class="btn mabellas-btn mabellas-section-btn" href="<?php echo esc_url( $btn_link ); ?>">
															<?php echo esc_html( $btn_text ); ?>
														</a>
													<?php endif; ?>
												</div>
											</div>

										<?php endif; ?>

									</div><!-- .row -->
								</div><!-- .container-fluid -->
							</section>

							<?php
							$index++;
						endforeach;
						?>

					<?php else : ?>

						<!-- Fallback: show normal page content if no sections defined -->
						<div class="container py-5">
							<?php the_content(); ?>
						</div>

					<?php endif; ?>

				<?php endwhile; ?>
			<?php endif; ?>

		</main>

		<section class="d-none">
			<div class="container py-5">
				<div class="mabellas-newsletter-card text-center">
					<h2 class="mabellas-newsletter-title">
						Stay in the Mabella’s Loop
					</h2>
					<p class="mabellas-newsletter-text">
						Sign up to receive updates on chef specials, seasonal menus, and exclusive events.
					</p>

					<form class="mabellas-newsletter-form" action="#" method="post" novalidate>
						<div class="mabellas-newsletter-fields">
							<label for="mabellas-newsletter-email" class="visually-hidden">
								Email address
							</label>
							<input
								type="email"
								id="mabellas-newsletter-email"
								name="mabellas_newsletter_email"
								class="mabellas-newsletter-input"
								placeholder="Enter your email address"
								required
							>
							<button type="submit" class="mabellas-newsletter-btn">
								Join the List
							</button>
						</div>
						<p class="mabellas-newsletter-note">
							We respect your privacy. No spam, just great food and good news.
						</p>
					</form>
				</div>
			</div>
		</section>

		<section class="bg-white py-5">
			<div class="container">
				<h2 class="text-center text-dark mb-4">Upcoming Events</h2>
				<?php echo do_shortcode( '[ulg_events]' ); ?>
			</div>
		</section>

		<div class="<?php echo $final_container_class; ?>">
		<!-- Example row of columns -->
			<div class="">

				<div class="inner-content">
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
								<!--<div class="page-header-spacer"></div>-->
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
	</div><!-- end page wrap -->
    <?php get_footer(); ?>
