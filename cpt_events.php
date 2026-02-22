<?php
/**
 * Events Custom Post Type, Taxonomies, CMB2 Metabox, and REST API
 *
 * @package pegasus-child
 */


/*============================
======= Register CPT + Taxonomies
============================*/

function ulg_register_events_cpt() {

	$events_labels = array(
		'name'               => _x( 'Events', 'events general name', 'pegasus-bootstrap' ),
		'singular_name'      => _x( 'Event', 'events singular name', 'pegasus-bootstrap' ),
		'add_new'            => _x( 'Add New', 'event', 'pegasus-bootstrap' ),
		'add_new_item'       => __( 'Add New Event', 'pegasus-bootstrap' ),
		'edit_item'          => __( 'Edit Event', 'pegasus-bootstrap' ),
		'new_item'           => __( 'New Event', 'pegasus-bootstrap' ),
		'view_item'          => __( 'View Event', 'pegasus-bootstrap' ),
		'search_items'       => __( 'Search Events', 'pegasus-bootstrap' ),
		'not_found'          => __( 'No events found', 'pegasus-bootstrap' ),
		'not_found_in_trash' => __( 'No events found in Trash', 'pegasus-bootstrap' ),
		'parent_item_colon'  => '',
		'menu_name'          => __( 'Events', 'pegasus-bootstrap' ),
	);

	$events_args = array(
		'labels'             => $events_labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'capability_type'    => 'post',
		'can_export'         => true,
		'has_archive'        => true,
		'rewrite'            => array( 'slug' => 'events' ),
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
		'show_in_rest'       => true,
		'menu_icon'          => 'dashicons-calendar-alt',
	);

	register_post_type( 'ulg_events', $events_args );

	remove_post_type_support( 'ulg_events', 'author' );
	remove_post_type_support( 'ulg_events', 'excerpt' );
	remove_post_type_support( 'ulg_events', 'trackbacks' );

	/*============================
	======= Taxonomy: Categories
	============================*/

	$event_cats_labels = array(
		'name'              => _x( 'Event Categories', 'taxonomy general name', 'pegasus-bootstrap' ),
		'singular_name'     => _x( 'Event Category', 'taxonomy singular name', 'pegasus-bootstrap' ),
		'search_items'      => __( 'Search Event Categories', 'pegasus-bootstrap' ),
		'all_items'         => __( 'All Event Categories', 'pegasus-bootstrap' ),
		'parent_item'       => __( 'Parent Event Category', 'pegasus-bootstrap' ),
		'parent_item_colon' => __( 'Parent Event Category:', 'pegasus-bootstrap' ),
		'edit_item'         => __( 'Edit Event Category', 'pegasus-bootstrap' ),
		'update_item'       => __( 'Update Event Category', 'pegasus-bootstrap' ),
		'add_new_item'      => __( 'Add New Event Category', 'pegasus-bootstrap' ),
		'new_item_name'     => __( 'New Event Category Name', 'pegasus-bootstrap' ),
		'menu_name'         => __( 'Event Categories', 'pegasus-bootstrap' ),
	);

	register_taxonomy(
		'event_categories',
		array( 'ulg_events' ),
		array(
			'hierarchical'      => true,
			'labels'            => $event_cats_labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'event-categories' ),
			'show_in_rest'      => true,
		)
	);

	/*============================
	======= Taxonomy: Tags
	============================*/

	$event_tags_labels = array(
		'name'              => _x( 'Event Tags', 'taxonomy general name', 'pegasus-bootstrap' ),
		'singular_name'     => _x( 'Event Tag', 'taxonomy singular name', 'pegasus-bootstrap' ),
		'search_items'      => __( 'Search Event Tags', 'pegasus-bootstrap' ),
		'all_items'         => __( 'All Event Tags', 'pegasus-bootstrap' ),
		'parent_item'       => __( 'Parent Event Tag', 'pegasus-bootstrap' ),
		'parent_item_colon' => __( 'Parent Event Tag:', 'pegasus-bootstrap' ),
		'edit_item'         => __( 'Edit Event Tag', 'pegasus-bootstrap' ),
		'update_item'       => __( 'Update Event Tag', 'pegasus-bootstrap' ),
		'add_new_item'      => __( 'Add New Event Tag', 'pegasus-bootstrap' ),
		'new_item_name'     => __( 'New Event Tag Name', 'pegasus-bootstrap' ),
		'menu_name'         => __( 'Event Tags', 'pegasus-bootstrap' ),
	);

	register_taxonomy(
		'event_tags',
		array( 'ulg_events' ),
		array(
			'hierarchical'      => false,
			'labels'            => $event_tags_labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'event-tags' ),
			'show_in_rest'      => true,
		)
	);
}
add_action( 'init', 'ulg_register_events_cpt' );


