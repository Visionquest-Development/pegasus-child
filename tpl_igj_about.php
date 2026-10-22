<?php
/*
	Template Name: IGJ About
*/
get_header();
$t   = (array) igj_site( 'testimonials', array() );
$lic = (array) igj_site( 'licenses', array() );
?>
<div id="page-wrap">
<main id="primary" class="site-main igj igj-about">
	<?php
	get_template_part( 'templates/igj-page-hero', null, array(
		'title' => __( 'About Joe Avena', 'pegasus' ),
		'lead'  => __( 'The person behind Insurance Guy Joe, and how he helps people choose health coverage.', 'pegasus' ),
	) );
	?>
	<section class="igj-section">
		<div class="container">
			<div class="row g-4 g-lg-5 align-items-start">
				<div class="col-lg-4">
					<div class="igj-about__photo">
						<?php echo igj_picture( 'joe-avena', array( 'class' => 'igj-rounded' ) ); // phpcs:ignore ?>
						<p class="igj-about__name"><?php echo esc_html( igj_site( 'agent.full_name' ) ); ?></p>
						<p class="igj-about__title"><?php echo esc_html( igj_site( 'agent.job_title' ) ); ?></p>
						<?php echo igj_todo( 'High-resolution headshot (current one is 155×200 px). Confirm job title.' ); // phpcs:ignore ?>
					</div>
				</div>
				<div class="col-lg-8 igj-prose">
					<h2><?php esc_html_e( 'Personal care meets tailored coverage', 'pegasus' ); ?></h2>
					<blockquote class="igj-quote-lead"><p><?php echo esc_html( igj_site( 'agent.bio_from_site' ) ); ?></p><footer>— <?php echo esc_html( igj_site( 'agent.name' ) ); ?></footer></blockquote>
					<p><?php echo igj_todo( 'Joe’s story in his own words: how he got into insurance, years licensed, where he lives and works, family, community involvement.' ); // phpcs:ignore ?></p>

					<h2><?php esc_html_e( 'How Joe works with you', 'pegasus' ); ?></h2>
					<ul class="igj-checklist">
						<li><?php esc_html_e( 'Listens first: your household, budget, doctors, prescriptions and plans for the year', 'pegasus' ); ?></li>
						<li><?php esc_html_e( 'Explains the trade-offs between plan types in plain English', 'pegasus' ); ?></li>
						<li><?php esc_html_e( 'Helps with enrollment and the paperwork for life-event changes', 'pegasus' ); ?></li>
						<li><?php esc_html_e( 'Checks in at renewal time so you’re not stuck in a plan that no longer fits', 'pegasus' ); ?></li>
					</ul>
					<p><?php printf( wp_kses_post( __( 'Joe helps with <a href="%1$s">individual & family plans</a>, <a href="%2$s">self-employed</a> and <a href="%3$s">small business</a> coverage, <a href="%4$s">COBRA alternatives</a>, <a href="%5$s">supplemental</a> and <a href="%6$s">dental & vision</a> insurance, and more.', 'pegasus' ) ), esc_url( igj_service_url( 'individual-family-health-insurance' ) ), esc_url( igj_service_url( 'self-employed-health-insurance' ) ), esc_url( igj_service_url( 'small-business-health-insurance' ) ), esc_url( igj_service_url( 'cobra-alternatives' ) ), esc_url( igj_service_url( 'supplemental-insurance' ) ), esc_url( igj_service_url( 'dental-vision-insurance' ) ) ); ?></p>

					<h2><?php esc_html_e( 'Licensing & affiliation', 'pegasus' ); ?></h2>
					<?php if ( $lic ) : ?>
						<ul>
							<?php foreach ( $lic as $l ) : ?>
								<li><?php echo esc_html( $l['state'] . ' insurance license #' . $l['number'] ); ?></li>
							<?php endforeach; ?>
						</ul>
					<?php else : ?>
						<p><?php echo igj_todo( 'States licensed, license numbers and NPN.' ); // phpcs:ignore ?></p>
					<?php endif; ?>
					<p><?php printf( esc_html__( 'Joe is an agent with %s.', 'pegasus' ), esc_html( igj_site( 'affiliation' ) ) ); ?> <?php echo igj_todo( 'Confirm current affiliation (USHEALTH Advisors vs. independent) and which carriers Joe is appointed with. The old site also listed USHEALTH company awards (Gold Stevie 2017–2020); keep them only if still accurate and permitted.' ); // phpcs:ignore ?></p>

					<?php if ( $t ) : ?>
						<h2><?php esc_html_e( 'What clients say', 'pegasus' ); ?></h2>
						<?php foreach ( $t as $row ) : ?>
							<figure class="igj-testimonial igj-testimonial--inline">
								<blockquote><p>“<?php echo esc_html( $row['quote'] ); ?>”</p></blockquote>
								<figcaption>— <?php echo esc_html( $row['name'] ); ?></figcaption>
							</figure>
						<?php endforeach; ?>
					<?php endif; ?>

					<?php
					while ( have_posts() ) :
						the_post();
						the_content();
					endwhile;
					?>
				</div>
			</div>
		</div>
	</section>
	<?php get_template_part( 'templates/igj-cta-band', null, array( 'title' => __( 'Let’s find your coverage', 'pegasus' ) ) ); ?>
</main>
</div>
<?php get_footer(); ?>
