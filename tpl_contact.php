<?php
/*
	Template Name: Gen2 - Contact
*/

/**
 * Contact page. Hero, Contact Info strip, Contact Form, Submit Resume.
 *
 * The form sections accept a form-plugin shortcode (Contact Form 7,
 * Gravity Forms, WPForms, etc.) entered in CMB2 — the template runs the
 * value through do_shortcode(). When the resume shortcode is blank the
 * template renders a simple email fallback.
 */

require_once get_stylesheet_directory() . '/inc/gen2-design.php';

get_header();

$header_choice = function_exists( 'pegasus_get_option' ) ? pegasus_get_option( 'header_select' ) : '';
if ( 'header-three' === $header_choice ) {
	get_template_part( 'templates/additional_header' );
}
?>

<div class="gen2 gen2-contact-page">

	<?php
	/* ───── 1 — HERO ───────────────────────────────────────────────── */
	$contact_subtitle = gen2_meta( 'gen2_contact_subtitle',     '&sect; 01 &middot; CONTACT' );
	$contact_before   = gen2_meta( 'gen2_contact_title_before', 'TELL US ABOUT' );
	$contact_accent   = gen2_meta( 'gen2_contact_title_accent', 'THE LINE.' );
	$contact_intro    = gen2_meta( 'gen2_contact_intro',        "Most engagements start with a phone call and a short scoping session. We'll come visit the plant, look at the process, and tell you honestly if we're the right fit." );

	/* ───── 2 — CONTACT INFO ───────────────────────────────────────── */
	$contact_address = gen2_meta( 'gen2_contact_address', "7124 SW Hampton St\nTigard, Oregon 97223" );
	$contact_phone   = gen2_meta( 'gen2_contact_phone',   '(503) 555-0142' );
	$contact_email   = gen2_meta( 'gen2_contact_email',   'hello@gen2automation.com' );
	$contact_hours   = gen2_meta( 'gen2_contact_hours',   "Mon–Fri · 7:00 – 17:00 PT\nAfter-hours support 24/7" );
	?>
	<section class="gen2-contact-hero">
		<div class="gen2-contact-hero__doc mono">
			<span><?php echo wp_kses_post( $contact_subtitle ); ?></span>
			<span>SHEET 01 / 04</span>
		</div>
		<div class="gen2-contact-hero__main">
			<h1 class="gen2-contact-hero__title anton">
				<?php gen2_render_lines( $contact_before ); ?>
				<?php if ( $contact_accent ) : ?>
					<br><span class="gen2-contact-hero__title-accent"><?php echo wp_kses_post( $contact_accent ); ?></span>
				<?php endif; ?>
			</h1>
			<?php if ( $contact_intro ) : ?>
				<div class="gen2-contact-hero__intro sans">
					<?php gen2_render_wysiwyg( $contact_intro ); ?>
				</div>
			<?php endif; ?>
		</div>
	</section>

	<section class="gen2-contact-info">
		<?php if ( $contact_address ) : ?>
			<div class="gen2-contact-info__cell">
				<div class="gen2-contact-info__label mono">Office</div>
				<div class="gen2-contact-info__value sans"><?php echo nl2br( esc_html( $contact_address ) ); ?></div>
			</div>
		<?php endif; ?>
		<?php if ( $contact_phone ) : ?>
			<div class="gen2-contact-info__cell">
				<div class="gen2-contact-info__label mono">Phone</div>
				<div class="gen2-contact-info__value sans">
					<a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $contact_phone ) ); ?>"><?php echo esc_html( $contact_phone ); ?></a>
				</div>
			</div>
		<?php endif; ?>
		<?php if ( $contact_email ) : ?>
			<div class="gen2-contact-info__cell">
				<div class="gen2-contact-info__label mono">Email</div>
				<div class="gen2-contact-info__value sans">
					<a href="mailto:<?php echo esc_attr( $contact_email ); ?>"><?php echo esc_html( $contact_email ); ?></a>
				</div>
			</div>
		<?php endif; ?>
		<?php if ( $contact_hours ) : ?>
			<div class="gen2-contact-info__cell">
				<div class="gen2-contact-info__label mono">Hours</div>
				<div class="gen2-contact-info__value sans"><?php echo nl2br( esc_html( $contact_hours ) ); ?></div>
			</div>
		<?php endif; ?>
	</section>

	<?php
	/* ───── 3 — CONTACT FORM ───────────────────────────────────────── */
	$form_subtitle  = gen2_meta( 'gen2_contact_form_subtitle',     '&sect; 02 &middot; PROJECT INQUIRY' );
	$form_before    = gen2_meta( 'gen2_contact_form_title_before', 'START A' );
	$form_accent    = gen2_meta( 'gen2_contact_form_title_accent', 'CONVERSATION.' );
	$form_intro     = gen2_meta( 'gen2_contact_form_intro',        '' );
	$form_shortcode = gen2_meta( 'gen2_contact_form_shortcode',    '' );
	?>
	<section class="gen2-contact-form-section">
		<div class="gen2-contact-form-section__doc mono">
			<span><?php echo wp_kses_post( $form_subtitle ); ?></span>
			<span>SHEET 02 / 04</span>
		</div>
		<div class="gen2-contact-form-section__main">
			<div class="gen2-contact-form-section__head">
				<h2 class="gen2-contact-form-section__title anton">
					<?php gen2_render_lines( $form_before ); ?>
					<?php if ( $form_accent ) : ?>
						<br><span class="gen2-contact-form-section__title-accent"><?php echo wp_kses_post( $form_accent ); ?></span>
					<?php endif; ?>
				</h2>
				<?php if ( $form_intro ) : ?>
					<div class="gen2-contact-form-section__intro sans">
						<?php gen2_render_wysiwyg( $form_intro ); ?>
					</div>
				<?php endif; ?>
			</div>
			<div class="gen2-contact-form-section__form">
				<?php if ( $form_shortcode ) : ?>
					<?php echo do_shortcode( $form_shortcode ); ?>
				<?php else : ?>
					<p class="gen2-contact-form-section__empty mono">
						No contact-form shortcode set yet. Add one in the WP admin → Contact page → <em>Contact — 3 · Contact Form</em>.
					</p>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<?php
	/* ───── 4 — SUBMIT RESUME ──────────────────────────────────────── */
	$resume_subtitle  = gen2_meta( 'gen2_contact_resume_subtitle',     '&sect; 03 &middot; CAREERS' );
	$resume_before    = gen2_meta( 'gen2_contact_resume_title_before', 'SUBMIT A' );
	$resume_accent    = gen2_meta( 'gen2_contact_resume_title_accent', 'RESUME.' );
	$resume_intro     = gen2_meta( 'gen2_contact_resume_intro',        "We're always interested in talking to controls engineers, panel builders, and CODESYS developers. Send your resume and we'll be in touch." );
	$resume_shortcode = gen2_meta( 'gen2_contact_resume_shortcode',    '' );
	$resume_email     = gen2_meta( 'gen2_contact_resume_email',        '' );
	if ( ! $resume_email ) { $resume_email = $contact_email; }
	?>
	<section class="gen2-contact-resume">
		<div class="gen2-contact-resume__doc mono">
			<span><?php echo wp_kses_post( $resume_subtitle ); ?></span>
			<span>SHEET 03 / 04</span>
		</div>
		<div class="gen2-contact-resume__main">
			<div class="gen2-contact-resume__head">
				<h2 class="gen2-contact-resume__title anton">
					<?php gen2_render_lines( $resume_before ); ?>
					<?php if ( $resume_accent ) : ?>
						<br><span class="gen2-contact-resume__title-accent"><?php echo wp_kses_post( $resume_accent ); ?></span>
					<?php endif; ?>
				</h2>
				<?php if ( $resume_intro ) : ?>
					<div class="gen2-contact-resume__intro sans">
						<?php gen2_render_wysiwyg( $resume_intro ); ?>
					</div>
				<?php endif; ?>
			</div>
			<div class="gen2-contact-resume__form">
				<?php if ( $resume_shortcode ) : ?>
					<?php echo do_shortcode( $resume_shortcode ); ?>
				<?php elseif ( $resume_email ) : ?>
					<a class="gen2-contact-resume__mailto mono" href="mailto:<?php echo esc_attr( $resume_email ); ?>?subject=Resume%20Submission">
						Email resume to <?php echo esc_html( $resume_email ); ?> &rarr;
					</a>
				<?php else : ?>
					<p class="gen2-contact-resume__empty mono">
						Add a resume-form shortcode or a fallback email in the WP admin → Contact page → <em>Contact — 4 · Submit Resume</em>.
					</p>
				<?php endif; ?>
			</div>
		</div>
	</section>

</div>

<?php get_footer(); ?>
