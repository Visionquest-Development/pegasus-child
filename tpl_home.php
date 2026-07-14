<?php
/*
	Template Name: Home Template
*/

get_header();

/**
 * Homepage content is driven by the CMB2 fields registered in
 * inc/outlaw-home-fields.php. Every value falls back to the Claude Design
 * default (see och_home_defaults()) until it is edited in the page editor.
 *
 * Header + footer are intentionally left to the theme options.
 * Each section is full-bleed for its background colour but scopes its content
 * to a Bootstrap .container so nothing overflows on mobile.
 */
$d = och_home_defaults();

/** Reusable single-star SVG (filled). */
$och_star = '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" focusable="false"><path d="M12 2l2.9 6.2 6.6.9-4.8 4.6 1.2 6.5L12 17.8 6.1 20.7l1.2-6.5L2.5 9.6l6.6-.9z"/></svg>';
?>

<div id="page-wrap">
	<div class="och-home">

		<?php // ===================================================== HERO ?>
		<section class="och-section och-hero">
			<div class="container">
				<div class="row align-items-center g-4 g-lg-5">
					<div class="col-12 col-lg-6 och-hero__content">
						<p class="och-eyebrow">
							<span class="och-eyebrow__icon"><?php echo $och_star; // phpcs:ignore ?></span>
							<?php echo esc_html( och_field( 'hero_eyebrow', $d['hero']['eyebrow'] ) ); ?>
						</p>
						<h1 class="och-h1"><?php echo esc_html( och_field( 'hero_title', $d['hero']['title'] ) ); ?></h1>
						<p class="och-hero__lead"><?php echo wp_kses_post( och_field( 'hero_text', $d['hero']['text'] ) ); ?></p>

						<div class="och-btn-row">
							<a class="och-btn och-btn--rust" href="<?php echo esc_url( och_field( 'hero_btn1_url', $d['hero']['btn1_url'] ) ); ?>"><?php echo esc_html( och_field( 'hero_btn1_text', $d['hero']['btn1_text'] ) ); ?></a>
							<a class="och-btn och-btn--outline" href="<?php echo esc_url( och_field( 'hero_btn2_url', $d['hero']['btn2_url'] ) ); ?>"><?php echo esc_html( och_field( 'hero_btn2_text', $d['hero']['btn2_text'] ) ); ?></a>
						</div>

						<p class="och-rating">
							<span class="och-stars"><?php echo str_repeat( $och_star, 5 ); // phpcs:ignore ?></span>
							<?php echo esc_html( och_field( 'hero_rating', $d['hero']['rating'] ) ); ?>
						</p>
					</div>

					<div class="col-12 col-lg-6">
						<div class="och-hero__media">
							<?php och_image( 'hero_image', 'och-hero__img', 'Drop hero image — beans / brewing', 'Outlaw Coffee hero' ); ?>
							<span class="och-hero__badge"><?php echo esc_html( och_field( 'hero_badge', $d['hero']['badge'] ) ); ?></span>
						</div>
					</div>
				</div>
			</div>
		</section>

		<?php // ============================================== VALUE PROPS ?>
		<section class="och-section och-valueprops">
			<div class="container">
				<div class="row row-cols-1 row-cols-md-3 g-4 g-lg-5">
					<?php foreach ( och_group( 'value_props', $d['value_props'], array( 'title', 'text' ) ) as $vp ) : ?>
						<div class="col">
							<div class="och-vp">
								<div class="och-vp__icon"><?php echo och_icon( isset( $vp['icon'] ) ? $vp['icon'] : 'cup' ); // phpcs:ignore ?></div>
								<h3 class="och-vp__title"><?php echo esc_html( isset( $vp['title'] ) ? $vp['title'] : '' ); ?></h3>
								<p class="och-vp__text"><?php echo esc_html( isset( $vp['text'] ) ? $vp['text'] : '' ); ?></p>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<?php // ================================================ SHOP GRID ?>
		<section class="och-section och-shop">
			<div class="container">
				<div class="och-shop__head">
					<div class="och-shop__heading">
						<p class="och-eyebrow och-eyebrow--plain"><?php echo esc_html( och_field( 'shop_eyebrow', $d['shop']['eyebrow'] ) ); ?></p>
						<h2 class="och-h2"><?php echo esc_html( och_field( 'shop_title', $d['shop']['title'] ) ); ?></h2>
					</div>
					<?php $filters = och_group( 'shop_filters', $d['shop']['filters'] ); ?>
					<?php if ( ! empty( $filters ) ) : ?>
						<div class="och-chips d-none">
							<?php foreach ( $filters as $i => $filter ) : ?>
								<span class="os-chip och-chip<?php echo ( 0 === $i ) ? ' och-chip--active' : ''; ?>"><?php echo esc_html( $filter ); ?></span>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</div>

				<?php
					// Real WooCommerce featured products drive the grid; the CMB2 /
					// Claude Design default cards show as a fallback when none are featured.
					$featured_html = do_shortcode( '[featured_products per_page="4" columns="4"]' );
					$has_featured  = ( false !== strpos( $featured_html, 'woocommerce-loop-product' ) );
				?>
				<?php if ( $has_featured ) : ?>
					<div class="och-shop__products">
						<?php echo $featured_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- WooCommerce-generated markup. ?>
					</div>
				<?php else : ?>
					<div class="row row-cols-2 row-cols-lg-4 g-3 g-lg-4">
						<?php foreach ( och_group( 'products', $d['products'], array( 'name', 'notes', 'price', 'image' ) ) as $i => $p ) : ?>
							<div class="col">
								<div class="och-card">
									<div class="och-card__media">
										<?php och_img_markup( isset( $p['image'] ) ? $p['image'] : '', 'och-card__img', 'Bag photo', ( isset( $p['name'] ) ? $p['name'] : 'Product' ) ); ?>
										<?php if ( ! empty( $p['badge'] ) ) : ?>
											<span class="och-card__badge"><?php echo esc_html( $p['badge'] ); ?></span>
										<?php endif; ?>
									</div>
									<div class="och-card__body">
										<h3 class="och-card__title"><?php echo esc_html( isset( $p['name'] ) ? $p['name'] : '' ); ?></h3>
										<p class="och-card__notes"><?php echo esc_html( isset( $p['notes'] ) ? $p['notes'] : '' ); ?></p>
										<div class="och-card__foot">
											<span class="och-card__price"><?php echo esc_html( isset( $p['price'] ) ? $p['price'] : '' ); ?></span>
											<a class="och-btn och-btn--rust och-btn--sm" href="<?php echo esc_url( ! empty( $p['button_url'] ) ? $p['button_url'] : '#' ); ?>"><?php echo esc_html( ! empty( $p['button_text'] ) ? $p['button_text'] : 'Add' ); ?></a>
										</div>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
		</section>

		<?php // ============================================ FEATURED ROAST ?>
		<section class="och-section och-featured">
			<div class="container">
				<div class="row align-items-center g-4 g-lg-5">
					<div class="col-12 col-lg-5">
						<div class="och-featured__media">
							<?php och_image( 'feat_image', 'och-featured__img', 'Campfire Gold bag / brew', 'Featured blend' ); ?>
						</div>
					</div>
					<div class="col-12 col-lg-7">
						<p class="och-eyebrow och-eyebrow--brown"><?php echo esc_html( och_field( 'feat_eyebrow', $d['featured']['eyebrow'] ) ); ?></p>
						<h2 class="och-h2"><?php echo esc_html( och_field( 'feat_title', $d['featured']['title'] ) ); ?></h2>
						<p class="och-featured__text"><?php echo wp_kses_post( och_field( 'feat_text', $d['featured']['text'] ) ); ?></p>

						<dl class="och-specs">
							<?php foreach ( och_group( 'feat_specs', $d['featured']['specs'], array( 'label', 'value' ) ) as $spec ) : ?>
								<div class="och-specs__row">
									<dt class="och-specs__label"><?php echo esc_html( isset( $spec['label'] ) ? $spec['label'] : '' ); ?></dt>
									<dd class="och-specs__value"><?php echo esc_html( isset( $spec['value'] ) ? $spec['value'] : '' ); ?></dd>
								</div>
							<?php endforeach; ?>
						</dl>

						<div class="och-featured__cta">
							<a class="och-btn och-btn--dark" href="<?php echo esc_url( och_field( 'feat_cta_url', $d['featured']['cta_url'] ) ); ?>"><?php echo esc_html( och_field( 'feat_cta_text', $d['featured']['cta_text'] ) ); ?></a>
							<span class="och-featured__note"><?php echo esc_html( och_field( 'feat_note', $d['featured']['note'] ) ); ?></span>
						</div>
					</div>
				</div>
			</div>
		</section>

		<?php // ============================================== BRAND STORY ?>
		<section id="our-story" class="och-section och-story">
			<div class="container">
				<div class="row align-items-center g-4 g-lg-5">
					<div class="col-12 col-lg-7 order-2 order-lg-1">
						<p class="och-eyebrow och-eyebrow--ember"><?php echo esc_html( och_field( 'story_eyebrow', $d['story']['eyebrow'] ) ); ?></p>
						<h2 class="och-h2 och-h2--light"><?php echo esc_html( och_field( 'story_title', $d['story']['title'] ) ); ?></h2>
						<p class="och-story__text"><?php echo wp_kses_post( och_field( 'story_text', $d['story']['text'] ) ); ?></p>

						<div class="och-story__cta">
							<a class="och-btn och-btn--rust" href="<?php echo esc_url( och_field( 'story_cta_url', $d['story']['cta_url'] ) ); ?>"><?php echo esc_html( och_field( 'story_cta_text', $d['story']['cta_text'] ) ); ?></a>
							<span class="och-flag">
								<span class="och-flag__icon" aria-hidden="true"></span>
								<span class="och-flag__text"><?php echo esc_html( och_field( 'story_flag_text', $d['story']['flag_text'] ) ); ?></span>
							</span>
						</div>
					</div>
					<div class="col-12 col-lg-5 order-1 order-lg-2">
						<div class="och-story__media">
							<?php och_image( 'story_image', 'och-story__img', 'Lifestyle / roastery', 'Outlaw Coffee story' ); ?>
						</div>
					</div>
				</div>
			</div>
		</section>

		<?php // ===================== Optional extra page body content ==== ?>
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				$extra = trim( get_the_content() );
				if ( '' !== $extra ) :
					?>
					<section class="och-section och-pagebody">
						<div class="container">
							<div class="row justify-content-center">
								<div class="col-12 col-lg-9"><?php the_content(); ?></div>
							</div>
						</div>
					</section>
					<?php
				endif;
			endwhile;
		endif;
		?>

	</div><!-- .och-home -->
</div><!-- #page-wrap -->

<?php get_footer(); ?>
