	<?php
	/* 
		Template Name: Home Template
	*/
	?>
	<?php get_header(); ?>
	
	<?php 
	
		//$child_theme_dir = get_stylesheet_directory();
		//$child_theme_dir = "https://54.167.10.86";
	
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
					</div>
				</div><!--end inner content-->

			</div><!--end row -->
		</div><!-- end container -->
	</div><!-- end page wrap -->

	<main>
        <!-- Banner area start here -->
        <section class=" pt-50 pb-30">
			
            <div class="container">
				<h2>New Products</h2>
                <div class="row g-4">
                    <div class="col-lg-6">
                        <?php 
						
							$product = wc_get_product(60);
    
							if (!$product) {
								echo '<p>Product not found.</p>';
								return;
							}
							
							// Get product details
							$permalink = get_permalink($product_id);
							$title = $product->get_name();
							$thumbnail_id = $product->get_image_id();
							$image_url = wp_get_attachment_image_url($thumbnail_id, 'full');
							
							// HTML output using your provided structure
							echo '<div class="banner__item">
									<div class="image">
										<img src="' . esc_url($image_url) . '" alt="' . esc_attr($title) . '">
									</div>
									<div class="banner__content">
										
										<h1 class="wow fadeInUp" data-wow-delay=".2s">Improve Your Defense <br>
										   Protect Your <span class="primary-color">Collectibles</span></h1>
										<a class="btn-one wow fadeInUp mt-65" data-wow-delay=".3s" href="' . esc_url($permalink . '/shop') . '"><span>Shop
												Now</span></a>
									</div>
								</div>';
						
						?>
						
						
                    </div>
                    <div class="col-lg-6">
                        <div class="swiper product__slider">
                            <div class="swiper-wrapper">
							
								<?php 
								
									// Query parameters
									$args = array(
										'post_type' => 'product',
										'posts_per_page' => 10, // Change the number of products you want to show
									);

									// WP_Query
									$query = new WP_Query($args);

									// Loop through the products
									if ($query->have_posts()) {
										while ($query->have_posts()) {
											$query->the_post();
											global $product;

											// Product details
											$permalink = get_the_permalink();
											$title = get_the_title();
											$thumbnail_id = get_post_thumbnail_id();
											$image_url = wp_get_attachment_image_url($thumbnail_id, 'full');
											$price_html = $product->get_price_html();
											$rating_count = $product->get_rating_count();
											$average = $product->get_average_rating();

											// HTML output
											echo '<div class="swiper-slide">
													<div class="product__slider-item bor">
														<a href="#0" class="wishlist"><i class="fa-regular fa-heart"></i></a>
														<a href="' . esc_url($permalink) . '" class="product__image pt-20 d-block">
															<img src="' . esc_url($image_url) . '" alt="' . esc_attr($title) . '">
														</a>
														<div class="product__content">
															<h4 class="mb-15"><a class="primary-hover" href="' . esc_url($permalink) . '">' . esc_html($title) . '</a></h4>
															' . $price_html . '
															<div class="star mt-20">';
															for ($i = 0; $i < 5; $i++) {
																echo '<i class="fa-solid fa-star' . ($i < $average ? ' filled' : '') . '"></i>';
															}
															echo '</div>
														</div>
													</div>
												</div>';
										}
										// Reset post data
										wp_reset_postdata();
									} else {
										echo '<p>No products found.</p>';
									}
								
								?>
								
                              
                            </div>
                            <div class="dot product__dot mt-40"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Banner area end here -->
		
        <!-- Category area start here -->
        <section class="category-area pb-130">
            <div class="container">
                <div class="sub-title wow fadeInUp text-center mb-65" data-wow-delay=".1s">
                    <h3><span class="title-icon"></span>   categories <span class="title-icon"></span>
                    </h3>
                </div>
                <div class="swiper category__slider">
                    <div class="swiper-wrapper">
                        <?php
							
							$uncategorized = get_term_by('slug', 'uncategorized', 'product_cat');
							$uncategorized_id = $uncategorized ? $uncategorized->term_id : 0;
							
							// Get product categories
							$args = array(
								'taxonomy'   => 'product_cat',
								'orderby'    => 'name',
								'order'      => 'ASC',
								'hide_empty' => false,
								'exclude'    => array($uncategorized_id),
							);

							$product_categories = get_terms($args);

							// Check if categories are found
							if (!empty($product_categories) && !is_wp_error($product_categories)) {
								echo '<div class="swiper-wrapper">';
								foreach ($product_categories as $category) {
									$thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
									$image_url = wp_get_attachment_url($thumbnail_id);
									$category_url = get_term_link($category);
									$category_icon_url = '/wp-content/themes/pegasus-child/assets/images/category/category-icon1.png'; // Example static icon for each category
									
									$final_image = isset($image_url) ? $image_url : $category_icon_url;
									
									
									echo '<div class="swiper-slide">
											<div class="category__item text-center">
												<a href="' . esc_url($category_url) . '" class="category__image d-block">
													<!--<img src="' . esc_url($final_image) . '" alt="' . esc_attr($category->name) . '">-->
													<div class="category-icon">
														<img src="' . esc_url($final_image) . '" alt="icon">
													</div>
												</a>
												<h4 class="mt-30"><a href="' . esc_url($category_url) . '">' . esc_html($category->name) . '</a></h4>
											</div>
										</div>';
								}
								echo '</div>';
							} else {
								echo '<p>No product categories found.</p>';
							}
						
						?>
                    </div>
                </div>
            </div>
        </section>
       
		 
		 <?php
			$args = array(
				'post_type'      => 'card_sets',
				'posts_per_page' => 2, // Adjust as needed
				'orderby'        => 'date',
				'order'          => 'DESC',
			);

			$query = new WP_Query($args);

			if ($query->have_posts()) :
			?>
			<section class="ad-banner-area">
				<div class="container text-center mb-3"> 
					<h2>Archive Updates</h2>
		
					<h4>Discover New and Innovative Ways to Collect!</h4>
					<p>We are working diligently to bring expertise to your fingertips! Our archives will help you understand the collecting landscape and the myriad of variations that (for now) Yu-Gi-Oh! has to offer. More to come on this as we expand, but we highly encourage you to check out our archives for exciting varieties.</p>

				</div>
				<div class="container-fluid p-0">
					<div class="row g-4">
						<?php
						$count = 0;
						while ($query->have_posts()) :
							$query->the_post();
							
							$bg_image = get_the_post_thumbnail_url(get_the_ID(), 'full'); // Get featured image
							$alt_image = get_post_meta(get_the_ID(), 'pegasus_card_sets_alt_image', true);
							$alt_title = get_post_meta(get_the_ID(), 'pegasus_card_sets_alt_title', true);
							$final_title = !empty($alt_title) ? $alt_title : get_the_title();
							
							//echo "<pre>";
							//var_dump($alt_title);
							//echo "</pre>";
							
							if ( '' === $alt_image || null === $alt_image ) {
								$alt_image = 'https://sagescnc.com/wp-content/themes/pegasus-child/assets/images/banner/ad-banner2.jpg';
							}
							
							//echo "<pre>";
							//echo var_dump($alt_image);
							//echo "<pre>";
							
							// Use alt_image if set, otherwise use featured image
							//$image_url = !empty($alt_image) ? wp_get_attachment_url($alt_image) : $bg_image;
							//$image_url = $bg_image ? $bg_image : $alt_image;
							
							$animation = ($count % 2 === 0) ? 'fadeInUp' : 'fadeInDown';
							$content_class = ($count % 2 === 0) ? 'left' : 'pl-65';
						?>
						<div class="col-lg-6">
							<div>
								<div class="ad-banner__item">
									<div class="bg-image" data-background="<?php echo esc_url($alt_image); ?>"></div>
									<div class="ad-banner__content  ">
										
										<h2 class="mb-20 wow <?php echo esc_attr($animation); ?>" data-wow-delay=".1s">
											<?php echo $final_title; ?>
										</h2>
										
										<p class="wow <?php echo esc_attr($animation); ?>" data-wow-delay=".2s">
											<?php echo get_the_excerpt(); ?>
										</p>
										
										<?php /*
										<a class="btn-one-light wow <?php echo esc_attr($animation); ?> ml-10 mt-50" data-wow-delay=".4s"
											href="<?php the_permalink(); ?>">
											<span>View Store</span>
										</a>
										*/ ?>
									</div>
									
								</div>
								<a class="btn-one mt-50 home-buttons wow <?php echo esc_attr($animation); ?>" data-wow-delay=".3s"
									href="<?php the_permalink(); ?>">
									<span>View Archive</span>
								</a>
							</div>	
						</div>
						<?php
							$count++;
						endwhile;
						?>
					</div>
				</div>
			</section>
			<?php
			wp_reset_postdata();
			wp_reset_query();
			endif;
			?>


       
		<?php /*
		<section class="container-fluid">
			<?php echo do_shortcode('[pegasus_testimonial_slider id="16364"]' ); ?>
		</section>
		*/ ?>
       
        <!-- Service area start here -->
        <section class="service-area pt-130 pb-130">
			<h2 class="center" >Sign Up Today For A Promo Code!</h2>
			<h5 class="center" >Get 20% Off Your First Purchase</h5>
            <div class="container">
                <div class="row g-4 align-items-center justify-content-center justify-content-lg-start">
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="service__item mb-50 wow fadeInUp" data-wow-delay=".1s">
                            <div class="service__icon">
                                <img src="/wp-content/themes/pegasus-child/assets/images/icon/feature-icon1.png" alt="icon">
                            </div>
                            <div class="service__content">
                                <h4>Free delivery</h4>
                                <p>For all orders above $100</p>
                            </div>
                        </div>
                        <div class="service__item wow fadeInUp" data-wow-delay=".2s">
                            <div class="service__icon">
                                <img src="/wp-content/themes/pegasus-child/assets/images/icon/feature-icon2.png" alt="icon">
                            </div>
                            <div class="service__content">
                                <h4>Secure payments</h4>
                                <p>On Multiple Platforms</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-4 d-none d-lg-block wow bounceIn" data-wow-delay=".7s">
                        <div class="service__image image">
                            <!--<img src="/wp-content/themes/pegasus-child/assets/images/service/service-image.png" alt="image">-->
                            <img src="/wp-content/uploads/2025/04/Red-Rain-Image.png" alt="image">
                            <div class="section-header service-header d-flex align-items-center">
                                <!--<span class="title-icon mr-10"></span>
                                <h2>sign up & save 25%</h2>-->
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="service__item mb-50 wow fadeInUp" data-wow-delay=".3s">
                            <div class="service__icon">
                                <img src="/wp-content/themes/pegasus-child/assets/images/icon/feature-icon3.png" alt="icon">
                            </div>
                            <div class="service__content">
                                <h4>Guaranteed Quality</h4>
                                <!--<p>sayhello&amp;gazacom</p>-->
                            </div>
                        </div>
                        <div class="service__item wow fadeInUp" data-wow-delay=".4s">
                            <div class="service__icon">
                                <img src="/wp-content/themes/pegasus-child/assets/images/icon/feature-icon4.png" alt="icon">
                            </div>
                            <div class="service__content">
                                <h4>No Hassle Returns</h4>
                                <!--<p>money back guranry</p>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Service area end here -->

       
	
    <?php get_footer(); ?>
	
