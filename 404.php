<?php
/**
 * 404 with a single H1 and links to the main sections.
 */
get_header();
?>
<div id="page-wrap">
<main id="primary" class="site-main igj igj-404">
	<?php get_template_part( 'templates/igj-page-hero', null, array( 'title' => __( 'Page not found', 'pegasus' ), 'lead' => __( 'That page may have moved. Try one of these instead, or call Joe.', 'pegasus' ) ) ); ?>
	<section class="igj-section">
		<div class="container">
			<h2 class="igj-section-title"><?php esc_html_e( 'Health insurance services', 'pegasus' ); ?></h2>
			<?php get_template_part( 'templates/igj-service-cards', null, array( 'heading_level' => 'h3' ) ); ?>
		</div>
	</section>
</main>
</div>
<?php get_footer(); ?>
