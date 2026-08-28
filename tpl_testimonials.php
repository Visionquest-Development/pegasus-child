<?php
/*
	Template Name: Testimonials Template
*/

/**
 * Testimonials page template for Hart Family of Home Services.
 *
 * Header/footer are handled by the parent theme via get_header()/get_footer().
 *
 * CONTENT MODEL — "default, overridable by CMB2" (see functions.php,
 * "Testimonials Page Content" metabox + hfhs_testi_field()/hfhs_testi_group()):
 * every string ships with a default and is replaced by its CMB2 field when filled.
 *
 * The testimonial SLIDER is NOT CMB2 — it is powered by the pegasus_testimonial
 * custom post type through the theme's [pegasus_testimonial_slider] shortcode, which
 * renders a Slick carousel via the pegasus-carousel plugin. The slider's base CSS
 * lives in that plugin; the child theme only *overrides* its look in style.css
 * (see the "TESTIMONIAL SLIDER OVERRIDES" block) to match the design.
 *
 * The submission form is intentionally left as a placeholder for a Gravity Forms
 * form (drop the shortcode into the "Form Shortcode" field, or a [gravityform] tag).
 */
?>
<?php get_header(); ?>

<?php
	$hero_bg = hfhs_testi_field( 'hero_image', get_stylesheet_directory_uri() . '/images/hero.jpg' );

	// "Three ways to share" cards (repeatable group; falls back to these three).
	$ways = hfhs_testi_group( 'ways', array(
		array(
			'title'      => 'On Our Website',
			'text'       => 'Use our submission form below &mdash; we&rsquo;ll review within 48 hours and publish with your permission.',
			'link_label' => 'Scroll to Form &darr;',
			'link_url'   => '#form',
		),
		array(
			'title'      => 'On Google',
			'text'       => 'Add your review to our Google Business Profile &mdash; the first place new clients check when considering HFHS.',
			'link_label' => 'Leave on Google &rarr;',
			'link_url'   => '#',
		),
		array(
			'title'      => 'On Facebook',
			'text'       => 'Share your experience on our Facebook page &mdash; where our community of clients and friends stays connected.',
			'link_label' => 'Leave on Facebook &rarr;',
			'link_url'   => '#',
		),
	) );

	$form_shortcode = hfhs_testi_field( 'form_shortcode', '' );
?>

