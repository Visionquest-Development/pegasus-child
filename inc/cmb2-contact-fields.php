<?php
/**
 * CMB2 fields + defaults + form handler for the Contact template ( tpl_contact.php ).
 *
 * There is no Contact design file in the project, so this page is built in the
 * established .rcd-home design language. Page copy, the studio-details rows and
 * the social links are CMB2 post meta on the Contact page. The contact form is a
 * self-contained wp_mail() handler ( no plugin required ); a form-plugin
 * shortcode can be supplied to override it.
 *
 * Shares the generic render helpers ( rcd_home_row, rcd_home_row_has_content )
 * defined in inc/cmb2-home-fields.php.
 *
 * @package Pegasus_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* ============================================================================
 * DEFAULTS
 * ========================================================================== */
if ( ! function_exists( 'rcd_contact_defaults' ) ) {
	/**
	 * Default content for the contact page.
	 *
	 * @return array
	 */
	function rcd_contact_defaults() {
		return array(

			// Intro.
			'intro_eyebrow' => 'Get in Touch',
			'intro_heading' => 'Begin your <em>commission</em>.',
			'intro_text'    => "Tell us about your space — a single room, a full transformation, or a one-of-a-kind restored piece — and we'll be in touch shortly.",

			// Form.
			'form_heading'      => 'Send a note',
			'form_button_text'  => 'Send message',
			'form_success_text' => "Thank you — your note is on its way. We'll be in touch soon.",
			'form_error_text'   => 'Sorry, something went wrong. Please email us directly at hello@renecatherinedesigns.com.',
			'recipient_email'   => 'hello@renecatherinedesigns.com',
			'form_shortcode'    => '',

			// Details.
			'details_eyebrow' => 'The Studio',
			'details_heading' => 'By appointment · Atlanta',
			'details'         => array(
				array( 'label' => 'Email', 'value' => 'hello@renecatherinedesigns.com', 'url' => 'mailto:hello@renecatherinedesigns.com' ),
				array( 'label' => 'Studio', 'value' => 'Atlanta, GA — by appointment', 'url' => '' ),
				array( 'label' => 'Hours', 'value' => 'Mon–Fri · by appointment', 'url' => '' ),
			),
			'socials'         => array(
				array( 'label' => 'Instagram', 'url' => '#' ),
				array( 'label' => 'Pinterest', 'url' => '#' ),
			),
		);
	}
}

/* ============================================================================
 * METABOX REGISTRATION
 * ========================================================================== */
add_action( 'cmb2_admin_init', 'rcd_contact_register_metaboxes' );
/**
 * Register the contact-page metaboxes. Collapsed by default, shown only on
 * pages using tpl_contact.php.
 */
