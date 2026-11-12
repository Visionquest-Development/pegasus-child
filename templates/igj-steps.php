<?php
/**
 * Joe & Dianna's four-step process: Discover, Obtain, Gather, Educate.
 * Args: tint (bool, default true), heading_id.
 */
$args  = isset( $args ) && is_array( $args ) ? $args : array();
$tint  = $args['tint'] ?? true;
$hid   = $args['heading_id'] ?? 'igj-steps';
$steps = array(
	array( 'Discover', 'Seek First to Understand', 'We take time to understand your healthcare needs, preferred providers, prescriptions, financial situation and budget.', 'fa-search' ),
	array( 'Obtain', 'Research Available Options', 'We explore the health insurance options available to you based on your needs and eligibility.', 'fa-list-alt' ),
	array( 'Gather', 'Construct Solutions', 'We identify coverage solutions that line up with your priorities.', 'fa-puzzle-piece' ),
	array( 'Educate', 'Explain the Options', 'We help you understand premiums, deductibles, networks, out-of-pocket costs, benefits and limitations so you can make an informed decision.', 'fa-graduation-cap' ),
);
?>
<section class="igj-section<?php echo $tint ? ' igj-section--tint' : ''; ?>" aria-labelledby="<?php echo esc_attr( $hid ); ?>">
	<div class="container">
		<div class="igj-section__head text-center">
			<p class="igj-eyebrow"><?php esc_html_e( 'How we work with you', 'pegasus' ); ?></p>
			<h2 id="<?php echo esc_attr( $hid ); ?>" class="igj-section-title"><?php esc_html_e( 'Our Four-Step Process', 'pegasus' ); ?></h2>
			<p><?php esc_html_e( 'We’re here to help you, not simply sell you a policy.', 'pegasus' ); ?></p>
		</div>
		<ol class="igj-steps row g-4 list-unstyled">
			<?php foreach ( $steps as $i => $s ) : ?>
				<li class="col-sm-6 col-lg-3 wow fadeInUp"<?php echo $i ? ' data-wow-delay=".' . (int) ( $i * 8 ) . 's"' : ''; ?>>
					<div class="igj-step">
						<span class="igj-step__n" aria-hidden="true"><?php echo (int) ( $i + 1 ); ?></span>
						<h3><span class="igj-step__word"><?php echo esc_html( $s[0] ); ?></span> <span class="igj-step__sub"><?php echo esc_html( $s[1] ); ?></span></h3>
						<p><?php echo esc_html( $s[2] ); ?></p>
					</div>
				</li>
			<?php endforeach; ?>
		</ol>
	</div>
</section>
