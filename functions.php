<?php

/**
 * Enqueue parent CSS.
 */
function theme_enqueue_styles() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

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


