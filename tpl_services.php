<?php
/*
	Template Name: Services Page
*/
/**
 * Valor Care — Services inner page.
 *
 * Layout structure is ported from the Gen2 "Services Inner Page" template
 * (hero → anchor menu → alternating detail blocks → CTA) and restyled in the
 * Valor Care brand. It is fully CMB2-driven (see inc/cmb2-services-fields.php):
 * the top/CTA copy lives on this page, and the repeatable service catalogue
 * (vc_services) is the SAME source the Homepage services grid reads from.
 *
 * All content falls back to the design defaults until a real field/row is
 * filled in and saved. Header & footer are handled by the theme options.
 *
 * @package Pegasus_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* -------------------------------------------------------------------------
 * Rendering helpers (guarded so they are only declared once).
 * ---------------------------------------------------------------------- */

if ( ! function_exists( 'vc_svc_val' ) ) {
	/**
	 * Scalar Services-page field value with design-default fallback.
	 *
	 * @param string $key Key without the vc_ prefix.
	 * @return string
	 */
	function vc_svc_val( $key ) {
		$v = get_post_meta( get_the_ID(), 'vc_' . $key, true );
		if ( '' === $v || null === $v ) {
			return valorcare_services_default( $key );
		}
		return $v;
	}
}

if ( ! function_exists( 'vc_image_slot' ) ) {
	/**
	 * Output an image, or a styled placeholder when no image is set.
	 *
	 * @param string $url         Image URL (may be empty).
	 * @param string $placeholder Placeholder / alt text.
	 * @param string $wrap_class  Extra classes for the slot wrapper.
	 * @return string
	 */
	function vc_image_slot( $url, $placeholder, $wrap_class = '' ) {
		$out = '<div class="vc-slot ' . esc_attr( $wrap_class ) . '">';
		if ( $url ) {
			$out .= '<img src="' . esc_url( $url ) . '" alt="' . esc_attr( $placeholder ) . '" class="vc-slot-img">';
		} else {
			$out .= '<span class="vc-slot-ph">' . esc_html( $placeholder ) . '</span>';
		}
		$out .= '</div>';
		return $out;
	}
}

get_header();

// Match the parent's full-width template: header-three needs the additional
// header included explicitly.
$header_choice = function_exists( 'pegasus_get_option' ) ? pegasus_get_option( 'header_select' ) : '';
if ( 'header-three' === $header_choice ) {
	get_template_part( 'templates/additional_header' );
}
?>

