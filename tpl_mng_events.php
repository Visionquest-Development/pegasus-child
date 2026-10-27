<?php
/*
	Template Name: MNG Events
*/
get_header();
$site = mng_data( 'site' );
?>
<div id="page-wrap">
<main id="primary" class="site-main mng mng-events-page">
	<?php get_template_part( 'templates/mng-page-hero', null, array( 'image' => 'pitmaster-1', 'eyebrow' => __( 'Catch the smoker', 'pegasus' ), 'title' => get_the_title(), 'lead' => $site['events']['intro'] ?? '' ) ); ?>
	<section class="mng-events-band">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-9">
					<?php
					while ( have_posts() ) :
						the_post();
						if ( trim( get_the_content() ) ) {
							echo '<div class="mng-intro__content mb-4">';
							the_content();
							echo '</div>';
						}
					endwhile;
					?>
					<h2 class="mng-section-title wow fadeInUp"><?php esc_html_e( 'Where We\'ll Be Next', 'pegasus' ); ?></h2>
					<?php get_template_part( 'templates/mng-events', null, array( 'limit' => 0, 'show_past' => true ) ); ?>
					<p class="mt-4"><?php esc_html_e( 'Want Mr Nice Guy at your festival, school or community event?', 'pegasus' ); ?> <a class="mng-link" href="<?php echo esc_url( mng_page_url( 'tpl_mng_catering.php', 'catering' ) ); ?>"><?php esc_html_e( 'Book us', 'pegasus' ); ?> <span aria-hidden="true">→</span></a></p>
				</div>
			</div>
		</div>
	</section>
</main>
</div>
<?php get_footer(); ?>
