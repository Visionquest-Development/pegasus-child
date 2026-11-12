<?php
/**
 * Insurance Guy Joe — editable content helpers (CMB2).
 *
 * How it works
 * ------------
 * - Every editable piece of copy has a DEFAULT in inc/igj-content-defaults.php (the single
 *   source of truth). The CMB2 admin fields (inc/igj-cmb2.php) are prefilled with those defaults.
 * - Text fields: a non-empty saved value wins; an empty value falls back to the default.
 * - Repeatable groups: the admin prefills ONLY the first default item. On the frontend:
 *     nothing saved, or exactly one item identical to the first default  → the FULL default list;
 *     anything else (an edited first item, or 2+ items)                  → exactly the saved items.
 * - Images: file fields default to the theme image URL; empty → theme image.
 *
 * Templates call igj_section( 'home', 'hero' ) and get a fully resolved array back.
 * Header, footer and JSON-LD read site-wide facts through igj_site(), which overlays the
 * "IGJ Site Info" options page (option igj_site_info) on top of data/site.json.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'IGJ_SITE_OPTION', 'igj_site_info' );

/* ---------- Low-level helpers ---------- */

/**
 * Normalize a value for "is it the default?" comparisons: decode entities, collapse whitespace.
 */
function igj_cms_norm( $v ) {
	if ( is_array( $v ) ) {
		$v = implode( "\n", array_map( 'igj_cms_norm', $v ) );
	}
	$v = html_entity_decode( wp_specialchars_decode( (string) $v, ENT_QUOTES ), ENT_QUOTES | ENT_HTML5, 'UTF-8' );
	return trim( preg_replace( '/\s+/u', ' ', $v ) );
}

function igj_cms_is_empty( $v ) {
	return '' === igj_cms_norm( $v );
}

/**
 * Raw stored value. $obj = post ID, or 'options' for the IGJ Site Info page.
 */
function igj_cms_raw( $key, $obj = null ) {
	if ( 'options' === $obj ) {
		$o = get_option( IGJ_SITE_OPTION, array() );
		return ( is_array( $o ) && isset( $o[ $key ] ) ) ? $o[ $key ] : null;
	}
	$obj = $obj ? (int) $obj : (int) get_queried_object_id();
	if ( ! $obj ) {
		return null;
	}
	return get_post_meta( $obj, $key, true );
}

/**
 * Scalar field: saved non-empty value, otherwise the default.
 */
function igj_field( $key, $default = '', $obj = null ) {
	$v = igj_cms_raw( $key, $obj );
	if ( null === $v || false === $v || igj_cms_is_empty( $v ) ) {
		return $default;
	}
	return $v;
}

/**
 * Does a saved group row contain anything? (Ignores CMB2's *_id attachment keys.)
 */
function igj_cms_row_has_content( $row ) {
	if ( ! is_array( $row ) ) {
		return false;
	}
	foreach ( $row as $k => $v ) {
		if ( '_id' === substr( (string) $k, -3 ) ) {
			continue;
		}
		if ( ! igj_cms_is_empty( $v ) ) {
			return true;
		}
	}
	return false;
}

/**
 * Is a saved row identical to a default row (storage format)?
 */
function igj_cms_row_equals( $row, $default_row ) {
	foreach ( (array) $default_row as $k => $dv ) {
		if ( '_id' === substr( (string) $k, -3 ) ) {
			continue;
		}
		$rv = $row[ $k ] ?? '';
		if ( is_array( $dv ) || is_array( $rv ) ) {
			$a = array_map( 'igj_cms_norm', (array) $dv );
			$b = array_map( 'igj_cms_norm', (array) $rv );
			sort( $a );
			sort( $b );
			if ( array_values( array_filter( $a, 'strlen' ) ) !== array_values( array_filter( $b, 'strlen' ) ) ) {
				return false;
			}
			continue;
		}
		if ( igj_cms_norm( $rv ) !== igj_cms_norm( $dv ) ) {
			return false;
		}
	}
	return true;
}

/**
 * Repeatable group (storage format rows).
 * Empty, or a single row equal to the first default → the full default list; else the saved rows.
 */
function igj_group( $key, $defaults = array(), $obj = null ) {
	$saved = igj_cms_raw( $key, $obj );
	$rows  = array();
	foreach ( (array) $saved as $r ) {
		if ( igj_cms_row_has_content( $r ) ) {
			$rows[] = $r;
		}
	}
	if ( ! $rows ) {
		return $defaults;
	}
	if ( 1 === count( $rows ) && $defaults && igj_cms_row_equals( $rows[0], $defaults[0] ) ) {
		return $defaults;
	}
	return $rows;
}

/* ---------- Field types: native value <-> CMB2 storage ---------- */

