<?php
/**
 * Hart Family of Home Services — site-wide helpers + launch fixes.
 *
 * - hfhs_url(): makes same-site links root-relative and upgrades http:// → https://.
 * - The same rule is applied to links inside post content and widgets.
 * - /services/ falls back to the Services Hub template when no template is set.
 * - hfhs_default_service_cards(): the ten default cards (home grid + services hub).
 *
 * Header/footer links (Login, Privacy Policy) are hardcoded in
 * templates/sticky_header.php and footer.php. Old-URL 301s live in .htaccess —
 * see docs/HFHS-REDIRECTS.md.
 *
 * @package Pegasus_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* -------------------------------------------------------------------------
 * Links: relative for this site, https for everything else.
 * ---------------------------------------------------------------------- */

/**
 * Hosts treated as "this site" (current home host + the production domain).
 *
 * @return string[]
 */
function hfhs_own_hosts() {
	$hosts = array( 'hfhsgeorgia.com', 'www.hfhsgeorgia.com' );
	$home  = wp_parse_url( home_url(), PHP_URL_HOST );
	if ( $home ) {
		$hosts[] = strtolower( $home );
	}
	return array_unique( apply_filters( 'hfhs_own_hosts', $hosts ) );
}

/**
 * Normalize a link: same-site absolute URLs become root-relative (so they never
 * carry a stale http:// or staging host), other http:// URLs become https://.
 * Anchors, relative paths, tel:, mailto: etc. pass through untouched.
 *
 * @param string $url Raw URL.
 * @return string
 */
function hfhs_url( $url ) {
	$url = trim( (string) $url );
	if ( '' === $url || ! preg_match( '#^(https?:)?//#i', $url ) ) {
		return $url;
	}
	$host = strtolower( (string) wp_parse_url( $url, PHP_URL_HOST ) );
	if ( $host && in_array( $host, hfhs_own_hosts(), true ) ) {
		$rel = preg_replace( '#^(https?:)?//[^/?\#]+#i', '', $url );
		return '' === $rel ? '/' : $rel;
	}
	return preg_replace( '#^http://#i', 'https://', $url );
}

/**
 * tel: href from a display phone number (US numbers get +1).
 */
function hfhs_tel_href( $phone ) {
	$digits = preg_replace( '/\D+/', '', (string) $phone );
	if ( 10 === strlen( $digits ) ) {
		$digits = '1' . $digits;
	}
	return 'tel:+' . $digits;
}

/**
 * Same-site link helper: hfhs_url( home_url( $path ) ).
 */
function hfhs_home_link( $path = '/' ) {
	return hfhs_url( home_url( $path ) );
}

/**
 * Apply hfhs_url() to every href in a chunk of HTML that points at this site
 * over http:// (e.g. links pasted into the editor or widgets as http://).
 */
function hfhs_fix_http_links_in_html( $html ) {
	if ( ! is_string( $html ) || false === stripos( $html, 'http://' ) ) {
		return $html;
	}
	return preg_replace_callback(
		'#(href|src)=(["\'])(http://[^"\']+)\2#i',
		function ( $m ) {
			return $m[1] . '=' . $m[2] . esc_attr( hfhs_url( $m[3] ) ) . $m[2];
		},
		$html
	);
}
foreach ( array( 'the_content', 'widget_text', 'widget_text_content', 'widget_custom_html_content', 'widget_block_content' ) as $hfhs_filter ) {
	add_filter( $hfhs_filter, 'hfhs_fix_http_links_in_html', 99 );
}
unset( $hfhs_filter );

/* -------------------------------------------------------------------------
 * Services hub: /services/ with no template → tpl_services.php.
 * ---------------------------------------------------------------------- */

function hfhs_services_hub_fallback( $template ) {
	if ( ! is_page() ) {
		return $template;
	}
	$id = get_queried_object_id();
	if ( ! $id || get_page_template_slug( $id ) ) {
		return $template; // an explicitly chosen template always wins
	}
	$slug    = get_post_field( 'post_name', $id );
	$is_hub  = ( 'services' === $slug && ! wp_get_post_parent_id( $id ) );
	$is_hub  = apply_filters( 'hfhs_is_services_hub', $is_hub, $id );
	$hub_tpl = get_stylesheet_directory() . '/tpl_services.php';
	return ( $is_hub && file_exists( $hub_tpl ) ) ? $hub_tpl : $template;
}
add_filter( 'page_template', 'hfhs_services_hub_fallback', 20 );

