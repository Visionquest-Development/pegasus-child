<?php
/**
 * The Template for displaying product archives, including the main shop page.
 *
 * Sugarpeddler bistro/bakery design — hero + toolbar + sidebar + grid + pagination.
 *
 * @see https://woo.com/document/template-structure/
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_main_content' );
?>

<?php /* ── PAGE HEADER ──────────────────────────────────────────── */ ?>
<section class="sp-shop-hero py-5 position-relative overflow-hidden">
	<div class="container text-center position-relative">
		<nav class="sp-shop-hero__crumbs text-uppercase mb-4">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
			<span class="sp-shop-hero__sep">/</span>
			<span class="sp-shop-hero__crumb-current">Shop</span>
		</nav>
		<span class="sp-script sp-shop-hero__kicker">la boutique</span>
		<h1 class="sp-shop-hero__title fw-normal mt-2">
			The <em>Sugarpeddler</em> shop
		</h1>
		<p class="sp-shop-hero__body mt-3 mx-auto">
			Bread, pastries, cakes, sandwiches, and a few sweet things in between.
			Pre-order by 4pm &mdash; pickup or local delivery the next day.
		</p>
	</div>
</section>

<?php /* ── TOOLBAR ─────────────────────────────────────────────── */ ?>
<section class="sp-shop-toolbar">
	<div class="container">
		<div class="row align-items-center g-3">
			<div class="col-12 col-md-6 sp-shop-toolbar__count">
				<?php woocommerce_result_count(); ?>
			</div>
			<div class="col-12 col-md-6">
				<div class="d-flex flex-wrap justify-content-md-end align-items-center gap-3 sp-shop-toolbar__right">
					<span class="sp-eyebrow">Sort by</span>
					<?php woocommerce_catalog_ordering(); ?>
				</div>
			</div>
		</div>
	</div>
</section>

