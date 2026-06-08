<?php
/**
 * The template for displaying single product content.
 * Sugarpeddler bistro/bakery design.
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

$product_cats = wp_get_post_terms( $product->get_id(), 'product_cat' );
$cat_label    = ! is_wp_error( $product_cats ) && isset( $product_cats[0] ) ? $product_cats[0]->name : '';

$rating_count   = $product->get_rating_count();
$average_rating = $product->get_average_rating();
?>

<?php /* ── BREADCRUMB ────────────────────────────────────────────── */ ?>
<div class="sp-product-crumb">
	<div class="container">
		<?php
		woocommerce_breadcrumb( array(
			'delimiter' => '<span class="sp-product-crumb__sep">/</span>',
			'wrap_before' => '<nav class="sp-product-crumb__nav text-uppercase" aria-label="breadcrumb">',
			'wrap_after'  => '</nav>',
			'before'      => '',
			'after'       => '',
		) );
		?>
	</div>
</div>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'sp-product', $product ); ?>>

	<?php /* ── PRODUCT MAIN ─────────────────────────────────────── */ ?>
	<section class="sp-product-main py-5">
		<div class="container">
			<div class="row g-5 align-items-start">

				<?php /* Gallery */ ?>
				<div class="col-12 col-lg-6 sp-product-gallery">
					<?php
					/**
					 * woocommerce_before_single_product_summary hook.
					 * 10: woocommerce_show_product_sale_flash
					 * 20: woocommerce_show_product_images
					 */
					do_action( 'woocommerce_before_single_product_summary' );
					?>
				</div>

				<?php /* Info */ ?>
				<div class="col-12 col-lg-6 sp-product-info">

					<?php if ( $cat_label ) : ?>
						<span class="sp-eyebrow"><?php echo esc_html( $cat_label ); ?></span>
					<?php endif; ?>

					<h1 class="sp-product-info__title fw-normal mt-2">
						<?php the_title(); ?>
					</h1>

					<?php if ( $rating_count > 0 || $product->get_sku() ) : ?>
						<div class="sp-product-info__meta d-flex flex-wrap align-items-center gap-3 mt-3">
							<?php if ( $rating_count > 0 ) : ?>
								<div class="sp-product-info__rating">
									<?php echo wp_kses_post( wc_get_rating_html( $average_rating, $rating_count ) ); ?>
								</div>
								<span class="sp-product-info__reviews">
									<?php echo esc_html( number_format( (float) $average_rating, 1 ) ); ?> &middot;
									<a href="#reviews"><?php echo esc_html( sprintf( _n( '%d review', '%d reviews', $rating_count, 'pegasus-child' ), $rating_count ) ); ?></a>
								</span>
							<?php endif; ?>
							<?php if ( $product->get_sku() ) : ?>
								<span class="sp-product-info__divider"></span>
								<span class="sp-product-info__sku">SKU: <?php echo esc_html( $product->get_sku() ); ?></span>
							<?php endif; ?>
						</div>
					<?php endif; ?>

					<div class="sp-product-info__price mt-4">
						<?php echo wp_kses_post( $product->get_price_html() ); ?>
					</div>

					<?php if ( $product->get_short_description() ) : ?>
						<div class="sp-product-info__short mt-3">
							<?php echo wp_kses_post( wpautop( $product->get_short_description() ) ); ?>
						</div>
					<?php endif; ?>

					<hr class="sp-product-info__rule" />

					<?php
					/**
					 * Add-to-cart form (handles simple, variable, grouped, external)
					 * Includes quantity input + add-to-cart button + variation selectors.
					 */
					do_action( 'woocommerce_single_product_summary' );
					?>

					<?php /* Meta strip — design's "Baked fresh / Local pickup / Delivery" */ ?>
					<div class="sp-product-info__meta-strip row g-3 mt-4">
						<div class="col-12 col-sm-4">
							<div class="sp-eyebrow">Baked fresh</div>
							<div class="sp-product-info__meta-val mt-1">every morning at 5am</div>
						</div>
						<div class="col-12 col-sm-4">
							<div class="sp-eyebrow">Local pickup</div>
							<div class="sp-product-info__meta-val mt-1">free at 1040 Broadway</div>
						</div>
						<div class="col-12 col-sm-4">
							<div class="sp-eyebrow">Delivery</div>
							<div class="sp-product-info__meta-val mt-1">$5 within Columbus city</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</section>

	<?php /* ── TABS (Description / Additional / Reviews) ────────── */ ?>
	<section class="sp-product-tabs-section">
		<div class="container">
			<?php
			/**
			 * woocommerce_after_single_product_summary hook:
			 * 10: woocommerce_output_product_data_tabs
			 * 20: woocommerce_upsell_display
			 * 30: woocommerce_output_related_products
			 */
			do_action( 'woocommerce_after_single_product_summary' );
			?>
		</div>
	</section>

</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
