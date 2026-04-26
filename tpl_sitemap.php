<?php
/* 
	Template Name: Sitemap Template
*/
?>
	<?php get_header(); ?>
	
<div id="page-wrap">
    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
			<div class="col-md-9">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<div class="page-header">
						<h1><?php the_title(); ?></h1>
					</div>
					
					<?php the_content(); ?>
					<div class="row">
						<div class="col-md-6">
							<ul id="sitemap-list-pages">
								<?php $args2 = array(
									
									'title_li'     => __('Pages')
								);								
								wp_list_pages($args2);
								?>
							</ul>
							
							
							<ul>
							<li class="pagenav">Products</li>
							<ul><?php $loop = new WP_Query( array( 
								'post_type' => 'product', 
								'posts_per_page' => 1000,
								'orderby' => 'title',
								'order'   => 'ASC'
							 ) ); ?>
								<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
									<li><?php the_title( '<a href="' . get_permalink() . '" title="' . the_title_attribute( 'echo=0' ) . '" rel="bookmark">', '</a>' ); ?></li>
								<?php endwhile; ?>
								<?php wp_reset_query(); ?></ul>
							</ul>
							
							
							
						</div>
						<div class="col-md-6">
							
							
							<ul id="sitemap-list-pages">
							
								<?php 
									$args = array(
										'post_type'=>'portfolio',
										'title_li'     => __('Portfolios')
									);
									wp_list_pages( $args ); 
								?> 
								
							</ul>
							
							
							<ul id="sitemap-list-posts">
								<li class="pagenav">Posts
									<ul>
									<?php
										$lastposts = get_posts('numberposts=5&orderby=rand&cat=-52');
										foreach($lastposts as $post) :
										setup_postdata($post); ?>
										<li<?php if ( $post->ID == $wp_query->post->ID ) { echo ' class="current"'; } else {} ?>>
											<a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
										</li>
									<?php endforeach; ?>
									</ul>
								</li>
							</ul>
							
						</div>
					</div>
					<br clear="all"/>
				
				<?php endwhile; else: ?>
					<?php /* kinda a 404 of sorts when not working */ ?>
					<div class="page-header">
						<h1>Oh no!</h1>
					</div>
					<p>No content is appearing for this page!</p>
				<?php endif; ?>
			</div>
			<?php get_sidebar(); ?>
       
      </div>
	</div>
</div>
      <?php get_footer(); ?>					
