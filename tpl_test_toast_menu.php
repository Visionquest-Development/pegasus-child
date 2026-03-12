<?php
/*
	Template Name: Test Toast Menu
*/
?>
	<?php get_header(); ?>

	<?php
		$header_choice = pegasus_get_option( 'header_select' );
		if ( 'header-three' === $header_choice ) {
			get_template_part( 'templates/additional_header' );
		}
	?>

	<div id="page-wrap">

		<?php
			// Full container page options.
			$post_full_container_choice   = get_post_meta( get_the_ID(), 'pegasus-page-container-checkbox', true );
			$global_full_container_option = pegasus_get_option( 'full_container_chk' );
			$pegasus_post_container_choice   = ( 'on' === $post_full_container_choice ) ? 'container-fluid' : 'container';
			$pegasus_global_container_choice = ( 'on' === $global_full_container_option ) ? 'container-fluid' : 'container';
			$final_container_class = ( 'container-fluid' === $pegasus_global_container_choice ) ? $pegasus_global_container_choice : $pegasus_post_container_choice;

			// Page header options.
			$post_disable_page_header_choice   = get_post_meta( get_the_ID(), 'pegasus-page-header-checkbox', true ) ? get_post_meta( get_the_ID(), 'pegasus-page-header-checkbox', true ) : 'off';
			$global_disable_page_header_option = pegasus_get_option( 'page_header_chk' ) ? pegasus_get_option( 'page_header_chk' ) : 'off';
			$page_title = $post->post_title;

			if ( 'on' === $global_disable_page_header_option || 'on' === $post_disable_page_header_choice ) {
				$final_page_header_option = 'on';
			} else {
				$final_page_header_option = 'off';
			}

			if ( is_home() ) {
				$final_page_header_option = 'off';
			}
		?>

		<div class="<?php echo esc_attr( $final_container_class ); ?>">
			<div class="">
				<div class="inner-content">
					<div class="content-no-sidebar">
						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
							<?php if ( 'off' === $final_page_header_option ) : ?>
								<div class="page-header">
									<?php if ( $page_title ) : ?>
										<h1><?php the_title(); ?></h1>
									<?php endif; ?>
								</div>
							<?php endif; ?>

							<?php the_content(); ?>

						<?php endwhile; else : ?>
							<div class="page-header">
								<h1>Oh no!</h1>
							</div>
							<p>No content is appearing for this page!</p>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>

		<?php
		/*------------------------------------------------------------------
		 * Toast POS Menu (live from API)
		 *
		 * Fetches menu data from the Toast API via vqdev_toast_get_menu_data()
		 * and renders it using the existing menu-tabs/menu-mobile templates.
		 * Falls back to an error message if the API is unreachable.
		 *-----------------------------------------------------------------*/
		$menu_data = vqdev_toast_get_menu_data();

		if ( ! $menu_data || empty( $menu_data['tabs'] ) ) :
		?>
			<div class="container py-5">
				<div class="alert alert-warning">
					Menu is currently unavailable. Please check back later.
				</div>
			</div>
		<?php
		else :

			// Define format helpers (same as existing menu templates).
			if ( ! function_exists( 'vqmenu_money' ) ) {
				function vqmenu_money( $value ) {
					$num = is_numeric( $value ) ? number_format( (float) $value, 2, '.', '' ) : $value;
					if ( is_numeric( $value ) && fmod( (float) $value, 1.0 ) === 0.0 ) {
						$num = number_format( (float) $value, 0, '.', '' );
					}
					return '$' . $num;
				}
			}

			if ( ! function_exists( 'vqmenu_badge_class' ) ) {
				function vqmenu_badge_class( $label ) {
					$label = strtoupper( trim( (string) $label ) );
					return match ( $label ) {
						'V'     => 'vqmenu-badge vqmenu-badge--veg',
						'GF'    => 'vqmenu-badge vqmenu-badge--gf',
						'GF*'   => 'vqmenu-badge vqmenu-badge--gf',
						default => 'vqmenu-badge',
					};
				}
			}

			// Enqueue the mobile menu JS.
			$theme_uri = get_stylesheet_directory_uri();
			$theme_dir = get_stylesheet_directory();
			$js_rel    = '/assets/restaurant-menu/restaurant-menu.js';
			if ( file_exists( $theme_dir . $js_rel ) ) {
				wp_enqueue_script( 'vq-restaurant-menu', $theme_uri . $js_rel, array(), filemtime( $theme_dir . $js_rel ), true );
			}

			$tabs = $menu_data['tabs'];
		?>
		<main id="primary" class="site-main">
			<div class="container py-5 vqmenu">
				<header class="vqmenu-header mb-4">
					<?php if ( ! empty( $menu_data['restaurant_name'] ) ) : ?>
						<h1 class="vqmenu-title mb-1"><?php echo esc_html( $menu_data['restaurant_name'] ); ?></h1>
					<?php else : ?>
						<h1 class="vqmenu-title mb-1"><?php the_title(); ?></h1>
					<?php endif; ?>

					<?php if ( ! empty( $menu_data['updated'] ) ) : ?>
						<div class="vqmenu-meta text-muted">
							Updated: <?php echo esc_html( $menu_data['updated'] ); ?>
						</div>
					<?php endif; ?>
				</header>

				<!-- Desktop: tabbed menu (hidden < 992px) -->
				<div class="vqmenu-desktop">
					<?php include get_stylesheet_directory() . '/templates/menu-tabs.php'; ?>
				</div>

				<!-- Mobile: long-scroll menu (hidden >= 992px) -->
				<div class="vqmenu-mobile">
					<?php include get_stylesheet_directory() . '/templates/menu-mobile.php'; ?>
				</div>
			</div>
		</main>
		<?php endif; ?>

	</div><!-- end page wrap -->
	<?php get_footer(); ?>
