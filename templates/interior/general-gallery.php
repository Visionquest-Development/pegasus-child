<?php
/**
 * Interior - General Interior Gallery
 *
 * @package pegasus-child
 */

$general_img_path = get_stylesheet_directory_uri() . '/images/Interior/general-interior';
?>

<!-- =====================================================================
	 GENERAL INTERIOR GALLERY
	 ===================================================================== -->
	 <section id="general-interior-gallery" class="interior-gallery-section py-5">
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

				$gallery_output .= '<a href="' . $general_img_path . '/closet-expansion/closet-expansion-01.jpg" data-lightbox="general-interior-gallery" data-title="Closet Expansion" class="wow fadeIn"><img src="' . $general_img_path . '/closet-expansion/closet-expansion-01.jpg" loading="lazy"></a>';

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

				$gallery_output .= '[/masonry]';
				$gallery_output = str_replace( ' loading="lazy"', '', $gallery_output );

				echo do_shortcode( $gallery_output );
				?>
			</div>
		</div>
	</div>
</section>
