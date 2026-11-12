<?php
/**
 * Joe & Dianna's four-step process: Discover, Obtain, Gather, Educate.
 * Args: c (resolved section content), tint (bool, default true), heading_id.
 */
$args  = isset( $args ) && is_array( $args ) ? $args : array();
$tint  = $args['tint'] ?? true;
$hid   = $args['heading_id'] ?? 'igj-steps';
$c     = $args['c'] ?? igj_cms_section_defaults( igj_cms_sec_steps() );
?>
<section class="igj-section<?php echo $tint ? ' igj-section--tint' : ''; ?>" aria-labelledby="<?php echo esc_attr( $hid ); ?>">
	<div class="container">
		<div class="igj-section__head text-center">
			<?php if ( $c['eyebrow'] ) : ?><p class="igj-eyebrow"><?php echo esc_html( $c['eyebrow'] ); ?></p><?php endif; ?>
			<h2 id="<?php echo esc_attr( $hid ); ?>" class="igj-section-title"><?php echo esc_html( $c['title'] ); ?></h2>
			<?php if ( $c['intro'] ) : ?><p><?php echo esc_html( $c['intro'] ); ?></p><?php endif; ?>
		</div>
		<ol class="igj-steps row g-4 list-unstyled">
			<?php foreach ( array_values( (array) $c['steps'] ) as $i => $s ) : ?>
				<li class="col-sm-6 col-lg-3 wow fadeInUp"<?php echo $i ? ' data-wow-delay=".' . (int) ( $i * 8 ) . 's"' : ''; ?>>
					<div class="igj-step">
						<span class="igj-step__n" aria-hidden="true"><?php echo (int) ( $i + 1 ); ?></span>
						<h3><span class="igj-step__word"><?php echo esc_html( $s['word'] ); ?></span> <span class="igj-step__sub"><?php echo esc_html( $s['sub'] ); ?></span></h3>
						<p><?php echo wp_kses_post( igj_render( $s['text'] ) ); ?></p>
					</div>
				</li>
			<?php endforeach; ?>
		</ol>
	</div>
</section>
