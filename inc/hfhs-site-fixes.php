<?php
/**
 * Hart Family of Home Services — site-wide settings + launch fixes.
 *
 * - "HFHS Site Settings" CMB2 options page (Appearance ▸ HFHS Site Settings):
 *     1. Header Login button (Jobber Client Hub URL; hidden while empty)
 *     2. Footer Privacy Policy link
 *     3. 301 redirects for old hfhsgeorgia.com URLs (defaults ship in code)
 * - hfhs_url(): makes same-site links root-relative and upgrades http:// → https://.
 * - "Login" links that point to "#" (menus/widgets/content) are pointed at the
 *   Client Hub URL, or removed while no URL is set.
 * - /services/ falls back to the Services Hub template when no template is set.
 *
 * Every option is blank by default; blank = the shipped default below.
 *
 * @package Pegasus_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'HFHS_SITE_OPTIONS', 'hfhs_site_options' );

/**
 * Read one HFHS Site Settings value, or $default when empty.
 */
function hfhs_site_option( $key, $default = '' ) {
	$opts = get_option( HFHS_SITE_OPTIONS, array() );
	$val  = ( is_array( $opts ) && isset( $opts[ $key ] ) ) ? $opts[ $key ] : '';
	if ( is_string( $val ) ) {
		$val = trim( $val );
	}
	return ( '' === $val || null === $val || array() === $val ) ? $default : $val;
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
 * 1. Header / menu Login → Jobber Client Hub.
 * ---------------------------------------------------------------------- */

/**
 * Client Hub URL (blank until set in HFHS Site Settings).
 */
function hfhs_login_url() {
	return hfhs_url( hfhs_site_option( 'login_url', apply_filters( 'hfhs_login_url_default', '' ) ) );
}

/**
 * Menu items titled "...Login..." that point at "#" (or nothing) get the Client
 * Hub URL, or are dropped while no URL is set.
 */
function hfhs_fix_login_menu_items( $items ) {
	$login = hfhs_login_url();
	foreach ( $items as $k => $item ) {
		$url = isset( $item->url ) ? trim( (string) $item->url ) : '';
		if ( ( '' === $url || '#' === $url ) && preg_match( '/log\s*-?\s*in/i', wp_strip_all_tags( (string) $item->title ) ) ) {
			if ( $login ) {
				$items[ $k ]->url    = $login;
				$items[ $k ]->target = '_blank';
				$items[ $k ]->xfn    = trim( $item->xfn . ' noopener noreferrer' );
			} else {
				unset( $items[ $k ] );
			}
		}
	}
	return $items;
}
add_filter( 'wp_nav_menu_objects', 'hfhs_fix_login_menu_items', 20 );

/**
 * Same rule for <a href="#">…Login…</a> inside widgets / content.
 */
function hfhs_fix_login_links_in_html( $html ) {
	if ( ! is_string( $html ) || false === stripos( $html, 'login' ) && false === stripos( $html, 'log in' ) ) {
		return $html;
	}
	$login = hfhs_login_url();
	return preg_replace_callback(
		'#<a\b([^>]*)\bhref=(["\'])\#?\2([^>]*)>(.*?)</a>#is',
		function ( $m ) use ( $login ) {
			if ( ! preg_match( '/log\s*-?\s*in/i', wp_strip_all_tags( $m[4] ) ) ) {
				return $m[0];
			}
			if ( ! $login ) {
				return '';
			}
			return '<a' . $m[1] . 'href="' . esc_url( $login ) . '"' . $m[3] . '>' . $m[4] . '</a>';
		},
		$html
	);
}
foreach ( array( 'the_content', 'widget_text', 'widget_text_content', 'widget_custom_html_content', 'widget_block_content' ) as $hfhs_filter ) {
	add_filter( $hfhs_filter, 'hfhs_fix_login_links_in_html', 99 );
}
unset( $hfhs_filter );

/* -------------------------------------------------------------------------
 * 2. Footer Privacy Policy link.
 * ---------------------------------------------------------------------- */

/**
 * Privacy Policy URL: override ▸ WP core Privacy page (Settings ▸ Privacy, once
 * published) ▸ /privacy-policy/.
 */
function hfhs_privacy_url() {
	$url = hfhs_site_option( 'privacy_url', '' );
	if ( ! $url && function_exists( 'get_privacy_policy_url' ) ) {
		$url = get_privacy_policy_url();
	}
	if ( ! $url ) {
		$url = home_url( '/privacy-policy/' );
	}
	return hfhs_url( $url );
}

/**
 * Footer link markup ('' when hidden in settings).
 */
function hfhs_privacy_link_html() {
	if ( 'hide' === hfhs_site_option( 'privacy_show', 'show' ) ) {
		return '';
	}
	return '<a class="hfhs-colophon__link" href="' . esc_url( hfhs_privacy_url() ) . '">' . esc_html( hfhs_site_option( 'privacy_label', 'Privacy Policy' ) ) . '</a>';
}

/* -------------------------------------------------------------------------
 * 3. 301 redirects for the old site's URLs.
 * ---------------------------------------------------------------------- */

/**
 * Default old → new map. 'always' rules fire even if a page exists at the old
 * path; '404' rules fire only when the old path would otherwise 404.
 *
 * @return array[] { from, to, when }
 */
function hfhs_default_redirects() {
	return array(
		array( 'from' => '/about-us/', 'to' => '/about/', 'when' => 'always' ),
		array( 'from' => '/contact-us/', 'to' => '/contact/', 'when' => 'always' ),
		array( 'from' => '/decking-services/', 'to' => '/services/decking/', 'when' => 'always' ),
		array( 'from' => '/outdoor-dry-sauna/', 'to' => '/services/custom-projects/', 'when' => 'always' ),
		array( 'from' => '/gutters-landing-page/', 'to' => '/services/gutters/', 'when' => 'always' ),
		array( 'from' => '/property-managers-landing-page/', 'to' => '/', 'when' => 'always' ),
		// The old "privacy-policy-duplicate" page is the contact form's Thank You page.
		array( 'from' => '/privacy-policy-duplicate/', 'to' => '/thank-you/', 'when' => 'always' ),
		// Old top-level service URLs (now under /services/).
		array( 'from' => '/gutters/', 'to' => '/services/gutters/', 'when' => '404' ),
		array( 'from' => '/fencing/', 'to' => '/services/fencing/', 'when' => '404' ),
		array( 'from' => '/exterior-repairs/', 'to' => '/services/exterior-repairs/', 'when' => '404' ),
		array( 'from' => '/roofing/', 'to' => '/services/roofing/', 'when' => '404' ),
		array( 'from' => '/tree-services/', 'to' => '/services/tree-services/', 'when' => '404' ),
	);
}

/**
 * Normalize a path for comparison: leading + trailing slash, lowercase.
 */
function hfhs_normalize_path( $path ) {
	$path = strtolower( trim( (string) wp_parse_url( (string) $path, PHP_URL_PATH ) ) );
	return '/' . trim( $path, '/' ) . ( '' === trim( $path, '/' ) ? '' : '/' );
}

/**
 * Effective map: code defaults, then HFHS Site Settings rows (same "from" wins).
 */
function hfhs_redirect_map() {
	$map = array();
	foreach ( hfhs_default_redirects() as $r ) {
		$map[ hfhs_normalize_path( $r['from'] ) ] = $r;
	}
	$custom = hfhs_site_option( 'redirects', array() );
	if ( is_array( $custom ) ) {
		foreach ( $custom as $r ) {
			if ( empty( $r['from'] ) || empty( $r['to'] ) ) {
				continue;
			}
			$map[ hfhs_normalize_path( $r['from'] ) ] = array(
				'from' => $r['from'],
				'to'   => $r['to'],
				'when' => ( isset( $r['when'] ) && '404' === $r['when'] ) ? '404' : 'always',
			);
		}
	}
	return apply_filters( 'hfhs_redirect_map', $map );
}

function hfhs_do_redirects() {
	if ( is_admin() || wp_doing_ajax() || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) ) {
		return;
	}
	$req  = isset( $_SERVER['REQUEST_URI'] ) ? wp_unslash( $_SERVER['REQUEST_URI'] ) : '';
	$path = (string) wp_parse_url( $req, PHP_URL_PATH );
	$base = (string) wp_parse_url( home_url( '/' ), PHP_URL_PATH ); // subdirectory installs
	if ( $base && '/' !== $base && 0 === strpos( $path, rtrim( $base, '/' ) ) ) {
		$path = substr( $path, strlen( rtrim( $base, '/' ) ) );
	}
	$key = hfhs_normalize_path( $path );
	$map = hfhs_redirect_map();
	if ( '/' === $key || empty( $map[ $key ] ) ) {
		return;
	}
	$rule = $map[ $key ];
	if ( '404' === $rule['when'] && ! is_404() ) {
		return;
	}
	$to = preg_match( '#^https?://#i', $rule['to'] ) ? $rule['to'] : home_url( '/' . ltrim( $rule['to'], '/' ) );
	if ( hfhs_normalize_path( $to ) === $key ) {
		return; // never loop
	}
	$query = (string) wp_parse_url( $req, PHP_URL_QUERY );
	if ( $query ) {
		$to .= ( false === strpos( $to, '?' ) ? '?' : '&' ) . $query;
	}
	wp_redirect( $to, 301, 'HFHS' ); // phpcs:ignore WordPress.Security.SafeRedirect -- targets are admin-defined
	exit;
}
add_action( 'template_redirect', 'hfhs_do_redirects', 1 );

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

