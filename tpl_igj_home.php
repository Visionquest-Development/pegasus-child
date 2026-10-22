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

	<section class="igj-hero">
		<div class="igj-hero__media" aria-hidden="true">
			<?php echo igj_picture( 'hero-family', array( 'eager' => true, 'alt' => '', 'class' => 'igj-hero__img' ) ); // phpcs:ignore ?>
		</div>
		<div class="container igj-hero__inner">
			<div class="igj-hero__panel">
				<p class="igj-eyebrow"><?php esc_html_e( 'Insurance Guy Joe · Joe Avena, licensed agent', 'pegasus' ); ?></p>
				<h1 class="igj-hero__title"><?php esc_html_e( 'Health insurance for individuals, families, the self-employed & small businesses', 'pegasus' ); ?></h1>
				<p class="igj-hero__lead"><?php esc_html_e( 'Talk to a real person who explains your options in plain English, from ACA Marketplace plans to private coverage, COBRA alternatives and dental & vision.', 'pegasus' ); ?></p>
				<div class="igj-actions">
					<a class="btn igj-btn igj-btn--cta igj-btn--lg" href="<?php echo esc_url( igj_contact_url( 'quote-form' ) ); ?>"><?php esc_html_e( 'Get a Free Quote', 'pegasus' ); ?></a>
					<a class="btn igj-btn igj-btn--outline-light igj-btn--lg" href="tel:<?php echo esc_attr( igj_site( 'phone_e164' ) ); ?>"><i class="fa fa-phone" aria-hidden="true"></i> <?php echo esc_html( igj_site( 'phone_display' ) ); ?></a>
				</div>
				<ul class="igj-hero__trust list-unstyled">
					<li><i class="fa fa-check" aria-hidden="true"></i> <?php esc_html_e( 'No cost to compare plans with an agent', 'pegasus' ); ?></li>
					<li><i class="fa fa-check" aria-hidden="true"></i> <?php esc_html_e( 'One-on-one help, start to finish', 'pegasus' ); ?></li>
					<li><i class="fa fa-check" aria-hidden="true"></i> <?php esc_html_e( 'Open enrollment and life-event changes', 'pegasus' ); ?></li>
				</ul>
			</div>
		</div>
	</section>

	<section class="igj-section" aria-labelledby="igj-who">
		<div class="container">
			<div class="igj-section__head text-center">
				<p class="igj-eyebrow"><?php esc_html_e( 'Who Joe helps', 'pegasus' ); ?></p>
				<h2 id="igj-who" class="igj-section-title"><?php esc_html_e( 'Coverage for where you are in life and work', 'pegasus' ); ?></h2>
			</div>
			<?php get_template_part( 'templates/igj-service-cards', null, array( 'slugs' => array( 'individual-family-health-insurance', 'self-employed-health-insurance', 'small-business-health-insurance', 'aca-marketplace-health-insurance', 'cobra-alternatives', 'early-retiree-health-insurance' ) ) ); ?>
			<p class="text-center mt-4"><a class="btn igj-btn igj-btn--outline" href="<?php echo esc_url( home_url( '/services/' ) ); ?>"><?php esc_html_e( 'See all 13 health insurance services', 'pegasus' ); ?></a></p>
		</div>
	</section>

	<section class="igj-section igj-section--tint" aria-labelledby="igj-steps">
		<div class="container">
			<div class="igj-section__head text-center">
				<p class="igj-eyebrow"><?php esc_html_e( 'How it works', 'pegasus' ); ?></p>
				<h2 id="igj-steps" class="igj-section-title"><?php esc_html_e( 'Three simple steps to the right plan', 'pegasus' ); ?></h2>
			</div>
			<ol class="igj-steps row g-4 list-unstyled">
				<li class="col-md-4 wow fadeInUp"><div class="igj-step"><span class="igj-step__n" aria-hidden="true">1</span><h3><?php esc_html_e( 'Tell Joe about you', 'pegasus' ); ?></h3><p><?php esc_html_e( 'Who needs coverage, your ZIP code, a rough income range, and the doctors and prescriptions you want to keep.', 'pegasus' ); ?></p></div></li>
				<li class="col-md-4 wow fadeInUp" data-wow-delay=".08s"><div class="igj-step"><span class="igj-step__n" aria-hidden="true">2</span><h3><?php esc_html_e( 'Compare real options', 'pegasus' ); ?></h3><p><?php esc_html_e( 'Joe lays out plans side by side: premiums, deductibles, networks and any savings you qualify for, in plain English.', 'pegasus' ); ?></p></div></li>
				<li class="col-md-4 wow fadeInUp" data-wow-delay=".16s"><div class="igj-step"><span class="igj-step__n" aria-hidden="true">3</span><h3><?php esc_html_e( 'Enroll with confidence', 'pegasus' ); ?></h3><p><?php esc_html_e( 'Pick the plan that fits and Joe helps you enroll, then stays your go-to person for questions, renewals and life changes.', 'pegasus' ); ?></p></div></li>
			</ol>
		</div>
	</section>

	<section class="igj-section" aria-labelledby="igj-meet">
		<div class="container">
			<div class="row g-4 g-lg-5 align-items-center">
				<div class="col-lg-5 wow fadeInLeft">
					<div class="igj-meet__media">
						<?php echo igj_picture( 'consultation', array( 'class' => 'igj-rounded', 'sizes' => '(min-width: 992px) 40vw, 100vw' ) ); // phpcs:ignore ?>
						<?php echo igj_picture( 'joe-avena', array( 'class' => 'igj-meet__headshot' ) ); // phpcs:ignore ?>
					</div>
				</div>
				<div class="col-lg-7 wow fadeInRight">
					<p class="igj-eyebrow"><?php esc_html_e( 'Your trusted partner in health coverage', 'pegasus' ); ?></p>
					<h2 id="igj-meet" class="igj-section-title"><?php esc_html_e( 'Meet Joe Avena', 'pegasus' ); ?></h2>
					<blockquote class="igj-quote-lead"><p><?php echo esc_html( igj_site( 'agent.bio_from_site' ) ); ?></p></blockquote>
					<p><?php esc_html_e( 'Health insurance is personal. Joe takes the time to understand your household, your budget and the care you actually use, then helps you choose coverage you understand before you sign up.', 'pegasus' ); ?></p>
					<a class="btn igj-btn igj-btn--outline" href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'More about Joe', 'pegasus' ); ?></a>
				</div>
			</div>
		</div>
	</section>

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
			<p><?php echo igj_todo( 'Confirm permission for this testimonial and add more real client reviews. With 2+ reviews this becomes a pegasus-carousel slider.' ); // phpcs:ignore ?></p>
		</div>
	</section>
	<?php endif; ?>

	<?php if ( igj_site( 'show_carrier_logos' ) ) : ?>
	<section class="igj-section igj-section--carriers" aria-labelledby="igj-carriers">
		<div class="container text-center">
			<h2 id="igj-carriers" class="igj-section-title igj-section-title--sm"><?php esc_html_e( 'Carriers Joe works with', 'pegasus' ); ?></h2>
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
