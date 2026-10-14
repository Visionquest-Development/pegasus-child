<?php
/*
	Template Name: Dogs Page Template
*/
?>

<?php get_header(); ?>

<div id="page-wrap">
	<?php
		$pegasus_container_choice = get_post_meta(get_the_ID(), 'pegasus-page-container-checkbox', true);
		$full_container_chk_choice = pegasus_get_option('full_container_chk');
		$page_vs_global_check = $pegasus_container_choice ? $pegasus_container_choice : $full_container_chk_choice;
		$final_container_class = $page_vs_global_check ? $page_vs_global_check : 'container';
	?>

	<div class="container-fluid">
		<div class="row">
			<div class="inner-content col-md-12">
				<div class="content-no-sidebar">
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<?php the_content(); ?>

						<div class="container-fluid pets-panel opp-bkg mt-5">
							<div class="row">
								<?php
									$args = array(
										'post_type'      => 'pets',
										'posts_per_page' => -1,
										'order'          => 'ASC',
										'orderby'        => 'menu_order',
										'petcategory'    => 'dogs',
									);
									$parent = new WP_Query($args);

									if ($parent->have_posts()) :
								?>
									<?php while ($parent->have_posts()) : $parent->the_post(); ?>
										<?php
											global $post;
											$terms = get_the_terms($post->ID, 'category');
											$tax = '';

											if ($terms && !is_wp_error($terms)) {
												$links = array_map(function ($term) {
													return str_replace(' ', '-', $term->name);
												}, $terms);
												$tax = join(" ", $links);
											}
										?>

										<div class="content-item-container col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 <?php echo strtolower($tax); ?>">
											<article class="article-<?php the_ID(); ?> block-inner">
												<a href="<?php the_permalink(); ?>" class="content-item-image" style="background-image: url('<?php echo pegasus_image_display('full', '', false); ?>');"></a>
												<div class="content-item-wrapper">
													<a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>">
														<h3 class="content-item-title"><?php the_title(); ?></h3>
													</a>
													<a class="opp-button" href="<?php the_permalink(); ?>">Learn More</a>
												</div>
												<?php
													if (function_exists('wp_bootstrap_edit_post_link')) {
														wp_bootstrap_edit_post_link(
															sprintf(
																__('Edit<span class="screen-reader-text"> "%s"</span>', 'textdomain'),
																get_the_title()
															),
															'<span class="edit-link">',
															'</span>'
														);
													}
												?>
											</article>
										</div>
									<?php endwhile; ?>
								<?php endif; wp_reset_query(); ?>
							</div>
						</div>
					<?php endwhile; else: ?>
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
