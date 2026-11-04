<?php
/**
 * Outlaw Coffee — "Buy a bag for a deployed soldier" pay link.
 *
 * Flow: /support-troops/ (the URL printed on the QR code) marks the visitor's
 * WooCommerce session, adds the troop bag (default: Frontline Hero, 8 oz,
 * Ground) to the cart, applies the troop coupon and opens checkout.
 *  - The coupon only works for sessions that came through that link; typing
 *    the code by hand is rejected.
 *  - Troop bags are never shipped (Larry hand-delivers them to iHonor USA), so
 *    a cart holding only troop bags skips shipping entirely, and in a mixed
 *    cart the troop bags are left out of the UPS rate calculation.
 *  - Orders are tagged with a note + `_och_troop_support` meta, shown on the
 *    thank-you page and in the order emails, and get a column/filter in
 *    WooCommerce -> Orders.
 *
 * WooCommerce admin setup (one time, per site): Marketing -> Coupons, code
 * OCH_TROOPS_DEFAULT_COUPON, Percentage discount 25, Products = the 8 oz
 * Ground variation, "Allow free shipping" OFF. No shipping method is needed.
 *
 * @package pegasus-child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** Stable path printed on the QR code. */
define( 'OCH_TROOPS_SLUG', 'support-troops' );
/** Frontline Hero — 08 oz / Ground (SKU FLD_08_GD). */
define( 'OCH_TROOPS_DEFAULT_VARIATION', 7870 );
/** WooCommerce coupon code (stored lowercase by WooCommerce). */
define( 'OCH_TROOPS_DEFAULT_COUPON', 'supporttroops' );
/** WooCommerce session key set by the pay link. */
define( 'OCH_TROOPS_SESSION_KEY', 'och_troop_link' );
/** Order note added to every troop order. */
define( 'OCH_TROOPS_ORDER_NOTE', 'DONATION — Deliver to iHonor USA (Larry hand-delivers)' );
/** Most bags one link click can add. */
define( 'OCH_TROOPS_MAX_QTY', 20 );

/**
 * Defaults for the homepage block and the pay link.
 *
 * @return array
 */
function och_troops_defaults() {
	return array(
		'show'         => 'show',
		'eyebrow'      => 'Support deployed troops',
		'title'        => 'Buy a bag for a deployed soldier.',
		'text'         => 'Buy a bag of Frontline Hero for a deployed soldier and take 25% off. There is nothing to ship: we hand-deliver every bag to iHonor USA, who packs it into care packages for troops serving around the world.',
		'btn_text'     => 'Buy a bag for a soldier',
		'headsup'      => 'Heads up: you\'re buying this bag for a deployed soldier. Nothing will be mailed or shipped to you. Larry, the owner of Outlaw Coffee, personally delivers every bag to iHonor USA for their care packages.',
		'thanks'       => 'Thank you! Your bag goes to a deployed soldier. Nothing will be mailed or shipped to you: Larry, the owner of Outlaw Coffee, will personally deliver it to iHonor USA for their care packages.',
		'item_label'   => 'Donated to a deployed soldier',
		'item_value'   => 'Not shipped to you. Larry personally delivers it to iHonor USA.',
		'partner_text' => 'Care packages by iHonor USA',
		'partner_url'  => 'https://ihonorusa.com/',
		'variation_id' => OCH_TROOPS_DEFAULT_VARIATION,
		'coupon'       => OCH_TROOPS_DEFAULT_COUPON,
	);
}

/**
 * Read a troop setting from the static front page (where the CMB2 box lives).
 *
 * @param string $key Field key (without prefix).
 * @return string
 */
function och_troops_opt( $key ) {
	$d       = och_troops_defaults();
	$default = isset( $d[ $key ] ) ? (string) $d[ $key ] : '';
	$page_id = (int) get_option( 'page_on_front' );
	if ( ! $page_id ) {
		return $default;
	}
	$val = get_post_meta( $page_id, '_och_troops_' . $key, true );
	return ( '' !== $val && null !== $val ) ? (string) $val : $default;
}

/** @return int Troop variation/product ID. */
function och_troops_product_id() {
	return absint( och_troops_opt( 'variation_id' ) );
}

/** @return string Troop coupon code, normalised like WooCommerce stores it. */
function och_troops_coupon_code() {
	return function_exists( 'wc_format_coupon_code' ) ? wc_format_coupon_code( och_troops_opt( 'coupon' ) ) : strtolower( och_troops_opt( 'coupon' ) );
}

