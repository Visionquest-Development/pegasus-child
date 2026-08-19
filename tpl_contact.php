<?php
/*
	Template Name: Contact
*/

/**
 * Contact page template for The Stout Brothers.
 *
 * Based on the parent "No Sidebar" shell. Hero + form section are CMB2-driven
 * (the form section outputs a Gravity Forms shortcode, or a default message when
 * empty); the "Visit A Tap Room" section is powered by the Locations CPT.
 * Header/footer are theme-managed.
 *
 * @package Pegasus_Child
 */

get_header();

$header_choice = function_exists( 'pegasus_get_option' ) ? pegasus_get_option( 'header_select' ) : '';
if ( 'header-three' === $header_choice ) {
	get_template_part( 'templates/additional_header' );
}

$sb_id = get_queried_object_id();

$sb_hero_image = sb_contact_field( $sb_id, 'hero_image' );
$sb_shortcode  = sb_contact_field( $sb_id, 'form_shortcode' );
$sb_gen_email  = sb_contact_field( $sb_id, 'general_email' );
$sb_gen_phone  = sb_contact_field( $sb_id, 'general_phone' );
?>

<div id="page-wrap">
	<div class="sb-contact">

		<!-- ===== HERO ===== -->
		<header class="sb-contact-hero">
			<?php if ( $sb_hero_image ) : ?>
				<img class="sb-contact-hero-bg" src="<?php echo esc_url( $sb_hero_image ); ?>" alt="">
			<?php endif; ?>
			<span class="sb-contact-hero-overlay" aria-hidden="true"></span>
			<div class="container py-5">
				<div class="row">
					<div class="col-lg-9">
						<p class="sb-kicker mb-3"><?php echo esc_html( sb_contact_field( $sb_id, 'hero_kicker' ) ); ?></p>
						<h1 class="sb-display sb-contact-h1 mb-4"><?php echo esc_html( sb_contact_field( $sb_id, 'hero_heading' ) ); ?></h1>
						<div class="sb-contact-hero-text"><?php echo wpautop( esc_html( sb_contact_field( $sb_id, 'hero_text' ) ) ); ?></div>
					</div>
				</div>
			</div>
		</header>

		<!-- ===== FORM (Gravity Forms shortcode or default) ===== -->
		<section class="sb-contact-form-sec py-5">
			<div class="container py-lg-3">
				<div class="row justify-content-center">
					<div class="col-lg-8">
						<div class="text-center mb-4">
							<p class="sb-kicker mb-2"><?php echo esc_html( sb_contact_field( $sb_id, 'form_kicker' ) ); ?></p>
							<h2 class="sb-display sb-contact-h2"><?php echo esc_html( sb_contact_field( $sb_id, 'form_heading' ) ); ?></h2>
						</div>
						<div class="sb-contact-form-card p-4 p-md-5 rounded-3">
							<?php
							if ( '' !== trim( (string) $sb_shortcode ) ) {
								echo do_shortcode( $sb_shortcode );
							} else {
								echo '<div class="sb-contact-form-note text-center">';
								echo wpautop( esc_html( sb_contact_field( $sb_id, 'form_default_text' ) ) );
								echo '<div class="d-flex flex-wrap justify-content-center gap-3 mt-4">';
								if ( $sb_gen_email ) {
									printf( '<a class="btn sb-btn-gold rounded-1 px-4 py-2" href="%s">Email Us</a>', esc_url( 'mailto:' . $sb_gen_email ) );
								}
								if ( $sb_gen_phone ) {
									printf( '<a class="btn sb-btn-outline rounded-1 px-4 py-2" href="tel:%s">Call Us</a>', esc_attr( preg_replace( '/[^0-9+]/', '', $sb_gen_phone ) ) );
								}
								echo '</div>';
								echo '</div>';
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</section>

		<?php
		/* ===== VISIT A TAP ROOM (Locations CPT) ===== */
		$sb_contact_locs = array();

		$sb_contact_q = new WP_Query( array(
			'post_type'      => 'locations',
			'post_status'    => 'publish',
			'posts_per_page' => -1,
			'orderby'        => 'menu_order title',
			'order'          => 'ASC',
			'no_found_rows'  => true,
		) );

		if ( $sb_contact_q->have_posts() ) {
			while ( $sb_contact_q->have_posts() ) :
				$sb_contact_q->the_post();
				$lid = get_the_ID();
				$p   = 'ulg_location_';

				$lname = get_post_meta( $lid, $p . 'display_name', true );
				if ( '' === trim( (string) $lname ) ) {
					$lname = get_the_title();
				}

				$lstreet  = get_post_meta( $lid, $p . 'street', true );
				$lstreet2 = get_post_meta( $lid, $p . 'street2', true );
				$lcity    = get_post_meta( $lid, $p . 'city', true );
				$lstate   = get_post_meta( $lid, $p . 'state', true );
				$lzip     = get_post_meta( $lid, $p . 'zip', true );
				$lcsz     = trim( $lcity . ( ( $lcity && $lstate ) ? ', ' : ' ' ) . $lstate . ' ' . $lzip );

				$lmaps = get_post_meta( $lid, $p . 'maps_url', true );
				$laddr_q = trim( $lstreet . ' ' . $lcsz );

				$sb_contact_locs[] = array(
					'title'     => $lname,
					'lines'     => array_values( array_filter( array( $lstreet, $lstreet2, $lcsz ), 'strlen' ) ),
					'phone'     => get_post_meta( $lid, $p . 'phone_display', true ),
					'phone_tel' => get_post_meta( $lid, $p . 'phone_tel', true ),
					'email'     => get_post_meta( $lid, $p . 'email', true ),
					'maps'      => $lmaps ? $lmaps : ( $laddr_q ? 'https://maps.google.com/?q=' . rawurlencode( $laddr_q ) : '' ),
					'url'       => get_permalink( $lid ),
				);
			endwhile;
			wp_reset_postdata();
		}

		if ( empty( $sb_contact_locs ) ) {
			$sb_contact_locs = array(
				array( 'title' => 'Smyrna Beer Market', 'lines' => array( '1265 W Spring St., Suite D', 'Smyrna, GA 30080' ), 'phone' => '770.319.8200', 'phone_tel' => '+17703198200', 'email' => '', 'maps' => 'https://maps.google.com/?q=' . rawurlencode( '1265 W Spring St Smyrna GA 30080' ), 'url' => '' ),
				array( 'title' => 'Roswell Beer Market', 'lines' => array( '1186 Canton Street', 'Roswell, GA 30075' ), 'phone' => '678.694.8793', 'phone_tel' => '+16786948793', 'email' => '', 'maps' => 'https://maps.google.com/?q=' . rawurlencode( '1186 Canton Street Roswell GA 30075' ), 'url' => '' ),
				array( 'title' => 'Woodstock Beer Market', 'lines' => array( '240 Chambers Street', 'Woodstock, GA 30188' ), 'phone' => '678.909.5678', 'phone_tel' => '+16789095678', 'email' => '', 'maps' => 'https://maps.google.com/?q=' . rawurlencode( '240 Chambers Street Woodstock GA 30188' ), 'url' => '' ),
			);
		}
		?>
		<section class="sb-contact-locations py-5">
			<div class="container py-lg-3">
				<div class="text-center mb-5">
					<p class="sb-kicker mb-2"><?php echo esc_html( sb_contact_field( $sb_id, 'locations_kicker' ) ); ?></p>
					<h2 class="sb-display sb-contact-h2"><?php echo esc_html( sb_contact_field( $sb_id, 'locations_heading' ) ); ?></h2>
				</div>
				<div class="row g-4">
					<?php foreach ( $sb_contact_locs as $loc ) : ?>
						<div class="col-md-4">
							<div class="sb-contact-loc-card h-100 rounded-3 p-4">
								<h3 class="sb-display h4 mb-3 sb-contact-loc-title">
									<?php if ( ! empty( $loc['url'] ) ) : ?>
										<a class="sb-contact-loc-titlelink" href="<?php echo esc_url( $loc['url'] ); ?>"><?php echo esc_html( $loc['title'] ); ?></a>
									<?php else : ?>
										<?php echo esc_html( $loc['title'] ); ?>
									<?php endif; ?>
								</h3>

								<?php if ( ! empty( $loc['lines'] ) ) : ?>
									<p class="sb-contact-loc-addr mb-3">
										<?php echo esc_html( implode( ', ', $loc['lines'] ) ); ?>
									</p>
								<?php endif; ?>

								<div class="sb-contact-loc-contact mb-3">
									<?php if ( ! empty( $loc['phone'] ) ) : ?>
										<div>
											<?php if ( ! empty( $loc['phone_tel'] ) ) : ?>
												<a href="tel:<?php echo esc_attr( $loc['phone_tel'] ); ?>"><?php echo esc_html( $loc['phone'] ); ?></a>
											<?php else : ?>
												<span><?php echo esc_html( $loc['phone'] ); ?></span>
											<?php endif; ?>
										</div>
									<?php endif; ?>
									<?php if ( ! empty( $loc['email'] ) ) : ?>
										<div><a href="<?php echo esc_url( 'mailto:' . $loc['email'] ); ?>"><?php echo esc_html( $loc['email'] ); ?></a></div>
									<?php endif; ?>
								</div>

								<div class="sb-contact-loc-links d-flex flex-column">
									<?php if ( ! empty( $loc['maps'] ) ) : ?>
										<a href="<?php echo esc_url( $loc['maps'] ); ?>" target="_blank" rel="noopener">Get Directions &rarr;</a>
									<?php endif; ?>
									<?php if ( ! empty( $loc['url'] ) ) : ?>
										<a href="<?php echo esc_url( $loc['url'] ); ?>">View Location &rarr;</a>
									<?php endif; ?>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

	</div><!-- .sb-contact -->
</div><!-- #page-wrap -->

<?php get_footer(); ?>
