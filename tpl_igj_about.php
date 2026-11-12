<?php
/*
	Template Name: IGJ About
*/
get_header();
/* Content: Pages → About → boxes "01 — Page Hero" … "09 — Bottom Call-to-Action". */
$hero  = igj_section( 'about', 'hero' );
$story = igj_section( 'about', 'story' );
$team  = igj_section( 'about', 'team' );
$rev   = igj_section( 'about', 'reviews' );
$t     = (array) igj_site( 'testimonials', array() );
?>
<div id="page-wrap">
<main id="primary" class="site-main igj igj-about">
	<?php
	get_template_part( 'templates/igj-page-hero', null, array(
		'eyebrow' => $hero['eyebrow'],
		'title'   => $hero['title'],
		'lead'    => $hero['lead'],
	) );
	?>
	<section class="igj-section">
		<div class="container">
			<div class="row g-4 g-lg-5 align-items-start">
				<div class="col-lg-5">
					<div class="igj-about__photo">
						<?php echo igj_picture( $story['image'], array( 'class' => 'igj-rounded igj-shadow', 'eager' => true, 'sizes' => '(min-width: 992px) 40vw, 100vw', 'id' => $story['image_id'] ) ); // phpcs:ignore ?>
					</div>
				</div>
				<div class="col-lg-7 igj-prose">
					<h2><?php echo esc_html( $story['title'] ); ?></h2>
					<p class="igj-lead"><?php echo wp_kses_post( igj_render( $story['lead'] ) ); ?></p>
					<?php if ( $story['text'] ) : ?><p><?php echo wp_kses_post( igj_render( $story['text'] ) ); ?></p><?php endif; ?>
					<?php if ( $story['quote'] ) : ?>
					<blockquote class="igj-quote-lead"><p><?php echo esc_html( $story['quote'] ); ?></p><?php if ( $story['quote_by'] ) : ?><footer>— <?php echo esc_html( $story['quote_by'] ); ?></footer><?php endif; ?></blockquote>
					<?php endif; ?>
					<?php if ( $story['local'] ) : ?><p><?php echo wp_kses_post( igj_render( $story['local'] ) ); ?></p><?php endif; ?>
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
				<?php if ( $team['eyebrow'] ) : ?><p class="igj-eyebrow"><?php echo esc_html( $team['eyebrow'] ); ?></p><?php endif; ?>
				<h2 id="igj-team" class="igj-section-title"><?php echo esc_html( $team['title'] ); ?></h2>
				<?php if ( $team['intro'] ) : ?><p><?php echo wp_kses_post( igj_render( $team['intro'] ) ); ?></p><?php endif; ?>
			</div>
			<?php get_template_part( 'templates/igj-agent-cards', null, array( 'c' => $team ) ); ?>
		</div>
	</section>

	<?php get_template_part( 'templates/igj-steps', null, array( 'tint' => false, 'heading_id' => 'igj-about-steps', 'c' => igj_section( 'about', 'steps' ) ) ); ?>

	<?php get_template_part( 'templates/igj-states', null, array( 'tint' => true, 'c' => igj_section( 'about', 'states' ) ) ); ?>

	<?php get_template_part( 'templates/igj-carriers', null, array( 'c' => igj_section( 'about', 'carriers' ) ) ); ?>

	<?php get_template_part( 'templates/igj-free-services', null, array( 'c' => igj_section( 'about', 'free' ) ) ); ?>

	<?php if ( $t || trim( get_post_field( 'post_content', get_queried_object_id() ) ) ) : ?>
	<section class="igj-section">
		<div class="container igj-prose igj-prose--narrow">
			<?php if ( $t ) : ?>
				<h2><?php echo esc_html( $rev['title'] ); ?></h2>
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
	<?php get_template_part( 'templates/igj-cta-band', null, array( 'c' => igj_section( 'about', 'cta' ) ) ); ?>
</main>
</div>
<?php get_footer(); ?>
