<?php
/**
 * Seasonal Events / Promotions
 *
 * A "Seasonal Promo" custom post type whose entries rotate through a slider on
 * the homepage. Each promo is tied to one of the four seasons (winter, spring,
 * summer, fall). The front-end slider re-uses the Slick assets shipped with the
 * Pegasus Carousel plugin so it stays visually consistent with the rest of the
 * site and needs no extra library.
 *
 * Meta prefix: qbse_  (QBIQ Seasonal Event)
 *
 * @package pegasus-child
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

/* -----------------------------------------------------------------------------
 * Season helpers
 * -------------------------------------------------------------------------- */

/**
 * The four seasons, in display order, keyed by slug.
 *
 * @return array<string,string>
 */
function qbse_seasons() {
	return array(
		'spring' => __( 'Spring', 'pegasus-child' ),
		'summer' => __( 'Summer', 'pegasus-child' ),
		'fall'   => __( 'Fall',   'pegasus-child' ),
		'winter' => __( 'Winter', 'pegasus-child' ),
	);
}

/* -----------------------------------------------------------------------------
 * Custom post type
 * -------------------------------------------------------------------------- */

add_action( 'init', 'qbse_register_cpt' );
function qbse_register_cpt() {

	$labels = array(
		'name'               => _x( 'Seasonal Promos', 'post type general name', 'pegasus-child' ),
		'singular_name'      => _x( 'Seasonal Promo', 'post type singular name', 'pegasus-child' ),
		'add_new'            => _x( 'Add New', 'seasonal promo', 'pegasus-child' ),
		'add_new_item'       => __( 'Add New Seasonal Promo', 'pegasus-child' ),
		'edit_item'          => __( 'Edit Seasonal Promo', 'pegasus-child' ),
		'new_item'           => __( 'New Seasonal Promo', 'pegasus-child' ),
		'view_item'          => __( 'View Seasonal Promo', 'pegasus-child' ),
		'search_items'       => __( 'Search Seasonal Promos', 'pegasus-child' ),
		'not_found'          => __( 'No seasonal promos found', 'pegasus-child' ),
		'not_found_in_trash' => __( 'No seasonal promos found in Trash', 'pegasus-child' ),
		'menu_name'          => __( 'Seasonal Promos', 'pegasus-child' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'show_in_rest'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'seasonal-promo' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => 24,
		'menu_icon'          => 'dashicons-palmtree',
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ),
	);

	register_post_type( 'seasonal_event', $args );
}

/**
 * Flush rewrite rules once when the child theme is activated so the new CPT
 * permalinks resolve without a manual Settings → Permalinks save.
 */
add_action( 'after_switch_theme', 'qbse_flush_rewrites' );
function qbse_flush_rewrites() {
	qbse_register_cpt();
	flush_rewrite_rules();
}

/* -----------------------------------------------------------------------------
 * Meta boxes (CMB2 — already bundled with the Pegasus parent theme)
 * -------------------------------------------------------------------------- */

add_action( 'cmb2_admin_init', 'qbse_register_metabox' );
function qbse_register_metabox() {

	$prefix = 'qbse_';

	$box = new_cmb2_box( array(
		'id'           => $prefix . 'details',
		'title'        => __( 'Seasonal Promo Details', 'pegasus-child' ),
		'object_types' => array( 'seasonal_event' ),
		'context'      => 'normal',
		'priority'     => 'high',
	) );

	$box->add_field( array(
		'name'             => __( 'Season', 'pegasus-child' ),
		'desc'             => __( 'Which season this promotion belongs to. Controls the accent colour of the slide.', 'pegasus-child' ),
		'id'               => $prefix . 'season',
		'type'             => 'select',
		'default'          => 'spring',
		'options'          => qbse_seasons(),
		'show_option_none' => false,
	) );

	$box->add_field( array(
		'name'    => __( 'Eyebrow / small label', 'pegasus-child' ),
		'desc'    => __( 'Optional kicker shown above the title, e.g. "Winter 2026" or "Limited Time".', 'pegasus-child' ),
		'id'      => $prefix . 'eyebrow',
		'type'    => 'text',
	) );

	$box->add_field( array(
		'name' => __( 'Button text', 'pegasus-child' ),
		'desc' => __( 'Leave blank to hide the button.', 'pegasus-child' ),
		'id'   => $prefix . 'cta_text',
		'type' => 'text',
	) );

	$box->add_field( array(
		'name' => __( 'Button URL', 'pegasus-child' ),
		'id'   => $prefix . 'cta_url',
		'type' => 'text_url',
	) );
}

