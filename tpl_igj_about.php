<?php
/*
	Template Name: IGJ About
*/
get_header();
$t = (array) igj_site( 'testimonials', array() );
?>
<div id="page-wrap">
<main id="primary" class="site-main igj igj-about">
	<?php
	get_template_part( 'templates/igj-page-hero', null, array(
		'eyebrow' => __( 'About Insurance Guy Joe Solutions', 'pegasus' ),
		'title'   => __( 'Meet Joe & Dianna Avena', 'pegasus' ),
		'lead'    => __( 'A husband-and-wife team of licensed health insurance professionals in Roswell, Georgia, helping individuals, families and small businesses across multiple states.', 'pegasus' ),
	) );
	?>
	<section class="igj-section">
		<div class="container">
			<div class="row g-4 g-lg-5 align-items-start">
				<div class="col-lg-5">
					<div class="igj-about__photo">
						<?php echo igj_picture( 'joe-dianna-outdoor', array( 'class' => 'igj-rounded igj-shadow', 'eager' => true, 'sizes' => '(min-width: 992px) 40vw, 100vw' ) ); // phpcs:ignore ?>
					</div>
				</div>
				<div class="col-lg-7 igj-prose">
					<h2><?php esc_html_e( 'Personal care meets tailored coverage', 'pegasus' ); ?></h2>
					<p class="igj-lead"><?php esc_html_e( 'Insurance Guy Joe Solutions is a husband-and-wife team. Our business is built around helping people understand their health insurance options and make informed decisions based on their healthcare needs and budget.', 'pegasus' ); ?></p>
					<p><?php esc_html_e( 'We take a personal approach. We want our clients to know that we’re here to help them, not simply sell them a policy. Whether you’re just starting to research coverage or you’re ready to enroll, you can reach out with questions any time.', 'pegasus' ); ?></p>
					<blockquote class="igj-quote-lead"><p><?php echo esc_html( igj_site( 'agent.bio_from_site' ) ); ?></p><footer>— <?php echo esc_html( igj_site( 'agent.name' ) ); ?></footer></blockquote>
					<p><?php esc_html_e( 'We’re based in Roswell, Georgia, and work with clients primarily by phone and online. We serve Roswell, Alpharetta, Johns Creek, East Cobb, Atlanta and all of Georgia, plus clients in the many other states where we’re licensed.', 'pegasus' ); ?></p>
					<p><?php echo igj_todo( 'Joe & Dianna’s story in their own words: how they got into insurance, years licensed, family, community involvement, languages spoken.' ); // phpcs:ignore ?></p>
					<div class="igj-actions">
						<?php echo igj_schedule_button( 'igj-btn--cta' ); // phpcs:ignore ?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="igj-section igj-section--tint" aria-labelledby="igj-team">
		<div class="container">
			<div class="igj-section__head text-center">
				<p class="igj-eyebrow"><?php esc_html_e( 'Your licensed team', 'pegasus' ); ?></p>
				<h2 id="igj-team" class="igj-section-title"><?php esc_html_e( 'Licensing & Marketplace certifications', 'pegasus' ); ?></h2>
				<p><?php esc_html_e( 'Both Joe and Dianna are certified with the Federally Facilitated Marketplace (HealthCare.gov) for the 2027 plan year in applicable states, and with Georgia Access and Get Covered Illinois.', 'pegasus' ); ?></p>
			</div>
			<?php get_template_part( 'templates/igj-agent-cards' ); ?>
		</div>
	</section>

	<?php get_template_part( 'templates/igj-steps', null, array( 'tint' => false, 'heading_id' => 'igj-about-steps' ) ); ?>

	<?php get_template_part( 'templates/igj-states', null, array( 'tint' => true ) ); ?>

	<?php get_template_part( 'templates/igj-carriers' ); ?>

	<?php get_template_part( 'templates/igj-free-services' ); ?>

	<?php if ( $t || trim( get_post_field( 'post_content', get_queried_object_id() ) ) ) : ?>
	<section class="igj-section">
		<div class="container igj-prose igj-prose--narrow">
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
	</section>
	<?php endif; ?>
	<?php get_template_part( 'templates/igj-cta-band', null, array( 'title' => __( 'Let’s find your coverage, together', 'pegasus' ) ) ); ?>
</main>
</div>
<?php get_footer(); ?>
