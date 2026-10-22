<?php
/*
	Template Name: Specials Template
*/
get_header();
$site = rusans_data( 'site' );
?>
<div id="page-wrap">
<main id="primary" class="site-main rusans rusans-specials">

	<?php
	get_template_part( 'templates/rusans-page-hero', null, array(
		'image' => 'hero-sushi-combo',
		'title' => get_the_title() ? get_the_title() : __( 'Specials', 'pegasus' ),
	) );
	?>

	<div class="container py-5">
		<div class="row g-4">
			<div class="col-lg-7">
				<?php
				/* TODO (site.json specials.todo): the live site lists no current specials. Add them as page content, or leave this page out of the menu. */
				$has_content = false;
				while ( have_posts() ) :
					the_post();
					if ( trim( get_the_content() ) ) {
						$has_content = true;
						the_content();
					}
				endwhile;
				if ( ! $has_content ) :
					?>
					<p class="rusans-lead wow fadeInUp"><?php echo esc_html( $site['specials']['text'] ?? '' ); ?></p>
				<?php endif; ?>
			</div>
			<div class="col-lg-5">
				<div class="rusans-panel wow fadeInRight">
					<h2 class="rusans-panel__title"><?php esc_html_e( 'Give Back Nights', 'pegasus' ); ?></h2>
					<p><?php echo esc_html( $site['specials']['giveback'] ?? '' ); ?></p>
					<a class="btn rusans-btn rusans-btn--primary" href="mailto:<?php echo esc_attr( $site['email_catering'] ?? '' ); ?>?subject=<?php echo rawurlencode( 'Give back night' ); ?>"><?php esc_html_e( 'Contact us', 'pegasus' ); ?></a>
				</div>
			</div>
		</div>
	</div>

	<?php get_template_part( 'templates/rusans-order-cta' ); ?>

</main>
</div><!-- end page wrap -->
<?php get_footer(); ?>
