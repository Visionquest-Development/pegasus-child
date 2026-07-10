<?php
/**
 * Russell Contracting — CMB2 fields + default content.
 *
 * All page content is driven by this one file:
 *   - RC_Defaults holds the default copy from the Claude Design handoff.
 *   - CMB2 metaboxes are registered with those defaults prefilled.
 *   - rc_field() / rc_group() in the templates pull the saved value with a
 *     fallback to the same defaults, so pages render correctly even before
 *     an editor touches them.
 *
 * Header + footer chrome are handled by the parent Pegasus theme, so no
 * global theme options are registered here — only per-template page fields.
 *
 * Include from functions.php:  require_once __DIR__ . '/inc/cmb2-fields.php';
 * Requires the CMB2 plugin (or CMB2 loaded as a mu-plugin / library).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* ============================================================
 * DEFAULT CONTENT — single source of truth
 * ============================================================ */

class RC_Defaults {

	public static function home_hero() {
		return array(
			'headline_line1'    => 'Remodeling & Home Improvement',
			'headline_line2'    => 'Done Right',
			'subhead'           => 'Kitchens, bathrooms, and full home renovations built with craftsmanship and care — serving the Greater Atlanta area.',
			'primary_btn_text'  => 'Get a Free Quote',
			'primary_btn_url'   => '/contact/',
			'secondary_btn_text'=> 'View Services',
			'secondary_btn_url' => '/services/',
		);
	}

	public static function home_services_intro() {
		return array(
			'eyebrow'  => 'Our Services',
			'subtitle' => 'Whatever your project — we handle it start to finish.',
		);
	}

	public static function home_services() {
		return array(
			array(
				'title' => 'Kitchen Remodeling',
				'icon'  => 'bi-house-heart',
				'blurb' => "Custom cabinetry, countertops, and layouts that turn the heart of your home into a space you'll love to cook and gather in.",
				'url'   => '/services/#kitchens',
			),
			array(
				'title' => 'Bathroom Remodeling',
				'icon'  => 'bi-droplet',
				'blurb' => 'From simple refreshes to full spa-style renovations — tile, vanities, showers, and fixtures done with a clean, lasting finish.',
				'url'   => '/services/#bathrooms',
			),
			array(
				'title' => 'Home Remodeling & Additions',
				'icon'  => 'bi-hammer',
				'blurb' => 'Basements, additions, flooring, trim, and whole-home renovations that expand and modernize your living space.',
				'url'   => '/services/#remodeling',
			),
			array(
				'title' => 'Repairs & Home Improvement',
				'icon'  => 'bi-tools',
				'blurb' => 'Reliable handyman work and repairs — drywall, painting, doors, decks, and the punch-list projects that keep your home in shape.',
				'url'   => '/services/#repairs',
			),
		);
	}

	public static function home_why_intro() {
		return array(
			'eyebrow'  => 'Why Choose Us',
			'subtitle' => 'A few reasons your neighbors trust Russell Contracting.',
		);
	}

	public static function home_reasons() {
		return array(
			array( 'title' => 'Licensed & Insured',       'icon' => 'bi-patch-check-fill',    'text' => 'Fully licensed, bonded, and insured for your peace of mind.' ),
			array( 'title' => 'Experienced Craftsmanship','icon' => 'bi-award-fill',          'text' => 'Years of hands-on remodeling and home improvement work.' ),
			array( 'title' => 'Free Estimates',           'icon' => 'bi-clipboard-check-fill','text' => 'Honest, detailed quotes at no cost and no pressure.' ),
			array( 'title' => 'Local & Trusted',          'icon' => 'bi-geo-alt-fill',        'text' => 'We live and work here — your neighbors and your crew.' ),
			array( 'title' => 'Quality Materials',        'icon' => 'bi-box-seam-fill',       'text' => 'We use dependable materials that stand the test of time.' ),
			array( 'title' => 'Clear Communication',      'icon' => 'bi-chat-left-text-fill', 'text' => 'One point of contact keeping you informed start to finish.' ),
		);
	}

	public static function home_cta() {
		return array(
			'headline' => 'Ready to start your project?',
			'subhead'  => "Get in touch and we'll put together a free, no-pressure quote.",
			'btn_text' => 'Get in Touch',
			'btn_url'  => '/contact/',
		);
	}