/*============================
======= Hardcoded Venues
============================*/

function ulg_get_venues() {
	return array(
		'mabellas' => array(
			'name'    => "Mabella's Italian Steakhouse",
			'address' => '14 West 11th Street, Columbus, GA',
			'phone'   => '(706) 940-0070',
			'website' => 'https://mabellas.com',
		),
		'mabellas-midland' => array(
			'name'    => "Mabella's Midland",
			'address' => 'Midland, GA',
			'phone'   => '',
			'website' => 'https://mabellas.com',
		),
		'the-loft' => array(
			'name'    => 'The Loft',
			'address' => '1032 Broadway, Columbus, GA',
			'phone'   => '(706) 507-1308',
			'website' => 'https://theloft.com',
		),
		'the-pearl' => array(
			'name'    => 'The Pearl at The Mix Market',
			'address' => '1040 Broadway, Columbus, GA',
			'phone'   => '(706) 984-8004',
			'website' => 'https://themixmarket.com',
		),
		'tommy-gs' => array(
			'name'    => "Tommy G's",
			'address' => 'Columbus, GA',
			'phone'   => '',
			'website' => 'https://tommygs.com',
		),
	);
}

/**
 * Build a flat slug => name array for CMB2 select options.
 */
function ulg_get_venue_select_options() {
	$venues  = ulg_get_venues();
	$options = array( '' => __( '-- Select Venue --', 'pegasus-bootstrap' ) );

	foreach ( $venues as $slug => $venue ) {
		$options[ $slug ] = $venue['name'];
	}

	return $options;
}


/*============================
======= CMB2 Metabox
======= MUST use cmb2_init (not cmb2_admin_init) for REST API exposure
============================*/

