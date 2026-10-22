<?php
/**
 * Insurance Guy Joe — data + markup helpers.
 *
 * All business facts live in data/site.json; service copy in data/services.json;
 * FAQ in data/faq.json. Header, footer, pages and JSON-LD all read from the same data.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Load and cache a JSON file from the child theme's data/ (or content/) folder.
 */
function igj_data( $name = 'site', $dir = 'data' ) {
	static $cache = array();
	$key = $dir . '/' . $name;
	if ( isset( $cache[ $key ] ) ) {
		return $cache[ $key ];
	}
	$path = get_stylesheet_directory() . '/' . $dir . '/' . sanitize_file_name( $name ) . '.json';
	$data = array();
	if ( is_readable( $path ) ) {
		$decoded = json_decode( (string) file_get_contents( $path ), true );
		if ( is_array( $decoded ) ) {
			$data = $decoded;
		}
	}
	$cache[ $key ] = $data;
	return $data;
}

/**
 * Value from site.json with dot notation, e.g. igj_site( 'agent.name' ).
 */
function igj_site( $key, $default = '' ) {
	$value = igj_data( 'site' );
	foreach ( explode( '.', $key ) as $part ) {
		if ( ! is_array( $value ) || ! array_key_exists( $part, $value ) ) {
			return $default;
		}
		$value = $value[ $part ];
	}
	return $value;
}

/**
 * Should TODO placeholders be visible? Default: yes (draft site). Turn off for launch:
 * add_filter( 'igj_show_todos', '__return_false' );
 */
function igj_show_todos() {
	return (bool) apply_filters( 'igj_show_todos', true );
}

/**
 * A clearly labelled TODO placeholder for content Joe still has to supply.
 */
function igj_todo( $text ) {
	if ( ! igj_show_todos() ) {
		return '';
	}
	return '<span class="igj-todo" role="note"><strong>TODO for Joe:</strong> ' . esc_html( $text ) . '</span>';
}

/**
 * Click-to-call link.
 */
function igj_phone_link( $class = '', $label = '' ) {
	$label = $label ? $label : igj_site( 'phone_display' );
	return sprintf( '<a class="%s" href="tel:%s">%s</a>', esc_attr( trim( 'igj-phone ' . $class ) ), esc_attr( igj_site( 'phone_e164' ) ), esc_html( $label ) );
}

/**
 * URL of the Contact page (the on-site quote form), falling back to /contact/.
 */
function igj_contact_url( $fragment = '' ) {
	$page = get_page_by_path( 'contact' );
	$url  = $page ? get_permalink( $page ) : home_url( '/contact/' );
	return $fragment ? $url . '#' . $fragment : $url;
}

/**
 * Expand content tokens and make root-relative links work in subfolder installs.
 * {{phone}}  → click-to-call link
 * {{todo:…}} → TODO badge (hidden when igj_show_todos is false)
 */
function igj_render( $html ) {
	$html = str_replace( '{{phone}}', igj_phone_link(), (string) $html );
	$html = preg_replace_callback( '/\{\{todo:(.*?)\}\}/s', function ( $m ) {
		return igj_todo( wp_strip_all_tags( $m[1] ) );
	}, $html );
	$home = untrailingslashit( home_url() );
	$html = preg_replace( '#href="/(?!/)#', 'href="' . esc_url( $home ) . '/', $html );
	return $html;
}

/**
 * Plain text version (for JSON-LD / meta): strip tokens and tags.
 */
function igj_plain( $html ) {
	$html = str_replace( '{{phone}}', (string) igj_site( 'phone_display' ), (string) $html );
	$html = preg_replace( '/\{\{todo:.*?\}\}/s', '', $html );
	return trim( preg_replace( '/\s+/', ' ', wp_strip_all_tags( $html ) ) );
}

/* Expand tokens in post/page content too (Learn articles use {{phone}} and {{todo:…}}). */
add_filter( 'the_content', 'igj_render', 20 );

/* ---------- Services ---------- */

function igj_services() {
	$d = igj_data( 'services' );
	return isset( $d['services'] ) ? $d['services'] : array();
}

function igj_service( $slug ) {
	$all = igj_services();
	return isset( $all[ $slug ] ) ? $all[ $slug ] : array();
}

/**
 * URL of a service page by slug (real permalink if the page exists).
 */
function igj_service_url( $slug ) {
	$svc  = igj_service( $slug );
	$path = 'services/' . ( ! empty( $svc['parent'] ) ? $svc['parent'] . '/' : '' ) . $slug;
	$page = get_page_by_path( $path );
	return $page ? get_permalink( $page ) : home_url( '/' . $path . '/' );
}

