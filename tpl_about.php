<?php
/*
	Template Name: About
*/

/**
 * About page template for The Stout Brothers.
 *
 * Based on the parent "No Sidebar" template shell (get_header → #page-wrap →
 * get_footer) with the body replaced by the About design sections: hero,
 * "About The Owner", and "Explore Our Locations" (powered by the Locations CPT).
 * Content is CMB2-driven with design defaults. Header/footer are theme-managed.
 *
 * @package Pegasus_Child
 */

get_header();

$header_choice = function_exists( 'pegasus_get_option' ) ? pegasus_get_option( 'header_select' ) : '';
if ( 'header-three' === $header_choice ) {
	get_template_part( 'templates/additional_header' );
}

$sb_id = get_queried_object_id();

$sb_hero_image  = sb_about_field( $sb_id, 'hero_image' );
$sb_owner_image = sb_about_field( $sb_id, 'owner_image' );
?>

<div id="page-wrap">
	<div class="sb-about">

		<!-- ===== HERO ===== -->
		<header class="sb-about-hero">
			<?php if ( $sb_hero_image ) : ?>
				<img class="sb-about-hero-bg" src="<?php echo esc_url( $sb_hero_image ); ?>" alt="">
			<?php endif; ?>
			<span class="sb-about-hero-overlay" aria-hidden="true"></span>
			<div class="container py-5">
				<div class="row">
					<div class="col-lg-10">
						<p class="sb-kicker mb-3"><?php echo esc_html( sb_about_field( $sb_id, 'hero_kicker' ) ); ?></p>
						<h1 class="sb-display sb-about-h1 mb-4"><?php echo esc_html( sb_about_field( $sb_id, 'hero_heading' ) ); ?></h1>
						<div class="sb-about-hero-text"><?php echo wpautop( esc_html( sb_about_field( $sb_id, 'hero_text' ) ) ); ?></div>
					</div>
				</div>
			</div>
		</header>

		<!-- ===== ABOUT THE OWNER ===== -->
		<section class="sb-about-owner py-5">
			<div class="container py-lg-3">
				<div class="row g-5 align-items-center">
					<div class="col-lg-6 order-2 order-lg-1">
						<p class="sb-kicker mb-3"><?php echo esc_html( sb_about_field( $sb_id, 'owner_kicker' ) ); ?></p>
						<h2 class="sb-display sb-about-h2 mb-4"><?php echo esc_html( sb_about_field( $sb_id, 'owner_heading' ) ); ?></h2>
						<div class="sb-about-owner-text"><?php echo wpautop( esc_html( sb_about_field( $sb_id, 'owner_text' ) ) ); ?></div>
					</div>
					<div class="col-lg-6 order-1 order-lg-2">
						<?php if ( $sb_owner_image ) : ?>
							<img src="<?php echo esc_url( $sb_owner_image ); ?>" class="img-fluid rounded-3 sb-about-owner-img" alt="<?php echo esc_attr( sb_about_field( $sb_id, 'owner_heading' ) ); ?>">
						<?php endif; ?>
					</div>
				</div>
			</div>
		</section>

		<?php
		/* ===== EXPLORE OUR LOCATIONS (Locations CPT) ===== */
		$sb_about_locs = array();

		$sb_about_q = new WP_Query( array(
			'post_type'      => 'locations',
			'post_status'    => 'publish',
			'posts_per_page' => 3,
			'orderby'        => 'menu_order title',
			'order'          => 'ASC',
			'no_found_rows'  => true,
		) );

		if ( $sb_about_q->have_posts() ) {
			while ( $sb_about_q->have_posts() ) :
				$sb_about_q->the_post();
				$lid = get_the_ID();
				$p   = 'ulg_location_';

				$lname = get_post_meta( $lid, $p . 'display_name', true );
				if ( '' === trim( (string) $lname ) ) {
					$lname = get_the_title();
				}

				$lstreet  = get_post_meta( $lid, $p . 'street', true );
				$lstreet2 = get_post_meta( $lid, $p . 'street2', true );
				$laddr    = trim( $lstreet . ( ( $lstreet && $lstreet2 ) ? ', ' : '' ) . $lstreet2 );

				$limg = has_post_thumbnail( $lid ) ? get_the_post_thumbnail_url( $lid, 'large' ) : '';
				if ( ! $limg ) {
					$limg = get_post_meta( $lid, $p . 'card_background_image', true );
				}

				$sb_about_locs[] = array(
					'image'   => $limg,
					'title'   => $lname,
					'address' => $laddr,
					'url'     => get_permalink( $lid ),
				);
			endwhile;
			wp_reset_postdata();
		}

		if ( empty( $sb_about_locs ) ) {
			$upl = 'https://thestoutbrothers.com/wp-content/uploads/2023/07/';
			$sb_about_locs = array(
				array( 'image' => $upl . 'smyrna-beer-market.png', 'title' => 'Smyrna Beer Market', 'address' => '1265 W Spring St., Suite D', 'url' => '' ),
				array( 'image' => $upl . 'roswell-beer-market.png', 'title' => 'Roswell Beer Market', 'address' => '1186 Canton Street', 'url' => '' ),
				array( 'image' => $upl . 'woodstock-beer-market.png', 'title' => 'Woodstock Beer Market', 'address' => '240 Chambers Street', 'url' => '' ),
			);
		}
		?>
		<section class="sb-about-locations py-5">
			<div class="container py-lg-3">
				<div class="text-center mb-5">
					<p class="sb-kicker mb-2"><?php echo esc_html( sb_about_field( $sb_id, 'locations_kicker' ) ); ?></p>
					<h2 class="sb-display sb-about-h2"><?php echo esc_html( sb_about_field( $sb_id, 'locations_heading' ) ); ?></h2>
				</div>
				<div class="row g-4">
					<?php foreach ( $sb_about_locs as $loc ) : ?>
						<div class="col-md-4">
							<div class="card sb-about-card h-100 border-0 rounded-3 overflow-hidden">
								<?php if ( ! empty( $loc['image'] ) ) : ?>
									<div class="sb-about-card-imgwrap">
										<?php if ( ! empty( $loc['url'] ) ) : ?><a href="<?php echo esc_url( $loc['url'] ); ?>"><?php endif; ?>
										<img src="<?php echo esc_url( $loc['image'] ); ?>" class="card-img-top sb-about-card-img" alt="<?php echo esc_attr( $loc['title'] ); ?>">
										<?php if ( ! empty( $loc['url'] ) ) : ?></a><?php endif; ?>
									</div>
								<?php endif; ?>
								<div class="card-body p-4 text-center">
									<h3 class="sb-display h4 mb-1 sb-about-card-title"><?php echo esc_html( $loc['title'] ); ?></h3>
									<?php if ( ! empty( $loc['address'] ) ) : ?>
										<p class="mb-3 sb-about-card-addr"><?php echo esc_html( $loc['address'] ); ?></p>
									<?php endif; ?>
									<?php if ( ! empty( $loc['url'] ) ) : ?>
										<a href="<?php echo esc_url( $loc['url'] ); ?>" class="sb-about-card-link">Visit Location &rarr;</a>
									<?php endif; ?>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

	</div><!-- .sb-about -->
</div><!-- #page-wrap -->

<?php get_footer(); ?>
