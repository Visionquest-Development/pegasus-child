<?php
/**
 * Single Event Template
 *
 * Automatically used for single ulg_events posts via WP template hierarchy.
 * File name must match: single-{post_type}.php → single-ulg_events.php
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

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

			//page header page options
			$post_disable_page_header_choice = get_post_meta( get_the_ID(), 'pegasus-page-header-checkbox', true ) ? get_post_meta( get_the_ID(), 'pegasus-page-header-checkbox', true ) : 'off';
			//page header theme option
			$global_disable_page_header_option = pegasus_get_option('page_header_chk' ) ? pegasus_get_option('page_header_chk' ) : 'off';
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

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<?php
			$event_id = get_the_ID();
			$prefix   = 'ulg_event_';

			// ── Pull all CMB2 fields ──
			$start_ts       = (int) get_post_meta( $event_id, $prefix . 'start_datetime', true );
			$end_ts         = (int) get_post_meta( $event_id, $prefix . 'end_datetime', true );
			$event_type     = get_post_meta( $event_id, $prefix . 'type', true );
			$event_status   = get_post_meta( $event_id, $prefix . 'status', true );
			$venue_slug     = get_post_meta( $event_id, $prefix . 'venue', true );

			$max_capacity   = get_post_meta( $event_id, $prefix . 'max_capacity', true );
			$catering       = get_post_meta( $event_id, $prefix . 'catering', true );
			$av_equipment   = get_post_meta( $event_id, $prefix . 'av_equipment', true );
			$seating        = get_post_meta( $event_id, $prefix . 'seating', true );
			$parking        = get_post_meta( $event_id, $prefix . 'parking', true );
			$special_accom  = get_post_meta( $event_id, $prefix . 'special_accommodations', true );

			$coordinator    = get_post_meta( $event_id, $prefix . 'coordinator_name', true );
			$coord_phone    = get_post_meta( $event_id, $prefix . 'coordinator_phone', true );
			$coord_email    = get_post_meta( $event_id, $prefix . 'coordinator_email', true );
			$num_bartenders = get_post_meta( $event_id, $prefix . 'num_bartenders', true );
			$num_servers    = get_post_meta( $event_id, $prefix . 'num_servers', true );
			$staff_notes    = get_post_meta( $event_id, $prefix . 'staff_notes', true );

			$base_price     = get_post_meta( $event_id, $prefix . 'base_price', true );
			$deposit        = get_post_meta( $event_id, $prefix . 'deposit', true );
			$contact_name   = get_post_meta( $event_id, $prefix . 'contact_name', true );
			$contact_phone  = get_post_meta( $event_id, $prefix . 'contact_phone', true );
			$contact_email  = get_post_meta( $event_id, $prefix . 'contact_email', true );
			$special_req    = get_post_meta( $event_id, $prefix . 'special_requests', true );

			$ticket_url     = get_post_meta( $event_id, $prefix . 'ticket_url', true );
			$banner_raw     = get_post_meta( $event_id, $prefix . 'banner_image', true );
			$banner_url     = function_exists( 'ulg_get_cmb2_image_url' ) ? ulg_get_cmb2_image_url( $banner_raw ) : '';

			// Venue lookup
			$venues     = ulg_get_venues();
			$venue_info = isset( $venues[ $venue_slug ] ) ? $venues[ $venue_slug ] : array();
			$venue_name = ! empty( $venue_info['name'] )    ? $venue_info['name']    : '';
			$venue_addr = ! empty( $venue_info['address'] ) ? $venue_info['address'] : '';
			$venue_url  = ! empty( $venue_info['website'] ) ? $venue_info['website'] : '';
			$venue_phone = ! empty( $venue_info['phone'] )  ? $venue_info['phone']   : '';

			// Featured image fallback
			$hero_image = $banner_url;
			if ( empty( $hero_image ) ) {
				$hero_image = get_the_post_thumbnail_url( $event_id, 'full' );
			}

			// Taxonomies
			$categories = wp_get_post_terms( $event_id, 'event_categories', array( 'fields' => 'names' ) );
			$tags       = wp_get_post_terms( $event_id, 'event_tags', array( 'fields' => 'names' ) );

			// AV equipment — stored as array
			$av_labels = array(
				'sound-system' => 'Sound System',
				'projector'    => 'Projector',
				'microphones'  => 'Microphones',
				'lighting'     => 'Lighting',
				'stage'        => 'Stage',
			);
			?>


			<!-- ══════════════════════════════════════
				 HERO BANNER
				 ══════════════════════════════════════ -->
			<?php if ( $hero_image ) : ?>
				<div class="ulg-single-event-hero" >
					<div class="ulg-single-event-hero-overlay">
						<div class="container">
							<?php if ( $event_type ) : ?>
								<span class="ulg-event-type-tag mb-2"><?php echo esc_html( ucfirst( $event_type ) ); ?></span>
							<?php endif; ?>
							<h1 class="ulg-single-event-title"><?php the_title(); ?></h1>
							<?php if ( $start_ts ) : ?>
								<p class="ulg-single-event-date">
									<?php echo esc_html( date_i18n( 'l, F j, Y', $start_ts ) ); ?>
									<?php echo esc_html( ' at ' . date_i18n( 'g:i A', $start_ts ) ); ?>
									<?php if ( $end_ts ) : ?>
										&ndash; <?php echo esc_html( date_i18n( 'g:i A', $end_ts ) ); ?>
									<?php endif; ?>
								</p>
							<?php endif; ?>
							<?php if ( $venue_name ) : ?>
								<p class="ulg-single-event-venue">
									&#128205;
									<?php if ( $venue_url ) : ?>
										<a href="<?php echo esc_url( $venue_url ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $venue_name ); ?></a>
									<?php else : ?>
										<?php echo esc_html( $venue_name ); ?>
									<?php endif; ?>
								</p>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php endif; ?>


			<!-- ══════════════════════════════════════
				 MAIN CONTENT AREA
				 ══════════════════════════════════════ -->
			<div class="<?php echo esc_attr( $final_container_class ); ?> py-4">
				<div class="inner-content">
					<div class="content-no-sidebar">

						<?php if ( ! $hero_image ) : ?>
							<?php if ( 'off' === $final_page_header_option ) { ?>
								<div class="page-header">
									<h1><?php the_title(); ?></h1>
								</div>
							<?php } else { ?>
								<div class="page-header-spacer"></div>
							<?php } ?>
						<?php endif; ?>

						<!-- Quick-info bar -->
						<div class="row g-3 mb-4">
							<?php if ( $start_ts ) : ?>
								<div class="col-sm-6 col-lg-3">
									<div class="card ulg-detail-card h-100 text-center p-3">
										<div class="ulg-detail-icon">&#128197;</div>
										<strong>Date</strong>
										<span><?php echo esc_html( date_i18n( 'M j, Y', $start_ts ) ); ?></span>
									</div>
								</div>
							<?php endif; ?>
							<?php if ( $start_ts ) : ?>
								<div class="col-sm-6 col-lg-3">
									<div class="card ulg-detail-card h-100 text-center p-3">
										<div class="ulg-detail-icon">&#128336;</div>
										<strong>Time</strong>
										<span>
											<?php echo esc_html( date_i18n( 'g:i A', $start_ts ) ); ?>
											<?php if ( $end_ts ) : ?>
												&ndash; <?php echo esc_html( date_i18n( 'g:i A', $end_ts ) ); ?>
											<?php endif; ?>
										</span>
									</div>
								</div>
							<?php endif; ?>
							<?php if ( $venue_name ) : ?>
								<div class="col-sm-6 col-lg-3">
									<div class="card ulg-detail-card h-100 text-center p-3">
										<div class="ulg-detail-icon">&#128205;</div>
										<strong>Venue</strong>
										<span><?php echo esc_html( $venue_name ); ?></span>
									</div>
								</div>
							<?php endif; ?>
							<?php if ( $base_price ) : ?>
								<div class="col-sm-6 col-lg-3">
									<div class="card ulg-detail-card h-100 text-center p-3">
										<div class="ulg-detail-icon">&#128176;</div>
										<strong>Price</strong>
										<span>$<?php echo esc_html( $base_price ); ?></span>
									</div>
								</div>
							<?php endif; ?>
						</div>

						<?php if ( $ticket_url ) : ?>
							<div class="mb-4 text-center">
								<a href="<?php echo esc_url( $ticket_url ); ?>" class="btn ulg-btn ulg-section-btn btn-lg" target="_blank" rel="noopener noreferrer">
									Tickets / RSVP
								</a>
							</div>
						<?php endif; ?>

						<?php if ( $event_status && 'upcoming' !== $event_status ) : ?>
							<div class="alert alert-<?php echo ( 'cancelled' === $event_status ) ? 'danger' : ( ( 'active' === $event_status ) ? 'success' : 'secondary' ); ?> text-center mb-4" role="alert">
								This event is currently <strong><?php echo esc_html( ucfirst( $event_status ) ); ?></strong>.
							</div>
						<?php endif; ?>


						<!-- ── Description (editor content) ── -->
						<div class="ulg-single-event-content mb-5">
							<?php the_content(); ?>
						</div>


						<div class="row g-4">

							<!-- ══════════════ LEFT COLUMN ══════════════ -->
							<div class="col-lg-8">

								<?php
								// ── Venue Details ──
								if ( $venue_name ) : ?>
									<div class="card mb-4">
										<div class="card-header ulg-card-header">
											<h5 class="mb-0">Venue Details</h5>
										</div>
										<div class="card-body">
											<h6><?php echo esc_html( $venue_name ); ?></h6>
											<?php if ( $venue_addr ) : ?>
												<p class="mb-1"><?php echo esc_html( $venue_addr ); ?></p>
											<?php endif; ?>
											<?php if ( $venue_phone ) : ?>
												<p class="mb-1">
													<a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $venue_phone ) ); ?>"><?php echo esc_html( $venue_phone ); ?></a>
												</p>
											<?php endif; ?>
											<?php if ( $venue_url ) : ?>
												<a href="<?php echo esc_url( $venue_url ); ?>" class="btn btn-sm btn-outline-primary mt-2" target="_blank" rel="noopener noreferrer">Visit Website</a>
											<?php endif; ?>
										</div>
									</div>
								<?php endif; ?>


								<?php
								// ── Accommodations ──
								$has_accommodations = $max_capacity || $catering || $av_equipment || $seating || $parking || $special_accom;
								if ( $has_accommodations ) : ?>
									<div class="card mb-4">
										<div class="card-header ulg-card-header">
											<h5 class="mb-0">Accommodations</h5>
										</div>
										<div class="card-body">
											<div class="row g-3">
												<?php if ( $max_capacity ) : ?>
													<div class="col-sm-6">
														<strong>Max Capacity</strong>
														<p class="mb-0"><?php echo esc_html( $max_capacity ); ?> guests</p>
													</div>
												<?php endif; ?>
												<?php if ( $seating ) : ?>
													<div class="col-sm-6">
														<strong>Seating</strong>
														<p class="mb-0"><?php echo esc_html( ucfirst( $seating ) ); ?></p>
													</div>
												<?php endif; ?>
												<?php if ( $catering ) : ?>
													<div class="col-sm-6">
														<strong>Catering</strong>
														<p class="mb-0"><?php echo esc_html( ucfirst( str_replace( '-', ' ', $catering ) ) ); ?></p>
													</div>
												<?php endif; ?>
												<?php if ( $parking ) : ?>
													<div class="col-sm-6">
														<strong>Parking</strong>
														<p class="mb-0"><?php echo esc_html( ucfirst( str_replace( '-', ' ', $parking ) ) ); ?></p>
													</div>
												<?php endif; ?>
											</div>

											<?php if ( ! empty( $av_equipment ) && is_array( $av_equipment ) ) : ?>
												<hr>
												<strong>AV Equipment</strong>
												<div class="d-flex flex-wrap gap-2 mt-2">
													<?php foreach ( $av_equipment as $av_item ) : ?>
														<span class="badge ulg-badge"><?php echo esc_html( isset( $av_labels[ $av_item ] ) ? $av_labels[ $av_item ] : ucfirst( $av_item ) ); ?></span>
													<?php endforeach; ?>
												</div>
											<?php endif; ?>

											<?php if ( $special_accom ) : ?>
												<hr>
												<strong>Special Accommodations</strong>
												<p class="mb-0 mt-1"><?php echo esc_html( $special_accom ); ?></p>
											<?php endif; ?>
										</div>
									</div>
								<?php endif; ?>


								<?php
								// ── Staff Details ──
								$has_staff = $coordinator || $coord_phone || $coord_email || $num_bartenders || $num_servers || $staff_notes;
								if ( $has_staff ) : ?>
									<div class="card mb-4">
										<div class="card-header ulg-card-header">
											<h5 class="mb-0">Staff Details</h5>
										</div>
										<div class="card-body">
											<div class="row g-3">
												<?php if ( $coordinator ) : ?>
													<div class="col-sm-6">
														<strong>Event Coordinator</strong>
														<p class="mb-0"><?php echo esc_html( $coordinator ); ?></p>
													</div>
												<?php endif; ?>
												<?php if ( $coord_phone ) : ?>
													<div class="col-sm-6">
														<strong>Coordinator Phone</strong>
														<p class="mb-0">
															<a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $coord_phone ) ); ?>"><?php echo esc_html( $coord_phone ); ?></a>
														</p>
													</div>
												<?php endif; ?>
												<?php if ( $coord_email ) : ?>
													<div class="col-sm-6">
														<strong>Coordinator Email</strong>
														<p class="mb-0">
															<a href="mailto:<?php echo esc_attr( $coord_email ); ?>"><?php echo esc_html( $coord_email ); ?></a>
														</p>
													</div>
												<?php endif; ?>
												<?php if ( $num_bartenders ) : ?>
													<div class="col-sm-6">
														<strong>Bartenders</strong>
														<p class="mb-0"><?php echo esc_html( $num_bartenders ); ?></p>
													</div>
												<?php endif; ?>
												<?php if ( $num_servers ) : ?>
													<div class="col-sm-6">
														<strong>Servers</strong>
														<p class="mb-0"><?php echo esc_html( $num_servers ); ?></p>
													</div>
												<?php endif; ?>
											</div>
											<?php if ( $staff_notes ) : ?>
												<hr>
												<strong>Additional Notes</strong>
												<p class="mb-0 mt-1"><?php echo esc_html( $staff_notes ); ?></p>
											<?php endif; ?>
										</div>
									</div>
								<?php endif; ?>

							</div><!-- .col-lg-8 -->


							<!-- ══════════════ RIGHT COLUMN (sidebar info) ══════════════ -->
							<div class="col-lg-4">

								<!-- Status / Type / Categories card -->
								<div class="card mb-4">
									<div class="card-header ulg-card-header">
										<h5 class="mb-0">Event Info</h5>
									</div>
									<ul class="list-group list-group-flush">
										<?php if ( $event_status ) : ?>
											<li class="list-group-item d-flex justify-content-between">
												<strong>Status</strong>
												<span class="badge ulg-status-badge ulg-event-status-<?php echo esc_attr( $event_status ); ?>"><?php echo esc_html( ucfirst( $event_status ) ); ?></span>
											</li>
										<?php endif; ?>
										<?php if ( $event_type ) : ?>
											<li class="list-group-item d-flex justify-content-between">
												<strong>Type</strong>
												<span><?php echo esc_html( ucfirst( $event_type ) ); ?></span>
											</li>
										<?php endif; ?>
										<?php if ( $max_capacity ) : ?>
											<li class="list-group-item d-flex justify-content-between">
												<strong>Capacity</strong>
												<span><?php echo esc_html( $max_capacity ); ?></span>
											</li>
										<?php endif; ?>
										<?php if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) : ?>
											<li class="list-group-item d-flex justify-content-between align-items-start">
												<strong>Categories</strong>
												<span><?php echo esc_html( implode( ', ', $categories ) ); ?></span>
											</li>
										<?php endif; ?>
										<?php if ( ! empty( $tags ) && ! is_wp_error( $tags ) ) : ?>
											<li class="list-group-item">
												<strong class="d-block mb-1">Tags</strong>
												<div class="d-flex flex-wrap gap-1">
													<?php foreach ( $tags as $tag ) : ?>
														<span class="badge bg-secondary"><?php echo esc_html( $tag ); ?></span>
													<?php endforeach; ?>
												</div>
											</li>
										<?php endif; ?>
									</ul>
								</div>

								<!-- Pricing card -->
								<?php if ( $base_price || $deposit ) : ?>
									<div class="card mb-4">
										<div class="card-header ulg-card-header">
											<h5 class="mb-0">Pricing</h5>
										</div>
										<div class="card-body">
											<?php if ( $base_price ) : ?>
												<div class="d-flex justify-content-between mb-2">
													<span>Base Price</span>
													<strong class="ulg-event-price">$<?php echo esc_html( $base_price ); ?></strong>
												</div>
											<?php endif; ?>
											<?php if ( $deposit ) : ?>
												<div class="d-flex justify-content-between">
													<span>Deposit Required</span>
													<strong>$<?php echo esc_html( $deposit ); ?></strong>
												</div>
											<?php endif; ?>
											<?php if ( $ticket_url ) : ?>
												<a href="<?php echo esc_url( $ticket_url ); ?>" class="btn ulg-btn ulg-section-btn w-100 mt-3" target="_blank" rel="noopener noreferrer">
													Tickets / RSVP
												</a>
											<?php endif; ?>
										</div>
									</div>
								<?php endif; ?>

								<!-- Contact card -->
								<?php
								$has_contact = $contact_name || $contact_phone || $contact_email;
								if ( $has_contact ) : ?>
									<div class="card mb-4">
										<div class="card-header ulg-card-header">
											<h5 class="mb-0">Contact</h5>
										</div>
										<div class="card-body">
											<?php if ( $contact_name ) : ?>
												<p class="mb-1"><strong><?php echo esc_html( $contact_name ); ?></strong></p>
											<?php endif; ?>
											<?php if ( $contact_phone ) : ?>
												<p class="mb-1">
													<a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $contact_phone ) ); ?>">
														<?php echo esc_html( $contact_phone ); ?>
													</a>
												</p>
											<?php endif; ?>
											<?php if ( $contact_email ) : ?>
												<p class="mb-0">
													<a href="mailto:<?php echo esc_attr( $contact_email ); ?>">
														<?php echo esc_html( $contact_email ); ?>
													</a>
												</p>
											<?php endif; ?>
										</div>
									</div>
								<?php endif; ?>

								<!-- Special Requests -->
								<?php if ( $special_req ) : ?>
									<div class="card mb-4">
										<div class="card-header ulg-card-header">
											<h5 class="mb-0">Special Requests</h5>
										</div>
										<div class="card-body">
											<p class="mb-0"><?php echo esc_html( $special_req ); ?></p>
										</div>
									</div>
								<?php endif; ?>

							</div><!-- .col-lg-4 -->

						</div><!-- .row -->


						<?php
						if ( function_exists( 'wp_bootstrap_edit_post_link' ) ) {
							wp_bootstrap_edit_post_link(
								sprintf(
									__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'pegasus' ),
									get_the_title()
								),
								'<span class="edit-link">',
								'</span>'
							);
						}
						?>

						<!-- Back to events link -->
						<div class="text-center my-4">
							<a href="<?php echo esc_url( home_url( '/events/' ) ); ?>" class="btn btn-outline-primary">&larr; Back to All Events</a>
						</div>

					</div><!-- .content-no-sidebar -->
				</div><!-- .inner-content -->
			</div><!-- .container -->

		<?php endwhile; else : ?>

			<div class="<?php echo esc_attr( $final_container_class ); ?>">
				<div class="inner-content">
					<div class="content-no-sidebar">
						<div class="page-header">
							<h1>Oh no!</h1>
						</div>
						<p>No content is appearing for this page!</p>
					</div>
				</div>
			</div>

		<?php endif; ?>

	</div><!-- end page wrap -->

<?php get_footer(); ?>