function rcd_contact_register_metaboxes() {

	if ( ! function_exists( 'new_cmb2_box' ) ) {
		return;
	}

	$prefix = 'rcd_con_';
	$d      = rcd_contact_defaults();

	$box_args = array(
		'object_types' => array( 'page' ),
		'context'      => 'normal',
		'priority'     => 'high',
		'closed'       => true,
		'show_on_cb'   => 'rcd_contact_show_for_template',
	);

	$group_opts = array(
		'closed'   => true,
		'sortable' => true,
	);

	/* Intro */
	$intro = new_cmb2_box( array_merge( $box_args, array(
		'id'    => $prefix . 'intro_box',
		'title' => __( 'Contact — Intro', 'pegasus-child' ),
	) ) );
	$intro->add_field( array(
		'name'    => __( 'Eyebrow', 'pegasus-child' ),
		'id'      => $prefix . 'intro_eyebrow',
		'type'    => 'text',
		'default' => $d['intro_eyebrow'],
	) );
	$intro->add_field( array(
		'name'    => __( 'Heading', 'pegasus-child' ),
		'desc'    => __( 'Basic HTML allowed ( &lt;br&gt;, &lt;em&gt; ).', 'pegasus-child' ),
		'id'      => $prefix . 'intro_heading',
		'type'    => 'textarea_small',
		'default' => $d['intro_heading'],
	) );
	$intro->add_field( array(
		'name'    => __( 'Intro text', 'pegasus-child' ),
		'id'      => $prefix . 'intro_text',
		'type'    => 'textarea',
		'default' => $d['intro_text'],
	) );

	/* Form */
	$form = new_cmb2_box( array_merge( $box_args, array(
		'id'    => $prefix . 'form_box',
		'title' => __( 'Contact — Form', 'pegasus-child' ),
	) ) );
	$form->add_field( array(
		'name'    => __( 'Form heading', 'pegasus-child' ),
		'id'      => $prefix . 'form_heading',
		'type'    => 'text',
		'default' => $d['form_heading'],
	) );
	$form->add_field( array(
		'name'    => __( 'Send-to email', 'pegasus-child' ),
		'desc'    => __( 'Where the built-in contact form delivers messages.', 'pegasus-child' ),
		'id'      => $prefix . 'recipient_email',
		'type'    => 'text_email',
		'default' => $d['recipient_email'],
	) );
	$form->add_field( array(
		'name'    => __( 'Submit button text', 'pegasus-child' ),
		'id'      => $prefix . 'form_button_text',
		'type'    => 'text',
		'default' => $d['form_button_text'],
	) );
	$form->add_field( array(
		'name'    => __( 'Success message', 'pegasus-child' ),
		'id'      => $prefix . 'form_success_text',
		'type'    => 'textarea_small',
		'default' => $d['form_success_text'],
	) );
	$form->add_field( array(
		'name'    => __( 'Error message', 'pegasus-child' ),
		'id'      => $prefix . 'form_error_text',
		'type'    => 'textarea_small',
		'default' => $d['form_error_text'],
	) );
	$form->add_field( array(
		'name' => __( 'Form shortcode ( optional )', 'pegasus-child' ),
		'desc' => __( 'Paste a form-plugin shortcode ( e.g. Contact Form 7 ) to replace the built-in form.', 'pegasus-child' ),
		'id'   => $prefix . 'form_shortcode',
		'type' => 'text',
	) );

	/* Details */
	$details = new_cmb2_box( array_merge( $box_args, array(
		'id'    => $prefix . 'details_box',
		'title' => __( 'Contact — Studio Details', 'pegasus-child' ),
	) ) );
	$details->add_field( array(
		'name'    => __( 'Eyebrow', 'pegasus-child' ),
		'id'      => $prefix . 'details_eyebrow',
		'type'    => 'text',
		'default' => $d['details_eyebrow'],
	) );
	$details->add_field( array(
		'name'    => __( 'Heading', 'pegasus-child' ),
		'id'      => $prefix . 'details_heading',
		'type'    => 'text',
		'default' => $d['details_heading'],
	) );
	$detail_group = $details->add_field( array(
		'id'      => $prefix . 'details',
		'type'    => 'group',
		'options' => array_merge( $group_opts, array(
			'group_title'   => __( 'Detail {#}', 'pegasus-child' ),
			'add_button'    => __( 'Add Detail', 'pegasus-child' ),
			'remove_button' => __( 'Remove Detail', 'pegasus-child' ),
		) ),
	) );
	$details->add_group_field( $detail_group, array(
		'name' => __( 'Label', 'pegasus-child' ),
		'id'   => 'label',
		'type' => 'text',
	) );
	$details->add_group_field( $detail_group, array(
		'name' => __( 'Value', 'pegasus-child' ),
		'id'   => 'value',
		'type' => 'text',
	) );
	$details->add_group_field( $detail_group, array(
		'name' => __( 'Link ( optional )', 'pegasus-child' ),
		'id'   => 'url',
		'type' => 'text',
	) );
	$social_group = $details->add_field( array(
		'id'      => $prefix . 'socials',
		'type'    => 'group',
		'options' => array_merge( $group_opts, array(
			'group_title'   => __( 'Social {#}', 'pegasus-child' ),
			'add_button'    => __( 'Add Social', 'pegasus-child' ),
			'remove_button' => __( 'Remove Social', 'pegasus-child' ),
		) ),
	) );
	$details->add_group_field( $social_group, array(
		'name' => __( 'Label', 'pegasus-child' ),
		'id'   => 'label',
		'type' => 'text',
	) );
	$details->add_group_field( $social_group, array(
		'name' => __( 'URL', 'pegasus-child' ),
		'id'   => 'url',
		'type' => 'text',
	) );
}

/**
 * show_on_cb: only display on pages using tpl_contact.php.
 *
 * @param object $cmb CMB2 instance.
 * @return bool
 */
