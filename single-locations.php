<?php
/**
 * Single Location template
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
			// Full container page options
			$post_full_container_choice = get_post_meta( get_the_ID(), 'pegasus-page-container-checkbox', true );
			$global_full_container_option = pegasus_get_option( 'full_container_chk' );

			$pegasus_post_container_choice = ( 'on' === $post_full_container_choice ) ? 'container-fluid' : 'container';
			$pegasus_global_container_choice = ( 'on' === $global_full_container_option ) ? 'container-fluid' : 'container';
			$final_container_class = ( 'container-fluid' === $pegasus_global_container_choice ) ? $pegasus_global_container_choice : $pegasus_post_container_choice;

			$post_disable_page_header_choice = get_post_meta( get_the_ID(), 'pegasus-page-header-checkbox', true ) ? get_post_meta( get_the_ID(), 'pegasus-page-header-checkbox', true ) : 'off';
			$global_disable_page_header_option = pegasus_get_option( 'page_header_chk' ) ? pegasus_get_option( 'page_header_chk' ) : 'off';
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

			// If an additional header is selected, hide the default page title header.
			$post_additional_header_choice = get_post_meta( get_the_ID(), 'pegasus_page_header_select', true );
			if ( in_array( $post_additional_header_choice, array( 'sml-header', 'lrg-header' ), true ) ) {
				$final_page_header_option = 'on';
			}
		?>

		<div class="<?php echo $final_container_class; ?>">
			<div class="">
				<div class="inner-content">
					<div class="content-no-sidebar">
						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
							<?php if ( 'off' === $final_page_header_option ) { ?>
								<div class="page-header">
									<?php
									if ( '' === $page_title ) {
										echo '';
									} elseif ( $page_title ) {
										echo '<h1>';
										echo the_title();
										echo '</h1>';
									}
									?>
								</div>
							<?php } else { ?>
								<!--<div class="page-header-spacer"></div>-->
							<?php } ?>

							<?php the_content(); ?>

						<?php endwhile; else : ?>
							<div class="page-header">
								<h1>Oh no!</h1>
							</div>
							<p>No content is appearing for this page!</p>
						<?php endif; ?>
					</div>
				</div><!--end inner content-->
			</div><!--end row -->
		</div><!-- end container -->

		<?php
			$prefix = 'mabellas_location_';
			$location_id = get_the_ID();

			$display_name = get_post_meta( $location_id, $prefix . 'display_name', true );
			$street = get_post_meta( $location_id, $prefix . 'street', true );
			$street2 = get_post_meta( $location_id, $prefix . 'street2', true );
			$city = get_post_meta( $location_id, $prefix . 'city', true );
			$state = get_post_meta( $location_id, $prefix . 'state', true );
			$zip = get_post_meta( $location_id, $prefix . 'zip', true );
			$phone_display = get_post_meta( $location_id, $prefix . 'phone_display', true );
			$phone_tel = get_post_meta( $location_id, $prefix . 'phone_tel', true );
			$phone2_display = get_post_meta( $location_id, $prefix . 'phone2_display', true );
			$phone2_tel = get_post_meta( $location_id, $prefix . 'phone2_tel', true );
			$email = get_post_meta( $location_id, $prefix . 'email', true );
			$maps_url = get_post_meta( $location_id, $prefix . 'maps_url', true );
			$reservation_url = get_post_meta( $location_id, $prefix . 'reservation_url', true );
			$menu_url = get_post_meta( $location_id, $prefix . 'menu_url', true );
			$menu_button_text = get_post_meta( $location_id, $prefix . 'menu_button_text', true );
			$card_button_text = get_post_meta( $location_id, $prefix . 'card_button_text', true );
			$card_button_link = get_post_meta( $location_id, $prefix . 'card_button_link', true );
			$card_image_value = get_post_meta( $location_id, $prefix . 'card_background_image', true );

			$card_image = function_exists( 'mabellas_get_cmb2_image_url' )
				? mabellas_get_cmb2_image_url( $card_image_value )
				: '';

			$location_name = $display_name ? $display_name : get_the_title();
			$primary_text = $card_button_text ? $card_button_text : 'Order Online';
			$primary_link = $card_button_link ? $card_button_link : get_permalink( $location_id );
			$menu_text = $menu_button_text ? $menu_button_text : 'View Menu';
		?>

		<div class="container-fluid my-5 home-locations">
			<div class="container">
				<h1 class="text-white text-center mb-4"><?php echo esc_html( $location_name ); ?></h1>

				<div class="row g-4 align-items-start mb-5">
					<div class="col-12 col-lg-6">
						<?php if ( $card_image ) : ?>
							<div class="mabellas-location-image" style="background-image:url('<?php echo esc_url( $card_image ); ?>');"></div>
						<?php endif; ?>
					</div>

					<div class="col-12 col-lg-6">
						<div class="p-4 bg-white text-dark h-100">
							<h3 class="h4 mb-3">Location Details</h3>

							<?php if ( $street || $city || $state || $zip ) : ?>
								<p class="mb-3">
									<?php if ( $street ) : ?>
										<?php echo esc_html( $street ); ?><br>
									<?php endif; ?>
									<?php if ( $street2 ) : ?>
										<?php echo esc_html( $street2 ); ?><br>
									<?php endif; ?>
									<?php echo esc_html( trim( $city . ', ' . $state . ' ' . $zip ) ); ?>
								</p>
							<?php endif; ?>

							<?php if ( $phone_display && $phone_tel ) : ?>
								<p class="mb-2">
									<a href="tel:<?php echo esc_attr( $phone_tel ); ?>">
										<?php echo esc_html( $phone_display ); ?>
									</a>
								</p>
							<?php elseif ( $phone_display ) : ?>
								<p class="mb-2"><?php echo esc_html( $phone_display ); ?></p>
							<?php endif; ?>

							<?php if ( $phone2_display && $phone2_tel ) : ?>
								<p class="mb-2">
									<a href="tel:<?php echo esc_attr( $phone2_tel ); ?>">
										<?php echo esc_html( $phone2_display ); ?>
									</a>
								</p>
							<?php elseif ( $phone2_display ) : ?>
								<p class="mb-2"><?php echo esc_html( $phone2_display ); ?></p>
							<?php endif; ?>

							<?php if ( $email ) : ?>
								<p class="mb-0">
									<a href="mailto:<?php echo esc_attr( $email ); ?>">
										<?php echo esc_html( $email ); ?>
									</a>
								</p>
							<?php endif; ?>

							<?php if ( $maps_url ) : ?>
								<p class="mb-0">
									<a href="<?php echo esc_url( $maps_url ); ?>" target="_blank" rel="noopener">
										View on Google Maps
									</a>
								</p>
							<?php endif; ?>
						</div>
					</div>
				</div>

				<div class="row g-4">
					<div class="col-12 col-lg-4">
						<div class="card h-100 text-center">
							<div class="card-body d-flex flex-column justify-content-between">
								<h3 class="h5">Order Online</h3>
								<?php if ( $primary_link ) : ?>
									<a href="<?php echo esc_url( $primary_link ); ?>" class="mabellas-location-btn" target="_blank">
										<?php echo esc_html( $primary_text ); ?>
									</a>
								<?php endif; ?>
							</div>
						</div>
					</div>

					<div class="col-12 col-lg-4">
						<div class="card h-100 text-center">
							<div class="card-body d-flex flex-column justify-content-between">
								<h3 class="h5">Reserve a Table</h3>
								<?php if ( $reservation_url ) : ?>
									<a href="<?php echo esc_url( $reservation_url ); ?>" class="mabellas-location-btn" target="_blank">
										Reserve a Table
									</a>
								<?php endif; ?>
							</div>
						</div>
					</div>

					<div class="col-12 col-lg-4">
						<div class="card h-100 text-center">
							<div class="card-body d-flex flex-column justify-content-between">
								<h3 class="h5">Menu</h3>
								<?php if ( $menu_url ) : ?>
									<a href="<?php echo esc_url( $menu_url ); ?>" class="mabellas-location-btn">
										<?php echo esc_html( $menu_text ); ?>
									</a>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div><!-- end page wrap -->
	<?php get_footer(); ?>
