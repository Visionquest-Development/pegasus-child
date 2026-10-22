<?php
/**
 * Search results (noindexed in inc/igj-seo.php).
 */
get_header();
?>
<div id="page-wrap">
<main id="primary" class="site-main igj igj-learn">
	<?php get_template_part( 'templates/igj-page-hero', null, array( 'title' => sprintf( /* translators: %s: search terms */ __( 'Search results for “%s”', 'pegasus' ), get_search_query() ), 'lead' => '', 'cta' => false ) ); ?>
	<section class="igj-section">
		<div class="container">
			<?php if ( have_posts() ) : ?>
				<ul class="igj-learn-cards row g-3 g-lg-4 list-unstyled">
					<?php while ( have_posts() ) : the_post(); ?>
						<li class="col-12 col-md-6 col-lg-4">
							<article class="igj-learn-card">
								<p class="small text-muted mb-1"><?php echo esc_html( get_post_type() === "page" ? __( "Page", "pegasus" ) : __( "Guide", "pegasus" ) ); ?></p>
								<h2 class="igj-learn-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<p class="igj-learn-card__excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
							</article>
						</li>
					<?php endwhile; ?>
				</ul>
				<?php the_posts_pagination(); ?>
			<?php else : ?>
				<p><?php esc_html_e( 'No results found. Try different words, browse our services, or call Joe.', 'pegasus' ); ?></p>
			<?php endif; ?>
		</div>
	</section>
	<?php get_template_part( 'templates/igj-cta-band' ); ?>
</main>
</div>
<?php get_footer(); ?>
