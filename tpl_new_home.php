 <?php
/*
	Template Name: New Home Template
*/
?>
	<?php get_header(); ?>
	
	
	<div id="page-wrap">
		
		<section class="services jumbotron text-center">
			<div class="container-fluid">
			
				<div class="row">
					<div class=" col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 ">
						<div class="mt-3 mb-5 wow fadeInUp">
							<h2>What we do:</h2>
							<ul>
								<li class="mb-3">
									<span class="services-title"><u><b>Code:</b></u></span><br>
									<a target="_blank" class="html" href="https://visionquestdevelopment.com/html/">HTML</a>, 
									<a target="_blank" class="css" href="https://visionquestdevelopment.com/css/">
										<span class="one">C</span>
										<span class="two">S</span>
										<span class="three">S</span>
									</a>, 
									<a target="_blank" class="php" href="https://visionquestdevelopment.com/php/">PHP</a>, 
									<a target="_blank" class="js" href="https://visionquestdevelopment.com/javascript-libraries/" >Javascript</a>, 
									<a target="_blank" class="sql" href="https://visionquestdevelopment.com/sql/">SQL</a>, etc. 
								</li>
								<li class="mb-3">
									<span class="services-title"><u><b>Websites:</b></u></span><br>
									WordPress, Magento, HTML, Bootstrap templates 
								</li>
								<li class="mb-3">
									<span class="services-title"><u><b>Web Apps &amp; Mobile Apps:</b></u></span><br>
									NEXTJS, React, React Native, Laravel
								</li>
								<!--<li>Hosting: WHM/CPANEL, AWS, etc.</li>-->
								<!--<li><a href="/seo">SEO</a></li>-->
								
								
								
							</ul>
						</div>
					</div>
					
					<div class=" col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 ">
						<div class="mb-5 wow fadeInUp" data-wow-delay="0.3s">
							<h2>Software Specializations:</h2>
							<ul>
								<li>Responsive Web Design</li>
								<li>PSD to HTML/WP conversion</li>
								<li>WordPress Theme Development</li>
								<li>WordPress Plugin Development</li>
								<li>E-commerce stores</li>
								<li>Application Development</li>
								<li>iOS Development</li>
								<li>Android Development</li>
							</ul>
						</div>
					</div>
					
					<div class="col col-xs-12  ">
						<div class="mb-3 wow fadeInUp" data-wow-delay="0.6s">
							<h2>Hobbies / Other interests</h2>
							<ul>
								<li><a href="/custom-pc">Custom PC Builds</a></li>
								<li>3D Printing</li>
								<li>Drone building</li>
								<li>Virtual Reality software/hardware</li>
								<li>Security Camera Installations</li>
								<li>Hardware repair and installation</li>
								<li>Artifical Intelligence (AI)</li>
							</ul>
						</div>
					</div>
					
				</div>
				
				
			</div>
		</section>
		
		<section class="website-dev">
			<div class="jumbotron text-center">
				<div class="container-fluid ">
			
					<!--<h2 class="mb-5">How to work with us:</h2>
				
					<div class="row">
						<div class="col-lg-6">
							
							<h2>Design</h2>
							<p>How our process works.</p>
							<p><a class="btn btn-secondary" href="/design" role="button">Learn More »</a></p>
						</div>
						<div class="col-lg-6">
							
							<h2>Development</h2>
							<p>Website Pricing and details.</p>
							<p><a class="btn btn-secondary" href="/web-development" role="button">Learn More »</a></p>
						</div>
					</div>-->
					
					<div id="process-wrapper" class="">
						<div id="container">

							<h1 class="">Our Process</h1>

							<ol class="process-chart">
								<li class="wow fadeInLeft" data-wow-delay="0.3s">
									<div>
										<h2>Consultation</h2>
										<p>We start with a simple conversation to find your business needs and brainstorm solutions.</p>
									</div>
								</li>
								<li class="wow fadeInLeft" data-wow-delay="0.6s">
									<div>
										<h2>Discovery</h2>
										<p>We gather your business information and look into your compeditors.</p>
										<ul>
											<li>Login credentials</li>
											<li>Integrations</li>
											<li>Third party services</li>
										</ul>
										
									</div>
								</li>
								<li class="wow fadeInLeft" data-wow-delay="0.9s">
									<div>
										<h2>Design</h2>
										<p>Create the visual look and user experience of the website.</p>
										<ul>
											<li>Tight budget quick fix</li>
											<li>Outsource to a designer</li>
											<li>Custom solution</li>
										</ul>
										
									</div>
								</li>
								<li class="wow fadeInLeft" data-wow-delay="1.2s">
									<div>
										<h2>Development</h2>
										<p>Turn the design into a fully functional website.</p>
										<ul>
											<li>Coding</li>
											<li>Testing</li>
											<li>Quality Assurance</li>
										</ul>
										
									</div>
								</li>
								<li class="wow fadeInLeft" data-wow-delay="1.5s"> 
									<div>
										<h2>Launch</h2>
										<p>Make the website live and ensure ongoing functionality.</p>
										<!--<p><small><strong>Optional:</strong> You can slice the sandwich in half.</small></p>-->
										<ul>
											<li>Payment</li>
											<li>Launch website</li>
											<li>Support and maintenance</li>
										</ul>
										
									</div>
								</li>
								
							</ol>

						</div>
					</div>
					
				</div>
			</div>
		</section>
		
		
		<!--
		<section class="jumbotron text-center">
			<div class="container">
				<h2 class="jumbotron-heading">Why you should work with us...</h2>
				<p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don't simply skip over it entirely.</p>
				<p>
					<a href="#" class="btn btn-primary my-2">Main call to action</a>
					<a href="#" class="btn btn-secondary my-2">Secondary action</a>
				</p>
			</div>
		</section>
		-->
		<?php /*
		<section class="home-resume text-center pt-5 pb-5">
			
			<?php 
				$logo = pegasus_get_option( 'logo' );
			?>
			<?php if( ! empty( $logo ) ) : ?>
				<img id="logo" src="<?php echo $logo; ?>" alt="vqdev-logo" class="wow fadeIn"/>
			<?php endif; ?>
			<h3 class="mt-3 mb-5">Why you should work with us</h3>
			<h5 class="wow " >Flexible Pricing Options</h5>
			<p class="mb-5 wow " >We offer a variety of pricing models to suit your needs and ensure you're getting the best value for your investment:</p>
			<div class="container">
				<div class="row">
					<!--<div class="col-md-4">
						<h3 class="widget-title">Harvest</h3>
						<div class="siteorigin-widget-tinymce textwidget">
							<p>Harvest is time tracking software that we use for keeping track of our time. Usually we bill on the 1st &amp; 15th of every month.&nbsp;</p>
						</div>
						<img fetchpriority="high" decoding="async" src="https://visionquestdevelopment.com/wp-content/uploads/2016/10/2016-10-27_18-06-11.png" width="800" height="482" srcset="https://visionquestdevelopment.com/wp-content/uploads/2016/10/2016-10-27_18-06-11.png 800w, https://visionquestdevelopment.com/wp-content/uploads/2016/10/2016-10-27_18-06-11-300x181.png 300w, https://visionquestdevelopment.com/wp-content/uploads/2016/10/2016-10-27_18-06-11-620x374.png 620w, https://visionquestdevelopment.com/wp-content/uploads/2016/10/2016-10-27_18-06-11-768x463.png 768w" sizes="(max-width: 800px) 100vw, 800px" alt="" class="so-widget-image img-fluid">
					</div>-->
					<div class="col-md-4 wow " > 
					    <h4 class="widget-title">Hourly Rate</h4>
						<div class="siteorigin-widget-tinymce textwidget">
							<p>For projects that require ongoing adjustments or unpredictable timelines, we prefer to bill on an hourly basis. This ensures you're only paying for the time spent on your project. Our competitive hourly rate can be found on the <a href="/web-pricing">development</a> page.</p>
						</div>
						<!--<img decoding="async" src="https://visionquestdevelopment.com/wp-content/uploads/2016/10/2016-10-27_18-16-15.png" width="1191" height="349" srcset="https://visionquestdevelopment.com/wp-content/uploads/2016/10/2016-10-27_18-16-15.png 1191w, https://visionquestdevelopment.com/wp-content/uploads/2016/10/2016-10-27_18-16-15-300x88.png 300w, https://visionquestdevelopment.com/wp-content/uploads/2016/10/2016-10-27_18-16-15-620x182.png 620w, https://visionquestdevelopment.com/wp-content/uploads/2016/10/2016-10-27_18-16-15-768x225.png 768w, https://visionquestdevelopment.com/wp-content/uploads/2016/10/2016-10-27_18-16-15-940x275.png 940w" sizes="(max-width: 1191px) 100vw, 1191px" alt="" class="so-widget-image img-fluid">-->
					</div>
					<div class="col-md-4 wow " >
					    <h4 class="widget-title">Flat Rate for Simple Projects</h4>
						<div class="siteorigin-widget-tinymce textwidget">
							<p>If you're looking for a basic brochure website, we offer flat-rate pricing. This option gives you cost certainty and straightforward budgeting, provided you cover hosting and domain expenses. It’s perfect for businesses that want a clean, professional site without the complexity of custom development.</p>
						</div> 
						<!--<img fetchpriority="high" decoding="async" src="https://visionquestdevelopment.com/wp-content/uploads/2016/10/2016-10-27_18-06-11.png" width="800" height="482" srcset="https://visionquestdevelopment.com/wp-content/uploads/2016/10/2016-10-27_18-06-11.png 800w, https://visionquestdevelopment.com/wp-content/uploads/2016/10/2016-10-27_18-06-11-300x181.png 300w, https://visionquestdevelopment.com/wp-content/uploads/2016/10/2016-10-27_18-06-11-620x374.png 620w, https://visionquestdevelopment.com/wp-content/uploads/2016/10/2016-10-27_18-06-11-768x463.png 768w" sizes="(max-width: 800px) 100vw, 800px" alt="" class="so-widget-image img-fluid">-->
					</div>
					<div class="col-md-4 wow " > 
					    <h4 class="widget-title">Retainer for Ongoing Support</h4>
						<div class="siteorigin-widget-tinymce textwidget">
							<p>For clients seeking continuous support and updates, our monthly retainer option is ideal. We'll track our time and provide regular invoicing, including any additional work beyond the agreed retainer. This model ensures your website or project is always up-to-date while managing your budget effectively.</p>
						</div> 
						<!--img decoding="async" src="https://visionquestdevelopment.com/wp-content/uploads/2016/10/2016-10-27_18-01-32.png" width="957" height="550" srcset="https://visionquestdevelopment.com/wp-content/uploads/2016/10/2016-10-27_18-01-32.png 957w, https://visionquestdevelopment.com/wp-content/uploads/2016/10/2016-10-27_18-01-32-300x172.png 300w, https://visionquestdevelopment.com/wp-content/uploads/2016/10/2016-10-27_18-01-32-620x356.png 620w, https://visionquestdevelopment.com/wp-content/uploads/2016/10/2016-10-27_18-01-32-768x441.png 768w, https://visionquestdevelopment.com/wp-content/uploads/2016/10/2016-10-27_18-01-32-940x540.png 940w" sizes="(max-width: 957px) 100vw, 957px" alt="" class="so-widget-image img-fluid">-->
					</div>
					<!--<div class="col-md-4">
					    <h3 class="widget-title">Invoices</h3>
						<div class="siteorigin-widget-tinymce textwidget">
							<p>Harvest&nbsp;is how we manage our invoicing as well. You should see detailed time entries with a brief description of what we worked on that day. Below is an example of an invoice.&nbsp;</p>
						</div> 
						<img decoding="async" src="https://visionquestdevelopment.com/wp-content/uploads/2016/10/2016-10-27_18-01-32.png" width="957" height="550" srcset="https://visionquestdevelopment.com/wp-content/uploads/2016/10/2016-10-27_18-01-32.png 957w, https://visionquestdevelopment.com/wp-content/uploads/2016/10/2016-10-27_18-01-32-300x172.png 300w, https://visionquestdevelopment.com/wp-content/uploads/2016/10/2016-10-27_18-01-32-620x356.png 620w, https://visionquestdevelopment.com/wp-content/uploads/2016/10/2016-10-27_18-01-32-768x441.png 768w, https://visionquestdevelopment.com/wp-content/uploads/2016/10/2016-10-27_18-01-32-940x540.png 940w" sizes="(max-width: 957px) 100vw, 957px" alt="" class="so-widget-image img-fluid">
					</div>-->
				</div>
			</div>
			
			<a href="/get-started" class="btn btn-primary center">Learn More</a>

		</section> 
		*/ ?>
		<?php /*
		<section class="mt-5 mb-5">
			<div class="container">
			
				<div class="carousel-orbit">
				  <div class="slick-carousel">
					<!-- Card 1 -->
					<div class="planet-card">
					  <div class="card text-center">
						<div class="card-body">
						  <h5 class="card-title">Repo One</h5>
						  <p class="card-text">A short description of the first GitHub repo.</p>
						  <a href="https://github.com/yourname/repo-one" target="_blank" class="btn btn-primary">View Repo</a>
						</div>
					  </div>
					</div>

					<!-- Card 2 -->
					<div class="planet-card">
					  <div class="card text-center">
						<div class="card-body">
						  <h5 class="card-title">Repo Two</h5>
						  <p class="card-text">A short description of the second GitHub repo.</p>
						  <a href="https://github.com/yourname/repo-two" target="_blank" class="btn btn-danger">View Repo</a>
						</div>
					  </div>
					</div>

					<!-- Card 3 -->
					<div class="planet-card">
					  <div class="card text-center">
						<div class="card-body">
						  <h5 class="card-title">Repo Three</h5>
						  <p class="card-text">Some quick notes about this repo.</p>
						  <a href="https://github.com/yourname/repo-three" target="_blank" class="btn btn-success">View Repo</a>
						</div>
					  </div>
					</div>

					<!-- Card 4 -->
					<div class="planet-card">
					  <div class="card text-center">
						<div class="card-body">
						  <h5 class="card-title">Repo Four</h5>
						  <p class="card-text">Another description here.</p>
						  <a href="https://github.com/yourname/repo-four" target="_blank" class="btn btn-info">View Repo</a>
						</div>
					  </div>
					</div>

					<!-- Card 5 -->
					<div class="planet-card">
					  <div class="card text-center">
						<div class="card-body">
						  <h5 class="card-title">Repo Five</h5>
						  <p class="card-text">Details about this project.</p>
						  <a href="https://github.com/yourname/repo-five" target="_blank" class="btn btn-warning">View Repo</a>
						</div>
					  </div>
					</div>
					
					<!-- Card 1 -->
					<div class="planet-card">
					  <div class="card text-center">
						<div class="card-body">
						  <h5 class="card-title">Repo One</h5>
						  <p class="card-text">A short description of the first GitHub repo.</p>
						  <a href="https://github.com/yourname/repo-one" target="_blank" class="btn btn-primary">View Repo</a>
						</div>
					  </div>
					</div>

					<!-- Card 2 -->
					<div class="planet-card">
					  <div class="card text-center">
						<div class="card-body">
						  <h5 class="card-title">Repo Two</h5>
						  <p class="card-text">A short description of the second GitHub repo.</p>
						  <a href="https://github.com/yourname/repo-two" target="_blank" class="btn btn-danger">View Repo</a>
						</div>
					  </div>
					</div>

					<!-- Card 3 -->
					<div class="planet-card">
					  <div class="card text-center">
						<div class="card-body">
						  <h5 class="card-title">Repo Three</h5>
						  <p class="card-text">Some quick notes about this repo.</p>
						  <a href="https://github.com/yourname/repo-three" target="_blank" class="btn btn-success">View Repo</a>
						</div>
					  </div>
					</div>

					<!-- Card 4 -->
					<div class="planet-card">
					  <div class="card text-center">
						<div class="card-body">
						  <h5 class="card-title">Repo Four</h5>
						  <p class="card-text">Another description here.</p>
						  <a href="https://github.com/yourname/repo-four" target="_blank" class="btn btn-info">View Repo</a>
						</div>
					  </div>
					</div>

					<!-- Card 5 -->
					<div class="planet-card">
					  <div class="card text-center">
						<div class="card-body">
						  <h5 class="card-title">Repo Five</h5>
						  <p class="card-text">Details about this project.</p>
						  <a href="https://github.com/yourname/repo-five" target="_blank" class="btn btn-warning">View Repo</a>
						</div>
					  </div>
					</div>
					
					
				  </div>
				</div>

		
			</div>
		</div>
		*/ ?>
		
		<section class=" home-resume  pt-5 pb-5 text-white text-center">
			<div class="container">
				
				<div class="">
					<h2>See our recent work</h2>
					<div id="portfolio-list" >
						<?php
						
						$delay = 0.3;
						$query2 = new WP_Query( array( 
							'post_type' => array( 'portfolio' ), 
							'posts_per_page' => 3,
							'orderby' => 'desc'
							
						) );
						while ( $query2->have_posts() ) : $query2->the_post();

						?>
							<div class="portfolio-item wow zoomIn" data-wow-delay="<?php echo $delay; ?>s">
								<?php get_template_part( '/templates/homepage_portfolio_item' ); ?>
							</div>
						<?php 
						$delay += 0.3; // Increment delay by 0.3 seconds with each iteration
						endwhile;
						wp_reset_query();
						?>
					</div>
				</div>
				
				
			</div>
			<a href="/portfolio" class="btn btn-primary center">Learn More</a>
		</section>
		
		  <div class="vqdev-hero-container d-flex flex-column justify-content-center align-items-center ">
			<div class="hero-background"></div>
			<!--<h1 class="hero-text text-center">VISIONQUEST</h1>-->
			<h3 class="hero-text hero-text-small text-center">Creator of the</h3>
			<h1 class="hero-text text-center">PEGASUS THEME</h1>
		  </div>
		  
		  
		
		<section class="bkg-light  text-center ">
			<!--<h1 class="mb-5 ">Creator of the Pegasus Theme</h1>-->
			<div class="container-fluid py-5 services">
				<div class="row">
					<div class="col-md-6  my-3">
						<h3>WordPress Bootstrap Theme</h3>
						<img class="w-50 mb-3 img-fluid" src="https://visionquestdevelopment.com/wp-content/uploads/2025/06/pegasus.png">
						<p><strong>Free for the Community</strong></p>
						<p>While developing custom themes for clients across different projects, I noticed I was repeating many of the same steps. To streamline my workflow, I created a reusable base theme that I could customize and expand for each client. This WordPress theme is built with Bootstrap, utilizes CMB2 for custom fields, and incorporates various JavaScript libraries.</p>
					</div>
					<div class="col-md-6  my-3">
						<h3>Pegasus Suite of Plugins</h3>
						<img class="w-50 mb-3 img-fluid" src="https://visionquestdevelopment.com/wp-content/uploads/2025/06/raw5.png">
						<p><strong>It comes with a suite of plugins that are separately
								installed to add functionality to a site.</strong></p>
						<p>I designed this theme to simplify and speed up my development process when building custom WordPress sites. By sharing it freely, I hope it can serve as a helpful resource for other developers and contribute to the broader open-source ecosystem.
						</p>
					</div>
				</div>
			</div>
			<!--<div class="container-fluid">
				<div class="card h-100 border-0 rounded text-white"> 
					<div class="card-body quarternary-bkg rounded ">
					  <h4 class="card-title">Pegasus Demo Site</h4>
					  <p class="fw-bold">Live example of Pegasus in action with recommended plugins and features.</p>
					  <p class="card-text">Explore a full implementation of the Pegasus theme to see layout examples, shortcodes, and plugin integrations working together.</p>
					</div>
					<div class="card-footer bg-transparent border-0">
					  <a href="https://pegasustheme.com/" target="_blank" class="btn btn-primary w-100">Visit Website</a>
					</div>
				  </div>
			</div>-->
			
			<section class="pegasus-hero-section text-white d-flex align-items-center justify-content-center">
			  <div class="hero-overlay"></div>

			  <div class="container text-center hero-content">
				<h1 class="display-4 fw-bold">Pegasus Theme</h1>
				<p class="lead mt-3">The WordPress theme built with Bootstrap 5, CMB2, and JS plugins by Visionquest Development.</p>
				<p class="card-text">Explore a full implementation of the Pegasus theme to see layout examples, shortcodes, and plugin integrations working together.</p>

				<div class="d-flex justify-content-center gap-3 mt-4 flex-wrap">
				  <a href="https://github.com/Visionquest-Development/pegasus" target="_blank" class="btn btn-outline-light btn-lg">View on GitHub</a>
				  <a href="https://pegasustheme.com" target="_blank" class="btn btn-primary btn-lg">PegasusTheme.com</a>
				</div>
			  </div>
			</section>
			<!--
			<div class="container-fluid my-5">
				<h4 class="mb-3">Pegasus Resources</h4>
			  <div class="row">
				
				<div class="col-md-4 mb-4">
				  <div class="card h-100 border-0 rounded text-white">
					<div class="card-body secondary-bkg rounded ">
					  <h4 class="card-title">Pegasus Theme</h4>
					  <p class="fw-bold">The core WordPress theme built with Bootstrap 5, CMB2, and JS plugins.</p>
					  <p class="card-text">This base theme serves as the foundation for all client builds, providing clean markup, reusable components, and structured settings out of the box.</p>
					</div>
					<div class="card-footer bg-transparent border-0">
					  <a href="https://github.com/Visionquest-Development/pegasus" target="_blank" class="btn btn-primary w-100">View on GitHub</a>
					</div>
				  </div>
				</div>

				
				<div class="col-md-4 mb-4">
				  <div class="card h-100 border-0 rounded text-white">
					<div class="card-body tertiary-bkg rounded ">
					  <h4 class="card-title">Pegasus Child Theme</h4>
					  <p class="fw-bold">Customizable child theme tailored for client-specific styles and tweaks.</p>
					  <p class="card-text">This theme extends the base Pegasus theme, allowing you to safely override templates, styles, and functionality without touching the core.</p>
					</div>
					<div class="card-footer bg-transparent border-0">
					  <a href="https://github.com/Visionquest-Development/pegasus-child" target="_blank" class="btn btn-primary w-100">View Child Theme</a>
					</div>
				  </div>
				</div>

				
				<div class="col-md-4 mb-4">
				  <div class="card h-100 border-0 rounded text-white"> 
					<div class="card-body quarternary-bkg rounded ">
					  <h4 class="card-title">Pegasus Demo Site</h4>
					  <p class="fw-bold">Live example of Pegasus in action with recommended plugins and features.</p>
					  <p class="card-text">Explore a full implementation of the Pegasus theme to see layout examples, shortcodes, and plugin integrations working together.</p>
					</div>
					<div class="card-footer bg-transparent border-0">
					  <a href="https://pegasustheme.com/" target="_blank" class="btn btn-primary w-100">Visit Website</a>
					</div>
				  </div>
				</div>
			  </div>
			</div>

			<div class="container text-center">
					<h5>Git Clone commands</h5>
					<p>Run this in your theme folder within WordPress or download the latest zip from Github in the links above.</p>
					HTTPS
					<pre><code class="language-javascript">git clone https://github.com/Visionquest-Development/pegasus.git pegasus</code></pre>
					SSH
					<pre><code class="language-javascript">git clone git@github.com:Visionquest-Development/pegasus.git pegasus</code></pre>
			</div>-->
		</section>

		<div class="container home-content">
		  <!-- Example row of columns -->
			<div class="row">
				<div class="col-md-12">

					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

						<?php //the_content(); ?>

					<?php endwhile; else: ?>
						<?php /* kinda a 404 of sorts when not working */ ?>
						<div class="page-header">
							<h1>Oh no!</h1>
						</div>
						<p>No content is appearing for this page!</p>
					<?php endif; ?>
				</div>
				<?php //get_sidebar(); ?>

			</div>
		</div>
	</div>

    <?php get_footer(); ?>
