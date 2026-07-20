<?php
/**
 * Loader for the documentation content in inc/docs-content.json.
 *
 * Shared by the Documentation template (tpl_docs.php, full page) and the
 * home-page Docs section (preview list). Hiding a section in the JSON
 * (`"hidden": true`) removes it from both places, mirroring the demo data.
 *
 * @package Pegasus_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Load and decode the docs content JSON (cached per request).
 *
 * @return array Data with a 'sections' array (empty on failure).
 */
function pegasus_docs_load_data() {
	static $data = null;
	if ( null !== $data ) {
		return $data;
	}

	$data = array( 'sections' => array() );
	$file = get_stylesheet_directory() . '/inc/docs-content.json';

	if ( is_readable( $file ) ) {
		$decoded = json_decode( file_get_contents( $file ), true );
		if ( is_array( $decoded ) && ! empty( $decoded['sections'] ) ) {
			$data = $decoded;
		}
	}

	return $data;
}

/**
 * Documentation sections that are not hidden.
 *
 * @return array
 */
function pegasus_docs_sections() {
	$out = array();
	foreach ( pegasus_docs_load_data()['sections'] as $section ) {
		if ( ! empty( $section['hidden'] ) ) {
			continue;
		}
		$out[] = $section;
	}
	return $out;
}

/**
 * Link to a docs section on the Documentation page (e.g. /documentation/#header-options).
 * Falls back to a bare "#id" anchor when the docs page isn't found.
 *
 * @param string $section_id Section id.
 * @return string
 */
function pegasus_docs_section_link( $section_id ) {
	$base = function_exists( 'pegasus_docs_page_url' ) ? pegasus_docs_page_url() : '';
	if ( $base && $section_id ) {
		return $base . '#' . $section_id;
	}
	return $section_id ? '#' . $section_id : '#';
}