	public static function services_page_header() {
		return array(
			'title'    => 'Services',
			'subtitle' => 'Explore what Russell Contracting can do for your home.',
		);
	}

	/* ---- Contact page defaults ---------------------------------------- */

	public static function contact_page_header() {
		return array(
			'title'    => 'Contact',
			'subtitle' => "Reach out — we're happy to talk through your project.",
		);
	}

	public static function contact_info_intro() {
		return array(
			'eyebrow'  => 'Get in Touch',
			'lead'     => 'Ready to start a project or have a question? Call, email, or send us a note and we\'ll be in touch shortly.',
		);
	}

	public static function contact_info_tiles() {
		return array(
			array(
				'icon'  => 'bi-telephone-fill',
				'label' => 'Call us',
				'value' => '(770) 883-7042',
				'link'  => 'tel:7708837042',
			),
			array(
				'icon'  => 'bi-envelope-fill',
				'label' => 'Email us',
				'value' => 'russellcontracting@gmail.com',
				'link'  => 'mailto:russellcontracting@gmail.com',
			),
			array(
				'icon'  => 'bi-geo-alt-fill',
				'label' => 'Service area',
				'value' => 'Greater Atlanta area',
				'link'  => '',
			),
			array(
				'icon'  => 'bi-clock-fill',
				'label' => 'Hours',
				'value' => 'Mon–Fri, 8am–6pm',
				'link'  => '',
			),
		);
	}

	public static function contact_form_intro() {
		return array(
			'eyebrow'   => 'Send a Message',
			'lead'      => 'Tell us a little about the project and the best way to reach you — we\'ll get back to you within one business day.',
			/* Default shortcode: a Gravity Forms tag pointing at form id 1
			 * with the plugin's built-in title/description hidden (the
			 * template renders our own eyebrow + lead above the form) and
			 * AJAX submission enabled. Change or clear from the page's
			 * "Contact — Gravity Forms" metabox. Empty string keeps the
			 * whole form section hidden until a shortcode is entered. */
			'shortcode' => '',
		);
	}

	public static function contact_cta() {
		return array(
			'headline' => 'Prefer to talk it through?',
			'subhead'  => 'Give us a call and we can walk you through options over the phone.',
			'btn_text' => 'Call (770) 883-7042',
			'btn_url'  => 'tel:7708837042',
		);
	}

	public static function services_cta() {
		return array(
			'headline' => 'Not sure where to start?',
			'subhead'  => "Tell us about your project and we'll walk you through the options — free of charge.",
			'btn_text' => 'Get in Touch',
			'btn_url'  => '/contact/',
		);
	}

