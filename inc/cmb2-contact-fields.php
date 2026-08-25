<?php
/**
 * CMB2 fields for the Contact template (tpl_contact.php).
 *
 * Registered against the "page" object type and limited to pages using the
 * "Contact" template. Address is split into discrete parts so the front end can
 * emit clean schema.org/PostalAddress microdata for SEO.
 *
 * Every field ships a default (see sp_contact_default / sp_contact_defaults) so
 * the admin boxes are pre-filled and the front end renders that copy until an
 * editor overrides it.
 *
 * @package pegasus-child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
 * Defaults — single source of truth for the metaboxes and the template.
 * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

/**
 * @return array Scalar-field defaults keyed by full meta key.
 */
function sp_contact_defaults() {
	return array(
		// Hero.
		'_sp_contact_hero_kicker' => 'say bonjour',
		'_sp_contact_hero_title'  => 'Come say <em>hello.</em>',
		'_sp_contact_hero_body'   => 'Questions, catering, or a big cake for a bigger occasion — we would love to hear from you. Here is how to reach the shop.',

		// Details.
		'_sp_contact_biz_name'    => 'Sugar Peddler',
		'_sp_contact_street'      => '3718 2nd Ave',
		'_sp_contact_locality'    => 'Columbus',
		'_sp_contact_region'      => 'GA',
		'_sp_contact_postal'      => '31901',
		'_sp_contact_phone'       => '706-330-3972',
		'_sp_contact_email'       => 'hello@sugarpeddler.com',
		'_sp_contact_map_url'     => '',
		'_sp_contact_map_embed'   => '',
		'_sp_contact_opening_hours_schema' => 'Mo-Fr 07:30-17:00',

		// Message form.
		'_sp_contact_form_kicker' => 'drop a line',
		'_sp_contact_form_title'  => 'Send us a <em>message.</em>',
		'_sp_contact_form_intro'  => 'Fill out the form and we will get back to you within a day or two.',
		'_sp_contact_gform_id'    => '',
	);
}

/**
 * @return array Default rows for the repeatable "hours" group.
 */
function sp_contact_hours_default() {
	return array(
		array(
			'label' => 'Mon &ndash; Fri',
			'value' => '7:30 &ndash; 5:00',
		),
		array(
			'label' => 'Saturday &amp; Sunday',
			'value' => 'Closed',
		),
	);
}

/**
 * @param string $key Full meta key.
 * @return string
 */
function sp_contact_default( $key ) {
	$defaults = sp_contact_defaults();
	return isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';
}

/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
 * Read helpers (template side)
 * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

/**
 * @param string $key Full meta key.
 * @return string Saved value, or the registered default when empty.
 */
function sp_contact_meta( $key ) {
	$val = get_post_meta( get_the_ID(), $key, true );
	return ( '' !== $val && null !== $val ) ? $val : sp_contact_default( $key );
}

/**
 * @param string $key     Full meta key.
 * @param array  $default Rows to return when nothing is saved.
 * @return array
 */
function sp_contact_group( $key, $default = array() ) {
	$val = get_post_meta( get_the_ID(), $key, true );
	return ( is_array( $val ) && ! empty( $val ) ) ? $val : $default;
}

/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
 * Metabox registration
 * ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */

