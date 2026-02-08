<?php
/**
 * Interior - Kitchen Gallery Photos
 *
 * @package suspended-starter-developer-developer Developer Developer Developer Developer Developer Developer-child
 */

$kitchen_gallery_path = get_stylesheet_directory_uri() . '/images/Interior/kitchen/gallery-photos';
?>

<!-- =====================================================================
	 KITCHEN GALLERY PHOTOS
	 ===================================================================== -->
<section id="kitchen-gallery" class="interior-gallery-section py-5" >
	<div class="container">
		<div class="row mb-4">
			<div class="col-12">
				<h2 class="gallery-section-title">Kitchen Project Gallery</h2>
				<p class="gallery-section-subtitle">Browse our collection of completed kitchen renovation projects.</p>
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
				$gallery_output = str_replace( ' loading="lazy"', '', $gallery_output );

				echo do_shortcode( $gallery_output );
				?>
			</div>
		</div>
	</div>
</section>
