<?php
/**
 * Rice Capital Fund — Contact form submission handler.
 *
 * Handles posts from the native form in tpl_contact.php. Wired to
 * admin-post.php so it works with no third-party form plugin. If an
 * editor pastes a form shortcode into the "Form Shortcode" field on the
 * Contact page, that plugin handles submission instead and this never fires.
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Redirect back to the referring page with a status flag + anchor.
 *
 * @param string $status 'success' | 'error'
 */
function rcf_contact_redirect( $status ) {
	$base = wp_get_referer() ? wp_get_referer() : home_url( '/' );
	$base = remove_query_arg( 'rcf_sent', $base );
	$url  = add_query_arg( 'rcf_sent', $status, $base ) . '#contact-form';
	wp_safe_redirect( $url );
	exit;
}

/**
 * Process the contact form submission.
 */
function rcf_handle_contact_submit() {
	// Honeypot — silently treat bots as "success" so they don't retry.
	if ( ! empty( $_POST['rcf_hp'] ) ) {
		rcf_contact_redirect( 'success' );
	}

	// Nonce.
	if ( empty( $_POST['rcf_contact_nonce'] )
		|| ! wp_verify_nonce( wp_unslash( $_POST['rcf_contact_nonce'] ), 'rcf_contact_submit' ) ) {
		rcf_contact_redirect( 'error' );
	}

	$name    = isset( $_POST['rcf_name'] )    ? sanitize_text_field( wp_unslash( $_POST['rcf_name'] ) )    : '';
	$email   = isset( $_POST['rcf_email'] )   ? sanitize_email( wp_unslash( $_POST['rcf_email'] ) )        : '';
	$firm    = isset( $_POST['rcf_firm'] )    ? sanitize_text_field( wp_unslash( $_POST['rcf_firm'] ) )    : '';
	$phone   = isset( $_POST['rcf_phone'] )   ? sanitize_text_field( wp_unslash( $_POST['rcf_phone'] ) )   : '';
	$type    = isset( $_POST['rcf_type'] )    ? sanitize_text_field( wp_unslash( $_POST['rcf_type'] ) )    : '';
	$message = isset( $_POST['rcf_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['rcf_message'] ) ) : '';

	// Required fields.
	if ( '' === $name || '' === $message || ! is_email( $email ) ) {
		rcf_contact_redirect( 'error' );
	}

	// Recipient: use the posted value only if it is a valid address, else fall
	// back to the site admin email. Prevents tampering into an arbitrary target.
	$recipient = isset( $_POST['rcf_recipient'] ) ? sanitize_email( wp_unslash( $_POST['rcf_recipient'] ) ) : '';
	if ( ! is_email( $recipient ) ) {
		$recipient = get_option( 'admin_email' );
	}
	$recipient = apply_filters( 'rcf_contact_recipient', $recipient );

	$subject = sprintf(
		/* translators: %s: sender name */
		__( 'Website contact — %s', 'pegasus-child' ),
		$name
	);

	$lines = array(
		__( 'New contact enquiry from the Rice Capital Fund website:', 'pegasus-child' ),
		'',
		sprintf( 'Name:      %s', $name ),
		sprintf( 'Email:     %s', $email ),
		sprintf( 'Firm:      %s', $firm !== '' ? $firm : '—' ),
		sprintf( 'Phone:     %s', $phone !== '' ? $phone : '—' ),
		sprintf( 'Category:  %s', $type !== '' ? $type : '—' ),
		'',
		__( 'Message:', 'pegasus-child' ),
		$message,
	);
	$body = implode( "\n", $lines );

	$headers = array(
		'Content-Type: text/plain; charset=UTF-8',
		sprintf( 'Reply-To: %s <%s>', $name, $email ),
	);

	$sent = wp_mail( $recipient, $subject, $body, $headers );

	rcf_contact_redirect( $sent ? 'success' : 'error' );
}
add_action( 'admin_post_nopriv_rcf_contact_submit', 'rcf_handle_contact_submit' );
add_action( 'admin_post_rcf_contact_submit', 'rcf_handle_contact_submit' );