/**
 * The service slug for the current page (null if this isn't a service page).
 */
function igj_current_service_slug() {
	if ( ! is_page() ) {
		return null;
	}
	$slug = get_post_field( 'post_name', get_queried_object_id() );
	return igj_service( $slug ) ? $slug : null;
}

/**
 * URL of a Learn article by slug.
 */
function igj_learn_url( $slug ) {
	$p = get_page_by_path( $slug, OBJECT, 'post' );
	return $p ? get_permalink( $p ) : home_url( '/learn/' . $slug . '/' );
}

function igj_learn_title( $slug ) {
	$p = get_page_by_path( $slug, OBJECT, 'post' );
	if ( $p ) {
		return get_the_title( $p );
	}
	foreach ( (array) ( igj_data( 'learn', 'content' )['posts'] ?? array() ) as $row ) {
		if ( $row['slug'] === $slug ) {
			return $row['title'];
		}
	}
	return ucwords( str_replace( '-', ' ', $slug ) );
}

/* ---------- Images ---------- */

function igj_img_url( $slug, $ext = null, $size = '' ) {
	$meta = igj_img_meta( $slug );
	$ext  = $ext ? $ext : ( $meta['ext'] ?? 'jpg' );
	return get_stylesheet_directory_uri() . '/images/' . $slug . ( $size ? '-' . $size : '' ) . '.' . $ext;
}

function igj_img_meta( $slug ) {
	$images = igj_data( 'images' );
	return isset( $images[ $slug ] ) ? $images[ $slug ] : array();
}

/**
 * <picture>: WebP with JPEG/PNG fallback, width/height set, lazy unless eager.
 */
function igj_picture( $slug, $args = array() ) {
	$meta = igj_img_meta( $slug );
	if ( empty( $meta ) ) {
		return '';
	}
	$args  = wp_parse_args( $args, array( 'class' => '', 'eager' => false, 'sizes' => '100vw', 'alt' => null ) );
	$alt   = null !== $args['alt'] ? $args['alt'] : ( $meta['alt'] ?? '' );
	$w     = (int) ( $meta['width'] ?? 0 );
	$h     = (int) ( $meta['height'] ?? 0 );
	$ext   = $meta['ext'] ?? 'jpg';
	$mime  = 'png' === $ext ? 'image/png' : 'image/jpeg';
	$webp  = array();
	$fall  = array();
	foreach ( (array) ( $meta['sizes'] ?? array() ) as $sw ) {
		$suffix = ( (int) $sw === $w ) ? '' : (string) $sw;
		$webp[] = esc_url( igj_img_url( $slug, 'webp', $suffix ) ) . ' ' . (int) $sw . 'w';
		$fall[] = esc_url( igj_img_url( $slug, $ext, $suffix ) ) . ' ' . (int) $sw . 'w';
	}
	$html = '<picture>';
	if ( $webp ) {
		$html .= '<source type="image/webp" srcset="' . implode( ', ', $webp ) . '" sizes="' . esc_attr( $args['sizes'] ) . '">';
		$html .= '<source type="' . $mime . '" srcset="' . implode( ', ', $fall ) . '" sizes="' . esc_attr( $args['sizes'] ) . '">';
	}
	$html .= sprintf(
		'<img src="%s" alt="%s" width="%d" height="%d" class="%s" %s decoding="async">',
		esc_url( igj_img_url( $slug, $ext ) ),
		esc_attr( $alt ),
		$w,
		$h,
		esc_attr( $args['class'] ),
		$args['eager'] ? 'fetchpriority="high"' : 'loading="lazy"'
	);
	return $html . '</picture>';
}

/**
 * Background image style with WebP via image-set() and JPEG fallback.
 */
function igj_bg_style( $slug, $size = '' ) {
	$jpg  = esc_url( igj_img_url( $slug, 'jpg', $size ) );
	$webp = esc_url( igj_img_url( $slug, 'webp', $size ) );
	return "background-image:url('{$jpg}');background-image:image-set(url('{$webp}') type('image/webp'), url('{$jpg}') type('image/jpeg'));";
}

/* ---------- Breadcrumbs ---------- */

/**
 * Breadcrumb trail for the current request: array of [ name, url ].
 * Same data feeds the visible breadcrumbs and BreadcrumbList JSON-LD.
 */
