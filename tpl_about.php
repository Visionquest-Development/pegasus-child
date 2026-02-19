<?php
/*
	Template Name: About Template
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

<div class="<?php echo $final_container_class; ?> mt-3">
		<!-- Example row of columns -->
			<div class="">

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

			</div><!--end row -->
		</div><!-- end container -->

		<div class="site-content container">
			<div class="wp-block-columns is-layout-flex wp-container-core-columns-is-layout-9d6595d7 wp-block-columns-is-layout-flex">
				<div class="wp-block-column is-layout-flow wp-block-column-is-layout-flow" style="flex-basis:100%">



					<p>At 34 Oak Contracting, we believe in transforming houses into homes through exceptional craftsmanship, attention to detail, and a commitment to excellence. Founded with a passion for quality and customer satisfaction, we have built a reputation as a trusted partner for homeowners and real estate professionals across the region.</p>


					<hr class="wp-block-separator has-alpha-channel-opacity">


					<h2 class="wp-block-heading">Our Story</h2>


					<div class="row g-4 align-items-center">
						<div class="col-md-8">
							<p>Our journey began with a simple goal: to provide top-tier contracting services that meet the unique needs of each client. Over the years, we have expanded our offerings to include a comprehensive range of interior and exterior repair and renovation services. From intricate tile work and custom cabinetry to roof repairs and outdoor living spaces, our team is dedicated to delivering results that exceed expectations.</p>
						</div>
						<div class="col-md-4 text-center">
							<figure class="mb-0">
								<img decoding="async" width="359" height="294" src="//34oakcontracting.com/wp-content/uploads/2024/07/images.jpeg" alt="" class="img-fluid">
							</figure>
						</div>
					</div>




					<div class="row g-4 my-5 align-items-center">
						<div class="col-md-4 text-center">
							<figure class="wp-block-image size-large is-resized has-lightbox">
								<a href="//www.bbb.org/us/ga/woodstock/profile/roofing-contractors/34-oak-contracting-llc-0443-91825803">
									<img decoding="async" width="2048" height="742" src="//34oakcontracting.com/wp-content/uploads/2024/05/BBB-Dynamic-Seal-4-2048x742.png" alt="" class="wp-image-353" style="width:211px;height:auto" srcset="//34oakcontracting.com/wp-content/uploads/2024/05/BBB-Dynamic-Seal-4-2048x742.png 2048w, //34oakcontracting.com/wp-content/uploads/2024/05/BBB-Dynamic-Seal-4-500x181.png 500w, //34oakcontracting.com/wp-content/uploads/2024/05/BBB-Dynamic-Seal-4-768x278.png 768w, //34oakcontracting.com/wp-content/uploads/2024/05/BBB-Dynamic-Seal-4-1536x557.png 1536w" sizes="(max-width: 2048px) 100vw, 2048px">
								</a>
							</figure>
						</div>

						<div class="col-md-4 text-center">
							<figure class="wp-block-image size-full is-resized">
								<img decoding="async" width="200" height="168" src="//34oakcontracting.com/wp-content/uploads/2024/05/GreenJHLogo.jpg" alt="" class="wp-image-354" style="width:85px;height:auto">
							</figure>
						</div>

						<div class="col-md-4 text-center">
							<figure class="wp-block-image size-full is-resized">
								<img loading="lazy" decoding="async" width="400" height="200" src="//34oakcontracting.com/wp-content/uploads/2024/05/615e3e_2ce135537e094e7dbc532b56d18d455bmv2.gif" alt="" class="wp-image-369" style="width:165px;height:auto">
							</figure>
						</div>
					</div>

					<hr>


					<h2 class="wp-block-heading">Working Together</h2>


					<div class="row g-4 align-items-center mb-5">
						<div class="col-md-4 text-center">
							<figure class="mb-0">
								<img loading="lazy" decoding="async" width="1215" height="1215" src="//34oakcontracting.com/wp-content/uploads/2024/05/Copy-of-Copy-of-TOPHER-GALA-EXPERIMENT-1.png" alt="" class="img-fluid ">
							</figure>
						</div>
						<div class="col-md-8">
							<p>At 34 Oak, we pride ourselves on delivering a seamless, end-to-end client experience.</p>

							<p>Our knowledgeable representatives offer expert guidance during the initial consultation to bring your property vision to life, then provide clear timelines, transparent estimates, and consistent updates throughout the project.</p>

							<p>From planning and permitting to final walkthroughs, we coordinate the details so you can focus on your home while our team handles the work with care and precision.</p>
						</div>
					</div>

					<?php get_template_part( 'templates/about/our-services' ); ?>

					<hr>
					<h2 class="wp-block-heading mt-3 mb-5 has-text-align-center">Why Choose Us</h2>

					<div class="row">
						<div class="wp-block-media-text is-stacked-on-mobile col-md-6">
							<figure class="wp-block-media-text__media">
								<img loading="lazy" decoding="async" width="1215" height="1215" src="//34oakcontracting.com/wp-content/uploads/2024/05/Copy-of-Copy-of-TOPHER-GALA-EXPERIMENT-2.png" alt="" class="wp-image-359 size-full" srcset="//34oakcontracting.com/wp-content/uploads/2024/05/Copy-of-Copy-of-TOPHER-GALA-EXPERIMENT-2.png 1215w, //34oakcontracting.com/wp-content/uploads/2024/05/Copy-of-Copy-of-TOPHER-GALA-EXPERIMENT-2-500x500.png 500w, //34oakcontracting.com/wp-content/uploads/2024/05/Copy-of-Copy-of-TOPHER-GALA-EXPERIMENT-2-150x150.png 150w, //34oakcontracting.com/wp-content/uploads/2024/05/Copy-of-Copy-of-TOPHER-GALA-EXPERIMENT-2-768x768.png 768w" sizes="auto, (max-width: 1215px) 100vw, 1215px">
							</figure>
							<div class="wp-block-media-text__content">
								<p>Our trained specialists have the solutions you need.</p>
								<p>We bring together a multitude of skilled trades to work cohesively and ensure that all projects are completed on time and on budget.</p>
							</div>
						</div>

						<div class="wp-block-media-text has-media-on-the-right  col-md-6 is-stacked-on-mobile">

							<div class="wp-block-media-text__content">
								<p>Through frequent quality control checks, we maintain on-site organization and constant communication with our clients.</p>
							</div>
							<figure class="wp-block-media-text__media">
								<img loading="lazy" decoding="async" width="1215" height="1215" src="//34oakcontracting.com/wp-content/uploads/2024/05/Copy-of-Copy-of-TOPHER-GALA-EXPERIMENT-3.png" alt="" class="wp-image-360 w-50 size-full" srcset="//34oakcontracting.com/wp-content/uploads/2024/05/Copy-of-Copy-of-TOPHER-GALA-EXPERIMENT-3.png 1215w, //34oakcontracting.com/wp-content/uploads/2024/05/Copy-of-Copy-of-TOPHER-GALA-EXPERIMENT-3-500x500.png 500w, //34oakcontracting.com/wp-content/uploads/2024/05/Copy-of-Copy-of-TOPHER-GALA-EXPERIMENT-3-150x150.png 150w, //34oakcontracting.com/wp-content/uploads/2024/05/Copy-of-Copy-of-TOPHER-GALA-EXPERIMENT-3-768x768.png 768w" sizes="auto, (max-width: 1215px) 100vw, 1215px">
							</figure>

							<p>Our commitment to excellence means that a 34 Oak project is not considered complete until both the project manager and client are satisfied with a job well done. <em><strong>Trust 34 Oak to exceed your expectations and deliver the results you need.</strong></em></p>

						</div>
					</div>

				</div>
			</div>
		</div>

		<?php get_template_part( 'templates/about/faq' ); ?>

		<?php get_template_part( 'templates/about/service-areas' ); ?>



	</div><!-- end page wrap -->
    <?php get_footer(); ?>
