<?php
/**
 * Carriers & private programs as text (no logos until authorization is confirmed).
 */
$carriers = (array) igj_site( 'carriers', array() );
$private  = (array) igj_site( 'private_programs', array() );
?>
<section class="igj-section igj-carriers-text" aria-labelledby="igj-carriers-title">
	<div class="container">
		<div class="igj-section__head text-center">
			<p class="igj-eyebrow"><?php esc_html_e( 'More choices, one conversation', 'pegasus' ); ?></p>
			<h2 id="igj-carriers-title" class="igj-section-title"><?php esc_html_e( 'ACA Marketplace & Private Health Insurance Options', 'pegasus' ); ?></h2>
			<p><?php esc_html_e( 'We help you explore both ACA Marketplace plans and private health insurance, and we explain the differences clearly.', 'pegasus' ); ?></p>
		</div>
		<div class="row g-4">
			<div class="col-lg-7">
				<div class="igj-sidecard h-100">
					<h3 class="igj-sidecard__title"><?php esc_html_e( 'Marketplace carriers we work with', 'pegasus' ); ?></h3>
					<ul class="igj-chips list-unstyled">
						<?php foreach ( $carriers as $c ) : ?>
							<li><?php echo esc_html( $c ); ?></li>
						<?php endforeach; ?>
						<li><?php esc_html_e( 'Other state-specific carriers', 'pegasus' ); ?></li>
					</ul>
					<p class="igj-small mb-0"><?php esc_html_e( 'Carrier appointments vary by state and by agent. Not every carrier is available in every state.', 'pegasus' ); ?></p>
				</div>
			</div>
			<div class="col-lg-5">
				<div class="igj-sidecard h-100">
					<h3 class="igj-sidecard__title"><?php esc_html_e( 'Private health insurance options', 'pegasus' ); ?></h3>
					<ul class="igj-chips list-unstyled">
						<?php foreach ( $private as $c ) : ?>
							<li><?php echo esc_html( $c ); ?></li>
						<?php endforeach; ?>
						<li><?php esc_html_e( 'Other individual, family & employer-group options', 'pegasus' ); ?></li>
					</ul>
					<p class="igj-small mb-0"><?php printf( wp_kses_post( __( 'Private products have different eligibility, underwriting, networks, benefits and state availability, and may not be ACA-compliant major medical coverage. <a href="%s">ACA vs. private health insurance, explained</a>.', 'pegasus' ) ), esc_url( igj_learn_url( 'aca-vs-private-health-insurance' ) ) ); ?></p>
				</div>
			</div>
		</div>
	</div>
</section>
