<?php
/*
	Template Name: Services (Elliot Integration)
*/

/**
 * Services page template.
 *
 * Adapted from the Pegasus parent "No Sidebar Template". Header and footer are
 * handled by the theme; this template renders the services-page body sections
 * ( hero, jump index, 8 alternating service blocks, CTA ), each powered by CMB2
 * fields that fall back to the Claude Design defaults until filled in.
 *
 * The service blocks are one repeatable group; each block's number, background
 * theme ( light / cream / dark ) and image side are derived from its position.
 *
 * @package Pegasus_Child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$header_choice = function_exists( 'pegasus_get_option' ) ? pegasus_get_option( 'header_select' ) : '';
if ( 'header-three' === $header_choice ) {
	get_template_part( 'templates/additional_header' );
}

$post_id  = get_the_ID();
$d        = function_exists( 'elliot_services_defaults' ) ? elliot_services_defaults() : array();
$services = elliot_group( $post_id, 'elliot_svc2_items', $d['services'] );

if ( have_posts() ) {
	the_post();
}
?>

<div id="page-wrap">
	<main class="elliot-svcs">

		<!-- ===== HERO ================================================= -->
		<section class="elliot-svcs-hero">
			<div class="container">
				<div class="row gx-5 gy-4 align-items-end">
					<div class="col-lg-8">
						<p class="elliot-svcs-eyebrow elliot-svcs-eyebrow--rule mb-4">
							<?php echo esc_html( elliot_field( $post_id, 'elliot_svc2_eyebrow', $d['hero']['eyebrow'] ) ); ?>
						</p>
						<h1 class="elliot-svcs-hero__title">
							<?php echo esc_html( elliot_field( $post_id, 'elliot_svc2_h_line1', $d['hero']['line1'] ) ); ?><br>
							<?php echo esc_html( elliot_field( $post_id, 'elliot_svc2_h_line2', $d['hero']['line2'] ) ); ?><br>
							<em class="elliot-svcs-emph"><?php echo esc_html( elliot_field( $post_id, 'elliot_svc2_h_emph', $d['hero']['emph'] ) ); ?></em>
						</h1>
					</div>
					<div class="col-lg-4">
						<p class="elliot-svcs-hero__intro">
							<?php echo esc_html( elliot_field( $post_id, 'elliot_svc2_intro', $d['hero']['intro'] ) ); ?>
						</p>
					</div>
				</div>
			</div>
		</section>

		<!-- ===== SERVICE INDEX ======================================= -->
		<section class="elliot-svcs-index">
			<div class="container">
				<div class="row g-0 elliot-svcindex">
					<?php foreach ( $services as $i => $s ) : ?>
						<a class="col-6 col-md-3 elliot-svcindex__item" href="#svc-<?php echo (int) $i; ?>">
							<span class="elliot-svcindex__num"><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></span>
							<span class="elliot-svcindex__label"><?php echo esc_html( isset( $s['label'] ) ? $s['label'] : '' ); ?></span>
						</a>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<!-- ===== SERVICE BLOCKS ====================================== -->
		<?php
		foreach ( $services as $i => $s ) :
			$num  = sprintf( '%02d', $i + 1 );
			$mod  = $i % 4;
			// light on even positions, cream band on i%4==1, dark on i%4==3.
			$theme_class = ( 1 === $mod ) ? 'is-band' : ( ( 3 === $mod ) ? 'is-dark' : 'is-light' );
			// image alternates: right on even positions, left on odd.
			$reverse = ( 1 === $i % 2 ) ? 'flex-lg-row-reverse' : '';

			// Features can arrive as an array ( defaults ) or a newline string ( saved ).
			$features = isset( $s['features'] ) ? $s['features'] : array();
			if ( is_string( $features ) ) {
				$features = array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', $features ) ) );
			}

			$image = isset( $s['image'] ) ? $s['image'] : '';
			$title = isset( $s['title'] ) ? $s['title'] : '';
			?>
			<section id="svc-<?php echo (int) $i; ?>" class="elliot-svc <?php echo esc_attr( $theme_class ); ?>">
				<div class="container">
					<div class="row gx-5 gy-4 align-items-center <?php echo esc_attr( $reverse ); ?>">
						<div class="col-lg-6 elliot-svc__text">
							<div class="elliot-svc__eyebrow"><?php echo esc_html( $num . ' — ' . ( isset( $s['label'] ) ? $s['label'] : '' ) ); ?></div>
							<h2 class="elliot-svc__title"><?php echo esc_html( $title ); ?></h2>
							<p class="elliot-svc__lead"><?php echo esc_html( isset( $s['lead'] ) ? $s['lead'] : '' ); ?></p>
							<?php if ( ! empty( $features ) ) : ?>
								<div class="elliot-svc__features">
									<?php foreach ( $features as $f ) : ?>
										<div class="elliot-svc__feature">
											<span class="elliot-svc__dot"></span>
											<span><?php echo esc_html( $f ); ?></span>
										</div>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>
						</div>
						<div class="col-lg-6 elliot-svc__media">
							<?php if ( $image ) : ?>
								<div class="elliot-imgslot2">
									<img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $title ); ?>">
								</div>
							<?php else : ?>
								<div class="elliot-imgslot2 is-empty"><span>Drop a photo</span></div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</section>
		<?php endforeach; ?>

		<!-- ===== CTA ================================================= -->
		<section class="elliot-svcs-cta">
			<div class="container">
				<div class="row gx-5 gy-4 align-items-end">
					<div class="col-lg-7">
						<div class="elliot-svcs-eyebrow elliot-svcs-eyebrow--gold2 mb-3"><?php echo esc_html( elliot_field( $post_id, 'elliot_svc2_cta_eyebrow', $d['cta']['eyebrow'] ) ); ?></div>
						<h2 class="elliot-svcs-cta__title">
							<?php echo esc_html( elliot_field( $post_id, 'elliot_svc2_cta_title', $d['cta']['title'] ) ); ?><br>
							<em class="elliot-svcs-emph elliot-svcs-emph--gold2"><?php echo esc_html( elliot_field( $post_id, 'elliot_svc2_cta_emph', $d['cta']['emph'] ) ); ?></em>
						</h2>
					</div>
					<div class="col-lg-5">
						<p class="elliot-svcs-cta__para"><?php echo esc_html( elliot_field( $post_id, 'elliot_svc2_cta_para', $d['cta']['para'] ) ); ?></p>
						<a class="elliot-svcs-btn" href="<?php echo esc_url( elliot_field( $post_id, 'elliot_svc2_cta_btn_link', $d['cta']['btn_link'] ) ); ?>">
							<?php echo esc_html( elliot_field( $post_id, 'elliot_svc2_cta_btn_text', $d['cta']['btn_text'] ) ); ?> <span aria-hidden="true">&rarr;</span>
						</a>
					</div>
				</div>
			</div>
		</section>

		<?php
		if ( function_exists( 'get_the_content' ) && trim( get_the_content() ) !== '' ) {
			echo '<section class="elliot-svcs-pagebody"><div class="container">';
			the_content();
			echo '</div></section>';
		}

		if ( function_exists( 'wp_bootstrap_edit_post_link' ) ) {
			wp_bootstrap_edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'pegasus' ),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
		}
		?>

	</main><!-- /.elliot-svcs -->
</div><!-- /#page-wrap -->

<?php get_footer(); ?>
