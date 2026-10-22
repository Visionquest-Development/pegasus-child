<?php
/**
 * Insurance Guy Joe — theme-level SEO.
 *
 * - <title>, meta description, canonical, Open Graph + Twitter per page
 *   (skipped automatically when Yoast SEO or Rank Math is active)
 * - JSON-LD @graph: InsuranceAgency + Person (+ WebSite on home), BreadcrumbList,
 *   Service (service pages), FAQPage (FAQ page + service FAQ blocks), Article (Learn posts).
 *   Schema is always printed; Yoast/Rank Math don't output these types with this data.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function igj_seo_plugin_active() {
	return defined( 'WPSEO_VERSION' ) || class_exists( 'RankMath' );
}

/**
 * site.json "seo" key for the current request.
 */
function igj_seo_key() {
	if ( is_front_page() ) {
		return 'home';
	}
	if ( is_home() ) {
		return 'learn';
	}
	if ( is_page() ) {
		$slug = get_post_field( 'post_name', get_queried_object_id() );
		if ( igj_site( 'seo.' . $slug ) ) {
			return $slug;
		}
	}
	return '';
}

function igj_seo_title() {
	$key = igj_seo_key();
	if ( $key ) {
		return (string) igj_site( 'seo.' . $key . '.title' );
	}
	$svc = igj_current_service_slug();
	if ( $svc ) {
		return (string) ( igj_service( $svc )['seo_title'] ?? '' );
	}
	if ( is_singular( 'post' ) ) {
		return get_the_title() . ' | ' . igj_site( 'name' );
	}
	return '';
}

function igj_meta_description() {
	$key = igj_seo_key();
	if ( $key ) {
		return (string) igj_site( 'seo.' . $key . '.description' );
	}
	$svc = igj_current_service_slug();
	if ( $svc ) {
		return (string) ( igj_service( $svc )['seo_desc'] ?? '' );
	}
	if ( is_singular() ) {
		$post = get_queried_object();
		$text = has_excerpt( $post ) ? get_the_excerpt( $post ) : igj_plain( strip_shortcodes( $post->post_content ) );
		return wp_html_excerpt( trim( preg_replace( '/\s+/', ' ', $text ) ), 155, '…' );
	}
	if ( is_category() || is_tag() ) {
		return wp_strip_all_tags( term_description() ) ? wp_html_excerpt( wp_strip_all_tags( term_description() ), 155, '…' ) : (string) igj_site( 'seo.learn.description' );
	}
	return (string) igj_site( 'seo.home.description' );
}

/**
 * Canonical URL for the current request (with trailing slash, without query args).
 */
function igj_canonical() {
	if ( is_front_page() ) {
		return home_url( '/' );
	}
	if ( is_home() ) {
		$id  = (int) get_option( 'page_for_posts' );
		$url = $id ? get_permalink( $id ) : home_url( '/' );
		$p   = (int) get_query_var( 'paged' );
		return $p > 1 ? trailingslashit( $url ) . user_trailingslashit( 'page/' . $p, 'paged' ) : $url;
	}
	if ( is_singular() ) {
		return get_permalink();
	}
	if ( is_category() || is_tag() ) {
		return get_term_link( get_queried_object() );
	}
	return '';
}

add_filter( 'pre_get_document_title', function ( $title ) {
	if ( igj_seo_plugin_active() || is_404() || is_search() ) {
		return $title;
	}
	$t = igj_seo_title();
	return $t ? $t : $title;
}, 20 );

/* Replace core's rel=canonical with ours (covers the posts page and archives too). */
add_action( 'wp', function () {
	if ( ! igj_seo_plugin_active() ) {
		remove_action( 'wp_head', 'rel_canonical' );
	}
} );

