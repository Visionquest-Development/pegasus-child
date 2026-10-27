<?php
/*
	Template Name: MNG Gallery
*/
get_header();
$site = mng_data( 'site' );
?>
<div id="page-wrap">
<main id="primary" class="site-main mng mng-gallery">
	<?php get_template_part( 'templates/mng-page-hero', null, array( 'image' => 'smoked-chicken', 'eyebrow' => __( 'Straight off the smoker', 'pegasus' ), 'title' => get_the_title() ) ); ?>
	<section class="mng-gallery-grid-wrap">
		<div class="container">
			<?php
			while ( have_posts() ) :
				the_post();
				if ( trim( get_the_content() ) ) {
					echo '<div class="mng-intro__content mb-4">';
					the_content();
					echo '</div>';
				}
			endwhile;
			?>
			<h2 class="screen-reader-text"><?php esc_html_e( 'Photos', 'pegasus' ); ?></h2>
			<ul class="mng-gallery-grid">
				<?php foreach ( (array) ( $site['gallery'] ?? array() ) as $i => $g ) :
					$meta = mng_img_meta( $g );
					if ( ! $meta ) {
						continue;
					}
					?>
					<li class="mng-gallery-grid__item wow fadeIn" data-wow-delay="<?php echo esc_attr( ( ( $i % 4 ) * 0.08 ) . 's' ); ?>">
						<a href="<?php echo esc_url( mng_img_url( $g, 'webp' ) ); ?>" data-mng-lightbox data-caption="<?php echo esc_attr( $meta['alt'] ); ?>">
							<?php echo mng_picture( $g, array( 'sizes' => '(min-width: 992px) 25vw, (min-width: 576px) 50vw, 100vw' ) ); // phpcs:ignore ?>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>
	<dialog class="mng-lightbox" data-mng-lightbox-dialog aria-label="<?php esc_attr_e( 'Photo viewer', 'pegasus' ); ?>">
		<button type="button" class="mng-lightbox__close" aria-label="<?php esc_attr_e( 'Close', 'pegasus' ); ?>">&times;</button>
		<img src="data:image/gif;base64,R0lGODlhAQABAAAAACw=" alt="">
		<p class="mng-lightbox__caption"></p>
	</dialog>
	<?php get_template_part( 'templates/mng-order-cta' ); ?>
</main>
</div>
<?php get_footer(); ?>
