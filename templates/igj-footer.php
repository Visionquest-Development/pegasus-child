<?php
/**
 * Insurance Guy Joe footer band. Included from footer.php.
 */
$lic      = (array) igj_site( 'licenses', array() );
$services = igj_services();
?>
<section class="igj-footer" aria-label="<?php esc_attr_e( 'Site footer', 'pegasus' ); ?>">
	<div class="container">
		<div class="row g-4">
			<div class="col-12 col-lg-4">
				<p class="igj-footer__brand"><?php echo igj_picture( 'igj-logo-white', array( 'alt' => igj_site( 'name' ), 'class' => 'igj-footer__logo' ) ); // phpcs:ignore ?></p>
				<p><?php esc_html_e( 'Personal, one-on-one help choosing health insurance for individuals, families, the self-employed and small businesses.', 'pegasus' ); ?></p>
				<ul class="igj-footer__contact list-unstyled">
					<li><i class="fa fa-phone" aria-hidden="true"></i> <?php echo igj_phone_link(); // phpcs:ignore ?></li>
					<?php if ( igj_site( 'email' ) ) : ?>
						<li><i class="fa fa-envelope" aria-hidden="true"></i> <a href="mailto:<?php echo esc_attr( igj_site( 'email' ) ); ?>"><?php echo esc_html( igj_site( 'email' ) ); ?></a></li>
					<?php endif; ?>
					<?php foreach ( igj_agents() as $a ) : ?>
						<?php if ( ! empty( $a['email'] ) && $a['email'] !== igj_site( 'email' ) ) : ?>
							<li><i class="fa fa-envelope" aria-hidden="true"></i> <a href="mailto:<?php echo esc_attr( $a['email'] ); ?>"><?php echo esc_html( $a['email'] ); ?></a></li>
						<?php endif; ?>
					<?php endforeach; ?>
					<li><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo esc_html( igj_site( 'location_line' ) ); ?></li>
					<li><i class="fa fa-calendar" aria-hidden="true"></i> <a href="<?php echo esc_url( igj_site( 'quote_url' ) ); ?>" target="_blank" rel="noopener"><?php echo esc_html( igj_site( 'quote_url_label' ) ); ?><span class="visually-hidden"> <?php esc_html_e( '(opens in a new tab)', 'pegasus' ); ?></span></a></li>
				</ul>
				<?php if ( igj_site( 'social' ) ) : ?>
					<ul class="igj-social list-unstyled d-flex gap-2">
						<?php foreach ( (array) igj_site( 'social' ) as $s ) : ?>
							<li><a href="<?php echo esc_url( $s['href'] ); ?>" target="_blank" rel="noopener" aria-label="<?php echo esc_attr( $s['label'] ); ?>"><i class="fa <?php echo esc_attr( $s['icon'] ); ?>" aria-hidden="true"></i></a></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>
			<div class="col-6 col-lg-3">
				<p class="igj-footer__heading"><?php esc_html_e( 'Health Insurance', 'pegasus' ); ?></p>
				<ul class="list-unstyled igj-footer__links">
					<?php foreach ( $services as $slug => $s ) : ?>
						<li><a href="<?php echo esc_url( igj_service_url( $slug ) ); ?>"><?php echo esc_html( $s['nav'] ); ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
			<div class="col-6 col-lg-2">
				<p class="igj-footer__heading"><?php esc_html_e( 'Company', 'pegasus' ); ?></p>
				<ul class="list-unstyled igj-footer__links">
					<?php foreach ( array( 'services' => __( 'All Services', 'pegasus' ), 'learn' => __( 'Learn', 'pegasus' ), 'faq' => __( 'FAQs', 'pegasus' ), 'about' => __( 'Meet Joe & Dianna', 'pegasus' ), 'contact' => __( 'Contact', 'pegasus' ) ) as $path => $label ) : ?>
						<?php $p = get_page_by_path( $path ); ?>
						<li><a href="<?php echo esc_url( $p ? get_permalink( $p ) : home_url( '/' . $path . '/' ) ); ?>"><?php echo esc_html( $label ); ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
			<div class="col-12 col-lg-3">
				<p class="igj-footer__heading"><?php esc_html_e( 'Free consultation', 'pegasus' ); ?></p>
				<p><?php esc_html_e( 'Our services are always free to you. Compare plans with a licensed professional.', 'pegasus' ); ?></p>
				<?php echo igj_schedule_button( 'igj-btn--cta', __( 'Schedule a Free Consultation', 'pegasus' ) ); // phpcs:ignore ?>
				<p class="mt-2"><a href="<?php echo esc_url( igj_contact_url( 'quote-form' ) ); ?>"><?php esc_html_e( 'Or request a quote online', 'pegasus' ); ?></a></p>
			</div>
		</div>
		<div class="igj-footer__legal">
			<p>
				<?php
				echo esc_html( implode( ' · ', array_map( function ( $a ) {
					return $a['name'] . ', ' . $a['job_title'] . ', NPN ' . $a['npn'];
				}, igj_agents() ) ) );
				?>
			</p>
			<p>
				<?php printf( esc_html__( 'Licensed in %1$s — and growing. Insurance is offered only in states where we are licensed and appointed; state license numbers are available on request.', 'pegasus' ), esc_html( implode( ', ', (array) igj_site( 'service_area', array() ) ) ) ); ?>
			</p>
			<p><?php echo esc_html( igj_site( 'compensation_text' ) ); ?></p>
			<p class="igj-footer__disclaimer"><?php esc_html_e( 'Insurance Guy Joe Solutions is a private insurance agency. We are not affiliated with or endorsed by HealthCare.gov, any state health insurance marketplace, Medicare, or any government agency. Not all plans or carriers are available in all areas. Plan details, premiums and eligibility for savings depend on your situation and the insurer’s terms.', 'pegasus' ); ?></p>
			<?php
			if ( has_nav_menu( 'footer-legal' ) ) {
				wp_nav_menu( array( 'theme_location' => 'footer-legal', 'container' => 'nav', 'container_attributes' => array(), 'container_class' => 'igj-footer__legal-nav', 'menu_class' => 'list-inline mb-0', 'depth' => 1, 'fallback_cb' => false ) );
			}
			?>
		</div>
	</div>
</section>

<?php /* Mobile-only sticky action bar: Call / Quote. */ ?>
<nav class="igj-actionbar d-lg-none" aria-label="<?php esc_attr_e( 'Quick actions', 'pegasus' ); ?>">
	<a href="tel:<?php echo esc_attr( igj_site( 'phone_e164' ) ); ?>"><i class="fa fa-phone" aria-hidden="true"></i><span><?php esc_html_e( 'Call Us', 'pegasus' ); ?></span></a>
	<a class="igj-actionbar__quote" href="<?php echo esc_url( igj_schedule_url() ); ?>" target="_blank" rel="noopener"><i class="fa fa-calendar-check-o" aria-hidden="true"></i><span><?php esc_html_e( 'Free Consultation', 'pegasus' ); ?></span></a>
</nav>
