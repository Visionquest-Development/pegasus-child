	<?php get_header(); ?>

	<div id="page-wrap">
		<?php
		$pegasus_container_choice = get_post_meta(get_the_ID(), 'pegasus-page-container-checkbox', true);
		$full_container_chk_choice = get_post_meta(get_the_ID(), 'full_container_chk', true);
		?>

		<div class="container-fluid opp-bkg p-3">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<div class="row">
					<div class="col-md-12">
						<div class="inner-content">
							<?php
							$page_header_choice = pegasus_get_option('page_header_chk');
							if ($page_header_choice != 'on') :
							?>
								<a href="/meet-our-dogs" class="opp-button mb-3">Back to Meet our Dogs</a>

							<?php endif; ?>
						</div>
					</div>
				</div>

				<div class="container-fluid">
					<div class="gallery-container mb-3">
						<!--<h4>Gallery</h4>-->
						<?php
						$gallery_images = get_post_meta(get_the_ID(), 'pets_gallery', true);
						if (!empty($gallery_images)) {
							$image_urls = array();
							foreach ($gallery_images as $gallery_item) {
								if (isset($gallery_item['image_id']) && !empty($gallery_item['image_id'])) {
									$image_url = wp_get_attachment_image_url($gallery_item['image_id'], 'medium');
									if ($image_url) {
										$image_urls[] = $image_url;
									}
								}
							}
							if (!empty($image_urls)) {
								?>
								<div class="slick-slider pets-template-slider">
									<?php foreach ($image_urls as $image_url) : ?>
										<div>
											<img src="<?php echo esc_url($image_url); ?>" alt="Gallery Image" class="img-fluid">
										</div>
									<?php endforeach; ?>
								</div>
								<?php
							}
						}
						?>
					</div>
				</div>

				<div class="row">


					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-9 col-xg-9 pets-gallery-video mb-2">
						<div class="page-header mb-3">
							<h1><?php wp_title(''); ?></h1>
						</div>
						<?php /*
						<div class="row">
							<div class="col-md-6">
								<?php
								if (has_post_thumbnail()) {
									$thumb_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full', false, '');
								} else {
									$thumb_url = array(get_template_directory_uri() . "/images/banner.png", "1");
								}
								?>
								<div class="w-50 mt-3 ml-auto mr-auto mb-5">
									<img class="w-100" src="<?php echo $thumb_url[0]; ?>">
								</div>
							</div>
							<div class="col-md-6">
								<?php if ($video_url) : ?>
									<div class="video-container mb-3">
										<h4>Video</h4>
										<video controls class="pet-video-container w-100">
											<source src="<?php echo $video_url; ?>" type="video/mp4" />
										</video>
									</div>
								<?php endif; ?>
							</div>
						</div>
						*/ ?>

						<?php
						$meta = get_post_meta($post->ID);
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
						?>

						<p class="pet-meta">
							<?php if (!empty($breed)) : ?>
								<?php echo esc_html($breed); ?>
							<?php endif; ?>
						</p>

						<hr>

						<p class="pet-attributes">
							<?php if (!empty($growth)) : ?>
								<span><?php echo $growth === 'yes' ? 'Full Grown' : esc_html($growth); ?></span>
							<?php endif; ?>
							<span class="mx-2">|</span>
							<?php if (!empty($gender)) : ?>
								<span><?php echo ucfirst(esc_html($gender)); ?></span>
							<?php endif; ?>
							<span  class="mx-2">|</span>
							<?php if (!empty($size)) : ?>
								<span><?php echo ucfirst(esc_html($size)); ?></span>
							<?php endif; ?>
						</p>

						<hr>

						<h3>About</h3>
						<div class="pet-about">
							<?php if (!empty($f_dogs) || !empty($f_cats) || !empty($f_child)) : ?>
								<p><strong>CHARACTERISTICS</strong><br>
									<?php
									$characteristics = array_filter([
										$f_dogs ? 'Good with other dogs' : '',
										$f_cats ? 'Good with cats' : '',
										$f_child ? 'Good with children' : ''
									]);
									echo esc_html(implode(', ', $characteristics));
									?>
								</p>
							<?php endif; ?>

							<?php if (!empty($h_trained)) : ?>
								<p><strong>HOUSE-TRAINED</strong><br>
									<?php echo ucfirst(esc_html($h_trained)); ?>
								</p>
							<?php endif; ?>

							<?php if (!empty($f_child)) : ?>
								<p><strong>GOOD IN A HOME WITH</strong><br>
									Children.
								</p>
							<?php endif; ?>
						</div>

						<hr class="mt-4">

						<p class="petfinder-note">
							<i class="fa fa-bell"></i> Our Pal's Place recommends that you should always take reasonable security steps before making online payments.
						</p>

						<hr class="mb-4">
						<?php /*
						<div class="pet-details">
							<?php if ($gender && 'custom' !== $gender) { ?><p><b>Gender:</b> <?php echo $gender; ?></p><?php } ?>
							<?php if ('' !== $size) { ?><p><b>Size:</b> <?php echo $size; ?></p><?php } ?>
							<?php if ($growth && 'custom' !== $growth) { ?><p><b>Full Grown:</b> <?php echo $growth; ?></p><?php } ?>
							<?php if ('' !== $breed) { ?><p><b>Primary Breed:</b> <?php echo $breed; ?></p><?php } ?>
							<?php if ('' !== $rescue) { ?><p><b>Rescued From:</b> <?php echo $rescue; ?></p><?php } ?>
							<?php if ($f_dogs && 'custom' !== $f_dogs) { ?><p><b>Good With Other Dogs:</b> <?php echo $f_dogs; ?></p><?php } ?>
							<?php if ($f_cats && 'custom' !== $f_cats) { ?><p><b>Good With Cats:</b> <?php echo $f_cats; ?></p><?php } ?>
							<?php if ($f_child && 'custom' !== $f_child) { ?><p><b>Good With Children:</b> <?php echo $f_child; ?></p><?php } ?>
							<?php if ($h_trained && 'custom' !== $h_trained) { ?><p><b>House Trained:</b> <?php echo $h_trained; ?></p><?php } ?>
						</div>
						*/ ?>

						<?php the_content(); ?>

					</div><!-- -- col-lg-9 -->

					<div class="col-lg-3 pets-column mb-2 px-lg-2">
						<?php get_template_part('templates/opp_callout'); ?>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<hr>
						<p>Our Pal's Place adoption process is called "Companion Match" <a href='/companion-match/'>Learn More</a></p>
						<p>If you are interested in <?php wp_title(''); ?>...</p>
						<ul>
							<li>Come Meet him/her Saturday &amp; Sundays 1:00-5:00pm or weekday by appointment</li>
							<li>Complete the <a href="/companion-match-form/">Companion Match Form</a> which helps us determine if she/he is a good match for you</li>
						</ul>
						<?php comments_template(); ?>
					</div>
				</div>
			<?php endwhile; else : ?>
				<div class="page-header">
					<h1>Oh no!</h1>
				</div>
				<p>No content is appearing for this page!</p>
			<?php endif; ?>
		</div>
	</div>

	<?php get_footer(); ?>