	/**
	 * Sub-lists and project lists are stored as pipe/newline-delimited text
	 * inside each service group (CMB2 does not support nested repeatable groups).
	 *   subs_text        — one per line, format "Label|icon-class"
	 *   projects         — one per line, plain label
	 *   gallery_folder   — comma-separated list of subfolders under
	 *                      /assets/images/ that supply masonry-gallery photos
	 *   feature_image    — filename inside one of those folders (falls back
	 *                      to the first image in the gallery folder)
	 */
	public static function services_sections() {
		return array(
			array(
				'id'             => 'kitchens',
				'title'          => 'Kitchen Remodeling',
				'icon'           => 'bi-house-heart',
				'lead'           => 'The kitchen is where your home comes together — we build it to look great and work even better.',
				'body'           => 'From cabinets and countertops to lighting, backsplash, and full layout changes, we manage every detail with clean, lasting craftsmanship.',
				'subs_text'      => "Cabinets & Countertops|bi-columns-gap|kitchens/finished-kitchen-dark-wood-marble-02.jpg\nBacksplash & Tile|bi-grid-3x3-gap|kitchens/finished-kitchen-double-oven-marble-01.jpg\nLayouts & Islands|bi-bounding-box|kitchens/finished-kitchen-marble-island-01.jpg",
				'projects'       => "Canton Kitchen\nWoodstock Kitchen\nRoswell Remodel",
				'gallery_folder' => 'kitchens',
				'feature_image'  => 'kitchens/finished-kitchen-marble-island-pendants.jpg',
			),
			array(
				'id'             => 'bathrooms',
				'title'          => 'Bathroom Remodeling',
				'icon'           => 'bi-droplet',
				'lead'           => 'From quick refreshes to full spa-style renovations, we make bathrooms both beautiful and built to last.',
				'body'           => "Tile showers, vanities, fixtures, flooring, and waterproofing — done right the first time with a finish you'll be proud of.",
				'subs_text'      => "Showers & Tubs|bi-water|bathrooms/finished-dark-tile-shower-glass-enclosure-01.jpg\nVanities & Fixtures|bi-sliders|bathrooms/finished-double-vanity-marble-dark-wood-01.jpg\nTile & Flooring|bi-grid-1x2|bathrooms/finished-dark-tile-shower-rainfall-head.jpg",
				'projects'       => "Master Bath\nGuest Bath\nPowder Room",
				'gallery_folder' => 'bathrooms',
				'feature_image'  => 'bathrooms/finished-walnut-vanity-quartzite-copper-sink-01.jpg',
			),
			array(
				'id'             => 'remodeling',
				'title'          => 'Home Remodeling & Additions',
				'icon'           => 'bi-hammer',
				'lead'           => 'Ready for more space or a whole new look? We handle renovations big and small, start to finish.',
				'body'           => 'Basement finishes, room additions, flooring, trim, and whole-home updates — expanding and modernizing the way you live.',
				/* No 'What we do' tiles — asset folders don't yet include Basements /
				   Additions / Flooring & Trim photos. Empty subs_text makes the
				   template skip the whole section (see tpl_services.php). */
				'subs_text'      => '',
				'projects'       => "Basement Finish\nHome Addition\nOpen Concept",
				'gallery_folder' => 'interior-remodels,wine-cellars',
				'feature_image'  => 'interior-remodels/finished-home-library-shelving-leather-chair.jpg',
			),
			array(
				'id'             => 'repairs',
				'title'          => 'Repairs & Home Improvement',
				'icon'           => 'bi-tools',
				'lead'           => 'The dependable handyman work that keeps your home in top shape — no job too small.',
				'body'           => 'Drywall, painting, doors, decks, fixtures, and punch-list projects handled quickly and cleanly by a crew you can trust.',
				/* No 'What we do' tiles — asset folders don't yet include Drywall &
				   Painting or generic punch-list work. */
				'subs_text'      => '',
				'projects'       => "Deck Rebuild\nInterior Paint\nTrim & Doors",
				'gallery_folder' => 'decks-porches,exteriors',
				'feature_image'  => 'decks-porches/finished-outdoor-living-space-steel-doors.jpg',
			),
		);
	}
}

/* ============================================================
 * Template helpers — fetch saved value, fall back to defaults
 * ============================================================ */

/**
 * Get a single CMB2 post-meta value with a default fallback.
 * Empty string is treated as "not set" so defaults win.
 */
function rc_field( $key, $default = '', $post_id = null ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	if ( ! $post_id ) {
		return $default;
	}
	$value = get_post_meta( $post_id, $key, true );
	return ( '' === $value || null === $value ) ? $default : $value;
}

/**
 * Get a CMB2 group value with a default fallback (returns the default
 * array untouched if the group has never been saved).
 */
function rc_group( $key, $default = array(), $post_id = null ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	if ( ! $post_id ) {
		return $default;
	}
	$value = get_post_meta( $post_id, $key, true );
	return ( is_array( $value ) && ! empty( $value ) ) ? $value : $default;
}

/**
 * Resolve a link value from the field editor. If it's already an absolute URL,
 * a fragment, mailto, or tel link, return as-is. Otherwise prepend home_url().
 */
function rc_link( $url ) {
	$url = (string) $url;
	if ( '' === $url ) {
		return '#';
	}
	if ( preg_match( '#^(https?:)?//#i', $url ) ) {
		return esc_url( $url );
	}
	if ( 0 === strpos( $url, '#' ) || 0 === strpos( $url, 'mailto:' ) || 0 === strpos( $url, 'tel:' ) ) {
		return esc_url( $url );
	}
	return esc_url( home_url( $url ) );
}

/**
 * Parse a subs textarea like "Label|icon-class|image-path" (one per line)
 * into an array of arrays with 'label', 'icon', and 'image' keys.
 *
 * The image path is optional; when present it's a path relative to
 * /assets/images/ (or a fully-qualified URL). The template uses the image
 * for the sub-service tile; when it's missing the tile is skipped.
 *
 * Silently drops blank/malformed lines.
 */