/**
 * Convert a native default to what CMB2 stores/shows in the field.
 *   list  : array of lines  → textarea, one per line
 *   paras : array of paras  → textarea, blank line between paragraphs
 *   image : theme image slug → URL
 */
function igj_cms_to_storage( $f, $v ) {
	switch ( $f['type'] ) {
		case 'list':
			return implode( "\n", (array) $v );
		case 'paras':
			return implode( "\n\n", (array) $v );
		case 'image':
			return ( $v && false === strpos( (string) $v, '/' ) ) ? igj_img_url( $v ) : (string) $v;
		case 'multicheck':
			return array_values( (array) $v );
		default:
			return is_array( $v ) ? $v : (string) $v;
	}
}

/**
 * Convert a stored value back to the native value templates use.
 */
function igj_cms_from_storage( $f, $v ) {
	switch ( $f['type'] ) {
		case 'list':
			return array_values( array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', (string) $v ) ), 'strlen' ) );
		case 'paras':
			return array_values( array_filter( array_map( 'trim', preg_split( '/(\r\n|\r|\n)\s*(\r\n|\r|\n)/', (string) $v ) ), 'strlen' ) );
		case 'multicheck':
			return array_values( (array) $v );
		default:
			return is_string( $v ) ? $v : ( is_array( $v ) ? $v : (string) $v );
	}
}

/**
 * Default rows of a group in storage format.
 */
function igj_cms_group_storage_defaults( $g ) {
	$out = array();
	foreach ( (array) ( $g['default'] ?? array() ) as $row ) {
		$r = array();
		foreach ( $g['fields'] as $sf ) {
			$r[ $sf['id'] ] = igj_cms_to_storage( $sf, $row[ $sf['id'] ] ?? '' );
		}
		$out[] = $r;
	}
	return $out;
}

/**
 * Resolve one field (scalar or group) to its native value.
 */
function igj_cms_resolve_field( $f, $key, $obj ) {
	if ( 'title' === $f['type'] ) {
		return null;
	}
	if ( 'group' === $f['type'] ) {
		$storage_defaults = igj_cms_group_storage_defaults( $f );
		$rows             = igj_group( $key, $storage_defaults, $obj );
		if ( $rows === $storage_defaults ) {
			return array_values( (array) ( $f['default'] ?? array() ) ); // Native defaults (untouched).
		}
		$out = array();
		foreach ( $rows as $row ) {
			$r = array();
			foreach ( $f['fields'] as $sf ) {
				$r[ $sf['id'] ] = igj_cms_from_storage( $sf, $row[ $sf['id'] ] ?? '' );
				if ( 'image' === $sf['type'] ) {
					$r[ $sf['id'] . '_id' ] = (int) ( $row[ $sf['id'] . '_id' ] ?? 0 );
				}
			}
			$out[] = $r;
		}
		return $out;
	}
	$raw = igj_cms_raw( $key, $obj );
	if ( null === $raw || false === $raw || igj_cms_is_empty( $raw ) ) {
		return $f['default'] ?? '';
	}
	if ( 'image' === $f['type'] ) {
		return $raw; // URL (theme URL maps back to the optimized <picture> in igj_picture()).
	}
	return igj_cms_from_storage( $f, $raw );
}

/* ---------- Sections ---------- */

/**
 * Post meta key for a template field: igj_{tpl}_{section}_{field}.
 */
function igj_cms_key( $tpl, $section, $field ) {
	return 'igj_' . $tpl . '_' . $section . '_' . $field;
}

/**
 * Resolved content of one numbered section of a template.
 *
 * @param string   $tpl     home|about|services|service|contact|faq
 * @param string   $section Section ID (e.g. hero, steps).
 * @param int|null $post_id Defaults to the current page.
 */
function igj_section( $tpl, $section, $post_id = null ) {
	static $cache = array();
	$post_id = $post_id ? (int) $post_id : (int) get_queried_object_id();
	$ck      = $tpl . '|' . $section . '|' . $post_id;
	if ( isset( $cache[ $ck ] ) ) {
		return $cache[ $ck ];
	}
	$schema = igj_cms_schema( $tpl, $post_id );
	$out    = array();
	if ( isset( $schema[ $section ] ) ) {
		foreach ( $schema[ $section ]['fields'] as $f ) {
			if ( 'title' === $f['type'] ) {
				continue;
			}
			$out[ $f['id'] ] = igj_cms_resolve_field( $f, igj_cms_key( $tpl, $section, $f['id'] ), $post_id );
			if ( 'image' === $f['type'] ) {
				$out[ $f['id'] . '_id' ] = (int) igj_cms_raw( igj_cms_key( $tpl, $section, $f['id'] ) . '_id', $post_id );
			}
		}
	}
	$cache[ $ck ] = $out;
	return $out;
}

/**
 * Default (unsaved) content of a section definition — used by partials called without content.
 */
function igj_cms_section_defaults( $section_def ) {
	$out = array();
	foreach ( $section_def['fields'] as $f ) {
		if ( 'title' !== $f['type'] ) {
			$out[ $f['id'] ] = $f['default'] ?? '';
		}
	}
	return $out;
}

/**
 * Replace {tokens} in a string, e.g. {state_count}.
 */
function igj_cms_tokens( $text, $map = array() ) {
	$map = array_merge(
		array(
			'state_count' => count( (array) igj_site( 'service_area', array() ) ),
			'phone'       => igj_site( 'phone_display' ),
		),
		$map
	);
	$repl = array();
	foreach ( $map as $k => $v ) {
		$repl[ '{' . $k . '}' ] = (string) $v;
	}
	return strtr( (string) $text, $repl );
}

/**
 * URL field: root-relative paths (/about/) become site URLs.
 */
function igj_cms_url( $url ) {
	$url = trim( (string) $url );
	if ( '' === $url ) {
		return '';
	}
	if ( '/' === $url[0] && ( ! isset( $url[1] ) || '/' !== $url[1] ) ) {
		return home_url( $url );
	}
	return $url;
}

/**
 * Paragraph list → <p> elements (kses-filtered, {{phone}} tokens expanded).
 */
function igj_cms_paras( $paras, $class = '' ) {
	$html = '';
	foreach ( (array) $paras as $p ) {
		$html .= '<p' . ( $class ? ' class="' . esc_attr( $class ) . '"' : '' ) . '>' . wp_kses_post( igj_render( $p ) ) . '</p>';
	}
	return $html;
}

/* ---------- Site-wide facts (IGJ Site Info options page) ---------- */

/**
 * site.json with the IGJ Site Info overrides applied. igj_site() reads this, so header,
 * footer, templates and JSON-LD all see the same values.
 */
function igj_site_data() {
	static $data = null;
	if ( null !== $data ) {
		return $data;
	}
	$data = igj_data( 'site' );
	if ( ! function_exists( 'igj_cms_schema' ) ) {
		return $data;
	}
	foreach ( igj_cms_schema( 'site' ) as $section ) {
		foreach ( $section['fields'] as $f ) {
			if ( 'title' === $f['type'] ) {
				continue;
			}
			$v = igj_cms_resolve_field( $f, $f['id'], 'options' );
			if ( 'group' === $f['type'] && ! empty( $f['flatten'] ) ) {
				$v = array_values( array_filter( array_map( function ( $r ) use ( $f ) {
					return trim( (string) ( $r[ $f['flatten'] ] ?? '' ) );
				}, (array) $v ), 'strlen' ) );
			}
			if ( 'agents' === $f['id'] ) {
				$v = array_map( 'igj_cms_agent_row', (array) $v );
			}
			$data[ $f['id'] ] = $v;
		}
	}
	return $data;
}

/**
 * Team member row from the options page → the shape templates and schema expect.
 */
function igj_cms_agent_row( $r ) {
	$r = (array) $r;
	if ( empty( $r['id'] ) ) {
		$r['id'] = sanitize_title( $r['name'] ?? 'agent' );
	}
	$r['id']     = sanitize_title( $r['id'] );
	$r['states'] = is_array( $r['states'] ?? null ) ? $r['states'] : igj_cms_from_storage( array( 'type' => 'list' ), $r['states'] ?? '' );
	$r['photo']  = (string) ( $r['photo'] ?? '' );
	return $r;
}

/**
 * FAQ page questions grouped by consecutive Category (FAQ → 02). Used by the page and its JSON-LD.
 *
 * @return array [ [ 'group' => string, 'items' => [ [ 'q', 'a' ] ] ] ]
 */
function igj_faq_page_groups( $post_id = null ) {
	if ( ! $post_id ) {
		$page    = get_page_by_path( 'faq' );
		$post_id = ( is_page() && 'tpl_igj_faq.php' === get_page_template_slug( get_queried_object_id() ) ) ? get_queried_object_id() : ( $page ? $page->ID : 0 );
	}
	$items  = igj_section( 'faq', 'faq', $post_id )['items'] ?? array();
	$groups = array();
	foreach ( (array) $items as $it ) {
		if ( igj_cms_is_empty( $it['q'] ?? '' ) ) {
			continue;
		}
		$label = (string) ( $it['group'] ?? '' );
		$last  = count( $groups ) - 1;
		if ( $last < 0 || $groups[ $last ]['group'] !== $label ) {
			$groups[] = array( 'group' => $label, 'items' => array() );
			$last++;
		}
		$groups[ $last ]['items'][] = array( 'q' => $it['q'], 'a' => $it['a'] ?? '' );
	}
	return $groups;
}