<main id="page-wrap" class="hfhs-home hfhs-testi-page">

	<!-- ================= HERO ================= -->
	<section class="hfhs-hero hfhs-testi-hero hfhs-section--dark" id="top" style="background-image: url('<?php echo esc_url( $hero_bg ); ?>');">
		<div class="hfhs-hero__overlay" aria-hidden="true"></div>
		<div class="container hfhs-hero__inner">
			<nav class="hfhs-breadcrumb" aria-label="Breadcrumb">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
				<span aria-hidden="true">/</span>
				<span aria-current="page">Testimonials</span>
			</nav>
			<p class="hfhs-eyebrow hfhs-eyebrow--light"><?php echo esc_html( hfhs_testi_field( 'hero_eyebrow', 'Testimonials' ) ); ?></p>
			<p class="hfhs-eyebrow-script hfhs-eyebrow-script--light"><?php echo esc_html( hfhs_testi_field( 'hero_script', 'What our family of clients says.' ) ); ?></p>
			<h1 class="hfhs-hero__title"><?php echo wp_kses_post( hfhs_testi_field( 'hero_title', 'From the families <em>we&rsquo;ve</em> served.' ) ); ?></h1>
			<p class="hfhs-hero__lead"><?php echo esc_html( hfhs_testi_field( 'hero_text', 'Every name below is a real family, property manager, or community partner who trusted us with their home or building. Their words — not ours.' ) ); ?></p>
		</div>
	</section>

	<!-- ================= TESTIMONIAL SLIDER (pegasus_testimonial CPT) ================= -->
	<section class="hfhs-testi-slider hfhs-section--light">
		<span class="hfhs-testi-slider__mark hfhs-testi-slider__mark--open" aria-hidden="true">&ldquo;</span>
		<span class="hfhs-testi-slider__mark hfhs-testi-slider__mark--close" aria-hidden="true">&rdquo;</span>
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-9 col-xl-8 text-center hfhs-testi-slider__head">
					<p class="hfhs-eyebrow hfhs-eyebrow--line"><?php echo esc_html( hfhs_testi_field( 'slider_eyebrow', 'Reviews' ) ); ?></p>
					<p class="hfhs-eyebrow-script"><?php echo esc_html( hfhs_testi_field( 'slider_script', 'Honest words.' ) ); ?></p>
					<h2 class="hfhs-display hfhs-testi-slider__title"><?php echo wp_kses_post( hfhs_testi_field( 'slider_title', 'From the clients <em>we take care of.</em>' ) ); ?></h2>
					<div class="hfhs-stars" aria-label="5 out of 5 stars">
						<span aria-hidden="true">&#9733; &#9733; &#9733; &#9733; &#9733;</span>
					</div>
				</div>
			</div>

			<div class="row justify-content-center">
				<div class="col-lg-10 col-xl-9">
					<?php
						// Powered by the pegasus_testimonial CPT + pegasus-carousel (Slick).
						// Base styles come from the plugin; the child theme overrides them.
						echo do_shortcode( '[pegasus_testimonial_slider]' );
					?>
				</div>
			</div>
		</div>
	</section>

	<!-- ================= THREE WAYS TO SHARE ================= -->
	<section class="hfhs-ways hfhs-section--white">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-9 col-xl-8 text-center hfhs-ways__head">
					<p class="hfhs-eyebrow"><?php echo esc_html( hfhs_testi_field( 'ways_eyebrow', 'Leave a Review' ) ); ?></p>
					<p class="hfhs-eyebrow-script"><?php echo esc_html( hfhs_testi_field( 'ways_script', 'Your words help other families.' ) ); ?></p>
					<h2 class="hfhs-display hfhs-ways__title"><?php echo wp_kses_post( hfhs_testi_field( 'ways_title', 'Three ways to <em>share your experience.</em>' ) ); ?></h2>
				</div>
			</div>

			<div class="row g-0 hfhs-ways__grid">
				<?php foreach ( $ways as $i => $way ) : ?>
					<div class="col-12 col-md-4">
						<div class="hfhs-way">
							<span class="hfhs-way__num"><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></span>
							<h3 class="hfhs-way__title"><?php echo wp_kses_post( isset( $way['title'] ) ? $way['title'] : '' ); ?></h3>
							<p class="hfhs-way__text"><?php echo wp_kses_post( isset( $way['text'] ) ? $way['text'] : '' ); ?></p>
							<?php if ( ! empty( $way['link_label'] ) ) : ?>
								<a class="hfhs-way__link hfhs-arrow-link" href="<?php echo esc_url( ! empty( $way['link_url'] ) ? $way['link_url'] : '#' ); ?>"><?php echo wp_kses_post( $way['link_label'] ); ?></a>
							<?php endif; ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- ================= SHARE YOUR EXPERIENCE / FORM ================= -->
	<section class="hfhs-share hfhs-section--dark" id="form">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-9 col-xl-8 text-center hfhs-share__head">
					<p class="hfhs-eyebrow hfhs-eyebrow--light"><?php echo esc_html( hfhs_testi_field( 'form_eyebrow', 'Share Your Experience' ) ); ?></p>
					<p class="hfhs-eyebrow-script hfhs-eyebrow-script--light"><?php echo esc_html( hfhs_testi_field( 'form_script', 'From our family to yours.' ) ); ?></p>
					<h2 class="hfhs-display hfhs-share__title"><?php echo wp_kses_post( hfhs_testi_field( 'form_title', 'Worked with us? <em>Tell us about it.</em>' ) ); ?></h2>
					<p class="hfhs-share__lead"><?php echo esc_html( hfhs_testi_field( 'form_text', 'Your words help other families decide who to trust with their home. We review every submission within 48 hours and publish with your permission.' ) ); ?></p>
				</div>
			</div>

			<div class="row justify-content-center">
				<div class="col-lg-9 col-xl-8">
					<div class="hfhs-share__form">
						<?php if ( $form_shortcode ) : ?>
							<?php echo do_shortcode( $form_shortcode ); ?>
						<?php else : ?>
							<div class="hfhs-form-placeholder" role="note">
								<span class="hfhs-form-placeholder__label">Gravity Forms</span>
								<p class="hfhs-form-placeholder__text">The testimonial submission form will be embedded here. Add the Gravity Forms shortcode to the &ldquo;Form Shortcode&rdquo; field on this page once the form is built.</p>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- ================= CTA ================= -->
	<section class="hfhs-cta hfhs-section--dark">
		<div class="container text-center">
			<p class="hfhs-eyebrow-script hfhs-eyebrow-script--light"><?php echo esc_html( hfhs_testi_field( 'cta_script', 'Ready to get started?' ) ); ?></p>
			<h2 class="hfhs-display hfhs-cta__title"><?php echo wp_kses_post( hfhs_testi_field( 'cta_title', 'Become the next name on this page.' ) ); ?></h2>
			<div class="hfhs-cta__actions">
				<a class="hfhs-btn hfhs-btn--solid" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Request a Free Estimate</a>
				<a class="hfhs-btn hfhs-btn--outline-light" href="tel:+14045072579">Call 404-507-2579</a>
			</div>
		</div>
	</section>

</main><!-- end .hfhs-testi-page -->

<?php get_footer(); ?>
