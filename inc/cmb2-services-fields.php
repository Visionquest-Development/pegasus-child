<?php
/**
 * CMB2 fields + defaults for the Services template ( tpl_services.php ).
 *
 * The service offerings are stored in ONE repeatable group ( meta key
 * `rcd_services` ) on the Services page. That single field powers both:
 *   - the Services page pillars ( tpl_services.php ), and
 *   - the Homepage "Services" cards ( tpl_home.php ),
 * which read it through rcd_get_services(). Rows are collapsed accordions by
 * default and fall back to the Claude Design defaults until real content is saved.
 *
 * Shares the generic render helpers ( rcd_home_media, rcd_home_row,
 * rcd_home_row_has_content ) defined in inc/cmb2-home-fields.php.
 *
 * @package Pegasus_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* ============================================================================
 * DEFAULTS
 * ========================================================================== */
if ( ! function_exists( 'rcd_services_defaults' ) ) {
	/**
	 * All Claude Design default content for the services page + shared service list.
	 *
	 * @return array
	 */
	function rcd_services_defaults() {
		return array(

			// Intro.
			'intro_eyebrow' => 'Our Services',
			'intro_heading' => 'What we make together',
			'intro_text'    => 'Three disciplines, one philosophy: we source with intent, restore with patience, and reimagine spaces and pieces into something that could only be yours.',
			'intro_links'   => array(
				array( 'text' => 'Bespoke Curation', 'url' => '#bespoke' ),
				array( 'text' => 'Restoration &amp; Sourcing', 'url' => '#restoration' ),
				array( 'text' => 'Technical Design', 'url' => '#technical' ),
			),

			// Shared, repeatable service offerings ( drives pillars + home cards ).
			'services' => array(
				array(
					'number'         => '01',
					'tag'            => 'Interiors &amp; Styling',
					'title'          => 'Bespoke Curation',
					'anchor'         => 'bespoke',
					'excerpt'        => 'Tailored interior transformations and single-room styling — composed around how you actually live.',
					'body'           => 'Tailored interior transformations and single-room styling, composed around how you actually live. We layer color, material, light, and collected objects until a space feels effortless and entirely yours.',
					'body2'          => 'From the first concept to the final styled shelf, we guide every decision with a clear, considered point of view.',
					'link'           => '',
					'button_text'    => 'Start a project',
					'button_link'    => '#contact',
					'image_position' => 'right',
				),
				array(
					'number'         => '02',
					'tag'            => 'Furniture &amp; Revivals',
					'title'          => 'Restoration &amp; Sourcing',
					'anchor'         => 'restoration',
					'excerpt'        => 'Reclaimed, high-end furniture and architectural revivals, given a second life with patient hands.',
					'body'           => "Reclaimed, high-end furniture and architectural revivals. We track down structural pieces with real provenance, then restore them with patient, expert hands — preserving the maker's intent while readying them for a new life.",
					'body2'          => 'Restored pieces are available for local pickup and offered one at a time.',
					'link'           => '',
					'button_text'    => 'Shop available pieces',
					'button_link'    => '#furniture',
					'image_position' => 'right',
				),
				array(
					'number'         => '03',
					'tag'            => '3D &amp; Sourcing',
					'title'          => 'Immersive Technical Design',
					'anchor'         => 'technical',
					'excerpt'        => 'Premium 3D modeling and dynamic sourcing breakdowns — see the room before a single piece moves.',
					'body'           => 'Premium 3D modeling and dynamic sourcing breakdowns. Walk your space before a single piece moves — ultra-detailed spatial models paired with itemized, shoppable source lists so nothing is left to guesswork.',
					'body2'          => 'Ideal for full transformations, renovations, and clients who want to see — and price — every decision in advance.',
					'link'           => '',
					'button_text'    => 'Request a model',
					'button_link'    => '#contact',
					'image_position' => 'right',
				),
			),

			// CTA.
			'cta_eyebrow'  => 'Now Booking',
			'cta_heading'  => 'Not sure where to <em>begin?</em>',
			'cta_text'     => "Tell us about your space and we'll recommend the right path — a single room, a full transformation, or a one-of-a-kind restored piece.",
			'cta_btn_text' => 'Start the conversation',
			'cta_btn_link' => 'mailto:hello@renecatherinedesigns.com',
		);
	}
}

