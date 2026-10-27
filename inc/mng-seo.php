<?php
/**
 * Mr Nice Guy — theme-level SEO.
 *  - unique <title> + meta description per template (data/site.json "seo")
 *  - canonical-friendly Open Graph / Twitter tags with a real food image
 *  - Restaurant JSON-LD built from the same data the page shows
 *  - Menu JSON-LD (sections, items, prices) on the Menu page
 *
 * If Yoast SEO or Rank Math is active, titles/meta/OG are left to the plugin and
 * only the Restaurant/Menu schema is printed (neither plugin outputs those types).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function mng_seo_plugin_active() {
	return defined( 'WPSEO_VERSION' ) || class_exists( 'RankMath' );
}

/** Template file => site.json "seo" key. */
function mng_template_keys() {
	return array(
		'tpl_mng_menu.php'     => 'menu',
		'tpl_mng_about.php'    => 'about',
		'tpl_mng_catering.php' => 'catering',
		'tpl_mng_events.php'   => 'events',
		'tpl_mng_gallery.php'  => 'gallery',
		'tpl_mng_contact.php'  => 'contact',
	);
}

/** Which "seo" key applies to this request. */
function mng_seo_key() {
	if ( is_front_page() ) {
		return 'home';
	}
	foreach ( mng_template_keys() as $tpl => $key ) {
		if ( is_page_template( $tpl ) ) {
			return $key;
		}
	}
	return '';
}

/** Meta description for this request. */
function mng_meta_description() {
	$key = mng_seo_key();
	if ( $key ) {
		return (string) mng_site( 'seo.' . $key . '.description' );
	}
	if ( is_singular() ) {
		$post = get_queried_object();
		$text = has_excerpt( $post ) ? get_the_excerpt( $post ) : wp_strip_all_tags( strip_shortcodes( $post->post_content ) );
		$text = trim( preg_replace( '/\s+/', ' ', $text ) );
		if ( $text ) {
			return wp_html_excerpt( $text, 155, '…' );
		}
	}
	return (string) mng_site( 'seo.home.description' );
}

add_filter( 'pre_get_document_title', function ( $title ) {
	if ( mng_seo_plugin_active() ) {
		return $title;
	}
	$key = mng_seo_key();
	if ( $key && mng_site( 'seo.' . $key . '.title' ) ) {
		return mng_site( 'seo.' . $key . '.title' );
	}
	return $title;
}, 20 );

add_action( 'wp_head', function () {
	if ( mng_seo_plugin_active() ) {
		return;
	}
	$desc  = mng_meta_description();
	$title = wp_get_document_title();
	$url   = is_singular() ? get_permalink() : home_url( add_query_arg( array(), $GLOBALS['wp']->request ?? '' ) );
	if ( is_front_page() ) {
		$url = home_url( '/' );
	}

	if ( $desc ) {
		printf( "<meta name=\"description\" content=\"%s\">\n", esc_attr( $desc ) );
	}
	printf( "<meta property=\"og:type\" content=\"%s\">\n", is_front_page() ? 'website' : 'article' );
	printf( "<meta property=\"og:site_name\" content=\"%s\">\n", esc_attr( mng_site( 'name_long' ) ) );
	printf( "<meta property=\"og:locale\" content=\"en_US\">\n" );
	printf( "<meta property=\"og:title\" content=\"%s\">\n", esc_attr( $title ) );
	printf( "<meta property=\"og:description\" content=\"%s\">\n", esc_attr( $desc ) );
	printf( "<meta property=\"og:url\" content=\"%s\">\n", esc_url( $url ) );
	printf( "<meta property=\"og:image\" content=\"%s\">\n", esc_url( mng_img_url( 'og-share', 'jpg' ) ) );
	echo "<meta property=\"og:image:width\" content=\"1200\">\n<meta property=\"og:image:height\" content=\"630\">\n";
	printf( "<meta property=\"og:image:alt\" content=\"%s\">\n", esc_attr( mng_img_meta( 'og-share' )['alt'] ?? '' ) );
	echo "<meta name=\"twitter:card\" content=\"summary_large_image\">\n";
	printf( "<meta name=\"theme-color\" content=\"%s\">\n", '#1c1a19' );
}, 2 );

