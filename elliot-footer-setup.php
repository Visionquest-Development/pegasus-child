<?php
/**
 * Elliot Integration — footer widget setup (local + live).
 *
 * Run:  wp eval-file wp-content/themes/pegasus-child/elliot-footer-setup.php
 *
 * Sets four footer columns:
 *   1. About blurb
 *   2. Explore (quick links)
 *   3. Contact — Scott Burgett (address / email / phone from Contact page meta /
 *      elliot-prod-import.php / Elliot Overview 2024.pdf)
 *   4. CODESYS System Partner badge
 *
 * Safe to re-run: clears existing widgets in footer / footer-2 / footer-3 / footer-4
 * first, then adds fresh custom HTML (block) widgets.
 */

if ( ! defined( 'ABSPATH' ) ) {
	fwrite( STDERR, "Run via: wp eval-file wp-content/themes/pegasus-child/elliot-footer-setup.php\n" );
	exit( 1 );
}

$logo_uri = trailingslashit( get_stylesheet_directory_uri() ) . 'assets/CODESYS-System-Partner-light.svg';
$home     = home_url( '/' );
$services = home_url( '/services/' );
$contact  = home_url( '/contact/' );

/* Scott Burgett contact — prefer live Contact-page CMB2 meta, else known import values. */
$scott_email = 'sburgett@elliotintegration.com';
$scott_phone = '503-809-1642';
$scott_tel   = '+15038091642';
$scott_addr  = '13712 24th Street East, Suite C103, Sumner, WA 98390';
$scott_name  = 'Scott Burgett';

$cid = 0;
$ids = get_posts( array(
	'post_type'   => 'page',
	'post_status' => 'any',
	'numberposts' => 1,
	'meta_key'    => '_wp_page_template',
	'meta_value'  => 'tpl_contact.php',
	'fields'      => 'ids',
) );
if ( $ids ) {
	$cid  = (int) $ids[0];
	$rows = get_post_meta( $cid, 'elliot_contact_details', true );
	if ( is_array( $rows ) ) {
		foreach ( $rows as $row ) {
			$label = isset( $row['label'] ) ? strtolower( $row['label'] ) : '';
			$val   = isset( $row['value'] ) ? trim( $row['value'] ) : '';
			$link  = isset( $row['link'] ) ? trim( $row['link'] ) : '';
			if ( ! $val ) {
				continue;
			}
			if ( false !== strpos( $label, 'email' ) ) {
				$scott_email = $val;
				if ( 0 === strpos( $link, 'mailto:' ) ) {
					/* keep mailto from meta via $scott_email */
				}
			} elseif ( false !== strpos( $label, 'phone' ) ) {
				$scott_phone = $val;
				if ( 0 === strpos( $link, 'tel:' ) ) {
					$scott_tel = substr( $link, 4 );
				}
			} elseif ( false !== strpos( $label, 'office' ) || false !== strpos( $label, 'location' ) || false !== strpos( $label, 'address' ) ) {
				$scott_addr = $val;
			}
		}
	}
}

$map = 'https://maps.google.com/?q=' . rawurlencode( $scott_addr );

$col1 = '<div class="elliot-fcol elliot-fcol--about">'
	. '<h5 class="elliot-fcol__title">Elliot Integration</h5>'
	. '<p class="elliot-fcol__text">Robotics, controls, and UL-listed panels — designed, built, and commissioned by one licensed integrator. We wire it, we build it, we make your line run.</p>'
	. '</div>';

$col2 = '<div class="elliot-fcol elliot-fcol--links">'
	. '<h5 class="elliot-fcol__title">Explore</h5>'
	. '<ul class="elliot-fcol__list">'
	. '<li><a href="' . esc_url( $home ) . '">Home</a></li>'
	. '<li><a href="' . esc_url( $services ) . '">Services</a></li>'
	. '<li><a href="' . esc_url( $contact ) . '">Contact</a></li>'
	. '</ul>'
	. '</div>';

