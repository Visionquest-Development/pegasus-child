<?php
/**
 * Visible breadcrumbs (same trail as the BreadcrumbList JSON-LD).
 */
$trail = igj_breadcrumbs();
if ( count( $trail ) < 2 ) {
	return;
}
$last = count( $trail ) - 1;
?>
<nav class="igj-breadcrumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'pegasus' ); ?>">
	<ol>
		<?php foreach ( $trail as $i => $crumb ) : ?>
			<li>
				<?php if ( $i === $last ) : ?>
					<span aria-current="page"><?php echo esc_html( wp_strip_all_tags( $crumb[0] ) ); ?></span>
				<?php else : ?>
					<a href="<?php echo esc_url( $crumb[1] ); ?>"><?php echo esc_html( wp_strip_all_tags( $crumb[0] ) ); ?></a>
				<?php endif; ?>
			</li>
		<?php endforeach; ?>
	</ol>
</nav>
