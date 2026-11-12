<?php
/**
 * Agent cards for Joe & Dianna: photo, title, NPN, email, licensed states.
 * Args: show_states (bool), heading_level (h2|h3).
 */
$args   = isset( $args ) && is_array( $args ) ? $args : array();
$states = $args['show_states'] ?? true;
$hl     = in_array( $args['heading_level'] ?? 'h3', array( 'h2', 'h3' ), true ) ? ( $args['heading_level'] ?? 'h3' ) : 'h3';
?>
<div class="row g-4 igj-agents">
	<?php foreach ( igj_agents() as $a ) : ?>
		<div class="col-md-6">
			<article class="igj-agent" id="<?php echo esc_attr( $a['id'] ); ?>">
				<div class="igj-agent__head">
					<?php echo igj_picture( $a['photo'], array( 'class' => 'igj-agent__photo', 'sizes' => '140px' ) ); // phpcs:ignore ?>
					<div>
						<<?php echo $hl; // phpcs:ignore ?> class="igj-agent__name"><?php echo esc_html( $a['name'] ); ?></<?php echo $hl; // phpcs:ignore ?>>
						<p class="igj-agent__title"><?php echo esc_html( $a['job_title'] ); ?></p>
						<p class="igj-agent__npn"><?php printf( esc_html__( 'National Producer Number (NPN) %s', 'pegasus' ), esc_html( $a['npn'] ) ); ?></p>
					</div>
				</div>
				<ul class="igj-agent__contact list-unstyled">
					<?php if ( ! empty( $a['phone_e164'] ) ) : ?>
						<li><i class="fa fa-phone" aria-hidden="true"></i> <a href="tel:<?php echo esc_attr( $a['phone_e164'] ); ?>"><?php echo esc_html( $a['phone_display'] ); ?></a></li>
					<?php endif; ?>
					<li><i class="fa fa-envelope" aria-hidden="true"></i> <a href="mailto:<?php echo esc_attr( $a['email'] ); ?>"><?php echo esc_html( $a['email'] ); ?></a></li>
					<li><i class="fa fa-check-circle" aria-hidden="true"></i> <?php esc_html_e( 'Certified with HealthCare.gov (FFM) for 2027, Georgia Access and Get Covered Illinois', 'pegasus' ); ?></li>
				</ul>
				<?php if ( $states ) : ?>
					<details class="igj-agent__states">
						<summary><?php printf( esc_html__( 'Licensed in %d states — and growing!', 'pegasus' ), count( $a['states'] ) ); ?></summary>
						<p><?php echo esc_html( implode( ', ', $a['states'] ) ); ?></p>
					</details>
				<?php endif; ?>
			</article>
		</div>
	<?php endforeach; ?>
</div>
