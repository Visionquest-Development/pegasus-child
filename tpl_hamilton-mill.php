<?php
/*
	Template Name: Hamilton Mill Landing
*/

/**
 * Hamilton Mill neighborhood landing page (print-ad entry point).
 *
 * How the pieces fit together:
 *   - Give this page the slug you want (e.g. "hamilton-mill" or "hamill") in the
 *     WordPress editor — that becomes the memorable print-ad URL.
 *   - Residents sign up with the registration form below (or the normal
 *     registration page). Signing up does NOT grant delivery on its own.
 *   - After the client confirms the address is inside Hamilton Mill, he changes
 *     that user's role to "Hamilton Mill" in Users -> (edit user) -> Role.
 *   - Only users with the hamilton_mill role then see the $1.50 "Local Delivery"
 *     shipping option at checkout. See add_hamilton_mill_role() and
 *     hamilton_mill_filter_delivery_rate() in functions.php, plus
 *     HAMILTON-MILL-SETUP.md for the one-time WooCommerce admin setup.
 *
 * All copy + the hero image are editable in the page editor via the CMB2
 * "Hamilton Mill — …" metaboxes (see inc/outlaw-hamilton-fields.php). Every
 * field falls back to the defaults in och_hamilton_defaults() until edited.
 * Styling reuses the homepage design system (.och-* classes in style.css); a
 * small scoped block below covers only the bits unique to this page.
 */

get_header();

$d = och_hamilton_defaults();

$hm_star = '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" focusable="false"><path d="M12 2l2.9 6.2 6.6.9-4.8 4.6 1.2 6.5L12 17.8 6.1 20.7l1.2-6.5L2.5 9.6l6.6-.9z"/></svg>';

$hm_form_id = (int) och_field( 'hm_signup_form_id', $d['signup']['form_id'] );
?>

<style>
/* Scoped styles for the Hamilton Mill landing page only. */
.hm-page .och-hero { background: var(--och-cream); }
.hm-page .hm-signup { background: var(--och-tan); color: var(--och-dark); }
.hm-page .hm-signup__card {
	background: #fff;
	border-radius: 14px;
	padding: 28px 24px;
	box-shadow: 0 14px 40px rgba(42, 29, 19, .12);
}
.hm-page .hm-hero__note {
	display: inline-flex;
	align-items: center;
	gap: 8px;
	margin-top: 6px;
	padding: 8px 14px;
	border-radius: 999px;
	background: rgba(199, 72, 27, .1);
	color: var(--och-rust);
	font-weight: 600;
}
.hm-page .hm-hero__note svg { width: 18px; height: 18px; }
</style>

