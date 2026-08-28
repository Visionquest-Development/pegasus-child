<?php
/*
	Template Name: FAQ Template
*/

/**
 * FAQ page template for Hart Family of Home Services.
 *
 * Header/footer handled by the parent theme via get_header()/get_footer().
 *
 * Fully CMB2-driven ("FAQ Page Content" metabox in functions.php): every string
 * ships with a default and is replaced by its field when filled. The Q&A is a
 * REPEATABLE CMB2 group; this template turns it into the pegasus-accordion
 * plugin's [accordions][accordion …]…[/accordion][/accordions] shortcode, so the
 * accordion behaviour/markup comes from the plugin. The plugin's assets are
 * enqueued for this template in functions.php (hfhs_faq_enqueue_accordion); its
 * base CSS stays in the plugin and style.css only overrides the look.
 */
?>
<?php get_header(); ?>

<?php
	$hero_bg = hfhs_faq_field( 'hero_image', get_stylesheet_directory_uri() . '/images/hero.jpg' );

	$intro_body_default =
		'<p>We&rsquo;ve compiled the questions homeowners, property managers, and HOA boards ask us most. Browse them here &mdash; or if you&rsquo;d rather talk to a real person, pick up the phone. We actually answer.</p>' .
		'<p>We&rsquo;re a family-owned business, and we treat every call the way we&rsquo;d want our own family treated.</p>';
	$intro_phone = hfhs_faq_field( 'intro_phone', '404-507-2579' );

	// Repeatable Q&A (falls back to these defaults until edited on the FAQ page).
	$faqs = hfhs_faq_group( 'faqs', array(
		array( 'question' => 'How much should I expect to pay?', 'answer' => 'Every project is priced individually after a free, no-obligation estimate. You get a written quote before any work begins — no surprises and no change-order games. Cost depends on scope, materials, and access, and we&rsquo;ll walk you through every line.' ),
		array( 'question' => 'What areas do you service?', 'answer' => 'We serve homeowners, property managers, and HOA communities across the Greater Atlanta area. Not sure if you&rsquo;re in our service area? Give us a call and we&rsquo;ll let you know honestly.' ),
		array( 'question' => 'Are you licensed and insured?', 'answer' => 'Yes. Hart Family of Home Services is fully licensed and insured across all of our services, and we&rsquo;re active members of BNI and the local business community.' ),
		array( 'question' => 'Do you offer a warranty?', 'answer' => 'Yes. Two-to-five year warranties are standard on our work, with lifetime coverage on select products. If something isn&rsquo;t right, we come back and make it right.' ),
		array( 'question' => 'How do you communicate project updates?', 'answer' => 'We document every project with photos before, during, and after — so you always know exactly what we did and why, whether you&rsquo;re standing next to us or managing remotely.' ),
		array( 'question' => 'Do you offer seasonal maintenance?', 'answer' => 'Absolutely. From gutter cleaning to weatherproofing and exterior upkeep, we handle recurring seasonal maintenance for homes and HOA communities so you&rsquo;re never juggling multiple contractors.' ),
		array( 'question' => 'What are your hours?', 'answer' => 'Our office hours are Monday–Friday, 9a–6p, with Saturdays by appointment. We&rsquo;re closed Sundays. You can reach us any time at 404-507-2579 and we&rsquo;ll get right back to you.' ),
		array( 'question' => 'How fast will I get an estimate?', 'answer' => 'We aim to get you a written estimate quickly — usually within a couple of business days of your request, and often sooner for smaller jobs. Reach out and we&rsquo;ll schedule a visit.' ),
		array( 'question' => 'What if my project doesn&rsquo;t fit one of your nine services?', 'answer' => 'Ask us anyway. Between our nine core services and our custom-project work — saunas, pergolas, chicken coops, and more — there&rsquo;s a good chance we can build it. If we&rsquo;re not the right fit, we&rsquo;ll point you to someone who is.' ),
		array( 'question' => 'Can I request a specific team member?', 'answer' => 'Of course. We&rsquo;re a family-owned team and we&rsquo;re happy to send the person you&rsquo;re most comfortable with whenever scheduling allows. Just let us know.' ),
	) );

	// Build the pegasus-accordion shortcode from the Q&A group.
	$accordion_sc = '[accordions]';
	foreach ( $faqs as $i => $faq ) {
		$q = isset( $faq['question'] ) ? trim( wp_strip_all_tags( $faq['question'] ) ) : '';
		$a = isset( $faq['answer'] ) ? trim( $faq['answer'] ) : '';
		if ( '' === $q ) {
			continue;
		}
		// Title is a shortcode attribute: neutralise quotes/brackets so parsing is safe.
		$q_attr = str_replace( array( '"', '[', ']' ), array( '&#34;', '&#91;', '&#93;' ), $q );
		$accordion_sc .= '[accordion id="' . ( $i + 1 ) . '" title="' . $q_attr . '"]' . wp_kses_post( $a ) . '[/accordion]';
	}
	$accordion_sc .= '[/accordions]';
