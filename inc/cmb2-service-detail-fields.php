<?php
/**
 * CMB2 fields + helpers for the individual Service Detail pages ( tpl_service_detail.php ).
 *
 * Each service on the Services page ( the shared rcd_services rows ) can have its
 * own child page built on tpl_service_detail.php. The detail page reuses the
 * shared service row for its hero + intro ( matched by the `rcd_service_anchor`
 * meta ) and adds its own repeatable Project Galleries.
 *
 * Mirrors the 34oak pattern ( oak_projects_group ) but in the Rene Catherine
 * brand and kept fully data-driven.
 *
 * @package Pegasus_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* ============================================================================
 * METABOX REGISTRATION
 * ========================================================================== */
add_action( 'cmb2_admin_init', 'rcd_service_detail_register_metaboxes' );
/**
 * Register the service-detail metaboxes. Shown only on pages using
 * tpl_service_detail.php.
 */
function rcd_service_detail_register_metaboxes() {

	if ( ! function_exists( 'new_cmb2_box' ) ) {
		return;
	}

	$prefix = 'rcd_detail_';

	$box_args = array(
		'object_types' => array( 'page' ),
		'context'      => 'normal',
		'priority'     => 'high',
		'closed'       => true, // Metabox collapsed by default.
		'show_on_cb'   => 'rcd_service_detail_show_for_template',
	);

	/* ---------------------------------------------------------------------
	 * LINK TO SHARED SERVICE
	 * ------------------------------------------------------------------- */
	$link = new_cmb2_box( array_merge( $box_args, array(
		'id'    => $prefix . 'link_box',
		'title' => __( 'Service Detail — Linked Service', 'pegasus-child' ),
	) ) );
	$link->add_field( array(
		'name'    => __( 'Service anchor', 'pegasus-child' ),
		'desc'    => __( 'Which service this page details. Must match the "Anchor id" of a service on the Services page ( e.g. bespoke, restoration, technical ). The hero image, title, tag and intro copy are pulled from that service so everything stays in sync.', 'pegasus-child' ),
		'id'      => $prefix . 'anchor',
		'type'    => 'text_medium',
	) );
	$link->add_field( array(
		'name'    => __( 'Intro override ( optional )', 'pegasus-child' ),
		'desc'    => __( 'Leave blank to use the linked service\'s body copy. Fill in to show custom intro paragraphs on this page only.', 'pegasus-child' ),
		'id'      => $prefix . 'intro',
		'type'    => 'textarea',
	) );

	/* ---------------------------------------------------------------------
	 * PROJECT GALLERIES  ( repeatable )
	 * ------------------------------------------------------------------- */
	$proj = new_cmb2_box( array_merge( $box_args, array(
		'id'    => $prefix . 'projects_box',
		'title' => __( 'Service Detail — Project Galleries', 'pegasus-child' ),
	) ) );
	// Each row is ONE image tagged with a Section. Images sharing a Section name
	// render together as one gallery block ( with that section's heading + anchor ).
	// ( CMB2 can't nest a group inside a group, so the per-image alt/caption live
	// on a flat, section-tagged group rather than a file_list. )
	$proj_group = $proj->add_field( array(
		'id'      => 'rcd_detail_projects',
		'type'    => 'group',
		'options' => array(
			'closed'        => true,
			'sortable'      => true,
			'group_title'   => __( 'Image {#}', 'pegasus-child' ),
			'add_button'    => __( 'Add Image', 'pegasus-child' ),
			'remove_button' => __( 'Remove Image', 'pegasus-child' ),
		),
	) );
	$proj->add_group_field( $proj_group, array(
		'name' => __( 'Section', 'pegasus-child' ),
		'desc' => __( 'Groups images into a gallery block, e.g. "Selected Interiors". Also becomes the jump-to anchor.', 'pegasus-child' ),
		'id'   => 'section',
		'type' => 'text',
	) );
	$proj->add_group_field( $proj_group, array(
		'name' => __( 'Section description ( optional )', 'pegasus-child' ),
		'desc' => __( 'Shown once under the section heading ( uses the first image of each section ).', 'pegasus-child' ),
		'id'   => 'section_desc',
		'type' => 'textarea_small',
	) );
	$proj->add_group_field( $proj_group, array(
		'name'         => __( 'Image', 'pegasus-child' ),
		'id'           => 'image',
		'type'         => 'file',
		'options'      => array( 'url' => false ),
		'query_args'   => array( 'type' => 'image' ),
		'preview_size' => array( 200, 150 ),
	) );
	$proj->add_group_field( $proj_group, array(
		'name' => __( 'Alt text', 'pegasus-child' ),
		'desc' => __( 'Describes the image for screen readers &amp; SEO. Falls back to the Media Library alt, then the section name.', 'pegasus-child' ),
		'id'   => 'alt',
		'type' => 'text',
	) );
	$proj->add_group_field( $proj_group, array(
		'name' => __( 'Caption', 'pegasus-child' ),
		'desc' => __( 'Optional — shown under the image in the lightbox.', 'pegasus-child' ),
		'id'   => 'caption',
		'type' => 'text',
	) );

	/* ---------------------------------------------------------------------
	 * "WHAT'S INCLUDED" CARDS  ( shown below this service's pillar on the
	 * Services landing; each card deep-links to a section anchor ).
	 * ------------------------------------------------------------------- */
	$inc = new_cmb2_box( array_merge( $box_args, array(
		'id'    => $prefix . 'included_box',
		'title' => __( "Service Detail — \"What's Included\" Cards", 'pegasus-child' ),
	) ) );
	$inc_group = $inc->add_field( array(
		'id'      => 'rcd_detail_included',
		'type'    => 'group',
		'description' => __( 'Shown below this service on the Services page. Leave empty to use the design defaults.', 'pegasus-child' ),
		'options' => array(
			'closed'        => true,
			'sortable'      => true,
			'group_title'   => __( 'Card {#}', 'pegasus-child' ),
			'add_button'    => __( 'Add Card', 'pegasus-child' ),
			'remove_button' => __( 'Remove Card', 'pegasus-child' ),
		),
	) );
	rcd_service_detail_add_card_fields( $inc, $inc_group );

	/* ---------------------------------------------------------------------
	 * "FEATURED PROJECTS" CARDS
	 * ------------------------------------------------------------------- */
	$feat = new_cmb2_box( array_merge( $box_args, array(
		'id'    => $prefix . 'featured_box',
		'title' => __( 'Service Detail — "Featured Projects" Cards', 'pegasus-child' ),
	) ) );
	$feat_group = $feat->add_field( array(
		'id'      => 'rcd_detail_featured',
		'type'    => 'group',
		'description' => __( 'Shown below this service on the Services page. Leave empty to use the design defaults.', 'pegasus-child' ),
		'options' => array(
			'closed'        => true,
			'sortable'      => true,
			'group_title'   => __( 'Project {#}', 'pegasus-child' ),
			'add_button'    => __( 'Add Project', 'pegasus-child' ),
			'remove_button' => __( 'Remove Project', 'pegasus-child' ),
		),
	) );
	rcd_service_detail_add_card_fields( $feat, $feat_group );
}