add_action( 'wp_head', function () {
	if ( igj_seo_plugin_active() || is_404() ) {
		return;
	}
	$desc  = igj_meta_description();
	$title = wp_get_document_title();
	$url   = igj_canonical();
	$img   = igj_img_url( 'og-share', 'jpg' );
	if ( is_singular( 'post' ) && has_post_thumbnail() ) {
		$img = get_the_post_thumbnail_url( null, 'large' );
	}
	if ( $desc ) {
		printf( "<meta name=\"description\" content=\"%s\">\n", esc_attr( $desc ) );
	}
	if ( $url ) {
		printf( "<link rel=\"canonical\" href=\"%s\">\n", esc_url( $url ) );
	}
	printf( "<meta property=\"og:locale\" content=\"en_US\">\n" );
	printf( "<meta property=\"og:type\" content=\"%s\">\n", is_singular( 'post' ) ? 'article' : 'website' );
	printf( "<meta property=\"og:site_name\" content=\"%s\">\n", esc_attr( igj_site( 'name' ) ) );
	printf( "<meta property=\"og:title\" content=\"%s\">\n", esc_attr( $title ) );
	printf( "<meta property=\"og:description\" content=\"%s\">\n", esc_attr( $desc ) );
	if ( $url ) {
		printf( "<meta property=\"og:url\" content=\"%s\">\n", esc_url( $url ) );
	}
	printf( "<meta property=\"og:image\" content=\"%s\">\n", esc_url( $img ) );
	echo "<meta property=\"og:image:width\" content=\"1200\">\n<meta property=\"og:image:height\" content=\"630\">\n";
	if ( is_singular( 'post' ) ) {
		printf( "<meta property=\"article:published_time\" content=\"%s\">\n", esc_attr( get_the_date( 'c' ) ) );
		printf( "<meta property=\"article:modified_time\" content=\"%s\">\n", esc_attr( get_the_modified_date( 'c' ) ) );
	}
	echo "<meta name=\"twitter:card\" content=\"summary_large_image\">\n";
}, 2 );

/* ---------- JSON-LD ---------- */

function igj_agency_id() {
	return home_url( '/#agency' );
}
function igj_person_id() {
	return home_url( '/about/#joe' );
}

function igj_schema_agency() {
	$s = igj_data( 'site' );
	$a = $s['address'] ?? array();
	$node = array(
		'@type'     => 'InsuranceAgency',
		'@id'       => igj_agency_id(),
		'name'      => $s['name'] ?? '',
		'url'       => home_url( '/' ),
		'telephone' => $s['phone_e164'] ?? '',
		'logo'      => igj_img_url( 'igj-logo', 'png' ),
		'image'     => igj_img_url( 'og-share', 'jpg' ),
		'description' => igj_site( 'seo.home.description' ),
		'founder'   => array( '@id' => igj_person_id() ),
		'employee'  => array( '@id' => igj_person_id() ),
		'knowsAbout' => array_values( array_map( function ( $x ) { return $x['service_type']; }, igj_services() ) ),
	);
	if ( ! empty( $s['legal_name'] ) ) {
		$node['legalName'] = $s['legal_name'];
	}
	if ( ! empty( $s['email'] ) ) {
		$node['email'] = $s['email'];
	}
	if ( ! empty( $a['street'] ) ) {
		$node['address'] = array(
			'@type'           => 'PostalAddress',
			'streetAddress'   => $a['street'],
			'addressLocality' => $a['city'] ?? '',
			'addressRegion'   => $a['region'] ?? '',
			'postalCode'      => $a['postal'] ?? '',
			'addressCountry'  => $a['country'] ?? 'US',
		);
	}
	if ( ! empty( $s['service_area'] ) ) {
		$node['areaServed'] = array_map( function ( $st ) { return array( '@type' => 'State', 'name' => $st ); }, (array) $s['service_area'] );
	}
	$same = array_values( array_filter( array_map( function ( $x ) { return $x['href'] ?? ''; }, (array) ( $s['social'] ?? array() ) ) ) );
	if ( ! empty( $s['google_business_profile'] ) ) {
		$same[] = $s['google_business_profile'];
	}
	if ( $same ) {
		$node['sameAs'] = $same;
	}
	$node['contactPoint'] = array(
		'@type'       => 'ContactPoint',
		'contactType' => 'sales',
		'telephone'   => $s['phone_e164'] ?? '',
		'areaServed'  => 'US',
		'availableLanguage' => 'English',
	);
	return $node;
}

function igj_schema_person() {
	$ag   = igj_site( 'agent', array() );
	$node = array(
		'@type'    => 'Person',
		'@id'      => igj_person_id(),
		'name'     => $ag['name'] ?? '',
		'alternateName' => $ag['full_name'] ?? '',
		'jobTitle' => $ag['job_title'] ?? '',
		'image'    => igj_img_url( 'joe-avena', 'jpg' ),
		'telephone' => igj_site( 'phone_e164' ),
		'worksFor' => array( '@id' => igj_agency_id() ),
		'url'      => home_url( '/about/' ),
	);
	$about = get_page_by_path( 'about' );
	if ( $about ) {
		$node['url'] = get_permalink( $about );
	}
	return $node;
}

