<?php
/**
 * Pegasus Child — Russell Contracting
 *
 * Loads Bootstrap 5 + Bootstrap Icons + Google Fonts, includes the CMB2
 * field definitions, and pulls the child stylesheet in after the parent.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* ---- CMB2 field definitions + default content for pages ---- */
require_once get_stylesheet_directory() . '/inc/cmb2-fields.php';

/* ---- Styles: parent, then Bootstrap 5 + fonts + icons, then child overrides ---- */
function pegasus_child_enqueue_styles() {

	// Parent theme
	wp_enqueue_style(
		'parent-style',
		get_template_directory_uri() . '/style.css'
	);

	// Google Fonts — Oswald (headings) + Source Sans 3 (body)
	wp_enqueue_style(
		'rc-fonts',
		'https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&family=Source+Sans+3:ital,wght@0,400;0,600;0,700;1,400&display=swap',
		array(),
		null
	);

	// Bootstrap 5 is provided by the parent Pegasus theme (handles
	// 'bootstrap-style' + 'bootstrap_js', v5.3.3). Enqueuing another copy here
	// caused the navbar-toggler collapse handler to fire twice, so mobile nav
	// would open + immediately close (or refuse to close on the second tap).
	// Do NOT re-enqueue Bootstrap in the child theme.

	// Bootstrap Icons
	wp_enqueue_style(
		'bootstrap-icons',
		'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css',
		array(),
		'1.11.3'
	);

	// Lightbox2 — powers the [masonry] gallery lightbox on tpl_services.php
	wp_enqueue_style(
		'lightbox',
		get_stylesheet_directory_uri() . '/css/lightbox.min.css',
		array(),
		'2.11.4'
	);

	// Child stylesheet last so overrides win (parent's 'bootstrap-style'
	// carries the compiled Bootstrap 5 build).
	wp_enqueue_style(
		'pegasus-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		array( 'parent-style', 'bootstrap-style' ),
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'pegasus_child_enqueue_styles' );

/* ---- Scripts: Lightbox2 + existing custom JS.
 *      Bootstrap 5 JS is provided by the parent theme (handle 'bootstrap_js'). */
function pegasus_child_enqueue_scripts() {

	// Lightbox2 — requires jQuery (already registered by WordPress core).
	wp_enqueue_script(
		'lightbox',
		get_stylesheet_directory_uri() . '/js/lightbox.min.js',
		array( 'jquery' ),
		'2.11.4',
		true
	);

	wp_enqueue_script(
		'pegasus_child_custom_js',
		get_stylesheet_directory_uri() . '/js/pegasus-custom.js',
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);
}
add_action( 'wp_enqueue_scripts', 'pegasus_child_enqueue_scripts' );

/* ---- Body class hook so our styles namespace safely without touching the parent theme ---- */
function pegasus_child_body_class( $classes ) {
	$classes[] = 'rc-theme';
	return $classes;
}
add_filter( 'body_class', 'pegasus_child_body_class' );
