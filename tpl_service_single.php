<?php
/*
	Template Name: Service Detail Page
*/

/**
 * Hart Family of Home Services — single service detail page.
 *
 * ONE reusable template for every service subpage (Gutters, Fencing, Roofing …),
 * mirroring the valorcare_theme approach: the page is matched by slug to its entry
 * in the shared Services Catalogue (inc/hfhs-services-catalogue.php), which supplies
 * per-service DEFAULT content. Per-page CMB2 fields (inc/cmb2-service-single-fields.php)
 * override any default when filled — blank field ⇒ catalogue/design default.
 *
 * All styling lives in style.css (§ SERVICE DETAIL). Per-record images are inline
 * background-images (data, not styling).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'hfhs_svc' ) ) {
	/** Service meta value with a fallback (blank/absent ⇒ fallback). */
	function hfhs_svc( $key, $fallback = '' ) {
		$v = get_post_meta( get_the_ID(), $key, true );
		if ( is_string( $v ) ) {
			$v = trim( $v );
		}
		return ( '' === $v || null === $v || array() === $v ) ? $fallback : $v;
	}
}

if ( ! function_exists( 'hfhs_svc_rows' ) ) {
	/** Repeatable-group meta as an array of non-empty rows, or $default. */
	function hfhs_svc_rows( $key, $default = array() ) {
		$v = get_post_meta( get_the_ID(), $key, true );
		if ( ! is_array( $v ) ) {
			return $default;
		}
		$rows = array_filter(
			$v,
			function ( $row ) {
				if ( is_array( $row ) ) {
					return '' !== trim( implode( '', array_map( 'strval', $row ) ) );
				}
				return '' !== trim( (string) $row );
			}
		);
		return ! empty( $rows ) ? array_values( $rows ) : $default;
	}
}

get_header();

// House-icon (reused from the About principle band) for the principle strip.
$hfhs_svc_house = '<svg class="hfhs-principle__icon" viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M12 30 32 14l20 16"/><path d="M18 28v20h28V28"/><path d="M28 48V36h8v12"/></svg>';
?>

<main id="page-wrap" class="hfhs-home hfhs-svc-page">
<?php
while ( have_posts() ) :
	the_post();

	$slug     = get_post_field( 'post_name', get_the_ID() );
	$entry    = function_exists( 'hfhs_service_entry' ) ? hfhs_service_entry( $slug ) : array();
	$svc_url  = home_url( '/services/' );
	$title    = get_the_title();

	// Per-service defaults from the catalogue (fall back to generic where absent).
	$d = wp_parse_args(
		$entry,
		array(
			'number'        => '',
			'script'        => 'Where it begins.',
			'lead'          => get_the_excerpt(),
			'img'           => '',
			'overview_title'=> 'Every aspect of ' . $title . ' — done right.',
			'overview_body' => '',
			'scope'         => array(),
			'principle'     => '',
			'process'       => array(),
			'gallery'       => array(),
			'pricing_line'  => 'Every job is quoted up front.',
			'pricing_body'  => '',
			'warranty_line' => '2–5 year workmanship warranty, standard.',
			'warranty_body' => '',
			'related'       => array(),
			'testi_eyebrow' => strtoupper( $title ) . ' SERVICES',
			'testi_quote'   => '',
			'testi_name'    => '',
		)
	);

	// ---- Resolve each field: CMB2 override ▸ catalogue default -------------
	$number   = hfhs_svc( 'hfhs_svc_number', $d['number'] );
	$script   = hfhs_svc( 'hfhs_svc_script', $d['script'] );
	$lead     = hfhs_svc( 'hfhs_svc_lead', $d['lead'] );
	$hero_img = hfhs_svc( 'hfhs_svc_hero_image', $d['img'] );

	$ov_title = hfhs_svc( 'hfhs_svc_overview_title', $d['overview_title'] );
	$ov_body  = hfhs_svc( 'hfhs_svc_overview_body', $d['overview_body'] );

	$scope = hfhs_svc_rows( 'hfhs_svc_scope', $d['scope'] );

	$principle = hfhs_svc( 'hfhs_svc_principle', $d['principle'] );

	$process = hfhs_svc_rows( 'hfhs_svc_process', $d['process'] );

	$gallery = hfhs_svc_rows( 'hfhs_svc_gallery', $d['gallery'] );

	$pricing_line  = hfhs_svc( 'hfhs_svc_pricing_line', $d['pricing_line'] );
	$pricing_body  = hfhs_svc( 'hfhs_svc_pricing_body', $d['pricing_body'] );
	$warranty_line = hfhs_svc( 'hfhs_svc_warranty_line', $d['warranty_line'] );
	$warranty_body = hfhs_svc( 'hfhs_svc_warranty_body', $d['warranty_body'] );

	// Related services: catalogue slugs (resolved to catalogue entries for name/number).
	$related_slugs = hfhs_svc_rows( 'hfhs_svc_related', $d['related'] );
	$related = array();
	foreach ( (array) $related_slugs as $rslug ) {
		$rslug = is_array( $rslug ) ? '' : sanitize_title( $rslug );
		if ( ! $rslug ) {
			continue;
		}
		$re = function_exists( 'hfhs_service_entry' ) ? hfhs_service_entry( $rslug ) : array();
		$related[] = array(
			'title'  => ! empty( $re['title'] ) ? $re['title'] : ucwords( str_replace( '-', ' ', $rslug ) ),
			'number' => ! empty( $re['number'] ) ? $re['number'] : '',
			'url'    => trailingslashit( $svc_url . $rslug ),
		);
	}

	$testi_eyebrow = hfhs_svc( 'hfhs_svc_testi_eyebrow', $d['testi_eyebrow'] );
	$testi_quote   = hfhs_svc( 'hfhs_svc_testi_quote', $d['testi_quote'] );
	$testi_name    = hfhs_svc( 'hfhs_svc_testi_name', $d['testi_name'] );

	$cta_title = hfhs_svc( 'hfhs_svc_cta_title', 'Request a free ' . strtolower( $title ) . ' estimate today.' );

	// Shared (non per-service) labels.
	$sh = function_exists( 'hfhs_service_shared' ) ? 'hfhs_service_shared' : null;
	$lbl = function ( $key, $fallback ) use ( $sh ) {
		return $sh ? call_user_func( $sh, $key, $fallback ) : $fallback;
	};
