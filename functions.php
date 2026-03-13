<?php

	/**
	 * Plugin requirements (TGMPA) & Bootstrap CMB2
	 */
	//require_once get_template_directory_uri() . 'inc/class-tgm-plugin-activation.php';

	/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	~~~~PROPER WAY OF ADDING CHILD THEME CSS FILE ~~~~
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/

	function theme_enqueue_styles() {
		wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

		/* qTip CSS */
		//wp_enqueue_style('twentytwenty-css', get_stylesheet_directory_uri() . '/css/twentytwenty.css', null, false, false);

	}
	add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

	/**
	* Proper way to enqueue JS
	*/
	function pegasus_child_bootstrap_js() {

		wp_enqueue_style( 'slick-css' );
		wp_enqueue_style( 'slick-theme-css' );
		wp_enqueue_script( 'match-height-js' );
		wp_enqueue_script( 'slick-js' );
		wp_enqueue_script( 'pegasus-carousel-plugin' );

		wp_enqueue_script( 'pegasus_child_custom_js', get_stylesheet_directory_uri() . '/js/pegasus-custom.js', array(), '', true );

		//wp_enqueue_script( 'matchHeight_js', get_stylesheet_directory_uri() . '/js/jquery.matchHeight-min.js', array(), '', true );

		wp_enqueue_style( 'tabs-css' );
		wp_enqueue_script( 'pegasus-tabs-plugin' );


		// Lightbox2.
		wp_enqueue_style( 'lightbox2-css', get_stylesheet_directory_uri() . '/css/lightbox.min.css', array(), '2.11.4' );
		wp_enqueue_script( 'lightbox2-js', get_stylesheet_directory_uri() . '/js/lightbox.min.js', array( 'jquery' ), '2.11.4', true );

	} //end function
	add_action( 'wp_enqueue_scripts', 'pegasus_child_bootstrap_js' );


	/**
	 * Homepage Sections metabox (CMB2) – shown only on the static front page
	 */
	if ( ! function_exists( 'cmb2_homepage_metabox' ) ) {
		function cmb2_homepage_metabox() {

			$homepage_id = (int) get_option( 'page_on_front' ); // ID of the static front page
			$about_page_id = 77; // About page ID


			// Build list of page IDs this box should appear on.
			$page_ids = array_filter( array( $homepage_id, $about_page_id ) );

			// Bail if we somehow have no valid IDs.
			if ( empty( $page_ids ) ) {
				return;
			}

			$prefix = 'homepage_sections_';

			$cmb = new_cmb2_box( array(
				'id'            => $prefix . 'metabox',
				'title'         => __( 'Homepage Sections', 'pegasus-bootstrap' ),
				'object_types'  => array( 'page' ),
				'show_on'       => array(
					'key'   => 'id',
					'value' => $page_ids,
				),
				'context'       => 'normal',
				'priority'      => 'high',
				'show_names'    => true,
			) );

			$group_field_id = $cmb->add_field( array(
				'id'          => $prefix . 'repeatable_group',
				'type'        => 'group',
				'description' => __( 'Add multiple sections for the homepage', 'pegasus-bootstrap' ),
				'options'     => array(
					'group_title'   => __( 'Section {#}', 'pegasus-bootstrap' ),
					'add_button'    => __( 'Add Another Section', 'pegasus-bootstrap' ),
					'remove_button' => __( 'Remove Section', 'pegasus-bootstrap' ),
					'sortable'      => true,
				),
			) );

			// Background image
			$cmb->add_group_field( $group_field_id, array(
				'name'    => __( 'Background Image', 'pegasus-bootstrap' ),
				'id'      => 'background_image',
				'type'    => 'file',
				'options' => array(
					'url' => false, // hide URL input
				),
				'text'    => array(
					'add_upload_file_text' => __( 'Add Background Image', 'pegasus-bootstrap' ),
				),
			) );

			// Title
			$cmb->add_group_field( $group_field_id, array(
				'name' => __( 'Title', 'pegasus-bootstrap' ),
				'id'   => 'title',
				'type' => 'text',
			) );

			// Subtitle
			$cmb->add_group_field( $group_field_id, array(
				'name' => __( 'Subtitle', 'pegasus-bootstrap' ),
				'id'   => 'subtitle',
				'type' => 'text',
			) );

			// Paragraph
			$cmb->add_group_field( $group_field_id, array(
				'name' => __( 'Paragraph', 'pegasus-bootstrap' ),
				'id'   => 'paragraph',
				'type' => 'wysiwyg',
			) );

			// Button 1 Text
			$cmb->add_group_field( $group_field_id, array(
				'name' => __( 'Button 1 Text', 'pegasus-bootstrap' ),
				'id'   => 'button1_text',
				'type' => 'text',
			) );

			// Button 1 Link
			$cmb->add_group_field( $group_field_id, array(
				'name' => __( 'Button 1 Link', 'pegasus-bootstrap' ),
				'id'   => 'button1_link',
				'type' => 'text_url',
			) );
		}
	}
	add_action( 'cmb2_admin_init', 'cmb2_homepage_metabox' );

	/**
	 * Helper: normalize CMB2 file field (ID / array / URL) to a URL
	 */
	if ( ! function_exists( 'ulg_get_cmb2_image_url' ) ) {
		function ulg_get_cmb2_image_url( $value ) {

			if ( empty( $value ) ) {
				return '';
			}

			// CMB2 can give us an array with 'id' and/or 'url'
			if ( is_array( $value ) ) {
				if ( ! empty( $value['url'] ) ) {
					return esc_url( $value['url'] );
				}
				if ( ! empty( $value['id'] ) ) {
					$value = (int) $value['id'];
				}
			}

			// Attachment ID
			if ( is_numeric( $value ) ) {
				$src = wp_get_attachment_image_src( (int) $value, 'full' );
				if ( $src && ! empty( $src[0] ) ) {
					return esc_url( $src[0] );
				}
			}

			// Plain URL
			return esc_url( $value );
		}
	}