?>

<main id="page-wrap" class="hfhs-home hfhs-faq-page">

	<!-- ================= HERO ================= -->
	<section class="hfhs-hero hfhs-faq-hero hfhs-section--dark" id="top" style="background-image: url('<?php echo esc_url( $hero_bg ); ?>');">
		<div class="hfhs-hero__overlay" aria-hidden="true"></div>
		<div class="container hfhs-hero__inner wow fadeInUp" data-wow-duration="1s">
			<nav class="hfhs-breadcrumb" aria-label="Breadcrumb">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
				<span aria-hidden="true">/</span>
				<span aria-current="page">FAQ</span>
			</nav>
			<p class="hfhs-eyebrow hfhs-eyebrow--light"><?php echo esc_html( hfhs_faq_field( 'hero_eyebrow', 'Frequently Asked' ) ); ?></p>
			<p class="hfhs-eyebrow-script hfhs-eyebrow-script--light"><?php echo esc_html( hfhs_faq_field( 'hero_script', 'Everything you need to know first.' ) ); ?></p>
			<h1 class="hfhs-hero__title"><?php echo wp_kses_post( hfhs_faq_field( 'hero_title', 'Answers, <em>before the first call.</em>' ) ); ?></h1>
			<p class="hfhs-hero__lead"><?php echo esc_html( hfhs_faq_field( 'hero_text', 'The questions we hear most often — about pricing, service area, warranty, how we communicate, and what to expect. If your question isn’t here, give us a call.' ) ); ?></p>
		</div>
	</section>

	<!-- ================= FAQ ================= -->
	<section class="hfhs-faq hfhs-section--white">
		<div class="container">
			<div class="row g-5">
				<div class="col-lg-5 hfhs-faq__intro wow fadeInUp" data-wow-duration="0.9s">
					<p class="hfhs-eyebrow"><?php echo esc_html( hfhs_faq_field( 'intro_eyebrow', 'Got a Question?' ) ); ?></p>
					<p class="hfhs-eyebrow-script hfhs-faq__script"><?php echo esc_html( hfhs_faq_field( 'intro_script', 'Plainly put.' ) ); ?></p>
					<h2 class="hfhs-display hfhs-faq__title"><?php echo wp_kses_post( hfhs_faq_field( 'intro_title', 'Honest answers <em>to the questions that matter.</em>' ) ); ?></h2>
					<div class="hfhs-faq__body"><?php echo wp_kses_post( wpautop( hfhs_faq_field( 'intro_body', $intro_body_default ) ) ); ?></div>
					<?php if ( $intro_phone ) : ?>
						<p class="hfhs-faq__call">
							<span class="hfhs-faq__call-label">Or call us:</span>
							<a class="hfhs-faq__call-num" href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $intro_phone ) ); ?>"><?php echo esc_html( $intro_phone ); ?></a>
						</p>
					<?php endif; ?>
				</div>
				<div class="col-lg-7 hfhs-faq__list wow fadeInUp" data-wow-duration="0.9s" data-wow-delay="0.15s">
					<?php echo do_shortcode( $accordion_sc ); ?>
				</div>
			</div>
		</div>
	</section>

	<!-- ================= CTA ================= -->
	<section class="hfhs-cta hfhs-section--dark">
		<div class="container text-center wow fadeInUp" data-wow-duration="0.9s">
			<p class="hfhs-eyebrow-script hfhs-eyebrow-script--light"><?php echo esc_html( hfhs_faq_field( 'cta_script', 'Still have questions?' ) ); ?></p>
			<h2 class="hfhs-display hfhs-cta__title"><?php echo wp_kses_post( hfhs_faq_field( 'cta_title', 'Give us a call. We actually answer.' ) ); ?></h2>
			<div class="hfhs-cta__actions">
				<a class="hfhs-btn hfhs-btn--solid" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Request a Free Estimate</a>
				<a class="hfhs-btn hfhs-btn--outline-light" href="tel:+14045072579">Call 404-507-2579</a>
			</div>
		</div>
	</section>

</main><!-- end .hfhs-faq-page -->

<?php get_footer(); ?>
