	<?php
		/**
		 * Silence is golden; exit if accessed directly
		 */
		if ( ! defined( 'ABSPATH' ) ) {
			exit;
		}
		get_header();
	?>
	<div id="page-wrap">
		<?php
			//global $post;
			
			//full container page options
			//$post_full_container_choice = get_post_meta( get_the_ID(), 'pegasus-page-container-checkbox', true );
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
			if ( $post ) {
				$page_title = $post->post_title;
			}
			if ( 'on' === $global_disable_page_header_option ) {
				$final_page_header_option = 'on';
			} elseif ( 'on' === $post_disable_page_header_choice ) {
				$final_page_header_option = 'on';
			} else {
				$final_page_header_option = 'off';
			}
		?>
		
		<div class="container-fluid">
			<div class="mt-3 mb-3">
				<?php 
					
					$card_set_slug = get_query_var('card_sets');
					
					//echo "<pre>";
					//var_dump($card_set_slug);
					//echo "</pre>";

					// Construct the query for the custom post type
					$the_query_args = array(
						'post_type' => 'card_sets',
						'name'           => $card_set_slug,  // 'name' is the parameter for querying by slug
						//'posts_per_page' => 1  // As slugs are unique, we only expect one post
					);
					
					//echo "<pre>Query Args: ";
					//var_dump($the_query_args);
					//echo "</pre>";
					

					// New WP_Query instance
					$the_query = new WP_Query($the_query_args);

					// Check if the query has posts
					if ($the_query->have_posts()) :
						echo '<div class="card-set-wrapper">';
						while ($the_query->have_posts()) : $the_query->the_post();
							$the_id = get_the_ID();
							$cards = get_post_meta($the_id, 'pegasus_card_sets_cards', true);

							if (!empty($cards)) {
								foreach ((array) $cards as $key => $card) {
									$prefix = 'pegasus_card_sets_';

									$card_title = isset($card[$prefix . 'title']) ? esc_html($card[$prefix . 'title']) : '';
									$card_image = isset($card[$prefix . 'image']) ? esc_url($card[$prefix . 'image']) : '';
									$card_alt_text = isset($card[$prefix . 'alt_text']) ? esc_attr($card[$prefix . 'alt_text']) : 'image';
									$card_caption = isset($card[$prefix . 'caption']) ? esc_html($card[$prefix . 'caption']) : '';

									echo "<div class='card-set-item'>";
										echo "<div class='card-set-content'>";
											if ($card_image) {
												echo '<a class="m-2" href="' . $card_image . '" data-lightbox="card-set-' . $the_id . '" >';
													echo '<img class="card-set-img " src="' . $card_image . '" alt="' . $card_alt_text . '" >';
												echo '</a>';
											}
											echo '<div class="m-2">';
												if ($card_title) {
													echo '<h3 class="card-set-title">' . $card_title . '</h3>';
												}
												if ($card_caption) {
													echo '<p class="card-set-caption">' . $card_caption . '</p>';
												}
											echo '</div>';
										echo "</div>";	
									echo "</div>";
								} // End foreach
							}
						endwhile;
						echo '</div>'; // Close card-set-wrapper
					else :
						echo "No cards found.";
					endif;

					wp_reset_postdata();
					
				?>
			</div>
		</div>
	
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
							if ( function_exists( 'wp_bootstrap_posts_pagination' ) ) {
								wp_bootstrap_posts_pagination( array(
									'prev_text'          => __( 'Previous page', 'pegasus-bootstrap' ),
									'next_text'          => __( 'Next page', 'pegasus-bootstrap' ),
									'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'pegasus-bootstrap' ) . ' </span>'
								) );
							}
						?>
					</div><!--end inner content-->
				</div>
				
       
			</div><!--end row -->
		</div><!-- end container -->
	</div><!-- end page wrap -->
      <?php get_footer(); ?>