function igj_breadcrumbs() {
	$home  = array( array( __( 'Home', 'pegasus' ), home_url( '/' ) ) );
	if ( is_front_page() ) {
		return array();
	}
	$trail = $home;
	$posts_page = (int) get_option( 'page_for_posts' );
	if ( is_home() && $posts_page ) {
		$trail[] = array( get_the_title( $posts_page ), get_permalink( $posts_page ) );
	} elseif ( is_singular( 'post' ) ) {
		if ( $posts_page ) {
			$trail[] = array( get_the_title( $posts_page ), get_permalink( $posts_page ) );
		}
		$trail[] = array( get_the_title(), get_permalink() );
	} elseif ( is_page() ) {
		$id = get_queried_object_id();
		foreach ( array_reverse( get_post_ancestors( $id ) ) as $anc ) {
			$trail[] = array( get_the_title( $anc ), get_permalink( $anc ) );
		}
		$trail[] = array( get_the_title( $id ), get_permalink( $id ) );
	} elseif ( is_category() || is_tag() ) {
		if ( $posts_page ) {
			$trail[] = array( get_the_title( $posts_page ), get_permalink( $posts_page ) );
		}
		$trail[] = array( single_term_title( '', false ), get_term_link( get_queried_object() ) );
	} else {
		return array();
	}
	return $trail;
}

/* ---------- Contact form (quote request) ---------- */

/**
 * Handle the quote request form on the Contact page.
 * Sends to site.json email, else the WP admin email. Nonce + honeypot + basic validation.
 */
function igj_handle_quote_form() {
	$back = wp_get_referer() ? wp_get_referer() : igj_contact_url();
	$back = remove_query_arg( 'igj_sent', $back );
	if ( ! isset( $_POST['igj_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['igj_nonce'] ) ), 'igj_quote' ) ) {
		wp_safe_redirect( add_query_arg( 'igj_sent', 'error', $back ) . '#quote-form' );
		exit;
	}
	if ( ! empty( $_POST['igj_website'] ) ) { // Honeypot.
		wp_safe_redirect( add_query_arg( 'igj_sent', 'ok', $back ) . '#quote-form' );
		exit;
	}
	$name    = sanitize_text_field( wp_unslash( $_POST['igj_name'] ?? '' ) );
	$phone   = sanitize_text_field( wp_unslash( $_POST['igj_phone'] ?? '' ) );
	$email   = sanitize_email( wp_unslash( $_POST['igj_email'] ?? '' ) );
	$zip     = sanitize_text_field( wp_unslash( $_POST['igj_zip'] ?? '' ) );
	$topic   = sanitize_text_field( wp_unslash( $_POST['igj_topic'] ?? '' ) );
	$message = sanitize_textarea_field( wp_unslash( $_POST['igj_message'] ?? '' ) );
	$consent = ! empty( $_POST['igj_consent'] );
	if ( ! $name || ( ! $phone && ! is_email( $email ) ) || ! $consent ) {
		wp_safe_redirect( add_query_arg( 'igj_sent', 'missing', $back ) . '#quote-form' );
		exit;
	}
	$to   = igj_site( 'email' ) ? igj_site( 'email' ) : get_option( 'admin_email' );
	$body = "Quote request from " . home_url( '/' ) . "\n\nName: {$name}\nPhone: {$phone}\nEmail: {$email}\nZIP: {$zip}\nLooking for: {$topic}\n\nMessage:\n{$message}\n";
	$headers = array();
	if ( is_email( $email ) ) {
		$headers[] = 'Reply-To: ' . $name . ' <' . $email . '>';
	}
	$ok = wp_mail( $to, 'New quote request: ' . $name, $body, $headers );
	wp_safe_redirect( add_query_arg( 'igj_sent', $ok ? 'ok' : 'error', $back ) . '#quote-form' );
	exit;
}
add_action( 'admin_post_nopriv_igj_quote', 'igj_handle_quote_form' );
add_action( 'admin_post_igj_quote', 'igj_handle_quote_form' );

/* ---------- Shortcodes ---------- */
add_shortcode( 'igj_phone', function () {
	return igj_phone_link();
} );
add_shortcode( 'igj_quote_button', function ( $atts ) {
	$atts = shortcode_atts( array( 'label' => __( 'Get a Free Quote', 'pegasus' ) ), $atts );
	return '<a class="btn igj-btn igj-btn--cta" href="' . esc_url( igj_contact_url( 'quote-form' ) ) . '">' . esc_html( $atts['label'] ) . '</a>';
} );
