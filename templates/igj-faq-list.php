<?php
/**
 * Accessible FAQ list using <details>/<summary> (no JS needed).
 * Args: items ([q,a]), title (H2, optional), id.
 */
$args  = isset( $args ) && is_array( $args ) ? $args : array();
$items = $args['items'] ?? array();
$title = $args['title'] ?? '';
$hl    = $args['heading_level'] ?? 'h2';
if ( empty( $items ) ) {
	return;
}
?>
<div class="igj-faq" <?php echo ! empty( $args['id'] ) ? 'id="' . esc_attr( $args['id'] ) . '"' : ''; ?>>
	<?php if ( $title ) : ?>
		<<?php echo esc_html( $hl ); ?> class="igj-section-title"><?php echo esc_html( $title ); ?></<?php echo esc_html( $hl ); ?>>
	<?php endif; ?>
	<?php foreach ( $items as $f ) : ?>
		<details class="igj-faq__item">
			<summary><?php echo esc_html( igj_plain( $f['q'] ) ); ?></summary>
			<div class="igj-faq__answer"><p><?php echo wp_kses_post( igj_render( $f['a'] ) ); ?></p></div>
		</details>
	<?php endforeach; ?>
</div>