if ( ! function_exists( 'rcd_service_detail_add_card_fields' ) ) {
	/**
	 * Shared sub-fields for a "What's included" / "Featured projects" card group.
	 *
	 * @param object $cmb   CMB2 box.
	 * @param string $group Group field id returned by add_field().
	 */
	function rcd_service_detail_add_card_fields( $cmb, $group ) {
		$cmb->add_group_field( $group, array(
			'name'         => __( 'Image', 'pegasus-child' ),
			'id'           => 'image',
			'type'         => 'file',
			'options'      => array( 'url' => false ),
			'query_args'   => array( 'type' => 'image' ),
			'preview_size' => array( 220, 160 ),
		) );
		$cmb->add_group_field( $group, array(
			'name' => __( 'Title', 'pegasus-child' ),
			'id'   => 'title',
			'type' => 'text',
		) );
		$cmb->add_group_field( $group, array(
			'name' => __( 'Target section anchor ( optional )', 'pegasus-child' ),
			'desc' => __( 'Section id on this service page to jump to, e.g. "selected-interiors". Leave blank to link to the top of the page.', 'pegasus-child' ),
			'id'   => 'anchor',
			'type' => 'text_medium',
		) );
	}
}

/**
 * show_on_cb: only display the detail metaboxes on pages using
 * tpl_service_detail.php.
 *
 * @param object $cmb CMB2 instance.
 * @return bool
 */
