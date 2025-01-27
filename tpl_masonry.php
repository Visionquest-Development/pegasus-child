<?php
/*
	Template Name: Masonry Template
*/
?>
	<?php get_header(); ?>
	
	<?php 
		$cars = [
			[
				"name" => "Abarth",
				"image" => "http://pegasustheme.com/wp-content/uploads/2025/01/abarth.png",
				"url" => "https://www.abarth.com/"
			],
			[
				"name" => "Acura",
				"image" => "http://pegasustheme.com/wp-content/uploads/2025/01/Acura.png",
				"url" => "https://www.acura.com"
			],
			[
				"name" => "Alfa Romeo",
				"image" => "http://pegasustheme.com/wp-content/uploads/2025/01/alfaromeo.png",
				"url" => "https://www.alfaromeo.com"
			],
			[
				"name" => "Aston Martin",
				"image" => "http://pegasustheme.com/wp-content/uploads/2025/01/Aston-Martin.png",
				"url" => "https://www.astonmartin.com"
			],
			[
				"name" => "Audi",
				"image" => "http://pegasustheme.com/wp-content/uploads/2025/01/Audi.png",
				"url" => "https://www.audi.com"
			],
			[
				"name" => "Bentley",
				"image" => "http://pegasustheme.com/wp-content/uploads/2025/01/bentley.png",
				"url" => "https://www.bentleymotors.com"
			],
			[
				"name" => "Bmw",
				"image" => "http://pegasustheme.com/wp-content/uploads/2025/01/BMW.png",
				"url" => "https://www.bmw.com"
			],
			[
				"name" => "Buick",
				"image" => "http://pegasustheme.com/wp-content/uploads/2025/01/Buick.png",
				"url" => "https://www.buick.com"
			],
			[
				"name" => "Cadillac",
				"image" => "http://pegasustheme.com/wp-content/uploads/2025/01/Cadillac.png",
				"url" => "https://www.cadillac.com"
			],
			[
				"name" => "Chevrolet",
				"image" => "http://pegasustheme.com/wp-content/uploads/2025/01/Chevrolet.png",
				"url" => "https://www.chevrolet.com"
			],
			[
				"name" => "Chrysler",
				"image" => "http://pegasustheme.com/wp-content/uploads/2025/01/chrysler.png",
				"url" => "https://www.chrysler.com"
			],
			[
				"name" => "Citroën",
				"image" => "http://pegasustheme.com/wp-content/uploads/2025/01/Citroen_izmostock.png",
				"url" => "https://www.citroen.com"
			],
			[
				"name" => "Dacia",
				"image" => "http://pegasustheme.com/wp-content/uploads/2025/01/Dacia.png",
				"url" => "https://www.dacia.com"
			],
			[
				"name" => "Dodge",
				"image" => "http://pegasustheme.com/wp-content/uploads/2025/01/Dodge.png",
				"url" => "https://www.dodge.com"
			],
			[
				"name" => "Ferrari",
				"image" => "http://pegasustheme.com/wp-content/uploads/2025/01/Ferrari.png",
				"url" => "https://www.ferrari.com"
			],
			[
				"name" => "Fiat",
				"image" => "http://pegasustheme.com/wp-content/uploads/2025/01/fiat-1.png",
				"url" => "https://www.fiat.com"
			],
			[
				"name" => "Ford",
				"image" => "http://pegasustheme.com/wp-content/uploads/2025/01/Ford.png",
				"url" => "https://www.ford.com"
			],
			[
				"name" => "GMC",
				"image" => "http://pegasustheme.com/wp-content/uploads/2025/01/gmc.png",
				"url" => "https://www.gmc.com"
			],
			[
				"name" => "Honda",
				"image" => "http://pegasustheme.com/wp-content/uploads/2025/01/honda.png",
				"url" => "https://www.honda.com"
			],
			[
				"name" => "Hummer",
				"image" => "http://pegasustheme.com/wp-content/uploads/2025/01/Hummer.png",
				"url" => "https://www.hummer.com"
			],
			[
				"name" => "Hyundai",
				"image" => "http://pegasustheme.com/wp-content/uploads/2025/01/Hyundai.png",
				"url" => "https://www.hyundai.com"
			],
			[
				"name" => "Infiniti",
				"image" => "http://pegasustheme.com/wp-content/uploads/2025/01/infinity.png",
				"url" => "https://www.infiniti.com"
			],
			[
				"name" => "Isuzu",
				"image" => "http://pegasustheme.com/wp-content/uploads/2025/01/Isuzu.png",
				"url" => "https://www.isuzu.com"
			],
			[
				"name" => "Jaguar",
				"image" => "http://pegasustheme.com/wp-content/uploads/2025/01/Jaguar.png",
				"url" => "https://www.jaguar.com"
			],
			[
				"name" => "Jeep",
				"image" => "http://pegasustheme.com/wp-content/uploads/2025/01/Jeep.png",
				"url" => "https://www.jeep.com"
			],
			[
				"name" => "Kia",
				"image" => "http://pegasustheme.com/wp-content/uploads/2025/01/kia-1.png",
				"url" => "https://www.kia.com"
			],
			[
				"name" => "Lamborghini",
				"image" => "http://pegasustheme.com/wp-content/uploads/2025/01/Lamborghini.png",
				"url" => "https://www.lamborghini.com"
			],
			[
				"name" => "Lancia",
				"image" => "http://pegasustheme.com/wp-content/uploads/2025/01/lancia-1.png",
				"url" => "https://www.lancia.com"
			],
			[
				"name" => "Land Rover",
				"image" => "http://pegasustheme.com/wp-content/uploads/2025/01/landrover.png",
				"url" => "https://www.landrover.com"
			],
			[
				"name" => "Lexus",
				"image" => "http://pegasustheme.com/wp-content/uploads/2025/01/Lexus.png",
				"url" => "https://www.lexus.com"
			],
			[
				"name" => "Lincoln",
				"image" => "http://pegasustheme.com/wp-content/uploads/2025/01/Lincoln.png",
				"url" => "https://www.lincoln.com"
			],
			[
				"name" => "Lotus",
				"image" => "http://pegasustheme.com/wp-content/uploads/2025/01/Lotus.png",
				"url" => "https://www.lotuscars.com"
			],
			[
				"name" => "Maserati",
				"image" => "http://pegasustheme.com/wp-content/uploads/2025/01/maserati.png",
				"url" => "https://www.maserati.com"
			],
			[
				"name" => "Mazda",
				"image" => "http://pegasustheme.com/wp-content/uploads/2025/01/mazda-1.png",
				"url" => "https://www.mazda.com"
			],
			[
				"name" => "Mercedes-Benz",
				"image" => "http://pegasustheme.com/wp-content/uploads/2025/01/Mercedes-Benz.png",
				"url" => "https://www.mercedes-benz.com"
			],
			[
				"name" => "Mercury",
				"image" => "http://pegasustheme.com/wp-content/uploads/2025/01/Mercury.png",
				"url" => "https://www.mercuryvehicles.com"
			],
			[
				"name" => "Mini",
				"image" => "http://pegasustheme.com/wp-content/uploads/2025/01/Mini.png",
				"url" => "https://www.mini.com"
			],
			[
				"name" => "Mitsubishi",
				"image" => "http://pegasustheme.com/wp-content/uploads/2025/01/Mitsubishi.png",
				"url" => "https://www.mitsubishi-motors.com"
			],
			[
				"name" => "Nissan",
				"image" => "http://pegasustheme.com/wp-content/uploads/2025/01/Nissan.png",
				"url" => "https://www.nissan-global.com"
			],
			[
				"name" => "Opel",
				"image" => "http://pegasustheme.com/wp-content/uploads/2025/01/Opel.png",
				"url" => "https://www.opel.com"
			],
			[
				"name" => "Peugeot",
				"image" => "http://pegasustheme.com/wp-content/uploads/2025/01/Peugeot.png",
				"url" => "https://www.peugeot.com"
			],
			[
				"name" => "Pontiac",
				"image" => "http://pegasustheme.com/wp-content/uploads/2025/01/Pontiac.png",
				"url" => "https://www.pontiac.com"
			],
			[
				"name" => "Porsche",
				"image" => "http://pegasustheme.com/wp-content/uploads/2025/01/Porsche.png",
				"url" => "https://www.porsche.com"
			],
			[
				"name" => "Ram",
				"image" => "http://pegasustheme.com/wp-content/uploads/2025/01/Ram.png",
				"url" => "https://www.ramtrucks.com"
			],
			[
				"name" => "Renault",
				"image" => "http://pegasustheme.com/wp-content/uploads/2025/01/Renault.png",
				"url" => "https://www.renault.com"
			],
			[
				"name" => "Saab",
				"image" => "http://pegasustheme.com/wp-content/uploads/2025/01/Saab.png",
				"url" => "https://www.saab.com"
			],
			[
				"name" => "Saturn",
				"image" => "http://pegasustheme.com/wp-content/uploads/2025/01/Saturn.png",
				"url" => "https://www.saturn.com"
			],
			[
				"name" => "Scion",
				"image" => "http://pegasustheme.com/wp-content/uploads/2025/01/Scion.png",
				"url" => "https://www.scion.com"
			],
			[
				"name" => "Seat",
				"image" => "http://pegasustheme.com/wp-content/uploads/2025/01/Seat.png",
				"url" => "https://www.seat.com"
			],
			[
				"name" => "Škoda",
				"image" => "http://pegasustheme.com/wp-content/uploads/2025/01/Skoda.png",
				"url" => "https://www.skoda-auto.com"
			],
			[
				"name" => "Smart",
				"image" => "http://pegasustheme.com/wp-content/uploads/2025/01/Smart.png",
				"url" => "https://www.smart.com"
			],
			[
				"name" => "SsangYong",
				"image" => "http://pegasustheme.com/wp-content/uploads/2025/01/SsangYong-1.png",
				"url" => "https://www.smotor.com"
			],
			[
				"name" => "Subaru",
				"image" => "http://pegasustheme.com/wp-content/uploads/2025/01/Subaru.png",
				"url" => "https://www.subaru.com"
			],
			[
				"name" => "Suzuki",
				"image" => "http://pegasustheme.com/wp-content/uploads/2025/01/Suzuki.png",
				"url" => "https://www.globalsuzuki.com"
			],
			[
				"name" => "Tesla",
				"image" => "http://pegasustheme.com/wp-content/uploads/2025/01/Tesla.png",
				"url" => "https://www.tesla.com/"
			],
			[
				"name" => "Toyota",
				"image" => "http://pegasustheme.com/wp-content/uploads/2025/01/Toyota.png",
				"url" => "https://www.toyota.com/"
			],
			[
				"name" => "Volkswagen",
				"image" => "http://pegasustheme.com/wp-content/uploads/2025/01/Volkswagen.png",
				"url" => "https://vw.com"
			],
			[
				"name" => "Volvo",
				"image" => "http://pegasustheme.com/wp-content/uploads/2025/01/Volvo-1.png",
				"url" => "https://www.volvocars.com/"
			],
			[
				"name" => "Wiesmann",
				"image" => "http://pegasustheme.com/wp-content/uploads/2025/01/wiesmann.png",
				"url" => "https://wiesmann.com/"
			]
		];
		
		function displayCars($cars) {
			$outputValue = ''; // Initialize the output string
			$outputValue .= '<div class="pegasus-logo-slider-wrapper">';
			foreach ($cars as $car) {
				$outputValue .= '
				<div class="pegasus-logo-slider-container mb-5">
					<div class="logo-details">
						<div class="">
							<a 
								href="' . htmlspecialchars($car["image"]) . '" 
								data-lightbox="pegasus_logo_slider_lightbox" 
								data-title="' . htmlspecialchars($car["name"]) . '"
							>
								<img 
									class="img-fluid" 
									src="' . htmlspecialchars($car["image"]) . '" 
									alt="' . htmlspecialchars($car["name"]) . '"
								>
							</a>
						</div>
						<div class="text-center">
							<a href="' . htmlspecialchars($car["url"]) . '" target="_blank">
								' . htmlspecialchars($car["name"]) . '
							</a>
						</div>
					</div>
				</div>
				';
			}
			$outputValue .= '</div>';
			return $outputValue;
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
										echo '<h1 class="mb-5">';
										echo the_title();
										echo '</h1>';
									}
									?>
								</div>
							<?php }else{ ?>
								<div class="page-header-spacer"></div>
							<?php } ?>



							


							<?php

								wp_enqueue_script( 'images-loaded-js' );
								wp_enqueue_script( 'masonry-js' );
								wp_enqueue_script( 'pegasus-masonry-plugin' );
								echo "<h2>Masonry - Advanced Example</h2>";
								echo displayCars($cars);


							?>
							
							<?php echo "<h2>Masonry - Basic Example</h2>"; ?>
							
							<?php the_content(); ?>
							
							<?php
								$shortcodes = get_post_meta($post->ID, 'pegasus_theme_child_shortcodes', true);
								$githubUrl = get_post_meta($post->ID, 'pegasus_theme_child_github_url', true);

								//var_dump( $shortcodes );

								// Check if there are any shortcodes
								if (!empty($shortcodes)) {
									foreach ($shortcodes as $shortcode) {
										echo '<div class="pegasus-plugin-shortcode clearfix">';
										// echo '<pre>';
										// var_dump( $shortcode );
										// echo '</pre>';
										// Output the main shortcode
										if (!empty($shortcode['shortcode'])) {
											echo '<div class="mt-3 mb-3">';
											echo do_shortcode($shortcode['shortcode']);
											echo '</div>';
										}

										if (!empty($shortcode['shortcode_example'])) {
											echo '<pre class="mb-3"><code class="language-javascript">' . esc_html($shortcode['shortcode_example']) . '</code></pre>';
										}

										//echo '<br/>';

										// Output the settings table shortcode
										if (!empty($shortcode['shortcode_settings_table'])) {
											echo do_shortcode($shortcode['shortcode_settings_table']);
										}
										echo '</div>';
									}
								}

								if (!empty($githubUrl))
								echo '<a class="btn btn-primary mt-3 mb-3" href="' . $githubUrl . '" target="_blank">Github URL</a>';

							?>



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
