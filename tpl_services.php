<?php
/**
 * Template Name: RC Services
 * File: tpl_services.php
 *
 * Services page for Russell Contracting. Sections, sub-lists and photo
 * galleries are driven by CMB2 (see inc/cmb2-fields.php); missing values
 * fall back to RC_Defaults so the page renders on a fresh install.
 *
 * Sections alternate background + image side automatically via
 * .rc-svc:nth-of-type(even).
 *
 * Photos are rendered using the same [masonry] + Lightbox2 HTML pattern as
 * the 34oak child theme (see rc_render_masonry_gallery in cmb2-fields.php).
 *
 * Loading strategy:
 *   - The first service section's feature image is loaded eagerly with
 *     fetchpriority=high so it never flashes on desktop or mobile.
 *   - Every other feature image and every masonry gallery image is lazy.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

/* Header block */
$header_defaults = RC_Defaults::services_page_header();
$svc_title    = rc_field( 'rc_svc_page_title',    $header_defaults['title'] );
$svc_subtitle = rc_field( 'rc_svc_page_subtitle', $header_defaults['subtitle'] );

/* Service sections */
$rc_sections = rc_group( 'rc_service_sections', RC_Defaults::services_sections() );

/* Bottom CTA */
$cta_defaults = RC_Defaults::services_cta();
$cta_headline = rc_field( 'rc_svc_cta_headline', $cta_defaults['headline'] );
$cta_subhead  = rc_field( 'rc_svc_cta_subhead',  $cta_defaults['subhead'] );
$cta_btn_text = rc_field( 'rc_svc_cta_btn_text', $cta_defaults['btn_text'] );
$cta_btn_url  = rc_link( rc_field( 'rc_svc_cta_btn_url',  $cta_defaults['btn_url'] ) );

$rc_assets_base = get_stylesheet_directory_uri() . '/assets/images/';
?>

<!-- ============ PAGE TITLE ============ -->
<div class="rc-svc-title-block">
	<div class="container">
		<h1 class="rc-svc-title"><?php echo esc_html( $svc_title ); ?></h1>
		<p class="rc-svc-subtitle"><?php echo esc_html( $svc_subtitle ); ?></p>
	</div>
</div>

