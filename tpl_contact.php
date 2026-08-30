<?php
/*
	Template Name: Contact Template
*/
?>
<?php get_header(); ?>
<?php
if ( have_posts() ) : the_post(); endif;
$pid             = get_the_ID();
$subhero_img_url = get_the_post_thumbnail_url( $pid, 'full' ) ?: '';
$ext_icon        = '<svg width="13" height="13" viewBox="0 0 13 13" fill="none" stroke="currentColor" stroke-width="1.4" aria-hidden="true" focusable="false" style="margin-left:4px;flex-shrink:0"><path d="M4 1H12V9"/><path d="M12 1L5 8"/><path d="M9 12H1V4"/></svg>';

/* =====================================================================
   READ ALL CMB2 FIELDS — fall back to built-in defaults when empty
   ===================================================================== */

/* ---- Sub-hero ---- */
$hero_heading = get_post_meta( $pid, 'rcf_contact_hero_heading', true )
	?: "Begin a\nconversation.";
$hero_sub     = get_post_meta( $pid, 'rcf_contact_hero_sub', true )
	?: 'Request the current strategy presentation, arrange an introductory call, or direct a question to the appropriate desk. Every inquiry is reviewed personally by a member of the firm.';

/* ---- §01 Reach Us — details + form ---- */
$eyebrow       = get_post_meta( $pid, 'rcf_contact_eyebrow', true )        ?: 'Investor Relations';
$aside_heading = get_post_meta( $pid, 'rcf_contact_aside_heading', true )  ?: "Speak directly\nwith our IR team.";
$aside_body    = get_post_meta( $pid, 'rcf_contact_aside_body', true )     ?: 'We hold every conversation in confidence and respond to qualified inquiries within one business day. For time-sensitive matters, please call the office directly.';
$email         = get_post_meta( $pid, 'rcf_contact_email', true )          ?: 'info@ricecapitalfund.com';
$phone         = get_post_meta( $pid, 'rcf_contact_phone', true )          ?: '404.555.0123';
$phone_link    = get_post_meta( $pid, 'rcf_contact_phone_link', true )     ?: '4045550123';
$address       = get_post_meta( $pid, 'rcf_contact_address', true )        ?: "1180 Peachtree Street NE\nSuite 2400\nAtlanta, Georgia 30309";
$hours         = get_post_meta( $pid, 'rcf_contact_hours', true )          ?: "Monday\xe2\x80\x93Friday \xc2\xb7 9:00am\xe2\x80\x935:00pm ET";

$form_heading   = get_post_meta( $pid, 'rcf_contact_form_heading', true )   ?: 'Send a secure message';
$form_note      = get_post_meta( $pid, 'rcf_contact_form_note', true )      ?: 'This form is intended for prospective and existing qualified investors. Submitting it does not create an investment advisory relationship, and nothing on this page constitutes an offer to sell or a solicitation to buy any security.';
$form_shortcode = get_post_meta( $pid, 'rcf_contact_form_shortcode', true );
$form_recipient = get_post_meta( $pid, 'rcf_contact_form_recipient', true ) ?: $email;
$form_success   = get_post_meta( $pid, 'rcf_contact_form_success', true )   ?: 'Thank you — your message has been received. A member of our Investor Relations team will be in touch shortly.';

/* ---- §02 Contact Channels (repeatable group) ---- */
$channels_raw = get_post_meta( $pid, 'rcf_contact_channels', true );
if ( ! empty( $channels_raw ) && is_array( $channels_raw ) ) {
	$channels = $channels_raw;
} else {
	$channels = array(
		array( 'icon' => 'line-chart', 'label' => 'Investor Relations', 'detail' => 'ir@ricecapitalfund.com',      'note' => 'Fund materials, subscriptions, and existing-LP servicing.' ),
		array( 'icon' => 'envelope-o', 'label' => 'General Inquiries',   'detail' => 'info@ricecapitalfund.com',    'note' => 'Anything that does not fall to a specific desk.' ),
		array( 'icon' => 'newspaper-o','label' => 'Media & Press',       'detail' => 'press@ricecapitalfund.com',   'note' => 'Press, speaking, and partnership requests.' ),
	);
}

/* ---- Closing disclaimer band ---- */
$cta_eyebrow = get_post_meta( $pid, 'rcf_contact_cta_eyebrow', true ) ?: 'For Qualified Investors Only';
$cta_heading = get_post_meta( $pid, 'rcf_contact_cta_heading', true ) ?: 'Access to fund materials is restricted.';
$cta_lede    = get_post_meta( $pid, 'rcf_contact_cta_lede', true )    ?: 'Detailed performance, offering documents, and operational due-diligence materials are made available only to verified qualified purchasers and institutional investors under NDA. Please identify your investor category when you write.';

