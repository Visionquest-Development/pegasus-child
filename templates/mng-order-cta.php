<?php
/**
 * Order / catering call to action. Links from data/site.json → order.
 * Args: compact (bool) — buttons only, no band.
 */
$args     = isset( $args ) && is_array( $args ) ? $args : array();
$compact  = ! empty( $args['compact'] );
$order    = mng_site( 'order', array() );
$partners = $order['partners'] ?? array();
?>
<?php if ( ! $compact ) : ?>
<section class="mng-order" id="order" aria-labelledby="mng-order-title">
	<div class="container">
		<div class="row align-items-center g-4">
			<div class="col-lg-6 wow fadeInLeft">
				<p class="mng-script mng-order__eyebrow"><?php esc_html_e( 'Hungry yet?', 'pegasus' ); ?></p>
				<h2 id="mng-order-title" class="mng-order__title"><?php esc_html_e( 'Call It In. Pick It Up. Dig In.', 'pegasus' ); ?></h2>
				<p class="mng-order__text"><?php esc_html_e( 'Call ahead for plates and pickup, or let us cook for your next event. There are no small portions here.', 'pegasus' ); ?></p>
			</div>
			<div class="col-lg-6 wow fadeInRight">
<?php endif; ?>
				<div class="mng-order__buttons">
					<a class="btn mng-btn mng-btn--fire" href="<?php echo esc_url( $order['call']['href'] ?? '' ); ?>">
						<i class="fa fa-phone" aria-hidden="true"></i>
						<?php echo esc_html( $order['call']['label'] ?? __( 'Call', 'pegasus' ) ); ?>
						<span class="mng-btn__sub"><?php echo esc_html( mng_site( 'phone_display' ) ); ?></span>
					</a>
					<?php foreach ( $partners as $p ) : ?>
						<a class="btn mng-btn mng-btn--outline" href="<?php echo esc_url( $p['href'] ); ?>" target="_blank" rel="noopener">
							<?php echo esc_html( $p['label'] ); ?>
							<span class="screen-reader-text"><?php esc_html_e( '(opens in a new tab)', 'pegasus' ); ?></span>
						</a>
					<?php endforeach; ?>
					<a class="btn mng-btn mng-btn--outline" href="<?php echo esc_url( mng_page_url( 'tpl_mng_catering.php', 'catering' ) ); ?>"><i class="fa fa-cutlery" aria-hidden="true"></i> <?php esc_html_e( 'Book Catering', 'pegasus' ); ?></a>
				</div>
<?php if ( ! $compact ) : ?>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>
