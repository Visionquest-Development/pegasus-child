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
		/*$header_choice = pegasus_get_option( 'header_select' );
		//var_dump($header_choice);
		if ( 'header-three' === $header_choice || 'header-five' === $header_choice ) {
			get_template_part( 'templates/additional_header' );
		}*/
	?>
	
	<?php 
	
		
		// Fetch custom field values
		$event_title       = get_post_meta(get_the_ID(), 'camp_page_section_event_title', true);
		$event_date        = get_post_meta(get_the_ID(), 'camp_page_section_event_date', true);
		$event_date_end    = get_post_meta(get_the_ID(), 'camp_page_section_event_end_date', true);
		$event_description = get_post_meta(get_the_ID(), 'camp_page_section_event_description', true);
		$button_text       = get_post_meta(get_the_ID(), 'camp_page_section_button_text', true);
		$button_link       = get_post_meta(get_the_ID(), 'camp_page_section_button_link', true);
		$background_image  = get_post_meta(get_the_ID(), 'camp_page_section_background_image', true);
		$video_link        = get_post_meta(get_the_ID(), 'camp_page_section_video_link', true);
		
		$qbiq_post_title = get_the_title();
	?>
	<?php 
		if ( $event_title ) {
	?>
	<section class="custom-section qbiq-parallax" style="background-image: url('<?php echo esc_url($background_image); ?>');">
		<div class="camp-section-container">
			<div class="content wow fadeIn">
				
				<?php if ( $event_date ) { ?>
					<div class="date-block">
						<p>
							<?php echo esc_html($event_date); ?> 
							<?php if ( $event_date_end ) { echo ' - ' . $event_date_end; } ?>
						</p>
					</div>
				<?php } ?>
				
				<h1><?php echo esc_html($event_title); ?></h1>
				<div class="camp-page-description"><p><?php echo esc_html($event_description); ?></p></div>
				<?php if ($button_text && $button_link): ?>
					<a href="<?php echo esc_url($button_link); ?>" class="btn"><?php echo esc_html($button_text); ?></a>
				<?php endif; ?>
				<?php if ($video_link): ?>
					<a href="<?php echo esc_url($video_link); ?>" class="video-link btn" target="_blank">
						<i class="fa fa-play" aria-hidden="true"></i>
						Play Video
					</a>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<?php 
		} else {
			get_template_part( 'templates/additional_header' );
		}
		
		echo '<div class="container mt-3 ">';
			echo '<h1>' . $qbiq_post_title . '</h1>';
		echo '</div>';
	?>
	
	<section class="p-3 camp-location-images-grid qbiq-background-black">
		
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<?php 
						
						$images = get_post_meta(get_the_ID(), 'camp_gallery_section_image_group', true);
						$title = get_post_meta(get_the_ID(), 'camp_gallery_section_title', true);
						$desc = get_post_meta(get_the_ID(), 'camp_gallery_section_description', true);
						
						//var_dump($desc);
					?>
					
					<h2><?php echo $title; ?></h2>
					<p><?php echo $desc; ?></p>
					
					
					<?php /* echo do_shortcode('[packery]
					<img src="https://cdn.prod.website-files.com/64d124bebeae431f3756cc77/67337be8b27825d02c0b1937_67242f82273490b394336bcc_65ec88ab637289ce22fd89cd_IMG_7901.png" loading="lazy" width="328" data-lightbox="qbiq-camp-location-image-gallery" data-title="My caption" class="image-204">
					<img src="https://cdn.prod.website-files.com/64d124bebeae431f3756cc77/67337c257fe41b6175ab4cc0_65ec899f8aa47e0c209ff4a5_IMG_4378.png" loading="lazy" width="306" data-lightbox="qbiq-camp-location-image-gallery" data-title="My caption" class="image-204">
					<img class="image-204" src="https://cdn.prod.website-files.com/64d124bebeae431f3756cc77/67242f80273490b394336a86_6699ed7f206dc486ff49b48b_QBULASinglePlayerHair.png" width="306" alt="" data-lightbox="qbiq-camp-location-image-gallery" data-title="My caption" >
					<img src="https://cdn.prod.website-files.com/64d124bebeae431f3756cc77/67242f82c20cd160346fd44b_65ec8cb90581d11ec31d2c54_Untitled-2.png" loading="lazy" width="306" data-lightbox="qbiq-camp-location-image-gallery" data-title="My caption"  class="image-204">
					<img class="image-204" src="https://cdn.prod.website-files.com/64d124bebeae431f3756cc77/65ec8d57fa620f5552bc9b35_Untitled-3.png" width="306" alt=""  data-lightbox="qbiq-camp-location-image-gallery" data-title="My caption" >
					<img class="image-204" src="https://cdn.prod.website-files.com/64d124bebeae431f3756cc77/67242f802721f141f28b3e2c_6699ee3705579b040d9cd815_QBULASinglePlayerThrow.png" width="306" alt="" data-lightbox="qbiq-camp-location-image-gallery" data-title="My caption" >
					<img class="image-204 _2" src="https://cdn.prod.website-files.com/64d124bebeae431f3756cc77/67242f82c20cd160346fd437_6699ecc5e1d4a653919abebf_QBULAGroup.png" width="567" alt=""  data-lightbox="qbiq-camp-location-image-gallery" data-title="My caption" >
					[/packery]'); */ ?>
					
					<?php 
						
						
						
						//var_dump( $images );

						// Check if there are images and output them within the packery shortcode
						if (!empty($images)) {
							$output = '[packery]';  // Start the shortcode

							foreach ($images as $image) {
								$img_url = esc_url($image['image']);
								$caption = esc_attr($image['caption'] ?? 'My caption');
								//Undefined array key "width"
								if ( isset($image['width']) ) {
									$width = esc_attr($image['width']);
								}

								if(empty($width)) {
									$width = '306';
								}
								$output .= '<a href="' . $img_url . '"  data-lightbox="qbiq-camp-location-image-gallery" data-title="' . $caption . '" class="wow fadeIn">';
									
									$output .= '<img src="' . $img_url . '" loading="lazy" width="' . $width . '" class="">';
								$output .= '</a>';
								
							}

							$output .= '[/packery]';  // Close the shortcode
							
							//var_dump();

							echo do_shortcode($output);  // Execute the shortcode with all images included
						}
					
					?>
					
					
					
					
				</div>
				
			</div>
		</div>
	</section>
	
	<?php 
	// Retrieve CMB2 custom fields
	$hotel_name = get_post_meta(get_the_ID(), 'camp_accomdation_hotel_name', true);
	$hotel_description = get_post_meta(get_the_ID(), 'camp_accomdation_hotel_description', true);
	$hotel_image = get_post_meta(get_the_ID(), 'camp_accomdation_hotel_image', true);
	$hotel_link = get_post_meta(get_the_ID(), 'camp_accomdation_hotel_link', true) ? get_post_meta(get_the_ID(), 'camp_accomdation_hotel_link', true) : '#';
	$facility_name = get_post_meta(get_the_ID(), 'camp_accomdation_facility_name', true);
	$facility_address = get_post_meta(get_the_ID(), 'camp_accomdation_facility_address', true);
	$facility_image = get_post_meta(get_the_ID(), 'camp_accomdation_facility_image', true);
	$facility_directions_link = get_post_meta(get_the_ID(), 'camp_accomdation_facility_directions_link', true) ? get_post_meta(get_the_ID(), 'camp_accomdation_facility_directions_link', true) : '#';
	?>
	<?php 
		if ( $hotel_name ) {
	?>
	<section class="camp-section qbiq-background-black">
		<div class="container">
			<div class="camp-header">
				<h5>Official Team Hotel</h5>
				<h1><?php echo esc_html($hotel_name); ?></h1>
				<p><?php echo esc_html($hotel_description); ?></p>
			</div>
			<div class="camp-content wow fadeInLeft">
				<div class="hotel-image" style="background-image: url('<?php echo esc_url($hotel_image); ?>');">
					<div class="hotel-details">
						<h3><?php echo esc_html($hotel_name); ?></h3>
						<div class="stars">★★★★★</div>
						<a href="<?php echo esc_url($hotel_link); ?>" target="_blank" class="btn">Book Team Hotel</a>
					</div>
					
					
				</div>
				<div class="facility-info ">
					<?php if ( $facility_image ) { ?>
					<div class="facility-image" style="background-image: url('<?php echo esc_url($facility_image); ?>');"></div>
					<?php } ?>
					<?php if ( $facility_name ) { ?>
					<div class="facility-details">
						<h4><?php echo esc_html($facility_name); ?></h4>
						<p><?php echo wp_kses_post($facility_address); ?></p>
						<a href="<?php echo esc_url($facility_directions_link); ?>" target="_blank" class="btn">Training Facility Directions</a>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</section>
	<?php 
		} //end if 
	?>
	
	
	<?php 
	// Retrieve repeatable group data
	$itinerary_days = get_post_meta(get_the_ID(), 'itinerary_days', true);
	//$download_link = get_post_meta(get_the_ID(), 'itinerary_download', true);
	?>

	<section class="itinerary-section">
		<div class="container">
			<div class="itinerary-header">
				<h1>Camp Itinerary</h1>
				<?php /*if ($download_link): ?>
					<div class="download-btn">
						<a href="<?php echo esc_url($download_link); ?>" class="btn" download>Download General Itinerary</a>
					</div>
				<?php endif;*/ ?>
			</div>

				<?php
				// Retrieve itinerary data from post meta
				$itinerary_days = get_post_meta(get_the_ID(), 'itinerary_days', true) ? get_post_meta(get_the_ID(), 'itinerary_days', true) : get_post_meta(159, 'itinerary_days', true); //default to the Atlanta events

				if (!empty($itinerary_days)) : ?>
					<div class="itinerary-content">
						<?php foreach ($itinerary_days as $day_index => $day) : ?>
							<div class="itinerary-day ">
								<div class="day-header">
									<div class="day-label">Day <?php echo $day_index + 1; ?></div>
									<?php if (!empty($day['day_title'])) : ?>
										<div class="day-title"><?php echo esc_html($day['day_title']); ?></div>
									<?php endif; ?>
									<?php if (!empty($day['day_date']) ) : ?>
									
										<?php 
											$day_date = $day['day_date']; // Fetch the date from your array or custom field
											$date_object = new DateTime($day_date); // Create a DateTime object from that date

										?>
										<div class="day-date"><?php echo esc_html($date_object->format('M d')); ?></div>
									<?php endif; ?>
								</div>
								<?php if (!empty($day['schedule'])) : ?>
									<ul class="day-schedule">
										<?php
										// Split the schedule into individual items (assuming textarea entries are newline-separated)
										//echo "<pre>";
										//var_dump( $day['schedule'] );
										//echo "</pre>";
										
										//$schedule_items = explode("\n", $day['schedule']);
										foreach ($day['schedule'] as $schedule_item) :
											if (!empty($schedule_item)) : ?>
												<li class="wow fadeInLeft"><?php echo wp_kses_post(trim($schedule_item)); ?></li>
											<?php endif;
										endforeach; ?>
									</ul>
								<?php endif; ?>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>

		</div>
	</section>
	
	<?php 
	
	// Get the meta values
	$header_image = get_post_meta(get_the_ID(), 'camp_tickets_header_image', true) ? get_post_meta(get_the_ID(), 'camp_tickets_header_image', true) : 'https://cdn.prod.website-files.com/64d124bebeae431f3756cc77/65e8a96d03cbb273acbd96bb_cedric-letsch-UZVlSjrIJ3o-unsplashcompactado.png';
	$ticket_image = get_post_meta(get_the_ID(), 'camp_tickets_ticket_image', true) ? get_post_meta(get_the_ID(), 'camp_tickets_ticket_image', true) : 'https://cdn.prod.website-files.com/64d124bebeae431f3756cc77/66293c76333b6af28cd49f67_Los%20angeles.png';
	//$event_date = get_post_meta(get_the_ID(), 'camp_tickets_event_date', true) ?? '01/01/2026';
	$available_spots = get_post_meta(get_the_ID(), 'camp_tickets_available_spots', true) ?? '0';
	$event_title = get_post_meta(get_the_ID(), 'camp_tickets_event_title', true) ?? 'The title';
	$event_description = get_post_meta(get_the_ID(), 'camp_tickets_event_description', true) ?? 'The description';

	// Use these values in your HTML
	?>
	<section class="tickets qbiq-background-black" >
		<?php /* <div class="tickets-container" style="background-image: url('<?php echo esc_url($header_image); ?>');"> */ ?>
		<div class="tickets-container background-attachment-fixed " style="background-image: radial-gradient(circle at 50% 0, #0000, #2c1401), url('<?php echo esc_url($header_image); ?>'), radial-gradient(circle at 50% -35%, #fff8ef, #fff8ef);">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 col-md-6">
						<div class="ticket-container wow fadeInDown">
							
							<img class="image-fluid" src="<?php echo esc_url($ticket_image); ?>"/>
							<?php /* <div class="ticket">
								<div class="header">
									<span>LOS ANGELES</span>
								</div>
								<div class="event-details">
									<p class="event-name">QB EVENT PASS</p>
									<p class="barcode">343209</p>
								</div>
								<div class="footer">
									<img src="/wp-content/theme/pegasus-child/images/barcode.png" alt="Barcode"> <!-- Ensure you have a barcode image or generate it -->
								</div>
							</div>
							*/ ?>
						</div>
					</div>
					<div class="col-sm-12 col-md-6">
						<div class="event-info-container">
							<div class="event-info wow fadeIn">
								<div class="spots">
									<span><?php echo esc_html($available_spots); ?> spots</span>
								</div>
								
								<div class="date">
									<?php 
										$day_date2 = $event_date; // Fetch the date from your array or custom field
										$date_object2 = new DateTime($day_date2); // Create a DateTime object from that date
									?>
									<div class="format"><?php echo esc_html( $date_object2->format('M d') . '/' . $date_object2->format('Y') ); ?></div>
								</div>
								
								<div class="title">
									<h3><?php echo esc_html($event_title); ?></h3>
								</div>
								<div class="desc">
									<p><?php echo wp_kses_post($event_description); ?></p>
								</div>
								<a href="/register" class="btn qbiq-btn text-white mb-3">Register</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<!--
	<section class="p-3 vqdev-bg-light">
		<h2 class="mb-3 text-center  ">Sitemap</h2>
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<img class="aligncenter size-full wp-image-2525 mb-3 wow  animated" src="https://visionquestdevelopment.com/wp-content/uploads/2016/03/2016-03-13_17-42-29.png" alt="2016-03-13_17-42-29" style="visibility: visible;">
				</div>
				<div class="col-md-6">
					<div class=" wow  animated" data-wow-delay=".3s" style="visibility: visible; animation-delay: 0.3s;">
						<p><strong>Sitemap</strong>&nbsp;- usually a list of the links to pages that will be listed in the navigation or header, and/or listing of all pages on the website. This includes listing of all child and parent pages in a hierarchy fashion. </p>
					
						<p>This gives us an idea of how many pages will need to have on the website, in the navigation, and maybe even links in the footer. This also helps us estimate the price of the website, it is safe to assume that is costs about $100 a page if not more depending on functionality. This will also help determine what custom functionality is needed for each page like a staff page, portfolio page, calendar page, or custom sort and filter page.</p>
					</div>
				</div>
			</div>
		</div>
	</section>
-->

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

		<div class="container">
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
							/*if( 'off' === $final_page_header_option ) {
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
							<?php } */ ?>

							<?php the_content(); ?>

							<?php //comments_template(); ?>

						<?php endwhile; else: ?>
							<?php // kinda a 404 of sorts when not working  ?>
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
									// translators: %s: Name of current post 
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
					//get_sidebar( 'right' );
				}
				if( 'on' !== $left_align_sidebar_chk ) {
					//get_sidebar( 'right' );
				}
				?>

			</div><!--end row -->
		</div><!-- end container -->
	</div><!-- end page wrap -->
	

      <?php get_footer(); ?>

