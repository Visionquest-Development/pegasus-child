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
	
	<?php 
	
		$sections = get_post_meta(get_the_ID(), 'homepage_sections_repeatable_group', true);

		
		if (!empty($sections)) {
			$index = 1;
			foreach ($sections as $section) {
				$bg_image = isset($section['background_image']) ? esc_url($section['background_image']) : '';
				$title = isset($section['title']) ? esc_html($section['title']) : '';
				$subtitle = isset($section['subtitle']) ? esc_html($section['subtitle']) : '';
				$paragraph = isset($section['paragraph']) ? wp_kses_post($section['paragraph']) : '';
				$button1_text = isset($section['button1_text']) ? esc_html($section['button1_text']) : '';
				$button1_link = isset($section['button1_link']) ? esc_url($section['button1_link']) : '#';
				//$button2_text = isset($section['button2_text']) ? esc_html($section['button2_text']) : '';
				//$button2_link = isset($section['button2_link']) ? esc_url($section['button2_link']) : '#';
				
				$output = '';

				//echo '<section class="p-5 qbiqcamp-home-section-2" style="background-image: url(' . $bg_image . ');">';
				
				$output .= '<section class="p-5 site qbiqcamp-home-section qbiqcamp-home-section-' . $index . ' background-attachment-fixed " style="background-image: url(' . $bg_image . ');">';
				//$output .= '[section class="p-5 qbiqcamp-home-section-2" background="' . $bg_image . '"]';
					$output .= '<div class="overlay"></div>';
					$output .= '<div class="text-container container my-5">';
					
						$output .= '<div class="p-sm-5 ">'; 
							$output .= '<div class="container-fluid py-5">';
								$output .= '<div class="col-md-6 wow slideInLeft">';
									$output .= '<h2>' . $title . '</h2>';
									$output .= '<h4>' . $subtitle . '</h4>';
									$output .= '<p>' . $paragraph . '</p>';
								$output .= '</div>';
								$output .= '<div class="col-md-6"></div>';
							$output .= '</div>';
						$output .= '</div>';
						
						
						
					$output .= '</div>';
					
					$output .= '<div class="text-center button-container">';
						$output .= '<a class="btn btn-transparent mb-3 " href="' . $button1_link . '">' . $button1_text . '</a>';
					$output .= '</div>';
					
				$output .= '</section>';
				//$output .= '[/section]';
				
				echo do_shortcode( $output );
				
				 $index++;
			}
		} 
		/*
		if (!empty($sections)) {
			foreach ($sections as $section) {
				$bg_image = !empty($section['background_image']) ? esc_url($section['background_image']) : '';
				$title = !empty($section['title']) ? esc_html($section['title']) : '';
				$subtitle = !empty($section['subtitle']) ? esc_html($section['subtitle']) : '';
				$paragraph = !empty($section['paragraph']) ? esc_html($section['paragraph']) : '';
				$button1_text = !empty($section['button1_text']) ? esc_html($section['button1_text']) : '';
				$button1_link = !empty($section['button1_link']) ? esc_url($section['button1_link']) : '#';

				// Start building the shortcode
				$output = '[section';
				$output .= $bg_image ? ' background="' . $bg_image . '"' : '';
				$output .= ']';

				if ($title) {
					$output .= '<h2>' . $title . '</h2>';
				}
				if ($subtitle) {
					$output .= '<h4>' . $subtitle . '</h4>';
				}
				if ($paragraph) {
					$output .= '<p>' . $paragraph . '</p>';
				}

				$output .= '<div class="text-center button-container">';
				if ($button1_text) {
					$output .= '<a class="btn btn-transparent mb-3" href="' . $button1_link . '">' . $button1_text . '</a>';
				}
				$output .= '</div>'; // button-container

				$output .= '[/section]';

				// Output the final shortcode string
				echo do_shortcode($output);
			}
		}
		*/
	
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
		
		<!--<section class="qbiq-camp-cards">-->
			 
			
			<?php echo do_shortcode('[display_qbiq_events]'); ?>
	
			<!--<div id="app" class="container">
			  <div class="card-wrap" data-image="https://images.unsplash.com/photo-1479660656269-197ebb83b540?dpr=2&auto=compress,format&fit=crop&w=1199&h=798&q=80&cs=tinysrgb&crop=">
				<a href="/atlanta" class="card">
				  <div class="card-bg"></div>
				  <div class="card-info">
					<h1>Atlanta</h1>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
				  </div>
				</a>
			  </div>
			  <div class="card-wrap" data-image="https://images.unsplash.com/photo-1479659929431-4342107adfc1?dpr=2&auto=compress,format&fit=crop&w=1199&h=799&q=80&cs=tinysrgb&crop=">
				<div class="card">
				  <div class="card-bg"></div>
				  <div class="card-info">
					<h1>Dallas</h1>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
				  </div>
				</div>
			  </div>
			  <div class="card-wrap" data-image="https://images.unsplash.com/photo-1479644025832-60dabb8be2a1?dpr=2&auto=compress,format&fit=crop&w=1199&h=799&q=80&cs=tinysrgb&crop=">
				<div class="card">
				  <div class="card-bg"></div>
				  <div class="card-info">
					<h1>New Jersey</h1>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
				  </div>
				</div>
			  </div>
			  <div class="card-wrap" data-image="https://images.unsplash.com/photo-1479621051492-5a6f9bd9e51a?dpr=2&auto=compress,format&fit=crop&w=1199&h=811&q=80&cs=tinysrgb&crop=">
				<div class="card">
				  <div class="card-bg"></div>
				  <div class="card-info">
					<h1>Vegas</h1>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
				  </div>
				</div>
			  </div>
			</div>-->

		
		
		<!--</section>-->

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


