<?php
/**
 * Learn article cards. Args: slugs (array) or query (WP_Query args), heading_level.
 */
$args = isset( $args ) && is_array( $args ) ? $args : array();
$hl   = $args['heading_level'] ?? 'h3';
$q    = new WP_Query( ! empty( $args['slugs'] ) ? array( 'post_name__in' => $args['slugs'], 'post_type' => 'post', 'posts_per_page' => count( $args['slugs'] ), 'orderby' => 'post_name__in', 'ignore_sticky_posts' => true ) : wp_parse_args( $args['query'] ?? array(), array( 'post_type' => 'post', 'posts_per_page' => 3, 'ignore_sticky_posts' => true ) ) );
if ( ! $q->have_posts() ) {
	return;
}
?>
<ul class="igj-learn-cards row g-3 g-lg-4 list-unstyled">
	<?php while ( $q->have_posts() ) : $q->the_post(); ?>
		<li class="col-12 col-md-6 col-lg-4 wow fadeInUp">
			<article class="igj-learn-card">
				<p class="igj-learn-card__meta"><?php echo esc_html( get_the_category() ? get_the_category()[0]->name : __( 'Guide', 'pegasus' ) ); ?></p>
				<<?php echo esc_html( $hl ); ?> class="igj-learn-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></<?php echo esc_html( $hl ); ?>>
				<p class="igj-learn-card__excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
				<a class="igj-learn-card__more" href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'Read: %s', 'pegasus' ), get_the_title() ) ); ?>"><?php esc_html_e( 'Read the guide', 'pegasus' ); ?> <i class="fa fa-angle-right" aria-hidden="true"></i></a>
			</article>
		</li>
	<?php endwhile; wp_reset_postdata(); ?>
</ul>
