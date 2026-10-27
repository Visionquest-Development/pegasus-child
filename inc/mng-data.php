<?php
/**
 * Mr Nice Guy Authentic Soul Food — data + markup helpers.
 *
 * Name, address, phone, hours, links, events and SEO copy live in data/site.json,
 * so the header, footer, contact page and JSON-LD can never disagree.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Load and cache a JSON file from the child theme's data/ folder (site, menu, images).
 */
function mng_data( $name = 'site' ) {
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
 * Value from site.json with dot notation, e.g. mng_site( 'address.street' ).
 */
function mng_site( $key, $default = '' ) {
	$value = mng_data( 'site' );
	foreach ( explode( '.', $key ) as $part ) {
		if ( ! is_array( $value ) || ! array_key_exists( $part, $value ) ) {
			return $default;
		}
		$value = $value[ $part ];
	}
	return $value;
}

/** One-line address. */
function mng_address_line() {
	$a = mng_site( 'address', array() );
	if ( empty( $a['street'] ) ) {
		return '';
	}
	return sprintf( '%s, %s, %s %s', $a['street'], $a['city'], $a['region'], $a['postal'] );
}

/** Click-to-call link. */
function mng_phone_link( $class = '' ) {
	return sprintf(
		'<a class="%s" href="tel:%s">%s</a>',
		esc_attr( trim( 'mng-phone ' . $class ) ),
		esc_attr( mng_site( 'phone_e164' ) ),
		esc_html( mng_site( 'phone_display' ) )
	);
}

/** URL of a page by its template file, falling back to a slug. */
function mng_page_url( $template, $fallback_slug ) {
	static $cache = array();
	if ( ! isset( $cache[ $template ] ) ) {
		$pages              = get_pages( array( 'meta_key' => '_wp_page_template', 'meta_value' => $template, 'number' => 1 ) );
		$cache[ $template ] = $pages ? get_permalink( $pages[0] ) : home_url( '/' . trim( $fallback_slug, '/' ) . '/' );
	}
	return $cache[ $template ];
}

/** Theme image URL: images/<slug>[-<size>].<ext>. */
function mng_img_url( $slug, $ext = 'jpg', $size = '' ) {
	$file = $slug . ( $size ? '-' . $size : '' ) . '.' . $ext;
	return get_stylesheet_directory_uri() . '/images/' . $file;
}

/** Image metadata from data/images.json. */
function mng_img_meta( $slug ) {
	$images = mng_data( 'images' );
	return isset( $images[ $slug ] ) ? $images[ $slug ] : array();
}

/**
 * <picture> with a WebP source and JPEG/PNG fallback, width/height set, lazy unless eager.
 * Args: class, eager (bool), lazy (bool), sizes, alt (override).
 */
function mng_picture( $slug, $args = array() ) {
	$meta = mng_img_meta( $slug );
	if ( empty( $meta ) ) {
		return '';
	}
	$args  = wp_parse_args( $args, array( 'class' => '', 'eager' => false, 'lazy' => true, 'sizes' => '100vw', 'alt' => null ) );
	$alt   = null !== $args['alt'] ? $args['alt'] : ( $meta['alt'] ?? '' );
	$w     = (int) ( $meta['width'] ?? 0 );
	$h     = (int) ( $meta['height'] ?? 0 );
	$ext   = $meta['ext'] ?? 'jpg';
	$mime  = 'png' === $ext ? 'image/png' : 'image/jpeg';
	$sizes = isset( $meta['sizes'] ) && is_array( $meta['sizes'] ) ? $meta['sizes'] : array( $w );

	$webp_set = array();
	$fb_set   = array();
	foreach ( $sizes as $sw ) {
		$suffix     = ( (int) $sw === $w ) ? '' : (string) $sw;
		$webp_set[] = esc_url( mng_img_url( $slug, 'webp', $suffix ) ) . ' ' . (int) $sw . 'w';
		$fb_set[]   = esc_url( mng_img_url( $slug, $ext, $suffix ) ) . ' ' . (int) $sw . 'w';
	}

	$html  = '<picture>';
	$html .= '<source type="image/webp" srcset="' . implode( ', ', $webp_set ) . '" sizes="' . esc_attr( $args['sizes'] ) . '">';
	$html .= '<source type="' . $mime . '" srcset="' . implode( ', ', $fb_set ) . '" sizes="' . esc_attr( $args['sizes'] ) . '">';
	$html .= sprintf(
		'<img src="%s" alt="%s" width="%d" height="%d" class="%s" %s decoding="async">',
		esc_url( mng_img_url( $slug, $ext ) ),
		esc_attr( $alt ),
		$w,
		$h,
		esc_attr( $args['class'] ),
		$args['eager'] ? 'fetchpriority="high"' : ( $args['lazy'] ? 'loading="lazy"' : '' )
	);
	$html .= '</picture>';
	return $html;
}

/** Background-image style (WebP via image-set, JPEG fallback). */
function mng_bg_style( $slug ) {
	$jpg  = esc_url( mng_img_url( $slug, 'jpg' ) );
	$webp = esc_url( mng_img_url( $slug, 'webp' ) );
	return "background-image:url('{$jpg}');background-image:image-set(url('{$webp}') type('image/webp'), url('{$jpg}') type('image/jpeg'));";
}

/**
 * Is today an open day? (Times aren't known yet, so this is day-level only.)
 * Returns 'open-day', 'closed-day' or '' when there's no data.
 */
function mng_today_status() {
	$days = (array) mng_site( 'open_days', array() );
	if ( empty( $days ) ) {
		return '';
	}
	return in_array( current_datetime()->format( 'l' ), $days, true ) ? 'open-day' : 'closed-day';
}

/**
 * Events from site.json split into upcoming / past using the site timezone.
 *
 * @return array{upcoming: array, past: array}
 */
function mng_events() {
	$today = current_datetime()->format( 'Y-m-d' );
	$out   = array( 'upcoming' => array(), 'past' => array() );
	foreach ( (array) mng_site( 'events.list', array() ) as $e ) {
		$end = $e['end'] ?? $e['start'];
		$out[ $end >= $today ? 'upcoming' : 'past' ][] = $e;
	}
	$out['past'] = array_reverse( $out['past'] );
	return $out;
}

/** "Nov 22" or "Oct 16 – 17" from an event row. */
function mng_event_dates( $e ) {
	$s = date_create( $e['start'] );
	$f = date_create( $e['end'] ?? $e['start'] );
	if ( ! $s ) {
		return '';
	}
	if ( ! $f || $s->format( 'Y-m-d' ) === $f->format( 'Y-m-d' ) ) {
		return $s->format( 'M j' );
	}
	return $s->format( 'M' ) === $f->format( 'M' ) ? $s->format( 'M j' ) . ' – ' . $f->format( 'j' ) : $s->format( 'M j' ) . ' – ' . $f->format( 'M j' );
}

/**
 * Shortcodes for page content:
 * [mng_hours] [mng_address] [mng_phone] [mng_order_buttons] [mng_events]
 */
add_shortcode( 'mng_hours', function () {
	ob_start();
	get_template_part( 'templates/mng-hours' );
	return ob_get_clean();
} );
add_shortcode( 'mng_address', function () {
	return '<span class="mng-address">' . esc_html( mng_address_line() ) . '</span>';
} );
add_shortcode( 'mng_phone', function () {
	return mng_phone_link();
} );
add_shortcode( 'mng_order_buttons', function () {
	ob_start();
	get_template_part( 'templates/mng-order-cta', null, array( 'compact' => true ) );
	return ob_get_clean();
} );
add_shortcode( 'mng_events', function () {
	ob_start();
	get_template_part( 'templates/mng-events', null, array( 'limit' => 0 ) );
	return ob_get_clean();
} );