/** @return string The printable, stable pay-link URL. */
function och_troops_url() {
	return home_url( '/' . OCH_TROOPS_SLUG . '/' );
}

/** @return bool Did this visitor arrive through the pay link? */
function och_troops_session_has_flag() {
	return function_exists( 'WC' ) && WC()->session && WC()->session->get( OCH_TROOPS_SESSION_KEY );
}

/**
 * Is this cart/package line a donated troop bag?
 *
 * The pay link adds the bag with an `och_troop` flag (see och_troops_handle_link),
 * so a troop line never merges with the same product bought for the shopper. We
 * key off that flag, not the variation ID: an identical bag added normally is a
 * personal purchase that must ship and must not get the donation coupon.
 *
 * @param array $item Cart item or package content row.
 * @return bool
 */
function och_troops_is_troop_item( $item ) {
	return ! empty( $item['och_troop'] );
}

/** @return bool Is the troop coupon applied to the current cart? */
function och_troops_cart_has_coupon() {
	$code = och_troops_coupon_code();
	return '' !== $code && function_exists( 'WC' ) && WC()->cart && WC()->cart->has_discount( $code );
}

/**
 * The pay link: /support-troops/[?qty=N]. Marks the session, adds the bag(s)
 * to whatever is already in the cart, applies the coupon, opens checkout.
 * Runs on wp_loaded so the WooCommerce session and cart are ready.
 */
