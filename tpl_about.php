<?php
/*
	Template Name: About Template
*/

/**
 * About page template for Hart Family of Home Services.
 *
 * Adapted from the parent theme's "No Sidebar Template" (tpl_page-full-width.php).
 * Header and footer are handled by the parent theme via get_header()/get_footer();
 * this template only outputs the About page body.
 *
 * CONTENT MODEL — "default, overridable by CMB2":
 *   Every string/image below ships with a hard-coded default so the page looks
 *   complete out of the box. Each is also wired to a CMB2 field on the About edit
 *   screen (registered in functions.php, "About Page Content" metabox). When an
 *   editor fills a field in, its value replaces the matching default; when a field
 *   is blank, the default shows. See hfhs_about_field() / hfhs_about_group().
 *
 * The Team section is powered by the pegasus_staff custom post type (title = name,
 * featured image = photo, plus the Staff Details CMB2 fields).
 *
 * All styling lives in style.css — no inline CSS (except per-record background
 * images, which are data, not styling).
 */
?>
<?php get_header(); ?>

<?php
	// -------------------------------------------------------------------------
	// Defaults. Each is shown unless the matching CMB2 field is filled in.
	// -------------------------------------------------------------------------
	$hero_bg = hfhs_about_field( 'hero_image', get_stylesheet_directory_uri() . '/images/hero.jpg' );

	$story_img     = hfhs_about_field( 'story_image', get_stylesheet_directory_uri() . '/images/about-josh.jpg' );
	$story_img_alt = hfhs_about_field( 'story_image_alt', 'Josh Hart on a roofing job' );

	$story_body_default =
		'<p>Hart Family of Home Services was founded in 2023 by Josh Hart, carrying forward a family tradition of entrepreneurship that spans his grandfather, uncle, mother, and father. What started as a single-service gutter cleaning operation has grown into a trusted, full-service home care team serving the Greater Atlanta area.</p>' .
		'<p>Today we handle nine distinct services &mdash; from gutters and fencing to custom builds &mdash; for homeowners, property managers, and HOA communities through BNI. Most importantly, we approach every job the same way we approach our own homes: with care, transparency, and a promise to do it right the first time.</p>';

	// Credentials strip (repeatable group; falls back to these three).
	$credentials = hfhs_about_group( 'credentials', array(
		array( 'value' => 'BNI', 'caption' => 'Active Member &mdash; Business Networking International' ),
		array( 'value' => 'Licensed &amp; Insured', 'caption' => 'All Services, Greater Atlanta' ),
		array( 'value' => 'Established 2023', 'caption' => 'Hart Family of Home Services, LLC' ),
	) );

	// Four promises (repeatable group; falls back to these four).
	$promises = hfhs_about_group( 'promises', array(
		array( 'title' => 'Family-Owned, Family-Run', 'text' => 'Every job is overseen by a member of the Hart family. No subcontractor shell games &mdash; the people you meet are the people doing your work.' ),
		array( 'title' => 'Transparent Pricing', 'text' => 'Written estimates before the work begins, itemized invoices after. No surprises, no change-order games, no pressure to commit on the spot.' ),
		array( 'title' => 'Full Documentation', 'text' => 'Photos before, during, and after every project. You&rsquo;ll see exactly what we did and why &mdash; whether you&rsquo;re standing next to us or managing remotely.' ),
		array( 'title' => 'Warranty-Backed Work', 'text' => 'Two-to-five year warranties are standard, with lifetime coverage on select products. If something&rsquo;s not right, we come back and make it right.' ),
	) );

	$house_icon = '<svg class="hfhs-principle__icon" viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M12 30 32 14l20 16"/><path d="M18 28v20h28V28"/><path d="M28 48V36h8v12"/></svg>';
?>

