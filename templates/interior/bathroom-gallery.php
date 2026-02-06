<?php
/**
 * Interior - Bathroom Gallery Photos
 *
 * @package pegasus-child
 */

$bath_gallery_path = get_stylesheet_directory_uri() . '/images/Interior/bathroom/gallery-photos';
?>

<!-- =====================================================================
	 BATHROOM GALLERY PHOTOS
	 ===================================================================== -->
<section id="bathroom-gallery" class="interior-gallery-section py-5" >
	<div class="container">
		<div class="row mb-4">
			<div class="col-12">
				<h2 class="gallery-section-title">Bathroom Project Gallery</h2>
				<p class="gallery-section-subtitle">Browse our collection of completed bathroom renovation projects.</p>
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
