<?php
/*
	Template Name: Apply / Careers Page
*/
/**
 * Valor Care — Apply / Careers page template.
 *
 * Wraps the Caregiver Application Gravity Form (ID 2) in the Valor Care brand
 * look-and-feel (same Bootstrap 5 + shared CSS as the homepage/contact page).
 * Fully CMB2-driven (see inc/cmb2-apply-fields.php): every field falls back to
 * its design default until a real value is saved.
 *
 * The form is rendered from a Gravity Forms shortcode set in the backend
 * (defaults to form ID 2). Header & footer are handled by the theme options.
 *
 * @package Pegasus_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'vc_apply_val' ) ) {
	/**
	 * Scalar Apply-page field value with design-default fallback.
	 *
	 * @param string $key Key without the vc_ prefix (e.g. 'apply_title').
	 * @return string
	 */
	function vc_apply_val( $key ) {
		$v = get_post_meta( get_the_ID(), 'vc_' . $key, true );
		if ( '' === $v || null === $v ) {
			return function_exists( 'valorcare_apply_default' ) ? valorcare_apply_default( $key ) : '';
		}
		return $v;
	}
}

if ( ! function_exists( 'vc_apply_rows' ) ) {
	/**
	 * Repeatable group rows with design-default fallback. Blank rows are
	 * stripped so the design defaults show until real content is entered.
	 *
	 * @param string $key Group key without the vc_ prefix (e.g. 'apply_points').
	 * @return array
	 */
	function vc_apply_rows( $key ) {
		$defaults = function_exists( 'valorcare_apply_defaults' ) ? valorcare_apply_defaults() : array();
		$rows     = get_post_meta( get_the_ID(), 'vc_' . $key, true );

		if ( is_array( $rows ) ) {
			$rows = array_values( array_filter(
				$rows,
				function( $row ) {
					if ( ! is_array( $row ) ) {
						return '' !== trim( (string) $row );
					}
					foreach ( $row as $field_key => $value ) {
						if ( '_id' === substr( $field_key, -3 ) ) {
							continue;
						}
						if ( '' !== trim( (string) $value ) ) {
							return true;
						}
					}
					return false;
				}
			) );
		}

		if ( empty( $rows ) ) {
			return isset( $defaults[ $key ] ) ? $defaults[ $key ] : array();
		}
		return $rows;
	}
}

get_header();

// Match the parent's full-width template: header-three needs the additional
// header included explicitly.
$header_choice = function_exists( 'pegasus_get_option' ) ? pegasus_get_option( 'header_select' ) : '';
if ( 'header-three' === $header_choice ) {
	get_template_part( 'templates/additional_header' );
}
?>

<div id="page-wrap">
	<div class="vc-home vc-apply-page">

		<?php while ( have_posts() ) : the_post(); ?>

		<!-- ============================ HERO ============================ -->
		<section class="vc-svc-hero">
			<div class="container py-5">
				<div class="row g-5 align-items-end py-lg-3">
					<div class="col-lg-7">
						<div class="vc-eyebrow vc-eyebrow--light"><?php echo esc_html( vc_apply_val( 'apply_eyebrow' ) ); ?></div>
						<h1 class="vc-serif vc-h1 vc-svc-hero__title"><?php echo wp_kses_post( vc_apply_val( 'apply_title' ) ); ?></h1>
					</div>
					<div class="col-lg-5">
						<p class="vc-svc-hero__intro"><?php echo nl2br( esc_html( vc_apply_val( 'apply_intro' ) ) ); ?></p>
					</div>
				</div>
			</div>
		</section>

		<!-- ========================= APPLICATION ======================== -->
		<section class="vc-apply py-5">
			<div class="container py-lg-4">
				<div class="row g-5">

					<!-- Supporting column -->
					<div class="col-lg-4">
						<div class="vc-apply-aside">
							<h2 class="vc-serif vc-title"><?php echo esc_html( vc_apply_val( 'apply_aside_title' ) ); ?></h2>
							<div class="vc-rule"></div>
							<p class="vc-lead"><?php echo nl2br( esc_html( vc_apply_val( 'apply_aside_text' ) ) ); ?></p>

							<?php $apply_points = vc_apply_rows( 'apply_points' ); if ( $apply_points ) : ?>
								<ul class="vc-apply-list">
									<?php foreach ( $apply_points as $pt ) : ?>
										<li><i class="fa fa-check-circle vc-check-icon"></i><span><?php echo esc_html( isset( $pt['text'] ) ? $pt['text'] : '' ); ?></span></li>
									<?php endforeach; ?>
								</ul>
							<?php endif; ?>

							<?php $prn = trim( (string) vc_apply_val( 'apply_prn_notice' ) ); if ( '' !== $prn ) : ?>
								<div class="vc-apply-notice">
									<div class="vc-apply-notice__label"><i class="fa fa-info-circle me-2"></i>PRN Notice</div>
									<p class="mb-0"><?php echo nl2br( esc_html( $prn ) ); ?></p>
								</div>
							<?php endif; ?>

							<?php $note = trim( (string) vc_apply_val( 'apply_contact_note' ) ); if ( '' !== $note ) : ?>
								<p class="vc-apply-contact-note"><?php echo nl2br( esc_html( $note ) ); ?></p>
							<?php endif; ?>
						</div>
					</div>

					<!-- Form card -->
					<div class="col-lg-8">
						<div class="vc-form-card p-4 p-md-5">
							<h2 class="vc-serif vc-form-title mb-4"><?php echo esc_html( vc_apply_val( 'apply_form_title' ) ); ?></h2>
							<?php
							$apply_shortcode = trim( (string) vc_apply_val( 'apply_form_shortcode' ) );
							$gf_active       = class_exists( 'GFForms' ) || function_exists( 'gravity_form' );

							if ( '' === $apply_shortcode ) {
								// Form intentionally hidden via the backend — show nothing.
								echo '';
							} elseif ( ! $gf_active ) {
								echo '<p class="vc-form-note">The application form is temporarily unavailable. Please call us at 770-910-CARE (2273) and we\'ll be glad to help.</p>';
							} else {
								echo do_shortcode( $apply_shortcode );
							}
							?>
						</div>
					</div>

				</div>
			</div>
		</section>

		<?php endwhile; ?>

	</div><!-- .vc-apply-page -->
</div><!-- #page-wrap -->

<?php get_footer(); ?>
