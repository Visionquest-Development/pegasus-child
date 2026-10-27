<?php
/**
 * Mr Nice Guy — theme setup: Pegasus defaults, icons, head cleanup, body class.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Pegasus Options defaults for this design (used only when not set in wp-admin):
 * header one (overridden by templates/header_one.php), no parent "additional header"
 * band, logo = the Mr Nice Guy badge (with no logo the parent prints the site name as
 * an extra <h1>). The setup script also saves these with wp-cli.
 */
function mng_pegasus_defaults( $opts ) {
	if ( ! is_array( $opts ) ) {
		$opts = array();
	}
	$defaults = array(
		'logo'                            => get_stylesheet_directory_uri() . '/images/mng-logo.png',
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
	/* This design ships its own header and page heroes; keep the parent's versions off. */
	$opts['header_sticky_checkbox'] = 'off';
	$opts['bread_chk']              = 'off';
	return $opts;
}
add_filter( 'option_pegasus_options', 'mng_pegasus_defaults' );
add_filter( 'default_option_pegasus_options', 'mng_pegasus_defaults' );

/* Icons when no WP Site Icon is set. */
add_action( 'wp_head', function () {
	if ( has_site_icon() ) {
		return;
	}
	$base = get_stylesheet_directory_uri() . '/images/';
	echo '<link rel="icon" href="' . esc_url( $base . 'icon-32.png' ) . '" sizes="32x32">' . "\n";
	echo '<link rel="icon" href="' . esc_url( $base . 'icon-192.png' ) . '" sizes="192x192">' . "\n";
	echo '<link rel="apple-touch-icon" href="' . esc_url( $base . 'icon-180.png' ) . '">' . "\n";
}, 3 );

/* Performance: drop emoji scripts and head clutter. */
add_action( 'init', function () {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wp_shortlink_wp_head' );
} );

add_filter( 'body_class', function ( $classes ) {
	$classes[] = 'mng';
	return $classes;
} );
