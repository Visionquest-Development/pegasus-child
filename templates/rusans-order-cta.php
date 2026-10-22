<?php
/**
 * Order / reservation call to action. Real links from data/site.json → order.
 * Args: compact (bool) — buttons only, no heading band.
 */
$args    = isset( $args ) && is_array( $args ) ? $args : array();
$compact = ! empty( $args['compact'] );
$order   = rusans_site( 'order', array() );
$partners = $order['partners'] ?? array();
?>
<?php if ( ! $compact ) : ?>
<section class="rusans-order" id="order" aria-labelledby="rusans-order-title">
	<div class="container">
		<div class="row align-items-center g-4">
			<div class="col-lg-5 wow fadeInLeft">
				<p class="rusans-eyebrow"><?php esc_html_e( 'Takeout & Delivery', 'pegasus' ); ?></p>
				<h2 id="rusans-order-title" class="rusans-order__title"><?php esc_html_e( 'Order Now', 'pegasus' ); ?></h2>
				<p class="rusans-order__text"><?php esc_html_e( 'View the menu, then give us a call and let us know of any special requests.', 'pegasus' ); ?></p>
				<p class="rusans-order__text small"><?php echo esc_html( rusans_site( 'reservations.text' ) ); ?></p>
			</div>
			<div class="col-lg-7 wow fadeInRight">
<?php endif; ?>
				<div class="rusans-order__buttons">
					<a class="btn rusans-btn rusans-btn--primary" href="<?php echo esc_url( $order['call']['href'] ?? '' ); ?>">
						<i class="fa fa-phone" aria-hidden="true"></i>
						<?php echo esc_html( $order['call']['label'] ?? 'Call' ); ?>
						<span class="rusans-btn__sub"><?php echo esc_html( rusans_site( 'phone_display' ) ); ?></span>
					</a>
					<?php foreach ( $partners as $p ) : ?>
						<a class="btn rusans-btn rusans-btn--outline" href="<?php echo esc_url( $p['href'] ); ?>" target="_blank" rel="noopener">
							<?php echo esc_html( $p['label'] ); ?>
							<span class="screen-reader-text"><?php esc_html_e( '(opens in a new tab)', 'pegasus' ); ?></span>
						</a>
					<?php endforeach; ?>
				</div>
				<?php if ( ! $compact && ! empty( $partners[0]['note'] ) ) : ?>
					<p class="rusans-order__fineprint"><?php echo esc_html( $partners[0]['note'] ); ?></p>
				<?php endif; ?>
<?php if ( ! $compact ) : ?>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>
