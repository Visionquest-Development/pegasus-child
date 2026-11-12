<?php
/**
 * "Our Services Are Always Free to You!" band + compensation disclosure (Joe's wording, pending compliance review).
 * Args: compact (bool).
 */
$args = isset( $args ) && is_array( $args ) ? $args : array();
?>
<section class="igj-section igj-free" aria-labelledby="igj-free-title">
	<div class="container">
		<div class="igj-free__box">
			<div class="igj-free__icon" aria-hidden="true"><i class="fa fa-heart"></i></div>
			<div class="igj-free__text">
				<p class="igj-eyebrow"><?php esc_html_e( 'No fees. No pressure.', 'pegasus' ); ?></p>
				<h2 id="igj-free-title" class="igj-section-title"><?php esc_html_e( 'Our Services Are Always Free to You!', 'pegasus' ); ?></h2>
				<p class="igj-free__lead"><?php esc_html_e( 'We help you explore health insurance options, compare plans, understand your benefits, and find coverage that fits your needs and budget — at no additional cost for our services.', 'pegasus' ); ?></p>
				<ul class="igj-free__list list-unstyled">
					<li><i class="fa fa-check" aria-hidden="true"></i> <?php esc_html_e( 'Free consultations', 'pegasus' ); ?></li>
					<li><i class="fa fa-check" aria-hidden="true"></i> <?php esc_html_e( 'Free plan comparisons', 'pegasus' ); ?></li>
					<li><i class="fa fa-check" aria-hidden="true"></i> <?php esc_html_e( 'Free enrollment assistance', 'pegasus' ); ?></li>
					<li><i class="fa fa-check" aria-hidden="true"></i> <?php esc_html_e( 'Free ongoing help with your coverage', 'pegasus' ); ?></li>
				</ul>
				<p class="igj-free__fine"><?php echo esc_html( igj_site( 'compensation_text' ) ); ?> <?php echo igj_todo( 'Compensation wording is Joe’s suggestion; have it reviewed for compliance before launch.' ); // phpcs:ignore ?></p>
			</div>
		</div>
	</div>
</section>
