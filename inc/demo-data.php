<?php
/**
 * Shared loader for the plugin data in inc/demo-content.json.
 *
 * Both the Demo template (full showcase) and the Home template (summary grid)
 * read from this single source, so enabling/hiding a plugin in the JSON updates
 * both pages.
 *
 * Visibility flag:
 *   - "hidden": true → the section is hidden everywhere (the demo showcase, the
 *                      home-page plugin grid, and the dot-nav). Omit it (or set
 *                      it false) to show the section.
 *
 * @package Pegasus_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Load and decode the demo content JSON (cached per request).
 *
 * @return array Data with a 'sections' array (empty on failure).
 */
function pegasus_demo_load_data() {
	static $data = null;
	if ( null !== $data ) {
		return $data;
	}

	$data = array( 'sections' => array() );
	$file = get_stylesheet_directory() . '/inc/demo-content.json';

	if ( is_readable( $file ) ) {
		$decoded = json_decode( file_get_contents( $file ), true );
		if ( is_array( $decoded ) && ! empty( $decoded['sections'] ) ) {
			$data = $decoded;
		}
	}

	return $data;
}

/**
 * Sections that are not hidden. Used everywhere content is listed (the demo
 * page and, filtered to plugins, the home-page grid).
 *
 * @return array
 */
function pegasus_demo_visible_sections() {
	$out = array();
	foreach ( pegasus_demo_load_data()['sections'] as $section ) {
		if ( ! empty( $section['hidden'] ) ) {
			continue;
		}
		$out[] = $section;
	}
	return $out;
}

/**
 * Visible plugin sections for the HOME page summary grid (not hidden).
 *
 * @return array
 */
function pegasus_demo_visible_plugins() {
	$out = array();
	foreach ( pegasus_demo_visible_sections() as $section ) {
		if ( isset( $section['type'] ) && 'plugin' === $section['type'] ) {
			$out[] = $section;
		}
	}
	return $out;
}

/**
 * Best link for a plugin summary card: its "example page" (secondary) button,
 * else the first button, else empty.
 *
 * @param array $section Plugin section.
 * @return string
 */
function pegasus_demo_plugin_link( $section ) {
	if ( empty( $section['buttons'] ) || ! is_array( $section['buttons'] ) ) {
		return '';
	}
	foreach ( $section['buttons'] as $btn ) {
		if ( isset( $btn['style'] ) && 'secondary' === $btn['style'] && ! empty( $btn['url'] ) ) {
			return $btn['url'];
		}
	}
	return ! empty( $section['buttons'][0]['url'] ) ? $section['buttons'][0]['url'] : '';
}
