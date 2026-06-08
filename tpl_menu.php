<?php
/*
	Template Name: Menu
*/
get_header();

$menu_data = function_exists( 'vqdev_toast_get_menu_data' ) ? vqdev_toast_get_menu_data() : null;
?>

<div class="sp sp-page" data-screen-label="Menu">

	<?php /* ── HERO ─────────────────────────────────────────────────── */ ?>
	<section class="sp-menu-hero position-relative">
		<div class="container sp-menu-hero__inner position-relative text-center">
			<span class="sp-script sp-menu-hero__kicker">au menu</span>
			<h1 class="sp-menu-hero__title fw-normal mt-1">The bistro <em>menu</em></h1>
			<p class="sp-menu-hero__body mt-4 mx-auto">
				A short, seasonal menu of French bistro classics &mdash; written each Monday,
				cooked through Saturday. Available for lunch and dinner.
			</p>
		</div>

		<div class="sp-menu-hero__strip row g-0">
			<div class="col-3">
				<div class="sp-photo sp-photo--cream sp-menu-hero__photo">
					<span class="sp-photo__label">Caf&eacute; detail</span>
				</div>
			</div>
			<div class="col-6">
				<div class="sp-photo sp-photo--brown sp-menu-hero__photo">
					<span class="sp-photo__label">Bistro dining room &mdash; wide</span>
				</div>
			</div>
			<div class="col-3">
				<div class="sp-photo sp-menu-hero__photo">
					<span class="sp-photo__label">Plated dish</span>
				</div>
			</div>
		</div>
	</section>

	<?php /* ── MENU ─────────────────────────────────────────────────── */ ?>
	<?php if ( ! $menu_data || empty( $menu_data['tabs'] ) ) : ?>
		<section class="sp-menu sp-menu--empty">
			<div class="container">
				<div class="alert alert-warning mb-0">
					Menu is currently unavailable. Please check back later.
				</div>
			</div>
		</section>
	<?php else :
		$theme_uri = get_stylesheet_directory_uri();
		$theme_dir = get_stylesheet_directory();
		$js_rel    = '/assets/restaurant-menu/restaurant-menu.js';
		if ( file_exists( $theme_dir . $js_rel ) ) {
			wp_enqueue_script( 'vq-restaurant-menu', $theme_uri . $js_rel, array(), filemtime( $theme_dir . $js_rel ), true );
		}
		$tabs = $menu_data['tabs'];
	?>
	<section class="sp-menu">
		<div class="container">
			<div class="sp-chalk sp-menu__chalk">
				<div class="sp-menu__head text-center">
					<span class="sp-menu__kicker">Bienvenue chez nous</span>
					<h2 class="sp-menu__title fst-italic mt-1">La Carte</h2>
					<?php if ( ! empty( $menu_data['updated'] ) ) : ?>
						<div class="sp-menu__meta text-uppercase mt-3">
							Updated &middot; <?php echo esc_html( $menu_data['updated'] ); ?>
						</div>
					<?php endif; ?>
				</div>

				<div class="sp-menu__desktop d-none d-lg-block">
					<?php include get_stylesheet_directory() . '/templates/menu-tabs.php'; ?>
				</div>

				<div class="sp-menu__mobile d-lg-none">
					<?php include get_stylesheet_directory() . '/templates/menu-mobile.php'; ?>
				</div>

				<p class="sp-menu__footnote text-center text-uppercase mt-5 mb-0">
					20% gratuity added for parties of 6 or more &middot; gluten-free bread on request
				</p>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<?php /* ── RESERVATION CALLOUT ─────────────────────────────────── */ ?>
	<section class="sp-menu-cta">
		<div class="container">
			<div class="sp-menu-cta__card row g-0 overflow-hidden rounded">
				<div class="col-12 col-md-7 position-relative sp-menu-cta__left">
					<span class="sp-script sp-menu-cta__kicker">&agrave; bient&ocirc;t</span>
					<h2 class="sp-menu-cta__title mt-2">
						Reserve a table<br/>for <em>two &mdash; or twelve.</em>
					</h2>
					<p class="sp-menu-cta__body mt-4">
						We seat parties of any size. Walk-ins welcome at the counter and
						the bar; reservations recommended for the dining room.
					</p>
					<div class="d-flex flex-wrap gap-3 mt-4">
						<a href="#" class="sp-btn sp-btn--primary">Book a table</a>
						<a href="#" class="sp-btn sp-btn--ghost">Private dining &rarr;</a>
					</div>
				</div>
				<div class="col-12 col-md-5 sp-menu-cta__right">
					<div class="sp-eyebrow mb-3">Hours of service</div>
					<dl class="sp-menu-cta__hours mb-0">
						<dt>Lunch</dt><dd>Mon &ndash; Sat &middot; 11 &ndash; 2:30</dd>
						<dt>Caf&eacute;</dt><dd>Mon &ndash; Sat &middot; all day</dd>
						<dt>Dinner</dt><dd>Mon &ndash; Sat &middot; 5 &ndash; 9:45</dd>
						<dt>Sunday</dt><dd>Closed &mdash; see you Monday</dd>
					</dl>
					<hr class="sp-menu-cta__rule" />
					<div class="sp-eyebrow mb-2">Find us</div>
					<p class="sp-menu-cta__addr mb-0">
						1040 Broadway, Columbus, GA 31901<br/>
						(706) 984-8004
					</p>
				</div>
			</div>
		</div>
	</section>

</div><?php /* .sp.sp-page */ ?>

<?php get_footer(); ?>
