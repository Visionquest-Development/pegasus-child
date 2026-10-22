<?php
/*
	Template Name: Gallery Template
*/
get_header();
$images = rusans_data( 'images' );
$slugs  = array_values( array_filter( array_keys( $images ), function ( $k ) {
	return 0 === strpos( $k, 'gallery-' ) || in_array( $k, array( 'guest-rolls', 'feature-erika-roll', 'feature-entree', 'platter-deluxe', 'platter-nigiri' ), true );
} ) );
?>
<div id="page-wrap">
<main id="primary" class="site-main rusans rusans-gallery">

	<?php
	get_template_part( 'templates/rusans-page-hero', null, array(
		'image' => 'hero-rolls',
		'title' => get_the_title() ? get_the_title() : __( 'Gallery', 'pegasus' ),
	) );
	?>

	<div class="container py-5">
		<?php
		while ( have_posts() ) :
			the_post();
			the_content();
		endwhile;
		?>
		<div class="rusans-masonry">
			<?php foreach ( $slugs as $i => $slug ) : ?>
				<figure class="rusans-masonry__item wow fadeIn" data-wow-delay="<?php echo esc_attr( ( ( $i % 4 ) * 0.08 ) . 's' ); ?>">
					<a href="<?php echo esc_url( rusans_img_url( $slug, 'webp' ) ); ?>" data-rusans-lightbox data-caption="<?php echo esc_attr( $images[ $slug ]['alt'] ?? '' ); ?>">
						<?php echo rusans_picture( $slug, array( 'sizes' => '(min-width: 992px) 33vw, (min-width: 576px) 50vw, 100vw' ) ); // phpcs:ignore ?>
					</a>
					<figcaption><?php echo esc_html( $images[ $slug ]['alt'] ?? '' ); ?></figcaption>
				</figure>
			<?php endforeach; ?>
		</div>
	</div>

	<dialog class="rusans-lightbox" data-rusans-lightbox-dialog>
		<button type="button" class="rusans-lightbox__close" aria-label="<?php esc_attr_e( 'Close', 'pegasus' ); ?>">&times;</button>
		<img src="" alt="">
		<p class="rusans-lightbox__caption"></p>
	</dialog>

</main>
</div><!-- end page wrap -->
<?php get_footer(); ?>
