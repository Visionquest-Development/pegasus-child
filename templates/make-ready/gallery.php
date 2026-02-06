<?php
/**
 * Make Ready - Gallery Overview
 *
 * Combined curated after photos from all make-ready projects.
 *
 * @package pegasus-child
 */

$base_uri = get_stylesheet_directory_uri() . '/images/make-ready';
$base_dir = get_stylesheet_directory() . '/images/make-ready';

$silverchase_after = glob( $base_dir . '/silverchase-aaron-alona/after/*.jpg' );
$greg_after        = glob( $base_dir . '/greg-michell/after/*.jpg' );
$woodstock_after   = glob( $base_dir . '/woodstock-jc-jennifer/after/*.jpg' );
sort( $silverchase_after );
sort( $greg_after );
sort( $woodstock_after );
?>

<!-- =====================================================================
	 MAKE READY GALLERY PHOTOS
	 ===================================================================== -->
<section id="make-ready-gallery" class="interior-gallery-section py-5">
	<div class="container">
		<div class="row mb-4">
			<div class="col-12">
				<h2 class="gallery-section-title">Make Ready Project Gallery</h2>
				<p class="gallery-section-subtitle">Browse our collection of completed make-ready renovation projects, preparing homes for sale.</p>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<?php
				$gallery_output = '[masonry]';

				// Silverchase - curated selection (every 10th image)
				foreach ( $silverchase_after as $i => $img ) {
					if ( $i % 10 === 0 ) {
						$filename = basename( $img );
						$gallery_output .= '<a href="' . $base_uri . '/silverchase-aaron-alona/after/' . $filename . '" data-lightbox="make-ready-gallery" data-title="Silverchase Make Ready" class="wow fadeIn"><img src="' . $base_uri . '/silverchase-aaron-alona/after/' . $filename . '" loading="lazy"></a>';
					}
				}

				// Greg Michell - curated selection (every 8th image)
				foreach ( $greg_after as $i => $img ) {
					if ( $i % 8 === 0 ) {
						$filename = basename( $img );
						$gallery_output .= '<a href="' . $base_uri . '/greg-michell/after/' . $filename . '" data-lightbox="make-ready-gallery" data-title="Roswell Make Ready" class="wow fadeIn"><img src="' . $base_uri . '/greg-michell/after/' . $filename . '" loading="lazy"></a>';
					}
				}

				// Woodstock - curated selection (every 7th image)
				foreach ( $woodstock_after as $i => $img ) {
					if ( $i % 7 === 0 ) {
						$filename = basename( $img );
						$gallery_output .= '<a href="' . $base_uri . '/woodstock-jc-jennifer/after/' . $filename . '" data-lightbox="make-ready-gallery" data-title="Woodstock Make Ready" class="wow fadeIn"><img src="' . $base_uri . '/woodstock-jc-jennifer/after/' . $filename . '" loading="lazy"></a>';
					}
				}

				$gallery_output .= '[/masonry]';
				echo do_shortcode( $gallery_output );
				?>
			</div>
		</div>
	</div>
</section>
