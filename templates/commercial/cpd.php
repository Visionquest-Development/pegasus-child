<?php
/**
 * Commercial - CPD
 *
 * @package pegasus-child
 */

$com_path = get_stylesheet_directory_uri() . '/images/Commercial/CPD';
$com_dir  = get_stylesheet_directory() . '/images/Commercial/CPD';

// Gather all image types (mixed extensions in this folder).
$images = array_merge(
	glob( $com_dir . '/*.jpg' ),
	glob( $com_dir . '/*.JPEG' ),
	glob( $com_dir . '/*.JPG' ),
	glob( $com_dir . '/*.PNG' ),
	glob( $com_dir . '/*.png' )
);

// Deduplicate (e.g. "5.jpg.JPEG" matches only one pattern) and sort.
$images = array_unique( $images );
sort( $images );
?>

<!-- CPD Commercial Project -->
<section id="cpd-commercial" class="interior-section py-5 section-alt-bg">
	<div class="container">
		<div class="row mb-4">
			<div class="col-12">
				<h2>CPD - Commercial Project</h2>
			</div>
		</div>

		<?php if ( $images ) : ?>
		<div class="row">
			<div class="col-12">
				<?php
				$gallery_output = '[masonry]';
				foreach ( $images as $img ) {
					$filename = basename( $img );
					$gallery_output .= '<a href="' . $com_path . '/' . $filename . '" data-lightbox="cpd-commercial" data-title="CPD - Commercial" class="wow fadeIn"><img src="' . $com_path . '/' . $filename . '" loading="lazy"></a>';
				}
				$gallery_output .= '[/masonry]';
				$gallery_output = str_replace( ' loading="lazy"', '', $gallery_output );
				echo do_shortcode( $gallery_output );
				?>
			</div>
		</div>
		<?php endif; ?>
	</div>
</section>