/* ============================================================================
 * METABOX REGISTRATION
 * ========================================================================== */
add_action( 'cmb2_admin_init', 'rcd_services_register_metaboxes' );
/**
 * Register the services-page metaboxes. Collapsed by default, shown only on
 * pages using the tpl_services.php template.
 */
function rcd_services_register_metaboxes() {

	if ( ! function_exists( 'new_cmb2_box' ) ) {
		return;
	}

	$prefix = 'rcd_svc_';
	$d      = rcd_services_defaults();

	$box_args = array(
		'object_types' => array( 'page' ),
		'context'      => 'normal',
		'priority'     => 'high',
		'closed'       => true,
		'show_on_cb'   => 'rcd_services_show_for_template',
	);

	$group_opts = array(
		'closed'   => true,
		'sortable' => true,
	);

	/* ---------------------------------------------------------------------
	 * INTRO
	 * ------------------------------------------------------------------- */
	$intro = new_cmb2_box( array_merge( $box_args, array(
		'id'    => $prefix . 'intro_box',
		'title' => __( 'Services — Intro', 'pegasus-child' ),
	) ) );
	$intro->add_field( array(
		'name'    => __( 'Eyebrow', 'pegasus-child' ),
		'id'      => $prefix . 'intro_eyebrow',
		'type'    => 'text',
		'default' => $d['intro_eyebrow'],
	) );
	$intro->add_field( array(
		'name'    => __( 'Heading', 'pegasus-child' ),
		'id'      => $prefix . 'intro_heading',
		'type'    => 'text',
		'default' => $d['intro_heading'],
	) );
	$intro->add_field( array(
		'name'    => __( 'Intro text', 'pegasus-child' ),
		'id'      => $prefix . 'intro_text',
		'type'    => 'textarea',
		'default' => $d['intro_text'],
	) );
	$links_group = $intro->add_field( array(
		'id'      => $prefix . 'intro_links',
		'type'    => 'group',
		'options' => array_merge( $group_opts, array(
			'group_title'   => __( 'Link {#}', 'pegasus-child' ),
			'add_button'    => __( 'Add Quick Link', 'pegasus-child' ),
			'remove_button' => __( 'Remove Quick Link', 'pegasus-child' ),
		) ),
	) );
	$intro->add_group_field( $links_group, array(
		'name' => __( 'Text', 'pegasus-child' ),
		'id'   => 'text',
		'type' => 'text',
	) );
	$intro->add_group_field( $links_group, array(
		'name' => __( 'Anchor / URL', 'pegasus-child' ),
		'id'   => 'url',
		'type' => 'text',
	) );

	/* ---------------------------------------------------------------------
	 * SERVICES ( single repeatable group — powers pillars + home cards )
	 * ------------------------------------------------------------------- */
	$services = new_cmb2_box( array_merge( $box_args, array(
		'id'    => 'rcd_services_box',
		'title' => __( 'Services — Service Items ( repeatable )', 'pegasus-child' ),
	) ) );
	$services->add_field( array(
		'name' => __( 'Managed here', 'pegasus-child' ),
		'desc' => __( 'These service items power both the Services page pillars and the Homepage service cards.', 'pegasus-child' ),
		'id'   => $prefix . 'services_note',
		'type' => 'title',
	) );
	$svc_group = $services->add_field( array(
		'id'      => 'rcd_services',
		'type'    => 'group',
		'options' => array_merge( $group_opts, array(
			'group_title'   => __( 'Service {#}', 'pegasus-child' ),
			'add_button'    => __( 'Add Service', 'pegasus-child' ),
			'remove_button' => __( 'Remove Service', 'pegasus-child' ),
		) ),
	) );
	$services->add_group_field( $svc_group, array(
		'name'         => __( 'Image', 'pegasus-child' ),
		'id'           => 'image',
		'type'         => 'file',
		'options'      => array( 'url' => false ),
		'query_args'   => array( 'type' => 'image' ),
		'preview_size' => 'medium',
	) );
	$services->add_group_field( $svc_group, array(
		'name'    => __( 'Image position ( Services page pillar )', 'pegasus-child' ),
		'id'      => 'image_position',
		'type'    => 'select',
		'default' => 'right',
		'options' => array(
			'right' => __( 'Image right', 'pegasus-child' ),
			'left'  => __( 'Image left', 'pegasus-child' ),
		),
	) );
	$services->add_group_field( $svc_group, array(
		'name' => __( 'Number', 'pegasus-child' ),
		'id'   => 'number',
		'type' => 'text_small',
	) );
	$services->add_group_field( $svc_group, array(
		'name' => __( 'Tag', 'pegasus-child' ),
		'id'   => 'tag',
		'type' => 'text',
	) );
	$services->add_group_field( $svc_group, array(
		'name' => __( 'Title', 'pegasus-child' ),
		'id'   => 'title',
		'type' => 'text',
	) );
	$services->add_group_field( $svc_group, array(
		'name' => __( 'Anchor id ( e.g. bespoke )', 'pegasus-child' ),
		'desc' => __( 'Used for the pillar section id and the homepage card link.', 'pegasus-child' ),
		'id'   => 'anchor',
		'type' => 'text_medium',
	) );
	$services->add_group_field( $svc_group, array(
		'name' => __( 'Excerpt ( Homepage card )', 'pegasus-child' ),
		'id'   => 'excerpt',
		'type' => 'textarea_small',
	) );
	$services->add_group_field( $svc_group, array(
		'name' => __( 'Body paragraph 1 ( Services pillar )', 'pegasus-child' ),
		'id'   => 'body',
		'type' => 'textarea_small',
	) );
	$services->add_group_field( $svc_group, array(
		'name' => __( 'Body paragraph 2 ( Services pillar )', 'pegasus-child' ),
		'id'   => 'body2',
		'type' => 'textarea_small',
	) );
	$services->add_group_field( $svc_group, array(
		'name' => __( 'Homepage card link ( optional )', 'pegasus-child' ),
		'desc' => __( 'Leave blank to link to this service on the Services page.', 'pegasus-child' ),
		'id'   => 'link',
		'type' => 'text',
	) );
	$services->add_group_field( $svc_group, array(
		'name' => __( 'Pillar button — text', 'pegasus-child' ),
		'id'   => 'button_text',
		'type' => 'text',
	) );
	$services->add_group_field( $svc_group, array(
		'name' => __( 'Pillar button — link', 'pegasus-child' ),
		'id'   => 'button_link',
		'type' => 'text',
	) );

	/* ---------------------------------------------------------------------
	 * CTA
	 * ------------------------------------------------------------------- */
	$cta = new_cmb2_box( array_merge( $box_args, array(
		'id'    => $prefix . 'cta_box',
		'title' => __( 'Services — Call To Action', 'pegasus-child' ),
	) ) );
	$cta->add_field( array(
		'name'    => __( 'Eyebrow', 'pegasus-child' ),
		'id'      => $prefix . 'cta_eyebrow',
		'type'    => 'text',
		'default' => $d['cta_eyebrow'],
	) );
	$cta->add_field( array(
		'name'    => __( 'Heading', 'pegasus-child' ),
		'desc'    => __( 'Basic HTML allowed ( &lt;br&gt;, &lt;em&gt; ).', 'pegasus-child' ),
		'id'      => $prefix . 'cta_heading',
		'type'    => 'textarea_small',
		'default' => $d['cta_heading'],
	) );
	$cta->add_field( array(
		'name'    => __( 'Body text', 'pegasus-child' ),
		'id'      => $prefix . 'cta_text',
		'type'    => 'textarea_small',
		'default' => $d['cta_text'],
	) );
	$cta->add_field( array(
		'name'    => __( 'Button — text', 'pegasus-child' ),
		'id'      => $prefix . 'cta_btn_text',
		'type'    => 'text',
		'default' => $d['cta_btn_text'],
	) );
	$cta->add_field( array(
		'name'    => __( 'Button — link', 'pegasus-child' ),
		'id'      => $prefix . 'cta_btn_link',
		'type'    => 'text',
		'default' => $d['cta_btn_link'],
	) );
}

