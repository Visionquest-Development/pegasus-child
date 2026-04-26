<?php /*

Template Name: Blog Template

*/?>
<?php get_header(); ?>
	
 
    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
			<div class="col-md-12">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<div class="">
						<h1><?php the_title(); ?></h1>
					</div>
					
					
					<ul id="blog-categories">
						<li class="cat-item ">
							<a href="https://visionquestdevelopment.com/blog/">All</a>
						</li>
						<?php 
								$args = array(
								'show_option_all'    => '',
								'orderby'            => 'name',
								'order'              => 'ASC',
								'style'              => 'list',
								'show_count'         => 0,
								'hide_empty'         => 1,
								'use_desc_for_title' => 0,
								'child_of'           => 0,
								'feed'               => '',
								'feed_type'          => '',
								'feed_image'         => '',
								'exclude'            => '',
								'exclude_tree'       => '',
								'include'            => '',
								'hierarchical'       => 0,
								'title_li'           => 0,
								'show_option_none'   => __( '' ),
								'number'             => null,
								'echo'               => 1,
								'depth'              => 0,
								'current_category'   => 0,
								'pad_counts'         => 0,
								'taxonomy'           => 'category',
								'walker'             => null
								);
								wp_list_categories( $args ); 
							?>
						</ul>
					
					
					
					
					<?php the_content(); ?>
					
					<div id="cbp-vm" class="cbp-vm-switcher cbp-vm-view-grid">
						<div class="cbp-vm-options">
							<a href="#" class="cbp-vm-icon cbp-vm-grid cbp-vm-selected" data-view="cbp-vm-view-grid">Grid View</a>
							<a href="#" class="cbp-vm-icon cbp-vm-list" data-view="cbp-vm-view-list">List View</a>
						</div>
						<ul id="octane-blog-list" >
							<?php 
							$query2 = new WP_Query( array( 'post_type' => array( 'post' ) ) );
							while ( $query2->have_posts() ) : $query2->the_post();
							
							
							?>
							
								<li class="blog-item-container wow zoomIn">
									<article class="article-<?php the_ID(); ?> block-inner ">
										
										<!-- output the thumbnail -->
										<?php if ( has_post_thumbnail() ) { ?>
											<a class="cbp-vm-image" href="<?php the_permalink(); ?>">
												<?php the_post_thumbnail ( 'medium', array ('class' => 'octane-blog-thumbnail ') ); ?>
											</a>
											<?php
										}else{ ?>
											<a  class="cbp-vm-image" href="<?php the_permalink(); ?>">
												<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/not-blog.png">
											</a>
										<?php }//end else and if
										?>
										
										
										<!-- the permalink and title -->
										<a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>">
											<h3 class="cbp-vm-title">
												<?php 
													the_title(); 
												?>
												
											</h3> 
										</a>

										<div class="cbp-vm-price"><i><?php the_category(); ?></i></div>
									
										<!-- output the excerpt, and if no excerpt then output content-->
										<div class="octane-blog-content cbp-vm-details">
											<?php  
												$octane_excerpt = get_the_excerpt(); 
												if(isset($octane_excerpt)) { ?>
													<p>
														<?php 
															$temporary_excerpt = substr(strip_tags($octane_excerpt), 0, 130);
															echo $temporary_excerpt; 
														?>...
													</p>
												<?php }else{  
													$more = 0; 
													$octane_content = get_the_content(); 
													$temporary = substr(strip_tags($octane_content), 0, 130); ?>
													<p>
														<?php echo $temporary; ?>...
													</p>
											<?php }	?>
										</div>
										<!-- output a read more button -->
										<a class="button cbp-vm-icon cbp-vm-add" href="<?php the_permalink(); ?>"> Read More </a>
									
										<div class="clearfix"></div>
									</article>
								</li>
							<?php endwhile;
							wp_reset_query();
							?>
						</ul>
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
			<?php //get_sidebar(); ?>
       
      </div>
	</div>
    
<?php get_footer(); ?>