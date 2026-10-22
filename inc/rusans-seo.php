<?php
/**
 * Ru San's Kennesaw — theme-level SEO.
 *
 * Fixes the theme-level issues from SEO-AUDIT.md:
 *  - unique <title> + meta description per page template (data/site.json "seo")
 *  - Open Graph / Twitter tags with a real food image
 *  - ONE Restaurant JSON-LD block built from the same NAP/hours data the page shows
 *
 * If Yoast SEO or Rank Math is active, titles/meta/OG are left to the plugin and
 * only the Restaurant schema is printed (neither plugin outputs Restaurant type).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function rusans_seo_plugin_active() {
	return defined( 'WPSEO_VERSION' ) || class_exists( 'RankMath' );
}

/**
 * Which site.json "seo" key applies to the current request.
 */
function rusans_seo_key() {
	if ( is_front_page() ) {
		return 'home';
	}
	$map = array(
		'tpl_menu.php'     => 'menu',
		'tpl_about.php'    => 'about',
		'tpl_location.php' => 'location',
		'tpl_catering.php' => 'catering',
		'tpl_gallery.php'  => 'gallery',
		'tpl_specials.php' => 'specials',
	);
	foreach ( $map as $tpl => $key ) {
		if ( is_page_template( $tpl ) ) {
			return $key;
		}
	}
	return '';
}

/**
 * Meta description for the current request (template copy, else excerpt).
 */
function rusans_meta_description() {
	$key = rusans_seo_key();
	if ( $key ) {
		return (string) rusans_site( 'seo.' . $key . '.description' );
	}
	if ( is_singular() ) {
		$post = get_queried_object();
		$text = has_excerpt( $post ) ? get_the_excerpt( $post ) : wp_strip_all_tags( strip_shortcodes( $post->post_content ) );
		$text = trim( preg_replace( '/\s+/', ' ', $text ) );
		if ( $text ) {
			return wp_html_excerpt( $text, 155, '…' );
		}
	}
	return (string) rusans_site( 'seo.home.description' );
}

/* Title: use template-specific titles when no SEO plugin is handling it. */
add_filter( 'pre_get_document_title', function ( $title ) {
	if ( rusans_seo_plugin_active() ) {
		return $title;
	}
	$key = rusans_seo_key();
	if ( $key && rusans_site( 'seo.' . $key . '.title' ) ) {
		return rusans_site( 'seo.' . $key . '.title' );
	}
	return $title;
}, 20 );

/* Meta description + OG + Twitter. */
add_action( 'wp_head', function () {
	if ( rusans_seo_plugin_active() ) {
		return;
	}
	$desc  = rusans_meta_description();
	$title = wp_get_document_title();
	$url   = is_singular() ? get_permalink() : home_url( add_query_arg( array(), $GLOBALS['wp']->request ?? '' ) );
	$img   = rusans_img_url( 'og-share', 'jpg' );
	$site  = rusans_site( 'name' );

	if ( $desc ) {
		printf( "<meta name=\"description\" content=\"%s\">\n", esc_attr( $desc ) );
	}
	printf( "<meta property=\"og:type\" content=\"%s\">\n", is_front_page() ? 'website' : 'article' );
	printf( "<meta property=\"og:site_name\" content=\"%s\">\n", esc_attr( $site ) );
	printf( "<meta property=\"og:title\" content=\"%s\">\n", esc_attr( $title ) );
	printf( "<meta property=\"og:description\" content=\"%s\">\n", esc_attr( $desc ) );
	printf( "<meta property=\"og:url\" content=\"%s\">\n", esc_url( $url ) );
	printf( "<meta property=\"og:image\" content=\"%s\">\n", esc_url( $img ) );
	echo "<meta property=\"og:image:width\" content=\"1200\">\n<meta property=\"og:image:height\" content=\"630\">\n";
	echo "<meta name=\"twitter:card\" content=\"summary_large_image\">\n";
	echo "<meta name=\"twitter:site\" content=\"@rusanskennesaw\">\n";
}, 2 );

/**
 * Build the Restaurant schema from data/site.json + data/menu.json.
 */
function rusans_restaurant_schema() {
	$s     = rusans_data( 'site' );
	$a     = $s['address'] ?? array();
	$hours = array();
	foreach ( (array) ( $s['hours'] ?? array() ) as $row ) {
		if ( empty( $row['open'] ) || empty( $row['schema_days'] ) ) {
			continue;
		}
		$hours[] = array(
			'@type'     => 'OpeningHoursSpecification',
			'dayOfWeek' => array_values( $row['schema_days'] ),
			'opens'     => $row['open'],
			'closes'    => $row['close'],
		);
	}
	$menu_page = get_pages( array( 'meta_key' => '_wp_page_template', 'meta_value' => 'tpl_menu.php', 'number' => 1 ) );
	$menu_url  = $menu_page ? get_permalink( $menu_page[0] ) : home_url( '/menu/' );

	$schema = array(
		'@context'                  => 'https://schema.org',
		'@type'                     => 'Restaurant',
		'@id'                       => home_url( '/#restaurant' ),
		'name'                      => $s['name'] ?? '',
		'description'               => $s['about']['short'] ?? '',
		'url'                       => home_url( '/' ),
		'telephone'                 => $s['phone_e164'] ?? '',
		'email'                     => $s['email_info'] ?? '',
		'image'                     => array( rusans_img_url( 'og-share', 'jpg' ), rusans_img_url( 'hero-sushi-combo', 'jpg' ) ),
		'logo'                      => rusans_img_url( 'rusans-logo', 'png' ),
		'servesCuisine'             => $s['schema']['servesCuisine'] ?? array(),
		'priceRange'                => $s['schema']['priceRange'] ?? '',
		'acceptsReservations'       => ! empty( $s['schema']['acceptsReservations'] ),
		'hasMenu'                   => $menu_url,
		'address'                   => array(
			'@type'           => 'PostalAddress',
			'streetAddress'   => $a['street'] ?? '',
			'addressLocality' => $a['city'] ?? '',
			'addressRegion'   => $a['region'] ?? '',
			'postalCode'      => $a['postal'] ?? '',
			'addressCountry'  => $a['country'] ?? 'US',
		),
		'openingHoursSpecification' => $hours,
		'sameAs'                    => array_values( array_map( function ( $x ) { return $x['href']; }, (array) ( $s['social'] ?? array() ) ) ),
		'potentialAction'           => array(
			'@type'  => 'OrderAction',
			'target' => array_values( array_map( function ( $x ) { return $x['href']; }, (array) ( $s['order']['partners'] ?? array() ) ) ),
		),
	);
	// TODO (site.json schema.geo_todo): add 'geo' => GeoCoordinates once lat/lng is confirmed from Google Business Profile.
	return $schema;
}

/* Print Restaurant schema on the pages that are "about the restaurant". */
add_action( 'wp_head', function () {
	$key = rusans_seo_key();
	if ( ! in_array( $key, array( 'home', 'location', 'menu', 'about', 'catering' ), true ) ) {
		return;
	}
	echo "<script type=\"application/ld+json\">" . wp_json_encode( rusans_restaurant_schema(), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . "</script>\n";
}, 20 );
