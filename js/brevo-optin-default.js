/**
 * Pre-tick the Brevo newsletter opt-in checkbox at WooCommerce checkout.
 *
 * The Brevo for WooCommerce plugin has no "checked by default" setting, so we
 * force #ws_opt_in on. The visitor can still uncheck it to opt out; once they
 * touch it we never re-check it against their wishes (we only react to real,
 * user-generated events via isTrusted, not to our own programmatic change).
 */
(function () {
	'use strict';

	var FIELD = '#ws_opt_in';
	var userTouched = false;

	function preTick() {
		if ( userTouched ) {
			return;
		}
		var el = document.querySelector( FIELD );
		if ( el && ! el.checked ) {
			el.checked = true;
			// Let WooCommerce / any listeners know the value changed.
			el.dispatchEvent( new Event( 'change', { bubbles: true } ) );
		}
	}

	// Real user interaction (isTrusted) opts them out for good; our own
	// dispatched change events are ignored so AJAX re-renders stay pre-ticked.
	document.addEventListener( 'change', function ( e ) {
		if ( e.isTrusted && e.target && e.target.matches && e.target.matches( FIELD ) ) {
			userTouched = true;
		}
	}, true );

	if ( document.readyState !== 'loading' ) {
		preTick();
	} else {
		document.addEventListener( 'DOMContentLoaded', preTick );
	}

	// Classic checkout swaps fragments over AJAX (shipping/coupon changes);
	// re-apply the default if the field gets re-rendered.
	if ( window.jQuery ) {
		jQuery( document.body ).on( 'updated_checkout', preTick );
	}
})();
