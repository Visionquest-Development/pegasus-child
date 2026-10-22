<?php
/**
 * Inner-page hero band with the page's single H1.
 * Args: image (slug in data/images.json), eyebrow, title (defaults to page title), lead.
 */
$args    = isset( $args ) && is_array( $args ) ? $args : array();
$image   = $args['image'] ?? 'hero-sushi-combo';
$title   = $args['title'] ?? get_the_title();
$eyebrow = $args['eyebrow'] ?? rusans_site( 'name' );
$lead    = $args['lead'] ?? '';
?>
<section class="rusans-page-hero" style="<?php echo esc_attr( rusans_bg_style( $image ) ); ?>">
	<div class="rusans-page-hero__overlay"></div>
	<div class="container rusans-page-hero__inner">
		<p class="rusans-eyebrow wow fadeInDown"><?php echo esc_html( $eyebrow ); ?></p>
		<h1 class="rusans-page-hero__title wow fadeInUp"><?php echo esc_html( $title ); ?></h1>
		<?php if ( $lead ) : ?>
			<p class="rusans-page-hero__lead wow fadeInUp" data-wow-delay=".15s"><?php echo esc_html( $lead ); ?></p>
		<?php endif; ?>
	</div>
</section>
