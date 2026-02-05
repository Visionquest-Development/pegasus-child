<?php
/*
	Template Name: About Template
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

<div class="<?php echo $final_container_class; ?> mt-3">
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
						<?php
							if ( function_exists( 'wp_bootstrap_edit_post_link' ) ) {
								// Edit post link
								wp_bootstrap_edit_post_link(
									sprintf(
										/* translators: %s: Name of current post */
										__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'pegasus' ),
										get_the_title()
									),
									'<span class="edit-link">',
									'</span>'
								);
							}
							if ( function_exists( 'wp_bootstrap_posts_pagination' ) ) {
								wp_bootstrap_posts_pagination( array(
									'prev_text'          => __( 'Previous page', 'pegasus' ),
									'next_text'          => __( 'Next page', 'pegasus' ),
									'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'pegasus' ) . ' </span>'
								) );
							}
						?>
					</div>
				</div><!--end inner content-->

			</div><!--end row -->
		</div><!-- end container -->

		<div class="site-content container">
			<div class="wp-block-columns is-layout-flex wp-container-core-columns-is-layout-9d6595d7 wp-block-columns-is-layout-flex">
				<div class="wp-block-column is-layout-flow wp-block-column-is-layout-flow" style="flex-basis:100%">



					<p>At 34 Oak Contracting, we believe in transforming houses into homes through exceptional craftsmanship, attention to detail, and a commitment to excellence. Founded with a passion for quality and customer satisfaction, we have built a reputation as a trusted partner for homeowners and real estate professionals across the region.</p>


					<hr class="wp-block-separator has-alpha-channel-opacity">


					<h2 class="wp-block-heading">Our Story</h2>


					<div class="row g-4 align-items-center">
						<div class="col-md-8">
							<p>Our journey began with a simple goal: to provide top-tier contracting services that meet the unique needs of each client. Over the years, we have expanded our offerings to include a comprehensive range of interior and exterior repair and renovation services. From intricate tile work and custom cabinetry to roof repairs and outdoor living spaces, our team is dedicated to delivering results that exceed expectations.</p>
						</div>
						<div class="col-md-4 text-center">
							<figure class="mb-0">
								<img decoding="async" width="359" height="294" src="https://34oakcontracting.com/wp-content/uploads/2024/07/images.jpeg" alt="" class="img-fluid">
							</figure>
						</div>
					</div>




					<div class="row g-4 my-5 align-items-center">
						<div class="col-md-4 text-center">
							<figure class="wp-block-image size-large is-resized has-lightbox">
								<a href="https://www.bbb.org/us/ga/woodstock/profile/roofing-contractors/34-oak-contracting-llc-0443-91825803">
									<img decoding="async" width="2048" height="742" src="https://34oakcontracting.com/wp-content/uploads/2024/05/BBB-Dynamic-Seal-4-2048x742.png" alt="" class="wp-image-353" style="width:211px;height:auto" srcset="https://34oakcontracting.com/wp-content/uploads/2024/05/BBB-Dynamic-Seal-4-2048x742.png 2048w, https://34oakcontracting.com/wp-content/uploads/2024/05/BBB-Dynamic-Seal-4-500x181.png 500w, https://34oakcontracting.com/wp-content/uploads/2024/05/BBB-Dynamic-Seal-4-768x278.png 768w, https://34oakcontracting.com/wp-content/uploads/2024/05/BBB-Dynamic-Seal-4-1536x557.png 1536w" sizes="(max-width: 2048px) 100vw, 2048px">
								</a>
							</figure>
						</div>

						<div class="col-md-4 text-center">
							<figure class="wp-block-image size-full is-resized">
								<img decoding="async" width="200" height="168" src="https://34oakcontracting.com/wp-content/uploads/2024/05/GreenJHLogo.jpg" alt="" class="wp-image-354" style="width:85px;height:auto">
							</figure>
						</div>

						<div class="col-md-4 text-center">
							<figure class="wp-block-image size-full is-resized">
								<img loading="lazy" decoding="async" width="400" height="200" src="https://34oakcontracting.com/wp-content/uploads/2024/05/615e3e_2ce135537e094e7dbc532b56d18d455bmv2.gif" alt="" class="wp-image-369" style="width:165px;height:auto">
							</figure>
						</div>
					</div>

					<hr>


					<h2 class="wp-block-heading">Working Together</h2>


					<div class="row g-4 align-items-center mb-5">
						<div class="col-md-4 text-center">
							<figure class="mb-0">
								<img loading="lazy" decoding="async" width="1215" height="1215" src="https://34oakcontracting.com/wp-content/uploads/2024/05/Copy-of-Copy-of-TOPHER-GALA-EXPERIMENT-1.png" alt="" class="img-fluid ">
							</figure>
						</div>
						<div class="col-md-8">
							<p>At 34 Oak, we pride ourselves on delivering a seamless, end-to-end client experience.</p>

							<p>Our knowledgeable representatives offer expert guidance during the initial consultation to bring your property vision to life, then provide clear timelines, transparent estimates, and consistent updates throughout the project.</p>

							<p>From planning and permitting to final walkthroughs, we coordinate the details so you can focus on your home while our team handles the work with care and precision.</p>
						</div>
					</div>

					<h2 class="wp-block-heading  has-text-align-center">Our Services</h2>

					<div class="row mb-5 g-4">
						<div class="col-lg-4 col-md-6">
							<figure class="wp-block-image size-large has-lightbox">
								<a href="https://34oakcontracting.com/interior-repairs/">
									<img loading="lazy" decoding="async" width="1152" height="2048" src="https://34oakcontracting.com/wp-content/uploads/2024/05/1-3-1152x2048.png" alt="" class="wp-image-346" srcset="https://34oakcontracting.com/wp-content/uploads/2024/05/1-3-1152x2048.png 1152w, https://34oakcontracting.com/wp-content/uploads/2024/05/1-3-281x500.png 281w, https://34oakcontracting.com/wp-content/uploads/2024/05/1-3-768x1365.png 768w, https://34oakcontracting.com/wp-content/uploads/2024/05/1-3-864x1536.png 864w, https://34oakcontracting.com/wp-content/uploads/2024/05/1-3.png 1350w" sizes="auto, (max-width: 1152px) 100vw, 1152px">
								</a>
							</figure>

							<p>We transform your living spaces with expert tile work, custom cabinetry, drywall repairs, and painting. Experience exceptional craftsmanship and quality in every detail.</p>

							<div class="wp-block-buttons is-layout-flex wp-block-buttons-is-layout-flex">
								<div class="wp-block-button">
									<a class="wp-block-button__link wp-element-button" href="https://34oakcontracting.com/interior-repairs/">See More!</a>
								</div>
							</div>
						</div>

						<div class="col-lg-4 col-md-6">
							<figure class="wp-block-image size-large has-lightbox">
								<a href="https://34oakcontracting.com/exterior-repairs/">
									<img loading="lazy" decoding="async" width="1152" height="2048" src="https://34oakcontracting.com/wp-content/uploads/2024/05/2-2-1152x2048.png" alt="" class="wp-image-348" srcset="https://34oakcontracting.com/wp-content/uploads/2024/05/2-2-1152x2048.png 1152w, https://34oakcontracting.com/wp-content/uploads/2024/05/2-2-281x500.png 281w, https://34oakcontracting.com/wp-content/uploads/2024/05/2-2-768x1365.png 768w, https://34oakcontracting.com/wp-content/uploads/2024/05/2-2-864x1536.png 864w, https://34oakcontracting.com/wp-content/uploads/2024/05/2-2.png 1350w" sizes="auto, (max-width: 1152px) 100vw, 1152px">
								</a>
							</figure>

							<p>We enhance your outdoor spaces with expert deck construction, fence installation, roofing repairs, and power washing. Experience exceptional craftsmanship and quality in every detail.</p>

							<div class="wp-block-buttons is-layout-flex wp-block-buttons-is-layout-flex">
								<div class="wp-block-button">
									<a class="wp-block-button__link wp-element-button" href="https://34oakcontracting.com/exterior-repairs/">See More!</a>
								</div>
							</div>
						</div>

						<div class="col-lg-4 col-md-6">
							<figure class="wp-block-image size-large has-lightbox">
								<a href="https://34oakcontracting.com/make-ready-repairs/">
									<img loading="lazy" decoding="async" width="1152" height="2048" src="https://34oakcontracting.com/wp-content/uploads/2024/05/3-2-1152x2048.png" alt="" class="wp-image-347" srcset="https://34oakcontracting.com/wp-content/uploads/2024/05/3-2-1152x2048.png 1152w, https://34oakcontracting.com/wp-content/uploads/2024/05/3-2-281x500.png 281w, https://34oakcontracting.com/wp-content/uploads/2024/05/3-2-768x1365.png 768w, https://34oakcontracting.com/wp-content/uploads/2024/05/3-2-864x1536.png 864w, https://34oakcontracting.com/wp-content/uploads/2024/05/3-2.png 1350w" sizes="auto, (max-width: 1152px) 100vw, 1152px">
								</a>
							</figure>

							<p>We prepare homes for sale with essential repairs, including exterior fixes, interior updates, and thorough cleanings. Ensure your property is market-ready with our expert services.</p>

							<div class="wp-block-buttons is-layout-flex wp-block-buttons-is-layout-flex">
								<div class="wp-block-button">
									<a class="wp-block-button__link wp-element-button" href="https://34oakcontracting.com/make-ready-repairs/">See More!</a>
								</div>
							</div>
						</div>
					</div>

					<hr>
					<h2 class="wp-block-heading mt-3 mb-5 has-text-align-center">Why Choose Us</h2>

					<div class="row">
						<div class="wp-block-media-text is-stacked-on-mobile col-md-6">
							<figure class="wp-block-media-text__media">
								<img loading="lazy" decoding="async" width="1215" height="1215" src="https://34oakcontracting.com/wp-content/uploads/2024/05/Copy-of-Copy-of-TOPHER-GALA-EXPERIMENT-2.png" alt="" class="wp-image-359 size-full" srcset="https://34oakcontracting.com/wp-content/uploads/2024/05/Copy-of-Copy-of-TOPHER-GALA-EXPERIMENT-2.png 1215w, https://34oakcontracting.com/wp-content/uploads/2024/05/Copy-of-Copy-of-TOPHER-GALA-EXPERIMENT-2-500x500.png 500w, https://34oakcontracting.com/wp-content/uploads/2024/05/Copy-of-Copy-of-TOPHER-GALA-EXPERIMENT-2-150x150.png 150w, https://34oakcontracting.com/wp-content/uploads/2024/05/Copy-of-Copy-of-TOPHER-GALA-EXPERIMENT-2-768x768.png 768w" sizes="auto, (max-width: 1215px) 100vw, 1215px">
							</figure>
							<div class="wp-block-media-text__content">
								<p>Our trained specialists have the solutions you need.</p>
								<p>We bring together a multitude of skilled trades to work cohesively and ensure that all projects are completed on time and on budget.</p>
							</div>
						</div>

						<div class="wp-block-media-text has-media-on-the-right  col-md-6 is-stacked-on-mobile">

							<div class="wp-block-media-text__content">
								<p>Through frequent quality control checks, we maintain on-site organization and constant communication with our clients.</p>
							</div>
							<figure class="wp-block-media-text__media">
								<img loading="lazy" decoding="async" width="1215" height="1215" src="https://34oakcontracting.com/wp-content/uploads/2024/05/Copy-of-Copy-of-TOPHER-GALA-EXPERIMENT-3.png" alt="" class="wp-image-360 w-50 size-full" srcset="https://34oakcontracting.com/wp-content/uploads/2024/05/Copy-of-Copy-of-TOPHER-GALA-EXPERIMENT-3.png 1215w, https://34oakcontracting.com/wp-content/uploads/2024/05/Copy-of-Copy-of-TOPHER-GALA-EXPERIMENT-3-500x500.png 500w, https://34oakcontracting.com/wp-content/uploads/2024/05/Copy-of-Copy-of-TOPHER-GALA-EXPERIMENT-3-150x150.png 150w, https://34oakcontracting.com/wp-content/uploads/2024/05/Copy-of-Copy-of-TOPHER-GALA-EXPERIMENT-3-768x768.png 768w" sizes="auto, (max-width: 1215px) 100vw, 1215px">
							</figure>

							<p>Our commitment to excellence means that a 34 Oak project is not considered complete until both the project manager and client are satisfied with a job well done. <em><strong>Trust 34 Oak to exceed your expectations and deliver the results you need.</strong></em></p>

						</div>
					</div>

				</div>
			</div>
		</div>

		<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		Frequently Asked Questions
		~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
		<div class="container mb-5">
			<h2 class="wp-block-heading mt-3 mb-5 has-text-align-center">Frequently Asked Questions</h2>
			<div class="wp-block-coblocks-accordion">
				<div class="wp-block-coblocks-accordion-item">
					<details>
						<summary class="wp-block-coblocks-accordion-item__title"><strong>Q: What types of projects do you specialize in?</strong></summary>
						<div class="wp-block-coblocks-accordion-item__content">
							<p>A: We specialize in a wide range of projects, including interior repairs, exterior repairs, roofing, fencing, driveways, and pre-sale make ready repairs.</p>
						</div>
					</details>
				</div>

				<div class="wp-block-coblocks-accordion-item">
					<details>
						<summary class="wp-block-coblocks-accordion-item__title"><strong><strong>Q: Are you licensed, bonded, and insured?</strong></strong></summary>
						<div class="wp-block-coblocks-accordion-item__content">
							<p>A: Absolutely, we are fully licensed, bonded, and insured to ensure your peace of mind and protect your property.</p>
						</div>
					</details>
				</div>

				<div class="wp-block-coblocks-accordion-item">
					<details>
						<summary class="wp-block-coblocks-accordion-item__title"><strong><strong>Q: Are you licensed, bonded, and insured?</strong></strong></summary>
						<div class="wp-block-coblocks-accordion-item__content">
							<p>A: Absolutely, we are fully licensed, bonded, and insured to ensure your peace of mind and protect your property.</p>
						</div>
					</details>
				</div>

				<div class="wp-block-coblocks-accordion-item">
					<details>
						<summary class="wp-block-coblocks-accordion-item__title"><strong>Q: How do I schedule a consultation or inspection?</strong></summary>
						<div class="wp-block-coblocks-accordion-item__content">
							<p>A: You can schedule a consultation or inspection by contacting us through our website, calling our office, or sending us an email. We aim to respond promptly to all inquiries.</p>
						</div>
					</details>
				</div>

				<div class="wp-block-coblocks-accordion-item">
					<details>
						<summary class="wp-block-coblocks-accordion-item__title"><strong>Q: Do you offer free consultations and estimates?</strong></summary>
						<div class="wp-block-coblocks-accordion-item__content">
							<p>A: Yes, we offer free consultations and estimates to help you plan your project without any upfront costs.</p>
						</div>
					</details>
				</div>

				<div class="wp-block-coblocks-accordion-item">
					<details>
						<summary class="wp-block-coblocks-accordion-item__title"><strong>Q: Are you accredited by the Better Business Bureau?</strong></summary>
						<div class="wp-block-coblocks-accordion-item__content">
							<p>A: Yes, we are accredited by the Better Business Bureau, reflecting our commitment to quality and customer satisfaction.</p>
						</div>
					</details>
				</div>

				<div class="wp-block-coblocks-accordion-item">
					<details>
						<summary class="wp-block-coblocks-accordion-item__title"><strong>Q: What kind of warranty do you offer on roofing and siding?</strong></summary>
						<div class="wp-block-coblocks-accordion-item__content">
							<p>A: We offer a 15-year workmanship warranty on roofing and siding, ensuring long-term quality and durability.</p>
						</div>
					</details>
				</div>

				<div class="wp-block-coblocks-accordion-item">
					<details>
						<summary class="wp-block-coblocks-accordion-item__title"><strong>Q: Are your workmanship warranties transferrable?</strong></summary>
						<div class="wp-block-coblocks-accordion-item__content">
							<p>A: Yes, all our workmanship warranties are fully transferrable, adding value to your property.</p>
						</div>
					</details>
				</div>

				<div class="wp-block-coblocks-accordion-item">
					<details>
						<summary class="wp-block-coblocks-accordion-item__title"><strong>Q: How experienced is your leadership team?</strong></summary>
						<div class="wp-block-coblocks-accordion-item__content">
							<p>A: Our leadership team has an average of 12+ years of industry experience, bringing extensive knowledge and expertise to every project.</p>
						</div>
					</details>
				</div>

				<div class="wp-block-coblocks-accordion-item">
					<details>
						<summary class="wp-block-coblocks-accordion-item__title"><strong>Q: How was your leadership team trained?</strong></summary>
						<div class="wp-block-coblocks-accordion-item__content">
							<p>A: 34 Oak leadership was trained by industry titans, ensuring we adhere to the highest standards of excellence.</p>
						</div>
					</details>
				</div>

				<div class="wp-block-coblocks-accordion-item">
					<details>
						<summary class="wp-block-coblocks-accordion-item__title"><strong>Q: What areas do you serve?</strong></summary>
						<div class="wp-block-coblocks-accordion-item__content">
							<p>A: We serve a wide range of areas within our region. Please contact us to confirm if we serve your specific location.</p>
						</div>
					</details>
				</div>

				<div class="wp-block-coblocks-accordion-item">
					<details>
						<summary class="wp-block-coblocks-accordion-item__title"><strong>Q: What sets you apart from other contractors?</strong></summary>
						<div class="wp-block-coblocks-accordion-item__content">
							<p>A: Our commitment to quality, customer satisfaction, comprehensive services, and our experienced team sets us apart. We strive to exceed expectations on every project.</p>
						</div>
					</details>
				</div>

				<div class="wp-block-coblocks-accordion-item">
					<details>
						<summary class="wp-block-coblocks-accordion-item__title"><strong>Q: Do you handle emergency repairs?</strong></summary>
						<div class="wp-block-coblocks-accordion-item__content">
							<p>A: Yes, we handle emergency repairs to address urgent issues promptly. Please contact us immediately if you require emergency assistance.</p>
						</div>
					</details>
				</div>

				<div class="wp-block-coblocks-accordion-item">
					<details>
						<summary class="wp-block-coblocks-accordion-item__title"><strong>Q: How long does a typical project take to complete?</strong></summary>
						<div class="wp-block-coblocks-accordion-item__content">
							<p>A: The duration of a project varies based on its size and complexity. We provide detailed timelines during the consultation phase and keep you updated throughout the project.</p>
						</div>
					</details>
				</div>

				<div class="wp-block-coblocks-accordion-item">
					<details>
						<summary class="wp-block-coblocks-accordion-item__title"><strong>Q: How do you ensure the quality of your work?</strong></summary>
						<div class="wp-block-coblocks-accordion-item__content">
							<p>A: We ensure quality through our skilled team, use of premium materials, adherence to industry standards, and rigorous quality control processes throughout each project.</p>
						</div>
					</details>
				</div>

				<div class="wp-block-coblocks-accordion-item">
					<details>
						<summary class="wp-block-coblocks-accordion-item__title"><strong>Q: Do you offer financing options for large projects?</strong></summary>
						<div class="wp-block-coblocks-accordion-item__content">
							<p>A: Yes, we offer flexible financing options to help you manage the costs of larger projects. Contact us for more details on our financing plans.</p>
						</div>
					</details>
				</div>

				<div class="wp-block-coblocks-accordion-item">
					<details>
						<summary class="wp-block-coblocks-accordion-item__title"><strong>Q: Can you provide references from past clients?</strong></summary>
						<div class="wp-block-coblocks-accordion-item__content">
							<p>A: Yes, we can provide references from past clients upon request. We also have testimonials and reviews available on our website for you to review.</p>
						</div>
					</details>
				</div>

				<div class="wp-block-coblocks-accordion-item">
					<details>
						<summary class="wp-block-coblocks-accordion-item__title"><strong>Q: How do you handle project clean-up?</strong></summary>
						<div class="wp-block-coblocks-accordion-item__content">
							<p>A: We prioritize thorough clean-up after each project, ensuring your property is left clean and tidy. We remove all debris and materials related to the project.</p>
						</div>
					</details>
				</div>

				<div class="wp-block-coblocks-accordion-item">
					<details>
						<summary class="wp-block-coblocks-accordion-item__title"><strong><em>Have other questions? Click to see if we answer it in our extended FAQ!</em></strong></summary>
						<div class="wp-block-coblocks-accordion-item__content">
							<p><strong>Q: How do you communicate with clients during a project?</strong></p>
							<p>A: We maintain clear and consistent communication throughout the project, providing regular updates and being available for any questions or concerns you may have.</p>

							<p><strong>Q: Do you offer any maintenance services after project completion?</strong></p>
							<p>A: Yes, we offer maintenance services to ensure your repairs and renovations remain in excellent condition. Contact us to learn more about our maintenance plans.</p>

							<p><strong>Q: Can you help with design and planning for my project?</strong></p>
							<p>A: Yes, we offer design and planning services to help bring your vision to life. Our team works closely with you to create a detailed plan that meets your needs and preferences.</p>

							<p><strong>Q: Do you offer free storm damage inspections?</strong></p>
							<p>A: Yes, we provide free storm damage inspections to assess and address any issues promptly.</p>

							<p><strong>Q: Do you have specialists for storm damage insurance claims?</strong></p>
							<p>A: Yes, we have trained storm damage insurance claim specialists to assist you with your claims process.</p>

							<p><strong>Q: Can you cover all my construction needs with a single contact?</strong></p>
							<p>A: Yes, we provide a single contact to cover all your construction needs, simplifying the process for you.</p>

							<p><strong>Q: Do you work with skilled trades for plumbing, electrical, and carpentry?</strong></p>
							<p>A: Yes, we partner with skilled trades offering licensed plumbing, electrical, and carpentry services.</p>

							<p><strong>Q: Do you have relationships with real estate agents?</strong></p>
							<p>A: Yes, we have working relations with top real estate agents, ensuring you have the best team to support your property investment goals.</p>

							<p><strong>Q: Do you require money down before starting a project?</strong></p>
							<p>A: No, we require zero money down prior to project commencement, allowing you to start your project with confidence.</p>

							<p><strong>Q: Are you a local company?</strong></p>
							<p>A: Yes, we are local and committed to serving our community with exceptional contracting services.</p>

							<p><strong>Q: Can I count on your quality of work?</strong></p>
							<p>A: Absolutely, we are quality contractors you can count on for all your construction needs.</p>
						</div>
					</details>
				</div>
			</div>
		</div>
		<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		END Frequently Asked Questions
		~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

		<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		Our Service Areas
		~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
		<div class="container">
			<div class="row g-4">
				<div class="col-lg-4 col-md-6">
					<figure class="wp-block-image size-large">
						<img loading="lazy" decoding="async" width="1152" height="2048" src="https://34oakcontracting.com/wp-content/uploads/2024/05/5-1-1152x2048.png" alt="" class="wp-image-361" srcset="https://34oakcontracting.com/wp-content/uploads/2024/05/5-1-1152x2048.png 1152w, https://34oakcontracting.com/wp-content/uploads/2024/05/5-1-281x500.png 281w, https://34oakcontracting.com/wp-content/uploads/2024/05/5-1-768x1365.png 768w, https://34oakcontracting.com/wp-content/uploads/2024/05/5-1-864x1536.png 864w, https://34oakcontracting.com/wp-content/uploads/2024/05/5-1.png 1215w" sizes="auto, (max-width: 1152px) 100vw, 1152px">
					</figure>
				</div>

				<div class="col-lg-4 col-md-6">
					<figure class="wp-block-image size-large">
						<img loading="lazy" decoding="async" width="1152" height="2048" src="https://34oakcontracting.com/wp-content/uploads/2024/05/4-1-1152x2048.png" alt="" class="wp-image-362" srcset="https://34oakcontracting.com/wp-content/uploads/2024/05/4-1-1152x2048.png 1152w, https://34oakcontracting.com/wp-content/uploads/2024/05/4-1-281x500.png 281w, https://34oakcontracting.com/wp-content/uploads/2024/05/4-1-768x1365.png 768w, https://34oakcontracting.com/wp-content/uploads/2024/05/4-1-864x1536.png 864w, https://34oakcontracting.com/wp-content/uploads/2024/05/4-1.png 1215w" sizes="auto, (max-width: 1152px) 100vw, 1152px">
					</figure>
				</div>

				<div class="col-lg-4 col-md-6">
					<figure class="wp-block-image size-large">
						<img loading="lazy" decoding="async" width="1152" height="2048" src="https://34oakcontracting.com/wp-content/uploads/2024/05/6-1-1152x2048.png" alt="" class="wp-image-363" srcset="https://34oakcontracting.com/wp-content/uploads/2024/05/6-1-1152x2048.png 1152w, https://34oakcontracting.com/wp-content/uploads/2024/05/6-1-281x500.png 281w, https://34oakcontracting.com/wp-content/uploads/2024/05/6-1-768x1365.png 768w, https://34oakcontracting.com/wp-content/uploads/2024/05/6-1-864x1536.png 864w, https://34oakcontracting.com/wp-content/uploads/2024/05/6-1.png 1215w" sizes="auto, (max-width: 1152px) 100vw, 1152px">
					</figure>
				</div>

				<div class="col-lg-4 col-md-6">
					<figure class="wp-block-image size-large">
						<img loading="lazy" decoding="async" width="1152" height="2048" src="https://34oakcontracting.com/wp-content/uploads/2024/05/7-1-1152x2048.png" alt="" class="wp-image-364" srcset="https://34oakcontracting.com/wp-content/uploads/2024/05/7-1-1152x2048.png 1152w, https://34oakcontracting.com/wp-content/uploads/2024/05/7-1-281x500.png 281w, https://34oakcontracting.com/wp-content/uploads/2024/05/7-1-768x1365.png 768w, https://34oakcontracting.com/wp-content/uploads/2024/05/7-1-864x1536.png 864w, https://34oakcontracting.com/wp-content/uploads/2024/05/7-1.png 1215w" sizes="auto, (max-width: 1152px) 100vw, 1152px">
					</figure>
				</div>

				<div class="col-lg-4 col-md-6">
					<figure class="wp-block-image size-large">
						<img loading="lazy" decoding="async" width="1152" height="2048" src="https://34oakcontracting.com/wp-content/uploads/2024/05/8-1-1152x2048.png" alt="" class="wp-image-365" srcset="https://34oakcontracting.com/wp-content/uploads/2024/05/8-1-1152x2048.png 1152w, https://34oakcontracting.com/wp-content/uploads/2024/05/8-1-281x500.png 281w, https://34oakcontracting.com/wp-content/uploads/2024/05/8-1-768x1365.png 768w, https://34oakcontracting.com/wp-content/uploads/2024/05/8-1-864x1536.png 864w, https://34oakcontracting.com/wp-content/uploads/2024/05/8-1.png 1215w" sizes="auto, (max-width: 1152px) 100vw, 1152px">
					</figure>
				</div>

				<div class="col-lg-4 col-md-6">
					<figure class="wp-block-image size-large">
						<img loading="lazy" decoding="async" width="1152" height="2048" src="https://34oakcontracting.com/wp-content/uploads/2024/05/9-1-1152x2048.png" alt="" class="wp-image-366" srcset="https://34oakcontracting.com/wp-content/uploads/2024/05/9-1-1152x2048.png 1152w, https://34oakcontracting.com/wp-content/uploads/2024/05/9-1-281x500.png 281w, https://34oakcontracting.com/wp-content/uploads/2024/05/9-1-768x1365.png 768w, https://34oakcontracting.com/wp-content/uploads/2024/05/9-1-864x1536.png 864w, https://34oakcontracting.com/wp-content/uploads/2024/05/9-1.png 1215w" sizes="auto, (max-width: 1152px) 100vw, 1152px">
					</figure>
				</div>
			</div>
		</div>



	</div><!-- end page wrap -->
    <?php get_footer(); ?>
