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
		
		
		
		<?php 
			
			/*$services = [
				[
					'icon'        => 'fa-rocket',
					'title'       => 'Startup & Growth Coaching',
					'description' => 'Personalized coaching to help founders and teams scale effectively and overcome challenges. Focus areas: Leadership Development, Team Building, Performance Optimization, Scaling Strategies.',
					'link'        => '/services/startup-growth-coaching'
				],
				[
					'icon'        => 'fa-users',
					'title'       => 'CRM Services',
					'description' => 'Consulting and implementation services for CRM setup, optimization, and automation to streamline customer relations and sales processes.',
					'link'        => '/services/crm-services'
				],
				[
					'icon'        => 'fa-briefcase',
					'title'       => 'Fractional Business Development Officer (BDO)',
					'description' => 'Strategic leadership for business development on a part‑time basis—includes pipeline building, partnership development, and market outreach.',
					'link'        => '/services/fractional-bdo'
				],
				[
					'icon'        => 'fa-check-square',
					'title'       => 'Accountability Coaching',
					'description' => 'Regular accountability check‑ins, goal‑setting support, and performance tracking to ensure consistent progress toward business milestones.',
					'link'        => '/services/accountability-coaching'
				],
				[
					'icon'        => 'fa-lightbulb-o',
					'title'       => 'The Growth Edge Program (Bundle)',
					'description' => 'An integrated bundle of coaching, CRM services, and BDO support—designed to accelerate growth through combined expertise and structure.',
					'link'        => '/services/growth-edge-program'
				],
				[
					'icon'        => 'fa-calculator',
					'title'       => 'Client Interactive Calculator',
					'description' => 'A customizable, interactive calculator tool for clients to model growth scenarios, project ROI, and evaluate investment decisions.',
					'link'        => '/services/client-calculator'
				],
				[
					'icon'        => 'fa-line-chart',
					'title'       => 'Google Ads Strategy & Management',
					'description' => 'End‑to‑end Google Ads management—strategy, setup, optimization, and reporting to drive targeted traffic and maximize ROI.',
					'link'        => '/services/google-ads-management'
				],
			];*/
			
			$services = [
			  [
				'icon'        => 'fa-rocket',
				'title'       => 'Startup & Growth Coaching',
				'description' => 'At Vine & Vision Consulting, our Startup & Growth Coaching is designed for small business owners who are ready to move from hustle to health. We guide you from chaotic growth into organized, sustainable scaling.',
				'link'        => '/services/startup-growth-coaching/'
			  ],
			  [
				'icon'        => 'fa-users',
				'title'       => 'CRM Services',
				'description' => 'Consulting and implementation services for CRM setup, optimization, and automation to streamline customer relations and sales processes.',
				'link'        => '/services/crm-services/'
			  ],
			  [
				'icon'        => 'fa-briefcase',
				'title'       => 'Fractional Business Development Officer (BDO)',
				'description' => 'We act as your part‑time sales strategist, process builder, and growth advisor — helping you move from sporadic sales to sustainable revenue.',
				'link'        => '/services/fractional-business-development-officer-bdo/'
			  ],
			  [
				'icon'        => 'fa-check-square',
				'title'       => 'Accountability Coaching',
				'description' => 'With our Accountability Coaching, we help you stay focused, finish what you start, and follow through on what matters most.',
				'link'        => '/services/accountability-coaching/'
			  ],
			  [
				'icon'        => 'fa-lightbulb-o',
				'title'       => 'The Growth Edge Program (Bundle)',
				'description' => 'The Growth Edge Program is our flagship bundled solution — combining coaching, business development, and accountability into one cohesive, results-driven system.',
				'link'        => '/services/the-growth-edge-program-bundle/'
			  ],
			  [
				'icon'        => 'fa-line-chart',
				'title'       => 'Google Ads Strategy & Management',
				'description' => 'Intentional reach. Measurable results. Our Google Ads services are built for small businesses ready to grow with clarity.',
				'link'        => '/services/google-ads-strategy-management/'
			  ],
			  [
				'icon'        => 'fa-calculator',
				'title'       => 'Client Interactive Calculator',
				'description' => 'A customizable, interactive calculator tool for clients to model growth scenarios, project ROI, and evaluate investment decisions.',
				'link'        => '/services/client-interactive-calculator/'
			  ],
			];



			// Output the services section
			?>
			<section id="services">
			  <div class="container">
				<div class="text-center mb-5">
				  <h2 class="fw-bold">Our Services</h2>
				  <p class="lead">We provide comprehensive consulting services designed to help startups and growing businesses reach their full potential.</p>
				</div>

				<div class="row gy-4">
				  <?php foreach ($services as $srv): ?>
					<div class="col-md-6 wow fadeInUp" data-wow-delay="<?php echo ($index * 0.2); ?>s">
					  <div class="card h-100 shadow-sm">
						<div class="card-body d-flex flex-column justify-content-between">
						  <div>
							<div class="d-flex align-items-center mb-3">
							  <i class="fa <?php echo esc_attr($srv['icon']); ?> fa-2x me-3"></i>
							  <h5 class="card-title mb-0"><?php echo esc_html($srv['title']); ?></h5>
							</div>
							<p class="card-text"><?php echo esc_html($srv['description']); ?></p>
						  </div>
						  <div class="mt-3 text-end">
							<a href="<?php echo esc_url($srv['link']); ?>" class="custom-gold-button ">
							  Learn More
							</a>
						  </div>
						</div>
					  </div>
					</div>
				  <?php endforeach; ?>
				</div>

			  </div>
			</section>

			<?php /* 
			<div class="container-fluid vineyard-section py-5"> 
				<div class="row align-items-center"> 
					<div class="col-md-6"> 
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/hero.png" alt="Vineyard Services" class="img-fluid"> 
					</div> 
					<div class="col-md-6"> 
						<h2 class="section-title">title</h2> 
						<div class="section-content">
						content 
						</div> 
						<a href="#" class="btn btn-primary">text</a> 
					</div> 
				</div> 
			</div>
			*/ ?>
			
			

		
		
	</div><!-- end page wrap -->
    <?php get_footer(); ?>
