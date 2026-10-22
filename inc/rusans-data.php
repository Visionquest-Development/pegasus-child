<?php
/**
 * Ru San's Kennesaw — data + markup helpers.
 *
 * All NAP / hours / ordering links live in data/site.json so the header, footer,
 * location page and JSON-LD schema can never disagree with each other.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Load and cache a JSON file from the child theme's data/ folder.
 *
 * @param string $name File name without extension (site, menu, catering, gallery).
 * @return array
 */
function rusans_data( $name = 'site' ) {
	static $cache = array();
	if ( isset( $cache[ $name ] ) ) {
		return $cache[ $name ];
	}
	$path = get_stylesheet_directory() . '/data/' . sanitize_file_name( $name ) . '.json';
	$data = array();
	if ( is_readable( $path ) ) {
		$decoded = json_decode( (string) file_get_contents( $path ), true );
		if ( is_array( $decoded ) ) {
			$data = $decoded;
		}
	}
	$cache[ $name ] = $data;
	return $data;
}

/**
 * Get a value from site.json with dot notation, e.g. rusans_site( 'address.street' ).
 */
function rusans_site( $key, $default = '' ) {
	$value = rusans_data( 'site' );
	foreach ( explode( '.', $key ) as $part ) {
		if ( ! is_array( $value ) || ! array_key_exists( $part, $value ) ) {
			return $default;
		}
		$value = $value[ $part ];
	}
	return $value;
}

/**
 * One-line formatted address.
 */
function rusans_address_line() {
	$a = rusans_site( 'address', array() );
	if ( empty( $a ) ) {
		return '';
	}
	return sprintf( '%s, %s, %s %s', $a['street'], $a['city'], $a['region'], $a['postal'] );
}

/**
 * URL of a theme image. Images live in images/ as <slug>.webp + <slug>.jpg (fallback).
 */
function rusans_img_url( $slug, $ext = 'jpg', $size = '' ) {
	$file = $slug . ( $size ? '-' . $size : '' ) . '.' . $ext;
	return get_stylesheet_directory_uri() . '/images/' . $file;
}

/**
 * Metadata for a theme image from data/images.json (alt text, dimensions, sizes).
 */
function rusans_img_meta( $slug ) {
	$images = rusans_data( 'images' );
	return isset( $images[ $slug ] ) ? $images[ $slug ] : array();
}

/**
 * Print a <picture> element: WebP source with JPEG fallback, width/height set,
 * lazy-loaded unless $eager is true (use eager for the first hero slide only).
 *
 * @param string $slug  Image slug from data/images.json.
 * @param array  $args  class, eager (bool), lazy (bool, default true), sizes (string), alt (override).
 */
function rusans_picture( $slug, $args = array() ) {
	$meta = rusans_img_meta( $slug );
	if ( empty( $meta ) ) {
		return '';
	}
	$args  = wp_parse_args( $args, array( 'class' => '', 'eager' => false, 'lazy' => true, 'sizes' => '100vw', 'alt' => null ) );
	$alt   = null !== $args['alt'] ? $args['alt'] : ( $meta['alt'] ?? '' );
	$w     = (int) ( $meta['width'] ?? 0 );
	$h     = (int) ( $meta['height'] ?? 0 );
	$sizes = isset( $meta['sizes'] ) && is_array( $meta['sizes'] ) ? $meta['sizes'] : array();

	$webp_set = array();
	$jpg_set  = array();
	foreach ( $sizes as $sw ) {
		$suffix     = ( (int) $sw === $w ) ? '' : (string) $sw;
		$webp_set[] = esc_url( rusans_img_url( $slug, 'webp', $suffix ) ) . ' ' . (int) $sw . 'w';
		$jpg_set[]  = esc_url( rusans_img_url( $slug, 'jpg', $suffix ) ) . ' ' . (int) $sw . 'w';
	}

	$html  = '<picture>';
	if ( $webp_set ) {
		$html .= '<source type="image/webp" srcset="' . implode( ', ', $webp_set ) . '" sizes="' . esc_attr( $args['sizes'] ) . '">';
		$html .= '<source type="image/jpeg" srcset="' . implode( ', ', $jpg_set ) . '" sizes="' . esc_attr( $args['sizes'] ) . '">';
	}
	$html .= sprintf(
		'<img src="%s" alt="%s" width="%d" height="%d" class="%s" %s decoding="async">',
		esc_url( rusans_img_url( $slug, 'jpg' ) ),
		esc_attr( $alt ),
		$w,
		$h,
		esc_attr( $args['class'] ),
		$args['eager'] ? 'fetchpriority="high"' : ( $args['lazy'] ? 'loading="lazy"' : '' )
	);
	$html .= '</picture>';
	return $html;
}

/**
 * Background-image style for full-bleed sections (WebP via image-set with JPEG fallback).
 */
function rusans_bg_style( $slug ) {
	$jpg  = esc_url( rusans_img_url( $slug, 'jpg' ) );
	$webp = esc_url( rusans_img_url( $slug, 'webp' ) );
	return "background-image:url('{$jpg}');background-image:image-set(url('{$webp}') type('image/webp'), url('{$jpg}') type('image/jpeg'));";
}

/**
 * Is the restaurant open right now? Uses site.json hours and the WP timezone.
 * Returns null when hours can't be evaluated.
 */
function rusans_open_now() {
	$hours = rusans_site( 'hours', array() );
	if ( empty( $hours ) ) {
		return null;
	}
	$now = current_datetime();
	$day = $now->format( 'l' );
	$hm  = $now->format( 'H:i' );
	foreach ( $hours as $row ) {
		if ( in_array( $day, (array) ( $row['schema_days'] ?? array() ), true ) && ! empty( $row['open'] ) ) {
			return ( $hm >= $row['open'] && $hm < $row['close'] );
		}
	}
	return false;
}

/**
 * Shortcodes so content editors can drop NAP blocks into any page.
 * [rusans_hours] [rusans_address] [rusans_phone] [rusans_order_buttons]
 */
add_shortcode( 'rusans_hours', function () {
	ob_start();
	get_template_part( 'templates/rusans-hours' );
	return ob_get_clean();
} );
add_shortcode( 'rusans_address', function () {
	return '<span class="rusans-address">' . esc_html( rusans_address_line() ) . '</span>';
} );
add_shortcode( 'rusans_phone', function () {
	return '<a class="rusans-phone" href="tel:' . esc_attr( rusans_site( 'phone_e164' ) ) . '">' . esc_html( rusans_site( 'phone_display' ) ) . '</a>';
} );
add_shortcode( 'rusans_order_buttons', function () {
	ob_start();
	get_template_part( 'templates/rusans-order-cta', null, array( 'compact' => true ) );
	return ob_get_clean();
} );
