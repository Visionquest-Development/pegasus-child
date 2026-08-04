<?php

/**
 * Homepage CMB2 fields + render helpers (Outlaw Coffee home template).
 */
require_once get_stylesheet_directory() . '/inc/outlaw-home-fields.php';
require_once get_stylesheet_directory() . '/inc/outlaw-hamilton-fields.php';

/**
 * Enqueue parent CSS.
 */
function theme_enqueue_styles() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

/**
 * Enqueue the Google fonts used by the Outlaw Coffee homepage design.
 */
function pegasus_child_home_fonts() {
	wp_enqueue_style( 'pegasus-child-gfonts-preconnect', 'https://fonts.googleapis.com', array(), null );
	wp_enqueue_style(
		'pegasus-child-outlaw-fonts',
		'https://fonts.googleapis.com/css2?family=Bitter:wght@400;500;600;700;800;900&family=Oswald:wght@400;500;600;700&family=Work+Sans:wght@300;400;500;600;700&display=swap',
		array(),
		null
	);
}
add_action( 'wp_enqueue_scripts', 'pegasus_child_home_fonts' );

/**
 * Enqueue JS properly
 */
function pegasus_child_bootstrap_js() {
	wp_enqueue_script( 'pegasus_custom_js', get_stylesheet_directory_uri() . '/js/pegasus-custom.js', array(), '', true );
}
add_action( 'wp_enqueue_scripts', 'pegasus_child_bootstrap_js' );

/**
 * Add custom role for Local Customer if it does not exist
 */
function add_local_customer_role() {
	if ( !get_role('local_customer') ) {
		add_role(
			'local_customer',
			__('Local Customer'),
			array(
				'read' => true,
				'level_0' => true,
			)
		);
	}
}
add_action('init', 'add_local_customer_role');

/**
 * Assign Local Customer role based on ZIP code after WPForms user registration
 */
function assign_local_customer_role_on_zip($user_id, $fields, $form_data) {
	if (isset($form_data['id']) && $form_data['id'] == 36) {
		$zip_code = '';
		foreach ($fields as $field) {
			if ('Zip Code' === $field['name']) { 
				$zip_code = sanitize_text_field($field['value']);
				break;
			}
		}

		$local_zips = array('30019', '30011', '30045', '30519', '30049', '30046', '30548');

		if (in_array($zip_code, $local_zips)) {
			$user = new WP_User($user_id);
			$user->set_role('local_customer');
		}
	}
}
add_action('wpforms_user_registered', 'assign_local_customer_role_on_zip', 10, 3);

/**
 * Re-assign role when the admin updates the user's profile (approval step)
 */
function assign_local_customer_role_on_profile_update($user_id) {
	$user = new WP_User($user_id);

	if (in_array('administrator', $user->roles)) {
		return;  // Skip administrators
	}

	$zip_code = get_user_meta($user_id, 'billing_postcode', true);
	$local_zips = array('30019', '30011', '30045', '30519', '30049', '30046', '30548');

	if (in_array($zip_code, $local_zips)) {
		$user->set_role('local_customer');
	}
}
add_action('profile_update', 'assign_local_customer_role_on_profile_update');

/* -------------------------------------------------------------------------
 * Hamilton Mill neighborhood delivery
 *
 * Flow: a resident signs up (Hamilton Mill landing page or the normal
 * registration page). Signing up alone grants NOTHING. After the client
 * confirms the address is inside Hamilton Mill, he sets that user's role to
 * "Hamilton Mill" (hamilton_mill) in Users -> edit user -> Role. Only then
 * does the flat delivery method appear for them at checkout.
 *
 * The $1.50 flat rate itself is created once in the WooCommerce admin
 * (Settings -> Shipping) named exactly OCH_HAMILTON_DELIVERY_LABEL. The filter
 * below hides that method from anyone who is not an approved Hamilton Mill
 * resident, while leaving the normal paid shipping options untouched.
 * See HAMILTON-MILL-SETUP.md for the one-time admin steps.
 * ---------------------------------------------------------------------- */

// The exact Title given to the flat-rate shipping method in the WooCommerce
// admin. Change it in one place here if you rename the method.
if ( ! defined( 'OCH_HAMILTON_DELIVERY_LABEL' ) ) {
	define( 'OCH_HAMILTON_DELIVERY_LABEL', 'Local Delivery' );
}

/**
 * Register the Hamilton Mill role so it appears in the WordPress user editor.
 *
 * The role is a clone of the WooCommerce "customer" role, so an approved
 * resident keeps every customer ability — viewing past orders, saved addresses,
 * downloads, and anything plugins add to the customer role. It self-heals: if
 * the customer role gains capabilities later, Hamilton Mill picks them up on the
 * next page load.
 */
function add_hamilton_mill_role() {
	$customer = get_role( 'customer' );

	// Mirror the live customer capabilities (fallback to the WooCommerce
	// default of just `read` if the customer role isn't available yet).
	$caps = ( $customer && ! empty( $customer->capabilities ) )
		? $customer->capabilities
		: array( 'read' => true );

	$role = get_role( 'hamilton_mill' );

	if ( ! $role ) {
		add_role( 'hamilton_mill', __( 'Hamilton Mill' ), $caps );
		return;
	}

	// Role already exists — keep its capabilities in sync with customer.
	if ( $role->capabilities != $caps ) { // phpcs:ignore WordPress.PHP.StrictComparisons.LooseComparison -- comparing cap maps.
		foreach ( array_keys( $role->capabilities ) as $cap ) {
			$role->remove_cap( $cap );
		}
		foreach ( $caps as $cap => $grant ) {
			if ( $grant ) {
				$role->add_cap( $cap );
			}
		}
	}
}
add_action( 'init', 'add_hamilton_mill_role' );

