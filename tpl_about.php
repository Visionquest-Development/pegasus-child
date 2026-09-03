<?php
/*
	Template Name: About Page
*/
/**
 * Valor Care — About page template.
 *
 * Same brand look-and-feel as the homepage (tpl_home.php), built from Bootstrap
 * 5 markup and the shared Valor Care CSS. Fully CMB2-driven (see
 * inc/cmb2-about-fields.php): every field falls back to its design default until
 * a real value / repeatable row is filled in and saved.
 *
 * Header & footer are handled by the theme options.
 *
 * @package Pegasus_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* -------------------------------------------------------------------------
 * Rendering helpers (guarded so they are only declared once).
 * ---------------------------------------------------------------------- */

if ( ! function_exists( 'vc_about_val' ) ) {
	/**
	 * Scalar About-page field value with design-default fallback.
	 *
	 * @param string $key Key without the vc_ prefix (e.g. 'about_title').
	 * @return string
	 */
	function vc_about_val( $key ) {
		$v = get_post_meta( get_the_ID(), 'vc_' . $key, true );
		if ( '' === $v || null === $v ) {
			return function_exists( 'valorcare_about_default' ) ? valorcare_about_default( $key ) : '';
		}
		return $v;
	}
}

if ( ! function_exists( 'vc_about_rows' ) ) {
	/**
	 * Repeatable group rows with design-default fallback. Blank rows are
	 * stripped so the design defaults show until real content is entered.
	 *
	 * @param string $key Group key without the vc_ prefix (e.g. 'values').
	 * @return array
	 */
	function vc_about_rows( $key ) {
		$defaults = function_exists( 'valorcare_about_defaults' ) ? valorcare_about_defaults() : array();
		$rows     = get_post_meta( get_the_ID(), 'vc_' . $key, true );

		if ( is_array( $rows ) ) {
			$rows = array_values( array_filter(
				$rows,
				function( $row ) {
					if ( ! is_array( $row ) ) {
						return '' !== trim( (string) $row );
					}
					foreach ( $row as $field_key => $value ) {
						if ( '_id' === substr( $field_key, -3 ) ) {
							continue;
						}
						if ( '' !== trim( (string) $value ) ) {
							return true;
						}
					}
					return false;
				}
			) );
		}

		if ( empty( $rows ) ) {
			return isset( $defaults[ $key ] ) ? $defaults[ $key ] : array();
		}
		return $rows;
	}
}

