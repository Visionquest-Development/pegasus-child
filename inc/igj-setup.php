<?php
/**
 * Insurance Guy Joe — theme setup: menus, Learn URLs, Pegasus defaults, performance.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Footer menu location for Privacy Policy / Disclaimers (the parent only has Primary). */
add_action( 'after_setup_theme', function () {
	register_nav_menu( 'footer-legal', __( 'Footer Legal Menu', 'pegasus' ) );
}, 20 );

/**
 * Learn = the blog. Posts use the permalink structure /learn/%postname%/ and the
 * "Learn" page is the Posts page. The extra rule makes /learn/page/2/ paginate the
 * Learn page instead of being read as a post named "page".
 */
add_action( 'init', function () {
	add_rewrite_rule( '^learn/page/([0-9]{1,})/?$', 'index.php?pagename=learn&paged=$matches[1]', 'top' );
} );

/**
 * Pegasus Options defaults for this design (only applied when not set in wp-admin):
 * header one, no parent "additional header" band, no parent breadcrumbs (we print our own),
 * logo = IGJ logo (with no logo the parent prints the site name as an extra <h1>).
 */
function igj_pegasus_defaults( $opts ) {
	if ( ! is_array( $opts ) ) {
		$opts = array();
	}
	$defaults = array(
		'logo'                            => get_stylesheet_directory_uri() . '/images/igj-logo.png',
		'favicon'                         => get_stylesheet_directory_uri() . '/images/icon-32.png',
		'header_select'                   => 'header-one',
		'global_additional_header_option' => 'no-header',
		'global_nav_viewport_break'       => 'navbar-expand-lg',
	);
	foreach ( $defaults as $k => $v ) {
		if ( empty( $opts[ $k ] ) ) {
			$opts[ $k ] = $v;
		}
	}
	/* This design ships its own header/breadcrumbs; keep the parent's versions off. */
	$opts['header_sticky_checkbox'] = 'off';
	$opts['bread_chk']              = 'off';
	return $opts;
}
add_filter( 'option_pegasus_options', 'igj_pegasus_defaults' );
add_filter( 'default_option_pegasus_options', 'igj_pegasus_defaults' );

/* Apple touch / site icons when no WP Site Icon is set. */
add_action( 'wp_head', function () {
	if ( has_site_icon() ) {
		return;
	}
	$base = get_stylesheet_directory_uri() . '/images/';
	echo '<link rel="icon" href="' . esc_url( $base . 'icon-192.png' ) . '" sizes="192x192">' . "\n";
	echo '<link rel="apple-touch-icon" href="' . esc_url( $base . 'icon-180.png' ) . '">' . "\n";
}, 3 );

/* Performance: drop emoji scripts/styles and other head clutter. */
add_action( 'init', function () {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wp_shortlink_wp_head' );
} );

/* Body class for the design system. */
add_filter( 'body_class', function ( $classes ) {
	$classes[] = 'igj';
	if ( igj_current_service_slug() ) {
		$classes[] = 'igj-is-service';
	}
	return $classes;
} );

/* Learn hub: 9 articles per page; excerpt length tuned for cards. */
add_action( 'pre_get_posts', function ( $q ) {
	if ( ! is_admin() && $q->is_main_query() && $q->is_home() ) {
		$q->set( 'posts_per_page', 9 );
	}
} );
add_filter( 'excerpt_length', function () {
	return 28;
}, 20 );
