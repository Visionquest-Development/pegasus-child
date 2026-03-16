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
		wp_enqueue_script( 'images-loaded-js' );
		wp_enqueue_script( 'packery-js' );

		wp_enqueue_script( 'pegasus_child_custom_js', get_stylesheet_directory_uri() . '/js/pegasus-custom.js', array(), '', true );

		//wp_enqueue_script( 'matchHeight_js', get_stylesheet_directory_uri() . '/js/matchHeight.js', array(), '', true );
		wp_enqueue_script( 'pegasus_packery_js', get_stylesheet_directory_uri() . '/js/packery.js', array(), '', true );

		/* Lightbox2 */
		wp_enqueue_style( 'lightbox2-css', get_stylesheet_directory_uri() . '/css/lightbox.min.css', array(), '2.11.4' );
		wp_enqueue_script( 'lightbox2-js', get_stylesheet_directory_uri() . '/js/lightbox.min.js', array( 'jquery' ), '2.11.4', true );

	} //end function
	add_action( 'wp_enqueue_scripts', 'pegasus_child_bootstrap_js' );

	function pegasus_child_admin_css() {
		wp_enqueue_style( 'pegasus-child-admin-css', get_stylesheet_directory_uri() . '/admin.css', array(), '1.0.0' );
	}
	add_action( 'admin_enqueue_scripts', 'pegasus_child_admin_css' );

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

	/**
	 * Disable WooCommerce product reviews completely
	 */

	 add_filter('woocommerce_product_tabs', function($tabs) {
		unset($tabs['reviews']);
		return $tabs;
	}, 98);

	add_filter('woocommerce_enable_reviews', '__return_false');
	add_filter('woocommerce_enable_review_rating', '__return_false');

	remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);

	add_filter('comments_open', function($open, $post_id) {
		if (get_post_type($post_id) === 'product') {
			return false;
		}
		return $open;
	}, 10, 2);

	/**
	 * ======================================================
	 * Ticket Report – AJAX handlers & script enqueue
	 * ======================================================
	 */

	/**
	 * Strip WooCommerce HTML price markup down to a plain number.
	 * e.g. '<span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">&#36;</span>10.00</bdi></span>'  →  '10.00'
	 */
	function tr_clean_price( $raw ) {
		// Decode HTML entities, strip tags, remove currency symbols and whitespace
		$clean = html_entity_decode( $raw, ENT_QUOTES, 'UTF-8' );
		$clean = strip_tags( $clean );
		$clean = preg_replace( '/[^\d.]/', '', $clean );
		return $clean !== '' ? $clean : '0.00';
	}

	/**
	 * Enqueue ticket report JS only on the Ticket Report template
	 */
	function tr_enqueue_ticket_report_assets() {
		if ( ! is_page_template( 'tpl_ticket_report.php' ) ) {
			return;
		}

		wp_enqueue_script(
			'ticket-report-js',
			get_stylesheet_directory_uri() . '/js/ticket-report.js',
			array( 'jquery' ),
			filemtime( get_stylesheet_directory() . '/js/ticket-report.js' ),
			true
		);

		wp_localize_script( 'ticket-report-js', 'ticketReport', array(
			'ajax_url'  => admin_url( 'admin-ajax.php' ),
			'nonce'     => wp_create_nonce( 'ticket_report_nonce' ),
			'order_url' => admin_url( 'admin.php?page=wc-orders&action=edit&id=' ),
			'ticket_url' => admin_url( 'post.php?action=edit&post=' ),
		) );
	}
	add_action( 'wp_enqueue_scripts', 'tr_enqueue_ticket_report_assets' );

	/**
	 * AJAX: Get all events that have tickets
	 */
	function tr_get_events() {
		check_ajax_referer( 'ticket_report_nonce', 'nonce' );

		if ( ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error( 'Unauthorized' );
		}

		global $wpdb;

		$orders_table = $wpdb->prefix . 'wc_orders';

		$results = $wpdb->get_results( "
			SELECT
				pm.meta_value AS product_id,
				p.post_title  AS event_name,
				COUNT( t.ID )  AS ticket_count
			FROM {$wpdb->postmeta} pm
			INNER JOIN {$wpdb->posts} t
				ON pm.post_id = t.ID
				AND t.post_type   = 'event_magic_tickets'
				AND t.post_status = 'publish'
			INNER JOIN {$wpdb->posts} p
				ON pm.meta_value = p.ID
			INNER JOIN {$wpdb->postmeta} pm_order
				ON t.ID = pm_order.post_id
				AND pm_order.meta_key = 'WooCommerceEventsOrderID'
			INNER JOIN {$orders_table} o
				ON pm_order.meta_value = o.id
				AND o.status NOT IN ( 'wc-refunded', 'wc-cancelled', 'wc-failed' )
			WHERE pm.meta_key = 'WooCommerceEventsProductID'
			GROUP BY pm.meta_value, p.post_title
			ORDER BY p.post_title ASC
		" );

		wp_send_json_success( $results );
	}
	add_action( 'wp_ajax_tr_get_events', 'tr_get_events' );

	/**
	 * AJAX: Get all tickets for a specific event
	 */
	function tr_get_event_tickets() {
		check_ajax_referer( 'ticket_report_nonce', 'nonce' );

		if ( ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error( 'Unauthorized' );
		}

		$product_id = absint( $_POST['product_id'] );
		if ( ! $product_id ) {
			wp_send_json_error( 'Invalid product ID' );
		}

		global $wpdb;

		$event_name = get_the_title( $product_id );

		$orders_table = $wpdb->prefix . 'wc_orders';

		$tickets = $wpdb->get_results( $wpdb->prepare( "
			SELECT
				t.ID AS ticket_id,
				MAX( CASE WHEN pm.meta_key = 'WooCommerceEventsAttendeeName'          THEN pm.meta_value END ) AS first_name,
				MAX( CASE WHEN pm.meta_key = 'WooCommerceEventsAttendeeLastName'      THEN pm.meta_value END ) AS last_name,
				MAX( CASE WHEN pm.meta_key = 'WooCommerceEventsAttendeeEmail'         THEN pm.meta_value END ) AS email,
				MAX( CASE WHEN pm.meta_key = 'WooCommerceEventsPurchaserFirstName'    THEN pm.meta_value END ) AS purchaser_first,
				MAX( CASE WHEN pm.meta_key = 'WooCommerceEventsPurchaserLastName'     THEN pm.meta_value END ) AS purchaser_last,
				MAX( CASE WHEN pm.meta_key = 'WooCommerceEventsPurchaserEmail'        THEN pm.meta_value END ) AS purchaser_email,
				MAX( CASE WHEN pm.meta_key = 'WooCommerceEventsPrice'                 THEN pm.meta_value END ) AS price,
				MAX( CASE WHEN pm.meta_key = 'WooCommerceEventsOrderID'               THEN pm.meta_value END ) AS order_id,
				MAX( CASE WHEN pm.meta_key = 'WooCommerceEventsStatus'                THEN pm.meta_value END ) AS status,
				MAX( CASE WHEN pm.meta_key = 'WooCommerceEventsTicketType'            THEN pm.meta_value END ) AS ticket_type,
				o.date_created_gmt AS order_date
			FROM {$wpdb->posts} t
			INNER JOIN {$wpdb->postmeta} pm
				ON t.ID = pm.post_id
			INNER JOIN {$wpdb->postmeta} pm_event
				ON t.ID = pm_event.post_id
				AND pm_event.meta_key   = 'WooCommerceEventsProductID'
				AND pm_event.meta_value = %s
			INNER JOIN {$wpdb->postmeta} pm_order
				ON t.ID = pm_order.post_id
				AND pm_order.meta_key = 'WooCommerceEventsOrderID'
			INNER JOIN {$orders_table} o
				ON pm_order.meta_value = o.id
				AND o.status NOT IN ( 'wc-refunded', 'wc-cancelled', 'wc-failed' )
			WHERE t.post_type   = 'event_magic_tickets'
			  AND t.post_status = 'publish'
			GROUP BY t.ID
			ORDER BY order_id DESC, last_name ASC
		", $product_id ) );

		// Clean up individual tickets and group by order
		$total_revenue = 0;
		$grouped = array();

		foreach ( $tickets as $ticket ) {
			$ticket->price = tr_clean_price( $ticket->price );
			$total_revenue += floatval( $ticket->price );

			if ( empty( $ticket->first_name ) ) {
				$ticket->first_name = $ticket->purchaser_first;
			}
			if ( empty( $ticket->last_name ) ) {
				$ticket->last_name = $ticket->purchaser_last;
			}
			if ( empty( $ticket->email ) ) {
				$ticket->email = $ticket->purchaser_email;
			}

			$oid = $ticket->order_id;
			if ( ! isset( $grouped[ $oid ] ) ) {
				// Convert GMT to site timezone for display
				$date_local = get_date_from_gmt( $ticket->order_date, 'M j, Y g:ia' );

				$grouped[ $oid ] = array(
					'order_id'        => $oid,
					'first_name'      => $ticket->first_name,
					'last_name'       => $ticket->last_name,
					'email'           => $ticket->email,
					'purchaser_first' => $ticket->purchaser_first,
					'purchaser_last'  => $ticket->purchaser_last,
					'ticket_type'     => $ticket->ticket_type,
					'order_date'      => $date_local,
					'qty'             => 0,
					'total_price'     => 0,
					'tickets'         => array(),
				);
			}
			$grouped[ $oid ]['qty']++;
			$grouped[ $oid ]['total_price'] += floatval( $ticket->price );
			$grouped[ $oid ]['tickets'][] = array(
				'ticket_id' => $ticket->ticket_id,
				'status'    => $ticket->status,
			);
		}

		// Re-index and format totals
		$orders = array_values( $grouped );
		foreach ( $orders as &$order ) {
			$order['total_price'] = number_format( $order['total_price'], 2 );
		}

		wp_send_json_success( array(
			'event_name'    => html_entity_decode( $event_name, ENT_QUOTES, 'UTF-8' ),
			'orders'        => $orders,
			'total_tickets' => count( $tickets ),
			'total_orders'  => count( $orders ),
			'total_revenue' => number_format( $total_revenue, 2 ),
		) );
	}
	add_action( 'wp_ajax_tr_get_event_tickets', 'tr_get_event_tickets' );

	/**
	 * AJAX: Search for a customer by name or email across all tickets
	 */
	function tr_search_customer() {
		check_ajax_referer( 'ticket_report_nonce', 'nonce' );

		if ( ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error( 'Unauthorized' );
		}

		$query = sanitize_text_field( $_POST['query'] );
		if ( strlen( $query ) < 2 ) {
			wp_send_json_error( 'Query too short' );
		}

		global $wpdb;

		$like = '%' . $wpdb->esc_like( $query ) . '%';
		$orders_table = $wpdb->prefix . 'wc_orders';

		// Find ticket IDs that match the search (attendee or purchaser name/email)
		// Excludes tickets from refunded / cancelled / failed orders
		$ticket_ids = $wpdb->get_col( $wpdb->prepare( "
			SELECT DISTINCT pm.post_id
			FROM {$wpdb->postmeta} pm
			INNER JOIN {$wpdb->posts} t
				ON pm.post_id = t.ID
				AND t.post_type   = 'event_magic_tickets'
				AND t.post_status = 'publish'
			INNER JOIN {$wpdb->postmeta} pm_order
				ON t.ID = pm_order.post_id
				AND pm_order.meta_key = 'WooCommerceEventsOrderID'
			INNER JOIN {$orders_table} o
				ON pm_order.meta_value = o.id
				AND o.status NOT IN ( 'wc-refunded', 'wc-cancelled', 'wc-failed' )
			WHERE pm.meta_key IN (
				'WooCommerceEventsAttendeeName',
				'WooCommerceEventsAttendeeLastName',
				'WooCommerceEventsAttendeeEmail',
				'WooCommerceEventsPurchaserFirstName',
				'WooCommerceEventsPurchaserLastName',
				'WooCommerceEventsPurchaserEmail'
			)
			AND pm.meta_value LIKE %s
			LIMIT 500
		", $like ) );

		if ( empty( $ticket_ids ) ) {
			wp_send_json_success( array() );
		}

		$placeholders = implode( ',', array_fill( 0, count( $ticket_ids ), '%d' ) );

		// phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
		$tickets = $wpdb->get_results( $wpdb->prepare( "
			SELECT
				t.ID AS ticket_id,
				MAX( CASE WHEN pm.meta_key = 'WooCommerceEventsAttendeeName'          THEN pm.meta_value END ) AS first_name,
				MAX( CASE WHEN pm.meta_key = 'WooCommerceEventsAttendeeLastName'      THEN pm.meta_value END ) AS last_name,
				MAX( CASE WHEN pm.meta_key = 'WooCommerceEventsAttendeeEmail'         THEN pm.meta_value END ) AS email,
				MAX( CASE WHEN pm.meta_key = 'WooCommerceEventsPurchaserFirstName'    THEN pm.meta_value END ) AS purchaser_first,
				MAX( CASE WHEN pm.meta_key = 'WooCommerceEventsPurchaserLastName'     THEN pm.meta_value END ) AS purchaser_last,
				MAX( CASE WHEN pm.meta_key = 'WooCommerceEventsPurchaserEmail'        THEN pm.meta_value END ) AS purchaser_email,
				MAX( CASE WHEN pm.meta_key = 'WooCommerceEventsPrice'                 THEN pm.meta_value END ) AS price,
				MAX( CASE WHEN pm.meta_key = 'WooCommerceEventsOrderID'               THEN pm.meta_value END ) AS order_id,
				MAX( CASE WHEN pm.meta_key = 'WooCommerceEventsStatus'                THEN pm.meta_value END ) AS status,
				MAX( CASE WHEN pm.meta_key = 'WooCommerceEventsTicketType'            THEN pm.meta_value END ) AS ticket_type,
				MAX( CASE WHEN pm.meta_key = 'WooCommerceEventsProductID'             THEN pm.meta_value END ) AS product_id,
				o.date_created_gmt AS order_date
			FROM {$wpdb->posts} t
			INNER JOIN {$wpdb->postmeta} pm ON t.ID = pm.post_id
			INNER JOIN {$wpdb->postmeta} pm_ord
				ON t.ID = pm_ord.post_id
				AND pm_ord.meta_key = 'WooCommerceEventsOrderID'
			INNER JOIN {$orders_table} o
				ON pm_ord.meta_value = o.id
			WHERE t.ID IN ($placeholders)
			GROUP BY t.ID
			ORDER BY last_name ASC, first_name ASC
		", ...$ticket_ids ) );

		// Resolve event names, clean prices, fill in attendee, and group by order + event
		$grouped = array();

		foreach ( $tickets as $ticket ) {
			$ticket->event_name = $ticket->product_id ? html_entity_decode( get_the_title( $ticket->product_id ), ENT_QUOTES, 'UTF-8' ) : '';
			$ticket->price = tr_clean_price( $ticket->price );

			if ( empty( $ticket->first_name ) ) {
				$ticket->first_name = $ticket->purchaser_first;
			}
			if ( empty( $ticket->last_name ) ) {
				$ticket->last_name = $ticket->purchaser_last;
			}
			if ( empty( $ticket->email ) ) {
				$ticket->email = $ticket->purchaser_email;
			}

			$key = $ticket->order_id . '_' . $ticket->product_id;
			if ( ! isset( $grouped[ $key ] ) ) {
				$date_local = get_date_from_gmt( $ticket->order_date, 'M j, Y g:ia' );

				$grouped[ $key ] = array(
					'order_id'        => $ticket->order_id,
					'event_name'      => $ticket->event_name,
					'first_name'      => $ticket->first_name,
					'last_name'       => $ticket->last_name,
					'email'           => $ticket->email,
					'purchaser_first' => $ticket->purchaser_first,
					'purchaser_last'  => $ticket->purchaser_last,
					'ticket_type'     => $ticket->ticket_type,
					'order_date'      => $date_local,
					'qty'             => 0,
					'total_price'     => 0,
					'tickets'         => array(),
				);
			}
			$grouped[ $key ]['qty']++;
			$grouped[ $key ]['total_price'] += floatval( $ticket->price );
			$grouped[ $key ]['tickets'][] = array(
				'ticket_id' => $ticket->ticket_id,
				'status'    => $ticket->status,
			);
		}

		$orders = array_values( $grouped );
		foreach ( $orders as &$order ) {
			$order['total_price'] = number_format( $order['total_price'], 2 );
		}

		wp_send_json_success( $orders );
	}
	add_action( 'wp_ajax_tr_search_customer', 'tr_search_customer' );

	/**
	 * AJAX: Toggle check-in status for a ticket
	 *
	 * Updates the WooCommerceEventsStatus post meta AND inserts
	 * a row into the wp_fooevents_check_in audit table (matching
	 * exactly how FooEvents itself records check-ins).
	 */
	function tr_toggle_checkin() {
		check_ajax_referer( 'ticket_report_nonce', 'nonce' );

		if ( ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error( 'Unauthorized' );
		}

		$ticket_id = absint( $_POST['ticket_id'] );
		if ( ! $ticket_id ) {
			wp_send_json_error( 'Invalid ticket ID' );
		}

		global $wpdb;

		$current_status = get_post_meta( $ticket_id, 'WooCommerceEventsStatus', true );
		$new_status     = ( $current_status === 'Checked In' ) ? 'Not Checked In' : 'Checked In';

		// 1. Update the ticket post meta
		update_post_meta( $ticket_id, 'WooCommerceEventsStatus', $new_status );

		// 2. Get the event (product) ID for the audit log
		$event_id = get_post_meta( $ticket_id, 'WooCommerceEventsProductID', true );

		// 3. Insert into the FooEvents check-in audit table
		$table = $wpdb->prefix . 'fooevents_check_in';
		$wpdb->insert( $table, array(
			'tid'     => $ticket_id,
			'eid'     => absint( $event_id ),
			'day'     => 1,
			'uid'     => get_current_user_id(),
			'status'  => $new_status,
			'checkin' => time(),
		), array( '%d', '%d', '%d', '%d', '%s', '%d' ) );

		wp_send_json_success( array(
			'ticket_id'  => $ticket_id,
			'new_status' => $new_status,
		) );
	}
	add_action( 'wp_ajax_tr_toggle_checkin', 'tr_toggle_checkin' );

	/*------------------------------------------------------------------
	 * Toast POS Menu – helper functions
	 *-----------------------------------------------------------------*/

	/**
	 * Get out-of-stock item GUIDs from Toast Stock API (cached 5 min).
	 */
	function vqdev_toast_get_oos_guids() {
		$cached = get_transient( 'vqdev_toast_oos_guids' );
		if ( is_array( $cached ) ) {
			return $cached;
		}

		$response = vqdev_toast()->stock()->get_inventory();
		$guids    = [];
		if ( ! empty( $response['success'] ) && ! empty( $response['data'] ) ) {
			foreach ( $response['data'] as $stock_item ) {
				if ( isset( $stock_item['status'] ) && $stock_item['status'] === 'OUT_OF_STOCK' ) {
					$guids[] = $stock_item['guid'] ?? '';
				}
			}
		}

		set_transient( 'vqdev_toast_oos_guids', $guids, 5 * MINUTE_IN_SECONDS );
		return $guids;
	}

	/**
	 * Check if Toast menu metadata has changed (throttled to once per 10 min).
	 * Returns true if the menu has changed since our last cached version.
	 */
	function vqdev_toast_menu_has_changed() {
		$last_check = get_transient( 'vqdev_toast_menu_meta_check' );
		if ( $last_check !== false ) {
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

	/**
	 * Get transformed menu data ready for theme templates.
	 *
	 * @param array  $skip_menus Array of menu names to skip (case-insensitive).
	 * @param bool   $hide_oos   If true, OOS items are removed instead of flagged.
	 * @return array|false
	 */
	function vqdev_toast_get_menu_data( $skip_menus = [], $hide_oos = false ) {
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

		$oos_guids = vqdev_toast_get_oos_guids();
		// Handle both flat array and wrapper object {menus: [...]}.
		$api_data  = $menus_response['data'];
		$raw_menus = isset( $api_data['menus'] ) ? $api_data['menus'] : $api_data;
		$tabs      = [];
		$skip_lower = array_map( 'strtolower', $skip_menus );

		// Build global lookup maps for modifier groups and options.
		$mod_groups  = [];
		$mod_options = [];
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

			$tab_id   = sanitize_title( $menu_name );
			$sections = [];
			$footnotes = [];

			foreach ( $menu['menuGroups'] ?? [] as $group ) {
				$section = vqdev_toast_transform_group( $group, $mod_groups, $mod_options, $oos_guids, $hide_oos );
				if ( $section ) {
					$sections[] = $section;
				}
			}

			if ( empty( $sections ) ) {
				continue;
			}

			$tabs[] = [
				'id'          => $tab_id,
				'label'       => $menu_name,
				'description' => '',
				'sections'    => $sections,
				'footnotes'   => $footnotes,
			];
		}

		if ( empty( $tabs ) ) {
			return false;
		}

		$data = [
			'restaurant_name' => 'The Loft',
			'updated'         => gmdate( 'M j, Y g:ia' ),
			'tabs'            => $tabs,
		];

		set_transient( 'vqdev_toast_menu_data', $data, DAY_IN_SECONDS );
		return $data;
	}

	/**
	 * Transform a Toast menuGroup into a theme section.
	 */
	function vqdev_toast_transform_group( $group, $mod_groups, $mod_options, $oos_guids, $hide_oos ) {
		$title = $group['name'] ?? '';
		$note  = $group['description'] ?? '';
		$items = [];

		foreach ( $group['menuItems'] ?? [] as $raw_item ) {
			$item = vqdev_toast_transform_item( $raw_item, $mod_groups, $mod_options );
			if ( ! $item ) {
				continue;
			}

			$item_guid = $raw_item['guid'] ?? '';
			$is_oos    = in_array( $item_guid, $oos_guids, true );

			if ( $is_oos && $hide_oos ) {
				continue;
			}

			$item['out_of_stock'] = $is_oos;
			$items[] = $item;
		}

		if ( empty( $items ) ) {
			return null;
		}

		return [
			'title' => $title,
			'note'  => $note,
			'items' => $items,
		];
	}

	/**
	 * Transform a Toast menuItem into a theme item.
	 */
	function vqdev_toast_transform_item( $item, $mod_groups, $mod_options ) {
		$name  = $item['name'] ?? '';
		$desc  = $item['description'] ?? '';
		$price = '';
		$image = '';
		$badges = [];
		$spicy  = 0;
		$extras = [];

		// Price.
		if ( isset( $item['price'] ) && $item['price'] !== '' && $item['price'] !== null ) {
			$price = (string) $item['price'];
		}

		// Image.
		if ( ! empty( $item['imagePath'] ) ) {
			$image = 'https://cdn.toasttab.com/' . ltrim( $item['imagePath'], '/' );
		} elseif ( ! empty( $item['imageUrl'] ) ) {
			$image = $item['imageUrl'];
		}

		// SIZE_PRICE modifier groups → extras.
		if ( ! empty( $item['modifierGroupReferences'] ) ) {
			foreach ( $item['modifierGroupReferences'] as $mgr ) {
				$mg_guid = $mgr['guid'] ?? '';
				if ( ! $mg_guid || ! isset( $mod_groups[ $mg_guid ] ) ) {
					continue;
				}
				$mg = $mod_groups[ $mg_guid ];
				$pricing_mode = $mg['pricingMode'] ?? '';

				if ( $pricing_mode === 'SIZE_PRICE' && ! empty( $mg['modifierOptionReferences'] ) ) {
					foreach ( $mg['modifierOptionReferences'] as $mor ) {
						$mo_guid = $mor['guid'] ?? '';
						if ( ! $mo_guid || ! isset( $mod_options[ $mo_guid ] ) ) {
							continue;
						}
						$mo = $mod_options[ $mo_guid ];
						$extras[] = [
							'label' => $mo['name'] ?? '',
							'price' => isset( $mo['price'] ) ? (string) $mo['price'] : '',
						];
					}
					// Clear the base price when SIZE_PRICE options exist.
					if ( ! empty( $extras ) ) {
						$price = '';
					}
				}
			}
		}

		return [
			'name'        => $name,
			'description' => $desc,
			'price'       => $price,
			'image'       => $image,
			'badges'      => $badges,
			'spicy_level' => $spicy,
			'extras'      => $extras,
		];
	}

	/**
	 * [toast_menu] shortcode.
	 * Usage: [toast_menu skip="Retail,Catering"]
	 */
	function vqdev_toast_menu_shortcode( $atts ) {
		$atts = shortcode_atts( [
			'skip'     => '',
			'hide_oos' => 'no',
		], $atts, 'toast_menu' );

		$skip_menus = array_filter( array_map( 'trim', explode( ',', $atts['skip'] ) ) );
		$hide_oos   = in_array( strtolower( $atts['hide_oos'] ), [ 'yes', 'true', '1' ], true );
		$menu_data  = vqdev_toast_get_menu_data( $skip_menus, $hide_oos );

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

		$tabs = $menu_data['tabs'];
		$theme_dir = get_stylesheet_directory();
		$theme_uri = get_stylesheet_directory_uri();
		$js_rel    = '/assets/restaurant-menu/restaurant-menu.js';
		if ( file_exists( $theme_dir . $js_rel ) ) {
			wp_enqueue_script( 'vq-restaurant-menu', $theme_uri . $js_rel, [], filemtime( $theme_dir . $js_rel ), true );
		}

		ob_start();
		?>
		<div class="vqmenu">
			<header class="vqmenu-header mb-4">
				<?php if ( ! empty( $menu_data['restaurant_name'] ) ) : ?>
					<h1 class="vqmenu-title mb-1"><?php echo esc_html( $menu_data['restaurant_name'] ); ?></h1>
				<?php endif; ?>
				<?php if ( ! empty( $menu_data['updated'] ) ) : ?>
					<div class="vqmenu-meta text-muted">Updated: <?php echo esc_html( $menu_data['updated'] ); ?></div>
				<?php endif; ?>
			</header>

			<div class="vqmenu-desktop">
				<?php include $theme_dir . '/templates/menu-tabs.php'; ?>
			</div>

			<div class="vqmenu-mobile">
				<?php include $theme_dir . '/templates/menu-mobile.php'; ?>
			</div>
		</div>
		<?php
		return ob_get_clean();
	}
	add_shortcode( 'toast_menu', 'vqdev_toast_menu_shortcode' );

	/*------------------------------------------------------------------
	 * WooCommerce Products list – FooEvents "Event Date" column
	 *-----------------------------------------------------------------*/

	/**
	 * Add "Event Date" column to WooCommerce Products admin list.
	 */
	function ulg_add_event_date_product_column( $columns ) {
		$new_columns = [];
		foreach ( $columns as $key => $label ) {
			$new_columns[ $key ] = $label;
			if ( $key === 'date' ) {
				$new_columns['event_date'] = __( 'Event Date', 'pegasus-bootstrap' );
			}
		}
		return $new_columns;
	}
	add_filter( 'manage_edit-product_columns', 'ulg_add_event_date_product_column' );

	/**
	 * Populate the "Event Date" column content.
	 */
	function ulg_render_event_date_product_column( $column, $post_id ) {
		if ( $column !== 'event_date' ) {
			return;
		}

		$event_date = get_post_meta( $post_id, 'WooCommerceEventsDate', true );

		if ( ! empty( $event_date ) ) {
			$timestamp = strtotime( $event_date );
			echo esc_html( $timestamp ? date_i18n( 'M j, Y', $timestamp ) : $event_date );
		} else {
			echo '&mdash;';
		}
	}
	add_action( 'manage_product_posts_custom_column', 'ulg_render_event_date_product_column', 10, 2 );

	/**
	 * Make the "Event Date" column sortable.
	 */
	function ulg_event_date_column_sortable( $columns ) {
		$columns['event_date'] = 'event_date';
		return $columns;
	}
	add_filter( 'manage_edit-product_sortable_columns', 'ulg_event_date_column_sortable' );

	/**
	 * Handle sorting by event date.
	 */
	function ulg_event_date_column_orderby( $query ) {
		if ( ! is_admin() || ! $query->is_main_query() ) {
			return;
		}

		if ( $query->get( 'orderby' ) === 'event_date' ) {
			$query->set( 'meta_key', 'WooCommerceEventsDate' );
			$query->set( 'orderby', 'meta_value' );
		}
	}
	add_action( 'pre_get_posts', 'ulg_event_date_column_orderby' );