<div id="page-wrap">
	<div class="vc-home vc-services-page">

		<?php
		while ( have_posts() ) : the_post();

			// The service catalogue lives on THIS page (vc_services). Blank rows
			// are stripped so the design defaults show until real content saves.
			$svc_fallback = valorcare_services_defaults();
			$svc_fallback = $svc_fallback['catalogue'];
			$services     = valorcare_nonempty_rows( get_post_meta( get_the_ID(), 'vc_services', true ) );
			if ( empty( $services ) ) {
				$services = $svc_fallback;
			}
		?>

		<!-- ============================ HERO ============================ -->
		<section class="vc-svc-hero">
			<div class="container py-5">
				<div class="row g-5 align-items-end py-lg-3">
					<div class="col-lg-7">
						<div class="vc-eyebrow vc-eyebrow--light"><?php echo esc_html( vc_svc_val( 'services_page_eyebrow' ) ); ?></div>
						<h1 class="vc-serif vc-h1 vc-svc-hero__title"><?php echo wp_kses_post( vc_svc_val( 'services_page_title' ) ); ?></h1>
					</div>
					<div class="col-lg-5">
						<p class="vc-svc-hero__intro"><?php echo nl2br( esc_html( vc_svc_val( 'services_page_intro' ) ) ); ?></p>
					</div>
				</div>
			</div>
		</section>

		<!-- ========================= ANCHOR MENU ======================== -->
		<section class="vc-svc-anchorbar">
			<div class="container">
				<div class="vc-svc-anchor d-flex flex-wrap">
					<?php foreach ( $services as $i => $c ) :
						$num   = str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT );
						$title = isset( $c['title'] ) ? $c['title'] : '';
						// Anchor slug = service name (e.g. #companionship), with a
						// numeric fallback if a card has no title yet.
						$slug  = ! empty( $title ) ? sanitize_title( $title ) : 'svc-' . $num;
					?>
						<a class="vc-svc-anchor__link" href="#<?php echo esc_attr( $slug ); ?>">
							<span class="vc-svc-anchor__num"><?php echo esc_html( $num ); ?></span>
							<span class="vc-svc-anchor__label"><?php echo esc_html( $title ); ?></span>
						</a>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<!-- ======================== SERVICE BLOCKS ====================== -->
		<?php foreach ( $services as $idx => $c ) :
			$num       = str_pad( (string) ( $idx + 1 ), 2, '0', STR_PAD_LEFT );
			$code      = isset( $c['code'] )      ? $c['code']      : '';
			$icon      = isset( $c['icon'] )      ? $c['icon']      : '';
			$title     = isset( $c['title'] )     ? $c['title']     : '';
			$lead      = isset( $c['text'] )      ? $c['text']      : '';
			$bullets   = isset( $c['bullets'] )   ? $c['bullets']   : '';
			$image     = isset( $c['image'] )     ? trim( (string) $c['image'] ) : '';
			$link_url  = isset( $c['link_url'] )  ? trim( (string) $c['link_url'] )  : '';
			$link_text = isset( $c['link_text'] ) ? trim( (string) $c['link_text'] ) : '';
			$slug      = ! empty( $title ) ? sanitize_title( $title ) : 'svc-' . $num;
			// Default the "Learn More" link to this service's subpage (a child of
			// the Services page) unless a Button URL is explicitly set.
			if ( '' === $link_url && ! empty( $title ) ) {
				$link_url = trailingslashit( get_permalink( get_the_ID() ) ) . $slug . '/';
			}
			$even      = ( 0 === $idx % 2 );
			$bg        = $even ? '' : ' vc-svc-block--alt';
		?>
			<section id="<?php echo esc_attr( $slug ); ?>" class="vc-svc-block<?php echo $bg; ?> py-5">
				<div class="container py-lg-4">
					<div class="row g-5 align-items-center">

						<!-- Text column -->
						<div class="col-lg-6 <?php echo $even ? 'order-lg-1' : 'order-lg-2'; ?>">
							<div class="vc-svc-block__doc">
								<span class="vc-svc-block__num">&sect; <?php echo esc_html( $num ); ?></span>
								<?php if ( $code ) : ?><span class="vc-svc-block__code"><?php echo esc_html( $code ); ?></span><?php endif; ?>
							</div>
							<div class="d-flex align-items-center gap-3 mt-2">
								<?php if ( $icon ) : ?>
									<span class="vc-badge-icon vc-badge-icon--static"><i class="fa <?php echo esc_attr( $icon ); ?>"></i></span>
								<?php endif; ?>
								<h2 class="vc-serif vc-title vc-svc-block__title m-0"><?php echo esc_html( $title ); ?></h2>
							</div>
							<div class="vc-rule"></div>
							<?php if ( $lead ) : ?>
								<p class="vc-svc-block__lead"><?php echo esc_html( $lead ); ?></p>
							<?php endif; ?>
							<?php if ( $bullets ) : ?>
								<div class="vc-svc-block__bullets"><?php echo apply_filters( 'the_content', $bullets ); ?></div>
							<?php endif; ?>
							<div class="d-flex flex-wrap gap-3 mt-4">
								<?php if ( $link_url ) : // "Learn More" only shows when a button URL is filled in for this service. ?>
									<a href="<?php echo esc_url( $link_url ); ?>" class="btn fw-bold px-4 py-2 vc-btn-gold">
										<?php echo esc_html( $link_text ? $link_text : 'Learn More' ); ?> <i class="fa fa-arrow-circle-right ms-1"></i>
									</a>
								<?php endif; ?>
							</div>
						</div>

						<!-- Media column -->
						<div class="col-lg-6 <?php echo $even ? 'order-lg-2' : 'order-lg-1'; ?>">
							<div class="vc-framed <?php echo $even ? 'vc-framed--bl' : 'vc-framed--tr'; ?>">
								<div class="vc-framed__accent"></div>
								<?php echo vc_image_slot( $image, $title . ' — Valor Care', 'vc-framed__media vc-ar-4x3' ); ?>
							</div>
						</div>

					</div>
				</div>
			</section>
		<?php endforeach; ?>

		<!-- ============================= CTA ============================ -->
		<section class="vc-consult vc-svc-cta py-5">
			<div class="container py-lg-4">
				<div class="row align-items-center g-4">
					<div class="col-lg-8">
						<h2 class="vc-serif vc-title vc-title--light m-0"><?php echo wp_kses_post( vc_svc_val( 'services_page_cta_title' ) ); ?></h2>
						<p class="vc-consult-text mb-0 mt-3"><?php echo nl2br( esc_html( vc_svc_val( 'services_page_cta_text' ) ) ); ?></p>
					</div>
					<div class="col-lg-4 text-lg-end">
						<a href="<?php echo esc_url( vc_svc_val( 'services_page_cta_btn_link' ) ); ?>" class="btn btn-lg fw-bold px-4 vc-btn-gold">
							<?php echo esc_html( vc_svc_val( 'services_page_cta_btn_text' ) ); ?>
						</a>
					</div>
				</div>
			</div>
		</section>

		<?php endwhile; ?>

	</div><!-- .vc-services-page -->
</div><!-- #page-wrap -->

<?php get_footer(); ?>
