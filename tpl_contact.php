<?php
/*
	Template Name: Contact Template
*/
?>
	<?php get_header(); ?>
	
	<div class="d-flex flex-column">
	
		<section class="about-author text-center mb-2 order-2 order-md-1 wow fadeInRight">
			<div class="container">
				<div class="card mb-3" >
				  <div class="row no-gutters">
					<div class="col-md-4">
					  <img src="//visionquestdevelopment.com/wp-content/themes/pegasus-child/images/self_portrait_small_revised.jpg" class="card-img" alt="...">
					</div>
					<div class="col-md-8">
					  <div class="card-body">
						<h5 class="card-title">About the Owner</h5>
						
						<!--<p class="card-text">Since I was a young boy I was always told I would become an engineer. I always liked working on computers but never knew I would end up in Software development. I started building computers on my grandfather's kitchen table with my father and it evolved into taking things apart myself and putting them back together. Which then led into going to school for Embedded systems and Electrical enginnering and during my time in school I learned web development to make money. I was self taught but I was really good with it and began my career in WordPress at an early age. This led me to a successful career that I still acknowledge today. </p>						-->
						<p class="card-text">From an early age, I was encouraged to pursue a career in engineering. While I had a strong interest in computers, I didn’t initially foresee a future in software development. My journey began by building computers alongside my father, which gradually evolved into dismantling and reassembling components on my own. This hands-on experience led me to study Embedded Systems and Electrical Engineering. During my academic career, I self-taught web development as a way to earn extra income and quickly developed a proficiency in it. I began my professional journey in WordPress early on, which laid the foundation for the successful career I enjoy today.</p>
						
						<a href="/history" class="btn btn-primary">Learn More</a>
					  </div>
					</div>
				  </div>
				</div>
			</div>
		</section>
		

		<div id="page-wrap" class="mb-5 order-1 order-md-2 ">
			<div class="container">
			  <!-- Example row of columns -->
			  <div class="row">
					<div class="col-md-12">
						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
							<div class="page-header">
								<h1><?php the_title(); ?></h1>
							</div>
							
							<?php the_content(); ?>
						
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
	</div>
	
    <?php get_footer(); ?>
	