/* -------------------------------------------------------------------------
 * Default service cards (home grid + services hub).
 * ---------------------------------------------------------------------- */

function hfhs_default_service_cards() {
	$cards = trailingslashit( get_stylesheet_directory_uri() ) . 'images/services/cards/';
	return array(
		array( 'title' => 'Gutters', 'desc' => 'Cleaning, repair, full replacement, and custom installations. Keep water moving away from your home and your foundation.', 'link' => hfhs_home_link( '/services/gutters/' ), 'cta' => 'Explore Gutters', 'img' => $cards . 'gutters-card.webp' ),
		array( 'title' => 'Fencing', 'desc' => 'Wood privacy, picket, chain link, and custom gates. We’ve installed runs over 700 feet — no job is too long.', 'link' => hfhs_home_link( '/services/fencing/' ), 'cta' => 'Explore Fencing', 'img' => $cards . 'fencing-card.webp' ),
		array( 'title' => 'Exterior Repairs', 'desc' => 'Siding, fascia, soffit, windows, pressure washing, and weatherproofing. Full-scale exterior maintenance for homes and HOAs.', 'link' => hfhs_home_link( '/services/exterior-repairs/' ), 'cta' => 'Explore Exterior Repairs', 'img' => $cards . 'exterior-repairs-card.webp' ),
		array( 'title' => 'Roofing', 'desc' => 'Inspections, shingle repair, leak diagnosis, and storm damage assessment. Safety and transparency on every project.', 'link' => hfhs_home_link( '/services/roofing/' ), 'cta' => 'Explore Roofing', 'img' => $cards . 'roofing-card.webp' ),
		array( 'title' => 'Tree Services', 'desc' => 'Removal, trimming, storm cleanup, and debris hauling. Careful work that protects your property and landscape.', 'link' => hfhs_home_link( '/services/tree-services/' ), 'cta' => 'Explore Tree Services', 'img' => $cards . 'tree-services-card.webp' ),
		array( 'title' => 'Decking', 'desc' => 'New deck construction, repair, staining, refinishing, and railings. Pergolas and custom outdoor structures.', 'link' => hfhs_home_link( '/services/decking/' ), 'cta' => 'Explore Decking', 'img' => $cards . 'decking-card.webp' ),
		array( 'title' => 'Handyman Services', 'desc' => 'The punch-list specialists. One call knocks out the whole honey-do list — mounts, fixtures, small fixes, and more.', 'link' => hfhs_home_link( '/services/handyman/' ), 'cta' => 'Explore Handyman', 'img' => $cards . 'handyman-card.webp' ),
		array( 'title' => 'Interior Repairs', 'desc' => 'Painting, drywall, trim, crown molding, and finish carpentry. Clean job sites and finishes that look intentional.', 'link' => hfhs_home_link( '/services/interior-repairs/' ), 'cta' => 'Explore Interior Repairs', 'img' => $cards . 'interior-repairs-card.webp' ),
		array( 'title' => 'Custom Projects', 'desc' => 'Saunas, chicken coops, climbing walls, pergolas, custom gates. If you can dream it, there’s a good chance we can build it.', 'link' => hfhs_home_link( '/services/custom-projects/' ), 'cta' => 'Explore Custom Projects', 'img' => $cards . 'custom-projects-card.webp' ),
		array( 'title' => 'Windows & Doors', 'desc' => 'Window replacement, entry and patio doors, frame and sill repair, and weather sealing. Every opening set plumb, sealed tight, and trimmed clean.', 'link' => hfhs_home_link( '/services/windows-doors/' ), 'cta' => 'Explore Windows & Doors', 'img' => trailingslashit( get_stylesheet_directory_uri() ) . 'images/services/windows-doors/windows-doors-full-home-window-replacement.webp' ),
	);
}