function ulg_events_metabox() {

	$prefix = 'ulg_event_';

	$cmb = new_cmb2_box( array(
		'id'            => $prefix . 'details',
		'title'         => __( 'Event Details', 'pegasus-bootstrap' ),
		'object_types'  => array( 'ulg_events' ),
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true,
		'show_in_rest'  => WP_REST_Server::ALLMETHODS,
	) );

	/* ── Group 1: Event Details ── */

	$cmb->add_field( array(
		'name'         => __( 'Event Start Date/Time', 'pegasus-bootstrap' ),
		'id'           => $prefix . 'start_datetime',
		'type'         => 'text_datetime_timestamp',
		'show_in_rest' => WP_REST_Server::ALLMETHODS,
	) );

	$cmb->add_field( array(
		'name'         => __( 'Event End Date/Time', 'pegasus-bootstrap' ),
		'id'           => $prefix . 'end_datetime',
		'type'         => 'text_datetime_timestamp',
		'show_in_rest' => WP_REST_Server::ALLMETHODS,
	) );

	$cmb->add_field( array(
		'name'         => __( 'Event Type', 'pegasus-bootstrap' ),
		'id'           => $prefix . 'type',
		'type'         => 'select',
		'options'      => array(
			''            => __( '-- Select --', 'pegasus-bootstrap' ),
			'public'      => __( 'Public', 'pegasus-bootstrap' ),
			'private'     => __( 'Private', 'pegasus-bootstrap' ),
			'corporate'   => __( 'Corporate', 'pegasus-bootstrap' ),
			'wedding'     => __( 'Wedding', 'pegasus-bootstrap' ),
			'fundraiser'  => __( 'Fundraiser', 'pegasus-bootstrap' ),
		),
		'show_in_rest' => WP_REST_Server::ALLMETHODS,
	) );

	$cmb->add_field( array(
		'name'         => __( 'Event Status', 'pegasus-bootstrap' ),
		'id'           => $prefix . 'status',
		'type'         => 'select',
		'options'      => array(
			''          => __( '-- Select --', 'pegasus-bootstrap' ),
			'upcoming'  => __( 'Upcoming', 'pegasus-bootstrap' ),
			'active'    => __( 'Active', 'pegasus-bootstrap' ),
			'past'      => __( 'Past', 'pegasus-bootstrap' ),
			'cancelled' => __( 'Cancelled', 'pegasus-bootstrap' ),
		),
		'show_in_rest' => WP_REST_Server::ALLMETHODS,
	) );

	$cmb->add_field( array(
		'name'         => __( 'Venue / Location', 'pegasus-bootstrap' ),
		'id'           => $prefix . 'venue',
		'type'         => 'select',
		'options'      => ulg_get_venue_select_options(),
		'show_in_rest' => WP_REST_Server::ALLMETHODS,
	) );

	/* ── Group 2: Capacity & Accommodations ── */

	$cmb->add_field( array(
		'name'         => __( 'Max Capacity', 'pegasus-bootstrap' ),
		'id'           => $prefix . 'max_capacity',
		'type'         => 'text_small',
		'attributes'   => array( 'type' => 'number', 'min' => '0' ),
		'show_in_rest' => WP_REST_Server::ALLMETHODS,
	) );

	$cmb->add_field( array(
		'name'         => __( 'Catering', 'pegasus-bootstrap' ),
		'id'           => $prefix . 'catering',
		'type'         => 'select',
		'options'      => array(
			''             => __( '-- Select --', 'pegasus-bootstrap' ),
			'none'         => __( 'None', 'pegasus-bootstrap' ),
			'appetizers'   => __( 'Appetizers', 'pegasus-bootstrap' ),
			'full-service' => __( 'Full Service', 'pegasus-bootstrap' ),
			'custom'       => __( 'Custom', 'pegasus-bootstrap' ),
		),
		'show_in_rest' => WP_REST_Server::ALLMETHODS,
	) );

	$cmb->add_field( array(
		'name'         => __( 'AV Equipment', 'pegasus-bootstrap' ),
		'id'           => $prefix . 'av_equipment',
		'type'         => 'multicheck',
		'options'      => array(
			'sound-system' => __( 'Sound System', 'pegasus-bootstrap' ),
			'projector'    => __( 'Projector', 'pegasus-bootstrap' ),
			'microphones'  => __( 'Microphones', 'pegasus-bootstrap' ),
			'lighting'     => __( 'Lighting', 'pegasus-bootstrap' ),
			'stage'        => __( 'Stage', 'pegasus-bootstrap' ),
		),
		'show_in_rest' => WP_REST_Server::ALLMETHODS,
	) );

	$cmb->add_field( array(
		'name'         => __( 'Seating Arrangement', 'pegasus-bootstrap' ),
		'id'           => $prefix . 'seating',
		'type'         => 'select',
		'options'      => array(
			''          => __( '-- Select --', 'pegasus-bootstrap' ),
			'theater'   => __( 'Theater', 'pegasus-bootstrap' ),
			'banquet'   => __( 'Banquet', 'pegasus-bootstrap' ),
			'cocktail'  => __( 'Cocktail', 'pegasus-bootstrap' ),
			'classroom' => __( 'Classroom', 'pegasus-bootstrap' ),
			'custom'    => __( 'Custom', 'pegasus-bootstrap' ),
		),
		'show_in_rest' => WP_REST_Server::ALLMETHODS,
	) );

	$cmb->add_field( array(
		'name'         => __( 'Parking', 'pegasus-bootstrap' ),
		'id'           => $prefix . 'parking',
		'type'         => 'select',
		'options'      => array(
			''             => __( '-- Select --', 'pegasus-bootstrap' ),
			'none'         => __( 'None', 'pegasus-bootstrap' ),
			'valet'        => __( 'Valet', 'pegasus-bootstrap' ),
			'self-parking' => __( 'Self-Parking', 'pegasus-bootstrap' ),
			'both'         => __( 'Both', 'pegasus-bootstrap' ),
		),
		'show_in_rest' => WP_REST_Server::ALLMETHODS,
	) );

	$cmb->add_field( array(
		'name'         => __( 'Special Accommodations', 'pegasus-bootstrap' ),
		'id'           => $prefix . 'special_accommodations',
		'type'         => 'textarea',
		'show_in_rest' => WP_REST_Server::ALLMETHODS,
	) );

	/* ── Group 3: Staff ── */

	$cmb->add_field( array(
		'name'         => __( 'Event Coordinator', 'pegasus-bootstrap' ),
		'id'           => $prefix . 'coordinator_name',
		'type'         => 'text',
		'show_in_rest' => WP_REST_Server::ALLMETHODS,
	) );

	$cmb->add_field( array(
		'name'         => __( 'Coordinator Phone', 'pegasus-bootstrap' ),
		'id'           => $prefix . 'coordinator_phone',
		'type'         => 'text',
		'show_in_rest' => WP_REST_Server::ALLMETHODS,
	) );

	$cmb->add_field( array(
		'name'         => __( 'Coordinator Email', 'pegasus-bootstrap' ),
		'id'           => $prefix . 'coordinator_email',
		'type'         => 'text_email',
		'show_in_rest' => WP_REST_Server::ALLMETHODS,
	) );

	$cmb->add_field( array(
		'name'         => __( 'Number of Bartenders', 'pegasus-bootstrap' ),
		'id'           => $prefix . 'num_bartenders',
		'type'         => 'text_small',
		'attributes'   => array( 'type' => 'number', 'min' => '0' ),
		'show_in_rest' => WP_REST_Server::ALLMETHODS,
	) );

	$cmb->add_field( array(
		'name'         => __( 'Number of Servers', 'pegasus-bootstrap' ),
		'id'           => $prefix . 'num_servers',
		'type'         => 'text_small',
		'attributes'   => array( 'type' => 'number', 'min' => '0' ),
		'show_in_rest' => WP_REST_Server::ALLMETHODS,
	) );

	$cmb->add_field( array(
		'name'         => __( 'Additional Staff Notes', 'pegasus-bootstrap' ),
		'id'           => $prefix . 'staff_notes',
		'type'         => 'textarea',
		'show_in_rest' => WP_REST_Server::ALLMETHODS,
	) );

	/* ── Group 4: Pricing & Contact ── */

	$cmb->add_field( array(
		'name'         => __( 'Base Price', 'pegasus-bootstrap' ),
		'id'           => $prefix . 'base_price',
		'type'         => 'text_money',
		'show_in_rest' => WP_REST_Server::ALLMETHODS,
	) );

	$cmb->add_field( array(
		'name'         => __( 'Deposit Required', 'pegasus-bootstrap' ),
		'id'           => $prefix . 'deposit',
		'type'         => 'text_money',
		'show_in_rest' => WP_REST_Server::ALLMETHODS,
	) );

	$cmb->add_field( array(
		'name'         => __( 'Contact Name', 'pegasus-bootstrap' ),
		'id'           => $prefix . 'contact_name',
		'type'         => 'text',
		'show_in_rest' => WP_REST_Server::ALLMETHODS,
	) );

	$cmb->add_field( array(
		'name'         => __( 'Contact Phone', 'pegasus-bootstrap' ),
		'id'           => $prefix . 'contact_phone',
		'type'         => 'text',
		'show_in_rest' => WP_REST_Server::ALLMETHODS,
	) );

	$cmb->add_field( array(
		'name'         => __( 'Contact Email', 'pegasus-bootstrap' ),
		'id'           => $prefix . 'contact_email',
		'type'         => 'text_email',
		'show_in_rest' => WP_REST_Server::ALLMETHODS,
	) );

	$cmb->add_field( array(
		'name'         => __( 'Special Requests', 'pegasus-bootstrap' ),
		'id'           => $prefix . 'special_requests',
		'type'         => 'textarea',
		'show_in_rest' => WP_REST_Server::ALLMETHODS,
	) );

	/* ── Group 5: Event Display ── */

	$cmb->add_field( array(
		'name'         => __( 'Ticket / RSVP Link', 'pegasus-bootstrap' ),
		'id'           => $prefix . 'ticket_url',
		'type'         => 'text_url',
		'show_in_rest' => WP_REST_Server::ALLMETHODS,
	) );

	$cmb->add_field( array(
		'name'         => __( 'Event Image / Banner', 'pegasus-bootstrap' ),
		'id'           => $prefix . 'banner_image',
		'type'         => 'file',
		'options'      => array( 'url' => false ),
		'text'         => array(
			'add_upload_file_text' => __( 'Add Event Banner', 'pegasus-bootstrap' ),
		),
		'show_in_rest' => WP_REST_Server::ALLMETHODS,
	) );
}
add_action( 'cmb2_init', 'ulg_events_metabox' );


