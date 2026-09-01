<?php
/**
 * Make CMB2 meta-box edits register as unsaved changes in the block editor.
 *
 * In the block (Gutenberg) editor, changing a CMB2 field does NOT flip the
 * editor's "dirty" state. As a result the Update button can stay inactive and
 * the meta-box form is never submitted on save — the editor believes there is
 * nothing to save, so the field change is silently lost. This is why edits to
 * the Contact / Home / Menu CMB2 boxes appeared to "not update" the template.
 *
 * Fix: register a throwaway post-meta key and, whenever any CMB2 input changes,
 * dispatch editPost() on it. That marks the post dirty, activates Update, and
 * the standard save then persists every CMB2 box as expected.
 *
 * @package pegasus-child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * A harmless, editor-only meta key we can poke to flip the dirty state.
 * Registered for all post types so the fix applies to every CMB2 box.
 */
add_action( 'init', function () {
	register_post_meta( '', '_sp_cmb2_touch', array(
		'type'          => 'string',
		'single'        => true,
		'show_in_rest'  => true,
		'default'       => '',
		'auth_callback' => function () {
			return current_user_can( 'edit_posts' );
		},
	) );
} );

/**
 * Inline script in the block editor that watches CMB2 inputs and marks the post
 * as edited on change, so meta-box changes are saved with the post.
 */
add_action( 'enqueue_block_editor_assets', function () {
	wp_register_script( 'sp-cmb2-dirty', '', array( 'wp-data', 'wp-dom-ready' ), null, true );
	wp_enqueue_script( 'sp-cmb2-dirty' );
	wp_add_inline_script(
		'sp-cmb2-dirty',
		<<<'JS'
( function ( wp ) {
	if ( ! wp || ! wp.domReady || ! wp.data ) { return; }
	wp.domReady( function () {
		var mark = function () {
			try {
				wp.data.dispatch( 'core/editor' ).editPost( { meta: { _sp_cmb2_touch: String( Date.now() ) } } );
			} catch ( e ) {}
		};
		var handler = function ( e ) {
			var t = e.target;
			if ( t && t.closest && t.closest( '.cmb2-postbox, .cmb2-wrap' ) ) { mark(); }
		};
		// Capture phase so we still see the event if CMB2 stops propagation.
		document.addEventListener( 'change', handler, true );
		document.addEventListener( 'input', handler, true );
	} );
} )( window.wp );
JS
	);
} );
