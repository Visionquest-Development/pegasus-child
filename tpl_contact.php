<?php
/*
	Template Name: Contact (Elliot Integration)
*/

/**
 * Contact page template.
 *
 * Adapted from the Pegasus parent "No Sidebar Template" and matched to the
 * Elliot Integration design. Header and footer are handled by the theme; this
 * template renders the contact body ( dark hero, contact details, and a form
 * panel ), each powered by CMB2 fields that fall back to the Claude Design
 * defaults until filled in.
 *
 * The contact form is a Gravity Forms shortcode stored in a CMB2 text field
 * and rendered through do_shortcode(). If the field is empty — or the shortcode
 * is not registered ( Gravity Forms inactive ) — a dashed placeholder is shown
 * instead, so the raw "[gravityform ...]" text never leaks onto the page.
 *
 * Shares the elliot_field() / elliot_group() helpers defined in
 * cmb2-homepage-fields.php.
 *
 * @package Pegasus_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$header_choice = function_exists( 'pegasus_get_option' ) ? pegasus_get_option( 'header_select' ) : '';
if ( 'header-three' === $header_choice ) {
	get_template_part( 'templates/additional_header' );
}

$post_id = get_the_ID();
$d       = function_exists( 'elliot_contact_defaults' ) ? elliot_contact_defaults() : array();
$details = elliot_group( $post_id, 'elliot_contact_details', $d['details'] );

/* Resolve the Gravity Forms shortcode. do_shortcode() returns the raw string
   unchanged when Gravity Forms is inactive, so we only render when the
   shortcode is actually registered; otherwise we show the placeholder and the
   literal "[gravityform ...]" text never appears on the page. */
$form_sc  = elliot_field( $post_id, 'elliot_contact_form_sc', $d['form']['shortcode'] );
$gf_ready = ( shortcode_exists( 'gravityform' ) || shortcode_exists( 'gravityforms' ) );
$has_form = ( '' !== trim( $form_sc ) && $gf_ready );
$form_out = $has_form ? do_shortcode( $form_sc ) : '';

if ( have_posts() ) {
	the_post();
}
?>

<div id="page-wrap">
	<main class="elliot-contact">

		<!-- ===== HERO ================================================= -->
		<section class="elliot-contact-hero">
			<div class="container">
				<div class="row gx-5 gy-4 align-items-end">
					<div class="col-lg-8">
						<p class="elliot-contact-eyebrow elliot-contact-eyebrow--rule mb-4">
							<?php echo esc_html( elliot_field( $post_id, 'elliot_contact_eyebrow', $d['hero']['eyebrow'] ) ); ?>
						</p>
						<h1 class="elliot-contact-hero__title">
							<?php echo esc_html( elliot_field( $post_id, 'elliot_contact_h_line1', $d['hero']['line1'] ) ); ?>
							<em class="elliot-contact-emph"><?php echo esc_html( elliot_field( $post_id, 'elliot_contact_h_emph', $d['hero']['emph'] ) ); ?></em>
						</h1>
					</div>
					<div class="col-lg-4">
						<p class="elliot-contact-hero__intro">
							<?php echo esc_html( elliot_field( $post_id, 'elliot_contact_intro', $d['hero']['intro'] ) ); ?>
						</p>
					</div>
				</div>
			</div>
		</section>

		<!-- ===== BODY : DETAILS + FORM =============================== -->
		<section class="elliot-contact-body">
			<div class="container">
				<div class="row gx-5 gy-5">

					<!-- Contact details -->
					<div class="col-lg-5 elliot-contact-info">
						<?php foreach ( $details as $row ) : ?>
							<?php
							$label = isset( $row['label'] ) ? $row['label'] : '';
							$value = isset( $row['value'] ) ? $row['value'] : '';
							$link  = isset( $row['link'] ) ? $row['link'] : '';
							if ( '' === trim( $label ) && '' === trim( $value ) ) {
								continue;
							}
							?>
							<div class="elliot-contact-detail">
								<div class="elliot-contact-detail__label"><?php echo esc_html( $label ); ?></div>
								<div class="elliot-contact-detail__value">
									<?php if ( '' !== trim( $link ) ) : ?>
										<a href="<?php echo esc_url( $link ); ?>"><?php echo esc_html( $value ); ?></a>
									<?php else : ?>
										<?php echo esc_html( $value ); ?>
									<?php endif; ?>
								</div>
							</div>
						<?php endforeach; ?>
					</div>

					<!-- Form panel -->
					<div class="col-lg-7">
						<div class="elliot-contact-formpanel">
							<div class="elliot-contact-formpanel__eyebrow">
								<?php echo esc_html( elliot_field( $post_id, 'elliot_contact_form_eyebrow', $d['form']['eyebrow'] ) ); ?>
							</div>
							<h2 class="elliot-contact-formpanel__title">
								<?php echo esc_html( elliot_field( $post_id, 'elliot_contact_form_title', $d['form']['title'] ) ); ?>
							</h2>

							<div class="elliot-contact-form">
								<?php if ( $has_form ) : ?>
									<?php echo $form_out; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- trusted Gravity Forms markup. ?>
								<?php else : ?>
									<div class="elliot-contact-form__placeholder">
										<span>Add your Gravity Forms shortcode in <strong>Contact · 03 Form</strong></span>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>

				</div>
			</div>
		</section>

		<?php
		if ( function_exists( 'get_the_content' ) && trim( get_the_content() ) !== '' ) {
			echo '<section class="elliot-contact-pagebody"><div class="container">';
			the_content();
			echo '</div></section>';
		}

		if ( function_exists( 'wp_bootstrap_edit_post_link' ) ) {
			wp_bootstrap_edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'pegasus' ),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
		}
		?>

	</main><!-- /.elliot-contact -->
</div><!-- /#page-wrap -->

<?php get_footer(); ?>
