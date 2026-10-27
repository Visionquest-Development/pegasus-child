<?php
/**
 * Inner-page hero band with the page's single H1.
 * Args: image (slug in data/images.json), eyebrow, title (defaults to page title), lead.
 */
$args    = isset( $args ) && is_array( $args ) ? $args : array();
$image   = $args['image'] ?? 'smoker-meats';
$title   = $args['title'] ?? get_the_title();
$eyebrow = $args['eyebrow'] ?? mng_site( 'tagline' );
$lead    = $args['lead'] ?? '';
?>
<section class="mng-page-hero" style="<?php echo esc_attr( mng_bg_style( $image ) ); ?>">
	<div class="mng-page-hero__overlay"></div>
	<div class="container mng-page-hero__inner">
		<p class="mng-script mng-page-hero__eyebrow wow fadeInDown"><?php echo esc_html( $eyebrow ); ?></p>
		<h1 class="mng-page-hero__title wow fadeInUp"><?php echo esc_html( $title ); ?></h1>
		<?php if ( $lead ) : ?>
			<p class="mng-page-hero__lead wow fadeInUp" data-wow-delay=".15s"><?php echo esc_html( $lead ); ?></p>
		<?php endif; ?>
	</div>
	<div class="mng-flames" aria-hidden="true"></div>
</section>