function och_troops_handle_link() {
	if ( is_admin() || wp_doing_ajax() || ! isset( $_SERVER['REQUEST_URI'] ) || ! function_exists( 'WC' ) ) {
		return;
	}
	$path = trim( (string) wp_parse_url( wp_unslash( $_SERVER['REQUEST_URI'] ), PHP_URL_PATH ), '/' ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput
	$base = trim( (string) wp_parse_url( home_url(), PHP_URL_PATH ), '/' );
	if ( '' !== $base && 0 === strpos( $path, $base . '/' ) ) {
		$path = substr( $path, strlen( $base ) + 1 );
	}
	if ( OCH_TROOPS_SLUG !== $path ) {
		return;
	}

	nocache_headers();
	$variation = wc_get_product( och_troops_product_id() );
	// Note: no is_in_stock() check here on purpose. A sold-out bag is left to
	// add_to_cart below so WooCommerce raises its own stock notice and the
	// failure path can show it; bailing here would redirect with no explanation.
	if ( 'hide' === och_troops_opt( 'show' ) || ! $variation || ! $variation->is_purchasable() || ! WC()->session || ! WC()->cart ) {
		wp_safe_redirect( home_url( '/online-shop/' ), 302 );
		exit;
	}

	$qty = isset( $_GET['qty'] ) ? absint( $_GET['qty'] ) : 1; // phpcs:ignore WordPress.Security.NonceVerification
	$qty = max( 1, min( OCH_TROOPS_MAX_QTY, $qty ) );

	if ( ! WC()->session->has_session() ) {
		WC()->session->set_customer_session_cookie( true );
	}
	WC()->session->set( OCH_TROOPS_SESSION_KEY, time() );

	// Adding the bag recalculates shipping before the coupon is on, which can
	// auto-select local pickup; remember the shopper's own choice and restore it.
	$chosen_before = WC()->session->get( 'chosen_shipping_methods' );

	$parent_id = $variation->get_parent_id() ? $variation->get_parent_id() : $variation->get_id();
	$var_id    = $variation->get_parent_id() ? $variation->get_id() : 0;
	$attrs     = $var_id ? wc_get_product_variation_attributes( $var_id ) : array();
	// The `och_troop` flag keeps the donation on its own cart line, so it never
	// merges with the same bag the shopper added for themselves.
	$added = WC()->cart->add_to_cart( $parent_id, $qty, $var_id, $attrs, array( 'och_troop' => 1 ) );

	if ( $added ) {
		$code = och_troops_coupon_code();
		if ( $code && ! WC()->cart->has_discount( $code ) ) {
			WC()->cart->apply_coupon( $code );
		}
	}
	WC()->session->set( 'chosen_shipping_methods', $chosen_before );
	WC()->session->set( 'previous_shipping_methods', null );

	if ( ! $added ) {
		// Out of stock, over inventory, or otherwise unavailable. Keep
		// WooCommerce's own notice (e.g. the stock message) so the shopper lands
		// on the shop with an explanation rather than on an empty checkout. If
		// add_to_cart left no notice, add a plain one so the redirect is never
		// silent. Clear the link flag either way.
		if ( function_exists( 'wc_notice_count' ) && 0 === wc_notice_count( 'error' ) ) {
			wc_add_notice( esc_html__( 'Sorry — the bag for deployed soldiers is sold out right now. Please check back soon.', 'pegasus-child' ), 'error' );
		}
		WC()->session->set( OCH_TROOPS_SESSION_KEY, null );
		wp_safe_redirect( home_url( '/online-shop/' ), 302 );
		exit;
	}

	wc_clear_notices();

	wp_safe_redirect( wc_get_checkout_url(), 302 );
	exit;
}
add_action( 'wp_loaded', 'och_troops_handle_link', 30 );

/**
 * The troop coupon is only valid for sessions that came through the pay link.
 * Priority 99 so it runs after allow_multiple_coupons() in functions.php,
 * which returns true unconditionally at priority 10.
 *
 * @param bool      $valid  Current validity.
 * @param WC_Coupon    $coupon    Coupon.
 * @param WC_Discounts $discounts Discounts object (cart or order).
 * @return bool
 * @throws Exception To show a clear message.
 */
function och_troops_coupon_link_only( $valid, $coupon, $discounts = null ) {
	if ( ! $coupon instanceof WC_Coupon || wc_format_coupon_code( $coupon->get_code() ) !== och_troops_coupon_code() ) {
		return $valid;
	}
	// Existing orders (admin recalculation) keep the coupon they were placed with.
	if ( $discounts instanceof WC_Discounts && $discounts->get_object() instanceof WC_Order ) {
		return $valid;
	}
	if ( ! och_troops_session_has_flag() ) {
		throw new Exception( esc_html__( 'This code only works through the "Buy a bag for a soldier" link on our home page.', 'pegasus-child' ), 109 );
	}
	return $valid;
}
add_filter( 'woocommerce_coupon_is_valid', 'och_troops_coupon_link_only', 99, 3 );

/**
 * The troop coupon discounts only the donated bags, never an identical bag the
 * shopper added for themselves. WooCommerce's coupon product restriction matches
 * by product/variation ID, so without this a personal Frontline Hero line in the
 * same cart would also be discounted; here we apply it only to the flagged troop
 * line. Scoped to live cart calculations — admin/order recalculation is left
 * untouched so existing orders keep the discount they were placed with.
 *
 * @param bool       $valid   Whether the coupon applies to this product.
 * @param WC_Product $product Product being checked.
 * @param WC_Coupon  $coupon  Coupon.
 * @param array      $values  Cart item (empty/other in non-cart contexts).
 * @return bool
 */
function och_troops_coupon_only_troop_lines( $valid, $product, $coupon, $values ) {
	if ( ! $coupon instanceof WC_Coupon || wc_format_coupon_code( $coupon->get_code() ) !== och_troops_coupon_code() ) {
		return $valid;
	}
	// A cart line always carries the product object under 'data'; order-item and
	// generic checks do not, and we leave those alone.
	if ( is_array( $values ) && isset( $values['data'] ) ) {
		return ! empty( $values['och_troop'] );
	}
	return $valid;
}
add_filter( 'woocommerce_coupon_is_valid_for_product', 'och_troops_coupon_only_troop_lines', 10, 4 );

/**
 * A cart holding only troop bags (with the troop coupon) needs no shipping.
 *
 * @param bool $needs Whether the cart needs shipping.
 * @return bool
 */
function och_troops_cart_needs_shipping( $needs ) {
	if ( ! $needs || ! och_troops_cart_has_coupon() ) {
		return $needs;
	}
	foreach ( WC()->cart->get_cart() as $item ) {
		if ( ! och_troops_is_troop_item( $item ) && $item['data'] instanceof WC_Product && $item['data']->needs_shipping() ) {
			return true; // Something else must ship.
		}
	}
	return false;
}
add_filter( 'woocommerce_cart_needs_shipping', 'och_troops_cart_needs_shipping', 20 );

/**
 * Mixed cart: leave the troop bags out of the shipping packages so they do not
 * add weight or cost to the UPS rates for the items that really ship.
 *
 * @param array $packages Shipping packages.
 * @return array
 */
function och_troops_shipping_packages( $packages ) {
	if ( ! och_troops_cart_has_coupon() ) {
		return $packages;
	}
	foreach ( $packages as $i => $package ) {
		if ( empty( $package['contents'] ) ) {
			continue;
		}
		$kept = array_filter( $package['contents'], function ( $row ) {
			return ! och_troops_is_troop_item( $row );
		} );
		if ( empty( $kept ) || count( $kept ) === count( $package['contents'] ) ) {
			continue;
		}
		$packages[ $i ]['contents']      = $kept;
		$packages[ $i ]['contents_cost'] = array_sum( wp_list_pluck( $kept, 'line_total' ) );
	}
	return $packages;
}
add_filter( 'woocommerce_cart_shipping_packages', 'och_troops_shipping_packages', 20 );

/* -------------------------------------------------------------------------
 * "Nothing ships to you" messaging (cart, checkout, line items)
 * ---------------------------------------------------------------------- */

/**
 * Block-style info banner (works above the Cart and Checkout blocks and on
 * classic pages).
 *
 * @param string $text  Message.
 * @param string $extra Extra class.
 * @return string
 */
function och_troops_banner( $text, $extra = '' ) {
	if ( '' === trim( $text ) ) {
		return '';
	}
	return sprintf(
		'<div class="wc-block-components-notice-banner is-info och-troops-headsup %1$s" role="note"><span class="och-flag__icon och-flag__icon--sm" aria-hidden="true"></span><div class="wc-block-components-notice-banner__content">%2$s</div></div>',
		esc_attr( $extra ),
		esc_html( $text )
	);
}

/** @return bool Does the cart hold a donated (troop-coupon) bag? */
function och_troops_cart_has_donation() {
	if ( ! och_troops_cart_has_coupon() ) {
		return false;
	}
	foreach ( WC()->cart->get_cart() as $item ) {
		if ( och_troops_is_troop_item( $item ) ) {
			return true;
		}
	}
	return false;
}

/**
 * Put the heads-up above the Cart and Checkout blocks when the cart holds a
 * donated bag. Rendered server-side outside the block wrapper, so the block's
 * own JavaScript never removes it.
 *
 * @param string $html  Block HTML.
 * @param array  $block Block data.
 * @return string
 */
function och_troops_block_headsup( $html, $block ) {
	if ( empty( $block['blockName'] ) || ! in_array( $block['blockName'], array( 'woocommerce/cart', 'woocommerce/checkout' ), true ) ) {
		return $html;
	}
	if ( is_admin() || ! function_exists( 'WC' ) || ! WC()->cart || ! och_troops_cart_has_donation() ) {
		return $html;
	}
	return och_troops_banner( och_troops_opt( 'headsup' ), 'och-troops-headsup--' . substr( $block['blockName'], 12 ) ) . $html;
}
add_filter( 'render_block', 'och_troops_block_headsup', 10, 2 );

/** Same heads-up on the classic (shortcode) cart and checkout, if ever used. */
function och_troops_classic_headsup() {
	if ( och_troops_cart_has_donation() ) {
		echo och_troops_banner( och_troops_opt( 'headsup' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in och_troops_banner().
	}
}
add_action( 'woocommerce_before_cart', 'och_troops_classic_headsup', 5 );
add_action( 'woocommerce_before_checkout_form', 'och_troops_classic_headsup', 5 );

/**
 * Line under the product name in the cart / checkout (blocks read this via
 * the Store API item_data).
 *
 * @param array $data Item data rows.
 * @param array $item Cart item.
 * @return array
 */
function och_troops_cart_item_data( $data, $item ) {
	if ( och_troops_is_troop_item( $item ) && och_troops_cart_has_coupon() && '' !== och_troops_opt( 'item_label' ) ) {
		$data[] = array(
			'key'   => och_troops_opt( 'item_label' ),
			'value' => och_troops_opt( 'item_value' ),
		);
	}
	return $data;
}
add_filter( 'woocommerce_get_item_data', 'och_troops_cart_item_data', 10, 2 );

/**
 * Save the same line on the order item (thank-you page, emails, admin).
 *
 * @param WC_Order_Item_Product $line   Order line.
 * @param string                $key    Cart item key.
 * @param array                 $values Cart item.
 */
function och_troops_order_item_meta( $line, $key, $values ) {
	if ( och_troops_is_troop_item( $values ) && och_troops_cart_has_coupon() ) {
		// Hidden flag so the order knows exactly which lines are donated bags
		// (used to tell a donation-only order from a mixed one).
		$line->add_meta_data( '_och_troop', 1, true );
		if ( '' !== och_troops_opt( 'item_label' ) ) {
			$line->add_meta_data( och_troops_opt( 'item_label' ), och_troops_opt( 'item_value' ), true );
		}
	}
}
add_action( 'woocommerce_checkout_create_order_line_item', 'och_troops_order_item_meta', 10, 3 );

/* -------------------------------------------------------------------------
 * Orders
 * ---------------------------------------------------------------------- */

/**
 * Is this a troop order?
 *
 * @param WC_Order $order Order.
 * @return bool
 */
function och_troops_is_troop_order( $order ) {
	if ( ! $order instanceof WC_Order ) {
		return false;
	}
	if ( 'yes' === $order->get_meta( '_och_troop_support' ) ) {
		return true;
	}
	return in_array( och_troops_coupon_code(), array_map( 'wc_format_coupon_code', $order->get_coupon_codes() ), true );
}

/**
 * Is the whole order donated bags — nothing in it ships to the customer?
 *
 * The order-level "nothing will be mailed or shipped to you" copy is only true
 * for a donation-only order. In a mixed order the other items still ship via UPS,
 * so that copy is shown per line item (see och_troops_order_item_meta) but not at
 * the order level, where it would be misleading.
 *
 * @param int|WC_Order $order Order ID or object.
 * @return bool
 */
function och_troops_order_donation_only( $order ) {
	$order = is_numeric( $order ) ? wc_get_order( $order ) : $order;
	if ( ! och_troops_is_troop_order( $order ) ) {
		return false;
	}
	foreach ( $order->get_items() as $item ) {
		if ( $item->get_meta( '_och_troop' ) ) {
			continue;
		}
		$product = $item->get_product();
		if ( $product instanceof WC_Product && $product->needs_shipping() ) {
			return false; // A non-troop item in the order still ships.
		}
	}
	return true;
}

/**
 * Tag troop orders with meta + an order note.
 *
 * @param WC_Order|int $order Order object or ID.
 */
function och_troops_flag_order( $order ) {
	$order = is_numeric( $order ) ? wc_get_order( $order ) : $order;
	if ( ! $order instanceof WC_Order || 'yes' === $order->get_meta( '_och_troop_support' ) || ! och_troops_is_troop_order( $order ) ) {
		return;
	}
	$bags = 0;
	foreach ( $order->get_items() as $item ) {
		if ( $item->get_meta( '_och_troop' ) ) {
			$bags += (int) $item->get_quantity();
		}
	}
	if ( ! $bags ) {
		// Fallback for an order matched only by its coupon (no per-line flag),
		// counting the troop variation/product directly.
		foreach ( $order->get_items() as $item ) {
			if ( (int) $item->get_variation_id() === och_troops_product_id() || (int) $item->get_product_id() === och_troops_product_id() ) {
				$bags += (int) $item->get_quantity();
			}
		}
	}
	$order->update_meta_data( '_och_troop_support', 'yes' );
	$order->update_meta_data( '_och_troop_bags', $bags );
	$order->add_order_note( OCH_TROOPS_ORDER_NOTE . ( $bags ? ' — ' . $bags . ' bag' . ( 1 === $bags ? '' : 's' ) : '' ) );
	$order->save();
	if ( WC()->session ) {
		WC()->session->set( OCH_TROOPS_SESSION_KEY, null );
	}
}
add_action( 'woocommerce_checkout_order_created', 'och_troops_flag_order' );
add_action( 'woocommerce_store_api_checkout_order_processed', 'och_troops_flag_order' );

/**
 * Thank-you message (thank-you page, My Account order view).
 *
 * @param int|WC_Order $order Order ID or object.
 */
function och_troops_thankyou_notice( $order ) {
	$order = is_numeric( $order ) ? wc_get_order( $order ) : $order;
	// Only on a donation-only order: a mixed order ships its other items, so the
	// "nothing ships to you" thank-you would be wrong (the donated line still
	// carries its own "not shipped to you" note in the items table).
	if ( ! och_troops_order_donation_only( $order ) ) {
		return;
	}
	printf(
		'<div class="woocommerce-message och-troops-thanks" role="status"><span class="och-flag__icon och-flag__icon--sm" aria-hidden="true"></span> %s</div>',
		esc_html( och_troops_opt( 'thanks' ) )
	);
}
add_action( 'woocommerce_before_thankyou', 'och_troops_thankyou_notice', 5 );
add_action( 'woocommerce_view_order', 'och_troops_thankyou_notice', 5 );

/**
 * Same line at the top of the order emails (customer + admin).
 *
 * @param WC_Order $order         Order.
 * @param bool     $sent_to_admin Admin email.
 * @param bool     $plain_text    Plain-text email.
 */
function och_troops_email_notice( $order, $sent_to_admin = false, $plain_text = false ) {
	if ( ! och_troops_is_troop_order( $order ) ) {
		return;
	}
	if ( $sent_to_admin ) {
		// Admin always sees the DONATION line, mixed order or not.
		$line = OCH_TROOPS_ORDER_NOTE;
	} elseif ( och_troops_order_donation_only( $order ) ) {
		$line = och_troops_opt( 'thanks' );
	} else {
		// Mixed order: other items ship, so skip the order-level "nothing ships"
		// copy. The donated line still shows its own note in the items table.
		return;
	}
	if ( $plain_text ) {
		echo "\n" . esc_html( $line ) . "\n\n";
		return;
	}
	printf(
		'<p style="margin:0 0 18px;padding:12px 16px;background:#f6f0e4;border-left:4px solid #c7481b;color:#2a1d13;font-weight:600;">%s</p>',
		esc_html( $line )
	);
}
add_action( 'woocommerce_email_order_details', 'och_troops_email_notice', 5, 3 );

/* Admin order list: "Troop" column + "Troop orders only" filter (legacy and HPOS). */

/**
 * @param array $cols Columns.
 * @return array
 */
function och_troops_admin_column( $cols ) {
	$out = array();
	foreach ( $cols as $key => $label ) {
		$out[ $key ] = $label;
		if ( 'order_status' === $key ) {
			$out['och_troop'] = 'Troop';
		}
	}
	if ( ! isset( $out['och_troop'] ) ) {
		$out['och_troop'] = 'Troop';
	}
	return $out;
}
add_filter( 'manage_edit-shop_order_columns', 'och_troops_admin_column', 20 );
add_filter( 'manage_woocommerce_page_wc-orders_columns', 'och_troops_admin_column', 20 );

/**
 * @param string           $col   Column.
 * @param int|WC_Order     $order Post ID (legacy) or order (HPOS).
 */
function och_troops_admin_column_value( $col, $order ) {
	if ( 'och_troop' !== $col ) {
		return;
	}
	$order = is_numeric( $order ) ? wc_get_order( $order ) : $order;
	if ( $order instanceof WC_Order && 'yes' === $order->get_meta( '_och_troop_support' ) ) {
		$bags = (int) $order->get_meta( '_och_troop_bags' );
		echo '<mark class="order-status status-processing" title="' . esc_attr( OCH_TROOPS_ORDER_NOTE ) . '"><span>&#127482;&#127480; iHonor' . ( $bags ? ' × ' . (int) $bags : '' ) . '</span></mark>';
	}
}
add_action( 'manage_shop_order_posts_custom_column', 'och_troops_admin_column_value', 20, 2 );
add_action( 'manage_woocommerce_page_wc-orders_custom_column', 'och_troops_admin_column_value', 20, 2 );

/** Filter dropdown. */
function och_troops_admin_filter_ui() {
	$screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;
	if ( ! $screen || ! in_array( $screen->id, array( 'edit-shop_order', 'woocommerce_page_wc-orders' ), true ) ) {
		return;
	}
	$on = ! empty( $_GET['och_troop'] ); // phpcs:ignore WordPress.Security.NonceVerification
	echo '<select name="och_troop"><option value="">All orders</option><option value="1"' . selected( $on, true, false ) . '>Troop orders only</option></select>';
}
add_action( 'restrict_manage_posts', 'och_troops_admin_filter_ui', 20 );
add_action( 'woocommerce_order_list_table_restrict_manage_orders', 'och_troops_admin_filter_ui', 20 );

/** @param WP_Query $q Legacy orders query. */
function och_troops_admin_filter_legacy( $q ) {
	if ( is_admin() && $q->is_main_query() && 'shop_order' === $q->get( 'post_type' ) && ! empty( $_GET['och_troop'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification
		$mq   = (array) $q->get( 'meta_query' );
		$mq[] = array( 'key' => '_och_troop_support', 'value' => 'yes' );
		$q->set( 'meta_query', $mq );
	}
}
add_action( 'pre_get_posts', 'och_troops_admin_filter_legacy' );

/**
 * @param array $args HPOS query args.
 * @return array
 */
function och_troops_admin_filter_hpos( $args ) {
	if ( ! empty( $_GET['och_troop'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification
		$args['meta_query']   = isset( $args['meta_query'] ) ? (array) $args['meta_query'] : array();
		$args['meta_query'][] = array( 'key' => '_och_troop_support', 'value' => 'yes' );
	}
	return $args;
}
add_filter( 'woocommerce_order_list_table_prepare_items_query_args', 'och_troops_admin_filter_hpos' );

/* -------------------------------------------------------------------------
 * Homepage block
 * ---------------------------------------------------------------------- */

/**
 * Render the homepage block (called from tpl_home.php).
 */
function och_troops_block() {
	if ( 'hide' === och_troops_opt( 'show' ) || ! function_exists( 'wc_get_product' ) ) {
		return;
	}
	$product = wc_get_product( och_troops_product_id() );
	if ( ! $product || ! $product->is_purchasable() || ! $product->is_in_stock() ) {
		return;
	}

	$price  = (float) $product->get_price();
	$pct    = 25.0;
	$coupon = new WC_Coupon( och_troops_coupon_code() );
	if ( $coupon->get_id() && 'percent' === $coupon->get_discount_type() ) {
		$pct = (float) $coupon->get_amount();
	}
	$sale = round( $price * ( 1 - $pct / 100 ), 2 );

	$image_url = och_troops_opt( 'image' );
	if ( ! $image_url ) {
		$img_id    = $product->get_image_id() ? $product->get_image_id() : get_post_thumbnail_id( $product->get_parent_id() );
		$image_url = $img_id ? wp_get_attachment_image_url( $img_id, 'large' ) : '';
	}
	$name = $product->get_parent_id() ? wc_get_product( $product->get_parent_id() )->get_name() : $product->get_name();
	$meta = wc_get_formatted_variation( $product, true, false, false );
	?>
	<section id="support-troops" class="och-section och-troops">
		<div class="container">
			<div class="och-troops__card">
				<div class="row align-items-center g-4 g-lg-5">
					<div class="col-12 col-md-5 col-lg-4">
						<div class="och-troops__media">
							<?php och_img_markup( $image_url, 'och-troops__img', 'Frontline Hero bag', $name ); ?>
							<span class="och-troops__badge"><?php echo esc_html( number_format_i18n( $pct ) . '% off · We deliver it' ); ?></span>
						</div>
					</div>
					<div class="col-12 col-md-7 col-lg-8">
						<p class="och-eyebrow och-eyebrow--ember">
							<span class="och-flag__icon och-flag__icon--sm" aria-hidden="true"></span>
							<?php echo esc_html( och_troops_opt( 'eyebrow' ) ); ?>
						</p>
						<h2 class="och-h2 och-h2--light"><?php echo esc_html( och_troops_opt( 'title' ) ); ?></h2>
						<p class="och-troops__text"><?php echo wp_kses_post( och_troops_opt( 'text' ) ); ?></p>

						<div class="och-troops__product">
							<span class="och-troops__name"><?php echo esc_html( $name ); ?> <span class="och-troops__variant">· <?php echo esc_html( $meta ); ?></span></span>
							<span class="och-troops__price">
								<del><?php echo wp_kses_post( wc_price( $price ) ); ?></del>
								<ins><?php echo wp_kses_post( wc_price( $sale ) ); ?></ins>
								<span class="och-troops__ship">a bag · no shipping</span>
							</span>
						</div>

						<form class="och-troops__cta" action="<?php echo esc_url( och_troops_url() ); ?>" method="get">
							<label class="och-troops__qty">
								<span>Bags</span>
								<input type="number" name="qty" value="1" min="1" max="<?php echo (int) OCH_TROOPS_MAX_QTY; ?>" step="1" inputmode="numeric">
							</label>
							<button type="submit" class="och-btn och-btn--rust"><?php echo esc_html( och_troops_opt( 'btn_text' ) ); ?></button>
							<a class="och-troops__partner" href="<?php echo esc_url( och_troops_opt( 'partner_url' ) ); ?>" target="_blank" rel="noopener"><?php echo esc_html( och_troops_opt( 'partner_text' ) ); ?> &rarr;</a>
						</form>
						<?php if ( '' !== och_troops_opt( 'headsup' ) ) : ?>
							<p class="och-troops__headsup"><?php echo esc_html( och_troops_opt( 'headsup' ) ); ?></p>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php
}

/**
 * CMB2 box on the Home Template so the client can edit everything.
 */
function och_register_troops_metabox() {
	$d   = och_troops_defaults();
	$box = new_cmb2_box(
		array(
			'id'           => 'och_troops_box',
			'title'        => 'Homepage — Support the Troops',
			'object_types' => array( 'page' ),
			'context'      => 'normal',
			'priority'     => 'high',
			'show_on_cb'   => 'och_show_on_home_template',
			'closed'       => true,
		)
	);
	$p = '_och_troops_';
	$box->add_field( array( 'name' => 'Show block', 'id' => $p . 'show', 'type' => 'select', 'options' => array( 'show' => 'Show', 'hide' => 'Hide (link goes to the shop)' ), 'default' => $d['show'] ) );
	$box->add_field( array( 'name' => 'Eyebrow', 'id' => $p . 'eyebrow', 'type' => 'text', 'default' => $d['eyebrow'] ) );
	$box->add_field( array( 'name' => 'Title', 'id' => $p . 'title', 'type' => 'text', 'default' => $d['title'] ) );
	$box->add_field( array( 'name' => 'Text', 'id' => $p . 'text', 'type' => 'textarea_small', 'default' => $d['text'] ) );
	$box->add_field( array( 'name' => 'Button label', 'id' => $p . 'btn_text', 'type' => 'text', 'default' => $d['btn_text'] ) );
	$box->add_field( array( 'name' => 'Heads-up (nothing ships to you)', 'desc' => 'Shown under the button on the home page and at the top of the cart and checkout when a donated bag is in the cart. Leave empty to hide.', 'id' => $p . 'headsup', 'type' => 'textarea_small', 'default' => $d['headsup'] ) );
	$box->add_field( array( 'name' => 'Thank-you line', 'desc' => 'Shown on the order-received page and in the customer order email.', 'id' => $p . 'thanks', 'type' => 'textarea_small', 'default' => $d['thanks'] ) );
	$box->add_field( array( 'name' => 'Line item label', 'desc' => 'Shown under the product name in the cart, checkout, thank-you page, emails and admin order. Leave empty to hide.', 'id' => $p . 'item_label', 'type' => 'text', 'default' => $d['item_label'] ) );
	$box->add_field( array( 'name' => 'Line item text', 'id' => $p . 'item_value', 'type' => 'text', 'default' => $d['item_value'] ) );
	$box->add_field( array( 'name' => 'Partner line', 'id' => $p . 'partner_text', 'type' => 'text', 'default' => $d['partner_text'] ) );
	$box->add_field( array( 'name' => 'Partner URL', 'id' => $p . 'partner_url', 'type' => 'text_url', 'default' => $d['partner_url'] ) );
	$box->add_field( array( 'name' => 'Image (optional)', 'desc' => 'Defaults to the product photo.', 'id' => $p . 'image', 'type' => 'file', 'options' => array( 'url' => false ), 'query_args' => array( 'type' => 'image' ) ) );
	$box->add_field( array( 'name' => 'Product / variation ID', 'desc' => 'Frontline Hero 8 oz Ground = 7870 (SKU FLD_08_GD). Products -> Frontline Hero -> Variations shows the ID.', 'id' => $p . 'variation_id', 'type' => 'text_small', 'default' => $d['variation_id'] ) );
	$box->add_field( array( 'name' => 'Coupon code', 'desc' => 'Marketing -> Coupons: percentage discount, limited to the product above. It only works through the pay link.', 'id' => $p . 'coupon', 'type' => 'text_medium', 'default' => $d['coupon'] ) );
	$box->add_field( array( 'name' => 'Pay link / QR code URL', 'id' => $p . 'url_info', 'type' => 'title', 'desc' => esc_html( och_troops_url() ) . ' (print this on the QR code; it never changes; add ?qty=3 for 3 bags)' ) );
}
add_action( 'cmb2_admin_init', 'och_register_troops_metabox' );
