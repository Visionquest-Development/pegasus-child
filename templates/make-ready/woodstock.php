<?php
/**
 * Make Ready - Woodstock / JC & Jennifer (1655 Pine Ridge)
 *
 * @package pegasus-child
 */

$mr_path     = get_stylesheet_directory_uri() . '/images/make-ready/woodstock-jc-jennifer';
$mr_dir      = get_stylesheet_directory() . '/images/make-ready/woodstock-jc-jennifer';
$main_images = glob( $mr_dir . '/main/*.jpg' );
$after_images  = glob( $mr_dir . '/after/*.jpg' );
sort( $main_images );
sort( $after_images );
?>

<!-- Woodstock - JC & Jennifer Make Ready -->
<section id="woodstock-make-ready" class="interior-section py-5 section-alt-bg">
	<div class="container">
		<div class="row mb-4">
			<div class="col-12">
				<h2>Woodstock - Make Ready to Sell</h2>
			</div>
		</div>

		<?php if ( $main_images ) : ?>
		<!-- Progress Photos -->
		<div class="row mb-4">
			<div class="col-12">
				<h3>Progress Photos</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<?php
				$gallery_output = '[masonry]';
				foreach ( $main_images as $img ) {
					$filename = basename( $img );
					$gallery_output .= '<a href="' . $mr_path . '/main/' . $filename . '" data-lightbox="woodstock-main" data-title="Woodstock - Progress" class="wow fadeIn"><img src="' . $mr_path . '/main/' . $filename . '" loading="lazy"></a>';
				}
				$gallery_output .= '[/masonry]';
				$gallery_output = str_replace( ' loading="lazy"', '', $gallery_output );
				echo do_shortcode( $gallery_output );
				?>
			</div>
		</div>
		<?php endif; ?>

		<?php if ( $after_images ) : ?>
		<!-- After Photos -->
		<div class="row mt-5 mb-4">
			<div class="col-12">
				<h3>After Photos</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<?php
				$gallery_output = '[masonry]';
				foreach ( $after_images as $img ) {
					$filename = basename( $img );
					$gallery_output .= '<a href="' . $mr_path . '/after/' . $filename . '" data-lightbox="woodstock-after" data-title="Woodstock - After" class="wow fadeIn"><img src="' . $mr_path . '/after/' . $filename . '" loading="lazy"></a>';
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
