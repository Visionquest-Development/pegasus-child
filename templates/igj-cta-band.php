<?php
/**
 * Conversion band: heading (H2), short text, Call + Quote buttons.
 * Args: title, text.
 */
$args  = isset( $args ) && is_array( $args ) ? $args : array();
$title = $args['title'] ?? __( 'Ready to compare your options?', 'pegasus' );
$text  = $args['text'] ?? __( 'Tell us a little about your situation and we’ll walk you through plans that fit your budget, your doctors and your timeline. Our services are always free to you. No pressure, no obligation.', 'pegasus' );
?>
<section class="igj-cta-band" aria-labelledby="igj-cta-<?php echo esc_attr( md5( $title ) ); ?>">
	<div class="container">
		<div class="row align-items-center g-4">
			<div class="col-lg-7 wow fadeInUp">
				<h2 id="igj-cta-<?php echo esc_attr( md5( $title ) ); ?>" class="igj-cta-band__title"><?php echo esc_html( $title ); ?></h2>
				<p class="mb-0"><?php echo esc_html( $text ); ?></p>
			</div>
			<div class="col-lg-5 text-lg-end wow fadeInUp" data-wow-delay=".1s">
				<?php echo igj_schedule_button( 'igj-btn--cta igj-btn--lg' ); // phpcs:ignore ?>
				<a class="btn igj-btn igj-btn--outline-light igj-btn--lg" href="tel:<?php echo esc_attr( igj_site( 'phone_e164' ) ); ?>"><i class="fa fa-phone" aria-hidden="true"></i> <?php echo esc_html( igj_site( 'phone_display' ) ); ?></a>
				<p class="igj-cta-band__alt"><a href="<?php echo esc_url( igj_contact_url( 'quote-form' ) ); ?>"><?php esc_html_e( 'Prefer a form? Request a free quote', 'pegasus' ); ?></a></p>
			</div>
		</div>
	</div>
</section>