function rcd_service_detail_show_for_template( $cmb ) {
	$post_id = 0;

	if ( isset( $_GET['post'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification
		$post_id = absint( $_GET['post'] );
	} elseif ( isset( $_POST['post_ID'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification
		$post_id = absint( $_POST['post_ID'] );
	}

	if ( ! $post_id ) {
		return false;
	}

	return ( 'tpl_service_detail.php' === get_post_meta( $post_id, '_wp_page_template', true ) );
}

/* ============================================================================
 * HELPERS
 * ========================================================================== */

if ( ! function_exists( 'rcd_get_service_by_anchor' ) ) {
	/**
	 * Find a shared service row ( rcd_get_services() ) by its anchor id.
	 *
	 * @param string $anchor Anchor id, e.g. "bespoke".
	 * @return array|null The service row, or null if not found.
	 */
	function rcd_get_service_by_anchor( $anchor ) {
		if ( '' === (string) $anchor ) {
			return null;
		}
		foreach ( rcd_get_services() as $service ) {
			if ( isset( $service['anchor'] ) && $anchor === $service['anchor'] ) {
				return $service;
			}
		}
		return null;
	}
}

if ( ! function_exists( 'rcd_service_detail_url' ) ) {
	/**
	 * Permalink of the service-detail child page for a given service anchor.
	 * Looks for a published page on tpl_service_detail.php whose
	 * rcd_detail_anchor meta matches ( falls back to a child page whose slug
	 * matches the anchor ). Returns '' when none exists yet.
	 *
	 * @param string $anchor Service anchor id.
	 * @return string
	 */
	function rcd_service_detail_url( $anchor ) {
		if ( '' === (string) $anchor ) {
			return '';
		}

		static $map = null;
		if ( null === $map ) {
			$map  = array();
			$kids = get_posts( array(
				'post_type'      => 'page',
				'post_status'    => 'publish',
				'posts_per_page' => -1,
				'meta_key'       => '_wp_page_template',
				'meta_value'     => 'tpl_service_detail.php',
				'no_found_rows'  => true,
			) );
			foreach ( $kids as $kid ) {
				$a = get_post_meta( $kid->ID, 'rcd_detail_anchor', true );
				if ( '' === $a ) {
					$a = $kid->post_name; // Fall back to the slug.
				}
				if ( '' !== $a && ! isset( $map[ $a ] ) ) {
					$map[ $a ] = get_permalink( $kid->ID );
				}
			}
		}

		return isset( $map[ $anchor ] ) ? $map[ $anchor ] : '';
	}
}

if ( ! function_exists( 'rcd_render_service_gallery' ) ) {
	/**
	 * Render a Lightbox2-enabled image grid from an array of image items. Anchors
	 * share a data-lightbox group ( prev/next ); the caption ( data-title ) uses
	 * the per-image caption, falling back to its alt.
	 *
	 * @param array  $images Array of items: array( 'url', 'full', 'alt', 'caption' ).
	 * @param string $group  Lightbox group id ( ties prev/next together ).
	 */
	function rcd_render_service_gallery( $images, $group = 'gallery' ) {
		if ( empty( $images ) || ! is_array( $images ) ) {
			return;
		}
		echo '<div class="rcd-glry">';
		foreach ( $images as $item ) {
			$url  = isset( $item['url'] ) ? $item['url'] : '';
			$full = isset( $item['full'] ) && $item['full'] ? $item['full'] : $url;
			$alt  = isset( $item['alt'] ) ? $item['alt'] : '';
			$cap  = ( isset( $item['caption'] ) && '' !== $item['caption'] ) ? $item['caption'] : $alt;
			printf(
				'<a class="rcd-glry-item" href="%1$s" data-lightbox="%2$s" data-title="%3$s"><img src="%4$s" alt="%5$s" loading="lazy"><span class="rcd-glry-zoom" aria-hidden="true">+</span></a>',
				esc_url( $full ),
				esc_attr( $group ),
				esc_attr( $cap ),
				esc_url( $url ),
				esc_attr( $alt )
			);
		}
		echo '</div>';
	}
}

if ( ! function_exists( 'rcd_detail_grouped_galleries' ) ) {
	/**
	 * Read the service-detail gallery rows and group them into gallery sections.
	 * Handles the current flat format ( one image per row tagged with a Section )
	 * AND the legacy format ( rows with project_name + a gallery_images file_list )
	 * so nothing breaks before/without a data migration.
	 *
	 * @param int $post_id Service detail page id.
	 * @return array Ordered sections: array( 'name', 'desc', 'anchor', 'images' => array( url, full, alt, caption ) ).
	 */
	function rcd_detail_grouped_galleries( $post_id ) {
		$rows = get_post_meta( $post_id, 'rcd_detail_projects', true );
		if ( ! is_array( $rows ) ) {
			return array();
		}

		$sections = array(); // keyed by section name, preserves insertion order.

		$add_image = function ( $name, $desc, $url, $gid, $alt, $caption ) use ( &$sections ) {
			if ( '' === $url ) {
				return;
			}
			if ( ! isset( $sections[ $name ] ) ) {
				$sections[ $name ] = array(
					'name'   => $name,
					'desc'   => $desc,
					'anchor' => sanitize_title( $name ? $name : 'gallery' ),
					'images' => array(),
				);
			} elseif ( '' === $sections[ $name ]['desc'] && '' !== $desc ) {
				$sections[ $name ]['desc'] = $desc;
			}
			if ( '' === $alt && $gid ) {
				$alt = (string) get_post_meta( $gid, '_wp_attachment_image_alt', true );
			}
			if ( '' === $alt ) {
				$alt = $name;
			}
			$sections[ $name ]['images'][] = array(
				'url'     => ( $gid && wp_get_attachment_image_url( $gid, 'large' ) ) ? wp_get_attachment_image_url( $gid, 'large' ) : $url,
				'full'    => ( $gid && wp_get_attachment_image_url( $gid, 'full' ) ) ? wp_get_attachment_image_url( $gid, 'full' ) : $url,
				'alt'     => $alt,
				'caption' => $caption,
			);
		};

		foreach ( $rows as $row ) {
			if ( ! is_array( $row ) ) {
				continue;
			}

			// Legacy format: project_name + gallery_images ( file_list map ).
			if ( ! empty( $row['gallery_images'] ) && is_array( $row['gallery_images'] ) ) {
				$name = isset( $row['project_name'] ) ? $row['project_name'] : '';
				$desc = isset( $row['project_desc'] ) ? $row['project_desc'] : '';
				foreach ( $row['gallery_images'] as $gid => $gurl ) {
					$add_image( $name, $desc, (string) $gurl, (int) $gid, '', '' );
				}
				continue;
			}

			// Current flat format: one image per row.
			$url = isset( $row['image'] ) ? $row['image'] : '';
			if ( '' === $url ) {
				continue;
			}
			$add_image(
				isset( $row['section'] ) ? $row['section'] : '',
				isset( $row['section_desc'] ) ? $row['section_desc'] : '',
				$url,
				isset( $row['image_id'] ) ? (int) $row['image_id'] : 0,
				isset( $row['alt'] ) ? $row['alt'] : '',
				isset( $row['caption'] ) ? $row['caption'] : ''
			);
		}

		return array_values( $sections );
	}
}

/* ============================================================================
 * "WHAT'S INCLUDED" + "FEATURED PROJECTS" CARD SETS
 * ( CMB2-editable per service detail page; design defaults until saved )
 * ========================================================================== */

if ( ! function_exists( 'rcd_service_cards_defaults' ) ) {
	/**
	 * Claude Design default cards for each service, keyed by service anchor then
	 * card set ( 'included' | 'featured' ). Returned when a service detail page
	 * has no saved cards for that set yet. Images are intentionally empty so the
	 * front end shows the styled empty-card until real photos are added.
	 *
	 * @return array
	 */
	function rcd_service_cards_defaults() {
		return array(
			'bespoke' => array(
				'included' => array(
					array( 'title' => 'Full-Home Transformations', 'anchor' => 'selected-interiors' ),
					array( 'title' => 'Single-Room Styling',       'anchor' => 'selected-interiors' ),
					array( 'title' => 'Color &amp; Material Palettes', 'anchor' => 'selected-interiors' ),
				),
				'featured' => array(
					array( 'title' => 'Buckhead Living Room',   'anchor' => 'selected-interiors' ),
					array( 'title' => 'Decatur Dining',         'anchor' => 'selected-interiors' ),
					array( 'title' => 'Marietta Primary Suite', 'anchor' => 'selected-interiors' ),
					array( 'title' => 'Midtown Loft',           'anchor' => 'selected-interiors' ),
				),
			),
			'restoration' => array(
				'included' => array(
					array( 'title' => 'Furniture Restoration',   'anchor' => '' ),
					array( 'title' => 'Architectural Revivals',  'anchor' => '' ),
					array( 'title' => 'Sourcing &amp; Procurement', 'anchor' => '' ),
				),
				'featured' => array(
					array( 'title' => 'Walnut Credenza',       'anchor' => '' ),
					array( 'title' => 'Carved Oak Armoire',    'anchor' => '' ),
					array( 'title' => 'Brass &amp; Cane Bar Cart', 'anchor' => '' ),
					array( 'title' => 'Marble-Top Console',    'anchor' => '' ),
				),
			),
			'technical' => array(
				'included' => array(
					array( 'title' => '3D Spatial Models',      'anchor' => 'spatial-renderings' ),
					array( 'title' => 'Itemized Source Lists',  'anchor' => 'spatial-renderings' ),
					array( 'title' => 'Renderings &amp; Walkthroughs', 'anchor' => 'spatial-renderings' ),
				),
				'featured' => array(
					array( 'title' => 'Full-Home 3D Model',     'anchor' => 'spatial-renderings' ),
					array( 'title' => 'Kitchen Rendering',      'anchor' => 'spatial-renderings' ),
					array( 'title' => 'Primary Suite Model',    'anchor' => 'spatial-renderings' ),
					array( 'title' => 'Sourcing Breakdown',     'anchor' => 'spatial-renderings' ),
				),
			),
		);
	}
}

if ( ! function_exists( 'rcd_service_detail_id' ) ) {
	/**
	 * Page ID of the service-detail child page for a given service anchor
	 * ( 0 when none exists yet ). Mirrors rcd_service_detail_url().
	 *
	 * @param string $anchor Service anchor id.
	 * @return int
	 */
	function rcd_service_detail_id( $anchor ) {
		if ( '' === (string) $anchor ) {
			return 0;
		}

		static $map = null;
		if ( null === $map ) {
			$map  = array();
			$kids = get_posts( array(
				'post_type'      => 'page',
				'post_status'    => 'publish',
				'posts_per_page' => -1,
				'meta_key'       => '_wp_page_template',
				'meta_value'     => 'tpl_service_detail.php',
				'no_found_rows'  => true,
			) );
			foreach ( $kids as $kid ) {
				$a = get_post_meta( $kid->ID, 'rcd_detail_anchor', true );
				if ( '' === $a ) {
					$a = $kid->post_name;
				}
				if ( '' !== $a && ! isset( $map[ $a ] ) ) {
					$map[ $a ] = (int) $kid->ID;
				}
			}
		}

		return isset( $map[ $anchor ] ) ? $map[ $anchor ] : 0;
	}
}

if ( ! function_exists( 'rcd_get_service_cards' ) ) {
	/**
	 * Cards for a service's "What's included" / "Featured projects" set: the rows
	 * saved on that service's detail page, or the Claude Design defaults when none
	 * are saved yet.
	 *
	 * @param string $anchor Service anchor id.
	 * @param string $which  'included' | 'featured'.
	 * @return array
	 */
	function rcd_get_service_cards( $anchor, $which ) {
		$page_id = rcd_service_detail_id( $anchor );
		$rows    = $page_id ? get_post_meta( $page_id, 'rcd_detail_' . $which, true ) : '';
		$clean   = array();

		if ( is_array( $rows ) ) {
			foreach ( $rows as $row ) {
				if ( rcd_home_row_has_content( $row ) ) {
					$clean[] = $row;
				}
			}
		}

		if ( ! empty( $clean ) ) {
			return $clean;
		}

		$defaults = rcd_service_cards_defaults();
		return isset( $defaults[ $anchor ][ $which ] ) ? $defaults[ $anchor ][ $which ] : array();
	}
}

if ( ! function_exists( 'rcd_render_service_cardset' ) ) {
	/**
	 * Render a "What's included" / "Featured projects" card grid. Empty cards fall
	 * back to a styled gradient tile; filled cards use the image with a veil. Each
	 * card deep-links to {detail_url}#{anchor} on the individual service page.
	 *
	 * @param array  $cards      Card rows ( image, title, anchor ).
	 * @param string $heading    Section heading, e.g. "What's included".
	 * @param string $detail_url Service detail page URL ( may be empty ).
	 * @param string $cols_class Grid modifier class, e.g. 'rcd-svc-cards--3'.
	 */
	function rcd_render_service_cardset( $cards, $heading, $detail_url, $cols_class = '' ) {
		if ( empty( $cards ) ) {
			return;
		}
		?>
		<div class="rcd-svc-cardset">
			<div class="rcd-svc-cardset-head">
				<h3 class="rcd-svc-cardset-title"><?php echo wp_kses_post( $heading ); ?></h3>
				<span class="rcd-svc-cardset-rule" aria-hidden="true"></span>
			</div>
			<div class="rcd-svc-cards <?php echo esc_attr( $cols_class ); ?>">
				<?php
				foreach ( $cards as $card ) {
					$title  = rcd_home_row( $card, 'title' );
					$img    = rcd_home_row( $card, 'image' );
					$anchor = ltrim( (string) rcd_home_row( $card, 'anchor' ), '#' );

					if ( $detail_url ) {
						$href = $anchor ? trailingslashit( $detail_url ) . '#' . $anchor : $detail_url;
					} else {
						$href = $anchor ? '#' . $anchor : '#';
					}

					$classes = 'rcd-svc-card' . ( $img ? ' rcd-svc-card--img' : '' );
					$style   = $img ? ' style="background-image:url(' . esc_url( $img ) . ')"' : '';

					printf(
						'<a class="%1$s" href="%2$s"%3$s><span class="rcd-svc-card-veil" aria-hidden="true"></span><span class="rcd-svc-card-title">%4$s</span></a>',
						esc_attr( $classes ),
						esc_url( $href ),
						$style, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- url escaped above.
						wp_kses_post( $title )
					);
				}
				?>
			</div>
		</div>
		<?php
	}
}
