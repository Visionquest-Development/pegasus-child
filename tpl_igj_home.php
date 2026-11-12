<?php
/*
	Template Name: IGJ Home
*/
get_header();
/* Content: Pages → Home → boxes "01 — Hero" … "09 — Bottom Call-to-Action" (inc/igj-content-defaults.php). */
$hero  = igj_section( 'home', 'hero' );
$who   = igj_section( 'home', 'who' );
$meet  = igj_section( 'home', 'meet' );
$rev   = igj_section( 'home', 'reviews' );
$learn = igj_section( 'home', 'learn' );
$t     = (array) igj_site( 'testimonials', array() );
?>
<div id="page-wrap">
<main id="primary" class="site-main igj igj-home">

	<?php echo igj_oe_banner(); // phpcs:ignore -- Appearance → Customize → Open Enrollment Banner ?>

	<section class="igj-hero igj-hero--split">
		<div class="container igj-hero__inner">
			<div class="row g-4 g-lg-5 align-items-center">
				<div class="col-lg-7 igj-hero__panel">
					<?php if ( $hero['eyebrow'] ) : ?><p class="igj-eyebrow"><?php echo esc_html( $hero['eyebrow'] ); ?></p><?php endif; ?>
					<h1 class="igj-hero__title"><?php echo esc_html( $hero['title'] ); ?></h1>
					<p class="igj-hero__lead"><?php echo wp_kses_post( igj_render( $hero['lead'] ) ); ?></p>
					<div class="igj-actions">
						<?php echo igj_schedule_button( 'igj-btn--cta igj-btn--lg' ); // phpcs:ignore ?>
						<a class="btn igj-btn igj-btn--outline-light igj-btn--lg" href="tel:<?php echo esc_attr( igj_site( 'phone_e164' ) ); ?>"><i class="fa fa-phone" aria-hidden="true"></i> <?php echo esc_html( igj_site( 'phone_display' ) ); ?></a>
					</div>
					<?php if ( $hero['alt_label'] ) : ?>
					<p class="igj-hero__alt"><a href="<?php echo esc_url( igj_contact_url( 'quote-form' ) ); ?>"><?php echo esc_html( $hero['alt_label'] ); ?> <i class="fa fa-angle-right" aria-hidden="true"></i></a></p>
					<?php endif; ?>
					<ul class="igj-hero__trust list-unstyled">
						<?php foreach ( (array) $hero['trust'] as $row ) : ?>
						<li><i class="fa fa-check" aria-hidden="true"></i> <?php echo esc_html( igj_cms_tokens( $row['text'] ) ); ?></li>
						<?php endforeach; ?>
					</ul>
				</div>
				<div class="col-lg-5">
					<div class="igj-hero__photo">
						<?php echo igj_picture( $hero['image'], array( 'eager' => true, 'class' => 'igj-hero__portrait', 'sizes' => '(min-width: 992px) 40vw, 90vw', 'id' => $hero['image_id'] ) ); // phpcs:ignore ?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php get_template_part( 'templates/igj-free-services', null, array( 'c' => igj_section( 'home', 'free' ) ) ); ?>

	<section class="igj-section igj-section--tint" aria-labelledby="igj-who">
		<div class="container">
			<div class="igj-section__head text-center">
				<?php if ( $who['eyebrow'] ) : ?><p class="igj-eyebrow"><?php echo esc_html( $who['eyebrow'] ); ?></p><?php endif; ?>
				<h2 id="igj-who" class="igj-section-title"><?php echo esc_html( $who['title'] ); ?></h2>
			</div>
			<?php get_template_part( 'templates/igj-service-cards', null, array( 'slugs' => array_values( array_filter( wp_list_pluck( (array) $who['cards'], 'service' ) ) ) ) ); ?>
			<?php if ( $who['button_label'] ) : ?>
			<p class="text-center mt-4"><a class="btn igj-btn igj-btn--outline" href="<?php echo esc_url( igj_cms_url( $who['button_url'] ) ); ?>"><?php echo esc_html( $who['button_label'] ); ?></a></p>
			<?php endif; ?>
		</div>
	</section>

	<?php get_template_part( 'templates/igj-steps', null, array( 'tint' => false, 'c' => igj_section( 'home', 'steps' ) ) ); ?>

	<section class="igj-section igj-section--tint" aria-labelledby="igj-meet">
		<div class="container">
			<div class="row g-4 g-lg-5 align-items-center">
				<div class="col-lg-6 wow fadeInLeft">
					<?php echo igj_picture( $meet['image'], array( 'class' => 'igj-rounded igj-shadow', 'sizes' => '(min-width: 992px) 45vw, 100vw', 'id' => $meet['image_id'] ) ); // phpcs:ignore ?>
				</div>
				<div class="col-lg-6 wow fadeInRight">
					<?php if ( $meet['eyebrow'] ) : ?><p class="igj-eyebrow"><?php echo esc_html( $meet['eyebrow'] ); ?></p><?php endif; ?>
					<h2 id="igj-meet" class="igj-section-title"><?php echo esc_html( $meet['title'] ); ?></h2>
					<p class="igj-lead"><?php echo wp_kses_post( igj_render( $meet['lead'] ) ); ?></p>
					<?php if ( $meet['text'] ) : ?><p><?php echo wp_kses_post( igj_render( $meet['text'] ) ); ?></p><?php endif; ?>
					<ul class="igj-meet__people list-unstyled">
						<?php foreach ( igj_agents() as $a ) : ?>
							<li><?php echo igj_picture( $a['photo'], array( 'class' => 'igj-meet__avatar', 'sizes' => '64px', 'alt' => '', 'id' => $a['photo_id'] ?? 0 ) ); // phpcs:ignore ?><span><strong><?php echo esc_html( $a['name'] ); ?></strong><br><?php echo esc_html( $a['job_title'] ); ?></span></li>
						<?php endforeach; ?>
					</ul>
					<?php if ( $meet['button_label'] ) : ?>
					<a class="btn igj-btn igj-btn--outline" href="<?php echo esc_url( igj_cms_url( $meet['button_url'] ) ); ?>"><?php echo esc_html( $meet['button_label'] ); ?></a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>

	<?php get_template_part( 'templates/igj-states', null, array( 'c' => igj_section( 'home', 'states' ) ) ); ?>

	<?php if ( $t ) : ?>
	<section class="igj-section igj-section--brand" aria-labelledby="igj-reviews">
		<div class="container text-center">
			<h2 id="igj-reviews" class="igj-section-title"><?php echo esc_html( $rev['title'] ); ?></h2>
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
					<?php if ( $learn['eyebrow'] ) : ?><p class="igj-eyebrow"><?php echo esc_html( $learn['eyebrow'] ); ?></p><?php endif; ?>
					<h2 id="igj-learn" class="igj-section-title"><?php echo esc_html( $learn['title'] ); ?></h2>
					<?php
					$guide_slugs = array_values( array_filter( wp_list_pluck( (array) $learn['guides'], 'guide' ) ) );
					if ( $guide_slugs ) {
						get_template_part( 'templates/igj-learn-cards', null, array( 'slugs' => $guide_slugs, 'heading_level' => 'h3' ) );
					}
					?>
				</div>
				<div class="col-lg-5">
					<?php get_template_part( 'templates/igj-faq-list', null, array( 'items' => (array) $learn['faq'], 'title' => $learn['faq_title'], 'heading_level' => 'h3' ) ); ?>
					<?php if ( $learn['faq_link_label'] ) : ?>
					<p class="mt-3"><a href="<?php echo esc_url( igj_cms_url( $learn['faq_link_url'] ) ); ?>"><?php echo esc_html( $learn['faq_link_label'] ); ?> <i class="fa fa-angle-right" aria-hidden="true"></i></a></p>
					<?php endif; ?>
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

	<?php get_template_part( 'templates/igj-cta-band', null, array( 'c' => igj_section( 'home', 'cta' ) ) ); ?>

</main>
</div><!-- end page wrap -->
<?php get_footer(); ?>