/*====================================================
 * Toast POS Menu Integration
 *
 * Fetches menu data from the Toast API via the vqdev-toast
 * plugin and transforms it into the format expected by the
 * theme's menu-tabs.php / menu-mobile.php templates.
 *===================================================*/

/**
 * Fetch out-of-stock item GUIDs from the Toast Stock API.
 *
 * Cached for 5 minutes.
 *
 * @return array Set of GUIDs that are OUT_OF_STOCK, keyed by GUID.
 */
function vqdev_toast_get_oos_guids() {

	$cached = get_transient( 'vqdev_toast_oos_guids' );
	if ( false !== $cached ) {
		return $cached;
	}

	$result = vqdev_toast()->stock()->get_inventory();
	$oos    = array();

	if ( $result['success'] && is_array( $result['data'] ) ) {
		foreach ( $result['data'] as $entry ) {
			if ( 'OUT_OF_STOCK' === ( $entry['status'] ?? '' ) ) {
				$oos[ $entry['guid'] ] = true;
			}
		}
	}

	set_transient( 'vqdev_toast_oos_guids', $oos, 5 * MINUTE_IN_SECONDS );

	return $oos;
}

/**
 * Check the Toast metadata endpoint to see if the menu has changed.
 *
 * @return bool True if the menu has changed since our last full fetch.
 */
function vqdev_toast_menu_has_changed() {

	$stored_timestamp = get_option( 'vqdev_toast_menu_last_updated', '' );

	$last_check = get_transient( 'vqdev_toast_metadata_checked' );
	if ( false !== $last_check ) {
		return false;
	}

	$meta = vqdev_toast()->menus()->get_metadata_v2();

	if ( ! $meta['success'] ) {
		return false;
	}

	$api_timestamp = $meta['data']['lastUpdated'] ?? '';

	set_transient( 'vqdev_toast_metadata_checked', 1, 10 * MINUTE_IN_SECONDS );

	if ( $api_timestamp !== $stored_timestamp ) {
		update_option( 'vqdev_toast_menu_last_updated', $api_timestamp, false );
		return true;
	}

	return false;
}

/**
 * Fetch and transform Toast menu data into the theme's tab/section/item format.
 *
 * @param array $skip_menus Menu names to exclude (default: ['Retail']).
 * @param bool  $hide_oos   If true, completely remove OOS items. If false, mark them.
 * @return array|null Theme-formatted menu data, or null on failure.
 */
