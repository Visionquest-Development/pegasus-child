<?php
/**
 * Learn hub (the Posts page, /learn/). Articles live at /learn/%postname%/.
 */
get_header();
$learn_id = (int) get_option( 'page_for_posts' );
$paged    = max( 1, (int) get_query_var( 'paged' ) );
?>
<div id="page-wrap">
<main id="primary" class="site-main igj igj-learn">
	<?php
	get_template_part( 'templates/igj-page-hero', null, array(
		'title' => $learn_id ? get_the_title( $learn_id ) . ( $paged > 1 ? ' – ' . sprintf( __( 'Page %d', 'pegasus' ), $paged ) : '' ) : __( 'Learn', 'pegasus' ),
		'lead'  => __( 'Plain-English guides to choosing and using health insurance, written to help you make a confident decision.', 'pegasus' ),
		'cta'   => false,
	) );
	?>
	<section class="igj-section">
		<div class="container">
			<?php if ( have_posts() ) : ?>
				<ul class="igj-learn-cards row g-3 g-lg-4 list-unstyled">
					<?php while ( have_posts() ) : the_post(); ?>
						<li class="col-12 col-md-6 col-lg-4 wow fadeInUp">
							<article class="igj-learn-card">
								<p class="igj-learn-card__meta"><?php echo esc_html( get_the_category() ? get_the_category()[0]->name : __( 'Guide', 'pegasus' ) ); ?> · <time datetime="<?php echo esc_attr( get_the_modified_date( 'c' ) ); ?>"><?php echo esc_html( get_the_modified_date() ); ?></time></p>
								<h2 class="igj-learn-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<p class="igj-learn-card__excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
								<a class="igj-learn-card__more" href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'Read: %s', 'pegasus' ), get_the_title() ) ); ?>"><?php esc_html_e( 'Read the guide', 'pegasus' ); ?> <i class="fa fa-angle-right" aria-hidden="true"></i></a>
							</article>
						</li>
					<?php endwhile; ?>
				</ul>
				<?php the_posts_pagination( array( 'mid_size' => 1, 'class' => 'igj-pagination' ) ); ?>
			<?php else : ?>
				<p><?php esc_html_e( 'New guides are coming soon.', 'pegasus' ); ?></p>
			<?php endif; ?>
		</div>
	</section>
	<section class="igj-section igj-section--tint">
		<div class="container">
			<h2 class="igj-section-title"><?php esc_html_e( 'Find coverage for your situation', 'pegasus' ); ?></h2>
			<?php get_template_part( 'templates/igj-service-cards', null, array( 'heading_level' => 'h3' ) ); ?>
		</div>
	</section>
	<?php get_template_part( 'templates/igj-cta-band' ); ?>
</main>
</div>
<?php get_footer(); ?>