/* -----------------------------------------------------------------------------
 * Front-end assets
 *
 * The Pegasus Carousel plugin registers the Slick handles (slick-css,
 * slick-theme-css, slick-js). We lean on those when present; if the plugin is
 * inactive we register Slick straight from the plugin folder as a fallback so
 * the slider still works. Our own tiny init + styles live in the child theme.
 * -------------------------------------------------------------------------- */

add_action( 'wp_enqueue_scripts', 'qbse_register_assets' );
function qbse_register_assets() {

	// Fallback: register Slick from the carousel plugin if it isn't already.
	$carousel_dir = WP_PLUGIN_DIR . '/pegasus-carousel';
	$carousel_url = plugins_url( 'pegasus-carousel' );

	if ( ! wp_style_is( 'slick-css', 'registered' ) && file_exists( $carousel_dir . '/css/slick.css' ) ) {
		wp_register_style( 'slick-css', $carousel_url . '/css/slick.css', array(), null );
	}
	if ( ! wp_style_is( 'slick-theme-css', 'registered' ) && file_exists( $carousel_dir . '/css/slick-theme.css' ) ) {
		wp_register_style( 'slick-theme-css', $carousel_url . '/css/slick-theme.css', array(), null );
	}
	if ( ! wp_script_is( 'slick-js', 'registered' ) && file_exists( $carousel_dir . '/js/slick.js' ) ) {
		wp_register_script( 'slick-js', $carousel_url . '/js/slick.js', array( 'jquery' ), null, true );
	}

	// Child-theme slider styles.
	$css_path = get_stylesheet_directory() . '/assets/css/qbiq-seasonal.css';
	if ( file_exists( $css_path ) ) {
		wp_register_style(
			'qbiq-seasonal',
			get_stylesheet_directory_uri() . '/assets/css/qbiq-seasonal.css',
			array( 'slick-css', 'slick-theme-css' ),
			filemtime( $css_path )
		);
	}

	// Child-theme slider init (depends on Slick).
	$js_path = get_stylesheet_directory() . '/js/qbiq-seasonal-slider.js';
	if ( file_exists( $js_path ) ) {
		wp_register_script(
			'qbiq-seasonal',
			get_stylesheet_directory_uri() . '/js/qbiq-seasonal-slider.js',
			array( 'jquery', 'slick-js' ),
			filemtime( $js_path ),
			true
		);
	}
}

/* -----------------------------------------------------------------------------
 * Shortcode / render
 * -------------------------------------------------------------------------- */

/**
 * Render the seasonal promo slider.
 *
 * Usage:  [seasonal_slider]
 *         [seasonal_slider season="winter" limit="5" title="Winter Deals"]
 *
 * Returns an empty string when there are no published promos, so the homepage
 * section simply disappears until promos exist.
 *
 * @param array $atts Shortcode attributes.
 * @return string
 */
