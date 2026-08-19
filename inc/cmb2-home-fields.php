<?php
/**
 * CMB2 fields for the Home template (tpl_home.php).
 *
 * Every field/group is prefixed with `_sb_home_`. All group boxes and the
 * metaboxes themselves are collapsed (closed) by default.
 *
 * The front end shows the design defaults until real content is saved. The
 * canonical defaults live in sb_home_defaults() so the admin prefill and the
 * template fallback stay in sync.
 *
 * @package Pegasus_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Canonical default content for the Home page.
 *
 * Used both to prefill CMB2 fields in the admin and as the front-end fallback
 * when a field/group has not been given real content yet.
 *
 * @return array
 */
function sb_home_defaults() {
	$img = 'https://thestoutbrothers.com/wp-content/uploads/';

	return array(
		// Hero.
		'hero_kicker'        => 'Craft Beer · Wine · Metro Atlanta',
		'hero_heading_1'     => 'Providing the best',
		'hero_heading_gold'  => 'local & regional',
		'hero_heading_2'     => 'craft beer and wine.',
		'hero_text'          => "Prepare to embark on a beer lover's paradise. Savor an exceptional selection of local and regional draft beers in the comfort of your home or the vibrant atmosphere of our inviting tasting rooms — welcoming to both two-legged and four-legged friends.",
		'hero_image'         => $img . '2023/07/the-stout-brothers-main-image.png',
		'hero_buttons'       => array(
			array( 'text' => 'Explore Locations', 'url' => '#', 'style' => 'gold' ),
			array( 'text' => 'View Events', 'url' => '#events', 'style' => 'outline' ),
		),

		// Locations.
		'locations_kicker'   => 'Come See Us',
		'locations_heading'  => 'Three Metro Atlanta Locations',
		'locations_intro'    => 'Three tap rooms across the metro area, each with its own character. Click a location to explore the tap list, events, hours & directions.',
		'locations'          => array(
			array(
				'image'      => $img . '2023/07/smyrna-beer-market.png',
				'title'      => 'Smyrna Beer Market',
				'address'    => '1265 W Spring St., Suite D',
				'taplist'    => '#',
				'events'     => '#',
				'directions' => '#',
			),
			array(
				'image'      => $img . '2023/07/woodstock-beer-market.png',
				'title'      => 'Woodstock Beer Market',
				'address'    => '240 Chambers Street',
				'taplist'    => '#',
				'events'     => '#',
				'directions' => '#',
			),
			array(
				'image'      => $img . '2023/07/roswell-beer-market.png',
				'title'      => 'Roswell Beer Market',
				'address'    => '1186 Canton Street',
				'taplist'    => '#',
				'events'     => '#',
				'directions' => '#',
			),
		),

		// Featured breweries.
		'breweries_kicker'   => 'On Tap Right Now',
		'breweries_heading'  => 'Featured Breweries',
		'breweries'          => array(
			array( 'logo' => $img . '2024/01/monday-night-brewery-logo-v2.png', 'name' => 'Monday Night Brewery', 'url' => '' ),
			array( 'logo' => $img . '2023/10/halfway-crooks-logo.png', 'name' => 'Halfway Crooks', 'url' => '' ),
			array( 'logo' => $img . '2023/10/CreatureComforts_Logo.png', 'name' => 'Creature Comforts', 'url' => '' ),
		),

		// Events.
		'events_kicker'      => 'Always Something On',
		'events_heading'     => 'Events at all three locations',
		'events_text'        => "From trivia nights to pop-up food trucks, we always provide an experience at The Stout Brothers. Check out what's coming up — or book the space for your own private gathering.",
		'events_image'       => $img . '2023/10/the-stout-brothers-roswell-events-2.png',
		'events_buttons'     => array(
			array( 'text' => 'View Event Calendar', 'url' => '#', 'style' => 'gold' ),
			array( 'text' => 'Book a Private Event', 'url' => 'mailto:megan@thestoutbrothers.com', 'style' => 'outline' ),
		),

		// Reviews.
		'reviews_kicker'     => 'Five Stars, Pint After Pint',
		'reviews_heading_1'  => 'We love our customers…',
		'reviews_heading_2'  => 'and they love us.',
		'reviews'            => array(
			array(
				'rating'   => '5',
				'quote'    => 'Located at the top of historic Canton Street, their beer selection is unmatched. The bartenders are all very knowledgeable and can guide you to an offering that suits your taste. Do yourself a favor and stop by!',
				'name'     => 'Andrew L.',
				'location' => 'Roswell, GA',
			),
			array(
				'rating'   => '5',
				'quote'    => "Absolutely blown away by this place! Amazing draft selection available for tasting flights and tons of dry storage shelves lining the walls. A must-stop if you're driving through the area!",
				'name'     => 'Sarah D.',
				'location' => 'Pennsylvania, PA',
			),
			array(
				'rating'   => '5',
				'quote'    => 'Great atmosphere, excellent beers and a good variety of nonalcoholic beverages as well. Very much liked the flight presentation. We will definitely be back!',
				'name'     => 'Heather P.',
				'location' => 'Woodstock, GA',
			),
		),
	);
}

