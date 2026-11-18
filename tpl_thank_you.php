<?php
/*
	Template Name: Thank You Template
*/

/**
 * Thank-you page for Hart Family of Home Services (contact form confirmation).
 *
 * Point the Fluent Forms confirmation ("Redirect to a page") at a page using this
 * template. noindex is added automatically. CMB2: "Thank You Page Content"
 * (inc/cmb2-thank-you-fields.php). Blank = default.
 */
?>
<?php get_header(); ?>

<?php
	$hero_bg = hfhs_hero_bg( hfhs_thanks_field( 'image', '' ), get_stylesheet_directory_uri() . '/images/branding/heroes/contact-hero.jpg' );
	$phone   = '404-507-2579';
?>

<main id="page-wrap" class="hfhs-home hfhs-thanks-page">

	<section class="hfhs-hero hfhs-contact-hero hfhs-section--dark hfhs-thanks" id="top" style="background-image: url('<?php echo esc_url( $hero_bg ); ?>');">
		<div class="hfhs-hero__overlay" aria-hidden="true"></div>
		<div class="container hfhs-hero__inner wow fadeInUp" data-wow-duration="1s">
			<p class="hfhs-eyebrow hfhs-eyebrow--light"><?php echo esc_html( hfhs_thanks_field( 'eyebrow', 'Thank You' ) ); ?></p>
			<p class="hfhs-eyebrow-script hfhs-eyebrow-script--light"><?php echo esc_html( hfhs_thanks_field( 'script', 'From Our Family to Yours.' ) ); ?></p>
			<h1 class="hfhs-hero__title"><?php echo wp_kses_post( hfhs_thanks_field( 'title', 'We got your request. <em>We’ll respond within one business day.</em>' ) ); ?></h1>
			<p class="hfhs-hero__lead"><?php echo esc_html( hfhs_thanks_field( 'body', 'For urgent repairs, give us a call or text a photo of your project to ' . $phone . '.' ) ); ?></p>
			<div class="hfhs-hero__actions">
				<a class="hfhs-btn hfhs-btn--solid" href="<?php echo esc_url( hfhs_url( hfhs_thanks_field( 'btn1_link', hfhs_home_link( '/' ) ) ) ); ?>"><?php echo esc_html( hfhs_thanks_field( 'btn1_text', 'Back to Home' ) ); ?></a>
				<a class="hfhs-btn hfhs-btn--outline-light" href="<?php echo esc_url( hfhs_url( hfhs_thanks_field( 'btn2_link', hfhs_home_link( '/services/' ) ) ) ); ?>"><?php echo esc_html( hfhs_thanks_field( 'btn2_text', 'Explore Our Services' ) ); ?></a>
			</div>
		</div>
	</section>

</main><!-- end .hfhs-thanks-page -->

<?php get_footer(); ?>
