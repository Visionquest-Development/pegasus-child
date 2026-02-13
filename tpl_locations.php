<?php
/*
	Template Name: Locations Template
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
								<div class="page-header-spacer"></div>
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



		<div class="container ulg-locations-wrapper">
			<h1 class="ulg-heading ulg-gradient-heading text-center mb-5 mt-1 pb-5"><?php the_title(); ?></h1>
			<div class="row">

				<?php
				$query2 = new WP_Query( array(
					'post_type'      => 'locations',
					'posts_per_page' => -1,
					'orderby'        => 'title',
					'order'          => 'ASC',
				) );

				if ( $query2->have_posts() ) :
					while ( $query2->have_posts() ) :
						$query2->the_post();

						// You can either keep the markup inline here,
						// or move it into a separate template part.
						?>

						<div class="col-md-6 col-lg-6 mb-4">
							<div class="ulg-location-card wow fadeIn">

								<?php
								$prefix = 'ulg_location_';
								$post_id = get_the_ID();

								// Meta fields
								$display_name   = get_post_meta( $post_id, $prefix . 'display_name', true );
								$subtitle       = get_post_meta( $post_id, $prefix . 'sub_title', true );
								$street         = get_post_meta( $post_id, $prefix . 'street', true );
								$street2        = get_post_meta( $post_id, $prefix . 'street2', true );
								$city           = get_post_meta( $post_id, $prefix . 'city', true );
								$state          = get_post_meta( $post_id, $prefix . 'state', true );
								$zip            = get_post_meta( $post_id, $prefix . 'zip', true );
								$phone_display  = get_post_meta( $post_id, $prefix . 'phone_display', true );
								$phone_tel      = get_post_meta( $post_id, $prefix . 'phone_tel', true );
								$hours          = get_post_meta( $post_id, $prefix . 'hours_op', true );
								$maps_url       = get_post_meta( $post_id, $prefix . 'maps_url', true );
								$card_btn_text  = get_post_meta( $post_id, $prefix . 'card_button_text', true );
								$card_btn_link  = get_post_meta( $post_id, $prefix . 'card_button_link', true );
								$social_fb      = get_post_meta( $post_id, $prefix . 'social_fb', true );
								$social_ig      = get_post_meta( $post_id, $prefix . 'social_ig', true );

								// Fallbacks
								$title_to_show  = $display_name ? $display_name : get_the_title();
								$visit_link     = $card_btn_link ? $card_btn_link : get_permalink();
								$visit_btn_text = $card_btn_text ? $card_btn_text : __( 'Visit Us', 'pegasus-bootstrap' );
								?>

								<div class="ulg-location-card-inner">

									<?php if ( has_post_thumbnail() ) : ?>
										<div class="ulg-location-logo mb-3">
											<?php the_post_thumbnail( 'full', array( 'class' => 'img-fluid' ) ); ?>
										</div>
									<?php endif; ?>

									<h3 class="ulg-location-title">
										<?php echo esc_html( $title_to_show ); ?>
									</h3>

									<?php if ( $subtitle ) : ?>
										<p class="ulg-location-subtitle mb-3">
											<?php echo esc_html( $subtitle ); ?>
										</p>
									<?php endif; ?>

									<?php if ( $street || $city || $state || $zip ) : ?>
										<div class="ulg-location-address mb-3">
											<?php if ( $street ) : ?>
												<div><?php echo esc_html( $street ); ?></div>
											<?php endif; ?>

											<?php if ( $street2 ) : ?>
												<div><?php echo esc_html( $street2 ); ?></div>
											<?php endif; ?>

											<?php if ( $city || $state || $zip ) : ?>
												<div>
													<?php
													echo esc_html( trim( $city ) );
													if ( $state ) {
														echo ', ' . esc_html( $state );
													}
													if ( $zip ) {
														echo ' ' . esc_html( $zip );
													}
													?>
												</div>
											<?php endif; ?>
										</div>
									<?php endif; ?>

									<?php if ( $phone_display && $phone_tel ) : ?>
										<p class="ulg-location-phone mb-3">
											<a href="<?php echo esc_url( 'tel:' . preg_replace( '/[^0-9\+]/', '', $phone_tel ) ); ?>">
												<?php echo esc_html( $phone_display ); ?>
											</a>
										</p>
									<?php elseif ( $phone_display ) : ?>
										<p class="ulg-location-phone mb-3">
											<?php echo esc_html( $phone_display ); ?>
										</p>
									<?php endif; ?>

									<?php if ( $hours ) : ?>
										<div class="ulg-location-hours mb-3">
											<?php echo wp_kses_post( wpautop( $hours ) ); ?>
										</div>
									<?php endif; ?>

									<?php if ( $social_fb || $social_ig ) : ?>
										<div class="ulg-location-social mb-3">
											<?php if ( $social_fb ) : ?>
												<a class="ulg-location-social-link ulg-location-social-fb" href="<?php echo esc_url( $social_fb ); ?>" target="_blank" rel="noopener">
													<span class="screen-reader-text">Facebook</span>
													<i class="fa fa-facebook" aria-hidden="true"></i>
												</a>
											<?php endif; ?>

											<?php if ( $social_ig ) : ?>
												<a class="ulg-location-social-link ulg-location-social-ig" href="<?php echo esc_url( $social_ig ); ?>" target="_blank" rel="noopener">
													<span class="screen-reader-text">Instagram</span>
													<i class="fa fa-instagram" aria-hidden="true"></i>
												</a>
											<?php endif; ?>
										</div>
									<?php endif; ?>

									<div class="ulg-location-buttons">
										<?php if ( $maps_url ) : ?>
											<a class="btn btn-primary btn-block" href="<?php echo esc_url( $maps_url ); ?>" target="_blank" rel="noopener">
												<?php esc_html_e( 'Get Directions', 'pegasus-bootstrap' ); ?>
											</a>
										<?php endif; ?>

										<a class="btn btn-outline-primary btn-block" href="<?php echo esc_url( $visit_link ); ?>">
											<?php echo esc_html( $visit_btn_text ); ?>
										</a>
									</div>

								</div><!-- /.ulg-location-card-inner -->
							</div><!-- /.ulg-location-card -->
						</div><!-- /.col -->

						<?php
					endwhile;
					wp_reset_postdata();
				endif;
				?>

			</div><!-- /.row -->
		</div><!-- /.container -->


	</div><!-- end page wrap -->
    <?php get_footer(); ?>
