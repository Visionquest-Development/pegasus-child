<?php
/**
 * The template for displaying product content within loops.
 * Sugarpeddler — renders each product as an .sp-card.
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

$product_categories = wp_get_post_terms( $product->get_id(), 'product_cat' );
$category_label     = ! is_wp_error( $product_categories ) && isset( $product_categories[0] ) ? $product_categories[0]->name : '';

$on_sale     = $product->is_on_sale();
$is_new      = ( time() - get_post_time( 'U', false, $product->get_id() ) ) < ( 30 * DAY_IN_SECONDS );
$badge_label = '';
$badge_tone  = '';
if ( $on_sale ) {
	$badge_label = __( 'Sale', 'pegasus-child' );
} elseif ( $is_new ) {
	$badge_label = __( 'New', 'pegasus-child' );
}

$is_out_of_stock = ! $product->is_in_stock();
if ( $is_out_of_stock ) {
	$badge_label = __( 'Sold out', 'pegasus-child' );
	$badge_tone  = 'cream';
}

$image_id  = $product->get_image_id();
$image_url = $image_id ? wp_get_attachment_image_url( $image_id, 'woocommerce_thumbnail' ) : '';
?>

<div class="sp-shop-grid__item py-5 col-12 col-sm-6 col-md-4">
	<article <?php wc_product_class( 'sp-card', $product ); ?>>
		<a href="<?php the_permalink(); ?>" class="sp-card__img sp-photo position-relative d-block">
			<?php if ( $badge_label ) : ?>
				<span class="sp-badge<?php echo $badge_tone ? ' sp-badge--' . esc_attr( $badge_tone ) : ''; ?>"><?php echo esc_html( $badge_label ); ?></span>
			<?php endif; ?>
			<?php if ( $image_url ) : ?>
				<img class="position-absolute top-0 start-0 w-100 h-100 sp-card__photo" src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $product->get_name() ); ?>" loading="lazy" />
			<?php else : ?>
				<div class="sp-photo sp-photo--cream position-absolute top-0 start-0 w-100 h-100">
					<span class="sp-photo__label"><?php echo esc_html( $product->get_name() ); ?></span>
				</div>
			<?php endif; ?>
		</a>
		<div>
			<?php if ( $category_label ) : ?>
				<div class="sp-card__cat"><?php echo esc_html( $category_label ); ?></div>
			<?php endif; ?>
			<h3 class="sp-card__title mt-1">
				<a href="<?php the_permalink(); ?>"><?php echo esc_html( $product->get_name() ); ?></a>
			</h3>
		</div>
		<div class="sp-card__row">
			<div class="sp-card__price">
				<?php echo wp_kses_post( $product->get_price_html() ); ?>
			</div>
			<?php
			woocommerce_template_loop_add_to_cart( array( 'class' => 'sp-card__add' ) );
			?>
		</div>
	</article>
</div>
