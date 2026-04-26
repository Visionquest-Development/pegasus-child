<?php
/*
	Template Name: Resume Template
*/
?>
	<?php get_header(); ?>

 <div id="page-wrap" class=" pt-5 pb-5  ">
    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
			<div class="col-md-12">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<div class="page-header">
						<h1><?php the_title(); ?></h1>
						<p>Updated: <?php $the_update = get_the_modified_date(); echo $the_update; ?></p>
						<br>

						<a class="btn btn-primary pdf-button" href="https://www.visionquestdevelopment.com/storage/2024/JMO_Final_Resume.docx" target="_blank">2024 Word Document Résumé</a>
						<a class="btn btn-primary pdf-button" href="https://www.visionquestdevelopment.com/storage/2024/JMO_Final_Resume.pdf" target="_blank">2024 PDF Résumé</a>
 
						<p>For normal résumé click the links above, otherwise for a more in depth résumé please read through below.</p>
					</div>

					<div class="resume-page-content"><?php the_content(); ?></div>

					<div class="resume-options">
					
						<span class="ms-close-btn">
						  <i class="fa fa-times"></i>
						</span>
						
						
						<form action="" class="   ">
							
							<div class="resume-options-container">
								<div class="item item-1">
									<button type="button" id="toggle-dark-theme" class="btn btn-default" >Dark Theme</button>
								</div>
								
								<div class="item item-2">
									<label class="switch dark-theme mb-3" data-theme="light">
										<input type="checkbox">
										<span class="slider"></span>
									</label>
								</div>
								
							</div>
							<div class="resume-options-container">
								<div class="item item-1">
									<button type="button" id="toggle-details" class="btn btn-default" >Hide details</button>
								</div>
								
								<div class="item item-2">
									<label class="switch details-switch mb-3">
										<input type="checkbox">
										<span class="slider"></span>
									</label>
								</div>
								
							</div>
						</form>
						
					</div>

					<div id="resume-container" class="clearfix">
						<!-- start of resume-->
						<header class="header wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s" >
							<div class="row">
								<!--<div class="col-md-4">
									<img class="resume-portfolio-pic" src="//visionquestdevelopment.com/wp-content/themes/octane-bootstrap/images/jim-2016.png">
								</div>-->
								<div class="col-md-12">
									<div class="resume-name">
										<h1>Jim O'Brien</h1>
										<span>Website & Application Development</span>
									</div>
								</div>
							</div>
							<div class="row contact-info">
								<div class="col-md-4 location">
									<address>
										<i class="fa fa-map-marker"></i> Atlanta, GA
									</address>
								</div>
								<div class="col-md-4 email">
									<i class="fa fa-paper-plane"></i>
									<a href="mailto:jim.obrien3@gmail.com?subject=Mail from Jims Resume">jim.obrien3@gmail.com</a>
								</div>
								<div class="col-md-4 phone">
									<i class="fa fa-phone"></i>
									<a href="tel:404-917-7530">(404) 917-7530</a>
								</div>
							</div>
						</header>

						<section id="summary">

							<p class="center summary-text">Looking for a DevOps or Full-Stack software engineering position. Senior Technical lead and mentor. Teacher attitude but student approach. Problem solver and troubleshooting master.</p>

							<div class="row summary">
								<?php /*
								<div class="col-md-4 summary-box">
									<h2>Summary</h2>
									<p>
										Looking for a DevOps or Full-Stack software engineering position. Open to in office, but prefer remote. Senior Technical lead and mentor. Teacher attitude but student approach. Problem solver and troubleshooting master.
									</p>
									
									
									<p>Web developer looking to learn as much as I can about software and how its implemented.
									I am a Web Developer not a Designer. I have design skills (UI and UX), but I do not specialize in Design.
									With the right Designer/ Team I can accomplish almost anything in web development, and I can help you build your online presence for your business.
									I can bring experience to the table with both front-end and back-end development, and I tend to be a jack of all trades.
									<!--I have worked with application development in such programs as phoneGap, I have designed responsive Wordpress sites from PSD files, I have done database cleanups through phpMyAdmin, I know how to move websites from one server to another, I know how to connect through SSH and grep through the contents of the server for a string, I know how to make use of PHP, Page templates, and Custom Post Types in Wordpress to display any kind of content, and I have made e-commerce websites in both zencart and woocommerce.-->
									</p>
									
								</div>
								*/ ?>
								<div class="col-md-6 skills mb-5">

										<h2>Skills</h2>
										<!-- 1 -->
										
										<!-- 2 -->
										<div class="progress-bar-holder row">
											<div class="col-md-6 col-sm-6">
												<p class="skill-text">Wordpress</p>
											</div>
											<div class="col-md-6 col-sm-6">
												<div class="progress">
												  <div class="progress-bar" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: 95%;">95%</div>
												</div>
											</div>
										</div>
										
										<div class="progress-bar-holder row">
											<div class="col-md-6 col-sm-6">
												<p class="skill-text">Dev Ops</p>
											</div>
											<div class="col-md-6 col-sm-6">
												<div class="progress">
												  <div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 90%;">90%</div>
												</div>
											</div>
										</div>
										
										<div class="progress-bar-holder row">
											<div class="col-md-6 col-sm-6">
												<p class="skill-text">Sys Admin</p>
											</div>
											<div class="col-md-6 col-sm-6">
												<div class="progress">
												  <div class="progress-bar" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 85%;">85%</div>
												</div>
											</div>
										</div>
										
										
										
										<!-- 3 -->
										
										<!-- 4 -->
										
										<!-- 6 -->

										<!-- 5 -->
										
										<!-- 6 -->
										
										<div class="progress-bar-holder row">
											<div class="col-md-6 col-sm-6">
												<p class="skill-text">HTML/CSS</p>
											</div>
											<div class="col-md-6 col-sm-6">
												<div class="progress">
												  <div class="progress-bar" role="progressbar" aria-valuenow="99" aria-valuemin="0" aria-valuemax="100" style="width: 99%;">99%</div>
												</div>
											</div>
										</div>
										
										
										<div class="progress-bar-holder row">
											<div class="col-md-6 col-sm-6">
												<p class="skill-text">Javascript</p>
											</div>
											<div class="col-md-6 col-sm-6">
												<div class="progress">
												  <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%;">90%</div>
												</div>
											</div>
										</div>

										
										<div class="progress-bar-holder row">
											<div class="col-md-6 col-sm-6">
												<p class="skill-text">PHP</p>
											</div>
											<div class="col-md-6 col-sm-6">
												<div class="progress">
												  <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%;">90%</div>
												</div>
											</div>
										</div>
										
										<div class="progress-bar-holder row">
											<div class="col-md-6 col-sm-6">
												<p class="skill-text">UI/UX</p>
											</div>
											<div class="col-md-6 col-sm-6">
												<div class="progress">
												  <div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;">80%</div>
												</div>
											</div>
										</div>

										<!--
										<div class="progress-bar-holder row">
											<div class="col-md-6 col-sm-6">
												<p class="skill-text">Laravel</p>
											</div>
											<div class="col-md-6 col-sm-6">
												<div class="progress">
												  <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;">40%</div>
												</div>
											</div>
										</div>-->

										<!--
										<div class="progress-bar-holder row">
											<div class="col-md-6 col-sm-6">
												<p class="skill-text">Meteor</p>
											</div>
											<div class="col-md-6 col-sm-6">
												<div class="progress">
												  <div class="progress-bar" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 30%;">30%</div>
												</div>
											</div>
										</div>-->

										<!-- 7
										<div class="progress-bar-holder row">
											<div class="col-md-6 col-sm-6">
												<p class="skill-text">Angular</p>
											</div>
											<div class="col-md-6 col-sm-6">
												<div class="progress">
												  <div class="progress-bar" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 30%;">30%</div>
												</div>
											</div>
										</div>-->

										<!--
										<div class="progress-bar-holder row">
											<div class="col-md-6 col-sm-6">
												<p class="skill-text">React</p>
											</div>
											<div class="col-md-6 col-sm-6">
												<div class="progress">
												  <div class="progress-bar" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 30%;">30%</div>
												</div>
											</div>
										</div>-->
								</div>
								<div class="col-md-6 specializations">
									<h2>Specializations</h2>
									<ul>
									<li>Responsive Web Design <a target="_blank" href="http://en.wikipedia.org/wiki/Responsive_web_design"><i class="fa fa-link"></i></a></li>
									<li>PSD (Photoshop files/ Design files) to HTML conversion and PSD to Wordpress conversion.</li>
									<li>Application development in such programs as NEXTJS and React Native.</li>
									<li>Database management / PHPMyAdmin</li>
									<li>bash script, linux command line</li>
									<li>Server maintenance and administration.</li>
									<li>E-commerce websites</li>
									<li>Wordpress Plugin and Theme Development</li>
									<li>I know how to make use of PHP in page templates, Custom Post Types, and Custom Fields in <strong>Wordpress</strong> to display any kind of content.</li>
									</ul>
								</div>

							</div>
							<hr>
						</section>




						<section id="experience">




							<div class="">
								<h2>Work Experience</h2>
								<hr style="border-bottom: 1px solid #dedede;">
								<h3>Current</h3>

								<!-- current -->
								<div class="past-employer no-bottom-border row">
									<div class="col-md-2">
										<img class="employer-img" src="//visionquestdevelopment.com/wp-content/uploads/2013/12/VQD-Logo-blk-sml.png">
									</div>
									<div class="col-md-3 ">
										<h3 class="business-name">VisionQuest</h3>
										<i>Currently Ongoing</i><br>
										<span>Marietta, GA</span>
									</div>
									<div class="col-md-7 ">
										<h4 class="position">WordPress Developer (freelance)</h4>
										<div class="short-description">											
											<?php /*
											<p class="available">
												Currently I am at a job that allows me to freelance on the side only if it makes sense, with no large commitments. 
											</p>
											*/ ?>
											<?php /* ?>
												<div class="unavailable">Currently I am at a job that will not allow me to freelance.</div>
											<?php */ ?>
											<br>
											<p>Currently taking on leads, job opportunities, contracts, and for hire positions. I'm the owner of Visionquest and have been working for myself on and off for years since 2013.</p>
										</div>
									</div>
								</div>


								<!-- current -->
								

								<hr style="border-bottom: 1px solid #dedede;">
								<!-- -===================================================================================-->

								<h3>Past</h3>
								
								
								<div class="past-employer row">
									<div class="col-md-2">
										<img class="employer-img" src="<?php echo get_stylesheet_directory_uri(); ?>/images/ng.png">
									</div>
									<div class="col-md-3 ">
										<h3 class="business-name">Peraton/Northrop Grumman</h3>
										<i>
											Dec 2016 - Sept 2017<br> (TekSystems Contractor), <br>
											Sept 2017 - Jan 2021<br> (NG Employee), <br>
											Jan 2021 - Sept 2024<br> (Peraton Employee)
										</i>
										<br>
										<span>Atlanta, GA</span>
									</div>
									<div class="col-md-7 ">
										<h4 class="position">Software Engineer</h4>
										<p class="short-description">
											Started as a contractor for Northrop Grumman through TEKsystems, 
											then worked at Northrup Grumman IT sector for 2017-2021, and then transitioned to Peraton for 2021-2024. 
											
											Technical Lead and Team member of the Digital Media Branch for the Office of the Associate Director for Communications of the CDC.
											
											I helped on the WCMS project, which was a project to convert the CDC over from Percussion Rhythmix to WordPress. 
											
											Started as a PHP developer for the WCMS team and helped produce 18 custom visual composer modules for the page builder. 
											
											Was asked to join the TemplatePackage team which helps produce all of the front-end assets for the CDC.gov agency, helped roll out 200K+ pages for Template Package version 4, and  helped refactor the project’s build tool to cut down on development build time by 75%.
											
											Performed code reviews and production deployments, improved CI/CD pipelines reducing deployment time by 50%, converted the entire site from SVGs to webfont icons removing 700+ lines of page weight.
											
											Supported the COVID outbreak, worked with Boston Children's Hospital to produce Vaccines.gov NEXT JS application on CDC network and infrastructure, mentioned by the President in 2021. 
											
											Practiced Agile, SCRUM, and Kanban processes, including JIRA ticket triage, resource allocation, and stand-ups.
										</p>
										
										<p class="job-details">
											Here I learned more about the agile process, JIRA ticket triage, more about PHP, Javascript, and jQuery.
											
											I gained mastery of PHPStorm and the debugging experience unlike I've ever seen before. Also learned about regression testing and prevention.
											
											I also enhanced my knowledge of high availability apps, git version control, and troubleshooting complicated problems.
											
											Also, worked on builds and deployments with JENKINS and distributed production releases to multiple environments.
											
											Gained mastery at git version control, git management, git workflow management, GitHub Actions, and Pull Request reviews.
											
											Developed modules using HTML, CSS, PHP, JavaScript, and jQuery. Switched entire build process over from grunt to gulp 
											for Template Package project. Implemented eslint and stylelint coding standards and an ExpressJS development server 
											with browser-sync for faster development environment. 											
											
											Experienced with high availability apps, git version control &amp; management, release cycles, deployment management, 
											road-mapping, and troubleshooting complicated technical problems and business decisions. 
											
											Helped support the CDC.gov agency in their Digital First initiative and helped produce the DFE (editor) within the WCMS. 
											
											Helped with the relaunch of the CDC.gov website in May 2024.
										</p>
									</div>
								</div>
								

								<!-- -2 -->
								<div class="past-employer row">
									<div class="col-md-2">
										<div class="employer-img" style="background: #3863a0 !important; padding: 20px 10px;">
											<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/toptal.png">
										</div>
									</div>
									<div class="col-md-3 ">
										<h3 class="business-name">TopTal</h3>
										<i>May 2016 - Dec 2016 </i><br>
										<span>Marietta, GA</span>
									</div>
									<div class="col-md-7 ">
										<h4 class="position">Software Engineer</h4>
										<p class="short-description">Toptal is a place where you can hire designers and developers to create or update your site. They have a rigorous onboarding system that tests all the developers and designers very thoroughly. Once I passed I am able to set my availability and apply for jobs on a listing board. I worked for one main client through Toptal and it was a law agency in LA, they had an already existing site and I made some customizations and updates. </p>
									</div>
								</div>

								<!-- -1 -->
								<div class="past-employer row">
									<div class="col-md-2">
										<img class="employer-img" src="<?php echo get_stylesheet_directory_uri(); ?>/images/s8.png">
									</div>
									<div class="col-md-3 ">
										<h3 class="business-name">Sideways 8</h3>
										<i>May 2016 - Dec 2016  </i><br>
										<span>Marietta, GA</span>
									</div>
									<div class="col-md-7 ">
										<h4 class="position">Developer</h4>
										<p class="short-description">After emailing back and fourth I met one of the owners at WordCamp, a WordPress conference in town. Once we met I started doing maintenance and support for them as a contractor and eventually made some themes for some of their clients.</p>
										<p class="job-details">I learned how git version control works, how to use foundation library in themes, how to use their custom configuration for the WordPress customizer and their custom theme framework. I learned how to configure their custom vagrant environment on my machine, and I enhanced my jQuery and javascript skills. </p>
									</div>
								</div>

								<!-- 0 -->
								<div class="past-employer row">
									<div class="col-md-2">
										<!--<img src="<?php //echo get_stylesheet_directory_uri(); ?>/images/octane.png">-->
										<img class="employer-img" src="/images/octane.svg">
									</div>
									<div class="col-md-3 ">
										<h3 class="business-name">Octane Marketing Solutions</h3>
										<i>September 2014 - Mar 2016 (W2), Mar 2016 - Dec 2016 (1099)  </i><br>
										<span>Marietta, GA</span>
									</div>
									<div class="col-md-7 ">
										<h4 class="position">Development Director</h4>
										<p class="short-description">The lead developer and admin of a growing marketing company in Marietta, GA.
										We serve our clients to the best of our ability and provide business solutions to any small or corporate business
										depending on their needs. I manage all of Octane's clients which includes things like: System Administration,
										PHP development, HTML templates, CSS media queries, database administration, email configuration, and much more.</p>
										<!--<p>W2: September 2014 - March 2016, Freelancer: March 2016 - Current</p>-->
										<p class="job-details">I gained even more experience in System Administration, PHP development, HTML templates, CSS media queries, CSS and JS animation, database administration, email configuration, and much more.</p>
									</div>
								</div>

								<!-- 1 -->
								<div class="past-employer row">
									<div class="col-md-2">
										<img class="employer-img" src="//visionquestdevelopment.com/wp-content/uploads/2013/12/VQD-Logo-blk-sml.png">
									</div>
									<div class="col-md-3 ">
										<h3 class="business-name">VisionQuest</h3>
										<i>May 2013 - Sept 2014 (freelance)</i><br>
										<span>Auburn, AL</span>
									</div>
									<div class="col-md-7 ">
										<h4 class="position">Web Developer (freelance)</h4>
										<p class="short-description">
										A growing business that provides software solutions to its customers.
										We manage a cPanel /WHM (Web Host Manager)
										server for some of our internal websites, but also to provide a place for clients to host with us.
										Whether its websites or mobile apps we aim to please.
										</p>
										<p class="job-details">I learned how to manage and control databases with and without phpMyAdmin, system administration, domain management, DNS configuration, jQuery, javascript, javascript libraries, how to include libraries and frameworks into projects, how to write PHP forms from scratch, etc. </p>
									</div>
								</div>

								<!-- 2 -->
								<div class="past-employer row">
									<div class="col-md-2">
										<img class="employer-img" src="<?php echo get_stylesheet_directory_uri(); ?>/images/jamersan.png">
									</div>
									<div class="col-md-3 ">
										<h3 class="business-name">Jamersan</h3>
										<i>May 2013 - October 2013 </i><br>
										<span>Opelika, AL</span>
									</div>
									<div class="col-md-7 ">
										<h4 class="position">Web Developer</h4>
										<p class="short-description">
											This is where I learned CSS, responsive web design, how to write wordpress plug-ins,
											create custom wordpress templates, and custom post types. TJ is very knowledgeable and I learned a lot from him, he runs a Magento development shop that does good work. I only signed on to be a intern, but stayed for a couple months longer and I appreciate what I learned from this job.
										</p>
										<p class="job-details">I also learned about how content management systems worked (CMS), worked on e-commerce solutions like Magento and Woocommerce, and enhanced my Photoshop skills. After my internship was over for the summer I went on to work for them for a coupld extra months until Oct of 2013. </p>
									</div>
								</div>

								<!-- 3 -->
								<div class="past-employer row">
									<div class="col-md-2">
										<img class="employer-img" src="<?php echo get_stylesheet_directory_uri(); ?>/images/auburn.png">
									</div>
									<div class="col-md-3 ">
										<h3 class="business-name">Auburn University</h3>
										<i>August 2012 - August 2013 </i><br>
										<span>Auburn, AL</span>
									</div>
									<div class="col-md-7 ">
										<h4 class="position">Research Assistant</h4>
										<p class="short-description"> As a research assistant I learned how to do good research work for
										Dr. Hamilton at Auburn University. When there I worked on a Unity game development project for
										Con-ops in 3D modeling. I also wrote a PHP website for http://cyber.auburn.edu.</p>
										<p class="job-details">Here I learned abut VPNs, password cracking, network security, rainbow tables, GPU manipulation for pasword cracking, A+ pathing algorithms, hacking, etc. </p>
									</div>
								</div>

								<!-- 4 -->
								<div class="past-employer row">
									<div class="col-md-2">
										<img class="employer-img" src="<?php echo get_stylesheet_directory_uri(); ?>/images/coachcomm.png">
									</div>
									<div class="col-md-3 ">
										<h3 class="business-name">CoachComm</h3>
										<i>August 2011 - August 2012</i><br>
										<span>Auburn, AL</span>
									</div>
									<div class="col-md-7 ">
										<h4 class="position">Service Technician</h4>
										<p class="short-description">Coachcomm does audio equipment for football. I maintenance the college
										systems that come in. I started working in the production department. I enjoy learning about hardware and
										troubleshooting at Coachcomm.</p>
										<div class="job-details">
											<p>One of the most important things I learned here was how to troubleshoot almost any kind of problem in both hardware or software.</p>
											<p>I learned RHOS management, ESD protocols, production line skills, maufacturing lines skills, and quality control skills, R/F module configuration, wireless communication protocols (900Mhz and 2.4Ghz), and much more.   </p>
										</div>
									</div>
								</div>

								<!-- 5 -->
								<div class="past-employer row">
									<div class="col-md-2">
										<img class="employer-img" src="<?php echo get_stylesheet_directory_uri(); ?>/images/the-loft.jpg">
									</div>
									<div class="col-md-3 ">
										<h3 class="business-name">The Loft</h3>
										<i>May 2010 - March 2012</i><br>
										<!--<span>Marietta, GA</span>-->
									</div>
									<div class="col-md-7 ">
										<h4 class="position">Web Developer</h4>
										<p class="short-description">I created a website for The Loft. It is a business located in downtown Columbus, GA.
										They have a venue for comedy and music shows, and I helped develop the online store for ticket purchases.
										I maintenance the event calendar, and continue to do work with The Loft currently.</p>
										<p class="job-details">I learned about WordPress, Zencart, HTML, and some Photoshop skills.</p>
									</div>
								</div>
								<hr style="border-bottom: 1px solid #dedede;">
								<div class="expand-past">
									<a class="btn btn-default" id="expand-button" href="#expand-past-container">Past work (2006-2009)</a>
									<div id="expand-past-container">
										<!-- 6 -->
										<div class="past-employer row">
											<div class="col-md-2">
												<img class="employer-img" src="<?php echo get_stylesheet_directory_uri(); ?>/images/lowes.png">
											</div>
											<div class="col-md-3 ">
												<h3 class="business-name">Lowe's Home Improvement</h3>
												<i>April 2009 - July 2009</i><br>
												<span>Auburn, AL</span>
											</div>
											<div class="col-md-7 ">
												<h4 class="position">Customer Service Associate/Cashier</h4>
												<p class="short-description">Helped contractors in the Lumber department. Received some forklift training and customer service knowledge. </p>
											</div>
										</div>

										<!-- 7 -->
										<div class="past-employer row">
											<div class="col-md-2">
												<img class="employer-img winners" src="<?php echo get_stylesheet_directory_uri(); ?>/images/ruby.jpeg">

											</div>
											<div class="col-md-3 ">
												<h3 class="business-name">Ruby Tuesday's</h3>
												<i>Sept 2008 - Feb 2009</i><br>
												<span>Auburn, Alabama</span>
											</div>
											<div class="col-md-7 ">
												<h4 class="position">Salad Bar manager, prep cook, line cook, and pantry</h4>
												<p class="short-description">At the short time I was with Ruby Tuesday's I worked four different jobs. I fufilled whatever position was needed that week </p>
											</div>
										</div>

										<!-- 8 -->
										<div class="past-employer row">
											<div class="col-md-2">
												<img class="employer-img winners" src="<?php echo get_stylesheet_directory_uri(); ?>/images/HoulihansLogo.jpeg">
											</div>
											<div class="col-md-3 ">
												<h3 class="business-name">Houlihan's</h3>
												<i>Aug 2007 -  Feb 2008</i><br>
												<span>Marietta, GA</span>
											</div>
											<div class="col-md-7 ">
												<h4 class="position">Bus boy, prep cook, expo</h4>
												<p class="short-description">Here I started as a bus boy cleaning tables and worked my way into the kitchen and learned the back-of-house operations of a restaurant. Eventually I was an expo garnishing plates before they go out and getting them to the right server and table. Also, learned from the head chef Cory Mack about how to cut food properly and how to properly prep for demands of the kitchen at Houlihan's.</p>
											</div>
										</div>


										<!-- 9 -->
										<div class="past-employer row">
											<div class="col-md-2">
												<img class="employer-img winners" src="<?php echo get_stylesheet_directory_uri(); ?>/images/mrs-winners-chicken-and-biscuits-logo-image.jpg">

											</div>
											<div class="col-md-3 ">
												<h3 class="business-name">Mrs. Winners</h3>
												<i>Jun 2006 - Aug 2007, Feb 2008 - July 2008</i>
												<span>Marietta, GA</span>
											</div>
											<div class="col-md-7 ">
												<h4 class="position">Assistant Supervisor</h4>
												<p class="short-description">Cashier, cook, and shift supervisor. Started in 2006 and was almost a manager before leaving for college. Good relationship with boss led me to doing catering orders and running parts of the store even after returning from a hiatus with another job. </p>
											</div>
										</div>

									</div><!--end expand container -->
								</div>
							</div>

							<hr>
						</section>



						<section id="education">
							<h2>Education</h2>
							<div class="past-school row">
								<div class="col-md-4 left">
									<h3 class="school-name">Auburn University</h3>
									<i>2012 - 2014</i><br>
									<span>Auburn, AL</span>
								</div>
								<div class="col-md-8 ">
									<h4 class="position">Bachelor's degree, Computer Science, Junior</h4>
									<p class="short-description">Transferred to Auburn and began Computer Science degree – left to undertake a full-time development position.  Worked at the Auburn Cyber Research Center under Professor Hamilton in the Information Assurance Lab. </p>
								</div>
							</div>
							<div class="past-school row">
								<div class="col-md-4 left ">
									<h3 class="school-name">Southern Union State Community College</h3>
									<i>2008 - 2012</i><br>
									<span>Opelika, AL</span>
								</div>
								<div class="col-md-8 ">
									<h4 class="position">Associate's degree, Science, Graduated 2012</h4>
									<p class="short-description">Moved to Alabama and worked for a full year to gain residency. Achieved 69 hrs to transfer to Auburn Univ.</p>
								</div>
							</div>
							<div class="past-school row">
								<div class="col-md-4 left">
									<h3 class="school-name">Alan C Pope High School</h3>
									<i>2004 - 2008</i><br>
									<span>Marietta, GA</span>
								</div>
								<div class="col-md-8 ">
									<h4 class="position">High School Diploma, College Prep</h4>
									<p class="short-description">College Prep field of study. Took clases in electives such as Database Management and White housing, Access and Excel, and Telecommunications. Activities and Societies: Wrestling</p>
								</div>
							</div>

							<hr>
						</section>



						<section id="computers">
							<!--
							<div class="row">
								<div class="col-md-6">
									<h5>Hardware Capability</h5>
									<ul>
										<li>Experienced with hardware installation including hard drives, Ethernet cards, video cards, memory, CPUs, etc.</li>
										<li>Ability to assemble an entire PC including peripheral devices from OEM materials.</li>
										<li>Very familiar with peripheral devices including: iPods (and other MP3 players), cameras, scanners, printers, and multimedia devices.</li>
										<li>Ability to repair hardware issues with Microsoft Xbox and Xbox 360.</li>
										<li>Built product on an assembly line and understand the manufacturing and production process including test procedures and proper Electrostatic Discharge (ESD) protocols.</li>
										<li>Have experience with wireless communication systems including troubleshooting sound quality and radio testing.</li>
										<li>Experience with soldering components and can easily perform board level repair with the right equipment.</li>

									</ul>
								</div>
								<div class="col-md-6">
									<h5>Software Capability</h5>
									<ul>
										<li>7+ years of virus removal experience</li>
										<li>Very skilled with installation, networking, and desktop support with Windows 10, Windows 8.1, Windows 8, Windows 7, Windows Vista, Windows XP Professional, Windows Media Center, Windows 2000, and Windows 98 SE.</li>
										<li>Limited experience with Apple Macintosh, but more experience with Linux and Unix based system units.</li>
										<li>Expert with business applications like Word, Excel, Access, Vizio, Visual Studio 2008, Microsoft Virtual PC, Corel Draw, Photoshop, Dreamweaver, Flash, etc.</li>
										<li>Completed classes in basic SQL and Oracle.</li>
										<li>Limited experience with VB6 and C++ application development.</li>
										<li>Some experience with editing of the Windows registry and Environment Variables.</li>
										<li>Experience with Android development.</li>
									</ul>
								</div>
							</div>


							<div class="row second">
								<div class="col-md-6">

									<h5>Networking Capability</h5>
									<ul>
										<li>Familiar with routers, switches, and WLAN devices as well as Ethernet cabling and cable creation.</li>
										<li>Experienced with Windows Server 2008 R2, Windows Server 2003, Ubuntu server, and SQL server</li>
										<li>Knowledge of WLAN encryption methods and networking implementation.</li>
										<li>Implemented firewalls and complete understanding of TCP/IP ports.</li>
										<li>Ability to implement DHCP and DNS servers.</li>
										<li>Familiarity with IIS and web servers</li>
										<li>Experienced with Active Directory and Indexing services.</li>
										<li>Some experience with Windows domain servers, and Windows Server 2008 R2.</li>
										<li>Experienced with virtual machines including hyper-V virtual machines.</li>
										<li>Skilled in database management in both Oracle and MYSQL.</li>
									</ul>


								</div>
								<div class="col-md-6">

									<h5>Security Capability</h5>
									<ul>
										<li>Experience with encrypted files and hidden folders.</li>
										<li>Familiar with hashes and network security.</li>
										<li>Familiar with rainbow tables and password cracking.</li>
										<li>Submitted white paper on Cyber Attack Analysis through Auburn University.</li>
									</ul>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6">
									<h5>Web Development</h5>
									<ul>
										<li>Developed four websites for a business located in Columbus, GA.</li>
										<li>Developed a php based website for Auburn University's Cyber Defence Labs.</li>
										<li>Expert in wordpress an open source Content Management System (CMS) that is used for content management.</li>
										<li>Expert in converting designs into fully functional websites, and experience with Responsive Websites that includes Mobile Development (Android and iOS).</li>
										<li>Expert in HTML/HTML5 and CSS/CSS3.</li>
										<li>Know how to use Adobe CS5 Master Collection of webmaster tools including Photoshop, Flash, and Dreamweaver.</li>
										<li>Developed e-commerce sites in both Zen-cart and Magento.</li>
										<li>Familiar with Git and github also with bitbucket.</li>
									</ul>
								</div>
								<div class="col-md-6">
									

								</div>
							</div>-->
							<!--
							<h1>Programming Languages</h1>
							<div class="row">
								<div class="col-md-4">
									<h2>Proficient:</h2>
									<ul>
										<li>HTML</li>
										<li>CSS</li>
										<li>PHP</li>
										<li>JavaScript</li>
										<li>Databases/SQL/MySQL</li>
									</ul>
								</div>
								<div class="col-md-4">
									<h2>Intermediate:</h2>
									<ul>
										<li>Object Oriented Programming (OOP) style coding</li>
										<li>Python</li>
										<li>C++</li>
										<li>Java</li>
									</ul>
								</div>
								<div class="col-md-4">
									<h2>In Progress:</h2>
									<ul>
										<li>Rust</li>
										<li>Ruby on Rails</li>
										<li>Go</li>
									</ul>
								</div>
							</div>
							
							<h1>Development</h1>
							<div class="row">
								<div class="col-md-4">
									<h2>Proficient:</h2>
									<ul>
										<li>Vanilla JavaScript</li>
										<li>AJAX</li>
										<li>Node.JS</li>
										<li>Build tools [Grunt, Gulp, Webpack, Parcel]</li>
										<li>Content management systems (CMS) [WordPress]</li>
										<li>E-commerce [WooCommerce, Magento]</li>
										<li>Responsive Web Design</li>
										<li>Git</li>
										<li>JIRA</li>
										<li>MS Teams</li>
										<li>Slack</li>
										<li>Confluence</li>
										<li>Adobe Metrics/Omniture</li>
										<li>Foresee surveys</li>
										<li>PHPStorm</li>
										<li>VSCode</li>
									</ul>
								</div>
								<div class="col-md-4">
									<h2>Intermediate:</h2>
									<ul>
										<li>MVC frameworks</li>
										<li>React</li>
										<li>Angular</li>
										<li>Meteor</li>
										<li>Laravel</li>
										<li>Eslint</li>
										<li>Babel</li>
										<li>Express JS</li>
										<li>nunjucks</li>
										<li>browser-sync</li>
										<li>typeahead JS</li>
										<li>popper JS</li>
										<li>GitLab</li>
										<li>PHPUnit</li>
									</ul>
								</div>
								<div class="col-md-4">
									<h2>In Progress:</h2>
									<ul>
										<li>GatsbyJS</li>
										<li>NextJS</li>
										<li>Unity</li>
										<li>Photoshop</li>
										<li>Illustrator</li>
										<li>Sketch</li>
										<li>AXshare</li>
										<li>CodeIgniter</li>
										<li>Customer relationship management (CRM – Salesforce)</li>
										<li>Vue.js</li>
										<li>D3.js</li>
										<li>C3.js</li>
										<li>WebGL</li>
										<li>backbone.js</li>
										<li>handlebars.js</li>
										<li>mustache.js</li>
										<li>socket.io</li>
										<li>prettier</li>
										<li>typescript</li>
										<li>svelte</li>
										<li>PhoneGap</li>
										<li>Cordova</li>
									</ul>
								</div>
							</div>
							
							<h1>Dev Ops</h1>
							<div class="row">
								<div class="col-md-4">
									<h2>Proficient:</h2>
									<ul>
										<li>Vagrant</li>
										<li>Virtual Machines / Virtualization</li>
										<li>Continuous integration (CI/CD)</li>
										<li>Jenkins</li>
										<li>WHM/cPanel</li>
									</ul>
								</div>
								<div class="col-md-4">
									<h2>Intermediate:</h2>
									<ul>
										<li>Kubernetes</li>
										<li>Ansible</li>
										<li>AWS (EC2, S3, Route 53, RDS, Cloudflare)</li>
										<li>Chef</li>
										<li>Puppet</li>
									</ul>
								</div>
								<div class="col-md-4">
									<h2>In Progress:</h2>
									<ul>
										<li>Docker</li>
										<li>Travis</li>
									</ul>
								</div>
							</div>

							
							<h1>Others</h1>
							<div class="row">
								<div class="col-md-4">
									<h2>Security:</h2>
									<ul>
										<li>Fortify</li>
										<li>WebInspect</li>
										<li>NTLM/NLA</li>
										<li>SSL/TLS</li>
										<li>oAuth</li>
										<li>Cross Site Scripting (XSS) vulnerability prevention</li>
									</ul>
								</div>
								<div class="col-md-4">
									<h2>Testing:</h2>
									<ul>
										<li>Troubleshooting/Debugging (xdebug, phpcs)</li>
										<li>Software Testing (PHPUnit, Selenium, Mocha)</li>
										<li>508 Compliance</li>
										<li>Regression testing</li>
									</ul>
								</div>
								<div class="col-md-4">
									<h2>Linux:</h2>
									<ul>
										<li>SSH</li>
										<li>Linux CLI</li>
										<li>Bash scripting</li>
										<li>Web Server stack (LAMP/LEMP)</li>
										<li>Server setup and maintenance</li>
									</ul>
								</div>
							</div>
							

							
							<div class="row">
								
								<div class="col-md-6">
									<h2>Windows:</h2>
									<ul>
										<li>Windows Server 2008/2012 R2/2016</li>
										<li>Windows PowerShell scripting</li>
										<li>Active Directory Services</li>
										<li>Virtual Directories</li>
										<li>File replication</li>
									</ul>
								</div>
								<div class="col-md-6">
									<h2>Database:</h2>
									<ul>
										<li>MySQL</li>
										<li>PostgreSQL</li>
										<li>MariaDB</li>
										<li>Firebase</li>
										<li>Pusher</li>
										<li>SQL scripting</li>
										<li>ERD diagramming</li>
										<li>PDO PHP</li>
										<li>phpMyAdmin</li>
									</ul>
								</div>
							</div>-->
							
							<h2>Programming Languages</h2>
							<b><u>Proficient:</u></b> HTML, CSS, PHP, JavaScript, Databases/SQL/MySQL<br>
							<b><u>Intermediate:</u></b> Object Oriented Programming (OOP) style coding, Typescript, Bash, Powershell, Python, C++, C#, Java<br>
							<b><u>In Progress:</u></b> Rust, Ruby on Rails, Go
							<br>
							<br>
							<h2>Development</h2>
							<b><u>Proficient:</u></b> Vanilla JavaScript, AJAX, JSON, fetch, Node.JS, npm, build tools [Grunt, Gulp, Webpack, Parcel], content management systems (CMS) [WordPress], E-commerce [WooCommerce, Magento, Stripe], Responsive Web Design, PHPStorm, VSCode, React, NEXTJS, ExpressJS, GraphQL, REST APIs<br>
							<b><u>Intermediate:</u></b> MVC frameworks, React, Angular, Meteor, Laravel, Eslint, Babel, Express JS, nunjucks, browser-sync, typeahead JS, popper JS, GitLab, PHPUnit<br>
							<b><u>In Progress:</u></b> GatsbyJS, Unity, Photoshop, Illustrator, Sketch, AXshare, CodeIgniter, Customer relationship management (CRM – Salesforce), Vue.js, D3.js, C3.js, WebGL, backbone.js, handlebars.js, mustache.js, socket.io, prettier, svelte, PhoneGap, Cordova 
							<br>
							<br>
							<h2>Dev Ops</h2>
							<b><u>Proficient:</u></b> Vagrant, Virtual Machines / Virtualization, continuous integration (CI/CD), Jenkins, WHM/cPanel, Git, GitHub, GitHub actions, GitLab, GitLab CI/CD, Bitbucket<br>
							<b><u>Intermediate:</u></b> Kubernetes, Ansible, AWS (EC2, S3, Route 53, RDS, Cloudflare), Chef, Puppet<br>
							<b><u>In Progress:</u></b> Docker, Travis CI, Azure, Google Cloud Platform
							<br>
							<br>
							<h2>Others</h2>
							<b><u>Databases:</u></b> MySQL, PostgreSQL, MariaDB, Firebase, Pusher, SQL scripting, ERD diagramming, PDO PHP, phpMyAdmin, SQL Server<br>
							
							<b><u>Security:</u></b> Fortify, WebInspect, NTLM/NLA, SSL/TLS, oAuth, Cross Site Scripting (XSS) vulnerability prevention, SSO, OAuth2, IdP (SAML, Google WorkSpace, OKTA)<br>

							<b><u>Testing:</u></b> Troubleshooting/Debugging (xdebug, phpcs, phpcbf), Software Testing (PHPUnit, WPMock, Selenium, Mocha, Jest, Cypress, JUnit, Puppeteer, PhantomJS, Backstop), 508 Compliance, Regression testing<br>

							<b><u>Linux:</u></b> SSH, Linux CLI, Bash scripting, Web Server stack (LAMP/LEMP), server setup and maintenance, Nginx, Apache, Ubuntu, CentOS<br>

							<b><u>Windows:</u></b> Windows Server 2008/2012 R2/2016, Windows PowerShell scripting, Active Directory Services, Virtual Directories, file replication, IIS<br>

							<b><u>Other:</u></b> JIRA, MS Teams, Slack, Confluence, Adobe Launch/Adobe Metrics/Omniture, Adobe Experience Cloud, Google Analytics, GoogleDAP, CSAT surveys (Foresee/Verint), Onetrust							
							
							<hr>
						</section>


						<section id="references">
							<h2>References</h2>
							<div class="row">
								<div class="col-md-4 reference">
									<b>Dave Cummo</b><br>
									Previous Employer - Professional Reference<br>
									<i>Architect at Pennant (Contractor to CDC)</i><br>
									Atlanta, GA (404)-432-4780
									<!--<a href="mailto:dcummo@gmail.com">dcummo@gmail.com</a>-->
								</div>
								<div class="col-md-4 reference">
									<b>Cass Pallansch</b><br>
									Previous Employer - Professional Reference<br>
									<i>Architect at AditTech (Contractor to CDC)</i><br>
									Atlanta, GA (770)-490-4534
									<!--<a href="mailto:cpallansch@adittech.com">cpallansch@adittech.com</a>-->
								</div>
								<div class="col-md-4 reference">
									<b>Bill Scott</b><br>
									Previous Employer - Professional Reference<br>
									<i>Project Manager at Peraton</i><br>
									Cumming, GA (678)-629-9458
									<!--<a href="mailto:williamemersonscott@gmail.com">williamemersonscott@gmail.com</a>-->
								</div>
								<!--<div class="col-md-4 reference">
									<b>George Kovats</b><br>
									Previous Employer - Professional Reference<br>
									<i>Manager at Peraton</i><br>
									Cumming, GA (678)-331-7515
									<a href="mailto:cpallansch@adittech.com">cpallansch@adittech.com</a>
								</div>-->
								
								<div class="col-md-4 reference">
									<b>Aaron Reinmann</b><br>
									Previous Employer - Professional Reference<br>
									<i>Owner/co-owner Sideways8 ( now Clockwork WP ) </i><br>
									Cumming, GA (404)-997-2784
									<!--<a href="mailto:aaron.reimann@gmail.com">aaron.reimann@gmail.com</a>-->
								</div>
								
								
								<div class="col-md-4 reference">
									<b>Tom Jones</b><br>
									Family friend - Personal Reference<br>
									<i>Restaurant Manager at The Loft</i><br>
									Columbus, GA (706)-992-3912
								</div>
								
								<div class="col-md-4 reference">
									<b>Robert Edmunds</b><br>
									Family friend - Personal Reference<br>
									<i>Regional Manager at Verizon</i><br>
									Newnan, GA (334)-796-0220
								</div>
								
								<!--<div class="col-md-4 reference">
									<b>Vallerie Tribuani</b><br>
									Previous Employer - Professional Reference<br>
									<i>GM of Mrs. Winners</i><br>
									Austell, GA (678)-641-2585
								</div>-->
								
							</div>
							<hr>
						</section>

						<section id="extra-skills" >
							<div class="row">
							<div class="col-md-6">
								
								
								
								
								<!--More Skills:<ul class="pills">

									<li class="skill"><span class="wrap">E-Learning</span></li>
									<li class="skill"><span class="wrap">Programming</span></li>
									<li class="skill"><span class="wrap">Website Development</span></li>
									<li class="skill"><span class="wrap">Mobile Applications</span></li>
									<li class="skill"><span class="wrap">Troubleshooting</span></li>
									<li class="skill"><span class="wrap">User Interface Design</span></li>
									<li class="skill"><span class="wrap">User Experience</span></li>
									<li class="skill"><span class="wrap">Twitter Bootstrap</span></li>
									<li class="skill"><span class="wrap">WordPress</span></li>
									<li class="skill"><span class="wrap">Web Development</span></li>
									<li class="skill"><span class="wrap">Servers</span></li>
									<li class="skill"><span class="wrap">E-commerce</span></li>
									<li class="skill"><span class="wrap">HTML</span></li>
									<li class="skill"><span class="wrap">PHP</span></li>
									<li class="skill"><span class="wrap">CSS</span></li>
									<li class="skill"><span class="wrap">Linux</span></li>
									<li class="skill"><span class="wrap">Server Maintenance</span></li>
									<li class="skill"><span class="wrap">Custom CMS Development</span></li>
									<li class="skill"><span class="wrap">Scrum</span></li>
									<li class="skill"><span class="wrap">Agile Web Development</span></li>
									<li class="skill"><span class="wrap">SEO</span></li>
									<li class="skill"><span class="wrap">ASP.NET</span></li>
									<li class="skill"><span class="wrap">JavaScript</span></li>
									<li class="skill"><span class="wrap">Photoshop</span></li>
									<li class="skill"><span class="wrap">Magento</span></li>
									<li class="skill"><span class="wrap">Salesforce</span></li>
									<li class="skill"><span class="wrap">Database Management</span></li>
									<li class="skill"><span class="wrap">OS X</span></li>
									<li class="skill"><span class="wrap">Payments</span></li>
									<li class="skill"><span class="wrap">Hardware Installation</span></li>
									<li class="skill"><span class="wrap">Network Troubleshooting</span></li>
									<li class="skill"><span class="wrap">MVC</span></li>
									<li class="skill"><span class="wrap">Management</span></li>
									<li class="skill"><span class="wrap">Software Development</span></li>
									<li class="skill"><span class="wrap">Microsoft Office</span></li>
									<li class="skill"><span class="wrap">AngularJS</span></li>
									<li class="skill"><span class="wrap">AWS</span></li>
									<li class="skill"><span class="wrap">Amazon Web Services</span></li>
									<li class="skill"><span class="wrap">cPanel</span></li>
									<li class="skill"><span class="wrap">WHM (Web Host Manager)</span></li>

								</ul>-->


								Interests:
								<ul class="pills">

									<li class="interest"><span class="wrap">multimedia streaming</span></li>
									<li class="interest"><span class="wrap">building computers</span></li>
									<li class="interest"><span class="wrap">camping</span></li>
									<li class="interest"><span class="wrap">new technology</span></li>
									<li class="interest"><span class="wrap">software development</span></li>
									<li class="interest"><span class="wrap">range shooting</span></li>
									<li class="interest"><span class="wrap">server maintenance</span></li>
									<li class="interest"><span class="wrap">paint-balling</span></li>
									<li class="interest"><span class="wrap">biking</span></li>
									<li class="interest"><span class="wrap">networking</span></li>
									<li class="interest"><span class="wrap">League of Legends</span></li>
									<li class="interest"><span class="wrap">Raspberry Pi's</span></li>
									<li class="interest"><span class="wrap">touchscreen devices</span></li>
									<li class="interest"><span class="wrap">Phone hacking</span></li>

								</ul>



							</div>
							<div class="col-md-6">
								<h5>Links to developed websites:</h5>
								<ul>
									<li><a target="_blank" href="http://www.theloft.com">http://www.theloft.com</a></li>
									<li><a target="_blank" href="http://artofyogacolumbusga.com">http://artofyogacolumbusga.com</a></li>
									<!--<li><a target="_blank" href="http://tommygs.com">http://tommygs.com</a></li>-->
									<li><a target="_blank" href="http://roswellghosttour.com">http://roswellghosttour.com</a></li>
									<!--<li><a target="_blank" href="http://thebetteryouproject.com">http://thebetteryouproject.com</a></li>-->
									<!--<li><a target="_blank" href="http://cyber.auburn.edu">http://cyber.auburn.edu</a></li>-->
									<!--<li><a target="_blank" href="http://auburnart.com/">http://auburnart.com/</a></li>-->
									<!--<li><a target="_blank" href="http://parkerconsultinginc.com/">http://parkerconsultinginc.com/</a></li>-->
									<!--<li><a target="_blank" href="http://caretreepro.com/">http://caretreepro.com/</a></li>-->
									<!--<li><a target="_blank" href="http://shorewoodind.com/">http://shorewoodind.com/</a></li>-->
									<li><a target="_blank" href="https://chrishixson.com/">https://chrishixson.com/</a></li>
									<li><a target="_blank" href="https://qbiqsystem.com/">https://qbiqsystem.com/</a></li>
									<li><a target="_blank" href="https://cadence-group.com/">https://cadence-group.com/</a></li>
									<li><a target="_blank" href="https://www.opp.ourpalsplace.org/">https://www.opp.ourpalsplace.org/</a></li>
									<li><a target="_blank" href="https://regalabs.com/">https://regalabs.com/</a></li>
									<li><a target="_blank" href="https://outlawcoffeecompany.com/">https://outlawcoffeecompany.com/</a></li>
								</ul>
							</div>
							<?php /*
							<div class="col-md-6">
								<div class="linkedin-link">
								<!--<a target="blank" class="linkedin-link" href="https://www.linkedin.com/pub/jim-o-brien/48/61a/460/">-->
									<span>These are my endorsements on LinkedIn. Updated: Feb 2016.</span>
									<img class="employer-img" src="<?php echo get_stylesheet_directory_uri(); ?>/images/linked-in.png">
								<!--</a>-->
								</div>
							</div>
							*/ ?>
						</div>
						</section>


					</div><!-- end resume -->





				<?php endwhile; else: ?>
					<?php /* kinda a 404 of sorts when not working */ ?>
					<div class="page-header">
						<h1>Oh no!</h1>
					</div>
					<p>No content is appearing for this page!</p>
				<?php endif; ?>
			</div>


      </div>
	</div>
</div>

	<script>

		jQuery( function($) {
			
			
			
			/*========================================*/
			$( ".disabled" ).click(function( event ) {
				event.preventDefault();
			});
			/*========================================*/
			
			
			
			/*========================================*/
			
			var details_switch = ".page-template-tpl_resume .switch.details-switch";
			var toggle_details_button = "#toggle-details";
			
			
			//toggle details button
			$(toggle_details_button).on("click", function() {
				$(this).toggleClass('btn-default').toggleClass('btn-primary');
				$('.resume-name span, .summary-text, .job-details, #computers, #extra-skills').fadeToggle(700);
				$(details_switch).trigger('click');
			});
			
			//toggle details switch
			$(details_switch).on('change', function() {
				$(toggle_details_button).trigger('click');
			});

			/*========================================*/
			$('.page-template-tpl_resume .resume-options .ms-close-btn').on( 'click', function(){
				$(this).toggleClass( 'closed' );
				$('.page-template-tpl_resume .resume-options form').fadeToggle(700);
			});

		} ); //end of jquery document ready function

	</script>
      <?php get_footer(); ?>
