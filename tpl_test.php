	<?php
/* 
	Template Name: Test Template
*/
?>
	<?php get_header(); ?>
	
	<style>
	
		.hero-section {
			position: relative;
			width: 100%;
			height: 100vh;
			overflow: hidden;
			background-color: #000; /* Dark galaxy background */
		}

		.galaxy-background {
			position: absolute;
			width: 100%;
			height: 100%;
			background: url('/wp-content/themes/pegasus-child/images/space.png') no-repeat center center;
			background-size: cover;
		}

		.spinning-world {
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
			z-index: 10;
		}

		.spinning-world img {
			width: 300px; /* Adjust size of the world */
			height: 300px;
		}

		.aurora-borealis {
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			z-index: 5;
		}

		.aurora-borealis div {
			position: absolute;
			width: 100%;
			height: 100%;
			background: radial-gradient(circle, transparent, rgba(0,0,0,0.5), rgba(0,0,0,1));
			opacity: 0.5;
		}

		.aurora-color-1 { background-color: #241F60; }
		.aurora-color-2 { background-color: #21648B; }
		.aurora-color-3 { background-color: #1A8D85; }
		.aurora-color-4 { background-color: #2BB673; }
		.aurora-color-5 { background-color: #8BC644; }
		
		#241F60, #21648B, #1A8D85, #2BB673, #8BC644

		
	</style>
	
	<div class="">
	
	
		<section>
			<div class="hero-section">
				<div class="galaxy-background"></div>
				<div class="spinning-world">
					<img src="/wp-content/themes/pegasus-child/images/world.png" alt="Spinning World" />
				</div>
				<div class="aurora-borealis">
					<div class="aurora-color-1"></div>
					<div class="aurora-color-2"></div>
					<div class="aurora-color-3"></div>
					<div class="aurora-color-4"></div>
					<div class="aurora-color-5"></div>
				</div>
			</div>
		</section>
		
		
		
		<script>
		
		document.addEventListener('DOMContentLoaded', function () {
			// Spinning World Animation
			gsap.to('.spinning-world img', {
				duration: 60, // Spins for 60 seconds
				rotate: 360,
				repeat: -1, // Infinite rotation
				ease: "linear"
			});

			// Aurora Borealis Animation
			const auroras = gsap.utils.toArray('.aurora-borealis div');
			
			auroras.forEach((aurora, i) => {
				gsap.to(aurora, {
					duration: 5 + i, // Slightly different duration for each aurora color
					opacity: 1,
					repeat: -1,
					yoyo: true,
					ease: "power1.inOut",
					delay: i * 0.5, // Stagger each one slightly
					x: "random(-50, 50)", // Random horizontal movement
					y: "random(-50, 50)", // Random vertical movement
				});
			});
		});
		
		</script>
	</div>
 
    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
			<div class="col-md-12">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					
					
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
    
	
	
	<?php get_footer(); ?>