function rc_parse_subs( $text ) {
	$out = array();
	if ( ! is_string( $text ) || '' === trim( $text ) ) {
		return $out;
	}
	foreach ( preg_split( '/\r\n|\r|\n/', $text ) as $line ) {
		$line = trim( $line );
		if ( '' === $line ) {
			continue;
		}
		$parts = array_map( 'trim', explode( '|', $line, 3 ) );
		$out[] = array(
			'label' => isset( $parts[0] ) ? $parts[0] : '',
			'icon'  => isset( $parts[1] ) ? $parts[1] : 'bi-check2',
			'image' => isset( $parts[2] ) ? $parts[2] : '',
		);
	}
	return $out;
}

/**
 * Return a list of image URLs from one or more subfolders of
 * /assets/images/. Accepts a folder path or a comma-separated list of paths
 * (relative to /assets/images/). Optionally exclude filenames present in
 * $exclude (compared by basename).
 *
 * Cached per request. Returns URLs in natural sort order.
 */
function rc_folder_images( $folders, $exclude = array() ) {
	static $cache = array();

	if ( is_string( $folders ) ) {
		$folders = array_filter( array_map( 'trim', explode( ',', $folders ) ) );
	}
	if ( empty( $folders ) ) {
		return array();
	}

	$key = md5( implode( '|', $folders ) . '::' . implode( ',', (array) $exclude ) );
	if ( isset( $cache[ $key ] ) ) {
		return $cache[ $key ];
	}

	$exclude_map = array();
	foreach ( (array) $exclude as $ex ) {
		$exclude_map[ basename( $ex ) ] = true;
	}

	$out = array();
	foreach ( $folders as $folder ) {
		$rel = trim( $folder, '/' );
		if ( '' === $rel ) {
			continue;
		}
		$dir = get_stylesheet_directory() . '/assets/images/' . $rel;
		$url = get_stylesheet_directory_uri() . '/assets/images/' . $rel;
		if ( ! is_dir( $dir ) ) {
			continue;
		}
		$files = glob( $dir . '/*.{jpg,jpeg,png,webp,JPG,JPEG,PNG,WEBP}', GLOB_BRACE );
		if ( ! is_array( $files ) ) {
			continue;
		}
		natcasesort( $files );
		foreach ( $files as $path ) {
			$base = basename( $path );
			if ( isset( $exclude_map[ $base ] ) ) {
				continue;
			}
			$out[] = $url . '/' . $base;
		}
	}
	$cache[ $key ] = $out;
	return $out;
}

/**
 * Turn a filename into a human-readable caption for the lightbox — strips
 * the "finished-" prefix, the numeric suffix, and swaps dashes for spaces.
 */
function rc_caption_from_filename( $url ) {
	$name = pathinfo( $url, PATHINFO_FILENAME );
	$name = preg_replace( '/^finished-/i', '', $name );
	$name = preg_replace( '/-\d{2,}$/', '', $name );
	$name = str_replace( array( '-', '_' ), ' ', $name );
	return ucwords( trim( $name ) );
}

/**
 * Render a masonry + Lightbox2 gallery matching the 34oak theme's HTML
 * (see oak_render_masonry_gallery). Wraps <a data-lightbox="…"> anchors
 * inside a [masonry] shortcode, executed via do_shortcode(). No inline
 * styles emitted. WOW.js / animate.css classes intentionally omitted —
 * they were leaving some tiles hidden until the user tapped them.
 *
 * @param array  $urls          Image URLs to render.
 * @param string $lightbox_group Grouping id so Lightbox2 shows prev/next.
 * @param string $lightbox_title Default caption; per-image caption is
 *                                derived from filename when omitted.
 * @param int    $eager_count   Kept for signature compatibility; currently
 *                                unused — every image loads eagerly.
 */
function rc_render_masonry_gallery( $urls, $lightbox_group = 'gallery', $lightbox_title = '', $eager_count = 0 ) {
	if ( empty( $urls ) || ! is_array( $urls ) ) {
		return;
	}
	unset( $eager_count ); /* silence unused-parameter warning */

	$html = '[masonry]';
	foreach ( $urls as $url ) {
		$title = '' !== $lightbox_title ? $lightbox_title : rc_caption_from_filename( $url );

		$html .= sprintf(
			'<a href="%1$s" data-lightbox="%2$s" data-title="%3$s"><img src="%1$s" alt="%3$s" loading="eager" decoding="async"></a>',
			esc_url( $url ),
			esc_attr( $lightbox_group ),
			esc_attr( $title )
		);
	}
	$html .= '[/masonry]';

	echo do_shortcode( $html );
}