function igj_schema_breadcrumbs() {
	$trail = igj_breadcrumbs();
	if ( count( $trail ) < 2 ) {
		return null;
	}
	$items = array();
	foreach ( $trail as $i => $crumb ) {
		$items[] = array(
			'@type'    => 'ListItem',
			'position' => $i + 1,
			'name'     => wp_strip_all_tags( $crumb[0] ),
			'item'     => $crumb[1],
		);
	}
	return array( '@type' => 'BreadcrumbList', '@id' => igj_canonical() . '#breadcrumb', 'itemListElement' => $items );
}

/**
 * FAQPage node from [ [q,a], … ]. Items that still contain a TODO are skipped.
 */
function igj_schema_faq( $items, $id ) {
	$main = array();
	foreach ( (array) $items as $f ) {
		if ( false !== strpos( $f['a'] . $f['q'], '{{todo:' ) ) {
			continue;
		}
		$main[] = array(
			'@type'          => 'Question',
			'name'           => igj_plain( $f['q'] ),
			'acceptedAnswer' => array( '@type' => 'Answer', 'text' => igj_plain( $f['a'] ) ),
		);
	}
	return $main ? array( '@type' => 'FAQPage', '@id' => $id, 'mainEntity' => $main ) : null;
}

function igj_schema_graph() {
	$graph = array( igj_schema_agency(), igj_schema_person() );
	if ( is_front_page() ) {
		$graph[] = array(
			'@type'     => 'WebSite',
			'@id'       => home_url( '/#website' ),
			'url'       => home_url( '/' ),
			'name'      => igj_site( 'name' ),
			'publisher' => array( '@id' => igj_agency_id() ),
			'inLanguage' => 'en-US',
		);
	}
	$bc = igj_schema_breadcrumbs();
	if ( $bc ) {
		$graph[] = $bc;
	}
	$svc_slug = igj_current_service_slug();
	if ( $svc_slug ) {
		$svc   = igj_service( $svc_slug );
		$node  = array(
			'@type'       => 'Service',
			'@id'         => get_permalink() . '#service',
			'name'        => $svc['title'],
			'serviceType' => $svc['service_type'],
			'description' => $svc['seo_desc'],
			'url'         => get_permalink(),
			'provider'    => array( '@id' => igj_agency_id() ),
			'category'    => 'Health insurance',
		);
		$area = igj_site( 'service_area', array() );
		$node['areaServed'] = $area ? array_map( function ( $st ) { return array( '@type' => 'State', 'name' => $st ); }, (array) $area ) : array( '@type' => 'Country', 'name' => 'United States' );
		$graph[] = $node;
		$faq = igj_schema_faq( $svc['faq'] ?? array(), get_permalink() . '#faq' );
		if ( $faq ) {
			$graph[] = $faq;
		}
	}
	if ( is_page() && 'faq' === get_post_field( 'post_name', get_queried_object_id() ) ) {
		$all = array();
		foreach ( (array) ( igj_data( 'faq' )['groups'] ?? array() ) as $g ) {
			$all = array_merge( $all, $g['items'] );
		}
		$faq = igj_schema_faq( $all, get_permalink() . '#faq' );
		if ( $faq ) {
			$graph[] = $faq;
		}
	}
	if ( is_singular( 'post' ) ) {
		$img = has_post_thumbnail() ? get_the_post_thumbnail_url( null, 'large' ) : igj_img_url( 'og-share', 'jpg' );
		$graph[] = array(
			'@type'            => 'Article',
			'@id'              => get_permalink() . '#article',
			'headline'         => wp_strip_all_tags( get_the_title() ),
			'description'      => igj_meta_description(),
			'datePublished'    => get_the_date( 'c' ),
			'dateModified'     => get_the_modified_date( 'c' ),
			'author'           => array( '@id' => igj_person_id() ),
			'publisher'        => array( '@id' => igj_agency_id() ),
			'image'            => $img,
			'mainEntityOfPage' => get_permalink(),
			'inLanguage'       => 'en-US',
		);
	}
	return $graph;
}

add_action( 'wp_head', function () {
	if ( is_404() || is_search() ) {
		return;
	}
	$data = array( '@context' => 'https://schema.org', '@graph' => igj_schema_graph() );
	echo '<script type="application/ld+json">' . wp_json_encode( $data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . "</script>\n";
}, 20 );
