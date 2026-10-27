<?php
/*
	Template Name: MNG Contact
*/
get_header();
$site = mng_data( 'site' );
?>
<div id="page-wrap">
<main id="primary" class="site-main mng mng-contact">
	<?php get_template_part( 'templates/mng-page-hero', null, array( 'image' => 'brisket-bark', 'eyebrow' => __( 'We\'d love to hear from you', 'pegasus' ), 'title' => get_the_title(), 'lead' => __( 'Questions about the menu, catering or events? Call, email or stop by.', 'pegasus' ) ) ); ?>

	<section class="mng-contact-cards">
		<div class="container">
			<div class="row g-4">
				<div class="col-md-4 wow fadeInUp">
					<div class="mng-pillar mng-pillar--light"><i class="fa fa-phone" aria-hidden="true"></i><h2 class="mng-pillar__title"><?php esc_html_e( 'Call', 'pegasus' ); ?></h2><p><?php echo mng_phone_link( 'mng-big-link' ); // phpcs:ignore ?></p></div>
				</div>
				<div class="col-md-4 wow fadeInUp" data-wow-delay=".1s">
					<div class="mng-pillar mng-pillar--light"><i class="fa fa-envelope" aria-hidden="true"></i><h2 class="mng-pillar__title"><?php esc_html_e( 'Email', 'pegasus' ); ?></h2><p><a class="mng-big-link" href="mailto:<?php echo esc_attr( $site['email'] ?? '' ); ?>"><?php echo esc_html( $site['email'] ?? '' ); ?></a></p></div>
				</div>
				<div class="col-md-4 wow fadeInUp" data-wow-delay=".2s">
					<div class="mng-pillar mng-pillar--light"><i class="fa fa-map-marker" aria-hidden="true"></i><h2 class="mng-pillar__title"><?php esc_html_e( 'Visit', 'pegasus' ); ?></h2><p><a class="mng-big-link" href="<?php echo esc_url( $site['maps_url'] ?? '' ); ?>" target="_blank" rel="noopener"><?php echo esc_html( mng_address_line() ); ?></a></p></div>
				</div>
			</div>
		</div>
	</section>

	<section class="mng-location">
		<div class="container">
			<div class="row g-4 align-items-stretch">
				<div class="col-lg-5 wow fadeInLeft">
					<h2 class="mng-section-title"><?php esc_html_e( 'Days & Hours', 'pegasus' ); ?></h2>
					<?php get_template_part( 'templates/mng-hours' ); ?>
					<?php
					while ( have_posts() ) :
						the_post();
						if ( trim( get_the_content() ) ) {
							echo '<div class="mng-intro__content mt-3">';
							the_content();
							echo '</div>';
						}
					endwhile;
					?>
					<h2 class="mng-subtitle mt-4"><?php esc_html_e( 'Follow along', 'pegasus' ); ?></h2>
					<ul class="mng-social mng-social--dark">
						<?php foreach ( (array) ( $site['social'] ?? array() ) as $s ) : ?>
							<li><a href="<?php echo esc_url( $s['href'] ); ?>" target="_blank" rel="noopener" aria-label="<?php echo esc_attr( $s['label'] ); ?>"><i class="fa <?php echo esc_attr( $s['icon'] ); ?>" aria-hidden="true"></i></a></li>
						<?php endforeach; ?>
					</ul>
				</div>
				<div class="col-lg-7 wow fadeInRight">
					<div class="mng-map">
						<iframe title="<?php esc_attr_e( 'Map to Mr Nice Guy Authentic Soul Food', 'pegasus' ); ?>" src="<?php echo esc_url( $site['maps_embed'] ?? '' ); ?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>
</div>
<?php get_footer(); ?>
