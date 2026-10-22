<?php
/*
	Template Name: Location & Hours Template
*/
get_header();
$site = rusans_data( 'site' );
$a    = $site['address'] ?? array();
?>
<div id="page-wrap">
<main id="primary" class="site-main rusans rusans-location-page">

	<?php
	get_template_part( 'templates/rusans-page-hero', null, array(
		'image' => 'hero-sashimi-platter',
		'title' => get_the_title() ? get_the_title() : __( 'Hours & Location', 'pegasus' ),
		'lead'  => __( 'On Ernest Barrett Parkway in Kennesaw, only 5 minutes from Kennesaw State University.', 'pegasus' ),
	) );
	?>

	<section class="rusans-location">
		<div class="container">
			<div class="row g-4">
				<div class="col-lg-5">
					<div class="rusans-panel wow fadeInLeft">
						<h2 class="rusans-panel__title"><?php esc_html_e( 'Contact', 'pegasus' ); ?></h2>
						<address class="rusans-location__nap">
							<strong><?php echo esc_html( $site['name'] ?? '' ); ?></strong><br>
							<?php echo esc_html( $a['street'] ?? '' ); ?><br>
							<?php echo esc_html( ( $a['city'] ?? '' ) . ', ' . ( $a['region'] ?? '' ) . ' ' . ( $a['postal'] ?? '' ) ); ?>
						</address>
						<div class="rusans-location__actions">
							<a class="btn rusans-btn rusans-btn--primary" href="tel:<?php echo esc_attr( $site['phone_e164'] ?? '' ); ?>"><i class="fa fa-phone" aria-hidden="true"></i> <?php echo esc_html( $site['phone_display'] ?? '' ); ?></a>
							<a class="btn rusans-btn rusans-btn--outline" href="<?php echo esc_url( $site['maps_url'] ?? '' ); ?>" target="_blank" rel="noopener"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php esc_html_e( 'Directions', 'pegasus' ); ?></a>
							<a class="btn rusans-btn rusans-btn--outline" href="mailto:<?php echo esc_attr( $site['email_catering'] ?? '' ); ?>"><i class="fa fa-envelope" aria-hidden="true"></i> <?php esc_html_e( 'Email us', 'pegasus' ); ?></a>
						</div>
						<p class="mt-3"><?php echo esc_html( $site['reservations']['text'] ?? '' ); ?></p>

						<h2 class="rusans-panel__title mt-4"><?php esc_html_e( 'Restaurant Hours', 'pegasus' ); ?></h2>
						<?php get_template_part( 'templates/rusans-hours' ); ?>
					</div>
				</div>
				<div class="col-lg-7">
					<div class="rusans-map rusans-map--tall wow fadeInRight">
						<iframe title="<?php esc_attr_e( "Map to Ru San's Kennesaw", 'pegasus' ); ?>" src="<?php echo esc_url( $site['maps_embed'] ?? '' ); ?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
					</div>
					<div class="mt-4 wow fadeInUp">
						<?php echo rusans_picture( 'storefront', array( 'class' => 'rusans-rounded', 'sizes' => '(min-width: 992px) 50vw, 100vw' ) ); // phpcs:ignore ?>
					</div>
				</div>
			</div>

			<?php
			/* Page content: drop a contact form shortcode here (TODO: pick a form plugin; the current site's form isn't portable). */
			while ( have_posts() ) :
				the_post();
				if ( trim( get_the_content() ) ) {
					echo '<div class="rusans-location__content mt-5">';
					the_content();
					echo '</div>';
				}
			endwhile;
			?>
		</div>
	</section>

	<?php get_template_part( 'templates/rusans-order-cta' ); ?>

</main>
</div><!-- end page wrap -->
<?php get_footer(); ?>
