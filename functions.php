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

		wp_enqueue_style(
			'sugarpeddler-fonts',
			'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500;1,600&family=Outfit:wght@300;400;500;600;700&family=Caveat:wght@400;500;600&display=swap',
			array(),
			null
		);

		/* qTip CSS */
		//wp_enqueue_style('twentytwenty-css', get_stylesheet_directory_uri() . '/css/twentytwenty.css', null, false, false);

	}
	add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

	/**
	* Proper way to enqueue JS
	*/
	function pegasus_child_bootstrap_js() {

		wp_enqueue_script( 'pegasus_child_custom_js', get_stylesheet_directory_uri() . '/js/pegasus-custom.js', array(), '', true );

		//wp_enqueue_script( 'matchHeight_js', get_stylesheet_directory_uri() . '/js/jquery.matchHeight-min.js', array(), '', true );


	} //end function
	add_action( 'wp_enqueue_scripts', 'pegasus_child_bootstrap_js' );


	/**
	 * CMB2 — Home Page template fields.
	 * Registration + read helpers live in their own file. Every metabox is
	 * scoped to the "Home Page" template (tpl_home.php) only.
	 */
	require_once get_stylesheet_directory() . '/inc/cmb2-home-fields.php';

	/**
	 * Format a price value with leading $.
	 * Whole-dollar values render without decimals; otherwise two-decimal.
	 */
	if ( ! function_exists( 'vqmenu_money' ) ) {
		function vqmenu_money( $value ) {
			if ( ! is_numeric( $value ) ) {
				return $value;
			}
			$f = (float) $value;
			$num = ( fmod( $f, 1.0 ) === 0.0 )
				? number_format( $f, 0, '.', '' )
				: number_format( $f, 2, '.', '' );
			return '$' . $num;
		}
	}

	/**
	 * Map a menu badge label (V, GF, GF*) to its CSS class.
	 */
	if ( ! function_exists( 'vqmenu_badge_class' ) ) {
		function vqmenu_badge_class( $label ) {
			$label = strtoupper( trim( (string) $label ) );
			return match ( $label ) {
				'V'         => 'sp-menu-badge sp-menu-badge--veg',
				'GF', 'GF*' => 'sp-menu-badge sp-menu-badge--gf',
				default     => 'sp-menu-badge',
			};
		}
	}

	/*------------------------------------------------------------------
	 * Toast POS Menu – data layer (ported from theloftnew).
	 * Feeds tpl_menu.php via vqdev_toast_get_menu_data(). Requires the
	 * vqdev-toast plugin (menus:read). Stock/OOS degrades gracefully if
	 * the restaurant's grant lacks stock:read.
	 *-----------------------------------------------------------------*/

	/**
	 * Get out-of-stock item GUIDs from the Toast Stock API (cached 5 min).
	 * Returns an empty array if the plugin is absent or stock access is denied.
	 */
	if ( ! function_exists( 'vqdev_toast_get_oos_guids' ) ) {
		function vqdev_toast_get_oos_guids() {
			if ( ! function_exists( 'vqdev_toast' ) ) {
				return array();
			}

			$cached = get_transient( 'vqdev_toast_oos_guids' );
			if ( is_array( $cached ) ) {
				return $cached;
			}

			$response = vqdev_toast()->stock()->get_inventory();
			$guids    = array();
			if ( ! empty( $response['success'] ) && ! empty( $response['data'] ) ) {
				foreach ( $response['data'] as $stock_item ) {
					if ( isset( $stock_item['status'] ) && 'OUT_OF_STOCK' === $stock_item['status'] ) {
						$guids[] = $stock_item['guid'] ?? '';
					}
				}
			}

			set_transient( 'vqdev_toast_oos_guids', $guids, 5 * MINUTE_IN_SECONDS );
			return $guids;
		}
	}

	/**
	 * Check if Toast menu metadata has changed (throttled to once per 10 min).
	 */
	if ( ! function_exists( 'vqdev_toast_menu_has_changed' ) ) {
		function vqdev_toast_menu_has_changed() {
			if ( ! function_exists( 'vqdev_toast' ) ) {
				return false;
			}

			$last_check = get_transient( 'vqdev_toast_menu_meta_check' );
			if ( false !== $last_check ) {
				return false; // throttled
			}

			$meta = vqdev_toast()->menus()->get_metadata_v2();
			set_transient( 'vqdev_toast_menu_meta_check', time(), 10 * MINUTE_IN_SECONDS );

			if ( empty( $meta['success'] ) ) {
				return false;
			}

			$new_hash = md5( wp_json_encode( $meta['data'] ) );
			$old_hash = get_option( 'vqdev_toast_menu_meta_hash', '' );

			if ( $new_hash !== $old_hash ) {
				update_option( 'vqdev_toast_menu_meta_hash', $new_hash, false );
				return true;
			}

			return false;
		}
	}

	/**
	 * Get transformed menu data ready for the theme templates.
	 *
	 * @param array $skip_menus Menu names to skip (case-insensitive).
	 * @param bool  $hide_oos   If true, OOS items are removed instead of flagged.
	 * @return array|false Shape: [ 'restaurant_name', 'updated', 'tabs' => [...] ].
	 */
	if ( ! function_exists( 'vqdev_toast_get_menu_data' ) ) {
		function vqdev_toast_get_menu_data( $skip_menus = array(), $hide_oos = false ) {
			if ( ! function_exists( 'vqdev_toast' ) ) {
				return false;
			}

			// Smart cache: invalidate if metadata changed.
			if ( vqdev_toast_menu_has_changed() ) {
				delete_transient( 'vqdev_toast_menu_data' );
			}

			$cached = get_transient( 'vqdev_toast_menu_data' );
			if ( is_array( $cached ) ) {
				return $cached;
			}

			$menus_response = vqdev_toast()->menus()->get_menus_v2();
			if ( empty( $menus_response['success'] ) || empty( $menus_response['data'] ) ) {
				return false;
			}

			$oos_guids  = vqdev_toast_get_oos_guids();
			$api_data   = $menus_response['data'];
			$raw_menus  = isset( $api_data['menus'] ) ? $api_data['menus'] : $api_data;
			$tabs       = array();
			$skip_lower = array_map( 'strtolower', $skip_menus );

			// Build global lookup maps for modifier groups and options.
			$mod_groups  = array();
			$mod_options = array();
			foreach ( $raw_menus as $menu ) {
				if ( ! empty( $menu['modifierGroups'] ) ) {
					foreach ( $menu['modifierGroups'] as $mg ) {
						$mg_guid = $mg['guid'] ?? '';
						if ( $mg_guid ) {
							$mod_groups[ $mg_guid ] = $mg;
						}
					}
				}
				if ( ! empty( $menu['modifierOptions'] ) ) {
					foreach ( $menu['modifierOptions'] as $mo ) {
						$mo_guid = $mo['guid'] ?? '';
						if ( $mo_guid ) {
							$mod_options[ $mo_guid ] = $mo;
						}
					}
				}
			}

			foreach ( $raw_menus as $menu ) {
				$menu_name = $menu['name'] ?? 'Menu';
				if ( in_array( strtolower( $menu_name ), $skip_lower, true ) ) {
					continue;
				}

				$sections = array();
				foreach ( $menu['menuGroups'] ?? array() as $group ) {
					$section = vqdev_toast_transform_group( $group, $mod_groups, $mod_options, $oos_guids, $hide_oos );
					if ( $section ) {
						$sections[] = $section;
					}
				}

				if ( empty( $sections ) ) {
					continue;
				}

				$tabs[] = array(
					'id'          => sanitize_title( $menu_name ),
					'label'       => $menu_name,
					'description' => '',
					'sections'    => $sections,
					'footnotes'   => array(),
				);
			}

			if ( empty( $tabs ) ) {
				return false;
			}

			$data = array(
				'restaurant_name' => 'Sugar Peddler',
				'updated'         => gmdate( 'M j, Y g:ia' ),
				'tabs'            => $tabs,
			);

			set_transient( 'vqdev_toast_menu_data', $data, DAY_IN_SECONDS );
			return $data;
		}
	}

	/**
	 * Transform a Toast menuGroup into a theme section.
	 */
	if ( ! function_exists( 'vqdev_toast_transform_group' ) ) {
		function vqdev_toast_transform_group( $group, $mod_groups, $mod_options, $oos_guids, $hide_oos ) {
			$items = array();

			foreach ( $group['menuItems'] ?? array() as $raw_item ) {
				$item = vqdev_toast_transform_item( $raw_item, $mod_groups, $mod_options );
				if ( ! $item ) {
					continue;
				}

				$is_oos = in_array( $raw_item['guid'] ?? '', $oos_guids, true );
				if ( $is_oos && $hide_oos ) {
					continue;
				}

				$item['out_of_stock'] = $is_oos;
				$items[]              = $item;
			}

			if ( empty( $items ) ) {
				return null;
			}

			return array(
				'title' => $group['name'] ?? '',
				'note'  => $group['description'] ?? '',
				'items' => $items,
			);
		}
	}

	/**
	 * Transform a Toast menuItem into a theme item.
	 */
	if ( ! function_exists( 'vqdev_toast_transform_item' ) ) {
		function vqdev_toast_transform_item( $item, $mod_groups, $mod_options ) {
			$name   = $item['name'] ?? '';
			$desc   = $item['description'] ?? '';
			$price  = '';
			$extras = array();

			if ( isset( $item['price'] ) && '' !== $item['price'] && null !== $item['price'] ) {
				$price = (string) $item['price'];
			}

			// SIZE_PRICE modifier groups → "Options" extras.
			if ( ! empty( $item['modifierGroupReferences'] ) ) {
				foreach ( $item['modifierGroupReferences'] as $mgr ) {
					$mg_guid = $mgr['guid'] ?? '';
					if ( ! $mg_guid || ! isset( $mod_groups[ $mg_guid ] ) ) {
						continue;
					}
					$mg = $mod_groups[ $mg_guid ];
					if ( 'SIZE_PRICE' === ( $mg['pricingMode'] ?? '' ) && ! empty( $mg['modifierOptionReferences'] ) ) {
						foreach ( $mg['modifierOptionReferences'] as $mor ) {
							$mo_guid = $mor['guid'] ?? '';
							if ( ! $mo_guid || ! isset( $mod_options[ $mo_guid ] ) ) {
								continue;
							}
							$mo       = $mod_options[ $mo_guid ];
							$extras[] = array(
								'label' => $mo['name'] ?? '',
								'price' => isset( $mo['price'] ) ? (string) $mo['price'] : '',
							);
						}
						if ( ! empty( $extras ) ) {
							$price = ''; // base price replaced by size options
						}
					}
				}
			}

			return array(
				'name'        => $name,
				'fr'          => '',
				'description' => $desc,
				'price'       => $price,
				'badges'      => array(),
				'spicy_level' => 0,
				'extras'      => $extras,
			);
		}
	}

	/**
	 * [toast_menu] shortcode — renders the same tabs/mobile templates as tpl_menu.php.
	 * Usage: [toast_menu skip="Retail,Catering" hide_oos="yes"]
	 */
	if ( ! function_exists( 'vqdev_toast_menu_shortcode' ) ) {
		function vqdev_toast_menu_shortcode( $atts ) {
			$atts = shortcode_atts(
				array(
					'skip'     => '',
					'hide_oos' => 'no',
				),
				$atts,
				'toast_menu'
			);

			$skip_menus = array_filter( array_map( 'trim', explode( ',', $atts['skip'] ) ) );
			$hide_oos   = in_array( strtolower( $atts['hide_oos'] ), array( 'yes', 'true', '1' ), true );
			$menu_data  = vqdev_toast_get_menu_data( $skip_menus, $hide_oos );

			if ( ! $menu_data || empty( $menu_data['tabs'] ) ) {
				return '<div class="alert alert-warning">Menu is currently unavailable. Please check back later.</div>';
			}

			$tabs = $menu_data['tabs'];
			ob_start();
			echo '<div class="sp-menu__desktop d-none d-lg-block">';
			include get_stylesheet_directory() . '/templates/menu-tabs.php';
			echo '</div><div class="sp-menu__mobile d-lg-none">';
			include get_stylesheet_directory() . '/templates/menu-mobile.php';
			echo '</div>';
			return ob_get_clean();
		}
	}
	add_shortcode( 'toast_menu', 'vqdev_toast_menu_shortcode' );
