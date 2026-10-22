<?php
/**
 * Inner-page hero with the page's single H1, plus visible breadcrumbs.
 * Args: title, lead, eyebrow, image (slug), cta (bool).
 */
$args    = isset( $args ) && is_array( $args ) ? $args : array();
$title   = $args['title'] ?? get_the_title();
$lead    = $args['lead'] ?? '';
$eyebrow = $args['eyebrow'] ?? '';
$cta     = $args['cta'] ?? true;
?>
<section class="igj-page-hero">
	<div class="container">
		<?php get_template_part( 'templates/igj-breadcrumbs' ); ?>
		<?php if ( $eyebrow ) : ?>
			<p class="igj-eyebrow"><?php echo esc_html( $eyebrow ); ?></p>
		<?php endif; ?>
		<h1 class="igj-page-hero__title"><?php echo esc_html( wp_strip_all_tags( $title ) ); ?></h1>
		<?php if ( $lead ) : ?>
			<p class="igj-page-hero__lead"><?php echo wp_kses_post( $lead ); ?></p>
		<?php endif; ?>
		<?php if ( $cta ) : ?>
			<div class="igj-actions">
				<a class="btn igj-btn igj-btn--cta" href="<?php echo esc_url( igj_contact_url( 'quote-form' ) ); ?>"><?php esc_html_e( 'Get a Free Quote', 'pegasus' ); ?></a>
				<a class="btn igj-btn igj-btn--outline-light" href="tel:<?php echo esc_attr( igj_site( 'phone_e164' ) ); ?>"><i class="fa fa-phone" aria-hidden="true"></i> <?php printf( esc_html__( 'Call %s', 'pegasus' ), esc_html( igj_site( 'phone_display' ) ) ); ?></a>
			</div>
		<?php endif; ?>
	</div>
</section>