function qbse_render_slider( $atts = array() ) {

	$atts = shortcode_atts( array(
		'eyebrow' => __( 'Seasonal', 'pegasus-child' ),
		'title'   => __( "What's On This Season", 'pegasus-child' ),
		'season'  => '',   // optionally restrict to a single season slug.
		'limit'   => 10,
	), $atts, 'seasonal_slider' );

	$query_args = array(
		'post_type'      => 'seasonal_event',
		'post_status'    => 'publish',
		'posts_per_page' => intval( $atts['limit'] ),
		'orderby'        => array( 'menu_order' => 'ASC', 'date' => 'DESC' ),
		'no_found_rows'  => true,
	);

	$season = sanitize_key( $atts['season'] );
	if ( $season && array_key_exists( $season, qbse_seasons() ) ) {
		$query_args['meta_key']   = 'qbse_season';
		$query_args['meta_value'] = $season;
	}

	$query = new WP_Query( $query_args );

	if ( ! $query->have_posts() ) {
		wp_reset_postdata();
		return '';
	}

	$seasons = qbse_seasons();
	$slides  = '';

	while ( $query->have_posts() ) {
		$query->the_post();
		$id = get_the_ID();

		$slide_season = get_post_meta( $id, 'qbse_season', true );
		$slide_season = array_key_exists( $slide_season, $seasons ) ? $slide_season : 'spring';
		$season_label = $seasons[ $slide_season ];

		$eyebrow  = get_post_meta( $id, 'qbse_eyebrow', true );
		$cta_text = get_post_meta( $id, 'qbse_cta_text', true );
		$cta_url  = get_post_meta( $id, 'qbse_cta_url', true );
		$img      = has_post_thumbnail( $id ) ? get_the_post_thumbnail_url( $id, 'full' ) : '';
		$excerpt  = has_excerpt( $id ) ? get_the_excerpt() : wp_trim_words( wp_strip_all_tags( get_the_content() ), 32 );

		$style = $img ? ' style="background-image:url(' . esc_url( $img ) . ');"' : '';

		$slides .= '<div class="qb-seasonal-slide" data-season="' . esc_attr( $slide_season ) . '">';
			$slides .= '<div class="qb-seasonal-card"' . $style . '>';
				$slides .= '<span class="qb-seasonal-overlay" aria-hidden="true"></span>';
				$slides .= '<div class="qb-seasonal-body">';
					$slides .= '<span class="qb-seasonal-badge">' . esc_html( $season_label ) . '</span>';
					if ( $eyebrow ) {
						$slides .= '<span class="qb-seasonal-eyebrow">' . esc_html( $eyebrow ) . '</span>';
					}
					$slides .= '<h3 class="qb-seasonal-title qb-display">' . esc_html( get_the_title() ) . '</h3>';
					if ( $excerpt ) {
						$slides .= '<p class="qb-seasonal-text">' . esc_html( $excerpt ) . '</p>';
					}
					if ( $cta_text && $cta_url ) {
						$slides .= '<a class="btn btn-qb btn-qb-primary qb-seasonal-cta" href="' . esc_url( $cta_url ) . '">' . esc_html( $cta_text ) . '</a>';
					}
				$slides .= '</div>'; // .qb-seasonal-body
			$slides .= '</div>'; // .qb-seasonal-card
		$slides .= '</div>'; // .qb-seasonal-slide
	}
	wp_reset_postdata();

	// Load everything this slider needs.
	wp_enqueue_style( 'slick-css' );
	wp_enqueue_style( 'slick-theme-css' );
	wp_enqueue_style( 'qbiq-seasonal' );
	wp_enqueue_script( 'slick-js' );
	wp_enqueue_script( 'qbiq-seasonal' );

	ob_start();
	?>
	<section class="qb-section qb-bg-dark qb-seasonal-section">
		<div class="container">
			<?php if ( $atts['eyebrow'] || $atts['title'] ) : ?>
				<div class="qb-seasonal-head text-center">
					<?php if ( $atts['eyebrow'] ) : ?>
						<span class="qb-eyebrow"><?php echo esc_html( $atts['eyebrow'] ); ?></span>
					<?php endif; ?>
					<?php if ( $atts['title'] ) : ?>
						<h2 class="qb-display mt-3 mb-5"><?php echo esc_html( $atts['title'] ); ?></h2>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<div class="qbiq-seasonal-slider">
				<?php echo $slides; // Already escaped above. ?>
			</div>
		</div>
	</section>
	<?php
	return ob_get_clean();
}
add_shortcode( 'seasonal_slider', 'qbse_render_slider' );
