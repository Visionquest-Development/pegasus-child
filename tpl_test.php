<?php
/*
	Template Name: TEST Template
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
		
		<section>
			<div class="container">
				<div class="row">

					<?php
					$args = array(
						'post_type'      => 'directory',
						'posts_per_page' => -1,
					);
					$directory_query = new WP_Query($args);

					if ($directory_query->have_posts()) :
						$counter = 0;
						while ($directory_query->have_posts()) :
							$directory_query->the_post();
							$post_id = get_the_ID();
							$name = get_the_title();
							$content = get_the_content();
							$image = get_the_post_thumbnail_url($post_id, 'full') ?: get_template_directory_uri() . '/images/default.jpg';
							$is_odd = $counter % 2 === 0;

							// CMB2 custom fields
							$company_name  = get_post_meta($post_id, 'vv_directory_company_name', true);
							$company_logo  = get_post_meta($post_id, 'vv_directory_company_logo', true);
							$website       = get_post_meta($post_id, 'vv_directory_company_website', true);
							$contact       = get_post_meta($post_id, 'vv_directory_contact', true);
							$email         = get_post_meta($post_id, 'vv_directory_email', true);

							// Categories & Tags
							$categories = get_the_terms($post_id, 'directory_categories');
							$tags       = get_the_terms($post_id, 'directory_tags');
					?>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mb-4">
								<div class="card shadow-sm h-100">
									<div class="row g-0">
										<?php if ($is_odd) : ?>
											<div class="col-md-12 col-lg-4">
												<img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($name); ?>" class="card-img-top img-fluid">
											</div>
											<div class="col-md-12 col-lg-8">
										<?php else : ?>
											<div class="col-md-12 col-lg-8 order-2 order-md-1">
										<?php endif; ?>

												<div class="card-body">
													<h5 class="card-title"><?php echo esc_html($name); ?></h5>

													<?php if ($company_name) : ?>
														<p><strong>Company:</strong> <?php echo esc_html($company_name); ?></p>
													<?php endif; ?>

													<?php if ($company_logo) : ?>
														<p><img src="<?php echo esc_url($company_logo); ?>" alt="<?php echo esc_attr($company_name); ?>" class="img-fluid mb-2" style="max-height: 50px;"></p>
													<?php endif; ?>

													<?php if ($website) : ?>
														<p><strong>Website:</strong> <a href="<?php echo esc_url($website); ?>" target="_blank"><?php echo esc_html($website); ?></a></p>
													<?php endif; ?>

													<?php if ($contact) : ?>
														<p><strong>Contact:</strong> <?php echo esc_html($contact); ?></p>
													<?php endif; ?>

													<?php if ($email) : ?>
														<p><strong>Email:</strong> <a href="mailto:<?php echo antispambot($email); ?>"><?php echo antispambot($email); ?></a></p>
													<?php endif; ?>

													<?php if ($content) : ?>
														<p class="card-text"><?php echo wp_kses_post($content); ?></p>
													<?php endif; ?>

													<?php if (!empty($categories)) : ?>
														<p><strong>Categories:</strong>
															<?php foreach ($categories as $cat) : ?>
																<span class="badge bg-secondary"><?php echo esc_html($cat->name); ?></span>
															<?php endforeach; ?>
														</p>
													<?php endif; ?>

													<?php if (!empty($tags)) : ?>
														<p><strong>Tags:</strong>
															<?php foreach ($tags as $tag) : ?>
																<span class="badge bg-info text-dark"><?php echo esc_html($tag->name); ?></span>
															<?php endforeach; ?>
														</p>
													<?php endif; ?>
													<div class="text-end mt-3">
														<a href="<?php the_permalink(); ?>" class="btn btn-sm btn-outline-primary">
															Learn More
														</a>
													</div>
												</div><!-- .card-body -->

										<?php if (!$is_odd) : ?>
											</div> <!-- .col-md-8 -->
											<div class="col-md-12 col-lg-4 order-1 order-md-2">
												<img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($name); ?>" class="card-img-top img-fluid">
											</div>
										<?php else : ?>
											</div> <!-- .col-md-8 -->
										<?php endif; ?>
									</div> <!-- .row -->
								</div> <!-- .card -->
							</div>
					<?php
							$counter++;
						endwhile;
					endif;
					wp_reset_postdata();
					?>

				</div> <!-- .row -->
			</div> <!-- .container -->
		</section>




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
