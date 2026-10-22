<?php
/**
 * Insurance Guy Joe header (overrides the parent's header one).
 * Skip link, utility bar, logo, Primary menu (Bootstrap dropdowns via wp-bootstrap-hooks),
 * and the two primary conversion actions: Call and Get a Quote.
 */
$logo     = pegasus_get_option( 'logo' );
$fallback = '<ul class="navbar-nav ms-auto"><li class="nav-item"><a class="nav-link" href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'pegasus' ) . '</a></li></ul>';
?>
<a class="igj-skip" href="#primary"><?php esc_html_e( 'Skip to content', 'pegasus' ); ?></a>
<div id="header" class="header-container igj-header">
	<div class="igj-topbar d-none d-md-block">
		<div class="container d-flex justify-content-between align-items-center">
			<p class="igj-topbar__note mb-0"><?php echo esc_html( igj_site( 'tagline' ) ); ?></p>
			<p class="igj-topbar__call mb-0"><i class="fa fa-phone" aria-hidden="true"></i> <?php esc_html_e( 'Call or text Joe:', 'pegasus' ); ?> <?php echo igj_phone_link(); // phpcs:ignore ?></p>
		</div>
	</div>
	<nav class="navbar navbar-expand-lg igj-navbar" aria-label="<?php esc_attr_e( 'Main', 'pegasus' ); ?>">
		<div class="container">
			<a class="navbar-brand igj-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<?php if ( $logo ) : ?>
					<img src="<?php echo esc_url( $logo ); ?>" alt="<?php echo esc_attr( igj_site( 'name' ) ); ?>" width="207" height="60">
				<?php else : ?>
					<span class="igj-brand__text"><?php echo esc_html( igj_site( 'name' ) ); ?></span>
				<?php endif; ?>
			</a>
			<a class="btn igj-btn igj-btn--cta igj-header-quote d-lg-none ms-auto me-2" href="<?php echo esc_url( igj_contact_url( 'quote-form' ) ); ?>"><?php esc_html_e( 'Free Quote', 'pegasus' ); ?></a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#igj-nav" aria-controls="igj-nav" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'pegasus' ); ?>">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="igj-nav">
				<?php echo pegasus_get_menu( 'primary', 'navbar-nav primary-navigation-bar ms-auto', 2, $fallback ); // phpcs:ignore ?>
				<div class="igj-nav-actions">
					<a class="btn igj-btn igj-btn--ghost" href="tel:<?php echo esc_attr( igj_site( 'phone_e164' ) ); ?>"><i class="fa fa-phone" aria-hidden="true"></i> <?php echo esc_html( igj_site( 'phone_display' ) ); ?></a>
					<a class="btn igj-btn igj-btn--cta" href="<?php echo esc_url( igj_contact_url( 'quote-form' ) ); ?>"><?php esc_html_e( 'Get a Free Quote', 'pegasus' ); ?></a>
				</div>
			</div>
		</div>
	</nav>
</div>
