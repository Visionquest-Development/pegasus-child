<?php
/**
 * Carriers & private programs as text (no logos until authorization is confirmed).
 */
$args     = isset( $args ) && is_array( $args ) ? $args : array();
$c        = $args['c'] ?? igj_cms_section_defaults( igj_cms_sec_carriers() );
$carriers = (array) igj_site( 'carriers', array() );
$private  = (array) igj_site( 'private_programs', array() );
?>
<section class="igj-section igj-carriers-text" aria-labelledby="igj-carriers-title">
	<div class="container">
		<div class="igj-section__head text-center">
			<?php if ( $c['eyebrow'] ) : ?><p class="igj-eyebrow"><?php echo esc_html( $c['eyebrow'] ); ?></p><?php endif; ?>
			<h2 id="igj-carriers-title" class="igj-section-title"><?php echo esc_html( $c['title'] ); ?></h2>
			<p><?php echo wp_kses_post( igj_render( $c['intro'] ) ); ?></p>
		</div>
		<div class="row g-4">
			<div class="col-lg-7">
				<div class="igj-sidecard h-100">
					<h3 class="igj-sidecard__title"><?php echo esc_html( $c['carriers_title'] ); ?></h3>
					<ul class="igj-chips list-unstyled">
						<?php foreach ( $carriers as $name ) : ?>
							<li><?php echo esc_html( $name ); ?></li>
						<?php endforeach; ?>
						<?php if ( $c['carriers_more'] ) : ?><li><?php echo esc_html( $c['carriers_more'] ); ?></li><?php endif; ?>
					</ul>
					<p class="igj-small mb-0"><?php echo wp_kses_post( igj_render( $c['carriers_note'] ) ); ?></p>
				</div>
			</div>
			<div class="col-lg-5">
				<div class="igj-sidecard h-100">
					<h3 class="igj-sidecard__title"><?php echo esc_html( $c['private_title'] ); ?></h3>
					<ul class="igj-chips list-unstyled">
						<?php foreach ( $private as $name ) : ?>
							<li><?php echo esc_html( $name ); ?></li>
						<?php endforeach; ?>
						<?php if ( $c['private_more'] ) : ?><li><?php echo esc_html( $c['private_more'] ); ?></li><?php endif; ?>
					</ul>
					<p class="igj-small mb-0"><?php echo wp_kses_post( igj_render( $c['private_note'] ) ); ?></p>
				</div>
			</div>
		</div>
	</div>
</section>