/** Restaurant schema from data/site.json. Hours are only output once times are filled in. */
function mng_restaurant_schema() {
	$s     = mng_data( 'site' );
	$a     = $s['address'] ?? array();
	$hours = array();
	foreach ( (array) ( $s['hours'] ?? array() ) as $row ) {
		if ( empty( $row['open'] ) || empty( $row['close'] ) || empty( $row['schema_days'] ) ) {
			continue;
		}
		$hours[] = array(
			'@type'     => 'OpeningHoursSpecification',
			'dayOfWeek' => array_values( $row['schema_days'] ),
			'opens'     => $row['open'],
			'closes'    => $row['close'],
		);
	}
	$schema = array(
		'@context'            => 'https://schema.org',
		'@type'               => 'Restaurant',
		'@id'                 => home_url( '/#restaurant' ),
		'name'                => $s['name_long'] ?? ( $s['name'] ?? '' ),
		'alternateName'       => array( $s['name'] ?? '', $s['short_name'] ?? '' ),
		'slogan'              => $s['slogans'][0] ?? '',
		'description'         => $s['about']['short'] ?? '',
		'url'                 => home_url( '/' ),
		'telephone'           => $s['phone_e164'] ?? '',
		'email'               => $s['email'] ?? '',
		'image'               => array( mng_img_url( 'og-share', 'jpg' ), mng_img_url( 'smoked-brisket', 'jpg' ), mng_img_url( 'ribs-on-grill', 'jpg' ) ),
		'logo'                => mng_img_url( 'mng-logo', 'png' ),
		'servesCuisine'       => $s['schema']['servesCuisine'] ?? array(),
		'priceRange'          => $s['schema']['priceRange'] ?? '',
		'acceptsReservations' => ! empty( $s['schema']['acceptsReservations'] ),
		'hasMenu'             => mng_page_url( 'tpl_mng_menu.php', 'menu' ),
		'areaServed'          => $s['service_area'] ?? '',
		'founder'             => array( '@type' => 'Person', 'name' => $s['chef']['name'] ?? '' ),
		'address'             => array(
			'@type'           => 'PostalAddress',
			'streetAddress'   => $a['street'] ?? '',
			'addressLocality' => $a['city'] ?? '',
			'addressRegion'   => $a['region'] ?? '',
			'postalCode'      => $a['postal'] ?? '',
			'addressCountry'  => $a['country'] ?? 'US',
		),
		'sameAs'              => array_values( array_map( function ( $x ) { return $x['href']; }, (array) ( $s['social'] ?? array() ) ) ),
	);
	if ( $hours ) {
		$schema['openingHoursSpecification'] = $hours;
	}
	// TODO (site.json schema.geo_todo): add 'geo' => GeoCoordinates once confirmed.
	return array_filter( $schema );
}

/** Menu schema (sections, items, USD prices) from data/menu.json. */
function mng_menu_schema() {
	$menu     = mng_data( 'menu' );
	$sections = array();
	foreach ( (array) ( $menu['sections'] ?? array() ) as $sec ) {
		$items = array();
		foreach ( (array) ( $sec['items'] ?? array() ) as $it ) {
			$item = array( '@type' => 'MenuItem', 'name' => $it['name'] );
			if ( ! empty( $it['desc'] ) ) {
				$item['description'] = $it['desc'];
			}
			if ( preg_match( '/\$(\d+(?:\.\d{2})?)/', $it['price'] ?? '', $m ) ) {
				$item['offers'] = array( '@type' => 'Offer', 'price' => $m[1], 'priceCurrency' => 'USD' );
			}
			$items[] = $item;
		}
		$sections[] = array(
			'@type'       => 'MenuSection',
			'name'        => $sec['title'],
			'description' => $sec['note'] ?? '',
			'hasMenuItem' => $items,
		);
	}
	return array(
		'@context'       => 'https://schema.org',
		'@type'          => 'Menu',
		'@id'            => mng_page_url( 'tpl_mng_menu.php', 'menu' ) . '#menu',
		'name'           => mng_site( 'name' ) . ' Menu',
		'url'            => mng_page_url( 'tpl_mng_menu.php', 'menu' ),
		'hasMenuSection' => $sections,
	);
}

add_action( 'wp_head', function () {
	$key   = mng_seo_key();
	$flags = JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE;
	if ( in_array( $key, array( 'home', 'menu', 'about', 'catering', 'contact', 'events' ), true ) ) {
		echo '<script type="application/ld+json">' . wp_json_encode( mng_restaurant_schema(), $flags ) . "</script>\n";
	}
	if ( 'menu' === $key ) {
		echo '<script type="application/ld+json">' . wp_json_encode( mng_menu_schema(), $flags ) . "</script>\n";
	}
}, 20 );
