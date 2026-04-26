	<?php get_header(); ?>
	
 <div id="page-wrap">
    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
			<div class="col-md-12">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					
					
					<?php
					  
					  $url = $_SERVER['HTTP_REFERER'] ? htmlspecialchars($_SERVER['HTTP_REFERER']) : '';
					  
					  echo "<a class='back-btn' href='$url'><i class='fa fa-long-arrow-left'></i> Back</a>"; 
					?>
					
					
					<?php
						if ( has_post_thumbnail() ) { 
							$thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full', false, '' ); 
							
						}else{
							$thumb_url = array( get_template_directory_uri() . "/images/not-available.png", "1");
						}
					?>
					<article class="article-<?php the_ID(); ?> block-inner clearfix">
						<div class="row">
							<div class="col-md-6">
								<div class="picture-container  clearfix">	
									<!-- output the thumbnail -->
									<?php if ( has_post_thumbnail() ) { ?>											
											<?php the_post_thumbnail ( 'medium', array ('class' => 'octane-blog-thumbnail ') ); ?>											
										<?php
									}else{ ?>											
											<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/not-available.png">
									<?php }//end else and if
									?>											
								</div> <!-- end picture container -->	
							</div>
							<div class="col-md-6">
								<?php 
									$terms = get_the_terms( $post->ID, 'portcats' );
									$terms2 = get_the_terms( $post->ID, 'feattag' );

									$slug_array_one = [];
									if ( is_array( $terms ) || is_object( $terms ) ) {
										foreach( $terms as $term ) {
											$slug_array_one[] = $term->slug;
										}
									}
									$slug_array_one_return = implode( ' ', $slug_array_one );

									$slug_array_two = [];
									if ( is_array( $terms2 ) || is_object( $terms2 ) ) {
										foreach( $terms2 as $term2 ) {
											$slug_array_two[] = $term2->slug;
										}
									}
									$slug_array_two_return = implode( ' ', $slug_array_two );
								?>
								<div class="inner-right">
									<!-- the title -->
									<h3 class="featured-title"><?php the_title(); ?></h3>
									
									<div class="single-cats">
										Category:
										<ul class="port-cats">
											<?php 
												//$terms3 = get_the_terms( $post->ID, 'portcats' ); 
												//foreach( $terms3 as $term ) echo '<li><i>' . $term->slug . '</i></li>'; 
												if ( is_array( $terms ) || is_object( $terms ) ) {
													foreach( $terms as $term ) {
														echo '<li><i>' . $term->slug . '</i></li>';
													}
												}
											?>
										</ul>
									</div>
									
									<div class="single-tech">
										Technology: 
										<ul class="tech">
											<?php 
												//$terms6 = mysql_real_escape_string( get_the_terms( $post->ID, 'feattag' ) );
												
												//$testjim = get_the_terms( $post->ID, 'feattag' );
												//echo "<pre>" . var_dump( $testjim ) . "</pre>";
												//if ( is_array(terms6) ) {
													//foreach( $terms6 as $term ) echo '<li><i>' . $term->slug . '</i></li>'; 
												//}else{
													//echo '<li><i>' . 'test' . '</i></li>';
												//}
												if ( is_array( $terms2 ) || is_object( $terms2 ) ) {
													foreach( $terms2 as $term2 ) {
														echo '<li><i>' . $term2->slug . '</i></li>';
													}
												}
											?>
										</ul>
									</div>
									
									<!--author and time -->
									<?php /*
									<p><i>Posted by <?php the_author(); ?> in <?php $the_cat = the_category(', '); if($the_cat){ echo $the_cat; }else { echo '"Uncategorized"';  } ?> on <?php the_time('F j, Y'); ?>.</i></p>
									*/ ?>
									<!-- output the excerpt, and if no excerpt then output content-->
									<?php the_content(); ?>
								</div>
							</div>
						</div>
					</article>
				
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