function vqdev_toast_get_menu_data( $skip_menus = array( 'Retail' ), $hide_oos = false ) {

	if ( ! function_exists( 'vqdev_toast' ) ) {
		return null;
	}

	$cache_key = 'vqdev_toast_menu_data';
	$cached    = get_transient( $cache_key );

	if ( false !== $cached ) {
		if ( ! vqdev_toast_menu_has_changed() ) {
			return $cached;
		}
	}

	$result = vqdev_toast()->menus()->get_menus_v2();
	if ( ! $result['success'] || empty( $result['data']['menus'] ) ) {
		if ( false !== $cached ) {
			return $cached;
		}
		return null;
	}

	$api = $result['data'];

	$mod_groups  = array();
	$mod_options = array();

	if ( ! empty( $api['modifierGroupReferences'] ) ) {
		foreach ( $api['modifierGroupReferences'] as $ref ) {
			$mod_groups[ $ref['referenceId'] ] = $ref;
		}
	}
	if ( ! empty( $api['modifierOptionReferences'] ) ) {
		foreach ( $api['modifierOptionReferences'] as $ref ) {
			$mod_options[ $ref['referenceId'] ] = $ref;
		}
	}

	$oos_guids = vqdev_toast_get_oos_guids();

	$tabs = array();

	foreach ( $api['menus'] as $menu ) {
		if ( in_array( $menu['name'], $skip_menus, true ) ) {
			continue;
		}

		$tab = array(
			'id'          => sanitize_title( $menu['name'] ),
			'label'       => $menu['name'],
			'description' => ! empty( $menu['description'] ) ? $menu['description'] : '',
			'sections'    => array(),
			'footnotes'   => array(),
		);

		foreach ( $menu['menuGroups'] as $group ) {
			$has_subgroups = ! empty( $group['menuGroups'] );

			if ( ! empty( $group['menuItems'] ) ) {
				$tab['sections'][] = vqdev_toast_transform_group( $group, $mod_groups, $mod_options, $oos_guids, $hide_oos );
			}

			if ( $has_subgroups ) {
				foreach ( $group['menuGroups'] as $sub ) {
					if ( ! empty( $sub['menuItems'] ) ) {
						$tab['sections'][] = vqdev_toast_transform_group( $sub, $mod_groups, $mod_options, $oos_guids, $hide_oos );
					}
				}
			}
		}

		$tabs[] = $tab;
	}

	$last_updated = '';
	if ( ! empty( $api['lastUpdated'] ) ) {
		$ts = strtotime( $api['lastUpdated'] );
		if ( $ts ) {
			$last_updated = gmdate( 'Y-m-d', $ts );
		}
	}

	$menu_data = array(
		'restaurant_name' => 'Saltcellar',
		'updated'         => $last_updated,
		'tabs'            => $tabs,
	);

	if ( ! empty( $api['lastUpdated'] ) ) {
		update_option( 'vqdev_toast_menu_last_updated', $api['lastUpdated'], false );
		set_transient( 'vqdev_toast_metadata_checked', 1, 10 * MINUTE_IN_SECONDS );
	}

	set_transient( $cache_key, $menu_data, DAY_IN_SECONDS );

	return $menu_data;
}

/**
 * Transform a Toast menuGroup into a theme section.
 */
function vqdev_toast_transform_group( $group, $mod_groups, $mod_options, $oos_guids = array(), $hide_oos = false ) {

	$items = array();

	foreach ( $group['menuItems'] as $toast_item ) {
		$is_oos = isset( $oos_guids[ $toast_item['guid'] ?? '' ] );

		if ( $is_oos && $hide_oos ) {
			continue;
		}

		$theme_item = vqdev_toast_transform_item( $toast_item, $mod_groups, $mod_options );

		if ( $is_oos ) {
			$theme_item['out_of_stock'] = true;
		}

		$items[] = $theme_item;
	}

	return array(
		'title' => $group['name'] ?? '',
		'note'  => $group['description'] ?? '',
		'items' => $items,
	);
}

/**
 * Transform a single Toast menuItem into a theme item.
 */
