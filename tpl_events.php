<?php
/*
	Template Name: Events Template
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


		<!-- ════════════════════════════════════════
			 VENUE FILTER BAR
			 ════════════════════════════════════════ -->
		<?php $venues = ulg_get_venues(); ?>

		<section class="ulg-events-filters py-3">
			<div class="container-fluid">
				<div class="d-flex flex-wrap justify-content-center gap-2">
					<button class="btn ulg-filter-btn active" data-venue="all">All Venues</button>
					<?php foreach ( $venues as $slug => $venue ) : ?>
						<button class="btn ulg-filter-btn" data-venue="<?php echo esc_attr( $slug ); ?>">
							<?php echo esc_html( $venue['name'] ); ?>
						</button>
					<?php endforeach; ?>
				</div>
			</div>
		</section>


		<!-- ════════════════════════════════════════
			 EVENTS CARD GRID (full width)
			 ════════════════════════════════════════ -->
		<main id="primary" class="site-main ulg-events-page">

			<?php
			$events_query = new WP_Query( array(
				'post_type'      => 'ulg_events',
				'posts_per_page' => -1,
				'post_status'    => 'publish',
				'orderby'        => 'meta_value_num',
				'meta_key'       => 'ulg_event_start_datetime',
				'order'          => 'ASC',
			) );
			?>

			<?php if ( $events_query->have_posts() ) : ?>

				<div class="container-fluid py-4">
					<div class="row g-4" id="ulg-events-list">

						<?php while ( $events_query->have_posts() ) : $events_query->the_post(); ?>

							<?php
							$event_id   = get_the_ID();
							$venue_slug = get_post_meta( $event_id, 'ulg_event_venue', true );
							$venue_info = isset( $venues[ $venue_slug ] ) ? $venues[ $venue_slug ] : array();
							$venue_name = ! empty( $venue_info['name'] )    ? $venue_info['name']    : '';
							$venue_addr = ! empty( $venue_info['address'] ) ? $venue_info['address'] : '';
							$venue_url  = ! empty( $venue_info['website'] ) ? $venue_info['website'] : '';

							$start_ts   = (int) get_post_meta( $event_id, 'ulg_event_start_datetime', true );
							$end_ts     = (int) get_post_meta( $event_id, 'ulg_event_end_datetime', true );
							$event_type = get_post_meta( $event_id, 'ulg_event_type', true );
							$status     = get_post_meta( $event_id, 'ulg_event_status', true );
							$ticket_url = get_post_meta( $event_id, 'ulg_event_ticket_url', true );
							$base_price = get_post_meta( $event_id, 'ulg_event_base_price', true );

							// Banner image → featured image fallback
							$banner_raw = get_post_meta( $event_id, 'ulg_event_banner_image', true );
							$image_url  = function_exists( 'ulg_get_cmb2_image_url' ) ? ulg_get_cmb2_image_url( $banner_raw ) : '';
							if ( empty( $image_url ) ) {
								$image_url = get_the_post_thumbnail_url( $event_id, 'large' );
							}
							?>

							<div class="col-12 col-md-6 col-lg-4 ulg-event-item" data-venue="<?php echo esc_attr( $venue_slug ); ?>">
								<div class="card ulg-event-card h-100">

									<?php if ( $image_url ) : ?>
										<div class="ulg-event-card-img-wrap">
											<img src="<?php echo esc_url( $image_url ); ?>" class="card-img-top ulg-event-card-img" alt="<?php the_title_attribute(); ?>">

											<?php if ( $start_ts ) : ?>
												<div class="ulg-event-date-badge">
													<span class="ulg-event-month"><?php echo esc_html( date_i18n( 'M', $start_ts ) ); ?></span>
													<span class="ulg-event-day"><?php echo esc_html( date_i18n( 'j', $start_ts ) ); ?></span>
												</div>
											<?php endif; ?>

											<?php if ( $status && 'upcoming' !== $status ) : ?>
												<span class="ulg-event-status-badge ulg-event-status-<?php echo esc_attr( $status ); ?>">
													<?php echo esc_html( ucfirst( $status ) ); ?>
												</span>
											<?php endif; ?>
										</div>
									<?php elseif ( $start_ts ) : ?>
										<div class="ulg-event-card-img-wrap ulg-event-no-image">
											<div class="ulg-event-date-badge">
												<span class="ulg-event-month"><?php echo esc_html( date_i18n( 'M', $start_ts ) ); ?></span>
												<span class="ulg-event-day"><?php echo esc_html( date_i18n( 'j', $start_ts ) ); ?></span>
											</div>
										</div>
									<?php endif; ?>

									<div class="card-body d-flex flex-column">

										<?php if ( $event_type ) : ?>
											<span class="ulg-event-type-tag mb-2"><?php echo esc_html( ucfirst( $event_type ) ); ?></span>
										<?php endif; ?>

										<h5 class="card-title">
											<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
										</h5>

										<?php if ( $venue_name ) : ?>
											<p class="ulg-event-venue mb-0">
												<small>
													&#128205;
													<?php if ( $venue_url ) : ?>
														<a href="<?php echo esc_url( $venue_url ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $venue_name ); ?></a>
													<?php else : ?>
														<?php echo esc_html( $venue_name ); ?>
													<?php endif; ?>
												</small>
											</p>
										<?php endif; ?>

										<?php if ( $venue_addr ) : ?>
											<p class="text-muted mb-1"><small><?php echo esc_html( $venue_addr ); ?></small></p>
										<?php endif; ?>

										<?php if ( $start_ts ) : ?>
											<p class="ulg-event-time text-muted small mb-2">
												<?php echo esc_html( date_i18n( 'l, F j, Y', $start_ts ) ); ?>
												<?php echo esc_html( ' at ' . date_i18n( 'g:i A', $start_ts ) ); ?>
												<?php if ( $end_ts ) : ?>
													&ndash; <?php echo esc_html( date_i18n( 'g:i A', $end_ts ) ); ?>
												<?php endif; ?>
											</p>
										<?php endif; ?>

										<?php if ( has_excerpt() ) : ?>
											<p class="card-text"><?php echo esc_html( get_the_excerpt() ); ?></p>
										<?php endif; ?>

										<?php if ( $base_price ) : ?>
											<p class="ulg-event-price mb-2"><strong>$<?php echo esc_html( $base_price ); ?></strong></p>
										<?php endif; ?>

										<div class="mt-auto d-flex gap-2 flex-wrap">
											<a href="<?php the_permalink(); ?>" class="btn ulg-btn ulg-section-btn">Details</a>
											<?php if ( $ticket_url ) : ?>
												<a href="<?php echo esc_url( $ticket_url ); ?>" class="btn btn-outline-primary ulg-section-btn" target="_blank" rel="noopener noreferrer">Tickets / RSVP</a>
											<?php endif; ?>
										</div>

									</div><!-- .card-body -->
								</div><!-- .card -->
							</div><!-- .col -->

						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>

					</div><!-- .row -->
				</div><!-- .container-fluid -->

			<?php else : ?>

				<div class="container-fluid py-5 text-center">
					<p class="text-muted">No events found. Check back soon!</p>
				</div>

			<?php endif; ?>

		</main>

	</div><!-- end page wrap -->

	<!-- Venue filter JS -->
	<script>
	(function () {
		var buttons   = document.querySelectorAll( '.ulg-filter-btn' );
		var items     = document.querySelectorAll( '.ulg-event-item' );

		buttons.forEach( function ( btn ) {
			btn.addEventListener( 'click', function () {
				var venue = this.getAttribute( 'data-venue' );

				// Toggle active class
				buttons.forEach( function ( b ) { b.classList.remove( 'active' ); } );
				this.classList.add( 'active' );

				// Show / hide cards
				items.forEach( function ( item ) {
					if ( venue === 'all' || item.getAttribute( 'data-venue' ) === venue ) {
						item.style.display = '';
					} else {
						item.style.display = 'none';
					}
				} );
			} );
		} );
	})();
	</script>

    <?php get_footer(); ?>
