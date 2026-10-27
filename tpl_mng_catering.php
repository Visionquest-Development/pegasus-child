<?php
/*
	Template Name: MNG Catering
*/
get_header();
$site = mng_data( 'site' );
$cat  = $site['catering'] ?? array();
$mail = 'mailto:' . ( $site['email'] ?? '' ) . '?subject=' . rawurlencode( 'Catering inquiry' ) . '&body=' . rawurlencode( "Event date:\nEvent type:\nNumber of guests:\nLocation:\nWhat you'd like on the menu:\n" );
?>
<div id="page-wrap">
<main id="primary" class="site-main mng mng-catering">
	<?php get_template_part( 'templates/mng-page-hero', null, array( 'image' => 'smoker-racks', 'eyebrow' => __( 'We feed EVERYBODY', 'pegasus' ), 'title' => get_the_title(), 'lead' => __( 'Soul food and BBQ catering for weddings, reunions, corporate events and seafood boils.', 'pegasus' ) ) ); ?>

	<section class="mng-intro">
		<div class="container">
			<div class="row justify-content-center text-center">
				<div class="col-lg-8">
					<h2 class="mng-section-title wow fadeInUp"><?php esc_html_e( 'Make Every Event Unforgettable', 'pegasus' ); ?></h2>
					<p class="mng-lead wow fadeInUp"><?php echo esc_html( $cat['intro'] ?? '' ); ?></p>
					<?php
					while ( have_posts() ) :
						the_post();
						the_content();
					endwhile;
					?>
				</div>
			</div>
			<div class="row g-4 mt-2">
				<?php foreach ( (array) ( $cat['features'] ?? array() ) as $i => $f ) : ?>
					<div class="col-md-4">
						<div class="mng-pillar mng-pillar--light wow fadeInUp" data-wow-delay="<?php echo esc_attr( ( $i * 0.1 ) . 's' ); ?>">
							<i class="fa <?php echo esc_attr( $f['icon'] ); ?>" aria-hidden="true"></i>
							<h3 class="mng-pillar__title"><?php echo esc_html( $f['title'] ); ?></h3>
							<p><?php echo esc_html( $f['text'] ); ?></p>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="mng-split mng-split--dark">
		<div class="container">
			<div class="row g-4 g-lg-5 align-items-center">
				<div class="col-lg-6 wow fadeInLeft">
					<h2 class="mng-section-title"><?php esc_html_e( 'Perfect For', 'pegasus' ); ?></h2>
					<ul class="mng-tags">
						<?php foreach ( (array) ( $cat['occasions'] ?? array() ) as $o ) : ?>
							<li><?php echo esc_html( $o ); ?></li>
						<?php endforeach; ?>
					</ul>
					<?php if ( ! empty( $cat['recent'] ) ) : ?>
						<h3 class="mng-subtitle"><?php esc_html_e( 'Recently on the menu', 'pegasus' ); ?></h3>
						<ul class="mng-checks"><?php foreach ( $cat['recent'] as $r ) : ?><li><?php echo esc_html( $r ); ?></li><?php endforeach; ?></ul>
					<?php endif; ?>
				</div>
				<div class="col-lg-6 wow fadeInRight">
					<div class="mng-photo-pair">
						<?php echo mng_picture( 'smoked-brisket', array( 'class' => 'mng-rounded', 'sizes' => '(min-width: 992px) 25vw, 60vw' ) ); // phpcs:ignore ?>
						<?php echo mng_picture( 'smoked-tray', array( 'class' => 'mng-rounded', 'sizes' => '(min-width: 992px) 20vw, 50vw' ) ); // phpcs:ignore ?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="mng-order" id="inquiry" aria-labelledby="mng-cat-cta">
		<div class="container">
			<div class="row align-items-center g-4">
				<div class="col-lg-6 wow fadeInLeft">
					<p class="mng-script mng-order__eyebrow"><?php esc_html_e( 'Let\'s talk food', 'pegasus' ); ?></p>
					<h2 id="mng-cat-cta" class="mng-order__title"><?php esc_html_e( 'Get a Catering Quote', 'pegasus' ); ?></h2>
					<p class="mng-order__text"><?php esc_html_e( 'Tell us your date, headcount and location and Chef Darrell will put together a menu for your crowd.', 'pegasus' ); ?></p>
				</div>
				<div class="col-lg-6 wow fadeInRight">
					<div class="mng-order__buttons">
						<a class="btn mng-btn mng-btn--fire" href="tel:<?php echo esc_attr( $site['phone_e164'] ?? '' ); ?>"><i class="fa fa-phone" aria-hidden="true"></i> <?php esc_html_e( 'Call', 'pegasus' ); ?> <span class="mng-btn__sub"><?php echo esc_html( $site['phone_display'] ?? '' ); ?></span></a>
						<a class="btn mng-btn mng-btn--outline" href="<?php echo esc_attr( $mail ); ?>"><i class="fa fa-envelope" aria-hidden="true"></i> <?php esc_html_e( 'Email Us', 'pegasus' ); ?></a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="mng-gallery-strip" aria-label="<?php esc_attr_e( 'Catering photos', 'pegasus' ); ?>">
		<div class="mng-gallery-strip__track" data-mng-carousel>
			<?php foreach ( array( 'smoker-meats', 'ribs-on-grill', 'smoked-chicken-2', 'brisket-bark', 'smoked-wings', 'pork-shoulder', 'rib-plate', 'bbq-collage' ) as $g ) : ?>
				<div class="mng-gallery-strip__item"><?php echo mng_picture( $g, array( 'sizes' => '(min-width: 992px) 25vw, 70vw' ) ); // phpcs:ignore ?></div>
			<?php endforeach; ?>
		</div>
	</section>
</main>
</div>
<?php get_footer(); ?>
