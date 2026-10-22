<?php
/*
	Template Name: Catering Template
*/
get_header();
$site     = rusans_data( 'site' );
$catering = rusans_data( 'catering' );
?>
<div id="page-wrap">
<main id="primary" class="site-main rusans rusans-catering">

	<?php
	get_template_part( 'templates/rusans-page-hero', null, array(
		'image'   => 'hero-sashimi-platter',
		'eyebrow' => __( 'Party Platters & Catering', 'pegasus' ),
		'title'   => get_the_title() ? get_the_title() : __( 'Catering', 'pegasus' ),
		'lead'    => $catering['intro'] ?? '',
	) );
	?>

	<div class="container py-5">
		<?php
		while ( have_posts() ) :
			the_post();
			if ( trim( get_the_content() ) ) {
				echo '<div class="mb-5">';
				the_content();
				echo '</div>';
			}
		endwhile;
		?>

		<?php foreach ( (array) ( $catering['sections'] ?? array() ) as $section ) : ?>
			<section class="rusans-platters mb-5">
				<h2 class="rusans-section-title wow fadeInUp"><?php echo esc_html( $section['title'] ); ?></h2>
				<div class="row g-4">
					<?php foreach ( (array) $section['items'] as $i => $item ) : ?>
						<div class="col-12 col-md-6 col-lg-4">
							<article class="rusans-card rusans-platter h-100 wow fadeInUp" data-wow-delay="<?php echo esc_attr( ( ( $i % 3 ) * 0.1 ) . 's' ); ?>">
								<?php if ( ! empty( $item['image'] ) ) : ?>
									<div class="rusans-card__media"><?php echo rusans_picture( $item['image'], array( 'sizes' => '(min-width: 992px) 33vw, (min-width: 768px) 50vw, 100vw' ) ); // phpcs:ignore ?></div>
								<?php else : ?>
									<div class="rusans-card__media rusans-card__media--placeholder" aria-hidden="true"><i class="fa fa-cutlery"></i></div>
								<?php endif; ?>
								<div class="rusans-card__body">
									<div class="rusans-platter__top">
										<h3 class="rusans-card__title"><?php echo esc_html( $item['name'] ); ?></h3>
										<?php if ( '' !== (string) $item['price'] ) : ?>
											<span class="rusans-platter__price">$<?php echo esc_html( $item['price'] ); ?></span>
										<?php endif; ?>
									</div>
									<?php if ( ! empty( $item['description'] ) ) : ?>
										<p><?php echo esc_html( $item['description'] ); ?></p>
									<?php endif; ?>
									<?php if ( ! empty( $item['contents'] ) ) : ?>
										<ul class="rusans-platter__list">
											<?php foreach ( $item['contents'] as $c ) : ?>
												<li><?php echo esc_html( $c ); ?></li>
											<?php endforeach; ?>
										</ul>
									<?php endif; ?>
								</div>
							</article>
						</div>
					<?php endforeach; ?>
				</div>
			</section>
		<?php endforeach; ?>

		<section class="rusans-panel text-center wow fadeInUp">
			<h2 class="rusans-panel__title"><?php esc_html_e( 'Order a Platter', 'pegasus' ); ?></h2>
			<p><?php esc_html_e( 'Call us or email the catering team with your date, headcount and platter choices.', 'pegasus' ); ?></p>
			<div class="d-flex flex-wrap justify-content-center gap-2">
				<a class="btn rusans-btn rusans-btn--primary" href="tel:<?php echo esc_attr( $site['phone_e164'] ?? '' ); ?>"><i class="fa fa-phone" aria-hidden="true"></i> <?php echo esc_html( $site['phone_display'] ?? '' ); ?></a>
				<a class="btn rusans-btn rusans-btn--outline" href="mailto:<?php echo esc_attr( $site['email_catering'] ?? '' ); ?>?subject=<?php echo rawurlencode( 'Catering order' ); ?>"><i class="fa fa-envelope" aria-hidden="true"></i> <?php echo esc_html( $site['email_catering'] ?? '' ); ?></a>
			</div>
		</section>
	</div>

</main>
</div><!-- end page wrap -->
<?php get_footer(); ?>