add_action( 'cmb2_admin_init', 'sp_register_contact_metaboxes' );
function sp_register_contact_metaboxes() {

	$show_on = array( 'key' => 'page-template', 'value' => 'tpl_contact.php' );

	/* ── 1. Contact — Hero ───────────────────────────────────────────────── */
	$prefix = '_sp_contact_hero_';
	$cmb    = new_cmb2_box( array(
		'id'           => 'sp_contact_hero',
		'title'        => __( '1. Contact &mdash; Hero', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'show_on'      => $show_on,
		'context'      => 'normal',
		'priority'     => 'high',
		'closed'       => true,
	) );

	$cmb->add_field( array(
		'name'    => __( 'Eyebrow', 'pegasus-child' ),
		'desc'    => __( 'Small handwritten line above the headline.', 'pegasus-child' ),
		'id'      => $prefix . 'kicker',
		'type'    => 'text',
		'default' => sp_contact_default( $prefix . 'kicker' ),
	) );
	$cmb->add_field( array(
		'name'    => __( 'Headline', 'pegasus-child' ),
		'desc'    => __( 'HTML allowed. Use &lt;em&gt;...&lt;/em&gt; for the italic pink accent.', 'pegasus-child' ),
		'id'      => $prefix . 'title',
		'type'    => 'textarea_small',
		'default' => sp_contact_default( $prefix . 'title' ),
	) );
	$cmb->add_field( array(
		'name'    => __( 'Body copy', 'pegasus-child' ),
		'id'      => $prefix . 'body',
		'type'    => 'textarea',
		'default' => sp_contact_default( $prefix . 'body' ),
	) );

	/* ── 2. Contact — Details ────────────────────────────────────────────── */
	$prefix = '_sp_contact_';
	$cmb    = new_cmb2_box( array(
		'id'           => 'sp_contact_details',
		'title'        => __( '2. Contact &mdash; Details', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'show_on'      => $show_on,
		'context'      => 'normal',
		'priority'     => 'high',
		'closed'       => true,
	) );

	$cmb->add_field( array(
		'name'    => __( 'Business name', 'pegasus-child' ),
		'id'      => $prefix . 'biz_name',
		'type'    => 'text',
		'default' => sp_contact_default( $prefix . 'biz_name' ),
	) );
	$cmb->add_field( array(
		'name'    => __( 'Street address', 'pegasus-child' ),
		'desc'    => __( 'schema.org streetAddress.', 'pegasus-child' ),
		'id'      => $prefix . 'street',
		'type'    => 'text',
		'default' => sp_contact_default( $prefix . 'street' ),
	) );
	$cmb->add_field( array(
		'name'       => __( 'City', 'pegasus-child' ),
		'id'         => $prefix . 'locality',
		'type'       => 'text',
		'default'    => sp_contact_default( $prefix . 'locality' ),
		'attributes' => array( 'style' => 'max-width:16em;' ),
	) );
	$cmb->add_field( array(
		'name'       => __( 'State / region', 'pegasus-child' ),
		'id'         => $prefix . 'region',
		'type'       => 'text_small',
		'default'    => sp_contact_default( $prefix . 'region' ),
	) );
	$cmb->add_field( array(
		'name'       => __( 'ZIP / postal code', 'pegasus-child' ),
		'id'         => $prefix . 'postal',
		'type'       => 'text_small',
		'default'    => sp_contact_default( $prefix . 'postal' ),
	) );
	$cmb->add_field( array(
		'name'    => __( 'Phone', 'pegasus-child' ),
		'desc'    => __( 'Displayed as-is; a tel: click-to-call link is generated automatically.', 'pegasus-child' ),
		'id'      => $prefix . 'phone',
		'type'    => 'text',
		'default' => sp_contact_default( $prefix . 'phone' ),
	) );
	$cmb->add_field( array(
		'name'    => __( 'Email', 'pegasus-child' ),
		'desc'    => __( 'Rendered as a mailto: link. Update this to the real inbox.', 'pegasus-child' ),
		'id'      => $prefix . 'email',
		'type'    => 'text_email',
		'default' => sp_contact_default( $prefix . 'email' ),
	) );
	$cmb->add_field( array(
		'name'    => __( 'Directions / map link (optional)', 'pegasus-child' ),
		'desc'    => __( 'Where the “Get directions” link points. Leave empty to auto-build a Google Maps search from the address.', 'pegasus-child' ),
		'id'      => $prefix . 'map_url',
		'type'    => 'text_url',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Map embed (optional)', 'pegasus-child' ),
		'desc'    => __( 'Paste a Google Maps &lt;iframe&gt; embed to show a live map instead of the address placeholder.', 'pegasus-child' ),
		'id'      => $prefix . 'map_embed',
		'type'    => 'textarea_code',
	) );
	$cmb->add_field( array(
		'name'    => __( 'Opening hours (schema.org)', 'pegasus-child' ),
		'desc'    => __( 'Machine-readable hours for SEO, e.g. "Mo-Fr 07:30-17:00". Not shown on the page — used for the schema.org meta tag.', 'pegasus-child' ),
		'id'      => $prefix . 'opening_hours_schema',
		'type'    => 'text',
		'default' => sp_contact_default( $prefix . 'opening_hours_schema' ),
	) );

	$hours = $cmb->add_field( array(
		'id'          => $prefix . 'hours',
		'type'        => 'group',
		'description' => __( 'Human-readable hours shown on the page. Default: Mon–Fri 7:30–5:00, Sat &amp; Sun Closed.', 'pegasus-child' ),
		'options'     => array(
			'group_title'   => __( 'Row {#}', 'pegasus-child' ),
			'add_button'    => __( 'Add another row', 'pegasus-child' ),
			'remove_button' => __( 'Remove row', 'pegasus-child' ),
			'sortable'      => true,
			'closed'        => true,
		),
	) );
	$cmb->add_group_field( $hours, array(
		'name' => __( 'Day label', 'pegasus-child' ),
		'id'   => 'label',
		'type' => 'text',
	) );
	$cmb->add_group_field( $hours, array(
		'name' => __( 'Time', 'pegasus-child' ),
		'id'   => 'value',
		'type' => 'text',
	) );

	/* ── 3. Contact — Message Form (Gravity Forms) ───────────────────────── */
	$prefix = '_sp_contact_form_';
	$cmb    = new_cmb2_box( array(
		'id'           => 'sp_contact_form',
		'title'        => __( '3. Contact &mdash; Message Form', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'show_on'      => $show_on,
		'context'      => 'normal',
		'priority'     => 'high',
		'closed'       => true,
	) );

	$cmb->add_field( array(
		'name'    => __( 'Eyebrow', 'pegasus-child' ),
		'id'      => $prefix . 'kicker',
		'type'    => 'text',
		'default' => sp_contact_default( $prefix . 'kicker' ),
	) );
	$cmb->add_field( array(
		'name'    => __( 'Title', 'pegasus-child' ),
		'desc'    => __( 'HTML allowed. Use &lt;em&gt;...&lt;/em&gt; for the italic pink accent.', 'pegasus-child' ),
		'id'      => $prefix . 'title',
		'type'    => 'textarea_small',
		'default' => sp_contact_default( $prefix . 'title' ),
	) );
	$cmb->add_field( array(
		'name'    => __( 'Intro copy', 'pegasus-child' ),
		'id'      => $prefix . 'intro',
		'type'    => 'textarea',
		'default' => sp_contact_default( $prefix . 'intro' ),
	) );
	$cmb->add_field( array(
		'name'    => __( 'Gravity Forms form ID', 'pegasus-child' ),
		'desc'    => __( 'Numeric ID of the Gravity Form to embed (e.g. 1). Leave empty to show a placeholder with the email fallback. Requires the Gravity Forms plugin.', 'pegasus-child' ),
		'id'      => '_sp_contact_gform_id',
		'type'    => 'text_small',
		'attributes' => array( 'type' => 'number', 'pattern' => '\d*' ),
	) );
}
