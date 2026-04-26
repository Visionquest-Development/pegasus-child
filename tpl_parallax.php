<?php
/* 
	Template Name: Parallax Template
*/
?>
	<?php get_header(); ?>
	<style>
	
		.page-template-tpl_parallax #page-wrap { padding: 0 !important; }
	
		.demo-section {
			width: 100%; 
			background-size: 100% !important; 
			position: relative;
		}
		
		@media only screen and ( min-width: 980px) {
			.demo-section { height: 600px; padding: 5em; }
		}
		
		
		.demo-section h1, .demo-section p { color: #fff !important; }
	
		#demo-section-1 {
			background: url(<?php echo get_stylesheet_directory_uri(); ?>/images/quadroIdeas_1.jpg) 0 0 no-repeat;
		}
		
		#demo-section-2 {
			background: url(<?php echo get_stylesheet_directory_uri(); ?>/images/quadroIdeas_2.jpg) 0 0 no-repeat;
		}
		
		#demo-section-3 {
			background: url(<?php echo get_stylesheet_directory_uri(); ?>/images/quadroIdeas_3.jpg) 0 0 no-repeat;
		}
		
			#demo-section-3 img {
				position: absolute;
				width: 30%;
				height: auto;
			}
			
			#demo-section-3 img:first-child {
				left: 0; 
			}
			
			#demo-section-3 img:last-child {
				left: 700px; 
			}
		
		#demo-section-4 {
			background: url(<?php echo get_stylesheet_directory_uri(); ?>/images/quadroIdeas_4.jpg) 0 0 no-repeat;
		}
		
		@media only screen and ( min-width: 1100px ) and ( max-width: 1405px) {
			
		}
	
	</style>
 
    
      <!-- Example row of columns -->
      
			
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					
					
					<?php the_content(); ?>
					
					
					
					
					<div class="demo-section" id="demo-section-1" data-stellar-background-ratio="0.5">
						<h1>Section 1</h1>
						<p>Nulla porttitor accumsan tincidunt. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem.</p>
					</div>
					
					<div class="demo-section" id="demo-section-2" data-stellar-background-ratio="0.5">
						<h1>Section 2</h1>
						<p>Nulla porttitor accumsan tincidunt. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem.</p>
					</div>
					
					<div class="demo-section" id="demo-section-3" data-stellar-background-ratio=".5">
						<h1>Section 3</h1>
						<p>Nulla porttitor accumsan tincidunt. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem.</p>
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-seo.png" alt="Image" data-stellar-ratio="1.5" data-stellar-vertical-offset="-150">
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-video.png" alt="Image" data-stellar-ratio="2.5">
					</div>
					
					<div class="demo-section" id="demo-section-4" data-stellar-background-ratio="0">
						<h1>Section 4</h1>
						<p>Nulla porttitor accumsan tincidunt. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem.</p>
						
					</div>
					
					
					
				
				<?php endwhile; else: ?>
					<?php /* kinda a 404 of sorts when not working */ ?>
					<div class="page-header">
						<h1>Oh no!</h1>
					</div>
					<p>No content is appearing for this page!</p>
				<?php endif; ?>
			
			

	
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/stellar.js/0.6.2/jquery.stellar.min.js"></script>
	<script>
		jQuery( function($) {
			$( window ).stellar();
		});
	</script>
    
	
	<?php get_footer(); ?>