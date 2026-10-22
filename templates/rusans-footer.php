<?php
/**
 * Ru San's footer band: NAP, hours, quick links, socials. Included from footer.php.
 */
$a = rusans_site( 'address', array() );
?>
<section class="rusans-footer" aria-label="<?php esc_attr_e( 'Restaurant information', 'pegasus' ); ?>">
	<div class="container">
		<div class="row g-4">
			<div class="col-12 col-md-6 col-lg-4">
				<p class="rusans-footer__brand"><?php echo esc_html( rusans_site( 'name' ) ); ?></p>
				<p class="rusans-footer__tag"><?php echo esc_html( rusans_site( 'tagline' ) ); ?> · <?php printf( esc_html__( 'Since %s', 'pegasus' ), esc_html( rusans_site( 'since' ) ) ); ?></p>
				<address class="rusans-footer__nap">
					<a href="<?php echo esc_url( rusans_site( 'maps_url' ) ); ?>" target="_blank" rel="noopener">
						<?php echo esc_html( $a['street'] ?? '' ); ?><br>
						<?php echo esc_html( ( $a['city'] ?? '' ) . ', ' . ( $a['region'] ?? '' ) . ' ' . ( $a['postal'] ?? '' ) ); ?>
					</a><br>
					<a href="tel:<?php echo esc_attr( rusans_site( 'phone_e164' ) ); ?>"><?php echo esc_html( rusans_site( 'phone_display' ) ); ?></a><br>
					<a href="mailto:<?php echo esc_attr( rusans_site( 'email_catering' ) ); ?>"><?php echo esc_html( rusans_site( 'email_catering' ) ); ?></a>
				</address>
			</div>
			<div class="col-12 col-md-6 col-lg-4">
				<p class="rusans-footer__heading"><?php esc_html_e( 'Hours', 'pegasus' ); ?></p>
				<?php get_template_part( 'templates/rusans-hours' ); ?>
			</div>
			<div class="col-12 col-lg-4">
				<p class="rusans-footer__heading"><?php esc_html_e( 'Order & Follow', 'pegasus' ); ?></p>
				<?php get_template_part( 'templates/rusans-order-cta', null, array( 'compact' => true ) ); ?>
				<ul class="rusans-social" aria-label="<?php esc_attr_e( 'Social media', 'pegasus' ); ?>">
					<?php foreach ( (array) rusans_site( 'social', array() ) as $s ) : ?>
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

<?php /* Mobile-only sticky action bar: Call / Order / Directions. */ ?>
<nav class="rusans-actionbar d-lg-none" aria-label="<?php esc_attr_e( 'Quick actions', 'pegasus' ); ?>">
	<a href="tel:<?php echo esc_attr( rusans_site( 'phone_e164' ) ); ?>"><i class="fa fa-phone" aria-hidden="true"></i><span><?php esc_html_e( 'Call', 'pegasus' ); ?></span></a>
	<a href="<?php echo esc_url( home_url( '/#order' ) ); ?>"><i class="fa fa-shopping-bag" aria-hidden="true"></i><span><?php esc_html_e( 'Order', 'pegasus' ); ?></span></a>
	<a href="<?php echo esc_url( rusans_site( 'maps_url' ) ); ?>" target="_blank" rel="noopener"><i class="fa fa-map-marker" aria-hidden="true"></i><span><?php esc_html_e( 'Directions', 'pegasus' ); ?></span></a>
</nav>
