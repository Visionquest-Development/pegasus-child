
<?php /* Template Name: Home Template */ ?>
	<?php get_header(); ?>
	<div id="home-content">


		<?php
			echo do_shortcode('[slider]
			[slide class="testing"]Welcome to Our Pals Place!<br /><img class="alignnone size-full wp-image-12" src="http://ourpalsplace.test/wp-content/wp-content/themes/pegasus-child/images/slider/1.jpg" alt="Gold-and-Black-Logo"/>[/slide]
			[slide]Want to make a difference?<br />Volunteer with us!<br /><img class="alignnone size-full wp-image-12" src="http://ourpalsplace.test/wp-content/wp-content/themes/pegasus-child/images/slider/2.jpg" alt="Gold-and-Black-Logo"/>[/slide]
			[slide]Apply to be a 2025 Animal Advocate Intern!<br /><img class="alignnone size-full wp-image-12" src="http://ourpalsplace.test/wp-content/wp-content/themes/pegasus-child/images/slider/3.jpg" alt="Gold-and-Black-Logo"/>[/slide]
			[slide]Camp O.P.P. 2025 Registration is now open!<br /><img class="alignnone size-full wp-image-12" src="http://ourpalsplace.test/wp-content/wp-content/themes/pegasus-child/images/slider/4.jpg" alt="Gold-and-Black-Logo"/>[/slide]
			[slide]Your support saves lives.<br /><img class="alignnone size-full wp-image-12" src="http://ourpalsplace.test/wp-content/wp-content/themes/pegasus-child/images/slider/5.jpg" alt="Gold-and-Black-Logo"/>[/slide]
			[/slider]' );
		?>

		<section class="home-middle-info clearfix">
			<div class="container-fluid">
				<!-- Three columns -->
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

		<section class="home-bkg-color home-pets" >
			<h2>Find your Newest Family Member</h2>

			<div class="pets-slider">
				<?php
					$query = new WP_Query(array(
						'post_type' => array( 'pets' ),
						'petcategory'          => 'dogs',
						//'term'=>$term->slug,
						'posts_per_page' => -1,
						'order'                  => 'ASC',
						'orderby'                => 'title'
					) );
					while ( $query->have_posts() ) : $query->the_post();
					?>

					<div class="pet pet-id-<?php the_ID(); ?>">
						<?php
						if ( has_post_thumbnail() ) {
						$thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full', false, '' );
						}else{
						$thumb_url = array( get_template_directory_uri() . "/images/banner.png", "1");
						}
						?>

							<!--<img class="pet-img" src="<?php //echo $thumb_url[0];?>">-->
							<div class="pet-img" style="background: url(<?php echo $thumb_url[0];?>) center center no-repeat;">

							</div>

							<div class="inside-content">
								<a id="" class="pet-name" href="<?php the_permalink(); ?>" >
									<?php the_title(); ?>
								</a>

								<a class="read-more" href="<?php the_permalink(); ?>" >Read My Story</a>

							</div>

					</div>
					<?php endwhile;
					wp_reset_query();
				?>

			</div><!--end -col-md-4-->




			<a href="http://opp.ourpalsplace.org/meet-our-dogs/" class="opp-button">Meet All Our Dogs</a>
			<!--<a href="http://opp.ourpalsplace.org/meet-our-cats/" class="opp-button">Meet All Our Cats</a>-->
		</section>
		<div class="container-fluid home-opp-content ">
			<div class="content-no-sidebar row">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<?php the_content(); ?>
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
