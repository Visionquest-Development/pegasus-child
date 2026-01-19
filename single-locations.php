	<?php
		/**
		 * Silence is golden; exit if accessed directly
		 */
		if ( ! defined( 'ABSPATH' ) ) {
			exit;
		}
		get_header();
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
			$page_body_content_class = 'col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xg-12';
			
			//page header page options
			$post_disable_page_header_choice = get_post_meta( get_the_ID(), 'pegasus-page-header-checkbox', true ) ? get_post_meta( get_the_ID(), 'pegasus-page-header-checkbox', true ) : 'off';
			//page header theme option
			$global_disable_page_header_option =  pegasus_get_option('page_header_chk' ) ? pegasus_get_option('page_header_chk' ) : 'off';
			//check theme option for page header before page option
			$page_title = $post->post_title;
			if ( 'on' === $global_disable_page_header_option ) {
				$final_page_header_option = 'on';
			} elseif ( 'on' === $post_disable_page_header_choice ) {
				$final_page_header_option = 'on';
			} else {
				$final_page_header_option = 'off';
			}
		?>
		
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();

				$post_id = get_the_ID();

				// Main meta prefix.
				$meta_prefix = 'ulg_location_';

				$display_name   = get_post_meta( $post_id, $meta_prefix . 'display_name', true );
				$subtitle       = get_post_meta( $post_id, $meta_prefix . 'sub_title', true );
				$street         = get_post_meta( $post_id, $meta_prefix . 'street', true );
				$street2        = get_post_meta( $post_id, $meta_prefix . 'street2', true );
				$city           = get_post_meta( $post_id, $meta_prefix . 'city', true );
				$state          = get_post_meta( $post_id, $meta_prefix . 'state', true );
				$zip            = get_post_meta( $post_id, $meta_prefix . 'zip', true );

				$phone_display  = get_post_meta( $post_id, $meta_prefix . 'phone_display', true );
				$phone_tel      = get_post_meta( $post_id, $meta_prefix . 'phone_tel', true );
				$phone2_display = get_post_meta( $post_id, $meta_prefix . 'phone2_display', true );
				$phone2_tel     = get_post_meta( $post_id, $meta_prefix . 'phone2_tel', true );

				$maps_url       = get_post_meta( $post_id, $meta_prefix . 'maps_url', true );
				$res_url        = get_post_meta( $post_id, $meta_prefix . 'reservation_url', true );

				$hours_op       = get_post_meta( $post_id, $meta_prefix . 'hours_op', true );

				$social_fb      = get_post_meta( $post_id, $meta_prefix . 'social_fb', true );
				$social_ig      = get_post_meta( $post_id, $meta_prefix . 'social_ig', true );

				// Gallery meta prefix.
				$gallery_prefix = 'location_';

				// This returns an array of rows, each is an array of the group’s fields.
				$gallery_items  = get_post_meta( $post_id, $gallery_prefix . 'gallery', true );

				?>
				<main id="primary" class="site-main single-location">

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<div class="location-header container py-5">
							<div class="row">
								<div class="col-md-12">
									
									<?php if ( has_post_thumbnail() ) : ?>
										<div class="location-featured-image mb-4 mb-md-0">
											<?php the_post_thumbnail( 'large', array( 'class' => 'img-fluid rounded' ) ); ?>
										</div>
									<?php endif; ?>
									
									<hr>
									
									<h1 class="location-title">
										<?php echo esc_html( $display_name ? $display_name : get_the_title() ); ?>
									</h1>

									<?php if ( $subtitle ) : ?>
										<p class="location-subtitle lead mb-3">
											<?php echo esc_html( $subtitle ); ?>
										</p>
									<?php endif; ?>
									
									<hr>
									
									<div class="row">
										<div class="col-6">

											<?php if ( $street || $city || $state || $zip ) : ?>
												<div class="location-address mb-3"
													 itemprop="address"
													 itemscope
													 itemtype="https://schema.org/PostalAddress">

													<p class="mb-0">
														<?php if ( $street ) : ?>
															<span itemprop="streetAddress">
																<?php echo esc_html( $street ); ?>
															</span><br>
														<?php endif; ?>

														<?php if ( $street2 ) : ?>
															<span class="d-block">
																<?php echo esc_html( $street2 ); ?>
															</span>
														<?php endif; ?>

														<?php if ( $city || $state || $zip ) : ?>
															<span>
																<?php if ( $city ) : ?>
																	<span itemprop="addressLocality">
																		<?php echo esc_html( $city ); ?>
																	</span>
																<?php endif; ?>

																<?php if ( $city && $state ) : ?>, <?php endif; ?>

																<?php if ( $state ) : ?>
																	<span itemprop="addressRegion">
																		<?php echo esc_html( $state ); ?>
																	</span>
																<?php endif; ?>

																<?php if ( $zip ) : ?>
																	<span itemprop="postalCode">
																		<?php echo ' ' . esc_html( $zip ); ?>
																	</span>
																<?php endif; ?>
															</span>
														<?php endif; ?>
													</p>
												</div>
											<?php endif; ?>
										
											<?php if ( $phone_display || $phone2_display ) : ?>
												<div class="location-phones mb-3">
													<?php if ( $phone_display ) : ?>
														<p class="mb-1">
															<strong><?php esc_html_e( 'Phone:', 'pegasus-bootstrap' ); ?></strong>
															<?php if ( $phone_tel ) : ?>
																<a href="tel:<?php echo esc_attr( $phone_tel ); ?>">
																	<?php echo esc_html( $phone_display ); ?>
																</a>
															<?php else : ?>
																<?php echo esc_html( $phone_display ); ?>
															<?php endif; ?>
														</p>
													<?php endif; ?>

													<?php if ( $phone2_display ) : ?>
														<p class="mb-0">
															<strong><?php esc_html_e( 'Secondary:', 'pegasus-bootstrap' ); ?></strong>
															<?php if ( $phone2_tel ) : ?>
																<a href="tel:<?php echo esc_attr( $phone2_tel ); ?>">
																	<?php echo esc_html( $phone2_display ); ?>
																</a>
															<?php else : ?>
																<?php echo esc_html( $phone2_display ); ?>
															<?php endif; ?>
														</p>
													<?php endif; ?>
												</div>
											<?php endif; ?>
											
											<div class="location-actions mb-4">
												<?php if ( $maps_url ) : ?>
													<a class="btn btn-primary me-2"
													   href="<?php echo esc_url( $maps_url ); ?>"
													   target="_blank" rel="noopener">
														<?php esc_html_e( 'View on Map', 'pegasus-bootstrap' ); ?>
													</a>
												<?php endif; ?>

												<?php if ( $res_url ) : ?>
													<a class="btn btn-outline-primary"
													   href="<?php echo esc_url( $res_url ); ?>"
													   target="_blank" rel="noopener">
														<?php esc_html_e( 'Make a Reservation', 'pegasus-bootstrap' ); ?>
													</a>
												<?php endif; ?>
											</div>
										</div>
										<div class="col-6">
											<?php if ( $hours_op ) : ?>
												<div class="location-hours card mb-4">
													<div class="card-body">
														<h2 class="h5 card-title">
															<?php esc_html_e( 'Hours of Operation', 'pegasus-bootstrap' ); ?>
														</h2>
														<div class="location-hours-content">
															<?php
															// WYSIWYG meta – run through content filters for basic formatting.
															echo apply_filters( 'the_content', wp_kses_post( $hours_op ) );
															?>
														</div>
													</div>
												</div>
											<?php endif; ?>
										</div>
									</div>

									<hr>

									<?php if ( $social_fb || $social_ig ) : ?>
										<div class="location-social">
											<strong class="d-block mb-1">
												<?php esc_html_e( 'Follow Us', 'pegasus-bootstrap' ); ?>
											</strong>
											<ul class="list-inline mb-0">
												<?php if ( $social_fb ) : ?>
													<li class="list-inline-item me-3">
														<a href="<?php echo esc_url( $social_fb ); ?>" target="_blank" rel="noopener">
															<?php esc_html_e( 'Facebook', 'pegasus-bootstrap' ); ?>
														</a>
													</li>
												<?php endif; ?>

												<?php if ( $social_ig ) : ?>
													<li class="list-inline-item">
														<a href="<?php echo esc_url( $social_ig ); ?>" target="_blank" rel="noopener">
															<?php esc_html_e( 'Instagram', 'pegasus-bootstrap' ); ?>
														</a>
													</li>
												<?php endif; ?>
											</ul>
										</div>
									<?php endif; ?>
									
									<hr>

								</div><!-- /.col-md-8 -->

							</div><!-- /.row -->
						</div>

						<section class="location-content container pb-5">
							<div class="row">
								<div class="col-md-8">
									<?php
									// Main content (editor).
									the_content();
									?>
								</div>

								<div class="col-md-4">
									
								</div>
							</div><!-- /.row -->
						</section>

						<?php if ( ! empty( $gallery_items ) && is_array( $gallery_items ) ) : ?>
							<section class="location-gallery container pb-5">
								<h2 class="h3 mb-4">
									<?php esc_html_e( 'Photo Gallery', 'pegasus-bootstrap' ); ?>
								</h2>

								<div class="row g-3">
									<?php foreach ( $gallery_items as $item ) :

										$title   = isset( $item[ $gallery_prefix . 'gallery_title' ] )
											? $item[ $gallery_prefix . 'gallery_title' ]
											: '';

										$alt     = isset( $item[ $gallery_prefix . 'gallery_alt_text' ] )
											? $item[ $gallery_prefix . 'gallery_alt_text' ]
											: '';

										$caption = isset( $item[ $gallery_prefix . 'gallery_caption' ] )
											? $item[ $gallery_prefix . 'gallery_caption' ]
											: '';

										// CMB2 file field usually stores both *_image and *_image_id.
										$image_id  = isset( $item[ $gallery_prefix . 'gallery_image_id' ] )
											? (int) $item[ $gallery_prefix . 'gallery_image_id' ]
											: 0;

										$image_url = '';

										if ( $image_id ) {
											$image_url = wp_get_attachment_image_url( $image_id, 'large' );
										} elseif ( ! empty( $item[ $gallery_prefix . 'gallery_image' ] ) ) {
											$image_url = esc_url( $item[ $gallery_prefix . 'gallery_image' ] );
										}

										if ( ! $image_url ) {
											continue;
										}
										?>
										<div class="col-6 col-md-4 col-lg-3">
											<figure class="location-gallery-item">
												<img class="img-fluid rounded"
													 src="<?php echo esc_url( $image_url ); ?>"
													 alt="<?php echo esc_attr( $alt ? $alt : $title ); ?>">
												<?php if ( $title || $caption ) : ?>
													<figcaption class="mt-2 small text-muted">
														<?php if ( $title ) : ?>
															<strong><?php echo esc_html( $title ); ?></strong>
														<?php endif; ?>
														<?php if ( $caption ) : ?>
															<?php if ( $title ) : ?> – <?php endif; ?>
															<?php echo esc_html( $caption ); ?>
														<?php endif; ?>
													</figcaption>
												<?php endif; ?>
											</figure>
										</div>
									<?php endforeach; ?>
								</div><!-- /.row -->
							</section>
						<?php endif; ?>

					</article><!-- #post-<?php the_ID(); ?> -->

				</main><!-- #primary -->

				<?php
			endwhile;
		endif;
		?>

		<div class="<?php echo esc_attr( $final_container_class ); ?>">
			<!-- Example row of columns -->
			<div class="row">
				<?php
					/*
					if( 'on' === $pegasus_left_sidebar_option && 'on' === $left_align_sidebar_chk ) {
						get_sidebar( 'left' );
					} else if( 'on' === $left_align_sidebar_chk ) {
						get_sidebar( 'right' );
					}
					*/
				?>

				<div class="<?php echo esc_attr( $page_body_content_class ); ?>">
					<div class="inner-content">
						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
							<?php
							/*
							if( 'off' === $final_page_header_option ) {
								
								?>
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
									<p><em>
										By <?php the_author(); ?>
										on <?php echo esc_html( the_time('l, F, jS, Y') ); ?>
										in <?php the_category( ',' ); ?>.
										<a href="<?php comments_link(); ?>"><?php comments_number(); ?></a>
									</em></p>
								</div>
							<?php }else{ ?>
								<div class="page-header-spacer"></div>
								<div class="">
									<p><em>
										By <?php the_author(); ?>
										on <?php echo esc_html( the_time('l, F, jS, Y') ); ?>
										in <?php the_category( ',' ); ?>.
										<a href="<?php comments_link(); ?>"><?php comments_number(); ?></a>
									</em></p>
								</div>
							<?php } 
							*/ ?>
							
							


							<?php the_content(); ?>

							<?php //comments_template(); ?>

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
						if ( function_exists( 'wp_bootstrap_post_navigation' ) ) {
							// Previous/next post navigation.
							wp_bootstrap_post_navigation( array(
								'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next: ', 'pegasus' ) . '</span> ' .
									'<span class="screen-reader-text">' . __( 'Next post:', 'pegasus' ) . '</span> ' .
									'<span class="post-title">%title</span>',
								'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous: ', 'pegasus' ) . '</span> ' .
									'<span class="screen-reader-text">' . __( 'Previous post:', 'pegasus' ) . '</span> ' .
									'<span class="post-title">%title</span>'
							) );
						}
						?>
					</div><!--end inner content-->
				</div>
				<?php
				/*
				if( 'on' === $pegasus_left_sidebar_option ) {
					get_sidebar( 'right' );
				}
				if( 'on' !== $left_align_sidebar_chk ) {
					get_sidebar( 'right' );
				}
				*/
				?>

			</div><!--end row -->
		</div><!-- end container -->
	</div><!-- end page wrap -->
      <?php get_footer(); ?>
