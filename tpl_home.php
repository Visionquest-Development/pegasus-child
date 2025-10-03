
<?php /* Template Name: Home Template */ ?>
	<?php get_header(); ?>
	<div id="home-content">

		<div class="home-slider">
		<?php /*
			echo do_shortcode('[slider]
				[slide class="testing"]
					<div class="p-relative slide-1">
						<div class="home-slider-text">
							<h2>Welcome to <br>Our Pals Place!</h2>
						</div>
						<img class="alignnone size-full wp-image-12" src="//www.opp.ourpalsplace.org/wp-content/themes/pegasus-child/images/slider/1.jpg" />
					</div>
				[/slide]
				[slide]
					<div class="p-relative slide-2">
						<div class="home-slider-text pull-left">
							<h2>Want to make a difference?</h2><br /><h2>Volunteer with us!</h2><br />
							<button class="opp-button center" id="opp-button-1">Learn More</button>
						</div>
						<img class="alignnone size-full wp-image-12" src="//www.opp.ourpalsplace.org/wp-content/themes/pegasus-child/images/slider/4.jpg" />
					</div>
				[/slide]
				[slide]
					<div class="p-relative slide-3">
						<div class="home-slider-text pull-left">
							<h2>Apply to be a 2025 Animal Advocate Intern!</h2><br />
							<button class="opp-button center" id="opp-button-2">Learn More</button>
						</div>
						<img class="alignnone size-full wp-image-12" src="//www.opp.ourpalsplace.org/wp-content/themes/pegasus-child/images/slider/2.jpg" />
					</div>
				[/slide]
				[slide]
					<div class="p-relative slide-4">
						<div class="home-slider-text pull-right">
							<h2>Camp O.P.P. 2025 Registration is now open!</h2><br />
							<button class="opp-button center" id="opp-button-3">Learn More</button>
						</div>
						<img class="alignnone size-full wp-image-12" src="//www.opp.ourpalsplace.org/wp-content/themes/pegasus-child/images/slider/3.jpg" />
					</div>
				[/slide]
				[slide]
					<div class="p-relative slide-5">
						<div class="home-slider-text ">
							<h2>Your support saves lives.<h2><br />
							<button class="opp-button center" id="opp-button-4">Donate</button>
						</div>
						<img class="alignnone size-full wp-image-12" src="//www.opp.ourpalsplace.org/wp-content/themes/pegasus-child/images/slider/5.jpg" />
					</div>
				[/slide]
			[/slider]' ); */
		?>
		<?php
			echo do_shortcode('[vqd_home_slider]');
		?>
		</div>
		<?php /*
		<section class="home-middle-info clearfix">
			<div class="container-fluid">

				<div class="row">

					<div class="col-lg-3 home-images">
						<a id="a" href="//www.dbt.ourpalsplace.org/" target="_blank">
							<div class="home-img-bkg home-img-3" style="background-image: url('//opp.ourpalsplace.org/wp-content/uploads/2020/03/Logo-DBT.jpg');">
								<!--<img src="//opp.ourpalsplace.org/wp-content/uploads/2020/03/Logo-DBT.jpg" />-->
							</div>
						</a>
					</div>

					<div class="col-lg-3 home-images">
						<a id="" href="//opp.ourpalsplace.org/?page_id=396">
							<div class="home-img-bkg home-img-3" style="background-image: url('//opp.ourpalsplace.org/wp-content/uploads/2019/11/logo_upscale-thrift-shopping.jpg');">
								<!--<img src="//opp.ourpalsplace.org/wp-content/uploads/2019/11/logo_upscale-thrift-shopping.jpg" />-->
							</div>
						</a>
					</div>

					<div class="col-lg-3 home-images">
						<a id="" href="//www.opp.ourpalsplace.org/camp-opp-2025/">
							<div class="home-img-bkg home-img-5" style="background-image: url('//opp.ourpalsplace.org/wp-content/uploads/2020/03/Camp_OPP_Logo_2011.jpg');">
								<!--<img src="//opp.ourpalsplace.org/wp-content/uploads/2020/03/Camp_OPP_Logo_2011.jpg" />-->
							</div>
						</a>
					</div>

					<div class="col-lg-3 home-images">
						<a id="" href="https://www.opp.ourpalsplace.org/camp-counselors/">
							<div class="home-img-bkg home-img-5" style="background-image: url('https://www.opp.ourpalsplace.org/wp-content/uploads/2022/04/web_site_camp_counselors_link.jpg');">
								<!--<img src="//www.opp.ourpalsplace.org/wp-content/uploads/2022/04/web_site_camp_counselors_link.jpg" />-->
							</div>
						</a>
					</div>

				</div>
			</div><!-- /.container -->

		</section>
		*/ ?>

		<section class="home-bkg-color home-pets" >
			<!--<h2>Find your Newest Family Member</h2>-->
			<a href="http://opp.ourpalsplace.org/meet-our-dogs/" class="opp-button center">Find Your Best Match</a>
			<div class="pets-slider">
			<?php
				$query = new WP_Query(array(
					'post_type' => array('pets'),
					'petcategory' => 'dogs',
					'posts_per_page' => -1,
					'order' => 'ASC',
					'orderby' => 'title'
				));

				if ($query->have_posts()) : ?>

				<?php while ($query->have_posts()) : $query->the_post();
					$thumb_url = has_post_thumbnail() ? wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large')[0] : get_template_directory_uri() . "/images/banner.png";
				?>
				<div class="pet-cards-wrap justify-content-center py-5">
					<div class="pet-box">
						<div class="pet-image" style="background-image: url('<?php echo esc_url($thumb_url); ?>');">
						<div class="pet-overlay">
							<a href="<?php the_permalink(); ?>" class="pet-name">
							<?php the_title(); ?>
							</a>
						</div>
						</div>
					</div>
				</div>
				<?php endwhile; ?>

				<?php endif;
				wp_reset_postdata();
			?>

			</div><!--end -col-md-4-->
					<br>
			<a href="http://opp.ourpalsplace.org/meet-our-dogs/" class="opp-button center">View All</a>
			<!--<a href="http://opp.ourpalsplace.org/meet-our-cats/" class="opp-button">Meet All Our Cats</a>-->
		</section>


		<section class="">

			<?php
				$services_json = '[
				{
					"title": "Our Pal\'s Place Daycare, Boarding, & Training",
					"image": "//opp.ourpalsplace.org/wp-content/uploads/2020/03/Logo-DBT.jpg",
					"link": "https://www.dbt.ourpalsplace.org/"
				},
				{
					"title": "ReHome Superstore",
					"image": "//opp.ourpalsplace.org/wp-content/uploads/2019/11/logo_upscale-thrift-shopping.jpg",
					"link": "/rehome-superstore"
				}
				]';
				
				/*
				{
					"title": "Camp OPP 2025",
					"image": "//opp.ourpalsplace.org/wp-content/uploads/2020/03/Camp_OPP_Logo_2011.jpg",
					"link": "/camp-opp-2025"
				},
				{
					"title": "Camp Counselors",
					"image": "//www.opp.ourpalsplace.org/wp-content/uploads/2022/04/web_site_camp_counselors_link.jpg",
					"link": "/camp-counselors"
				}
				
				*/

				$services = json_decode($services_json, true);
			?>

				<div class="services-container container-fluid py-3 mb-5">
					<h2 class="text-center mb-5">Our Services</h2>
					<div class="row g-4">
						<?php foreach ($services as $service): ?>
						<div class="col-6">
							<div class="card h-100  shadow-sm rounded-1 overflow-hidden">
							<div class="row g-0 h-100">
								<div class="col-12 col-lg-8">
									<img src="<?php echo esc_url($service['image']); ?>" alt="<?php echo esc_attr($service['title']); ?>" class="img-fluid h-100 w-100 object-fit-cover">
								</div>
								<div class="col-12 col-lg-4 d-flex flex-column justify-content-between  p-4">
									<h5 class="fw-bold mb-3"><?php echo esc_html($service['title']); ?></h5>
									<a href="<?php echo esc_url($service['link']); ?>" class=" opp-button center mt-auto align-self-start">Learn More</a>
								</div>
							</div>
							</div>
						</div>
						<?php endforeach; ?>
					</div>
				</div>


		</section>



		<div class="container-fluid home-opp-content ">
			<div class="content-no-sidebar row">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<?php //the_content(); ?>
				<?php endwhile; else: ?>
					<?php /* kinda a 404 of sorts when not working */ ?>
					<div class="page-header">
						<h1>Oh no!</h1>
					</div>
					<p>No content is appearing for this page!</p>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<!-- end page wrap -->
    <?php get_footer(); ?>