/* -------------------------------------------------------------------------
 * CMB2: HFHS Site Settings options page.
 * ---------------------------------------------------------------------- */

add_action( 'cmb2_admin_init', 'hfhs_site_register_options' );
function hfhs_site_register_options() {
	$cmb = new_cmb2_box(
		array(
			'id'           => 'hfhs_site_settings',
			'title'        => __( 'HFHS Site Settings', 'pegasus' ),
			'object_types' => array( 'options-page' ),
			'option_key'   => HFHS_SITE_OPTIONS,
			'parent_slug'  => 'themes.php',
			'menu_title'   => __( 'HFHS Site Settings', 'pegasus' ),
			'capability'   => 'manage_options',
		)
	);

	$cmb->add_field( array( 'name' => '1. Header Login (Client Hub)', 'type' => 'title', 'id' => 'title_login', 'desc' => 'The "Login" button in the header and any menu/widget "Login" link that points to #. While the URL is empty, those Login links are hidden.' ) );
	$cmb->add_field( array( 'name' => 'Client Hub URL', 'desc' => 'Your Jobber Client Hub login link (Jobber ▸ Settings ▸ Client Hub ▸ copy the Client Hub link, e.g. https://clienthub.getjobber.com/client_hubs/…/login/new).', 'id' => 'login_url', 'type' => 'text_url', 'protocols' => array( 'https', 'http' ) ) );
	$cmb->add_field( array( 'name' => 'Login Button Text', 'id' => 'login_label', 'type' => 'text', 'attributes' => array( 'placeholder' => 'Login' ) ) );

	$cmb->add_field( array( 'name' => '2. Footer Privacy Policy Link', 'type' => 'title', 'id' => 'title_privacy', 'before_row' => '<hr>', 'desc' => 'Links to the page chosen in Settings ▸ Privacy (once it is published), otherwise /privacy-policy/.' ) );
	$cmb->add_field( array( 'name' => 'Show Link', 'id' => 'privacy_show', 'type' => 'select', 'default' => 'show', 'options' => array( 'show' => 'Show', 'hide' => 'Hide' ) ) );
	$cmb->add_field( array( 'name' => 'Link Text', 'id' => 'privacy_label', 'type' => 'text', 'attributes' => array( 'placeholder' => 'Privacy Policy' ) ) );
	$cmb->add_field( array( 'name' => 'URL Override', 'desc' => 'Optional. Leave blank to use the WordPress Privacy Policy page.', 'id' => 'privacy_url', 'type' => 'text', 'attributes' => array( 'placeholder' => '/privacy-policy/' ) ) );

	$defaults = '';
	foreach ( hfhs_default_redirects() as $r ) {
		$defaults .= '<code>' . esc_html( $r['from'] ) . '</code> &rarr; <code>' . esc_html( $r['to'] ) . '</code>' . ( '404' === $r['when'] ? ' <em>(only if the old URL 404s)</em>' : '' ) . '<br>';
	}
	$cmb->add_field( array( 'name' => '3. Redirects (301)', 'type' => 'title', 'id' => 'title_redirects', 'before_row' => '<hr>', 'desc' => 'Built-in redirects (always on):<br>' . $defaults . 'Add a row below to add a redirect or change one of these (a row with the same "From" path replaces the built-in one).' ) );
	$red = $cmb->add_field( array(
		'id'      => 'redirects',
		'type'    => 'group',
		'options' => array( 'group_title' => 'Redirect {#}', 'add_button' => 'Add Redirect', 'remove_button' => 'Remove', 'sortable' => true, 'closed' => true ),
	) );
	$cmb->add_group_field( $red, array( 'name' => 'From (old path)', 'id' => 'from', 'type' => 'text', 'attributes' => array( 'placeholder' => '/old-page/' ) ) );
	$cmb->add_group_field( $red, array( 'name' => 'To (new path or full URL)', 'id' => 'to', 'type' => 'text', 'attributes' => array( 'placeholder' => '/new-page/' ) ) );
	$cmb->add_group_field( $red, array( 'name' => 'When', 'id' => 'when', 'type' => 'select', 'default' => 'always', 'options' => array( 'always' => 'Always', '404' => 'Only if the old URL would 404' ) ) );
}