<!-- ============ SERVICE SECTIONS ============ -->
<?php
$section_index = 0;
foreach ( $rc_sections as $svc ) :

	$anchor   = isset( $svc['id'] )    ? sanitize_html_class( $svc['id'] ) : 'svc-' . $section_index;
	$title    = isset( $svc['title'] ) ? $svc['title'] : '';
	$icon     = isset( $svc['icon'] )  ? $svc['icon']  : 'bi-tools';
	$lead     = isset( $svc['lead'] )  ? $svc['lead']  : '';
	$body     = isset( $svc['body'] )  ? $svc['body']  : '';
	$subs     = rc_parse_subs( isset( $svc['subs_text'] ) ? $svc['subs_text'] : '' );
	$projects = rc_parse_lines( isset( $svc['projects'] ) ? $svc['projects'] : '' );

	/* Gallery source resolution: prefer CMB2 file_list, else fall back to
	 * scanning the gallery_folder (or the default folder for this section). */
	$gallery_images = array();
	if ( ! empty( $svc['gallery_images'] ) && is_array( $svc['gallery_images'] ) ) {
		foreach ( $svc['gallery_images'] as $img_url ) {
			$gallery_images[] = $img_url;
		}
	}
	if ( empty( $gallery_images ) ) {
		$folder = isset( $svc['gallery_folder'] ) ? trim( (string) $svc['gallery_folder'] ) : '';
		if ( '' !== $folder ) {
			$gallery_images = rc_folder_images( $folder );
		}
	}

	/* Feature image resolution: CMB2 file → default filename → first gallery image → icon placeholder. */
	$feat_url = '';
	if ( ! empty( $svc['feature_image'] ) ) {
		$feat_raw = trim( (string) $svc['feature_image'] );
		if ( preg_match( '#^https?://#i', $feat_raw ) ) {
			$feat_url = $feat_raw;
		} else {
			$feat_url = $rc_assets_base . ltrim( $feat_raw, '/' );
		}
	}
	if ( '' === $feat_url && ! empty( $gallery_images ) ) {
		$feat_url = reset( $gallery_images );
	}

	/* Remove the feature image from the gallery so it's not shown twice. */
	if ( '' !== $feat_url && ! empty( $gallery_images ) ) {
		$gallery_images = array_values( array_filter(
			$gallery_images,
			function ( $url ) use ( $feat_url ) {
				return basename( $url ) !== basename( $feat_url );
			}
		) );
	}

	$is_first        = ( 0 === $section_index );
	$feat_loading    = $is_first ? 'eager' : 'lazy';
	$feat_fetchprio  = $is_first ? ' fetchpriority="high"' : '';
	$eager_in_gallery = 0; /* gallery sits below the fold on every section */

	$section_index++;
	?>
	<section class="rc-svc" id="<?php echo esc_attr( $anchor ); ?>">
		<div class="container">

			<div class="row rc-svc-row align-items-center g-4 g-lg-5">
				<div class="col-lg-6">
					<div class="rc-tile rc-tile--feature">
						<?php if ( $feat_url ) : ?>
							<img
								src="<?php echo esc_url( $feat_url ); ?>"
								alt="<?php echo esc_attr( $title ); ?>"
								class="rc-tile__image"
								loading="<?php echo esc_attr( $feat_loading ); ?>"
								decoding="async"<?php echo $feat_fetchprio; ?>>
						<?php else : ?>
							<i class="bi <?php echo esc_attr( $icon ); ?> rc-tile-ico"></i>
						<?php endif; ?>
					</div>
				</div>
				<div class="col-lg-6">
					<h2 class="rc-eyebrow text-white"><?php echo esc_html( $title ); ?></h2>
					<p class="rc-svc__lead"><?php echo esc_html( $lead ); ?></p>
					<p class="rc-svc__body"><?php echo esc_html( $body ); ?></p>
					<a href="<?php echo $cta_btn_url; ?>" class="rc-btn-gold mt-2"><?php esc_html_e( 'Get a Free Quote', 'pegasus-child' ); ?> <i class="bi bi-arrow-right ms-1"></i></a>
				</div>
			</div>

			<?php
			/* "What we do" tiles: only rendered for subs that carry an image
			 * (third pipe-delimited piece of subs_text). Per directive: no
			 * icon-only fallback. If none of the section's subs have an
			 * image, the whole block is skipped. */
			$subs_with_images = array_values( array_filter( $subs, function ( $s ) {
				return ! empty( $s['image'] ) && '' !== trim( $s['image'] );
			} ) );
			?>
			<?php if ( ! empty( $subs_with_images ) ) : ?>
				<h3 class="rc-svc__sub-heading"><?php esc_html_e( 'What we do', 'pegasus-child' ); ?> <span class="rc-arrow">&rsaquo;</span></h3>
				<div class="row g-3">
					<?php foreach ( $subs_with_images as $sub ) :
						$slabel = isset( $sub['label'] ) ? $sub['label'] : '';
						$simg   = trim( $sub['image'] );
						if ( '' === trim( $slabel ) ) {
							continue;
						}
						$simg_url = preg_match( '#^https?://#i', $simg )
							? $simg
							: $rc_assets_base . ltrim( $simg, '/' );
					?>
						<div class="col-md-4">
							<a href="#<?php echo esc_attr( $anchor ); ?>-gallery" class="rc-tile rc-tile--sub">
								<img
									src="<?php echo esc_url( $simg_url ); ?>"
									alt="<?php echo esc_attr( $slabel ); ?>"
									class="rc-tile__image"
									loading="eager"
									decoding="async">
								<div class="rc-tile-label"><?php echo esc_html( $slabel ); ?></div>
							</a>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

			<?php if ( ! empty( $gallery_images ) ) : ?>
				<h3 id="<?php echo esc_attr( $anchor ); ?>-gallery" class="rc-svc__sub-heading rc-svc__sub-heading--projects"><?php esc_html_e( 'Recent projects', 'pegasus-child' ); ?> <span class="rc-arrow">&rsaquo;</span></h3>
				<div class="row">
					<div class="col-12">
						<?php
						/**
						 * Masonry + Lightbox2 output (no WOW/animate classes):
						 *   [masonry]<a href="…" data-lightbox="anchor-gallery" data-title="…"><img …></a>[/masonry]
						 * Every image loads eagerly for now.
						 */
						rc_render_masonry_gallery(
							$gallery_images,
							$anchor . '-gallery',
							$title,
							$eager_in_gallery
						);
						?>
					</div>
				</div>
			<?php endif; ?>

			<?php if ( ! empty( $projects ) ) : ?>
				<ul class="rc-svc__project-tags list-unstyled d-flex flex-wrap gap-2 mt-4 mb-0">
					<?php foreach ( $projects as $proj ) : ?>
						<li class="rc-svc__project-tag"><i class="bi bi-geo-alt-fill me-1"></i><?php echo esc_html( $proj ); ?></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>

		</div>
	</section>
<?php endforeach; ?>

<!-- ============ BOTTOM CTA (Services override) ============ -->
<section class="rc-cta rc-cta--no-bottom-border">
	<div class="container">
		<div class="row align-items-center g-3 text-center text-lg-start">
			<div class="col-lg-8">
				<h2 class="rc-cta__title"><?php echo esc_html( $cta_headline ); ?></h2>
				<p class="rc-cta__subhead"><?php echo esc_html( $cta_subhead ); ?></p>
			</div>
			<div class="col-lg-4 text-lg-end">
				<a href="<?php echo $cta_btn_url; ?>" class="rc-btn-gold rc-btn-gold--xl"><i class="bi bi-chat-dots-fill me-2"></i><?php echo esc_html( $cta_btn_text ); ?></a>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();
