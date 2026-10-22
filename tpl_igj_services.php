<?php
/*
	Template Name: IGJ Services Hub
*/
get_header();
$groups = array(
	__( 'Individuals & families', 'pegasus' )         => array( 'individual-family-health-insurance', 'turning-26-health-insurance', 'early-retiree-health-insurance' ),
	__( 'Self-employed, 1099 & business owners', 'pegasus' ) => array( 'self-employed-health-insurance', 'health-insurance-for-1099', 'small-business-health-insurance', 'realtor-health-insurance', 'travel-nurse-health-insurance' ),
	__( 'Plan types & coverage changes', 'pegasus' )  => array( 'aca-marketplace-health-insurance', 'private-health-insurance', 'cobra-alternatives' ),
	__( 'Supplemental coverage', 'pegasus' )          => array( 'supplemental-insurance', 'dental-vision-insurance' ),
);
?>
<div id="page-wrap">
<main id="primary" class="site-main igj igj-services">
	<?php
	get_template_part( 'templates/igj-page-hero', null, array(
		'title' => __( 'Health Insurance Services', 'pegasus' ),
		'lead'  => __( 'Whatever your situation, from a new family to a new business, a job change or early retirement, Joe helps you find coverage that fits. Pick the one that sounds like you.', 'pegasus' ),
	) );
	?>
	<?php foreach ( $groups as $label => $slugs ) : ?>
		<section class="igj-section igj-section--compact" aria-labelledby="g-<?php echo esc_attr( sanitize_title( $label ) ); ?>">
			<div class="container">
				<h2 id="g-<?php echo esc_attr( sanitize_title( $label ) ); ?>" class="igj-section-title"><?php echo esc_html( $label ); ?></h2>
				<?php get_template_part( 'templates/igj-service-cards', null, array( 'slugs' => $slugs, 'heading_level' => 'h3' ) ); ?>
			</div>
		</section>
	<?php endforeach; ?>

	<section class="igj-section igj-section--tint">
		<div class="container">
			<div class="row g-4">
				<div class="col-lg-6 igj-prose">
					<h2 class="igj-section-title"><?php esc_html_e( 'Not sure where you fit?', 'pegasus' ); ?></h2>
					<p><?php esc_html_e( 'Many people fit more than one category, like a self-employed parent covering a family, or an early retiree weighing COBRA. That’s normal. A short call with Joe sorts out which options are actually open to you, and when you can enroll.', 'pegasus' ); ?></p>
					<?php
					while ( have_posts() ) :
						the_post();
						the_content();
					endwhile;
					?>
				</div>
				<div class="col-lg-6">
					<h2 class="igj-section-title"><?php esc_html_e( 'Start with the basics', 'pegasus' ); ?></h2>
					<ul class="igj-linklist">
						<li><a href="<?php echo esc_url( igj_learn_url( 'aca-vs-private-health-insurance' ) ); ?>"><?php echo esc_html( igj_learn_title( 'aca-vs-private-health-insurance' ) ); ?></a></li>
						<li><a href="<?php echo esc_url( igj_learn_url( 'open-enrollment-guide' ) ); ?>"><?php echo esc_html( igj_learn_title( 'open-enrollment-guide' ) ); ?></a></li>
						<li><a href="<?php echo esc_url( igj_learn_url( 'ppo-vs-hmo-vs-epo' ) ); ?>"><?php echo esc_html( igj_learn_title( 'ppo-vs-hmo-vs-epo' ) ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/faq/' ) ); ?>"><?php esc_html_e( 'Health insurance FAQs', 'pegasus' ); ?></a></li>
					</ul>
				</div>
			</div>
		</div>
	</section>

	<?php get_template_part( 'templates/igj-cta-band' ); ?>
</main>
</div>
<?php get_footer(); ?>
