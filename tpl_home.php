<?php
/*
	Template Name: Home Template
*/
?>
	<?php get_header(); ?>

	<?php
		$header_choice = pegasus_get_option( 'header_select' );
		if ( 'header-three' === $header_choice ) {
			get_template_part( 'templates/additional_header' );
		}
	?>

	<div id="page-wrap">

		<?php
			$post_full_container_choice = get_post_meta( get_the_ID(), 'pegasus-page-container-checkbox', true );
			$global_full_container_option = pegasus_get_option('full_container_chk' );

			$pegasus_post_container_choice = ( 'on' === $post_full_container_choice ) ? 'container-fluid' : 'container';
			$pegasus_global_container_choice = ( 'on' === $global_full_container_option ) ? 'container-fluid' : 'container' ;
			$final_container_class = ( 'container-fluid' === $pegasus_global_container_choice ) ? $pegasus_global_container_choice : $pegasus_post_container_choice;

			$post_disable_page_header_choice = get_post_meta( get_the_ID(), 'pegasus-page-header-checkbox', true ) ? get_post_meta( get_the_ID(), 'pegasus-page-header-checkbox', true ) : 'off';
			$global_disable_page_header_option =  pegasus_get_option('page_header_chk' ) ? pegasus_get_option('page_header_chk' ) : 'off';
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

							<?php } ?>

							<?php the_content(); ?>

						<?php endwhile; else: ?>
							<div class="page-header">
								<h1>Oh no!</h1>
							</div>
							<p>No content is appearing for this page!</p>
						<?php endif; ?>
						<?php
							if ( function_exists( 'wp_bootstrap_edit_post_link' ) ) {
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

	<section class="home-pillars-section">
		<div class="container">
			<div class="row">
				<div class="col-12 col-sm-6 col-lg-3 home-pillar">
					<div class="home-pillar-icon">
						<i class="fa fa-bar-chart" aria-hidden="true"></i>
					</div>
					<h3>Focused Strategy</h3>
					<p>A disciplined, opportunistic multi-strategy approach focused on generating superior risk-adjusted returns.</p>
				</div>
				<div class="col-12 col-sm-6 col-lg-3 home-pillar">
					<div class="home-pillar-icon">
						<i class="fa fa-shield" aria-hidden="true"></i>
					</div>
					<h3>Risk Management</h3>
					<p>Risk management is integrated throughout our investment process with a focus on capital preservation.</p>
				</div>
				<div class="col-12 col-sm-6 col-lg-3 home-pillar">
					<div class="home-pillar-icon">
						<i class="fa fa-handshake-o" aria-hidden="true"></i>
					</div>
					<h3>Alignment of Interests</h3>
					<p>We are partners with our investors and committed to delivering strong, consistent results.</p>
				</div>
				<div class="col-12 col-sm-6 col-lg-3 home-pillar">
					<div class="home-pillar-icon">
						<i class="fa fa-users" aria-hidden="true"></i>
					</div>
					<h3>Investor Partnership</h3>
					<p>We believe in building long-term partnerships based on trust, transparency and performance.</p>
				</div>
			</div>
		</div>
	</section>

    <?php get_footer(); ?>