<div id="page-wrap">
	<div class="och-home hm-page">

		<?php // ===================================================== HERO ?>
		<section class="och-section och-hero">
			<div class="container">
				<div class="row align-items-center g-4 g-lg-5">
					<div class="col-12 col-lg-7 och-hero__content">
						<p class="och-eyebrow">
							<span class="och-eyebrow__icon"><?php echo $hm_star; // phpcs:ignore ?></span>
							<?php echo esc_html( och_field( 'hm_hero_eyebrow', $d['hero']['eyebrow'] ) ); ?>
						</p>
						<h1 class="och-h1"><?php echo esc_html( och_field( 'hm_hero_title', $d['hero']['title'] ) ); ?></h1>
						<p class="och-hero__lead"><?php echo wp_kses_post( och_field( 'hm_hero_text', $d['hero']['text'] ) ); ?></p>

						<div class="och-btn-row">
							<a class="och-btn och-btn--rust" href="<?php echo esc_url( och_field( 'hm_hero_btn1_url', $d['hero']['btn1_url'] ) ); ?>"><?php echo esc_html( och_field( 'hm_hero_btn1_text', $d['hero']['btn1_text'] ) ); ?></a>
							<a class="och-btn och-btn--outline" href="<?php echo esc_url( och_field( 'hm_hero_btn2_url', $d['hero']['btn2_url'] ) ); ?>"><?php echo esc_html( och_field( 'hm_hero_btn2_text', $d['hero']['btn2_text'] ) ); ?></a>
						</div>

						<p class="hm-hero__note">
							<?php echo $hm_star; // phpcs:ignore ?>
							<?php echo esc_html( och_field( 'hm_hero_note', $d['hero']['note'] ) ); ?>
						</p>
					</div>

					<div class="col-12 col-lg-5">
						<div class="och-hero__media">
							<?php och_image( 'hm_hero_image', 'och-hero__img', 'Drop hero image — delivery / neighborhood', 'Outlaw Coffee delivered in Hamilton Mill' ); ?>
						</div>
					</div>
				</div>
			</div>
		</section>

		<?php // ============================================== HOW IT WORKS ?>
		<section class="och-section och-valueprops">
			<div class="container">
				<div class="och-shop__head">
					<div class="och-shop__heading">
						<p class="och-eyebrow och-eyebrow--plain"><?php echo esc_html( och_field( 'hm_steps_eyebrow', $d['steps_heading']['eyebrow'] ) ); ?></p>
						<h2 class="och-h2"><?php echo esc_html( och_field( 'hm_steps_title', $d['steps_heading']['title'] ) ); ?></h2>
					</div>
				</div>
				<div class="row row-cols-1 row-cols-md-3 g-4 g-lg-5">
					<?php foreach ( och_group( 'hm_steps', $d['steps'], array( 'title', 'text' ) ) as $step ) : ?>
						<div class="col">
							<div class="och-vp">
								<div class="och-vp__icon"><?php echo och_icon( isset( $step['icon'] ) ? $step['icon'] : 'cup' ); // phpcs:ignore ?></div>
								<h3 class="och-vp__title"><?php echo esc_html( isset( $step['title'] ) ? $step['title'] : '' ); ?></h3>
								<p class="och-vp__text"><?php echo esc_html( isset( $step['text'] ) ? $step['text'] : '' ); ?></p>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<?php // ================================================== SIGN UP ?>
		<section id="hm-signup" class="och-section hm-signup">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-12 col-lg-8">
						<div class="hm-signup__card">
							<p class="och-eyebrow och-eyebrow--brown"><?php echo esc_html( och_field( 'hm_signup_eyebrow', $d['signup']['eyebrow'] ) ); ?></p>
							<h2 class="och-h2"><?php echo esc_html( och_field( 'hm_signup_title', $d['signup']['title'] ) ); ?></h2>
							<p class="och-featured__text"><?php echo wp_kses_post( och_field( 'hm_signup_text', $d['signup']['text'] ) ); ?></p>
							<?php echo do_shortcode( '[wpforms id="' . $hm_form_id . '"]' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- WPForms-generated markup. ?>
						</div>
					</div>
				</div>
			</div>
		</section>

		<?php // ================================================ SHOP GRID ?>
		<section class="och-section och-shop">
			<div class="container">
				<div class="och-shop__head">
					<div class="och-shop__heading">
						<p class="och-eyebrow och-eyebrow--plain"><?php echo esc_html( och_field( 'hm_shop_eyebrow', $d['shop']['eyebrow'] ) ); ?></p>
						<h2 class="och-h2"><?php echo esc_html( och_field( 'hm_shop_title', $d['shop']['title'] ) ); ?></h2>
					</div>
				</div>
				<div class="och-shop__products">
					<?php echo do_shortcode( '[featured_products per_page="4" columns="4"]' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- WooCommerce-generated markup. ?>
				</div>
				<div class="och-btn-row" style="justify-content:center;margin-top:28px;">
					<a class="och-btn och-btn--dark" href="<?php echo esc_url( och_field( 'hm_shop_btn_url', $d['shop']['btn_url'] ) ); ?>"><?php echo esc_html( och_field( 'hm_shop_btn_text', $d['shop']['btn_text'] ) ); ?></a>
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

	</div><!-- .och-home.hm-page -->
</div><!-- #page-wrap -->

<?php get_footer(); ?>