/*============================
======= Custom REST API Endpoint
============================*/

add_action( 'rest_api_init', 'ulg_register_events_rest_routes' );

function ulg_register_events_rest_routes() {
	register_rest_route( 'ulg-events/v1', '/events', array(
		'methods'             => WP_REST_Server::READABLE,
		'callback'            => 'ulg_rest_get_events',
		'permission_callback' => '__return_true',
		'args'                => array(
			'status' => array(
				'default'           => 'upcoming',
				'sanitize_callback' => 'sanitize_text_field',
			),
			'category' => array(
				'default'           => '',
				'sanitize_callback' => 'sanitize_text_field',
			),
			'limit' => array(
				'default'           => 10,
				'sanitize_callback' => 'absint',
			),
			'venue' => array(
				'default'           => '',
				'sanitize_callback' => 'sanitize_text_field',
			),
		),
	) );
}

function ulg_rest_get_events( WP_REST_Request $request ) {
	$status   = $request->get_param( 'status' );
	$category = $request->get_param( 'category' );
	$limit    = $request->get_param( 'limit' );
	$venue    = $request->get_param( 'venue' );

	$meta_query = array();

	if ( ! empty( $status ) ) {
		$meta_query[] = array(
			'key'     => 'ulg_event_status',
			'value'   => $status,
			'compare' => '=',
		);
	}

	if ( ! empty( $venue ) ) {
		$meta_query[] = array(
			'key'     => 'ulg_event_venue',
			'value'   => $venue,
			'compare' => '=',
		);
	}

	$tax_query = array();

	if ( ! empty( $category ) ) {
		$tax_query[] = array(
			'taxonomy' => 'event_categories',
			'field'    => 'slug',
			'terms'    => $category,
		);
	}

	$query_args = array(
		'post_type'      => 'ulg_events',
		'posts_per_page' => $limit,
		'post_status'    => 'publish',
		'orderby'        => 'meta_value_num',
		'meta_key'       => 'ulg_event_start_datetime',
		'order'          => 'ASC',
	);

	if ( ! empty( $meta_query ) ) {
		$query_args['meta_query'] = $meta_query;
	}

	if ( ! empty( $tax_query ) ) {
		$query_args['tax_query'] = $tax_query;
	}

	$events = new WP_Query( $query_args );
	$data   = array();

	if ( $events->have_posts() ) {
		while ( $events->have_posts() ) {
			$events->the_post();
			$id = get_the_ID();

			// Resolve venue from hardcoded venues JSON
			$venues     = ulg_get_venues();
			$venue_slug = get_post_meta( $id, 'ulg_event_venue', true );
			$venue_data = isset( $venues[ $venue_slug ] ) ? $venues[ $venue_slug ] : array();
			$venue_name = ! empty( $venue_data['name'] )    ? $venue_data['name']    : '';
			$venue_addr = ! empty( $venue_data['address'] ) ? $venue_data['address'] : '';
			$venue_url  = ! empty( $venue_data['website'] ) ? $venue_data['website'] : '';

			// Featured image
			$featured_image = get_the_post_thumbnail_url( $id, 'large' );

			// Banner image (CMB2 file field)
			$banner_raw = get_post_meta( $id, 'ulg_event_banner_image', true );
			$banner_url = function_exists( 'ulg_get_cmb2_image_url' )
				? ulg_get_cmb2_image_url( $banner_raw )
				: '';

			$data[] = array(
				'id'             => $id,
				'title'          => get_the_title(),
				'excerpt'        => get_the_excerpt(),
				'content'        => apply_filters( 'the_content', get_the_content() ),
				'permalink'      => get_permalink(),
				'featured_image' => $featured_image ? $featured_image : '',
				'banner_image'   => $banner_url,
				'start_datetime' => (int) get_post_meta( $id, 'ulg_event_start_datetime', true ),
				'end_datetime'   => (int) get_post_meta( $id, 'ulg_event_end_datetime', true ),
				'event_type'     => get_post_meta( $id, 'ulg_event_type', true ),
				'event_status'   => get_post_meta( $id, 'ulg_event_status', true ),
				'venue_slug'     => $venue_slug,
				'venue_name'     => $venue_name,
				'venue_address'  => $venue_addr,
				'venue_website'  => $venue_url,
				'max_capacity'   => get_post_meta( $id, 'ulg_event_max_capacity', true ),
				'ticket_url'     => get_post_meta( $id, 'ulg_event_ticket_url', true ),
				'base_price'     => get_post_meta( $id, 'ulg_event_base_price', true ),
				'categories'     => wp_get_post_terms( $id, 'event_categories', array( 'fields' => 'names' ) ),
				'tags'           => wp_get_post_terms( $id, 'event_tags', array( 'fields' => 'names' ) ),
			);
		}
		wp_reset_postdata();
	}

	return new WP_REST_Response( $data, 200 );
}


/*============================
======= CORS for ULG Domains
============================*/

add_action( 'rest_api_init', function () {
	remove_filter( 'rest_pre_serve_request', 'rest_send_cors_headers' );
	add_filter( 'rest_pre_serve_request', function ( $value ) {
		$origin = get_http_origin();

		$allowed_origins = array(
			'https://uptownlifegroup.com',
			'https://www.uptownlifegroup.com',
			'https://events.uptownlifegroup.com',
			'https://theloft.com',
			'https://www.theloft.com',
			'https://mabellas.com',
			'https://www.mabellas.com',
			'https://saltcellar.com',
			'https://www.saltcellar.com',
			'https://themixmarket.com',
			'https://www.themixmarket.com',
			'https://tommygs.com',
			'https://www.tommygs.com',
		);

		if ( in_array( $origin, $allowed_origins, true ) ) {
			header( 'Access-Control-Allow-Origin: ' . $origin );
		}

		header( 'Access-Control-Allow-Methods: GET, OPTIONS' );
		header( 'Access-Control-Allow-Headers: Content-Type' );
		header( 'Access-Control-Allow-Credentials: true' );

		return $value;
	} );
}, 15 );
