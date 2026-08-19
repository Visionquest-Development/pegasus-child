<?php
/**
 * Single Location template — Stout Brothers design.
 *
 * Sections (all inside the Bootstrap .container): hero, quick-facts bar, tap
 * list, events, gallery, and directions + hours + map. Content is pulled from
 * the Locations CPT meta and the "Location Page Content" CMB2 groups, falling
 * back to the design defaults until real content is saved. Header/footer are
 * theme-managed.
 *
 * @package Pegasus_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<div id="page-wrap">
	<div class="sb-location">
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();

				$pid = get_the_ID();
				$p   = 'ulg_location_';

				/* --- Core location meta ------------------------------------ */
				$sb_display = get_post_meta( $pid, $p . 'display_name', true );
				if ( '' === trim( (string) $sb_display ) ) {
					$sb_display = get_the_title();
				}

				$sb_street  = get_post_meta( $pid, $p . 'street', true );
				$sb_street2 = get_post_meta( $pid, $p . 'street2', true );
				$sb_city    = get_post_meta( $pid, $p . 'city', true );
				$sb_state   = get_post_meta( $pid, $p . 'state', true );
				$sb_zip     = get_post_meta( $pid, $p . 'zip', true );

				$sb_phone     = get_post_meta( $pid, $p . 'phone_display', true );
				$sb_phone_tel = get_post_meta( $pid, $p . 'phone_tel', true );
				$sb_email     = get_post_meta( $pid, $p . 'email', true );
				$sb_maps_url  = get_post_meta( $pid, $p . 'maps_url', true );
				$sb_res_url   = get_post_meta( $pid, $p . 'reservation_url', true );

				// Address helpers.
				$sb_csz       = trim( $sb_city . ( ( $sb_city && $sb_state ) ? ', ' : ' ' ) . $sb_state . ' ' . $sb_zip );
				$sb_addr_full = trim( $sb_street . ( ( $sb_street && $sb_csz ) ? ', ' : ' ' ) . $sb_csz );
				$sb_loc_label = $sb_city ? ( $sb_city . ( $sb_state ? ', ' . $sb_state : '' ) ) : $sb_display;
				$sb_city_only = $sb_city ? $sb_city : $sb_display;

				// Hero background: featured image, then card image, then default.
				$sb_hero_img = has_post_thumbnail( $pid ) ? get_the_post_thumbnail_url( $pid, 'full' ) : '';
				if ( ! $sb_hero_img ) {
					$sb_hero_img = get_post_meta( $pid, $p . 'card_background_image', true );
				}
				if ( ! $sb_hero_img ) {
					$sb_hero_img = 'https://thestoutbrothers.com/wp-content/uploads/2023/07/woodstock-beer-market.png';
				}

				// Map embed + directions URL.
				$sb_map_q   = rawurlencode( $sb_addr_full ? $sb_addr_full : $sb_display );
				$sb_map_src = 'https://maps.google.com/maps?q=' . $sb_map_q . '&t=&z=15&ie=UTF8&iwloc=&output=embed';
				$sb_dir_url = $sb_maps_url ? $sb_maps_url : ( 'https://maps.google.com/?q=' . $sb_map_q );

				/* --- Section content (CMB2 groups + design defaults) ------- */
				$sb_hero_status  = sb_location_field( $pid, 'hero_status', 'Open Daily' );
				$sb_taplist_full = sb_location_field( $pid, 'taplist_full_url', '#' );

				$sb_quick_facts = sb_location_group_rows( $pid, 'sb_loc_quick_facts', array(
					array( 'value' => '50+', 'label' => 'Beers On Tap' ),
					array( 'value' => '300+', 'label' => 'Bottles & Cans' ),
					array( 'value' => 'Dog', 'label' => 'Friendly Patio' ),
					array( 'value' => 'Growlers', 'label' => 'Filled To-Go' ),
				) );

				$sb_taplist = sb_location_group_rows( $pid, 'sb_loc_taplist', array(
					array( 'name' => 'Drafty Kilt', 'brewery' => 'Monday Night', 'style' => 'Scotch Ale', 'abv' => '5.7%', 'price' => '$7 / pint' ),
					array( 'name' => 'Tropicalia', 'brewery' => 'Creature Comforts', 'style' => 'IPA', 'abv' => '6.6%', 'price' => '$8 / pint' ),
					array( 'name' => 'Pilsner of the People', 'brewery' => 'Halfway Crooks', 'style' => 'Lager', 'abv' => '5.0%', 'price' => '$7 / pint' ),
					array( 'name' => 'Hazy Little Thing', 'brewery' => 'Sierra Nevada', 'style' => 'Hazy IPA', 'abv' => '6.7%', 'price' => '$8 / pint' ),
					array( 'name' => 'Dry Rosé', 'brewery' => 'House Pour', 'style' => 'Wine', 'abv' => '12%', 'price' => '$9 / glass' ),
					array( 'name' => 'Cold Brew Nitro', 'brewery' => 'Non-Alc', 'style' => 'Coffee', 'abv' => '0%', 'price' => '$5 / cup' ),
				) );

				$sb_events = sb_location_group_rows( $pid, 'sb_loc_events', array(
					array( 'day' => '12', 'month' => 'JUL', 'title' => 'Trivia Night', 'time' => '7:00 PM', 'description' => 'Free to play. Win bar tabs & prizes every Wednesday.' ),
					array( 'day' => '19', 'month' => 'JUL', 'title' => 'Food Truck Friday', 'time' => '5:00 PM', 'description' => 'Rotating local trucks parked out front on the patio.' ),
					array( 'day' => '26', 'month' => 'JUL', 'title' => 'Brewery Tap Takeover', 'time' => '6:00 PM', 'description' => 'Meet the brewers & sample limited releases on tap.' ),
				) );

				$sb_hours = sb_location_group_rows( $pid, 'sb_loc_hours', array(
					array( 'label' => 'Mon – Thu', 'time' => '3 PM – 11 PM' ),
					array( 'label' => 'Friday', 'time' => '3 PM – 12 AM' ),
					array( 'label' => 'Saturday', 'time' => '12 PM – 12 AM' ),
					array( 'label' => 'Sunday', 'time' => '12 PM – 9 PM' ),
				) );

				// Gallery from the CPT gallery group; fall back to default images.
				$sb_gallery_rows = get_post_meta( $pid, 'location_gallery', true );
				$sb_gallery      = array();
				if ( is_array( $sb_gallery_rows ) ) {
					foreach ( $sb_gallery_rows as $g ) {
						$g_url = '';
						if ( ! empty( $g['location_gallery_image_id'] ) ) {
							$g_url = wp_get_attachment_image_url( (int) $g['location_gallery_image_id'], 'large' );
						} elseif ( ! empty( $g['location_gallery_image'] ) ) {
							$g_url = $g['location_gallery_image'];
						}
						if ( $g_url ) {
							$sb_gallery[] = array(
								'url' => $g_url,
								'alt' => ! empty( $g['location_gallery_alt_text'] ) ? $g['location_gallery_alt_text'] : ( ! empty( $g['location_gallery_title'] ) ? $g['location_gallery_title'] : $sb_display ),
							);
						}
					}
				}
				if ( empty( $sb_gallery ) ) {
					$sb_gallery = array(
						array( 'url' => 'https://thestoutbrothers.com/wp-content/uploads/2023/07/woodstock-beer-market.png', 'alt' => '' ),
						array( 'url' => 'https://thestoutbrothers.com/wp-content/uploads/2023/10/the-stout-brothers-roswell-events-2.png', 'alt' => '' ),
						array( 'url' => 'https://thestoutbrothers.com/wp-content/uploads/2023/07/smyrna-beer-market.png', 'alt' => '' ),
						array( 'url' => 'https://thestoutbrothers.com/wp-content/uploads/2023/07/roswell-beer-market.png', 'alt' => '' ),
					);
				}
				?>

				<article id="post-<?php echo esc_attr( $pid ); ?>" <?php post_class(); ?>>

					<!-- ===== HERO ===== -->
					<header class="sb-loc-hero">
						<img class="sb-loc-hero-bg" src="<?php echo esc_url( $sb_hero_img ); ?>" alt="">
						<span class="sb-loc-hero-overlay" aria-hidden="true"></span>
						<div class="container py-5">
							<div class="row">
								<div class="col-lg-9">
									<p class="sb-kicker mb-3"><?php echo esc_html( 'The Stout Brothers · ' . $sb_loc_label ); ?></p>
									<h1 class="sb-display sb-loc-hero-title mb-3"><?php echo esc_html( $sb_display ); ?></h1>
									<div class="d-flex flex-wrap align-items-center sb-loc-hero-meta">
										<?php if ( $sb_hero_status ) : ?>
											<span class="sb-loc-status"><span class="sb-loc-dot">&#9679;</span> <?php echo esc_html( $sb_hero_status ); ?></span>
										<?php endif; ?>
										<?php if ( $sb_addr_full ) : ?>
											<span><?php echo esc_html( $sb_addr_full ); ?></span>
										<?php endif; ?>
										<?php if ( $sb_phone ) : ?>
											<?php if ( $sb_phone_tel ) : ?>
												<a class="sb-loc-phone" href="tel:<?php echo esc_attr( $sb_phone_tel ); ?>"><?php echo esc_html( $sb_phone ); ?></a>
											<?php else : ?>
												<span class="sb-loc-phone"><?php echo esc_html( $sb_phone ); ?></span>
											<?php endif; ?>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
					</header>

					<!-- ===== QUICK FACTS BAR ===== -->
					<section class="sb-loc-facts">
						<div class="container">
							<div class="row text-center py-4 g-3">
								<?php foreach ( $sb_quick_facts as $fact ) : ?>
									<div class="col-6 col-md-3">
										<span class="sb-display d-block sb-loc-fact-num"><?php echo esc_html( isset( $fact['value'] ) ? $fact['value'] : '' ); ?></span>
										<span class="sb-loc-fact-label"><?php echo esc_html( isset( $fact['label'] ) ? $fact['label'] : '' ); ?></span>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
					</section>

					<?php if ( trim( get_the_content() ) ) : ?>
						<!-- ===== ABOUT / EDITOR CONTENT ===== -->
						<section class="sb-loc-section sb-loc-body py-5">
							<div class="container py-lg-2">
								<div class="row">
									<div class="col-lg-9"><?php the_content(); ?></div>
								</div>
							</div>
						</section>
					<?php endif; ?>

					<!-- ===== TAP LIST ===== -->
					<section class="sb-loc-section py-5">
						<div class="container py-lg-3">
							<div class="d-flex flex-wrap justify-content-between align-items-end mb-4 sb-loc-gap">
								<div>
									<p class="sb-kicker mb-2">Pouring Today</p>
									<h2 class="sb-display sb-loc-h2">On Tap in <?php echo esc_html( $sb_city_only ); ?></h2>
								</div>
								<span class="sb-loc-note">Updated daily · subject to change</span>
							</div>
							<div class="row g-3">
								<?php foreach ( $sb_taplist as $beer ) : ?>
									<div class="col-lg-6">
										<div class="sb-tap-row d-flex align-items-center justify-content-between p-3 rounded-2">
											<div>
												<span class="sb-display d-block sb-tap-name"><?php echo esc_html( isset( $beer['name'] ) ? $beer['name'] : '' ); ?></span>
												<span class="sb-tap-sub">
													<?php
													$sb_bs = array_filter( array( isset( $beer['brewery'] ) ? $beer['brewery'] : '', isset( $beer['style'] ) ? $beer['style'] : '' ) );
													echo esc_html( implode( ' · ', $sb_bs ) );
													?>
												</span>
											</div>
											<div class="text-end sb-tap-meta">
												<span class="sb-tap-abv"><?php echo esc_html( isset( $beer['abv'] ) ? $beer['abv'] : '' ); ?></span>
												<span class="d-block sb-tap-price"><?php echo esc_html( isset( $beer['price'] ) ? $beer['price'] : '' ); ?></span>
											</div>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
							<div class="text-center mt-4">
								<a href="<?php echo esc_url( $sb_taplist_full ); ?>" class="btn sb-btn-outline rounded-1 px-4 py-2">See Full Tap List</a>
							</div>
						</div>
					</section>

					<!-- ===== EVENTS ===== -->
					<section class="sb-loc-events py-5">
						<div class="container py-lg-3">
							<p class="sb-kicker mb-2">What's On in <?php echo esc_html( $sb_city_only ); ?></p>
							<h2 class="sb-display sb-loc-h2 mb-5">Upcoming Events</h2>
							<div class="row g-4">
								<?php foreach ( $sb_events as $event ) : ?>
									<div class="col-md-4">
										<div class="card h-100 border-0 rounded-3 overflow-hidden sb-event-card">
											<div class="p-4">
												<div class="d-inline-flex flex-column align-items-center justify-content-center rounded-2 mb-3 sb-event-badge">
													<span class="sb-display sb-event-day"><?php echo esc_html( isset( $event['day'] ) ? $event['day'] : '' ); ?></span>
													<span class="sb-event-month"><?php echo esc_html( isset( $event['month'] ) ? $event['month'] : '' ); ?></span>
												</div>
												<h3 class="sb-display h5 mb-2"><?php echo esc_html( isset( $event['title'] ) ? $event['title'] : '' ); ?></h3>
												<p class="mb-0 sb-event-desc">
													<?php
													$sb_ed = array_filter( array( isset( $event['time'] ) ? $event['time'] : '', isset( $event['description'] ) ? $event['description'] : '' ) );
													echo esc_html( implode( ' · ', $sb_ed ) );
													?>
												</p>
											</div>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
					</section>

					<!-- ===== GALLERY ===== -->
					<section class="sb-loc-gallery-sec py-5">
						<div class="container py-lg-3">
							<p class="sb-kicker mb-2 text-center">Inside the Tap Room</p>
							<h2 class="sb-display sb-loc-h2-sm mb-5 text-center">Gallery</h2>
							<div class="row g-3 sb-gallery">
								<?php foreach ( $sb_gallery as $g ) : ?>
									<div class="col-6 col-lg-3">
										<a href="<?php echo esc_url( $g['url'] ); ?>" class="sb-gallery-link">
											<img src="<?php echo esc_url( $g['url'] ); ?>" alt="<?php echo esc_attr( $g['alt'] ); ?>" class="img-fluid w-100">
										</a>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
					</section>

					<!-- ===== DIRECTIONS + HOURS + MAP ===== -->
					<section id="directions" class="sb-loc-section py-5">
						<div class="container py-lg-3">
							<div class="row g-5">
								<div class="col-lg-5">
									<p class="sb-kicker mb-2">Plan Your Visit</p>
									<h2 class="sb-display sb-loc-h2 mb-4">Directions &amp; Hours</h2>

									<?php if ( $sb_addr_full ) : ?>
										<div class="mb-4">
											<h3 class="sb-display h6 sb-loc-subhead mb-2">Address</h3>
											<p class="mb-0 sb-loc-address-text">
												<?php if ( $sb_street ) : ?><?php echo esc_html( $sb_street ); ?><br><?php endif; ?>
												<?php if ( $sb_street2 ) : ?><?php echo esc_html( $sb_street2 ); ?><br><?php endif; ?>
												<?php if ( $sb_csz ) : ?><?php echo esc_html( $sb_csz ); ?><br><?php endif; ?>
												<?php if ( $sb_phone ) : ?><span class="sb-loc-phone"><?php echo esc_html( $sb_phone ); ?></span><?php endif; ?>
											</p>
										</div>
									<?php endif; ?>

									<h3 class="sb-display h6 sb-loc-subhead mb-3">Hours</h3>
									<div class="sb-hours">
										<?php foreach ( $sb_hours as $row ) : ?>
											<div class="d-flex justify-content-between py-2 sb-hours-row">
												<span><?php echo esc_html( isset( $row['label'] ) ? $row['label'] : '' ); ?></span>
												<span class="sb-hours-time"><?php echo esc_html( isset( $row['time'] ) ? $row['time'] : '' ); ?></span>
											</div>
										<?php endforeach; ?>
									</div>

									<div class="d-flex flex-wrap gap-3 mt-4">
										<a href="<?php echo esc_url( $sb_dir_url ); ?>" target="_blank" rel="noopener" class="btn sb-btn-gold rounded-1 px-4 py-2">Get Directions</a>
										<?php if ( $sb_email || $sb_res_url ) : ?>
											<a href="<?php echo $sb_email ? esc_url( 'mailto:' . $sb_email ) : esc_url( $sb_res_url ); ?>" class="btn sb-btn-outline rounded-1 px-4 py-2">Book Private Event</a>
										<?php endif; ?>
									</div>
								</div>
								<div class="col-lg-7">
									<div class="rounded-3 overflow-hidden h-100 sb-loc-map">
										<iframe title="<?php echo esc_attr( 'Map to ' . $sb_display ); ?>" src="<?php echo esc_url( $sb_map_src ); ?>" loading="lazy"></iframe>
									</div>
								</div>
							</div>
						</div>
					</section>

				</article>

				<?php
			endwhile;
		endif;
		?>
	</div><!-- .sb-location -->
</div><!-- #page-wrap -->

<?php get_footer(); ?>
