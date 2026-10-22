<?php
/*
	Template Name: IGJ Contact
*/
get_header();
$sent   = isset( $_GET['igj_sent'] ) ? sanitize_key( wp_unslash( $_GET['igj_sent'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification
$topics = array_merge( array_map( function ( $s ) { return $s['title']; }, array_values( igj_services() ) ), array( __( 'Not sure yet', 'pegasus' ) ) );
?>
<div id="page-wrap">
<main id="primary" class="site-main igj igj-contact">
	<?php
	get_template_part( 'templates/igj-page-hero', null, array(
		'title' => __( 'Contact Joe & Get a Free Quote', 'pegasus' ),
		'lead'  => __( 'Call, book a time, or send a few details and Joe will get back to you. There’s no cost and no obligation.', 'pegasus' ),
		'cta'   => false,
	) );
	?>
	<section class="igj-section">
		<div class="container">
			<div class="row g-4 g-lg-5">
				<div class="col-lg-7">
					<h2 class="igj-section-title" id="quote-form"><?php esc_html_e( 'Request a quote', 'pegasus' ); ?></h2>
					<?php if ( 'ok' === $sent ) : ?>
						<div class="igj-alert igj-alert--ok" role="status"><?php esc_html_e( 'Thanks! Your request was sent. Joe will be in touch soon.', 'pegasus' ); ?></div>
					<?php elseif ( 'missing' === $sent ) : ?>
						<div class="igj-alert igj-alert--warn" role="alert"><?php esc_html_e( 'Please add your name, a phone number or email, and check the consent box.', 'pegasus' ); ?></div>
					<?php elseif ( 'error' === $sent ) : ?>
						<div class="igj-alert igj-alert--warn" role="alert"><?php printf( esc_html__( 'Sorry, something went wrong. Please call %s.', 'pegasus' ), esc_html( igj_site( 'phone_display' ) ) ); ?></div>
					<?php endif; ?>
					<form class="igj-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" novalidate>
						<input type="hidden" name="action" value="igj_quote">
						<?php wp_nonce_field( 'igj_quote', 'igj_nonce' ); ?>
						<div class="igj-hp" aria-hidden="true"><label for="igj_website">Website</label><input type="text" id="igj_website" name="igj_website" tabindex="-1" autocomplete="off"></div>
						<div class="row g-3">
							<div class="col-md-6"><label class="form-label" for="igj_name"><?php esc_html_e( 'Name', 'pegasus' ); ?> <span aria-hidden="true">*</span></label><input class="form-control" type="text" id="igj_name" name="igj_name" autocomplete="name" required></div>
							<div class="col-md-6"><label class="form-label" for="igj_zip"><?php esc_html_e( 'ZIP code', 'pegasus' ); ?></label><input class="form-control" type="text" id="igj_zip" name="igj_zip" inputmode="numeric" autocomplete="postal-code" maxlength="10"></div>
							<div class="col-md-6"><label class="form-label" for="igj_phone"><?php esc_html_e( 'Phone', 'pegasus' ); ?></label><input class="form-control" type="tel" id="igj_phone" name="igj_phone" autocomplete="tel"></div>
							<div class="col-md-6"><label class="form-label" for="igj_email"><?php esc_html_e( 'Email', 'pegasus' ); ?></label><input class="form-control" type="email" id="igj_email" name="igj_email" autocomplete="email"></div>
							<div class="col-12"><label class="form-label" for="igj_topic"><?php esc_html_e( 'What are you looking for?', 'pegasus' ); ?></label>
								<select class="form-select" id="igj_topic" name="igj_topic">
									<?php foreach ( $topics as $topic ) : ?>
										<option><?php echo esc_html( $topic ); ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="col-12"><label class="form-label" for="igj_message"><?php esc_html_e( 'Anything Joe should know? (optional)', 'pegasus' ); ?></label><textarea class="form-control" id="igj_message" name="igj_message" rows="4"></textarea>
								<p class="form-text"><?php esc_html_e( 'Please don’t include Social Security numbers or detailed medical information here.', 'pegasus' ); ?></p></div>
							<div class="col-12 form-check ms-1"><input class="form-check-input" type="checkbox" id="igj_consent" name="igj_consent" value="1" required> <label class="form-check-label" for="igj_consent"><?php printf( wp_kses_post( __( 'I agree that Insurance Guy Joe may contact me by phone, text or email about health insurance options. Consent isn’t required to buy. See our <a href="%s">Privacy Policy</a>.', 'pegasus' ) ), esc_url( home_url( '/privacy-policy/' ) ) ); ?></label></div>
							<div class="col-12"><button class="btn igj-btn igj-btn--cta igj-btn--lg" type="submit"><?php esc_html_e( 'Send my quote request', 'pegasus' ); ?></button></div>
						</div>
					</form>
					<p class="mt-3"><?php echo igj_todo( 'Confirm where form emails should go (data/site.json “email”). Until set, they go to the WordPress admin email. Joe to review the consent wording (TCPA) before launch.' ); // phpcs:ignore ?></p>
				</div>
				<aside class="col-lg-5" aria-label="<?php esc_attr_e( 'Other ways to reach Joe', 'pegasus' ); ?>">
					<div class="igj-sidecard igj-sidecard--quote">
						<h2 class="igj-sidecard__title"><?php esc_html_e( 'Prefer to talk?', 'pegasus' ); ?></h2>
						<p class="igj-bigphone"><?php echo igj_phone_link(); // phpcs:ignore ?></p>
						<a class="btn igj-btn igj-btn--outline w-100" href="<?php echo esc_url( igj_site( 'quote_url' ) ); ?>" target="_blank" rel="noopener"><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo esc_html( igj_site( 'quote_url_label' ) ); ?><span class="visually-hidden"> <?php esc_html_e( '(opens in a new tab)', 'pegasus' ); ?></span></a>
						<?php if ( igj_site( 'email' ) ) : ?>
							<p class="mt-3 mb-0"><i class="fa fa-envelope" aria-hidden="true"></i> <a href="mailto:<?php echo esc_attr( igj_site( 'email' ) ); ?>"><?php echo esc_html( igj_site( 'email' ) ); ?></a></p>
						<?php endif; ?>
						<?php if ( igj_site( 'hours_text' ) ) : ?>
							<p class="mt-2 mb-0"><?php echo esc_html( igj_site( 'hours_text' ) ); ?></p>
						<?php endif; ?>
					</div>
					<div class="igj-sidecard">
						<h2 class="igj-sidecard__title"><?php esc_html_e( 'Helpful to have ready', 'pegasus' ); ?></h2>
						<ul class="igj-checklist">
							<li><?php esc_html_e( 'Who needs coverage and their dates of birth', 'pegasus' ); ?></li>
							<li><?php esc_html_e( 'Your ZIP code', 'pegasus' ); ?></li>
							<li><?php esc_html_e( 'An estimate of this year’s household income', 'pegasus' ); ?></li>
							<li><?php esc_html_e( 'Doctors and prescriptions you want covered', 'pegasus' ); ?></li>
							<li><?php esc_html_e( 'Any coverage you have now or are losing, and when', 'pegasus' ); ?></li>
						</ul>
						<p class="mb-0"><a href="<?php echo esc_url( igj_learn_url( 'open-enrollment-guide' ) ); ?>"><?php esc_html_e( 'When can I enroll?', 'pegasus' ); ?></a> · <a href="<?php echo esc_url( home_url( '/faq/' ) ); ?>"><?php esc_html_e( 'FAQs', 'pegasus' ); ?></a></p>
					</div>
				</aside>
			</div>
			<div class="igj-prose mt-4">
				<?php
				while ( have_posts() ) :
					the_post();
					the_content();
				endwhile;
				?>
			</div>
		</div>
	</section>
</main>
</div>
<?php get_footer(); ?>
