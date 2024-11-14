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

	<section class="p-5 qbiqcamp-home-section-1 ">
		<div class="container my-5">
  			<div class="p-5 mb-5 ">
    			<div class="container-fluid py-5">
					<div class="col-md-6  wow slideInRight">
						<h2>Drill The details</h2>
						<p>The game is changing. More is expected of QBs than ever before. Our nationally acclaimed staff believes young players can handle the pressure. That is why we derive all our drills from actual college game movements. Master our drills and you'll excel in the modern passing game.</p>
					</div>
					<div class="col-md-6">

					</div>
				</div>

			</div>
		</div>
		<div class="text-center">
			<a class="btn btn-secondary" href="#">Get Invited</a>
			<a class="btn btn-primary" href="#">Register</a>
		</div>
	</section>

	<section class="p-5 qbiqcamp-home-section-2 ">
		<div class="container my-5">
  			<div class="p-5 mb-5 ">
    			<div class="container-fluid py-5">
					<div class="col-md-6 wow slideInLeft">
						<h2>READ THE COVERAGE</h2>
						<h4>LEARN THE MENTAL SIDE OF THE GAME</h4>
						<p>In today's pass heavy game it is essential for young quarterbacks to be able to recognize coverage. Learn from the best in the business, QBIQ creator Chris Hixson, about how to identify defenses before the snap and easily predict successful throws.</p>
					</div>
					<div class="col-md-6">

					</div>
				</div>

			</div>
		</div>
		<div class="text-center">
			<a class="btn btn-secondary" href="#">Get Invited</a>
			<a class="btn btn-primary" href="#">Register</a>
		</div>
	</section>

	<section class="p-5 qbiqcamp-home-section-3 ">
		<div class="container my-5">
  			<div class="p-5 mb-5 ">
    			<div class="container-fluid py-5">
					<div class="col-md-6  wow slideInRight">
						<h2>GET FLEXIBLE AND STRONG</h2>
						<p>Strength for quarterbacks means a balance between power and flexibility. Our program teaches quarterbacks sound, repeatable exercises that strengthen the body, add velocity, and avoid modern shoulder and elbow injuries.</p>
					</div>
					<div class="col-md-6">

					</div>
				</div>

			</div>
		</div>
		<div class="text-center">
			<a class="btn btn-secondary" href="#">Get Invited</a>
			<a class="btn btn-primary" href="#">Register</a>
		</div>
	</section>

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
										__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'textdomain' ),
										get_the_title()
									),
									'<span class="edit-link">',
									'</span>'
								);
							}
							if ( function_exists( 'wp_bootstrap_posts_pagination' ) ) {
								wp_bootstrap_posts_pagination( array(
									'prev_text'          => __( 'Previous page', 'pegasus-bootstrap' ),
									'next_text'          => __( 'Next page', 'pegasus-bootstrap' ),
									'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'pegasus-bootstrap' ) . ' </span>'
								) );
							}
						?>
					</div>
				</div><!--end inner content-->

			</div><!--end row -->
		</div><!-- end container -->
	</div><!-- end page wrap -->
    <?php get_footer(); ?>


