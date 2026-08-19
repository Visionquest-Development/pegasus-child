<?php
/*
	Template Name: Home
*/

/**
 * Home page template for The Stout Brothers.
 *
 * Built on the Bootstrap 5 grid/container system. All content is driven by the
 * CMB2 fields registered in inc/cmb2-home-fields.php and falls back to the
 * design defaults until real content is saved. Header/footer are managed by the
 * theme; this template only outputs the home page sections.
 *
 * @package Pegasus_Child
 */

get_header();

$header_choice = function_exists( 'pegasus_get_option' ) ? pegasus_get_option( 'header_select' ) : '';
if ( 'header-three' === $header_choice ) {
	get_template_part( 'templates/additional_header' );
}

$sb_id = get_queried_object_id();
?>

<div id="page-wrap">
	<div class="sb-home">

		<?php
		/* ===================================================================
		 * HERO
		 * =================================================================== */
		$hero_image   = sb_home_field( $sb_id, 'hero_image' );
		$hero_buttons = sb_home_group( $sb_id, 'hero_buttons' );
		?>
		<header class="sb-hero">
			<div class="container py-5">
				<div class="row align-items-center g-5 py-lg-4">
					<div class="col-lg-6">
						<p class="sb-kicker sb-kicker-gold mb-3"><?php echo esc_html( sb_home_field( $sb_id, 'hero_kicker' ) ); ?></p>
						<h1 class="sb-display sb-h1 mb-4">
							<?php echo esc_html( sb_home_field( $sb_id, 'hero_heading_1' ) ); ?><br>
							<span class="sb-gold"><?php echo esc_html( sb_home_field( $sb_id, 'hero_heading_gold' ) ); ?></span><br>
							<?php echo esc_html( sb_home_field( $sb_id, 'hero_heading_2' ) ); ?>
						</h1>
						<img src="https://thestoutbrothers.com/wp-content/uploads/2023/07/yellow-lines-03.png" alt="" class="sb-hero-divider">
						<p class="sb-hero-text"><?php echo esc_html( sb_home_field( $sb_id, 'hero_text' ) ); ?></p>
						<?php sb_home_render_buttons( $hero_buttons ); ?>
					</div>
					<div class="col-lg-6 text-center">
						<?php if ( $hero_image ) : ?>
							<img src="<?php echo esc_url( $hero_image ); ?>" alt="<?php echo esc_attr( get_the_title( $sb_id ) ); ?>" class="img-fluid sb-hero-img">
						<?php endif; ?>
					</div>
				</div>
			</div>
		</header>

		<?php
		/* ===================================================================
		 * THREE LOCATIONS
		 * =================================================================== */
		// Locations are powered by the Locations CPT; fall back to the design
		// defaults (CMB2 group) until locations are published.
		$locations = array();

		$sb_loc_home_q = new WP_Query( array(
			'post_type'      => 'locations',
			'post_status'    => 'publish',
			'posts_per_page' => 3,
			'orderby'        => 'menu_order title',
			'order'          => 'ASC',
			'no_found_rows'  => true,
		) );

		if ( $sb_loc_home_q->have_posts() ) {
			while ( $sb_loc_home_q->have_posts() ) :
				$sb_loc_home_q->the_post();
				$sb_lid = get_the_ID();
				$sb_p   = 'ulg_location_';

				$sb_ltitle = get_post_meta( $sb_lid, $sb_p . 'display_name', true );
				if ( '' === trim( (string) $sb_ltitle ) ) {
					$sb_ltitle = get_the_title();
				}

				$sb_lstreet  = get_post_meta( $sb_lid, $sb_p . 'street', true );
				$sb_lstreet2 = get_post_meta( $sb_lid, $sb_p . 'street2', true );
				$sb_laddress = trim( $sb_lstreet . ( ( $sb_lstreet && $sb_lstreet2 ) ? ', ' : '' ) . $sb_lstreet2 );

				// Image: featured image first, then the card image URL field.
				$sb_limg = has_post_thumbnail( $sb_lid ) ? get_the_post_thumbnail_url( $sb_lid, 'large' ) : '';
				if ( ! $sb_limg ) {
					$sb_limg = get_post_meta( $sb_lid, $sb_p . 'card_background_image', true );
				}

				$sb_lperma = get_permalink( $sb_lid );

				$sb_ltaplist = get_post_meta( $sb_lid, $sb_p . 'taplist_url', true );
				$sb_levents  = get_post_meta( $sb_lid, $sb_p . 'events_url', true );
				$sb_lmaps    = get_post_meta( $sb_lid, $sb_p . 'maps_url', true );

				$locations[] = array(
					'image'      => $sb_limg,
					'title'      => $sb_ltitle,
					'url'        => $sb_lperma,
					'address'    => $sb_laddress,
					'taplist'    => $sb_ltaplist ? $sb_ltaplist : $sb_lperma,
					'events'     => $sb_levents ? $sb_levents : $sb_lperma,
					'directions' => $sb_lmaps ? $sb_lmaps : $sb_lperma,
				);
			endwhile;
			wp_reset_postdata();
		}

		if ( empty( $locations ) ) {
			$locations = sb_home_group( $sb_id, 'locations' );
		}
		?>
		<section class="sb-section-cream py-5">
			<div class="container py-lg-4">
				<div class="text-center mb-5">
					<p class="sb-kicker sb-kicker-amber mb-2"><?php echo esc_html( sb_home_field( $sb_id, 'locations_kicker' ) ); ?></p>
					<h2 class="sb-display sb-h2 mb-3"><?php echo esc_html( sb_home_field( $sb_id, 'locations_heading' ) ); ?></h2>
					<p class="sb-lead-cream mx-auto"><?php echo esc_html( sb_home_field( $sb_id, 'locations_intro' ) ); ?></p>
				</div>
				<div class="row g-4">
					<?php foreach ( $locations as $loc ) : ?>
						<div class="col-md-4">
							<div class="card sb-card-loc h-100 border-0 rounded-3 overflow-hidden">
								<?php if ( ! empty( $loc['image'] ) ) : ?>
									<div class="sb-loc-imgwrap">
										<?php if ( ! empty( $loc['url'] ) ) : ?><a href="<?php echo esc_url( $loc['url'] ); ?>"><?php endif; ?>
										<img src="<?php echo esc_url( $loc['image'] ); ?>" class="card-img-top sb-loc-img" alt="<?php echo esc_attr( isset( $loc['title'] ) ? $loc['title'] : '' ); ?>">
										<?php if ( ! empty( $loc['url'] ) ) : ?></a><?php endif; ?>
									</div>
								<?php endif; ?>
								<div class="card-body p-4">
									<h3 class="sb-display h4 mb-1 sb-loc-title">
										<?php if ( ! empty( $loc['url'] ) ) : ?>
											<a class="sb-loc-title-link" href="<?php echo esc_url( $loc['url'] ); ?>"><?php echo esc_html( isset( $loc['title'] ) ? $loc['title'] : '' ); ?></a>
										<?php else : ?>
											<?php echo esc_html( isset( $loc['title'] ) ? $loc['title'] : '' ); ?>
										<?php endif; ?>
									</h3>
									<p class="mb-3 sb-loc-address"><?php echo esc_html( isset( $loc['address'] ) ? $loc['address'] : '' ); ?></p>
									<div class="d-flex flex-column sb-loc-links">
										<?php if ( ! empty( $loc['taplist'] ) ) : ?>
											<a href="<?php echo esc_url( $loc['taplist'] ); ?>" class="sb-link-gold">Tap List &rarr;</a>
										<?php endif; ?>
										<?php if ( ! empty( $loc['events'] ) ) : ?>
											<a href="<?php echo esc_url( $loc['events'] ); ?>" class="sb-link-gold">Events &rarr;</a>
										<?php endif; ?>
										<?php if ( ! empty( $loc['directions'] ) ) : ?>
											<a href="<?php echo esc_url( $loc['directions'] ); ?>" class="sb-link-gold">Directions &amp; Hours &rarr;</a>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<?php
		/* ===================================================================
		 * FEATURED BREWERIES
		 * =================================================================== */
		$breweries = sb_home_group( $sb_id, 'breweries' );
		?>
		<section class="sb-section-breweries py-5">
			<div class="container py-lg-3 text-center">
				<p class="sb-kicker sb-kicker-gold mb-2"><?php echo esc_html( sb_home_field( $sb_id, 'breweries_kicker' ) ); ?></p>
				<h2 class="sb-display sb-h2-sm mb-5"><?php echo esc_html( sb_home_field( $sb_id, 'breweries_heading' ) ); ?></h2>
				<div class="row align-items-center justify-content-center g-5">
					<?php
					foreach ( $breweries as $brewery ) :
						if ( empty( $brewery['logo'] ) ) {
							continue;
						}
						$brewery_name = isset( $brewery['name'] ) ? $brewery['name'] : '';
						$brewery_url  = isset( $brewery['url'] ) ? $brewery['url'] : '';
						?>
						<div class="col-6 col-md-3">
							<?php if ( $brewery_url ) : ?>
								<a href="<?php echo esc_url( $brewery_url ); ?>">
							<?php endif; ?>
							<img src="<?php echo esc_url( $brewery['logo'] ); ?>" alt="<?php echo esc_attr( $brewery_name ); ?>" class="img-fluid sb-brewery-logo">
							<?php if ( $brewery_url ) : ?>
								</a>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<?php
		/* ===================================================================
		 * EVENTS
		 * =================================================================== */
		$events_image   = sb_home_field( $sb_id, 'events_image' );
		$events_buttons = sb_home_group( $sb_id, 'events_buttons' );
		?>
		<section id="events" class="sb-section-events py-5">
			<div class="container py-lg-4">
				<div class="row align-items-center g-5">
					<div class="col-lg-6">
						<?php if ( $events_image ) : ?>
							<img src="<?php echo esc_url( $events_image ); ?>" alt="<?php echo esc_attr( sb_home_field( $sb_id, 'events_heading' ) ); ?>" class="img-fluid rounded-3 sb-events-img">
						<?php endif; ?>
					</div>
					<div class="col-lg-6">
						<p class="sb-kicker sb-kicker-gold mb-3"><?php echo esc_html( sb_home_field( $sb_id, 'events_kicker' ) ); ?></p>
						<h2 class="sb-display sb-h2 mb-4"><?php echo esc_html( sb_home_field( $sb_id, 'events_heading' ) ); ?></h2>
						<p class="sb-events-text"><?php echo esc_html( sb_home_field( $sb_id, 'events_text' ) ); ?></p>
						<?php sb_home_render_buttons( $events_buttons ); ?>
					</div>
				</div>
			</div>
		</section>

		<?php
		/* ===================================================================
		 * REVIEWS
		 * =================================================================== */
		$reviews = sb_home_group( $sb_id, 'reviews' );
		?>
		<section class="sb-section-reviews py-5">
			<div class="container py-lg-4">
				<div class="text-center mb-5">
					<p class="sb-kicker sb-kicker-gold mb-2"><?php echo esc_html( sb_home_field( $sb_id, 'reviews_kicker' ) ); ?></p>
					<h2 class="sb-display sb-h2">
						<?php echo esc_html( sb_home_field( $sb_id, 'reviews_heading_1' ) ); ?><br>
						<?php echo esc_html( sb_home_field( $sb_id, 'reviews_heading_2' ) ); ?>
					</h2>
				</div>
				<div class="row g-4">
					<?php
					foreach ( $reviews as $review ) :
						$rating = isset( $review['rating'] ) ? (int) $review['rating'] : 5;
						$rating = max( 0, min( 5, $rating ) );
						?>
						<div class="col-md-4">
							<div class="card h-100 border-0 rounded-3 p-4 sb-review-card">
								<div class="sb-stars"><?php echo str_repeat( '&#9733;', $rating ); ?></div>
								<p class="mt-3 mb-4 sb-review-quote"><?php echo esc_html( isset( $review['quote'] ) ? $review['quote'] : '' ); ?></p>
								<div class="mt-auto">
									<span class="sb-display h6 mb-0 d-block sb-review-name"><?php echo esc_html( isset( $review['name'] ) ? $review['name'] : '' ); ?></span>
									<span class="sb-review-loc"><?php echo esc_html( isset( $review['location'] ) ? $review['location'] : '' ); ?></span>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

	</div><!-- .sb-home -->
</div><!-- #page-wrap -->

<?php get_footer(); ?>