/**
 * Parse one-per-line text into an array of trimmed non-empty strings.
 */
function rc_parse_lines( $text ) {
	if ( ! is_string( $text ) || '' === trim( $text ) ) {
		return array();
	}
	$out = array();
	foreach ( preg_split( '/\r\n|\r|\n/', $text ) as $line ) {
		$line = trim( $line );
		if ( '' !== $line ) {
			$out[] = $line;
		}
	}
	return $out;
}

/* ============================================================
 * CMB2 metaboxes and options page
 * ============================================================ */

add_action( 'cmb2_admin_init', 'rc_register_cmb2_fields' );

function rc_register_cmb2_fields() {

	if ( ! function_exists( 'new_cmb2_box' ) ) {
		return;
	}

	rc_register_home_metaboxes();
	rc_register_services_metaboxes();
	rc_register_contact_metaboxes();
}

/* ---- Home page metaboxes: hero, services grid, why choose us ---- */
function rc_register_home_metaboxes() {

	$show_on_home = array(
		'key'   => 'page-template',
		'value' => 'tpl_home.php',
	);

	/* Hero */
	$hero_defaults = RC_Defaults::home_hero();
	$hero = new_cmb2_box( array(
		'id'           => 'rc_home_hero',
		'title'        => __( 'Home — Hero', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'show_on'      => $show_on_home,
		'context'      => 'normal',
		'priority'     => 'high',
	) );
	$hero->add_field( array( 'name' => 'Headline — line 1', 'id' => 'rc_hero_headline_line1', 'type' => 'text',           'default' => $hero_defaults['headline_line1'] ) );
	$hero->add_field( array( 'name' => 'Headline — line 2 (gold)', 'id' => 'rc_hero_headline_line2', 'type' => 'text',           'default' => $hero_defaults['headline_line2'] ) );
	$hero->add_field( array( 'name' => 'Subhead',            'id' => 'rc_hero_subhead',        'type' => 'textarea_small', 'default' => $hero_defaults['subhead'] ) );
	$hero->add_field( array( 'name' => 'Badge image',        'id' => 'rc_hero_badge_image',    'type' => 'file',           'options' => array( 'url' => false ) ) );
	$hero->add_field( array( 'name' => 'Primary button label',  'id' => 'rc_hero_primary_btn_text',   'type' => 'text',     'default' => $hero_defaults['primary_btn_text'] ) );
	$hero->add_field( array( 'name' => 'Primary button URL',    'id' => 'rc_hero_primary_btn_url',    'type' => 'text',     'default' => $hero_defaults['primary_btn_url'] ) );
	$hero->add_field( array( 'name' => 'Secondary button label','id' => 'rc_hero_secondary_btn_text', 'type' => 'text',     'default' => $hero_defaults['secondary_btn_text'] ) );
	$hero->add_field( array( 'name' => 'Secondary button URL',  'id' => 'rc_hero_secondary_btn_url',  'type' => 'text',     'default' => $hero_defaults['secondary_btn_url'] ) );

	/* Services grid intro + repeatable cards */
	$svc_intro = RC_Defaults::home_services_intro();
	$svc = new_cmb2_box( array(
		'id'           => 'rc_home_services',
		'title'        => __( 'Home — Services Grid', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'show_on'      => $show_on_home,
	) );
	$svc->add_field( array( 'name' => 'Eyebrow heading', 'id' => 'rc_services_eyebrow',  'type' => 'text',           'default' => $svc_intro['eyebrow'] ) );
	$svc->add_field( array( 'name' => 'Subtitle',         'id' => 'rc_services_subtitle', 'type' => 'textarea_small', 'default' => $svc_intro['subtitle'] ) );

	$svc_group_id = $svc->add_field( array(
		'id'      => 'rc_services',
		'type'    => 'group',
		'name'    => __( 'Service cards', 'pegasus-child' ),
		'options' => array(
			'group_title'   => __( 'Service {#}', 'pegasus-child' ),
			'add_button'    => __( 'Add service', 'pegasus-child' ),
			'remove_button' => __( 'Remove service', 'pegasus-child' ),
			'sortable'      => true,
		),
	) );
	$svc->add_group_field( $svc_group_id, array( 'name' => 'Title', 'id' => 'title', 'type' => 'text' ) );
	$svc->add_group_field( $svc_group_id, array( 'name' => 'Bootstrap icon class (e.g. bi-hammer)', 'id' => 'icon', 'type' => 'text' ) );
	$svc->add_group_field( $svc_group_id, array( 'name' => 'Blurb', 'id' => 'blurb', 'type' => 'textarea_small' ) );
	$svc->add_group_field( $svc_group_id, array( 'name' => 'Learn more URL', 'id' => 'url', 'type' => 'text' ) );

	/* Why Choose Us intro + repeatable tiles */
	$why_intro = RC_Defaults::home_why_intro();
	$why = new_cmb2_box( array(
		'id'           => 'rc_home_why',
		'title'        => __( 'Home — Why Choose Us', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'show_on'      => $show_on_home,
	) );
	$why->add_field( array( 'name' => 'Eyebrow heading', 'id' => 'rc_why_eyebrow',  'type' => 'text',           'default' => $why_intro['eyebrow'] ) );
	$why->add_field( array( 'name' => 'Subtitle',         'id' => 'rc_why_subtitle', 'type' => 'textarea_small', 'default' => $why_intro['subtitle'] ) );

	$why_group_id = $why->add_field( array(
		'id'      => 'rc_reasons',
		'type'    => 'group',
		'name'    => __( 'Reasons', 'pegasus-child' ),
		'options' => array(
			'group_title'   => __( 'Reason {#}', 'pegasus-child' ),
			'add_button'    => __( 'Add reason', 'pegasus-child' ),
			'remove_button' => __( 'Remove reason', 'pegasus-child' ),
			'sortable'      => true,
		),
	) );
	$why->add_group_field( $why_group_id, array( 'name' => 'Title', 'id' => 'title', 'type' => 'text' ) );
	$why->add_group_field( $why_group_id, array( 'name' => 'Bootstrap icon class', 'id' => 'icon', 'type' => 'text' ) );
	$why->add_group_field( $why_group_id, array( 'name' => 'Text', 'id' => 'text', 'type' => 'textarea_small' ) );

	/* Bottom CTA band */
	$cta_defaults = RC_Defaults::home_cta();
	$cta = new_cmb2_box( array(
		'id'           => 'rc_home_cta',
		'title'        => __( 'Home — Bottom CTA Band', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'show_on'      => $show_on_home,
	) );
	$cta->add_field( array( 'name' => 'Headline',     'id' => 'rc_home_cta_headline', 'type' => 'text',           'default' => $cta_defaults['headline'] ) );
	$cta->add_field( array( 'name' => 'Subhead',      'id' => 'rc_home_cta_subhead',  'type' => 'textarea_small', 'default' => $cta_defaults['subhead'] ) );
	$cta->add_field( array( 'name' => 'Button label', 'id' => 'rc_home_cta_btn_text', 'type' => 'text',           'default' => $cta_defaults['btn_text'] ) );
	$cta->add_field( array( 'name' => 'Button URL',   'id' => 'rc_home_cta_btn_url',  'type' => 'text',           'default' => $cta_defaults['btn_url'] ) );
}

/* ---- Services page metaboxes: header, per-service sections, CTA ---- */
function rc_register_services_metaboxes() {

	$show_on_services = array(
		'key'   => 'page-template',
		'value' => 'tpl_services.php',
	);

	/* Page header */
	$header_defaults = RC_Defaults::services_page_header();
	$hdr = new_cmb2_box( array(
		'id'           => 'rc_services_header',
		'title'        => __( 'Services — Page Header', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'show_on'      => $show_on_services,
		'context'      => 'normal',
		'priority'     => 'high',
	) );
	$hdr->add_field( array( 'name' => 'Title',    'id' => 'rc_svc_page_title',    'type' => 'text',           'default' => $header_defaults['title'] ) );
	$hdr->add_field( array( 'name' => 'Subtitle', 'id' => 'rc_svc_page_subtitle', 'type' => 'textarea_small', 'default' => $header_defaults['subtitle'] ) );

	/* Service sections (repeatable) */
	$sections = new_cmb2_box( array(
		'id'           => 'rc_services_sections',
		'title'        => __( 'Services — Sections', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'show_on'      => $show_on_services,
	) );
	$sec_group_id = $sections->add_field( array(
		'id'      => 'rc_service_sections',
		'type'    => 'group',
		'name'    => __( 'Service sections', 'pegasus-child' ),
		'options' => array(
			'group_title'   => __( 'Section {#}', 'pegasus-child' ),
			'add_button'    => __( 'Add section', 'pegasus-child' ),
			'remove_button' => __( 'Remove section', 'pegasus-child' ),
			'sortable'      => true,
		),
	) );
	$sections->add_group_field( $sec_group_id, array( 'name' => 'Anchor ID (kitchens, bathrooms, ...)', 'id' => 'id',    'type' => 'text' ) );
	$sections->add_group_field( $sec_group_id, array( 'name' => 'Title', 'id' => 'title', 'type' => 'text' ) );
	$sections->add_group_field( $sec_group_id, array( 'name' => 'Bootstrap icon class', 'id' => 'icon',  'type' => 'text' ) );
	$sections->add_group_field( $sec_group_id, array( 'name' => 'Lead paragraph',       'id' => 'lead',  'type' => 'textarea_small' ) );
	$sections->add_group_field( $sec_group_id, array( 'name' => 'Body paragraph',       'id' => 'body',  'type' => 'textarea_small' ) );
	$sections->add_group_field( $sec_group_id, array(
		'name' => 'Feature image (optional — replaces the placeholder tile)',
		'id'   => 'feature_image',
		'type' => 'file',
		'options' => array( 'url' => false ),
	) );
	$sections->add_group_field( $sec_group_id, array(
		'name' => 'Gallery folder(s)',
		'desc' => 'Comma-separated subfolder(s) under /assets/images/ — e.g. "kitchens" or "decks-porches,exteriors". The masonry gallery pulls every image inside.',
		'id'   => 'gallery_folder',
		'type' => 'text',
	) );
	$sections->add_group_field( $sec_group_id, array(
		'name' => 'Gallery images (optional — override folder scan)',
		'desc' => 'Attach a curated set of images if you don\'t want to show everything in the folder.',
		'id'   => 'gallery_images',
		'type' => 'file_list',
		'preview_size' => array( 120, 90 ),
	) );
	$sections->add_group_field( $sec_group_id, array(
		'name' => 'Sub-services — one per line, "Label|bi-icon-class"',
		'desc' => 'e.g. Cabinets & Countertops|bi-columns-gap',
		'id'   => 'subs_text',
		'type' => 'textarea_small',
	) );
	$sections->add_group_field( $sec_group_id, array(
		'name' => 'Recent projects — one per line',
		'id'   => 'projects',
		'type' => 'textarea_small',
	) );

	/* CTA band (page-specific override for services page) */
	$cta_defaults = RC_Defaults::services_cta();
	$cta = new_cmb2_box( array(
		'id'           => 'rc_services_cta',
		'title'        => __( 'Services — Bottom CTA Band', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'show_on'      => $show_on_services,
	) );
	$cta->add_field( array( 'name' => 'Headline', 'id' => 'rc_svc_cta_headline', 'type' => 'text',           'default' => $cta_defaults['headline'] ) );
	$cta->add_field( array( 'name' => 'Subhead',  'id' => 'rc_svc_cta_subhead',  'type' => 'textarea_small', 'default' => $cta_defaults['subhead'] ) );
	$cta->add_field( array( 'name' => 'Button label', 'id' => 'rc_svc_cta_btn_text', 'type' => 'text',       'default' => $cta_defaults['btn_text'] ) );
	$cta->add_field( array( 'name' => 'Button URL',   'id' => 'rc_svc_cta_btn_url',  'type' => 'text',       'default' => $cta_defaults['btn_url'] ) );
}

/* ---- Contact page metaboxes: header, info tiles, form, CTA ------------ */
function rc_register_contact_metaboxes() {

	$show_on_contact = array(
		'key'   => 'page-template',
		'value' => 'tpl_contact.php',
	);

	/* Page header */
	$header_defaults = RC_Defaults::contact_page_header();
	$hdr = new_cmb2_box( array(
		'id'           => 'rc_contact_header',
		'title'        => __( 'Contact — Page Header', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'show_on'      => $show_on_contact,
		'context'      => 'normal',
		'priority'     => 'high',
	) );
	$hdr->add_field( array( 'name' => 'Title',    'id' => 'rc_contact_page_title',    'type' => 'text',           'default' => $header_defaults['title'] ) );
	$hdr->add_field( array( 'name' => 'Subtitle', 'id' => 'rc_contact_page_subtitle', 'type' => 'textarea_small', 'default' => $header_defaults['subtitle'] ) );

	/* Info intro + repeatable contact tiles */
	$info_intro = RC_Defaults::contact_info_intro();
	$info = new_cmb2_box( array(
		'id'           => 'rc_contact_info',
		'title'        => __( 'Contact — Info & Details', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'show_on'      => $show_on_contact,
	) );
	$info->add_field( array( 'name' => 'Eyebrow heading', 'id' => 'rc_contact_info_eyebrow', 'type' => 'text',           'default' => $info_intro['eyebrow'] ) );
	$info->add_field( array( 'name' => 'Lead paragraph',  'id' => 'rc_contact_info_lead',    'type' => 'textarea_small', 'default' => $info_intro['lead'] ) );

	$tiles_group_id = $info->add_field( array(
		'id'      => 'rc_contact_tiles',
		'type'    => 'group',
		'name'    => __( 'Contact tiles', 'pegasus-child' ),
		'options' => array(
			'group_title'   => __( 'Tile {#}', 'pegasus-child' ),
			'add_button'    => __( 'Add tile', 'pegasus-child' ),
			'remove_button' => __( 'Remove tile', 'pegasus-child' ),
			'sortable'      => true,
		),
	) );
	$info->add_group_field( $tiles_group_id, array( 'name' => 'Bootstrap icon class (e.g. bi-telephone-fill)', 'id' => 'icon',  'type' => 'text' ) );
	$info->add_group_field( $tiles_group_id, array( 'name' => 'Label (e.g. "Call us")',                       'id' => 'label', 'type' => 'text' ) );
	$info->add_group_field( $tiles_group_id, array( 'name' => 'Value (e.g. "(770) 883-7042")',                'id' => 'value', 'type' => 'text' ) );
	$info->add_group_field( $tiles_group_id, array( 'name' => 'Link (optional — tel:, mailto:, or URL)',      'id' => 'link',  'type' => 'text' ) );

	/* Form section */
	$form_defaults = RC_Defaults::contact_form_intro();
	$form = new_cmb2_box( array(
		'id'           => 'rc_contact_form',
		'title'        => __( 'Contact — Gravity Forms', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'show_on'      => $show_on_contact,
	) );
	$form->add_field( array( 'name' => 'Eyebrow heading', 'id' => 'rc_contact_form_eyebrow', 'type' => 'text',           'default' => $form_defaults['eyebrow'] ) );
	$form->add_field( array( 'name' => 'Lead paragraph',  'id' => 'rc_contact_form_lead',    'type' => 'textarea_small', 'default' => $form_defaults['lead'] ) );
	$form->add_field( array(
		'name'    => 'Gravity Forms shortcode',
		'desc'    => 'Paste your Gravity Forms shortcode here, e.g. <code>[gravityform id="1" title="false" description="false" ajax="true"]</code>. Any other form-plugin shortcode (Contact Form 7, WPForms, Ninja Forms) also works. Leave blank to hide the entire form section.',
		'id'      => 'rc_contact_form_shortcode',
		'type'    => 'textarea_small',
		'default' => $form_defaults['shortcode'],
	) );

	/* Bottom CTA */
	$cta_defaults = RC_Defaults::contact_cta();
	$cta = new_cmb2_box( array(
		'id'           => 'rc_contact_cta',
		'title'        => __( 'Contact — Bottom CTA Band', 'pegasus-child' ),
		'object_types' => array( 'page' ),
		'show_on'      => $show_on_contact,
	) );
	$cta->add_field( array( 'name' => 'Headline',     'id' => 'rc_contact_cta_headline', 'type' => 'text',           'default' => $cta_defaults['headline'] ) );
	$cta->add_field( array( 'name' => 'Subhead',      'id' => 'rc_contact_cta_subhead',  'type' => 'textarea_small', 'default' => $cta_defaults['subhead'] ) );
	$cta->add_field( array( 'name' => 'Button label', 'id' => 'rc_contact_cta_btn_text', 'type' => 'text',           'default' => $cta_defaults['btn_text'] ) );
	$cta->add_field( array( 'name' => 'Button URL',   'id' => 'rc_contact_cta_btn_url',  'type' => 'text',           'default' => $cta_defaults['btn_url'] ) );
}
