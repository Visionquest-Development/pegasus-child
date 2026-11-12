<?php
/**
 * Agent cards for Joe & Dianna: photo, title, NPN, email, licensed states.
 * Args: show_states (bool), heading_level (h2|h3), c (About → 03 labels). People: IGJ Site Info → 03.
 */
$args   = isset( $args ) && is_array( $args ) ? $args : array();
$c      = wp_parse_args( $args['c'] ?? array(), array(
	'npn_label'    => 'National Producer Number (NPN) {npn}',
	'cert_line'    => 'Certified with HealthCare.gov (FFM) for 2027, Georgia Access and Get Covered Illinois',
	'states_label' => 'Licensed in {count} states — and growing!',
) );
$states = $args['show_states'] ?? true;
$hl     = in_array( $args['heading_level'] ?? 'h3', array( 'h2', 'h3' ), true ) ? ( $args['heading_level'] ?? 'h3' ) : 'h3';
?>
<div class="row g-4 igj-agents">
	<?php foreach ( igj_agents() as $a ) : ?>
		<div class="col-md-6">
			<article class="igj-agent" id="<?php echo esc_attr( $a['id'] ); ?>">
				<div class="igj-agent__head">
					<?php echo igj_picture( $a['photo'], array( 'class' => 'igj-agent__photo', 'sizes' => '140px', 'id' => $a['photo_id'] ?? 0 ) ); // phpcs:ignore ?>
					<div>
						<<?php echo $hl; // phpcs:ignore ?> class="igj-agent__name"><?php echo esc_html( $a['name'] ); ?></<?php echo $hl; // phpcs:ignore ?>>
						<p class="igj-agent__title"><?php echo esc_html( $a['job_title'] ); ?></p>
						<?php if ( ! empty( $a['npn'] ) ) : ?><p class="igj-agent__npn"><?php echo esc_html( igj_cms_tokens( $c['npn_label'], array( 'npn' => $a['npn'] ) ) ); ?></p><?php endif; ?>
					</div>
				</div>
				<ul class="igj-agent__contact list-unstyled">
					<?php if ( ! empty( $a['phone_e164'] ) ) : ?>
						<li><i class="fa fa-phone" aria-hidden="true"></i> <a href="tel:<?php echo esc_attr( $a['phone_e164'] ); ?>"><?php echo esc_html( $a['phone_display'] ); ?></a></li>
					<?php endif; ?>
					<?php if ( ! empty( $a['email'] ) ) : ?>
					<li><i class="fa fa-envelope" aria-hidden="true"></i> <a href="mailto:<?php echo esc_attr( $a['email'] ); ?>"><?php echo esc_html( $a['email'] ); ?></a></li>
					<?php endif; ?>
					<?php if ( $c['cert_line'] ) : ?>
					<li><i class="fa fa-check-circle" aria-hidden="true"></i> <?php echo esc_html( $c['cert_line'] ); ?></li>
					<?php endif; ?>
				</ul>
				<?php if ( $states && ! empty( $a['states'] ) ) : ?>
					<details class="igj-agent__states">
						<summary><?php echo esc_html( igj_cms_tokens( $c['states_label'], array( 'count' => count( $a['states'] ) ) ) ); ?></summary>
						<p><?php echo esc_html( implode( ', ', $a['states'] ) ); ?></p>
					</details>
				<?php endif; ?>
			</article>
		</div>
	<?php endforeach; ?>
</div>