function rcd_contact_show_for_template( $cmb ) {
	$post_id = 0;

	if ( isset( $_GET['post'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification
		$post_id = absint( $_GET['post'] );
	} elseif ( isset( $_POST['post_ID'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification
		$post_id = absint( $_POST['post_ID'] );
	}

	if ( ! $post_id ) {
		return false;
	}

	return ( 'tpl_contact.php' === get_post_meta( $post_id, '_wp_page_template', true ) );
}

/* ============================================================================
 * TEMPLATE HELPERS
 * ========================================================================== */

if ( ! function_exists( 'rcd_con_field' ) ) {
	/**
	 * Get a single contact field, falling back to the default.
	 *
	 * @param string $key     Field key without the rcd_con_ prefix.
	 * @param int    $post_id Optional post ID.
	 * @return mixed
	 */
	function rcd_con_field( $key, $post_id = 0 ) {
		$post_id = $post_id ? $post_id : get_the_ID();
		$value   = get_post_meta( $post_id, 'rcd_con_' . $key, true );

		if ( '' === $value || null === $value || false === $value ) {
			$defaults = rcd_contact_defaults();
			return isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';
		}

		return $value;
	}
}

if ( ! function_exists( 'rcd_con_rows' ) ) {
	/**
	 * Get repeatable group rows ( rcd_con_ prefix ), discarding empty rows and
	 * falling back to defaults when nothing real is saved.
	 *
	 * @param string $key     Group key without the rcd_con_ prefix.
	 * @param int    $post_id Optional post ID.
	 * @return array
	 */
	function rcd_con_rows( $key, $post_id = 0 ) {
		$post_id = $post_id ? $post_id : get_the_ID();
		$rows    = get_post_meta( $post_id, 'rcd_con_' . $key, true );
		$clean   = array();

		if ( is_array( $rows ) ) {
			foreach ( $rows as $row ) {
				if ( rcd_home_row_has_content( $row ) ) {
					$clean[] = $row;
				}
			}
		}

		if ( empty( $clean ) ) {
			$defaults = rcd_contact_defaults();
			return isset( $defaults[ $key ] ) ? $defaults[ $key ] : array();
		}

		return $clean;
	}
}

/* ============================================================================
 * BUILT-IN FORM HANDLER ( admin-post.php, no plugin required )
 * ========================================================================== */
add_action( 'admin_post_nopriv_rcd_contact_submit', 'rcd_contact_handle_submit' );
add_action( 'admin_post_rcd_contact_submit', 'rcd_contact_handle_submit' );
/**
 * Validate + email a contact-form submission, then redirect back to the page
 * with a status flag ( ?rcd_contact=sent|error ).
 */
function rcd_contact_handle_submit() {

	$page_id  = isset( $_POST['rcd_page_id'] ) ? absint( $_POST['rcd_page_id'] ) : 0;
	$redirect = $page_id ? get_permalink( $page_id ) : wp_get_referer();
	if ( ! $redirect ) {
		$redirect = home_url( '/' );
	}

	$fail = add_query_arg( 'rcd_contact', 'error', $redirect ) . '#contact-form';
	$done = add_query_arg( 'rcd_contact', 'sent', $redirect ) . '#contact-form';

	// Nonce.
	if ( ! isset( $_POST['rcd_contact_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['rcd_contact_nonce'] ) ), 'rcd_contact' ) ) {
		wp_safe_redirect( $fail );
		exit;
	}

	// Honeypot — silently accept ( pretend success ) so bots don't retry.
	if ( ! empty( $_POST['rcd_website'] ) ) {
		wp_safe_redirect( $done );
		exit;
	}

	$name    = isset( $_POST['rcd_name'] ) ? sanitize_text_field( wp_unslash( $_POST['rcd_name'] ) ) : '';
	$email   = isset( $_POST['rcd_email'] ) ? sanitize_email( wp_unslash( $_POST['rcd_email'] ) ) : '';
	$message = isset( $_POST['rcd_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['rcd_message'] ) ) : '';

	if ( '' === $name || ! is_email( $email ) || '' === $message ) {
		wp_safe_redirect( $fail );
		exit;
	}

	$defaults  = rcd_contact_defaults();
	$recipient = $page_id ? get_post_meta( $page_id, 'rcd_con_recipient_email', true ) : '';
	if ( ! is_email( $recipient ) ) {
		$recipient = $defaults['recipient_email'];
	}

	$subject = sprintf( '%s — website enquiry from %s', wp_specialchars_decode( get_bloginfo( 'name' ) ), $name );
	$body    = "Name: {$name}\nEmail: {$email}\n\n{$message}\n";
	$headers = array( 'Reply-To: ' . $name . ' <' . $email . '>' );

	$sent = wp_mail( $recipient, $subject, $body, $headers );

	wp_safe_redirect( $sent ? $done : $fail );
	exit;
}
