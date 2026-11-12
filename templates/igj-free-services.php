<?php
/**
 * "Our Services Are Always Free to You!" band + compensation disclosure (Joe's wording, pending compliance review).
 * Args: c (resolved section content from igj_section(); defaults when omitted).
 */
$args = isset( $args ) && is_array( $args ) ? $args : array();
$c    = $args['c'] ?? igj_cms_section_defaults( igj_cms_sec_free_services() );
?>
<section class="igj-section igj-free" aria-labelledby="igj-free-title">
	<div class="container">
		<div class="igj-free__box">
			<div class="igj-free__icon" aria-hidden="true"><i class="fa fa-heart"></i></div>
			<div class="igj-free__text">
				<?php if ( $c['eyebrow'] ) : ?><p class="igj-eyebrow"><?php echo esc_html( $c['eyebrow'] ); ?></p><?php endif; ?>
				<h2 id="igj-free-title" class="igj-section-title"><?php echo esc_html( $c['title'] ); ?></h2>
				<p class="igj-free__lead"><?php echo wp_kses_post( igj_render( $c['lead'] ) ); ?></p>
				<ul class="igj-free__list list-unstyled">
					<?php foreach ( (array) $c['items'] as $it ) : ?>
					<li><i class="fa fa-check" aria-hidden="true"></i> <?php echo esc_html( $it['text'] ); ?></li>
					<?php endforeach; ?>
				</ul>
				<p class="igj-free__fine"><?php echo esc_html( igj_site( 'compensation_text' ) ); ?> <?php echo igj_todo( 'Compensation wording is Joe’s suggestion; have it reviewed for compliance before launch.' ); // phpcs:ignore ?></p>
			</div>
		</div>
	</div>
</section>
