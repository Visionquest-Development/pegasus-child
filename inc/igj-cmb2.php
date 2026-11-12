<?php
/**
 * Insurance Guy Joe — CMB2 admin fields for every IGJ page template + "IGJ Site Info".
 *
 * CMB2 is bundled with the Pegasus parent theme (pegasus/inc/cmb2, loaded by its functions.php).
 * Boxes and fields are generated from the registry in inc/igj-content-defaults.php, so the
 * admin defaults and the frontend defaults can never drift apart.
 *
 * - One box per section, numbered in page order ("01 — Hero"), collapsed by default, shown
 *   only on pages using that template (Home also shows on the front page).
 * - Repeatable groups are collapsed and sortable; only the FIRST default item is prefilled.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'cmb2_admin_init', 'igj_cmb2_register' );

/* ---------- Sanitizers ---------- */

function igj_cms_sanitize_html( $value ) {
	return is_string( $value ) ? trim( wp_kses_post( $value ) ) : $value;
}

/**
 * Links: allow site paths (/about/), #anchors, tel:, mailto: and full URLs.
 */
function igj_cms_sanitize_url( $value ) {
	$value = trim( (string) $value );
	if ( '' === $value ) {
		return '';
	}
	if ( '/' === $value[0] || '#' === $value[0] ) {
		return preg_replace( '#[^A-Za-z0-9/_\-\.\#\?=&%~]#', '', $value );
	}
	return esc_url_raw( $value, array( 'http', 'https', 'tel', 'mailto' ) );
}

/* ---------- Field conversion ---------- */

/**
 * Registry field → CMB2 field args. $prefill: false for group sub-fields (no per-field
 * defaults there; the first row is prefilled through igj_cmb2_prefill_group()).
 */
function igj_cmb2_field_args( $f, $id, $prefill = true ) {
	$a = array(
		'id'   => $id,
		'name' => $f['name'],
	);
	switch ( $f['type'] ) {
		case 'textarea':
			$a['type']            = 'textarea';
			$a['attributes']      = array( 'rows' => 3 );
			$a['sanitization_cb'] = 'igj_cms_sanitize_html';
			break;
		case 'paras':
		case 'list':
			$a['type']            = 'textarea';
			$a['attributes']      = array( 'rows' => 'paras' === $f['type'] ? 8 : 6 );
			$a['sanitization_cb'] = 'igj_cms_sanitize_html';
			break;
		case 'url':
			$a['type']            = 'text';
			$a['sanitization_cb'] = 'igj_cms_sanitize_url';
			$a['desc']            = 'A page path like /about/ or a full https:// link.';
			break;
		case 'image':
			$a['type']         = 'file';
			$a['options']      = array( 'url' => true );
			$a['text']         = array( 'add_upload_file_text' => 'Choose image' );
			$a['query_args']   = array( 'type' => array( 'image/jpeg', 'image/png', 'image/webp' ) );
			$a['preview_size'] = 'medium';
			$a['desc']         = 'Leave empty to use the built-in photo. Uploaded photos use the alt text set in the Media Library.';
			break;
		case 'select':
			$a['type']             = 'select';
			$a['options_cb']       = $f['options_cb'];
			$a['show_option_none'] = '— Choose —';
			break;
		case 'multicheck':
			$a['type']              = 'multicheck';
			$a['options_cb']        = $f['options_cb'];
			$a['select_all_button'] = false;
			break;
		case 'title':
			$a['type'] = 'title';
			break;
		default:
			$a['type'] = 'text';
	}
	if ( ! empty( $f['desc'] ) ) {
		$a['desc'] = $f['desc'];
	}
	if ( $prefill && isset( $f['default'] ) && '' !== $f['default'] && array() !== $f['default'] ) {
		$a['default'] = igj_cms_to_storage( $f, $f['default'] );
	}
	return $a;
}

/**
 * Add one registry field (scalar or repeatable group) to a CMB2 box.
 */
function igj_cmb2_add_field( $cmb, $f, $id ) {
	if ( 'group' !== $f['type'] ) {
		$cmb->add_field( igj_cmb2_field_args( $f, $id ) );
		return;
	}
	$item = $f['item'];
	$gid  = $cmb->add_field(
		array(
			'id'          => $id,
			'type'        => 'group',
			'name'        => $f['name'],
			'description' => 'Click a row to open it. The first item is pre-filled with the current website content; the rest of the current list keeps showing on the site until you change that first item or add more. Once you do, the site shows exactly the items saved here.',
			'repeatable'  => true,
			'options'     => array(
				'group_title'   => $item . ' {#}',
				'add_button'    => 'Add ' . $item,
				'remove_button' => 'Remove ' . $item,
				'sortable'      => true,
				'closed'        => true,
			),
		)
	);
	foreach ( $f['fields'] as $sf ) {
		$cmb->add_group_field( $gid, igj_cmb2_field_args( $sf, $sf['id'], false ) );
	}
	$defaults = igj_cms_group_storage_defaults( $f );
	if ( $defaults ) {
		$GLOBALS['igj_cmb2_group_prefill'][ $id ] = $defaults[0];
	}
}