/* ---- Submission state (set by the admin-post handler on redirect) ---- */
$sent_state = isset( $_GET['rcf_sent'] ) ? sanitize_key( $_GET['rcf_sent'] ) : '';
?>

<div id="page-wrap">

	<!-- ===== SUB-HERO ===== -->
	<section class="rcf-subhero">
		<?php if ( $subhero_img_url ) : ?>
			<div class="rcf-subhero__bg" style="background-image:url('<?php echo esc_url( $subhero_img_url ); ?>');" role="img" aria-hidden="true"></div>
		<?php endif; ?>
		<div class="container">
			<nav class="rcf-breadcrumb" aria-label="Breadcrumb">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Rice Capital Fund</a>
				<span class="sep" aria-hidden="true">/</span>
				<span class="cur"><?php the_title(); ?></span>
			</nav>
			<h1><?php echo nl2br( esc_html( $hero_heading ) ); ?></h1>
			<div class="rcf-subhero__rule" aria-hidden="true"></div>
			<p class="rcf-subhero__sub"><?php echo esc_html( $hero_sub ); ?></p>
		</div>
	</section>

	<!-- ===== §01 REACH US — details + form ===== -->
	<section class="rcf-contact">
		<div class="container">
			<div class="row g-5 align-items-start">

				<!-- Left: contact details -->
				<div class="col-lg-5">
					<div class="rcf-contact__aside">
						<div class="rcf-section-num" aria-hidden="true">01</div>
						<div class="rcf-eyebrow"><?php echo esc_html( $eyebrow ); ?></div>
						<h2 class="rcf-h2"><?php echo nl2br( esc_html( $aside_heading ) ); ?></h2>
						<p class="rcf-body-text mt-4" style="max-width:420px;"><?php echo esc_html( $aside_body ); ?></p>

						<div class="rcf-contact__details">
							<?php if ( $email ) : ?>
							<a class="rcf-contact-detail" href="mailto:<?php echo esc_attr( $email ); ?>">
								<i class="fa fa-envelope" aria-hidden="true"></i>
								<span class="rcf-contact-detail__label">Email</span>
								<span class="rcf-contact-detail__value"><?php echo esc_html( $email ); ?></span>
							</a>
							<?php endif; ?>
							<?php if ( $phone ) : ?>
							<a class="rcf-contact-detail" href="tel:<?php echo esc_attr( $phone_link ?: $phone ); ?>">
								<i class="fa fa-phone" aria-hidden="true"></i>
								<span class="rcf-contact-detail__label">Telephone</span>
								<span class="rcf-contact-detail__value"><?php echo esc_html( $phone ); ?></span>
							</a>
							<?php endif; ?>
							<?php if ( $address ) : ?>
							<div class="rcf-contact-detail">
								<i class="fa fa-map-marker" aria-hidden="true"></i>
								<span class="rcf-contact-detail__label">Office</span>
								<span class="rcf-contact-detail__value"><?php echo nl2br( esc_html( $address ) ); ?></span>
							</div>
							<?php endif; ?>
							<?php if ( $hours ) : ?>
							<div class="rcf-contact-detail">
								<i class="fa fa-clock-o" aria-hidden="true"></i>
								<span class="rcf-contact-detail__label">Hours</span>
								<span class="rcf-contact-detail__value"><?php echo esc_html( $hours ); ?></span>
							</div>
							<?php endif; ?>
						</div>
					</div>
				</div>

				<!-- Right: form card -->
				<div class="col-lg-7">
					<div class="rcf-contact__form" id="contact-form">
						<h3 class="rcf-contact__form-heading"><?php echo esc_html( $form_heading ); ?></h3>

						<?php if ( 'error' === $sent_state ) : ?>
							<div class="rcf-form-alert rcf-form-alert--error" role="alert">
								Sorry — your message could not be sent. Please try again, or email us directly.
							</div>
						<?php elseif ( $sent_state ) : ?>
							<div class="rcf-form-alert rcf-form-alert--success" role="status">
								<?php echo esc_html( $form_success ); ?>
							</div>
						<?php endif; ?>

						<?php if ( ! empty( $form_shortcode ) ) : ?>

							<?php echo do_shortcode( $form_shortcode ); ?>

						<?php elseif ( 'error' !== $sent_state && $sent_state ) : ?>

							<?php /* Success already shown above — hide the empty form after a good submit. */ ?>

						<?php else : ?>

							<form class="rcf-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" novalidate>
								<input type="hidden" name="action" value="rcf_contact_submit">
								<input type="hidden" name="rcf_recipient" value="<?php echo esc_attr( $form_recipient ); ?>">
								<?php wp_nonce_field( 'rcf_contact_submit', 'rcf_contact_nonce' ); ?>
								<!-- Honeypot: humans leave this empty -->
								<div class="rcf-hp" aria-hidden="true">
									<label>Do not fill this in <input type="text" name="rcf_hp" tabindex="-1" autocomplete="off"></label>
								</div>

								<div class="rcf-form__grid">
									<div class="rcf-field">
										<label for="rcf-name">Full name <span aria-hidden="true">*</span></label>
										<input type="text" id="rcf-name" name="rcf_name" required autocomplete="name">
									</div>
									<div class="rcf-field">
										<label for="rcf-email">Email <span aria-hidden="true">*</span></label>
										<input type="email" id="rcf-email" name="rcf_email" required autocomplete="email">
									</div>
									<div class="rcf-field">
										<label for="rcf-firm">Firm / organization</label>
										<input type="text" id="rcf-firm" name="rcf_firm" autocomplete="organization">
									</div>
									<div class="rcf-field">
										<label for="rcf-phone">Phone <span class="rcf-field__opt">(optional)</span></label>
										<input type="tel" id="rcf-phone" name="rcf_phone" autocomplete="tel">
									</div>
									<div class="rcf-field rcf-field--full">
										<label for="rcf-type">Investor category</label>
										<select id="rcf-type" name="rcf_type">
											<option value="">Please select…</option>
											<option>Qualified Purchaser</option>
											<option>Accredited Investor</option>
											<option>Institutional Allocator</option>
											<option>Consultant / Advisor</option>
											<option>Other</option>
										</select>
									</div>
									<div class="rcf-field rcf-field--full">
										<label for="rcf-message">How can we help? <span aria-hidden="true">*</span></label>
										<textarea id="rcf-message" name="rcf_message" rows="5" required></textarea>
									</div>
									<div class="rcf-field rcf-field--full rcf-field--consent">
										<label>
											<input type="checkbox" name="rcf_consent" value="yes" required>
											<span>I understand this inquiry will be handled in accordance with the firm's privacy practices, and that no offer or solicitation is made through this form.</span>
										</label>
									</div>
								</div>

								<div class="rcf-form__actions">
									<button type="submit" class="rcf-btn rcf-btn--dark">Send message</button>
									<p class="rcf-form__note"><?php echo esc_html( $form_note ); ?></p>
								</div>
							</form>

						<?php endif; ?>
					</div>
				</div>

			</div>
		</div>
	</section>

	<!-- ===== §02 CONTACT CHANNELS ===== -->
	<?php if ( ! empty( $channels ) ) : ?>
	<section class="rcf-channels">
		<div class="container">
			<div class="rcf-channels__head">
				<div class="rcf-section-num" aria-hidden="true">02</div>
				<div class="rcf-eyebrow">Direct Lines</div>
				<h2 class="rcf-h2">Reach the right desk.</h2>
			</div>
			<div class="rcf-channels__grid">
				<?php foreach ( $channels as $ch ) :
					$c_icon   = isset( $ch['icon'] )   ? trim( $ch['icon'] ) : '';
					$c_label  = isset( $ch['label'] )  ? $ch['label']  : '';
					$c_detail = isset( $ch['detail'] ) ? $ch['detail'] : '';
					$c_note   = isset( $ch['note'] )   ? $ch['note']   : '';
					$is_email = is_email( $c_detail );
				?>
				<div class="rcf-channel">
					<?php if ( $c_icon ) : ?>
						<div class="rcf-channel__icon"><i class="fa fa-<?php echo esc_attr( $c_icon ); ?>" aria-hidden="true"></i></div>
					<?php endif; ?>
					<?php if ( $c_label ) : ?><h3 class="rcf-channel__label"><?php echo esc_html( $c_label ); ?></h3><?php endif; ?>
					<?php if ( $c_detail ) : ?>
						<?php if ( $is_email ) : ?>
							<a class="rcf-channel__detail" href="mailto:<?php echo esc_attr( $c_detail ); ?>"><?php echo esc_html( $c_detail ); ?></a>
						<?php else : ?>
							<span class="rcf-channel__detail"><?php echo esc_html( $c_detail ); ?></span>
						<?php endif; ?>
					<?php endif; ?>
					<?php if ( $c_note ) : ?><p class="rcf-channel__note"><?php echo esc_html( $c_note ); ?></p><?php endif; ?>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<!-- ===== CLOSING DISCLAIMER BAND ===== -->
	<section class="rcf-cta">
		<div class="container">
			<div class="text-center mx-auto" style="max-width:820px;">
				<div class="rcf-eyebrow justify-content-center"><?php echo esc_html( $cta_eyebrow ); ?></div>
				<h2 class="rcf-h2"><?php echo esc_html( $cta_heading ); ?></h2>
				<p class="rcf-lede mx-auto"><?php echo esc_html( $cta_lede ); ?></p>
			</div>
		</div>
	</section>

</div><!-- end page-wrap -->

<?php get_footer(); ?>
