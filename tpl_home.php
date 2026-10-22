<?php
/*
	Template Name: Home Template
*/
get_header();

$site     = rusans_data( 'site' );
$features = $site['about']['features'] ?? array();
$slides   = array(
	array( 'image' => 'hero-rolls',           'line' => __( 'Japanese Seafood & Sushi', 'pegasus' ) ),
	array( 'image' => 'hero-sashimi',         'line' => __( 'Take out & Delivery', 'pegasus' ) ),
	array( 'image' => 'hero-sashimi-platter', 'line' => __( 'Party Platters & Catering', 'pegasus' ) ),
	array( 'image' => 'hero-sushi-combo',     'line' => __( 'Deliciously Fulfilling & Economically Priced', 'pegasus' ) ),
);
$menu_url     = home_url( '/menu/' );
$catering_url = home_url( '/catering/' );
$gallery      = array( 'gallery-rising-sun', 'gallery-sushi-sashimi', 'gallery-eel-roll', 'gallery-pepper-tuna', 'gallery-sashimi-plate', 'gallery-gone-with-the-wind', 'gallery-nigiri-board', 'gallery-tempura-roll' );
?>
<div id="page-wrap">
<main id="primary" class="site-main rusans rusans-home">

	<?php /* HERO — slippry (pegasus-slider) when available, CSS/JS fade fallback otherwise. */ ?>
	<section class="rusans-hero" aria-label="<?php esc_attr_e( 'Featured dishes', 'pegasus' ); ?>">
		<ul class="rusans-hero__slides" data-rusans-hero>
			<?php foreach ( $slides as $i => $slide ) : ?>
				<li class="rusans-hero__slide<?php echo 0 === $i ? ' is-active' : ''; ?>">
					<?php echo rusans_picture( $slide['image'], array( 'class' => 'rusans-hero__img', 'eager' => 0 === $i, 'lazy' => false, 'sizes' => '100vw' ) ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
					<span class="rusans-hero__caption"><?php echo esc_html( $slide['line'] ); ?></span>
				</li>
			<?php endforeach; ?>
		</ul>
		<div class="rusans-hero__overlay"></div>
		<div class="container rusans-hero__content">
			<p class="rusans-eyebrow wow fadeInDown"><?php printf( esc_html__( 'Kennesaw, GA · Since %s', 'pegasus' ), esc_html( $site['since'] ?? '' ) ); ?></p>
			<h1 class="rusans-hero__title wow fadeInUp">
				<?php echo esc_html( $site['name'] ?? '' ); ?>
				<span class="rusans-hero__sub"><?php esc_html_e( 'Japanese Seafood & Sushi on Barrett Parkway', 'pegasus' ); ?></span>
			</h1>
			<div class="rusans-hero__actions wow fadeInUp" data-wow-delay=".2s">
				<a class="btn rusans-btn rusans-btn--primary" href="<?php echo esc_url( $menu_url ); ?>"><?php esc_html_e( 'View Menu', 'pegasus' ); ?></a>
				<a class="btn rusans-btn rusans-btn--light" href="#order"><?php esc_html_e( 'Order Now', 'pegasus' ); ?></a>
				<a class="btn rusans-btn rusans-btn--ghost" href="tel:<?php echo esc_attr( $site['phone_e164'] ?? '' ); ?>"><i class="fa fa-phone" aria-hidden="true"></i> <?php echo esc_html( $site['phone_display'] ?? '' ); ?></a>
			</div>
		</div>
	</section>

	<?php /* QUICK FACTS */ ?>
	<section class="rusans-facts" aria-label="<?php esc_attr_e( 'Hours and location', 'pegasus' ); ?>">
		<div class="container">
			<div class="row g-0">
				<div class="col-12 col-md-4 rusans-facts__item wow fadeInUp">
					<i class="fa fa-clock-o" aria-hidden="true"></i>
					<div>
						<p class="rusans-facts__label"><?php esc_html_e( 'Hours', 'pegasus' ); ?></p>
						<p class="rusans-facts__value"><?php echo esc_html( $site['hours_summary']['primary'] ?? '' ); ?><br><span><?php echo esc_html( $site['hours_summary']['secondary'] ?? '' ); ?></span></p>
					</div>
				</div>
				<div class="col-12 col-md-4 rusans-facts__item wow fadeInUp" data-wow-delay=".1s">
					<i class="fa fa-map-marker" aria-hidden="true"></i>
					<div>
						<p class="rusans-facts__label"><?php esc_html_e( 'Find us', 'pegasus' ); ?></p>
						<p class="rusans-facts__value"><a href="<?php echo esc_url( $site['maps_url'] ?? '' ); ?>" target="_blank" rel="noopener"><?php echo esc_html( rusans_address_line() ); ?></a></p>
					</div>
				</div>
				<div class="col-12 col-md-4 rusans-facts__item wow fadeInUp" data-wow-delay=".2s">
					<i class="fa fa-phone" aria-hidden="true"></i>
					<div>
						<p class="rusans-facts__label"><?php esc_html_e( 'Takeout & reservations', 'pegasus' ); ?></p>
						<p class="rusans-facts__value"><a href="tel:<?php echo esc_attr( $site['phone_e164'] ?? '' ); ?>"><?php echo esc_html( $site['phone_display'] ?? '' ); ?></a></p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php /* INTRO */ ?>
	<section class="rusans-intro">
		<div class="container">
			<div class="row justify-content-center text-center">
				<div class="col-lg-8">
					<p class="rusans-eyebrow wow fadeIn"><?php esc_html_e( 'One word: Delicious', 'pegasus' ); ?></p>
					<h2 class="rusans-section-title wow fadeInUp"><?php echo esc_html( $site['about']['headline'] ?? '' ); ?></h2>
					<p class="rusans-lead wow fadeInUp" data-wow-delay=".1s"><?php echo esc_html( $site['about']['short'] ?? '' ); ?></p>
					<?php
					while ( have_posts() ) :
						the_post();
						if ( trim( get_the_content() ) ) {
							echo '<div class="rusans-intro__content">';
							the_content();
							echo '</div>';
						}
					endwhile;
					?>
				</div>
			</div>
		</div>
	</section>

	<?php /* FEATURES */ ?>
	<section class="rusans-features">
		<div class="container">
			<div class="row g-4">
				<?php foreach ( $features as $i => $f ) :
					$img = array( 'feature-calamari', 'feature-erika-roll', 'feature-entree' )[ $i ] ?? 'feature-calamari';
					?>
					<div class="col-12 col-md-4">
						<article class="rusans-card wow fadeInUp" data-wow-delay="<?php echo esc_attr( ( $i * 0.1 ) . 's' ); ?>">
							<a class="rusans-card__media" href="<?php echo esc_url( home_url( $f['link'] ) ); ?>" tabindex="-1" aria-hidden="true">
								<?php echo rusans_picture( $img, array( 'sizes' => '(min-width: 768px) 33vw, 100vw' ) ); // phpcs:ignore ?>
							</a>
							<div class="rusans-card__body">
								<h3 class="rusans-card__title"><?php echo esc_html( $f['title'] ); ?></h3>
								<p><?php echo esc_html( $f['text'] ); ?></p>
								<a class="rusans-link" href="<?php echo esc_url( home_url( $f['link'] ) ); ?>"><?php esc_html_e( 'View more', 'pegasus' ); ?> <span aria-hidden="true">→</span></a>
							</div>
						</article>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<?php get_template_part( 'templates/rusans-order-cta' ); ?>

	<?php /* CATERING TEASER */ ?>
	<section class="rusans-split">
		<div class="container">
			<div class="row align-items-center g-4 g-lg-5">
				<div class="col-lg-6 wow fadeInLeft">
					<?php echo rusans_picture( 'platter-deluxe', array( 'class' => 'rusans-rounded', 'sizes' => '(min-width: 992px) 50vw, 100vw' ) ); // phpcs:ignore ?>
				</div>
				<div class="col-lg-6 wow fadeInRight">
					<p class="rusans-eyebrow"><?php esc_html_e( 'Party Platters & Catering', 'pegasus' ); ?></p>
					<h2 class="rusans-section-title"><?php esc_html_e( 'Sushi Platters for Every Gathering', 'pegasus' ); ?></h2>
					<p><?php esc_html_e( 'We welcome groups for special events such as birthdays, family reunions and business luncheons. Sushi platters start at $55 and party platters at $25.', 'pegasus' ); ?></p>
					<a class="btn rusans-btn rusans-btn--primary" href="<?php echo esc_url( $catering_url ); ?>"><?php esc_html_e( 'See Catering Platters', 'pegasus' ); ?></a>
				</div>
			</div>
		</div>
	</section>

	<?php /* GALLERY STRIP — slick (pegasus-carousel) when available, scroll-snap row otherwise. */ ?>
	<section class="rusans-gallery-strip" aria-label="<?php esc_attr_e( 'Photo gallery', 'pegasus' ); ?>">
		<div class="rusans-gallery-strip__track" data-rusans-carousel>
			<?php foreach ( $gallery as $g ) : ?>
				<div class="rusans-gallery-strip__item">
					<?php echo rusans_picture( $g, array( 'sizes' => '(min-width: 992px) 25vw, 70vw' ) ); // phpcs:ignore ?>
				</div>
			<?php endforeach; ?>
		</div>
		<p class="text-center mt-4"><a class="rusans-link" href="<?php echo esc_url( home_url( '/gallery/' ) ); ?>"><?php esc_html_e( 'View the full gallery', 'pegasus' ); ?> <span aria-hidden="true">→</span></a></p>
	</section>

	<?php /* LOCATION */ ?>
	<section class="rusans-location" id="location">
		<div class="container">
			<div class="row g-4 align-items-stretch">
				<div class="col-lg-5 wow fadeInLeft">
					<p class="rusans-eyebrow"><?php esc_html_e( 'Visit us', 'pegasus' ); ?></p>
					<h2 class="rusans-section-title"><?php esc_html_e( 'Hours & Location', 'pegasus' ); ?></h2>
					<address class="rusans-location__nap">
						<strong><?php echo esc_html( $site['name'] ?? '' ); ?></strong><br>
						<?php echo esc_html( $site['address']['street'] ?? '' ); ?><br>
						<?php echo esc_html( ( $site['address']['city'] ?? '' ) . ', ' . ( $site['address']['region'] ?? '' ) . ' ' . ( $site['address']['postal'] ?? '' ) ); ?><br>
						<a href="tel:<?php echo esc_attr( $site['phone_e164'] ?? '' ); ?>"><?php echo esc_html( $site['phone_display'] ?? '' ); ?></a>
					</address>
					<?php get_template_part( 'templates/rusans-hours' ); ?>
					<a class="btn rusans-btn rusans-btn--primary mt-3" href="<?php echo esc_url( $site['maps_url'] ?? '' ); ?>" target="_blank" rel="noopener"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php esc_html_e( 'Get Directions', 'pegasus' ); ?></a>
				</div>
				<div class="col-lg-7 wow fadeInRight">
					<div class="rusans-map">
						<iframe title="<?php esc_attr_e( "Map to Ru San's Kennesaw", 'pegasus' ); ?>" src="<?php echo esc_url( $site['maps_embed'] ?? '' ); ?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
					</div>
				</div>
			</div>
		</div>
	</section>

</main>
</div><!-- end page wrap -->
<?php get_footer(); ?>
