<?php
/**
 * Template Name: RC Contact
 * File: tpl_contact.php
 *
 * Contact page for Russell Contracting. Content is driven by CMB2 metaboxes
 * defined in inc/cmb2-fields.php; missing values fall back to the design
 * defaults in RC_Defaults so the page renders correctly on a fresh install.
 *
 * Layout mirrors tpl_services.php:
 *   - Page title block (.rc-svc-title-block)
 *   - Two-column section (.rc-svc): info + tiles on the left, form on the right
 *   - Bottom CTA band (.rc-cta)
 *
 * When no form shortcode is configured, the info column expands full-width so
 * the page still looks intentional.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

/* Page title block */
$header_defaults = RC_Defaults::contact_page_header();
$page_title    = rc_field( 'rc_contact_page_title',    $header_defaults['title'] );
$page_subtitle = rc_field( 'rc_contact_page_subtitle', $header_defaults['subtitle'] );

/* Info column */
$info_intro   = RC_Defaults::contact_info_intro();
$info_eyebrow = rc_field( 'rc_contact_info_eyebrow', $info_intro['eyebrow'] );
$info_lead    = rc_field( 'rc_contact_info_lead',    $info_intro['lead'] );
$info_tiles   = rc_group( 'rc_contact_tiles', RC_Defaults::contact_info_tiles() );

/* Form column */
$form_defaults  = RC_Defaults::contact_form_intro();
$form_eyebrow   = rc_field( 'rc_contact_form_eyebrow',   $form_defaults['eyebrow'] );
$form_lead      = rc_field( 'rc_contact_form_lead',      $form_defaults['lead'] );
$form_shortcode = rc_field( 'rc_contact_form_shortcode', $form_defaults['shortcode'] );
$has_form       = ( '' !== trim( (string) $form_shortcode ) );

/* Bottom CTA */
$cta_defaults = RC_Defaults::contact_cta();
$cta_headline = rc_field( 'rc_contact_cta_headline', $cta_defaults['headline'] );
$cta_subhead  = rc_field( 'rc_contact_cta_subhead',  $cta_defaults['subhead'] );
$cta_btn_text = rc_field( 'rc_contact_cta_btn_text', $cta_defaults['btn_text'] );
$cta_btn_url  = rc_link( rc_field( 'rc_contact_cta_btn_url', $cta_defaults['btn_url'] ) );

?>

<!-- ============ PAGE TITLE ============ -->
<div class="rc-svc-title-block">
	<div class="container">
		<h1 class="rc-svc-title"><?php echo esc_html( $page_title ); ?></h1>
		<p class="rc-svc-subtitle"><?php echo esc_html( $page_subtitle ); ?></p>
	</div>
</div>

<!-- ============ CONTACT INFO ============ -->
<section class="rc-svc rc-contact">
	<div class="container">
		<div class="row">
			<div class="col-lg-10 offset-lg-1 text-center text-lg-start">
				<h2 class="rc-eyebrow text-white"><?php echo esc_html( $info_eyebrow ); ?></h2>
				<p class="rc-svc__lead"><?php echo esc_html( $info_lead ); ?></p>
			</div>
		</div>

		<?php if ( ! empty( $info_tiles ) ) : ?>
			<div class="row g-3 mt-3">
				<?php foreach ( $info_tiles as $tile ) :
					$icon  = isset( $tile['icon'] )  ? $tile['icon']  : 'bi-info-circle-fill';
					$label = isset( $tile['label'] ) ? $tile['label'] : '';
					$value = isset( $tile['value'] ) ? $tile['value'] : '';
					$link  = isset( $tile['link'] )  ? trim( (string) $tile['link'] ) : '';
					if ( '' === trim( $value ) && '' === trim( $label ) ) {
						continue;
					}
				?>
					<div class="col-md-6 col-lg-3">
						<div class="rc-why-tile rc-contact-tile">
							<div class="rc-why-ico"><i class="bi <?php echo esc_attr( $icon ); ?>"></i></div>
							<div>
								<h4 class="rc-why-tile__title"><?php echo esc_html( $label ); ?></h4>
								<p class="rc-why-tile__text">
									<?php if ( '' !== $link ) : ?>
										<a href="<?php echo rc_link( $link ); ?>"><?php echo esc_html( $value ); ?></a>
									<?php else : ?>
										<?php echo esc_html( $value ); ?>
									<?php endif; ?>
								</p>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>

<?php if ( $has_form ) : ?>
	<!-- ============ CONTACT FORM (Gravity Forms shortcode) ============
	     Rendered as its own .rc-svc block so it picks up the alternating
	     background + gold hairline divider from the services-page pattern. -->
	<section class="rc-svc rc-contact-form" id="contact-form">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center text-lg-start">
					<h2 class="rc-eyebrow text-white"><?php echo esc_html( $form_eyebrow ); ?></h2>
					<p class="rc-svc__lead"><?php echo esc_html( $form_lead ); ?></p>
				</div>
			</div>
			<div class="row mt-3">
				<div class="col-lg-8 offset-lg-2">
					<div class="rc-contact-form-wrap">
						<div class="rc-contact-form-body">
							<?php
							/* Gravity Forms shortcode (or any form plugin's shortcode) is
							 * pulled from CMB2 field rc_contact_form_shortcode. Example:
							 *   [gravityform id="1" title="false" description="false" ajax="true"] */
							echo do_shortcode( wp_kses_post( $form_shortcode ) );
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>

<!-- ============ BOTTOM CTA ============ -->
<section class="rc-cta rc-cta--no-bottom-border">
	<div class="container">
		<div class="row align-items-center g-3 text-center text-lg-start">
			<div class="col-lg-8">
				<h2 class="rc-cta__title"><?php echo esc_html( $cta_headline ); ?></h2>
				<p class="rc-cta__subhead"><?php echo esc_html( $cta_subhead ); ?></p>
			</div>
			<div class="col-lg-4 text-lg-end">
				<a href="<?php echo $cta_btn_url; ?>" class="rc-btn-gold rc-btn-gold--xl"><i class="bi bi-telephone-fill me-2"></i><?php echo esc_html( $cta_btn_text ); ?></a>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();
