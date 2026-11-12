<?php
/**
 * "States We Serve" section (SEO: every state name is plain, crawlable text).
 * Args: c (resolved section content), tint (bool). Headline + state list: IGJ Site Info → 04.
 */
$args  = isset( $args ) && is_array( $args ) ? $args : array();
$tint  = $args['tint'] ?? false;
$c     = $args['c'] ?? igj_cms_section_defaults( igj_cms_sec_states() );
$area  = (array) igj_site( 'service_area', array() );
$home  = (string) igj_site( 'home_state', 'Georgia' );
if ( ! $area ) {
	return;
}
?>
<section class="igj-section igj-states<?php echo $tint ? ' igj-section--tint' : ''; ?>" id="states-we-serve" aria-labelledby="igj-states-title">
	<div class="container">
		<div class="igj-section__head text-center">
			<?php if ( $c['eyebrow'] ) : ?><p class="igj-eyebrow"><?php echo esc_html( $c['eyebrow'] ); ?></p><?php endif; ?>
			<h2 id="igj-states-title" class="igj-section-title"><?php echo esc_html( igj_site( 'states_headline' ) ); ?></h2>
			<p><?php echo wp_kses_post( igj_render( igj_cms_tokens( $c['intro'], array( 'state_count' => count( $area ) ) ) ) ); ?></p>
		</div>
		<ul class="igj-states__list list-unstyled">
			<?php foreach ( $area as $st ) : ?>
				<li class="<?php echo $home === $st ? 'is-home' : ''; ?>"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo esc_html( $st ); ?><?php echo $home === $st ? ' <span class="igj-states__badge">' . esc_html( $c['badge'] ) . '</span>' : ''; ?></li>
			<?php endforeach; ?>
			<li class="igj-states__more"><i class="fa fa-plus-circle" aria-hidden="true"></i> <?php echo esc_html( $c['more'] ); ?></li>
		</ul>
		<p class="igj-states__note text-center"><?php echo wp_kses_post( igj_render( $c['note'] ) ); ?> <?php echo igj_todo( 'Joe to verify the final list of currently licensed states before launch (list built from the license screenshots in his Nov 10 email).' ); // phpcs:ignore ?></p>
	</div>
</section>
