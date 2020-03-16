<?php
/*
	Template Name: Portfolio Template
*/
?>
<?php get_header(); ?>

<div id="page-wrap">
	<?php
	//full container page options
	$post_full_container_choice = get_post_meta( get_the_ID(), 'pegasus-page-container-checkbox', true );
	//full container theme option
	$global_full_container_option = pegasus_get_option('full_container_chk' );

	//assign post class
	$pegasus_post_container_choice = ( 'on' === $post_full_container_choice ) ? 'container-fluid' : 'container';
	//assign global class
	$pegasus_global_container_choice = ( 'on' === $global_full_container_option ) ? 'container-fluid' : 'container' ;
	//check global first then post
	$final_container_class = ( 'container-fluid' === $pegasus_global_container_choice ) ? $pegasus_global_container_choice : $pegasus_post_container_choice;

	//left align right sidebar?
	$left_align_sidebar_chk =  pegasus_get_option( 'sidebar_left_chk' ) ? pegasus_get_option( 'sidebar_left_chk' ) : 'off';
	//enable both sidebars?
	$pegasus_left_sidebar_option = ( 'on' === pegasus_get_option( 'both_sidebar_chk' ) ) ? pegasus_get_option( 'both_sidebar_chk' ) : 'off';
	//change content class if both sidebars
	$page_body_content_class = ( 'on' === $pegasus_left_sidebar_option  ) ? 'col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xg-6' : 'col-xs-12 col-sm-12 col-md-12 col-lg-9 col-xg-9';

	//page header page options
	$post_disable_page_header_choice = get_post_meta( get_the_ID(), 'pegasus-page-header-checkbox', true ) ? get_post_meta( get_the_ID(), 'pegasus-page-header-checkbox', true ) : 'off';
	//page header theme option
	$global_disable_page_header_option =  pegasus_get_option('page_header_chk' ) ? pegasus_get_option('page_header_chk' ) : 'off';
	//check theme option for page header before page option
	$page_title = $post->post_title;
	$is_this_home = is_home();
	if ( 'on' === $global_disable_page_header_option ) {
		$final_page_header_option = 'on';
	} elseif ( 'on' === $post_disable_page_header_choice ) {
		$final_page_header_option = 'on';
	} else {
		$final_page_header_option = 'off';
	}

	if ( true === $is_this_home ) {
		$final_page_header_option = 'off';
	}
	?>

	<div class="<?php echo $final_container_class; ?>">
		<!-- Example row of columns -->
		<div class="">

			<div class="inner-content">
				<div class="content-no-sidebar">
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<?php if( 'off' === $final_page_header_option ) { ?>
							<div class="page-header">
								<?php
								if( '' === $page_title ) {
									echo '';
								} elseif ( $page_title ) {
									echo '<h1>';
									echo the_title();
									echo '</h1>';
								}
								?>
							</div>
						<?php }else{ ?>
							<div class="page-header-spacer"></div>
						<?php } ?>

						<?php the_content(); ?>

						<section id="octane-case-studies">

							<div class="bar">
								<div class="filter">
									<!--<span class="filter__label">Filter: </span>-->
									<button class="action filter__item filter__item--selected" data-filter="*">All</button>

									<?php
									$terms = get_terms("portfolio-category");
									$count = count($terms);

									if ( $count > 0 ) {
										foreach ( $terms as $term ) {
											$termName = sanitize_html_class( $term->name );
											echo '<button class="action filter__item" data-filter=".' . strtolower( $termName ) . '" ><span class="action__text">' . $term->name . '</span></button>';
										}
									}
									?>
								</div>
							</div><!-- end bar -->

							<!-- Main view -->
							<div class="view">

								<!-- Grid -->
								<section class="grid grid--loading">
									<!-- Loader -->
									<img class="grid__loader" src="<?php echo get_stylesheet_directory_uri(); ?>/images/grid.svg" width="60" alt="Loader image" />
									<!-- Grid sizer for a fluid Isotope (Masonry) layout -->
									<div class="grid__sizer"></div>

									<!-- Grid items -->
									<?php
									$query = new WP_Query(array(
										'post_type' => array( 'portfolio-type' ),
										//'category_name'          => 'featured',
										'posts_per_page' => 99,
										'order'                  => 'DESC',
										'orderby'                => 'date'

									) );
									while ( $query->have_posts() ) : $query->the_post();
										$terms = get_the_terms( $post->ID, 'portfolio-category' );
										$links = array();
										if ( $terms && ! is_wp_error( $terms ) ) :
											foreach ( $terms as $term )	{
												$links[] = sanitize_html_class( $term->name );
											}
											$tax = join( " ", $links );
										else :
											$tax = '';
										endif;
										?>

										<article class="grid__item <?php echo strtolower( $tax ); ?> clearfix">
											<div class="block-inner">
												<!-- output the thumbnail -->
												<?php if ( has_post_thumbnail() ) { ?>
													<div class="">
														<a class="cbp-vm-image" href="<?php the_permalink(); ?>">
															<?php the_post_thumbnail ( 'medium', array ('class' => 'octane-blog-thumbnail ') ); ?>
														</a>
													</div>
													<?php
												}
												?>
												<div class="meta">
													<!-- the permalink and title -->
													<a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>">
														<h3 class="meta__title"><?php the_title(); ?></h3>
													</a>

												</div>

											</div>
										</article>

									<?php endwhile;
									wp_reset_query();
									?>
								</section>
								<!-- /grid-->
							</div>

						</section>

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