if ( ! function_exists( 'vc_image_slot' ) ) {
	/** Output an image, or a styled placeholder when no image is set. */
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

if ( ! function_exists( 'vc_paras' ) ) {
	/** Echo each non-empty line of $text as a <p class="$class"> paragraph. */
	function vc_paras( $text, $class ) {
		$paras = preg_split( '/\n\s*\n|\n/', trim( (string) $text ) );
		foreach ( $paras as $para ) {
			$para = trim( $para );
			if ( '' === $para ) {
				continue;
			}
			echo '<p class="' . esc_attr( $class ) . '">' . esc_html( $para ) . '</p>';
		}
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
	<div class="vc-home vc-about-page">

		<?php while ( have_posts() ) : the_post(); ?>

		<!-- ============================ HERO ============================ -->
		<section class="vc-hero">
			<div class="container py-5">
				<div class="row align-items-center g-5 py-lg-4">
					<div class="col-lg-6">
						<div class="vc-eyebrow"><?php echo esc_html( vc_about_val( 'about_eyebrow' ) ); ?></div>
						<h1 class="vc-serif vc-h1 wow fadeInUp"><?php echo wp_kses_post( vc_about_val( 'about_title' ) ); ?></h1>
						<p class="vc-hero-lead wow fadeInUp" data-wow-delay="0.1s"><?php echo nl2br( esc_html( vc_about_val( 'about_intro' ) ) ); ?></p>
					</div>
					<div class="col-lg-6">
						<div class="vc-framed vc-framed--bl">
							<div class="vc-framed__accent"></div>
							<?php echo vc_image_slot( vc_about_val( 'about_hero_image' ), 'Caregiver with senior client at home', 'vc-framed__media vc-ar-4x3' ); ?>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- ========================== OUR STORY ========================= -->
		<section class="vc-signs py-5">
			<div class="container py-lg-4">
				<div class="row align-items-center g-5">
					<div class="col-lg-5">
						<div class="vc-framed vc-framed--tr">
							<div class="vc-framed__accent"></div>
							<?php echo vc_image_slot( vc_about_val( 'about_story_image' ), 'The Valor Care story', 'vc-framed__media vc-ar-4x5' ); ?>
						</div>
					</div>
					<div class="col-lg-7">
						<div class="vc-eyebrow"><?php echo esc_html( vc_about_val( 'about_story_eyebrow' ) ); ?></div>
						<h2 class="vc-serif vc-title mb-0 wow fadeInRight"><?php echo esc_html( vc_about_val( 'about_story_title' ) ); ?></h2>
						<div class="vc-rule"></div>
						<?php vc_paras( vc_about_val( 'about_story_body' ), 'vc-founder-bio' ); ?>
					</div>
				</div>
			</div>
		</section>

		<!-- ========================== OUR VALUES ======================== -->
		<section class="vc-why py-5">
			<div class="container py-lg-4">
				<div class="text-center mx-auto vc-section-head-sm wow fadeInUp">
					<div class="vc-eyebrow vc-eyebrow--light"><?php echo esc_html( vc_about_val( 'about_values_eyebrow' ) ); ?></div>
					<h2 class="vc-serif vc-title vc-title--light"><?php echo esc_html( vc_about_val( 'about_values_title' ) ); ?></h2>
				</div>
				<div class="row g-4 mt-2">
					<?php foreach ( vc_about_rows( 'values' ) as $vi => $value ) : ?>
						<div class="col-md-6 col-lg-3 wow fadeInUp" data-wow-delay="<?php echo esc_attr( $vi * 0.1 ); ?>s">
							<div class="vc-why-card h-100 p-4">
								<?php if ( ! empty( $value['icon'] ) ) : ?>
									<i class="fa <?php echo esc_attr( $value['icon'] ); ?> vc-why-icon"></i>
								<?php endif; ?>
								<h3 class="vc-serif vc-why-title"><?php echo esc_html( isset( $value['title'] ) ? $value['title'] : '' ); ?></h3>
								<p class="vc-why-text"><?php echo esc_html( isset( $value['text'] ) ? $value['text'] : '' ); ?></p>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<!-- ============================ TEAM ============================ -->
		<section class="vc-founder py-5">
			<div class="container py-lg-4">
				<div class="text-center mx-auto vc-section-head-xs mb-5 wow fadeInUp">
					<div class="vc-eyebrow"><?php echo esc_html( vc_about_val( 'about_team_eyebrow' ) ); ?></div>
					<h2 class="vc-serif vc-title"><?php echo esc_html( vc_about_val( 'about_team_title' ) ); ?></h2>
				</div>
				<?php foreach ( vc_about_rows( 'team' ) as $i => $member ) :
					$even = ( 0 === $i % 2 ); // First (and every other) member: portrait on the right.
					$name = isset( $member['name'] ) ? $member['name'] : '';
				?>
					<div class="row align-items-center g-5 vc-team-member wow fadeInUp">
						<div class="col-lg-5 <?php echo $even ? 'order-lg-2' : 'order-lg-1'; ?>">
							<div class="vc-framed <?php echo $even ? 'vc-framed--bl' : 'vc-framed--tr'; ?>">
								<div class="vc-framed__accent vc-framed__accent--solid"></div>
								<?php echo vc_image_slot( isset( $member['image'] ) ? $member['image'] : '', $name, 'vc-framed__media vc-ar-1x1' ); ?>
							</div>
						</div>
						<div class="col-lg-7 <?php echo $even ? 'order-lg-1' : 'order-lg-2'; ?>">
							<?php if ( ! empty( $member['role'] ) ) : ?>
								<div class="vc-eyebrow"><?php echo esc_html( $member['role'] ); ?></div>
							<?php endif; ?>
							<h3 class="vc-serif vc-title"><?php echo esc_html( $name ); ?></h3>
							<div class="vc-rule"></div>
							<?php if ( ! empty( $member['bio'] ) ) { vc_paras( $member['bio'], 'vc-founder-bio' ); } ?>
							<?php if ( ! empty( $member['quote'] ) ) : ?>
								<blockquote class="vc-serif vc-quote"><?php echo esc_html( $member['quote'] ); ?></blockquote>
							<?php endif; ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</section>

		<!-- ============================= CTA ============================ -->
		<section class="vc-consult vc-svc-cta py-5">
			<div class="container py-lg-4">
				<div class="row align-items-center g-4">
					<div class="col-lg-8">
						<h2 class="vc-serif vc-title vc-title--light m-0 wow fadeInUp"><?php echo wp_kses_post( vc_about_val( 'about_cta_title' ) ); ?></h2>
						<p class="vc-consult-text mb-0 mt-3"><?php echo nl2br( esc_html( vc_about_val( 'about_cta_text' ) ) ); ?></p>
					</div>
					<div class="col-lg-4 text-lg-end">
						<a href="<?php echo esc_url( vc_about_val( 'about_cta_btn_link' ) ); ?>" class="btn btn-lg fw-bold px-4 vc-btn-gold">
							<?php echo esc_html( vc_about_val( 'about_cta_btn_text' ) ); ?>
						</a>
					</div>
				</div>
			</div>
		</section>

		<?php endwhile; ?>

	</div><!-- .vc-about-page -->
</div><!-- #page-wrap -->

<?php get_footer(); ?>
