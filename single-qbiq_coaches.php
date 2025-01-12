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
		
		function is_youtube_video($url) {
			// Parse the URL and extract components
			$parsed_url = parse_url($url);

			// Check if the host is a YouTube domain
			if (!isset($parsed_url['host'])) {
				return false;
			}

			$youtube_hosts = ['www.youtube.com', 'youtube.com', 'youtu.be'];
			if (in_array($parsed_url['host'], $youtube_hosts)) {
				// Further check if it's a valid YouTube watch URL or a shortened youtu.be URL
				if ($parsed_url['host'] == 'youtu.be') {
					// youtu.be URLs are always YouTube videos
					return true;
				} elseif (isset($parsed_url['path']) && $parsed_url['path'] === '/watch') {
					// Check for 'v' parameter in query string which signifies video ID on standard YouTube URLs
					parse_str($parsed_url['query'], $query_params);
					return isset($query_params['v']);
				} elseif (isset($parsed_url['path']) && strpos($parsed_url['path'], '/embed/') === 0) {
					// Check if it is an embed URL which contains '/embed/' followed by video ID
					return true;
				}
			}

			return false;
		}

		function convert_youtube_url_to_embed($url) {
			$parsed_url = parse_url($url);
			if ($parsed_url['host'] === 'www.youtube.com' || $parsed_url['host'] === 'youtube.com') {
				parse_str($parsed_url['query'], $query_params);
				if (isset($query_params['v'])) {
					return 'https://www.youtube.com/embed/' . $query_params['v'];
				}
			} elseif ($parsed_url['host'] === 'youtu.be') {
				return 'https://www.youtube.com/embed' . $parsed_url['path'];
			}
			return $url; // Return the original URL if it's not a YouTube link
		}

		// Fetch the meta values
		$bio_image = get_post_meta($post_id, 'camp_coaches_bio_image', true);
		$coach_title = get_post_meta($post_id, 'camp_coaches_title', true);
		$coach_description = get_post_meta($post_id, 'camp_coaches_description', true);
		
		
		$coach_video = get_post_meta($post_id, 'camp_coaches_video', true);
		
		
		$embed_url = convert_youtube_url_to_embed($coach_video);
		
		
	?>

	<section class="">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-8 ">
					<div class="mt-5 mb-5">
						<img class="image-fluid" src="<?php echo esc_url($bio_image); ?>" alt="Bio Image">
						<div class="coach-info"> 
							<h2><?php echo esc_html($coach_title); ?></h2>
							<p><?php echo wp_kses_post($coach_description); ?></p>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-12 col-lg-4">
					<div class="video-container mt-5 mb-5">
						<?php if ( !empty($embed_url) ) { ?>
							<?php 
								if ( is_youtube_video($coach_video)  ) {
							?>
								<iframe 
									width="560" 
									height="315" 
									src="<?php echo esc_url($embed_url); ?>" 
									frameborder="0" 
									allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
									allowfullscreen
								>
								</iframe>
							<?php 
								} else {
							?>
							<figure class="wp-block-video">
								<video class=" img-fluid lazyloading" controls>
									<source src="<?php echo esc_url($coach_video); ?>" type="video/mp4">
									Your browser does not support the video tag.
								</video>
							</figure>
							<?php 
								}
							?>
							
						<?php } //end if embed url ?>
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