function vqdev_toast_transform_item( $item, $mod_groups, $mod_options ) {

	$price  = '';
	$extras = array();

	if ( 'SIZE_PRICE' === ( $item['pricingStrategy'] ?? '' ) ) {
		$size_guid = $item['pricingRules']['sizeSpecificPricingGuid'] ?? '';
		if ( $size_guid ) {
			foreach ( $item['modifierGroupReferences'] ?? array() as $ref_id ) {
				if ( isset( $mod_groups[ $ref_id ] ) && $mod_groups[ $ref_id ]['guid'] === $size_guid ) {
					foreach ( $mod_groups[ $ref_id ]['modifierOptionReferences'] as $opt_ref_id ) {
						if ( isset( $mod_options[ $opt_ref_id ] ) ) {
							$opt = $mod_options[ $opt_ref_id ];
							$extras[] = array(
								'label' => $opt['name'],
								'price' => ( null !== $opt['price'] ) ? (string) $opt['price'] : '',
							);
						}
					}
					break;
				}
			}
		}
	} else {
		$price = ( null !== $item['price'] ) ? (string) $item['price'] : '';
	}

	$badges = array();
	if ( ! empty( $item['allergens'] ) ) {
		foreach ( $item['allergens'] as $allergen ) {
			$badges[] = $allergen;
		}
	}

	$image = ! empty( $item['image'] ) ? $item['image'] : '';

	return array(
		'name'         => $item['name'] ?? '',
		'description'  => $item['description'] ?? '',
		'price'        => $price,
		'badges'       => $badges,
		'spicy_level'  => 0,
		'extras'       => $extras,
		'image'        => $image,
		'out_of_stock' => false,
	);
}

/**
 * Shortcode: [toast_menu]
 */
function vqdev_toast_menu_shortcode( $atts ) {

	$atts = shortcode_atts( array(
		'skip' => 'Retail',
	), $atts, 'toast_menu' );

	$skip_menus = array_map( 'trim', explode( ',', $atts['skip'] ) );
	$menu_data  = vqdev_toast_get_menu_data( $skip_menus );

	if ( ! $menu_data || empty( $menu_data['tabs'] ) ) {
		return '<div class="alert alert-warning">Menu is currently unavailable. Please check back later.</div>';
	}

	if ( ! function_exists( 'vqmenu_money' ) ) {
		function vqmenu_money( $value ) {
			$num = is_numeric( $value ) ? number_format( (float) $value, 2, '.', '' ) : $value;
			if ( is_numeric( $value ) && fmod( (float) $value, 1.0 ) === 0.0 ) {
				$num = number_format( (float) $value, 0, '.', '' );
			}
			return '$' . $num;
		}
	}

	if ( ! function_exists( 'vqmenu_badge_class' ) ) {
		function vqmenu_badge_class( $label ) {
			$label = strtoupper( trim( (string) $label ) );
			return match ( $label ) {
				'V'     => 'vqmenu-badge vqmenu-badge--veg',
				'GF'    => 'vqmenu-badge vqmenu-badge--gf',
				'GF*'   => 'vqmenu-badge vqmenu-badge--gf',
				default => 'vqmenu-badge',
			};
		}
	}

	$theme_dir = get_stylesheet_directory();
	$theme_uri = get_stylesheet_directory_uri();
	$js_rel    = '/assets/restaurant-menu/restaurant-menu.js';
	if ( file_exists( $theme_dir . $js_rel ) ) {
		wp_enqueue_script( 'vq-restaurant-menu', $theme_uri . $js_rel, array(), filemtime( $theme_dir . $js_rel ), true );
	}

	$tabs = $menu_data['tabs'];

	ob_start();
	?>
	<div class="vqmenu">
		<header class="vqmenu-header mb-4">
			<?php if ( ! empty( $menu_data['restaurant_name'] ) ) : ?>
				<h2 class="vqmenu-title mb-1"><?php echo esc_html( $menu_data['restaurant_name'] ); ?></h2>
			<?php endif; ?>
			<?php if ( ! empty( $menu_data['updated'] ) ) : ?>
				<div class="vqmenu-meta text-muted">
					Updated: <?php echo esc_html( $menu_data['updated'] ); ?>
				</div>
			<?php endif; ?>
		</header>

		<div class="vqmenu-desktop">
			<?php include get_stylesheet_directory() . '/templates/menu-tabs.php'; ?>
		</div>

		<div class="vqmenu-mobile">
			<?php include get_stylesheet_directory() . '/templates/menu-mobile.php'; ?>
		</div>
	</div>
	<?php
	return ob_get_clean();
}
add_shortcode( 'toast_menu', 'vqdev_toast_menu_shortcode' );
