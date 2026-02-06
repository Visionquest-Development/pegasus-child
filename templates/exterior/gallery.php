<?php
/**
 * Exterior - Gallery Photos
 *
 * @package pegasus-child
 */

$gallery_img_path = get_stylesheet_directory_uri() . '/images/Exterior/gallery-photos';
?>

<!-- Exterior Gallery Section -->
<section id="exterior-gallery" class="exterior-gallery-section py-5">
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
