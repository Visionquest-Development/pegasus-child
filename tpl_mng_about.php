<?php
/*
	Template Name: MNG About
*/
get_header();
$site  = mng_data( 'site' );
$about = $site['about'] ?? array();
?>
<div id="page-wrap">
<main id="primary" class="site-main mng mng-about">
	<?php get_template_part( 'templates/mng-page-hero', null, array( 'image' => 'pitmaster-2', 'eyebrow' => __( 'Meet Mr. Nice Guy', 'pegasus' ), 'title' => get_the_title(), 'lead' => $site['slogans'][0] ?? '' ) ); ?>

	<section class="mng-split">
		<div class="container">
			<div class="row align-items-center g-4 g-lg-5">
				<div class="col-lg-5 wow fadeInLeft">
					<div class="mng-photo-pair">
						<?php echo mng_picture( 'pitmaster-1', array( 'class' => 'mng-rounded', 'sizes' => '(min-width: 992px) 25vw, 60vw' ) ); // phpcs:ignore ?>
						<?php echo mng_picture( 'smoked-chicken', array( 'class' => 'mng-rounded', 'sizes' => '(min-width: 992px) 20vw, 50vw' ) ); // phpcs:ignore ?>
					</div>
				</div>
				<div class="col-lg-7 wow fadeInRight">
					<p class="mng-script"><?php esc_html_e( 'Founder & pitmaster', 'pegasus' ); ?></p>
					<h2 class="mng-section-title"><?php echo esc_html( $site['chef']['name'] ?? '' ); ?></h2>
					<p class="mng-lead"><?php echo esc_html( $about['story'] ?? '' ); ?></p>
					<p><?php echo esc_html( $about['promise'] ?? '' ); ?></p>
					<?php
					while ( have_posts() ) :
						the_post();
						the_content();
					endwhile;
					?>
				</div>
			</div>
		</div>
	</section>

	<section class="mng-pillars mng-split--dark">
		<div class="container">
			<div class="row g-4">
				<div class="col-md-4 wow fadeInUp">
					<div class="mng-pillar"><i class="fa fa-heart" aria-hidden="true"></i><h2 class="mng-pillar__title"><?php esc_html_e( 'Our Mission', 'pegasus' ); ?></h2><p><?php echo esc_html( $about['mission'] ?? '' ); ?></p></div>
				</div>
				<div class="col-md-4 wow fadeInUp" data-wow-delay=".1s">
					<div class="mng-pillar"><i class="fa fa-fire" aria-hidden="true"></i><h2 class="mng-pillar__title"><?php esc_html_e( 'Our Vision', 'pegasus' ); ?></h2><p><?php echo esc_html( $about['vision'] ?? '' ); ?></p></div>
				</div>
				<div class="col-md-4 wow fadeInUp" data-wow-delay=".2s">
					<div class="mng-pillar"><i class="fa fa-star" aria-hidden="true"></i><h2 class="mng-pillar__title"><?php esc_html_e( 'What We Believe', 'pegasus' ); ?></h2>
						<ul class="mng-checks"><?php foreach ( (array) ( $about['values'] ?? array() ) as $v ) : ?><li><?php echo esc_html( $v ); ?></li><?php endforeach; ?></ul>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="mng-intro">
		<div class="container text-center">
			<blockquote class="mng-quote mng-quote--big wow fadeInUp"><?php echo esc_html( $about['facebook_intro'] ?? '' ); ?></blockquote>
		</div>
	</section>

	<?php get_template_part( 'templates/mng-order-cta' ); ?>
</main>
</div>
<?php get_footer(); ?>
