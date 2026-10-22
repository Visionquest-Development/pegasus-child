<?php
/*
	Template Name: Menu Template
*/
/**
 * Data-driven restaurant menu (data/menu.json), same structure and partials as
 * mabellas_theme / theloft2025_theme: templates/menu-tabs.php (desktop tabs)
 * and templates/menu-mobile.php (long-scroll with sticky section nav).
 */
get_header();

$menu_data = rusans_data( 'menu' );
if ( ! is_array( $menu_data ) || empty( $menu_data['tabs'] ) ) {
	$menu_data = array( 'restaurant_name' => '', 'updated' => '', 'tabs' => array() );
}

if ( ! function_exists( 'vqmenu_money' ) ) {
	function vqmenu_money( $value ) {
		$num = is_numeric( $value ) ? number_format( (float) $value, 2, '.', '' ) : $value;
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
			'RAW'   => 'vqmenu-badge vqmenu-badge--raw',
			'FRIED' => 'vqmenu-badge vqmenu-badge--fried',
			default => 'vqmenu-badge',
		};
	}
}

$theme_uri = get_stylesheet_directory_uri();
$theme_dir = get_stylesheet_directory();
$js_rel    = '/assets/restaurant-menu/restaurant-menu.js';
if ( file_exists( $theme_dir . $js_rel ) ) {
	wp_enqueue_script( 'vq-restaurant-menu', $theme_uri . $js_rel, array(), filemtime( $theme_dir . $js_rel ), true );
}

$tabs         = $menu_data['tabs'];
$first_tab_id = $tabs[0]['id'] ?? 'menu';
$pdf          = $menu_data['download'] ?? array();
if ( ! empty( $pdf['href'] ) && ! preg_match( '#^(https?:)?//#', $pdf['href'] ) ) {
	// Theme-relative path (works on subdirectory installs like visionquestdev.com/rusans).
	$pdf['href'] = $theme_uri . '/' . ltrim( $pdf['href'], '/' );
}
?>
<div id="page-wrap">
<main id="primary" class="site-main rusans rusans-menu-page">

	<?php
	get_template_part( 'templates/rusans-page-hero', null, array(
		'image' => 'hero-sushi-combo',
		'title' => get_the_title() ? get_the_title() : __( 'Menu', 'pegasus' ),
		'lead'  => __( 'House special appetizers, artistically crafted rolls, sashimi, hearty entrées, noodles and lunch specials.', 'pegasus' ),
	) );
	?>

	<div class="container py-5 vqmenu">
		<header class="vqmenu-header mb-4 d-flex flex-wrap align-items-center justify-content-between gap-3">
			<div>
				<h2 class="vqmenu-title mb-1"><?php echo esc_html( $menu_data['restaurant_name'] ? $menu_data['restaurant_name'] : get_the_title() ); ?></h2>
				<?php if ( ! empty( $menu_data['updated'] ) ) : ?>
					<div class="vqmenu-meta text-muted"><?php echo esc_html( $menu_data['updated'] ); ?></div>
				<?php endif; ?>
			</div>
			<div class="d-flex flex-wrap gap-2">
				<?php if ( ! empty( $pdf['href'] ) ) : ?>
					<a class="btn rusans-btn rusans-btn--outline" href="<?php echo esc_url( $pdf['href'] ); ?>" target="_blank" rel="noopener"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> <?php echo esc_html( $pdf['text'] ?? __( 'Download Menu', 'pegasus' ) ); ?></a>
				<?php endif; ?>
				<a class="btn rusans-btn rusans-btn--primary" href="<?php echo esc_url( home_url( '/#order' ) ); ?>"><?php esc_html_e( 'Order Now', 'pegasus' ); ?></a>
			</div>
		</header>

		<?php
		while ( have_posts() ) :
			the_post();
			if ( trim( get_the_content() ) ) {
				echo '<div class="vqmenu-intro mb-4">';
				the_content();
				echo '</div>';
			}
		endwhile;
		?>

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
</div><!-- end page wrap -->
<?php get_footer(); ?>
