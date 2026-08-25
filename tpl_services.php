<?php
/*
	Template Name: Services Template
*/
?>
	<?php get_header(); ?>

	<?php
		$header_choice = pegasus_get_option( 'header_select' );
		//var_dump($header_choice);
		if ( 'header-three' === $header_choice ) {
			get_template_part( 'templates/additional_header' );
		}
	?>

	<div id="page-wrap">

		<?php
			//full container page options
			$post_full_container_choice = get_post_meta( get_the_ID(), 'pegasus-page-container-checkbox', true );
			//full container theme option
			$global_full_container_option = pegasus_get_option('full_container_chk' );

			//assign post class
			$pegasus_post_container_choice = ( 'on' === $post_full_container_choice ) ? 'container-fluid' : 'container';
			//assign global class
			$pegasus_global_container_choice = ( 'on' === $global_full_container_option ) ? 'container-fluid' : 'container' ;
			//check global first then post
			$final_container_class = ( 'container-fluid' === $pegasus_global_container_choice ) ? $pegasus_global_container_choice : $pegasus_post_container_choice;

			//left align right sidebar?
			$left_align_sidebar_chk =  pegasus_get_option( 'sidebar_left_chk' ) ? pegasus_get_option( 'sidebar_left_chk' ) : 'off';
			//enable both sidebars?
			$pegasus_left_sidebar_option = ( 'on' === pegasus_get_option( 'both_sidebar_chk' ) ) ? pegasus_get_option( 'both_sidebar_chk' ) : 'off';
			//change content class if both sidebars
			$page_body_content_class = ( 'on' === $pegasus_left_sidebar_option  ) ? 'col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xg-6' : 'col-xs-12 col-sm-12 col-md-12 col-lg-9 col-xg-9';

			//page header page options
			$post_disable_page_header_choice = get_post_meta( get_the_ID(), 'pegasus-page-header-checkbox', true ) ? get_post_meta( get_the_ID(), 'pegasus-page-header-checkbox', true ) : 'off';
			//page header theme option
			$global_disable_page_header_option =  pegasus_get_option('page_header_chk' ) ? pegasus_get_option('page_header_chk' ) : 'off';
			//check theme option for page header before page option
			$page_title = $post->post_title;
			$is_this_home = is_home();
			if ( 'on' === $global_disable_page_header_option ) {
				$final_page_header_option = 'on';
			} elseif ( 'on' === $post_disable_page_header_choice ) {
				$final_page_header_option = 'on';
			} else {
				$final_page_header_option = 'off';
			}

			if ( true === $is_this_home ) {
				$final_page_header_option = 'off';
			}
		?>

		<div class="rcd-home rcd-services">

		<!-- ===================== INTRO ===================== -->
		<section class="rcd-band-cream rcd-section rcd-svc-intro">
			<div class="container">
				<div class="row justify-content-center text-center">
					<div class="col-12 col-lg-9">
						<div class="rcd-eyebrow rcd-eyebrow--center">
							<span class="rcd-rule"></span>
							<span class="rcd-eyebrow-txt"><?php echo esc_html( rcd_svc_field( 'intro_eyebrow' ) ); ?></span>
							<span class="rcd-rule"></span>
						</div>
						<h1 class="rcd-h1"><?php echo wp_kses_post( rcd_svc_field( 'intro_heading' ) ); ?></h1>
						<p class="rcd-lead rcd-lead--center"><?php echo esc_html( rcd_svc_field( 'intro_text' ) ); ?></p>
						<div class="rcd-svc-quicklinks">
							<?php foreach ( rcd_svc_rows( 'intro_links' ) as $link ) : ?>
								<a class="rcd-link-underline" href="<?php echo esc_url( rcd_home_row( $link, 'url', '#' ) ); ?>"><?php echo wp_kses_post( rcd_home_row( $link, 'text' ) ); ?></a>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- ===================== PILLARS ( from the shared repeatable field ) ===================== -->
		<?php
			foreach ( rcd_get_services() as $rcd_index => $rcd_service ) {
				rcd_services_render_pillar( $rcd_service, $rcd_index );
			}
		?>

		<!-- ===================== SEO / PAGE CONTENT ===================== -->
		<section class="rcd-section rcd-seo-content">
			<div class="<?php echo esc_attr( $final_container_class ); ?>">
				<div class="row justify-content-center">
					<div class="col-12 col-lg-10">
						<div class="inner-content">
							<div class="content-no-sidebar">
								<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
									<?php if( 'off' === $final_page_header_option ) { ?>
										<div class="page-header">
											<?php
											if( '' === $page_title ) {
												echo '';
											} elseif ( $page_title ) {
												echo '<h1>';
												echo the_title();
												echo '</h1>';
											}
											?>
										</div>
									<?php }else{ ?>
										<div class="page-header-spacer"></div>
									<?php } ?>

									<?php the_content(); ?>

								<?php endwhile; else: ?>
									<?php /* kinda a 404 of sorts when not working */ ?>
									<div class="page-header">
										<h1>Oh no!</h1>
									</div>
									<p>No content is appearing for this page!</p>
								<?php endif; ?>
								<?php
									if ( function_exists( 'wp_bootstrap_edit_post_link' ) ) {
										// Edit post link
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
									if ( function_exists( 'wp_bootstrap_posts_pagination' ) ) {
										wp_bootstrap_posts_pagination( array(
											'prev_text'          => __( 'Previous page', 'pegasus' ),
											'next_text'          => __( 'Next page', 'pegasus' ),
											'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'pegasus' ) . ' </span>'
										) );
									}
								?>
							</div>
						</div><!--end inner content-->
					</div>
				</div>
			</div>
		</section>

		<!-- ===================== CTA ===================== -->
		<section id="contact" class="rcd-band-dark rcd-section">
			<div class="container">
				<div class="row justify-content-center text-center">
					<div class="col-12 col-lg-8">
						<div class="rcd-eyebrow rcd-eyebrow--center">
							<span class="rcd-rule"></span>
							<span class="rcd-eyebrow-txt"><?php echo esc_html( rcd_svc_field( 'cta_eyebrow' ) ); ?></span>
							<span class="rcd-rule"></span>
						</div>
						<h2 class="rcd-h2"><?php echo wp_kses_post( rcd_svc_field( 'cta_heading' ) ); ?></h2>
						<p class="rcd-lead rcd-lead--center"><?php echo esc_html( rcd_svc_field( 'cta_text' ) ); ?></p>
						<div class="rcd-btns rcd-btns--center">
							<a class="rcd-btn rcd-btn-light" href="<?php echo esc_url( rcd_svc_field( 'cta_btn_link' ) ); ?>"><?php echo esc_html( rcd_svc_field( 'cta_btn_text' ) ); ?></a>
						</div>
					</div>
				</div>
			</div>
		</section>

		</div><!-- end .rcd-home -->

	</div><!-- end page wrap -->
    <?php get_footer(); ?>
