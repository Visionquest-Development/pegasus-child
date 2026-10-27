<?php
/**
 * Mr Nice Guy footer band: contact, days/hours, order + socials. Included from footer.php.
 */
$a = mng_site( 'address', array() );
?>
<section class="mng-footer" aria-label="<?php esc_attr_e( 'Restaurant information', 'pegasus' ); ?>">
	<div class="container">
		<div class="row g-4">
			<div class="col-12 col-md-6 col-lg-4">
				<?php echo mng_picture( 'mng-logo', array( 'class' => 'mng-footer__logo', 'sizes' => '180px' ) ); // phpcs:ignore ?>
				<p class="mng-footer__tag mng-script"><?php echo esc_html( mng_site( 'slogans.0' ) ); ?></p>
				<address class="mng-footer__nap">
					<a href="<?php echo esc_url( mng_site( 'maps_url' ) ); ?>" target="_blank" rel="noopener">
						<?php echo esc_html( $a['street'] ?? '' ); ?><br>
						<?php echo esc_html( ( $a['city'] ?? '' ) . ', ' . ( $a['region'] ?? '' ) . ' ' . ( $a['postal'] ?? '' ) ); ?>
					</a><br>
					<?php echo mng_phone_link(); // phpcs:ignore ?><br>
					<a href="mailto:<?php echo esc_attr( mng_site( 'email' ) ); ?>"><?php echo esc_html( mng_site( 'email' ) ); ?></a>
				</address>
			</div>
			<div class="col-12 col-md-6 col-lg-4">
				<p class="mng-footer__heading"><?php esc_html_e( 'Days & Hours', 'pegasus' ); ?></p>
				<?php get_template_part( 'templates/mng-hours' ); ?>
			</div>
			<div class="col-12 col-lg-4">
				<p class="mng-footer__heading"><?php esc_html_e( 'Order & Follow', 'pegasus' ); ?></p>
				<?php get_template_part( 'templates/mng-order-cta', null, array( 'compact' => true ) ); ?>
				<ul class="mng-social" aria-label="<?php esc_attr_e( 'Social media', 'pegasus' ); ?>">
					<?php foreach ( (array) mng_site( 'social', array() ) as $s ) : ?>
						<li>
							<a href="<?php echo esc_url( $s['href'] ); ?>" target="_blank" rel="noopener" aria-label="<?php echo esc_attr( $s['label'] ); ?>">
								<i class="fa <?php echo esc_attr( $s['icon'] ); ?>" aria-hidden="true"></i>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
</section>

<?php /* Mobile-only sticky action bar: Call / Menu / Directions. */ ?>
<nav class="mng-actionbar d-lg-none" aria-label="<?php esc_attr_e( 'Quick actions', 'pegasus' ); ?>">
	<a class="mng-actionbar__call" href="tel:<?php echo esc_attr( mng_site( 'phone_e164' ) ); ?>"><i class="fa fa-phone" aria-hidden="true"></i><span><?php esc_html_e( 'Call to Order', 'pegasus' ); ?></span></a>
	<a href="<?php echo esc_url( mng_page_url( 'tpl_mng_menu.php', 'menu' ) ); ?>"><i class="fa fa-cutlery" aria-hidden="true"></i><span><?php esc_html_e( 'Menu', 'pegasus' ); ?></span></a>
	<a href="<?php echo esc_url( mng_site( 'maps_url' ) ); ?>" target="_blank" rel="noopener"><i class="fa fa-map-marker" aria-hidden="true"></i><span><?php esc_html_e( 'Directions', 'pegasus' ); ?></span></a>
</nav>
