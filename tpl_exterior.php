<?php

/*
Template Name: Exterior Template
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

	<?php $gallery_img_path = get_stylesheet_directory_uri() . '/images/Exterior/gallery-photos'; ?>

	<!-- Exterior Gallery Section -->
	<section class="exterior-gallery-section py-5">
		<div class="container">
			<div class="row mb-4">
				<div class="col-12">
					<h2>Exterior Project Gallery</h2>
					<p>Browse our collection of completed exterior renovation projects including decks, porches, siding, and outdoor living spaces.</p>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<?php
					$gallery_output = '[masonry]';

					$gallery_output .= '<a href="' . $gallery_img_path . '/cabin-multi-level-deck-twilight.jpg" data-lightbox="exterior-gallery" data-title="Mountain Cabin Multi-Level Deck at Twilight" class="wow fadeIn"><img src="' . $gallery_img_path . '/cabin-multi-level-deck-twilight.jpg" loading="lazy" class=""></a>';

					$gallery_output .= '<a href="' . $gallery_img_path . '/cabin-aerial-deck-hot-tub.jpg" data-lightbox="exterior-gallery" data-title="Cabin Aerial View with Deck and Hot Tub" class="wow fadeIn"><img src="' . $gallery_img_path . '/cabin-aerial-deck-hot-tub.jpg" loading="lazy" class=""></a>';

					$gallery_output .= '<a href="' . $gallery_img_path . '/cabin-front-porch-sunset.jpg" data-lightbox="exterior-gallery" data-title="Cabin Front Porch at Sunset" class="wow fadeIn"><img src="' . $gallery_img_path . '/cabin-front-porch-sunset.jpg" loading="lazy" class=""></a>';

					$gallery_output .= '<a href="' . $gallery_img_path . '/cabin-aerial-multi-deck-evening.jpg" data-lightbox="exterior-gallery" data-title="Cabin Aerial Multi-Deck Evening View" class="wow fadeIn"><img src="' . $gallery_img_path . '/cabin-aerial-multi-deck-evening.jpg" loading="lazy" class=""></a>';

					$gallery_output .= '<a href="' . $gallery_img_path . '/fire-pit-area-string-lights.jpg" data-lightbox="exterior-gallery" data-title="Fire Pit Area with String Lights" class="wow fadeIn"><img src="' . $gallery_img_path . '/fire-pit-area-string-lights.jpg" loading="lazy" class=""></a>';

					$gallery_output .= '<a href="' . $gallery_img_path . '/fire-pit-adirondack-chairs.jpg" data-lightbox="exterior-gallery" data-title="Fire Pit with Adirondack Chairs" class="wow fadeIn"><img src="' . $gallery_img_path . '/fire-pit-adirondack-chairs.jpg" loading="lazy" class=""></a>';

					$gallery_output .= '<a href="' . $gallery_img_path . '/screened-porch-sectional-sofa.jpg" data-lightbox="exterior-gallery" data-title="Screened Porch with Sectional Sofa" class="wow fadeIn"><img src="' . $gallery_img_path . '/screened-porch-sectional-sofa.jpg" loading="lazy" class=""></a>';

					$gallery_output .= '<a href="' . $gallery_img_path . '/traditional-home-front-double-garage.jpg" data-lightbox="exterior-gallery" data-title="Traditional Home Front with Double Garage" class="wow fadeIn"><img src="' . $gallery_img_path . '/traditional-home-front-double-garage.jpg" loading="lazy" class=""></a>';

					$gallery_output .= '<a href="' . $gallery_img_path . '/home-side-siding-fence.jpg" data-lightbox="exterior-gallery" data-title="Home Side View with New Siding and Fence" class="wow fadeIn"><img src="' . $gallery_img_path . '/home-side-siding-fence.jpg" loading="lazy" class=""></a>';

					$gallery_output .= '<a href="' . $gallery_img_path . '/side-yard-walkway-stone-landscaping.jpg" data-lightbox="exterior-gallery" data-title="Side Yard Walkway with Stone Landscaping" class="wow fadeIn"><img src="' . $gallery_img_path . '/side-yard-walkway-stone-landscaping.jpg" loading="lazy" class=""></a>';

					$gallery_output .= '<a href="' . $gallery_img_path . '/backyard-screened-porch-stairs.jpg" data-lightbox="exterior-gallery" data-title="Backyard with Screened Porch and Stairs" class="wow fadeIn"><img src="' . $gallery_img_path . '/backyard-screened-porch-stairs.jpg" loading="lazy" class=""></a>';

					$gallery_output .= '<a href="' . $gallery_img_path . '/cabin-putting-green-deck.jpg" data-lightbox="exterior-gallery" data-title="Cabin with Putting Green and Deck" class="wow fadeIn"><img src="' . $gallery_img_path . '/cabin-putting-green-deck.jpg" loading="lazy" class=""></a>';

					$gallery_output .= '<a href="' . $gallery_img_path . '/backyard-patio-covered-deck.jpg" data-lightbox="exterior-gallery" data-title="Backyard Patio with Covered Deck" class="wow fadeIn"><img src="' . $gallery_img_path . '/backyard-patio-covered-deck.jpg" loading="lazy" class=""></a>';

					$gallery_output .= '<a href="' . $gallery_img_path . '/covered-deck-stone-fireplace-twilight.jpg" data-lightbox="exterior-gallery" data-title="Covered Deck with Stone Fireplace at Twilight" class="wow fadeIn"><img src="' . $gallery_img_path . '/covered-deck-stone-fireplace-twilight.jpg" loading="lazy" class=""></a>';

					$gallery_output .= '<a href="' . $gallery_img_path . '/cabin-deck-bar-neon-sign.jpg" data-lightbox="exterior-gallery" data-title="Cabin Deck Bar with Neon Sign" class="wow fadeIn"><img src="' . $gallery_img_path . '/cabin-deck-bar-neon-sign.jpg" loading="lazy" class=""></a>';

					$gallery_output .= '<a href="' . $gallery_img_path . '/cabin-deck-bar-neon-wolf.jpg" data-lightbox="exterior-gallery" data-title="Cabin Deck Bar with Neon Wolf Sign" class="wow fadeIn"><img src="' . $gallery_img_path . '/cabin-deck-bar-neon-wolf.jpg" loading="lazy" class=""></a>';

					$gallery_output .= '<a href="' . $gallery_img_path . '/gray-siding-home-aerial-rear.jpg" data-lightbox="exterior-gallery" data-title="Gray Siding Home Aerial Rear View" class="wow fadeIn"><img src="' . $gallery_img_path . '/gray-siding-home-aerial-rear.jpg" loading="lazy" class=""></a>';

					$gallery_output .= '<a href="' . $gallery_img_path . '/gray-siding-home-aerial-side.jpg" data-lightbox="exterior-gallery" data-title="Gray Siding Home Aerial Side View" class="wow fadeIn"><img src="' . $gallery_img_path . '/gray-siding-home-aerial-side.jpg" loading="lazy" class=""></a>';

					$gallery_output .= '<a href="' . $gallery_img_path . '/blue-colonial-home-front-aerial.jpg" data-lightbox="exterior-gallery" data-title="Blue Colonial Home Front Aerial" class="wow fadeIn"><img src="' . $gallery_img_path . '/blue-colonial-home-front-aerial.jpg" loading="lazy" class=""></a>';

					$gallery_output .= '<a href="' . $gallery_img_path . '/blue-colonial-home-front.jpg" data-lightbox="exterior-gallery" data-title="Blue Colonial Home Front View" class="wow fadeIn"><img src="' . $gallery_img_path . '/blue-colonial-home-front.jpg" loading="lazy" class=""></a>';

					$gallery_output .= '<a href="' . $gallery_img_path . '/gray-siding-home-side-bay-window.jpg" data-lightbox="exterior-gallery" data-title="Gray Siding Home Side with Bay Window" class="wow fadeIn"><img src="' . $gallery_img_path . '/gray-siding-home-side-bay-window.jpg" loading="lazy" class=""></a>';

					$gallery_output .= '<a href="' . $gallery_img_path . '/green-siding-home-portico-entrance.jpg" data-lightbox="exterior-gallery" data-title="Green Siding Home with Portico Entrance" class="wow fadeIn"><img src="' . $gallery_img_path . '/green-siding-home-portico-entrance.jpg" loading="lazy" class=""></a>';

					$gallery_output .= '<a href="' . $gallery_img_path . '/epoxy-floor-patio-reflective.jpg" data-lightbox="exterior-gallery" data-title="Epoxy Floor Patio with Reflective Finish" class="wow fadeIn"><img src="' . $gallery_img_path . '/epoxy-floor-patio-reflective.jpg" loading="lazy" class=""></a>';

					$gallery_output .= '<a href="' . $gallery_img_path . '/gray-siding-home-double-garage.jpg" data-lightbox="exterior-gallery" data-title="Gray Siding Home with Double Garage" class="wow fadeIn"><img src="' . $gallery_img_path . '/gray-siding-home-double-garage.jpg" loading="lazy" class=""></a>';

					$gallery_output .= '<a href="' . $gallery_img_path . '/white-colonial-home-front-porch.jpg" data-lightbox="exterior-gallery" data-title="White Colonial Home with Front Porch" class="wow fadeIn"><img src="' . $gallery_img_path . '/white-colonial-home-front-porch.jpg" loading="lazy" class=""></a>';

					$gallery_output .= '<a href="' . $gallery_img_path . '/covered-porch-stone-veneer-flag.jpg" data-lightbox="exterior-gallery" data-title="Covered Porch with Stone Veneer" class="wow fadeIn"><img src="' . $gallery_img_path . '/covered-porch-stone-veneer-flag.jpg" loading="lazy" class=""></a>';

					$gallery_output .= '<a href="' . $gallery_img_path . '/covered-porch-stone-veneer-side.jpg" data-lightbox="exterior-gallery" data-title="Covered Porch Stone Veneer Side View" class="wow fadeIn"><img src="' . $gallery_img_path . '/covered-porch-stone-veneer-side.jpg" loading="lazy" class=""></a>';

					$gallery_output .= '<a href="' . $gallery_img_path . '/white-home-paver-patio-deck.jpg" data-lightbox="exterior-gallery" data-title="White Home with Paver Patio and Deck" class="wow fadeIn"><img src="' . $gallery_img_path . '/white-home-paver-patio-deck.jpg" loading="lazy" class=""></a>';

					$gallery_output .= '<a href="' . $gallery_img_path . '/white-home-backyard-fire-pit.jpg" data-lightbox="exterior-gallery" data-title="White Home Backyard with Fire Pit" class="wow fadeIn"><img src="' . $gallery_img_path . '/white-home-backyard-fire-pit.jpg" loading="lazy" class=""></a>';

					$gallery_output .= '<a href="' . $gallery_img_path . '/covered-patio-outdoor-furniture.jpg" data-lightbox="exterior-gallery" data-title="Covered Patio with Outdoor Furniture" class="wow fadeIn"><img src="' . $gallery_img_path . '/covered-patio-outdoor-furniture.jpg" loading="lazy" class=""></a>';

					$gallery_output .= '<a href="' . $gallery_img_path . '/covered-patio-bar-seating.jpg" data-lightbox="exterior-gallery" data-title="Covered Patio with Bar Seating" class="wow fadeIn"><img src="' . $gallery_img_path . '/covered-patio-bar-seating.jpg" loading="lazy" class=""></a>';

					$gallery_output .= '<a href="' . $gallery_img_path . '/covered-patio-aerial-furniture.jpg" data-lightbox="exterior-gallery" data-title="Covered Patio Aerial View with Furniture" class="wow fadeIn"><img src="' . $gallery_img_path . '/covered-patio-aerial-furniture.jpg" loading="lazy" class=""></a>';

					$gallery_output .= '<a href="' . $gallery_img_path . '/two-story-screened-porch.jpg" data-lightbox="exterior-gallery" data-title="Two-Story Screened Porch Addition" class="wow fadeIn"><img src="' . $gallery_img_path . '/two-story-screened-porch.jpg" loading="lazy" class=""></a>';

					$gallery_output .= '[/masonry]';

					echo do_shortcode( $gallery_output );
					?>
				</div>
			</div>
		</div>
	</section>

	<?php $theme_img_path = get_stylesheet_directory_uri() . '/images/Exterior/before-and-after'; ?>

	<!-- Blue Ridge Retaining Wall Section -->
	<section class="exterior-section py-5" style="background-color: #f5f5f5;">
		<div class="container" >
			<div class="row mb-4">
				<div class="col-12">
					<h2>Blue Ridge - Retaining Wall, Fire Pit, Stairs, Decking, Siding & Paint</h2>
				</div>
			</div>

			<div class="row g-4 mb-4" >
				<div class="col-lg-6 col-md-6">
					<div class="pegasus-image-diff" id="blue-ridge-1">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--before" src="<?php echo $theme_img_path; ?>/blue-ridge-retaining-wall/before-1.jpg" alt="Before">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--after" src="<?php echo $theme_img_path; ?>/blue-ridge-retaining-wall/after-1.jpg" alt="After">
						<div class="pegasus-image-diff__handle"></div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="pegasus-image-diff" id="blue-ridge-2">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--before" src="<?php echo $theme_img_path; ?>/blue-ridge-retaining-wall/before-2.jpg" alt="Before">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--after" src="<?php echo $theme_img_path; ?>/blue-ridge-retaining-wall/after-2.jpg" alt="After">
						<div class="pegasus-image-diff__handle"></div>
					</div>
				</div>
			</div>
			<div class="row g-4 mb-4">
				<div class="col-lg-6 col-md-6">
					<div class="pegasus-image-diff" id="blue-ridge-3">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--before" src="<?php echo $theme_img_path; ?>/blue-ridge-retaining-wall/before-3.jpg" alt="Before">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--after" src="<?php echo $theme_img_path; ?>/blue-ridge-retaining-wall/after-3.jpg" alt="After">
						<div class="pegasus-image-diff__handle"></div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="pegasus-image-diff" id="blue-ridge-4">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--before" src="<?php echo $theme_img_path; ?>/blue-ridge-retaining-wall/before-4.jpg" alt="Before">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--after" src="<?php echo $theme_img_path; ?>/blue-ridge-retaining-wall/after-4.jpg" alt="After">
						<div class="pegasus-image-diff__handle"></div>
					</div>
				</div>
			</div>
			<div class="row g-4 mb-4">
				<div class="col-lg-6 col-md-6">
					<div class="pegasus-image-diff" id="blue-ridge-5">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--before" src="<?php echo $theme_img_path; ?>/blue-ridge-retaining-wall/before-5.jpg" alt="Before">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--after" src="<?php echo $theme_img_path; ?>/blue-ridge-retaining-wall/after-5.jpg" alt="After">
						<div class="pegasus-image-diff__handle"></div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="pegasus-image-diff" id="blue-ridge-7">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--before" src="<?php echo $theme_img_path; ?>/blue-ridge-retaining-wall/before-7.jpg" alt="Before">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--after" src="<?php echo $theme_img_path; ?>/blue-ridge-retaining-wall/after-7.jpg" alt="After">
						<div class="pegasus-image-diff__handle"></div>
					</div>
				</div>
			</div>
			<div class="row g-4 mb-4">
				<div class="col-lg-6 col-md-6">
					<div class="pegasus-image-diff" id="blue-ridge-8">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--before" src="<?php echo $theme_img_path; ?>/blue-ridge-retaining-wall/before-8.jpg" alt="Before">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--after" src="<?php echo $theme_img_path; ?>/blue-ridge-retaining-wall/after-8.jpg" alt="After">
						<div class="pegasus-image-diff__handle"></div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="pegasus-image-diff" id="blue-ridge-9">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--before" src="<?php echo $theme_img_path; ?>/blue-ridge-retaining-wall/before-9.jpg" alt="Before">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--after" src="<?php echo $theme_img_path; ?>/blue-ridge-retaining-wall/after-9.jpg" alt="After">
						<div class="pegasus-image-diff__handle"></div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Canton Screened Porch Section -->
	<section class="exterior-section py-5" >
		<div class="container">
			<div class="row mb-4">
				<div class="col-12">
					<h2>Canton - Screened in Porch, Window Install & Walkway</h2>
				</div>
			</div>

			<div class="row g-4 mb-4">
				<div class="col-lg-6 col-md-6">
					<div class="pegasus-image-diff" id="canton-2">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--before" src="<?php echo $theme_img_path; ?>/canton-screened-porch/before-2.jpg" alt="Before">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--after" src="<?php echo $theme_img_path; ?>/canton-screened-porch/after-2.jpg" alt="After">
						<div class="pegasus-image-diff__handle"></div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Marietta East Cobb Section -->
	<section class="exterior-section py-5" style="background-color: #f5f5f5;">
		<div class="container">
			<div class="row mb-4">
				<div class="col-12">
					<h2>Marietta (East Cobb) - Roof, Siding, Gutters, Paint & Portico</h2>
				</div>
			</div>

			<div class="row g-4 mb-4">
				<div class="col-lg-6 col-md-6">
					<div class="pegasus-image-diff" id="marietta-ec-1">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--before" src="<?php echo $theme_img_path; ?>/marietta-east-cobb-roof-siding/before-1.jpg" alt="Before">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--after" src="<?php echo $theme_img_path; ?>/marietta-east-cobb-roof-siding/after-1.jpg" alt="After">
						<div class="pegasus-image-diff__handle"></div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="pegasus-image-diff" id="marietta-ec-2">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--before" src="<?php echo $theme_img_path; ?>/marietta-east-cobb-roof-siding/before-2.png" alt="Before">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--after" src="<?php echo $theme_img_path; ?>/marietta-east-cobb-roof-siding/after-2.jpg" alt="After">
						<div class="pegasus-image-diff__handle"></div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Marietta Screened Porch Section -->
	<section class="exterior-section py-5" >
		<div class="container">
			<div class="row mb-4">
				<div class="col-12">
					<h2>Marietta - Screened in Porch</h2>
				</div>
			</div>

			<div class="row g-4 mb-4">
				<div class="col-lg-6 col-md-6">
					<div class="pegasus-image-diff" id="marietta-sp-1">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--before" src="<?php echo $theme_img_path; ?>/marietta-screened-porch/before-1.jpg" alt="Before">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--after" src="<?php echo $theme_img_path; ?>/marietta-screened-porch/after-1.jpg" alt="After">
						<div class="pegasus-image-diff__handle"></div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="pegasus-image-diff" id="marietta-sp-2">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--before" src="<?php echo $theme_img_path; ?>/marietta-screened-porch/before-2.jpg" alt="Before">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--after" src="<?php echo $theme_img_path; ?>/marietta-screened-porch/after-2.jpg" alt="After">
						<div class="pegasus-image-diff__handle"></div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Roswell Siding & Gazebo Section -->
	<section class="exterior-section py-5" style="background-color: #f5f5f5;">
		<div class="container">
			<div class="row mb-4">
				<div class="col-12">
					<h2>Roswell - Siding, Windows, Fence, Portico & Gazebo</h2>
				</div>
			</div>

			<div class="row g-4 mb-4">
				<div class="col-lg-6 col-md-6">
					<div class="pegasus-image-diff" id="roswell-gazebo-1">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--before" src="<?php echo $theme_img_path; ?>/roswell-siding-gazebo/before-1.jpg" alt="Before">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--after" src="<?php echo $theme_img_path; ?>/roswell-siding-gazebo/after-1.jpg" alt="After">
						<div class="pegasus-image-diff__handle"></div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="pegasus-image-diff" id="roswell-gazebo-3">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--before" src="<?php echo $theme_img_path; ?>/roswell-siding-gazebo/before-3.jpg" alt="Before">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--after" src="<?php echo $theme_img_path; ?>/roswell-siding-gazebo/after-3.jpg" alt="After">
						<div class="pegasus-image-diff__handle"></div>
					</div>
				</div>
			</div>
			<div class="row g-4 mb-4">
				<div class="col-lg-6 col-md-6">
					<div class="pegasus-image-diff" id="roswell-gazebo-4">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--before" src="<?php echo $theme_img_path; ?>/roswell-siding-gazebo/before-4.jpg" alt="Before">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--after" src="<?php echo $theme_img_path; ?>/roswell-siding-gazebo/after-4.jpg" alt="After">
						<div class="pegasus-image-diff__handle"></div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="pegasus-image-diff" id="roswell-gazebo-6">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--before" src="<?php echo $theme_img_path; ?>/roswell-siding-gazebo/before-6.jpg" alt="Before">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--after" src="<?php echo $theme_img_path; ?>/roswell-siding-gazebo/after-6.jpg" alt="After">
						<div class="pegasus-image-diff__handle"></div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Roswell Siding & Windows Section -->
	<section class="exterior-section py-5" >
		<div class="container">
			<div class="row mb-4">
				<div class="col-12">
					<h2>Roswell - Siding & Windows</h2>
				</div>
			</div>

			<div class="row g-4 mb-4">
				<div class="col-lg-6 col-md-6">
					<div class="pegasus-image-diff" id="roswell-windows-1">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--before" src="<?php echo $theme_img_path; ?>/roswell-siding-windows/before-1.jpg" alt="Before">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--after" src="<?php echo $theme_img_path; ?>/roswell-siding-windows/after-1.jpg" alt="After">
						<div class="pegasus-image-diff__handle"></div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="pegasus-image-diff" id="roswell-windows-2">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--before" src="<?php echo $theme_img_path; ?>/roswell-siding-windows/before-2.png" alt="Before">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--after" src="<?php echo $theme_img_path; ?>/roswell-siding-windows/after-2.jpg" alt="After">
						<div class="pegasus-image-diff__handle"></div>
					</div>
				</div>
			</div>
			<div class="row g-4 mb-4">
				<div class="col-lg-6 col-md-6">
					<div class="pegasus-image-diff" id="roswell-windows-3">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--before" src="<?php echo $theme_img_path; ?>/roswell-siding-windows/before-3.jpg" alt="Before">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--after" src="<?php echo $theme_img_path; ?>/roswell-siding-windows/after-3.jpg" alt="After">
						<div class="pegasus-image-diff__handle"></div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="pegasus-image-diff" id="roswell-windows-4">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--before" src="<?php echo $theme_img_path; ?>/roswell-siding-windows/before-4.jpg" alt="Before">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--after" src="<?php echo $theme_img_path; ?>/roswell-siding-windows/after-4.jpg" alt="After">
						<div class="pegasus-image-diff__handle"></div>
					</div>
				</div>
			</div>
			<div class="row g-4 mb-4">
				<div class="col-lg-6 col-md-6">
					<div class="pegasus-image-diff" id="roswell-windows-5">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--before" src="<?php echo $theme_img_path; ?>/roswell-siding-windows/before-5.jpg" alt="Before">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--after" src="<?php echo $theme_img_path; ?>/roswell-siding-windows/after-5.jpg" alt="After">
						<div class="pegasus-image-diff__handle"></div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Smyrna Covered Porch Section -->
	<section class="exterior-section py-5" style="background-color: #f5f5f5;">
		<div class="container">
			<div class="row mb-4">
				<div class="col-12">
					<h2>Smyrna - Covered Porch & Sunroom</h2>
				</div>
			</div>

			<div class="row g-4 mb-4">
				<div class="col-lg-6 col-md-6">
					<div class="pegasus-image-diff" id="smyrna-2">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--before" src="<?php echo $theme_img_path; ?>/smyrna-covered-porch/before-2.jpg" alt="Before">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--after" src="<?php echo $theme_img_path; ?>/smyrna-covered-porch/after-2.jpg" alt="After">
						<div class="pegasus-image-diff__handle"></div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="pegasus-image-diff" id="smyrna-5">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--before" src="<?php echo $theme_img_path; ?>/smyrna-covered-porch/before-5.jpg" alt="Before">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--after" src="<?php echo $theme_img_path; ?>/smyrna-covered-porch/after-5.jpg" alt="After">
						<div class="pegasus-image-diff__handle"></div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Woodstock Hardscaping Section -->
	<section class="exterior-section py-5" >
		<div class="container">
			<div class="row mb-4">
				<div class="col-12">
					<h2>Woodstock - Hardscaping & Exterior Paint</h2>
				</div>
			</div>

			<div class="row g-4 mb-4">
				<div class="col-lg-6 col-md-6">
					<div class="pegasus-image-diff" id="woodstock-hard-1">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--before" src="<?php echo $theme_img_path; ?>/woodstock-hardscaping/before-1.jpg" alt="Before">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--after" src="<?php echo $theme_img_path; ?>/woodstock-hardscaping/after-1.jpg" alt="After">
						<div class="pegasus-image-diff__handle"></div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="pegasus-image-diff" id="woodstock-hard-2">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--before" src="<?php echo $theme_img_path; ?>/woodstock-hardscaping/before-2.jpg" alt="Before">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--after" src="<?php echo $theme_img_path; ?>/woodstock-hardscaping/after-2.jpg" alt="After">
						<div class="pegasus-image-diff__handle"></div>
					</div>
				</div>
			</div>
			<div class="row g-4 mb-4">
				<div class="col-lg-6 col-md-6">
					<div class="pegasus-image-diff" id="woodstock-hard-3">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--before" src="<?php echo $theme_img_path; ?>/woodstock-hardscaping/before-3.jpg" alt="Before">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--after" src="<?php echo $theme_img_path; ?>/woodstock-hardscaping/after-3.jpg" alt="After">
						<div class="pegasus-image-diff__handle"></div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Woodstock Holly Springs Section -->
	<section class="exterior-section py-5" style="background-color: #f5f5f5;">
		<div class="container">
			<div class="row mb-4">
				<div class="col-12">
					<h2>Woodstock (Holly Springs) - Outdoor Living Area, Siding & Paint</h2>
				</div>
			</div>

			<div class="row g-4 mb-4">
				<div class="col-lg-6 col-md-6">
					<div class="pegasus-image-diff" id="woodstock-hs-1">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--before" src="<?php echo $theme_img_path; ?>/woodstock-holly-springs/before-1.jpg" alt="Before">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--after" src="<?php echo $theme_img_path; ?>/woodstock-holly-springs/after-1.jpg" alt="After">
						<div class="pegasus-image-diff__handle"></div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="pegasus-image-diff" id="woodstock-hs-2">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--before" src="<?php echo $theme_img_path; ?>/woodstock-holly-springs/before-2.jpg" alt="Before">
						<img class="pegasus-image-diff__image pegasus-image-diff__image--after" src="<?php echo $theme_img_path; ?>/woodstock-holly-springs/after-2.jpg" alt="After">
						<div class="pegasus-image-diff__handle"></div>
					</div>
				</div>
			</div>
		</div>
	</section>


</div><!-- end page wrap -->

<?php get_footer(); ?>