?>

	<!-- ============================= HERO ============================= -->
	<section class="hfhs-hero hfhs-svc-hero hfhs-section--dark" id="top"<?php if ( $hero_img ) : ?> style="background-image: url('<?php echo esc_url( $hero_img ); ?>');"<?php endif; ?>>
		<div class="hfhs-hero__overlay" aria-hidden="true"></div>
		<div class="container hfhs-hero__inner">
			<nav class="hfhs-breadcrumb" aria-label="Breadcrumb">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
				<span aria-hidden="true">/</span>
				<a href="<?php echo esc_url( $svc_url ); ?>">Services</a>
				<span aria-hidden="true">/</span>
				<span aria-current="page"><?php echo esc_html( $title ); ?></span>
			</nav>
			<?php if ( $number ) : ?>
				<p class="hfhs-eyebrow hfhs-eyebrow--light">Service <?php echo esc_html( $number ); ?></p>
			<?php endif; ?>
			<p class="hfhs-eyebrow-script hfhs-eyebrow-script--light"><?php echo esc_html( $script ); ?></p>
			<h1 class="hfhs-hero__title hfhs-svc-hero__title"><?php echo esc_html( $title ); ?>.</h1>
			<?php if ( $lead ) : ?><p class="hfhs-hero__lead"><?php echo esc_html( $lead ); ?></p><?php endif; ?>
			<div class="hfhs-hero__actions">
				<a class="hfhs-btn hfhs-btn--solid" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Get a Free Estimate</a>
				<a class="hfhs-btn hfhs-btn--outline-light" href="tel:+14045072579">Call 404-507-2579</a>
			</div>
		</div>
	</section>

	<!-- ===================== WHAT WE DO + SCOPE ===================== -->
	<section class="hfhs-svc-what hfhs-section--white">
		<div class="container">
			<div class="row g-5">
				<div class="col-lg-7 hfhs-svc-what__body">
					<p class="hfhs-eyebrow"><?php echo esc_html( $lbl( 'overview_eyebrow', 'What We Do' ) ); ?></p>
					<h2 class="hfhs-display hfhs-svc-what__title"><?php echo wp_kses_post( $ov_title ); ?></h2>
					<div class="hfhs-svc-what__text"><?php echo wp_kses_post( wpautop( $ov_body ) ); ?></div>
				</div>
				<?php if ( ! empty( $scope ) ) : ?>
					<div class="col-lg-5 hfhs-svc-scope">
						<p class="hfhs-eyebrow"><?php echo esc_html( $lbl( 'scope_heading', 'Scope' ) ); ?></p>
						<ul class="hfhs-svc-scope__list">
							<?php foreach ( $scope as $s ) : ?>
								<li><?php echo esc_html( is_array( $s ) ? implode( ' ', $s ) : $s ); ?></li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<!-- ======================= PRINCIPLE BAND ======================= -->
	<?php if ( $principle ) : ?>
	<section class="hfhs-principle hfhs-svc-principle hfhs-section--light">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-10 col-xl-8 text-center">
					<p class="hfhs-eyebrow-script hfhs-principle__eyebrow"><?php echo esc_html( $lbl( 'principle_script', 'Plainly put.' ) ); ?></p>
					<div class="hfhs-principle__row">
						<span class="hfhs-principle__mark hfhs-principle__mark--l" aria-hidden="true"><?php echo $hfhs_svc_house; // phpcs:ignore ?></span>
						<h2 class="hfhs-display hfhs-principle__text"><?php echo wp_kses_post( $principle ); ?></h2>
						<span class="hfhs-principle__mark hfhs-principle__mark--r" aria-hidden="true"><?php echo $hfhs_svc_house; // phpcs:ignore ?></span>
					</div>
					<span class="hfhs-principle__rule" aria-hidden="true"></span>
				</div>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<!-- ========================== PROCESS ========================== -->
	<?php if ( ! empty( $process ) ) : ?>
	<section class="hfhs-svc-process hfhs-section--dark">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-9 col-xl-8 text-center hfhs-svc-process__head">
					<p class="hfhs-eyebrow hfhs-eyebrow--light"><?php echo esc_html( $lbl( 'process_eyebrow', 'Our Process' ) ); ?></p>
					<p class="hfhs-eyebrow-script hfhs-eyebrow-script--light"><?php echo esc_html( $lbl( 'process_script', 'How we work.' ) ); ?></p>
					<h2 class="hfhs-display hfhs-svc-process__title"><?php echo wp_kses_post( $lbl( 'process_title', 'Four steps. <em>No surprises.</em>' ) ); ?></h2>
				</div>
			</div>
			<div class="row g-0 hfhs-svc-process__grid">
				<?php foreach ( $process as $i => $step ) :
					$st_title = is_array( $step ) && isset( $step['title'] ) ? $step['title'] : '';
					$st_text  = is_array( $step ) && isset( $step['text'] ) ? $step['text'] : '';
				?>
					<div class="col-12 col-md-6 col-lg-3">
						<div class="hfhs-svc-step">
							<span class="hfhs-svc-step__num"><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></span>
							<h3 class="hfhs-svc-step__title"><?php echo esc_html( $st_title ); ?></h3>
							<p class="hfhs-svc-step__text"><?php echo esc_html( $st_text ); ?></p>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<!-- ======================== RECENT WORK ======================== -->
	<section class="hfhs-svc-work hfhs-section--light">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-9 col-xl-8 text-center hfhs-svc-work__head">
					<p class="hfhs-eyebrow"><?php echo esc_html( $lbl( 'recent_eyebrow', 'Recent Work' ) ); ?></p>
					<p class="hfhs-eyebrow-script"><?php echo esc_html( $lbl( 'recent_script', 'From the field.' ) ); ?></p>
					<h2 class="hfhs-display hfhs-svc-work__title">A few recent <?php echo esc_html( strtolower( $title ) ); ?> projects.</h2>
				</div>
			</div>
			<div class="row g-3 hfhs-svc-work__grid">
				<?php
				if ( ! empty( $gallery ) ) :
					foreach ( $gallery as $g ) :
						$g_img = is_array( $g ) && ! empty( $g['image'] ) ? $g['image'] : '';
						$g_cap = is_array( $g ) && ! empty( $g['caption'] ) ? $g['caption'] : '';
						$g_meta = is_array( $g ) && ! empty( $g['meta'] ) ? $g['meta'] : '';
					?>
						<div class="col-6 col-lg-4">
							<figure class="hfhs-svc-tile<?php echo $g_img ? '' : ' is-empty'; ?>"<?php if ( $g_img ) : ?> style="--hfhs-tile-img: url('<?php echo esc_url( $g_img ); ?>');"<?php endif; ?>>
								<?php if ( $g_cap || $g_meta ) : ?>
									<figcaption class="hfhs-svc-tile__cap">
										<?php if ( $g_cap ) : ?><span class="hfhs-svc-tile__title"><?php echo esc_html( $g_cap ); ?></span><?php endif; ?>
										<?php if ( $g_meta ) : ?><span class="hfhs-svc-tile__meta"><?php echo esc_html( $g_meta ); ?></span><?php endif; ?>
									</figcaption>
								<?php endif; ?>
							</figure>
						</div>
					<?php endforeach; ?>
				<?php else : ?>
					<?php for ( $i = 0; $i < 6; $i++ ) : ?>
						<div class="col-6 col-lg-4">
							<div class="hfhs-svc-tile is-empty" aria-hidden="true"><span class="hfhs-svc-tile__ph">Photo</span></div>
						</div>
					<?php endfor; ?>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<!-- ===================== PRICING + WARRANTY ===================== -->
	<section class="hfhs-svc-pw hfhs-section--white">
		<div class="container">
			<div class="row g-5">
				<div class="col-lg-6 hfhs-svc-pw__col">
					<p class="hfhs-eyebrow"><?php echo esc_html( $lbl( 'pricing_eyebrow', 'Pricing' ) ); ?></p>
					<h2 class="hfhs-display hfhs-svc-pw__title">Transparent from the first call.</h2>
					<?php if ( $pricing_line ) : ?><p class="hfhs-svc-pw__lead"><?php echo wp_kses_post( $pricing_line ); ?></p><?php endif; ?>
					<?php if ( $pricing_body ) : ?><p class="hfhs-svc-pw__text"><?php echo wp_kses_post( $pricing_body ); ?></p><?php endif; ?>
				</div>
				<div class="col-lg-6 hfhs-svc-pw__col">
					<p class="hfhs-eyebrow"><?php echo esc_html( $lbl( 'warranty_eyebrow', 'Warranty' ) ); ?></p>
					<h2 class="hfhs-display hfhs-svc-pw__title">Work we stand behind.</h2>
					<?php if ( $warranty_line ) : ?><p class="hfhs-svc-pw__lead"><?php echo wp_kses_post( $warranty_line ); ?></p><?php endif; ?>
					<?php if ( $warranty_body ) : ?><p class="hfhs-svc-pw__text"><?php echo wp_kses_post( $warranty_body ); ?></p><?php endif; ?>
				</div>
			</div>
		</div>
	</section>

	<!-- ====================== RELATED SERVICES ====================== -->
	<?php if ( ! empty( $related ) ) : ?>
	<section class="hfhs-svc-related hfhs-section--dark">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-9 col-xl-8 text-center hfhs-svc-related__head">
					<p class="hfhs-eyebrow hfhs-eyebrow--light"><?php echo esc_html( $lbl( 'related_eyebrow', 'Related Services' ) ); ?></p>
					<p class="hfhs-eyebrow-script hfhs-eyebrow-script--light"><?php echo esc_html( $lbl( 'related_script', 'Keep exploring.' ) ); ?></p>
					<h2 class="hfhs-display hfhs-svc-related__title"><?php echo wp_kses_post( $lbl( 'related_title', 'Other ways we <em>protect your home.</em>' ) ); ?></h2>
				</div>
			</div>
			<div class="row g-0 hfhs-svc-related__grid">
				<?php foreach ( $related as $r ) : ?>
					<div class="col-6 col-lg-3">
						<a class="hfhs-svc-rcard" href="<?php echo esc_url( $r['url'] ); ?>">
							<?php if ( $r['number'] ) : ?><span class="hfhs-svc-rcard__num"><?php echo esc_html( $r['number'] ); ?></span><?php endif; ?>
							<h3 class="hfhs-svc-rcard__title"><?php echo esc_html( $r['title'] ); ?></h3>
							<span class="hfhs-svc-rcard__cta hfhs-arrow-link hfhs-arrow-link--light">Explore <span class="hfhs-arrow" aria-hidden="true">&rarr;</span></span>
						</a>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<!-- ========================= TESTIMONIAL ========================= -->
	<?php if ( $testi_quote ) : ?>
	<section class="hfhs-testimonial hfhs-svc-testi hfhs-section--dark">
		<span class="hfhs-testimonial__mark" aria-hidden="true">&ldquo;</span>
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-10 col-xl-8 text-center">
					<p class="hfhs-eyebrow-script hfhs-eyebrow-script--light"><?php echo esc_html( $lbl( 'testi_script', 'From a client.' ) ); ?></p>
					<p class="hfhs-eyebrow hfhs-eyebrow--light"><?php echo esc_html( $testi_eyebrow ); ?></p>
					<blockquote class="hfhs-testimonial__quote"><?php echo esc_html( $testi_quote ); ?></blockquote>
					<div class="hfhs-stars" aria-label="5 out of 5 stars"><span aria-hidden="true">&#9733; &#9733; &#9733; &#9733; &#9733;</span></div>
					<?php if ( $testi_name ) : ?><p class="hfhs-testimonial__name"><?php echo esc_html( $testi_name ); ?></p><?php endif; ?>
				</div>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<!-- ============================= CTA ============================= -->
	<section class="hfhs-cta hfhs-section--dark">
		<div class="container text-center">
			<p class="hfhs-eyebrow-script hfhs-eyebrow-script--light"><?php echo esc_html( $lbl( 'cta_script', 'Ready to get started?' ) ); ?></p>
			<h2 class="hfhs-display hfhs-cta__title"><?php echo wp_kses_post( $cta_title ); ?></h2>
			<div class="hfhs-cta__actions">
				<a class="hfhs-btn hfhs-btn--solid" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Contact Us</a>
				<a class="hfhs-btn hfhs-btn--outline-light" href="tel:+14045072579">Call 404-507-2579</a>
			</div>
		</div>
	</section>

<?php endwhile; ?>
</main><!-- end .hfhs-svc-page -->

<?php get_footer(); ?>
