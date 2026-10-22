<?php
/**
 * Grid of service cards. Args: slugs (array, default all), heading_level (h2/h3), exclude (slug).
 */
$args  = isset( $args ) && is_array( $args ) ? $args : array();
$all   = igj_services();
$slugs = $args['slugs'] ?? array_keys( $all );
$hl    = $args['heading_level'] ?? 'h3';
$i     = 0;
?>
<ul class="igj-cards row g-3 g-lg-4 list-unstyled">
	<?php foreach ( $slugs as $slug ) : ?>
		<?php
		if ( empty( $all[ $slug ] ) || ( ! empty( $args['exclude'] ) && $args['exclude'] === $slug ) ) {
			continue;
		}
		$s = $all[ $slug ];
		?>
		<li class="col-12 col-sm-6 col-lg-4 wow fadeInUp" data-wow-delay="<?php echo esc_attr( ( ( $i++ % 3 ) * 0.06 ) . 's' ); ?>">
			<a class="igj-card" href="<?php echo esc_url( igj_service_url( $slug ) ); ?>">
				<span class="igj-card__icon" aria-hidden="true"><i class="fa <?php echo esc_attr( $s['icon'] ?? 'fa-heartbeat' ); ?>"></i></span>
				<<?php echo esc_html( $hl ); ?> class="igj-card__title"><?php echo esc_html( $s['title'] ); ?></<?php echo esc_html( $hl ); ?>>
				<span class="igj-card__text"><?php echo esc_html( $s['summary'] ); ?></span>
				<span class="igj-card__more"><?php esc_html_e( 'Learn more', 'pegasus' ); ?> <i class="fa fa-angle-right" aria-hidden="true"></i></span>
			</a>
		</li>
	<?php endforeach; ?>
</ul>
