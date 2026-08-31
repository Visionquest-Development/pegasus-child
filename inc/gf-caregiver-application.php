<?php
/**
 * Valor Care — Caregiver Application (Gravity Form) sync.
 *
 * The canonical field set for the Caregiver Application lives alongside the
 * theme in inc/gravity-forms/caregiver-application.json. That file was built to
 * match the agency's Word application (Caregiver_Application.docx) and exported
 * from Gravity Form ID 2, so the whole form is version-controlled with the theme.
 *
 * On a site where the bundled version is newer than what was last synced, the
 * form is (re)imported into Gravity Forms. The sync is gated on
 * VALORCARE_CAREGIVER_FORM_VERSION, so it never rewrites the live form on every
 * request — bump that constant to intentionally push field changes. Existing
 * notifications and confirmations on the live form are preserved.
 *
 * @package Pegasus_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'VALORCARE_CAREGIVER_FORM_ID' ) ) {
	define( 'VALORCARE_CAREGIVER_FORM_ID', 2 );
}
if ( ! defined( 'VALORCARE_CAREGIVER_FORM_VERSION' ) ) {
	// Bump this when caregiver-application.json changes to trigger a re-sync.
	define( 'VALORCARE_CAREGIVER_FORM_VERSION', '2026.08.31' );
}

/**
 * Path to the bundled Caregiver Application form definition.
 *
 * @return string
 */
function valorcare_caregiver_form_json_path() {
	return get_stylesheet_directory() . '/inc/gravity-forms/caregiver-application.json';
}

/**
 * Import / update the Caregiver Application form from the bundled JSON when the
 * bundled version is newer than the last synced version.
 */
function valorcare_sync_caregiver_form() {
	if ( ! class_exists( 'GFAPI' ) ) {
		return;
	}

	if ( VALORCARE_CAREGIVER_FORM_VERSION === get_option( 'valorcare_caregiver_form_version' ) ) {
		return;
	}

	$path = valorcare_caregiver_form_json_path();
	if ( ! is_readable( $path ) ) {
		return;
	}

	$form = json_decode( file_get_contents( $path ), true );
	if ( ! is_array( $form ) || empty( $form['fields'] ) ) {
		return;
	}

	$target   = (int) VALORCARE_CAREGIVER_FORM_ID;
	$existing = $target ? GFAPI::get_form( $target ) : false;

	if ( $existing ) {
		$form['id'] = $target;
		// Never clobber the live form's notifications / confirmations.
		if ( ! empty( $existing['notifications'] ) ) {
			$form['notifications'] = $existing['notifications'];
		}
		if ( ! empty( $existing['confirmations'] ) ) {
			$form['confirmations'] = $existing['confirmations'];
		}
		$result = GFAPI::update_form( $form );
	} else {
		unset( $form['id'] );
		$result = GFAPI::add_form( $form );
	}

	if ( ! is_wp_error( $result ) ) {
		update_option( 'valorcare_caregiver_form_version', VALORCARE_CAREGIVER_FORM_VERSION );
	}
}
add_action( 'admin_init', 'valorcare_sync_caregiver_form' );
