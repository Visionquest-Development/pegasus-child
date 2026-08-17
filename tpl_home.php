<?php
/*
	Template Name: Home (Elliot Integration)
*/

/**
 * Home page template.
 *
 * Adapted from the Pegasus parent "No Sidebar Template" ( tpl_page-full-width.php ).
 * Header and footer are handled by the theme; this template only renders the
 * home-page body sections, each powered by CMB2 fields that fall back to the
 * Claude Design defaults until the editor fills them in.
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

$post_id = get_the_ID();
$d       = function_exists( 'elliot_home_defaults' ) ? elliot_home_defaults() : array();
?>

<div id="page-wrap">
	<main class="elliot-home">

		<?php
		// Advance the loop so template tags / edit links behave as expected.
		if ( have_posts() ) {
			the_post();
		}
		?>

		<!-- ===== 01 · HERO ============================================= -->
		<section class="elliot-hero">
			<div class="container">
				<div class="row gx-5 gy-4 align-items-start">
					<div class="col-lg-7 col-xl-8">
						<p class="elliot-eyebrow elliot-eyebrow--rule mb-4">
							<?php echo esc_html( elliot_field( $post_id, 'elliot_hero_eyebrow', $d['hero']['eyebrow'] ) ); ?>
						</p>
						<h1 class="elliot-hero__title">
							<?php echo esc_html( elliot_field( $post_id, 'elliot_hero_title1', $d['hero']['title1'] ) ); ?><br>
							<em class="elliot-emph"><?php echo esc_html( elliot_field( $post_id, 'elliot_hero_emph', $d['hero']['emph'] ) ); ?></em><br>
							<?php echo esc_html( elliot_field( $post_id, 'elliot_hero_title3', $d['hero']['title3'] ) ); ?>
						</h1>
					</div>
					<div class="col-lg-5 col-xl-4">
						<p class="elliot-hero__intro">
							<?php echo esc_html( elliot_field( $post_id, 'elliot_hero_intro', $d['hero']['intro'] ) ); ?>
						</p>
						<div class="elliot-hero__actions">
							<a class="elliot-btn elliot-btn--gold" href="<?php echo esc_url( elliot_field( $post_id, 'elliot_hero_btn1_link', $d['hero']['btn1_link'] ) ); ?>">
								<?php echo esc_html( elliot_field( $post_id, 'elliot_hero_btn1_text', $d['hero']['btn1_text'] ) ); ?> <span aria-hidden="true">&rarr;</span>
							</a>
							<a class="elliot-link" href="<?php echo esc_url( elliot_field( $post_id, 'elliot_hero_btn2_link', $d['hero']['btn2_link'] ) ); ?>">
								<?php echo esc_html( elliot_field( $post_id, 'elliot_hero_btn2_text', $d['hero']['btn2_text'] ) ); ?>
							</a>
						</div>
					</div>
				</div>

				<div class="row elliot-credstrip g-0">
					<?php foreach ( elliot_group( $post_id, 'elliot_hero_credentials', $d['hero']['credentials'] ) as $cred ) : ?>
						<div class="col-6 col-md-3 elliot-credstrip__item">
							<div class="elliot-credstrip__num"><?php echo esc_html( isset( $cred['num'] ) ? $cred['num'] : '' ); ?></div>
							<div class="elliot-credstrip__label"><?php echo esc_html( isset( $cred['label'] ) ? $cred['label'] : '' ); ?></div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<!-- ===== 02 · STATEMENT ======================================= -->
		<section class="elliot-statement">
			<div class="container">
				<div class="elliot-secmeta">
					<span><?php echo esc_html( elliot_field( $post_id, 'elliot_stmt_meta_l', $d['statement']['meta_l'] ) ); ?></span>
					<span><?php echo esc_html( elliot_field( $post_id, 'elliot_stmt_meta_r', $d['statement']['meta_r'] ) ); ?></span>
				</div>
				<div class="row gx-5 gy-4 align-items-start">
					<div class="col-lg-7">
						<h2 class="elliot-h2">
							<?php echo esc_html( elliot_field( $post_id, 'elliot_stmt_title1', $d['statement']['title1'] ) ); ?><br>
							<em class="elliot-emph elliot-emph--gold2"><?php echo esc_html( elliot_field( $post_id, 'elliot_stmt_emph', $d['statement']['emph'] ) ); ?></em>
						</h2>
					</div>
					<div class="col-lg-5">
						<p class="elliot-lead"><?php echo esc_html( elliot_field( $post_id, 'elliot_stmt_p1', $d['statement']['p1'] ) ); ?></p>
						<p class="elliot-muted"><?php echo esc_html( elliot_field( $post_id, 'elliot_stmt_p2', $d['statement']['p2'] ) ); ?></p>
					</div>
				</div>
			</div>
		</section>

		<!-- ===== 03 · SERVICES ======================================== -->
		<section class="elliot-services">
			<div class="container">
				<div class="elliot-secmeta">
					<span><?php echo esc_html( elliot_field( $post_id, 'elliot_svc_meta_l', $d['services']['meta_l'] ) ); ?></span>
					<span><?php echo esc_html( elliot_field( $post_id, 'elliot_svc_meta_r', $d['services']['meta_r'] ) ); ?></span>
				</div>
				<div class="row g-0">
					<?php foreach ( elliot_group( $post_id, 'elliot_svc_items', $d['services']['items'] ) as $item ) : ?>
						<div class="col-6 col-md-3 elliot-service">
							<div class="elliot-service__num"><?php echo esc_html( isset( $item['num'] ) ? $item['num'] : '' ); ?></div>
							<h3 class="elliot-service__title"><?php echo esc_html( isset( $item['title'] ) ? $item['title'] : '' ); ?></h3>
							<p class="elliot-service__desc"><?php echo esc_html( isset( $item['desc'] ) ? $item['desc'] : '' ); ?></p>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<!-- ===== 04 · INDUSTRIES ====================================== -->
		<section class="elliot-industries">
			<div class="container">
				<div class="elliot-secmeta elliot-secmeta--plain">
					<span><?php echo esc_html( elliot_field( $post_id, 'elliot_ind_meta_l', $d['industries']['meta_l'] ) ); ?></span>
					<span><?php echo esc_html( elliot_field( $post_id, 'elliot_ind_meta_r', $d['industries']['meta_r'] ) ); ?></span>
				</div>
				<h2 class="elliot-h2 mb-5">
					<?php echo esc_html( elliot_field( $post_id, 'elliot_ind_title1', $d['industries']['title1'] ) ); ?>
					<em class="elliot-emph elliot-emph--gold2"><?php echo esc_html( elliot_field( $post_id, 'elliot_ind_emph', $d['industries']['emph'] ) ); ?></em>
				</h2>
				<div class="row gy-4">
					<?php foreach ( elliot_group( $post_id, 'elliot_ind_items', $d['industries']['items'] ) as $item ) : ?>
						<div class="col-6 col-md-3 elliot-industry">
							<div class="elliot-industry__code"><?php echo esc_html( isset( $item['code'] ) ? $item['code'] : '' ); ?></div>
							<div class="elliot-industry__name"><?php echo esc_html( isset( $item['name'] ) ? $item['name'] : '' ); ?></div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<!-- ===== 05 · CREDENTIALS BAND ================================ -->
		<section class="elliot-credband">
			<div class="container">
				<div class="elliot-secmeta elliot-secmeta--dark">
					<span><?php echo esc_html( elliot_field( $post_id, 'elliot_cred_meta_l', $d['credentials']['meta_l'] ) ); ?></span>
					<span><?php echo esc_html( elliot_field( $post_id, 'elliot_cred_meta_r', $d['credentials']['meta_r'] ) ); ?></span>
				</div>
				<div class="row gx-5 gy-5 align-items-start">
					<div class="col-lg-5">
						<h2 class="elliot-h2 elliot-h2--light">
							<?php echo esc_html( elliot_field( $post_id, 'elliot_cred_title1', $d['credentials']['title1'] ) ); ?><br>
							<?php echo esc_html( elliot_field( $post_id, 'elliot_cred_title2', $d['credentials']['title2'] ) ); ?><br>
							<em class="elliot-emph elliot-emph--gold3"><?php echo esc_html( elliot_field( $post_id, 'elliot_cred_emph', $d['credentials']['emph'] ) ); ?></em>
						</h2>
						<p class="elliot-credband__para"><?php echo esc_html( elliot_field( $post_id, 'elliot_cred_para', $d['credentials']['para'] ) ); ?></p>
					</div>
					<div class="col-lg-7">
						<div class="row g-0 elliot-credcards">
							<?php foreach ( elliot_group( $post_id, 'elliot_cred_items', $d['credentials']['items'] ) as $item ) : ?>
								<div class="col-6 elliot-credcard">
									<div class="elliot-credcard__tag"><?php echo esc_html( isset( $item['tag'] ) ? $item['tag'] : '' ); ?></div>
									<div class="elliot-credcard__title"><?php echo esc_html( isset( $item['title'] ) ? $item['title'] : '' ); ?></div>
									<div class="elliot-credcard__desc"><?php echo esc_html( isset( $item['desc'] ) ? $item['desc'] : '' ); ?></div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- ===== 06 · FEATURED PROJECT ================================ -->
		<section class="elliot-project">
			<div class="container">
				<div class="elliot-secmeta">
					<span><?php echo esc_html( elliot_field( $post_id, 'elliot_proj_meta_l', $d['project']['meta_l'] ) ); ?></span>
					<span><?php echo esc_html( elliot_field( $post_id, 'elliot_proj_meta_r', $d['project']['meta_r'] ) ); ?></span>
				</div>
				<div class="row gx-5 gy-4 align-items-stretch">
					<div class="col-lg-7">
						<?php $proj_img = elliot_field( $post_id, 'elliot_proj_image', '' ); ?>
						<?php if ( $proj_img ) : ?>
							<div class="elliot-imgslot" style="background-image:none;">
								<img src="<?php echo esc_url( $proj_img ); ?>" alt="<?php echo esc_attr( elliot_field( $post_id, 'elliot_proj_title', $d['project']['title'] ) ); ?>">
							</div>
						<?php else : ?>
							<div class="elliot-imgslot elliot-imgslot--empty">
								<span>Drop a project photo</span>
							</div>
						<?php endif; ?>
					</div>
					<div class="col-lg-5">
						<div class="elliot-eyebrow elliot-eyebrow--gold2 mb-3"><?php echo esc_html( elliot_field( $post_id, 'elliot_proj_eyebrow', $d['project']['eyebrow'] ) ); ?></div>
						<h2 class="elliot-h3 mb-4"><?php echo esc_html( elliot_field( $post_id, 'elliot_proj_title', $d['project']['title'] ) ); ?></h2>
						<div class="elliot-specs">
							<?php foreach ( elliot_group( $post_id, 'elliot_proj_specs', $d['project']['specs'] ) as $spec ) : ?>
								<div class="elliot-specs__row">
									<span class="elliot-specs__label"><?php echo esc_html( isset( $spec['label'] ) ? $spec['label'] : '' ); ?></span>
									<span class="elliot-specs__value"><?php echo esc_html( isset( $spec['value'] ) ? $spec['value'] : '' ); ?></span>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- ===== 07 · PROCESS ========================================= -->
		<section class="elliot-process">
			<div class="container">
				<div class="elliot-secmeta elliot-secmeta--onblue">
					<span><?php echo esc_html( elliot_field( $post_id, 'elliot_proc_meta_l', $d['process']['meta_l'] ) ); ?></span>
					<span><?php echo esc_html( elliot_field( $post_id, 'elliot_proc_meta_r', $d['process']['meta_r'] ) ); ?></span>
				</div>
				<h2 class="elliot-h2 elliot-h2--light mb-5">
					<?php echo esc_html( elliot_field( $post_id, 'elliot_proc_title1', $d['process']['title1'] ) ); ?><br>
					<em class="elliot-emph elliot-emph--gold3"><?php echo esc_html( elliot_field( $post_id, 'elliot_proc_emph', $d['process']['emph'] ) ); ?></em>
				</h2>
				<div class="row gy-5 elliot-steps">
					<?php foreach ( elliot_group( $post_id, 'elliot_proc_steps', $d['process']['steps'] ) as $step ) : ?>
						<div class="col-6 col-md-4 col-lg-2 elliot-step">
							<div class="elliot-step__num"><?php echo esc_html( isset( $step['num'] ) ? $step['num'] : '' ); ?></div>
							<div class="elliot-step__title"><?php echo esc_html( isset( $step['title'] ) ? $step['title'] : '' ); ?></div>
							<div class="elliot-step__desc"><?php echo esc_html( isset( $step['desc'] ) ? $step['desc'] : '' ); ?></div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<!-- ===== 08 · ABOUT =========================================== -->
		<section class="elliot-about">
			<div class="container">
				<div class="elliot-secmeta">
					<span><?php echo esc_html( elliot_field( $post_id, 'elliot_about_meta_l', $d['about']['meta_l'] ) ); ?></span>
					<span><?php echo esc_html( elliot_field( $post_id, 'elliot_about_meta_r', $d['about']['meta_r'] ) ); ?></span>
				</div>
				<div class="row gx-5 gy-4 align-items-start">
					<div class="col-lg-4">
						<?php $about_img = elliot_field( $post_id, 'elliot_about_image', '' ); ?>
						<?php if ( $about_img ) : ?>
							<div class="elliot-imgslot elliot-imgslot--portrait">
								<img src="<?php echo esc_url( $about_img ); ?>" alt="<?php echo esc_attr( elliot_field( $post_id, 'elliot_about_title1', $d['about']['title1'] ) ); ?>">
							</div>
						<?php else : ?>
							<div class="elliot-imgslot elliot-imgslot--portrait elliot-imgslot--empty">
								<span>Drop a portrait</span>
							</div>
						<?php endif; ?>
					</div>
					<div class="col-lg-8">
						<h2 class="elliot-h3 mb-4">
							<?php echo esc_html( elliot_field( $post_id, 'elliot_about_title1', $d['about']['title1'] ) ); ?><br>
							<em class="elliot-emph elliot-emph--gold2"><?php echo esc_html( elliot_field( $post_id, 'elliot_about_emph', $d['about']['emph'] ) ); ?></em>
						</h2>
						<p class="elliot-lead"><?php echo esc_html( elliot_field( $post_id, 'elliot_about_p1', $d['about']['p1'] ) ); ?></p>
						<p class="elliot-muted mb-4"><?php echo esc_html( elliot_field( $post_id, 'elliot_about_p2', $d['about']['p2'] ) ); ?></p>
						<div class="elliot-tags">
							<?php foreach ( elliot_group( $post_id, 'elliot_about_tags', $d['about']['tags'] ) as $tag ) : ?>
								<span class="elliot-tag"><?php echo esc_html( isset( $tag['label'] ) ? $tag['label'] : '' ); ?></span>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- ===== 09 · CTA ============================================= -->
		<section class="elliot-cta">
			<div class="container">
				<div class="row gx-5 gy-4 align-items-end">
					<div class="col-lg-7">
						<div class="elliot-eyebrow elliot-eyebrow--gold2 mb-3"><?php echo esc_html( elliot_field( $post_id, 'elliot_cta_eyebrow', $d['cta']['eyebrow'] ) ); ?></div>
						<h2 class="elliot-h2">
							<?php echo esc_html( elliot_field( $post_id, 'elliot_cta_title1', $d['cta']['title1'] ) ); ?>
							<em class="elliot-emph elliot-emph--gold2"><?php echo esc_html( elliot_field( $post_id, 'elliot_cta_emph', $d['cta']['emph'] ) ); ?></em>
						</h2>
					</div>
					<div class="col-lg-5">
						<p class="elliot-cta__para"><?php echo esc_html( elliot_field( $post_id, 'elliot_cta_para', $d['cta']['para'] ) ); ?></p>
						<a class="elliot-btn elliot-btn--gold2" href="<?php echo esc_url( elliot_field( $post_id, 'elliot_cta_btn_link', $d['cta']['btn_link'] ) ); ?>">
							<?php echo esc_html( elliot_field( $post_id, 'elliot_cta_btn_text', $d['cta']['btn_text'] ) ); ?> <span aria-hidden="true">&rarr;</span>
						</a>
					</div>
				</div>
			</div>
		</section>

		<?php
		// Optional page body content ( from the WP editor ) rendered after the design.
		if ( function_exists( 'get_the_content' ) && trim( get_the_content() ) !== '' ) {
			echo '<section class="elliot-pagebody"><div class="container">';
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

	</main><!-- /.elliot-home -->
</div><!-- /#page-wrap -->

<?php get_footer(); ?>
