<?php

/*

	Template Name: Re-Home Page Template

*/

?>

	<?php get_header(); ?>



	<div id="page-wrap">

		<?php

			//this is the option on the page options

			$pegasus_container_choice = get_post_meta( get_the_ID(), 'pegasus-page-container-checkbox', true );

			//this is the option from the theme options for global fullwidth

			$full_container_chk_choice =  pegasus_get_option('full_container_chk' );



			$page_vs_global_check = $pegasus_container_choice ? $pegasus_container_choice : $full_container_chk_choice;

			$final_container_class = $page_vs_global_check ? $page_vs_global_check : 'container';



			//$meta2 = get_post_meta($post->ID);

			//echo "<pre>";  var_dump($meta2); echo "</pre><hr>";

			//echo $pegasus_container_choice;

		?>







		<div class="container-fluid">

		<!-- Example row of columns -->

			<div class="row">



				<div class="inner-content col-md-12">

					<div class="content-no-sidebar">

						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

							<?php

								$page_header_choice =  pegasus_get_option('page_header_chk' );

								if( $page_header_choice != 'on' ) {

							?>

								<div class="page-header">

									<h1><?php the_title(); ?></h1>

								</div>

							<?php }else{ ?>

								<div class="page-header-spacer"></div>

							<?php } ?>



							<?php the_content(); ?>



							<div class="container-fluid opp-bkg">

							<!-- Example row of columns -->

								<div class="row">



									<?php



										$args = array(

											'post_type'      => 'rehome',

											'posts_per_page' => -1,

											//'post_parent'    => $post->ID,

											'order'          => 'ASC',

											'orderby'        => 'menu_order',

											//'petcategory' => 'dogs',

											//'taxonomy' => 'petscategory',

											//'term' => 'dogs',

											//'tax_query' => array(

											  //array( 'taxonomy' => 'petscategory', 'field' => 'slug', 'terms' => array( 'dogs' ) )

											//)

										);

										$parent = new WP_Query( $args );



										if ( $parent->have_posts() ) :

									?>



										<?php while ( $parent->have_posts() ) : $parent->the_post(); ?>



											<?php //get_template_part( 'templates/content_item', 'content-item' ); ?>

											<?php

												global $post;

												$terms = get_the_terms( $post->ID, 'category' );



												if ( $terms && ! is_wp_error( $terms ) ) :

													$links = array();



													foreach ( $terms as $term ) {

														$links[] = $term->name;

													}

													$links = str_replace( ' ', '-', $links );

													$tax = join( " ", $links );

												else :

													$tax = '';

												endif;

												?>



												<div class="content-item-container col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 <?php echo strtolower( $tax ); ?>">

													<article class="article-<?php the_ID(); ?> block-inner ">



														<a href="<?php the_permalink(); ?>" class="content-item-image" style="background-image: url( '<?php echo pegasus_image_display( 'full', '', false ); ?>' );">

															<?php /*

															<img src="<?php echo pegasus_image_display( 'thumbnail', '', false ); ?>" alt="">

															*/  ?>

														</a>



														<div class="content-item-wrapper">

															<!-- the permalink and title -->

															<a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>">

																<h3 class="content-item-title"><?php the_title(); ?></h3>

															</a>

															<?php

																/* $the_time = the_time( 'l, F jS, Y' ) ? the_time( 'l, F jS, Y' ) : '';

																if ( '' !== $the_time ) :

															?>

																<em>

																	<p class="content-item-date-time">

																		<?php echo $the_time;?>

																	</p>

																</em>

															<?php

																endif; */

															?>

															<?php /*

															<div class="content-item-cats"><i><?php the_category(); ?></i></div>



															<!-- output the excerpt, and if no excerpt then output content-->

															<!-- output is limited to the first 300 characters then an elipsis (...) is added and a read more link appears -->

															<div class="content-item-paragraph-content">

																<?php

																$pegasus_excerpt = get_the_excerpt();

																if( isset( $pegasus_excerpt ) ) { ?>

																	<p>

																		<?php

																		$temporary_excerpt = substr( strip_tags( $pegasus_excerpt ), 0, 300 );

																		$final_excerpt = ( $pegasus_excerpt !== $temporary_excerpt ) ? ( $temporary_excerpt . '...') : $pegasus_excerpt;

																		echo $final_excerpt;

																		?>

																	</p>

																<?php } else {

																	$more = 0;

																	$pegasus_content = get_the_content();

																	$temporary_content = substr( strip_tags( $pegasus_content ), 0, 300 );

																	$final_content = ( $pegasus_content !== $temporary_content ) ? ( $temporary_content . '...' ) : $pegasus_content;

																?>

																	<p>

																		<?php echo do_shortcode( $final_content ); ?>

																	</p>

																<?php }	?>


															</div>

															*/ ?>

															<!-- output a read more button -->

															<a class="button btn btn-primary" href="<?php the_permalink(); ?>"> Read More </a>

														</div>



														<?php

															if ( function_exists( 'wp_bootstrap_edit_post_link' ) ) {
																// Edit post link
																wp_bootstrap_edit_post_link(
																	sprintf(
																		/* translators: %s: Name of current post */
																		__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'textdomain' ),
																		get_the_title()
																	),
																	'<span class="edit-link">',
																	'</span>'
																);
															}

														?>



													</article>

												</div>





										<?php endwhile; ?>



									<?php

										endif;

										wp_reset_query();

									?>



								</div>



							</div>



						<?php endwhile; else: ?>

							<?php /* kinda a 404 of sorts when not working */ ?>

							<div class="page-header">

								<h1>Oh no!</h1>

							</div>

							<p>No content is appearing for this page!</p>

						<?php endif; ?>

					</div>

				</div><!--end inner content-->



			</div><!--end row -->

		</div><!-- end container -->

	</div><!-- end page wrap -->

    <?php get_footer(); ?>
