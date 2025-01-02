	<?php
		/**
		 * Silence is golden; exit if accessed directly
		 */
		if ( ! defined( 'ABSPATH' ) ) {
			exit;
		}
		get_header();
	?>
	
	<?php
		global $post;
		$header_choice = pegasus_get_option( 'header_select' );
		//var_dump($header_choice);
		if ( 'header-three' === $header_choice || 'header-five' === $header_choice ) {
			get_template_part( 'templates/additional_header' );
		}
	?>
	<?php
	$post_id = get_the_ID(); // Or set a specific post ID if necessary

	// Fetch the meta values
	$bio_image = get_post_meta($post_id, 'camp_coaches_bio_image', true);
	$coach_title = get_post_meta($post_id, 'camp_coaches_title', true);
	$coach_description = get_post_meta($post_id, 'camp_coaches_description', true);
	$coach_video = get_post_meta($post_id, 'camp_coaches_video', true);
	?>

	<section class="">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-6">
					<div class="mt-5 mb-5">
						<img class="image-fluid" src="<?php echo esc_url($bio_image); ?>" alt="Bio Image">
						<h2><?php echo esc_html($coach_title); ?></h2>
						<p><?php echo wp_kses_post($coach_description); ?></p>
					</div>
				</div>
				<div class="col-sm-12 col-md-6">
					<div class="video-container mt-5 mb-5">
						<figure class="wp-block-video">
							<video class=" img-fluid lazyloading" controls>
								<source src="<?php echo esc_url($coach_video); ?>" type="video/mp4">
								Your browser does not support the video tag.
							</video>
						</figure>
					</div>
				</div>
			</div>
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
			if ( 'on' === $global_disable_page_header_option ) {
				$final_page_header_option = 'on';
			} elseif ( 'on' === $post_disable_page_header_choice ) {
				$final_page_header_option = 'on';
			} else {
				$final_page_header_option = 'off';
			}
		?>

		<div class="<?php echo $final_container_class; ?>">
			<!-- Example row of columns -->
			<div class="row">
				<?php
					if( 'on' === $pegasus_left_sidebar_option && 'on' === $left_align_sidebar_chk ) {
						get_sidebar( 'left' );
					} else if( 'on' === $left_align_sidebar_chk ) {
						get_sidebar( 'right' );
					}
				?>

				<div class="<?php echo $page_body_content_class; ?>">
					<div class="inner-content">
						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
							<?php
							if( 'off' === $final_page_header_option ) {
								?>
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
									<p><em>
										By <?php the_author(); ?>
										on <?php echo the_time('l, F, jS, Y');?>
										in <?php the_category( ',' ); ?>.
										<a href="<?php comments_link(); ?>"><?php comments_number(); ?></a>
									</em></p>
								</div>
							<?php }else{ ?>
								<div class="page-header-spacer"></div>
								<div class="">
									<p><em>
										By <?php the_author(); ?>
										on <?php echo the_time('l, F, jS, Y');?>
										in <?php the_category( ',' ); ?>.
										<a href="<?php comments_link(); ?>"><?php comments_number(); ?></a>
									</em></p>
								</div>
							<?php } ?>

							<?php the_content(); ?>

							<?php comments_template(); ?>

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
						if ( function_exists( 'wp_bootstrap_post_navigation' ) ) {
							// Previous/next post navigation.
							wp_bootstrap_post_navigation( array(
								'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next: ', 'pegasus-bootstrap' ) . '</span> ' .
									'<span class="screen-reader-text">' . __( 'Next post:', 'pegasus-bootstrap' ) . '</span> ' .
									'<span class="post-title">%title</span>',
								'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous: ', 'pegasus-bootstrap' ) . '</span> ' .
									'<span class="screen-reader-text">' . __( 'Previous post:', 'pegasus-bootstrap' ) . '</span> ' .
									'<span class="post-title">%title</span>'
							) );
						}
						?>
					</div><!--end inner content-->
				</div>
				<?php
				if( 'on' === $pegasus_left_sidebar_option ) {
					get_sidebar( 'right' );
				}
				if( 'on' !== $left_align_sidebar_chk ) {
					get_sidebar( 'right' );
				}
				?>

			</div><!--end row -->
		</div><!-- end container -->
	</div><!-- end page wrap -->
      <?php get_footer(); ?>

