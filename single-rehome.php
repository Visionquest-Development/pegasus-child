	<?php get_header(); ?>



	<div id="page-wrap">

		<?php

			$pegasus_container_choice = get_post_meta( get_the_ID(), 'pegasus-page-container-checkbox', true );

			$full_container_chk_choice = get_post_meta( get_the_ID(), 'full_container_chk', true );

		?>



		<?php if($full_container_chk_choice === 'on') {

													//echo 'container-fluid';

												}elseif ($pegasus_container_choice === 'on') {

													//echo 'container-fluid';

												}else{

													//echo 'container';

												}?>



		<div class="container-fluid">

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>



			<div class="row">

				<div class="col-md-12">

					<div class="inner-content">

						<?php

							$page_header_choice =  pegasus_get_option('page_header_chk' );

							if( $page_header_choice != 'on' ) {

						?>

							<a href="/re-home">Back to Re-Home page</a>

							<div class="page-header">

								<h1><?php wp_title( '' ); ?></h1>

								<?php /*

								<p><em>

									By <?php the_author(); ?>

									on <?php echo the_time('l, F, jS, Y');?>

									in <?php the_category( ',' ); ?>.

									<a href="<?php comments_link(); ?>"><?php comments_number(); ?></a>

							</em></p>

							*/ ?>

							</div>

						<?php } ?>

					</div><!--end inner content-->

				</div>

				<?php //get_sidebar(); ?>







			</div><!--end row -->





			<div class="row">

				<div class="col-lg-3 pets-column mb-2 px-lg-2">

					<?php

						if ( has_post_thumbnail() ) {

							$thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full', false, '' );

						}else{

							$thumb_url = array( get_template_directory_uri() . "/images/banner.png", "1");

						}

					?>

					<?php



					?>

					<div class="w-50 mt-3 ml-auto mr-auto mb-5">

						<img class="w-100" src="<?php echo $thumb_url[0];?>">

					</div>

					<?php the_content(); ?>



					<?php







						$meta = get_post_meta($post->ID);

						//echo "<pre>";  var_dump($meta); echo "</pre><hr>";

					?>



					<?php

						$gender = $meta['pets_gender'][0];

						$size = $meta['pets_size'][0];

						$growth = $meta['pets_grown'][0];

						$breed = $meta['pets_breed'][0];

						$rescue = $meta['pets_rescue'][0];

						$f_dogs = $meta['pets_friendly_to_dogs'][0];

						$f_cats = $meta['pets_friendly_to_cats'][0];

						$f_child = $meta['pets_friendly_to_child'][0];

						$h_trained = $meta['pets_house_trained'][0];

						$video_url = $meta['pets_video_url'][0];

						$contact_info = $meta['pets_contact_info'][0];

					?>



					<div class="pet-details">

						<!--<p><b>Gender:</b> <?php //echo $gender; ?></p>

						<p><b>Size:</b> <?php //echo $size; ?></p>-->

						<?php if ( $gender && 'custom' !== $gender ) { ?><p><b>Gender:</b> <?php echo $gender; ?></p><?php } ?>

						<?php if ( '' !== $size ) { ?><p><b>Size:</b> <?php echo $size; ?></p><?php } ?>

						<?php if ( $growth && 'custom' !== $growth ) { ?><p><b>Full Grown:</b> <?php echo $growth; ?></p><?php } ?>

						<?php if ( '' !== $breed ) { ?><p><b>Primary Breed:</b> <?php echo $breed; ?></p><?php } ?>

						<?php if ( '' !== $rescue ) { ?><p><b>Rescued From:</b> <?php echo $rescue; ?></p><?php } ?>

						<?php if ( $f_dogs && 'custom' !== $f_dogs ) { ?><p><b>Good With Other Dogs:</b> <?php echo $f_dogs; ?></p><?php } ?>

						<?php if ( $f_cats && 'custom' !== $f_cats ) { ?><p><b>Good With Cats:</b> <?php echo $f_cats; ?></p><?php } ?>

						<?php if ( $f_child && 'custom' !== $f_child ) { ?><p><b>Good With Children:</b> <?php echo $f_child; ?></p><?php } ?>

						<?php if ( $h_trained && 'custom' !== $h_trained ) { ?><p><b>House Trained:</b> <?php echo $h_trained; ?></p><?php } ?>

						<?php if ( $contact_info && '' !== $contact_info ) { ?><p><b>Contact Info:</b> <?php echo $contact_info; ?></p><?php } ?>



						<?php //echo "<pre>";  var_dump($gender); echo "</pre><hr>"; ?>



					</div>

				</div>

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-9 col-xg-9 pets-gallery-video mb-2">

					<div class="gallery-container mt-3 mb-3">

						<h4>Gallery</h4>

						<?php

							/*

							$attachments = get_children( array(

								'post_parent' => $post->ID ,

								'post_status' => 'inherit',

								'post_type' => 'attachment',

								'post_mime_type' => 'image',

								'order' => 'ASC',

								'category_media' => 'gallery',

								'orderby' => 'menu_order'

							) );



							if ( !empty( $attachments ) ):

								echo do_shortcode('[gallery size="medium" link="none" type=”slideshow” columns="4" ids="'. implode(',', array_keys($attachments)).' ,"]');

							endif;

							*/



							$gallery_images = get_post_meta( get_the_ID(), 'pets_gallery', true );



							if ( ! empty( $gallery_images ) ) {

								$image_ids = array();



								// Loop through each gallery item and collect the image IDs

								foreach ( $gallery_images as $gallery_item ) {

									if ( isset( $gallery_item['image'] ) && ! empty( $gallery_item['image'] ) ) {

										// Convert URL to attachment ID (if stored as URL)

										$attachment_id = attachment_url_to_postid( $gallery_item['image'] );

										if ( $attachment_id ) {

											$image_ids[] = $attachment_id;

										}

									}

								}



								// If we have valid attachment IDs, output the gallery shortcode

								if ( ! empty( $image_ids ) ) {

									echo do_shortcode( '[gallery size="medium" link="none" type="slideshow" columns="4" ids="' . implode(',', $image_ids) . '"]' );

								}

							}



						?>

					</div>



					<?php

						if ( $video_url ) {

					?>

						<div class="video-container mb-3">

							<h4>Video</h4>

							<video controls class="pet-video-container w-100">

								<!--<source src="/media/cc0-videos/flower.webm" type="video/webm" />

								<source src="/media/cc0-videos/flower.mp4" type="video/mp4" />-->

								<source src="<?php echo $video_url; ?>" type="video/mp4" />



								<!--Download the

								<a href="/media/cc0-videos/flower.webm">WEBM</a>

								or

								<a href="/media/cc0-videos/flower.mp4">MP4</a>

								video.-->

							</video>

						</div>

					<?php

						}

					?>





				</div>

			</div><!-- end row -->



			<div class="row">

				<div class="col-md-12">



					<hr>

					<p>Below are courtesy postings of pets who are being re-homed by their family. These are not pets associated with Our Pal’s Place and are not housed in our Pet Adoption Facility. If you want to meet a pet listed below, please contact us: <a href="mailto:helpanimals@ourpalsplace.org">helpanimals@ourpalsplace.org</a></p>



					<!--<p>Questions? Please send an e-mail to <a href="mailto:helpanimals@ourpalsplace.org?subject=Adoption Inquiry">helpanimals@ourpalsplace.org.</a> </p>-->

					<?php comments_template(); ?>

				</div>

			</div>

			<?php

			// Edit post link

			if ( function_exists( 'wp_bootstrap_edit_post_link' ) ) {
				// Edit post link
				wp_bootstrap_edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'textdomain' ),
						get_the_title()
					),
					'<span class="edit-link">',
					'</span>'
				);
			}

			?>





			<?php endwhile; else: ?>

				<?php /* kinda a 404 of sorts when not working */ ?>

				<div class="page-header">

					<h1>Oh no!</h1>

				</div>

				<p>No content is appearing for this page!</p>

			<?php endif; ?>



		</div><!-- end container -->

	</div><!-- end page wrap -->

      <?php get_footer(); ?>
