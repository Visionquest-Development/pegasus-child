<?php
/* 
	Template Name: Page Builder Template
*/
?>
	<?php get_header(); ?>
	
 <div id="page-wrap">
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
</div>
      <?php get_footer(); ?>