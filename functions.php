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
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'nonce'    => wp_create_nonce( 'ticket_report_nonce' ),
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
				MAX( CASE WHEN pm.meta_key = 'WooCommerceEventsTicketType'            THEN pm.meta_value END ) AS ticket_type
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

		$total_revenue = 0;
		foreach ( $tickets as $ticket ) {
			$ticket->price = tr_clean_price( $ticket->price );
			$total_revenue += floatval( $ticket->price );

			// Fall back to purchaser info when attendee fields are empty
			if ( empty( $ticket->first_name ) ) {
				$ticket->first_name = $ticket->purchaser_first;
			}
			if ( empty( $ticket->last_name ) ) {
				$ticket->last_name = $ticket->purchaser_last;
			}
			if ( empty( $ticket->email ) ) {
				$ticket->email = $ticket->purchaser_email;
			}
		}

		wp_send_json_success( array(
			'event_name'    => html_entity_decode( $event_name, ENT_QUOTES, 'UTF-8' ),
			'tickets'       => $tickets,
			'total_tickets' => count( $tickets ),
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
				MAX( CASE WHEN pm.meta_key = 'WooCommerceEventsProductID'             THEN pm.meta_value END ) AS product_id
			FROM {$wpdb->posts} t
			INNER JOIN {$wpdb->postmeta} pm ON t.ID = pm.post_id
			WHERE t.ID IN ($placeholders)
			GROUP BY t.ID
			ORDER BY last_name ASC, first_name ASC
		", ...$ticket_ids ) );

		// Resolve event names, clean prices, and fill in attendee from purchaser
		foreach ( $tickets as &$ticket ) {
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
		}

		wp_send_json_success( $tickets );
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
