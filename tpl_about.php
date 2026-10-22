<?php
/*
	Template Name: About Template
*/
get_header();
$site = rusans_data( 'site' );
$facts = array(
	sprintf( __( 'Serving Kennesaw since %s', 'pegasus' ), $site['since'] ?? '' ),
	__( 'Locally owned and operated', 'pegasus' ),
	__( 'Fresh sushi and seafood daily', 'pegasus' ),
	__( 'Only 5 minutes from Kennesaw State University', 'pegasus' ),
	__( 'Free Wi-Fi and 5 flat-screen TVs', 'pegasus' ),
	__( 'Lunch, dinner, catering and take-out', 'pegasus' ),
	__( 'Groups welcome: birthdays, family reunions, business luncheons', 'pegasus' ),
);
?>
<div id="page-wrap">
<main id="primary" class="site-main rusans rusans-about">

	<?php
	get_template_part( 'templates/rusans-page-hero', null, array(
		'image'   => 'hero-sashimi',
		'eyebrow' => $site['tagline'] ?? '',
		'title'   => get_the_title() ? get_the_title() : __( 'About Us', 'pegasus' ),
	) );
	?>

	<section class="rusans-split">
		<div class="container">
			<div class="row g-4 g-lg-5 align-items-center">
				<div class="col-lg-6 wow fadeInLeft">
					<p class="rusans-eyebrow"><?php printf( esc_html__( 'Since %s', 'pegasus' ), esc_html( $site['since'] ?? '' ) ); ?></p>
					<h2 class="rusans-section-title"><?php esc_html_e( 'The Original Japanese Seafood & Sushi Restaurant in Kennesaw', 'pegasus' ); ?></h2>
					<p class="rusans-lead"><?php echo esc_html( $site['about']['long'] ?? '' ); ?></p>
					<?php
					while ( have_posts() ) :
						the_post();
						the_content();
					endwhile;
					?>
				</div>
				<div class="col-lg-6 wow fadeInRight">
					<div class="rusans-stack">
						<?php echo rusans_picture( 'storefront', array( 'class' => 'rusans-rounded rusans-stack__a', 'sizes' => '(min-width: 992px) 40vw, 100vw' ) ); // phpcs:ignore ?>
						<?php echo rusans_picture( 'dining-room', array( 'class' => 'rusans-rounded rusans-stack__b', 'sizes' => '(min-width: 992px) 25vw, 60vw' ) ); // phpcs:ignore ?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="rusans-facts-list">
		<div class="container">
			<ul class="rusans-checklist">
				<?php foreach ( $facts as $i => $fact ) : ?>
					<li class="wow fadeInUp" data-wow-delay="<?php echo esc_attr( ( $i * 0.05 ) . 's' ); ?>"><i class="fa fa-check" aria-hidden="true"></i> <?php echo esc_html( $fact ); ?></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>

	<section class="rusans-cta-band" style="<?php echo esc_attr( rusans_bg_style( 'guest-rolls' ) ); ?>">
		<div class="container text-center">
			<h2 class="rusans-section-title wow fadeInUp"><?php esc_html_e( 'Brush up on your Sushi Knowledge', 'pegasus' ); ?></h2>
			<?php /* TODO: the 11 "Sushi Knowledge" blog posts from the current site need to be imported for this link to work. */ ?>
			<a class="btn rusans-btn rusans-btn--light wow fadeInUp" href="<?php echo esc_url( home_url( '/category/sushi-knowledge/' ) ); ?>"><?php esc_html_e( 'All blog posts', 'pegasus' ); ?></a>
		</div>
	</section>

</main>
</div><!-- end page wrap -->
<?php get_footer(); ?>