<?php /* ── MAIN: SIDEBAR + GRID ────────────────────────────────── */ ?>
<section class="sp-shop">
	<div class="container">
		<div class="row g-5">

			<?php /* Sidebar */ ?>
			<aside class="col-12 col-lg-3 sp-shop-sidebar">

				<?php /* Categories */ ?>
				<div class="sp-shop-filter">
					<h4 class="sp-eyebrow sp-shop-filter__title">Categories</h4>
					<ul class="list-unstyled sp-shop-cats mt-3 mb-0">
						<?php
						$shop_page_url = function_exists( 'wc_get_page_id' ) ? get_permalink( wc_get_page_id( 'shop' ) ) : home_url( '/shop/' );
						$current_term  = is_product_category() ? get_queried_object() : null;
						$total_count   = function_exists( 'wp_count_posts' ) ? (int) wp_count_posts( 'product' )->publish : 0;
						?>
						<li>
							<a class="sp-shop-cats__link<?php echo ! $current_term ? ' is-active' : ''; ?>" href="<?php echo esc_url( $shop_page_url ); ?>">
								<span>All products</span>
								<span class="sp-shop-cats__count"><?php echo esc_html( '(' . $total_count . ')' ); ?></span>
							</a>
						</li>
						<?php
						$product_cats = get_terms( array(
							'taxonomy'   => 'product_cat',
							'hide_empty' => true,
						) );
						if ( ! is_wp_error( $product_cats ) && $product_cats ) :
							foreach ( $product_cats as $cat ) :
								$is_active = $current_term && (int) $current_term->term_id === (int) $cat->term_id;
						?>
							<li>
								<a class="sp-shop-cats__link<?php echo $is_active ? ' is-active' : ''; ?>" href="<?php echo esc_url( get_term_link( $cat ) ); ?>">
									<span><?php echo esc_html( $cat->name ); ?></span>
									<span class="sp-shop-cats__count">(<?php echo esc_html( $cat->count ); ?>)</span>
								</a>
							</li>
						<?php
							endforeach;
						endif;
						?>
					</ul>
				</div>

				<?php /* Price filter (WC widget if available) */ ?>
				<div class="sp-shop-filter">
					<h4 class="sp-eyebrow sp-shop-filter__title">Filter by price</h4>
					<div class="mt-3">
						<?php
						if ( class_exists( 'WC_Widget_Price_Filter' ) ) {
							the_widget( 'WC_Widget_Price_Filter', array( 'title' => '' ) );
						} else {
							echo '<p class="sp-shop-filter__hint">Enable the WooCommerce price-filter widget to use this control.</p>';
						}
						?>
					</div>
				</div>

				<?php /* Dietary — placeholder; wire to product attributes (pa_dietary) */ ?>
				<?php
				$dietary_attr = function_exists( 'wc_get_attribute_taxonomies' ) ? wc_get_attribute_taxonomies() : array();
				$has_dietary  = false;
				foreach ( (array) $dietary_attr as $a ) {
					if ( isset( $a->attribute_name ) && 'dietary' === $a->attribute_name ) {
						$has_dietary = true;
						break;
					}
				}
				if ( $has_dietary ) :
					$dietary_terms = get_terms( array( 'taxonomy' => 'pa_dietary', 'hide_empty' => true ) );
					if ( ! is_wp_error( $dietary_terms ) && $dietary_terms ) : ?>
						<div class="sp-shop-filter">
							<h4 class="sp-eyebrow sp-shop-filter__title">Dietary</h4>
							<ul class="list-unstyled sp-shop-checks mt-3 mb-0">
								<?php foreach ( $dietary_terms as $term ) :
									$active = ! empty( $_GET['filter_dietary'] ) && in_array( $term->slug, (array) explode( ',', wc_clean( wp_unslash( $_GET['filter_dietary'] ) ) ), true );
								?>
									<li class="sp-shop-checks__row">
										<a href="?filter_dietary=<?php echo esc_attr( $term->slug ); ?>" class="sp-shop-checks__link<?php echo $active ? ' is-active' : ''; ?>">
											<span class="sp-shop-checks__box" aria-hidden="true"></span>
											<span class="sp-shop-checks__label"><?php echo esc_html( $term->name ); ?></span>
											<span class="sp-shop-checks__count">(<?php echo esc_html( $term->count ); ?>)</span>
										</a>
									</li>
								<?php endforeach; ?>
							</ul>
						</div>
				<?php endif; endif; ?>

				<?php /* Promo card */ ?>
				<div class="sp-shop-promo position-relative overflow-hidden">
					<span class="sp-script sp-shop-promo__kicker">Petite carte</span>
					<h3 class="sp-shop-promo__title fst-italic mt-2">Sunday boxes</h3>
					<p class="sp-shop-promo__body mt-2">
						A curated box of six pastries delivered Saturday for Sunday morning.
					</p>
					<a href="#" class="sp-shop-promo__link text-uppercase mt-3 d-inline-flex align-items-center">
						Order <span class="ms-2">&rarr;</span>
					</a>
				</div>

			</aside>

			<?php /* Product grid */ ?>
			<div class="col-12 col-lg-9 sp-shop-main">

				<?php if ( woocommerce_product_loop() ) : ?>

					<?php do_action( 'woocommerce_before_shop_loop' ); ?>

					<div class="row g-4 sp-shop-grid">
						<?php
						if ( wc_get_loop_prop( 'total' ) ) {
							while ( have_posts() ) {
								the_post();
								do_action( 'woocommerce_shop_loop' );
								wc_get_template_part( 'content', 'product' );
							}
						}
						?>
					</div>

					<div class="sp-shop-pagination mt-5 pt-4">
						<?php do_action( 'woocommerce_after_shop_loop' ); ?>
					</div>

				<?php else : ?>
					<div class="alert alert-warning"><?php do_action( 'woocommerce_no_products_found' ); ?></div>
				<?php endif; ?>

			</div>

		</div>
	</div>
</section>

<?php
do_action( 'woocommerce_after_main_content' );
