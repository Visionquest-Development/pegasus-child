<?php
/*
	Template Name: Pay Template
*/

/**
 * Pay page template for Hart Family of Home Services.
 *
 * Header/footer handled by the parent theme via get_header()/get_footer().
 *
 * A branded landing that hands off to the payment portal. The "Pay Online Now"
 * button is a plain URL field (Stripe Payment Link or Jobber Client Hub) that
 * opens in a new tab — the redirect is intentional so payments stay reconciled
 * in Stripe/Jobber and no card data ever touches this site. Fully CMB2-driven
 * ("Pay Page Content" metabox in functions.php); every string/link ships with a
 * default. Right column is a repeatable "help" group (invoice questions, checks).
 */
?>
<?php get_header(); ?>

<?php
	// Hero: solid dark by default (design has no hero image); Featured Image or the
	// CMB2 override will fill it if the client ever sets one.
	$hero_bg = hfhs_hero_bg( hfhs_pay_field( 'hero_image', '' ), '' );

	$pay_body_default =
		'<p>Click the button below and sign in to your HFHS client portal to view your open invoices and pay online. You&rsquo;ll be able to see invoice details, choose a payment method, and receive an emailed receipt automatically.</p>' .
		'<p>If this is your first time paying online, use the email address we have on file to access your account.</p>';

	$pay_link   = hfhs_pay_field( 'pay_button_link', '' );
	$pay_note   = hfhs_pay_field( 'pay_note', 'Secure payment processing via Stripe &middot; Hart Family of Home Services does not store your card details on our site.' );

	// Right-column help cards (repeatable; falls back to these two).
	$help = hfhs_pay_group( 'help', array(
		array(
			'eyebrow' => 'Questions About an Invoice?',
			'script'  => 'We&rsquo;re happy to help.',
			'body'    => 'Call or email us with your invoice number and we&rsquo;ll walk you through any questions about the work completed, the amount, or the payment process.',
			'phone'   => '404-507-2579',
			'email'   => 'contact@hfhsgeorgia.com',
		),
		array(
			'eyebrow' => 'Prefer to Pay by Check?',
			'script'  => 'We accept checks too.',
			'body'    => 'Make checks payable to Hart Family of Home Services. Mail or hand-deliver &mdash; give us a call at 404-507-2579 and we&rsquo;ll share the current mailing address.',
			'phone'   => '',
			'email'   => '',
		),
	) );
?>

<main id="page-wrap" class="hfhs-home hfhs-pay-page">

	<!-- ================= HERO ================= -->
	<section class="hfhs-hero hfhs-pay-hero hfhs-section--dark" id="top"<?php if ( $hero_bg ) : ?> style="background-image: url('<?php echo esc_url( $hero_bg ); ?>');"<?php endif; ?>>
		<div class="hfhs-hero__overlay" aria-hidden="true"></div>
		<div class="container hfhs-hero__inner wow fadeInUp" data-wow-duration="1s">
			<nav class="hfhs-breadcrumb" aria-label="Breadcrumb">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
				<span aria-hidden="true">/</span>
				<span aria-current="page">Pay</span>
			</nav>
			<p class="hfhs-eyebrow hfhs-eyebrow--light"><?php echo esc_html( hfhs_pay_field( 'hero_eyebrow', 'Quick Pay' ) ); ?></p>
			<p class="hfhs-eyebrow-script hfhs-eyebrow-script--light"><?php echo esc_html( hfhs_pay_field( 'hero_script', 'From Our Family to Yours.' ) ); ?></p>
			<h1 class="hfhs-hero__title"><?php echo wp_kses_post( hfhs_pay_field( 'hero_title', 'Pay your <em>invoice.</em>' ) ); ?></h1>
			<p class="hfhs-hero__lead"><?php echo esc_html( hfhs_pay_field( 'hero_text', 'Secure online payment through our client portal. Accepts credit cards, debit cards, and ACH bank transfers — all processed through our trusted billing partner.' ) ); ?></p>
		</div>
	</section>

	<!-- ================= PAYMENT ================= -->
	<section class="hfhs-pay hfhs-section--white">
		<div class="container">
			<div class="row g-5">

				<!-- Pay card -->
				<div class="col-lg-7 hfhs-pay__main wow fadeInUp" data-wow-duration="0.9s">
					<div class="hfhs-paycard">
						<p class="hfhs-eyebrow"><?php echo esc_html( hfhs_pay_field( 'pay_eyebrow', 'Online Payment' ) ); ?></p>
						<p class="hfhs-eyebrow-script hfhs-paycard__script"><?php echo esc_html( hfhs_pay_field( 'pay_script', 'Fast & secure.' ) ); ?></p>
						<h2 class="hfhs-display hfhs-paycard__title"><?php echo wp_kses_post( hfhs_pay_field( 'pay_title', 'Pay through our <em>client portal.</em>' ) ); ?></h2>
						<div class="hfhs-paycard__body"><?php echo wp_kses_post( wpautop( hfhs_pay_field( 'pay_body', $pay_body_default ) ) ); ?></div>

						<a class="hfhs-btn hfhs-btn--dark hfhs-paycard__btn" href="<?php echo esc_url( $pay_link ? $pay_link : '#' ); ?>"<?php echo $pay_link ? ' target="_blank" rel="noopener noreferrer"' : ''; ?>>
							<?php echo esc_html( hfhs_pay_field( 'pay_button_text', 'Pay Online Now' ) ); ?> <span class="hfhs-arrow" aria-hidden="true">&rarr;</span>
						</a>

						<?php if ( $pay_note ) : ?>
							<p class="hfhs-paycard__note"><span class="hfhs-paycard__lock" aria-hidden="true">&#128274;</span> <?php echo wp_kses_post( $pay_note ); ?></p>
						<?php endif; ?>
					</div>
				</div>

				<!-- Help cards -->
				<div class="col-lg-5 hfhs-pay__aside wow fadeInUp" data-wow-duration="0.9s" data-wow-delay="0.15s">
					<?php foreach ( $help as $card ) :
						$c_eyebrow = isset( $card['eyebrow'] ) ? $card['eyebrow'] : '';
						$c_script  = isset( $card['script'] ) ? $card['script'] : '';
						$c_body    = isset( $card['body'] ) ? $card['body'] : '';
						$c_phone   = isset( $card['phone'] ) ? trim( $card['phone'] ) : '';
						$c_email   = isset( $card['email'] ) ? trim( $card['email'] ) : '';
					?>
						<div class="hfhs-payhelp">
							<?php if ( $c_eyebrow ) : ?><p class="hfhs-eyebrow"><?php echo esc_html( $c_eyebrow ); ?></p><?php endif; ?>
							<?php if ( $c_script ) : ?><p class="hfhs-eyebrow-script hfhs-payhelp__script"><?php echo esc_html( $c_script ); ?></p><?php endif; ?>
							<?php if ( $c_body ) : ?><p class="hfhs-payhelp__body"><?php echo wp_kses_post( $c_body ); ?></p><?php endif; ?>
							<?php if ( $c_phone || $c_email ) : ?>
								<p class="hfhs-payhelp__contact">
									<?php if ( $c_phone ) : ?>
										<a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $c_phone ) ); ?>"><?php echo esc_html( $c_phone ); ?></a>
									<?php endif; ?>
									<?php if ( $c_email ) : ?>
										<a href="mailto:<?php echo esc_attr( $c_email ); ?>"><?php echo esc_html( $c_email ); ?></a>
									<?php endif; ?>
								</p>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				</div>

			</div>
		</div>
	</section>

</main>

<?php get_footer(); ?>
