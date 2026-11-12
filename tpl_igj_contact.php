<?php
/*
	Template Name: IGJ Contact
*/
get_header();
$sent   = isset( $_GET['igj_sent'] ) ? sanitize_key( wp_unslash( $_GET['igj_sent'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification
/* Content: Pages → Contact → boxes "01 — Page Hero" … "04 — Sidebar". */
$hero   = igj_section( 'contact', 'hero' );
$sched  = igj_section( 'contact', 'schedule' );
$form   = igj_section( 'contact', 'form' );
$side   = igj_section( 'contact', 'sidebar' );
$topics = array_map( function ( $slug ) { return igj_service_card( $slug )['title']; }, array_keys( igj_services() ) );
if ( $form['topic_other'] ) {
	$topics[] = $form['topic_other'];
}
?>
<div id="page-wrap">
<main id="primary" class="site-main igj igj-contact">
	<?php
	get_template_part( 'templates/igj-page-hero', null, array(
		'title' => $hero['title'],
		'lead'  => $hero['lead'],
		'cta'   => false,
	) );
	?>
	<section class="igj-section igj-section--compact">
		<div class="container">
			<div class="igj-schedule">
				<div class="igj-schedule__text">
					<h2 class="igj-section-title"><?php echo esc_html( $sched['title'] ); ?></h2>
					<?php if ( $sched['text'] ) : ?><p class="mb-0"><?php echo wp_kses_post( igj_render( $sched['text'] ) ); ?></p><?php endif; ?>
				</div>
				<div class="igj-schedule__cta"><?php echo igj_schedule_button( 'igj-btn--cta igj-btn--lg', $sched['button'] ); // phpcs:ignore ?></div>
			</div>
			<?php echo igj_todo( 'Picktime setup: add the intake questions (ZIP, who needs coverage, desired effective date, what they’re looking for) to the Picktime booking form so they arrive with the appointment.' ); // phpcs:ignore ?>
		</div>
	</section>
	<section class="igj-section pt-0">
		<div class="container">
			<div class="row g-4 g-lg-5">
				<div class="col-lg-7">
					<h2 class="igj-section-title" id="quote-form"><?php echo esc_html( $form['title'] ); ?></h2>
					<?php if ( 'ok' === $sent ) : ?>
						<div class="igj-alert igj-alert--ok" role="status"><?php echo esc_html( $form['msg_ok'] ); ?></div>
					<?php elseif ( 'missing' === $sent ) : ?>
						<div class="igj-alert igj-alert--warn" role="alert"><?php echo esc_html( $form['msg_missing'] ); ?></div>
					<?php elseif ( 'error' === $sent ) : ?>
						<div class="igj-alert igj-alert--warn" role="alert"><?php echo esc_html( igj_cms_tokens( $form['msg_error'] ) ); ?></div>
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
							<div class="col-md-6"><label class="form-label" for="igj_who"><?php esc_html_e( 'Who needs coverage?', 'pegasus' ); ?></label>
								<select class="form-select" id="igj_who" name="igj_who">
									<?php foreach ( array_filter( wp_list_pluck( (array) $form['who'], 'label' ) ) as $w ) : ?>
										<option><?php echo esc_html( $w ); ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="col-md-6"><label class="form-label" for="igj_effective"><?php esc_html_e( 'Desired effective date', 'pegasus' ); ?></label><input class="form-control" type="date" id="igj_effective" name="igj_effective"></div>
							<div class="col-12"><label class="form-label" for="igj_topic"><?php esc_html_e( 'What are you looking for?', 'pegasus' ); ?></label>
								<select class="form-select" id="igj_topic" name="igj_topic">
									<?php foreach ( $topics as $topic ) : ?>
										<option><?php echo esc_html( $topic ); ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="col-12"><label class="form-label" for="igj_message"><?php esc_html_e( 'Briefly, what are you looking for? (optional)', 'pegasus' ); ?></label><textarea class="form-control" id="igj_message" name="igj_message" rows="4"></textarea>
								<p class="form-text"><?php echo esc_html( $form['privacy_note'] ); ?></p></div>
							<div class="col-12 form-check ms-1"><input class="form-check-input" type="checkbox" id="igj_consent" name="igj_consent" value="1" required> <label class="form-check-label" for="igj_consent"><?php echo wp_kses_post( igj_render( $form['consent'] ) ); ?></label></div>
							<div class="col-12"><button class="btn igj-btn igj-btn--cta igj-btn--lg" type="submit"><?php echo esc_html( $form['submit'] ); ?></button></div>
						</div>
					</form>
					<p class="mt-3"><?php echo igj_todo( 'Form requests go to both Joe and Dianna. Joe to review the call/text consent wording (TCPA) before launch.' ); // phpcs:ignore ?></p>
				</div>
				<aside class="col-lg-5" aria-label="<?php esc_attr_e( 'Other ways to reach us', 'pegasus' ); ?>">
					<div class="igj-sidecard igj-sidecard--quote">
						<h2 class="igj-sidecard__title"><?php echo esc_html( $side['talk_title'] ); ?></h2>
						<p class="igj-bigphone"><?php echo igj_phone_link(); // phpcs:ignore ?></p>
						<a class="btn igj-btn igj-btn--outline w-100" href="<?php echo esc_url( igj_site( 'quote_url' ) ); ?>" target="_blank" rel="noopener"><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo esc_html( igj_site( 'quote_url_label' ) ); ?><span class="visually-hidden"> <?php esc_html_e( '(opens in a new tab)', 'pegasus' ); ?></span></a>
						<ul class="list-unstyled mt-3 mb-0 igj-contact__people">
							<?php foreach ( igj_agents() as $a ) : ?>
								<li><strong><?php echo esc_html( $a['name'] ); ?></strong>, <?php echo esc_html( $a['job_title'] ); ?><br><i class="fa fa-envelope" aria-hidden="true"></i> <a href="mailto:<?php echo esc_attr( $a['email'] ); ?>"><?php echo esc_html( $a['email'] ); ?></a></li>
							<?php endforeach; ?>
						</ul>
						<p class="mt-3 mb-0"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo esc_html( igj_site( 'location_line' ) ); ?></p>
						<?php if ( igj_site( 'hours_text' ) ) : ?>
							<p class="mt-2 mb-0"><?php echo esc_html( igj_site( 'hours_text' ) ); ?></p>
						<?php endif; ?>
					</div>
					<?php echo igj_picture( $side['image'], array( 'class' => 'igj-rounded igj-shadow mb-4', 'sizes' => '(min-width: 992px) 35vw, 100vw', 'id' => $side['image_id'] ) ); // phpcs:ignore ?>
					<div class="igj-sidecard">
						<h2 class="igj-sidecard__title"><?php echo esc_html( $side['ready_title'] ); ?></h2>
						<ul class="igj-checklist">
							<?php foreach ( (array) $side['ready'] as $it ) : ?>
							<li><?php echo esc_html( $it['text'] ); ?></li>
							<?php endforeach; ?>
						</ul>
						<?php
						$links = array();
						foreach ( (array) $side['links'] as $l ) {
							if ( $l['label'] && $l['url'] ) {
								$links[] = '<a href="' . esc_url( igj_cms_url( $l['url'] ) ) . '">' . esc_html( $l['label'] ) . '</a>';
							}
						}
						if ( $links ) :
							?>
						<p class="mb-0"><?php echo implode( ' · ', $links ); // phpcs:ignore -- escaped above ?></p>
						<?php endif; ?>
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
