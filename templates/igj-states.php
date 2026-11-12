<?php
/**
 * "States We Serve" section (SEO: every state name is plain, crawlable text).
 * Args: tint (bool), heading_level.
 */
$args  = isset( $args ) && is_array( $args ) ? $args : array();
$tint  = $args['tint'] ?? false;
$area  = (array) igj_site( 'service_area', array() );
$home  = 'Georgia';
if ( ! $area ) {
	return;
}
?>
<section class="igj-section igj-states<?php echo $tint ? ' igj-section--tint' : ''; ?>" id="states-we-serve" aria-labelledby="igj-states-title">
	<div class="container">
		<div class="igj-section__head text-center">
			<p class="igj-eyebrow"><?php esc_html_e( 'States we serve', 'pegasus' ); ?></p>
			<h2 id="igj-states-title" class="igj-section-title"><?php echo esc_html( igj_site( 'states_headline' ) ); ?></h2>
			<p><?php printf( esc_html__( 'From our home base in Roswell, Georgia, we help clients by phone and online in %d states. Don’t see your state? Ask us — our licensing footprint grows regularly, and we obtain any required licenses and appointments before offering coverage in a new state.', 'pegasus' ), count( $area ) ); ?></p>
		</div>
		<ul class="igj-states__list list-unstyled">
			<?php foreach ( $area as $st ) : ?>
				<li class="<?php echo $home === $st ? 'is-home' : ''; ?>"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo esc_html( $st ); ?><?php echo $home === $st ? ' <span class="igj-states__badge">' . esc_html__( 'Home state', 'pegasus' ) . '</span>' : ''; ?></li>
			<?php endforeach; ?>
			<li class="igj-states__more"><i class="fa fa-plus-circle" aria-hidden="true"></i> <?php esc_html_e( 'And growing!', 'pegasus' ); ?></li>
		</ul>
		<p class="igj-states__note text-center"><?php esc_html_e( 'Plans, carriers and Marketplace options vary by state and agent. Insurance is offered only where we are licensed and appointed. State license numbers are available on request.', 'pegasus' ); ?> <?php echo igj_todo( 'Joe to verify the final list of currently licensed states before launch (list built from the license screenshots in his Nov 10 email).' ); // phpcs:ignore ?></p>
	</div>
</section>