/**
 * Does the current visitor qualify for Hamilton Mill delivery?
 *
 * @return bool
 */
function och_is_hamilton_mill_customer() {
	if ( ! is_user_logged_in() ) {
		return false;
	}
	$user = wp_get_current_user();
	return in_array( 'hamilton_mill', (array) $user->roles, true );
}

/**
 * Product categories whose items qualify for the flat $1.50 Local Delivery.
 *
 * A product qualifies if it lives in this category OR any of its subcategories
 * (e.g. Coffee -> Dark Roast). Everything else — Merchandise, Coffee Drinks,
 * Local Delivery Only, uncategorized items — makes the cart ineligible.
 * Filterable so the eligible set can be tweaked without editing this function.
 *
 * @return string[] product_cat slugs.
 */
function och_hamilton_delivery_category_slugs() {
	return apply_filters(
		'och_hamilton_delivery_categories',
		array( 'coffee' )
	);
}

/**
 * Expand the eligible category slugs into a flat set of product_cat term IDs —
 * each configured root category plus all of its descendants. Cached per request.
 *
 * @return int[] Eligible product_cat term IDs (empty if none resolve).
 */
function och_hamilton_delivery_term_ids() {
	static $ids = null;
	if ( null !== $ids ) {
		return $ids;
	}

	$ids = array();
	foreach ( och_hamilton_delivery_category_slugs() as $slug ) {
		$term = get_term_by( 'slug', $slug, 'product_cat' );
		if ( ! $term || is_wp_error( $term ) ) {
			continue;
		}
		$ids[] = (int) $term->term_id;
		$children = get_term_children( $term->term_id, 'product_cat' );
		if ( ! is_wp_error( $children ) ) {
			$ids = array_merge( $ids, array_map( 'intval', $children ) );
		}
	}

	$ids = array_values( array_unique( $ids ) );
	return $ids;
}

/**
 * Does this shipping package hold ONLY coffee-eligible items?
 *
 * The $1.50 delivery is coffee-only: if any item is merch (or anything outside
 * the eligible categories), the whole cart loses the flat rate.
 *
 * @param array $package WooCommerce shipping package (its 'contents' line items).
 * @return bool True only when every item qualifies for local delivery.
 */
function och_package_is_delivery_eligible( $package ) {
	$allowed = och_hamilton_delivery_term_ids();
	if ( empty( $allowed ) ) {
		return false; // Categories missing/misconfigured — fail safe, hide the rate.
	}

	$contents = ! empty( $package['contents'] ) ? $package['contents'] : array();
	if ( empty( $contents ) ) {
		return false;
	}

	foreach ( $contents as $item ) {
		$product_id = ! empty( $item['product_id'] ) ? (int) $item['product_id'] : 0;
		if ( ! $product_id ) {
			return false;
		}

		// Directly-assigned terms; descendants are already folded into $allowed,
		// so a product tagged only "Dark Roast" still matches via that term ID.
		$terms = wp_get_post_terms( $product_id, 'product_cat', array( 'fields' => 'ids' ) );
		if ( is_wp_error( $terms ) || empty( $terms ) || ! array_intersect( $terms, $allowed ) ) {
			return false; // Non-coffee (merch/uncategorized) item — block the rate.
		}
	}

	return true;
}

/**
 * Hide the flat "Local Delivery" method at checkout unless the logged-in user
 * is an approved Hamilton Mill resident AND the cart contains only coffee. Any
 * merch in the cart removes the $1.50 option (they use paid shipping instead);
 * paid shipping methods are always left untouched.
 *
 * @param array $rates   Available shipping rates, keyed by rate ID.
 * @param array $package Shipping package (its line items decide eligibility).
 * @return array
 */
function hamilton_mill_filter_delivery_rate( $rates, $package ) {
	// Approved resident with a coffee-only cart keeps the delivery option.
	if ( och_is_hamilton_mill_customer() && och_package_is_delivery_eligible( $package ) ) {
		return $rates;
	}

	foreach ( $rates as $rate_id => $rate ) {
		if ( 0 === stripos( $rate->get_label(), OCH_HAMILTON_DELIVERY_LABEL ) ) {
			unset( $rates[ $rate_id ] );
		}
	}

	return $rates;
}
add_filter( 'woocommerce_package_rates', 'hamilton_mill_filter_delivery_rate', 10, 2 );

// Allow multiple coupons (stacking)
add_filter( 'woocommerce_coupon_is_valid', 'allow_multiple_coupons', 10, 2 );
function allow_multiple_coupons( $is_valid, $coupon ) {
    return true;
}

add_filter('woocommerce_apply_with_individual_use_coupon', '__return_false');

// Auto-apply coupon permanently for specific users upon login (based on user meta)
function apply_permanent_user_coupon() {
    if ( is_admin() || ! is_user_logged_in() ) {
        return;
    }

    $user_id = get_current_user_id();
    
    // Get user's permanent coupon from user meta
    $permanent_coupon = get_user_meta( $user_id, 'permanent_coupon_code', true );

    if ( !empty( $permanent_coupon ) && !WC()->cart->has_discount( $permanent_coupon ) ) {
        WC()->cart->apply_coupon( $permanent_coupon );
        wc_clear_notices(); // clear notices to avoid confusion
    }
}
add_action( 'woocommerce_before_cart', 'apply_permanent_user_coupon' );
add_action( 'woocommerce_before_checkout_form', 'apply_permanent_user_coupon' );


