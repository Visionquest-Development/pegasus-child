
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
        <section class=" pt-100 pb-100">
			
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
										<h5 class="wow fadeInUp" data-wow-delay=".1s"><img src="/wp-content/themes/pegasus-child/assets/images/icon/fire.svg"
												alt="icon"> GET <span class="primary-color">25% OFF</span> NOW
										</h5>
										<h1 class="wow fadeInUp" data-wow-delay=".2s">Improve Your Defense <br>
										   Protect Your <span class="primary-color">Collectibles</span></h1>
										<a class="btn-one wow fadeInUp mt-65" data-wow-delay=".3s" href="' . esc_url($permalink . '/shop') . '"><span>Shop
												Now</span></a>
									</div>
								</div>';
						
						?>
						
						<!--<div class="banner__item">
                            <div class="image">
                                <img src="/wp-content/themes/pegasus-child/assets/images/banner/banner-image1.png" alt="image">
                            </div>
                            <div class="banner__content">
                                <h5 class="wow fadeInUp" data-wow-delay=".1s"><img src="/wp-content/themes/pegasus-child/assets/images/icon/fire.svg"
                                        alt="icon"> GET <span class="primary-color">25% OFF</span> NOW
                                </h5>
                                <h1 class="wow fadeInUp" data-wow-delay=".2s">Improve Your Defense <br>
                                   Protect Your <span class="primary-color">Collectibles</span></h1>
                                <a class="btn-one wow fadeInUp mt-65" data-wow-delay=".3s" href="shop.html"><span>Shop
                                        Now</span></a>
                            </div>
                        </div>-->
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
								
                                <!--<div class="swiper-slide">
                                    <div class="product__slider-item bor">
                                        <a href="#0" class="wishlist"><i class="fa-regular fa-heart"></i></a>
                                        <a href="shop-single.html" class="product__image pt-20 d-block">
                                            <img src="/wp-content/themes/pegasus-child/assets/images/product/product-image1.png" alt="image">
                                        </a>
                                        <div class="product__content">
                                            <h4 class="mb-15"><a class="primary-hover"
                                                    href="shop-single.html">Disposable
                                                    Sub-Ohm Tank</a></h4>
                                            <del>$74.50</del><span class="primary-color ml-10">$49.50</span>
                                            <div class="star mt-20">
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="product__slider-item bor">
                                        <a href="#0" class="wishlist"><i class="fa-regular fa-heart"></i></a>
                                        <a href="shop-single.html" class="product__image pt-20 d-block">
                                            <img src="/wp-content/themes/pegasus-child/assets/images/product/product-image2.png" alt="image">
                                        </a>
                                        <div class="product__content">
                                            <h4 class="mb-15"><a class="primary-hover" href="shop-single.html">POP Extra
                                                    Strawberry</a></h4>
                                            <del>$74.50</del><span class="primary-color ml-10">$49.50</span>
                                            <div class="star mt-20">
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="product__slider-item bor">
                                        <a href="#0" class="wishlist"><i class="fa-regular fa-heart"></i></a>
                                        <a href="shop-single.html" class="product__image pt-20 d-block">
                                            <img src="/wp-content/themes/pegasus-child/assets/images/product/product-image3.png" alt="image">
                                        </a>
                                        <div class="product__content">
                                            <h4 class="mb-15"><a class="primary-hover"
                                                    href="shop-single.html">Concentrate Vaporizers</a></h4>
                                            <del>$74.50</del><span class="primary-color ml-10">$49.50</span>
                                            <div class="star mt-20">
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                            </div>

                                        </div>
                                    </div>
                                </div>-->
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
        <!-- Category area end here -->

		<!--
		Discover New and Innovative Ways to Collect!
		We are working diligently to bring expertise to your fingertips! Our archives will help you understand the collecting landscape and the myriad of variations that (for now) Yu-Gi-Oh! has to offer. More to come on this as we expand, but we highly encourage you to check out our archives for exciting varieties.
		-->
		
		
        <!-- Ad banner area start here 
        <section class="ad-banner-area">
            <div class="container-fluid p-0">
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="ad-banner__item">
                            <div class="bg-image" data-background="https://54.167.10.86/wp-content/themes/pegasus-child/assets/images/banner/ad-banner1.jpg"></div>
                            <div class="ad-banner__content left pt-130 pb-130">
                                <h2 class="mb-20 wow fadeInUp" data-wow-delay=".1s">E-Liquids</h2>
                                <p class="wow fadeInUp" data-wow-delay=".2s">Over 500+ flavour in our store</p>
                                <a data-wow-delay=".3s" class="btn-one wow fadeInUp mt-50" href="shop.html"><span>Shop
                                        Now</span></a>
                                <a data-wow-delay=".4s" class="btn-one-light wow fadeInUp ml-10 mt-50"
                                    href="shop.html"><span>View
                                        Store</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="ad-banner__item">
                            <div class="bg-image" data-background="https://54.167.10.86/wp-content/themes/pegasus-child/assets/images/banner/ad-banner2.jpg"></div>
                            <div class="ad-banner__content pt-130 pb-130 pl-65">
                                <h2 class="mb-20 wow fadeInDown" data-wow-delay=".1s">E-Liquids</h2>
                                <p class="wow fadeInDown" data-wow-delay=".2s">Over 500+ flavour in our store</p>
                                <a class="btn-one mt-50 wow fadeInDown" data-wow-delay=".3s" href="shop.html"><span>Shop
                                        Now</span></a>
                                <a class="btn-one-light wow fadeInDown ml-10 mt-50" data-wow-delay=".4s"
                                    href="shop.html"><span>View
                                        Store</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
         Ad banner area end here -->
		 
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
								$alt_image = 'https://54.167.10.86/wp-content/themes/pegasus-child/assets/images/banner/ad-banner2.jpg';
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
			endif;
			?>


        <!-- Product area start here -->
		<?php /* 
        <section class="product-area pt-130 pb-130">
            <div class="container">
                <div
                    class="product__wrp pb-30 mb-65 bor-bottom d-flex flex-wrap align-items-center justify-content-xl-between justify-content-center">
                    <div class="section-header wow fadeInUp d-flex align-items-center" data-wow-delay=".1s">
                        <span class="title-icon mr-10"></span>
                        <h2>latest arrival products</h2>
                    </div>
                    <ul class="nav nav-pills mt-4 mt-xl-0">
                        <li class="nav-item">
                            <a href="#latest-item" data-bs-toggle="tab" class="nav-link wow fadeInUp px-4 active"
                                data-wow-delay=".1s">
                                latest item
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#top-ratting" data-bs-toggle="tab"
                                class="nav-link wow fadeInUp px-4 bor-left bor-right" data-wow-delay=".2s">
                                top ratting
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#featured-products" data-bs-toggle="tab" class="nav-link wow fadeInUp px-4"
                                data-wow-delay=".3s">
                                featured products
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="row g-4">
                    <div class="col-xl-3 col-lg-4">
                        <div class="product__left-item sub-bg">
                            <h4 class="mb-30 left-title">Special Offer</h4>
                            <div class="image mb-30">
                                <img src="/wp-content/themes/pegasus-child/assets/images/coundown/coundown-image1.png" alt="image">
                            </div>
                            <div class="product__content p-0">
                                <h4 class="mb-15"><a class="primary-hover" href="shop-single.html">Mango Nic
                                        Salt
                                        E-Liquidt</a></h4>
                                <del>$74.50</del><span class="primary-color ml-10">$49.50</span>
                                <div class="star mt-15">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </div>
                            </div>
                            <div class="image pt-40 mb-30 bor-top mt-40">
                                <img src="/wp-content/themes/pegasus-child/assets/images/coundown/coundown-image2.png" alt="image">
                            </div>
                            <div class="product__content p-0">
                                <h4 class="mb-15"><a class="primary-hover" href="shop-single.html">Watermelon
                                        Nic
                                        Salt</a></h4>
                                <del>$74.50</del><span class="primary-color ml-10">$49.50</span>
                                <div class="star mt-15">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </div>
                            </div>
                            <div class="product__coundown pt-30 bor-top mt-40">
                                <h4>Hurry Up!</h4>
                                <span>offer ends in</span>
                                <div class="d-flex align-items-center gap-3 flex-wrap mt-25">
                                    <div class="coundown-item">
                                        <span id="day"></span>
                                        <h6>Day</h6>
                                    </div>
                                    <div class="coundown-item">
                                        <span id="hour"></span>
                                        <h6>hour</h6>
                                    </div>
                                    <div class="coundown-item">
                                        <span id="min"></span>
                                        <h6>min</h6>
                                    </div>
                                    <div class="coundown-item">
                                        <span id="sec"></span>
                                        <h6>Sec</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-8">
                        <div class="tab-content">
                            <div id="latest-item" class="tab-pane fade show active">
                                <div class="row g-4">
                                    <div class="col-xl-4 col-lg-6 col-md-6">
                                        <div class="product__item bor">
                                            <a href="#0" class="wishlist"><i class="fa-regular fa-heart"></i></a>
                                            <a href="shop-single.html" class="product__image pt-20 d-block">
                                                <img class="font-image" src="/wp-content/themes/pegasus-child/assets/images/product/product-image1.png"
                                                    alt="image">
                                                <img class="back-image" src="/wp-content/themes/pegasus-child/assets/images/product/product-image3.png"
                                                    alt="image">
                                            </a>
                                            <div class="product__content">
                                                <h4 class="mb-15"><a class="primary-hover"
                                                        href="shop-single.html">Menthol
                                                        E-Cigarette Kit</a></h4>
                                                <del>$74.50</del><span class="primary-color ml-10">$49.50</span>
                                                <div class="star mt-20">
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                </div>

                                            </div>
                                            <a class="product__cart d-block bor-top" href="#0"><i
                                                    class="fa-regular fa-cart-shopping primary-color me-1"></i>
                                                <span>Add to
                                                    cart</span></a>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-6">
                                        <div class="product__item bor">
                                            <a href="#0" class="wishlist"><i class="fa-regular fa-heart"></i></a>
                                            <a href="shop-single.html" class="product__image pt-20 d-block">
                                                <img class="font-image" src="/wp-content/themes/pegasus-child/assets/images/product/product-image2.png"
                                                    alt="image">
                                                <img class="back-image" src="/wp-content/themes/pegasus-child/assets/images/product/product-image4.png"
                                                    alt="image">
                                            </a>
                                            <div class="product__content">
                                                <h4 class="mb-15"><a class="primary-hover"
                                                        href="shop-single.html">Disposable
                                                        Sub-Ohm Tank</a></h4>
                                                <del>$74.50</del><span class="primary-color ml-10">$49.50</span>
                                                <div class="star mt-20">
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                </div>

                                            </div>
                                            <a class="product__cart d-block bor-top" href="#0"><i
                                                    class="fa-regular fa-cart-shopping primary-color me-1"></i>
                                                <span>Add to
                                                    cart</span></a>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-6">
                                        <div class="product__item bor">
                                            <a href="#0" class="wishlist"><i class="fa-regular fa-heart"></i></a>
                                            <a href="shop-single.html" class="product__image pt-20 d-block">
                                                <img class="font-image" src="/wp-content/themes/pegasus-child/assets/images/product/product-image3.png"
                                                    alt="image">
                                                <img class="back-image" src="/wp-content/themes/pegasus-child/assets/images/product/product-image5.png"
                                                    alt="image">
                                            </a>
                                            <div class="product__content">
                                                <h4 class="mb-15"><a class="primary-hover" href="shop-single.html">POP
                                                        Extra
                                                        Strawberry</a></h4>
                                                <del>$74.50</del><span class="primary-color ml-10">$49.50</span>
                                                <div class="star mt-20">
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                </div>

                                            </div>
                                            <a class="product__cart d-block bor-top" href="#0"><i
                                                    class="fa-regular fa-cart-shopping primary-color me-1"></i>
                                                <span>Add to
                                                    cart</span></a>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-6">
                                        <div class="product__item bor">
                                            <a href="#0" class="wishlist"><i class="fa-regular fa-heart"></i></a>
                                            <a href="shop-single.html" class="product__image pt-20 d-block">
                                                <img class="font-image" src="/wp-content/themes/pegasus-child/assets/images/product/product-image4.png"
                                                    alt="image">
                                                <img class="back-image" src="/wp-content/themes/pegasus-child/assets/images/product/product-image6.png"
                                                    alt="image">
                                            </a>
                                            <div class="product__content">
                                                <h4 class="mb-15"><a class="primary-hover"
                                                        href="shop-single.html">Battery
                                                        And
                                                        Charger Kit</a></h4>
                                                <del>$74.50</del><span class="primary-color ml-10">$49.50</span>
                                                <div class="star mt-20">
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                </div>

                                            </div>
                                            <a class="product__cart d-block bor-top" href="#0"><i
                                                    class="fa-regular fa-cart-shopping primary-color me-1"></i>
                                                <span>Add to
                                                    cart</span></a>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-6">
                                        <div class="product__item bor">
                                            <a href="#0" class="wishlist"><i class="fa-regular fa-heart"></i></a>
                                            <a href="shop-single.html" class="product__image pt-20 d-block">
                                                <img class="font-image" src="/wp-content/themes/pegasus-child/assets/images/product/product-image5.png"
                                                    alt="image">
                                                <img class="back-image" src="/wp-content/themes/pegasus-child/assets/images/product/product-image3.png"
                                                    alt="image">
                                            </a>
                                            <div class="product__content">
                                                <h4 class="mb-15"><a class="primary-hover" href="shop-single.html">Pods
                                                        Sold
                                                        Separately</a></h4>
                                                <del>$74.50</del><span class="primary-color ml-10">$49.50</span>
                                                <div class="star mt-20">
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                </div>

                                            </div>
                                            <a class="product__cart d-block bor-top" href="#0"><i
                                                    class="fa-regular fa-cart-shopping primary-color me-1"></i>
                                                <span>Add to
                                                    cart</span></a>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-6">
                                        <div class="product__item bor">
                                            <a href="#0" class="wishlist"><i class="fa-regular fa-heart"></i></a>
                                            <a href="shop-single.html" class="product__image pt-20 d-block">
                                                <img class="font-image" src="/wp-content/themes/pegasus-child/assets/images/product/product-image6.png"
                                                    alt="image">
                                                <img class="back-image" src="/wp-content/themes/pegasus-child/assets/images/product/product-image4.png"
                                                    alt="image">
                                            </a>
                                            <div class="product__content">
                                                <h4 class="mb-15"><a class="primary-hover" href="shop-single.html">100ml
                                                        Nic
                                                        Salt Juice</a></h4>
                                                <del>$74.50</del><span class="primary-color ml-10">$49.50</span>
                                                <div class="star mt-20">
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                </div>

                                            </div>
                                            <a class="product__cart d-block bor-top" href="#0"><i
                                                    class="fa-regular fa-cart-shopping primary-color me-1"></i>
                                                <span>Add to
                                                    cart</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="top-ratting" class="tab-pane fade">
                                <div class="row g-4">
                                    <div class="col-xl-4 col-lg-6 col-md-6">
                                        <div class="product__item bor">
                                            <a href="#0" class="wishlist"><i class="fa-regular fa-heart"></i></a>
                                            <a href="shop-single.html" class="product__image pt-20 d-block">
                                                <img class="font-image" src="/wp-content/themes/pegasus-child/assets/images/product/product-image5.png"
                                                    alt="image">
                                                <img class="back-image" src="/wp-content/themes/pegasus-child/assets/images/product/product-image3.png"
                                                    alt="image">
                                            </a>
                                            <div class="product__content">
                                                <h4 class="mb-15"><a class="primary-hover" href="shop-single.html">Pods
                                                        Sold
                                                        Separately</a></h4>
                                                <del>$74.50</del><span class="primary-color ml-10">$49.50</span>
                                                <div class="star mt-20">
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                </div>

                                            </div>
                                            <a class="product__cart d-block bor-top" href="#0"><i
                                                    class="fa-regular fa-cart-shopping primary-color me-1"></i>
                                                <span>Add to
                                                    cart</span></a>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-6">
                                        <div class="product__item bor">
                                            <a href="#0" class="wishlist"><i class="fa-regular fa-heart"></i></a>
                                            <a href="shop-single.html" class="product__image pt-20 d-block">
                                                <img class="font-image" src="/wp-content/themes/pegasus-child/assets/images/product/product-image6.png"
                                                    alt="image">
                                                <img class="back-image" src="/wp-content/themes/pegasus-child/assets/images/product/product-image4.png"
                                                    alt="image">
                                            </a>
                                            <div class="product__content">
                                                <h4 class="mb-15"><a class="primary-hover" href="shop-single.html">100ml
                                                        Nic
                                                        Salt Juice</a></h4>
                                                <del>$74.50</del><span class="primary-color ml-10">$49.50</span>
                                                <div class="star mt-20">
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                </div>

                                            </div>
                                            <a class="product__cart d-block bor-top" href="#0"><i
                                                    class="fa-regular fa-cart-shopping primary-color me-1"></i>
                                                <span>Add to
                                                    cart</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="featured-products" class="tab-pane fade">
                                <div class="row g-4">
                                    <div class="col-xl-4 col-lg-6 col-md-6">
                                        <div class="product__item bor">
                                            <a href="#0" class="wishlist"><i class="fa-regular fa-heart"></i></a>
                                            <a href="shop-single.html" class="product__image pt-20 d-block">
                                                <img class="font-image" src="/wp-content/themes/pegasus-child/assets/images/product/product-image4.png"
                                                    alt="image">
                                                <img class="back-image" src="/wp-content/themes/pegasus-child/assets/images/product/product-image6.png"
                                                    alt="image">
                                            </a>
                                            <div class="product__content">
                                                <h4 class="mb-15"><a class="primary-hover"
                                                        href="shop-single.html">Battery
                                                        And
                                                        Charger Kit</a></h4>
                                                <del>$74.50</del><span class="primary-color ml-10">$49.50</span>
                                                <div class="star mt-20">
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                </div>

                                            </div>
                                            <a class="product__cart d-block bor-top" href="#0"><i
                                                    class="fa-regular fa-cart-shopping primary-color me-1"></i>
                                                <span>Add to
                                                    cart</span></a>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-6">
                                        <div class="product__item bor">
                                            <a href="#0" class="wishlist"><i class="fa-regular fa-heart"></i></a>
                                            <a href="shop-single.html" class="product__image pt-20 d-block">
                                                <img class="font-image" src="/wp-content/themes/pegasus-child/assets/images/product/product-image5.png"
                                                    alt="image">
                                                <img class="back-image" src="/wp-content/themes/pegasus-child/assets/images/product/product-image3.png"
                                                    alt="image">
                                            </a>
                                            <div class="product__content">
                                                <h4 class="mb-15"><a class="primary-hover" href="shop-single.html">Pods
                                                        Sold
                                                        Separately</a></h4>
                                                <del>$74.50</del><span class="primary-color ml-10">$49.50</span>
                                                <div class="star mt-20">
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                </div>

                                            </div>
                                            <a class="product__cart d-block bor-top" href="#0"><i
                                                    class="fa-regular fa-cart-shopping primary-color me-1"></i>
                                                <span>Add to
                                                    cart</span></a>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-6">
                                        <div class="product__item bor">
                                            <a href="#0" class="wishlist"><i class="fa-regular fa-heart"></i></a>
                                            <a href="shop-single.html" class="product__image pt-20 d-block">
                                                <img class="font-image" src="/wp-content/themes/pegasus-child/assets/images/product/product-image6.png"
                                                    alt="image">
                                                <img class="back-image" src="/wp-content/themes/pegasus-child/assets/images/product/product-image4.png"
                                                    alt="image">
                                            </a>
                                            <div class="product__content">
                                                <h4 class="mb-15"><a class="primary-hover" href="shop-single.html">100ml
                                                        Nic
                                                        Salt Juice</a></h4>
                                                <del>$74.50</del><span class="primary-color ml-10">$49.50</span>
                                                <div class="star mt-20">
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                </div>

                                            </div>
                                            <a class="product__cart d-block bor-top" href="#0"><i
                                                    class="fa-regular fa-cart-shopping primary-color me-1"></i>
                                                <span>Add to
                                                    cart</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Product area end here -->
		*/ ?>

        <!-- Discount area start here 
        <section class="discount-area bg-image pt-130 pb-130 " data-background="https://54.167.10.86/wp-content/themes/pegasus-child/assets/images/bg/discount-bg.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="image mb-5 mb-lg-0"><img src="/wp-content/themes/pegasus-child/assets/images/discount/01.png" alt="image"></div>
                    </div>
                    <div class="col-lg-6">
                        <div class="discount__item">
                            <div class="section-header">
                                <div class="section-title-icon wow fadeInUp" data-wow-delay=".1s">
                                    <span class="title-icon mr-10"></span>
                                    <h2>find your best favourite <br>
                                        flavour vapes</h2>
                                </div>
                                <p class="mt-30 wow fadeInUp mb-55" data-wow-delay=".2s">Sell globally in minutes with
                                    localized currencies languages, and
                                    <br>
                                    experie in every
                                    market. only a variety of vaping
                                    products
                                </p>
                                <a class="btn-one wow fadeInUp me-0 me-sm-4" data-wow-delay=".3s"
                                    href="shop.html"><span>Shop Now</span></a>
                                <a class="off-btn wow fadeInUp" data-wow-delay=".4s" href="#0"><img class="mr-10"
                                        src="/wp-content/themes/pegasus-child/assets/images/icon/fire.svg" alt="icon"> GET <span
                                        class="primary-color">25%
                                        OFF</span> NOW</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
         Discount area end here -->
		 
		 
		<section>
			<?php echo do_shortcode('[pegasus_testimonial_slider id="16364"]' ); ?>
			
		</section>

        <!-- Testimonial area start here -->
		<!--
        <section class="testimonial pt-130 pb-130">
            <div class="container">
                <div class="testimonial__wrp bor radius-10">
                    <div class="testimonial__head-wrp bor-bottom pb-65 pt-65 pl-65 pr-65">
                        <div class="section-header d-flex align-items-center wow fadeInUp" data-wow-delay=".1s">
                            <span class="title-icon mr-10"></span>
                            <h2>customers speak for us</h2>
                        </div>
                        <div class="arry-btn my-4 my-lg-0">
                            <button class="arry-prev testimonial__arry-prev wow fadeInUp" data-wow-delay=".2s"><i
                                    class="fa-light fa-chevron-left"></i></button>
                            <button class="ms-3 active arry-next testimonial__arry-next wow fadeInUp"
                                data-wow-delay=".3s"><i class="fa-light fa-chevron-right"></i></button>
                        </div>
                    </div>
                    <div class="pt-65 pb-125 pr-55">
                        <div class="row g-4 align-items-center justify-content-between">
                            <div class="col-lg-7">
                                <div class="swiper testimonial__slider">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <div class="testimonial__item pl-65">
                                                <div class="testi-header mb-30">
                                                    <div class="testi-content">
                                                        <h3>Kenneth S. Fisher</h3>
                                                        <span>marketing manager</span>
                                                    </div>
                                                    <i class="fa-solid fa-quote-right"></i>
                                                </div>
                                                <p>posuere luctus orci. Donec vitae mattis quam, vitae tempor arcu.
                                                    Aenean non odio porttitor, convallis erat sit amet, facilisis velit.
                                                    Nulla ornare convallis malesuada. Phasellus molestie, ipsum ac
                                                    fringilla.</p>
                                                <div class="star mt-30">
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="testimonial__item pl-65">
                                                <div class="testi-header mb-30">
                                                    <div class="testi-content">
                                                        <h3>Francis A. Cote</h3>
                                                        <span>Garden Maker</span>
                                                    </div>
                                                    <i class="fa-solid fa-quote-right"></i>
                                                </div>
                                                <p>posuere luctus orci. Donec vitae mattis quam, vitae tempor arcu.
                                                    Aenean non odio porttitor, convallis erat sit amet, facilisis velit.
                                                    Nulla ornare convallis malesuada. Phasellus molestie, ipsum ac
                                                    fringilla.</p>
                                                <div class="star mt-30">
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="testimonial__image">
                                    <div class="swiper testimonial__slider">
                                        <div class="swiper-wrapper">
                                            <div class="swiper-slide">
                                                <img src="/wp-content/themes/pegasus-child/assets/images/testimonial/testimonial1.png" alt="image">
                                            </div>
                                            <div class="swiper-slide">
                                                <img src="/wp-content/themes/pegasus-child/assets/images/testimonial/testimonial2.png" alt="image">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
		-->
        <!-- Testimonial area end here -->

        <!-- Gallery area start here -->
		<?php /* 
        <section class="gallery-area">
            <div class="swiper gallery__slider">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="gallery__item">
                            <div class="off-tag">50% <br>
                                off</div>
                            <div class="gallery__image image">
                                <img src="/wp-content/themes/pegasus-child/assets/images/gallery/gallery-image1.jpg" alt="image">
                            </div>
                            <div class="gallery__content">
                                <h3 class="mb-10"><a href="shop-2.html">best e-lequid</a></h3>
                                <p>Best E liquids from our huge collection</p>
                                <a href="shop-2.html" class="btn-two mt-25"><span>Shop Now</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="gallery__item">
                            <div class="off-tag">50% <br>
                                off</div>
                            <div class="gallery__image image">
                                <img src="/wp-content/themes/pegasus-child/assets/images/gallery/gallery-image2.jpg" alt="image">
                            </div>
                            <div class="gallery__content">
                                <h3 class="mb-10"><a href="shop-2.html">best vape flavours</a></h3>
                                <p>Best E liquids from our huge collection</p>
                                <a href="shop-2.html" class="btn-two mt-25"><span>Shop Now</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="gallery__item">
                            <div class="off-tag">50% <br>
                                off</div>
                            <div class="gallery__image image">
                                <img src="/wp-content/themes/pegasus-child/assets/images/gallery/gallery-image3.jpg" alt="image">
                            </div>
                            <div class="gallery__content">
                                <h3 class="mb-10"><a href="shop-2.html">Battery And Charger Kit</a></h3>
                                <p>Best E liquids from our huge collection</p>
                                <a href="shop-2.html" class="btn-two mt-25"><span>Shop Now</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="gallery__item">
                            <div class="off-tag">50% <br>
                                off</div>
                            <div class="gallery__image image">
                                <img src="/wp-content/themes/pegasus-child/assets/images/gallery/gallery-image4.jpg" alt="image">
                            </div>
                            <div class="gallery__content">
                                <h3 class="mb-10"><a href="shop-2.html">best vape tanks</a></h3>
                                <p>Best E liquids from our huge collection</p>
                                <a href="shop-2.html" class="btn-two mt-25"><span>Shop Now</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="gallery__item">
                            <div class="off-tag">50% <br>
                                off</div>
                            <div class="gallery__image image">
                                <img src="/wp-content/themes/pegasus-child/assets/images/gallery/gallery-image5.jpg" alt="image">
                            </div>
                            <div class="gallery__content">
                                <h3 class="mb-10"><a href="shop-2.html">POP Extra Strawberry</a></h3>
                                <p>Best E liquids from our huge collection</p>
                                <a href="shop-2.html" class="btn-two mt-25"><span>Shop Now</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Gallery area end here -->
		*/ ?>
        <!-- Service area start here -->
        <section class="service-area pt-130 pb-130">
			<h2 class="center" >Sign Up Today!</h2>
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

        <!-- Blog area start here -->
		<?php /* 
        <section class="blog pt-130 pb-130 sub-bg">
            <div class="container">
                <div class="blog__head-wrp mb-65">
                    <div class="section-header d-flex align-items-center wow fadeInUp" data-wow-delay=".1s">
                        <span class="title-icon mr-10"></span>
                        <h2>our latest blog</h2>
                    </div>
                    <a href="blog.html" class="btn-two primary-hover mt-4 mt-md-0 wow fadeInUp"
                        data-wow-delay=".3s"><span>view all blog</span></a>
                </div>
                <div class="row g-4">
                    <div class="col-xl-8">
                        <div class="blog__item-left">
                            <div class="swiper blog__slider">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="row g-4">
                                            <div class="col-md-6">
                                                <div class="blog__item-left-content">
                                                    <span class="blog__tag">vapers</span>
                                                    <h3><a href="blog-single.html">roup of young volunteers
                                                            park. they are vapeing</a></h3>
                                                    <p>vapers planting is the act of planting young vaperss, shrubs, or
                                                        other woody
                                                        plants into the
                                                        ground to establish new
                                                        vapes.</p>
                                                    <span class="blog__item-left-content-info">By <strong
                                                            class="me-3">Max
                                                            Trewhitt</strong> 2
                                                        weeks ago</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="image">
                                                    <img class="radius-10" src="/wp-content/themes/pegasus-child/assets/images/blog/blog-image1.png"
                                                        alt="image">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="row g-4">
                                            <div class="col-md-6">
                                                <div class="blog__item-left-content">
                                                    <span class="blog__tag">vapers</span>
                                                    <h3><a href="blog-single.html">roup of young volunteers
                                                            park. they are vapeing</a></h3>
                                                    <p>vapers planting is the act of planting young vaperss, shrubs, or
                                                        other woody
                                                        plants into the
                                                        ground to establish new
                                                        vapes.</p>
                                                    <span class="blog__item-left-content-info">By <strong>Max
                                                            Trewhitt</strong> 2
                                                        weeks ago</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="image">
                                                    <img class="radius-10" src="/wp-content/themes/pegasus-child/assets/images/blog/blog-image2.png"
                                                        alt="image">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="row g-4">
                                            <div class="col-md-6">
                                                <div class="blog__item-left-content">
                                                    <span class="blog__tag">vapers</span>
                                                    <h3><a href="blog-single.html">roup of young volunteers
                                                            park. they are vapeing</a></h3>
                                                    <p>vapers planting is the act of planting young vaperss, shrubs, or
                                                        other woody
                                                        plants into the
                                                        ground to establish new
                                                        vapes.</p>
                                                    <span class="blog__item-left-content-info">By <strong>Max
                                                            Trewhitt</strong> 2
                                                        weeks ago</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="image">
                                                    <img class="radius-10" src="/wp-content/themes/pegasus-child/assets/images/blog/blog-image3.png"
                                                        alt="image">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="blog__item-left-dot-wrp">
                                <div class="dot blog__dot"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 d-block d-md-none d-xl-block">
                        <div class="blog__item-right">
                            <a href="blog-single.html" class="image d-block">
                                <img class="radius-10" src="/wp-content/themes/pegasus-child/assets/images/blog/blog-image-sm.png" alt="image">
                            </a>
                            <h3><a href="blog-single.html">Close up picture of the sapling of the vape is</a>
                            </h3>
                            <div class="d-flex align-items-center justify-content-between">
                                <span class="blog__tag">vapers</span>
                                <span>2 weeks ago</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Blog area end here -->
		*/ ?>

        <!-- Brand area start here -->
		<?php /* 
        <section class="brand-area pt-130 pb-130">
            <div class="container">
                <div class="sub-title text-center mb-65">
                    <h3><span class="title-icon"></span> our top brands <span class="title-icon"></span>
                    </h3>
                </div>
                <div class="swiper brand__slider">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="brand__item bor radius-10 text-center p-4">
                                <img src="/wp-content/themes/pegasus-child/assets/images/brand/brand1.png" alt="icon">
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="brand__item bor radius-10 text-center p-4">
                                <img src="/wp-content/themes/pegasus-child/assets/images/brand/brand2.png" alt="icon">
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="brand__item bor radius-10 text-center p-4">
                                <img src="/wp-content/themes/pegasus-child/assets/images/brand/brand3.png" alt="icon">
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="brand__item bor radius-10 text-center p-4">
                                <img src="/wp-content/themes/pegasus-child/assets/images/brand/brand4.png" alt="icon">
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="brand__item bor radius-10 text-center p-4">
                                <img src="/wp-content/themes/pegasus-child/assets/images/brand/brand5.png" alt="icon">
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="brand__item bor radius-10 text-center p-4">
                                <img src="/wp-content/themes/pegasus-child/assets/images/brand/brand6.png" alt="icon">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Brand area end here -->
    </main>
	*/ ?>
	
	
    <?php get_footer(); ?>
	
