<?php
/**
 * Mr Nice Guy header (overrides the parent's header one).
 * Skip link, slogan/phone strip, logo, Primary menu (Bootstrap dropdowns via
 * wp-bootstrap-hooks) and the two conversion actions: Call and Catering.
 */
$logo     = pegasus_get_option( 'logo' );
$fallback = '<ul class="navbar-nav ms-auto"><li class="nav-item"><a class="nav-link" href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'pegasus' ) . '</a></li></ul>';
?>
<a class="mng-skip" href="#primary"><?php esc_html_e( 'Skip to content', 'pegasus' ); ?></a>
<div id="header" class="header-container mng-header">
	<div class="mng-topbar d-none d-md-block">
		<div class="container d-flex justify-content-between align-items-center">
			<p class="mng-topbar__note mb-0"><span class="mng-script"><?php echo esc_html( mng_site( 'slogans.0' ) ); ?></span> &nbsp;·&nbsp; <?php echo esc_html( mng_site( 'hours_summary' ) ); ?></p>
			<p class="mng-topbar__call mb-0"><i class="fa fa-phone" aria-hidden="true"></i> <?php echo mng_phone_link(); // phpcs:ignore ?></p>
		</div>
	</div>
	<nav class="navbar navbar-expand-lg navbar-dark mng-navbar" aria-label="<?php esc_attr_e( 'Main', 'pegasus' ); ?>">
		<div class="container">
			<a class="navbar-brand mng-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<?php if ( $logo ) : ?>
					<img src="<?php echo esc_url( $logo ); ?>" alt="<?php echo esc_attr( mng_site( 'name_long' ) ); ?>" width="132" height="82">
				<?php else : ?>
					<span class="mng-brand__text"><?php echo esc_html( mng_site( 'short_name' ) ); ?></span>
				<?php endif; ?>
			</a>
			<a class="btn mng-btn mng-btn--fire mng-header-call d-lg-none ms-auto me-2" href="tel:<?php echo esc_attr( mng_site( 'phone_e164' ) ); ?>"><i class="fa fa-phone" aria-hidden="true"></i><span class="screen-reader-text"><?php esc_html_e( 'Call', 'pegasus' ); ?></span></a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mng-nav" aria-controls="mng-nav" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'pegasus' ); ?>">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="mng-nav">
				<?php echo pegasus_get_menu( 'primary', 'navbar-nav primary-navigation-bar ms-auto', 2, $fallback ); // phpcs:ignore ?>
				<div class="mng-nav-actions">
					<a class="btn mng-btn mng-btn--fire" href="tel:<?php echo esc_attr( mng_site( 'phone_e164' ) ); ?>"><i class="fa fa-phone" aria-hidden="true"></i> <?php esc_html_e( 'Call to Order', 'pegasus' ); ?></a>
				</div>
			</div>
		</div>
	</nav>
</div>