/**
 * Prefill ONLY the first item of a repeatable group while nothing has been saved yet.
 */
function igj_cmb2_prefill_group( $value, $object_id, $a ) {
	if ( 'cmb2_field_no_override_val' !== $value || empty( $a['field_id'] ) ) {
		return $value;
	}
	$map = $GLOBALS['igj_cmb2_group_prefill'] ?? array();
	if ( ! isset( $map[ $a['field_id'] ] ) ) {
		return $value;
	}
	if ( 'options-page' === ( $a['type'] ?? '' ) ) {
		$opt = get_option( $object_id, array() );
		if ( is_array( $opt ) && array_key_exists( $a['field_id'], $opt ) ) {
			return $value;
		}
	} elseif ( metadata_exists( 'post', (int) $object_id, $a['field_id'] ) ) {
		return $value;
	}
	return array( $map[ $a['field_id'] ] );
}
add_filter( 'cmb2_override_meta_value', 'igj_cmb2_prefill_group', 10, 3 );

/* ---------- Registration ---------- */

/**
 * Show a template's boxes only on pages using that template (Home: also the front page).
 */
function igj_cmb2_show_on( $cmb ) {
	$id   = (int) $cmb->object_id();
	$tpl  = (string) $cmb->prop( 'igj_tpl' );
	$all  = igj_cms_templates();
	if ( ! $id || empty( $all[ $tpl ] ) ) {
		return false;
	}
	if ( 'home' === $tpl && (int) get_option( 'page_on_front' ) === $id ) {
		return true;
	}
	return get_page_template_slug( $id ) === $all[ $tpl ]['file'];
}

function igj_cmb2_register() {
	if ( ! function_exists( 'new_cmb2_box' ) ) {
		return;
	}
	// phpcs:disable WordPress.Security.NonceVerification -- read-only: which page is being edited/saved.
	$post_id = isset( $_GET['post'] ) ? absint( $_GET['post'] ) : ( isset( $_POST['post_ID'] ) ? absint( $_POST['post_ID'] ) : 0 );
	// phpcs:enable

	foreach ( igj_cms_templates() as $tpl => $info ) {
		$n = 0;
		foreach ( igj_cms_schema( $tpl, $post_id ) as $sec_id => $sec ) {
			$n++;
			$cmb = new_cmb2_box(
				array(
					'id'           => 'igj_' . $tpl . '_' . $sec_id . '_box',
					'title'        => sprintf( '%02d — %s', $n, $sec['title'] ),
					'object_types' => array( 'page' ),
					'context'      => 'normal',
					'priority'     => 'high',
					'closed'       => true,
					'show_names'   => true,
					'show_on_cb'   => 'igj_cmb2_show_on',
					'igj_tpl'      => $tpl,
					'classes'      => 'igj-cms-box',
				)
			);
			if ( ! empty( $sec['desc'] ) ) {
				$cmb->add_field( array( 'id' => 'igj_' . $tpl . '_' . $sec_id . '__note', 'type' => 'title', 'name' => '', 'desc' => $sec['desc'] ) );
			}
			foreach ( $sec['fields'] as $f ) {
				igj_cmb2_add_field( $cmb, $f, igj_cms_key( $tpl, $sec_id, $f['id'] ) );
			}
		}
	}

	/* IGJ Site Info: site-wide facts (header, footer, schema, every page). */
	$opt = new_cmb2_box(
		array(
			'id'           => 'igj_site_info_box',
			'title'        => 'IGJ Site Info',
			'object_types' => array( 'options-page' ),
			'option_key'   => IGJ_SITE_OPTION,
			'icon_url'     => 'dashicons-id-alt',
			'position'     => 58,
			'capability'   => 'edit_pages',
			'save_button'  => 'Save Site Info',
			'message_cb'   => 'igj_cmb2_options_message',
		)
	);
	$n = 0;
	foreach ( igj_cms_schema( 'site' ) as $sec_id => $sec ) {
		$n++;
		$opt->add_field(
			array(
				'id'   => 'igj_site_' . $sec_id . '__title',
				'type' => 'title',
				'name' => sprintf( '%02d — %s', $n, $sec['title'] ),
				'desc' => $sec['desc'] ?? '',
			)
		);
		foreach ( $sec['fields'] as $f ) {
			igj_cmb2_add_field( $opt, $f, $f['id'] );
		}
	}
}

function igj_cmb2_options_message( $cmb, $args ) {
	if ( ! empty( $args['should_notify'] ) ) {
		add_settings_error( $args['setting'], $args['code'], $args['is_updated'] ? 'Site Info saved.' : 'Nothing changed.', 'updated' );
	}
}

/* Numbered boxes: keep them in page order and visually grouped. */
add_action( 'admin_head-post.php', 'igj_cmb2_admin_css' );
add_action( 'admin_head-post-new.php', 'igj_cmb2_admin_css' );
function igj_cmb2_admin_css() {
	echo '<style>.igj-cms-box .hndle,.igj-cms-box .postbox-header h2{font-weight:600}.igj-cms-box .cmb2-wrap .cmb-type-title .cmb2-metabox-description{font-size:13px;color:#50575e}.igj-cms-box textarea{width:100%}</style>';
}
