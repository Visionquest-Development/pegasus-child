<?php
/*
	Template Name: MNG Home
*/
get_header();

$site         = mng_data( 'site' );
$menu_url     = mng_page_url( 'tpl_mng_menu.php', 'menu' );
$catering_url = mng_page_url( 'tpl_mng_catering.php', 'catering' );
$about_url    = mng_page_url( 'tpl_mng_about.php', 'about' );
$events_url   = mng_page_url( 'tpl_mng_events.php', 'events' );
$gallery_url  = mng_page_url( 'tpl_mng_gallery.php', 'gallery' );
$strip        = array_slice( (array) ( $site['gallery'] ?? array() ), 0, 10 );
?>
<div id="page-wrap">
<main id="primary" class="site-main mng mng-home">

	<?php /* HERO */ ?>
	<section class="mng-hero" aria-label="<?php esc_attr_e( 'Welcome', 'pegasus' ); ?>">
		<div class="mng-hero__embers" aria-hidden="true"></div>
		<div class="container">
			<div class="row align-items-center g-5">
				<div class="col-lg-6 mng-hero__copy">
					<p class="mng-script mng-hero__eyebrow wow fadeInDown"><?php echo esc_html( $site['tagline'] ?? '' ); ?></p>
					<h1 class="mng-hero__title wow fadeInUp">
						<span class="mng-hero__brand"><?php echo esc_html( $site['short_name'] ?? '' ); ?></span>
						<span class="mng-hero__sub"><?php esc_html_e( 'Smoked BBQ & Soul Food in Marietta, GA', 'pegasus' ); ?></span>
					</h1>
					<p class="mng-hero__lead wow fadeInUp" data-wow-delay=".1s"><?php echo esc_html( $site['about']['short'] ?? '' ); ?></p>
					<div class="mng-hero__actions wow fadeInUp" data-wow-delay=".2s">
						<a class="btn mng-btn mng-btn--fire" href="<?php echo esc_url( $menu_url ); ?>"><?php esc_html_e( 'See the Menu', 'pegasus' ); ?></a>
						<a class="btn mng-btn mng-btn--light" href="tel:<?php echo esc_attr( $site['phone_e164'] ?? '' ); ?>"><i class="fa fa-phone" aria-hidden="true"></i> <?php echo esc_html( $site['phone_display'] ?? '' ); ?></a>
						<a class="btn mng-btn mng-btn--ghost" href="<?php echo esc_url( $catering_url ); ?>"><?php esc_html_e( 'Catering', 'pegasus' ); ?></a>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="mng-hero__stack" aria-hidden="false">
						<div class="mng-polaroid mng-polaroid--a wow zoomIn"><?php echo mng_picture( 'smoker-racks', array( 'eager' => true, 'lazy' => false, 'sizes' => '(min-width: 992px) 30vw, 70vw' ) ); // phpcs:ignore ?></div>
						<div class="mng-polaroid mng-polaroid--b wow zoomIn" data-wow-delay=".15s"><?php echo mng_picture( 'smoked-brisket', array( 'lazy' => false, 'sizes' => '(min-width: 992px) 25vw, 55vw' ) ); // phpcs:ignore ?></div>
						<div class="mng-polaroid mng-polaroid--c wow zoomIn" data-wow-delay=".3s"><?php echo mng_picture( 'fried-fish-basket', array( 'lazy' => false, 'sizes' => '(min-width: 992px) 20vw, 45vw' ) ); // phpcs:ignore ?></div>
						<span class="mng-badge wow bounceIn" data-wow-delay=".5s"><?php esc_html_e( 'No small portions', 'pegasus' ); ?></span>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php /* SLOGAN TICKER */ ?>
	<div class="mng-ticker" aria-hidden="true">
		<div class="mng-ticker__track">
			<?php for ( $i = 0; $i < 2; $i++ ) : ?>
				<span><?php echo esc_html( implode( '  ★  ', array_merge( (array) $site['slogans'], array( 'Soul Food', 'BBQ', 'Seafood Fridays', 'Catering' ) ) ) ); ?>  ★  </span>
			<?php endfor; ?>
		</div>
	</div>

	<?php /* QUICK FACTS */ ?>
	<section class="mng-facts" aria-label="<?php esc_attr_e( 'Days, location and phone', 'pegasus' ); ?>">
		<div class="container">
			<div class="row g-0">
				<div class="col-12 col-md-4 mng-facts__item wow fadeInUp">
					<i class="fa fa-calendar" aria-hidden="true"></i>
					<div>
						<p class="mng-facts__label"><?php esc_html_e( 'Open', 'pegasus' ); ?></p>
						<p class="mng-facts__value"><?php echo esc_html( $site['hours_summary'] ?? '' ); ?></p>
					</div>
				</div>
				<div class="col-12 col-md-4 mng-facts__item wow fadeInUp" data-wow-delay=".1s">
					<i class="fa fa-map-marker" aria-hidden="true"></i>
					<div>
						<p class="mng-facts__label"><?php esc_html_e( 'Find us', 'pegasus' ); ?></p>
						<p class="mng-facts__value"><a href="<?php echo esc_url( $site['maps_url'] ?? '' ); ?>" target="_blank" rel="noopener"><?php echo esc_html( mng_address_line() ); ?></a></p>
					</div>
				</div>
				<div class="col-12 col-md-4 mng-facts__item wow fadeInUp" data-wow-delay=".2s">
					<i class="fa fa-phone" aria-hidden="true"></i>
					<div>
						<p class="mng-facts__label"><?php esc_html_e( 'Call to order', 'pegasus' ); ?></p>
						<p class="mng-facts__value"><?php echo mng_phone_link(); // phpcs:ignore ?></p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php /* WEEKLY MENU — one theme per day */ ?>
	<section class="mng-days">
		<div class="container">
			<div class="mng-section-head text-center">
				<p class="mng-script wow fadeIn"><?php esc_html_e( 'Something different every day', 'pegasus' ); ?></p>
				<h2 class="mng-section-title wow fadeInUp"><?php esc_html_e( 'The Weekly Menu', 'pegasus' ); ?></h2>
				<?php
				while ( have_posts() ) :
					the_post();
					if ( trim( get_the_content() ) ) {
						echo '<div class="mng-intro__content">';
						the_content();
						echo '</div>';
					}
				endwhile;
				?>
			</div>
			<div class="row g-4">
				<?php foreach ( (array) ( $site['days'] ?? array() ) as $i => $d ) : ?>
					<div class="col-12 col-sm-6 col-lg-3">
						<a class="mng-day wow fadeInUp" data-wow-delay="<?php echo esc_attr( ( $i * 0.1 ) . 's' ); ?>" href="<?php echo esc_url( $menu_url . '#' . $d['anchor'] ); ?>">
							<span class="mng-day__media"><?php echo mng_picture( $d['image'], array( 'sizes' => '(min-width: 992px) 25vw, (min-width: 576px) 50vw, 100vw' ) ); // phpcs:ignore ?></span>
							<span class="mng-day__body">
								<span class="mng-day__name"><?php echo esc_html( $d['day'] ); ?></span>
								<span class="mng-day__title"><?php echo esc_html( $d['title'] ); ?></span>
								<span class="mng-day__text"><?php echo esc_html( $d['text'] ); ?></span>
							</span>
						</a>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<?php /* FAN FAVORITES */ ?>
	<section class="mng-favs">
		<div class="container">
			<div class="mng-section-head text-center">
				<p class="mng-script wow fadeIn"><?php esc_html_e( 'Straight off the smoker', 'pegasus' ); ?></p>
				<h2 class="mng-section-title wow fadeInUp"><?php esc_html_e( 'Menu Highlights', 'pegasus' ); ?></h2>
			</div>
			<div class="row g-4">
				<?php foreach ( (array) ( $site['highlights'] ?? array() ) as $i => $h ) : ?>
					<div class="col-12 col-sm-6 col-lg-3">
						<article class="mng-fav wow fadeInUp" data-wow-delay="<?php echo esc_attr( ( $i * 0.1 ) . 's' ); ?>">
							<div class="mng-fav__wrap">
								<div class="mng-fav__media"><?php echo mng_picture( $h['image'], array( 'sizes' => '(min-width: 992px) 25vw, (min-width: 576px) 50vw, 100vw' ) ); // phpcs:ignore ?></div>
								<span class="mng-fav__price"><?php echo esc_html( $h['price'] ); ?></span>
							</div>
							<h3 class="mng-fav__name"><a href="<?php echo esc_url( home_url( $h['link'] ) ); ?>"><?php echo esc_html( $h['name'] ); ?></a></h3>
							<p class="mng-fav__day"><?php echo esc_html( $h['day'] ); ?></p>
						</article>
					</div>
				<?php endforeach; ?>
			</div>
			<p class="text-center mt-4"><a class="btn mng-btn mng-btn--fire" href="<?php echo esc_url( $menu_url ); ?>"><?php esc_html_e( 'Full Menu & Prices', 'pegasus' ); ?></a></p>
		</div>
	</section>

	<?php get_template_part( 'templates/mng-order-cta' ); ?>

	<?php /* ABOUT THE CHEF */ ?>
	<section class="mng-split mng-split--dark">
		<div class="container">
			<div class="row align-items-center g-4 g-lg-5">
				<div class="col-lg-5 wow fadeInLeft">
					<div class="mng-photo-pair">
						<?php echo mng_picture( 'pitmaster-2', array( 'class' => 'mng-rounded', 'sizes' => '(min-width: 992px) 25vw, 60vw' ) ); // phpcs:ignore ?>
						<?php echo mng_picture( 'glazed-closeup', array( 'class' => 'mng-rounded', 'sizes' => '(min-width: 992px) 20vw, 50vw' ) ); // phpcs:ignore ?>
					</div>
				</div>
				<div class="col-lg-7 wow fadeInRight">
					<p class="mng-script"><?php esc_html_e( 'Meet Mr. Nice Guy', 'pegasus' ); ?></p>
					<h2 class="mng-section-title"><?php echo esc_html( $site['chef']['name'] ?? '' ); ?></h2>
					<p class="mng-lead"><?php echo esc_html( $site['about']['story'] ?? '' ); ?></p>
					<blockquote class="mng-quote"><?php echo esc_html( $site['about']['facebook_intro'] ?? '' ); ?></blockquote>
					<a class="btn mng-btn mng-btn--fire" href="<?php echo esc_url( $about_url ); ?>"><?php esc_html_e( 'Our Story', 'pegasus' ); ?></a>
				</div>
			</div>
		</div>
	</section>

	<?php /* CATERING TEASER */ ?>
	<section class="mng-split">
		<div class="container">
			<div class="row align-items-center g-4 g-lg-5">
				<div class="col-lg-6 order-lg-2 wow fadeInRight">
					<?php echo mng_picture( 'smoker-meats', array( 'class' => 'mng-rounded', 'sizes' => '(min-width: 992px) 50vw, 100vw' ) ); // phpcs:ignore ?>
				</div>
				<div class="col-lg-6 order-lg-1 wow fadeInLeft">
					<p class="mng-script"><?php esc_html_e( 'Weddings · Reunions · Corporate', 'pegasus' ); ?></p>
					<h2 class="mng-section-title"><?php esc_html_e( 'Catering That Feeds Everybody', 'pegasus' ); ?></h2>
					<p><?php echo esc_html( $site['catering']['intro'] ?? '' ); ?></p>
					<ul class="mng-checks">
						<?php foreach ( (array) ( $site['catering']['features'] ?? array() ) as $f ) : ?>
							<li><strong><?php echo esc_html( $f['title'] ); ?>:</strong> <?php echo esc_html( $f['text'] ); ?></li>
						<?php endforeach; ?>
					</ul>
					<a class="btn mng-btn mng-btn--fire" href="<?php echo esc_url( $catering_url ); ?>"><?php esc_html_e( 'Plan Your Event', 'pegasus' ); ?></a>
				</div>
			</div>
		</div>
	</section>

	<?php /* EVENTS */ ?>
	<section class="mng-events-band" id="events">
		<div class="container">
			<div class="row g-4 align-items-center">
				<div class="col-lg-4 wow fadeInLeft">
					<p class="mng-script"><?php esc_html_e( 'Catch the smoker', 'pegasus' ); ?></p>
					<h2 class="mng-section-title"><?php esc_html_e( 'Upcoming Events', 'pegasus' ); ?></h2>
					<p><?php echo esc_html( $site['events']['intro'] ?? '' ); ?></p>
					<a class="mng-link" href="<?php echo esc_url( $events_url ); ?>"><?php esc_html_e( 'All events', 'pegasus' ); ?> <span aria-hidden="true">→</span></a>
				</div>
				<div class="col-lg-8">
					<?php get_template_part( 'templates/mng-events', null, array( 'limit' => 3 ) ); ?>
				</div>
			</div>
		</div>
	</section>

	<?php /* GALLERY STRIP — slick (pegasus-carousel) when available, scroll-snap row otherwise. */ ?>
	<section class="mng-gallery-strip" aria-label="<?php esc_attr_e( 'Photo gallery', 'pegasus' ); ?>">
		<div class="mng-gallery-strip__track" data-mng-carousel>
			<?php foreach ( $strip as $g ) : ?>
				<div class="mng-gallery-strip__item"><?php echo mng_picture( $g, array( 'sizes' => '(min-width: 992px) 25vw, 70vw' ) ); // phpcs:ignore ?></div>
			<?php endforeach; ?>
		</div>
		<p class="text-center mt-4"><a class="mng-link" href="<?php echo esc_url( $gallery_url ); ?>"><?php esc_html_e( 'View the full gallery', 'pegasus' ); ?> <span aria-hidden="true">→</span></a></p>
	</section>

	<?php if ( ! empty( $site['testimonials']['show'] ) ) : ?>
		<section class="mng-testimonials">
			<div class="container">
				<h2 class="mng-section-title text-center"><?php esc_html_e( 'What Folks Are Saying', 'pegasus' ); ?></h2>
				<div class="row g-4">
					<?php foreach ( (array) $site['testimonials']['list'] as $t ) : ?>
						<div class="col-md-4"><blockquote class="mng-quote mng-quote--card wow fadeInUp"><?php echo esc_html( $t ); ?></blockquote></div>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<?php /* LOCATION */ ?>
	<section class="mng-location" id="location">
		<div class="container">
			<div class="row g-4 align-items-stretch">
				<div class="col-lg-5 wow fadeInLeft">
					<p class="mng-script"><?php esc_html_e( 'Come hungry', 'pegasus' ); ?></p>
					<h2 class="mng-section-title"><?php esc_html_e( 'Days & Location', 'pegasus' ); ?></h2>
					<address class="mng-location__nap">
						<strong><?php echo esc_html( $site['name'] ?? '' ); ?></strong><br>
						<?php echo esc_html( mng_address_line() ); ?><br>
						<?php echo mng_phone_link(); // phpcs:ignore ?>
					</address>
					<?php get_template_part( 'templates/mng-hours' ); ?>
					<a class="btn mng-btn mng-btn--fire mt-3" href="<?php echo esc_url( $site['maps_url'] ?? '' ); ?>" target="_blank" rel="noopener"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php esc_html_e( 'Get Directions', 'pegasus' ); ?></a>
				</div>
				<div class="col-lg-7 wow fadeInRight">
					<div class="mng-map">
						<iframe title="<?php esc_attr_e( 'Map to Mr Nice Guy Authentic Soul Food', 'pegasus' ); ?>" src="<?php echo esc_url( $site['maps_embed'] ?? '' ); ?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
					</div>
				</div>
			</div>
		</div>
	</section>

</main>
</div><!-- end page wrap -->
<?php get_footer(); ?>
