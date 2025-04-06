<?php

/*

	Template Name: Adopt Template

*/

?>

		<?php get_header(); ?>

	<div id="page-wrap">

		<?php



			//this is the option on the page options

			$pegasus_container_choice = get_post_meta( get_the_ID(), 'pegasus-page-container-checkbox', true );

			//this is the option from the theme options for global fullwidth

			//$full_container_chk_choice =  pegasus_theme_get_option('full_container_chk' );



			//$meta2 = get_post_meta($post->ID);

			//echo "<pre>";  var_dump($meta2); echo "</pre><hr>";

			//echo $pegasus_container_choice;

		?>



		<div class="<?php if($full_container_chk_choice === 'on') {

										echo 'container-fluid';

									}elseif ($pegasus_container_choice === 'on') {

										echo 'container-fluid';

									}else{

										echo 'container';

									}?>">



			<!-- Example row of columns -->

			<div class="row">

				<div class="col-md-12">

					<div class="inner-content">

						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

							<?php

								//$page_header_choice =  pegasus_theme_get_option('page_header_chk' );

								if( $page_header_choice != 'on' ) {

							?>

								<div class="page-header">

									<h1><?php the_title(); ?></h1>

								</div>

							<?php } ?>



							<?php the_content(); ?>

							<div class="row">

							<?php

								$query = new WP_Query(array(

								'post_type' => array( 'pets' ),

								//'tagportfolio'          => 'featured',

								//'term'=>$term->slug,

								'posts_per_page' => -1,

								'order'                  => 'ASC',

								'orderby'                => 'title'



								) );

								while ( $query->have_posts() ) : $query->the_post();

								?>



								<div class="pet-container col-lg-2 col-md-4 col-sm-6">

									<?php

									if ( has_post_thumbnail() ) {

										$thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full', false, '' );

									}else{

										$thumb_url = array( get_template_directory_uri() . "/images/banner.png", "1");

									}

									?>

									<div class="pet pet-id-<?php the_ID(); ?>">

										<!--<img class="pet-img" src="<?php //echo $thumb_url[0];?>">-->

										<div class="pet-img" style="background: url(<?php echo $thumb_url[0];?>) center center no-repeat;">



										</div>



										<div class="inside-content">

											<h3><a id="" class="pet-name" href="<?php the_permalink(); ?>" >

												<?php the_title(); ?>

											</a></h3>



											<a class="read-more" href="<?php the_permalink(); ?>" >Read My Story</a>



										</div>

									</div>

								</div><!--end -col-md-4-->

								<?php endwhile;

								wp_reset_query();

								?>

							</div>



							<?php comments_template(); ?>



						<?php endwhile; else: ?>

							<?php /* kinda a 404 of sorts when not working */ ?>

							<div class="page-header">

								<h1>Oh no!</h1>

							</div>

							<p>No content is appearing for this page!</p>

						<?php endif; ?>

					</div><!--end inner content-->

				</div>

				<?php //get_sidebar(); ?>



			</div>

		</div>

	</div><!-- end page wrap -->



    <?php get_footer(); ?>