/**
 * Register the Home page metaboxes.
 */
function sb_home_register_metaboxes() {

	if ( ! function_exists( 'new_cmb2_box' ) ) {
		return;
	}

	$prefix   = '_sb_home_';
	$defaults = sb_home_defaults();

	// Only show these boxes when the page uses the Home template.
	$show_on  = array( 'key' => 'page-template', 'value' => 'tpl_home.php' );

	$button_style_options = array(
		'gold'    => __( 'Gold (solid)', 'pegasus-child' ),
		'outline' => __( 'Outline', 'pegasus-child' ),
	);

	/* ===================================================================
	 * HERO
	 * =================================================================== */
	$hero = new_cmb2_box( array(
		'id'           => $prefix . 'hero_box',
		'title'        => __( 'Home &mdash; Hero', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'context'      => 'normal',
		'priority'     => 'high',
		'closed'       => true,
		'show_on'      => $show_on,
	) );

	$hero->add_field( array(
		'name'    => __( 'Kicker', 'pegasus-child' ),
		'id'      => $prefix . 'hero_kicker',
		'type'    => 'text',
		'default' => $defaults['hero_kicker'],
	) );
	$hero->add_field( array(
		'name'    => __( 'Heading &mdash; line 1', 'pegasus-child' ),
		'id'      => $prefix . 'hero_heading_1',
		'type'    => 'text',
		'default' => $defaults['hero_heading_1'],
	) );
	$hero->add_field( array(
		'name'    => __( 'Heading &mdash; gold line', 'pegasus-child' ),
		'id'      => $prefix . 'hero_heading_gold',
		'type'    => 'text',
		'default' => $defaults['hero_heading_gold'],
	) );
	$hero->add_field( array(
		'name'    => __( 'Heading &mdash; line 3', 'pegasus-child' ),
		'id'      => $prefix . 'hero_heading_2',
		'type'    => 'text',
		'default' => $defaults['hero_heading_2'],
	) );
	$hero->add_field( array(
		'name'    => __( 'Intro text', 'pegasus-child' ),
		'id'      => $prefix . 'hero_text',
		'type'    => 'textarea',
		'default' => $defaults['hero_text'],
	) );
	$hero->add_field( array(
		'name'         => __( 'Hero image', 'pegasus-child' ),
		'id'           => $prefix . 'hero_image',
		'type'         => 'file',
		'options'      => array( 'url' => false ),
		'query_args'   => array( 'type' => 'image' ),
		'preview_size' => 'medium',
	) );

	$hero_buttons = $hero->add_field( array(
		'id'         => $prefix . 'hero_buttons',
		'type'       => 'group',
		'repeatable' => true,
		'options'    => array(
			'group_title'   => __( 'Button {#}', 'pegasus-child' ),
			'add_button'    => __( 'Add button', 'pegasus-child' ),
			'remove_button' => __( 'Remove button', 'pegasus-child' ),
			'closed'        => true,
		),
	) );
	$hero->add_group_field( $hero_buttons, array(
		'name' => __( 'Label', 'pegasus-child' ),
		'id'   => 'text',
		'type' => 'text',
	) );
	$hero->add_group_field( $hero_buttons, array(
		'name' => __( 'URL', 'pegasus-child' ),
		'id'   => 'url',
		'type' => 'text_url',
	) );
	$hero->add_group_field( $hero_buttons, array(
		'name'    => __( 'Style', 'pegasus-child' ),
		'id'      => 'style',
		'type'    => 'select',
		'default' => 'gold',
		'options' => $button_style_options,
	) );

	/* ===================================================================
	 * LOCATIONS
	 * =================================================================== */
	$loc = new_cmb2_box( array(
		'id'           => $prefix . 'locations_box',
		'title'        => __( 'Home &mdash; Locations', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'context'      => 'normal',
		'priority'     => 'high',
		'closed'       => true,
		'show_on'      => $show_on,
	) );

	$loc->add_field( array(
		'name'    => __( 'Kicker', 'pegasus-child' ),
		'id'      => $prefix . 'locations_kicker',
		'type'    => 'text',
		'default' => $defaults['locations_kicker'],
	) );
	$loc->add_field( array(
		'name'    => __( 'Heading', 'pegasus-child' ),
		'id'      => $prefix . 'locations_heading',
		'type'    => 'text',
		'default' => $defaults['locations_heading'],
	) );
	$loc->add_field( array(
		'name'    => __( 'Intro text', 'pegasus-child' ),
		'id'      => $prefix . 'locations_intro',
		'type'    => 'textarea',
		'default' => $defaults['locations_intro'],
	) );

	$locations = $loc->add_field( array(
		'id'         => $prefix . 'locations',
		'type'       => 'group',
		'repeatable' => true,
		'options'    => array(
			'group_title'   => __( 'Location {#}', 'pegasus-child' ),
			'add_button'    => __( 'Add location', 'pegasus-child' ),
			'remove_button' => __( 'Remove location', 'pegasus-child' ),
			'closed'        => true,
		),
	) );
	$loc->add_group_field( $locations, array(
		'name'         => __( 'Image', 'pegasus-child' ),
		'id'           => 'image',
		'type'         => 'file',
		'options'      => array( 'url' => false ),
		'query_args'   => array( 'type' => 'image' ),
		'preview_size' => 'medium',
	) );
	$loc->add_group_field( $locations, array(
		'name' => __( 'Title', 'pegasus-child' ),
		'id'   => 'title',
		'type' => 'text',
	) );
	$loc->add_group_field( $locations, array(
		'name' => __( 'Address', 'pegasus-child' ),
		'id'   => 'address',
		'type' => 'text',
	) );
	$loc->add_group_field( $locations, array(
		'name' => __( 'Tap List URL', 'pegasus-child' ),
		'id'   => 'taplist',
		'type' => 'text_url',
	) );
	$loc->add_group_field( $locations, array(
		'name' => __( 'Events URL', 'pegasus-child' ),
		'id'   => 'events',
		'type' => 'text_url',
	) );
	$loc->add_group_field( $locations, array(
		'name' => __( 'Directions &amp; Hours URL', 'pegasus-child' ),
		'id'   => 'directions',
		'type' => 'text_url',
	) );

	/* ===================================================================
	 * FEATURED BREWERIES
	 * =================================================================== */
	$brew = new_cmb2_box( array(
		'id'           => $prefix . 'breweries_box',
		'title'        => __( 'Home &mdash; Featured Breweries', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'context'      => 'normal',
		'priority'     => 'high',
		'closed'       => true,
		'show_on'      => $show_on,
	) );

	$brew->add_field( array(
		'name'    => __( 'Kicker', 'pegasus-child' ),
		'id'      => $prefix . 'breweries_kicker',
		'type'    => 'text',
		'default' => $defaults['breweries_kicker'],
	) );
	$brew->add_field( array(
		'name'    => __( 'Heading', 'pegasus-child' ),
		'id'      => $prefix . 'breweries_heading',
		'type'    => 'text',
		'default' => $defaults['breweries_heading'],
	) );

	$breweries = $brew->add_field( array(
		'id'         => $prefix . 'breweries',
		'type'       => 'group',
		'repeatable' => true,
		'options'    => array(
			'group_title'   => __( 'Brewery {#}', 'pegasus-child' ),
			'add_button'    => __( 'Add brewery', 'pegasus-child' ),
			'remove_button' => __( 'Remove brewery', 'pegasus-child' ),
			'closed'        => true,
		),
	) );
	$brew->add_group_field( $breweries, array(
		'name'         => __( 'Logo', 'pegasus-child' ),
		'id'           => 'logo',
		'type'         => 'file',
		'options'      => array( 'url' => false ),
		'query_args'   => array( 'type' => 'image' ),
		'preview_size' => 'medium',
	) );
	$brew->add_group_field( $breweries, array(
		'name' => __( 'Name (alt text)', 'pegasus-child' ),
		'id'   => 'name',
		'type' => 'text',
	) );
	$brew->add_group_field( $breweries, array(
		'name' => __( 'Link URL (optional)', 'pegasus-child' ),
		'id'   => 'url',
		'type' => 'text_url',
	) );

	/* ===================================================================
	 * EVENTS
	 * =================================================================== */
	$events = new_cmb2_box( array(
		'id'           => $prefix . 'events_box',
		'title'        => __( 'Home &mdash; Events', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'context'      => 'normal',
		'priority'     => 'high',
		'closed'       => true,
		'show_on'      => $show_on,
	) );

	$events->add_field( array(
		'name'    => __( 'Kicker', 'pegasus-child' ),
		'id'      => $prefix . 'events_kicker',
		'type'    => 'text',
		'default' => $defaults['events_kicker'],
	) );
	$events->add_field( array(
		'name'    => __( 'Heading', 'pegasus-child' ),
		'id'      => $prefix . 'events_heading',
		'type'    => 'text',
		'default' => $defaults['events_heading'],
	) );
	$events->add_field( array(
		'name'    => __( 'Text', 'pegasus-child' ),
		'id'      => $prefix . 'events_text',
		'type'    => 'textarea',
		'default' => $defaults['events_text'],
	) );
	$events->add_field( array(
		'name'         => __( 'Image', 'pegasus-child' ),
		'id'           => $prefix . 'events_image',
		'type'         => 'file',
		'options'      => array( 'url' => false ),
		'query_args'   => array( 'type' => 'image' ),
		'preview_size' => 'medium',
	) );

	$events_buttons = $events->add_field( array(
		'id'         => $prefix . 'events_buttons',
		'type'       => 'group',
		'repeatable' => true,
		'options'    => array(
			'group_title'   => __( 'Button {#}', 'pegasus-child' ),
			'add_button'    => __( 'Add button', 'pegasus-child' ),
			'remove_button' => __( 'Remove button', 'pegasus-child' ),
			'closed'        => true,
		),
	) );
	$events->add_group_field( $events_buttons, array(
		'name' => __( 'Label', 'pegasus-child' ),
		'id'   => 'text',
		'type' => 'text',
	) );
	$events->add_group_field( $events_buttons, array(
		'name' => __( 'URL', 'pegasus-child' ),
		'id'   => 'url',
		'type' => 'text_url',
		'attributes' => array( 'type' => 'text' ), // allow mailto: links
	) );
	$events->add_group_field( $events_buttons, array(
		'name'    => __( 'Style', 'pegasus-child' ),
		'id'      => 'style',
		'type'    => 'select',
		'default' => 'gold',
		'options' => $button_style_options,
	) );

	/* ===================================================================
	 * REVIEWS
	 * =================================================================== */
	$reviews = new_cmb2_box( array(
		'id'           => $prefix . 'reviews_box',
		'title'        => __( 'Home &mdash; Reviews', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'context'      => 'normal',
		'priority'     => 'high',
		'closed'       => true,
		'show_on'      => $show_on,
	) );

	$reviews->add_field( array(
		'name'    => __( 'Kicker', 'pegasus-child' ),
		'id'      => $prefix . 'reviews_kicker',
		'type'    => 'text',
		'default' => $defaults['reviews_kicker'],
	) );
	$reviews->add_field( array(
		'name'    => __( 'Heading &mdash; line 1', 'pegasus-child' ),
		'id'      => $prefix . 'reviews_heading_1',
		'type'    => 'text',
		'default' => $defaults['reviews_heading_1'],
	) );
	$reviews->add_field( array(
		'name'    => __( 'Heading &mdash; line 2', 'pegasus-child' ),
		'id'      => $prefix . 'reviews_heading_2',
		'type'    => 'text',
		'default' => $defaults['reviews_heading_2'],
	) );

	$review_group = $reviews->add_field( array(
		'id'         => $prefix . 'reviews',
		'type'       => 'group',
		'repeatable' => true,
		'options'    => array(
			'group_title'   => __( 'Review {#}', 'pegasus-child' ),
			'add_button'    => __( 'Add review', 'pegasus-child' ),
			'remove_button' => __( 'Remove review', 'pegasus-child' ),
			'closed'        => true,
		),
	) );
	$reviews->add_group_field( $review_group, array(
		'name'    => __( 'Rating', 'pegasus-child' ),
		'id'      => 'rating',
		'type'    => 'select',
		'default' => '5',
		'options' => array(
			'5' => '5 stars',
			'4' => '4 stars',
			'3' => '3 stars',
			'2' => '2 stars',
			'1' => '1 star',
		),
	) );
	$reviews->add_group_field( $review_group, array(
		'name' => __( 'Quote', 'pegasus-child' ),
		'id'   => 'quote',
		'type' => 'textarea',
	) );
	$reviews->add_group_field( $review_group, array(
		'name' => __( 'Name', 'pegasus-child' ),
		'id'   => 'name',
		'type' => 'text',
	) );
	$reviews->add_group_field( $review_group, array(
		'name' => __( 'Location', 'pegasus-child' ),
		'id'   => 'location',
		'type' => 'text',
	) );
}
add_action( 'cmb2_admin_init', 'sb_home_register_metaboxes' );

/* =======================================================================
 * FRONT-END HELPERS
 *
 * These resolve saved CMB2 values against the design defaults so the front
 * end shows the default content until a field/group is given real content.
 * ===================================================================== */

/**
 * Get a single Home field, falling back to its design default.
 *
 * @param int    $post_id Page ID.
 * @param string $key     Key without the `_sb_home_` prefix.
 * @return string
 */
function sb_home_field( $post_id, $key ) {
	$defaults = sb_home_defaults();
	$value    = get_post_meta( $post_id, '_sb_home_' . $key, true );

	if ( is_string( $value ) && '' !== trim( $value ) ) {
		return $value;
	}

	return isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';
}

/**
 * Whether a repeated group row contains any real content.
 *
 * @param mixed $row Group row.
 * @return bool
 */
function sb_home_row_has_content( $row ) {
	if ( ! is_array( $row ) ) {
		return false;
	}
	foreach ( $row as $value ) {
		if ( is_array( $value ) ) {
			if ( sb_home_row_has_content( $value ) ) {
				return true;
			}
		} elseif ( '' !== trim( (string) $value ) ) {
			return true;
		}
	}
	return false;
}

/**
 * Get a repeatable Home group, falling back to its design default when no
 * row has real content (CMB2's blank starter row does not count).
 *
 * @param int    $post_id Page ID.
 * @param string $key     Key without the `_sb_home_` prefix.
 * @return array
 */
function sb_home_group( $post_id, $key ) {
	$defaults = sb_home_defaults();
	$rows     = get_post_meta( $post_id, '_sb_home_' . $key, true );

	if ( is_array( $rows ) ) {
		$rows = array_values( array_filter( $rows, 'sb_home_row_has_content' ) );
		if ( ! empty( $rows ) ) {
			return $rows;
		}
	}

	return isset( $defaults[ $key ] ) ? $defaults[ $key ] : array();
}

/**
 * Render a set of CTA buttons from a group array.
 *
 * @param array $buttons Rows of text/url/style.
 */
function sb_home_render_buttons( $buttons ) {
	if ( empty( $buttons ) || ! is_array( $buttons ) ) {
		return;
	}
	echo '<div class="d-flex flex-wrap gap-3 mt-4">';
	foreach ( $buttons as $button ) {
		$label = isset( $button['text'] ) ? $button['text'] : '';
		$url   = isset( $button['url'] ) ? $button['url'] : '#';
		$style = ( isset( $button['style'] ) && 'outline' === $button['style'] ) ? 'sb-btn-outline' : 'sb-btn-gold';

		if ( '' === trim( (string) $label ) ) {
			continue;
		}
		printf(
			'<a href="%1$s" class="btn %2$s rounded-1 px-4 py-2">%3$s</a>',
			esc_url( $url ),
			esc_attr( $style ),
			esc_html( $label )
		);
	}
	echo '</div>';
}