<main id="page-wrap" class="hfhs-home hfhs-about-page">

	<!-- ================= HERO ================= -->
	<section class="hfhs-hero hfhs-about-hero hfhs-section--dark" id="top" style="background-image: url('<?php echo esc_url( $hero_bg ); ?>');">
		<div class="hfhs-hero__overlay" aria-hidden="true"></div>
		<div class="container hfhs-hero__inner wow fadeInUp" data-wow-duration="1s">
			<p class="hfhs-eyebrow-script hfhs-eyebrow-script--light"><?php echo esc_html( hfhs_about_field( 'hero_eyebrow', 'Meet the Hart Family' ) ); ?></p>
			<h1 class="hfhs-hero__title"><?php echo wp_kses_post( hfhs_about_field( 'hero_title', 'Your family of <em>home service</em> providers in Atlanta.' ) ); ?></h1>
			<p class="hfhs-hero__lead"><?php echo esc_html( hfhs_about_field( 'hero_text', 'Founded in 2023, built on trust, integrity, and honesty — serving homeowners, property managers, and HOA communities across Greater Atlanta.' ) ); ?></p>
		</div>
	</section>

	<!-- ================= STORY ================= -->
	<section class="hfhs-story hfhs-section--white">
		<div class="container">
			<div class="row align-items-center g-5">
				<div class="col-lg-5">
					<div class="hfhs-about__media" role="img" aria-label="<?php echo esc_attr( $story_img_alt ); ?>" style="background-image: url('<?php echo esc_url( $story_img ); ?>');">
						<span class="hfhs-frame hfhs-frame--tl" aria-hidden="true"></span>
						<span class="hfhs-frame hfhs-frame--br" aria-hidden="true"></span>
					</div>
				</div>
				<div class="col-lg-7">
					<h2 class="hfhs-display hfhs-story__title"><?php echo wp_kses_post( hfhs_about_field( 'story_title', 'The company <em>began</em> with a single truck and a promise.' ) ); ?></h2>
					<div class="hfhs-story__body">
						<?php echo wp_kses_post( wpautop( hfhs_about_field( 'story_body', $story_body_default ) ) ); ?>
					</div>
					<p class="hfhs-eyebrow-script hfhs-story__sign"><?php echo esc_html( hfhs_about_field( 'story_sign', 'Family Owned. Honest Work. Reliable Results.' ) ); ?></p>
				</div>
			</div>
		</div>
	</section>

	<!-- ================= PRINCIPLE BAND ================= -->
	<section class="hfhs-principle hfhs-section--light">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-10 col-xl-8 text-center wow fadeInUp" data-wow-duration="0.9s">
					<p class="hfhs-eyebrow-script hfhs-principle__eyebrow"><?php echo esc_html( hfhs_about_field( 'principle_eyebrow', 'A simple principle' ) ); ?></p>
					<div class="hfhs-principle__row">
						<span class="hfhs-principle__mark hfhs-principle__mark--l" aria-hidden="true"><?php echo $house_icon; // phpcs:ignore ?></span>
						<h2 class="hfhs-display hfhs-principle__text"><?php echo wp_kses_post( hfhs_about_field( 'principle_text', 'Your home deserves the same care we bring to our own.' ) ); ?></h2>
						<span class="hfhs-principle__mark hfhs-principle__mark--r" aria-hidden="true"><?php echo $house_icon; // phpcs:ignore ?></span>
					</div>
					<span class="hfhs-principle__rule" aria-hidden="true"></span>
				</div>
			</div>
		</div>
	</section>

	<!-- ================= CREDENTIALS STRIP ================= -->
	<section class="hfhs-creds hfhs-section--dark">
		<div class="container">
			<div class="row g-0 hfhs-creds__grid">
				<?php foreach ( $credentials as $cred ) : ?>
					<div class="col-12 col-md-4 hfhs-cred">
						<span class="hfhs-cred__value"><?php echo wp_kses_post( isset( $cred['value'] ) ? $cred['value'] : '' ); ?></span>
						<span class="hfhs-cred__caption"><?php echo wp_kses_post( isset( $cred['caption'] ) ? $cred['caption'] : '' ); ?></span>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- ================= PROMISES ================= -->
	<section class="hfhs-promises hfhs-section--white">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-9 col-xl-8 text-center hfhs-promises__head wow fadeInUp" data-wow-duration="0.9s">
					<p class="hfhs-eyebrow hfhs-eyebrow--line"><?php echo esc_html( hfhs_about_field( 'promises_eyebrow', 'Why Choose Us' ) ); ?></p>
					<h2 class="hfhs-display hfhs-promises__title"><?php echo wp_kses_post( hfhs_about_field( 'promises_title', 'Four promises we <em>refuse to compromise</em> on.' ) ); ?></h2>
				</div>
			</div>

			<div class="row g-0 hfhs-promises__grid">
				<?php foreach ( $promises as $i => $promise ) : ?>
					<div class="col-12 col-md-6 col-lg-3">
						<div class="hfhs-promise wow fadeInUp" data-wow-duration="0.7s" data-wow-delay="<?php echo esc_attr( ( $i % 4 ) * 0.1 ); ?>s">
							<span class="hfhs-promise__num"><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></span>
							<h3 class="hfhs-promise__title"><?php echo wp_kses_post( isset( $promise['title'] ) ? $promise['title'] : '' ); ?></h3>
							<p class="hfhs-promise__text"><?php echo wp_kses_post( isset( $promise['text'] ) ? $promise['text'] : '' ); ?></p>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- ================= TEAM (pegasus_staff CPT) ================= -->
	<section class="hfhs-team hfhs-section--dark" id="team">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-9 col-xl-8 text-center hfhs-team__head wow fadeInUp" data-wow-duration="0.9s">
					<p class="hfhs-eyebrow hfhs-eyebrow--light"><?php echo esc_html( hfhs_about_field( 'team_eyebrow', 'The Team' ) ); ?></p>
					<p class="hfhs-eyebrow-script hfhs-eyebrow-script--light hfhs-team__script"><?php echo esc_html( hfhs_about_field( 'team_script', 'The people who show up.' ) ); ?></p>
					<h2 class="hfhs-display hfhs-team__title"><?php echo wp_kses_post( hfhs_about_field( 'team_title', 'Seven family members. <em>One promise.</em>' ) ); ?></h2>
				</div>
			</div>

			<?php
				$staff = new WP_Query( array(
					'post_type'      => 'pegasus_staff',
					'posts_per_page' => -1,
					'orderby'        => array( 'menu_order' => 'ASC', 'date' => 'ASC' ),
					'no_found_rows'  => true,
				) );
			?>

			<?php if ( $staff->have_posts() ) : ?>
				<div class="row g-4 hfhs-team__grid">
					<?php
						while ( $staff->have_posts() ) :
							$staff->the_post();
							$name    = get_the_title();
							$role    = get_post_meta( get_the_ID(), '_hfhs_staff_role', true );
							$initial = mb_strtoupper( mb_substr( trim( wp_strip_all_tags( $name ) ), 0, 1 ) );
							$bio_raw = get_the_content();
							$has_bio = '' !== trim( wp_strip_all_tags( $bio_raw ) );

							// The three "in their own words" prompts from the design. Each shows the
							// staff member's answer when filled in, otherwise the italic question as a
							// placeholder. A member with a written bio (post content) shows that instead.
							$staff_prompts = array(
								array( 'val' => get_post_meta( get_the_ID(), '_hfhs_staff_project', true ), 'q' => 'Favorite project with HFHS and why?' ),
								array( 'val' => get_post_meta( get_the_ID(), '_hfhs_staff_moment', true ),  'q' => 'Favorite customer moment or experience?' ),
								array( 'val' => get_post_meta( get_the_ID(), '_hfhs_staff_trust', true ),   'q' => 'Why should customers trust you with their home?' ),
							);
					?>
						<div class="col-12 col-sm-6 col-lg-4">
							<article class="hfhs-staff wow fadeInUp" data-wow-duration="0.7s">
								<div class="hfhs-staff__photo">
									<?php if ( has_post_thumbnail() ) : ?>
										<?php the_post_thumbnail( 'medium_large', array( 'class' => 'hfhs-staff__img', 'alt' => esc_attr( $name ) ) ); ?>
									<?php else : ?>
										<span class="hfhs-staff__monogram" aria-hidden="true"><?php echo esc_html( $initial ); ?></span>
									<?php endif; ?>
								</div>
								<div class="hfhs-staff__body">
									<h3 class="hfhs-staff__name"><?php echo esc_html( $name ); ?></h3>
									<?php if ( $role ) : ?>
										<p class="hfhs-staff__role"><?php echo esc_html( $role ); ?></p>
									<?php endif; ?>

									<?php if ( $has_bio ) : ?>
										<div class="hfhs-staff__bio"><?php echo wp_kses_post( wpautop( $bio_raw ) ); ?></div>
									<?php else : ?>
										<?php foreach ( $staff_prompts as $prompt ) : ?>
											<p class="hfhs-staff__line <?php echo $prompt['val'] ? '' : 'is-placeholder'; ?>"><?php echo esc_html( $prompt['val'] ? $prompt['val'] : $prompt['q'] ); ?></p>
										<?php endforeach; ?>
									<?php endif; ?>
								</div>
							</article>
						</div>
					<?php endwhile; ?>
				</div>
			<?php else : ?>
				<p class="hfhs-team__empty text-center">Team members will appear here once Staff entries are added under <strong>Pegasus Staff</strong> in the dashboard.</p>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>
		</div>
	</section>

	<!-- ================= TESTIMONIAL ================= -->
	<section class="hfhs-testimonial hfhs-section--dark">
		<span class="hfhs-testimonial__mark" aria-hidden="true">&ldquo;</span>
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-10 col-xl-8 text-center wow fadeInUp" data-wow-duration="0.9s">
					<p class="hfhs-eyebrow-script hfhs-eyebrow-script--light"><?php echo esc_html( hfhs_about_field( 'testi_script', 'In their own words' ) ); ?></p>
					<p class="hfhs-eyebrow hfhs-eyebrow--light"><?php echo esc_html( hfhs_about_field( 'testi_eyebrow', 'From a Homeowner' ) ); ?></p>
					<blockquote class="hfhs-testimonial__quote">
						<?php echo esc_html( hfhs_about_field( 'testi_quote', 'With Josh and the Hart Family team, they take the time to educate you on what they’re going to do and why they’re doing it, which leaves you feeling better informed on things around your home. We’ve already talked to Josh about their other services because their work is amazing, they’re honest, very reasonably priced, and the customer service is impeccable.' ) ); ?>
					</blockquote>
					<div class="hfhs-stars" aria-label="5 out of 5 stars">
						<span aria-hidden="true">&#9733; &#9733; &#9733; &#9733; &#9733;</span>
					</div>
					<p class="hfhs-testimonial__name"><?php echo esc_html( hfhs_about_field( 'testi_name', 'Paula Dixon' ) ); ?></p>
					<p class="hfhs-testimonial__role"><?php echo esc_html( hfhs_about_field( 'testi_role', 'Homeowner · Greater Atlanta' ) ); ?></p>
				</div>
			</div>
		</div>
	</section>

	<!-- ================= CTA ================= -->
	<section class="hfhs-cta hfhs-section--dark">
		<div class="container text-center wow fadeInUp" data-wow-duration="0.9s">
			<p class="hfhs-eyebrow-script hfhs-eyebrow-script--light"><?php echo esc_html( hfhs_about_field( 'cta_script', 'From our family to yours.' ) ); ?></p>
			<h2 class="hfhs-display hfhs-cta__title"><?php echo wp_kses_post( hfhs_about_field( 'cta_title', 'Ready to work with a team that <em>treats you like family</em>?' ) ); ?></h2>
			<div class="hfhs-cta__actions">
				<a class="hfhs-btn hfhs-btn--solid" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Contact Us</a>
				<a class="hfhs-btn hfhs-btn--outline-light" href="tel:+14045072579">Call 404-507-2579</a>
			</div>
		</div>
	</section>

</main><!-- end .hfhs-about-page -->

<?php get_footer(); ?>
