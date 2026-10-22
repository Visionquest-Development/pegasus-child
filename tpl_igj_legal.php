<?php
/*
	Template Name: IGJ Legal (Privacy / Disclaimers)
*/
get_header();
$slug = get_post_field( 'post_name', get_queried_object_id() );
?>
<div id="page-wrap">
<main id="primary" class="site-main igj igj-legal">
	<?php get_template_part( 'templates/igj-page-hero', null, array( 'cta' => false ) ); ?>
	<section class="igj-section">
		<div class="container igj-prose igj-prose--narrow">
			<?php if ( igj_show_todos() ) : ?>
				<div class="igj-alert igj-alert--warn" role="note"><strong><?php esc_html_e( 'Draft:', 'pegasus' ); ?></strong> <?php esc_html_e( 'this page is a starting draft and must be reviewed by Joe (and ideally his agency or an attorney) before launch. It is not legal advice.', 'pegasus' ); ?></div>
			<?php endif; ?>
			<?php
			while ( have_posts() ) :
				the_post();
				if ( trim( get_the_content() ) ) {
					the_content();
				} else {
					$file = get_stylesheet_directory() . '/content/legal/' . sanitize_file_name( $slug ) . '.html';
					if ( is_readable( $file ) ) {
						echo wp_kses_post( igj_render( file_get_contents( $file ) ) );
					}
				}
			endwhile;
			?>
		</div>
	</section>
</main>
</div>
<?php get_footer(); ?>
