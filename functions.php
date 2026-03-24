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
	 * Check if the legacy tickets table exists (result is cached per request).
	 */
	function tr_legacy_table_exists() {
		static $exists = null;
		if ( $exists !== null ) {
			return $exists;
		}
		global $wpdb;
		$table = $wpdb->prefix . 'ulg_legacy_tickets';
		$exists = ( $wpdb->get_var( $wpdb->prepare( 'SHOW TABLES LIKE %s', $table ) ) === $table );
		return $exists;
	}

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

		// Merge legacy ticket counts if the table exists.
		if ( tr_legacy_table_exists() ) {
			$legacy_table = $wpdb->prefix . 'ulg_legacy_tickets';
			$legacy = $wpdb->get_results( "
				SELECT
					event_name,
					COUNT(*) AS ticket_count
				FROM {$legacy_table}
				GROUP BY event_name
				ORDER BY event_name ASC
			" );

			// Index FooEvents results by lowercase event name for case-insensitive merging.
			$by_name = array();
			foreach ( $results as $row ) {
				$decoded = html_entity_decode( $row->event_name, ENT_QUOTES, 'UTF-8' );
				$by_name[ strtolower( $decoded ) ] = $row;
			}

			foreach ( $legacy as $leg ) {
				$leg_key = strtolower( $leg->event_name );
				if ( isset( $by_name[ $leg_key ] ) ) {
					// Event exists in FooEvents — add legacy count.
					$by_name[ $leg_key ]->ticket_count += (int) $leg->ticket_count;
				} else {
					// Legacy-only event — use "legacy_<name>" as a pseudo product_id.
					$results[] = (object) array(
						'product_id'   => 'legacy_' . sanitize_title( $leg->event_name ),
						'event_name'   => $leg->event_name,
						'ticket_count' => $leg->ticket_count,
					);
				}
			}

			// Re-sort alphabetically after merge.
			usort( $results, function ( $a, $b ) {
				return strcasecmp( $a->event_name, $b->event_name );
			} );
		}

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

		$raw_product_id = sanitize_text_field( $_POST['product_id'] );

		// Handle legacy-only events (product_id = "legacy_some-slug").
		$is_legacy_only = ( strpos( $raw_product_id, 'legacy_' ) === 0 );

		if ( ! $is_legacy_only ) {
			$product_id = absint( $raw_product_id );
			if ( ! $product_id ) {
				wp_send_json_error( 'Invalid product ID' );
			}
		}

		global $wpdb;

		$tickets       = array();
		$total_revenue = 0;
		$grouped       = array();
		$event_name    = '';

		// ── FooEvents tickets (skip for legacy-only events) ──
		if ( ! $is_legacy_only ) {
			$event_name   = get_the_title( $product_id );
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
		}

		// ── Legacy (BentoBox) tickets ──
		$legacy_ticket_count = 0;
		if ( tr_legacy_table_exists() ) {
			$legacy_table = $wpdb->prefix . 'ulg_legacy_tickets';

			if ( $is_legacy_only ) {
				// Derive event name from the slug.
				$slug      = substr( $raw_product_id, 7 );
				$all_names = $wpdb->get_col( "SELECT DISTINCT event_name FROM {$legacy_table}" );
				foreach ( $all_names as $name ) {
					if ( sanitize_title( $name ) === $slug ) {
						$event_name = $name;
						break;
					}
				}
				if ( empty( $event_name ) ) {
					$event_name = ucwords( str_replace( '-', ' ', $slug ) );
				}
			}

			$match_name  = html_entity_decode( $event_name, ENT_QUOTES, 'UTF-8' );
			$legacy_rows = $wpdb->get_results( $wpdb->prepare(
				"SELECT * FROM {$legacy_table} WHERE LOWER(event_name) = LOWER(%s) ORDER BY last_name ASC, first_name ASC",
				$match_name
			) );

			foreach ( $legacy_rows as $lr ) {
				$legacy_ticket_count++;
				$total_revenue += floatval( $lr->price );

				// Group legacy tickets by email within the event.
				$key = 'bb_' . strtolower( $lr->email );
				if ( ! isset( $grouped[ $key ] ) ) {
					$grouped[ $key ] = array(
						'order_id'        => 'BB',
						'first_name'      => $lr->first_name,
						'last_name'       => $lr->last_name,
						'email'           => $lr->email,
						'purchaser_first' => $lr->first_name,
						'purchaser_last'  => $lr->last_name,
						'ticket_type'     => $lr->ticket_type,
						'order_date'      => date_i18n( 'M j, Y', strtotime( $lr->order_date ) ) . ' (BentoBox)',
						'qty'             => 0,
						'total_price'     => 0,
						'tickets'         => array(),
					);
				}
				$grouped[ $key ]['qty']++;
				$grouped[ $key ]['total_price'] += floatval( $lr->price );
				$grouped[ $key ]['tickets'][] = array(
					'ticket_id' => 'bb-' . $lr->id,
					'status'    => 'BentoBox',
				);
			}
		}

		// Re-index and format totals.
		$orders = array_values( $grouped );
		foreach ( $orders as &$order ) {
			$order['total_price'] = number_format( $order['total_price'], 2 );
		}

		wp_send_json_success( array(
			'event_name'    => html_entity_decode( $event_name, ENT_QUOTES, 'UTF-8' ),
			'orders'        => $orders,
			'total_tickets' => count( $tickets ) + $legacy_ticket_count,
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

		// ── FooEvents tickets ──
		$grouped = array();

		if ( ! empty( $ticket_ids ) ) {
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
		}

		// ── Legacy (BentoBox) tickets matching search ──
		if ( tr_legacy_table_exists() ) {
			$legacy_table = $wpdb->prefix . 'ulg_legacy_tickets';
			$legacy_rows  = $wpdb->get_results( $wpdb->prepare(
				"SELECT * FROM {$legacy_table}
				 WHERE first_name LIKE %s
				    OR last_name  LIKE %s
				    OR email      LIKE %s
				 ORDER BY last_name ASC, first_name ASC
				 LIMIT 500",
				$like, $like, $like
			) );

			foreach ( $legacy_rows as $lr ) {
				$key = 'bb_' . strtolower( $lr->email ) . '_' . sanitize_title( $lr->event_name );
				if ( ! isset( $grouped[ $key ] ) ) {
					$grouped[ $key ] = array(
						'order_id'        => 'BB',
						'event_name'      => $lr->event_name,
						'first_name'      => $lr->first_name,
						'last_name'       => $lr->last_name,
						'email'           => $lr->email,
						'purchaser_first' => $lr->first_name,
						'purchaser_last'  => $lr->last_name,
						'ticket_type'     => $lr->ticket_type,
						'order_date'      => date_i18n( 'M j, Y', strtotime( $lr->order_date ) ) . ' (BentoBox)',
						'qty'             => 0,
						'total_price'     => 0,
						'tickets'         => array(),
					);
				}
				$grouped[ $key ]['qty']++;
				$grouped[ $key ]['total_price'] += floatval( $lr->price );
				$grouped[ $key ]['tickets'][] = array(
					'ticket_id' => 'bb-' . $lr->id,
					'status'    => 'BentoBox',
				);
			}
		}

		if ( empty( $grouped ) ) {
			wp_send_json_success( array() );
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

	/**
	 * AJAX: Get summary data for all events (used by "All Results" tab).
	 * Returns one row per event with order count, ticket count, and revenue.
	 */
	function tr_get_all_summaries() {
		check_ajax_referer( 'ticket_report_nonce', 'nonce' );

		if ( ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error( 'Unauthorized' );
		}

		global $wpdb;

		$orders_table = $wpdb->prefix . 'wc_orders';

		// Get per-event summary from FooEvents tickets.
		$results = $wpdb->get_results( "
			SELECT
				p.post_title                                  AS event_name,
				COUNT( DISTINCT pm_order.meta_value )         AS order_count,
				COUNT( t.ID )                                 AS ticket_count,
				COALESCE( SUM(
					CAST(
						REPLACE(
							REPLACE(
								(SELECT pm_p.meta_value FROM {$wpdb->postmeta} pm_p WHERE pm_p.post_id = t.ID AND pm_p.meta_key = 'WooCommerceEventsPrice' LIMIT 1),
								'$', ''
							),
							',', ''
						) AS DECIMAL(10,2)
					)
				), 0 )                                        AS revenue
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

		// Clean up the revenue values (strip HTML from WooCommerce price meta).
		foreach ( $results as $row ) {
			$row->revenue = floatval( $row->revenue );
		}

		// Index by lowercase event name for legacy merging.
		$by_name = array();
		foreach ( $results as $row ) {
			$decoded = html_entity_decode( $row->event_name, ENT_QUOTES, 'UTF-8' );
			$by_name[ strtolower( $decoded ) ] = $row;
		}

		// Merge legacy (BentoBox) data if available.
		if ( tr_legacy_table_exists() ) {
			$legacy_table = $wpdb->prefix . 'ulg_legacy_tickets';
			$legacy = $wpdb->get_results( "
				SELECT
					event_name,
					COUNT( DISTINCT email ) AS order_count,
					COUNT(*)               AS ticket_count,
					COALESCE( SUM( CAST( price AS DECIMAL(10,2) ) ), 0 ) AS revenue
				FROM {$legacy_table}
				GROUP BY event_name
				ORDER BY event_name ASC
			" );

			foreach ( $legacy as $leg ) {
				$leg_key = strtolower( $leg->event_name );
				if ( isset( $by_name[ $leg_key ] ) ) {
					$by_name[ $leg_key ]->order_count  += (int) $leg->order_count;
					$by_name[ $leg_key ]->ticket_count += (int) $leg->ticket_count;
					$by_name[ $leg_key ]->revenue      += floatval( $leg->revenue );
				} else {
					$results[] = (object) array(
						'event_name'   => $leg->event_name,
						'order_count'  => (int) $leg->order_count,
						'ticket_count' => (int) $leg->ticket_count,
						'revenue'      => floatval( $leg->revenue ),
					);
				}
			}

			usort( $results, function ( $a, $b ) {
				return strcasecmp( $a->event_name, $b->event_name );
			} );
		}

		// Compute grand totals.
		$grand_orders  = 0;
		$grand_tickets = 0;
		$grand_revenue = 0;

		$rows = array();
		foreach ( $results as $row ) {
			$grand_orders  += (int) $row->order_count;
			$grand_tickets += (int) $row->ticket_count;
			$grand_revenue += $row->revenue;

			$rows[] = array(
				'event_name'   => html_entity_decode( $row->event_name, ENT_QUOTES, 'UTF-8' ),
				'order_count'  => (int) $row->order_count,
				'ticket_count' => (int) $row->ticket_count,
				'revenue'      => number_format( $row->revenue, 2 ),
			);
		}

		wp_send_json_success( array(
			'events'         => $rows,
			'grand_orders'   => $grand_orders,
			'grand_tickets'  => $grand_tickets,
			'grand_revenue'  => number_format( $grand_revenue, 2 ),
		) );
	}
	add_action( 'wp_ajax_tr_get_all_summaries', 'tr_get_all_summaries' );

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
	 * Custom "Event Manager" role
	 *
	 * Access: WooCommerce Orders, FooEvents tickets, Ticket Report
	 * template, and Products (for event management). Everything else
	 * in the admin sidebar is hidden.
	 *-----------------------------------------------------------------*/

	/**
	 * Register the Event Manager role on theme activation / upgrade.
	 */
	function ulg_register_event_manager_role() {
		$version = '1.1';
		if ( get_option( 'ulg_event_manager_role_version' ) === $version ) {
			return;
		}

		// Remove old version so caps refresh cleanly.
		remove_role( 'event_manager' );

		add_role( 'event_manager', __( 'Event Manager', 'pegasus-bootstrap' ), array(
			// Core
			'read'                              => true,
			'upload_files'                       => true,
			'edit_posts'                         => true, // needed by FooEvents menus

			// WooCommerce Orders (HPOS-aware caps)
			'edit_shop_orders'                   => true,
			'read_shop_orders'                   => true,
			'edit_others_shop_orders'            => true,
			'read_private_shop_orders'           => true,

			// Products – view & edit (events are products)
			'edit_products'                      => true,
			'edit_others_products'               => true,
			'publish_products'                   => true,
			'read_private_products'              => true,
			'edit_published_products'            => true,

			// FooEvents tickets
			'edit_event_magic_tickets'           => true,
			'edit_event_magic_ticket'            => true,
			'edit_others_event_magic_tickets'    => true,
			'edit_published_event_magic_tickets' => true,
			'edit_published_event_magic_ticket'  => true,
			'publish_event_magic_tickets'        => true,
			'publish_event_magic_ticket'         => true,
			'read_private_event_magic_tickets'   => true,
			'read_event_magic_ticket'            => true,
			'delete_event_magic_tickets'         => true,
			'delete_event_magic_ticket'          => true,
			'app_event_magic_tickets'            => true,

			// Ticket report template uses AJAX
			'manage_woocommerce'                 => false,
			'view_woocommerce_reports'           => false,

			// Custom cap for the ticket report page
			'view_ticket_report'                 => true,
		) );

		update_option( 'ulg_event_manager_role_version', $version );
	}
	add_action( 'admin_init', 'ulg_register_event_manager_role' );

	/**
	 * Hide admin menus that Event Managers should not see.
	 */
	function ulg_event_manager_hide_menus() {
		$user = wp_get_current_user();
		if ( ! in_array( 'event_manager', (array) $user->roles, true ) ) {
			return;
		}

		global $menu, $submenu;

		// Top-level menus to KEEP (everything else is removed).
		$keep_top = array(
			'index.php',                                     // Dashboard
			'edit.php?post_type=shop_order',                 // Orders (legacy)
			'woocommerce',                                   // WooCommerce (for HPOS orders)
			'edit.php?post_type=product',                    // Products
			'fooevents',                                     // FooEvents
			'profile.php',                                   // Profile
		);

		foreach ( $menu as $key => $item ) {
			$slug = $item[2] ?? '';
			if ( ! in_array( $slug, $keep_top, true ) ) {
				remove_menu_page( $slug );
			}
		}

		// Under WooCommerce, keep only Orders.
		if ( ! empty( $submenu['woocommerce'] ) ) {
			foreach ( $submenu['woocommerce'] as $sub ) {
				$sub_slug = $sub[2] ?? '';
				if ( ! in_array( $sub_slug, array( 'wc-orders', 'edit.php?post_type=shop_order' ), true ) ) {
					remove_submenu_page( 'woocommerce', $sub_slug );
				}
			}
		}

		// Under Products, keep only the product list (remove categories, tags, attributes, etc.).
		if ( ! empty( $submenu['edit.php?post_type=product'] ) ) {
			foreach ( $submenu['edit.php?post_type=product'] as $sub ) {
				$sub_slug = $sub[2] ?? '';
				if ( $sub_slug !== 'edit.php?post_type=product' ) {
					remove_submenu_page( 'edit.php?post_type=product', $sub_slug );
				}
			}
		}

		// Under FooEvents, hide Settings and Getting Started.
		remove_submenu_page( 'fooevents', 'fooevents-settings' );
		remove_submenu_page( 'fooevents', 'fooevents-introduction' );
		remove_submenu_page( 'fooevents', 'fooevents-ticket-themes' );
	}
	add_action( 'admin_menu', 'ulg_event_manager_hide_menus', 9999 );

	/**
	 * Redirect Event Managers away from disallowed admin pages.
	 */
	function ulg_event_manager_block_pages() {
		$user = wp_get_current_user();
		if ( ! in_array( 'event_manager', (array) $user->roles, true ) ) {
			return;
		}

		global $pagenow;

		// Allowed pages/screens.
		$allowed = array(
			'index.php',          // Dashboard
			'profile.php',        // Profile
			'edit.php',           // Post type lists (products, tickets)
			'post.php',           // Edit single post
			'post-new.php',       // New post
			'admin.php',          // WooCommerce pages, FooEvents pages
			'admin-ajax.php',     // AJAX
			'upload.php',         // Media (for product images)
			'media-new.php',
			'async-upload.php',
			'admin-post.php',
		);

		if ( ! in_array( $pagenow, $allowed, true ) ) {
			wp_safe_redirect( admin_url() );
			exit;
		}
	}
	add_action( 'admin_init', 'ulg_event_manager_block_pages' );

	/**
	 * Allow Event Manager role to access the Ticket Report AJAX handlers.
	 * The existing handlers check for manage_options — this filter lets
	 * event_managers through when they have view_ticket_report cap.
	 */
	function ulg_event_manager_ticket_report_access( $allcaps, $caps, $args ) {
		if ( ! isset( $args[0] ) || $args[0] !== 'manage_options' ) {
			return $allcaps;
		}

		// Only grant during our ticket report AJAX actions.
		if ( ! wp_doing_ajax() ) {
			return $allcaps;
		}

		$action = $_REQUEST['action'] ?? '';
		$ticket_report_actions = array(
			'tr_get_events',
			'tr_get_event_tickets',
			'tr_search_customer',
			'tr_toggle_checkin',
			'tr_get_all_summaries',
		);

		if ( in_array( $action, $ticket_report_actions, true ) && ! empty( $allcaps['view_ticket_report'] ) ) {
			$allcaps['manage_options'] = true;
		}

		return $allcaps;
	}
	add_filter( 'user_has_cap', 'ulg_event_manager_ticket_report_access', 10, 3 );

	/*------------------------------------------------------------------
	 * Custom "Marketing Team" role
	 *
	 * Access: Pegasus Options, Settings, Appearance, WooCommerce Marketing,
	 * WooCommerce Analytics, Products, Pages, Media, Posts, and a custom
	 * "Orders" link to the frontend ticket/order report.
	 *-----------------------------------------------------------------*/

	/**
	 * Register the Marketing Team role on theme activation / upgrade.
	 */
	function ulg_register_marketing_team_role() {
		$version = '1.0';
		if ( get_option( 'ulg_marketing_team_role_version' ) === $version ) {
			return;
		}

		remove_role( 'marketing_team' );

		add_role( 'marketing_team', __( 'Marketing Team', 'pegasus-bootstrap' ), array(
			// Core.
			'read'                           => true,
			'upload_files'                   => true,

			// Posts.
			'edit_posts'                     => true,
			'edit_others_posts'              => true,
			'publish_posts'                  => true,
			'read_private_posts'             => true,
			'edit_published_posts'           => true,
			'delete_posts'                   => true,
			'delete_others_posts'            => true,
			'delete_published_posts'         => true,

			// Pages.
			'edit_pages'                     => true,
			'edit_others_pages'              => true,
			'publish_pages'                  => true,
			'read_private_pages'             => true,
			'edit_published_pages'           => true,
			'delete_pages'                   => true,
			'delete_others_pages'            => true,
			'delete_published_pages'         => true,

			// Products.
			'edit_products'                  => true,
			'edit_others_products'           => true,
			'publish_products'               => true,
			'read_private_products'          => true,
			'edit_published_products'        => true,
			'delete_products'                => true,
			'delete_others_products'         => true,
			'delete_published_products'      => true,

			// Media.
			'edit_files'                     => true,
			'delete_others_posts'            => true,

			// Appearance (Customizer, menus, widgets).
			'edit_theme_options'             => true,

			// WooCommerce Analytics & Marketing.
			'view_woocommerce_reports'       => true,
			'manage_woocommerce'             => true,

			// Pegasus Options & WP Settings – granted contextually via filter below.
			'view_pegasus_options'           => true,

			// Order report page access.
			'view_ticket_report'             => true,
		) );

		update_option( 'ulg_marketing_team_role_version', $version );
	}
	add_action( 'admin_init', 'ulg_register_marketing_team_role' );

	/**
	 * Grant Marketing Team manage_options only on specific admin pages
	 * (Pegasus Options, WP Settings) so it does not unlock everything.
	 */
	function ulg_marketing_team_cap_filter( $allcaps, $caps, $args ) {
		if ( ! isset( $args[0] ) || 'manage_options' !== $args[0] ) {
			return $allcaps;
		}

		if ( empty( $allcaps['view_pegasus_options'] ) ) {
			return $allcaps;
		}

		// Grant manage_options on allowed admin screens.
		$allowed_pages = array( 'pegasus_options', 'options-general.php', 'options-writing.php', 'options-reading.php', 'options-discussion.php', 'options-media.php', 'options-permalink.php', 'options-privacy.php' );

		$page    = isset( $_GET['page'] ) ? sanitize_text_field( $_GET['page'] ) : '';
		$pagenow = isset( $GLOBALS['pagenow'] ) ? $GLOBALS['pagenow'] : '';

		if ( in_array( $page, $allowed_pages, true ) || in_array( $pagenow, $allowed_pages, true ) ) {
			$allcaps['manage_options'] = true;
		}

		// Also grant during admin menu build so the items appear.
		if ( doing_action( 'admin_menu' ) || doing_action( '_admin_menu' ) || did_action( 'admin_menu' ) && ! did_action( 'admin_init' ) ) {
			$allcaps['manage_options'] = true;
		}

		return $allcaps;
	}
	add_filter( 'user_has_cap', 'ulg_marketing_team_cap_filter', 10, 3 );

	/**
	 * Add custom "Orders" menu item for Marketing Team pointing to frontend report.
	 */
	function ulg_marketing_team_orders_menu() {
		$user = wp_get_current_user();
		if ( ! in_array( 'marketing_team', (array) $user->roles, true ) ) {
			return;
		}

		add_menu_page(
			__( 'Orders', 'pegasus-bootstrap' ),
			__( 'Orders', 'pegasus-bootstrap' ),
			'view_ticket_report',
			'ulg-order-report',
			'ulg_marketing_team_orders_redirect',
			'dashicons-list-view',
			56
		);
	}
	add_action( 'admin_menu', 'ulg_marketing_team_orders_menu' );

	/**
	 * Redirect the Orders admin page to the frontend order report.
	 */
	function ulg_marketing_team_orders_redirect() {
		$report_url = home_url( '/test/' );
		wp_redirect( $report_url );
		exit;
	}

	/**
	 * Hide admin menus that Marketing Team should not see.
	 */
	function ulg_marketing_team_hide_menus() {
		$user = wp_get_current_user();
		if ( ! in_array( 'marketing_team', (array) $user->roles, true ) ) {
			return;
		}

		global $menu;

		$keep_top = array(
			'index.php',                              // Dashboard
			'edit.php',                                // Posts
			'upload.php',                              // Media
			'edit.php?post_type=page',                 // Pages
			'edit.php?post_type=product',              // Products
			'themes.php',                              // Appearance
			'options-general.php',                     // Settings
			'pegasus_options',                         // Pegasus Options
			'wc-admin&path=/marketing',                // Marketing
			'ulg-order-report',                        // Orders (frontend report)
			'profile.php',                             // Profile
		);

		foreach ( $menu as $key => $item ) {
			$slug = $item[2] ?? '';
			if ( ! in_array( $slug, $keep_top, true ) ) {
				remove_menu_page( $slug );
			}
		}
	}
	add_action( 'admin_menu', 'ulg_marketing_team_hide_menus', 9999 );


	/**
	 * Redirect Marketing Team away from disallowed admin pages.
	 */
	function ulg_marketing_team_block_pages() {
		$user = wp_get_current_user();
		if ( ! in_array( 'marketing_team', (array) $user->roles, true ) ) {
			return;
		}

		global $pagenow;

		$allowed = array(
			'index.php',            // Dashboard
			'profile.php',          // Profile
			'edit.php',             // Post type lists
			'post.php',             // Edit single post
			'post-new.php',         // New post
			'upload.php',           // Media
			'media-new.php',        // Upload media
			'async-upload.php',     // Async upload
			'admin.php',            // WC pages, Pegasus Options
			'admin-ajax.php',       // AJAX
			'admin-post.php',       // Admin post handler
			'themes.php',           // Appearance
			'customize.php',        // Customizer
			'widgets.php',          // Widgets
			'nav-menus.php',        // Menus
			'theme-editor.php',     // Theme editor
			'options-general.php',  // Settings > General
			'options-writing.php',  // Settings > Writing
			'options-reading.php',  // Settings > Reading
			'options-discussion.php', // Settings > Discussion
			'options-media.php',    // Settings > Media
			'options-permalink.php', // Settings > Permalinks
			'options-privacy.php',  // Settings > Privacy
			'options.php',          // Settings save handler
			'edit-tags.php',        // Categories/Tags
			'term.php',             // Edit term
		);

		if ( ! in_array( $pagenow, $allowed, true ) ) {
			wp_safe_redirect( admin_url() );
			exit;
		}
	}
	add_action( 'admin_init', 'ulg_marketing_team_block_pages' );

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
			$query->set( 'meta_key', 'WooCommerceEventsDateTimestamp' );
			$query->set( 'orderby', 'meta_value_num' );
		}
	}
	add_action( 'pre_get_posts', 'ulg_event_date_column_orderby' );

	/**
	 * Auto-set FooEvents expiration timestamp to 30 minutes after event start time.
	 * Runs on product save so no manual expiration date entry is needed.
	 */
	function ulg_auto_set_event_expiration( $post_id ) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( get_post_type( $post_id ) !== 'product' ) {
			return;
		}

		$is_event = get_post_meta( $post_id, 'WooCommerceEventsEvent', true );
		if ( $is_event !== 'Event' ) {
			return;
		}

		$event_date = get_post_meta( $post_id, 'WooCommerceEventsDate', true );
		if ( empty( $event_date ) ) {
			return;
		}

		$hour    = get_post_meta( $post_id, 'WooCommerceEventsHour', true );
		$minutes = get_post_meta( $post_id, 'WooCommerceEventsMinutes', true );
		$period  = get_post_meta( $post_id, 'WooCommerceEventsPeriod', true );

		// Build a time string, default to 11:59 PM if no start time set.
		if ( ! empty( $hour ) && $minutes !== '' ) {
			$time_str = $hour . ':' . $minutes;
			if ( ! empty( $period ) ) {
				// Normalize period (e.g. "p.m." -> "PM").
				$period_clean = strtoupper( str_replace( '.', '', $period ) );
				$time_str    .= ' ' . $period_clean;
			}
		} else {
			$time_str = '11:59 PM';
		}

		$datetime_str = $event_date . ' ' . $time_str;
		$timestamp    = strtotime( $datetime_str );

		if ( ! $timestamp ) {
			return;
		}

		// Add 30 minutes after event start.
		$expire_timestamp = $timestamp + ( 30 * 60 );

		update_post_meta( $post_id, 'WooCommerceEventsExpireTimestamp', $expire_timestamp );
		update_post_meta( $post_id, 'WooCommerceEventsExpire', gmdate( 'Y-m-d H:i:s', $expire_timestamp ) );
	}
	add_action( 'save_post', 'ulg_auto_set_event_expiration', 20 );
