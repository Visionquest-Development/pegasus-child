<?php
/*
	Template Name: IGJ Home
*/
get_header();
$site  = igj_data( 'site' );
$faq   = igj_data( 'faq' );
$teaser = array();
foreach ( (array) ( $faq['groups'] ?? array() ) as $g ) {
	foreach ( $g['items'] as $it ) {
		if ( false === strpos( $it['a'], '{{todo:' ) && count( $teaser ) < 4 ) {
			$teaser[] = $it;
		}
	}
}
$t = (array) ( $site['testimonials'] ?? array() );
?>
<div id="page-wrap">
<main id="primary" class="site-main igj igj-home">

	<?php echo igj_oe_banner(); // phpcs:ignore -- Appearance → Customize → Open Enrollment Banner ?>

	<section class="igj-hero igj-hero--split">
		<div class="container igj-hero__inner">
			<div class="row g-4 g-lg-5 align-items-center">
				<div class="col-lg-7 igj-hero__panel">
					<p class="igj-eyebrow"><?php esc_html_e( 'Insurance Guy Joe Solutions · Joe & Dianna Avena', 'pegasus' ); ?></p>
					<h1 class="igj-hero__title"><?php esc_html_e( 'Health insurance for individuals, families, the self-employed & small businesses', 'pegasus' ); ?></h1>
					<p class="igj-hero__lead"><?php esc_html_e( 'We’re a husband-and-wife team of licensed health insurance professionals. We help you understand your options, from ACA Marketplace plans to private coverage, so you can make an informed decision for your health needs and budget.', 'pegasus' ); ?></p>
					<div class="igj-actions">
						<?php echo igj_schedule_button( 'igj-btn--cta igj-btn--lg' ); // phpcs:ignore ?>
						<a class="btn igj-btn igj-btn--outline-light igj-btn--lg" href="tel:<?php echo esc_attr( igj_site( 'phone_e164' ) ); ?>"><i class="fa fa-phone" aria-hidden="true"></i> <?php echo esc_html( igj_site( 'phone_display' ) ); ?></a>
					</div>
					<p class="igj-hero__alt"><a href="<?php echo esc_url( igj_contact_url( 'quote-form' ) ); ?>"><?php esc_html_e( 'Or request a free quote online', 'pegasus' ); ?> <i class="fa fa-angle-right" aria-hidden="true"></i></a></p>
					<ul class="igj-hero__trust list-unstyled">
						<li><i class="fa fa-check" aria-hidden="true"></i> <?php esc_html_e( 'Our services are always free to you', 'pegasus' ); ?></li>
						<li><i class="fa fa-check" aria-hidden="true"></i> <?php printf( esc_html__( 'Licensed in %d states — and growing', 'pegasus' ), count( (array) igj_site( 'service_area', array() ) ) ); ?></li>
						<li><i class="fa fa-check" aria-hidden="true"></i> <?php esc_html_e( 'ACA Marketplace & private health insurance options', 'pegasus' ); ?></li>
					</ul>
				</div>
				<div class="col-lg-5">
					<div class="igj-hero__photo">
						<?php echo igj_picture( 'joe-dianna-indoor', array( 'eager' => true, 'class' => 'igj-hero__portrait', 'sizes' => '(min-width: 992px) 40vw, 90vw' ) ); // phpcs:ignore ?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php get_template_part( 'templates/igj-free-services' ); ?>

	<section class="igj-section igj-section--tint" aria-labelledby="igj-who">
		<div class="container">
			<div class="igj-section__head text-center">
				<p class="igj-eyebrow"><?php esc_html_e( 'Who we help', 'pegasus' ); ?></p>
				<h2 id="igj-who" class="igj-section-title"><?php esc_html_e( 'Coverage for where you are in life and work', 'pegasus' ); ?></h2>
			</div>
			<?php get_template_part( 'templates/igj-service-cards', null, array( 'slugs' => array( 'individual-family-health-insurance', 'self-employed-health-insurance', 'small-business-health-insurance', 'aca-marketplace-health-insurance', 'private-health-insurance', 'cobra-alternatives' ) ) ); ?>
			<p class="text-center mt-4"><a class="btn igj-btn igj-btn--outline" href="<?php echo esc_url( home_url( '/services/' ) ); ?>"><?php esc_html_e( 'See all 13 health insurance services', 'pegasus' ); ?></a></p>
		</div>
	</section>

	<?php get_template_part( 'templates/igj-steps', null, array( 'tint' => false ) ); ?>

	<section class="igj-section igj-section--tint" aria-labelledby="igj-meet">
		<div class="container">
			<div class="row g-4 g-lg-5 align-items-center">
				<div class="col-lg-6 wow fadeInLeft">
					<?php echo igj_picture( 'joe-dianna-closeup', array( 'class' => 'igj-rounded igj-shadow', 'sizes' => '(min-width: 992px) 45vw, 100vw' ) ); // phpcs:ignore ?>
				</div>
				<div class="col-lg-6 wow fadeInRight">
					<p class="igj-eyebrow"><?php esc_html_e( 'Your trusted partners in health coverage', 'pegasus' ); ?></p>
					<h2 id="igj-meet" class="igj-section-title"><?php esc_html_e( 'Meet Joe & Dianna Avena', 'pegasus' ); ?></h2>
					<p class="igj-lead"><?php esc_html_e( 'Insurance Guy Joe Solutions is a husband-and-wife team based in Roswell, Georgia. Our business is built around helping people understand their health insurance options and make informed decisions based on their healthcare needs and budget.', 'pegasus' ); ?></p>
					<p><?php esc_html_e( 'We take a personal approach. We’re here to help you, not simply sell you a policy, and we work with clients by phone and online.', 'pegasus' ); ?></p>
					<ul class="igj-meet__people list-unstyled">
						<?php foreach ( igj_agents() as $a ) : ?>
							<li><?php echo igj_picture( $a['photo'], array( 'class' => 'igj-meet__avatar', 'sizes' => '64px', 'alt' => '' ) ); // phpcs:ignore ?><span><strong><?php echo esc_html( $a['name'] ); ?></strong><br><?php echo esc_html( $a['job_title'] ); ?></span></li>
						<?php endforeach; ?>
					</ul>
					<a class="btn igj-btn igj-btn--outline" href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'Meet Joe & Dianna', 'pegasus' ); ?></a>
				</div>
			</div>
		</div>
	</section>

	<?php get_template_part( 'templates/igj-states' ); ?>

	<?php if ( $t ) : ?>
	<section class="igj-section igj-section--brand" aria-labelledby="igj-reviews">
		<div class="container text-center">
			<h2 id="igj-reviews" class="igj-section-title"><?php esc_html_e( 'What clients say', 'pegasus' ); ?></h2>
			<div class="igj-testimonials<?php echo count( $t ) > 1 ? ' igj-testimonials--carousel' : ''; ?>">
				<?php foreach ( $t as $row ) : ?>
					<figure class="igj-testimonial">
						<blockquote><p>“<?php echo esc_html( $row['quote'] ); ?>”</p></blockquote>
						<figcaption>— <?php echo esc_html( $row['name'] ); ?></figcaption>
					</figure>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<?php if ( igj_site( 'show_carrier_logos' ) ) : ?>
	<section class="igj-section igj-section--carriers" aria-labelledby="igj-carriers">
		<div class="container text-center">
			<h2 id="igj-carriers" class="igj-section-title igj-section-title--sm"><?php esc_html_e( 'Carriers we work with', 'pegasus' ); ?></h2>
			<?php echo igj_picture( 'carrier-logos', array( 'sizes' => '(min-width: 1100px) 1088px, 100vw' ) ); // phpcs:ignore ?>
		</div>
	</section>
	<?php endif; ?>

	<section class="igj-section igj-section--tint" aria-labelledby="igj-learn">
		<div class="container">
			<div class="row g-4 g-lg-5">
				<div class="col-lg-7">
					<p class="igj-eyebrow"><?php esc_html_e( 'Learn', 'pegasus' ); ?></p>
					<h2 id="igj-learn" class="igj-section-title"><?php esc_html_e( 'Health insurance, explained', 'pegasus' ); ?></h2>
					<?php get_template_part( 'templates/igj-learn-cards', null, array( 'slugs' => array( 'open-enrollment-guide', 'aca-vs-private-health-insurance', 'ppo-vs-hmo-vs-epo' ), 'heading_level' => 'h3' ) ); ?>
				</div>
				<div class="col-lg-5">
					<?php get_template_part( 'templates/igj-faq-list', null, array( 'items' => $teaser, 'title' => __( 'Quick answers', 'pegasus' ), 'heading_level' => 'h3' ) ); ?>
					<p class="mt-3"><a href="<?php echo esc_url( home_url( '/faq/' ) ); ?>"><?php esc_html_e( 'See all FAQs', 'pegasus' ); ?> <i class="fa fa-angle-right" aria-hidden="true"></i></a></p>
				</div>
			</div>
		</div>
	</section>

	<?php
	while ( have_posts() ) :
		the_post();
		if ( trim( get_the_content() ) ) :
			?>
			<section class="igj-section"><div class="container igj-prose"><?php the_content(); ?></div></section>
			<?php
		endif;
	endwhile;
	?>

	<?php get_template_part( 'templates/igj-cta-band' ); ?>

</main>
</div><!-- end page wrap -->
<?php get_footer(); ?>
