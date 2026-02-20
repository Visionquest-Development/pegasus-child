<?php
/**
 * Make Ready - Silverchase (Aaron & Alona)
 *
 * @package pegasus-child
 */

$mr_path     = get_stylesheet_directory_uri() . '/images/make-ready/silverchase-aaron-alona';
$mr_dir      = get_stylesheet_directory() . '/images/make-ready/silverchase-aaron-alona';
$main_images = glob( $mr_dir . '/main/*.jpg' );
$before_images = glob( $mr_dir . '/before/*.jpg' );
$after_images  = glob( $mr_dir . '/after/*.jpg' );
sort( $main_images );
sort( $before_images );
sort( $after_images );
?>

<!-- Silverchase - Aaron & Alona Make Ready -->
<section id="silverchase-make-ready" class="interior-section py-5 section-alt-bg">
	<div class="container">
		<div class="row mb-4">
			<div class="col-12">
				<h2>Silverchase - Make Ready to Sell</h2>
			</div>
		</div>

		<?php /* if ( $main_images ) : ?>
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
					$gallery_output .= '<a href="' . $mr_path . '/main/' . $filename . '" data-lightbox="silverchase-main" data-title="Silverchase - Progress" class="wow fadeIn"><img src="' . $mr_path . '/main/' . $filename . '" loading="lazy"></a>';
				}
				$gallery_output .= '[/masonry]';
				$gallery_output = str_replace( ' loading="lazy"', '', $gallery_output );
				echo do_shortcode( $gallery_output );
				?>
			</div>
		</div>
		<?php endif; */?>

		<?php if ( $before_images ) : ?>
		<!-- Before Photos -->
		<div class="row mt-5 mb-4">
			<div class="col-12">
				<h3>Before Photos</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<?php
				$gallery_output = '[masonry]';
				foreach ( $before_images as $img ) {
					$filename = basename( $img );
					$gallery_output .= '<a href="' . $mr_path . '/before/' . $filename . '" data-lightbox="silverchase-before" data-title="Silverchase - Before" class="wow fadeIn"><img src="' . $mr_path . '/before/' . $filename . '" loading="lazy"></a>';
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
					$gallery_output .= '<a href="' . $mr_path . '/after/' . $filename . '" data-lightbox="silverchase-after" data-title="Silverchase - After" class="wow fadeIn"><img src="' . $mr_path . '/after/' . $filename . '" loading="lazy"></a>';
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
