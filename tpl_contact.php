<?php
/*
	Template Name: Contact Template
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

		<div class="rcd-home rcd-contact">

		<!-- ===================== INTRO ===================== -->
		<section class="rcd-band-cream rcd-section rcd-svc-intro">
			<div class="container">
				<div class="row justify-content-center text-center">
					<div class="col-12 col-lg-9">
						<div class="rcd-eyebrow rcd-eyebrow--center">
							<span class="rcd-rule"></span>
							<span class="rcd-eyebrow-txt"><?php echo esc_html( rcd_con_field( 'intro_eyebrow' ) ); ?></span>
							<span class="rcd-rule"></span>
						</div>
						<h1 class="rcd-h1"><?php echo wp_kses_post( rcd_con_field( 'intro_heading' ) ); ?></h1>
						<p class="rcd-lead rcd-lead--center"><?php echo esc_html( rcd_con_field( 'intro_text' ) ); ?></p>
					</div>
				</div>
			</div>
		</section>

		<!-- ===================== FORM + DETAILS ===================== -->
		<section class="rcd-section">
			<div class="container">
				<div class="row g-5">

					<!-- Form -->
					<div class="col-12 col-lg-7">
						<div id="contact-form" class="rcd-contact-formwrap">
							<h2 class="rcd-h2 rcd-contact-formheading"><?php echo esc_html( rcd_con_field( 'form_heading' ) ); ?></h2>

							<?php
							$rcd_status = isset( $_GET['rcd_contact'] ) ? sanitize_key( wp_unslash( $_GET['rcd_contact'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification
							if ( 'sent' === $rcd_status ) : ?>
								<div class="rcd-contact-alert rcd-contact-alert--success"><?php echo esc_html( rcd_con_field( 'form_success_text' ) ); ?></div>
							<?php elseif ( 'error' === $rcd_status ) : ?>
								<div class="rcd-contact-alert rcd-contact-alert--error"><?php echo esc_html( rcd_con_field( 'form_error_text' ) ); ?></div>
							<?php endif; ?>

							<?php
							$rcd_shortcode = rcd_con_field( 'form_shortcode' );
							if ( '' !== trim( (string) $rcd_shortcode ) ) :
								echo do_shortcode( $rcd_shortcode );
							else : ?>
								<form class="rcd-contact-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
									<input type="hidden" name="action" value="rcd_contact_submit">
									<input type="hidden" name="rcd_page_id" value="<?php echo esc_attr( get_the_ID() ); ?>">
									<?php wp_nonce_field( 'rcd_contact', 'rcd_contact_nonce' ); ?>

									<div class="rcd-hp" aria-hidden="true">
										<label>Leave this field empty<input type="text" name="rcd_website" tabindex="-1" autocomplete="off"></label>
									</div>

									<div class="row g-3">
										<div class="col-12 col-sm-6">
											<div class="rcd-field">
												<label for="rcd_name">Name</label>
												<input type="text" id="rcd_name" name="rcd_name" required>
											</div>
										</div>
										<div class="col-12 col-sm-6">
											<div class="rcd-field">
												<label for="rcd_email">Email</label>
												<input type="email" id="rcd_email" name="rcd_email" required>
											</div>
										</div>
									</div>
									<div class="rcd-field">
										<label for="rcd_message">Message</label>
										<textarea id="rcd_message" name="rcd_message" rows="6" required></textarea>
									</div>
									<button type="submit" class="rcd-btn rcd-btn-dark"><?php echo esc_html( rcd_con_field( 'form_button_text' ) ); ?></button>
								</form>
							<?php endif; ?>
						</div>
					</div>

					<!-- Details -->
					<div class="col-12 col-lg-5">
						<aside class="rcd-contact-details">
							<div class="rcd-eyebrow">
								<span class="rcd-rule"></span>
								<span class="rcd-eyebrow-txt"><?php echo esc_html( rcd_con_field( 'details_eyebrow' ) ); ?></span>
							</div>
							<h2 class="rcd-h2 rcd-contact-detailsheading"><?php echo wp_kses_post( rcd_con_field( 'details_heading' ) ); ?></h2>

							<div class="rcd-contact-detaillist">
								<?php foreach ( rcd_con_rows( 'details' ) as $detail ) : ?>
									<div class="rcd-detail">
										<span class="rcd-detail-label"><?php echo esc_html( rcd_home_row( $detail, 'label' ) ); ?></span>
										<?php if ( rcd_home_row( $detail, 'url' ) ) : ?>
											<a class="rcd-detail-value" href="<?php echo esc_url( rcd_home_row( $detail, 'url' ) ); ?>"><?php echo esc_html( rcd_home_row( $detail, 'value' ) ); ?></a>
										<?php else : ?>
											<span class="rcd-detail-value"><?php echo esc_html( rcd_home_row( $detail, 'value' ) ); ?></span>
										<?php endif; ?>
									</div>
								<?php endforeach; ?>
							</div>

							<?php $rcd_socials = rcd_con_rows( 'socials' ); ?>
							<?php if ( ! empty( $rcd_socials ) ) : ?>
								<div class="rcd-contact-socials">
									<?php foreach ( $rcd_socials as $social ) : ?>
										<a class="rcd-contact-social" href="<?php echo esc_url( rcd_home_row( $social, 'url', '#' ) ); ?>"><?php echo esc_html( rcd_home_row( $social, 'label' ) ); ?></a>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>
						</aside>
					</div>

				</div>
			</div>
		</section>

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

		</div><!-- end .rcd-home -->

	</div><!-- end page wrap -->
    <?php get_footer(); ?>
