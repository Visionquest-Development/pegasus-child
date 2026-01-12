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

		
		<main id="primary" class="site-main ulg-home">
			
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
							$image_url  = function_exists( 'ulg_get_cmb2_image_url' ) ? ulg_get_cmb2_image_url( $bg_value ) : '';

							$title      = isset( $section['title'] ) ? $section['title'] : '';
							$subtitle   = isset( $section['subtitle'] ) ? $section['subtitle'] : '';
							$paragraph  = isset( $section['paragraph'] ) ? $section['paragraph'] : '';
							$btn_text   = isset( $section['button1_text'] ) ? $section['button1_text'] : '';
							$btn_link   = isset( $section['button1_link'] ) ? $section['button1_link'] : '';

							$is_even    = ( $index % 2 === 0 ); // even index = text left, image right
							?>

							<section class="ulg-home-section mt-3 pb-3">
								<div class="container-fluid">
									<div class="row g-4  home-section-container">

										<?php if ( $is_even ) : ?>

											<!-- Text left / Image right -->
											<div class="col-lg-4 d-flex">
												<div class="ulg-home-section-text pegasus-bg-dark w-100 d-flex flex-column justify-content-center   p-5 ">
													<?php if ( $title ) : ?>
														<h2 class="ulg-section-title ulg-heading-border mb-2">
															<?php echo esc_html( $title ); ?>
														</h2>
													<?php endif; ?>

													<?php if ( $subtitle ) : ?>
														<p class="ulg-section-subtitle mb-3 text-uppercase small">
															<?php echo esc_html( $subtitle ); ?>
														</p>
													<?php endif; ?>

													<?php if ( $paragraph ) : ?>
														<div class="ulg-section-paragraph mb-4">
															<?php
															// wysiwyg content – allow formatting.
															echo wp_kses_post( wpautop( $paragraph ) );
															?>
														</div>
													<?php endif; ?>

													<?php if ( $btn_text && $btn_link ) : ?>
														<a class="btn ulg-btn ulg-section-btn" href="<?php echo esc_url( $btn_link ); ?>">
															<?php echo esc_html( $btn_text ); ?>
														</a>
													<?php endif; ?>
												</div>
											</div>

											<div class="col-lg-8">
												<?php if ( $image_url ) : ?>
													<div class="ulg-home-section-image " style="background-image: url('<?php echo esc_url( $image_url ); ?>');">
													
														
													
													</div>
												<?php endif; ?>
											</div>

										<?php else : ?>

											<!-- Image left / Text right -->
											<div class="col-lg-8 order-lg-1 order-2">
												<?php if ( $image_url ) : ?>
													<div class="ulg-home-section-image  " style="background-image: url('<?php echo esc_url( $image_url ); ?>');">
														
														
													</div>
												<?php endif; ?>
											</div>

											<div class="col-lg-4 order-lg-2 order-1 d-flex">
												<div class="ulg-home-section-text pegasus-bg-dark w-100 d-flex flex-column justify-content-center   p-5 ">
													<?php if ( $title ) : ?>
														<h2 class="ulg-section-title ulg-heading-border mb-2">
															<?php echo esc_html( $title ); ?>
														</h2>
													<?php endif; ?>

													<?php if ( $subtitle ) : ?>
														<p class="ulg-section-subtitle mb-3 text-uppercase small">
															<?php echo esc_html( $subtitle ); ?>
														</p>
													<?php endif; ?>

													<?php if ( $paragraph ) : ?>
														<div class="ulg-section-paragraph mb-4">
															<?php echo wp_kses_post( wpautop( $paragraph ) ); ?>
														</div>
													<?php endif; ?>

													<?php if ( $btn_text && $btn_link ) : ?>
														<a class="btn ulg-btn ulg-section-btn" href="<?php echo esc_url( $btn_link ); ?>">
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
		
		

		<section class="py-5 mb-5 d-none d-lg-block">
			<?php echo do_shortcode( '[uptown_restaurant_map height="600px"]' ); ?>
		</section>

		
	</div><!-- end page wrap -->
    <?php get_footer(); ?>