$col3 = '<div class="elliot-fcol elliot-fcol--contact">'
	. '<h5 class="elliot-fcol__title">Contact</h5>'
	. '<p class="elliot-fcol__name">' . esc_html( $scott_name ) . '</p>'
	. '<p class="elliot-fcol__line"><a href="' . esc_url( $map ) . '" target="_blank" rel="noopener noreferrer">' . esc_html( $scott_addr ) . '</a></p>'
	. '<p class="elliot-fcol__line"><a href="mailto:' . esc_attr( $scott_email ) . '">' . esc_html( $scott_email ) . '</a></p>'
	. '<p class="elliot-fcol__line"><a href="tel:' . esc_attr( $scott_tel ) . '">' . esc_html( $scott_phone ) . '</a></p>'
	. '</div>';

$col4 = '<div class="elliot-fcol elliot-fcol--codesys">'
	. '<h5 class="elliot-fcol__title">CODESYS Partner</h5>'
	. '<a class="elliot-fcol__badge" href="https://www.codesys.com/" target="_blank" rel="noopener noreferrer">'
	. '<img src="' . esc_url( $logo_uri ) . '" alt="CODESYS System Partner" width="220" height="62" loading="lazy" decoding="async" />'
	. '</a>'
	. '<p class="elliot-fcol__text elliot-fcol__text--sm">Authorized CODESYS System Partner.</p>'
	. '</div>';

$columns = array(
	'footer'   => $col1,
	'footer-2' => $col2,
	'footer-3' => $col3,
	'footer-4' => $col4,
);

/* Ensure theme option has 4 footer areas. */
$opts = get_option( 'pegasus_options', array() );
if ( ! is_array( $opts ) ) {
	$opts = array();
}
if ( empty( $opts['footer_widget_areas'] ) || (int) $opts['footer_widget_areas'] < 4 ) {
	$opts['footer_widget_areas'] = '4';
	update_option( 'pegasus_options', $opts );
	WP_CLI::log( 'Set pegasus_options[footer_widget_areas]=4' );
}

$sidebars = wp_get_sidebars_widgets();
if ( ! is_array( $sidebars ) ) {
	$sidebars = array();
}

/* Remove existing widgets from the four footer sidebars (move to inactive). */
foreach ( array_keys( $columns ) as $sidebar_id ) {
	if ( empty( $sidebars[ $sidebar_id ] ) || ! is_array( $sidebars[ $sidebar_id ] ) ) {
		$sidebars[ $sidebar_id ] = array();
		continue;
	}
	foreach ( $sidebars[ $sidebar_id ] as $widget_id ) {
		$sidebars['wp_inactive_widgets'][] = $widget_id;
		WP_CLI::log( "Moved $widget_id from $sidebar_id -> inactive" );
	}
	$sidebars[ $sidebar_id ] = array();
}
wp_set_sidebars_widgets( $sidebars );

/* Add one Custom HTML widget per column via the options API. */
$widgets = get_option( 'widget_custom_html', array() );
if ( ! is_array( $widgets ) ) {
	$widgets = array();
}
$next = 1;
foreach ( array_keys( $widgets ) as $k ) {
	if ( is_numeric( $k ) && (int) $k >= $next ) {
		$next = (int) $k + 1;
	}
}

$sidebars = wp_get_sidebars_widgets();
if ( ! is_array( $sidebars ) ) {
	$sidebars = array();
}

foreach ( $columns as $sidebar_id => $html ) {
	$id = $next++;
	$widgets[ $id ] = array(
		'title'   => '',
		'content' => $html,
	);
	if ( empty( $sidebars[ $sidebar_id ] ) || ! is_array( $sidebars[ $sidebar_id ] ) ) {
		$sidebars[ $sidebar_id ] = array();
	}
	$sidebars[ $sidebar_id ][] = 'custom_html-' . $id;
	WP_CLI::log( "Added custom_html-$id to $sidebar_id" );
}
$widgets['_multiwidget'] = 1;
update_option( 'widget_custom_html', $widgets );
wp_set_sidebars_widgets( $sidebars );

WP_CLI::success( 'Elliot footer widgets set (About / Explore / Contact / CODESYS). Contact used: ' . $scott_email . ' / ' . $scott_phone );
