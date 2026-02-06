<?php

/*
Template Name: Interior Template
*/

get_header();

$header_choice = pegasus_get_option( 'header_select' );

// var_dump( $header_choice );
if ( 'header-three' === $header_choice ) {
	get_template_part( 'templates/additional_header' );
}
?>

<div id="page-wrap">
	<?php
	// Full container page options.
	$post_full_container_choice = get_post_meta( get_the_ID(), 'pegasus-page-container-checkbox', true );

	// Full container theme option.
	$global_full_container_option = pegasus_get_option( 'full_container_chk' );

	// Assign post class.
	$pegasus_post_container_choice = ( 'on' === $post_full_container_choice ) ? 'container-fluid' : 'container';

	// Assign global class.
	$pegasus_global_container_choice = ( 'on' === $global_full_container_option ) ? 'container-fluid' : 'container';

	// Check global first then post.
	$final_container_class = ( 'container-fluid' === $pegasus_global_container_choice ) ? $pegasus_global_container_choice : $pegasus_post_container_choice;

	// Left align right sidebar?
	$left_align_sidebar_chk = pegasus_get_option( 'sidebar_left_chk' ) ? pegasus_get_option( 'sidebar_left_chk' ) : 'off';

	// Enable both sidebars?
	$pegasus_left_sidebar_option = ( 'on' === pegasus_get_option( 'both_sidebar_chk' ) ) ? pegasus_get_option( 'both_sidebar_chk' ) : 'off';

	// Change content class if both sidebars.
	$page_body_content_class = ( 'on' === $pegasus_left_sidebar_option ) ? 'col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xg-6' : 'col-xs-12 col-sm-12 col-md-12 col-lg-9 col-xg-9';

	// Page header page options.
	$post_disable_page_header_choice = get_post_meta( get_the_ID(), 'pegasus-page-header-checkbox', true ) ? get_post_meta( get_the_ID(), 'pegasus-page-header-checkbox', true ) : 'off';

	// Page header theme option.
	$global_disable_page_header_option = pegasus_get_option( 'page_header_chk' ) ? pegasus_get_option( 'page_header_chk' ) : 'off';

	// Check theme option for page header before page option.
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
	<div class="<?php echo $final_container_class; ?>">
		<!-- Example row of columns -->
		<div class="">
			<div class="inner-content">
				<div class="content-no-sidebar">
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<?php if ( 'off' === $final_page_header_option ) { ?>
							<div class="page-header">
								<?php
								if ( '' === $page_title ) {
									echo '';
								} elseif ( $page_title ) {
									echo '<h1>';
									echo the_title();
									echo '</h1>';
								}
								?>
							</div>
						<?php } else { ?>
							<div class="page-header-spacer"></div>
						<?php } ?>

						<?php the_content(); ?>
					<?php endwhile; else : ?>
						<?php /* kinda a 404 of sorts when not working */ ?>
						<div class="page-header">
							<h1>Oh no!</h1>
						</div>
						<p>No content is appearing for this page!</p>
					<?php endif; ?>

					<?php
					if ( function_exists( 'wp_bootstrap_edit_post_link' ) ) {
						// Edit post link.
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

	<?php $general_img_path = get_stylesheet_directory_uri() . '/images/Interior/general-interior'; ?>



	<?php $kitchen_gallery_path = get_stylesheet_directory_uri() . '/images/Interior/kitchen/gallery-photos'; ?>

	<!-- =====================================================================
		 KITCHEN GALLERY PHOTOS
		 ===================================================================== -->
	<section class="interior-gallery-section py-5" >
		<div class="container">
			<div class="row mb-4">
				<div class="col-12">
					<h2 style="color: #222;">Kitchen Project Gallery</h2>
					<p style="color: var(--oak-muted);">Browse our collection of completed kitchen renovation projects.</p>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<?php
					$gallery_output = '[masonry]';

					$gallery_output .= '<a href="' . $kitchen_gallery_path . '/kitchen-gallery-01.jpg" data-lightbox="kitchen-gallery" data-title="Kitchen Renovation" class="wow fadeIn"><img src="' . $kitchen_gallery_path . '/kitchen-gallery-01.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $kitchen_gallery_path . '/kitchen-gallery-02.jpg" data-lightbox="kitchen-gallery" data-title="Kitchen Renovation" class="wow fadeIn"><img src="' . $kitchen_gallery_path . '/kitchen-gallery-02.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $kitchen_gallery_path . '/kitchen-gallery-03.jpg" data-lightbox="kitchen-gallery" data-title="Kitchen Renovation" class="wow fadeIn"><img src="' . $kitchen_gallery_path . '/kitchen-gallery-03.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $kitchen_gallery_path . '/kitchen-gallery-04.jpg" data-lightbox="kitchen-gallery" data-title="Kitchen Renovation" class="wow fadeIn"><img src="' . $kitchen_gallery_path . '/kitchen-gallery-04.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $kitchen_gallery_path . '/kitchen-gallery-05.jpg" data-lightbox="kitchen-gallery" data-title="Kitchen Renovation" class="wow fadeIn"><img src="' . $kitchen_gallery_path . '/kitchen-gallery-05.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $kitchen_gallery_path . '/kitchen-gallery-06.jpg" data-lightbox="kitchen-gallery" data-title="Kitchen Renovation" class="wow fadeIn"><img src="' . $kitchen_gallery_path . '/kitchen-gallery-06.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $kitchen_gallery_path . '/kitchen-gallery-07.jpg" data-lightbox="kitchen-gallery" data-title="Kitchen Renovation" class="wow fadeIn"><img src="' . $kitchen_gallery_path . '/kitchen-gallery-07.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $kitchen_gallery_path . '/kitchen-gallery-08.jpg" data-lightbox="kitchen-gallery" data-title="Kitchen Renovation" class="wow fadeIn"><img src="' . $kitchen_gallery_path . '/kitchen-gallery-08.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $kitchen_gallery_path . '/kitchen-gallery-09.jpg" data-lightbox="kitchen-gallery" data-title="Kitchen Renovation" class="wow fadeIn"><img src="' . $kitchen_gallery_path . '/kitchen-gallery-09.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $kitchen_gallery_path . '/kitchen-gallery-10.jpg" data-lightbox="kitchen-gallery" data-title="Kitchen Renovation" class="wow fadeIn"><img src="' . $kitchen_gallery_path . '/kitchen-gallery-10.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $kitchen_gallery_path . '/kitchen-gallery-11.jpg" data-lightbox="kitchen-gallery" data-title="Kitchen Renovation" class="wow fadeIn"><img src="' . $kitchen_gallery_path . '/kitchen-gallery-11.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $kitchen_gallery_path . '/kitchen-gallery-12.jpg" data-lightbox="kitchen-gallery" data-title="Kitchen Renovation" class="wow fadeIn"><img src="' . $kitchen_gallery_path . '/kitchen-gallery-12.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $kitchen_gallery_path . '/kitchen-gallery-13.jpg" data-lightbox="kitchen-gallery" data-title="Kitchen Renovation" class="wow fadeIn"><img src="' . $kitchen_gallery_path . '/kitchen-gallery-13.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $kitchen_gallery_path . '/kitchen-gallery-14.jpg" data-lightbox="kitchen-gallery" data-title="Kitchen Renovation" class="wow fadeIn"><img src="' . $kitchen_gallery_path . '/kitchen-gallery-14.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $kitchen_gallery_path . '/kitchen-gallery-15.jpg" data-lightbox="kitchen-gallery" data-title="Kitchen Renovation" class="wow fadeIn"><img src="' . $kitchen_gallery_path . '/kitchen-gallery-15.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $kitchen_gallery_path . '/kitchen-gallery-16.jpg" data-lightbox="kitchen-gallery" data-title="Kitchen Renovation" class="wow fadeIn"><img src="' . $kitchen_gallery_path . '/kitchen-gallery-16.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $kitchen_gallery_path . '/kitchen-gallery-17.jpg" data-lightbox="kitchen-gallery" data-title="Kitchen Renovation" class="wow fadeIn"><img src="' . $kitchen_gallery_path . '/kitchen-gallery-17.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $kitchen_gallery_path . '/kitchen-gallery-18.jpg" data-lightbox="kitchen-gallery" data-title="Kitchen Renovation" class="wow fadeIn"><img src="' . $kitchen_gallery_path . '/kitchen-gallery-18.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $kitchen_gallery_path . '/kitchen-gallery-19.jpg" data-lightbox="kitchen-gallery" data-title="Kitchen Renovation" class="wow fadeIn"><img src="' . $kitchen_gallery_path . '/kitchen-gallery-19.jpg" loading="lazy"></a>';

					$gallery_output .= '[/masonry]';

					echo do_shortcode( $gallery_output );
					?>
				</div>
			</div>
		</div>
	</section>

	<?php $kitchen_ba_path = get_stylesheet_directory_uri() . '/images/Interior/kitchen/before-and-after'; ?>

	<!-- =====================================================================
		 KITCHEN BEFORE & AFTER SECTIONS
		 ===================================================================== -->

	<!-- Canton Kitchen - Upstairs -->
	<section class="interior-section py-5">
		<div class="container">
			<div class="row mb-4">
				<div class="col-12">
					<h2>Canton - Upstairs Kitchen Renovation</h2>
				</div>
			</div>

			<div class="row g-4 mb-4">
				<div class="col-lg-6 col-md-6">
					<div class="pegasus-image-diff" id="canton-kitchen-up-1">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--before" src="<?php echo $kitchen_ba_path; ?>/canton-upstairs-kitchen-rocca-kozial/before-photos-upstairs/before-1.jpg" alt="Before">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--after" src="<?php echo $kitchen_ba_path; ?>/canton-upstairs-kitchen-rocca-kozial/after-photos-upstairs/after-1.jpg" alt="After">
						<div class="pegasus-image-diff__handle"></div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="pegasus-image-diff" id="canton-kitchen-up-2">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--before" src="<?php echo $kitchen_ba_path; ?>/canton-upstairs-kitchen-rocca-kozial/before-photos-upstairs/before-2.jpg" alt="Before">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--after" src="<?php echo $kitchen_ba_path; ?>/canton-upstairs-kitchen-rocca-kozial/after-photos-upstairs/after-2.jpg" alt="After">
						<div class="pegasus-image-diff__handle"></div>
					</div>
				</div>
			</div>
			<div class="row g-4 mb-4">
				<div class="col-lg-6 col-md-6">
					<div class="pegasus-image-diff" id="canton-kitchen-up-3">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--before" src="<?php echo $kitchen_ba_path; ?>/canton-upstairs-kitchen-rocca-kozial/before-photos-upstairs/before-3.jpg" alt="Before">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--after" src="<?php echo $kitchen_ba_path; ?>/canton-upstairs-kitchen-rocca-kozial/after-photos-upstairs/after-3.jpg" alt="After">
						<div class="pegasus-image-diff__handle"></div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="pegasus-image-diff" id="canton-kitchen-up-4">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--before" src="<?php echo $kitchen_ba_path; ?>/canton-upstairs-kitchen-rocca-kozial/before-photos-upstairs/before-4.jpg" alt="Before">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--after" src="<?php echo $kitchen_ba_path; ?>/canton-upstairs-kitchen-rocca-kozial/after-photos-upstairs/after-4.jpg" alt="After">
						<div class="pegasus-image-diff__handle"></div>
					</div>
				</div>
			</div>
			<div class="row g-4 mb-4">
				<div class="col-lg-6 col-md-6">
					<div class="pegasus-image-diff" id="canton-kitchen-up-5">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--before" src="<?php echo $kitchen_ba_path; ?>/canton-upstairs-kitchen-rocca-kozial/before-photos-upstairs/before-5.jpg" alt="Before">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--after" src="<?php echo $kitchen_ba_path; ?>/canton-upstairs-kitchen-rocca-kozial/after-photos-upstairs/after-5.jpg" alt="After">
						<div class="pegasus-image-diff__handle"></div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="pegasus-image-diff" id="canton-kitchen-up-6">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--before" src="<?php echo $kitchen_ba_path; ?>/canton-upstairs-kitchen-rocca-kozial/before-photos-upstairs/before-6.jpg" alt="Before">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--after" src="<?php echo $kitchen_ba_path; ?>/canton-upstairs-kitchen-rocca-kozial/after-photos-upstairs/after-6.jpg" alt="After">
						<div class="pegasus-image-diff__handle"></div>
					</div>
				</div>
			</div>
			<div class="row g-4 mb-4">
				<div class="col-lg-6 col-md-6">
					<div class="pegasus-image-diff" id="canton-kitchen-up-7">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--before" src="<?php echo $kitchen_ba_path; ?>/canton-upstairs-kitchen-rocca-kozial/before-photos-upstairs/before-7.jpg" alt="Before">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--after" src="<?php echo $kitchen_ba_path; ?>/canton-upstairs-kitchen-rocca-kozial/after-photos-upstairs/after-7.jpg" alt="After">
						<div class="pegasus-image-diff__handle"></div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Canton Kitchen - Basement -->
	<section class="interior-section py-5" style="background-color: #f5f5f5;">
		<div class="container">
			<div class="row mb-4">
				<div class="col-12">
					<h2>Canton - Basement Kitchen Renovation</h2>
				</div>
			</div>

			<div class="row g-4 mb-4">
				<div class="col-lg-6 col-md-6">
					<div class="pegasus-image-diff" id="canton-kitchen-bsmt-1">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--before" src="<?php echo $kitchen_ba_path; ?>/canton-upstairs-kitchen-rocca-kozial/before-photos-basement/before-1.jpg" alt="Before">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--after" src="<?php echo $kitchen_ba_path; ?>/canton-upstairs-kitchen-rocca-kozial/after-photos-basement/after-1.jpg" alt="After">
						<div class="pegasus-image-diff__handle"></div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="pegasus-image-diff" id="canton-kitchen-bsmt-2">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--before" src="<?php echo $kitchen_ba_path; ?>/canton-upstairs-kitchen-rocca-kozial/before-photos-basement/before-2.jpg" alt="Before">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--after" src="<?php echo $kitchen_ba_path; ?>/canton-upstairs-kitchen-rocca-kozial/after-photos-basement/after-2.jpg" alt="After">
						<div class="pegasus-image-diff__handle"></div>
					</div>
				</div>
			</div>
			<div class="row g-4 mb-4">
				<div class="col-lg-6 col-md-6">
					<div class="pegasus-image-diff" id="canton-kitchen-bsmt-3">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--before" src="<?php echo $kitchen_ba_path; ?>/canton-upstairs-kitchen-rocca-kozial/before-photos-basement/before-3.jpg" alt="Before">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--after" src="<?php echo $kitchen_ba_path; ?>/canton-upstairs-kitchen-rocca-kozial/after-photos-basement/after-3.jpg" alt="After">
						<div class="pegasus-image-diff__handle"></div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Woodstock Kitchen - JC & Jennifer -->
	<section class="interior-section py-5">
		<div class="container">
			<div class="row mb-4">
				<div class="col-12">
					<h2>Woodstock - Paint Cabinets, Glass Doors, New Fixtures & Countertops</h2>
				</div>
			</div>

			<div class="row g-4 mb-4">
				<div class="col-lg-6 col-md-6">
					<div class="pegasus-image-diff" id="woodstock-kitchen-1">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--before" src="<?php echo $kitchen_ba_path; ?>/woodstock-cabinets-countertops-jc-jennifer/before-1.jpg" alt="Before">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--after" src="<?php echo $kitchen_ba_path; ?>/woodstock-cabinets-countertops-jc-jennifer/after-photos/after-1.jpg" alt="After">
						<div class="pegasus-image-diff__handle"></div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="pegasus-image-diff" id="woodstock-kitchen-2">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--before" src="<?php echo $kitchen_ba_path; ?>/woodstock-cabinets-countertops-jc-jennifer/before-2.jpg" alt="Before">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--after" src="<?php echo $kitchen_ba_path; ?>/woodstock-cabinets-countertops-jc-jennifer/after-photos/after-2.jpg" alt="After">
						<div class="pegasus-image-diff__handle"></div>
					</div>
				</div>
			</div>
			<div class="row g-4 mb-4">
				<div class="col-lg-6 col-md-6">
					<div class="pegasus-image-diff" id="woodstock-kitchen-3">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--before" src="<?php echo $kitchen_ba_path; ?>/woodstock-cabinets-countertops-jc-jennifer/before-3.jpg" alt="Before">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--after" src="<?php echo $kitchen_ba_path; ?>/woodstock-cabinets-countertops-jc-jennifer/after-photos/after-3.jpg" alt="After">
						<div class="pegasus-image-diff__handle"></div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="pegasus-image-diff" id="woodstock-kitchen-4">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--before" src="<?php echo $kitchen_ba_path; ?>/woodstock-cabinets-countertops-jc-jennifer/before-4.jpg" alt="Before">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--after" src="<?php echo $kitchen_ba_path; ?>/woodstock-cabinets-countertops-jc-jennifer/after-photos/after-4.jpg" alt="After">
						<div class="pegasus-image-diff__handle"></div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php $bath_gallery_path = get_stylesheet_directory_uri() . '/images/Interior/bathroom/gallery-photos'; ?>

	<!-- =====================================================================
		 BATHROOM GALLERY PHOTOS
		 ===================================================================== -->
	<section class="interior-gallery-section py-5" >
		<div class="container">
			<div class="row mb-4">
				<div class="col-12">
					<h2 style="color: #222;">Bathroom Project Gallery</h2>
					<p style="color: var(--oak-muted);">Browse our collection of completed bathroom renovation projects.</p>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<?php
					$gallery_output = '[masonry]';

					$gallery_output .= '<a href="' . $bath_gallery_path . '/bathroom-gallery-01.jpg" data-lightbox="bathroom-gallery" data-title="Bathroom Renovation" class="wow fadeIn"><img src="' . $bath_gallery_path . '/bathroom-gallery-01.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $bath_gallery_path . '/bathroom-gallery-02.jpg" data-lightbox="bathroom-gallery" data-title="Bathroom Renovation" class="wow fadeIn"><img src="' . $bath_gallery_path . '/bathroom-gallery-02.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $bath_gallery_path . '/bathroom-gallery-03.jpg" data-lightbox="bathroom-gallery" data-title="Bathroom Renovation" class="wow fadeIn"><img src="' . $bath_gallery_path . '/bathroom-gallery-03.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $bath_gallery_path . '/bathroom-gallery-04.jpg" data-lightbox="bathroom-gallery" data-title="Bathroom Renovation" class="wow fadeIn"><img src="' . $bath_gallery_path . '/bathroom-gallery-04.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $bath_gallery_path . '/bathroom-gallery-05.jpg" data-lightbox="bathroom-gallery" data-title="Bathroom Renovation" class="wow fadeIn"><img src="' . $bath_gallery_path . '/bathroom-gallery-05.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $bath_gallery_path . '/bathroom-gallery-06.jpg" data-lightbox="bathroom-gallery" data-title="Bathroom Renovation" class="wow fadeIn"><img src="' . $bath_gallery_path . '/bathroom-gallery-06.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $bath_gallery_path . '/bathroom-gallery-07.jpg" data-lightbox="bathroom-gallery" data-title="Bathroom Renovation" class="wow fadeIn"><img src="' . $bath_gallery_path . '/bathroom-gallery-07.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $bath_gallery_path . '/bathroom-gallery-08.jpg" data-lightbox="bathroom-gallery" data-title="Bathroom Renovation" class="wow fadeIn"><img src="' . $bath_gallery_path . '/bathroom-gallery-08.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $bath_gallery_path . '/bathroom-gallery-09.jpg" data-lightbox="bathroom-gallery" data-title="Bathroom Renovation" class="wow fadeIn"><img src="' . $bath_gallery_path . '/bathroom-gallery-09.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $bath_gallery_path . '/bathroom-gallery-10.jpg" data-lightbox="bathroom-gallery" data-title="Bathroom Renovation" class="wow fadeIn"><img src="' . $bath_gallery_path . '/bathroom-gallery-10.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $bath_gallery_path . '/bathroom-gallery-11.jpg" data-lightbox="bathroom-gallery" data-title="Bathroom Renovation" class="wow fadeIn"><img src="' . $bath_gallery_path . '/bathroom-gallery-11.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $bath_gallery_path . '/bathroom-gallery-12.jpg" data-lightbox="bathroom-gallery" data-title="Bathroom Renovation" class="wow fadeIn"><img src="' . $bath_gallery_path . '/bathroom-gallery-12.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $bath_gallery_path . '/bathroom-gallery-13.jpg" data-lightbox="bathroom-gallery" data-title="Bathroom Renovation" class="wow fadeIn"><img src="' . $bath_gallery_path . '/bathroom-gallery-13.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $bath_gallery_path . '/bathroom-gallery-14.jpg" data-lightbox="bathroom-gallery" data-title="Bathroom Renovation" class="wow fadeIn"><img src="' . $bath_gallery_path . '/bathroom-gallery-14.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $bath_gallery_path . '/bathroom-gallery-15.jpg" data-lightbox="bathroom-gallery" data-title="Bathroom Renovation" class="wow fadeIn"><img src="' . $bath_gallery_path . '/bathroom-gallery-15.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $bath_gallery_path . '/bathroom-gallery-16.jpg" data-lightbox="bathroom-gallery" data-title="Bathroom Renovation" class="wow fadeIn"><img src="' . $bath_gallery_path . '/bathroom-gallery-16.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $bath_gallery_path . '/bathroom-gallery-17.jpg" data-lightbox="bathroom-gallery" data-title="Bathroom Renovation" class="wow fadeIn"><img src="' . $bath_gallery_path . '/bathroom-gallery-17.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $bath_gallery_path . '/bathroom-gallery-18.jpg" data-lightbox="bathroom-gallery" data-title="Bathroom Renovation" class="wow fadeIn"><img src="' . $bath_gallery_path . '/bathroom-gallery-18.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $bath_gallery_path . '/bathroom-gallery-19.jpg" data-lightbox="bathroom-gallery" data-title="Bathroom Renovation" class="wow fadeIn"><img src="' . $bath_gallery_path . '/bathroom-gallery-19.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $bath_gallery_path . '/bathroom-gallery-20.jpg" data-lightbox="bathroom-gallery" data-title="Bathroom Renovation" class="wow fadeIn"><img src="' . $bath_gallery_path . '/bathroom-gallery-20.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $bath_gallery_path . '/bathroom-gallery-21.jpg" data-lightbox="bathroom-gallery" data-title="Bathroom Renovation" class="wow fadeIn"><img src="' . $bath_gallery_path . '/bathroom-gallery-21.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $bath_gallery_path . '/bathroom-gallery-22.jpg" data-lightbox="bathroom-gallery" data-title="Bathroom Renovation" class="wow fadeIn"><img src="' . $bath_gallery_path . '/bathroom-gallery-22.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $bath_gallery_path . '/bathroom-gallery-23.jpg" data-lightbox="bathroom-gallery" data-title="Bathroom Renovation" class="wow fadeIn"><img src="' . $bath_gallery_path . '/bathroom-gallery-23.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $bath_gallery_path . '/bathroom-gallery-24.jpg" data-lightbox="bathroom-gallery" data-title="Bathroom Renovation" class="wow fadeIn"><img src="' . $bath_gallery_path . '/bathroom-gallery-24.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $bath_gallery_path . '/bathroom-gallery-25.jpg" data-lightbox="bathroom-gallery" data-title="Bathroom Renovation" class="wow fadeIn"><img src="' . $bath_gallery_path . '/bathroom-gallery-25.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $bath_gallery_path . '/bathroom-gallery-26.jpg" data-lightbox="bathroom-gallery" data-title="Bathroom Renovation" class="wow fadeIn"><img src="' . $bath_gallery_path . '/bathroom-gallery-26.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $bath_gallery_path . '/bathroom-gallery-27.jpg" data-lightbox="bathroom-gallery" data-title="Bathroom Renovation" class="wow fadeIn"><img src="' . $bath_gallery_path . '/bathroom-gallery-27.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $bath_gallery_path . '/bathroom-gallery-28.jpg" data-lightbox="bathroom-gallery" data-title="Bathroom Renovation" class="wow fadeIn"><img src="' . $bath_gallery_path . '/bathroom-gallery-28.jpg" loading="lazy"></a>';

					$gallery_output .= '[/masonry]';

					echo do_shortcode( $gallery_output );
					?>
				</div>
			</div>
		</div>
	</section>

	<?php $bath_ba_path = get_stylesheet_directory_uri() . '/images/Interior/bathroom/before-and-after'; ?>

	<!-- =====================================================================
		 BATHROOM BEFORE & AFTER SECTIONS
		 ===================================================================== -->

	<!-- Alpharetta - Clayborn Bathroom -->
	<section class="interior-section py-5">
		<div class="container">
			<div class="row mb-4">
				<div class="col-12">
					<h2>Alpharetta - Bathroom Renovation</h2>
				</div>
			</div>

			<div class="row g-4 mb-4">
				<div class="col-lg-6 col-md-6">
					<div class="pegasus-image-diff" id="alpharetta-bath-1">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--before" src="<?php echo $bath_ba_path; ?>/alpharetta-clayborn/before-1.jpg" alt="Before">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--after" src="<?php echo $bath_ba_path; ?>/alpharetta-clayborn/after-1.jpg" alt="After">
						<div class="pegasus-image-diff__handle"></div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Atlanta - Secondary Bathroom -->
	<section class="interior-section py-5" style="background-color: #f5f5f5;">
		<div class="container">
			<div class="row mb-4">
				<div class="col-12">
					<h2>Atlanta - Secondary Bathroom Renovation</h2>
				</div>
			</div>

			<div class="row g-4 mb-4">
				<div class="col-lg-6 col-md-6">
					<div class="pegasus-image-diff" id="atlanta-bath-1">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--before" src="<?php echo $bath_ba_path; ?>/atlanta-secondary-bath/before-1.jpg" alt="Before">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--after" src="<?php echo $bath_ba_path; ?>/atlanta-secondary-bath/after-1.jpg" alt="After">
						<div class="pegasus-image-diff__handle"></div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Canton - Secondary Bathroom -->
	<section class="interior-section py-5">
		<div class="container">
			<div class="row mb-4">
				<div class="col-12">
					<h2>Canton - Secondary Bathroom Renovation</h2>
				</div>
			</div>

			<div class="row g-4 mb-4">
				<div class="col-lg-6 col-md-6">
					<div class="pegasus-image-diff" id="canton-bath-1">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--before" src="<?php echo $bath_ba_path; ?>/canton-secondary-bath/before-1.jpg" alt="Before">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--after" src="<?php echo $bath_ba_path; ?>/canton-secondary-bath/after-1.jpg" alt="After">
						<div class="pegasus-image-diff__handle"></div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="pegasus-image-diff" id="canton-bath-2">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--before" src="<?php echo $bath_ba_path; ?>/canton-secondary-bath/before-2.jpg" alt="Before">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--after" src="<?php echo $bath_ba_path; ?>/canton-secondary-bath/after-2.jpg" alt="After">
						<div class="pegasus-image-diff__handle"></div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Marietta - Bathroom Expansion -->
	<section class="interior-section py-5" style="background-color: #f5f5f5;">
		<div class="container">
			<div class="row mb-4">
				<div class="col-12">
					<h2>Marietta - Bathroom Expansion & Update</h2>
				</div>
			</div>

			<div class="row g-4 mb-4">
				<div class="col-lg-6 col-md-6">
					<div class="pegasus-image-diff" id="marietta-bath-exp-1">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--before" src="<?php echo $bath_ba_path; ?>/marietta-bath-expansion/before-1.jpg" alt="Before">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--after" src="<?php echo $bath_ba_path; ?>/marietta-bath-expansion/after-1.jpg" alt="After">
						<div class="pegasus-image-diff__handle"></div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Marietta - Master Bath -->
	<section class="interior-section py-5">
		<div class="container">
			<div class="row mb-4">
				<div class="col-12">
					<h2>Marietta - Master Bathroom Renovation</h2>
				</div>
			</div>

			<div class="row g-4 mb-4">
				<div class="col-lg-6 col-md-6">
					<div class="pegasus-image-diff" id="marietta-master-bath-1">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--before" src="<?php echo $bath_ba_path; ?>/marietta-master-bath/before-1.jpg" alt="Before">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--after" src="<?php echo $bath_ba_path; ?>/marietta-master-bath/after-1.jpg" alt="After">
						<div class="pegasus-image-diff__handle"></div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Roswell - Master Bath (Bishop) -->
	<section class="interior-section py-5" style="background-color: #f5f5f5;">
		<div class="container">
			<div class="row mb-4">
				<div class="col-12">
					<h2>Roswell - Master Bathroom Renovation</h2>
				</div>
			</div>

			<div class="row g-4 mb-4">
				<div class="col-lg-6 col-md-6">
					<div class="pegasus-image-diff" id="roswell-master-bath-1">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--before" src="<?php echo $bath_ba_path; ?>/roswell-master-bath-bishop/before-1.jpg" alt="Before">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--after" src="<?php echo $bath_ba_path; ?>/roswell-master-bath-bishop/after-1.jpg" alt="After">
						<div class="pegasus-image-diff__handle"></div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="pegasus-image-diff" id="roswell-master-bath-2">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--before" src="<?php echo $bath_ba_path; ?>/roswell-master-bath-bishop/before-2.jpg" alt="Before">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--after" src="<?php echo $bath_ba_path; ?>/roswell-master-bath-bishop/after-2.jpg" alt="After">
						<div class="pegasus-image-diff__handle"></div>
					</div>
				</div>
			</div>
			<div class="row g-4 mb-4">
				<div class="col-lg-6 col-md-6">
					<div class="pegasus-image-diff" id="roswell-master-bath-3">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--before" src="<?php echo $bath_ba_path; ?>/roswell-master-bath-bishop/before-3.jpg" alt="Before">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--after" src="<?php echo $bath_ba_path; ?>/roswell-master-bath-bishop/after-3.jpg" alt="After">
						<div class="pegasus-image-diff__handle"></div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Roswell - Secondary Bath (McCurry) - Before & Design Renders -->
	<section class="interior-section py-5">
		<div class="container">
			<div class="row mb-4">
				<div class="col-12">
					<h2>Roswell - Secondary Bathroom Update</h2>
				</div>
			</div>

			<div class="row g-4 mb-4">
				<div class="col-lg-6 col-md-6">
					<div class="pegasus-image-diff" id="roswell-mccurry-bath-1">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--before" src="<?php echo $bath_ba_path; ?>/roswell-secondary-bath-mccurry/before-1.jpg" alt="Before">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--after" src="<?php echo $bath_ba_path; ?>/roswell-secondary-bath-mccurry/render-1.png" alt="Design Render">
						<div class="pegasus-image-diff__handle"></div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="pegasus-image-diff" id="roswell-mccurry-bath-2">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--before" src="<?php echo $bath_ba_path; ?>/roswell-secondary-bath-mccurry/before-2.jpg" alt="Before">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--after" src="<?php echo $bath_ba_path; ?>/roswell-secondary-bath-mccurry/render-2.png" alt="Design Render">
						<div class="pegasus-image-diff__handle"></div>
					</div>
				</div>
			</div>
			<div class="row g-4 mb-4">
				<div class="col-lg-6 col-md-6">
					<div class="pegasus-image-diff" id="roswell-mccurry-bath-3">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--before" src="<?php echo $bath_ba_path; ?>/roswell-secondary-bath-mccurry/before-3.jpg" alt="Before">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--after" src="<?php echo $bath_ba_path; ?>/roswell-secondary-bath-mccurry/render-3.png" alt="Design Render">
						<div class="pegasus-image-diff__handle"></div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Roswell - Secondary Bath (Ottoson) -->
	<section class="interior-section py-5" style="background-color: #f5f5f5;">
		<div class="container">
			<div class="row mb-4">
				<div class="col-12">
					<h2>Roswell - Secondary Bathroom Renovation</h2>
				</div>
			</div>

			<div class="row g-4 mb-4">
				<div class="col-lg-6 col-md-6">
					<div class="pegasus-image-diff" id="roswell-ottoson-bath-1">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--before" src="<?php echo $bath_ba_path; ?>/roswell-secondary-bath-ottoson/before-1.jpg" alt="Before">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--after" src="<?php echo $bath_ba_path; ?>/roswell-secondary-bath-ottoson/after-1.jpg" alt="After">
						<div class="pegasus-image-diff__handle"></div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="pegasus-image-diff" id="roswell-ottoson-bath-2">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--before" src="<?php echo $bath_ba_path; ?>/roswell-secondary-bath-ottoson/before-2.jpg" alt="Before">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--after" src="<?php echo $bath_ba_path; ?>/roswell-secondary-bath-ottoson/after-2.jpg" alt="After">
						<div class="pegasus-image-diff__handle"></div>
					</div>
				</div>
			</div>
			<div class="row g-4 mb-4">
				<div class="col-lg-6 col-md-6">
					<div class="pegasus-image-diff" id="roswell-ottoson-bath-3">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--before" src="<?php echo $bath_ba_path; ?>/roswell-secondary-bath-ottoson/before-3.png" alt="Before">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--after" src="<?php echo $bath_ba_path; ?>/roswell-secondary-bath-ottoson/after-3.jpg" alt="After">
						<div class="pegasus-image-diff__handle"></div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- =====================================================================
		 GENERAL INTERIOR GALLERY
		 ===================================================================== -->
		 <section class="interior-gallery-section py-5">
		<div class="container">
			<div class="row mb-4">
				<div class="col-12">
					<h2>General Interior Project Gallery</h2>
					<p>Browse our collection of completed interior renovation projects including built-ins, closet expansions, basement finishes, and more.</p>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<?php
					$gallery_output = '[masonry]';

					$gallery_output .= '<a href="' . $general_img_path . '/general-interior-01.jpg" data-lightbox="general-interior-gallery" data-title="Interior Renovation" class="wow fadeIn"><img src="' . $general_img_path . '/general-interior-01.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $general_img_path . '/general-interior-02.jpg" data-lightbox="general-interior-gallery" data-title="Interior Renovation" class="wow fadeIn"><img src="' . $general_img_path . '/general-interior-02.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $general_img_path . '/general-interior-03.jpg" data-lightbox="general-interior-gallery" data-title="Interior Renovation" class="wow fadeIn"><img src="' . $general_img_path . '/general-interior-03.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $general_img_path . '/general-interior-04.jpg" data-lightbox="general-interior-gallery" data-title="Interior Renovation" class="wow fadeIn"><img src="' . $general_img_path . '/general-interior-04.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $general_img_path . '/general-interior-05.jpg" data-lightbox="general-interior-gallery" data-title="Interior Renovation" class="wow fadeIn"><img src="' . $general_img_path . '/general-interior-05.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $general_img_path . '/general-interior-06.jpg" data-lightbox="general-interior-gallery" data-title="Interior Renovation" class="wow fadeIn"><img src="' . $general_img_path . '/general-interior-06.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $general_img_path . '/general-interior-07.jpg" data-lightbox="general-interior-gallery" data-title="Interior Renovation" class="wow fadeIn"><img src="' . $general_img_path . '/general-interior-07.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $general_img_path . '/general-interior-08.jpg" data-lightbox="general-interior-gallery" data-title="Interior Renovation" class="wow fadeIn"><img src="' . $general_img_path . '/general-interior-08.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $general_img_path . '/general-interior-09.jpg" data-lightbox="general-interior-gallery" data-title="Interior Renovation" class="wow fadeIn"><img src="' . $general_img_path . '/general-interior-09.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $general_img_path . '/general-interior-10.png" data-lightbox="general-interior-gallery" data-title="Interior Renovation" class="wow fadeIn"><img src="' . $general_img_path . '/general-interior-10.png" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $general_img_path . '/general-interior-11.jpg" data-lightbox="general-interior-gallery" data-title="Interior Renovation" class="wow fadeIn"><img src="' . $general_img_path . '/general-interior-11.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $general_img_path . '/general-interior-12.jpg" data-lightbox="general-interior-gallery" data-title="Interior Renovation" class="wow fadeIn"><img src="' . $general_img_path . '/general-interior-12.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $general_img_path . '/general-interior-13.jpg" data-lightbox="general-interior-gallery" data-title="Interior Renovation" class="wow fadeIn"><img src="' . $general_img_path . '/general-interior-13.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $general_img_path . '/general-interior-14.jpg" data-lightbox="general-interior-gallery" data-title="Interior Renovation" class="wow fadeIn"><img src="' . $general_img_path . '/general-interior-14.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $general_img_path . '/basement-before-kennesaw.jpg" data-lightbox="general-interior-gallery" data-title="Basement Before - Kennesaw" class="wow fadeIn"><img src="' . $general_img_path . '/basement-before-kennesaw.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $general_img_path . '/basement-after-kennesaw.jpg" data-lightbox="general-interior-gallery" data-title="Basement After - Kennesaw" class="wow fadeIn"><img src="' . $general_img_path . '/basement-after-kennesaw.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $general_img_path . '/basement-after-woodstock.jpg" data-lightbox="general-interior-gallery" data-title="Basement After - Woodstock" class="wow fadeIn"><img src="' . $general_img_path . '/basement-after-woodstock.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $general_img_path . '/built-ins/built-ins-01.jpg" data-lightbox="general-interior-gallery" data-title="Custom Built-In Cabinetry" class="wow fadeIn"><img src="' . $general_img_path . '/built-ins/built-ins-01.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $general_img_path . '/built-ins/built-ins-02.jpg" data-lightbox="general-interior-gallery" data-title="Custom Built-In Cabinetry" class="wow fadeIn"><img src="' . $general_img_path . '/built-ins/built-ins-02.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $general_img_path . '/built-ins/built-ins-03.jpg" data-lightbox="general-interior-gallery" data-title="Custom Built-In Cabinetry" class="wow fadeIn"><img src="' . $general_img_path . '/built-ins/built-ins-03.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $general_img_path . '/built-ins/built-ins-04.jpg" data-lightbox="general-interior-gallery" data-title="Custom Built-In Cabinetry" class="wow fadeIn"><img src="' . $general_img_path . '/built-ins/built-ins-04.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $general_img_path . '/built-ins/built-ins-05.jpg" data-lightbox="general-interior-gallery" data-title="Custom Built-In Cabinetry" class="wow fadeIn"><img src="' . $general_img_path . '/built-ins/built-ins-05.jpg" loading="lazy"></a>';

					/*$gallery_output .= '<a href="' . $general_img_path . '/closet-expansion/closet-expansion-01.jpg" data-lightbox="general-interior-gallery" data-title="Closet Expansion" class="wow fadeIn"><img src="' . $general_img_path . '/closet-expansion/closet-expansion-01.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $general_img_path . '/closet-expansion/closet-expansion-02.jpg" data-lightbox="general-interior-gallery" data-title="Closet Expansion" class="wow fadeIn"><img src="' . $general_img_path . '/closet-expansion/closet-expansion-02.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $general_img_path . '/closet-expansion/closet-expansion-03.jpg" data-lightbox="general-interior-gallery" data-title="Closet Expansion" class="wow fadeIn"><img src="' . $general_img_path . '/closet-expansion/closet-expansion-03.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $general_img_path . '/closet-expansion/closet-expansion-04.jpg" data-lightbox="general-interior-gallery" data-title="Closet Expansion" class="wow fadeIn"><img src="' . $general_img_path . '/closet-expansion/closet-expansion-04.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $general_img_path . '/closet-expansion/closet-expansion-05.jpg" data-lightbox="general-interior-gallery" data-title="Closet Expansion" class="wow fadeIn"><img src="' . $general_img_path . '/closet-expansion/closet-expansion-05.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $general_img_path . '/closet-expansion/closet-expansion-06.jpg" data-lightbox="general-interior-gallery" data-title="Closet Expansion" class="wow fadeIn"><img src="' . $general_img_path . '/closet-expansion/closet-expansion-06.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $general_img_path . '/closet-expansion/closet-expansion-07.jpg" data-lightbox="general-interior-gallery" data-title="Closet Expansion" class="wow fadeIn"><img src="' . $general_img_path . '/closet-expansion/closet-expansion-07.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $general_img_path . '/closet-expansion/closet-expansion-08.jpg" data-lightbox="general-interior-gallery" data-title="Closet Expansion" class="wow fadeIn"><img src="' . $general_img_path . '/closet-expansion/closet-expansion-08.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $general_img_path . '/closet-expansion/closet-expansion-09.jpg" data-lightbox="general-interior-gallery" data-title="Closet Expansion" class="wow fadeIn"><img src="' . $general_img_path . '/closet-expansion/closet-expansion-09.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $general_img_path . '/closet-expansion/closet-expansion-10.jpg" data-lightbox="general-interior-gallery" data-title="Closet Expansion" class="wow fadeIn"><img src="' . $general_img_path . '/closet-expansion/closet-expansion-10.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $general_img_path . '/closet-expansion/closet-expansion-11.jpg" data-lightbox="general-interior-gallery" data-title="Closet Expansion" class="wow fadeIn"><img src="' . $general_img_path . '/closet-expansion/closet-expansion-11.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $general_img_path . '/closet-expansion/closet-expansion-12.jpg" data-lightbox="general-interior-gallery" data-title="Closet Expansion" class="wow fadeIn"><img src="' . $general_img_path . '/closet-expansion/closet-expansion-12.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $general_img_path . '/closet-expansion/closet-expansion-13.jpg" data-lightbox="general-interior-gallery" data-title="Closet Expansion" class="wow fadeIn"><img src="' . $general_img_path . '/closet-expansion/closet-expansion-13.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $general_img_path . '/closet-expansion/closet-expansion-14.jpg" data-lightbox="general-interior-gallery" data-title="Closet Expansion" class="wow fadeIn"><img src="' . $general_img_path . '/closet-expansion/closet-expansion-14.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $general_img_path . '/closet-expansion/closet-expansion-15.jpg" data-lightbox="general-interior-gallery" data-title="Closet Expansion" class="wow fadeIn"><img src="' . $general_img_path . '/closet-expansion/closet-expansion-15.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $general_img_path . '/closet-expansion/closet-expansion-16.jpg" data-lightbox="general-interior-gallery" data-title="Closet Expansion" class="wow fadeIn"><img src="' . $general_img_path . '/closet-expansion/closet-expansion-16.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $general_img_path . '/closet-expansion/closet-expansion-17.jpg" data-lightbox="general-interior-gallery" data-title="Closet Expansion" class="wow fadeIn"><img src="' . $general_img_path . '/closet-expansion/closet-expansion-17.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $general_img_path . '/closet-expansion/closet-expansion-18.jpg" data-lightbox="general-interior-gallery" data-title="Closet Expansion" class="wow fadeIn"><img src="' . $general_img_path . '/closet-expansion/closet-expansion-18.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $general_img_path . '/closet-expansion/closet-expansion-19.jpg" data-lightbox="general-interior-gallery" data-title="Closet Expansion" class="wow fadeIn"><img src="' . $general_img_path . '/closet-expansion/closet-expansion-19.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $general_img_path . '/closet-expansion/closet-expansion-20.jpg" data-lightbox="general-interior-gallery" data-title="Closet Expansion" class="wow fadeIn"><img src="' . $general_img_path . '/closet-expansion/closet-expansion-20.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $general_img_path . '/closet-expansion/closet-expansion-21.jpg" data-lightbox="general-interior-gallery" data-title="Closet Expansion" class="wow fadeIn"><img src="' . $general_img_path . '/closet-expansion/closet-expansion-21.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $general_img_path . '/closet-expansion/closet-expansion-22.jpg" data-lightbox="general-interior-gallery" data-title="Closet Expansion" class="wow fadeIn"><img src="' . $general_img_path . '/closet-expansion/closet-expansion-22.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $general_img_path . '/closet-expansion/closet-expansion-23.jpg" data-lightbox="general-interior-gallery" data-title="Closet Expansion" class="wow fadeIn"><img src="' . $general_img_path . '/closet-expansion/closet-expansion-23.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $general_img_path . '/closet-expansion/closet-expansion-24.jpg" data-lightbox="general-interior-gallery" data-title="Closet Expansion" class="wow fadeIn"><img src="' . $general_img_path . '/closet-expansion/closet-expansion-24.jpg" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $general_img_path . '/closet-expansion/closet-expansion-render-01.png" data-lightbox="general-interior-gallery" data-title="Closet Expansion Design Render" class="wow fadeIn"><img src="' . $general_img_path . '/closet-expansion/closet-expansion-render-01.png" loading="lazy"></a>';

					$gallery_output .= '<a href="' . $general_img_path . '/closet-expansion/closet-expansion-render-02.png" data-lightbox="general-interior-gallery" data-title="Closet Expansion Design Render" class="wow fadeIn"><img src="' . $general_img_path . '/closet-expansion/closet-expansion-render-02.png" loading="lazy"></a>';
*/
					$gallery_output .= '[/masonry]';

					echo do_shortcode( $gallery_output );
					?>
				</div>
			</div>
		</div>
	</section>

</div><!-- end page wrap -->

<?php get_footer(); ?>