/**
 * show_on_cb: only display the services metaboxes on pages using tpl_services.php.
 *
 * @param object $cmb CMB2 instance.
 * @return bool
 */
function rcd_services_show_for_template( $cmb ) {
	$post_id = 0;

	if ( isset( $_GET['post'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification
		$post_id = absint( $_GET['post'] );
	} elseif ( isset( $_POST['post_ID'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification
		$post_id = absint( $_POST['post_ID'] );
	}

	if ( ! $post_id ) {
		return false;
	}

	return ( 'tpl_services.php' === get_post_meta( $post_id, '_wp_page_template', true ) );
}

/* ============================================================================
 * SHARED DATA ACCESS
 * ========================================================================== */

if ( ! function_exists( 'rcd_get_services_page_id' ) ) {
	/**
	 * Find the page that uses the Services template ( tpl_services.php ). The
	 * service items live on that page, so both templates read from one place.
	 *
	 * @return int Page ID, or 0 if none found.
	 */
	function rcd_get_services_page_id() {
		static $cached = null;
		if ( null !== $cached ) {
			return $cached;
		}

		$ids = get_posts( array(
			'post_type'      => 'page',
			'post_status'    => 'publish',
			'posts_per_page' => 1,
			'fields'         => 'ids',
			'meta_key'       => '_wp_page_template',
			'meta_value'     => 'tpl_services.php',
			'no_found_rows'  => true,
		) );

		$cached = ! empty( $ids ) ? (int) $ids[0] : 0;
		return $cached;
	}
}

if ( ! function_exists( 'rcd_services_page_url' ) ) {
	/**
	 * Permalink of the Services page ( empty string if none ).
	 *
	 * @return string
	 */
	function rcd_services_page_url() {
		$id = rcd_get_services_page_id();
		return $id ? get_permalink( $id ) : '';
	}
}

if ( ! function_exists( 'rcd_get_services' ) ) {
	/**
	 * The shared service items: the repeatable rows saved on the Services page,
	 * or the Claude Design defaults when nothing real is saved yet.
	 *
	 * @return array
	 */
	function rcd_get_services() {
		$page_id = rcd_get_services_page_id();
		$rows    = $page_id ? get_post_meta( $page_id, 'rcd_services', true ) : '';
		$clean   = array();

		if ( is_array( $rows ) ) {
			foreach ( $rows as $row ) {
				if ( rcd_home_row_has_content( $row ) ) {
					$clean[] = $row;
				}
			}
		}

		if ( empty( $clean ) ) {
			$defaults = rcd_services_defaults();
			return $defaults['services'];
		}

		return $clean;
	}
}

/* ============================================================================
 * TEMPLATE HELPERS  ( intro / cta singles + intro_links rows, services prefix )
 * ========================================================================== */

if ( ! function_exists( 'rcd_svc_field' ) ) {
	/**
	 * Get a single services field, falling back to the Claude Design default.
	 *
	 * @param string $key     Field key without the rcd_svc_ prefix.
	 * @param int    $post_id Optional post ID.
	 * @return mixed
	 */
	function rcd_svc_field( $key, $post_id = 0 ) {
		$post_id = $post_id ? $post_id : get_the_ID();
		$value   = get_post_meta( $post_id, 'rcd_svc_' . $key, true );

		if ( '' === $value || null === $value || false === $value ) {
			$defaults = rcd_services_defaults();
			return isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';
		}

		return $value;
	}
}

if ( ! function_exists( 'rcd_svc_rows' ) ) {
	/**
	 * Get repeatable group rows ( rcd_svc_ prefix ), discarding empty rows and
	 * falling back to the Claude Design defaults when nothing real is saved.
	 *
	 * @param string $key     Group key without the rcd_svc_ prefix.
	 * @param int    $post_id Optional post ID.
	 * @return array
	 */
	function rcd_svc_rows( $key, $post_id = 0 ) {
		$post_id = $post_id ? $post_id : get_the_ID();
		$rows    = get_post_meta( $post_id, 'rcd_svc_' . $key, true );
		$clean   = array();

		if ( is_array( $rows ) ) {
			foreach ( $rows as $row ) {
				if ( rcd_home_row_has_content( $row ) ) {
					$clean[] = $row;
				}
			}
		}

		if ( empty( $clean ) ) {
			$defaults = rcd_services_defaults();
			return isset( $defaults[ $key ] ) ? $defaults[ $key ] : array();
		}

		return $clean;
	}
}

if ( ! function_exists( 'rcd_services_render_pillar' ) ) {
	/**
	 * Render one services pillar ( two-column text + gold-framed image ) from a
	 * shared service row. Alternating rows sit on the cream band.
	 *
	 * @param array $row   One rcd_get_services() row.
	 * @param int   $index Zero-based position ( drives the alternating band ).
	 */
	function rcd_services_render_pillar( $row, $index ) {
		$anchor    = rcd_home_row( $row, 'anchor', 'service-' . ( $index + 1 ) );
		$image_pos = rcd_home_row( $row, 'image_position', 'right' );
		$band      = ( 1 === ( $index % 2 ) );
		$text_col  = 'col-12 col-lg-6 rcd-svc-copy' . ( 'left' === $image_pos ? ' order-lg-2' : '' );
		$img_col   = 'col-12 col-lg-6' . ( 'left' === $image_pos ? ' order-lg-1' : '' );
		$section_class = 'rcd-section rcd-svc-pillar' . ( $band ? ' rcd-band-cream' : '' );
		$body2     = rcd_home_row( $row, 'body2' );
		?>
		<section id="<?php echo esc_attr( $anchor ); ?>" class="<?php echo esc_attr( $section_class ); ?>">
			<div class="container">
				<div class="row align-items-center g-5">
					<div class="<?php echo esc_attr( $text_col ); ?>">
						<div class="rcd-svc-kicker"><?php echo esc_html( rcd_home_row( $row, 'number' ) ); ?> &mdash; <?php echo wp_kses_post( rcd_home_row( $row, 'tag' ) ); ?></div>
						<h2 class="rcd-h2"><?php echo wp_kses_post( rcd_home_row( $row, 'title' ) ); ?></h2>
						<p class="rcd-svc-body"><?php echo esc_html( rcd_home_row( $row, 'body' ) ); ?></p>
						<?php if ( $body2 ) : ?>
							<p class="rcd-svc-body rcd-svc-body--last"><?php echo esc_html( $body2 ); ?></p>
						<?php endif; ?>
						<?php if ( rcd_home_row( $row, 'button_text' ) ) : ?>
							<a class="rcd-btn rcd-btn-dark rcd-btn--self" href="<?php echo esc_url( rcd_home_row( $row, 'button_link', '#' ) ); ?>"><?php echo esc_html( rcd_home_row( $row, 'button_text' ) ); ?> &rsaquo;</a>
						<?php endif; ?>
					</div>
					<div class="<?php echo esc_attr( $img_col ); ?>">
						<div class="rcd-hero-frame">
							<?php rcd_home_media( rcd_home_row( $row, 'image' ), 'rcd-svc-hero-media', 'Drop image', rcd_home_row( $row, 'title' ) ); ?>
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php
	}
}
