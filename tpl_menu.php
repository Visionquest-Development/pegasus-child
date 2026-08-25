<?php
/*
	Template Name: Menu
*/
get_header();

$menu_data = function_exists( 'vqdev_toast_get_menu_data' ) ? vqdev_toast_get_menu_data() : null;
?>

<div class="sp sp-page" data-screen-label="Menu">

	<?php
	/* ── HERO ─────────────────────────────────────────────────────── */
	$hero_photos = array(
		array( 'key' => '_sp_menu_hero_image_left',   'col' => 'col-3', 'mod' => 'sp-photo--cream', 'label' => 'Café detail' ),
		array( 'key' => '_sp_menu_hero_image_center', 'col' => 'col-6', 'mod' => 'sp-photo--brown', 'label' => 'Bistro dining room — wide' ),
		array( 'key' => '_sp_menu_hero_image_right',  'col' => 'col-3', 'mod' => '',                'label' => 'Plated dish' ),
	);
	?>
	<section class="sp-menu-hero position-relative">
		<div class="container sp-menu-hero__inner position-relative text-center">
			<span class="sp-script sp-menu-hero__kicker"><?php echo esc_html( sp_menu_meta( '_sp_menu_hero_kicker' ) ); ?></span>
			<h1 class="sp-menu-hero__title fw-normal mt-1"><?php echo wp_kses_post( sp_menu_meta( '_sp_menu_hero_title' ) ); ?></h1>
			<p class="sp-menu-hero__body mt-4 mx-auto"><?php echo esc_html( sp_menu_meta( '_sp_menu_hero_body' ) ); ?></p>
		</div>

		<div class="sp-menu-hero__strip row g-0">
			<?php foreach ( $hero_photos as $photo ) :
				$img = sp_menu_meta( $photo['key'] );
			?>
				<div class="<?php echo esc_attr( $photo['col'] ); ?>">
					<?php if ( $img ) : ?>
						<div class="sp-menu-hero__photo sp-menu-hero__photo--img">
							<img class="sp-menu-hero__img" src="<?php echo esc_url( $img ); ?>" alt="" loading="lazy" />
						</div>
					<?php else : ?>
						<div class="sp-photo <?php echo esc_attr( $photo['mod'] ); ?> sp-menu-hero__photo">
							<span class="sp-photo__label"><?php echo esc_html( $photo['label'] ); ?></span>
						</div>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
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

	<?php
	/* ── RESERVATION CALLOUT ───────────────────────────────────────── */
	$cta_hours = sp_menu_group( '_sp_menu_cta_hours', sp_menu_hours_default() );
	$cta_phone = sp_menu_meta( '_sp_menu_cta_phone' );
	$cta_tel   = preg_replace( '/[^0-9+]/', '', $cta_phone );
	?>
	<section class="sp-menu-cta">
		<div class="container">
			<div class="sp-menu-cta__card row g-0 overflow-hidden rounded">
				<div class="col-12 col-md-7 position-relative sp-menu-cta__left">
					<span class="sp-script sp-menu-cta__kicker"><?php echo esc_html( sp_menu_meta( '_sp_menu_cta_kicker' ) ); ?></span>
					<h2 class="sp-menu-cta__title mt-2"><?php echo wp_kses_post( sp_menu_meta( '_sp_menu_cta_title' ) ); ?></h2>
					<p class="sp-menu-cta__body mt-4"><?php echo esc_html( sp_menu_meta( '_sp_menu_cta_body' ) ); ?></p>
					<div class="d-flex flex-wrap gap-3 mt-4">
						<a href="<?php echo esc_url( sp_menu_meta( '_sp_menu_cta_btn1_link' ) ); ?>" class="sp-btn sp-btn--primary"><?php echo esc_html( sp_menu_meta( '_sp_menu_cta_btn1_text' ) ); ?></a>
						<a href="<?php echo esc_url( sp_menu_meta( '_sp_menu_cta_btn2_link' ) ); ?>" class="sp-btn sp-btn--ghost"><?php echo esc_html( sp_menu_meta( '_sp_menu_cta_btn2_text' ) ); ?></a>
					</div>
				</div>
				<div class="col-12 col-md-5 sp-menu-cta__right">
					<div class="sp-eyebrow mb-3"><?php echo esc_html( sp_menu_meta( '_sp_menu_cta_hours_heading' ) ); ?></div>
					<dl class="sp-menu-cta__hours mb-0">
						<?php foreach ( $cta_hours as $row ) :
							$lbl = (string) ( $row['label'] ?? '' );
							$val = (string) ( $row['value'] ?? '' );
							if ( '' === $lbl && '' === $val ) {
								continue;
							}
						?>
							<dt><?php echo wp_kses_post( $lbl ); ?></dt><dd><?php echo wp_kses_post( $val ); ?></dd>
						<?php endforeach; ?>
					</dl>
					<hr class="sp-menu-cta__rule" />
					<div class="sp-eyebrow mb-2"><?php echo esc_html( sp_menu_meta( '_sp_menu_cta_find_heading' ) ); ?></div>
					<p class="sp-menu-cta__addr mb-0">
						<?php echo wp_kses( sp_menu_meta( '_sp_menu_cta_address' ), array( 'br' => array() ) ); ?>
						<?php if ( '' !== $cta_phone ) : ?>
							<br/><a class="sp-menu-cta__phone" href="tel:<?php echo esc_attr( $cta_tel ); ?>"><?php echo esc_html( $cta_phone ); ?></a>
						<?php endif; ?>
					</p>
				</div>
			</div>
		</div>
	</section>

</div><?php /* .sp.sp-page */ ?>

<?php get_footer(); ?>
