<?php
/*
	Template Name: Home Template
*/
?>
	<?php get_header(); ?>

	<?php
		$header_choice = pegasus_get_option( 'header_select' );
		//var_dump($header_choice);
		if ( 'header-three' === $header_choice ) {
			get_template_part( 'templates/additional_header' );
		}
	?>

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

		<section class="my-5">
			<div class="<?php echo $final_container_class; ?>">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
						<?php pegasus_child_render_home_slider(); ?>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
						<div style="padding: 5px; margin-bottom: 5px; background-color: #1c3669;">
							<h1 style="color: #ffffff ! important; margin-bottom: 3px ! important; text-align: center;"><strong>Cadence Group </strong></h1>
							<h4 style="color: #ffffff; text-align: center;"><span style="color: #ffffff;">Information is our Forté</span></h4>
						</div>
						<h5 style="color: #1c3669; text-align: center;"><strong><img class="alignnone wp-image-4822 size-full" src="//cadence-group.com/wp-content/uploads/2020/04/home-info-graph.png" alt="cadence group infographic library acquisition research communication training compliance architecture sustainability documents records web collaboration km user support" width="300" height="213" /></strong></h5>
						<h5 style="color: #1c3669; text-align: center;"><strong> acquire &gt; organize &gt; disseminate</strong></h5>
					</div>
				</div>
			</div>
		</section>

		<section>
			<div class="<?php echo $final_container_class; ?>">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<?php pegasus_child_render_home_tabs(); ?>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<h2>Business Sectors</h2>
						<?php pegasus_child_render_home_accordion(); ?>
					</div>
				</div>
			</div>
		</section>

		<section class="container">
		<hr class="my-5 px-3">
		</section>

		<section>
			<div class="<?php echo $final_container_class; ?>">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
						<h2>News & Events</h2>
						<?php echo do_shortcode( '[loop-grid the_query="showposts=1&post_type=post&category_name=cadence-group-news-events,industry-news-events"]' ); ?>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
						<div class="whitepaper-container mb-5">
							<?php pegasus_child_render_home_whitepaper(); ?>
						</div>
						<h2>Testimonials</h2>
						<?php pegasus_child_render_home_testimonial_slider(); ?>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
						<h2>Recent Posts</h2>
						<?php pegasus_child_render_home_news_query_slider(); ?>
					</div>
				</div>
			</div>
		</section>

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

						<?php endwhile; else: ?>
							<?php /* kinda a 404 of sorts when not working */ ?>
							<div class="page-header">
								<h1>Oh no!</h1>
							</div>
							<p>No content is appearing for this page!</p>
						<?php endif; ?>
						<?php
							if ( function_exists( 'wp_bootstrap_edit_post_link' ) ) {
								// Edit post link
								wp_bootstrap_edit_post_link(
									sprintf(
										/* translators: %s: Name of current post */
										__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'pegasus' ),
										get_the_title()
									),
									'<span class="edit-link">',
									'</span>'
								);
							}
							if ( function_exists( 'wp_bootstrap_posts_pagination' ) ) {
								wp_bootstrap_posts_pagination( array(
									'prev_text'          => __( 'Previous page', 'pegasus' ),
									'next_text'          => __( 'Next page', 'pegasus' ),
									'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'pegasus' ) . ' </span>'
								) );
							}
						?>
					</div>
				</div><!--end inner content-->

			</div><!--end row -->
		</div><!-- end container -->



	</div><!-- end page wrap -->
    <?php get_footer(); ?>
